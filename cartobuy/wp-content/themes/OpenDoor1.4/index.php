<?php

get_header(); ?>



<?php if(get_option('wp_demo') == "on") {
	//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
	if ( get_stylesheet_directory() != get_template_directory() && 
	file_exists(get_stylesheet_directory().'/includes/democolorpicker.php') ) 
	{			
		include get_stylesheet_directory() . '/includes/democolorpicker.php';
	}
	else {
								
		include get_template_directory() . '/includes/democolorpicker.php';
	}

} ?>

	<?php 
		if (get_option('wp_slideshowlayout') == 'Full Width') {
			if ( get_stylesheet_directory() != get_template_directory() && 
			file_exists(get_stylesheet_directory().'/includes/slider.php') ) 
			{			
				include get_stylesheet_directory() . '/includes/slider.php';
			}
			else {
										
				include get_template_directory() . '/includes/slider.php';
			}
		}
	?>

	<?php if (get_option('wp_showcalltoaction') == "show") { ?>
		<div class="sixteen columns outercontainer" id="calltoaction">
			<div class="one-third column alpha">
			<div class="inner">
			<a href="<?php echo get_option('wp_calltoaction_url1') ?>"><img src="<?php echo get_option('wp_calltoaction_image1') ?>" title="" /></a>
			</div>
			</div>
			
			<div class="one-third column">
			<div class="inner">
			<a href="<?php echo get_option('wp_calltoaction_url2') ?>"><img src="<?php echo get_option('wp_calltoaction_image2') ?>" title="" /></a>
			</div>
			</div>
			
			<div class="one-third column omega">
			<div class="inner">
			<a href="<?php echo get_option('wp_calltoaction_url3') ?>"><img src="<?php echo get_option('wp_calltoaction_image3') ?>" title="" /></a>
			</div>
			</div>
		</div>
	<?php } ?>
	


	<div class="sixteen columns outercontainer" id="content">

	<div class="four columns alpha">
		
	<?php 	
		//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
		if ( get_stylesheet_directory() != get_template_directory() && 
		file_exists(get_stylesheet_directory().'/includes/search.php') ) 
		{			
			include get_stylesheet_directory() . '/includes/search.php';
		}
		else {
									
			include get_template_directory() . '/includes/search.php';
		}
	
	
	 ?>
	
	<?php dynamic_sidebar('Homepage (under search)')  ?>
	
	<?php if (get_option('wp_loancalculator1') == "show") {
			//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
			if ( get_stylesheet_directory() != get_template_directory() && 
			file_exists(get_stylesheet_directory().'/includes/loancalculator.php') ) 
			{			
				include get_stylesheet_directory() . '/includes/loancalculator.php';
			}
			else {
										
				include get_template_directory() . '/includes/loancalculator.php';
			}
									
		} ?>
	</div>
	
	
	
	<div class="twelve columns omega">
	
		<?php 	
		if (get_option('wp_slideshowlayout') == 'Next to Sidebar') {
			if ( get_stylesheet_directory() != get_template_directory() && 
			file_exists(get_stylesheet_directory().'/includes/slider.php') ) 
			{			
				include get_stylesheet_directory() . '/includes/slider.php';
			}
			else {
										
				include get_template_directory() . '/includes/slider.php';
			}
		}
	?>
	
	
	
	
			<?php if(get_option('wp_widgetlayout') == "Layout 1") {
				$class="four columns alpha";
				$class2="four columns";
				$class3="four columns omega";
			} elseif (get_option('wp_widgetlayout') == "Layout 2") {
				$class="four columns alpha";
				$class2="eight columns omega";
				$class3="hide";
			} elseif (get_option('wp_widgetlayout') == "Layout 3") {
				$class="eight columns alpha";
				$class2="four columns omega";
				$class3="hide";
			} elseif (get_option('wp_widgetlayout') == "Layout 4") {
				$class="twelve columns alpha omega";
				$class2="hide";
				$class3="hide";
			} ?>

		<?php if (get_option('wp_homepage_layout1') == "Recent Listings") {
					
					//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
					if ( get_stylesheet_directory() != get_template_directory() && 
					file_exists(get_stylesheet_directory().'/includes/listings.php') ) 
					{			
						include get_stylesheet_directory() . '/includes/listings.php';
					}
					else {
												
						include get_template_directory() . '/includes/listings.php';
					}
					
				} elseif (get_option('wp_homepage_layout1') == "Widgets") { ?>
					<!-- 3 widgetized columns -->
					<div class="homepagewidgets">
						<div class="<?php echo $class ?>">
							<?php dynamic_sidebar('Homepage (under slideshow) 1') ?>	
						</div>
						<div class="<?php echo $class2 ?>">
							<?php dynamic_sidebar('Homepage (under slideshow) 2') ?>	
						</div>
						<div class="<?php echo $class3 ?>">
							<?php dynamic_sidebar('Homepage (under slideshow) 3') ?>	
						</div>
					</div>
					<div style="clear: both;"></div>
			<?php } elseif (get_option('wp_homepage_layout1') == "Blog Posts") {
				
					//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
					if ( get_stylesheet_directory() != get_template_directory() && 
					file_exists(get_stylesheet_directory().'/includes/homepageblog.php') ) 
					{			
						include get_stylesheet_directory() . '/includes/homepageblog.php';
					}
					else {
												
						include get_template_directory() . '/includes/homepageblog.php';
					}
				
				} ?>
				
		<?php if (get_option('wp_homepage_layout2') == "Recent Listings") {
					
					//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
					if ( get_stylesheet_directory() != get_template_directory() && 
					file_exists(get_stylesheet_directory().'/includes/listings.php') ) 
					{			
						include get_stylesheet_directory() . '/includes/listings.php';
					}
					else {
												
						include get_template_directory() . '/includes/listings.php';
					}
					
					
				} elseif (get_option('wp_homepage_layout2') == "Widgets") { ?>
					<!-- 3 widgetized columns -->
					<div class="homepagewidgets">
						<div class="<?php echo $class ?>">
							<?php dynamic_sidebar('Homepage (under slideshow) 1'); ?>						
						</div>
						<div class="<?php echo $class2 ?>">
							<?php dynamic_sidebar('Homepage (under slideshow) 2') ?>	
						</div>
						<div class="<?php echo $class3 ?>">
							<?php dynamic_sidebar('Homepage (under slideshow) 3') ?>	
						</div>
					</div>
					<div style="clear: both;"></div>
			<?php } elseif (get_option('wp_homepage_layout2') == "Blog Posts") { 
				
					//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
					if ( get_stylesheet_directory() != get_template_directory() && 
					file_exists(get_stylesheet_directory().'/includes/homepageblog.php') ) 
					{			
						include get_stylesheet_directory() . '/includes/homepageblog.php';
					}
					else {
												
						include get_template_directory() . '/includes/homepageblog.php';
					}
				
				} elseif (get_option('wp_homepage_layout2') == "[nothing]") { 
				} ?>
				
				
		<?php if (get_option('wp_homepage_layout3') == "Recent Listings") {
					
					//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
					if ( get_stylesheet_directory() != get_template_directory() && 
					file_exists(get_stylesheet_directory().'/includes/listings.php') ) 
					{			
						include get_stylesheet_directory() . '/includes/listings.php';
					}
					else {
												
						include get_template_directory() . '/includes/listings.php';
					}

				} elseif (get_option('wp_homepage_layout3') == "Widgets") { ?>
					<!-- 3 widgetized columns -->
					<div class="homepagewidgets">
						<div class="<?php echo $class ?>">
							<?php if (get_option('wp_demo')== "on") { ?>
								<h3>Color Scheme</h3>
								  <form id="colorschemechanger" action="">
								  <div class="form-item"><label for="color">Color:</label><input type="text" id="color" name="color" value="#123456" /></div><div id="picker"></div>
								  <p><a class="btn btn-block" href="#">Change color</a></p>
								  <p><a href="#" id="resetcolorscheme">Reset to default</a></p>
								  <p>Note: Colors and background images for header, background, and footer, can be changed independently in Theme Options. It cannot be changed interactively in this demo.</p>
								  </form>
							<?php } else { 
								dynamic_sidebar('Homepage (under slideshow) 1');
								} ?>	
						</div>
						<div class="<?php echo $class2 ?>">
							<?php dynamic_sidebar('Homepage (under slideshow) 2') ?>	
						</div>
						<div class="<?php echo $class3 ?>">
							<?php dynamic_sidebar('Homepage (under slideshow) 3') ?>	
						</div>
					</div>
					<div style="clear: both;"></div>
			<?php } elseif (get_option('wp_homepage_layout3') == "Blog Posts") {
					
					//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
					if ( get_stylesheet_directory() != get_template_directory() && 
					file_exists(get_stylesheet_directory().'/includes/homepageblog.php') ) 
					{			
						include get_stylesheet_directory() . '/includes/homepageblog.php';
					}
					else {
												
						include get_template_directory() . '/includes/homepageblog.php';
					}
				
				} elseif (get_option('wp_homepage_layout2') == "[nothing]") { 
				} ?>

	</div>
	</div>

<?php get_footer(); ?>
