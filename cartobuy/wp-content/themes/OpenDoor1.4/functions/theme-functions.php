<?php

if ( get_magic_quotes_gpc() ) {
    $_POST      = array_map( 'stripslashes_deep', $_POST );
    $_GET       = array_map( 'stripslashes_deep', $_GET );
    $_COOKIE    = array_map( 'stripslashes_deep', $_COOKIE );
    $_REQUEST   = array_map( 'stripslashes_deep', $_REQUEST );
}

// get all of the images attached to the current post
function get_gallery_images() {
	global $post;

	$photos = get_children( array('post_parent' => $post->ID, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );

	$galleryimages = array();

	if ($photos) {
		foreach ($photos as $photo) {
			// get the correct image html for the selected size
			$galleryimages[] = wp_get_attachment_url($photo->ID);
		}
	}
	return $galleryimages;
}

add_filter('widget_text', 'do_shortcode');


function custom_excerpt_length($length)
{
return 15;
}
add_filter('excerpt_length', 'custom_excerpt_length');


//add_filter( 'the_content', 'wpautop' );


			
			
function the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
		echo home_url();
		echo '">';
		bloginfo('name');
		echo "</a> >> ";
		if (is_category() || is_single()) {
			the_category('title_li=');
			if (is_single()) {
				echo " >> ";
				the_title();
			}
		} elseif (is_page()) {
			echo the_title();
		}
	}
}


if (function_exists('qtrans_getLanguage')) {
	function qtranslate_edit_taxonomies(){
	   $args=array(
		  'public' => true ,
		  '_builtin' => false
	   );
	   $output = 'object'; // or objects
	   $operator = 'and'; // 'and' or 'or'

	   $taxonomies = get_taxonomies($args,$output,$operator);

	   if  ($taxonomies) {
		 foreach ($taxonomies  as $taxonomy ) {
			 add_action( $taxonomy->name.'_add_form', 'qtrans_modifyTermFormFor');
			 add_action( $taxonomy->name.'_edit_form', 'qtrans_modifyTermFormFor');
		 }
	   }
	}
	add_action('admin_init', 'qtranslate_edit_taxonomies');
}


 
// Enable recent comments
function recent_comments($src_count=10, $src_length=40, $pre_HTML='<ul>', $post_HTML='</ul>') {
global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type,
SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC
LIMIT $src_count";
$comments = $wpdb->get_results($sql);
$output = $pre_HTML;
foreach ($comments as $comment) {
$output .= "<li><a href=\"" . get_permalink($comment->ID) . "#comment-" . $comment->comment_ID . "\" title=\"on " . $comment->post_title . "\">" . strip_tags($comment->com_excerpt) ."...</a></li>";
}
$output .= $post_HTML;
echo $output;
}


function hexDarker($hex,$factor = 30)
        {
        $new_hex = '';
        
        $base['R'] = hexdec($hex{0}.$hex{1});
        $base['G'] = hexdec($hex{2}.$hex{3});
        $base['B'] = hexdec($hex{4}.$hex{5});
        
        foreach ($base as $k => $v)
                {
                $amount = $v / 100;
                $amount = round($amount * $factor);
                $new_decimal = $v - $amount;
        
                $new_hex_component = dechex($new_decimal);
                if(strlen($new_hex_component) < 2)
                        { $new_hex_component = "0".$new_hex_component; }
                $new_hex .= $new_hex_component;
                }
                
        return $new_hex;        
        }

function hexLighter($hex,$factor = 30)
        {
        $new_hex = '';
        
        $base['R'] = hexdec($hex{0}.$hex{1});
        $base['G'] = hexdec($hex{2}.$hex{3});
        $base['B'] = hexdec($hex{4}.$hex{5});
        
        foreach ($base as $k => $v)
                {
                $amount = 255 - $v;
                $amount = $amount / 100;
                $amount = round($amount * $factor);
                $new_decimal = $v + $amount;
        
                $new_hex_component = dechex($new_decimal);
                if(strlen($new_hex_component) < 2)
                        { $new_hex_component = "0".$new_hex_component; }
                $new_hex .= $new_hex_component;
                }
                
        return $new_hex;        
        }	
		
		
/* 
 * PHP integration for No Spam v1.3
 * by Mike Branski (www.leftrightdesigns.com)
 * mikebranski@gmail.com
 *
 * Copyright (c) 2008 Mike Branski (www.leftrightdesigns.com)
 *
 * NOTE: This script is for integrating your dynamic PHP content with No Script.
 *       Download No Spam at www.leftrightdesigns.com/library/jquery/nospam/
 *
 */
