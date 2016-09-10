<?php
class BFTProARController {
	// manage AR campaigns
	static function manage() {
		require_once(BFTPRO_PATH."/models/ar.php");
		require_once(BFTPRO_PATH."/models/list.php");		
		$_list=new BFTProList();	
		$_ar = new BFTProARModel();
		global $wpdb;
		
		switch(@$_GET['do']) {
			case 'edit':
				if(!empty($_POST['del'])) {
					$_ar->delete($_GET['id']);
					$_SESSION['flash'] = __("Autoresponder campaign deleted", 'bftpro');
					bftpro_redirect("admin.php?page=bftpro_ar_campaigns");		
				}
			
				if(!empty($_POST['ok'])) {
					try {
						$_ar->edit($_POST, $_GET['id']);	
						$_SESSION['flash'] = __("Autoresponder campaign saved", 'bftpro');
						bftpro_redirect("admin.php?page=bftpro_ar_campaigns");					
					}
					catch(Exception $e) {
						$error=$e->getMessage();			
					}
				}
				
				// select campaign
				$campaign = $_ar->select($_GET['id']);
				$list_ids = explode("|", $campaign->list_ids);
				
				// select lists		
				$lists=$_list->select();		
				
				require(BFTPRO_PATH."/views/ar-form.php");
			break;
			
			case 'add':
				if(!empty($_POST['ok'])) {
					try {
						$_ar->add($_POST);	
						$_SESSION['flash'] = __("Autoresponder campaign created", 'bftpro');
						bftpro_redirect("admin.php?page=bftpro_ar_campaigns");					
					}
					catch(Exception $e) {
						$error=$e->getMessage();			
					}
				}
				
				// select lists
				$lists=$_list->select();		
				
				require(BFTPRO_PATH."/views/ar-form.php");
			break;			
			
			default:
				// list my campaigns
				$campaigns = $_ar->select();
				
				if(!empty($_GET['list_id'])) {
					// filter by list ID
					$filtered=array();
					foreach($campaigns as $campaign) {
						if(strstr($campaign->list_ids, "|".$_GET['list_id']."|")) $filtered[] = $campaign;
					}
					
					$campaigns = $filtered;
					
					$filter_list = $_list->select($_GET['list_id']);					
				}				
				
				// select lists
				$lists=$_list->select();	
				
				// match lists to campaigns
				foreach($campaigns as $cnt=>$campaign) {
					$campaigns[$cnt]->lists = array();
					foreach($lists as $list) {
						if(strstr($campaign->list_ids, "|".$list->id."|")) $campaigns[$cnt]->lists[] = $list;
					}
					
					// and select num emails
					$num_mails = $wpdb->get_var($wpdb->prepare("SELECT COUNT(id) FROM ".BFTPRO_MAILS." 
						WHERE ar_id=%d", $campaign->id));						
					$campaigns[$cnt]->num_mails = $num_mails;	
					
					// select sent mails and read mails to figure out % opened
					$sent_mails = $wpdb->get_var($wpdb->prepare("SELECT COUNT(tS.id) FROM ".BFTPRO_SENTMAILS."
						tS JOIN ".BFTPRO_MAILS." tM ON tM.id = tS.mail_id 
						WHERE tM.ar_id=%d AND tS.errors='' ", $campaign->id));
						
					$read_mails = $wpdb->get_var($wpdb->prepare("SELECT COUNT(tR.id) FROM ".BFTPRO_READMAILS."
						tR JOIN ".BFTPRO_MAILS." tM ON tM.id = tR.mail_id 
						WHERE tM.ar_id=%d", $campaign->id));	
					
					$percent_read = empty($sent_mails) ? 0 : round(100 * $read_mails / $sent_mails);
					$campaigns[$cnt]->percent_read = $percent_read; 
					
				}
				require(BFTPRO_PATH."/views/ars.php");
			break;
		}
	}
	
	// manage emails
	static function mails() {
		global $wpdb;
		require_once(BFTPRO_PATH."/models/mail.php");
		require_once(BFTPRO_PATH."/models/ar.php");			
		require_once(BFTPRO_PATH."/models/attachment.php");
		$_mail = new BFTProMailModel();	
		$_ar = new BFTProARModel();
		$_att = new BFTProAttachmentModel();
		
		// campaign ID should always be in GET
		$ar = $_ar->select($_GET['campaign_id']);
		$_POST['ar_id'] = $ar->id;
		$dateformat = get_option("date_format");
		
		// select custom fields from the lists assigned to this autoresponder
		$list_ids=explode("|",$ar->list_ids);
		$list_ids = array_filter($list_ids);
		if(!empty($list_ids)) {
			$fields = $wpdb->get_results("SELECT tF.*, tL.name as list_name
				FROM ".BFTPRO_FIELDS." tF JOIN ".BFTPRO_LISTS." tL ON tL.id=tF.list_id
				WHERE tF.list_id IN (".implode(",", $list_ids).")");
		}
		
		// current mysql time
		$server_time = $wpdb->get_var("SELECT NOW()");
		list($date, $time) = explode(" ", $server_time);
		list($h, $m, $s) = explode(":", $time);
		$server_time = $h.":".$m;
		
		switch(@$_GET['do']) {
			case 'edit':
				if(!empty($_POST['del'])) {
					$_mail->delete($_GET['id']);
					$_SESSION['flash'] = __("Email message deleted", 'bftpro');
					bftpro_redirect("admin.php?page=bftpro_ar_mails&campaign_id=$_GET[campaign_id]");				
				}					
			
			
				if(!empty($_POST['ok'])) {
					try {
						$_mail->edit($_POST, $_GET['id']);	
						$_SESSION['flash'] = __("Email message saved", 'bftpro');
						bftpro_redirect("admin.php?page=bftpro_ar_mails&campaign_id=$_GET[campaign_id]");					
					}
					catch(Exception $e) {
						$error=$e->getMessage();			
					}
				}
				
				// select this email
				$mail =$_mail->select($ar->id, $_GET['id']);
				
				// select attachments
				$attachments = $_att->select("mail", $mail->id);
				
				require(BFTPRO_PATH."/views/mail-form.php");
			break;
			
			case 'add':
				if(!empty($_POST['ok'])) {
					try {
						$_mail->add($_POST);	
						$_SESSION['flash'] = __("Email message created", 'bftpro');
						bftpro_redirect("admin.php?page=bftpro_ar_mails&campaign_id=$_GET[campaign_id]");					
					}
					catch(Exception $e) {
						$error=$e->getMessage();			
					}
				}
				
				require(BFTPRO_PATH."/views/mail-form.php");
			break;			
			
			default:
				// list my campaigns
				$mails = $_mail->select($ar->id);				
				require(BFTPRO_PATH."/views/mails.php");
			break;
		}
	} // end manage emails
	
	// show log of sent emails
	static function log() {
		global $wpdb;
		require_once(BFTPRO_PATH."/models/ar.php");
		$_ar = new BFTProARModel();
		// select email message
		$mail = $wpdb -> get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_MAILS." WHERE id=%d", $_GET['id']));
		
		// select campaign
		$ar = $_ar -> select($mail->ar_id);
				
		// now select 100 sent mails
		$limit = 100;
		$offset = empty($_GET['offset'])?0:intval($_GET['offset']);
		$sent_mails = $wpdb->get_results($wpdb->prepare("SELECT SQL_CALC_FOUND_ROWS tU.email as email, tM.date as date, 
			tM.user_id as user_id, tU.list_id as list_id, tL.name as list_name
			FROM ".BFTPRO_SENTMAILS." tM JOIN ".BFTPRO_USERS." tU ON tU.id=tM.user_id
			JOIN ".BFTPRO_LISTS." tL ON tL.id = tU.list_id
			WHERE tM.mail_id=%d AND tM.errors='' ORDER BY tM.id DESC LIMIT $offset, $limit", $mail->id));
		$cnt_mails=$wpdb->get_var("SELECT FOUND_ROWS()");		
		
		require(BFTPRO_PATH."/views/ar-log.php");			
	}
}