<?php
if ( have_rows( 'brands', 'option' ) )
{
	?>
	<section class="py-5 lg-pt-6/7 lg-pb-9  lg-px-0 container mx-auto relative" dir="rtl">
		<div class="flex items-center justify-center">
			<div class="text-center text-lg lg-text-2/4 leading-2/4 lg-leading-3/8 text-gray-600 mb-2/4 pb-1/6 title font-bold">برندهایی که کار می کنیم</div>
		</div>
		<div class="lg-px-10 relative carousel-container">
			<div class="type-01 slick-frame brands-carousel relative px-1/2 mx-auto w-full" dir="rtl">
				<?php
				while ( have_rows( 'brands', 'option' ) )
				{
					the_row();
					$image = get_sub_field( 'image' );
					?>
					<div class="w-12 mx-2 lg-mx-3/3">
						<div class="w-full h-full flex items-center justify-center">
							<a href="<?php echo esc_url( get_sub_field( 'url' ) ); ?>">
								<img class="object-fit object-center" src="<?php echo esc_url( $image[ 'url' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>"/>
							</a>
						</div>
					</div>
					<?php
				}
				?>
			</div>
            <div class="custom-hidden-m simple-next absolute top-half left-3 text-lg leading-1/8 icon-angle-down transform rotate-90 -translate-y-1/2 cursor-pointer"></div>
            <div class="custom-hidden-m simple-prev absolute top-half right-3 text-lg leading-1/8 icon-angle-down transform -rotate-90 -translate-y-1/2 cursor-pointer"></div>
        </div>
	</section>
	<?php
}
