<?php
/**
 * Functions add shortcode into WordPress.
 */


// Creating shortcode with multiple attributes FAQ
function frontend_faq_show($attr)
{

    $output = '<div class="content w-full rounded-xs border border-border px-2 md-px-4 py-1/5 md-pt-2/2 md-pb-2/6" id="faq-group-1">
	<div class="text-2 lg-text-2/6 text-gray-700 leading-2/4 lg-leading-4/4 pb-1/2 flex items-center font-normal">
		<img class="object-fill object-center ml-2 inline-block" src="http://artaelectric.ir/wp-content/themes/arta/assets/img/svg/Question.svg" alt="">
		<span class="fs-content-header">' . $attr['title'] . '</span>
	</div>
	<div class="divide-y divide-border">';

    for ($i = 1; $i <= 20; $i++) {
        $question = $attr['q' . $i];
        $answer = $attr['a' . $i];

        if ($question) {
            $output .= '<div class="faq accordion">
                    <div class="accordion-head flex flex-row items-center pt-1/8 pb-2 cursor-pointer">
                        <div class="flex-1 text-gray-600 accordion-title text-base md-text-medium leading-2/4 font-bold">' . $question . '</div>
                        <div class="icon-plus accordion-icon text-1/7 leading-1/7 text-gray-600 flex items-center justify-center mr-2"></div>
                    </div>
                    <div class="accordion-body active" style="max-height: 0px;">
                        <p class="pb-3/7 text-base leading-2/8 text-gray-500 text-justify lg-text-right">' . $answer . '</p>
                    </div>
                </div>';
        } else {
            break;
        }
    }

    $output .= '</div>
</div>';
    return $output;

}

add_shortcode('faq', 'frontend_faq_show');

