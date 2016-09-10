<h1><?php _e("BroadFast Autoresponder options", 'bftpro')?></h1>

<?php if(!empty($cron_warning)):?>
	<div class="bftpro-warning">
		<p><?php printf(__('WARNING: You have selected "I will set up a cron job on the server to send my emails" but we have not detected any hits to your cron job URL in the last 24 hours. The program cannot function properly If your cron job does not run at least once per day. Please check the <a href="%s">Help page</a> for more information and contact us if you need assistance with setting up your cron job.', 'bftpro'), 'admin.php?page=bftpro_help')?></p>	
	</div>
<?php endif;?>

<form method="post" class="bftpro">
<div class="postbox wp-admin" style="padding:5px;">
	<h3><?php _e('General Settings', 'bftpro')?></h3>

	<p><label><?php _e("Default sender:", 'bftpro')?></label> <input type="text" name="sender" value="<?php echo get_option('bftpro_sender')?>" size="30"></p>
	<p class="help"><?php _e("This will be used to pre-populate your sender email address in newsletters and autoresponder campaigns.<br> You can always change it individually in each form. Please note that this field should contain valid email address or name and email in the format <b>Name &ltemail@domain.com&gt;</b>", 'bftpro')?></p>	
	
	
	<p><label><?php _e("Email signature:", 'bftpro')?></label> <?php echo wp_editor(stripslashes(get_option("bftpro_signature")), "signature", array("textarea_rows"=>4));?></p>
	<div class="help"><?php _e("This field is optional. If you enter some text here, it will be added at the end of all your outgoing emails, right before the unsubscribe link", 'bftpro')?></div>
	<p><input type="submit" value="<?php _e('Save Options', 'bftpro')?>"></p>
</div>

<div class="postbox wp-admin" style="padding:5px;">
	<h3><?php _e('Settings For The Email Sending Process', 'bftpro')?></h3>	
	
	<p><input type="radio" name="cron_mode" value="real" <?php if(empty($cron_mode) or $cron_mode=='real') echo "checked"?> onclick="BFTProChangeCronMode(this, 'real');"> <?php _e('I will set up a', 'bftpro')?> <a href="#" onclick="jQuery('#realCronInfo').toggle();return false;"><?php _e('cron job', 'bftpro')?></a> <?php _e('on the server to send my emails.', 'bftpro')?> <strong><?php _e('(Recommended choice)', 'bftpro')?></strong></p>
	
	<div class="help" style="display:none;" id='realCronInfo'><?php _e("Cron jobs are scheduled tasks that run on your server. This is the preferred setting but you will need to set up a cron job through your web host control panel. For full details check <a href='admin.php?page=bftpro_help#cron'>Cron Jobs section</a> in the Help page.", 'bftpro')?></div>
	
	<p><input type="radio" name="cron_mode" value="web" <?php if(!empty($cron_mode) and $cron_mode=='web') echo "checked"?> onclick="BFTProChangeCronMode(this, 'web');"> <?php _e('I will rely on my blog visitors', 'bftpro')?> <a href="#" onclick="jQuery('#webCronInfo').toggle();return false;"><?php _e('to initiate the email sending by visiting my blog', 'bftpro')?></a></p>
	
	<div class="help" style="display:none;" id='webCronInfo'><?php _e("If for any reason you can't create real cron jobs, use this setting. For full details check <a href='admin.php?page=bftpro_help#cron'>Cron Jobs section</a> in the Help page.", 'bftpro')?></div>
	
	<div id="webCronOption" style="display:<?php echo (empty($cron_mode) or $cron_mode=='real')?'none':'block'?>;">
		<p><?php _e('In this case I want the sending to happen not more often than once each', 'bftpro')?> <input type="text" name="cron_minutes" value="<?php echo get_option('bftpro_cron_minutes');?>" size="4"> <?php _e('minutes.', 'bftpro')?></p>
		<p class="help"><?php _e("The purpose of this setting is to avoid overloading the server if you have too many visitors. There is no guarantee however that mailing will happen each X minutes, because someone has to visit your blog for mailing to start each time.", 'bftpro')?></p>		
	</div>	
	
	<p><label><?php _e("Send up to:", 'bftpro')?></label> <input type="text" name="mails_per_run" value="<?php echo get_option('bftpro_mails_per_run')?>"> <?php _e("emails at once", 'bftpro');?></p>
	<div class="help"><?php _e("This setting will be used to define how many emails can be sent at once. This is useful to avoid site crashes, as many hosts will limit your PHP execution time to 30 seconds. Usually you should aim for about 100, up to few hundreds, emails at once on shared hosts.", 'bftpro')?></div>
	
	<p><label><?php _e("Send up to:", 'bftpro')?></label> <input type="text" name="mails_per_day" value="<?php echo get_option('bftpro_mails_per_day')?>"> <?php _e("emails per day", 'bftpro');?></p>
	<div class="help"><p><?php _e("Many hosting companies limit the number of emails you can send per day. If your company imposes such limit, enter it here and the plugin will make sure no more than this number of emails is sent by it. Note that it cannot take into account any emails that do not originate from this autoresponder plugin.", 'bftpro')?></p>
	<p><?php _e('Have in mind also that I will always try to send the immediate emails like welcome messages and double opt-in emails regardless the limits given above.', 'bftpro')?></p>
	
	<p style="color:red;"><?php printf(__('Problems sending emails? Please check the <a href="%s" target="_blank">error log</a> and <a href="%s" target="_blank">this page</a>.', 'bftpro'), admin_url('admin.php?page=bftpro_help&tab=error_log'), "http://calendarscripts.info/bft-pro/howto.html")?></p></div>
	
	<p><input type="submit" value="<?php _e('Save Options', 'bftpro')?>"></p>
