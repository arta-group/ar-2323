<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined('ABSPATH') || exit;
the_content();

if (have_rows('faqextra', get_the_ID())) {
    ?>
    <div class="content w-full rounded-xs border border-border px-2 md-px-4 py-1/5 md-pt-2/2 md-pb-2/6 mt-3"
         id="faq-group-1">
        <div class="text-2 lg-text-2/6 text-gray-700 leading-2/4 lg-leading-4/4 pb-1/2 flex items-center font-normal"
             style="font-size: 1.8rem;">
            <img class="md-wp-20 object-fill object-center ml-2 inline-block" style="margin: 1rem;"
                 src="http://artaelectric.ir/wp-content/themes/arta/assets/img/svg/Question.svg" alt="">
            <span class="fs-content-header"> سوالات متداول</span>
        </div>
        <div class="divide-y divide-border">

            <?php
            while (have_rows('faqextra', get_the_ID())) {
                the_row();
                ?>
                <div class="faq accordion">
                    <div class="accordion-head flex flex-row items-center pt-1/8 pb-2 cursor-pointer">
                        <div class="flex-1 text-gray-600 accordion-title text-base md-text-medium leading-2/4 font-bold">
                            <?php echo get_sub_field('question'); ?>
                        </div>
                        <div class="icon-plus accordion-icon text-1/7 leading-1/7 text-gray-600 flex items-center justify-center mr-2"></div>
                    </div>
                    <div class="accordion-body active" style="max-height: 0px;">
                        <p class="pb-3/7 text-base leading-2/8 text-gray-500 text-justify lg-text-right">
                            <?php echo get_sub_field('answer'); ?>
                        </p>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

    <?php
}