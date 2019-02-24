jQuery(document).ready(function(){
	
	
	if(jQuery('#last_tab').val() == ''){

		jQuery('.onemall-opts-group-tab:first').slideDown('fast');
		jQuery('#onemall-opts-group-menu li:first').addClass('active');
	
	}else{
		
		tabid = jQuery('#last_tab').val();
		jQuery('#'+tabid+'_section_group').slideDown('fast');
		jQuery('#'+tabid+'_section_group_li').addClass('active');
		
	}
	
	
	jQuery('input[name="'+onemall_opts.opt_name+'[defaults]"]').click(function(){
		if(!confirm(onemall_opts.reset_confirm)){
			return false;
		}
	});
	
	jQuery('.onemall-opts-group-tab-link-a').click(function(){
		relid = jQuery(this).attr('data-rel');
		
		jQuery('#last_tab').val(relid);
		
		jQuery('.onemall-opts-group-tab').each(function(){
			if(jQuery(this).attr('id') == relid+'_section_group'){
				jQuery(this).show();
			}else{
				jQuery(this).hide();
			}
			
		});
		
		jQuery('.onemall-opts-group-tab-link-li').each(function(){
				if(jQuery(this).attr('id') != relid+'_section_group_li' && jQuery(this).hasClass('active')){
					jQuery(this).removeClass('active');
				}
				if(jQuery(this).attr('id') == relid+'_section_group_li'){
					jQuery(this).addClass('active');
				}
		});
	});
	
	
	
	
	if(jQuery('#onemall-opts-save').is(':visible')){
		jQuery('#onemall-opts-save').delay(4000).slideUp('slow');
	}
	
	if(jQuery('#onemall-opts-imported').is(':visible')){
		jQuery('#onemall-opts-imported').delay(4000).slideUp('slow');
	}	
	
	jQuery('input, textarea, select').change(function(){
		jQuery('#onemall-opts-save-warn').slideDown('slow');
	});
	
	
	jQuery('#onemall-opts-import-code-button').click(function(){
		if(jQuery('#onemall-opts-import-link-wrapper').is(':visible')){
			jQuery('#onemall-opts-import-link-wrapper').fadeOut('fast');
			jQuery('#import-link-value').val('');
		}
		jQuery('#onemall-opts-import-code-wrapper').fadeIn('slow');
	});
	
	jQuery('#onemall-opts-import-link-button').click(function(){
		if(jQuery('#onemall-opts-import-code-wrapper').is(':visible')){
			jQuery('#onemall-opts-import-code-wrapper').fadeOut('fast');
			jQuery('#import-code-value').val('');
		}
		jQuery('#onemall-opts-import-link-wrapper').fadeIn('slow');
	});
	
	
	
	
	jQuery('#onemall-opts-export-code-copy').click(function(){
		if(jQuery('#onemall-opts-export-link-value').is(':visible')){jQuery('#onemall-opts-export-link-value').fadeOut('slow');}
		jQuery('#onemall-opts-export-code').toggle('fade');
	});
	
	jQuery('#onemall-opts-export-link').click(function(){
		if(jQuery('#onemall-opts-export-code').is(':visible')){jQuery('#onemall-opts-export-code').fadeOut('slow');}
		jQuery('#onemall-opts-export-link-value').toggle('fade');
	});
	
	

	
	
	
});