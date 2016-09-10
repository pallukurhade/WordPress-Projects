<div id="sidebar-left">
<div class="inner">

	<?php 	
	//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
	if ( get_stylesheet_directory() != get_template_directory() && 
	file_exists(get_stylesheet_directory().'/includes/search.php') ) 
	{			
		include get_stylesheet_directory() . '/includes/search.php';
							
	}
	else {
										
		include get_template_directory() . '/includes/search.php';
							
	}	
	
	
	 ?>

	<div id="agentcontainer"></div>

	<?php if (get_option('wp_loancalculator2') == "show") {
		
		//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
		if ( get_stylesheet_directory() != get_template_directory() && 
		file_exists(get_stylesheet_directory().'/includes/loancalculator.php') ) 
		{			
			include get_stylesheet_directory() . '/includes/loancalculator.php';
								
		}
		else {
											
			include get_template_directory() . '/includes/loancalculator.php';
								
		}	
		
	} ?>

	<div id="leftsidebarwidgets">
	<?php dynamic_sidebar('Left Sidebar (not homepage)') ?>
	</div>

</div><!-- end inner -->
</div><!-- end sidebar -->



