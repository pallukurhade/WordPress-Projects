<div class="wrap">
	<h1><?php _e("Import Subscribers In Mailing List '{$list->name}'", 'bftpro')?></h1>
	
	<?php if(!empty($success)):?>
	<p class="bftpro-alert"><?php echo $success?></p>
	<?php endif;?>
	
		<p><a href="admin.php?page=bftpro_subscribers&id=<?php echo $list->id?>"><?php _e('Back to manage subscribers', 'bftpro')?></a></p>
	
	<form method="post" enctype="multipart/form-data" class="bftpro">
	<div class="postbox wp-admin" style="padding:15px;">
		<p><?php _e("<strong>Note: Existing members' data will be ignored and will not be overrriden.</strong> If you want to update existing members, please delete them first. This is done to avoid mistakenly uploading outdated information.", 'bftpro')?></p>
		
		<div><label><?php _e("Field separator in the CSV file:", 'bftpro')?></label> <input type="text" name="delimiter" value="," size="4"> 
		<?php _e("For tabulator enter <strong>\\t</strong>", 'bftpro')?></div>
		<div><label><?php _e("Column numbers of <strong>Email, Name</strong>:", 'bftpro')?></label> <input type="text" name="sequence" value="1,2" size="4">
			<p><?php _e('This reflects the order of columns in your import file. So if Email is the first column, and Name is the second, enter "1,2". If for example Email is third column, and name is first, type "3,1"','bftpro')?></p>	
		</div>
		<div><label><?php _e("Column number of <strong>IP Address</strong>:", 'bftpro')?></label> <input type="text" name="ipnum" value="" size="4"> <?php _e('(Optional)', 'bftpro')?></div>
		
		<p><?php _e("<strong>Additional fields column numbers:</strong><br>
	If your CSV file contains some of the extra fields, enter the column number from the CSV in front of each field. If the field is not presented in the CSV file, just leave it blank.", 'bftpro')?></p>
			
		<div><label><?php _e("Signup date", 'bftpro')?>:</label> <input type="text" name="date" size="3"></div>
		
		<?php foreach($fields as $field):?>
			<div><label><?php echo $field->label?>:</label> <input type="text" name="fieldseq_<?php echo $field->id?>" size="3"></div>
		<?php endforeach; ?>
		
		<hr>
		
		<p><i>
		<?php _e("* If your CSV file contains more fields than email and name or they are in different order,
		just enter that.<br /><br /> <b>For example</b>:
		<ul>
			<li>For a CSV file formatted like <b>johnsmith@yahoo.com, John Smith</b> enter <b>1, 2</b></li>
			<li>For a CSV file formatted like <b>John Smith, johnsmith@yahoo.com</b> enter <b>2, 1</b></li>
			<li>For a CSV file formatted like <b>John Smith, Male, johnsmith@yahoo.com, USA</b> enter <b>3, 1</b></li>
		</ul> 
		You can also combine fields and construct the 'name' field from more than one field in the CSV
		<ul>
			<li>For a CSV file formatted like <b>johnsmith@yahoo.com, Smith, John</b> enter <b>1, 3+2</b></li>
			<li>For a CSV file formatted like <b>Smith, John, johnsmith@yahoo.com</b> enter <b>3, 2+1</b></li>
			<li>For a CSV file formatted like <b>John, Smith, Male, johnsmith@yahoo.com, USA</b> enter <b>4, 1+2</b></li>
		</ul>", 'bftpro');?> 
	</i></p>
		
		<hr>	
		<div><p><input type="checkbox" name="skip_first" value="1"> <?php _e("Skip first line (column titles) when importing", 'bftpro')?></p></div>	
		
		<div><label><?php _e("Upload CSV file:", 'bftpro')?></label> <input type="file" name="csv"></div>
		
		<div><input type="submit" name="import" value="<?php _e('Import Members', 'bftpro')?>"></div>	
	</div>
	</form>
</div>	