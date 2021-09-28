<?php
global $product;
?>
<h1 class="text-xl leading-3/2 font-bold"><?php echo get_the_title(); ?></h1>
<div class=" flex items-center space-x-reverse space-x-1/6 absolute lg-static bottom-0 -mb-5/5 lg-mb-0 left-0">
	<?php
	if ( defined( 'YITH_WOOCOMPARE' ) )
		echo do_shortcode( '[yith_compare_button]' );

	if ( defined( 'YITH_WCWL' ) )
		echo do_shortcode( '[yith_wcwl_add_to_wishlist icon="icon-heart" link_classes="w-4/2 rounded-full h-4/2 bg-secondary-main flex items-center justify-center pt-0/3 pl-0/1 text-1/7 leading-1/6 text-gray-700"]' );
	?>
</div>
