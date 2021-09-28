<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FOUR SIDES
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

		<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MWP8R9C');</script>
<!-- End Google Tag Manager -->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MWP8R9C"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<header id="masthead" class="site-header border-border<?php echo ! is_front_page() && ! is_home() ? ' border-b' : ''; ?>">
			<?php
			$notification = get_field( 'notification-text', 'option' );
			if ( $notification )
			{
				?>
				<div class="c-header-popup">
					<?php
					$notification_url = get_field( 'notification-url', 'option' );
					echo $notification_url ? '<p><a href="' . $notification_url . '">' . $notification . '</a></p>' : '<p>' . $notification . '</p>';
					?>
				</div>
				<?php
			}
			?>
			<div class="container mx-auto">

				<!-- top section -->
				<?php get_template_part( 'template-parts/header/top-section' ); ?>
				<!-- /top section -->

				<!-- bottom section -->
				<?php get_template_part( 'template-parts/header/bottom-section' ); ?>
				<!-- bottom section -->

				<!-- mini cart section -->
				<?php
				if ( function_exists( 'woocommerce_mini_cart' ) )
					woocommerce_mini_cart();
				?>
				<!-- mini cart section -->

			</div>

		</header><!-- #masthead -->