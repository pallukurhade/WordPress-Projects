<?php
if (get_option('wp_site') == "Real Estate") {

	$search_location_level1 = "";
	if (isset($_COOKIE['location_level1']) && $_COOKIE['location_level1'] != '') {
	$search_location_level1 = $_COOKIE['location_level1'];
	} else {
		if (isset($_POST['location_level1'])) {
			$search_location_level1 = trim($_POST['location_level1']);
		}
	}

	$search_location_level2 = "";
	if (isset($_COOKIE['location_level2']) && $_COOKIE['location_level2'] != '') {
	$search_location_level2 = $_COOKIE['location_level2'];
	} else {
		if (isset($_POST['location_level2'])) {
			$search_location_level2 = trim($_POST['location_level2']);
		}
	}

	
	$search_bedrooms = "";
	if (isset($_COOKIE['beds']) && $_COOKIE['beds'] != '') {
	$search_bedrooms = $_COOKIE['beds'];
	} else {
		if (isset($_POST['beds'])) {
			$search_bedrooms = trim($_POST['beds']);
		}
	}

	
	$search_bathrooms = "";
	if (isset($_COOKIE['baths']) && $_COOKIE['baths'] != '') {
	$search_bathrooms = $_COOKIE['baths'];
	} else {
		if (isset($_POST['baths'])) {
			$search_bathrooms = trim($_POST['baths']);
		}
	}

	if (isset($_COOKIE['minprice_buy']) && $_COOKIE['minprice_buy'] != '') {
	$search_pricemin_buy = $_COOKIE['minprice_buy'];
	} else {
	$search_pricemin_buy = '0';
	}

	if (isset($_COOKIE['maxprice_buy']) && $_COOKIE['maxprice_buy'] != '') {
	$search_pricemax_buy = $_COOKIE['maxprice_buy'];
	} else {
	$search_pricemax_buy = '99999999999999';
	}


	if (isset($_COOKIE['minprice_rent']) && $_COOKIE['minprice_rent'] != '') {
	$search_pricemin_rent = $_COOKIE['minprice_rent'];
	} else {
	$search_pricemin_rent = '0';
	}

	if (isset($_COOKIE['maxprice_rent']) && $_COOKIE['maxprice_rent'] != '') {
	$search_pricemax_rent = $_COOKIE['maxprice_rent'];
	} else {
	$search_pricemax_rent = '99999999999999';
	}

	$search_propertytype = "";
	if (isset($_COOKIE['propertytype2']) && $_COOKIE['propertytype2'] != '') {
	$search_propertytype = $_COOKIE['propertytype2'];
	} else {
		if (isset($_POST['propertytype2'])) {
			$search_propertytype = trim($_POST['propertytype2']);
		}
	}

	
	$search_buyorrent = "";
	if (get_option('wp_search_bor') == "Yes") {
		if (isset($_COOKIE['rentbuy']) && $_COOKIE['rentbuy'] != '') {
		$search_buyorrent = $_COOKIE['rentbuy'];
		} else {
			if (isset($_POST['rentbuy'])) {
				$search_buyorrent = trim($_POST['rentbuy']);
			}
		}
	} else {
		$search_buyorrent = '';
	}
	
	
	$search_resorcomm = "";
	if (isset($_COOKIE['resorcomm']) && $_COOKIE['resorcomm'] != '') {
		$search_resorcomm = $_COOKIE['resorcomm'];
		} else {
		if (isset($_POST['resorcomm'])) {
			$search_resorcomm = trim($_POST['resorcomm']);
		}
	}

	
	$search_openhouse = "";
	if (isset($_COOKIE['openhouse']) && $_COOKIE['openhouse'] != '') {
		$search_openhouse = $_COOKIE['openhouse'];
		} else {
		if (isset($_POST['openhouse'])) {
			$search_openhouse = trim($_POST['openhouse']);
		}
	}

	$search_yearbuilt = "";
	if (isset($_COOKIE['yearbuilt']) && $_COOKIE['yearbuilt'] != '') {
		$search_yearbuilt = $_COOKIE['yearbuilt'];
		} else {
		if (isset($_POST['yearbuilt'])) {
			$search_yearbuilt = trim($_POST['yearbuilt']);
		}
	}

	$search_size = "";
	if (isset($_COOKIE['size']) && $_COOKIE['size'] != '') {
		$search_size = $_COOKIE['size'];
		} else {
		if (isset($_POST['size'])) {
			$search_size = trim($_POST['size']);
		}
	}

	$search_lotsize = "";
	if (isset($_COOKIE['lotsize']) && $_COOKIE['lotsize'] != '') {
		$search_lotsize = $_COOKIE['lotsize'];
		} else {
		if (isset($_POST['lotsize'])) {
			$search_lotsize = trim($_POST['lotsize']);
		}
	}

	$search_garage = "";
	if (isset($_COOKIE['garage']) && $_COOKIE['garage'] != '') {
		$search_garage = $_COOKIE['garage'];
		} else {
		if (isset($_POST['garage'])) {
			$search_garage = trim($_POST['garage']);
		}
	}

	$search_mls = "";
	if (isset($_COOKIE['mls']) && $_COOKIE['mls'] != '') {
		$search_mls = $_COOKIE['mls'];
		} else {
		if (isset($_POST['mls'])) {
			$search_mls = trim($_POST['mls']);
		}
	}
}


