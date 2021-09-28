<?php if ( ! wp_is_mobile() ) { ?>

<div class="custom-hidden-m lg-flex items-center justify-between pt-3 w-full relative">
	<nav class="flex flex-row items-center">
		<?php
		if ( has_nav_menu( 'header-category-menu' ) )
		{
			?>
			<div class="group relative">
				<a href="#" class="flex items-center cursor-pointer w-296 rounded-t-xs pt-1/4 pb-1/6 pr-2/4 pl-2/7 bg-secondary-main text-gray-main text-medium leading-2/2 ml-3/6">
					<div class="icon-menu-ws text-2 leading-2 h-2"></div>
					<div class="font-bold leading-2/5 text-1/6 mr-1/6 ml-5">دسته بندی محصولات</div>
					<div class="icon-angle-down text-0/7 leading-2/2 transform  flex items-center justify-center transform group-hover-rotate-180 transition-all duration-100 ease-linear"></div>
				</a>
				<?php get_template_part( "template-parts/header/category-menu" ); ?>
			</div>
			<?php
		}

		if ( has_nav_menu( 'header-menu' ) )
		{
			wp_nav_menu( array(
				'theme_location' => 'header-menu',
				'menu_class'     => 'flex flex-row c-header-menu header-menu-disc space-x-reverse space-x-3 mb-0/6 font-normal',
				'container'      => '',
				'fallback_cb'    => 'false',
				'depth'          => 1,
				'add_li_class'   => 'text-gray-dark text-1/4 leading-2/2'
			) );
		}

		if ( fs_is_active_amazing_sales() )
		{
			?>
			<a href="<?php echo site_url( '/shop?stock-status=in-offer' ); ?>" class="bg-primary-main btn-effect rounded-xs pr-1/3 pl-1/3 pt-0/8 pb-0/6 text-base leading-2/2 text-white flex items-center mr-3/2 mb-1/1">
				<span class="text-white text-xl leading-2 ml-1 icon-discount flex items-center justify-between"></span> فروش شگفت انگیز
			</a>
			<?php
		}
		?>
	</nav>
	<a href="<?php echo site_url( 'my-account' ); ?>" class="flex items-center text-1/4 leading-2/2">
		<div class="icon-user h-1/8 text-1/8 text-gray-dark ml-0/9 leading-1/8 mt-0/5"></div>
		<?php echo is_user_logged_in() ? 'حساب کاربری من' : 'ورود / ثبت نام '; ?>
	</a>
</div>

<?php } else { ?>

<div class="flex lg-hidden items-center pt-1/4 pb-1/3 px-2 md-px-3 lg-px-0 justify-between border-border<?php echo ! is_front_page() && ! is_home() ? ' border-b' : ''; ?>">
	<div>
		<?php get_search_form(); ?>
	</div>
	<div class="flex items-center">
		<?php $phone = get_field( 'phone', 'option' ); ?>
		<a href="tel:<?php echo $phone; ?>" class="flex items-center icon-phone text-2 leading-2 text-gray-600 ml-1/5"></a>
		<a href="<?php echo site_url( 'my-account' ); ?>" class="flex items-center icon-user text-2 leading-2 text-gray-600 "></a>
	</div>
</div>

<?php } ?>
