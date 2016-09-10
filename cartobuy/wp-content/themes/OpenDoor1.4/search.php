<?php
 get_header(); 
?>

<div class="sixteen columns outercontainer bigheading">
	<h2 id="title"><?php echo get_option('wp_blogsearchresults_text') ?></h2>
</div>	


<div class="sixteen columns outercontainer" id="content">
	<div class="four columns alpha">
		<?php 
			if ( get_stylesheet_directory() != get_template_directory() && 
			file_exists(get_stylesheet_directory().'/sidebar-right') ) 
			{
				include get_stylesheet_directory() . '/sidebar-right';
			}
			else {
				include get_template_directory() . '/sidebar-right';
			}
		?>
		<?php if (is_user_logged_in()) { 
			echo get_option('wp_loggedinmessage');
			} ?>
	</div>

	<div class="twelve columns omega">	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
			<div <?php post_class(array("blogsearchresult")) ?>>
				<h3 id="post-<?php the_ID(); ?>"><?php the_title(); ?></h3>
				<?php the_excerpt() ?>
				<a class="btn" href="<?php the_permalink() ?>">Read more</a>
			</div>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<?php endwhile; else: ?>
	<?php endif; ?>
	</div>



</div>

<?php get_footer(); ?>
