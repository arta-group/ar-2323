<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$user_id = get_current_user_id();

if ( isset( $_POST['billing_first_name'] ) ) {

	update_user_meta( $user_id, 'billing_first_name', $_POST['billing_first_name'] );
	update_user_meta( $user_id, 'billing_last_name', $_POST['billing_last_name'] );
	update_user_meta( $user_id, 'billing_company', $_POST['billing_company'] );
	update_user_meta( $user_id, 'billing_country', $_POST['billing_country'] );
	update_user_meta( $user_id, 'billing_address_1', $_POST['billing_address_1'] );
	update_user_meta( $user_id, 'billing_state', $_POST['billing_state'] );
	update_user_meta( $user_id, 'billing_city', $_POST['billing_city'] );
	update_user_meta( $user_id, 'billing_postcode', $_POST['billing_postcode'] );
	update_user_meta( $user_id, 'billing_phone', $_POST['billing_phone'] );
	update_user_meta( $user_id, 'billing_email', $_POST['billing_email'] );
	update_user_meta( $user_id, 'billing_melli_code', $_POST['billing_melli_code'] );
}

$billing_state = get_user_meta( $user_id, 'billing_state', true );
$billing_city  = get_user_meta( $user_id, 'billing_city', true );

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );
?>
<div class="border-b-2 border-border mb-2/6">
    <h2 class="text-2/4 inline-block leading-3/8 pb-1/6 title text-gray-main">
        آدرس ها </h2>
