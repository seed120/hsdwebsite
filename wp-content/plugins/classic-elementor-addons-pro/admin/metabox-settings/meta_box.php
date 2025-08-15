<?php

// metaboxes directory constant
define( 'CEA_METABOXES_DIR', CEA_CORE_URL . 'admin/metabox-settings' );

/**
 * recives data about a form field and spits out the proper html
 *
 * @param	array					$field			array with various bits of information about the field
 * @param	string|int|bool|array	$meta			the saved data for this field
 * @param	array					$repeatable		if is this for a repeatable field, contains parant id and the current integar
 *
 * @return	string									html for the field
 */

function cea_meta_box_unique_key() {
	static $meta_key = 1;
	return $meta_key++;
}

function cea_post_option_get_sidebars( $name, $selected ){
	$output = '<select name="'. esc_attr( $name ) .'">';
		$output .= '<option value="">'. esc_html__( 'None', 'classic-elementor-addons-pro' ) .'</option>';
	foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
		$output .= '<option value="'. ucwords( $sidebar['id'] ) .'"'. ( $selected ==  ucwords( $sidebar['id'] ) ? ' selected="selected"' : '' ) .'>';
			$output .= ucwords( $sidebar['name'] );
		$output .= '</option>';
	}
	$output .= '</select>';
	return $output;
}

function cea_post_option_drag_drop($post_items, $post_items_array, $status) {
	$output = '<ul class="meta-items meta-items-'. esc_attr( $status ) .' ui-sortable">';
	foreach($post_items as $item){		
		$output .= '<li data-id="'. esc_attr( $item ) .'">'. esc_attr( $post_items_array[$item] ) .'</li>';
	}
	$output .= '</ul>';
	return $output;
}

function cea_post_option_drag_drop_multi( $key, $post_items ) {
	$output = '<ul class="meta-items ui-sortable" data-part="'. esc_attr( $key ) .'">';
	foreach( $post_items as $key => $value ){
		$output .= '<li data-id="'. esc_attr( $key ) .'" data-val="'. esc_attr( $value ) .'">'. esc_attr( $value ) .'</li>';
	}
	$output .= '</ul>';
	return $output;
}

function cea_post_option_image_select( $field, $values, $default, $title) {
		$output = '<div class="page-option-image-select">';
			$output .= '<input type="hidden" class="page-option-image-value" name="'. esc_attr( $field ) .'" id="'. esc_attr( $field ) .'" value="'. esc_attr( $default ) .'" />';
		foreach($values as $key => $value){
			$output .= '<span>';
				$output .= '<img src="'. esc_attr( $value ) .'" alt="'. esc_attr( $title ) .'" class="'. ( $default == $key ? 'selected' : '' ) .'" data-value="'. esc_attr( $key ) .'" />';
			$output .= '</span>';
		}
		$output .= '</div>';
		return $output;
	}

