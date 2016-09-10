<div class="wrap">
	<h1><?php _e('Mailing List to Contact Form Integration', 'bftpro')?></h1>
		
	<p><a href="admin.php?page=bftpro_mailing_lists"><?php _e('Back to the mailing lists', 'bftpro')?></a></p>
	
	<p><?php printf(__('Using the shortcode below will display a checkbox for subscribing in the mailing list inside your contact form. We currently support integration with the most popular contact form plugin - <a href="%s" target="_blank">Contact Form 7</a>.', 'bftpro'),'http://wordpress.org/plugins/contact-form-7/');?></p>
	
	<table>
		<tr><td width="50%" valign="top">
			<div class="postbox wp-admin" style="padding:10px;">
				<form method="post" class="bftpro">
					<div><label><?php _e('Select mailing list:', 'bftpro')?></label> <select name="list_id" onchange="this.form.submit();">
						<?php foreach($lists as $l):
							$selected = ($l->id == $list_id) ? ' selected' : '';?>
							<option value="<?php echo $l->id?>"<?php echo $selected?>><?php echo $l->name?></option>
						<?php endforeach;?>
					</select></div>
					<div><input type="checkbox" name="checked_by_default" value="1" <?php if(!empty($_POST['checked_by_default'])) echo 'checked'?>> <?php _e('Checked by default', 'bftpro')?></div>
				
					<div><label><?php _e('CSS classes (optional):', 'bftpro')?></label> <input type="text" name="classes" value="<?php echo @$_POST['classes']?>"></div>
					<div><label><?php _e('HTML ID (optional):', 'bftpro')?></label> <input type="text" name="html_id" value="<?php echo @$_POST['html_id']?>"></div>
					<p><input type="submit" value="<?php _e('Refresh Shortcode', 'bftpro')?>"></p>
					
					<p><?php _e('Shortcode to use in contact form:', 'bftpro')?> 
					<textarea readonly="readonly" onclick="this.select()" rows="2" cols="40">[bftpro-int-chk list_id="<?php echo $list_id?>"<?php echo $shortcode_atts?>] <?php printf(__('Subscribe for %s', 'bftpro'), $list->name)?></textarea></p>
					
					<p><b><?php _e('Place this shortcode inside your Contact Form 7 contact form - right where you want the checkbox to appear.', 'bftpro')?></b></p>
				</form> 
			</div>
		</td><td width="50%" valign="top">
			<?php if(sizeof($fields)):?>
			<div class="postbox wp-admin" style="padding:10px;">
				<p><?php _e('The selected mailing list has some custom fields. Using the shortcodes below you can have these fields also included in your contact form.', 'bftpro')?></p>
				<p><?php _e('The information from these fields will not be included in the contact form message, but will be stored along with your subscribed user data in the mailing list.', 'bftpro')?></p>
				
				<table class="widefat">
					<tr><th><?php _e('Field', 'bftpro')?></th>
					<th><?php _e('Code', 'bftpro')?></th></tr>
					<?php foreach($fields as $field):
						$class = ('alternate' == @$class) ? '' : 'alternate';?>
						<tr class="<?php echo $class?>"><td><?php echo stripslashes($field->label)?></td><td><textarea rows="2" cols="30" readonly="readonly" onclick="this.select();"><p><?php echo $field->label?><br />
[bftpro-field <?php echo $field->id?>]</p></textarea></td></tr>
					<?php endforeach;?>
				</table>
				
				<p><b><?php _e('Place any of these codes inside your Contact Form 7 contact form - right where you want the custom field to appear.', 'bftpro')?></b></p>
			</div>		
			<?php endif;?>
		</td></tr>	
	</table>	 
</div>