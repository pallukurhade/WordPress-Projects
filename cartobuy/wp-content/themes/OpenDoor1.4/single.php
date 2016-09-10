<?php
 get_header(); 
?>

<div class="sixteen columns outercontainer bigheading">
	<div class="four columns alpha">
		&nbsp;
	</div>
	<div class="twelve columns omega">
		<h2 id="title" class="blogtitle"><?php the_title(); ?></h2>
	</div>
</div>	


<div class="sixteen columns outercontainer" id="content">
	<div class="four columns alpha" id="leftsidebar">
		<?php get_sidebar() ?>
	</div>
	
	<div class="twelve columns omega">	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
			 <div <?php post_class() ?>    id="post-<?php echo the_ID(); ?>">
		  
					<?php if (get_option('wp_showblogimage') == 'show') { ?> 
						<?php
						if ( has_post_thumbnail() ) {
							
							the_post_thumbnail('medium');
						}  ?>
					 <?php } ?>
					
<?php 
		//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
		if ( get_stylesheet_directory() != get_template_directory() && 
		file_exists(get_stylesheet_directory().'/includes/postmeta.php') ) 
		{			
			include get_stylesheet_directory() . '/includes/postmeta.php';
								
		}
		else {
											
			include get_template_directory() . '/includes/postmeta.php';
								
		}	


?>
<?php the_tags() ?>
					<?php the_content(); ?>
						<?php if(get_option('wp_showsociallinks2') == "show") {
							//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
							if ( get_stylesheet_directory() != get_template_directory() && 
							file_exists(get_stylesheet_directory().'/includes/sociallinks.php') ) 
							{			
								include get_stylesheet_directory() . '/includes/sociallinks.php';
													
							}
							else {
																
								include get_template_directory() . '/includes/sociallinks.php';
													
							}	

							}
						?>
					<?php if (get_option('wp_showcomments') == 'show') { ?>
						<?php if ($post->comment_status == "open") { ?>
						<?php comments_template('', true); ?>
						<?php } ?>
					<?php } ?>
				
			</div>
		<?php endwhile; else: ?>
		 
		
<?php endif; ?>
</div>
</div>

<?php get_footer(); ?>