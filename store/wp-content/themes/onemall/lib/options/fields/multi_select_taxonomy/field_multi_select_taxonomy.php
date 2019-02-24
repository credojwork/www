<?php
class Onemall_Options_multi_select_taxonomy extends Onemall_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since Onemall_Options 1.0
	*/
	function __construct($field = array(), $value ='', $parent){
		
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		$this->field = $field;
		$this->value = $value;
		
		
	}//function
	
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since Onemall_Options 1.0
	*/
	function render(){
		
		$class = (isset($this->field['class']))?'class="'.esc_attr( $this->field['class'] ).'" ':'';
		
		echo '<select id="'.esc_attr( $this->field['id'] ).'" name="'.$this->args['opt_name'].'['.$this->field['id'].'][]" '.$class.'multiple="multiple" >';
			$disabled_taxonomies = array('nav_menu', 'link_category', 'post_format');
			
			foreach( get_taxonomies() as $k => $v){
				if (in_array($v, $disabled_taxonomies)) {
						continue;
				}
				
				$selected = (is_array($this->value) && in_array($k, $this->value))?' selected="selected"':'';
				
				echo '<option value="'.esc_attr( $k ).'"'.$selected.'>'.esc_html( $v ).'</option>';
				
			}//foreach

		echo '</select>';

		echo (isset($this->field['desc']) && !empty($this->field['desc']))?'<br/><span class="description">'.esc_html( $this->field['desc'] ).'</span>':'';
		
	}//function
	
}//class
?>