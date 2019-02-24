<?php 
	if( !is_array( $select_order ) ){
		$select_order = explode( ',', $select_order );
	}
	$widget_id = isset( $widget_id ) ? $widget_id : $this->generateID();
?>
<div class="sw-wootab-slider sw-ajax sw-woo-tab-style2" id="<?php echo esc_attr( $widget_id ); ?>" >
	<div class="resp-tab" style="position:relative;">
		<div class="top-tab-slider clearfix">
			<div class="order-title">
			<?php 
				if( $title1 != '' ){
					echo '<h2>'. $title1 . '</h2>'; 
			}
			?>
			</div>
			<?php if( $description1 != '' ){  ?>
				<div class="description"><?php echo ( $description1 != '' ) ? esc_html( $description1 ) : ''; ?></div>
			<?php } ?>
			<ul class="nav nav-tabs">
				<?php 
						$active = $tab_active -1;
						$tab_title = '';
						foreach( $select_order as $i  => $so ){						
							switch ($so) {
							case 'latest':
								$tab_title = __( 'Latest Products', 'sw_woocommerce' );
							break;
							case 'rating':
								$tab_title = __( 'Top Rating ', 'sw_woocommerce' );
							break;
							case 'bestsales':
								$tab_title = __( 'Best Selling ', 'sw_woocommerce' );
							break;						
							default:
								$tab_title = __( 'Featured Products', 'sw_woocommerce' );
							}
					?>
					<li <?php echo ( $i == $active )? 'class="active loaded"' : ''; ?>>
						<a href="#<?php echo esc_attr( $so. '_' .$widget_id ) ?>" data-type="so_ajax" data-layout="<?php echo esc_attr( $layout );?>" data-length="<?php echo esc_attr( $title_length ) ?>" data-row="<?php echo esc_attr( $item_row ) ?>"   data-row2="<?php echo esc_attr( $item_row2 ) ?>" data-ajaxurl="<?php echo esc_url( sw_ajax_url() ) ?>" data-category="<?php echo esc_attr( $category ) ?>" data-toggle="tab" data-sorder="<?php echo esc_attr( $so ); ?>" data-catload="ajax" data-number="<?php echo esc_attr( $numberposts ); ?>" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>"  data-autoplay="<?php echo esc_attr( $autoplay ); ?>">
							<?php echo esc_html( $tab_title ); ?>
						</a>
					</li>			
				<?php } ?>
			</ul>
		</div>		
		<div class="tab-content clearfix">	
		<!-- Product tab slider -->						
			<div class="tab-pane active" id="<?php echo esc_attr( $select_order[$active]. '_' .$widget_id ) ?>">
			<?php 
				$default = array();			
				if( $select_order[$active] == 'latest' ){
					$default = array(
						'post_type'	=> 'product',
						'paged'		=> 1,
						'showposts'	=> $numberposts,
						'orderby'	=> 'date'
					);						
				}
				if( $select_order[$active] == 'rating' ){
					$default = array(
						'post_type'		=> 'product',							
						'post_status' 	=> 'publish',
						'no_found_rows' => 1,					
						'showposts' 	=> $numberposts						
					);
					if( sw_woocommerce_version_check( '3.0' ) ){	
						$default['meta_key'] = '_wc_average_rating';	
						$default['orderby'] = 'meta_value_num';
					}else{	
						add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
					}
				}
				if( $select_order[$active] == 'bestsales' ){
					$default = array(
						'post_type' 			=> 'product',							
						'post_status' 			=> 'publish',
						'ignore_sticky_posts'   => 1,
						'showposts'				=> $numberposts,
						'meta_key' 		 		=> 'total_sales',
						'orderby' 		 		=> 'meta_value_num',						
					);
				}
				if( $select_order[$active] == 'featured' ){
					$default = array(
						'post_type'	=> 'product',
						'post_status' 			=> 'publish',
						'ignore_sticky_posts'	=> 1,
						'showposts' 		=> $numberposts						
					);
					if( sw_woocommerce_version_check( '3.0' ) ){	
						$default['tax_query'][] = array(						
							'taxonomy' => 'product_visibility',
							'field'    => 'name',
							'terms'    => 'featured',
							'operator' => 'IN',	
						);
					}else{
						$default['meta_query'] = array(
							array(
								'key' 		=> '_featured',
								'value' 	=> 'yes'
							)					
						);				
					}
				}
				if( $category != '' ){
					$default['tax_query'][] = array(
						'taxonomy'	=> 'product_cat',
						'field'		=> 'slug',
						'terms'		=> $category,
						'operator' 	=> 'IN'
					);
				}
				
				$default = sw_check_product_visiblity( $default );
				$list = new WP_Query( $default );
				if( $select_order[$active] == 'rating' && ! sw_woocommerce_version_check( '3.0' ) ){			
					remove_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
				}
				if( $list->have_posts() ) :
			?>
				<div id="<?php echo esc_attr( 'tab_'. $select_order[$active]. '_' .$widget_id ); ?>" class="woo-tab-container-listing clearfix">
					<!-- get 5 product first -->
					<div class="item item-product item-large item-top product-tab-listing pull-left">
						<div class="item-wrapper">
							<div class="item-wrap product-responsive">							
								<?php 
									$i = 0;
									while( $i < 5 && $list->have_posts() ): $list->the_post(); 
									global $product;
								?>
								<div class="item-detail">
									<div class="item-image products-thumb">
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
										<?php echo onemall_quickview(); ?>
										<?php sw_label_sales(); ?>
									</div>
									<div class="item-content">
										<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php sw_trim_words( get_the_title(), $title_length ); ?></a></h4>								
										<!-- rating  -->
										<?php 
											$rating_count = $product->get_rating_count();
											$review_count = $product->get_review_count();
											$average      = $product->get_average_rating();
											if( $review_count > 1 ) {
												$review_text = esc_html__('reviews','sw_woocommerce');
											}else {
												$review_text = esc_html__('review','sw_woocommerce');
											}
										?>
										<div class="reviews-content">
											<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*13 ).'px"></span>' : ''; ?></div>
										</div>									
										<!-- end rating  -->														
									<!-- price -->
									<?php if ( $price_html = $product->get_price_html() ){ ?>
										<div class="item-price">
											<span>
												<?php echo $price_html; ?>
											</span>
										</div>
									<?php } ?>
									<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
									</div>
								</div>
								<?php $i++; endwhile; ?>							
							</div>
							<div class="slider product-responsive-thumbnail">
								<?php $post_id = $list->posts; ?>
								<?php for( $j = 0; $j < 5; $j++ ){ ?>
									<div class="item-thumbnail">
									<?php echo get_the_post_thumbnail( $post_id[$j]->ID, 'shop_thumbnail' ); ?>
									</div>
								<?php } ?>
							</div>
						</div>						
					</div>
					
				<!-- get all product after 5 product above -->
				<?php 
					while( $i >= 5 && $list->have_posts() ): $list->the_post(); 
					global $product;
				?>
				<div class="item item-product pull-left">
					<div class="item-wrap">
						<div class="item-detail">							
							<div class="item-image products-thumb">
								<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
							</div>
							<div class="item-content">
								<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php sw_trim_words( get_the_title(), $title_length ); ?></a></h4>								
								<!-- rating  -->
								<?php 
									$rating_count = $product->get_rating_count();
									$review_count = $product->get_review_count();
									$average      = $product->get_average_rating();
									if( $review_count > 1 ) {
										$review_text = esc_html__('reviews','sw_woocommerce');
									}else {
										$review_text = esc_html__('review','sw_woocommerce');
									}
								?>
								<div class="reviews-content">
									<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*13 ).'px"></span>' : ''; ?></div> <?php if($i==1) : ?><span class="review_count">(<?php echo $review_count;?> <?php echo $review_text; ?>)</span><?php endif ?>
								</div>									
								<!-- end rating  -->														
							<!-- price -->
							<?php if ( $price_html = $product->get_price_html() ){ ?>
								<div class="item-price">
									<span>
										<?php echo $price_html; ?>
									</span>
								</div>
							<?php } ?>
							<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
							</div>							
						</div>
					</div>
				</div>
				<?php $i++; endwhile; wp_reset_postdata();?>
				</div>
				
			<?php 
				else :
					echo '<div class="alert alert-warning alert-dismissible" role="alert">
					<a class="close" data-dismiss="alert">&times;</a>
					<p>'. esc_html__( 'There is not product on this tab', 'sw_woocommerce' ) .'</p>
					</div>';
				endif;				
			?>
			</div>
		<!-- End product tab slider -->
		</div>
	</div>
</div>
