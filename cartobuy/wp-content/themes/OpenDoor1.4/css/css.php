<!-- This page includes CSS styles which pull in data from Theme Options (via PHP) -->

<style type="text/css">

	
		#search a:hover, #content a, #content h4 a:hover
			{color: #<?php echo $scheme; ?> }
			
		#search .accordion-heading .accordion-toggle,
		ul.sf-menu li:hover ul, ul.sf-menu li.sfhover ul, .sf-menu li:hover, .btn-colorscheme, .btn-white:hover {background-color: #<?php echo $scheme; ?> !important;}
		
		.banner {border-color: #<?php echo $scheme; ?>}
		
		.btn-colorscheme:hover {background: #<?php echo $scheme; ?> url(<?php echo get_template_directory_uri() ?>/images/button_nogradient.png) repeat !important; color: white;}

	
	<?php if (get_option('wp_textcolor')) { ?>
		#search .accordion-heading a:link, #search .accordion-heading a:visited {color: <?php echo get_option('wp_textcolor'); ?> !important;}
		#search .accordion-heading a:link, #search .accordion-heading a:visited {
			text-shadow: 0 1px 1px rgba(255, 255, 255, 0.50); /* light shadow  */
		}
	
	<?php } else { ?>
		#search .accordion-heading a:link, #search .accordion-heading a:visited {
			text-shadow: 0 1px 1px rgba(0, 0, 0, 0.50); /* dark shadow  */
		}
	<?php } ?>
	
	
	h1, h2, h3, h4, h5, h6, #slider p, .sliderprice, .ex1, .ex2, .ex3, .ex4, .ex5, .bigheading, .listingblocksection p.price, #search .accordion-heading a:link, #search .accordion-heading a:visited, #search .btn, .html_content .banner, #slider2 .banner, .dsidx-address a, .dsidx-primary-data .dsidx-price {
	<?php if (get_option('wp_font1')) {
		echo get_option('wp_font2');
		if (strpos(get_option('wp_font2'), "Oswald")){
			echo "word-spacing: 1em; letter-spacing: 0.03em; word-spacing: 0.1em;";
		}
		} else { 
			echo get_option('wp_font3');
		} ?>
		font-weight: normal;
	}
	
	
			<?php if (get_option('wp_backgroundimage') || get_option('wp_backgroundcolor')) { ?>
				body {background: <?php echo get_option('wp_backgroundcolor') ?> url(<?php echo get_option('wp_backgroundimage') ?>) <?php echo get_option('wp_backgroundrepeat') ?> <?php echo get_option('wp_backgroundposition') ?> <?php echo get_option('wp_backgroundattachment') ?>;}
			<?php } else { ?>
				body {background: url(<?php echo get_template_directory_uri() ?>/images/background-striped.png) fixed;}
			<?php } ?>

	
	
		<?php if (get_option('wp_headercolor')) { ?>
		#header {background: none <?php echo get_option('wp_headercolor') ?>;}
		<?php } else { ?>
			<?php if (get_option('wp_headerimage')) { ?>
				#header {background: url(<?php echo get_option('wp_headerimage') ?>) <?php echo get_option('wp_headerrepeat') ?>;}
			<?php } else { ?>
				#header {background: none white;}
			<?php } ?>
	<?php } ?>
	

	
		<?php if (get_option('wp_titlecolor')) { ?>
		div.bigheading {background: none <?php echo get_option('wp_titlecolor') ?>;}
		<?php } else { ?>
			<?php if (get_option('wp_titleimage')) { ?>
				div.bigheading {background: url(<?php echo get_option('wp_titleimage') ?>) <?php echo get_option('wp_titlerepeat') ?>;}
			<?php } else { ?>
				div.bigheading {background: url(<?php echo get_template_directory_uri() ?>/images/subtle_carbon.jpg);}
			<?php } ?>
	<?php } ?>
	
	
		<?php if (get_option('wp_footercolor')) { ?>
		#footer {background: none <?php echo get_option('wp_footercolor') ?>;}
		<?php } else { ?>
			<?php if (get_option('wp_footerimage')) { ?>
				#footer {background: url(<?php echo get_option('wp_footerimage') ?>) <?php echo get_option('wp_footerrepeat') ?>;}
			<?php } else { ?>
				#footer {background: url(<?php echo get_template_directory_uri() ?>/images/subtle_carbon.jpg);}
			<?php } ?>
	<?php } ?>
	
	
	
	<?php if (get_option('wp_qtranslatealignment') == "Header Top Left") {
		$position = "left: 0;";
		} elseif (get_option('wp_qtranslatealignment') == "Header Top Right") {
		
		$position = "right:" . get_option('wp_qtranslaterightoffset') . "px;";
		} ?>
	
	
	.widget.qtranslate {position: absolute; top: <?php echo get_option('wp_qtranslatetop') ?>px; <?php echo $position; ?>}
	
	
	

	<?php $css = get_post_meta($post->ID, 'css_value', true); ?>
	<?php if($css) { 
		echo $css;
	} ?>
	
	
	<?php echo get_option('wp_customcss');  ?>
	
	
	#logo {
		width: <?php echo get_option('wp_logowidth') ?>px;
		height: 160px;
		background: transparent url(<?php echo get_option('wp_logo') ?>) no-repeat <?php echo get_option('wp_logo_x') ?>px <?php echo get_option('wp_logo_y') ?>px ;
		position: absolute;
	}
	
	
	#logo2 {
		background: transparent url(<?php echo get_option('wp_logo2') ?>) no-repeat right 0;
	}
	
	<?php if (get_option('wp_showsearch') == "hide") { ?>
		#leftsidebar {top: 0 !important;}
	<?php } ?>
	

	#header {height: <?php echo get_option('wp_headerheight') ?>px;}
	
	
	
	<?php if (get_option('wp_slideshowlayout') == 'Full Width') { ?>
		#slider {width: 980px !important; margin-left:-10px; clear: both;}
	<?php } else { ?>
		#slider {width: 700px !important; margin-left:0; clear: both; margin-bottom: 30px;}
	<?php } ?>
	
	
	@media only screen and (min-width: 768px) and (max-width: 959px) {
		<?php if (get_option('wp_responsivelogo1')) { ?>
			#logo {background: url(<?php echo get_option('wp_responsivelogo1') ?>) no-repeat !important;}
			#header {height: 130px !important;}
		<?php } ?>
		<?php if (get_option('wp_responsiveheader1')) { ?>
			#header {background: url(<?php echo get_option('wp_responsiveheader1') ?>) no-repeat !important;}
			#header {height: 130px !important;}
		<?php } ?>
	}

	@media only screen and (min-width: 480px) and (max-width: 767px) {
		<?php if (get_option('wp_responsivelogo2')) { ?>
			#logo {background: url(<?php echo get_option('wp_responsivelogo2') ?>) no-repeat !important;}
			#header {height: 115px !important;}
		<?php } ?>
		<?php if (get_option('wp_responsiveheader2')) { ?>
			#header {background: url(<?php echo get_option('wp_responsiveheader2') ?>) no-repeat !important;}
			#header {height: 115px !important;}
		<?php } ?>
	}

	@media only screen and (max-width: 479px) {
		<?php if (get_option('wp_responsivelogo3')) { ?>
			#logo {background: url(<?php echo get_option('wp_responsivelogo3') ?>) no-repeat !important;}
			#header {height: 100px !important;}
		<?php } ?>
		
		<?php if (get_option('wp_responsiveheader3')) { ?>
			#header {background: url(<?php echo get_option('wp_responsiveheader3') ?>) no-repeat !important;}
			#header {height: 100px !important;}
		<?php } ?>
	}

	
</style>