<?php
if ( ! defined( 'ABSPATH' ) )
	exit;
?>
	<div class="border-b-2 border-border mb-4/4">
		<h2 class="text-2/4 inline-block leading-3/8 pb-1/6 title text-gray-main">
			لیست خرید</h2>
	</div>
<?php
if ( defined( 'YITH_WCWL' ) )
	echo do_shortcode( '[yith_wcwl_wishlist]' );
