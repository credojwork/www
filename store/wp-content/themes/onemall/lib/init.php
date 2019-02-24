<?php
/**
 * onemall initial setup and constants
 */
function onemall_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'onemall', get_template_directory() . '/lang' );

	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menus(array(
		'primary_menu' => esc_html__('Primary Menu', 'onemall'),
		'vertical_menu' => esc_html__( 'Vertical Menu', 'onemall' ),
		'mobile_menu' => esc_html__( 'Mobile Menu', 'onemall' ),
	));
	
	add_theme_support( 'sw_theme' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	if( onemall_options()->getCpanelValue( 'product_zoom' ) ) :
		add_theme_support( 'wc-product-gallery-zoom' );
	endif;
	
	add_image_size( 'onemall_blog-responsive1', 310, 230, true );
	
	add_theme_support( "title-tag" );
	
	add_theme_support('bootstrap-gallery');     // Enable Bootstrap's thumbnails component on [gallery]
	
	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support('post-thumbnails');

	// Add post formats (http://codex.wordpress.org/Post_Formats)
	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));
	
	// Custom image header
	$onemall_header_arr = array(
		'default-image' => get_template_directory_uri().'/assets/img/logo-default.png',
		'uploads'       => true
	);
	add_theme_support( 'custom-header', $onemall_header_arr );
	
	// Custom Background 
	$onemall_bgarr = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);
	add_theme_support( 'custom-background', $onemall_bgarr );
	
	// Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style( 'css/editor-style.css' );
	
	new Onemall_Menu();
}
add_action('after_setup_theme', 'onemall_setup');

