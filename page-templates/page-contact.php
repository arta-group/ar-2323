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
 * Template Name: Contact
 */

get_header();

while ( have_posts() )
{
	the_post();
	?>
	<main id="primary" class="site-main">
		<?php
		get_template_part( "template-parts/breadcrumb" );
		?>
		<section class="grid grid-cols-1 gap-11 container mx-auto pt-1 md-pt-3/3 pb-3 md-pb-10">
			<?php
			get_template_part( "template-parts/contact/contact-info" );
			get_template_part( "template-parts/contact/contact-socials" );
			get_template_part( "template-parts/contact/contact-form" );
			?>
		</section>
	</main><!-- #main -->
	<?php
}

get_footer();