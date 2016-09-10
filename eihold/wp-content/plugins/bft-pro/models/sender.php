<?php
// the class that sends emails
class BFTProSender {
	function __construct() {
		global $wpdb;
		
		// let's save a  bunch of queries every time. When starting the cron we'll select all current lists 
		// along with any custom fields that could be there		
		$this->lists = $wpdb->get_results("SELECT * FROM ".BFTPRO_LISTS." ORDER BY id");
		$fields = $wpdb->get_results("SELECT * FROM ".BFTPRO_FIELDS." ORDER BY id");
		foreach($this->lists as $cnt=>$list) {
			 $this->lists[$cnt]->fields = array();
			 foreach($fields as $field) {
			 	  if($field->list_id == $list->id) $this->lists[$cnt]->fields[] = $field;
			 }
		}
		
		$this->debug = get_option('bftpro_debug_mode');
	}			
	
	// replacing static and dynamic masks in text
	function replace_masks($text, $receiver, $list) {
		 $text = str_replace("{{firstname}}", $receiver->firstname, $text);
		 $text = str_replace("{{name}}", $receiver->name, $text);
		 $text = str_replace("{{email}}", $receiver->email, $text);
		 $dateformat = get_option('date_format');
		 foreach($list->fields as $field) {
		 	  if(strstr($text, "{{".$field->name."}}")) {
		 	  	 foreach($receiver->fields as $key => $data) {
		 	  	 		if($key == $field->id) {
		 	  	 			if($field->ftype == 'date') {
		 	  	 				// handle dates entered without year
		 	  	 				if(preg_match("/^1900/", $data)) {
		 	  	 					$dateformat = str_ireplace("y", '', $dateformat);
		 	  	 					$data = str_replace("1900", date("Y"), $data);
		 	  	 				}
		 	  	 				$text = str_replace("{{".$field->name."}}", date($dateformat, strtotime($data)), $text);
		 	  	 			}
		 	  	 			else $text = str_replace("{{".$field->name."}}", $data, $text);
		 	  	 		}
		 	  	 }
		 	  }
		 }
		 
		 return $text;
	}	
		
	// adds unsubscribe link
	function add_unsubscribe_link($receiver, $mailtype, $list) {
		 $url = site_url("/?bftpro_rmvmmbr=1&email={$receiver->email}&list_id={$list->id}");	
			
		 if($mailtype=='text/html' or $mailtype=='both') {
            $unsub="<br><br>-------------------<br>";
            
            if($list->unsubscribe_text) $unsub.=wpautop($list->unsubscribe_text);
            else $unsub.=__("To unsubscribe from this list please click the link below:", 'bftpro');               
                        
            $unsub.="<br /><a href=$url>$url</a>";
      }      
      else {
            $unsub="\n\n-------------------\n";
            
            if($list->unsubscribe_text) $unsub.=$list->unsubscribe_text;
            else $unsub.=__("To unsubscribe from this list please click the link below:", 'bftpro');            
            
            $unsub.=$url;
      }      
      
      return $unsub;
	}	
	
