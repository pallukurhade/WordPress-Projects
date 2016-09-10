<?php  
$checkalllistings = $_GET['alllistings'];
if ($checkalllistings) { ?>
	<script>
	$.cookie('manufacturer_level1', '', { path: '/', expires: 365 });
	$.cookie('manufacturer_level2', '', { path: '/', expires: 365 });
	$.cookie('minprice2', '', { path: '/', expires: 365 });
	$.cookie('maxprice2', '', { path: '/', expires: 365 });
	$.cookie('enginesize2', '', { path: '/', expires: 365 });
	$.cookie('trans2', '', { path: '/', expires: 365 });
	$.cookie('year2', '', { path: '/', expires: 365 });
	$.cookie('mileage2', '', { path: '/', expires: 365 });
	$.cookie('body_type2', '', { path: '/', expires: 365 });
	
	$.cookie('fueltype2', '', { path: '/', expires: 365 });
	$.cookie('location2', '', { path: '/', expires: 365 });
	</script>
<?php } ?>



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


<script type="text/javascript">
$(document).ready(function() {

$('#manufacturer_level1').change(function() {
		$.cookie('manufacturer_level2', '', { path: '/', expires: 365 });
});


$('#pricemin select').change(function() {
	if ($('#pricemin select').val() == '0') {
		$.cookie('minprice2', '', { path: '/', expires: 365 });
	}
});

$('#pricemax select').change(function() {
	if ($('#pricemax select').val() == '99999999999999') {
		$.cookie('maxprice2', '', { path: '/', expires: 365 });
	}
});

$('#enginesize select').change(function() {
	if ($('#enginesize select').val() == '') {
		$.cookie('enginesize2', '', { path: '/', expires: 365 });
	}
});

$('#trans select').change(function() {
	if ($('#trans select').val() == '') {
		$.cookie('trans2', '', { path: '/', expires: 365 });
	}
});

$('#year select').change(function() {
	if ($('#year select').val() == '') {
		$.cookie('year2', '', { path: '/', expires: 365 });
	}
});

$('#mileage select').change(function() {
	if ($('#mileage select').val() == '') {
		$.cookie('mileage2', '', { path: '/', expires: 365 });
	}
});

$('#bodytype select').change(function() {
	if ($('#bodytype select').val() == '') {
		$.cookie('body_type2', '', { path: '/', expires: 365 });
	}
});

$('#fueltype select').change(function() {
	if ($('#fueltype select').val() == '') {
		$.cookie('fueltype2', '', { path: '/', expires: 365 });
	}
});

$('#location select').change(function() {
	if ($('#location select').val() == '') {
		$.cookie('location2', '', { path: '/', expires: 365 });
	}
});


$('#search button').click(function() {
	if ($('#manufacturer_level2').val() == '') {
		$.cookie('manufacturer_level2', '', { path: '/', expires: 365 });
	}
});


});
</script>

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



$bodytype = get_option('wp_bodytype');
$arr_bodytype = explode("\n", $bodytype);
$langcode = "";
if (function_exists('qtrans_getLanguage')) {
	$langcode = qtrans_getLanguage();
}
//detect language of first line. That will make assumption of default language
$defaultlangarray = explode(":", $arr_bodytype[0]);
	if (count($defaultlangarray) != 2) {
		$singlelanguage = true;
	} else {
		$singlelanguage = false;
	}
	$bodytypeoptions = "";
	if ($singlelanguage == false) {
		$defaultlang = $defaultlangarray[1];
		//make array of all in dropdown from this language
		$arr = "";
		foreach ($arr_bodytype as $bt) {
			if(strpos($bt, ":".$defaultlang)) {
					$bt = explode(":", $bt);
					$bt = $bt[0];
					$arr = $arr . $bt . "|";
			}
		}
		$defaultlangtext = explode("|", $arr);
		$count = 0;

		foreach ($arr_bodytype as $bt) {
			if(strpos($bt, ":".$langcode)) {
				$bt = explode(":", $bt);
				$bt = $bt[0];
			$bodytypeoptions = $bodytypeoptions . "<option value='" .$defaultlangtext[$count] . "'>" . $bt . "</option>";
			$count = $count + 1;
			}
		}

} else {
		foreach ($arr_bodytype as $bt) {
			$bodytypeoptions = $bodytypeoptions . "<option value='" . $bt . "'>" . $bt . "</option>";
			}
}


