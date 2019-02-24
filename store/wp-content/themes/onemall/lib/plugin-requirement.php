<?php
/***** Active Plugin ********/
require_once( get_template_directory().'/lib/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'onemall_register_required_plugins' );
function onemall_register_required_plugins() {
    $plugins = array(
		array(
            'name'               => esc_html__( 'WooCommerce', 'onemall' ), 
            'slug'               => 'woocommerce', 
            'required'           => true, 
			'version'			 => '3.4.3'
        ),

        array(
            'name'               => esc_html__( 'Revslider', 'onemall' ), 
            'slug'               => 'revslider',
			'source'             => get_template_directory() . '/lib/plugins/revslider.zip', 
            'required'           => true, 
            'version'            => '5.4.7.4'
        ),
		
		array(
            'name'     			 => esc_html__( 'SW Core', 'onemall' ),
            'slug'      		 => 'sw_core',
			'source'             => get_template_directory() . '/lib/plugins/sw_core.zip', 
            'required'  		 => true,   
			'version'			 => '1.0.1'
			),
		
		array(
            'name'     			 => esc_html__( 'SW WooCommerce', 'onemall' ),
            'slug'      		 => 'sw_woocommerce',
			'source'             => get_template_directory() . '/lib/plugins/sw_woocommerce.zip', 
            'required'  		 => true,
			'version'			 => '1.2.1'
        ),
		
		array(
            'name'     			 => esc_html__( 'SW Ajax Woocommerce Search', 'onemall' ),
            'slug'      		 => 'sw_ajax_woocommerce_search',
			'source'             => get_template_directory() . '/lib/plugins/sw_ajax_woocommerce_search.zip', 
            'required'  		 => true,
			'version'			 => '1.1.5'
        ),
				
		array(
            'name'               => esc_html__( 'One Click Demo Import', 'onemall' ), 
            'slug'               => 'one-click-demo-import', 
			'source'             => get_template_directory() . '/lib/plugins/one-click-demo-import.zip', 
            'required'           => true, 
        ),
		
		array(
            'name'               => esc_html__( 'Sw Woocommerce Swatches', 'onemall' ), 
            'slug'               => 'sw_wooswatches', 
			'source'             => get_template_directory() . '/lib/plugins/sw_wooswatches.zip', 
            'required'           => true, 
			'version'			 => '1.0.5'
        ),
		
		array(
            'name'               => esc_html__( 'Visual Composer', 'onemall' ), 
            'slug'               => 'js_composer', 
            'source'             => get_template_directory() . '/lib/plugins/js_composer.zip',  
            'required'           => true, 
            'version'            => '5.5'
        ), 		
		array(
            'name'     			 => esc_html__( 'WordPress Importer', 'onemall' ),
            'slug'      		 => 'wordpress-importer',
            'required' 			 => true,
        ), 
		array(
            'name'      		 => esc_html__( 'MailChimp for WordPress Lite', 'onemall' ),
            'slug'     			 => 'mailchimp-for-wp',
            'required' 			 => false,
        ),
		array(
            'name'      		 => esc_html__( 'Contact Form 7', 'onemall' ),
            'slug'     			 => 'contact-form-7',
            'required' 			 => false,
        ),
		array(
            'name'      		 => esc_html__( 'YITH Woocommerce Compare', 'onemall' ),
            'slug'      		 => 'yith-woocommerce-compare',
            'required'			 => false
        ),
		 array(
            'name'     			 => esc_html__( 'YITH Woocommerce Wishlist', 'onemall' ),
            'slug'      		 => 'yith-woocommerce-wishlist',
            'required' 			 => false
        ), 
		array(
            'name'     			 => esc_html__( 'WordPress Seo', 'onemall' ),
            'slug'      		 => 'wordpress-seo',
            'required'  		 => false,
        ),

    );
		if( onemall_options()->getCpanelValue('developer_mode') ): 
			$plugins[] = array(
				'name'               => esc_html__( 'Less Compile', 'onemall' ), 
				'slug'               => 'lessphp', 
				'source'             => get_template_directory() . '/lib/plugins/lessphp.zip',  
				'required'           => true, 
				'version'			 => '4.0.0'
			);
		endif;
    $config = array();

    tgmpa( $plugins, $config );

}
add_action( 'vc_before_init', 'onemall_vcSetAsTheme' );
function onemall_vcSetAsTheme() {
    vc_set_as_theme();
}