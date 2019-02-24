<?php get_template_part('header'); ?>

<?php onemall_breadcrumb_title(); ?>

<div class="container">
	<div class="row sidebar-row">				
		<?php if ( is_active_sidebar('left-blog') && onemall_sidebar_template() == 'left' ):
			$onemall_left_span_class = 'col-lg-'.onemall_options()->getCpanelValue('sidebar_left_expand');
			$onemall_left_span_class .= ' col-md-'.onemall_options()->getCpanelValue('sidebar_left_expand_md');
			$onemall_left_span_class .= ' col-sm-'.onemall_options()->getCpanelValue('sidebar_left_expand_sm');
		?>
		<aside id="left" class="sidebar <?php echo esc_attr($onemall_left_span_class); ?>">
			<?php dynamic_sidebar('left-blog'); ?>
		</aside>
		<?php endif; ?>
		
		<div class="single main <?php onemall_content_blog(); ?>" >
			<?php while (have_posts()) : the_post(); ?>
			<?php $related_post_column = onemall_options()->getCpanelValue('sidebar_blog'); ?>
			<div <?php post_class(); ?>>
				<?php $pfm = get_post_format();?>
				<div class="entry-wrap">
					<div class="entry-content clearfix">
						<?php if( $pfm == '' || $pfm == 'image' ){?>
						<?php if( has_post_thumbnail() ){ ?>
						<div class="entry-thumb single-thumb">
							<?php the_post_thumbnail('onemall_detail_thumb'); ?>
						</div>
						<?php } }?>
						<div class="entry-meta clearfix">
							<div class="entry-date pull-left">
								<a href="<?php echo get_permalink($post->ID)?>"><i class="fa fa-calendar"></i><?php echo get_the_date( '', $post->ID );?></a>
							</div>
							<span class="tag"><?php echo get_the_tag_list('<i class="fa fa-tags"></i>',', ','');; ?></span>
						</div>
						<div class="entry-summary single-content ">
							<?php the_content(); ?>
							<div class="clear"></div>
							<!-- link page -->
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'onemall' ).'</span>', 'after' => '</div>' , 'link_before' => '<span>', 'link_after'  => '</span>' ) ); ?>	
						</div>
						<div class="clear"></div>			
					</div>
				</div>
				
				<div class="clearfix"></div> 
				<?php if( get_the_author_meta( 'description',  $post->post_author ) != '' ): ?>
				<div id="authorDetails" class="clearfix">
					<h4 class="title"><?php esc_html_e( 'About the author', 'onemall' ) ?> </h4>
					<div class="authorDetail">
						<?php get_the_author_meta() ?>
						<div class="avatar">
							<?php echo get_avatar( $post->post_author , 80 ); ?>
						</div>
						<div class="infomation">
							<h4 class="name-author"><span><?php echo get_the_author()?></span></h4>
							<p><?php echo the_author_meta('description') ;?></p>
						</div>
					</div>
				</div> 
				<?php endif; ?>
				<div class="clearfix"></div>
				<!-- Relate Post -->
				<?php 
					global $post;
					global $related_term;
					$class_col= "";
					$categories = get_the_category($post->ID);								
					$category_ids = array();
					foreach($categories as $individual_category) {$category_ids[] = $individual_category->term_id;}
					if ($categories) {
						if($related_post_column =='full'){
							$class_col .= 'col-lg-4 col-md-4 col-sm-4';
							$related = array(
								'category__in' => $category_ids,
								'post__not_in' => array($post->ID),
								'showposts'=>3,
								'orderby'	=> 'name',	
								'ignore_sticky_posts'=>1
								 );
						} else {
							$class_col .= 'col-lg-6 col-md-6 col-sm-6 col-xs-6';
							$related = array(
								'category__in' => $category_ids,
								'post__not_in' => array($post->ID),
								'showposts'=>2,
								'orderby'	=> 'name',	
								'ignore_sticky_posts'=>1
								 );
						} 
				?>
						<div class="single-post-relate">
							<h4><?php esc_html_e('Related Posts', 'onemall'); ?></h4>
							<div class="row">
								<?php
								$related_term = new WP_Query($related);
								while($related_term -> have_posts()):$related_term -> the_post();
								$format = get_post_format();
								?>
								<div <?php post_class( $class_col ); ?> >
									<?php if ( get_the_post_thumbnail() ) { ?>
									<div class="item-relate-img">
										<div class="entry-meta">
											<span class="latest_post_date">
												<span class="post_day"><?php the_time('d'); ?></span>
												<span class="post_my"><?php the_time('M'); ?></span>
											</span>
										</div>
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('market_related_post'); ?></a>
									</div>
									<?php } ?>

									<div class="item-relate-content">
										<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<p>
											<?php
											$text = strip_shortcodes( $post->post_content );
											$text = apply_filters('the_content', $text);
											$text = str_replace(']]>', ']]&gt;', $text);
											$content = wp_trim_words($text, 10,'...');
											echo esc_html( $content );
											?>
										</p>
									</div>
								</div>
								<?php
								endwhile;
								wp_reset_postdata();
								?>
							</div>
						</div>
						<?php } ?>
					
					<div class="clearfix"></div>
					<!-- Comment Form -->
					<?php comments_template('/templates/comments.php'); ?>
			</div>
			<?php endwhile; ?>
		</div>

		<?php if ( is_active_sidebar('right-blog') && onemall_sidebar_template() == 'right' ):
			$onemall_right_span_class = 'col-lg-'.onemall_options()->getCpanelValue('sidebar_right_expand');
			$onemall_right_span_class .= ' col-md-'.onemall_options()->getCpanelValue('sidebar_right_expand_md');
			$onemall_right_span_class .= ' col-sm-'.onemall_options()->getCpanelValue('sidebar_right_expand_sm');
		?>
		<aside id="right" class="sidebar <?php echo esc_attr( $onemall_right_span_class ); ?>">
			<?php dynamic_sidebar('right-blog'); ?>
		</aside>
		<?php endif; ?>
	</div>	
</div>
<?php get_template_part('footer'); ?>
