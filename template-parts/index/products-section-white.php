<?php
$params = wp_parse_args($args, ['products_category' => 0]);
$category = get_term_by('id', $params['products_category'], 'product_cat');
?>
<section class="pb-6/5" dir="rtl">
    <div class="container mx-auto carousel-container">
        <div class="flex flex-row items-center mb-2/5 border-b border-border justify-between mx-2 md-mx-3 lg-mx-0">
            <div class="text-lg lg-text-2/4 leading-2/4 lg-leading-3/8 text-gray-dark font-bold pb-1 title">
                انواع <?php echo $category->name; ?></div>
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
            if ($params['position'] == 'first') {
                $products = get_option('my_theme_carousel_cart_first_white_section');
            } elseif ($params['position'] == 'second') {
                $products = get_option('my_theme_carousel_cart_second_white_section');
            }

            foreach ($products as $product) {
                $post_object = get_post($product->get_id());
                setup_postdata($GLOBALS['post'] =& $post_object);
                wc_get_template_part('content', 'product');
            }

            carousel_category_card($category); ?>
        </div>

    </div>
</section>
