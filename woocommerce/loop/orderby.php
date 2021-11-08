<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

$orders = [
	// 'menu_order' => 'پیش‌فرض',
	'date'       => 'جدیدترین',
	'popularity' => 'پرفروش‌ترین‌',
	'price'      => 'ارزان‌ترین',
	'price-desc' => 'گران‌ترین'
];

if (isset($_GET[ 'orderby' ])) {
    $order_by = $_GET[ 'orderby' ];
}else {
    $order_by = 'date';
}
?>
<form class="woocommerce-ordering" method="get">
	<div class="flex items-center w-full justify-center lg-justify-start">
		<div class="flex flex-row items-center bg-gray-100 rounded-xs px-1 pt-0/5 pb-0/5 lg-bg-white rounded-none lg-p-0" id="sorting-btn">
			<div class="inline-block icon-paper text-xl text-gray-main leading-2 h-2 ml-1/5"></div>
			<div class="text-base leading-2/2 text-gray-main font-normal lg-font-bold flex items-center"> مرتب سازی
				<span class="custom-hidden-m lg-block ml-0/3">بر اساس :</span>
			</div>
		</div>
		<div class="flex lg-hidden flex-row items-center bg-gray-100 rounded-xs px-1 pt-0/5 pb-0/5 lg-bg-white rounded-none lg-p-0 mr-0/8" id="toggle-filters-open">
			<div class="inline-block icon-paper text-xl text-gray-main leading-2 h-2 ml-1/5"></div>
			<div class="text-base leading-2/2 text-gray-main font-normal lg-font-bold flex items-center"> فیلتر محصولات</div>
		</div>
		<ul class="c-shop-sorting custom-hidden-m lg-flex items-center mr-1/5 space-x-reverse space-x-0/5 ">
			<?php
			foreach ( $orders as $key => $value )
			{
				?>
				<li class="cursor-pointer px-0/6 pt-0/1 pb-0/4 hover hover-bg-gray-100 rounded-xs text-base leading-2 text-gray-600<?php echo( $order_by == $key ? ' active' : '' ) ?>">
					<a href="?orderby=<?php echo $key; ?>">
						<?php echo $value; ?>
					</a>
				</li>
				<?php
			}
			?>
		</ul>
		<div class="custom-hidden lg-block fixed lg-static top-0 right-0 w-screen h-screen lg-h-auto z-55" id="sorting-container">
			<div class="relative w-full h-full">
				<div class="absolute top-0 left-0 w-full h-full z-10 sorting-overlay" id="sorting-overlay"></div>
				<div class="p-2 absolute z-20 top-half left-half bg-white transform -translate-x-1/2 -translate-y-1/2 rounded-xs">
					<div class="flex flex-row items-center border-b border-border pb-1/3">
						<div class="inline-block icon-paper text-xl text-gray-main leading-2 h-2 ml-1/5"></div>
						<div class="text-base leading-2/2 text-gray-main font-normal lg-font-bold flex items-center"> مرتب سازی بر اساس :</div>
					</div>
					<ul class="c-shop-sorting flex flex-col items-start rounded-xs divide-y-1 divide-gray-200 ">
						<?php
						foreach ( $orders as $key => $value )
						{
							?>
							<li class="cursor-pointer px-0/6 py-1 hover w-20  hover-bg-gray-100 text-base leading-2 text-gray-600<?php echo( $order_by == $key ? ' active' : '' ) ?>">
								<a href="?orderby=<?php echo $key; ?>" class="ordering-item"">
								<?php echo $value; ?>
								</a>
							</li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</form>