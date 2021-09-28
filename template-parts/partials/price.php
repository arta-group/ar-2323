<?php
global $product;
$price         = 0;
$regular_price = 0;

if ( $product->is_type( 'simple' ) )
{
	$price         = $product->get_price();
	$regular_price = $product->get_regular_price();
}
elseif ( $product->is_type( 'variable' ) )
{
	//	if ( $product->is_on_sale() )
	//	{
	//		$regular_price_min = $product->get_variation_regular_price( 'min', true );
	//		$regular_price_max = $product->get_variation_regular_price( 'max', true );
	//
	//		$active_price_min = $product->get_variation_price( 'min', true );
	//		$active_price_max = $product->get_variation_price( 'max', true );
	//
	//		if ( $regular_price_min !== $active_price_min || $regular_price_max !== $active_price_max )
	//		{
	//			if ( $regular_price_min !== $regular_price_max )
	//			{
	//				$regular_price = sprintf( '<del>%s a %s</del>', wc_price( $regular_price_min ), wc_price( $regular_price_max ) );
	//			}
	//			else
	//			{
	//				$regular_price = sprintf( '<del>%s</del>', wc_price( $regular_price_min ) );
	//			}
	//
	//			if ( $active_price_min !== $active_price_max )
	//			{
	//				$price = sprintf( '<ins>%s a %s</ins>', wc_price( $active_price_min ), wc_price( $active_price_max ) );
	//			}
	//			else
	//			{
	//				$price = sprintf( '<ins>%s</ins>', wc_price( $active_price_min ) );
	//			}
	//
	//			$price = sprintf( '<p class="teste">%s %s</p>', $regular_price, $price );
	//		}
	//	}
	//	else
	//	{
	$price         = $product->get_variation_price( 'max', true );
	$regular_price = $product->get_variation_price( 'min', true );
	//	}
}

if ( $price > 0 )
{
	if ( $product->is_on_sale() )
	{
		?>
		<div class="discounted_price text-base leading-2/2 text-gray-300 text-center line-through">
			<?php echo is_numeric( $regular_price ) ? wc_price( $regular_price ) : $regular_price; ?>
			تومان
		</div>
		<?php
	}
	?>
	<div class="text-sm leading-2/8 text-gray-600 text-center font-bold">
		<span class="text-lg text-gray-dark ml-0/3"><?php echo is_numeric( $price ) ? wc_price( $price ) : $price; ?>
		تومان</span>
	</div>
	<?php
}
else
{
	?>
	<div class="text-sm leading-11 text-gray-600 text-center font-bold">بدون قیمت</div>
	<?php
}
