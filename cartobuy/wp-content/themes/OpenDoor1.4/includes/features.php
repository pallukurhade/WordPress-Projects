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

<?php	
//check if single language or multilanguage
	$transmission = get_option('wp_transmission');
	$arr_trans = explode("\n", $transmission);
	$defaultlangarray = explode(":", $arr_trans[0]);
	
	if (count($defaultlangarray) != 2) {
		$singlelanguage = true;
	} else {
		$singlelanguage = false;
	}
	
if ($singlelanguage == false) {
	if (function_exists('qtrans_getLanguage')) {
		$currentlang = ":" . qtrans_getLanguage();
		$languages = qtrans_getSortedLanguages();
		$countlanguages = count($languages);
	}
	$defaultlang = ":" . $languages[0];
	$count = 0;
	
	//find the position in the array where the chosen body type is, in default language
	foreach ($arr_trans as $value) {
		$count = $count + 1;
		if (strpos($value, $trans . $defaultlang ) !== false) {
			$arr_pos = $count;
		}
	}
	
	if ($currentlang != $defaultlang) {
		//find the next array item that contains the current language code
		for ($i=0; $i<=$countlanguages -1; $i++) {
			$arrayitem = $arr_trans[$arr_pos + $i];
				if (strpos($arrayitem, $currentlang) !== false) {
					//put all items which contain current language code into an array
					$trans_findtranslation[] = $arrayitem;
				}
		}
		$arr_translated = explode(":", $trans_findtranslation[0]);
		$transmission = $arr_translated[0];
	} else {
		$transmission = $trans;
	}
	$tr = $transmission;
	} else  { 
	$tr = $trans; 
} 


/* FUEL TYPE */ //////////////////////////////////////////////

//check if single language or multilanguage
	$fuel_type = get_option('wp_fueltypes');
	$arr_fueltype = explode("\n", $fuel_type);
	$defaultlangarray = explode(":", $arr_fueltype[0]);
	
	if (count($defaultlangarray) != 2) {
		$singlelanguage = true;
	} else {
		$singlelanguage = false;
	}
	
if ($singlelanguage == false) {
	if (function_exists('qtrans_getLanguage')) {
		$currentlang = ":" . qtrans_getLanguage();
		$languages = qtrans_getSortedLanguages();
		$countlanguages = count($languages);
	}
	$defaultlang = ":" . $languages[0];
	$count = 0;
	
	//find the position in the array where the chosen body type is, in default language
	foreach ($arr_fueltype as $value) {
		$count = $count + 1;
		if (strpos($value, $fueltype . $defaultlang ) !== false) {
			$arr_pos = $count;
		}
	}
	
	if ($currentlang != $defaultlang) {
		//find the next array item that contains the current language code
		for ($i=0; $i<=$countlanguages -1; $i++) {
			$arrayitem = $arr_fueltype[$arr_pos + $i];
				if (strpos($arrayitem, $currentlang) !== false) {
					//put all items which contain current language code into an array
					$fueltype_findtranslation[] = $arrayitem;
				}
		}
		$arr_translated = explode(":", $fueltype_findtranslation[0]);
		$fuel_type = $arr_translated[0];
	} else {
		$fuel_type = $fueltype;
	}
	$ft = $fuel_type;
	} else  { 
	$ft = $fueltype; 
} 	
	
?>



<li class="four columns">
		<span class="featuresprice">
		
		<?php 
		
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
		
		</span>
</li>

<!-- 
*************************** HOUSES SITE *************************
***************************************************************
-->

<?php if (get_option('wp_site') == "Real Estate") { ?>

	<?php if($mls) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_mls_text'))?>:
		<?php echo $mls ?>
		</li>
	<?php } ?>	
	
	
	
<?php 
//check if single language or multilanguage
	$pt = get_option('wp_propertytype');
	$arr_propertytype = explode("\n", $pt);
	$defaultlangarray = explode(":", $arr_propertytype[0]);

	if (count($defaultlangarray) != 2) {
		$singlelanguage = true;
	} else {
		$singlelanguage = false;
	}
	
