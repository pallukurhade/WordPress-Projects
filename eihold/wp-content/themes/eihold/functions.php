<?php
/**
 * Roots functions
 */

if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

require_once locate_template('/inc/util.php');            // Utility functions
require_once locate_template('/inc/config.php');          // Configuration and constants
require_once locate_template('/inc/activation.php');      // Theme activation
require_once locate_template('/inc/template-tags.php');   // Template tags
require_once locate_template('/inc/cleanup.php');         // Cleanup
require_once locate_template('/inc/scripts.php');         // Scripts and stylesheets
require_once locate_template('/inc/htaccess.php');        // Rewrites for assets, H5BP .htaccess
require_once locate_template('/inc/hooks.php');           // Hooks
require_once locate_template('/inc/actions.php');         // Actions
require_once locate_template('/inc/widgets.php');         // Sidebars and widgets
require_once locate_template('/inc/custom.php');          // Custom functions

function roots_setup() {

  // Make theme available for translation
  load_theme_textdomain('roots', get_template_directory() . '/lang');

  // Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
  register_nav_menus(array(
    'primary_navigation' => __('Primary Navigation', 'roots'),
  ));

  // Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
  add_theme_support('post-thumbnails');
  // set_post_thumbnail_size(150, 150, false);
  // add_image_size('category-thumb', 300, 9999); // 300px wide (and unlimited height)

  // Add post formats (http://codex.wordpress.org/Post_Formats)
  // add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

  // Tell the TinyMCE editor to use a custom stylesheet
  add_editor_style('css/editor-style.css');

}

add_action('after_setup_theme', 'roots_setup');
add_action('admin_menu', 'wpns_add_menu');
add_action('admin_init', 'wpns_reg_function' );
add_action('wp_enqueue_scripts', 'wpns_add_scripts' );

//register of default values in plugin activation
//register_activation_hook( __FILE__, 'wpns_activate' );

//add post tumbnails
add_theme_support('post-thumbnails');

//create the menu panel
function wpns_add_menu() {
    $page = add_options_page('WP Nivo Slider', 'WP Nivo Slider', 'administrator', 'wpns_menu', 'wpns_menu_function');
}

//create group of variables
function wpns_reg_function() {
	register_setting( 'wpns-settings-group', 'wpns_category' );
	register_setting( 'wpns-settings-group', 'wpns_effect' );
	register_setting( 'wpns-settings-group', 'wpns_slices' );
	register_setting( 'wpns-settings-group', 'wpns_width' );
	register_setting( 'wpns-settings-group', 'wpns_height' );
	register_setting( 'wpns-settings-group', 'wpns_theme' );
}

//add default value to variables
function wpns_activate() {
	add_option('wpns_category','1');
	add_option('wpns_effect','random');
	add_option('wpns_slices','5');
	add_option('wpns_theme','default');
}

/**
 * Enqueue plugin style-file
 */
function wpns_add_scripts() {
    //Main css file
    wp_register_style( 'wpns-style', get_template_directory_uri().'/css/nivo-slider.css');

    //Theme css file
    $wpns_theme = get_option('wpns_theme');
    if ($wpns_theme == "bar") {
    	wp_register_style( 'wpns-style-theme', get_template_directory_uri().'/themes/bar/bar.css');
    }
    elseif ($wpns_theme == "dark") {
	    wp_register_style( 'wpns-style-theme', get_template_directory_uri().'/themes/dark/dark.css');
    }
    elseif ($wpns_theme == "light") {
	    wp_register_style( 'wpns-style-theme', get_template_directory_uri().'/themes/light/light.css');
    }
    else {
	    wp_register_style( 'wpns-style-theme', get_template_directory_uri().'/themes/default/default.css');
    }

    //enqueue css
    wp_enqueue_style( 'wpns-style' );
    wp_enqueue_style( 'wpns-style-theme' );

    wp_enqueue_script('wpns-js',get_template_directory_uri().'/js/jquery.nivo.slider.pack.js', array('jquery'));
}

function show_nivo_slider() {
?>

<?php
	$wpns_theme = get_option('wpns_theme');
	$wpns_width = get_option('wpns_width');
?>
<style>
.slider-wrapper {
    width:<?php echo get_option('wpns_width'); ?>px; /* Change this to your images width */
    height:<?php echo get_option('wpns_height'); ?>px; /* Change this to your images height */
}
#wpns_slider {
    width:<?php echo get_option('wpns_width'); ?>px; /* Change this to your images width */
    height:<?php echo get_option('wpns_height'); ?>px; /* Change this to your images height */
}
.nivoSlider {
    position:relative;
}
.nivoSlider img {
    position:absolute;
    top:0px;
    left:0px;
    display:none;
}
.nivoSlider a {
    border:0;
    display:block;
}
</style>

<script type="text/javascript">
jQuery(window).load(function() {
	jQuery('#wpns_slider').nivoSlider({
		effect:'<?php echo get_option('wpns_effect'); ?>',
		slices:<?php echo get_option('wpns_slices'); ?>,
	});
});
</script>

