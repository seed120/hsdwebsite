<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Mailchimp Widget
 *
 * @since 1.0.0
 */

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
 
class CEA_Elementor_Mailchimp_Widget extends Widget_Base {
	
	public static $custom_id = 0;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Mailchimp widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceamailchimp";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Mailchimp widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Mailchimp", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Mailchimp widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon eicon-mailchimp";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Mailchimp widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'mail', 'chimp', 'mailchimp', 'classic' ];
    }

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Mailchimp widget belongs to.
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
	 * Retrieve the list of scripts the mailchimp widget depended on.
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
	 * Register Mailchimp widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		
		$cea_options = get_option( 'cea_options' );
		$api_key = isset( $cea_options['mailchimp-api'] ) ? $cea_options['mailchimp-api'] : '';
		$mc_lists = array( '' => esc_html__( "Select List", 'classic-elementor-addons-pro' ) );
		if( $api_key ){
			$dc = substr( $api_key, strpos( $api_key, '-' ) + 1 );
			$args = array(
				'headers' => array(
					'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key )
				)
			);
			$response = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/lists/?fields=lists', $args );
			$result = json_decode( wp_remote_retrieve_body( $response ) );
			if( !empty( $result ) && !empty( $result->lists) ) {
				foreach( $result->lists as $list ){	
					$mc_lists[$list->id] = $list->name;
				}
			}
		}

		//Mailchimp Section
		$this->start_controls_section(
			"mailchimp_section",
			[
				"label"	=> esc_html__( "Mailchimp", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default mailchimp options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
					'inline' => esc_html__( 'Inline', 'classic-elementor-addons-pro' )
				],
				'default' => 'default',
			]
		);
		$this->add_control(
			"first_name_opt",
			[
				"label" 		=> esc_html__( "Enable First Name", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"first_name_label",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "First Name Label/Placeholder", 'classic-elementor-addons-pro' ),
				"default" 		=> esc_html__( "First Name", 'classic-elementor-addons-pro' ),
				'condition' => [
					'first_name_opt' => 'yes'
				],
			]
		);
		$this->add_control(
			"last_name_opt",
			[
				"label" 		=> esc_html__( "Enable Last Name", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"last_name_label",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Last Name Label/Placeholder", 'classic-elementor-addons-pro' ),
				"default" 		=> esc_html__( "Last Name", 'classic-elementor-addons-pro' ),
				'condition' => [
					'last_name_opt' => 'yes'
				],
			]
		);
		$this->add_control(
			"email_label",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Email Label/Placeholder", 'classic-elementor-addons-pro' ),
				'default' 		=> esc_html__( "Subscribe", 'classic-elementor-addons-pro' ),
			]
		);
		if( !empty( $result ) ){
			$this->add_control(
				'list_id',
				[
					'label' => esc_html__( 'Select List ID', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::SELECT,
					'options' => $mc_lists,
					'default' => 'default',
				]
			);
		}else{
			$this->add_control(
				'mailchimp_api_notice',
				[
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf( __( '<b>Note:</b> You may forget to put mailchimp API on Classic Elementor Addon -> Plugin Options -> General -> Mailchimp API', 'classic-elementor-addons-pro' ) ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				]
			);
		}
		$this->add_control(
			'btn_type',
			[
				'label' => esc_html__( 'Button Label', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'text',
				'options' => [
					'text' => [
						'title' => esc_html__( 'Text', 'elementor' ),
						'icon' => 'ti-layout-media-center-alt',
					],
					'icon' => [
						'title' => esc_html__( 'Icon', 'elementor' ),
						'icon' => 'ti-layout-media-left',
					]
				],
				'toggle' => false,
			]
		);
		$this->add_control(
			"btn_text",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Button Label", 'classic-elementor-addons-pro' ),
				'default' 		=> esc_html__( "Subscribe", 'classic-elementor-addons-pro' ),
				'condition' => [
					'btn_type' => 'text'
				],
			]
		);
		$this->add_control(
			'btn_icon',
			[
				'label' => esc_html__( 'Button Icon', 'zozo-header-footer' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fa fa-bars', 
					'library' => 'fontawesome',
				],
				'condition' => [
					'btn_type' => 'icon'
				],
			]
		);
		$this->add_control(
			"success_label",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label" 		=> esc_html__( "Success Message", 'classic-elementor-addons-pro' ),
				'default' 		=> esc_html__( "Email added successfully.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"failure_label",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label" 		=> esc_html__( "Failure Message", 'classic-elementor-addons-pro' ),
				'default' 		=> esc_html__( "Subscribe", 'classic-elementor-addons-pro' ),
				'default' 		=> esc_html__( "Email added process failed.", 'classic-elementor-addons-pro' ),
			]
		);		
		$this->end_controls_section();
		
		// Style Icon Section
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'btn_type' => 'icon'
				],
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
				'selectors' => [
					'{{WRAPPER}} .cea-mc > i' => 'color: {{VALUE}};'
				]
			]
		);
		
		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( 'Border Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-mc' => 'border-color: {{VALUE}};'
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
				'selectors' => [
					'{{WRAPPER}} .cea-mc:hover > i' => 'color: {{VALUE}};'
				],
			]
		);
		
		$this->add_control(
			'hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-mc:hover' => 'border-color: {{VALUE}};'
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
					'{{WRAPPER}} .cea-mc > i' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .cea-mc' => 'padding: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .cea-mc > i' => 'transform: rotate({{SIZE}}{{UNIT}});',
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
					'{{WRAPPER}} .cea-mc' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_width',
			[
				'label' => esc_html__( 'Border Width', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-mc' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-mc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);	
		$this->end_controls_section();
		
		// Style Button Section
		$this->start_controls_section(
			'button_section_style',
			[
				'label' => esc_html__( 'Button', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .cea-mc',
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
					'{{WRAPPER}} .cea-mc' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .cea-mc' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .cea-mc:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cea-mc:hover' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .cea-mc:hover' => 'border-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .cea-mc',
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
					'{{WRAPPER}} .cea-mc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .cea-mc',
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cea-mc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'selector' 		=> '{{WRAPPER}} .cea-mc'
			]
		);
		$this->end_controls_section();	
		
		// Style Text Section
		$this->start_controls_section(
			'textbox_section_style',
			[
				'label' => esc_html__( 'Text Box', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'text_placehodler_color',
			[
				'label' => esc_html__( 'Placeholder Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input.form-control' => 'color: {{VALUE}};'
				]
			]
		);
		
		$this->start_controls_tabs( 'textbox_style_group' );
		$this->start_controls_tab(
			'text_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Primary Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input.form-control' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input.form-control' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'text_border',
				'selector' => '{{WRAPPER}} input.form-control',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'text_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} input.form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'text_box_shadow',
				'selector' => '{{WRAPPER}} input.form-control',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'text_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'text_hcolor',
			[
				'label' => esc_html__( 'Primary Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input.form-control:hover, {{WRAPPER}} input.form-control:focus' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_bg_hcolor',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} input.form-control:hover, {{WRAPPER}} input.form-control:focus' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'text_hborder',
				'selector' => '{{WRAPPER}} input.form-control:hover, {{WRAPPER}} input.form-control:focus',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'text_border_hradius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} input.form-control:hover, {{WRAPPER}} input.form-control:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'text_box_hshadow',
				'selector' => '{{WRAPPER}} input.form-control:hover, {{WRAPPER}} input.form-control:focus',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_responsive_control(
			'text_box_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} input.form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'text_box__typography',
				'selector' 		=> '{{WRAPPER}} input.form-control'
			]
		);	
		$this->end_controls_section();

	}
	
	/**
	 * Render Mailchimp widget output on the frontend.
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
		
		$layout_class = isset( $layout ) && $layout != '' ? 'cea-mailchimp-style-' . $layout : '';
		
		$this->add_render_attribute( 'cea-mailchimp-container', 'class', 'elementor-widget-container cea-mailchimp-wrapper' );$this->add_render_attribute( 'cea-mailchimp-container', 'class', $layout_class );
		?>
		
		<div <?php echo ''. $this->get_render_attribute_string( 'cea-mailchimp-container' ); ?>>
		
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
	 * Render Mailchimp widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$sub_title = isset( $sub_title ) && $sub_title != '' ? $sub_title : '';
		$first_name_opt = isset( $first_name_opt ) ? $first_name_opt : 'no';
		$last_name_opt = isset( $last_name_opt ) ? $last_name_opt : 'no';
		$list_id = isset( $list_id ) && $list_id != '' ? $list_id : '';		
		$email_label = isset( $email_label ) ? $email_label : '';
		$btn_type = isset( $btn_type ) ? $btn_type : '';	
		$success_label = isset( $success_label ) ? $success_label : '';	
		$failure_label = isset( $failure_label ) ? $failure_label : '';	
		
		$layout_id = 'zozo-mc-form-'. $this->get_custom_id();
	?>
		<form class="zozo-mc-form" id="<?php echo esc_attr( $layout_id ); ?>" method="post">
		<?php 
		
			wp_nonce_field( 'cea-mailchimp-security^&%^', 'cea_mc_nonce' );
		
		if( $first_name_opt == 'yes' ) {
			$first_name_label = isset( $first_name_label ) && $first_name_label != '' ? $first_name_label : '';
		?>
			<div class="form-group">
				<input type="text" placeholder="<?php echo esc_html( $first_name_label ); ?>" class="form-control first-name" name="cea_mc_first_name" />
			</div>
		<?php
		}
		if( $last_name_opt == 'yes' ) {
			$last_name_label = isset( $last_name_label ) && $last_name_label != '' ? $last_name_label : '';
		?>	
			<div class="form-group">
				<input type="text" placeholder="<?php echo esc_html( $last_name_label ); ?>" class="form-control last-name" name="cea_mc_last_name" />
			</div>
		<?php } ?>
		
		<?php if( !empty( $list_id ) ) { ?>
			<input type="hidden" name="cea_mc_listid" value="<?php echo stripslashes( $list_id ); ?>" />
		<?php } ?>
		
		<?php
			$button_html = '';
			if( $btn_type == 'text' ) {
				$btn_text = isset( $btn_text ) ? $btn_text : '';
				$button_html .= '<button class="input-group-addon cea-mc btn btn-default">'. esc_html( $btn_text ) .'</button>';
			}else{
				$button_html .= '<button class="input-group-addon cea-mc btn btn-default">';
				if ( empty( $settings['btn_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
					// add old default
					$settings['btn_icon'] = 'fa fa-bars';
				}
				if ( ! empty( $settings['btn_icon'] ) ) {
					$this->add_render_attribute( 'open-icon', 'class', $settings['btn_icon'] );
					$this->add_render_attribute( 'open-icon', 'aria-hidden', 'true' );
				}		
				$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
				$is_new = empty( $settings['btn_icon'] ) && Icons_Manager::is_migration_allowed();
				if( $settings['btn_icon'] ){
					echo '<div '. $this->get_render_attribute_string( 'open-icon-wrapper' ) .'>';
						ob_start();
						if ( $is_new || $migrated ) :
							Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );
						else : ?>
							<i <?php echo $this->get_render_attribute_string( 'open-icon' ); ?>></i>
						<?php endif; 
						$button_html .= ob_get_clean();
					$button_html .= '</div></button>';
				}
			}
		?>
		
		<?php if(  $layout == 'default' ) { ?>
			<div class="form-group">
				<input type="text" class="form-control zozo-mc-email" required="required" id="zozo-mc-email" placeholder="<?php echo esc_html( $email_label ); ?>" name="cea_mc_email">
			</div>
			<div class="form-group">
				<?php echo $button_html; ?>
			</div>
		<?php } else { ?>
			<div class="input-group">
				<input type="text" class="form-control zozo-mc-email" required="required" id="zozo-mc-email" placeholder="<?php echo esc_html( $email_label ); ?>" name="cea_mc_email">
				<?php echo $button_html; ?>
			</div>
		<?php } ?>
		</form>
		<!-- Mailchimp Custom Script -->
		<div class="mc-notice-group" data-success="<?php echo esc_html( $success_label ); ?>" data-fail="<?php echo esc_html( $failure_label ); ?>">
			<span class="mc-notice-msg"></span>
		</div><!-- .mc-notice-group -->
		<?php

	}
	
	public static function get_custom_id(){
		return self::$custom_id++;
	}
	
}