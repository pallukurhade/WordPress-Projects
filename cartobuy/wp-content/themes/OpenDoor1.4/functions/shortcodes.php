<?php 

// SHORT CODES (Columns)
 
add_shortcode("one_quarter_fullwidthtemplate", "one_quarter_fullwidthtemplate");
add_shortcode("one_quarter_first_fullwidthtemplate", "one_quarter_first_fullwidthtemplate"); 
add_shortcode("one_quarter_last_fullwidthtemplate", "one_quarter_last_fullwidthtemplate"); 
 
function one_quarter_fullwidthtemplate($atts, $content = null) {
	return "<div class='four columns columnsbottompadding'>".$content."</div>";
}

function one_quarter_first_fullwidthtemplate($atts, $content = null) {
	return "<div class='four columns alpha columnsbottompadding firstcolumn'>".$content."</div>";
}

function one_quarter_last_fullwidthtemplate($atts, $content = null) {
	return "<div class='four columns omega columnsbottompadding'>".$content."</div>";
}




add_shortcode("one_quarter_sidebartemplate", "one_quarter_sidebartemplate");
add_shortcode("one_quarter_first_sidebartemplate", "one_quarter_first_sidebartemplate"); 
add_shortcode("one_quarter_last_sidebartemplate", "one_quarter_last_sidebartemplate"); 
 
function one_quarter_sidebartemplate($atts, $content = null) {
	return "<div class='three columns columnsbottompadding'>".$content."</div>";
}

function one_quarter_first_sidebartemplate($atts, $content = null) {
	return "<div class='three columns alpha columnsbottompadding firstcolumn'>".$content."</div>";
}

function one_quarter_last_sidebartemplate($atts, $content = null) {
	return "<div class='three columns omega columnsbottompadding'>".$content."</div>";
}



add_shortcode("one_third_first_fullwidthtemplate", "one_third_first_fullwidthtemplate"); 
add_shortcode("one_third_fullwidthtemplate", "one_third_fullwidthtemplate"); 
add_shortcode("one_third_last_fullwidthtemplate", "one_third_last_fullwidthtemplate"); 

add_shortcode("two_thirds_first_fullwidthtemplate", "two_thirds_first_fullwidthtemplate"); 
add_shortcode("two_thirds_last_fullwidthtemplate", "two_thirds_last_fullwidthtemplate"); 

function one_third_first_fullwidthtemplate($atts, $content = null) {
	return "<div class='one-third alpha columnsbottompadding firstcolumn'>".$content."</div>";
}

function one_third_fullwidthtemplate($atts, $content = null) {
	return "<div class='one-third columnsbottompadding'>".$content."</div>";
}

function one_third_last_fullwidthtemplate($atts, $content = null) {
	return "<div class='one-third omega columnsbottompadding'>".$content."</div>";
}

function two_thirds_first_fullwidthtemplate($atts, $content = null) {
	return "<div class='two-thirds alpha columnsbottompadding firstcolumn'>".$content."</div>";
}

function two_thirds_last_fullwidthtemplate($atts, $content = null) {
	return "<div class='two-thirds omega columnsbottompadding'>".$content."</div>";
}




add_shortcode("one_third_first_sidebartemplate", "one_third_first_sidebartemplate"); 
add_shortcode("one_third_sidebartemplate", "one_third_sidebartemplate"); 
add_shortcode("one_third_last_sidebartemplate", "one_third_last_sidebartemplate"); 

add_shortcode("two_thirds_first_sidebartemplate", "two_thirds_first_sidebartemplate"); 
add_shortcode("two_thirds_last_sidebartemplate", "two_thirds_last_sidebartemplate"); 

function one_third_first_sidebartemplate($atts, $content = null) {
	return "<div class='four columns alpha columnsbottompadding firstcolumn'>".$content."</div>";
}

function one_third_sidebartemplate($atts, $content = null) {
	return "<div class='four columns columnsbottompadding'>".$content."</div>";
}

