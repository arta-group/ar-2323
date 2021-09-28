<?php
/**
 * Shop breadcrumb
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! empty( $breadcrumb ) )
{
	?>
	<section class="woocommerce-breadcrumb">
		<div class="container mx-auto px-2 lg-px-0">
			<ul class="flex flex-row items-center c-breadcrumb flex-wrap ">
				<?php
				foreach ( $breadcrumb as $key => $crumb )
				{
					if ( $key == 0 )
					{
						?>
						<li class="flex-shrink-0 mb-1">
							<a href="<?php echo esc_url( $crumb[ 1 ] ); ?>" class="flex items-center">
								<span class="inline-block icon-address text-1/6 leading-1/6 h-1/6"></span> </a>
						</li>
						<?php
					}
					elseif ( ! empty( $crumb[ 1 ] ) && sizeof( $breadcrumb ) !== $key + 1 )
					{
						?>
						<li class="flex-shrink-0 mb-1">
							<?php
							if ( is_checkout() )
							{
								$crumb[ 1 ] = site_url( '/my-account/orders' );
								$crumb[ 0 ] = 'سفارش ها';
							}

							if ( is_account_page() )
								$crumb[ 0 ] = 'حساب کاربری';

							?>
							<a href="<?php echo esc_url( $crumb[ 1 ] ) ?>"><?php echo esc_html( $crumb[ 0 ] ) ?></a>
						</li>
						<?php
					}
					else
					{
						if ( empty( $crumb[ 1 ] ) && sizeof( $breadcrumb ) !== $key + 1 )
						{
							?>
							<li class="flex-shrink-0 mb-1"><?php echo esc_html( $crumb[ 0 ] ); ?></li>
							<?php
						}
						else
						{
							?>
							<li class="flex-1 truncate mb-1"><?php echo esc_html( $crumb[ 0 ] ); ?></li>
							<?php
						}
					}
				}
				?>
			</ul>
		</div>
	</section>
	<?php
}