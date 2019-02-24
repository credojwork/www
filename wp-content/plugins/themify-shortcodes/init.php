<?php
/*
Plugin Name:  Themify Shortcodes
Plugin URI:   http://themify.me/
Version:      1.0.7 
Author:       Themify
Description:  A set of shortcodes that can be used with any theme.
Text Domain:  themify-shortcodes
Domain Path:  /languages
*/

defined( 'ABSPATH' ) or die( '-1' );

/**
 * Bootstrap Themify Shortcodes plugin
 *
 * @since 1.0
 */
function themify_shortcodes_setup() {
	if( ! defined( 'THEMIFY_SHORTCODES_DIR' ) )
		define( 'THEMIFY_SHORTCODES_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );

	if( ! defined( 'THEMIFY_SHORTCODES_URI' ) )
		define( 'THEMIFY_SHORTCODES_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );

	if( ! defined( 'THEMIFY_SHORTCODES_VERSION' ) ) {
		$data = get_file_data( __FILE__, array( 'Version' ) );
		define( 'THEMIFY_SHORTCODES_VERSION', $data[0] );
	}

	include THEMIFY_SHORTCODES_DIR . 'includes/system.php';

	Themify_Shortcodes::get_instance();
}
add_action( 'after_setup_theme', 'themify_shortcodes_setup', 100 );