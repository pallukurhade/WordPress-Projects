<?php
 
if ( ! isset( $content_width ) ) $content_width = 700;
function openhouse_init(){
load_theme_textdomain('automotiv', get_template_directory() . '/lang');
}
add_action ('init', 'openhouse_init');


// Load Theme Functions
require_once(get_template_directory() . '/functions/theme-functions.php');
require_once(get_template_directory() . '/functions/widgets.php');
require_once(get_template_directory() . '/functions/customposttypes.php');
require_once(get_template_directory() . '/functions/shortcodes.php');

add_theme_support( 'post-thumbnails', array( 'post'));
add_image_size( 'large', 700, 350, true );

add_editor_style();
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'menus' );
register_nav_menu('header', 'Primary Header Menu');
register_nav_menu('headersecondary', 'Secondary Header Menu');
register_nav_menu('footer', 'Footer Navigation Menu');

/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/


/* Set the file path for the Options Framework is in a parent theme */
define('OF_FILEPATH', get_template_directory());
define('OF_DIRECTORY', get_template_directory_uri());

/* These files build out the options interface.  Likely won't need to edit these. */

require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (OF_FILEPATH . '/admin/theme-functions.php'); 	// Theme actions based on options settings


add_action("wp_enqueue_scripts", "my_enqueue");
function my_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
   
   
  wp_register_script( 'selectivizr-min', get_template_directory_uri() . '/js/selectivizr-min.js' ); 
  wp_enqueue_script('selectivizr-min'); 
   
  wp_register_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.js' ); 
  wp_enqueue_script('fitvids');
  
  wp_register_script( 'unoslider', get_template_directory_uri() . '/js/unoslider.js' ); 
  wp_enqueue_script('unoslider');
  
  wp_register_script( 'cookies', get_template_directory_uri() . '/js/cookies.js' ); 
  wp_enqueue_script('cookies'); 
  
  wp_register_script( 'cycle', get_template_directory_uri() . '/js/cycle.js' ); 
  wp_enqueue_script('cycle'); 
  
  wp_register_script( 'scrolltopcontrol', get_template_directory_uri() . '/js/scrolltopcontrol.js' ); 
  wp_enqueue_script('scrolltopcontrol'); 
  
  wp_register_script( 'preload', get_template_directory_uri() . '/js/preload.js' ); 
  wp_enqueue_script('preload'); 
  
  wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js' ); 
  wp_enqueue_script('prettyPhoto'); 
  
  wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js' ); 
  wp_enqueue_script('superfish'); 
  
  wp_register_script( 'supersubs', get_template_directory_uri() . '/js/supersubs.js' ); 
  wp_enqueue_script('supersubs'); 
  
  wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js' ); 
  wp_enqueue_script('bootstrap'); 
  
  wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js' ); 
  wp_enqueue_script('flexslider'); 
  
  wp_register_script( 'custom', get_template_directory_uri() . '/js/custom.js' ); 
  wp_enqueue_script('custom'); 
}

add_action( 'wp_enqueue_scripts', 'mystyles'); 
function mystyles()  
{  
    wp_register_style( 'print', get_template_directory_uri() . '/css/print.css', array(), '', 'print' );  
    wp_enqueue_style( 'print' ); 

    wp_register_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css', array(), '', 'screen' );  
    wp_enqueue_style( 'skeleton' ); 

    wp_register_style( 'layout', get_template_directory_uri() . '/css/layout.css', array(), '', 'screen' );  
    wp_enqueue_style( 'layout' );  
	
    wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '', 'screen' );  
    wp_enqueue_style( 'bootstrap' ); 

    wp_register_style( 'unoslider', get_template_directory_uri() . '/css/unoslider.css', array(), '', 'screen' );  
    wp_enqueue_style( 'unoslider' );  
	
    wp_register_style( 'theme', get_template_directory_uri() . '/css/themes/modern/theme.css', array(), '', 'screen' );  
    wp_enqueue_style( 'theme' ); 	

    wp_register_style( 'superfish', get_template_directory_uri() . '/css/superfish.css', array(), '', 'screen' );  
    wp_enqueue_style( 'superfish' );  
	
    wp_register_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css', array(), '', 'screen' );  
    wp_enqueue_style( 'skeleton' ); 	

    wp_register_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', array(), '', 'screen' );  
    wp_enqueue_style( 'prettyPhoto' );   

    wp_register_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), '', 'screen' );  
    wp_enqueue_style( 'flexslider' );  

	wp_register_style( 'dsidxpress', get_template_directory_uri() . '/css/dsidxpress.css', array(), '', 'screen' ); 
    wp_enqueue_style( 'dsidxpress' );
	
	wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css', array(), '', 'screen' );  
    wp_enqueue_style( 'style' );   


	

} 
 




$concatbanner = "";
$banner = get_option('wp_banner');
		$banner = explode("\n", $banner);
		foreach ($banner as $item) {
			$concatbanner = $concatbanner . trim($item) . ",";
		}
		$concatbanner = substr ($concatbanner, 0, strlen($concatbanner)-1);
		$banner = explode(",", $concatbanner);
		array_unshift($banner, "Choose a banner:");