</div>

<div class="postbox wp-admin"  style="padding:5px;">
	<h3 class="hndle"><span><?php _e('Roles', 'bftpro') ?></span></h3>
	<div class="inside">		
	<h4><?php _e('Roles that can manage the autoresponder', 'bftpro')?></h4>
	
	<p><?php _e('By default only Administrator and Super admin can manage the autoresponder. You can enable other roles here.', 'bftpro')?></p>
	<p><?php foreach($roles as $key=>$r):
					if($key=='administrator') continue;
					$role = get_role($key);?>
					<input type="checkbox" name="manage_roles[]" value="<?php echo $key?>" <?php if($role->has_cap('bftpro_manage')) echo 'checked';?>> <?php echo $role->name?> &nbsp;
				<?php endforeach;?></p>	
	<p><?php _e('Only administrator or superadmin can change this!', 'watupro')?></p>
	</div>
	<p><input type="submit" value="<?php _e('Save Options', 'bftpro')?>"></p>
</div>

<div class="postbox wp-admin" style="padding:5px;">
	<h3><?php _e('Recaptcha Settings', 'bftpro')?></h3>
	
	<p><?php _e("You can optionally enable <a href='http://www.google.com/recaptcha' target='_blank'>ReCaptcha</a> to prevent spam bots to register to your mailing lists. You will need a ReCaptcha API key. You can <a href='http://www.google.com/recaptcha/whyrecaptcha' target='_blank'>get one here</a>. It's free.", 'bftpro')?></p>
	
	<p><label><?php _e('Public key:', 'bftpro')?></label> <input type="text" name="recaptcha_public" value="<?php echo get_option('bftpro_recaptcha_public');?>" size='60'></p>	
	
	<p><label><?php _e('Private key:', 'bftpro')?></label> <input type="text" name="recaptcha_private" value="<?php echo get_option('bftpro_recaptcha_private');?>" size='60'></p>
	
	<p class="help"><?php _e('Once you enter both your public and private ReCaptcha keys, a new checkbox will become visible for each mailing list to let you enable recaptcha when users register to it.', 'bftpro');?></p>
	<p><input type="submit" value="<?php _e('Save Options', 'bftpro')?>"></p>
</div>	

