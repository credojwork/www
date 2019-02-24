<?php
	if( onemall_mobile_check() ) : ?>
	<div class="no-result">
		<div class="no-result-image">
			<span class="image">
				<img class="img_logo" alt="404" src="<?php echo get_template_directory_uri(); ?>/assets/img/no-result.png">
			</span>
		</div>
		<h3><?php esc_html_e('no products found','onemall');?></h3>
		<p><?php esc_html_e('Sorry, but nothing matched your search terms.','onemall');?><br/><?php  esc_html_e('Please try again with some different keywords.', 'onemall'); ?></p>
		<a href="<?php echo get_permalink( get_option('woocommerce_shop_page_id') ); ?>" title="Shop"><?php esc_html_e('back to categories','onemall');?></a>
	</div>
<?php else : ?>
	<div class="no-result">		
			<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'onemall'); ?></p>
		<?php get_search_form(); ?>
	</div>
<?php endif; ?>