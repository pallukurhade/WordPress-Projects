<?php
get_header(); 

$catid = get_query_var('cat');
$cat = &get_category($catid);
$parent = $cat->category_parent;
?>

<div class="sixteen columns outercontainer bigheading">
	<div class="four columns alpha">
		&nbsp;
	</div>
	<div class="twelve columns omega">
		<h2 id="title"><?php echo get_cat_name($catid) ?></h2>
	</div>
</div>	


<div class="sixteen columns outercontainer" id="content">
	<div class="four columns alpha" id="leftsidebar">
		<?php get_sidebar() ?>
	</div>
	
	<div class="twelve columns omega">	

		<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
		
			<?php if (get_option('wp_bloglayout') == "Three per row grid") { ?>

			<div <?php post_class('four columns blogpageblogitem blogcolumn') ?> id="post-<?php the_ID(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					$url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
					$resize = aq_resize($url, 220,220,true)	; ?>
					<img alt="" src="<?php echo $resize ?>" />
				<?php } ?>
				<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
				
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
				<?php the_excerpt(); ?>

				<a class="btn btn-lightgray" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo get_option('wp_readmore_text') ?></a>
			</div>
			
		<?php } else { ?>
		
			<div <?php post_class('twelve columns alpha omega blogrow') ?> id="post-<?php the_ID(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					$url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
					$resize = aq_resize($url, 110, 110, true); ?>
					<img alt="" src="<?php echo $resize ?>" />
				<?php } ?>
				<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
				
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
				<?php the_excerpt(); ?>
			</div>
			
		<?php } ?>
			
			<?php endwhile ?>
			
				<div id="posts_navigation">
				<span id="nextlink"><?php next_posts_link('&laquo; ' . get_option('wp_olderentries')) ?></span>
				<span id="previouslink"><?php previous_posts_link(get_option('wp_newerentries') . ' &raquo;') ?></span>
				</div>
			
			<?php else : ?>

		<?php endif ?>
	</div>
	
	
</div>

<?php get_footer(); ?>

