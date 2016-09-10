<script type="text/javascript">
	var address_index = 0, map, infowindow, geocoder, bounds, mapinfo, intTimer;

	window.onload = function() {
		// Creating an object literal containing the properties you want to pass to the map
		var options = {
			zoom:			12,
			center:		new google.maps.LatLng(0, 0),
			mapTypeId:	google.maps.MapTypeId.ROADMAP
		};
	
		// Creating the map
		map = new google.maps.Map(document.getElementById('map'), options);
		infowindow = new google.maps.InfoWindow();
		geocoder = new google.maps.Geocoder();
		bounds = new google.maps.LatLngBounds();		

		//******* ARRAY BROUGHT OVER FROM SEARCHRESULTS.PHP **********
		mapinfo = <?php echo json_encode($array_mapinfo); ?>;
		
		intTimer = setInterval("call_geocode();", 300);
	}
	
	
	
	function call_geocode() {
    if( address_index >= mapinfo.length ) {
			clearInterval(intTimer);
			return;
		}
	
		  geocoder.geocode( { address: mapinfo[address_index][0] }, (function(index) {
					return function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							// Scale our bounds
							bounds.extend(results[0].geometry.location);
							var $address 	= mapinfo[index][0];
							var $street 	= mapinfo[index][1];
							var $title 	= mapinfo[index][2];
							var $img_src 	= mapinfo[index][3];
							var $price 	= mapinfo[index][4];
							var $link 	= mapinfo[index][5];
							var $pricecustom 	= mapinfo[index][6];
							
							<?php  ?>
						
							<?php if (get_option('wp_mapmarkerimage')) { ?>
								var theicon = new google.maps.MarkerImage('<?php echo get_option('wp_mapmarkerimage') ?>');
								<?php } else { ?>
								var theicon = new google.maps.MarkerImage('<?php echo get_template_directory_uri()  ?>/images/maphouse.png');
							<?php } ?>
							
						   
							var marker = new google.maps.Marker({
							position:                results[0].geometry.location,
							icon: theicon,
							map:                          map,
							scrollwheel:           false,
							streetViewControl:true,
							title:                     $title
					   });
							
					
							
							
							
							google.maps.event.addListener( marker, 'click', function() {
								// Setting the content of the InfoWindow
								var content = '<div id="info">' + '<img src="' + $img_src  + '"/>' + '<h3>' + $title + '</h3>' + '<p>' + $street + '</p>' + '<p class="price">' + $price + '</p>' + '<p><a href="' + $link + '"><?php echo get_option('wp_readmore_text');?></a></p>' + '</div>';
								infowindow.setContent(content );
								infowindow.open(map, marker);
							});
							
							map.fitBounds(bounds);
							if (mapinfo.length == 1) {
								map.setZoom(12);
							}
						} else {
							// error!! alert (status);
						}
				}})(address_index));
		
    address_index++;		
	}


</script>