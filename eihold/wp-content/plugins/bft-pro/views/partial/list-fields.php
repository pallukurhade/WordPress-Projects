<?php foreach($fields as $field):
	// $nolabel is set as true by the "visual form" shortcode
	if($field->ftype!='checkbox' and empty($nolabel)) echo "<p><label>".($field->is_required?'*':'')."{$field->label}:</label> ";
	switch($field->ftype):
		case 'textfield':	?>
			<input type="text" name="field_<?php echo $field->id?>" value="<?php echo @$user["field_".$field->id]?>">
		<?php	break;		
		case 'textarea': 
			echo wp_editor(@$user["field_".$field->id], "field_".$field->id);
		break;		
		case 'simple_textarea':?> 
			<textarea name="field_<?php echo $field->id?>" rows="5" cols="30"><?php echo stripslashes(@$user["field_".$field->id])?></textarea>
		<?php break;		
		case 'dropdown':
			$vals=explode("\n",$field->fvalues);	?>
			<select name="field_<?php echo $field->id?>">
			<?php foreach($vals as $val):			
				$val=trim($val);
				if($val==@$user["field_".$field->id]) $selected='selected';
				else $selected='';
				echo "<option value=\"$val\" $selected>$val</option>";
			endforeach; ?>
			</select>
		<?php	break;		
		case 'radio':
			$vals=explode("\n",$field->fvalues);			
			foreach($vals as $vct=>$val):			
				$val=trim($val);
				if(trim($val)==@$user["field_".$field->id] or (empty($user["field_".$field->id]) and $vct==0)) $checked='checked';
				else $checked='';
				echo " <input type='radio' name='field_{$field->id}' value='$val' $checked> $val ";
			endforeach;			
		break;	
		case 'date':
			echo BFTProQuickDDDate("field_".$field->id, @$user['field_'.$field->id], $field->field_date_format);
		break;	
		case 'checkbox':?>
			<?php if(empty($nolabel)):?><label><?php endif;?><input type="checkbox" name="field_<?php echo $field->id?>" <?php if(@$user["field_".$field->id]) echo "checked"?> value='1'> <?php if(empty($nolabel)): echo ($field->is_required?'*':'').$field->label.'</label>'; endif;?> 
		<?php break;
	endswitch;
	if($field->ftype!='checkbox' and empty($nolabel)) echo "</p>";
	if($field->is_required and $field->ftype != 'date') echo "<input type='hidden' name='required_fields[]' value='field_{$field->id}'>";
endforeach;?>