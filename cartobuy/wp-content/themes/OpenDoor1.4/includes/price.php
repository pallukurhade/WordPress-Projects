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



	$valueaddedtax = get_option('wp_vat');
	$arr_vat = explode("\n", $valueaddedtax);
	$defaultlangarray = explode(":", $arr_vat[0]);
	
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
	foreach ($arr_vat as $value) {
		$count = $count + 1;
		if (strpos($value, $vat . $defaultlang ) !== false) {
			$arr_pos = $count;
		}
	}
	
	$trans_findtranslation = "";
	if ($currentlang != $defaultlang) {
		//find the next array item that contains the current language code
		for ($i=0; $i<=$countlanguages -1; $i++) {
			$arrayitem = $arr_vat[$arr_pos + $i];
				if (strpos($arrayitem, $currentlang) !== false) {
					//put all items which contain current language code into an array
					$trans_findtranslation[] = $arrayitem;
				}
		}
		$arr_translated = explode(":", $trans_findtranslation[0]);
		$valueaddedtax = $arr_translated[0];
	} else {
		$valueaddedtax = $vat;
	}
	$v = $valueaddedtax;
	} else  { 
	$v = $vat; 
} 
?>








<?php if($pricecustom) { ?>

	<?php echo $pricecustom; ?>
	
<?php } else { ?>

	<?php echo $before . $price . $after ?> <?php if($v) { echo $v; } ?> <?php if (get_option('wp_site') == 'Real Estate') { ?><?php if ($bor == "Rent") { echo stripslashes(get_option('wp_permonthtext'));} ?>
	<?php } ?>
<?php } ?>