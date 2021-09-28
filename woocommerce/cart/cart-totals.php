<?php
/**
 * Cart totals
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-totals.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.3.6
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="w-full w-296 flex-shrink-0 lg-mr-3/2 cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">
	<div class="mb-3 border-border border bg-gray-50 rounded-xs pr-2/7 pl-2/9 pt-2/5 pb-2/7 flex flex-col">
		<div class="flex flex-row items-center mb-2">
			<div class="icon-bill text-2/2 leading-2/2 flx-shrink-0 ml-1/5 h-2/2"></div>
			<div class="flex flex-shrink-0 items-center ml-1 text-lg font-bold"> صورتحساب</div>
			<div class="flex-1 border-b border-border"></div>
		</div>
		<div class="divide-y divide-border">
			<div class="py-1 flex items-center justify-between">
				<div class="text-base font-bold text-gray-600 leading-2/2">قیمت کالاها</div>
				<div class="text-lg font-bold text-gray-dark">
					<span class="ml-0/2 inline-block leading-2/8"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
					<span class="text-base font-normal inline-block">تومان</span>
				</div>
			</div>
			<?php
			$discount_total = WC()->cart->get_cart_discount_total();
			if ( $discount_total > 0 )
			{
				?>
				<div class="py-1 flex items-center justify-between">
					<div class="text-base font-bold text-gray-600 leading-2/2">تخفیف کالاها</div>
					<div class="text-lg font-bold text-gray-dark">
						<span class="ml-0/2 inline-block leading-2/8"><?php echo wc_price( $discount_total ); ?></span>
						<span class="text-base font-normal inline-block">تومان</span>
					</div>
				</div>
				<?php
			}
			?>
			<div class="py-1 flex items-center justify-between">
				<div class="text-base font-bold text-gray-600 leading-2/2">جمع سبد خرید</div>
				<div class="text-lg font-bold text-gray-dark">
					<span class="ml-0/2 inline-block leading-2/8"><?php echo WC()->cart->get_cart_total(); ?></span>
					<span class="text-base font-normal inline-block">تومان</span>
				</div>
			</div>
		</div>
		<a href="<?php echo esc_url( site_url( 'checkout' ) ); ?>" class="mt-2 btn-effect w-full block text-center text-lg leading-12 text-gray-main py-1 rounded-xs bg-secondary-main"> ادامه جهت تسویه حساب </a>
	</div>
	<?php
	if ( wc_coupons_enabled() )
	{
		?>
		<div class="mb-3 border-border border rounded-xs pr-2/7 pl-2/9 pt-3/2 pb-2/6 flex flex-col ">
			<div class="flex flex-row items-center">
				<div class="icon-gift text-2/2 leading-2/2 flx-shrink-0 ml-1/5"></div>
				<div class="flex flex-shrink-0 items-center ml-1 text-lg font-bold"> کد تخفیف</div>
				<div class="flex-1 border-b border-border"></div>
			</div>
			<p class="pt-3/7 pb-2/1 text-base leading-2/2 "> اگر کوپن تخفیف دارید آن را وارد کنید</p>
			<form class="flex flex-row items-center border border-border rounded-xs p-0/8 checkout_coupon woocommerce-form-coupon" method="post">
				<input type="text" name="coupon_code" class="input-text text-base leading-2/2 flex-1" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value=""/>
				<input type="submit" class="text-base leading-2/2 pt-0/1 pb-0/6 pr-1/3 pl-1/4 rounded-xs" name="apply_coupon" value="بررسی">
			</form>
		</div>
		<?php
	}
	?>
	<div class="mb-3 border-border border rounded-xs p-2/6 flex flex-row">
		<div class="icon-info text-2/4 leading-2/4 w-4 text-secondary-main"></div>
		<div class="flex flex-col flex-1">
			<p class="text-sbase text-gray-400 leading-2 mb-3 text-justify">هزینه‌ی ارسال در ادامه بر اساس آدرس، زمان و نحوه‌ی ارسال انتخابی شما‌ محاسبه و به این مبلغ اضافه خواهد شد.</p>
			<p class="text-sbase text-gray-400 leading-2 text-justify">کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی را تکمیل کنید.</p>
		</div>
	</div>
</div>