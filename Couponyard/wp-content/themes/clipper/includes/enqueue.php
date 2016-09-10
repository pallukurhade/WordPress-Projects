<?php
/**
 * These are scripts used within the Clipper theme
 * To increase speed and performance, we only want to
 * load them when needed
 *
 * @package Clipper
 *
 */


// correctly load all the jquery scripts so they don't conflict with plugins
function clpr_load_scripts() {
	global $clpr_options;

	$protocol = is_ssl() ? 'https' : 'http';
	// load google cdn hosted libraries if enabled
	if ( $clpr_options->google_jquery ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', $protocol . '://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2' );
	}

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-autocomplete' );
	wp_enqueue_script( 'jquery-ui-datepicker' );
	wp_enqueue_script( 'jqueryeasing', get_template_directory_uri() . '/includes/js/easing.js', array( 'jquery' ), '1.3' );
	wp_enqueue_script( 'jcarousellite', get_template_directory_uri() . '/includes/js/jcarousellite.min.js', array( 'jquery' ), '1.8.5' );
	wp_enqueue_script( 'flashdetect', get_template_directory_uri() . '/includes/js/flashdetect/flash_detect_min.js', array( 'jquery' ), '1.0.4' );
	wp_enqueue_script( 'zeroclipboard', get_template_directory_uri() . '/includes/js/zeroclipboard/ZeroClipboard.min.js', array( 'jquery', 'flashdetect' ), '1.2.3' );
	wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/includes/js/theme-scripts.js', array( 'jquery', 'zeroclipboard' ), '1.5' );
	wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/includes/js/colorbox/jquery.colorbox-min.js', array( 'jquery' ), '1.4.33' );

	wp_enqueue_script( 'validate', get_template_directory_uri() . '/includes/js/validate/jquery.validate.min.js', array( 'jquery' ), '1.11.1' );
	// add the language validation file if not english
	if ( ! empty( $clpr_options->form_val_lang ) ) {
		$lang_code = trim( $clpr_options->form_val_lang );
		wp_enqueue_script( 'validate-lang', get_template_directory_uri() . "/includes/js/validate/localization/messages_$lang_code.js", array( 'jquery' ), '1.11.1' );
	}

	// used to convert header menu into select list on mobile devices
	wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/includes/js/jquery.tinynav.min.js', array( 'jquery' ), '1.1' );

	// used to transform tables on mobile devices
	wp_enqueue_script( 'footable', get_template_directory_uri() . '/includes/js/jquery.footable.min.js', array( 'jquery' ), '2.0.1.2' );

	// adds touch events to jQuery UI on mobile devices
	if ( wp_is_mobile() )
		wp_enqueue_script( 'jquery-touch-punch' );

	// only load the general.js if available in child theme
	if ( file_exists( get_stylesheet_directory() . '/general.js' ) )
		wp_enqueue_script( 'general', get_stylesheet_directory_uri() . '/general.js', array( 'jquery' ), '1.0' );

	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// enqueue the user profile scripts
	if ( is_page_template( 'tpl-profile.php' ) )
		wp_enqueue_script( 'user-profile' );

	/* Script variables */
	$params = array(
		'app_tax_store' => APP_TAX_STORE,
		'ajax_url' => admin_url( 'admin-ajax.php', 'relative' ),
		'text_mobile_navigation' => __( 'Navigation', APP_TD ),
		'text_before_delete_coupon' => __( 'Are you sure you want to delete this coupon?', APP_TD ),
		'text_sent_email' => __( 'Your email has been sent!', APP_TD ),
		'text_shared_email_success' => __( 'This coupon was successfully shared with', APP_TD ),
		'text_shared_email_failed' => __( 'There was a problem sharing this coupon with', APP_TD )
	);
	wp_localize_script( 'theme-scripts', 'clipper_params', $params );

	$params = array(
		'templateurl' => get_template_directory_uri(),
		'zeroclipboardtop' => ( is_admin_bar_showing() ) ? 28 : 0,
	);
	wp_localize_script( 'zeroclipboard', 'clipboard_params', $params );

	// enqueue reports scripts
	appthemes_reports_enqueue_scripts();

}
add_action( 'wp_enqueue_scripts', 'clpr_load_scripts' );


// load scripts required on coupon submission
function clpr_load_form_scripts() {
	global $clpr_options;

	// only load the tinymce editor when html is allowed
	if ( $clpr_options->allow_html ) {
		wp_enqueue_script( 'tiny_mce', includes_url('js/tinymce/tiny_mce.js'), array( 'jquery' ), '3.0' );
		wp_enqueue_script( 'wp-langs-en', includes_url('js/tinymce/langs/wp-langs-en.js'), array( 'jquery' ), '3241-1141' );
	}

}


// load the css files correctly
function clpr_load_styles() {
	global $clpr_options;

	// Master (or child) Stylesheet
	wp_enqueue_style( 'at-main', get_stylesheet_uri() );

	// turn off stylesheets if customers want to use child themes
	if ( ! $clpr_options->disable_stylesheet ) {
		if ( $clpr_options->stylesheet ) {
			wp_enqueue_style( 'at-color', get_template_directory_uri() . '/styles/' . $clpr_options->stylesheet );
		} else {
			wp_enqueue_style( 'at-color', get_template_directory_uri() . '/styles/red.css' );
		}
	}

	// include the custom stylesheet
	if ( file_exists( get_stylesheet_directory() . '/styles/custom.css' ) )
		wp_enqueue_style( 'at-custom', get_stylesheet_directory_uri() . '/styles/custom.css' );

	// Load plugin stylesheets
	wp_register_style( 'colorbox', get_template_directory_uri() . '/includes/js/colorbox/colorbox.css', false, '1.4.33' );
	wp_enqueue_style( 'colorbox' );

	wp_enqueue_style( 'jquery-ui-style' );

	// enqueue reports styles
	appthemes_reports_enqueue_styles();

}
add_action( 'wp_enqueue_scripts', 'clpr_load_styles' );

