<?php 
class BFTProReport {
	// runs the report for an autoresponder campaign
	// select emails in the campaign along with: num sent, num read, open rate
	// and later if Intelligence is available, num link clicks
	function campaign_report($from, $to) {
		global $wpdb;
		
		$_mail = new BFTProMailModel();
		$mails = $_mail->select($_GET['campaign_id']);
		
		// to avoid SQL queries let's just select all sent and read mails for the given period
		$sent_mails = $wpdb -> get_results( $wpdb->prepare("SELECT * FROM ".BFTPRO_SENTMAILS."	WHERE mail_id!=0
			AND date>=%s AND date<=%s AND user_id!=0 AND errors='' ", $from, $to));
		$read_mails = $wpdb -> get_results( $wpdb->prepare("SELECT * FROM ".BFTPRO_READMAILS."	WHERE mail_id!=0
			AND date>=%s AND date<=%s AND user_id!=0 ", $from, $to));					
			
		foreach($mails as $cnt=>$mail) {
			$mails[$cnt]->num_sent = $mails[$cnt]->num_read = 0;
			foreach($sent_mails as $sent_mail) {
				if($sent_mail->mail_id == $mail->id) $mails[$cnt]->num_sent++;
			}
			
			foreach($read_mails as $read_mail) {
				if($read_mail->mail_id == $mail->id) $mails[$cnt]->num_read++;
			}
			
			// now calculate % open rate
			if($mails[$cnt]->num_sent == 0) $percent = 0;
			else $percent = round( ($mails[$cnt]->num_read / $mails[$cnt]->num_sent) * 100 );
			
			$mails[$cnt]->open_rate = $percent;
		}	
		
		return $mails;
	} // end campaign report
	
	// newsletter report. It loads all newsletters unless we come from a specific newsletter link
	// in which case one newsletter is pre-selected
	function newsletter_report($from, $to) {
		global $wpdb;
		
		// select all newsletters
		$newsletters = $wpdb -> get_results( "SELECT * FROM ".BFTPRO_NEWSLETTERS." ORDER BY id");
		
		// to avoid SQL queries let's just select all sent and read mails for the given period
		$sent_nls = $wpdb -> get_results( $wpdb->prepare("SELECT newsletter_id FROM ".BFTPRO_SENTMAILS."	WHERE newsletter_id!=0
			AND date>=%s AND date<=%s AND errors='' ", $from, $to));
		$read_nls = $wpdb -> get_results( $wpdb->prepare("SELECT newsletter_id FROM ".BFTPRO_READNLS."	WHERE newsletter_id!=0
			AND date>=%s AND date<=%s", $from, $to));			
				
		foreach($newsletters as $cnt=>$newsletter) {
			// lets calculate only for the one that we need, if one is selected
			if(!empty($_GET['newsletter_id']) and $_GET['newsletter_id'] != $newsletter->id) continue;
			
			$num_sent = $num_read = 0;
			
			foreach($sent_nls as $sent_nl) {
				if($sent_nl->newsletter_id == $newsletter->id) $num_sent ++;
			} 
			
			foreach($read_nls as $read_nl) {
				if($read_nl->newsletter_id == $newsletter->id) $num_read++;
			}
			
			if($num_sent == 0) $percent = 0;
			else $percent = round( ($num_read / $num_sent) * 100);
			
			$newsletters[$cnt]->num_sent = $num_sent;
			$newsletters[$cnt]->num_read = $num_read;
			$newsletters[$cnt]->open_rate = $percent;
		}			
		
		return $newsletters;	
	}
	
	// this tracks open emails
	static function track() {		
		if(empty($_GET['bftpro_track'])) return true;
		
		// now track the readmail
		global $wpdb;
		if($_GET['type'] == 'nl') {
			$table = BFTPRO_READNLS;
			$field = 'newsletter_id';
			$userfield = 'read_nls';
		} else {
			$table = BFTPRO_READMAILS;
			$field = 'mail_id';
			$userfield = 'read_armails';
			
			do_action('bftpro_read_armail', $_GET['uid'], $_GET['id']);
		}
		
		// exists?
		$exists = $wpdb->get_var( $wpdb->prepare("SELECT id FROM $table WHERE user_id=%d AND $field = %d", $_GET['uid'], $_GET['id']));
		
		if($exists) {
			$wpdb->query("UPDATE $table SET date=CURDATE() WHERE id='$exists'");
		}
		else {			
			$wpdb->query( $wpdb->prepare("INSERT INTO $table SET 
				$field=%d, user_id=%d, date=CURDATE()", $_GET['id'], $_GET['uid']));
				
			// update also in users table, only when the mail is read for the 1st time
			$wpdb->query($wpdb->prepare("UPDATE ".BFTPRO_USERS." SET $userfield = $userfield + 1 WHERE id=%d", $_GET['uid']));	
		}
		
		// output image and exit
		$im = imagecreatetruecolor(1, 1);
		header('Content-Type: image/jpeg');
		imagejpeg($im);
		exit;
	} // end track()
}