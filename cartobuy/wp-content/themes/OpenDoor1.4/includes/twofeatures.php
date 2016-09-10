<?php 

if ( get_stylesheet_directory() != get_template_directory() && 
file_exists(get_stylesheet_directory().'/includes/translatespecs.php') ) 
{
	include get_stylesheet_directory() . '/includes/translatespecs.php';
}
else {
	include get_template_directory() . '/includes/translatespecs.php';
}


switch (get_option('wp_firstfeature')) {
	case "Beds":
			echo $beds . " " . get_option('wp_bedrooms_text') . " | ";
			break;
	case "Baths":
			echo $baths . " " . get_option('wp_bathrooms_text') . " | ";
			break;
	case "Size":
			echo number_format((float)$size, 0, '.', get_option('wp_thousandseparator')) . " " . get_option('wp_sizesuffix_text') . " | ";
			break;
	case "Lot Size":
			echo number_format((float)$lotsize, 0, '.', get_option('wp_thousandseparator')) . " " . get_option('wp_sizesuffix2_text') . " | ";
			break;
	case "MLS":
			echo $mls . " | ";
			break;
	case "Garage Spaces":
			echo $garage . " " . get_option('wp_garage_text') . " | ";
			break;
	case "Year Built":
			echo get_option('wp_yearbuilt_text') . ": " . $year . " | ";
			break;
	case "Property Type":
		echo $pt;
		if ($propertytype2) {
			echo ", " . $pt2;
			}
		echo " | ";
		break;		
	case "Engine Size":
			echo $enginesize.get_option('wp_enginesizesuffix_text'). " | ";
			break;
	case "Transmission":
		echo $tr. " | ";
		break;
	case "Fuel Type":
		echo $ft. " | ";
		break;
	case "Mileage":
			echo number_format((float)$mileage, 0, '.', get_option('wp_thousandseparator')) . " " . get_option('wp_mileage_suffix') . " | ";
			break;
			
	case "Body Type":
		echo $bt;
		if ($body_type2) {
			echo ", " . $bt2;
			}
		echo " | ";
		break;
	
	case "Year":
		echo $year. " | ";
		break;
}



switch (get_option('wp_secondfeature')) {
	case "Beds":
			echo $beds . " " . get_option('wp_bedrooms_text') . " | ";
			break;
	case "Baths":
			echo $baths . " " . get_option('wp_bathrooms_text') . " | ";
			break;
	case "Size":
			echo number_format((float)$size, 0, '.', get_option('wp_thousandseparator')) . " " . get_option('wp_sizesuffix_text') . " | ";
			break;
	case "Lot Size":
			echo number_format((float)$lotsize, 0, '.', get_option('wp_thousandseparator')) . " " . get_option('wp_sizesuffix2_text') . " | ";
			break;
	case "MLS":
			echo $mls . " | ";
			break;
	case "Garage Spaces":
			echo $garage . " " . get_option('wp_garage_text') . " | ";
			break;
	case "Year Built":
			echo get_option('wp_yearbuilt_text') . ": " . $year . " | ";
			break;	
	case "Property Type":
		echo $pt;
		if ($propertytype2) {
			echo ", " . $pt2;
			}
		echo " | ";
		break;			
	case "Engine Size":
			echo $enginesize.get_option('wp_enginesizesuffix_text'). " | ";
			break;

	case "Transmission":
		echo $tr. " | ";
		break;
	case "Fuel Type":
		echo $ft. " | ";
		break;
	case "Mileage":
				echo number_format((float)$mileage, 0, '.', get_option('wp_thousandseparator')) . " " . get_option('wp_mileage_suffix') . " | ";
				break;
	case "Body Type":
		echo $bt;
		if ($body_type2) {
			echo ", " . $bt2;
			}
		echo " | ";
		break;
	case "Year":
		echo $year. " | ";
		break;
}



switch (get_option('wp_thirdfeature')) {
	case "Beds":
			echo $beds . " " . get_option('wp_bedrooms_text');
			break;
	case "Baths":
			echo $baths . " " . get_option('wp_bathrooms_text');
			break;
	case "Size":
			echo number_format((float)$size, 0, '.', get_option('wp_thousandseparator')) . " " . get_option('wp_sizesuffix_text');
			break;
	case "Lot Size":
			echo number_format((float)$lotsize, 0, '.', get_option('wp_thousandseparator')) . " " . get_option('wp_sizesuffix2_text');
			break;
	case "MLS":
			echo $mls;
			break;
	case "Garage Spaces":
			echo $garage . " " . get_option('wp_garage_text');
			break;
	case "Year Built":
			echo get_option('wp_yearbuilt_text') . ": " . $year;
			break;	
	case "Property Type":
		echo $pt;
		if ($propertytype2) {
			echo ", " . $pt2;
			}
		break;				
	case "Engine Size":
			echo $enginesize . get_option('wp_enginesizesuffix_text');
			break;
	case "Transmission":
		echo $tr;
		break;
	case "Fuel Type":
		echo $ft;
		break;
	case "Mileage":
			echo number_format((float)$mileage, 0, '.', get_option('wp_thousandseparator')) . " " . get_option('wp_mileage_suffix');
			break;
	case "Body Type":
		echo $bt;
		if ($body_type2) {
			echo ", " . $bt2;
			}
		break;
	case "Year":
		echo $year;
		break;
}
?>