<?php
class Hirxpert_Theme_Styles {
   
   	public $hirxpert_options;
	private $exists_fonts = array();
	public static $hirxpert_gf_array = array();
   
    function __construct() {
		$this->hirxpert_options = get_option( 'hirxpert_options' );
    }

	function hirxpert_get_option($field){
		$hirxpert_options = $this->hirxpert_options;
		return isset( $hirxpert_options[$field] ) && $hirxpert_options[$field] != '' ? $hirxpert_options[$field] : '';
	}
	
	function hirxpert_dimension_settings($field, $property = 'width'){
		$hirxpert_options = $this->hirxpert_options;
		$units = 'px'; $dimension = '';
		if( isset( $hirxpert_options[$field] ) ){
			$units = isset( $hirxpert_options[$field]['units'] ) ? $hirxpert_options[$field]['units'] : $units;
			$dimension = isset( $hirxpert_options[$field][$property] ) && $hirxpert_options[$field][$property] != '' ? absint( $hirxpert_options[$field][$property] ) . $units : '';
		}
		return $dimension;
	}

	function hirxpert_image_settings($field){
		$hirxpert_options = $this->hirxpert_options;
		$img_arr = array(
			'id' => null,
			'url' => null
		);
		$image = isset( $hirxpert_options[$field] ) && isset( $hirxpert_options[$field]['image'] ) ? $hirxpert_options[$field]['image'] : '';
		if( !empty( $image ) ){
			$img_arr['id'] = isset( $image['id'] ) ? $image['id'] : null;
			$img_arr['url'] = isset( $image['url'] ) ? $image['url'] : null;
		}
		return $img_arr;
	}
	
	function hirxpert_border_settings($field, $class_names = null){
		$hirxpert_options = $this->hirxpert_options;

		if( isset( $hirxpert_options[$field] ) ):

			$stat = false;
			$position = array( 'top', 'right', 'bottom', 'left' );
			foreach( $position as $key ){
				if( isset( $hirxpert_options[$field][$key] ) && $hirxpert_options[$field][$key] != NULL && !$stat ) $stat = true;
			}
		
			$boder_style = isset( $hirxpert_options[$field]['style'] ) && $hirxpert_options[$field]['style'] != '' ? $hirxpert_options[$field]['style'] : '';
			$border_color = isset( $hirxpert_options[$field]['color'] ) && $hirxpert_options[$field]['color'] != '' ? $hirxpert_options[$field]['color'] : '';

			if( $class_names && $stat ) echo $class_names . ' {';
			
			if( isset( $hirxpert_options[$field]['top'] ) && $hirxpert_options[$field]['top'] != NULL ):
				echo 'border-top-width: '. $hirxpert_options[$field]['top'] .'px;';
				if( $boder_style ) echo 'border-top-style: '. $boder_style .';';
				if( $border_color ) echo 'border-top-color: '. $border_color .';';
			endif;
			
			if( isset( $hirxpert_options[$field]['right'] ) && $hirxpert_options[$field]['right'] != NULL ):
				echo 'border-right-width: '. $hirxpert_options[$field]['right'] .'px;';
				if( $boder_style ) echo 'border-right-style: '. $boder_style .';';
				if( $border_color ) echo 'border-right-color: '. $border_color .';';
			endif;
			
			if( isset( $hirxpert_options[$field]['bottom'] ) && $hirxpert_options[$field]['bottom'] != NULL ):
				echo 'border-bottom-width: '. $hirxpert_options[$field]['bottom'] .'px;';
				if( $boder_style ) echo 'border-bottom-style: '. $boder_style .';';
				if( $border_color ) echo 'border-bottom-color: '. $border_color .';';
			endif;
			
			if( isset( $hirxpert_options[$field]['left'] ) && $hirxpert_options[$field]['left'] != NULL ):
				echo 'border-left-width: '. $hirxpert_options[$field]['left'] .'px;';
				if( $boder_style ) echo 'border-left-style: '. $boder_style .';';
				if( $border_color ) echo 'border-left-color: '. $border_color .';';
			endif;

			if( $class_names && $stat ) echo '}';
			
		endif;
	}
	
