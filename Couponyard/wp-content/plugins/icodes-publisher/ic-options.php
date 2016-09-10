<?php

$GLOBALS['ic_options'] = new scbOptions( 'ic_options', false, array(
	// API
	'api_username' => '',
	'api_subscription_id' => '',
	'api_country' => 'us',

	// Settings
	'items_count' => 10,
	'items_type' => 'Codes',
	'store_logo' => 0,
	'publish' => 1,
	'cron' => 'twicedaily',

	'create_category' => 0,
	'create_store' => 0,

	'networks' => array(),
	'categories' => array(),

	// Relations
	'categories_relations' => array(),
	'stores_relations' => array(),

) );

