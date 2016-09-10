<?php if (get_option('wp_showlogin') == "show") { ?>





<div id="login-panel" class="sixteen columns outercontainer collapse"><!--SLIDE PANEL STARTS-->
<?php if ( ! is_user_logged_in() ){ ?>

	<div class="loginform">
	<h2><?php echo get_option('wp_logintext')  ?></h2>
	
	<div class="formdetails">
		<form action="<?php echo home_url(); ?>/wp-login.php" method="post">
			<div id="loginusername">
				<label for="log"><?php echo get_option('wp_username_text') ?> : </label>
				<input type="text" name="log" id="log" value="<?php echo esc_html(stripslashes($user_login), 1) ?>" size="20" />
			</div>
			
			<div id="loginpassword">
				<label for="pwd"><?php echo get_option('wp_password_text') ?> : </label><input type="password" name="pwd" id="pwd" size="20" />
				<input type="submit" name="submit" value="Login" class="btn" />
			</div>
			
			<div id="rememberme">
				<label for="remember"><input name="rememberme" id="remember" type="checkbox" checked="checked" value="forever" /> <?php echo get_option('wp_rememberme_text') ?></label><br />
				<a href="<?php echo home_url(); ?>/wp-register.php"><?php echo get_option('wp_register_text') ?></a> |
				<a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword"><?php echo get_option('wp_recoverpassword_text') ?></a>
			</div>
			<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
		</form>
	</div>
	
	</div><!--loginform ends-->

<?php } else { ?>

	<div class="loginform logout">	
	<h2><?php echo get_option('wp_controlpaneltext')  ?></h2>
	
		<ul>
			<?php if (get_option('wp_logindashboard') == "show") { ?>
				<li><a href="<?php home_url(); ?>/wp-admin/"><?php echo get_option('wp_logindashboardtext') ?></a></li>
			<?php } ?>
			
			<?php if (get_option('wp_loginlisting') == "show") { ?>
				<li><a href="<?php home_url(); ?>/wp-admin/post-new.php?post_type=listing"><?php echo get_option('wp_loginlistingtext') ?></a></li>
			<?php } ?>
			
			<?php if (get_option('wp_loginpost') == "show") { ?>
				<li><a href="<?php home_url(); ?>/wp-admin/post-new.php"><?php echo get_option('wp_loginposttext') ?></a></li>
			<?php } ?>
			
			<li><a class="btn" href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout"><?php echo get_option('wp_logouttext') ?></a></li>
		</ul>
	</div><!--loginform ends-->
<?php }?>
</div><!--SLIDE PANEL ENDS-->
	
	



	
	
<?php } ?>