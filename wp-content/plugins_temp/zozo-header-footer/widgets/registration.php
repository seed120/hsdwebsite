<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * ZOZO Header Footer Elements Registration
 * @since 1.0.0
 */
 
class ZOZO_HF_Registration_Widget extends Widget_Base {
	
	
	/**
	 * Get widget name.
	 *
	 * Retrieve registration widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "zozo_hf_registration";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve registration widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Registration", "zozo-header-footer" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve registration widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "zhf-icon eicon-lock-user";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the registration widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ "zozo-hf-elements" ];
	}
	
	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'zozo-header-footer'  ];
	}
	
	/**
	 * Retrieve the list of style the widget depended on.
	 *
	 * Used to set style dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget style dependencies.
	 */
	public function get_style_depends() {
		return [ 'zozo-header-footer' ];
	}
	
	/**
	 * Register registration widget controls. 
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		
		//General Section
		$this->start_controls_section(
			'general_section',
			[
				'label'	=> esc_html__( 'General', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			"title_head",
			[
				"label"			=> esc_html__( "Form Title Heading Tag", "zozo-header-footer" ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "h2",
				"options"		=> [
					"h1"		=> esc_html__( "h1", "zozo-header-footer" ),
					"h2"		=> esc_html__( "h2", "zozo-header-footer" ),
					"h3"		=> esc_html__( "h3", "zozo-header-footer" ),
					"h4"		=> esc_html__( "h4", "zozo-header-footer" ),
					"h5"		=> esc_html__( "h5", "zozo-header-footer" ),
					"h6"		=> esc_html__( "h6", "zozo-header-footer" ),
					"p"			=> esc_html__( "p", "zozo-header-footer" )
				]
			]
		);
		$this->add_control(
			'signin_text',
			[
				'label'   => esc_html__( 'Sign-in Text', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Sign in', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'signout_text',
			[
				'label'   => esc_html__( 'Sign-out Text', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Sign out', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			"rf_enabled",
			[
				"label" 		=> esc_html__( "Registration Form", "zozo-header-footer" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "yes"
			]
		);
		$this->add_control(
			"fp_enabled",
			[
				"label" 		=> esc_html__( "Forget Password Form", "zozo-header-footer" ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "yes"
			]
		);
		$this->add_control(
			'register_link_text',
			[
				'label'   => esc_html__( 'Register Link Text', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Register', 'zozo-header-footer' ),
				'condition' => [
					'rf_enabled' => 'yes'
				],
			]
		);
		$this->add_control(
			'fp_link_text',
			[
				'label'   => esc_html__( 'Forget Password Link Text', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Lost your password?', 'zozo-header-footer' ),
				'condition' => [
					'fp_enabled' => 'yes'
				],
			]
		);
		$this->end_controls_section();
		
		//Login Form Section
		$this->start_controls_section(
			'login_form_section',
			[
				'label'	=> esc_html__( 'Login Form', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'lf_title',
			[
				'label'   => esc_html__( 'Login Form Title', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Login', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'uname_label',
			[
				'label'   => esc_html__( 'Username Label', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Username', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'pswd_label',
			[
				'label'   => esc_html__( 'Password Label', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Password', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'lf_btn_label',
			[
				'label'   => esc_html__( 'Login Button Text', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Login', 'zozo-header-footer' ),
			]
		);
		$this->end_controls_section();
		
		//Registration Section
		$this->start_controls_section(
			'registration_form_section',
			[
				'label'	=> esc_html__( 'Registration Form', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
				'condition' => [
					'rf_enabled' => 'yes'
				],
			]
		);
		$this->add_control(
			'rf_title',
			[
				'label'   => esc_html__( 'Registration Form Title', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Registration', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'yn_label',
			[
				'label'   => esc_html__( 'Your Name Label', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Name', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'ye_label',
			[
				'label'   => esc_html__( 'Your Email Label', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Your Email*', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'nn_label',
			[
				'label'   => esc_html__( 'Nick Name Label', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Nick Name', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'r_un_label',
			[
				'label'   => esc_html__( 'Choose Username Label', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Choose Username*', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'r_pswd_label',
			[
				'label'   => esc_html__( 'Choose Password Label', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Choose Password*', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'rf_btn_label',
			[
				'label'   => esc_html__( 'Register Button Text', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Register', 'zozo-header-footer' ),
			]
		);
		$this->end_controls_section();
		
		//Forget Password Section
		$this->start_controls_section(
			'fp_form_section',
			[
				'label'	=> esc_html__( 'Forget Password Form', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
				'condition' => [
					'fp_enabled' => 'yes'
				],
			]
		);
		$this->add_control(
			'fp_title',
			[
				'label'   => esc_html__( 'Forget Password Form Title', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Forget Password', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'fp_uname_label',
			[
				'label'   => esc_html__( 'Username or E-mail Label', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Username or E-mail', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'fp_btn_label',
			[
				'label'   => esc_html__( 'Forget Password Button Text', 'zozo-header-footer' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Submit', 'zozo-header-footer' ),
			]
		);		
		$this->end_controls_section();
		
		// General Style
		$this->start_controls_section(
			'section_style_general',
			[
				'label'     => esc_html__( 'General', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'padding_pt',
			[
				'label'              => esc_html__( 'Padding', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors'          => [
					'body .zhf-login-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'  //->modified
				],
				'frontend_available' => true,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'zozo-header-footer' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => 'body .zhf-login-inner',
			]
		);
		$this->end_controls_section();
		
		// Form Title Style
		$this->start_controls_section(
			'section_style_title',
			[
				'label'     => esc_html__( 'Form Title', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'ft_align',
			[
				'label'        => esc_html__( 'Alignment', 'zozo-header-footer' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'    => [
						'title' => esc_html__( 'Left', 'zozo-header-footer' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'zozo-header-footer' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'zozo-header-footer' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'      => 'left',
				'selectors' => [
					'.zhf-login-parent .zhf-form-title' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'ft_padding',
			[
				'label'              => esc_html__( 'Padding', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors'          => [
					'.zhf-login-parent .zhf-form-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'ft_margin',
			[
				'label'              => esc_html__( 'Margin', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 15,
					'unit' => 'px',
				],
				'selectors'          => [
					'.zhf-login-parent .zhf-form-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'ft_color',
			[
				'label' => esc_html__( 'Form Title Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.zhf-login-parent .zhf-form-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'ft_typography',
				'selector' 		=> '.zhf-login-parent .zhf-form-title'
			]
		);	
		$this->end_controls_section();
		
		// Style Text Section
		$this->start_controls_section(
			'textbox_section_style',
			[
				'label' => esc_html__( 'Text Box', 'zozo-header-footer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);		
		$this->start_controls_tabs( 'textbox_style_group' );
		$this->start_controls_tab(
			'text_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Primary Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'body .zhf-login-parent input.form-control' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'body .zhf-login-parent input.form-control' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'text_border',
				'selector' => 'body .zhf-login-parent input.form-control',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'text_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'body .zhf-login-parent input.form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'text_box_shadow',
				'selector' => 'body .zhf-login-parent input.form-control',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'text_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'text_hcolor',
			[
				'label' => esc_html__( 'Primary Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'body .zhf-login-parent input.form-control:hover, body .zhf-login-parent input.form-control:focus' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_bg_hcolor',
			[
				'label' => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'body .zhf-login-parent input.form-control:hover, body .zhf-login-parent input.form-control:focus' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'text_hborder',
				'selector' => 'body .zhf-login-parent input.form-control:hover, body .zhf-login-parent input.form-control:focus',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'text_border_hradius',
			[
				'label' => esc_html__( 'Border Radius', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'body .zhf-login-parent input.form-control:hover, body .zhf-login-parent input.form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'text_box_hshadow',
				'selector' => 'body .zhf-login-parent input.form-control:hover, body .zhf-login-parent input.form-control:focus',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_responsive_control(
			'text_box_padding',
			[
				'label' => esc_html__( 'Padding', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'body .zhf-login-parent input.form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'text_box__typography',
				'selector' 		=> 'body .zhf-login-parent input.form-control'
			]
		);	
		$this->end_controls_section();
		
		// Style Form Button Section
		$this->start_controls_section(
			'form_button_section_style',
			[
				'label' => esc_html__( 'Form Button', 'zozo-header-footer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'btn_align',
			[
				'label'        => esc_html__( 'Alignment', 'zozo-header-footer' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'    => [
						'title' => esc_html__( 'Left', 'zozo-header-footer' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'zozo-header-footer' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'zozo-header-footer' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'      => 'left',
				'selectors' => [
					'.zhf-login-inner .btn-wrap' => 'text-align: {{VALUE}};'
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'form_button_shadow',
				'selector' => '.zhf-login-inner input.btn ',
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_form_button_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ),
			]
		);		
		$this->add_control(
			'form_button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'.zhf-login-inner input.btn ' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'form_button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'.zhf-login-inner input.btn ' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_form_button_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'form_button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.zhf-login-inner input.btn :hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'form_button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'.zhf-login-inner input.btn :hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'form_button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'.zhf-login-inner input.btn :hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'form_button_hover_animation',
			[
				'label' => esc_html__( 'Hover Animation', 'zozo-header-footer' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_button_border',
				'selector' => '.zhf-login-inner input.btn ',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'form_button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'.zhf-login-inner input.btn ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'form_button_box_shadow',
				'selector' => '.zhf-login-inner input.btn ',
			]
		);
		$this->add_responsive_control(
			'form_button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'.zhf-login-inner input.btn ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'form_button_typography',
				'selector' 		=> '.zhf-login-inner input.btn '
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render registration widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$signin_text = isset( $settings['signin_text'] ) ? $settings['signin_text'] : ''; 
		$signout_text = isset( $settings['signout_text'] ) ? $settings['signout_text'] : ''; 
		
		if ( !is_user_logged_in() ) : 
			require_once( ZOZO_HF_CORE_DIR . 'inc/class.zozo-member.php' );
			$zhf_member = new ZOZO_Header_Footer_Member;
			ZOZO_Header_Footer_Member::zhf_set_settings( $settings );
		?>		
			<a href="#" class="login-form-trigger btn btn-default"><?php echo esc_html( $signin_text ); ?></a>
		<?php
			
			add_action( 'wp_footer', array( $zhf_member, 'zhf_all_form' ), 99 );
		else: 
			$current_user = wp_get_current_user();
		?>
			<a href="#"><i class="ti-user"></i> <span class="log-form-author-name-wrap"><?php echo esc_html( $current_user->display_name ); ?></span></a> | <a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php echo esc_html( $signout_text ); ?></a>
		<?php
		endif;
	}
	
}