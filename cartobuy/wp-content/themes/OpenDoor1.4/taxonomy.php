<?php get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
?>

<script type="text/javascript">
$(document).ready(function() {
  location.href = "#headeranchor";
  remember( '[name=orderdropdown]' );
 	$('#collapseOneHouses').addClass('in');
	$('#collapseOneIdx').addClass('in');
	$('#collapseOneBoth').addClass('in');
	$('#collapseOneCars').addClass('in');
	
	$('#collapseTwoHouses').removeClass('in');
	$('#collapseThreeBoth').removeClass('in');
	$('#collapseTwoIdx').removeClass('in');
	$('#collapseTwoBoth').removeClass('in');
	$('#collapseTwoCars').removeClass('in');
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
<h2 id="title"><?php echo $term->name ?></h2>
</div>
</div>

<?php
$array_mapinfo = "";

$resultsorder = "";
if (isset($_GET['orderdropdown'])) {
$resultsorder = $_GET['orderdropdown'];
}

if ($resultsorder) {
	$resultsorder = $resultsorder;
} elseif(isset($_COOKIE['orderdropdown'])) {
	$resultsorder = $_COOKIE['orderdropdown'];
} else {
	$resultsorder = get_option('wp_browse_order');
}
$resultsorder = str_replace(" ", "", $resultsorder);
?>	

<?php if (get_option('wp_site') == "Real Estate") { ?>
	<?php if (is_tax('property_type')) {
	$tax = "property_type";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	}
	else if (is_tax('features')) {
	$tax = "features";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	}
	
	else if (is_tax('other')) {
	$tax = "other";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	}
	
	else if (is_tax('property_pricerange')) {
	$tax = "property_pricerange";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	}
	else if (is_tax('property_location')) {
	$tax = "property_location";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	} 

	else if (is_tax('property_buyorrent')) {
	$tax = "property_buyorrent";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	} 
	?>
<?php } ?>




<?php if (get_option('wp_site') == "Car Sales") { ?>
	<?php if (is_tax('features')) {
	$tax = "features";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	}

	else if (is_tax('dealerlocation')) {
	$tax = "dealerlocation";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	}
	
	else if (is_tax('enginesize')) {
	$tax = "enginesize";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	}
	
	
	else if (is_tax('transmission')) {
	$tax = "transmission";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	} 
	
	else if (is_tax('other')) {
	$tax = "other";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	}

	else if (is_tax('pricerange')) {
	$tax = "pricerange";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	} 

	else if (is_tax('bodytype')) {
	$tax = "bodytype";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	} 

	else if (is_tax('modelyear')) {
	$tax = "modelyear";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	} 

	else if (is_tax('manufacturer')) {
	$tax = "manufacturer";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	} 

	else if (is_tax('mileage')) {
	$tax = "mileage";
	$browsetype = $resultsorder;
	$wpq = browseorder($browsetype, $tax, $term);
	} 
	?>
<?php } ?>


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

<?php 
$counter = 0; 
query_posts($wpq); 
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
		$array_mapinfo[$counter] = array(0 =>$themap, 1=>$address, 2=>$citystatezip, 3=>$resized_infowindowimage, 4=>$price, 5=>$theurl);
		$counter = $counter + 1;
	}
	?>
	<?php endwhile ?>
	<?php else : ?>
	
	<div>
	<p><?php echo get_option('wp_noresults');  ?></p>
	
	<?php if (get_option('wp_site') == "Real Estate") { ?>
	   <script type="text/javascript">
		$('#searchresultsmapcontainer').hide();
		</script>
	<?php } ?>
	</div>
	
	
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
			
			window.location = "<?php echo $fix; ?><?php echo $slugname ?>?lang=<?php echo $langcode ?>&compare=" + ids;
			
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


<script type="text/javascript">
function remember( selector ){
$(selector).each(
function(){
//if this item has been cookied, restore it
var name = $(this).attr('name');
if( $.cookie( name ) ){
$(this).val( $.cookie(name) );
}
//assign a change function to the item to cookie it
$(this).change(
function(){
$.cookie(name, $(this).val(), { path: '/', expires: 365 });
}
);
}
);
}
</script>

<?php get_footer() ?>