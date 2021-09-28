<section class="pt-5/1 pb-6/5 bg-gray-100 px-2 md-px-3 lg-px-0">
	<div class="container mx-auto">
		<div class="mb-3 flex flex-row items-center justify-between border-b border-border">
			<div class="text-right font-bold text-1/8 lg-text-2/4 leading-2/4 lg-leading-3/8 text-gray-600 title red pb-1/6 ">مجله علم و دانش</div>
			<a href="<?php echo home_url( 'blog' ); ?>" class="text-right font-bold text-base leading-2/2 text-primary-main flex items-center"> آرشیو
				<span class="icon-right-arrow-alt mr-1/2 h-1/7 text-primary-main leading-1/7 text-lg flex-shrink-0 flex items-center"></span>
			</a>
		</div>
		<div class="grid grid-cols-1 md-grid-cols-2 lg-grid-cols-4 gap-3/2">
			<?php
			$posts = get_posts( [ 'posts_per_page' => 4 ] );

			foreach ( $posts as $post )
			{
				setup_postdata( $post );
				$cats = get_the_category( get_the_ID() );
				?>
				<div class="h-21 lg-h-19 bg-gray-300 rounded-xs relative overflow-hidden">
					<a href="<?php the_permalink(); ?>" class="w-full h-full">
						<?php the_post_thumbnail( 'fs-blog-card', [ 'class' => 'object-fit object-center w-full h-full' ] ) ?>
					</a>
					<a href="<?php echo get_category_link( $cats[ 0 ]->cat_ID ); ?>" class="absolute top-1 left-1 bg-primary-main text-sm leading-1/9 text-white px-1 pt-0/2 pb-0/4 rounded-xs"><?php echo $cats[ 0 ]->name; ?></a>
					<a href="<?php the_permalink(); ?>" class="absolute left-0 bottom-0 w-full bg-mag-card flex flex-row items-end p-1/5 justify-between">
						<p class="text-white text-base font-bold leading-2/2"><?php the_title(); ?></p>
						<div class="icon-right-arrow-alt text-primary-main text-lg flex-shrink-0 mr-2 leading-1/7 flex items-end"></div>
					</a>
				</div>
				<?php
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>