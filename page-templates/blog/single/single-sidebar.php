<div class="lg-flex flex-col w-296 mr-3/2 flex-shrink-0 pt-13 -mt-0/5 hidden">

	<?php get_template_part( "page-templates/blog/search-blog-form" ); ?>

	<div class="mt-5/7">
		<?php get_template_part( 'page-templates/blog/category' ); ?>
	</div>
	<div class="flex flex-col mt-7">
		<?php
		get_template_part( "page-templates/blog/latest-posts" );
		get_template_part( "page-templates/blog/small-sidebar-banners" );
		?>
	</div>
	<div class="flex flex-col mt-7">
		<div>
			<div class="border-b-2 border-border flex items-center">
				<h2 class="lg-text-1/8 text-2 inline-block text-center md-text-right leading-2/8 pb-1/2 title b2 text-gray-main font-bold">محبوب ترین‌ها</h2>
			</div>
			<?php
			get_template_part( "page-templates/blog/top-posts" );
			?>
		</div>
		<?php
		get_template_part( "page-templates/blog/small-sidebar-banners", '', [ 'section' => 2 ] );
		?>
	</div>
	<?php
	//	get_template_part( "page-templates/blog/top-hashtags" );
	?>
</div>