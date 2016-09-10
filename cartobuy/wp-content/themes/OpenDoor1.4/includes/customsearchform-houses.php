<?php  
$checkalllistings = $_GET['alllistings'];
if ($checkalllistings) { ?>
	<script>
	$.cookie('location_level1', '', { path: '/', expires: 365 });
	$.cookie('location_level2', '', { path: '/', expires: 365 });
	$.cookie('rentbuy', '', { path: '/', expires: 365 });
	$.cookie('beds', '', { path: '/', expires: 365 });
	$.cookie('baths', '', { path: '/', expires: 365 });
	$.cookie('minprice_buy', '', { path: '/', expires: 365 });
	$.cookie('maxprice_buy', '', { path: '/', expires: 365 });
	$.cookie('minprice_rent', '', { path: '/', expires: 365 });
	$.cookie('maxprice_rent', '', { path: '/', expires: 365 });
	$.cookie('propertytype', '', { path: '/', expires: 365 });
	
	$.cookie('resorcomm', '', { path: '/', expires: 365 });
	$.cookie('size', '', { path: '/', expires: 365 });
	$.cookie('lotsize', '', { path: '/', expires: 365 });
	$.cookie('garage', '', { path: '/', expires: 365 });
	$.cookie('yearbuilt', '', { path: '/', expires: 365 });
	$.cookie('openhouse', '', { path: '/', expires: 365 });
	
	
	</script>
<?php } ?>



<script type="text/javascript">
$(document).ready(function() {
	var value = $('#rentorbuy select').val();
	if (value == "rent") {
		$('#buyprices').hide();
		$('#rentprices').show();
	} 
	
	if (value == "buy" || value == "") {
		$('#buyprices').show();
		$('#rentprices').hide();
	} 
	
$('#alllistingslink').click(function() {
	$.cookie('location_level2', '', { path: '/', expires: 365 });
	$.cookie('rentbuy', '', { path: '/', expires: 365 });
	$.cookie('beds', '', { path: '/', expires: 365 });
	$.cookie('baths', '', { path: '/', expires: 365 });
	$.cookie('minprice_buy', '', { path: '/', expires: 365 });
	$.cookie('maxprice_buy', '', { path: '/', expires: 365 });
	$.cookie('minprice_rent', '', { path: '/', expires: 365 });
	$.cookie('maxprice_rent', '', { path: '/', expires: 365 });
	$.cookie('propertytype', '', { path: '/', expires: 365 });
});

$('#location_level1').change(function() {
	$.cookie('location_level2', '', { path: '/', expires: 365 });
});

$('#rentorbuy select').change(function() {
	if ($('#rentorbuy select').val() == '') {
		$.cookie('rentbuy', '', { path: '/', expires: 365 });
	}
});

$('#beds select').change(function() {
	if ($('#beds select').val() == '') {
		$.cookie('beds', '', { path: '/', expires: 365 });
	}
});

$('#baths select').change(function() {
	if ($('#baths select').val() == '') {
		$.cookie('baths', '', { path: '/', expires: 365 });
	}
});

$('#buyprices .pricemin select').change(function() {
	if ($('#buyprices .pricemin select').val() == 0) {
		$.cookie('minprice_buy', '', { path: '/', expires: 365 });
	}
});

$('#buyprices .pricemax select').change(function() {
	if ($('#buyprices .pricemax select').val() == 99999999999999) {
		$.cookie('maxprice_buy', '', { path: '/', expires: 365 });
	}
});

$('#rentprices .pricemin select').change(function() {
	if ($('#rentprices .pricemin select').val() == 0) {
		$.cookie('minprice_rent', '', { path: '/', expires: 365 });
	}
});

$('#rentprices .pricemax select').change(function() {
	if ($('#rentprices .pricemax select').val() == 99999999999999) {
		$.cookie('maxprice_rent', '', { path: '/', expires: 365 });
	}
});

$('#propertytype').change(function() {
	if ($('#propertytype').val() == '') {
		$.cookie('propertytype', '', { path: '/', expires: 365 });
	}
});


// new search items
$('#resorcomm select').change(function() {
	if ($('#resorcomm select').val() == '') {
		$.cookie('resorcomm', '', { path: '/', expires: 365 });
	}
});

$('#size select').change(function() {
	if ($('#size select').val() == '') {
		$.cookie('size', '', { path: '/', expires: 365 });
	}
});

$('#lotsize select').change(function() {
	if ($('#lotsize select').val() == '') {
		$.cookie('lotsize', '', { path: '/', expires: 365 });
	}
});

$('#garage select').change(function() {
	if ($('#garage select').val() == '') {
		$.cookie('garage', '', { path: '/', expires: 365 });
	}
});

$('#yearbuilt select').change(function() {
	if ($('#yearbuilt select').val() == '') {
		$.cookie('yearbuilt', '', { path: '/', expires: 365 });
	}
});

$('#openhouse select').change(function() {
	if ($('#openhouse select').val() == '') {
		$.cookie('openhouse', '', { path: '/', expires: 365 });
	}
});


$('#search button').click(function() {
	if ($('#location_level2').val() == '') {
		$.cookie('location_level2', '', { path: '/', expires: 365 });
	}
});
});
</script>