$transmission = get_option('wp_transmission');
$arr_transmission = explode("\n", $transmission);
$langcode = "";
if (function_exists('qtrans_getLanguage')) {
	$langcode = qtrans_getLanguage();
}
//detect language of first line. That will make assumption of default language
$defaultlangarray = explode(":", $arr_transmission[0]);
	if (count($defaultlangarray) != 2) {
		$singlelanguage = true;
	} else {
		$singlelanguage = false;
	}
	
	$transmissionoptions = "";
	if ($singlelanguage == false) {
		$defaultlang = $defaultlangarray[1];
		//make array of all in dropdown from this language
		$arrtrans = "";
		foreach ($arr_transmission as $tr) {
			if(strpos($tr, ":".$defaultlang)) {
					$tr = explode(":", $tr);
					$tr = $tr[0];
					$arrtrans = $arrtrans . $tr . "|";
			}
		}
		$defaultlangtext = explode("|", $arrtrans);
		$count = 0;

		foreach ($arr_transmission as $tr) {
			if(strpos($tr, ":".$langcode)) {
				$tr = explode(":", $tr);
				$tr = $tr[0];
			$transmissionoptions = $transmissionoptions . "<option value='" .$defaultlangtext[$count] . "'>" . $tr . "</option>";
			$count = $count + 1;
			}
		}

} else {
		foreach ($arr_transmission as $tr) {
			$transmissionoptions = $transmissionoptions . "<option value='" . $tr . "'>" . $tr . "</option>";
			}
}



	
$fueltype = get_option('wp_fueltypes');
$arr_fueltype = explode("\n", $fueltype);
$langcode = "";
if (function_exists('qtrans_getLanguage')) {
	$langcode = qtrans_getLanguage();
}
//detect language of first line. That will make assumption of default language
$defaultlangarray = explode(":", $arr_fueltype[0]);
	if (count($defaultlangarray) != 2) {
		$singlelanguage = true;
	} else {
		$singlelanguage = false;
	}
	$fueltypeoptions = "";

	if ($singlelanguage == false) {
		$defaultlang = $defaultlangarray[1];
		//make array of all in dropdown from this language
		$arrfuel = "";
		foreach ($arr_fueltype as $ft) {
			if(strpos($ft, ":".$defaultlang)) {
					$ft = explode(":", $ft);
					$ft = $ft[0];
					$arrfuel = $arrfuel . $ft . "|";
			}
		}
		$defaultlangtext = explode("|", $arrfuel);
		$count = 0;

		foreach ($arr_fueltype as $ft) {
			if(strpos($ft, ":".$langcode)) {
				$ft = explode(":", $ft);
				$ft = $ft[0];
			$fueltypeoptions = $fueltypeoptions . "<option value='" .$defaultlangtext[$count] . "'>" . $ft . "</option>";
			$count = $count + 1;
			}
		}

} else {
		foreach ($arr_fueltype as $ft) {
		
			$fueltypeoptions = $fueltypeoptions . "<option value='" . $ft . "'>" . $ft . "</option>";
			}
}


$priceoptions = "";	
$prices = get_option('wp_price');
$arr_prices = explode("\n", $prices);
foreach ($arr_prices as $price) {
	$priceoptions = $priceoptions . "<option value='" . $price . "'>" . $before . number_format((float)$price, 0, '.', get_option('wp_thousandseparator')) . $after . "</option>";
}


$enginesizeoptions = "";
$enginesizes = get_option('wp_enginesizes');
$arr_enginesizes = explode("\n", $enginesizes);
foreach ($arr_enginesizes as $enginesize) {
	$enginesizeoptions = $enginesizeoptions . "<option value='" . $enginesize . "'>" . $enginesize . get_option('wp_enginesizesuffix_text'). "+</option>";
}

