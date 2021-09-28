<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package FOUR SIDES
 */
get_header();
?>
	<main id="primary" class="site-main">
		<?php get_template_part( "template-parts/breadcrumb" ); ?>
		<section class="error-404 not-found mb-15 md-mb-0 pb-5 md-pb-22 pt-3 md-pt-5 md-pt-15 container mx-auto relative">
			<div class="flex flex-col lg-flex-row items-center justify-center px-2 lg-px-21 ">
				<div class="flex-1 flex flex-col justify-center lg-pl-15 flex-shrink-0">
					<p class="text-2/4 text-gray-main leading-15 font-bold">صفحه ای که به دنبال آن بودید</p>
					<p class="text-4 text-gray-main font-black mb-3"> متاسفانه پیدا نشد! </p>
					<div class="flex flex-col absolute top-full md-top-auto bottom-5 lg-static">
						<form action="<?php echo esc_url( home_url( '/' ) ) ?>" method="get" class="border-2 border-border w-30 h-5 rounded-xs flex flex-row">
							<input type="hidden" name="type" value="product"/>
							<input class="h-full flex-1 text-base leading-20 text-gray-600 pr-2 rounded-xs" type="search" name="s" placeholder="جستجو در محصولات ..."/>
							<button type="submit" class="w-4/5 h-full text-xl icon-search text-gray-500 flex items-center justify-center"></button>
						</form>
						<a href="<?php echo esc_url( site_url( '/' ) ); ?>" class="flex items-center text-primary-main mt-2/5">
							<span class="flex items-center icon-right-arrow text-xs leading-1/6 h-1/6 transform rotate-180"></span>
							<span class="block text-1/4 mr-1">بازگشت به صفحه اصلی</span> </a>
					</div>
				</div>
				<div class="flex items-center justify-center flex-shrink-0 w-full md-w-41">
					<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/svg/404.svg' ?>" alt="" class="object-center w-41 h-44">
				</div>
			</div>
		</section><!-- .error-404 -->
	</main><!-- #main -->
<?php
get_footer();