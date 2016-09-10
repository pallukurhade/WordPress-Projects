<?php

class APP_iCodes_Data {

	/**
	 * Returns an array of categories
	 *
	 * @Source http://www.icodes-us.com/webservices/my_cats.php
	 * @Source http://www.icodes.co.uk/webservices/my_cats.php
	 *
	 * @return array
	 */
	public static function categories( $country = 'us' ) {

		$categories['us'] = array(
			'28' => __( 'Adult And Dating', APP_IC_TD ),
			'2' => __( 'Apparel', APP_IC_TD ),
			'48' => __( 'Arts and Crafts', APP_IC_TD ),
			'53' => __( 'Auctions', APP_IC_TD ),
			'17' => __( 'Automotive', APP_IC_TD ),
			'5' => __( 'Baby and Toddler', APP_IC_TD ),
			'7' => __( 'Books and Magazines', APP_IC_TD ),
			'1' => __( 'Cell Phones', APP_IC_TD ),
			'54' => __( 'Charities', APP_IC_TD ),
			'9' => __( 'Computers and Software', APP_IC_TD ),
			'58' => __( 'Daily Deals', APP_IC_TD ),
			'11' => __( 'Department Stores', APP_IC_TD ),
			'36' => __( 'Education and Careers', APP_IC_TD ),
			'29' => __( 'Electronics and Gadgets', APP_IC_TD ),
			'39' => __( 'Event Tickets', APP_IC_TD ),
			'57' => __( 'Fashion', APP_IC_TD ),
			'22' => __( 'Finance', APP_IC_TD ),
			'42' => __( 'Food and Drink', APP_IC_TD ),
			'37' => __( 'Footwear', APP_IC_TD ),
			'24' => __( 'Gambling and Bingo', APP_IC_TD ),
			'14' => __( 'Gifts and Flowers', APP_IC_TD ),
			'19' => __( 'Health and Beauty', APP_IC_TD ),
			'55' => __( 'Hobbies and Collectibles', APP_IC_TD ),
			'18' => __( 'Home and Furniture', APP_IC_TD ),
			'26' => __( 'Home Entertainment', APP_IC_TD ),
			'23' => __( 'Insurance', APP_IC_TD ),
			'4' => __( 'Jewelry and Accessories', APP_IC_TD ),
			'6' => __( 'Kitchen and Appliances', APP_IC_TD ),
			'30' => __( 'Lingerie and Underwear', APP_IC_TD ),
			'44' => __( 'Luggage and Bags', APP_IC_TD ),
			'8' => __( 'Movies and Music', APP_IC_TD ),
			'34' => __( 'Musical Instruments', APP_IC_TD ),
			'10' => __( 'Office Supplies', APP_IC_TD ),
			'47' => __( 'Online Services', APP_IC_TD ),
			'31' => __( 'Party Supplies', APP_IC_TD ),
			'12' => __( 'Pet Supplies', APP_IC_TD ),
			'25' => __( 'Photography and Photos', APP_IC_TD ),
			'50' => __( 'Special Occasions', APP_IC_TD ),
			'15' => __( 'Sports and Recreation', APP_IC_TD ),
			'46' => __( 'Tools and Hardware', APP_IC_TD ),
			'35' => __( 'Toys and Games', APP_IC_TD ),
			'20' => __( 'Travel and Vacations', APP_IC_TD ),
			'21' => __( 'Video Gaming', APP_IC_TD ),
			'3' => __( 'Yard and Garden', APP_IC_TD ),
		);

		$categories['uk'] = array(
			'41' => __( 'Adult And Dating', APP_IC_TD ),
			'3' => __( 'Baby and Toddler', APP_IC_TD ),
			'4' => __( 'Books and Magazines', APP_IC_TD ),
			'5' => __( 'Business', APP_IC_TD ),
			'6' => __( 'CDs and DVDs', APP_IC_TD ),
			'42' => __( 'Charities', APP_IC_TD ),
			'7' => __( 'Clothing and Footwear', APP_IC_TD ),
			'38' => __( 'Competitions', APP_IC_TD ),
			'8' => __( 'Computers and Internet', APP_IC_TD ),
			'46' => __( 'Daily Deals', APP_IC_TD ),
			'9' => __( 'DIY and Tools', APP_IC_TD ),
			'45' => __( 'Education', APP_IC_TD ),
			'10' => __( 'Electronics and Appliances', APP_IC_TD ),
			'11' => __( 'Experience Days', APP_IC_TD ),
			'12' => __( 'Finance and Insurance', APP_IC_TD ),
			'14' => __( 'Flowers', APP_IC_TD ),
			'15' => __( 'Food and Drink', APP_IC_TD ),
			'16' => __( 'Gambling', APP_IC_TD ),
			'17' => __( 'Games and Consoles', APP_IC_TD ),
			'18' => __( 'Gifts and Gadgets', APP_IC_TD ),
			'19' => __( 'Health and Beauty', APP_IC_TD ),
			'20' => __( 'Hobbies and Collectibles', APP_IC_TD ),
			'39' => __( 'Holidays Abroad', APP_IC_TD ),
			'21' => __( 'Home and Garden', APP_IC_TD ),
			'22' => __( 'Hotels and Accommodation', APP_IC_TD ),
			'23' => __( 'Jewelry and Accessories', APP_IC_TD ),
			'40' => __( 'Lingerie and Underwear', APP_IC_TD ),
			'24' => __( 'Mobile Phones', APP_IC_TD ),
			'25' => __( 'Motoring', APP_IC_TD ),
			'43' => __( 'Music', APP_IC_TD ),
			'26' => __( 'Pets', APP_IC_TD ),
			'44' => __( 'Photo Printing', APP_IC_TD ),
			'28' => __( 'Services', APP_IC_TD ),
			'29' => __( 'Shopping', APP_IC_TD ),
			'30' => __( 'Sound and Vision', APP_IC_TD ),
			'31' => __( 'Special Occasions', APP_IC_TD ),
			'32' => __( 'Sports and Leisure', APP_IC_TD ),
			'33' => __( 'Tickets', APP_IC_TD ),
			'34' => __( 'Toys and Games', APP_IC_TD ),
			'35' => __( 'Travel', APP_IC_TD ),
			'36' => __( 'UK Holidays', APP_IC_TD ),
		);

		return ( $country == 'us' ) ? $categories['us'] : $categories['uk'];
	}


