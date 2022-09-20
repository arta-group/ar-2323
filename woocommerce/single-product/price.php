<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$in_stock     = $product->is_in_stock();
$stock_status = $product->get_stock_status();

$prices = fs_get_product_prices( $product );

if ( $stock_status == 'instock' && $prices['regular_price'] > 0 ) {
	if ( $product->is_on_sale() ) {
		?>
        <div class="discounted_price text-gray-300 text-medium lg-text-2 font-bold leading-3/9 ml-3 line-through">
            <span class="font-bold"><?php echo wc_price( $prices['regular_price'] ); ?></span>
            <span class="text-2">تومان</span></div>
		<?php
	}
	?>
    <div class="final_price text-2/4 lg-text-3 font-bold text-primary-main leading-4/7 lg-ml-3">
        <span class="font-black tracking-tighter"><?php echo wc_price( $prices['price'] ); ?></span>
        <span class="text-2/4">تومان</span>
    </div>
	<?php
	if ( $prices['discount'] ) {
		?>
        <div class="text-primary-main absolute bottom-4 left-0 lg-static">
            <div class="relative icon-product-off leading-2/7 text-2/7">
                <div class="text-center text-white leading-2/7 text-xl absolute top-0 right-0 z-10 w-full font-black discount-percent"
                     dir="ltr"><?php echo sprintf( '-٪%d', $prices['discount'] ); ?></div>
            </div>
        </div>
		<?php
	}
} elseif ( $stock_status == 'must_contact_us' ) {
	?>
    <div class="final_price text-3 font-bold text-primary-main leading-4/7 ml-3">
        <a href="<?php echo esc_url( site_url( 'contact' ) ) ?>">تماس بگیرید</a>
    </div>
	<?php
} else { ?>
    <div class="final_price text-3 font-bold text-primary-main leading-4/7 ml-3">
        <span class="text-2/4">ناموجود</span>
    </div>
	<?php
}
