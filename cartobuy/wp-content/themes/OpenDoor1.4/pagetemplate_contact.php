<?php
/*
Template Name: Contact
*/
?>


<?php
 get_header(); 
?>

<div class="sixteen columns outercontainer bigheading">
	<div class="four columns alpha">
		&nbsp;
	</div>
	<div class="twelve columns omega">
		<h2 id="title"><?php the_title(); ?></h2>
	</div>
</div>	


<div class="sixteen columns outercontainer" id="content">
	<div class="four columns alpha" id="leftsidebar">
		<?php get_sidebar() ?>
	</div>
	
	<div class="twelve columns omega">	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
			 <div>
			 	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
				<script>
				/* <![CDATA[ */
				function setMapAddress(address)
				{
					var geocoder = new google.maps.Geocoder();

					geocoder.geocode( { address : address }, function( results, status ) {
						if( status == google.maps.GeocoderStatus.OK ) {
							var latlng = results[0].geometry.location;
							var options = {
								zoom: 15,
								center: latlng,
								mapTypeId: google.maps.MapTypeId.ROADMAP
							};

							var mymap = new google.maps.Map( document.getElementById( 'map' ), options );
							
							var marker = new google.maps.Marker({
							map: mymap, 
							position: results[0].geometry.location
						});
							
						}
					} );
				}

				setMapAddress( "<?php echo get_option('wp_contactmap') ?>" );

				/* ]]> */
				</script>
				<div id="contactmap">
						<div id="map"></div>
				</div>
			 
				<div class="contactpagecontent">
					<?php the_content(); ?>
				</div>
				
				<div class="eight columns alpha">
						<?php echo do_shortcode(stripslashes(get_option('wp_contactuspageshortcode')));  ?>
				</div>
				
				<div class="four columns omega">
						<h3 class="bar"><?php echo get_option('wp_contactinfo_text') ?></h3>
						<?php echo stripslashes(get_option('wp_contacttext')); ?>
				</div>

		</div>			
		<?php endwhile; else: ?>
		
<?php endif; ?>
</div>






</div>
<?php get_footer(); ?>