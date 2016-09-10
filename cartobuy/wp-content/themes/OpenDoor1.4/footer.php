<?php if (get_option('wp_showfooter') == "show") { ?>
	<div class="sixteen columns outercontainer" id="footer">

		<?php 		
			//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
			if ( get_stylesheet_directory() != get_template_directory() && 
			file_exists(get_stylesheet_directory().'/includes/variables.php') ) 
			{			
				include get_stylesheet_directory() . '/includes/variables.php';
			}
			else {
							
				include get_template_directory() . '/includes/variables.php';
			}
				
		 ?>

		<div class="four columns alpha">
				<?php dynamic_sidebar('Footer 1') ?>
		</div>

		<div class="four columns">
				<?php dynamic_sidebar('Footer 2') ?>
		</div>

		<div class="four columns">
				<?php dynamic_sidebar('Footer 3') ?>
		</div>

		<div class="four columns omega">
				<?php dynamic_sidebar('Footer 4') ?>
		</div>


	</div><!-- end footer -->
<?php } ?>

<div class="sixteen columns outercontainer" id="belowfooter">
	<div class="six columns alpha">
		<p id="copyright"><?php echo stripslashes(get_option('wp_copyright')) ?></p>
	</div>
	
	<div class="ten columns omega">
	<?php if (has_nav_menu('footer')) {
		wp_nav_menu( array('theme_location' => 'footer', 'container' => 'div', 'sort_column' => 'menu_order', 'menu_id' => 'footermenu' ) );
		} else {
		echo "Footer menu area. Create your footer menu in Appearance -> Menus";
		} ?>
	</div>
	
	<?php if (get_option('wp_showlogin') == "show") { ?>
		<ul id="login" style="display: none;">
			<li class="login"><a href="#" data-toggle="collapse" data-target="#login-panel">
				<?php if ( ! is_user_logged_in() ){ ?><?php echo get_option('wp_logintext')  ?><?php } else { ?><?php echo get_option('wp_controlpaneltext')  ?><?php } ?>
			</a></li>
		</ul>
	<?php } ?>
	
</div>

<?php echo stripslashes(get_option('wp_ga_code')) ?>
</div><!-- end container (started in header) -->
<?php wp_footer(); ?>
</body>
</html>