function cea_meta_box_field( $field, $meta = null, $repeatable = null ) {
	if ( ! ( $field || is_array( $field ) ) )
		return;
	
	// get field data
	$type = isset( $field['type'] ) ? $field['type'] : null;
	$label = isset( $field['label'] ) ? $field['label'] : null;
	$desc = isset( $field['desc'] ) ? '<span class="description">' . $field['desc'] . '</span>' : null;
	$place = isset( $field['place'] ) ? $field['place'] : null;
	$size = isset( $field['size'] ) ? $field['size'] : null;
	$post_type = isset( $field['post_type'] ) ? $field['post_type'] : null;
	$options = isset( $field['options'] ) ? $field['options'] : null;
	$settings = isset( $field['settings'] ) ? $field['settings'] : null;
	$repeatable_fields = isset( $field['repeatable_fields'] ) ? $field['repeatable_fields'] : null;
	$default = isset( $field['default'] ) ? $field['default'] : null;
	$dd_fields = isset( $field['dd_fields'] ) ? $field['dd_fields'] : null;
	$property = isset( $field['property'] ) ? $field['property'] : null;

	// the id and name for each field
	$id = $name = isset( $field['id'] ) ? $field['id'] : null;
	if ( $repeatable ) {
		$name = $repeatable[0] . '[' . $repeatable[1] . '][' . $id .']';
		$id = $repeatable[0] . '_' . $repeatable[1] . '_' . $id;
	}
	
	$output = '';
	
	switch( $type ) {
		// basic
		case 'text':
		case 'tel':
		case 'email':
		default:
			$output .= '<input type="' . $type . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . esc_attr( $meta ) . '" class="regular-text" size="30" /><br />' . $desc;
		break;
		case 'switch':
		
			$def = isset( $meta ) && $meta != '' ?  esc_attr( $meta ) : $default;
		
			$output .= '
				<div class="cea-switch">
					<label class="switch">
						<input type="checkbox" class="cea-switcher" '. ( $def == '1' ? 'checked' : '1' ) .'>
						<div class="slider round"></div>
					</label>
					<input type="hidden" class="cea-switcher-stat" name="' . esc_attr( $name ) . '" value="'. esc_attr( $def ) .'" />
				</div><br />' . $desc;
		break;
		case 'dimension':
			$space_values = array();
			if( isset( $meta ) && $meta != '' && is_array($meta) ){
				$space_values = $meta;
			}else{
				$space_values = array( '0' => '', '1' => 'px' );
			}
			
			$property = isset( $property ) && $property != '' ? $property : '';
			
			$output .= '<div class="spacing-parent">
							<div class="spacing">';
								if( $property == 'height' ){
  									$output .= '<i class="left-icon fa fa-arrows-v"></i>';
								}elseif( $property == 'width' ){
									$output .= '<i class="left-icon fa fa-arrows-h"></i>';
								}else{
									$output .= '<i class="left-icon dashicons dashicons-editor-distractionfree"></i>';
								}
  					$output .= '<input size="5" type="text" name="' . esc_attr( $name .'_0') . '" value="'. esc_attr( $space_values[0] ) .'">
							</div>
							<select name="' . esc_attr( $name .'_1' ) . '">
								<option value="px" '. ( $space_values['1'] == 'px' ? 'selected' : '' ) .'>'. esc_html__( 'px', 'classic-elementor-addons-pro' ) .'</option>
								<option value="em" '. ( $space_values['1'] == 'em' ? 'selected' : '' ) .'>'. esc_html__( 'em', 'classic-elementor-addons-pro' ) .'</option>
								<option value="percent" '. ( $space_values['1'] == 'percent' ? 'selected' : '' ) .'>%</option>
							</select>
						</div>
						<input type="hidden" name="' . esc_attr( $name ) . '" value="cea_dimension" /><br />' . $desc;
		break;
		case 'space':
			$space_values = array();
			$color_opt = isset( $field['color'] ) ? $field['color'] : null;
			$border_style = isset( $field['border_style'] ) ? $field['border_style'] : null;
			if( isset( $meta ) && $meta != '' && is_array($meta) ){
				$space_values = $meta;
			}else{
				$space_values = array( '0' => '', '1' => '', '2' => '', '3' => '', '4' => 'px', '5' => '', '6' => '' );
			}
			
			$output .= '<div class="spacing-parent">
							<div class="spacing">
  								<i class="left-icon dashicons dashicons-arrow-up-alt"></i>
  								<input size="5" type="text" name="' . esc_attr( $name .'_0') . '" value="'. esc_attr( $space_values[0] ) .'">
							</div>
							<div class="spacing">
							  <i class="left-icon dashicons dashicons-arrow-right-alt"></i>
							  <input size="5" type="text" name="' . esc_attr( $name .'_1' ) . '" value="'. esc_attr( $space_values[1] ) .'">
							</div>
							<div class="spacing">
							  <i class="left-icon dashicons dashicons-arrow-down-alt"></i>
							  <input size="5" type="text" name="' . esc_attr( $name .'_2' ) . '" value="'. esc_attr( $space_values[2] ) .'">
							</div>
							<div class="spacing">
							  <i class="left-icon dashicons dashicons-arrow-left-alt"></i>
							  <input size="5" type="text" name="' . esc_attr( $name .'_3' ) . '" value="'. esc_attr( $space_values[3] ) .'">
							</div>
							<select name="' . esc_attr( $name .'_4' ) . '">
								<option value="px" '. ( $space_values['4'] == 'px' ? 'selected' : '' ) .'>'. esc_html__( 'px', 'classic-elementor-addons-pro' ) .'</option>
								<option value="em" '. ( $space_values['4'] == 'em' ? 'selected' : '' ) .'>'. esc_html__( 'em', 'classic-elementor-addons-pro' ) .'</option>
								<option value="percent" '. ( $space_values['4'] == 'percent' ? 'selected' : '' ) .'>%</option>
							</select>';
							if( $border_style ){
								$output .= '<select name="' . esc_attr( $name .'_6' ) . '">
									<option value="solid" '. ( $space_values['6'] == 'solid' ? 'selected' : '' ) .'>'. esc_html__( 'Solid', 'classic-elementor-addons-pro' ) .'</option>
									<option value="dashed" '. ( $space_values['6'] == 'dashed' ? 'selected' : '' ) .'>'. esc_html__( 'Dashed', 'classic-elementor-addons-pro' ) .'</option>
									<option value="dotted" '. ( $space_values['6'] == 'dotted' ? 'selected' : '' ) .'>'. esc_html__( 'Dotted', 'classic-elementor-addons-pro' ) .'</option>
									<option value="double" '. ( $space_values['6'] == 'double' ? 'selected' : '' ) .'>'. esc_html__( 'Double', 'classic-elementor-addons-pro' ) .'</option>
									<option value="none" '. ( $space_values['6'] == 'none' ? 'selected' : '' ) .'>'. esc_html__( 'None', 'classic-elementor-addons-pro' ) .'</option>
								</select>';
							}else{
								$output .= '<input type="hidden" name="' . esc_attr( $name .'_6' ) . '" value="" />';
							}
							if( $color_opt ){
								$output .= '<input class="cea-color-picker" id="' . esc_attr( $id.'_5' ) . '" name="' . esc_attr( $name.'_5' ) . '" value="' . esc_attr( $space_values[5] ) . '" type="text" size="10" />';
							}else{
								$output .= '<input type="hidden" name="' . esc_attr( $name .'_5' ) . '" value="" />';
							}
			$output .= '</div>
						<input type="hidden" name="' . esc_attr( $name ) . '" value="cea_space" /><br />' . $desc;

		break;
		
		case 'link_color':
			$link_values = array( '0' => '', '1' => '', '2' => '' );
			if( isset( $meta ) && count($meta) && is_array($meta) ){
				$link_values = $meta;
			}
			$output .= '<div class="link-color-parent">
							<i>'. esc_html__( 'Regular', 'classic-elementor-addons-pro' ) .'</i><input type="text" name="' . esc_attr( $name.'_0' ) . '" class="cea-color-picker" id="' . esc_attr( $id.'_0' ) . '" value="' . esc_attr( $link_values[0] ) . '" size="10"  />
							<i>'. esc_html__( 'Hover', 'classic-elementor-addons-pro' ) .'</i><input type="text" name="' . esc_attr( $name.'_1' ) . '" class="cea-color-picker" id="' . esc_attr( $id.'_1' ) . '" value="' . esc_attr( $link_values[1] ) . '" size="10"  />
							<i>'. esc_html__( 'Active', 'classic-elementor-addons-pro' ) .'</i><input type="text" name="' . esc_attr( $name.'_2' ) . '" class="cea-color-picker" id="' . esc_attr( $id.'_2' ) . '" value="' . esc_attr( $link_values[2] ) . '" size="10"  />
						</div>
						<input type="hidden" name="' . esc_attr( $name ) . '" value="cea_link_color" /><br />' . $desc;

		break;
		
		case 'alpha_color':
			$alpha_values = array( '0' => '', '1' => '' );
			if( isset( $meta ) && count($meta) && is_array($meta) ){
				$alpha_values = $meta;
			}

			$output .= '<div class="cea-alpha-color">';
				$output .= '<input type="text" name="' . esc_attr( $name.'_0' ) . '" id="' . esc_attr( $id.'_0' ) . '" value="' . esc_attr( $alpha_values[0] ) . '" class="cea-alpha-color" />
						<input class="cea-color-picker cea-alpha-color-picker" id="' . esc_attr( $id.'_0' ) . '" name="' . esc_attr( $name.'_1' ) . '" value="' . esc_attr( $alpha_values[1] ) . '" type="text" size="10" />
						<input type="range" min="1" max="10" step="1" value="3" class="alpha-range">';
				$output .= '<input type="hidden" name="' . esc_attr( $name ) . '" value="cea_alpha_color" /><br />' . $desc;
			$output .= '</div>';
		break;
		
		case 'url':
			$output .= '<input type="' . $type . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . esc_url( $meta ) . '" class="regular-text" size="30" />
					<br />' . $desc;
		break;
		case 'rating':
			$output .= '<ul class="cea-meta-rating star-rating">
							<li><span class="dashicons dashicons-minus"></span></li>
							<li><span class="dashicons dashicons-star-empty"></span></li>
							<li><span class="dashicons dashicons-star-empty"></span></li>
							<li><span class="dashicons dashicons-star-empty"></span></li>
							<li><span class="dashicons dashicons-star-empty"></span></li>
							<li><span class="dashicons dashicons-star-empty"></span></li>
						</ul>
						<input type="hidden" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . absint( $meta ) . '" class="cea-meta-rating-value" />
					<br />' . $desc;
		break;
		case 'number':
			$output .= '<input type="' . $type . '" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . intval( $meta ) . '" class="regular-text" size="30" />
					<br />' . $desc;
		break;
		// textarea
		case 'textarea':
			$output .= '<textarea name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" cols="60" rows="4">' . esc_textarea( $meta ) . '</textarea>
					<br />' . $desc;
		break;
		// editor
		case 'editor':
			$output .= wp_editor( $meta, $id, $settings ) . '<br />' . $desc;
		break;
		// checkbox
		case 'checkbox':
			$output .= '<input type="checkbox" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" ' . checked( $meta, true, false ) . ' value="1" />
					<label for="' . esc_attr( $id ) . '">' . $desc . '</label>';
		break;
		// select, chosen
		case 'select':
			$meta = isset( $meta ) && $meta != '' ? $meta : $default;
			$output .= '<select name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '"' . ( isset( $multiple ) && $multiple == true ? ' multiple="multiple"' : '' ) . '>';
			foreach ( $options as $value => $label )
				$output .= '<option' . selected( $meta, $value, false ) . ' value="' . esc_attr( $value ) . '">' . esc_html( $label ) . '</option>';
			$output .= '</select><br />' . $desc;
		break;
		// radio
		case 'radio':
			$output .= '<ul class="meta_box_items">';
			foreach ( $options as $option )
				$output .= '<li><input type="radio" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '-' . $option['value'] . '" value="' . $option['value'] . '" ' . checked( $meta, $option['value'], false ) . ' />
						<label for="' . esc_attr( $id ) . '-' . $option['value'] . '">' . $option['label'] . '</label></li>';
			$output .= '</ul>' . $desc;
		break;
		// checkbox_group
		case 'checkbox_group':
			$output .= '<ul class="meta_box_items">';
			foreach ( $options as $option )
				$output .= '<li><input type="checkbox" value="' . $option['value'] . '" name="' . esc_attr( $name ) . '[]" id="' . esc_attr( $id ) . '-' . $option['value'] . '"' . ( is_array( $meta ) && in_array( $option['value'], $meta ) ? ' checked="checked"' : '' ) . ' /> 
						<label for="' . esc_attr( $id ) . '-' . $option['value'] . '">' . $option['label'] . '</label></li>';
			$output .= '</ul>' . $desc;
		break;
		// color
		case 'color':
			$output .= '<input type="text" name="' . esc_attr( $name ) . '" class="cea-color-picker" id="' . esc_attr( $id ) . '" value="' . esc_attr( $meta ) . '" size="10"  />';
		break;
		// post_select, post_chosen
		case 'post_select':
		case 'post_list':
		case 'post_chosen':
			$output .= '<select data-placeholder="Select One" name="' . esc_attr( $name ) . '[]" id="' . esc_attr( $id ) . '"' . ( $type == 'post_chosen' ? ' class="chosen"' : '' ) . ( isset( $multiple ) && $multiple == true ? ' multiple="multiple"' : '' ) . '>
					<option value=""></option>'; // Select One
			$posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'name', 'order' => 'ASC' ) );
			foreach ( $posts as $item )
				$output .= '<option value="' . $item->ID . '"' . selected( is_array( $meta ) && in_array( $item->ID, $meta ), true, false ) . '>' . $item->post_title . '</option>';
			$post_type_object = get_post_type_object( $post_type );
			//$output .= '</select> &nbsp;<span class="description"><a href="' . admin_url( 'edit.php?post_type=' . $post_type . '">Manage ' . $post_type_object->label ) . '</a></span><br />' . $desc;
		break;
		// post_checkboxes
		case 'post_checkboxes':
			$posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1 ) );
			$output .= '<ul class="meta_box_items">';
			foreach ( $posts as $item ) 
				$output .= '<li><input type="checkbox" value="' . $item->ID . '" name="' . esc_attr( $name ) . '[]" id="' . esc_attr( $id ) . '-' . $item->ID . '"' . ( is_array( $meta ) && in_array( $item->ID, $meta ) ? ' checked="checked"' : '' ) . ' />
						<label for="' . esc_attr( $id ) . '-' . $item->ID . '">' . $item->post_title . '</label></li>';
			$post_type_object = get_post_type_object( $post_type );
			$output .= '</ul> ' . $desc . ' &nbsp;<span class="description"><a href="' . admin_url( 'edit.php?post_type=' . $post_type . '">Manage ' . $post_type_object->label ) . '</a></span>';
		break;
		// post_drop_sort
		case 'post_drop_sort':
			//areas
			$post_type_object = get_post_type_object( $post_type );
			$output .= '<p>' . $desc . ' &nbsp;<span class="description"><a href="' . admin_url( 'edit.php?post_type=' . $post_type . '">Manage ' . $post_type_object->label ) . '</a></span></p><div class="post_drop_sort_areas">';
			foreach ( $areas as $area ) {
				$output .= '<ul id="area-' . $area['id']  . '" class="sort_list">
						<li class="post_drop_sort_area_name">' . $area['label'] . '</li>';
						if ( is_array( $meta ) ) {
							$items = explode( ',', $meta[$area['id']] );
							foreach ( $items as $item ) {
								$output = $display == 'thumbnail' ? get_the_post_thumbnail( $item, array( 204, 30 ) ) : get_the_title( $item ); 
								$output .= '<li id="' . $item . '">' . $output . '</li>';
							}
						}
				$output .= '</ul>
					<input type="hidden" name="' . esc_attr( $name ) . '[' . $area['id'] . ']" 
					class="store-area-' . $area['id'] . '" 
					value="' . ( $meta ? $meta[$area['id']] : '' ) . '" />';
			}
			$output .= '</div>';
			// source
			$exclude = null;
			if ( !empty( $meta ) ) {
				$exclude = implode( ',', $meta ); // because each ID is in a unique key
				$exclude = explode( ',', $exclude ); // put all the ID's back into a single array
			}
			$posts = get_posts( array( 'post_type' => $post_type, 'posts_per_page' => -1, 'post__not_in' => $exclude ) );
			$output .= '<ul class="post_drop_sort_source sort_list">
					<li class="post_drop_sort_area_name">Available ' . $label . '</li>';
			foreach ( $posts as $item ) {
				$output = $display == 'thumbnail' ? get_the_post_thumbnail( $item->ID, array( 204, 30 ) ) : get_the_title( $item->ID ); 
				$output .= '<li id="' . $item->ID . '">' . $output . '</li>';
			}
			$output .= '</ul>';
		break;
		// tax_select
		case 'tax_select':
			$output .= '<select name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '">
					<option value="">Select One</option>'; // Select One
			$terms = get_terms( $id, 'get=all' );
			$post_terms = wp_get_object_terms( get_the_ID(), $id );
			$taxonomy = get_taxonomy( $id );
			$selected = $post_terms ? $taxonomy->hierarchical ? $post_terms[0]->term_id : $post_terms[0]->slug : null;
			foreach ( $terms as $term ) {
				$term_value = $taxonomy->hierarchical ? $term->term_id : $term->slug;
				$output .= '<option value="' . $term_value . '"' . selected( $selected, $term_value, false ) . '>' . $term->name . '</option>'; 
			}
			$output .= '</select> &nbsp;<span class="description"><a href="'.get_bloginfo( 'url' ) . '/wp-admin/edit-tags.php?taxonomy=' . $id . '">Manage ' . $taxonomy->label . '</a></span>
				<br />' . $desc;
		break;
		// tax_checkboxes
		case 'tax_checkboxes':
			$terms = get_terms( $id, 'get=all' );
			$post_terms = wp_get_object_terms( get_the_ID(), $id );
			$taxonomy = get_taxonomy( $id );
			$checked = $post_terms ? $taxonomy->hierarchical ? $post_terms[0]->term_id : $post_terms[0]->slug : null;
			foreach ( $terms as $term ) {
				$term_value = $taxonomy->hierarchical ? $term->term_id : $term->slug;
				$output .= '<input type="checkbox" value="' . $term_value . '" name="' . $id . '[]" id="term-' . $term_value . '"' . checked( $checked, $term_value, false ) . ' /> <label for="term-' . $term_value . '">' . $term->name . '</label><br />';
			}
			$output .= '<span class="description">' . $field['desc'] . ' <a href="'.get_bloginfo( 'url' ) . '/wp-admin/edit-tags.php?taxonomy=' . $id . '&post_type=' . $page . '">Manage ' . $taxonomy->label . '</a></span>';
		break;
		// date
		case 'date':
			$output .= '<input type="text" class="datepicker" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . $meta . '" size="30" />
					<br />' . $desc;
		break;
		// slider
		case 'slider':
		$value = $meta != '' ? intval( $meta ) : '0';
			$output .= '<div id="' . esc_attr( $id ) . '-slider"></div>
					<input type="text" name="' . esc_attr( $name ) . '" id="' . esc_attr( $id ) . '" value="' . $value . '" size="5" />
					<br />' . $desc;
		break;
		// image
		case 'image':
			$image = CEA_METABOXES_DIR . '/images/image.png';	
			$output .= '<div class="meta_box_image"><span class="meta_box_default_image" style="display:none">' . $image . '</span>';
			if ( $meta ) {
				$image = wp_get_attachment_image_src( intval( $meta ), 'medium' );
				$image = isset( $image ) && is_array( $image ) ? $image[0] : '';
			}				
			$output .=	'<input name="' . esc_attr( $name ) . '" type="hidden" class="meta_box_upload_image" value="' . intval( $meta ) . '" />
						<img src="' . esc_attr( $image ) . '" class="meta_box_preview_image" alt="" />
							<a href="#" class="meta_box_upload_image_button button" rel="' . get_the_ID() . '">Choose Image</a>
							<small>&nbsp;<a href="#" class="meta_box_clear_image_button">Remove Image</a></small></div>
							<br clear="all" />' . $desc;
		break;
		// file
		case 'file':		
			$iconClass = 'meta_box_file';
			if ( $meta ) $iconClass .= ' checked';
			$output .=	'<div class="meta_box_file_stuff"><input name="' . esc_attr( $name ) . '" type="hidden" class="meta_box_upload_file" value="' . esc_url( $meta ) . '" />
						<span class="' . $iconClass . '"></span>
						<span class="meta_box_filename">' . esc_url( $meta ) . '</span>
							<a href="#" class="meta_box_upload_image_button button" rel="' . get_the_ID() . '">Choose File</a>
							<small>&nbsp;<a href="#" class="meta_box_clear_file_button">Remove File</a></small></div>
							<br clear="all" />' . $desc;
		break;
		// repeatable
		case 'repeatable':
			$output .= '<table id="' . esc_attr( $id ) . '-repeatable" class="meta_box_repeatable" cellspacing="0">
				<thead>
					<tr>
						<th><span class="sort_label"></span></th>
						<th>Fields</th>
						<th><a class="meta_box_repeatable_add" href="#"></a></th>
					</tr>
				</thead>
				<tbody>';
			$i = 0;
			// create an empty array
			if ( $meta == '' || $meta == array() ) {
				$keys = wp_list_pluck( $repeatable_fields, 'id' );
				$meta = array ( array_fill_keys( $keys, null ) );
			}
			$meta = array_values( $meta );
			foreach( $meta as $row ) {
				$output .= '<tr>
						<td><span class="sort hndle"></span></td><td>';
				foreach ( $repeatable_fields as $repeatable_field ) {
					if ( ! array_key_exists( $repeatable_field['id'], $meta[$i] ) )
						$meta[$i][$repeatable_field['id']] = null;
					$output .= '<label>' . $repeatable_field['label']  . '</label><p>';
					$output .= cea_meta_box_field( $repeatable_field, $meta[$i][$repeatable_field['id']], array( $id, $i ) );
					$output .= '</p>';
				} // end each field
				$output .= '</td><td><a class="meta_box_repeatable_remove" href="#"></a></td></tr>';
				$i++;
			} // end each row
			$output .= '</tbody>';
			$output .= '
				<tfoot>
					<tr>
						<th><span class="sort_label"></span></th>
						<th>Fields</th>
						<th><a class="meta_box_repeatable_add" href="#"></a></th>
					</tr>
				</tfoot>';
			$output .= '</table>
				' . $desc;
		break;
		
		case 'gallery':
			$output .= '<div class="field-upload fields">
							<input type="hidden" name="' . esc_attr( $name ) . '" class="zozo_gallery" value="'. esc_attr( $meta ) .'" />
							<div class="zozo_gallery_images">';

								if( $meta ){
									$images = explode( ',', $meta );
									foreach( $images as $image ) {
										$output .= '<div class="zozo_gal_container" id="zozogal-'. esc_attr( $image ) .'"><img src="'. wp_get_attachment_url($image) .'" alt="'.  esc_html( $image ) .'" style="height:100px; width:100px;" /><span class="fa fa-times delgal-img" data-imgid="'. esc_attr( $image ) .'"></span></div>';
									}
								}
								$output .= '<div class="meta_upload_button" type="button">
												<span class="dashicons dashicons-plus"></span>
											</div>';
				$output .= '</div>';
				
			$output .= '</div>';
		break;

		case 'dragdrop':
		
			$t_meta_key = cea_meta_box_unique_key();
			$meta = isset( $meta ) && $meta != '' ? $meta : $default;
			$post_enabled_items = $meta != '' ? explode(',', $meta ) : array();
			$post_disabled_items = array_diff( $options['all'], $post_enabled_items );
			
			$post_enabled_out = $post_disabled_out = '';
			$post_enabled_out = $post_enabled_items != '' ? cea_post_option_drag_drop( $post_enabled_items, $options['items'], 'enabled' ) : '';
			$post_disabled_out =  $post_disabled_items != '' ? cea_post_option_drag_drop( $post_disabled_items, $options['items'], 'disabled' ) : '';
			
			$output .= '<div class="meta-drag-drop-field" data-field="'. $t_meta_key .'">';
				$output .= '<h4>'. esc_html__( 'Enabled Items', 'classic-elementor-addons-pro' ) .'</h4>';
				$output .= $post_enabled_out;
				$output .= '<h4>'. esc_html__( 'Disabled Items', 'classic-elementor-addons-pro' ) .'</h4>';
				$output .= $post_disabled_out;
				$output .= '<input id="' . esc_attr( $id ) . '" class="meta-drag-drop-value" name="' . esc_attr( $name ) . '" value="' . esc_attr( $meta ) . '" type="hidden">';
			$output .= '</div>'. $desc;
		break;
		
		case 'dragdrop_multi':

			$dd_fields = isset( $meta ) && $meta != '' ? $meta : $dd_fields;

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
				$t_part_array[$key] = $value != '' ? cea_post_option_drag_drop_multi( $key, $value ) : '';
			}

			$output .= '<div class="meta-drag-drop-multi-field">';
			foreach( $t_part_array as $key => $value ){
					$output .= '<h4>'. esc_html( $key ) .'</h4>';
					$output .= $value;
			}
			$output .= '<input id="' . esc_attr( $id ) . '" class="meta-drag-drop-multi-value" name="' . esc_attr( $name ) . '" value="" data-params="'. htmlspecialchars( $meta, ENT_QUOTES, 'UTF-8' ) .'" type="hidden">';
			$output .= '</div>'. $desc;

		break;
		
		case 'image_select':
			
			$selected = isset( $meta ) && $meta != '' ? $meta : $default;
			$output .= cea_post_option_image_select( $name, $options, $selected, $label );
			
		break;
		
		case 'sidebar':
			
			$selected = isset( $meta ) && $meta != '' ? $meta : $default;
			$output .= cea_post_option_get_sidebars( $name, $selected);
			
		break;
		
		//
		
	} //end switch
	
	return $output;
		
}


