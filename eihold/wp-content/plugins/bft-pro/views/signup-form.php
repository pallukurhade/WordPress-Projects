<?php if($remote_placement):?>
<script type="text/javascript">
function validateBFTProUser(frm, requireName) {
	requireName = requireName || false;
	
	if(requireName && frm.bftpro_name.value=="") {
		alert("<?php _e('Please provide name', 'bftpro')?>");
		frm.bftpro_name.focus();
		return false;
	}
	
	if(frm.email.value=="" || frm.email.value.indexOf("@")<1 || frm.email.value.indexOf(".")<1) {
		alert("<?php _e('Please provide a valid email address', 'bftpro')?>");
		frm.email.focus();
		return false;
	}
	
	// check custom fields
	var req_cnt = frm.elements["required_fields[]"].length; // there's always at least 1
	if(req_cnt > 1) {
		for(i = 0; i<req_cnt; i++) {
			var fieldName = frm.elements["required_fields[]"][i].value;
			if(fieldName !='') {
				var isFilled = false;
				// ignore radios
				if(frm.elements[fieldName].type == 'radio') continue;
				
				// checkbox
				if(frm.elements[fieldName].type == 'checkbox' && !frm.elements[fieldName].checked) {
					alert("<?php _e('This field is required', 'bftpro')?>");
					frm.elements[fieldName].focus();
					return false;
				}		
				
				// all other fields
				if(frm.elements[fieldName].value=="") {
					alert("<?php _e('This field is required', 'bftpro')?>");
					frm.elements[fieldName].focus();
					return false;
				}
			}
		}
	}
		
	return true;
}
</script>
<?php endif;?>

<form method="post" class="bftpro-front-form" onsubmit="return validateBFTProUser(this,<?php echo $list->require_name?'true':'false'?>);" <?php if($remote_placement):?>action="<?php echo $form_action;?>"<?php endif;?>>
	<div><label><?php if(!empty($list->require_name)) echo '*'?><?php _e("Your Name:", 'bftpro')?></label> <input type="text" name="bftpro_name"></div>
	<div><label>*<?php _e("Your Email:", 'bftpro')?></label> <input type="text" name="email"></div>		
	
	<?php if(empty($list->id)):?>
		<div><label><?php _e('Mailing list:', 'bftpro')?></label>
			<?php if(empty($this->attr_mode) or $this->attr_mode == 'dropdown'):?> 
			<select name='list_id'>
				<?php foreach($lists as $l):?>
					<option value="<?php echo $l->id?>"><?php echo $l->name;?></option>
				<?php endforeach;?>
			</select>
			<?php endif;
			if(!empty($this->attr_mode) and $this->attr_mode == 'radio'):
			foreach($lists as $cnt=>$l):?>
				<input type="radio" name="list_id" value="<?php echo $l->id?>" <?php if($cnt==0) echo 'checked'?>> <?php echo $l->name?> <br>
			<?php endforeach;
			endif;
			if(!empty($this->attr_mode) and $this->attr_mode == 'checkbox'):
			foreach($lists as $cnt=>$l):?>
				<input type="checkbox" name="list_ids[]" value="<?php echo $l->id?>" <?php if($cnt==0) echo 'checked'?>> <?php echo $l->name?> <br>
			<?php endforeach;
			endif;?>
		</div>
	<?php endif;?>		
	<?php if(!empty($list->id)): $this->extra_fields($list->id); endif;?>	
	<?php if(!empty($recaptcha_html)):?><p><?php echo $recaptcha_html?></p><?php endif;?>	
	<?php if(!empty($text_captcha_html)):?><p><?php echo $text_captcha_html?></p><?php endif;?>	
	
	<div class="bftpro-front-signup-button">
		<?php if(empty($list->signup_graphic)):?>
			<input type="submit" value="<?php _e('Subscribe', 'bftpro');?>">
		<?php else:?>
			<input type="image" src="<?php echo $list->signup_graphic?>">
		<?php endif;?>		
	</div>
	<input type="hidden" name="bftpro_subscribe" value="1">
	<?php if(!empty($list->id)):?>
		<input type="hidden" name="list_id" value="<?php echo $list->id?>">
	<?php endif;?>	
	<input type="hidden" name="required_fields[]" value="">
</form>