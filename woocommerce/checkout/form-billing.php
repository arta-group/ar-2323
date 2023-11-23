<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_checkout_billing_form', $checkout );

$fields = $checkout->get_checkout_fields( 'billing' );
if ( $fields )
{
	$user_info = get_userdata( get_current_user_id() );
	?>
	<div class="flex flex-col lg-flex-row items-center lg-space-x-reverse lg-space-x-3/2">
		<div class="w-full lg-w-auto lg-flex-1 mb-1/9 lg-mb-0">
			<label for="billing_first_name" class="block text-base mb-0/7 leading-2/2 text-gray-main">نام</label>
			<input type="text" name="billing_first_name" id="billing_first_name" class="rounded-xs border-2 border-border w-full text-base leading-2/2 pt-1 pb-0/9 px-1/8" autocomplete="given-name" placeholder="نام خود را فارسی وارد نمایید " value="<?php echo esc_attr( $user_info->first_name ); ?>">
		</div>

		<div class="w-full lg-w-auto lg-flex-1">
			<label for="billing_last_name" class="block text-base mb-0/7 leading-2/2 text-gray-main">نام خانوادگی</label>
			<input type="text" name="billing_last_name" id="billing_last_name" class="rounded-xs border-2 border-border w-full text-base leading-2/2 pt-1 pb-0/9 px-1/8" autocomplete="family-name" placeholder="نام خانوادگی خود را فارسی وارد نمایید" value="<?php echo esc_attr( $user_info->last_name ); ?>">
		</div>
	</div>
	<div class="flex flex-col lg-flex-row items-center lg-space-x-reverse lg-space-x-3/2">
		<div class="w-full lg-w-auto lg-flex-1">
			<label for="billing_melli_code" class="block text-base mb-0/7 leading-2/2 text-gray-main">کد ملی</label>
			<input type="text" name="billing_melli_code" id="billing_melli_code" class="rounded-xs border-2 border-border w-full w-405 text-base leading-2/2 pt-1 pb-0/9 px-1/8 " autocomplete="organization" placeholder="" value="<?php echo $checkout->get_value( 'billing_melli_code' ) ?>">
		</div>
		<div class="w-full lg-w-auto lg-flex-1">
<!--			<label for="billing_company" class="block text-base mb-0/7 leading-2/2 text-gray-main">شرکت (اختیاری)</label>-->
<!--			<input type="text" name="billing_company" id="billing_company" class="rounded-xs border-2 border-border w-full w-405 text-base leading-2/2 pt-1 pb-0/9 px-1/8 " autocomplete="organization" placeholder="" value="--><?php //echo $checkout->get_value( 'billing_company' ) ?><!--">-->
		</div>
	</div><input type="hidden" name="billing_country" id="billing_country" value="IR"><input type="hidden" name="billing_phone" id="billing_phone" value="<?php echo $user_info->mobile; ?>">
	<div class="flex flex-col lg-flex-row items-center lg-space-x-reverse lg-space-x-3/2 city-select">
		<div class="w-full lg-w-auto lg-flex-1 mb-1/9 lg-mb-0">
			<label for="billing_state" class="block text-base mb-0/7 leading-2/2 text-gray-main">استان</label>
			<?php echo woocommerce_form_field( 'billing_state', $fields[ 'billing_state' ], $checkout->get_value( 'billing_state' ) ); ?>
		</div>
        <div class="w-full lg-w-auto lg-flex-1 mb-1/9 lg-mb-0">
            <label for="billing_city" class="block text-base mb-0/7 leading-2/2 text-gray-main">شهر / روستا</label>
            <div class="loader"></div>
            <?php echo woocommerce_form_field( 'billing_city', $fields[ 'billing_city' ], $checkout->get_value( 'billing_city' ) ); ?>
        </div>
	</div>
	<div class=" flex flex-col lg-flex-row items-center lg-space-x-reverse lg-space-x-3/2">
		<div class="w-full lg-w-auto lg-flex-1">
			<label for="billing_address_1" class="block text-base mb-0/7 leading-2/2 text-gray-main"> آدرس</label>
			<input type="text" name="billing_address_1" id="billing_address_1" class="rounded-xs border-2 border-border w-full text-base leading-2/2 pt-1 pb-0/9 px-1/8" autocomplete="address-line1" placeholder="آدرس کامل بدون شهر و استان" value="<?php echo $checkout->get_value( 'billing_address_1' ) ?>">
		</div>
	</div>
	<div class="flex flex-col lg-flex-row items-center lg-space-x-reverse lg-space-x-3/2">
		<div class="w-full lg-w-auto lg-flex-1 mb-1/9 lg-mb-0">
			<label for="billing_postcode" class="block text-base mb-0/7 leading-2/2 text-gray-main">کدپستی</label>
			<input type="number" name="billing_postcode" id="billing_postcode" class="rounded-xs border-2 border-border w-full w-405 text-base leading-2/2 pt-1 pb-0/9 px-1/8" autocomplete="postal-code" placeholder="کدپستی ۱۰ رقمی " value="<?php echo $checkout->get_value( 'billing_postcode' ) ?>">
		</div>
	</div>
    <div id="formUserId" style="display: none"><?php echo $user_info->ID; ?></div>
	<?php
}
do_action( 'woocommerce_after_checkout_billing_form', $checkout );
?>
<div class=" flex items-center space-x-reverse space-x-3/2">
	<div class="w-full lg-w-auto lg-flex-1">
		<label for="order_comments" class="block text-base mb-0/7 leading-2/2 text-gray-main"> یادداشت سفارش</label>
		<textarea name="order_comments" id="order_comments" class="w-full border-2 rounded-xs text-base border-border px-2 py-1/5 h-17" placeholder="توضیحاتی در مورد سفارش شما، به عنوان مثال نکاتی در خصوص تحویل مرسوله"></textarea>
	</div>
</div>