<?php 
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */
get_header(); ?>
<?php global $invert_shortname; ?>
<div class="main-wrapper-item">

	<div class="bread-title-holder">
		 <div class="bread-title-bg-image full-bg-breadimage-fixed"></div>
		 <div class="container">
			 <div class="row-fluid">
				 <div class="container_inner clearfix">
					<h1 class="title">
						<?php
							if ( is_day() ) :
								printf( __( 'Daily Archives: <span>%s</span>', 'invert' ), get_the_date() );
								elseif ( is_month() ) :
								printf( __( 'Monthly Archives: <span>%s</span>', 'invert' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'invert' ) ) );
								elseif ( is_year() ) :
								printf( __( 'Yearly Archives: <span>%s</span>', 'invert' ), get_the_date( _x( 'Y', 'yearly archives date format', 'invert' ) ) );
								else :
								_e( 'Blog Archives', 'invert' );
							endif;
						?>
					</h1>
					<?php  if(sketch_get_option($invert_shortname."_hide_bread") == 'true') {
						if ((class_exists('invert_breadcrumb_class'))) {$invert_breadcumb->custom_breadcrumb();}
					}
					?>
				 </div>
			 </div>
		 </div>
	</div>
	 
	<div class="container post-wrap"> 
		<div class="row-fluid">
			<div id="container" class="span8">
				<div id="content">
					<?php if(have_posts()) : ?>
					<?php $post = $posts[0]; ?>
					<?php /* The loop */ ?>
					<?php while(have_posts()) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
					<?php endwhile; ?>
					<div class="navigation">	
						<?php  if (function_exists("invert_paginate") && sketch_get_option($invert_shortname.'_show_pagination')) { invert_paginate(); } else {?>			
						<div class="alignleft"><?php previous_posts_link(__('&larr;Previous','invert'),0) ?></div>		
						<div class="alignright"><?php next_posts_link(__('Next&rarr;','invert'),0) ?></div>    		
						<?php } ?>					
					</div> 
					<?php else :  ?>
					<?php get_template_part( 'content', 'none' ); ?>
					<?php endif; ?>
				</div>
				<!-- content --> 
			</div>
			<!-- container --> 
			
			<!-- Sidebar -->
			<div id="sidebar" class="span3">
				<?php get_sidebar(); ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
			<!-- Sidebar --> 
		</div>
	</div>
	 
</div>
<?php get_footer(); ?>