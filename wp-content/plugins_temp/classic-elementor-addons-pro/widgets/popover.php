<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Popover Widget
 *
 * @since 1.0.0
 */
 
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
 
class CEA_Elementor_Popover_Widget extends Widget_Base {
	
	public $image_class;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Blog widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceapopover";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Blog widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Popover", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Blog widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-receipt";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Popover widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'pop', 'popover', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Popover widget belongs to.
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
		return [ 'cea-custom-front' ];
	}
	
	/**
	 * Register Popover widget controls.
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
				"description"	=> esc_html__( "Default counter options.", 'classic-elementor-addons-pro' ),
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
		$this->add_control(
			'popover_type',
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
			'popover_pos',
			[
				'label' => __( 'Popover Position', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'top' => [
						'title' => __( 'Top', 'elementor' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'elementor' ),
						'icon' => 'eicon-v-align-bottom',
					],
					'left' => [
						'title' => __( 'Left', 'elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'Right', 'elementor' ),
						'icon' => 'eicon-h-align-right',
					]
				],
				'toggle' => false,
			]
		);		
		$this->add_control(
			"event_name",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Select Event", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for popover shown by click or hover.", 'classic-elementor-addons-pro' ),
				"default"		=> "hover",
				"options"		=> [
					"hover"		=> esc_html__( "Hover", 'classic-elementor-addons-pro' ),
					"click"		=> esc_html__( "Click", 'classic-elementor-addons-pro' )
				]
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
					"popover_type" 	=> "icon"
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
					"popover_type" 	=> "img"
				]
			]
		);	
		$this->add_control(
			"popover_img",
			[
				"type" => Controls_Manager::MEDIA,
				"label" => __( "Popover Trigger Image", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose popover trigger image.", 'classic-elementor-addons-pro' ),
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
					"popover_type" 	=> "btn"
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
		],//self::get_button_sizes(),
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
					"popover_type" 	=> "txt"
				]
			]
		);
		$this->add_control(
			"popover_text",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Popover Text", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose popover custom text here.", 'classic-elementor-addons-pro' ),
				'default' => esc_html__( "Popover me", 'classic-elementor-addons-pro' ),
			]
		);
		$this->end_controls_section();

		//Content Section
		$this->start_controls_section(
			"content_section",
			[
				"label"			=> esc_html__( "Popover Content", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_control(
			"popover_content",
			[
				"type"			=> Controls_Manager::WYSIWYG,
				"label" 		=> esc_html__( "Popover Content", 'classic-elementor-addons-pro' ),
				"default" 		=> "Sample Popover Content",
			]
		);
		$this->end_controls_section();
		
		// Style Content Section
		$this->start_controls_section(
			'section_general_style',
			[
				'label' => __( 'General', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'text_align',
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
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .popover-outer-wrapper' => 'text-align: {{VALUE}};'
				]
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
					"popover_type" 	=> "icon"
				]
			]
		);
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
					'{{WRAPPER}} .popover-trigger-icon > *' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cea-popover-trigger.popover-trigger-icon svg' => 'width: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .popover-trigger-icon > *' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-popover-trigger.popover-trigger-icon svg' => 'fill: {{VALUE}};'
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
					'{{WRAPPER}} .popover-trigger-icon:hover > *' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-popover-trigger.popover-trigger-icon:hover svg' => 'fill: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		// Style Image Section
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				"condition" 	=> [
					"popover_type" 	=> "img"
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
					'{{WRAPPER}} .popover-trigger-img > img' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .popover-trigger-img:hover > img' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .popover-trigger-img:hover > img' => 'border-color: {{VALUE}};'
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
					'{{WRAPPER}} .popover-trigger-img > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;',
					'{{WRAPPER}} .popover-trigger-img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
				],
			]
		);
		$this->add_responsive_control(
			'img_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .popover-trigger-img > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'img_border',
					'label' => esc_html__( 'Border', 'classic-elementor-addons-pro' ),
					'selector' => '{{WRAPPER}} .popover-trigger-img > img'
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
					"popover_type" 	=> "btn"
				]
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .popover-wrapper .cea-button',
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
					'{{WRAPPER}} .popover-wrapper .cea-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
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
					'{{WRAPPER}} .popover-wrapper .cea-button' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .popover-wrapper .cea-button:hover, {{WRAPPER}} .popover-wrapper .cea-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .popover-wrapper .cea-button:hover svg, {{WRAPPER}} .popover-wrapper .cea-button:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .popover-wrapper .cea-button:hover, {{WRAPPER}} .popover-wrapper .cea-button:focus' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .popover-wrapper .cea-button:hover, {{WRAPPER}} .popover-wrapper .cea-button:focus' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .popover-wrapper .cea-button',
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
					'{{WRAPPER}} .popover-wrapper .cea-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .popover-wrapper .cea-button',
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .popover-wrapper .cea-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'selector' 		=> '{{WRAPPER}} .popover-wrapper .cea-button'
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
					"popover_type" 	=> "txt"
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
					'{{WRAPPER}} .popover-trigger-txt' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .popover-trigger-txt:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'text_typography',
				'selector' 		=> '{{WRAPPER}} .popover-trigger-txt'
			]
		);
		$this->end_controls_section();
		
		// Style Popover Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__( 'Popover Content', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'popover_width',
			[
				'label' => esc_html__( 'Popover Width', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 1000,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 250,
				],
				'selectors' => [
					'{{WRAPPER}} .popover-wrapper .popover-content' => 'width: {{SIZE}}px; max-width: {{SIZE}}px;',
					'{{WRAPPER}} .popover-wrapper .popover-content' => 'width: {{SIZE}}px; max-width: {{SIZE}}px;'
				],
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .popover-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .popover-content' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'content_bg',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .popover-content' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .popover-content > .arrow:after' => 'border-left-color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .popover-content'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'content_border',
				'selector' => '{{WRAPPER}} .popover-content',
			]
		);
		$this->add_control(
			'content_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .popover-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .popover-content',
			]
		);
		$this->end_controls_section();
		
	}
	
	/**
	 * Render Popover widget output on the frontend.
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

		$class = isset( $extra_class ) && $extra_class != '' ? ' '. $extra_class : '';
		?>
		
		<div class="elementor-widget-container popover-outer-wrapper<?php echo esc_attr( $class ); ?>">
		
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
	 * Render Popover widget output on the frontend.
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
		$popover_type = isset( $popover_type ) && !empty( $popover_type ) ? $popover_type : 'icon';
		$popover_content = isset( $popover_content ) && !empty( $popover_content ) ? $popover_content : '';
		$popover_pos = isset( $popover_pos ) && !empty( $popover_pos ) ? 'popover-'.$popover_pos : 'popover-top';
		$event_name = isset( $event_name ) && !empty( $event_name ) ? $event_name : 'hover';
		$popover_trigger = '';
		$this->add_render_attribute( 'popover-wrapper', 'class', 'popover-wrapper' );
		$this->add_render_attribute( 'popover-wrapper', 'class', $popover_pos );
		?>
		
		<div <?php echo $this->get_render_attribute_string( 'popover-wrapper' ); ?>>
		
		<?php
		
		switch( $popover_type ){
		
			case "img":
				if ( ! empty( $settings['popover_img']['url'] ) ) {		
					$this->image_class = 'image_class';
					$this->add_render_attribute( 'image-wrap', 'class', 'cea-popover-trigger popover-trigger-img' );
					$this->add_render_attribute( 'image-wrap', 'data-event', esc_attr( $event_name ) );
					$this->add_render_attribute( 'image', 'src', $settings['popover_img']['url'] );
					$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['popover_img'] ) );
					$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['popover_img'] ) );
					$this->add_render_attribute( 'image_class', 'class', 'img-fluid' ); 
					$this->add_render_attribute( 'image_class', 'class', $settings['img_style'] );
					?>
					<a <?php echo $this->get_render_attribute_string( 'image-wrap' ); ?>>
					<?php echo Classic_Elementor_Extension::cea_get_attachment_image_html( $settings, 'full', 'popover_img', $this ); ?>
					</a>
					<?php
				}
			break;
			
			case "txt":
				$popover_text = isset( $popover_text ) && $popover_text != '' ? $popover_text : esc_html__( 'Popover', 'classic-elementor-addons-pro' );
				echo '<a class="cea-popover-trigger popover-trigger-txt" href="#" data-event="'. esc_attr( $event_name ) .'">'. esc_html( $popover_text ) .'</a>';
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
				$this->add_render_attribute( 'button', 'class', 'cea-popover-trigger popover-trigger-btn' );
				$this->add_render_attribute( 'button', 'data-event', esc_attr( $event_name ) );
				?>
				<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
					<?php $this->button_render_text(); ?>
				</a>
				<?php
			break;
			
			case "icon":
				$this->add_render_attribute( 'icon-wrapper', 'class', 'cea-popover-trigger popover-trigger-icon' );		
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
				echo '<a '. $this->get_render_attribute_string( 'icon-wrapper' ) .'>';
					if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
					<?php endif; 
				echo '</a>';
			break;
		}
		?>
			<div class="popover-content">
				<div class="arrow"></div>
				<div class="popover-message"><?php echo $popover_content; ?></div>
			</div>
		</div>
		<?php
		
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