function one_third_last_sidebartemplate($atts, $content = null) {
	return "<div class='four columns omega columnsbottompadding'>".$content."</div>";
}

function two_thirds_first_sidebartemplate($atts, $content = null) {
	return "<div class='eight columns alpha columnsbottompadding firstcolumn'>".$content."</div>";
}

function two_thirds_last_sidebartemplate($atts, $content = null) {
	return "<div class='four columns omega columnsbottompadding'>".$content."</div>";
}




add_shortcode("one_half_first_fullwidthtemplate", "one_half_first_fullwidthtemplate"); 
add_shortcode("one_half_last_fullwidthtemplate", "one_half_last_fullwidthtemplate"); 
add_shortcode("one_half_first_sidebartemplate", "one_half_first_sidebartemplate"); 
add_shortcode("one_half_last_sidebartemplate", "one_half_last_sidebartemplate"); 

function one_half_first_fullwidthtemplate($atts, $content = null) {
	return "<div class='eight columns alpha columnsbottompadding firstcolumn'>".$content."</div>";
}

function one_half_last_fullwidthtemplate($atts, $content = null) {
	return "<div class='eight columns omega columnsbottompadding'>".$content."</div>";
}

function one_half_first_sidebartemplate($atts, $content = null) {
	return "<div class='six columns alpha columnsbottompadding firstcolumn'>".$content."</div>";
}

function one_half_last_sidebartemplate($atts, $content = null) {
	return "<div class='six columns omega columnsbottompadding'>".$content."</div>";
}




// SHORT CODES (Back to Top)

add_shortcode("top", "top");

function top($atts, $content = null) {
	return "<div><a class='top' href='#top'>". get_option('wp_top') ."</a></div>";
}


// SHORT CODES (clear)
add_shortcode("clear", "clear");
function clear($atts, $content = null) {
	return "<div class='clearboth'></div>";
}

// SHORT CODES (dropcap)

add_shortcode("dropcap", "dropcap");
function dropcap($atts, $content = null) {
	return "<span class='dropcap'>".$content."</span>";
}

// SHORT CODES (Button)

add_shortcode("button", "button");
function button($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"size" => '',
		"type" => ''
	), $atts));
	
	if ($atts[type] == "colorscheme") {
		$color = get_option('wp_color_scheme');
		}
		
	return "<a style='background-color:". $color .";' class='btn " . "btn-".$size . " " . "btn-".$type . "' href='".$url."'>".$content."</a>";
}

add_shortcode("iconbutton", "iconbutton");
function iconbutton($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"size" => '',
		"type" => '',
		"color" => '',
		"icon" => ''
	), $atts));
	return "<a class='btn " . "btn-".$size . " " . "btn-".$type . "' href='".$url."'><i class='" . "icon-".$color . " " . "icon-".$icon . "'></i> ".$content."</a>";
}


add_shortcode("lead", "lead");
function lead($atts, $content = null) {
	return "<div class='lead'>".$content."</div>";
}



add_shortcode("tooltip", "tooltip");
function tooltip($atts, $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"text" => ''
	), $atts));

	return "<a class='tt' title='".$text."'>".$content."</a>";
}



add_shortcode("accordion", "accordion");
function accordion($atts, $content = null) {
	extract(shortcode_atts(array(
		"title" => '',
		"name" => ''
	), $atts));

	return "<div class='accordion-group'><div class='accordion-heading'><a class='accordion-toggle' data-toggle='collapse' href='#".$name."'><strong>".$title."</strong></a></div><div id='".$name."' class='accordion-body collapse '><div class='accordion-inner'>".$content."</div></div></div>";
}



add_shortcode("alert", "alert");
function alert($atts, $content = null) {
	extract(shortcode_atts(array(
		"type" => ''
	), $atts));

	return "<div class='alert ". "alert-".$type. "'><button type='button' class='close' data-dismiss='alert'>x</button>".$content."</div>";
}
?>