<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

if ( $product_attributes )
{
	?>
	<div class="border-b border-border flex items-center">
		<h2 class="lg-text-1/8 text-1/4 inline-block text-center md-text-right leading-2/8 pb-1/9 title text-gray-main font-bold flex items-center">
			<span class="icon-filter text-xl text-primary-main inline-block ml-1/8 inline-block leading-2 h-2"></span> ویژگی های فنی
		</h2>
	</div>
	<div class="flex flex-col divide-border divide-y mt-1/5">
		<?php
		foreach ( $product_attributes as $product_attribute_key => $product_attribute )
		{
			?>
			<div class="flex items-center text-sm lg-text-base pt-1/7 pb-1/3">
				<div class="w-13 lg-w-20 flex-shrink-0 font-bold text-gray-main"><?php echo wp_kses_post( $product_attribute[ 'label' ] ); ?></div>
				<div class="flex-1 text-gray-600"><?php echo wp_kses_post( $product_attribute[ 'value' ] ); ?></div>
			</div>
			<?php
		}
		?>
	</div>
	<?php
}