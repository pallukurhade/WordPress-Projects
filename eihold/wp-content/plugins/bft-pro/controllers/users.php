<?php
class BFTProUsers {
	// shows log of the received emails of a given user
	static function log() {
		global $wpdb;
		
		// select subscriber
		$user = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_USERS." WHERE id=%d", $_GET['id']));
		
		$sent_mails = $wpdb->get_results( $wpdb->prepare("SELECT tM.subject as ar_subject, tN.subject as n_subject,
			tS.date as date, tS.mail_id as mail_id, tS.newsletter_id as newsletter_id, tS.errors as errors
			FROM ".BFTPRO_SENTMAILS." tS LEFT JOIN ".BFTPRO_MAILS." tM ON tM.ID = tS.mail_id
			LEFT JOIN ".BFTPRO_NEWSLETTERS." tN ON tN.id = tS.newsletter_id
			WHERE tS.user_id=%d	ORDER BY tS.ID DESC", $user->id) );
		
		include(BFTPRO_PATH."/views/user-log.html.php");
	} // end log()
}