<?php //include 'variables.php';

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


$priceoptions = "";
$prices = get_option('wp_price');
$arr_prices = explode("\n", $prices);
foreach ($arr_prices as $p) {
	$priceoptions = $priceoptions . "<option value='" . $p . "'>" . $before . number_format((float)$p, '0','.',get_option('wp_thousandseparator')) . $after . "</option>";
}

$priceoptions2 = "";
$prices2 = get_option('wp_price2');
$arr_prices2 = explode("\n", $prices2);
foreach ($arr_prices2 as $p2) {
	$priceoptions2 = $priceoptions2 . "<option value='" . $p2 . "'>" . $before . number_format((float)$p2, '0','.',get_option('wp_thousandseparator')) . $after . "</option>";
}





$propertytypeoptions = "";
$propertytype = get_option('wp_propertytype');
$arr_propertytype = explode("\n", $propertytype);
$langcode = "";
if (function_exists('qtrans_getLanguage')) {
	$langcode = qtrans_getLanguage();
}

//detect language of first line. That will make assumption of default language
$defaultlangarray = explode(":", $arr_propertytype[0]);
	if (count($defaultlangarray) != 2) {
		$singlelanguage = true;
	} else {
		$singlelanguage = false;
	}
	if ($singlelanguage == false) {
		$defaultlang = $defaultlangarray[1];
		//make array of all in dropdown from this language
		$arrpropertytype = "";
		foreach ($arr_propertytype as $pt) {
			if(strpos($pt, ":".$defaultlang)) {
					$pt = explode(":", $pt);
					$pt = $pt[0];
					$arrpropertytype = $arrpropertytype . $pt . "|";
			}
		}
		$defaultlangtext = explode("|", $arrpropertytype);
		$count = 0;

		foreach ($arr_propertytype as $pt) {
			
			if(strpos($pt, ":".$langcode)) {
				$pt = explode(":", $pt);
				$pt = $pt[0];
			$propertytypeoptions = $propertytypeoptions . "<option value='" .$defaultlangtext[$count] . "'>" . $pt . "</option>";
			$count = $count + 1;
			}
		}

} else {
		foreach ($arr_propertytype as $pt) {
			$propertytypeoptions = $propertytypeoptions . "<option value='" . $pt . "'>" . $pt . "</option>";
			}
}


$yearoptions = "";
$year = get_option('wp_year');
$arr_year = explode("\n", $year);
foreach ($arr_year as $yr) {
	$yearoptions = $yearoptions . "<option value='" . $yr . "'>" . $yr . "+</option>";
}


$sizeoptions = "";
$size = get_option('wp_size');
$arr_size = explode("\n", $size);
foreach ($arr_size as $sz) {
	$sizeoptions = $sizeoptions . "<option value='" . $sz . "'>" . $sz. " + " . get_option('wp_sizesuffix') . "</option>";
}


?>

