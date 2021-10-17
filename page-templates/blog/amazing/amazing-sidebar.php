<div class="flex flex-col w-296 ml-3/2 flex-shrink-0 pt-5/3 hidden lg-block">
	<?php get_template_part( "page-templates/blog/search-blog-form" ); ?>
	<div class="flex flex-col mt-5/6 mb-6">
		<?php
		get_template_part( "page-templates/blog/category" );
		get_template_part( "page-templates/blog/small-sidebar-banners" );
		?>
	</div>
	<div class="flex flex-col">
		<?php
		get_template_part( "page-templates/blog/latest-posts" );
		get_template_part( "page-templates/blog/small-sidebar-banners", '', [ 'section' => 2 ] );
		?>
	</div>
</div>
