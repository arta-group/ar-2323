<div class="w-full lg-w-auto lg-flex-1">
	<div class="px-2 md-px-3 lg-px-0 mb-1">
		<h1 class="text-xl md-text-2/4 leading-3/8 font-bold text-gray-main"><?php the_title(); ?></h1>
		<div class="flex flex-col md-flex-row items-center justify-between mt-2">
			<div class="flex flex-wrap items-center justify-between lg-space-x-reverse lg-space-x-2">
				<div class="flex items-center mb-1/5 lg-mb-0">
					<div class="icon-calendar ml-1 mb-0/3 text-1/9 leading-1/9 flex items-center  text-gray-500"></div>
					<div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0">تاریخ انتشار:</div>
					<div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0 ss02"><?php echo get_the_date( 'Y/m/d' ); ?></div>
				</div>
				<div class="flex items-center mb-1/5 lg-mb-0">
					<div class="icon-square-user ml-0/7 text-2/4 leading-2/4 h-2/4 text-gray-500"></div>
					<div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0">نویسنده:</div>
					<div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0 ss02"><?php echo get_the_author(); ?></div>
				</div>
				<div class="flex items-center mb-1/5 lg-mb-0">
					<div class="icon-timer ml-0/7 text-2/4 leading-2/4 h-2/4 text-gray-500"></div>
					<div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0">مدت مطالعه:&nbsp</div>
					<div class="text-sm md-text-sbase leading-2 text-gray-400 flex-shrink-0 ss02"><?php echo fs_estimated_reading_time(); ?></div>
				</div>
				<?php
				$category = fs_get_the_primary_category( 'category' );
				if ( $category )
				{
					?>
					<a href="<?php echo esc_url( $category[ 'url' ] ); ?>" class="pb-0/4 pt-0/2 px-1 bg-primary-main text-white text-sm leading-1/8 rounded-xs mb-1/5 lg-mb-0 flex items-center">
						<?php echo $category[ 'name' ]; ?>
					</a>
					<?php
				}
				?>
			</div>
			<a href="#" id="share-btn" class="flex flex-row items-center ml-0 mr-auto">
				<div class="icon-network-share ml-0/7 text-2/4 leading-2/4 h-2/4"></div>
				<div class="text-sm md-text-base text-gray-main">اشتراک گذاری</div>
			</a>
            <?php get_template_part("page-templates/blog/share-modal"); ?>
		</div>
	</div>
	<div class="post-thumbnail pt-1 lg-pt-3/5 px-2 md-px-3 lg-px-0 w-full">
		<?php
		the_post_thumbnail( 'fs-blog-main', array( 'class' => 'w-full h-full' ) );
		?>
	</div>
	<div class="c-blog-content px-2 md-px-3 lg-px-0">
		<?php the_content(); ?>
	</div>
	<?php
	$tags = get_the_tags();
	if ( $tags )
	{
		?>
		<div class="lg-flex flex-col lg-flex-row  mb-4 lg-mb-8 mt-3 lg-mt-5 px-2 md-px-3 lg-px-0 custom-hidden-m">
			<div class="text-lg leading-13 mb-2 lg-mb-0 lg-ml-2 flex-shrink-0"> هشتگ‌ها :</div>
			<div class="flex items-center flex-wrap justify-between lg-justify-start">
				<?php
				foreach ( $tags as $tag )
				{
					?>
					<div class="pt-0/2 pb-0/4 px-1 ml-1 mb-1 lg-mb-0 text-sm leading-1/9 text-gray-main border flex-shrink-0 border-border rounded-xs">
						<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" rel="tag" class="block">
							<?php echo $tag->name; ?>
						</a>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}

	if ( comments_open() || get_comments_number() )
		comments_template();

	get_template_part( "page-templates/blog/similar-posts" );
	?>
</div>
