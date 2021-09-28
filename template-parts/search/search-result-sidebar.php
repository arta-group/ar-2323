<div class="flex flex-col w-296 mr-3/2 flex-shrink-0 pt-5/3 custom-hidden-m lg-block">
    <div class="mb-5/6">
	    <?php get_template_part( "page-templates/blog/search-blog-form" ); ?>
    </div>
	
	<div class="flex flex-col mb-6">
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
