<?php
class BFTProList {
	// select mailing lists along with num ARs and num subscribers
	function select($id=0) {
		global $wpdb;		
		
		$id_sql="";
		if($id) {			
			$id_sql=$wpdb->prepare(" AND id=%d ", $id);
		}				
		
		$lists=$wpdb->get_results("SELECT tL.*, (SELECT COUNT(tA.id) FROM ".BFTPRO_ARS." tA WHERE list_ids LIKE CONCAT('%|', tL.id, '|%')) 
			as responders, (SELECT COUNT(tU.id) FROM ".BFTPRO_USERS." tU WHERE list_id=tL.id) as subscribers 
			FROM ".BFTPRO_LISTS." tL WHERE id>0 $id_sql ORDER BY name");
		
		if($id) return @$lists[0];	
			
		return $lists;
	}
	
	// adds a mailing list
	function add($vars) {
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_LISTS." SET
		name=%s, description=%s, date=%s, do_notify=%d, notify_email=%s, redirect_to=%s, redirect_confirm=%s, 
		unsubscribe_notify=%d, confirm_email_subject=%s, confirm_email_content=%s, unsubscribe_text=%s, require_recaptcha=%d,
		optin=%d, sender=%s, require_name=%d, auto_subscribe=%s, require_text_captcha=%d, 
		subscribe_to_blog=%d, signup_graphic=%s", 
		@$vars['name'], @$vars['description'], date("Y-m-d"), @$vars['do_notify'], 
		@$vars['notify_email'], @$vars['redirect_to'], @$vars['redirect_confirm'], @$vars['unsubscribe_notify'], 
		@$vars['confirm_email_subject'], 	@$vars['confirm_email_content'], @$vars['unsubscribe_text'], 
		@$vars['require_recaptcha'], @$vars['optin'], @$vars['sender'], @$vars['require_name'], @$vars['auto_subscribe'], 
		@$vars['require_text_captcha'], @$vars['subscribe_to_blog'], @$vars['signup_graphic']));
		