/**
 * Finds any item in any level of an array
 * 
 * @param	string	$needle 	field type to look for
 * @param	array	$haystack	an array to search the type in
 *
 * @return	bool				whether or not the type is in the provided array
 */
function cea_meta_box_find_field_type( $needle, $haystack ) {
	foreach ( $haystack as $h )
		if ( isset( $h['type'] ) && $h['type'] == 'repeatable' )
			return cea_meta_box_find_field_type( $needle, $h['repeatable_fields'] );
		elseif ( ( isset( $h['type'] ) && $h['type'] == $needle ) || ( isset( $h['repeatable_type'] ) && $h['repeatable_type'] == $needle ) )
			return true;
	return false;
}

/**
 * Find repeatable
 *
 * This function does almost the same exact thing that the above function 
 * does, except we're exclusively looking for the repeatable field. The 
 * reason is that we need a way to look for other fields nested within a 
 * repeatable, but also need a way to stop at repeatable being true. 
 * Hopefully I'll find a better way to do this later.
 *
 * @param	string	$needle 	field type to look for
 * @param	array	$haystack	an array to search the type in
 *
 * @return	bool				whether or not the type is in the provided array
 */
function cea_meta_box_find_repeatable( $needle = 'repeatable', $haystack = '') {
	foreach ( $haystack as $h )
		if ( isset( $h['type'] ) && $h['type'] == $needle )
			return true;
	return false;
}

