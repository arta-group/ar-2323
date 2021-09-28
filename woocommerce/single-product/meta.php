<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

global $product;

$brands = get_the_terms( $product->get_id(), 'product_brand' );

if ( $brands )
{
	?>
	<div class="flex items-center space-x-reverse space-x-0/5 ml-3/5 mb-1 lg-mb-0">
		<div class="text-base leading-2/2 text-gray-600 ">برند:</div>
		<?php
		foreach ( $brands as $brand )
		{
			$brand_link = get_term_link( $brand );
			?>
			<a href="<?php echo esc_url( $brand_link ); ?>" class="text-base text-primary-main border-b border-primary-main leading-2"><?php echo $brand->name; ?></a>
			<?php
		}
		?>
	</div>
	<?php
}
$cat = fs_get_the_primary_category( 'product_cat', $product->get_id() );
if ( $cat )
{
	?>
	<div class="flex items-center space-x-reverse space-x-0/5 mb-1 lg-mb-0">
		<div class="text-base leading-2/4 text-gray-600">دسته بندی:</div>
			<a href="<?php echo esc_url( $cat['url'] ); ?>" class="text-base text-primary-main border-b border-primary-main leading-2"><?php echo $cat['name']; ?></a>
	</div>
	<?php
}