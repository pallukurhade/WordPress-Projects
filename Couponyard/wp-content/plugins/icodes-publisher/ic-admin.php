<?php

class APP_iCodes_Settings extends APP_Tabs_Page {

	function setup() {
		global $app_version;

		$parent_page = ( version_compare( $app_version, '1.5', '<' ) ) ? 'admin-options.php' : 'app-dashboard';

		$this->textdomain = APP_IC_TD;

		$this->args = array(
			'page_title' => __( 'iCodes Settings', APP_IC_TD ),
			'menu_title' => __( 'iCodes', APP_IC_TD ),
			'page_slug' => 'app-icodes',
			'parent' => $parent_page,
			'screen_icon' => 'options-general',
			'admin_action_priority' => 11,
		);

		add_action( 'admin_notices', array( $this, 'admin_tools' ), 11 );
	}


	public function admin_tools() {

		if ( isset( $_GET['ic_import_coupons'] ) && $_GET['ic_import_coupons'] == 1 ) {
			do_action( 'appthemes_icodes_cron' );
			$import_error = get_transient( 'appthemes_icodes_import_error' );
			$import_count = get_transient( 'appthemes_icodes_import_count' );
			if ( empty( $import_error ) ) {
				echo scb_admin_notice( sprintf( __( 'iCodes %d coupons have been imported.', APP_IC_TD ), $import_count ) );
			} else {
				echo scb_admin_notice( sprintf( __( 'iCodes coupons import failed. Error: %s', APP_IC_TD ), $import_error ) );
			}
			delete_transient( 'appthemes_icodes_import_error' );
			delete_transient( 'appthemes_icodes_import_count' );
		}

		if ( isset( $_GET['ic_test_api'] ) && $_GET['ic_test_api'] == 1 ) {
			$is_valid_keys = $this->test_api_keys();
			$import_error = get_transient( 'appthemes_icodes_import_error' );
			if ( $is_valid_keys ) {
				echo scb_admin_notice( __( 'Your iCodes API credits are valid.', APP_IC_TD ) );
			} else {
				echo scb_admin_notice( sprintf( __( 'Your iCodes API credits are invalid or you have no coupons available yet. Error: %s', APP_IC_TD ), $import_error ) );
			}
			delete_transient( 'appthemes_icodes_import_error' );
		}

	}