<div class="slider-wrapper theme-<?php echo $wpns_theme; ?>">
	<div id="wpns_slider" class="nivoSlider">
	<?php
		$category = get_option('wpns_category');
		$n_slices = get_option('wpns_slices');
		
	?>
	<?php query_posts( 'cat='.$category.'&posts_per_page='.$n_slices ); if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		<?php if ( '' != get_the_post_thumbnail() ) : ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(); ?>
			</a>
		<?php endif ?>
	<?php endwhile; endif;?>
	<?php wp_reset_query();?>
	</div>
</div>
<?php }

function wpns_menu_function() {

?>

<div class="wrap">
<h2>WP Nivo Slider</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'wpns-settings-group' ); ?>
    <table class="form-table">

        <tr valign="top">
        <th scope="row">Category</th>
        <td>
        <select name="wpns_category" id="wpns_category">
			 <option value="">Select a Category</option>
 			<?php
 				$category = get_option('wpns_category');
  				$categories=  get_categories();
  				foreach ($categories as $cat) {
  					$option = '<option value="'.$cat->term_id.'"';
  					if ($category == $cat->term_id) $option .= ' selected="selected">';
  					else { $option .= '>'; }
					$option .= $cat->cat_name;
					$option .= ' ('.$cat->category_count.')';
					$option .= '</option>';
					echo $option;
  				}
 			?>
		</select>

        </tr>

    	<tr valign="top">
        <th scope="row">Number of slices</th>
        <td>
        <label>
        <input type="text" name="wpns_slices" id="wpns_slices" size="7" value="<?php echo get_option('wpns_slices'); ?>" />
        </label>
        </tr>

        <tr valign="top">
        <th scope="row">Type of Animation</th>
        <td>
        <label>
        <?php $effect = get_option('wpns_effect'); ?>
        <select name="wpns_effect" id="wpns_effect">
        	<option value="random" <?php if($effect == 'random') echo 'selected="selected"'; ?>>Random</option>
        	<option value="sliceDown" <?php if($effect == 'sliceDown') echo 'selected="selected"'; ?> >sliceDown</option>
        	<option value="sliceDownLeft" <?php if($effect == 'sliceDownLeft') echo 'selected="selected"'; ?> >sliceDownLeft</option>
        	<option value="sliceUp" <?php if($effect == 'sliceUp') echo 'selected="selected"'; ?> >sliceUp</option>
        	<option value="sliceUpLeft" <?php if($effect == 'sliceUpLeft') echo 'selected="selected"'; ?> >sliceUpLeft</option>
        	<option value="sliceUpDown" <?php if($effect == 'sliceUpDown') echo 'selected="selected"'; ?> >sliceUpDown</option>
        	<option value="sliceUpDownLeft" <?php if($effect == 'sliceUpDownLeft') echo 'selected="selected"'; ?> >sliceUpDownLeft</option>
        	<option value="fold" <?php if($effect == 'fold') echo 'selected="selected"'; ?> >fold</option>
        	<option value="fade" <?php if($effect == 'fade') echo 'selected="selected"'; ?> >fade</option>
        	<option value="slideInRight" <?php if($effect == 'slideInRight') echo 'selected="selected"'; ?> >slideInRight</option>
        	<option value="slideInLeft" <?php if($effect == 'slideInLeft') echo 'selected="selected"'; ?> >slideInLeft</option>
        	<option value="boxRandom" <?php if($effect == 'boxRandom') echo 'selected="selected"'; ?> >boxRandom</option>
        	<option value="boxRain" <?php if($effect == 'boxRain') echo 'selected="selected"'; ?> >boxRain</option>
        	<option value="boxRainReverse" <?php if($effect == 'boxRainReverse') echo 'selected="selected"'; ?> >boxRainReverse</option>
        	<option value="boxRainGrow" <?php if($effect == 'boxRainGrow') echo 'selected="selected"'; ?> >boxRainGrow</option>
        	<option value="boxRainGrowReverse" <?php if($effect == 'boxRainGrowReverse') echo 'selected="selected"'; ?> >boxRainGrowReverse</option>
        	
        </select>
        </label>
        </tr>

        <tr valign="top">
        <th scope="row">Theme</th>
        <td>
        <label>
        <?php $wpns_theme = get_option('wpns_theme'); ?>
        <select name="wpns_theme" id="wpns_theme">
        	<option value="bar" <?php if($wpns_theme == 'bar') echo 'selected="selected"'; ?>>Bar</option>
        	<option value="dark" <?php if($wpns_theme == 'dark') echo 'selected="selected"'; ?> >Dark</option>
        	<option value="default" <?php if($wpns_theme == 'default') echo 'selected="selected"'; ?> >Default</option>
        	<option value="light" <?php if($wpns_theme == 'sliceUp') echo 'selected="selected"'; ?> >Light</option>
        </select>
        </label>
        </tr>

		<tr valign="top">
			<td>This is size of yours images. This plugin do not resize images.</td>
        </tr>

		<tr valign="top">
        <th scope="row">Width</th>
        <td>
        <label>
        <input type="text" name="wpns_width" id="wpns_width" size="7" value="<?php echo get_option('wpns_width'); ?>" />px
        </label>
        </tr>

		<tr valign="top">
        <th scope="row">Height</th>
        <td>
        <label>
        <input type="text" name="wpns_height" id="wpns_height" size="7" value="<?php echo get_option('wpns_height'); ?>" />px
        </label>
        </tr>

    </table>

    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>

</form>
</div>

<?php } ?>
