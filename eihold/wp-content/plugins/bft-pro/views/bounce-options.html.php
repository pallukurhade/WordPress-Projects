<div class="wrap">
	<h1><?php _e('Handle Bounced Emails', 'bftpro')?></h1>
	
	<p><?php _e('You can have one bounce email for all your autoresponder and newsletter campaigns. If you leave this blank the bounced emails will return to the same address which is used for sending.', 'bftpro')?></p>	
	
	<form method="post" class="bftpro">
		<div class="postbox wp-admin" style="padding:5px;">
			<div><label><?php _e('Email address to receive bounces:', 'bftpro')?></label>
				<input type="text" name="bounce_email" value="<?php echo $bounce_email?>"></div>
			
			<p><input type="checkbox" name="handle_bounces" value="1" <?php if($handle_bounces) echo 'checked'?> onclick="this.checked ? jQuery('#bounceHandling').show():jQuery('#bounceHandling').hide();"> <?php _e('I want to use automated bounces handling', 'bftpro')?></p>
			
			<fieldset id="bounceHandling" style="display:<?php echo $handle_bounces ? 'block' : 'none';?>">
				<legend><?php _e("Configure authomated bounce handling", 'bftpro')?></legend>
				<p style="color:red;"><?php _e('If you want to use this, the email address to receive bounces should be used <b>only for bounced emails and no other emails.</b>', 'bftpro')?></p>	
				<p><?php _e('Once in a while make sure to delete old emails from this email box. Handling thousands of bounced emails may slow down your site.', 'bftpro')?></p>			
				
				<div class="bftpro-help"><p><?php _e('This section lets you configure the plugin to automatically delete users who bounce. In order to achieve this you need to let the plugin login to check the bounce email using the POP3 account details. This will happen once per day.', 'bftpro')?></p>
				</div>
				
				<p><?php _e('Delete email from all mailing lists after it bounces', 'bftpro')?> <input type="text" name="bounce_limit" value="<?php echo $bounce_limit?>" size="4"> <?php _e('times.', 'bftpro')?></p>
				
				<div><label><?php _e('Email Server Host:', 'bftpro')?></label> <input type="text" name="bounce_host" value="<?php echo $bounce_host?>"></div>
				<div><label><?php _e('Email Server Port:', 'bftpro')?></label> <input type="text" name="bounce_port" value="<?php echo $bounce_port?>" size="5"></div>
				<div><label><?php _e('Account Login:', 'bftpro')?></label> <input type="text" name="bounce_login" value="<?php echo $bounce_login?>"></div>
				<div><label><?php _e('Account Password:', 'bftpro')?></label> <input type="password" name="bounce_pass" value="<?php echo stripslashes($bounce_pass)?>"></div>				
				
				</div>
			</fieldset>
			
			<p><input type="submit" value="<?php _e('Save Options', 'bftpro')?>" name="ok"></p>	
		</div>	
	</form>
</div>