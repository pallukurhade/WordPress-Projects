<?php
// this small class will produce some proper internal links for using within the program
// for example in mailing list subscribers page it produces proper URL to sort by name, email etc
// depending on the current selection

class BFTProLinkHelper {
	static function subscribers($orderby, $reverse = true) {
		$current_order=empty($_GET['ob'])?"name":$_GET['ob'];
		
		// otherwise we use default direction for the property
		switch($orderby) {
			case 'status':
				// default status is active, i.e. DESC
			case 'date':
				// default order is DESC
				$default_dir="DESC";
			break;
			
			default:
				// for other default order is ASC
				$default_dir="ASC";			
			break;
		}
		
		// when $current_order is the same as $orderby we just flip the direction
		$dir = empty($_GET['dir']) ? "ASC" : $_GET['dir'];
		if($reverse) {
			if($current_order==$orderby) {
				$reverse_dir=empty($_GET['dir'])?$default_dir:$_GET['dir'];
				$dir=($reverse_dir=='ASC')?'DESC':'ASC';
			}
			else $dir=$default_dir;
		}	
		
		$link = "&ob=$orderby&dir=$dir";
		
		$link.= self::subscribers_filters();
		
		return $link;
	}
	
	static function subscribers_filters() {
		$link="";
		
		if(isset($_GET['filter_status'])) $link.="&filter_status=".$_GET['filter_status'];
		if(isset($_GET['filter_email'])) $link.="&filter_email=".$_GET['filter_email'];
		if(isset($_GET['filter_name'])) $link.="&filter_name=".$_GET['filter_name'];
		if(isset($_GET['filter_ip'])) $link.="&filter_ip=".$_GET['filter_ip'];
		if(isset($_GET['readmails_from'])) $link.="&readmails_from=".$_GET['readmails_from'];
		if(isset($_GET['readmails_to'])) $link.="&readmails_to=".$_GET['readmails_to'];
		
		return $link;
	}
}