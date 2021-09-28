<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) )
{
	exit; // Exit if accessed directly.
}

global $product;

if ( ! wc_review_ratings_enabled() )
{
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = ceil( $product->get_average_rating() );
?>
<ul class="flex items-center space-x-reverse space-x-0/5 text-gray-400">
	<?php
	echo str_repeat( '<li class="icon-empty-star leading-1/4 text-1/4"></li>', 5 - $average );
	echo str_repeat( '<li class="icon-filled-star leading-1/4 text-1/4 text-secondary-main"></li>', $average );
	?>
</ul>
<div class="text-1/3 mr-1/5 text-gray-500 leading-2">
	<span class="inline-block">دیدگاه کاربران</span> <span class="inline-block">(<?php echo $review_count; ?>)</span>
</div>