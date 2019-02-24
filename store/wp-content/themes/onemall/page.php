<?php get_header(); ?>
<?php 
	$onemall_sidebar_template	= get_post_meta( get_the_ID(), 'page_sidebar_layout', true );
	$onemall_sidebar 					= get_post_meta( get_the_ID(), 'page_sidebar_template', true );
?>

<?php onemall_breadcrumb_title(); ?>

	<div class="container">
		<div class="row sidebar-row">
		<?php 
			if ( is_active_sidebar( $onemall_sidebar ) && $onemall_sidebar_template != 'right' && $onemall_sidebar_template !='full' ):
			$onemall_left_span_class = 'col-lg-'.onemall_options()->getCpanelValue('sidebar_left_expand');
			$onemall_left_span_class .= ' col-md-'.onemall_options()->getCpanelValue('sidebar_left_expand_md');
			$onemall_left_span_class .= ' col-sm-'.onemall_options()->getCpanelValue('sidebar_left_expand_sm');
		?>
			<aside id="left" class="sidebar <?php echo esc_attr( $onemall_left_span_class ); ?>">
				<?php dynamic_sidebar( $onemall_sidebar ); ?>
			</aside>
		<?php endif; ?>
		
			<div id="contents" role="main" class="main-page <?php onemall_content_page(); ?>">
				<?php
				get_template_part('templates/content', 'page')
				?>
			</div>
			<?php 
			if ( is_active_sidebar( $onemall_sidebar ) && $onemall_sidebar_template != 'left' && $onemall_sidebar_template !='full' ):
				$onemall_left_span_class = 'col-lg-'.onemall_options()->getCpanelValue('sidebar_left_expand');
				$onemall_left_span_class .= ' col-md-'.onemall_options()->getCpanelValue('sidebar_left_expand_md');
				$onemall_left_span_class .= ' col-sm-'.onemall_options()->getCpanelValue('sidebar_left_expand_sm');
			?>
				<aside id="right" class="sidebar <?php echo esc_attr($onemall_left_span_class); ?>">
					<?php dynamic_sidebar( $onemall_sidebar ); ?>
				</aside>
			<?php endif; ?>
		</div>		
	</div>
<?php get_footer(); ?>

