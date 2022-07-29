<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() )
{
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
	<main id="primary" class="site-main pb-5">
		<section id="product-<?php the_ID(); ?>" <?php wc_product_class( 'flex flex-col lg-flex-row items-center container mx-auto pt-3 pb-6', $product ); ?> >
			<?php
			/**
			 * Hook: woocommerce_before_single_product_summary.
			 *
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */

			do_action( 'woocommerce_before_single_product_summary' );

			/**
			 * Hook: woocommerce_single_product_summary.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			//			do_action( 'woocommerce_single_product_summary' );
			?>
			<div class="w-full lg-w-auto lg-flex-1 px-2 md-px-3 lg-px-3 flex flex-col justify-between lg-h-51">
				<div class="relative">
					<div class="flex items-center justify-between relative">
						<?php
						if ( function_exists( 'woocommerce_template_single_title' ) )
							woocommerce_template_single_title();
						?>
					</div>
					<div class="pt-2/2 pb-2 flex items-center">
						<?php
						if ( function_exists( 'woocommerce_template_single_rating' ) )
							woocommerce_template_single_rating();
						?>
					</div>
					<div class="flex flex-col lg-flex-row lg-justify-between mb-3/8">
						<div class="flex flex-col">
							<div class="flex items-center flex-wrap lg-flex-nowrap mb-0/5 lg-mb-5/5">
								<?php
								if ( function_exists( 'woocommerce_template_single_meta' ) )
									woocommerce_template_single_meta();
								?>
							</div>
						</div>
						<div class="absolute lg-static features-top right-0 lg-max-w-22">
							<?php
							if ( has_excerpt() )
							{
								$featured = explode( "\n", trim( get_the_excerpt() ) );

								$featured_lines = array_filter( $featured, 'trim' );

								?>
								<div class="text-base font-bold mb-1/5">ویژگی های کالا:</div>
								<ul class="has-disc flex flex-col pr-2 fs-features-list">
									<?php
									foreach ( $featured_lines as $line )
									{
										?>
										<li class="text-base leading-2/2"><?php echo $line ?></li>
										<?php
									}
									?>
								</ul>
								<?php
							}
							?>
						</div>
					</div>
					<?php
					if ( $product->is_type( 'simple' ) )
					{
						?>
						<div class="flex items-end relative">
							<?php
							if ( function_exists( 'woocommerce_template_single_price' ) )
								woocommerce_template_single_price();
							?>
						</div>
						<?php
					}
					if ( function_exists( 'woocommerce_template_single_add_to_cart' ) )
						woocommerce_template_single_add_to_cart();
					?>
				</div>
				<div class="mt-21 lg-mt-7/5 flex items-center justify-between relative">
					<div class="flex items-center justify-between lg-justify-start w-full lg-w-auto">
						<div class="ml-1/8 text-base">اشتراک گذاری</div>
						<div class="flex items-center space-x-reverse space-x-0/5">
							<?php $share_link = get_the_permalink(); ?>
							<a href="https://twitter.com/share?text=<?php the_title_attribute(); ?>&url=<?php echo $share_link; ?>" target="_blank" rel="nofollow noreferrer" class="icon-twitter leading-3 bg-gray-400 w-3 h-3 rounded-full text-center text-1/4 flex items-center justify-center text-white"></a>
							<a href="https://www.linkedin.com/cws/share?url=<?php echo $share_link; ?>" target="_blank" rel="nofollow noreferrer" class="icon-linkedin leading-3 text-3 flex items-center justify-center text-gray-400"></a>
							<a href="https://t.me/share/url?url=<?php echo $share_link; ?>&text=<?php the_title_attribute(); ?>" target="_blank" rel="nofollow noreferrer" class="icon-telegram leading-3 text-3 flex items-center justify-center text-gray-400"></a>
							<a href="https://api.whatsapp.com/send?text=<?php echo $share_link; ?>" data-action="share/whatsapp/share" target="_blank" rel="nofollow noreferrer" class="icon-whatsapp leading-3 text-3 flex items-center justify-center text-gray-400"></a>
						</div>
					</div>
					<?php
					if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) )
					{
						?>
						<div class="flex items-center text-base leading-2 font-bold product-code sku_wrapper absolute bottom-20 mt-0/5 lg-static left-0">
							<span class="text-gray-500 block">شناسه محصول:</span>
							<span class="text-gray-600 block mr-0/8 sku">#<?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span>
						</div>
						<?php
					}
					?>
				</div>
			</div>
			<div class="grid grid-cols-5 lg-grid-cols-1 gap-1 lg-gap-3 lg-border-r pt-5/4 lg-pt-0 lg-pr-4 px-2 md-px-3 lg-pl-0 border-border">
				<div class="flex flex-col items-center justify-center">
					<div class="mb-1/2 icon-footer-sale text-4/8 leading-4/8 flex items-center text-gray-300"></div>
					<div class="text-xs md-text-sm leading-11 text-gray-300 font-bold text-center"> بهترین قیمت بازار</div>
				</div>
				<div class="flex flex-col items-center justify-center">
					<div class="mb-1/2 icon-footer-urgent-send text-4/1 leading-4/1 flex items-center text-gray-300"></div>
					<div class="text-xs md-text-sm leading-11 text-gray-300 font-bold text-center">ارسال فوری</div>
				</div>

				<div class="flex flex-col items-center justify-center">
					<div class="mb-1/2 icon-footer-return text-4/7 leading-4/7 flex items-center text-gray-300"></div>
					<div class="text-xs md-text-sm leading-11 text-gray-300 font-bold text-center">۱۰ روز ضمانت بازگشت</div>
				</div>
				<div class="flex flex-col items-center justify-center">
					<div class="mb-1/2 icon-footer-free-send text-3/4 leading-3/4 flex items-center text-gray-300"></div>
					<div class="text-xs md-text-sm leading-11 text-gray-300 font-bold text-center"> امکان ارسال رایگان</div>
				</div>
				<div class="flex flex-col items-center justify-center">
					<div class="mb-1/2 icon-footer-insurance text-4/8 leading-4/8 flex items-center text-gray-300"></div>
					<div class="text-xs md-text-sm leading-11 text-gray-300 font-bold text-center">ضمانت اصل بودن کالا</div>
				</div>
			</div>
		</section>

		<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );

		get_template_part( 'template-parts/visited-products' );
		?>
	</main>

<?php
do_action( 'woocommerce_after_single_product' );