if ($singlelanguage == false) {
	if (function_exists('qtrans_getLanguage')) {
		$currentlang = ":" . qtrans_getLanguage();
		$languages = qtrans_getSortedLanguages();
		$countlanguages = count($languages);
	}
	$defaultlang = ":" . $languages[0];
	$count = 0;
	
	//find the position in the array where the chosen body type is, in default language
	foreach ($arr_propertytype as $value) {
		$count = $count + 1;
		if (strpos($value, $propertytype . $defaultlang ) !== false) {
			$arr_pos = $count;
		}
	}
		
	if ($currentlang != $defaultlang) {
		//find the next array item that contains the current language code
		for ($i=0; $i<=$countlanguages-1; $i++) {
			$arrayitem = $arr_propertytype[$arr_pos + $i];
				if (strpos($arrayitem, $currentlang) !== false) {
					//put all items which contain current language code into an array
					$propertytype_findtranslation[] = $arrayitem;
				}
		}
		$arr_translated = explode(":", $propertytype_findtranslation[0]);
		$pt = $arr_translated[0];
	} else {
		$pt = $propertytype;
	}
	
	// 2nd body type dropdown
	//find the position in the array where the chosen body type is, in default language
	$count = 0;
	foreach ($arr_propertytype as $value) {
		$count = $count + 1;
		if (strpos($value, $propertytype2 . $defaultlang ) !== false) {
			$arr_pos = $count;
		}
	}
	
	if ($currentlang != $defaultlang) {
		//find the next array item that contains the current language code
		for ($i=0; $i<=$countlanguages-1; $i++) {
			$arrayitem = $arr_propertytype[$arr_pos + $i];
				if (strpos($arrayitem, $currentlang) !== false) {
					//put all items which contain current language code into an array
					$propertytype_findtranslation2[] = $arrayitem;
				}
		}
		
		$arr_translated = explode(":", $propertytype_findtranslation2[0]);
		$pt2 = $arr_translated[0];
		
		
	} else {
		$pt2 = $propertytype2;
	}
	?>
	
	<?php if($pt) { ?>
		<li class="four columns">
		<?php echo trim($pt) ?>
		<?php if($pt2) {
			echo ", " . trim($pt2); } ?>
		</li>
	<?php } ?>	
	
<?php } else  { ?>

	<?php if($propertytype) { ?>
		<li class="four columns">
		<?php echo trim($propertytype) ?>
		<?php if($propertytype2) {
			echo ", " . trim($propertytype2); } ?>
		</li>
	<?php } ?>	

<?php } ?>	
	
	

	<?php if ($cr == "Residential") { ?>
		<?php if($beds) { ?>
			<li class="four columns">
				<?php echo trim(get_option('wp_bedrooms_text'))?>:
			<?php echo $beds ?>
			</li>
		<?php } ?>	
		
		<?php if($baths) { ?>
			<li class="four columns">
				<?php echo trim(get_option('wp_bathrooms_text'))?>:
			<?php echo $baths ?>
			</li>
		<?php } ?>	
	<?php } ?>

	<?php if($size) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_size_text'))?>:
		<?php echo number_format((float)$size, 0, '.', get_option('wp_thousandseparator')) ?> <?php echo get_option('wp_sizesuffix_text') ?>
		</li>
	<?php } ?>
	
	<?php if($lotsize) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_lotsize_text'))?>:
		<?php echo number_format((float)$lotsize, 0, '.', get_option('wp_thousandseparator')) ?> <?php echo get_option('wp_sizesuffix2_text') ?>
		</li>
	<?php } ?>	

	<?php if($garage !=0) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_garage_text'))?>:
		<?php echo $garage ?>
		</li>
	<?php } ?>	
	
	<?php if($date) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_dateavailable_text'))?>:
		<?php echo $date ?>
		</li>
	<?php } ?>	
	
	<?php if($year) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_year_text'))?>:
		<?php echo $year ?>
		</li>
	<?php } ?>
	
	
	<?php if($school) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_schooldistrict_text'))?>:
		<?php echo $school ?>
		</li>
	<?php } ?>

<?php } ?>




<!-- 
*************************** CARS SITE *************************
***************************************************************
-->

