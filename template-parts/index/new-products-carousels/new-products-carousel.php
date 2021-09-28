<div class="w-full carousel-container" dir="rtl">

	<div class="flex flex-row items-center justify-between mb-4/6 border-border border-b mx-2 md-mx-3 lg-mx-0">
		<div class="text-lg lg-text-2/4 leading-2/4 lg-leading-3/8 text-gray-dark font-bold pb-1/6 title">جدیدترین محصولات</div>
		<ul class="lg-flex items-center justify-center custom-hidden-m ">
			<li class="slick-prev-btn flex items-center justify-center text-xs w-2/4 h-2/4 rounded-xs bg-gray-100 ml-0/6">
				<div class="icon-angle-down transform -rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
			</li>
			<li class="slick-next-btn flex items-center justify-center text-xs w-2/4 h-2/4 bg-gray-100">
				<div class="icon-angle-down transform rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
			</li>
		</ul>
	</div>

	<div class="new-product-1 w-full relative slick-frame">
		<?php
		$args = array(
			'orderby'    => 'ID',
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
	</div>

</div>