<div class="postbox wp-admin" style="padding:5px;">
	<h3><?php _e('Question based captcha', 'bftpro')?></h3>
	
	<p><?php _e("In addition to ReCaptcha or instead of it, you can use a simple text-based captcha. We have loaded 3 basic questions but you can edit them and load your own. Make sure to enter only one question per line and use = to separate question from answer.", 'bftpro')?></p>
	
	<p><textarea name="text_captcha" rows="10" cols="70"><?php echo stripslashes($text_captcha);?></textarea></p>
	<div class="help"><?php _e('This question-based captcha can be enabled individually by selecting a checkbox in the mailing list settings form. If you do not check the checkbox, the captcha question will not be generated.', 'bftpro');?></div>
	<p><input type="submit" value="<?php _e('Save Options', 'bftpro')?>"></p>
</div>

<div class="postbox wp-admin" style="padding:5px;">	
	<h3><?php _e('Global Double Opt-In Email', 'bftpro')?></h3>
	
	<p><label><?php _e('Email subject:', 'bftpro')?></label> <input type="text" name="optin_subject" value="<?php echo get_option('bftpro_optin_subject');?>" size="60"></p>
	<p><label><?php _e('Email message:', 'bftpro')?></label> <?php echo wp_editor(stripslashes(get_option('bftpro_optin_message')), 'optin_message')?></p>
	
	<div class="help"><?php _e("This email will be sent to the subscribers to those email lists that have \"Double opt-in\" requirement. You can override the subject and message for any list. <br> Feel free to use the masks {{list-name}}, {{url}}, {{name}}, and {{firstname}} inside the email subject and/or contents.", 'bftpro')?></div>
	<p><input type="submit" value="<?php _e('Save Options', 'bftpro')?>"></p>
</div>	

<div class="postbox wp-admin" style="padding:5px;">
	<h3><?php _e('Save All Options', 'bftpro')?></h3>
	
	<p><input type="submit" value="<?php _e('Save All Options', 'bftpro')?>"></p>
	<input type="hidden" name="bftpro_options" value="1">
</div>	
<?php echo wp_nonce_field('save_options', 'nonce_options');?>
</form>

<?php if(get_option('bft_db_version')):?>
	<form method="post">
	<div class="postbox wp-admin" style="padding:5px;">	
		<h3><?php _e('Copy Data from BFT Lite', 'bftpro')?></h3>
		
		<p><?php _e('By clicking the button below you can copy all your data from BFT Lite plugin. A new mailing list and new autoresponder will be created, and your current sequence will be kept as is and can continue from where you left it.', 'bftpro')?></p>
		
		<p><input type="submit" value="<?php _e('Copy Data', 'bftpro')?>" name="bftpro_copy_data"></p>
		
		<p><b><?php _e('Important! Once you are satisfied with the copied data make sure that BFT Lite is deactivated. Otherwise you may have emails sent twice.', 'bftpro')?></b></p>
	</div>
	<?php echo wp_nonce_field('save_uoptions', 'nonce_uoptions');?>
	</form>
<?php endif;?>

<form method="post">
<div class="postbox wp-admin" style="padding:5px;">	
	<h3><?php _e('Uninstall Options', 'bftpro')?></h3>
	
	<p><input type="checkbox" name="cleanup_db" value="1" <?php if(get_option('bftpro_cleanup_db')==1) echo "checked"?>> <?php _e('Delete all data and attachments when uninstalling the plugin. Think twice - if you check this you will lose ALL YOUR DATA when deleting the plugin. Do not check this if you are just upgrading to a newer version.', 'bftpro')?></p>
	
	<p><input type="submit" value="<?php _e('Save Uninstall Options', 'bftpro')?>" name="bftpro_uoptions"></p>
</div>
<?php echo wp_nonce_field('save_uoptions', 'nonce_uoptions');?>
</form>


<script type="text/javascript">
function BFTProChangeCronMode(chk, mode) {
	if(chk.checked) {
		if(mode=='web') jQuery('#webCronOption').show();
		else jQuery('#webCronOption').hide();
	}
	else {
		if(mode=='web') jQuery('#webCronOption').hide();
		else jQuery('#webCronOption').show();
	}
}
</script>