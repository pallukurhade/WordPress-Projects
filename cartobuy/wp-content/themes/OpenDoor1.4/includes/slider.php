<script type="text/javascript">
$(document).ready(function(){
	$('#slider').unoslider({
		preset: '<?php echo get_option('wp_slideshowtransition') ?>',
		slideshow: {speed: <?php echo get_option('wp_seconds') ?>}
	}); 
});

</script>

<ul id="slider" class="unoslider">


<?php 
if(!empty($_COOKIE['slider'])) $cookieslider = $_COOKIE['slider'];
$cookieslider = "";
$slider = get_option('wp_slideshowsource'); 
if ($cookieslider) {
	$slider = $cookieslider;
	} else {
	$slider = $slider;
	}
?>

<?php if ($slider == "Recent Listings") {
		if (get_option('wp_filtersold') == 'Yes') {
			$query = new WP_Query(array('post_type' => 'listing', 'posts_per_page' => get_option('wp_slideshownumber'), 'meta_query' => array(array('key'=>'slideshow_value', 'value'=>'Yes'), array('key'=>'sold_value', 'value'=>'No')), 'orderby' => 'rand' ));
		} else {
			$query = new WP_Query(array('post_type' => 'listing', 'posts_per_page' => get_option('wp_slideshownumber'), 'meta_query' => array(array('key'=>'slideshow_value', 'value'=>'Yes')), 'orderby' => 'rand' ));
		}
		} elseif ($slider == "Listings on Google Map") {
		$query = new WP_Query('post_type=listing&posts_per_page=-1');
	} else {
		$query = new WP_Query(array('post_type'=>'photoslideshow', 'posts_per_page' => get_option('wp_slideshownumber'), 'orderby' => 'rand'));
	}
?>


<?php if ($slider == "Listings on Google Map") { ?>
	<div class="slidermap" id="map"></div>
	<?php 	
		$counter = 0; 
	?>
			
    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
		<?php
		
				if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/variables.php') ) 
					{			
						include get_stylesheet_directory() . '/includes/variables.php';
					}
					else {
									
						include get_template_directory() . '/includes/variables.php';
					}
			
			$arr_sliderimages = get_gallery_images();
			$resized_infowindowimage = aq_resize($arr_sliderimages[0], 50, 50, true);
		?>						

		<?php 
		if (get_option('wp_currencyposition') == "Before") {
			$before = $currencysymbol;
			} elseif (get_option('wp_currencyposition') == "After") {
			$before = "";
			} 
			
		if (get_option('wp_currencyposition') == "After") {
			$after = $currencysymbol;
			} elseif (get_option('wp_currencyposition') == "Before") {
			$after = "";
		} 
		
		if ($pricecustom) {
			$price = $pricecustom;
			} else {
			$price = $before . $price . $after;
			}
		
		
			if ($map) {
			$themap = $map;
			} else {
			$themap = $address . " " . $citystatezip;
			}
			
			if (function_exists('qtrans_getLanguage')) {
				$langcode = qtrans_getLanguage();
			}
			
			$theurl = get_permalink() . "?lang=" . $langcode;
			$array_mapinfo[$counter] = array(0 =>$themap, 1=>$address, 2=>$citystatezip, 3=>$resized_infowindowimage, 4=>$price, 5=>$theurl);
			$counter = $counter + 1;
		?>
	
	<?php endwhile ?>
	<?php else : ?>
	<?php endif; ?>
	<?php if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/js/resultsmap.php') ) 
			{			
				include get_stylesheet_directory() . '/js/resultsmap.php';
			}
			else {
				include get_template_directory() . '/js/resultsmap.php';
			}
	?>
	

<?php } else { ?>


		<?php 
		
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
		<?php 
			$mlslisting = "";
			$mls = "";
		?>
		<?php 
			if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/variables.php') ) 
			{			
				include get_stylesheet_directory() . '/includes/variables.php';
			}
			else {
				include get_template_directory() . '/includes/variables.php';
			}
		
		?>
		<li>
			<?php 
			if ($slideshowimage) {
				$resized = $slideshowimage;
				} else {
				$arr_sliderimages = get_gallery_images();	
				
				if (get_option('wp_slideshowlayout') == 'Full Width') {
					$w = 960;
				} else {
					$w = 700;
				}
				
				$resized = aq_resize($arr_sliderimages[0], $w, 400, true);
				}
			?>
			
				<?php if ($slider == "Recent Listings") { ?>
				<div class="html_content">
					<div class="slidertext">
						<h2>
						<?php if ($slideshowtitle) {
							echo $slideshowtitle;
							} else {
							the_title();
							} ?>
						</h2>
						<p class="twofeatures">
						<?php 
							if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/twofeatures.php') ) 
							{			
								include get_stylesheet_directory() . '/includes/twofeatures.php';
							}
							else {
								include get_template_directory() . '/includes/twofeatures.php';
							}
						
						?>
						
						
						</p>
						<p class="price">
						<?php 
							if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/price.php') ) 
							{			
								include get_stylesheet_directory() . '/includes/price.php';
							}
							else {
								include get_template_directory() . '/includes/price.php';
							}
						
						?>
						
						</p>
						<?php if ($mlslisting == "Yes" && $mls) { ?>
							<a class="btn btn-large btn-colorscheme" href="<?php bloginfo('url') ?>/idx/mls-<?php echo $mls ?>-"><?php echo get_option('wp_readmore_text') ?></a>
						<?php } else { ?>
							<a class="btn btn-colorscheme btn-large" href="<?php the_permalink() ?>"><?php echo get_option('wp_readmore_text') ?></a>
						<?php } ?>
					</div>
					<?php 
							if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/banner.php') ) 
							{			
								include get_stylesheet_directory() . '/includes/banner.php';
							}
							else {
								include get_template_directory() . '/includes/banner.php';
							}
					?>
				</div>
				<?php } ?>
			
		
			
		
			<?php if (get_option('wp_slideshowsource') == "Recent Listings") { ?>
				<img alt="" src="<?php echo $resized ?>" />
			<?php } else { ?>
				<a href="<?php echo $slideshow_url; ?>">
					<img alt="" src="<?php echo $resized ?>" />
				</a>
			<?php } ?>
		
		
			
		</li>
				
		<?php endwhile; else: ?>

		<?php endif; 
		wp_reset_query(); ?> 

<?php } ?>

</ul>