<?php foreach($fields as $field):
	if(empty($visual_mode)) echo "<p>";
	if($field->ftype!='checkbox') echo ($field->is_required?'*':'').$field->label.':';
	if($field->ftype!='checkbox' and empty($visual_mode)) echo '<br />';
	if($field->ftype!='checkbox') echo "\n";
	switch($field->ftype):
		case 'textfield':	
		case 'textarea':
		case 'simple_textarea':  
		case 'dropdown':	
		case 'radio':
		case 'date':
		?>[bftpro-field <?php echo $field->id?>]<?php 		
		break;		
		case 'checkbox':?>[bftpro-field <?php echo $field->id?>] <?php echo ($field->is_required?'*':'').$field->label?><?php break;
	endswitch;	
	if(empty($visual_mode)) echo "</p>";
	echo "\n";	
endforeach;?>