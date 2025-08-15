<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * ZOZO Header Footer Elements Minicart
 * @since 1.0.0
 */
 
class ZOZO_HF_Minicart_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve minicart widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "zozo_hf_minicart";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve minicart widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Minicart", "zozo-header-footer" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve minicart widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "zhf-icon eicon-cart";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the minicart widget belongs to.
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
	 * Register minicart widget controls. 
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
			'cart_layout',
			[
				'label'			=> esc_html__( 'Cart Layout', 'zozo-header-footer' ),
				'type'			=> Controls_Manager::SELECT,
				'default'		=> 'layout-1',
				'options'		=> [
					'layout-1'		=> esc_html__( 'Default', 'zozo-header-footer' ),
					'layout-2'		=> esc_html__( 'Layout 2', 'zozo-header-footer' )
				],
				'prefix_class' => 'trigger-',
			]
		);
		$this->add_control(
			'cart_align',
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
					]
				],
				'default'      => 'left',
				'selectors' => [
					'{{WRAPPER}} .mini-cart-dropdown' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->add_responsive_control(
			'cart_height',
			[
				'label'              => esc_html__( 'Max Height', 'zozo-header-footer' ) . ' (px)',
				'type'               => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
					'size' => 80,
				],
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'min' => 10,
						'max' => 500,
						'step' => 1,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .mini-cart-dropdown a.mini-cart-item' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);
		$this->end_controls_section();
		
		// General Style
		$this->start_controls_section(
			'cart_style_section',
			[
				'label'     => esc_html__( 'General', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);
		$this->start_controls_tabs( 'cart_colors' );
		$this->start_controls_tab(
			'cart_color_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'cart_color',
			[
				'label' => esc_html__( 'Cart Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mini-cart-dropdown > a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'cart_color_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'cart_hcolor',
			[
				'label' => esc_html__( 'Cart Hover Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mini-cart-dropdown > a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'cart_count_color',
			[
				'label'     => esc_html__( 'Count Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .zhf-cart-items-count' => 'color: {{VALUE}}',
				],
				'separator' => 'before'
			]
		);
		$this->add_control(
			'cart_count_bg',
			[
				'label'     => esc_html__( 'Count Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .zhf-cart-items-count' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->end_controls_section();
		
		// Dropdown Style
		$this->start_controls_section(
			'dropdown_style_section',
			[
				'label'     => esc_html__( 'Dropdown', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'padding_dropdown',
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
					'size' => 5,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .cart-dropdown-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'dd_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .cart-dropdown-menu' => 'color: {{VALUE}}',
				],
				'separator' => 'before'
			]
		);
		$this->add_control(
			'dd_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .cart-dropdown-menu' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->start_controls_tabs( 'dd_colors' );
		$this->start_controls_tab(
			'dd_color_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'dd_color',
			[
				'label' => esc_html__( 'Link Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart-dropdown-menu a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'dd_color_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'dd_hcolor',
			[
				'label' => esc_html__( 'Link Hover Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cart-dropdown-menu a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	/**
	 * Render minicart widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();		
		$this->zhf_mini_cart();
	}
	
	public function zhf_mini_cart(){
		echo do_shortcode('[zhf_mini_cart]');
	}
	
}