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
 * Template Name: Arta product amazing
 */

get_header();
?>

    <main id="primary" class="site-main">
        <?php
        get_template_part( "template-parts/breadcrumb" );
        ?>
        <section class="flex container mx-auto pt-1 md-pt-3 lg-10">
            <?php
            get_template_part( "page-templates/blog/amazing/amazing-sidebar" );
            get_template_part( "page-templates/blog/amazing/amazing-main" );
            ?>
        </section>
    </main>

<?php
get_footer();