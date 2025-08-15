<?php 
class Hirxpert_Options {
	
	private static $_instance = null;
	
	public static $opt_name;
	
	public static $tab_list = '';
	
	public static $tab_content = '';
	
	public static $parent_tab_count = 1;
	
	public static $tab_count = 1;
	
	public static $hirxpert_options = array();
	
	public function __construct() {}
		
	public static function hirxpert_theme_option_strings( $key ){
		$string_array = array(
			'enabled' => esc_html__( 'Enabled', 'hirxpert-addon' ),
			'disabled' => esc_html__( 'Disabled', 'hirxpert-addon' ),
			'left' => esc_html__( 'Left', 'hirxpert-addon' ),
			'center' => esc_html__( 'Center', 'hirxpert-addon' ),
			'right' => esc_html__( 'Right', 'hirxpert-addon' ),
			'normal' => esc_html__( 'Normal', 'hirxpert-addon' ),
			'sticky' => esc_html__( 'Sticky', 'hirxpert-addon' ),
		);
		return isset( $string_array[$key] ) ? $string_array[$key] : '';
	}
	
	public static function hirxpert_set_section( $settings ){
		$tab_item_class = ''; //self::$parent_tab_count <= 1 ? ' active' : '';
		self::$tab_list .= '<li class="tablinks'. esc_attr( $tab_item_class ) .'" data-id="'. esc_attr( $settings['id'] ) .'"><span class="tab-title">'. esc_html( $settings['title'] ) .'</span>';
		self::$tab_list .= '<ul class="tablinks-sub-list">';
		self::$parent_tab_count++;
	}
	
	public static function hirxpert_set_sub_section( $settings ) {
		$tab_docs_link = '';
		$settings['config_id'] = isset( $settings['config_id'] ) ? $settings['config_id'] : '';
		if($settings['config_id'] != ''){
			$tab_docs_link = '<a href="https://docs.zozothemes.com/hirxpert/#' . $settings['config_id'] . '" target="_blank" class="docs-tooltip" title="Documentation"><span class="dashicons dashicons-editor-help theme-info"></span></a>';
		}
		$tab_item_class = ''; //self::$tab_count <= 1 ? ' active' : '';
		self::$tab_list .= '<li class="tablinks'. esc_attr( $tab_item_class ) .'" data-id="'. esc_attr( $settings['id'] ) .'"><span class="tab-title">'. esc_html( $settings['title'] ) .'</span></li>';
		$tab_class = ' tab-hide'; //self::$tab_count != 1 ? ' tab-hide' : '';
		self::$tab_content .= '<div id="'. esc_attr( $settings['id'] ) .'" class="tabcontent'. esc_attr( $tab_class ) .'">'. $tab_docs_link .''. self::hirxpert_set_field( $settings['id'], $settings['fields'] ) .'</div>';
		self::$tab_count++;
	}
	
	public static function hirxpert_set_end_section( $settings ){
		self::$tab_list .= '</ul></li>';
	}
	
	public static function hirxpert_set_field( $id, $fields ){
	
		$hirxpert_options = self::$hirxpert_options;
	
		$field_element = '';
		$field_title = '';
		$field_out = '';
		foreach( $fields as $config ){
		
			$description = isset( $config['desc'] ) ? $config['desc'] : '';
			ob_start();
			switch( $config['type'] ){
				case "text":
					self::build_text_field( $config );
				break;
				case "number":
					self::build_number_field( $config );
				break;
				case "textarea":
					self::build_textarea_field( $config );
				break;
				case "select":
					self::build_select_field( $config );
				break;
				case "color":
					self::build_color_field( $config );
				break;	
				case "image":
					self::build_image_field( $config );
				break;
				case "background":
					self::build_background_field( $config );
				break;
				case "border":
					self::build_border_field( $config );
				break;
				case "dimension":
					self::build_dimension_field( $config );
				break;
				case "link":
					self::build_link_color_field( $config );
				break;
				case "btn_color":
					self::build_button_color_field( $config );
				break;
				case "multicheck":
					self::build_multi_check_field( $config );
				break;
				case "radioimage":
					self::build_radio_image_field( $config );
				break;
				case "sidebars":
					self::build_sidebars_field( $config );
				break;
				case "icons";
					self::build_icon_picker_field( $config );
				break;
				case "pages":
					self::build_pages_field( $config );
				break;
				case "toggle":
					self::build_toggle_switch_field( $config );
				break;
				case "hw":
					self::build_height_weight_field( $config );
				break;
				case "fonts":
					self::build_google_fonts_field( $config );
				break;
				case "dragdrop":
					self::build_drag_drop_field( $config );
				break;
				case 'dragdrop-editor':
					self::build_dragdrop_editor_field( $config );
				break;
				case "export":
					self::build_export_field( $config );
				break;
				case "import":
					self::build_import_field( $config );
				break;
				case "label":
					self::build_label_field( $config );
				break;
			}
			$field_out .= ob_get_clean();	
		}
		return $field_out;
	}

	public static function build_icon_picker_field( $config ) {
		$field_id = esc_attr( $config['id'] );
		$title = isset($config['title']) ? esc_html($config['title']) : '';
		$saved_icon = get_option('hirxpert_options')[$field_id] ?? '';
		?>
		<div class="hirxpert-icon-picker" id="<?php echo $field_id; ?>">
			<h2><?php echo $title; ?></h2>
			<div class="icon-preview">
				<?php if ( !empty($saved_icon) ): ?>
					<i class="<?php echo esc_attr($saved_icon); ?>"></i>
				<?php else : ?>
					<span class="no-icon"><?php esc_html_e('No icon selected', 'hirxpert-addon'); ?></span>
				<?php endif; ?>
			</div>
			<button type="button" class="button open-icon-picker"><?php esc_html_e('Choose Icon', 'hirxpert-addon'); ?></button>
			<button type="button" class="button save-icon" style="display: none;"><?php esc_html_e('Save Icon', 'hirxpert-addon'); ?></button>
			<button type="button" class="button remove-icon" style="display: none;"><?php esc_html_e('Remove Icon', 'hirxpert-addon'); ?></button>
			<input type="hidden" class="icon-input" name="<?php echo $field_id; ?>" value="<?php echo esc_attr($saved_icon); ?>">
		</div>
		<?php
	}	

