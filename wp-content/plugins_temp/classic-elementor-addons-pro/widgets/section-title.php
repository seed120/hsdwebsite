<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Classic Elementor Addon Section Title
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Section_Title_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Section Title widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceasectiontitle";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Section Title widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Section Title", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Section Title widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-text";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Section Title widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'section', 'title', 'heading', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Section Title widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ "classic-elements" ];
	}

	/**
	* Get script dependencies
	* 
	* Retrieve the list of script dependencies the Section Title widget relies on.
	* 
	* @since 1.0.0
	* @access public
	* 
	* @return array Script dependencies.
	*/
	public function get_script_depends() {
		return [ 'cea-custom-front' ];
	}
	
	private static function get_additional_styles() {
		static $additional_styles = null;

		if ( null !== $additional_styles ) {
			return $additional_styles;
		}
		$additional_styles = [];
		/**
		 * Additional Styles.
		 *
		 * Filters the styles used by Elementor to add additional divider styles.
		 *
		 * @since 2.7.0
		 *
		 * @param array $additional_styles Additional Elementor divider styles.
		 */
		$additional_styles = apply_filters( 'elementor/divider/styles/additional_styles', $additional_styles );
		return $additional_styles;
	}

	private function get_separator_styles() {
		return array_merge(
			self::get_additional_styles(),
			[
				'curly'   => [
					'label' => _x( 'Curly', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M0,21c3.3,0,8.3-0.9,15.7-7.1c6.6-5.4,4.4-9.3,2.4-10.3c-3.4-1.8-7.7,1.3-7.3,8.8C11.2,20,17.1,21,24,21"/>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => false,
					'group' => 'line',
				],
				'curved'   => [
					'label' => _x( 'Curved', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M0,6c6,0,6,13,12,13S18,6,24,6"/>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => false,
					'group' => 'line',
				],
				'multiple'   => [
					'label' => _x( 'Multiple', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M24,8v12H0V8H24z M24,4v1H0V4H24z"/>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => false,
					'round' => false,
					'group' => 'pattern',
				],
				'slashes' => [
					'label' => _x( 'Slashes', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<g transform="translate(-12.000000, 0)"><path d="M28,0L10,18"/><path d="M18,0L0,18"/><path d="M48,0L30,18"/><path d="M38,0L20,18"/></g>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => false,
					'view_box' => '0 0 20 16',
					'group' => 'line',
				],
				'squared' => [
					'label' => _x( 'Squared', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<polyline points="0,6 6,6 6,18 18,18 18,6 24,6 	"/>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => false,
					'group' => 'line',
				],
				'wavy'   => [
					'label' => _x( 'Wavy', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M0,6c6,0,0.9,11.1,6.9,11.1S18,6,24,6"/>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => false,
					'group' => 'line',
				],
				'zigzag'  => [
					'label' => _x( 'Zigzag', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<polyline points="0,18 12,6 24,18 "/>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => false,
					'group' => 'line',
				],
				'arrows'   => [
					'label' => _x( 'Arrows', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M14.2,4c0.3,0,0.5,0.1,0.7,0.3l7.9,7.2c0.2,0.2,0.3,0.4,0.3,0.7s-0.1,0.5-0.3,0.7l-7.9,7.2c-0.2,0.2-0.4,0.3-0.7,0.3s-0.5-0.1-0.7-0.3s-0.3-0.4-0.3-0.7l0-2.9l-11.5,0c-0.4,0-0.7-0.3-0.7-0.7V9.4C1,9,1.3,8.7,1.7,8.7l11.5,0l0-3.6c0-0.3,0.1-0.5,0.3-0.7S13.9,4,14.2,4z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => true,
					'round' => true,
					'group' => 'pattern',
				],
				'pluses'   => [
					'label' => _x( 'Pluses', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M21.4,9.6h-7.1V2.6c0-0.9-0.7-1.6-1.6-1.6h-1.6c-0.9,0-1.6,0.7-1.6,1.6v7.1H2.6C1.7,9.6,1,10.3,1,11.2v1.6c0,0.9,0.7,1.6,1.6,1.6h7.1v7.1c0,0.9,0.7,1.6,1.6,1.6h1.6c0.9,0,1.6-0.7,1.6-1.6v-7.1h7.1c0.9,0,1.6-0.7,1.6-1.6v-1.6C23,10.3,22.3,9.6,21.4,9.6z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => true,
					'round' => false,
					'group' => 'pattern',
				],
				'rhombus'   => [
					'label' => _x( 'Rhombus', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M12.7,2.3c-0.4-0.4-1.1-0.4-1.5,0l-8,9.1c-0.3,0.4-0.3,0.9,0,1.2l8,9.1c0.4,0.4,1.1,0.4,1.5,0l8-9.1c0.3-0.4,0.3-0.9,0-1.2L12.7,2.3z"/>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => false,
					'group' => 'pattern',
				],
				'parallelogram'   => [
					'label' => _x( 'Parallelogram', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<polygon points="9.4,2 24,2 14.6,21.6 0,21.6"/>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => false,
					'group' => 'pattern',
				],
				'rectangles'   => [
					'label' => _x( 'Rectangles', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<rect x="15" y="0" width="30" height="30"/>',
					'preserve_aspect_ratio' => false,
					'supports_amount' => true,
					'round' => true,
					'group' => 'pattern',
					'view_box' => '0 0 60 30',
				],
				'dots_tribal'   => [
					'label' => _x( 'Dots', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M3,10.2c2.6,0,2.6,2,2.6,3.2S4.4,16.5,3,16.5s-3-1.4-3-3.2S0.4,10.2,3,10.2z M18.8,10.2c1.7,0,3.2,1.4,3.2,3.2s-1.4,3.2-3.2,3.2c-1.7,0-3.2-1.4-3.2-3.2S17,10.2,18.8,10.2z M34.6,10.2c1.5,0,2.6,1.4,2.6,3.2s-0.5,3.2-1.9,3.2c-1.5,0-3.4-1.4-3.4-3.2S33.1,10.2,34.6,10.2z M50.5,10.2c1.7,0,3.2,1.4,3.2,3.2s-1.4,3.2-3.2,3.2c-1.7,0-3.3-0.9-3.3-2.6S48.7,10.2,50.5,10.2z M66.2,10.2c1.5,0,3.4,1.4,3.4,3.2s-1.9,3.2-3.4,3.2c-1.5,0-2.6-0.4-2.6-2.1S64.8,10.2,66.2,10.2z M82.2,10.2c1.7,0.8,2.6,1.4,2.6,3.2s-0.1,3.2-1.6,3.2c-1.5,0-3.7-1.4-3.7-3.2S80.5,9.4,82.2,10.2zM98.6,10.2c1.5,0,2.6,0.4,2.6,2.1s-1.2,4.2-2.6,4.2c-1.5,0-3.7-0.4-3.7-2.1S97.1,10.2,98.6,10.2z M113.4,10.2c1.2,0,2.2,0.9,2.2,3.2s-0.1,3.2-1.3,3.2s-3.1-1.4-3.1-3.2S112.2,10.2,113.4,10.2z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => false,
					'round' => false,
					'group' => 'tribal',
					'view_box' => '0 0 126 26',
				],
				'trees_2_tribal'   => [
					'label' => _x( 'Fir Tree', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M111.9,18.3v3.4H109v-3.4H111.9z M90.8,18.3v3.4H88v-3.4H90.8z M69.8,18.3v3.4h-2.9v-3.4H69.8z M48.8,18.3v3.4h-2.9v-3.4H48.8z M27.7,18.3v3.4h-2.9v-3.4H27.7z M6.7,18.3v3.4H3.8v-3.4H6.7z M46.4,4l4.3,4.8l-1.8,0l3.5,4.4l-2.2-0.1l3,3.3l-11,0.4l3.6-3.8l-2.9-0.1l3.1-4.2l-1.9,0L46.4,4z M111.4,4l2.4,4.8l-1.8,0l3.5,4.4l-2.5-0.1l3.3,3.3h-11l3.1-3.4l-2.5-0.1l3.1-4.2l-1.9,0L111.4,4z M89.9,4l2.9,4.8l-1.9,0l3.2,4.2l-2.5,0l3.5,3.5l-11-0.4l3-3.1l-2.4,0L88,8.8l-1.9,0L89.9,4z M68.6,4l3,4.4l-1.9,0.1l3.4,4.1l-2.7,0.1l3.8,3.7H63.8l2.9-3.6l-2.9,0.1L67,8.7l-2,0.1L68.6,4z M26.5,4l3,4.4l-1.9,0.1l3.7,4.7l-2.5-0.1l3.3,3.3H21l3.1-3.4l-2.5-0.1l3.2-4.3l-2,0.1L26.5,4z M4.9,4l3.7,4.8l-1.5,0l3.1,4.2L7.6,13l3.4,3.4H0l3-3.3l-2.3,0.1l3.5-4.4l-2.3,0L4.9,4z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => false,
					'round' => false,
					'group' => 'tribal',
					'view_box' => '0 0 126 26',
				],
				'rounds_tribal'   => [
					'label' => _x( 'Half Rounds', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M11.9,15.9L11.9,15.9L0,16c-0.2-3.7,1.5-5.7,4.9-6C10,9.6,12.4,14.2,11.9,15.9zM26.9,15.9L26.9,15.9L15,16c0.5-3.7,2.5-5.7,5.9-6C26,9.6,27.4,14.2,26.9,15.9z M37.1,10c3.4,0.3,5.1,2.3,4.9,6H30.1C29.5,14.4,31.9,9.6,37.1,10z M57,15.9L57,15.9L45,16c0-3.4,1.6-5.4,4.9-5.9C54.8,9.3,57.4,14.2,57,15.9z M71.9,15.9L71.9,15.9L60,16c-0.2-3.7,1.5-5.7,4.9-6C70,9.6,72.4,14.2,71.9,15.9z M82.2,10c3.4,0.3,5,2.3,4.8,6H75.3C74,13,77.1,9.6,82.2,10zM101.9,15.9L101.9,15.9L90,16c-0.2-3.7,1.5-5.7,4.9-6C100,9.6,102.4,14.2,101.9,15.9z M112.1,10.1c2.7,0.5,4.3,2.5,4.9,5.9h-11.9l0,0C104.5,14.4,108,9.3,112.1,10.1z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => false,
					'round' => false,
					'group' => 'tribal',
					'view_box' => '0 0 120 26',
				],
				'leaves_tribal'   => [
					'label' => _x( 'Leaves', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M3,1.5C5,4.9,6,8.8,6,13s-1.7,8.1-5,11.5C0.3,21.1,0,17.2,0,13S1,4.9,3,1.5z M16,1.5c2,3.4,3,7.3,3,11.5s-1,8.1-3,11.5c-2-4.1-3-8.3-3-12.5S14,4.3,16,1.5z M29,1.5c2,4.8,3,9.3,3,13.5s-1,7.4-3,9.5c-2-3.4-3-7.3-3-11.5S27,4.9,29,1.5z M41.1,1.5C43.7,4.9,45,8.8,45,13s-1,8.1-3,11.5c-2-3.4-3-7.3-3-11.5S39.7,4.9,41.1,1.5zM55,1.5c2,2.8,3,6.3,3,10.5s-1.3,8.4-4,12.5c-1.3-3.4-2-7.3-2-11.5S53,4.9,55,1.5z M68,1.5c2,3.4,3,7.3,3,11.5s-0.7,8.1-2,11.5c-2.7-4.8-4-9.3-4-13.5S66,3.6,68,1.5z M82,1.5c1.3,4.8,2,9.3,2,13.5s-1,7.4-3,9.5c-2-3.4-3-7.3-3-11.5S79.3,4.9,82,1.5z M94,1.5c2,3.4,3,7.3,3,11.5s-1.3,8.1-4,11.5c-1.3-1.4-2-4.3-2-8.5S92,6.9,94,1.5z M107,1.5c2,2.1,3,5.3,3,9.5s-0.7,8.7-2,13.5c-2.7-3.4-4-7.3-4-11.5S105,4.9,107,1.5z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => false,
					'round' => false,
					'group' => 'tribal',
					'view_box' => '0 0 117 26',
				],
				'stripes_tribal'   => [
					'label' => _x( 'Stripes', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M54,1.6V26h-9V2.5L54,1.6z M69,1.6v23.3L60,26V1.6H69z M24,1.6v23.5l-9-0.6V1.6H24z M30,0l9,0.7v24.5h-9V0z M9,2.5v22H0V3.7L9,2.5z M75,1.6l9,0.9v22h-9V1.6z M99,2.7v21.7h-9V3.8L99,2.7z M114,3.8v20.7l-9-0.5V3.8L114,3.8z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => false,
					'round' => false,
					'group' => 'tribal',
					'view_box' => '0 0 120 26',
				],
				'squares_tribal'   => [
					'label' => _x( 'Squares', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M46.8,7.8v11.5L36,18.6V7.8H46.8z M82.4,7.8L84,18.6l-12,0.7L70.4,7.8H82.4z M0,7.8l12,0.9v9.9H1.3L0,7.8z M30,7.8v10.8H19L18,7.8H30z M63.7,7.8L66,18.6H54V9.5L63.7,7.8z M89.8,7L102,7.8v10.8H91.2L89.8,7zM108,7.8l12,0.9v8.9l-12,1V7.8z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => false,
					'round' => false,
					'group' => 'tribal',
					'view_box' => '0 0 126 26',
				],
				'trees_tribal'   => [
					'label' => _x( 'Trees', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M6.4,2l4.2,5.7H7.7v2.7l3.8,5.2l-3.8,0v7.8H4.8v-7.8H0l4.8-5.2V7.7H1.1L6.4,2z M25.6,2L31,7.7h-3.7v2.7l4.8,5.2h-4.8v7.8h-2.8v-7.8l-3.8,0l3.8-5.2V7.7h-2.9L25.6,2z M47.5,2l4.2,5.7h-3.3v2.7l3.8,5.2l-3.8,0l0.4,7.8h-2.8v-7.8H41l4.8-5.2V7.7h-3.7L47.5,2z M66.2,2l5.4,5.7h-3.7v2.7l4.8,5.2h-4.8v7.8H65v-7.8l-3.8,0l3.8-5.2V7.7h-2.9L66.2,2zM87.4,2l4.8,5.7h-2.9v3.1l3.8,4.8l-3.8,0v7.8h-2.8v-7.8h-4.8l4.8-4.8V7.7h-3.7L87.4,2z M107.3,2l5.4,5.7h-3.7v2.7l4.8,5.2h-4.8v7.8H106v-7.8l-3.8,0l3.8-5.2V7.7h-2.9L107.3,2z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => false,
					'round' => false,
					'group' => 'tribal',
					'view_box' => '0 0 123 26',
				],
				'planes_tribal'   => [
					'label' => _x( 'Tribal', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M29.6,10.3l2.1,2.2l-3.6,3.3h7v2.9h-7l3.6,3.5l-2.1,1.7l-5.2-5.2h-5.8v-2.9h5.8L29.6,10.3z M70.9,9.6l2.1,1.7l-3.6,3.5h7v2.9h-7l3.6,3.3l-2.1,2.2l-5.2-5.5h-5.8v-2.9h5.8L70.9,9.6z M111.5,9.6l2.1,1.7l-3.6,3.5h7v2.9h-7l3.6,3.3l-2.1,2.2l-5.2-5.5h-5.8v-2.9h5.8L111.5,9.6z M50.2,2.7l2.1,1.7l-3.6,3.5h7v2.9h-7l3.6,3.3l-2.1,2.2L45,10.7h-5.8V7.9H45L50.2,2.7z M11,2l2.1,1.7L9.6,7.2h7V10h-7l3.6,3.3L11,15.5L5.8,10H0V7.2h5.8L11,2z M91.5,2l2.1,2.2l-3.6,3.3h7v2.9h-7l3.6,3.5l-2.1,1.7l-5.2-5.2h-5.8V7.5h5.8L91.5,2z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => false,
					'round' => false,
					'group' => 'tribal',
					'view_box' => '0 0 121 26',
				],
				'x_tribal'   => [
					'label' => _x( 'X', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<path d="M10.7,6l2.5,2.6l-4,4.3l4,5.4l-2.5,1.9l-4.5-5.2l-3.9,4.2L0.7,17L4,13.1L0,8.6l2.3-1.3l3.9,3.9L10.7,6z M23.9,6.6l4.2,4.5L32,7.2l2.3,1.3l-4,4.5l3.2,3.9L32,19.1l-3.9-3.3l-4.5,4.3l-2.5-1.9l4.4-5.1l-4.2-3.9L23.9,6.6zM73.5,6L76,8.6l-4,4.3l4,5.4l-2.5,1.9l-4.5-5.2l-3.9,4.2L63.5,17l4.1-4.7L63.5,8l2.3-1.3l4.1,3.6L73.5,6z M94,6l2.5,2.6l-4,4.3l4,5.4L94,20.1l-3.9-5l-3.9,4.2L84,17l3.2-3.9L84,8.6l2.3-1.3l3.2,3.9L94,6z M106.9,6l4.5,5.1l3.9-3.9l2.3,1.3l-4,4.5l3.2,3.9l-1.6,2.1l-3.9-4.2l-4.5,5.2l-2.5-1.9l4-5.4l-4-4.3L106.9,6z M53.1,6l2.5,2.6l-4,4.3l4,4.6l-2.5,1.9l-4.5-4.5l-3.5,4.5L43.1,17l3.2-3.9l-4-4.5l2.3-1.3l3.9,3.9L53.1,6z"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => false,
					'round' => false,
					'group' => 'tribal',
					'view_box' => '0 0 126 26',
				],
				'zigzag_tribal'   => [
					'label' => _x( 'Zigzag', 'shapes', 'classic-elementor-addons-pro' ),
					'shape' => '<polygon points="0,14.4 0,21 11.5,12.4 21.3,20 30.4,11.1 40.3,20 51,12.4 60.6,20 69.6,11.1 79.3,20 90.1,12.4 99.6,20 109.7,11.1 120,21 120,14.4 109.7,5 99.6,13 90.1,5 79.3,14.5 71,5.7 60.6,12.4 51,5 40.3,14.5 31.1,5 21.3,13 11.5,5 	"/>',
					'preserve_aspect_ratio' => true,
					'supports_amount' => false,
					'round' => false,
					'group' => 'tribal',
					'view_box' => '0 0 120 26',
				],
			]
		);
	}

	private function filter_styles_by( $array, $key, $value ) {
		return array_filter( $array, function( $style ) use ( $key, $value ) {
			return $value === $style[ $key ];
		} );
	}

	private function get_options_by_groups( $styles, $group = false ) {
		$groups = [
			'line' => [
				'label' => __( 'Line', 'classic-elementor-addons-pro' ),
				'options' => [
					'solid' => __( 'Solid', 'classic-elementor-addons-pro' ),
					'double' => __( 'Double', 'classic-elementor-addons-pro' ),
					'dotted' => __( 'Dotted', 'classic-elementor-addons-pro' ),
					'dashed' => __( 'Dashed', 'classic-elementor-addons-pro' ),
				],
			],
		];
		foreach ( $styles as $key => $style ) {
			if ( ! isset( $groups[ $style['group'] ] ) ) {
				$groups[ $style['group'] ] = [
					'label' => ucwords( str_replace( '_', '', $style['group'] ) ),
					'options' => [],
				];
			}
			$groups[ $style['group'] ]['options'][ $key ] = $style['label'];
		}

		if ( $group && isset( $groups[ $group ] ) ) {
			return $groups[ $group ];
		}
		return $groups;
	}

	/**
	 * Register Section Title widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		
		$styles = $this->get_separator_styles();
		
		//General Section
		$this->start_controls_section(
			"general_section",
			[
				"label"	=> esc_html__( "General", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default icon list options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'pattern_spacing_flag',
			[
				'type' => Controls_Manager::HIDDEN,
				'default' => 'no-spacing',
				'prefix_class' => 'cea-separator--',
				'condition' => [
					'sep_pattern' => array_keys( $this->filter_styles_by( $styles, 'supports_amount', false ) ),
				],
				'render_type' => 'template',
			]
		);
		$this->add_control(
			"extra_class",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Extra Class", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Put extra class for some additional styles.", 'classic-elementor-addons-pro' )
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label' => esc_html__( 'Alignment', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-justify',
					],
				],				
				'default' => 'center',
				'prefix_class' => 'cea%s-align-',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
					'{{WRAPPER}}.cea-align-center .section-description' => 'margin: 0 auto;'
				],
			]
		);
		$this->end_controls_section();
				
		//Title Section
		$this->start_controls_section(
			"title_section",
			[
				"label"			=> esc_html__( "Title", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Title options available here.", 'classic-elementor-addons-pro' ),
			]
		);		
		$this->add_control(
			"title_prefix",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Prefix Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter section title prefix. If no need title prefix, then leave this box blank.", 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			"title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Main Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter section title here.", 'classic-elementor-addons-pro' ),
				"default"		=> esc_html__( "Section Title", 'classic-elementor-addons-pro' )
			]
		);			
		$this->add_control(
			"title_suffix",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Suffix Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter section title suffix. If no need title suffix, then leave this box blank.", 'classic-elementor-addons-pro' )
			]
		);	
		$this->add_control(
			"title_head",
			[
				"label"			=> esc_html__( "Modal Box Title Heading Tag", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can choose the section title box title heading tag.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h2",
				"options"		=> [
					"h1"		=> esc_html__( "h1", 'classic-elementor-addons-pro' ),
					"h2"		=> esc_html__( "h2", 'classic-elementor-addons-pro' ),
					"h3"		=> esc_html__( "h3", 'classic-elementor-addons-pro' ),
					"h4"		=> esc_html__( "h4", 'classic-elementor-addons-pro' ),
					"h5"		=> esc_html__( "h5", 'classic-elementor-addons-pro' ),
					"h6"		=> esc_html__( "h6", 'classic-elementor-addons-pro' ),
					"p"			=> esc_html__( "p", 'classic-elementor-addons-pro' ),
					"span"		=> esc_html__( "span", 'classic-elementor-addons-pro' ),
					"div"		=> esc_html__( "div", 'classic-elementor-addons-pro' ),
					"i"			=> esc_html__( "i", 'classic-elementor-addons-pro' )
				]
			]
		);		

		$this->add_control(
			'normal_title_animation',
			[
				'label' => esc_html__( 'Animation', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
					'nml-letter-blur-out' => esc_html__( 'Blur Out', 'classic-elementor-addons-pro' ),
					'nml-letter-magnify' => esc_html__( 'Magnify', 'classic-elementor-addons-pro' ),
					'nml-letter-beat' => esc_html__( 'Beat', 'classic-elementor-addons-pro' ),
					'nml-letter-fade-in' => esc_html__( 'Fade In', 'classic-elementor-addons-pro' ),
					'nml-letter-fly-in' => esc_html__( 'Fly In', 'classic-elementor-addons-pro' ),
					'nml-letter-kick-out' => esc_html__( 'Kick Out', 'classic-elementor-addons-pro' ),
					'nml-letter-push-release' => esc_html__( 'Push Release', 'classic-elementor-addons-pro' ),
					'nml-letter-rotate-from' => esc_html__( 'Rotate From', 'classic-elementor-addons-pro' ),
					'nml-letter-scale-in' => esc_html__( 'Scale In', 'classic-elementor-addons-pro' ),
					'nml-letter-zoom-in' => esc_html__( 'Zoom In', 'classic-elementor-addons-pro' ),
				],
				'default' => 'none',
			]
		);

		$this->add_control(
			'nrml_animation_repeat',
			[
				'label'	=> esc_html__( 'Disable Reverse Onload Animation? ', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'condition'	=> [
					'normal_title_animation!'	=> 'none',
				],
				'separator'	=> 'before'
			]
		);

		$this->add_control(
			'nrml_disable_mobile',
			[
				'label'	=> esc_html__( 'Disable Animation on Mobile? ', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'condition'	=> [
					'normal_title_animation!'	=> 'none',
				],
				'separator'	=> 'before'
			]
		);
	
		$this->end_controls_section();
		
		//Sub Title Section
		$this->start_controls_section(
			"subtitle_section",
			[
				"label"			=> esc_html__( "Sub Title", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Sub title options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"sub_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Sub Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter section title here. If no need sub title, then leave this box blank.", 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			"sub_title_head",
			[
				"label"			=> esc_html__( "Sub Title Heading Tag", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can choose the section sub title heading tag.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h6",
				"options"		=> [
					"h1"		=> esc_html__( "h1", 'classic-elementor-addons-pro' ),
					"h2"		=> esc_html__( "h2", 'classic-elementor-addons-pro' ),
					"h3"		=> esc_html__( "h3", 'classic-elementor-addons-pro' ),
					"h4"		=> esc_html__( "h4", 'classic-elementor-addons-pro' ),
					"h5"		=> esc_html__( "h5", 'classic-elementor-addons-pro' ),
					"h6"		=> esc_html__( "h6", 'classic-elementor-addons-pro' ),
					"p"			=> esc_html__( "p", 'classic-elementor-addons-pro' ),
					"span"		=> esc_html__( "span", 'classic-elementor-addons-pro' ),
					"div"		=> esc_html__( "div", 'classic-elementor-addons-pro' ),
					"i"			=> esc_html__( "i", 'classic-elementor-addons-pro' )
				]
			]
		);		
		$this->add_control(
			"sub_title_pos",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Sub Title Position", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for positioning sub title.", 'classic-elementor-addons-pro' ),
				"default"		=> "bottom",
				"options"		=> [
					"bottom"	=> esc_html__( "Bottom", 'classic-elementor-addons-pro' ),
					"top"		=> esc_html__( "Top", 'classic-elementor-addons-pro' )
				]
			]
		);		
		$this->end_controls_section();
		
		//Lead
		$this->start_controls_section(
			"subtitle_lead",
			[
				"label"			=> esc_html__( "Lead", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Lead text options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"lead_text",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Lead Text", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter section lead text here.", 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			"lead_tag",
			[
				"label"			=> esc_html__( "Sub Title Heading Tag", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can choose the section sub title heading tag.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "p",
				"options"		=> [
					"p"			=> esc_html__( "p", 'classic-elementor-addons-pro' ),
					"span"		=> esc_html__( "span", 'classic-elementor-addons-pro' ),
					"div"		=> esc_html__( "div", 'classic-elementor-addons-pro' ),
					"i"			=> esc_html__( "i", 'classic-elementor-addons-pro' )
				]
			]
		);	
		$this->end_controls_section();
		
		//Separator Section
		$this->start_controls_section(
			"separator_section",
			[
				"label"			=> esc_html__( "Separator", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Separator options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"sep_model",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Separator Type", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is section title seperator type.", 'classic-elementor-addons-pro' ),
				"default"		=> "none",
				"options"		=> [
					"none"		=> esc_html__( "None", 'classic-elementor-addons-pro' ),
					"pattern"	=> esc_html__( "Border/Pattern", 'classic-elementor-addons-pro' ),
					"image"		=> esc_html__( "Image", 'classic-elementor-addons-pro' ),
					"icon"		=> esc_html__( "Icon", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->add_control(
			"sep_pattern",
			[
				"label"			=> esc_html__( "Border/Shape", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				'groups' => array_values( $this->get_options_by_groups( $styles ) ),
				'render_type' => 'template',
				'default' => 'solid',
				'selectors' => [
					'{{WRAPPER}} .elementor-divider-separator' => '--separator-border-style: {{VALUE}}',
				],
				"condition" 	=> [
					"sep_model" 	=> "pattern"
				]
			]
		);
		$this->add_control(
			'separator_type',
			[
				'type' => Controls_Manager::HIDDEN,
				'default' => 'pattern',
				'prefix_class' => 'cea-separator-type-',
				'condition' => [
					'sep_pattern!' => [
						'',
						'solid',
						'double',
						'dotted',
						'dashed',
					],
					"sep_model" => "pattern"
				],
				'render_type' => 'template'
			]
		);
		$this->add_control(
			'separator_type_normal',
			[
				'type' => Controls_Manager::HIDDEN,
				'default' => 'normal',
				'prefix_class' => 'cea-separator-type-',
				'condition' => [
					'sep_pattern' => [
						'',
						'solid',
						'double',
						'dotted',
						'dashed',
					],
					"sep_model" => "pattern"
				],
				'render_type' => 'template'
			]
		);
		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'condition' => [
					"sep_model" => "pattern"
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-divider-separator' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			"sep_image",
			[
				"label" 		=> __( "Image", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::MEDIA,
				"dynamic" 		=> [
					"active" 		=> true,
				],
				"condition" 	=> [
					"sep_model" 	=> "image"
				]
			]
		);
		$this->add_control(
			'sep_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'ti-heart',
					'library' => 'themify',
				],
				"condition" 	=> [
					"sep_model" 	=> "icon"
				]
			]
		);
		$this->end_controls_section();
		
		//Content Section
		$this->start_controls_section(
			"content_section",
			[
				"label"			=> esc_html__( "Content", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Content options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"sec_tit_content",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Content", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter section title below content.", 'classic-elementor-addons-pro' ),
				"default" 		=> ""
			]
		);
		$this->end_controls_section();
		
		// Button
		$this->start_controls_section(
			"button_section",
			[
				"label"			=> esc_html__( "Button", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Button options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"btn_enabled",
			[
				"label" 		=> esc_html__( "Enable Button", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable button on section title.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'button_type',
			[
				'label' => esc_html__( 'Type', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
					'info' => esc_html__( 'Info', 'classic-elementor-addons-pro' ),
					'success' => esc_html__( 'Success', 'classic-elementor-addons-pro' ),
					'warning' => esc_html__( 'Warning', 'classic-elementor-addons-pro' ),
					'danger' => esc_html__( 'Danger', 'classic-elementor-addons-pro' ),
				],
				'default' => 'none',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => esc_html__( 'Text', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__( 'Click here', 'classic-elementor-addons-pro' ),
				'placeholder' => esc_html__( 'Click here', 'classic-elementor-addons-pro' ),
				'condition' => [
					'btn_enabled' => 'yes'
				],
			]
		);
		$this->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'classic-elementor-addons-pro' ),
				'default' => [
					'url' => '#',
				],
				'condition' => [
					'btn_enabled' => 'yes'
				],
			]
		);
		$this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__( 'Alignment', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'prefix_class' => 'cea-btn%s-align-',
				'default' => '',
				'condition' => [
					'btn_enabled' => 'yes'
				],
			]
		);
		$this->add_control(
			'button_size',
			[
				'label' => esc_html__( 'Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
					'xs' => __( 'Extra Small', 'elementor' ),
					'sm' => __( 'Small', 'elementor' ),
					'md' => __( 'Medium', 'elementor' ),
					'lg' => __( 'Large', 'elementor' ),
					'xl' => __( 'Extra Large', 'elementor' ),
				],//self::get_button_sizes(),
				'style_transfer' => true,
				'condition' => [
					'btn_enabled' => 'yes'
				],
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'condition' => [
					'btn_enabled' => 'yes'
				],
			]
		);
		$this->add_control(
			'button_icon_align',
			[
				'label' => esc_html__( 'Icon Position', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__( 'Before', 'classic-elementor-addons-pro' ),
					'right' => esc_html__( 'After', 'classic-elementor-addons-pro' ),
				],
				'condition' => [
					'button_icon[value]!' => '',
					'btn_enabled' => 'yes'
				],
			]
		);
		$this->add_responsive_control(
			'button_icon_indent',
			[
				'label' => esc_html__( 'Icon Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-button .cea-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cea-button .cea-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'btn_enabled' => 'yes'
				],
			]
		);
		$this->add_control(
			'button_view',
			[
				'label' => esc_html__( 'View', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
				'condition' => [
					'btn_enabled' => 'yes'
				],
			]
		);
		$this->add_control(
			'button_css_id',
			[
				'label' => esc_html__( 'Button ID', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'title' => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'classic-elementor-addons-pro' ),
				'description' => esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'classic-elementor-addons-pro' ),
				'separator' => 'before',
				'condition' => [
					'btn_enabled' => 'yes'
				],

			]
		);
		$this->end_controls_section();	
		
		// Style Title Section
		$this->start_controls_section(
			'title_section_style',
			[
				'label' => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			"pre_title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Prefix Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the prefix title font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .section-title .title-prefix' => 'color: {{VALUE}};'
				],
			]
		);	
		$this->add_control(
			"title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the main title font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .section-title' => 'color: {{VALUE}};'
				],
			]
		);	
		$this->add_control(
			"suffix_title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Suffix Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the suffix title font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .section-title .title-suffix' => 'color: {{VALUE}};'
				],
			]
		);	
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .section-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .section-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'title_spacing',
			[
				'label' => esc_html__( 'Title Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .section-title-wrapper .section-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .section-title-wrapper .section-title'
			]
		);	
		$this->end_controls_section();
		
		// Style Subtitle Section
		$this->start_controls_section(
			'sub_title_section_style',
			[
				'label' => esc_html__( 'Sub Title', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			"sub_title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Sub Title Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the sub title font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .sub-title' => 'color: {{VALUE}};'
				],
			]
		);	
		$this->add_responsive_control(
			'sub_title_spacing',
			[
				'label' => esc_html__( 'Sub Title Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .section-title-wrapper .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'sub_title_typography',
				'selector' 		=> '{{WRAPPER}} .section-title-wrapper .sub-title'
			]
		);	
		$this->end_controls_section();
		
		// Style Separator Section 
		$this->start_controls_section(
			'section_divider_style',
			[
				'label' => __( 'Separator', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'sep_model!' => 'none',
				],
			]
		);

		$this->add_control(
			'color',
			[
				'label' => __( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'render_type' => 'template',
				'selectors' => [
					'{{WRAPPER}}' => '--separator-border-color: {{VALUE}}',
					'{{WRAPPER}} .title-separator > *' => 'color: {{VALUE}}',
					'{{WRAPPER}} .title-separator.separator-icon svg' => 'fill: {{VALUE}};'
				],
				'condition' => [
					'sep_model' => [
						'icon',
						'pattern'
					],
				],
			]
		);
		
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .title-separator.separator-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .title-separator.separator-icon svg' => 'width: {{SIZE}}{{UNIT}};'
				],				
				'condition' => [
					'sep_model' => 'icon'
				],
			]
		);

		$this->add_control(
			'weight',
			[
				'label' => __( 'Weight', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
						'step' => 0.1,
					],
				],
				'render_type' => 'template',
				'condition' => [
					'sep_pattern' => array_keys( $this->get_options_by_groups( $styles, 'line' )['options'] ),
					"sep_model" => "pattern"
				],
				'selectors' => [
					'{{WRAPPER}}' => '--separator-border-width: {{SIZE}}{{UNIT}}',
				],
				
			]
		);

		$this->add_control(
			'pattern_height',
			[
				'label' => __( 'Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}' => '--separator-pattern-height: {{SIZE}}{{UNIT}}',
				],
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'step' => 0.1,
					],
				],
				'condition' => [
					'sep_pattern!' => [
						'',
						'solid',
						'double',
						'dotted',
						'dashed',
					],
					"sep_model" => "pattern"
				],
			]
		);

		$this->add_control(
			'pattern_size',
			[
				'label' => __( 'Amount', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'selectors' => [
					'{{WRAPPER}}' => '--separator-pattern-size: {{SIZE}}{{UNIT}}',
				],
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'step' => 0.1,
					],
					'%' => [
						'step' => 0.01,
					],
				],
				'condition' => [
					'sep_pattern!' => array_merge( array_keys( $this->filter_styles_by( $styles, 'supports_amount', false ) ), [
						'',
						'solid',
						'double',
						'dotted',
						'dashed',
					] ),
					"sep_model" => "pattern"
				],
			]
		);
		$this->add_responsive_control(
			'img_size',
			[
				'label' => __( 'Image Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
				],
				'range' => [
					'%' => [
						'min' => 2,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .separator-img > img' => 'width: {{SIZE}}%; margin: 0 auto;'
				],
				'condition' => [
					"sep_model" => "image"
				],
			]
		);
		$this->add_responsive_control(
			'gap',
			[
				'label' => __( 'Gap', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => 2,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-divider' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .title-separator' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
		
		// Style Lead Section
		$this->start_controls_section(
			'lead_section_style',
			[
				'label' => esc_html__( 'Lead', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			"lead_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Lead Text Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the lead font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .section-description .lead' => 'color: {{VALUE}};'
				],
			]
		);	
		$this->add_responsive_control(
			'lead_spacing',
			[
				'label' => esc_html__( 'Content Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-description .lead' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .section-description .lead' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'lead_typography',
				'selector' 		=> '{{WRAPPER}} .section-description .lead'
			]
		);	
		$this->end_controls_section();		
		
		// Style Content Section
		$this->start_controls_section(
			'content_section_style',
			[
				'label' => esc_html__( 'Content', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			"content_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Content Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the content font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .section-description .section-content' => 'color: {{VALUE}};'
				],
			]
		);	
		$this->add_responsive_control(
			'content_spacing',
			[
				'label' => esc_html__( 'Content Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .section-description .section-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .section-description .section-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .section-description .section-content'
			]
		);	
		$this->end_controls_section();			
		
		// Style Button Section
		$this->start_controls_section(
			'button_section_style',
			[
				'label' => esc_html__( 'Button', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'btn_enabled' => 'yes',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .cea-button',
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} .cea-button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-button:hover, {{WRAPPER}} .cea-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-button:hover svg, {{WRAPPER}} .cea-button:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-button:hover, {{WRAPPER}} .cea-button:focus' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cea-button:hover, {{WRAPPER}} .cea-button:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .cea-button',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cea-button',
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'selector' 		=> '{{WRAPPER}} .cea-button'
			]
		);
		$this->end_controls_section();	
			
	}
	
	private function build_svg() {
		$settings = $this->get_settings_for_display();

		if ( 'pattern' !== $settings['separator_type'] || empty( $settings['sep_pattern'] ) ) {
			return '';
		}

		$svg_shapes = $this->get_separator_styles();

		$selected_pattern = $svg_shapes[ $settings['sep_pattern'] ];
		$preserve_aspect_ratio = $selected_pattern['preserve_aspect_ratio'] ? 'xMidYMid meet' : 'none';
		$view_box = isset( $selected_pattern['view_box'] ) ? $selected_pattern['view_box'] : '0 0 24 24';

		$attr = [
			'preserveAspectRatio' => $preserve_aspect_ratio,
			'overflow' => 'visible',
			'height' => '100%',
			'viewBox' => $view_box,
		];

		if ( 'line' !== $selected_pattern['group'] ) {
			$attr['fill'] = $settings['color'];
			$attr['stroke'] = 'none';
		} else {
			$attr['stroke'] = $settings['color'];
			$attr['stroke-width'] = $settings['weight']['size'];
			$attr['fill'] = 'none';
			$attr['stroke-linecap'] = 'square';
			$attr['stroke-miterlimit'] = '10';
		}

		$this->add_render_attribute( 'svg', $attr );

		$pattern_attribute_string = $this->get_render_attribute_string( 'svg' );
		$shape = $selected_pattern['shape'];

		return '<svg xmlns="http://www.w3.org/2000/svg" ' . $pattern_attribute_string . '>' . $shape . '</svg>';
	}

	public function svg_to_data_uri( $svg ) {
		return str_replace(
			[ '<', '>', '"', '#' ],
			[ '%3C', '%3E', "'", '%23' ],
			$svg
		);
	}
	
	/**
	 * Render Section Title widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		//Define Variables
		$class = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';		
		
		$title = isset( $title ) ? $title : '';
		$title_head = isset( $title_head ) ? $title_head : 'h2';	
		$sub_title_head = isset( $sub_title_head ) ? $sub_title_head : 'h6';			
		$sub_title = isset( $sub_title ) && $sub_title != '' ? '<'. esc_attr( $sub_title_head ) .' class="sub-title"><span class="subtitle-dots " ' . $this->get_render_attribute_string( 'sub_title' ) . '>'. esc_html( $sub_title ) .'</span></'. esc_attr( $sub_title_head ) .'>' : '';
		$sub_title_pos = isset( $sub_title_pos ) ? $sub_title_pos : 'bottom';
		$lead_text = isset( $lead_text ) ? $lead_text : '';
		$title_animation = $normal_title_animation . ' cea-nrml';
		$nrml_animation_repeat = isset( $nrml_animation_repeat ) && $nrml_animation_repeat == 'yes' ? ' data-animate-repeat="'. $nrml_animation_repeat .'"' : '';
		$nrml_disable_mobile = isset( $nrml_disable_mobile ) && $nrml_disable_mobile == 'yes' ? ' data-disable-mobile="'. $nrml_disable_mobile .'"' : '';
		
		echo '<div class="section-title-wrapper'. esc_attr( $class ) .'">';
			
			echo '<div class="title-wrap">';
				// Section title 
				echo $sub_title != '' && $sub_title_pos == 'top' ? $sub_title : '';
				echo '<' . esc_attr( $title_head ) . ' class="section-title ' . $title_animation . '" data-animation="' . $normal_title_animation . '" '. $nrml_animation_repeat .' '. $nrml_disable_mobile .'>';
					echo isset( $title_prefix ) && $title_prefix != '' ? '<span class="title-prefix">' . esc_html( $title_prefix ) . '</span> ' : '';
					echo _e( $title );
					echo isset( $title_suffix ) && $title_suffix != '' ? ' <span class="title-suffix">' . esc_html( $title_suffix ) . '</span>' : '';
				echo '</' . esc_attr( $title_head ) . '>';
				echo $sub_title != '' && $sub_title_pos == 'bottom' ? $sub_title : '';
				
				// Section title separator 
				$sep_model = isset( $sep_model ) ? $sep_model : 'none';
				if( $sep_model == 'pattern' ){					
					$svg_code = $this->build_svg();
					$this->add_render_attribute( 'seperator_wrapper', 'class', 'elementor-divider' );
					if ( ! empty( $svg_code ) ) {
						$this->add_render_attribute( 'seperator_wrapper', 'style', '--separator-pattern-url: url("data:image/svg+xml,' . $this->svg_to_data_uri( $svg_code ) . '");' );
					}
					echo '<div '. $this->get_render_attribute_string( 'seperator_wrapper' ) .'><span class="elementor-divider-separator"></span></div>';
				}elseif( $sep_model == 'image' ){
					if( is_array( $sep_image ) && isset( $sep_image['id'] ) ){ 
						$img_attr = wp_get_attachment_image_src( absint( $sep_image['id'] ), 'full', true );
						$image_alt = get_post_meta( absint( $sep_image['id'] ), '_wp_attachment_image_alt', true);
						echo isset( $img_attr[0] ) ? '<span class="title-separator separator-img"><img class="img-fluid" src="'. esc_url( $img_attr[0] ) .'" width="'. esc_attr( $img_attr[1] ) .'" height="'. esc_attr( $img_attr[2] ) .'" alt="'. esc_attr( $image_alt ) .'" /></span>' : '';
					}
				}elseif( $sep_model == 'icon' ){
					if ( empty( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
						// add old default
						$settings['icon'] = 'ti-heart';
					}
					if ( ! empty( $settings['icon'] ) ) {
						$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
						$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
					}
					$migrated = isset( $settings['__fa4_migrated']['sep_icon'] );
					$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
					echo '<span class="title-separator separator-icon">';
					if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings['sep_icon'], [ 'aria-hidden' => 'true' ] );
					else :
						echo '<i>' . $this->get_render_attribute_string( 'icon' ) . '</i>';
					endif;
					echo '</span>';
				}
			echo '</div><!-- .title-wrap -->';
			
			echo '<div class="section-description">';
				$lead_tag = isset( $lead_tag ) && !empty( $lead_tag ) ? $lead_tag : 'p';
				echo !empty( $lead_text ) ? '<'. esc_attr( $lead_tag ) .' class="lead d-block">'. $lead_text .'</'. esc_attr( $lead_tag ) .'>' : '';
				echo isset( $sec_tit_content ) && $sec_tit_content != '' ? '<p class="section-content">'. $sec_tit_content .'</p>' : '';
				
				//Button code
				if ( isset( $settings['btn_enabled'] ) && $settings['btn_enabled'] == 'yes' ) {
					$this->add_render_attribute( 'button-wrapper', 'class', 'cea-button-wrapper' );
					if ( ! empty( $settings['button_link']['url'] ) ) {
						$this->add_link_attributes( 'button', $settings['button_link'] );
						$this->add_render_attribute( 'button', 'class', 'cea-button-link' );
					}
					if ( $settings['button_type'] != 'none' ) {
						$this->add_render_attribute( 'button', 'class', 'cea-button-' . $settings['button_type'] );
					}
					$this->add_render_attribute( 'button', 'class', 'elementor-button cea-button' );
					if ( ! empty( $settings['button_css_id'] ) ) {
						$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
					}
					if ( ! empty( $settings['button_size'] ) ) {
						$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['button_size'] );
					}
					if ( isset( $settings['button_hover_animation'] ) && $settings['button_hover_animation'] ) {
						$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
					}
					?>
					<div <?php echo $this->get_render_attribute_string( 'button-wrapper' ); ?>>
						<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
							<?php $this->button_render_text(); ?>
						</a>
					</div>
					<?php
				}
			echo '</div><!-- .section-description -->';
			
		echo '</div><!-- .section-title-wrapper -->';
		

	}
	
	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function button_render_text() {
		$settings = $this->get_settings_for_display();

		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

		if ( ! $is_new && empty( $settings['icon_align'] ) ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			//old default
			$settings['icon_align'] = $this->get_settings( 'icon_align' );
		}

		$this->add_render_attribute( [
			'content-wrapper' => [
				'class' => 'cea-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'cea-button-icon',
					'cea-align-icon-' . $settings['button_icon_align'],
				],
			],
			'text' => [
				'class' => 'cea-button-text',
			],
		] );

		$this->add_inline_editing_attributes( 'text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings['button_icon'] ) || ! empty( $settings['button_icon']['value'] ) ) : ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<?php if ( $is_new || $migrated ) :
					Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
				else : ?>
					<i class="<?php echo esc_attr( $settings['button_icon'] ); ?>" aria-hidden="true"></i>
				<?php endif; ?>
			</span>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['button_text']; ?></span>
		</span>
		<?php
	}
		
}