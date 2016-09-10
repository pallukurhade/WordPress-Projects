<?php
if (get_option('wp_site') == "Car Sales") {
	add_action('init', 'Automobile_listing', 0);
	add_action('init', 'Salesrep');
}

if (get_option('wp_site') == "Real Estate") {
	add_action('init', 'property_listing', 0);
	add_action('init', 'agent');
}

add_action('init', 'photoslideshow');



if (get_option('wp_site') == "Car Sales") {
	function Automobile_listing() {
		$args = array(
			'description' => 'Automobile Listing Post Type',
			'show_ui' => true,
			'menu_position' => 4,
			'labels' => array(
				'name'=> 'Vehicle Listings',
				'singular_name' => 'Vehicle Listing',
				'add_new' => 'Add New Listing',
				'add_new_item' => 'Add New Listing',
				'edit' => 'Edit Listings',
				'edit_item' => 'Edit Listing',
				'new-item' => 'New Listing',
				'view' => 'View Listing',
				'view_item' => 'View Listing',
				'search_items' => 'Search Listings',
				'not_found' => 'No Listings Found',
				'not_found_in_trash' => 'No Listings Found in Trash',
				'parent' => 'Parent Listing'
			),
			'public' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'listing', 'with_front' => false ),
			'supports' => array('title', 'editor', 'thumbnail', 'comments')
		);
		register_post_type( 'listing' , $args );
	}


	function Salesrep() {
		$args = array(
			'description' => 'Staff Post Type',
			'show_ui' => true,
			'menu_position' => 4,
			'exclude_from_search' => true,
			'labels' => array(
				'name'=> 'Staff',
				'singular_name' => 'Staff',
				'add_new' => 'Add New Staff',
				'add_new_item' => 'Add New Staff',
				'edit' => 'Edit Staff',
				'edit_item' => 'Edit Staff',
				'new-item' => 'New Staff',
				'view' => 'View Staff',
				'view_item' => 'View Staff',
				'search_items' => 'Search Staff',
				'not_found' => 'No Staff Found',
				'not_found_in_trash' => 'No Staff Found in Trash',
				'parent' => 'Parent Staff'
				
			),
			'public' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => false,
			'supports' => array('title', 'editor')
		);

		register_post_type( 'salesrep' , $args );
	}
}


if (get_option('wp_site') == "Real Estate") {
	function property_listing() {
		$args = array(
			'description' => 'Property Listing Post Type',
			'show_ui' => true,
			'menu_position' => 4,
			'labels' => array(
				'name'=> 'Property Listings',
				'singular_name' => 'Property Listing',
				'add_new' => 'Add New Listing', 
				'add_new_item' => 'Add New Listing',
				'edit' => 'Edit Listings',
				'edit_item' => 'Edit Listing',
				'new-item' => 'New Listing',
				'view' => 'View Listing',
				'view_item' => 'View Listing',
				'search_items' => 'Search Listings',
				'not_found' => 'No Listings Found',
				'not_found_in_trash' => 'No Listings Found in Trash',
				'parent' => 'Parent Listing'
			),
			'public' => true,
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'listing', 'with_front' => false ),
			'supports' => array('title', 'editor', 'thumbnail', 'author', 'comments')
		);
		register_post_type( 'listing' , $args );
	}


	function agent() {
		$args = array(
			'description' => 'Agent Post Type',
			'show_ui' => true,
			'menu_position' => 4,
			'exclude_from_search' => true,
			'labels' => array(
				'name'=> 'Agent',
				'singular_name' => 'Agents',
				'add_new' => 'Add New Agent',
				'add_new_item' => 'Add New Agent',
				'edit' => 'Edit Agents',
				'edit_item' => 'Edit Agent',
				'new-item' => 'New Agent',
				'view' => 'View Agent',
				'view_item' => 'View Agent',
				'search_items' => 'Search Agents',
				'not_found' => 'No Agents Found',
				'not_found_in_trash' => 'No Agents Found in Trash',
				'parent' => 'Parent Agent'
			),
			'public' => true,
			//'taxonomies' => array('propertytype'),
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => true,
			'supports' => array('title', 'editor')
			
		);

		register_post_type( 'agent' , $args );
	}
}

