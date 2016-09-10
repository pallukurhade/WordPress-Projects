<?php

class APP_iCodes_Import {

	// scbOptions object holder
	protected $options;

	protected $pages;
	protected $type;

	function __construct( $options = null ) {
		if ( ! is_a( $options, 'scbOptions' ) )
			$options = new scbOptions( 'ic_options', false );

		$this->options = $options;

		$api_username = $this->options->get( 'api_username' );
		$api_subscription_id = $this->options->get( 'api_subscription_id' );
		if ( empty( $api_username ) || empty( $api_subscription_id ) )
			return;

		add_action( 'init', array( $this, 'schedule_import' ) );
		add_action( 'appthemes_icodes_cron', array( $this, 'import' ) );
	}


	function schedule_import() {

		$recurrance = $this->options->get( 'cron' );
		if ( empty( $recurrance ) || $recurrance == 'none' ) {
			if ( wp_next_scheduled( 'appthemes_icodes_cron' ) )
				wp_clear_scheduled_hook( 'appthemes_icodes_cron' );
			return;
		}

		// set schedule if does not exist
		if ( ! wp_next_scheduled( 'appthemes_icodes_cron' ) ) {
			wp_schedule_event( time(), $recurrance, 'appthemes_icodes_cron' );
			return;
		}

		// re-schedule if settings changed
		$schedule = wp_get_schedule( 'appthemes_icodes_cron' );
		if ( $schedule && $schedule != $recurrance ) {
			wp_clear_scheduled_hook( 'appthemes_icodes_cron' );
			wp_schedule_event( time(), $recurrance, 'appthemes_icodes_cron' );
		}

	}


	function import() {

		$i = 0;

		// set starting point for API results pagination
		$this->pages['current'] = 1;
		$this->pages['max'] = 1;

		$this->set_feed_type();

		do {
			$coupons = $this->get_new_coupons();
			if ( ! $coupons )
				continue;

			$coupons = $this->filter_coupons( $coupons );
			if ( ! $coupons )
				continue;

			foreach ( $coupons as $coupon ) {
				if ( $i >= $this->options->get( 'items_count' ) )
					break 2;

				if ( $this->add_new_coupon( $coupon ) )
					$i++;
			}
		} while ( $this->pages['max'] >= $this->pages['current'] );

		// store quantity of imported coupons
		set_transient( 'appthemes_icodes_import_count', $i, 1 );
	}


	function add_new_coupon( $coupon ) {
		global $app_version;

		$store_id = $this->get_store_term_id( $coupon['advertiser_id'] );
		if ( ! $store_id )
			return false;

		$category_id = $this->get_category_term_id( $coupon['category_id'] );
		if ( ! $category_id )
			return false;

		$coupon_status = ( $this->options->get( 'publish' ) ) ? 'publish' : 'pending';

		// add coupon
		$data = array(
			'post_title' => $coupon['title'],
			'post_content' => $coupon['description'],
			'post_status' => $coupon_status,
			'post_type' => APP_POST_TYPE
		);
		$post_id = wp_insert_post( $data );

		if ( $post_id == 0 || is_wp_error( $post_id ) )
			return false;

		// set base coupon stats
		add_post_meta( $post_id, 'clpr_daily_count', '0', true );
		add_post_meta( $post_id, 'clpr_total_count', '0', true );
		add_post_meta( $post_id, 'clpr_coupon_aff_clicks', '0', true );
		add_post_meta( $post_id, 'clpr_votes_up', '0', true );
		add_post_meta( $post_id, 'clpr_votes_down', '0', true );
		add_post_meta( $post_id, 'clpr_votes_percent', '100', true );

		// add meta data to the new coupon
		$expire_date_format = ( version_compare( $app_version, '1.5', '<' ) ) ? 'm-d-Y' : 'Y-m-d';
		$expire_date = ( empty( $coupon['end_date'] ) ) ? strtotime( '+1 year' ) : strtotime( $coupon['end_date'] );
		$expire_date = date( $expire_date_format, $expire_date );
		add_post_meta( $post_id, 'clpr_coupon_code', $coupon['coupon_code'], true );
		add_post_meta( $post_id, 'clpr_coupon_aff_url', $coupon['destination_url'], true );
		add_post_meta( $post_id, 'clpr_expire_date', $expire_date, true );
		add_post_meta( $post_id, 'clpr_featured', '', true );
		add_post_meta( $post_id, 'clpr_sys_userIP', appthemes_get_ip(), true );

		// add unique ID, and iCodes ID
		$clpr_item_id = uniqid( rand( 10, 1000 ), false );
		add_post_meta( $post_id, 'clpr_id', $clpr_item_id, true );
		add_post_meta( $post_id, 'ic_link_id', $coupon['id'], true );

		// assign taxonomies
		wp_set_object_terms( $post_id, array( (int) $category_id ), APP_TAX_CAT );
		wp_set_object_terms( $post_id, array( (int) $store_id ), APP_TAX_STORE );

		if ( $this->type == 'Codes' ) {
			$promo_type = get_term_by( 'slug', 'coupon-code', APP_TAX_TYPE );
		} else {
			$promo_type = get_term_by( 'slug', 'promotion', APP_TAX_TYPE );
		}
		wp_set_object_terms( $post_id, array( (int) $promo_type->term_id ), APP_TAX_TYPE, false );

		return $post_id;
	}


