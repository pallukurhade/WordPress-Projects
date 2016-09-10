<p class="postmeta">

<?php the_time('F j, Y') ?>
&nbsp; 

<?php if (!is_home()) { ?>
| &nbsp;
<?php comments_number( get_option('wp_no_comments_text'), get_option('wp_one_comment_text'), "% " . get_option('wp_comments_text') ); ?>
<?php } ?>

</p>


