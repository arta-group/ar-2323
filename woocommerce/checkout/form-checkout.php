<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! is_user_logged_in() )
{
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );

	return;
}
?>
<section class="pt-3/3 container mx-auto">
	<?php
	do_action( 'woocommerce_before_checkout_form', $checkout );
	?>
	<form name="checkout" method="post" class="checkout woocommerce-checkout flex flex-col" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
		<div class="flex flex-col lg-block fs-checkout-container" id="fs-checkout-container">
			<div class="flex-1 px-2 md-px-3 lg-px-0 fs-big-sidebar" id="fs-big-sidebar">
                <div class="fs-big-sidebar__inner">
                    <div class="flex flex-row items-center">
                        <div class="icon-identification-card ml-1/6 leading-2 text-2"></div>
                        <div class="flex flex-shrink-0 items-center ml-1 text-lg font-bold"> اطلاعات پرداخت</div>
                        <div class="flex-1 border-b border-border"></div>
                    </div>
                    <div class="space-y-1/9 mt-4">
                        <?php do_action( 'woocommerce_checkout_billing' ); ?>
                    </div>
                </div>
			</div>
			<div class="w-full w-405 lg-mr-3/2 flex-shrink-0 fs-small-sidebar" id="fs-small-sidebar">
                <div class="fs-small-sidebar__inner">
                    <div id="order_review" class="woocommerce-checkout-review-order border-border lg-border lg-bg-gray-50 lg-rounded-xs p-3 flex flex-col">
                        <?php do_action( 'woocommerce_checkout_order_review' ); ?>
                    </div>
                </div>
			</div>
		</div>
	</form>
</section>