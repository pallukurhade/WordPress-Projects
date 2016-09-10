<h1><?php _e('Autoresponder Campaign Log', 'bftpro')?></h1>

<div class="wrap">
	<h2>"<?php echo $mail->subject?>" <?php _e('Mail In', 'bftpro')?> "<?php echo $ar->name?>"</h2>
	<p><a href="admin.php?page=bftpro_ar_mails&campaign_id=<?php echo $ar->id?>"><?php _e('Back to all email messages in this campaign', 'bftpro')?></a></p>
	
	<?php if(!sizeof($sent_mails)):?>
		<p><?php _e('No emails has been sent up to this moment', 'bftpro')?></p></div>
	<?php return false;
	endif;?>
	
	<table class="widefat">
		<tr><th><?php _e('Date', 'bftpro')?></th><th><?php _e('Sent to', 'bftpro')?></th>
		<th><?php _e('Mailing list', 'bftpro')?></th></tr>	
		<?php foreach($sent_mails as $sent_mail):
			$class = ("alternate" == @$class) ? '' : 'alternate';?>
			<tr class="<?php echo $class?>"><td><?php echo date(get_option('date_format'), strtotime($sent_mail->date));?></td>
			<td><?php echo $sent_mail->email.' '.sprintf(__('(User ID: %d)', 'bftpro'), $sent_mail->user_id)?></td>
			<td><a href="admin.php?page=bftpro_subscribers&id=<?php echo $sent_mail->list_id?>"><?php echo $sent_mail->list_name?></a></td></tr>
		<?php endforeach;?>
	</table>
	
	<p align="center">
	<?php if($offset>0):?>
	&nbsp; <a href="admin.php?page=bftpro_mail_log&type=armail&id=<?php echo $mail->id?>&offset=<?php echo ($offset-$limit)?>"><?php _e("Previous Page", 'bftpro');?></a>
		&nbsp;
	<?php endif;?>
	<?php if($cnt_mails > ($limit + $offset)):?>
	&nbsp; <a href="admin.php?page=bftpro_mail_log&type=armail&id=<?php echo $mail->id?>&offset=<?php echo ($offset+$limit)?>"><?php _e("Next Page", 'bftpro');?></a> &nbsp;
	<?php endif;?>	
	</p>
</div>