$mileageoptions = "";
$mileagelevels = get_option('wp_mileagelevels');
$arr_mileagelevels = explode("\n", $mileagelevels);
foreach ($arr_mileagelevels as $mileage) {
	$mileageoptions = $mileageoptions . "<option value='" . $mileage . "'>" . number_format((float)$mileage) . "+</option>";
}

$yearoptions = "";
$yearlevels = get_option('wp_yearlevels');
$arr_yearlevels = explode("\n", $yearlevels);
foreach ($arr_yearlevels as $year) {
	$yearoptions = $yearoptions . "<option value='" . $year . "'>" . $year . "+</option>";
}

$locationoptions = "";
$locations = get_option('wp_dealerlocations');
$arr_locations = explode("\n", $locations);
foreach ($arr_locations as $loc) {
	$locationoptions = $locationoptions . "<option value='" . $loc . "'>" . $loc . "</option>";
}
?>


<?php
$searchpage = get_post($wp_searchpageid);
$slugname = $searchpage -> post_name;
?>

<?php 
$langcode = "";
if (function_exists('qtrans_getLanguage')) {
	$langcode = qtrans_getLanguage();
	$appendlang = "/?lang=" . $langcode;
} else {
	$appendlang = "";
}
?>


<?php
if (get_option('wp_searchresultspagefix') == "Yes") { 
	$fix = "index.php/";
	} elseif (get_option('wp_searchresultspagefix') == "No") {
	$fix = "";
	$searchurl = home_url() . "/" . $fix . $slugname . "/?lang=".$langcode;
} ?>

<form id="searchform" action="<?php echo $searchurl; ?>" method="post">

<?php if (get_option('wp_search_manufacturer') == "Yes") { ?>
	<div id="manufacturer">	
			<label><?php echo get_option('wp_manufacturer_text')  ?>:</label>
			<?php 
			$manufactureroptions = "";			
			$manufacturer = get_option('wp_manufacturer_level1');
			$arr_manufacturer = explode("\n", $manufacturer);
			foreach ($arr_manufacturer as $item) {
			$item = trim($item);
				$countmanufacturers = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.post_status = 'publish' AND p.ID = p1.post_id AND p1.meta_key = 'manufacturer_level1_value' AND p1.meta_value = '$item'");	
					if ($countmanufacturers > 0) {
						if (get_option('wp_filtersold') == 'Yes') {	
							$manufactureroptions = $manufactureroptions . "<option value='" . $item . "'>" . $item . " </option>";
						} else {
							$manufactureroptions = $manufactureroptions . "<option value='" . $item . "'>" . $item . " (" . $countmanufacturers . ")</option>";
						}
					}
			}		
			?>
			
			

			<select id='manufacturer_level1' name='manufacturer_level1'>
				<option value="" selected='selected'><?php echo get_option('wp_any_text'); ?></option>
				<?php echo $manufactureroptions; ?>
			</select>
			
			<?php if(get_option("wp_secondary_manufacturer") == 'Enable') { ?>
				 <label><?php echo get_option('wp_Heading_Manufacturer_Level2') ?></label>
				 <div id="manufacturer_level2_drop_down">
				 <select id="manufacturer_level2" name="manufacturer_level2">
				 </select>
				 </div>
			<?php } ?>
	</div><!-- end manufacturer -->
<?php } ?>				


<?php if (get_option('wp_search_price') == "Yes") { ?>
			<div id="pricemin">
				<label><?php echo get_option('wp_minimumprice_text')  ?>:</label>
            
				<select name="minprice2">
					<option value="0"><?php echo get_option('wp_nomin_text'); ?></option>
                    <?php echo $priceoptions; ?>
				</select>
			</div><!-- end pricemin -->


			
			<!-- Maximum price dropdown menu -->
			<div id="pricemax">

				<label><?php echo get_option('wp_maximumprice_text')  ?>:</label>
				<select name="maxprice2">
				<option value="99999999999999"><?php echo get_option('wp_nomax_text'); ?></option>
				<?php echo $priceoptions; ?>
				</select>
			</div><!-- end pricemax -->
<?php } ?>


