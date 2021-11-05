<?php
/**
 * Theme functions et definitions.
 * @author  	 John Robert-Nicoud | 6clicks
 * @copyright  (c) Copyright by 6clicks.ch
 * @link       https:/6clicks.ch
 * @since 		 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 1170; /* pixels */
}

// Constants
define( 'WP2_VERSION', '1.0' );
define( 'WP2_DIR', get_template_directory() );
define( 'WP2_URI', get_template_directory_uri() );


/*--------------------------------------------------------------
# Theme Supports
--------------------------------------------------------------*/
if ( ! function_exists( 'wp2_setup' ) ) :
	function wp2_setup() {

		load_theme_textdomain( 'wp2', get_template_directory() . '/languages' );

        add_theme_support( 'post-thumbnails' );
        // Add default posts and comments RSS feed links to head.
	    add_theme_support( 'automatic-feed-links' 
		set_post_thumbnail_size( 1170, 0 );
		add_theme_support( 'editor-styles' );
		add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );
		add_theme_support( 'responsive-embeds' );
		// Adding support for core block visual styles.
        add_theme_support( 'wp-block-styles' );
        add_theme_support( 'align-wide' );
	}
	add_action( 'after_setup_theme', 'wp2_setup' );
endif;


/*--------------------------------------------------------------
# Enqueue Styles
--------------------------------------------------------------*/

if ( ! function_exists( 'wp2_styles' ) ) :
	function wp2_styles() {

		wp_register_style( 'wp2-style', WP2_URI . '/assets/css/style.min.css' );
		wp_add_inline_style( 'wp2-style', wp2_get_font_face_styles() );

		$dependencies = apply_filters( 'wp2_style_dependencies', array( 'wp2-style' ) );

		wp_register_style( 'wp2-style-blocks', WP2_URI . '/assets/css/blocks.min.css', $dependencies, WP2_VERSION );		
		
		wp_enqueue_style( 'wp2-style' );
		wp_style_add_data( 'wp2-style', 'rtl', 'replace' );
		wp_enqueue_style( 'wp2-style-blocks' );
		wp_style_add_data( 'wp2-style-blocks', 'rtl', 'replace' );

	}
	add_action( 'wp_enqueue_scripts', 'wp2_styles' );
endif;


/*--------------------------------------------------------------
# Enqueue Editor Styles
--------------------------------------------------------------*/

if ( ! function_exists( 'wp2_editor_styles' ) ) :
	function wp2_editor_styles() {

		add_editor_style( array(
			'./assets/css/editor.min.css',
			'./assets/css/blocks.min.css'
		) );

		wp_add_inline_style( 'wp-block-library', wp2_get_font_face_styles() );
	}
	add_action( 'admin_init', 'wp2_editor_styles' );
endif;



/*--------------------------------------------------------------
# Get Google Fonts
--------------------------------------------------------------*/
require_once  get_template_directory() . 'inc/google-font.php';

/*--------------------------------------------------------------
# Acf blocks
--------------------------------------------------------------*/
require get_template_directory() . '/inc/acf_blocks.php';

/*--------------------------------------------------------------
# Custom post types & taxonomies commenter si non utilisé
--------------------------------------------------------------*/
require_once  get_template_directory() . 'inc/custom_post_type.php';

/*--------------------------------------------------------------
# Block patterns
--------------------------------------------------------------*/
require get_template_directory() . '/inc/block-patterns.php';
