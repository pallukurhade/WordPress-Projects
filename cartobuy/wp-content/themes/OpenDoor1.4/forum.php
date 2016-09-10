<?php
 get_header(); 
?>

<div class="sixteen columns outercontainer bigheading">
	<h2 id="title"><?php the_title(); ?></h2>
</div>	


<div class="sixteen columns outercontainer" id="content">

	<div class="twelve columns alpha">	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
			 <div <?php post_class() ?>    id="post-<?php echo the_ID(); ?>">
				<?php the_content(); ?>
			</div>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<?php endwhile; else: ?>
	<?php endif; ?>
	</div>

	<div class="four columns omega">
		<?php //include get_template_directory() . '/sidebar-right.php';
		
			//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
			if ( get_stylesheet_directory() != get_template_directory() && 
			file_exists(get_stylesheet_directory().'/sidebar-right.php') ) 
			{			
				include get_stylesheet_directory() . '/sidebar-right.php';
			}
			else {
							
				include get_template_directory() . '/sidebar-right.php';
			}
		
		 ?>
		<?php if (is_user_logged_in()) { 
			echo get_option('wp_loggedinmessage');
			} ?>
	</div>

</div>

<?php get_footer(); ?>