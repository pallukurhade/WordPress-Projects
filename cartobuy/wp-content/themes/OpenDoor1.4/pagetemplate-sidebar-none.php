<?php
/*
Template Name: Full Width (no sidebars)
*/
?>

<?php
 get_header(); 
?>

<div class="sixteen columns outercontainer bigheading">
		<h2 id="title"><?php the_title(); ?></h2>
</div>	


<div class="sixteen columns outercontainer" id="content">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
			 <div <?php post_class() ?>    id="post-<?php echo the_ID(); ?>">
				<?php the_content(); ?>
			</div>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<?php endwhile; else: ?>
		 
		<h2><?php echo get_option('wp_notfound_heading_text') ?></h2>
		<p><?php echo get_option('wp_notfound_body_text') ?></p>
	
<?php endif; ?>
</div>

<?php get_footer(); ?>