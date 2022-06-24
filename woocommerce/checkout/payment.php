<?php
/**
 * Checkout Payment Section
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/payment.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.3
 */

defined( 'ABSPATH' ) || exit;

if ( ! wp_doing_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>
    <div id="payment" class="woocommerce-checkout-payment">
        <div class="flex flex-row items-center mb-3">
            <img class="object-fit object-center flex-shrink-0"
                 src="<?php echo get_stylesheet_directory_uri() . "/assets/img/svg/CreditCard.svg"; ?>" alt=""/>
            <div class="flex flex-shrink-0 items-center mx-1 text-lg font-bold"> روش پرداخت</div>
            <div class="flex-1 border-b border-border"></div>
        </div>
		<?php if ( WC()->cart->needs_payment() ) : ?>
            <div class="mb-5 grid grid-cols-2 gap-x-1 gap-y-2 wc_payment_methods payment_methods methods">
				<?php
				if ( ! empty( $available_gateways ) ) {
					$i = 0;
					foreach ( $available_gateways as $gateway ) {
						$i ++;
						wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway, 'i' => $i ) );
					}
				} else {
					echo '<p class="woocommerce-notice woocommerce-notice--info woocommerce-info">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</p>';
				} // @codingStandardsIgnoreLine
				?>
            </div>
            <div>
                <input type="checkbox" id="privacyPolicyChecked" style="vertical-align: middle;" checked>
                <a href="<?php echo get_site_url() ?>/faq/">قوانین و مقررات را مطالعه و موافقت خود را اعلام می‌کنم.</a>
            </div>
		<?php endif; ?>
        <!--		<div class="form-row place-order">-->
        <noscript>
			<?php
			/* translators: $1 and $2 opening and closing emphasis tags respectively */
			printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ), '<em>', '</em>' );
			?>
            <br/>
            <button type="submit" class="button alt" name="woocommerce_checkout_update_totals"
                    value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>
        </noscript>

		<?php wc_get_template( 'checkout/terms.php' ); ?>

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="mt-2 w-full block text-center text-lg leading-12 btn-effect text-gray-main py-1 rounded-xs bg-secondary-main" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
        <!--		</div>-->
    </div>
<?php
if ( ! wp_doing_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}
