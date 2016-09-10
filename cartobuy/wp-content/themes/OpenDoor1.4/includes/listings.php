<div id="listings">

	<?php if (get_option('wp_filtersold') == 'Yes') {
		$filteroutsold = '&meta_key=sold_value&meta_value=No';
		} else {
		$filteroutsold = '';
		}
	?>
	<?php $recent = new WP_Query('post_type=listing&post_status=publish&posts_per_page='.get_option('wp_recentlistingsnumber_home').$filteroutsold); ?>


	<h2 class="bar">
		<?php echo get_option('wp_heading_latestlistings') ?>
	</h2>
	<?php $margincounter = 1; ?>
	<?php if ($recent->have_posts()) : while ($recent->have_posts()) : $recent->the_post(); ?>
	<?php //include get_template_directory() . '/includes/variables.php';
	
		//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
		if ( get_stylesheet_directory() != get_template_directory() && 
		file_exists(get_stylesheet_directory().'/includes/variables.php') ) 
		{			
			include get_stylesheet_directory() . '/includes/variables.php';
		}
		else {
							
			include get_template_directory() . '/includes/variables.php';
		}
	
	
	 ?>

	<?php if (get_option('wp_listinglayout') == "One per row") {
	
				//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
				if ( get_stylesheet_directory() != get_template_directory() && 
				file_exists(get_stylesheet_directory().'/includes/listings_row.php') ) 
				{			
					include get_stylesheet_directory() . '/includes/listings_row.php';
				}
				else {
									
					include get_template_directory() . '/includes/listings_row.php';
				}
	
			//include get_template_directory() . '/includes/listings_row.php';
		} else {
		
			//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
			if ( get_stylesheet_directory() != get_template_directory() && 
			file_exists(get_stylesheet_directory().'/includes/listings_grid.php') ) 
			{			
				include get_stylesheet_directory() . '/includes/listings_grid.php';
			}
			else {
									
				include get_template_directory() . '/includes/listings_grid.php';
			}
			//include get_template_directory() . '/includes/listings_grid.php';
		} ?>

	<?php endwhile; else: ?>
	<?php endif; 
	wp_reset_query(); ?> 
</div>