	function hirxpert_padding_settings($field, $class_names = null){
		$hirxpert_options = $this->hirxpert_options;
		$stat = false;
		$position = array( 'top', 'right', 'bottom', 'left' );
		foreach( $position as $key ){
			if( isset( $hirxpert_options[$field][$key] ) && $hirxpert_options[$field][$key] != NULL && !$stat ) $stat = true;
		}
		if( isset( $hirxpert_options[$field] ) ):
			if( $class_names && $stat ) echo $class_names . ' {';	
			echo isset( $hirxpert_options[$field]['top'] ) && $hirxpert_options[$field]['top'] != NULL ? 'padding-top: '. $hirxpert_options[$field]['top'] .'px;' : '';
			echo isset( $hirxpert_options[$field]['right'] ) && $hirxpert_options[$field]['right'] != NULL ? 'padding-right: '. $hirxpert_options[$field]['right'] .'px;' : '';
			echo isset( $hirxpert_options[$field]['bottom'] ) && $hirxpert_options[$field]['bottom'] != NULL ? 'padding-bottom: '. $hirxpert_options[$field]['bottom'] .'px;' : '';
			echo isset( $hirxpert_options[$field]['left'] ) && $hirxpert_options[$field]['left'] != NULL ? 'padding-left: '. $hirxpert_options[$field]['left'] .'px;' : '';
			if( $class_names && $stat ) echo '}';
		endif;
	}
	
	function hirxpert_margin_settings($field, $class_names = null){
		$hirxpert_options = $this->hirxpert_options;
		$stat = false;
		$position = array( 'top', 'right', 'bottom', 'left' );
		foreach( $position as $key ){
			if( isset( $hirxpert_options[$field][$key] ) && $hirxpert_options[$field][$key] != NULL && !$stat ) $stat = true;
		}
		if( isset( $hirxpert_options[$field] ) ):	
			if( $class_names && $stat ) echo $class_names . ' {';	
			echo isset( $hirxpert_options[$field]['top'] ) && $hirxpert_options[$field]['top'] != NULL ? 'margin-top: '. $hirxpert_options[$field]['top'] .'px;' : '';
			echo isset( $hirxpert_options[$field]['right'] ) && $hirxpert_options[$field]['right'] != NULL ? 'margin-right: '. $hirxpert_options[$field]['right'] .'px;' : '';
			echo isset( $hirxpert_options[$field]['bottom'] ) && $hirxpert_options[$field]['bottom'] != NULL ? 'margin-bottom: '. $hirxpert_options[$field]['bottom'] .'px;' : '';
			echo isset( $hirxpert_options[$field]['left'] ) && $hirxpert_options[$field]['left'] != NULL ? 'margin-left: '. $hirxpert_options[$field]['left'] .'px;' : '';
			if( $class_names && $stat ) echo '}';
		endif;
	}

	function hirxpert_color($field, $class_names = null){
		$hirxpert_options = $this->hirxpert_options;
		if( isset( $hirxpert_options[$field] ) && $hirxpert_options[$field] != '' ) {
			if( $class_names ) echo $class_names . '{';
			echo 'color: '. $hirxpert_options[$field] .';';
			if( $class_names ) echo '}';
		}
	}
	
	function hirxpert_link_color($field, $fun, $class_names = null){
		$hirxpert_options = $this->hirxpert_options;
		if( isset( $hirxpert_options[$field][$fun] ) && $hirxpert_options[$field][$fun] != '' ) {
			if( $class_names ) echo $class_names . '{';
			echo 'color: '. $hirxpert_options[$field][$fun] .';';
			if( $class_names ) echo '}';
		}
	}
	
	function hirxpert_button_color($field, $fun, $class_names = null){
		$hirxpert_options = $this->hirxpert_options;
		if( isset( $hirxpert_options[$field][$fun] ) && $hirxpert_options[$field][$fun] != '' ) {
			if( $class_names ) echo $class_names . '{';
				switch( $fun ){
					case "hfore":
					case "fore":
						echo 'color: '. $hirxpert_options[$field][$fun] .';';
					break;
					case "hbg":
					case "bg":
						echo 'background-color: '. $hirxpert_options[$field][$fun] .';';
					break;
					case "hborder":
					case "border":
						echo 'border-color: '. $hirxpert_options[$field][$fun] .';';
					break;
				}
			if( $class_names ) echo '}';
		}
	}
		