function nospam($email, $filterLevel = 'normal')
{
	$email = strrev($email);
	$email = preg_replace('[@]', '//', $email);
	$email = preg_replace('[\.]', '/', $email);

	if($filterLevel == 'low')
	{
		$email = strrev($email);
	}

	return $email;
}		
	

function browseorder($type, $tax, $term) {
switch ($type) {
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
}


$paged = get_query_var('paged') ? get_query_var('paged') : 1;
    //$wpq = array ('post_type' => 'listing', $tax => $term->slug, paged => $paged, 'meta_key' => $metakey, 'orderby' => $orderby, 'order' => $order, 'post_status' => 'publish', 'posts_per_page' => get_option('wp_searchresultsperpage')) ;
	
	
if (get_option('wp_filtersold') == 'Yes') {	
$wpq = array(
	'post_type' => 'listing',
	$tax => $term->slug,
	'paged' => $paged,
	'meta_key' => $metakey,
	'orderby' => $orderby,
	'order' => $order,
	'post_status' => 'publish',
	'posts_per_page' => get_option('wp_searchresultsperpage'),
	'meta_query' => array(
		array(
			'key' => 'sold_value',
			'value' => 'No'
		)
	)
 );	
} else {
$wpq = array(
	'post_type' => 'listing',
	$tax => $term->slug,
	'paged' => $paged,
	'meta_key' => $metakey,
	'orderby' => $orderby,
	'order' => $order,
	'post_status' => 'publish',
	'posts_per_page' => get_option('wp_searchresultsperpage')
 );	
}
	

	
	
	
	

return $wpq;
}



//------enable post thumbnail preview for custom columns 
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
	// for post and listings
 
	function fb_AddThumbColumn($cols) { 
		$cols['thumbnail'] = __('Thumbnail', 'opendoor'); 
		return $cols;
	}
 
	function fb_AddThumbValue($column_name, $post_id) {
 
			$width = (int) 200;
			$height = (int) 100;
 
 
			if ( 'thumbnail' == $column_name ) {
				// thumbnail of WP 2.9
				$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
				// image from gallery
				$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
				if ($thumbnail_id)
					$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
				elseif ($attachments) {
					foreach ( $attachments as $attachment_id => $attachment ) {
						$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
					}
				}
					if ( isset($thumb) && $thumb ) {
						echo $thumb;
					} else {
						echo __('None', 'opendoor');
					}
			}
	}
 
	// for posts
	add_filter( 'manage_posts_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_posts_custom_column', 'fb_AddThumbValue', 10, 2 );
 
	// for listings
	add_filter( 'manage_listing_columns', 'fb_AddThumbColumn' );
	add_action( 'manage_listing_custom_column', 'fb_AddThumbValue', 10, 2 );
}




//----------------edit custom columns display for back-end 
add_action("manage_posts_custom_column", "my_custom_columns");
add_filter("manage_edit-listing_columns", "my_listing_columns");
 
 
 
if (get_option('wp_site') == "Car Sales") { 
	function my_listing_columns($columns) //this function display the columns headings
	{
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Vehicle Listing",
			"thumbnail" => "Thumbnail",
			"price" => "Price",	
			"bodytype" => "Body Type",
			"mileage" => "Mileage",
			"sold" => "Sold",
			"date" => "Last Updated"
			
		);
		return $columns;
	}
	 
	function my_custom_columns($column){
		global $post;
		switch($column){
			case "price":
				$custom = get_post_custom();
					echo $custom["price_value"][0];
				break;
			 case "bodytype":
				$custom = get_post_custom();
				echo $custom["body_type_value"][0];
				break;
			 case "mileage":
				$custom = get_post_custom();
				echo $custom["mileage_value"][0];
				break;
			 case "sold":
				$custom = get_post_custom();
				echo $custom["sold_value"][0];
				break;
				
		}
	}
}


