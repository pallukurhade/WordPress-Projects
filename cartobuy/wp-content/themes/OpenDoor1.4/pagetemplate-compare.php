<?php 

/*
	Template Name: Compare
*/ 

?>

<?php $listofids = $_GET["compare"]; ?>


<?php
 get_header(); 
?>

<div class="sixteen columns outercontainer bigheading">
	<h2 id="title"><?php the_title(); ?></h2>
</div>	


<div class="sixteen columns outercontainer" id="content">
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
			<div>
				<?php the_content(); ?>
			</div>
		<?php endwhile; ?>
		
<?php endif; wp_reset_query(); ?>

<?php 
	$arr_listofids = explode(",", $listofids);
	$compare = new WP_Query(array('post_type' => 'listing', 'posts_per_page' => 5, 'post__in' => $arr_listofids));
?>



<?php if ($compare->have_posts()) : 
while ($compare->have_posts()) : 

$compare->the_post(); 

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
$theprice = "";
if($price == '0') {
	$theprice = get_option('wp_callforprice');
	$before = "";
	$after = "";
} else {
	$theprice = $price;
	if ($bor == "Rent") { $theprice = $theprice . stripslashes(get_option('wp_permonthtext')); }
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
}
?>

<?php
// get image
$arr_sliderimages = get_gallery_images();
if($arr_sliderimages[0]) {
	$resized = aq_resize ($arr_sliderimages[0], 100, 100, true);
} else {
	$resized = aq_resize (get_option('wp_noimage'), 100, 100, true);
}

//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
if ( get_stylesheet_directory() != get_template_directory() && 
file_exists(get_stylesheet_directory().'/includes/translatespecs.php') ) 
{			
	include get_stylesheet_directory() . '/includes/translatespecs.php';
	
}
else {
							
	include get_template_directory() . '/includes/translatespecs.php';
			
}	
	
	


  if (function_exists(qtrans_getLanguage)) {
	$langcode = qtrans_getLanguage();
	}

$theurl = get_permalink() . "?lang=".$langcode;




$compare_image .= "<td><img src='".$resized."'/><h4 class='compare'>". get_the_title() . "</h4><a class='btn btn-lightgray' href='". $theurl ."'>" . get_option('wp_readmore_text') . "</a></td>";
$compare_price .= "<td>". $before . $theprice . $after ."</td>"; 

if (get_option('wp_site') == "Real Estate") {
	$compare_beds .= "<td>".$beds."</td>"; 
	$compare_baths .= "<td>".$baths."</td>";
	$compare_openhouse .= "<td>".$openhousedate . "<br />". $openhousetime."</td>"; 
	$compare_bor .= "<td>".$bor."</td>"; 
	$compare_agent .= "<td>".$agent."</td>"; 
	$compare_agent2 .= "<td>".$agent2."</td>"; 
	$compare_cr .= "<td>".$cr."</td>";
	
	if ($propertytype) {
		$propertytypetext = $pt;
	}
	if ($propertytype2) {
		$propertytypetext = $propertytypetext . ", " . $pt2;
		}
		
	$compare_propertytype .= "<td>".$propertytypetext."</td>"; 
	$compare_garage .= "<td>".$garage."</td>"; 
	$compare_size .= "<td>". $size . "</td>"; 

	$compare_lotsize .= "<td>". $lotsize . "</td>"; 
	$compare_date .= "<td>". $date."</td>"; 
	/*
	$compare_rooms .= "<td>".$rooms."</td>"; 
	$compare_basement .= "<td>".$basement."</td>"; 
	*/
	$compare_year .= "<td>".$year."</td>"; 
	$compare_school .= "<td>".$school."</td>"; 
}

if (get_option('wp_site') == "Car Sales") {
	if ($body_type) {
		$bodytypetext = $bt;
	}
	if ($body_type2) {
		$bodytypetext = $bodytypetext . ", " . $bt2;
		}

	$compare_bodytype .= "<td>".$bodytypetext."</td>"; 
	$compare_enginesize .= "<td>".$enginesize."</td>";
	$compare_trans .= "<td>".$tr."</td>"; 
	$compare_mileage .= "<td>".$mileage."</td>"; 
	$compare_year .= "<td>".$year."</td>"; 
	$compare_owners .= "<td>".$owners."</td>"; 
	$compare_fueltype .= "<td>".$ft."</td>";
	$compare_color_ext .= "<td>".$extcolor."</td>";
	$compare_color_int .= "<td>".$intcolor."</td>";
	$compare_dealerlocation .= "<td>".$dealerlocations."</td>";
}

?>

<?php endwhile; else: ?>

<?php 
endif; 
wp_reset_query(); ?> 

<table id="comparisontable" class="table table-hover">
<tr><td class="col1 labels">&nbsp;</td><?php echo $compare_image; ?></tr>
<tr class="success price"><td class="labels"><?php echo get_option('wp_price_text') ?></td><?php echo $compare_price; ?></tr>

<?php if (get_option('wp_site') == "Real Estate") { ?>
	<tr><td class="labels"><?php echo get_option('wp_propertytype_text')?>:</td><?php echo $compare_propertytype; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_bedrooms_text')?>:</td><?php echo $compare_beds; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_bathrooms_text')?>:</td><?php echo $compare_baths; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_rentorbuy_text')?>:</td><?php echo $compare_bor; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_garage_text')?>:</td><?php echo $compare_garage; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_size_text') . " (" . get_option('wp_sizesuffix_text') . ")" ?>:</td><?php echo $compare_size; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_lotsize_text'). " (" . get_option('wp_sizesuffix2_text') . ")" ?>:</td><?php echo $compare_lotsize; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_dateavailable_text')?>:</td><?php echo $compare_date; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_yearbuilt_text')?>:</td><?php echo $compare_year; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_schooldistrict_text')?>:</td><?php echo $compare_school; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_openhouse_text')?>:</td><?php echo $compare_openhouse; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_agent_text')?>:</td><?php echo $compare_agent; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_agent_text')?> 2:</td><?php echo $compare_agent2; ?></tr>
<?php } ?>

<?php if (get_option('wp_site') == "Car Sales") { ?>
	<tr><td class="labels"><?php echo get_option('wp_bodytype_text') ?></td><?php echo $compare_bodytype; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_enginesize_text') ?></td><?php echo $compare_enginesize; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_trans_text') ?></td><?php echo $compare_trans; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_mileage_text') . " (" . get_option('wp_mileage_suffix') . ")" ?></td><?php echo $compare_mileage; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_year_text') ?></td><?php echo $compare_year; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_owners_text') ?></td><?php echo $compare_owners; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_fueltype_text') ?></td><?php echo $compare_fueltype; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_extcolor_text') ?></td><?php echo $compare_color_ext; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_intcolor_text') ?></td><?php echo $compare_color_int; ?></tr>
	<tr><td class="labels"><?php echo get_option('wp_dealerlocation_text') ?></td><?php echo $compare_dealerlocation; ?></tr>
<?php } ?>

</table>


</div>

<?php get_footer(); ?>