	// customizes the email with the masks etc
	// adds unsubscribe and other links
	function customize($mail, $receiver) {
		 global $wpdb;
		 $subject = $mail->subject;
		 $message = $mail->message;
		 
		 // find list and custom fields if any		 
		 $list=null;
		 foreach($this->lists as $l) {
		 	 if($l->id == $receiver->list_id) $list = $l;
		 }
		 
		 if(!$list) return array("","");
		 
		 // extracts or sets a "firstname" field regardless the fact it does not exist
		 if(strstr($receiver->name," ")) {
				$parts=explode(" ",$receiver->name);
				$receiver->firstname=$parts[0];
		 }
		 else $receiver->firstname=$receiver->name;
		 
		 // now replace masks
		 $subject = $this->replace_masks($subject, $receiver, $list);
		 $message = $this->replace_masks($message, $receiver, $list);
		 
		 
		 // add signature if any
		 if(!isset($this->signature)) $this->signature = stripslashes(get_option('bftpro_signature'));
		 if(!empty($this->signature)) {
		 		if($mail->mailtype=='text/html' or $mail->mailtype=='both') {
		 			 $message.="<p>&nbsp;</p>".$this->signature;
		 		}
		 		else $message.="\n\n".$this->signature;
		 }
		 
 		 // add unsubscribe link
	   $message.=$this->add_unsubscribe_link($receiver, $mail->mailtype, $list); 
	   
	   // add tracking code
	   $type = isset($mail->artype) ? 'ar' : 'nl';
	   if($mail->mailtype!='text/plain') $message .= "\n<img src='".site_url("?bftpro_track=1&id=".$mail->id."&uid=".$receiver->id."&type=".$type)."' width='1' height='1' border='0'>";
	   
		 if(class_exists('BFTISender')) $message = apply_filters('bftpro_message_filters', $message, $type, $mail->id, $receiver->id);		 
		 if(class_exists('BFTISender')) $subject = apply_filters('bftpro_subject_filters', $subject, $type, $mail->id, $receiver->id);
		 if(class_exists('BFTISegment') and !BFTISegment :: apply_segments($mail, $receiver)) {
		 		return array('', ''); // blank out subject & message so it won't be sent
		 }
		 if(class_exists('BFTISender')) $message = apply_filters('bftpro_template_filter', $message, $mail->template_id);
		 
		 // return		 
		 return array(stripslashes($subject), stripslashes($message));
	}
	
	// actually sends email and marks it as sent
	function send($sender, $receiver, $subject, $message, $ctype = 'text/html', $attachments = NULL) {
		// if both subject and message are empty this means the email has been filtered out by segmentation
		// or something else and should not be sent. We shouldn't send empty emails anyway.
		if(empty($subject) and empty($message)) return false;
		
		// check if $this->mails_left is set. if so, check if we can send more mails
		if(isset($this->mails_left) and empty($this->mails_left)) throw new Exception("No more mails can be sent");
				
		// update today's mails and $this->total_emails_sent
		$this->today_mails++;
		$this->total_mails_sent++;
		
		$plain_text = strip_tags(str_replace("<br>", "\n", $message));
		
		// handle text-only and "both" mail types
		if($ctype=='text/plain') $message = $plain_text;
		else $message=wpautop($message);
				
		if($ctype=='both') {
			// thanks to http://www.tek-tips.com/faqs.cfm?fid=2681	
				
			$semi_rand = md5(time());
			$mime_boundary = "==MULTIPART_BOUNDARY_$semi_rand";
			$mime_boundary_header = chr(34) . $mime_boundary . chr(34);
			
			// construct the body
			$body = "This is a multi-part message in MIME format.

			--$mime_boundary
			Content-Type: text/plain; charset=\"UTF-8\"
			Content-Transfer-Encoding: 8bit
			
			$plain_text
			
			--$mime_boundary
			Content-Type: text/html; charset=utf8
			Content-Transfer-Encoding: 8bit
			
			$message
			
			--$mime_boundary--";
			
			$body = str_replace("\t", "" ,$body);
			
			// now replace the vars
			$message = $body;
			$ctype = "multipart/alternative;\n" . 
      "     boundary=" . $mime_boundary_header;			
		}
		
		// set return-path
		if(empty($this->return_path)) $this->return_path = $sender;
		
		$headers=array();
		$headers[] = "Content-Type: $ctype";
		$headers[] = 'From: '.$sender;
		$headers[] = 'Return-Path: '.$this->return_path;
		$headers[] = 'sendmail_from: '.$sender;
		$headers[] = 'X-Bftpro-b: '.$receiver;
		$headers[] = 'X-Bftpro-id: '.md5(microtime().$receiver).'-'.$receiver;
		
		// $this->debug = true;
		if(!empty($this->debug)) {
  	   	 echo "FROM: $sender<br>";
  	   	 echo "TO: $receiver<br>";
			 echo "SUBJECT: $subject<br>";
			 echo "MESSAGE: $message<br>";
		}		
		
		// update today mails
		$today_mails = get_option('bftpro_today_mails');
		$new_today_mails = intval($today_mails + 1);		
		update_option('bftpro_today_mails', $new_today_mails);
				
		// prepare attachments if any	
		if($attachments and is_array($attachments)) {
			$atts = array();
			foreach($attachments as $attachment) $atts[] = $attachment->file_path;
			$attachments = $atts;
		}
		 
		$message = do_shortcode($message);
		// echo $message;
		$result = wp_mail($receiver, $subject, $message, $headers, $attachments);				
		
		// error from phpmailer
		if(!$result) {
			 if(empty($this->phpmailer_errors)) $this->phpmailer_errors = ' <br>'.__('The following errors occured when sending emails:', 'bftpro');
          $this->phpmailer_errors .= '<br>'.sprintf(__('Sending to %s returned error "%s". Please ensure the receiver email address is valid.', 'bftpro'), $receiver, $GLOBALS['phpmailer']->ErrorInfo)."<br>";
      }

		return $result;
	}
	
