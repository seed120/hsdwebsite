<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Modal Popup
 *
 * @since 1.0.0
 */
 
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Classic_Elementor_Addons\Helper\Post_Helper as Cea_Post_Helper;
 
class CEA_Elementor_Modal_Popup_Widget extends Widget_Base {
	use Cea_Post_Helper;
	
	public $image_class;
	/**
	 * Get widget name.
	 *
	 * Retrieve Modal Popup widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceamodalpopup";
	}
	/**
	 * Get widget title.
	 *
	 * Retrieve Modal Popup widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Modal Popup", 'classic-elementor-addons-pro' );
	}
	/**
	 * Get widget icon.
	 *
	 * Retrieve Modal Popup widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layers";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Modal Popup widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'modal', 'popup', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Modal Popup widget belongs to.
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
		return [ 'magnific-popup', 'cea-custom-front' ];
	}
	
	public function get_style_depends() {
		return [ 'magnific-popup' ];
	}
	
	/**
	 * Register Modal Popup widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		// $modal_key = $this->get_id();

		//General Section
		$this->start_controls_section(
			"general_section",
			[
				"label"	=> esc_html__( "Popup", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default popup options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"popup_type",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Popup Type", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for popup type.", 'classic-elementor-addons-pro' ),
				"default"		=> "txt",
				"options"		=> [
					"icon"	=> esc_html__( "Icon", 'classic-elementor-addons-pro' ),
					"btn"	=> esc_html__( "Button", 'classic-elementor-addons-pro' ),
					"img"	=> esc_html__( "Image", 'classic-elementor-addons-pro' ),
					"txt"	=> esc_html__( "Text", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->add_responsive_control(
			'text_align',
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
				'selectors' => [
					'{{WRAPPER}} .modal-popup-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		
		//Icon Section
		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'condition' => [
					'popup_type' => 'icon',
				],
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
				"description"	=> esc_html__( "Popup trigger image options available here.", 'classic-elementor-addons-pro' ),
				'condition' => [
					'popup_type' => 'img',
				],
			]
		);
		$this->add_control(
			"image",
			[
				"type" => Controls_Manager::MEDIA,
				"label" => esc_html__( "Image", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose popup trigger image.", 'classic-elementor-addons-pro' ),
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
		
		// Button
		$this->start_controls_section(
			"button_section",
			[
				"label"			=> esc_html__( "Button", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Button options available here.", 'classic-elementor-addons-pro' ),
				'condition' => [
					'popup_type' => 'btn',
				],
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
		
		// Text
		$this->start_controls_section(
			"text_section",
			[
				"label"			=> esc_html__( "Text", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Popup trigger text.", 'classic-elementor-addons-pro' ),
				'condition' => [
					'popup_type' => 'txt',
				]
			]
		);
		$this->add_control(
			"popup_text",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Popup Trigger Text", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Example: Click here", 'classic-elementor-addons-pro' ),
				"default"		=> esc_html__( "Click here", 'classic-elementor-addons-pro' ),
			]
		);
		$this->end_controls_section();
		
		//Modal Section
		$this->start_controls_section(
			"modal_section",
			[
				"label"			=> esc_html__( "Content", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Modal content options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"title_head",
			[
				"label"			=> esc_html__( "Modal Title Tag", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can choose the modal popup box title heading tag.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h3",
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
			"modal_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Modal Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the modal popup box title.", 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			"modal_content",
			[
				"label"			=> esc_html__( "Modal Content", "plugin-domain" ),
				"type" 			=> Controls_Manager::WYSIWYG,
				"default" 		=> esc_html__( "You can place here modal popup content.", "plugin-domain" ),
				"placeholder" 	=> esc_html__( "Type modal content here.", "plugin-domain" ),
			]
		);
		$this->add_control(
			"popup_size",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Modal Popup Size", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for modal popup window size.", 'classic-elementor-addons-pro' ),
				"default"		=> "md",
				"options"		=> [
					"md"		=> esc_html__( "Medium", 'classic-elementor-addons-pro' ),
					"lg"		=> esc_html__( "Large", 'classic-elementor-addons-pro' ),
					"sm"		=> esc_html__( "Small", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->end_controls_section();
	
		// Style Icon Section
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Trigger Icon', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'popup_type' => 'icon',
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
			'icon_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .cea-modal-box-trigger' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-modal-box-trigger svg' => 'fill: {{VALUE}};'
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
					'{{WRAPPER}}.cea-view-framed .cea-modal-box-trigger' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.cea-view-stacked .cea-modal-box-trigger' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'icon_border_color',
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
					'{{WRAPPER}}.cea-view-framed .cea-modal-box-trigger' => 'border-color: {{VALUE}};'
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
					'{{WRAPPER}}:hover .cea-modal-box-trigger' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .cea-modal-box-trigger svg' => 'fill: {{VALUE}};'
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
					'{{WRAPPER}}.cea-view-framed:hover .cea-modal-box-trigger' => 'background-color: {{VALUE}};',
					'{{WRAPPER}}.cea-view-stacked:hover .cea-modal-box-trigger' => 'background-color: {{VALUE}};'
				],
			]
		);	
		$this->add_control(
			'icon_border_hcolor',
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
					'{{WRAPPER}}.cea-view-framed:hover .cea-modal-box-trigger' => 'border-color: {{VALUE}};'
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
					'{{WRAPPER}} .cea-modal-box-trigger' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}}.cea-view-stacked .cea-modal-box-trigger' => 'padding: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.cea-view-framed .cea-modal-box-trigger' => 'padding: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .cea-modal-box-trigger i, {{WRAPPER}} .cea-modal-box-trigger svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
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
					'{{WRAPPER}} .cea-modal-box-trigger' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .cea-modal-box-trigger' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_border_width',
			[
				'label' => esc_html__( 'Border Width', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-modal-box-trigger' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .cea-modal-box-trigger' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .modal-popup-wrapper:hover .cea-modal-box-trigger.cea-elementor-animation' => 'animation-name: {{VALUE}};'
				]
			]
		);		
		$this->end_controls_section();
		
		// Style Image Section		
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Trigger Image', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'popup_type' => 'img',
				]
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
					'{{WRAPPER}} .modal-popup-wrapper .popup-trigger-img > img' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .modal-popup-wrapper:hover .popup-trigger-img > img' => 'background-color: {{VALUE}};'
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
					'{{WRAPPER}} .popup-trigger-img > img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;',
					'{{WRAPPER}} .popup-trigger-img' => 'width: {{SIZE}}%; max-width: {{SIZE}}%;'
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
					'{{WRAPPER}} .popup-trigger-img' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);		
		$this->add_responsive_control(
			'counter_img_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .popup-trigger-img > img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'counter_img_border',
					'label' => esc_html__( 'Border', 'classic-elementor-addons-pro' ),
					'selector' => '{{WRAPPER}} .popup-trigger-img > img'
				]
		);
		$this->end_controls_section();
		
		// Style Button Section
		$this->start_controls_section(
			'button_section_style',
			[
				'label' => esc_html__( 'Trigger Button', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'popup_type' => 'btn',
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
		
		// Style Text Section
		$this->start_controls_section(
			'section_style_text',
			[
				'label' => __( 'Trigger Text', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'popup_type' => 'txt',
				]
			]
		);
		$this->add_responsive_control(
			'popup_text_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .modal-popup-wrapper .popup-trigger-txt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'popup_text_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .modal-popup-wrapper .popup-trigger-txt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->start_controls_tabs( 'popup_text_styles' );
			$this->start_controls_tab(
				'popup_text_normal',
				[
					'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'popup_textfont_color',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .modal-popup-wrapper .popup-trigger-txt' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'popup_textbg_color',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .modal-popup-wrapper .popup-trigger-txt' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'popup_text_hover',
				[
					'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'popup_textfont_hcolor',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .modal-popup-wrapper:hover .popup-trigger-txt' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'popup_textbg_hcolor',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .modal-popup-wrapper:hover .popup-trigger-txt' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->end_controls_tab();	
		$this->end_controls_tabs();	
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Trigger Text Typo', 'classic-elementor-addons-pro' ),
				'name' 			=> 'popup_text_typography',
				'selector' 		=> '{{WRAPPER}} .modal-popup-wrapper .popup-trigger-txt'
			]
		);	
		$this->end_controls_section();
		
		// Style Title Section
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for modal popup title.", 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'title_padding',
				[
					'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::DIMENSIONS,
					'selectors' => [
						'{{WRAPPER}} .modal-popup-title'=> 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'default' => [
						'unit' => 'px',
						'size' => 0
					]
				]
			);
			$this->add_responsive_control(
				'title_margin',
				[
					'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::DIMENSIONS,
					'selectors' => [
						'{{WRAPPER}} .modal-popup-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'title_color',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .modal-popup-title' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Title Typography', 'classic-elementor-addons-pro' ),
					'name' 			=> 'title_typography',
					'selector' 		=> '{{WRAPPER}} .modal-popup-title',
				]
			);
		
		$this->end_controls_section();
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for modal popup content.", 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'popup_padding',
				[
					'label' => esc_html__( 'Padding' . $this->get_id(), 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::DIMENSIONS,
					'selectors' => [
						'{{WRAPPER}}.modal-popup-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
					],
				]
			);
			$this->add_control(
				'content_font_color',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}.modal-popup-content' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'content_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}}.modal-popup-content' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_responsive_control(
				'content_align',
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
					'selectors' => [
						'{{WRAPPER}}.modal-popup-content' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => esc_html__( 'Content Typography', 'classic-elementor-addons-pro' ),
					'name' 			=> 'popup_content_typography',
					'selector' 		=> '{{WRAPPER}}.modal-popup-content'
				]
			);

		$this->end_controls_section();	
			
	}
	
	// public static function modal_key( $stat = 0 ){
	// 	static $key = 1;
	// 	if( !$stat ) $key++;
	// 	else return $key;
	// }
		
	/**
	 * Render Modal Popup widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		
		//$modal_key = self::modal_key( 1 );
		
		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		//Define Variables
		$class = $output = '';		
		$popup_size = isset( $popup_size ) ? ' modal-' . $popup_size : '';
		$title_head = isset( $title_head ) ? $title_head : 'h3';
		$modal_content = isset( $modal_content ) ? $modal_content : '';
		$shortcode_rand_id = cea_shortcode_rand_id();  //self::modal_key( 1 );
		$modal_id = '#cea-modal-'. $shortcode_rand_id;
		$item_id = 'cea-modal-'. $shortcode_rand_id;		
		$class .= $popup_type == 'load' ? ' cea-page-load-modal' : '';
		$_element = get_the_ID();
		$_widget = $this->get_id();
		$elementor_cls = 'elementor-'. $_element;
		$widget_cls = 'elementor-element elementor-element-'. $_widget;
		
		
		echo '<div class="modal-popup-wrapper'. esc_attr( $class ) .'">';		
			//Modal Trigger
			switch( $popup_type ){			
				case "img":
					// Image Section
					if (!empty($settings['image']['url'])) {
						$image_class = 'img-fluid ' . esc_attr($settings['img_style']);
						if ($settings['hover_animation']) {
							$image_class .= ' elementor-animation-' . $settings['hover_animation'];
						}
				
						$this->add_render_attribute('image', 'src', $settings['image']['url']);
						$this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['image']));
						$this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['image']));
						$this->add_render_attribute('image', 'class', $image_class);
						
						$img_size = wp_get_attachment_image_src( $settings['image']['id'], $settings['thumbnail_size'] ); //->modified
						$width = ( is_array( $img_size ) && ( $img_size[1] ) ) ? $img_size[1] : null ; //->modified
						$height = ( is_array( $img_size ) && ( $img_size[2] ) ) ? $img_size[2] : null ; //->modified
						$this->add_render_attribute( 'image', 'width', $width ); //->modified
						$this->add_render_attribute( 'image', 'height', $height );  //->modified
						
						$modal_image = Classic_Elementor_Extension::cea_get_attachment_image_html($settings, 'thumbnail', 'image', $this);
						echo '<a href="' . esc_attr($modal_id) . '" class="cea-modal-box-trigger popup-trigger-img">' . $modal_image . '</a>';
					}
					break;				
				
				case "btn":
					$this->add_render_attribute( 'button-wrapper', 'class', 'cea-button-wrapper' );
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
					if ( $settings['button_hover_animation'] ) {
						$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
					}
					$this->add_render_attribute( 'button', 'class', 'cea-modal-box-trigger' );
					$this->add_render_attribute( 'button', 'href', esc_attr( $modal_id ) );
					?>
					<div <?php echo $this->get_render_attribute_string( 'button-wrapper' ); ?>>
						<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
							<?php $this->button_render_text(); ?>
						</a>
					</div>
					<?php
				break;
				
				case "txt":
					$popup_text = isset( $popup_text ) && $popup_text != '' ? $popup_text : esc_html__( 'Popup', 'classic-elementor-addons-pro' );
					echo '<a class="cea-modal-box-trigger popup-trigger-txt" href="'. esc_attr( $modal_id ) .'">'. esc_html( $popup_text ) .'</a>';
				break;
				
				case "icon":						
					//Icon Section
					$this->add_render_attribute( 'icon-wrapper', 'class', 'cea-modal-box-trigger' );
					$this->add_render_attribute( 'icon-wrapper', 'class', 'popup-trigger-icon' );
					$this->add_render_attribute( 'icon-wrapper', 'href', esc_attr( $modal_id ) );
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
						echo '<a '. $this->get_render_attribute_string( 'icon-wrapper' ) .'>';
							if ( $is_new || $migrated ) :
								Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
							else : ?>
								<i <?php echo $this->get_render_attribute_string( 'icon' ); ?>></i>
							<?php endif; 
						echo '</a>';
					}
				break;
				
			}

			// Modal 
			echo '<div class="mfp-hide white-popup-block" id="'. esc_attr( $item_id ) .'" >';
				echo '<div class="modal-popup-size '. $elementor_cls .' '. esc_attr( $popup_size ) .'" role="document">';
					echo '<div class="modal-popup-content '. $widget_cls .'">';
						echo '<div class="modal-popup-header">';
							if( isset( $modal_title ) && $modal_title != '' ) echo '<'. esc_attr( $title_head ) .' class="modal-popup-title">'. esc_html( $modal_title ) .'</'. esc_attr( $title_head ) .'>';
							echo '<span class="cea-popup-modal-dismiss ti-close"></span>';
						echo '</div>';
						echo '<div class="modal-popup-body">';
							echo do_shortcode( $modal_content );
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div><!-- .modal-popup-wrapper -->';		

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