// HOUSES
if (get_option('wp_site') == "Real Estate") {

		global $wpdb;
		$buildagentarray = array();
		$agentarray = $wpdb->get_results( "
		SELECT post_title
		FROM $wpdb->posts AS p
		WHERE p.post_type = 'agent' AND p.post_status = 'publish'
		" );
		$i = 0;
		foreach ($agentarray as $item) {
			$buildagentarray[$i] = $item -> post_title;
			$i = $i + 1;
		}
		array_unshift($buildagentarray, "");




		
		

		// Banners... code at top to page
		$concatlocation = "";
		$location_level1 = get_option('wp_location_level1');
		$location_level1 = explode("\n", $location_level1);
		foreach ($location_level1 as $item) {
			$concatlocation = $concatlocation . trim($item) . ",";
		}
		$concatlocation = substr ($concatlocation, 0, strlen($concatlocation)-1);
		$location_level1 = explode(",", $concatlocation);
		array_unshift($location_level1, "Choose a location:");
		
		
		
		
		
		$propertytype = get_option('wp_propertytype');
		$propertytype = explode("\n", $propertytype);
		
		$defaultlangarray = explode(":", $propertytype[0]);
		if (count($defaultlangarray) != 2) {
			$singlelanguage = true;
		} else {
			$singlelanguage = false;
		}
		
		$concatpropertytype = "";
		if ($singlelanguage == true) {	
			
			foreach ($propertytype as $item) {
				$concatpropertytype = $concatpropertytype . trim($item) . ",";
			}
			$concatpropertytype = substr($concatpropertytype, 0, strlen($concatpropertytype)-1);
			$propertytype = explode(",", $concatpropertytype);
			array_unshift($propertytype, "");
		} else {
			
			$defaultlang = $defaultlangarray[1];
			
			//make array of all in dropdown from this language
			$concatpropertytype = "";
			foreach ($propertytype as $item) {
				if(strpos($item, ":".$defaultlang)) {
						$item = explode(":", $item);
						$item = $item[0];
						$concatpropertytype = $concatpropertytype . $item . "|";
				}
			}
			$concatpropertytype = substr($concatpropertytype, 0, strlen($concatpropertytype)-1);
			$propertytype = explode("|", $concatpropertytype);
			array_unshift($propertytype, "");
			
		}
		
		
		
		


		$new_meta_boxes_3 = 
		array(

		"images" => array(
		"name" => "images",
		"type" => "info",
		"title" => "<strong>Images</strong> (Required)",
		"description" => ""),

		"video_url" => array(
		"name" => "video_url",
		"type" => "textarea",
		"title" => "<strong>Youtube or Vimeo URL</strong>",
		"description" => "URL to the web page that hosts the Youtube or Vimeo URL. (For Vimeo, omit the 'www' from the URL).  For multiple videos, add each one on a new line. (no space between lines)."),

		"video_thumbanil" => array(
		"name" => "video_thumbnail",
		"type" => "textarea",
		"title" => "<strong>Video thumbnail image</strong>",
		"description" => "URL to the image that will represent your video.  Often this is a screenshot/screen grab of a frame of the video.  Or it can be simply a photo.  For multiple videos, add each one on a new line. (no space between lines).")
		);

		$new_meta_boxes = 
		array(

		"address" => array(
		"name" => "address",
		"type" => "input",
		"std" => "",
		"description" => "Enter the address for the listing. For example, 1223 Main Street.<br /><br /><strong>Note: </strong>This is for display, and Google Maps use only, NOT for use in the search.",
		"title" => "<strong>Address</strong>"),

		"citystatezip" => array(
		"name" => "citystatezip",
		"type" => "input",
		"std" => "",
		"description" => "Enter the City and State/Province (or similar for your area) in one line. <br /><br /><strong>Note: </strong>This is for display, and Google Maps use only, NOT for use in the search.",
		"title" => "<strong>City and State/Province</strong>"),

		"location_level1" => array(
		"name" => "location_level1",
		"type" => "select",
		"std" => "",
		"title" => "<strong>Primary Location</strong> (Required)",
		"options" => $location_level1,
		"description" => "Please select a Primary Search Location from the list. This is used as the primary Search by Location in the Search Box.  This list is editable in Theme Options. (General Settings)"),

		"location_level2" => array(
		"name" => "location_level2",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Secondary Location</strong> (optional)",
		"description" => "(Applies only when 'Enable Secondary Location Search Dropdown' is enabled in Theme Options. Enter the secondary location.  For example, if your Secondary Search Location info is set to be Cities, enter the City.  If it's set to be a County, then enter a County. Be sure the spelling is exactly the same as in the corresponding text file in the /secondary_search_location folder."), 

		"google_location" => array(
		"name" => "google_location",
		"type" => "input",
		"title" => "<strong>Google Maps Location</strong> ",
		"description" => "By default the Google Map for each listing uses the address, city, state, and Zip, as entered above. If you enter an address here, the Google map will use this info instead of the info entered above.")
		);

		$new_meta_boxes_2 = 
		array(
		
		"price" => array(
		"name" => "price",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Price</strong> (Required if this is searchable)",
		"description" => "How much is this property?<br /><br />
		Note: Enter only a number, with no currency symbol or commas. For example: 250000"),
		
		"pricecustom" => array(
		"name" => "pricecustom",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Custom price text</strong> (Optional)",
		"description" => "Example: 'As low as $200,000' or 'Call for price', or anything you want!. Include currency symbol and comma. This text will display where the price normally goes. <br /><br /><strong>Note: The price field is still required (give an estimated price instead of an exact one) even if you enter custom text here, otherwise the listing will not be found in a search.</strong>"),
		
		"reducedby" => array(
		"name" => "reducedby",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Price reduction</strong> (Optional)",
		"description" => "If the price is reduced, enter the amount it's reduced by. This number will appear when you hover over the green down arrow for a listing.<br />
		Note: Enter only a number, with no currency symbol or commas. For example: 250000"),
	
		"beds" => array(
		"name" => "beds",
		"type" => "input",
		"std" => "0",
		"title" => "<strong>Bedrooms</strong> (Required if this is searchable)",
		"description" => "How many bedrooms does this property have? This is used when visitors search by number of bedrooms."),

		"baths" => array(
		"name" => "baths",
		"type" => "input",
		"std" => "0",
		"title" => "<strong>Bathrooms</strong> (Required if this is searchable)",
		"description" => "How many bathrooms does this property have? This is used when visitors search by number of bathrooms."),

		
		"propertytype" => array(
		"name" => "propertytype",
		"type" => "select",
		"title" => "<strong>Property Type</strong> (Required if this is searchable)",
		"description" => "What type of property is this?  This is used when visitors search by Property Type.  (The choices can be customized in Theme Options) <strong>Note: make sure there are no BLANK lines at the end of your list.</strong>",
		"options" => $propertytype),
		
		"propertytype2" => array(
		"name" => "propertytype2",
		"type" => "select",
		"title" => "<strong>Property Type 2</strong>",
		"description" => "If the property also fits into another property type catagory, choose it here.",
		"options" => $propertytype),

		"rob" => array(
		"name" => "rob",
		"type" => "select",
		"std" => "",
		"options" => array("", "Buy", "Rent"),
		"title" => "<strong>Rent or Buy</strong> (Required if 'Buy or Rent' is enabled in the search box)",
		"description" => "Is this property for rent or buy? THIS CHOICE ONLY IS VALUABLE IF YOU ENABLE THE 'BUY/RENT' OPTION IN THE SEARCH BOX. (Enable or disable the 'buy/rent' search box option in Theme Options general section.)"),

		"size" => array(
		"name" => "size",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Size</strong> (Required if this is searchable)",
		"description" => "The home/building size. Only number, no commas or text. For example: 5500. This represents the number of square feet, acres, etc, as determined as your setting in Theme Options."),

		"lotsize" => array(
		"name" => "lotsize",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Lot Size</strong> (Required if this is searchable)",
		"description" => "The full lot size. Only a number, no comma or text. For example: 13500. This represents the number of square feet, acres, etc, as determined as your setting in Theme Options."),

		"garage" => array(
		"name" => "garage",
		"type" => "input",
		"std" => "0",
		"title" => "<strong>Garage Spaces</strong> (Required if this is searchable)",
		"description" => "How many cars can fit in the garage? Enter 0 for no garage."),

		"year" => array(
		"name" => "year",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Year Built</strong> (Required if this is searchable)",
		"description" => "What year was the home built?"),
		
		"openhousedate" => array(
		"name" => "openhousedate",
		"type" => "input",
		"title" => "<strong>Open House Date</strong> (Required if this is searchable)",
		"std" => "",
		"description" => "If this property has an upcoming 'Open House', enter the date. For example: 'July 12, 2013'. This theme will automatically disable any reference to the Openhouse when the date expires."),

		"openhousetime" => array(
		"name" => "openhousetime",
		"type" => "input",
		"title" => "<strong>Open House Time</strong>",
		"std" => "",
		"description" => "If this property has an upcoming 'Open House', enter the time range. For example: '1-4pm'"),

		"school" => array(
		"name" => "school",
		"type" => "input",
		"std" => "",
		"title" => "<strong>School District</strong>",
		"description" => "What is the school district?"),
		
		"cr" => array(
		"name" => "cr",
		"type" => "select",
		"std" => "Residential",
		"options" => array("Residential", "Commercial"),
		"title" => "<strong>Commercial or Residential listing?</strong> (Required if this is searchable)",
		"description" => "If you choose 'Commercial' then the Beds/Baths sections on the site will be hidden because they don't apply."),
		
		"agent" => array(
		"name" => "agent",
		"type" => "select",
		"std" => "",
		"options" => $buildagentarray,
		"title" => "<strong>Choose an Agent </strong>(Optional)",
		"description" => "If this property has a specific agent, choose one. Leave blank if there is not a specific agent for the property. If you leave it blank, then the property details contact form will not be specific to a single agent. (You create Agents by going to Agent -> Add New Agent)"),

		"agent2" => array(
		"name" => "agent2",
		"type" => "select",
		"std" => "",
		"options" => $buildagentarray,
		"title" => "<strong>Choose another Agent </strong>(Optional)",
		"description" => "If this property has another agent, select it here."),
		
		"date" => array(
		"name" => "date",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Date Available</strong>",
		"description" => "when is this property available?"),
		
		"banner" => array(
		"name" => "banner",
		"type" => "select",
		"std" => "",
		"title" => "<strong>Banner</strong> ",
		"description" => "Type of banner",
		"options" => $banner),
		
		"banner2" => array(
		"name" => "banner2",
		"type" => "select",
		"std" => "",
		"title" => "<strong>Banner 2 (Optional second choice)</strong> ",
		"description" => "Optional second banner choice. If you choose a second banner, then both banner texts will show on one line, separated by a comma.",
		"options" => $banner),
		
		"mlslisting" => array(
		"name" => "mlslisting",
		"type" => "select",
		"title" => "<strong>MLS?</strong>",
		"std" => "No",
		"options" => array("No", "Yes"),
		"description" => "<strong style='color: red;'>NOTE: THIS SETTING IS ONLY IF YOU ARE USING THE dsIDXpress PLUGIN FOR MLS LISTINGS.</strong><br />
		Is this listing in the MLS?<strong style='color: red;'><br />
		If you choose 'Yes'</strong>, then when this listing is in the homepage slideshow (or elsewhere), if you click on the 'Read More' button, you will be taken to a detail page generated by the dsIDXpress plugin. This page will contain a lot of auto-generated information. <strong style='color: red;'><br />
		If you choose 'No'</strong>, then the detail page will be genarated by the theme, and will only contain info that you enter on this screen.<br />
		Note: If you choose 'Yes' then the next setting is required."),

		"mls" => array(
		"name" => "mls",
		"type" => "input",
		"title" => "<strong>MLS Number</strong> (Required if this is searchable or the setting above is 'Yes')",
		"std" => "",
		"description" => "The MLS number for this listing.  (Required if the previous setting is set to 'Yes')"),
		
		"slideshow" => array(
		"name" => "slideshow",
		"type" => "select",
		"std" => "Yes",
		"options" => array("Yes", "No"),
		"title" => "<strong>Include in Slideshow?</strong>",
		"description" => "Do you want this listing to be featured on the homepage Slideshow?"),
		
		"slideshowtitle" => array(
		"name" => "slideshowtitle",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Custom Slideshow Title (Optional)</strong>",
		"description" => "By default the slideshow title will pull in the text from the post Title. You can override that text by entering custom text here."),
		
		"slideshowimage" => array(
		"name" => "slideshowimage",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Custom Slideshow Image (Optional)</strong>",
		"description" => "By default the slideshow title will use the first of your uploaded images for this listing. You can override that by entering a URL for an image. Image size should be 960x400. First upload the image from the Media tab in Wordpress. Then find and copy the image URL, and paste it here."),

		"sold" => array(
		"name" => "sold",
		"type" => "select",
		"std" => "No",
		"title" => "<strong>Sold</strong> ",
		"description" => "Indicate whether listing is sold. If you choose 'Yes' then the listing will be excluded from search results, Browse By results, slideshow, and more. (Make sure setting to filter out Sold is enabled in Theme Options -> Miscellaneous). Also you can create a Page showing all Sold listings. Do that by creating a Page, and use the 'Sold Listings' Page Template.",
		"options" => array("No", "Yes")),

		"streetview" => array(
		"name" => "streetview",
		"type" => "select",
		"std" => "Yes",
		"title" => "<strong>Show Street View</strong>",
		"options" => array("Yes", "No"),
		"description" => "If Google Street View isn't available for this listing, choose 'No', otherwise the Street View will convert to a standard Google Map, duplicating the map that is already there! <strong>Note: The Google Street View is approximate</strong>. May not point to exact property location."),

		"css" => array(
		"name" => "css",
		"type" => "textarea",
		"std" => "",
		"title" => "<strong>Custom CSS Styles</strong>",
		"description" => "Any CSS Styles here will be in effect only for this listing, and will override all other styles.")
		
		
		);



		$new_meta_boxes_4 = 
		array(

		"images" => array(
		"name" => "images",
		"type" => "info",
		"title" => "<strong>Slideshow Image</strong>",
		"description" => ""),

		"slideshow_url" => array(
		"name" => "slideshow_url",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Link URL</strong> (Optional)",
		"description" => "The URL to go to when the slideshow image is clicked")
		);


		$new_meta_boxes_6 = 
		array(

		"images" => array(
		"name" => "images",
		"type" => "info",
		"title" => "<strong>Image</strong>",
		"description" => ""),

		"title" => array(
		"name" => "title",
		"type" => "input",
		"std" => "Agent",
		"title" => "<strong>Title</strong>",
		"description" => "The Agent's official 'Title'"),

		"email" => array(
		"name" => "email",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Email</strong>",
		"description" => "The Agents' email address"),

		"phoneoffice" => array(
		"name" => "phoneoffice",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Office Phone Number</strong>",
		"description" => ""),

		"phonemobile" => array(
		"name" => "phonemobile",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Mobile Phone Number</strong>",
		"description" => ""),

		"fax" => array(
		"name" => "fax",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Fax Number</strong>",
		"description" => ""),

		"contactformshortcode" => array(
		"name" => "contactformshortcode",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Contact Form</strong>",
		"description" => "Contact Form 'Shortcode' from Contact Form 7 Plugin"),

		"agentorder" => array(
		"name" => "agentorder",
		"type" => "input",
		"std" => "1",
		"title" => "<strong>Order</strong>",
		"description" => "The order the Agent is listed in the Agents page. Lower numbers appear before higher numbers.")



		);


		function new_meta_boxes_4() {
		global $post, $new_meta_boxes, $new_meta_boxes_2, $new_meta_boxes_3, $new_meta_boxes_4;
			
			foreach($new_meta_boxes_4 as $meta_box) {
				
				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
				
				echo'<h2>'.$meta_box['title'].'</h2>';
				
				if( $meta_box['type'] == "input" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
				
					echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';
					
				} elseif( $meta_box['type'] == "textarea" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
				
					echo'<textarea name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%" cols="20" rows="7">'.$meta_box_value.'</textarea><br />';
					
				} elseif ( $meta_box['type'] == "select" ) {
					
					echo'<select name="'.$meta_box['name'].'_value">';
					
					foreach ($meta_box['options'] as $option) {
						
						echo'<option';
						if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) { 
							echo ' selected="selected"'; 
						} elseif ( $option == $meta_box['std'] ) { 
							echo ' selected="selected"'; 
						} 
						echo'>'. $option .'</option>';
					
					}
					
					echo'</select>';
					
				} elseif ($meta_box['type'] == "info") {
							
				
					echo '<p><strong>Add your slideshow image</strong> using the "Upload/Insert" button above the content textbox. Only one image per post.<br />Note: For this to show up in the slideshow, go to Theme Options -> Slideshow, and set the Slideshow Source to "Just Photos".</p>';
				}
				
				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			}

		}


		function new_meta_boxes_3() {
		global $post, $new_meta_boxes, $new_meta_boxes_2, $new_meta_boxes_3;
			
			foreach($new_meta_boxes_3 as $meta_box) {
				
				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
				
				echo'<h2>'.$meta_box['title'].'</h2>';
				
				if( $meta_box['type'] == "input" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
				
					echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';
					
				} elseif( $meta_box['type'] == "textarea" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
				
					echo'<textarea name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%" cols="20" rows="7">'.$meta_box_value.'</textarea><br />';
					
				} elseif ( $meta_box['type'] == "select" ) {
					
					echo'<select name="'.$meta_box['name'].'_value">';
					
					foreach ($meta_box['options'] as $option) {
						
						echo'<option';
						if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) { 
							echo ' selected="selected"'; 
						} elseif ( $option == $meta_box['std'] ) { 
							echo ' selected="selected"'; 
						} 
						echo'>'. $option .'</option>';
					
					}
					
					echo'</select>';
					
				} elseif ($meta_box['type'] == "info") {
							
				
					echo '<p><strong>Add your property images</strong> using the "Upload/Insert" button above the content textbox.</p>';
				}
				
				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			}

		}



		function new_meta_boxes() {
		global $post, $new_meta_boxes, $new_meta_boxes_2;
			
			foreach($new_meta_boxes as $meta_box) {
				
				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
				
				echo'<h2>'.$meta_box['title'].'</h2>';
				
				if( $meta_box['type'] == "input" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
				
					echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';
					
				} elseif( $meta_box['type'] == "textarea" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
				
					echo'<textarea name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%" cols="20" rows="7">'.$meta_box_value.'</textarea><br />';
					
				} elseif ( $meta_box['type'] == "select" ) {
					
					echo'<select name="'.$meta_box['name'].'_value">';
					
					foreach ($meta_box['options'] as $option) {
						
						echo'<option';
						if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) { 
							echo ' selected="selected"'; 
						} elseif ( $option == $meta_box['std'] ) { 
							echo ' selected="selected"'; 
						} 
						echo'>'. $option .'</option>';
					
					}
					
					echo'</select>';
					
				}
				
				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			}

		}

		function new_meta_boxes_2() {
		global $post, $new_meta_boxes, $new_meta_boxes_2;
			
			foreach($new_meta_boxes_2 as $meta_box) {
				
				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
				
				echo'<h2>'.$meta_box['title'].'</h2>';
				
				if( $meta_box['type'] == "input" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
						$meta_box_value = str_replace('"', "'", $meta_box_value);
				
					echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';
					
				} elseif( $meta_box['type'] == "textarea" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
				
					echo'<textarea name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%" cols="20" rows="7">'.$meta_box_value.'</textarea><br />';
					
				} elseif ( $meta_box['type'] == "select" ) {
					
					echo'<select name="'.$meta_box['name'].'_value">';
					
					foreach ($meta_box['options'] as $option) {
						
						echo'<option';
						if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) { 
							echo ' selected="selected"'; 
						} elseif ( $option == $meta_box['std'] ) { 
							echo ' selected="selected"'; 
						} 
						echo'>'. $option .'</option>';
					
					}
					
					echo'</select>';
					
				} elseif ($meta_box['type'] == "info") {
							
				
					echo '<p><strong>Add your property images</strong> using the "Upload/Insert" button above the content textbox.</p>';
				}
				
				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			}
		}



		function new_meta_boxes_6() {
		global $post, $new_meta_boxes, $new_meta_boxes_6;
			
			foreach($new_meta_boxes_6 as $meta_box) {
				
				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
				
				echo'<h2>'.$meta_box['title'].'</h2>';
				
				if( $meta_box['type'] == "input" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
						$meta_box_value = str_replace('"', "'", $meta_box_value);
				
					echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';
					
				} elseif( $meta_box['type'] == "textarea" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
				
					echo'<textarea name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%" cols="20" rows="7">'.$meta_box_value.'</textarea><br />';
					
				} elseif ( $meta_box['type'] == "select" ) {
					
					echo'<select name="'.$meta_box['name'].'_value">';
					
					foreach ($meta_box['options'] as $option) {
						
						echo'<option';
						if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) { 
							echo ' selected="selected"'; 
						} elseif ( $option == $meta_box['std'] ) { 
							echo ' selected="selected"'; 
						} 
						echo'>'. $option .'</option>';
					
					}
					
					echo'</select>';
					
				} elseif ($meta_box['type'] == "info") {
							
				
					echo '<p><strong>Add your property images</strong> using the "Upload/Insert" button above the content textbox.</p>';
				}
				
				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			}
		}



		function create_meta_box() {
		global $theme_name, $new_meta_boxes, $new_meta_boxes_2, $new_meta_boxes_3, $new_meta_boxes_4, $new_meta_boxes_5, $new_meta_boxes_6;
			if (function_exists('add_meta_box') ) {
			add_meta_box( 'new-meta-boxes_3', 'Images and Video', 'new_meta_boxes_3', 'listing', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes', 'Location', 'new_meta_boxes', 'listing', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes_2', 'Property Information', 'new_meta_boxes_2', 'listing', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes_4', 'Slideshow Photo', 'new_meta_boxes_4', 'photoslideshow', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes_6', 'Agent Information', 'new_meta_boxes_6', 'agent', 'normal', 'high' );
			}
		}

		function save_postdata( $post_id ) {
			global $post, $new_meta_boxes, $new_meta_boxes_2, $new_meta_boxes_3, $new_meta_boxes_4, $new_meta_boxes_5, $new_meta_boxes_6;  
			

			if( get_post_type() == 'photoslideshow' ) {
			foreach($new_meta_boxes_4 as $meta_box) {  
				
				// Verify  
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {  
				return $post_id;  
				}  
			
				if ( 'page' == $_POST['post_type'] ) {  
				if ( !current_user_can( 'edit_page', $post_id ))  
				return $post_id;  
				} else {  
				if ( !current_user_can( 'edit_post', $post_id ))  
				return $post_id;  
				}  
				
				$data = stripslashes($_POST[$meta_box['name'].'_value']);  
				
				if(get_post_meta($post_id, $meta_box['name'].'_value') == "")  
				add_post_meta($post_id, $meta_box['name'].'_value', $data, true);  
				elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))  
				update_post_meta($post_id, $meta_box['name'].'_value', $data);  
				elseif($data == "")  
				delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));  
				}
			}		
			
			
			
			
			if( get_post_type() == 'agent' ) {
			foreach($new_meta_boxes_6 as $meta_box) {  
				
				// Verify  
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {  
				return $post_id;  
				}  
			
				if ( 'page' == $_POST['post_type'] ) {  
				if ( !current_user_can( 'edit_page', $post_id ))  
				return $post_id;  
				} else {  
				if ( !current_user_can( 'edit_post', $post_id ))  
				return $post_id;  
				}  
				
				$data = stripslashes($_POST[$meta_box['name'].'_value']);  
				
				if(get_post_meta($post_id, $meta_box['name'].'_value') == "")  
				add_post_meta($post_id, $meta_box['name'].'_value', $data, true);  
				elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))  
				update_post_meta($post_id, $meta_box['name'].'_value', $data);  
				elseif($data == "")  
				delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));  
				}
			}	

			
			if( get_post_type() == 'listing' ) {
				foreach($new_meta_boxes as $meta_box) {  
				// Verify  
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {  
				return $post_id;  
				}  
				
				if ( 'page' == $_POST['post_type'] ) {  
				if ( !current_user_can( 'edit_page', $post_id ))  
				return $post_id;  
				} else {  
				if ( !current_user_can( 'edit_post', $post_id ))  
				return $post_id;  
				}  
				
				$data = $_POST[$meta_box['name'].'_value'];  
				
				if(get_post_meta($post_id, $meta_box['name'].'_value') == "")  
				add_post_meta($post_id, $meta_box['name'].'_value', $data, true);  
				elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))  
				update_post_meta($post_id, $meta_box['name'].'_value', $data);  
				elseif($data == "")  
				delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));  
				}

			
			

			
			
			foreach($new_meta_boxes_2 as $meta_box) {  
				
				// Verify  
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {  
				return $post_id;  
				}  
			
			if ( 'page' == $_POST['post_type'] ) {  
			if ( !current_user_can( 'edit_page', $post_id ))  
			return $post_id;  
			} else {  
			if ( !current_user_can( 'edit_post', $post_id ))  
			return $post_id;  
			}  
			
			$data = $_POST[$meta_box['name'].'_value'];  
			
			if(get_post_meta($post_id, $meta_box['name'].'_value') == "")  
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);  
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))  
			update_post_meta($post_id, $meta_box['name'].'_value', $data);  
			elseif($data == "")  
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));  
			}
			
			
			
			
			foreach($new_meta_boxes_3 as $meta_box) {  
				
				// Verify  
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {  
				return $post_id;  
				}  
			
				if ( 'page' == $_POST['post_type'] ) {  
				if ( !current_user_can( 'edit_page', $post_id ))  
				return $post_id;  
				} else {  
				if ( !current_user_can( 'edit_post', $post_id ))  
				return $post_id;  
				}  
				
				$data = $_POST[$meta_box['name'].'_value'];  
				
				if(get_post_meta($post_id, $meta_box['name'].'_value') == "")  
				add_post_meta($post_id, $meta_box['name'].'_value', $data, true);  
				elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))  
				update_post_meta($post_id, $meta_box['name'].'_value', $data);  
				elseif($data == "")  
				delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));  
				}
			}
			
			

		}

		add_action('admin_menu', 'create_meta_box');
		add_action('save_post', 'save_postdata');