	/**
	 * Returns an array of networks
	 *
	 * @Source http://www.icodes-us.com/webservices/my_networks.php
	 * @Source http://www.icodes.co.uk/webservices/my_networks.php
	 *
	 * @return array
	 */
	public static function networks( $country = 'us' ) {

		$networks['us'] = array(
			'affiliate_future' => __( 'AffiliateFuture', APP_IC_TD ),
			'affiliate_window' => __( 'Affiliate Window', APP_IC_TD ),
			'amazon' => __( 'Amazon', APP_IC_TD ),
			'avantlink' => __( 'AvantLink', APP_IC_TD ),
			'buy' => __( 'Buy', APP_IC_TD ),
			'commission_junction' => __( 'Commission Junction', APP_IC_TD ),
			'ebay' => __( 'eBay', APP_IC_TD ),
			'google' => __( 'Google', APP_IC_TD ),
			'linkconnector' => __( 'LinkConnector', APP_IC_TD ),
			'linkshare' => __( 'LinkShare', APP_IC_TD ),
			'linkshare_canada' => __( 'LinkShare Canada', APP_IC_TD ),
			'pepperjam' => __( 'Pepperjam', APP_IC_TD ),
			'shareasale' => __( 'ShareASale', APP_IC_TD ),
			'webgains' => __( 'Webgains', APP_IC_TD ),
		);

		$networks['uk'] = array(
			'affiliate_future' => __( 'AffiliateFuture', APP_IC_TD ),
			'affiliate_window' => __( 'Affiliate Window', APP_IC_TD ),
			'affilinet' => __( 'Affilinet', APP_IC_TD ),
			'aflite' => __( 'Aflite', APP_IC_TD ),
			'buy' => __( 'Buy', APP_IC_TD ),
			'commission_junction' => __( 'Commission Junction', APP_IC_TD ),
			'dgm' => __( 'DGM', APP_IC_TD ),
			'ebay' => __( 'eBay', APP_IC_TD ),
			'google' => __( 'Google', APP_IC_TD ),
			'impact_radius' => __( 'Impact Radius', APP_IC_TD ),
			'independent' => __( 'Independent', APP_IC_TD ),
			'linkshare' => __( 'LinkShare', APP_IC_TD ),
			'mobiles4everyone' => __( 'Mobiles4everyone', APP_IC_TD ),
			'monetise' => __( 'Monetise', APP_IC_TD ),
			'more_niche' => __( 'MoreNiche', APP_IC_TD ),
			'paid_on_results' => __( 'Paid On Results', APP_IC_TD ),
			'profitistic' => __( 'Profitistic', APP_IC_TD ),
			'silvertap' => __( 'Silvertap', APP_IC_TD ),
			'silvertap2' => __( 'Silvertap 2', APP_IC_TD ),
			'tradetracker' => __( 'TradeTracker', APP_IC_TD ),
			'trade_doubler' => __( 'Tradedoubler', APP_IC_TD ),
			'trade_doubler_ireland' => __( 'Tradedoubler Ireland', APP_IC_TD ),
			'trienta_affiliates' => __( 'Trienta Affiliates', APP_IC_TD ),
			'webgains' => __( 'Webgains', APP_IC_TD ),
		);

		return ( $country == 'us' ) ? $networks['us'] : $networks['uk'];
	}


}
