<?php
function sa_modify_shipping_totals($cart_object)
{
    $flat_r = WC()->session->get('chosen_shipping_methods')[0];
    if ( !($flat_r == 'flat_rate:9' || $flat_r == 'local_pickup:6') ) {
        $extra = 0;
        foreach (WC()->cart->get_cart() as $item) {
            $id = $item['product_id'];

            if (get_post_meta($id, '_add_shipping', true) != null)
                $extra = $extra + ((int)$item['quantity'] * get_post_meta($id, '_shapping_cost', true));
        }

        if ($extra > 0)
            $cart_object->add_fee('اضافه هزینه بسته بندی', $extra, true, '');
    }
}
add_action('woocommerce_cart_calculate_fees', 'sa_modify_shipping_totals');

function sa_add_product_info_metabox()
{
    $add_shipping = [
        'id' => '_add_shipping',
        'label' => __(' افزایش هزینه حمل و نقل', 'fswc'),
        'class' => 'fswc-add-shipping-field',
        'desc_tip' => false,
        'description' => __('برای فعال سازی قابلیت هزینه پستی اضافه این تیک را بزنید.', 'fswc'),
    ];
    $shapping_cost = [
        'id' => '_shapping_cost',
        'label' => __('مقدار افزایش هزینه حمل و نقل', 'fswc'),
        'class' => 'fswc-shapping-cost-field wc_input_decimal',
        'desc_tip' => true,
        'description' => __('مقدار هزینه اضافه بار را وارد نمایید', 'fswc'),
    ];
    $remove_send = [
        'id' => '_remove_send',
        'label' => __('حذف ارسال با پست', 'sawc'),
        'class' => 'fswc-add-shipping-field',
        'desc_tip' => false,
        'description' => __('جهت حذف گزینه ارسال با پست این تیک را بزنید.', 'sawc'),
    ];

    woocommerce_wp_checkbox($add_shipping);
    woocommerce_wp_text_input($shapping_cost);
    woocommerce_wp_checkbox($remove_send);
}

add_action('woocommerce_product_options_shipping', 'sa_add_product_info_metabox');

function fs_save_custom_field($post_id)
{
    $product = wc_get_product($post_id);

    $add_shipping_post = isset($_POST['_add_shipping']) ? $_POST['_add_shipping'] : '';
    $product->update_meta_data('_add_shipping', $add_shipping_post);

    $shapping_cost_post = isset($_POST['_shapping_cost']) ? $_POST['_shapping_cost'] : '';
    $product->update_meta_data('_shapping_cost', sanitize_text_field($shapping_cost_post));

    $remove_send = isset($_POST['_remove_send']) ? $_POST['_remove_send'] : '';
    $product->update_meta_data('_remove_send', $remove_send);

    $product->save();
}

add_action('woocommerce_process_product_meta', 'fs_save_custom_field');

// Unset other shiping rates when product is checked for remove send.
add_filter('woocommerce_package_rates', 'fs_unset_shipping', 10, 2);

function fs_unset_shipping($rates, $package)
{
    $extra_shipping_product = false;

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $product_id = $cart_item['product_id'];
        if (get_post_meta($product_id, '_remove_send', true) != null)
            $extra_shipping_product = true;
    }

    if ($extra_shipping_product) {
        if (isset($rates['flat_rate:16']) || isset($rates['free_shipping:17'])) {
            unset($rates['flat_rate:16']);
            unset($rates['free_shipping:17']);
        }
    }

    if (isset($rates['free_shipping:17'])) {
        unset($rates['flat_rate:16']);
    }

    return $rates;
}