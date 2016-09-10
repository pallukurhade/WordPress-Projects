<?php get_header(); ?>
  <?php roots_content_before(); ?>
    <div id="content" class="<?php echo CONTAINER_CLASSES; ?>">
    <?php roots_main_before(); ?>
      <div id="main" class="<?php echo MAIN_CLASSES; ?>" role="main">
	  <?php if ( function_exists('show_nivo_slider') ) { show_nivo_slider(); } ?>
	  <?php// echo quoteRotator(); ?>
	  <?php if( function_exists( "get_testimonial_slider_recent" ) ){ get_testimonial_slider_recent( $set="1") ;}?>
	  <?php roots_loop_before(); ?>
	  <?php //echo do_shortcode('[bftpro 1]'); ?>
        <?php get_template_part('loop', 'page'); ?>
        <?php roots_loop_after(); ?>
      </div><!-- /#main -->
    <?php roots_main_after(); ?>
    <?php roots_sidebar_before(); ?>
      <aside id="sidebar" class="<?php echo SIDEBAR_CLASSES; ?>" role="complementary">
      <?php roots_sidebar_inside_before(); ?>
        <?php //get_sidebar(); ?>
		<?php echo do_shortcode('[bftpro 1]'); ?>
      <?php roots_sidebar_inside_after(); ?>
      </aside><!-- /#sidebar -->
    <?php roots_sidebar_after(); ?>
    </div><!-- /#content -->
  <?php roots_content_after(); ?>
<?php get_footer(); ?>