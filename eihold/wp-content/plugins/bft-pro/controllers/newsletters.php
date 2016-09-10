<?php
class BFTProNLController {
	// manage newsletters
	static function manage() {
		require_once(BFTPRO_PATH."/models/newsletter.php");
		require_once(BFTPRO_PATH."/models/list.php");		
		require_once(BFTPRO_PATH."/models/user.php");
		require_once(BFTPRO_PATH."/models/attachment.php");				
		$_list=new BFTProList();	
		$_nl = new BFTProNLModel();
		$_user = new BFTProUser();
		$_att = new BFTProAttachmentModel();
		global $wpdb;
		$dateformat = get_option('date_format');
		
		switch(@$_GET['do']) {
			case 'edit':
				if(!empty($_POST['del'])) {
					$_nl->delete($_GET['id']);
					$_SESSION['flash'] = __("Newsletter deleted", 'bftpro');
					bftpro_redirect("admin.php?page=bftpro_newsletters");		
				}			
			
				if(!empty($_POST['cancel'])) {
					// cancel current sending of this newsletter
					$_nl->cancel($_GET['id']);
				}
			
				if(!empty($_POST['ok'])) {
					try {
						$_nl->edit($_POST, $_GET['id']);	
						$_SESSION['flash'] = __("The newsletter has been saved", 'bftpro');
						
						// send test
						if(!empty($_POST['test_newsletter'])) {
							unset($_POST['send']);
							$_SESSION['flash'] = __("A test email with this newsletter has been sent to you.", 'bftpro');
							self :: send_test($_GET['id']);
						}
						
						// save and send pressed
						if(!empty($_POST['send'])) {
							$_SESSION['flash'] = __("The newsletter has been saved and is being sent to selected mailing list.", 'bftpro');
							$_nl->send($_GET['id']);
						}						
						
						bftpro_redirect("admin.php?page=bftpro_newsletters");					
					}
					catch(Exception $e) {
						$error=$e->getMessage();			
					}
				}
				
				// select campaign
				$mail = $_nl->select($_GET['id']);
								
				// select lists		
				$lists=$_list->select();		
				// attachments
				$attachments = $_att->select("newsletter", $mail->id);
				
				require(BFTPRO_PATH."/views/newsletter-form.php");
			break;
			
			case 'add':
				if(!empty($_POST['ok'])) {
					try {
						$nid = $_nl->add($_POST);	
						$_SESSION['flash'] = __("The newsletter has been created", 'bftpro');
						
						// send test
						if(!empty($_POST['test_newsletter'])) {
							unset($_POST['send']);
							$_SESSION['flash'] = __("A test email with this newsletter has been sent to you.", 'bftpro');
							self :: send_test($nid);
						}
						
						// save and send pressed
						if(!empty($_POST['send'])) {
							$_SESSION['flash'] = __("The newsletter has been created and is being sent to selected mailing list.", 'bftpro');
							$_nl->send($nid);
						}							
						
						bftpro_redirect("admin.php?page=bftpro_newsletters");					
					}
					catch(Exception $e) {
						$error=$e->getMessage();			
					}
				}
				
				// select lists
				$lists=$_list->select();		
				
				require(BFTPRO_PATH."/views/newsletter-form.php");
			break;			
			
			default:
				// list my newsletters - subject, sending to, current status
				$_nl = new BFTProNLModel();
				$newsletters = $_nl -> select();
				
				// now select send and read newsletters to calculate open rates
				$sentnls = $wpdb->get_results("SELECT COUNT(id) as cnt, newsletter_id FROM ".BFTPRO_SENTMAILS."
					WHERE newsletter_id !=0 AND errors='' GROUP BY newsletter_id");
				$readnls = 	$wpdb->get_results("SELECT COUNT(id) as cnt, newsletter_id FROM ".BFTPRO_READNLS."
					GROUP BY newsletter_id");
					
				foreach($newsletters as $cnt=>$newsletter) {
					$num_sent = $num_read =0;
					
					foreach($sentnls as $sentnl) {
						if($sentnl->newsletter_id == $newsletter->id) $num_sent += $sentnl->cnt;
					}
					
					foreach($readnls as $readnl) {
						if($readnl->newsletter_id == $newsletter->id) $num_read += $readnl->cnt;
					}
					
					$percent_read = empty($num_sent) ? 0 : round(100 * $num_read / $num_sent);
					$newsletters[$cnt]->percent_read = $percent_read; 
				} // end foreach newsletter	
								
				// select lists
				$lists=$_list->select();
				
				require(BFTPRO_PATH."/views/newsletters.php");
			break;
		}
	}
	
	// shows the "log" for in-progress newsletter, i.e. which emails have still to be sent
	static function log() {
		global $wpdb;
		require_once(BFTPRO_PATH."/models/newsletter.php");
		require_once(BFTPRO_PATH."/models/user.php");
		
		$_nl = new BFTProNLModel();
		$_user = new BFTProUser();
		
		// select newsletter
		$mail = $_nl->select($_GET['id']);
		
		// select all receivers, limit 100 per page
		$limit = 100;
		$offset = empty($_GET['offset'])?0:$_GET['offset'];
		
		$users = $_user->select_receivers($wpdb->prepare("AND list_id = %d", $mail->list_id), 0);	
		
		// segmentation required?
		if(class_exists('BFTISegment')) {
			foreach($users as $cnt=>$user) {
				if(!BFTISegment :: apply_segments($mail, $user)) unset($users[$cnt]);
			}
		}
			
		// find num sent emails and num total emails	
		$total_users = sizeof($users);
		
		// now slice to 100 per page
		$users = array_slice($users, $offset, $limit);
		
		// num sent
		$num_sent = $wpdb->get_var($wpdb->prepare("SELECT COUNT(id) FROM ".BFTPRO_USERS."
			WHERE list_id=%d AND status=1 AND id<=%d", $mail->list_id, $mail->last_user_id));
			
		require(BFTPRO_PATH."/views/newsletter-log.php");	
	}
	
	// immediately send test email
	static function send_test($nid) {
		global $wpdb;
		
		// select newsletter
		$newsletter = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_NEWSLETTERS." WHERE id=%d", $nid));
		$attachments = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_ATTACHMENTS."
					WHERE nl_id = %d ORDER BY id", $newsletter->id));	
		$subject = '[TEST] '.stripslashes($newsletter->subject);			
		$message = stripslashes($newsletter->message);
		$receiver_email = get_option('bftpro_sender');
		
		// add unsubscribe link
		$list = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_LISTS." WHERE id=%d", $newsletter->list_id));
		$receiver = (object)array("email"=>$receiver_email);
		
		$_sender = new BFTProSender();
		
		// add signature if any
		if(!isset($_sender->signature)) $_sender->signature = stripslashes(get_option('bftpro_signature'));
		if(!empty($_sender->signature)) {
				if($newsletter->mailtype=='text/html' or $newsletter->mailtype=='both') {
		 			 $message.="<p>&nbsp;</p>".$_sender->signature;
		 		}
		 		else $message.="\n\n".$this->signature;
		}		
		if(class_exists('BFTISender')) $message = apply_filters('bftpro_template_filter', $message, $newsletter->template_id);
		
		$message .= $_sender->add_unsubscribe_link($receiver, $newsletter->mailtype, $list);
		$_sender->send($newsletter->sender, $receiver_email, $subject, $message, $newsletter->mailtype, $attachments);;
 	} // end send_test()
}