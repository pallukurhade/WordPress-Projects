<div class="wrap">
	<h1><?php printf(__('Viewing reports for campaign "%s"', 'bftpro'), $campaign->name);?></h1>
	
	<p><a href="admin.php?page=bftpro_ar_campaigns"><?php _e('Back to campaigns', 'bftpro')?></a></p>
	
	<form method="post">
		<p><?php _e('Select period:', 'bftpro')?> <?php echo BFTProQuickDDDate('from', $from, NULL, NULL, 2013, date("Y"));?>
			-	<?php echo BFTProQuickDDDate('to', $to, NULL, NULL, 2013, date("Y"));?>
			<input type="submit" value="<?php _e('Refresh report', 'bftpro')?>"></p>
	</form>
	
	<?php if(!sizeof($mails)):?>
		<p><?php _e('There are no email messages in this campaign yet.', 'bftpro')?></p></div>
	<?php return false;
	endif;?>
	
	<table class="widefat">
		<tr><th><?php _e('Email subject','bftpro')?></th><th><?php _e('Num. sent', 'bftpro')?></th>
		<th><?php _e('Num. read', 'bftpro')?></th><th><?php _e('Open rate', 'bftpro')?></th>
		<?php do_action('bftrpo_campaign_report_extra_th');?>		
		</tr>
		<?php foreach($mails as $mail):
			$class = ('alternate' == @$class) ? '' : 'alternate';?>
			<tr class="<?php echo $class?>"><td><?php echo $mail->subject?></td><td><?php echo $mail->num_sent?></td>
			<td><?php echo $mail->num_read?></td><td><?php echo $mail->open_rate?>%</td>
			<?php do_action('bftrpo_campaign_report_extra_td', $mail, $from, $to);?></tr>
		<?php endforeach;?>	
	</table>
</div>