<?php
// main model containing general config and UI functions
class BFTPro {
   static function install($update = false) {
   	global $wpdb;	
   	$wpdb -> show_errors();
   	
   	if(!$update)  self::init();
   	
   	// subscribers - these do NOT need to be WP users
   	if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_USERS."'") != BFTPRO_USERS) {        
			$sql = "CREATE TABLE " . BFTPRO_USERS . " (
				  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  email VARCHAR(100) NOT NULL DEFAULT '',	
				  name VARCHAR(255)	NOT NULL DEFAULT '',		  
				  status TINYINT UNSIGNED NOT NULL DEFAULT 0,
				  date DATE NOT NULL DEFAULT '2000-01-01',
              ip VARCHAR(100) NOT NULL DEFAULT '',
				  code VARCHAR(10) NOT NULL DEFAULT '',
				  list_id INT UNSIGNED NOT NULL DEFAULT 0
				) DEFAULT CHARSET=utf8;";
			
			$wpdb->query($sql);
	  }
	  
	  // autoresponder mails
	  if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_MAILS."'") != BFTPRO_MAILS) {
	  
			$sql = "CREATE TABLE `" . BFTPRO_MAILS . "` (
				  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  `sender` VARCHAR(255) NOT NULL DEFAULT '',
				  `subject` VARCHAR(255) NOT NULL DEFAULT '',				  
				  `message` TEXT NOT NULL,		
				  `mailtype` VARCHAR(100) NOT NULL DEFAULT '',
				  `artype` VARCHAR(100) NOT NULL DEFAULT '',
				  `ar_id` INT UNSIGNED NOT NULL DEFAULT 0,    		  
				  `days` INT UNSIGNED NOT NULL DEFAULT 0,
              `send_on_date` DATE NOT NULL DEFAULT '2000-01-01',
              `every` VARCHAR(100) NOT NULL DEFAULT '',
              `daytime` INT UNSIGNED NOT NULL DEFAULT 0        
				) DEFAULT CHARSET=utf8;";			
			
			$wpdb->query($sql);
	  }
	  
	  // sent autoresponder mails (to avoid double sending)
	  if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_SENTMAILS."'") != BFTPRO_SENTMAILS) {
	  
			$sql = "CREATE TABLE `" . BFTPRO_SENTMAILS . "` (
				  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  `mail_id` INT UNSIGNED NOT NULL DEFAULT 0,			
				  `newsletter_id` INT UNSIGNED NOT NULL DEFAULT 0,
				  `user_id` INT UNSIGNED NOT NULL DEFAULT 0,				  
				  `date` DATE NOT NULL DEFAULT '2000-01-01'
				);";
			$wpdb->query($sql);
	  }
	  
	  // newsletters
	 if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_NEWSLETTERS."'") != BFTPRO_NEWSLETTERS) {
	  
			$sql = "CREATE TABLE `" . BFTPRO_NEWSLETTERS . "` (
				  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  `sender` VARCHAR(255) NOT NULL DEFAULT '',
				  `subject` VARCHAR(255) NOT NULL DEFAULT '',				  
				  `message` TEXT NOT NULL,		
				  `date_created` DATE NOT NULL DEFAULT '2000-01-01',
				  `list_id` INT UNSIGNED NOT NULL DEFAULT 0, 
				  `status` VARCHAR(100) NOT NULL DEFAULT 0, /* not sent, in progress or completed */
				  `last_user_id` INT UNSIGNED NOT NULL DEFAULT 0 /* sending to subscribers in the list ordered by ID. This stores the last sent-to ID */
				) DEFAULT CHARSET=utf8;";			
			
			$wpdb->query($sql);
	  }
	  	  
	  // autoresponder campaigns
 	  if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_ARS."'") != BFTPRO_ARS) {
	  
			$sql = "CREATE TABLE `" . BFTPRO_ARS . "` (
				  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  `name` varchar(255) NOT NULL DEFAULT '',
				  `list_ids` varchar(255) NOT NULL DEFAULT '',				  
				  `description` text NOT NULL,
				  `sender` varchar(255) NOT NULL DEFAULT '' COMMENT 'sender''s name and address'				  
				) DEFAULT CHARSET=utf8;";
			$wpdb->query($sql);
	  }
	  
	  // custom fields	  
 	  if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_FIELDS."'") != BFTPRO_FIELDS) {
	  
			$sql = "CREATE TABLE `" . BFTPRO_FIELDS . "` (
				  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  `name` varchar(100) NOT NULL DEFAULT '',
				  `ftype` varchar(100) NOT NULL DEFAULT '',
				  `fvalues` text NOT NULL,
				  `is_required` tinyint(3) unsigned NOT NULL DEFAULT 0,
				  `label` varchar(255) NOT NULL DEFAULT '',
				  `list_id` int(10) unsigned NOT NULL DEFAULT 0	  
				) DEFAULT CHARSET=utf8;";
			$wpdb->query($sql);
	  }
	  
	  // custom fields data 
	  if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_DATAS."'") != BFTPRO_DATAS) {
	  
			$sql = "CREATE TABLE `" . BFTPRO_DATAS . "` (
				  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  `field_id` int(10) unsigned NOT NULL DEFAULT 0,
				  `user_id` int(10) unsigned NOT NULL DEFAULT 0,
				  `data` text NOT NULL,
				  `list_id` int(11) NOT NULL DEFAULT 0
				) DEFAULT CHARSET=utf8;";
			$wpdb->query($sql);
			
			$sql = "ALTER TABLE `" . BFTPRO_DATAS . "` ADD UNIQUE (
				`field_id` ,
				`user_id` ,
				`list_id`
				)";
			$wpdb->query($sql);	
	  }
	  
	  // mailing lists
	   if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_LISTS."'") != BFTPRO_LISTS) {
	  
			$sql = "CREATE TABLE `" . BFTPRO_LISTS . "` (
				  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  `name` varchar(255) NOT NULL DEFAULT '',
				  `description` text NOT NULL,
				  `date` date NOT NULL DEFAULT '2000-01-01',
				  `do_notify` tinyint(3) unsigned NOT NULL DEFAULT 0,
				  `notify_email` varchar(100) NOT NULL DEFAULT '',
				  `redirect_to` varchar(255) NOT NULL DEFAULT '',
				  `redirect_confirm` varchar(255) NOT NULL DEFAULT '',
				  `unsubscribe_notify` tinyint(3) unsigned NOT NULL DEFAULT 0,
				  `confirm_email_subject` varchar(255) NOT NULL DEFAULT '',
				  `confirm_email_content` text NOT NULL,
				  `unsubscribe_text` text NOT NULL,
				  `require_recaptcha` tinyint(3) unsigned NOT NULL DEFAULT 0,
				  `optin` tinyint(3) unsigned NOT NULL DEFAULT 0				  
				) DEFAULT CHARSET=utf8;";
			$wpdb->query($sql);
	  }
	  
	  // read mails
	  if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_READMAILS."'") != BFTPRO_READMAILS) {
	  
			$sql = "CREATE TABLE `" . BFTPRO_READMAILS . "` (
				  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  `mail_id` int(10) unsigned NOT NULL DEFAULT 0,
				  `user_id` int(10) unsigned NOT NULL DEFAULT 0,
				  `date` date NOT NULL DEFAULT '2000-01-01',
				  UNIQUE KEY `mail_id` (`mail_id`,`user_id`)
				) DEFAULT CHARSET=utf8;";
			$wpdb->query($sql);
	  }
	  
	  // read newsletters
	  if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_READNLS."'") != BFTPRO_READNLS) {
	  
			$sql = "CREATE TABLE `" . BFTPRO_READNLS . "` (
				  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  `newsletter_id` int(10) unsigned NOT NULL DEFAULT 0,
				  `user_id` int(10) unsigned NOT NULL DEFAULT 0,
				  `date` date NOT NULL DEFAULT '2000-01-01',
				  UNIQUE KEY `mail_id` (`newsletter_id`,`user_id`)
				) DEFAULT CHARSET=utf8;";
			$wpdb->query($sql);
	  }
	  
	  // unsubscribings
	  if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_UNSUBS."'") != BFTPRO_UNSUBS) {
	  
			$sql = "CREATE TABLE `" . BFTPRO_UNSUBS . "` (
				  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
				  `email` varchar(100) NOT NULL DEFAULT '',
				  `list_id` int(10) unsigned NOT NULL DEFAULT 0,
				  `date` date NOT NULL DEFAULT '2000-01-01',
				  `ar_mails` smallint(5) unsigned NOT NULL DEFAULT 0
				) DEFAULT CHARSET=utf8;";
			$wpdb->query($sql);
	  }
	  
	  // daily logs
	  if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_LOGS."'") != BFTPRO_LOGS) {	  			
			$sql = "CREATE TABLE IF NOT EXISTS `".BFTPRO_LOGS."` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `date` date NOT NULL DEFAULT '2000-01-01',
			  `log` text NOT NULL,
			  PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8;";
			$wpdb->query($sql);
	  }
	  
		// attachments table added in 1.7	  
		if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_ATTACHMENTS."'") != BFTPRO_ATTACHMENTS) {	  			
			$sql = "CREATE TABLE IF NOT EXISTS `".BFTPRO_ATTACHMENTS."` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `mail_id` int(10) unsigned NOT NULL DEFAULT 0,
			  `nl_id` int(10) unsigned NOT NULL DEFAULT 0,
			  `file_name` VARCHAR(255) NOT NULL DEFAULT '',
			  `file_path` VARCHAR(255) NOT NULL DEFAULT '',
			  `url` VARCHAR(255) NOT NULL DEFAULT '',
			  PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8;";
			$wpdb->query($sql);
	  }
	  
	  if($wpdb->get_var("SHOW TABLES LIKE '".BFTPRO_BOUNCES."'") != BFTPRO_BOUNCES) {	  			
			$sql = "CREATE TABLE IF NOT EXISTS `".BFTPRO_BOUNCES."` (
			  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
			  `email` VARCHAR(255) NOT NULL DEFAULT '',
			  `x_id` VARCHAR(100) NOT NULL DEFAULT '',
			  `date` DATE,
			  PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8;";
			$wpdb->query($sql);
	  }
	  
	  $fields = array( 
	  	array("name"=>"mailtype", "type"=> "VARCHAR(255) NOT NULL NULL DEFAULT ''"),
	  	array("name"=>"date_last_sent", "type"=> "DATE")
	  	);
	  self::add_db_fields($fields, BFTPRO_NEWSLETTERS);	
	  
	  // add more new fields
	  $fields = array(
	  	  array("name"=>"sender", "type"=>"VARCHAR(255) NOT NULL DEFAULT ''"),
	  	  array("name"=>"require_name", "type"=>"TINYINT UNSIGNED NOT NULL DEFAULT 0"),
	  	  array("name"=>"auto_subscribe", "type"=>"VARCHAR(255) NOT NULL DEFAULT ''"), /* when subscribed in blog, subscribe here */
	  	  array("name"=>"require_text_captcha", "type"=>"TINYINT UNSIGNED NOT NULL DEFAULT 0"),
	  	  array("name"=>"subscribe_to_blog", "type"=>"TINYINT UNSIGNED NOT NULL DEFAULT 0"), /* when subscribed here, subscribe to blog */
		  array("name"=>"signup_graphic", "type"=>"VARCHAR(255) NOT NULL DEFAULT ''"), /* signup button graphic */
	  );
	  self::add_db_fields($fields, BFTPRO_LISTS);
	  
	  $fields = array(
	  	  array("name"=>"read_nls", "type"=>"INT UNSIGNED NOT NULL DEFAULT 0"),	  	  
		  array("name"=>"read_armails", "type"=>"INT UNSIGNED NOT NULL DEFAULT 0"),
		  array("name"=>"clicks", "type"=>"INT UNSIGNED NOT NULL DEFAULT 0"),
		  array("name"=>"auto_subscribed", "type"=>"TINYINT UNSIGNED NOT NULL DEFAULT 0"),
		  array("name"=>"unsubscribed", "type"=>"TINYINT UNSIGNED NOT NULL DEFAULT 0"),
	  );
	  self::add_db_fields($fields, BFTPRO_USERS);
	  
	  // let's also track sent newsletters
	  $fields = array(
	  	  array("name"=>"newsletter_id", "type"=>"INT UNSIGNED NOT NULL DEFAULT 0"),
	  	  array("name" => "errors", "type"=>"VARCHAR(100) NOT NULL DEFAULT ''") /*empty status means success*/
	  );
	  self::add_db_fields($fields, BFTPRO_SENTMAILS);
	  
	  $fields = array(
	  	  array("name"=>"field_date_format", "type"=>"VARCHAR(20) NOT NULL DEFAULT ''") // for date fields only	  	
	  );
	  self::add_db_fields($fields, BFTPRO_FIELDS);
	  
	  // versions under 2.2 need to update unsubscribed (but make sure it won't run on fresh install)
	  $version = get_option('bftpro_version');
	  if($version < 2.2) {
	  		$wpdb->query("UPDATE ".BFTPRO_USERS." SET unsubscribed=1
	  			WHERE CONCAT(email, '-', list_id) 
	  			IN (SELECT CONCAT(email, '-', list_id) FROM ".BFTPRO_UNSUBS.")"); 
	  }
	  
	  update_option( 'bftpro_version', "2.21");
	  
	  // if default sender is empty, use wp admin email
	  $sender=get_option( 'bftpro_sender' );
	  if(empty($sender))  {
	  		update_option('bftpro_sender', 'WordPress <'.get_option('admin_email').'>');
	  }
	  
	  // no mailing lists yet? create default
	  require_once(BFTPRO_PATH."/models/list.php");
	  $_list=new BFTProList();
	  $lists=$_list->select();
	  
	  if(!sizeof($lists)) {
	  		$_list->add(array("name"=>__("Default", 'bftpro'), "date"=>date("Y-m-d")));
	  }
	  
	  // default optin email subject & message
	  $optin_subject=get_option('bftpro_optin_subject');
	  if(empty($optin_subject))  {
	  		update_option('bftpro_optin_subject', 'Please confirm your email');
	  }
	  
	  $optin_message=get_option('bftpro_optin_message');
	  if(empty($optin_message)) {
	  		update_option('bftpro_optin_message', 'Please confirm your email by clicking on the link below:<br><br><a href="{{url}}">{{url}}</a>');
	  }
	  
	  update_option('bftpro_admin_notice', __('<b>Thank you for activating BroadFast PRO Autoresponder!</b> Please check our <a href="http://www.slideshare.net/pimteam/getting-started-with-broadfast-pro-for-wordpress" target="_blank">Quick getting started guide</a> and the <a href="http://localhost/wordpress/wp-admin/admin.php?page=bftpro_help">Help</a> page to get started!', 'bftpro'));
   }
      
   // main menu
   static function menu() {
   	$bftpro_caps = current_user_can('manage_options') ? 'manage_options' : 'bftpro_manage';
   	
   	add_menu_page(__('BroadFast PRO Autoresponder', 'bftpro'), __('BroadFast PRO Autoresponder', 'bftpro'), $bftpro_caps, "bftpro_options", array(__CLASS__, "options"));    
   	
   	add_submenu_page("bftpro_options",__('Settings', 'bftpro'), __('Settings', 'bftpro'), $bftpro_caps, "bftpro_options", array(__CLASS__, "options"));  		 	
  		add_submenu_page("bftpro_options",__('Mailing Lists', 'bftpro'), __('Mailing Lists', 'bftpro'), $bftpro_caps, "bftpro_mailing_lists", "bftpro_mailing_lists");  		  
  		add_submenu_page("bftpro_options",__('Autoresponder Campaigns', 'bftpro'), __('Autoresponder Campaigns', 'bftpro'), $bftpro_caps, "bftpro_ar_campaigns", array("BFTProARController", "manage"));
  		add_submenu_page("bftpro_options",__('Newsletters', 'bftpro'), __('Newsletters', 'bftpro'), $bftpro_caps, "bftpro_newsletters", array("BFTProNLController", "manage"));
  		add_submenu_page("bftpro_options",__('Bounce Handling', 'bftpro'), __('Bounce Handling', 'bftpro'), $bftpro_caps, "bftpro_bounce", array("BFTProBounceController", "options"));
  		add_submenu_page("bftpro_options",__('Subscribe by Email', 'bftpro'), __('Subscribe by Email', 'bftpro'), $bftpro_caps, "bftpro_subscribe_email", array("BFTProSubscribeEmailController", "options"));					
  		add_submenu_page("bftpro_options",__('Help', 'bftpro'), __('Help', 'bftpro'), $bftpro_caps, "bftpro_help", array(__CLASS__, "help"));
  		
  		do_action('bftpro_admin_menu');
  		
  		// hidden subpages (i.e. no sidebar menu link to them)
		add_submenu_page("bftpro_mailing_lists",__('Manage Subscribers', 'bftpro'), __('Manage Subscribers', 'bftpro'), $bftpro_caps, "bftpro_subscribers", "bftpro_subscribers");
		add_submenu_page("bftpro_mailing_lists",__('Manage Custom Fields', 'bftpro'), __('Manage Custom Fields', 'bftpro'), $bftpro_caps, "bftpro_fields", "bftpro_fields");  		  		
		add_submenu_page("bftpro_ar_campaigns",__('Manage Email Messages', 'bftpro'), __('Manage Email Messages', 'bftpro'), $bftpro_caps, "bftpro_ar_mails", array("BFTProARController", "mails"));
		
		add_submenu_page(NULL,__('Email Log', 'bftpro'), __('Email Log', 'bftpro'), $bftpro_caps, "bftpro_mail_log", array("BFTProARController", "log"));
		add_submenu_page(NULL,__('Newsletter Log', 'bftpro'), __('Newsletter Log', 'bftpro'), $bftpro_caps, "bftpro_nl_log", array("BFTProNLController", "log"));
		add_submenu_page(NULL,__('User Log', 'bftpro'), __('User Log', 'bftpro'), $bftpro_caps, "bftpro_user_log", array("BFTProUsers", "log"));
		add_submenu_page(NULL,__('Campaign Reports', 'bftpro'), __('Campaign Reports', 'bftpro'), $bftpro_caps, "bftpro_ar_report", array("BFTProReports", "campaign"));
		add_submenu_page(NULL,__('Newsletter Reports', 'bftpro'), __('Newsletter Reports', 'bftpro'), $bftpro_caps, "bftpro_nl_report", array("BFTProReports", "newsletter"));
		
		add_submenu_page(NULL,__('Integrate in Contact Form', 'bftpro'), __('Integrate in Contact Form', 'bftpro'), $bftpro_caps, "bftpro_integrate_contact", array("BFTProIntegrations", "contact_form"));
	}
	
	// CSS and JS
	static function scripts() {
		// CSS
		wp_register_style( 'bftpro-css', plugins_url('bft-pro/css/main.css'));
	   wp_enqueue_style( 'bftpro-css' );
   
   	// Thickbox CSS
      wp_register_style( 'thickbox-css', includes_url('js/thickbox/thickbox.css'));
	   wp_enqueue_style( 'thickbox-css' );
	   
	   // jQuery and Thickbox
	   wp_enqueue_script('jquery');
	   wp_enqueue_script('thickbox');
	   
	   // BFTPro's own Javascript
		wp_register_script(
				'bftpro-common',
				plugins_url().'/bft-pro/js/common.js',
				false,
				'1.0.3',
				false
		);
		wp_enqueue_script("bftpro-common");
		
		$translation_array = array('email_required' => __('Please provide a valid email address', 'bftpro'),
		'name_required' => __('Please provide name', 'bftpro'),
		'required_field' => __('This field is required', 'bftpro'),
		'missed_text_captcha' => __('You need to answer the verification question', 'bftpro'));	
		wp_localize_script( 'bftpro-common', 'bftpro_i18n', $translation_array );	
		
		// jQuery Validator
		wp_enqueue_script(
				'jquery-validator',
				'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js',
				false,
				'1.0.0',
				false
		);
	}
	
	// initialization
	static function init() {
		global $wpdb;
		load_plugin_textdomain( 'bftpro', false, BFTPRO_RELATIVE_PATH."/languages/" );
		
		define( 'BFTPRO_USERS', $wpdb->prefix. "bftpro_users" );
		define( 'BFTPRO_LISTS', $wpdb->prefix. "bftpro_lists" );
		define( 'BFTPRO_MAILS', $wpdb->prefix. "bftpro_mails" );
		define( 'BFTPRO_SENTMAILS', $wpdb->prefix. "bftpro_sentmails" );
		define( 'BFTPRO_NEWSLETTERS', $wpdb->prefix. "bftpro_newsletters" );
		define( 'BFTPRO_ARS', $wpdb->prefix. "bftpro_ars" ); // autoresponders
		define( 'BFTPRO_FIELDS', $wpdb->prefix. "bftpro_fields" );
		define( 'BFTPRO_DATAS', $wpdb->prefix. "bftpro_datas" );
		define( 'BFTPRO_READMAILS', $wpdb->prefix. "bftpro_readmails" );
		define( 'BFTPRO_READNLS', $wpdb->prefix. "bftpro_readnls" ); // read newsletters
		define( 'BFTPRO_UNSUBS', $wpdb->prefix. "bftpro_unsubs" );
		define( 'BFTPRO_LOGS', $wpdb->prefix. "bftpro_logs" ); // general daily logs  
		define( 'BFTPRO_ATTACHMENTS', $wpdb->prefix. "bftpro_attachments" );
		define( 'BFTPRO_BOUNCES', $wpdb->prefix. "bftpro_bounces" );
		
		define( 'BFTPRO_VERSION', get_option('bftpro_version'));
		
		add_shortcode( 'BFTPRO', array("BFTPro", "shortcode_signup") );		
		add_shortcode( 'bftpro', array("BFTPro", "shortcode_signup") );
		add_shortcode( 'bftpro-form-start', array("BFTProShortcodes", 'form_start'));
		add_shortcode( 'bftpro-field-static', array("BFTProShortcodes", 'static_field'));
		add_shortcode( 'bftpro-field', array("BFTProShortcodes", 'field'));
		add_shortcode( 'bftpro-form-end', array("BFTProShortcodes", 'form_end'));
		add_shortcode( 'bftpro-recaptcha', array("BFTProShortcodes", 'recaptcha'));
		add_shortcode( 'bftpro-text-captcha', array("BFTProShortcodes", 'text_captcha'));
		add_shortcode( 'bftpro-submit-button', array("BFTProShortcodes", 'submit_button'));
		add_shortcode( 'bftpro-int-chk', array("BFTProShortcodes", 'int_chk'));
		
		// hook tracker
		add_action('template_redirect', array('BFTProReport', 'track'));
		
		// add filters for double opt-in and unsubscribe		
		add_filter('query_vars', array("BFTPro", "query_vars"));
		add_action("template_redirect", array("BFTPro", "template_redirect"));
		
		// run cron from web?
		if(get_option('bftpro_cron_mode')=='web' or !empty($_GET['bftpro_cron'])) {			
			$_sender = new BFTProSender();
			$_sender->start_cron();
		}
		
		// contact form 7 integration
		add_filter( 'wpcf7_form_elements', array('BFTProContactForm7', 'shortcode_filter') );
		add_action( 'wpcf7_before_send_mail', array('BFTProContactForm7', 'signup') );
		
		if(BFTPRO_VERSION < 2.21) self :: install(true);
		
		add_action('admin_notices', array(__CLASS__, 'admin_notice'));
		
		add_action( 'phpmailer_init', array( __CLASS__, 'fix_return_path' ) );
	}
	
	static function admin_notice() {
		$notice = get_option('bftpro_admin_notice');
		if(!empty($notice)) {
			echo "<div class='updated'><p>".stripslashes($notice)."</p></div>";
		}
		// once shown, cleanup
		update_option('bftpro_admin_notice', '');
	}
	
	// parse short codes
	static function shortcode_signup($attr) {
		$list_id = @$attr[0];
		$remote_placement = empty($attr[1])?false:true;
		require_once(BFTPRO_PATH."/models/list.php");
		$_list = new BFTProList();
		
				
		ob_start();
		$_list->attr_mode = @$attr['mode'];
		$_list->signup_form($list_id, $remote_placement);
		$contents = ob_get_contents();
		ob_end_clean();
		
		return $contents;
	}
	
	// handle BFTPro vars in the request
	static function query_vars($vars)
	{
		$new_vars = array('bftpro_subscribe', 'bftpro_confirm', 'bftpro_rmvmmbr', 'bftpro_cron', 'bftpro_track');
		$vars = array_merge($new_vars, $vars);
	   return $vars;
	} 	
		
	// parse BFTPro vars in the request
	static function template_redirect() {		
		global $wp, $wp_query, $wpdb, $post;
		$redirect = false;		
		
		// subscribing to a list		
	   if( !empty( $wp->query_vars['bftpro_subscribe'] )) {
	   	$redirect = true;
	   	require_once(BFTPRO_PATH."/models/user.php");
	   	$_user = new BFTProUser();
	   		   	
	   	try {	   		
	   		$message="";
	   		$_user->subscribe($_POST, $message);	
	   		$title = __("Thank you!", 'bftpro');
	   		$template = 'bftpro-message.php';	
	   	}
	   	catch(Exception $e) {
	   		$message = $e->getMessage();
	   		$template = 'bftpro-error.php';	   		
	   	}
	   }
	   
	   if( !empty( $wp->query_vars['bftpro_confirm'] )) {
	   	$redirect = true;
	   	require_once(BFTPRO_PATH."/models/user.php");
	   	$_user = new BFTProUser();
	   	
	   	if($message = $_user->confirm()) {
	   		$title = __("Thank you!", 'bftpro');	   		
	   		$template = 'bftpro-message.php';	
	   	}
	   	else {
	   		$message = __("Sorry! The confirmation link is incorrect or expired.", 'bftpro');
	   		$template = 'bftpro-error.php';	   
	   	}
	   }
	   
	   if( !empty( $wp->query_vars['bftpro_rmvmmbr'] )) {
	   	$redirect = true;
	   	require_once(BFTPRO_PATH."/models/user.php");
	   	require_once(BFTPRO_PATH."/models/list.php");
	   	$_user = new BFTProUser();
	   	$_list = new BFTProList();
	   	
	   	// select user registrations with this email
			$error = false;
			
			$users = $wpdb -> get_results($wpdb->prepare("SELECT tU.*, tL.name as list_name 
			FROM ".BFTPRO_USERS." tU JOIN ".BFTPRO_LISTS." tL ON tL.id = tU.list_id
				WHERE email LIKE %s ORDER BY tL.name", $_GET['email']));
			if(!sizeof($users)) {
				$message = __('There is no subscriber with this email address', 'bftpro');
				$error = true;
			}
	   	
	   	
	   	if($error) $template = 'bftpro-error.php';
	   	else {
	   		// all OK
		   	if(!empty($_POST['ok']) and is_array($_POST['list_ids'])) {
		   		foreach($users as $user) {
		   			if(in_array($user->list_id, $_POST['list_ids'])) $_user->unsubscribe($user);
		   		}		
		   		$title = __("Thank you.", 'bftpro');
		   		$message = __("You have been unsubscribed.", 'bftpro');
		   		$template = 'bftpro-message.php';
			   }
			   else $template = 'bftpro-unsubscribe.php';
			}
	   }
	   
	   if($redirect) {
	   	if(@file_exists(get_stylesheet_directory()."/".$template)) include get_stylesheet_directory()."/".$template;		
			else include(BFTPRO_PATH."/views/templates/".$template);
			exit;
	   }	   
	}	
			
	// manage general options
	static function options() {
		global $wpdb, $wp_roles;
		$roles = $wp_roles->roles;		
		
		if(!empty($_POST['bftpro_options']) and check_admin_referer('save_options', 'nonce_options')) {
			update_option("bftpro_sender", $_POST['sender']);
			update_option("bftpro_signature", $_POST['signature']);
			update_option("bftpro_mails_per_run", $_POST['mails_per_run']);
			update_option("bftpro_mails_per_day", $_POST['mails_per_day']);
			update_option('bftpro_optin_subject', $_POST['optin_subject']);
			update_option('bftpro_optin_message', $_POST['optin_message']);
			update_option('bftpro_cron_mode', $_POST['cron_mode']);
			update_option('bftpro_cron_minutes', $_POST['cron_minutes']>=1?$_POST['cron_minutes']:1);
			update_option('bftpro_recaptcha_public', $_POST['recaptcha_public']);
			update_option('bftpro_recaptcha_private', $_POST['recaptcha_private']);
			update_option('bftpro_text_captcha', $_POST['text_captcha']);
			
			// roles that can manage the autoresponder
			if(current_user_can('manage_options')) {				
				foreach($roles as $key=>$role) {
					$r=get_role($key);
					
					if(@in_array($key, $_POST['manage_roles'])) {					
	    				if(!$r->has_cap('bftpro_manage')) $r->add_cap('bftpro_manage');
					}
					else $r->remove_cap('bftpro_manage');
				}
			}	
		}
		
		if(!empty($_POST['bftpro_uoptions']) and check_admin_referer('save_uoptions', 'nonce_uoptions')) {
			update_option('bftpro_cleanup_db', $_POST['cleanup_db']);
		}
		
		// copy data from lite?
		if(!empty($_POST['bftpro_copy_data'])) {
			// create mailing list
			require_once(BFTPRO_PATH."/models/ar.php");
			$_list = new BFTProList();
			$_ar = new BFTProARModel();
			$sender = get_option('bft_sender');			
			
			$lid = $_list->add(array("name"=>__('Imported from BFT Lite', 'bftpro'), "optin"=>get_option('bft_optin'), "sender" => $sender));
			
			// select subscribers
			$users = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}bft_users ORDER BY id");
			
			// insert them and update their new ID
			foreach($users as $cnt=>$user) {
				$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_USERS." SET email=%s, name=%s, status=%d, date=%s, ip=%s, code=%s, list_id=%d", 
					$user->email, $user->name, $user->status, $user->date, $user->ip, $user->code, $lid));
				$new_id = $wpdb->insert_id;
				$users[$cnt]->new_id = $new_id;	
			}
			
			// insert AR mails and update their ID
			$arid = $_ar->add(array("name"=>__('BFT Lite Autoresponder Sequence', 'bftpro'), "list_ids"=>array($lid), "sender"=>$sender));
					
			$mails = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}bft_mails ORDER BY id");
			
			foreach($mails as $mail) {
				$artype = empty($mail->send_on_date) ? 'days' : 'date';				
				
				$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_MAILS." SET 
					sender=%s, subject=%s, message=%s, mailtype='text/html', artype=%s, ar_id=%d, days=%d, send_on_date=%s",
					$sender, $mail->subject, $mail->message, $artype, $arid, $mail->days, $mail->date));
				$new_id = $wpdb->insert_id;
				
				// now transfer sent mails
				$sent_mails = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$wpdb->prefix}bft_sentmails 
					WHERE mail_id=%d ORDER BY id", $mail->id));	
					
				foreach($sent_mails as $sent_mail) {
					// find out the corresponding user ID
					$user_id = 0;
					foreach($users as $user) {
						if($user->id == $sent_mail->user_id) {
							$user_id = $user->new_id;
							break;
						}
					}					
					
					$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_SENTMAILS." SET mail_id=%d, user_id=%d, date=%s",
						$new_id, $user_id, $sent_mail->date));
				}	// end foreach sent mail
			} // end foreach $mail
			
			bftpro_redirect("admin.php?page=bftpro_mailing_lists");
		} // end copy from BFT Lite
		
		$cron_mode = get_option('bftpro_cron_mode');
		$text_captcha = get_option('bftpro_text_captcha');
		
		// check the last cron run
		$last_cron_run = get_option('bftpro_last_cron_run');
		// let's give some time without showing warnings to these who just installed 		
		if(empty($last_cron_run)) {
			$last_cron_run = time() - 12*3600;
			update_option('bftpro_last_cron_run', $last_cron_run);
		}
		if( $cron_mode == 'real' and time() > ($last_cron_run + 24*3600) ) $cron_warning = true; 
		
		// load 3 default questions in case nothing is loaded
		if(empty($text_captcha)) {
			$text_captcha = __('What is the color of the snow? = white', 'bftpro').PHP_EOL.__('Is fire hot or cold? = hot', 'bftpro') 
				.PHP_EOL. __('In which continent is France? = Europe', 'bftpro'); 
		}
		require(BFTPRO_PATH."/views/options.php");
	}	
	
	static function help() {
		$tab = empty($_GET['tab']) ? 'main' : $_GET['tab'];
		
		switch($tab) {
			case 'error_log':
				BFTProHelp :: error_log();
			break;
			default:
				BFTProHelp :: help_main();				
			break;
		}		
	}	
	
	static function register_widgets() {
		register_widget('BFTProWidget');
	}
	
	// to allow using as template tag
	static function signup_form($list_id) {
		require_once(BFTPRO_PATH."/models/list.php");
		$_list = new BFTProList();
		$_list->signup_form($list_id);
	}
	
	// logs a log
	static function log($logtext) {
		global $wpdb;
		// today's log available?
		$log = $wpdb->get_row("SELECT * FROM ".BFTPRO_LOGS." WHERE date='".date('Y-m-d')."'");
		if(!empty($log->id)) {
				$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_LOGS." SET log=CONCAT(log, '\n', %s) WHERE id=%d",
					$logtext, $log->id));
		}
		else {
			 $wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_LOGS." SET
			 		date='".date('Y-m-d')."', log=%s", $logtext));
		}
		
		// delete logs older than 3 months
		$wpdb->query("DELETE FROM ".BFTPRO_LOGS." WHERE date < CURDATE() - INTERVAL 3 MONTH");
	}
	
	// conditionally adds DB field, if it's not in the DB already
	static function add_db_fields($fields, $table) {
		global $wpdb;
		
		// check fields
		$table_fields = $wpdb->get_results("SHOW COLUMNS FROM `$table`");
		$table_field_names = array();
		foreach($table_fields as $f) $table_field_names[] = $f->Field;		
		$fields_to_add=array();
		
		foreach($fields as $field) {
			 if(!in_array($field['name'], $table_field_names)) {
			 	  $fields_to_add[] = $field;
			 } 
		}
		
		// now if there are fields to add, run the query
		if(!empty($fields_to_add)) {
			 $sql = "ALTER TABLE `$table` ";
			 
			 foreach($fields_to_add as $cnt => $field) {
			 	 if($cnt > 0) $sql .= ", ";
			 	 $sql .= "ADD $field[name] $field[type]";
			 } 
			 
			 $wpdb->query($sql);
		}
	}
	
	// fix phpmailer return path
	static function fix_return_path($phpmailer) {
		$return_path = get_option('bftpro_bounce_email');
		if(empty($return_path)) $return_path = get_option( 'bftpro_sender' );
		
		// extract only email address from the return path. 
		// Otherwie for some damn reason it gives errors on some hosts		
		if(strstr($return_path, '<')) {
			$parts = explode('<', $return_path);
			$return_path = str_replace('>', '', $parts[1]);
		} 
		
		$phpmailer->Sender = $return_path;
	}
}