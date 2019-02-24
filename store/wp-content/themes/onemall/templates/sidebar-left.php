<?php if ( is_active_sidebar('left') ):
	$onemall_left_span_class = 'col-lg-'.onemall_options()->getCpanelValue('sidebar_left_expand');
	$onemall_left_span_class .= ' col-md-'.onemall_options()->getCpanelValue('sidebar_left_expand_md');
	$onemall_left_span_class .= ' col-sm-'.onemall_options()->getCpanelValue('sidebar_left_expand_sm');
?>
<aside id="left" class="sidebar <?php echo esc_attr($onemall_left_span_class); ?>">
	<?php dynamic_sidebar('left'); ?>
</aside>
<?php endif; ?>