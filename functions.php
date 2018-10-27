<?php
/**
 * cody functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cody
 */

if ( ! function_exists( 'cody_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function cody_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on cody, use a find and replace
		 * to change 'cody' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'cody', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'cody' ),
		) );

		register_nav_menus( array(
			'menu-2' => esc_html__( 'Lower Right', 'cody' ),
		) );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'cody_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'cody_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cody_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cody_content_width', 640 );
}
add_action( 'after_setup_theme', 'cody_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cody_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cody' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'cody' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'cody_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cody_scripts() {
	wp_enqueue_style( 'cody-style', get_stylesheet_uri() );


	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-effects-core');

	wp_enqueue_script( 'cody-progress', get_template_directory_uri() . '/assets/js/realprogress.min.js', array(), '20151215', true );

	wp_enqueue_script( 'cody-loaded', get_template_directory_uri() . '/assets/js/imagesLoaded.js', array(), '20151215', true );

	wp_enqueue_script( 'cody-main', get_template_directory_uri() . '/assets/js/main.js', array(), '20151215', true );

	wp_enqueue_script( 'cody-fitvids', get_template_directory_uri() . '/assets/js/fitvids.js', array(), '20151215', true );

	wp_enqueue_style( 'cody-flickity-css', get_template_directory_uri() . '/assets/css/flickity.css' );

	wp_enqueue_script( 'cody-flickity', get_template_directory_uri() . '/assets/js/flickity.pkgd.min.js', array(), '20151215', true );

	//wp_enqueue_script( 'cody-swipe', get_template_directory_uri() . '/assets/js/jquery.touchSwipe.js', array(), '20151215', true );

	wp_enqueue_script( 'cody-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cody_scripts' );

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
 *  Hooks
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Extras
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Move Yoast to bottom
function yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');

/**
* Add theme support for Responsive Videos.
*/
function jetpackme_responsive_videos_setup() {
    add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'jetpackme_responsive_videos_setup' );

add_filter('body_class', 'load_class');

function load_class($classes) {
        if(is_front_page() || is_archive()) {
        $classes[] = 'load';
				}
		return $classes;
}
