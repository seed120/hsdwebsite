<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Classic Elementor Addon Timeline
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Timeline_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Timeline widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceatimeline";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Timeline widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Timeline", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Timeline widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-notepad";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Timeline widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'time', 'timeline', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Timeline widget belongs to.
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
	 * Register Timeline widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//Layouts Section
		$this->start_controls_section(
			"layouts_section",
			[
				"label"			=> esc_html__( "Layouts", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Layouts options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"timeline_style",
			[
				"label"			=> esc_html__( "Timeline Style", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can choose the Time Line view type.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "1",
				"options"		=> [
					"1"		=> esc_html__( "Style 1", 'classic-elementor-addons-pro' ),
					"2"		=> esc_html__( "Style 2", 'classic-elementor-addons-pro' ),
					"3"		=> esc_html__( "Style 3", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->add_control(
			"timeline_layout",
			[
				"label"			=> esc_html__( "Timeline Layout", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for timeline layout. If you choose left/right layout, then this option set the timeline position same side.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "default",
				"options"		=> [
					"default"	=> esc_html__( "Default", 'classic-elementor-addons-pro' ),
					"left"		=> esc_html__( "Left Layout", 'classic-elementor-addons-pro' ),
					"right"		=> esc_html__( "Right Layout", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->add_control(
			"timeline_line",
			[
				"label"			=> esc_html__( "History Line Style", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for timeline history line style.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "default",
				"options"		=> [
					"solid"		=> esc_html__( "Solid", 'classic-elementor-addons-pro' ),
					"dotted"	=> esc_html__( "Dotted", 'classic-elementor-addons-pro' ),
					"dashed"	=> esc_html__( "Dashed", 'classic-elementor-addons-pro' )
				],
				'selectors' => [
					'{{WRAPPER}} .timeline:before' => 'border-right-style: {{VALUE}};'
				]
			]
		);
		$this->end_controls_section();
		
		//Timeline Section
		$this->start_controls_section(
			"timeline_section",
			[
				"label"			=> esc_html__( "Timeline", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Timeline options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			"timeline_pos",
			[
				"label"			=> esc_html__( "Timeline Position", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for timeline position. Either same side or opposite side.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "same",
				"options"		=> [
					"same"	=> esc_html__( "Same Side", 'classic-elementor-addons-pro' ),
					"opp"	=> esc_html__( "Opposite Side", 'classic-elementor-addons-pro' )
				]
			]
		);
		$repeater->add_control(
			"timeline_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Timeline Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the timeline title.", 'classic-elementor-addons-pro' )
			]
		);
		$repeater->add_control(
			"timeline_subtitle",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Timeline Sub Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the timeline sub title.", 'classic-elementor-addons-pro' ),
				"default"		=> ""
			]
		);
		$repeater->add_control(
			"separator_shape",
			[
				"label"			=> esc_html__( "Separator Shape", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is options for separator shape.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "sq",
				"options"		=> [
					"sq"	=> esc_html__( "Square", 'classic-elementor-addons-pro' ),
					"rounded"	=> esc_html__( "Rounded", 'classic-elementor-addons-pro' ),
					"rounded-circle"	=> esc_html__( "Circle", 'classic-elementor-addons-pro' ),
					"3"		=> esc_html__( "Triangle", 'classic-elementor-addons-pro' ),
					"5"		=> esc_html__( "Pentagon", 'classic-elementor-addons-pro' ),
					"6"		=> esc_html__( "Hexagon", 'classic-elementor-addons-pro' ),
					"7"		=> esc_html__( "Heptagon", 'classic-elementor-addons-pro' ),
					"8"		=> esc_html__( "Octagon", 'classic-elementor-addons-pro' ),
					"9"		=> esc_html__( "Nonagon", 'classic-elementor-addons-pro' ),
					"10"	=> esc_html__( "Decagon", 'classic-elementor-addons-pro' )
				]
			]
		);
		$repeater->add_control(
			"separator_type",
			[
				"label"			=> esc_html__( "Separator Type", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for timeline separator type either icon/image/text. If no need separator, then choose none.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "none",
				"options"		=> [
					"none"	=> esc_html__( "None", 'classic-elementor-addons-pro' ),
					"icon"	=> esc_html__( "Icon", 'classic-elementor-addons-pro' ),
					"img"	=> esc_html__( "Image", 'classic-elementor-addons-pro' ),
					"txt"	=> esc_html__( "Text", 'classic-elementor-addons-pro' )
				]
			]
		);
		$repeater->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'ti-heart',
					'library' => 'themify',
				],
				"condition" 	=> [
					"separator_type" 	=> "icon"
				]
			]
		);
		$repeater->add_control(
			"separator_image",
			[
				"type"	=> Controls_Manager::MEDIA,
				"label" => __( "Separator Image", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose separator image.", 'classic-elementor-addons-pro' ),
				"condition" 	=> [
					"separator_type" 	=> "img"
				]
			]
		);
		$repeater->add_control(
			"separator_text",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Separator Text", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for showing text on separator.", 'classic-elementor-addons-pro' ),
				"condition" 	=> [
					"separator_type" 	=> "txt"
				]
			]
		);
		$repeater->add_control(
			"separator_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Separator Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the timeline separator color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper {{CURRENT_ITEM}} .timeline-badge' => 'color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			"separator_bgcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Separator Bg Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the timeline separator color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "#333333",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper {{CURRENT_ITEM}} .timeline-badge' => 'background-color: {{VALUE}};'
				]
			]
		);
		$repeater->add_control(
			"separator_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Separator Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the timeline separator title.", 'classic-elementor-addons-pro' )
			]
		);
		$repeater->add_control(
			"separator_subtitle",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Separator Sub Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the timeline separator sub title.", 'classic-elementor-addons-pro' )
			]
		);
		$repeater->add_control(
			"tl_content",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Content", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "You can give the feature box content here. HTML allowed here.", 'classic-elementor-addons-pro' ),
				"default" 		=> ""
			]
		);

		$this->add_control(
			"timeline_settings",
			[
				"label"		=> esc_html__( "Timeline Settings", 'classic-elementor-addons-pro' ),
				"type"		=> Controls_Manager::REPEATER,
				"fields"	=> $repeater->get_controls(),
				"default" => [
					[
						"timeline_title" 	=> esc_html__( "History 1", 'classic-elementor-addons-pro' ),
						"separator_shape" 	=> "rounded-circle",
						"separator_type"	=> "icon",
						"separator_color"	=> "#ffffff",
						"separator_bgcolor"	=> "#000000",
						"separator_title"	=> "2012",
						"separator_subtitle"=> esc_html__( "started", 'classic-elementor-addons-pro' ),
						"tl_content"		=> esc_html__( "Lorem ipsum dolor sit amet, consectetur adipiscing elit.", 'classic-elementor-addons-pro' )
					]
				],
				"title_field"	=> "{{{ timeline_title }}}",
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
			'timeline_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'timeline_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);		
		$this->add_control(
			"timeline_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put timeline font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			"timeline_background_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Background Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put timeline background color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_typography',
				'selector' 		=> '{{WRAPPER}} .timeline-wrapper'
			]
		);		
		$this->end_controls_section();
		
		// Style Timeline Content Section
		$this->start_controls_section(
			'section_style_tl_content',
			[
				'label' => __( 'Timeline Content', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);	
		$this->start_controls_tabs( 'tl_content_styles' );
		$this->start_controls_tab(
			'tl_content_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .timeline-wrapper .timeline-panel:after' => 'border-left-color: {{VALUE}}; border-right-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"font_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Font Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"shadow_opt",
			[
				"label" 		=> esc_html__( "Box Shadow Enable", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show box shadow on timeline content hover.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"timeline_content_box_shadow",
			[
				"label" 		=> esc_html__( "Box Shadow", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show box shadow on timeline content hover.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::BOX_SHADOW,
				'condition' => [
					'shadow_opt' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{timeline_content_box_shadow_pos.VALUE}};',
				]
			]
		);
		$this->add_control(
			"timeline_content_box_shadow_pos",
			[
				'label' =>  esc_html__( "Box Shadow Position", 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					' ' => esc_html__( "Outline", 'classic-elementor-addons-pro' ),
					'inset' => esc_html__( "Inset", 'classic-elementor-addons-pro' ),
				],
				'condition' => [
					'shadow_opt' => 'yes',
				],
				'default' => ' ',
				'render_type' => 'ui',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tl_content_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'bg_hcolor',
			[
				'label' => esc_html__( 'Hover Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel:hover' => 'background-color: {{VALUE}};',					
					'{{WRAPPER}} .timeline-wrapper .timeline-panel:hover:after' => 'border-left-color: {{VALUE}}; border-right-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			"font_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Hover Font Color", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"shadow_hopt",
			[
				"label" 		=> esc_html__( "Box Shadow Enable", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show box shadow on timeline content hover.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"timeline_content_hbox_shadow",
			[
				"label" 		=> esc_html__( "Hover Box Shadow", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show box shadow on timeline content hover.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::BOX_SHADOW,
				'condition' => [
					'shadow_hopt' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{timeline_content_hbox_shadow_pos.VALUE}};',
				]
			]
		);
		$this->add_control(
			"timeline_content_hbox_shadow_pos",
			[
				'label' =>  esc_html__( "Box Shadow Position", 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					' ' => esc_html__( "Outline", 'classic-elementor-addons-pro' ),
					'inset' => esc_html__( "Inset", 'classic-elementor-addons-pro' ),
				],
				'condition' => [
					'shadow_hopt' => 'yes',
				],
				'default' => ' ',
				'render_type' => 'ui',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'tl_title_label',
			[
				'label' => esc_html__( 'Timeline Title', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tl_title_styles' );
		$this->start_controls_tab(
			'tl_title_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"tl_title_font_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Font Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel .timeline-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tl_title_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"tl_title_font_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Hover Font Color", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel:hover .timeline-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		
		$this->add_control(
			'tl_separator_label',
			[
				'label' => esc_html__( 'Timeline Separator', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"tl_separator_title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Separator Title Color", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-sep-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"tl_subtitle_content_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Separator Content Color", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-sep-title > span' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"tl_separator_shape_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Separator Shape Color", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-badge' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"tl_separator_shape_bg",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Separator Shape Bg", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-badge' => 'background-color: {{VALUE}};'
				]
			]
		);		
		$this->add_control(
			'tl_border',
			[
				'label' => esc_html__( 'Timeline Border', 'plugin-name' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			"tl_border_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Border Color", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .timeline:before' => 'border-right-color: {{VALUE}};'
				]
			]
		);
		
		$this->end_controls_section();		
			
	}
	
	/**
	 * Render Timeline widget output on the frontend.
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
		$class = isset( $timeline_style ) && $timeline_style != '' ? ' timeline-style-'.$timeline_style : ''; 
				
		$output = '';
		echo '<div class="timeline-wrapper'. esc_attr( $class ) .'">';
		
		// All Timeline Items
		$tl_items = isset( $timeline_settings ) ? $timeline_settings : '';
		
		if( $tl_items ):
			$tl_layout = isset( $timeline_layout ) ? $timeline_layout : '';
			$layout_class = $timeline_layout != 'default' ? ' tl-' . $timeline_layout . '-layout' : '';
			echo '<ul class="timeline'. esc_attr( $layout_class ) .'">';
			if( isset( $tl_items ) && !empty( $tl_items ) ){
				foreach( $tl_items as $tlitem ) {
					
					$tl_rand_class = 'timeline-rand-'. cea_shortcode_rand_id();
					$tl_pos = isset( $tlitem['timeline_pos'] ) ? $tlitem['timeline_pos'] : '';
					$li_class = '';
					if( $tl_layout == 'default' ){
						$li_class .= $tl_pos == 'opp' ? ' timeline-inverted' : '';
					}elseif( $tl_layout == 'left' ){
						$li_class .= ' timeline-inverted';
					}
					$tl_title = isset( $tlitem['timeline_title'] ) ? $tlitem['timeline_title'] : '';
					$tl_stitle = isset( $tlitem['timeline_subtitle'] ) ? $tlitem['timeline_subtitle'] : '';
					$tl_content = isset( $tlitem['tl_content'] ) ? $tlitem['tl_content'] : '';
					
					$separator_type = isset( $tlitem['separator_type'] ) ? $tlitem['separator_type'] : 'none';
					$sep_out = '';
					switch( $separator_type ){
						case "icon":
						
							/* Icon Code */
							if ( empty( $tlitem['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
								$tlitem['icon'] = 'ti-heart';
							}
							if ( ! empty( $tlitem['icon'] ) ) {
								$this->add_render_attribute( 'icon', 'class', $tlitem['icon'] );
								$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
							}
							$migrated = isset( $tlitem['__fa4_migrated']['selected_icon'] );
							$is_new = empty( $tlitem['icon'] ) && Icons_Manager::is_migration_allowed();
						
							ob_start();
							if ( $is_new || $migrated ) :
								Icons_Manager::render_icon( $tlitem['selected_icon'], [ 'aria-hidden' => 'true' ] );
							else : ?>
								<i <?php echo $this->get_render_attribute_string( 'icon' ) ?>></i>
							<?php endif;							
							$sep_out = ob_get_clean();
						break;
						case "img":
							$sep_image = isset( $tlitem['separator_image'] ) ? $tlitem['separator_image'] : '';
							if( isset( $sep_image['id'] ) ){
								$sep_image = $sep_image['id'];
								$img_attr = wp_get_attachment_image_src( absint( $sep_image ), 'full', true );
								$image_alt = get_post_meta( absint( $sep_image ), '_wp_attachment_image_alt', true);
								$sep_out = isset( $img_attr[0] ) ? '<img class="img-fluid" src="'. esc_url( $img_attr[0] ) .'" width="'. esc_attr( $img_attr[1] ) .'" height="'. esc_attr( $img_attr[2] ) .'" alt="'. esc_attr( $image_alt ) .'" />' : '';
								$li_class .= ' sep-img-activated';
							}
						break;
						case "txt":
							$sep_text = isset( $tlitem['separator_text'] ) ? $tlitem['separator_text'] : '';
							$sep_out = '<span class="separator-text">'. esc_html( $sep_text ) .'</span>';
						break;
						default:
							$sep_out = '<span class="separator-empty"></span>';
						break;
					}
					
					$sep_title = isset( $tlitem['separator_title'] ) && $tlitem['separator_title'] != '' ? $tlitem['separator_title'] : '';
					$sep_stitle = isset( $tlitem['separator_subtitle'] ) && $tlitem['separator_subtitle'] != '' ? $tlitem['separator_subtitle'] : '';
					$sep_tit_out = '';
					if( $sep_title != '' || $sep_stitle != '' ){
						$sep_tit_out .= $sep_title != '' ? esc_html( $sep_title ) : '';
						$sep_tit_out .= $sep_stitle != '' ? '<span>'. esc_html( $sep_stitle ) .'</span>' : '';
					}
					
					$sep_class = '';
					$sep_bg_stat = 1;
					if( $sep_out ){
						if( isset( $tlitem['separator_shape'] ) ){
							if( is_numeric( $tlitem['separator_shape'] ) ){
								$sep_class = ' separator-shape-custom';
								$sep_bg = isset( $tlitem['separator_bgcolor'] ) ? $tlitem['separator_bgcolor'] : '#333';
								$sep_out .= '<canvas id="canvas_agon" class="canvas_agon" width=50 height=50 data-size="25" data-side="'. esc_attr( $tlitem['separator_shape'] ) .'" data-color="'. esc_attr( $sep_bg ) .'"></canvas>';
								$sep_bg_stat = 0;
							}else{
								$sep_class = ' '.$tlitem['separator_shape'];
							}
						}else{
							$sep_class = ' '. $tlitem['separator_shape'];
						}
					}
					
					$li_class .= ' elementor-repeater-item-'. esc_attr( $tlitem['_id'] );
					
					echo '<li class="'. esc_attr( $li_class ) .'">';
						
						echo $sep_out != '' ? '<div class="timeline-badge'. esc_attr( $sep_class ) .'">'. ( $sep_out ) .'</div>' : '';
						echo $sep_tit_out != '' ? '<div class="timeline-sep-title">'. wp_kses_post( $sep_tit_out ) .'</div>' : '';
					
						echo '<div class="timeline-panel">';
							if( $tl_title || $tl_stitle ):
								echo '<div class="timeline-heading">';
									echo $tl_title != '' ? '<h4 class="timeline-title">'. esc_html( $tl_title ) .'</h4>' : '';
									echo $tl_stitle != '' ? '<p><small class="text-muted">'. wp_kses_post( $tl_stitle ) .'</small></p>' : '';
								echo '</div>';
							endif;
							
							if( $tl_content ):
								echo '<div class="timeline-body">';
									echo do_shortcode( $tl_content );
								echo '</div>';
							endif;
							
						echo '</div>';
					echo '</li><!-- .timeline item li -->';
					
				}// foreach
			}//end if
			echo '</ul>';
		endif;
							
		echo '</div><!-- .timeline-wrapper -->';		

	}
		
}