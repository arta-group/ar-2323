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
 * Template Name: Arta Archive
 */

get_header();
?>
	<main id="primary" class="site-main">
		<?php
		get_template_part( "template-parts/breadcrumb" );
		?>
		<section class="flex container mx-auto pt-1 lg-pt-3/3 pb-10">
			<?php
			get_template_part( "template-parts/search/search-result-main" );
			get_template_part( "template-parts/search/search-result-sidebar" );
			?>
		</section>
	</main>
<?php
get_footer();
