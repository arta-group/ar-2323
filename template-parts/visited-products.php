<?php
if ( isset( $_COOKIE[ 'woocommerce_recently_viewed' ] ) && ! empty( $_COOKIE[ 'woocommerce_recently_viewed' ] ) )
{
	?>
	<section class="py-6" dir="rtl">
		<div class="container mx-auto carousel-container">
			<div class="flex flex-row items-center mb-4/7 border-border border-b justify-between mx-2 md-mx-3 lg-mx-0">
				<div class="text-2/4 leading-3/8 text-gray-dark font-bold title pb-1/6">آخرین بازدیدهای شما</div>
				<ul class="custom-hidden-m lg-flex items-center justify-center">
					<li class="slick-prev-btn flex items-center justify-center text-xs w-2/4 h-2/4 rounded-xs bg-gray-100 ml-0/6 btn-effect">
						<div class="icon-angle-down transform -rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
					</li>
					<li class="slick-next-btn flex items-center justify-center text-xs w-2/4 h-2/4 bg-gray-100 btn-effect">
						<div class="icon-angle-down transform rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
					</li>
				</ul>
			</div>
			<div class="w-full relative slick-frame products-slider products-border">
				<?php
				global $woocommerce;

				$viewed_products = array_reverse( (array) explode( '|', $_COOKIE[ 'woocommerce_recently_viewed' ] ) );

				$args = array(
					'posts_per_page' => 12,
					'no_found_rows'  => 1,
					'post_status'    => 'publish',
					'post_type'      => 'product',
					'post__in'       => $viewed_products,
					'orderby'        => 'post__in'
				);

				$args[ 'meta_query' ][] = $woocommerce->query->stock_status_meta_query();

				$products = get_posts( $args );

				foreach ( $products as $product )
				{
					setup_postdata( $product );
					wc_get_template_part( 'content', 'product' );
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	</section>
	<?php
}
