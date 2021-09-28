<?php
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
	]
);

$products = get_posts( $args );

if ( $products )
{
	?>
	<div class="amazing-sales-list carousel-container w-full mt-6" dir="rtl">
		<div class="flex flex-row items-center justify-between mb-3/3 border-b border-border mx-2 md-mx-3 lg-mx-0">
			<div class="text-lg lg-text-2/4 leading-2/4 lg-leading-3/8 text-primary-main font-bold flex items-center title red pb-1/6">
				<div class="icon-discount flex items-center text-2/4 lg-text-3/4 ml-1/5 "></div>
				فروش شگفت انگیز
			</div>
			<ul class="flex items-center justify-center">
				<li class="slick-prev-btn flex items-center justify-center text-xs w-2/4 h-2/4 rounded-xs bg-gray-100 ml-0/6">
					<div class="icon-angle-down transform -rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
				</li>
				<li class="slick-next-btn flex items-center justify-center text-xs w-2/4 h-2/4 bg-gray-100">
					<div class="icon-angle-down transform rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
				</li>
			</ul>
		</div>
		<div class="new-product-2 w-full slick-frame relative">
			<?php
			foreach ( $products as $product )
			{
				setup_postdata( $product );
				global $product;
				?>
				<div class="w-46 h-34 lg-h-32 lg-w-auto lg-px-1/6 discount-carousel">
					<div class="flex flex-col lg-flex-row pr-2 pl-2 lg-pl-4 pt-3/3 pb-3/9 lg-pb-3/4 border border-border rounded-xs relative ">
						<div class="flex flex-col">
							<a href="<?php echo $product->get_permalink(); ?>" class="flex items-center justify-center w-18 h-18 h-185 mx-auto">
								<?php
								$attachment_id = has_post_thumbnail( $product->id ) ? get_post_thumbnail_id( $product->id ) : $product->get_gallery_attachment_ids()[ 0 ];
								echo $attachment_id ? wp_get_attachment_image( $attachment_id, 'fs-product-card', false, array( 'class' => 'object-fit object-center' ) ) : wc_placeholder_img( 'fs-product-card' );

								$end_date = get_post_meta( $product->get_id(), '_amazing_sale_end_date', true );
								?>
							</a>
							<div data-amazing-end-date="<?php echo esc_attr( $end_date ); ?>" class="amazing-product lg-bg-primary-main -mt-3/5 lg-mt-2/7 flex items-center text-sm lg-text-lg leading-1/4 lg-leading-2/8 text-primary-main lg-text-white pt-0/9 pb-0/8 px-1/5 lg-w-17 rounded-xs mx-auto absolute lg-static top-full left-0">
								<div class="text-medium leading-1/6 lg-text-xl icon-clock lg-leading-2 text-primary-main lg-text-white mr-0/6 flex align-items-center"></div>
							</div>
						</div>
						<?php $prices = fs_get_product_prices( $product ); ?>
						<div class="flex flex-col justify-between">
							<div class="flex flex-col ">
								<?php
								if ( $product->is_on_sale() )
								{
									?>
									<div class="bg-primary-main px-1 mb-1/1 mr-auto rounded-xs">
										<span class="leading-2 lg-leading-3/2 text-white text-sm lg-text-1/8 ml-0/4 lg-ml-0/9 amazing-discount"><?php echo $prices[ 'discount' ]; ?>%</span>
										<span class="leading-2 lg-leading-3/2 text-white text-sm lg-text-1/8">تخفیف</span>
									</div>
									<?php
								}
								?>
								<div class="lg-mb-1/1 text-sm leading-2 text-primary-main "><?php echo $product->get_categories(); ?></div>
								<div class="text-1/4 lg-text-1/8 leading-2/8 text-gray-dark font-bold">
									<a href="<?php echo $product->get_permalink(); ?>"><?php echo $product->get_title(); ?></a>
								</div>
							</div>
							<div class="flex flex-col items-end justify-center">
								<?php
								if ( $product->is_on_sale() )
								{
									?>
									<div class="text-1/4 lg-text-1/8 leading-1/8 lg-leading-2/8 text-gray-300 line-through mb-0/6 flex items-center"><?php echo sprintf( '%s تومان', wc_price( $prices[ 'regular_price' ] ) ); ?></div>
									<?php
								}
								?>
								<div class="text-1/8 lg-text-2/4 leading-2/4 lg-leading-3/8 text-primary-main font-bold"><?php echo sprintf( '%s تومان', wc_price( $prices[ 'price' ] ) ); ?></div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}
wp_reset_postdata();
