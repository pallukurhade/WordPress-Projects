<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->
<head>

<?php if (get_option('wp_favicon')) { ?>
	<link rel="shortcut icon" href="<?php echo get_option('wp_favicon');?>" />
<?php } ?>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php if (get_option('wp_metadescription')) { ?>
	<meta name="description" content="<?php echo get_option('wp_metadescription') ?>">
<?php } ?>

<?php if (get_option('wp_metakeywords')) { ?>
	<meta name="keywords" content="<?php echo get_option('wp_metakeywords') ?>">
<?php } ?>

<title> 
	<?php if (is_archive()) { 
	wp_title(''); echo 'Archive'; 
	} elseif (is_search()) { 
	echo 'Search for ' .'&quot;'.wp_specialchars($s).'&quot; - '; 
	} elseif (!(is_404()) && (is_single()) || (is_page())) { 
	wp_title(''); echo ' - '; 
	} elseif (is_404()) { 
	echo 'Page not found'; 
	} 

	if (is_home()) { 
	bloginfo('name');
	} else { 
	bloginfo('name'); 
	} 	
		?> 
</title> 

<meta name="author" content="">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php
	// Checks for color scheme cookie:
	$cookiecolorscheme = "";
	if(!empty($_COOKIE['color'])) $cookiecolorscheme = $_COOKIE['color'];
?> 

<?php echo get_option('wp_font1'); ?>

<?php if (get_option('wp_site') == "Real Estate") { ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php } ?>


<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />


<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>

<?php $scheme = substr(get_option('wp_color_scheme'), 0); 
$textscheme = substr(get_option('wp_text_color_scheme'), 0);

if ($cookiecolorscheme) {
	$scheme = $cookiecolorscheme;
	} else {
	$scheme = $scheme;
	}
$scheme = substr($scheme, 1);
?>

<?php wp_head(); ?> 


</head>

<?php
//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
if ( get_stylesheet_directory() != get_template_directory() && file_exists(		get_stylesheet_directory().'/css/css.php') ) {
 	include get_stylesheet_directory().'/css/css.php'; 
}
else {
 	include (get_template_directory().'/css/css.php');
}
 
?>
<?php 
//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
if ( get_stylesheet_directory() != get_template_directory() && file_exists(		get_stylesheet_directory().'/js/js.php') ) {

 	include get_stylesheet_directory().'/js/js.php'; 
	
}
else {
 
 	include (get_template_directory().'/js/js.php');
	
}
 ?>

<?php if (is_home()) { 
	$home = "ishome";
	} else { 
	$home = "nothome";
 } ?>
 
<?php if (get_option('wp_site') == "Real Estate") { ?>
	<body <?php if ( is_singular('listing') || is_page_template('contact.php') ){ echo 'onload="initialize()"'; } ?> id="<?php echo $home ?>" <?php body_class(); ?>>
<?php } else { ?>
	<body id="<?php echo $home ?>" <?php body_class(); ?>>
<?php } ?>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>

<?php 
	if ( get_stylesheet_directory() != get_template_directory() && 
	file_exists(get_stylesheet_directory().'/includes/variables.php') ) 
	{
		include get_stylesheet_directory() . '/includes/variables.php';
	}
	else {
		include get_template_directory() . '/includes/variables.php';
	}
 ?>

<div class="container">


<?php 
	if ( get_stylesheet_directory() != get_template_directory() && 
	file_exists(get_stylesheet_directory().'/includes/loginform.php') ) 
	{
		include get_stylesheet_directory() . '/includes/loginform.php';
	}
	else {
		include get_template_directory() . '/includes/loginform.php';
	}
 ?>

	<?php if(get_option('wp_headersubmenu') == "show" || get_option('wp_showlogin') == "show") { ?>
		<div id="secondaryheadermenucontainer" class="sixteen columns outercontainer">
			<?php if (has_nav_menu('headersecondary')) {
				wp_nav_menu( array('theme_location' => 'headersecondary', 'container' => 'div', 'sort_column' => 'menu_order', 'menu_id' => 'secondaryheadermenu' ) );
				} else {
				echo "Secondary header menu area. Create your secondary header menu in Appearance -> Menus";
				} ?>
		</div>
	<?php } ?>
	
		<div id="header" class="sixteen columns outercontainer">
			<?php dynamic_sidebar('qTranslate Language Chooser Widget') ?>
			
			<?php 
			  $langcode = "";
			  if (function_exists('qtrans_getLanguage')) {
				$langcode = "/?lang=" . qtrans_getLanguage(); 
				} else {
				$langcode = "";
				}
			?>

			<h1 id="logo"><a href="<?php echo home_url(); ?><?php echo $langcode; ?>"><?php bloginfo('name'); ?></a></h1>
			
			<?php if(get_option('wp_site') == "Real Estate") { ?>
				<a href="<?php echo get_option('wp_secondarylogourl') ?>" target="_blank"><div id="logo2"></div></a>
			<?php } ?>
		
			<?php if(get_bloginfo('description') != '') { ?>
				<p id="description"><?php bloginfo('description'); ?></p>
			<?php } ?> 
			
			<div id="headertextandsocialicons">
				<?php if(get_option('wp_headertext')) { ?>
					<p id="headertext"><?php echo get_option('wp_headertext') ?></p>
				<?php } ?>
				<?php if(get_option('wp_showsociallinks1') == "show") { 
			    if ( get_stylesheet_directory() != get_template_directory() && 
				file_exists(get_stylesheet_directory().'/includes/sociallinks_header.php') ) 
				{
					include get_stylesheet_directory() . '/includes/sociallinks_header.php';
				}
				else {
					include get_template_directory() . '/includes/sociallinks_header.php';
				}
					
					
					} ?>	
			</div>

			
			<div style="clear: both;"></div>
		</div><!-- end header -->
	
	
	<div id="menubar" class="sixteen columns outercontainer">
		<?php if (has_nav_menu('header')) {
			wp_nav_menu( array('theme_location' => 'header', 'container' => 'div', 'sort_column' => 'menu_order', 'menu_class' => 'sf-menu' ) );
		} else {
		echo "Header menu area. Create your header menu in Appearance -> Menus";
		} ?>
	</div>