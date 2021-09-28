<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
?>
<section class="flex container mx-auto lg-pt-3 lg-pb-10">
	<div class="w-296 lg-ml-3/3 fixed lg-static bottom-0 right-0 z-10 w-full overflow-auto lg-overflow-visible">
        <div class="relative w-full">
	        <?php do_action( 'woocommerce_account_navigation' ); ?>
        </div>
		
	</div>

	<div class="flex-1 content-container">
		<div class="c-content">
			<?php
			/**
			 * My Account content.
			 *
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_content' );
			?>
		</div>
	</div>
</section>
