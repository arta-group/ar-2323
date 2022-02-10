<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
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
defined('ABSPATH') || exit;

do_action('woocommerce_before_cart');
?>
<section class="flex flex-col lg-flex-row pt-3 container mx-auto px-1 md-px-3 lg-px-0">
    <div class="w-full lg-w-auto lg-flex-1 mb-4">

        <form id="cart-form" class="woocommerce-cart-form border border-border rounded-xs overflow-hidden"
              action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            <?php do_action('woocommerce_before_cart_table'); ?>

            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
                <div class="bg-gray-50 py-1/8 border-b border-border custom-hidden-m lg-flex flex-row items-center justify-between xl-px-15 lg-pl-10 lg-pr-15">
                    <div class="text-base text-gray-500 leading-2/2 font-bold"> عنوان محصول</div>
                    <div class="text-base text-gray-500 leading-2/2 font-bold pr-6">قیمت</div>
                    <div class="text-base text-gray-500 leading-2/2 font-bold pr-2">تعداد</div>
                    <div class="text-base text-gray-500 leading-2/2 font-bold pl-2">مجموع</div>
                </div>
                <div class="flex flex-col divide-y divide-border">
                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                        ?>
                        <div class="woocommerce-cart-form__cart-item px-1/5 lg-px-3 py-2/9 flex flex-col lg-flex-row lg-items-center relative <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                            <div class=" w-full lg-w-28 flex items-center mb-2 lg-mb-0">
                                <div class="product-thumbnail w-8/4 h-8/2 border border-border rounded-xs overflow-hidden flex-shrink-0 ml-1/5 lg-ml-3/3">
                                    <?php
                                    if (has_post_thumbnail($product_id)) {
                                        $attachment_id = get_post_thumbnail_id($product_id);
                                        echo wp_get_attachment_image($attachment_id, 'fs-product-thumbnail', false, array('class' => 'w-full h-full object-center rounded-xs'));
                                    } else
                                        echo wc_placeholder_img('fs-product-thumbnail', array('class' => 'w-full h-full object-center rounded-xs'));
                                    ?>
                                </div>
                                <div class="product-name text-base leading-2/2 text-gray-dark w-16">
                                    <?php
                                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

                                    if (!$product_permalink)
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                    else
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));

                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                    if (get_post_meta($cart_item['product_id'], '_add_shipping', true) != null) {
                                        $extra = ((int)$cart_item['quantity'] * (int)get_post_meta($cart_item['product_id'], '_shapping_cost', true));
                                        echo '<span class="text-1/2 text-sbase text-gray-400 leading-2 mb-3 block ">(اضافه بار ارسال ' . wc_price($extra) . ' تومان)</span>';
                                    }

                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                    // Backorder notification.
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity']))
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                    ?>
                                </div>
                            </div>

                            <div class="flex lg-w-40 lg-pr-7 lg-pl-7 flex-row items-center justify-between flex-1 mb-2 lg-mb-0">

                                <div class="product-price text-lg leading-2/8 font-bold text-gray-dark">
									<span class="ml-0/3 inline-block"><?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                        ?></span>
                                    <span class="text-base leading-2/2 font-normal inline-block">تومان</span>
                                </div>
                                <div class="quantity input-quantity product-quantity flex w-8 h-5 items-center justify-between rounded-xs cart-quantity">
                                    <?php
                                    if ($_product->is_sold_individually())
                                        $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                    else {
                                        $product_quantity = woocommerce_quantity_input(array(
                                            'input_name' => "cart[{$cart_item_key}][qty]",
                                            'input_value' => $cart_item['quantity'],
                                            'max_value' => $_product->get_max_purchase_quantity(),
                                            'min_value' => '0',
                                            'product_name' => $_product->get_name(),
                                        ), $_product, false);
                                    }

                                    echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                    ?>
                                </div>
                            </div>

                            <div class="flex lg-w-21 items-center justify-between">
                                <div class="text-lg font-bold text-gray-dark">
                                    <span class="lg-hidden">مجموع :</span>
                                    <span class="ml-0/3 leading-2/8 inline-block"><?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?></span>
                                    <span class="text-base leading-2/2 font-normal inline-block">تومان</span>
                                </div>
                                <div class="product-remove">
                                    <?php
                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="remove flex items-center icon-close-alt text-primary-main text-2/4 leading-2/4 absolute lg-static top-2 left-2" aria-label="%s" data-product_id="%s" data-product_sku="%s"></a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            esc_html__('Remove this item', 'woocommerce'),
                                            esc_attr($product_id),
                                            esc_attr($_product->get_sku())
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
            </table>

            <?php do_action('woocommerce_after_cart_table'); ?>
            <?php do_action('woocommerce_cart_contents'); ?>
            <div class="actions"
            ">

            <button type="submit" form="cart-form" value="به روز رسانی" class="button hidden"
                    name="update_cart"></button>

            <?php do_action('woocommerce_cart_actions'); ?>

            <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>

    </div>
    <?php do_action('woocommerce_after_cart_contents'); ?>
    </form>

    <div class="flex flex-row items-center justify-between mt-3/2">
        <button type="submit" form="cart-form" value="خالی کردن" name="clear-cart"
                class="flex btn-effect items-center px-1/5 md-px-3  py-0/8 md-py-1  bg-primary-main text-white rounded-xs">
            <span class="flex items-center lg-ml-1 w-2 icon-trash test-medium md-text-lg"></span>
            <span class="text-sm md-text-medium leading-2/5">خالی کردن</span>
        </button>
    </div>
    <?php woocommerce_cross_sell_display(); ?>
    </div>
    <?php do_action('woocommerce_cart_collaterals'); ?>
</section>

<?php
$products = get_option('my_theme_carousel_cart_down_on_sales_section');
if ($products) {
?>
<section class="py-1" dir="rtl">
    <div class="container mx-auto carousel-container">
        <div class="flex flex-row items-center mb-4/7 border-border border-b justify-between mx-2 md-mx-3 lg-mx-0">
            <div class="text-lg lg-text-2/4 leading-2/4 lg-leading-3/8 text-gray-dark font-bold title pb-1/6">شگفت
                انگیزها
            </div>
            <ul class="custom-hidden-m lg-flex items-center justify-center">
                <li class="slick-prev-btn flex items-center justify-center text-xs w-2/4 h-2/4 rounded-xs bg-gray-100 ml-0/6">
                    <div class="icon-angle-down transform -rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
                </li>
                <li class="slick-next-btn flex items-center justify-center text-xs w-2/4 h-2/4 bg-gray-100">
                    <div class="icon-angle-down transform rotate-90 scale-90 flex items-center justify-center w-0/5"></div>
                </li>
            </ul>
        </div>
        <div class="w-full relative slick-frame products-slider products-border">
            <?php

            foreach ($products as $product) {
                setup_postdata($product);
                wc_get_template_part('content', 'product');
            }

            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
<?php } ?>