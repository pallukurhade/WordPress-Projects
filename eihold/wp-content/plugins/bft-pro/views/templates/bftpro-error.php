<?php
/**
 * The Template for displaying BFTPRO messages
 *
 */

get_header(); ?>
		<div id="container">
			<div id="content" role="main">		
		
				<h1 align="center"><?php _e("An Error Occured", 'bftpro');?></h1>
				<p align="center"><?php echo $message;?></p>
				
			</div>
		</div>				
				
<?php get_footer(); ?>