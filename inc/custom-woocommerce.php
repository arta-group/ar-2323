<?php
// Woocommerce disable default CSS
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Woocommerce remove sale Badge
add_filter( 'woocommerce_sale_flash', '__return_null' );

function fs_remove_password_strength() {
	wp_dequeue_script( 'wc-password-strength-meter' );
}

add_action( 'wp_print_scripts', 'fs_remove_password_strength', 10 );

function fs_arta_my_account_menu() {
	return array(
		'dashboard'       => array(
			'label'    => 'پیشخوان',
			'endpoint' => 'my-account',
			'class'    => 'text-1/6 leading-1/6 h-1/6',
			'icon'     => 'icon-four-square'
		),
		'woo-wallet'      => array(
			'label'    => 'کیف پول',
			'endpoint' => 'woo-wallet',
			'class'    => 'text-1/6 leading-1/6 h-1/6',
			'icon'     => 'icon-wallet'
		),
		'orders'          => array(
			'label'          => 'سوابق سفارش ها',
			'endpoint'       => 'orders',
			'class'          => 'text-1/6 leading-1/6 h-1/6',
			'icon'           => 'icon-bill',
			'dashboard_menu' => true
		),
		'edit-address'    => array(
			'label'          => 'آدرس ها',
			'endpoint'       => 'edit-address',
			'class'          => 'text-2/1 leading-2/1 h-2/1',
			'icon'           => 'icon-map-pin',
			'dashboard_menu' => true
		),
		'edit-account'    => array(
			'label'          => 'ویرایش اطلاعات کاربری',
			'endpoint'       => 'edit-account',
			'class'          => 'text-1/6 leading-1/6 h-1/6',
			'icon'           => 'icon-identification',
			'dashboard_menu' => true
		),
		'wishlist'        => array(
			'label'          => 'لیست خرید',
			'endpoint'       => 'wishlist',
			'class'          => 'text-1/8 leading-1/8 h-1/8',
			'icon'           => 'icon-simple-heart',
			'dashboard_menu' => true
		),
		'customer-logout' => array(
			'label'    => 'خروج از حساب',
			'endpoint' => 'customer-logout',
			'icon'     => 'icon-lock',
			'class'    => 'text-2 leading-2 h-2'
		)
	);
}

function fs_add_custom_endpoints() {
	add_rewrite_endpoint( 'wishlist', EP_ROOT | EP_PAGES );
}

add_action( 'init', 'fs_add_custom_endpoints' );

function fs_render_wishlist_endpoint() {
	include_once get_template_directory() . '/woocommerce/myaccount/wishlist.php';
}

add_action( 'woocommerce_account_wishlist_endpoint', 'fs_render_wishlist_endpoint' );

function fs_wishlist_endpoint_title( $title, $id ) {
	global $wp_query;

	if ( isset( $wp_query->query_vars['wishlist'] ) && ! is_admin() && is_main_query() && in_the_loop() && is_account_page() ) {
		$title = 'لیست خرید';
	}

	return $title;
}

add_filter( 'the_title', 'fs_wishlist_endpoint_title', 10, 2 );

function fs_cart_url() {
	if ( isset( $_REQUEST['clear-cart'] ) ) {
		WC()->cart->empty_cart();
	}
}

add_action( 'init', 'fs_cart_url' );

function fs_remove_currency_symbol( $currency_symbol, $currency ) {
	return '';
}

add_filter( 'woocommerce_currency_symbol', 'fs_remove_currency_symbol', 10, 2 );

/**
 * Validation Register form
 */
function fs_validate_registration_fields( $errors, $username, $password, $email ) {
	$username = isset( $_POST['username'] ) ? $_POST['username'] : '';
	$password = isset( $_POST['password'] ) ? $_POST['password'] : '';

	if ( isset( $username ) && empty( trim( $username ) ) ) {
		$errors->add( 'registration-error-mobile-empty', 'لطفا فیلد شماره موبایل را تکمیل کنید.' );

		return $errors;
	} elseif ( ! preg_match( "/^09[0-9]{9}$/", $username ) ) {
		$errors->add( 'registration-error-mobile-invalid', 'لطفا یک شماره موبایل معتبر وارد کنید.' );

		return $errors;
	}

	if ( isset( $password ) && empty( trim( $password ) ) ) {
		$errors->add( 'registration-error-password-empty', 'لطفا فیلد کلمه عبور را تکمیل کنید.' );

		return $errors;
	} //	elseif ( ! preg_match( '/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $password ) || strlen( $password ) < 8 )
    elseif ( strlen( $password ) < 8 ) {
		$errors->add( 'registration-error-password-check', 'کلمه عبور باید حداقل ۸ کاراکتر باشد.' );

		return $errors;
	}

	if ( username_exists( $username ) ) {
		$errors->add( 'registration-error-mobile-exists', 'این شماره موبایل قبلا ثبت شده است.' );

		return $errors;
	}

	return $errors;
}

