<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

$is_send_password = false;

if ( isset( $_POST[ 'send-password' ] ) && isset( $_POST[ 'lost-password-nonce' ] ) )
{
	if ( wp_verify_nonce( $_POST[ 'lost-password-nonce' ], 'lost_password' ) )
	{
		$user_login = isset( $_POST[ 'user_login' ] ) ? sanitize_text_field( trim( $_POST[ 'user_login' ] ) ) : '';
		$message    = '';

		if ( empty( $user_login ) )
			$message = 'لطفا فیلد شماره موبایل را تکمیل کنید';
		elseif ( ! preg_match( "/^09[0-9]{9}$/", $user_login ) )
			$message = 'لطفا یک شماره موبایل معتبر وارد کنید.';
		else
		{
			$user = get_user_by( 'login', $user_login );

			if ( $user )
			{
				// Generate 5 digits random password
				$new_password = rand( 10000, 99999 );

				wp_update_user( array(
					'ID'        => $user->ID,
					'user_pass' => $new_password
				) );

				$message          = sprintf( "<span>کاربر گرامی رمز عبور جدید به شماره شما ارسال شد.</span> <a href='%s'>وارد شوید</a>", esc_url( site_url( 'my-account' ) ) );
				$is_send_password = true;

				$fullname = empty( $user->first_name ) && empty( $user->last_name ) ? 'کاربر' : $user->first_name . ' ' . $user->last_name;
                $sms = 0;
				$sms_value = [ $new_password, $fullname ];
				sa_sms($user_login, $sms, $sms_value);
			}
			else
				$message = 'این شماره موبایل موجود نیست.';
		}

		if ( ! empty( $message ) )
		{
			$strong      = ! $is_send_password ? '<strong>' . __( 'Error:', 'woocommerce' ) . '</strong> ' : '';
			$notice_type = $is_send_password ? 'success' : 'error';
			wc_add_notice( $strong . $message, $notice_type );
		}
	}
}

do_action( 'woocommerce_before_lost_password_form' );

if ( ! $is_send_password )
{
	?>
	<form method="post" action="" class="px-2 woocommerce-ResetPassword lost_reset_password container md-border md-border-border rounded-xs max-w-45 mx-auto pt-3/7 pb-6 lg-pb-3 md-mt-3/3 md-mb-9 flex flex-col">
		<div class="flex items-center">
			<div class="icon-identification text-xl leading-2 flex items-center justify-center flex-shrink-0"></div>
			<h3 class="text-lg leading-2/8 font-bold mx-1/4">رمز عبور خود را فراموش کرده اید؟</h3>
			<div class="flex-1 border-b border-border"></div>
		</div>
		<p class="text-lg leading-2/8 mt-2">شماره موبایل خود را وارد کنید.</p>
		<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first mb-3/5 flex flex-col">
			<label for="user_login" class="text-base leading-2/2 mb-0/7">شماره موبایل</label>
			<input class="woocommerce-Input woocommerce-Input--text input-text w-405 text-base leading-2/2 pb-0/9 pt-1 border-2 border-border rounded-xs px-1/5" type="number" name="user_login" id="user_login" autocomplete="username"/>
		</p>
		<p class="text-base leading-2/2">رمز عبور جدید به شماره شما ارسال خواهد شد.</p>
		<p class="woocommerce-form-row form-row mt-3/7">
			<input type="hidden" name="lost-password-nonce" value="<?php echo esc_attr( wp_create_nonce( 'lost_password' ) ); ?>">
			<input type="submit" class="woocommerce-Button button cursor-pointer" name="send-password" value="ارسال رمز عبور">
		</p>
	</form>
	<?php
}
