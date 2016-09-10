<?php
class BFTProMailModel {
	function __construct() {
		require_once(BFTPRO_PATH."/models/attachment.php");
		$this->_att = new BFTProAttachmentModel();
	}	
	
	function select($campaign_id, $id = null) {
		global $wpdb;
		
		if($id) {
			$mail = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_MAILS." 
				WHERE ar_id=%d AND id=%d", $campaign_id, $id));
			return $mail;	
		} 
		else {			
			$mails = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_MAILS." 
				WHERE ar_id=%d ORDER BY days, send_on_date, every, subject, id", $campaign_id));
			return $mails;	
		}
	}
	
	function add($vars) {
		global $wpdb;
		
		$this->prepare_vars($vars);		
		
		$wpdb->query($wpdb->prepare("INSERT INTO ".BFTPRO_MAILS." SET
			sender=%s, subject=%s, message=%s, artype=%s, ar_id=%d, 
			days=%d, send_on_date=%s, every=%s, mailtype=%s, daytime=%d",
			$vars['sender'], $vars['subject'], $vars['message'], $vars['artype'], $vars['ar_id'], 
			$vars['days'], @$vars['send_on_date'], @$vars['every'], $vars['mailtype'], $vars['daytime']));
		$id = $wpdb->insert_id;		
		
		$this->_att->save_attachments($id, 'mail');			
		
		do_action('bftpro-armail-save', $vars, $id);
			
		return true;	
	}
	
	function edit($vars, $id) {
		global $wpdb;
		
		$this->prepare_vars($vars);		
		
		$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_MAILS." SET
			sender=%s, subject=%s, message=%s, artype=%s, ar_id=%d, days=%d, send_on_date=%s, 
			every=%s, mailtype=%s, daytime=%d
			WHERE id=%d",
			$vars['sender'], $vars['subject'], $vars['message'], $vars['artype'], $vars['ar_id'], 
			$vars['days'], @$vars['send_on_date'], @$vars['every'], $vars['mailtype'], $vars['daytime'], $id));
			
		$this->_att->save_attachments($id, 'mail');
		
		do_action('bftpro-armail-save', $vars, $id);		
			
		return true;	
	}
	
	function delete($id) {
		global $wpdb;
		
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_MAILS." WHERE id=%d", $id));
		
		$this->_att->delete_attachments($id, 'mail');
		
		// delete sent data
		$wpdb->query($wpdb->prepare("DELETE FROM ".BFTPRO_SENTMAILS." WHERE mail_id=%d", $id));
		
		return true;
	}
	
	// make some changes to $vars for inserting in the DB
	private function prepare_vars(&$vars) {
		if($vars['artype']=='every_days') $vars['every'] = $vars['every_days'];
		if($vars['artype']=='every_weekday') $vars['every'] = $vars['every_weekday'];
		
		if($vars['artype']=='date') $vars['send_on_date']=$vars['send_on_dateyear']."-".$vars['send_on_datemonth'].'-'.$vars['send_on_dateday'];
		
		$vars['daytime'] = (!empty($vars['time_of_sending']) and $vars['time_of_sending']=='specified') ? $vars['daytime'] : 0;
	}
}