add_filter( 'woocommerce_process_registration_errors', 'fs_validate_registration_fields', 10, 4 );

/**
 * Save mobile field
 */
function fs_save_user_mobile_meta( $customer_id ) {
	if ( isset( $_POST['username'] ) && ! empty( trim( $_POST['username'] ) ) ) {
		update_user_meta( $customer_id, 'mobile', sanitize_text_field( $_POST['username'] ) );
		$sms        = 1;
		$sms_value  = [];
		$user_login = sanitize_text_field( $_POST['username'] );
		sa_sms( sanitize_text_field( $user_login ), $sms, $sms_value );
	}
}

add_action( 'woocommerce_created_customer', 'fs_save_user_mobile_meta' );

function fs_change_welcome_sms_params( $params, $user_id ) {
	$params = 1;

	return $params;
}

add_filter( 'fs-welcome-sms-params', 'fs_change_welcome_sms_params', 10, 2 );

/**
 * Validation login form
 */
function fs_process_login_errors( $errors, $post_username, $post_password ) {
	if ( empty( trim( $post_username ) ) ) {
		$errors->add( 'login-error-mobile-empty', 'لطفا فیلد شماره موبایل را وارد کنید.' );

		return $errors;
	}

	if ( empty( trim( $post_password ) ) ) {
		$errors->add( 'registration-error-password-empty', 'لطفا فیلد کلمه عبور را وارد کنید.' );

		return $errors;
	}

	return $errors;
}

add_filter( 'woocommerce_process_login_errors', 'fs_process_login_errors', 10, 3 );

/**
 * Custom auth based on mobile custom field
 */
if ( isset( $_POST['login'] ) && isset( $_POST['username'] ) && isset( $_POST['password'] ) ) {
	remove_filter( 'authenticate', 'wp_authenticate_username_password', 20 );

	add_filter( 'authenticate', function ( $user, $email, $password ) {

		$user_mobile = $_POST['username'];
		$password    = $_POST['password'];

		$user = get_users( array(
			'meta_key'    => 'mobile',
			'meta_value'  => $user_mobile,
			'compare'     => '=',
			'number'      => 1,
			'count_total' => false
		) );

		$user = reset( $user );

		if ( ! $user ) {
			$error = new WP_Error();
			$error->add( 'login-user-invalid', 'شماره موبایل یا رمز عبور نامعتبر است.' );

			return $error;
		} else {
			if ( ! wp_check_password( $password, $user->user_pass, $user->ID ) ) {
				$error = new WP_Error();
				$error->add( 'login-user-invalid', 'شماره موبایل یا رمز عبور نامعتبر است.' );

				return $error;
			} else {
				return $user;
			}
		}
	}, 20, 3 );
}

function fs_save_account_details_errors( $args ) {
	$password_1 = isset( $_POST['password_1'] ) ? $_POST['password_1'] : '';

	if ( ! empty( $password_1 ) && strlen( $password_1 ) < 8 ) {
		$args->add( 'registration-error-password-check', 'گذرواژه جدید و تکرار آن باید حداقل ۸ کاراکتر باشد.' );
	}

	if ( isset( $_POST['account_melli_code'] ) && ! empty( $_POST['account_melli_code'] ) ) {
		if ( ! fs_validate_melli_code( $_POST['account_melli_code'] ) ) {
			$args->add( 'registration-error-melli-code', 'کد ملی نامعتبر است.' );
		}
	}
}

add_action( 'woocommerce_save_account_details_errors', 'fs_save_account_details_errors', 10, 1 );

// Variation html price in single product page
function fs_change_variation_html_price( $data, $product, $variation ) {
	$price         = $variation->get_price();
	$regular_price = $variation->get_regular_price();
	$in_stock      = $variation->is_in_stock();
	$discount      = 0;

	ob_start();

	if ( $price ) {
		if ( $in_stock ) {
			if ( $variation->is_on_sale() ) {
				?>
                <div class="discounted_price text-gray-300 text-1/6 lg-text-2 font-bold leading-3/9 ml-3 line-through">
                    <span class="font-bold"><?php echo wc_price( $regular_price ); ?></span>
                    <span class="text-2">تومان</span></div>
				<?php
				$discount = abs( round( ( $price / $regular_price - 1 ) * 100 ) );
			}
			?>
            <div class="final_price text-2/4 lg-text-3 font-bold text-primary-main leading-4/7 lg-ml-3">
                <span class="font-black tracking-tighter"><?php echo wc_price( $price ); ?></span>
                <span class="text-2/4">تومان</span>
            </div>
			<?php

			if ( $discount ) {
				?>
                <div class="text-primary-main absolute bottom-4 left-0 lg-static">
                    <div class="relative icon-product-off leading-2/7 text-2/7">
                        <div class="text-center text-white leading-2/7 text-xl absolute top-0 right-0 z-10 w-full font-black discount-percent"
                             dir="ltr"><?php echo sprintf( '-٪%d', $discount ); ?></div>
                    </div>
                </div>
				<?php
			}
		} else {
			?>
            <div class="final_price text-3 font-bold text-primary-main leading-4/7 ml-3">
                <a href="<?php echo esc_url( site_url( 'contact' ) ) ?>">تماس بگیرید</a>
            </div>
			<?php
		}
	} else {
		$status = sprintf( '<a href="%s">%s</a>', site_url( 'contact' ), 'تماس بگیرید' );
		if ( ! $in_stock ) {
			$status = 'ناموجود';
		}
		?>
        <div class="final_price text-3 font-bold text-primary-main leading-4/7 ml-3">
            <span class="text-2/4"><?php echo $status; ?></span>
        </div>
		<?php
	}

	$data['price_html'] = ob_get_contents();
	ob_end_clean();

	return $data;
}

