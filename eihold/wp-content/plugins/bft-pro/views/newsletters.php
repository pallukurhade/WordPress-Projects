<h1><?php _e("Your Newsletters", 'bftpro')?></h1>

<?php bftpro_display_alerts(); ?>

<p><a href="admin.php?page=bftpro_newsletters&do=add"><?php _e("Click here to create a newsletter", 'bftpro')?></a></p>

<?php if(sizeof($newsletters)):?>
<table class="widefat">
	<tr><th><?php _e("Subject", 'bftpro')?></th><th><?php _e("Sending To", 'bftpro')?></th><th><?php _e("Cteated on", 'bftpro')?></th><th><?php _e("Status", 'bftpro')?></th>
	<th><?php _e("Last sent on", 'bftpro')?></th>
	<th><?php _e('Reports', 'bftpro')?></th>
	<th><?php _e("Send or Edit", 'bftpro')?></th></tr>
	
	<?php foreach($newsletters as $newsletter):
		$class = ('alternate' == @$class) ? '' : 'alternate';?>
		<tr class="<?php echo $class?>"><td><strong><?php echo stripslashes($newsletter->subject);?></strong></td>
		<td><?php echo empty($newsletter->list_name)?__("Not selected", 'bftpro'):"<a href='admin.php?page=bftpro_subscribers&id=".$newsletter->list_id."'>".$newsletter->list_name."</a>"?></td>
		<td><?php echo date($dateformat, strtotime($newsletter->date_created))?></td>
		<td><?php if($newsletter->status == 'in progress') echo "<a href='admin.php?page=bftpro_nl_log&id=".$newsletter->id."'>".__('In progress', 'bftpro')."</a>";
		else echo $newsletter->status?></td>
		<td><?php echo empty($newsletter->date_last_sent) ? '-' : date($dateformat, strtotime($newsletter->date_last_sent))?></td>
		<td><a href="admin.php?page=bftpro_nl_report&newsletter_id=<?php echo $newsletter->id?>"><?php _e('view reports', 'brtpro')?></a><br>
		<?php printf(__("%d%% opened", 'bftpro'), $newsletter->percent_read);?></td>
		<td><a href="admin.php?page=bftpro_newsletters&do=edit&id=<?php echo $newsletter->id?>"><?php _e("Send or Edit", 'bftpro');?></a></td></tr>
	<?php endforeach;?>
</table>
<?php else:?>
	<p><?php _e("There are no newsletters yet.", 'bftpro')?></p>
<?php endif;?>	