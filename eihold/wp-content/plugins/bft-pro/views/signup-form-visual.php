[bftpro-form-start <?php echo $list->id?>]

<?php if(empty($visual_mode)) echo "<p>";
 if($list->require_name) echo '*'?><?php _e("Your Name:", 'bftpro');
  if(empty($visual_mode)) echo "<br />";?> 
[bftpro-field-static name]<?php if(empty($visual_mode)) echo "</p>";
echo "\n";
if(empty($visual_mode)) echo "<p>";?>
*<?php _e("Your Email:", 'bftpro');
  if(empty($visual_mode)) echo "<br />";?> 
[bftpro-field-static email]<?php if(empty($visual_mode)) echo "</p>";
echo "\n";		
if(!empty($list->id)): $this->extra_fields($list->id, null, $visual_mode); endif;?><?php if(!empty($recaptcha_html)):?>[bftpro-recaptcha]
<?php endif;?><?php if(!empty($text_captcha_html)):?>[bftpro-text-captcha]
<?php endif;?>

[bftpro-submit-button <?php echo $list->id?> "<?php _e('Subscribe', 'bftpro')?>"]	

[bftpro-form-end <?php echo $list->id?>]