	function hirxpert_bg_settings($field, $class_names = null){
		$hirxpert_options = $this->hirxpert_options;
		if( isset( $hirxpert_options[$field] ) ):

			$stat = false;
			$keys = array( 'bg_color', 'bg_repeat', 'bg_position', 'bg_size', 'bg_attachment' );
			foreach( $keys as $key ){
				if( isset( $hirxpert_options[$field][$key] ) && !empty( $hirxpert_options[$field][$key] ) && !$stat ) $stat = true;
			}
			if( isset( $hirxpert_options[$field]['image']['url'] ) && !empty( $hirxpert_options[$field]['image']['url'] ) && !$stat ) $stat = true;

			if( $class_names && $stat ) echo $class_names . '{';
			echo '
			'. ( isset( $hirxpert_options[$field]['bg_color'] ) && !empty( $hirxpert_options[$field]['bg_color'] ) ?  'background-color: '. $hirxpert_options[$field]['bg_color'] .';' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['image']['url'] ) && !empty( $hirxpert_options[$field]['image']['url'] ) ?  'background-image: url('. $hirxpert_options[$field]['image']['url'] .');' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['bg_repeat'] ) && !empty( $hirxpert_options[$field]['bg_repeat'] ) ?  'background-repeat: '. $hirxpert_options[$field]['bg_repeat'] .';' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['bg_position'] ) && !empty( $hirxpert_options[$field]['bg_position'] ) ?  'background-position: '. $hirxpert_options[$field]['bg_position'] .';' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['bg_size'] ) && !empty( $hirxpert_options[$field]['bg_size'] ) ?  'background-size: '. $hirxpert_options[$field]['bg_size'] .';' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['bg_attachment'] ) && !empty( $hirxpert_options[$field]['bg_attachment'] ) ?  'background-attachment: '. $hirxpert_options[$field]['bg_attachment'] .';' : '' ) .'
			';
			if( $class_names && $stat ) echo '}';
		endif;
	}
	
	function hirxpert_custom_font_face_create( $font_family, $font_slug, $cf_names ){	
		$upload_dir = wp_upload_dir();
		$f_type = array('eot', 'otf', 'svg', 'ttf', 'woff');		
		$font_path = $upload_dir['baseurl'] . '/custom-fonts/' . str_replace( "'", "", $font_family .'/'. $font_slug );
		echo ' @font-face { font-family: '. $font_family .';';
		echo " src: url('". esc_url( $font_path ) .".eot') format('embedded-opentype'), url('". esc_url( $font_path ) .".woff2') format('woff2'), url('". esc_url( $font_path ) .".woff') format('woff'), url('". esc_url( $font_path ) .".ttf')  format('truetype'), url('". esc_url( $font_path ) .".svg') format('svg');}";		
	}
	
	function hirxpert_custom_font_check($field){
		$hirxpert_options = $this->hirxpert_options;
		$cf_names = get_option( 'hirxpert_custom_fonts' );
		$font_family = isset( $hirxpert_options[$field]['font_family'] ) ? $hirxpert_options[$field]['font_family'] : '';
		$font_slug = $font_family ? sanitize_title( $font_family ) : '';
		if ( !empty( $cf_names ) && is_array( $cf_names ) && array_key_exists( $font_slug, $cf_names ) ){	
			if ( !empty( $cf_names ) && !in_array( $font_slug, $this->exists_fonts ) ){
				$this->hirxpert_custom_font_face_create( $font_family, $font_slug, $cf_names );
				array_push( $this->exists_fonts, $hirxpert_options[$field]['font-family'] );
				return 1;
			}
		}
		return 0;
	}
	
	function hirxpert_get_custom_google_font_frame( $font_family ){	
		$family = isset( $font_family['family'] ) ? $font_family['family'] : '';
		$weight = isset( $font_family['weight'] ) ? $font_family['weight'] : '';
		$subset = isset( $font_family['subset'] ) ? $font_family['subset'] : '';		
		if( !empty( $family ) ){
			if( isset( self::$hirxpert_gf_array[$family] ) ){
				array_push( self::$hirxpert_gf_array[$family]['weight'], $weight );
				array_push( self::$hirxpert_gf_array[$family]['subset'], $subset );
			}else{
				self::$hirxpert_gf_array[$family] = array( 'weight' => array( $weight ), 'subset' => array( $subset ) );
			}
		}
	}
	
