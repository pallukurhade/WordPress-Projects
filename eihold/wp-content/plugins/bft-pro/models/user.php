<?php
class BFTProUser {
	// get users from a mailing list
	function select($list_ids, $orderby, $orderdir, $offset=0, $limit=0) {
		global $wpdb;		
		
		// define $list_id_sql
		$list_id_sql=is_array($list_ids)?" list_id IN (".implode(",",$list_ids).") " : $wpdb->prepare("list_id=%d", $list_ids);
		
		// limit per page?
		$limit_sql=$limit?$wpdb->prepare(" LIMIT %d, %d ", $offset, $limit):"";
		
		// filters
		$filters_sql="";
		if(!empty($_GET['filter_email'])) {
			$filter_email="%$_GET[filter_email]%";
			$filters_sql.=$wpdb->prepare(" AND email LIKE %s ", $filter_email); 
		}
		if(!empty($_GET['filter_name'])) {
			$filter_name="%$_GET[filter_name]%";
			$filters_sql.=$wpdb->prepare(" AND name LIKE %s ", $filter_name); 
		}
		if(!empty($_GET['filter_ip'])) {
			$filter_ip="%$_GET[filter_ip]%";
			$filters_sql.=$wpdb->prepare(" AND ip LIKE %s ", $filter_ip); 
		}
		
		if(isset($_GET['filter_status']) and intval($_GET['filter_status'])!=-1) {
			if($_GET['filter_status'] == -2) {
				$_GET['filter_status'] = 0;				
				$filters_sql .= " AND unsubscribed = 1 ";	
			}
			$filters_sql.=$wpdb->prepare(" AND status=%d ", $_GET['filter_status']); 
		}
		
		if(isset($_GET['readmails_from']) and $_GET['readmails_from']!=='') {
			$filters_sql .= $wpdb->prepare(" AND (read_nls + read_armails) >= %d", $_GET['readmails_from']);
		}
		
		if(isset($_GET['readmails_to']) and $_GET['readmails_to']!=='') {
			$filters_sql .= $wpdb->prepare(" AND (read_nls + read_armails) <= %d", $_GET['readmails_to']);
		}
		
		// link clicks - this part is activated by the Intelligence module but the code is simple so we'll include it here
		if(isset($_GET['clicks_from']) and $_GET['clicks_from']!=='') {
			$filters_sql .= $wpdb->prepare(" AND clicks >= %d", $_GET['clicks_from']);
		}
		
		if(isset($_GET['clicks_to']) and $_GET['clicks_to']!=='') {
			$filters_sql .= $wpdb->prepare(" AND clicks <= %d", $_GET['clicks_to']);
		}
				
	
		$users=$wpdb->get_results("SELECT SQL_CALC_FOUND_ROWS * FROM ".BFTPRO_USERS." 
			WHERE $list_id_sql $filters_sql
			ORDER BY $orderby $orderdir $limit_sql", ARRAY_A);
		$cnt_users=$wpdb->get_var("SELECT FOUND_ROWS()");	
			
		// match data from custom fields to users		
		$datas=$wpdb->get_results("SELECT * FROM ".BFTPRO_DATAS." WHERE $list_id_sql ");
		
		foreach($users as $cnt=>$user) {
			foreach($datas as $data) {
				if($data->user_id==$user['id']) {
					$users[$cnt]['field_'.$data->field_id]=$data->data;
				}
			}
		}			
			
		return array($users, $cnt_users);
	}
	
	// gets a single user along with their data
	function get($id) {
		global $wpdb;
		
		$user=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_USERS." WHERE id=%d", $id), ARRAY_A);	
		
