<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
do_action( 'woocommerce_before_customer_login_form' );
?>
<style>
    #register_mo {
        display: none;
    }

    @media (max-width: 768px) {
        #register_mo {
            display: block;
        }

        .c-register {
            display: none;
        }

        .border-t {
            border: none;
        }
    }

</style>

<section
        class="container mx-auto grid grid-cols-1 lg-grid-cols-2 pt-3/3 pb-10 relative form-divider px-2 md-px-3 lg-px-0">
    <div class="c-login lg-pb-0 lg-pl-13">
        <div class="flex items-center">
            <div class="icon-identification text-xl leading-2 flex items-center justify-center flex-shrink-0"></div>
            <div class="text-lg font-bold leading-2/8 flex-shrink-0 mr-1/5 ml-2/5">ورود</div>
            <div class="flex-1 border-b border-border"></div>
        </div>

        <div class="mt-4/8 text-lg mb-2/9 leading-12">قبلا عضو سایت شده اید؟</div>

        <form class="grid grid-cols-1 gap-1/9" method="post">
            <div>
                <label class="text-base block text-gray-main mb-0/7" for="username"> شماره موبایل </label>
                <input type="number" class="h-4/5 border-2 border-border w-full rounded-xs text-base leading-4/5 px-2"
                       name="username" id="username" value="<?php
				if ( ! empty( $_POST['mobile'] ) ) {
					echo esc_attr( wp_unslash( $_POST['mobile'] ) );
				} elseif ( isset( $_GET['reset_pass'] ) ) {
					echo $_GET['reset_pass'];
				} ?>"/>
            </div>
            <div>
                <label class="text-base block text-gray-main mb-0/7" for="password">رمز عبور<?php
	                if ( isset( $_GET['reset_pass'] ) ) {
		                echo ' جدید ارسال شده را وارد نمایید.';
	                } ?></label>
                <input class="h-4/5 border-2 border-border w-full rounded-xs text-base leading-4/5 px-2" type="password"
                       name="password" id="password"/>
            </div>
            <div class="flex items-center justify-between pt-1/4">
                <div class="flex items-center">
                    <input type="checkbox" class="w-2 h-2 rounded-xs" name="rememberme" id="rememberme"
                           value="forever"/>
                    <label for="rememberme" class="mr-1/5 text-base"> مرا به خاطر بسپار</label>
                </div>
                <a href="<?php echo esc_url( wp_lostpassword_url() ); ?>" class="text-primary-main text-base">
                    <?php
                    if ( isset( $_GET['reset_pass'] ) ) {
	                    echo 'ارسال دوباره رمز عبور';
                    }else {
                        echo 'رمز عبور خود را فراموش کرده اید؟';
                    } ?> </a>
            </div>
			<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            <button type="submit"
                    class="bg-secondary-main text-gray-dark text-lg rounded-xs leading-18 h-4/5 mt-1/6 cursor-pointer"
                    name="login" value="ورود">ورود
            </button>
            <div id="register_mo" >
                <p>حساب کاربری ندارید؟ <a style="font-weight: 800;text-decoration: underline;">ثبت نام کنید</a></p>
            </div>
        </form>
    </div>
<!--    <div class="w-5/5 h-5/5 rounded-full leading-5/5 text-center absolute top-half left-half bg-white z-10 border border-border text-lg transform text-gray-main custom-translate -translate-x-1/2 -translate-y-8 lg--translate-y-6">-->
<!--        یا-->
<!--    </div>-->
    <div class="c-register lg-pt-0 lg-pr-13 border-t lg-border-t-0 lg-border-r border-border">
        <div class="flex items-center">
            <div class="icon-identification text-xl leading-2 flex items-center justify-center flex-shrink-0"></div>
            <div class="text-lg font-bold flex-shrink-0 mr-1/5 ml-2/5"> ثبت نام</div>
            <div class="flex-1 border-b border-border"></div>
        </div>

        <div class="mt-4/8 text-lg mb-2/9 leading-12">کاربر جدید هستید؟</div>

        <form method="post" class="grid grid-cols-1 gap-1/9">
            <div>
                <label class="text-base block text-gray-main mb-0/7" for="reg_username"> شماره موبایل </label>
                <input type="number" placeholder="به همراه صفر"
                       class="h-4/5 border-2 border-border w-full rounded-xs text-base leading-4/5 px-2" name="username"
                       id="reg_username"
                       value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"/><?php // @codingStandardsIgnoreLine ?>
            </div>
            <input type="hidden" id="reg_email"
                   class="h-4/5 border-2 border-border w-full rounded-xs text-base leading-4/5 px-2" name="email"/>
            <div>
                <label class="text-base block text-gray-main mb-0/7" for="password">رمز عبور</label>
                <input type="password" placeholder="حداقل ۸ کاراکتر"
                       class="h-4/5 border-2 border-border w-full rounded-xs text-base leading-4/5 px-2" name="password"
                       id="reg_password" autocomplete="new-password"/>
            </div>
            <p class='mt-1/5 text-base leading-12'>اطلاعات شخصی شما برای بهبود تجربه شما در این سایت و برای مدیریت
                دسترسی به حساب کاربری و یا دیگر اهداف ذکر شده در سیاست حفظ حریم خصوصی استفاده می گردد.</p>
			<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
            <button type="submit"
                    class="bg-secondary-main text-gray-dark text-lg rounded-xs leading-18 h-4/5 mt-1/5 cursor-pointer"
                    name="register" value="ثبت نام">ثبت نام
            </button>
        </form>
    </div>
</section>
