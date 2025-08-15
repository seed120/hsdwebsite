<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Classic Elementor Addon Chart Widget
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Chart_Widget extends Widget_Base {
	
	private $excerpt_len;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Chart widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceachart";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Chart widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Chart", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Chart widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-pie-chart";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Cea Chart widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'chart', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Chart widget belongs to.
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
	 * Retrieve the list of scripts the chart widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'chart-bundle', 'cea-custom-front' ];
	}

	/**
	 * Register Chart widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//General Section
		$this->start_controls_section(
			"general_section",
			[
				"label"	=> esc_html__( "General", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default chart options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"extra_class",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Extra Class", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Put extra class for some additional styles.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_responsive_control(
			"chart_width",
			[
				"type"			=> Controls_Manager::NUMBER,
				"label"			=> esc_html__( "Chart Width", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can specify chart width. Example 800", 'classic-elementor-addons-pro' ),
				"default" 		=> "800"
			]
		);
		$this->add_responsive_control(
			"chart_height",
			[
				"type"			=> Controls_Manager::NUMBER,
				"label"			=> esc_html__( "Chart Height", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can specify chart height. Example 300", 'classic-elementor-addons-pro' ),
				"default" 		=> "300"
			]
		);
		$this->add_control(
			"chart_type",
			[
				"label"			=> esc_html__( "Chart Type", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "pie",
				"options"		=> [
					"pie"		=> esc_html__( "Pie Chart", 'classic-elementor-addons-pro' ),
					"doughnut"	=> esc_html__( "Doughnut Chart", 'classic-elementor-addons-pro' ),
					"bar"		=> esc_html__( "Bar Chart", 'classic-elementor-addons-pro' ),
					"line"		=> esc_html__( "Line Chart", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->add_control(
			"yaxis_zorobegining",
			[
				"label" 		=> esc_html__( "Y-Axis Zero Beginning", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for set y-axis zero value beginning.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "yes",
				"condition" 	=> [
					"chart_type" 	=> array( "bar", "line" )
				]
			]
		);
		$this->add_control(
			"chart_bg",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Dots Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can specify chart dots color. Example #1555bd", 'classic-elementor-addons-pro' ),
				"default" 		=> "#1555bd",
				"condition" 	=> [
					"chart_type" 	=> "line"
				]
			]
		);
		$this->add_control(
			"chart_border",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Line Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can specify chart ,line color. Example #4580e0", 'classic-elementor-addons-pro' ),
				"default" 		=> "#1555bd",
				"condition" 	=> [
					"chart_type" 	=> "line"
				]
			]
		);
		$this->add_control(
			"chart_fill",
			[
				"label" 		=> esc_html__( "Chart Fill", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for fill chart.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "yes",
				"condition" 	=> [
					"chart_type" 	=> "line"
				]
			]
		);
		$this->add_control(
			"chart_responsive",
			[
				"label" 		=> esc_html__( "Chart Responsive", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for responsive chart.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "yes"
			]
		);
		$this->add_control(
			"legend_position",
			[
				"label"			=> esc_html__( "Chart Legend Position", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "top",
				"options"		=> [
					"none"		=> esc_html__( "None", 'classic-elementor-addons-pro' ),
					"bottom"    => esc_html__( "Bottom", 'classic-elementor-addons-pro' ),
					"right"     => esc_html__( "Right", 'classic-elementor-addons-pro' ),
					"left"      => esc_html__( "Left", 'classic-elementor-addons-pro' ),
					"top"		=> esc_html__( "Top", 'classic-elementor-addons-pro' )
				]
			]
		);
		
		$repeater = new Repeater();
		
		$repeater->add_control(
			"chart_labels",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Chart Label", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Chart item label.", 'classic-elementor-addons-pro' )
			]
		);	
		$repeater->add_control(
			"chart_values",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Chart Value", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Chart item value.", 'classic-elementor-addons-pro' )
			]
		);	
		$repeater->add_control(
			"chart_colors",
			[
				"type"			=> Controls_Manager::COLOR,
				"label" 		=> esc_html__( "Chart Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Chart item color.", 'classic-elementor-addons-pro' )
			]
		);	
		$this->add_control(
			"chart_details",
			[
				"label"			=> esc_html__( "Chart Details", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is options for put chart item labels and values.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::REPEATER,
				"fields"		=> $repeater->get_controls(),
				"default"		=> [
					[
						"chart_labels" 	=> esc_html__( "HTML", 'classic-elementor-addons-pro' ),
						"chart_values"	=> "25",
						"chart_colors"	=> "#FF3D67"
					],
					[
						"chart_labels" 	=> esc_html__( "PHP", 'classic-elementor-addons-pro' ),
						"chart_values"	=> "30",
						"chart_colors"	=> "#36A2EB"
					],
					[
						"chart_labels" 	=> esc_html__( "WordPress", 'classic-elementor-addons-pro' ),
						"chart_values"	=> "45",
						"chart_colors"	=> "#FFCE56"
					]
				],
				"title_field"	=> "{{{ chart_labels }}}"				
			]
		);		
		$this->end_controls_section();
		
		// Style Chart Section
		$this->start_controls_section(
			'section_style_chart',
			[
				'label' => __( 'Chart', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'chart_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'chart_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'chart_border',
				'selector' => '{{WRAPPER}} .elementor-widget-container',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'chart_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'chart_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-widget-container'
			]
		);
		$this->add_control(
			'chart_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();	

	}

	/**
	 * Render Chart widget output on the frontend.
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
		$class = isset( $extra_class ) && $extra_class != '' ? $extra_class : '';	
		$title = isset( $title ) && $title != '' ? $title : '';
		$chart_type = isset( $chart_type ) && $chart_type != '' ? $chart_type : 'pie';
		$chart_width = isset( $chart_width ) && $chart_width != '' ? $chart_width : '800';
		$chart_height = isset( $chart_height ) && $chart_height != '' ? $chart_height : '300';
		$yaxis = isset( $yaxis_zorobegining ) && $yaxis_zorobegining == 'yes' ? true : false;
		
		$chart_bg = isset( $chart_bg ) && $chart_bg != '' ? $chart_bg : '#1555bd';		
		$chart_border = isset( $chart_border ) && $chart_border != '' ? $chart_border : '#4580e0';
		
		$chart_fill = isset( $chart_fill ) && $chart_fill == 'yes' ? true : false;
		$chart_responsive = isset( $chart_responsive ) && $chart_responsive == 'yes' ? true : false;
		$legend_position = isset( $legend_position ) && $legend_position != '' ? $legend_position : 'top';
		
		$chart_details =  isset( $chart_details ) ? $chart_details : ''; // $prc_fetrs is pricing features
		$chart_labels = $chart_values = $chart_colors = '';
		if( $chart_details ){
			foreach( $chart_details as $chart_detail ) {
				$chart_labels .= isset( $chart_detail['chart_labels'] ) ? $chart_detail['chart_labels'] . ',' : '';
				$chart_values .= isset( $chart_detail['chart_values'] ) ? $chart_detail['chart_values'] .',' : '';
				$chart_colors .= isset( $chart_detail['chart_colors'] ) ? $chart_detail['chart_colors'] .',' : '#333333';
			}
			$chart_labels = rtrim( $chart_labels, ',' );
			$chart_values = rtrim( $chart_values, ',' );
			$chart_colors = rtrim( $chart_colors, ',' );
		}
		$chart_rand_id = $rand_class = 'chart-rand-' . cea_shortcode_rand_id();
		switch( $chart_type ){
			case "pie":
				echo '<canvas id="'. esc_attr( $chart_rand_id ) .'" class="pie-chart" width="'. esc_attr( $chart_width ) .'" height="'. esc_attr( $chart_height ) .'" data-type="pie" data-labels="'. esc_attr( $chart_labels ) .'" data-values="'. esc_attr( $chart_values ) .'" data-backgrounds="'. esc_attr( $chart_colors ) .'" data-responsive="'. esc_attr( $chart_responsive ) .'" data-legend-position="'. esc_attr( $legend_position ) .'"></canvas>';
			break;
			case "doughnut":
				echo '<canvas id="'. esc_attr( $chart_rand_id ) .'" class="pie-chart" width="'. esc_attr( $chart_width ) .'" height="'. esc_attr( $chart_height ) .'" data-type="doughnut" data-labels="'. esc_attr( $chart_labels ) .'" data-values="'. esc_attr( $chart_values ) .'" data-backgrounds="'. esc_attr( $chart_colors ) .'" data-responsive="'. esc_attr( $chart_responsive ) .'" data-legend-position="'. esc_attr( $legend_position ) .'"></canvas>';
			break;
			case "bar":
				echo '<canvas id="'. esc_attr( $chart_rand_id ) .'" class="pie-chart" width="'. esc_attr( $chart_width ) .'" height="'. esc_attr( $chart_height ) .'" data-type="bar" data-labels="'. esc_attr( $chart_labels ) .'" data-values="'. esc_attr( $chart_values ) .'" data-backgrounds="'. esc_attr( $chart_colors ) .'" data-responsive="'. esc_attr( $chart_responsive ) .'" data-legend-position="'. esc_attr( $legend_position ) .'" data-yaxes-zorobegining="'. esc_attr( $yaxis ) .'"></canvas>';
			break;
			case "line":
				echo '<canvas id="'. esc_attr( $chart_rand_id ) .'" class="line-chart" width="'. esc_attr( $chart_width ) .'" height="'. esc_attr( $chart_height ) .'" data-labels="'. esc_attr( $chart_labels ) .'" data-values="'. esc_attr( $chart_values ) .'" data-background="'. esc_attr( $chart_bg ) .'" data-border="'. esc_attr( $chart_border ) .'" data-fill="'. esc_attr( $chart_fill ) .'" data-responsive="'. esc_attr( $chart_responsive ) .'" data-legend-position="'. esc_attr( $legend_position ) .'" data-yaxes-zorobegining="'. esc_attr( $yaxis ) .'"></canvas>';
			break;
		}
	}
	
}