</div>
<?php

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
    <style>
        button {
            background-color: #fed100;
            padding: 14px;
            border-radius: 8px;
            font-size: 17px;
        }
    </style>

    <form method="post" action="">
        <div class="woocommerce-address-fields__field-wrapper">
            <p class="form-row form-row-first validate-required">
                <label for="billing_first_name" class="">نام<abbr class="required" title="ضروری">*</abbr></label>
                <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text" name="billing_first_name" placeholder="" required
                       value="<?php echo get_user_meta( $user_id, 'billing_first_name', true ); ?>">
                </span>
            </p>
            <p class="form-row form-row-last validate-required">
                <label for="billing_last_name" class="">نام خانوادگی<abbr class="required"
                                                                          title="ضروری">*</abbr></label>
                <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text " name="billing_last_name" placeholder="" required
                       value="<?php echo get_user_meta( $user_id, 'billing_last_name', true ); ?>">
                </span>
            </p>
            <p class="form-row form-row-wide">
                <label for="billing_company" class="">نام شرکت&nbsp;<span class="optional">(اختیاری)</span></label>
                <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text " name="billing_company" placeholder=""
                       value="<?php echo get_user_meta( $user_id, 'billing_company', true ); ?>">
                </span>
            </p>
            <input type="hidden" name="billing_country" value="IR">
            <p class="form-row form-row-wide address-field validate-required">
                <label for="billing_address_1" class="">آدرس خیابان&nbsp;<abbr class="required"
                                                                               title="ضروری">*</abbr></label>
                <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text " name="billing_address_1" placeholder="نام خیابان و پلاک خانه" required
                       value="<?php echo get_user_meta( $user_id, 'billing_address_1', true ); ?>">
                </span>
            </p>
            <p class="form-row form-row-wide address-field validate-required validate-state">
                <label for="billing_state" class="">استان&nbsp;<abbr class="required" title="ضروری">*</abbr></label>
                <span class="woocommerce-input-wrapper">
                <select name="billing_state" id="billing_state" class="state_select select2-hidden-accessible"
                        autocomplete="address-level1"
                        data-placeholder="یک گزینه انتخاب نمائید…"
                        data-input-classes="" data-label="استان" tabindex="-1"
                        aria-hidden="true">
					<option value="">یک گزینه انتخاب نمائید…</option>
                    <option value="THR" <?php echo ( $billing_state == 'THR' ) ? 'selected="selected"' : '' ?>>تهران</option>
                    <option value="ABZ" <?php echo ( $billing_state == 'ABZ' ) ? 'selected="selected"' : '' ?>>البرز</option>
                    <option value="ADL" <?php echo ( $billing_state == 'ADL' ) ? 'selected="selected"' : '' ?>>اردبیل</option>
                    <option value="EAZ" <?php echo ( $billing_state == 'EAZ' ) ? 'selected="selected"' : '' ?>>آذربایجان شرقی</option>
                    <option value="WAZ" <?php echo ( $billing_state == 'WAZ' ) ? 'selected="selected"' : '' ?>>آذربایجان غربی</option>
                    <option value="BHR" <?php echo ( $billing_state == 'BHR' ) ? 'selected="selected"' : '' ?>>بوشهر</option>
                    <option value="CHB" <?php echo ( $billing_state == 'CHB' ) ? 'selected="selected"' : '' ?>>چهارمحال و بختیاری</option>
                    <option value="FRS" <?php echo ( $billing_state == 'FRS' ) ? 'selected="selected"' : '' ?>>فارس</option>
                    <option value="GIL" <?php echo ( $billing_state == 'GIL' ) ? 'selected="selected"' : '' ?>>گیلان</option>
                    <option value="GLS" <?php echo ( $billing_state == 'GLS' ) ? 'selected="selected"' : '' ?>>گلستان</option>
                    <option value="HDN" <?php echo ( $billing_state == 'HDN' ) ? 'selected="selected"' : '' ?>>همدان</option>
                    <option value="HRZ" <?php echo ( $billing_state == 'HRZ' ) ? 'selected="selected"' : '' ?>>هرمزگان</option>
                    <option value="ILM" <?php echo ( $billing_state == 'ILM' ) ? 'selected="selected"' : '' ?>>ایلام</option>
                    <option value="ESF" <?php echo ( $billing_state == 'ESF' ) ? 'selected="selected"' : '' ?>>اصفهان</option>
                    <option value="KRN" <?php echo ( $billing_state == 'KRN' ) ? 'selected="selected"' : '' ?>>کرمان</option>
                    <option value="KRH" <?php echo ( $billing_state == 'KRH' ) ? 'selected="selected"' : '' ?>>کرمانشاه</option>
                    <option value="NKH" <?php echo ( $billing_state == 'NKH' ) ? 'selected="selected"' : '' ?>>خراسان شمالی</option>
                    <option value="RKH" <?php echo ( $billing_state == 'RKH' ) ? 'selected="selected"' : '' ?>>خراسان رضوی</option>
                    <option value="SKH" <?php echo ( $billing_state == 'SKH' ) ? 'selected="selected"' : '' ?>>خراسان جنوبی</option>
                    <option value="KHZ" <?php echo ( $billing_state == 'KHZ' ) ? 'selected="selected"' : '' ?>>خوزستان</option>
                    <option value="KBD" <?php echo ( $billing_state == 'KBD' ) ? 'selected="selected"' : '' ?>>کهگیلویه و بویراحمد</option>
                    <option value="KRD" <?php echo ( $billing_state == 'KRD' ) ? 'selected="selected"' : '' ?>>کردستان</option>
                    <option value="LRS" <?php echo ( $billing_state == 'LRS' ) ? 'selected="selected"' : '' ?>>لرستان</option>
                    <option value="MKZ" <?php echo ( $billing_state == 'MKZ' ) ? 'selected="selected"' : '' ?>>مرکزی</option>
                    <option value="MZN" <?php echo ( $billing_state == 'MZN' ) ? 'selected="selected"' : '' ?>>مازندران</option>
                    <option value="GZN" <?php echo ( $billing_state == 'GZN' ) ? 'selected="selected"' : '' ?>>قزوین</option>
                    <option value="QHM" <?php echo ( $billing_state == 'QHM' ) ? 'selected="selected"' : '' ?>>قم</option>
                    <option value="SMN" <?php echo ( $billing_state == 'SMN' ) ? 'selected="selected"' : '' ?>>سمنان</option>
                    <option value="SBN" <?php echo ( $billing_state == 'SBN' ) ? 'selected="selected"' : '' ?>>سیستان و بلوچستان</option>
                    <option value="YZD" <?php echo ( $billing_state == 'YZD' ) ? 'selected="selected"' : '' ?>>یزد</option>
                    <option value="ZJN" <?php echo ( $billing_state == 'ZJN' ) ? 'selected="selected"' : '' ?>>زنجان</option>
                </select>
            </p>
            <p class="form-row form-row-wide address-field validate-required">
                <label for="billing_city" class="">شهر&nbsp;<abbr class="required" title="ضروری">*</abbr></label>
                <span class="woocommerce-input-wrapper">

            <select name="billing_city" id="billing_city" class="state_select select2-hidden-accessible"
                    autocomplete="address-level1"
                    data-placeholder="یک گزینه انتخاب نمائید…"
                    data-input-classes="" data-label="شهر" tabindex="-1"
                    aria-hidden="true">
                <option value="<?php echo $billing_city ?>"><?php echo $billing_city ?></option>
            </select>
                </span>
            </p>
            <p class="form-row form-row-wide address-field validate-required validate-postcode">
                <label for="billing_postcode" class="">کد پستی&nbsp;<abbr class="required"
                                                                          title="ضروری">*</abbr></label>
                <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text " name="billing_postcode" placeholder="" required
                       value="<?php echo get_user_meta( $user_id, 'billing_postcode', true ); ?>">
                </span>
            </p>
            <p class="form-row form-row-wide validate-required validate-phone">
                <label for="billing_phone" class="">تلفن&nbsp;<abbr class="required" title="ضروری">*</abbr></label>
                <span class="woocommerce-input-wrapper">
                <input type="tel" class="input-text " name="billing_phone" placeholder="" required
                       value="<?php echo get_user_meta( $user_id, 'billing_phone', true ); ?>">
                </span>
            </p>
            <p class="form-row form-row-wide validate-required validate-email">
                <label for="billing_email" class="">آدرس ایمیل&nbsp;<abbr class="required"
                                                                          title="ضروری">*</abbr></label>
                <span class="woocommerce-input-wrapper">
                <input type="email" class="input-text " name="billing_email" placeholder="" required
                       value="<?php echo get_user_meta( $user_id, 'billing_email', true ); ?>">
                </span>
            </p>
            <p class="form-row my-field-class form-row-wide" id="billing_melli_code_field" data-priority="">
                <label for="billing_melli_code" class="">کد ملی&nbsp;<span class="optional">(اختیاری)</span></label>
                <span class="woocommerce-input-wrapper">
                <input type="text" class="input-text " name="billing_melli_code" placeholder=""
                       value="<?php echo get_user_meta( $user_id, 'billing_melli_code', true ); ?>">
                </span>
            </p>
            <p>
                <button type="submit" id="place_order">ذخیره تغییرات</button>
            </p>
        </div>

    </form>

    <!--	--><?php //wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>

    <form method="post">

        <h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h3><?php // @codingStandardsIgnoreLine ?>

        <div class="woocommerce-address-fields">
			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>


            <div class="woocommerce-address-fields__field-wrapper">
				<?php
				foreach ( $address as $key => $field ) {
					woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
				}
				?>
            </div>

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

            <p>
                <button type="submit" class="button" name="save_address"
                        value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>"><?php esc_html_e( 'Save address', 'woocommerce' ); ?></button>
				<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
                <input type="hidden" name="action" value="edit_address"/>
            </p>
        </div>

    </form>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