/**
 * sanitize boolean inputs
 */
function cea_meta_box_santitize_boolean( $string ) {
	if ( ! isset( $string ) || $string != 1 || $string != true )
		return false;
	else
		return true;
}

/**
 * outputs properly sanitized data
 *
 * @param	string	$string		the string to run through a validation function
 * @param	string	$function	the validation function
 * 
 * @return						a validated string
 */
function cea_meta_box_sanitize( $string, $function = 'sanitize_text_field' ) {
	switch ( $function ) {
		case 'intval':
			return intval( $string );
		case 'absint':
			return absint( $string );
		case 'wp_kses_post':
			return wp_kses_post( $string );
		case 'wp_kses_data':
			return wp_kses_data( $string );
		case 'esc_url_raw':
			return esc_url_raw( $string );
		case 'is_email':
			return is_email( $string );
		case 'sanitize_title':
			return sanitize_title( $string );
		case 'santitize_boolean':
			return santitize_boolean( $string );
		case 'sanitize_text_field':
		default:
			return sanitize_text_field( $string );
	}
}

/**
 * Map a multideminsional array
 *
 * @param	string	$func		the function to map
 * @param	array	$meta		a multidimensional array
 * @param	array	$sanitizer	a matching multidimensional array of sanitizers
 *
 * @return	array				new array, fully mapped with the provided arrays
 */
