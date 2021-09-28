<?php
$term_id = isset( $args[ 'term_id' ] ) ? $args[ 'term_id' ] : 0;
$term    = get_term( $term_id );

$args = array(
	'post_type'      => 'product',
	'post_status'    => 'publish',
	'posts_per_page' => - 1,
	'meta_query'     => [
		'relation' => 'AND',
		[
			'key'     => '_active_amazing_sale',
			'value'   => 'yes',
			'compare' => '='
		],
		[
			'key'     => '_stock_status',
			'value'   => 'instock',
			'compare' => '='
		]
	],
	'tax_query'      => [
		[
			'taxonomy' => 'product_brand',
			'field'    => 'term_id',
			'terms'    => $term_id,
			'operator' => 'IN'
		]
	]
);

$products = get_posts( $args );
?>
<section class="pt-6/3 " dir="rtl">
	<div class="container mx-auto carousel-container">
		<?php
		if ( $products )
		{
			?>
			<div class="flex flex-row items-center justify-between mb-4/7 border-b border-border mx-2 md-mx-3 lg-mx-0">
				<div class="text-lg lg-text-2/4 leading-2/4 lg-leading-3/8 pb-1/6 text-primary-main font-bold flex items-center title red">
					<div class="icon-discount flex items-center text-2/4 lg-text-3/4 ml-1/5"></div>
					فروش شگفت انگیز
				</div>
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
			<?php
		}
		wp_reset_postdata();

		if ( have_rows( 'brand-bottom-banners', $term ) )
		{
			?>
			<div class="grid grid-cols-1 lg-grid-cols-2 gap-2 lg-gap-3/2 mt-6/4 pb-0/3  px-2 md-px-3 lg-px-0">
				<?php
				while ( have_rows( 'brand-bottom-banners', $term ) )
				{
					the_row();
					$image = get_sub_field( 'image', $term );
					if ( $image )
					{
						?>
						<a href="<?php echo esc_url( get_sub_field( 'url', $term ) ); ?>" class="rounded-xs overflow-hidden h-12 lg-h-18">
							<img class="object-fit object-center w-full h-full" src="<?php echo esc_url( $image[ 'url' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>"/>
						</a>
						<?php
					}
				}
				?>
			</div>
			<?php
		}
		?>
	</div>
</section>