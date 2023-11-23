<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order_id); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if (!$order) {
    return;
}

$order_items = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads = $order->get_downloadable_items();
$show_downloads = $order->has_downloadable_item() && $order->is_download_permitted();

if ($show_downloads) {
    wc_get_template(
        'order/order-downloads.php',
        array(
            'downloads' => $downloads,
            'show_title' => true,
        )
    );
}
?>
    <section class="woocommerce-order-details">
        <?php do_action('woocommerce_order_details_before_order_table', $order); ?>

        <h2 class="woocommerce-order-details__title"><?php esc_html_e('Order details', 'woocommerce'); ?></h2>

        <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

            <thead>
            <tr>
                <th class="woocommerce-table__product-name product-name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
                <th class="woocommerce-table__product-table product-total"><?php esc_html_e('Total', 'woocommerce'); ?></th>
            </tr>
            </thead>

            <tbody>
            <?php
            do_action('woocommerce_order_details_before_order_table_items', $order);

            foreach ($order_items as $item_id => $item) {
                $product = $item->get_product();

                wc_get_template(
                    'order/order-details-item.php',
                    array(
                        'order' => $order,
                        'item_id' => $item_id,
                        'item' => $item,
                        'show_purchase_note' => $show_purchase_note,
                        'purchase_note' => $product ? $product->get_purchase_note() : '',
                        'product' => $product,
                    )
                );
            }

            do_action('woocommerce_order_details_after_order_table_items', $order);
            ?>
            </tbody>

            <tfoot>
            <?php
            foreach ($order->get_order_item_totals() as $key => $total) {
                ?>
                <tr>
                    <th scope="row"><?php echo esc_html($total['label']); ?></th>
                    <td><?php echo ('payment_method' === $key) ? esc_html($total['value']) : wp_kses_post($total['value']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
                </tr>
                <?php
            }
            ?>
            <?php if ($order->get_customer_note()) : ?>
                <tr>
                    <th><?php esc_html_e('Note:', 'woocommerce'); ?></th>
                    <td><?php echo wp_kses_post(nl2br(wptexturize($order->get_customer_note()))); ?></td>
                </tr>
            <?php endif; ?>
            </tfoot>
        </table>

        <?php do_action('woocommerce_order_details_after_order_table', $order); ?>

    </section>

    <div class="order-status-height" style="height: 280px;">
        <div class="slide_frame" style="padding-bottom: 50px !important; text-align: center; background-color: #f2f2f2; border: 3px solid #fed100; border-radius: 8px;">
            <div class="slide_up_columns">
                <div class="wp-block-columns slide_columns with400" style="align-items: flex-start;">
                    <div class="wp-block-column arrow_before">
                        <div class="wa_num amount"><bdi>1</bdi></div>
                        <div class="" style="display: flex; flex-direction: column; align-items: center;">
                            <img src="<?php if ($order->get_status() == 'processing' || $order->get_status() == 'completed') {
                                echo '/wp-content/uploads/2021/11/1.png';
                            } else {
                                echo '/wp-content/uploads/2021/11/2.png';
                            }; ?>"
                                 class="object-fit object-center w-8 h-8 litespeed-loaded">
                            <div class="text-base lg-text-medium font-bold mt-2/5 leading-2/5 text-gray-700 text-center">
                                ثبت شده
                            </div>
                        </div>
                    </div>
                    <div class="wp-block-column arrow_before">
                        <div class="wa_num amount"><bdi>2</bdi></div>
                        <div class="" style="display: flex; flex-direction: column; align-items: center;">
                            <img src="<?php if ($order->get_status() == 'completed') {
                                echo '/wp-content/uploads/2021/11/1.png';
                            } else {
                                echo '/wp-content/uploads/2021/11/2.png';
                            }; ?>"
                                 class="object-fit object-center w-8 h-8 litespeed-loaded">
                            <div class="text-base lg-text-medium font-bold mt-2/5 leading-2/5 text-gray-700 text-center">
                                تایید شده
                            </div>
                        </div>
                    </div>
                    <div class="wp-block-column arrow_after">
                        <div class="wa_num amount"><bdi>3</bdi></div>
                        <div class="" style="display: flex; flex-direction: column; align-items: center;">
                            <?php
                            $send_post_code = get_post_meta($order->get_id(), '_send_post_code', true);
                            $send_peyk_url = get_post_meta($order->get_id(), '_send_peyk_url', true);
                            ?>
                            <img src="<?php if (($send_post_code) || ($send_peyk_url)) {
                                echo '/wp-content/uploads/2021/11/1.png';
                            } else {
                                echo '/wp-content/uploads/2021/11/2.png';
                            }; ?>"
                                 class="object-fit object-center w-8 h-8 litespeed-loaded">
                            <div class="text-base lg-text-medium font-bold mt-2/5 leading-2/5 text-gray-700 text-center">
                                <?php
                                $shipping_methode = $order->get_shipping_method();

                                switch ($shipping_methode) {
                                    case 'پست پیشتاز رایگان' :
                                        echo 'ارسال توسط پست پیشتاز';
                                        break;
                                    case 'پست پیشتاز' :
                                        echo 'ارسال توسط پست پیشتاز ';
                                        break;
                                    case 'پیک موتوری' :
                                        echo 'ارسال توسط پیک';
                                        break;
                                    case 'تیپاکس' :
                                        echo 'ارسال توسط تیپاکس';
                                        break;
                                    case 'باربری' :
                                        echo 'ارسال توسط باربری';
                                        break;
                                    case 'تحویل حضوری' :
                                        echo 'تحویل حضوری';
                                        break;
                                }
                                ?>
                            </div>
                            <?php
//                            if ($send_peyk_url) {
//                                echo '<a href="' . $send_peyk_url . '" class="bg-primary-main btn-effect rounded-xs pr-1/3 pl-1/3 pt-0/8 pb-0/6 text-base leading-2/2 text-white items-center" target="_blank">پیگیری
//                        مرسوله</a>';
//                            } else
                                if ($send_post_code && $send_post_code != 1) {
                                echo '<span style="font-size: 10px;">کد رهگیری مرسوله</span>';
                                echo '<input id="PostCode" style="text-align: center; background-color: #ffffff; border: 2px solid #d7d7d7; border-radius: 6px;" value="' . $send_post_code . '" disabled >';
                                echo '<button onclick="CopyToClipboard()" class="px-1 mt-0/8" style="background-color: #c7c7c7; font-size: 11px; border-radius: 6px;">کپی کنید</button>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
if ($send_post_code && $send_post_code != 1) {
    echo
    '<div style="background-color: #fed100; border-radius: 8px;">
        <div>
            <div class="px-2 py-1 mb-2">
                <h3>! راهنمای پیگیری مرسولات پستی</h3>
                <p>ابتدا کد رهگیری را از باکس بالا کپی کرده سپس وارد سایت <a href="https://tracking.post.ir/"
                                                                             style="font-size: 13px; color: #0008ff; text-decoration: underline;">سامانه
                        رهگیری مرسولات پستی</a> شوید و کد رهگیری خود را در باکس تعیین شده وارد نمایید و بر روی دکمه
                    جستجو
                    کلیک نمایید تا وضعیت بسته خود را مشاهده نمایید.</p>
            </div>
        </div>
    </div>';
}
/**
 * Action hook fired after the order details.
 *
 * @param WC_Order $order Order data.
 * @since 4.4.0
 */
do_action('woocommerce_after_order_details', $order);

if ($show_customer_details) {
    wc_get_template('order/order-details-customer.php', array('order' => $order));
}
