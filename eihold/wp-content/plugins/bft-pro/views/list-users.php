<div class="wrap">
	<h1><?php _e("Subscribers In Mailing List '{$list->name}'", 'bftpro')?></h1>
	
	<p><a href="admin.php?page=bftpro_mailing_lists"><?php _e('Manage mailing lists', 'bftpro')?></a>
	| <a href="admin.php?page=bftpro_ar_campaigns"><?php _e('Manage autoresponder campaigns', 'bftpro')?></a></p>	
	
	<div class="postbox wp-admin">
		<p class="inside"><a href="#" onclick="jQuery('#userFilters').toggle();return false;"><?php _e('Show/Hide Search Form', 'bftpro')?></a></p>
		<div class="inside" id="userFilters" style="display:<?php echo $any_filters?'block':'none'?>;">
			<form class="bftpro" method="get">
			<input type="hidden" name="id" value="<?php echo $list->id?>">
			<input type="hidden" name="page" value="bftpro_subscribers">
				<div><label><?php _e('Filter by email', 'bftpro')?>:</label> <input type="text" name="filter_email" value="<?php echo @$_GET['filter_email']?>"></div>
				<div><label><?php _e('Filter by name', 'bftpro')?>:</label> <input type="text" name="filter_name" value="<?php echo @$_GET['filter_name']?>"></div>
				<div><label><?php _e('Filter by status', 'bftpro')?>:</label> <select name="filter_status">
				<option value="-1" <?php if(!isset($_GET['filter_status']) or $_GET['filter_status']=='-1') echo "selected"?>><?php _e("Any Status", 'bftpro')?></option>
				<option value="1" <?php if(isset($_GET['filter_status']) and $_GET['filter_status']=='1') echo "selected"?>><?php _e("Active", 'bftpro')?></option>	
				<option value="0" <?php if(isset($_GET['filter_status']) and $_GET['filter_status']==='0') echo "selected"?>><?php _e("Inactive", 'bftpro')?></option>
				<option value="-2" <?php if(!empty($unsubscribed_filter)) echo "selected"?>><?php _e("Unsubscribed", 'bftpro')?></option>
				</select></div>
				<div><label><?php _e('Filter by IP address', 'bftpro')?>:</label> <input type="text" name="filter_ip" value="<?php echo @$_GET['filter_ip']?>"></div>
				<div><label><?php _e('No. mails opened:', 'bftpro')?></label> <input type="text" name="readmails_from" size="4" value="<?php echo @$_GET['readmails_from']?>"> - <input type="text" name="readmails_to" size="4" value="<?php echo @$_GET['readmails_to']?>"> <?php _e('(from - to)', 'bftpro')?>
					<div class="help"><?php _e('Note that "No. mails opened" is not 100% reliable stat. It loads a small graphic in the email to mark which email is opened. But nowadays many email clients do not show the graphics by default, unless the user explicitly selects so.', 'bftpro');?></div>			
				</div>
				<?php do_action('bftpro-subcribers-filter-form');?>
				<div><input type="submit" value="<?php _e('Filter subscribers', 'bftpro');?>">
				<input type="button" value="<?php _e('Reset filters', 'bftpro')?>" onclick="window.location='admin.php?page=bftpro_subscribers&id=<?php echo $list->id?>';"></div>
			</form>
		</div>
	</div>
	
	<p><a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?>&do=add"><?php _e("Add Subscriber", 'bftpro')?></a> | <a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?>&do=import"><?php _e("Import Subscribers", 'bftpro')?></a>
	<?php if($cnt_users):?>
	| <a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?>&export=1&noheader=1<?php echo BFTProLinkHelper::subscribers_filters()?>"><?php _e("Export Subscribers", 'bftpro');?></a> &nbsp;<?php printf(__('(The exported file will be <b>semicolon</b> delimited. See <a href="%s" target="_blank">how to open it</a>.)', 'bftpro'), 'http://www.ablebits.com/office-addins-blog/2014/05/01/convert-csv-excel/');?>
	<?php endif;?></p>
	
	<?php if($cnt_users):?>
		<form method="post" id="subscribersForm">
		<table class="widefat">
			<tr><td><input type="checkbox" onclick="bftproSelectAll(this);"></td><th><a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?><?php echo BFTProLinkHelper::subscribers('name')?>"><?php _e('Name', 'bftpro')?></a></th><th><a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?><?php echo BFTProLinkHelper::subscribers('name')?>"><?php _e('Email', 'bftpro')?></a></th><th><a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?><?php echo BFTProLinkHelper::subscribers('status')?>"><?php _e('Status', 'bftpro')?></a></th><th><a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?><?php echo BFTProLinkHelper::subscribers('date')?>"><?php _e('Date Signed', 'bftpro')?></a></th>
			<th><?php _e('Emails sent', 'bftpro')?></th>
			<th><?php _e('Emails read', 'bftpro')?></th>
			<th><?php _e('Open rate', 'bftpro')?></th>	
			<?php if(sizeof($datas)):?>
				<th><?php _e('Custom fields', 'bftpro')?></th>
			<?php endif;?>				
			<th><?php _e('Edit/Delete', 'bftpro')?></th></tr>
			<?php foreach($users as $user):
				$class = ('alternate' == @$class) ? '' : 'alternate';?>
				<tr class="<?php echo $class?>"><td><input type="checkbox" name="ids[]" value="<?php echo $user['id']?>" class="userid" onclick="showHideDelBtn();"></td><td><?php echo $user['name']?></td><td><?php echo $user['email']?></td>
				<td><?php echo $user['status']?__('Active', 'bftpro'):__('Inactive', 'bftpro');
				if($user['unsubscribed']) echo ' '.__('(Unsubscribed)', 'bftpro');?></td>
				<td><?php echo date(get_option('date_format'), strtotime($user['date'])) ?></td>
				<td><a href="admin.php?page=bftpro_user_log&id=<?php echo $user['id']?>" target="_blank"><?php echo $user['num_sent']?></a></td>
				<td><?php echo $user['num_read']?></td>
				<td><?php echo $user['open_rate']?>%</td>
				<?php if(sizeof($datas)):?>
					<td><?php echo $user['custom_data']?></td>
		  		<?php endif;?>		
				<td><a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?>&do=edit&user_id=<?php echo $user['id']?>"><?php _e("Edit", 'bftpro')?></a></td></tr>
			<?php endforeach;?>
		</table>
		<p align="center" id="massDeleteBtn" style="display:none;"><input type="button" value="<?php _e('Delete Selected Subscribers', 'bftpro')?>" onclick="confirmMassDelete(this.form);"></p>
		<input type="hidden" name="mass_delete" value="0">
		</form>
		<p align="center">
		<?php if($offset>0):?>
		&nbsp; <a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?>&offset=<?php echo ($offset-$limit)?><?php echo BFTProLinkHelper::subscribers($orderby, false)?>"><?php _e("Previous Page", 'bftpro');?></a>
			&nbsp;
		<?php endif;?>
		<?php if($cnt_users > ($limit + $offset)):?>
		&nbsp; <a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?>&offset=<?php echo ($offset+$limit)?><?php echo BFTProLinkHelper::subscribers($orderby, false)?>"><?php _e("Next Page", 'bftpro');?></a> &nbsp;
		<?php endif;?>	
		</p>
	<?php else:?>
	<p><strong><?php _e("There are no subscribers in this list yet or none of them match your filters.", 'bftpro')?></strong></p>
	<?php endif;?>
</div>	

<script type="text/javascript">
function bftproSelectAll(chk) {
	if(chk.checked) {
		jQuery('#massDeleteBtn').show();
		jQuery('.userid').attr('checked', 'true');
	} else {
		jQuery('.userid').removeAttr('checked');
		jQuery('#massDeleteBtn').hide();
	}
}

function confirmMassDelete(frm) {
	if(confirm("<?php _e('Are you sure?', 'bftpro')?>")) {
		frm.mass_delete.value=1;
		frm.submit();
	}
}

// show or hide the delete button
function showHideDelBtn() {
	var anyChecked = false;
	jQuery('.userid').each(function(){
		if(jQuery(this).attr('checked')) anyChecked = true;	
	});
	
	if(anyChecked) jQuery('#massDeleteBtn').show();
	else jQuery('#massDeleteBtn').hide();
}
</script>