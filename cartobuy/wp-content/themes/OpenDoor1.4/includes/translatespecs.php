<?php

// BODY TYPES
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

$bodytype_findtranslation = "";
if ($currentlang != $defaultlang) {
	//find the next array item that contains the current language code
	for ($i=0; $i<=$countlanguages -1; $i++) {
		$arrayitem = $arr_bodytype[$arr_pos + $i];
			if (strpos($arrayitem, $currentlang) !== false) {
				//put all items which contain current language code into an array
				$bodytype_findtranslation[] = $arrayitem;
			}
	}
	$arr_translated = explode(":", $bodytype_findtranslation[0]);
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

$bodytype_findtranslation2 = "";
if ($currentlang != $defaultlang) {
	//find the next array item that contains the current language code
	for ($i=0; $i<=$countlanguages -1; $i++) {
		$arrayitem = $arr_bodytype[$arr_pos + $i];
			if (strpos($arrayitem, $currentlang) !== false) {
				//put all items which contain current language code into an array
				$bodytype_findtranslation2[] = $arrayitem;
			}
	}
	$arr_translated = explode(":", $bodytype_findtranslation2[0]);
	$bodytype2 = $arr_translated[0];
} else {
	$bodytype2 = $body_type2;
}

$bt = $bodytype;
$bt2 = $bodytype2;

} else  { 
$bt = $body_type; 
$bt2 = $body_type2;
}



/* PROPERTY TYPE */
	
//check if single language or multilanguage
	$prop = get_option('wp_propertytype');
	$arr_propertytype = explode("\n", $prop);
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
	
	$propertytype_findtranslation = "";
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
		$prop = $arr_translated[0];
	} else {
		$prop = $propertytype;
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
	
	$propertytype_findtranslation2 = "";
	if ($currentlang != $defaultlang) {
		//find the next array item that contains the current language code
		for ($i=0; $i<=$countlanguages -1; $i++) {
			$arrayitem = $arr_propertytype[$arr_pos + $i];
				if (strpos($arrayitem, $currentlang) !== false) {
					//put all items which contain current language code into an array
					$propertytype_findtranslation2[] = $arrayitem;
				}
		}
		$arr_translated = explode(":", $propertytype_findtranslation2[0]);
		$prop2 = $arr_translated[0];
	} else {
		$prop2 = $propertytype2;
	}

	$pt = $prop;
	$pt2 = $prop2;

	} else  { 
	$pt = $propertytype; 
	$pt2 = $propertytype2;
	}




/* TRANSMISSION */ 


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
	
	$trans_findtranslation = "";
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



/* FUEL TYPE */ 


//check if single language or multilanguage
	$fuel = get_option('wp_fueltypes');
	$arr_fueltype = explode("\n", $fuel);
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
	
	$trans_findtranslation = "";
	if ($currentlang != $defaultlang) {
		//find the next array item that contains the current language code
		for ($i=0; $i<=$countlanguages -1; $i++) {
			$arrayitem = $arr_fueltype[$arr_pos + $i];
				if (strpos($arrayitem, $currentlang) !== false) {
					//put all items which contain current language code into an array
					$trans_findtranslation[] = $arrayitem;
				}
		}
		$arr_translated = explode(":", $trans_findtranslation[0]);
		$fuel = $arr_translated[0];
	} else {
		$fuel = $fueltype;
	}
	$ft = $fuel;
	} else  { 
	$ft = $fueltype; 
} 

?>