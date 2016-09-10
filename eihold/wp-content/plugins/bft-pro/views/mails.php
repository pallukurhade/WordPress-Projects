<h1><?php _e(sprintf("Autoresponder Campaign \"%s\" - Manage Email Messages", $ar->name), 'bftpro')?></h1>

<?php bftpro_display_alerts(); ?>

<p><a href="admin.php?page=bftpro_ar_campaigns"><?php _e('Back to autoresponder campaigns', 'bftpro')?></a></p>

<p><a href="admin.php?page=bftpro_ar_mails&do=add&campaign_id=<?php echo $ar->id?>"><?php _e("Click here to create a new email message", 'bftpro')?></a></p>

<?php if(sizeof($mails)):?>
<table class="widefat">
	<tr><th><?php _e("Subject", 'bftpro')?></th><th><?php _e("Sending Rule", 'bftpro')?></th>
	<th><?php _e("View Log", 'bftpro')?></th><th><?php _e("Edit", 'bftpro')?></th></tr>
	
	<?php foreach($mails as $mail):
		$class = ('alternate' == @$class) ? '' : 'alternate';?>
		<tr class="<?php echo $class?>"><td><strong><?php echo stripslashes($mail->subject);?></strong></td>		
		<td><?php switch($mail->artype):
			case 'date': echo __("Send on ", 'bftpro').date($dateformat, bftpro_datetotime($mail->send_on_date)); break;
			case 'days': _e(sprintf("%d days after registration", $mail->days), 'bftpro'); break;
			case 'event_days': printf (__("%d days %s user's %s", 'bftpro'), $mail->event_days, $mail->event_case, 'custom event'); break;
			case 'every_days': _e(sprintf("Send every %d days", $mail->every), 'bftpro'); break; 
			case 'every_weekday': _e(sprintf("Send every %s", $mail->every), 'bftpro');	break;
		endswitch;?></td>
		<td><a href="admin.php?page=bftpro_mail_log&type=armail&id=<?php echo $mail->id?>"><?php _e('View log')?></a></td>
		<td><a href="admin.php?page=bftpro_ar_mails&do=edit&id=<?php echo $mail->id?>&campaign_id=<?php echo $ar->id?>"><?php _e("Edit", 'bftpro');?></a></td></tr>
	<?php endforeach;?>
</table>
<?php else:?>
	<p><?php _e("There are no email messages yet.", 'bftpro')?></p>
<?php endif;?>