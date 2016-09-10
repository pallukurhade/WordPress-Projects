<?php
if (get_option('wp_site') == "Car Sales") {
	
	$manufacturer_level1 = get_post_meta($post->ID, "manufacturer_level1_value", true);
	$manufacturer_level2 = get_post_meta($post->ID, "manufacturer_level2_value", true);
	$name = get_post_meta($post->ID, "name_value", true);
	$accesscode = get_post_meta($post->ID, "accesscode_value", true);
	$vin = get_post_meta($post->ID, "vin_value", true);
	$reporttype = get_post_meta($post->ID, "reporttype_value", true);
	$body_type = get_post_meta($post->ID, "body_type_value", true);
	$body_type2 = get_post_meta($post->ID, "body_type2_value", true);
	$body_type3 = get_post_meta($post->ID, "body_type3_value", true);
	$enginesize = get_post_meta($post->ID, "enginesize_value", true);
	$trans = get_post_meta($post->ID, "trans_value", true);
	$regno = get_post_meta($post->ID, "regno_value", true);
	$servicehistory = get_post_meta($post->ID, "servicehistory_value", true);
	$servicehistorydetails = get_post_meta($post->ID, "servicehistorydetails_value", true);
	$regdate = get_post_meta($post->ID, "regdate_value", true);
	$mileage = get_post_meta($post->ID, "mileage_value", true);
	$year = get_post_meta($post->ID, "year_value", true);
	$owners = get_post_meta($post->ID, "owners_value", true);
	$fueltype = get_post_meta($post->ID, "fueltype_value", true);
	$insgroup = get_post_meta($post->ID, "insgroup_value", true);
	$intcolor = get_post_meta($post->ID, "intcolor_value", true);
	$extcolor = get_post_meta($post->ID, "extcolor_value", true);
	$dealerlocations = get_post_meta($post->ID, "dealerlocations_value", true);
	$vat = get_post_meta($post->ID, "vat_value", true);
	
	
	$salesreptitle = get_post_meta($post->ID, "title_value", true);
	$salesrepemail = get_post_meta($post->ID, "email_value", true);
	$salesrepphoneoffice = get_post_meta($post->ID, "phoneoffice_value", true);
	$salesrepphonemobile = get_post_meta($post->ID, "phonemobile_value", true);
	$salesrepfax = get_post_meta($post->ID, "fax_value", true);
	$salesreporder = get_post_meta($post->ID, "salesreporder_value", true);
}

if (get_option('wp_site') == "Real Estate") {
	$vin = "";
	$location_level1 = get_post_meta($post->ID, "location_level1_value", true);
	$location_level2 = get_post_meta($post->ID, "location_level2_value", true);
	$address = get_post_meta($post->ID, "address_value", true);
	$citystatezip = get_post_meta($post->ID, "citystatezip_value", true);
	$mls = get_post_meta($post->ID, "mls_value", true);
	$mlslisting = get_post_meta($post->ID, "mlslisting_value", true);
	$cr = get_post_meta($post->ID, "cr_value", true);
	$agent = get_post_meta($post->ID, "agent_value", true);
	$agent2 = get_post_meta($post->ID, "agent2_value", true);
	$bor = get_post_meta($post->ID, "rob_value", true);
	$openhousedate = get_post_meta($post->ID, "openhousedate_value", true);
	$openhousetime = get_post_meta($post->ID, "openhousetime_value", true);
	$propertytype = get_post_meta($post->ID, "propertytype_value", true);
	$propertytype2 = get_post_meta($post->ID, "propertytype2_value", true);
	$beds = get_post_meta($post->ID, "beds_value", true);
	$baths = get_post_meta($post->ID, "baths_value", true);
	$size = get_post_meta($post->ID, "size_value", true);
	$lotsize = get_post_meta($post->ID, "lotsize_value", true);
	$garage = get_post_meta($post->ID, "garage_value", true);
	$rob = get_post_meta($post->ID, "rob_value", true);
	$date = get_post_meta($post->ID, "date_value", true);
	$rooms = get_post_meta($post->ID, "rooms_value", true);
	$basement = get_post_meta($post->ID, "basement_value", true);
	$attic = get_post_meta($post->ID, "attic_value", true);
	$deckpatio = get_post_meta($post->ID, "deckpatio_value", true);
	$year = get_post_meta($post->ID, "year_value", true);
	$school = get_post_meta($post->ID, "school_value", true);
	$map = get_post_meta($post->ID, "google_location_value", true);
	$streetview = get_post_meta($post->ID, "streetview_value", true);
	
	$agenttitle = get_post_meta($post->ID, "title_value", true);
	$agentemail = get_post_meta($post->ID, "email_value", true);
	$agentphoneoffice = get_post_meta($post->ID, "phoneoffice_value", true);
	$agentphonemobile = get_post_meta($post->ID, "phonemobile_value", true);
	$agentfax = get_post_meta($post->ID, "fax_value", true);
	$agentcontactform = get_post_meta($post->ID, "contactformshortcode_value", true);
	$agentorder = get_post_meta($post->ID, "agentorder_value", true);
}
	
	$price = number_format((float)get_post_meta($post->ID, "price_value", true), 0, '.', get_option('wp_thousandseparator'));
	$pricecustom = get_post_meta($post->ID, "pricecustom_value", true);
	$reducedby = number_format((float)get_post_meta($post->ID, "reducedby_value", true), 0, '.', get_option('wp_thousandseparator'));
	$slideshow_url = get_post_meta($post->ID, "slideshow_url_value", true);
	$banner = get_post_meta($post->ID, "banner_value", true);
	$banner2 = get_post_meta($post->ID, "banner2_value", true);
	$slideshowtitle = get_post_meta($post->ID, "slideshowtitle_value", true);
	$slideshowimage = get_post_meta($post->ID, "slideshowimage_value", true);
	$currencysymbol = get_option('wp_currency');


/* Get search page ID from the name */
$wp_searchpageid = $wpdb->get_var("
	SELECT `ID`
	FROM $wpdb->posts "."
	WHERE post_title='". get_option('wp_searchresultspage') ."' 
	AND post_type='page' 
	LIMIT 1");
	
if (get_option('wp_searchresultsid')) {
	$wp_searchpageid = get_option('wp_searchresultsid');
}

	
/* Get compare page ID from the name */
$wp_comparepageid = $wpdb->get_var("
	SELECT `ID`
	FROM $wpdb->posts "."
	WHERE post_title='". get_option('wp_comparepage') ."' 
	AND post_type='page' 
	LIMIT 1");
	
if (get_option('wp_compareid')) {
	$wp_comparepageid = get_option('wp_compareid');
}
?>




