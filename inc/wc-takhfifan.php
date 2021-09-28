<?php
function fs_arta_create_takhfifan_tables ()
{
	global $wpdb;

	$table_name = "{$wpdb->prefix}takhfifan_affiliates";

	$is_table_exists = $wpdb->get_var( $wpdb->prepare( "SHOW TABLES LIKE %s", $table_name ) );

	if ( is_null( $is_table_exists ) )
	{
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE {$table_name}(
            id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, 
            order_id bigint(20) UNSIGNED NOT NULL, 
            token varchar(500) NULL,
            new_customer TINYINT NOT NULL,
            status ENUM('complete', 'pending', 'failed') NOT NULL DEFAULT 'pending',
            PRIMARY KEY (id)
            ) {$charset_collate};";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}
}

add_action( 'init', 'fs_arta_create_takhfifan_tables' );

function fs_set_utm_cookie ()
{
	if ( isset( $_GET[ 'utm_source' ] ) && $_GET[ 'utm_source' ] == 'takhfifan' && isset( $_GET[ 'tatoken' ] ) && ! empty( $_GET[ 'tatoken' ] ) )
	{
		$utm_token = htmlspecialchars( $_GET[ 'tatoken' ] );

		// Expired after 30 days
		setcookie( 'arta_takhfifan_token', $utm_token, strtotime( '+30 days' ), '/' );

		if ( ! isset( $_COOKIE[ 'arta_takhfifan_create_date' ] ) )
			setcookie( 'arta_takhfifan_create_date', date( "Y-m-d H:i:s" ), strtotime( '+30 days' ), '/' );

		wp_redirect( home_url() );
		exit();
	}
}

add_action( 'init', 'fs_set_utm_cookie' );

function fs_payment_complete ( $order_id )
{
	if ( isset( $_COOKIE[ 'arta_takhfifan_token' ] ) && isset( $_COOKIE[ 'arta_takhfifan_create_date' ] ) )
	{
		global $wpdb;

		$user_data = get_userdata( get_current_user_id() );

		$new_customer = strtotime( $user_data->user_registered ) < strtotime( $_COOKIE[ 'arta_takhfifan_create_date' ] ) ? 0 : 1;

		$wpdb->insert( $wpdb->prefix . 'takhfifan_affiliates', [
			'order_id'     => $order_id,
			'token'        => sanitize_text_field( $_COOKIE[ 'arta_takhfifan_token' ] ),
			'new_customer' => $new_customer
		] );

		unset( $_COOKIE[ 'arta_takhfifan_token' ] );
		setcookie( 'arta_takhfifan_token', '', time() - ( 15 * 60 ), '/' );

		unset( $_COOKIE[ 'arta_takhfifan_create_date' ] );
		setcookie( 'arta_takhfifan_create_date', '', time() - ( 15 * 60 ), '/' );
	}
}

add_action( 'woocommerce_thankyou', 'fs_payment_complete' );

// Call after an order status manually changes to complete from admin panel
function fs_payment_complete_order_status ( $order_id )
{
	global $wpdb;

	$affiliate = $wpdb->get_row( "SELECT token, new_customer FROM {$wpdb->prefix}takhfifan_affiliates 
										             WHERE order_id ={$order_id}", ARRAY_A );

	if ( isset( $affiliate[ 'token' ] ) )
	{
		$order = wc_get_order( $order_id );

		$coupon_codes = "";
		foreach ( $order->get_coupon_codes() as $coupon_code )
			$coupon_codes .= $coupon_code . ',';

		$body = [
			"token"          => $affiliate[ 'token' ],
			"transaction_id" => strval( $order_id ),
			"revenue"        => intval( $order->get_total() ),
			"shipping"       => intval( $order->get_shipping_total() ),
			"tax"            => intval( $order->get_total_tax() ),
			"discount"       => intval( $order->get_total_discount() ),
			"coupon_code"    => rtrim( $coupon_codes, ',' ),
			"new_customer"   => $affiliate[ 'new_customer' ] ? "true" : "false",
			"affiliation"    => "takhfifan",
			"status"         => "1",
			"items"          => []
		];

		foreach ( $order->get_items() as $item_id => $item )
		{
			$product = $item->get_product();

			$product_id = $item->get_product_id();

			$category = fs_get_the_primary_category( 'product_cat', $product_id );

			$body[ 'items' ][] = [
				"sku"        => $product->get_sku(),
				"category"   => $category[ 'name' ] ?? '',
				"product_id" => strval( $product_id ),
				"price"      => round( $item->get_subtotal() / $item->get_quantity(), 0 ),
				"quantity"   => $item->get_quantity(),
				"name"       => $item->get_name()
			];
		}

		$response = wp_remote_post( 'https://analytics.takhfifan.com/track/purchase', [
			'body'    => wp_json_encode( $body ),
			'headers' => [
				'Content-Type' => 'application/json'
			]
		] );

		//				$retrieve_body = wp_remote_retrieve_body( $response );
		//				$response_data = ( ! is_wp_error( $response ) ) ? json_decode( $retrieve_body, true ) : null;

		$status = 'complete';
		if ( is_wp_error( $response ) )
			$status = 'failed';

		$wpdb->query( "UPDATE {$wpdb->prefix}takhfifan_affiliates SET status='{$status}' WHERE order_id={$order_id}" );
	}
}

add_action( 'woocommerce_order_status_completed', 'fs_payment_complete_order_status', 10, 1 );