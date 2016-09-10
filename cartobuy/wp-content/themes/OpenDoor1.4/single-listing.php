<?php
 get_header(); 
?>



<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php 
	$agent = "";
	$agent2 = "";
	//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
	if ( get_stylesheet_directory() != get_template_directory() && 
	file_exists(get_stylesheet_directory().'/includes/variables.php') ) 
	{			
		include get_stylesheet_directory() . '/includes/variables.php';
										
	}
	else {
													
		include get_template_directory() . '/includes/variables.php';
										
	}	
			
	$contactformsubject = get_the_title();
	?>
	
	

	
	<div class="sixteen columns outercontainer bigheading">
	<div class="four columns alpha">
	&nbsp;
	</div>
	<div class="eight columns">
	
		<h2 id="title">
			<?php if (get_option('wp_site') == "Real Estate") {	?>
				<?php echo $address; ?>
			<?php } ?>
			<?php if (get_option('wp_site') == "Car Sales") {
				the_title();
				} ?>
		</h2>
	</div>
	<div class="four columns omega">
		<h2 id="pricebig">
		<?php 
		//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
		if ( get_stylesheet_directory() != get_template_directory() && 
		file_exists(get_stylesheet_directory().'/includes/price.php') ) 
		{			
			include get_stylesheet_directory() . '/includes/price.php';
										
		}
		else {
													
			include get_template_directory() . '/includes/price.php';
										
		}	
		
		 ?>
		</h2>
	</div>
	</div>	

	<div class="sixteen columns outercontainer" id="content">
	<div class="four columns alpha" id="leftsidebar">
		<?php get_sidebar() ?>
	</div>
	
	<div class="twelve columns omega">	
		<?php if(get_option('wp_site') == "Real Estate") { ?>
			<h3 class="detailpagesubheading">
				<?php echo $citystatezip; ?>
				<?php if (get_option('wp_showmls') == "show" && $mls ) {
					echo " (" . get_option('wp_mls_text') . " # " . $mls . ")";
				} ?>
			</h3>	
		<?php } ?>
		
		<div id="printimage" style="display: none;">
			<?php 
				$arr_sliderimages = get_gallery_images();
				$resized = aq_resize($arr_sliderimages[0], 300, 200,true);
			?>	
			<img alt="" src="<?php echo $resized ?>" />
		</div>
		
		
			<?php 
				$arr_sliderimages = get_gallery_images();
			?>	
				<?php if (count($arr_sliderimages) > 0) { ?>
					<div id="slider2" class="flexslider">
										<?php 
							if ( get_stylesheet_directory() != get_template_directory() && file_exists(get_stylesheet_directory().'/includes/banner.php') ) 
							{			
								include get_stylesheet_directory() . '/includes/banner.php';
							}
							else {
								include get_template_directory() . '/includes/banner.php';
							}
					?>
					<ul class="slides">
						<?php if(count($arr_sliderimages) > 1) { ?>
							<div class="imagehover2"></div>
						<?php } ?>
						
						<?php
							$count = 1;
							foreach ($arr_sliderimages as $image) { 
								$resized = aq_resize($image, 700, 450,true);
							?>
							<li>
							  	<a rel="prettyPhoto[pp_gal]" href="<?php echo $image ?>">
									<img alt="" src="<?php echo $resized ?>" />
								</a>
							</li>
						<?php
						$count = $count + 1;
						} ?>
					</ul>
					</div>
				<?php } ?>
				
				
				<?php if (count($arr_sliderimages) > 1) { ?>
					<div id="carousel" class="flexslider">
					<ul class="slides">
						<?php
							$count = 1;
							foreach ($arr_sliderimages as $image) { 
								$resized = aq_resize($image, 700, 450,true);
							?>
							<li>
								<img alt="" src="<?php echo $resized ?>" />
							</li>
						<?php
						$count = $count + 1;
						} ?>
					</ul>
					</div>
				<?php } ?>

			
			
		<div style="clear: both;"></div>	
		<!-- Videos section.  Will only show up if there are entries in the Video section of a post  -->
		<?php

		$videoimages = explode("\n", get_post_meta($post->ID, 'video_thumbnail_value', true));		
		$videourl = explode("\n", get_post_meta($post->ID, 'video_url_value', true));

		$count1 = count($videoimages);
		$count2 = count($videourl);
		?>

		<?php 

		if ($count1 >= 1 && get_post_meta($post->ID, 'video_thumbnail_value', true) != "" && $count1 == $count2) { ?>
		<div id="videos">


		<h3 class="bar"><?php echo get_option('wp_heading_videos');  ?></h3>

		<?php for ($i=0; $i<count($videoimages); $i++)
			{ 
			$resized = $videoimages[$i];
			?>
				<a href="<?php echo $videourl[$i]; ?>" rel="prettyPhoto" title="">
				<img class="videothumbnail" alt="" width="62" height="62" src="<?php echo $resized; ?>" />
				</a>
			<?php } ?>
			

		</div><!-- end videos -->
		<?php } ?>
		<div style="clear: both;"></div>

		
		
		<?php 		
		//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
		if ( get_stylesheet_directory() != get_template_directory() && 
		file_exists(get_stylesheet_directory().'/includes/details.php') ) 
		{			
			include get_stylesheet_directory() . '/includes/details.php';
										
		}
		else {
													
			include get_template_directory() . '/includes/details.php';
										
		}	
				
		 ?>

			
		<div id="listingcontent">
			<?php the_content(); ?>
		</div>

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

	


		<?php if (get_option('wp_site') == "Real Estate") { ?>
			<div id="maps">
				<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
				<?php $manualaddress = get_post_meta($post->ID, "google_location_value", $single = true) ?>
				<?php if ($manualaddress) {
				$mapaddress = $manualaddress;
				} else {
				$mapaddress = $address . " " . $citystatezip;
				} ?>

				<?php 
				//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
				if ( get_stylesheet_directory() != get_template_directory() && 
				file_exists(get_stylesheet_directory().'/includes/googlemaps.php') ) 
				{			
					include get_stylesheet_directory() . '/includes/googlemaps.php';
												
				}
				else {
															
					include get_template_directory() . '/includes/googlemaps.php';
												
				}	
				
				 ?>

				<?php if(get_option('wp_show_sv') == 'show' && $streetview == 'Yes') { ?>
					<div id="streetview"></div>
				<?php } ?>

				<div id="map"></div>
			</div><!-- end maps -->	
		<?php } ?>
		
		
		