add_filter( 'woocommerce_available_variation', 'fs_change_variation_html_price', 10, 3 );

function fs_add_to_cart_message_html( $message, $product ) {
	$product = isset( $product ) ? array_keys( $product ) : '';

	if ( isset( $product[0] ) ) {
		$titles[] = get_the_title( $product[0] );

		$titles     = array_filter( $titles );
		$added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );

		$message = sprintf( '%s <a href="%s" class="button">%s</a>', esc_html( $added_text ), esc_url( wc_get_page_permalink( 'cart' ) ), 'مشاهده سبد خرید' );
	}

	return $message;
}

add_filter( 'wc_add_to_cart_message_html', 'fs_add_to_cart_message_html', 10, 2 );

// Use in single product page gallery thumbnail image
function fs_customize_single_product_image( $details ) {
	$details['class'] = 'object-cover object-center w-full h-full';

	return $details;
}

add_filter( 'woocommerce_gallery_image_html_attachment_image_params', 'fs_customize_single_product_image' );

function fs_get_product_prices( $product ) {
	$result = [
		'price'         => 0,
		'regular_price' => 0,
		'discount'      => 0
	];

	if ( $product->is_type( 'simple' ) ) {
		$result['price']         = $product->get_price();
		$result['regular_price'] = $product->get_regular_price();

		$discount_sale_price    = $product->get_sale_price();
		$discount_regular_price = $result['regular_price'];

		if ( $product->is_on_sale() && $discount_sale_price && $discount_regular_price ) {
			$result['discount'] = abs( round( ( $discount_sale_price / $discount_regular_price - 1 ) * 100 ) );
		}
	} elseif ( $product->is_type( 'variable' ) ) {
		$min_max = 'min';

		if ( isset( $_GET['orderby'] ) && $_GET['orderby'] == 'price-desc' ) {
			$min_max = 'max';
		}

		$variations = $product->get_available_variations();

		if ( $variations ) {
			$price         = $variations[0]['display_price'];
			$regular_price = $variations[0]['display_regular_price'];

			foreach ( $variations as $variation ) {
				if ( $min_max == 'max' ) {
					if ( $variation['display_price'] >= $price ) {
						$price         = $variation['display_price'];
						$regular_price = $variation['display_regular_price'];
					}
				} else {
					if ( $variation['display_price'] <= $price ) {
						$price         = $variation['display_price'];
						$regular_price = $variation['display_regular_price'];
					}
				}
			}

			if ( $price - $regular_price == 0 ) {
				$result['price'] = $price;
			} else {
				$result['price']         = $price;
				$result['regular_price'] = $regular_price;

				if ( $regular_price > $price ) {
					$result['discount'] = abs( round( ( $price / $regular_price - 1 ) * 100 ) );
				}
			}
		}
	}

	return $result;
}

function fs_set_user_recently_viewed_products() {
	if ( ! is_singular( 'product' ) ) {
		return;
	}

	global $post;

	if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) ) {
		$viewed_products = [];
	} else {
		$viewed_products = wp_parse_id_list( (array) explode( '|', wp_unslash( $_COOKIE['woocommerce_recently_viewed'] ) ) );
	}

	$keys = is_array( $viewed_products ) ? array_flip( $viewed_products ) : array_flip( [ $viewed_products ] );

	if ( isset( $keys[ $post->ID ] ) ) {
		unset( $viewed_products[ $keys[ $post->ID ] ] );
	}

	$viewed_products[] = $post->ID;

	if ( count( $viewed_products ) > 12 ) {
		array_shift( $viewed_products );
	}

	wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}

remove_action( 'template_redirect', 'wc_track_product_view', 20 );
add_action( 'template_redirect', 'fs_set_user_recently_viewed_products', 20 );

function fs_add_extra_fields_to_shipping_method( $settings ) {
	$settings['description'] = array(
		'title'       => 'توضیحات',
		'type'        => 'text',
		'placeholder' => 'راهنمایی در خصوص این روش ارسال',
		'description' => '',
	);

	$settings['extra_description'] = array(
		'title'       => 'مقدار ستون حمل و نقل',
		'type'        => 'text',
		'description' => 'این تنظیم در ستون محاسبه حمل و نقل در صفحه پرداخت نشان داده می شود'
	);

	return $settings;
}

