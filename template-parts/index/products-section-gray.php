<?php
$params   = wp_parse_args( $args, [ 'products_category' => 0 ] );
$category = get_term_by( 'id', $params[ 'products_category' ], 'product_cat' );
?>
<section class="py-5 bg-gray-100 mb-6/5" dir="rtl">
	<div class="container mx-auto carousel-container">

		<div class="flex flex-row items-center mb-2/5 border-b border-border justify-between mx-2 md-mx-3 lg-mx-0">
			<div class="text-lg lg-text-2/4 leading-2/4 lg-leading-3/8 text-gray-dark font-bold pb-1 title">انواع <?php echo $category->name; ?></div>
			<ul class="custom-hidden-m lg-flex items-center justify-center">
				<li class="slick-prev-btn flex items-center justify-center text-xs w-2/4 h-2/4 rounded-xs bg-border ml-0/6">
					<div class="icon-angle-down transform -rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
				</li>
				<li class="slick-next-btn flex items-center justify-center text-xs w-2/4 h-2/4 bg-border">
					<div class="icon-angle-down transform rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
				</li>
			</ul>
		</div>

		<div class="w-full relative slick-frame products-slider products-border product-lamps lg-py-2 bg-white rounded-xs">
			<?php
			$args = array(
				'category'   => array( $category->slug ),
				'orderby'    => 'name',
				'status'     => 'publish',
				'limit'      => 12,
				'meta_key'   => '_stock_status',
				'meta_value' => 'instock'
			);

			$products = wc_get_products( $args );

			foreach ( $products as $product )
			{
				$post_object = get_post( $product->get_id() );
				setup_postdata( $GLOBALS[ 'post' ] =& $post_object );
				wc_get_template_part( 'content', 'product' );
			}
			?>
			<?php  carousel_category_card ( $category ); ?>
		</div>

	</div>
</section>
