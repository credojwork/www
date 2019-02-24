<?php if ( is_active_sidebar('right') ):
	$onemall_right_span_class = 'col-lg-'.onemall_options()->getCpanelValue('sidebar_right_expand');
	$onemall_right_span_class .= ' col-md-'.onemall_options()->getCpanelValue('sidebar_right_expand_md');
	$onemall_right_span_class .= ' col-sm-'.onemall_options()->getCpanelValue('sidebar_right_expand_sm');
?>
<aside id="right" class="sidebar <?php echo esc_attr($onemall_right_span_class); ?>">
	<?php dynamic_sidebar('right'); ?>
</aside>
<?php endif; ?>