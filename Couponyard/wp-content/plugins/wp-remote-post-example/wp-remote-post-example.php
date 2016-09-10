<?php
/**
 * Plugin Name: WP Remote Post Example
 * Plugin URI:  http://tommcfarlin.com/wp-remote-post/
 * Description: An example plugin demonstrating how to use <code>wp_remote_post</code>.
 * Version:     1.0.0
 * Author:      Tom McFarlin
 * Author URI:  http://tommcfarlin.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}
 
require_once( plugin_dir_path( __FILE__ ) . 'class-wp-remote-post.php' );
WP_Remote_Post_Example::get_instance();
