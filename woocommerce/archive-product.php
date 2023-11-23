<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

$current_object = get_queried_object();

$current_term_id = $current_object->term_id ?? 0;

if ($current_term_id)
    $current_term = get_term($current_term_id, 'product_cat');
?>
    <main id="primary" class="site-main">
        <?php
        woocommerce_breadcrumb();
        ?>
        <section class="container mx-auto pt-3/3 main-content" id="main-content">
            <aside class="w-296 custom-hidden-m lg-block fixed lg-relative w-screen h-screen lg-h-auto lg-z-20 z-55 sidebar"
                   id="filters-sidebar">
                <div class="w-full sidebar__inner">
                    <div class="rounded-xs w-full h-full lg-h-auto bg-gray-50 rounded-xs border border-border relative overflow-y-auto">
                        <div class=" py-3 flex flex-col items-start px-2 lg-px-0 lg-items-center justify-center">
                            <div class="text-xl leading-3/1 font-bold text-gray-900">فیلتر محصولات</div>
                            <div class="mt-1/6 w-7 h-0/5 bg-primary-main rounded-full"></div>
                            <div class="lg-hidden absolute top-3 left-3 icon-close-alt text-3/4 leading-3/4 h-3/4 cursor-pointer"
                                 id="toggle-filters-close"></div>
                        </div>
                        <div class="flex flex-col overflow-y-auto fs-products-archive-filters p-2">
                            <?php
                            dynamic_sidebar('shop-sidebar');
                            //$form_id = get_field( 'filter-form-id', 'option' );
                            //echo do_shortcode( '[products_finder preset=”' . $form_id . '”]' );
                            ?>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($current_term) && have_rows('sidebar-small-banners', $current_term)) {
                    while (have_rows('sidebar-small-banners', $current_term)) {
                        the_row();
                        $image = get_sub_field('image');
                        ?>
                        <div class="mt-4/5 grid grid-cols-1 gap-3">
                            <a href="<?php echo esc_url(get_sub_field('url')); ?>" class="h-18 w-full rounded-xs">
                                <img class="object-fit object-center" src="<?php echo esc_url($image['url']); ?>"
                                     alt="<?php echo esc_attr($image['alt']); ?>"/>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </aside>
            <div class="w-full lg-w-auto px-2 md-px-3 lg-px-0 lg-flex-1 content" id="content">
                <?php
                if (isset($current_term) && have_rows('top-wide-banners', $current_term)) {
                    while (have_rows('top-wide-banners', $current_term)) {
                        the_row();
                        $image = get_sub_field('image');
                        ?>
                        <div class="w-full rounded-xs overflow-hidden mb-5">
                            <a href="<?php echo esc_url(get_sub_field('url')); ?>">
                                <img class="object-fit object-center w-full rounded-xs overflow-hidden fs-archive-products-banner"
                                     src="<?php echo esc_url($image['url']); ?>"
                                     alt="<?php echo esc_attr($image['alt']); ?>"/>
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="mb-6">
                    <div class="flex flex-row items-center border-b border-border pb-1/8">
                        <?php
                        woocommerce_catalog_ordering();
                        ?>
                    </div>
                    <div class="grid grid-cols-2 lg-grid-cols-4 gap-y-3 mt-2/5 products relative">
                        <?php
                        if (woocommerce_product_loop()) {
                            if (wc_get_loop_prop('total')) {
                                while (have_posts()) {
                                    the_post();
                                    /**
                                     * Hook: woocommerce_shop_loop.
                                     */
                                    do_action('woocommerce_shop_loop');

                                    wc_get_template_part('content', 'product');
                                }
                            }

                            /**
                             * Hook: woocommerce_after_shop_loop.
                             *
                             * @hooked woocommerce_pagination - 10
                             */
                            //							do_action( 'woocommerce_after_shop_loop' );
                        } else {
                            /**
                             * Hook: woocommerce_no_products_found.
                             *
                             * @hooked wc_no_products_found - 10
                             */
                            do_action('woocommerce_no_products_found');
                        }
                        ?>
                    </div>
                </div>
                <?php woocommerce_pagination(); ?>
            </div>
        </section>
        <?php
        if (isset($current_term)) {
            $description = $current_term->description;

	        global $wp;

	        $slug = $wp->request;

            $show_description = true;

	        if (strpos($slug,'industrial-electricity/industrial-fans' ) &&
	            strpos($slug, '/page/')) {

		        $show_description  = false;
	        }

	        if ($description && $show_description) {
                ?>
                <section class="py-6 bg-gray-50 px-2 md-px-3 lg-px-0">
                    <div class="container mx-auto">
                        <div class="mt-2/8 relative">
                            <div class="intro-content c-archive-shop-info max-h-18 transition-all duration-200 ease-linear overflow-hidden border-b border-border pb-2">
                                <?php echo wpautop($description); ?>
                            </div>
                            <div class="bg-intro-overlay archive-shop w-full absolute z-5 bottom-0 left-0 h-9 w-full"></div>
                            <button type="button" id="show-rest"
                                    class="absolute bottom-0 z-10 left-half transform -translate-x-1/2 translate-y-1/2 pt-0/3 pb-0/5 px-1 bg-gray-100 text-gray-dark text-base leading-2/2 rounded-xs flex items-center">
                                نمایش بیشتر
                                <span class="icon-angle-down text-xs transform scale-50 mr-0/5 leading-0/7 h-1 flex items-center"></span>
                            </button>
                        </div>
                        <?php
                        $faqextra = get_term_meta($current_term_id, 'faqextra_0_question', true);
                        if ($faqextra) { ?>
                            <div class="content w-full rounded-xs border border-border px-2 md-px-4 py-1/5 md-pt-2/2 md-pb-2/6 mt-3"
                                 id="faq-group-1">
                                <div class="text-2 lg-text-2/6 text-gray-700 leading-2/4 lg-leading-4/4 pb-1/2 flex items-center font-normal"
                                     style="font-size: 1.8rem;">
                                    <img class="md-wp-20 object-fill object-center ml-2 inline-block"
                                         style="margin: 1rem;"
                                         src="http://artaelectric.ir/wp-content/themes/arta/assets/img/svg/Question.svg"
                                         alt="">
                                    <span class="fs-content-header"> سوالات متداول</span>
                                </div>
                                <div class="divide-y divide-border">
                                    <?php
                                    for ($n = 0; $n <= 4; $n++) {
                                        $faq_question_key = 'faqextra_' . $n . '_question';
                                        $faq_answer_key = 'faqextra_' . $n . '_answer';

                                        $question = get_term_meta($current_term_id, $faq_question_key, true);
                                        $answer = get_term_meta($current_term_id, $faq_answer_key, true);

                                        if ($question) { ?>
                                            <div class="faq accordion">
                                                <div class="accordion-head flex flex-row items-center pt-1/8 pb-2 cursor-pointer">
                                                    <div class="flex-1 text-gray-600 accordion-title text-base md-text-medium leading-2/4 font-bold">
                                                        <?php echo $question; ?>
                                                    </div>
                                                    <div class="icon-plus accordion-icon text-1/7 leading-1/7 text-gray-600 flex items-center justify-center mr-2"></div>
                                                </div>
                                                <div class="accordion-body active" style="max-height: 0px;">
                                                    <p class="pb-3/7 text-base leading-2/8 text-gray-500 text-justify lg-text-right">
                                                        <?php echo $answer; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </section>
                <?php
            } else {
                $faqextra = get_term_meta($current_term_id, 'faqextra_0_question', true);
                if ($faqextra) { ?>
                    <section class="py-6 bg-gray-50 px-2 md-px-3 lg-px-0">
                        <div class="container mx-auto">
                            <div class="content w-full rounded-xs border border-border px-2 md-px-4 py-1/5 md-pt-2/2 md-pb-2/6 mt-3"
                                 id="faq-group-1">
                                <div class="text-2 lg-text-2/6 text-gray-700 leading-2/4 lg-leading-4/4 pb-1/2 flex items-center font-normal"
                                     style="font-size: 1.8rem;">
                                    <img class="md-wp-20 object-fill object-center ml-2 inline-block"
                                         style="margin: 1rem;"
                                         src="http://artaelectric.ir/wp-content/themes/arta/assets/img/svg/Question.svg"
                                         alt="">
                                    <span class="fs-content-header"> سوالات متداول</span>
                                </div>
                                <div class="divide-y divide-border">
                                    <?php
                                    for ($n = 0; $n <= 4; $n++) {
                                        $faq_question_key = 'faqextra_' . $n . '_question';
                                        $faq_answer_key = 'faqextra_' . $n . '_answer';

                                        $question = get_term_meta($current_term_id, $faq_question_key, true);
                                        $answer = get_term_meta($current_term_id, $faq_answer_key, true);

                                        if ($question) { ?>
                                            <div class="faq accordion">
                                                <div class="accordion-head flex flex-row items-center pt-1/8 pb-2 cursor-pointer">
                                                    <div class="flex-1 text-gray-600 accordion-title text-base md-text-medium leading-2/4 font-bold">
                                                        <?php echo $question; ?>
                                                    </div>
                                                    <div class="icon-plus accordion-icon text-1/7 leading-1/7 text-gray-600 flex items-center justify-center mr-2"></div>
                                                </div>
                                                <div class="accordion-body active" style="max-height: 0px;">
                                                    <p class="pb-3/7 text-base leading-2/8 text-gray-500 text-justify lg-text-right">
                                                        <?php echo $answer; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php }
            }
        }
        get_template_part('template-parts/visited-products');
        ?>
    </main>
<?php
get_footer('shop');