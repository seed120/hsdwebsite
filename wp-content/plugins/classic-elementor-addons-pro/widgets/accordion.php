<?php


namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Cea Accordion
 *
 * @since 1.0.0
 */
 
use Classic_Elementor_Addons\Helper\Post_Helper as Cea_Post_Helper;
 
class CEA_Elementor_Accordion_Widget extends Widget_Base {
	use Cea_Post_Helper;
	/**
	 * Get widget name.
	 *
	 * Retrieve Cea Accordion widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceaaccordion";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Cea Accordion widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Accordion", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Cea Accordion widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-accordion-merged";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Cea Accordion widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'accordion', 'classic' ];
    }

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Cea Accordion widget belongs to.
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
		return [ 'cea-custom-front'  ];
	}

	/**
	 * Register Cea Accordion widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//get templates
		$templates = $this->cea_get_elementor_templates();
		//General Section
		$this->start_controls_section(
			"general_section",
			[
				"label"	=> esc_html__( "General", 'classic-elementor-addons-pro' ),
				"accordion"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default accordion options.", 'classic-elementor-addons-pro' ),
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
		$this->end_controls_section();		
		
		//Accordion Section
		$this->start_controls_section(
			"cea_accordion_section",
			[
				"label"	=> esc_html__( "Accordion", 'classic-elementor-addons-pro' ),
				"accordion"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Accordion options.", 'classic-elementor-addons-pro' ),
			]
		);
		$repeater = new Repeater();		
		$repeater->add_control(
			"cea_accordion_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "accordion title.", 'classic-elementor-addons-pro' )
			]
		);		
		$repeater->add_control(
			'accordion_type',
			[
				'label' => esc_html__( 'Type', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				"default"		=> "content",
				'options' => [
					'content' => [
						'title' => esc_html__( 'Text Content', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text',
					],
					'element' => [
						'title' => esc_html__( 'HTML Element', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-code-bold',
					],
					'templates' => [
						'title' => esc_html__( 'Saved Templates', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-library-open',
					]					
				],
				'toggle' => false,
			]
		);
		$repeater->add_control(
			"cea_accordion_content",
			[
				"label"			=> esc_html__( "Accordion Content", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::WYSIWYG,
				"description" 	=> esc_html__( "You can place here accordion content.", 'classic-elementor-addons-pro' ),
				"default"		=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.",
				'condition' => [
					'accordion_type' => 'content',
				],
			]
		);		
		$repeater->add_control(
			"cea_element_id",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Element ID", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter element id", 'classic-elementor-addons-pro' ),
				'condition' => [
					'accordion_type' => 'element',
				],
			]
		);	
		$repeater->add_control(
			'ele_templates',
			[
				'label' 	=> __( 'Choose Templates', 'classic-elementor-addons-pro' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> $templates,
				'separator' => 'before',
				'condition' => [
					'accordion_type' => 'templates',
				],
			]
		);
		
		$this->add_control(
			"accordion_list",
			[
				"type"			=> Controls_Manager::REPEATER,
				"label"			=> esc_html__( "Accordion List", 'classic-elementor-addons-pro' ),
				"fields"		=> $repeater->get_controls(),
				"default" 		=> [
					[
						"cea_accordion_title" 	=> esc_html__( "Title 1", 'classic-elementor-addons-pro' ),
						"accordion_type" => "content",
						"cea_element_id"	=> "",
						"cea_accordion_content"	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.",
						"ele_templates" => ""
					],
					[
						"cea_accordion_title" 	=> esc_html__( "Title 2", 'classic-elementor-addons-pro' ),
						"accordion_type" => "content",
						"cea_element_id"	=> "",
						"cea_accordion_content"	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.",
						"ele_templates" => ""
					],
				],
				"title_field"	=> "{{{ cea_accordion_title }}}"
			]
		);	
		$this->add_control(
			"multi_open",
			[
				"label" 		=> esc_html__( "Multi Open", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for off the accordion toggle.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'add_search_filter',
			[
				"label" 		=> esc_html__( "Enable Search Filter?", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for the Searching through the accordion.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'add_search_title',
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Search Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter search title to be displayed on the top of Search", 'classic-elementor-addons-pro' ),
				'condition' => [
					'add_search_filter' => 'yes',
				],
			]
		);
		$this->add_control(
			'add_search_placeholder',
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Search Placeholder", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter search title to be displayed on the Search Placeholder", 'classic-elementor-addons-pro' ),
				'condition' => [
					'add_search_filter' => 'yes',
				],
			]
		);
		$this->add_control(
			'selected_icon',
			[
				'label' 		=> esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::ICONS,
				'separator' 	=> 'before',
				'fa4compatibility' => 'icon',
				'default' 		=> [
					'value' => 'ti-plus',
					'library' => 'themify'
				],
				'recommended' 	=> [
					'fa-solid' 	=> [
						'chevron-down',
						'angle-down',
						'angle-double-down',
						'caret-down',
						'caret-square-down',
					],
					'fa-regular' => [
						'caret-square-down',
					],
					'themify' => [
						'angle-down',
						'angle-double-down',
						'plus',
					]
				],
				'skin' => 'inline',
				'label_block' => false,
			]
		);
		$this->add_control(
			'selected_active_icon',
			[
				'label' => esc_html__( 'Active Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon_active',
				'default' => [
					'value' => 'ti-minus',
					'library' => 'themify'
				],
				'recommended' => [
					'fa-solid' => [
						'chevron-up',
						'angle-up',
						'angle-double-up',
						'caret-up',
						'caret-square-up',
					],
					'fa-regular' => [
						'caret-square-up',
					],
					'themify' => [
						'angle-up',
						'angle-double-up',
						'minus',
					]
				],
				'skin' => 'inline',
				'label_block' => false,
				'condition' => [
					'selected_icon[value]!' => '',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label'	=> esc_html__('Icon Size', 'classic-elementor-addons-pro' ),
				'type'	=> Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
			]
		);
		$this->add_control(
			'icon_pos',
			[
				'label' => esc_html__( 'Icon Alignment', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Start', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'End', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => is_rtl() ? 'right' : 'left',
				'toggle' => false,
			]
		);		
		$this->end_controls_section();
		
		// Style Accordion Section
		$this->start_controls_section(
			'section_style_accordion',
			[
				'label' => __( 'Accordion', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'accordion_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-elementor-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'accordion_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-elementor-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'accordion_border',
				'selector' => '{{WRAPPER}} .cea-accordion-elementor-widget',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'accordion_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-elementor-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'accordion_box_shadow',
				'selector' => '{{WRAPPER}} .cea-accordion-elementor-widget'
			]
		);
		$this->add_control(
			'accordion_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-elementor-widget' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'accordion_spacing',
			[
				'label' => esc_html__( 'Accordion Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-accordions > .cea-accordion:not(first-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-accordions > .cea-accordion:not(first-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();	
		
		// Style Title Section
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .cea-accordion-header > a'
			]
		);
		$this->start_controls_tabs( 'accordion_title_styles' );
		$this->start_controls_tab(
			'accordion_title_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'accordion_title_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a:hover, {{WRAPPER}} .cea-accordion-header > a.active' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_bg_hcolor',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a:hover, {{WRAPPER}} .cea-accordion-header > a.active' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			"title_tag",
			[
				"label"			=> esc_html__( "Title Tag", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "div",
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
				],
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .cea-accordion-header > a',
			]
		);
		$this->add_control(
			'title_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'title_align',
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
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_control(
			'icon_styles',
			[
				'label' => __( 'Icon Styles', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'accordion_icon_styles' );
		$this->start_controls_tab(
			'accordion_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a .elementor-accordion-icon > span > *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'accordion_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'icon_hcolor',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header > a:hover .elementor-accordion-icon > span > *, {{WRAPPER}} .cea-accordion-header > a.active .elementor-accordion-icon > span > *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'icon_margin',
			[
				'label' => esc_html__( 'Icon Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-header .elementor-accordion-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();	
		
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .cea-accordion-content'
			]
		);	
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-content' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-content' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'content_align',
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
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-pane' => 'text-align: {{VALUE}};',
				],
				'default' => '',
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
	
	}
	
	/**
	 * Render Accordion widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	 
	public function render_content() {
		/**
		 * Before widget render content.
		 *
		 * Fires before Elementor widget is being rendered.
		 *
		 * @since 1.0.0
		 *
		 * @param Widget_Base $this The current widget.
		 */
		do_action( 'elementor/widget/before_render_content', $this );
	
