<?php 
$widget_id = isset( $widget_id ) ? $widget_id : 'sw_testimonial'.rand().time();
$default = array(
	'post_type' => 'testimonial',
	'orderby' => $orderby,
	'order' => $order,
	'post_status' => 'publish',
	'showposts' => $numberposts
	);
$list = new WP_Query( $default );
if ( count($list) > 0 ){
	$i = 0;
	$j = 0;
	$k = 0;
	?>
	<div id="<?php echo esc_attr( $widget_id ) ?>" class="client-wrapper-style carousel slide <?php echo esc_attr( $el_class ) ?>" data-interval="0">
		<div class="block-title-bottom">
			<?php if( $title != '' ){ ?>
				<h2><?php echo $title ?></h2>
			<?php } else { ?>
				<h2><?php echo "Testimonial" ?></h2>
			<?php } ?>			
			<div class="carousel-cl nav-custom">
				<a class="res-button prev-test fa fa-angle-left" href="#<?php echo esc_attr( $widget_id ) ?>" role="button" data-slide="prev"><span></span></a>
				<a class="res-button next-test fa fa-angle-right" href="#<?php echo esc_attr( $widget_id ) ?>" role="button" data-slide="next"><span></span></a>
			</div>					
		</div>
		<div class="carousel-inner">
			<?php 
			while($list->have_posts()): $list->the_post();				
			global $post;
			$au_name = get_post_meta( $post->ID, 'au_name', true );
			$au_url  = get_post_meta( $post->ID, 'au_url', true );
			$au_info = get_post_meta( $post->ID, 'au_info', true );
			$active = ($i== 0)? 'active' :'';
			?>
			<div class="item <?php echo esc_attr( $active ) ?>">
				<div class="item-inner">
					<div class="client-say-info">
						<div class="client-comment">
						<?php
							$text = get_the_content($post->ID);	
							$content = wp_trim_words($text, $length);
							echo esc_html($content);
						?>
						</div>
						<div class="title">
							<a href="<?php echo esc_url( $au_url ) ?>" title="<?php echo esc_attr( $post->post_title ) ?>">- <?php echo esc_html($au_name) ?> -</a>	
							<h3><a href="<?php echo esc_url( $au_url ) ?>" title="<?php echo esc_attr( $post->post_title ) ?>"><?php echo esc_html($au_info) ?></a></h3>
						</div>
					</div>
				</div>
			</div> 
			<?php $i++; endwhile; wp_reset_postdata(); ?>
		</div>
	</div>
	<?php	
}
?>