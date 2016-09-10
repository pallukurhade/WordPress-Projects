<div class="accordion" id="accordionBrowseBy">

		  <?php if (get_option('wp_includealllistings') == "Yes") { ?>
		  
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
				
					if (get_option('wp_searchresultspagefix') == "Yes") { 
						$fix = "index.php/";
						} elseif (get_option('wp_searchresultspagefix') == "No") {
						$fix = "";
						} 
						$langcode = "";
						if (function_exists('qtrans_getLanguage')) {
							$langcode = qtrans_getLanguage();
						
							$appendlang = "/&lang=" . $langcode;
							} else {
							$appendlang = "";
							}
					$searchpage = get_post($wp_searchpageid);
					$slugname = $searchpage -> post_name;
					$searchurl = home_url() . "/" . $fix . $slugname . "/?alllistings=true" . $appendlang;
				?>
		  
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle alllistings" data-parent="#accordionBrowseBy" href="<?php echo $searchurl ?>">
					<?php echo get_option('wp_alllistings_text') ?>
			  </a>
			</div>
		  </div>
		  <?php } ?>


		  <?php if (get_option('wp_includefeatures') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse1">
						<?php echo get_option('wp_features_text') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse1" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php 
						$ids = the_top_parents('features');
						 $arr_features = get_terms( 'features', array(
							'orderby' => 'name',
							'hide_empty' => 1,
							'exclude' => $ids
						 ) );
						$count = count($arr_features);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_features as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'features').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>
		  <?php } ?>
		  
		  
<?php if (get_option('wp_site') == "Real Estate") { ?>

			<?php if (get_option('wp_includepropertytype') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse2_houses">
						<?php echo get_option('wp_propertytype_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse2_houses" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php 
						 $arr_propertytype = get_terms( 'property_type', array(
							'orderby'    => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_propertytype);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_propertytype as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'property_type').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>
		  <?php } ?>
		  
		  
			<?php if (get_option('wp_includelocation') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse3_houses">
					<?php echo get_option('wp_location_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse3_houses" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php 
						 $arr_location = get_terms( 'property_location', array(
							'orderby'    => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_location);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_location as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'property_location').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>	
		  <?php } ?>


		  
		  <?php if (get_option('wp_includepricerange') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse4_houses">
						<?php echo get_option('wp_pricerange_text') ?>

			  </a>
			</div>
			<div id="BrowseByCollapse4_houses" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php 
						 $arr_pricerange = get_terms( 'property_pricerange', array(
							'orderby'    => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_pricerange);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_pricerange as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'property_pricerange').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>
		  <?php } ?>

		  <?php if (get_option('wp_includerentorbuy') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse5_houses">
					<?php echo get_option('wp_rentorbuy_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse5_houses" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php 
						 $arr_buyrent = get_terms( 'property_buyorrent', array(
							'orderby'    => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_buyrent);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_buyrent as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'property_buyorrent').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>	
		<?php } ?>
	  
<?php } ?>






<?php if (get_option('wp_site') == "Car Sales") { ?>
			<?php if (get_option('wp_includemanufacturer') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse8_Cars">
					<?php echo get_option('wp_manufacturer_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse8_Cars" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php //wp_tag_cloud('format=list&taxonomy=manufacturer')?>
					<?php 
						 $arr_manufacturer = get_terms( 'manufacturer', array(
							'orderby' => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_manufacturer);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_manufacturer as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'manufacturer').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>
		  <?php } ?>
		  
		  <?php if (get_option('wp_includedealerlocations') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse2_Cars">
					<?php echo get_option('wp_dealerlocation_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse2_Cars" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php //wp_tag_cloud('format=list&taxonomy=dealerlocation') ?>
					<?php 
						 $arr_dealerlocation = get_terms( 'dealerlocation', array(
							'orderby' => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_dealerlocation);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_dealerlocation as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'dealerlocation').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>
		  <?php } ?>
		  
		  <?php if (get_option('wp_includebodytype') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse2_Cars">
					<?php echo get_option('wp_bodytype_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse2_Cars" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php //wp_tag_cloud('format=list&taxonomy=bodytype') ?>
					<?php 
						 $arr_bodytype = get_terms( 'bodytype', array(
							'orderby' => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_bodytype);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_bodytype as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'bodytype').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>
		  <?php } ?>
		  
		  
		  <?php if (get_option('wp_includeenginesize') == "Yes") { ?>
		   <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse3_Cars">
					<?php echo get_option('wp_enginesize_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse3_Cars" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php //wp_tag_cloud('format=list&taxonomy=enginesize') ?>
					<?php 
						 $arr_enginesize = get_terms( 'enginesize', array(
							'orderby' => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_enginesize);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_enginesize as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'enginesize').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div> 
		  <?php } ?>
		  
		  
		  <?php if (get_option('wp_includemileage') == "Yes") { ?>
		   <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse4_Cars">
					<?php echo get_option('wp_mileage_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse4_Cars" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php //wp_tag_cloud('format=list&taxonomy=mileage') ?>
					<?php 
						 $arr_mileage = get_terms( 'mileage', array(
							'orderby' => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_mileage);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_mileage as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'mileage').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>
		  <?php } ?>
		  
		  <?php if (get_option('wp_includemodelyear') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse5_Cars">
						<?php echo get_option('wp_modelyear_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse5_Cars" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php //wp_tag_cloud('format=list&taxonomy=modelyear') ?>
					<?php 
						 $arr_modelyear = get_terms( 'modelyear', array(
							'orderby' => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_modelyear);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_modelyear as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'modelyear').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>  
		  <?php } ?>
		  
		  
		  <?php if (get_option('wp_includepricerange') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse6_Cars">
					<?php echo get_option('wp_pricerange_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse6_Cars" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php //wp_tag_cloud('format=list&taxonomy=pricerange') ?>
					<?php 
						 $arr_pricerange = get_terms( 'pricerange', array(
							'orderby' => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_pricerange);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_pricerange as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'pricerange').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>  
		  <?php } ?>
		  
		  <?php if (get_option('wp_includetransmission') == "Yes") { ?>
		  <div class="accordion-group">
			<div class="accordion-heading">
			  <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBrowseBy" href="#BrowseByCollapse7_Cars">
						<?php echo get_option('wp_transmission_text2') ?>
			  </a>
			</div>
			<div id="BrowseByCollapse7_Cars" class="accordion-body collapse">
			  <div class="accordion-inner">
					<?php 
						 $arr_transmission = get_terms( 'transmission', array(
							'orderby' => 'name',
							'hide_empty' => 1
						 ) );
						$count = count($arr_transmission);
						 if ( $count > 0 ){
							 echo "<ul class='browsebyterms'>";
							 foreach ( $arr_transmission as $term ) {
							   echo '<li><a href="'.get_term_link($term->slug, 'transmission').'">'.$term->name.'</a></li>';
							 }
							 echo "</ul>";
						 }
					?>
			  </div>
			</div>
		  </div>  
		  <?php } ?>
		
<?php } ?>

</div>


	