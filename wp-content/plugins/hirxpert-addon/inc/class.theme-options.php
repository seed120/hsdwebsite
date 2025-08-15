<?php 

class Hirxpert_Theme_Option { //hirxpert_admin_menu_out
	
	private static $_instance = null;

	public static $hirxpert_options = null;
		
	public function __construct() {

		//Get theme option
		self::$hirxpert_options = apply_filters( 'hirxpert_options', get_option( 'hirxpert_options' ) );
					
	}

	public static function hirxpert_options( $element ){ //Hirxpert_Theme_Option::hirxpert_options()
		$opt_array = self::$hirxpert_options;
		return !empty( $element ) && isset( $opt_array[$element] ) ? $opt_array[$element] : '';
	}

	public static function hirxpert_minify_css($css) { 
		// some of the following functions to minimize the css-output are directly taken
		// from the awesome CSS JS Booster: https://github.com/Schepp/CSS-JS-Booster
		// all credits to Christian Schaefer: https://twitter.com/derSchepp
		// remove comments
		$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
		// backup values within single or double quotes
		preg_match_all('/(\'[^\']*?\'|"[^"]*?")/ims', $css, $hit, PREG_PATTERN_ORDER);
		for ($i=0; $i < count($hit[1]); $i++) {
			$css = str_replace($hit[1][$i], '##########' . $i . '##########', $css);
		}
		// remove traling semicolon of selector's last property
		$css = preg_replace('/;[\s\r\n\t]*?}[\s\r\n\t]*/ims', "}\r\n", $css);
		// remove any whitespace between semicolon and property-name
		$css = preg_replace('/;[\s\r\n\t]*?([\r\n]?[^\s\r\n\t])/ims', ';$1', $css);
		// remove any whitespace surrounding property-colon
		$css = preg_replace('/[\s\r\n\t]*:[\s\r\n\t]*?([^\s\r\n\t])/ims', ':$1', $css);
		// remove any whitespace surrounding selector-comma
		$css = preg_replace('/[\s\r\n\t]*,[\s\r\n\t]*?([^\s\r\n\t])/ims', ',$1', $css);
		// remove any whitespace surrounding opening parenthesis
		$css = preg_replace('/[\s\r\n\t]*{[\s\r\n\t]*?([^\s\r\n\t])/ims', '{$1', $css);
		// remove any whitespace between numbers and units
		$css = preg_replace('/([\d\.]+)[\s\r\n\t]+(px|em|pt|%)/ims', '$1$2', $css);
		// shorten zero-values
		$css = preg_replace('/([^\d\.]0)(px|em|pt|%)/ims', '$1', $css);
		// constrain multiple whitespaces
		$css = preg_replace('/\p{Zs}+/ims',' ', $css);
		// remove newlines
		$css = str_replace(array("\r\n", "\r", "\n"), '', $css);
		// Restore backupped values within single or double quotes
		for ($i=0; $i < count($hit[1]); $i++) {
			$css = str_replace('##########' . $i . '##########', $hit[1][$i], $css);
		}
		return $css;
	}

    public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}
Hirxpert_Theme_Option::instance();