		return $wpdb->insert_id;
	}
	
	function save($vars, $id) {
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_LISTS." SET
			name=%s, description=%s, do_notify=%d, notify_email=%s, redirect_to=%s, redirect_confirm=%s, 
			unsubscribe_notify=%d, confirm_email_subject=%s, confirm_email_content=%s, unsubscribe_text=%s, 
			require_recaptcha=%d, optin=%d, sender=%s, require_name=%d, auto_subscribe=%s, 
			require_text_captcha=%d, subscribe_to_blog=%d, signup_graphic=%s
			WHERE id=%d", @$vars['name'], @$vars['description'], @$vars['do_notify'], @$vars['notify_email'],
			@$vars['redirect_to'], @$vars['redirect_confirm'], @$vars['unsubscribe_notify'], @$vars['confirm_email_subject'],
			@$vars['confirm_email_content'], @$vars['unsubscribe_text'], @$vars['require_recaptcha'], 
			@$vars['optin'], @$vars['sender'], @$vars['require_name'], @$vars['auto_subscribe'], 
			@$vars['require_text_captcha'], @$vars['subscribe_to_blog'], @$vars['signup_graphic'], $id));
			
		return true;	
	}
	
	function delete($id) {
		// delete this mailing list + all subscribers
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_LISTS." WHERE id=%d", $id));
		
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_USERS." WHERE list_id=%d", $id));
	}
	
	// outputs extra fields on registration form etc
	function extra_fields($list_id, $user=NULL, $visual_mode = null) {
		global $wpdb;
				
		// select extra fields in the given list
		$fields=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_FIELDS." WHERE list_id=%d", $list_id));		
		if(empty($this->visual)) require(BFTPRO_PATH."/views/partial/list-fields.php");		
		else require(BFTPRO_PATH."/views/partial/list-fields-visual.php");
	}
	
	// generates the sign-up form for this list
	// will be used from widget, shortcode or template tag
	// $remote_placement is used when the form will be placed as HTML on other site
	function signup_form($list_id, $remote_placement=false, $visual_mode=false) {
		global $wpdb;
		
		if(empty($list_id)) $lists = $this->select();
		else $list = $this->select($list_id);
		
		if(!empty($list_id) and empty($list->id)) {
			_e('Invalid mailing list code', 'bftpro');
			return false;
		}
		
		if(!empty($list->require_recaptcha)) {
			$recaptcha_public = get_option('bftpro_recaptcha_public');
			$recaptcha_private = get_option('bftpro_recaptcha_private');
			
			if($recaptcha_public and $recaptcha_private) {
				require_once(BFTPRO_PATH."/recaptcha/recaptchalib.php");
				$recaptcha_html = recaptcha_get_html($recaptcha_public);
			}
		}
		
		if(!empty($list->require_text_captcha)) {
			$text_captcha_html = BFTProTextCaptcha :: generate();
		}
		
		// select extra fields in the given list
		$fields=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_FIELDS." WHERE list_id=%d", $list_id));		
		
		if($remote_placement) $form_action = BFTProList :: get_form_action();
				
		// include the form. allow styling
		if(empty($this->visual)) require(BFTPRO_PATH."/views/signup-form.php");
		else require(BFTPRO_PATH."/views/signup-form-visual.php");
	}
	
	// notify admin on suscribe and unsubscribe
	function notify_admin($user_id, $action) {
		global $wpdb;
		
		if($action=='unsubscribe') {			
			$user = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_USERS." WHERE id=%d", $user_id));
			$list = $this->select($user->list_id);
			$subject = __("A member unsubscribed.", 'bftpro');
			$message = __(sprintf("The member with email %s has unsubscribed from \"%s\"", $user->email, $list->name), 'bftpro');		
		}
		
		if($action=='register') {
			// get user along with data
			require_once(BFTPRO_PATH."/models/user.php");
			$_user = new BFTProUser();
			$users = $_user->select_receivers($wpdb->prepare(" AND id=%d ", $user_id), 1);
			$user=$users[0];
					
			$list = $this->select($user->list_id);			
			
			if(empty($user->id)) return false;			
			
			$subject = __("New member signed up", 'bftpro');
			$message = __(sprintf("New member signed up for your mailing list \"%s\"", $list->name), 'bftpro');
			$message = "<p>".$message."</p>";
			
			// user status, code and list_id and add all other member data
			$message .= __("Email: ", 'bftpro').$user->email."<br>";
			$message .= __("Name: ", 'bftpro').$user->name."<br>";
			$message .= __("IP: ", 'bftpro').$user->ip."<br>";
	
			foreach($user->pretty_fields as $key => $val) {
				$message.=$key.": ".$val."<br>";
			}
		}
		
		// now send		
		$_sender = new BFTProSender();
		// $_sender->debug = true;
		
		if(strstr($list->notify_email,  ",")) {
			$notify_emails = explode(",", $list->notify_email);
			$sender_email = get_option('bftpro_sender');
			foreach($notify_emails as $notify_email) {
				$_sender->send($sender_email, trim($notify_email), $subject, $message);
			}
		}
		else $_sender->send(get_option('bftpro_sender'), $list->notify_email, $subject, $message);
	}
	
	// this automatically subscribes users who login for the first time
	// for any mailing lists that have "auto-subscribe" selected
	static function auto_subscribe($user_login, $user) {
		global $wpdb;
		
		// if already logged in, return false to avoid needless queries
		if(get_user_meta($user->ID, 'bftpro_logged_in', true)) return false;
		
		require_once(BFTPRO_PATH."/models/user.php");
		$_user = new BFTProUser();
		
		add_user_meta( $user->ID, 'bftpro_logged_in', 1, true);
		
		// any lists that require auto-subscribe?
		$lists = $wpdb -> get_results("SELECT * FROM ".BFTPRO_LISTS." WHERE auto_subscribe='1'");
		$name = empty($user->first_name) ? $user->user_login : $user->first_name.' '.$user->last_name;

		foreach($lists as $list) {
			$vars = array("list_id"=>$list->id, "email"=>$user->user_email, "name"=>$name, "auto_subscribed"=>1);

			// fill any required fields with "1" to avoid errors			
			$fields=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_FIELDS." WHERE list_id=%d", $list->id));
			foreach($fields as $field) $vars['field_'.$field->id] = 1;
			
			// ignore exceptions
			try {
				$_user->subscribe($vars);
			}
			catch(Exception $e) {}
		}
	}
	
	// get random post for submit URL
	static function get_form_action() {		
		// I think the commented code below was needed only when we wrongly used "name" as field name?
		/*foreach ( get_posts ( array( 'numberposts' => 1, 'orderby' => 'rand' ) ) as $post ) { // wp query to get one post url on random basis
          $random_post = $post;
      }
      
      if(empty($random_post)) $form_action=site_url();
      else $form_action = get_permalink($post->ID);*/
       
       $form_action=site_url("/");
       return $form_action;  
	}
}