<div class="wrap">
	<h1><?php _e('Subscribe by Email', 'bftpro');?></h1>
	
	<p><?php _e('This page lets you configure automated subscription to your mailing lists by sending email to a designated email address. It needs POP3 account login details to check the designaded email address for new signups.', 'bftpro');?></p>
	
	
	<form method="post" class="bftpro">
		<div class="postbox wp-admin" style="padding:5px;">
			<p><label><?php _e('Email address to receive signups:', 'bftpro')?></label>
				<input type="text" name="email" value="<?php echo @$options['email']?>"></p>
				
				<p style="color:red;"><?php _e('If you want to use this, the email address to receive signups should be used <b>only for automated signups and nothing else.</b>', 'bftpro')?> </p>	
				<p><?php _e('Once in a while make sure to delete old emails from this email box. Handling thousands of emails may slow down your site. We will anyway discard messages older than one week.', 'bftpro')?></p>			
				
				<p class="bftpro-help"><?php _e('This section lets you configure the plugin to automatically delete users who bounce. In order to achieve this you need to let the plugin login to check the signup email using the POP3 account details. This will happen once per day.', 'bftpro')?></p>				
			<fieldset>
				<legend><?php _e("POP 3 Login Details", 'bftpro')?></legend>				
				
				<p><label><?php _e('Email Server Host:', 'bftpro')?></label> <input type="text" name="host" value="<?php echo @$options['host']?>"></p>
				<p><label><?php _e('Email Server Port:', 'bftpro')?></label> <input type="text" name="port" value="<?php echo @$options['port']?>" size="5"></p>
				<p><label><?php _e('Account Login:', 'bftpro')?></label> <input type="text" name="login" value="<?php echo @$options['login']?>"></p>
				<p><label><?php _e('Account Password:', 'bftpro')?></label> <input type="password" name="pass" value="<?php echo stripslashes(@$options['pass'])?>"></p>				
				
				
			</fieldset>
			
			<fieldset>
				<legend><?php _e("Configure Mailing Lists", 'bftpro')?></legend>
				
				<p><?php _e('When someone sends email to the selected email address they will be subscribed to the selected mailing lists. You can fine-tune this by entering a phrase that should be contained in the email subject. This way you will not only prevent spam subscriptions but can also use subscribe different emails for different mailing lists.', 'bftpro');?></p>
				
				<?php foreach($lists as $list):?>
					<div>
						<p><input type="checkbox" name="list_ids[]" value="<?php echo $list->id?>" <?php if(isset($options['lists'][$list->id])) echo 'checked'?> onclick="jQuery('#listSettings<?php echo $list->id?>').toggle();"> <?php echo $list->name?></p>
						<div id="listSettings<?php echo $list->id?>" style="padding:10px;display:<?php echo isset($options['lists'][$list->id]) ? 'block' : 'none';?>">
							<p><label><?php _e('Subject contains:', 'bftpro')?></label> <input type="text" name="subject_contains_<?php echo $list->id?>" value="<?php echo isset($options['lists'][$list->id]) ? $options['lists'][$list->id]['subject_contains'] : '';?>" size="30"></p>							
							<p><input type="checkbox" name="ignore_optin_<?php echo $list->id?>" value="1" <?php if(!empty($options['lists'][$list->id]['ignore_optin'])) echo 'checked';?>> <?php _e('Ignore the mailing list double opt-in settings and activate the sender immediately.', 'bftpro')?></p>
						</div>
					</div>
				<?php endforeach;?>
			</fieldset>	
			
			<p><input type="submit" value="<?php _e('Save Options', 'bftpro')?>" name="ok"></p>	
		</div>	
	</form>
</div>