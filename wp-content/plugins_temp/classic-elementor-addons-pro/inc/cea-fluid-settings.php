<?php

defined('ABSPATH') || exit;

use Elementor\{
    Controls_Manager,
    Control_Media,
    Utils,
    Icons_Manager,
    Group_Control_Image_Size
};

if (!class_exists('CEA_Canvas_Fluid')) {
    /**
     * CEA Elementor Fluid Settings
     *
     *
     * @package classic-elementor-addons-pro\inc
     * @author zozothemes <abileweb14@gmail.com>
     * @since 1.0.0
     * @version 1.0.0
     */
    class CEA_Canvas_Fluid
    {
        private static $instance;

        /**
         * @var CEA_Canvas_Fluid
         */
        private $canvas_switcher;
        private $color_settings;
        private $color_idle;
        private $resolution;
        private $velocity;
        private $density;
        private $pressure;
        private $splat_radius;
        private $backspace_animation;
        private $dark_mode;
        private $dir_path;
        private $opacity;
        private $fluid_animation;

        /**
         * Creates and returns an instance of the class
         *
         * @return object
         */
        public static function get_instance()
        {
            if (is_null(self::$instance)) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        public function __construct()
        {
            $this->dir_path = plugin_dir_path(__FILE__);
            
            // Add CEA Fluid Animation
            add_action('elementor/element/wp-page/document_settings/after_section_end', [$this, 'inject_options_page'], 10, 1);
            add_action('elementor/element/wp-post/document_settings/after_section_end', [$this, 'inject_options_page'], 10, 1);
            add_action('elementor/editor/before_enqueue_scripts', [$this, 'cea_fluid_enqueue_scripts'], 10, 3);
            add_action('elementor/frontend/before_enqueue_scripts', [$this, 'cea_fluid_enqueue_scripts']);
        }

        public function init_variable()
        {
            $page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers('page');
            $page_settings_model = $page_settings_manager->get_model(get_the_ID());
            $this->fluid_animation = $page_settings_model->get_settings('cea_fluid_apply');

            if ('yes' === $this->fluid_animation) {
                $this->color_settings = $page_settings_model->get_settings('fluid_color_type');
                $this->opacity = $page_settings_model->get_settings('fluid_opacity')['size'] ?? 1;
                $this->color_idle = $page_settings_model->get_settings('fluid_color_idle');
                $this->resolution = $page_settings_model->get_settings('fluid_resolution');
                $this->velocity = $page_settings_model->get_settings('fluid_velocity')['size'];
                $this->density = $page_settings_model->get_settings('fluid_density')['size'];
                $this->pressure = $page_settings_model->get_settings('fluid_pressure')['size'];
                $this->splat_radius = $page_settings_model->get_settings('fluid_splat_radius')['size'];
                $this->backspace_animation = $page_settings_model->get_settings('fluid_backspace');
                $this->canvas_switcher = $page_settings_model->get_settings('fluid_frontend_switch');
                $this->dark_mode = $page_settings_model->get_settings('fluid_dark_mode');
            }
        }

        public function cea_fluid_enqueue_scripts()
        {
            $this->init_variable();
            
            if ('yes' === $this->fluid_animation) {
                
                wp_enqueue_style('cea-fluid-style');
                wp_enqueue_script('cea-fluid-script', CEA_CORE_URL . 'assets/js/cea-fluid-script.js', array( 'jquery' ), '1.0', true);
                wp_localize_script('cea-fluid-script', 'cea_fluid_settings', [
                    'color_type' => esc_attr($this->color_settings),
                    'color' => esc_attr($this->color_idle),
                    'resolution' => esc_attr($this->resolution),
                    'velocity' => esc_attr($this->velocity),
                    'density' => esc_attr($this->density),
                    'pressure' => esc_attr($this->pressure),
                    'splat_radius' => esc_attr($this->splat_radius),
                    'backspace_animation' => esc_attr($this->backspace_animation),
                ]);
            
            }

        }

        public function inject_options_page($document)
        {

            $document->start_controls_section(
                'body_fluid_options',
                [
                    'label' => esc_html__('CEA Fluid Animation', 'classic-elementor-addons-pro'),
                    'tab' => Controls_Manager::TAB_SETTINGS
                ]
            );

            $document->add_control(
                'cea_fluid_apply',
                [
                    'label' => esc_html__('Use Fluid Animation?', 'classic-elementor-addons-pro'),
                    'description' => esc_html__( 'Select "on" to apply Fluid Animation', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no'
                ]
            );

            // NOTICE
            $document->add_control(
                'fluid_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                    'condition' => [
                        'cea_fluid_apply' => 'yes'
                    ],
                    'raw' => esc_html__('If the animation is just turned on, click the "Update" button and reload the page to make it visible in the editor, and go to further customization of the one.', 'classic-elementor-addons-pro'),
                ]
            );

            $document->add_control(
                'fluid_color_type',
                [
                    'label' => esc_html__('Color', 'classic-elementor-addons-pro'),
                    'description' => esc_html__( 'Here you can select the color options', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'condition' => [
                        'cea_fluid_apply' => 'yes'
                    ],
                    'options' => [
                        'random' => esc_html__('Random', 'classic-elementor-addons-pro'),
                        'simple' => esc_html__('Simple Color', 'classic-elementor-addons-pro'),
                    ],
                    'default' => 'random',
                ]
            );

            $document->add_control(
                'fluid_color_idle',
                [
                    'label' => esc_html__('Color Animation', 'classic-elementor-addons-pro'),
                    'description' => esc_html__( 'Here you can enter the color of Fluid Animation', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::COLOR,
			        'dynamic' => [  
                        'active' => true
                    ],
                    'alpha' => false,
                    'condition' => [
                        'cea_fluid_apply' => 'yes',
                        'fluid_color_type' => 'simple',
                    ],
                ]
            );

            $document->add_control(
                'fluid_opacity',
                [
                    'label' => esc_html__('Opacity', 'classic-elementor-addons-pro'),
                    'description' => esc_html__( 'Here you can place the Opacity of the Fluid Animation.', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SLIDER,
			        'dynamic' => [  
                        'active' => true
                    ],
                    'condition' => [
                        'cea_fluid_apply' => 'yes',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0, 
                            'max' => 1, 
                            'step' => 0.01
                        ],
                    ],
                    'default' => [
                        'size' => 1, 
                        'unit' => 'px'
                    ],
                    'selectors' => [
                        '.cea-canvas-outer' => 'opacity: {{SIZE}};',
                    ],
                ]
            );

            $document->add_control(
                'fluid_resolution',
                [
                    'label' => esc_html__('Sim Resolution', 'classic-elementor-addons-pro'),
                    'description' => esc_html__( 'Fluid simulation resolution for velocity fields.', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SELECT,
                    'condition' => [
                        'cea_fluid_apply' => 'yes',
                    ],
                    'options' => [
                        '256' => esc_html__('256', 'classic-elementor-addons-pro'),
                        '128' => esc_html__('128', 'classic-elementor-addons-pro'),
                        '64' => esc_html__('64', 'classic-elementor-addons-pro'),
                        '32' => esc_html__('32', 'classic-elementor-addons-pro'),
                    ],
                    'default' => '128',
                ]
            );

            $document->add_control(
                'fluid_density',
                [
                    'label' => esc_html__('Density Diffusion', 'classic-elementor-addons-pro'),
                    'description' =>  esc_html__( 'Rate at which color/density diffusion over time.', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SLIDER,
			        'dynamic' => [  
                        'active' => true
                    ],
                    'condition' => [
                        'cea_fluid_apply' => 'yes',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0.01, 
                            'max' => 4, 
                            'step' => 0.01
                        ],
                    ],
                    'default' => [
                        'size' => .97
                    ],
                ]
            );

            $document->add_control(
                'fluid_velocity',
                [
                    'label' => esc_html__('Velocity Diffusion', 'classic-elementor-addons-pro'),
                    'description' =>  esc_html__( 'Rate at which velocity dissipates over time.', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SLIDER,
			        'dynamic' => [  
                        'active' => true
                    ],
                    'condition' => [
                        'cea_fluid_apply' => 'yes',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0.01, 
                            'max' => 4, 
                            'step' => 0.01
                        ],
                    ],
                    'default' => [
                        'size' => .98
                    ],
                ]
            );

            $document->add_control(
                'fluid_pressure',
                [
                    'label' => esc_html__('Pressure', 'classic-elementor-addons-pro'),
                    'description' =>  esc_html__( 'Base Pressure of the Fluid Animation.', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SLIDER,
			        'dynamic' => [  
                        'active' => true
                    ],
                    'condition' => [
                        'cea_fluid_apply' => 'yes',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0.01, 
                            'max' => 1, 
                            'step' => 0.01
                        ],
                    ],
                    'default' => [
                        'size' => .8
                    ],
                ]
            );

            $document->add_control(
                'fluid_splat_radius',
                [
                    'label' => esc_html__('Splat Radius', 'classic-elementor-addons-pro'),
                    'description' => esc_html__( 'Radius of the "splat" effect when user interacts.', 'classic-elementor-addons-pro' ),
                    'type' => Controls_Manager::SLIDER,
			        'dynamic' => [  
                        'active' => true
                    ],
                    'condition' => [
                        'cea_fluid_apply' => 'yes',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0.01, 
                            'max' => 1, 
                            'step' => 0.01
                        ],
                    ],
                    'default' => [
                        'size' => .01
                    ],
                ]
            );

            $document->add_control(
                'fluid_backspace',
                [
                    'label' => esc_html__('Keys press sensitivity', 'classic-elementor-addons-pro'),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => [
                        'cea_fluid_apply' => 'yes',
                    ],
                    'default' => 'yes',
                    'description' => esc_html__('P - pause. Space - extra diffusion', 'classic-elementor-addons-pro'),
                ]
            );

            $document->add_control(
                'fluid_dark_mode',
                [
                    'label' => esc_html__('Dark Mode', 'classic-elementor-addons-pro'),
                    'type' => Controls_Manager::SWITCHER,
                    'condition' => [
                        'fluid_frontend_switch' => 'yes',
                    ],
                    'label_on' => esc_html__('On', 'classic-elementor-addons-pro'),
                    'label_off' => esc_html__('Off', 'classic-elementor-addons-pro'),
                ]
            );

            $document->end_controls_section();
        }
    }
}

if (!function_exists('cea_elementor_fluid')) {
    function cea_elementor_fluid()
    {
        return CEA_Canvas_Fluid::get_instance();
    }

    cea_elementor_fluid();
}
