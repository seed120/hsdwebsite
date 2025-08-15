<?php 
class ceaPluginOptions {
	
	public static $opt_name;
	
	public static $tab_list = '';
	
	public static $tab_content = '';
	
	public static $tab_count = 1;
	
	public static $cea_options = array();

	public static function ceaSetSection( $settings ){
		$tab_list_class = self::$tab_count == 1 ? ' active' : '';
		self::$tab_list .= '<li class="tablinks'. esc_attr( $tab_list_class ) .'" data-id="'. esc_attr( $settings['id'] ) .'">'. esc_html( $settings['title'] ) .'</li>';
		$tab_class = self::$tab_count != 1 ? ' tab-hide' : '';
		self::$tab_content .= '<div id="'. esc_attr( $settings['id'] ) .'" class="tabcontent'. esc_attr( $tab_class ) .'">'. self::ceaSetFiled( $settings['id'], $settings['fields'] ) .'</div>';
		self::$tab_count++;
	}
	
	public static function ceaSetFiled( $id, $fields ){
	
		$cea_options = self::$cea_options;
		
		wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
	
		$field_element = '';
		$field_title = '';
		$field_out = '';
		foreach( $fields as $field ){
		
			$description = isset( $field['desc'] ) ? $field['desc'] : '';
		
			switch( $field['type'] ){
				case "switch":
					$default = isset( $field['default'] ) ? $field['default'] : '1';
					$saved_val = isset( $cea_options[$field['id']] ) ? $cea_options[$field['id']] : $default;
					$checked_stat = $saved_val == 'on' ? 'checked="checked"' : $saved_val == 'on';
					$field_element = '
					<label class="switch">
						<input class="switch-checkbox" type="checkbox" name="'. esc_attr( self::$opt_name ) .'['. esc_attr( $field['id'] ) .']" '. $checked_stat .'>
						<span class="slider round"></span>
					</label>';
					$field_element .= '<p class="cea-field-desc">'. $description .'</p>';
				break;
				
				case "text":
					$default = isset( $field['default'] ) ? $field['default'] : '';
					$saved_val = isset( $cea_options[$field['id']] ) ? $cea_options[$field['id']] : $default;
					$field_element = '<input class="text-box" type="text" name="'. esc_attr( self::$opt_name ) .'['. esc_attr( $field['id'] ) .']" value="'. esc_attr( $saved_val ) .'">';
					$field_element .= '<p class="cea-field-desc">'. $description .'</p>';
				break;
				
				case "color":
					$default = isset( $field['default'] ) ? $field['default'] : '';
					$saved_val = isset( $cea_options[$field['id']] ) ? $cea_options[$field['id']] : $default;
					$field_element = '<input class="wp-color" type="text" name="'. esc_attr( self::$opt_name ) .'['. esc_attr( $field['id'] ) .']" value="'. esc_attr( $saved_val ) .'">';
					$field_element .= '<p class="cea-field-desc">'. $description .'</p>';
				break;
				
				case "select":
					$default = isset( $field['default'] ) ? $field['default'] : '';
					$saved_val = isset( $cea_options[$field['id']] ) ? $cea_options[$field['id']] : $default;
					if( isset( $field['sidebars'] ) && $field['sidebars'] == true ){
						global $wp_registered_sidebars;
						$options = array( '' => esc_html__( 'None', 'classic-elementor-addons-pro' ) );
						foreach( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
							$options[$sidebar_id] = $sidebar['name'];
						}
					}else{
						$options = $field['options'];
					}
					$select_out = '<select class="select-option" name="'. esc_attr( self::$opt_name ) .'['. esc_attr( $field['id'] ) .']">';
					foreach( $options as $key => $value ){
						$select_out .= '<option value="'. esc_attr( $key ) .'" '. ( $saved_val == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $value ) .'</option>';
					}
					$select_out .= '</select>';	
					$field_element = $select_out;
					$field_element .= '<p class="cea-field-desc">'. $description .'</p>';
				break;
				
				case 'dragdrop':
					$meta = isset( $cea_options[$field['id']] ) && !empty( $cea_options[$field['id']] ) ? $cea_options[$field['id']] : "";
					$dd_fields = isset( $field['options'] ) && empty( $meta ) ? $field['options'] : $meta;
		
					if( !is_array( $dd_fields ) ){
						$dd_fields = stripslashes( $dd_fields );
						$dd_json = $meta = $dd_fields;
					}else{
						$dd_json = $meta = json_encode( $dd_fields );
					}
					
					$part_array = json_decode( $dd_json, true );
					$t_part_array = array();
					$f_part_array = array();
		
					foreach( $part_array as $key => $value ){
						$t_part_array[$key] = $value != '' ? self::cea_post_option_drag_drop_multi( $key, $value ) : '';
					}
		
					$field_element = '<div class="meta-drag-drop-multi-field">';
					foreach( $t_part_array as $key => $value ){
							$field_element .= '<h4>'. esc_html( $key ) .'</h4>';
							$field_element .= $value;
					}
					
					$dd_fields = !is_array( $dd_fields ) ? $dd_fields : json_encode( $dd_fields );
					
					$field_element .= '<input class="meta-drag-drop-multi-value" type="hidden" name="'. esc_attr( self::$opt_name ) .'['. esc_attr( $field['id'] ) .']" value="" data-params="'. htmlspecialchars( $dd_fields, ENT_QUOTES, 'UTF-8' ) .'">';
					$field_element .= '</div>';
					$field_element .= '<p class="cea-field-desc">'. $description .'</p>';
		
				break;
			}
			
			$required_attr = '';
			if( isset( $field['required'] ) ){
				$required = $field['required'];
				$required_attr .= isset( $required[0] ) ? ' data-required="'. $required[0] .'"' : '';
				$required_attr .= isset( $required[1] ) ? ' data-required-condition="'. $required[1] .'"' : '';
				$required_attr .= isset( $required[2] ) ? ' data-required-value="'. $required[2] .'"' : '';
			}
			
			$field_out .= '
			<div class="field-set"'. $required_attr .' id="'. esc_attr( $field['id'] ) .'">
				<div class="field-set-left">
					<h5>'. esc_html( $field['title'] ) .'</h5>
				</div><!-- .field-set-left -->
				<div class="field-set-right">
					'. $field_element .'
				</div><!-- .field-set-right -->
			</div><!-- .field-set -->';
			
		}
	
		return $field_out;
	}
	
	public static function cea_post_option_drag_drop_multi( $key, $post_items ) {
		$output = '<ul class="meta-items ui-sortable" data-part="'. esc_attr( $key ) .'">';
		foreach( $post_items as $key => $value ){
			$output .= '<li data-id="'. esc_attr( $key ) .'" data-val="'. esc_attr( $value ) .'">'. esc_attr( $value ) .'</li>';
		}
		$output .= '</ul>';
		return $output;
	}
	
	public static function ceaPutSection(){
		echo self::$tab_list;
	}
	
	public static function ceaPutFields(){
		echo self::$tab_content;
	}
	
}