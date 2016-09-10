<?php 

/*
	Template Name: Agents (For Real Estate site only)
*/ 

?>


<?php get_header() ?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="sixteen columns outercontainer bigheading">
		<div class="four columns alpha">
			&nbsp;
		</div>
		<div class="twelve columns omega">
			<h2 id="title"><?php the_title(); ?></h2>
		</div>
	</div>	
<?php endwhile; endif; 
wp_reset_query(); 
?>


<div class="sixteen columns outercontainer" id="content">
	<div class="four columns alpha" id="leftsidebar">
		<?php get_sidebar() ?>
	</div>
	
	<div class="twelve columns omega">	
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; endif; 
		wp_reset_query(); 
		?>
	
	
		<?php 
		$agents = new WP_Query('post_type=agent&posts_per_page=-1&orderby=meta_value_num&meta_key=agentorder_value&order=ASC');
		?>



		<?php if ($agents->have_posts()) : while ($agents->have_posts()) : $agents->the_post(); 
		
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
				


			
			<div class="six columns personresultblock">
				<h4 class="bar"><?php the_title() ?></h4>
			
				<?php $arr_sliderimages = get_gallery_images();
				
				if ($arr_sliderimages) { ?>
					<?php $resized = aq_resize($arr_sliderimages[0], 120, 150, true); ?>
					<img class="alignleft" width="120" height="150" alt="" src="<?php echo $resized ?>" />
				<?php } ?>
				
					<p>
						<?php if ($agenttitle) { ?>
							<strong><?php echo $agenttitle ?></strong><br />
						<?php } ?>
						
						<?php if ($agentemail) { ?>
							<a href="mailto:<?php echo $agentemail ?>"><?php echo get_option('wp_email_text') ?></a><br />
						<?php } ?>
						
						<?php if($agentphoneoffice) { ?>
							<?php echo get_option('wp_agentphone1') . ": " ?><a href="tel:+<?php echo $agentphoneoffice ?>"><?php echo $agentphoneoffice ?></a><br />
						<?php } ?>

						<?php if($agentphonemobile) { ?>
							<?php echo get_option('wp_agentphone2') . ": " ?><a href="tel:+<?php echo $agentphonemobile ?>"><?php echo $agentphonemobile ?></a><br />
						<?php } ?>
						
						<?php if($agentfax) { ?>
							<?php echo get_option('wp_agentfax') . ": " . $agentfax ?><br />
						<?php } ?>
						
						
						<a class='btn' href="<?php the_permalink() ?>">
							 <?php echo get_option('wp_readmore_text'); ?>
						</a>
						
					</p>
			</div>		

			
			
		<?php endwhile; else: ?>

		<?php endif; 
		wp_reset_query(); ?> 
	</div>
</div>

<?php get_footer() ?>