if (get_option('wp_site') == "Car Sales") {
	$search_manufacturer_level1 = "";
	if (isset($_COOKIE['manufacturer_level1']) && $_COOKIE['manufacturer_level1'] != '') {
	$search_manufacturer_level1 = $_COOKIE['manufacturer_level1'];
	} else {
		if (isset($_POST['manufacturer_level1'])) {
			$search_manufacturer_level1 = trim($_POST['manufacturer_level1']);
		}
	}

	$search_manufacturer_level2 = "";
	if (isset($_COOKIE['manufacturer_level2']) && $_COOKIE['manufacturer_level2'] != '') {
	$search_manufacturer_level2 = $_COOKIE['manufacturer_level2'];
	} else {
		if (isset($_POST['manufacturer_level2'])) {
			$search_manufacturer_level2 = trim($_POST['manufacturer_level2']);
		}
	}

	$search_pricemin = "";
	if (isset($_COOKIE['minprice2']) && $_COOKIE['minprice2'] != '') {
	$search_pricemin = $_COOKIE['minprice2'];
	} else {
	$search_pricemin = '0';
	}

	$search_pricemax = "";
	if (isset($_COOKIE['maxprice2']) && $_COOKIE['maxprice2'] != '') {
	$search_pricemax = $_COOKIE['maxprice2'];
	} else {
	$search_pricemax = '99999999999999';
	}

	$search_enginesize = "";
	if (isset($_COOKIE['enginesize2']) && $_COOKIE['enginesize2'] != '') {
		$search_enginesize = $_COOKIE['enginesize2'];
	} else {
			if (isset($_POST['enginesize2'])) {
				$search_enginesize = trim($_POST['enginesize2']);
			}
	}

	$search_trans = "";
	if (isset($_COOKIE['trans2']) && $_COOKIE['trans2'] != '') {
		$search_trans = $_COOKIE['trans2'];
	} else {
		if (isset($_POST['trans2'])) {
			$search_trans = trim($_POST['trans2']);
		}
	}

	$search_bodytype = "";
	if (isset($_COOKIE['body_type2']) && $_COOKIE['body_type2'] != '') {
		$search_bodytype = $_COOKIE['body_type2'];
	} else {
			if (isset($_POST['body_type2'])) {
				$search_bodytype = trim($_POST['body_type2']);
			}
	}
	
    $search_fueltype = "";
	if (isset($_COOKIE['fueltype2']) && $_COOKIE['fueltype2'] != '') {
		$search_fueltype = $_COOKIE['fueltype2'];
	} else {
			if (isset($_POST['fueltype2'])) {
				$search_fueltype = trim($_POST['fueltype2']);
			}
	}

	
	$search_mileage = "";
	if (isset($_COOKIE['mileage2']) && $_COOKIE['mileage2'] != '') {
		$search_mileage = $_COOKIE['mileage2'];
	} else {
		if (isset($_POST['mileage2'])) {
			$search_mileage = trim($_POST['mileage2']);
		}
	}

	$search_year = "";
	if (isset($_COOKIE['year2']) && $_COOKIE['year2'] != '') {
		$search_year = $_COOKIE['year2'];
	} else {
		if (isset($_POST['year2'])) {
			$search_year = trim($_POST['year2']);
		}
	}
	
	$search_location = "";
	if (isset($_COOKIE['location2']) && $_COOKIE['location2'] != '') {
		$search_location = $_COOKIE['location2'];
	} else {
		if (isset($_POST['location2'])) {
			$search_location = trim($_POST['location2']);
		}
	}	
	
}
$checkalllistings = "";
if (isset($_GET['alllistings'])) {
	$checkalllistings = $_GET['alllistings'];
}
if ($checkalllistings == true) { 
	//houses
	$search_location_level1 = '';
	$search_location_level2 = '';
	$search_bedrooms = '';
	$search_bathrooms = '';
	$search_pricemin_buy = '0';
	$search_pricemax_buy = '99999999999999';
	$search_pricemin_rent = '0';
	$search_pricemax_rent = '99999999999999';
	$search_propertytype = '';
	$search_buyorrent = '';
	$search_resorcomm = '';
	$search_openhouse = '';
	$search_yearbuilt = '';
	$search_size = '';
	$search_lotsize = '';
	$search_garage = '';
	$search_mls = '';

	//cars
	$search_manufacturer_level1 = '';
	$search_manufacturer_level2 = '';
	$search_pricemin = '0';
	$search_pricemax = '99999999999999';
	$search_year = '';
	$search_mileage = '';
	$search_bodytype = '';
	$search_trans = '';
	$search_enginesize = '';
	$search_trans = '';
	$search_fueltype = '';
	$search_location = '';
}
?>


