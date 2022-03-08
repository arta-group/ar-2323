<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

global $product;

if ( empty( $product ) || ! $product->exists() )
	return;

$cat = fs_get_the_primary_category();

if ( isset( $cat[ 'id' ] ) )
{
	$args = apply_filters( 'woocommerce_related_products_args', array(
		'post_type'           => 'product',
		'post__not_in'        => [ $product->get_id() ],
		'ignore_sticky_posts' => 1,
		'post_status'         => 'publish',
		'no_found_rows'       => 1,
		'posts_per_page'      => 12,
		'tax_query'           => array(
			array(
				'taxonomy' => 'product_cat',
				'field'    => 'id',
				'terms'    => $cat[ 'id' ],
				'compare'  => '='
			)
		),
		'meta_query'          => array(
			array(
				'key'   => '_stock_status',
				'value' => 'instock'
			),
			array(
				'key'   => '_backorders',
				'value' => 'no'
			)
		)
	) );

	$products = new WP_Query( $args );

	if ( $products->have_posts() )
	{
		?>
		<section class="pt-3 " dir="rtl">
			<div class="container mx-auto carousel-container">
				<div class="flex flex-row items-center mb-4/7 border-border border-b justify-between mx-2 md-mx-3 lg-mx-0">
					<div class="text-2/4 leading-3/8 text-gray-dark font-bold title pb-1/6">محصولات مشابه</div>
					<ul class="custom-hidden-m lg-flex items-center justify-center">
						<li class="slick-prev-btn flex items-center justify-center text-xs w-2/4 h-2/4 rounded-xs bg-gray-100 ml-0/6">
							<div class="icon-angle-down transform -rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
						</li>
						<li class="slick-next-btn flex items-center justify-center text-xs w-2/4 h-2/4 bg-gray-100">
							<div class="icon-angle-down transform rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
						</li>
					</ul>
				</div>
				<div class="w-full relative products-slider products-border">
					<?php
					while ( $products->have_posts() )
					{
						$products->the_post();
						wc_get_template_part( 'content', 'product' );
					}
					?>
				</div>
			</div>
		</section>
		<?php
	}
	wp_reset_postdata();
}