<?php if (get_option('wp_search_bodytype') == "Yes") { ?>
	<div id="bodytype">
			<label><?php echo get_option('wp_bodytype_text') ?>:</label>
			<select id='body_type' name='body_type2'>
				<option value=""><?php echo get_option('wp_any_text'); ?></option>
				<?php echo $bodytypeoptions; ?>
			</select>
	</div><!-- end bodytype -->
<?php } ?>

			

			
<?php if (get_option('wp_search_enginesize') == "Yes") { ?>
<div id="enginesize">

				<label><?php echo get_option('wp_enginesize_text')  ?>:</label>
				
            	<select name="enginesize2">
				<option value=""><?php echo get_option('wp_any_text'); ?></option>
                <?php echo $enginesizeoptions; ?>
                </select>
				</div><!-- end enginesize -->
<?php } ?>
			

<?php if (get_option('wp_search_transmission') == "Yes") { ?>
			<div id="trans">
            <label><?php echo get_option('wp_trans_text')  ?>:</label>
			    <select name="trans2">
					<option value=""><?php echo get_option('wp_any_text'); ?></option>
					<?php echo $transmissionoptions ?>
				</select>
				</div><!-- end trans -->
<?php } ?>


<?php if (get_option('wp_search_modelyear') == "Yes") { ?>
			<div id="year">        

				<label><?php echo get_option('wp_year_text')  ?>:</label>
			    <select name="year2">
				<option value=""><?php echo get_option('wp_any_text'); ?></option>
				<?php echo $yearoptions; ?>
				</select>
				</div><!-- end year -->
<?php } ?>


<?php if (get_option('wp_search_mileage') == "Yes") { ?>
			<div id="mileage">
				<label><?php echo get_option('wp_mileage_text')  ?>:</label>

			    <select name="mileage2">
					<option value=""><?php echo get_option('wp_any_text'); ?></option>
                    <?php echo $mileageoptions; ?>
				</select>
				</div><!-- end mileage -->
<?php } ?>


<?php if (get_option('wp_search_fueltype') == "Yes") { ?>
			<div id="fueltype">
            <label><?php echo get_option('wp_fueltype_text')  ?>:</label>
			    <select name="fueltype2">
					<option value=""><?php echo get_option('wp_any_text'); ?></option>
					<?php echo $fueltypeoptions ?>
				</select>
			</div><!-- end fueltype -->
<?php } ?>

<?php if (get_option('wp_search_dealerlocation') == "Yes") { ?>
			<div id="location">
            <label><?php echo get_option('wp_dealerlocation_text')  ?>:</label>
			    <select name="location2">
					<option value=""><?php echo get_option('wp_any_text'); ?></option>
					<?php echo $locationoptions ?>
				</select>
			</div><!-- end location -->
<?php } ?>

<div><button class="btn btn-large btn-block btn-darkgray"><?php echo get_option('wp_searchbutton_text') ?></button></div>



<?php if(get_option('wp_demo') == 'on') { ?>
<p class="demo">Demo Note: All search dropdowns can be included or excluded in Theme Options.<br />
Search dropdowns not included here: Transmission, Engine Size, Fuel type, and Dealer location.</p>
<?php } ?>
</form>

<div class="clear"></div>
				

<?php if(get_option("wp_secondary_manufacturer") == "Enable") { ?>
<script type="text/javascript">
$(document).ready(function() {
	
	if ($('#manufacturer_level1').val() != "") {
	
		$filename_nospaces = $('#manufacturer_level1').val();
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
		$thefile = "<?php echo get_template_directory_uri();?>/models/" + $filename_nospaces + ".txt";
		$("#manufacturer_level2").load($thefile);
		$('#manufacturer_level2_drop_down').show();
	}


$("#manufacturer_level1").change(function() {
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
	$thefile = "<?php echo get_template_directory_uri();?>/models/" + $filename_nospaces + ".txt";
	if ($thefile.indexOf("/.txt") == -1) {
		$("#manufacturer_level2").load($thefile);
		$('#manufacturer_level2_drop_down').show();
	} else {
		$('#manufacturer_level2_drop_down').hide();
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
remember( '[name=manufacturer_level1], [name=enginesize2],[name=trans2], [name=minprice2], [name=maxprice2], [name=body_type2], [name=year2], [name=mileage2], [name=fueltype2], [name=location2] ' );		
</script>