<?php
$_ids = array();
function getIds( $query ) {
    global $wpdb;
    $searchresults = $wpdb->get_results($query, ARRAY_A);
    if ( !empty ($searchresults) ) {
        foreach( $searchresults as $_post ) {
            $tmp[] = $_post['ID'];
        }
    }
    return $tmp;
}

global $wpdb;

$query ="SELECT p.* FROM $wpdb->posts p WHERE p.post_type = 'listing' AND p.post_status = 'publish'";
		$all = getIds( $query );
		$_ids = ( !empty($all) ? ( !empty($_ids) ? array_intersect( $_ids, $all) : $all ) : "" );

if (get_option('wp_filtersold') == 'Yes') {
	$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
			WHERE p.ID = p1.post_id AND p1.meta_key='sold_value' AND p1.meta_value = 'No'";	
	$sbr = getIds( $query );
	$_ids = ( !empty($sbr) ? ( !empty($_ids) ? array_intersect( $_ids, $sbr) : "" ) : "" );
}
	
		
		
		
// **************************************************************		
// HOUSES		
// **************************************************************			
		
if (get_option('wp_site') == "Real Estate") {

		if (get_option('wp_search_bor') == "Yes") {	

			if ($search_buyorrent != "") {
					$query = "SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
							WHERE p.ID = p1.post_id AND p1.meta_key = 'rob_value' AND p1.meta_value = '$search_buyorrent'";
					$spm = getIds( $query );
					$_ids = ( !empty($spm) ? ( !empty($_ids) ? array_intersect( $_ids, $spm) : "" ) : "" );
			}
		}


		if ($search_buyorrent == "buy" || $search_buyorrent == "") {
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='price_value' AND convert(p1.meta_value, signed) BETWEEN '$search_pricemin_buy' AND '$search_pricemax_buy'";
				$spm = getIds( $query );
				$_ids = ( !empty($spm) ? ( !empty($_ids) ? array_intersect( $_ids, $spm) : "" ) : "" );
		}


		if ($search_buyorrent == "rent") {
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='price_value' AND convert(p1.meta_value, signed) BETWEEN '$search_pricemin_rent' AND '$search_pricemax_rent'";
				$spm = getIds( $query );
				$_ids = ( !empty($spm) ? ( !empty($_ids) ? array_intersect( $_ids, $spm) : "" ) : "" );
		}

		
		if (get_option('wp_search_location') == "Yes") {	
			if($search_location_level1 != '')
			{
			$search_location_level1 = trim($search_location_level1);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key = 'location_level1_value' AND p1.meta_value = '$search_location_level1'";
				$sll1 = getIds( $query );
				$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );
			} 
			
			if($search_location_level2 != '')
			{
			$search_location_level2 = trim($search_location_level2);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='location_level2_value' AND trim(p1.meta_value)='$search_location_level2'";
				$sll2 = getIds( $query );
				$_ids = ( !empty($sll2) ? ( !empty($_ids) ? array_intersect( $_ids, $sll2) : "" ) : "" );
			}
		}
		
		

		if (get_option('wp_search_beds') == "Yes") {	
			if($search_bedrooms != '')
			{
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='beds_value' AND p1.meta_value >= '$search_bedrooms'";	
				$sbr = getIds( $query );
				$_ids = ( !empty($sbr) ? ( !empty($_ids) ? array_intersect( $_ids, $sbr) : "" ) : "" );
			} 
		}

		
		if (get_option('wp_search_baths') == "Yes") {	
			if($search_bathrooms != '')
			{
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='baths_value' AND p1.meta_value >='$search_bathrooms'";	
				$sbt = getIds( $query );
				$_ids = ( !empty($sbt) ? ( !empty($_ids) ? array_intersect( $_ids, $sbt) : "" ) : "" );
			}
		}
		
		
		

		if (get_option('wp_search_propertytype') == "Yes") {	
			if($search_propertytype != '')
			{
			$search_propertytype = trim($search_propertytype);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND (p1.meta_key='propertytype_value' AND p1.meta_value='$search_propertytype' OR p1.meta_key='propertytype2_value' AND p1.meta_value='$search_propertytype')";
				$sptt = getIds( $query );
				$_ids = ( !empty($sptt) ? ( !empty($_ids) ? array_intersect( $_ids, $sptt) : "" ) : "" );
			}
		}

		if (get_option('wp_search_resorcomm') == "Yes") {	
			if($search_resorcomm != '')
			{
			$search_resorcomm = trim($search_resorcomm);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='cr_value' AND p1.meta_value='$search_resorcomm'";
				$sptt = getIds( $query );
				$_ids = ( !empty($sptt) ? ( !empty($_ids) ? array_intersect( $_ids, $sptt) : "" ) : "" );
			}
		}		
		

		if (get_option('wp_search_openhouse') == "Yes") {	
			if($search_openhouse == 'yes')
			{
				$today = strtotime(Date("m-d-Y"));
				
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='openhousedate_value' AND p1.meta_value >='$today'";
				$sbt = getIds( $query );
				$_ids = ( !empty($sbt) ? ( !empty($_ids) ? array_intersect( $_ids, $sbt) : "" ) : "" );
			}
		}




		if (get_option('wp_search_yearbuilt') == "Yes") {	
			if($search_yearbuilt != '')
			{
			$search_yearbuilt = trim($search_yearbuilt);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='year_value' AND p1.meta_value>='$search_yearbuilt'";
				$sptt = getIds( $query );
				$_ids = ( !empty($sptt) ? ( !empty($_ids) ? array_intersect( $_ids, $sptt) : "" ) : "" );
			}	
		}

		
		if (get_option('wp_search_size') == "Yes") {	
			if($search_size != '')
			{
			$search_size = trim($search_size);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='size_value' AND p1.meta_value>=$search_size";
				$sptt = getIds( $query );
				$_ids = ( !empty($sptt) ? ( !empty($_ids) ? array_intersect( $_ids, $sptt) : "" ) : "" );
			}
		}
		
		

		if (get_option('wp_search_lotsize') == "Yes") {	
			if($search_lotsize != '')
			{
			$search_lotsize = trim($search_lotsize);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='lotsize_value' AND p1.meta_value>=$search_lotsize";
				$sptt = getIds( $query );
				$_ids = ( !empty($sptt) ? ( !empty($_ids) ? array_intersect( $_ids, $sptt) : "" ) : "" );
			}	
		}

		if (get_option('wp_search_garagespaces') == "Yes") {	
			if($search_garage != '')
			{
			$search_garage = trim($search_garage);
			
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='garage_value' AND p1.meta_value>='$search_garage'";
				$sptt = getIds( $query );
				$_ids = ( !empty($sptt) ? ( !empty($_ids) ? array_intersect( $_ids, $sptt) : "" ) : "" );
			}	
		}

		if (get_option('wp_search_mls') == "Yes") {	
			if($search_mls != '')
			{
			$search_mls = trim($search_mls);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key='mls_value' AND p1.meta_value='$search_mls'";
				$sptt = getIds( $query );
				$_ids = ( !empty($sptt) ? ( !empty($_ids) ? array_intersect( $_ids, $sptt) : "" ) : "" );
			}	
		}
		
}	
		
		
		
		
		
		
// **************************************************************		
// CARS		
// **************************************************************		
		
