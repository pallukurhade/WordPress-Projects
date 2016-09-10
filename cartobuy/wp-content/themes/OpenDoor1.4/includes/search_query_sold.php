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


	$query ="SELECT p.* FROM $wpdb->posts p, $wpdb->postmeta p1
			WHERE p.ID = p1.post_id AND p1.meta_key='sold_value' AND p1.meta_value = 'Yes'";	
	$sbr = getIds( $query );
	$_ids = ( !empty($sbr) ? ( !empty($_ids) ? array_intersect( $_ids, $sbr) : "" ) : "" );

?>


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
} else {
	 $wpq = array ('post_type' => 'none');
}

query_posts($wpq);


?>












