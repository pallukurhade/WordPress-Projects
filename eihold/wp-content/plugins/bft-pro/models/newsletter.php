<?php
// newsletter model 
class BFTProNLModel {
	function __construct() {
		require_once(BFTPRO_PATH."/models/attachment.php");
		$this->_att = new BFTProAttachmentModel();
	}	
	
	// join to currently selected mailing list
	function select($id = null) {
		global $wpdb;
		
		if($id) {			
			$mail = $wpdb->get_row($wpdb->prepare("SELECT tN.*, tL.name as list_name FROM ".BFTPRO_NEWSLETTERS." tN
				LEFT JOIN ".BFTPRO_LISTS." tL ON tL.id=tN.list_id
				WHERE tN.id=%d", $id));
			return $mail;	
		} 
		else {			
			$mails = $wpdb->get_results("SELECT tN.*, tL.name as list_name FROM ".BFTPRO_NEWSLETTERS." tN
				LEFT JOIN ".BFTPRO_LISTS." tL ON tL.id=tN.list_id ORDER BY tN.ID DESC");
			return $mails;	
		}
	}
	
	function add($vars) {
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_NEWSLETTERS." SET
			sender=%s, subject=%s, message=%s, date_created=CURDATE(), list_id=%d, 
			status='not sent', mailtype=%s",
			$vars['sender'], $vars['subject'], $vars['message'], $vars['list_id'], $vars['mailtype']));
			
		$id = $wpdb->insert_id;	
		$this->_att->save_attachments($id, 'newsletter');	
		do_action('bftpro-nl-save', $vars, $id);				
		return $id;	
	}
	
	function edit($vars, $id) {
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_NEWSLETTERS." SET
			sender=%s, subject=%s, message=%s, list_id=%d, mailtype=%s
			WHERE id=%d",
			$vars['sender'], $vars['subject'], $vars['message'], $vars['list_id'], $vars['mailtype'], $id));
			
		$this->_att->save_attachments($id, 'newsletter');		
		do_action('bftpro-nl-save', $vars, $id);
		return true;	
	}
	
	function delete($id) {
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_NEWSLETTERS." WHERE id=%d", $id));
		
		$this->_att->delete_attachments($id, 'newsletter');
		
		// delete sent data
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_SENTMAILS." WHERE newsletter_id=%d", $id));
		
		return true;
	}
	
	function send($id) {
		// change status and reset last_user_id
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_NEWSLETTERS." SET status='in progress', 
			last_user_id=0, date_last_sent=CURDATE() WHERE id=%d", $id)); 
	}
	
	function cancel($id) {
		// change status and reset last_user_id
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_NEWSLETTERS." SET status='cancelled', last_user_id=0 WHERE id=%d", $id));
	}
}