add_filter( 'woocommerce_shipping_instance_form_fields_WC_Tipax_Method', 'fs_add_extra_fields_to_shipping_method' );
add_filter( 'woocommerce_shipping_instance_form_fields_WC_Forehand_Method', 'fs_add_extra_fields_to_shipping_method' );
add_filter( 'woocommerce_shipping_instance_form_fields_WC_Custom_Method', 'fs_add_extra_fields_to_shipping_method' );
add_filter( 'woocommerce_shipping_instance_form_fields_WC_Courier_Method', 'fs_add_extra_fields_to_shipping_method' );
add_filter( 'woocommerce_shipping_instance_form_fields_local_pickup', 'fs_add_extra_fields_to_shipping_method' );
add_filter( 'woocommerce_shipping_instance_form_fields_flat_rate', 'fs_add_extra_fields_to_shipping_method' );
add_filter( 'woocommerce_shipping_instance_form_fields_free_shipping', 'fs_add_extra_fields_to_shipping_method' );

function fs_get_shipping_method_description_field( $method ) {
	$settings = 'woocommerce_' . $method->method_id . '_' . $method->instance_id . '_settings';
	$info     = get_option( $settings );

	return ! empty( $info['description'] ) ? $info['description'] : '';
}

function fs_wc_gateways_icon( $gateways ) {
	if ( isset( $gateways['cod'] ) ) {
		$gateways['cod']->icon = get_stylesheet_directory_uri() . '/assets/img/png/pos.png';
	}

	if ( isset( $gateways['pasargad'] ) ) {
		$gateways['pasargad']->icon = get_stylesheet_directory_uri() . '/assets/img/png/pasargad.png';
	}

	if ( isset( $gateways['sep_gateway'] ) ) {
		$gateways['sep_gateway']->icon = get_stylesheet_directory_uri() . '/assets/img/png/saman.png';
	}

	if ( isset( $gateways['wallet'] ) ) {
		$gateways['wallet']->icon = get_stylesheet_directory_uri() . '/assets/img/png/wallet.png';
	}

	return $gateways;
}

add_filter( 'woocommerce_available_payment_gateways', 'fs_wc_gateways_icon' );

function fs_loop_shop_per_page( $cols ) {
	// $cols contains the current number of products per page based on the value stored on Options –> Reading
	// Return the number of products you wanna show per page.
	$cols = 28;

	return $cols;
}

add_filter( 'loop_shop_per_page', 'fs_loop_shop_per_page', 20 );

function fs_custom_product_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
		// Exclude products with zero price
		//		$meta_query   = $query->get( 'meta_query' );
		//		$meta_query[] = array(
		//			'key'     => '_price',
		//			'value'   => 0,
		//			'compare' => '>'
		//		);
		//		$query->set( 'meta_query', $meta_query );

		// Exclude products in the uncategorized category
		$tax_query   = (array) $query->get( 'tax_query' );
		$tax_query[] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => array( 'uncategorized' ),
			'operator' => 'NOT IN'
		);

		$query->set( 'tax_query', $tax_query );

		// Show out of stock products at the end
		if ( $query->get( 'orderby' ) == 'menu_order title' ) {
			$query->set( 'orderby', 'meta_value' );
			$query->set( 'order', 'ASC' );
			$query->set( 'meta_key', '_stock_status' );
		}
	}
}

add_action( 'woocommerce_product_query', 'fs_custom_product_query' );

function fs_logged_in_before_checkout() {
	$page_id = get_option( 'woocommerce_checkout_page_id' );

	if ( ! is_user_logged_in() && is_page( $page_id ) ) {
		$url = add_query_arg( 'redirect_to', get_permalink( $page_id ), site_url( '/my-account/' ) );

		wp_redirect( $url );
		exit;
	}

	if ( is_user_logged_in() ) {
		if ( is_page( get_option( 'woocommerce_myaccount_page_id' ) ) ) {
			$redirect = $_GET['redirect_to'] ?? '';
			if ( $redirect ) {
				echo '<script>window.location.href = "' . $redirect . '";</script>';
			}
		}
	}
}

add_action( 'template_redirect', 'fs_logged_in_before_checkout' );

//function fs_custom_pre_get_posts ( $query )
//{
//	if ( ! is_admin() && $query->is_main_query() )
//	{
//		if ( $query->is_search() )
//		{
//			$type = filter_input( INPUT_GET, 'type', FILTER_SANITIZE_STRING );
//			if ( $type == 'product' )
//				$query->set( 'post_type', 'product' );
//			else
//				$query->set( 'post_type', array(
//					'post',
//					'page'
//				) );
//		}
//	}
//}
//
//add_action( 'pre_get_posts', 'fs_custom_pre_get_posts' );