	function add_new_store( $advertiser_id ) {

		$advertiser = $this->get_advertiser( $advertiser_id );
		if ( ! $advertiser )
			return false;

		$term = appthemes_maybe_insert_term( $advertiser['name'], APP_TAX_STORE );
		if ( $term && ! is_wp_error( $term ) ) {
			$term_id = $term['term_id'];
			// update relation
			$options = $this->options->get();
			$options['stores_relations'][ $advertiser_id ] = $term_id;
			$this->options->update( $options );

			// update store meta data
			update_metadata( APP_TAX_STORE, $term_id, 'ic_advertiser_id', $advertiser['id'] );
			update_metadata( APP_TAX_STORE, $term_id, 'clpr_store_active', 'yes' );
			update_metadata( APP_TAX_STORE, $term_id, 'clpr_store_url', $advertiser['url'] );
			update_metadata( APP_TAX_STORE, $term_id, 'clpr_store_aff_url', $advertiser['aff_url'] );

			if ( $this->options->get( 'store_logo' ) )
				$this->add_store_logo( $term_id, $advertiser['logo_url'] );

			return $term_id;
		}

		return false;
	}


	function add_store_logo( $store_id, $logo_url ) {

		$logo_url = trim( $logo_url );

		if ( empty( $logo_url ) )
			return false;

		$upload = $this->fetch_remote_file( $logo_url );
		if ( is_wp_error( $upload ) )
			return false;

		if ( $info = wp_check_filetype( $upload['file'] ) ) {
			$post['post_mime_type'] = $info['type'];
		} else {
			return new WP_Error( 'attachment_processing_error', __( 'Invalid file type', APP_IC_TD ) );
		}

		$post['guid'] = $upload['url'];
		$post['post_title'] = basename( $logo_url );
		$post['post_content'] = '';

		$attachment_id = wp_insert_attachment( $post, $upload['file'] );
		wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $upload['file'] ) );

		update_metadata( APP_TAX_STORE, $store_id, 'clpr_store_image_id', $attachment_id );

	}


	function add_new_category( $category_id ) {

		$categories = APP_iCodes_Data::categories( $this->options->get( 'api_country' ) );
		if ( ! array_key_exists( $category_id, $categories ) )
			return false;

		$term = appthemes_maybe_insert_term( $categories[ $category_id ], APP_TAX_CAT );
		if ( $term && ! is_wp_error( $term ) ) {
			$term_id = $term['term_id'];
			// update relation
			$options = $this->options->get();
			$options['categories_relations'][ $category_id ] = $term_id;
			$this->options->update( $options );

			return $term_id;
		}

		return false;
	}


	/**
	 * Returns an array of coupons
	 *
	 * @Source http://www.icodes-us.com/webservices/webservices.php
	 *
	 * @return array|bool Boolean False on failure
	 */
	function get_new_coupons() {
		$coupons = array();

		$response = $this->remote_get( $this->get_coupons_api_url() );

		// increase current page
		$this->pages['current']++;

		if ( ! $response )
			return false;

		// suppress all XML errors
		libxml_use_internal_errors( true );

		$cXML = simplexml_load_string( $response['body'], 'SimpleXMLElement', LIBXML_NOCDATA );

		if ( ! $cXML )
			return false;

		for ( $i = 0; $i < count( $cXML->item ); $i++ ) {

			$id = (int) $cXML->item[ $i ]->icid;

			$coupons[ $id ] = array(
				'id' => $id,
				'title' => (string) $cXML->item[ $i ]->title,
				'description' => (string) $cXML->item[ $i ]->description,
				'destination_url' => (string) $cXML->item[ $i ]->affiliate_url,
				'promotion_type' => (string) $cXML->RequestType,
				'start_date' => (string) $cXML->item[ $i ]->start_date,
				'end_date' => (string) $cXML->item[ $i ]->expiry_date,
				'coupon_code' => (string) $cXML->item[ $i ]->voucher_code,
				'advertiser_id' => (int) $cXML->item[ $i ]->mid,
				'advertiser_name' => (string) $cXML->item[ $i ]->merchant,
				'advertiser_url' => (string) $cXML->item[ $i ]->merchant_url,
				'category_id' => (int) $cXML->item[ $i ]->category_id,
				'network' => (string) $cXML->item[ $i ]->network,
			);

		}

		// set max pages
		$this->pages['max'] = (int) $cXML->TotalPages;

		return $coupons;
	}


	function filter_coupons( $coupons ) {
		global $wpdb;

		$stores_relations = $this->options->get( 'stores_relations' );
		$categories_relations = $this->options->get( 'categories_relations' );

		foreach ( $coupons as $id => $data ) {
			// remove duplicate coupon
			$sql = $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = 'ic_link_id' AND meta_value = %s", $id );
			if ( $wpdb->get_var( $sql ) ) {
				unset( $coupons[ $id ] );
				continue;
			}

			// remove coupon if store have no relation
			if ( ! $this->options->get( 'create_store' ) ) {
				if ( ! array_key_exists( $data['advertiser_id'], $stores_relations ) ) {
					unset( $coupons[ $id ] );
					continue;
				}
			}

			// remove coupon if category have no relation
			if ( ! $this->options->get( 'create_category' ) ) {
				if ( ! array_key_exists( $data['category_id'], $categories_relations ) ) {
					unset( $coupons[ $id ] );
					continue;
				}
			}

			// remove coupon if its expired
			if ( ! empty( $data['end_date'] ) ) {
				$expire_date = strtotime( $data['end_date'] );
				if ( current_time( 'timestamp' ) > $expire_date ) {
					unset( $coupons[ $id ] );
					continue;
				}
			}

		}

		return $coupons;
	}


	function get_store_term_id( $advertiser_id ) {
	
		$stores_relations = $this->options->get( 'stores_relations' );

		if ( array_key_exists( $advertiser_id, $stores_relations ) )
			return $stores_relations[ $advertiser_id ];

		if ( $this->options->get( 'create_store' ) )
			return $this->add_new_store( $advertiser_id );

		return false;
	}


	function get_category_term_id( $category_id ) {

		$categories_relations = $this->options->get( 'categories_relations' );

		if ( array_key_exists( $category_id, $categories_relations ) )
			return $categories_relations[ $category_id ];

		if ( $this->options->get( 'create_category' ) )
			return $this->add_new_category( $category_id );

		return false;
	}


	function get_advertiser( $advertiser_id ) {

		$api_url = add_query_arg( array(
			'RequestType' => 'MerchantList',
			'Action' => 'Icid',
			'Query' => $advertiser_id,
		), $this->get_api_url() );

		$response = get_transient( 'appthemes_icodes_store_id_' . $advertiser_id );

		if ( empty( $response ) )
			$response = $this->remote_get( $api_url );

		if ( ! $response )
			return false;

		// cache results to no bother iCodes API
		set_transient( 'appthemes_icodes_store_id_' . $advertiser_id, $response, 60*60*24*1 );

		// suppress all XML errors
		libxml_use_internal_errors( true );

		$cXML = simplexml_load_string( $response['body'], 'SimpleXMLElement', LIBXML_NOCDATA );

		if ( ! $cXML )
			return false;

		for ( $i = 0; $i < count( $cXML->item ); $i++ ) {
			$mid = (int) $cXML->item[ $i ]->icid;
			return array(
				'id' => $mid,
				'name' => (string) $cXML->item[ $i ]->merchant,
				'url' => (string) $cXML->item[ $i ]->merchant_url,
				'aff_url' => (string) $cXML->item[ $i ]->affiliate_url,
				'logo_url' => (string) $cXML->item[ $i ]->merchant_logo_url,
			);
		}

		return false;
	}


	/**
	 * Sets randomly type of coupons to feed
	 *
	 * @return void
	 */
	function set_feed_type() {

		$type = $this->options->get( 'items_type' );

		if ( empty( $type ) || ! is_array( $type ) )
			$type = array( 'Codes', 'Offers' );

		shuffle( $type );

		$this->type = $type[0];

	}


	/**
	 * Returns an coupons API URL
	 *
	 * @Source http://www.icodes-us.com/webservices/webservices.php
	 * @Source http://www.icodes.co.uk/webservices/webservices.php
	 *
	 * @return string
	 */
	function get_coupons_api_url() {

		$api_url = add_query_arg( array(
			'RequestType' => $this->type,
			'Action' => 'All',
			'Relationship' => 'joined',
			'Sort' => 'id',
			'PageSize' => 50,
			'Page' => $this->pages['current'],
		), $this->get_api_url() );

		$networks = $this->options->get( 'networks' );
		if ( ! empty( $networks ) ) {
			$api_url = add_query_arg( array(
				'Network' => implode( ',', $networks ),
			), $api_url );
		}

		$categories = $this->options->get( 'categories' );
		if ( ! empty( $categories ) ) {
			$api_url = add_query_arg( array(
				'Action' => 'Category',
				'Query' => implode( ',', $categories ),
			), $api_url );
		}

		return apply_filters( 'appthemes_icodes_get_api_url', $api_url );
	}


	/**
	 * Returns an API URL depend of iCodes country selection
	 *
	 * @return string
	 */
	function get_api_url() {

		$country = $this->options->get( 'api_country' );
		if ( $country == 'us' ) {
			$api_url = 'http://webservices.icodes-us.com/ws2_us.php';
		} else {
			$api_url = 'http://webservices.icodes.co.uk/ws2.php';
		}

		return $api_url;
	}


	/**
	 * Retrieve the raw response from the HTTP request using the GET method
	 *
	 * @param string $api_url
	 *
	 * @return bool|array
	 */
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


	/**
	 * Attempt to download a remote file attachment
	 *
	 * @param string $url URL of item to fetch
	 *
	 * @return array|WP_Error Local file location details on success, WP_Error otherwise
	 */
	function fetch_remote_file( $url ) {
		// extract the file name and extension from the url
		$file_name = basename( $url );

		// get placeholder file in the upload dir with a unique, sanitized filename
		$upload = wp_upload_bits( $file_name, 0, '' );
		if ( $upload['error'] )
			return new WP_Error( 'upload_dir_error', $upload['error'] );

		// fetch the remote url and write it to the placeholder file
		$headers = wp_get_http( $url, $upload['file'] );

		// request failed
		if ( ! $headers ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', __( 'Remote server did not respond', APP_IC_TD ) );
		}

		// make sure the fetch was successful
		if ( $headers['response'] != '200' ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', sprintf( __( 'Remote server returned error response %1$d %2$s', APP_IC_TD ), esc_html( $headers['response'] ), get_status_header_desc( $headers['response'] ) ) );
		}

		$filesize = filesize( $upload['file'] );

		if ( isset( $headers['content-length'] ) && $filesize != $headers['content-length'] ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', __( 'Remote file is incorrect size', APP_IC_TD ) );
		}

		if ( 0 == $filesize ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', __( 'Zero size file downloaded', APP_IC_TD ) );
		}

		$max_size = (int) apply_filters( 'import_attachment_size_limit', 0 );
		if ( ! empty( $max_size ) && $filesize > $max_size ) {
			@unlink( $upload['file'] );
			return new WP_Error( 'import_file_error', sprintf( __( 'Remote file is too large, limit is %s', APP_IC_TD ), size_format( $max_size ) ) );
		}

		return $upload;
	}


}
