<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">

		<?php
		do_action( 'woocommerce_before_variations_form' );
		?>

		<?php
		if ( empty( $available_variations ) && $available_variations !== false )
		{
			$status = sprintf( '<a href="%s">%s</a>', site_url( 'contact' ), 'تماس بگیرید' );
			if ( ! $product->is_in_stock() )
				$status = 'ناموجود';
			?>
			<div class="text-3 font-bold text-primary-main leading-4/7 ml-3">
				<span class="text-2/4"><?php echo $status; ?></span>
			</div>
			<?php
		}
		else
		{
			$min_price     = 0;
			$min_price_key = ''; ?>
			<div class="flex flex-col lg-flex-row items-center">
				<?php
				foreach ( $attributes as $attribute_name => $options )
				{
					$terms = wc_get_product_terms( $product->get_id(), $attribute_name, [ 'fields' => 'all' ] );

					foreach ( $terms as $term )
					{
						if ( in_array( $term->slug, $options ) )
						{
							foreach ( $available_variations as $variation )
							{
								if ( $variation[ 'attributes' ][ 'attribute_' . strtolower( urlencode( $attribute_name ) ) ] == $term->slug )
								{
									if ( $variation[ 'is_in_stock' ] && ( $variation[ 'display_price' ] < $min_price || $min_price == 0 ) )
									{
										$min_price     = $variation[ 'display_price' ];
										$min_price_key = $term->slug;
									}
								}
							}
						}
					}
					?>

					<div class="variations flex items-center mb-1/4">
						<div class="text-base text-gray-600 ml-1/5 label"><?php echo wc_attribute_label( $attribute_name ); ?></div>
						<div class="w-17 single-product value">
							<?php
							$args = [
								'options'   => $options,
								'attribute' => $attribute_name,
								'product'   => $product,
								'class'     => 'select'
							];

							if ( $min_price_key )
							{
								$array_key          = array_search( $min_price_key, $options );
								$args[ 'selected' ] = $options[ $array_key ];
							}

							wc_dropdown_variation_attribute_options( $args );

							// echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
							?>
						</div>
					</div>
					<?php
				}
				?>
			</div>			<!--			<div class="single_variation_wrap">-->
			<div class="flex items-end single_variation relative"></div>
			<?php
			/**
			 * Hook: woocommerce_before_single_variation.
			 */
			do_action( 'woocommerce_before_single_variation' );

			/**
			 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
			 *
			 * @since 2.4.0
			 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
			 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
			 */
			woocommerce_single_variation_add_to_cart_button();

			//			do_action( 'woocommerce_single_variation_add_to_cart_button' );

			/**
			 * Hook: woocommerce_after_single_variation.
			 */
			do_action( 'woocommerce_after_single_variation' );
			?>
			<!--			</div>-->
		<?php } ?>

		<?php do_action( 'woocommerce_after_variations_form' ); ?>
	</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );