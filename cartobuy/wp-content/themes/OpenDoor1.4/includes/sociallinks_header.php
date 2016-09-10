<div id="socialheader">


<?php if (get_option('wp_socialnetwork1') == "Facebook" || get_option('wp_socialnetwork2') == "Facebook" || get_option('wp_socialnetwork3') == "Facebook" || get_option('wp_socialnetwork4') == "Facebook" || get_option('wp_socialnetwork5') == "Facebook" || get_option('wp_socialnetwork6') == "Facebook" || get_option('wp_socialnetwork7') == "Facebook") {  ?>

					<a target="_blank" class="facebook" href="<?php echo get_option('wp_facebookpage') ?>" title="<?php echo get_option('wp_facebooktooltip1') ?>">
						<img src="<?php echo get_template_directory_uri() ?>/images/socialicons/Facebook.png" alt="" />
					</a>
<?php } ?>



<?php if (get_option('wp_socialnetwork1') == "Twitter" || get_option('wp_socialnetwork2') == "Twitter" || get_option('wp_socialnetwork3') == "Twitter" || get_option('wp_socialnetwork4') == "Twitter" || get_option('wp_socialnetwork5') == "Twitter" || get_option('wp_socialnetwork6') == "Twitter" || get_option('wp_socialnetwork7') == "Twitter") {  ?>
					<a target="_blank" class="twitter" href="http://twitter.com/<?php echo get_option('wp_twitterusername'); ?>" title="<?php echo get_option('wp_twittertooltip1') ?>">
						<img src="<?php echo get_template_directory_uri() ?>/images/socialicons/Twitter.png" alt="" />
					</a>
<?php } ?>
		

<?php if (get_option('wp_socialnetwork1') == "Google+" || get_option('wp_socialnetwork2') == "Google+" || get_option('wp_socialnetwork3') == "Google+" || get_option('wp_socialnetwork4') == "Google+" || get_option('wp_socialnetwork5') == "Google+" || get_option('wp_socialnetwork6') == "Google+" || get_option('wp_socialnetwork7') == "Google+") {  ?>
					<a target="_blank" class="googleplus" href="<?php echo get_option('wp_googlepluspage') ?>" title="<?php echo get_option('wp_googleplustooltip') ?>">
						<img src="<?php echo get_template_directory_uri() ?>/images/socialicons/Google.png" alt="" />
					</a>
<?php } ?>





<?php if (get_option('wp_socialnetwork1') == "Linked In" || get_option('wp_socialnetwork2') == "Linked In" || get_option('wp_socialnetwork3') == "Linked In" || get_option('wp_socialnetwork4') == "Linked In" || get_option('wp_socialnetwork5') == "Linked In" || get_option('wp_socialnetwork6') == "Linked In" || get_option('wp_socialnetwork7') == "Linked In") {  ?>		
				<a target="_blank" class="linkedin" href="<?php echo get_option('wp_linkedin') ?>" title="<?php echo get_option('wp_linkedintooltip') ?>">
					<img src="<?php echo get_template_directory_uri() ?>/images/socialicons/Linked-In.png" alt="" />
				</a>
<?php } ?>



<?php if (get_option('wp_socialnetwork1') == "YouTube" || get_option('wp_socialnetwork2') == "YouTube" || get_option('wp_socialnetwork3') == "YouTube" || get_option('wp_socialnetwork4') == "YouTube" || get_option('wp_socialnetwork5') == "YouTube" || get_option('wp_socialnetwork6') == "YouTube" || get_option('wp_socialnetwork7') == "YouTube") {  ?>		
				<a target="_blank" class="youtube" href="<?php echo get_option('wp_youtubepage') ?>" title="<?php echo get_option('wp_youtubetooltip') ?>">
					<img src="<?php echo get_template_directory_uri() ?>/images/socialicons/YouTube.png" alt="" />
				</a>
<?php } ?>


<?php if (get_option('wp_socialnetwork1') == "Flickr" || get_option('wp_socialnetwork2') == "Flickr" || get_option('wp_socialnetwork3') == "Flickr" || get_option('wp_socialnetwork4') == "Flickr" || get_option('wp_socialnetwork5') == "Flickr" || get_option('wp_socialnetwork6') == "Flickr" || get_option('wp_socialnetwork7') == "Flickr") {  ?>
					<a target="_blank" class="flickr" href="<?php echo get_option('wp_flickrpage') ?>" title="<?php echo get_option('wp_flickrtooltip') ?>">
						<img src="<?php echo get_template_directory_uri() ?>/images/socialicons/Flickr.png" alt="" />
					</a>
<?php } ?>



<?php if (get_option('wp_socialnetwork1') == "Pinterest" || get_option('wp_socialnetwork2') == "Pinterest" || get_option('wp_socialnetwork3') == "Pinterest" || get_option('wp_socialnetwork4') == "Pinterest" || get_option('wp_socialnetwork5') == "Pinterest" || get_option('wp_socialnetwork6') == "Pinterest" || get_option('wp_socialnetwork7') == "Pinterest") {  ?>
					<a target="_blank" class="pinterest" href="http://pinterest.com/<?php echo get_option('wp_pinterest') ?>" title="<?php echo get_option('wp_pinteresttooltip') ?>">
						<img src="<?php echo get_template_directory_uri() ?>/images/socialicons/Pinterest.png" alt="" />
					</a>
<?php } ?>			

			
			<a class="rss" title="<?php echo get_option('wp_rsstooltip') ?>" href="<?php bloginfo('rss2_url'); ?>?post_type=listing">
				<img src="<?php echo get_template_directory_uri() ?>/images/socialicons/RSS.png" alt="" />
			</a>		

			
</div>
<div class="clearleft"></div>