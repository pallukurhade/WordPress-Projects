<div class="wrap">

	<h1><?php _e("Your Autoresponder Campaigns", 'bftpro')?></h1>
	
	<?php bftpro_display_alerts(); ?>
	
	<p><a href="admin.php?page=bftpro_ar_campaigns&do=add"><?php _e("Click here to create a marketing campaign", 'bftpro')?></a></p>
	
	<?php if(!empty($_GET['list_id'])):?>
	<p><strong><?php _e(sprintf("The autoresponder campaigns are currently filtered so only those assigned to the mailing list \"%s\" are shown.", $filter_list->name), 'bftpro')?> <a href="admin.php?page=bftpro_ar_campaigns"><?php _e("Remove filter and show all campaigns", 'bftpro')?></a></strong></p>
	<?php endif;?>
	
	<?php if(sizeof($campaigns)):?>
	<table class="widefat">
		<tr><th><?php _e("Name and description", 'bftpro')?></th><th><?php _e("Mailing lists", 'bftpro')?></th>
		<th><?php _e("Email Messages", 'bftpro')?></th><th><?php _e('Reports', 'bftpro')?></th><th><?php _e("Edit", 'bftpro')?></th></tr>
		
		<?php foreach($campaigns as $campaign):
			$class = ('alternate' == @$class) ? '' : 'alternate'; ?>
			<tr class="<?php echo $class?>"><td><h3><?php echo $campaign->name?></h3>
			<?php if(!empty($campaign->description)): echo "<p>".stripslashes($campaign->description)."</p>"; endif;?></td>
			<td><?php if(sizeof($campaign->lists)):
				foreach($campaign->lists as $lct=>$list):
				if($lct>0): echo ", "; endif;?>
				<a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?>"><?php echo $list->name;?></a>			
			<?php endforeach; 
			else:
				 echo __("None yet", 'bftpro'); 
			endif;?></td>
			<td><a href="admin.php?page=bftpro_ar_mails&campaign_id=<?php echo $campaign->id?>"><?php _e("Manage", 'bftpro');?></a>
			<?php if($campaign->num_mails) printf(__('(%d messages)', 'bftpro'), $campaign->num_mails);
			else _e('(No messages yet)', 'bftpro')?></td>
			<td><?php if($campaign->num_mails):?>
				<a href="admin.php?page=bftpro_ar_report&campaign_id=<?php echo $campaign->id?>"><?php _e('View Reports', 'bftpro')?></a> <br>
				<?php printf(__("%d%% opened", 'bftpro'), $campaign->percent_read);?>
			<?php else: _e('N/a', 'bftpro'); endif;?></td>
			<td><a href="admin.php?page=bftpro_ar_campaigns&do=edit&id=<?php echo $campaign->id?>"><?php _e("Edit", 'bftpro');?></a></td></tr>
		<?php endforeach;?>
	</table>
	<?php else:?>
		<p><?php _e("There are no marketing campaigns yet.", 'bftpro')?></p>
	<?php endif;?>
</div>	