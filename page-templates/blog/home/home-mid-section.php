<section class="flex flex-col-reverse lg-flex-row pt-3/2 lg-pt-6/4 container mx-auto">
	<div class="w-full lg-flex-1">
        <div class="px-2 md-px-3 lg-px-0">
		<?php
		$categories = get_field( 'blog-tutorial-categories', 'option' );

		if ( $categories )
		{
			$cat_ids = array();

			foreach ( $categories as $category )
				$cat_ids[] = $category->term_id;

			$args = [
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 6,
				'tax_query'      => [
					[
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $cat_ids,
						'operator' => 'IN'
					]
				]
			];

			$posts = get_posts( $args );

			if ( $posts )
			{
				$classes = [
					'mt-3',
					'mt-2/1'
				];

				?>
				<div class="border-b-2 border-border flex items-center">
					<h2 class="lg-text-2/4 text-1/8 inline-block text-center md-text-right leading-3/8 pb-1/1 title b2 text-gray-main font-bold">
						آموزش و مقالات </h2>
				</div>
				<?php
				for ( $i = 0; $i < count( $classes ); $i ++ )
				{
					?>
					<div class="grid grid-cols-1 md-grid-cols-3 md-grid-rows-2 md-gap-x-3 gap-y-2/5 <?php echo $classes[ $i ]; ?>">
						<?php
						$iteration = 0;

						foreach ( $posts as $post )
						{
							$iteration ++;

							if ( $i == 0 && $iteration > 3 )
								continue;

							if ( $i == 1 && $iteration <= 3 )
								continue;

							setup_postdata( $post );

							if ( $iteration == 1 || $iteration == 4 )
							{
								$category = fs_get_the_primary_category( 'category' );
								?>
								<div class="md-col-span-1 lg-h-19 md-row-span-2 rounded-xs relative overflow-hidden">
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="w-full h-full">
										<?php the_post_thumbnail( 'fs-blog-card', array( 'class' => 'object-fit object-center w-full h-full' ) ); ?>
									</a>
									<?php
									if ( $category )
									{
										?>
										<a href="<?php echo esc_url( $category[ 'url' ] ); ?>" class="absolute top-1 left-1 bg-primary-main text-sm text-white px-1 pt-0/2 pb-0/4 rounded-xs"><?php echo $category[ 'name' ]; ?></a>
										<?php
									}
									?>
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="absolute left-0 bottom-0 w-full bg-mag-card flex flex-row items-end p-1/5 justify-between">
										<p class="text-white text-base lg-text-lg font-bold leading-2/8"><?php echo get_the_title(); ?></p>
									</a>
								</div>
								<?php
							}
							else
							{
								?>
								<div class="md-col-span-2 rounded-xs flex items-center relative overflow-hidden">
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="h-8">
										<?php the_post_thumbnail( 'fs-blog-card', array( 'class' => 'object-fit object-center rounded-xs w-13 h-8/2' ) ); ?>
									</a>
									<a href="<?php echo esc_url( get_permalink() ); ?>" class="flex-1 mr-2 justify-between">
										<p class="text-gray-main text-sbase lg-text-medium leading-2/8"><?php echo get_the_title(); ?></p>
									</a>
								</div>
								<?php
							}
						}
						?>
					</div>
					<?php
				}
			}
			wp_reset_postdata();
		}
		?>
    </div>
    <?php
		if ( have_rows( 'blog-editor-featured', 'option' ) )
		{
			$post_ids = [];

			while ( have_rows( 'blog-editor-featured', 'option' ) )
			{
				the_row();
				$post_ids [] = get_sub_field( 'post' );
			}

			if ( $post_ids )
			{
				?>
				<div class="mt-3 lg-mt-5 overflow-hidden w-full px-0" dir="rtl">
					<div class="border-b-2 border-border flex items-center mx-2 md-mx-3 lg-mx-0">
						<h2 class="lg-text-2/4 text-1/8 inline-block text-center md-text-right leading-3/8 pb-1/1 title b2 text-gray-main font-bold">
							انتخاب سردبیر </h2>
					</div>
					<div class="grid grid-cols-1 lg-grid-cols-3 lg-gap-3 mt-3 w-full mobile-carousel" data-slick='{"slidesToShow":1, "slidesToScroll": 1 ,"dots": true,"infinite": true,"speed": 900 , "rtl" : true}'>
						<?php
						$posts = get_posts( array(
							'post_status' => 'publish',
							'orderby'     => 'post__in',
							'post__in'    => $post_ids
						) );

						foreach ( $posts as $post )
						{
							setup_postdata( $post );
							?>
							<div class="w-full mx-1 lg-mx-0 lg-h-19 bg-gray-300 rounded-xs relative overflow-hidden">
								<a href="<?php echo esc_url( get_permalink() ); ?>">
									<?php the_post_thumbnail( 'fs-blog-cart', array( 'class' => 'object-fit object-center w-full h-full' ) ); ?>
									<div class="absolute left-0 bottom-0 w-full bg-mag-card flex flex-row items-end p-1/5 justify-between">
										<p class="text-white text-base font-bold leading-2/8"><?php echo get_the_title(); ?></p>
										<div class="icon-right-arrow-alt text-primary-main text-lg flex-shrink-0 mr-2 leading-1/7 flex items-end"></div>
									</div>
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
							</div>
							<?php
						}
						wp_reset_postdata();
						?>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>
	<div class="w-full w-296 lg-mr-3/2 mb-3 lg-mb-0 flex-shrink-0 block px-2 md-px-3 lg-px-0">
		<div class="mb-2/5 lg-mb-4/6">
			<?php get_template_part( "page-templates/blog/search-blog-form" ); ?>
		</div>
		<?php get_template_part( "page-templates/blog/category" ); ?>
	</div>
</section>