	protected function init_tabs() {
		// Remove unwanted query args from urls
		$_SERVER['REQUEST_URI'] = remove_query_arg( array( 'ic_import_coupons', 'ic_test_api', 'keywords' ), $_SERVER['REQUEST_URI'] );

		$this->tabs->add( 'general', __( 'General', APP_IC_TD ) );
		$this->tabs->add( 'categories', __( 'Categories', APP_IC_TD ) );

		$api_username = $this->options->get( 'api_username' );
		$api_subscription_id = $this->options->get( 'api_subscription_id' );
		if ( ! empty( $api_username ) && ! empty( $api_subscription_id ) ) {
			$this->tabs->add( 'categories_relations', __( 'Categories Relations', APP_IC_TD ) );
			$this->tabs->add( 'stores_relations', __( 'Stores Relations', APP_IC_TD ) );
		}

		$this->tab_sections['general']['api'] = array(
			'title' => __( 'Developer API Access', APP_IC_TD ),
			'fields' => array(
				array(
					'title' => __( 'Username', APP_IC_TD ),
					'desc' => '<br />' . sprintf( __( 'Sign up for a <a target="_new" href="%s">iCodes US</a> or <a target="_new" href="%s">iCodes UK</a> account.', APP_IC_TD ), 'http://www.icodes-us.com/webservices/register.php', 'http://www.icodes.co.uk/webservices/register.php' ),
					'type' => 'text',
					'sanitize' => 'appthemes_clean',
					'name' => 'api_username',
					'tip' => __( 'Enter the "Username" of your iCodes account. It is the same as you use to login on iCodes site.', APP_IC_TD ),
				),
				array(
					'title' => __( 'Subscription ID', APP_IC_TD ),
					'desc' => '<br />' . sprintf( __( 'Sign up for a <a target="_new" href="%s">iCodes US</a> or <a target="_new" href="%s">iCodes UK</a> account.', APP_IC_TD ), 'http://www.icodes-us.com/webservices/register.php', 'http://www.icodes.co.uk/webservices/register.php' ),
					'type' => 'text',
					'sanitize' => 'appthemes_clean',
					'name' => 'api_subscription_id',
					'tip' => __( 'Enter the "Subscription ID" that you have received from iCodes. You can find on the "Home" tab after login to your iCodes account.', APP_IC_TD ),
				),
				array(
					'title' => __( 'Country', APP_IC_TD ),
					'type' => 'select',
					'name' => 'api_country',
					'values' => array(
						'us' => __( 'iCodes US', APP_IC_TD ),
						'uk' => __( 'iCodes UK', APP_IC_TD ),
					),
					'tip' => __( 'Choose country of iCodes service. Please note that for each country you need to register separate account.', APP_IC_TD ),
				),
			),
		);

		$this->tab_sections['general']['settings'] = array(
			'title' => __( 'General Settings', APP_IC_TD ),
			'fields' => array(
				array(
					'title' => __( 'Coupons to import', APP_IC_TD ),
					'type' => 'text',
					'sanitize' => 'absint',
					'name' => 'items_count',
					'tip' => __( 'Specify how many coupons should be imported at one time.', APP_IC_TD ),
				),
				array(
					'title' => __( 'Coupon Types', APP_IC_TD ),
					'type' => 'checkbox',
					'name' => 'items_type',
					'values' => array(
						'Codes' => __( 'Codes', APP_IC_TD ),
						'Offers' => __( 'Offers', APP_IC_TD ),
					),
					'tip' => __( 'Define the types of the coupons that will be imported to your site. You may choose more than one. Leave unchecked to import from all.', APP_IC_TD ),
				),
				array(
					'title' => __( 'Import Store Logo', APP_IC_TD ),
					'name' => 'store_logo',
					'type' => 'checkbox',
					'desc' => __( 'Yes', APP_IC_TD ),
					'tip' => sprintf( __( 'Imports logo of store from affiliate network, or <a href="%s">vcLogos</a> service (if you have associated subscription at iCodes site).', APP_IC_TD ), 'http://www.vclogos.com/' ),
				),
				array(
					'title' => __( 'Immediate Publish', APP_IC_TD ),
					'name' => 'publish',
					'type' => 'checkbox',
					'desc' => __( 'Yes', APP_IC_TD ),
					'tip' => __( 'Publish coupons on site without review. If it\'s unchecked, all imported coupons will be marked as "Pending Review", and will not be available on site until you review and publish them.', APP_IC_TD ),
				),
				array(
					'title' => __( 'Network', APP_IC_TD ),
					'type' => 'checkbox',
					'name' => 'networks',
					'values' => APP_iCodes_Data::networks( $this->options->get( 'api_country' ) ),
					'tip' => __( 'Define the networks of the coupons that will be imported to your site. You may choose more than one. Leave unchecked to import from all.', APP_IC_TD ),
				),
				array(
					'title' => __( 'Create Category', APP_IC_TD ),
					'name' => 'create_category',
					'type' => 'checkbox',
					'desc' => __( 'Yes', APP_IC_TD ),
					'tip' => __( 'Creates a category if one does not exist yet. If it\'s unchecked, all promotional offers that do not have a relation assigned in "Categories Relations" tab, will be omitted.', APP_IC_TD ),
				),
				array(
					'title' => __( 'Create Store', APP_IC_TD ),
					'name' => 'create_store',
					'type' => 'checkbox',
					'desc' => __( 'Yes', APP_IC_TD ),
					'tip' => __( 'Creates a store if one does not exist yet. If it\'s unchecked, all promotional offers that do not have a relation assigned in "Stores Relations" tab, will be omitted.', APP_IC_TD ),
				),
				array(
					'title' => __( 'Schedule Posting', APP_IC_TD ),
					'type' => 'select',
					'name' => 'cron',
					'values' => array(
						'none' => __( 'None', APP_IC_TD ),
						'hourly' => __( 'Hourly', APP_IC_TD ),
						'twicedaily' => __( 'Twice Daily', APP_IC_TD ),
						'daily' => __( 'Daily', APP_IC_TD ),
					),
					'tip' => __( 'Specify how often coupons should be imported. Twice daily is recommended.', APP_IC_TD ),
				),
			),
		);


		$this->tab_sections['general']['actions'] = array(
			'title' => __( 'One Time Actions', APP_IC_TD ),
			'fields' => array(
				array(
					'title' => __( 'Import coupons', APP_IC_TD ),
					'name' => '_blank',
					'type' => '',
					'desc' => sprintf( __( 'Import <a href="%s">Coupons</a> now.', APP_IC_TD ), add_query_arg( 'ic_import_coupons', '1' ) ),
					'extra' => array(
						'style' => 'display: none;'
					),
					'tip' => __( 'Click the link to manually run the function that import coupons. This event will run only one time.', APP_IC_TD ),
				),
				array(
					'title' => __( 'Test API access', APP_IC_TD ),
					'name' => '_blank',
					'type' => '',
					'desc' => sprintf( __( 'Test <a href="%s">API access</a> now.', APP_IC_TD ), add_query_arg( 'ic_test_api', '1' ) ),
					'extra' => array(
						'style' => 'display: none;'
					),
					'tip' => __( 'Click the link to manually run the function that tests API access. This event will run only one time.', APP_IC_TD ),
				),
			),
		);


		$this->tab_sections['categories']['general'] = array(
			'title' => __( 'Categories', APP_IC_TD ),
			'fields' => array(
				array(
					'title' => __( 'Category', APP_IC_TD ),
					'type' => 'checkbox',
					'name' => 'categories',
					'values' => APP_iCodes_Data::categories( $this->options->get( 'api_country' ) ),
					'tip' => __( 'Define the categories of the coupons that will be imported to your site. You may choose more than one. Leave unchecked to import from all.', APP_IC_TD ),
				),
			),
		);


		if ( ! empty( $api_username ) && ! empty( $api_subscription_id ) ) {
			$this->tab_sections['categories_relations']['relations'] = array(
				'title' => __( 'Categories Relations', APP_IC_TD ),
				'fields' => $this->categories_relations(),
			);

			$this->tab_sections['stores_relations']['relations'] = array(
				'title' => __( 'Stores Relations', APP_IC_TD ),
				'fields' => $this->stores_relations(),
			);
		}


	}


