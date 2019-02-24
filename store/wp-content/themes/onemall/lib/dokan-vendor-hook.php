<?php 
/*
	* Name: Dokan Vendor Hook
	* Develop: SmartAddons
*/

add_action( 'wp', 'onemall_dokan_hook' );
function onemall_dokan_hook(){
	 if ( dokan_is_store_page () ) {
		remove_action( 'woocommerce_before_main_content', 'onemall_banner_listing', 10 );
	}
}
