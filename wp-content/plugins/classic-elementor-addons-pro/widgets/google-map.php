<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Classic Elementor Addon Google Map
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Google_Map_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Google Map widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceagooglemap";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Google Map widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Google Map", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Google Map widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-map-alt";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Google Map widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'google', 'map', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Google Map widget belongs to.
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
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'cea-custom-front', 'cea-gmaps'  ];
	}


	/**
	 * Register Google Map widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		
		//Map Section
		$this->start_controls_section(
			"map_section",
			[
				"label"			=> esc_html__( "Map", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Map options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
			"map_latitude",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Map Latitude", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is set option for google map latitude. Example -25.363", 'classic-elementor-addons-pro' ),
				"default" 		=> "-25.363",
			]
		);	
		$repeater->add_control(
			"map_longitude",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Map Longitude", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is set option for google map longitude. Example 131.044", 'classic-elementor-addons-pro' ),
				"default" 		=> "131.044",
			]
		);	
		$repeater->add_control(
			"map_marker",
			[
				"label"			=> esc_html__( "Map Marker", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose map marker image.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::MEDIA,
				"dynamic" 		=> [
					"active" => true,
				]
			]
		);
		$repeater->add_control(
			"map_info_opt",
			[
				"label" 		=> esc_html__( "Map Info Window Option", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for map info window enable or disable.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$repeater->add_control(
			"map_info_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Map Info Window Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is field for map info window title.", 'classic-elementor-addons-pro' ),
				"default"		=> "",
				"condition" 	=> [
					"map_info_opt" 	=> "1"
				]
			]
		);
		$repeater->add_control(
			"map_info_address",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Map Info Window Address", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is field for map info window address. No HTML allowed here.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				"condition" 	=> [
					"map_info_opt" 	=> "1"
				]
			]
		);
		$this->add_control(
			"multi_map",
			[
				"label"			=> esc_html__( "Map Details", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is options for google map latitude, longtitude etc..", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::REPEATER,
				"fields"		=> $repeater->get_controls(),
				"default"		=> [
					[
						"map_latitude" => '-25.363',
						"map_longitude" => '131.044'
					]
				],
				"title_field"	=> "{{{ map_latitude }}}, {{{ map_longitude }}}",
			]
		);		
		
		$this->add_control(
			"map_height",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Map Height", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is set option for google map height.", 'classic-elementor-addons-pro' ),
				"default"		=> "400"
			]
		);
		$this->add_control(
			"map_style",
			[
				"label"			=> esc_html__( "Map Style", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "This is option for map style. If you want custom map style, then choose custom and set map colors to 'Custom Color' tab.", 'classic-elementor-addons-pro' ),
				"default"		=> "standard",
				"options"		=> [
					"standard"		=> esc_html__( "Standard", 'classic-elementor-addons-pro' ),
					"aubergine"	=> esc_html__( "Aubergine", 'classic-elementor-addons-pro' ),
					"silver"		=> esc_html__( "Silver", 'classic-elementor-addons-pro' ),
					"retro"		=> esc_html__( "Retro", 'classic-elementor-addons-pro' ),
					"dark"		=> esc_html__( "Dark", 'classic-elementor-addons-pro' ),
					"night"		=> esc_html__( "Night", 'classic-elementor-addons-pro' ),
					"custom"		=> esc_html__( "Custom", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->add_control(
			"map_zoom",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Map Zoom", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is set option for google map zoom level. Default value is 14", 'classic-elementor-addons-pro' ),
				"default"		=> "14"
			]
		);
		$this->add_control(
			"scroll_wheel",
			[
				"label" 		=> esc_html__( "Map Scroll Wheel", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for google map zoom on scroll at position of mouse on map.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->end_controls_section();		
		
		// Style General Section
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'General', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'map_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .google-map-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'map_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .google-map-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			"map_bg_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Map Background Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for map background color.", 'classic-elementor-addons-pro' ),
				"default" 		=> ""
			]
		);
		$this->end_controls_section();
		
		//Custom Map Colors
		$this->start_controls_section(
			"custom_color_section",
			[
				"label"			=> esc_html__( "Custom Color", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_STYLE,
				"description"	=> esc_html__( "Map custom color options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"map_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Map Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for general map.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#242f3e"
			]
		);
		$this->add_control(
			"map_text_stroke",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Map Text Stroke Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for general map text stroke.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#242f3e"
			]
		);
		$this->add_control(
			"map_text_fill",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Map Text Fill Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for general map text fill.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#746855"
			]
		);
		$this->add_control(
			"administrative",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Administrative Text Fill Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for administrative text fill.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#d59563"
			]
		);
		$this->add_control(
			"poi_text_fill",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "POI Text Fill Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for POI text fill.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#d59563"
			]
		);
		$this->add_control(
			"poi_park",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "POI Park Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for POI park.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#263c3f"
			]
		);
		$this->add_control(
			"poi_park_text_fill",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "POI Park Text Fill Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for POI park text fill.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#6b9a76"
			]
		);
		$this->add_control(
			"road",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Road Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for road.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#38414e"
			]
		);
		$this->add_control(
			"road_stroke",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Road Stroke Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for road stroke.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#212a37"
			]
		);
		$this->add_control(
			"road_text_fill",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Road Text Fill Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for road text fill.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#9ca5b3"
			]
		);
		$this->add_control(
			"road_highway",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Road Highway Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for road highway.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#746855"
			]
		);
		$this->add_control(
			"road_highway_stroke",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Road Highway Stroke Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for road highway stroke.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#1f2835"
			]
		);
		$this->add_control(
			"road_highway_text_fill",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Road Highway Text Fill Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for road highway text fill.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#f3d19c"
			]
		);
		$this->add_control(
			"transit",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Transit Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for transit.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#2f3948"
			]
		);
		$this->add_control(
			"transit_station",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Transit Station Text Fill Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for transit station text fill.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#d59563"
			]
		);
		$this->add_control(
			"water",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Water Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for water.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#17263c"
			]
		);
		$this->add_control(
			"water_text_fill",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Water Text Fill Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for water text fill.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#515c6d"
			]
		);
		$this->add_control(
			"water_text_stroke",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Water Text Stroke Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is color option for water text stroke.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#17263c"
			]
		);
		$this->end_controls_section();
			
	}
	
	/**
	 * Render Google Map widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		// Ensure $settings are extracted safely
		$map_height = isset($settings['map_height']) ? $settings['map_height'] : '';
		$map_style = isset($settings['map_style']) ? $settings['map_style'] : '';
		$scroll_wheel = isset($settings['scroll_wheel']) && $settings['scroll_wheel'] == '1' ? 'true' : 'false';
		$map_zoom = isset($settings['map_zoom']) ? $settings['map_zoom'] : '14';
		$default_mstyle = '[]';
	
		$multi_map_values = isset($settings['multi_map']) ? $settings['multi_map'] : [];
		foreach ($multi_map_values as $key => $map) {
			if (isset($map['map_marker']['url'])) {
				$multi_map_values[$key]['map_marker'] = $map['map_marker']['url'];
			}
		}
		$multi_map = json_encode($multi_map_values);

		if ($map_style == 'custom') {
			$default_mattr = ["map_color", "map_text_stroke", "map_text_fill", "administrative", "poi_text_fill", "poi_park", "poi_park_text_fill", "road", "road_stroke", "road_text_fill", "road_highway", "road_highway_stroke", "road_highway_text_fill", "transit", "transit_station", "water", "water_text_fill", "water_text_stroke"];
			$map_styl = [];
			foreach ($default_mattr as $attr) {
				$map_styl[$attr] = !empty($$attr) ? $$attr : '';
			}
			if ($map_styl) {
				$default_mstyle = json_encode([
					["elementType" => "geometry", "stylers" => [["color" => esc_attr($map_styl["map_color"] ?? '')]]],
					["elementType" => "labels.text.stroke", "stylers" => [["color" => esc_attr($map_styl["map_text_stroke"] ?? '')]]],
					["elementType" => "labels.text.fill", "stylers" => [["color" => esc_attr($map_styl["map_text_fill"] ?? '')]]],
					["featureType" => "administrative.locality", "elementType" => "labels.text.fill", "stylers" => [["color" => esc_attr($map_styl["administrative"] ?? '')]]],
					["featureType" => "poi", "elementType" => "labels.text.fill", "stylers" => [["color" => esc_attr($map_styl["poi_text_fill"] ?? '')]]],
					["featureType" => "poi.park", "elementType" => "geometry", "stylers" => [["color" => esc_attr($map_styl["poi_park"] ?? '')]]],
					["featureType" => "poi.park", "elementType" => "labels.text.fill", "stylers" => [["color" => esc_attr($map_styl["poi_park_text_fill"] ?? '')]]],
					["featureType" => "road", "elementType" => "geometry", "stylers" => [["color" => esc_attr($map_styl["road"] ?? '')]]],
					["featureType" => "road", "elementType" => "geometry.stroke", "stylers" => [["color" => esc_attr($map_styl["road_stroke"] ?? '')]]],
					["featureType" => "road", "elementType" => "labels.text.fill", "stylers" => [["color" => esc_attr($map_styl["road_text_fill"] ?? '')]]],
					["featureType" => "road.highway", "elementType" => "geometry", "stylers" => [["color" => esc_attr($map_styl["road_highway"] ?? '')]]],
					["featureType" => "road.highway", "elementType" => "geometry.stroke", "stylers" => [["color" => esc_attr($map_styl["road_highway_stroke"] ?? '')]]],
					["featureType" => "road.highway", "elementType" => "labels.text.fill", "stylers" => [["color" => esc_attr($map_styl["road_highway_text_fill"] ?? '')]]],
					["featureType" => "transit", "elementType" => "geometry", "stylers" => [["color" => esc_attr($map_styl["transit"] ?? '')]]],
					["featureType" => "transit.station", "elementType" => "labels.text.fill", "stylers" => [["color" => esc_attr($map_styl["transit_station"] ?? '')]]],
					["featureType" => "water", "elementType" => "geometry", "stylers" => [["color" => esc_attr($map_styl["water"] ?? '')]]],
					["featureType" => "water", "elementType" => "labels.text.fill", "stylers" => [["color" => esc_attr($map_styl["water_text_fill"] ?? '')]]],
					["featureType" => "water", "elementType" => "labels.text.stroke", "stylers" => [["color" => esc_attr($map_styl["water_text_stroke"] ?? '')]]]
				]);
			}
		}
	echo '<div class="google-map-wrapper">';
		echo '<div class="ceagmap" style="width:100%;height:' . absint($map_height) . 'px;" 
			data-map-style="' . esc_attr($map_style) . '" 
			data-multi-map="true" 
			data-maps="' . esc_js($multi_map) . '" 
			data-wheel="' . esc_attr($scroll_wheel) . '" 
			data-zoom="' . esc_attr($map_zoom) . '" 
			data-custom-style="' . esc_js($default_mstyle) . '"></div>';
		echo '</div><!-- .google-map-wrapper -->';
	}
}