<?php
  $searchpage = get_post($wp_searchpageid);
  $slugname = $searchpage -> post_name;
  $langcode = "";

  if (function_exists('qtrans_getLanguage')) {
	$langcode = qtrans_getLanguage();
	}

if (get_option('wp_searchresultspagefix') == "Yes") { 
	$fix = "index.php/";
	} elseif (get_option('wp_searchresultspagefix') == "No") {
	$fix = "";
	}

$searchurl = home_url() . "/" . $fix . $slugname . "/?lang=".$langcode;
?>

<form id="searchform" action="<?php echo $searchurl; ?>" method="post">

			<?php if (get_option('wp_search_location') == "Yes") { ?>
				<div id="location">	
					<label>
					<?php echo get_option('wp_location_text'); ?>
					</label>
					
					<?php 	
					$locationoptions = "";
					$location_level1 = get_option('wp_location_level1');
					$arr_location_level1 = explode("\n", $location_level1);
					foreach ($arr_location_level1 as $item) {
					$item = trim($item);
						$countlocations = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts p, $wpdb->postmeta p1
								WHERE p.post_status = 'publish' AND p.ID = p1.post_id AND p1.meta_key = 'location_level1_value' AND p1.meta_value = '$item'");	

							if ($countlocations > 0) {
								if (get_option('wp_filtersold') == 'Yes') {	
									$locationoptions = $locationoptions . "<option value='" . $item . "'>" . $item . " </option>";
									} else {
								
									$locationoptions = $locationoptions . "<option value='" . $item . "'>" . $item . " (" . $countlocations . ")</option>";
									}
							}
					}		
					?>
								

					<select id='location_level1' name='location_level1'>
						<option value="" selected='selected'>
							<?php echo get_option('wp_anywhere_text'); ?>
						</option>
						<?php echo $locationoptions; ?>
					</select>
					
					<?php if(get_option("wp_secondary_location") == 'Enable') { ?>
						 
						 <div id="location_level2_drop_down" class="searchfullwidth">
							 <select id="location_level2" name="location_level2">
							 </select>
						 </div>
						
					<?php } ?>
				</div><!-- end location -->
			<?php } ?>
			
			<?php if (get_option('wp_search_bor') == "Yes") { ?>
					<div id="rentorbuy">
						<label>
							<?php echo get_option('wp_rentorbuy_text'); ?>
						</label>
						<select name="rentbuy">
							<option value=""><?php echo get_option('wp_any_text') ?></option>
							<option value="rent">Rent</option>
							<option value="buy">Buy</option>
						</select>
					</div>
				<?php } ?>
				
				


				<?php if (get_option('wp_search_beds') == "Yes") { ?>
				<div id="beds">
					<label>
					<?php echo get_option('wp_bedrooms_text'); ?>
					</label>
            	<select name="beds">
				
					<option value="">
						<?php echo get_option('wp_any_text'); ?>
					</option>
                    <option value="1">1+</option>
                    <option value="2">2+</option>
                    <option value="3">3+</option>
                    <option value="4">4+</option>
                    <option value="5">5+</option>
                </select>
				</div><!-- end beds -->
				<?php } ?>
				
				
				
				
				<?php if (get_option('wp_search_baths') == "Yes") { ?>
				<div id="baths">
           			<label>
					<?php echo get_option('wp_bathrooms_text'); ?>
					</label>
			    <select name="baths">
					<option value="">
						<?php echo get_option('wp_any_text'); ?>
					</option>
                    <option value="1">1+</option>
                    <option value="2">2+</option>
                    <option value="3">3+</option>
                    <option value="4">4+</option>
                    <option value="5">5+</option>
				</select>
				</div><!-- end baths -->
				<?php } ?>
				
			
			<?php if (get_option('wp_search_price') == "Yes") { ?>
			<!-- BUY PRICES -->
			<div id="buyprices">
			<!-- minimum price dropdown menu -->
			<div class="pricemin">
					<label>
					<?php echo get_option('wp_minimumprice_text'); ?>
					</label>
					<select name="minprice_buy">
                		<option value="0">
						<?php echo get_option('wp_nomin_text'); ?>
						</option>
                    <?php echo $priceoptions ?>
					</select>
			</div><!-- end pricemin -->
			
			<!-- Maximum price dropdown menu -->
			<div class="pricemax">
				<label>
					<?php echo get_option('wp_maximumprice_text'); ?>
					</label>
				<select name="maxprice_buy">
                	<option value="9999999999999">
						<?php echo get_option('wp_nomax_text'); ?>
						</option>
					<?php echo $priceoptions ?>
				</select>
			</div><!-- end pricemax -->
			</div> <!-- end buyprices -->
			
			
			
			<!-- RENT PRICES -->
			<?php if (trim(get_option('wp_search_bor') == "Yes")) { ?>
			
				<!-- minimum price dropdown menu -->
				<div id="rentprices" style="display: none;">
				<div class="pricemin">
					<label>
						<?php echo get_option('wp_minimumprice_text'); ?>
					</label>
					<select name="minprice_rent">
						<option value="0">
						<?php echo get_option('wp_nomin_text'); ?>
						</option>
						<?php echo $priceoptions2 ?>
					</select>
				</div><!-- end pricemin -->
				
				
				
				<!-- Maximum price dropdown menu -->
				<div class="pricemax">
					<label>
					<?php echo get_option('wp_maximumprice_text'); ?>
					</label>
					<select name="maxprice_rent">
						<option value="9999999999999">
							<?php echo get_option('wp_nomax_text'); ?>
						</option>
						<?php echo $priceoptions2 ?>
					</select>
				</div><!-- end pricemax -->
				</div><!-- end RENT PRICES -->
			<?php } ?>
			<?php } ?>
			
		
		
			<?php if (get_option('wp_search_propertytype') == "Yes") { ?>
			<div id="propertytype">
				<label>
					<?php echo get_option('wp_propertytype_text'); ?>
				</label>
				<select name="propertytype2">
					<option value=""><?php echo get_option('wp_any_text') ?></option>
					<?php echo $propertytypeoptions ?>
				</select>
			</div>
			<?php } ?>
			
			
			<?php if (get_option('wp_search_resorcomm') == "Yes") { ?>
			<div class="resorcomm">
				<label>
					<?php echo get_option('wp_resorcomm_text'); ?>
				</label>
				<select name="resorcomm">
					<option value=""><?php echo get_option('wp_any_text') ?></option>
					<option value="residential"><?php echo get_option('wp_residential_text') ?></option>
					<option value="commercial"><?php echo get_option('wp_commercial_text') ?></option>
				</select>
			</div>
			<?php } ?>
			
			
			<?php if (get_option('wp_search_openhouse') == "Yes") { ?>
			<div class="openhouse">
				<label>
					<?php echo get_option('wp_openhouse_text'); ?>
				</label>
				<select name="openhouse">
					<option value=""><?php echo get_option('wp_any_text') ?></option>
					<option value="yes"><?php echo get_option('wp_yes_text') ?></option>
				</select>
			</div>
			<?php } ?>
			
			
			<?php if (get_option('wp_search_yearbuilt') == "Yes") { ?>
			<div class="yearbuilt">
				<label>
				<?php echo get_option('wp_year_text'); ?>
				</label>
				<select name="yearbuilt">
					<option value=""><?php echo get_option('wp_any_text') ?></option>
					<?php echo $yearoptions; ?>
				</select>
			</div>
			<?php } ?>
			
			
			
			<?php if (get_option('wp_search_size') == "Yes") { ?>
			<div class="size">
				<label>
					<?php echo get_option('wp_size_text'); ?>
				</label>
				<select name="size">
					<option value=""><?php echo get_option('wp_any_text') ?></option>
					<?php echo $sizeoptions; ?>
				</select>
			</div>
			<?php } ?>
			
			
			<?php if (get_option('wp_search_lotsize') == "Yes") { ?>
			<div class="lotsize">
				<label>
					<?php echo get_option('wp_lotsize_text'); ?>
				</label>
				<select name="lotsize">
						<option value="">
							<?php echo get_option('wp_any_text') ?>
						</option>
						<?php echo $sizeoptions; ?>
				</select>
			</div>
			<?php } ?>
			
			
			
			<?php if (get_option('wp_search_garagespaces') == "Yes") { ?>
			<div id="garage">
				<label>
				<?php echo get_option('wp_garage_text'); ?>
				</label>
			<select name="garage">
				<option value="">
					<?php echo get_option('wp_any_text'); ?>
				</option>
				<option value="1">1+</option>
				<option value="2">2+</option>
				<option value="3">3+</option>
				<option value="4">4+</option>
				<option value="5">5+</option>
			</select>
			</div>
			<?php } ?>
			
			<?php if (get_option('wp_search_mls') == "Yes") { ?>
			<div class="mls">
				<label>
				<?php echo get_option('wp_mls_text'); ?>
				</label>
               	<input type="text" name="mls" />
			</div>
			<?php } ?>

			

		<div><button class="btn btn-large btn-block btn-darkgray"><?php echo get_option('wp_searchbutton_text') ?></button></div>
			
			<?php if(get_option('wp_demo') == 'on') { ?>
				<p class="demo">Demo Note: All search dropdowns can be included or excluded in Theme Options.<br /><br />Others not shown here: Residential/Commercial, Openhouse, Year Built, Size, Lot Size, Garage Spaces, and MLS number.</p>
			<?php } ?>
			
		</form>
		
		        <div class="clear"></div>
				
