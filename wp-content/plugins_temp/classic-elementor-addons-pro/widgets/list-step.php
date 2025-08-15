<?php

namespace Elementor;
use Elementor\Utils;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon List Step
 *
 * @since 1.0.0
 */
class CEA_Elementor_List_Step_Widget extends \Elementor\Widget_Base {

    /**
	 * Get widget name.
	 *
	 * Retrieve Cea List Step widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "cealiststep";
	}

    /**
	 * Get widget title.
	 *
	 * Retrieve Cea List Step widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "List Step", 'classic-elementor-addons-pro' );
	}

    /**
	 * Get widget icon.
	 *
	 * Retrieve Cea List Step widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-view-list";
	}

    /**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Cea List Step widget belongs to.
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
     * Retrieve the list of keywords that used to search for Cea List Step widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'list', 'step', 'classic' ];
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
		return [ 'cea-custom-front'  ];
	}

    /**
     * Retrieve the list of styles the Cea List Step widget depends on.
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
	 * Register Cea List Step widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function register_controls(): void {

        // Content Tab Starts
        $this->start_controls_section(
			"general_content",
			[
				"label"	=> esc_html__( "General", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();
        $repeater->start_controls_tabs(
	        'list_step_content'
        );
	 $repeater->start_controls_tab(
            'list_step_more',
            [
                'label' => esc_html__( 'Layout', 'classic-elementor-addons-pro' )
            ]
        );
        $repeater->add_control(
            'list_step_bg_want',
            [
                'label' => esc_html__( 'Enable Background Image', 'classic-elementor-addons-pro' ),
                'type'  => \Elementor\Controls_Manager::SWITCHER,
                'options' => [
                    'yes' => esc_html__( 'Yes', 'classic-elementor-addons-pro' ),
                    'no' => esc_html__( 'No', 'classic-elementor-addons-pro' ),
                ],
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'list_step_bg',
            [
                'type'  => \Elementor\Controls_Manager::MEDIA,
                'condition' => [
                    'list_step_bg_want' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.list-step-item' => 'background-image: url("{{URL}}");'
                ],
                'has_sizes' => true,
			    'render_type' => 'template',
            ]
        );
        $repeater->add_responsive_control(
            'list_bg_pos',
            [
                'label' => esc_html__( 'Position', 'classic-elementor-addons-pro' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'separator' => 'before',
                'options' => [
			    	'' => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
			    	'center center' => esc_html__( 'Center Center', 'classic-elementor-addons-pro' ),
			    	'center left' => esc_html__( 'Center Left', 'classic-elementor-addons-pro' ),
			    	'center right' => esc_html__( 'Center Right', 'classic-elementor-addons-pro' ),
			    	'top center' => esc_html__( 'Top Center', 'classic-elementor-addons-pro' ),
			    	'top left' => esc_html__( 'Top Left', 'classic-elementor-addons-pro' ),
			    	'top right' => esc_html__( 'Top Right', 'classic-elementor-addons-pro' ),
			    	'bottom center' => esc_html__( 'Bottom Center', 'classic-elementor-addons-pro' ),
			    	'bottom left' => esc_html__( 'Bottom Left', 'classic-elementor-addons-pro' ),
			    	'bottom right' => esc_html__( 'Bottom Right', 'classic-elementor-addons-pro' ),
			    ],
                'selectors' => [
				    '{{WRAPPER}} {{CURRENT_ITEM}}.list-step-item' => 'background-position: {{VALUE}};',
			    ],
                'condition' => [
				    'list_step_bg[url]!' => '',
				    'list_step_bg_want' => 'yes'
			    ],
            ]
        );
        $repeater->add_control(
            'list_bg_attach',
            [
                'label' => esc_html_x( 'Attachment', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
			    'default' => '',
			    'options' => [
			    	'' => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
			    	'scroll' => esc_html_x( 'Scroll', 'Background Control', 'classic-elementor-addons-pro' ),
			    	'fixed' => esc_html_x( 'Fixed', 'Background Control', 'classic-elementor-addons-pro' ),
			    ],
                'selectors' => [
				    '{{WRAPPER}} {{CURRENT_ITEM}}.list-step-item' => 'background-attachment: {{VALUE}};',
			    ],
                'condition' => [
				    'list_step_bg[url]!' => '',
				    'list_step_bg_want' => 'yes'
			    ],
            ]
        );
        $repeater->add_responsive_control(
            'list_bg_repeat',
            [
                'label' => esc_html_x( 'Repeat', 'classic-elementor-addons-pro' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'default' => '',
			    'options' => [
			    	'' => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
			    	'no-repeat' => esc_html__( 'No-repeat', 'classic-elementor-addons-pro' ),
			    	'repeat' => esc_html__( 'Repeat', 'classic-elementor-addons-pro' ),
			    	'repeat-x' => esc_html__( 'Repeat-x', 'classic-elementor-addons-pro' ),
			    	'repeat-y' => esc_html__( 'Repeat-y', 'classic-elementor-addons-pro' ),
			    ],
			    'selectors' => [
			    	'{{WRAPPER}} {{CURRENT_ITEM}}.list-step-item' => 'background-repeat: {{VALUE}};',
			    ],
			    'condition' => [
			    	'list_step_bg[url]!' => '',
			    	'list_step_bg_want' => 'yes'
			    ],
            ]
        );
        $repeater->add_responsive_control(
            'list_bg_size',
            [
                'label' => esc_html_x( 'Size', 'classic-elementor-addons-pro' ),
			    'type' => \Elementor\Controls_Manager::SELECT,
			    'default' => '',
			    'options' => [
			    	'' => esc_html__( 'Default', 'classic-elementor-addons-pro' ),
			    	'auto' => esc_html__( 'Auto', 'classic-elementor-addons-pro' ),
			    	'cover' => esc_html__( 'Cover', 'classic-elementor-addons-pro' ),
			    	'contain' => esc_html__( 'Contain', 'classic-elementor-addons-pro' ),
			    ],
			    'selectors' => [
			    	'{{WRAPPER}} {{CURRENT_ITEM}}.list-step-item' => 'background-size: {{VALUE}};',
			    ],
			    'condition' => [
			    	'list_step_bg[url]!' => '',
			    	'list_step_bg_want' => 'yes'
			    ],
            ]
        );
        $repeater->add_control(
			'more_options',
			[
				'label' => esc_html__( 'Layout Options', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $repeater->add_control(
            'list_layout_left',
            [
                'label' => esc_html__( 'Left Items', 'classic-elementor-addons-pro' ),
			    'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
				'multiple' => true,
				'options' => [
					'title'  => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
					'description' => esc_html__( 'Content', 'classic-elementor-addons-pro' ),
					'button' => esc_html__( 'Button', 'classic-elementor-addons-pro' ),
                    'image' => esc_html__( 'Image', 'classic-elementor-addons-pro' )
				],
				'default' => [ 'title', 'description', 'button' ],
            ]
        );
        $repeater->add_control(
            'list_layout_right',
            [
                'label' => esc_html__( 'Right Items', 'classic-elementor-addons-pro' ),
			    'type' => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
				'multiple' => true,
				'options' => [
					'title'  => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
					'description' => esc_html__( 'Content', 'classic-elementor-addons-pro' ),
					'button' => esc_html__( 'Button', 'classic-elementor-addons-pro' ),
                    'image' => esc_html__( 'Image', 'classic-elementor-addons-pro' )
				],
				'default' => [ 'image' ],
            ]
        );
        $repeater->end_controls_tab();
        $repeater->start_controls_tab(
            'list_content_step',
            [
                'label' => esc_html__( 'Content', 'classic-elementor-addons-pro' )
            ]
        );
        $repeater->add_control(
            'list_title',
            [
                'label' => esc_html__( 'List Title', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __( 'This is List Title', 'classic-elementor-addons-pro' ),
            ]
        );
        $repeater->add_control(
            'list_content',
            [
                'label' => esc_html__( 'List Content', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows'  => 15,
                'default' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. Nibh sapien per lectus sollicitudin sodales, sem suscipit augue. Luctus arcu maecenas donec donec venenatis sapien auctor est. Sapien ullamcorper tristique donec tempus libero ante porta fusce. Magna sodales curabitur hac nec suscipit malesuada consectetur. Diam enim accumsan fusce rhoncus fusce integer',
            ]
        );
        $repeater->end_controls_tab();
        $repeater->start_controls_tab(
            'list_content_button',
            [
                'label' => esc_html__( 'Button', 'classic-elementor-addons-pro' )
            ]
        );
        $repeater->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Click Here',
            ]
        );
        $repeater->add_control(
            'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '#',
            ]
        );
        $repeater->add_control(
			'button_icon',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
			]
		);
        $repeater->add_control(
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
        $repeater->end_controls_tab();
        $repeater->start_controls_tab(
            'list_content_image',
            [
                'label' => esc_html__( 'Image', 'classic-elementor-addons-pro' )
            ]
        );
        $repeater->add_control(
            'list_image',
            [
                'label'     => esc_html__( 'Image', 'classic-elementor-addons-pro' ),
                'type'      => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_image_size',
            [
                'label'   => esc_html__( 'Image Size', 'classic-elementor-addons-pro' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'thumbnail'     => 'Thumbnail',
                    'medium'        => 'Medium',
                    'large'         => 'Large',
                    'full'          => 'Full',
                    'custom'        => 'Custom'
                ],
            ]
        );

        $repeater->add_control(
            'custom_width',
            [
                'label' => esc_html__( 'Custom Width (px)', 'classic-elementor-addons-pro' ),
                'type'  => Controls_Manager::NUMBER,
                'condition' => [
                    'list_image_size' => 'custom',
                ],
            ]
        );

        $repeater->add_control(
            'custom_height',
            [
                'label' => esc_html__( 'Custom Height (px)', 'classic-elementor-addons-pro' ),
                'type'  => Controls_Manager::NUMBER,
                'condition' => [
                    'list_image_size' => 'custom',
                ],
            ]
        );

        $repeater->end_controls_tab();
        
        $repeater->end_controls_tabs();
        

        $this->add_control(
            'repeater_list',
            [
                'label' => esc_html__( 'List Items', 'classic-elementor-addons-pro' ),
                'type'  => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_title' => esc_html__( 'List Item 1', 'classic-elementor-addons-pro' ),
                    ],
                    [
                        'list_title' => esc_html__( 'List Item 2', 'classic-elementor-addons-pro' ),
                    ],
                    [
                        'list_title' => esc_html__( 'List Item 3', 'classic-elementor-addons-pro' ),
                    ],
                ],
                'title_field'	=> '{{{ list_title }}}',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
			"addition_settings",
			[
				"label"	=> esc_html__( "Additional Settings", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'break_point',
            [
                "label" => esc_html__( "Breakpoints", "classic-elementor-addons-pro" ),
                "type" => \Elementor\Controls_Manager::SELECT,
                "options" => [
                    "none" => esc_html__( "None", "classic-elementor-addons-pro" ),
                    "mobile" => esc_html__( "Mobile Portrait (> 767px)", "classic-elementor-addons-pro" ),
                    "tablet" => esc_html__( "Tablet Portrait (> 1024px)", "classic-elementor-addons-pro" ),
                ],
                "default" => 'none'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'general',
            [
                'label' => esc_html__( 'Layout', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'stack_from',
            [
                'label' => esc_html__( 'List Stack from', 'classic-elementor-addons-pro' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'size' => 200,
                ],
                'range' => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 1000,
                        'step' => 50,
                    ]
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .list-step' => '--stack-top: {{SIZE}};'
                ]
            ]
        );
        $this->add_responsive_control(
            'list_height',
            [
                'label' => esc_html__( 'Height', 'classic-elementor-addons-pro' ),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-step-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_margin',
            [
                'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .list-step-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_padding',
            [
                'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .list-step-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->start_controls_tabs(
            'style_list_tab'
        );
        $this->start_controls_tab(
            'style_list_nr_tab',
            [
                'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
            ]
        );
        $this->add_control(
            'list_clr',
            [
                'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .list-step-item' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .list-step-item h4' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .list-step-item p' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'list_back_clr',
            [
                'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .list-step-item' => 'background-color: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'style_list_hr_tab',
            [
                'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
            ]
        );
        $this->add_control(
            'list_clr_hr',
            [
                'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .list-step-item:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .list-step-item:hover h4' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .list-step-item:hover p' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'list_back_clr_hr',
            [
                'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .list-step-item:hover' => 'background-color: {{VALUE}};'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
			'hrds',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

        $this->add_responsive_control(
			'list_content_align',
			[
				'label' => esc_html__( 'Alignment', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Start', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-justify-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-justify-center-h',
					],
					'right' => [
						'title' => esc_html__( 'End', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-justify-end-h',
					],
					'space-around' => [
						'title' => esc_html__( 'Space Around', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-justify-space-around-h',
					],
					'space-between' => [
						'title' => esc_html__( 'Space Between', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-justify-space-between-h',
                    ],
					'space-evenly' => [
						'title' => esc_html__( 'Space Evenly', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-justify-space-evenly-h',
                    ],
				],				
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .list-step-content ' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .list-step-content .list-step-left' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .list-step-content .list-step-right' => 'justify-content: {{VALUE}};',
				],
                'separator' => 'after'
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'list_item_border',
				'selector' => '{{WRAPPER}} .list-step-item',
			]
		);

        $this->add_responsive_control(
            'list_item_rad',
            [
                'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .list-step-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        
        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'list_item_shadow',
				'selector' => '{{WRAPPER}} .list-step-item',
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
            'list_title',
            [
                'label' => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_title_margin',
            [
                'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .list-step-head' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_title_padding',
            [
                'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .list-step-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'list_title_color',
            [
                'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .list-step-content h4.list-step-head' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
			'list_title_spacing',
			[
				'label' => esc_html__( 'Title Spacing', 'classic-elementor-addons-pro' ),
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
					'{{WRAPPER}} .list-step-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'list_title_typography',
				'selector' 		=> '{{WRAPPER}} .list-step-head',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'list_para',
            [
                'label' => esc_html__( 'List Content', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'list_para_margin',
            [
                'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .list-step-para' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'list_para_padding',
            [
                'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .list-step-para' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'list_para_color',
            [
                'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .list-step-content p.list-step-para' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_responsive_control(
			'list_para_spacing',
			[
				'label' => esc_html__( 'Para Spacing', 'classic-elementor-addons-pro' ),
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
					'{{WRAPPER}} .list-step-para' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'list_para_typography',
				'selector' 		=> '{{WRAPPER}} .list-step-para',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'list_button',
            [
                'label' => esc_html__( 'List Button', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
		        ],
				'style_transfer' => true,
			]
		);

        $this->add_responsive_control(
			'button_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'rem', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .list-step-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs( 'button_clr' );

		$this->start_controls_tab(
			'button_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-step-btn' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
                'default' => '#fff',
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-step-btn' => 'background-color: {{VALUE}};',
				],
                'default' => '#000'
			]
		);
		$this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover',
            [
                'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
            ]
        );
        $this->add_control(
			'btn_hover_clr',
			[
				'label' => esc_html__( 'Text Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-step-btn:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'btn_hover_back',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .list-step-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'btn_hover',
            [
                'label' => esc_html__( 'Hover Animation', 'classic-elementor-addons-pro' ),
                'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_btn',
				'selector' => '{{WRAPPER}} .list-step-btn',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .list-step-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'btn_text_typo',
				'selector' 		=> '{{WRAPPER}} .list-step-btn',
			]
		);

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .list-step-btn',
			]
		);

        $this->add_control(
            'btn_icon_space',
            [
                'label' => esc_html__( 'Icon Spacing', 'classic-elementor-addons-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 25,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-step-btn .list-align-icon-left svg' => 'margin-right:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .list-step-btn .list-align-icon-right svg' => 'margin-left:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .list-step-btn .list-align-icon-left i' => 'margin-right:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .list-step-btn .list-align-icon-right i' => 'margin-left:{{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->add_control(
            'btn_icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'classic-elementor-addons-pro' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 25,
                        'step' => 1,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-step-btn .list-align-icon-left svg' => 'width:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .list-step-btn .list-align-icon-right svg' => 'width:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .list-step-btn .list-align-icon-left i' => 'font-size:{{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .list-step-btn .list-align-icon-right i' => 'font-size:{{SIZE}}{{UNIT}}',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_image',
            [
                'label' => esc_html__( 'List Image', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('list_image_style');
        $this->start_controls_tab( 
            'normal',
			[
				'label' => esc_html__( 'Normal', 'elementor' ),
			]
		);
		$this->add_control(
			'opacity',
			[
				'label' => esc_html__( 'Opacity', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-step-image' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .list-step-image',
			]
		);
        $this->end_controls_tab();
        $this->start_controls_tab( 
            'hover',
			[
				'label' => esc_html__( 'Hover', 'elementor' ),
			]
		);
		$this->add_control(
			'opacity_img_hover',
			[
				'label' => esc_html__( 'Opacity', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .list-step-image:hover' => 'opacity: {{SIZE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'img_hover_filter',
				'selector' => '{{WRAPPER}} .list-step-image:hover',
			]
		);
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border_img',
				'selector' => '{{WRAPPER}} .list-step-image img',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .list-step-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .list-step-image img',
			]
		);

        $this->add_control(
            'img_hide_sm',
            [
                'label' => esc_html__( 'Hide on Responsive ?', 'classic-elementor-addons-pro' ),
                'description' => esc_html__( 'Hide on Tablets, Mobiles for Responsiveness', 'classic-elementor-addons-pro' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
			'custom_panel_notice',
			[
				'type' =>Controls_Manager::NOTICE,
				'notice_type' => 'info',
				'dismissible' => true,
				'heading' => esc_html__( 'Recommended', 'classic-elementor-addons-pro' ),
				'content' => esc_html__( 'It\'s recommended it hide the image in small devices', 'classic-elementor-addons-pro' ),
			]
		);

        $this->end_controls_section();

    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
        $break_point = $settings['break_point'];
        $button_hover = $settings['btn_hover'];
        $hide_img = $settings['img_hide_sm'];
        $button_size = $settings['button_size'];

        $migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();

        echo '<div class="list-step" data-hide-sm="'. $hide_img .'" data-wrap="'. $break_point .'">';
            echo '<div class="list-step-container">';
            $index = 0;
            foreach( $settings['repeater_list'] as $list ) {
                $list_text = $list['list_content'];
                $list_title = $list['list_title'];
                $list_btn = $list['btn_text'] ?? 'Click Here';
                $list_link = $list['btn_link'] ?? '#';
                $list_image      = $list['list_image'];
                $list_image_size = $list['list_image_size'];
                $custom_width    = $list['custom_width'];
                $custom_height   = $list['custom_height'];
                $image_size = $list_image_size !== 'custom' ? $list_image_size : [ $custom_width, $custom_height ];
                $left_items = $list['list_layout_left'];
                $right_items = $list['list_layout_right'];
                
                echo '<div class="list-step-item list-item-'.$index.' elementor-repeater-item-'. $list['_id'] .'">';
                echo '<div class="list-step-content">';

                if( is_array( $left_items ) ) {
                    echo '<div class="list-step-left">';
                    foreach( $left_items as $left ) {
                        $output = '';
                        switch( $left ) {

                            case 'title': 
                                $output .= '<h4 class="list-step-head"> ' . $list_title . '</h4>';
                                break;
                            
                            case 'description':
                                $output .= '<p class="list-step-para">' . $list_text . '</p>';
                                break;

                            case 'button':
                                $output .= '<div class="cea-button-wrapper"><div class="cea-button-wrapper">';
                                $output .= '<a class="list-step-btn cea-button-link elementor-button cea-button elementor-size-'.$button_size.' elementor-animation-' . $button_hover . '" href="' . $list_link . '" target="_blank" >';
                                $output .= '<span class="cea-button-content-wrapper">';
                                $output .= '<span class="cea-button-icon list-align-icon-' . $list['button_icon_align'].'">';
                                if( $list['button_icon_align'] == 'left' ) {
                                    if ( $is_new || $migrated ) {
                                        ob_start();
                                        Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] );
                                        $output .= ob_get_clean();
                                    } else {
                                        $output .= '<i class="'.$list['button_icon'].'" aria-hidden="true"></i>';
                                    }
                                }
                                $output .= $list_btn;
                                if( $list['button_icon_align'] == 'right' ) {
                                    if ( $is_new || $migrated ) {
                                        ob_start();
                                        Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] );
                                        $output .= ob_get_clean();
                                    } else {
                                        $output .= '<i class="'.$list['button_icon'].'" aria-hidden="true"></i>';
                                    }
                                }
                                $output .= '<span></span></a></div></div>';
                                break;

                            case 'image':
                                if ( ! empty( $list_image['id'] ) ) {
                                    $output .= '<div class="list-step-image">';
                                    
                                    $img_atts = [
                                        'alt' => esc_attr( $list_title ),
                                    ];
                                    
                                    // Detect if custom size selected
                                    $image_size = $list_image_size !== 'custom'
                                        ? $list_image_size
                                        : [ intval( $custom_width ), intval( $custom_height ) ];

                                    $output .= wp_get_attachment_image(
                                        $list_image['id'],
                                        $image_size,
                                        false,
                                        $img_atts
                                    );
                                        
                                    $output .= '</div><!--div.list-step-image-->';
                                }
                                break;

                        }
                        echo $output;
                    }
                    echo '</div><!-- list-step-left -->';

                }

                if( is_array( $right_items ) ) {
                    echo '<div class="list-step-right">';
                    foreach( $right_items as $right ) {
                        $output = '';
                        switch( $right ) {

                            case 'title': 
                                $output .= '<h4 class="list-step-head"> ' . $list_title . '</h4>';
                                break;
                            
                            case 'description':
                                $output .= '<p class="list-step-para">' . $list_text . '</p>';
                                break;

                            case 'button':
                                $output .= '<div class="cea-button-wrapper"><div class="cea-button-wrapper">';
                                $output .= '<a class="list-step-btn cea-button-link elementor-button cea-button elementor-size-'.$button_size.' elementor-animation-' . $button_hover . '" href="' . $list_link . '" target="_blank" >';
                                $output .= '<span class="cea-button-content-wrapper">';
                                $output .= '<span class="cea-button-icon list-align-icon-' . $list['button_icon_align'].'">';
                                if( $list['button_icon_align'] == 'left' ) {
                                    if ( $is_new || $migrated ) {
                                        ob_start();
                                        Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] );
                                        $output .= ob_get_clean();
                                    } else {
                                        $output .= '<i class="'.$list['button_icon'].'" aria-hidden="true"></i>';
                                    }
                                }
                                $output .= $list_btn;
                                if( $list['button_icon_align'] == 'right' ) {
                                    if ( $is_new || $migrated ) {
                                        ob_start();
                                        Icons_Manager::render_icon( $list['button_icon'], [ 'aria-hidden' => 'true' ] );
                                        $output .= ob_get_clean();
                                    } else {
                                        $output .= '<i class="'.$list['button_icon'].'" aria-hidden="true"></i>';
                                    }
                                }
                                $output .= '<span></span></a></div></div>';
                                break;
                            case 'image':
                                    if ( ! empty( $list_image['id'] ) ) {
                                        $output .= '<div class="list-step-image">';

                                        $img_atts = [
                                            'alt' => esc_attr( $list_title ),
                                        ];

                                        // Detect if custom size selected
                                        $image_size = $list_image_size !== 'custom'
                                            ? $list_image_size
                                            : [ intval( $custom_width ), intval( $custom_height ) ];

                                        $output .= wp_get_attachment_image(
                                            $list_image['id'],
                                            $image_size,
                                            false,
                                            $img_atts
                                        );

                                        $output .= '</div><!--div.list-step-image-->';
                                    }
                                break;
                        }
                        echo $output;
                    }
                    echo '</div><!-- list-step-right -->';

                }

                echo '</div><!--div.list-step-content-->';
                echo '</div><!--div.list-step-item-->';

                $index++;
            }
            echo '</div><!--div.list-step-container-->';
        echo '</div><!--div.list-step-->';
    }

}
