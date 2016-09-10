<!-- internal javascript, so it can mix javascript with PHP -->
<script type="text/javascript">
/* <![CDATA[ */  
$(document).ready(function() {


<?php if (get_option('wp_expandbrowseby') == 'Expand') { ?>
	$('#collapseOneHouses').addClass('in');
	$('#collapseOneIdx').addClass('in');
	$('#collapseOneBoth').addClass('in');
	$('#collapseOneCars').addClass('in');
<?php } ?>

<?php if (get_option('wp_expandsearch_realestate') == 'Expand') { ?>
	$('#collapseTwoHouses').addClass('in');
	$('#collapseThreeBoth').addClass('in');
<?php } ?>

<?php if (get_option('wp_expandsearch_idx') == 'Expand') { ?>
	$('#collapseTwoIdx').addClass('in');
	$('#collapseTwoBoth').addClass('in');
<?php } ?>

<?php if (get_option('wp_expandsearch_cars') == 'Expand') { ?>
	$('#collapseTwoCars').addClass('in');
<?php } ?>







$('.dsidx-search-button input[type=submit]').val('<?php echo get_option('wp_searchbutton_text') ?>');

 
 <?php if (is_home() && get_option('wp_demo') == "on") { ?>
$('#demo').hide();
$('#picker').farbtastic('#color');
<?php } ?> 


$('#colorschemechanger .btn').click(function() {
	var colorscheme = $('#color').val();
	$.cookie("color", colorscheme);
	<?php if (get_option('wp_site') == "Real Estate") { ?>
		window.location.href="http://www.informatik.com/themeforest/opendoor_realestate/index.php";
	<?php } else { ?>
		window.location.href="http://www.informatik.com/themeforest/opendoor_carsales/index.php";
	<?php } ?>
});

$('#resetcolorscheme').click(function() {
	$.cookie("color", null);
	<?php if (get_option('wp_site') == "Real Estate") { ?>
		window.location.href="http://www.informatik.com/themeforest/opendoor_realestate/index.php";
	<?php } else { ?>
		window.location.href="http://www.informatik.com/themeforest/opendoor_carsales/index.php";
	<?php } ?>
});
});

/* ]]> */
</script>