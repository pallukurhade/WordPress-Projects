<?php
// integration with contact form 7
class BFTProContactForm7 {
	static function signup($contactform) {
		global $wpdb;
		
		$data = $contactform->posted_data;
		if(empty($data['bftpro_integrated_lists'])) return true;
		
		// there are some lists, so let's get user data		
		$user = array('email' => "", "name"=>"");	
		$user['email'] = !empty( $data['your-email'] ) ? trim( $data['your-email'] ) : '';
	   $user['name'] = !empty( $data['your-name'] ) ? trim( $data['your-name'] ) : '';
	   
		if ( !empty( $data['your-first-name'] ) and !empty( $data['your-last-name'] ) ) {
			$user['name'] = trim( $data['your-first-name']).' '.trim($data['your-last-name']) ;
		}
		
		// now, as we have the user, let's subscribe them
		require_once(BFTPRO_PATH."/models/user.php");
		$_user = new BFTProUser();
		
		foreach($data['bftpro_integrated_lists'] as $l_id) {
			$vars = array("list_id"=>$l_id, "email"=>$user['email'], "name"=>$user['name'], "auto_subscribed"=>1);
			
			// fill any required fields with "1" to avoid errors			
			$fields=$wpdb->get_results($wpdb->prepare("SELECT * FROM ".BFTPRO_FIELDS." WHERE list_id=%d", $l_id));
			foreach($fields as $field) {
				$vars['field_'.$field->id] = empty($data['field_'.$field->id]) ? 1 : $data['field_'.$field->id];
			}
			
			// ignore exceptions
			try {
				$message = '';
				$_user->subscribe($vars, $message, true);
			}
			catch(Exception $e) {}
		}
	} // end signup
	
	static function shortcode_filter($form) {
		return do_shortcode( $form );
	}
}