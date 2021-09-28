<section class="py-3 lg-py-4/9 bg-gray-100 px-2 md-px-3 lg-px-0">
	<div class="container mx-auto">
		<div class="grid grid-cols-4 lg-grid-cols-12 lg-grid-rows-2 gap-1/5 lg-gap-2/9">

			<div class="w-full col-span-4 lg-row-span-2 lg-col-span-5 rounded-xs" dir="rtl">
				<div class="carousel slick-frame banner rounded-xs" data-slick='{"slidesToShow":1, "slidesToScroll": 1 ,"dots": true, "arrows" : false ,"infinite": true,"speed": 600 , "rtl" : true, "autoplay" : true, "autoplaySpeed" : 2000}'>
					<?php
					if ( have_rows( 'slider', 'option' ) )
					{
						while ( have_rows( 'slider', 'option' ) )
						{
							the_row();
							$image = get_sub_field( 'image' );
							?>
							<a href="<?php echo get_sub_field( 'url' ); ?>">
								<img class="object-fit object-center rounded-xs" src="<?php echo esc_url( $image[ 'url' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>" width="515" height="495"/>
							</a>
							<?php
						}
					}
					?>
				</div>
			</div>

			<?php
			if ( have_rows( 'vertical-banner', 'option' ) )
			{
				while ( have_rows( 'vertical-banner', 'option' ) )
				{
					the_row();
					$image = get_sub_field( 'image' );
					?>
					<a href="<?php echo get_sub_field( 'url' ); ?>" class="custom-hidden-m h-234 lg-block row-span-2 col-span-3 rounded-xs">
						<img class="object-fit object-center rounded-xs" src="<?php echo esc_url( $image[ 'url' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>" width="296" height="495"/>
					</a>
					<?php
				}
			}

			if ( have_rows( 'horizontal-banner', 'option' ) )
			{
				while ( have_rows( 'horizontal-banner', 'option' ) )
				{
					the_row();
					$image = get_sub_field( 'image' );
					?>
					<a href="<?php echo get_sub_field( 'url' ); ?>" class="h-auto h-232 lg-col-span-4 col-span-2 rounded-xs">
						<img class="object-fit object-center w-full h-full rounded-xs" src="<?php echo esc_url( $image[ 'url' ] ); ?>" alt="<?php echo esc_attr( $image[ 'alt' ] ); ?>" width="407" height="232"/>
					</a>
					<?php
				}
			}
			?>
		</div>
	</div>
</section>