if (get_option('wp_site') == "Real Estate") { 
	function my_listing_columns($columns) //this function display the columns headings
	{
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Property Listing",
			"thumbnail" => "Thumbnail",
			"price" => "Price",	
			"propertytype" => "Property Type",
			"agent" => "Agent",
			"agent2" => "Agent 2",
			"beds" => "Beds",
			"baths" => "Baths",
			"sold" => "Sold",
			"date" => "Last Updated"
			
		);
		return $columns;
	}
	 
	function my_custom_columns($column){
		global $post;
		switch($column){
			case "price":
				$custom = get_post_custom();
					echo $custom["price_value"][0];
				break;
			 case "propertytype":
				$custom = get_post_custom();
				echo $custom["propertytype_value"][0];
				break;
			 case "agent":
				$custom = get_post_custom();
				echo $custom["agent_value"][0];
				break;
			 case "agent2":
				$custom = get_post_custom();
				echo $custom["agent2_value"][0];
				break;
			 case "beds":
				$custom = get_post_custom();
				echo $custom["beds_value"][0];
				break;
			 case "baths":
				$custom = get_post_custom();
				echo $custom["baths_value"][0];
				break;
			 case "sold":
				$custom = get_post_custom();
				echo $custom["sold_value"][0];
				break;
			
				
		}
	}
}




// determine the topmost parent of a term
function get_term_top_most_parent($term_id, $taxonomy){
    // start from the current term
    $parent  = get_term_by( 'id', $term_id, $taxonomy);
    // climb up the hierarchy until we reach a term with parent = '0'
    while ($parent->parent != '0'){
        $term_id = $parent->parent;

        $parent  = get_term_by( 'id', $term_id, $taxonomy);
    }
    return $parent;
}

function the_top_parents($taxonomy) {
    // get terms for current post
    $terms = get_terms($taxonomy);
	
    // set vars
    $top_parent_terms = array();
	$parent_ids = array();
	
    foreach ( $terms as $term ) {
        //get top level parent
        $top_parent = get_term_top_most_parent( $term->term_id, $taxonomy );
        //check if you have it in your array to only add it once
        if ( !in_array( $top_parent, $top_parent_terms ) ) {
            $top_parent_terms[] = $top_parent;
        }
    }
    // build output (the HTML is up to you)
    foreach ( $top_parent_terms as $term ) {
		$parent_ids[] = $term->term_id;
    }
          
    // return the ids
    return $parent_ids;
}





// Image Resizer script (AquaResizer)

/**
* Title : Aqua Resizer
* Description : Resizes WordPress images on the fly
* Version : 1.1.3
* Author : Syamil MJ
* Author URI : http://aquagraphite.com
* License : WTFPL - http://sam.zoy.org/wtfpl/
* Documentation : https://github.com/sy4mil/Aqua-Resizer/
*
* @param string $url - (required) must be uploaded using wp media uploader
* @param int $width - (required)
* @param int $height - (optional)
* @param bool $crop - (optional) default to soft crop
* @param bool $single - (optional) returns an array if false
* @uses wp_upload_dir()
* @uses image_resize_dimensions()
* @uses image_resize()
*
* @return str|array
*/

function aq_resize( $url, $width, $height = null, $crop = null, $single = true ) {

//validate inputs
if(!$url OR !$width ) return false;

//define upload path & dir
$upload_info = wp_upload_dir();
$upload_dir = $upload_info['basedir'];
$upload_url = $upload_info['baseurl'];

//check if $img_url is local
if(strpos( $url, home_url() ) === false) return false;

//define path of image
$rel_path = str_replace( $upload_url, '', $url);
$img_path = $upload_dir . $rel_path;

//check if img path exists, and is an image indeed
if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;

//get image info
$info = pathinfo($img_path);
$ext = $info['extension'];
list($orig_w,$orig_h) = getimagesize($img_path);

//get image size after cropping
$dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
$dst_w = $dims[4];
$dst_h = $dims[5];

//use this to check if cropped image already exists, so we can return that instead
$suffix = "{$dst_w}x{$dst_h}";
$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

//if orig size is smaller
if($width >= $orig_w) {

if(!$dst_h) :
//can't resize, so return original url
$img_url = $url;
$dst_w = $orig_w;
$dst_h = $orig_h;

else :
//else check if cache exists
if(file_exists($destfilename) && getimagesize($destfilename)) {
$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
}
//else resize and return the new resized image url
else {
$resized_img_path = image_resize( $img_path, $width, $height, $crop );
$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
$img_url = $upload_url . $resized_rel_path;
}

endif;

}
//else check if cache exists
elseif(file_exists($destfilename) && getimagesize($destfilename)) {
$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
}
//else, we resize the image and return the new resized image url
else {
$resized_img_path = image_resize( $img_path, $width, $height, $crop );
$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
$img_url = $upload_url . $resized_rel_path;
}

//return the output
if($single) {
//str return
$image = $img_url;
} else {
//array return
$image = array (
0 => $img_url,
1 => $dst_w,
2 => $dst_h
);
}

return $image;
}



?>