<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * ZOZO Header Footer Elements Secondary Bar
 * @since 1.0.0
 */
 
class ZOZO_HF_Secondary_Bar extends Widget_Base {
	
	
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
		return "zozo_hf_secondary_bar";
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
		return esc_html__( "Secondary Bar", "zozo-header-footer" );
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
		return "zhf-icon eicon-sidebar";
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
		
		global $wp_registered_sidebars;

		$options = [];

		if ( ! $wp_registered_sidebars ) {
			$options[''] = esc_html__( 'No sidebars were found', 'zozo-header-footer' );
		} else {
			$options[''] = esc_html__( 'Choose Sidebar', 'zozo-header-footer' );

			foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
				$options[ $sidebar_id ] = $sidebar['name'];
			}
		}

		$default_key = array_keys( $options );
		$default_key = array_shift( $default_key );
		
		//Trigger Section
		$this->start_controls_section(
			'trigger_section',
			[
				'label'	=> esc_html__( 'Trigger', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
			]
		);		
		$this->add_control(
			'open_icon',
			[
				'label' => esc_html__( 'Default Icon', 'zozo-header-footer' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fa fa-bars', 
					'library' => 'fontawesome',
				],
			]
		);
		$this->add_responsive_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'zozo-header-footer' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'zozo-header-footer' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'zozo-header-footer' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'zozo-header-footer' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .zhf-secondary-trigger-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
		
		//Sidebar Section
		$this->start_controls_section(
			'sidebar_section',
			[
				'label'	=> esc_html__( 'Sidebar', 'zozo-header-footer' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'sidebar',
			[
				'label' => esc_html__( 'Choose Sidebar', 'zozo-header-footer' ),
				'type' => Controls_Manager::SELECT,
				'default' => $default_key,
				'options' => $options,
			]
		);
		$this->add_control(
			'open_from',
			[
				'label' => esc_html__( 'Open From', 'zozo-header-footer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'right' => esc_html__( 'Right', 'zozo-header-footer' ),
					'left' => esc_html__( 'Left', 'zozo-header-footer' )
				],
				'default' => 'right'
			]
		);
		$this->add_control(
			'open_type',
			[
				'label' => esc_html__( 'Open Type', 'zozo-header-footer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'overlay' => esc_html__( 'Overlay', 'zozo-header-footer' ),
					'push' => esc_html__( 'Push', 'zozo-header-footer' )
				],
				'selectors'          => [
					'{{WRAPPER}} .zhf-secondary-area-wrap, body' => 'transition: all ease 0.35s'
				],
				'default' => 'overlay'
			]
		);
		$this->add_responsive_control(
			'bar_width',
			[
				'label'				=> esc_html__( 'Width', 'zozo-header-footer' ),
				'type'				=> Controls_Manager::SLIDER,
				'size_units'		=> [ 'px', '%' ],
				'range'				=> [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'            => [
					'size' => 350,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .zhf-secondary-area-wrap' => 'width: {{SIZE}}{{UNIT}};',
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
				'global' => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .zhf-secondar-bar-toggle' => 'color: {{VALUE}};',
					'{{WRAPPER}} .zhf-secondar-bar-toggle svg' => 'fill: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'selector' => '{{WRAPPER}} .zhf-secondar-bar-toggle',
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
				'global' => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'selectors' => [
					'{{WRAPPER}}:hover .zhf-secondar-bar-toggle' => 'color: {{VALUE}};',
					'{{WRAPPER}}:hover .zhf-secondar-bar-toggle svg' => 'fill: {{VALUE}};'
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_hborder',
				'selector' => '{{WRAPPER}}:hover .zhf-secondar-bar-toggle',
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
					'{{WRAPPER}} .zhf-secondar-bar-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .zhf-secondar-bar-toggle' => 'padding: {{SIZE}}{{UNIT}};'
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
				]
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
					'{{WRAPPER}} .zhf-secondar-bar-toggle i, {{WRAPPER}} .secondar-bar-icon svg' => 'transform: rotate({{SIZE}}{{UNIT}});',
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
					'{{WRAPPER}} .zhf-secondar-bar-toggle' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);		
		$this->add_control(
			'icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .zhf-secondar-bar-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);	
		$this->end_controls_section();
		
		// Style Area Section
		$this->start_controls_section(
			'section_style_area',
			[
				'label' => esc_html__( 'Secodnary Area', 'zozo-header-footer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'zozo-header-footer' ),
				'name' 			=> 'text_typography',
				'selector' 		=> '{{WRAPPER}} .zhf-secondary-area-inner'
			]
		);	
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Heading Typography', 'zozo-header-footer' ),
				'name' 			=> 'heading_typography',
				'selector' 		=> '{{WRAPPER}} .zhf-secondary-area-inner h1, {{WRAPPER}} .zhf-secondary-area-inner h2, {{WRAPPER}} .zhf-secondary-area-inner h3, {{WRAPPER}} .zhf-secondary-area-inner h4, {{WRAPPER}} .zhf-secondary-area-inner h5, {{WRAPPER}} .zhf-secondary-area-inner h6,'
			]
		);	
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Font Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-secondary-area-inner' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'link_color',
			[
				'label' => esc_html__( 'Link Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-secondary-area-inner a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'link_hcolor',
			[
				'label' => esc_html__( 'Link Hover Color', 'zozo-header-footer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .zhf-secondary-area-inner a:hover' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'textdomain' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .zhf-secondary-area-inner',
			]
		);
		$this->add_control(
			'area_margin',
			[
				'label' => esc_html__( 'Margin', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .zhf-secondary-area-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'area_padding',
			[
				'label' => esc_html__( 'Padding', 'zozo-header-footer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .zhf-secondary-area-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
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
		
		$outer_class = '';
		$open_from = $open_from ? $open_from : 'right';
		$open_type = '';
		$open_type = $open_type ? $open_type : 'overlay';
		$outer_class .= $open_from.'-'.$open_type;
		$this->add_render_attribute( 'outer-wrapper', 'class', 'zhf-secondary-area-wrap' );
		$this->add_render_attribute( 'outer-wrapper', 'class', $outer_class );

		$this->add_render_attribute( 'outer-wrapper', 'data-type', $open_from );
		$bar_width = $bar_width ? $bar_width : '';
		if( !empty( $bar_width ) && is_array( $bar_width ) && isset( $bar_width['size'] ) ) {
			$this->add_render_attribute( 'outer-wrapper', 'data-width', $bar_width['size'] );
		}
		
		echo '<div class="zhf-secondary-trigger-wrap">';
			//Open Icon
			$this->add_render_attribute( 'open-icon-wrapper', 'class', 'zhf-secondar-bar-toggle' );
			if ( empty( $settings['open_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
				// add old default
				$settings['open_icon'] = 'fa fa-bars';
			}
			if ( ! empty( $settings['open_icon'] ) ) {
				$this->add_render_attribute( 'open-icon', 'class', $settings['open_icon'] );
				$this->add_render_attribute( 'open-icon', 'aria-hidden', 'true' );
			}		
			$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
			$is_new = empty( $settings['open_icon'] ) && Icons_Manager::is_migration_allowed();
			if( $settings['open_icon'] ){
				echo '<div '. $this->get_render_attribute_string( 'open-icon-wrapper' ) .'>';
					if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings['open_icon'], [ 'aria-hidden' => 'true' ] );
					else : ?>
						<i <?php echo $this->get_render_attribute_string( 'open-icon' ); ?>></i>
					<?php endif; 
				echo '</div>';
			}
		echo '</div><!-- .zhf-secondary-trigger-wrap -->';
		
		$sidebar = $sidebar ? $sidebar : '';
		if( is_active_sidebar( $sidebar) ) : ?>
			<div <?php echo $this->get_render_attribute_string( 'outer-wrapper' ); ?>>	
				<span class="zhf-close"></span>
				<div class="zhf-secondary-area-inner">	
					<?php dynamic_sidebar( $sidebar ); ?>
				</div><!-- .secondary-area-inner -->	
			</div><!-- .secondary-area-wrap -->	
		<?php
		endif;
	}
	
}