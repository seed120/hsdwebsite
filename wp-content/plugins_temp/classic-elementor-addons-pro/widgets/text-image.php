<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly. 
}

/**
 * Classic Elementor Addons Cea Text Image Animator
 * 
 * @since 1.0.0
 */

class CEA_Elementor_Text_Image_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve Cea Text Image Widget Name.
     * 
     * @since 1.0.0
     * @access public
     * 
     * @return string Widget Name.
     */
    public function get_name(): string {
        return 'ceatextimage'; 
    }

    /**
     * Get widget title.
     * 
     * Retrieve Cea Text Image widget Title.
     * 
     * @since 1.0.0
     * @access public
     *
     * @return string Widget Title.
     */
    public function get_title(): string {
        return esc_html__( 'Text Image', 'classic-elementor-addons-pro' );     
    }

    /**
     * Get widget icon.
     * 
     * Retrieve Cea Text Image Icon.
     * 
     * @since 1.0.0
     * @access public
     *
     * @return string Widget Icon.
     */
    public function get_icon(): string {
        return 'cea-default-icon eicon-button';          
    }

    /**
     * Get widget categories.
     * 
     * Retrieve the list of categories the Cea Text Image widget belongs to.
     * 
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories(): array {
		return [ 'classic-elements' ];          
	}

    /**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
    public function get_keywords(): array {
        return [ 'text', 'image', 'animation', 'cea', 'zozo', 'classic' ];        
    }

    /**
     * Retrieve the list of scripts the Text Image widget depended on.
     * 
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     * 
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends(): array {
        return [ 'cea-custom-front' ];
    }

    /**
     * Retrieve the list of stylesheets the Text Image widget depended on.
     * 
     * Used to set styles dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     * 
     * @return array Widget styles dependencies.
     */
    public function get_style_depends(): array {
        return [ 'cea-editor', 'animate-style' ];
    }

    /**
     * Register Data Table widget controls.
     * 
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     * 
     * @return void
     */
    protected function register_controls(): void {

        // Content Tab Starts
        $this->start_controls_section(
            'general',
            [
                'label'     => esc_html__( 'General', 'classic-elementor-addons-pro' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder'     => esc_html__( 'Enter your Title' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'prefix_text',
            [
                'label'         => esc_html__( 'Prefix Text', 'classic-elementor-addons-pro' ),
                'type'          => \Elementor\Controls_Manager::TEXTAREA,
                'description'   => esc_html__( 'Leave empty if you don\'t need any Preffix Text', 'classic-elementor-addons-pro' ),
            ]
        );

        $repeater->add_control(
            'link_text',
            [
                'label'         => esc_html__( 'Link Text', 'classic-elementor-addons-pro' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'description'   => esc_html__( 'Enter your link text here', 'classic-elementor-addons-pro' ),
            ]
        );

        $repeater->add_control(
            'link_url',
            [
                'label'         => esc_html__( 'Text URL', 'classic-elementor-addons-pro' ),
                'type'          => \Elementor\Controls_Manager::TEXT,
                'label_block'   => true,
                'description'   => esc_html__( 'Enter your URL here', 'classic-elementor-addons-pro' ),
                'default'       => '#',
            ]
        );

        $repeater->add_control(
            'suffix_text',
            [
                'label'         => esc_html__( 'Suffix Text', 'classic-elementor-addons-pro' ),
                'type'          => \Elementor\Controls_Manager::TEXTAREA,
                'description'   => esc_html__( 'Leave empty if you don\'t need any suffix text', 'classic-elementor-addons-pro' ),
            ]
        );

        $repeater->add_control(
            'link_image',
            [
                'label'     => esc_html__( 'Link Attachment Image', 'classic-elementor-addons-pro' ),
                'type'      => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'link_list',
            [
                'label'     => esc_html__( 'Link Content', 'classic-elementor-addons-pro' ),
                'type'      => \Elementor\Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'title_field'	=> '{{{ link_text }}}'
            ]
        );

        $this->add_control(
            'mobile_disable',
            [
                'label'    => esc_html__( 'Disable in Mobile View', 'classic-elementor-addons-pro' ),
                'type'     => \Elementor\Controls_Manager::SWITCHER,
                'description' => esc_html__( 'Disable the image hover effect in mobile devices', 'classic-elementor-addons-pro' ),
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
        // Content Tab Ends

        // Title Style Tab Starts
        $this->start_controls_section(
            'style_title',
            [
                'label'     => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'         => esc_html__( 'Title Margin', 'classic-elementor-addons-pro' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'rem', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .text-image-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'         => esc_html__( 'Title Padding', 'classic-elementor-addons-pro' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'rem', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .text-image-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
			'title_align',
			[
				'label'     => esc_html__( 'Title Alignment', 'classic-elementor-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .text-image-title' => 'text-align: {{VALUE}};',
				],
				'default'   => 'center',
			]
		);

        $this->start_controls_tabs(
            'title_style_tab'
        );

        $this->start_controls_tab(
            'title_normal',
            [
                'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'    => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-image-title'  =>  'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_bgcolor',
            [
                'label'    => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-image-title'  =>  'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover',
            [
                'label'  => esc_html__( 'Hover', 'classic-elementor-addons-pro' ), 
            ]
        );

        $this->add_control(
            'title_hcolor',
            [
                'label'     => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-image-title:hover '  => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_hbgcolor',
            [
                'label'    => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-image-title:hover'  =>  'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'      => 'title_shadow',
				'selector'  => '{{WRAPPER}} .text-image-title',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'title_typography',
				'selector'  => '{{WRAPPER}} .text-image-title',
			]
		);

        $this->end_controls_section();
        // Title Style Tab Ends

        // Content Style Tab Starts
        $this->start_controls_section(
            'content_style',
            [
                'label'  => esc_html__( 'Content', 'classic-elementor-addons-pro' ),
                'tab'    => \Elementor\Controls_Manager::TAB_STYLE,   
            ]
        );

        $this->add_control(
            'content_margin',
            [
                'label'         => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'rem', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .text-image-container'  =>  'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'content_padding',
            [
                'label'         => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
                'type'          => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    => [ 'px', 'rem', 'em', '%' ],
                'selectors'     => [
                    '{{WRAPPER}} .text-image-container'  =>  'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
			'content_align',
			[
				'label'     => esc_html__( 'Title Alignment', 'classic-elementor-addons-pro' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'classic-elementor-addons-pro' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .text-image-container' => 'text-align: {{VALUE}};',
				],
				'default'   => 'left',
			]
		);

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .text-image-container' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'content_bgcolor',
            [
                'label'     => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors'  => [
                    '{{WRAPPER}} .text-image-container'  =>  'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'content_typography',
				'selector'  => '{{WRAPPER}} .text-image-container',
			]
		);

        $this->end_controls_section();
        // Content Style Tab Ends

        // Link Style Tab Starts
        $this->start_controls_section(
            'link_style',
            [
                'label'     => esc_html__( 'Link', 'classic-elementor-addons-pro' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'link_style_tab'
        );

        $this->start_controls_tab(
            'link_normal',
            [
                'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'    => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .link_text'  =>  'color: {{VALUE}};'
                ],
                'default'   => '#61CE70',
            ]
        );

        $this->add_control(
            'link_bgcolor',
            [
                'label'    => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .link_text'  =>  'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'link_hover',
            [
                'label'  => esc_html__( 'Hover', 'classic-elementor-addons-pro' ), 
            ]
        );

        $this->add_control(
            'link_hcolor',
            [
                'label'     => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .link_text:hover '  => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'link_hbgcolor',
            [
                'label'    => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
                'type'     => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .link_text:hover'  =>  'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
        // Link Style Tab Starts

        // Image Style Tab Starts
        $this->start_controls_section(
            'image_style',
            [
                'label'  =>  esc_html__( 'Image', 'classic-elementor-addons-pro' ),
                'tab'    =>  \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'         =>  esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
                'type'          =>  \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'    =>  [ 'px', '%', 'rem', 'em' ],
                'selectors'     =>  [
                    '{{WRAPPER}} .cursor-photo'  =>  'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'         =>  esc_html__( 'Width', 'classic-elementor-addons-pro' ),
                'type'          =>  \Elementor\Controls_Manager::SLIDER,
                'size_units'    =>  [ 'px', '%', 'rem', 'em' ],
                'range'         =>  [
                    'px'  =>  [
                        'min'  =>  0,
                        'max'  =>  200,
                    ],
                    '%'   =>  [
                        'min'  => 0,
                        'max'  => 100,
                    ],
                ],
                'default'   => [
                    'unit'  => 'px',
                    'size'  => 250,
                ],
                'selectors'     =>  [
                    '{{WRAPPER}} .cursor-photo'  =>  'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'selector' => '{{WRAPPER}} .cursor-photo',
			]
		);

        $this->add_responsive_control(
            'border_raduis',
            [
                'label'      => esc_html__( 'Border Raduis', 'classic-elementor-addons-pro' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'selectors'  => [
                    '{{WRAPPER}} .cursor-photo'  =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
			'image_animation',
			[
				"type"        => \Elementor\Controls_Manager::SELECT,
				"label"       => esc_html__("Image Animation", 'classic-elementor-addons-pro'),
				"default"		=> 'none',
				"options"		=> [
					"none"					=> esc_html__( "None", 'classic-elementor-addons-pro'),
					"fadeInDown"			=> esc_html__( "Fade In Down", 'classic-elementor-addons-pro' ),
					"fadeInUp"				=> esc_html__( "Fade In Up", 'classic-elementor-addons-pro' ),
					"bounce"				=> esc_html__( "Bounce", 'classic-elementor-addons-pro' ),
					"handShake"				=> esc_html__( "Hand Shake", 'classic-elementor-addons-pro' ),
					"tada"					=> esc_html__( "Tada", 'classic-elementor-addons-pro' ),
					"wobble"				=> esc_html__( "Wobble", 'classic-elementor-addons-pro' ),
					"heartBeat"				=> esc_html__( "HeartBeat", 'classic-elementor-addons-pro' ),
					"backInLeft"			=> esc_html__( "Back In Left", 'classic-elementor-addons-pro' ),
					"backInRight"			=> esc_html__( "Back In Right", 'classic-elementor-addons-pro' ),
					"flip"					=> esc_html__( "Flip", 'classic-elementor-addons-pro' ),
					"rotateOutUpLeft"		=> esc_html__( "Rotate Out UpLeft", 'classic-elementor-addons-pro' ),
					"rotateOutDownRight"	=> esc_html__( "Rotate Out DownRight", 'classic-elementor-addons-pro' ),
					"rollIn"				=> esc_html__( "Roll In", 'classic-elementor-addons-pro' ),
					"rollOut"				=> esc_html__( "Roll Out", 'classic-elementor-addons-pro' ),
					"zoomInUp"				=> esc_html__( "Zoom In Up", 'classic-elementor-addons-pro' ),
					"zoomInDown"			=> esc_html__( "Zoom In Down", 'classic-elementor-addons-pro' ),
					"rubberBand"			=> esc_html__( "RubberBand", 'classic-elementor-addons-pro' ),
					"swing"					=> esc_html__( "Swing", 'classic-elementor-addons-pro' ),
					"rotateOut"				=> esc_html__( "Rotate Out", 'classic-elementor-addons-pro' ),
					"rotateIn"				=> esc_html__( "Rotate In", 'classic-elementor-addons-pro' ),
					"slideInLeft"			=> esc_html__( "Slide In Left", 'classic-elementor-addons-pro' ),
					"slideInRight"			=> esc_html__( "Slide In Right", 'classic-elementor-addons-pro' ),
				],
				'default'		=> 'none',
			]
		);

        $this->add_control(
            'image_animation_delay',
            [
				"type"        => \Elementor\Controls_Manager::NUMBER,
				"label"       => esc_html__("Animation Delay (ms)", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Set the animation delay in milliseconds.", 'classic-elementor-addons-pro'),
				"default"     => 300,
				"selectors"   => [
					".cursor-image" => "animation-delay: {{VALUE}}ms;",
				]
			]
        );

        $this->end_controls_section();
        // Image Style Tab Ends

    }

    protected function render(): void {

        $settings = $this->get_settings_for_display();
        $_element = get_the_ID();
		$_widget = $this->get_id();
		$elementor_cls = 'elementor-'. $_element;
		$widget_cls = 'elementor-element elementor-element-'. $_widget;
        $img_animation = isset( $settings['image_animation'] ) && !empty( $settings['image_animation'] ) ? $settings['image_animation']: '';
        $image_animation_delay = isset($settings['image_animation_delay']) && !empty($settings['image_animation_delay']) ? $settings['image_animation_delay'] : '300';
        $disable_mobile = $settings['mobile_disable'];

        $link_image = array();
        foreach ($settings['link_list'] as $imgs) {
            $link_text = preg_replace( ['/[\s]+/', '/[.,]/'], '_', $imgs['link_text'] );
            $link_text = strtolower($link_text);
            $link_image[$link_text]   = $imgs['link_image'] && $imgs['link_image']['url'] != '' ? $imgs['link_image']['url'] : '';
        }

        $this->add_render_attribute('wrapper', 'data-settings', json_encode([
            'link_image'    => $link_image,
            'element_cls'   => $elementor_cls,
            'widget_cls'    => $widget_cls,
            'img_animation' => $img_animation,
            'ani_delay'     => $image_animation_delay,
        ]));

        ?>
        <div class="cea-text-image" <?php _e($this->get_render_attribute_string('wrapper')); ?> data-mobile-hide="<?php echo $disable_mobile; ?>">
            <h2 class="text-image-title"><?php _e($settings['title']); ?></h2>
            <p class="text-image-container">
                <?php foreach ( $settings['link_list'] as $link ): ?>
                    <?php
                        $link_class = preg_replace( ['/[\s]+/', '/[.,]/'], '_', $link['link_text'] );
                        $link_url = '';
                        $link_url = $link['link_url'];
                        $link_class = strtolower($link_class);
                        $link_content = '';
                        $link_content .= $link['prefix_text'] . ' ';
                        $link_content .= '<a class="link_text '. $link_class.'" href="'. $link_url .'">' . $link['link_text'] . '</a> ';
                        $link_content .= $link['suffix_text'];

                        _e( $link_content, 'text-image' );
                    ?>
                <?php endforeach; ?>
            </p>
        </div>
        <?php

    }

}