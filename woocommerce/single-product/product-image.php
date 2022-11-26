<?php

/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) )
	return;

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
?>
<div class="flex px-2 md-px-3 lg-px-0 flex-col w-full w-405 carousel-container flex-shrink-0 <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="block w-405 h-40 rounded-xs woocommerce-product-gallery__wrapper">
		<?php
		if ( $product->get_image_id() )
			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		else
		{
			$html = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html = sprintf( '<img src="%s" alt="%s" class="object-fill object-center w-full h-full wp-post-image" />', esc_url( wc_placeholder_img_src( 'fs-product-main' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
	<?php
	if ( $product->get_gallery_image_ids() )
	{
		?>
		<div class="hide-on-mobile single-next custom-hidden-m lg-block absolute bottom-2 opacity-25 hover-opacity-100  left-0 border-l border-b border-r border-border rounded-b-xs bg-white p-0/5 -ml-3/1 text-sm leading-1/2 icon-angle-down transform rotate-90 -translate-y-1/2 cursor-pointer"></div>
		<div class="single-prev custom-hidden-m lg-block absolute bottom-2 opacity-25 hover-opacity-100 right-0 border-l border-b border-r border-border rounded-b-xs bg-white p-0/5 -mr-2/9 text-sm leading-1/2 icon-angle-down transform -rotate-90 -translate-y-1/2 cursor-pointer"></div>
		<?php
	}
	?>
</div>