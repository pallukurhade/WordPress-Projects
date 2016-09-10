<?php
/*
Template Name: Archives
*/
?>

<?php get_header(); ?>

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
		
		
		<div <?php post_class() ?>    id="post-<?php echo the_ID(); ?>">

			<?php if(get_option('wp_archivesbyyear') == 'show') { ?>
				<h3 class="bar"><?php echo get_option('wp_archivesbyyear_text') ?></h3> 
				<ul><?php wp_get_archives('type=yearly'); ?></ul> 
			<?php } ?>

			<?php if(get_option('wp_archivesbymonth') == 'show') { ?>
				<h3 class="bar"><?php echo get_option('wp_archivesbymonth_text') ?></h3> 
				<ul><?php wp_get_archives('type=monthly'); ?></ul> 
			<?php } ?>


			<?php if(get_option('wp_archivesbycategory') == 'show') { ?>
				<h3 class="bar"><?php echo get_option('wp_archivesbycategory_text') ?></h3> 
				<ul><?php wp_list_categories('title_li='); ?></ul> 
			<?php } ?>


			<?php if(get_option('wp_archivesallpages') == 'show') { ?>
				<h3 class="bar"><?php echo get_option('wp_archivesbypages_text') ?></h3> 
				<ul><?php wp_list_pages('title_li='); ?></ul>
			<?php } ?>

			<?php if(get_option('wp_archivesbytag') == "show") { ?>
				<h3 class="bar"><?php echo get_option('wp_archivesbytags_text') ?></h3>  
				<?php wp_tag_cloud(); ?> 
			<?php } ?>
				
				
		<?php endwhile; else: ?>
	
<?php endif; ?>
</div>
</div>

<?php get_footer(); ?>