function cea_meta_box_array_map_r( $func, $meta, $sanitizer ) {
		
	$newMeta = array();
	$meta = array_values( $meta );
	
	foreach( $meta as $key => $array ) {
		if ( $array == '' )
			continue;
		/**
		 * some values are stored as array, we only want multidimensional ones
		 */
		if ( ! is_array( $array ) ) {
			return array_map( $func, $meta, (array)$sanitizer );
			break;
		}
		/**
		 * the sanitizer will have all of the fields, but the item may only 
		 * have valeus for a few, remove the ones we don't have from the santizer
		 */
		$keys = array_keys( $array );
		$newSanitizer = $sanitizer;
		if ( is_array( $sanitizer ) ) {
			foreach( $newSanitizer as $sanitizerKey => $value )
				if ( ! in_array( $sanitizerKey, $keys ) )
					unset( $newSanitizer[$sanitizerKey] );
		}
		/**
		 * run the function as deep as the array goes
		 */
		foreach( $array as $arrayKey => $arrayValue )
			if ( is_array( $arrayValue ) )
				$array[$arrayKey] = cea_meta_box_array_map_r( $func, $arrayValue, $newSanitizer[$arrayKey] );
		
		$array = array_map( $func, $array, $newSanitizer );
		$newMeta[$key] = array_combine( $keys, array_values( $array ) );
	}
	return $newMeta;
}

