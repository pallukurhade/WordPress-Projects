<?php
  if (!class_exists("CouponAdmin")) {
	class CouponAdmin {
		var $adminOptionsName = "CouponAdminAdminOptions";
		function CouponAdmin() {
		}
		function init() {
			$this->getAdminOptions();
		}
		function getAdminOptions() {
			$devloungeAdminOptions = array('api_key' => 'b34s3a', '_id' => '1', 'email' => get_option('admin_email'), 'name' => get_bloginfo('name'), 'domain' => get_option('siteurl'), 'title' => 'coupon', 'tab_name' =>'Coupon', 'tab_txt_clr' => 'fff', 'tab_bg_clr' => '3f6eba', 'tab_bdr_clr' => '3f6eba', 'titl_bg_clr' => '3f6eba', 'titl_txt_clr' => 'fff', 'cupn_bdr_clr' => '3f6eba', 'cupn_bg_clr' => 'e5e6fc', 'cupn_txt_clr' => '000', 'tab_text_drop_shadow' => 0, 'tab_alignment' => 0, 'coupon_title' => 'Get Discount ', 'coupon_desc' => 'Share by clicking  on any of the Share button below and an exclusive coupon code will appear on your screen.', 'coupon_code' => 'abcd', 'offer_date' => '2014-05-31', 'offer_time' => '', 'time_zone' => '', 'user_to_share' => 1, 'fb_share' => 1, 'twitter_share' => 1, 'redirect_url' => '', 'from_name' => '', 'email_address' => '', 'app_logo' => 1 );
			$devOptions = get_option($this->adminOptionsName);
			if (!empty($devOptions)) {
				foreach ($devOptions as $key => $option)
					$devloungeAdminOptions[$key] = $option;
			}
			update_option($this->adminOptionsName, $devloungeAdminOptions);
                        remove_action( 'admin_notices', 'coupon_admin_notices' );
			return $devloungeAdminOptions;
		}

		function addContent($keyword = '') {
			$devOptions = $this->getAdminOptions();
			if ($devOptions['add_content'] == "true") {
				$keyword .= $devOptions['keyword'];
			}
			return $keyword;
		}
		function printAdminPage() {
		
                    $devOptions = $this->getAdminOptions();

                    if (isset($_POST['update_devloungePluginSeriesSettings'])) {

                        if (isset($_POST['devloungeApikey'])) {
                                $devOptions['api_key'] = apply_filters('keyword_save_pre', $_POST['devloungeApikey']);
                        }
                        if (isset($_POST['devloungeId'])) {
                                $devOptions['_id'] = apply_filters('keyword_save_pre', $_POST['devloungeId']);
                        }
                        if (isset($_POST['devloungeEmail'])) {
                                $devOptions['email'] = apply_filters('keyword_save_pre', $_POST['devloungeEmail']);
                        }

                        if (isset($_POST['devloungeName'])) {
                                $devOptions['name'] = apply_filters('keyword_save_pre', $_POST['devloungeName']);
                        }

                        if (isset($_POST['devloungeDomain'])) {
                                $devOptions['domain'] = apply_filters('keyword_save_pre', $_POST['devloungeDomain']);
                        }
                        if (isset($_POST['devloungeTabName'])) {
                                $devOptions['tab_name'] = apply_filters('keyword_save_pre', $_POST['devloungeTabName']);
                        }
						if (isset($_POST['devloungeTabTextColor'])) {
                                $devOptions['tab_txt_clr'] = apply_filters('keyword_save_pre', $_POST['devloungeTabTextColor']);
                        }
						if (isset($_POST['devloungeTabBackgroundColor'])) {
                                $devOptions['tab_bg_clr'] = apply_filters('keyword_save_pre', $_POST['devloungeTabBackgroundColor']);
                        }
						if (isset($_POST['devloungeTabBorderColor'])) {
                                $devOptions['tab_bdr_clr'] = apply_filters('keyword_save_pre', $_POST['devloungeTabBorderColor']);
                        }
						if (isset($_POST['devloungeTabTitleBackgroundColor'])) {
                                $devOptions['titl_bg_clr'] = apply_filters('keyword_save_pre', $_POST['devloungeTabTitleBackgroundColor']);
                        }
						if (isset($_POST['devloungeTabTitleTextColor'])) {
                                $devOptions['titl_txt_clr'] = apply_filters('keyword_save_pre', $_POST['devloungeTabTitleTextColor']);
                        }
						if (isset($_POST['devloungeCouponBorderColor'])) {
                                $devOptions['cupn_bdr_clr'] = apply_filters('keyword_save_pre', $_POST['devloungeCouponBorderColor']);
                        }
						if (isset($_POST['devloungeCouponBackgroundColor'])) {
                                $devOptions['cupn_bg_clr'] = apply_filters('keyword_save_pre', $_POST['devloungeCouponBackgroundColor']);
                        }
						if (isset($_POST['devloungeCouponTextColor'])) {
                                $devOptions['cupn_txt_clr'] = apply_filters('keyword_save_pre', $_POST['devloungeCouponTextColor']);
                        }
						if (isset($_POST['devloungeTextDropShadow'])) {
                                $devOptions['tab_text_drop_shadow'] = apply_filters('keyword_save_pre', $_POST['devloungeTextDropShadow']);
                        }
						if (isset($_POST['devloungeTabAlignment'])) {
                                $devOptions['tab_alignment'] = apply_filters('keyword_save_pre', $_POST['devloungeTabAlignment']);
                        }
						if (isset($_POST['devloungeCouponTitle'])) {
                                $devOptions['coupon_title'] = apply_filters('keyword_save_pre', $_POST['devloungeCouponTitle']);
                        }
						if (isset($_POST['devloungeCouponDescription'])) {
                                $devOptions['coupon_desc'] = apply_filters('keyword_save_pre', $_POST['devloungeCouponDescription']);
                        }
						if (isset($_POST['devloungeCouponCode'])) {
                                $devOptions['coupon_code'] = apply_filters('keyword_save_pre', $_POST['devloungeCouponCode']);
                        }
						if (isset($_POST['devloungeOfferDate'])) {
                                $devOptions['offer_date'] = apply_filters('keyword_save_pre', $_POST['devloungeOfferDate']);
                        }
						if (isset($_POST['devloungeOfferTime'])) {
                                $devOptions['offer_time'] = apply_filters('keyword_save_pre', $_POST['devloungeOfferTime']);
                        }
						if (isset($_POST['devloungeTimeZone'])) {
                                $devOptions['time_zone'] = apply_filters('keyword_save_pre', $_POST['devloungeTimeZone']);
                        }
						if (isset($_POST['devloungeUserToShare'])) {
                                $devOptions['user_to_share'] = apply_filters('keyword_save_pre', $_POST['devloungeUserToShare']);
                        }
						if (isset($_POST['devloungeFacebookShare'])) {
                                $devOptions['fb_share'] = apply_filters('keyword_save_pre', $_POST['devloungeFacebookShare']);
                        }
						if (isset($_POST['devloungeTwitterShare'])) {
                                $devOptions['twitter_share'] = apply_filters('keyword_save_pre', $_POST['devloungeTwitterShare']);
                        }
						if (isset($_POST['devloungeRedirectUrl'])) {
                                $devOptions['redirect_url'] = apply_filters('keyword_save_pre', $_POST['devloungeRedirectUrl']);
                        }
						if (isset($_POST['devloungeFromName'])) {
                                $devOptions['from_name'] = apply_filters('keyword_save_pre', $_POST['devloungeFromName']);
                        }
						if (isset($_POST['devloungeEmailAddress'])) {
                                $devOptions['email_address'] = apply_filters('keyword_save_pre', $_POST['devloungeEmailAddress']);
                        }
						if (isset($_POST['devloungeAppLogo'])) {
                                $devOptions['app_logo'] = apply_filters('keyword_save_pre', $_POST['devloungeAppLogo']);
                        }
						
                        update_option($this->adminOptionsName, $devOptions);

                        ?>
                        <div class="updated"><p><strong><?php _e("Settings Updated.", "CouponAdmin");?></strong></p></div>
                        <?php
                        } ?>

                        <style>

                            .wrap h3{float: left;width:400px;margin:10px 10px 0 0;font-weight:normal}
                            .wrap p{float: left; max-width:300px;margin:0}
                            .wrap small{float: left; width:100%;margin:0}
                            .wrap .input_color{width:200px}
                            .wrap .input_kwd{width:200px; margin-left:10px;}
                            .wrap .row{float:left;width:100%; margin:5px 0;}
                            .wrap .title{font-weight:bold;}
                            .wrap .input_font{margin-left:10px; width:200px}
                            .wrap .che{margin:0px; -webkit-border-radius:0px  !important;-moz-border-radius:0px  !important;border-radius:0px !important; }
                            .wrap p input{background-color: #ffffff;
                                          border: 1px solid #cccccc;
                                          -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                                          -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                                          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                                          -webkit-transition: border linear .2s, box-shadow linear .2s;
                                          -moz-transition: border linear .2s, box-shadow linear .2s;
                                          -o-transition: border linear .2s, box-shadow linear .2s;
                                          transition: border linear .2s, box-shadow linear .2s; margin-top:5px;
                                        }
                            .wrap p input:hover{border-color: rgba(82, 168, 236, 0.8);
                              outline: 0;
                              outline: thin dotted \9;


                              -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(82,168,236,.6);
                              -moz-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(82,168,236,.6);
                              box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px rgba(82,168,236,.6);
                            }

                            .btn-primary {
                              cursor: pointer;
                              color: #ffffff !important;
                              text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25) !important;
                              background-color: #006dcc !important;
                              background-image: -moz-linear-gradient(top, #0088cc, #0044cc)!important;
                              background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0044cc))!important;
                              background-image: -webkit-linear-gradient(top, #0088cc, #0044cc)!important;
                              background-image: -o-linear-gradient(top, #0088cc, #0044cc)!important;
                              background-image: linear-gradient(to bottom, #0088cc, #0044cc)!important;
                              background-repeat: repeat-x;
                              filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0044cc', GradientType=0);
                              border-color: #0044cc #0044cc #002a80 !important;
                              border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25)!important;
                              *background-color: #0044cc !important;
                              /* Darken IE7 buttons by default so they stand out more given they won't have borders */

                              filter: progid:DXImageTransform.Microsoft.gradient(enabled = false);-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px; padding:10px; text-align:center; text-decoration:none; }

                            .btn-primary:hover{
                             color: #ffffff !important;
                              background-color: #0044cc !important; }

.btn-success {
color: #ffffff;border-radius:3px;padding: 10px;
text-decoration: none;
border: 1px solid #098C06;-moz-border-radius:3px;-webkit-border-radius:3px;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
  background-color: #5bb75b;
  *background-color: #51a351;
  background-image: -moz-linear-gradient(top, #62c462, #51a351);
  background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#62c462), to(#51a351));
  background-image: -webkit-linear-gradient(top, #62c462, #51a351);
  background-image: -o-linear-gradient(top, #62c462, #51a351);
  background-image: linear-gradient(to bottom, #62c462, #51a351);
  background-repeat: repeat-x;
  border-color: #51a351 #51a351 #387038;
  border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=&#039;#ff62c462&#039;, endColorstr=&#039;#ff51a351&#039;, GradientType=0);
  filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
}

.btn-success:hover,
.btn-success:active,
.btn-success.active,
.btn-success.disabled,
.btn-success[disabled] {color: #ffffff;  background-color: #51a351;  *background-color: #499249;}
.btn-success:active,
.btn-success.active { background-color: #408140 \9;}
.wrap h2{float: left;width: 100%;}
.wrap {float: left;width: 100%;}
</style>
<script type="text/javascript" >
var response_received = 0;
function submit_form() { 
   var name = jQuery('#name').val();
   var email = jQuery('#email').val();
   var domain = jQuery('#domain').val();
   var tb_name = jQuery('#tab_name').val();
   if (tb_name != '')
   {
     tb_name = encodeURIComponent(tb_name);
   }
   var tb_txt_clr = jQuery('#tab_txt_clr').val();
   var tb_bg_clr = jQuery('#tab_bg_clr').val();
   var tb_bdr_clr = jQuery('#tab_bdr_clr').val();
   var title_bg_clr = jQuery('#titl_bg_clr').val();
   var title_txt_clr = jQuery('#titl_txt_clr').val();
   var cupn_bdr_clr = jQuery('#cupn_bdr_clr').val();
   var cupn_bg_clr = jQuery('#cupn_bg_clr').val();
   var cupn_txt_clr = jQuery('#cupn_txt_clr').val();
   var tb_txt_drop_shadow = jQuery("#tab_text_drop_shadow").is(':checked')?1:0;
   var tab_alignment = jQuery('input[name=devloungeTabAlignment]:radio:checked').val();
   var coupon_title = encodeURIComponent(jQuery('#coupon_title').val());
   var coupon_desc = encodeURIComponent(jQuery('#coupon_desc').val());
   var coupon_code = jQuery('#coupon_code').val();
   var offer_date = jQuery('#offer_date').val();
   var offer_time = jQuery('#offer_time ').val();
   var time_zone = jQuery('#time_zone').val();
   var user_to_share = jQuery('#user_to_share').is(':checked')?1:0;
   if (user_to_share == 1) {
     var fb_share = jQuery('#fb_share').is(':checked')?1:0;
     var twitter_share = jQuery('#twitter_share').is(':checked')?1:0;
    } else {
      var fb_share = 0;
      var twitter_share = 0;
	}    
   var redirect_url = jQuery('#redirect_url').val();
   var from_name = jQuery('#from_name').val();
   var email_address = jQuery('#email_address').val();
   var app_logo = jQuery('#app_logo').is(':checked')?1:0;
 
   dataString = "title=WebCoupon&name="+name+"&email="+email+"&domain="+domain+"&tb_name="+tb_name+"&tb_txt_clr="+tb_txt_clr+"&tb_bg_clr="+tb_bg_clr+"&tb_bdr_clr="+tb_bdr_clr+"&title_bg_clr="+title_bg_clr+"&title_txt_clr="+title_txt_clr+"&cupn_bdr_clr="+cupn_bdr_clr+"&cupn_bg_clr="+cupn_bg_clr+"&cupn_txt_clr="+cupn_txt_clr+"&tb_txt_drop_shadow="+tb_txt_drop_shadow+"&tab_alignment="+tab_alignment+"&coupon_title="+coupon_title+"&coupon_desc="+coupon_desc+"&coupon_code="+coupon_code+"&offer_date="+offer_date+"&offer_time="+offer_time+"&time_zone="+time_zone+"&user_to_share="+user_to_share+"&fb_share="+fb_share+"&twitter_share="+twitter_share+"&redirect_url="+redirect_url+"&from_name="+from_name+"&email_address="+email_address+"&app_logo="+app_logo;
   jQuery("#status").html('<img src="<?php echo site_url()?>/wp-content/plugins/wp-coupon-widget/images/ajax-loader.gif">');
   jQuery("#status").show();
      jQuery.ajax({
        url: "http://www.usersdelight.com/api/wp/notifier",
        type: "POST",
        data :dataString,
        dataType:'jsonp',
        success:function(response_data){
            jQuery("#set_api_key").val(response_data['api_key']);
            jQuery('#set_api_id').val(response_data['_id']);
            var a = location.hostname;
            jQuery("#domain").val(a);
            response_received = 1;
            jQuery("#status").html('Successfully updated');
        },
          error:function(response_data){
         }
        });
  };

  function waitForElement(){
    if (response_received == 1) {
       jQuery.post('<?php echo site_url() ?>/wp-admin/admin.php?page=coupon-menu-id', jQuery('#coupon_form').serialize());
      }
    else{
        setTimeout(function(){
            waitForElement();
        },250);
    }
}
jQuery(document).ready(function(){
var user_to_share = jQuery('#user_to_share').is(':checked')?1:0;
if (user_to_share == 0) {
     jQuery("#fb_share,#twitter_share").hide();
    }
jQuery("#user_to_share").click(function () {
var user_to_share = jQuery('#user_to_share').is(':checked')?1:0;
if (user_to_share == 1) {
     jQuery("#fb_share,#twitter_share").show();
    } else {
     jQuery("#fb_share,#twitter_share").hide();
	}  
});
  jQuery('#coupon_form').submit(function (e) {
    e.preventDefault();
    submit_form();
    waitForElement();
  })
})
</script>
                            <div class="wrap">
                              <div style="float:left;width:60%">
                                <form method="post" action="#" id="coupon_form">
                                  <h2>Configure Coupon Widget:</h2>
                                <div class="row" style="width: 90%;"><hr></div>
                                <input type="hidden" id="set_api_key" name="devloungeApikey" value="<?php echo $devOptions['api_key'] ?>"/>
                                <input type="hidden" id="set_api_id" name="devloungeId" value="<?php echo $devOptions['_id'] ?>"/>
                                <input type="hidden" name="update_devloungePluginSeriesSettings" value="1"/>
                                <div class="row">
                                  <h3>Email</h3>
                                  <p><input required id="email" name="devloungeEmail" class="input_color" value="<?php echo $devOptions['email'] ?>">
                                  <small>e.g  yourname@example.com</small></p>
                                </div>
                                <input type="hidden" required id="name" name="devloungeName" class="input_color" value="<?php echo $devOptions['name'] ?>"> 
				<div class="row">
                                  <h3>Domain name</h3>
                                  <p>                       
                                <input type="text" id="domain" required name="devloungeDomain" class="input_color" value="<?php echo $devOptions['domain'] ?>">
                                  <small>e.g  www.your-domain-name.com</small></p>
                                </div>
                                <div class="row">
                                <div class="row">
                                  <h3>Name of Tab :</h3>
                                  <p><input id="tab_name" required name="devloungeTabName" class="input_color" value="<?php echo $devOptions['tab_name'] ?>">
                                  <small>e.g. Coupon</small></p>
                                </div>
                                <div class="row">
                                  <h3>Color of Tab Text :</h3>
                                  <p>#<input id="tab_txt_clr" required name="devloungeTabTextColor" class="input_color" value="<?php echo $devOptions['tab_txt_clr'] ?>">
                                  <small>e.g. FFFFFF</small></p>
                                </div>
								<div class="row">
                                  <h3>Background Color of Tab :</h3>
                                  <p>#<input id="tab_bg_clr" required name="devloungeTabBackgroundColor" class="input_color" value="<?php echo $devOptions['tab_bg_clr'] ?>">
                                  <small>e.g. cccccc</small></p>
                                </div>
								<div class="row">
                                  <h3>Border Color of Tab :</h3>
                                  <p>#<input id="tab_bdr_clr" required name="devloungeTabBorderColor" class="input_color" value="<?php echo $devOptions['tab_bdr_clr'] ?>">
                                  <small>e.g. cccccc</small></p>
                                </div>
								<div class="row">
                                  <h3>Background Color of Title Box :</h3>
                                  <p>#<input id="titl_bg_clr" required name="devloungeTabTitleBackgroundColor" class="input_color" value="<?php echo $devOptions['titl_bg_clr'] ?>">
                                  <small>e.g. cccccc</small></p>
                                </div>
								<div class="row">
                                  <h3>Color of Title Text :</h3>
                                  <p>#<input id="titl_txt_clr" required name="devloungeTabTitleTextColor" class="input_color" value="<?php echo $devOptions['titl_txt_clr'] ?>">
                                  <small>e.g. cccccc</small></p>
                                </div>
								<div class="row">
                                  <h3>Border Color of Coupon :</h3>
                                  <p>#<input id="cupn_bdr_clr" required name="devloungeCouponBorderColor" class="input_color" value="<?php echo $devOptions['cupn_bdr_clr'] ?>">
                                  <small>e.g. cccccc</small></p>
                                </div>
								<div class="row">
                                  <h3>Background Color of Coupon :</h3>
                                  <p>#<input id="cupn_bg_clr" required name="devloungeCouponBackgroundColor" class="input_color" value="<?php echo $devOptions['cupn_bg_clr'] ?>">
                                  <small>e.g. cccccc</small></p>
                                </div>
								<div class="row">
                                  <h3>Text Color of Coupon :</h3>
                                  <p>#<input id="cupn_txt_clr" required name="devloungeCouponTextColor" class="input_color" value="<?php echo $devOptions['cupn_txt_clr'] ?>">
                                  <small>e.g. cccccc</small></p>
                                </div>
                                <div class="row">
                                  <h3>Show Drop Shadow on Tab Text :</h3>
                                  <?php
                                    if($devOptions['tab_text_drop_shadow'] == 1) {
                                        $select = 'checked';
                                    }
                                    else {
                                      $select = '';
                                    }  ?>
                                <input type="hidden" name="devloungeTextDropShadow" value="0"/>
                                <p><input id="tab_text_drop_shadow" type="checkbox" name="devloungeTextDropShadow" value="1"<?php echo $select ?>>Yes</p>
                                </div>
							    <div class="row">
                                  <h3>Tab Alignment :</h3>
                                  <?php
									if($devOptions['tab_alignment'] == 0) {
                                        $select = 'checked';
									}
									elseif ($devOptions['tab_alignment'] == 1) {
                                        $select1 = 'checked';
                                    }
                                  ?>
                                <input type="hidden" name="devloungeTabAlignment" value="0"/>
                                <p><input id="tab_alignment" type="radio" name="devloungeTabAlignment" value="0"<?php echo $select ?>>Left&nbsp;&nbsp;&nbsp;</p>
                                <p><input id="tab_alignment" type="radio" name="devloungeTabAlignment" value="1"<?php echo $select1 ?>>Right </p>
                                </div>
                                <br/>
<!-- End OF Tab Configure....................................................................................................................................-->  
                                <div class="row" style="width: 90%;"><hr></div>
                                  <h2>Configure Coupon Details</h2>
                                <div class="row" style="width: 90%;"><hr></div>
                                <div class="row">
                                  <h3>Coupon Title :</h3>
                                  <p><input id="coupon_title" required name="devloungeCouponTitle" class="input_color" value="<?php echo $devOptions['coupon_title'] ?>">
                                    <small>e.g. Flat 10% Off</small></p>
							    </div>
							    <div class="row">
                                  <h3>Coupon Description :</h3>
                                  <p><textarea id="coupon_desc" required name="devloungeCouponDescription" class="input_color" value="<?php echo $devOptions['coupon_desc'] ?>"><?php echo $devOptions['coupon_desc'] ?></textarea></p>
                                </div>
							    <div class="row">
                                  <h3>Coupon Code :</h3>
                                  <p><input id="coupon_code" name="devloungeCouponCode" class="input_color" placeholder="Coupon Code" value="<?php echo $devOptions['coupon_code'] ?>">
                                  <small>e.g. F20OFF</small></p>
                                </div>
							    <div class="row">
                                  <h3>Offer Good Till Date :</h3>
                                  <p><input id="offer_date" name="devloungeOfferDate" class="input_color" value="<?php echo $devOptions['offer_date'] ?>"></p>
                                </div>
							    <div class="row">
                                  <h3>End Time for Offer :</h3>
                                  <p><select id="offer_time" name="devloungeOfferTime" value="<?php echo $devOptions['offer_time'] ?>"></p>
								  <option value="1:00 AM"<?php if ($devOptions['offer_time'] == '1:00 AM') echo ' selected="selected"'; ?>>1:00 AM</option>
								  <option value="2:00 AM"<?php if ($devOptions['offer_time'] == '2:00 AM') echo ' selected="selected"'; ?>>2:00 AM</option>
								  <option value="3:00 AM"<?php if ($devOptions['offer_time'] == '3:00 AM') echo ' selected="selected"'; ?>>3:00 AM</option>
								  <option value="4:00 AM"<?php if ($devOptions['offer_time'] == '4:00 AM') echo ' selected="selected"'; ?>>4:00 AM</option>
								  <option value="5:00 AM"<?php if ($devOptions['offer_time'] == '5:00 AM') echo ' selected="selected"'; ?>>5:00 AM</option>
								  <option value="6:00 AM"<?php if ($devOptions['offer_time'] == '6:00 AM') echo ' selected="selected"'; ?>>6:00 AM</option>
								  <option value="7:00 AM"<?php if ($devOptions['offer_time'] == '7:00 AM') echo ' selected="selected"'; ?>>7:00 AM</option>
								  <option value="8:00 AM"<?php if ($devOptions['offer_time'] == '8:00 AM') echo ' selected="selected"'; ?>>8:00 AM</option>
								  <option value="9:00 AM"<?php if ($devOptions['offer_time'] == '9:00 AM') echo ' selected="selected"'; ?>>9:00 AM</option>
								  <option value="10:00 AM"<?php if ($devOptions['offer_time'] == '10:00 AM') echo ' selected="selected"'; ?>>10:00 AM</option>
								  <option value="11:00 AM"<?php if ($devOptions['offer_time'] == '11:00 AM') echo ' selected="selected"'; ?>>11:00 AM</option>
								  <option value="12:00 AM"<?php if ($devOptions['offer_time'] == '12:00 AM') echo ' selected="selected"'; ?>>12:00 AM</option>
								  <option value="1:00 PM"<?php if ($devOptions['offer_time'] == '1:00 PM') echo ' selected="selected"'; ?>>1:00 PM</option>
								  <option value="2:00 PM"<?php if ($devOptions['offer_time'] == '2:00 PM') echo ' selected="selected"'; ?>>2:00 PM</option>
								  <option value="3:00 PM"<?php if ($devOptions['offer_time'] == '3:00 PM') echo ' selected="selected"'; ?>>3:00 PM</option>
								  <option value="4:00 PM"<?php if ($devOptions['offer_time'] == '4:00 PM') echo ' selected="selected"'; ?>>4:00 PM</option>
								  <option value="5:00 PM"<?php if ($devOptions['offer_time'] == '5:00 PM') echo ' selected="selected"'; ?>>5:00 PM</option>
								  <option value="6:00 PM"<?php if ($devOptions['offer_time'] == '6:00 PM') echo ' selected="selected"'; ?>>6:00 PM</option>
								  <option value="7:00 PM"<?php if ($devOptions['offer_time'] == '7:00 PM') echo ' selected="selected"'; ?>>7:00 PM</option>
								  <option value="8:00 PM"<?php if ($devOptions['offer_time'] == '8:00 PM') echo ' selected="selected"'; ?>>8:00 PM</option>
								  <option value="9:00 PM"<?php if ($devOptions['offer_time'] == '9:00 PM') echo ' selected="selected"'; ?>>9:00 PM</option>
								  <option value="10:00 PM"<?php if ($devOptions['offer_time'] == '10:00 PM') echo ' selected="selected"'; ?>>10:00 PM</option>
								  <option value="11:00 PM"<?php if ($devOptions['offer_time'] == '11:00 PM') echo ' selected="selected"'; ?>>11:00 PM</option>
								  <option value="12:00 PM"<?php if ($devOptions['offer_time'] == 'Noon') echo ' selected="selected"'; ?>>Noon</option>
                                  </select>
                                </div>
                                <div class="row">
                                  <h3>Time zone :</h3>
                                  <p><select id="time_zone" name="devloungeTimeZone" value="<?php echo $devOptions['time_zone'] ?>"></p>
								  <option value="0.1">Select Your Timezone</option>
								  <option value="-12.0"<?php if ($devOptions['time_zone'] == '-12.0') echo ' selected="selected"'; ?>>(GMT -12:00) Eniwetok, Kwajalein</option>
								  <option value="-11.0"<?php if ($devOptions['time_zone'] == '-11.0') echo ' selected="selected"'; ?>>(GMT -11:00) Midway Island, Samoa</option>
								  <option value="-10.0"<?php if ($devOptions['time_zone'] == '10.0') echo ' selected="selected"'; ?>>(GMT -10:00) Hawaii</option>
								  <option value="-9.0"<?php if ($devOptions['time_zone'] == '-9.0') echo ' selected="selected"'; ?>>(GMT -9:00) Alaska</option>
								  <option value="-8.0"<?php if ($devOptions['time_zone'] == '-8.0') echo ' selected="selected"'; ?>>(GMT -8:00) Pacific Time (US &amp; Canada)</option>
								  <option value="-7.0"<?php if ($devOptions['time_zone'] == '-7.0') echo ' selected="selected"'; ?>>(GMT -7:00) Mountain Time (US &amp; Canada)</option>
								  <option value="-6.0"<?php if ($devOptions['time_zone'] == '-6.0') echo ' selected="selected"'; ?>>(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
								  <option value="-5.0"<?php if ($devOptions['time_zone'] == '-5.0') echo ' selected="selected"'; ?>>(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
								  <option value="-4.0"<?php if ($devOptions['time_zone'] == '-4.0') echo ' selected="selected"'; ?>>(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
								  <option value="-3.5"<?php if ($devOptions['time_zone'] == '3.5') echo ' selected="selected"'; ?>>(GMT -3:30) Newfoundland</option>
								  <option value="-3.0"<?php if ($devOptions['time_zone'] == '-3.0') echo ' selected="selected"'; ?>>(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
								  <option value="-2.0"<?php if ($devOptions['time_zone'] == '-2.0') echo ' selected="selected"'; ?>>(GMT -2:00) Mid-Atlantic</option>
								  <option value="-1.0"<?php if ($devOptions['time_zone'] == '-1.0') echo ' selected="selected"'; ?>>(GMT -1:00 hour) Azores, Cape Verde Islands</option>
								  <option value="0.0"<?php if ($devOptions['time_zone'] == '0.0') echo ' selected="selected"'; ?>>(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
								  <option value="1.0"<?php if ($devOptions['time_zone'] == '1.0') echo ' selected="selected"'; ?>>(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris</option>
								  <option value="2.0"<?php if ($devOptions['time_zone'] == '2.0') echo ' selected="selected"'; ?>>(GMT +2:00) Kaliningrad, South Africa</option>
								  <option value="3.0"<?php if ($devOptions['time_zone'] == '3.0') echo ' selected="selected"'; ?>>(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
								  <option value="3.5"<?php if ($devOptions['time_zone'] == '3.5') echo ' selected="selected"'; ?>>(GMT +3:30) Tehran</option>
								  <option value="4.0"<?php if ($devOptions['time_zone'] == '4.0') echo ' selected="selected"'; ?>>(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
								  <option value="4.5"<?php if ($devOptions['time_zone'] == '4.5') echo ' selected="selected"'; ?>>(GMT +4:30) Kabul</option>
								  <option value="5.0"<?php if ($devOptions['time_zone'] == '5.0') echo ' selected="selected"'; ?>>(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
								  <option value="5.5"<?php if ($devOptions['time_zone'] == '5.5') echo ' selected="selected"'; ?>>(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
								  <option value="5.75"<?php if ($devOptions['time_zone'] == '5.75') echo ' selected="selected"'; ?>>(GMT +5:45) Kathmandu</option>
								  <option value="6.0"<?php if ($devOptions['time_zone'] == '6.0') echo ' selected="selected"'; ?>>(GMT +6:00) Almaty, Dhaka, Colombo</option>
								  <option value="7.0"<?php if ($devOptions['time_zone'] == '7.0') echo ' selected="selected"'; ?>>(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
								  <option value="8.0"<?php if ($devOptions['time_zone'] == '8.0') echo ' selected="selected"'; ?>>(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
								  <option value="9.0"<?php if ($devOptions['time_zone'] == '9.0') echo ' selected="selected"'; ?>>(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
								  <option value="9.5"<?php if ($devOptions['time_zone'] == '9.5') echo ' selected="selected"'; ?>>(GMT +9:30) Adelaide, Darwin</option>
								  <option value="10.0"<?php if ($devOptions['time_zone'] == '10.0') echo ' selected="selected"'; ?>>(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
								  <option value="11.0"<?php if ($devOptions['time_zone'] == '11.0') echo ' selected="selected"'; ?>>(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
								  <option value="12.0"<?php if ($devOptions['time_zone'] == '12.0') echo ' selected="selected"'; ?>>(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
								  </select>
                                </div>
								</br>
<!-- End OF Configure Coupon Details...................................................................................................................................-->  

                                <div class="row" style="width: 90%;"><hr>
                                  <h2>Configure Sharing options</h2></div>
                                <div class="row" style="width: 90%;"><hr></div>
                                <div class="row">
                                  <h3>Require Users to Share? :</h3>
                                   <?php
                                       if($devOptions['user_to_share'] == 1) {
                                                 $select = 'checked';
                                   }
                                        else {
                                                     $select = '';
                                 } ?>
                                 <input type="hidden" name="devloungeUserToShare" value="0"/>
                                 <p><input id="user_to_share" type="checkbox" name="devloungeUserToShare" value="1"<?php echo $select ?>>Yes<br/>
								 <?php
                                       if($devOptions['fb_share'] == 1) {
                                                 $select = 'checked';
                                   }
                                        else {
                                                     $select = '';
                                 } ?>

                                 <input type="hidden" name="devloungeFacebookShare" value="0"/>
                                 <input id="fb_share" type="checkbox" name="devloungeFacebookShare" value="1"<?php echo $select ?>>
								 <label id="fb_share">Facebook</label><br/>
								 <?php
                                       if($devOptions['twitter_share'] == 1) {
                                                 $select = 'checked';
                                   }
                                        else {
                                                     $select = '';
                                 } ?>

                                 <input type="hidden" name="devloungeTwitterShare" value="0"/>
                                 <input id="twitter_share" type="checkbox" name="devloungeTwitterShare" value="1"<?php echo $select ?>>
								  <label id="twitter_share">Twitter</label><br/></p>

                                </div>
							    <div class="row">
                                  <h3>Enter URL to redirect user:</h3>
                                  <p><input id="redirect_url" name="devloungeRedirectUrl" class="input_color" value="<?php echo $devOptions['redirect_url'] ?>">
                                  <small>URL where user to be redirect to avail this offer. If not , leave blank.</small></p>
                                </div>
							    <div class="row">
                                  <h3>From Name:</h3>
                                  <p><input id="from_name" name="devloungeFromName" class="input_color" value="<?php echo $devOptions['from_name'] ?>">
                                  <small>User will be sent a coupon from this name.</small></p>
                                </div>
                                <div class="row">
                                  <h3>Reply to Email address:</h3>
                                  <p><input id="email_address" name="devloungeEmailAddress" class="input_color" value="<?php echo $devOptions['email_address'] ?>">
                                  <small>User will be sent a coupon from this email address.</small></p>
                                </div>
							    <div class="row">
                                  <h3>Allow "SocialAppsHQ" logo</h3>
                                  <?php
                                    if($devOptions['app_logo'] == 1) {
                                      $select = 'checked';
                                    }
                                    else {
                                      $select = '';
                                    } ?>

                                  <input type="hidden" name="devloungeAppLogo" value="1"/>
                                  <p><input id="app_logo" type="checkbox" onclick="return false;" name="devloungeAppLogo" value="1"<?php echo $select ?>>Yes
								  <small>Only paid users can hide SocialAppsHQ logo.</small></p>
                                </div>
                                <div class="row" style="width: 90%;"><hr></div>
                                <div class="row">
                                <div class="submit" style="clear: both;">
                                <input type="submit" name="update_devloungePluginSeriesSettings" value="Update Settings" class="btn-primary" >
                                <div id='status' style='display:none'>
                                    <img src="<?php echo site_url()?>/wp-content/plugins/wp-coupon-widget/images/ajax-loader.gif">
                                </div>                           
                                </div>						
                                </div>
                                </form>
                            </div>
                            <div style="float: left; width: 28%">
                                <p style="font-size: 18px; width: 100%; float: left; margin-top:-1614px; margin-left:830px;">Mockup of Widget<br/><br/>
                                <img src="<?php echo site_url()?>/wp-content/plugins/wp-coupon-widget/images/coupon.png"></p>
                            </div>
                            </div>

                        <?php
                }
	    }
    }
if (class_exists("CouponAdmin")) {
	$dl_pluginSeries_coupon = new CouponAdmin();
}

function coupon_admin_notices() {
    echo "<div id='notice' class='updated fade'><p><h2>Coupon Bar is not configured yet. Please do it now.</h2>
          <br/><a href='"+site_url()+"/wp-admin/admin.php?page=coupon-menu-configuration'><img src='"+site_url()+"/wp-content/plugins/wp-coupon-widget/images/configure.png'></img></a>
          </p></div>\n";
}


function my_coupon_menu() {
   	add_menu_page( 'Configure Coupon Bar', 'Coupon', 'manage_options', 'coupon-menu-id', 'my_coupon_options', '../wp-content/plugins/wp-coupon-widget/images/favicon.ico');
	add_options_page( 'Configure Coupon Bar', 'Coupon', 'manage_options', 'coupon-menu-configuration', 'my_coupon_options' );
}

function my_coupon_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

    global $dl_pluginSeries_coupon;
    if (!isset($dl_pluginSeries_coupon)) {
         return;
    }

    $dl_pluginSeries_coupon->printAdminPage();
	remove_action( 'admin_notices', 'coupon_admin_notices' );
}
?>
