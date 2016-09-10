<?php
/*
Plugin Name: WP Coupon Widget
Plugin URI: https://www.usersdelight.com/web/coupon/intro
Description: Show coupons to relevant users instantly to increase conversions and build email list.
Author: UsersDelight
Version: 1.1
Author URI: http://www.usersdelight.com/
*/

require_once 'php/admin.php';

if (!class_exists("Coupon")) {
    class Coupon extends WP_Widget
    {
        function Coupon()
        {
            $widget_ops = array('classname' => 'Coupon', 'description' => 'Shows Coupon Bar on Top of your Website' );
            $this->WP_Widget('Coupon', 'Coupon Bar', $widget_ops);
            $coupon = get_option('CouponAdminAdminOptions');
            if (empty($coupon['keyword'])) {
                add_action( 'admin_notices', 'coupon_admin_notices');
            }
        }
        function form($instance)
        {
            $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
            $title = $instance['title'];
		}

		function update($new_instance, $old_instance)
		{
			$instance = $old_instance;
			$instance['title'] = $new_instance['title'];
			return $instance;
		}
    }

	function add_this_script_footer_coupon(){
		$coupon = get_option('CouponAdminAdminOptions');
		
        echo "<script type='text/javascript'>var _key=_key||{};_key['_key']='".$coupon['api_key']."';_key['_id']='".$coupon['_id']."';(function() {var _st= document.createElement('script');_st.setAttribute('type', 'text/javascript');_st.setAttribute('src', 'http://'+'www.usersdelight.com/ud.js');document.getElementsByTagName('body')[0].appendChild(_st);})();</script><noscript>Engage using <a href='http://www.usersdelight.com'>UsersDelight.com</a> apps</noscript>";
    }

    add_action('wp_footer', 'add_this_script_footer_coupon');
    add_action( 'widgets_init', create_function('', 'return register_widget("Coupon");') );
    add_action( 'admin_menu', 'my_coupon_menu' );
}
?>
