<?php
$lib_dir = trailingslashit( str_replace( '\\', '/', get_template_directory() . '/lib/' ) );

if( !defined('ONEMALL_DIR') ){
	define( 'ONEMALL_DIR', $lib_dir );
}

if( !defined('ONEMALL_URL') ){
	define( 'ONEMALL_URL', trailingslashit( get_template_directory_uri() ) . 'lib' );
}

if( !defined('ONEMALL_OPTIONS_URL') ){
	define( 'ONEMALL_OPTIONS_URL', trailingslashit( get_template_directory_uri() ) . 'lib/options/' ); 
}

if ( !defined('SW_THEME') ){
	define( 'SW_THEME', 'onemall_theme' );
}

defined('ONEMALL_THEME') or die;

if (!isset($content_width)) { $content_width = 940; }

define("ONEMALL_PRODUCT_TYPE","product");
define("ONEMALL_PRODUCT_DETAIL_TYPE","product_detail");

require_once( get_template_directory().'/lib/options.php' );
function onemall_Options_Setup(){
	global $onemall_options, $options, $options_args;

	$options = array();
	$options[] = array(
			'title' => esc_html__('General', 'onemall'),
			'desc' => wp_kses( __('<p class="description">The theme allows to build your own styles right out of the backend without any coding knowledge. Upload new logo and favicon or get their URL.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it onemall for default.
			'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_019_cogwheel.png',
			//Lets leave this as a onemall section, no options just some intro text set above.
			'fields' => array(	
					
					array(
						'id' => 'sitelogo',
						'type' => 'upload',
						'title' => esc_html__('Logo Image', 'onemall'),
						'sub_desc' => esc_html__( 'Use the Upload button to upload the new logo and get URL of the logo', 'onemall' ),
						'std' => get_template_directory_uri().'/assets/img/logo-default.png'
					),
					
					array(
							'id' => 'bg_breadcrumb',
							'type' => 'upload',
							'title' => esc_html__('Breadcrumb Background', 'onemall'),
							'sub_desc' => esc_html__( 'Use upload button to upload custom background for breadcrumb.', 'onemall' ),
							'std' => ''
						),
	
					array(
						'id' => 'favicon',
						'type' => 'upload',
						'title' => esc_html__('Favicon', 'onemall'),
						'sub_desc' => esc_html__( 'Use the Upload button to upload the custom favicon', 'onemall' ),
						'std' => get_template_directory_uri().'/assets/img/favicon.ico'
					),
					
					array(
						'id' => 'tax_select',
						'type' => 'multi_select_taxonomy',
						'title' => esc_html__('Select Taxonomy', 'onemall'),
						'sub_desc' => esc_html__( 'Select taxonomy to show custom term metabox', 'onemall' ),
					),
					
					array(
						'id' => 'title_length',
						'type' => 'text',
						'title' => esc_html__('Title Length Of Item Listing Page', 'onemall'),
						'sub_desc' => esc_html__( 'Choose title length if you want to trim word, leave 0 to not trim word', 'onemall' ),
						'std' => 0
					),
					array(
					   'id' => 'page_404',
					   'type' => 'pages_select',
					   'title' => esc_html__('404 Page Content', 'onemall'),
					   'sub_desc' => esc_html__('Select page 404 content', 'onemall'),
					   'std' => ''
					),
			)	
		);
	
	$options[] = array(
			'title' => esc_html__('Schemes', 'onemall'),
			'desc' => wp_kses( __('<p class="description">Custom color scheme for theme. Unlimited color that you can choose.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it onemall for default.
			'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_163_iphone.png',
			//Lets leave this as a onemall section, no options just some intro text set above.
			'fields' => array(		
				array(
					'id' => 'scheme',
					'type' => 'radio_img',
					'title' => esc_html__('Color Scheme', 'onemall'),
					'sub_desc' => esc_html__( 'Select one of 2 predefined schemes', 'onemall' ),
					'desc' => '',
					'options' => array(
									'default' => array('title' => 'Default', 'img' => get_template_directory_uri().'/assets/img/default.png'),
									'orange' => array('title' => 'Orange', 'img' => get_template_directory_uri().'/assets/img/orange.png'),
									), //Must provide key => value(array:title|img) pairs for radio options
					'std' => 'default'
				),
				
				array(
					'id' => 'custom_color',
					'title' => esc_html__( 'Enable Custom Color', 'onemall' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Check this field to enable custom color and when you update your theme, custom color will not loose.', 'onemall' ),
					'desc' => '',
					'std' => '0'
				),
					
				array(
					'id' => 'developer_mode',
					'title' => esc_html__( 'Developer Mode', 'onemall' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Turn on/off compile less to css and custom color', 'onemall' ),
					'desc' => '',
					'std' => '0'
				),
				
				array(
					'id' => 'scheme_color',
					'type' => 'color',
					'title' => esc_html__('Color', 'onemall'),
					'sub_desc' => esc_html__('Select main custom color.', 'onemall'),
					'std' => ''
				),
						
			)
	);
	
	$options[] = array(
			'title' => esc_html__('Layout', 'onemall'),
			'desc' => wp_kses( __('<p class="description">SmartAddons Framework comes with a layout setting that allows you to build any number of stunning layouts and apply theme to your entries.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it onemall for default.
			'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_319_sort.png',
			//Lets leave this as a onemall section, no options just some intro text set above.
			'fields' => array(
					array(
						'id' => 'layout',
						'type' => 'select',
						'title' => esc_html__('Box Layout', 'onemall'),
						'sub_desc' => esc_html__( 'Select Layout Box or Wide', 'onemall' ),
						'options' => array(
							'full' => esc_html__( 'Wide', 'onemall' ),
							'boxed' => esc_html__( 'Boxed', 'onemall' )
						),
						'std' => 'wide'
					),
				
					array(
						'id' => 'bg_box_img',
						'type' => 'upload',
						'title' => esc_html__('Background Box Image', 'onemall'),
						'sub_desc' => '',
						'std' => ''
					),
					array(
							'id' => 'sidebar_left_expand',
							'type' => 'select',
							'title' => esc_html__('Left Sidebar Expand', 'onemall'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12', 
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '3',
							'sub_desc' => esc_html__( 'Select width of left sidebar.', 'onemall' ),
						),
					
					array(
							'id' => 'sidebar_right_expand',
							'type' => 'select',
							'title' => esc_html__('Right Sidebar Expand', 'onemall'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12',
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '3',
							'sub_desc' => esc_html__( 'Select width of right sidebar medium desktop.', 'onemall' ),
						),
						array(
							'id' => 'sidebar_left_expand_md',
							'type' => 'select',
							'title' => esc_html__('Left Sidebar Medium Desktop Expand', 'onemall'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12',
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '4',
							'sub_desc' => esc_html__( 'Select width of left sidebar medium desktop.', 'onemall' ),
						),
					array(
							'id' => 'sidebar_right_expand_md',
							'type' => 'select',
							'title' => esc_html__('Right Sidebar Medium Desktop Expand', 'onemall'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12',
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '4',
							'sub_desc' => esc_html__( 'Select width of right sidebar.', 'onemall' ),
						),
						array(
							'id' => 'sidebar_left_expand_sm',
							'type' => 'select',
							'title' => esc_html__('Left Sidebar Tablet Expand', 'onemall'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12',
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '4',
							'sub_desc' => esc_html__( 'Select width of left sidebar tablet.', 'onemall' ),
						),
					array(
							'id' => 'sidebar_right_expand_sm',
							'type' => 'select',
							'title' => esc_html__('Right Sidebar Tablet Expand', 'onemall'),
							'options' => array(
									'2' => '2/12',
									'3' => '3/12',
									'4' => '4/12',
									'5' => '5/12',
									'6' => '6/12',
									'7' => '7/12',
									'8' => '8/12',
									'9' => '9/12',
									'10' => '10/12',
									'11' => '11/12',
									'12' => '12/12'
								),
							'std' => '4',
							'sub_desc' => esc_html__( 'Select width of right sidebar tablet.', 'onemall' ),
						),				
				)
		);
	
	$options[] = array(
		'title' => esc_html__('Header & Footer', 'onemall'),
			'desc' => wp_kses( __('<p class="description">SmartAddons Framework comes with a header and footer setting that allows you to build style header.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it onemall for default.
			'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_336_read_it_later.png',
			//Lets leave this as a onemall section, no options just some intro text set above.
			'fields' => array(
				 array(
					'id' => 'header_style',
					'type' => 'select',
					'title' => esc_html__('Header Style', 'onemall'),
					'sub_desc' => esc_html__('Select Header style', 'onemall'),
					'options' => array(
							'style1'  => esc_html__( 'Style 1', 'onemall' ),
							'style2'  => esc_html__( 'Style 2', 'onemall' ),
							'style3'  => esc_html__( 'Style 3', 'onemall' ),
							),
					'std' => 'style1'
				),
				
				array(
					'id' => 'header_mid',
					'title' => esc_html__( 'Enable Background Header Mid', 'onemall' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( ' enable background hedaer mid on header', 'onemall' ),
					'desc' => '',
					'std' => '0'
				),
				
				array(
						'id' => 'bg_header_mid',
						'title' => esc_html__( 'Background header mid', 'onemall' ),
						'type' => 'upload',
						'sub_desc' => esc_html__( 'Choose header mid background image', 'onemall' ),
						'desc' => '',
						'std' => get_template_directory_uri().'/assets/img/popup/bg-main.jpg'
					),
					
				array(
					'id' => 'disable_search',
					'title' => esc_html__( 'Disable Search', 'onemall' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Check this to disable search on header', 'onemall' ),
					'desc' => '',
					'std' => '0'
				),
				
				array(
					'id' => 'disable_cart',
					'title' => esc_html__( 'Disable Cart', 'onemall' ),
					'type' => 'checkbox',
					'sub_desc' => esc_html__( 'Check this to disable cart on header', 'onemall' ),
					'desc' => '',
					'std' => '0'
				),				
				
				array(
				   'id' => 'footer_style',
				   'type' => 'pages_select',
				   'title' => esc_html__('Footer Style', 'onemall'),
				   'sub_desc' => esc_html__('Select Footer style', 'onemall'),
				   'std' => ''
				),
				
				
			)
	);
				
	$options[] = array(
			'title' => esc_html__('Mobile Layout', 'onemall'),
			'desc' => wp_kses( __('<p class="description">SmartAddons Framework comes with a mobile setting home page layout.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it onemall for default.
			'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_163_iphone.png',
			//Lets leave this as a onemall section, no options just some intro text set above.
			'fields' => array(				
				array(
					'id' => 'mobile_enable',
					'type' => 'checkbox',
					'title' => esc_html__('Enable Mobile Layout', 'onemall'),
					'sub_desc' => '',
					'desc' => '',
					'std' => '1'// 1 = on | 0 = off
				),
				
				array(
					'id' => 'mobile_logo',
					'type' => 'upload',
					'title' => esc_html__('Logo Mobile Image', 'onemall'),
					'sub_desc' => esc_html__( 'Use the Upload button to upload the new mobile logo', 'onemall' ),
					'std' => get_template_directory_uri().'/assets/img/logo-default.png'
				),
				
				array(
					'id' => 'mobile_logo_account',
					'type' => 'upload',
					'title' => esc_html__('Logo Mobile My Account Page', 'onemall'),
					'sub_desc' => esc_html__( 'Use the Upload button to upload the new mobile logo in my account page', 'onemall' ),
					'std' => get_template_directory_uri().'/assets/img/icon-myaccount.png'
				),
				
				array(
					'id' => 'sticky_mobile',
					'type' => 'checkbox',
					'title' => esc_html__('Sticky Mobile', 'onemall'),
					'sub_desc' => '',
					'desc' => '',
					'std' => '0'// 1 = on | 0 = off
				),
				
				array(
					'id' => 'mobile_content',
					'type' => 'pages_select',
					'title' => esc_html__('Mobile Layout Content', 'onemall'),
					'sub_desc' => esc_html__('Select content index for this mobile layout', 'onemall'),
					'std' => ''
				),
				
				array(
					'id' => 'mobile_header_style',
					'type' => 'select',
					'title' => esc_html__('Header Mobile Style', 'onemall'),
					'sub_desc' => esc_html__('Select header mobile style', 'onemall'),
					'options' => array(
							'mstyle1'  => esc_html__( 'Style 1', 'onemall' ),
							'mstyle2'  => esc_html__( 'Style 2', 'onemall' ),
					),
					'std' => 'style1'
				),
				
				array(
					'id' => 'mobile_footer_style',
					'type' => 'select',
					'title' => esc_html__('Footer Mobile Style', 'onemall'),
					'sub_desc' => esc_html__('Select footer mobile style', 'onemall'),
					'options' => array(
							'mstyle1'  => esc_html__( 'Style 1', 'onemall' ),
							'mstyle2'  => esc_html__( 'Style 2', 'onemall' ),
					),
					'std' => 'style1'
				),
				array(
					'id' => 'mobile_addcart',
					'type' => 'checkbox',
					'title' => esc_html__('Enable Add To Cart Button', 'onemall'),
					'sub_desc' => esc_html__( 'Enable Add To Cart Button on product listing', 'onemall' ),
					'desc' => '',
						'std' => '0'// 1 = on | 0 = off
				),
				
				array(
					'id' => 'mobile_header_inside',
					'type' => 'checkbox',
					'title' => esc_html__('Enable Header Other Pages', 'onemall'),
					'sub_desc' => esc_html__( 'Enable header in other pages which are different with homepage', 'onemall' ),
					'desc' => '',
						'std' => '0'// 1 = on | 0 = off
				),

				array(
					'id' => 'mobile_jquery',
					'type' => 'checkbox',
					'title' => esc_html__('Include Jquery Emarketlution', 'onemall'),
					'sub_desc' => '',
					'desc' => '',
					'std' => '0'// 1 = on | 0 = off
				),
			)
	);		
	$options[] = array(
			'title' => esc_html__('Navbar Options', 'onemall'),
			'desc' => wp_kses( __('<p class="description">If you got a big site with a lot of sub menus we recommend using a mega menu. Just select the dropbox to display a menu as mega menu or dropdown menu.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it onemall for default.
			'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_157_show_lines.png',
			//Lets leave this as a onemall section, no options just some intro text set above.
			'fields' => array(
				array(
						'id' => 'menu_type',
						'type' => 'select',
						'title' => esc_html__('Menu Type', 'onemall'),
						'options' => array( 'dropdown' => 'Dropdown Menu', 'mega' => 'Mega Menu' ),
						'std' => 'mega'
					),

				array(
						'id' => 'menu_location',
						'type' => 'menu_location_multi_select',
						'title' => esc_html__('Theme Location', 'onemall'),
						'sub_desc' => esc_html__( 'Select theme location to active mega menu and menu responsive.', 'onemall' ),
						'std' => 'primary_menu'
					),		
					
				array(
						'id' => 'sticky_menu',
						'type' => 'checkbox',
						'title' => esc_html__('Active sticky menu', 'onemall'),
						'sub_desc' => '',
						'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),
						
				array(
						'id' => 'more_menu',
						'type' => 'checkbox',
						'title' => esc_html__('Active More Menu', 'onemall'),
						'sub_desc' => esc_html__('Active more menu if your primary menu is too long', 'onemall'),
						'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),
					
				array(
						'id' => 'menu_event',
						'type' => 'select',
						'title' => esc_html__('Menu Event', 'onemall'),
						'options' => array( '' => esc_html__( 'Hover Event', 'onemall' ), 'click' => esc_html__( 'Click Event', 'onemall' ) ),
						'std' => ''
					),
				
				array(
					'id' => 'menu_number_item',
					'type' => 'text',
					'title' => esc_html__( 'Number Item Vertical', 'onemall' ),
					'sub_desc' => esc_html__( 'Number item vertical to show', 'onemall' ),
					'std' => 8
				),
				
				array(
					'id' => 'mmenu_number_item',
					'type' => 'text',
					'title' => esc_html__( 'Number Item Vertical Medium Desktop', 'onemall' ),
					'sub_desc' => esc_html__( 'Number item vertical to show on medium desktop', 'onemall' ),
					'std' => 6
				),	
				
				array(
					'id' => 'menu_title_text',
					'type' => 'text',
					'title' => esc_html__('Vertical Title Text', 'onemall'),
					'sub_desc' => esc_html__( 'Change title text on vertical menu', 'onemall' ),
					'std' => ''
				),
				
				array(
					'id' => 'menu_more_text',
					'type' => 'text',
					'title' => esc_html__('Vertical More Text', 'onemall'),
					'sub_desc' => esc_html__( 'Change more text on vertical menu', 'onemall' ),
					'std' => ''
				),
					
				array(
					'id' => 'menu_less_text',
					'type' => 'text',
					'title' => esc_html__('Vertical Less Text', 'onemall'),
					'sub_desc' => esc_html__( 'Change less text on vertical menu', 'onemall' ),
					'std' => ''
				)	
			)
		);
	$options[] = array(
		'title' => esc_html__('Blog Options', 'onemall'),
		'desc' => wp_kses( __('<p class="description">Select layout in blog listing page.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it onemall for default.
		'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_071_book.png',
		//Lets leave this as a onemall section, no options just some intro text set above.
		'fields' => array(
				array(
						'id' => 'sidebar_blog',
						'type' => 'select',
						'title' => esc_html__('Sidebar Blog Layout', 'onemall'),
						'options' => array(
								'full' => esc_html__( 'Full Layout', 'onemall' ),		
								'left'	=>  esc_html__( 'Left Sidebar', 'onemall' ),
								'right' => esc_html__( 'Right Sidebar', 'onemall' ),
						),
						'std' => 'left',
						'sub_desc' => esc_html__( 'Select style sidebar blog', 'onemall' ),
					),
					array(
						'id' => 'blog_layout',
						'type' => 'select',
						'title' => esc_html__('Layout blog', 'onemall'),
						'options' => array(
								'default'	=>  esc_html__( 'Default Layout', 'onemall' ),
								'list'	=>  esc_html__( 'List Layout', 'onemall' ),
								'grid' =>  esc_html__( 'Grid Layout', 'onemall' )								
						),
						'std' => 'default',
						'sub_desc' => esc_html__( 'Select style layout blog', 'onemall' ),
					),
					array(
						'id' => 'blog_column',
						'type' => 'select',
						'title' => esc_html__('Blog column', 'onemall'),
						'options' => array(								
								'2' => '2 columns',
								'3' => '3 columns',
								'4' => '4 columns'								
							),
						'std' => '2',
						'sub_desc' => esc_html__( 'Select style number column blog', 'onemall' ),
					),
			)
	);	
	$options[] = array(
		'title' => esc_html__('Product Options', 'onemall'),
		'desc' => wp_kses( __('<p class="description">Select layout in product listing page.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it onemall for default.
		'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_202_shopping_cart.png',
		//Lets leave this as a onemall section, no options just some intro text set above.
		'fields' => array(
			array(
				'id' => 'info_typo1',
				'type' => 'info',
				'title' => esc_html( 'Product Categories Config', 'onemall' ),
				'desc' => '',
				'class' => 'onemall-opt-info'
				),
			
			array(
				'id' => 'product_colcat_large',
				'type' => 'select',
				'title' => esc_html__('Product Category Listing column Desktop', 'onemall'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',							
					),
				'std' => '4',
				'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'onemall' ),
				),

			array(
				'id' => 'product_colcat_medium',
				'type' => 'select',
				'title' => esc_html__('Product Listing Category column Medium Desktop', 'onemall'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',	
					'5' => '5',
					'6' => '6',
					),
				'std' => '3',
				'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'onemall' ),
				),

			array(
				'id' => 'product_colcat_sm',
				'type' => 'select',
				'title' => esc_html__('Product Listing Category column Tablet', 'onemall'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',	
					'5' => '5',
					'6' => '6'
					),
				'std' => '2',
				'sub_desc' => esc_html__( 'Select number of column on Tablet Screen', 'onemall' ),
				),
			
			array(
				'id' => 'info_typo1',
				'type' => 'info',
				'title' => esc_html( 'Product General Config', 'onemall' ),
				'desc' => '',
				'class' => 'onemall-opt-info'
				),
				
			array(
				'id' => 'product_banner',
				'title' => esc_html__( 'Select Banner', 'onemall' ),
				'type' => 'select',
				'sub_desc' => '',
				'options' => array(
					'' => esc_html__( 'Use Banner', 'onemall' ),
					'listing' => esc_html__( 'Use Category Product Image', 'onemall' ),
					),
				'std' => '',
				),

			array(
				'id' => 'product_listing_banner',
				'type' => 'upload',
				'title' => esc_html__('Listing Banner Product', 'onemall'),
				'sub_desc' => esc_html__( 'Use the Upload button to upload banner product listing', 'onemall' ),
				'std' => get_template_directory_uri().'/assets/img/logo-default.png'
				),

			array(
				'id' => 'product_col_large',
				'type' => 'select',
				'title' => esc_html__('Product Listing column Desktop', 'onemall'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',							
					),
				'std' => '3',
				'sub_desc' => esc_html__( 'Select number of column on Desktop Screen', 'onemall' ),
				),

			array(
				'id' => 'product_col_medium',
				'type' => 'select',
				'title' => esc_html__('Product Listing column Medium Desktop', 'onemall'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',	
					'5' => '5',
					'6' => '6',
					),
				'std' => '2',
				'sub_desc' => esc_html__( 'Select number of column on Medium Desktop Screen', 'onemall' ),
				),

			array(
				'id' => 'product_col_sm',
				'type' => 'select',
				'title' => esc_html__('Product Listing column Tablet', 'onemall'),
				'options' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',	
					'5' => '5',
					'6' => '6'
					),
				'std' => '2',
				'sub_desc' => esc_html__( 'Select number of column on Tablet Screen', 'onemall' ),
				),

			array(
				'id' => 'sidebar_product',
				'type' => 'select',
				'title' => esc_html__('Sidebar Product Layout', 'onemall'),
				'options' => array(
					'left'	=> esc_html__( 'Left Sidebar', 'onemall' ),
					'full' => esc_html__( 'Full Layout', 'onemall' ),		
					'right' => esc_html__( 'Right Sidebar', 'onemall' )
					),
				'std' => 'left',
				'sub_desc' => esc_html__( 'Select style sidebar product', 'onemall' ),
				),

			array(
				'id' => 'product_quickview',
				'title' => esc_html__( 'Quickview', 'onemall' ),
				'type' => 'checkbox',
				'sub_desc' => '',
				'desc' => esc_html__( 'Turn On/Off Product Quickview', 'onemall' ),
				'std' => '1'
				),
			
			array(
				'id' => 'product_listing_countdown',
				'title' => esc_html__( 'Enable Countdown', 'onemall' ),
				'type' => 'checkbox',
				'sub_desc' => '',
				'desc' => esc_html__( 'Turn On/Off Product Countdown on product listing', 'onemall' ),
				'std' => '1'
				),
			
			
			array(
				'id' => 'product_number',
				'type' => 'text',
				'title' => esc_html__('Product Listing Number', 'onemall'),
				'sub_desc' => esc_html__( 'Show number of product in listing product page.', 'onemall' ),
				'std' => 12
				),
			
			array(
				'id' => 'newproduct_time',
				'title' => esc_html__( 'New Product', 'onemall' ),
				'type' => 'number',
				'sub_desc' => '',
				'desc' => esc_html__( 'Set day for the new product label from the date publish product.', 'onemall' ),
				'std' => 1
				),
			
			array(
				'id' => 'info_typo1',
				'type' => 'info',
				'title' => esc_html( 'Product Single Config', 'onemall' ),
				'desc' => '',
				'class' => 'onemall-opt-info'
				),
			
			array(
				'id' => 'sidebar_product_detail',
				'type' => 'select',
				'title' => esc_html__('Sidebar Product Single Layout', 'onemall'),
				'options' => array(
					'left'	=> esc_html__( 'Left Sidebar', 'onemall' ),
					'full' => esc_html__( 'Full Layout', 'onemall' ),		
					'right' => esc_html__( 'Right Sidebar', 'onemall' )
					),
				'std' => 'left',
				'sub_desc' => esc_html__( 'Select style sidebar product single', 'onemall' ),
				),
			
			array(
				'id' => 'product_single_style',
				'type' => 'select',
				'title' => esc_html__('Product Detail Style', 'onemall'),
				'options' => array(
					'default'	=> esc_html__( 'Default', 'onemall' ),
					'style1' 	=> esc_html__( 'Full Width', 'onemall' ),	
					'style2' 	=> esc_html__( 'Full Width With Accordion', 'onemall' ),	
					'style3' 	=> esc_html__( 'Full Width With Accordion 1', 'onemall' ),	
				),
				'std' => 'default',
				'sub_desc' => esc_html__( 'Select style for product single', 'onemall' ),
				),
			
			array(
				'id' => 'product_single_thumbnail',
				'type' => 'select',
				'title' => esc_html__('Product Thumbnail Position', 'onemall'),
				'options' => array(
					'bottom'	=> esc_html__( 'Bottom', 'onemall' ),
					'left' 		=> esc_html__( 'Left', 'onemall' ),	
					'right' 	=> esc_html__( 'Right', 'onemall' ),	
					'top' 		=> esc_html__( 'Top', 'onemall' ),					
				),
				'std' => 'bottom',
				'sub_desc' => esc_html__( 'Select style for product single thumbnail', 'onemall' ),
				),		
			
			
			array(
				'id' => 'product_zoom',
				'title' => esc_html__( 'Product Zoom', 'onemall' ),
				'type' => 'checkbox',
				'sub_desc' => '',
				'desc' => esc_html__( 'Turn On/Off image zoom when hover on single product', 'onemall' ),
				'std' => '1'
				),
			
			array(
				'id' => 'product_brand',
				'title' => esc_html__( 'Enable Product Brand Image', 'onemall' ),
				'type' => 'checkbox',
				'sub_desc' => '',
				'desc' => esc_html__( 'Turn On/Off product brand image show on single product.', 'onemall' ),
				'std' => '1'
				),

			array(
				'id' => 'product_single_countdown',
				'title' => esc_html__( 'Enable Countdown Single', 'onemall' ),
				'type' => 'checkbox',
				'sub_desc' => '',
				'desc' => esc_html__( 'Turn On/Off Product Countdown on product single', 'onemall' ),
				'std' => '1'
				),
			
			array(
				'id' => 'info_typo1',
				'type' => 'info',
				'title' => esc_html( 'Config For Product Categories Widget', 'onemall' ),
				'desc' => '',
				'class' => 'onemall-opt-info'
				),

			array(
				'id' => 'product_number_item',
				'type' => 'text',
				'title' => esc_html__( 'Category Number Item Show', 'onemall' ),
				'sub_desc' => esc_html__( 'Choose to number of item category that you want to show, leave 0 to show all category', 'onemall' ),
				'std' => 8
				),	

			array(
				'id' => 'product_more_text',
				'type' => 'text',
				'title' => esc_html__( 'Category More Text', 'onemall' ),
				'sub_desc' => esc_html__( 'Change more text on category product', 'onemall' ),
				'std' => ''
				),

			array(
				'id' => 'product_less_text',
				'type' => 'text',
				'title' => esc_html__( 'Category Less Text', 'onemall' ),
				'sub_desc' => esc_html__( 'Change less text on category product', 'onemall' ),
				'std' => ''
				)	
		)
);		
	$options[] = array(
			'title' => esc_html__('Typography', 'onemall'),
			'desc' => wp_kses( __('<p class="description">Change the font style of your blog, custom with Google Font.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it onemall for default.
			'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_151_edit.png',
			//Lets leave this as a onemall section, no options just some intro text set above.
			'fields' => array(
				array(
					'id' => 'info_typo1',
					'type' => 'info',
					'title' => esc_html( 'Global Typography', 'onemall' ),
					'desc' => '',
					'class' => 'onemall-opt-info'
					),

				array(
					'id' => 'google_webfonts',
					'type' => 'google_webfonts',
					'title' => esc_html__('Use Google Webfont', 'onemall'),
					'sub_desc' => esc_html__( 'Insert font style that you actually need on your webpage.', 'onemall' ), 
					'std' => ''
					),

				array(
					'id' => 'webfonts_weight',
					'type' => 'multi_select',
					'sub_desc' => esc_html__( 'For weight, see Google Fonts to custom for each font style.', 'onemall' ),
					'title' => esc_html__('Webfont Weight', 'onemall'),
					'options' => array(
						'100' => '100',
						'200' => '200',
						'300' => '300',
						'400' => '400',
						'500' => '500',
						'600' => '600',
						'700' => '700',
						'800' => '800',
						'900' => '900'
						),
					'std' => ''
					),

				array(
					'id' => 'info_typo2',
					'type' => 'info',
					'title' => esc_html( 'Header Tag Typography', 'onemall' ),
					'desc' => '',
					'class' => 'onemall-opt-info'
					),

				array(
					'id' => 'header_tag_font',
					'type' => 'google_webfonts',
					'title' => esc_html__('Header Tag Font', 'onemall'),
					'sub_desc' => esc_html__( 'Select custom font for header tag ( h1...h6 )', 'onemall' ), 
					'std' => ''
					),

				array(
					'id' => 'info_typo2',
					'type' => 'info',
					'title' => esc_html( 'Main Menu Typography', 'onemall' ),
					'desc' => '',
					'class' => 'onemall-opt-info'
					),

				array(
					'id' => 'menu_font',
					'type' => 'google_webfonts',
					'title' => esc_html__('Main Menu Font', 'onemall'),
					'sub_desc' => esc_html__( 'Select custom font for main menu', 'onemall' ), 
					'std' => ''
					),
					
				array(
					'id' => 'info_typo2',
					'type' => 'info',
					'title' => esc_html( 'Custom Typography', 'onemall' ),
					'desc' => '',
					'class' => 'onemall-opt-info'
				),

				array(
					'id' => 'custom_font',
					'type' => 'google_webfonts',
					'title' => esc_html__('Custom Font', 'onemall'),
					'sub_desc' => esc_html__( 'Select custom font for custom class', 'onemall' ), 
					'std' => ''
				),
				
				array(
					'id' => 'custom_font_class',
					'title' => esc_html__( 'Custom Font Class', 'onemall' ),
					'type' => 'text',
					'sub_desc' => esc_html__( 'Put custom class to this field. Each class separated by commas.', 'onemall' ),
					'desc' => '',
					'std' => '',
				),
			)
		);
	
	$options[] = array(
		'title' => __('Social', 'onemall'),
		'desc' => wp_kses( __('<p class="description">This feature allow to you link to your social.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
		//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
		//You dont have to though, leave it blank for default.
		'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_222_share.png',
		//Lets leave this as a blank section, no options just some intro text set above.
		'fields' => array(
				array(
						'id' => 'social-share-fb',
						'title' => esc_html__( 'Facebook', 'onemall' ),
						'type' => 'text',
						'sub_desc' => '',
						'desc' => '',
						'std' => '',
					),
				array(
						'id' => 'social-share-tw',
						'title' => esc_html__( 'Twitter', 'onemall' ),
						'type' => 'text',
						'sub_desc' => '',
						'desc' => '',
						'std' => '',
					),
				array(
						'id' => 'social-share-tumblr',
						'title' => esc_html__( 'Tumblr', 'onemall' ),
						'type' => 'text',
						'sub_desc' => '',
						'desc' => '',
						'std' => '',
					),
				array(
						'id' => 'social-share-in',
						'title' => esc_html__( 'Linkedin', 'onemall' ),
						'type' => 'text',
						'sub_desc' => '',
						'desc' => '',
						'std' => '',
					),
					array(
						'id' => 'social-share-instagram',
						'title' => esc_html__( 'Instagram', 'onemall' ),
						'type' => 'text',
						'sub_desc' => '',
						'desc' => '',
						'std' => '',
					),
				array(
						'id' => 'social-share-go',
						'title' => esc_html__( 'Google+', 'onemall' ),
						'type' => 'text',
						'sub_desc' => '',
						'desc' => '',
						'std' => '',
					),
				array(
					'id' => 'social-share-pi',
					'title' => esc_html__( 'Pinterest', 'onemall' ),
					'type' => 'text',
					'sub_desc' => '',
					'desc' => '',
					'std' => '',
				)
					
			)
	);
	
	$options[] = array(
			'title' => esc_html__('Maintaincece Mode', 'onemall'),
			'desc' => wp_kses( __('<p class="description">Enable and config for Maintaincece mode.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it onemall for default.
			'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_083_random.png',
			//Lets leave this as a onemall section, no options just some intro text set above.
			'fields' => array(
					array(
						'id' => 'maintaince_enable',
						'title' => esc_html__( 'Enable Maintaincece Mode', 'onemall' ),
						'type' => 'checkbox',
						'sub_desc' => esc_html__( 'Turn on/off Maintaince mode on this website', 'onemall' ),
						'desc' => '',
						'std' => '0'
					),
					
					array(
						'id' => 'maintaince_background',
						'title' => esc_html__( 'Maintaince Background', 'onemall' ),
						'type' => 'upload',
						'sub_desc' => esc_html__( 'Choose maintance background image', 'onemall' ),
						'desc' => '',
						'std' => get_template_directory_uri().'/assets/img/maintaince/bg-main.jpg'
					),
					
					array(
						'id' => 'maintaince_content',
						'title' => esc_html__( 'Maintaince Content', 'onemall' ),
						'type' => 'editor',
						'sub_desc' => esc_html__( 'Change text of maintaince mode', 'onemall' ),
						'desc' => '',
						'std' => ''
					),
					
					array(
						'id' => 'maintaince_date',
						'title' => esc_html__( 'Maintaince Date', 'onemall' ),
						'type' => 'date',
						'sub_desc' => esc_html__( 'Put date to this field to show countdown date on maintaince mode.', 'onemall' ),
						'desc' => '',
						'placeholder' => 'mm/dd/yy',
						'std' => ''
					),
					
					array(
						'id' => 'maintaince_form',
						'title' => esc_html__( 'Maintaince Form', 'onemall' ),
						'type' => 'text',
						'sub_desc' => esc_html__( 'Put shortcode form to this field and it will be shown on maintaince mode frontend.', 'onemall' ),
						'desc' => '',
						'std' => ''
					),
					
				)
		);
		
	$options[] = array(
			'title' => esc_html__('Popup Config', 'onemall'),
			'desc' => wp_kses( __('<p class="description">Enable popup and more config for Popup.</p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it onemall for default.
			'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_083_random.png',
			//Lets leave this as a onemall section, no options just some intro text set above.
			'fields' => array(
					array(
						'id' => 'popup_active',
						'type' => 'checkbox',
						'title' => esc_html__( 'Active Popup Subscribe', 'onemall' ),
						'sub_desc' => esc_html__( 'Check to active popup subscribe', 'onemall' ),
						'desc' => '',
						'std' => '0'// 1 = on | 0 = off
					),	
					
					array(
						'id' => 'popup_background',
						'title' => esc_html__( 'Popup Background', 'onemall' ),
						'type' => 'upload',
						'sub_desc' => esc_html__( 'Choose popup background image', 'onemall' ),
						'desc' => '',
						'std' => get_template_directory_uri().'/assets/img/popup/bg-main.jpg'
					),
					
					array(
						'id' => 'popup_content',
						'title' => esc_html__( 'Popup Content', 'onemall' ),
						'type' => 'editor',
						'sub_desc' => esc_html__( 'Change text of popup mode', 'onemall' ),
						'desc' => '',
						'std' => ''
					),	
					
					array(
						'id' => 'popup_form',
						'title' => esc_html__( 'Popup Form', 'onemall' ),
						'type' => 'text',
						'sub_desc' => esc_html__( 'Put shortcode form to this field and it will be shown on popup mode frontend.', 'onemall' ),
						'desc' => '',
						'std' => ''
					),
					
				)
		);
	
	$options[] = array(
			'title' => esc_html__('Advanced', 'onemall'),
			'desc' => wp_kses( __('<p class="description">Custom advanced with Cpanel, Widget advanced, Developer mode </p>', 'onemall'), array( 'p' => array( 'class' => array() ) ) ),
			//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
			//You dont have to though, leave it onemall for default.
			'icon' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_083_random.png',
			//Lets leave this as a onemall section, no options just some intro text set above.
			'fields' => array(
					array(
						'id' => 'show_cpanel',
						'title' => esc_html__( 'Show cPanel', 'onemall' ),
						'type' => 'checkbox',
						'sub_desc' => esc_html__( 'Turn on/off Cpanel', 'onemall' ),
						'desc' => '',
						'std' => ''
					),
					
					array(
						'id' => 'widget-advanced',
						'title' => esc_html__('Widget Advanced', 'onemall'),
						'type' => 'checkbox',
						'sub_desc' => esc_html__( 'Turn on/off Widget Advanced', 'onemall' ),
						'desc' => '',
						'std' => '1'
					),					
					
					array(
						'id' => 'social_share',
						'title' => esc_html__( 'Social Share', 'onemall' ),
						'type' => 'checkbox',
						'sub_desc' => esc_html__( 'Turn on/off social share', 'onemall' ),
						'desc' => '',
						'std' => '1'
					),
					
					array(
						'id' => 'breadcrumb_active',
						'title' => esc_html__( 'Turn Off Breadcrumb', 'onemall' ),
						'type' => 'checkbox',
						'sub_desc' => esc_html__( 'Turn off breadcumb on all page', 'onemall' ),
						'desc' => '',
						'std' => '0'
					),
					
					array(
						'id' => 'back_active',
						'type' => 'checkbox',
						'title' => esc_html__('Back to top', 'onemall'),
						'sub_desc' => '',
						'desc' => '',
						'std' => '1'// 1 = on | 0 = off
					),	
					
					array(
						'id' => 'direction',
						'type' => 'select',
						'title' => esc_html__('Direction', 'onemall'),
						'options' => array( 'ltr' => 'Left to Right', 'rtl' => 'Right to Left' ),
						'std' => 'ltr'
					),
					
					array(
						'id' => 'advanced_js',
						'type' => 'textarea',
						'placeholder' => esc_html__( 'Example: $("p").hide()', 'onemall' ),
						'sub_desc' => esc_html__( 'Insert your own JS into this block. This customizes js throughout the theme', 'onemall' ),
						'title' => esc_html__( 'Custom JS', 'onemall' )
					)
				)
		);

	$options_args = array();

	//Setup custom links in the footer for share icons
	$options_args['share_icons']['facebook'] = array(
			'link' => 'http://www.facebook.com/wpthemego',
			'title' => 'Facebook',
			'img' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_320_facebook.png'
	);
	$options_args['share_icons']['twitter'] = array(
			'link' => 'https://twitter.com/wpthemego',
			'title' => 'Folow me on Twitter',
			'img' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_322_twitter.png'
	);
	$options_args['share_icons']['linked_in'] = array(
			'link' => '#',
			'title' => 'Find me on LinkedIn',
			'img' => ONEMALL_URL.'/options/img/glyphicons/glyphicons_337_linked_in.png'
	);


	//Choose a custom option name for your theme options, the default is the theme name in lowercase with spaces replaced by underscores
	$options_args['opt_name'] = ONEMALL_THEME;

	$options_args['google_api_key'] = 'AIzaSyAL_XMT9t2KuBe2MIcofGl6YF1IFzfB4L4'; //must be defined for use with google webfonts field type

	//Custom menu title for options page - default is "Options"
	$options_args['menu_title'] = esc_html__('Theme Options', 'onemall');

	//Custom Page Title for options page - default is "Options"
	$options_args['page_title'] = esc_html__('Onemall Options ', 'onemall') . wp_get_theme()->get('Name');

	//Custom page slug for options page (wp-admin/themes.php?page=***) - default is "onemall_theme_options"
	$options_args['page_slug'] = 'onemall_theme_options';

	//page type - "menu" (adds a top menu section) or "submenu" (adds a submenu) - default is set to "menu"
	$options_args['page_type'] = 'submenu';

	//custom page location - default 100 - must be unique or will override other items
	$options_args['page_position'] = 27;
	$onemall_options = new Onemall_Options( $options, $options_args );
}
add_action( 'admin_init', 'onemall_Options_Setup', 0 );
onemall_Options_Setup();

add_filter( 'sw_googlefont_api_key_filter', 'onemall_custom_google_api_key' );
function onemall_custom_google_api_key(){
	$webfont = ( onemall_options()->getCpanelValue( 'google_webfonts_api' ) != '' ) ? onemall_options()->getCpanelValue( 'google_webfonts_api' ) : 'AIzaSyAL_XMT9t2KuBe2MIcofGl6YF1IFzfB4L4';
	return $webfont;
}

function onemall_widget_setup_args(){
	$onemall_widget_areas = array(
		
		array(
				'name' => esc_html__('Sidebar Left Blog', 'onemall'),
				'id'   => 'left-blog',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="block-title-widget"><h2><span>',
				'after_title' => '</span></h2></div>'
		),
		array(
				'name' => esc_html__('Sidebar Right Blog', 'onemall'),
				'id'   => 'right-blog',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="block-title-widget"><h2><span>',
				'after_title' => '</span></h2></div>'
		),
		
		array(
				'name' => esc_html__('Top Header', 'onemall'),
				'id'   => 'top',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Header Right', 'onemall'),
				'id'   => 'header-right',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Bottom Right', 'onemall'),
				'id'   => 'bottom-right',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		array(
				'name' => esc_html__('Bottom Right2', 'onemall'),
				'id'   => 'bottom-right2',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Sidebar Left Product', 'onemall'),
				'id'   => 'left-product',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="block-title-widget"><h2><span>',
				'after_title' => '</span></h2></div>'
		),
		
		array(
				'name' => esc_html__('Sidebar Right Product', 'onemall'),
				'id'   => 'right-product',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="block-title-widget"><h2><span>',
				'after_title' => '</span></h2></div>'
		),
		
		array(
				'name' => esc_html__('Sidebar Left Detail Product', 'onemall'),
				'id'   => 'left-product-detail',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="block-title-widget"><h2><span>',
				'after_title' => '</span></h2></div>'
		),
		
		array(
				'name' => esc_html__('Sidebar Right Detail Product', 'onemall'),
				'id'   => 'right-product-detail',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget' => '</div></div>',
				'before_title' => '<div class="block-title-widget"><h2><span>',
				'after_title' => '</span></h2></div>'
		),
		
		array(
				'name' => esc_html__('Sidebar Bottom Detail Product', 'onemall'),
				'id'   => 'bottom-detail-product',
				'before_widget' => '<div class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
			array(
				'name' => esc_html__('Bottom Detail Product Mobile', 'onemall'),
				'id'   => 'bottom-detail-product-mobile',
				'before_widget' => '<div class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Filter Mobile', 'onemall'),
				'id'   => 'filter-mobile',
				'before_widget' => '<div class="widget %1$s %2$s" data-scroll-reveal="enter bottom move 20px wait 0.2s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
		
		array(
				'name' => esc_html__('Footer Copyright', 'onemall'),
				'id'   => 'footer-copyright',
				'before_widget' => '<div class="widget %1$s %2$s"><div class="widget-inner">',
				'after_widget'  => '</div></div>',
				'before_title'  => '<h3>',
				'after_title'   => '</h3>'
		),
	);
	return apply_filters( 'onemall_widget_register', $onemall_widget_areas );
}