		// get data
		$datas=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_DATAS." WHERE user_id=%d AND list_id=%d", $id, $user['list_id']));
		
		foreach($datas as $data) {
			$user['field_'.$data->field_id]=$data->data;
		}	
		
		return $user;
	}
	
	// adds in the DB
	function add($vars) {
		global $wpdb;
		$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_USERS." SET
			email=%s, name=%s, status=%d, date=%s, ip=%s, code=%s, list_id=%d",
			$vars['email'], $vars['name'], $vars['status'], @$vars['date'], @$vars['ip'], @$vars['code'], @$vars['list_id']));
		return $wpdb->insert_id;	
	}
	
	// in practice = add user
	function subscribe($vars, &$message=null, $in_admin = false) {
		global $wpdb;
		
		$_sender = new BFTProSender();
		
		// when coming from signup page we use "bftpro_name" instead of "name" to avoid "Page not found" problem with Wordpress
		if(!empty($vars['bftpro_name'])) $vars['name'] = $vars['bftpro_name'];		
		
		// require valid non-empty email
		if(empty($vars['email'])) throw new Exception("Valid non-empty email is required");
		
		// subscribing to multiple lists?
		if(!empty($vars['list_ids']) and is_array($vars['list_ids']) and !empty($vars['list_ids'][0])) {
			$list_ids = $vars['list_ids'];
			$num_lists = sizeof($list_ids);
			unset($vars['list_ids']);
			foreach($list_ids as $cnt=>$id) {				
				$vars['list_id'] = $id;
				$this->ignore_redirect = ($cnt + 1 < $num_lists) ? true : false;  
				
				// fill any required fields with "1" to avoid errors			
				$fields=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_FIELDS." WHERE list_id=%d AND is_required=1", $id));
				foreach($fields as $field) $vars['field_'.$field->id] = 1;
				$this->subscribe($vars, $message, $in_admin);
			}
			return $id; // return the last ID
		}
		
		// require valid list_id
		$list=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_LISTS." WHERE id=%d", @$vars['list_id']));
      if(empty($list->id)) throw new Exception("Invalid mailing list ID");
      
      // require name?
		if($list->require_name and empty($vars['name'])) throw new Exception(__("You must enter your name", 'bftpro'));
      
      // recaptcha?
      if($list->require_recaptcha and empty($in_admin)) {
      	$recaptcha_public = get_option('bftpro_recaptcha_public');
			$recaptcha_private = get_option('bftpro_recaptcha_private');
			
			if($recaptcha_public and $recaptcha_private) {
				require_once(BFTPRO_PATH."/recaptcha/recaptchalib.php");
				$resp = recaptcha_check_answer ($recaptcha_private,
                                $_SERVER["REMOTE_ADDR"],
                                $vars["recaptcha_challenge_field"],
                                $vars["recaptcha_response_field"]);
            if (!$resp->is_valid) {
            	throw new Exception(__('The image verification code is not correct. Please go back and try again.', 'bftpro'));
            }                    
			}
      }
      
      // text captcha?
      if($list->require_text_captcha and empty($in_admin)) {
      	if(!BFTProTextCaptcha :: verify($_POST['bftpro_text_captcha_question'], $_POST['bftpro_text_captcha_answer'])) {
      		throw new Exception(__('The verification question was not answered correctly. Please go back and try again.', 'bftpro'));
      	}
      }

		// duplicate email? if yes, update fields and return ID
		$exists=$wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_USERS." WHERE email=%s AND list_id=%d",
			$vars['email'], $vars['list_id']));
		if(!empty($exists->id)) {
			$vars['status'] = $exists->status;
			$this->save($vars, $exists->id, $in_admin);
			
			// if this member is already registered AND confirmed make double optin = false, no matter what
			// otherwise let the double optin email be sent
			if($exists->status) $list->optin=0;
			
			$id=$exists->id;
			
			$message = __("You are already subscribed to this mailing list", 'bftpro');
		}
		else {			
			// status? based on double opt-in and admin selection (admin selection has priority when admin adds user manually)
			if($in_admin and isset($vars['status'])) $status = $vars['status'];
			else $status=$list->optin?0:1;
						
			$code=substr(md5($vars['email'].microtime()),0,8);
				
			// insert member
			$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_USERS." SET
				email=%s, name=%s, status=%d, date=CURDATE(), ip=%s, code=%s, list_id=%d, auto_subscribed=%d",
				$vars['email'], @$vars['name'], $status, $_SERVER['REMOTE_ADDR'], $code, $list->id, @$vars['auto_subscribed']));
			$id=$wpdb->insert_id;	
			
			// add extra data
			$this->save_data($vars, $id, $in_admin);			
				
			// double opt-in? send activation email
			if(!$status) {
				 $this->send_activation_email($vars, $list);
				 $message = __("Please check your email. A confirmation message has been sent to it. Your membership will not be activated before you click on the confirmation link inside the message", 'bftpro');
			}
			else {
				$_sender->immediate_mails($id);
				$this->subscribe_triggers($id, $list);
				
				if($list->do_notify) {		
					// notify admin
					require_once(BFTPRO_PATH."/models/list.php");
					$_list = new BFTProList();
					$_list->notify_admin($id, 'register');
				}				
				
				do_action('bftpro_user_subscribed', $id, $list->id);				
				$message = __("You have been subscribed to the mailing list", 'bftpro');
			}		
		}
		
		// redirect?
		if(!empty($list->redirect_to) and empty($this->ignore_redirect)) bftpro_redirect($list->redirect_to);		
		
		return $id;
	}
	
	function save($vars, $id, $in_admin = false) {
		global $wpdb;
		
		$date_sql = $code_sql = $ip_sql = "";
		if(!empty($vars['date'])) $date_sql = $wpdb->prepare(", date=%s", $vars['date']);
		if(!empty($vars['ip'])) $ip_sql = $wpdb->prepare(", ip=%s", $vars['ip']);
		
		$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_USERS." SET
			email=%s, name=%s, status=%d $ip_sql $date_sql $code_sql
			WHERE id=%d",
			$vars['email'], @$vars['name'], $vars['status'], $id));
			
		$this->save_data($vars, $id, $in_admin);
						
		return true;	
	}
	
	function delete($id) {
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_USERS." WHERE id=%d", $id));
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_DATAS." WHERE user_id=%d", $id));
		
		return true;
	}
	
	function save_data($vars, $uid, $in_admin = false) {
		global $wpdb;
		
		// select fields in the given list ID
		$fields=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_FIELDS." WHERE list_id=%d", $vars['list_id']));
		
		foreach($fields as $field) {			
			if($field->ftype == 'date') {
				$day = empty($vars['field_'.$field->id.'day']) ? "01" :  $vars['field_'.$field->id.'day'];
				$month = empty($vars['field_'.$field->id.'month']) ? "01" :  $vars['field_'.$field->id.'month'];
				$year = empty($vars['field_'.$field->id.'year']) ? "1900" :  $vars['field_'.$field->id.'year'];
				$data = $year.'-'.$month.'-'.$day;
			}		
			else $data=@$vars['field_'.$field->id];

			// required field?
			if(!$in_admin and $field->is_required and empty($data)) throw new Exception(__('You have missed a required field', 'bftpro'));			
			
			if(empty($data) and $field->ftype != 'checkbox') continue;
			
			// replace/insert data			
			$wpdb->query($wpdb->prepare("REPLACE INTO ".BFTPRO_DATAS." (field_id, list_id, user_id, data)
				VALUES (%d, %d, %d, %s)", $field->id, $vars['list_id'], $uid, $data));
		}
	}
	
	function unsubscribe($user) {
		global $wpdb;
		
		// if user is already inactive, don't run queries
		if(!$user->status) return false;
				
		$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_USERS." SET status=0, unsubscribed=1
			WHERE id=%d", $user->id));
			
		// select number of AR emails received 
		$num_emails = $wpdb->get_var($wpdb->prepare("SELECT COUNT(id) FROM ".BFTPRO_SENTMAILS."
			WHERE user_id=%d AND errors='' ", $user->id)); 	
			
		// insert into unsubscribed table
		$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_UNSUBS." SET
			email=%s, list_id=%d, date=CURDATE(), ar_mails=%d", $user->email, $user->list_id, $num_emails));
			
		// unsubscribe notify?
		require_once(BFTPRO_PATH."/models/list.php");
		$_list = new BFTProList();
		$list = $_list->select($user->list_id);	
		if($list->unsubscribe_notify) $_list->notify_admin($user->id, 'unsubscribe');
		
		do_action('bftpro_user_unsubscribed', $user->id, $list->id);
			
		return true;	
	}
	
	// send double opt-in email	
	function send_activation_email($vars, $list) {
		 global $wpdb;
		 
		 $_sender = new BFTProSender();
		 
		 if(!empty($list->confirm_email_subject)) {
		 		$subject = $list->confirm_email_subject;
		 		$message = $list->confirm_email_content;
		 }
		 else {
		 	  $subject = get_option('bftpro_optin_subject');
		 	  $message = get_option('bftpro_optin_message');
		 }
		 
		 if(!strstr($message, "{{url}}")) $message.="<br>\n<br>\n<a href='{{url}}'>{{url}}</a>";
		 
		 // extracts or sets a "firstname" field regardless the fact it does not exist
		 if(strstr(@$vars['name']," ")) {
				$parts=explode(" ",$vars['name']);
				$firstname=$parts[0];
		 }
		 else $firstname=@$vars['name'];
		 $message = str_replace('{{firstname}}', $firstname, $message);
		 $message = str_replace('{{name}}', @$vars['name'], $message);
		 
		 $subject = stripslashes($subject);
		 $message = stripslashes($message);
		 
		 // generate code for this user
		 $code = substr(md5($vars['email'].time()), 0, 8);
		 
		 $wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_USERS." SET
		 	code=%s WHERE email=%s AND list_id=%d", $code, $vars['email'], $list->id));
		 
		 $url = site_url("?bftpro_confirm=1&email=$vars[email]&list_id={$list->id}&code=$code");
		 
		 $message = str_replace("{{url}}", $url, $message);
		 $message = str_replace("{{list-name}}", $list->name, $message);
		 
		 $list->sender = empty($list->sender)?get_option('bftpro_sender'):$list->sender;
		 $_sender->send($list->sender, $vars['email'], $subject, $message);
	}
	
	// double opt-in confirmtion
	function confirm() {
		// find this user
		global $wpdb;
		
		$user = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_USERS." 
			WHERE email=%s AND list_id=%d", $_GET['email'], $_GET['list_id']));
				
		if(empty($user->id)) return false;
		
		if($user->status) return __("Your account is already active.", 'bftpro');
		
		// check code
		if($user->code!=$_GET['code']) return false;
		
		require_once(BFTPRO_PATH."/models/list.php");
		$_sender = new BFTProSender();
		$_list = new BFTProList();
		
		// now update user and send immediate emails
		$code=substr(md5(@$vars['email'].microtime()),0,8);
		$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_USERS." SET 
			status=1, code=%s WHERE id=%d", $code, $user->id));		
		
		$_sender->immediate_mails($user->id);		
		
		$list = $_list->select($user->list_id);
		$this->subscribe_triggers($user->id, $list);
		
		if($list->do_notify) $_list->notify_admin($user->id, 'register');
		
		// redirect?		
		if($list->redirect_confirm) bftpro_redirect($list->redirect_confirm);
		
		do_action('bftpro_user_subscribed', $user->id, $list->id);
		$message = __("You have successfully confirmed your subscription.", 'bftpro');
		return $message;
	}	
	
	// selects receivers for given email message along with custom fields data
	function select_receivers($extra_conditions, $limit) {
		global $wpdb;
		$limit = intval($limit);
		$limit_sql = $limit ? "LIMIT $limit" : "";
				
		$users = $wpdb->get_results("SELECT * FROM ".BFTPRO_USERS." 
		WHERE status=1 $extra_conditions ORDER BY id $limit_sql");		
		
		$users = $this->add_extra_data($users);
		
		return $users;
	}
	
	// adds the extra data to $users
	function add_extra_data($users) {
		global $wpdb;
		
		$ids=array(0);
		foreach($users as $user) $ids[]=$user->id;
		$id_sql=implode(",", $ids);
		
		// now select all datas for these receivers
		$datas = $wpdb->get_results("SELECT tD.*, tF.name as field_name, tF.label as field_label 
				FROM ".BFTPRO_DATAS." tD JOIN ".BFTPRO_FIELDS." tF ON tF.id=tD.field_id
				WHERE tD.user_id IN ($id_sql)");
		
		// now match the datas on $object->fields[ID]
		foreach($users as $cnt => $user) {
			$fields = array();
			$pretty_fields = array();
			$named_fields = array();
			foreach($datas as $data) {
				if($data->user_id!=$user->id) continue;
				$fields[$data->field_id]=$data->data;
				$pretty_fields[$data->field_label] = $data->data;
				$named_fields[$data->field_name] = $data->data;
			}
			
			$users[$cnt]->fields = $fields;
			$users[$cnt]->pretty_fields = $pretty_fields;
			$users[$cnt]->named_fields = $named_fields;
		} // end foreach user
		
		return $users;
	}
	
	// do actions when user subscribes - for example maybe sign them as WP user
	function subscribe_triggers($user_id, $list) {
		global $wpdb;
		
		// auto-subscribe to blog
		if($list->subscribe_to_blog == 1) {			
			// select user
			$user = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_USERS." WHERE id=%d", $user_id));
			
			// if user is auto-subscribed in this list, we should not continue with this procedure to avoid endless loop
			if($user->auto_subscribed) $action_completed = true;
			
			// if the user is already registered, do nothing
			$wp_user = get_user_by('email', $user->email);
			if(!empty($wp_user->ID)) $action_completed = true;
			// die("we are here");
			if(empty($action_completed)) {
				// prepare desired username
				$target_username = empty($user->name) ? strtolower(substr($user->email, 0, strpos($user->email, '@')+1)) : strtolower(preg_replace("/\s/",'_',$user->name));
				
				// check if target username is available
				$wp_user = get_user_by('login', $target_username);
				
				// if not, find how many users whose username starts with this are available, and add a number to make it unique
				// then again check if it's unique, and if not, add timestamp
				if(!empty($wp_user->ID)) {
					$num_users = $wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->users} WHERE user_login LIKE '$target_username%'");
					
					if($num_users) {
						$num = $num_users+1;
						$old_target_username = $target_username;
						$target_username = $target_username."_".$num;
						
						$wp_user = get_user_by('login', $target_username);
					
						// still not unique? Add timestamp and hope no one is crazy enough to have the same
						if(!empty($wp_user->ID)) $target_username = $old_target_username . '_' . time(); 
					}
				}
				
				// finally use the username to create the user
				$random_password = wp_generate_password();
				$user_id = wp_create_user( $target_username, $random_password, $user->email );
				
				// update name if any
				if(!empty($user->name)) {
					list($fname, $lname) = explode(" ", $user->name);
					wp_update_user(array("ID"=>$user_id, "first_name"=>$fname, "last_name"=>$lname));
				}
			}
		} // end subscribing as WP user
		
		return true;
	}
}