<?php 

$theagent = $agent; 
$theagent2 = $agent2; ?>
<?php 
//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file

if ( get_stylesheet_directory() != get_template_directory() && 
file_exists(get_stylesheet_directory().'/includes/related.php') ) 
{			
	include get_stylesheet_directory() . '/includes/related.php';
}
else {
	include get_template_directory() . '/includes/related.php';
}	

?>

<?php if (get_option('wp_showcomments_listing') == 'show') { ?>
	<?php if ($post->comment_status == "open") { ?>
	<?php comments_template('', true); ?>
	<?php } ?>
<?php } ?>

<?php if (get_option('wp_site') == "Real Estate") { ?>
	<?php if (get_option('wp_showcontactform') == "show") { ?>

		<div id="contactagent">
	
			<?php
				global $wpdb;
				$sql = " SELECT *
				FROM $wpdb->posts AS p
				WHERE p.post_type = 'agent' 
				AND p.post_title = '". $theagent ."'";
				$agentarray = $wpdb->get_results($sql);
				
				$sql2 = " SELECT *
				FROM $wpdb->posts AS p
				WHERE p.post_type = 'agent' 
				AND p.post_title = '". $theagent2 ."'";
				$agentarray2 = $wpdb->get_results($sql2);
			?>


			<?php if ($agentarray) { ?>
			<?php foreach ($agentarray as $post) { ?>
				<?php setup_postdata($post); ?>
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
				
					<h3>
						<?php echo get_option('wp_agentcontactustext');  ?>
					</h3>
					<div class="agentbox">
						<h4 class="bar"><?php the_title() ?></h4>
						<?php
						$arr_sliderimages = get_gallery_images();
						if ($arr_sliderimages) { ?>
							<?php $resized = aq_resize($arr_sliderimages[0], 80, 100, true); ?>
							<img width="80" height="100" alt="" src="<?php echo $resized ?>" />
						<?php } ?>
						
						<p>
						<?php if ($agenttitle) { ?>
							<strong><?php echo $agenttitle ?></strong><br />
						<?php } ?>
						
						<?php if($agentphoneoffice) { ?>
							<?php echo get_option('wp_agentphone1') . ": " . $agentphoneoffice ?><br />
						<?php } ?>
						
						<?php if($agentphonemobile) { ?>
							<?php echo get_option('wp_agentphone2') . ": " . $agentphonemobile ?><br />
						<?php } ?>
						
						<?php if($agentfax) { ?>
							<?php echo get_option('wp_agentfax') . ": " . $agentfax ?><br />
						<?php } ?>
						
						<a href="<?php the_permalink() ?>"><?php echo get_option('wp_otherlistings') ?></a>
						</p>
						<div style="clear: left;"></div>
						<?php if ($agentarray2) { ?>
							<a class="btn btn-block" data-toggle="collapse" data-target="#agent1"><?php echo get_option('wp_contactformbutton_text') ?></a>
							<div id="agent1" class="collapse"><?php echo do_shortcode($agentcontactform); ?></div>

						<?php } else { ?>
							<?php echo do_shortcode($agentcontactform); ?>
						<?php } ?>
					</div>
			<?php } ?>
			
			<?php } else { ?>

					<h3><?php echo get_option('wp_contactustext') ?></h3>
					
					<?php echo do_shortcode(stripslashes(get_option('wp_contactshortcode')));  ?>
			<?php } ?>
		
		
			<?php if ($agentarray2) { ?>
			<?php foreach ($agentarray2 as $post) { ?>
				<?php setup_postdata($post); ?>
				<?php 
				if ( get_stylesheet_directory() != get_template_directory() && 
				file_exists(get_stylesheet_directory().'/includes/variables.php') ) 
				{			
					include get_stylesheet_directory() . '/includes/variables.php';
																
				}
				else {
																			
					include get_template_directory() . '/includes/variables.php';
																
				}

				?>

					<div class="agentbox">
					<h4 class="bar"><?php the_title() ?></h4>
						<?php
						$arr_sliderimages = get_gallery_images();
						if ($arr_sliderimages) { ?>
							<?php $resized = aq_resize($arr_sliderimages[0], 80, 100, true); ?>
							<img width="80" height="100" alt="" src="<?php echo $resized ?>" />
						<?php } ?>
						
						<p>
						<?php if ($agenttitle) { ?>
							<strong><?php echo $agenttitle ?></strong><br />
						<?php } ?>
						
						<?php if($agentphoneoffice) { ?>
							<?php echo get_option('wp_agentphone1') . ": " . $agentphoneoffice ?><br />
						<?php } ?>
						
						<?php if($agentphonemobile) { ?>
							<?php echo get_option('wp_agentphone2') . ": " . $agentphonemobile ?><br />
						<?php } ?>
						
						<?php if($agentfax) { ?>
							<?php echo get_option('wp_agentfax') . ": " . $agentfax ?><br />
						<?php } ?>
						
						<a href="<?php the_permalink() ?>"><?php echo get_option('wp_otherlistings') ?></a>
						</p>
					<div style="clear: left;"></div>
					<a class="btn btn-block" data-toggle="collapse" data-target="#agent2"><?php echo get_option('wp_contactformbutton_text') ?></a>
					<div id="agent2" class="collapse"><?php echo do_shortcode($agentcontactform); ?></div>
					</div>
			<?php } ?>
			<?php } ?>	
			</div><!-- end contact agent -->
<?php }} ?>




<?php if(get_option('wp_site') == "Car Sales") { ?>
	<?php if (get_option('wp_showcontactform') == "show") { ?>
		<div id="listingcontact">
	<?php } ?>
		<h3 class="bar" id="contact"><?php echo stripslashes(get_option('wp_contactustext')); ?></h3>
		<?php echo do_shortcode(stripslashes(get_option('wp_contactshortcode')));  ?>
		</div><!-- end listing contact -->
	<?php } ?>
	
	<script type="text/javascript">
		$("input[name='your-subject']").val('<?php echo $contactformsubject ?>');
	</script>


	

	<a class='top' href='#top'><i class="icon-chevron-up"></i>
		<?php echo get_option('wp_top');  ?>
	</a>

		
	
</div><!-- end twelve columns -->
<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>

