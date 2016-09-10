<?php if (get_option('wp_showrelated') == "show") { ?>
	<div id="related">
	
	<?php 
	//include 'variables.php'; 
	
	//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
	if ( get_stylesheet_directory() != get_template_directory() && 
	file_exists(get_stylesheet_directory().'/includes/variables.php') ) 
	{			
		include get_stylesheet_directory() . '/includes/variables.php';
	}
	else {
					
		include get_template_directory() . '/includes/variables.php';
	}

	if (get_option('wp_site') == "Real Estate") {
		$currentlisting_relatedtype = $propertytype;
		} else {
		$currentlisting_relatedtype = $body_type; 
		}
	$currentlisting_postid = $post->ID;
	?>	


	<?php 
	$postsperpage = get_option('wp_relatedlistingsnumber');
	if (get_option('wp_filtersold') == 'Yes') {
		$listings = new WP_Query('post_type=listing&posts_per_page=-1&orderby=rand&meta_key=sold_value&meta_value=No'); 
		} else {
		$listings = new WP_Query('post_type=listing&posts_per_page=-1&orderby=rand'); 
		}
	$counter = 1;
	?>

	<?php if ($listings->have_posts()) : 


	echo "<h3 class='bar' id='relatedheading'>" . get_option('wp_related_text')  . "</h3>";


	while ($listings->have_posts()) : $listings->the_post(); 
	include 'variables.php';
	if (get_option('wp_site') == "Real Estate") {
		$alllistings_relatedtype = $propertytype;
		} else {
		$alllistings_relatedtype = $body_type; 
		}
	$alllistings_postid = $post->ID;
	
				 	
	$margincounter = 1;
			

	?>

	<?php if($alllistings_relatedtype == $currentlisting_relatedtype) { ?>

			<?php if ($currentlisting_postid != $alllistings_postid) { ?>
				
				<?php if($counter <= $postsperpage) { ?>
				<?php $counter = $counter + 1; ?>
					
					<?php if (get_option('wp_listinglayout') == "One per row") {
					
						//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
							if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/listings_row.php') ) 
							{			
								include get_stylesheet_directory() . '/includes/listings_row.php';
							}
							else {
											
								include get_template_directory() . '/includes/listings_row.php';
							}
					} else {
					
						//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
						if ( get_stylesheet_directory() != get_template_directory() && file_exists(		get_stylesheet_directory().'/includes/listings_grid.php') ) 
						{			
							include get_stylesheet_directory() . '/includes/listings_grid.php';
						}
						else {
											
							include get_template_directory() . '/includes/listings_grid.php';
						}
					} ?>
		<?php } ?>
		<?php } ?>
		<?php } ?>
		
				
				<?php endwhile ?>
				
				<?php if ($counter == 1) { ?>
				<script type="text/javascript">
					$('#relatedheading').addClass('hide');
				</script>
				
				<?php } ?>
			
				<?php else : ?>
				<div>
					   <p><?php echo get_option('wp_noresults');  ?></p>
				</div>
				<?php endif; ?>
	</div>	
	<div style="clear: both;"></div>
<?php } ?>
