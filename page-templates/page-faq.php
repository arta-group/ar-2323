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
 * Template Name: Arta Faq
 */

get_header();

while ( have_posts() )
{
	the_post();
	?>
	<main id="primary" class="site-main">
		<?php get_template_part( "template-parts/breadcrumb" ); ?>

		<section class="flex flex-col lg-flex-row pt-3/3 pb-10 container mx-auto ">
			<div class="flex-shrink-0 w-full w-296 ml-3/2 overflow-hidden pr-2 md-pr-3 lg-pr-0 lg-overflow-visible">
				<ul class="flex flex-row w-full overflow-x-auto faq-nav lg-overflow-visible lg-flex-col c-tab-menu space-x-reverse space-x-1 lg-space-x-0  lg-space-y-1 sticky top-4 faq">
					<?php
					$iteration = 1;
					while ( have_rows( 'faq' ) )
					{
						the_row();
						?>
						<li class="bg-gray-100 rounded-xs flex-shrink-0 relative<?php echo ( $iteration == 1 ) ? ' active' : ''; ?>">
							<a href="#faq-group-<?php echo $iteration; ?>" data-id="faq-group-<?php echo $iteration; ?>" class="py-1 pl-1 md-py-1/8 md-pl-1/6 flex items-center w-full">
								<div class="flex items-center justify-center w-6">
									<img class="object-fill object-center inline-block transform scale-75" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/svg/Question.svg"; ?>" alt=""/>
								</div>
								<div class="text-base md-text-medium leading-2/4 text-gray-700 font-bold"><?php echo get_sub_field( 'group-title' ); ?></div>
							</a>
						</li>
						<?php
						$iteration ++;
					}
					?>
					<li class="rounded-xs flex-shrink-0 relative w-1 h-2 md-w-2 "></li>
				</ul>
			</div>
			<div class="c-content-wrapper grid grid-cols-1 flex-1 gap-3 mt-3 lg-mt-0 px-2 md-px-3 lg-px-0">
				<?php
				$iteration = 1;
				while ( have_rows( 'faq' ) )
				{
					the_row();
					?>
					<div class="content w-full rounded-xs border border-border px-2 md-px-4 py-1/5 md-pt-2/2 md-pb-2/6" id="faq-group-<?php echo $iteration; ?>">
						<div class="text-2 lg-text-2/6 text-gray-700 leading-2/4 lg-leading-4/4 pb-1/2 flex items-center font-normal">
							<img class="object-fill object-center ml-2 inline-block" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/svg/Question.svg"; ?>" alt=""/>
							<span class="fs-content-header"><?php echo get_sub_field( 'group-title' ); ?></span>
						</div>
						<div class="divide-y divide-border">
							<?php
							while ( have_rows( 'questions' ) )
							{
								the_row();
								?>
								<div class="faq accordion">
									<div class="accordion-head flex flex-row items-center pt-1/8 pb-2 cursor-pointer">
										<div class="flex-1 text-gray-600 accordion-title text-base md-text-medium leading-2/4 font-bold"><?php echo get_sub_field( 'question' ); ?></div>
										<div class="icon-plus accordion-icon text-1/7 leading-1/7 text-gray-600 flex items-center justify-center mr-2"></div>
									</div>
									<div class="accordion-body">
										<p class="pb-3/7 text-base leading-2/8 text-gray-500 text-justify lg-text-right"><?php echo nl2br( get_sub_field( 'answer' ) ); ?></p>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<?php
					$iteration ++;
				}
				?>
			</div>
		</section>
	</main>
	<?php
}

get_footer();