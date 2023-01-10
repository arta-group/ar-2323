<?php
/**
 * foursides functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package FOUR SIDES
 */

if ( ! defined( '_FS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_FS_VERSION', '1.0.0' );
}

if ( ! function_exists( 'fs_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function fs_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'fs-blog-card', 295, 190, true );
		add_image_size( 'fs-blog-main', 950, 625, true );
		add_image_size( 'fs-product-thumbnail', 90, 90, true );
		add_image_size( 'fs-product-card', 160, 160, true );
		add_image_size( 'fs-product-main', 400, 400, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( [
			'footer-menu'          => 'منوی فوتر',
			'header-menu'          => 'منوی هدر',
			'blog-menu'            => 'منوی بلاگ',
			'footer-category-menu' => 'منوی دسته بندی فوتر',
			'header-category-menu' => 'منوی دسته بندی هدر'
		] );
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		] );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'fs_custom_background_args', [
			'default-color' => 'ffffff',
			'default-image' => '',
		] ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', [
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		] );

		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}

add_action( 'after_setup_theme', 'fs_setup' );


add_theme_support( 'yoast-seo-breadcrumbs' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fs_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'fs_content_width', 640 );
}

add_action( 'after_setup_theme', 'fs_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fs_widgets_init() {
	register_sidebar( [
		'name'          => esc_html__( 'Blog Sidebar', 'webstudio' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'webstudio' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );

	register_sidebar( [
		'name'          => esc_html__( 'Shop Sidebar', 'webstudio' ),
		'id'            => 'shop-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'webstudio' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	] );
}

add_action( 'widgets_init', 'fs_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function fs_scripts() {
	wp_dequeue_style( 'wc-block-style' );

	wp_enqueue_style( 'fs-design-system-style', get_template_directory_uri() . '/assets/css/tailwind.min.css', array(), _FS_VERSION );
	wp_enqueue_style( 'fs-style', get_template_directory_uri() . '/assets/css/main.min.css', array(), _FS_VERSION );
	wp_enqueue_style( 'sa-style', get_template_directory_uri() . '/assets/css/mystyle.css', array(), "1.0.0" );
	wp_enqueue_script( 'sa-js', get_template_directory_uri() . '/assets/js/n_custom.js', array(), "1.0.0", true );
	wp_enqueue_script( 'fs-js', get_template_directory_uri() . '/assets/js/custom.min.js', array(), _FS_VERSION, true );
	wp_enqueue_script( 'fs-countdown-js', get_template_directory_uri() . '/assets/js/simplyCountdown.min.js', array(
		'jquery',
		'fs-js'
	), _FS_VERSION, true );

	wp_enqueue_script( 'fs-ajax-js', get_template_directory_uri() . '/assets/js/ajax.js', array(
		'fs-js',
		'fs-countdown-js'
	), _FS_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( ! ( is_shop() || is_product_category() || is_tax() ) ) {
		wp_dequeue_style( 'wcpf-plugin-style' );
		wp_dequeue_script( 'wcpf-plugin-polyfills-script' );
		wp_dequeue_script( 'wcpf-plugin-vendor-script' );
		wp_dequeue_script( 'wcpf-plugin-script' );
	}
}

add_action( 'wp_enqueue_scripts', 'fs_scripts' );

function fs_admin_scripts() {
	wp_enqueue_style( 'fs-admin-css', get_template_directory_uri() . '/assets/css/admin.css', array(), _FS_VERSION );

	wp_enqueue_script( 'fs-admin-js', get_template_directory_uri() . '/assets/js/admin.js', array(
		'jquery',
		'jquery-ui-core',
		'jquery-ui-datepicker'
	), _FS_VERSION, true );
}

add_action( 'admin_enqueue_scripts', 'fs_admin_scripts' );

if ( function_exists( 'yith_wishlist_install' ) ) {
	if ( ! function_exists( 'yith_wcwl_remove_awesome_stylesheet' ) ) {
		function yith_wcwl_remove_awesome_stylesheet() {
			wp_deregister_style( 'yith-wcwl-font-awesome' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'yith_wcwl_remove_awesome_stylesheet', 20 );
}

function sa_sms( string $user_login, string $sms, array $sms_value ) {

	/*
	 * forgot_sms_code=7
	 * welcome_register=1
	 * success_order=2
	 * success_login=3
	 * register=4
	 * send_post_code=5
	 * send_peyk=6
	 * send_vote_after_completed=8
	 */
	$bodyId = 0;
	switch ( $sms ) {
		case 7:
			$bodyId = 77433;
			break;
		case 1:
			$bodyId = 78776;
			break;
		case 2:
			$bodyId = 78777;
			break;
		case 3:
			$bodyId = 52455;
			break;
		case 4:
			$bodyId = 38919;
			break;
		case 5:
			$bodyId = 78822;
			break;
		case 6:
			$bodyId = 78825;
			break;
		case 8:
			$bodyId = 91138;
			break;
	}

	$url         = 'https://console.melipayamak.com/api/send/shared/da3f7d44521242a882186ed37c5b77a2';
	$data        = [
		'bodyId' => $bodyId,
		'to'     => sanitize_text_field( $user_login ),
		'args'   => $sms_value,
	];
	$data_string = json_encode( $data );
	$ch          = curl_init( $url );
	curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_string );

// Next line makes the request absolute insecure
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
// Use it when you have trouble installing local issuer certificate
// See https://stackoverflow.com/a/31830614/1743997

	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER,
		array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen( $data_string )
		)
	);
	$result = json_decode( curl_exec( $ch ) );
	$error = curl_errno( $ch );
	curl_close( $ch );

// to debug
	if ( $error ) {
		error_log( 'Curl error: ' . curl_error( $ch ) );

		return false;
	} elseif ( ! empty( $result->errors ) ) {
		return false;
	}

	return $result;

}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customize Woocommerce
 */
require get_template_directory() . '/inc/custom-woocommerce.php';

/**
 * Ajax calls
 */
require get_template_directory() . '/inc/class-fs-arta-ajax.php';

/**
 * User comments
 */
require get_template_directory() . '/inc/class-fs-arta-product-review-walker.php';

/**
 * Init settings page
 */
require get_template_directory() . '/inc/theme-settings.php';

require get_template_directory() . '/inc/wc-takhfifan.php';

/**
 * Enable wordpress editor for taxonomy in add and edit page
 */
require get_template_directory() . '/inc/wp-editor/class-fs-arta-taxonomy-editor.php';
require get_template_directory() . '/inc/wp-editor/class-fs-arta-taxonomy-editor-init.php';

/**
 * Table Content
 */
require get_template_directory() . '/inc/class-fs-arta-table-of-content.php';

/**
 * Custom post price.
 */
require get_template_directory() . '/inc/custom-post-price.php';

/**
 * Add icon support field to ACF plugin
 */
require get_template_directory() . '/inc/class-fs-acf-icon-picker.php';
/**
 * Functions add shortcode into WordPress.
 */
require get_template_directory() . '/inc/template-shortcode.php';
/**
 * Disable plugin and theme update
 */
add_filter( 'auto_update_plugin', '__return_false' );
add_filter( 'auto_update_theme', '__return_false' );