<?php if (get_option('wp_site') == "Car Sales") { ?>

<?php 

//check if single language or multilanguage
	$bodytype = get_option('wp_bodytype');
	$arr_bodytype = explode("\n", $bodytype);
	$defaultlangarray = explode(":", $arr_bodytype[0]);

	if (count($defaultlangarray) != 2) {
		$singlelanguage = true;
	} else {
		$singlelanguage = false;
	}
	
	
	
	
	
if ($singlelanguage == false) {
	if (function_exists('qtrans_getLanguage')) {
		$currentlang = ":" . qtrans_getLanguage();
		$languages = qtrans_getSortedLanguages();
		$countlanguages = count($languages);
	}
	$defaultlang = ":" . $languages[0];
	$count = 0;
	
	
	//find the position in the array where the chosen body type is, in default language
	foreach ($arr_bodytype as $value) {
		$count = $count + 1;
		if (strpos($value, $body_type . $defaultlang ) !== false) {
			$arr_pos = $count;
		} 
	}

	if ($currentlang != $defaultlang) {
		//find the next array item that contains the current language code
		for ($i=0; $i<=$countlanguages-1; $i++) {
			$arrayitem = $arr_bodytype[$arr_pos + $i];
				if (strpos($arrayitem, $currentlang) !== false) {
					//put all items which contain current language code into an array
					$findtranslation[] = $arrayitem;
				} 
		}
		$arr_translated = explode(":", $findtranslation[0]);
		
		$bodytype = $arr_translated[0];
	} else {
		$bodytype = $body_type;
	}
	
	// 2nd body type dropdown
	//find the position in the array where the chosen body type is, in default language
	$count = 0;
	foreach ($arr_bodytype as $value) {
		$count = $count + 1;
		if (strpos($value, $body_type2 . $defaultlang ) !== false) {
			$arr_pos = $count;
		}
	}
	
	if ($currentlang != $defaultlang) {
		//find the next array item that contains the current language code
		for ($i=0; $i<=$countlanguages -1; $i++) {
			$arrayitem = $arr_bodytype[$arr_pos + $i];
				if (strpos($arrayitem, $currentlang) !== false) {
					//echo "~~~" . $arrayitem . "~~~";
					//put all items which contain current language code into an array
					$bodytype_findtranslation2[] = $arrayitem;
				}
		}
		$arr_translated = explode(":", $bodytype_findtranslation2[0]);
		$bodytype2 = $arr_translated[0];
	} else {
		$bodytype2 = $body_type2;
	}
	?>
	
	<?php if($bodytype) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_bodytype_text'))?>:
		<?php echo trim($bodytype) ?>
		
		<?php if($bodytype2) {
			echo ", " . trim($bodytype2); } ?>
		</li>
	<?php } ?>	
	
<?php } else  { ?>

	<?php if($body_type) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_bodytype_text'))?>:
		<?php echo trim($body_type) ?>
		<?php if($body_type2) {
			echo ", " . trim($body_type2); } ?>
		</li>
	<?php } ?>	

<?php } ?>




	
	
	<?php if($dealerlocations) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_dealerlocation_text'))?>:
		<?php echo $dealerlocations ?>
		</li>
	<?php } ?>	
	
	<?php if($servicehistory) { ?>
		<li class="four columns">
			<?php echo $servicehistory ?> 
			<?php if ($servicehistorydetails) { ?>
				<a class="servicehistoryicon" href="#" title="<?php echo $servicehistorydetails; ?>"><i class="icon-info-sign"></i></a>
			<?php } ?>
		</li>
	<?php } ?>	
	

	<?php if($regno) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_regnumber_text'))?>:
		<?php echo $regno ?>
		</li>
	<?php } ?>

	<?php if($mileage) { ?>
		<li class="four columns">
		<?php echo number_format((float)$mileage, 0, '.', get_option('wp_thousandseparator')) . " " . get_option('wp_mileage_suffix') ?>
		</li>
	<?php } ?>

	<?php if($regdate) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_regdate_text'))?>:
		<?php echo $regdate ?>
		</li>
	<?php } ?>

	<?php if($year) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_year_text'))?>:
		<?php echo $year ?>
		</li>
	<?php } ?>

	<?php if($enginesize) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_enginesize_text'))?>: <?php echo $enginesize ?><?php echo get_option('wp_enginesizesuffix_text') ?>
		</li>
	<?php } ?>
	

	
	<?php if($tr) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_trans_text'))?>:
		<?php echo $tr ?>
		</li>
	<?php } ?>

	<?php if($ft) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_fueltype_text'))?>:
		<?php echo $ft ?>
		</li>
	<?php } ?>

	<?php if($owners) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_owners_text'))?>:
		<?php echo $owners ?>
		</li>
	<?php } ?>

	<?php if($extcolor) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_extcolor_text'))?>:
		<?php 
		if (function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')) {
			echo qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($extcolor); 
		} else {
			echo $extcolor;
		}
		?>
		</li>
	<?php } ?>

	<?php if($intcolor) { ?>
		<li class="four columns">
			<?php echo trim(get_option('wp_intcolor_text'))?>:
			<?php 
			if (function_exists('qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage')) {
				echo qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage($intcolor); 
			} else {
				echo $intcolor;
			}
			
			?>
		</li>
	<?php } ?>
<?php } ?>





