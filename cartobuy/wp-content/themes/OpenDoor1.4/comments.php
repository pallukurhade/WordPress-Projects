<?php

if(!empty($_SERVER['SCRIPT_FILENAME']) && basename($_SERVER['SCRIPT_FILENAME']) == 'comments.php')

	die();


if(post_password_required())

{
	?>

	<p class="nocomments"><?php echo get_option('wp_login_before_posting_text')	?></p>

	<?php

	return;

}





if(get_post_status(get_the_ID()) != 'publish')

{

	?>

	<p class="nocomments"><?php echo get_option('wp_commentsareactiveonlyforpublicposts_text') ?></p>

	<?php

	return;

}


if(have_comments())

{

	?>

               <?php if ( ! empty($comments_by_type['comment']) ) { ?>
					<h3 id="comments"><?php comments_number(get_option('wp_no_comments_text'), get_option('wp_one_comment_text'), '% ' . get_option('wp_comments_text') );?></h3>
					<ul class="commentlist">
							<?php wp_list_comments('avatar_size=75&type=comment'); ?>
					</ul>
                <?php } ?>
	<?php
	if(get_comment_pages_count() > 1 && get_option('page_comments'))

	{
		?>

		<div class="comment-navigation">

			<span class="nav-previous"><?php previous_comments_link(__("&laquo; Previous", "automotiv")); ?></span>

			<span class="nav-next"><?php next_comments_link(__("Previous &raquo;", "automotiv")); ?></span>

		</div> <!-- .navigation -->

		<?php

	}

} else

{

	// this is displayed if there are no comments so far

	

	if(!comments_open())

	{

		?>

		<p class="nocomments"><?php echo get_option('wp_comments_closed_text') ?></p>

		<?php

	} else

	{

		?>

		<p class="nocomments"><?php echo get_option('wp_no_comments_text')?></p>

		<?php

	}

}

// Display the comment form
comment_form();
?>
