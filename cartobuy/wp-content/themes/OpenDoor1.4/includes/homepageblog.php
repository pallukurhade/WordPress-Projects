	<div id="homepageblog">
		<h2 class="bar">
			<?php echo get_option('wp_heading_recentblog') ?>
		</h2>
		
		
		<?php $blognumber = get_option('wp_blognumber') ?>	
		<?php $blog = new WP_Query('post_type=post&post_status=publish&posts_per_page='. $blognumber); ?>
		<?php if($blog->have_posts()) : while($blog->have_posts()) : $blog->the_post(); ?>

			<div <?php post_class('three columns homepageblogitem') ?> id="post-<?php the_ID(); ?>">
				<?php
				if ( has_post_thumbnail() ) {
					$url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
					$resize = aq_resize($url, 220,220,true)	;
					?>
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

			<?php endwhile ?>
			<?php else : ?>
		<?php endif ?>
	</div>
<div style="clear: both;"></div>