function fs_get_pagination() {
	global $wp_query;

	$args = array(
		'total'   => $wp_query->max_num_pages,
		'current' => max( 1, get_query_var( 'paged' ) ),
		'base'    => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
		'format'  => '?paged=%#%',
	);

	wc_get_template( 'loop/pagination.php', $args );
}

function fs_adjust_shipping_rate( $rates ) {
	$cart_subtotal = WC()->cart->get_cart_subtotal();

	if ( $cart_subtotal >= 275000 ) {
		unset( $rates['flat_rate:7'] );
	}

	return $rates;
}

add_filter( 'woocommerce_shipping_package_details_array', 'fs_adjust_shipping_rate', 10 );

/**
 * Amazing sale tab
 */
function fs_add_amazing_sale_tab( $default_tabs ) {
	$default_tabs['fs_amazing_sale'] = array(
		'label'    => 'فروش شگفت انگیز',
		'target'   => 'amazing_sale_tab',
		'priority' => 60
	);

	return $default_tabs;
}

add_filter( 'woocommerce_product_data_tabs', 'fs_add_amazing_sale_tab', 10, 1 );

function fs_amazing_sale_css_icon() {
	echo '<style>
	#woocommerce-product-data ul.wc-tabs li.fs_amazing_sale_tab a:before{
		content: "\f488";
	}
	</style>';
}

add_action( 'admin_head', 'fs_amazing_sale_css_icon' );

function fs_amazing_sale_tab_data() {
	global $post;
	?>
    <div id="amazing_sale_tab" class="panel woocommerce_options_panel">
        <div class='options_group'>
			<?php
			woocommerce_wp_checkbox( array(
				'id'    => '_active_amazing_sale',
				'label' => 'برای این محصول فعال شود'
			) );

			woocommerce_wp_text_input( array(
				'id'    => '_amazing_sale_end_date',
				'label' => 'تاریخ پایان',
				'class' => 'amazing-sale-date-field'
			) );
			?>
        </div>
    </div>
	<?php
}

add_action( 'woocommerce_product_data_panels', 'fs_amazing_sale_tab_data' );

function fs_amazing_sale_save_fields( $id, $post ) {
	update_post_meta( $id, '_active_amazing_sale', $_POST['_active_amazing_sale'] );
	update_post_meta( $id, '_amazing_sale_end_date', $_POST['_amazing_sale_end_date'] );
}

add_action( 'woocommerce_process_product_meta', 'fs_amazing_sale_save_fields', 10, 2 );

//function fs_get_active_valid_amazing_sales()
//{
//    date_default_timezone_set('Asia/Tehran');
//
//    $args = [
//        'post_type' => 'product',
//        'post_status' => 'publish',
//        'posts_per_page' => -1,
//        'meta_query' => [
//            'relation' => 'AND',
//            [
//                'key' => '_amazing_sale_end_date',
//                'value' => date("Y-m-d H:i"),
//                'compare' => '<=',
//                'type' => 'DATE'
//            ],
//            [
//                'key' => '_active_amazing_sale',
//                'value' => 'yes',
//                'compare' => '='
//            ]
//        ]
//    ];
//
//    $posts = get_posts($args);
//
//    wp_reset_postdata();
//
//    return $posts;
//}
//
//function fs_is_active_amazing_sales()
//{
//    $args = [
//        'post_type' => 'product',
//        'post_status' => 'publish',
//        'posts_per_page' => 1,
//        'meta_key' => '_active_amazing_sale',
//        'meta_value' => 'yes'
//    ];
//
//    $posts = get_posts($args);
//
//    wp_reset_postdata();
//
//    if ($posts)
//        return true;
//
//    return false;
//}

/**
 * AJAX add to cart button on the single Product Page
 */
function fs_ajax_add_to_cart() {
	WC_Form_Handler::add_to_cart_action();
	WC_AJAX::get_refreshed_fragments();
}

add_action( 'wc_ajax_fs_add_to_cart', 'fs_ajax_add_to_cart' );
add_action( 'wc_ajax_nopriv_fs_add_to_cart', 'fs_ajax_add_to_cart' );

remove_action( 'wp_loaded', array(
	'WC_Form_Handler',
	'add_to_cart_action'
), 20 );

function fs_ajax_add_to_cart_fragments( $fragments ) {
	$all_notices = WC()->session->get( 'wc_notices', array() );

	$notice_types = apply_filters( 'woocommerce_notice_types', array(
		'error',
		'success',
		'notice'
	) );

	ob_start();

	foreach ( $notice_types as $notice_type ) {
		if ( wc_notice_count( $notice_type ) > 0 ) {
			wc_get_template( "notices/{$notice_type}.php", array(
				'notices' => array_filter( $all_notices[ $notice_type ] ),
			) );
		}
	}

	$fragments['notices_html'] = ob_get_clean();

	ob_start();
	woocommerce_mini_cart();
	$fragments['div.mini-cart-content'] = ob_get_clean();

	wc_clear_notices();

	$fragments['div.header-cart-count'] = '<div class="header-cart-count">' . WC()->cart->get_cart_contents_count() . '</div>';

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'fs_ajax_add_to_cart_fragments' );

