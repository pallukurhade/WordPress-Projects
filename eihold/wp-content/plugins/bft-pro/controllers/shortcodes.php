<?php
class BFTProShortcodes {
	// outputs the openning form tag
	static function form_start($atts) {
		global $wpdb;
		$list = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_LISTS." WHERE id=%d", $atts[0]));
		$action = '';		
		if(!empty($atts[1])) {
			$form_action = BFTProList :: get_form_action();
			$action = " action = '$form_action' ";
		}
		$content = '<form method="post" class="bftpro-front-form-visual" onsubmit="return validateBFTProUser(this,'.($list->require_name?'true':'false').');" '.$action.'>';
		return $content;
	}	
	
	// outputs a static field
	static function static_field($atts) {
		if($atts[0] == 'name') return '<input type="text" name="bftpro_name">';
		else return '<input type="text" name="email">';
	}
	
	// non static field	
	static function field($atts) {
		global $wpdb;
		
		$field = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_FIELDS." WHERE id=%d", $atts[0]));		
		$fields = array($field);
		ob_start();
		$nolabel = true;
		require(BFTPRO_PATH."/views/partial/list-fields.php");
		$content = ob_get_clean();
		return $content;
	}
	
	// closes the signup form
	static function form_end($atts) {
		return '<input type="hidden" name="bftpro_subscribe" value="1">			
				<input type="hidden" name="list_id" value="'.$atts[0].'">			
			<input type="hidden" name="required_fields[]" value="">
		</form>';
	}
	
	static function recaptcha() {
		$recaptcha_public = get_option('bftpro_recaptcha_public');
		$recaptcha_private = get_option('bftpro_recaptcha_private');
			
		if($recaptcha_public and $recaptcha_private) {
			require_once(BFTPRO_PATH."/recaptcha/recaptchalib.php");
			$recaptcha_html = recaptcha_get_html($recaptcha_public);
		}
		
		return $recaptcha_html;
	}
	
	static function submit_button($atts) {
		global $wpdb;
		
		$list_id = empty($atts[0]) ? 0 : $atts[0];
		if(!empty($list_id)) {
			$list = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".BFTPRO_LISTS." WHERE id=%d", $list_id));
		}	
		
		$text = empty($atts[1]) ? __('Subscribe', 'bftpro') : $atts[1];	
		
		if(empty($list->signup_graphic)) return '<input type="submit" value="'.$text.'">';
		else return '<input type="image" src="'.$list->signup_graphic.'">';
	}
	
	static function text_captcha() {
		return BFTProTextCaptcha :: generate();	
	}
	
	// displays checkbox for the mailing list that can be used in integrations
	static function int_chk($atts) {
		$list_id = intval(@$atts['list_id']);
		
		if(empty($list_id)) return '';
		
		// allow passing CSS, ID, onlick, default checked, etc		
		$classes = $chedked = '';
		if(!empty($atts['required']) and $atts['required'] == 'true') $classes .= ' wpcf7-validates-as-required ';
		if(!empty($atts['css_classes'])) $classes .= ' '.$atts['css_classes'].' ';
		if(!empty($atts['html_id'])) $html_id = $atts['html_id'];
		
		if(!empty($atts['checked']) and $atts['checked'] == 'true') $checked = ' checked="checked" ';
		
		// now output the checkbox
		return '<input type="checkbox" name="bftpro_integrated_lists[]" value="'.$list_id.'" class="'.$classes.'" id="'.$html_id.'" '.$checked.'>';
   }
}