	// the cron job that gets emails from the queue and sends them
	function cron() {
		global $wpdb;
		
		$bounce_email = get_option('bftpro_bounce_email');
		if(!empty($bounce_email)) $this->return_path = $bounce_email;
		
		require_once(BFTPRO_PATH."/models/user.php");
		$_user = new BFTProUser();
		
		// see if the cron can run now	
		// 1. make sure there is no other instance running that's less than 5 minutes old
		// 2. respect 'cron minutes' option, minimum 1 minute
		// 3. if all is fine, mark the current  cron instance as running
		$last_cron_run=get_option('bftpro_last_cron_run');
		$cron_status=get_option('bftpro_cron_status');
		
		// 1
		if((time() - $last_cron_run) < 5*60 and $cron_status=='running') throw new Exception("Another instance running");
		
		// 2
		$cron_minutes = get_option('bftpro_cron_minutes');
		if(empty($cron_minutes)) $cron_minutes = 1;
		if((time() - $last_cron_run) < $cron_minutes * 60)  throw new Exception( "Starting too soon - we have a limit of $cron_minutes minutes" );
		
		// first cleanup bounces if required
		BFTProBounceController :: handle_bounces();
		
		// check subscribe by email
		BFTProSubscribeEmailController :: handle_signups();
		
		// now check if we are allowed to send more emails today
		$mails_per_day = get_option('bftpro_mails_per_day');
		$mails_per_day = $mails_per_day?$mails_per_day:100000;
		$cron_date = get_option('bftpro_cron_date');
		$this->today_mails = 0;
		$this->mails_left = $mails_per_day;	 // later updates to mails left for this run
			
		// ignore if $mails_per_day == 0	
		if($cron_date==date("Y-m-d") and $mails_per_day) {
			// this means we have recorded some emails sent today
			$this->today_mails = get_option('bftpro_today_mails');
			// echo $this->today_mails.'<br>';
			if($this->today_mails >= $mails_per_day) throw new Exception("Sent enough mails for today");
			$this->mails_left = $mails_per_day - $this->today_mails;
		} 
		else update_option('bftpro_cron_date', date('Y-m-d')); // set todays date as cron date
		
		// 3
		update_option('bftpro_last_cron_run', time());
		update_option('bftpro_cron_status', 'running');	
		
		// mails per run start counting the emails
		// no matter what, keep mails per run up to 100,000 to avoid RAM overloads
		$this->mails_per_run = get_option('bftpro_mails_per_run');		
		if($this->mails_per_run==0 or $this->mails_per_run>100000) $this->mails_per_run=100000;		
		
		if($this->mails_per_run > $this->mails_left) $this->mails_per_run = $this->mails_left;
		else $this->mails_left = $this->mails_per_run; 
		
		$this->total_emails_sent=0;
		
		// send newsletter emails
		$newsletters = $wpdb->get_results("SELECT * FROM ".BFTPRO_NEWSLETTERS." WHERE status='in progress' ORDER BY id");		
		if(sizeof($newsletters)) {
			// select receivers and try to run
			foreach($newsletters as $newsletter) {				
				$receivers = $_user->select_receivers($wpdb->prepare(" AND list_id=%d AND id>%d",
					$newsletter->list_id, $newsletter->last_user_id),
					$this->mails_left);
					
				// attachments 
				$attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_ATTACHMENTS."
					WHERE nl_id = %d ORDER BY id", $newsletter->id));	
								
				$count = 0;	
				foreach($receivers as $receiver) {	
					list($subject, $message) = $this->customize($newsletter, $receiver);
					
					try {
						$result = $this->send($newsletter->sender, $receiver->email, $subject, $message, $newsletter->mailtype, $attachments);
						$count ++;
						
						// update $receiver id in newsletters table
						$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_NEWSLETTERS." SET last_user_id=%d WHERE id=%d", 
							$receiver->id, $newsletter->id));
							
						// insert in sent mails
						$send_errors = $result ? '' : 'skipped';
						$wpdb->query( $wpdb->prepare("INSERT INTO ".BFTPRO_SENTMAILS." SET
							mail_id=0, user_id=%d, date=CURDATE(), newsletter_id=%d, errors=%s", 
							$receiver->id, $newsletter->id, $send_errors));	
					}
					catch(Exception $e) {
						$errmsg = $e->getMessage();
						BFTPro::log($errmsg);
						return $errmsg;
					} 
				}	
				
				// in case we have sent to no one in this list, means that mailing to the list is completed
   			// then we need to update the list status as sent
   			if($count==0 or $count < $this->mails_left) {
   				$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_NEWSLETTERS." SET status = 'completed', last_user_id = 0 
   					WHERE id=%d", $newsletter->id));
   			}
			}
		}
		
		// send autoresponder emails
		// 1. first select fixed dates mails and weekday mails for today
		$ar_mails1 = $wpdb->get_results("SELECT tM.*, tA.list_ids as list_ids 
			FROM ".BFTPRO_MAILS." tM JOIN ".BFTPRO_ARS." tA ON tA.id=tM.ar_id 
			WHERE ( (tM.artype='date' AND tM.send_on_date=CURDATE()) OR (tM.artype='every_weekday' AND tM.every='".date('l')."') )
			AND ( tM.daytime='' OR tM.daytime=0 OR tM.daytime<=HOUR(NOW()) ) 
			ORDER BY tM.daytime DESC, tM.id");	
		
		// 2. then select all sequential mails no matter the date they have to be sent at
		// and all mails sent "every X days"
		$ar_mails2 = $wpdb->get_results("SELECT tM.*, tA.list_ids as list_ids, tA.sender as ar_sender
			FROM ".BFTPRO_MAILS." tM JOIN ".BFTPRO_ARS." tA	ON tM.ar_id=tA.id
			WHERE (tM.artype='days' OR tM.artype='every_days') AND ( tM.daytime='' OR tM.daytime=0 OR tM.daytime<=HOUR(NOW()) ) 
			ORDER BY tM.id");
		
		// merge both in a single array to process once
		$ar_mails = array_merge($ar_mails1, $ar_mails2);	
		
		// mails to be sent by the Intelligence module?
		if(class_exists('BFTISender')) $ar_mails = apply_filters('bftpro-send-ar-mails', $ar_mails);
		
		foreach($ar_mails as $mail) {
			
			// select receivers limited by mails left for this run
			$receivers = array();
			$list_ids=explode("|", $mail->list_ids);
			$list_ids=array_filter($list_ids);
			if(empty($list_ids)) $list_ids[]=0;
			if(empty($mail->sender)) $mail->sender = $mail->ar_sender; // if by any chance the sender of the email is empty, use the AR sender
			
			// avoid duplicates
			$noduplicate_sql = $wpdb->prepare(" AND id NOT IN (SELECT user_id FROM ".BFTPRO_SENTMAILS."
				WHERE mail_id=%d AND date=CURDATE()) ", $mail->id);
				
			
			if($mail->artype=='every_weekday' or $mail->artype=='date') {
				$receivers=$_user->select_receivers(" AND list_id IN (".implode(",", $list_ids).") 
				$noduplicate_sql", $this->mails_left);			
			}
			
			if($mail->artype=='days') {
				$receivers=$_user->select_receivers(" AND list_id IN (".implode(",", $list_ids).") 
					AND date = CURDATE() - INTERVAL {$mail->days} DAY $noduplicate_sql", $this->mails_left);					
			}
			
			if($mail->artype=='every_days') {
				$receivers=$_user->select_receivers(" AND list_id IN (".implode(",", $list_ids).") 
					AND MOD(TO_DAYS(date) - TO_DAYS(CURDATE()), {$mail->every})=0
      		AND (TO_DAYS(CURDATE())-TO_DAYS(date))>={$mail->every}
      		$noduplicate_sql", $this->mails_left);
			}

			if(class_exists('BFTISender')) $receivers = apply_filters('bftpro-armail-receivers', $mail, $receivers, $list_ids, $noduplicate_sql, $this);
			// print_r($receivers);
			// attachments 
			$attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_ATTACHMENTS."
					WHERE mail_id = %d ORDER BY id", $mail->id));	
			$mail->attachments = $attachments;		
			
			// try to send the emails, return if limit exhausted
			foreach($receivers as $receiver) {
				list($subject, $message) = $this->customize($mail, $receiver);
				
				try {
					// echo 'sending<br>';					
					$result = $this->send($mail->sender, $receiver->email, $subject, $message, $mail->mailtype, $attachments);

					// insert into sent mails
					$sending_errors = $result ? '' : 'skipped';
					$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_SENTMAILS." SET
						mail_id=%d, user_id=%d, date=CURDATE(), errors=%s", $mail->id, $receiver->id, $sending_errors));		
					// $count ++;
				}
				catch(Exception $e) {
					BFTPro::log($e->getMessage());
				} 
			}	
		}	
		
		return "Success";
	} // end cron()
	
	// immediate emails - 0 days after registration
	static function immediate_mails($user_id) {		
		global $wpdb;
		require_once(BFTPRO_PATH."/models/user.php");
		$_user = new BFTProUser();		
		$user = $_user->select_receivers($wpdb->prepare(" AND id=%d ", $user_id),1);
		$user = $user[0];
		$_sender = new BFTProSender();
			
		$mails = $wpdb->get_results("SELECT tM.*, tR.sender as sender FROM ".BFTPRO_MAILS." tM
			JOIN ".BFTPRO_ARS." tR ON tR.id=tM.ar_id 
			WHERE tR.list_ids LIKE '%|{$user->list_id}|%'
			AND tM.send_on_date='0000-00-00' AND tM.days=0 AND tM.artype='days'
			AND ( tM.daytime='' OR tM.daytime=0 OR tM.daytime<=HOUR(NOW()) )
			ORDER BY tM.id");
		
		foreach($mails as $mail) {		
			// attachments 
			$attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_ATTACHMENTS."
					WHERE mail_id = %d ORDER BY id", $mail->id));	
			
			list($subject, $message) = $_sender->customize($mail, $user);
					
			try {
				$result = $_sender->send($mail->sender, $user->email, $subject, $message, $mail->mailtype, $attachments);
				//$count ++;
				if(!$result) BFTPro::log("Immediate email from {$mail->sender} to {$user->email} was not send. Error from phpmailer: ".$GLOBALS['phpmailer']->ErrorInfo);
				
				// insert into sent mails
				$sending_errors = $result ? '' : 'skipped';
				$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_SENTMAILS." SET
					mail_id=%d, user_id=%d, date=CURDATE(), errors=%s", $mail->id, $user->id, $sending_errors));						
						
			}
			catch(Exception $e) {
				$errmsg = $e->getMessage();
				BFTPro::log($errmsg);
				return $errmsg;
			} 
		}	
	}
	
	// this is called instead of directly $this->cron because
	// we want to get the return from $this->cron and update the log
	function start_cron() {		
		global $wpdb;
		
		// first run for today? clear today mails
		if(get_option('bftpro_cron_date')!=date('Y-m-d')) {
			update_option('bftpro_today_mails', 0);
		}
				
		$this->signature = get_option('bftpro_signature');
		
		// actually run the sender procedure
		try {
			$result = $this->cron();
			
			// complete the current cron instance	
			update_option('bftpro_cron_status', 'completed');
			BFTPro::log("Cron job ran at ".date("Y-m-d H:i")." with result: $result".@$this->phpmailer_errors);
		}
		catch(Exception $e) {
			// log error
			BFTPro::log("Cron job failed at ".date("Y-m-d H:i")." with result: ".$e->getMessage());
			if(!empty($_GET['bftpro_cron'])) die($e->getMessage());
		}	
		
		if(!empty($_GET['bftpro_cron'])) die("Running in cron job mode"); 
	}
}