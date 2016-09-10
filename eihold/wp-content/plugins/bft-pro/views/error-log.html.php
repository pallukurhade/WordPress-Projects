<h2 class="nav-tab-wrapper">
	<a class='nav-tab' href='admin.php?page=bftpro_help&tab=main'><?php _e('Help / User Manual', 'bftpro')?></a>
	<a class='nav-tab-active'><?php _e('Error Log', 'bftpro')?></a>	
</h2>

<div class="wrap">
	<div class="postbox wp-admin" style="padding:20px;">
		<form method="post">
			<p><?php _e('Select date:', 'bftpro')?> <?php echo BFTProQuickDDDate("date", $date, null, null, 2012, date("Y"))?> <input type="submit" value="<?php _e('View Log', 'bftpro')?>"></p>
		</form>
		
		<p>
		<?php if(empty($log->id)):?>
			<?php _e('No errors were found on the selected date', 'bftpro')?>			
		<?php else:
			echo nl2br($log->log);
		endif;?>
		</p>
	</div>
</div>	