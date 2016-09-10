<?php
// manages integration settings, gives shortcodes etc
class BFTProIntegrations {
	// currently integrates with contact form 7
	static function contact_form() {
		global $wpdb;		
		
		// selected list_id - $_POST has priority
		$list_id = empty($_POST['list_id']) ? intval(@$_GET['id']) : intval($_POST['list_id']);
		
		$shortcode_atts = '';
		if(!empty($_POST['checked_by_default'])) {
			$shortcode_atts .= ' checked="true" ';
		}
		if(!empty($_POST['required'])) {
			$shortcode_atts .= ' required="true" ';
		}
		if(!empty($_POST['classes'])) {
			$shortcode_atts .= ' css_classes="'.$_POST['classes'].'" ';
		}
		if(!empty($_POST['html_id'])) {
			$shortcode_atts .= ' html_id="'.$_POST['html_id'].'" ';
		}
		
		// select  mailing lists
		$lists = $wpdb->get_results("SELECT * FROM ".BFTPRO_LISTS." ORDER BY name"); 
		
		// selected mailing list
		$list = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_LISTS." WHERE id=%d", $list_id));
		
		// select custom fields in the selected mailing list
		$fields = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_FIELDS." WHERE list_id=%d", $list_id));
		
		require(BFTPRO_PATH."/views/integration-contact-form.html.php");
	}
}