<?php
$categories = wp_get_post_terms( get_the_ID(), 'category', [ 'fields' => 'ids' ] );

$posts = get_posts( [
	'post_type'      => 'post',
	'post_status'    => 'publish',
	'posts_per_page' => 3,
	'post__not_in'   => array( get_the_ID() ),
	'tax_query'      => array(
		'taxonomy' => 'category',
		'field'    => 'term_id',
		'terms'    => $categories,
	)
] );

if ( $posts )
{
	?>
	<div class="w-full overflow-hidden">
		<div class="px-2 md-px-3 lg-px-0">
			<?php section_title( "مطالب مشابه" ); ?>
		</div>

		<div class="grid grid-cols-1 lg-grid-cols-3 lg-gap-3 mt-4 w-full mobile-carousel px-1 lg-px-0" data-slick='{"slidesToShow":1, "slidesToScroll": 1 ,"dots": true,"infinite": true,"speed": 900 , "rtl" : true}'>
			<?php
			foreach ( $posts as $post )
			{
				setup_postdata( $post );
				?>
				<div class="w-full mx-1 lg-mx-0 lg-h-19 bg-gray-300 rounded-xs relative overflow-hidden">
					<a href="<?php echo get_permalink(); ?>" class="w-full h-full">
						<?php
						the_post_thumbnail( 'fs-blog-card', array( 'class' => 'object-fit object-center w-full h-full' ) );
						?>
					</a>
					<?php
					$category = fs_get_the_primary_category( 'category' );
					if ( $category )
					{
						?>
						<a href="<?php echo esc_url( $category[ 'url' ] ); ?>" class="absolute top-1 left-1 bg-primary-main text-sm text-white px-1 pt-0/2 pb-0/4 rounded-xs"><?php echo $category[ 'name' ]; ?></a>
						<?php
					}
					?>
					<a href="<?php echo get_permalink(); ?>" class="absolute left-0 bottom-0 w-full bg-mag-card flex flex-row items-end pb-1/3 px-1/5 justify-between">
						<p class="text-white text-base font-bold leading-2/2"><?php the_title(); ?></p>
						<div class="icon-right-arrow-alt text-primary-main text-1/7 flex-shrink-0 mr-2 leading-1/7 flex items-end"></div>
					</a>
				</div>
				<?php
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
	<?php
}