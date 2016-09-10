<h1><?php _e("Custom Fields In Mailing List '{$list->name}'", 'bftpro')?></h1>

<p><a href="admin.php?page=bftpro_fields&list_id=<?php echo $list->id?>&do=add"><?php _e("Click here to add field", 'bftpro')?></a>
| <a href="admin.php?page=bftpro_mailing_lists"><?php _e('Back to manage mailing lists', 'bftpro')?></a></p>

<?php if(sizeof($fields)):?>
	<table class="widefat">
	<tr><th><?php _e("Field Label", 'bftpro')?></th><th><?php _e("Field Name", 'bftpro')?></th><th><?php _e("Field Type", 'bftpro')?></th>
	<th><?php _e("Is Required?", 'bftpro')?></th><th><?php _e("Edit/Delete", 'bftpro')?></th></tr>
	<?php foreach($fields as $field):?>
		<tr><td><?php echo $field->label?></td><td><?php echo $field->name?></td><td><?php echo $field->ftype?></td>
		<td><?php echo $field->is_required?__('Yes', 'bftpro'):__('No', 'bftpro')?></td>
		<td><a href="admin.php?page=bftpro_fields&list_id=<?php echo $list->id?>&do=edit&id=<?php echo $field->id?>"><?php _e("Edit", 'bftpro')?></a></td></tr>
	<?php endforeach;?>
	</table>
<?php else:?>
	<p><?php _e("There are no custom fields in this list yet.", 'bftpro')?></p>
<?php endif;?>