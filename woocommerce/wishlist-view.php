<?php
/**
 * Wishlist page template - Standard Layout
 *
 * @author  Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 3.0.0
 */

/**
 * Template variables:
 *
 * @var $wishlist                      \YITH_WCWL_Wishlist Current wishlist
 * @var $wishlist_items                array Array of items to show for current page
 * @var $wishlist_token                string Current wishlist token
 * @var $wishlist_id                   int Current wishlist id
 * @var $users_wishlists               array Array of current user wishlists
 * @var $current_page                  int Current page
 * @var $page_links                    array Array of page links
 * @var $is_user_owner                 bool Whether current user is wishlist owner
 * @var $show_price                    bool Whether to show price column
 * @var $show_dateadded                bool Whether to show item date of addition
 * @var $show_stock_status             bool Whether to show product stock status
 * @var $show_add_to_cart              bool Whether to show Add to Cart button
 * @var $show_remove_product           bool Whether to show Remove button
 * @var $show_price_variations         bool Whether to show price variation over time
 * @var $show_variation                bool Whether to show variation attributes when possible
 * @var $show_cb                       bool Whether to show checkbox column
 * @var $show_quantity                 bool Whether to show input quantity or not
 * @var $show_ask_estimate_button      bool Whether to show Ask an Estimate form
 * @var $show_last_column              bool Whether to show last column (calculated basing on previous flags)
 * @var $move_to_another_wishlist      bool Whether to show Move to another wishlist select
 * @var $move_to_another_wishlist_type string Whether to show a select or a popup for wishlist change
 * @var $additional_info               bool Whether to show Additional info textarea in Ask an estimate form
 * @var $price_excl_tax                bool Whether to show price excluding taxes
 * @var $enable_drag_n_drop            bool Whether to enable drag n drop feature
 * @var $repeat_remove_button          bool Whether to repeat remove button in last column
 * @var $available_multi_wishlist      bool Whether multi wishlist is enabled and available
 * @var $no_interactions               bool
 */

if ( ! defined( 'YITH_WCWL' ) )
	exit;
?>
<section class="flex flex-col lg-flex-row container mx-auto px-2 md-px-3 lg-px-0">
	<div class="w-full lg-w-auto lg-flex-1 mb-4">
		<div class="border border-border rounded-xs overflow-hidden shop_table cart wishlist_table wishlist_view traditional responsive">
			<div class="bg-gray-50 py-1/8 border-b border-border custom-hidden-m lg-flex flex-row items-center justify-between xl-px-15 lg-pl-10 lg-pr-15">
				<div class="text-base text-gray-500 leading-2/2 font-bold"> عنوان محصول</div>
				<div class="text-base text-gray-500 leading-2/2 font-bold pr-6">قیمت</div>
				<div class="text-base text-gray-500 leading-2/2 font-bold pr-6">تعداد</div>
				<div class="text-base text-gray-500 leading-2/2 font-bold pl-2">عملیات</div>
			</div>
			<div class="flex flex-col divide-y divide-border">
				<?php
				if ( $wishlist && $wishlist->has_items() )
				{
					foreach ( $wishlist_items as $item )
					{
						global $product;

						$product      = $item->get_product();
						$availability = $product->get_availability();
						$stock_status = isset( $availability[ 'class' ] ) ? $availability[ 'class' ] : false;
						if ( $product && $product->exists() )
						{
							?>
							<div class="px-1/5 lg-px-3 py-2/9 flex flex-col lg-flex-row lg-items-center relative wish-list" id="yith-wcwl-row-<?php echo esc_attr( $item->get_product_id() ); ?>" data-row-id="<?php echo esc_attr( $item->get_product_id() ); ?>">
								<div class=" w-full lg-w-28 flex items-center mb-2 lg-mb-0">
									<div class="w-8/4 h-8/2 border border-border rounded-xs overflow-hidden flex-shrink-0 ml-1/5 lg-ml-3/3">
										<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item->get_product_id() ) ) ); ?>">
											<?php
											$image_id  = $product->get_image_id();
											$image_url = wp_get_attachment_image_url( $image_id, 'fs-product-thumbnail' );
											?>
											<img src="<?php echo esc_attr( $image_url ); ?>" class="w-full h-full object-center rounded-x">
										</a>
									</div>
									<div class="text-base leading-2/2 text-gray-main w-16">
										<a href="<?php echo esc_url( get_permalink( apply_filters( 'woocommerce_in_cart_product', $item->get_product_id() ) ) ); ?>"><?php echo esc_html( apply_filters( 'woocommerce_in_cartproduct_obj_title', $product->get_title(), $product ) ); ?></a>
										<?php
										if ( $show_variation && $product->is_type( 'variation' ) )
											echo wc_get_formatted_variation( $product );
										?>
									</div>
								</div>
								<div class="flex lg-w-40 lg-pr-7 lg-pl-6 flex-row items-center justify-between flex-1 mb-2 lg-mb-0">
									<div class="text-base lg-text-lg leading-2/8 font-bold text-gray-main price">
										<span class="ml-0/3 inline-block"><?php echo $item->get_formatted_product_price(); ?></span>
										<span class="text-base leading-2/2 font-normal inline-block text-primary-main">تومان</span>
									</div>
									<div class="input-quantity flex w-8 h-5 items-center justify-between py-1/1 px-1/2 rounded-xs cart-quantity">
										<?php do_action( 'yith_wcwl_table_before_product_quantity', $item, $wishlist ); ?>

										<?php if ( ! $no_interactions && $wishlist->current_user_can( 'update_quantity' ) ) : ?>
											<input type="number" min="1" step="1" name="items[<?php echo esc_attr( $item->get_product_id() ); ?>][quantity]" value="<?php echo esc_attr( $item->get_quantity() ); ?>"/>
										<?php else : ?><?php echo esc_html( $item->get_quantity() ); ?><?php endif; ?>

										<?php do_action( 'yith_wcwl_table_after_product_quantity', $item, $wishlist ); ?>
									</div>
								</div>
								<div class="flex lg-w-21 items-center justify-between">

									<?php
									$show_add_to_cart = apply_filters( 'yith_wcwl_table_product_show_add_to_cart', $show_add_to_cart, $item, $wishlist );
									if ( $show_add_to_cart && isset( $stock_status ) && 'out-of-stock' !== $stock_status )
										woocommerce_template_loop_add_to_cart( array( 'quantity' => $show_quantity ? $item->get_quantity() : 1 ) );
									?>
                                    
                                    <a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item->get_product_id() ) ); ?>" class="flex items-center icon-close-alt text-primary-main text-2/4 leading-2/4 absolute lg-static top-4 left-3 remove remove_from_wishlist" title="<?php echo esc_html( apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'yith-woocommerce-wishlist' ) ) ); ?>"></a>

                                </div>
							</div>
							<?php
						}
					}
				}
				else
				{
					?>
					<div class="text-base leading-2/2 p-3">
						<?php
						echo esc_html( apply_filters( 'yith_wcwl_no_product_to_remove_message', __( 'No products added to the wishlist', 'yith-woocommerce-wishlist' ), $wishlist ) );
						?>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</section>
