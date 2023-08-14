<div class="fs-footer-top grid grid-cols-2 md-grid-cols-3 lg-grid-cols-6 border-b-2 border-border pt-5/1 lg-pt-6/6 pb-5/4 lg-pb-5/6 gap-4">

	<?php
	while ( have_rows( 'features-icons', 'option' ) ) {
		the_row();
		$icon = get_sub_field( 'icon' );
		?>
        <div class="flex flex-col h-9 items-center justify-between">
            <div class="mb-1/6 <?php echo 'icon-footer-' . $icon . ''; ?> h-4/8 text-4/8 leading-4/8 text-primary-main"></div>
            <div class="text-base leading-2/7 text-gray-600 font-bold text-center"><?php echo get_sub_field( 'title' ); ?></div>
        </div>
		<?php
	}
	?>

</div>

<style>
    .bottom-pic {
        align-items: center;
    }

    @media (max-width: 768px) {
        .bottom-pic {
            flex-direction: column !important;
        }

        .bottom-pic > div {
            width: 100% !important;
            padding: 0 !important;
            margin-top: 10px !important;
        }
    }
</style>

<div class="flex flex-col lg-flex-row bottom-pic">
    <div style="width: 33%;padding: 30px;">
        <div class="w-full h-30 md-h-auto rounded-xs bg-gray-200 flex-shrink-0 lg-ml-3/2 img-frame">
            <img src="https://artaelectric.ir/wp-content/uploads/2023/08/%D8%AF%D8%B1%D8%A8%D8%A7%D8%B1%D9%87-%D8%A2%D8%B1%D8%AA%D8%A7-%D8%A7%D9%84%DA%A9%D8%AA%D8%B1%DB%8C%DA%A9.jpg"
                 class="rounded-xs grayscale w-full h-full object-center object-cover"
                 alt="">
        </div>
    </div>
    <div style="width: 33%;display: flex;justify-content: center;">
        <p class="mb-3 lg-w-30 text-base leading-2/2 text-gray-600 text-center lg-text-justify">
            در سال 1394 با تجربه بیش از 30 سال بنکداری محصولات برندهای معتبر ایرانی و با توجه به نیاز روز جامعه، با هدف
            ارسال مستقیم و بدون واسطه محصولات روشنایی در کوتاه‌ترین زمان و با بهترین قیمت، فروشگاه اینترنتی "آرتا
            الکتریک" شکل گرفت. افتخار ما در مجموعه آرتا الکتریک، با نام ثبتی شرکت "پیشتازان نوآوری آرتا الکتریک" و به
            شماره ثبت 576291، خدمت رسانی به قشر وسیعی از مصرف کنندگان در سراسر کشور است.
        </p>
    </div>
    <div style="width: 33%;padding: 28px;">
        <div class="w-full h-30 md-h-auto rounded-xs bg-gray-200 flex-shrink-0 lg-ml-3/2 img-frame">
            <img src="https://artaelectric.ir/wp-content/uploads/2022/03/3.jpg"
                 class="rounded-xs grayscale w-full h-full object-center object-cover"
                 alt="">
        </div>
    </div>
</div>