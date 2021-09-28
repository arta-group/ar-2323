<section class="pt-5/7 pb-6/4">
	<div class="container mx-auto">
		<div class="flex flex-row">

			<aside class="hidden lg-block w-296 pt-1/9 flex-shrink-0 ml-3/2">

				<ul class="flex flex-col w-full">
					<li class="h-8 mb-2/9 flex flex-row bg-gray-100 rounded-xs">
						<div class="flex flex-col items-center justify-center bg-secondary-main rounded-xs w-9 h-full icon-footer-free-send text-3/5 leading-3/5"></div>
						<div class="flex-1 p-3 text-1/4 leading-2/2 font-bold text-gray-main">ارسال رایگان</div>
					</li>
					<li class="h-8 mb-2/9 flex flex-row bg-gray-100 rounded-xs">
						<div class="flex flex-col items-center justify-center bg-secondary-main rounded-xs w-9 h-full icon-footer-return text-4/7 leading-4/7"></div>
						<div class="flex-1 p-3 text-1/4 leading-2/2 font-bold text-gray-main"> ۱۰ روز ضمانت بازگشت</div>
					</li>
					<li class="h-8 mb-2/9 flex flex-row bg-gray-100 rounded-xs">
						<div class="flex flex-col items-center justify-center bg-secondary-main rounded-xs w-9 h-full icon-footer-backup text-4/8 leading-4/8"></div>
						<div class="flex-1 p-3 text-1/4 leading-2/2 font-bold text-gray-main">مشاوره تخصصی رایگان</div>
					</li>
					<li class="h-8 flex flex-row bg-gray-100 rounded-xs">
						<div class="flex flex-col items-center justify-center bg-secondary-main rounded-xs w-9 h-full icon-footer-sale text-4/8 leading-4/8"></div>
						<div class="flex-1 p-3 text-1/4 leading-2/2 font-bold text-gray-main">بهترین قیمت بازار</div>
					</li>
				</ul>

				<?php
				if ( fs_is_active_amazing_sales() )
				{
					?>
					<div class="mt-7/9 grid grid-cols-1 gap-3/2">
						<?php
						if ( have_rows( 'sidebar-small-banners', 'option' ) )
						{
							while ( have_rows( 'sidebar-small-banners', 'option' ) )
							{
								the_row();
								$image = get_sub_field( 'image' );
								?>
								<a href="<?php echo get_sub_field( 'url' ); ?>" class="h-18 w-full rounded-xs">
									<img class="object-fit object-center rounded-xs" src="<?php echo esc_url( $image[ 'url' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>"/>
								</a>
								<?php
							}
						}
						?>
					</div>
					<?php
				}
				?>
			</aside>

			<div class="lg-flex-1 w-full lg-w-auto lg-max-w-7xl">
				<?php get_template_part( 'template-parts/index/new-products-carousels/new-products-carousel' ); ?><?php get_template_part( 'template-parts/index/new-products-carousels/discount-carousel' ); ?>
			</div>

		</div>
	</div>
</section>