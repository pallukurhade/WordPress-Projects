<h1><?php _e("Your Mailing Lists", 'bftpro')?></h1>

<?php bftpro_display_alerts(); ?>

<style type="text/css">
.bftpro-tab {
	padding: 10px;
	background-color: #EEE;
}

.bftpro-active {
	font-weight:bold;
	background-color: #DDD;
}
</style>

<p><a href="admin.php?page=bftpro_mailing_lists&do=add"><?php _e("Click here to add a new mailing list", 'bftpro')?></a></p>
<table class="widefat">
	<tr><th><?php _e("Name and description", 'bftpro')?></th><th><?php _e("Autoresponders", 'bftpro')?></th>
	<th><?php _e("Subscribers", 'bftpro')?></th><th><?php _e("Custom Fields", 'bftpro')?></th>
	<th><?php _e("Subscribe Form", 'bftpro')?></th><th><?php _e("Edit", 'bftpro')?></th></tr>
	
	<?php foreach($lists as $list):
		$class = ('alternate' == @$class) ? '' : 'alternate';?>
		<tr class="<?php echo $class?>"><td><h3><?php echo $list->name?></h3>
		<?php if(!empty($list->description)): echo "<p>".stripslashes($list->description)."</p>"; endif;?></td>
		<td><?php if($list->responders):?>
			<a href="admin.php?page=bftpro_ar_campaigns&list_id=<?php echo $list->id?>"><?php echo $list->responders;?></a>
		<?php else:
			 _e("None yet", 'bftpro'); 
		endif;?></td>
		<td><a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?>"><?php _e("Manage", 'bftpro')?> (<?php echo $list->subscribers?>)</a><br>
		<?php printf(__('%d%% open rate', 'bftpro'), $list->open_rate)?></td>
		<td><a href="admin.php?page=bftpro_fields&list_id=<?php echo $list->id?>"><?php _e("Manage", 'bftpro');?></a></td>
		<td>
			<p><?php _e('Shortcode:', 'bftpro')?> <input type="text" value="[bftpro <?php echo $list->id?>]" onclick="this.select();" readonly="readonly"></p>		
			
			<p><a href="#" onclick="jQuery('#visualCode<?php echo $list->id?>').toggle();return false;"><?php _e('WordPress-friendly form code (for the rich text editor)','bftpro')?></a></p>		
			
			<div id="visualCode<?php echo $list->id?>" style="display:none;padding:5px;">
				<h3><?php _e('How to use the code below:', 'bftpro')?></h3>
				<ol>
					<li><?php _e('Copy the code by clicking in the box below.','bftpro');?></li>
					<li><?php _e('Create a post or page in your blog or edit an existing post or page.', 'bftpro')?></li>
					<li><?php _e('Paste the code in the text or visual mode and feel free to edit it any way you wish without changing the contents of the shortcodes.', 'bftpro')?></li>
					
				</ol>			
				<?php $_list->visual = true;?>
					<p><a href="#" id="list<?php echo $list->id?>_textModeLink" onclick="jQuery('#list<?php echo $list->id?>_textMode').show();jQuery('#list<?php echo $list->id?>_visualMode').hide();jQuery(this).addClass('bftpro-active');jQuery('#list<?php echo $list->id?>_visualModeLink').removeClass('bftpro-active');return false;" class="bftpro-tab bftpro-active"><?php _e('For Text mode', 'bftpro');?></a>  <a href="#" id="list<?php echo $list->id?>_visualModeLink" onclick="jQuery('#list<?php echo $list->id?>_textMode').hide();jQuery('#list<?php echo $list->id?>_visualMode').show();jQuery(this).addClass('bftpro-active');jQuery('#list<?php echo $list->id?>_textModeLink').removeClass('bftpro-active');return false;" class="bftpro-tab"><?php _e('For Visual mode', 'bftpro')?></a></p>
					<div id="list<?php echo $list->id?>_textMode"><textarea rows="15" cols="80" readonly="true" onclick="this.select();"><?php $_list->signup_form($list->id, true)?></textarea></div>
					<div id="list<?php echo $list->id?>_visualMode" style="display:none;"><textarea rows="15" cols="80" readonly="true" onclick="this.select();"><?php $_list->signup_form($list->id, true, true)?></textarea></div>
				<?php $_list->visual = false;?>
			</div>
			
			<p><a href="#" onclick="jQuery('#formCode<?php echo $list->id?>').toggle();return false;"><?php _e('Form code for using outside of the blog (HTML)', 'bftpro')?></a></p>
			<div id="formCode<?php echo $list->id?>" style="display:none;padding:5px;"><div style="border:1px solid black;padding:5px;"><pre><?php echo htmlentities(BFTPro::shortcode_signup(array($list->id, true)))?></pre></div></div>
			
			<p><a href="admin.php?page=bftpro_integrate_contact&id=<?php echo $list->id?>"><?php _e('Integrate in contact form', 'bftpro')?></a></p>
		</td>
		<td><a href="admin.php?page=bftpro_mailing_lists&do=edit&id=<?php echo $list->id?>"><?php _e("Edit", 'bftpro');?></a></td></tr>
	<?php endforeach;?>
</table>

<p class="note">* <?php _e("You can embed every mailing list code right in any page or post. You can also enable a <a href='widgets.php'>widget</a> for the mailing list.", 'bftpro');?></p>

<h2><?php _e('Generic Codes', 'bftpro')?></h2>

<p><?php _e('This code will let the user choose which mailing list they want to sign up to by a drop-down selector (default). Please note that custom fields will not appear for such form and captcha will not be enabled. Required custom fields will be automatically filled with "1".', 'bftpro');?></p>

<p><?php _e('Generic shortcode:', 'bftpro')?> <input type="text" value="[bftpro]" readonly="readonly" onclick="this.select();"></p>

<p><?php _e('You can also specify a different mailing list selector:', 'bftpro')?> </p>

<p><input type="text" value='[bftpro mode="radio"]' readonly="readonly" onclick="this.select();" size="24"> <?php _e('will display radio buttons insead of drop-down.', 'bftpro')?><br>
<input type="text" value='[bftpro mode="checkbox"]' readonly="readonly" onclick="this.select();" size="24"> <?php _e('will display checboxes and will allow the user to subscribe to several mailing lists at once. The last selected list message and redirection settings will be used.', 'bftpro')?>
</p>