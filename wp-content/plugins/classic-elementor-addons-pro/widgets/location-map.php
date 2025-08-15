<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class CEA_Location_Map extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Cea Marquee widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'cealocationmap';
	}
	/**
	 * Get widget title.
	 *
	 * Retrieve Cea Marquee widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Location Map', 'classic-elementor-addons-pro' );
	}
	/**
	 * Get widget icon.
	 *
	 * Retrieve Cea Marquee widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'cea-default-icon eicon-map-pin';
	}
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Cea Marquee widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'classic-elements' ];
	}
	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Cea Marquee widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'map', 'location', 'classic' ];
    }
	public function get_script_depends() {
		return [
			'amcharts-core',
			'amcharts-maps',
			'amcharts-theme-animated',
            'amcharts-geodata-france',
			'cea-custom-front'
		];
	}
	protected function register_controls() {
		$this->start_controls_section(
			'map_settings',
			[
				'label' => __( 'Region Links', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'focus_country',
			[
				'label' => __( 'Focus Country (ISO-2 Code)', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'IN',
			]
		);
        $this->add_control(
            'city_links',
            [
                'label' => __( 'City Links', 'classic-elementor-addons-pro' ),
                'type'  => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'city_id',
                        'label' => __( 'City Id', 'classic-elementor-addons-pro' ),
                        'type'  => \Elementor\Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'city_name',
                        'label' => __( 'City Name', 'classic-elementor-addons-pro' ),
                        'type'  => \Elementor\Controls_Manager::TEXT,
                    ],
                    [
                        'name' => 'city_url',
                        'label' => __( 'Redirect URL', 'classic-elementor-addons-pro' ),
                        'type'  => \Elementor\Controls_Manager::URL,
                    ],
                ],
            ]
        );
		$this->add_control(
			'map_color',
			[
				'label'		=> 	__( 'Map Color', 'classic-elementor-addons-pro' ),
				'type'		=>  \Elementor\Controls_Manager::COLOR,
				'default'	=> '#f1f1f1',
				'separator'	=> 'before',
			]
		);
		$this->add_control(
			'map_hover_color',
			[
				'label'		=> 	__( 'Map Hover Color', 'classic-elementor-addons-pro' ),
				'type'		=>  \Elementor\Controls_Manager::COLOR,
				'default'	=> '#000',
				'separator'	=> 'before',
			]
		);
		$this->add_control(
			'map_border',
			[
				'label'		=> 	__( 'Map Border Color', 'classic-elementor-addons-pro' ),
				'type'		=>  \Elementor\Controls_Manager::COLOR,
				'default'	=> '#000',
				'separator'	=> 'before',
			]
		);
		$this->add_control(
			'map_border_width',
			[
				'label'		=> 	__( 'Map Border Width', 'classic-elementor-addons-pro' ),
				'type'		=>  \Elementor\Controls_Manager::NUMBER,
				'default'	=>  2,
				'separator'	=> 'before',
			]
		);
		$this->end_controls_section();
	}

    protected function render() {
        $settings       = $this->get_settings_for_display();
		$map_clr = $settings['map_color'];
		$map_hr_clr = $settings['map_hover_color'];
		$map_br_clr = $settings['map_border'];
		$map_br_width = $settings['map_border_width'];
		$map_attr = array(
			'map_color' => $map_clr,
			'map_hover' => $map_hr_clr,
			'map_border' => $map_br_clr,
			'border_width' => $map_br_width
		);

		$map_attr = is_array( $map_attr ) ? htmlspecialchars( json_encode( $map_attr ), ENT_QUOTES, 'UTF-8' ) : '';
        echo '<div class="cea-map-widget" id="cea-map-' . esc_attr( $this->get_id() ) . '" data-map="'. esc_attr( $map_attr ) .'">';
        echo '<div class="cea-map-container" style="height:500px"></div>';
        echo '<script type="application/json" class="cea-state-data">' . wp_json_encode( $settings['city_links'] ) . '</script>';
        echo '</div>';
    }
}