	public static function build_label_field( $config ){
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
	
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] ) ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		$custom_class = isset( $config['custom_class'] ) ? $config['custom_class'] : '';
		$seperator = isset( $config['seperator'] ) ? $config['seperator'] : ''; 
		if( $custom_class ){
			?>
				<div class="hirxpert-control label-control <?php echo esc_attr( $custom_class ); ?> <?php echo esc_attr($required_class);?>" <?php echo !empty($required_out) ? $required_out : ''; ?> data-id="<?php echo esc_attr($field_id); ?>">	
			<?php
		} else {?>
		<div class="hirxpert-control label-control<?php echo esc_attr($required_class); ?>" <?php echo !empty($required_out) ? $required_out : ''; ?> data-id="<?php echo esc_attr($field_id); ?>">
		<?php } ?>
			<?php if (!empty($seperator) && ($seperator == 'before' || $seperator == 'both')): ?>
			
				<span class="field-seperator seperator-before"></span>
			<?php endif; ?>
			<?php if (isset($config['title']) && !empty($config['title'])): ?>
				<label class="customize-control-title"><?php echo wp_kses_post($config['title']); ?></label>
				<?php if (isset($config['show_edit_icon']) && $config['show_edit_icon'] === true): ?>
					<span class="edit-icon" data-toggle-id="<?php echo esc_attr($field_id); ?>-modal" style="cursor: pointer;" title="Edit Style">&#9998;</span>
				<?php endif; ?>
			<?php endif; ?>
			<?php if (!empty($seperator) && ($seperator == 'after' || $seperator == 'both')): ?>
				<span class="field-seperator seperator-after"></span>
				<?php endif; ?>
		</div>
			<?php if (isset($config['description']) && !empty($config['description'])): ?>
				<span class="description customize-control-description"><?php echo wp_kses_post($config['description']); ?></span>
			<?php endif; ?>
		<div class="dragdrop-editor-modal" id="<?php echo esc_attr($field_id); ?>-modal" style="display: none;">
			<button type="button" class="close-modal-button">&times;</button>
			<div class="label-popup-title"><?php echo esc_html($config['title']); ?></div>
			<div class="editor-fields">
				<?php
					if (isset($config['fields']) && is_array($config['fields'])) {
						foreach ($config['fields'] as $field) {
							echo self::hirxpert_set_field($field_id , array($field));
						}
					}
				?>
			</div>
			<button type="button" class="button save-modal-item"><?php esc_html_e('Save Settings', 'hirxpert-addon'); ?></button>
		</div>
		<?php
	}

	public static function build_text_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = stripslashes( $hirxpert_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
		?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
			<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
			<input type="text" class="hirxpert-customizer-text-field" data-key="<?php echo esc_attr( $field_id ); ?>" id="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]" value="<?php echo esc_attr( $saved_val ); ?>">
		</div>
	<?php
	}

	public static function build_number_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = stripslashes( $hirxpert_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="number-wrapper">
				<div class="title-description">
					<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
					<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
				<input type="number" class="hirxpert-customizer-text-field" data-key="<?php echo esc_attr( $field_id ); ?>" id="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]" value="<?php echo esc_attr( $saved_val ); ?>">
			</div>
		</div>
	<?php
	}
	
	public static function build_textarea_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = stripslashes( $hirxpert_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
			<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
			<textarea class="hirxpert-customizer-textarea-field" data-key="<?php echo esc_attr( $field_id ); ?>" id="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]"><?php echo esc_textarea( $saved_val ); ?></textarea>
		</div>
	<?php
	}
	
	public static function build_select_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		$choices = isset( $config['choices'] ) ? $config['choices'] : '';
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}


		if( $field_id == 'social-icons-fore' || $field_id == 'social-icons-hfore' || $field_id == 'social-icons-bg' || $field_id == 'social-icons-hbg' ) {
	?>
		<div class="hirxpert-control pop-up-class<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-field-type="select" data-id="<?php echo esc_attr( $field_id ); ?>" data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="select-wrapper">
				<div class="title-description">
					<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
					<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
				<select class="hirxpert-customizer-select-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]">
				<?php 
					if( !empty( $choices ) ){
						foreach( $choices as $key => $value ){
							echo '<option value="'. esc_attr( $key ) .'" '. selected( $saved_val, $key ) .'>'. esc_html( $value ) .'</option>';
						}
					}
				?>
				</select>
			</div>
		</div>

	<?php
		}
		else {
	?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-field-type="select" data-id="<?php echo esc_attr( $field_id ); ?>" data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="select-wrapper">
				<div class="title-description">
					<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
					<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
				<select class="hirxpert-customizer-select-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]">
				<?php 
					if( !empty( $choices ) ){
						foreach( $choices as $key => $value ){
							echo '<option value="'. esc_attr( $key ) .'" '. selected( $saved_val, $key ) .'>'. esc_html( $value ) .'</option>';
						}
					}
				?>
				</select>
			</div>
		</div>
	<?php
		}
	}
	
	public static function build_color_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		$default_color =  isset( $config['default'] ) ? $config['default'] : '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = stripslashes( $hirxpert_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		$alpha = isset( $config['alpha'] ) ? $config['alpha'] : false;
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="color-wrap">
				<div class="title-description">
					<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
					<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
				<div class="color-control-wrap">
					<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $saved_val ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]" data-alpha-enabled="<?php echo esc_attr( $alpha ); ?>" />
				</div><!-- .alpha-wrap -->
			</div>
		</div>
	<?php
	}
	
	public static function build_image_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$hirxpert_media = $hirxpert_media_id = $hirxpert_media_url = '';
		$hirxpert_media = isset( $saved_val['image'] ) ? $saved_val['image'] : '';				
		if( !empty( $hirxpert_media ) && is_array( $hirxpert_media ) ){
			$hirxpert_media_id = isset( $hirxpert_media['id'] ) ? $hirxpert_media['id'] : '';
			if ( wp_attachment_is_image( $hirxpert_media_id ) ) {
				$hirxpert_media_url = isset( $hirxpert_media['url'] ) ? wp_get_attachment_url( $hirxpert_media_id ) : '';
			}
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
			<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
			
			<div class="hirxpert-customizer-image-btn-wrap">
				<div class="hirxpert-image-upload-field">
					<input type="hidden" class="hirxpert-img-id" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][image][id]" value="<?php echo esc_attr( $hirxpert_media_id ); ?>" />
					<input type="hidden" class="hirxpert-img-url" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][image][url]" value="<?php echo esc_attr( $hirxpert_media_url ); ?>" />						
					<div class="img-btn-controls">
						<input type="button" class="wp-background-field bg-upload-image-button" value="<?php esc_html_e( 'Upload Image', 'hirxpert-addon' ); ?>" />
						<input type="button" class="bg-remove-image-button" value="<?php esc_html_e( 'Remove Image', 'hirxpert-addon' ); ?>" />
					</div>
					<div class="img-place">
						<?php
							if( !empty( $hirxpert_media_url ) ) :
								$media_alt = $hirxpert_media_id ? get_post_meta( $hirxpert_media_id, '_wp_attachment_image_alt', true ) : '';
						?>
							<img src="<?php echo esc_url( $hirxpert_media_url ); ?>" alt="<?php echo esc_attr( $media_alt ); ?>" class="hirxpert-bg-img">
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_background_field( $config ){
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$bg_ele = $saved_val; 
		$bg_decond = $bg_repeat = $bg_size = $bg_attachment = $bg_position = $bg_media = $bg_color = $bg_transparent = '';
		$bg_media_id = $bg_media_url = '';
		if( $bg_ele ){
			$bg_decond = $bg_ele;
			if( is_array( $bg_decond ) && !empty( $bg_decond ) ){
				$bg_repeat = isset( $bg_decond['bg_repeat'] ) ? $bg_decond['bg_repeat'] : '';
				$bg_size = isset( $bg_decond['bg_size'] ) ? $bg_decond['bg_size'] : '';
				$bg_attachment = isset( $bg_decond['bg_attachment'] ) ? $bg_decond['bg_attachment'] : '';
				$bg_position = isset( $bg_decond['bg_position'] ) ? $bg_decond['bg_position'] : '';
				$bg_media = isset( $bg_decond['image'] ) ? $bg_decond['image'] : '';
				
				if( !empty( $bg_media ) && is_array( $bg_media ) ){
					$bg_media_id = isset( $bg_media['id'] ) ? $bg_media['id'] : '';
					if ( wp_attachment_is_image( $bg_media_id ) ) {
						$bg_media_url = isset( $bg_media['url'] ) ? $bg_media['url'] : '';
					}
				}
				
				$bg_color = isset( $bg_decond['bg_color'] ) ? $bg_decond['bg_color'] : '';
				$bg_transparent = isset( $bg_decond['bg_transparent'] ) ? $bg_decond['bg_transparent'] : '';
			}
		}
		
		$bg_repeat_arr = array(
			'no-repeat' => esc_html__( 'No Repeat', 'hirxpert-addon' ),
			'repeat' => esc_html__( 'Repeat All', 'hirxpert-addon' ),
			'repeat-x' => esc_html__( 'Repeat Horizontally', 'hirxpert-addon' ),
			'repeat-y' => esc_html__( 'Repeat Vertically', 'hirxpert-addon' ),
			'inherit' => esc_html__( 'Inherit', 'hirxpert-addon' )
		);
		
		$bg_size_arr = array(
			'inherit' => esc_html__( 'Inherit', 'hirxpert-addon' ),
			'cover' => esc_html__( 'Cover', 'hirxpert-addon' ),
			'contain' => esc_html__( 'Contain', 'hirxpert-addon' )
		);
		
		$bg_attachment_arr = array(
			'fixed' => esc_html__( 'Fixed', 'hirxpert-addon' ),
			'scroll' => esc_html__( 'Scroll', 'hirxpert-addon' ),
			'inherit' => esc_html__( 'Inherit', 'hirxpert-addon' )
		);
		
		$bg_position_arr = array(
			'left top' => esc_html__( 'Left Top', 'hirxpert-addon' ),
			'left center' => esc_html__( 'Left center', 'hirxpert-addon' ),
			'left bottom' => esc_html__( 'Left Bottom', 'hirxpert-addon' ),
			'center top' => esc_html__( 'Center Top', 'hirxpert-addon' ),
			'center center' => esc_html__( 'Center Center', 'hirxpert-addon' ),
			'center bottom' => esc_html__( 'Center Bottom', 'hirxpert-addon' ),
			'right top' => esc_html__( 'Right Top', 'hirxpert-addon' ),
			'right center' => esc_html__( 'Right center', 'hirxpert-addon' ),
			'right bottom' => esc_html__( 'Right Bottom', 'hirxpert-addon' )
		);
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
		?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
				<div class="wp-backgrounds-wrap">
					<div class="title-description">
					<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
					<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
						
				<div class="wp-backgrounds-inner" data-img="<?php echo esc_url( $bg_media_url ); ?>" data-transparent="<?php if( $bg_transparent ) echo esc_attr( 'transparent' ); ?>" data-repeat="<?php echo esc_url( $bg_repeat ); ?>" data-color="<?php echo esc_attr( $bg_color ); ?>" data-attachment="<?php echo esc_attr( $bg_attachment ); ?>" data-size="<?php echo esc_attr( $bg_size ); ?>" data-position="<?php echo esc_attr( $bg_position ); ?>">
				
					<div class="wp-backgrounds-fields">
					
						<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $bg_color ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][bg_color]" data-alpha-enabled="true" />
					
						<select class="wp-background-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][bg_repeat]">
							<option value=""><?php esc_html_e( 'Background Repeat', 'hirxpert-addon' ); ?></option>
						<?php
							foreach( $bg_repeat_arr as $key => $bg_repeat_attr ){
								echo '<option value="'. esc_attr( $key ) .'" '. ( $bg_repeat == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $bg_repeat_attr ) .'</option>';
							}
						?>
						</select>
						
						<select class="wp-background-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][bg_size]">
							<option value=""><?php esc_html_e( 'Background Size', 'hirxpert-addon' ); ?></option>
						<?php
							foreach( $bg_size_arr as $key => $bg_size_attr ){
								echo '<option value="'. esc_attr( $key ) .'" '. ( $bg_size == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $bg_size_attr ) .'</option>';
							}
						?>
						</select>
						
						<select class="wp-background-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][bg_attachment]">
							<option value=""><?php esc_html_e( 'Background Attachment', 'hirxpert-addon' ); ?></option>
						<?php
							foreach( $bg_attachment_arr as $key => $bg_attachment_attr ){
								echo '<option value="'. esc_attr( $key ) .'" '. ( $bg_attachment == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $bg_attachment_attr ) .'</option>';
							}
						?>
						</select>
						
						<select class="wp-background-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][bg_position]">
							<option value=""><?php esc_html_e( 'Background Position', 'hirxpert-addon' ); ?></option>
						<?php
							foreach( $bg_position_arr as $key => $bg_position_attr ){
								echo '<option value="'. esc_attr( $key ) .'" '. ( $bg_position == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $bg_position_attr ) .'</option>';
							}
						?>
						</select>
						
						<div class="hirxpert-image-upload-field">
							<input type="hidden" class="hirxpert-img-id" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][image][id]" value="<?php echo esc_attr( $bg_media_id ); ?>" />
							<input type="hidden" class="hirxpert-img-url" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][image][url]" value="<?php echo esc_attr( $bg_media_url ); ?>" />						
							<div class="img-btn-controls">
								<input type="button" class="wp-background-field bg-upload-image-button" value="<?php esc_html_e( 'Upload Image', 'hirxpert-addon' ); ?>" />
								<input type="button" class="bg-remove-image-button" value="<?php esc_html_e( 'Remove Image', 'hirxpert-addon' ); ?>" />
							</div>
							<div class="img-place">
								<?php
									if( !empty( $bg_media_url ) ) :
										$media_alt = $bg_media_id ? get_post_meta( $bg_media_id, '_wp_attachment_image_alt', true ) : '';
								?>
									<img src="<?php echo esc_url( $bg_media_url ); ?>" alt="<?php echo esc_attr( $media_alt ); ?>" class="hirxpert-bg-img">
								<?php endif; ?>
							</div>
						</div>
					</div>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_border_field( $config ){
		
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$brdr_decond = $saved_val; 
		$left = $right = $top = $bottom = $style = $color = '';
		
		if( is_array( $brdr_decond ) && !empty( $brdr_decond ) ){
			$left = $brdr_decond['left'];
			$right = $brdr_decond['right'];
			$top = $brdr_decond['top'];
			$bottom = $brdr_decond['bottom'];
			$style = $brdr_decond['style'];
			$color = $brdr_decond['color'];
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="border-wrap">
				<div class="title-description">
					<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
					<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
				<div class="border-inner">	
					
					<ul class="wp-border-list">
						<li>
							<input type="number" class="wp-border-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][top]" value="<?php echo esc_attr( $top ); ?>">
							<span class="wp-border-info"><?php esc_html_e( 'Top', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-border-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][right]" value="<?php echo esc_attr( $right ); ?>">
							<span class="wp-border-info"><?php esc_html_e( 'Right', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-border-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][bottom]" value="<?php echo esc_attr( $bottom ); ?>">
							<span class="wp-border-info"><?php esc_html_e( 'Bottom', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-border-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][left]" value="<?php echo esc_attr( $left ); ?>">
							<span class="wp-border-info"><?php esc_html_e( 'Left', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<select class="wp-border-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][style]">
								<option value="none"<?php if( $style == 'none' ) echo ' selected="selected"'; ?>><?php esc_html_e( 'None', 'hirxpert-addon' ); ?></option>
								<option value="solid"<?php if( $style == 'solid' ) echo ' selected="selected"'; ?>><?php esc_html_e( 'Solid', 'hirxpert-addon' ); ?></option>
								<option value="dashed"<?php if( $style == 'dashed' ) echo ' selected="selected"'; ?>><?php esc_html_e( 'Dashed', 'hirxpert-addon' ); ?></option>
								<option value="dotted"<?php if( $style == 'dotted' ) echo ' selected="selected"'; ?>><?php esc_html_e( 'Dotted', 'hirxpert-addon' ); ?></option>
								<option value="double"<?php if( $style == 'double' ) echo ' selected="selected"'; ?>><?php esc_html_e( 'Double', 'hirxpert-addon' ); ?></option>							
							</select>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][color]" data-alpha-enabled="true" />
							</div><!-- .alpha-wrap -->
						</li>
					</ul>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_dimension_field( $config ){
		
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];		
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$dim_decond = $saved_val; 
		$left = $right = $top = $bottom = '';
		
		if( is_array( $dim_decond ) && !empty( $dim_decond ) ){
			$top = $dim_decond['top'];
			$right = $dim_decond['right'];
			$bottom = $dim_decond['bottom'];
			$left = $dim_decond['left'];
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="dimensions-wrap">
				<div class="title-description">
					<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
					<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
				<div class="dimensions-inner">

					<ul class="wp-dimensions-list">
						<li>
							<input type="number" class="wp-dimensions-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][top]" value="<?php echo esc_attr( $top ); ?>">
							<span class="wp-dimensions-info"><?php esc_html_e( 'Top', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-dimensions-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][right]" value="<?php echo esc_attr( $right ); ?>">
							<span class="wp-dimensions-info"><?php esc_html_e( 'Right', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-dimensions-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][bottom]" value="<?php echo esc_attr( $bottom ); ?>">
							<span class="wp-dimensions-info"><?php esc_html_e( 'Bottom', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<input type="number" class="wp-dimensions-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][left]" value="<?php echo esc_attr( $left ); ?>">
							<span class="wp-dimensions-info"><?php esc_html_e( 'Left', 'hirxpert-addon' ) ?></span>
						</li>
					</ul>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_google_fonts_field( $config ){
		
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$alpha = isset( $config['alpha'] ) ? $config['alpha'] : false;
		
		$fonts_ele = $saved_val;
		$fonts_decond = $font_family = $font_weight = $font_sub = $text_align = $text_transform = $font_size = $line_height = $letter_spacing = $font_color = '';
		if( $fonts_ele ){
			$fonts_decond = $fonts_ele;
			if( is_array( $fonts_decond ) && !empty( $fonts_decond ) ){
				$font_family = isset( $fonts_decond['font_family'] ) ? $fonts_decond['font_family'] : '';
				$font_weight = isset( $fonts_decond['font_weight'] ) ? $fonts_decond['font_weight'] : '';
				$font_sub = isset( $fonts_decond['font_sub'] ) ? $fonts_decond['font_sub'] : '';
				$text_align = isset( $fonts_decond['text_align'] ) ? $fonts_decond['text_align'] : '';
				$text_transform = isset( $fonts_decond['text_transform'] ) ? $fonts_decond['text_transform'] : '';
				$font_size = isset( $fonts_decond['font_size'] ) ? $fonts_decond['font_size'] : '';
				$line_height = isset( $fonts_decond['line_height'] ) ? $fonts_decond['line_height'] : '';
				$letter_spacing = isset( $fonts_decond['letter_spacing'] ) ? $fonts_decond['letter_spacing'] : '';
				$font_color = isset( $fonts_decond['font_color'] ) ? $fonts_decond['font_color'] : '';
			}
		}	
				
		$font_family_arr = Hirxpert_Google_Fonts_Function::$_standard_fonts;
		
		$text_align_arr = array(
			'inherit' => esc_html__( 'Inherit', 'hirxpert-addon' ),
			'left' => esc_html__( 'Left', 'hirxpert-addon' ),
			'right' => esc_html__( 'Right', 'hirxpert-addon' ),
			'center' => esc_html__( 'Center', 'hirxpert-addon' ),
			'justify' => esc_html__( 'Justify', 'hirxpert-addon' ),
			'initial' => esc_html__( 'Initial', 'hirxpert-addon' )
		);
		
		$text_trans_arr = array(
			'capitalize' => esc_html__( 'Capitalize', 'hirxpert-addon' ),
			'inherit' => esc_html__( 'Inherit', 'hirxpert-addon' ),
			'initial' => esc_html__( 'Initial', 'hirxpert-addon' ),
			'lowercase' => esc_html__( 'Lower Case', 'hirxpert-addon' ),
			'uppercase' => esc_html__( 'Upper Case', 'hirxpert-addon' ),
			'none' => esc_html__( 'None', 'hirxpert-addon' ),
			'unset' => esc_html__( 'Unset', 'hirxpert-addon' )
		);
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
		?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="wp-fonts-wrap">
			
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				
				<div class="wp-fonts-inner">
										 
					<div class="wp-fonts-fields">
						<ul class="wp-fonts-fields-list">
							<li>
								<span><?php esc_html_e( 'Font Family', 'hirxpert-addon' );?></span>
								<select class="wp-font-field wp-font-family-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][font_family]" data-val="<?php echo esc_attr( $font_family ); ?>">
								
								<?php
								$cf_names = get_option( 'hirxpert_custom_fonts' );
								if( !empty( $cf_names ) && is_array( $cf_names ) ){
								?>
									<option value="" class="bold-font"><?php esc_html_e( 'Custom Fonts', 'hirxpert-addon' ); ?></option>
								<?php
									foreach( $cf_names as $key => $font_name ){
										echo '<option value="'. esc_attr( $font_name ) .'" '. ( $font_family == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $font_name ) .'</option>';
									}
								}
								?>
								
									<option value="" class="bold-font"><?php esc_html_e( 'Standard Fonts', 'hirxpert-addon' ); ?></option>
								<?php
									foreach( $font_family_arr as $key => $font_family_attr ){
										echo '<option value="'. esc_attr( $key ) .'" '. ( $font_family == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $font_family_attr ) .'</option>';
									}
								?>
									<option value="google-fonts" class="bold-font"><?php esc_html_e( 'Google Fonts', 'hirxpert-addon' ); ?></option>
								</select>
							</li>
							<li>
								<span><?php esc_html_e( 'Font Weight &amp; Style', 'hirxpert-addon' ); ?></span>
								<select class="wp-font-field wp-font-weight-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][font_weight]" data-val="<?php echo esc_attr( $font_weight ); ?>">
									<option value=""><?php esc_html_e( 'Font Weight &amp; Style', 'hirxpert-addon' ); ?></option>
								</select>
							</li>
							<li>
								<span><?php esc_html_e( 'Font Subsets', 'hirxpert-addon' ); ?></span>
								<select class="wp-font-field wp-font-sub-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][font_sub]" data-val="<?php echo esc_attr( $font_sub ); ?>">
									<option value=""><?php esc_html_e( 'Font Subsets', 'hirxpert-addon' ); ?></option>
								</select>
							</li>
							<li>
								<span><?php esc_html_e( 'Text Align', 'hirxpert-addon' ); ?></span>
								<select class="wp-font-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][text_align]">
									<option value=""><?php esc_html_e( 'Text Align', 'hirxpert-addon' ); ?></option>
								<?php
									foreach( $text_align_arr as $key => $text_align_attr ){
										echo '<option value="'. esc_attr( $key ) .'" '. ( $text_align == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $text_align_attr ) .'</option>';
									}
								?>
								</select>
							</li>
							<li>
								<span><?php esc_html_e( 'Text Transform', 'hirxpert-addon' ); ?></span>
								<select class="wp-font-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][text_transform]">
									<option value=""><?php esc_html_e( 'Text Transform', 'hirxpert-addon' ); ?></option>
								<?php
									foreach( $text_trans_arr as $key => $text_trans_attr ){
										echo '<option value="'. esc_attr( $key ) .'" '. ( $text_transform == $key ? 'selected="selected"' : '' ) .'>'. esc_html( $text_trans_attr ) .'</option>';
									}
								?>
								</select>
							</li>
							<li>	
								<span><?php esc_html_e( 'Font Size', 'hirxpert-addon' ); ?></span>						
								<input type="number" step="1" min="0" class="wp-font-field wp-font-size-field" value="<?php echo esc_attr( $font_size ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][font_size]" />
								<span class="wp-font-abs-units"><?php esc_html_e( 'px', 'hirxpert-addon' ); ?></span>		
							</li>
							<li>
								<span><?php esc_html_e( 'Line Height', 'hirxpert-addon' ); ?></span>
								<input type="number" step="1" min="-100" class="wp-font-field wp-font-line-height-field" value="<?php echo esc_attr( $line_height ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][line_height]" />
								<span class="wp-font-abs-units"><?php esc_html_e( 'px', 'hirxpert-addon' ); ?></span>
							</li>
							<li>
								<span><?php esc_html_e( 'Letter Spacing', 'hirxpert-addon' ); ?></span>
								<input type="number" step="1" min="-100" class="wp-font-field wp-font-letter-spacing-field" value="<?php echo esc_attr( $letter_spacing ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][letter_spacing]" />
								<span class="wp-font-abs-units"><?php esc_html_e( 'px', 'hirxpert-addon' ); ?></span>
							</li>
							<li>
								<span><?php esc_html_e( 'Font Color', 'hirxpert-addon' ); ?></span>
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $font_color ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][font_color]" data-alpha-enabled="<?php echo esc_attr( $alpha ); ?>" />
							</li>
						</ul>
					</div>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_button_color_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
				
		$lc_ele = $saved_val; 
		$lc_decond = $color_fore = $color_bg = $color_border = '';
		$color_hfore = $color_hbg = $color_hborder = '';
		if( $lc_ele ){
			$lc_decond = $lc_ele;
			if( is_array( $lc_decond ) && !empty( $lc_decond ) ){
				$color_fore = $lc_decond['fore'];
				$color_bg = $lc_decond['bg'];
				$color_border = $lc_decond['border'];
				$color_hfore = $lc_decond['hfore'];
				$color_hbg = $lc_decond['hbg'];
				$color_hborder = $lc_decond['hborder'];
			}
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="link-colors-wrap">
			
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				
				<div class="link-colors-inner">
					<ul class="link-colors-list">
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_fore ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][fore]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Fore Color', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_bg ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][bg]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Bg Color', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_border ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][border]" data-alpha-enabled="true" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Border Color', 'hirxpert-addon' ) ?></span>
						</li>
					</ul>
					<ul class="link-colors-list">
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_hfore ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][hfore]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Hover Fore Color', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_hbg ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][hbg]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Hover Bg Color', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $color_hborder ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][hborder]" data-alpha-enabled="true" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Hover Border Color', 'hirxpert-addon' ) ?></span>
						</li>
					</ul>					
				</div>			
			</div>
		</div>
	<?php
	}
	
	public static function build_link_color_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
				
		$lc_ele = $saved_val; 
		$lc_decond = $regular = $hover = $active = '';
		if( $lc_ele ){
			$lc_decond = $lc_ele;
			if( is_array( $lc_decond ) && !empty( $lc_decond ) ){
				$regular = $lc_decond['regular'];
				$hover = $lc_decond['hover'];
				$active = $lc_decond['active'];
			}
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="link-colors-wrap">
				<div class="title-description">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
				<div class="link-colors-inner">
					<ul class="link-colors-list">
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $regular ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][regular]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Regular', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $hover ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][hover]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Hover', 'hirxpert-addon' ) ?></span>
						</li>
						<li>
							<div class="color-control-wrap">
								<input type="text" class="wp-font-field wp-font-color-field" value="<?php echo esc_attr( $active ); ?>" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][active]" data-alpha-enabled="0" />
							</div><!-- .alpha-wrap -->
							<span class="wp-color-info"><?php esc_html_e( 'Active', 'hirxpert-addon' ) ?></span>
						</li>
					</ul>					
				</div>			
			</div>
		</div>
	<?php
	}
	
	public static function build_multi_check_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$mc_ele = $saved_val; 
		$mc_items = isset( $config['items'] ) ? $config['items'] : '';;
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
	
		?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="multi-check-wrap">
				
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				
				<div class="multi-check-inner">
					<ul class="wp-multi-check-list">
					<?php
						if( $mc_items ){
							foreach( $mc_items as $key => $value ){
								$checked = !empty( $mc_ele ) && is_array( $mc_ele ) && in_array( $key, $mc_ele ) ? " checked" : "";
								echo '<li><input type="checkbox" name="hirxpert_options['. esc_attr( $field_id ) .'][]" value="'. esc_attr( $key ) .'" '. esc_attr( $checked ) .' /><label>'. esc_html( $value ) .'</label></li>';
							}
						}
					?>
					</ul>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_radio_image_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = stripslashes( $hirxpert_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$ri_ele = $saved_val; 
		$ri_items = isset( $config['items'] ) ? $config['items'] : '';;
		$classes = isset( $config['cols'] ) && !empty( $config['cols'] ) ? ' image-col-'. $config['cols'] : ' image-col-3';
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" data-field-type="radio-image" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>" data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="radio-image-wrap<?php echo esc_attr( $classes ); ?>">
				<div class="title-description">
					<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
					<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
				<div class="radio-image-inner">
					<ul class="wp-radio-image-list">
					<?php
						if( $ri_items ){
							foreach( $ri_items as $key => $img ){
								$checked = !empty( $ri_ele ) && $key == $ri_ele ? " checked" : "";
								echo '<li><input type="radio" name="hirxpert_options['. esc_attr( $field_id ) .']" value="'. esc_attr( $key ) .'" '. esc_attr( $checked ) .' /><span class="wp-radio-image-field"><img alt="'. esc_attr( $key ) .'" src="'. esc_url( $img['url'] ) .'" /></span><span class="wp-color-info">'. esc_html( $img['title'] ) .'</span></li>';
							}
						}
					?>
					</ul>					
				</div>
				<input type="hidden" class="hirxpert-control-hidden-val" value="<?php echo esc_attr( $ri_ele ); ?>" />
			</div>
		</div>
	<?php
	}
	
	public static function build_sidebars_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = stripslashes( $hirxpert_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="dropdown-sidebars-wrap">
				<div class="title-description">
					<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
					<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
				<div class="dropdown-sidebars-inner">
					<select class="wp-dropdown-sidebars-list hirxpert-customizer-select-field" data-key="<?php echo esc_attr( $field_id ); ?>" id="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]">
						<option value=""><?php esc_html_e( 'None', 'hirxpert-addon' ); ?></option>
					<?php
						$sidebars = $GLOBALS['wp_registered_sidebars'];
						if( $sidebars ){
							foreach( $sidebars as $sidebar ){
								echo '<option value="'. esc_attr( $sidebar['id'] ) .'" '. selected( $saved_val, $sidebar['id'] ) .'>'. esc_html( $sidebar['name'] ) .'</option>';
							}
						}
					?>
					</select>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_pages_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = stripslashes( $hirxpert_options[$field_id] );
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="dropdown-pages-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				<div class="dropdown-pages-inner">
					<select class="wp-dropdown-pages-list hirxpert-customizer-page-field" data-key="<?php echo esc_attr( $field_id ); ?>" id="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]">
						<option value=""><?php esc_html_e( 'None', 'hirxpert-addon' ); ?></option>
					<?php
						$pages = get_pages();
						if( $pages ){
							foreach( $pages as $page ){
								echo '<option value="'. esc_attr( $page->ID ) .'" '. selected( $saved_val, $page->ID ) .'>'. esc_html( $page->post_title ) .'</option>';
							}
						}
					?>
					</select>					
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function build_toggle_switch_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id] == 1 ? true : false;
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : 0;
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : 0;
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-field-type="checkbox" data-id="<?php echo esc_attr( $field_id ); ?>" data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="checkbox_switch">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				<div class="hirxpert-switch">
					<input type="checkbox" class="onoffswitch-checkbox" <?php checked( $saved_val ); ?>>
					<span class="slider round"></span>
				</div>
				<input type="hidden" class="hirxpert-control-hidden-val" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>]" value="<?php echo esc_attr( $saved_val ); ?>">
			</div>
		</div>
	<?php
	}
	
	public static function build_height_weight_field( $config ){ 
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		
		$only_dimension = isset( $config['only_dimension'] ) ? $config['only_dimension'] : 'both';
		
		$saved_val = '';
		if( isset( $hirxpert_options[$field_id] ) ){
			$saved_val = $hirxpert_options[$field_id];
		}else{
			$saved_val = isset( $config['default'] ) ? $config['default'] : '';
		}
		
		$hw_ele = $saved_val; 
		$dim_decond = $width = $height = '';
		if( $hw_ele ){
			$dim_decond = $hw_ele;
		}
		
		if( is_array( $dim_decond ) && !empty( $dim_decond ) ){
			$width = isset( $dim_decond['width'] ) ? $dim_decond['width'] : '';
			$height = isset( $dim_decond['height'] ) ? $dim_decond['height'] : '';
		}
		
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}
		
	?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">

			<div class="width-height-wrap">
				<div class="title-description">
					<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
					<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				</div>
				<div class="width-height-inner">
		
					<div class="hirxpert-customizer-ajax-hid-wrap" data-key="<?php echo esc_attr( $field_id ); ?>">
						<?php if( $only_dimension == 'both' || $only_dimension == 'width' ) : ?>
							<input type="text" class="width-height-hid-text" data-key="<?php echo esc_attr( $field_id ); ?>" id="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][width]"  value="<?php echo esc_attr( $width ); ?>">
						<?php endif; ?>
						<?php if( $only_dimension == 'both' || $only_dimension == 'height' ) : ?>
							<input type="text" class="width-height-hid-text" data-key="<?php echo esc_attr( $field_id ); ?>" id="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][height]" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][height]" value="<?php echo esc_attr( $height ); ?>">
						<?php endif; ?>
					</div>

					<ul class="wp-width-height-list">
						<?php if( $only_dimension == 'both' || $only_dimension == 'width' ) : ?>
							<li>
								<input type="number" class="wp-wh-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][width]" value="<?php echo esc_attr( $width ); ?>">
								<span class="wp-wh-info"><?php esc_html_e( 'Width', 'hirxpert-addon' ) ?></span>
							</li>
						<?php endif; ?>
						<?php if( $only_dimension == 'both' || $only_dimension == 'height' ) : ?>
						<li>
							<input type="number" class="wp-wh-field" name="hirxpert_options[<?php echo esc_attr( $field_id ); ?>][height]" value="<?php echo esc_attr( $height ); ?>">
							<span class="wp-wh-info"><?php esc_html_e( 'Height', 'hirxpert-addon' ) ?></span>
						</li>
						<?php endif; ?>
					</ul>					
				</div>
			</div>
			
		</div>
	<?php
	}
	

    public static function check_drag_drop_editor_field_values($dd_fields, $dd_default) {				
		if (!function_exists('recursive_array_diff_assoc')) {
			function recursive_array_diff_assoc($array1, $array2) {
				$difference = [];
				foreach ($array1 as $key => $value) {
					if (is_array($value)) {
						if (!isset($array2[$key]) || !is_array($array2[$key])) {
							$difference[$key] = $value;
						} else {
							$new_diff = recursive_array_diff_assoc($value, $array2[$key]);
							if (!empty($new_diff)) {
								$difference[$key] = $new_diff;
							}
						}
					} elseif (!array_key_exists($key, $array2) || $array2[$key] !== $value) {
						$difference[$key] = $value;
					}
				}
				return $difference;
			}
		}

        if (!is_array($dd_default)) {
            $dd_default = [];
        }
        if (!is_array($dd_fields)) {
            $dd_fields = [];
        }
        if (empty($dd_fields)) return $dd_default;

        $dd_default_new = [];
        $dd_fields_recreate = [];

        if (is_array($dd_default)) {
            foreach ($dd_default as $key => $value) {
                if (!isset($dd_fields[$key])) {
                    $dd_fields_recreate[$key] = [];
                } else {
                    $dd_fields_recreate[$key] = $dd_fields[$key];
                }
                if (is_array($value)) {
                    foreach ($value as $field_key => $field_value) {
                        $dd_default_new[$field_key] = $field_value;
                    }
                }
            }
        }

        $dd_fields_new = [];
        if (is_array($dd_fields_recreate)) {
            foreach ($dd_fields_recreate as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $field_key => $field_value) {
                        $dd_fields_new[$field_key] = $field_value;
                    }
                }
            }
        }

        $result = '';
        if (count($dd_default_new) < count($dd_fields_new)) {
            $result = array_diff_key($dd_fields_new, $dd_default_new);
            if (is_array($dd_fields_recreate)) {
                foreach ($dd_fields_recreate as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $field_key => $field_value) {
                            if (!empty($dd_fields_recreate[$key]) && array_key_exists($field_key, $result)) {
                                unset($dd_fields_recreate[$key][$field_key]);
                            }
                        }
                    }
                }
            }
        }

        $result = array_diff_key($dd_default_new, $dd_fields_new);
        if (!empty($result)) {
            if (isset($dd_fields_recreate['disabled']) && is_array($dd_fields_recreate['disabled'])) {
                foreach ($result as $key => $value) {
                    $dd_fields_recreate['disabled'][$key] = $value;
                }
            }
        }

        $label_diff = recursive_array_diff_assoc($dd_fields_new, $dd_default_new);
        $dd_labels_new = [];
        if ($label_diff) {
            if (is_array($dd_default)) {
                foreach ($dd_default as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $field_key => $field_value) {
                            $dd_labels_new[$field_key] = $field_value;
                        }
                    }
                }
            }
            if (is_array($dd_fields_recreate)) {
                foreach ($dd_fields_recreate as $key => $value) {
                    if (is_array($value)) {
                        foreach ($value as $field_key => $field_value) {
                            $dd_fields_recreate[$key][$field_key] = $dd_labels_new[$field_key];
                        }
                    }
                }
            }
        }

        return $dd_fields_recreate;
    }

	public static function hirxpert_drag_drop_editor_formation($field_id, $part, $post_items, $config, $html = false, $icons_only = false) {
		if ($html) {
			$t_hirxpert_options = get_option('hirxpert_options');
		}
		$output = '<ul class="hirxpert-dd-items ui-sortable" data-part="' . esc_attr($part) . '">';
		if (!empty($post_items)) {
			foreach ($post_items as $key => $value) {
				$html_val = $value;
				if ($icons_only) {
					$html_val = '<i class="' . $value . '"></i>';
				} elseif ($html) {
					$custom_val = isset($t_hirxpert_options[$field_id]['url'][$key]) ? $t_hirxpert_options[$field_id]['url'][$key] : '';
					$html_val = '<i class="' . $value . '"></i>';
					$html_val .= '<div class="drag-drop-custom-value">
						<input type="text" name="hirxpert_options[' . esc_attr($field_id) . '][' . esc_attr($part) . '][' . esc_attr($key) . '][url]" value="' . $custom_val . '" placeholder="' . esc_html__('Enter url', 'hirxpert-addon') . '" />
					</div>';
				} else {
					$html_val = esc_attr($value);
				}
				$is_editable = '';
				if (isset($config['items']) && is_array($config['items']) && isset($config['items'][$key])) {
					$item_config = $config['items'][$key];
					$is_editable = isset($item_config['editable']) && $item_config['editable'] ? 'is-editable  ui-sortable-handler' : '';
				}
				$output .= '<li class="hirxpert-item ' . esc_attr($is_editable) . '" data-id="' . esc_attr($key) . '" data-val="' . esc_attr($key) . '">
					' . $html_val . '
					<input type="hidden" class="dd-input" name="hirxpert_options[' . esc_attr($field_id) . '][' . esc_attr($part) . '][' . esc_attr($key) . ']" value="' . esc_attr($value) . '" />
				</li>';
			}
		}
		$output .= '</ul>';
		return $output;
	}

	public static function build_dragdrop_editor_field($config) {
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		$dd_parts = is_array($config['default']) ? $config['default'] : '';
		$dd_fields = '';
		if (isset($hirxpert_options[$field_id]) && !empty($hirxpert_options[$field_id])) {
			$dd_fields = $hirxpert_options[$field_id];
		} else {
			$dd_fields = $dd_parts;
		}
		$dd_fields = self::check_drag_drop_editor_field_values($dd_fields, $config['default']);
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}?>
		<div class="hirxpert-control<?php echo esc_attr($required_class); ?>"<?php echo !empty( $required_out ) ? $required_out : ''; ?>
			data-id="<?php echo esc_attr($field_id); ?>">
			<div class="wp-drag-drop-wrap">
				<?php if (isset($config['title']) && !empty($config['title'])): ?>
					<label class="customize-control-title"><?php echo esc_html($config['title']); ?></label>
				<?php endif; ?>
				<?php if (isset($config['description']) && !empty($config['description'])): ?>
					<span class="description customize-control-description"><?php echo wp_kses_post($config['description']); ?></span>
				<?php endif; ?>
				<div class="wp-drag-drop-inner">
					<div class="wp-drag-drop-fields"<?php echo esc_attr($required_class); ?> <?php echo !empty($required_out) ? $required_out : ''; ?> data-id="<?php echo esc_attr($field_id); ?>">
						<?php
						$part_array = $dd_fields;
						$t_part_array = array();
						if (!empty($part_array) && is_array($part_array)) {
							foreach ($part_array as $key => $value) {
								if (isset($dd_fields['disabled']) && in_array($key, array_keys($dd_fields['disabled']))) {
									continue;
								}
								$html = isset( $config['html'] ) ? $config['html'] : false;
								$icons_only = isset( $config['icons_only'] ) ? $config['icons_only'] : false;
								$t_part_array[$key] = is_array($dd_fields[$key]) && !empty($dd_fields[$key]) 
								? self::hirxpert_drag_drop_editor_formation($field_id, $key, $dd_fields[$key], $config, $html, $icons_only) 
								: '<ul class="hirxpert-dd-items ui-sortable" data-part="'. esc_attr($key) .'"></ul>';

							}
							echo '<div class="meta-drag-drop-multi-field-header-items">';
							foreach ($t_part_array as $key => $value) {
								echo '<div class="field-values '.$key.'">';
								echo '<h4>'. esc_html(self::hirxpert_theme_option_strings($key)) .'</h4>';
								echo ''. $value;
								echo '</div>';
							}
							echo '</div>';
						}
						?>
					</div>
				</div>
			</div>
			<?php if (isset($config['items']) && is_array($config['items'])): ?>
				<?php foreach ($config['items'] as $item_key => $item_config): ?>
					<div class="dragdrop-editor-modal" id="modal-<?php echo esc_attr($item_key); ?>" style="display: none;">
						<button type="button" class="close-modal-button">&times;</button>
						<div class="title-editor-field">
							<h3><?php echo esc_html($item_config['title']); ?></h3>
						</div>
						<div class="editor-fields">
							<?php
							if (isset($item_config['fields']) && is_array($item_config['fields'])) {
								foreach ($item_config['fields'] as $field) {
									echo self::hirxpert_set_field($field_id . '[' . $item_key . ']', array($field));
								}
							}?>
						</div>
						<button type="button" class="button save-dragdrop-item"><?php esc_html_e('Save Item', 'hirxpert-addon'); ?></button>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div><?php
	}

	public static function check_drag_drop_field_values( $dd_fields, $dd_default ){
		
		if( empty( $dd_fields ) ) return $dd_default;
						
		$dd_default_new = array(); $dd_fields_recreate = array();
		foreach( $dd_default as $key => $value ){
			if( !isset( $dd_fields[$key] ) ){
				$dd_fields_recreate[$key] = array();
			}else{
				$dd_fields_recreate[$key] = $dd_fields[$key];
			}
			foreach( $value as $field_key => $field_value ) $dd_default_new[$field_key] = $field_value;
		}

		$dd_fields_new = array();
		foreach( $dd_fields_recreate as $key => $value ){
			foreach( $value as $field_key => $field_value ) $dd_fields_new[$field_key] = $field_value;
		}
		
		//Additional part start for checking if any item removed
		$result = '';
		if( count( $dd_default_new ) < count( $dd_fields_new ) ) { 
			$result = array_diff_key( $dd_fields_new, $dd_default_new );
			foreach( $dd_fields_recreate as $key => $value ){ 
				foreach( $value as $field_key => $field_value ) {
					if( !empty( $dd_fields_recreate[$key] ) && array_key_exists( $field_key, $result ) ) {
						unset( $dd_fields_recreate[$key][$field_key] );
					}
				}
			}					
		}		
		//Additional part end
		$result = array_diff_key( $dd_default_new, $dd_fields_new );
		if( !empty( $result ) ){			
			if( isset( $dd_fields_recreate['disabled'] ) ){
				foreach( $result as $key => $value ) {
					$dd_fields_recreate['disabled'][$key] = $value;
				}
			}
		}
		$label_diff = array_diff_assoc( $dd_fields_new, $dd_default_new );
		$dd_labels_new = array();
		if( $label_diff ) {
			foreach( $dd_default as $key => $value ){
				foreach( $value as $field_key => $field_value ) $dd_labels_new[$field_key] = $field_value;
			}
			foreach( $dd_fields_recreate as $key => $value ){
				foreach( $value as $field_key => $field_value ) $dd_fields_recreate[$key][$field_key] = $dd_labels_new[$field_key];
			}
		}
		
		return $dd_fields_recreate;
	}
	
	public static function hirxpert_drag_drop_formation( $field_id, $part, $post_items, $html = false, $icons_only = false ) {
		if( $html ) $t_hirxpert_options = get_option( 'hirxpert_options' );
		$output = '<ul class="hirxpert-dd-items ui-sortable" data-part="'. esc_attr( $part ) .'">';
		if( !empty( $post_items ) ){
			foreach( $post_items as $key => $value ){
				$html_val = $value;
				if( $icons_only ){
					$html_val = '<i class="'. $value .'"></i>';
				}elseif( $html ){
					$custom_val = isset( $t_hirxpert_options[$field_id]['url'][$key] ) ? $t_hirxpert_options[$field_id]['url'][$key] : '';
					$html_val = '<i class="'. $value .'"></i>';
					$html_val .= '<div class="drag-drop-custom-value"><input type="text" name="hirxpert_options['. esc_attr( $field_id ) .'][url]['. esc_attr( $key ) .']" value="'. $custom_val .'" placeholder="'. esc_html__( 'Enter url', 'hirxpert-addon' ) .'" /></div>';					
				}else{
					$html_val = esc_attr( $value );
				}
				$output .= '<li data-id="'. esc_attr( $key ) .'" data-val="'. esc_attr( $key ) .'">'. $html_val .'<input type="hidden" class="dd-input" name="hirxpert_options['. esc_attr( $field_id ) .']['. esc_attr( $part ) .']['. esc_attr( $key ) .']" value="'. esc_attr( $value ) .'" /></li>';
			}
		}
		$output .= '</ul>';
		return $output;
	}

	public static function build_drag_drop_field( $config ){
		$hirxpert_options = self::$hirxpert_options;
		$field_id = $config['id'];
		$dd_parts = isset( $config['default'] ) ? $config['default'] : '';
		
		$dd_fields = '';
		if( isset( $hirxpert_options[$field_id] ) && !empty( $hirxpert_options[$field_id] ) ){
			$dd_fields = $hirxpert_options[$field_id];
		}else{
			$dd_fields = $dd_parts;
		}
		$dd_fields = self::check_drag_drop_field_values( $dd_fields, $config['default'] );
		$required = isset( $config['required'] ) ? $config['required'] : '';
		$required_out = $required_class = '';
		if( $required ){
			$required_class = ' hirxpert-customize-required';
			$req_value = is_array( $required ) && isset( $required[2] ) && !empty( $required[2] )  ? implode( ",", $required[2] ) : '';
			$required_out .= 'data-required="'. $required[0] .'" data-required-cond="'. $required[1] .'"  data-required-val="'. $req_value .'" ';
		}?>
		<div class="hirxpert-control<?php echo esc_attr( $required_class ); ?>" <?php echo !empty( $required_out ) ? $required_out : ''; ?> data-id="<?php echo esc_attr( $field_id ); ?>">
			<div class="wp-drag-drop-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo wp_kses_post( $config['description'] ); ?></span><?php endif; ?>
				<div class="wp-drag-drop-inner">
					<div class="wp-drag-drop-fields">
						<?php
						$part_array = $dd_fields;
						$t_part_array = array();
						$html = isset( $config['html'] ) ? $config['html'] : false;
						$icons_only = isset( $config['icons_only'] ) ? $config['icons_only'] : false;

						if( !empty( $part_array ) && is_array( $part_array ) ){
							foreach( $part_array as $key => $value ){
								$t_part_array[$key] = !empty( $dd_fields[$key] ) ? self::hirxpert_drag_drop_formation( $field_id, $key, $dd_fields[$key], $html, $icons_only, $config ) : '<ul class="hirxpert-dd-items ui-sortable" data-part="'. esc_attr( $key ) .'"></ul>';
							}
							echo '<div class="meta-drag-drop-multi-field">';
							foreach( $t_part_array as $key => $value ){
								echo '<h4>'. esc_html( self::hirxpert_theme_option_strings( $key ) ) .'</h4>';
								echo ''. $value;
							}
							echo '</div>';
						}?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	
	public static function build_export_field( $config ){ 
		?>
		<div class="hirxpert-control">
			<div class="customize-exports-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="customize-exports-inner">
					<a href="#" class="button button-large button-primary btn-lg-button" id="customize-export-custom-btn" target="_blank"><?php esc_html_e( 'Export', 'hirxpert-addon' ); ?></a>
				</div>
			</div>
		</div>
		<?php
	}
	
	public static function build_import_field( $config ){ 
		?>
		<div class="hirxpert-control">
			<div class="customize-imports-wrap">
				<?php if( isset( $config['title'] ) && !empty( $config['title'] ) ): ?><label class="customize-control-title"><?php echo esc_html( $config['title'] ); ?></label><?php endif; ?>
				<?php if( isset( $config['description'] ) && !empty( $config['description'] ) ): ?><span class="description customize-control-description"><?php echo esc_html( $config['description'] ); ?></span><?php endif; ?>
				<div class="customize-imports-inner">
					<textarea class="customize-import-value-box" id="customize-import-value-box" rows="10"></textarea>
				</div>
				<a href="#" class="button button-large button-primary btn-lg-button" id="customize-import-custom-btn" target="_blank"><?php esc_html_e( 'Import', 'hirxpert-addon' ); ?></a>
			</div>
		</div>
		<?php
	}
		
	public static function hirxpert_put_section(){
		echo self::$tab_list;
	}
	
	public static function hirxpert_put_field(){
		echo self::$tab_content;
	}
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
}
Hirxpert_Options::instance();