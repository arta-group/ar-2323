<div class="w-full lg-flex-1 flex flex-col h-full px-2 md-px-3 lg-px-0">
	<div class="flex-1 flex-col mb-5">
		<div class="border-b-2 border-border flex items-center">
			<h2 class="text-lg lg-text-2/4 leading-3/8 inline-block text-center md-text-right leading-2/8 pb-1/5 title b2 text-gray-main font-bold">
				<?php
				$archive_title = '';

				if ( is_category() )
					$archive_title = single_cat_title( '', false );

				if ( is_tag() )
					$archive_title = single_tag_title( '', false );

				echo sprintf( 'به‌صرفه خرید کنید %s', $archive_title ); ?>
			</h2>
		</div>
		<div class="wp-block-column">
                <?php the_content(); ?>
		</div>

	</div>
	<div class="mt-auto mb-0">
		<?php
		fs_get_pagination();
		?>
	</div>
</div>
