<?php

if (get_option('wp_demo') == "on") {
	echo "<p class='alert alert-success'><i class='icon-info-sign'></i> <strong>Note: </strong>The info in the tabs below are pulled in from a VIN number code. You will need an account with <a target='_blank'  href='http://www.vinquery.com'>VINquery.com</a> for this feature.</p>	
	<p>All sample lisitngs except one is pulling from a VIN number. To see a listing that is NOT pulling data from a VIN number, <a href='http://www.buchmanndesign.com/automotiv/listing/2005-porsche-911/'>see this listing</a>.</p>";
}

	//$request_url = "http://ws.vinquery.com/restxml.aspx?accessCode=" . $accesscode . "&vin=" . $vin . "&reportType=" . $reporttype;

	$filename = get_vin_filename( $vin );

	if( !file_exists($filename) ) {	// if it's not there, have a go at getting it...
		global $post;
		save_vin_details(	$post->ID );
	}

	$xml = simplexml_load_file( $filename );


foreach($xml->VIN->Vehicle->Item as $item) {
	// Make Specifications array

	if ($item["Key"] == "Body Style" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Engine Type" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Driveline" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Tank" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Fuel Economy-city" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Fuel Economy-highway" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Anti-Brake System" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Steering Type" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Brake Type" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Rear Brake Type" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Turning Diameter" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Suspension" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Rear Suspension" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Spring Type" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Rear Spring Type" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}


	if ($item["Key"] == "Tires" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Headroom" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Rear Headroom" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Legroom" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Rear Legroom" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Shoulder Room" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Rear Shoulder Room" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Hip Room" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Rear Hip Room" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Curb Weight-automatic" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Curb Weight-manual" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Overall Length" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Overall Width" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Overall Height" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Wheelbase" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Ground Clearance" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Track Front" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Track Rear" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Cargo Length" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Width at Wheelwell" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Width at Wall" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Depth" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Standard Seating" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Optional Seating" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Passenger Volume" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Cargo Volume" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Standard Towing" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Maximum Towing" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Standard Payload" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Maximum Payload" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Standard GVWR" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Maximum GVWR" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Basic-duration" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Basic-distance" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Track Front" && $item["Value"] != "No data") {
		$spec[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}




	// Make Convenience array

	if ($item["Key"] == "Power Windows" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Power Door Locks" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Electronic Parking Aid" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "First Aid Kit" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Keyless Entry" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Remote Ignition" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Cruise Control" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Tachometer" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Steering Wheel Mounted Controls" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Trip Computer" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Voice Activated Telephone" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Navigation Aid" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Driver Multi-Adjustable Power Seat" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Passenger Multi-Adjustable Power Seat" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Second Row Multi-Adjustable Power Seat" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Second Row Removable Seat" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Third Row Removable Seat" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Cargo Area Cover" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Cargo Area Tiedowns" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Cargo Net" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Load Bearing Exterior Rack" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Pickup Truck Bed Liner" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Automatic Headlights" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Splash Guards" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Power Sliding Side Van Door" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Power Trunk Lid" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Power Windows" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Electrochromic Exterior Rearview Mirror" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Glass Rear Window on Convertible" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Heated Exterior Mirror" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Electrochromic Interior Rearview Mirror" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Power Adjustable Exterior Mirror" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Deep Tinted Glass" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Interval Wipers" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Sliding Rear Pickup Truck Window" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Towing Preparation Package" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}






	// Make Comfort array

	if ($item["Key"] == "Leather Steering Wheel" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Leather Seat" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Second Row Folding Seat" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Second Row Heated Seat" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Power Sunroof" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Removable Top" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Manual Sunroof" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Wind Deflector for Convertibles" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Air Conditioning" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Separate Driver/Front Passenger Climate Controls" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Tilt Steering" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Tilt Steering Column" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Heated Steering Wheel" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Leather Steering Wheel" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Telescoping Steering Collumn" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Adjustable Foot Pedals" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Genuine Wood Trim" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Telematics System" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Cooled Seat" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Heated Seat" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Power Lumbar Support" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Power Memory Seat" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Split Bench Seat" && $item["Value"] == "Std.") {
		$comf[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}



	// Make Entertainment array

	if ($item["Key"] == "CD Player" && $item["Value"] == "Std.") {
		$ent[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "AM/FM Radio" && $item["Value"] == "Std.") {
		$ent[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Cassette Player" && $item["Value"] == "Std.") {
		$ent[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "DVD Player" && $item["Value"] == "Std.") {
		$ent[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Second Row Sound Controls" && $item["Value"] == "Std.") {
		$ent[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Subwoofer" && $item["Value"] == "Std.") {
		$ent[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}





	// Make Safety array

	if ($item["Key"] == "Passenger Airbag" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Daytime Running Lights" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Fog Lights" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "High Intensity Discharge Headlights" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Pickup Truck Cargo Box Light" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Run Flat Tires" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Rain Sensing Wipers" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Rear Window Defogger" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Rear Wiper" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Child Safety Door Locks" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Locking Pickup Truck Tailgate" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Vehicle Anti-Theft" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "4WD/AWD" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "ABS Brakes" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Automatic Load-Leveling" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Electronic Brake Assistance" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Limited Slip Differential" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Locking Differential" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Traction Control" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Vehicle Stability Control System" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Driver Airbag" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Side Airbag" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Front Side Airbag with Head Protection" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Passenger Airbag" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Side Head Curtain Airbag" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Second Row Side Airbag" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Second Row Side Airbag with Head Protection" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Trunk Anti-Trap Device" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Tire Pressure Monitor" && $item["Value"] == "Std.") {
		$safe[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}

	if ($item["Key"] == "Full Size Spare Tire" && $item["Value"] == "Std.") {
		$conv[] = array("name"=>$item["Key"], "value"=>$item["Value"], "unit"=>$item["Unit"]);
	}
}


?>

<div id="vin">
	<div class='tabbable tabs-left'>
		<ul class='nav nav-tabs'>
				<li class="active">
				<a href="#tab0" data-toggle="tab">
					<?php echo get_option('wp_basicspecs_text'); ?>
				</a>
				</li>
		
		
			<?php if ($spec) { ?>
				<li>
				<a href="#tab1" data-toggle="tab">
					<?php echo get_option('wp_specifications_text'); ?>
				</a></li>
			<?php } ?>

			<?php if ($safe) { ?>
				<li><a href="#tab2" data-toggle="tab">
					<?php echo get_option('wp_safety_text'); ?>
				</a></li>
			<?php } ?>

			<?php if ($conv) { ?>
				<li><a href="#tab3" data-toggle="tab">
					<?php echo get_option('wp_convenience_text'); ?>
				</a></li>
			<?php } ?>

			<?php if ($comf) { ?>
				<li><a href="#tab4" data-toggle="tab">
					<?php echo get_option('wp_comfort_text'); ?>
				</a></li>
			<?php } ?>

			<?php if ($ent) { ?>
				<li><a href="#tab5" data-toggle="tab">
					<?php echo get_option('wp_entertainment_text'); ?>
				</a></li>
			<?php } ?>
		</ul>

	<div class='tab-content'>
	
			<div id="tab0" class="tab-pane active">
					<ul class='specslist'>
						<?php //include get_template_directory() . "/includes/features.php";
						
							//Check first that child theme is used or Parent theme and then that file exist or not in child theme if exist this file in child theme then include that otherwise used parent theme file
							if ( get_stylesheet_directory() != get_template_directory() && 
							file_exists(get_stylesheet_directory().'/includes/features.php') ) 
							{			
								include get_stylesheet_directory() . '/includes/features.php';
							}
							else {
												
								include get_template_directory() . '/includes/features.php';
							}
						
						
						 ?>
					</ul>
			</div>
	
		<?php if ($spec) { ?>
			<div id="tab1" class="tab-pane">
				<?php
					$str = "<ul class='specslist'>";
					foreach ($spec as $item) {
						$str = $str . "<li class='four columns'>" . $item["name"] . ": " . $item["value"] . " " . $item["unit"] . "</li>";
					}
					$str = $str . "</ul>";
					echo $str;
				?>
			</div>
		<?php } ?>

		<?php if ($safe) { ?>
		<div id="tab2" class="tab-pane">
				<?php
					$str = "<ul class='specslist'>";
					foreach ($safe as $item) {
						$str = $str . "<li class='four columns'></i>" . $item["name"] . ": " . $item["value"] . " " . $item["unit"] . "</li>";
					}
					$str = $str . "</ul>";
					echo $str;
				?>
		</div>
		<?php } ?>

		<?php if ($conv) { ?>
		<div id="tab3" class="tab-pane">
				<?php
					$str = "<ul class='specslist'>";
					foreach ($conv as $item) {
						$str = $str . "<li class='four columns'>" . $item["name"] . ": " . $item["value"] . " " . $item["unit"] . "</li>";
					}
					$str = $str . "</ul>";
					echo $str;
				?>
		</div>
		<?php } ?>

		<?php if ($comf) { ?>
		<div id="tab4" class="tab-pane">
				<?php
					$str = "<ul class='specslist'>";
					foreach ($comf as $item) {
						$str = $str . "<li class='four columns'>" . $item["name"] . ": " . $item["value"] . " " . $item["unit"] . "</li>";
					}
					$str = $str . "</ul>";
					echo $str;
				?>
		</div>
		<?php } ?>

		<?php if ($ent) { ?>
		<div id="tab5" class="tab-pane">
				<?php
					$str = "<ul class='specslist'>";
					foreach ($ent as $item) {
						$str = $str . "<li class='four columns'>" . $item["name"] . ": " . $item["value"] . " " . $item["unit"] . "</li>";
					}
					$str = $str . "</ul>";
					echo $str;
				?>
		</div>
		<?php } ?>
	</div>
	</div>
</div>
