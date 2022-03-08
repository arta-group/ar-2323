<?php
$term_id = isset( $args[ 'term_id' ] ) ? $args[ 'term_id' ] : 0;

$args = [
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'posts_per_page' => 12,
	'meta_key'       => 'total_sales',
	'orderby'        => 'stock_status',
	'tax_query'      => [
		[
			'taxonomy' => 'product_brand',
			'field'    => 'term_id',
			'terms'    => $term_id,
			'operator' => 'IN'
		]
	]
];

$products = get_posts( $args );

if ( $products )
{
	?>
	<section class="pt-5/7 pb-10" dir="rtl">
		<div class="container mx-auto carousel-container">
			<div class="flex flex-row items-center mb-4/7 border-border border-b justify-between mx-2 md-mx-3 lg-mx-0">
				<div class="text-lg lg-text-2/4 leading-2/4 lg-leading-3/8 text-gray-dark font-bold title pb-1/6">پرفروش ترین محصولات</div>
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
				foreach ( $products as $product )
				{
					setup_postdata( $product );
					wc_get_template_part( 'content', 'product' );
				}
				?>
			</div>
		</div>
	</section>
	<?php
}
wp_reset_postdata();