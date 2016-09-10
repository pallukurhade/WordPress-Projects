<?php
 get_header(); 
?>

<div class="sixteen columns outercontainer bigheading">
	<div class="four columns alpha">
		&nbsp;
	</div>
	<div class="twelve columns omega">
		<h2><?php echo get_option('wp_notfound_heading_text') ?></h2>
	</div>
</div>	


<div class="sixteen columns outercontainer" id="content">
	<div class="four columns alpha" id="leftsidebar">
		<?php get_sidebar() ?>
	</div>
	
	<div class="twelve columns omega">	
			<h3 class="bar">Categories</h3>
		<ul>
		<?php wp_list_categories('title_li=') ?>
		</ul>

		<h3 class="bar">Pages</h3>
		<ul>
		<?php wp_list_pages('title_li=') ?>
		</ul>

		<h4>Archives by Year</h4>
		<ul><?php wp_get_archives('type=yearly'); ?></ul> 

		<h4>Archives By Month</h4>
		<ul><?php wp_get_archives('type=monthly'); ?></ul>

		<h4>Archives By Tag</h4>
		<?php wp_tag_cloud(); ?> 
</div>
</div>

<?php get_footer(); ?>