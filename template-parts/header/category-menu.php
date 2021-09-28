<div class="absolute top-full right-0 w-header  transform transition-all duration-200 ease-linear translate-y-10 group-hover-translate-y-px -z-5 group-hover-z-40 invisible opacity-0 group-hover-visible group-hover-opacity-100">
	<div class="flex relative">
		<?php
		wp_nav_menu( array(
			'theme_location' => 'header-category-menu',
			'menu_class'     => 'category-menu',
			'container'      => '',
			'fallback_cb'    => 'false',
			'depth'          => 3,
		) );
		?>
	</div>
</div>