/**
 * Amazing sales in shop page and custom breadcrumb
 */

//if (!wp_next_scheduled('fs_amazing_sale_custom_cron_hook'))
//    wp_schedule_event(time(), 'hourly', 'fs_amazing_sale_custom_cron_hook');

function fs_check_amazing_sales() {
	$products = fs_get_active_valid_amazing_sales();

	if ( $products ) {
		foreach ( $products as $product ) {
			$args = array(
				'post_type'      => 'product_variation',
				'post_status'    => 'publish',
				'posts_per_page' => - 1,
				'post_parent'    => $product->ID
			);

			$variations = get_posts( $args );

			wp_reset_postdata();

			if ( $variations ) {
				// Variation product
				foreach ( $variations as $variation ) {
					$single_variation = new WC_Product_Variation( $variation->ID );
					$single_variation->set_sale_price( '' );
					$single_variation->save();
				}
			} else {
				// Simple product
				$single_product = new WC_Product( $product->ID );
				$single_product->set_sale_price( '' );
				$single_product->save();
			}

			update_post_meta( $product->ID, '_active_amazing_sale', 'no' );
		}
	}
	wp_reset_postdata();
}

//add_action('fs_amazing_sale_custom_cron_hook', 'fs_check_amazing_sales');

function fs_amazing_product_query( $query ) {
	if ( is_shop() ) {
		if ( isset( $_GET['stock-status'] ) ) {
			$params = explode( ',', $_GET['stock-status'] );

			if ( in_array( 'in-offer', $params ) ) {
				$meta_query = $query->get( 'meta_query' );

				$meta_query[] = array(
					'key'   => '_active_amazing_sale',
					'value' => 'yes'
				);

				$query->set( 'meta_query', $meta_query );
			}
		}
	}
}

add_action( 'woocommerce_product_query', 'fs_amazing_product_query' );

function fs_amazing_breadcrumb_title( $crumbs, $breadcrumb ) {
	if ( is_shop() ) {
		if ( isset( $_GET['stock-status'] ) ) {
			$params = explode( ',', $_GET['stock-status'] );

			if ( in_array( 'in-offer', $params ) ) {
				$index               = count( $crumbs ) - 1;
				$crumbs[ $index ][0] = 'فروش شگفت انگیز';
			}
		}
	}

	return $crumbs;
}

add_filter( 'woocommerce_get_breadcrumb', 'fs_amazing_breadcrumb_title', 20, 2 );

/**
 * YITH woocommerce wishlist plugin
 */
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'fs_yith_wcwl_ajax_update_count' ) ) {
	function fs_yith_wcwl_ajax_update_count() {
		wp_send_json( array(
			'count' => yith_wcwl_count_all_products()
		) );
	}

	add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'fs_yith_wcwl_ajax_update_count' );
	add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'fs_yith_wcwl_ajax_update_count' );
}

// Used for mobile carousel
add_filter( 'woocommerce_gallery_thumbnail_size', function ( $size ) {
	return 'fs-product-main';
} );

add_filter( 'woocommerce_gallery_image_size	', function ( $size ) {
	return 'fs-product-main';
} );

//function fs_order_by_price_low_to_high($args)
//{
//    $orderby_value = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) : apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));
//
//    if ($orderby_value == 'price') {
//        $args['orderby'] = 'meta_value_num';
//        $args['order'] = 'ASC';
//        $args['meta_key'] = '_price';
//    }
//
//    //	if ( $orderby_value == 'date' )
//    //	{
//    //		$args[ 'meta_key' ] = '_price';
//    //		$args[ 'orderby' ]  = 'meta_value_num date';
//    //		$args[ 'order' ]    = 'DESC';
//    //	}
//
//    return $args;
//}
//
//add_filter('woocommerce_get_catalog_ordering_args', 'fs_order_by_price_low_to_high');

/**
 * Order product collections by stock status, instock products first.
 */
//function fs_order_by_stock_status($posts_clauses)
//{
//    global $wpdb;
//
//    if (is_woocommerce() && (is_shop() || is_product_category() || is_product_tag())) {
//        $posts_clauses['join'] .= " INNER JOIN $wpdb->postmeta istockstatus ON ($wpdb->posts.ID = istockstatus.post_id) ";
//        $posts_clauses['orderby'] = " istockstatus.meta_value ASC, " . $posts_clauses['orderby'];
//        $posts_clauses['where'] = " AND istockstatus.meta_key = '_stock_status' AND istockstatus.meta_value <> '' " . $posts_clauses['where'];
//    }
//
//    return $posts_clauses;
//}
//
//add_filter('posts_clauses', 'fs_order_by_stock_status', 2000);