<?php if(get_option("wp_secondary_location") == "Enable") { ?>

<script type="text/javascript">
$(document).ready(function() {
	

	if ($('#location_level1').val() != "") {
		$filename_nospaces = $('#location_level1').val();
		$filename_nospaces = $filename_nospaces.replace(/Ç/g, "C");
		$filename_nospaces = $filename_nospaces.replace(/ü/g, "u");
		$filename_nospaces = $filename_nospaces.replace(/é/g, "e");
		$filename_nospaces = $filename_nospaces.replace(/â/g, "a");
		$filename_nospaces = $filename_nospaces.replace(/ä/g, "a");
		$filename_nospaces = $filename_nospaces.replace(/à/g, "a");
		$filename_nospaces = $filename_nospaces.replace(/ç/g, "c");
		$filename_nospaces = $filename_nospaces.replace(/ê/g, "e");
		$filename_nospaces = $filename_nospaces.replace(/ë/g, "e");
		$filename_nospaces = $filename_nospaces.replace(/è/g, "e");
		$filename_nospaces = $filename_nospaces.replace(/ï/g, "i");
		$filename_nospaces = $filename_nospaces.replace(/î/g, "i");
		$filename_nospaces = $filename_nospaces.replace(/ì/g, "i");
		$filename_nospaces = $filename_nospaces.replace(/Ä/g, "A");
		$filename_nospaces = $filename_nospaces.replace(/Å/g, "A");
		$filename_nospaces = $filename_nospaces.replace(/É/g, "E");
		$filename_nospaces = $filename_nospaces.replace(/æ/g, "ae");
		$filename_nospaces = $filename_nospaces.replace(/Æ/g, "AE");
		$filename_nospaces = $filename_nospaces.replace(/ô/g, "o");
		$filename_nospaces = $filename_nospaces.replace(/ö/g, "o");
		$filename_nospaces = $filename_nospaces.replace(/ò/g, "o");
		$filename_nospaces = $filename_nospaces.replace(/û/g, "u");
		$filename_nospaces = $filename_nospaces.replace(/ù/g, "u");
		$filename_nospaces = $filename_nospaces.replace(/ÿ/g, "y");
		$filename_nospaces = $filename_nospaces.replace(/Ö/g, "O");
		$filename_nospaces = $filename_nospaces.replace(/Ü/g, "U");
		$filename_nospaces = $filename_nospaces.replace(/á/g, "a");
		$filename_nospaces = $filename_nospaces.replace(/í/g, "i");
		$filename_nospaces = $filename_nospaces.replace(/ó/g, "o");
		$filename_nospaces = $filename_nospaces.replace(/ú/g, "u");
		$filename_nospaces = $filename_nospaces.replace(/ñ/g, "n");
		$filename_nospaces = $filename_nospaces.replace(/Ñ/g, "N");
		$filename_nospaces = $filename_nospaces.replace(/¿/g, "?");
		$filename_nospaces = escape($filename_nospaces);
		$thefile = "<?php echo get_template_directory_uri();?>/secondary_locations/" + $filename_nospaces + ".txt";
		$("#location_level2").load($thefile);
		$('#location_level2_drop_down').show();
	}

$("#location_level1").change(function() {
	$filename_nospaces = $(this).val();
		$filename_nospaces = $filename_nospaces.replace(/Ç/g, "C");
		$filename_nospaces = $filename_nospaces.replace(/ü/g, "u");
		$filename_nospaces = $filename_nospaces.replace(/é/g, "e");
		$filename_nospaces = $filename_nospaces.replace(/â/g, "a");
		$filename_nospaces = $filename_nospaces.replace(/ä/g, "a");
		$filename_nospaces = $filename_nospaces.replace(/à/g, "a");
		$filename_nospaces = $filename_nospaces.replace(/ç/g, "c");
		$filename_nospaces = $filename_nospaces.replace(/ê/g, "e");
		$filename_nospaces = $filename_nospaces.replace(/ë/g, "e");
		$filename_nospaces = $filename_nospaces.replace(/è/g, "e");
		$filename_nospaces = $filename_nospaces.replace(/ï/g, "i");
		$filename_nospaces = $filename_nospaces.replace(/î/g, "i");
		$filename_nospaces = $filename_nospaces.replace(/ì/g, "i");
		$filename_nospaces = $filename_nospaces.replace(/Ä/g, "A");
		$filename_nospaces = $filename_nospaces.replace(/Å/g, "A");
		$filename_nospaces = $filename_nospaces.replace(/É/g, "E");
		$filename_nospaces = $filename_nospaces.replace(/æ/g, "ae");
		$filename_nospaces = $filename_nospaces.replace(/Æ/g, "AE");
		$filename_nospaces = $filename_nospaces.replace(/ô/g, "o");
		$filename_nospaces = $filename_nospaces.replace(/ö/g, "o");
		$filename_nospaces = $filename_nospaces.replace(/ò/g, "o");
		$filename_nospaces = $filename_nospaces.replace(/û/g, "u");
		$filename_nospaces = $filename_nospaces.replace(/ù/g, "u");
		$filename_nospaces = $filename_nospaces.replace(/ÿ/g, "y");
		$filename_nospaces = $filename_nospaces.replace(/Ö/g, "O");
		$filename_nospaces = $filename_nospaces.replace(/Ü/g, "U");
		$filename_nospaces = $filename_nospaces.replace(/á/g, "a");
		$filename_nospaces = $filename_nospaces.replace(/í/g, "i");
		$filename_nospaces = $filename_nospaces.replace(/ó/g, "o");
		$filename_nospaces = $filename_nospaces.replace(/ú/g, "u");
		$filename_nospaces = $filename_nospaces.replace(/ñ/g, "n");
		$filename_nospaces = $filename_nospaces.replace(/Ñ/g, "N");
		$filename_nospaces = $filename_nospaces.replace(/¿/g, "?");
		$filename_nospaces = escape($filename_nospaces);
	$thefile = "<?php echo get_template_directory_uri();?>/secondary_locations/" + $filename_nospaces + ".txt";
	if ($thefile.indexOf("/.txt") == -1) {
		$("#location_level2").load($thefile);
		$('#location_level2_drop_down').show();
	} else {
		$('#location_level2_drop_down').hide();
	}

	});
});
</script>

<?php } ?>	


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
remember( '[name=location_level1], [name=location_level2], [name=beds],[name=baths], [name=rentbuy], [name=propertytype2], [name=resultsorder], [name=mls], [name=size], [name=lotsize], [name=openhouse], [name=garage], [name=resorcomm], [name=yearbuilt] ' );

remember( '[name=minprice_buy], [name=maxprice_buy]' );
remember( '[name=minprice_rent], [name=maxprice_rent]' );

</script>