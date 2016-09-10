


<div id="search">
	<?php if (get_option('wp_site') == "Real Estate") { ?>
		<?php if (get_option('wp_search') == "Only built-in search") { ?>
			<div class="accordion" id="accordion1">
					<?php if (get_option('wp_includebrowseby') == "Yes") { ?>
						<div class="accordion-group">
							<div class="accordion-heading">
							  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseOneHouses"><i class="icon-search icon-white"></i>
									<?php echo get_option('wp_browseby_text'); ?>
							  </a>
							</div>
							<div id="collapseOneHouses" class="accordion-body collapse">
							  <div class="accordion-inner">
									<?php //include get_template_directory() . "/includes/browseby.php"; 
									//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
										if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/browseby.php') ) 
										{			
											include get_stylesheet_directory() . '/includes/browseby.php';
										}
										else {
														
											include get_template_directory() . '/includes/browseby.php';
										}
									
									?>
							  </div>
							</div>
						</div>
					<?php } ?>
						<?php if(get_option('wp_showsearch') == "show") { ?>
						<div class="accordion-group">
							<div class="accordion-heading">	
								<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwoHouses"><i class="icon-search icon-white"></i>
									<?php echo get_option('wp_heading_customsearch'); ?>
								</a>
							</div>	
							<div id="collapseTwoHouses" class="accordion-body collapse">
								<div class="accordion-inner">
									<?php //include get_template_directory() . '/includes/customsearchform-houses.php';
									
									 //Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
										if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/customsearchform-houses.php') ) 
										{			
											include get_stylesheet_directory() . '/includes/customsearchform-houses.php';
										}
										else {
														
											include get_template_directory() . '/includes/customsearchform-houses.php';
										}
									
									
									?>
								</div>
							</div>
						</div>
						<?php } ?>
						
						
			</div>
				
		<?php } ?>


		<?php if (get_option('wp_search') == "Only dsIDXpress search (requires paid subscription for dsIDXpress plugin)") { ?>
		
			<div class="accordion" id="accordion3">
				<?php if (get_option('wp_includebrowseby') == "Yes") { ?>
					<div class="accordion-group">
						<div class="accordion-heading">
						  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseOneIdx"><i class="icon-search icon-white"></i>
								<?php echo get_option('wp_browseby_text'); ?>
						  </a>
						</div>
						<div id="collapseOneIdx" class="accordion-body collapse">
						  <div class="accordion-inner">
								<?php //include get_template_directory() . "/includes/browseby.php"; 
								
									//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
									if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/browseby.php') ) 
									{			
										include get_stylesheet_directory() . '/includes/browseby.php';
									}
									else {
														
										include get_template_directory() . '/includes/browseby.php';
									}
								
								
								?>
						  </div>
						</div>
					</div>
				<?php } ?>
			
					<div class="accordion-group">
						<div class="accordion-heading">	
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapseTwoIdx"><i class="icon-search icon-white"></i>
								<?php echo get_option('wp_heading_searchmls'); ?>
							</a>
						</div>	
						<div id="collapseTwoIdx" class="accordion-body collapse">
							<div class="accordion-inner">
								<?php dynamic_sidebar('dsIDXpress Search') ?>
								
								
							</div>
						</div>
					</div>
			</div>
				
		<?php } ?>


	
		<?php if (get_option('wp_search') == "Both") { ?>
			<div class="accordion" id="accordion2">
			<?php if (get_option('wp_includebrowseby') == "Yes") { ?>
				<div class="accordion-group">
					<div class="accordion-heading">
					  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOneBoth"><i class="icon-search icon-white"></i>
							<?php echo get_option('wp_browseby_text'); ?>
					  </a>
					</div>
					<div id="collapseOneBoth" class="accordion-body collapse">
					  <div class="accordion-inner">
							<?php //include get_template_directory() . "/includes/browseby.php";
							
								//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
									if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/browseby.php') ) 
									{			
										include get_stylesheet_directory() . '/includes/browseby.php';
									}
									else {
														
										include get_template_directory() . '/includes/browseby.php';
									}
							
							 ?>
					  </div>
					</div>
				</div>
			<?php } ?>
			
				  <div class="accordion-group">
					<div class="accordion-heading">
					  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwoBoth"><i class="icon-search icon-white"></i>
							<?php echo get_option('wp_heading_searchmls'); ?>
					  </a>
					</div>
					<div id="collapseTwoBoth" class="accordion-body collapse">
					  <div class="accordion-inner">
							<?php 	if ( dynamic_sidebar('dsIDXpress Search') ) { ?>
							<?php } ?>
					  </div>
					</div>
				  </div>
				  
				  <div class="accordion-group">
					<div class="accordion-heading">
					  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThreeBoth"><i class="icon-search icon-white"></i>
							<?php echo get_option('wp_heading_customsearch'); ?>
					  </a>
					</div>
					<div id="collapseThreeBoth" class="accordion-body collapse">
					  <div class="accordion-inner">
							<?php //include get_template_directory() . '/includes/customsearchform-houses.php';
							
							//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
							if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/customsearchform-houses.php') ) 
							{			
								include get_stylesheet_directory() . '/includes/customsearchform-houses.php';
							}
							else {
														
								include get_template_directory() . '/includes/customsearchform-houses.php';
							}
							
							
							
							 ?>
					  </div>
					</div>
				  </div>
			</div>
		<?php } ?>
<?php } ?>


<?php if (get_option('wp_site') == "Car Sales") { ?>
			<div class="accordion" id="accordion4">
				<?php if (get_option('wp_includebrowseby') == "Yes") { ?>
					<div class="accordion-group">
						<div class="accordion-heading">
						  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapseOneCars"><i class="icon-search icon-white"></i>
								<?php echo get_option('wp_browseby_text'); ?>
						  </a>
						</div>
						<div id="collapseOneCars" class="accordion-body collapse">
						  <div class="accordion-inner">
								<?php //include get_template_directory() . "/includes/browseby.php";
								
									//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
									if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/browseby.php') ) 
									{			
										include get_stylesheet_directory() . '/includes/browseby.php';
									}
									else {
																
										include get_template_directory() . '/includes/browseby.php';
									}
								
								
								
								 ?>
						  </div>
						</div>
					</div>
				<?php } ?>
					<?php if(get_option('wp_showsearch') == "show") { ?>
					<div class="accordion-group">
						<div class="accordion-heading">	
							 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapseTwoCars"><i class="icon-search icon-white"></i>
								<?php echo get_option('wp_heading_customsearch'); ?>

							</a>
						</div>
						<div id="collapseTwoCars" class="accordion-body collapse">				
							<div class="accordion-inner">
								<?php //include get_template_directory() . '/includes/customsearchform-cars.php';
								
								//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
							if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/customsearchform-cars.php') ) 
							{			
								include get_stylesheet_directory() . '/includes/customsearchform-cars.php';
							}
							else {
														
								include get_template_directory() . '/includes/customsearchform-cars.php';
							}
								
								 ?>
							</div>
						</div>
					</div>
					<?php } ?>
				
			</div>
<?php } ?>

</div>