function photoslideshow() {
	$args = array(
		'description' => 'Photo Slideshow Post Type',
		'show_ui' => true,
		'menu_position' => 4,
		'exclude_from_search' => true,
		'labels' => array(
			'name'=> 'Slideshow Photos',
			'singular_name' => 'Slideshow Photo',
			'add_new' => 'And New Slideshow Photo',
			'add_new_item' => 'Add New Slideshow Photo',
			'edit' => 'Edit Slideshow Photo',
			'edit_item' => 'Edit Slideshow Photo',
			'new-item' => 'New Slideshow Photo',
			'view' => 'View Slideshow Photo',
			'view_item' => 'View Slideshow Photo',
			'search_items' => 'Search Slideshow Photos',
			'not_found' => 'No Slideshow Photos Found',
			'not_found_in_trash' => 'No Slideshow Photos Found in Trash',
			'parent' => 'Parent Slideshow Photo'
			
		),
		'public' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => true,
		'supports' => array('title', 'editor')
		
	);

	register_post_type( 'photoslideshow' , $args );
}


// custom taxonomies
add_action('init', 'features_taxonomies', 1);
	function features_taxonomies() {
		register_taxonomy('features',
				'listing',
				array (
				'labels' => array (
						'name' => 'Features',
						'singluar_name' => 'Features',
						'search_items' => 'Search Features',
						'popular_items' => 'Popular Features',
						'all_items' => 'All Features',
						'parent_item' => 'Parent Features',
						'parent_item_colon' => 'Parent Features:',
						'edit_item' => 'Edit Features',
						'update_item' => 'Update Features',
						'add_new_item' => 'Add New Features',
						'new_item_name' => 'New Features',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'features'),
						'query_var' => 'features',
						'public'=>true)
				);
	}
	
	
	
	
	
add_action('init', 'other', 1);
function other() {
	register_taxonomy('other',
			'listing',
			array (
			'labels' => array (
					'name' => 'Other',
					'singluar_name' => 'Other',
					'search_items' => 'Search Other',
					'popular_items' => 'Popular Others',
					'all_items' => 'All Others',
					'parent_item' => 'Parent Other',
					'parent_item_colon' => 'Parent Other:',
					'edit_item' => 'Edit Other',
					'update_item' => 'Update Other',
					'add_new_item' => 'Add New Other',
					'new_item_name' => 'New Other',
			),
					'hierarchical' =>true,
					'show_ui' => true,
					'show_tagcloud' => true,
					'rewrite' => array( 'slug' => 'other'),
					'query_var' => 'other',
					'public'=>true)
			);
}

if (get_option('wp_site') == "Real Estate") {
	add_action('init', 'property_listing_taxonomies', 1);
	function property_listing_taxonomies() {
		register_taxonomy('property_type',
				'listing',
				array (
				'labels' => array (
						'name' => 'Property Type',
						'singluar_name' => 'Property Type',
						'search_items' => 'Search Property Type',
						'popular_items' => 'Popular Property Types',
						'all_items' => 'All Property Types',
						'parent_item' => 'Parent Property Type',
						'parent_item_colon' => 'Parent Property Type:',
						'edit_item' => 'Edit Property Type',
						'update_item' => 'Update Property Type',
						'add_new_item' => 'Add New Property Type',
						'new_item_name' => 'New Property Type',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'property_type'),
						'query_var' => 'property_type',
						'public'=>true)
				);
	}

	add_action('init', 'property_pricerange_taxonomies');
	function property_pricerange_taxonomies() {
		register_taxonomy('property_pricerange',
				'listing',
				array (
				'labels' => array (
						'name' => 'Price Ranges',
						'singluar_name' => 'Price Range',
						'search_items' => 'Search Price Range',
						'popular_items' => 'Popular Price Ranges',
						'all_items' => 'All Price Ranges',
						'parent_item' => 'Parent Price Range',
						'parent_item_colon' => 'Parent Price Range:',
						'edit_item' => 'Edit Price Range',
						'update_item' => 'Update Price Range',
						'add_new_item' => 'Add New Price Range',
						'new_item_name' => 'New Price Range',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'property_pricerange'),
						'query_var' => 'property_pricerange',
						'public'=>true)
				);
	}

	add_action('init', 'property_location_taxonomies');
	function property_location_taxonomies() {
		register_taxonomy('property_location',
				'listing',
				array (
				'labels' => array (
						'name' => 'Property Location',
						'singluar_name' => 'Property Location',
						'search_items' => 'Search Location',
						'popular_items' => 'Popular Locations',
						'all_items' => 'All Locations',
						'parent_item' => 'Parent Locations',
						'parent_item_colon' => 'Parent Locations:',
						'edit_item' => 'Edit Locations',
						'update_item' => 'Update Locations',
						'add_new_item' => 'Add New Location',
						'new_item_name' => 'New Location',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'property_location'),
						'query_var' => 'property_location',
						'public'=>true)
				);
	}


	add_action('init', 'property_buyorrent_taxonomies');
	function property_buyorrent_taxonomies() {
		register_taxonomy('property_buyorrent',
				'listing',
				array (
				'labels' => array (
						'name' => 'Buy or Rent',
						'singluar_name' => 'Buy or Rent',
						'search_items' => 'Search Buy or Rent',
						'popular_items' => 'Popular Buy or Rent',
						'all_items' => 'All Buys or Rentals',
						'parent_item' => 'Parent Buy or Rent',
						'parent_item_colon' => 'Parent Buys or Rents:',
						'edit_item' => 'Edit Buy or Rent',
						'update_item' => 'Update Buy or Rent',
						'add_new_item' => 'Add New Buy or Rent',
						'new_item_name' => 'New Buy or Rent',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'property_buyorrent'),
						'query_var' => 'property_buyorrent',
						'public'=>true)
				);
	}
}









