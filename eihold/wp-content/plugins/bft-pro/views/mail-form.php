<div class="wrap">

	<h1><?php echo empty($_GET['id'])?__("Add", 'bftpro'):__("Edit", 'bftpro')?> <?php _e("Email Message in", 'bftpro')?> "<?php echo $ar->name;?>"</h1>
	
	<?php bftpro_display_alerts(); ?>
	
	<p><a href="admin.php?page=bftpro_ar_campaigns&campaign_id=<?php echo $_GET['campaign->id']?>"><?php _e('Back to the autoresponder campaign', 'bftpro')?></a></p>
	
	<div class="postbox wp-admin" style="padding:5px;">
	<form method="post" class="bftpro" onsubmit="return validateBFTProMail(this);" id="BFTProMailForm" enctype="multipart/form-data">
		<fieldset>
			<legend><?php _e("Email Message Details", 'bftpro')?></legend>
			<div><label><?php echo __("From Address (Sender):", 'bftpro')?></label> <input type="text" name="sender" value="<?php echo empty($mail->sender)?$ar->sender:$mail->sender?>" size="40"></div>
			<div><label><?php echo __("Email Subject:", 'bftpro')?></label> <input type="text" name="subject" value="<?php echo stripslashes(@$mail->subject)?>" size="40"></div>
			<div><label><?php echo __("Email Message:", 'bftpro')?></label> <?php wp_editor(stripslashes(@$mail->message), "message");?></div>
			<div class="help"><p><?php _e("You can use the following short codes inside the email content. They will be replaced with dynamic data from your mailign lists.", 'bftpro')?></p>
				<p><?php _e("Basic fields", 'bftpro')?></p>
				<ul>
					<li><strong>{{email}}</strong> - <?php _e("subscriber email", 'bftpro')?></li>
					<li><strong>{{name}}</strong> - <?php _e("subscriber name", 'bftpro')?></li>
					<li><strong>{{firstname}}</strong> - <?php _e("subscriber first name", 'bftpro')?></li>
				</ul>			
				
				<?php if(!empty($fields) and sizeof($fields)):?>
				<p><?php _e("Custom fields", 'bftpro')?></p>
				<ul>
					<?php foreach($fields as $field):?>
						<li><strong>{{<?php echo $field->name?>}}</strong> - <?php _e(sprintf("From mailing list '%s'", $field->list_name), 'bftpro')?></li>
					<?php endforeach;?>
				</ul>
				<?php endif;?>
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
			<legend><?php _e("Email Sending Options", 'bftpro')?></legend>
			<div><input type="radio" name="artype" value="days" <?php if(empty($mail->id) or $mail->artype=='days') echo "checked"?>> <?php _e("Send", 'bftpro')?>
				<input type="text" name="days" size="4" value="<?php if(@$mail->artype=='days') echo @$mail->days?>"> <?php _e('days after user registration.', 'bftpro');?></div>
				<div><input type="radio" name="artype" value="date" <?php if(!empty($mail->id) and $mail->artype=='date') echo "checked"?>> <?php _e("Send on", 'bftpro')?>
				<?php echo BFTProQuickDDDate("send_on_date", empty($mail->send_on_date)?date("Y-m-d"):$mail->send_on_date, null, null, 2012);?></div>
				
				<div><input type="radio" name="artype" value="every_days" <?php if(!empty($mail->id) and $mail->artype=='every_days') echo "checked"?>> <?php _e("Send every", 'bftpro')?>
				<input type="text" name="every_days" size="4" value="<?php if(@$mail->artype=='every_days') echo @$mail->every?>"> <?php _e('days.', 'bftpro');?></div>
				
				<div><input type="radio" name="artype" value="every_weekday" <?php if(!empty($mail->id) and $mail->artype=='every_weekday') echo "checked"?>> <?php _e("Send every", 'bftpro')?>
				<select name="every_weekday">
					<option value="monday" <?php if(@$mail->every=='monday') echo "selected"?>><?php _e("Monday", 'bftpro');?></option>
					<option value="tuesday" <?php if(@$mail->every=='tuesday') echo "selected"?>><?php _e("Tuesday", 'bftpro');?></option>
					<option value="wednesday" <?php if(@$mail->every=='wednesday') echo "selected"?>><?php _e("Wednesday", 'bftpro');?></option>
					<option value="thursday" <?php if(@$mail->every=='thursday') echo "selected"?>><?php _e("Thursday", 'bftpro');?></option>
					<option value="friday" <?php if(@$mail->every=='friday') echo "selected"?>><?php _e("Friday", 'bftpro');?></option>
					<option value="saturday" <?php if(@$mail->every=='saturday') echo "selected"?>><?php _e("Saturday", 'bftpro');?></option>
					<option value="sunday" <?php if(@$mail->every=='sunday') echo "selected"?>><?php _e("Sunday", 'bftpro');?></option>
				</select></div>
				<?php do_action('bftpro-mail-form-sending-options', $ar, @$mail)?>
				
		</fieldset>
		
		<fieldset>
		<legend><?php _e("Time of the day", 'bftpro')?></legend>
		<div>
			<p><input type="radio" name="time_of_sending" value='any' <?php if(empty($mail->daytime)) echo "checked"?>> <?php _e('Send any time of the day', 'bftpro')?></p>   
			 <p><input type="radio" name="time_of_sending" value="specified" <?php if(!empty($mail->daytime)) echo "checked"?>> <?php _e('Send after', 'bftpro')?> 
	    	<select name="daytime">
	    	<?php for($i=0; $i<24; $i++):?>    		
	    		<option value="<?php echo $i?>"<?php if(!empty($mail->daytime) and $mail->daytime==$i):?> selected<?php endif;?>><?php echo sprintf("%02d",$i)?>:00</option> 
	    	<?php endfor;?>
	    	</select> <?php _e("o'clock", 'bftpro')?></p>
	    	<p><?php printf(__('This setting uses your MySQL server time. Your current server time is <b>%s</b>.', 'bftpro'), $server_time)?></p>
		</div>				
		</fieldset>	
		
		<?php do_action('bftpro-mail-form-segments', $ar, @$mail)?>
		
		<div>&nbsp;</div>
		<div><?php if(empty($_GET['id'])):?>
			<input type="submit" name="ok" value="<?php echo __('Create Email Message', 'bftpro');?>">
		<?php else:?>
			<input type="submit" name="ok" value="<?php echo __('Save Message', 'bftpro');?>">
			<input type="button" value="<?php echo __('Delete Message', 'bftpro');?>" onclick="confirmDelete(this.form);">
			<input type="hidden" name="del" value="0">
		<?php endif;?>
		<input type="button" value="<?php _e('Cancel', 'bftpro');?>" onclick="window.location='admin.php?page=bftpro_ar_mails&campaign_id=<?php echo $ar->id?>'"></div>
	</form>
	</div>	
</div>

<script type="text/javascript" >
function validateBFTProMail(frm)
{
	if(frm.sender.value=="")
	{
		alert("<?php _e("Please provide sender email for this email message", 'bftpro')?>");
		frm.sender.focus();
		return false;
	}
	
	if(frm.subject.value=="")
	{
		alert("<?php _e("Please provide subject", 'bftpro')?>");
		frm.subject.focus();
		return false;
	}
	
	return true;
}
</script>