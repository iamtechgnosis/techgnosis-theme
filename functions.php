<?php
/**
 * techgnosis-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package techgnosis-theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.4542' );
}

if ( ! function_exists( 'techgnosis_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function techgnosis_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on techgnosis-theme, use a find and replace
		 * to change 'techgnosis-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'techgnosis-theme', get_template_directory() . '/languages' );

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
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'techgnosis-theme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'techgnosis_theme_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'techgnosis_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function techgnosis_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'techgnosis_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'techgnosis_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function techgnosis_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'techgnosis-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'techgnosis-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'techgnosis_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function techgnosis_theme_scripts() {
	// wp_enqueue_style( 'techgnosis-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'techgnosis-theme-style', 'rtl', 'replace' );

	// wp_enqueue_script( 'techgnosis-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'techgnosis_theme_scripts' );

function wireup_js() {
    $dir = __DIR__;
 
    $script_asset_path = "$dir/build/index.asset.php";
    if ( ! file_exists( $script_asset_path ) ) {
        throw new Error(
            'You need to run `npm start` or `npm run build` in the techgnosis theme first.'
        );
    }
    $index_js     = '/build/index.js';
	$script_asset = require( $script_asset_path );
	
    wp_enqueue_script(
        'wp-scripts',
        get_template_directory_uri() . $index_js,
        $script_asset['dependencies'],
		$script_asset['version'],
		true
	);

	wp_enqueue_style(
        'wp-scripts-styles',
        get_template_directory_uri() . '/build/style-index.css',
        array(),
		$script_asset['version']
	);
	
	$header_script_asset_path = "$dir/build/headerScripts.asset.php";
    if ( ! file_exists( $header_script_asset_path ) ) {
        throw new Error(
            'You need to run `npm start` or `npm run build` in the techgnosis theme first.'
        );
    }
	$header_js     = '/build/headerScripts.js';
    $header_script_asset = require( $header_script_asset_path );
    wp_enqueue_script(
        'wp-header-scripts',
        get_template_directory_uri() . $header_js,
        $header_script_asset['dependencies'],
		$header_script_asset['version']
	);
	
    // wp_set_script_translations( 'create-block-gutenpride-block-editor', 'gutenpride' );
 
    // $editor_css = 'editor.css';
    // wp_register_style(
    //     'create-block-gutenpride-block-editor',
    //     plugins_url( $editor_css, __FILE__ ),
    //     array(),
    //     filemtime( "$dir/$editor_css" )
    // );
 
    // $style_css = 'style.css';
    // wp_register_style(
    //     'create-block-gutenpride-block',
    //     plugins_url( $style_css, __FILE__ ),
    //     array(),
    //     filemtime( "$dir/$style_css" )
    // );
 
    // register_block_type( 'create-block/gutenpride', array(
    //     'apiVersion' => 2,
    //     'editor_script' => 'create-block-gutenpride-block-editor',
    //     'editor_style'  => 'create-block-gutenpride-block-editor',
    //     'style'         => 'create-block-gutenpride-block',
    // ) );
}
add_action( 'wp_enqueue_scripts', 'wireup_js' );

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
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );