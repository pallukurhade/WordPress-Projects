<h1><?php echo empty($_GET['id'])?__("Add", 'bftpro'):__("Edit", 'bftpro')?> <?php _e("Mailing List", 'bftpro')?></h1>

<?php bftpro_display_alerts(); ?>

<div class="postbox wp-admin" style="padding:5px;">
<form method="post" class="bftpro" onsubmit="return validateBFTProList(this);" id="BFTProListForm">
	<fieldset>
		<legend><?php _e("List Details", 'bftpro')?></legend>
		<p><label><?php echo __("List Name:", 'bftpro')?></label> <input type="text" name="name" value="<?php echo @$list->name?>"></p>
		<p><label><?php echo __("Default Sender Email:", 'bftpro')?></label> <input type="text" name="sender" value="<?php echo @$list->sender?$list->sender:get_option('bftpro_sender');?>"></p>
		<p class="help"><?php _e('Used for double opt-in and other automated messages.')?></p>
		<p><label><?php echo __("Optional Description:", 'bftpro')?></label> <textarea name="description" rows="5" cols="40"><?php echo stripslashes(@$list->description)?></textarea></p>
		<p style="display:<?php echo (get_option('bftpro_recaptcha_public') and get_option('bftpro_recaptcha_private'))?'block':'none';?>">
			<input type="checkbox" name="require_recaptcha" value="1" <?php if(!empty($list->require_recaptcha)) echo 'checked'?>> <?php _e('Enable ReCaptcha for any signup forms of this mailing list.', 'bftpro')?>	<b><?php _e('Note that reCaptcha can be included only once in one web page.', 'bftpro')?></b>	
		</p>
		
		<input type="checkbox" name="require_text_captcha" value="1" <?php if(!empty($list->require_text_captcha)) echo 'checked'?>> <?php _e('Enable Question based "captcha" for any signup forms of this mailing list.', 'bftpro')?>	
	</fieldset>
	
	<fieldset>
		<legend><?php _e("Registration Settings", 'bftpro')?></legend>
		<p><input type="checkbox" name="do_notify" value="1" <?php if(!empty($list->do_notify)) echo "checked"?> onclick="BFTPRO.changeNotify();"> <?php _e("Notify me when a new subscriber registers", 'bftpro')?></p>	
		
		<p><input type="checkbox" name="unsubscribe_notify" value="1" <?php if(!empty($list->unsubscribe_notify)) echo "checked"?>> <?php _e("Notify me when a someone unsubscribes", 'bftpro')?></p>	
		
		<p><input type="checkbox" name="auto_subscribe" value="1" <?php if(!empty($list->auto_subscribe)) echo "checked"?>> <?php _e("Automatically subscribe in this list everyone who registers in my blog (To avoid spam subscriptions this will happen after they log-in for the first time!)", 'bftpro')?></p>	
		
		<p><input type="checkbox" name="subscribe_to_blog" value="1" <?php if(!empty($list->subscribe_to_blog)) echo "checked"?>> <?php _e("When user subscribes to this mailing lists, register them as subscriber for my site too. (Happens when the subscription is activated.)", 'bftpro')?></p>	
		
		<p><label><?php _e("Notifications email(s):", 'bftpro')?></label> <input type="text" name="notify_email" value="<?php echo empty($list->notify_email)?get_option('bftpro_sender'):$list->notify_email?>" <?php if(empty($list->do_notify) and empty($list->unsubscribe_notify)) echo "disabled='true'";?> size="40"> <?php _e('(You can enter multiple notification emails separated by comma)', 'bftpro')?></p>
		
		<p><label><?php _e("After registration,<br> go to (Enter full URL):", 'bftpro')?></label> <input type="text" name="redirect_to" value="<?php echo @$list->redirect_to?>" size="60"></p>
		
		<p><input type="checkbox" name="require_name" value="1" <?php if(!empty($list->require_name)) echo "checked"?>> <?php _e("Make 'name' a required field (email is always required)", 'bftpro')?></p>	
	</fieldset>	
	
	<fieldset>
		<legend><?php _e("Registration Form Settings", 'bftpro')?></legend>
		<p><?php printf(__('Optionally you can use a graphic for the "Submit" button on the registration form. There are multiple codes that can be used to display this registration form on your site - you can get them from your <a href="%s">mailing lists</a> page.', 'bftpro'), 'admin.php?page=bftpro_mailing_lists');?></p>
		
		<p><label><?php _e('Graphic URL:', 'bftpro')?></label> <input type="text" name="signup_graphic" value="<?php echo @$list->signup_graphic?>" size="50"> <?php _e('(Leave blank to use the default signup button)', 'bftpro')?></p>
		
		<p><?php printf(__('If you want to upload graphic you can do it in your <a href="%s" target="_blank">media library</a>. Then you can copy the file URL as shown <a href="%s" target="_blank">here</a>.', 'bftpro'), 'upload.php', 'http://www.wpuniversity.com/wordpress-tips/find-media-library-file-url/')?></p>
	</fieldset>	
	
	<fieldset>
		<legend><?php _e("Email Confirmation Settings", 'bftpro')?></legend>	
		<p><input type="checkbox" name="optin" value="1" <?php if(!empty($list->optin)) echo "checked"?> onclick="BFTPRO.changeOptin(this);"> <?php _e("Require email confirmation ('Double opt-in') when someone subscribes for this mailing list.", 'bftpro')?></p>	
		
		<p class="bftpro-optin" <?php if(empty($list->optin)):?>style="display:none;"<?php endif;?>><label><?php _e("After double opt-in confirmation, go to (Enter full URL):", 'bftpro')?></label> <input type="text" name="redirect_confirm" value="<?php echo @$list->redirect_confirm?>"></p>
		
		<div class="bftpro-optin" <?php if(empty($list->optin)):?>style="display:none;"<?php endif;?>><p><?php _e("Confirmation subject and message are optional. If you omit them, I'll use the ones saved in your <a href='admin.php?page=bftpro_options'>Broadfast Settings</a> page. Feel free to use the masks {{list-name}} and {{url}} inside the email subject and/or contents. <strong>Using HTML Code is allowed.</strong> If you don't enter anything here, default content will be used.", 'bftpro')?></p></div>
	
		<p class="bftpro-optin" <?php if(empty($list->optin)):?>style="display:none;"<?php endif;?>><label><?php echo __("Confirmation Subject:", 'bftpro')?></label> <input type="text" name="confirm_email_subject" value="<?php echo @$list->confirm_email_subject?>" size="60"></p>
		<div class="bftpro-optin" <?php if(empty($list->optin)):?>style="display:none;"<?php endif;?>><p><label><?php echo __("Confirmation message:", 'bftpro')?></label> <textarea name="confirm_email_content" rows="10" cols="80"><?php echo stripslashes(@$list->confirm_email_content)?></textarea></p>
		<p class="bftpro-help"><?php printf(__('You can use the variables %s and %s to customize this message.', 'bftpro'), '{{name}}', '{{firstname}}');?></p>		
		</div>		
	</fieldset>
	
	<fieldset>
		<legend><?php _e("Unsubscribe Text", 'bftpro')?></legend>
		<p><?php _e("If you leave this empty, default text will be used. The unsubscribe link will be added after your text.", 'bftpro')?></p>
		<div><textarea name="unsubscribe_text" rows="5" cols="60"><?php echo stripslashes(@$list->unsubscribe_text)?></textarea></div>
	</fieldset>		
	
	<div>&nbsp;</div>
	<div><?php if(empty($_GET['id'])):?>
		<input type="submit" name="ok" value="<?php echo __('Add Mailing List', 'bftpro');?>">
	<?php else:?>
		<input type="submit" name="ok" value="<?php echo __('Save List', 'bftpro');?>">
		<input type="button" value="<?php echo __('Delete List', 'bftpro');?>" onclick="confirmDelete(this.form);">
		<input type="hidden" name="del" value="0">
	<?php endif;?>
	<input type="button" value="<?php _e('Cancel', 'bftpro');?>" onclick="window.location='admin.php?page=bftpro_mailing_lists'"></div>
</form>
</div>

<script type="text/javascript" >
function validateBFTProList(frm)
{
	
	if(frm.name.value=="")
	{
		alert("<?php _e("Please provide at least a name", 'bftpro')?>");
		frm.name.focus();
		return false;
	}
	
	return true;
}

jQuery(function(){
	BFTPRO.changeNotify = function()
	{
		if(jQuery('#BFTProListForm input[name=do_notify]').attr("checked") 
			|| jQuery('#BFTProListForm input[name=unsubscribe_notify]').attr("checked")) {
			jQuery('#BFTProListForm input[name=notify_email]').removeAttr('disabled');
		}
		else jQuery('#BFTProListForm input[name=notify_email]').attr('disabled','true');
	}
	
	BFTPRO.changeOptin = function(elt)
	{
		if(elt.checked) {
			jQuery(".bftpro-optin").show();
		}
		else {
			jQuery(".bftpro-optin").hide();
		}
	}
});
</script>