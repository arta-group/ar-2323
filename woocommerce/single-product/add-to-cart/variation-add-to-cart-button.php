<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
?>
<div class="flex items-center mt-2 woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );
	?>
    <!--<div class="input-quantity flex-shrink-0 flex items-center border border-border text-2/4 leading-3/8 rounded-xs py-0/6 px-1 font-bold ml-2">-->
		<?php
		woocommerce_quantity_input( array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST[ 'quantity' ] ) ? wc_stock_amount( wp_unslash( $_POST[ 'quantity' ] ) ) : $product->get_min_purchase_quantity(),
			// WPCS: CSRF ok, input var ok.
		) );
		?>
    <!--</div>-->
	<?php
	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>

	<button type="submit" class="single_add_to_cart_button w-full lg-w-auto py-1/1 px-2/8 rounded-xs bg-primary-main text-white text-lg leading-2/8 font-bold"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>"/>
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>"/>
	<input type="hidden" name="variation_id" class="variation_id" value="0"/>
</div>
