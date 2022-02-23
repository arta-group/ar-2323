<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FOUR SIDES
 */

get_header();
?>

	<main id="primary" class="site-main">

		<!-- top banner carousel section -->
		<?php get_template_part( 'template-parts/index/banner-grid-section' ); ?>
		<!-- /top banner carousel section -->

		<!-- new products section -->
		<?php get_template_part( 'template-parts/index/new-products-section' ); ?>
		<!-- /new products section -->

		<!-- category carousel section -->
		<?php get_template_part( 'template-parts/index/category-carousel' ); ?>
		<!-- /category carousel section -->

		<!-- top sale carousel w/banner section -->
		<?php get_template_part( 'template-parts/index/top-sales-section' ); ?>
		<!-- /top sale carousel w/banner section -->

		<section class="pb-6/4" dir="rtl">
			<div class="container mx-auto carousel-container">
				<div class="grid grid-cols-1 lg-grid-cols-2 gap-2 lg-gap-3/2 px-2 md-px-3 lg-px-0">
					<?php
					if ( have_rows( 'horizontal-banner-first-row', 'option' ) )
					{
						while ( have_rows( 'horizontal-banner-first-row', 'option' ) )
						{
							the_row();
							$image = get_sub_field( 'image' );
							?>
							<a href="<?php echo get_sub_field( 'url' ); ?>" class="rounded-xs overflow-hidden h-auto lg-h-18">
								<img class="object-fit object-center w-full lg-h-full" src="<?php echo esc_url( $image[ 'url' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>"/>
							</a>
							<?php
						}
					}
					?>
				</div>
			</div>
		</section>

		<!-- top lamps carousel section -->
		<?php
		$products_category = get_field( 'first-row-category', 'option' );
		get_template_part( 'template-parts/index/products-section-gray', '', [ 'products_category' => $products_category ] );
		?>
		<!-- /top lamps carousel section -->

		<!-- Chandelier carousel w/banner section -->
		<?php
		$products_category = get_field( 'second-row-category', 'option' );
		get_template_part( 'template-parts/index/products-section-white', '', [ 'products_category' => $products_category, 'position' => 'first' ] );
		?>
		<!-- /Chandelier carousel w/banner section -->

		<section class="pb-5/7" dir="rtl">
			<div class="container mx-auto carousel-container">
				<div class="grid grid-cols-1 lg-grid-cols-2 gap-2 lg-gap-3/2 px-2 md-px-3 lg-px-0">
					<?php
					if ( have_rows( 'horizontal-banner-second-row', 'option' ) )
					{
						while ( have_rows( 'horizontal-banner-second-row', 'option' ) )
						{
							the_row();
							$image = get_sub_field( 'image' );
							?>
							<a href="<?php echo get_sub_field( 'url' ); ?>" class="rounded-xs overflow-hidden h-auto lg-h-18">
								<img class="object-fit object-center w-full lg-h-full" src="<?php echo esc_url( $image[ 'url' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>"/>
							</a>
							<?php
						}
					}
					?>
				</div>
			</div>
		</section>

		<!-- recommends carousel section -->
		<?php
		$products_category = get_field( 'third-row-category', 'option' );
		get_template_part( 'template-parts/index/products-section-white', '', [ 'products_category' => $products_category, 'position' => 'second' ] );
		?>
		<!-- /recommends carousel section -->

		<!-- brands carousel section -->
		<?php get_template_part( 'template-parts/index/blog-section' ); ?>
		<!-- /brands carousel section -->

		<!-- brands carousel section -->
		<?php get_template_part( 'template-parts/index/brands-section' ); ?>
		<!-- /brands carousel section -->

	</main><!-- #main -->

<?php
get_footer();