/*
		class PHP_Code_Widget extends WP_Widget {

			function PHP_Code_Widget() {
				$widget_ops = array('classname' => 'widget_execphp', 'description' => __('Arbitrary text, HTML, or PHP Code', 'opendoor'));
				$control_ops = array('width' => 400, 'height' => 350);
				$this->WP_Widget('execphp', __('PHP Code', 'opendoor'), $widget_ops, $control_ops);
			}

			function widget( $args, $instance ) {
				extract($args);
				$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
				$text = apply_filters( 'widget_execphp', $instance['text'], $instance );
				echo $before_widget;
				if ( !empty( $title ) ) { echo $before_title . $title . $after_title; } 
					ob_start();
					eval('?>'.$text);
					$text = ob_get_contents();
					ob_end_clean();
					?>			
					<div class="execphpwidget"><?php echo $instance['filter'] ? wpautop($text) : $text; ?></div>
				<?php
				echo $after_widget;
			}

			function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title'] = strip_tags($new_instance['title']);
				if ( current_user_can('unfiltered_html') )
					$instance['text'] =  $new_instance['text'];
				else
					$instance['text'] = stripslashes( wp_filter_post_kses( $new_instance['text'] ) );
				$instance['filter'] = isset($new_instance['filter']);
				return $instance;
			}

			function form( $instance ) {
				$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '' ) );
				$title = strip_tags($instance['title']);
				$text = format_to_edit($instance['text']);
		?>
				<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'opendoor'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

				<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>

				<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs.', 'opendoor'); ?></label></p>
		<?php
			}
		}

		add_action('widgets_init', create_function('', 'return register_widget("PHP_Code_Widget");'));
		*/


} else {
// CARS
// ****************************************************************************************************************************
// ****************************************************************************************************************************
// ****************************************************************************************************************************
// ****************************************************************************************************************************
// ****************************************************************************************************************************
// ****************************************************************************************************************************
		$concatmanufacturer = "";
		$manufacturer_level1 = get_option('wp_manufacturer_level1');
		$manufacturer_level1 = explode("\n", $manufacturer_level1);
		foreach ($manufacturer_level1 as $item) {
			$concatmanufacturer = $concatmanufacturer . trim($item) . ",";
		}
		$concatmanufacturer = substr ($concatmanufacturer, 0, strlen($concatmanufacturer)-1);
		$manufacturer_level1 = explode(",", $concatmanufacturer);
		array_unshift($manufacturer_level1, "Choose a manufacturer:");
		
		
		
		$concatdealerlocations = "";
		$dealerlocations = get_option('wp_dealerlocations');
		$dealerlocations = explode("\n", $dealerlocations);
		foreach ($dealerlocations as $item) {
			$concatdealerlocations = $concatdealerlocations . trim($item) . ",";
		}
		$concatdealerlocations = substr ($concatdealerlocations, 0, strlen($concatdealerlocations)-1);
		$dealerlocations = explode(",", $concatdealerlocations);
		array_unshift($dealerlocations, "");
		
		
		
		$concatservicehistory = "";
		$servicehistory = get_option('wp_servicehistory');
		$servicehistory = explode("\n", $servicehistory);
		foreach ($servicehistory as $item) {
			$concatservicehistory = $concatservicehistory . trim($item) . ",";
		}
		$concatservicehistory = substr ($concatservicehistory, 0, strlen($concatservicehistory)-1);
		$servicehistory = explode(",", $concatservicehistory);
		array_unshift($servicehistory, "");



		$concatenginesize = "";
		$engine_size = get_option('wp_enginesizes');
		$engine_size = explode("\n", $engine_size);
		foreach ($engine_size as $item) {
			$concatenginesize = $concatenginesize . trim($item) . ",";
		}
		$concatenginesize = substr($concatenginesize, 0, strlen($concatenginesize)-1);
		$engine_size = explode(",", $concatenginesize);
		array_unshift($engine_size, "");
		
		
		
		// Banners... code at top to page



		
		$concatfueltype = "";
		$fueltype = get_option('wp_fueltypes');
		$fueltype = explode("\n", $fueltype);
		
		$defaultlangarray = explode(":", $fueltype[0]);
		if (count($defaultlangarray) == 1) {
			$singlelanguage = true;
		} else {
			$singlelanguage = false;
		}
		
		if ($singlelanguage == true) {		
			foreach ($fueltype as $item) {
				$concatfueltype = $concatfueltype . trim($item) . ",";
			}
			$concatfueltype = substr($concatfueltype, 0, strlen($concatfueltype)-1);
			$fueltype = explode(",", $concatfueltype);
			array_unshift($fueltype, "");
		} else {
			$defaultlang = $defaultlangarray[1];
			//make array of all in dropdown from this language
			foreach ($fueltype as $item) {
				if(strpos($item, ":".$defaultlang)) {
						$item = explode(":", $item);
						$item = $item[0];
						$concatfueltype = $concatfueltype . $item . "|";
				}
			}
			$concatfueltype = substr($concatfueltype, 0, strlen($concatfueltype)-1);
			$fueltype = explode("|", $concatfueltype);
			array_unshift($fueltype, "");
		}
		
		

		
		
		$concatbodytype = "";
		$bodytype = get_option('wp_bodytype');
		$bodytype = explode("\n", $bodytype);
		
		$defaultlangarray = explode(":", $bodytype[0]);
		if (count($defaultlangarray) == 1) {
			$singlelanguage = true;
		} else {
			$singlelanguage = false;
		}
		
		if ($singlelanguage == true) {		
			foreach ($bodytype as $item) {
				$concatbodytype = $concatbodytype . trim($item) . ",";
			}
			$concatbodytype = substr($concatbodytype, 0, strlen($concatbodytype)-1);
			$bodytype = explode(",", $concatbodytype);
			array_unshift($bodytype, "");
		} else {
			$defaultlang = $defaultlangarray[1];
			//make array of all in dropdown from this language
			foreach ($bodytype as $item) {
				if(strpos($item, ":".$defaultlang)) {
						$item = explode(":", $item);
						$item = $item[0];
						$concatbodytype = $concatbodytype . $item . "|";
				}
			}
			$concatbodytype = substr($concatbodytype, 0, strlen($concatbodytype)-1);
			$bodytype = explode("|", $concatbodytype);
			array_unshift($bodytype, "");
		}
		
		
		
		$concattrans = "";
		$trans = get_option('wp_transmission');
		$trans = explode("\n", $trans);
		
		$defaultlangarray = explode(":", $trans[0]);
		if (count($defaultlangarray) == 1) {
			$singlelanguage = true;
		} else {
			$singlelanguage = false;
		}
		
		if ($singlelanguage == true) {		
			foreach ($trans as $item) {
				$concattrans = $concattrans . trim($item) . ",";
			}
			$concattrans = substr($concattrans, 0, strlen($concattrans)-1);
			$trans = explode(",", $concattrans);
			array_unshift($trans, "");
		} else {
			$defaultlang = $defaultlangarray[1];
			//make array of all in dropdown from this language
			foreach ($trans as $item) {
				if(strpos($item, ":".$defaultlang)) {
						$item = explode(":", $item);
						$item = $item[0];
						$concattrans = $concattrans . $item . "|";
				}
			}
			$concattrans = substr($concattrans, 0, strlen($concattrans)-1);
			$trans = explode("|", $concattrans);
			array_unshift($trans, "");
		}



		$concatvat = "";
		$vat = get_option('wp_vat');
		$vat = explode("\n", $vat);
		
		$defaultlangarray = explode(":", $vat[0]);
		if (count($defaultlangarray) == 1) {
			$singlelanguage = true;
		} else {
			$singlelanguage = false;
		}
		
		if ($singlelanguage == true) {		
			foreach ($vat as $item) {
				$concatvat = $concatvat . trim($item) . ",";
			}
			$concatvat = substr($concatvat, 0, strlen($concatvat)-1);
			$vat = explode(",", $concatvat);
			array_unshift($vat, "");
		} else {
			$defaultlang = $defaultlangarray[1];
			//make array of all in dropdown from this language
			foreach ($vat as $item) {
				if(strpos($item, ":".$defaultlang)) {
						$item = explode(":", $item);
						$item = $item[0];
						$concatvat = $concatvat . $item . "|";
				}
			}
			$concatvat = substr($concatvat, 0, strlen($concatvat)-1);
			$vat = explode("|", $concatvat);
			array_unshift($vat, "");
		}		
		
		
		
		$garage = array("0", "1", "2", "3", "4", "5+");

		// Put Categories into an array (for use in various dropdown menus)
		$categories_list = get_categories('hide_empty=0&orderby=name');
		$getcat = array();

			foreach($categories_list as $acategory)
			{
				$getcat[$acategory->cat_ID] = $acategory->cat_name;
			}

		$category_dropdown = array_unshift($getcat, "Choose a category:");


		// Put Pages into an array (for use in dropdown for Theme Options)
		$pages_list = get_pages();
		$getpag = array();

			foreach($pages_list as $apage)
			{
				$getpag[$apage->ID] = $apage->post_title;
			}

		array_unshift($getpag, "Select a page:");







		$new_meta_boxes_3 =
		array(

		"images" => array(
		"name" => "images",
		"type" => "info",
		"title" => "<strong>Images</strong> (Required)",
		"description" => ""),
		"video_url" => array(
		"name" => "video_url",
		"type" => "textarea",
		"title" => "Youtube or Vimeo URL",
		"description" => "URL to the web page that hosts the Youtube or Vimeo URL. (For Vimeo, omit the 'www' from the URL).  For multiple videos, add each one on a new line. (no space between lines)."),

		"video_thumbanil" => array(
		"name" => "video_thumbnail",
		"type" => "textarea",
		"title" => "<strong>Video thumbnail image</strong>",
		"description" => "URL to the image that will represent your video.  Often this is a screenshot/screen grab of a frame of the video.  Or it can be simply a photo.  For multiple videos, add each one on a new line. (no space between lines).")

		);


		if (get_option('wp_secondary_manufacturer') == "Enable") {
			$new_meta_boxes =
			array(
			"manufacturer_level1" => array(
			"name" => "manufacturer_level1",
			"type" => "select",
			"std" => "",
			"title" => "<strong>Manufacturer</strong> (Required)",
			"options" => $manufacturer_level1,
			"description" => "Please select a Primary Search Manufacturer from the list. This is used as the primary Search by Manufacturer in the Search Box.  This list is editable in Theme Options. (General section)"),

			"manufacturer_level2" => array(
			"name" => "manufacturer_level2",
			"type" => "input",
			"std" => "",
			"title" => "<strong>Model</strong> (optional)",
			"description" => "(Applies only when 'Enable Model Dropdown in search' is enabled in Theme Options. Be sure the spelling is EXACTLY the same as in the corresponding text file in the /models folder.")
			);
		} else {
			$new_meta_boxes =
			array(
			"manufacturer_level1" => array(
			"name" => "manufacturer_level1",
			"type" => "select",
			"std" => "",
			"title" => "<strong>Manufacturer</strong> (Required)",
			"options" => $manufacturer_level1,
			"description" => "Please select a Primary Search Manufacturer from the list. This is used as the primary Search by Manufacturer in the Search Box.  This list is editable in Theme Options. (General section)")
			);
		}
		

		$new_meta_boxes_2 =
		array(
		
		"price" => array(
		"name" => "price",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Price</strong> (required)",
		"description" => "Enter only a number with no currency symbol or commas. For example: 15000"),
		
		"vat" => array(
		"name" => "vat",
		"type" => "select",
		"title" => "<strong>VAT</strong> (optional)",
		"description" => "Choose a Value Added Tax type. This text will be shown after the price whereever the price is shown. (Note: often used in countries outside the U.S.)",
		"options" => $vat),
		
		"pricecustom" => array(
		"name" => "pricecustom",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Custom price text</strong> (Optional)",
		"description" => "Example: 'As low as £6,000' or 'Call for price', or anything you want!. Include currency symbol and comma. This text will display where the price normally goes. <br /><br /><strong>Note: The price field is still required (give an estimated price instead of an exact one) even if you enter custom text here, otherwise the listing will not be found in a search.<br /><br />Tip: text can contain html markup.</strong>"),
		
		"reducedby" => array(
		"name" => "reducedby",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Price reduction</strong> (Optional)",
		"description" => "If the price is reduced, enter the amount it's reduced by. This number will appear when you hover over the green down arrow for a listing. <br />
		Note: Enter only a number, with no currency symbol or commas. For example: 1000"),

		"body_type" => array(
		"name" => "body_type",
		"type" => "select",
		"title" => "<strong>Body Type</strong> (required if this is a Search parameter)",
		"description" => "What type of vehicle is this?  This is used when visitors search by Body Type.  (The choices can be set in Theme Options) <strong>Note: make sure there are no BLANK lines at the end of your list.</strong>",
		"options" => $bodytype),
		
		"body_type2" => array(
		"name" => "body_type2",
		"type" => "select",
		"title" => "<strong>Body Type (2nd one)</strong>",
		"description" => "If the vehicle also fits into another body type category, choose it here.",
		"options" => $bodytype),

		"mileage" => array(
		"name" => "mileage",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Mileage</strong>  (required if this is a Search parameter)",
		"description" => "How many Miles does this vehicle have?  ***DO NOT ADD ANY COMMAS TO THE MILEAGE"),
		
		"year" => array(
		"name" => "year",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Model year</strong>  (required if this is a Search parameter)",
		"description" => "What is the model year for the vehicle?"),

		"enginesize" => array(
		"name" => "enginesize",
		"type" => "select",
		"options" => $engine_size,
		"std" => "",
		"title" => "<strong>Engine Size</strong> (required if this is a Search parameter)",
		"description" => "What is the Engine Size of the vehicle?"),

		"trans" => array(
		"name" => "trans",
		"type" => "select",
		"options" => $trans,
		"std" => "",
		"title" => "<strong>Transmission</strong> (required if this is a Search parameter)",
		"description" => "What type of transmission does this vehicle have?"),

		"fueltype" => array(
		"name" => "fueltype",
		"type" => "select",
		"options" => $fueltype,
		"std" => "Gas",
		"title" => "<strong>Fuel Type</strong> (required if this is a Search parameter)",
		"description" => "What type of fuel does the vehicle use?"),
		
		"servicehistory" => array(
		"name" => "servicehistory",
		"type" => "select",
		"options" => $servicehistory,
		"std" => "Gas",
		"title" => "<strong>Service History</strong>",
		"description" => ""),
		
		"servicehistorydetails" => array(
		"name" => "servicehistorydetails",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Service History Details</strong>",
		"description" => "Optional. For example: 6 service stamps to 80k"),
		

		"extcolor" => array(
		"name" => "extcolor",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Exterior Color</strong>",
		"description" => ""),

		"intcolor" => array(
		"name" => "intcolor",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Interior Color</strong>",
		"description" => ""),

		"regno" => array(
		"name" => "regno",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Registration Number</strong>",
		"description" => "The vehicle's Registration Number"),

		"owners" => array(
		"name" => "owners",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Owners</strong>",
		"description" => "How many owners does this vehicle have?"),
		
		"dealerlocations" => array(
		"name" => "dealerlocations",
		"type" => "select",
		"options" => $dealerlocations,
		"std" => "",
		"title" => "<strong>Dealer Location</strong> (required if this is a Search parameter)",
		"description" => "If the listing is at a specific dealer location, choose it here."),
		
		"banner" => array(
		"name" => "banner",
		"type" => "select",
		"std" => "",
		"title" => "<strong>Banner</strong> ",
		"description" => "Type of banner",
		"options" => $banner),
		
		"banner2" => array(
		"name" => "banner2",
		"type" => "select",
		"std" => "",
		"title" => "<strong>Banner 2</strong> (Optional second choice) ",
		"description" => "Optional second banner choice",
		"options" => $banner),
		
		"sold" => array(
		"name" => "sold",
		"type" => "select",
		"std" => "No",
		"title" => "<strong>Sold</strong> ",
		"description" => "Indicate whether listing is sold. If you choose 'Yes' then the vehicle listing will be excluded from search results, Browse By results, slideshow, and more. (Make sure setting to filter out Sold is enabled in Theme Options -> Miscellaneous). Also you can create a Page showing all Sold listings. Do that by creating a Page, and use the 'Sold Listings' Page Template.",
		"options" => array("No", "Yes")),
		
		"slideshow" => array(
		"name" => "slideshow",
		"type" => "select",
		"std" => "Yes",
		"options" => array("Yes", "No"),
		"title" => "<strong>Include in Slideshow?</strong>",
		"description" => "Do you want this vehicle listing to be featured on the homepage Slideshow?"),
		
		"slideshowtitle" => array(
		"name" => "slideshowtitle",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Custom Slideshow Title</strong> (Optional)",
		"description" => "By default the homepage slideshow title will be the 'Name' that you entered for the listing. If you don't want that, you can enter a custom title of your choice."),
		
		"slideshowimage" => array(
		"name" => "slideshowimage",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Custom Slideshow Image (Optional)</strong>",
		"description" => "By default the slideshow title will use the first of your uploaded images for this listing. You can override that by entering a URL for an image. Image size should be 960x400. First upload the image from the Media tab in Wordpress. Then find and copy the image URL, and paste it here."),

		"vin" => array(
		"name" => "vin",
		"type" => "input",
		"std" => "",
		"title" => "<strong>VIN number</strong> (optional)",
		"description" => "Enter the vehicle's VIN number. This is required for outputting VIN data from VINquery.com. A VINquery.com account is required. <strong>*****THIS IS NOT AVAILABLE IN THE UK*****</strong>"),
		
		"regdate" => array(
		"name" => "regdate",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Date of Registration</strong>",
		"description" => "The date the vehicle was registered."),
		
		"css" => array(
		"name" => "css",
		"type" => "textarea",
		"std" => "",
		"title" => "<strong>Custom CSS Styles</strong>",
		"description" => "Any CSS Styles here will be in effect only for this listing, and will override all other styles.")
		);



		$new_meta_boxes_4 =
		array(

		"images" => array(
		"name" => "images",
		"type" => "info",
		"title" => "<strong>Image</strong>",
		"description" => ""),

		"title" => array(
		"name" => "title",
		"type" => "input",
		"std" => "Sales Rep",
		"title" => "<strong>Title</strong>",
		"description" => "The Sales Rep's official 'Title'"),

		"email" => array(
		"name" => "email",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Email</strong>",
		"description" => "The Sales Rep's email address"),

		"phoneoffice" => array(
		"name" => "phoneoffice",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Office Phone Number</strong>",
		"description" => ""),

		"phonemobile" => array(
		"name" => "phonemobile",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Mobile Phone Number</strong>",
		"description" => ""),

		"fax" => array(
		"name" => "fax",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Fax Number</strong>",
		"description" => ""),

		"salesreporder" => array(
		"name" => "salesreporder",
		"type" => "input",
		"std" => "1",
		"title" => "<strong>Order</strong>",
		"description" => "The order the Sales Rep is listed in the Sales Rep page. Lower numbers appear before higher numbers.")

		);


		$new_meta_boxes_5 =
		array(

		"images" => array(
		"name" => "images",
		"type" => "info",
		"title" => "Slideshow Image",
		"description" => ""),

		"slideshow_url" => array(
		"name" => "slideshow_url",
		"type" => "input",
		"std" => "",
		"title" => "<strong>Link URL</strong> (Optional)",
		"description" => "The URL to go to when the slideshow image is clicked")


		);



		function new_meta_boxes_3() {
		global $post, $new_meta_boxes, $new_meta_boxes_2, $new_meta_boxes_3;

			foreach($new_meta_boxes_3 as $meta_box) {

				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

				echo'<h2>'.$meta_box['title'].'</h2>';

				if( $meta_box['type'] == "input" ) {

					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];

					echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';

				} elseif( $meta_box['type'] == "textarea" ) {

					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];

					echo'<textarea name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%" cols="20" rows="7">'.$meta_box_value.'</textarea><br />';

				} elseif ( $meta_box['type'] == "select" ) {

					echo'<select name="'.$meta_box['name'].'_value">';

					foreach ($meta_box['options'] as $option) {

						echo'<option';
						if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) {
							echo ' selected="selected"';
						} elseif ( $option == $meta_box['std'] ) {
							echo ' selected="selected"';
						}
						echo'>'. $option .'</option>';

					}

					echo'</select>';

				} elseif ($meta_box['type'] == "info") {


					echo '<p><strong>Add your vehicle images</strong> using the "Upload/Insert" button above the content textbox.</p>';
				}

				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			}

		}



		function new_meta_boxes() {
		global $post, $new_meta_boxes, $new_meta_boxes_2;

			foreach($new_meta_boxes as $meta_box) {

				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

				echo'<h2>'.$meta_box['title'].'</h2>';

				if( $meta_box['type'] == "input" ) {

					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];

					echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';

				} elseif( $meta_box['type'] == "textarea" ) {

					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];

					echo'<textarea name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%" cols="20" rows="7">'.$meta_box_value.'</textarea><br />';

				} elseif ( $meta_box['type'] == "select" ) {

					echo'<select name="'.$meta_box['name'].'_value">';

					foreach ($meta_box['options'] as $option) {

						echo'<option';
						if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) {
							echo ' selected="selected"';
						} elseif ( $option == $meta_box['std'] ) {
							echo ' selected="selected"';
						}
						echo'>'. $option .'</option>';

					}

					echo'</select>';

				}

				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			}

		}

		function new_meta_boxes_2() {
		global $post, $new_meta_boxes, $new_meta_boxes_2;

			foreach($new_meta_boxes_2 as $meta_box) {

				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
				
				echo'<h2>'.$meta_box['title'].'</h2>';
				
				if( $meta_box['type'] == "input" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
						$meta_box_value = str_replace('"', "'", $meta_box_value);
				
					echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';
					
				} elseif( $meta_box['type'] == "textarea" ) { 
				
					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
				
					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];
				
					echo'<textarea name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%" cols="20" rows="7">'.$meta_box_value.'</textarea><br />';
					
				} elseif ( $meta_box['type'] == "select" ) {
					
					echo'<select name="'.$meta_box['name'].'_value">';
					
					foreach ($meta_box['options'] as $option) {
						
						echo'<option';
						if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) { 
							echo ' selected="selected"'; 
						} elseif ( $option == $meta_box['std'] ) { 
							echo ' selected="selected"'; 
						} 
						echo'>'. $option .'</option>';
					
					}
					
					echo'</select>';
					
				} elseif ($meta_box['type'] == "info") {
							
				
					echo '<p><strong>Add your property images</strong> using the "Upload/Insert" button above the content textbox.</p>';
				}
				
				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			}

		}


		function new_meta_boxes_4() {
		global $post, $new_meta_boxes, $new_meta_boxes_4;

			foreach($new_meta_boxes_4 as $meta_box) {

				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

				echo'<h2>'.$meta_box['title'].'</h2>';

				if( $meta_box['type'] == "input" ) {

					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];

					echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';

				} elseif( $meta_box['type'] == "textarea" ) {

					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];

					echo'<textarea name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%" cols="20" rows="7">'.$meta_box_value.'</textarea><br />';

				} elseif ( $meta_box['type'] == "select" ) {

					echo'<select name="'.$meta_box['name'].'_value">';

					foreach ($meta_box['options'] as $option) {

						echo'<option';
						if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) {
							echo ' selected="selected"';
						} elseif ( $option == $meta_box['std'] ) {
							echo ' selected="selected"';
						}
						echo'>'. $option .'</option>';

					}

					echo'</select>';

				} elseif ($meta_box['type'] == "info") {


					echo '<p><strong>Add your sales rep image</strong> using the "Upload/Insert" button above the content textbox.</p>';
				}

				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			}

		}

		function new_meta_boxes_5() {
		global $post, $new_meta_boxes, $new_meta_boxes_2, $new_meta_boxes_3,  $new_meta_boxes_4,  $new_meta_boxes_5;

			foreach($new_meta_boxes_5 as $meta_box) {

				echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

				echo'<h2>'.$meta_box['title'].'</h2>';

				if( $meta_box['type'] == "input" ) {

					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];

					echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="55" /><br />';

				} elseif( $meta_box['type'] == "textarea" ) {

					$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

					if($meta_box_value == "")
						$meta_box_value = $meta_box['std'];

					echo'<textarea name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" style="width:100%" cols="20" rows="7">'.$meta_box_value.'</textarea><br />';

				} elseif ( $meta_box['type'] == "select" ) {

					echo'<select name="'.$meta_box['name'].'_value">';

					foreach ($meta_box['options'] as $option) {

						echo'<option';
						if ( get_post_meta($post->ID, $meta_box['name'].'_value', true) == $option ) {
							echo ' selected="selected"';
						} elseif ( $option == $meta_box['std'] ) {
							echo ' selected="selected"';
						}
						echo'>'. $option .'</option>';

					}

					echo'</select>';

				} elseif ($meta_box['type'] == "info") {


					echo '<p><strong>Add your slideshow image</strong> using the "Upload/Insert" button above the content textbox. Only one image per post.<br />Note: For this to show up in the slideshow, go to Theme Options -> Slideshow, and set the Slideshow Source to "Just Photos".</p>';
				}

				echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			}

		}


		function create_meta_box() {
		global $theme_name, $new_meta_boxes, $new_meta_boxes_2, $new_meta_boxes_3, $new_meta_boxes_4, $new_meta_boxes_5;
			if (function_exists('add_meta_box') ) {

			add_meta_box( 'new-meta-boxes_3', 'Images and Video', 'new_meta_boxes_3', 'listing', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes', 'Manufacturer', 'new_meta_boxes', 'listing', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes_2', 'Vehicle Information', 'new_meta_boxes_2', 'listing', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes_5', 'Slideshow Image', 'new_meta_boxes_5', 'photoslideshow', 'normal', 'high' );
			add_meta_box( 'new-meta-boxes_4', 'Sales Rep Info', 'new_meta_boxes_4', 'salesrep', 'normal', 'high' );
			}
		}

		function save_postdata( $post_id ) {
			global $post, $new_meta_boxes, $new_meta_boxes_2, $new_meta_boxes_3, $new_meta_boxes_4, $new_meta_boxes_5;


			if (get_post_type() == 'photoslideshow') {
			foreach($new_meta_boxes_5 as $meta_box) {

				// Verify

				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {

				return $post_id;
				}

			if ( 'page' == $_POST['post_type'] ) {

			if ( !current_user_can( 'edit_page', $post_id ))

			return $post_id;
			} else {

			if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
			}

			$data = $_POST[$meta_box['name'].'_value'];

			if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
			elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
			}
			}



			if (get_post_type() == 'salesrep') {
			foreach($new_meta_boxes_4 as $meta_box) {

				// Verify

				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {

				return $post_id;
				}

			if ( 'page' == $_POST['post_type'] ) {

			if ( !current_user_can( 'edit_page', $post_id ))

			return $post_id;
			} else {

			if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
			}

			$data = $_POST[$meta_box['name'].'_value'];

			if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
			elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
			}
			}


			if (get_post_type() == 'listing') {
				foreach($new_meta_boxes as $meta_box) {

				// Verify
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
				return $post_id;
				}

			if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
			return $post_id;
			} else {
			if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
			}

			$data = $_POST[$meta_box['name'].'_value'];

			if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
			elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
			}




			foreach($new_meta_boxes_2 as $meta_box) {

				// Verify
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
				return $post_id;
				}

			if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
			return $post_id;
			} else {
			if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
			}

			$data = $_POST[$meta_box['name'].'_value'];

			if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
			elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
			}



			foreach($new_meta_boxes_3 as $meta_box) {
				// Verify
				if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {
				return $post_id;
				}

			if ( 'page' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
			return $post_id;
			} else {
			if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
			}

			$data = $_POST[$meta_box['name'].'_value'];

			if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
			add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
			update_post_meta($post_id, $meta_box['name'].'_value', $data);
			elseif($data == "")
			delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
			}


			}



		}
		
		

		add_action('admin_menu', 'create_meta_box');
		add_action('save_post', 'save_postdata');

		
		

		


			function retrieve_vin_details( $vin ) {
				$accesscode = get_option('wp_accesscode');
				$reporttype = get_option('wp_reporttype');

				if( $accesscode && $reporttype ) {
					$request_url = sprintf( 'http://ws.vinquery.com/restxml.aspx?accessCode=%s&vin=%s&reportType=%s', $accesscode, $vin,  $reporttype);

					$timeout = 5;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $request_url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

					if( $data = curl_exec($ch) ) {
						$r = new SimpleXMLElement($data);

						if( $r->VIN['Status'] != 'SUCCESS' ) {
							trigger_error( sprintf('VIN error: %s - %s', $r->VIN['Number'], $r->VIN->Message['Value'] ) , E_USER_WARNING );
							unset($r);
						}
					}
					curl_close($ch);
				}

				return $r;
			}
			

			function get_vin_filename( $vin, $confirm_dir = false ) {
				$upload_dir = wp_upload_dir();
				$save_dir = $upload_dir['basedir'] . '/vin_data';

				if( $confirm_dir && !file_exists($save_dir) ) { // If the save directory doesn't exist, create it
					if( !mkdir($save_dir) ) {
						trigger_error( 'Unable to create VIN directory', E_USER_WARNING );
						return;
					}
				}

				return $save_dir . '/' . $vin .'.xml';
			}

			function save_vin_details( $post_id = null ) {

				if( $post_id && !wp_is_post_revision( $post_id ) ) {		// check we have a real post
					if( $vin = get_post_meta( $post_id, 'vin_value', true ) ) { // we only want records with a VIN

						$filename = get_vin_filename( $vin, true );

						if( !file_exists($filename) ) { // We can bail out if the file is already there
							if( $xml = retrieve_vin_details($vin) ) { // Get the external data
								$xml->asXml( $filename );					// Save it!
							} else {
								trigger_error( 'Unable to retrieve VIN data', E_USER_WARNING );
								return;
							}
						}
					}
				}
		   }
			add_action( 'save_post', 'save_vin_details', 99 );

			// ** End of External VIN handling code	
	
	
	
}