if (get_option('wp_site') == "Car Sales") {

		if (get_option('wp_search_manufacturer') == "Yes") {	
			if($search_manufacturer_level1 != '')
			{
			$search_manufacturer_level1 = trim($search_manufacturer_level1);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key = 'manufacturer_level1_value' AND p1.meta_value = '$search_manufacturer_level1'";
				$sll1 = getIds( $query );
				$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );	
			}
		


			if($search_manufacturer_level2 != '')
			{
			$search_manufacturer_level2 = trim ($search_manufacturer_level2);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key = 'manufacturer_level2_value' AND p1.meta_value = '$search_manufacturer_level2'";
				$sll1 = getIds( $query );
				
				$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );
			}
		}

		
		if (get_option('wp_search_price') == "Yes") {	
			$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
					WHERE p.ID = p1.post_id AND p1.meta_key='price_value' AND convert(p1.meta_value, signed) BETWEEN '$search_pricemin' AND '$search_pricemax'";
			$sll1 = getIds( $query );	
			$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );
		}

		if (get_option('wp_search_enginesize') == "Yes") {	
			if($search_enginesize != '')
			{
			$search_enginesize = trim ($search_enginesize);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key = 'enginesize_value' AND p1.meta_value >= '$search_enginesize'";
				$sll1 = getIds( $query );
				
				$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );
			} 
		}		


		if (get_option('wp_search_transmission') == "Yes") {	
			if($search_trans != '')
			{
			$search_trans = trim($search_trans);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key = 'trans_value' AND p1.meta_value = '$search_trans'";
				$sll1 = getIds( $query );
				
				$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );
			} 
		}
		
		
		if (get_option('wp_search_modelyear') == "Yes") {	
			if($search_year != '')
			{
			$search_year = trim($search_year);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key = 'year_value' AND p1.meta_value >= '$search_year'";
				$sll1 = getIds( $query );
				
				$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );
			} 
		} 

		if (get_option('wp_search_bodytype') == "Yes") {			
			if($search_bodytype != '')
			{
			$search_bodytype = trim($search_bodytype);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND (p1.meta_key = 'body_type_value' AND p1.meta_value = '$search_bodytype' OR p1.meta_key = 'body_type2_value' AND p1.meta_value = '$search_bodytype' OR p1.meta_key = 'body_type3_value' AND p1.meta_value = '$search_bodytype')";
				$sll1 = getIds( $query );
				
				$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );
			} 
		} 
		
		
		
		
		if (get_option('wp_search_fueltype') == "Yes") {	
			if($search_fueltype != '')
			{
			$search_fueltype = trim($search_fueltype);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key = 'fueltype_value' AND p1.meta_value = '$search_fueltype'";
				$sll1 = getIds( $query );
				
				$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );
			} 
		} 
		


		if (get_option('wp_search_mileage') == "Yes") {	
			if($search_mileage != '')
			{
			$search_mileage = trim($search_mileage);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key = 'mileage_value' AND p1.meta_value >= $search_mileage";
				$sll1 = getIds( $query );
				
				$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );
			} 
		} 
		
		
		if (get_option('wp_search_dealerlocation') == "Yes") {	
			if($search_location != '')
			{
			$search_location = trim($search_location);
				$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
						WHERE p.ID = p1.post_id AND p1.meta_key = 'dealerlocations_value' AND p1.meta_value = '$search_location'";
				$sll1 = getIds( $query );
				
				$_ids = ( !empty($sll1) ? ( !empty($_ids) ? array_intersect( $_ids, $sll1) : "" ) : "" );
			} 
		} 
		
}
?>


