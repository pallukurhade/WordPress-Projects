<?php
// handle subscribing by sending email
class BFTProSubscribeEmailController {
	static function options() {
		global $wpdb;
		
		if(!empty($_POST['ok'])) {
			$lists = array();
			if(!empty($_POST['list_ids'])) {
				foreach($_POST['list_ids'] as $lid) {
					$lists[$lid] = array("subject_contains" => $_POST['subject_contains_'.$lid],
						"ignore_optin" => @$_POST['ignore_optin_'.$lid]);
				}
			}
			
			$options = array("lists" => $lists);
			$options['email'] = $_POST['email'];
			$options['host'] = $_POST['host'];
			$options['port'] = $_POST['port'];
			$options['login'] = $_POST['login'];
			$options['pass'] = $_POST['pass'];
			
			update_option('bftpro_signup_by_email', $options); 
		}		
		
		$options = get_option('bftpro_signup_by_email');
		
		// select mailing lists
		$lists = $wpdb->get_results("SELECT * FROM ".BFTPRO_LISTS." ORDER BY name");
		
		include(BFTPRO_PATH."/views/subscribe-email-options.html.php");
	}
	
	// this is called by the cron job - checks for signups once per day	
	static function handle_signups() {
		global $wpdb;
		// thanks to http://plugins.svn.wordpress.org/bounce/trunk/bounce.php
		$handle_options = get_option('bftpro_signup_by_email');
		if(empty($handle_options['lists'])) return false;
		
		// already handled today? 
		$last_signup_handling = get_option('bftpro_last_signup_handling');
		if(!empty($last_signup_handling) and $last_signup_handling == date('Y-m-d')) return false;
		update_option('bftpro_last_signup_handling', date('Y-m-d'));		
			
		require_once(ABSPATH . WPINC . '/class-pop3.php');
  		$pop3 = new POP3();
  		$host = $handle_options['host'];
		$port = $handle_options['port'];
		$login = $handle_options['login'];
		$pass = $handle_options['pass'];
  		
  		if (!$pop3->connect($host, $port) || !$pop3->user($login)) {
		    throw new Exception('Unable to connect for collecting signups by email: ' . $pop3->ERROR);
		}
		
		$count = $pop3->pass($pass);
		
		if (false === $count) {      
      	throw new Exception('Unable to authenticate for collecting signups by email: ' . $pop3->ERROR);
      } 
      
      // now get messages
      $week_ago = time() - 7*24*3600;
      $messages = array();
      for ($i = 1; $i <= $count; $i++) {
        $message = $pop3->get($i);
        $from_email = $from_name = $subject = '';
        $this_message = array();
        
        foreach($message as $cnt=>$line) {
        	  // extract date and don't check messages older than 1 week
        	  if(preg_match("/^Date\:/", $line)) {
        	  	  $date = trim(substr($line, 6));
        	  	  $time = strtotime($date);
        	  	  
        	  	  if($time < $week_ago) continue;     
        	  	  
        	  	  $this_message['date'] = date("Y-m-d", $time);   	  	  
        	  }
        	  
        	  // extract from address and name
        	  if(preg_match("/^From\:/", $line)) {
        	  	  $from = trim(substr($line,6));
        	  	  //echo $from. " extracted from $line\n";        	  	  
        	  	  if(!strstr($from, '@')) {
        	  	  	  // maybe the email is on the next line? Sometimes From: contains two lines
        	  	  	  $from .= $message[$cnt+1];        	  	  	  
        	  	  }
        	  	  
        	  	  // not valid email
        	  	  if(!strstr($from, '@')) continue;
        	  	  
        	  	  if(!strstr($from, '<')) {
        	  	  		// only email address has been sent
        	  	  		$from_email = $from;
        	  	  		//echo "A from email: $from_email\n";
        	  	  		$this_message['from_email'] = $from_email;
				  }
				  else {
				  	  // from name and email
				  	  list($from_name, $from_email) = explode('<', $from);
				  	  $from_email = str_replace('>', '', $from_email);
				  	  $from_name = str_replace('"', '', $from_name);
				  	  //echo "B from email: $from_email\n";
				  	  $this_message['from_email'] = $from_email;
				  	  $this_message['from_name'] = $from_name;
				  }
        	  } // end parsing from
        	  
        	  // parse subject - line starts with Subject: 
        	  if(preg_match("/^Subject\:/", $line)) {
        	  	  $subject = trim(substr($line, 8));
        	  	  // make sure to use only the first occurence of Subject: in the message        	  	  
        	  	  if(empty($this_message['subject'])) $this_message['subject'] = $subject;   	  	  
        	  }
		  } // end foreach line in the message
		  
		  if(!empty($this_message['date']) and !empty($this_message['from_email'])) $messages[] = $this_message;
      } // end foreach message
      
      // print_r($messages);

      // Reset the connection
      $pop3->reset();
      
      // now go through messages and lists and figure out which has to be signed up where
      $_user = new BFTProUser();      
      foreach($handle_options['lists'] as $lid => $list) {
      	$unique_emails = array(); // re-create the array for each list
      	foreach($messages as $message) {
      		if(!empty($list['subject_contains'])) {
      			if(!stristr($message['subject'], $list['subject_contains'])) continue;
      		}
      		
      		// avoid unnecessary queries
      		if(in_array($message['from_email'], $unique_emails)) continue; 
      		$unique_emails[] = $message['from_email'];
      		
      		// now subscribe user and if required ignore double opt-in settings
      		$vars = array();
      		$vars['status'] = $list['ignore_optin'];      		
      		$vars['email'] = trim($message['from_email']);
      		$vars['name'] = trim($message['from_name']);
      		$vars['list_id'] = $lid;
      		$msg="";
      		$_user->subscribe($vars, $msg, 1);
			}
		} // end foreach list

	} // end handle signups by email
}