/**
 * takes in a few peices of data and creates a custom meta box
 *
 * @param	string			$id			meta box id
 * @param	string			$title		title
 * @param	array			$fields		array of each field the box should include
 * @param	string|array	$page		post type to add meta box to
 */
class CEA_Custom_Add_Meta_Box {
	
	var $id;
	var $title;
	var $fields;
	var $page;
	
    public function __construct( $id, $title, $fields, $page ) {
		$this->id = $id;
		$this->title = $title;
		$this->fields = $fields;
		$this->page = $page;
		
		if( ! is_array( $this->page ) )
			$this->page = array( $this->page );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_head',  array( $this, 'admin_head' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_box' ) );
		add_action( 'save_post',  array( $this, 'save_box' ));
    }
	
	/**
	 * enqueue necessary scripts and styles
	 */
	function admin_enqueue_scripts() {
		global $pagenow;
		if ( in_array( $pagenow, array( 'post-new.php', 'post.php' ) ) && in_array( get_post_type(), $this->page ) ) {
			// js
			$deps = array( 'jquery' );
			if ( cea_meta_box_find_field_type( 'date', $this->fields ) )
				$deps[] = 'jquery-ui-datepicker';
			if ( cea_meta_box_find_field_type( 'slider', $this->fields ) )
				$deps[] = 'jquery-ui-slider';
			if ( cea_meta_box_find_field_type( 'color', $this->fields ) 
					|| cea_meta_box_find_field_type( 'link_color', $this->fields )
					|| cea_meta_box_find_field_type( 'alpha_color', $this->fields ) ){
					
				$deps[] = 'farbtastic';
				if( is_admin() ) { 
					wp_enqueue_style( 'wp-color-picker' );      
					wp_enqueue_script( 'wp-color-picker' ); 
				}
			}
			if ( cea_meta_box_find_field_type( 'alpha_color', $this->fields ) ){
				wp_enqueue_style( 'rangeslider', CEA_METABOXES_DIR . '/css/rangeslider.css', array(), '1.0' );
				wp_enqueue_script( 'jquery-rangeslider', CEA_METABOXES_DIR . '/js/rangeslider.min.js', array( 'jquery' ), '1.0', true );
			}
			

			wp_enqueue_script( 'meta_box', CEA_METABOXES_DIR . '/js/scripts.js', $deps );
			
			// css
			$deps = array();
			wp_register_style( 'jqueryui', CEA_METABOXES_DIR . '/css/jqueryui.css' );
			if ( cea_meta_box_find_field_type( 'date', $this->fields ) || cea_meta_box_find_field_type( 'slider', $this->fields ) )
				$deps[] = 'jqueryui';
			if ( cea_meta_box_find_field_type( 'color', $this->fields ) )
				$deps[] = 'farbtastic';
			wp_enqueue_style( 'meta_box', CEA_METABOXES_DIR . '/css/meta_box.css', $deps );
		}
	}
	
	/**
	 * adds scripts to the head for special fields with extra js requirements
	 */
	function admin_head() {
		if ( in_array( get_post_type(), $this->page ) && ( cea_meta_box_find_field_type( 'date', $this->fields ) || cea_meta_box_find_field_type( 'slider', $this->fields ) ) ) {
		
			echo '<script type="text/javascript">
						jQuery(function( $) {';
			
			foreach ( $this->fields as $field ) {
				switch( $field['type'] ) {
					// date
					case 'date' :
						echo 'if( $(".datepicker").length ){
								$("#' . $field['id'] . '").datepicker({
									dateFormat: \'yy-mm-dd\'
								});
							}';
					break;
					// slider
					case 'slider' :
					$value = get_post_meta( get_the_ID(), $field['id'], true );
					if ( $value == '' )
						$value = $field['min'];
					echo '
							$( "#' . $field['id'] . '-slider" ).slider({
								value: ' . $value . ',
								min: ' . $field['min'] . ',
								max: ' . $field['max'] . ',
								step: ' . $field['step'] . ',
								slide: function( event, ui ) {
									$( "#' . $field['id'] . '" ).val( ui.value );
								}
							});';
					break;
				}
			}
			
			echo '});
				</script>';
		
		}
	}
	
	/**
	 * adds the meta box for every post type in $page
	 */
	function add_box() {
		foreach ( $this->page as $page ) {
			add_meta_box( $this->id, $this->title, array( $this, 'meta_box_callback' ), $page, 'normal', 'high' );
		}
	}
	
	/**
	 * outputs the meta box
	 */
	function meta_box_callback() {
		// Use nonce for verification
		wp_nonce_field( 'cea_meta_box_nonce_action', 'cea_meta_box_nonce_field' );
		
		// Begin the field table and loop
		
		$tab_array = $meta_output = array();

		foreach ( $this->fields as $field ) {
			$tab = isset( $field['tab'] ) ? $field['tab'] : '';
			$meta_output[$tab] = isset( $meta_output[$tab] ) ? $meta_output[$tab] : '';
			if( isset( $field['required'] ) )
				$meta_output[$tab] .= '<tr class="meta-req" data-req="'. $field['required'][0] .'" data-equal="'. $field['required'][1] .'">';
			else
				$meta_output[$tab] .= '<tr>';
				
				if( $field['type'] != 'label' && $field['type'] != 'line' ){
					$meta_output[$tab] .= '<th style="width:20%"><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>';
					$meta_output[$tab] .= '<td>';
					
					$meta = get_post_meta( get_the_ID(), $field['id'], true);
					if ( !array_key_exists( $tab, $tab_array ) ){
						array_push( $tab_array, $tab );
					}
								
					$meta_output[$tab] .= cea_meta_box_field( $field, $meta  );
					
					$meta_output[$tab] .= '<td>';
				}elseif( $field['type'] == 'line' ){
					$meta_output[$tab] .= '<th colspan="2"><hr /></th>';
				}else{
					$meta_output[$tab] .= '<th colspan="2"><p class="meta-label">' . $field['label'] . '</p><p class="meta-description">' . $field['desc'] . '</p></th>';
				}
			$meta_output[$tab] .= '</tr>';

		} // end foreach
		
	
		$i = 0;
		$tab_list = $tab_content = '';
		foreach($meta_output as $key => $value){
			$tab_id = sanitize_title($key);
			$tab_list .= '<li class="'. ( $i == 0 ? 'current' : '' ) .'"><a href="#cea-admin-tab-'. esc_attr( $tab_id ) .'">'. esc_html( $key ) .'</a></li>';
			$tab_content .= '<div id="cea-admin-tab-'. esc_attr( $tab_id ) .'" class="cea-admin-tab-content'. ( $i == 0 ? ' current' : '' ) .'">';
				 $tab_content .= '<table class="form-table meta_box">'. $value . '</table>';
			$tab_content .= '</div>'; // end table
			
			if( $i == 0 ) $i =1;
		}
		
		echo '
		<div id="cea-admin-tabs-container">
			<ul class="cea-admin-tabs-menu">
				'. $tab_list .'
			</ul>
			<div class="cea-admin-tab">
				'. $tab_content .'
			</div>
		</div>';
	}
	
	/**
	 * saves the captured data
	 */
	function save_box( $post_id ) {
		$post_type = get_post_type();
		
		// verify nonce
		if ( ! isset( $_POST['cea_meta_box_nonce_field'] ) )
			return $post_id;
		if ( ! ( in_array( $post_type, $this->page ) || wp_verify_nonce( $_POST['cea_meta_box_nonce_field'],  'cea_meta_box_nonce_action' ) ) ) 
			return $post_id;
		// check autosave
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		// check permissions
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		
		// loop through fields and save the data
		foreach ($this->fields as $field) {
			if ($field['type'] == 'section' || $field['type'] == 'container') {
				$sanitizer = null;
				continue;
			}
			if( in_array( $field['type'], array( 'tax_select', 'tax_checkboxes' ) ) ) {
				// save taxonomies
				if ( isset( $_POST[$field['id']] ) ) {
					$term = $_POST[$field['id']];
					wp_set_object_terms( $post_id, $term, $field['id'] );
				}
			}
			elseif( $field['type'] != 'label' && $field['type'] != 'line' ) {
				// save the rest
				$new = false;
				$old = get_post_meta( $post_id, $field['id'], true );
				if ( isset( $_POST[$field['id']] ) ){
					$new = '';
					if( $field['type'] == 'space' ){
						$new = array( '0' => $_POST[$field['id'] . '_0'], '1' => $_POST[$field['id'] . '_1'], '2' => $_POST[$field['id'] . '_2'], '3' => $_POST[$field['id'] . '_3'], '4' => $_POST[$field['id'] . '_4'], '5' => $_POST[$field['id'] . '_5'], '6' => $_POST[$field['id'] . '_6'] );
					}elseif( $field['type'] == 'dimension' ){
						$new = array( '0' => $_POST[$field['id'] . '_0'], '1' => $_POST[$field['id'] . '_1'] );
					}elseif( $field['type'] == 'link_color' ){
						$new = array( '0' => $_POST[$field['id'] . '_0'], '1' => $_POST[$field['id'] . '_1'], '2' => $_POST[$field['id'] . '_2'] );
					}elseif( $field['type'] == 'alpha_color' ){
						$new = array( '0' => $_POST[$field['id'] . '_0'], '1' => $_POST[$field['id'] . '_1'] );
					}else{
						$new = $_POST[$field['id']];
					}
				}
				if ( isset( $new ) && '' == $new && $old ) {
					delete_post_meta( $post_id, $field['id'], $old );
				} elseif ( isset( $new ) && $new != $old ) {
					$sanitizer = isset( $field['sanitizer'] ) ? $field['sanitizer'] : 'sanitize_text_field';
					if ( is_array( $new ) )
						$new = cea_meta_box_array_map_r( 'cea_meta_box_sanitize', $new, $sanitizer );
					else
						$new = cea_meta_box_sanitize( $new, $sanitizer );
					if( $field['type'] == 'dragdrop_multi' ){
						update_post_meta( $post_id, $field['id'], addslashes( $new ) );
					}else{
						update_post_meta( $post_id, $field['id'], $new );
					}
				}
			}
		} // end foreach
	}
}