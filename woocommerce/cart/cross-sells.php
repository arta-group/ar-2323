<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

if ( $cross_sells ) : ?>

    <style>
        .add_to_card_cross_sell {
            background-color: #f6412d;
            color: #ffffff;
            width: 120px;
            height: 44px;
            font-weight: bold;
            border-radius: 8px;
            position: relative;
            right: -465px;
            bottom: -140px
        }

        .cubic-transition {
            display: none;
        }

        @media (max-width: 768px) {
            .add_to_card_cross_sell {
                right: 91px;
                bottom: 30px
            }

        }
    </style>

    <div class="cross-sells">

        <h2>دیگران همراه این سفارش چه کالاهایی را خریداری کرده‌اند</h2>

		<?php woocommerce_product_loop_start(); ?>

		<?php foreach ( $cross_sells as $cross_sell ) : ?>

			<?php
			$post_object = get_post( $cross_sell->get_id() );

			setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

			wc_get_template_part( 'content', 'product' );

			$args = [
				'post_parent' => $post_object->ID, // Current post's ID
				'post_type'   => 'product_variation'
			];

			$children = get_children( $args );

			if ( empty( $children ) ) { ?>
                <form id="add-to-basket" class="card" action="" method="post">
                    <input type="hidden" name="add-to-cart" value="<?php echo $post_object->ID ?>">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="add_to_card_cross_sell">
                        افزودن به سبد
                    </button>
                </form>
			<?php } else { ?>
                <a href="<?php echo get_permalink( $post_object->ID ) ?>">
                    <button class="add_to_card_cross_sell">
                        مشاهده محصول
                    </button>
                </a>
			<?php } ?>


		<?php endforeach; ?>

        <script>
            (function ($) {
                // AJAX add to cart button on the Product Page
                $('#add-to-basket').on('submit', function (e) {
                    e.preventDefault();

                    var form = $(this);
                    form.block({message: null, overlayCSS: {background: '#fff', opacity: 0.6}});

                    var formData = new FormData(form[0]);
                    formData.append('add-to-cart', form.find('[name=add-to-cart]').val());

                    $.ajax({
                        url: wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'fs_add_to_cart'),
                        data: formData,
                        type: 'POST',
                        processData: false,
                        contentType: false,
                        complete: function (response) {
                            response = response.responseJSON;

                            if (!response)
                                return;

                            if (response.error && response.product_url) {
                                window.location = response.product_url;
                                return;
                            }

                            if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {
                                window.location = wc_add_to_cart_params.cart_url;
                                return;
                            }

                            var addToCartButton = form.find('.single_add_to_cart_button');

                            $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, addToCartButton]);

                            addToCartButton.next('a.added_to_cart.wc-forward').hide();

                            $('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();

                            form.parents('.site-main').find('.woocommerce-notices-wrapper').html(response.fragments.notices_html)

                            form.unblock()

                            // jQuery('.mini-cart-content').addClass('active');

                            cart();
                        }
                    });
                });
            }(jQuery));
        </script>

		<?php woocommerce_product_loop_end(); ?>

    </div>
<?php
endif;

wp_reset_postdata();
