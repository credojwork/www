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
	?>
	<div id="<?php echo esc_attr( $widget_id ) ?>" class="testimonial-post-layout1 responsive-slider clearfix loading<?php echo esc_attr( $el_class ) ?>">
		<?php if($title !=''){ ?>
		<div class="block-title">
			<h3><?php echo $title ?></h3>
		</div>
		<?php } ?>
		<div class="resp-slider-container">
			<div id="thumb_<?php echo esc_attr( $widget_id ); ?>" class="slider responsive-thumbnail">
				<?php 
				while($list->have_posts()): $list->the_post();				
				global $post;
				$au_name = get_post_meta( $post->ID, 'au_name', true );
				$au_url  = get_post_meta( $post->ID, 'au_url', true );
				$au_info  = get_post_meta( $post->ID, 'au_info', true );
				$active = ($i== 0)? 'active' :'';
				?>
				<div class="item">
					<div class="item-inner">
						<?php if( has_post_thumbnail() ){ ?>
						<div class="image-client">
							<?php the_post_thumbnail( array(100,100)) ?>
						</div>		
						<?php } ?>
					</div>
				</div> 
				<?php $i++; endwhile; wp_reset_postdata(); ?>
			</div>
			<div id="content_<?php echo esc_attr( $widget_id ); ?>" class="slider responsive-content">
				<?php 
				while($list->have_posts()): $list->the_post();				
				global $post;
				$au_name = get_post_meta( $post->ID, 'au_name', true );
				$au_url  = get_post_meta( $post->ID, 'au_url', true );
				$au_info  = get_post_meta( $post->ID, 'au_info', true );
				$active = ($i== 0)? 'active' :'';
				?>
				<div class="item">
					<div class="item-inner">
						<div class="client-say-info">
							<div class="client-comment">
								<?php 
								$text = get_the_content($post->ID);	
								$content = wp_trim_words($text, $length);
								echo esc_html($content);
								?>
							</div>
							<div class="name-client">
								<h2><a href="<?php echo esc_url( $au_url ) ?>" title="<?php echo esc_attr( $post->post_title ) ?>"><?php echo esc_html($au_name) ?></a></h2>
								<h4><a href="<?php echo esc_url( $au_url ) ?>" title="<?php echo esc_attr( $post->post_title ) ?>"><?php echo esc_html($au_info) ?></a></h4>
							</div>
						</div>
					</div>
				</div> 
				<?php $i++; endwhile; wp_reset_postdata(); ?>
			</div>
		</div>
	</div>
	<?php	
}
?>