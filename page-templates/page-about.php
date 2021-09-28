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
 * Template Name: About
 */
get_header();

while ( have_posts() )
{
	the_post();
	?>
	<main id="primary" class="site-main">
		<?php
		get_template_part( "template-parts/breadcrumb" );
		get_template_part( "template-parts/about/about-intro" );
		get_template_part( "template-parts/about/about-features" );
		get_template_part( "template-parts/about/about-advantage" );
		get_template_part( "template-parts/about/about-team" );
		?>
	</main>
	<?php
}

get_footer();