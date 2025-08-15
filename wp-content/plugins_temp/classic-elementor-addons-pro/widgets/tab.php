<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Classic_Elementor_Addons\Helper\Post_Helper as Cea_Post_Helper;

/**
 * Classic Elementor Addon Cea Tab
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Tab_Widget extends Widget_Base {
	use Cea_Post_Helper;
	
	public $image_class;
	/**
	 * Get widget name.
	 *
	 * Retrieve Cea Tab widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceatab";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Cea Tab widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Tab", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Cea Tab widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-tab-window";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Cea Tab widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'tab', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Cea Tab widget belongs to.
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
	 * Register Cea Tab widget controls.
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
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default tab options.", 'classic-elementor-addons-pro' ),
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
		
		//Tab Section
		$this->start_controls_section(
			"cea_tab_section",
			[
				"label"	=> esc_html__( "Tab", 'classic-elementor-addons-pro' ),
				"accordion"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Tab options.", 'classic-elementor-addons-pro' ),
			]
		);	
		$repeater = new Repeater();		
		$repeater->add_control(
			"tab_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "tab title.", 'classic-elementor-addons-pro' )
			]
		);
		$repeater->add_control(
			'icon_type',
			[
				'label' 	=> __( 'Icon Type', 'classic-elementor-addons-pro' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'separator' 	=> 'before',
				'options' => [
					'none' => [
						'title' => esc_html__('None', 'classic-elementor-addons-pro'),
						'icon' => 'fa fa-ban',
					],
					'icon' => [
						'title' => esc_html__('Icon', 'classic-elementor-addons-pro'),
						'icon' => 'fa fa-gear',
					],
					'image' => [
						'title' => esc_html__('Image', 'classic-elementor-addons-pro'),
						'icon' => 'fa fa-picture-o',
					],
				],
				'default' => 'none',
			]
		);
		$repeater->add_control(
			'selected_icon',
			[
				'label' 		=> esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::ICONS,
				'separator' 	=> 'after',
				'fa4compatibility' => 'icon',
				'default' 		=> [
					'value' => 'ti-home',
					'library' => 'themify'
				],
				'skin' => 'inline',
				'label_block' => false,
				'condition' => [
					'icon_type' => 'icon',
				],
			]
		);
		$repeater->add_control(
			"tab_image",
			[
				"type" 			=> Controls_Manager::MEDIA,
				"label" 		=> esc_html__( "Tab Image", 'classic-elementor-addons-pro' ),
				'separator' 	=> 'after',
				"dynamic" 		=> [
					"active" 	=> true,
				],
				'default' 		=> [
					'url' 		=> Utils::get_placeholder_image_src(),
				],
				'condition' 	=> [
					'icon_type' => 'image',
				],
			]
		);	
		$repeater->add_control(
			'tab_type',
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
			"tab_content",
			[
				"label"			=> esc_html__( "Tab Content", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::WYSIWYG,
				"description" 	=> esc_html__( "You can place here tab content.", 'classic-elementor-addons-pro' ),
				"default"		=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.",
				'condition' => [
					'tab_type' => 'content',
				],
			]
		);		
		$repeater->add_control(
			"element_id",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Element ID", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter element id", 'classic-elementor-addons-pro' ),
				'condition' => [
					'tab_type' => 'element',
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
					'tab_type' => 'templates',
				],
			]
		);		
		$this->add_control(
			"tab_list",
			[
				"type"			=> Controls_Manager::REPEATER,
				"label"			=> esc_html__( "Tab List", 'classic-elementor-addons-pro' ),
				"fields"		=> $repeater->get_controls(),
				"default" 		=> [
					[
						"tab_title" 	=> esc_html__( "Title 1", 'classic-elementor-addons-pro' ),
						"tab_type" => "content",
						"icon_type" => "none",
						"selected_icon" => "",
						"tab_image"		=> "",
						"element_id"	=> "",
						"tab_content"	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.",
						"ele_templates" => ""
					],
					[
						"tab_title" 	=> esc_html__( "Title 2", 'classic-elementor-addons-pro' ),
						"tab_type" => "content",
						"icon_type" => "none",
						"selected_icon" => "",
						"tab_image"		=> "",
						"element_id"	=> "",
						"tab_content"	=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.",
						"ele_templates" => ""
					],
				],
				"title_field"	=> "{{{ tab_title }}}"
			]
		);	
		$this->add_control(
			'icon_pos',
			[
				'label' => esc_html__( 'Icon Alignment', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-right',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => is_rtl() ? 'right' : 'left',
				'toggle' => false,
			]
		);		
		$this->add_control(
			"vertical_tab",
			[
				"label" 		=> esc_html__( "Vertical Tab", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable vertical tab.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"circle_tabs",
			[
				"label" 		=> esc_html__( "Circle Tab", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable circle tab.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no",
				"condition"     => [
					'vertical_tab!' => 'yes',
				],
			]
		);
		$this->end_controls_section();
		
		// Style Tab Section
		$this->start_controls_section(
			'section_style_tab',
			[
				'label' => __( 'Tab', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'tab_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-tab-elementor-widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'tab_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-tab-elementor-widget' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_border',
				'selector' => '{{WRAPPER}} .cea-tab-elementor-widget',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'tab_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-tab-elementor-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_box_shadow',
				'selector' => '{{WRAPPER}} .cea-tab-elementor-widget'
			]
		);
		$this->add_control(
			'tab_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-tab-elementor-widget' => 'background-color: {{VALUE}};'
				],
			]
		);		
		$this->end_controls_section();
		
		// Style Tab Title Section
		$this->start_controls_section(
			'section_style_tab_title',
			[
				'label' => esc_html__( 'Tab Title', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"title_head",
			[
				"label"			=> esc_html__( "Title Heading Tag", 'classic-elementor-addons-pro' ),
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
			"title_trans",
			[
				"label"			=> esc_html__( "Title Transform", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", 'classic-elementor-addons-pro' ),
					"capitalize"	=> esc_html__( "Capitalized", 'classic-elementor-addons-pro' ),
					"uppercase"		=> esc_html__( "Upper Case", 'classic-elementor-addons-pro' ),
					"lowercase"		=> esc_html__( "Lower Case", 'classic-elementor-addons-pro' )
				],
				'selectors' => [
					'{{WRAPPER}} .cea-tab-elementor-widget .cea-tabs .cea-tab-title' => 'text-transform: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'title_align',
			[
				'label' => __( 'Alignment', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => 'left', //->Modified
				'selectors' => [
					'{{WRAPPER}} .cea-tab-elementor-widget .cea-tabs > a' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .nav.nav-tabs.cea-tabs' => 'justify-content: {{VALUE}};' //->Modified
				],
			]
		);		
		$this->add_responsive_control(
			'tab_title_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-tab-elementor-widget .cea-tabs > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'tab_title_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-tab-elementor-widget .cea-tabs > a .cea-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
		    'tab_title_spacing',
		    [
		        'label' => esc_html__('Spacing', 'classic-elementor-addons-pro'),
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
				'devices' => ['desktop', 'tablet', 'mobile'],
		        'desktop_default' => [
		            'size' => 0,
		            'unit' => 'px',
		        ],
		        'tablet_default' => [
		            'size' => 0,
		            'unit' => 'px',
		        ],
		        'mobile_default' => [
		            'size' => 0,
		            'unit' => 'px', 
		        ],
		        'selectors' => is_rtl() ? [
		            '{{WRAPPER}} .cea-tabs > a:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}};',
		            '(tablet){{WRAPPER}} .cea-tabs > a:not(:last-child)' => 'margin-top: 0;',
		            '(mobile){{WRAPPER}} .cea-tabs > a:not(:last-child)' => 'margin-left: 0; margin-bottom: {{SIZE}}{{UNIT}};',
		        ] : [
		            '{{WRAPPER}} .cea-tabs > a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
		            '(tablet){{WRAPPER}} .cea-tabs > a:not(:last-child)' => 'margin-top: 0;',
		            '(mobile){{WRAPPER}} .cea-tabs > a:not(:last-child)' => 'margin-right: 0; margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		        
		    ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .cea-tabs > a .cea-tab-title'
			]
		);
		$this->add_control(
			'title_style',
			[
				'label' => __( 'Title Colors', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->start_controls_tabs( 'tab_title_styles' );
		$this->start_controls_tab(
			'tab_title_normal',
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
					'{{WRAPPER}} .cea-tabs > a .cea-tab-title' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-tabs > a' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
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
					'{{WRAPPER}} .cea-tabs > a:hover .cea-tab-title, {{WRAPPER}} .cea-tabs > a.active .cea-tab-title' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_bg_hcolor',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-tabs > a:hover, {{WRAPPER}} .cea-tabs > a.active' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control(
			'title_icon_style',
			[
				'label' => __( 'Title Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'tab_title_icon_size',
			[
				'label' => esc_html__( 'Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-tabs .cea-tab-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cea-tabs .cea-tab-icon > svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cea-tabs .elementor-tab-icon > img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);	
		$this->start_controls_tabs( 'tab_title_icon_styles' );
		$this->start_controls_tab(
			'tab_title_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'title_icon_color',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-tabs .elementor-tab-icon > *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'title_icon_hcolor',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-tabs > a:hover .elementor-tab-icon > *, {{WRAPPER}} .cea-tabs > a.active .elementor-tab-icon > *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
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
				'selector' 		=> '{{WRAPPER}} .tab-content'
			]
		);	
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-content' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'content_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-content' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'content_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
	
	}
	
	/**
	 * Render Tab widget output on the frontend.
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
		$class .= isset( $vertical_tab ) && $vertical_tab == 'yes' ? ' cea-vertical-tab' : '';
		$class .= isset( $circle_tabs ) && $circle_tabs == 'yes' ? ' cea-circle-tab' : ''; // Add circle tab class
		?>
		
		<div class="elementor-widget-container cea-tab-elementor-widget<?php echo esc_attr( $class ); ?>">
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
	 * Render Tab widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$tab_list = isset( $tab_list ) ? $tab_list : '';
		$vertical_tab = isset( $vertical_tab ) && $vertical_tab == '1' ? true : false;
		$title_head = isset( $title_head ) ? $title_head : 'h6';
		$rand_id = cea_shortcode_rand_id();

		
		$tab_nav = ''; $list_active_class = ' active'; $content_active_class = ' active';  $tab_content = ''; $i = 1;
		if( !empty( $tab_list ) ){			
			foreach( $tab_list as $tab_single ){
				$tab_id = esc_attr( $rand_id ) .'-'. esc_attr( $i );
				$tab_type = isset( $tab_single['tab_type'] ) ? $tab_single['tab_type'] : 'content';
				$icon_type = isset( $tab_single['icon_type'] ) ? $tab_single['icon_type'] : 'none';
				
				//Icon migrated
				$migration_allowed = Icons_Manager::is_migration_allowed();
				if ( ! isset( $tab_single['selected_icon'] ) && ! $migration_allowed ) {
					$tab_single['icon'] = 'ti-home';
				}
				$migrated = isset( $tab_single['__fa4_migrated']['selected_icon'] );
				$is_new = ! isset( $tab_single['icon'] ) && $migration_allowed;		
				$has_icon = $icon_type == 'icon' && ( ! $is_new || ! empty( $tab_single['selected_icon']['value'] ) );				
				$icon_out = ''; $icon_left_out = ''; $icon_right_out = '';				
				if ( ! empty( $tab_single['icon'] ) || ( ! empty( $tab_single['selected_icon']['value'] ) && $is_new ) ){
					if ( $is_new || $migrated ) {
						$icon_out .= '<span class="cea-tab-icon">';
							ob_start();
							Icons_Manager::render_icon( $tab_single['selected_icon'], [ 'aria-hidden' => 'true' ] );
							$icon_out .= ob_get_clean();
						$icon_out .= '</span>';
					}else{
						$icon_out .= '<i class="cea-tab-icon '. esc_attr( $tab_single['icon'] ) .'"></i>';
					}
				}
				
				//Image
				if ( !$has_icon && $icon_type == 'image' && !empty( $tab_single['tab_image']['url'] ) ) {
					$this->image_class = 'image_class';
					$this->add_render_attribute( 'image', 'src', $tab_single['tab_image']['url'] );
					$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $tab_single['tab_image'] ) );
					$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $tab_single['tab_image'] ) );
					$this->add_render_attribute( 'image_class', 'class', 'img-fluid' );					
					$icon_out = wp_get_attachment_image( $tab_single['tab_image']['id'], 'full', false );
					$has_icon = true;
				}
				
				if( $has_icon && ( $settings['icon_pos'] == 'left' || $settings['icon_pos'] == 'top' ) ){
					$icon_left_out .= '<span class="elementor-tab-icon elementor-tab-icon-'. esc_attr( $settings['icon_pos'] ) .'" aria-hidden="true">';
						$icon_left_out .= $icon_out;
					$icon_left_out .= '</span>';
				}elseif( $has_icon && ( $settings['icon_pos'] == 'right' || $settings['icon_pos'] == 'bottom' ) ){
					$icon_right_out .= '<span class="elementor-tab-icon elementor-tab-icon-'. esc_attr( $settings['icon_pos'] ) .'" aria-hidden="true">';
						$icon_right_out .= $icon_out;
					$icon_right_out .= '</span>';
				}
				//Icon code end
				
				if( isset( $tab_single['tab_title'] ) && !empty( $tab_single['tab_title'] ) ){
					$tab_nav .= '<a class="nav-item nav-link'. esc_attr( $list_active_class ) . ( isset($circle_tabs) && $circle_tabs == 'yes' ? ' cea-circle-tab-item' : '' ) .'" href="#cea-tab-'. esc_attr( $tab_id ) .'">';
						if( $has_icon && $icon_left_out ) $tab_nav .= $icon_left_out;
						$tab_nav .= '<'. esc_attr( $title_head ) .' class="cea-tab-title">'. $tab_single['tab_title'] .'</'. esc_attr( $title_head ) .'>';
						if( $has_icon && $icon_right_out ) $tab_nav .= $icon_right_out;
					$tab_nav .= '</a>';
				}
							
				if( $tab_type == 'content' ){
					if( isset( $tab_single['tab_content'] ) && !empty( $tab_single['tab_content'] ) ){
						$tab_content .= '<div class="cea-tab-pane'. esc_attr( $content_active_class ) .'" id="cea-tab-'. esc_attr( $tab_id ) .'">'. $tab_single['tab_content'] .'</div>';
					}
				}elseif( $tab_type == 'element' ){
					if( isset( $tab_single['element_id'] ) && !empty( $tab_single['element_id'] ) ){
						$tab_content .= '<div class="cea-tab-pane'. esc_attr( $content_active_class ) .'" id="cea-tab-'. esc_attr( $tab_id ) .'"><span class="cea-tab-id-to-element" data-id="'. esc_attr( $tab_single['element_id'] ) .'"></span></div>';
					}
				}elseif( $tab_type == 'templates' ){
					$template_id = isset( $tab_single['ele_templates'] ) ? $tab_single['ele_templates'] : '';
					$tab_content .= '<div class="cea-tab-pane'. esc_attr( $content_active_class ) .'" id="cea-tab-'. esc_attr( $tab_id ) .'">';
						$tab_content .= Plugin::$instance->frontend->get_builder_content( $template_id, true );
					$tab_content .= '</div><!-- .cea-tab-pane -->';
				}
				
				$list_active_class = $content_active_class = '';
				$i++;
			}
			$nav_class = $vertical_tab ? ' flex-column' : '';
			$tab_out = '<div class="nav nav-tabs cea-tabs'. esc_attr( $nav_class ) .' tab-count-'. esc_attr( $tab_id[-1] ) .'">';
				$tab_out .= $tab_nav;
			$tab_out .= '</div>';
			$tab_out .= '<div class="tab-content cea-tab-content">';
				$tab_out .= $tab_content;
			$tab_out .= '</div>';
			
		}
		echo $tab_out;		
	}
}