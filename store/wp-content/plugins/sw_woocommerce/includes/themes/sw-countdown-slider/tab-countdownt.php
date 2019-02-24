<?php 
/**
	* Layout Countdown Default
	* @version     1.0.0
**/
$category = explode( ',', $category );
foreach( $category as $key => $cat ) {
	$term_name = esc_html__( 'All Categories', 'sw_woocommerce' );
	$default = array(
		'post_type' => 'product',	
		'meta_query' => array(
			array(
				'key' => '_sale_price',
				'value' => 0,
				'compare' => '>',
				'type' => 'DECIMAL(10,5)'
			),
			array(
				'key' => '_sale_price_dates_from',
				'value' => time(),
				'compare' => '<',
				'type' => 'NUMERIC'
			),
			array(
				'key' => '_sale_price_dates_to',
				'value' => time(),
				'compare' => '>',
				'type' => 'NUMERIC'
			)
		),
		'orderby' => $orderby,
		'order' => $order,
		'post_status' => 'publish',
		'showposts' => $numberposts	
	);
	if( $cat != '' ){
		$term = get_term_by( 'slug', $cat, 'product_cat' );	
		$term_name = $term->name;
		$default['tax_query'] = array(
			array(
				'taxonomy'  => 'product_cat',
				'field'     => 'slug',
				'terms'     => $cat ));
	}
	$default = sw_check_product_visiblity( $default );
	$countdown_id = 'sw_tab_countdown_'.$this->generateID();
	$countdown_id2 = 'sw_tab_countdown2_'.$this->generateID();
	$list = new WP_Query( $default );
	if ( $list -> have_posts() ){ 
?>
	<div id="<?php echo esc_attr( $cat.'_' . $key.rand() ); ?>" class="sw_tab_countdown">
		<?php if( $title1 != '' ){?>
			<div class="block-title">
				<h3><?php echo ( $title1 != '' ) ? $title1 : ''; ?></h3>
			</div>
		<?php } ?>
		<div  class="tab-countdown-slide clearfix">
			<div class="top-tab-slider-full clearfix">	
				<div id="<?php echo 'tab2_' . $countdown_id2; ?>" class="sw-tab-slider responsive-slider loading" data-lg="8" data-md="7" data-sm="6" data-xs="4" data-mobile="2" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>" data-autoplay="false" data-vertical="false">
					<ul class="nav nav-tabs slider responsive">
						<?php
							$i = 0;
							while($list->have_posts()): $list->the_post();	
							global $post;
						?>
						<li class="<?php echo ( $i == 0  ) ? 'active' : '' ?>">
							<a href="#<?php echo 'product_tab_'.$post->ID; ?>" data-toggle="tab">
								<?php echo get_the_post_thumbnail( $post->ID, array(100,100) ); ?>
							</a>
						</li>
						<?php
							$i++; endwhile; wp_reset_postdata();
						?>
					</ul>
				</div>
			</div>
			<div class="tab-content clearfix">
				<?php
					$count_items 	= 0;
					$numb 			= ( $list->found_posts > 0 ) ? $list->found_posts : count( $list->posts );
					$count_items 	= ( $numberposts >= $numb ) ? $numb : $numberposts;
					$i 				= 0;
					while($list->have_posts()): $list->the_post();
					global $product, $post;
					$start_time 	= get_post_meta( $post->ID, '_sale_price_dates_from', true );
					$countdown_date = get_post_meta( $post->ID, '_sale_price_dates_to', true );	
					$class = ( $product->get_price_html() ) ? '' : 'item-nonprice';
				?>
				<div class="tab-pane <?php echo ( $i == 0 ) ? 'active' : ''; ?>" id="<?php echo 'product_tab_'.$post->ID; ?>" >
					<div class="item">
						<div class="item-wrap">
							<div class="item-detail">
								<div class="item-image-countdown products-thumb">
									<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
								</div>
								<div class="item-content">
																	
									<h4><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php sw_trim_words( get_the_title(), $title_length ); ?></a></h4>
									<!-- rating  -->
									<?php 
										$rating_count = $product->get_rating_count();
										$review_count = $product->get_review_count();
										$average      = $product->get_average_rating();
									?>
									<div class="reviews-content">
										<div class="star"><?php echo ( $average > 0 ) ?'<span style="width:'. ( $average*13 ).'px"></span>' : ''; ?></div>
									</div>									
									<!-- end rating  -->
									<div class="description"><?php echo $post->post_excerpt; ?></div>
									<!-- Price -->
									<?php if ( $price_html = $product->get_price_html() ){?>
									<div class="item-price">
										<span>
											<?php echo $price_html; ?>
										</span>
									</div>
									<?php } ?>
									<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
									<div class="product-countdown countdown-style1" data-date="<?php echo esc_attr( $countdown_date ); ?>"  data-starttime="<?php echo esc_attr( $start_time ); ?>"></div>
								</div>															
							</div>
						</div>
					</div>
				</div>
				<?php
					$i++; endwhile; wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
<?php
	} 
}
?>