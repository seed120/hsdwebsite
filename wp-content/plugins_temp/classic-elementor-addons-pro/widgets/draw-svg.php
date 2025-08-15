<?php
namespace Elementor;

if ( ! defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Cea Draw Svg
 *
 * @since 1.0.0
 */
class CEA_Elementor_Draw_Svg_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Cea Draw Svg widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name(): string {
        return "ceadrawsvg";
    }

	/**
	 * Get widget title.
	 *
	 * Retrieve Cea Draw Svg widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title(): string {
        return esc_html__( "Draw SVG", 'classic-elementor-addons-pro' );
    }

    /**
	 * Get widget icon.
	 *
	 * Retrieve Cea Draw Svg widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon(): string {
        return "cea-default-icon eicon-image-rollover";
    }

    /**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Cea Draw Svg widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories(): array {
        return [ "classic-elements" ];
    }

    /**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Cea Draw SVG widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
	public function get_keywords(): array {
        return [ 'zozo', 'cea', 'draw', 'svg', 'classic' ];
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
     * Retrieve the list of styles the counter widget depends on.
     *
     * Used to set styles dependencies required to run the widget.
     * 
     * @since 1.3.0
     * @access public
     * 
     * @return array Widget styles dependencies
     */
    public function get_style_depends(): array {
        return [ 'cea-editor' ];
    }

	/**
	 * Register Cea Draw Svg widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		
		// Content Tab Starts
		$this->start_controls_section(
			'svg_draw_settings',
			[
				'label' => __( 'Settings', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_CONTENT
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label'       => __( 'SVG Type', 'classic-elementor-addons-pro' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'icon'   => __( 'Font Awesome', 'classic-elementor-addons-pro' ),
					'custom_code' => __( 'Custom SVG Code', 'classic-elementor-addons-pro' )
				],
				'default'     => 'icon',
				'label_block' => true
			]
		);
		$this->add_control(
			'font_icon',
			[
				'show_label'       => false,
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'label_block'      => true,
				'default'          => [
					'value'   => 'fas fa-snowflake',
					'library' => 'fa-solid'
				],
				'condition'        => [
					'icon_type' => 'icon'
				]
			]
		);
		$this->add_control(
			'custom_svg',
			[
				'label'       => __( 'SVG Code', 'classic-elementor-addons-pro' ),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => 'You can use these sites to Convert SVG image to code: <a href="https://nikitahl.github.io/svg-2-code/" target="_blank">SVG 2 CODE</a> ',
				'condition'   => [
					'icon_type' => 'custom_code'
				]
			]
		);
		$this->add_control(
			'custom_svg_note',
			[
				'raw'             => __( 'Your SVG code must include a valid shape element such as path, circle, or rect to enable animation.', 'classic-elementor-addons-pro' ),
				'type'            => Controls_Manager::RAW_HTML,
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition'       => [
					'icon_type' => 'custom_code'
				]
			]
		);
		$this->add_responsive_control(
			'icon_width',
			[
				'label'      => __( 'Width', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', '%', 'custom'],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 600
					],
					'em' => [
						'min' => 1,
						'max' => 30
					]
				],
				'default'    => [
					'size' => 150,
					'unit' => 'px'
				],
				'condition'  => [
					'icon_type' => 'custom_code'
				],
				'selectors'  => [
					'{{WRAPPER}} .cea-svg-draw-container svg' => 'width: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'icon_height',
			[
				'label'      => __( 'Height', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em', 'custom'],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 600
					],
					'em' => [
						'min' => 1,
						'max' => 30
					]
				],
				'default'    => [
					'size' => 150,
					'unit' => 'px'
				],
				'condition'  => [
					'icon_type' => 'custom_code'
				],
				'selectors'  => [
					'{{WRAPPER}} .cea-svg-draw-container svg' => 'height: {{SIZE}}{{UNIT}}'
				]
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => __( 'Size', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['px', 'em'],
				'range'      => [
					'px' => [
						'min' => 1,
						'max' => 500
					],
					'em' => [
						'min' => 1,
						'max' => 30
					]
				],
				'default'    => [
					'size' => 200,
					'unit' => 'px'
				],
				'condition'  => [
					'icon_type' => 'icon'
				],
				'selectors'  => [
					'{{WRAPPER}} .cea-svg-draw-container svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}'
				]
			]
		);
		$this->add_responsive_control(
			'icon_align',
			[
				'label'     => __( 'Alignment', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center' => [
						'title' => __( 'Center', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'  => [
						'title' => __( 'Right', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .cea-svg-draw-container' => 'text-align: {{VALUE}};'
				],
				'toggle'    => false
			]
		);
		$this->add_control(
			'animate_icon',
			[
				'label'        => __( 'Enable SVG Draw?', 'classic-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'render_type'  => 'template',
				'separator'    => 'before',
				'default'      => 'yes'
			]
		);
		$this->add_control(
			'scroll_action',
			[
				'label'              => __( 'Draw Behaviour?', 'classic-elementor-addons-pro' ),
				'type'               => Controls_Manager::SELECT,
				'options'            => [
					'load' => __( 'Draw On Load', 'classic-elementor-addons-pro' ),
					'scroll'  => __( 'Draw On Scroll', 'classic-elementor-addons-pro' ),
					'hover'     => __( 'Draw On Hover', 'classic-elementor-addons-pro' ),
				],
				'default'            => 'load',
				'label_block'        => true,
				'condition'          => [
					'animate_icon' => 'yes'
				],
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label'              => __( 'Pause On Hover?', 'classic-elementor-addons-pro' ),
				'type'         => Controls_Manager::SWITCHER,
				'render_type'  => 'template',
				'separator'    => 'before',
				'default'      => 'yes',
				'condition'          => [
					'animate_icon' => 'yes',
					'scroll_action' => 'load'
				],
			]
		);
		$this->add_control(
			'frames',
			[
				'label'              => __( 'Draw Speed', 'classic-elementor-addons-pro' ),
				'type'               => Controls_Manager::NUMBER,
				'description'        => __( 'Larger value means longer draw duration.', 'classic-elementor-addons-pro' ),
				'default'            => 5,
				'min'                => 1,
				'max'                => 100,
				'condition'          => [
					'animate_icon'   => 'yes',
					'scroll_action!' => 'scroll'
				],
				'frontend_available' => true
			]
		);
		$this->add_control(
			'repeat_delay',
			[
				'label' => __('Repeat Delay', 'classic-elementor-addons-pro'),
				'type' => Controls_Manager::NUMBER,
				'description' => __('Delay before repeating the animation', 'classic-elementor-addons-pro'),
				'default' => 5,
				'min' => 0.5,
				'max' => 50,
				'step' => 0.5,
				'condition' => [
					'loop' => 'true',
					'animate_icon'   => 'yes',
					'scroll_action!' => 'scroll'
				],
				'frontend_available' => true
			]
		);
		$this->add_control(
			'link',
			[
				'label'       => __( 'Link', 'classic-elementor-addons-pro' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => ['active' => true],
				'placeholder' => 'https://zozothemes.com',
				'label_block' => true,
				'separator'   => 'before'
			]
		);
		$this->end_controls_section();
		// Content Tab Ends
        
		// Style Tab Starts
		$this->start_controls_section(
			'section_svg_draw_style',
			[
				'label' => __( 'SVG Style', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_responsive_control(
			'svg_icon_margin',
			[
				'label'      => __( 'Margin', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .cea-svg-draw-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'svg_icon_padding',
			[
				'label'      => __( 'Padding', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .cea-svg-draw-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'separator'		=>  'after',
			]
		);
		$this->start_controls_tabs(
			'svg_color_tabs'
		);
		$this->start_controls_tab(
			'svg_color_nrml',
			[
				'label'		=> __( 'Normal', 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Stroke Color', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#6EC1E4',
				'selectors' => [
					'{{WRAPPER}} .cea-svg-draw-container svg'   => 'color: {{VALUE}};overflow: visible;',
					'{{WRAPPER}} .cea-svg-draw-container svg *' => 'stroke: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'fill_color',
			[
				'label'     => __( 'Fill Color', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .cea-svg-draw-container svg path, {{WRAPPER}} .cea-svg-draw-container svg circle, {{WRAPPER}} .cea-svg-draw-container svg square, {{WRAPPER}} .cea-svg-draw-container svg ellipse, {{WRAPPER}} .cea-svg-draw-container svg rect, {{WRAPPER}} .cea-svg-draw-container svg polyline, {{WRAPPER}} .cea-svg-draw-container svg line' => 'fill: {{VALUE}}'
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'svg_color_hvr',
			[
				'label'		=> __( 'Hover', 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label'     => __( 'Stroke Color', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .cea-svg-draw-container svg:hover'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .cea-svg-draw-container svg:hover *' => 'stroke: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'fill_color_hover',
			[
				'label'     => __( 'Fill Color', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFF',
				'selectors' => [
					'{{WRAPPER}} .cea-svg-draw-container svg:hover path, {{WRAPPER}} .cea-svg-draw-container svg:hover circle, {{WRAPPER}} .cea-svg-draw-container svg:hover square, {{WRAPPER}} .cea-svg-draw-container svg:hover ellipse, {{WRAPPER}} .cea-svg-draw-container svg:hover rect, {{WRAPPER}} .cea-svg-draw-container svg:hover polyline, {{WRAPPER}} .cea-svg-draw-container svg:hover line' => 'fill: {{VALUE}}'
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_responsive_control(
			'path_width',
			[
				'label'     => __( 'Stroke Thickness', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 20,
						'step' => 0.1
					]
				],
				'default'   => [
					'size' => 3,
					'unit' => 'px'
				],
				'selectors' => [
					'{{WRAPPER}} .cea-svg-draw-container svg path, {{WRAPPER}} .cea-svg-draw-container svg circle, {{WRAPPER}} .cea-svg-draw-container svg square, {{WRAPPER}} .cea-svg-draw-container svg ellipse, {{WRAPPER}} .cea-svg-draw-container svg rect, {{WRAPPER}} .cea-svg-draw-container svg polyline, {{WRAPPER}} .cea-svg-draw-container svg line' => 'stroke-width: {{SIZE}}'
				],
				'separator'	=> 'before'
			]
		);
		$this->add_control(
			'path_dashes',
			[
				'label'     => __( 'Space Between Dashes', 'classic-elementor-addons-pro' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1
					]
				],
				'condition' => [
					'animate_icon!' => 'yes'
				],
				'selectors' => [
					'{{WRAPPER}} .cea-svg-draw-container svg path, {{WRAPPER}} .cea-svg-draw-container svg circle, {{WRAPPER}} .cea-svg-draw-container svg square, {{WRAPPER}} .cea-svg-draw-container svg ellipse, {{WRAPPER}} .cea-svg-draw-container svg rect, {{WRAPPER}} .cea-svg-draw-container svg polyline, {{WRAPPER}} .cea-svg-draw-container svg line' => 'stroke-dasharray: {{SIZE}}'
				],
				'separator'	=> 'after'
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'icon_background',
				'types'    => ['classic', 'gradient'],
				'selector' => '{{WRAPPER}} .cea-svg-draw-container',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'svg_icon_box',
				'selector' => '{{WRAPPER}} .cea-svg-draw-container',
				'separator'	=> 'before'
			]
		);
		$this->add_responsive_control(
			'svg_icon_radius',
			[
				'label'      => __( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .cea-svg-draw-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);		
		$this->end_controls_section();
		// Style Tab Ends

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		$type = $settings['icon_type'];
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}
		$wrapper_class = "cea-svg-draw-container";
		$enable_animate = isset( $settings['animate_icon'] ) && !empty( $settings['animate_icon'] ) ? $settings['animate_icon'] : 'no';
		$scroll_action = isset( $settings['scroll_action'] ) && !empty( $settings['scroll_action'] ) ? $settings['scroll_action'] : 'load';
		$duration = isset( $settings['frames'] ) && !empty( $settings['frames'] ) ? $settings['frames'] : 5;
		$pause_on_hover = isset( $settings['pause_on_hover'] ) ? $settings['pause_on_hover'] : 'no';

		if ( 'yes' === $enable_animate ) {
			$wrapper_class .= " cea-svg-animated";
		}
		if ( 'yes' === $enable_animate && ! empty( $scroll_action ) ) {
			$wrapper_class .= " cea-draw-svg-on-" . $scroll_action;
		}
	?>
		<div class="<?php echo esc_attr( $wrapper_class ); ?>" data-svg="<?php echo esc_attr( $duration ); ?>" data-hover-pause="<?php echo esc_attr( $pause_on_hover ); ?>">
			<?php if ( ! empty( $settings['link']['url'] ) ) { ?>
				<a <?php echo wp_kses_post( $this->get_render_attribute_string( 'link' ) ); ?>>
			<?php } ?>
			<?php if ( 'icon' === $type ){ ?>
				<?php
					$this->add_render_attribute(
						'fa_icon',
						[
							'id'          => 'cea-svg-icon-' . $this->get_id(),
							'class'       => [
								'cea-svg-icon',
								$settings['font_icon']['value']
							],
							'aria-hidden' => 'true',
							'data-start'  => 'manual'
						]
					);
					echo $this->cea_get_svg_from_icon(
						$settings['font_icon'],
						[
							'id'         => 'cea-svg-icon-' . $this->get_id(),
							'class'      => 'cea-svg-icon',
							'data-start' => 'manual'
						]
					);
				?>
			<?php } else { ?>
				<?php $this->print_unescaped_setting( 'custom_svg' ); ?>
			<?php } ?>
			<?php if ( ! empty( $settings['link']['url'] ) ){ ?>
				</a>
			<?php } ?>
		</div>
		<?php
	}

	private function cea_get_svg_from_icon( $icon, $attributes = [] ) {
		if ( empty( $icon ) || empty( $icon['value'] ) || empty( $icon['library'] ) ) {
			return '';
		}
		if ( 'svg' === $icon['library'] ) {
			$svg_html = Icons_Manager::try_get_icon_html( $icon );
			return $svg_html;
		}

		$icon['font_family'] = 'font-awesome';
		$i_class = str_replace( ' ', '-', $icon['value'] );
		$svg_html = '<svg ';
		$icon = $this->cea_svg_icon_data( $icon );
			
		if ( ! $icon ) {
			Icons_Manager::render_icon( $icon, ['aria-hidden' => 'true'] );
			return;
		}

		$view_box = '0 0 ' . $icon['width'] . ' ' . $icon['height'];

		if ( is_array( $attributes ) ) {
			foreach ( $attributes as $key => $value ) {
				if ( 'class' === $key ) {
					$svg_html .= 'class="svg-inline--' . $i_class . ' ' . $value . '" ';
				} else {
					$svg_html .= " {$key}='{$value}' ";
				}
			}
		} else {
			$attributes = str_replace( 'class="', 'class="svg-inline--' . $i_class . ' ', $attributes );
			$svg_html .= $attributes;
		}

		$svg_html .= " aria-hidden='true' xmlns='http://www.w3.org/2000/svg' viewBox='{$view_box}'>";
		$svg_html .= '<path d="' . esc_attr( $icon['path'] ) . '"></path>';
		$svg_html .= '</svg>';

		return wp_kses( $svg_html, $this->cea_get_allowed_svg_tags() );
	}
		
	private function cea_get_allowed_svg_tags() {
		return [
			'svg'   => [
				'id'              => [],
				'class'           => [],
				'aria-hidden'     => [],
				'aria-labelledby' => [],
				'role'            => [],
				'xmlns'           => [],
				'width'           => [],
				'height'          => [],
				'viewbox'         => [],
				'data-*'          => true,
			],
			'g'     => [ 'fill' => [] ],
			'title' => [ 'title' => [] ],
			'path'  => [
				'd'    => [],
				'fill' => [],
			],
			'i'     => [
				'class' => [],
				'id'    => [],
				'style' => [],
			],
		];
	}

	private function cea_svg_icon_data( $icon ) {
		preg_match( '/fa(.*) fa-/', $icon['value'], $icon_name_matches );
	
		if( empty( $icon_name_matches ) ) {
		    echo '<div style="margin: 1rem;padding: 1rem 1.25rem;border-left: 5px solid #f5c848;color: #856404;background-color: #fff3cd; text-align: left;">Please select any Font Awesome 5 Icon. Bootstrap and Themify Icons are not supported.</div>';
			return;
		}
	
		$icon_name = str_replace( $icon_name_matches[0], '', $icon['value'] );
		$icon_key = str_replace( ' fa-', '-', $icon['value'] );
		$icon_file_name = str_replace( 'fa-', '', $icon['library'] );
		$path = ELEMENTOR_ASSETS_PATH . 'lib/font-awesome/json/' . $icon_file_name . '.json';
		$data = file_get_contents( $path );
	
		if( ! $data ) {
			return;
		}
	
		$data = json_decode( $data, true );
	
		$svg_data = $data['icons'][ $icon_name ];
		return [
			'width'  => $svg_data[0],
			'height' => $svg_data[1],
			'path'   => $svg_data[4],
		];
	}

}
