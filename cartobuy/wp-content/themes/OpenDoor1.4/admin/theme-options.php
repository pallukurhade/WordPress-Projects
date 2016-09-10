<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
$themename = wp_get_theme(STYLESHEETPATH . '/style.css');
$themename = $themename['Name'];
$shortname = "wp";

$optionalsearchparameters1_cars = array("Mileage", "Transmission", "Fuel Type", "Engine Size", "Body Type", "Year");
$optionalsearchparameters2_cars = array("Year", "Transmission", "Fuel Type", "Mileage", "Body Type", "Engine Size");
$optionalsearchparameters3_cars = array("Body Type", "Transmission", "Fuel Type", "Mileage", "Year", "Engine Size");

$optionalsearchparameters1_houses = array("Beds", "Baths", "Property Type", "Size", "Lot Size", "MLS", "Garage Spaces", "Year Built");
$optionalsearchparameters2_houses = array("Baths", "Beds", "Property Type", "Size", "Lot Size", "MLS", "Garage Spaces", "Year Built");
$optionalsearchparameters3_houses = array("Property Type", "Beds", "Baths", "Lot Size", "MLS", "Garage Spaces", "Year Built");

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
$categories_tmp = array_unshift($of_categories, "Select a category:");    
       
//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
$of_pages_tmp = array_unshift($of_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 


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



//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
$alt_stylesheets = array();

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}



//More Options

$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// Set the Options Array
$options = array();






$options[] = array( "name" => "Most Important",
					"type" => "heading");	
					
$options[] = array( "name" => "Real Estate or Car Sales?",
	"desc" => "<strong style='color: red;'>IMOPORTANT: After your choice, please refresh this page before making any more changes in Theme Options</strong>",
	"id" => $shortname."_site",
	"type" => "select",
	"options" => array("Real Estate", "Car Sales"),
	"std" => "Real Estate");	

if (get_option('wp_search') == "Only built-in search" || get_option('wp_search') == "Both" || get_option('wp_site') == "Car Sales" ) {	
	$options[] = array( "name" => "Search Results Page",
		"desc" => "What 'Page' is your Search Results. (Note: you must create a 'Page' for Search Results. Give it a title. Also give it the Page Template name called 'Search Results'. That page will appear in this dropdown.)",
		"id" => $shortname."_searchresultspage",
		"type" => "select",
		"options" => $getpag,
		"std" => "");
}

if (get_option('wp_site') == "Real Estate") {
		$options[] = array( "name" => "Which Search Engines?",
			"desc" => "In the main search box, do you want to ONLY show the built-in Listings Search, ONLY the dsIDXpress search (for searching MLS listings), or both? If both, they will show up in a tabbed interface.<br /><br />Note: The 'Browse By' feature in the search area will also appear unless you disable it in Theme Options -> Browse By.",
			"id" => $shortname."_search",
			"type" => "select",
			"options" => array("Only built-in search", "Only dsIDXpress search (requires paid subscription for dsIDXpress plugin)", "Both"),
			"std" => "Only built-in search");
}















$options[] = array( "name" => "Homepage Layouts",
					"type" => "heading");	

$options[] = array( "name" => "What to show under slideshow (1st area)",
					"desc" => "Under the slideshow on the homepage, to the right of the left column search area, are 3 main sections: Recent Listins, 3 widgetized blocks, and Recent Blog posts.",
					"id" => $shortname . "_homepage_layout1",
					"std" => "",
					"type" => "select",
					"options" => array("Recent Listings", "Widgets", "Blog Posts")
					);	
					
$options[] = array( "name" => "What to show under slideshow (2nd area)",
					"desc" => "Under the slideshow on the homepage, to the right of the left column search area, are 3 main sections: Recent Listins, 3 widgetized blocks, and Recent Blog posts.",
					"id" => $shortname . "_homepage_layout2",
					"std" => "",
					"type" => "select",
					"options" => array("Widgets", "Recent Listings", "Blog Posts", "[nothing]")
					);	
					
$options[] = array( "name" => "What to show under slideshow (3rd area)",
					"desc" => "Under the slideshow on the homepage, to the right of the left column search area, are 3 main sections: Recent Listins, 3 widgetized blocks, and Recent Blog posts.",
					"id" => $shortname . "_homepage_layout3",
					"std" => "",
					"type" => "select",
					"options" => array("Blog Posts", "Widgets", "Recent Listings", "[nothing]")
					);	
					
$options[] = array( "name" => "Widget layout on the homepage",
					"desc" => "If you opt to show the widgetized area on the homepage, you have 4 layout choices.<br /><br />1. 3 equal size widget areas<br /><br />2. Two widget areas, right one twice as wide as the left.<br /><br />3. Two widget areas, left one  twice as wide as the right.<br /><br />4. One wide widget area.",
					"id" => $shortname . "_widgetlayout",
					"std" => "",
					"type" => "select",
					"options" => array("Layout 1", "Layout 2", "Layout 3", "Layout 4")
					);


	
	
	
	
	
	
	
	
	
$options[] = array( "name" => "Appearance",
					"type" => "heading");	
					
$options[] = array( "name" => "Main Color Scheme",
					"desc" => "Set the colour scheme for the theme.  This color will be used for the site background, headers, and buttons.  It is best to choose relatively dark colors, otherwise some headers will appear too light against light backgrounds.  If you do choose a very light color, you will have to edit some CSS so some text is legible against light backgrounds.",
					"id" => $shortname."_color_scheme",
					"type" => "color",
					"std" => "#a81c1c");
	
$options[] = array( "name" => "Text color (if main color scheme is too light)",
					"desc" => "If your color scheme (above) is fairly light, then the standard white text that is sometimes on top of it may be hard to read. Choose a darker color here to override white.",
					"id" => $shortname."_textcolor",
					"type" => "color",
					"std" => "");
					
$options[] = array( "name" => "Logo URL (Main)",
					"desc" => "Enter the link to your logo image.  Simply upload image with Wordpress, and copy/paste the final URL here.",
					"id" => $shortname."_logo",
					"type" => "upload",
					"std" => "");

$options[] = array( "name" => "Logo width",
					"desc" => "Width of logo area. If you make this more than 300, then the width will cause side scrolling when viewed on small very small mobile devices. So if no side scrolling is important, then try to keep your logo under 300 px wide. If this setting is 300 and your logo is wider, then it will get clipped off.",
					"id" => $shortname."_logowidth",
					"type" => "text",
					"std" => "300");	

$options[] = array( "name" => "Logo position X",
					"desc" => "Tweak the X/Y position of the logo (X is horizontal position)",
					"id" => $shortname."_logo_x",
					"type" => "text",
					"std" => "0");	
	
$options[] = array( "name" => "Logo position Y",
					"desc" => "Tweak the X/Y position of the logo (Y is vertical position).  Negative numbers go up, positive numbers, down.",
					"id" => $shortname."_logo_y",
					"type" => "text",
					"std" => "0");	
					
if (get_option('wp_site') == "Real Estate") {					
		$options[] = array( "name" => "Secondary Logo",
							"desc" => "Upload optional secondary logo image.  This logo is optional and placed in the right side of the header.",
							"id" => $shortname."_logo2",
							"type" => "upload",
							"std" => "");

					
		$options[] = array( "name" => "Secondary Logo link",
							"desc" => "URL to link to when you click the optional secondary logo.",
							"id" => $shortname."_secondarylogourl",
							"type" => "text",
							"std" => "");	
}					
		
$options[] = array( "name" => "Header height",
					"desc" => "Height of the header area. If your logo is large, you can increase this number to allow for more space.",
					"id" => $shortname."_headerheight",
					"type" => "text",
					"std" => "150");

$options[] = array( "name" => "Background Color",
					"desc" => "The background color is seen to the left and right of the site, with screens wider than 960px. This color can be combined with the next setting, 'Background Image'. In this case, the color will only show if the image tiling is not filling up the entire screen.",
					"id" => $shortname."_backgroundcolor",
					"type" => "color",
					"std" => "");
					
$options[] = array( "name" => "Background Image",
					"desc" => "The background image is seen to the left and right of the sige, with screens wider than 960px.  This image can be combined with the previous setting, 'Background Color'. The image will overlap any chosen color<br /><br />Tip: this theme doesn't include any backgrounds, because there are just too many styles and designs possible. Instead, there are many websites that offer free seamless background images. My favorite is: <a target=_blank  href='http://subtlepatterns.com/'>http://subtlepatterns.com/</a>. Just download, unzip, and upload here.<br ><br />You can use a light or dark color and it will not affect the legibility of text.",
					"id" => $shortname."_backgroundimage",
					"type" => "upload",
					"std" => "");	
	
$options[] = array( "name" => "Background Image Tiling",
					"desc" => "Repeat the background image on the X axis, Y axis, or don't repeat.",
					"id" => $shortname."_backgroundrepeat",
					"type" => "select",
					"options" => array("repeat", "repeat-x", "repeat-y", "no-repeat"),
					"std" => "repeat");	
					
$options[] = array( "name" => "Background Position",
					"desc" => "",
					"id" => $shortname."_backgroundposition",
					"type" => "select",
					"options" => array("left top", "left center", "left bottom", "right top", "right center", "right bottom", "center top", "center center", "center bottom"),
					"std" => "left top");	

$options[] = array( "name" => "Background Attachment",
					"desc" => "Do you want the background image to scroll along with the page, or stay fixed?",
					"id" => $shortname."_backgroundattachment",
					"type" => "select",
					"options" => array("fixed", "scroll"),
					"std" => "fixed");						
					


$options[] = array( "name" => "Header Color",
					"desc" => "The header color for the site. If no color is chosen, it will default to white. This chosen color will override the optional header background image setting below.<br /><br />Tip: enter 'transparent' if you want the site background color/background to show here.<br ><br /><strong>Note: </strong>the current theme design expects a light color. If you choose a dark color here, then any text overlapping this area may be hard to read. It will be up to you to edit style.css to change the text color.",
					"id" => $shortname."_headercolor",
					"type" => "color",
					"std" => "");	
					
$options[] = array( "name" => "Header Image",
					"desc" => "The header image for the site. <br ><br /<strong>Note: </strong> the current theme design expects a light image. If you choose a dark image here, then any text overlapping this area may be hard to read. It will be up to you to edit style.css to change the text color.",
					"id" => $shortname."_headerimage",
					"type" => "upload",
					"std" => "");	
	
$options[] = array( "name" => "Header Image Tiling",
					"desc" => "Repeat the header image on the X axis, Y axis, or don't repeat.",
					"id" => $shortname."_headerrepeat",
					"type" => "select",
					"options" => array("repeat-x", "repeat-y", "no-repeat", "repeat"),
					"std" => "repeat-x");	
					
				
					
$options[] = array( "name" => "Title area background color",
					"desc" => "The title area for all site pages other than the homepage. It defaults to a dark gray, but you can override the color here. This optional color will override the title background setting below.<br ><br /><strong>Note: </strong> the current theme design expects a dark color here. If you choose a light color here, then any text overlapping this area may be hard to read. It will be up to you to edit style.css to change the text color.",
					"id" => $shortname."_titlecolor",
					"type" => "color",
					"std" => "");	
					
$options[] = array( "name" => "Title area background image",
					"desc" => "The title area for all site pages other than the homepage. Choose a background image. The color setting above will override this setting.<br ><br /><strong>Note: </strong> the current theme design expects a dark image. If you choose a light color here, then any text overlapping this area may be hard to read. It will be up to you to edit style.css to change the text color.",
					"id" => $shortname."_titleimage",
					"type" => "upload",
					"std" => "");	
	
$options[] = array( "name" => "Title area background image Tiling",
					"desc" => "Repeat the title image on the X axis, Y axis, or don't repeat.",
					"id" => $shortname."_titlerepeat",
					"type" => "select",
					"options" => array("repeat", "repeat-x", "repeat-y", "no-repeat" ),
					"std" => "repeat");			
					
					
					
$options[] = array( "name" => "Footer background color",
					"desc" => "The title area for all site pages other than the homepage. It defaults to a dark gray, but you can override the color here. This color will override the title background setting below.<br ><br /><strong>Note: </strong> the current theme design expects a dark color. If you choose a light color here, then any text overlapping this area may be hard to read. It will be up to you to edit style.css to change the text color.",
					"id" => $shortname."_footercolor",
					"type" => "color",
					"std" => "");	
					
$options[] = array( "name" => "Footer background image",
					"desc" => "The title area for all site pages other than the homepage. Choose a background image. The color setting above will override this setting.<br ><br /><strong>Note: </strong> the current theme design expects a dark image. If you choose a light color here, then any text overlapping this area may be hard to read. It will be up to you to edit style.css to change the text color.",
					"id" => $shortname."_footerimage",
					"type" => "upload",
					"std" => "");	
	
$options[] = array( "name" => "Footer background image Tiling",
					"desc" => "Repeat the title image on the X axis, Y axis, or don't repeat.",
					"id" => $shortname."_footerrepeat",
					"type" => "select",
					"options" => array("repeat", "repeat-x", "repeat-y", "no-repeat" ),
					"std" => "repeat");

					
					
$options[] = array( "name" => "Google Font LINK code (For section headings, titles, ect.)",
					"desc" => "Find the desired font on www.google.com/webfonts, then copy the LINK code and paste here.",
					"id" => $shortname."_font1",
					"type" => "textarea",
					"std" => "<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>");		
	
$options[] = array( "name" => "Google Font CSS code (For section headings, titles, ect.)",
					"desc" => "Find the desired font on www.google.com/webfonts, then copy the CSS code and paste here.",
					"id" => $shortname."_font2",
					"type" => "text",
					"std" => "font-family: 'Oswald', sans-serif;");	