		ob_start();
	
		$skin = $this->get_current_skin();
		if ( $skin ) {
			$skin->set_parent( $this );
			$skin->render();
		} else {
			$this->render();
		}
	
		$widget_content = ob_get_clean();
		
		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$class = isset( $extra_class ) && $extra_class != '' ? ' ' . $extra_class : '';
		$multi_open = isset( $multi_open ) && $multi_open == 'yes' ? true : false;		
		?>
		
		<div class="elementor-widget-container cea-accordion-elementor-widget<?php echo esc_attr( $class ); ?>" data-toggle="<?php echo esc_attr( $multi_open ); ?>">
			<?php
			/**
			 * Render widget content.
			 *
			 * Filters the widget content before it's rendered.
			 *
			 * @since 1.0.0
			 *
			 * @param string      $widget_content The content of the widget.
			 * @param Widget_Base $this           The widget.
			 */
			$widget_content = apply_filters( 'elementor/widget/render_content', $widget_content, $this );
	
			echo $widget_content; // XSS ok.
			?>
		</div>
		<?php
	}
	
	/**
	 * Render Accordion widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$accordion_list = isset( $accordion_list ) ? $accordion_list : '';
		$rand_id = cea_shortcode_rand_id();
		
		//Icon migrated
		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			// add old default
			$settings['icon'] = 'ti-plus';
			$settings['icon_active'] = 'ti-minus';
			$settings['icon_pos'] = $this->get_settings( 'icon_pos' );
		}
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		$has_icon = ( ! $is_new || ! empty( $settings['selected_icon']['value'] ) );
											
		$icon_size = isset( $settings['icon_size']['size'] ) ? $settings['icon_size']['size'] : 12;
		$icon_unit = isset( $settings['icon_size']['unit'] ) ? $settings['icon_size']['unit'] : 'px';
		$font_size_style = 'style="font-size: ' . esc_attr( $icon_size . $icon_unit ) . ';"';

  		$add_search_filter = isset( $add_search_filter ) && $add_search_filter == 'yes' ? true : false;
		$placeholder_text = isset( $settings['add_search_placeholder'] ) && !empty( $settings['add_search_placeholder'] ) ? $settings['add_search_placeholder'] : 'Search FAQs..';
		$list_active_class = ' active'; $content_active_class = ' active';  $i = 1;
		if( !empty( $accordion_list ) ){		
			if ( $add_search_filter ){
				echo '<div id="search-container">';
				echo '<input type="text" id="search-input-' . esc_attr( $rand_id ) . '" placeholder="'.  esc_attr( $placeholder_text ).'"/>';
				echo '</div>';
			}
			echo '<div class="cea-accordions" id="cea-accordion-' . esc_attr( $rand_id ) .'">';
			
			foreach( $accordion_list as $accordion_single ){
				$accordion_type = isset( $accordion_single['accordion_type'] ) ? $accordion_single['accordion_type'] : 'content';
				echo '<div class="card cea-accordion">';
				
				$accordion_id = esc_attr( $rand_id ) .'-'. esc_attr( $i );				
				if( isset( $accordion_single['cea_accordion_title'] ) && !empty( $accordion_single['cea_accordion_title'] ) ){
					$title_tag = isset( $title_tag ) ? $title_tag : 'div';
					echo '<'. esc_attr( $title_tag ) .' class="card-header cea-accordion-header">';
					echo '<a class="nav-item nav-link'. esc_attr( $list_active_class ) .'" href="#cea-accordion-'. esc_attr( $accordion_id ) .'">';

					if ( $has_icon ) :
						echo '<span class="elementor-accordion-icon elementor-accordion-icon-' . esc_attr( $settings['icon_pos'] ) . '" aria-hidden="true">';
						if ( $is_new || $migrated ) {
							echo '<span class="cea-accordion-icon-closed" ' . $font_size_style . '>';
							Icons_Manager::render_icon( $settings['selected_icon'] );
							echo '</span>';
							echo '<span class="cea-accordion-icon-opened" ' . $font_size_style . '>';
							Icons_Manager::render_icon( $settings['selected_active_icon'] );
							echo '</span>';
						} else {
							echo '<i class="cea-accordion-icon-closed ' . esc_attr( $settings['icon'] ) . '" ' . $font_size_style . '></i>';
							echo '<i class="cea-accordion-icon-opened ' . esc_attr( $settings['icon_active'] ) . '" ' . $font_size_style . '></i>';
						}
						echo '</span>';
					endif;
										
					echo $accordion_single['cea_accordion_title'];
					echo '</a>';
					echo '</'. esc_attr( $title_tag ) .'><!-- .card-header -->';
				}
				
				echo '<div class="cea-accordion-content'. esc_attr( $content_active_class ) .'" id="cea-accordion-'. esc_attr( $accordion_id ) .'">';		
				echo '<div class="card-body">';
				if( $accordion_type == 'content' ){
					if( isset( $accordion_single['cea_accordion_content'] ) && !empty( $accordion_single['cea_accordion_content'] ) ){
						echo '<div class="cea-accordion-pane">'. $accordion_single['cea_accordion_content'] .'</div>';
					}
				} elseif( $accordion_type == 'element' ){
					if( isset( $accordion_single['cea_element_id'] ) && !empty( $accordion_single['cea_element_id'] ) ){
						echo '<div class="cea-accordion-pane"><div class="cea-accordion-id-to-element" data-id="'. esc_attr( $accordion_single['cea_element_id'] ) .'"></div></div>';
					}
				} elseif( $accordion_type == 'templates' ){
					$template_id = isset( $accordion_single['ele_templates'] ) ? $accordion_single['ele_templates'] : '';
					echo Plugin::$instance->frontend->get_builder_content( $template_id, true );
				}
				echo '</div><!-- .card-body -->';
				echo '</div><!-- .cea-accordion-content -->';
			
				echo '</div><!-- .card -->';
			
				$list_active_class = $content_active_class = '';
				$i++;
			}
			echo '</div>';
		}
		

	}
		
}