//function ws_default_catalog_orderby( $sort_by ) {
//	return 'stock';
//}
//
//add_filter( 'woocommerce_default_catalog_orderby', 'ws_default_catalog_orderby' );

function fs_override_checkout_fields( $fields ) {
	unset( $fields['billing']['billing_country'] );
	unset( $fields['billing']['billing_address_2'] );
	unset( $fields['billing']['billing_email'] );
	unset( $fields['billing']['billing_phone'] );
	unset( $fields['shipping']['shipping_country'] );
	unset( $fields['shipping']['shipping_address_2'] );

	$fields['billing']['billing_state']['label'] = false;
	$fields['billing']['billing_city']['label']  = false;

	return $fields;
}

add_filter( 'woocommerce_checkout_fields', 'fs_override_checkout_fields' );

function fs_override_billing_fields( $fields ) {
	unset( $fields['billing_address_2'] );
	unset( $fields['billing_country'] );

	$fields['billing_melli_code'] = [
		'type'  => 'text',
		'class' => [ 'my-field-class form-row-wide' ],
		'label' => 'کد ملی'
	];

	return $fields;
}

add_filter( 'woocommerce_billing_fields', 'fs_override_billing_fields' );

function fs_override_shipping_fields( $fields ) {
	unset( $fields['shipping_address_2'] );
	unset( $fields['shipping_country'] );

	return $fields;
}


add_filter( 'woocommerce_shipping_fields', 'fs_override_shipping_fields' );

function fs_melli_code_checkout_process() {
	if ( ! isset( $_POST['billing_melli_code'] ) && empty( $_POST['billing_melli_code'] ) ) {
		wc_add_notice( sprintf( '%s یک فیلد الزامی است.', '<strong>کد ملی صورتحساب</strong>' ), 'error' );
	} elseif ( ! fs_validate_melli_code( $_POST['billing_melli_code'] ) ) {
		wc_add_notice( 'کد ملی نامعتبر است.', 'error' );
	}

	// Check if set, if its not set add an error. This one is only requite for companies
	if ( ! ( preg_match( '/^[0-9]{10}$/D', $_POST['billing_postcode'] ) ) ) {
		wc_add_notice( "کدپستی باید یک مقدار 10 رقمی باشد.", 'error' );
	}
}

add_action( 'woocommerce_checkout_process', 'fs_melli_code_checkout_process' );

function fs_checkout_update_user_meta( $customer_id, $fields ) {
	if ( isset( $fields['billing_melli_code'] ) ) {
		$code = sanitize_text_field( $fields['billing_melli_code'] );
		$code = mdr_convert_persian_to_english_number( $code );
		update_user_meta( $customer_id, 'billing_melli_code', $code );
	}
}

add_action( 'woocommerce_checkout_update_user_meta', 'fs_checkout_update_user_meta', 10, 2 );

function fs_save_account_details( $user_id ) {
	if ( isset( $_POST['account_melli_code'] ) ) {
		update_user_meta( $user_id, 'billing_melli_code', sanitize_text_field( $_POST['account_melli_code'] ) );
	}
}

add_action( 'woocommerce_save_account_details', 'fs_save_account_details' );


function fs_checkout_update_order_meta( $order_id ) {
	update_post_meta( $order_id, 'billing_melli_code', sanitize_text_field( $_POST['billing_melli_code'] ) );
}

add_action( 'woocommerce_checkout_update_order_meta', 'fs_checkout_update_order_meta' );

function fs_admin_order_data_billing_address( $order ) {
	echo '<p><strong>کد ملی:</strong> <br/>' . get_post_meta( $order->get_id(), 'billing_melli_code', true ) . '</p>';
}

add_action( 'woocommerce_admin_order_data_after_billing_address', 'fs_admin_order_data_billing_address', 10, 1 );

function sa_sms_success_order( $order_id ) {
	$order           = wc_get_order( $order_id );
	$price           = $order->get_total();
	$user_id         = $order->get_user()->id;
	$user_mobile     = get_user_meta( $user_id, 'mobile', true );
	$user_first_name = get_user_meta( $user_id, 'first_name', true );
	$sms             = 2;
	$sms_value       = [
		sanitize_text_field( $user_first_name ),
		sanitize_text_field( $order_id ),
		sanitize_text_field( $price )
	];
	sa_sms( sanitize_text_field( $user_mobile ), $sms, $sms_value );
}

add_action( 'woocommerce_order_status_processing', 'sa_sms_success_order', 10, 1 );

/*
 * carousel home top sales section
 */
function wc_get_carousel_home_top_sales_section() {
	$args = [
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => 18,
		'meta_key'       => 'total_sales',
		'orderby'        => 'meta_value_num',
		'meta_query'     => [
			[
				'key'     => '_stock_status',
				'value'   => 'instock',
				'compare' => '='
			]
		]
	];

	$products = get_posts( $args );
	/* Restore original Post Data */
	wp_reset_postdata();

	/* Set Content to Option Table */
	update_option( 'my_theme_carousel_home_top_sales_section', $products, 'no' );
}

