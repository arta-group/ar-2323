<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */
defined( 'ABSPATH' ) || exit;
?>
<div class="mini-cart-content">
	<div class="fixed top-0 left-0 h-screen w-screen z-45 transform scale-0 opacity-0 ease-linear bg-gray-dark opacity-50 duration-100" style="transition: opacity 100ms;" id="cart_overlay"></div>
	<div class="fixed cart top-0 left-0 h-screen overflow-y-auto w-10/12vw md-w-40 bg-white z-50 px-1 md-pl-3 md-pr-3/5 py-3 transform -translate-x-44 transition-transform ease-linear duration-150" id="cart-container">
		<?php
		if ( is_object( WC()->cart ) && ! WC()->cart->is_empty() )
		{
			?>
			<div class="w-full flex flex-col">
				<div class="flex flex-row items-center justify-between w-full border-b border-border pb-1/6">
					<div class="text-lg leading-2/8 text-gray-dark">سبد خرید</div>
					<form method="post">
						<button type="submit" name="clear-cart" class="flex w-3 h-3 icon-trash bg-primary-main text-white rounded-xs text-sm flex-col items-center justify-center cursor-pointer"></button>
					</form>
				</div>
				<ul class="flex flex-col divide-y divide-border">
					<?php
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item )
					{
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item[ 'data' ], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item[ 'product_id' ], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item[ 'quantity' ] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) )
						{
							$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
							$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
							<li class="py-3 flex flex-row justify-between">
								<div class="w-10 h-10 rounded-xs border border-border">
									<?php
									if ( has_post_thumbnail( $product_id ) )
									{
										$attachment_id = get_post_thumbnail_id( $product_id );
										echo wp_get_attachment_image( $attachment_id, 'fs-product-thumbnail', false, array( 'class' => 'object-fit object-center w-full h-full rounded-xs' ) );
									}
									else
										echo wc_placeholder_img( 'fs-product-thumbnail', array( 'class' => 'object-fit object-center w-full h-full rounded-xs' ) );
									?>
								</div>
								<div class=" flex flex-col justify-between h-10 w-17 pr-1 minicart-info">
									<div class="text-base leading-2 text-gray-main name"><?php echo $product_name ?></div>
									<?php
									if ( get_post_meta( $product_id, '_add_shipping', true ) != null )
									{
										$extra = ( (int)$cart_item[ 'quantity' ] * (int)get_post_meta( $product_id, '_shapping_cost', true ) );
										echo '<span class="text-1/2 text-sbase text-gray-400 leading-2 mb-3 block">(اضافه بار ارسال ' . wc_price( $extra ) . ' تومان)</span>';
									}
									?>
									<div class="flex items-center">
										<div class="text-base md-text-lg leading-2 text-gray-500 ml-1">X
											<span><?php echo $cart_item[ 'quantity' ] ?></span>
										</div>
										<div class="text-base md-text-lg leading-2 text-gray-main font-bold"> <?php echo $product_price ?>
											<span class="font-normal text-base"> تومان</span>
										</div>
									</div>
								</div>
								<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="flex flex-col items-center justify-start cursor-pointer icon-close-alt text-medium text-primary-main" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Remove this item', 'woocommerce' ), esc_attr( $product_id ), esc_attr( $cart_item_key ), esc_attr( $_product->get_sku() ) ), $cart_item_key );
								?>
							</li>
							<?php
						}
					}
					?>
				</ul>
			</div>
			<div class="flex flex-col">
				<div class="w-full rounded-xs mb-2 bg-gray-50 flex items-center px-2 justify-between text-gray-main pt-0/7 pb-0/8">
					<div class="leading-2/2 text-base">مجموع سبد خرید:</div>
					<div class="leading-2/8 text-lg font-bold"><?php echo wc_price( WC()->cart->get_cart_contents_total() ); ?>
						<span class="mr-0/5 font-normal text-base">تومان</span>
					</div>
				</div>
				<a href="<?php echo esc_url( site_url( 'cart' ) ); ?>" class="w-full rounded-xs mb-1/7 leading-2/2 py-1/1 bg-gray-300 text-base text-center text-gray-main cursor-pointer">مشاهده سبد خرید </a>
				<a href="<?php echo esc_url( site_url( 'checkout' ) ); ?>" class="w-full rounded-xs leading-282 pt-0/9 pb-0/8 bg-secondary-main text-center text-lg text-gray-main cursor-pointer">تسویه حساب </a>
			</div>
			<?php
		}
		else
		{
			?>
			<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>
			<?php
		}
		?>
	</div>
</div>