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
 * Template Name: Arta brands
 */

$display_shop = false;

if ( isset( $_GET[ 'post_type' ] ) &&  $_GET[ 'post_type' ] == 'product' )
{
	if ( isset( $_GET[ 'type' ] ) &&  $_GET[ 'type' ] == 'product' )
		$display_shop = true;
	else
	{
		wp_redirect( home_url( 'shop' ) );
		exit;
	}
}

get_header();
$term_id = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) )->term_id;
?>
	<main id="primary" class="site-main">
		<?php
		if ( $display_shop )
			get_template_part( "woocommerce/archive-product" );
		else
		{
			get_template_part( "template-parts/breadcrumb" );
			get_template_part( "page-templates/brands/intro", '', [ 'term_id' => $term_id ] );
			get_template_part( "page-templates/brands/banners", '', [ 'term_id' => $term_id ] );
			get_template_part( "page-templates/brands/new-products", '', [ 'term_id' => $term_id ] );
			get_template_part( "page-templates/brands/top-off-sales", '', [ 'term_id' => $term_id ] );
			get_template_part( "page-templates/brands/top-sales", '', [ 'term_id' => $term_id ] );
		}
		?>
	</main>
<?php
get_footer();