	function page_content() {
		if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'stores_relations' ) {
			$keywords = ( isset( $_GET['keywords'] ) ) ? $_GET['keywords'] : '';
			echo '<form method="get" action=""><p class="search-box">';
			echo '<input type="hidden" name="page" value="' . esc_attr( $_GET['page'] ) . '" />';
			echo '<input type="hidden" name="tab" value="' . esc_attr( $_GET['tab'] ) . '" />';
			echo '<input type="text" name="keywords" value="' . esc_attr( $keywords ) . '" />';
			echo '<input id="search-submit" type="submit" class="button" value="' . esc_attr__( 'Search Advertisers', APP_IC_TD ) . '" />';
			echo '</p></form>';
		}

		parent::page_content();
	}


	function page_head() {
?>
<style type="text/css">
.form-table td label { display: block; }
</style>
<?php
		parent::page_head();
	}


	function form_handler() {
		$options = $this->options->get();

		// remove not selected stores
		if ( isset( $_POST['stores_relations'] ) && is_array( $_POST['stores_relations'] ) ) {
			foreach ( $_POST['stores_relations'] as $key => $value ) {
				if ( $value == '-1' )
					unset( $_POST['stores_relations'][ $key ] );
					if ( isset( $options['stores_relations'][ $key ] ) )
						unset( $options['stores_relations'][ $key ] );
			}
		}
		// remove not selected categories
		if ( isset( $_POST['categories_relations'] ) && is_array( $_POST['categories_relations'] ) ) {
			foreach ( $_POST['categories_relations'] as $key => $value ) {
				if ( $value == '-1' ) {
					unset( $_POST['categories_relations'][ $key ] );
					if ( isset( $options['categories_relations'][ $key ] ) )
						unset( $options['categories_relations'][ $key ] );
				}
			}
		}

		$this->options->update( $options );

		parent::form_handler();
	}


	private function categories_options() {
		$options = array();
		$categories = $this->get_icodes_categories();

		foreach ( $categories as $category ) {
			$options[ $category['id'] ] = $category['name'];
		}

		return $options;
	}


	private function categories_relations() {
		$options = array();
		$categories = APP_iCodes_Data::categories( $this->options->get( 'api_country' ) );

		foreach ( $categories as $id => $name ) {
			$options[] = array(
				'title' => $name,
				'type' => 'select',
				'name' => array( 'categories_relations', $id ),
				'values' => $this->available_categories(),
			);
		}

		return $options;
	}


	private function get_icodes_categories() {

		$api_url = add_query_arg( array(
			'RequestType' => 'CategoryList',
		), $this->get_api_url() );

		$categories = get_transient( 'appthemes_icodes_categories_feed' );

		if ( empty( $categories ) ) {
			$response = $this->remote_get( $api_url );

			if ( ! $response )
				return array();

			// suppress all XML errors
			libxml_use_internal_errors( true );

			$cXML = simplexml_load_string( $response['body'], 'SimpleXMLElement', LIBXML_NOCDATA );

			if ( ! $cXML )
				return array();

			for ( $i = 0; $i < count( $cXML->item ); $i++ ) {

				$id = (int) $cXML->item[ $i ]->id;
				$name = (string) $cXML->item[ $i ]->category;
				$name = str_replace( '_', ' ', $name );
				$categories[ $id ] = array(
					'id' => $id,
					'name' => $name,
				);
			}

			// cache results to no bother iCodes API
			set_transient( 'appthemes_icodes_categories_feed', $categories, 60*60*24*1 );
		}

		if ( ! is_array( $categories ) )
			return array();

		// sort categories
		ksort( $categories );

		return $categories;
	}


	private function available_categories() {
		$categories = array( '-1' => __( '&mdash; Select &mdash;', APP_IC_TD ) );
		$terms = get_terms( APP_TAX_CAT, array( 'hide_empty' => 0 ) );

		foreach ( (array) $terms as $term )
			$categories[ $term->term_id ] = $term->name;

		return $categories;
	}


	private function stores_relations() {
		$options = array();
		$stores = $this->get_icodes_stores();

		foreach ( $stores as $id => $data ) {
			$options[] = array(
				'title' => $data['name'],
				'desc' => '',
				'type' => 'select',
				'name' => array( 'stores_relations', $id ),
				'values' => $this->available_stores(),
			);
		}

		return $options;
	}


	private function get_icodes_stores() {

		$idx = ( ! empty( $_GET['keywords'] ) ) ? '_' . appthemes_icodes_create_slug( $_GET['keywords'] ) : '';

		$api_url = add_query_arg( array(
			'RequestType' => 'MerchantList',
			'Action' => 'Search',
			'GroupBy' => 'Merchant',
			'PageSize' => 50,
			'Page' => 1,
		), $this->get_api_url() );

		if ( ! empty( $_GET['keywords'] ) ) {
			$api_url = add_query_arg( array(
				'Query' => $_GET['keywords'],
			), $api_url );
		}

		$stores = get_transient( 'appthemes_icodes_stores_feed' . $idx );

		if ( empty( $stores ) ) {
			$response = $this->remote_get( $api_url );

			if ( ! $response )
				return array();

			// suppress all XML errors
			libxml_use_internal_errors( true );

			$cXML = simplexml_load_string( $response['body'], 'SimpleXMLElement', LIBXML_NOCDATA );

			if ( ! $cXML )
				return array();

			for ( $i = 0; $i < count( $cXML->item ); $i++ ) {

				$id = (int) $cXML->item[ $i ]->icid;
				$stores[ $id ] = array(
					'id' => $id,
					'name' => (string) $cXML->item[ $i ]->merchant,
				);
			}

			// cache results to no bother iCodes API
			set_transient( 'appthemes_icodes_stores_feed' . $idx, $stores, 60*60*24*1 );
		}

		if ( ! is_array( $stores ) )
			return array();

		// sort stores
		ksort( $stores );

		return $stores;
	}


	private function available_stores() {

		$stores = array( '-1' => __( '&mdash; Select &mdash;', APP_IC_TD ) );
		$terms = get_terms( APP_TAX_STORE, array( 'hide_empty' => 0 ) );

		foreach ( (array) $terms as $term )
			$stores[ $term->term_id ] = $term->name;

		return $stores;
	}


	private function networks_options() {
		$options = array();
		$networks = $this->get_icodes_networks();

		foreach ( $networks as $network ) {
			$options[ $network['slug'] ] = $network['name'];
		}

		return $options;
	}


	private function get_icodes_networks() {

		$api_url = add_query_arg( array(
			'RequestType' => 'NetworkList',
		), $this->get_api_url() );

		$networks = get_transient( 'appthemes_icodes_networks_feed' );

		if ( empty( $networks ) ) {
			$response = $this->remote_get( $api_url );

			if ( ! $response )
				return array();

			// suppress all XML errors
			libxml_use_internal_errors( true );

			$cXML = simplexml_load_string( $response['body'], 'SimpleXMLElement', LIBXML_NOCDATA );

			if ( ! $cXML )
				return array();

			for ( $i = 0; $i < count( $cXML->item ); $i++ ) {

				$id = (int) $cXML->item[ $i ]->id;
				$name = (string) $cXML->item[ $i ]->network;
				$name = ucwords( str_replace( '_', ' ', $name ) );
				$networks[ $id ] = array(
					'id' => $id,
					'slug' => (string) $cXML->item[ $i ]->network,
					'name' => $name,
				);
			}

			// cache results to no bother iCodes API
			set_transient( 'appthemes_icodes_networks_feed', $networks, 60*60*24*1 );
		}

		if ( ! is_array( $networks ) )
			return array();

		// sort networks
		ksort( $networks );

		return $networks;
	}


	private function test_api_keys() {

		$api_url = add_query_arg( array(
			'RequestType' => 'NetworkList',
		), $this->get_api_url() );

		$response = $this->remote_get( $api_url );

		if ( ! $response )
			return false;
		else
			return true;
	}


	function get_api_url() {

		$country = $this->options->get( 'api_country' );
		if ( $country == 'us' )
			$api_url = 'http://webservices.icodes-us.com/ws2_us.php';
		else
			$api_url = 'http://webservices.icodes.co.uk/ws2.php';

		return $api_url;
	}


	function remote_get( $api_url ) {

		$api_url = add_query_arg( array(
			'UserName' => $this->options->get( 'api_username' ),
			'SubscriptionID' => $this->options->get( 'api_subscription_id' ),
		), $api_url );

		$response = wp_remote_get( $api_url, array( 'sslverify' => false ) );

		if ( 200 !== wp_remote_retrieve_response_code( $response ) || is_wp_error( $response ) )
			return false;

		if ( preg_match_all( "/<items>.*<Message>(.*)<\/Message>.*<\/items>/s", $response['body'], $error ) ) {
			// When something goes wrong it contains error message
			if ( ! empty( $error[1][0] ) ) {
				set_transient( 'appthemes_icodes_import_error', $error[1][0], 1 );
				return false;
			}
		}

		return $response;
	}


}
