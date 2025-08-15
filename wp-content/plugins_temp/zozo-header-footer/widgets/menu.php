<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * ZOZO Header Footer Elements Menu
 * @since 1.0.0
 */
 
class ZOZO_HF_Menu_Widget extends Widget_Base {
	
	
	/**
	 * Get widget name.
	 *
	 * Retrieve menu widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "zozo_hf_menu";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve menu widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Menu", "zozo-header-footer" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve menu widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "zhf-icon eicon-menu-bar";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the menu widget belongs to.
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
		return [ 'zozo-header-footer' ];
	}
	
	public function get_style_depends() {
		return [ 'themify-icons', 'zozo-header-footer' ];
	}
	
	/**
	 * Retrieve the list of available menus.
	 *
	 * Used to get the list of available menus.
	 *
	 * @since 1.3.0
	 * @access private
	 *
	 * @return array get WordPress menus list.
	 */
	private function get_available_menus() {

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	/**
	 * Register menu widget controls. 
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		
		$menus = $this->get_available_menus();
		
		//General Section
		$this->start_controls_section(
			'menu_section',
			[
				'label'	=> esc_html__( 'Menu', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
			]
		);
		if( !empty( $menus ) ){
			$this->add_control(
				'menu',
				[
					'label' => esc_html__( 'Menu Layout', 'zozo-header-footer' ),
					'type' => Controls_Manager::SELECT,
					'default' => array_keys($menus)[0],
					'options' => $menus
				]
			);
		}else{
			$this->add_control(
				'menu',
				[
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'zozo-header-footer' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}
		$this->add_responsive_control(
			'menu_height',
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
					'{{WRAPPER}} .zhf-menu-wrap .zhf-nav-menu > li' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);
		$this->end_controls_section();
		
		//Layout Section
		$this->start_controls_section(
			'layout_section',
			[
				'label'	=> esc_html__( 'Layout', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Layout', 'zozo-header-footer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => esc_html__( 'Horizontal', 'zozo-header-footer' ),
					'vertical'   => esc_html__( 'Vertical', 'zozo-header-footer' ),
					'expandable' => esc_html__( 'Expanded', 'zozo-header-footer' ),
					'fly' => esc_html__( 'Flyout', 'zozo-header-footer' )
				]				
			]
		);
		$this->add_control(
			'layout_class',
			[
				'label' => esc_html__( 'Layout Class', 'textdomain' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'vertical-enabled',
				'prefix_class' => 'zhf-',
				'condition'    => [
					'layout!' => [ 'horizontal' ],
				],
			]
		);
		$this->add_control(
			'fly_type',
			[
				'label'        => esc_html__( 'Flyout Type', 'zozo-header-footer' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'slide',
				'options'      => [
					'slide'   => esc_html__( 'Slide', 'zozo-header-footer' ),
					'push'    => esc_html__( 'Push', 'zozo-header-footer' )
				],
				'prefix_class' => 'zhf-fly-enabled zhf-fly-layout-',
				'condition'    => [
					'layout' => [ 'fly' ],
				],
			]
		);
		$this->add_control(
			'fly_position',
			[
				'label'        => esc_html__( 'Flyout Position', 'zozo-header-footer' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'left',
				'options'      => [
					'left'   => esc_html__( 'Left', 'zozo-header-footer' ),
					'right'    => esc_html__( 'Right', 'zozo-header-footer' )
				],
				'condition'    => [
					'layout' => [ 'fly' ],
				],
				'prefix_class' => 'zhf-fly-',
			]
		);
		$this->add_control(
			'navmenu_align',
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
					'justify' => [
						'title' => esc_html__( 'Justify', 'zozo-header-footer' ),
						'icon'  => 'eicon-h-align-stretch',
					],
				],
				'default'      => 'left',
				'condition'    => [
					'layout' => [ 'horizontal', 'vertical' ],
				],
				'prefix_class' => 'zhf-nav-menu-align-',
			]
		);
		$this->add_control(
			'submenu_icon',
			[
				'label'        => esc_html__( 'Submenu Icon', 'zozo-header-footer' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'arrow',
				'options'      => [
					'arrow'   => esc_html__( 'Arrows', 'zozo-header-footer' ),
					'plus'    => esc_html__( 'Plus Sign', 'zozo-header-footer' )
				],
				'prefix_class' => 'zhf-submenu-icon-',
			]
		);
		$this->add_control(
			'responsive_options',
			[
				'label' => esc_html__( 'Responsive Options', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'    => [
					'layout' => [ 'horizontal', 'vertical', 'fly' ],
				],
			]
		);
		$this->add_responsive_control(
			'responsive_from',
			[
				'label' => esc_html__( 'Mobile Menu From', 'zozo-header-footer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 300,
						'max' => 1500,
						'step' => 1
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 992,
				],
				'condition'    => [
					'layout' => [ 'horizontal', 'vertical' ],
				],
			]
		);
		$this->add_control(
			'trigger_align',
			[
				'label'        => esc_html__( 'Trigger Alignment', 'zozo-header-footer' ),
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
				'selectors'          => [
					'{{WRAPPER}} .zhf-menu-toggle-wrap' => 'text-align: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section();
		
		// Menu Style
		$this->start_controls_section(
			'section_style_main_menu',
			[
				'label'     => esc_html__( 'Main Menu', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'padding_menu_item',
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
					'{{WRAPPER}} .zhf-nav-menu li.menu-item > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'margin_menu_item',
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
					'{{WRAPPER}} .zhf-nav-menu li.menu-item > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'          => [
					'layout!' => 'horizontal',
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'menu_space_between',
			[
				'label'              => esc_html__( 'Space Between', 'zozo-header-footer' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'          => [
					'body:not(.rtl) {{WRAPPER}} .zhf-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .zhf-nav-menu > li.menu-item:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}'
				],
				'condition'          => [
					'layout' => 'horizontal',
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'menu_row_space',
			[
				'label'              => esc_html__( 'Row Spacing', 'zozo-header-footer' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .zhf-nav-menu > li.menu-item' => 'margin-bottom: {{SIZE}}{{UNIT}}'
				],
				'condition'          => [
					'layout' => 'horizontal',
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'menu_typography_options',
			[
				'label' => esc_html__( 'Menu Typography', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography',
				'selector' => '{{WRAPPER}} .zhf-nav-menu li.menu-item a',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);
		$this->add_control(
			'menu_skin_options',
			[
				'label' => esc_html__( 'Menu Skin', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->start_controls_tabs( 'tabs_menu_item_style' );

		$this->start_controls_tab(
			'tab_menu_item_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ),
			]
		);

		$this->add_control(
			'color_menu_item',
			[
				'label'     => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu li.menu-item a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'bg_color_menu_item',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu li.menu-item a' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'color_menu_item_hover',
			[
				'label'     => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu li.menu-item:hover a' => 'color: {{VALUE}}', //->modified
				],
			]
		);
		$this->add_control(
			'bg_color_menu_item_hover',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu li.menu-item:hover a' => 'background-color: {{VALUE}}', //->modified
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_active',
			[
				'label' => esc_html__( 'Active', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'color_menu_item_active',
			[
				'label'     => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu li.menu-item a:focus, {{WRAPPER}} .zhf-nav-menu li.menu-item a:active, {{WRAPPER}} .zhf-nav-menu li.menu-item.current-menu-item > a, {{WRAPPER}} .zhf-nav-menu li.menu-item.current-menu-ancestor > a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'bg_color_menu_item_active',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu li.menu-item a:focus, {{WRAPPER}} .zhf-nav-menu li.menu-item a:active' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();
		
		// Dropdown Style
		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label'     => esc_html__( 'Dropdown', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'dropdown_outer_options',
			[
				'label' => esc_html__( 'Dropdown Styles', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'dropdown_border',
				'selector' => '{{WRAPPER}} .zhf-nav-menu .sub-menu',
			]
		);
		$this->add_responsive_control(
			'dropdown_border_radius',
			[
				'label'              => esc_html__( 'Border Radius', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .sub-menu'        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .sub-menu li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden;',
					'{{WRAPPER}} .sub-menu li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden'
				],
				'frontend_available' => true,
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'dropdown_box_shadow',
				'exclude'   => [
					'box_shadow_position',
				],
				'selector'  => '{{WRAPPER}} .zhf-nav-menu .sub-menu'
			]
		);
		$this->add_control(
			'dropdown_item_options',
			[
				'label' => esc_html__( 'Dropdown Item Styles', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
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
					'size' => 15,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .zhf-nav-menu .sub-menu li.menu-item > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'margin_dropdown',
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
					'{{WRAPPER}} .zhf-nav-menu .sub-menu li.menu-item > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'dropdown_typography_options',
			[
				'label' => esc_html__( 'Menu Typography', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'dropdown_typography',
				'selector' => '{{WRAPPER}} .zhf-nav-menu .sub-menu li.menu-item a',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);
		$this->add_control(
			'dropdown_skin_options',
			[
				'label' => esc_html__( 'Menu Skin', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->start_controls_tabs( 'tabs_dropdown_style' );

		$this->start_controls_tab(
			'tab_dropdown_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ),
			]
		);

		$this->add_control(
			'color_dropdown',
			[
				'label'     => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu .sub-menu li.menu-item a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'bg_color_dropdown',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu .sub-menu' => 'background-color: {{VALUE}}',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'color_dropdown_hover',
			[
				'label'     => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu .sub-menu li.menu-item a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'bg_color_dropdown_hover',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu .sub-menu li.menu-item a:hover' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_active',
			[
				'label' => esc_html__( 'Active', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'color_dropdown_active',
			[
				'label'     => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu .sub-menu li.menu-item a:focus, {{WRAPPER}} .zhf-nav-menu li.menu-item a:active' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'bg_color_dropdown_active',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu .sub-menu li.menu-item a:focus, {{WRAPPER}} .zhf-nav-menu li.menu-item a:active' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		
		// Toggle Style
		$this->start_controls_section(
			'section_style_toggle',
			[
				'label'     => esc_html__( 'Toggle Icon', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);
		
		$this->add_responsive_control(
			'padding_toggle_icon',
			[
				'label'              => esc_html__( 'Padding', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .dropdown-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' //->modified
				],
				'frontend_available' => true,
			]
		);
		
		$this->add_responsive_control(
			'margin_toggle_icon',
			[
				'label'              => esc_html__( 'Margin', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .dropdown-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'  //->modified
				],
				'frontend_available' => true,
			]
		);
		
		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'toggle_style_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label'     => esc_html__( 'Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dropdown-icon' => 'color: {{VALUE}}' //->modified
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dropdown-icon' => 'background-color: {{VALUE}};', //->modified
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);

		$this->add_control(
			'toggle_hover_color',
			[
				'label'     => esc_html__( 'Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu li.menu-item a:hover .dropdown-icon' => 'color: {{VALUE}}' //->modified

				],
			]
		);

		$this->add_control(
			'toggle_hover_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu li.menu-item a:hover .dropdown-icon' => 'background-color: {{VALUE}};', //->modified
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_size',
			[
				'label'              => esc_html__( 'Icon Size', 'zozo-header-footer' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .dropdown-icon'     => 'font-size: {{SIZE}}{{UNIT}}' //->modified
				],
				'frontend_available' => true,
				'separator'          => 'before',
			]
		);

		$this->add_responsive_control(
			'toggle_border_width',
			[
				'label'              => esc_html__( 'Border Width', 'zozo-header-footer' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .dropdown-icon' => 'border-width: {{SIZE}}{{UNIT}};', //->modified
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			[
				'label'              => esc_html__( 'Border Radius', 'zozo-header-footer' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .dropdown-icon' => 'border-radius: {{SIZE}}{{UNIT}}', //->modified
				],
				'frontend_available' => true,
			]
		);		
		$this->end_controls_section();
		
		// Flyout Style
		$this->start_controls_section(
			'section_style_flyout',
			[
				'label'     => esc_html__( 'Flyout', 'zozo-header-footer' ),
				'tab'       => Controls_Manager::TAB_STYLE
			]
		);		
		$this->add_responsive_control(
			'padding_flyout',
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
					'{{WRAPPER}}.zhf-fly-enabled .zhf-menu-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);
		$this->add_responsive_control(
			'margin_flyout',
			[
				'label'              => esc_html__( 'Margin', 'zozo-header-footer' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'          => [
					'{{WRAPPER}}.zhf-fly-enabled .zhf-menu-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);	
		$this->add_control(
			'flyout_bg',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}.zhf-fly-enabled .zhf-menu-wrap' => 'background-color: {{VALUE}}',
				]
			]
		);
		$this->add_responsive_control(
			'menu_top_space',
			[
				'label'              => esc_html__( 'Menu Top Space', 'zozo-header-footer' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => [ 'px' ],
				'range'              => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors'          => [
					'{{WRAPPER}}.zhf-fly-enabled .zhf-menu-wrap .zhf-nav-menu' => 'margin-top: {{SIZE}}{{UNIT}}'
				],
				'frontend_available' => true,
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'flyout_box_shadow',
				'exclude'   => [
					'box_shadow_position',
				],
				'selector'  => '{{WRAPPER}}.zhf-fly-enabled .zhf-menu-wrap'
			]
		);
		$this->add_control(
			'flyout_icon_options',
			[
				'label' => esc_html__( 'Flyout Icon', 'zozo-header-footer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		
		$this->start_controls_tabs( 'flyout_icon_style' );
		$this->start_controls_tab(
			'flyout_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ), 
			]
		);

		$this->add_control(
			'flyout_icon_color',
			[
				'label'     => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .dropdown-icon' => 'color: {{VALUE}}', //->modified
				],
			]
		);
		$this->add_control(
			'flyout_icon_bg',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .dropdown-icon' => 'background-color: {{VALUE}}', //->modified
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'flyout_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'flyout_icon_hcolor',
			[
				'label'     => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu li.menu-item a:hover .dropdown-icon' => 'color: {{VALUE}}', //->modified
				],
			]
		);
		$this->add_control(
			'flyout_icon_hbg',
			[
				'label'     => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-nav-menu li.menu-item a:hover .dropdown-icon' => 'background-color: {{VALUE}}', //->modified
				]
			]
		);
		$this->end_controls_tab();		
		$this->end_controls_section();

	}
	
	/**
	 * Render menu widget output on the frontend.
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
		
		$res_from = isset( $settings['responsive_from'] ) ? $settings['responsive_from']['size'] : 0;
		$layout = isset( $settings['layout'] ) ? $settings['layout'] : 'horizontal';
		if( $layout == 'expandable' || $layout == 'fly' ) $res_from = 5000;
		
		$this->add_render_attribute( 'zfh-menu-container', 'class', 'elementor-widget-container' );
		$this->add_render_attribute( 'zfh-menu-container', 'data-responsive', absint( $res_from ) );
		?>
		<div <?php echo ''. $this->get_render_attribute_string( 'zfh-menu-container' ); ?>>
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
	 * Render menu widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$layout = isset( $layout ) ? $layout : '';
		$menu = !empty( $menu ) ? $menu : '';
		$menu_wrap_class = '';
		$menu_wrap_class .= $layout ? ' zhf-menu-'.$layout : '';
		
		if( $layout == 'fly' ){
			$fly_type = isset( $fly_type ) ? $fly_type : 'slide';
			$fly_position = isset( $fly_position ) ? $fly_position : 'left';
			$menu_wrap_class .= ' zhf-'. esc_attr( $fly_type ) .'-'. esc_attr( $fly_position );
		}
		
		
		//if( $layout == 'expandable' || $layout == 'fly' ) $menu_wrap_class .= ' zhf-menu-vertical';
		
		add_filter( 'nav_menu_item_title', array( $this, 'zfh_add_sub_menu_icon' ), 10, 4 );
		?>
		<div class="zhf-menu-toggle-wrap">
			<span class="zhf-menu-toggle"></span>
		</div>
		<?php
		if( $menu ){
			echo '<div class="zhf-menu-wrap'. esc_attr( $menu_wrap_class ) .'"><span class="zhf-menu-toggle opened"></span>';
			wp_nav_menu(
				array(
					'container'  => '',
					'menu_class'  => 'zhf-nav-menu',
					'menu' => $menu
				)
			);
			echo '</div><!-- .zhf-menu-wrap -->';
		}else{		
			echo "Select menu";
		}
		
		remove_filter( 'nav_menu_item_title', array( $this, 'zfh_add_sub_menu_icon' ), 10, 4 );
		
	}
	
	public static function zfh_add_sub_menu_icon( $title, $menu_item, $args, $depth ){
		if( in_array( "menu-item-has-children", $menu_item->classes ) ) {
			return $title .'<span class="dropdown-icon"></span>';
		}
		return $title;
	}
	
}