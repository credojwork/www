<?php get_template_part('header'); ?>
<div class="wrapper_404">
	<div class="container">
		<div class="row">
			<?php $onemall_404page = onemall_options()->getCpanelValue( 'page_404' ); ?>
			<?php if( $onemall_404page != '' ) : ?>
					<?php echo sw_get_the_content_by_id( $onemall_404page ); ?>
			<?php else: ?>	
			<div class="content_404">
				<div class="item-right col-sm-12">
					<div class="block-top">
						<div class="error-top"><?php esc_html_e('Oops','onemall')?><span><?php esc_html_e(' 404 ','onemall'); ?></span><?php esc_html_e('page !','onemall'); ?></div>
						<div class="warning-code"><?php esc_html_e( "It's looking like you may have taken a wrong turn.Don't worry...it happens to the best of us.", 'onemall' ) ?><br></div>
						<div class="des1"><?php esc_html_e( 'If you want go back to my store. Please in put the ', 'onemall' ) ?><span class="flag"><?php esc_html_e( 'box below', 'onemall' ) ?></span></div>
					</div>
					<div class="block-middle clearfix">
						<div class="onemall_search_404">
							<?php get_template_part( 'widgets/sw_top/searchcate' ); ?>
						</div>
					</div>
					<div class="block-bottom">
						<a href="<?php echo esc_url( home_url('/') ); ?>" class="btn-404 back2home" title="<?php esc_attr_e( 'Go Home', 'onemall' ) ?>"><?php esc_html_e( "Back to home", 'onemall' )?><i class="fa fa-angle-right"></i></a>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_template_part('footer'); ?>