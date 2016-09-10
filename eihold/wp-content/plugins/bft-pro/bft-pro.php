<?php
/*
Plugin Name: BroadFast PRO Autoresponder
Plugin URI: http://calendarscripts.info/bft-pro/
Description: PRO autoresponder plugin for Wordpress
Author: Kiboko Labs
Version: 2.2.3
Author URI: http://calendarscripts.info/
License: GPLv2 or later
*/

define( 'BFTPRO_PATH', dirname( __FILE__ ) );
define( 'BFTPRO_RELATIVE_PATH', dirname( plugin_basename( __FILE__ )));

// require controllers and models
require(BFTPRO_PATH."/helpers/linkhelper.php");
require(BFTPRO_PATH."/helpers/htmlhelper.php");
require(BFTPRO_PATH."/helpers/text-captcha.php");
require(BFTPRO_PATH."/models/bftpro.php");
require(BFTPRO_PATH."/models/widget.php");
require(BFTPRO_PATH."/models/list.php");
require(BFTPRO_PATH."/models/report.php");
require(BFTPRO_PATH."/models/sender.php");
require(BFTPRO_PATH."/controllers/lists.php");
require(BFTPRO_PATH."/controllers/campaigns.php");
require(BFTPRO_PATH."/controllers/newsletters.php");
require(BFTPRO_PATH."/controllers/reports.php");
require(BFTPRO_PATH."/controllers/shortcodes.php");
require(BFTPRO_PATH."/controllers/help.php");
require(BFTPRO_PATH."/controllers/bounce.php");
require(BFTPRO_PATH."/controllers/users.php");
require(BFTPRO_PATH."/controllers/integrations.php");
require(BFTPRO_PATH."/controllers/integrations/contact-form-7.php");
require(BFTPRO_PATH."/controllers/subemail.php");

register_activation_hook(__FILE__, array("BFTPro", "install"));
add_action('admin_menu', array("BFTPro", "menu"));
add_action('admin_enqueue_scripts', array("BFTPro", "scripts"));

// show the things on the front-end
add_action( 'wp_enqueue_scripts', array("BFTPro", "scripts"));

// widgets
add_action( 'widgets_init', array("BFTPro", "register_widgets") );

// other actions
add_action('init', array("BFTPro", "init"));
add_action('wp_login', array('BFTProList', 'auto_subscribe'), 10, 2);

// let other plugins use request email sending too
add_action('bftpro_send_immediate_emails', array('BFTProSender', 'immediate_mails'));