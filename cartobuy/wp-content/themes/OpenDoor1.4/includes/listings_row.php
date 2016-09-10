<div class="listingblock">
	<div class="four columns alpha">
		<?php 
		$openhousedate = "";
		$mlslisting = "";
		$mls = "";
		
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
		<?php 
			$arr_sliderimages = get_gallery_images();
			
			if($arr_sliderimages[0]) {
					$resized = aq_resize ($arr_sliderimages[0], 400, 300, true);
					$resized_infowindowimage = aq_resize($arr_sliderimages[0], 50, 50, true);
				} else {
					$resized = aq_resize (get_option('wp_noimage'), 400, 300, true);
					$resized_infowindowimage = aq_resize(get_option('wp_noimage'), 50, 50, true);
				}
		?>

		<a href="<?php the_permalink(); ?>">
			<div class="vignette">
					<img class="listing_thumbnail" width="350" height="200" alt="" src="<?php echo $resized ?>" />
			</div>
		</a>
		
		<?php //include get_template_directory() . '/includes/banner.php';
				
			 //Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
			if ( get_stylesheet_directory() != get_template_directory() && 
			file_exists(get_stylesheet_directory().'/includes/banner.php') ) 
			{			
				include get_stylesheet_directory() . '/includes/banner.php';
			}
			else {
							
				include get_template_directory() . '/includes/banner.php';
			}	
						
		 ?>
	</div>

	<div class="eight columns omega listingblocktext">
		<div class="listingblocksection">
		<p class="price">
		<?php if ($reducedby) { 
				$reducedbytext = get_option('wp_reducedby_text');
			 
			if (get_option('wp_currencyposition') == "Before") {
				$before = $currencysymbol;
				} elseif (get_option('wp_currencyposition') == "After") {
				$before = "";
				} 

			if (get_option('wp_currencyposition') == "After") {
				$after = $currencysymbol;
				} elseif (get_option('wp_currencyposition') == "Before") {
				$after = "";
			} ?>
		
			<a class="reduced" href="#" title="<?php echo $reducedbytext . " " . $before . $reducedby . $after; ?>"><img src="<?php echo get_template_directory_uri()  ?>/images/downarrow.png" alt="" /></a>
			<?php } ?>
		
		<?php //include 'price.php'; 
			
			 //Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
			if ( get_stylesheet_directory() != get_template_directory() && 
			file_exists(get_stylesheet_directory().'/includes/price.php') ) 
			{			
				include get_stylesheet_directory() . '/includes/price.php';
			}
			else {
							
				include get_template_directory() . '/includes/price.php';
			}			
			
		 ?>
		</p>
		<h4 class="address">
			<?php if (get_option('wp_site') == "Real Estate") { ?>
				<?php echo $address . ", " . $citystatezip; ?>
					<?php } else { ?>
				<?php the_title() ?>
			<?php } ?>
		</h4>
		
		
					
		<p class="twofeatures">
			<?php //include get_template_directory() . "/includes/twofeatures.php";
			
				//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
				if ( get_stylesheet_directory() != get_template_directory() && 
				file_exists(get_stylesheet_directory().'/includes/twofeatures.php') ) 
				{			
					include get_stylesheet_directory() . '/includes/twofeatures.php';
				}
				else {
								
					include get_template_directory() . '/includes/twofeatures.php';
				}
			
			
			 ?>
		</p>
		
		<?php if($openhousedate) { 
			$openhousedate2 = strtotime($openhousedate);
			$today = strtotime(Date("F d, Y"));
			if ($today <= $openhousedate2) { ?>
				<p class='openhouse'><i class='icon-calendar'></i>
					 <?php echo get_option('wp_openhouse_text') ?>: <?php echo $openhousedate . ", " . $openhousetime; ?>
				</p>
			<?php }} ?>
			
			        <?php if ($mlslisting == "Yes" && $mls) { ?>
						<a class="btn btn-lightgray" href="<?php bloginfo('url') ?>/idx/mls-<?php echo $mls ?>-">
						<?php echo get_option('wp_readmore_text'); ?>
						</a>
					<?php } else { ?>
						<a class="btn btn-lightgray" href="<?php the_permalink() ?>">
							<?php echo get_option('wp_readmore_text'); ?>
						</a>
					<?php } ?>
					
		
			<?php if (get_option('wp_compare') == "show") { ?>
				<span class="compare">
					<input type="checkbox" name="<?php echo the_id() ?>" />
					<a class="comparelink" href="#" onclick="return false">
						<?php echo get_option('wp_compare_text'); ?>
					</a>
				</span>
			<?php } ?>
			
		</div>	
	</div>
	
	
	
</div>
