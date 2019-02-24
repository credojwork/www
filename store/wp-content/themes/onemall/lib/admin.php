<?php

/**
 * Add Theme Options page.
 */
function onemall_theme_admin_page(){
	add_theme_page(
		esc_html__('Theme Options', 'onemall'),
		esc_html__('Theme Options', 'onemall'),
		'manage_options',
		'onemall_theme_options',
		'onemall_theme_admin_page_content'
	);
}
add_action('admin_menu', 'onemall_theme_admin_page', 49);

function onemall_theme_admin_page_content(){ ?>
	<div class="wrap">
		<h2><?php esc_html_e( 'Onemall Advanced Options Page', 'onemall' ); ?></h2>
		<?php do_action( 'onemall_theme_admin_content' ); ?>
	</div>
<?php
}