<?php 

if (count($_ids) > 1) {
		$results = " (" . count($_ids) . ")"; 
		} else {
		$results = "";
		}
		
$alllistings = "";
if ($checkalllistings == true) { 
	$alllistings = true;
	
	?>
	<h2 class="bigheader" id="heading_searchresults">
		<?php echo get_option('wp_alllistings') . $results; ?>
	</h2>

<?php } else { ?>
		<h2 class="bigheader" id="heading_searchresults">
			<?php echo get_option('wp_searchresults') . $results; ?>
		</h2>
<?php } ?>




<?php
$resultsorder = "";
if (isset($_GET['orderdropdown'])) {
	$resultsorder = $_GET['orderdropdown'];
}

if ($resultsorder) {
	$resultsorder = $resultsorder;
} elseif(isset($_COOKIE['orderdropdown'])) {
	$resultsorder = $_COOKIE['orderdropdown'];
} else {
	$resultsorder = get_option('wp_searchorder');
}
$resultsorder = str_replace(" ", "", $resultsorder);

	switch ($resultsorder) {
		case "PriceDescending":
			$metakey = 'price_value';
			$order = 'DESC';
			$orderby = 'meta_value_num';
			break;
		case "PriceAscending":
			$metakey = 'price_value';
			$order = 'ASC';
			$orderby = 'meta_value_num';
			break;
		case "DateDescending":
			$metakey = '';
			$order = 'DESC';
			$orderby = 'date';
			break;
		case "DateAscending":
			$metakey = '';
			$order = 'ASC';
			$orderby = 'date';
			break;
		case "MileageDescending":
			$metakey = 'mileage_value';
			$order = 'DESC';
			$orderby = 'meta_value_num';
			break;
		case "MileageAscending":
			$metakey = 'mileage_value';
			$order = 'ASC';
			$orderby = 'meta_value_num';
			break;
		case "ModelYearDescending":
			$metakey = 'year_value';
			$order = 'DESC';
			$orderby = 'meta_value_num';
			break;
		case "ModelYearAscending":
			$metakey = 'year_value';
			$order = 'ASC';
			$orderby = 'meta_value_num';
			break;
	}

