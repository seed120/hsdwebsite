<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Cea Offcanvas
 *
 * @since 1.0.0
 */
 
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
 
class CEA_Elementor_Offcanvas_Widget extends Widget_Base {
	
	public $image_class;
	
	public $offcanvas_output;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Cea Offcanvas widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceaoffcanvas";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Cea Offcanvas widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Offcanvas", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Cea Offcanvas widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-sidebar-right";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Offcanvas widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'offcanvas', 'canvas', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Cea Offcanvas widget belongs to.
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
	 * Register Cea Offcanvas widget controls.
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
				"offcanvas"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default offcanvas options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'offcanvas_type',
			[
				'label' => __( 'Popover Trigger Type', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'icon',
				'options' => [
					'icon' => [
						'title' => __( 'Icon', 'elementor' ),
						'icon' => 'eicon-icon-box',
					],
					'btn' => [
						'title' => __( 'Button', 'elementor' ),
						'icon' => 'eicon-button',
					],
					'img' => [
						'title' => __( 'Image', 'elementor' ),
						'icon' => 'eicon-image',
					],
					'txt' => [
						'title' => __( 'Text', 'elementor' ),
						'icon' => 'eicon-text',
					]
				],
				'toggle' => false,
			]
		);
		$this->add_control(
			"cea_offcanvas_animation",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Offcanvas Animation", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose offcanvas animation type.", 'classic-elementor-addons-pro' ),
				"default"		=> "right-overlay",
				"options"		=> [
					"right-overlay"	=> esc_html__( "Right Overlay", 'classic-elementor-addons-pro' ),
					"left-overlay"	=> esc_html__( "Left Overlay", 'classic-elementor-addons-pro' ),
					"right-push"	=> esc_html__( "Right Push", 'classic-elementor-addons-pro' ),
					"left-push"		=> esc_html__( "Left Push", 'classic-elementor-addons-pro' )
				]
			]
		);		
		$this->add_control(
			"offcanvas_mode",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Offcanvas Type", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for offcanvas type either text content or html element. If choose HTML element, then have to put element ID into the each offcanvas element box", 'classic-elementor-addons-pro' ),
				"default"		=> "content",
				"options"		=> [
					"content"	=> esc_html__( "Text Content", 'classic-elementor-addons-pro' ),
					"element"	=> esc_html__( "HTML Element", 'classic-elementor-addons-pro' )
				]
			]
		);		
		$this->add_control(
			"cea_offcanvas_content",
			[
				"label"			=> esc_html__( "Offcanvas Content", "plugin-domain" ),
				"type" 			=> Controls_Manager::WYSIWYG,
				"description" 	=> esc_html__( "You can place here offcanvas content.", "plugin-domain" ),
				"condition" 	=> [
					"offcanvas_mode" 	=> "content"
				],
			]
		);
		$this->add_control(
			"cea_element_id",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Element ID", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter element id to get the content from the element to offcanvas part.", 'classic-elementor-addons-pro' ),
				"condition" 	=> [
					"offcanvas_mode" 	=> "element"
				],
			]
		);
		$this->end_controls_section();	
		
		//Icon Section
		$this->start_controls_section(
			"icon_section",
			[
				"label"			=> esc_html__( "Icon", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Icon options available here.", 'classic-elementor-addons-pro' ),
				"condition" 	=> [
					"offcanvas_type" 	=> "icon"
				]
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
				]				
			]
		);
		$this->end_controls_section();
				
		// Image Section
		$this->start_controls_section(
			"image_section",
			[
				"label"			=> esc_html__( "Image", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Image options available here.", 'classic-elementor-addons-pro' ),
				"condition" 	=> [
					"offcanvas_type" 	=> "img"
				]
			]
		);	
		$this->add_control(
			"offcanvas_img",
			[
				"type" => Controls_Manager::MEDIA,
				"label" => __( "Popover Trigger Image", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose offcanvas trigger image.", 'classic-elementor-addons-pro' ),
				"dynamic" => [
					"active" => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
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
				"condition" 	=> [
					"offcanvas_type" 	=> "btn"
				]
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
			],
				'style_transfer' => true,
			]
		);
		$this->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
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
				],
			]
		);
		$this->add_control(
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
			]
		);
		$this->add_control(
			'button_view',
			[
				'label' => esc_html__( 'View', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
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

			]
		);
		$this->end_controls_section();			
		
		//Text Section
		$this->start_controls_section(
			"text_section",
			[
				"label"			=> esc_html__( "Text", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Text options available here.", 'classic-elementor-addons-pro' ),
				"condition" 	=> [
					"offcanvas_type" 	=> "txt"
				]
			]
		);
		$this->add_control(
			"offcanvas_text",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Popover Text", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose offcanvas custom text here.", 'classic-elementor-addons-pro' ),
				'default' => esc_html__( "Popover me", 'classic-elementor-addons-pro' ),
			]
		);
		$this->end_controls_section();
			
		// Style General Section
		$this->start_controls_section(
			'section_general_style',
			[
				'label' => __( 'General', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'offcanvas_color',
			[
				'label' => esc_html__( 'Offcanvas Font Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#111',
			]
		);
		$this->add_control(
			"offcanvas_link_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Link Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the link color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
			]
		);
		$this->add_control(
			"offcanvas_link_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Link Hover Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the link hover color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
			]
		);
		$this->end_controls_section();
		
		// Style Icon Section
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				"condition" 	=> [
					"offcanvas_type" 	=> "icon"
				]
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
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .offcanvas-trigger-icon > *' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-offcanvas-trigger.offcanvas-trigger-icon svg' => 'fill: {{VALUE}};' //->Modified
				]
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
			'icon_hcolor',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}} .offcanvas-trigger-icon:hover > *' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-offcanvas-trigger.offcanvas-trigger-icon:hover svg' => 'fill: {{VALUE}};' //->Modified
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'selectors' => [
					'.offcanvas-trigger-icon > *' => 'font-size: {{SIZE}}{{UNIT}};',
					'.cea-offcanvas-trigger.offcanvas-trigger-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' //->Modified
				],
				'separator' => 'before',
			]
		);
		$this->end_controls_section();
		
		// Style Image Section
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				"condition" 	=> [
					"offcanvas_type" 	=> "img"
				]
			]
		);
		$this->start_controls_tabs( 'image_styles' );
		$this->start_controls_tab(
			'img_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'img_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .offcanvas-trigger-img > img' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'img_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'img_bg_hcolor',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .offcanvas-trigger-img:hover > img' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'img_border_hcolor',
			[
				'label' => esc_html__( 'Border Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .offcanvas-trigger-img:hover > img' => 'border-color: {{VALUE}};'
				],
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
					'{{WRAPPER}} .offcanvas-trigger-img > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;',
					'{{WRAPPER}} .offcanvas-trigger-img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_responsive_control(
			'img_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .offcanvas-trigger-img > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'img_border',
					'label' => esc_html__( 'Border', 'classic-elementor-addons-pro' ),
					'selector' => '{{WRAPPER}} .offcanvas-trigger-img > img'
				]
		);
		$this->end_controls_section();
		
		// Style Button Section
		$this->start_controls_section(
			'button_section_style',
			[
				'label' => esc_html__( 'Button', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				"condition" 	=> [
					"offcanvas_type" 	=> "btn"
				]
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
		$this->add_responsive_control(
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
		
		// Style Text Section
		$this->start_controls_section(
			'section_style_txet',
			[
				'label' => esc_html__( 'Trigger Text', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				"condition" 	=> [
					"offcanvas_type" 	=> "txt"
				]
			]
		);
		$this->start_controls_tabs( 'text_colors' );
		$this->start_controls_tab(
			'text_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .offcanvas-trigger-txt' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'text_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'text_hcolor',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .offcanvas-trigger-txt:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'text_typography',
				'selector' 		=> '{{WRAPPER}} .offcanvas-trigger-txt'
			]
		);
		$this->end_controls_section();
	
	}
	
	/**
	 * Render Offcanvas widget output on the frontend.
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
		
		?>
		
		<div class="elementor-widget-container cea-offcanvas-elementor-widget">
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
	 * Render Offcanvas widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		$output = '';
		$event_name = '';

		$offcanvas_mode = isset( $offcanvas_mode ) && !empty( $offcanvas_mode ) ? $offcanvas_mode : 'content';
		$offcanvas_animation = isset( $cea_offcanvas_animation ) && !empty( $cea_offcanvas_animation ) ? $cea_offcanvas_animation : 'right-overlay';
		
		$rand_id = cea_shortcode_rand_id();
		$offcanvas_element = 'cea-offcanvas-'. $rand_id;
		$offcanvas_type = isset( $offcanvas_type ) && !empty( $offcanvas_type ) ? $offcanvas_type : 'icon';
				
		$offcanvas_trigger = '';

		//Trigger Code
		ob_start();
		switch( $offcanvas_type ){
		
			case "img":
				if ( ! empty( $settings['offcanvas_img']['url'] ) ) {		
					$this->image_class = 'image_class';
					$this->add_render_attribute( 'image-wrap', 'class', 'cea-offcanvas-trigger offcanvas-trigger-img' );
					$this->add_render_attribute( 'image-wrap', 'data-event', esc_attr( $event_name ) );
					$this->add_render_attribute( 'image', 'src', $settings['offcanvas_img']['url'] );
					$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['offcanvas_img'] ) );
					$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['offcanvas_img'] ) );
					$this->add_render_attribute( 'image', 'class', 'img-fluid' ); 
					$this->add_render_attribute( 'image', 'class', $settings['img_style'] ); 
					?>
					<a <?php echo $this->get_render_attribute_string( 'image-wrap' ); ?> data-offcanvas-id="<?php echo esc_attr( $offcanvas_element ); ?>">
					<?php echo Classic_Elementor_Extension::cea_get_attachment_image_html( $settings, 'full', 'offcanvas_img', $this );  ?>
					</a>
					<?php
				}
			break;
			
			case "txt":
				$offcanvas_text = isset( $offcanvas_text ) && $offcanvas_text != '' ? $offcanvas_text : esc_html__( 'Popover', 'classic-elementor-addons-pro' );
				echo '<a class="cea-offcanvas-trigger offcanvas-trigger-txt" href="#" data-event="'. esc_attr( $event_name ) .'" data-offcanvas-id="'. esc_attr( $offcanvas_element ) .'">'. esc_html( $offcanvas_text ) .'</a>';
			break;
			
			case "btn":
				$this->add_render_attribute( 'button', 'class', 'elementor-button cea-button' );
				if ( ! empty( $settings['button_css_id'] ) ) {
					$this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
				}
				if ( $settings['button_type'] != 'none' ) {
					$this->add_render_attribute( 'button', 'class', 'cea-button-' . $settings['button_type'] );
				}
				if ( ! empty( $settings['button_size'] ) ) {
					$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['button_size'] );
				}
				$this->add_render_attribute( 'button', 'class', 'cea-offcanvas-trigger offcanvas-trigger-btn' );
				$this->add_render_attribute( 'button', 'data-event', esc_attr( $event_name ) );
				?>
				<a <?php echo $this->get_render_attribute_string( 'button' ); ?> data-offcanvas-id="<?php echo esc_attr( $offcanvas_element ); ?>">
					<?php $this->button_render_text(); ?>
				</a>
				<?php
			break;
			
			case "icon":
				$this->add_render_attribute( 'icon-wrapper', 'class', 'cea-offcanvas-trigger offcanvas-trigger-icon' );		
				$this->add_render_attribute( 'icon-wrapper', 'href', '#' );
				$this->add_render_attribute( 'icon-wrapper', 'data-event', esc_attr( $event_name ) );
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
				echo '<a '. $this->get_render_attribute_string( 'icon-wrapper' ) .' data-offcanvas-id="'. esc_attr( $offcanvas_element ) .'">';
					if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
					<?php endif; 
				echo '</a>';
			break;
		}
		$offcanvas_trigger = ob_get_clean();

				
		//Get the color settings
		$offcanvas_color = isset( $offcanvas_color ) && !empty( $offcanvas_color ) ? $offcanvas_color : '#111';
		$offcanvas_link_color = isset( $offcanvas_link_color ) && !empty( $offcanvas_link_color ) ? $offcanvas_link_color : '';
		$offcanvas_link_hcolor = isset( $offcanvas_link_hcolor ) && !empty( $offcanvas_link_hcolor ) ? $offcanvas_link_hcolor : '';

		$custom_css = '';
		if ($offcanvas_color) {
		    $custom_css .= "#$offcanvas_element .cea-offcanvas-wrap-inner { color: $offcanvas_color; }";
		    do_action( 'qm/debug', 'Color running' );
		}
		if ($offcanvas_link_color) {
		    $custom_css .= "#$offcanvas_element .cea-offcanvas-wrap-inner a { color: $offcanvas_link_color; }";
		}
		if ($offcanvas_link_hcolor) {
		    $custom_css .= "#$offcanvas_element .cea-offcanvas-wrap-inner a:hover { color: $offcanvas_link_hcolor; }";
		}
		if($custom_css) {
		    echo '<style>' . $custom_css . '</style>';
		}
		
		//Content Code
		$offcanvas_content = '';
		$class = '';
		if( $offcanvas_mode == 'content' ){
			$offcanvas_content = isset( $cea_offcanvas_content ) && !empty( $cea_offcanvas_content ) ? $cea_offcanvas_content : '';
		}else{
			$offcanvas_content = isset( $cea_element_id ) && !empty( $cea_element_id ) ? '<span class="cea-offcanvas-id-to-element" data-id="'. esc_attr( $cea_element_id ) .'"></span>' : '';
		}		
		
		$class .= ' offcanvas-'. $offcanvas_animation;
		
		$offcanvas_output = '';
		$offcanvas_output .= '<div class="cea-offcanvas-wrap'. esc_attr( $class ) .'" id="'. esc_attr( $offcanvas_element ) .'" data-canvas-animation="'. esc_attr( $offcanvas_animation ) .'">';
			$offcanvas_output .= '<span class="cea-close cea-offcanvas-close"></span>';
			$offcanvas_output .= '<div class="cea-offcanvas-wrap-inner">';				
				$offcanvas_output .= $offcanvas_content;
			$offcanvas_output .= '</div><!-- .cea-offcanvas-wrap-inner -->';
		$offcanvas_output .= '</div><!-- .cea-offcanvas-wrap -->';
		$this->offcanvas_output = $offcanvas_output;
		add_action( 'wp_footer', array( $this, 'cea_offcanvas_content' ), 10 );
		
		$output .= $offcanvas_trigger;
		echo $output;
	}
		
	public function cea_offcanvas_content(){
		echo $this->offcanvas_output;
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
			<?php if( isset( $settings['button_icon']['library'] ) && !empty( $settings['button_icon']['library'] ) ): ?>
			<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
				<?php if ( $is_new || $migrated ) :
					Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
				else : ?>
					<i class="<?php echo esc_attr( $settings['button_icon'] ); ?>" aria-hidden="true"></i>
				<?php endif; ?>
			</span>
			<?php endif; ?>
			<?php endif; ?>
			<span <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo $settings['button_text']; ?></span>
		</span>
		<?php
	}
		
}