<?php
$args = array(
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 5
);

$posts = get_posts( $args );
if ( $posts )
{
	?>
	<section class="pt-1 px-0 lg-pt-3/3 container mx-auto overflow-hidden" dir="rtl">
		<div class="grid grid-cols-1 lg-grid-cols-4 lg-grid-rows-2 gap-x-3 gap-y-2 mobile-carousel" data-slick='{"slidesToShow":1, "slidesToScroll": 1 ,"dots": true,"infinite": true,"speed": 900 , "rtl" : true}'>
			<?php
			$iteration = 1;

			foreach ( $posts as $post )
			{
				setup_postdata( $post );

				$category = fs_get_the_primary_category( 'category' );

				if ( $iteration == 1 )
				{
					?>
					<div class="h-30 lg-h-full mx-1 lg-mx-0 lg-col-span-2 row-span-2 bg-gray-300 rounded-xs relative overflow-hidden">
						<a href="<?php echo esc_url( get_permalink() ); ?>" class="block w-full h-full">
							<?php the_post_thumbnail( 'fs-blog-main', array( 'class' => 'object-fit object-center w-full h-full' ) ); ?>
						</a>
						<div class="absolute left-0 bottom-0 w-full bg-mag-card px-1/6 lg-px-3/6 pb-1/3 lg-pb-3/3 ">
							<?php
							if ( $category )
							{
								?>
								<a href="<?php echo esc_url( $category[ 'url' ] ); ?>" class="bg-primary-main inline-block text-sm leading-1/9 text-white px-1 mb-1/2 pt-0/2 pb-0/4 rounded-xs"><?php echo $category[ 'name' ]; ?></a>
								<?php
							}
							?>
							<a href="<?php echo esc_url( get_permalink() ); ?>" class="flex items-center justify-between">
								<p class="text-white text-base lg-text-lg leading-2/2 lg-text-2/4 font-bold lg-leading-3/8"><?php echo get_the_title(); ?></p>
								<div class="icon-right-arrow-alt text-primary-main text-2 lg-text-2/5 leading-2 lg-leading-2/5 flex-shrink-0 mr-2 flex items-end"></div>
							</a>
						</div>
					</div>
					<?php
				}
				else
				{
					?>
					<div class="h-19 mx-1 lg-mx-0 bg-gray-300 lg-h-full rounded-xs relative overflow-hidden">
						<a href="<?php echo esc_url( get_permalink() ); ?>" class="block w-full h-full">
							<?php the_post_thumbnail( 'fs-blog-card', array( 'class' => 'object-fit object-center w-full h-full' ) ); ?>
							<div class="absolute left-0 bottom-0 w-full bg-mag-card flex flex-row items-end py-1/5 px-2 justify-between">
								<p class="text-white text-base lg-text-lg font-bold leading-13"><?php echo get_the_title(); ?></p>
							</div>
						</a>
						<?php
						if ( $category )
						{
							?>
							<a href="<?php echo esc_url( $category[ 'url' ] ); ?>" class="absolute top-1 left-1 bg-primary-main text-sm text-white px-1 mb-1/2 pt-0/2 pb-0/4 rounded-xs"><?php echo $category[ 'name' ]; ?></a>
							<?php
						}
						?>
					</div>
					<?php
				}
				$iteration ++;
			}
			?>
		</div>
	</section>
	<?php
}
wp_reset_postdata();