if (!empty($_ids) && !$alllistings) {

    $wpq = array ('post_type' => 'listing', 'meta_key' => $metakey, 'orderby' => $orderby, 'order' => $order, 'post__in' => $_ids,  'post_status' => 'publish', 'paged' => $paged, 'posts_per_page' => get_option('wp_searchresultsperpage'));
	
} elseif (empty($_ids) && !$alllistings) {

    $wpq = array ('post_type' =>'listing', 'meta_key' => $metakey, 'orderby' => $orderby, 'order' => $order, 'post__in' => array('0'),'post_status' => 'publish', 'paged' => $paged, 'posts_per_page' => get_option('wp_searchresultsperpage'));
	
} elseif ($alllistings) {
	if (get_option('wp_filtersold') == 'Yes') {
			$wpq = array ('post_type' =>'listing', 'paged' => $paged, 'meta_key' => $metakey, 'orderby' => $orderby, 'order' => $order, 'post_status' => 'publish', 'meta_query' => array( array('key' => 'sold_value', 'value' => 'No')), 'posts_per_page' => get_option('wp_searchresultsperpage'));
		} else {
			$wpq = array ('post_type' =>'listing', 'paged' => $paged, 'meta_key' => $metakey, 'orderby' => $orderby, 'order' => $order, 'post_status' => 'publish', 'posts_per_page' => get_option('wp_searchresultsperpage'));
		}
}

query_posts($wpq);


?>


<?php if (get_option('wp_site') == "Real Estate") { 
// not sure if the following code is necessary!
?>
	<?php 
	if ($search_location_level1 != "") { ?>
	<script type="text/javascript">
		$("#location_level2").load("<?php get_template_directory_uri();?>/secondary_locations/<?php echo $search_location_level1 ?>.txt");
	</script>
	<?php } ?>



	<?php 
	if ($search_buyorrent == "buy" || $search_buyorrent == "") { ?>
	<script type="text/javascript">
			$('#buyprices').show();
			$('#rentprices').hide();
	</script>
	<?php } else { ?>
	<script type="text/javascript">
			$('#buyprices').hide();
			$('#rentprices').show();
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

	<?php 
	if ($search_buyorrent == "buy" || $search_buyorrent == "") {  ?>

	remember( '[name=minprice_buy], [name=maxprice_buy]' );
	<?php } ?>

	<?php if ($search_buyorrent == "rent") { ?>
	remember( '[name=minprice_rent], [name=maxprice_rent]' );
	<?php } ?>
	</script>
<?php } ?>












