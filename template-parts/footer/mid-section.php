<div class="pt-5/8 lg-pt-7 pb-5/7 lg-pb-5/5 flex flex-col relative">
    <div class="flex flex-col lg-flex-row">
        <div class="flex items-center lg-items-start flex-col lg-ml-13 pb-40 lg-pb-0">
            <div class="mb-1/5">
                <img class="object-fit object-center"
                     src="<?php echo get_stylesheet_directory_uri() . "/assets/img/svg/arta-logo.svg"; ?>" width="160"
                     height="63" alt=""/>
            </div>
            <p class="mb-3 lg-w-30 text-base leading-2/2 text-gray-600 text-center lg-text-justify">
                آرتا الکتریک فروشگاه اینترنتی تخصصی صنعت روشنایی و برق است. این مجموعه با هدف همراهی در انتخاب، ارائه
                مشاوره تخصصی و فروش محصولات متنوع با بهترین قیمت بازار شکل گرفته است.
                حضور 30 ساله در لاله زار، شناخت کامل بازار و برندهای معتبر به همراه تیم پشتیبانی قوی و متخصص به ما این
                امکان را داده است که علاوه بر فروش محصولات با بهترین قیمت بازار با ارائه مشاوره در تمامی مراحل قبل و بعد
                از خرید همراه شما باشیم. تلاش ما خلق تجربه خریدی آسان و با اطمینان برای تمام افراد است.
            </p>
            <ul class="flex flex-row items-center ">
                <li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
                    <a href="https://www.instagram.com/arta_electric" rel="nofollow"
                       class="inline-block icon-instagram text-3 leading-3 h-3 text-primary-main"></a>
                </li>
                <li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
                    <a href="https://www.linkedin.com/company/arta-electric/" rel="nofollow"
                       class="inline-block icon-linkedin text-3 leading-3 h-3 text-linkedin"></a>
                </li>
                <li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
                    <a href="https://t.me/arta_electric1" rel="nofollow"
                       class="inline-block icon-telegram text-3 leading-3 h-3 text-telegram"></a>
                </li>
                <li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
                    <a href="https://api.whatsapp.com/send?phone=+989199320601" rel="nofollow"
                       class="inline-block icon-whatsapp text-3 leading-3 h-3 text-whatsapp"></a>
                </li>
                <li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
                    <a href="https://api.whatsapp.com/send?phone=+989199320601" rel="nofollow"
                       class="flex items-center justify-center leading-3/6 icon-twitter h-3 w-3 rounded-full text-twitter bg-telegram text-white"></a>
                </li>
                <li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
                    <a href="https://www.aparat.com/arta_electric" rel="nofollow"
                       class="inline-block text-3 leading-3 h-3 text-primary-main">
                        <img src="/wp-content/uploads/svg/aparat.svg" data-src="/wp-content/uploads/svg/aparat.svg">
                    </a>
                </li>
                <li class="w-3 h-3 rounded-full ml-1/5 flex items-center justify-center bg-white">
                    <a href="https://www.youtube.com/channel/UCJeUHdJYT947fwp_SckHwSg" rel="nofollow"
                       class="inline-block text-3 leading-3 h-3 text-primary-main">
                        <img class="w-3 h-3" src="/wp-content/uploads/svg/youtube.svg" data-src="/wp-content/uploads/svg/youtube.svg">
                    </a>
                </li>
            </ul>
        </div>
        <div class="lg-ml-9 mb-4/9 lg-mb-0">
            <div class="text-medium leading-2/7 mb-1/4 lg-mb-3/1 text-primary-main font-bold"> اطلاعات بیشتر</div>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu',
                'menu_class' => 'flex flex-col max-h-12 lg-max-h-unset flex-wrap text-1/5 leading-2/8 text-gray-600 has-disc pr-1/5',
                'container' => '',
                'fallback_cb' => 'false',
                'depth' => 1
            ));
            ?>
        </div>
        <div class="flex flex-col flex-1 justify-between h-28">
            <div>
                <div class="text-medium leading-2/7 mb-1/4 lg-mb-3/1 text-primary-main font-bold">دسته بندی
                    محصولات
                </div>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-category-menu',
                    'menu_class' => 'grid grid-cols-2 lg-grid-cols-3 text-1/5 leading-2/8 text-gray-600 has-disc pr-1/5',
                    'container' => '',
                    'fallback_cb' => 'false',
                    'depth' => 1
                ));
                ?>
            </div>
            <div class="newsletter-form">
                <?php
                echo do_shortcode('[contact-form-7 id="13661"]');
                ?>
            </div>

        </div>
    </div>
    <div class="pt-18 lg-pt-6 flex flex-col lg-flex-row justify-between">
        <div class="grid grid-cols-1 md-grid-cols-2 gap-1/8 lg-gap-x-4/1 lg-gap-y-3/5 absolute md-static top-46 left-0 w-full lg-w-auto">
            <div class="flex flex-row items-center">
                <div class="h-3/2 icon-phone text-3/2 leading-3/2 text-gray-main flex items-center"></div>
                <div class="flex flex-col mr-2/5">
                    <div class="text-medium  leading-2/5 font-bold text-gray-600">تلفن تماس</div>
                    <a href="tel:+982166342020"
                       class="text-medium  leading-2/5 text-gray-600">02166342020</a>
                </div>
            </div>
            <div class="flex flex-row items-center">
                <div class="h-3 icon-envelope text-3 leading-3 text-gray-main flex items-center"></div>
                <div class="flex flex-col mr-2/5">
                    <div class="text-medium  leading-2/5 font-bold text-gray-600">ایمیل</div>
                    <a href="mailto:info@artaelectric.ir"
                       class="text-medium mt-0/8 leading-2/5 text-gray-600">info@artaelectric.ir</a>
                </div>
            </div>
            <div class="flex flex-row items-center">
                <div class="h-3/2 icon-address text-3/2 leading-3/2 text-gray-main flex items-center"></div>
                <div class="flex flex-col mr-2/5">
                    <div class="text-medium leading-2/5 font-bold text-gray-600">آدرس</div>
                    <span class="text-medium mt-0/8 leading-2/5 text-gray-600 mt-0/8">لاله زار نو - بالاتر از تقاطع منوچهری - پاساژ ابراهیمی - راهروی سمت راست - طبقه دوم - پلاک 8</span>
                </div>
            </div>
            <div class="flex flex-row items-center">
                <div class="h-3/3 icon-clock text-3/3 leading-3/3 text-gray-main flex items-center"></div>
                <div class="flex flex-col mr-2/5">
                    <div class="text-medium leading-2/5 font-bold text-gray-600">ساعت کاری</div>
                    <span class="text-medium mt-0/8 leading-2/5 text-gray-600">9 صبح تا 6 عصر</span>
                </div>
            </div>
        </div>
        <div class="flex flex-col lg-flex-row flex-shrink-0">
            <div class="lg-ml-4 mb-6 lg-mb-0">
                <div class="mb-4 text-medium leading-13 text-gray-500 text-center lg-text-right lg-pr-2"> پرداخت از
                    طریق درگاه
                </div>
                <div class="flex flex-row justify-center lg-justify-start">
                    <img class="object-fit object-center ml-2/5"
                         src="https://artaelectric.ir/wp-content/uploads/2021/09/pasargad-1.png"
                         width="95"
                         height="80"
                         alt="">
                    <img class="object-fit object-center ml-2/5"
                         src="https://artaelectric.ir/wp-content/uploads/2021/09/saman-1.png"
                         width="95"
                         height="80"
                         alt="">
                </div>
            </div>
            <div>
                <div class="mb-1/9 text-medium leading-13 text-center lg-text-right text-gray-500 lg-pr-2"> نمادها و
                    مجوزها
                </div>
                <div class="flex flex-row justify-center lg-justify-start">
                    <a href="https://trustseal.enamad.ir/?id=249816&Code=KoZmWIQzQq6sA77CXh4L" target="_blank">
                        <img class="object-fit object-center w-10 h-10 lg-w-12 lg-h-12"
                             src="https://artaelectric.ir/wp-content/uploads/2021/09/nemad.png"
                             width="120"
                             height="120"
                             alt="">
                    </a>
                    <a href="https://logo.samandehi.ir/Verify.aspx?id=126976&p=rfthuiwkgvkapfvljyoegvka" target="_blank">
                        <img class="object-fit object-center w-10 h-10 lg-w-12 lg-h-12"
                             src="https://artaelectric.ir/wp-content/uploads/2021/09/samandehi.png"
                             width="120"
                             height="120"
                             alt="">
                    </a>
                    <a href="https://ecunion.ir/verify/artaelectric.ir?token=16229605ea6c1ffa28fd" target="_blank">
                        <img class="object-fit object-center w-10 h-10 lg-w-12 lg-h-12"
                             src="https://artaelectric.ir/wp-content/uploads/2021/09/senf.png"
                             width="120"
                             height="120"
                             alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
