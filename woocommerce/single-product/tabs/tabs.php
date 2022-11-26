<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$product_tabs = [
	'description'            => [
		'title'    => 'توضیحات',
		'callback' => 'woocommerce_product_description_tab'
	],
	'additional_information' => [
		'title'    => 'مشخصات محصول',
		'callback' => 'woocommerce_product_additional_information_tab'
	],
	'reviews'                => [
		'title'    => 'دیدگاه کاربران',
		'callback' => 'comments_template'
	]
];

if ( empty( trim( strip_tags( get_the_content() ) ) ) ) {
	unset( $product_tabs['description'] );
}
?>
<section class="py-6 bg-gray-100 px-2 md-px-3 lg-px-0">
    <div class="mx-auto container">
        <div class="bg-white rounded-xs pt-0/7 lg-pt-2 w-full content-wrapper">
            <div class="flex items-center justify-center border-b border-border">
                <div style="flex-direction: column;padding-left: 10px;padding-right: 10px;"
                     class="flex direction justify-center c-tabs single pb-md-3">
					<?php
					$iteration = 1;
					foreach ( $product_tabs as $key => $product_tab ) {
						if ( isset( $product_tab['title'] ) ) {
							if ( $product_tab['title'] != 'مشخصات محصول' ) {
								?>
                                <h3 style="width: fit-content;"
                                    class="title lg-mr-3/2 ml-3 lg-ml-6/4 text-base md-text-lg leading-5/4 lg-leading-6 font-bold cursor-pointer">
									<?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); ?>
                                </h3>
								<?php
							}
							?>
                            <div class="c-tab-container pb-2 lg-pb-4 lg-px-4/5">
                                <div class="c-tab-content single-product-content active"
                                     data-id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel"
                                     aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
									<?php
									if ( isset( $product_tab['callback'] ) ) {
										call_user_func( $product_tab['callback'], $key, $product_tab );
									}
									?>
                                </div>
                            </div>
							<?php
						}
					}
					?>
                </div>
            </div>
			<?php do_action( 'woocommerce_product_after_tabs' ); ?>
        </div>
    </div>
</section>
