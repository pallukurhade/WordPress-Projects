<?php
class BFTProHelp {
	// display main help page
	static function help_main() {
		require(BFTPRO_PATH."/views/help.php");
	}
	
	// pull the error log
	static function error_log() {
		global $wpdb;
		$date = empty($_POST['dateyear']) ? date("Y-m-d") : $_POST['dateyear'].'-'.$_POST['datemonth'].'-'.$_POST['dateday'];
		
		// select error log
		$log = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_LOGS." WHERE date=%s", $date));
		
		require(BFTPRO_PATH."/views/error-log.html.php");
	}
}