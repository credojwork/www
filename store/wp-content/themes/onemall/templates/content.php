<?php get_template_part('header'); ?>
<?php 
	$onemall_sidebar_template = onemall_options()->getCpanelValue('sidebar_blog') ;
	$onemall_blog_styles = onemall_options()->getCpanelValue('blog_layout');
?>

<?php onemall_breadcrumb_title(); ?>

<div class="container">
	<div class="row sidebar-row">
		<?php if ( is_active_sidebar('left-blog') && $onemall_sidebar_template == 'left' ):
			$onemall_left_span_class = 'col-lg-'.onemall_options()->getCpanelValue('sidebar_left_expand');
			$onemall_left_span_class .= ' col-md-'.onemall_options()->getCpanelValue('sidebar_left_expand_md');
			$onemall_left_span_class .= ' col-sm-'.onemall_options()->getCpanelValue('sidebar_left_expand_sm');
		?>
		<aside id="left" class="sidebar <?php echo esc_attr($onemall_left_span_class); ?>">
			<?php dynamic_sidebar('left-blog'); ?>
		</aside>

		<?php endif; ?>
		
		<div class="category-contents <?php onemall_content_blog(); ?>">
			<!-- No Result -->
			<?php if (!have_posts()) : ?>
			<?php get_template_part('templates/no-results'); ?>
			<?php endif; ?>			
			
			<?php 
				$onemall_blogclass = 'blog-content blog-content-'. $onemall_blog_styles;
				if( $onemall_blog_styles == 'grid' ){
					$onemall_blogclass .= ' row';
				}
			?>
			<div class="<?php echo esc_attr( $onemall_blogclass ); ?>">
			<?php 			
				while( have_posts() ) : the_post();
					get_template_part( 'templates/content', $onemall_blog_styles );
				endwhile;
			?>
			<?php get_template_part('templates/pagination'); ?>
			</div>
			<div class="clearfix"></div>
		</div>
	
		<?php if ( is_active_sidebar('right-blog') && $onemall_sidebar_template =='right' ):
			$onemall_right_span_class = 'col-lg-'.onemall_options()->getCpanelValue('sidebar_right_expand');
			$onemall_right_span_class .= ' col-md-'.onemall_options()->getCpanelValue('sidebar_right_expand_md');
			$onemall_right_span_class .= ' col-sm-'.onemall_options()->getCpanelValue('sidebar_right_expand_sm');
		?>
		<aside id="right" class="sidebar <?php echo esc_attr($onemall_right_span_class); ?>">
			<?php dynamic_sidebar('right-blog'); ?>
		</aside>
		<?php endif; ?>
	</div>
</div>
<?php get_template_part('footer'); ?>
