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
 *
 * Template Name: Arta Page
 */

get_header();

while ( have_posts() )
{
	the_post();
	?>
	<main id="primary" class="site-main">
		<?php
		if ( function_exists( 'woocommerce_breadcrumb' ) )
			woocommerce_breadcrumb();
		?>
		<section class="container mx-auto pb-6 md-pb-10 px-2 lg-px-0">
			<div class="mb-0">
				<div class="border-b border-border flex items-center">
					<h2 class="lg-text-2/4 text-2 inline-block text-center md-text-right leading-3/8 pb-1/5 title text-gray-main font-bold">
						<?php the_title(); ?>
					</h2>
				</div>
			</div>
			<div class="mb-4/2 text-base leading-2/8 text-justify lg-text-right sample-page">
				<?php the_content(); ?>
			</div>
		</section>
	</main>
	<?php
}

get_footer();