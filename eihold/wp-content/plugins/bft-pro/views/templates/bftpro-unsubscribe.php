<?php
/**
 * The Template for displaying BFTPRO messages
 *
 */

get_header(); ?>	

		<div id="container">
			<div id="content" role="main" style="margin:auto;width:50%;">
				
				<h1><?php _e("Unsubscribe from mailing lists", 'bftpro') ?></h1>
				
				<form method="post" class="bftpro">
					<div><?php _e("Please confirm that you wish to unsubscribe by submitting the form.", 'bftpro')?></div>
					<div><input type="text" name="email" value="<?php echo $_GET['email']?>"></div>
					
					<div>
						<p><?php _e('You will be unsubscribed from the following lists', 'bftpro')?></p>
						<ul>
							<?php foreach($users as $user):?>
								<li><input type="checkbox" name="list_ids[]" value="<?php echo $user->list_id?>" <?php if($user->list_id == $_GET['list_id']) echo 'checked'?>> <?php echo $user->list_name?></li>
							<?php endforeach;?>
						</ul>
					</div>					
					
					<div><input type="submit" value="<?php _e('Unsubscribe me', 'bftpro');?>"></div>
					<input type="hidden" name="ok" value="1">
				</form>				
			</div>
		</div>
				
<?php get_footer(); ?>