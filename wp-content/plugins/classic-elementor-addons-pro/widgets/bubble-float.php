<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Bubble Float Widget.
 *
 * @since 1.0.0
 */
class CEA_Elementor_Bubble_Float_Widget extends Widget_Base {

    /**
	 * Get widget name.
	 *
	 * Retrieve Cea Bubble Float widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceabubblefloat";
	}

    /**
	 * Get widget title.
	 *
	 * Retrieve Cea Bubble Float widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Bubble Float", 'classic-elementor-addons-pro' );
	}

    /**
	 * Get widget icon.
	 *
	 * Retrieve Cea Bubble Float widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "ti-thought";
	}

    /**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Cea Bubble Float widget belongs to.
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
     * Retrieve the list of keywords that used to search for Cea Bubble Float widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'themes', 'bubble', 'float' ];
    }

    /**
	 * Retrieve the list of scripts the Bubble Float widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return [ 'matter-script', 'cea-custom-front' ];
	}

    /**
     * Retrieve the list of styles the Bubble Float widget depends on.
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
	 * Register Cea Bubble Float widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function register_controls(): void {

        // Content Tab Starts
        $this->start_controls_section(
			'general_content',
			[
				'label'	=> esc_html__( 'General', 'classic-elementor-addons-pro' ),
				'tab'	=> Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title_main',
            [
                'label' => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'This is Title Text',
            ]
        );
        $this->add_control(
            'title_sub',
            [
                'label' => esc_html__( 'Sub Title', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Description',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'bubble_content',
            [
                'label'  =>  esc_html__( 'Bubble', 'classic-elementor-addons-pro' ),
                'tab'	=> Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'bubble_text',
            [
                'label' => __('Bubble Text', 'classic-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('John Doe', 'classic-elementor-addons-pro'),
                'label_block' => true,
                'placeholder' => esc_html__('Enter your text', 'classic-elementor-addons-pro'),
            ]
        );
        $repeater->add_control(
            'bubble_image',
            [
                'label' => __('Bubble Image', 'classic-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );
        $repeater->start_controls_tabs(
            'bubble_color_style'
        );
        $repeater->start_controls_tab(
            'bubble_color_normal',
            [
                'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
            ]
        );
        $repeater->add_control(
            'bubble_color',
            [
                'label' => __('Bubble Color', 'classic-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );
        $repeater->add_control(
            'bubble_background_color',
            [
                'label' => __('Bubble Background Color', 'classic-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
            ]
        );
        $repeater->add_control(
            'bubble_border_color',
            [
                'label' => __('Bubble Border Color', 'classic-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );
        $repeater->end_controls_tab();
        $repeater->start_controls_tab(
            'bubble_hover_style',
            [
                'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
            ]
        );
        $repeater->add_control(
            'bubble_color_hover',
            [
                'label' => __('Bubble Color', 'classic-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
            ]
        );
        $repeater->add_control(
            'bubble_background_color_hover',
            [
                'label' => __('Bubble Background Color', 'classic-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );
        $repeater->add_control(
            'bubble_border_color_hover',
            [
                'label' => __('Bubble Border Color', 'classic-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#000000',
            ]
        );
        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();
        $repeater->add_control(
            'bubble_shape',
            [
                'label' => __('Bubble Shape', 'classic-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'circle',
                'options' => [
                    'circle' => __('Circle', 'classic-elementor-addons-pro'),
                    'rectangle' => __('Rectangle', 'classic-elementor-addons-pro'),
                    'polygon' => __('Polygon', 'classic-elementor-addons-pro'),
                ],
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'bubble_size',
            [
                'label' => __('Bubble Size', 'classic-elementor-addons-pro'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 300,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 90,
                ],
            ]
        );
        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'bubble_label_typography',
                'label' => esc_html__( 'Bubble Label Typography', 'classic-elementor-addons-pro' ),
            ]
        );
        $this->add_control(
            'bubbles_text',
            [
                'label' => esc_html__( 'Bubbles', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'bubble_text' => esc_html__( 'John Doe', 'classic-elementor-addons-pro' ),
                    ],
                    [
                        'bubble_text' => esc_html__( 'Jane Doe', 'classic-elementor-addons-pro' ),
                    ],
                ],
                'title_field' => '{{{ bubble_text }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label'  =>  esc_html__( 'Title', 'classic-elementor-addons-pro' ),
                'tab'	=> Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Title Tag', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => esc_html__( 'H1', 'classic-elementor-addons-pro' ),
                    'h2' => esc_html__( 'H2', 'classic-elementor-addons-pro' ),
                    'h3' => esc_html__( 'H3', 'classic-elementor-addons-pro' ),
                    'h4' => esc_html__( 'H4', 'classic-elementor-addons-pro' ),
                    'h5' => esc_html__( 'H5', 'classic-elementor-addons-pro' ),
                    'h6' => esc_html__( 'H6', 'classic-elementor-addons-pro' ),
                    'div' => esc_html__( 'Div', 'classic-elementor-addons-pro' ),
                ],
            ]
        );
        $this->add_control(
            'title_align',
            [
                'label' => esc_html__( 'Alignment', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .bubble-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .bubble-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .bubble-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'title_position',
            [
                'label' => esc_html__( 'Position', 'classic-elementor-addons-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .bubble-title' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'  =>  esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bubble-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'classic-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .bubble-title',
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .bubble-title',
			]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'desc_style',
            [
                'label'  =>  esc_html__( 'Description', 'classic-elementor-addons-pro' ),
                'tab'	=> Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'desc_tag',
            [
                'label' => esc_html__( 'Title Tag', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'p',
                'options' => [
                    'h1' => esc_html__( 'H1', 'classic-elementor-addons-pro' ),
                    'h2' => esc_html__( 'H2', 'classic-elementor-addons-pro' ),
                    'h3' => esc_html__( 'H3', 'classic-elementor-addons-pro' ),
                    'h4' => esc_html__( 'H4', 'classic-elementor-addons-pro' ),
                    'h5' => esc_html__( 'H5', 'classic-elementor-addons-pro' ),
                    'h6' => esc_html__( 'H6', 'classic-elementor-addons-pro' ),
                    'p' => esc_html__( 'P', 'classic-elementor-addons-pro' ),
                    'span' => esc_html__( 'Span', 'classic-elementor-addons-pro' ),
                    'div' => esc_html__( 'Div', 'classic-elementor-addons-pro' ),
                ],
            ]
        );
        $this->add_control(
            'desc_align',
            [
                'label' => esc_html__( 'Alignment', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .bubble-desc' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'desc_margin',
            [
                'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .bubble-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'desc_padding',
            [
                'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .bubble-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_responsive_control(
            'desc_position',
            [
                'label' => esc_html__( 'Position', 'classic-elementor-addons-pro' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .bubble-desc' => 'top: {{TOP}}{{UNIT}}; right: {{RIGHT}}{{UNIT}}; bottom: {{BOTTOM}}{{UNIT}}; left: {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                ],
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'desc_color',
            [
                'label'  =>  esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bubble-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => esc_html__( 'Typography', 'classic-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .bubble-desc',
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'desc_shadow',
				'selector' => '{{WRAPPER}} .bubble-desc',
			]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'container_style',
            [
                'label'  =>  esc_html__( 'Bubble Container', 'classic-elementor-addons-pro' ),
                'tab'	=> Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'container_width',
            [
                'label'  =>  esc_html__( 'Width', 'classic-elementor-addons-pro' ),
                'type'   => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .cea-bubbles-widget' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cea-bubbles-widget .bubbles-container' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'container_height',
            [
                'label'  =>  esc_html__( 'Height', 'classic-elementor-addons-pro' ),
                'type'   => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range'  => [
                    'px' => [
                        'min' => 0,
                        'max' => 1400,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 500,
                ],
                'selectors' => [
                    '{{WRAPPER}} .cea-bubbles-widget' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cea-bubbles-widget .bubbles-container' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'container_background_color',
            [
                'label'  =>  esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cea-bubbles-widget' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .cea-bubbles-widget canvas' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'label' => esc_html__( 'Border', 'classic-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .cea-bubbles-widget',
            ]
        );
        $this->add_control(
            'container_border_radius',
            [
                'label'  =>  esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
                'type'   => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .cea-bubbles-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '20',
                    'right' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'classic-elementor-addons-pro' ),
                'selector' => '{{WRAPPER}} .cea-bubbles-widget',
            ]
        );
        $this->end_controls_section();
    }

    protected function render(): void {

        $settings = $this->get_settings_for_display();
        $bubbles = [];
        $typo = [];
        $title_tag = $settings['title_tag'];
        $desc_tag = $settings['desc_tag'];

        if ( ! empty( $settings['bubbles_text'] ) ) {
            foreach ( $settings['bubbles_text'] as $bubble ) {
                $bubbles[] = [
                    'text' => $bubble['bubble_text'],
                    'image' => !empty($bubble['bubble_image']['url']) ? $bubble['bubble_image']['url'] : '',
                    'color' => $bubble['bubble_color'] ?? '#000',
                    'background' => $bubble['bubble_background_color'] ?? '#fff',
                    'border' => $bubble['bubble_border_color'] ?? '#000',
                    'color_hover' => $bubble['bubble_color_hover'] ?? '#fff',
                    'background_hover' => $bubble['bubble_background_color_hover'] ?? '#000',
                    'border_hover' => $bubble['bubble_border_color_hover'] ?? '#000',
                    'size' => !empty($bubble['bubble_size']['size']) ? (int)$bubble['bubble_size']['size'] : 90,
                    'shape' => $bubble['bubble_shape'] ?? 'circle',
                    'sides' => 6,
                    'font_family' => $bubble['bubble_label_typography_font_family'] ?? 'Verdana',
                    'font_weight' => $bubble['bubble_label_typography_font_weight'] ?? '400',
                    'font_size'   => $bubble['bubble_label_typography_font_size']['size'] ?? '14',
                    'font_size_unit' => $bubble['bubble_label_typography_font_size']['unit'] ?? 'px',
                ];
            }
        }
        $bubbles_json = htmlspecialchars( json_encode( $bubbles ), ENT_QUOTES, 'UTF-8' );
        $typo_json = htmlspecialchars( json_encode( $typo ), ENT_QUOTES, 'UTF-8' );
        ?>
            <div class="cea-bubbles-widget matter-bubbles-widget" data-bubbles="<?php echo $bubbles_json?>" data-typo="<?php echo $typo_json; ?>">
                <<?php echo $title_tag; ?> class="bubble-title"><?php echo $settings['title_main']; ?></<?php echo $title_tag; ?>>
                <<?php echo $desc_tag; ?> class="bubble-desc"><?php echo $settings['title_sub']; ?></<?php echo $desc_tag; ?>>
                <canvas id="matter-bubbles-canvas"></canvas>    
            </div>
        <?php

    }

}