<?php
/**
 * Alluvial Coach theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ALLUVIAL_VERSION', '1.0.0' );

/**
 * Theme setup: supported features and nav menus.
 */
function alluvial_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'align-wide' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'alluvial' ),
		'footer'  => __( 'Footer Menu', 'alluvial' ),
	) );
}
add_action( 'after_setup_theme', 'alluvial_setup' );

/**
 * Enqueue styles and scripts.
 */
function alluvial_assets() {
	wp_enqueue_style(
		'alluvial-fonts',
		'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Inter:wght@400;500;600&display=swap',
		array(),
		null
	);
	wp_enqueue_style( 'alluvial-style', get_stylesheet_uri(), array(), ALLUVIAL_VERSION );
	wp_enqueue_script( 'alluvial-main', get_template_directory_uri() . '/assets/js/main.js', array(), ALLUVIAL_VERSION, true );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'alluvial_assets' );

/**
 * Register widget area used in the footer, if a client wants one later.
 */
function alluvial_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Footer', 'alluvial' ),
		'id'            => 'footer-1',
		'before_widget' => '<div class="widget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'alluvial_widgets_init' );

/**
 * Sensible excerpt length and ellipsis for blog cards.
 */
function alluvial_excerpt_length( $length ) {
	return 22;
}
add_filter( 'excerpt_length', 'alluvial_excerpt_length' );

function alluvial_excerpt_more( $more ) {
	return '…';
}
add_filter( 'excerpt_more', 'alluvial_excerpt_more' );

require get_template_directory() . '/inc/custom-post-types.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/contact-handler.php';
require get_template_directory() . '/inc/template-tags.php';
