<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Counter Widget
 *
 * @since 1.0.0
 */

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
 
class CEA_Elementor_Counter_Widget extends Widget_Base {
	
	private $excerpt_len;
	
	public $image_class;
	/**
	 * Get widget name.
	 *
	 * Retrieve Counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceacounter";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Counter", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-time";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Counter widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'counter', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Counter widget belongs to.
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
		return [ 'tilt', 'appear', 'cea-custom-front'  ];
	}

	/**
	 * Register Counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//Counter Section
		$this->start_controls_section(
			"counter_section",
			[
				"label"	=> esc_html__( "Counter", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default counter options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you put the counter title.", 'classic-elementor-addons-pro' ),
				"default" 		=> esc_html__( "Counter", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"count_val",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Counter Value", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can place counter value. Example 200", 'classic-elementor-addons-pro' ),
				"default" 		=> "100"
			]
		);
		$this->add_control(
			"count_suffix_val",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Counter Suffix", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can place counter suffix value. Example +", 'classic-elementor-addons-pro' ),
				"default" 		=> ""
			]
		);
		$this->add_control(
			"content",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Counter Content", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you put the counter content.", 'classic-elementor-addons-pro' ),
				"default" 		=> ""
			]
		);
		$this->add_control(
			"counter_duration",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Counter Duration", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can set counter count duration. Example 2000", 'classic-elementor-addons-pro' ),
				"default" 		=> "2000"
			]
		);
		$this->end_controls_section();
		
		//Layouts Section
		$this->start_controls_section(
			"layouts_section",
			[
				"label"			=> esc_html__( "Layouts", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Counter options available here.", 'classic-elementor-addons-pro' ),
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
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);			
		$this->add_control(
			"counter_layout",
			[
				"label"			=> esc_html__( "Counter Layout", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "default",
				"options"		=> [
					"default"	=> esc_html__( "Default", 'classic-elementor-addons-pro' ),
					"classic"	=> esc_html__( "Classic", 'classic-elementor-addons-pro' ),
					"modern"	=> esc_html__( "Modern", 'classic-elementor-addons-pro' ),
					"list"		=> esc_html__( "List", 'classic-elementor-addons-pro' ),
				]
			]
		);
		$this->add_control(
			"heading_tag",
			[
				"label"			=> esc_html__( "Post Heading Tag", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h5",
				"options"		=> [
					"h1"		=> esc_html__( "h1", 'classic-elementor-addons-pro' ),
					"h2"		=> esc_html__( "h2", 'classic-elementor-addons-pro' ),
					"h3"		=> esc_html__( "h3", 'classic-elementor-addons-pro' ),
					"h4"		=> esc_html__( "h4", 'classic-elementor-addons-pro' ),
					"h5"		=> esc_html__( "h5", 'classic-elementor-addons-pro' ),
					"h6"		=> esc_html__( "h6", 'classic-elementor-addons-pro' ),
				]
			]
		);
		$this->add_control(
			"counter_items",
			[
				"label"				=> "Counter Items",
				"description"		=> esc_html__( "This is settings for counter custom layout. here you can set your own layout. Drag and drop needed counter items to Enabled part.", 'classic-elementor-addons-pro' ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					esc_html__( "Enabled", 'classic-elementor-addons-pro' ) => array( 
						"count"	=> esc_html__( "Count Value", 'classic-elementor-addons-pro' ),
						"title"	=> esc_html__( "Title", 'classic-elementor-addons-pro' )
						
					),
					esc_html__( "disabled", 'classic-elementor-addons-pro' ) => array(
						"icon"	=> esc_html__( "Icon", 'classic-elementor-addons-pro' ),
						"content"	=> esc_html__( "Content", 'classic-elementor-addons-pro' ),
						"image"		=> esc_html__( "Image", 'classic-elementor-addons-pro' )
					)
				]
			]
		);
		$this->end_controls_section();
		
		//Icon Section
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
			]
		);		
		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'ti-heart',
					'library' => 'themify',
				],
			]
		);
		$this->add_control(
			'icon_view',
			[
				'label' => esc_html__( 'View', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
					'stacked' => esc_html__( 'Stacked', 'classic-elementor-addons-pro' ),
					'framed' => esc_html__( 'Framed', 'classic-elementor-addons-pro' ),
				],
				'default' => 'default',
				'prefix_class' => 'cea-view-',
			]
		);
		$this->add_control(
			'icon_shape',
			[
				'label' => esc_html__( 'Shape', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'circle' => esc_html__( 'Circle', 'classic-elementor-addons-pro' ),
					'square' => esc_html__( 'Square', 'classic-elementor-addons-pro' ),
				],
				'default' => 'circle',
				'condition' => [
					'icon_view!' => 'default',
				],
				'prefix_class' => 'cea-shape-',
			]
		);
		$this->end_controls_section();	
		
		// Image Section
		$this->start_controls_section(
			"image_section",
			[
				"label"			=> esc_html__( "Image", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Counter image options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"image",
			[
				"type" => Controls_Manager::MEDIA,
				"label" => esc_html__( "Image", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose counter image.", 'classic-elementor-addons-pro' ),
				"dynamic" => [
					"active" => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);		
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
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
			'counter_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'counter_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->start_controls_tabs( 'general_styles' );
			$this->start_controls_tab(
				'general_normal',
				[
					'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'font_color',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .cea-counter-wrapper' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'bg_color',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .cea-counter-wrapper' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"shadow_opt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", 'classic-elementor-addons-pro' ),
					"description"	=> esc_html__( "This is option for show box shadow on counter box hover.", 'classic-elementor-addons-pro' ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"counter_box_shadow",
				[
					"label" 		=> esc_html__( "Box Shadow", 'classic-elementor-addons-pro' ),
					"description"	=> esc_html__( "This is option for show box shadow on counter box hover.", 'classic-elementor-addons-pro' ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'shadow_opt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .cea-counter-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{counter_box_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"counter_box_shadow_pos",
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
				'general_hover',
				[
					'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'font_hcolor',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .cea-counter-wrapper:hover' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'bg_hcolor',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .cea-counter-wrapper:hover' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"shadow_hopt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", 'classic-elementor-addons-pro' ),
					"description"	=> esc_html__( "This is option for show box shadow on counter box hover.", 'classic-elementor-addons-pro' ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"counter_hbox_shadow",
				[
					"label" 		=> esc_html__( "Hover Box Shadow", 'classic-elementor-addons-pro' ),
					"description"	=> esc_html__( "This is option for show box shadow on counter box hover.", 'classic-elementor-addons-pro' ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'shadow_hopt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .cea-counter-wrapper:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{counter_hbox_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"counter_hbox_shadow_pos",
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
		$this->add_responsive_control(
			'list_right_spacing',
			[
				'label' => esc_html__( 'List Right Space', 'classic-elementor-addons-pro' ),
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
					'{{WRAPPER}} .cea-counter-wrapper .counter-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-counter-wrapper .counter-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'counter_layout' => 'list',
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
		$this->start_controls_tabs( 'title_colors' );
		$this->start_controls_tab(
			'title_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper .counter-title > *' => 'color: {{VALUE}};'
				],
			]
		);			
		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"title_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Hover Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper:hover .counter-title > *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper .counter-title > *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			"title_text_trans",
			[
				"label"			=> esc_html__( "Title Transform", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Set title text-transform property.", 'classic-elementor-addons-pro' ),
				"default"		=> "none",
				"options"		=> [
					"none"			=> esc_html__( "Default", 'classic-elementor-addons-pro' ),
					"capitalize"	=> esc_html__( "Capitalized", 'classic-elementor-addons-pro' ),
					"uppercase"		=> esc_html__( "Upper Case", 'classic-elementor-addons-pro' ),
					"lowercase"		=> esc_html__( "Lower Case", 'classic-elementor-addons-pro' )
				],
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper .counter-title > *' => 'text-transform: {{VALUE}};'
				],
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
					'{{WRAPPER}} .cea-counter-wrapper .counter-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-counter-wrapper .counter-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' 		=> '{{WRAPPER}} .cea-counter-wrapper .counter-title > *'
			]
		);	
		$this->end_controls_section();
		
		// Style Counter Section
		$this->start_controls_section(
			'section_style_counter',
			[
				'label' => __( 'Counter', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs( 'counter_colors' );
		$this->start_controls_tab(
			'counter_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"counter_value_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Counter Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the counter value font color.", 'classic-elementor-addons-pro' ),
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper .counter-value > *' => 'color: {{VALUE}};'
				],
			]
		);			
		$this->end_controls_tab();

		$this->start_controls_tab(
			'counter_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"counter_value_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title Hover Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the font color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper:hover .counter-value > *' => 'color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		$this->add_control(
			'counter_value_margin',
			[
				'label' => esc_html__( 'Counter Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper .counter-value > *' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'counter_value_spacing',
			[
				'label' => esc_html__( 'Counter Spacing', 'classic-elementor-addons-pro' ),
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
					'{{WRAPPER}} .cea-counter-wrapper .counter-value' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-counter-wrapper .counter-value' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'counter_typography',
				'selector' 		=> '{{WRAPPER}} .cea-counter-wrapper .counter-value > *'
			]
		);	
		$this->end_controls_section();
		
		// Style Icon Section
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .counter-icon svg' => 'fill: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'condition' => [
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed .counter-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.cea-view-stacked .counter-icon' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'icon_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed .counter-icon' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);

		$this->add_control(
			'icon_primary_hcolor',
			[
				'label' => esc_html__( 'Primary Hover Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}}:hover .counter-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .counter-icon svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'icon_secondary_hcolor',
			[
				'label' => esc_html__( 'Secondary Hover Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'condition' => [
					'icon_view!' => 'default',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed:hover .counter-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.cea-view-stacked:hover .counter-icon' => 'background-color: {{VALUE}};'
				],
			]
		);	
		$this->add_control(
			'hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'condition' => [
					'icon_view' => 'framed',
				],
				'selectors' => [
					'{{WRAPPER}}.cea-view-framed:hover .counter-icon' => 'border-color: {{VALUE}};'
				],
			]
		);		

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .counter-icon svg' => 'width: {{SIZE}}{{UNIT}};'
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}}.cea-view-stacked .counter-icon' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.cea-view-framed .counter-icon' => 'padding: {{SIZE}}{{UNIT}};'
				],
				'defailt' => [
					'unit' => 'px',
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);

		$this->add_responsive_control(
			'icon_rotate',
			[
				'label' => esc_html__( 'Rotate', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'tablet_default' => [
					'unit' => 'deg',
				],
				'mobile_default' => [
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .counter-icon i, {{WRAPPER}} .counter-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__( 'Spacing', 'classic-elementor-addons-pro' ),
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
					'{{WRAPPER}} .counter-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .counter-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_width',
			[
				'label' => esc_html__( 'Border Width', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_view' => 'framed',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'icon_view!' => 'default',
				],
			]
		);
		$this->add_control(
			'icon_animation',
			[
				'label' => esc_html__( 'Icon Animation', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ANIMATION,
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper:hover .counter-icon.cea-elementor-animation' => 'animation-name: {{VALUE}};'
				]
			]
		);		
		$this->end_controls_section();
		
		// Style Image Section		
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'counter_image_styles' );
		$this->start_controls_tab(
			'counter_img_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'counter_img_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper .counter-image > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'counter_img_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'counter_img_bg_hcolor',
			[
				'label' => esc_html__( 'Hover Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-counter-wrapper:hover .counter-image > img' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);	
		$this->end_controls_tab();
		$this->end_controls_tabs();			
			
		$this->add_control(
			"img_style",
			[
				"label"			=> esc_html__( "Image Style", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Choose image style.", 'classic-elementor-addons-pro' ),
				"default"		=> "squared",
				"options"		=> [
					"squared"			=> esc_html__( "Squared", 'classic-elementor-addons-pro' ),
					"rounded"			=> esc_html__( "Rounded", 'classic-elementor-addons-pro' ),
					"rounded-circle"	=> esc_html__( "Circled", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->add_control(
			"resize_opt",
			[
				"label" 		=> esc_html__( "Resize Option", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enable resize option.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__( 'Image Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'condition' => [
					'resize_opt' => 'yes',	
				],
				'selectors' => [
					'{{WRAPPER}} .counter-image > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;',
					'{{WRAPPER}} .counter-image' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_responsive_control(
			'image_spacing',
			[
				'label' => esc_html__( 'Image Spacing', 'classic-elementor-addons-pro' ),
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
					'{{WRAPPER}} .cea-counter-wrapper .counter-image' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);		
		$this->add_responsive_control(
			'counter_img_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .counter-image > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'counter_img_border',
					'label' => esc_html__( 'Border', 'classic-elementor-addons-pro' ),
					'selector' => '{{WRAPPER}} .counter-image > img'
				]
		);
		$this->end_controls_section();
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'desc_spacing',
			[
				'label' => esc_html__( 'Description Spacing', 'classic-elementor-addons-pro' ),
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
					'{{WRAPPER}} .cea-counter-wrapper .counter-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-counter-wrapper .counter-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .cea-counter-wrapper .counter-content'
			]
		);	
		$this->end_controls_section();
		
		// Style Tilt Section
		$this->start_controls_section(
			'section_style_tilt',
			[
				'label' => __( 'Tilt', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"tilt_opt",
			[
				"label" 		=> esc_html__( "Tilt Option", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable tilt animation option.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'max_tilt',
			[
				'label' => esc_html__( 'maxTilt', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 20
			]
		);
		$this->add_control(
			'perspective',
			[
				'label' => esc_html__( 'Perspective', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 500
			]
		);
		$this->add_control(
			'tilt_scale',
			[
				'label' => esc_html__( 'Scale', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 1.1
			]
		);
		$this->add_control(
			'tilt_speed',
			[
				'label' => esc_html__( 'Speed', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 400
			]
		);
		$this->add_control(
			"tilt_transition",
			[
				"label" 		=> esc_html__( "Tilt Transition", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for tilt transition.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->end_controls_section();

	}
	
	/**
	 * Render Counter widget output on the frontend.
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
		
		$layout_class = isset( $counter_layout ) && $counter_layout != '' ? ' cea-counter-style-' . $counter_layout : '';
		
		$tilt_opt = isset( $settings['tilt_opt'] ) && $settings['tilt_opt'] == 'yes' ? true : false;
		$tilt_transition = isset( $settings['tilt_transition'] ) && $settings['tilt_transition'] == 'yes' ? true : false;
		$max_tilt = isset( $settings['max_tilt'] ) ? $settings['max_tilt'] : '';
		$perspective = isset( $settings['perspective'] ) ? $settings['perspective'] : '';
		$tilt_scale = isset( $settings['tilt_scale'] ) ? $settings['tilt_scale'] : '';
		$tilt_speed = isset( $settings['tilt_speed'] ) ? $settings['tilt_speed'] : '';
		
		$this->add_render_attribute( 'cea-counter-container', 'class', 'elementor-widget-container cea-counter-wrapper' );
		$this->add_render_attribute( 'cea-counter-container', 'class', $layout_class );
		
		if( $tilt_opt ){
			$this->add_render_attribute( 'cea-counter-container', 'class', 'cea-tilt' );
			$this->add_render_attribute( 'cea-counter-container', 'data-tilt_trans', $tilt_transition );
			$this->add_render_attribute( 'cea-counter-container', 'data-max_tilt', $max_tilt );
			$this->add_render_attribute( 'cea-counter-container', 'data-tilt_perspective', $perspective );
			$this->add_render_attribute( 'cea-counter-container', 'data-tilt_scale', $tilt_scale );
			$this->add_render_attribute( 'cea-counter-container', 'data-tilt_speed', $tilt_speed );
		}		
		?>
		
		<div <?php echo ''. $this->get_render_attribute_string( 'cea-counter-container' ); ?>>
		
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
	 * Render Counter widget output on the frontend.
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
		$title = isset( $title ) && $title != '' ? $title : '';
		$content = isset( $content ) && $content != '' ? $content : '';
		$count_val = isset( $count_val ) && $count_val != '' ? $count_val : '';
		$count_suffix_val = isset( $count_suffix_val ) ? $count_suffix_val : '';
		$duration = isset( $counter_duration ) ? $counter_duration : '2000';
		$heading_tag = isset( $heading_tag ) ? $heading_tag : 'h4';		
		$default_items = array( 
			"count"	=> esc_html__( "Count Value", 'classic-elementor-addons-pro' ),
			"title"	=> esc_html__( "Title", 'classic-elementor-addons-pro' )
		);
		$elemetns = isset( $counter_items ) && !empty( $counter_items ) ? json_decode( $counter_items, true ) : array( 'Enabled' => $default_items );
	
		if( isset( $elemetns['Enabled'] ) ) :
			
			if( $counter_layout == 'list' ){
				echo '<div class="media">';
					echo '<div class="counter-left mr-3">';
						if( isset( $elemetns['Enabled']['icon'] ) ){
							//Icon Section
							$this->add_render_attribute( 'icon-wrapper', 'class', 'counter-icon' );
							if ( ! empty( $settings['icon_animation'] ) ) {
								$this->add_render_attribute( 'icon-wrapper', 'class', 'cea-elementor-animation' );
							}
							if ( empty( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
								// add old default
								$settings['icon'] = 'ti-heart';
							}
							if ( ! empty( $settings['icon'] ) ) {
								$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
								$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
							}		
							$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
							$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
							if( $settings['selected_icon'] ){
								echo '<div '. $this->get_render_attribute_string( 'icon-wrapper' ) .'>';
									if ( $is_new || $migrated ) :
										Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
									else : ?>
										<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
									<?php endif; 
								echo '</div>';
							}
							unset( $elemetns['Enabled']['icon'] );
						}
						if( isset( $elemetns['Enabled']['image'] ) ){
							//Image Section
							if ( ! empty( $settings['image']['url'] ) ) {
								$this->image_class = 'image_class';
								$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
								$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
								$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
								$this->add_render_attribute( 'image_class', 'class', 'img-fluid' ); 
								$this->add_render_attribute( 'image_class', 'class', $settings['img_style'] ); 
								
								if ( $settings['hover_animation'] ) {
									$this->add_render_attribute( 'image_class', 'class', 'elementor-animation-' . $settings['hover_animation'] );
									
								}
								$counter_image = Classic_Elementor_Extension::cea_get_attachment_image_html( $settings, 'thumbnail', 'image', $this );
								echo '<figure class="counter-image">' . $counter_image . '</figure>';
							}					
							unset( $elemetns['Enabled']['image'] );
						}
					echo '</div><!-- .counter-left -->';
					echo '<div class="media-body counter-right">';
			}
	
			foreach( $elemetns['Enabled'] as $element => $value ){
				switch( $element ){
	
					case "title":
						echo '<div class="counter-title">';
							echo '<'. esc_attr( $heading_tag ) .' class="counter-title-head">'. esc_html( $title ) .'</'. esc_attr( $heading_tag ) .'>';
						echo '</div><!-- .counter-title -->';
					break;
			
					case "icon":						
						//Icon Section
						$this->add_render_attribute( 'icon-wrapper', 'class', 'counter-icon' );
						if ( ! empty( $settings['icon_animation'] ) ) {
							$this->add_render_attribute( 'icon-wrapper', 'class', 'cea-elementor-animation' );
						}
						if ( empty( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
							// add old default
							$settings['icon'] = 'ti-heart';
						}
						if ( ! empty( $settings['icon'] ) ) {
							$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
							$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
						}		
						$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
						$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
						if( $settings['selected_icon'] ){
							echo '<div '. $this->get_render_attribute_string( 'icon-wrapper' ) .'>';
								if ( $is_new || $migrated ) :
									Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
								else : ?>
									<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
								<?php endif; 
							echo '</div>';
						}
					break;
					
					case "count": 
						echo '<div class="counter-value">';
							echo '<h3><span class="counter-up" data-count="'. esc_attr( $count_val ) .'" data-duration="'. esc_attr( $duration ) .'">0</span>';
							if( $count_suffix_val ) echo '<span class="counter-suffix">'. esc_html( $count_suffix_val ) .'</span>';
							echo '</h3>';
						echo '</div><!-- .counter-value -->';	
					break;
					
					case "content":
						echo '<div class="counter-content">';
							echo '<p>'. esc_textarea( $content ) .'</p>';
						echo '</div><!-- .counter-read-more -->';		
					break;
					
					case "image":						
						//Image Section
						if ( ! empty( $settings['image']['url'] ) ) {
							$this->image_class = 'image_class';
							$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
							$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
							$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
							$this->add_render_attribute( 'image_class', 'class', 'img-fluid' ); 
							$this->add_render_attribute( 'image_class', 'class', $settings['img_style'] ); 

				
							if ( $settings['hover_animation'] ) {
								$this->add_render_attribute( 'image_class', 'class', 'elementor-animation-' . $settings['hover_animation'] );
							}
							$counter_image = Classic_Elementor_Extension::cea_get_attachment_image_html( $settings, 'thumbnail', 'image', $this );
							echo '<figure class="counter-image">' . $counter_image . '</figure>';
						}														
					break;					
					
				}
			} // foreach end
			
			if( $counter_layout == 'list' ){
					echo '</div><!-- .counter-right -->';
				echo '</div><!-- .media -->';
			}
				
		endif;

	}
	
}