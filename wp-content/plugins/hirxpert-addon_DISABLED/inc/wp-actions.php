<?php

class Hirxpert_Wp_Actions {

	private static $_instance = null;

	public function __construct() {
		
		//Google fonts
		add_action( 'wp_head', array( $this, 'hirxpert_google_fonts_con' ), 10 );

		//Theme front scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'hirxpert_front_scripts' ), 10 );

		//body class
		add_filter( 'body_class', array( $this, 'hirxpert_custom_class' ), 99 );

	}

	public static function hirxpert_google_fonts_con(){

		$g_arr = get_option( 'hirxpert_google_fonts_list' );
		
		if( !empty( $g_arr ) ){
		
			$g_fonts = array();
			$g_arr_len = count( $g_arr );
			$i = 0;
			$sub_sets = array();
			$sub_str = '';
			foreach( $g_arr as $family => $weght_sub ){
				$i++;
				$weight = isset( $weght_sub['weight'] ) && !empty( $weght_sub['weight'] ) ? implode( ",", array_unique( $weght_sub['weight'] ) ) : '';
				$subset = isset( $weght_sub['subset'] ) && !empty( $weght_sub['subset'] ) ? $weght_sub['subset'] : '';
				$sub_sets = array_merge( $sub_sets, $subset );
				$font_attr = !empty( $weight ) ? $weight : $weight;
				if( $g_arr_len == $i && !empty( $sub_sets ) ){
					$sub_sets = implode( ",", array_unique( $sub_sets ) );
					$font_attr = $font_attr . '&amp;subset='. $sub_sets;
				}
				$g_fonts[] = urlencode_deep( $family ) .':'. $font_attr;
			}
			$web_font_arr = str_replace( '"', "'", json_encode( $g_fonts ) );
			 ?>
			<script>
				/* You can add more configuration options to webfontloader by previously defining the WebFontConfig with your options */
				if ( typeof WebFontConfig === "undefined" ) {
					WebFontConfig = new Object();
				}
				WebFontConfig['google'] = {families: <?php echo str_replace( "', ", "',", $web_font_arr ); ?>};
		
				(function() {
					var wf = document.createElement( 'script' );
					wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.5.3/webfont.js';
					wf.type = 'text/javascript';
					wf.async = 'true';
					var s = document.getElementsByTagName( 'script' )[0];
					s.parentNode.insertBefore( wf, s );
				})();
			</script>
			<?php
		}//google font exists
	}

	function hirxpert_front_scripts(){
		//Register font awesome styles
		wp_register_style( 'font-awesome', HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/css/font-awesome.min.css', array(), '4.7.0', 'all' );
	}

	function hirxpert_custom_class( $classes ) {
		$hirxpert_options = get_option( 'hirxpert_options' ); 
		$rtl = isset( $hirxpert_options['rtl'] ) ? $hirxpert_options['rtl'] : false;
		if( $rtl ) {
			$classes[] = 'rtl';
		}
		
		$field = 'page_loader';
		$img_arr = array(
			'id' => null,
			'url' => null
		);
		$image = isset( $hirxpert_options[$field] ) && isset( $hirxpert_options[$field]['image'] ) ? $hirxpert_options[$field]['image'] : '';
		if( !empty( $image ) ){
			$img_arr['id'] = isset( $image['id'] ) ? $image['id'] : null;
			$img_arr['url'] = isset( $image['url'] ) ? $image['url'] : null;
		}
		if( $img_arr['id'] != null ){
			$classes[] = 'initiate';
		}else{
			$classes[] = 'page-load-initiate';
		}
		
		return $classes;
	}

	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}
Hirxpert_Wp_Actions::get_instance();