if (get_option('wp_site') == "Car Sales") {


	add_action('init', 'automobile_manufacturer_taxonomies', 1);
	function automobile_manufacturer_taxonomies() {
		register_taxonomy('manufacturer',
				'listing',
				array (
				'labels' => array (
						'name' => 'Manufacturer',
						'singluar_name' => 'Manufacturer',
						'search_items' => 'Search Manufacturers',
						'popular_items' => 'Popular Manufacturers',
						'all_items' => 'All Manufacturers',
						'parent_item' => 'Parent Manufacturer',
						'parent_item_colon' => 'Parent Manufacturer:',
						'edit_item' => 'Edit Manufacturer',
						'update_item' => 'Update Manufacturer',
						'add_new_item' => 'Add New Manufacturer',
						'new_item_name' => 'New Manufacturer',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'manufacturer'),
						'query_var' => 'manufacturer',
						'public'=>true)
				);
	}



	add_action('init', 'automobile_pricerange_taxonomies', 1);
	function automobile_pricerange_taxonomies() {
		register_taxonomy('pricerange',
				'listing',
				array (
				'labels' => array (
						'name' => 'Price Ranges',
						'singluar_name' => 'Price Range',
						'search_items' => 'Search Price Range',
						'popular_items' => 'Popular Price Ranges',
						'all_items' => 'All Price Ranges',
						'parent_item' => 'Parent Price Range',
						'parent_item_colon' => 'Parent Price Range:',
						'edit_item' => 'Edit Price Range',
						'update_item' => 'Update Price Range',
						'add_new_item' => 'Add New Price Range',
						'new_item_name' => 'New Price Range',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'pricerange'),
						'query_var' => 'pricerange',
						'public'=>true)
				);
	}




	add_action('init', 'automobile_modelyear_taxonomies', 1);
	function automobile_modelyear_taxonomies() {
		register_taxonomy('modelyear',
				'listing',
				array (
				'labels' => array (
						'name' => 'Model Year Ranges',
						'singluar_name' => 'Model Year',
						'search_items' => 'Search Model Year',
						'popular_items' => 'Popular Model Years',
						'all_items' => 'All Model Years',
						'parent_item' => 'Parent Model Year',
						'parent_item_colon' => 'Parent Model Years:',
						'edit_item' => 'Edit Model Years',
						'update_item' => 'Update Model Year',
						'add_new_item' => 'Add New Model Year',
						'new_item_name' => 'New Model Year',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'modelyear'),
						'query_var' => 'modelyear',
						'public'=>true)
				);
	}


	add_action('init', 'automobile_mileage_taxonomies', 1);
	function automobile_mileage_taxonomies() {
		register_taxonomy('mileage',
				'listing',
				array (
				'labels' => array (
						'name' => 'Mileage Ranges',
						'singluar_name' => 'Mileage',
						'search_items' => 'Search Mileage',
						'popular_items' => 'Popular Mileage',
						'all_items' => 'All Mileage',
						'parent_item' => 'Parent Mileage',
						'parent_item_colon' => 'Parent Mileage:',
						'edit_item' => 'Edit Mileage',
						'update_item' => 'Update Mileage',
						'add_new_item' => 'Add New Mileage',
						'new_item_name' => 'New Mileage',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'mileage'),
						'query_var' => 'mileage',
						'public'=>true)
				);
	}
	
	
	add_action('init', 'automobile_enginesize_taxonomies', 1);
	function automobile_enginesize_taxonomies() {
		register_taxonomy('enginesize',
				'listing',
				array (
				'labels' => array (
						'name' => 'Engine Size Ranges',
						'singluar_name' => 'Engine Size',
						'search_items' => 'Search Engine Sizes',
						'popular_items' => 'Popular Engine Sizes',
						'all_items' => 'All Engine Sizes',
						'parent_item' => 'Parent Engine Size',
						'parent_item_colon' => 'Parent Engine Size:',
						'edit_item' => 'Edit Engine Size',
						'update_item' => 'Update Engine Size',
						'add_new_item' => 'Add New Engine Size',
						'new_item_name' => 'New Engine Size',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'enginesize'),
						'query_var' => 'enginesize',
						'public'=>true)
				);
	}
	

	add_action('init', 'automobile_bodytype_taxonomies', 1);
	function automobile_bodytype_taxonomies() {
		register_taxonomy('bodytype',
				'listing',
				array (
				'labels' => array (
						'name' => 'Body Type',
						'singluar_name' => 'Body Type',
						'search_items' => 'Search Body Type',
						'popular_items' => 'Popular body Types',
						'all_items' => 'All Body Types',
						'parent_item' => 'Parent Body Type',
						'parent_item_colon' => 'Parent Body Types:',
						'edit_item' => 'Edit Body Types',
						'update_item' => 'Update Body Type',
						'add_new_item' => 'Add New Body Type',
						'new_item_name' => 'New Body Type',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'bodytype'),
						'query_var' => 'bodytype',
						'public'=>true)
				);
	}	
	
	
	add_action('init', 'automobile_transmission_taxonomies', 1);
	function automobile_transmission_taxonomies() {
		register_taxonomy('transmission',
				'listing',
				array (
				'labels' => array (
						'name' => 'Transmission',
						'singluar_name' => 'Transmission',
						'search_items' => 'Search Transmissions',
						'popular_items' => 'Popular Transmissions',
						'all_items' => 'All Transmissions',
						'parent_item' => 'Parent Transmission',
						'parent_item_colon' => 'Parent Transmission:',
						'edit_item' => 'Edit Transmission',
						'update_item' => 'Update Transmission',
						'add_new_item' => 'Add New Transmission',
						'new_item_name' => 'New Transmission',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'transmission'),
						'query_var' => 'transmission',
						'public'=>true)
				);
	}
	
	
	add_action('init', 'dealerlocations', 1);
	function dealerlocations() {
		register_taxonomy('dealerlocation',
				'listing',
				array (
				'labels' => array (
						'name' => 'Dealer Location',
						'singluar_name' => 'Dealer Location',
						'search_items' => 'Dealer Location',
						'popular_items' => 'Popular Dealer Location',
						'all_items' => 'All Dealer Locations',
						'parent_item' => 'Parent Dealer Location',
						'parent_item_colon' => 'Parent Dealer Location:',
						'edit_item' => 'Edit Dealer Location',
						'update_item' => 'Update Dealer Location',
						'add_new_item' => 'Add New Dealer Location',
						'new_item_name' => 'New Dealer Location',
				),
						'hierarchical' =>true,
						'show_ui' => true,
						'show_tagcloud' => true,
						'rewrite' => array( 'slug' => 'dealerlocation'),
						'query_var' => 'dealerlocation',
						'public'=>true)
				);
	}
}







?>