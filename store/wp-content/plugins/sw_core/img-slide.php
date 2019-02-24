<?php 
 /***********************
 * Topdeal IMG SLIDER
 *
 ***************************/
 function onemall_img_slide($atts){
	extract( shortcode_atts( array(
		'title' => '',
		'ids' => '',
		'fade' =>'true',
		'dots' => 'true',
		'autoplaySpeed' =>1000,
		'autoplay' =>'true', 
		'interval' => 5000
	), $atts ) );

//$ids = array();
$ids = explode( ',', $ids );
$onemall_direction = onemall_options()->getCpanelValue( 'direction' );
if ( is_rtl() || $onemall_direction == 'rtl' ){
	$rtl = 'true';
}else {$rtl = 'false';}
$html ='<div class="fade-slide loading" data-fade="'.esc_attr( $fade).'" data-dots="'.esc_attr( $dots).'" data-autoplaySpeed="'.esc_attr( $autoplaySpeed).'" data-autoplay="'.esc_attr( $autoplay).'" data-rtl="'.$rtl.'" >';
foreach ( $ids as $attach_id ) :  
	$linkimg = wp_get_attachment_image_url($attach_id,'full');
    $html .='<div class="image"><img src="'.esc_url( $linkimg ).'" alt="'.esc_html__('slide show','onemall').'"></div>';
endforeach ;
$html .='</div>';
return $html;
}
 add_shortcode('img_slide','onemall_img_slide');
 function load_img_slider_script(){
        if (!is_admin()){
			wp_register_script( 'slick_img_js', plugins_url( '/js/img.min.js', __FILE__ ),array(), null, true );		
			if (!wp_script_is('slick_img_js')) {
				wp_enqueue_script('slick_img_js');
			} 				
        }
    }
add_action('wp_enqueue_scripts', 'load_img_slider_script', 11);