$options[] = array( "name" => "Alternate standard web font (for section headings, titles, etc.)",
					"desc" => "If you don't want to use Google Web Fonts (see above) then use this standard web font family. Note: Delete the Google Fonts code in the 2 settings above in order for this font to work.",
					"id" => $shortname."_font3",
					"type" => "text",
					"std" => "font-family: 'Arial', sans-serif;");	

$options[] = array( "name" => "Listing display layout",
					"desc" => "For Search Results, Browse By page results, and Recent Listings, what type of layout do you want?",
					"id" => $shortname . "_listinglayout",
					"std" => "",
					"type" => "select",
					"options" => array("Three per row grid", "One per row")
					);
					
$options[] = array( "name" => "Blog display layout",
					"desc" => "For the blog/news page of results, what type of layout do you want?",
					"id" => $shortname . "_bloglayout",
					"std" => "",
					"type" => "select",
					"options" => array("One per row", "Three per row grid")
					);
					
$options[] = array( "name" => "Custom CSS",
					"desc" => "Want to add any custom CSS code? Put in here, and the rest is taken care of. This overrides any other stylesheets. eg: a.button{color:green}. The CSS is placed in the head of every page, thus overriding the global style.css",
					"id" => $shortname."_customcss",
					"type" => "textarea",
					"std" => "");						
					
					





					
					
					
					
$options[] = array( "name" => "General Settings",
                    "type" => "heading");
	
if (get_option('wp_site') == "Real Estate") {	
	$options[] = array( "name" => "Generic Contact form Shortcode (for listing detail pages, if no Agent)",
		"desc" => "Contact Form 7 Plugin shortcode for your 'generic' Listing contact form. If you have Agent (or 2) set for a listing, they will have their own Contact Form shortcode. (Enter the shortcode in the Agent post) This shortcode is 'generic' and used only when no Agent is specified for a listing.",
		"id" => $shortname."_contactshortcode",
		"type" => "text",
		"std" => "");
}
	
if (get_option('wp_site') == "Car Sales") {	
	$options[] = array( "name" => "Contact form Shortcode (for listing detail pages)",
		"desc" => "Contact Form 7 Plugin shortcode for the simple contact form on each listing detail page.",
		"id" => $shortname."_contactshortcode",
		"type" => "text",
		"std" => "");
}
	
$options[] = array( "name" => "Contact form Shortcode (for Contact Us page)",
	"desc" => "Contact Form 7 Plugin shortcode for the Contact Us page. To create this page, create a new Page, and choose the 'Contact' Page Template.",
	"id" => $shortname."_contactuspageshortcode",
	"type" => "text",
	"std" => "");
	

$options[] = array( "name" => "Google Map of your location",
	"desc" => "Full address, city state, and zip/postal code, etc for your location.  To be used in the Contact Us page.",
	"id" => $shortname."_contactmap",
	"type" => "text",
	"std" => "");	
	
	
$options[] = array( "name" => "Blog posts per page (homepage)",
	"desc" => "If you are showing blog posts on the homepage, how many do you want to show? (note: layout is 4 items per row, so multiples of 4 is a good idea.)",
	"id" => $shortname."_blognumber",
	"type" => "text",
	"std" => "6");

		
$options[] = array( "name" => "Compare Page",
		"desc" => "Your 'Compare' listings page.  (Note: you must create a 'Page' for Compare. Give it a title. Also give it the Page Template name called 'Compare'. That page will appear in this dropdown.)",
		"id" => $shortname."_comparepage",
		"type" => "select",
		"options" => $getpag,
		"std" => "");



$options[] = array( "name" => "Recent Listings Quantity (homepage)",
	"desc" => "How many recent listings do you want to show in the homepage? (this is the thumbnail image version of Recent Listings)",
	"id" => $shortname."_recentlistingsnumber_home",
	"type" => "text",
	"std" => "3");
	

$options[] = array( "name" => "Banner choices",
		"desc" => "Enter all possible banner choices. One banner per line.<br /><br />Optionally set a color for any banner. To do this, enter the 'pipe' character (|) and then the color. The color can be either a HEX value or English word, like 'Blue', 'Red', etc.<br /><br />Example:<br /><br />Sold|red<br />Reduced|#FFFFFF<br />Pending|Yellow<br /><br />Note: If you change the color for a banner, you must re-choose the banner from each listing and re-publish.<br /><br />If you choose 2 banner choices, the color is always taken from the first banner choice.<br /><br />Note: Banners cannot be translated to other languages.",
		"id" => $shortname."_banner",
		"type" => "textarea",
		"std" => "Reduced\nSold\nPending\nReserved");
		
if (get_option('wp_site') == "Car Sales") {		
	$options[] = array( "name" => "Service History choices",
			"desc" => "Enter all possible service history choices. One per line. These will be a choice to pick when you add/edit a listing.<br /><br />Note: These choices cannot be translated to other languages.",
			"id" => $shortname."_servicehistory",
			"type" => "textarea",
			"std" => "Full Service History\nMain Dealer Service History\nPart Service History\nPart Main Dealer History\nFirst Service Not Due\nNo Service History");	
			
	$options[] = array( "name" => "Value Added Tax choices (VAT)",
			"desc" => "Enter all possible Value Added Tax choices. One per line. These will be a choice to pick when you add/edit a listing. (This is most often used for car dealer sites outside of the U.S.)<br /><br />This text can be translated to other languages by appending your text in :en, :de, :es, etc.",
			"id" => $shortname."_vat",
			"type" => "textarea",
			"std" => "+VAT\nVAT Exempt\nIncluding VAT");	
}
		
		

if (get_option('wp_site') == "Real Estate") {
	$options[] = array( "name" => "First Feature",
		"desc" => "The slideshow, latest listings, and search results show 3 features separated by a vertical line.  This is the first feature.",
		"id" => $shortname."_firstfeature",
		"type" => "select",
		"options" => $optionalsearchparameters1_houses,
		"std" => "Beds");
		
	$options[] = array( "name" => "Second Feature",
		"desc" => "The slideshow, latest listings, and search results show 3 features separated by a vertical line.  This is the second feature.",
		"id" => $shortname."_secondfeature",
		"type" => "select",
		"options" => $optionalsearchparameters2_houses,
		"std" => "Baths");
		
	$options[] = array( "name" => "Third Feature",
		"desc" => "The slideshow, latest listings, and search results show 3 features separated by a vertical line.  This is the third feature.",
		"id" => $shortname."_thirdfeature",
		"type" => "select",
		"options" => $optionalsearchparameters3_houses,
		"std" => "Size");
}
	
	
if (get_option('wp_site') == "Car Sales") {
	$options[] = array( "name" => "First Feature",
		"desc" => "The slideshow, latest listings, and search results show 3 features separated by a vertical line.  This is the first feature.",
		"id" => $shortname."_firstfeature",
		"type" => "select",
		"options" => $optionalsearchparameters1_cars,
		"std" => "Mileage");
		
	$options[] = array( "name" => "Second Feature",
		"desc" => "The slideshow, latest listings, and search results show 3 features separated by a vertical line.  This is the second feature.",
		"id" => $shortname."_secondfeature",
		"type" => "select",
		"options" => $optionalsearchparameters2_cars,
		"std" => "Year");
		
	$options[] = array( "name" => "Third Feature",
		"desc" => "The slideshow, latest listings, and search results show 3 features separated by a vertical line.  This is the third feature.",
		"id" => $shortname."_thirdfeature",
		"type" => "select",
		"options" => $optionalsearchparameters3_cars,
		"std" => "Body Type");
}	
	
$options[] = array( "name" => "Currency Symbol",
	"desc" => "If your symbol is an unusual character, enter the html entity string: 'http://www.w3schools.com/tags/ref_entities.asp'",
	"id" => $shortname."_currency",
	"type" => "text",
	"std" => "$");
	
$options[] = array( "name" => "Currency Symbol Position",
	"desc" => "Do you want the currency symbol to be before or after the price?",
	"id" => $shortname."_currencyposition",
	"type" => "select",
	"options" => array("Before", "After"),
	"std" => "Before");
	
	
$options[] = array( "name" => "Thousand Separator ",
	"desc" => "Usually a comma or a period to separate between thousands, for the price.",
	"id" => $shortname."_thousandseparator",
	"type" => "text",
	"std" => ",");					
	

$options[] = array( "name" => "Expand/Collapse Browse By",
	"desc" => "In the 'Browse By' section do you want it expanded or collapsed by default?",
	"id" => $shortname."_expandbrowseby",
	"type" => "select",
	"options" => array('Collapse', 'Expand'),
	"std" => "Collapse");
	
	
if (get_option('wp_site') == "Real Estate") {
	$options[] = array( "name" => "Expand/Collapse Search",
		"desc" => "In the built-in 'Search' section do you want it expanded or collapsed by default?",
		"id" => $shortname."_expandsearch_realestate",
		"type" => "select",
		"options" => array('Expand', 'Collapse'),
		"std" => "Expand");	
		
	$options[] = array( "name" => "Expand/Collapse Search (dsIDXpress)",
		"desc" => "In the dsIDXpress 'Search' (optional) section do you want it expanded or collapsed by default?",
		"id" => $shortname."_expandsearch_idx",
		"type" => "select",
		"options" => array('Expand', 'Collapse'),
		"std" => "Expand");	

}
	
