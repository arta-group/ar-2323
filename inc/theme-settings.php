<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

function fs_init_theme_settings_page ()
{
	// Check function exists.
	if ( function_exists( 'acf_add_options_page' ) )
	{
		acf_add_options_page( array(
			'page_title' => 'تنظیمات قالب',
			'menu_title' => 'تنظیمات قالب',
			'menu_slug'  => 'theme-settings',
			'capability' => 'edit_posts',
			'icon_url'   => 'dashicons-admin-customizer',
			'position'   => 24,
			'redirect'   => true
		) );

		acf_add_options_sub_page( array(
			'page_title'  => 'عمومی',
			'menu_title'  => 'عمومی',
			'parent_slug' => 'theme-settings',
			'menu_slug'   => 'theme-settings-general'
		) );

		acf_add_options_sub_page( array(
			'page_title'  => 'فوتر',
			'menu_title'  => 'فوتر',
			'parent_slug' => 'theme-settings',
			'menu_slug'   => 'theme-settings-footer'
		) );
	}
}

add_action( 'acf/init', 'fs_init_theme_settings_page' );