	function hirxpert_typo_generate($field){
		$hirxpert_options = $this->hirxpert_options;
		$font_family = isset( $hirxpert_options[$field]['font_family'] ) ? $hirxpert_options[$field]['font_family'] : '';
		$standard_fonts = Hirxpert_Google_Fonts_Function::$_standard_fonts;
		if( !array_key_exists( $font_family, $standard_fonts ) ){			
			$font_weight = isset( $hirxpert_options[$field]['font_weight'] ) && $hirxpert_options[$field]['font_weight'] != '' ? $hirxpert_options[$field]['font_weight'] : '';
			$font_sub = isset( $hirxpert_options[$field]['font_sub'] ) && $hirxpert_options[$field]['font_sub'] != '' ? $hirxpert_options[$field]['font_sub'] : '';
			$gf_arr = array( 'family' => $font_family, 'weight' => $font_weight, 'subset' => $font_sub );	
			$this->hirxpert_get_custom_google_font_frame( $gf_arr );
		}
	}
	
	function hirxpert_typo_settings($field, $class_names = null){
		
		//Custom font check and google font generate
		$cf_stat = $this->hirxpert_custom_font_check($field);
		if( !$cf_stat ) $this->hirxpert_typo_generate($field);		
		$hirxpert_options = $this->hirxpert_options;
		if( isset( $hirxpert_options[$field] ) ):

			$stat = false;
			$keys = array( 'font_color', 'font_family', 'font_weight', 'font_style', 'font_size', 'line_height', 'letter_spacing', 'text_align', 'text_transform' );
			foreach( $keys as $key ){
				if( isset( $hirxpert_options[$field][$key] ) && !empty( $hirxpert_options[$field][$key] ) && !$stat ) $stat = true;
			}
			echo $class_names && $stat ? esc_attr( $class_names ) . '{' : '';
			
			$font_weight = isset( $hirxpert_options[$field]['font_weight'] ) ? $hirxpert_options[$field]['font_weight'] : '';
			$font_style = '';
			if( !empty( $font_weight ) && strpos( $font_weight, 'italic' ) ){
				$font_style = 'italic';
				$font_weight = str_replace( 'italic', '', $font_weight );
			}

			echo '
			'. ( isset( $hirxpert_options[$field]['font_color'] ) && $hirxpert_options[$field]['font_color'] != '' ?  'color: '. $hirxpert_options[$field]['font_color'] .';' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['font_family'] ) && $hirxpert_options[$field]['font_family'] != '' ?  'font-family: '. stripslashes_deep( $hirxpert_options[$field]['font_family'] ) .';' : '' ) .'
			'. ( $font_weight ?  'font-weight: '. $font_weight .';' : '' ) .'
			'. ( $font_style ?  'font-style: '. $font_style .';' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['font_size'] ) && $hirxpert_options[$field]['font_size'] != '' ?  'font-size: '. $hirxpert_options[$field]['font_size'] .'px;' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['line_height'] ) && $hirxpert_options[$field]['line_height'] != '' ?  'line-height: '. $hirxpert_options[$field]['line_height'] .'px;' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['letter_spacing'] ) && $hirxpert_options[$field]['letter_spacing'] != '' ?  'letter-spacing: '. $hirxpert_options[$field]['letter_spacing'] .'px;' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['text_align'] ) && $hirxpert_options[$field]['text_align'] != '' ?  'text-align: '. $hirxpert_options[$field]['text_align'] .';' : '' ) .'
			'. ( isset( $hirxpert_options[$field]['text_transform'] ) && $hirxpert_options[$field]['text_transform'] != '' ?  'text-transform: '. $hirxpert_options[$field]['text_transform'] .';' : '' ) .'
			';
		endif;
		echo $class_names && $stat ? '}' : '';
	}
	
	function hirxpert_hex2rgba($color, $opacity = 1) {
	 
		$default = '';
		//Return default if no color provided
		if(empty($color))
			  return $default; 
		//Sanitize $color if "#" is provided 
			if ($color[0] == '#' ) {
				$color = substr( $color, 1 );
			}
			//Check if color has 6 or 3 characters and get values
			if (strlen($color) == 6) {
					$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
			} elseif ( strlen( $color ) == 3 ) {
					$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
			} else {
					return $default;
			}
			//Convert hexadec to rgb
			$rgb =  array_map('hexdec', $hex);
	 
			//Check if opacity is set(rgba or rgb)
			if( $opacity == 'none' ){
				$output = implode(",",$rgb);
			}elseif( $opacity ){
				if(abs($opacity) > 1)
					$opacity = 1.0;
				$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
			}else {
				$output = 'rgb('.implode(",",$rgb).')';
			}
			//Return rgb(a) color string
			return $output;
	}

}