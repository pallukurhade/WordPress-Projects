<?php
// mailing lists controller
function bftpro_mailing_lists() {
	require_once(BFTPRO_PATH."/models/list.php");
	$_list=new BFTProList();
	global $wpdb;
	
	$do=empty($_GET['do'])?"list":$_GET['do'];
	
	switch($do) {
		case 'add':
			if(!empty($_POST['ok'])) {
				$_list->add($_POST);
				$_SESSION['flash']=__("Mailing list created", 'bftpro');
				bftpro_redirect("admin.php?page=bftpro_mailing_lists");
			}
			
			require(BFTPRO_PATH."/views/list.php");
		break;		
		
		case 'edit':
			if(!empty($_POST['del'])) {
				$_list->delete($_GET['id']);
				$_SESSION['flash']=__("Mailing list deleted", 'bftpro');
				bftpro_redirect("admin.php?page=bftpro_mailing_lists");
			}			
		
			if(!empty($_POST['ok'])) {
				$_list->save($_POST, $_GET['id']);
				$_SESSION['flash']=__("Mailing list updated", 'bftpro');
				bftpro_redirect("admin.php?page=bftpro_mailing_lists");
			}
			
			// select list
			$list=$_list->select($_GET['id']);
			
			require(BFTPRO_PATH."/views/list.php");
		break;
		
		default:
			// select existing lists
			$lists=$_list->select();
			
			// select % open rate in each list
			foreach($lists as $cnt=>$list) {
				$sent_mails = $wpdb->get_var($wpdb->prepare("SELECT COUNT(tS.id) FROM ".BFTPRO_SENTMAILS." tS
					JOIN ".BFTPRO_USERS." tU ON tU.id = tS.user_id
					WHERE tU.list_id = %d AND tS.errors='' ", $list->id));
				
				$read_mails = $wpdb->get_var($wpdb->prepare("SELECT COUNT(tR.id) FROM ".BFTPRO_READMAILS." tR
					JOIN ".BFTPRO_USERS." tU ON tU.id = tR.user_id
					WHERE tU.list_id = %d", $list->id));
					
				$read_nls = $wpdb->get_var($wpdb->prepare("SELECT COUNT(tR.id) FROM ".BFTPRO_READNLS." tR
					JOIN ".BFTPRO_USERS." tU ON tU.id = tR.user_id
					WHERE tU.list_id = %d", $list->id));	
					
				$open_rate = empty($sent_mails) ? 0 : round( 100 * ($read_mails + $read_nls) / $sent_mails);
				$lists[$cnt]->open_rate = $open_rate;	
			}			
			
			require(BFTPRO_PATH."/views/lists.php");
		break;
	}	
}

// manage subscribers
function bftpro_subscribers() {
	global $wpdb;
	require_once(BFTPRO_PATH."/models/list.php");
	require_once(BFTPRO_PATH."/models/field.php");
	require_once(BFTPRO_PATH."/models/data.php");
	require_once(BFTPRO_PATH."/models/user.php");
	
	$_list=new BFTProList();
	$_field=new BFTProField();
	$_user=new BFTProUser();
	
	// select this list
	$list=$_list->select($_GET['id']);
	
	// select extra fields
	$fields=$_field->select($list->id);
	
	$do=empty($_GET['do'])?"list":$_GET['do'];
	switch($do) {
		case 'add':
			if(!empty($_POST['ok'])) {
				try {
					$message="";
					$_POST['list_id']=$list->id;
					$_POST['date']=$_POST['dateyear'].'-'.$_POST['datemonth'].'-'.$_POST['dateday'];					
					$_user->subscribe($_POST, $message, true);
					bftpro_redirect("admin.php?page=bftpro_subscribers&id={$list->id}&message=".urlencode(__("User Added", 'bftpro')));
				}
				catch(Exception $e) {
					$user=$_POST;
					$error=$e->getMessage();					
				}
			}		
		
			require(BFTPRO_PATH."/views/list-user.php");
		break;
		
		case 'edit':
			if(!empty($_POST['del'])) {
				$_user->delete($_GET['user_id']);
				bftpro_redirect("admin.php?page=bftpro_subscribers&id={$list->id}&message=".urlencode(__("User Deleted", 'bftpro')));
			}		
		
			if(!empty($_POST['ok'])) {
				try {
					$_POST['list_id']=$list->id;
					$_POST['date']=$_POST['dateyear'].'-'.$_POST['datemonth'].'-'.$_POST['dateday'];					
					$_user->save($_POST, $_GET['user_id']);					
					bftpro_redirect("admin.php?page=bftpro_subscribers&id={$list->id}&message=".urlencode(__("User Saved", 'bftpro')));
				}
				catch(Exception $e) {
					$user=$_POST;
					$error=$e->getMessage();					
				}
			}
		
			// select user
			$user=$_user->get($_GET['user_id']);		
					
			require(BFTPRO_PATH."/views/list-user.php");
		break;		
		
		case 'import':
			// select fields
			$fields=$_field->select($list->id);
			$cnt_fields=sizeof($fields);
				
			if(!empty($_POST['import'])) {
				if(empty($_FILES["csv"]["name"])) {
					wp_die(__("Please upload file", 'bftpro'));
				}
				
				if(empty($_POST["delimiter"])) {
					wp_die(__("There must be a delimiter", 'bftpro'));
				}
				
				$row = $total = $invalid = 0;
				$invalid_emails = array();
				if (($handle = fopen($_FILES['csv']['tmp_name'], "r")) !== FALSE) {
					$delimiter=$_POST['delimiter'];
					
					 while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {	    	  
				    	 $row++;				    	 	
				       if(empty($data)) continue;
				       if(!empty($_POST['skip_first']) and $row==1) continue;

				       // get name and email
						 $parts=explode(",",$_POST["sequence"]);
						 
						 $email=$data[trim($parts[0])-1];
						 $email=trim($email);
						
						 $nameparts=explode("+",$parts[1]);		
						 $name="";
						 foreach($nameparts as $npart) {
							$name.=$data[(trim($npart)-1)].' ';
						 }
						 $name=trim($name);
						
						 if(preg_match("/^\"(.*)\"$/",$name)) {
							$name=str_replace("\"","",$name);
						 }		
						
						 if(preg_match("/^\"(.*)\"$/",$email)) {
							$email=str_replace("\"","",$email);
						 }		
						 
						 // very basic email validation
						 if(!strstr($email, '@') or !strstr($email, '.')) {
						 	 $invalid++;
						 	 $invalid_emails[] = $email;
						 	 continue;
						 }
						
						 $datepos=$_POST['date']-1;
						 $date=(empty($_POST['date']) or empty($data[$datepos]))?date("Y-m-d"):$data[$datepos];
						 
						 // ip address?
						 $ip = (!empty($_POST['ipnum']) and is_numeric($_POST['ipnum'])) ? $data[$_POST['ipnum']-1] : '';
						 
						 // insert subscriber and get ID
						 $wpdb->query($wpdb->prepare("INSERT IGNORE INTO ".BFTPRO_USERS." SET
						 	email=%s, name=%s, status=1, date=%s, list_id=%d, ip=%s", $email, $name, $date, $_GET['id'], $ip));
						 
						 // insert datas if any
						 $mid=$wpdb->insert_id;
						 
						 if($mid) $total++;
						 
						 if($mid and $cnt_fields) {
							 	$sql="INSERT INTO ".BFTPRO_DATAS." (field_id,user_id, data, list_id) VALUES ";
								$ins_sqls=array();
								$anyfield=false;
								
								foreach($fields as $field) {
									if(!empty($_POST['fieldseq_'.$field->id]))	
									{
										$seq=trim($_POST['fieldseq_'.$field->id])-1;
										$val=trim(@$data[$seq]);
										
										if(preg_match("/^\"(.*)\"$/",$val))
										{
											$val=substr($val,1,strlen($val)-2);
										}
										
										$ins_sqls[]=$wpdb->prepare(" (%d,%d,%s,%d) ", $field->id, $mid, $val, $_GET['id']);
															
										$anyfield=true;
									}
								}
								
								$sql.=implode(",",$ins_sqls);			
							   if($anyfield) $wpdb->query($sql);		 
						 } // end if
						 
			       } // end while

					 $success = sprintf(__("%d new subscribers imported.", 'bftpro'), $total);			
					 if($invalid) $success  .= '<br>'.sprintf(__('The following %d emails are invalid and were not imported: %s', 'bftpro'), 
						 $invalid, implode(', ', $invalid_emails));     
			       
				} // end if
			}		
		
			require(BFTPRO_PATH."/views/list-import.php");
		break;
		
		case 'list':
			$orderby=empty($_GET['ob'])?"name":$_GET['ob'];
			$orderdir=empty($_GET['dir'])?"ASC":$_GET['dir'];
			$offset = empty($_GET['offset'])?0:$_GET['offset'];
					
			if(!empty($_GET['export'])) {
				$newline=bftpro_define_newline();
				list($users, $cnt_users)=$_user->select($list->id, $orderby, $orderdir);
				
				// select fields
				$fields=$_field->select($list->id);
				
				$titlerow=__("Email", 'bftpro').";".__("Name", 'bftpro').";".__("Date Signed", 'bftpro').";".__("Status", 'bftpro').";";
				foreach($fields as $field) $titlerow.=$field->label.";";
				
				
				$rows=array($titlerow);
				foreach($users as $user) {
					$row=$user['email'].";".$user['name'].";".$user['date'].";".($user['status']?__("Active", 'bftpro'):__("Inactive", 'bftpro')).";";
					
					foreach($fields as $field) $row .= @$user["field_".$field->id].";";
					
					$rows[]=$row;					
				}
				
				$csv=implode($newline, $rows);
				
				// credit to http://yoast.com/wordpress/users-to-csv/	
				$now = gmdate('D, d M Y H:i:s') . ' GMT';

				header('Content-Type: ' . bftpro_get_mime_type());
				header('Expires: ' . $now);
				header('Content-Disposition: attachment; filename="subscribers.csv"');
				header('Pragma: no-cache');
				echo $csv;
				exit;				
			}	
			
			// mass delete			
			if(!empty($_POST['mass_delete']) and is_array($_POST['ids'])) {
				foreach($_POST['ids'] as $id) {					
					$_user->delete($id);	
				}
			}
		
			$limit=20;
			if(!empty($_GET['filter_status']) and $_GET['filter_status'] == -2) $unsubscribed_filter = true;
			list($users, $cnt_users)=$_user->select($list->id, $orderby, $orderdir, $offset, $limit);
			
			// select sentmails and readmails to calculate open rate
			$sent_mails = $wpdb->get_results("SELECT COUNT(id) as cnt, user_id FROM ".BFTPRO_SENTMAILS." WHERE errors='' GROUP BY user_id");
			$read_mails =  $wpdb->get_results("SELECT COUNT(id) as cnt, user_id FROM ".BFTPRO_READMAILS." GROUP BY user_id");
			$read_nls =  $wpdb->get_results("SELECT COUNT(id) as cnt, user_id FROM ".BFTPRO_READNLS." GROUP BY user_id");
			
			$uids = array(0);
			foreach($users as $cnt => $user) {
				$uids[] = $user['id'];
				$num_sent = $num_read = 0;
				foreach($sent_mails as $sent_mail) {
					if($sent_mail->user_id == $user['id']) $num_sent += $sent_mail->cnt;
				}
				foreach($read_mails as $read_mail) {
					if($read_mail->user_id == $user['id']) $num_read += $read_mail->cnt;
				}
				foreach($read_nls as $read_nl) {
					if($read_nl->user_id == $user['id']) $num_read += $read_nl->cnt;
				}
				
				$open_rate = empty($num_sent) ? 0 : round( 100 * $num_read / $num_sent);
				
				$users[$cnt]['num_sent'] = $num_sent;
				$users[$cnt]['num_read'] = $num_read;
				$users[$cnt]['open_rate'] = $open_rate;
			} // end foreach user
			
			// select custom data if any			
			$datas = $wpdb->get_results($wpdb->prepare("SELECT tD.data as data, tD.user_id as user_id, 
				tD.field_id as field_id, tF.label as label, tF.ftype as ftype, tF.field_date_format as field_date_format 
				FROM ".BFTPRO_DATAS." tD JOIN ".BFTPRO_FIELDS." tF ON tF.id = tD.field_id
				WHERE tD.user_id IN (".implode(",", $uids).") AND tD.list_id=%d
				ORDER BY tF.name", $list->id));
				
			if(sizeof($datas)) {
				foreach($users as $cnt=>$user) {
					$custom_data = '';
					foreach($datas as $data) {
						if($data->user_id == $user['id']) {
							$data->data = BFTProField :: friendly($data->ftype, $data->data, $data->field_date_format);
							$custom_data .= sprintf(__("<b>%s:</b> %s<br>", 'bftpro'), $data->label, stripslashes($data->data));
						}
					} // end foreach data
					
					$users[$cnt]['custom_data'] = $custom_data;
				} // end foreach booking
			} // end if custom data		
			

			// are there any filters? Used to know whether to display the filter box
			$any_filters = false;
			if(!empty($_GET['filter_email']) or !empty($_GET['filter_name']) or !empty($_GET['filter_ip'])
				or (isset($_GET['filter_status']) and intval($_GET['filter_status'])!=-1) 
				or !empty($_GET['readmails_from']) or !empty($_GET['readmails_to'])
				or (isset($_GET['clicks_from']) and $_GET['clicks_from']!=='')
				or (isset($_GET['clicks_to']) and $_GET['clicks_to']!=='')) {
					$any_filters = true;
			}
			
			require(BFTPRO_PATH."/views/list-users.php");
		default:
		break;
	}
}

function bftpro_fields() {
	global $wpdb;
	require(BFTPRO_PATH."/models/field.php");
	require_once(BFTPRO_PATH."/models/list.php");
	$_field=new BFTProField();
	$_list=new BFTProList();
	
	// select this mailing list
	$list=$_list->select($_GET['list_id']);
	
	switch(@$_GET['do']) {
		case 'add':
			if(!empty($_POST['ok'])) {
				$_POST['list_id']=$list->id;
				$_field->add($_POST);
				bftpro_redirect("admin.php?page=bftpro_fields&list_id={$list->id}&message=added");
			}
			
			require(BFTPRO_PATH."/views/list-field.php");
		break;

		case 'edit':
			if(!empty($_POST['del'])) {
				$_field->delete($_GET['id']);
				bftpro_redirect("admin.php?page=bftpro_fields&list_id={$list->id}&message=deleted");				
			}		
		
			if(!empty($_POST['ok']))
			{
				$_field->save($_POST, $_GET['id']);
				bftpro_redirect("admin.php?page=bftpro_fields&list_id={$list->id}&message=saved");
			}		
		
			$field=$_field->select($list->id, $_GET['id']);
			require(BFTPRO_PATH."/views/list-field.php");
		break;		
		
		default:
			$fields=$_field->select($list->id);
			require(BFTPRO_PATH."/views/list-fields.php");
		break;
	}	
}