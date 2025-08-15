<?php

namespace Elementor;

use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Modules\Promotions\Controls\Promotion_Control;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Image Zoom
 *
 * @since 1.0.0
 */
class CEA_Elementor_Image_Zoom_Widget extends Widget_Base {
	
    /**
	 * Get widget name.
	 *
	 * Retrieve Cea Image Zoom widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceaimagezoom";
	}

    /**
	 * Get widget title.
	 *
	 * Retrieve Cea Image Zoom widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Image Zoom", 'classic-elementor-addons-pro' );
	}

    /**
	 * Get widget icon.
	 *
	 * Retrieve Cea Image Zoom widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-zoom-in";
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Cea Image Zoom widget belongs to.
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
     * Retrieve the list of keywords that used to search for Cea Image Zoom widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'image', 'zoom', 'classic' ];
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
	 * Register Cea Image Zoom widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function register_controls(): void {

        // Content Tab Starts
        $this->start_controls_section(
	    	'general',
	    	[
	    		'label' => esc_html__( 'General', 'classic-elementor-addons-pro' ),
	    		'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
	    	]
	    );
        $this->add_control(
            'select_type',
            [
                'label' => esc_html__( 'Select Type', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'image-zoom' => esc_html__( 'Image Zoom', 'classic-elementor-addons-pro' ),
                    'grid-zoom' => esc_html__( 'Grid Zoom', 'classic-elementor-addons-pro' ),
                ],
                'default' => 'image-zoom',
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'This is Title Text',
            ]
        );
        $this->add_control(
			'title_tag',
			[
				'label' => __( 'Choose Title tag', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' 	=> __( 'h1', 'classic-elementor-addons-pro' ),
					'h2' 	=> __( 'h2', 'classic-elementor-addons-pro' ),
					'h3' 	=> __( 'h3', 'classic-elementor-addons-pro' ),
					'h4' 	=> __( 'h4', 'classic-elementor-addons-pro' ),
					'h5' 	=> __( 'h5', 'classic-elementor-addons-pro' ),
					'h6' 	=> __( 'h6', 'classic-elementor-addons-pro' ),
					'p' 	=> __( 'p', 'classic-elementor-addons-pro' ),
					'span' 	=> __( 'span', 'classic-elementor-addons-pro' ),
					'div' 	=> __( 'div', 'classic-elementor-addons-pro' )
				]
			]
		);	
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'This is Subtitle', 'classic-elementor-addons-pro' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );
        $this->add_control(
			'sub_title_tag',
			[
				'label' => __( 'Choose Sub-Title tag', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h6',
				'options' => [
					'h1' 	=> __( 'h1', 'classic-elementor-addons-pro' ),
					'h2' 	=> __( 'h2', 'classic-elementor-addons-pro' ),
					'h3' 	=> __( 'h3', 'classic-elementor-addons-pro' ),
					'h4' 	=> __( 'h4', 'classic-elementor-addons-pro' ),
					'h5' 	=> __( 'h5', 'classic-elementor-addons-pro' ),
					'h6' 	=> __( 'h6', 'classic-elementor-addons-pro' ),
					'p' 	=> __( 'p', 'classic-elementor-addons-pro' ),
					'span' 	=> __( 'span', 'classic-elementor-addons-pro' ),
					'div' 	=> __( 'div', 'classic-elementor-addons-pro' )
				]
			]
		);	
        // $this->add_control(
        //     'sub_title_pos',
        //     [
        //         'label' => __( 'Sub-Title Position', 'classic-elementor-addons-pro' ),
		// 		'type' => Controls_Manager::SELECT,
		// 		'default' => 'before',
        //         'options' => [
		// 			'40%' 	=> __( 'Before', 'classic-elementor-addons-pro' ),
		// 			'55%' 	=> __( 'After', 'classic-elementor-addons-pro' )
		// 		],
        //         'selectors' => [
        //             '{{WRAPPER}} .image-zoom-sub-title' => 'top: {{VALUE}}',
        //         ]

        //     ]
        // );
        $this->add_control(
			'zoom_type',
			[
				'label' => esc_html__( 'Choose Media Type', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'image',
				'options' => [
					'image' => esc_html__( 'Image', 'classic-elementor-addons-pro' ),
					'video' => esc_html__( 'Video', 'classic-elementor-addons-pro' ),
				],
				'separator' => 'before',
				'condition'	=>  [
					'select_type'	=>   'image-zoom'
				]
			]
		);
        $this->add_control(
            'image',
            [
                'label' => esc_html__( 'Image', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
                'condition' => [
                    'select_type' => 'image-zoom',
                    'zoom_type' => 'image',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
			'zoom_video_type',
			[
				'label' => esc_html__( 'Video Source', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'zoom_youtube',
				'options' => [
					'zoom_youtube' => esc_html__( 'YouTube', 'classic-elementor-addons-pro' ),
					'zoom_vimeo' => esc_html__( 'Vimeo', 'classic-elementor-addons-pro' ),
					// 'zoom_dailymotion' => esc_html__( 'Dailymotion', 'classic-elementor-addons-pro' ),
					'zoom_hosted' => esc_html__( 'Self Hosted', 'classic-elementor-addons-pro' ),
				],
				'frontend_available' => true,
				'condition' => [
					'zoom_type' => 'video',
				]
			]
		);
		$this->add_control(
			'zoom_youtube_url',
			[
				'label' => esc_html__( 'Link', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => esc_html__( 'Enter your URL', 'classic-elementor-addons-pro' ) . ' (YouTube)',
				'default' => 'https://www.youtube.com/watch?v=XHOmBV4js_E',
				'label_block' => true,
				'condition' => [
					'zoom_type' => 'video',
					'zoom_video_type' => 'zoom_youtube',
				],
				'ai' => [
					'active' => false,
				],
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'zoom_vimeo_url',
			[
				'label' => esc_html__( 'Link', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => esc_html__( 'Enter your URL', 'classic-elementor-addons-pro' ) . ' (Vimeo)',
				'default' => 'https://vimeo.com/235215203',
				'label_block' => true,
				'condition' => [
					'zoom_type' => 'video',
					'zoom_video_type' => 'zoom_vimeo',
				],
				'ai' => [
					'active' => false,
				],
			]
		);
		$this->add_control(
			'zoom_dailymotion_url',
			[
				'label' => esc_html__( 'Link', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'placeholder' => esc_html__( 'Enter your URL', 'classic-elementor-addons-pro' ) . ' (Dailymotion)',
				'default' => 'https://www.dailymotion.com/video/x6tqhqb',
				'label_block' => true,
				'condition' => [
					'zoom_type' => 'video',
					'zoom_video_type' => 'zoom_dailymotion',
				],
				'ai' => [
					'active' => false,
				],
			]
		);
		$this->add_control(
			'zoom_hosted_url',
			[
				'label' => esc_html__( 'Choose Video File', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
					'categories' => [
						TagsModule::MEDIA_CATEGORY,
					],
				],
				'media_types' => [
					'video',
				],
				'condition' => [
					'zoom_type' => 'video',
					'zoom_video_type' => 'zoom_hosted',
				],
			]
		);
        $repeater = new Repeater();
        $repeater->add_control(
            'image_item',
            [
                'label' => esc_html__( 'Image', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
            ]
        );
        $repeater->add_responsive_control(
            'item_width',
            [
                'label' => esc_html__( 'Width', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
					],
					'rem' => [
						'min' => 0,
						'max' => 50,
					]

                ],
                'selectors' => [
                    '{{CURRENT_ITEM}}.zoom-grid-item' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );
        $repeater->add_responsive_control(
            'item_position_x',
            [
                'label' => esc_html__( 'Image Position - X', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 0,
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'vh' ],
				'selectors' => [
					'{{CURRENT_ITEM}}.zoom-grid-item' => 'left: {{SIZE}}{{UNIT}}',
				],
            ]
        );
        $repeater->add_responsive_control(
            'item_position_y',
            [
                'label' => esc_html__( 'Image Position - Y', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 0,
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'vh' ],
				'selectors' => [
					'{{CURRENT_ITEM}}.zoom-grid-item' => 'top: {{SIZE}}{{UNIT}}',
				],
            ]
        );
        $repeater->add_responsive_control(
            'item_index',
            [
                'label' => esc_html__( 'Z - Index', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'selectors' => [
                    '{{CURRENT_ITEM}}.zoom-grid-item' => 'z-index: {{SIZE}};'
                ]
            ]
        );
		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'grid_border',
				'selector' => '{{CURRENT_ITEM}}.zoom-grid-item img',
				'separator' => 'before',
			]
		);
		$repeater->add_responsive_control(
			'grid_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'rem', 'em' ],
				'selectors' => [
					'{{CURRENT_ITEM}}.zoom-grid-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
            'image_grid',
            [
                'label' => esc_html__( 'Image Grid', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => [
                    'select_type' => 'grid-zoom'
                ]
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'large',
                'condition' => [
                    'select_type' => 'image-zoom',
                    'zoom_type' => 'image'
                ]
			]
		);
		$this->add_control(
			'img_style',
			[
				'label' => esc_html__( 'Image Style', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				"description"	=> esc_html__( "Choose image style.", 'classic-elementor-addons-pro' ),
				"default"		=> "squared",
				"options"		=> [
					"squared"			=> esc_html__( "Squared", 'classic-elementor-addons-pro' ),
					"rounded"			=> esc_html__( "Rounded", 'classic-elementor-addons-pro' ),
					"rounded-circle"	=> esc_html__( "Circled", 'classic-elementor-addons-pro' )
				],
				'condition' => [
                    'select_type' => 'image-zoom',
                    'zoom_type' => 'image'
                ]
			]
		);
        $this->end_controls_section();
        // Content Tab Ends
        
        	$this->start_controls_section(
            'zoom_options',
            [
                'label' => esc_html__( 'Zoom Options', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_responsive_control(
			'zoom_scale_from',
			[
				'label' => esc_html__( 'Zoom Scale from', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 2,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 0.5,
				],
				'selectors' => [
					'{{WRAPPER}} .image-zoom-scroll' => '--zoom-scale-from: {{SIZE}};',
					'{{WRAPPER}} .cea-zoom-video' => '--zoom-scale-from: {{SIZE}};',
				]
			]
		);
		$this->add_responsive_control(
			'zoom_scale_to',
			[
				'label' => esc_html__( 'Zoom Scale To', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0.1,
						'max' => 2,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 1.5,
				],
				'selectors' => [
					'{{WRAPPER}} .image-zoom-scroll' => '--zoom-scale-to: {{SIZE}};',
					'{{WRAPPER}} .cea-zoom-video' => '--zoom-scale-to: {{SIZE}};',
				]
			]
		);
		$this->add_responsive_control(
			'zoom_opacity_from',
			[
				'label' => esc_html__( 'Zoom Opacity From', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 0.5,
				],
				'selectors' => [
					'{{WRAPPER}} .image-zoom-scroll' => '--zoom-opacity-from: {{SIZE}};',
					'{{WRAPPER}} .cea-zoom-video' => '--zoom-opacity-from: {{SIZE}};',
				]
			]
		);
		$this->add_responsive_control(
			'zoom_opacity_to',
			[
				'label' => esc_html__( 'Zoom Opacity To', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .image-zoom-scroll' => '--zoom-opacity-to: {{SIZE}};',
					'{{WRAPPER}} .cea-zoom-video' => '--zoom-opacity-to: {{SIZE}};',
				]
			]
		);
		$this->add_control(
			'zoom_disable_on_mobile',
			[
				'label' => __( 'Disable Animation on Mobile', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'classic-elementor-addons-pro' ),
				'label_off' => __( 'No', 'classic-elementor-addons-pro' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section();
		
		$this->start_controls_section(
            'zoom_video_option',
            [
                'label' => esc_html__( 'Video Options', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => [
					'zoom_type' => 'video'
				]
            ]
        );
		$this->add_control(
			'zoom_start',
			[
				'label' => esc_html__( 'Start Time', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Specify a start time (in seconds)', 'classic-elementor-addons-pro' ),
				'frontend_available' => true,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'video_autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'classic-elementor-addons-pro' ),
				'description' => esc_html__( 'Autoplay works when mute is enabled', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'video_muted',
			[
				'label' => esc_html__( 'Mute Video', 'classic-elementor-addons-pro' ),
				'description' => esc_html__( 'Enable this to make autoplay work', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'frontend_available' => true,
			]
		);
		$this->add_control(
			'video_controls',
			[
				'label' => esc_html__( 'Video Controls', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'classic-elementor-addons-pro' ),
				'label_off' => esc_html__( 'Hide', 'classic-elementor-addons-pro' ),
				'condition' => [
					'zoom_video_type' => [ 'zoom_youtube', 'zoom_dailymotion', 'zoom_hosted' ],
				]
			]
		);
		$this->add_control(
			'all_video_control',
			[
				'label' => esc_html__( 'Hide All Controls', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'classic-elementor-addons-pro' ),
				'label_off' => esc_html__( 'Hide', 'classic-elementor-addons-pro' ),
				'condition' => [
					'zoom_video_type' => 'zoom_vimeo'
				]
			]
		);
		$this->add_control(
			'video_loop',
			[
				'label' => esc_html__( 'Loop Video', 'classic-elementor-addons-pro' ),
				'description' => esc_html__( 'Enable this to make the video play in loop', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'frontend_available' => true,
				'condition' => [
					'zoom_video_type' => 'zoom_youtube',
				]
			]
		);
		$this->end_controls_section();

        // Text Style Tab Starts
        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__( 'Title', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'title_align',
			[
				'label' => esc_html__( 'Alignment', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .image-zoom-text' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->add_control(
            'title_clr',
            [
                'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .image-zoom-text' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );
        $this->add_control(
			'title_pos_hori',
			[
				'label' => esc_html__( 'Horizontal Orientation', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'toggle' => false,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-left',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);
        $this->add_responsive_control(
			'title_pos_x',
			[
				'label' => esc_html__( 'Offset', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 0,
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .image-zoom-text' => 'left: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'title_pos_hori!' => 'end',
				],
			]
		);
        $this->add_responsive_control(
			'title_pos_x_end',
			[
				'label' => esc_html__( 'Offset', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 0,
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .image-zoom-text' => 'right: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'title_pos_hori' => 'end',
				],
			]
		);
        $this->add_control(
			'title_pos_veri',
			[
				'label' => esc_html__( 'Vertical Orientation', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'toggle' => false,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Top', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-v-align-top',
					],
					'end' => [
						'title' => esc_html__( 'Bottom', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
			]
		);
        $this->add_responsive_control(
			'title_pos_y',
			[
				'label' => esc_html__( 'Offset', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw' ],
				'default' => [
					'size' => 45,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .image-zoom-text' => 'top: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'title_pos_veri!' => 'end',
				],
			]
		);
        $this->add_responsive_control(
			'title_pos_y_end',
			[
				'label' => esc_html__( 'Offset', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw' ],
				'default' => [
					'size' => 0,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .image-zoom-text' => 'bottom: {{SIZE}}{{UNIT}}; top: auto !important;',
				],
				'condition' => [
					'title_pos_veri' => 'end',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .image-zoom-text',
				'separator' => 'before',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .image-zoom-text',
			]
		);
        $this->end_controls_section();
        // Text Style Tab Ends

        // Sub Title Style
        $this->start_controls_section(
            'sub_title_style',
            [
                'label' => esc_html__( 'Sub Title', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'sub_title_align',
			[
				'label' => esc_html__( 'Alignment', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
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
				],
				'default' => 'center',
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_control(
            'sub_title_clr',
            [
                'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title-wrapper' => 'color: {{VALUE}};'
                ],
				'separator' => 'after'
            ]
        );
		$this->add_control(
			'subtitle_pos_hori',
			[
				'label' => esc_html__( 'Horizontal Orientation', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'toggle' => false,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-left',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-h-align-right',
					],
				],
			]
		);
        $this->add_responsive_control(
			'subtitle_pos_x',
			[
				'label' => esc_html__( 'Offset', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 0,
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper' => 'left: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'subtitle_pos_hori!' => 'end',
				],
			]
		);
        $this->add_responsive_control(
			'subtitle_pos_x_end',
			[
				'label' => esc_html__( 'Offset', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 0,
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper' => 'right: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'subtitle_pos_hori' => 'end',
				],
			]
		);
        $this->add_control(
			'subtitle_pos_veri',
			[
				'label' => esc_html__( 'Vertical Orientation', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'toggle' => false,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Top', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-v-align-top',
					],
					'end' => [
						'title' => esc_html__( 'Bottom', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
			]
		);
        $this->add_responsive_control(
			'subtitle_pos_y',
			[
				'label' => esc_html__( 'Offset', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw' ],
				'default' => [
					'size' => 40,
					'unit' => '%'
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper' => 'top: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'subtitle_pos_veri!' => 'end',
				],
			]
		);
        $this->add_responsive_control(
			'subtitle_pos_y_end',
			[
				'label' => esc_html__( 'Offset', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw' ],
				'default' => [
					'size' => 0,
					'unit' => '%',
				],
				'selectors' => [
					'{{WRAPPER}} .section-title-wrapper' => 'bottom: {{SIZE}}{{UNIT}}; top: auto !important;',
				],
				'condition' => [
					'subtitle_pos_veri' => 'end',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sub_title_typography',
				'selector' => '{{WRAPPER}} .section-title-wrapper',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'sub_title_shadow',
				'selector' => '{{WRAPPER}} .section-title-wrapper',
			]
		);
        $this->end_controls_section();

        $this->start_controls_section(
            'zoom_video_layout',
            [
                'label' => esc_html__( 'Video Layout', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'zoom_type' => 'video',
				]
            ]
        );
		$this->add_responsive_control(
			'zoom_video_rad',
            [
                'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
                'type'  => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .zoom-video-item iframe' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .zoom-video-item video' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
		);
		$this->end_controls_section();

        // Grid Zoom Effect
        $this->start_controls_section(
            'grid_zoom',
            [
                'label' => esc_html__( 'Grid Blur Effect', 'classic-elementor-addons-pro' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'select_type' => 'grid-zoom',
                ]
            ]
        );
        $this->add_control(
            'blur_enter',
            [
                'label' => esc_html__( 'Blur Effect', 'classic-elementor-addons-pro' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'description' => esc_html__( 'Here enter the blur effect of the images. Eg: 3', 'classic-elementor-addons-pro' ),
                'condition' => [
                    'select_type' => 'grid-zoom',
                ]
            ]
        );
        $this->end_controls_section();
        
        // Image Zoom
        $this->start_controls_section(
			'zoom_img_styles',
			[
				'label'	=> esc_html__( 'Image', 'classic-elementor-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
                    'select_type' => 'image-zoom',
					'zoom_type' => 'image'
                ]
			]
		);
		$this->add_responsive_control(
			'zoom_img_rad',
			[
				'label'	=> esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors'	=> [
					'{{WRAPPER}} .image-zoom-scroll img'  =>  'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'zoom_img_br',
				'selector' => '{{WRAPPER}} .image-zoom-scroll img',
			]
		);
		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .image-zoom-scroll img',
			]
		);
		$this->end_controls_section();
		
    }

    /**
	 * Render Tab widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $select_type = isset( $settings[ 'select_type' ] ) ? $settings[ 'select_type' ] : '';
		$zoom_type = isset( $settings['zoom_type'] ) ? $settings['zoom_type'] : 'image';
        $title_text = isset( $settings['title'] ) ? $settings['title'] : '';
        $title_tag = isset( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
        $sub_title = isset( $settings['sub_title'] ) ? $settings['sub_title'] : '';
        $subtitle_tag = isset( $settings['sub_title_tag'] ) ? $settings['sub_title_tag'] : 'h6';
        $img_zoom = isset( $settings['image'] ) ? $settings['image'] : '';
        $disable_mobile = isset( $settings['zoom_disable_on_mobile'] ) && $settings['zoom_disable_on_mobile'] == 'yes' ? 'yes' : 'no';

		$zoom_array = array(
			'disable_mobile' => $disable_mobile
		);

		$zoom_array = is_array( $zoom_array ) ? htmlspecialchars( json_encode( $zoom_array ), ENT_QUOTES, 'UTF-8' ) : '';
        
        if( $select_type == 'image-zoom' && $zoom_type == 'image' ) {
            if ( $img_zoom ) {
			    $this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			    $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			    $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );
			    $this->add_render_attribute( 'image_class', 'class', 'img-fluid' );
			    $this->add_render_attribute( 'image_class', 'class', $settings['img_style'] );

			    $image_zoom = Classic_Elementor_Extension::cea_get_attachment_image_html( $settings, 'thumbnail', 'image', $this );
                ?>
                <div class="image-zoom-scroll" data-zoom="<?php echo $zoom_array; ?>">
                    <?php if ( $title_text !== '' ): ?>
                        <<?php echo $title_tag; ?> class="image-zoom-text"><?php echo $title_text; ?></<?php echo $title_tag; ?>>
                    <?php endif; ?>
                	<?php if ( $sub_title !== '' ): ?>
                        <div class="section-title-wrapper">
                            <div class="title-wrap">
                                <<?php echo $subtitle_tag; ?> class="image-zoom-sub-title">
                                    <span class="subtitle-dots"><?php echo $sub_title; ?></span>
                                </<?php echo $subtitle_tag; ?>>
                            </div>
					    </div>
					<?php endif; ?>
                    <?php echo $image_zoom; ?>
                </div>
            <?php
            }
        } else if ( $select_type == 'image-zoom' && $zoom_type == 'video' ) {
			$video_url = $settings[ $settings['zoom_video_type'] . '_url' ];
			$start_time = isset( $settings['zoom_start'] ) && !empty( $settings['zoom_start'] ) ? $settings['zoom_start'] : '';
			$autoplay = isset( $settings['video_autoplay'] ) && $settings['video_autoplay'] == 'yes' ? 1 : 0;
			$muted = isset( $settings['video_muted'] ) && $settings['video_muted'] == 'yes' ? 1 : 0;
			$controls = isset( $settings['video_controls'] ) && $settings['video_controls'] == 'yes' ? 1 : 0;
			$loop = isset( $settings['video_loop'] ) && $settings['video_loop'] == 'yes' ? 1 : 0;
			echo '<div class="cea-zoom-video" data-speed="1" data-zoom="'.$zoom_array.'">';
			echo '<div class="cea-zoom_wrapper">';
			echo '<div class="zoom-video-wrapper">';
			if ( 'zoom_youtube' == $settings['zoom_video_type'] ) {
				if ( preg_match( '/(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([^\&\?\/]+)/', $video_url, $matches ) ) {
					$video_id = $matches[1];
				} elseif ( preg_match( '/youtu\.be\/([^\&\?\/]+)/', $video_url, $matches ) ) {
					$video_id = $matches[1];
				} else {
					echo 'Invalid YouTube URL';
					return;
				}
				$embed_url = 'https://www.youtube.com/embed/' . $video_id . '?autoplay=' . $autoplay .'&mute=' . $muted . '&controls=' . $controls .'&start=' . $start_time;
				if ( $loop == 1 ) {
					$embed_url .= '&loop=1&playlist='. $video_id;
				}
				echo '<div class="zoom-video-item" style="aspect-ratio: 16/9; margin: auto;">';
    				echo '<iframe width="100%" height="100%" src="' . esc_url( $embed_url ) . '" frameborder="0" allowfullscreen></iframe>';
    			echo '</div>';
			} elseif ( 'zoom_vimeo' == $settings['zoom_video_type'] ) {
				$hide_ctrl = isset( $settings['all_video_control'] ) && $settings['all_video_control'] == 'yes' ? 0 : 1;
				if ( preg_match( '/(?:https?:\/\/)?(?:www\.)?vimeo\.com\/(\d+)/', $video_url, $matches ) ) {
					$video_id = $matches[1];
				} else {
					echo 'Invalid Vimeo URL';
					return;
				}
				$embed_url = 'https://player.vimeo.com/video/' . $video_id . '?autoplay=' . $autoplay . '&loop=' . $loop . '&muted=' . $muted .'&background=' .$hide_ctrl. '#t='. $start_time .'s';
				echo '<div class="zoom-video-item" style="aspect-ratio: 16/9; margin: auto;">';
				echo '<iframe width="100%" height="100%" src="' . esc_url( $embed_url ) . '" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>';
				echo '</div>';
			} elseif ( 'zoom_dailymotion' == $settings['zoom_video_type'] ) {
				if ( preg_match( '#dailymotion\.com/video/([a-zA-Z0-9]+)#', $video_url, $matches ) ) {
					$video_id = $matches[1];
				} elseif ( preg_match( '#dai\.ly/([a-zA-Z0-9]+)#', $video_url, $matches ) ) {
					$video_id = $matches[1];
				} else {
					echo 'Invalid Dailymotion URL';
					return;
				}
			
				$embed_url = 'https://www.dailymotion.com/embed/video/' . $video_id .'?autoplay=' . $autoplay .'&mute=' . $muted .'&controls=' . $controls .'&ui-start-screen-info='. $controls .'&ui-logo=' .$controls;
			
				echo '<div class="zoom-video-item" style="aspect-ratio: 16/9; margin: auto;">';
				echo '<iframe width="100%" height="100%" src="' . esc_url( $embed_url ) . '" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>';
				echo '</div>';
			} elseif ( 'zoom_hosted' == $settings['zoom_video_type'] ) {
				$host_url = isset( $settings['zoom_hosted_url'] ) && $settings['zoom_hosted_url']['url'] != '' ? $settings['zoom_hosted_url']['url'] : '';
				if ( ! filter_var( $host_url, FILTER_VALIDATE_URL ) ) {
					echo 'Invalid video URL';
					return;
				}
				
				echo '<div class="zoom-video-item" style="aspect-ratio: 16/9; margin: auto;">';
				echo '<video width="100%" height="100%" ' .
				    ($controls ? 'controls ' : '' ) .
					($autoplay ? 'autoplay ' : '') .
					($muted ? 'muted ' : '') .
					($loop ? 'loop ' : '') .
					'playsinline>';
				echo '<source src="' . esc_url( $host_url ) . '" type="video/mp4">';
				echo 'Your browser does not support the video tag.';
				echo '</video>';
				echo '</div>';
			}
			echo '</div>';
			echo '</div>';
			echo '</div>';
		} elseif( $select_type == 'grid-zoom' && isset( $settings['image_grid'] ) ) {
            $blur_effect = $settings['blur_enter'];
            $blur_effect = ( isset( $blur_effect ) && $blur_effect != '' ) ? $blur_effect : 0;
            echo'<div zoom_grid_container class="img-grid-container" data-blur="' . $blur_effect . '">';
            foreach( $settings['image_grid'] as $img ) {
                $item_url = $img['image_item']['url'];
                echo '<div zoom_grid_item class="zoom-grid-item elementor-repeater-item-' . $img['_id'] . '">';
                echo '<img class="img-grid-item" src="' . $item_url . '" >';
                echo '</div>';
            }
            if ( $title_text !== '' ):
                echo '<'.$title_tag.' class="image-zoom-text">'.$title_text.'</'.$title_tag.'>';
            endif;
			if ( $sub_title !== '' ):
			    echo '<div class="section-title-wrapper"><div class="title-wrap">';
				echo '<'.$subtitle_tag.' class="image-zoom-sub-title sub-title">';
				echo '<span class="subtitle-dots">'.$sub_title.'</span></'.$subtitle_tag.'>';
				echo '</div></div>';
			endif;
            echo '</div>';
        }
    }

}