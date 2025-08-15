<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * ZOZO Header Footer Elements Search
 * @since 1.0.0
 */
 
class ZOZO_HF_Search_Widget extends Widget_Base {
	
	
	/**
	 * Get widget name.
	 *
	 * Retrieve search widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "zozo_hf_search";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve search widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Search", "zozo-header-footer" );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve search widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "zhf-icon eicon-search";
	}


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the search widget belongs to.
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
	
	public function get_style_depends() {
		return [ 'themify-icons', 'zozo-header-footer' ];
	}

	/**
	 * Register search widget controls. 
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		
		//General Section
		$this->start_controls_section(
			'search_section',
			[
				'label'	=> esc_html__( 'Search', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'search_layout',
			[
				'label' => esc_html__( 'Search Layout', 'zozo-header-footer' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'		=> esc_html__( 'Default By Theme', 'zozo-header-footer' ),
					'icon'			=> esc_html__( 'Overlay Search Form', 'zozo-header-footer' ),
					'inline-toggle'	=> esc_html__( 'Inline Toggle Search', 'zozo-header-footer' ),
					'full-toggle'	=> esc_html__( 'Toggle Full Search Box', 'zozo-header-footer' ),
					'bottom'		=> esc_html__( 'Icon to Search Box Bottom', 'zozo-header-footer' )
				]
			]
		);
		$this->add_control(
			'search_align',
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
					'{{WRAPPER}} .zhf-search-toggle-wrap' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'search_placeholder',
			[
				'label' 		=> esc_html__( 'Placeholder Text', 'zozo-header-footer' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> esc_html__( 'Search...', 'zozo-header-footer' ),
				'condition' 	=> [
					'search_layout' 		=> [ 'inline-toggle', 'full-toggle' ]
				],
			]
		);
		$this->add_responsive_control(
			'search_height',
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
					'{{WRAPPER}} .zhf-search-toggle-wrap' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				'frontend_available' => true,
			]
		);
		$this->end_controls_section();
		
		// Style Icon Section
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'zozo-header-footer' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'search_layout!'	=> 'default'
				],
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ),
			]
		);

		$this->add_control(
			'icon_primary_color',
			[
				'label' => esc_html__( 'Primary Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-icon > i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'icon_secondary_color',
			[
				'label' => esc_html__( 'Secondary Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-icon' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__( 'Border Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-icon' => 'border-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);

		$this->add_control(
			'icon_primary_hcolor',
			[
				'label' => esc_html__( 'Primary Hover Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-icon:hover > i' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'icon_secondary_hcolor',
			[
				'label' => esc_html__( 'Secondary Hover Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-icon:hover' => 'background-color: {{VALUE}};'
				],
			]
		);	
		$this->add_control(
			'hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-icon:hover' => 'border-color: {{VALUE}};'
				],
			]
		);		

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'zozo-header-footer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .zhf-icon > i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' => esc_html__( 'Padding', 'zozo-header-footer' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .zhf-icon' => 'padding: {{SIZE}}{{UNIT}};'
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
				'label' => esc_html__( 'Rotate', 'zozo-header-footer' ),
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
					'{{WRAPPER}} .zhf-icon > i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__( 'Spacing', 'zozo-header-footer' ),
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
					'{{WRAPPER}} .zhf-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'icon_border_width',
			[
				'label' => esc_html__( 'Border Width', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .zhf-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .zhf-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);	
		$this->end_controls_section();
		
		// Style Button Section
		$this->start_controls_section(
			'button_section_style',
			[
				'label' => esc_html__( 'Button', 'zozo-header-footer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .search-submit',
			]
		);
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .search-submit' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .search-submit' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'zozo-header-footer' ),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__( 'Border Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .search-submit:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_hover_animation',
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
				'name' => 'border',
				'selector' => '{{WRAPPER}} .search-submit',
				'separator' => 'before',
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .search-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .search-submit',
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .search-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typography',
				'selector' 		=> '{{WRAPPER}} .search-submit'
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
		$this->add_control(
			'text_placehodler_color',
			[
				'label' => esc_html__( 'Placeholder Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-field::placeholder' => 'color: {{VALUE}};'
				]
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
					'{{WRAPPER}} .search-field' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-field' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'text_border',
				'selector' => '{{WRAPPER}} .search-field',
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
					'{{WRAPPER}} .search-field' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'text_box_shadow',
				'selector' => '{{WRAPPER}} .search-field',
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
					'{{WRAPPER}} .search-field:hover, {{WRAPPER}} .search-field:focus' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'text_bg_hcolor',
			[
				'label' => esc_html__( 'Background Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-field:hover, {{WRAPPER}} .search-field:focus' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'text_hborder',
				'selector' => '{{WRAPPER}} .search-field:hover, {{WRAPPER}} .search-field:focus',
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
					'{{WRAPPER}} .search-field:hover, {{WRAPPER}} .search-field:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'text_box_hshadow',
				'selector' => '{{WRAPPER}} .search-field:hover, {{WRAPPER}} .search-field:focus',
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
					'{{WRAPPER}} .search-field' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'text_box__typography',
				'selector' 		=> '{{WRAPPER}} .search-field'
			]
		);	
		$this->end_controls_section();

	}

	/**
	 * Render search widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$search_layout = $search_layout ? $search_layout : 'icon';
		$search_placeholder = $search_placeholder ? $search_placeholder : '';
		
		switch( $search_layout ){
		
			case 'icon':
				ob_start();
				get_search_form();
				$form_out = ob_get_clean();
				$output = '<a class="zhf-full-search-toggle zhf-icon" href="#"><i class="ti-search"></i></a>';
				$output .= '<div class="zhf-full-search-wrapper">
					<a class="zhf-full-search-toggle zhf-close" href="#"></a>';
				$output .= $form_out;
				$output .= '</div>';
			break;
			
			case 'inline-toggle':
				$output = '
				<div class="zhf-textbox-search-wrap">
					<form method="get" class="search-form" action="'. esc_url( home_url( '/' ) ) .'">
						<div class="zhf-input-group">
							<input name="s" type="text" class="zhf-form-control" value="'. get_search_query() .'" placeholder="'. esc_attr( $search_placeholder ) .'">
						</div>
					</form>
				</div>
				<a class="zhf-textbox-search-toggle zhf-icon" href="#"><i class="ti-search"></i></a>
				';
			break;
			
			case 'full-toggle':
				$output = '<a class="zhf-full-bar-search-toggle zhf-icon" href="#"><i class="ti-search"></i></a>';
				$output .= '<div class="zhf-full-bar-search-wrap">
					<form method="get" class="search-form" action="'. esc_url( home_url( '/' ) ) .'">
						<div class="zhf-input-group">
							<input name="s" type="text" class="zhf-form-control" value="'. get_search_query() .'" placeholder="'. esc_attr( $search_placeholder ) .'">
						</div>
					</form>
					<a href="#" class="zhf-close zhf-full-bar-search-toggle"></a>
				</div>';
			break;
			
			case 'bottom':
				ob_start();
				get_search_form();
				$form_out = ob_get_clean();
				$output = '<div class="zhf-bottom-search-wrap">';
				$output .= $form_out;
				$output .= '</div><a class="zhf-bottom-search-toggle zhf-icon" href="#"><i class="ti-search"></i></a>';
			break;
			
			default:
				ob_start();
				get_search_form();
				$output = ob_get_clean();
			break; 
			
		}
		
		echo '<div class="zhf-search-toggle-wrap">';
		echo $output;
		echo '</div>';
		
	}
	
}