<?php
global $product;
$sale_price    = 0;
$regular_price = 0;
if ( $product->is_type( 'simple' ) )
{
	$sale_price    = $product->get_sale_price();
	$regular_price = $product->get_regular_price();
}
elseif ( $product->is_type( 'variable' ) )
{
	$sale_price    = $product->get_variation_sale_price( 'min', true );
	$regular_price = $product->get_variation_regular_price( 'max', true );
}
if ( $sale_price && $regular_price )
{
	$discount = abs( round( ( $sale_price / $regular_price - 1 ) * 100 ) );
	if ( $discount )
	{
		?>
		<div class="relative icon-product-off leading-1/9 text-xl">
			<div class="text-center text-white leading-1/9 text-sm absolute top-0 right-0 z-10 w-full font-black" dir="ltr">-٪<?php echo $discount; ?></div>
		</div>
		<?php
	}
}