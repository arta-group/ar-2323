<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="shop_table woocommerce-checkout-review-order-table mt-0">
	<div class="mb-5">
		<div class="flex flex-row items-center mb-3">
			<div class="icon-bill text-2 leading-2 h-2"></div>
			<div class="flex flex-shrink-0 items-center mx-1 text-lg font-bold"> صورتحساب</div>
			<div class="flex-1 border-b border-border"></div>
		</div>
		<div class="divide-y divide-border">
			<div class="py-1/6 flex items-center justify-between">
				<div class="text-base font-bold text-gray-600 ">قیمت کالاها</div>
				<div class="text-lg font-bold text-gray-dark">
					<span class="ml-0/2 inline-block"><?php wc_cart_totals_subtotal_html(); ?></span>
					<span class="text-base font-normal inline-block">تومان</span>
				</div>
			</div>
			<?php
			$discount_total = WC()->cart->get_cart_discount_total();
			if ( $discount_total > 0 )
			{
				?>
				<div class="py-1/6 flex items-center justify-between">
					<div class="text-base font-bold text-gray-600 ">تخفیف کالاها</div>
					<div class="text-lg font-bold text-gray-dark">
						<span class="ml-0/2 inline-block cart-subtotal cart-discount"><?php echo wc_price( $discount_total ); ?></span>
						<span class="text-base font-normal inline-block">تومان</span>
					</div>
				</div>
				<?php
			}
			?>
			<div class="py-1/6 flex items-center justify-between">
				<div class="text-base font-bold text-gray-600">حمل و نقل</div>
				<div class="text-lg font-bold text-gray-dark">
					<span class="ml-0/2 inline-block woocommerce-shipping-totals shipping">
						<?php
						$shipping_total = 0;

						foreach ( WC()->session->get( 'shipping_for_package_0' )[ 'rates' ] as $method_id => $rate )
						{
							if ( WC()->session->get( 'chosen_shipping_methods' )[ 0 ] == $method_id )
							{
								// The shipping method label name
								$rate_label = $rate->label;

								// The cost excluding tax
								$rate_cost_excl_tax = floatval( $rate->cost );

								// The taxes cost
								$rate_taxes = 0;
								foreach ( $rate->taxes as $rate_tax )
									$rate_taxes += floatval( $rate_tax );

								// The cost including tax
								$rate_cost_incl_tax = $rate_cost_excl_tax + $rate_taxes;
								$shipping_total     = floatval( preg_replace( '#[^\d.]#', '', WC()->cart->get_cart_shipping_total() ) );

								if ( $shipping_total > 0 )
									echo wc_price( $shipping_total );
								else
								{
									$title             = '';
									$extract_method_id = explode( ':', $method_id );

									if ( isset( $extract_method_id[ 0 ] ) && isset( $extract_method_id[ 1 ] ) )
									{
										$option = get_option( 'woocommerce_' . $extract_method_id[ 0 ] . '_' . $extract_method_id[ 1 ] . '_settings' );
										$title  = isset( $option [ 'extra_description' ] ) ? $option [ 'extra_description' ] : '';
									}

									echo ! empty( $title ) ? $title : 'رایگان';
								}

								break;
							}
						}
						?>
					</span>
					<?php if ( $shipping_total > 0 ) { ?>
						<span class="text-base font-normal inline-block">تومان</span>
					<?php } ?>
				</div>
			</div>
			<?php
            $flat_r = WC()->session->get('chosen_shipping_methods')[0];
            if ( !($flat_r == 'flat_rate:9' || $flat_r == 'local_pickup:6') ) {
                global $woocommerce;
                $items = $woocommerce->cart->get_cart();
                $extra = 0;
                foreach ($items as $item => $values) {
                    $_product = wc_get_product($values['data']->get_id());
                    if (get_post_meta($values['product_id'], '_add_shipping', true) != null) {
                        $extra_post_price = get_post_meta($values['product_id'], '_shapping_cost', true);
                        $extra = $extra + ($values['quantity'] * $extra_post_price);
                    }
                }
                if ($extra > 0) {
                    echo '
                        <div class="py-1/6 flex items-center justify-between">
                            <div class="text-base font-bold text-gray-600">اضافه هزینه بسته بندی</div>
                            <div class="text-lg font-bold text-gray-dark">
                                <span class="ml-0/2 inline-block woocommerce-shipping-totals shipping">
                                <span class="woocommerce-Price-amount amount"><bdi><span class="woocommerce-Price-currencySymbol"></span>' . wc_price($extra) . '</bdi></span></span>
                                <span class="text-base font-normal inline-block">تومان</span>
                            </div>
                        </div>';
                }
            }
			?>
			<div class="py-1/6 flex items-center justify-between">
				<div class="text-lg font-bold text-primary-main">مبلغ قابل پرداخت</div>
				<div class="text-2/2 font-bold text-primary-main">
					<span class="ml-0/2 inline-block product-total order-total"><?php wc_cart_totals_order_total_html(); ?></span>
					<span class="text-lg font-normal inline-block">تومان</span>
				</div>
			</div>
		</div>
	</div>
	<div class="mb-5">
		<table class="websites-depot-checkout-review-shipping-table">
			<?php
			if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() )
			{
				do_action( 'woocommerce_review_order_before_shipping' );
				wc_cart_totals_shipping_html();
				do_action( 'woocommerce_review_order_after_shipping' );
			}
			?>
		</table>
	</div>
</div>