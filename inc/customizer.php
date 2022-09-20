<?php

/**
 * FOUR SIDES Theme Customizer
 *
 * @package FOUR SIDES
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fs_customize_register($wp_customize)
{
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', [
            'selector' => '.site-title a',
            'render_callback' => 'fs_customize_partial_blogname',
        ]);
        $wp_customize->selective_refresh->add_partial('blogdescription', [
            'selector' => '.site-description',
            'render_callback' => 'fs_customize_partial_blogdescription',
        ]);
    }
}

add_action('customize_register', 'fs_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function fs_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function fs_customize_partial_blogdescription()
{
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fs_customize_preview_js()
{
    wp_enqueue_script('fs-customizer', get_template_directory_uri() . '/assets/js/customizer.js', ['customize-preview'], '20200820', true);
}

add_action('customize_preview_init', 'fs_customize_preview_js');

// Adding send Meta container admin shop_order pages
add_action('add_meta_boxes', 'mv_add_meta_boxes');
function mv_add_meta_boxes()
{
    add_meta_box('mv_other_fields', __('ارسال', 'woocommerce'), 'mv_add_other_fields_for_packaging', 'shop_order', 'side', 'core');
}


// Adding send Meta field in the send meta container admin shop_order pages
function mv_add_other_fields_for_packaging()
{
    global $post;

    $send_post_code = get_post_meta($post->ID, '_send_post_code', true);
    $send_peyk_url = get_post_meta($post->ID, '_send_peyk_url', true);

    echo '<label style="font-weight: bold;">کد رهگیری پستی</label>
            <p style="border-bottom:solid 1px #eee;padding-bottom:13px;">
                <input type="number" style="width:250px;" name="_send_post_code" placeholder="کد 12 رقمی پستی را وارد نمایید" value="' . $send_post_code . '"></p>
               <label style="font-weight: bold;">آدرس پیگیری ارسال مرسوله</label>
            <p style="border-bottom:solid 1px #eee;padding-bottom:13px;">
                <input type="url" style="width:250px;" name="_send_peyk_url" placeholder="آدرس اینترنتی پیگیری ارسال" value="' . $send_peyk_url . '"></p>';

}

// Save the data of the send Meta field
function mv_save_wc_order_other_fields($post_id)
{
    $order = wc_get_order($post_id);
    if ($order) {
        $order_user = $order->get_user();
        $order_billing_phone = $order_user->mobile;
        $order_billing_name = $order->get_billing_first_name(). ' '. $order->get_billing_last_name();

        $send_post_code = $order->get_meta('_send_post_code', true);
        $send_peyk_url = $order->get_meta('_send_peyk_url', true);

        if (!($send_post_code || $send_peyk_url)) {
            if (!empty($_POST['_send_post_code']) && $_POST['_send_post_code'] != 1) {

                $sms_value = [sanitize_text_field($order_billing_name), sanitize_text_field($_POST['_send_post_code'])];
                sa_sms(sanitize_text_field($order_billing_phone), '5', $sms_value);
            }elseif (!empty($_POST['_send_post_code']) && $_POST['_send_post_code'] == 1) {

                $sms_value = [sanitize_text_field($order_billing_name)];
                sa_sms(sanitize_text_field($order_billing_phone), '7', $sms_value);
            } elseif (!empty($_POST['_send_peyk_url'])) {

                $sms_value = [sanitize_text_field($order_billing_name), sanitize_text_field($_POST['_send_peyk_url'])];
                sa_sms(sanitize_text_field($order_billing_phone), '6', $sms_value);
            }
        }

		$send_post_code = $_POST['_send_post_code'] ?? '';
	    $order->update_meta_data('_send_post_code', sanitize_text_field($send_post_code));

	    $send_peyk_url = $_POST['_send_peyk_url'] ?? '';
	    $order->update_meta_data('_send_peyk_url', sanitize_text_field($send_peyk_url));

        $order->save_meta_data();
    }
}
add_action('save_post', 'mv_save_wc_order_other_fields', 10, 1);