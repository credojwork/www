<?php
	/* 
	** Content Header
	*/
	$onemall_page_header = get_post_meta( get_the_ID(), 'page_header_style', true );
	$onemall_colorset = onemall_options()->getCpanelValue('scheme');
	$onemall_logo = onemall_options()->getCpanelValue('sitelogo');
	$sticky_menu 		= onemall_options()->getCpanelValue( 'sticky_menu' );
	$onemall_page_header  = ( get_post_meta( get_the_ID(), 'page_header_style', true ) != '' ) ? get_post_meta( get_the_ID(), 'page_header_style', true ) : onemall_options()->getCpanelValue('header_style');
	$onemall_title_text = onemall_options()->getCpanelValue('menu_title_text');
	$onemall_menu_item 	= ( onemall_options()->getCpanelValue( 'menu_number_item' ) )  ? onemall_options()->getCpanelValue( 'menu_number_item' )  : 11;
	$onemall_mmenu_item	= ( onemall_options()->getCpanelValue( 'mmenu_number_item' ) ) ? onemall_options()->getCpanelValue( 'mmenu_number_item' ) : 6;
	$onemall_more_text 	= ( onemall_options()->getCpanelValue( 'menu_more_text' ) )	 ? onemall_options()->getCpanelValue( 'menu_more_text' )		: esc_html__( 'See More', 'onemall' );
	$onemall_less_text 	= onemall_options()->getCpanelValue( 'menu_less_text' )			 ? onemall_options()->getCpanelValue( 'menu_less_text' )		: esc_html__( 'See Less', 'onemall' );
?>
<header id="header" class="header header-<?php echo esc_attr( $onemall_page_header );?>">
	<div class="header-top">
		<div class="container">
			<div class="row">
				<!-- Sidebar Top Menu -->
					<?php if (is_active_sidebar('top')) {?>
						<div class="top-header">
								<?php dynamic_sidebar('top'); ?>
						</div>
					<?php }?>
				</div>
		</div>
	</div>
	<div class="header-mid clearfix">
		<div class="container">
			<div class="row">
			<!-- Logo -->
				<div class="top-header col-lg-3 col-md-3 col-sm-12 pull-left">
					<div class="onemall-logo">
						<?php onemall_logo(); ?>
					</div>
				</div>
			<!-- Sidebar Top Menu -->
			<?php if( !onemall_options()->getCpanelValue( 'disable_search' ) ) : ?>
				<div class="search-cate pull-left">
					<div class="icon-search fa fa-search"></div>
					<?php if( is_active_sidebar( 'search' ) ): ?>
						<?php dynamic_sidebar( 'search' ); ?>
					<?php else : ?>
					<div class="widget onemall_top-3 onemall_top non-margin">
						<div class="widget-inner">
							<?php get_template_part( 'widgets/sw_top/searchcate' ); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
				<?php if (is_active_sidebar('header-right')) {?>
					<div  class="header-right pull-right">
							<?php dynamic_sidebar('header-right'); ?>
					</div>
				<?php }?>
			</div>
		</div>
	</div>
	<div class="header-bottom clearfix">
		<div class="container">
			<div class="row">
				
				<!-- Logo -->
				<div class="top-header pull-left">
					<div class="onemall-logo">
						<?php onemall_logo(); ?>
					</div>
				</div>
				
				<?php if ( has_nav_menu('vertical_menu') ) {?>
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 vertical_megamenu vertical_megamenu-header pull-left">
							<div class="mega-left-title"><strong><?php echo ( $onemall_title_text != '' ) ? $onemall_title_text : esc_html__('All Departments','onemall')?></strong></div>
							<div class="vc_wp_custommenu wpb_content_element">
								<div class="wrapper_vertical_menu vertical_megamenu" data-number="<?php echo esc_attr( $onemall_menu_item ); ?>" data-mnumber="<?php echo esc_attr( $onemall_mmenu_item ); ?>" data-moretext="<?php echo esc_attr( $onemall_more_text ); ?>" data-lesstext="<?php echo esc_attr( $onemall_less_text ); ?>">
									<?php wp_nav_menu(array('theme_location' => 'vertical_menu', 'menu_class' => 'nav vertical-megamenu')); ?>
								</div>
							</div>
						</div>
				<?php } ?>
				
				<!-- Primary navbar -->
				<?php if ( has_nav_menu('primary_menu') ) { ?>
					<div id="main-menu" class="main-menu clearfix pull-left">
						<nav id="primary-menu" class="primary-menu">
							<div class="mid-header clearfix">
								<div class="navbar-inner navbar-inverse">
										<?php
											$onemall_menu_class = 'nav nav-pills';
											if ( 'mega' == onemall_options()->getCpanelValue('menu_type') ){
												$onemall_menu_class .= ' nav-mega';
											} else $onemall_menu_class .= ' nav-css';
										?>
										<?php wp_nav_menu(array('theme_location' => 'primary_menu', 'menu_class' => $onemall_menu_class)); ?>
								</div>
							</div>
						</nav>
					</div>			
				<?php } ?>
				<!-- /Primary navbar -->
				
				<div class="header-block col-lg-2 col-md-2 col-sm-4 col-xs-4 pull-right">
					<?php if (is_active_sidebar('bottom-right')) {?>
						<?php dynamic_sidebar('bottom-right'); ?>
					<?php }?>
				</div>
				
				<?php if (is_active_sidebar('header-right')) {?>
					<div  class="header-right pull-right">
							<?php dynamic_sidebar('header-right'); ?>
					</div>
				<?php }?>
				
				<div class="search-cate pull-right">
					<i class="fa fa-search"></i>
					<?php if( is_active_sidebar( 'search' ) ): ?>
						<?php dynamic_sidebar( 'search' ); ?>
					<?php else : ?>
					<div class="widget topdeal_top-3 topdeal_top non-margin">
						<div class="widget-inner">
							<?php get_template_part( 'widgets/sw_top/searchcate' ); ?>
						</div>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</header>