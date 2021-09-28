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
 * Template Name: Arta Home Blog
 */

get_header();
?>
	<main id="primary" class="site-main">
		<?php
		get_template_part( "template-parts/breadcrumb" );
		get_template_part( "page-templates/blog/home/home-top-section" );
		get_template_part( "page-templates/blog/home/home-mid-section" );
		if ( have_rows( 'horizontal-banner-first-row', 'option' ) )
		{
			?>
			<section class="grid grid-cols-1 lg-grid-cols-2 gap-1/6 lg-gap-3 pt-3/2 lg-pt-7/5 container mx-auto px-2 md-px-3 lg-px-0">
				<?php
				while ( have_rows( 'horizontal-banner-first-row', 'option' ) )
				{
					the_row();
					$image = get_sub_field( 'image' );
					?>
					<a href="<?php echo get_sub_field( 'url' ); ?>" class="rounded-xs overflow-hidden lg-h-18">
						<img class="object-fill object-center w-full lg-h-full rounded-xs" src="<?php echo esc_url( $image[ 'url' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>"/>
					</a>
					<?php
				}
				?>
			</section>
			<?php
		}
		get_template_part( "page-templates/blog/home/home-bottom-section" );
		?>
	</main>
<?php
get_footer();