//add_action( 'save_post', 'wc_get_carousel_home_top_sales_section', 10, 3 );
add_action( 'before_delete_post', 'wc_get_carousel_home_top_sales_section' );

/*
 * carousel home new products section
 */
function wc_get_carousel_home_new_products() {
	$args = array(
		'orderby'    => 'ID',
		'status'     => 'publish',
		'limit'      => 12,
		'meta_key'   => '_stock_status',
		'meta_value' => 'instock'
	);

	$products = wc_get_products( $args );
	/* Restore original Post Data */
	wp_reset_postdata();

	/* Set Content to Option Table */
	update_option( 'my_theme_carousel_home_new_products', $products, 'no' );
}

//add_action( 'save_post', 'wc_get_carousel_home_new_products', 10, 3 );
add_action( 'before_delete_post', 'wc_get_carousel_home_new_products' );

/*
 * carousel cart down on sales section
 */
function wc_get_carousel_cart_down_on_sales_section() {
	$args = [
		'post_type'      => 'product',
		'post_status'    => 'publish',
		'posts_per_page' => 18,
		'meta_query'     => [
			[
				'key'     => '_stock_status',
				'value'   => 'instock',
				'compare' => '='
			],
			[
				'key'     => '_active_amazing_sale',
				'value'   => 'yes',
				'compare' => '='
			]
		]
	];

	$products = get_posts( $args );
	/* Restore original Post Data */
	wp_reset_postdata();

	/* Set Content to Option Table */
	update_option( 'my_theme_carousel_cart_down_on_sales_section', $products, 'no' );
}

//add_action( 'save_post', 'wc_get_carousel_cart_down_on_sales_section', 10, 3 );
add_action( 'before_delete_post', 'wc_get_carousel_cart_down_on_sales_section' );

function mdr_save_acf_carousel_form( $post_id ) {

	// Get newly saved values.
	$values = get_fields( $post_id );

	/*
	 * carousel cart gray section
	 */
	$first_row_category = get_field( 'first-row-category', $post_id );
	if ( $first_row_category ) {
		$category = get_term_by( 'id', $first_row_category, 'product_cat' );

		$args = array(
			'category'   => $category->slug,
			'orderby'    => 'name',
			'status'     => 'publish',
			'limit'      => 12,
			'meta_key'   => '_stock_status',
			'meta_value' => 'instock'
		);

		$products = wc_get_products( $args );
		/* Restore original Post Data */
		wp_reset_postdata();

		/* Set Content to Option Table */
		update_option( 'my_theme_carousel_cart_gray_section', $products, 'no' );
	}

	/*
	 * carousel cart first white section
	 */
	$second_row_category = get_field( 'second-row-category', $post_id );
	if ( $second_row_category ) {
		$category = get_term_by( 'id', $second_row_category, 'product_cat' );

		$args = array(
			'category'   => $category->slug,
			'orderby'    => 'name',
			'status'     => 'publish',
			'limit'      => 12,
			'meta_key'   => '_stock_status',
			'meta_value' => 'instock'
		);

		$products = wc_get_products( $args );
		/* Restore original Post Data */
		wp_reset_postdata();

		/* Set Content to Option Table */
		update_option( 'my_theme_carousel_cart_first_white_section', $products, 'no' );
	}

	/*
	 * carousel cart second white section
	 */
	$third_row_category = get_field( 'third-row-category', $post_id );
	if ( $third_row_category ) {
		$category = get_term_by( 'id', $third_row_category, 'product_cat' );

		$args = array(
			'category'   => $category->slug,
			'orderby'    => 'name',
			'status'     => 'publish',
			'limit'      => 12,
			'meta_key'   => '_stock_status',
			'meta_value' => 'instock'
		);

		$products = wc_get_products( $args );
		/* Restore original Post Data */
		wp_reset_postdata();

		/* Set Content to Option Table */
		update_option( 'my_theme_carousel_cart_second_white_section', $products, 'no' );
	}
}

add_action( 'acf/save_post', 'mdr_save_acf_carousel_form' );

/*
 * product Not available in stock show related product in up.
 */
function related_in_up() {
	global $product;

	if ( ! $product->is_in_stock() ) {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		echo '<div class="bg-gray-100 pb-5">
<div style="display: flex;justify-content: center;background-color: #ffffff;padding-bottom: 15px;">
<div style="font-size: 16px;background-color: #fed100;text-align: center;border-radius: 18px;height: 32px;font-weight: 700;padding: 4px 10px 10px 10px;">
این محصول موجود نیست
</div>
</div>';
		woocommerce_related_products();
		echo '</div>';
	}
}

add_filter( 'woocommerce_before_single_product', 'related_in_up' );

// remove the cross sell from hook
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
