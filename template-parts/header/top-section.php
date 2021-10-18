<?php
if ( defined( 'YITH_WOOCOMPARE' ) )
	echo do_shortcode( '[yith_woocompare_counter]' )
?>

<?php if ( ! wp_is_mobile() ) { ?>

<div class="custom-hidden-m lg-flex items-center justify-between pt-4">

	<!-- logo part -->
	<div>
		<a href="<?php echo esc_url( site_url( '/' ) ) ?>" class="w-18 h-7">
			<?php echo file_get_contents( get_stylesheet_directory() . '/assets/img/svg/arta-logo.svg' ); ?>
		</a>
	</div>
	<!-- /logo part -->

	<!-- search input part -->
	<div>
		<?php get_search_form(); ?>
	</div>
	<!-- /search input part -->

	<!-- contact info part -->
	<div class="flex flex-row items-center">

		<div class="icon-phone text-3/4 leading-3/4 flex items-center justify-center text-gray-300 w-3/4 h-3/4 transform"></div>

		<div class="flex flex-col mr-1/6">
			<p class="text-1/2 text-gray-600 leading-1/9 mb-0/4">نیاز به راهنمایی دارید؟</p>
			<?php $phone = get_field( 'phone', 'option' ); ?>
			<a href="tel:<?php echo $phone; ?>" class="flex flex-row-reverse items-center text-gray-main leading-3/3 text-2/1 font-bold dir-ltr ss02"><?php echo str_replace( '021', '021 - ', $phone ); ?></a>
		</div>
	</div>
	<!-- /contact info part -->

	<!-- cart part -->
	<div class="flex items-end">

		<?php
		if ( function_exists( 'yith_wcwl_count_all_products' ) )
		{
			?>
			<a href="<?php echo esc_url( site_url( '/my-account/wishlist/' ) ); ?>" class="text-2/8 h-2/8 leading-2/8 text-gray-main relative icon-heart ml-2/1">
				<div class="wishlist-count w-2 h-2 absolute top-full right-full -mt-0/9 -mr-0/9 text-gray-dark text-base leading-2 bg-secondary-main text-center rounded-full">
					<?php
					echo yith_wcwl_count_all_products();
					?>
				</div>
			</a>
			<?php
		}
		?>
		<a href="#" class="icon-cart h-3/2 text-3/2 leading-3/2 text-gray-main relative" id="cart">
			<div class="w-2 h-2 absolute top-full right-full -mt-0/8 -mr-0/8 text-gray-dark text-base leading-2 bg-secondary-main text-center rounded-full">
				<div class="header-cart-count">
					<?php
					echo is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0;
					?>
				</div>
			</div>
		</a>
	</div>
	<!-- /cart part -->
</div>

<?php } else { ?>

<div class="flex lg-hidden items-center border-b border-border pt-1/7 pb-1/8 px-2 md-px-3 lg-px-0 justify-between">
	<button class="flex items-center text-base leading-1/4 h-1/4 icon-hamburger action--open" type="button"></button>
	<div id="mobile-header" class="c-header-mobile-menu">
		<nav id="ml-menu" class="menu">
			<div class="menu__wrap">
				<div class="flex items-center justify-between mb-6">
					<button class="flex items-center text-base leading-1/4 h-1/4 icon-times action--close" type="button"></button>
					<a href="<?php echo esc_url( site_url( '/' ) ) ?>" class="w-15 h-4">
						<img class="object-fit object-center -mt-0/5" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/svg/arta-logo.svg"; ?>" width="150" height="59" alt=""/>
					</a>
				</div>
				<div>
					<?php
					$menu_locations = get_nav_menu_locations();
					$first_level    = wp_get_nav_menu_items( $menu_locations[ 'header-menu' ] ?? 0 );
					$all_categories = wp_get_nav_menu_items( $menu_locations[ 'header-category-menu' ] ?? 0 );
					?>
					<ul data-menu="main" class="menu__level" tabindex="-1" role="menu" aria-label="All">
						<li class="menu__item" role="menuitem">
							<a class="menu__link" href="<?php echo home_url() ?>"> خانه </a>
						</li>
						<li class="menu__item flex flex-row-reverse items-center" role="menuitem">
							<a class="menu__link" data-submenu="submenu-categories" aria-owns="submenu-categories" href="#"> دسته بندی محصولات </a>
							<span class="icon-angle-down text-white text-3xs pl-1/3 transform"></span>
						</li>
						<li class="menu__item" role="menuitem">
							<a class="menu__link off" href="<?php echo home_url( '/amazing' ); ?>"> به‌صرفه خرید کنید </a>
						</li>
						<?php
						foreach ( $first_level as $item )
						{
							?>
							<li class="menu__item" role="menuitem">
								<a class="menu__link" href="<?php echo $item->url ?>"><?php echo $item->title ?></a>
							</li>
							<?php
						}
						?>
					</ul>
					<ul data-menu="submenu-categories" id="submenu-categories" class="menu__level" tabindex="-2" role="menu" aria-label="All">
						<?php
						$category_parents = array_filter( $all_categories, function ( $var ) {
							return ( $var->menu_item_parent == 0 );
						} );

						foreach ( $category_parents as $category_parent )
						{
							$last_child = array_filter( $all_categories, function ( $var ) use ( $category_parent ) {
								return ( $var->menu_item_parent == $category_parent->ID );
							} );
							$data_child = $last_child ? 'data-submenu="submenu-' . $category_parent->ID . '" aria-owns="submenu-' . $category_parent->ID . '"' : '';
							?>
							<li class="menu__item flex flex-row-reverse items-center" role="menuitem">
								<a class="menu__link" <?php echo $data_child; ?> href="<?php echo $category_parent->url ?>"><?php echo $category_parent->title ?></a>
								<?php
								if ( $data_child )
								{
									?>
									<span class="icon-angle-down text-white text-3xs pl-1/3 transform"></span>
									<?php
								}
								?>
							</li>
							<?php
						}
						?>
					</ul>
					<?php

					foreach ( $all_categories as $item )
					{
						$children = array_filter( $all_categories, function ( $var ) use ( $item ) {
							return ( $var->menu_item_parent == $item->ID );
						} );

						if ( $children )
						{
							?>
							<ul data-menu="submenu-<?php echo $item->ID ?>" id="submenu-<?php echo $item->ID ?>" class="menu__level" tabindex="-3" role="menu" aria-label="All">
								<?php
								foreach ( $children as $child )
								{
									$last_child = array_filter( $all_categories, function ( $var ) use ( $child ) {
										return ( $var->menu_item_parent == $child->ID );
									} );

									$data_child = $last_child ? 'data-submenu="submenu-' . $child->ID . '" aria-owns="submenu-' . $child->ID . '"' : '';
									?>
									<li class="menu__item flex flex-row-reverse items-center" role="menuitem">
										<a class="menu__link" <?php echo $data_child; ?> href="<?php echo $child->url ?>"><?php echo $child->title ?></a>
										<?php
										if ( $data_child )
										{
											?>
											<span class="icon-angle-down text-white text-3xs pl-1/3 transform"></span>
											<?php
										}
										?>
									</li>
									<?php
								}
								?>
							</ul>
							<?php
						}
					}
					?>
				</div>
				<div class="absolute -mr-1 bottom-0 left-0 right-0 w-full flex items-center justify-between pb-3 px-4/5 dir-rtl">
					<div class="text-base leading-1/9 text-gray-main">نیاز به راهنمایی دارید؟</div>
					<a href="tel:<?php echo $phone; ?>" class="text-2/1 leading-3/3 text-gray-main font-bold" dir="ltr"><?php echo str_replace( '021', '021 - ', $phone ); ?></a>
				</div>
			</div>
		</nav>
	</div>


	<a href="<?php echo esc_url( site_url( '/' ) ) ?>" class="h-4 w-11 lg-w-19 lg-h-5">
		<img class="object-fit object-center" src="<?php echo get_stylesheet_directory_uri() . "/assets/img/svg/arta-logo.svg"; ?>" width="110" height="43" alt=""/>
	</a>

	<!-- cart part -->
	<div class="flex items-end pl-1">

		<a href="<?php echo esc_url( site_url( '/my-account/wishlist/' ) ); ?>" class="h-1/9 text-1/9 leading-1/9 lg-text-2/8 lg-h-2/8 lg-leading-2/8 text-gray-main relative icon-heart ml-1/4 lg-ml-2/1">
			<div class="w-1/6 h-1/6 lg-w-2 lg-h-2 absolute top-full right-full wishlist-count  -mt-0/5 -mr-0/6 lg--mt-0/9 lg--mr-0/9 text-gray-dark text-sm lg-text-base leading-1/6 lg-leading-2 bg-secondary-main text-center rounded-full">
				<?php
				if ( function_exists( 'yith_wcwl_count_all_products' ) )
					echo yith_wcwl_count_all_products();
				?>
			</div>
		</a>

		<a href="#" class="icon-cart h-1/9 text-1/9 leading-1/9 lg-h-3/2 lg-text-3/2 lg-leading-3/2 text-gray-main relative" id="cart">
			<div class=" w-1/6 h-1/6 lg-w-2 lg-h-2 absolute top-full right-full -mt-0/5 -mr-0/4 lg--mt-0/8 lg--mr-0/8 text-gray-dark text-sm lg-text-base leading-1/6 lg-leading-2 bg-secondary-main text-center rounded-full">
				<div class="header-cart-count">
					<?php echo is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : 0; ?>
				</div>
			</div>
		</a>

	</div>
	<!-- /cart part -->
</div>
<?php } ?>
