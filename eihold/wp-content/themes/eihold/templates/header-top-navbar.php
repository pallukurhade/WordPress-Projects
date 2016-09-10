<header id="banner" class="navbar" role="banner">
  <?php roots_header_inside(); ?>
  <div class="topnavi">
    <div class="logo-menu">  
      <a class="brand" href="<?php echo home_url(); ?>/">
       <img src="<?php echo get_template_directory_uri();?>/img/emerland.png">
      </a>
	  	  <form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
         <label class="hide-text" for="shome"><?php _e('Search for:', 'roots'); ?></label>
         <input type="text" value="" name="shome" id="shome" class="search-query" placeholder="<?php _e('Search for Course, Unit, Subject, Chapter', 'roots'); ?> <?php bloginfo('name'); ?>">
         <input type="submit" id="searchsubmithome" value="<?php _e('Search', 'roots'); ?>" class="btn">
         </form>
	  </div>
	 
  </div>	  
       
  <div class="navbar-inner">
    <div class="<?php echo WRAP_CLASSES; ?>">
      <nav id="nav-main" class="nav-collapse" role="navigation">
        <?php wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'nav')); ?>
      </nav>
    </div>
  </div>
</header>