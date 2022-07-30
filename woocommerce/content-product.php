<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
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
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$in_stock = $product->is_in_stock();

$stock_status = $product->get_stock_status();

$prices = fs_get_product_prices( $product );
?>
<div <?php wc_product_class( 'product-card', $product ); ?>>
    <div class="rounded-xs overflow-hidden bg-white h-full con-element group ">
        <div class="relative w-full h-full pt-2/5 px-1/5 pb-2 flex flex-col justify-center items-center">
            <div class="h-13 md-h-16 mb-6 flex-shrink-0 w-13 md-w-16 lg-mb-1 flex items-center justify-center relative lg-overflow-hidden options">
                <a href="<?php echo esc_attr( $product->get_permalink() ); ?>" class="w-full h-full">
					<?php
					$attachment_id = has_post_thumbnail( $product->get_id() ) ? get_post_thumbnail_id( $product->get_id() ) : $product->get_gallery_image_ids()[0] ?? 0;
					echo $attachment_id ? wp_get_attachment_image( $attachment_id, 'fs-product-card', false, array( 'class' => 'object-fit object-center w-full h-full' ) ) : wc_placeholder_img( 'fs-product-card' );
					?>
                </a>

                <div class="absolute bottom-0 left-0 w-full mx-auto z-10 block">
                    <div class="flex flex-row items-center justify-between w-14 h-5 mx-auto relative product-card-btns">
						<?php
						if ( defined( 'YITH_WOOCOMPARE' ) ) {
							echo do_shortcode( '[yith_compare_button]' );
						}

						if ( defined( 'YITH_WCWL' ) ) {
							echo do_shortcode( '[yith_wcwl_add_to_wishlist icon="icon-heart" link_classes="w-4/2 h-4/2 rounded-full bg-secondary-main flex items-center justify-center pt-0/3 pl-0/1 text-xl text-gray-700 absolute top-6 lg-top-8 right-7/5 delay-50 cubic-transition transform lg-group-hover--translate-y-8"]' );
						}
						?>
                        <!--<a href="#" class="w-4/2 h-4/2 rounded-full bg-secondary-main flex items-center justify-center icon-search-secondary text-xl text-gray-700 absolute top-8 left-0 delay-100 cubic-transition transform group-hover--translate-y-8"></a>-->
                    </div>
                </div>
            </div>
            <div class="flex flex-col flex-1 relative to-single w-full">
                <div class="md-px-1">
					<?php
					$category = fs_get_the_primary_category( 'product_cat', $product->get_id() );
					if ( $category ) {
						?>
                        <div class="mb-0/5 lg-mb-1/4 text-sm leading-2 text-primary-main text-center"><?php echo $category['name']; ?></div>
						<?php
					}
					?>
                    <a href="<?php echo esc_attr( $product->get_permalink() ); ?>"
                       class="block text-base leading-2/2 text-gray-dark text-center"><?php echo $product->get_title(); ?></a>
                </div>
                <div class="flex flex-col items-center flex-1 justify-end">
					<?php
					if ( $stock_status == 'instock' ) {
						if ( $prices['discount'] ) {
							?>
                            <div class="discounted_price text-base leading-2/2 text-gray-300 text-center line-through">
								<?php echo wc_price( $prices['regular_price'] ); ?>
                                تومان
                            </div>
							<?php
						}
						?>
                        <div class="text-base leading-2/8 text-gray-main text-center font-bold">
                            <span class="text-lg text-gray-dark ml-0/3"><?php echo wc_price( $prices['price'] ); ?></span>
                            تومان
                        </div>
						<?php
					} elseif ( $stock_status == 'must_contact_us' ) {
						?>
                        <div class="text-base leading-11 text-gray-600 text-center font-bold">تماس بگیرید</div>
						<?php
					} else { ?>
                        <div class="text-medium leading-2/8 text-gray-600 text-center font-bold">ناموجود</div>
						<?php
					}
					?>
                </div>
                <div class="absolute top-16 left-half w-17 lg-flex items-center justify-center cubic-transition transform group-hover--translate-y-8 mt-0/3 -translate-x-1/2 custom-hidden-m">
                    <a href="<?php echo esc_attr( $product->get_permalink() ); ?>"
                       class="bg-primary-main text-white px-3/2 pt-0/8 pb-0/6 leading-2/2 text-base font-bold rounded-xs">مشاهده
                        محصول</a>
                </div>
            </div>
            <div class="absolute top-1 lg-top-0 right-2 w-4 h-2 mr-0/4 text-primary-main">
				<?php
				if ( $prices['discount'] && $in_stock ) {
					?>
                    <div class="relative icon-product-off leading-1/9 text-xl">
                        <div class="text-center text-white leading-1/9 text-sm absolute top-0 right-0 z-10 w-full font-black"
                             dir="ltr">-٪<?php echo $prices['discount']; ?></div>
                    </div>
					<?php
				}
				?>
            </div>
        </div>
    </div>
</div>