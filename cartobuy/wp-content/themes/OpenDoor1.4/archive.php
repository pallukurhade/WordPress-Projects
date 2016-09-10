<?php
 get_header(); 
?>

<div class="sixteen columns outercontainer bigheading">
	<div class="four columns alpha">
		&nbsp;
	</div>
	<div class="twelve columns omega">
		<h2 id="title"><?php the_title(); ?></h2>
	</div>
</div>	


<div class="sixteen columns outercontainer" id="content">
	<div class="four columns alpha" id="leftsidebar">
		<?php get_sidebar() ?>
	</div>
	
	<div class="twelve columns omega">	
	
		<?php is_tag(); ?>
		<?php if (have_posts()) : ?>
	
		<?php while (have_posts()) : the_post(); ?>		
			 <div <?php post_class() ?>    id="post-<?php echo the_ID(); ?>">
				<h3 class="bar" id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h3>
				
				<?php 				
				//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
				if ( get_stylesheet_directory() != get_template_directory() && 
				file_exists(get_stylesheet_directory().'/includes/postmeta.php') ) 
				{			
					include get_stylesheet_directory() . '/includes/postmeta.php';
				}
				else {
								
					include get_template_directory() . '/includes/postmeta.php';
				}
				
				?>
				
				
				  <?php the_excerpt() ?>
				  <a class="btn" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_option('wp_readmore_text') ?></a>
			</div>
			<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		<?php endwhile; else: ?>

<?php endif; ?>
</div>
</div>

<?php get_footer(); ?>