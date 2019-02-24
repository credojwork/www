<?php 	
	$onemall_page_footer   	 = ( get_post_meta( get_the_ID(), 'page_footer_style', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_footer_style', true ) : onemall_options()->getCpanelValue( 'footer_style' );
	$onemall_copyright_text 	 = onemall_options()->getCpanelValue( 'footer_copyright' ); 
	$footer_style = onemall_options()->getCpanelValue( 'footer_style2' );
?>

<footer id="footer" class="footer default theme-clearfix <?php echo esc_attr( $footer_style ); ?>">
	<!-- Content footer -->
	<div class="container">
		<?php 
			if( $onemall_page_footer != '' ) :
				echo sw_get_the_content_by_id( $onemall_page_footer ); 
			else: ?>
			<div class="copyright-text">
				<?php if( $onemall_copyright_text == '' ) : ?>
					<p>&copy;<?php echo date('Y') .' '. esc_html__('WordPress Theme SW Onemall. All Rights Reserved. Designed by ','onemall'); ?><a class="mysite" href="<?php echo esc_url( 'http://wpthemego.com/' ); ?>"><?php esc_html_e('WpThemeGo.com','onemall');?></a>.</p>
				<?php else : ?>
					<?php echo wp_kses( $onemall_copyright_text, array( 'a' => array( 'href' => array(), 'title' => array(), 'class' => array() ), 'p' => array()  ) ) ; ?>
				<?php endif; ?>
			</div>
		<?php	endif; ?>
	</div>
</footer>