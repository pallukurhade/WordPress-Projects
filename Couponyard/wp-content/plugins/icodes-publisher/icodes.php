<?php
/*
Plugin Name: AppThemes iCodes
Plugin URI: http://www.appthemes.com
Description: Imports into your Clipper site coupons stright from iCodes.

AppThemes ID: icodes-publisher

Version: 1.0
Author: AppThemes
Author URI: http://appthemes.com
Text Domain: appthemes-icodes
*/

define( 'APP_IC_TD', 'appthemes-icodes' );


$locale = apply_filters( 'plugin_locale', get_locale(), APP_IC_TD );
load_textdomain( APP_IC_TD, WP_LANG_DIR . "/plugins/appthemes-icodes-$locale.mo" );


/**
 * Setup iCodes Plugin data
 */ 
function appthemes_icodes_setup() {
	global $ic_options;

	// Check for right version of Clipper
	if ( ! defined( 'APP_POST_TYPE' ) || APP_POST_TYPE != 'coupon' ) {
		add_action( 'admin_notices', 'appthemes_icodes_display_version_warning' );
		return;
	}

	require_once dirname( __FILE__ ) . '/ic-options.php';
	require_once dirname( __FILE__ ) . '/ic-data.php';

	if ( is_admin() ) {

		if ( ! class_exists( 'APP_Tabs_Page' ) ) {
			add_action( 'admin_notices', 'appthemes_icodes_display_version_warning' );
			return;
		}

		// initialize admin page
		require_once dirname( __FILE__ ) . '/ic-admin.php';
		new APP_iCodes_Settings( $ic_options );
	}

	// initialize importer
	require_once dirname( __FILE__ ) . '/ic-import.php';
	new APP_iCodes_Import( $ic_options );
}
add_action( 'appthemes_init', 'appthemes_icodes_setup' );


/**
 * Display Clipper Version Warning
 */ 
function appthemes_icodes_display_version_warning() {

	$message = __( 'AppThemes iCodes could not run.', APP_IC_TD );

	if ( ! defined( 'APP_POST_TYPE' ) || ! class_exists( 'APP_Tabs_Page' ) )
		$message = __( 'AppThemes iCodes does not support the current theme. Please use a compatible AppThemes Product.', APP_IC_TD );

	echo '<div class="error fade"><p>' . $message . '</p></div>';
	deactivate_plugins( plugin_basename( __FILE__ ) );
}


/**
 * Creates slug from name
 */ 
function appthemes_icodes_create_slug( $name ) {
	$slug = strtolower( $name );
	$slug = preg_replace( '/[^a-z0-9\\-\\_]/i', '_', $slug );
	return $slug;
}


/**
 * Clear transients & cron event
 */ 
function appthemes_icodes_clear() {
	global $wpdb;

	wp_clear_scheduled_hook( 'appthemes_icodes_cron' );
	delete_transient( 'appthemes_icodes_stores_feed' );
	delete_transient( 'appthemes_icodes_networks_feed' );
	delete_transient( 'appthemes_icodes_categories_feed' );
	delete_transient( 'appthemes_icodes_import_error' );
	delete_transient( 'appthemes_icodes_import_count' );

	// delete dynamic transients
	$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_appthemes_icodes_store_id_%' OR option_name LIKE '_transient_timeout_appthemes_icodes_store_id_%'" );
	$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_appthemes_icodes_stores_feed_%' OR option_name LIKE '_transient_timeout_appthemes_icodes_stores_feed_%'" );

}
register_activation_hook( __FILE__, 'appthemes_icodes_clear' );
register_deactivation_hook( __FILE__, 'appthemes_icodes_clear' );


