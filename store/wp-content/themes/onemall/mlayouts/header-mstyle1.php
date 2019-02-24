<?php 
	/* 
	** Content Header
	*/
	$sticky_mobile	= onemall_options()->getCpanelValue( 'sticky_menu' );
	$onemall_mobile_logo = onemall_options()->getCpanelValue('mobile_logo');
?>
<?php if( is_front_page() || get_post_meta( get_the_ID(), 'page_mobile_enable', true ) || is_search() || onemall_options()->getCpanelValue( 'mobile_header_inside' ) ): ?>
<header id="header" class="header header-mobile-style1">
	<div class="header-wrrapper clearfix">
		<div class="header-top-mobile clearfix">
			<?php if ( has_nav_menu('vertical_menu') && !has_nav_menu('mobile_header_menu') ) {?>
			<div class="header-menu-categories pull-left">				
				<div class="vertical_megamenu">
					<?php wp_nav_menu(array('theme_location' => 'vertical_menu', 'menu_class' => 'nav vertical-megamenu')); ?>
				</div>			
			</div>
			<?php }else{ ?>
			<div class="header-menu-categories pull-left">				
				<div class="vertical_megamenu">
					<?php wp_nav_menu(array('theme_location' => 'mobile_header_menu', 'menu_class' => 'nav vertical-megamenu')); ?>
				</div>			
			</div>
			<?php } ?>
			<div class="onemall-logo pull-left">
				<a  href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<?php if( $onemall_mobile_logo != '' ){ ?>
						<img src="<?php echo esc_url( $onemall_mobile_logo ); ?>" alt="<?php bloginfo('name'); ?>"/>
					<?php }else{
						$logo = get_template_directory_uri().'/assets/img/logo-mobile1.png'; ?>
						<img src="<?php echo esc_url( $logo ); ?>" alt="<?php bloginfo('name'); ?>"/>
					<?php } ?>					
				</a>
			</div>
			<div class="header-cart pull-right">
				<a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id') ); ?>">
					<?php get_template_part( 'woocommerce/minicart-ajax-mobile' ); ?>
				</a>
			</div>
			<div class="mobile-search pull-right">
				<div class="icon-seach"></div>
				<?php if( is_active_sidebar( 'search' ) && class_exists( 'sw_woo_search_widget' ) ): ?>
					<?php dynamic_sidebar( 'search' ); ?>
				<?php else : ?>
					<div class="non-margin">
						<div class="widget-inner">
							<?php get_template_part( 'widgets/sw_top/searchcate' ); ?>
						</div>
					</div>
				<?php endif; ?>	
			</div>
		</div>
	</div>
</header>
<?php else : ?>
<!--  header page -->
<?php get_template_part( 'mlayouts/breadcrumb', 'mobile' ); ?>
	<!-- End header -->
<?php endif; ?>