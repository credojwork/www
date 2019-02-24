<?php 
	do_action( 'before' ); 
?>
<?php if ( class_exists( 'WooCommerce' ) && !onemall_options()->getCpanelValue( 'disable_cart' ) ) { ?>
<?php
	$onemall_page_header = ( get_post_meta( get_the_ID(), 'page_header_style', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_header_style', true ) : onemall_options()->getCpanelValue('header_style');

		get_template_part( 'woocommerce/minicart-ajax' ); 
	
?>
<?php } ?>