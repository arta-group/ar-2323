<div class="w-full lg-w-auto lg-flex-1 flex flex-col h-full px-2 md-px-3 lg-px-0">
	<div class="w-full lg-w-auto lg-flex-1 flex-col mb-5">
		<div class="border-b-2 border-border flex items-center">
			<h2 class="lg-text-2/4 text-1/8 flex  md-text-right leading-3/8 pb-1/5 title b2 text-gray-main font-bold">
				نتایج جست و جو برای <span class="inline-block mr-0/8">(<?php the_search_query(); ?>)</span>
			</h2>
		</div>
		<div class="mt-3/5 grid grid-cols-1 md-grid-cols-2 lg-grid-cols-3 gap-3/2">
			<?php
			while ( have_posts() )
			{
				the_post();
				?>
				<div>
					<div class="h-25 lg-h-19 w-full rounded-xs overflow-hidden relative mb-1/5">
						<a href="<?php echo esc_url( get_the_permalink() ); ?>" class="block w-full h-full">
							<div class="absolute z-5 bottom-0 left-0 w-full h-7 bg-mag-card "></div>
							<?php the_post_thumbnail( 'fs-blog-card', array( 'class' => 'h-full w-full rounded-xs object-center object-fill' ) ); ?>
						</a>
						<?php
						$category = fs_get_the_primary_category( 'category' );
						if ( $category )
						{
							?>
							<a href="<?php echo esc_url( $category[ 'url' ] ); ?>" class="absolute z-10 top-0 left-0 m-1 text-white pt-0/2 pb-0/4 px-1 rounded-xs bg-primary-main text-sm leading-1/9"><?php echo esc_attr( $category[ 'name' ] ); ?></a>
							<?php
						}
						?>
					</div>
					<a href="<?php echo get_the_permalink(); ?>" class="flex flex-row items-start w-full">
						<div class="text-base leading-2/2 font-bold flex-1 text-gray-main"><?php echo get_the_title(); ?></div>
						<div class="icon-right-arrow-alt text-1/7 leading-1/7 text-primary-main flex-shrink-0 mr-2"></div>
					</a>
				</div>
				<?php
			}
			?>
		</div>

		<?php
		global $wp_query;
		if ( ! $wp_query->found_posts )
		{
			?>
			<div class="bg-gray-100 text-base leading-2/2 p-2 rounded-xs">
				<?php
				echo sprintf( 'جستجوی شما برای عبارت "%s" هیچ نتیجه ای در بر نداشت.', get_search_query() );
				?>
			</div>
			<?php
		}
		?>
	</div>
	<div class="mt-auto mb-0">
		<?php
		fs_get_pagination();
		?>
	</div>
</div>
