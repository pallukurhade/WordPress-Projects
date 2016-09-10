<h1><?php echo empty($_GET['id'])?__("Add", 'bftpro'):__("Edit", 'bftpro')?> <?php _e("Newsletter", 'bftpro')?></h1>

<?php bftpro_display_alerts(); ?>

<div class="postbox wp-admin" style="padding:5px;">
<form method="post" class="bftpro" onsubmit="return validateBFTProNL(this);" id="BFTProNLForm" enctype="multipart/form-data">
	<fieldset>
		<legend><?php _e("Newsletter Message Details", 'bftpro')?></legend>
		<div><label><?php echo __("From Address (Sender):", 'bftpro')?></label> <input type="text" name="sender" value="<?php echo empty($mail->sender)?get_option('bftpro_sender'):$mail->sender?>" size="40"></div>
		<div><label><?php echo __("Newsletter Subject:", 'bftpro')?></label> <input type="text" name="subject" value="<?php echo stripslashes(@$mail->subject)?>" size="40"></div>
		<div><label><?php echo __("Newsletter Message:", 'bftpro')?></label> <?php wp_editor(stripslashes(@$mail->message), "message");?></div>
		<div class="help"><p><?php _e("You can use the following short codes inside the email content. They will be replaced with dynamic data from your mailign lists.", 'bftpro')?></p>
			<p><?php _e("Basic fields", 'bftpro')?></p>
			<ul>
				<li><strong>{{email}}</strong> - <?php _e("subscriber email", 'bftpro')?></li>
				<li><strong>{{name}}</strong> - <?php _e("subscriber name", 'bftpro')?></li>
				<li><strong>{{firstname}}</strong> - <?php _e("subscriber first name", 'bftpro')?></li>
			</ul>			
			
			<p><?php _e('Other dynamic tags may be available depending on the mailing list you choose to send to', 'bftpro')?></p>
		</div>		
		
		<div><label><?php _e("Email type:", 'bftpro')?></label> <select name="mailtype">
			<option value="text/html" <?php if(!empty($mail->mailtype) and $mail->mailtype=='text/html') echo 'selected'?>><?php _e("HTML", 'bftpro');?></option>
			<option value="text/plain" <?php if(!empty($mail->mailtype) and $mail->mailtype=='text/plain') echo 'selected'?>><?php _e("Text", 'bftpro');?></option>
			<option value="both" <?php if(!empty($mail->mailtype) and $mail->mailtype=='both') echo 'selected'?>><?php _e("Both", 'bftpro');?></option>
		</select></div>		
	</fieldset>
	
		<fieldset>
		<legend><?php _e("Attachments (optional)", 'bftpro')?></legend>
		<div><label><?php _e('Upload file(s):', 'bftpro')?></label> <input type="file" name="attachments[]" multiple="multiple"></div>
		<?php wp_nonce_field('bftpro_attach_nonce','bftpro_attach_nonce');?>
		<?php $_att->list_editable(@$attachments);?>
	</fieldset>	
	<?php do_action('bftpro-mail-form-designs', @$mail->template_id)?>
	<fieldset>
		<legend><?php _e("Select Mailing List", 'bftpro')?></legend>
		<div><label><?php _e('Send to this list:', 'bftpro')?></label> <select name="list_id" id="bftproSelectListId">
			<option value=""><?php _e("- Please select -", 'bftpro')?></option>
			<?php foreach($lists as $list):?>
				<option value="<?php echo $list->id?>"<?php if(!empty($mail->list_id) and $mail->list_id==$list->id) echo " selected"?>><?php echo $list->name;?></option>
			<?php endforeach;?>
		</select></div>
	</fieldset>		
	
	<fieldset>
		<legend><?php _e("Test Newsletter", 'bftpro')?></legend>
		<p><input type="checkbox" name="test_newsletter" value="1"> <?php _e('Send only a test email', 'bftpro')?></p>
		<div class="bftpro-help"><?php printf(__('When this is selected click on "Send" button and the newsletter will be delivered to %s. It will not be sent or resent to the mailing list and will not disturb in any way any sending in progress.', 'bftpro'), get_option('bftpro_sender'))?></div>
	</fieldset>
	
	<div id="bfproSegments">
	<?php do_action('bftpro-newsletter-form-segments', @$mail, $lists[0]->id);?>
	</div>
	
	<div>&nbsp;</div>
	<div><?php if(empty($_GET['id'])):?>
		<input type="submit" value="<?php echo __('Create and Save', 'bftpro');?>">
		<input type="submit" name="send" value="<?php echo __('Create And Send', 'bftpro');?>">
	<?php else:?>
		<input type="submit" value="<?php echo __('Save Newsletter', 'bftpro');?>">
		<input type="submit" name="send" value="<?php echo __('Save and Send', 'bftpro');?>">
		<?php if($mail->status=='in progress'):?>
			<input type="submit" name="cancel" value="<?php echo __('Cancel Sending', 'bftpro');?>">
		<?php endif;?>
		<input type="button" value="<?php echo __('Delete Newsletter', 'bftpro');?>" onclick="confirmDelete(this.form);">
		<input type="hidden" name="del" value="0">
	<?php endif;?>
	<input type="button" value="<?php _e('Cancel', 'bftpro');?>" onclick="window.location='admin.php?page=bftpro_newsletters'"></div>

	<?php if(!empty($mail->id) and $mail->status=='in progress'):?>
		<div class="bftpro-warning"><?php _e("Warning: this newsletter is currently in progress. This means that if you click on 'Save Newsletter' button, the changes will affect all the subscribers that have not yet received the newsletter. If you click 'Save and Send' the mailing will be RESTARTED from the beginning with the new content.", 'bftpro')?></div>
	<?php endif;?>	
	
	<input type="hidden" name="ok" value="1">
</form>
</div>	

<script type="text/javascript" >
function validateBFTProNL(frm)
{
	if(frm.sender.value=="")
	{
		alert("<?php _e("Please provide sender email for this newsletter", 'bftpro')?>");
		frm.sender.focus();
		return false;
	}
	
	if(frm.subject.value=="")
	{
		alert("<?php _e("Please provide subject", 'bftpro')?>");
		frm.subject.focus();
		return false;
	}
	
	if(frm.list_id.value=="") {
		alert("<?php _e('Please select mailing lsit', 'bftpro');?>");
		frm.list_id.focus();
		return false;
	}
	
	return true;
}
</script>

<?php do_action('bftpro-newsletter-form-js', @$mail);?>