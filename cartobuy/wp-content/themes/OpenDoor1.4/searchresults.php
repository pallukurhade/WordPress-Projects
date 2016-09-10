<?php
/*
 * Template Name: Search Results
 */
?>

<?php get_header() ?>

<script type="text/javascript">
$(document).ready(function() {
  location.href = "#headeranchor";
  remember( '[name=orderdropdown]' );
});
</script>

<div class="sixteen columns outercontainer bigheading">
<form method="get" id="orderresults" name="orderresults">
	<select id="orderdropdown" name="orderdropdown" onChange="document.forms['orderresults'].submit()">
	  <option value="Price Descending"><?php echo get_option('wp_price_descending') ?></option>
	  <option value="Price Ascending"><?php echo get_option('wp_price_ascending') ?></option>
	  <option value="Date Descending"><?php echo get_option('wp_date_descending') ?></option>
	  <option value="Date Ascending"><?php echo get_option('wp_date_ascending') ?></option>
	  <?php if (get_option('wp_site') == "Car Sales") { ?>
		  <option value="Model Year Descending"><?php echo get_option('wp_modelyear_descending') ?></option>
		  <option value="Model Year Ascending"><?php echo get_option('wp_modelyear_ascending') ?></option>
		  <option value="Mileage Descending"><?php echo get_option('wp_mileage_descending') ?></option>
		  <option value="Mileage Ascending"><?php echo get_option('wp_mileage_ascending') ?></option>
	  <?php } ?>
	</select>
</form>
<div class="four columns alpha">
&nbsp;
</div>
<div class="twelve columns omega">
<?php 
//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
if ( get_stylesheet_directory() != get_template_directory() && 
file_exists(get_stylesheet_directory().'/includes/search_query.php') ) 
{			
	include get_stylesheet_directory() . '/includes/search_query.php';
				
}
else {
							
	include get_template_directory() . '/includes/search_query.php';
				
}

 ?>
</div>
</div>

<div class="sixteen columns outercontainer" id="content">


	<div class="four columns alpha" id="leftsidebar">
		<?php get_sidebar() ?>
	</div>
	
	<div class="twelve columns omega">
	
	
<?php if (get_option('wp_site') == "Real Estate") { ?>	
	<?php if (get_option('wp_showmap') == "show") { ?>
		<div id="searchresultsmapcontainer">
			<div class="searchresultsmap" id="map"></div>
			<p id="mapdisclaimer">
				<?php echo get_option('wp_mapdisclaimer_text'); ?>
			</p>
		</div>
	<?php } ?>
<?php } ?>	
	
	

<form>

<?php $counter = 0; 
$array_mapinfo = "";
?>
			<?php 	
				$margincounter = 1;
			?>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	
	<?php 	
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
		} ?>
	
	
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
		
	
	
		if (get_option('wp_site') == "Real Estate") {
			if ($map) {
			$themap = $map;
			} else {
			$themap = $address . " " . $citystatezip;
			}
			
			$langcode = "";
			if (function_exists('qtrans_getLanguage')) {
				$langcode = qtrans_getLanguage();
			}
			
			$theurl = get_permalink() . "?lang=" . $langcode;
			$array_mapinfo[$counter] = array(0 =>$themap, 1=>$address, 2=>$citystatezip, 3=>$resized_infowindowimage, 4=>$price, 5=>$theurl, 6=>$pricecustom);
			$counter = $counter + 1;
		}
	?>
	
	<?php endwhile ?>
	<?php else : ?>
	
	
		<p>
		<?php echo get_option('wp_noresults');  ?></p>
		<?php if (get_option('wp_site') == "Real Estate") { ?>
	   <script type="text/javascript">
			$('#searchresultsmapcontainer').hide();
		</script>
	<?php } ?>
	
	<?php endif; ?>
	
	<?php 	
	//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
	if ( get_stylesheet_directory() != get_template_directory() && 
	file_exists(get_stylesheet_directory().'/js/resultsmap.php') ) 
	{			
		include get_stylesheet_directory() . '/js/resultsmap.php';
							
	}
	else {
										
		include get_template_directory() . '/js/resultsmap.php';
							
	}	
	
	
	 ?>
	
	<script type="text/javascript">
	$(function() {
		$('.comparelink').click(function() {
			
			var ids = "";
			var counter = 0;
			
			var comma = "";
			$('.listingblock input[type=checkbox]').each(function(index) {
				
				if ($(this).attr('checked')) {
				
				
					if (counter == 0) {
						comma = "";
						} else {
						comma = ",";
						}
						counter = counter + 1;
					ids = ids + comma + $(this).attr('name');
				}
			});
			
		<?php 
		$comparepage = get_post($wp_comparepageid);
		$slugname = $comparepage -> post_name;
		
		if (get_option('wp_searchresultspagefix') == "Yes") { 
		$fix = "index.php/";
		} elseif (get_option('wp_searchresultspagefix') == "No") {
		$fix = "";
		} 
		
		if (function_exists('qtrans_getLanguage')) {
			$langcode = qtrans_getLanguage();
		}
		  //$theurl = get_bloginfo('url');
		?>
		
		if (counter > 1) {
			
			window.location = "<?php echo $fix; ?><?php echo $slugname ?>/?lang=<?php echo $langcode ?>&compare=" + ids;
			
		}
		});
		});
	</script>
	
	<div style="clear: both;"></div>
	<?php if (!function_exists('wp_pagenavi')) { 
		echo "<div class='alert alert-error'><i class='icon-exclamation-sign'></i> For advanced pagination, please install the <a href='http://wordpress.org/extend/plugins/wp-pagenavi/'>PageNavi plugin</a>.</div>";
		} else {
		wp_pagenavi(); 
		} ?>
</form>


	
	
	
	</div>
</div>

<?php get_footer() ?>