<?php
class BFTProReports {
	// run reports for autoresponder campaign
	static function campaign() {
		global $wpdb;
		require_once(BFTPRO_PATH."/models/mail.php");
		$_report = new BFTProReport();
		list($from, $to) = self :: get_period();
		
		$mails = $_report->campaign_report($from, $to);
		$campaign = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_ARS." 
			WHERE id=%d", $_GET['campaign_id']));
		
		require(BFTPRO_PATH."/views/campaign-report.html.php");
	}
	
	// newsletter reports
	static function newsletter() {
		global $wpdb;
		$_report = new BFTProReport();
		list($from, $to) = self :: get_period();
		
		$newsletters = $_report->newsletter_report($from, $to);
		
		if(!empty($_GET['newsletter_id'])) {
			$newsletter = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_NEWSLETTERS." WHERE id=%d", $_GET['newsletter_id']));
		}
		
		require(BFTPRO_PATH."/views/newsletter-report.html.php");
	}
	
	// defines the from/to period for a report depending on $_POST
	static function get_period() {
		$from = empty($_POST['fromday']) ? date("Y-m")."-01" : $_POST['fromyear'].'-'.$_POST['frommonth'].'-'.$_POST['fromday'];
		$to = empty($_POST['today']) ? date("Y-m-d") : $_POST['toyear'].'-'.$_POST['tomonth'].'-'.$_POST['today'];
		
		return array($from, $to);
	}
}