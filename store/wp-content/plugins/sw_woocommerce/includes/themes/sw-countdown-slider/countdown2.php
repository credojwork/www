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
		),
		'orderby' => $orderby,
		'order' => $order,
		'post_status' => 'publish',
		'showposts' => $numberposts	
	);
	if( $cat != '' ){
		$term = get_term_by( 'slug', $cat, 'product_cat' );
		if( $term ) :
			$term_name = $term->name;
		endif; 
		
		$default['tax_query'] = array(
			array(
				'taxonomy'  => 'product_cat',
				'field'     => 'slug',
				'terms'     => $cat ));
	}
	$default = sw_check_product_visiblity( $default );
	$id = 'sw_countdown_'.$this->generateID();
	$list = new WP_Query( $default );
	if ( $list -> have_posts() ){ 
?>
	<div id="<?php echo esc_attr( $cat.'_'.$id . $key ); ?>" class="sw-woo-container-slider responsive-slider countdown-slider-theme2 loading" data-lg="<?php echo esc_attr( $columns ); ?>" data-md="<?php echo esc_attr( $columns1 ); ?>" data-sm="<?php echo esc_attr( $columns2 ); ?>" data-xs="<?php echo esc_attr( $columns3 ); ?>" data-mobile="<?php echo esc_attr( $columns4 ); ?>" data-speed="<?php echo esc_attr( $speed ); ?>" data-scroll="<?php echo esc_attr( $scroll ); ?>" data-interval="<?php echo esc_attr( $interval ); ?>"  data-autoplay="<?php echo esc_attr( $autoplay ); ?>" data-circle="false">       
		<div class="resp-slider-container">
			<?php if( $title1 != '' ){?>
				<div class="box-title">
					<h2><?php echo ( $title1 != '' ) ? $title1 : $term_name; ?></h2>
				</div>
			<?php } ?>
			<div class="slider responsive">	
			<?php 
				$count_items = 0;
				$count_items = ( $numberposts >= $list->found_posts ) ? $list->found_posts : $numberposts;
				$i = 0;
				while($list->have_posts()): $list->the_post();					
				global $product, $post;
				$class = ( $product->get_price_html() ) ? '' : 'item-nonprice';
				$forginal_price = get_post_meta( $post->ID, '_regular_price', true );	
				$fsale_price = get_post_meta( $post->ID, '_sale_price', true );	
				$symboy = get_woocommerce_currency_symbol( get_woocommerce_currency() );
				if( $i % $item_row == 0 ){
			?>
				<div class="item item-countdown product <?php echo esc_attr( $class )?>" id="<?php echo 'product_'.$id.$post->ID; ?>">
				<?php } ?>
					<?php include( WCTHEME . '/default-item.php' ); ?>
				<?php if( ( $i+1 ) % $item_row == 0 || ( $i+1 ) == $count_items ){?> </div><?php } ?>
			<?php $i ++; endwhile; wp_reset_postdata();?>
			</div>
		</div>            
	</div>
<?php
	} 
}
?>