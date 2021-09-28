<?php
if ( have_rows( 'slider-categories', 'option' ) )
{
	?>
	<section class="pt-4/9 pb-4/8 bg-gray-100  md-px-3 lg-px-0 relative" dir="rtl">
		<div class="container mx-auto lg-px-10 relative carousel-container">
			<div class="type-01 slick-frame simple-carousel category-carousel w-full relative mx-auto" dir="rtl">
				<?php
				while ( have_rows( 'slider-categories', 'option' ) )
				{
					the_row();
					$category     = get_sub_field( 'category' );
					$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
					$image        = wp_get_attachment_url( $thumbnail_id );
					?>

					<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="w-12 mx-1/7">
						<div class="w-full h-full flex flex-col items-center justify-center">
							<img class="object-fit object-center w-8 h-8" src="<?php echo esc_url( $image ); ?>" alt="<?php echo $category->name; ?>"/>
							<div class="text-base lg-text-medium font-bold mt-2/5 leading-2/5 text-gray-700 text-center"><?php echo $category->name; ?></div>
						</div>
					</a>
				<?php }
				?>
			</div>
			<div class="custom-hidden-m simple-next absolute top-half left-3 text-lg leading-1/8 icon-angle-down transform rotate-90 -translate-y-1/2 cursor-pointer"></div>
			<div class="custom-hidden-m simple-prev absolute top-half right-3 text-lg leading-1/8 icon-angle-down transform -rotate-90 -translate-y-1/2 cursor-pointer"></div>
		</div>
	</section>
	<?php
}