if (get_option('wp_site') == "Car Sales") {
	$options[] = array( "name" => "Expand/Collapse Search",
		"desc" => "In the 'Search' section do you want it expanded or collapsed by default?",
		"id" => $shortname."_expandsearch_cars",
		"type" => "select",
		"options" => array('Expand', 'Collapse'),
		"std" => "Expand");
}					


						
					
					
					
					
					
					
					
					
	
	

	
	$options[] = array( "name" => "Custom Text",
						"type" => "heading");	
	
	$options[] = array( "name" => "header text",
		"desc" => "Header text (phone number(s), person's name, etc.). Located on right side of header above social icons. ",
		"id" => $shortname."_headertext",
		"type" => "textarea",
		"std" => "Some optional text<br />Line 2 of optional text");
		
	$options[] = array( "name" => "Heading for 'Recent from the blog'",
		"desc" => "Heading text for the Recent from the blog section (on homepage), if included.",
		"id" => $shortname."_heading_recentblog",
		"type" => "textarea",
		"std" => "Recent from the blog");	
		
	$options[] = array( "name" => "Heading for 'All Listings'",
		"desc" => "Heading text for 'All Listings' (optional).",
		"id" => $shortname."_alllistings",
		"type" => "textarea",
		"std" => "All Listings");
		
	
	$options[] = array( "name" => "Latest Listings header text",
		"desc" => "Heading text for the Latest Listings section on homepage.",
		"id" => $shortname."_heading_latestlistings",
		"type" => "textarea",
		"std" => "Recent Listings");	

	$options[] = array( "name" => "Latest posts",
	"desc" => "Heading text for the Latest Posts list",
	"id" => $shortname."_latestposts",
	"type" => "textarea",
	"std" => "Latest Posts");
		
		
	$options[] = array( "name" => "Search heading text",
		"desc" => "Heading text for the Search section",
		"id" => $shortname."_heading_customsearch",
		"type" => "textarea",
		"std" => "SEARCH");
		
	if (get_option('wp_site') == "Real Estate") {
		$options[] = array( "name" => "MLS Search heading text",
			"desc" => "Heading text for the Search MLS section (if using the dsIDXpress plugin)",
			"id" => $shortname."_heading_searchmls",
			"type" => "textarea",
			"std" => "Search MLS");
		}
		
	if (get_option('wp_site') == "Car Sales") {
		$options[] = array( "name" => "Manufacturer text",
		"desc" => "Text for 'Manufacturer' in the Search section",
		"id" => $shortname."_manufacturer_text",
		"type" => "textarea",
		"std" => "Manufacturer");
	}
	
	
		$options[] = array( "name" => "Contact Info text",
		"desc" => "Header text for contact sidebar in the optional Contact Us page.",
		"id" => $shortname."_contactinfo_text",
		"type" => "textarea",
		"std" => "Contact Info");
	
	$options[] = array( "name" => "Contact Us sidebar text",
	"desc" => "The content for the Sidebar for the optional Contact Us page.",
	"id" => $shortname."_contacttext",
	"type" => "textarea",
	"std" => "<p>Note: This can be completely customized in Theme Options page.</p>

	<p>
	My Company Name<br />
	1234 Some Street<br />
	Cool City, Somewhere 12345
	</p>

	<p>
	Phone 1: 123.456.7890<br />
	Phone 2: 111.222.3333<br/>
	Email 1: email@mycompany.com<br />
	Email 2: email@mycompany.com<br />
	</p>
	<p>
	Some other text here.
	</p>");	
	
	$options[] = array( "name" => "Contact Form text",
	"desc" => "Text for 'Contact Form' button in the listing detail page.",
	"id" => $shortname."_contactformbutton_text",
	"type" => "textarea",
	"std" => "Contact Form");
	
	
if (get_option('wp_site') == "Real Estate") {	
		$options[] = array( "name" => "Location text",
			"desc" => "Text for 'Location' label in the Search section",
			"id" => $shortname."_location_text",
			"type" => "textarea",
			"std" => "Location");
			
		$options[] = array( "name" => "'Rent or Buy' text",
			"desc" => "Text for 'Rent or Buy' label in the Search section",
			"id" => $shortname."_rentorbuy_text",
			"type" => "textarea",
			"std" => "Rent or Buy");
			

		$options[] = array( "name" => "Bedrooms text",
			"desc" => "Text for 'Bedrooms' label in the Search section",
			"id" => $shortname."_bedrooms_text",
			"type" => "textarea",
			"std" => "Bedrooms");
			
		$options[] = array( "name" => "Bathrooms text",
			"desc" => "Text for 'Bathrooms' label in the Search section",
			"id" => $shortname."_bathrooms_text",
			"type" => "textarea",
			"std" => "Bathrooms");
			
		$options[] = array( "name" => "Property type text",
		"desc" => "Text for 'Property Type' label in the Search section",
		"id" => $shortname."_propertytype_text",
		"type" => "textarea",
		"std" => "Property Type");	
		
		$options[] = array( "name" => "Residential or commercial text",
		"desc" => "Text for 'Residential or Commercial' label in the Search section",
		"id" => $shortname."_resorcomm_text",
		"type" => "textarea",
		"std" => "Residential or Commercial");	
		
		$options[] = array( "name" => "Residential text",
		"desc" => "Text for 'Residential' in the Residential/Commercial dropdown in the search",
		"id" => $shortname."_residential_text",
		"type" => "textarea",
		"std" => "Residential");	
		
		$options[] = array( "name" => "Commercial text",
		"desc" => "Text for 'Commercial' in the Residential/Commercial dropdown in the search",
		"id" => $shortname."_commercial_text",
		"type" => "textarea",
		"std" => "Commercial");	

		$options[] = array( "name" => "Year Built text",
		"desc" => "Text for 'Year' label in the Search section",
		"id" => $shortname."_year_text",
		"type" => "textarea",
		"std" => "Year Built");		

		$options[] = array( "name" => "'Yes' text",
		"desc" => "Text for 'Yes' in the optional search dropdown for Openhouse",
		"id" => $shortname."_yes_text",
		"type" => "textarea",
		"std" => "Yes");			
		
}
		
	$options[] = array( "name" => "Minimum price text",
		"desc" => "Text for 'Minimum price' label in the Search section",
		"id" => $shortname."_minimumprice_text",
		"type" => "textarea",
		"std" => "Min Price");	
		
	$options[] = array( "name" => "Maximum price text",
		"desc" => "Text for 'Maximum price' label in the Search section",
		"id" => $shortname."_maximumprice_text",
		"type" => "textarea",
		"std" => "Max Price");	
		
	$options[] = array( "name" => "Price text",
		"desc" => "Text for 'Price' label in the Compare listings page",
		"id" => $shortname."_price_text",
		"type" => "textarea",
		"std" => "Price");	
		
	$options[] = array( "name" => "'Basic Specs' text",
		"desc" => "Text for the first tab on the features tab set on the listing detail page. This tab contains most of the data entry values for a listing. Note: the other tabs in the set are generated by the checked off 'Features' when you make a listing.",
		"id" => $shortname."_basicspecs_text",
		"type" => "textarea",
		"std" => "Basic Specs");	
		
		

if (get_option('wp_site') == "Car Sales") {
		$options[] = array( "name" => "Engine Size text",
			"desc" => "Text for 'Engine Size' label in the Search section (if included), detail page, and Compare page",
			"id" => $shortname."_enginesize_text",
			"type" => "textarea",
			"std" => "Engine Size");
			
		$options[] = array( "name" => "Engine Size Suffix",
			"desc" => "Suffix after the engine size",
			"id" => $shortname."_enginesizesuffix_text",
			"type" => "textarea",
			"std" => "L");
			
		$options[] = array( "name" => "Transmission text",
			"desc" => "Text for 'Transmission' label in the Search section, slider, etc. (if included), detail page, and Compare page",
			"id" => $shortname."_trans_text",
			"type" => "textarea",
			"std" => "Trans");
			
		$options[] = array( "name" => "Body type text",
			"desc" => "Text for 'Body Type' label in the Search section (if included), detail page, and Compare page",
			"id" => $shortname."_bodytype_text",
			"type" => "textarea",
			"std" => "Body Type");	
			
		$options[] = array( "name" => "Year text",
			"desc" => "Text for 'Year' label in the Search section (if included), detail page, and Compare page",
			"id" => $shortname."_year_text",
			"type" => "textarea",
			"std" => "Model Year");	
			
		$options[] = array( "name" => "Mileage text",
			"desc" => "Text for 'Mileage' label in the Search section (if included), detail page, and Compare page",
			"id" => $shortname."_mileage_text",
			"type" => "textarea",
			"std" => "Mileage");
			
		$options[] = array( "name" => "Dealer location text",
			"desc" => "Text for 'Dealer Location' label in the Search section (if included), detail page, and Compare page",
			"id" => $shortname."_dealerlocation_text",
			"type" => "textarea",
			"std" => "Dealer Location");
			
		$options[] = array( "name" => "Registration Number text",
			"desc" => "Text for 'Registration Number' label in the detail page",
			"id" => $shortname."_regnumber_text",
			"type" => "textarea",
			"std" => "Reg Number");	
			
		$options[] = array( "name" => "Registration Date",
			"desc" => "Text for 'Registration Date' label in the detail page",
			"id" => $shortname."_regdate_text",
			"type" => "textarea",
			"std" => "Reg Date");	


		$options[] = array( "name" => "Fuel Type text",
			"desc" => "Text for 'Fuel Type' label in the detail page and Compare page",
			"id" => $shortname."_fueltype_text",
			"type" => "textarea",
			"std" => "Fuel Type");	
			
		$options[] = array( "name" => "Owners text",
			"desc" => "Text for 'Owners' label in the detail page and Compare page",
			"id" => $shortname."_owners_text",
			"type" => "textarea",
			"std" => "Owners");	

		$options[] = array( "name" => "Service History text",
			"desc" => "Text for 'Service History' label in the detail page and Compare page",
			"id" => $shortname."_servicehistory_text",
			"type" => "textarea",
			"std" => "Service History");
			
		$options[] = array( "name" => "Exterior Color text",
			"desc" => "Text for 'Exterior Color' label in the detail page and Compare page",
			"id" => $shortname."_extcolor_text",
			"type" => "textarea",
			"std" => "Ext color");

		$options[] = array( "name" => "Interior Color text",
			"desc" => "Text for 'Interior Color' label in the detail page and Compare page",
			"id" => $shortname."_intcolor_text",
			"type" => "textarea",
			"std" => "Int color");	
		
		$options[] = array( "name" => "Mileage text 2",
			"desc" => "Text after the mileage number. For example: 'miles', 'KM'",
			"id" => $shortname."_mileage_suffix",
			"type" => "textarea",
			"std" => "Miles");
			
		if (get_option('wp_showvinquery') == "show") {	
				$options[] = array( "name" => "Specifications text",
					"desc" => "Text for the 'Specifications' tab on the listing detail page if VIN data is generated from VINquery.com",
					"id" => $shortname."_specifications_text",
					"type" => "textarea",
					"std" => "Specifications");	
					
				$options[] = array( "name" => "Safety text",
					"desc" => "Text for the 'Safety' tab on the listing detail page if VIN data is generated from VINquery.com",
					"id" => $shortname."_safety_text",
					"type" => "textarea",
					"std" => "Safety");	
					
				$options[] = array( "name" => "Convenience text",
					"desc" => "Text for the 'Convenience' tab on the listing detail page if VIN data is generated from VINquery.com",
					"id" => $shortname."_convenience_text",
					"type" => "textarea",
					"std" => "Convenience");	
					
				$options[] = array( "name" => "Comfort text",
					"desc" => "Text for the 'Comfort' tab on the listing detail page if VIN data is generated from VINquery.com",
					"id" => $shortname."_comfort_text",
					"type" => "textarea",
					"std" => "Comfort");	
					
				$options[] = array( "name" => "Entertainment text",
					"desc" => "Text for the 'Entertainment' tab on the listing detail page if VIN data is generated from VINquery.com",
					"id" => $shortname."_entertainment_text",
					"type" => "textarea",
					"std" => "Entertainment");	
			}
			
		$options[] = array( "name" => "Loan Amount text",
			"desc" => "Text for the 'Loan Amount' in the loan calculator",
			"id" => $shortname."_loanamount_text",
			"type" => "textarea",
			"std" => "Loan Amount");	
			
		$options[] = array( "name" => "Down Payment text",
			"desc" => "Text for the 'Down Payment' in the loan calculator",
			"id" => $shortname."_downpayment_text",
			"type" => "textarea",
			"std" => "Down Payment");	
			
		$options[] = array( "name" => "Annual Rate % text",
			"desc" => "Text for the 'Annual Rate %' in the loan calculator",
			"id" => $shortname."_annualratepercentage_text",
			"type" => "textarea",
			"std" => "Annual Rate %");	

		$options[] = array( "name" => "Term (years) Text",
			"desc" => "Text for the 'Term (years)' in the loan calculator",
			"id" => $shortname."_termyears_text",
			"type" => "textarea",
			"std" => "Term (years)");	

		$options[] = array( "name" => "Payments text",
			"desc" => "Text for the 'Paymnets' in the loan calculator",
			"id" => $shortname."_payments_text",
			"type" => "textarea",
			"std" => "Payments");	

		$options[] = array( "name" => "Monthly Payment text",
			"desc" => "Text for the 'Monthly Payment' in the loan calculator",
			"id" => $shortname."_monthlypayment_text",
			"type" => "textarea",
			"std" => "Monthly Payment");	

		$options[] = array( "name" => "Calculate text",
			"desc" => "Text for the 'Calculate' button in the loan calculator",
			"id" => $shortname."_calculate_text",
			"type" => "textarea",
			"std" => "Calculate");				
}	

	$options[] = array( "name" => "'Details' text",
		"desc" => "Text for the 'Details' title in the listing detail page.",
		"id" => $shortname."_details_text",
		"type" => "textarea",
		"std" => "Details");
		
	$options[] = array( "name" => "'Basic Details' text",
		"desc" => "Text for the 'Basic Details' tab in the listing detail page.",
		"id" => $shortname."_basicdetails_text",
		"type" => "textarea",
		"std" => "Basic Details");

	$options[] = array( "name" => "Search button text",
		"desc" => "Text for the Search 'Button' in the Search section. <br /><br /><span style='color: red;'>For multilanguage sites, enter translations in a SINGLE line, with no line breaks. If you don't, the homepage slideshow will not work.</span>",
		"id" => $shortname."_searchbutton_text",
		"type" => "textarea",
		"std" => "Search");	
		
	$options[] = array( "name" => "Text for 'Any'",
		"desc" => "For the search parameters, the text for 'Any'",
		"id" => $shortname."_any_text",
		"type" => "textarea",
		"std" => "Any");
		
		
	if (get_option('wp_site') == "Real Estate") {	
		$options[] = array( "name" => "Text for 'Anywhere'",
		"desc" => "For the search parameters, the text for 'Anywhere'",
		"id" => $shortname."_anywhere_text",
		"type" => "textarea",
		"std" => "Anywhere");
		
		
		$options[] = array( "name" => "Open House text",
			"desc" => "The text for 'Open House'",
			"id" => $shortname."_openhouse_text",
			"type" => "textarea",
			"std" => "Open House");	
			
			
		$options[] = array( "name" => "MLS text",
			"desc" => "The text for 'MLS Number' in the listing detail page.",
			"id" => $shortname."_mls_text",
			"type" => "textarea",
			"std" => "MLS");		
			
		$options[] = array( "name" => "Size text",
			"desc" => "The text for 'Size' in the listing detail page and Compare page.",
			"id" => $shortname."_size_text",
			"type" => "textarea",
			"std" => "Size");			
			
		$options[] = array( "name" => "Lot Size text",
			"desc" => "The text for 'Lot Size' in the listing detail page and Compare page.",
			"id" => $shortname."_lotsize_text",
			"type" => "textarea",
			"std" => "Lot Size");

		$options[] = array( "name" => "Size suffix (for physical structure)",
			"desc" => "Text after the size. For example, Sq Ft, Sq Meters, etc.",
			"id" => $shortname."_sizesuffix_text",
			"type" => "textarea",
			"std" => "Sq Ft.");	

		$options[] = array( "name" => "Lot Size suffix",
			"desc" => "Text after the lot size. For example, Acres",
			"id" => $shortname."_sizesuffix2_text",
			"type" => "textarea",
			"std" => "Acres");						
			
		$options[] = array( "name" => "Garage Spaces text",
			"desc" => "The text for 'Garage Spaces' in the listing detail page.",
			"id" => $shortname."_garage_text",
			"type" => "textarea",
			"std" => "Garage Spaces");		


		$options[] = array( "name" => "Date Available text",
			"desc" => "The text for 'Date Available' in the listing detail page and Compare page.",
			"id" => $shortname."_dateavailable_text",
			"type" => "textarea",
			"std" => "Date Available");	

		$options[] = array( "name" => "Total Rooms text",
			"desc" => "The text for 'Total Rooms' in the listing detail page and Compare page.",
			"id" => $shortname."_totalrooms_text",
			"type" => "textarea",
			"std" => "Total Rooms");			
			
		$options[] = array( "name" => "Basement text",
			"desc" => "The text for 'Basement' in the listing detail page and Compare page.",
			"id" => $shortname."_basement_text",
			"type" => "textarea",
			"std" => "Basement");	

		$options[] = array( "name" => "Floors text",
			"desc" => "The text for 'Floors' in the listing detail page and Compare page.",
			"id" => $shortname."_floors_text",
			"type" => "textarea",
			"std" => "Floors");		

		$options[] = array( "name" => "Year Built text",
			"desc" => "The text for 'Year Built' in the listing detail page and Compare page.",
			"id" => $shortname."_yearbuilt_text",
			"type" => "textarea",
			"std" => "Year Built");		
			
		$options[] = array( "name" => "School District text",
			"desc" => "The text for 'School District' in the listing detail page and Compare page.",
			"id" => $shortname."_schooldistrict_text",
			"type" => "textarea",
			"std" => "School District");		
			

		$options[] = array( "name" => "Rental suffix",
			"desc" => "If you set a property to be a Rental, this text will go after the price.",
			"id" => $shortname."_permonthtext",
			"type" => "textarea",
			"std" => "/month");	
			
		$options[] = array( "name" => "Map disclaimer text",
			"desc" => "Optional disclaimer text under search results Google Map saying that the pins on map may not be 100% accurate if Google cannot find the exact address.",
			"id" => $shortname."_mapdisclaimer_text",
			"type" => "textarea",
			"std" => "Disclaimer: Pins in map may not be accurate if Google Maps cannot find the exact address. In this case an approximation is made. Only pins from current page are shown at one time.");	
}
		
		
	$options[] = array( "name" => "Text for 'No Min'",
		"desc" => "For the search parameters, the text for 'No Min'",
		"id" => $shortname."_nomin_text",
		"type" => "textarea",
		"std" => "No Min");	
		
	$options[] = array( "name" => "Text for 'No Max'",
		"desc" => "For the search parameters, the text for 'No Max'",
		"id" => $shortname."_nomax_text",
		"type" => "textarea",
		"std" => "No Max");		
		
	$options[] = array( "name" => "Header for Search Results (for Listings)",
		"desc" => "Header text for the search results page (for a Listings search)",
		"id" => $shortname."_searchresults",
		"type" => "textarea",
		"std" => "Search Results");	
		
	$options[] = array( "name" => "Header for Search Results (for news/blog posts)",
		"desc" => "Header text for the search results page (for news/blog posts)",
		"id" => $shortname."_blogsearchresults_text",
		"type" => "textarea",
		"std" => "Search Results");	
		
	$options[] = array( "name" => "Loan calculator text",
		"desc" => "Heading text for the Loan Calculator",
		"id" => $shortname."_loancalculator_text",
		"type" => "textarea",
		"std" => "Loan Calculator");
		
	$options[] = array( "name" => "Text for 'Compare'",
		"desc" => "Text for the 'Compare' link in the Search Results and Browse By pages.",
		"id" => $shortname."_compare_text",
		"type" => "textarea",
		"std" => "Compare");
		
	$options[] = array( "name" => "'Reduced By' text",
		"desc" => "Text for 'Reduced By', which shows when you hover over the green down arrow next to a price.",
		"id" => $shortname."_reducedby_text",
		"type" => "textarea",
		"std" => "Reduced By");
		
	$options[] = array( "name" => "Related Listings Text",
		"desc" => "Text for the heading of the optional Related Listings section",
		"id" => $shortname."_related_text",
		"type" => "textarea",
		"std" => "Related");	
		
	$options[] = array( "name" => "No Results text",
		"desc" => "Text shown when a listing search produces no results.",
		"id" => $shortname."_noresults",
		"type" => "textarea",
		"std" => "Sorry, your search has found no matching results. Please try a different search.");
		
	$options[] = array( "name" => "No Results text (when browsing)",
		"desc" => "Text shown when there are no 'Browse by' results.",
		"id" => $shortname."_noresults_browse",
		"type" => "textarea",
		"std" => "Sorry, no results have been found. Please try again.");
		
	$options[] = array( "name" => "Page not found heading",
		"desc" => "Heading text for when a page or blog post cannot be found",
		"id" => $shortname."_notfound_heading_text",
		"type" => "textarea",
		"std" => "Not Found");
		
	$options[] = array( "name" => "Page not found body text",
		"desc" => "Body text for when a page or blog post cannot be found",
		"id" => $shortname."_notfound_body_text",
		"type" => "textarea",
		"std" => "The page you are trying to reach cannot be found.");
		
	$options[] = array( "name" => "Contact Us heading text",
		"desc" => "Heading text for the Contact Us text following a listing.",
		"id" => $shortname."_contactustext",
		"type" => "textarea",
		"std" => "Contact us regarding this listing");
		
	$options[] = array( "name" => "Copyright",
		"desc" => "Copyright text",
		"id" => $shortname."_copyright",
		"type" => "textarea",
		"std" => "Copyright &copy; 2012 YourCompanyName");
		
		
	if (get_option('wp_site') == "Real Estate") {		
		$options[] = array( "name" => "Contact Us heading text<br />(for specific agent)",
		"desc" => "Heading text for the Contact Agent text following a home listing. Use this if each listing has it's own Agent contact info.",
		"id" => $shortname."_agentcontactustext",
		"type" => "textarea",
		"std" => "Agent(s) for this listing");
		
		$options[] = array( "name" => "Agent text (for Compare page)",
		"desc" => "Agent text for the Compare listings page",
		"id" => $shortname."_agent_text",
		"type" => "textarea",
		"std" => "Agent");
		
		$options[] = array( "name" => "Agent's Listings text",
		"desc" => "On the Agent's detail page, the heading for the section where the agent's listings are displayed",
		"id" => $shortname."_listings_text",
		"type" => "textarea",
		"std" => "Agents' Listings");
	}
		
	$options[] = array( "name" => "Contact Us sub text",
		"desc" => "Text right under the Contact Us heading following a listing.",
		"id" => $shortname."_contactussubtext",
		"type" => "textarea",
		"std" => "Please call 1.800.123.4567 or you can fill out the form below and we'll get back to you shortly.");
		
	$options[] = array( "name" => "Read More text",
		"desc" => "Text for Read More links and buttons. <br /><br /><span style='color: red;'>For multilanguage sites, enter translations in a SINGLE line, with no line breaks. If you don't, the homepage slideshow will not work.</span>",
		"id" => $shortname."_readmore_text",
		"type" => "textarea",
		"std" => "Details");	
		
		
	$options[] = array( "name" => "Bio and Listing text",
		"desc" => "Text for the button that takes you to the Agent/Sales Rep detail page where there a bio with listings. (listings is for Real Estate site only)",
		"id" => $shortname."_bio_and_listings_text",
		"type" => "textarea",
		"std" => "Bio and Listings");	
		
	$options[] = array( "name" => "Heading text for Videos section",
		"desc" => "Heading text for the optional Videos section in a detail page.",
		"id" => $shortname."_heading_videos",
		"type" => "textarea",
		"std" => "Videos");
		
	$options[] = array( "name" => "Older Entries text",
		"desc" => "Older Entries link text in blog/news results pages",
		"id" => $shortname."_olderentries",
		"type" => "textarea",
		"std" => "Older Entries");
		
	$options[] = array( "name" => "Newer Entries text",
		"desc" => "Newer Entries link text in blog/news results pages",
		"id" => $shortname."_newerentries",
		"type" => "textarea",
		"std" => "Newer Entries");
		
	$options[] = array( "name" => "Comments Closed text",
		"desc" => "",
		"id" => $shortname."_comments_closed_text",
		"type" => "textarea",
		"std" => "Comments are closed");
		
	$options[] = array( "name" => "No Comments text",
		"desc" => "",
		"id" => $shortname."_no_comments_text",
		"type" => "textarea",
		"std" => "No Comments Yet");	
		
	$options[] = array( "name" => "One Comment text",
		"desc" => "",
		"id" => $shortname."_one_comment_text",
		"type" => "textarea",
		"std" => "One Comment");
		
	$options[] = array( "name" => "Comments text",
		"desc" => "",
		"id" => $shortname."_comments_text",
		"type" => "textarea",
		"std" => "Comments");
		
	$options[] = array( "name" => "Login before posting text",
		"desc" => "",
		"id" => $shortname."_login_before_posting_text",
		"type" => "textarea",
		"std" => "You must login before posting.");
		
	$options[] = array( "name" => "Email text",
		"desc" => "Text for 'Email' on the Agents and Sales Reps pages.",
		"id" => $shortname."_email_text",
		"type" => "textarea",
		"std" => "Email");	
		
if (get_option('wp_site') == "Real Estate") {		
		$options[] = array( "name" => "'Other listings' text",
			"desc" => "Text for an agent's 'Other Listings'.",
			"id" => $shortname."_otherlistings",
			"type" => "textarea",
			"std" => "Other listings");
			
		$options[] = array( "name" => "Agent 'email' text",
			"desc" => "Label text for 'Email' for an Agent contact info.",
			"id" => $shortname."_agentemail",
			"type" => "textarea",
			"std" => "Email");
			
		$options[] = array( "name" => "Agent 'office phone' text",
			"desc" => "Label text for 'office phone number' for an Agent contact info.",
			"id" => $shortname."_agentphone1",
			"type" => "textarea",
			"std" => "Office");	
			
		$options[] = array( "name" => "Agent 'mobile phone' text",
			"desc" => "Label text for 'mobile phone number' for an Agent contact info.",
			"id" => $shortname."_agentphone2",
			"type" => "textarea",
			"std" => "Mobile");	
			
		$options[] = array( "name" => "Agent 'fax' text",
			"desc" => "Label text for 'fax number' for an Agent contact info.",
			"id" => $shortname."_agentfax",
			"type" => "textarea",
			"std" => "Fax");
}


if (get_option('wp_site') == "Car Sales") {	
		$options[] = array( "name" => "Sales Rep 'email' text",
			"desc" => "Label text for 'Email' for an Sales Rep contact info.",
			"id" => $shortname."_salesrepemail",
			"type" => "textarea",
			"std" => "Email");
			
		$options[] = array( "name" => "Sales Rep 'office phone' text",
			"desc" => "Label text for 'office phone number' for an Sales Rep contact info.",
			"id" => $shortname."_salesrepphone1",
			"type" => "textarea",
			"std" => "Office");	
			
		$options[] = array( "name" => "Sales Rep 'mobile phone' text",
			"desc" => "Label text for 'mobile hone number' for an Sales Rep contact info.",
			"id" => $shortname."_salesrepphone2",
			"type" => "textarea",
			"std" => "Mobile");	
			
		$options[] = array( "name" => "Sales Rep 'fax' text",
			"desc" => "Label text for 'fax number' for an Sales Rep contact info.",
			"id" => $shortname."_salesrepfax",
			"type" => "textarea",
			"std" => "Fax");
}
		
	$options[] = array( "name" => "'Back to top' links",
		"desc" => "Text for 'Back to Top' links.",
		"id" => $shortname."_top",
		"type" => "textarea",
		"std" => "Back to Top");
		
	$options[] = array( "name" => "'Print Listing' text",
		"desc" => "Text for the 'Print Listing' tooltip when you mouse over the print icon.",
		"id" => $shortname."_print_text",
		"type" => "textarea",
		"std" => "Print Listing");
		
	$options[] = array( "name" => "'Archives by Year' text",
		"desc" => "Text for 'Archives by Year' on the optional Archives page. (To make this page, create a Page, and use the 'Archives' Page Template.",
		"id" => $shortname."_archivesbyyear_text",
		"type" => "textarea",
		"std" => "Archives by Year");	
		
	$options[] = array( "name" => "'Archives by Month' text",
		"desc" => "Text for 'Archives by Month' on the optional Archives page. (To make this page, create a Page, and use the 'Archives' Page Template.",
		"id" => $shortname."_archivesbymonth_text",
		"type" => "textarea",
		"std" => "Archives by Month");			
		

	$options[] = array( "name" => "'Archives by Category' text",
		"desc" => "Text for 'Archives by Category' on the optional Archives page. (To make this page, create a Page, and use the 'Archives' Page Template.",
		"id" => $shortname."_archivesbycategory_text",
		"type" => "textarea",
		"std" => "Archives by Category");	


	$options[] = array( "name" => "'Archives by Pages' text",
		"desc" => "Text for 'Archives by Pages' on the optional Archives page. (To make this page, create a Page, and use the 'Archives' Page Template.",
		"id" => $shortname."_archivesbypages_text",
		"type" => "textarea",
		"std" => "Archives by Pages");	

	$options[] = array( "name" => "'Archives by Tags' text",
		"desc" => "Text for 'Archives by Tags' on the optional Archives page. (To make this page, create a Page, and use the 'Archives' Page Template.",
		"id" => $shortname."_archivesbytags_text",
		"type" => "textarea",
		"std" => "Archives by Tags");	
		
	$options[] = array( "name" => "'Price Descending' text",
		"desc" => "Price descending text for Ordering dropdown",
		"id" => $shortname."_price_descending",
		"type" => "textarea",
		"std" => "Price Descending");

	$options[] = array( "name" => "'Price Ascending' text",
		"desc" => "Price ascending text for Ordering dropdown",
		"id" => $shortname."_price_ascending",
		"type" => "textarea",
		"std" => "Price Ascending");	

	$options[] = array( "name" => "'Date Descending' text",
		"desc" => "Date descending text for Ordering dropdown",
		"id" => $shortname."_date_descending",
		"type" => "textarea",
		"std" => "Date Descending");

	$options[] = array( "name" => "'Date Ascending' text",
		"desc" => "Date ascending text for Ordering dropdown",
		"id" => $shortname."_date_ascending",
		"type" => "textarea",
		"std" => "Date Ascending");	


if (get_option('wp_site') == "Car Sales") {	
		
	$options[] = array( "name" => "'Model Year Descending' text",
		"desc" => "Model Year descending text for Ordering dropdown",
		"id" => $shortname."_modelyear_descending",
		"type" => "textarea",
		"std" => "Model Year Descending");

	$options[] = array( "name" => "'Model Year Ascending' text",
		"desc" => "Model Year ascending text for Ordering dropdown",
		"id" => $shortname."_modelyear_ascending",
		"type" => "textarea",
		"std" => "Model Year Ascending");		
		
	$options[] = array( "name" => "'Mileage Descending' text",
		"desc" => "Mileage descending text for Ordering dropdown",
		"id" => $shortname."_mileage_descending",
		"type" => "textarea",
		"std" => "Mileage Descending");

	$options[] = array( "name" => "'Mileage Ascending' text",
		"desc" => "Mileage ascending text for Ordering dropdown",
		"id" => $shortname."_mileage_ascending",
		"type" => "textarea",
		"std" => "Mileage Ascending");
}	



	





	










	
$options[] = array( "name" => "Search",
					"type" => "heading");	
					
					
		$options[] = array( "name" => "Results per page",
							"desc" => "How many search results per page?",
							"id" => $shortname."_searchresultsperpage",
							"type" => "text",
							"std" => "9");

/* ************************************* */
/* HOUSES ******************************** */
/* ************************************* */

if (get_option('wp_site') == "Real Estate") {	

		$options[] = array( "name" => "Search Results Order",
				"desc" => "How do you want your search results ordered by default? (The user will be able to change this on the site front end)",
				"id" => $shortname."_searchorder",
				"type" => "select",
				"options" => array('Price Descending', 'Price Ascending', 'Date Descending', 'Date Ascending'),
				"std" => "Price Descending");
							
		$options[] = array( "name" => "Primary Search Location Items (for search box)",
				"desc" => "Enter items for the Primary Search Location (first level).  Each item on new line. It defaults to U.S. States. But you could change it to regions, cities, etc.  Optionally you can add Secondary location items.  You enable it with the 'Enable Secondary location items' setting below. <span styl>Make sure there are no blank lines at the end</span>",
				"id" => $shortname."_location_level1",
				"type" => "textarea",
				"std" => "California\nPennsylvania\nNew York");
				
			
		$options[] = array( "name" => "Enable Secondary Location Search Dropdown",
				"desc" => "For searching by location, enable this if you want a secondary level dropdown menu with more specific locations.  For example, if the country is USA, the primary location defaults to 'States'.  If this setting is enabled, then when a state is selected, a secondary dropdown menu will appear with a list of 'Cities' in that state.  It can be anything you want, not just Cities. Please see documentation for details.",
				"id" => $shortname."_secondary_location",
				"type" => "select",
				"options" => array("Enable", "Disable"),
				"std" => "Enable");
			

		$options[] = array( "name" => "Property Types (for the search, if included)",
				"desc" => "Enter the property types.  This will be used for Search Criteria. <strong>(one on each line with no blank lines)</strong><br /><br /><span style='color: red;'>For Multilanguage sites, translate each Property Type here like this:<br /><br />Single Family:en<br />Casa Unifamiliar:es<br />Apartment:en<br />Apartamento:es</span>",
				"id" => $shortname."_propertytype",
				"type" => "textarea",
				"std" => "Single Family\nTownhome\nCondo\nApartment");
			
			
		$options[] = array( "name" => "Price Levels (for Buy)",
				"desc" => "Price levels for non-rentals (for min/max price dropdowns in the Search) <strong>(one on each line with no blank lines)</strong>",
				"id" => $shortname."_price",
				"type" => "textarea",
				"std" => "50000\n75000\n100000\n150000\n200000\n250000\n300000\n350000\n400000\n450000\n500000\n600000\n700000\n800000\n900000\n1000000\n1500000\n2000000\n2500000\n5000000\n10000000\n15000000\n20000000");	
			
		$options[] = array( "name" => "Price Levels (for Rentals)",
				"desc" => "Price levels for rentals (for min/max price dropdowns in the Search) <strong>(one on each line with no blank lines)</strong> This is applicable only if you enable the 'buy or rent' search dropdown. (See setting further above)",
				"id" => $shortname."_price2",
				"type" => "textarea",
				"std" => "100\n200\n300\n400\n500\n600\n700\n800\n900\n1000\n1100\n1200\n1300\n1400\n1500\n1600\n1700\n1800\n1900\n2000");
			
		$options[] = array( "name" => "Size levels (for property size and lot size dropdowns in ssearch, if included)",
				"desc" => "Size levels for the optional Size dropdown in the search. Used for both property size and lot size. <strong>(one on each line with no blank lines)</strong>",
				"id" => $shortname."_size",
				"type" => "textarea",
				"std" => "1000\n2000\n3000\n4000\n5000\n6000\n7000\n8000\n9000\n10000");
			
		$options[] = array( "name" => "Year levels (for 'Year Built' dropdown in search, if included)",
				"desc" => "Year levels for the optional Year Built dropdown in the search. <strong>(one on each line with no blank lines)</strong>",
				"id" => $shortname."_year",
				"type" => "textarea",
				"std" => "1950\n1955\n1960\n1965\n1970\n1975\n1980\n1985\n1990\n1995\n2000\n2005\n2010");


				
		$options[] = array( "name" => "Search for Location",
				"desc" => "",
				"id" => $shortname . "_search_location",
				"std" => "Yes",
				"type" => "select",
				"options" => array("Yes", "No")
				);
							
		$options[] = array( "name" => "Search for Buy/Rent",
				"desc" => "",
				"id" => $shortname . "_search_bor",
				"std" => "Yes",
				"type" => "select",
				"options" => array("Yes", "No")
				);
							
		$options[] = array( "name" => "Search for Beds",
				"desc" => "",
				"id" => $shortname . "_search_beds",
				"std" => "Yes",
				"type" => "select",
				"options" => array("Yes", "No")
				);

		$options[] = array( "name" => "Search for Baths",
				"desc" => "",
				"id" => $shortname . "_search_baths",
				"std" => "Yes",
				"type" => "select",
				"options" => array("Yes", "No")
				);
			
		$options[] = array( "name" => "Search for Min/Max Price",
				"desc" => "",
				"id" => $shortname . "_search_price",
				"std" => "Yes",
				"type" => "select",
				"options" => array("Yes", "No")
				);	
			
		$options[] = array( "name" => "Search for Property Type",
				"desc" => "",
				"id" => $shortname . "_search_propertytype",
				"std" => "Yes",
				"type" => "select",
				"options" => array("Yes", "No")
				);	
							
		$options[] = array( "name" => "Search for Residential/Commercial",
				"desc" => "",
				"id" => $shortname . "_search_resorcomm",
				"std" => "No",
				"type" => "select",
				"options" => array("No", "Yes")
				);					
							
		$options[] = array( "name" => "Search for Openhouses",
				"desc" => "",
				"id" => $shortname . "_search_openhouse",
				"std" => "No",
				"type" => "select",
				"options" => array("No", "Yes")
				);						
							
		$options[] = array( "name" => "Search for Year Built",
				"desc" => "",
				"id" => $shortname . "_search_yearbuilt",
				"std" => "No",
				"type" => "select",
				"options" => array("No", "Yes")
				);						
							
		$options[] = array( "name" => "Search for Size",
				"desc" => "",
				"id" => $shortname . "_search_size",
				"std" => "No",
				"type" => "select",
				"options" => array("No", "Yes")
				);						
				
		$options[] = array( "name" => "Search for Lot Size",
				"desc" => "",
				"id" => $shortname . "_search_lotsize",
				"std" => "No",
				"type" => "select",
				"options" => array("No", "Yes")
				);						
						
		$options[] = array( "name" => "Search for Garage Spaces",
				"desc" => "",
				"id" => $shortname . "_search_garagespaces",
				"std" => "No",
				"type" => "select",
				"options" => array("No", "Yes")
				);		
			
							
		$options[] = array( "name" => "Search for MLS",
				"desc" => "",
				"id" => $shortname . "_search_mls",
				"std" => "No",
				"type" => "select",
				"options" => array("No", "Yes")
				);						
}	

/* ************************************* */
/* CARS ******************************** */
/* ************************************* */
				
if (get_option('wp_site') == "Car Sales") {

	$options[] = array( "name" => "Search Results Order",
		"desc" => "How do you want your search results ordered by default? (The user will be able to change this on the site front end)",
		"id" => $shortname."_searchorder",
		"type" => "select",
		"options" => array('Price Descending', 'Price Ascending', 'Date Descending', 'Date Ascending', 'Mileage Descending', 'Mileage Ascending', 'Model Year Descending', 'Model Year Ascending'),
		"std" => "Price Descending");
		
	$options[] = array( "name" => "Manufacturers (for search box)",
	"desc" => "Enter list of possible manufacturers.  Each item on new line.",
	"id" => $shortname."_manufacturer_level1",
	"type" => "textarea",
	"std" => "Ford\nToyota\nMazda\nHonda\nPorsche");
	
	$options[] = array( "name" => "Enable Model Dropdown in search",
	"desc" => "Enable this if you want a secondary level dropdown menu with specific models.  If this setting is enabled, then when a manufacturer is selected, a secondary dropdown menu will appear with a list of model names from that manufacturer.  You will need to create a text file for each manufacturer, and put them in the /models directory. Please see documentation for details.",
	"id" => $shortname."_secondary_manufacturer",
	"type" => "select",
	"options" => array("Enable", "Disable"),
	"std" => "Enable");
	
	$options[] = array( "name" => "Body Types",
	"desc" => "Enter the body types.  This will be used for Search Criteria. You can customize this list in Theme Options. (one on each line with no blank lines)<br /><br /><span style='color: red;'>For Multilanguage sites, translate each bodytype here like this:<br /><br />Sports:en<br />coche deportivo:es<br />Convertible:en<br />camion:es</span>",
	"id" => $shortname."_bodytype",
	"type" => "textarea",
	"std" => "Sports\nSUV\nMinivan/Van\nWagon\nCrossover\nSedan\nConvertible\nLuxury\nHatchback\nTruck\nCoupe");
	
	$options[] = array( "name" => "Fuel Types",
		"desc" => "Enter a list of fuel types (one on each line with no blank lines)<br /><br /><span style='color: red;'>For Multilanguage sites, translate each Fuel Type here like this:<br /><br />gas:en<br />gasolina:es<br />diesel:en<br />diesel:es</span>",
		"id" => $shortname."_fueltypes",
		"type" => "textarea",
		"std" => "Gas\nDiesel\nElectric\nHybrid");	
		
	$options[] = array( "name" => "Transmissions",
		"desc" => "Enter a list of transmission choices for the Transmission dropdown in the Search (one on each line with no blank lines)<br /><br /><span style='color: red;'>For Multilanguage sites, translate each Transmission Type here like this:<br /><br />automatic:en<br />automatico:es<br />manual:en<br />manual:es</span>",
		"id" => $shortname."_transmission",
		"type" => "textarea",
		"std" => "Automatic\nManual\nSemi-Auto\nOther");	
	
	$options[] = array( "name" => "Price Levels",
	"desc" => "Price levels (for min/max price dropdowns in the Search) (one on each line with no blank lines)",
	"id" => $shortname."_price",
	"type" => "textarea",
	"std" => "1000\n1500\n2000\n2500\n3000\n3500\n4000\n4500\n5000\n5500\n6000\n6500\n7000\n7500\n8000\n8500\n9000\n9500\n10000\n15000\n20000\n30000\n40000\n50000\n75000\n100000");
	
	
	$options[] = array( "name" => "Engine Sizes",
		"desc" => "Enter a list of engine sizes (one on each line with no blank lines)",
		"id" => $shortname."_enginesizes",
		"type" => "textarea",
		"std" => "0.5\n0.6\n0.7\n0.8\n0.9\n1.0\n1.1\n1.2\n1.3\n1.4\n1.5\n1.6\n1.7\n1.8\n1.9\n2.0\n2.1\n2.2\n2.3\n2.4\n2.5\n2.6\n2.7\n2.8\n2.9\n3.0\n3.1\n3.2\n3.3\n3.4\n3.5\n3.6\n3.7\n3.8\n3.9\n4.0\n4.1\n4.2\n4.3\n4.4\n4.5\n4.6\n4.7\n4.8");
		

		
	$options[] = array( "name" => "Mileage Intervals",
		"desc" => "Enter a list of mileage levels for the mileage dropdown in the Search (one on each line with no blank lines)",
		"id" => $shortname."_mileagelevels",
		"type" => "textarea",
		"std" => "5000\n10000\n20000\n30000\n40000\n50000\n60000\n70000\n80000\n90000\n100000");

	$options[] = array( "name" => "Model Year Intervals",
		"desc" => "Enter a list of model year levels for the Model Year dropdown in the Search (one on each line with no blank lines)",
		"id" => $shortname."_yearlevels",
		"type" => "textarea",
		"std" => "2009\n2008\n2007\n2006\n2005\n2000\n1995\n1990\n1985\n1980");	
		
		
	$options[] = array( "name" => "Dealer Locations",
	"desc" => "Enter optional dealer locations (city/town names). Leave this blank if you are a single dealership.",
	"id" => $shortname."_dealerlocations",
	"type" => "textarea",
	"std" => "");
	
	
	
	

		$options[] = array( "name" => "Search for Manufacturer",
							"desc" => "",
							"id" => $shortname . "_search_manufacturer",
							"std" => "Yes",
							"type" => "select",
							"options" => array("Yes", "No")
							);	
							
		$options[] = array( "name" => "Search for Min/Max Price",
							"desc" => "",
							"id" => $shortname . "_search_price",
							"std" => "Yes",
							"type" => "select",
							"options" => array("Yes", "No")
							);		
							
		$options[] = array( "name" => "Search for Body Type",
							"desc" => "",
							"id" => $shortname . "_search_bodytype",
							"std" => "Yes",
							"type" => "select",
							"options" => array("Yes", "No")
							);	
							
		$options[] = array( "name" => "Search for Model Year",
							"desc" => "",
							"id" => $shortname . "_search_modelyear",
							"std" => "Yes",
							"type" => "select",
							"options" => array("Yes", "No")
							);	
		$options[] = array( "name" => "Search for Mileage",
							"desc" => "",
							"id" => $shortname . "_search_mileage",
							"std" => "Yes",
							"type" => "select",
							"options" => array("Yes", "No")
							);	
							
		$options[] = array( "name" => "Search for Transmission",
							"desc" => "",
							"id" => $shortname . "_search_transmission",
							"std" => "No",
							"type" => "select",
							"options" => array("No", "Yes")
							);	
							
							
		$options[] = array( "name" => "Search for Engine Size",
							"desc" => "",
							"id" => $shortname . "_search_enginesize",
							"std" => "No",
							"type" => "select",
							"options" => array("No", "Yes")
							);	
							
							
		$options[] = array( "name" => "Search for Fuel Type",
							"desc" => "",
							"id" => $shortname . "_search_fueltype",
							"std" => "No",
							"type" => "select",
							"options" => array("No", "Yes")
							);	

		$options[] = array( "name" => "Search for Dealer Location",
							"desc" => "",
							"id" => $shortname . "_search_dealerlocation",
							"std" => "No",
							"type" => "select",
							"options" => array("No", "Yes")
							);		
}
	
	
	

	
	
	
	
	
	
	
	

$options[] = array( "name" => "Hide or Show stuff",
	"type" => "heading");
	
$options[] = array( "name" => "Include 'Browse By'",
	"desc" => "Do you want to include the 'Browse By' feature? (This is grouped along with the search)",
	"id" => $shortname."_includebrowseby",
	"type" => "select",
	"options" => array("Yes", "No"),
	"std" => "Yes");
	
$options[] = array( "name" => "Show sub menu in header?",
	"desc" => "Small menu bar at very top right of header. Be sure to create this menu in Appearance -> Menus. Note: The 'login/logout' feature is in this menu bar. If you enable the feature, it will show the menu bar even if this setting is set to hide.",
	"id" => $shortname."_headersubmenu",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
	
$options[] = array( "name" => "Show Social Links Bar (Homepage)",
	"desc" => "On the homepage, do you want to show social networking links? (Twitter, LinkedIn, Facebook, and RSS)",
	"id" => $shortname."_showsociallinks1",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");

$options[] = array( "name" => "Show Social Links Bar (Listing Page)",
	"desc" => "At the end of each post, do you want social networking links? (Twitter, StumbleUpon, Reddit, Digg, Delicious, and Facebook)",
	"id" => $shortname."_showsociallinks2",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
$options[] = array( "name" => "Show Search?",
	"desc" => "Do you want to show the Search?",
	"id" => $shortname."_showsearch",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	

$options[] = array( "name" => "Show loan calculator (homepage)?",
	"desc" => "Do you want to show the Loan Calculator in the homepage?",
	"id" => $shortname."_loancalculator1",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
	
$options[] = array( "name" => "Show loan calculator (subpage sidebar)?",
	"desc" => "Do you want to show the Loan Calculator in left sidebar of every subpage?",
	"id" => $shortname."_loancalculator2",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
$options[] = array( "name" => "Show 'Compare' checkbox?",
	"desc" => "Do you want to show 'Compare' checkbox on search results and Browse By pages?",
	"id" => $shortname."_compare",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
$options[] = array( "name" => "Show comments form on Listing detail pages?",
	"desc" => "Do you want to show the comments form on the listing detail pages?",
	"id" => $shortname."_showcomments_listing",
	"type" => "select",
	"options" => array("hide", "show"),
	"std" => "hide");
	
$options[] = array( "name" => "Show comments form on blog/news posts?",
	"desc" => "Do you want to show the comments form on the blog/news posts?",
	"id" => $shortname."_showcomments",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
	
	
	
		/* $options[] = array( "name" => "Show Address",
		"desc" => "Do you want to show the property 'address' throughout the site? You may not want viewers to know the exact address of a listing.",
		"id" => $shortname."_showaddress",
		"type" => "select",
		"options" => array("show", "hide"),
		"std" => "show");	*/
		
if (get_option('wp_site') == "Real Estate") {		
		$options[] = array( "name" => "Show results map?",
		"desc" => "Do you want to show a Map of the results when you do a search, and when browsing listings?",
		"id" => $shortname."_showmap",
		"type" => "select",
		"options" => array("show", "hide"),
		"std" => "show");	
		
		
		$options[] = array( "name" => "Show Street View?",
		"desc" => "Do you want to show Google Street View on your listing pages? \n\nIf Street View isn't available for the property, then a standard Google Map will be displayed. Unfortunately there will also be the standard map on the page also. You can hide Street View (when there is no Street View available) by choosing the option in the Property Listing post.",
		"id" => $shortname."_show_sv",
		"type" => "select",
		"options" => array("show", "hide"),
		"std" => "show");
		
		$options[] = array( "name" => "Show MLS number in the title of a listing?",
			"desc" => "Show MLS number after the title text in the listing detail page.",
			"id" => $shortname."_showmls",
			"type" => "select",
			"options" => array("show", "hide"),
			"std" => "show");
		}	
		
		
if (get_option('wp_site') == "Car Sales") {	
		$options[] = array( "name" => "Show VinQuery tab in Theme Options",
			"desc" => "If you will be using the VinQuery.com service to pull in VIN data into the detail page, then you will want to show this.<br /><br />Note: Reload this page after choosing this option.",
			"id" => $shortname."_showvinquery",
			"type" => "select",
			"options" => array("show", "hide"),
			"std" => "show");
		}

$options[] = array( "name" => "Show Footer?",
	"desc" => "Do you want to show the widgetized big footer area? (above the footer menu)",
	"id" => $shortname."_showfooter",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
/*	
$options[] = array( "name" => "Show search box in menu bar?",
	"desc" => "The search box in the menu bar searches blog/news posts. Do you want to show or hide it?",
	"id" => $shortname."_showsearchbox",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");	
	*/
	
$options[] = array( "name" => "Show the 'Related' section?",
	"desc" => "You can show related/similar listings in the detail page.",
	"id" => $shortname."_showrelated",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
	
$options[] = array( "name" => "Show Contact Form",
	"desc" => "Show Contact Form on each listing detail page.",
	"id" => $shortname."_showcontactform",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");



$options[] = array( "name" => "Show blog image",
	"desc" => "Do you want to show large image in individual blog post? The default is 'Hide' because generally you only want to see the large image in portfolio posts, not blog posts.",
	"id" => $shortname."_showblogimage",
	"type" => "select",
	"options" => array("hide", "show"),
	"std" => "show");
	
$options[] = array( "name" => "Show Archives by Year",
	"desc" => "On optional Archives page, do you want to show 'Archives by Year'?",
	"id" => $shortname."_archivesbyyear",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
$options[] = array( "name" => "Show Archives by Month",
	"desc" => "On optional Archives page, do you want to show 'Archives by Month'?",
	"id" => $shortname."_archivesbymonth",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	

$options[] = array( "name" => "Show Archives by Category",
	"desc" => "On optional Archives page, do you want to show 'Archives by Category'?",
	"id" => $shortname."_archivesbycategory",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
$options[] = array( "name" => "Show Archives for All Pages",
	"desc" => "On optional Archives page, do you want to show 'All Pages' archive?",
	"id" => $shortname."_archivesallpages",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
$options[] = array( "name" => "Show Archives by Tag",
	"desc" => "On optional Archives page, do you want to show 'Archives by Tag'?",
	"id" => $shortname."_archivesbytag",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");	
	
	
	
	
	
	



	
	
$options[] = array( "name" => "Slideshow",
                    "type" => "heading");	

if (get_option('wp_site') == "Real Estate") {
	$options[] = array( "name" => "Slideshow Source",
	"desc" => "Do you want the slideshow to show recent listings, simply just chosen photos, or a Google Map?<br /><br /><strong>Recent Listings: </strong> When you post/edit a listing, there is a setting to choose if you want the listing to be in the slideshow. Choose 'Yes' for  the listing to show in the slideshow. <br /><br /><strong>Just Photos:</strong> The photos are taken from the Slideshow Photos post type.  Click 'Add New Slideshow Photo' on the left side of WP Admin. Each post will be a separate slide. Add only one photo if you want just a static image and not an actual slideshow.<br /><br /><strong>Listings on Google Map</strong> A map showing lots of recent listings on a Google Map.",
	"id" => $shortname."_slideshowsource",
	"type" => "select",
	"options" => array("Recent Listings", "Just Photos", "Listings on Google Map"),
	"std" => "Recent Listings");
}

if (get_option('wp_site') == "Car Sales") {					
	$options[] = array( "name" => "Slideshow Source",
	"desc" => "Do you want the slideshow to show recent listings, or simply just chosen photos? (the photos are taken from the Slideshow Photos post type.  Click 'Add New Slideshow Photo' to get started. Add only one photo if you want just an image and not an actual slideshow.",
	"id" => $shortname."_slideshowsource",
	"type" => "select",
	"options" => array("Recent Listings", "Just Photos"),
	"std" => "Recent Listings");
}

$options[] = array( "name" => "Slideshow quantity",
	"desc" => "The Maximum number of items to show in the slideshow on the homepage.  This setting is ignored if you have a 'User Defined Slideshow Order' set below.",
	"id" => $shortname."_slideshownumber",
	"type" => "text",
	"std" => "7");


$options[] = array( "name" => "Slideshow Transition",
	"desc" => "Choose the type of slideshow transition",
	"id" => $shortname."_slideshowtransition",
	"type" => "select",
	"options" => array("fade", "chess", "flash", "spiral_reversed", "spiral", "sq_appear", "sq_flyoff", "sq_drop", "sq_squeeze", "sq_random", "sq_diagonal_rev", "sq_diagonal", "sq_fade_random", "sq_fade_diagonal_rev", "sq_fade_diagonal", "explode", "implode", "fountain", "blind_bottom", "blind_top", "blind_right", "blind_left", "shot_right", "shot_left", "alternate_vertical", "alternate_horizontal", "zipper_right", "zipper_left", "bar_slide_random", "bar_slide_bottomright", "bar_slide_topright", "bar_slide_topleft", "bar_fade_bottom", "bar_fade_top", "bar_fade_right", "bar_fade_left", "bar_fade_random", "v_slide_top", "h_slide_right", "v_slide_bottom", "h_slide_left", "stretch", "none"),
	"std" => "fade");

$options[] = array( "name" => "Seconds between slides",
	"desc" => "",
	"id" => $shortname."_seconds",
	"type" => "text",
	"std" => "12");
	
$options[] = array( "name" => "Slideshow layout",
	"desc" => "Choose 'Next to Sidebar' if you want the slideshow to be smaller, and next to the Search and Browse By section.",
	"id" => $shortname . "_slideshowlayout",
	"std" => "",
	"type" => "select",
	"options" => array("Full Width", "Next to Sidebar")
	);



	
	
	
	
	





$options[] = array( "name" => "Browse By",
	"type" => "heading");

$options[] = array( "name" => "'Browse By' Text",
	"desc" => "Text for the heading 'Browse By' in the menu (if included)",
	"id" => $shortname."_browseby_text",
	"type" => "textarea",
	"std" => "Browse By...");

$options[] = array( "name" => "Include 'All Listings'",
	"desc" => "Do you want to include the 'All Listings' item in the Browse By menu item?",
	"id" => $shortname."_includealllistings",
	"type" => "select",
	"options" => array("Yes", "No"),
	"std" => "Yes");
	
$options[] = array( "name" => "'All Listings' Text",
	"desc" => "Text for All Listings",
	"id" => $shortname."_alllistings_text",
	"type" => "textarea",
	"std" => "All Listings");
	
	
$options[] = array( "name" => "Include Browse By 'Features'",
	"desc" => "Do you want to include the 'Features' item in the Browse By menu item?",
	"id" => $shortname."_includefeatures",
	"type" => "select",
	"options" => array("Yes", "No"),
	"std" => "Yes");
	
$options[] = array( "name" => "'Features' Text",
	"desc" => "Text for 'Features' in the Browse By menu",
	"id" => $shortname."_features_text",
	"type" => "textarea",
	"std" => "Features");			
	
if (get_option('wp_site') == "Car Sales") {

	$options[] = array( "name" => "Include Browse By 'Dealer Locations'",
		"desc" => "Do you want to include the 'Dealer Locations' item in the Browse By menu item?",
		"id" => $shortname."_includedealerlocations",
		"type" => "select",
		"options" => array("No", "Yes"),
		"std" => "No");
		
	$options[] = array( "name" => "'Dealer Locations' Text",
		"desc" => "Text for 'Dealer Locations' in the Browse By menu",
		"id" => $shortname."_dealerlocation_text2",
		"type" => "textarea",
		"std" => "Dealer Location");

	$options[] = array( "name" => "Include Browse By 'Body Type'",
		"desc" => "Do you want to include the 'Body Type' item in the Browse By menu item?",
		"id" => $shortname."_includebodytype",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Body Type' Text",
		"desc" => "Text for Body Type in the Browse By menu",
		"id" => $shortname."_bodytype_text2",
		"type" => "textarea",
		"std" => "Body Type");
		
	$options[] = array( "name" => "Include Browse By 'Engine Size'",
		"desc" => "Do you want to include the 'Engine Size' item in the Browse By menu item?",
		"id" => $shortname."_includeenginesize",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Engine Size' Text",
		"desc" => "Text for Engine Size in the Browse By menu",
		"id" => $shortname."_enginesize_text2",
		"type" => "textarea",
		"std" => "Engine Size");
		
	$options[] = array( "name" => "Include Browse By 'Manufacturer'",
		"desc" => "Do you want to include the 'Manufacturer' item in the Browse By menu item?",
		"id" => $shortname."_includemanufacturer",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Manufacturer' Text",
		"desc" => "Text for Manufacturer in the Browse By menu",
		"id" => $shortname."_manufacturer_text2",
		"type" => "textarea",
		"std" => "Manufacturer");	
		
	$options[] = array( "name" => "Include Browse By 'Mileage'",
		"desc" => "Do you want to include the 'Mileage' item in the Browse By menu item?",
		"id" => $shortname."_includemileage",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Mileage' Text",
		"desc" => "Text for 'Mileage' in the Browse By menu",
		"id" => $shortname."_mileage_text2",
		"type" => "textarea",
		"std" => "Mileage");	
		
	$options[] = array( "name" => "Include Browse By 'Model Year'",
		"desc" => "Do you want to include the 'Model Year' item in the Browse By menu item?",
		"id" => $shortname."_includemodelyear",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Model Year' Text",
		"desc" => "Text for 'Model Year' in the Browse By menu",
		"id" => $shortname."_modelyear_text2",
		"type" => "textarea",
		"std" => "Model Year");	
		
	$options[] = array( "name" => "Include Browse By 'Price Range'",
		"desc" => "Do you want to include the 'Price Range' item in the Browse By menu item?",
		"id" => $shortname."_includepricerange",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Price Range' Text",
		"desc" => "Text for 'Price Range' in the Browse By menu",
		"id" => $shortname."_pricerange_text2",
		"type" => "textarea",
		"std" => "Price Range");		
		
	$options[] = array( "name" => "Include Browse By 'Transmission'",
		"desc" => "Do you want to include the 'Transmission' item in the Browse By menu item?",
		"id" => $shortname."_includetransmission",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Transmission' Text",
		"desc" => "Text for 'Transmission' in the Browse By menu",
		"id" => $shortname."_transmission_text2",
		"type" => "textarea",
		"std" => "Transmission");		
}

if (get_option('wp_site') == "Real Estate") {	
	$options[] = array( "name" => "Include Browse By 'Property Type'",
		"desc" => "Do you want to include the 'All Listings' item in the Browse By menu item?",
		"id" => $shortname."_includepropertytype",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Property Type' Text",
		"desc" => "Text for Property Type in the Browse By menu",
		"id" => $shortname."_propertytype_text2",
		"type" => "textarea",
		"std" => "Property Type");
		
	$options[] = array( "name" => "Include Browse By 'Price Range'",
		"desc" => "Do you want to include the 'Price Range' item in the Browse By menu item?",
		"id" => $shortname."_includepricerange",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Price Range' Text",
		"desc" => "Text for Price Range in the Browse By menu",
		"id" => $shortname."_pricerange_text",
		"type" => "textarea",
		"std" => "Price Range");
		
	$options[] = array( "name" => "Include Browse By 'Location'",
		"desc" => "Do you want to include the 'Location' item in the Browse By menu item?",
		"id" => $shortname."_includelocation",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Location' Text",
		"desc" => "Text for Location in the Browse By menu",
		"id" => $shortname."_location_text2",
		"type" => "textarea",
		"std" => "Location");	
		
	$options[] = array( "name" => "Include Browse By 'Rent or Buy'",
		"desc" => "Do you want to include the 'Rent or Buy' item in the Browse By menu item?",
		"id" => $shortname."_includerentorbuy",
		"type" => "select",
		"options" => array("Yes", "No"),
		"std" => "Yes");
		
	$options[] = array( "name" => "'Rent or Buy' Text",
		"desc" => "Text for 'Rent or Buy' in the Browse By menu",
		"id" => $shortname."_rentorbuy_text2",
		"type" => "textarea",
		"std" => "Rent or Buy");
}
	


	


	
	
	
	
	
	
$options[] = array( "name" => "Social Networking",
                    "type" => "heading");
					
$options[] = array( "name" => "Social Network 1",
	"desc" => "Choose a social network that you want to include. The icon will appear in the site header.",
	"id" => $shortname."_socialnetwork1",
	"type" => "select",
	"options" => array("Facebook", "Twitter", "Google+", "Linked In", "Flickr", "YouTube", "Pinterest", "[NOTHING]"),
	"std" => "Facebook");	
	
$options[] = array( "name" => "Social Network 2",
	"desc" => "Choose a social network that you want to include. The icon will appear in the site header.",
	"id" => $shortname."_socialnetwork2",
	"type" => "select",
	"options" => array("Twitter", "Facebook", "Google+", "Linked In", "Flickr", "YouTube", "Pinterest", "[NOTHING]"),
	"std" => "Twitter");	
	
$options[] = array( "name" => "Social Network 3",
	"desc" => "Choose a social network that you want to include. The icon will appear in the site header.",
	"id" => $shortname."_socialnetwork3",
	"type" => "select",
	"options" => array("Google+", "Twitter", "Facebook+", "Linked In", "Flickr", "YouTube", "Pinterest", "[NOTHING]"),
	"std" => "Google+");		
	
$options[] = array( "name" => "Social Network 4",
	"desc" => "Choose a social network that you want to include. The icon will appear in the site header.",
	"id" => $shortname."_socialnetwork4",
	"type" => "select",
	"options" => array("Linked In", "Twitter", "Google+", "Facebook", "Flickr", "YouTube", "Pinterest", "[NOTHING]"),
	"std" => "Linked In");	
	
$options[] = array( "name" => "Social Network 5",
	"desc" => "Choose a social network that you want to include. The icon will appear in the site header.",
	"id" => $shortname."_socialnetwork5",
	"type" => "select",
	"options" => array("Flickr", "Twitter", "Google+", "Linked In", "Facebook", "YouTube", "Pinterest", "[NOTHING]"),
	"std" => "Flickr");	
	
$options[] = array( "name" => "Social Network 6",
	"desc" => "Choose a social network that you want to include. The icon will appear in the site header.",
	"id" => $shortname."_socialnetwork6",
	"type" => "select",
	"options" => array("YouTube", "Twitter", "Google+", "Linked In", "Flickr", "Facebook", "Pinterest", "[NOTHING]"),
	"std" => "Youtube");	
	
$options[] = array( "name" => "Social Network 7",
	"desc" => "Choose a social network that you want to include. The icon will appear in the site header.",
	"id" => $shortname."_socialnetwork7",
	"type" => "select",
	"options" => array("Pinterest", "Twitter", "Google+", "Linked In", "Flickr", "Facebook", "YouTube", "[NOTHING]"),
	"std" => "Youtube");

	
	
	
$options[] = array( "name" => "Facebook Page URL",
	"desc" => "URL to your Facebook profile or Fan page",
	"id" => $shortname."_facebookpage",
	"type" => "text",
	"std" => "");	
	
$options[] = array( "name" => "Facebook Tooltip",
	"desc" => "Facebook tooltip for homepage",
	"id" => $shortname."_facebooktooltip1",
	"type" => "textarea",
	"std" => "Follow us on Facebook");	
	

	
	
	
$options[] = array( "name" => "Twitter Username",
	"desc" => "Your Twitter Username (to be used on homepage Twitter button)",
	"id" => $shortname."_twitterusername",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => "Twitter Tooltip",
	"desc" => "Twitter tooltip for homepage",
	"id" => $shortname."_twittertooltip1",
	"type" => "textarea",
	"std" => "Follow us on Twitter");	
	
	
	
	
	
$options[] = array( "name" => "Google+ Page URL",
	"desc" => "URL to your Google+ profile",
	"id" => $shortname."_googlepluspage",
	"type" => "text",
	"std" => "");	
	
$options[] = array( "name" => "Google+ Tooltip",
	"desc" => "Google+ tooltip for homepage",
	"id" => $shortname."_googleplustooltip",
	"type" => "textarea",
	"std" => "Follow us on Google+");	
	
	
	
	
	
$options[] = array( "name" => "LinkedIn URL",
	"desc" => "URL to your LinkedIn page/profile",
	"id" => $shortname."_linkedin",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => "LinkedIn Tooltip",
	"desc" => "LinkedIn Tooltip text for homepage",
	"id" => $shortname."_linkedintooltip",
	"type" => "textarea",
	"std" => "Our Linkedin Page");	
	


$options[] = array( "name" => "Pinterest User Name",
	"desc" => "Your Pinterest user name",
	"id" => $shortname."_pinterest",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => "Pinterest Tooltip",
	"desc" => "Pinterest Tooltip text for homepage",
	"id" => $shortname."_pinteresttooltip",
	"type" => "textarea",
	"std" => "Follow us on Pinterest");		
	
	

	
	
$options[] = array( "name" => "Flickr Page URL",
	"desc" => "URL to your Flickr page",
	"id" => $shortname."_flickrpage",
	"type" => "text",
	"std" => "");	
	
$options[] = array( "name" => "Flickr Tooltip",
	"desc" => "Flickr tooltip for homepage",
	"id" => $shortname."_flickrtooltip",
	"type" => "textarea",
	"std" => "Our Flickr Page");
	
	
	
$options[] = array( "name" => "YouTube Page URL",
	"desc" => "URL to your YouTube page",
	"id" => $shortname."_youtubepage",
	"type" => "text",
	"std" => "");	
	
$options[] = array( "name" => "YouTube Tooltip",
	"desc" => "YouTube tooltip for homepage",
	"id" => $shortname."_youtubetooltip",
	"type" => "textarea",
	"std" => "Our YouTube Page");


	
	
$options[] = array( "name" => "RSS Tooltip",
	"desc" => "RSS tooltip for homepage and footer (This setting not applicable in Multilingual mode. Set this text in .mo file along with the qTranslate plugin)",
	"id" => $shortname."_rsstooltip",
	"type" => "textarea",
	"std" => "Get listings with RSS");		
	
	
$options[] = array( "name" => "Facebook 'Like' button code",
	"desc" => "Code for the Facebook 'Like' button. Customize the appearance of this button on this Facebook developer page: <a href='http://developers.facebook.com/docs/reference/plugins/like/'>http://developers.facebook.com/docs/reference/plugins/like/</a><br /></br />Note: this button is shown on the listing detail page and blog/news full pages.",
	"id" => $shortname."_likecode",
	"type" => "textarea",
	"std" => '<div class="fb-like" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false" data-font="arial"></div>');	
	
	
$options[] = array( "name" => "Tweet button code",
	"desc" => "Code for the Tweet button. Customize the appearance of this button on this Twitter developer page: <a href='http://twitter.com/about/resources/buttons#tweet'>http://twitter.com/about/resources/buttons#tweet/</a>.<br /></br />Note: this button is shown on the listing detail page and blog/news full pages.",
	"id" => $shortname."_tweetcode",
	"type" => "textarea",
	"std" => '<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>');
	
	
$options[] = array( "name" => "Google +1 button code",
	"desc" => "Code for the Google +1 button. Customize the appearance of this button on this Google Plus developer page: <a href='https://developers.google.com/+/plugins/+1button/'>https://developers.google.com/+/plugins/+1button/</a>. Note: Ignore the 'script' code. Only use the div code on the second line. Also, don't change any of the Advanced options settings.<br /></br />Note: this button is shown on the listing detail page and blog/news full pages.",
	"id" => $shortname."_plusonecode",
	"type" => "textarea",
	"std" => '<div class="g-plusone" data-size="medium"></div>');


	
	
	
	
	
	
	
	
	
	
	
	
	
$options[] = array( "name" => "Call To Action section",
	"type" => "heading");
	
	
$options[] = array( "name" => "Show Call to Action section",
	"desc" => "Do you want to show the 'Call to Action' section on the homepage? They are 3 clickable images right under the slideshow. Manage the images and links in the Call to Action tab in Theme Options.",
	"id" => $shortname."_showcalltoaction",
	"type" => "select",
	"options" => array("hide", "show"),
	"std" => "hide");

$options[] = array( "name" => "First block Image",
	"desc" => "Image for the first call to action block",
	"id" => $shortname."_calltoaction_image1",
	"type" => "upload",
	"std" => "");
	
$options[] = array( "name" => "First block Link",
	"desc" => "Link URL for the first call to action block",
	"id" => $shortname."_calltoaction_url1",
	"type" => "text",
	"std" => "");

$options[] = array( "name" => "Second block Image",
	"desc" => "Image for the second call to action block",
	"id" => $shortname."_calltoaction_image2",
	"type" => "upload",
	"std" => "");
	
$options[] = array( "name" => "Second block Link",
	"desc" => "Link URL for the second call to action block",
	"id" => $shortname."_calltoaction_url2",
	"type" => "text",
	"std" => "");
	
$options[] = array( "name" => "Third block Image",
	"desc" => "Image for the third call to action block",
	"id" => $shortname."_calltoaction_image3",
	"type" => "upload",
	"std" => "");
	
$options[] = array( "name" => "Third block Link",
	"desc" => "Link URL for the third call to action block",
	"id" => $shortname."_calltoaction_url3",
	"type" => "text",
	"std" => "");

	
	




	

	
$options[] = array( "name" => "Membership/login",
                    "type" => "heading");

$options[] = array( "name" => "Show Login Form",
	"desc" => "Do you want to show the Login form so people can login to post Listings?<br /><br />Note: The login will appear in the header sub menu bar at the very top of the site. You must add a header 'sub menu' in Appearance -> Menus, in order for the Login/Logout link to appear there. The menu must have at least one menu item inside.",
	"id" => $shortname."_showlogin",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");
	
$options[] = array( "name" => "Login header text 1",
	"desc" => "Header text for Login form when you're not Logged in. Also the text for the Login 'tab' when you're not logged in.",
	"id" => $shortname."_logintext",
	"type" => "textarea",
	"std" => "Login");	
	
$options[] = array( "name" => "Login header text 2",
	"desc" => "Header text for Login form when you ARE Logged in.",
	"id" => $shortname."_controlpaneltext",
	"type" => "textarea",
	"std" => "Control Panel");	

$options[] = array( "name" => "Logout text",
	"desc" => "Text for the Logout link",
	"id" => $shortname."_logouttext",
	"type" => "textarea",
	"std" => "Logout");		
	
$options[] = array( "name" => "Show 'Dashboard' Link?",
	"desc" => "When you're logged in, do you want to show the link that takes you to the wp-admin dashboard?",
	"id" => $shortname."_logindashboard",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");		
	
$options[] = array( "name" => "Dashboard link text",
	"desc" => "Link text for the Dashboard link",
	"id" => $shortname."_logindashboardtext",
	"type" => "textarea",
	"std" => "Dashboard");	

$options[] = array( "name" => "Show 'New Listing' link?",
	"desc" => "When you're logged in, do you want to show the link that takes you to the 'New Listing' page?",
	"id" => $shortname."_loginlisting",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");		

$options[] = array( "name" => "New Listing text",
	"desc" => "Link text for the 'New Listing' link",
	"id" => $shortname."_loginlistingtext",
	"type" => "textarea",
	"std" => "New Listing");	

$options[] = array( "name" => "Show 'New News/Blog' link?",
	"desc" => "When you're logged in, do you want to show the link that takes you to the 'New News/Blog' page?",
	"id" => $shortname."_loginpost",
	"type" => "select",
	"options" => array("show", "hide"),
	"std" => "show");		

$options[] = array( "name" => "New News/Blog text",
	"desc" => "Link text for the 'New News/Blog' link",
	"id" => $shortname."_loginposttext",
	"type" => "textarea",
	"std" => "New News/Blog post");		
	
			
$options[] = array( "name" => "'Username' text",
	"desc" => "Text for 'Username' in the optional login/logout panel in homepage.",
	"id" => $shortname."_username_text",
	"type" => "textarea",
	"std" => "Username");						
				
$options[] = array( "name" => "'Password' text",
	"desc" => "Text for 'Password' in the optional login/logout panel in homepage.",
	"id" => $shortname."_password_text",
	"type" => "textarea",
	"std" => "Password");						
				
$options[] = array( "name" => "'Remember Me' text",
	"desc" => "Text for 'Remember me' in the optional login/logout panel in homepage.",
	"id" => $shortname."_rememberme_text",
	"type" => "textarea",
	"std" => "Remember Me");						
				
$options[] = array( "name" => "'Register' text",
	"desc" => "Text for 'Register' in the optional login/logout panel in homepage.",
	"id" => $shortname."_register_text",
	"type" => "textarea",
	"std" => "Register");						
				
$options[] = array( "name" => "'Recover Password' text",
	"desc" => "Text for 'recover password' in the optional login/logout panel in homepage.",
	"id" => $shortname."_recoverpassword_text",
	"type" => "textarea",
	"std" => "Recover Password");		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	




	
if (get_option('wp_site') == "Car Sales") {

if (get_option('wp_showvinquery') == "show") {
	$options[] = array( "name" => "VINquery Account Info",
						"type" => "heading");	
		
		$options[] = array( "name" => "Access Code",
		"desc" => "VINquery.com 'Access Code'. Get access code after signing up with VINquery.com",
		"id" => $shortname."_accesscode",
		"type" => "text",
		"std" => "");

		$options[] = array( "name" => "Report Type",
		"desc" => "Enter the number for the Report type. 0 is Basic, 1 is standard, 2 is Extended, 3 is Lite.",
		"id" => $shortname."_reporttype",
		"type" => "select",
		"options" => array("0", "1", "2", "3"),
		"std" => "2");
}	
}

	
	
	
	
	
	
	
	
	
	
	
	
$options[] = array( "name" => "Miscellaneous",
                    "type" => "heading");

$options[] = array( "name" => "Placeholder image",
	"desc" => "If you don't have an image uploaded for a listing, use this temporary image. Only used for thumbnails, not as the large image in detail page.",
	"id" => $shortname."_noimage",
	"type" => "upload",
	"std" => "");
	
if (get_option('wp_site') == "Real Estate") {
		$options[] = array( "name" => "Map marker image",
						"desc" => "Upload a custom map marker image, used for the search results page (not in dsIDXpress results). If left blank, a default theme icon will be used.<br /><br />Go here for good collection of free map icons: <a target='_blank' href='http://mapicons.nicolasmollet.com/'>http://mapicons.nicolasmollet.com/</a>",
						"id" => $shortname."_mapmarkerimage",
						"type" => "upload",
						"std" => "");
	}
	
	
	
$options[] = array( "name" => "Alternate logo (when screen size is max 790px wide)",
	"desc" => "",
	"id" => $shortname."_responsivelogo1",
	"type" => "upload",
	"std" => "");

$options[] = array( "name" => "Alternate logo (when screen size is max 420px wide)",
	"desc" => "",
	"id" => $shortname."_responsivelogo2",
	"type" => "upload",
	"std" => "");

$options[] = array( "name" => "Alternate logo (when screen size is max 300px wide)",
	"desc" => "",
	"id" => $shortname."_responsivelogo3",
	"type" => "upload",
	"std" => "");
	
$options[] = array( "name" => "Alternate header image (when screen size is max 790px wide)",
	"desc" => "Make image size 790x170",
	"id" => $shortname."_responsiveheader1",
	"type" => "upload",
	"std" => "");

$options[] = array( "name" => "Alternate header image (when screen size is max 420px wide)",
	"desc" => "Make image size 420x155",
	"id" => $shortname."_responsiveheader2",
	"type" => "upload",
	"std" => "");

$options[] = array( "name" => "Alternate header image (when screen size is max 300px wide)",
	"desc" => "Make image size 300x140",
	"id" => $shortname."_responsiveheader3",
	"type" => "upload",
	"std" => "");



$options[] = array( "name" => "Favicon Image",
	"desc" => "Full URL to your favicon image. Tip: Easy site to create favicon image: http://www.favicon.cc/ ",
	"id" => $shortname."_favicon",
	"type" => "upload",
	"std" => "");
	
if (function_exists('qtrans_getLanguage')) {	
	$options[] = array( "name" => "Position of qTranslate language chooser",
			"desc" => "If you put the  language chooser widget in the suggested widgetized area, it will display in the header. Here you can choose to align it to the left or right of the header.",
			"id" => $shortname."_qtranslatealignment",
			"type" => "select",
			"options" => array('Header Top Left', 'Header Top Right'),
			"std" => "Header Top Left");
			
	$options[] = array( "name" => "Right Position of qTranslate language chooser",
		"desc" => "If the setting above is 'Header Top Right', the position is totally all the way to the right side. You may want to push it to the left a bit if something else is in the way. For example, if you have a secondary logo on the right side of the header, you will want to move the qTranslate language chooser left a bit so it's not in the way.",
		"id" => $shortname."_qtranslaterightoffset",
		"type" => "text",
		"std" => "20");					

	$options[] = array( "name" => "Top position of qTranslate language chooser",
		"desc" => "Top position of the language chooser. Positive number moves it down in pixels. Negative number moves it up.",
		"id" => $shortname."_qtranslatetop",
		"type" => "text",
		"std" => "20");		
}
	
	
if (get_option('wp_site') == "Car Sales") {
		$options[] = array( "name" => "'Browse by' Default Order",
			"desc" => "The default ordering of the 'Browse By' page results. The end user will be able to change to something else.",
			"id" => $shortname."_browse_order",
			"type" => "select",
			"options" => array('Price Descending', 'Price Ascending', 'Mileage Descending', 'Mileage Ascending', 'Model Year Descending', 'Model Year Ascending', 'Date Descending', 'Date Ascending'),
			"std" => "Price Descending");
}	

if (get_option('wp_site') == "Real Estate") {
		$options[] = array( "name" => "'Browse by' Default Order",
			"desc" => "The default ordering of the 'Browse By' page results. The end user will be able to change to something else.",
			"id" => $shortname."_browse_order",
			"type" => "select",
			"options" => array('Price Descending', 'Price Ascending', 'Date Descending', 'Date Ascending'),
			"std" => "Price Descending");
}


$options[] = array( "name" => "Filter out 'Sold' listings",
	"desc" => "There is a setting in each listing where you can set it as 'Sold'. Do you want to filter out all 'Sold' listings from the search, slideshow, Browse By, recent listings, etc.?",
	"id" => $shortname."_filtersold",
	"type" => "select",
	"options" => array('No', 'Yes'),
	"std" => "No");

$options[] = array( "name" => "Number of Related Listings",
	"desc" => "The number of related listings to show on the detail page sidebar (if included)",
	"id" => $shortname."_relatedlistingsnumber",
	"type" => "text",
	"std" => "3");	
	
	
$options[] = array( "name" => "Meta 'Description'",
	"desc" => "Description of the site, used in a description 'meta' tag at the top of every site page. This is good for SEO. For more advanced SEO, use a good plugin like 'All In One SEO'.",
	"id" => $shortname."_metadescription",
	"type" => "textarea",
	"std" => "");
	
$options[] = array( "name" => "Meta 'Keywords'",
	"desc" => "Keywords of the site, used in a keywords 'meta' tag at the top of every site page. This is good for SEO. For more advanced SEO, use a good plugin like 'All In One SEO'.",
	"id" => $shortname."_metakeywords",
	"type" => "textarea",
	"std" => "");	
	
	
$options[] = array( "name" => "Google Analytics Code",
	"desc" => "You can paste your Google Analytics or other tracking code in this box. This will be automatically added to the footer.",
	"id" => $shortname."_ga_code",
	"type" => "textarea",
	"std" => "");	

/*	
	$options[] = array( "name" => "Highlight color text (1)",
	"desc" => "Highlight text color for shortcode of [highlight1]. See Shortcodes section of help for details.",
	"id" => $shortname."_highlight_text1",
	"type" => "textarea",
	"std" => "black");	
	
	$options[] = array( "name" => "Highlight color background (1)",
	"desc" => "Highlight background color for shortcode of [highlight1]. See Shortcodes section of help for details.",
	"id" => $shortname."_highlight_background1",
	"type" => "textarea",
	"std" => "yellow");	
	
	$options[] = array( "name" => "Highlight color text (2)",
	"desc" => "Highlight text color for shortcode of [highlight2]. See Shortcodes section of help for details.",
	"id" => $shortname."_highlight_text2",
	"type" => "textarea",
	"std" => "white");	
	
	$options[] = array( "name" => "Highlight color background (2)",
	"desc" => "Highlight background color for shortcode of [highlight2]. See Shortcodes section of help for details.",
	"id" => $shortname."_highlight_background2",
	"type" => "textarea",
	"std" => "black");	
*/
if (get_option('wp_search') == "Only built-in search" || get_option('wp_search') == "Both" || get_option('wp_site') == "Car Sales" ) {	
	$options[] = array( "name" => "Search Results Page ID",
	"desc" => "ID number for the 'Search Results' page. The theme should automatically retrieve and use the number, but in some rare cases it won't. If the 'Search Results' page isn't working, try entering it in here. (You find out what the ID number is by going to Pages, and mouse over the 'view' button for the post. In the status bar of your browser, you'll see the URL for the page. In the URL you'll see what page ID it has.)",
	"id" => $shortname."_searchresultsid",
	"type" => "text",
	"std" => "");	
	
	$options[] = array( "name" => "Compare Page ID",
	"desc" => "ID number for the 'Compare' page. The theme should automatically retrieve and use the number, but in some rare cases it won't. If the 'Compare' page isn't working, try entering it in here. (You find out what the ID number is by going to Pages, and mouse over the 'view' button for the post. In the status bar of your browser, you'll see the URL for the page. In the URL you'll see what page ID it has.)",
	"id" => $shortname."_compareid",
	"type" => "text",
	"std" => "");	
	
	$options[] = array( "name" => "Search Results Page Fix",
	"desc" => "If when you do a search, the URL of the search result has '/index.php/' in it, then choose 'Yes'. Otherwise, leave it to 'No'. Almost always this will be 'No', but this option is here just in case.",
	"id" => $shortname."_searchresultspagefix",
	"type" => "select",
	"options" => array("No", "Yes"),
	"std" => "No");	
}
	
$options[] = array( "name" => "Demo Mode",
	"desc" => "Always to be 'off'. This is used for the demo of the site on Themeforest. Some descriptive text will appear in varioius places when this setting is 'on'.",
	"id" => $shortname."_demo",
	"type" => "select",
	"options" => array("off", "on"),
	"std" => "off");	
	
$options[] = array( "name" => "For developer only",
	"desc" => "This text area is for the theme developer use only, for testing.",
	"id" => $shortname."_loggedinmessage",
	"type" => "textarea",
	"std" => "");	
	


update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>
