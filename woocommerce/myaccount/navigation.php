<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) )
	exit;
?>
<ul class="flex flex-row lg-flex-col items-center bg-gray-50 pr-1 pl-8 lg-px-2/5 lg-divide-y lg-divide-border border border-border rounded-xs w-full overflow-auto lg-overflow-visible pt-1 lg-pt-0">
	<?php
	$menu_items = fs_arta_my_account_menu();
	foreach ( $menu_items as $endpoint => $values )
	{
		?>
		<li class="flex items-center justify-center lg-justify-start flex-shrink-0 min-w-8 lg-w-full <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
			<a class="flex flex-col lg-flex-row items-center account-tab" href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
				<div class="w-2 text-gray-dark leading-8 flex items-center <?php echo $values[ 'icon' ] . ' ' . $values[ 'class' ]; ?>"></div>
				<div class="block py-1 lg-py-1/5 text-sm lg-text-base lg-mr-2 text-gray-dark leading-2/2 flex-1">
					<?php echo $values[ 'label' ]; ?>
				</div>
			</a>
		</li>
		<?php
	}
	?>
    <li class="lg-hidden block h-full p-3 "></li>
</ul>
<div class="lg-hidden block absolute bottom-0 left-0 h-full w-8 menu-shade"></div>
