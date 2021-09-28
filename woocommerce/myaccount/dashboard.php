<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>
<div class="border-b-2 border-border ">
	<h2 class="text-2/4 inline-block leading-3/8 pb-1/6 title text-gray-main">
		پیشخوان </h2>
</div>
<div class="mt-2/6">
	<?php
	$first_name = $current_user->first_name;
	$last_name  = $current_user->last_name;

	if ( ! empty( $first_name ) || ! empty( $last_name ) )
		$full_name = $first_name . ' ' . $last_name;
	else
		$full_name = $current_user->display_name;
	?>
	<div class="text-base leading-2/2 flex items-center">
		سلام<span class="inline-block mx-0/3 font-bold"> <?php echo esc_html( $full_name ); ?> </span> (
		<span class="inline-block mx-0/3 font-bold"> <?php echo esc_html( $full_name ); ?> </span> نیستید؟
		<a href="<?php echo esc_url( wc_logout_url() ); ?>" class="font-bold inline-block text-primary-main mx-0/3"> خارج شوید </a> )
	</div>

	<div class="text-base leading-2/2 mt-1/1">
		<?php
		/* translators: 1: Orders URL 2: Address URL 3: Account URL. */
		$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">billing address</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
		if ( wc_shipping_enabled() )
		{
			/* translators: 1: Orders URL 2: Addresses URL 3: Account URL. */
			$dashboard_desc = __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' );
		}
		printf( wp_kses( $dashboard_desc, $allowed_html ), esc_url( wc_get_endpoint_url( 'orders' ) ), esc_url( wc_get_endpoint_url( 'edit-address' ) ), esc_url( wc_get_endpoint_url( 'edit-account' ) ) );
		?>
	</div>
</div>
<div class="grid grid-cols-2 md-grid-cols-4 gap-1/6 lg-gap-3/7 mt-2/8">
	<?php
	$dashboard_menus = fs_arta_my_account_menu();
	foreach ( $dashboard_menus as $endpoint => $values )
	{
		if ( isset( $values[ 'dashboard_menu' ] ) && $values[ 'dashboard_menu' ] )
		{
			?>
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
				<div class="py-3 lg-px-1 flex flex-col items-center border border-border rounded-xs">
					<div class="text-primary-main flex-shrink-0 mb-1/7 text-3 leading-3 h-3 <?php echo $values[ 'icon' ]; ?>"></div>
					<div class="text-base lg-text-lg leading-2/8 text-gray-main text-center"><?php echo $values[ 'label' ]; ?></div>
				</div>
			</a>
			<?php
		}
	}
	?>
</div>
