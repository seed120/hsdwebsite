<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use ElementorPro\Base\Base_Widget;
use ElementorPro\Plugin;
use ElementorPro\Modules\Slides\Controls\Control_Slides_Animation;

/**
 * Classic Elementor Addon Slider Widget
 *
 * @since 1.0.0
 */
class CEA_Elementor_Slider_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Slider Widget widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceasliderwidget";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Slider Widget widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Slider Widget", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Slider Widget widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-gallery";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Slider widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'slider', 'animation', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Slider Widget widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ "classic-elements" ]; 
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
		return [ 'tilt', 'magnific-popup', 'owl-carousel', 'cea-custom-front' ];
	}
	
	public function get_style_depends() {
		return [ 'magnific-popup', 'owl-carousel', 'animate-style' ];
	}
	
	/**
	 * Register Slider Widget widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//Image Section
		$this->start_controls_section(
			"image_section",
			[
				"label"	=> esc_html__( "Image", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Image options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'slides_repeater' );
		$repeater->start_controls_tab(
			'general',
			[
				'label' => esc_html__( 'General', 'elementor-pro' ),
			]
		);
		$repeater->add_control(
			'slide_img_label',
			[
				'type'	=> \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( '* Background', 'elementor-pro' ),
			]
		);
		$repeater->add_control(
			"slide_img",
			[
				"type" => \Elementor\Controls_Manager::MEDIA,
				"label" => __( "Background Image", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose Slider image.", 'classic-elementor-addons-pro' ),
				"dynamic" => [
					"active" => true,
				],
				"default" => [
					"url" => \Elementor\Utils::get_placeholder_image_src(),
				]
			]
		);
		$repeater->add_control(
			"slide_style_option",
			[
				"type"		 => \Elementor\Controls_Manager::SELECT,
				"label"		 => __( 'Edit Background', 'classic-elementor-addons-pro' ),
				"description"=> esc_html__( 'Enable to see background Options', 'classic-elementor-addons-pro'),
				"options"		=> [
					'yes'  => esc_html__( 'Yes', 'classic-elementor-addons-pro' ),
					'no'  => esc_html__( 'No', 'classic-elementor-addons-pro' ),
				],
				"default"		=> 'no',
			]
		);
		$repeater->add_responsive_control(
			"slide_image_index",
			[
				"type"	=> \Elementor\Controls_Manager::NUMBER,
				"label"	=> __( "Slide Image Z-index", 'classic-elementor-addons-pro' ),
				"description" => esc_html__( "Set z-index value for your slider image.", 'classic-elementor-addons-pro' ),
				"default"	=> '',
				"condition"		=> [
					'slide_style_option!'  => 'no',
				],
				"selectors" => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-image" => "z-index: {{VALUE}};",
				]
			]
		);
		$repeater->add_control(
			'slide_heading_label',
			[
				'type'	=> \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( ' * Title', 'elementor-pro' ),
			]
		);
		$repeater->add_control(
			'slide_prefix_heading',
			[
				'type'		  	=> \Elementor\Controls_Manager::TEXT,
				'description'	=> esc_html__( 'Leave this empty if you not need need this', 'classic-elementor-addons-pro' ),
				'label'			=> esc_html__( 'Prefix Title', 'classic-elementor-addons-pro' ),
				'default'       => '',
			]
		);
		$repeater->add_control(
			'slide_prefix_heading_color',
			[
				"type"        => Controls_Manager::COLOR,
				"label"       => esc_html__("Prefix Title Color", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Here you can put the prefix title color.", 'classic-elementor-addons-pro'),
				"default"     => "#ffffff",
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-content .slider-prefix-title" => "color: {{VALUE}};",
				]
			]
		);
		$repeater->add_control(
			"slide_prefix_heading_animation",
			[
				"type"        => \Elementor\Controls_Manager::SELECT,
				"label"       => esc_html__("Prefix title Animation", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Choose an animation for the prefix heading.", 'classic-elementor-addons-pro'),
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
			]
		);
		$repeater->add_control(
			"slide_prefix_animation_delay",
			[
				"type"        => \Elementor\Controls_Manager::NUMBER,
				"label"       => esc_html__("Animation Delay (ms)", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Set the animation delay in milliseconds.", 'classic-elementor-addons-pro'),
				"default"     => 300,
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-content .slider-prefix-title" => "animation-delay: {{VALUE}}ms;",
				]
			]
		);
		$repeater->add_control(
			"slide_heading",
			[
				"type"			=> \Elementor\Controls_Manager::TEXTAREA,
				"label" 		=> esc_html__( "Slide Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Slide Image title.", 'classic-elementor-addons-pro' ),
				"default"		=> "Slider Heading"
			]
		);
		$repeater->add_control(
			"slide_heading_color",
			[
				"type"        => Controls_Manager::COLOR,
				"label"       => esc_html__("Slide Title Color", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Here you can put the title color.", 'classic-elementor-addons-pro'),
				"default"     => "#ffffff",
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-content .slider-title" => "color: {{VALUE}};",
				]

			]
		);
		$repeater->add_control(
			"slide_heading_animation",
			[
				"type"        => \Elementor\Controls_Manager::SELECT,
				"label"       => esc_html__("Heading Animation", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Choose an animation for the heading.", 'classic-elementor-addons-pro'),
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
			]
		);
		$repeater->add_control(
			"slide_heading_animation_delay",
			[
				"type"        => \Elementor\Controls_Manager::NUMBER,
				"label"       => esc_html__("Animation Delay (ms)", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Set the animation delay in milliseconds.", 'classic-elementor-addons-pro'),
				"default"     => 300,
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-content .slider-title" => "animation-delay: {{VALUE}}ms;",
				]
			]
		);
		$repeater->add_control(
			'slide_content_label',
			[
				'type'	=> \Elementor\Controls_Manager::HEADING,
				'label' => esc_html__( 'Content', 'elementor-pro' ),
			]
		);
		$repeater->add_control(
			"slide_content",
			[
				"type"			=> \Elementor\Controls_Manager::TEXTAREA,
				"label" 		=> esc_html__( "Slide Content", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Image Slider Content.", 'classic-elementor-addons-pro' ),
				"default"		=> "Slider Content"
			]
		);
		$repeater->add_control(
			"slide_content_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Slide Content Color", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can add content color.", 'classic-elementor-addons-pro' ),
				"default"   	=> "#ffffff",
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-content .slider-description" => "color: {{VALUE}};",
				]
			]
		);
		$repeater->add_control(
			"slide_content_animation",
			[
				"type"        => \Elementor\Controls_Manager::SELECT,
				"label"       => esc_html__("Content Animation", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Choose an animation for the Content.", 'classic-elementor-addons-pro'),
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
		$repeater->add_control(
			"slide_content_animation_delay",
			[
				"type"        => \Elementor\Controls_Manager::NUMBER,
				"label"       => esc_html__("Animation Delay (ms)", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Set the animation delay in milliseconds.", 'classic-elementor-addons-pro'),
				"default"     => 300,
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-content .slider-description" => "animation-delay: {{VALUE}}ms;",
				]
			]
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'button_content',
			[
				'label' => esc_html__( 'Button' , 'classic-elementor-addons-pro' ),
			]
		);
		$repeater->add_control(
			"slide_button",
			[
				"type"			=> \Elementor\Controls_Manager::TEXT,
				"label"		 	=> esc_html__( "Button I", 'classic-elementor-addons-pro'),
				"description"	=> esc_html__( "Slide Button Name.", 'classic-elementor-addons-pro' )
			]
		);	
		$repeater->add_control(
			'button_link',
			[
				'label' => esc_html__( 'Link', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'classic-elementor-addons-pro' ),
				'default' => [
					'url' => '#',
				],
			]
		);	
		$repeater->add_control(
			"slide_button_animation",
			[
				"type"        => \Elementor\Controls_Manager::SELECT,
				"label"       => esc_html__("Button I Animation", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Choose an animation for the Button.", 'classic-elementor-addons-pro'),
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
			]
		);
		$repeater->add_control(
			"slide_button_animation_delay",
			[
				"type"        => \Elementor\Controls_Manager::NUMBER,
				"label"       => esc_html__("Animation Delay (ms)", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Set the animation delay in milliseconds.", 'classic-elementor-addons-pro'),
				"default"     => 300,
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-content .slider-button" => "animation-delay: {{VALUE}}ms",
				],
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
		$repeater->add_control(
			"slide_enable_buttons",
			[
				"type"			=> \Elementor\Controls_Manager::SELECT,
				"label"			=> esc_html__( "Enable Another Button ?", 'classic-elementor-addons-pro' ),
				"options"		=> [
					'yes'  => esc_html__( 'Yes', 'classic-elementor-addons-pro' ),
					'no'  => esc_html__( 'No', 'classic-elementor-addons-pro' ),
				],
				"default"		=> 'no',
			]
		);
		$repeater->add_control(
			"slide_button_2",
			[
				"type"			=> \Elementor\Controls_Manager::TEXT,
				"label"		 	=> esc_html__( "Button II", 'classic-elementor-addons-pro'),
				"description"	=> esc_html__( "Slide Button Name.", 'classic-elementor-addons-pro' ),
				"condition"		=> [
					'slide_enable_buttons!'  => 'no',
				]
			]
		);
		$repeater->add_control(
			'button_link_2',
			[
				'label' => esc_html__( 'Link', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'classic-elementor-addons-pro' ),
				'default' => [
					'url' => '#',
				],
				"condition"		=> [
					'slide_enable_buttons!'  => 'no',
				]
			]
		);
		$repeater->add_control(
			"slide_button_2_animation",
			[
				"type"        => \Elementor\Controls_Manager::SELECT,
				"label"       => esc_html__("Button II Animation", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Choose an animation for the Button 2.", 'classic-elementor-addons-pro'),
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
				"condition"		=> [
					'slide_enable_buttons!'  => 'no',
				]
			]
		);
		$repeater->add_control(
			"slide_button_2_animation_delay",
			[
				"type"        => \Elementor\Controls_Manager::NUMBER,
				"label"       => esc_html__("Animation Delay (ms)", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Set the animation delay in milliseconds.", 'classic-elementor-addons-pro'),
				"default"     => 300,
				"condition"		=> [
					'slide_enable_buttons!'  => 'no',
				],
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-content .slider-button-2" => "animation-delay: {{VALUE}}ms",
				],
			]
		);
		$repeater->add_control(
			'button_icon_2',
			[
				'label' => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				"condition"		=> [
					'slide_enable_buttons!'  => 'no',
				]
			]
		);
		$repeater->add_control(
			'button_icon_align_2',
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
					'slide_enable_buttons!'  => 'no',
				],
			]
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'foreground',
			[
				'label' => esc_html__( 'Foreground', 'elementor-pro' ),
			]
		);
		foreach ( range( 1,3 ) as $index ) {
			$repeater->add_control(
				'foreground_image_' . $index . '_accordion',
				[
					'label' => __( 'Foreground Image ' . $index, 'classic-elementor-addons-pro' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);
			$repeater->add_control(
				'foreground_image_' . $index,
				[
					'type' => \Elementor\Controls_Manager::MEDIA,
					'label' => __( 'Slider Foreground Image ' . $index, 'classic-elementor-addons-pro' ),
					'description' => esc_html__( 'Choose Slider Foreground image.', 'classic-elementor-addons-pro' ),
					'dynamic' => [
						'active' => true,
					],
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
			$repeater->add_responsive_control(
				'foreground_image' . $index . '_width',
				[
					'label' => esc_html__( 'Image Size', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ '%' ],
					'range' => [
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 50,
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_' . $index => 'width: {{SIZE}}%; max-width: {{SIZE}}%;',
					],
				]
			);
			$repeater->add_responsive_control(
				"foreground_image" . $index . "_position",
				[
					"label"       => esc_html__(" Foreground image " . $index . " Position", 'classic-elementor-addons-pro'),
					"description" => esc_html__("Specify custom navigation position in percentages (top, left).", 'classic-elementor-addons-pro'),
					"type"        => Controls_Manager::DIMENSIONS,
					"selectors"   => [
						"{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_" . $index => "top: {{TOP}}%; left: {{LEFT}}%; right: {{RIGHT}}%; bottom: {{BOTTOM}}%;",
					],
				]
			);
			$repeater->add_control(
				"slide_fore_" . $index . "_index",
				[
					"type" => \Elementor\Controls_Manager::NUMBER,
					"label" => __( "Z-index", 'classic-elementor-addons-pro' ),
					"description" => esc_html__( "Set z-index value for your slider Foreground image " . $index . ".", 'classic-elementor-addons-pro' ),
					"default" => '',
					"selectors"   => [
						"{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_" . $index => "z-index: {{VALUE}};",
					],
				]
			);
			$repeater->add_responsive_control(
				"foreground_image_". $index ."_transform",
				[
					'type' => \Elementor\Controls_Manager::TEXT,
					'label' => __( 'Transform', 'classic-elementor-addons-pro' ),
					'description' => __( 'Set the foreground image transform. eg: rotate(13deg)', 'classic-elementor-addons-pro' ),
					'default' => '',
					"selectors"   => [
						"{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_" . $index => "transform: {{VALUE}};",
					],
				]
			);
			$repeater->add_control(
				'foreground_image_' . $index . '_visibility',
				[
					'label' => esc_html__('Visibility', 'classic-elementor-addons-pro'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple'	 	=> true,
					'options' => [
						'' => esc_html__('Default', 'classic-elementor-addons-pro'),
						'hidden-desktop' => esc_html__('Hide on Desktop', 'classic-elementor-addons-pro'),
						'hidden-tablet' => esc_html__('Hide on Tablet', 'classic-elementor-addons-pro'),
						'hidden-mobile' => esc_html__('Hide on Mobile Portrait', 'classic-elementor-addons-pro'),
					],
					'default' => '',
				]
			);
			$repeater->add_control(
				"slide_foreground_image" . $index . "_animation",
				[
					"type"        => \Elementor\Controls_Manager::SELECT,
					"label"       => esc_html__("Animation", 'classic-elementor-addons-pro'),
					"description" => esc_html__("Choose an animation for the Foreground Image " . $index . ".", 'classic-elementor-addons-pro'),
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
			$repeater->add_control(
				"slide_foreground_image" . $index . "_animation_delay",
				[
					"type"        => \Elementor\Controls_Manager::NUMBER,
					"label"       => esc_html__("Animation Delay (ms)", 'classic-elementor-addons-pro'),
					"description" => esc_html__("Set the animation delay in milliseconds for foreground Image " . $index . ".", 'classic-elementor-addons-pro'),
					"default"     => 300,
					"selectors"   => [
						"{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_" . $index => "animation-delay: {{VALUE}}ms;",
					],
				]
			);
			$repeater->add_control(
			'slide_float_image' . $index . '_animation',
				[
					'type'  		=> \Elementor\Controls_Manager::SELECT,
					'label' 		=> esc_html__( 'Float Animation?', 'classic-elementor-addons-pro' ),
					'options'		=> [
						'none' 				=> esc_html__( 'None', 'classic-elementor-addons-pro' ),
						'float-vertical'	=> esc_html__( 'Vertical Float', 'classic-elementor-addons-pro' ),
						'float-horizontal'  => esc_html__( 'Horizontal Float', 'classic-elementor-addons-pro' ), 
					],
					'default' 		=> 'none',
				]
			);
			$repeater->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'slide_foreground_image' . $index . '_box_shadow',
					'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_' . $index,
				]
			);
			$repeater->add_control(
				'hr' . $index,
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);
		}
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'add_more',
			[
				'label' => esc_html__( 'Add more' , 'classic-elementor-addons-pro' ),
			]
		);
		foreach (range(4, 5) as $index) {
			$repeater->add_control(
				'foreground_image_' . $index . '_accordion',
				[
					'label' => __( 'Foreground Image ' . $index, 'classic-elementor-addons-pro' ),
					'type' => \Elementor\Controls_Manager::HEADING,
				]
			);
			$repeater->add_control(
				'foreground_image_' . $index,
				[
					'type' => \Elementor\Controls_Manager::MEDIA,
					'label' => __( 'Slider Foreground Image ' . $index, 'classic-elementor-addons-pro' ),
					'description' => esc_html__( 'Choose Slider Foreground image.', 'classic-elementor-addons-pro' ),
					'dynamic' => [
						'active' => true,
					],
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);
			$repeater->add_responsive_control(
				'foreground_image' . $index . '_width',
				[
					'label' => esc_html__( 'Image Size', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ '%' ],
					'range' => [
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'default' => [
						'unit' => '%',
						'size' => 50,
					],
					'selectors' => [
						'{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_' . $index => 'width: {{SIZE}}%; max-width: {{SIZE}}%;',
					],
				]
			);
			$repeater->add_responsive_control(
				"foreground_image" . $index . "_position",
				[
					"label"       => esc_html__(" Foreground image " . $index . " Position", 'classic-elementor-addons-pro'),
					"description" => esc_html__("Specify custom navigation position in percentages (top, left).", 'classic-elementor-addons-pro'),
					"type"        => Controls_Manager::DIMENSIONS,
					"selectors"   => [
						"{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_" . $index => "top: {{TOP}}%; left: {{LEFT}}%; right: {{RIGHT}}%; bottom: {{BOTTOM}}%;",
					],
				]
			);
			$repeater->add_control(
				"slide_fore_" . $index . "_index",
				[
					"type" => \Elementor\Controls_Manager::NUMBER,
					"label" => __( "Z-index", 'classic-elementor-addons-pro' ),
					"description" => esc_html__( "Set z-index value for your slider Foreground image " . $index . ".", 'classic-elementor-addons-pro' ),
					"default" => '',
					"selectors"   => [
						"{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_" . $index => "z-index: {{VALUE}};",
					],
				]
			);
			$repeater->add_responsive_control(
				"foreground_image_". $index ."_transform",
				[
					'type' => \Elementor\Controls_Manager::TEXT,
					'label' => __( 'Transform', 'classic-elementor-addons-pro' ),
					'description' => __( 'Set the foreground image transform. eg: rotate(13deg)', 'classic-elementor-addons-pro' ),
					'default' => '',
					"selectors"   => [
						"{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_" . $index => "transform: {{VALUE}};",
					],
				]
			);
			$repeater->add_control(
				'foreground_image_' . $index . '_visibility',
				[
					'label' => esc_html__('Visibility', 'classic-elementor-addons-pro'),
					'type' => \Elementor\Controls_Manager::SELECT,
					'multiple'	 	=> true,
					'options' => [
						'' => esc_html__('Default', 'classic-elementor-addons-pro'),
						'hidden-desktop' => esc_html__('Hide on Desktop', 'classic-elementor-addons-pro'),
						'hidden-tablet' => esc_html__('Hide on Tablet', 'classic-elementor-addons-pro'),
						'hidden-mobile' => esc_html__('Hide on Mobile Portrait', 'classic-elementor-addons-pro'),
					],
					'default' => '',
				]
			);
			$repeater->add_control(
				"slide_foreground_image" . $index . "_animation",
				[
					"type"        => \Elementor\Controls_Manager::SELECT,
					"label"       => esc_html__("Animation", 'classic-elementor-addons-pro'),
					"description" => esc_html__("Choose an animation for the Foreground Image " . $index . ".", 'classic-elementor-addons-pro'),
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
			$repeater->add_control(
				"slide_foreground_image" . $index . "_animation_delay",
				[
					"type"        => \Elementor\Controls_Manager::NUMBER,
					"label"       => esc_html__("Animation Delay (ms)", 'classic-elementor-addons-pro'),
					"description" => esc_html__("Set the animation delay in milliseconds for foreground Image " . $index . ".", 'classic-elementor-addons-pro'),
					"default"     => 300,
					"selectors"   => [
						"{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_" . $index => "animation-delay: {{VALUE}}ms;",
					],
				]
			);
			$repeater->add_control(
			'slide_float_image' . $index . '_animation',
				[
					'type'  		=> \Elementor\Controls_Manager::SELECT,
					'label' 		=> esc_html__( 'Float Animation?', 'classic-elementor-addons-pro' ),
					'options'		=> [
						'none' 				=> esc_html__( 'None', 'classic-elementor-addons-pro' ),
						'float-vertical'	=> esc_html__( 'Vertical Float', 'classic-elementor-addons-pro' ),
						'float-horizontal'  => esc_html__( 'Horizontal Float', 'classic-elementor-addons-pro' ), 
					],
					'default' 		=> 'none',
				]
			);
			$repeater->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'slide_foreground_image' . $index . '_box_shadow',
					'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .slider-foreground-image_' . $index ,
				]
			);
			$repeater->add_control(
				'hr' . $index,
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);
		}
		$repeater->end_controls_tab();
		$this->add_control(
			"slider_slide",
			[
				"type"			=> \Elementor\Controls_Manager::REPEATER,
				"label"			=> esc_html__( "Slider Details", 'classic-elementor-addons-pro' ),
				"fields"		=> $repeater->get_controls(),
				"default" 		=> [
					[
						"slide_heading" 		=> esc_html__( "Slider", 'classic-elementor-addons-pro' ),
						"slide_img" 			=> "",
					]
				],
				"slide_title_field"	=> "{{{ slide_heading }}}"
			]
		);
		$this->end_controls_section();	
		
		//Slide Section
		$this->start_controls_section(
			"slide_section",
			[
				"label"			=> esc_html__( "Slide", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Blog slide options here available.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"slide_opt",
			[
				"label" 		=> esc_html__( "Slide Option", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slider option.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			"slide_height",
			[
				'label'			=> esc_html__( 'Slider Height', 'classic-elementor-addons-pro' ),
				'type'			=> Controls_Manager::NUMBER,
				'description'	=> esc_html__( "Choose Height of the Slider", 'classic-elementor-addons-pro' ),
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slider-item'=> "height: {{SIZE}}px;",
				],
			]
		);
		$this->add_control(
			"slide_animate_in",
			[
				"label"			=> esc_html__( "Animate In", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
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
			]
		);
		$this->add_control(
			"slide_item",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Slide Items", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slide items shown on large devices.", 'classic-elementor-addons-pro' ),
				"default" 		=> "2",
			]
		);
		$this->add_control(
			"slide_item_tab",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items on Tab", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slide items shown on tab.", 'classic-elementor-addons-pro' ),
				"default" 		=> "2",
			]
		);
		$this->add_control(
			"slide_item_mobile",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items on Mobile", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slide items shown on mobile.", 'classic-elementor-addons-pro' ),
				"default" 		=> "1",
			]
		);
		$this->add_control(
			"slide_item_autoplay",
			[
				"label" 		=> esc_html__( "Auto Play", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slider auto play.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_item_loop",
			[
				"label" 		=> esc_html__( "Loop", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slider loop.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_center",
			[
				"label" 		=> esc_html__( "Items Center", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slider center, for this option must active loop and minimum items 2.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_nav",
			[
				"label" 		=> esc_html__( "Navigation", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slider navigation.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_dots",
			[
				"label" 		=> esc_html__( "Pagination", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for slider pagination.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_lazyload",
			[
				"label"			=> esc_html__( "LazyLoad options", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for slider loaded on lazyload.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_rewind",
			[
				"label"			=> esc_html__( "Rewind", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Go backwards when the boundary has reached.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_mousedrag",
			[
				"label"			=> esc_html__( "Mouse drag", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This option is for enabling mouse drag.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"slide_margin",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Margin", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slider margin space.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
			]
		);
		$this->add_control(
			"slide_duration",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Duration", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slider duration.", 'classic-elementor-addons-pro' ),
				"default" 		=> "5000",
			]
		);
		$this->add_control(
			"slide_smart_speed",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Smart Speed", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slider smart speed.", 'classic-elementor-addons-pro' ),
				"default" 		=> "250",
			]
		);
		$this->add_control(
			"slide_slideby",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Items Slideby", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for blog slider scroll by.", 'classic-elementor-addons-pro' ),
				"default" 		=> "1",
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label' 		=> esc_html__( 'Pause on Hover', 'classic-elementor-addons-pro' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Yes', 'classic-elementor-addons-pro' ),
				'label_off' 	=> esc_html__( 'No', 'classic-elementor-addons-pro' ),
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'nav_enable_icon_text',
			[
				"type"		 => \Elementor\Controls_Manager::SELECT,
				'label'		=> esc_html__( 'Choose Icon or Text for Navigation', 'classic-elementor-addons-pro' ),
				"description"=> esc_html__( 'Enable to add Icon or Text to your navigation next and prev button', 'classic-elementor-addons-pro'),
				"default"	 => 'nav-icon',
				"options"		=> [
					'nav-icon'  => esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
					'nav-text'  => esc_html__( 'Text', 'classic-elementor-addons-pro' ),
				],
				"default"		=> 'no',
				'condition' => [
					'slide_nav!' => 'no',
				],
			]
		);
		$this->add_control(
			'nav_prev_text',
			[
				'label' => esc_html__( 'Previous Text', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default'	=> 'PREV',
				'condition' => [
					'slide_nav!' => 'no',
					'nav_enable_icon_text!'	=> 'nav-icon'
				],
			]
		);
		$this->add_control(
			'nav_next_text',
			[
				'label' => esc_html__( 'Next Text', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'NEXT',
				'condition' => [
					'slide_nav!' => 'no',
					'nav_enable_icon_text!'	=> 'nav-icon'
				],
			]
		);
		$this->add_control(
			'nav_prev_icon',
			[
				'label' => esc_html__( 'Previous Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-left',
					'library' => 'solid',
				],
				'condition' => [
					'slide_nav!' => 'no',
					'nav_enable_icon_text!'	=> 'nav-text'
				],
			]
		);
		$this->add_control(
			'nav_next_icon',
			[
				'label' => esc_html__( 'Next Icon', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-chevron-right',
					'library' => 'solid',
				],
				'condition' => [
					'slide_nav!' => 'no',
					'nav_enable_icon_text!'	=> 'nav-text'
				],
			]
		);
		$this->end_controls_section();
		
		// Style Image Section
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slider-widget-wrapper' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'outer_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slider-widget-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'outer_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slider-widget-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'slide_image_opacity',
			[
				'label' => esc_html__( 'Opacity', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slider-widget-wrapper .slider-image' => 'opacity: calc( {{SIZE}} / 10 );'
				]
			]
		);
		$this->end_controls_section();
		
		// Style Prefix Title Section
		$this->start_controls_section(
			'prefix_style_title',
			[
				'label' => __( 'Prefix Title', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'prefix_heading_typography',
				'label'     => esc_html__('Title Typography', 'classic-elementor-addons-pro'),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .slider-prefix-title',
			]
		);
		$this->add_responsive_control(
			"prefix_heading_position",
			[
				"label"       => esc_html__("Position", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Specify custom navigation position in percentages (top, left).", 'classic-elementor-addons-pro'),
				"type"        => Controls_Manager::DIMENSIONS,
				"default"     => [
					'top'    => 19,
					'left'   => 15,
					'right'  => 54,
					'bottom' => 29, 
				],
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-prefix-title" => "top: {{TOP}}%; left: {{LEFT}}%; right: {{RIGHT}}%; bottom: {{BOTTOM}}%;",
				],
			]
		);
		$this->add_responsive_control(
			"prefix_heading_index",
			[
				"type"	=> \Elementor\Controls_Manager::NUMBER,
				"label"	=> __( "Heading Z-index", 'classic-elementor-addons-pro' ),
				"description" => esc_html__( "Set z-index value for your slider heading.", 'classic-elementor-addons-pro' ),
				"default"	=> '',
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-content .slider-prefix-title" => "z-index: {{VALUE}};", // wrapper
				]
 			]
		);
		$this->end_controls_section();

		// Style Title Section
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Title', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'slide_heading_typography',
				'label'     => esc_html__('Title Typography', 'classic-elementor-addons-pro'),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .slide-title-wrapper',
			]
		);
		$this->add_responsive_control(
			"heading_position",
			[
				"label"       => esc_html__("Position", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Specify custom navigation position in percentages (top, left).", 'classic-elementor-addons-pro'),
				"type"        => Controls_Manager::DIMENSIONS,
				"default"     => [
					'top'    => 22,
					'left'   => 15,
					'right'  => 54,
					'bottom' => 29, 
				],
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slide-title-wrapper" => "top: {{TOP}}%; left: {{LEFT}}%; right: {{RIGHT}}%; bottom: {{BOTTOM}}%;",
				],
			]
		);
		$this->add_responsive_control(
			"slide_heading_index",
			[
				"type"	=> \Elementor\Controls_Manager::NUMBER,
				"label"	=> __( "Heading Z-index", 'classic-elementor-addons-pro' ),
				"description" => esc_html__( "Set z-index value for your slider heading.", 'classic-elementor-addons-pro' ),
				"default"	=> '',
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-content .slider-title" => "z-index: {{VALUE}};", // wrapper
				]
 			]
		);
		$this->end_controls_section();
		
		// Style Content Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'slide_content_typography',
				'label'     => esc_html__( 'Content Typography', 'classic-elementor-addons-pro' ),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .slide-content-wrapper',
			]
		);		
		$this->add_responsive_control(
			"content_position",
			[
				"label"       => esc_html__("Content Position", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Specify custom navigation position in percentages (top, left).", 'classic-elementor-addons-pro'),
				"type"        => Controls_Manager::DIMENSIONS,
				"default"     => [
					'top'    => 45,
					'left'   => 15,
					'right'  => 50,
					'bottom' => 50,
				],
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slide-content-wrapper" => "top: {{TOP}}%; left: {{LEFT}}%; right: {{RIGHT}}%; bottom: {{BOTTOM}}%;",
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Button I', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			"button_text_position",
			[
				"label"       => esc_html__("Button Position", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Specify custom navigation position in percentages (top, left).", 'classic-elementor-addons-pro'),
				"type"        => Controls_Manager::DIMENSIONS,
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-button" => "top: {{TOP}}%; left: {{LEFT}}%; right: {{RIGHT}}%; bottom: {{BOTTOM}}%;",
				],
				"default"     => [
					'top'    => 54,
					'left'   => 15,
					'right'  => 69,
					'bottom' => 60, 
				],
			]
		);
		$this->add_responsive_control(
			'button_text_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-button-text-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'slide_button_text_typography',
				'label'			=> esc_html__( "Button Text Typography", "classic-elementor-addons-pro" ),
				'selector' 		=> '{{WRAPPER}} {{CURRENT_ITEM}} .slide-button-text-wrapper'
			]
		);	
		$this->start_controls_tabs('button_clr');
		$this->start_controls_tab(
			'button_clr_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__( 'Text Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
				'default'	=> '#8700FF'
			]
		);
		$this->add_control(
			'button_background_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button' => 'background-color: {{VALUE}};',
				],
				'default'	=> '#FFFFFF'
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'button_clr_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button:hover' => 'fill: {{VALUE}}; color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button:hover svg' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
				'default'	=> '#FFFFFF'
			]
		);
		$this->add_control(
			'button_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}] .cea-button:hover' => 'background-color: {{VALUE}};'
				],
				'default'	=> '#000000',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_1_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .slide-button-text-wrapper',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-button-text-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button_2',
			[
				'label' => __( 'Button II', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			"button_text_2_position",
			[
				"label"       => esc_html__("Button Position", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Specify custom navigation position in percentages (top, left).", 'classic-elementor-addons-pro'),
				"type"        => Controls_Manager::DIMENSIONS,
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .slider-button-2" => "top: {{TOP}}%; left: {{LEFT}}%; right: {{RIGHT}}%; bottom: {{BOTTOM}}%;",
				]
			]
		);
		$this->add_responsive_control(
			'button_text_2_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .slide-button-2-text-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'slide_button_text_2_typography',
				'label'			=> esc_html__( "Button Text Typography", "classic-elementor-addons-pro" ),
				'selector' 		=> '{{WRAPPER}} {{CURRENT_ITEM}} .slide-button-2-text-wrapper',
				"condition"		=> [
					'slide_enable_buttons!'  => 'no',
				]
			]
		);
		$this->start_controls_tabs('button_two_clr');
		$this->start_controls_tab(
			'button_2_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_2_text_color',
			[
				'label' => esc_html__( 'Text Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button-2' => 'fill: {{VALUE}}; color: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'button_2_background_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#333333',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button-2' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'button_two_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			'button_2_hover_color',
			[
				'label' => esc_html__( 'Text Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button-2:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button-2:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button-2:hover svg ' => 'fill: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button-2:focus svg ' => 'fill: {{VALUE}};',
				]
			]
		);
		$this->add_control(
			'button_2_background_hover_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button-2:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button-2:focus' => 'background-color: {{VALUE}};',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'button_2_border',
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .cea-button-2',
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'button_2_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-button-2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(			
			'section_style_slide',
			[
				'label' => __( 'Slide', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"nav_icon_color",
			[
				"label"		  => esc_html__( "Navigation Icon Color", 'classic-elementor-addons-pro' ),
				"description" => esc_html__( "Choose Color of the Navigation Icon", 'classic-elementor-addons-pro' ),
				"type"		  => Controls_Manager::COLOR,	
				"selectors"   => [
					"{{WRAPPER}} .owl-carousel .owl-nav button" => "color: {{VALUE}};",
					"{{WRAPPER}} .owl-carousel .owl-nav .owl-prev:before" => "color: {{VALUE}};",
					"{{WRAPPER}} .owl-carousel .owl-nav .owl-next:before" => "color: {{VALUE}};",
				]	
			]
		);
		$this->add_control(
			"nav_icon_bg_color",
			[
				"label"		  => esc_html__( "Navigation Icon background Color", 'classic-elementor-addons-pro' ),
				"description" => esc_html__( "Choose Color of the Navigation Icon Background Color", 'classic-elementor-addons-pro' ),
				"type"		  => Controls_Manager::COLOR,
				"selectors"   => [
					"{{WRAPPER}} .owl-carousel .owl-nav button" => "background-color: {{VALUE}};"
				]	
			]
		);
		$this->add_control(
			"nav_border_radius",
			[
				"label"		  => esc_html__( "Navigation Icon border radius", 'classic-elementor-addons-pro' ),
				"description" => esc_html__( "Choose Color of the Navigation Icon Border Radius", 'classic-elementor-addons-pro' ),
				"type"		  => Controls_Manager::NUMBER,
			]
		);
		$this->add_control(
			"nav_icon_size",
			[
				"label"		  => esc_html__( "Navigation Icon Size", 'classic-elementor-addons-pro' ),
				"description" => esc_html__( "Size of the Navigation Icon", 'classic-elementor-addons-pro' ),
				"type"		  => Controls_Manager::NUMBER,	
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .owl-carousel .owl-nav .owl-prev:before" => "font-size: {{VALUE}}px !important;",
					"{{WRAPPER}} {{CURRENT_ITEM}} .owl-carousel .owl-nav .owl-next:before" => "font-size: {{VALUE}}px !important;"
				]	
			]
		);
		$this->add_responsive_control(
			'nav_padding',
			[
				'label' => esc_html__( 'Navigation Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::NUMBER,
				"selectors" => [
					"{{WRAPPER}} .owl-carousel .owl-nav button" => "padding: {{VALUE}}px !important;",
				]
			]
		);		
		$this->add_responsive_control(
			"nav_prev_position",
			[
				"label"       => esc_html__("Preview Navigation Position", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Specify custom navigation position in percentages (top, left).", 'classic-elementor-addons-pro'),
				"type"        => Controls_Manager::DIMENSIONS,
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .cea-carousel .owl-nav button.owl-prev" => "top: {{TOP}}%; left: {{LEFT}}%; right: {{RIGHT}}%; bottom: {{BOTTOM}}%;",
				],
			]
		);
		$this->add_responsive_control(
			"nav_next_position",
			[
				"label"       => esc_html__("Next Navigation Position", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Specify custom navigation position in percentages (top, left).", 'classic-elementor-addons-pro'),
				"type"        => Controls_Manager::DIMENSIONS,
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .cea-carousel .owl-nav button.owl-next" => "top: {{TOP}}%; left: {{LEFT}}%; right: {{RIGHT}}%; bottom: {{BOTTOM}}%;",
				],
			]
		);
		$this->add_responsive_control(
			"nav_rotate",
			[
				"label"       => esc_html__("Navigation Rotate", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Specify the level of rotation for navigation.", 'classic-elementor-addons-pro'),
				"type"        => Controls_Manager::NUMBER,
				"default"     => 0,
				"selectors"   => [
					"{{WRAPPER}} .owl-carousel .owl-nav" => "transform: rotate({{VALUE}}deg);"
				]
			]
		);
		
		$this->add_responsive_control(
			"nav_z_index",
			[
				"label"       => esc_html__("Navigation Z-index", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Set z-index for navigation.", 'classic-elementor-addons-pro'),
				"type"        => Controls_Manager::NUMBER,
				"default"     => '',
				"selectors"   => [
					"{WRAPPER}} .owl-carousel .owl-nav" => "z-index: {{VALUE}};"  // wrapper
				]
			]
		);
		$this->add_control(
			"active_pagination_color",
			[
				'label'			=> esc_html__( 'Active Pagination Color', 'classic-elementor-addons-pro' ),
				'type'			=> Controls_Manager::COLOR,
				'description'	=> esc_html__( "Choose Color of the pagination that is active", 'classic-elementor-addons-pro' ),
				'selectors'     => [
					"{{WRAPPER}} .owl-carousel .owl-dots .owl-dot.active" => "background-color:{{VALUE}} !important;",
				]
			]
		);
		$this->add_control(
			"pagination_color",
			[
				'label'			=> esc_html__( 'Pagination Color', 'classic-elementor-addons-pro' ),
				'type'			=> Controls_Manager::COLOR,
				'description'	=> esc_html__( "Choose Color of the pagination", 'classic-elementor-addons-pro' ),
				'selectors'     => [
					"{{WRAPPER}} .owl-carousel .owl-dots .owl-dot" => "background-color:{{VALUE}};",
				]
			]
		);
		$this->add_responsive_control(
			"pagination_height",
			[
				'label'			=> esc_html__( 'Pagination Height', 'classic-elementor-addons-pro' ),
				'type'			=> Controls_Manager::NUMBER,
				'description'	=> esc_html__( "Choose Height of the pagination", 'classic-elementor-addons-pro' ),
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-carousel .owl-dots button.owl-dot'=> "height: {{SIZE}}px;",
				],
			]
		);
		$this->add_responsive_control(
			"pagination_width",
			[
				'label'			=> esc_html__( 'Pagination Width', 'classic-elementor-addons-pro' ),
				'type'			=> Controls_Manager::NUMBER,
				'description'	=> esc_html__( "Choose width of the pagination", 'classic-elementor-addons-pro' ),
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .cea-carousel .owl-dots button.owl-dot'=> "width: {{SIZE}}px;",
				],
			]
		);
		$this->add_responsive_control(
			"dots_custom_position",
			[
				"label"       => esc_html__("Custom Pagination Position", 'classic-elementor-addons-pro'),
				"description" => esc_html__("Specify custom pagination position in percentages (top, left).", 'classic-elementor-addons-pro'),
				"type"        => Controls_Manager::DIMENSIONS,
				"selectors"   => [
					"{{WRAPPER}} {{CURRENT_ITEM}} .cea-carousel .owl-dots" => "top: {{TOP}}%; left: {{LEFT}}%; right: {{RIGHT}}%; bottom: {{BOTTOM}}%;",
				],
			]
		);
		$this->add_responsive_control(
			"dots_rotate",
			[
				"label"		  => esc_html__( "Pagination transform Rotate", 'classic-elementor-addons-pro' ),
				"description" => esc_html__( "Specify the level rotation of the pagination.", 'classic-elementor-addons-pro' ),
				"type"		  => Controls_Manager::NUMBER,
				"selectors"   => [
					"{{WRAPPER}}  {{CURRENT_ITEM}} .cea-carousel .owl-dots .owl-dot" => " transform: rotate({{VALUE}}deg); ",
				]
			]
		);
		$this->add_responsive_control(
			"pagination_z_index",
			[
				"type"	=> \Elementor\Controls_Manager::NUMBER,
				"label"	=> __( "Pagination Z-index", 'classic-elementor-addons-pro' ),
				"description" => esc_html__( "Set z-index value for your slider pagination.", 'classic-elementor-addons-pro' ),
				"default"	=> '',
				"selectors" => [
					"{{WRAPPER}} {{CURRENT_ITEM}] .cea-carousel .owl-dots .owl-dot" => "z-index: {{VALUE}};", 
				]
			]
		);
		$this->end_controls_section();
	}
	
	/**
	 * Render Slider Widget widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		//Define Variables
		$class = isset( $image_grid_style ) && $image_grid_style != '' ? ' slider-widget-'. $image_grid_style : '';
		$cols = isset( $grid_cols ) ? $grid_cols : 12;
		$caption_opt = isset( $caption_opt ) && $caption_opt == 'yes' ? true : false;
		$light_box = isset( $light_box ) && $light_box == 'yes' ? true : false;	
		$image_sizes = get_intermediate_image_sizes();

		$slide_opt = isset( $slide_opt ) && $slide_opt == 'yes' ? true : false;
		if( $slide_opt ){
			$gal_atts = array(
				'data-rewind="'. ( isset($slide_rewind) && $slide_rewind =='yes' ? 1 : 0 ).'"',
				'data-lazyload="'. ( isset($slide_lazyload) && $slide_lazyload =='yes' ? 1 : 0 ).'"',
				'data-mousedrag="'. ( isset($slide_mousedrag) && $slide_mousedrag =='yes' ? 1 : 0 ).'"',
				'data-loop="'. ( isset( $slide_item_loop ) && $slide_item_loop == 'yes' ? 1 : 0 ) .'"',
				'data-nav-rotate="' . ( isset( $nav_rotate ) && $nav_rotate != '' ? absint( $nav_rotate ) : '' ) . '"',
				'data-dots-rotate="' . ( isset( $dots_rotate ) && $dots_rotate != '' ? absint( $dots_rotate ) : '' ) . '"',
      			'data-nav-z-index="' . ( isset( $nav_z_index ) && $nav_z_index != '' ? absint( $nav_z_index ) : '' ) . '"',
				'data-margin="'. ( isset( $slide_margin ) && $slide_margin != '' ? absint( $slide_margin ) : 0 ) .'"',
				'data-center="'. ( isset( $slide_center ) && $slide_center == 'yes' ? 1 : 0 ) .'"',
				'data-nav="'. ( isset( $slide_nav ) && $slide_nav == 'yes' ? 1 : 0 ) .'"',
				'data-dots="'. ( isset( $slide_dots ) && $slide_dots == 'yes' ? 1 : 0 ) .'"',
				'data-autoplay="'. ( isset( $slide_item_autoplay ) && $slide_item_autoplay == 'yes' ? 1 : 0 ) .'"',
				'data-items="'. ( isset( $slide_item ) && $slide_item != '' ? absint( $slide_item ) : 1 ) .'"',
				'data-items-tab="'. ( isset( $slide_item_tab ) && $slide_item_tab != '' ? absint( $slide_item_tab ) : 1 ) .'"',
				'data-items-mob="'. ( isset( $slide_item_mobile ) && $slide_item_mobile != '' ? absint( $slide_item_mobile ) : 1 ) .'"',
				'data-duration="'. ( isset( $slide_duration ) && $slide_duration != '' ? absint( $slide_duration ) : 5000 ) .'"',
				'data-smartspeed="'. ( isset( $slide_smart_speed ) && $slide_smart_speed != '' ? absint( $slide_smart_speed ) : 250 ) .'"',
				'data-scrollby="'. ( isset( $slide_slideby ) && $slide_slideby != '' ? absint( $slide_slideby ) : 1 ) .'"',
				'data-autoheight="0"',
				'data-pause-on-hover="'. ( isset( $settings['pause_on_hover'] ) && $settings['pause_on_hover'] == 'yes' ? 1 : 0 ) .'"',
				'data-preview-icon="' . esc_attr( isset( $settings['nav_prev_icon']['value'] ) ? $settings['nav_prev_icon']['value'] : 'default-prev-icon' ) . '"',
				'data-next-icon="' . esc_attr( isset( $settings['nav_next_icon']['value'] ) ? $settings['nav_next_icon']['value'] : 'default-next-icon' ) . '"',
				'data-animatein="'. ( isset( $slide_animate_in ) && $slide_animate_in ? $slide_animate_in : "" ) .'"',
				'data-pagination-color="'. ( isset( $pagination_color ) && $pagination_color ? $pagination_color : "" ) . '"',
				'data-active-pagination-color="'. ( isset( $active_pagination_color ) && $active_pagination_color ? $active_pagination_color : "" ) . '"',
				'data-icon-color="'. ( isset( $nav_icon_color ) && $nav_icon_color ? $nav_icon_color : "" ) . '"',
				'data-icon-bg-color="'. ( isset( $nav_icon_bg_color ) && $nav_icon_bg_color ? $nav_icon_bg_color : "" ) . '"',
				'data-icon-border-radius="'. ( isset( $nav_border_radius ) && $nav_border_radius ? $nav_border_radius : "" ) . '"',
				'data-icon-size="'. ( isset( $nav_icon_size ) && $nav_icon_size ? $nav_icon_size : "" ) . '"',
				'data-next-text="'. ( isset( $nav_next_text ) && $nav_next_text ? $nav_next_text : "NEXT" ). '"',
				'data-prev-text="'. ( isset( $nav_prev_text ) && $nav_prev_text ? $nav_prev_text : "PREV" ). '"',
				'data-nav-type="' . ( isset( $nav_enable_icon_text ) ? $nav_enable_icon_text : 'nav-icon' ) . '"',
				'data-nav-padding="'. ( isset( $nav_padding ) && $nav_padding != '' ? absint( $nav_padding ) : 20 ) .'"',
 			);
			$data_atts = implode( " ", $gal_atts );
		}
		
		//Tilt options
		$tilt_opt = isset( $settings['tilt_opt'] ) && $settings['tilt_opt'] == 'yes' ? true : false;
		$tilt_transition = isset( $settings['tilt_transition'] ) && $settings['tilt_transition'] == 'yes' ? true : false;
		$max_tilt = isset( $settings['max_tilt'] ) ? $settings['max_tilt'] : '';
		$perspective = isset( $settings['perspective'] ) ? $settings['perspective'] : '';
		$tilt_scale = isset( $settings['tilt_scale'] ) ? $settings['tilt_scale'] : '';
		$tilt_speed = isset( $settings['tilt_speed'] ) ? $settings['tilt_speed'] : '';
		
		$this->add_render_attribute( 'cea-igrid-tilt', 'class', 'slider-widget-inner' );
		if( $tilt_opt ){
			$this->add_render_attribute( 'cea-igrid-tilt', 'class', 'cea-tilt' );
			$this->add_render_attribute( 'cea-igrid-tilt', 'data-tilt_trans', $tilt_transition );
			$this->add_render_attribute( 'cea-igrid-tilt', 'data-max_tilt', $max_tilt );
			$this->add_render_attribute( 'cea-igrid-tilt', 'data-tilt_perspective', $perspective );
			$this->add_render_attribute( 'cea-igrid-tilt', 'data-tilt_scale', $tilt_scale );
			$this->add_render_attribute( 'cea-igrid-tilt', 'data-tilt_speed', $tilt_speed );
		}
		$this->add_render_attribute( 'slider-button-wrapper', 'class', 'cea-btn' );
		if ( isset( $settings['button_size'] ) ) {
			$this->add_render_attribute( 'slider-button-wrapper', 'class', 'cea-btn-' . $settings['button_size'] );
		}
		if ( isset( $settings['button_align'] ) ) {
			$this->add_render_attribute( 'slider-button-wrapper', 'class', 'cea-btn-' . $settings['button_align'] . '-align' );
		}
		echo '<div ' . $this->get_render_attribute_string( 'slider-button-wrapper' ) . '">';
		$this->add_render_attribute( 'slider-button-wrapper-2', 'class', 'cea-btn' );
		if ( isset( $settings['button_size_2'] ) ) {
			$this->add_render_attribute( 'slider-button-wrapper-2', 'class', 'cea-btn-' . $settings['button_size_2'] );
		}
		if ( isset( $settings['button_align_2'] ) ) {
			$this->add_render_attribute( 'slider-button-wrapper-2', 'class', 'cea-btn-' . $settings['button_align_2'] . '-align' );
		}
		echo '<div ' . $this->get_render_attribute_string( 'slider-button-wrapper-2' ) . '">';
			echo '<div class="slider-widget-wrapper'. esc_attr( $class ) .'">';
			$row_stat = 0;	
			if( $row_stat == 0 && $slide_opt != '1' ) :
				echo'<div class="row">';
			endif;
			if( $slide_opt ) echo '<div class="cea-carousel owl-carousel" '. ( $data_atts ) .' >';
			foreach ($settings['slider_slide'] as $slide) {
				
					$image_id = $slide['slide_img']['id'];
					$image_url = wp_get_attachment_image_src($image_id, 'full')[0] ?? $image_id['url'];
					// $image_index = isset( $slide['slide_image_index'] ) ? $slide['slide_image_index'] : ''; noneed
					$slide_height = isset( $slide['slide_height'] ) ? $slide['slide_height'] : 700;
					$prefix_heading = isset( $slide['slide_prefix_heading_animation'] ) ? $slide['slide_prefix_heading_animation'] : '';
					$heading = isset($slide['slide_heading']) ? $slide['slide_heading'] : '';
					$content = isset($slide['slide_content']) ? $slide['slide_content'] : '';
		
					// Heading Positioning
					// $slide_heading_color = isset( $slide['slide_heading_color'] ) ? $slide['slide_heading_color'] : '';
					$heading_index = isset( $slide['slide_heading_index'] ) ? $slide['slide_heading_index'] : '';
					$slide_heading_animation = isset( $slide['slide_heading_animation']) ? $slide['slide_heading_animation'] : 'fadeIn';
					$slide_heading_animation_delay = isset( $slide['slide_heading_animation_delay'] ) ? $slide['slide_heading_animation_delay'] : 30;
					$prefix_heading_index = isset( $slide['prefix_heading_index'] ) ? $slide['prefix_heading_index'] : '';
					$slide_prefix_heading_animation = isset( $slide['slide_prefix_heading_animation'] ) ? $slide['slide_prefix_heading_animation'] : 'fadeIn';
					$slide_prefix_animation_delay = isset( $slide['slide_prefix_animation_delay'] ) ? $slide['slide_prefix_animation_delay'] : 30;
					// Content Positioning
					// $slide_content_color = isset( $slide['slide_content_color'] ) ? $slide['slide_content_color'] : '';
					$content_index = isset( $slide['slide_content_index'] ) ? $slide['slide_content_index'] : '';
					$slide_content_animation = isset( $slide['slide_content_animation']) ? $slide['slide_content_animation'] : 'fadeIn';
					$slide_content_animation_delay = isset( $slide['slide_content_animation_delay'] ) ? $slide['slide_content_animation_delay'] : 30;
					//Slide Button Position
					$button_text = isset($slide['slide_button']) ? $slide['slide_button'] : '';
					$button_link = isset($slide['button_link']['url']) ? esc_url($slide['button_link']['url']) : '#';
					$button_icon = isset($slide['button_icon']['value']) ? $slide['button_icon']['value'] : '';
					$icon_position = isset($slide['button_icon_align']) ? $slide['button_icon_align'] : 'left';
					$button_index = isset( $slide['slide_button_index'] ) ? $slide['slide_button_index'] : '';
					$slide_button_animation = isset( $slide['slide_button_animation']) ? $slide['slide_button_animation'] : 'fadeIn';
					$slide_button_animation_delay = isset( $slide['slide_button_animation_delay'] ) ? $slide['slide_button_animation_delay'] : 30;
					//Slide Button 2 Position 
					$button_text_2 = isset($slide['slide_button_2']) ? $slide['slide_button_2'] : '';
					$button_link_2 = isset($slide['button_link_2']['url']) ? esc_url($slide['button_link_2']['url']) : '#';
					$button_icon_2 = isset($slide['button_icon_2']['value']) ? $slide['button_icon_2']['value'] : '';
					$icon_position_2 = isset($slide['button_icon_align_2']) ? $slide['button_icon_align_2'] : 'left';
					$button_2_index = isset( $slide['slide_button_2_index'] ) ? $slide['slide_button_2_index'] : '';
					$slide_button_2_animation = isset( $slide['slide_button_2_animation']) ? $slide['slide_button_2_animation'] : 'fadeIn';
					$slide_button_2_animation_delay = isset( $slide['slide_button_2_animation_delay'] ) ? $slide['slide_button_2_animation_delay'] : 30;
					//Foreground Image 1 positioning 
					$foreground_image1_id = $slide['foreground_image_1']['id'];
					$foreground_image_url = wp_get_attachment_url( $foreground_image1_id );
					// $foreground_image_1_transform = isset( $slide['foreground_image_1_transform'] ) ? $slide['foreground_image_1_transform'] : '';
					// $foreground_1_index = isset( $slide['slide_fore_1_index'] ) ? $slide['slide_fore_1_index'] : '';
					$slide_foreground_image1_animation = isset( $slide['slide_foreground_image1_animation']) ? $slide['slide_foreground_image1_animation'] : 'fadeIn';
					$slide_foreground_image1_animation_delay = isset( $slide['slide_foreground_image1_animation_delay'] ) ? $slide['slide_foreground_image1_animation_delay'] : 30;
					$foreground_image_1_visibility = isset( $slide['foreground_image_1_visibility'] ) ? $slide['foreground_image_1_visibility'] : '';
					$slide_float_image1_animation = isset( $slide['slide_float_image1_animation'] ) ? $slide['slide_float_image1_animation'] : 'none';
					//Foreground Image 2 positioning 
					$foreground_image2_id = $slide['foreground_image_2']['id'];
					$foreground_image2_url = wp_get_attachment_url( $foreground_image2_id );
					// $foreground_image_2_transform = isset( $slide['foreground_image_2_transform'] ) ? $slide['foreground_image_2_transform'] : '';
					// $foreground_2_index = isset( $slide['slide_fore_2_index'] ) ? $slide['slide_fore_2_index'] : '';
					$slide_foreground_image2_animation = isset( $slide['slide_foreground_image2_animation']) ? $slide['slide_foreground_image2_animation'] : 'fadeIn';
					$slide_foreground_image2_animation_delay = isset( $slide['slide_foreground_image2_animation_delay'] ) ? $slide['slide_foreground_image2_animation_delay'] : 30;
					$foreground_image_2_visibility = isset( $slide['foreground_image_2_visibility'] ) ? $slide['foreground_image_2_visibility'] : '';
					$slide_float_image2_animation = isset( $slide['slide_float_image2_animation'] ) ? $slide['slide_float_image2_animation'] : 'none';
					//Foreground Image 3 positioning 
					$foreground_image3_id = $slide['foreground_image_3']['id'];
					$foreground_image3_url = wp_get_attachment_url( $foreground_image3_id );
					// $foreground_image_3_transform = isset( $slide['foreground_image_3_transform'] ) ? $slide['foreground_image_3_transform'] : '';
					// $foreground_3_index = isset( $slide['slide_fore_3_index'] ) ? $slide['slide_fore_3_index'] : '';
					$slide_foreground_image3_animation = isset( $slide['slide_foreground_image3_animation']) ? $slide['slide_foreground_image3_animation'] : 'fadeIn';
					$slide_foreground_image3_animation_delay = isset( $slide['slide_foreground_image3_animation_delay'] ) ? $slide['slide_foreground_image3_animation_delay'] : 30;
					$foreground_image_3_visibility = isset( $slide['foreground_image_3_visibility'] ) ? $slide['foreground_image_3_visibility'] : '';
					$slide_float_image3_animation = isset( $slide['slide_float_image3_animation'] ) ? $slide['slide_float_image3_animation'] : 'none';
					//Foreground Image 4 positioning 
					$foreground_image4_id = $slide['foreground_image_4']['id'];
					$foreground_image4_url = wp_get_attachment_url( $foreground_image4_id );
					// $foreground_image_4_transform = isset( $slide['foreground_image_4_transform'] ) ? $slide['foreground_image_4_transform'] : '';
					// $foreground_4_index = isset( $slide['slide_fore_4_index'] ) ? $slide['slide_fore_4_index'] : '';
					$slide_foreground_image4_animation = isset( $slide['slide_foreground_image4_animation']) ? $slide['slide_foreground_image4_animation'] : 'fadeIn';
					$slide_foreground_image4_animation_delay = isset( $slide['slide_foreground_image4_animation_delay'] ) ? $slide['slide_foreground_image4_animation_delay'] : 30;
					$foreground_image_4_visibility = isset( $slide['foreground_image_4_visibility'] ) ? $slide['foreground_image_4_visibility'] : '';
					$slide_float_image4_animation = isset( $slide['slide_float_image4_animation'] ) ? $slide['slide_float_image4_animation'] : 'none';
					//Foreground Image 5 positioning 
					$foreground_image5_id = $slide['foreground_image_5']['id'];
					$foreground_image5_url = wp_get_attachment_url( $foreground_image5_id );
					// $foreground_image_5_transform = isset( $slide['foreground_image_5_transform'] ) ? $slide['foreground_image_5_transform'] : '';
					// $foreground_5_index = isset( $slide['slide_fore_5_index'] ) ? $slide['slide_fore_5_index'] : '';
					$slide_foreground_image5_animation = isset( $slide['slide_foreground_image5_animation']) ? $slide['slide_foreground_image5_animation'] : 'fadeIn';
					$slide_foreground_image5_animation_delay = isset( $slide['slide_foreground_image5_animation_delay'] ) ? $slide['slide_foreground_image5_animation_delay'] : 30;
					$foreground_image_5_visibility = isset( $slide['foreground_image_5_visibility'] ) ? $slide['foreground_image_5_visibility'] : '';
					$slide_float_image5_animation = isset( $slide['slide_float_image5_animation'] ) ? $slide['slide_float_image5_animation'] : 'none';
					// Slide Content area
					echo '<div class="slider-item elementor-repeater-item-' . $slide['_id'] .'">';
					if( $image_url ){
						echo '<img src="'.esc_url($image_url).'" alt="'.esc_attr($heading).'" class="slider-image">';
					}
					echo '<div class="slider-content">';
					echo '<h5 class="slider-prefix-title animate__animated animate__' . esc_attr($slide_prefix_heading_animation) . '"
						style="position: absolute; 
							z-index: ' . esc_attr($prefix_heading_index) . ';"
						data-animation="' . esc_attr($slide_prefix_heading_animation) . '"
						data-delay="' . esc_attr($slide_prefix_animation_delay) . '">
						' . esc_html($slide['slide_prefix_heading']) . '
					</h5>';
					echo '<h3 class="slider-title slide-title-wrapper animate__animated animate__' . esc_attr($slide_heading_animation) . '" 
						style="position: absolute; 
							z-index: ' . esc_attr($heading_index) . ';"
						data-animation="' . esc_attr($slide_heading_animation) . '"
						data-delay="' . esc_attr($slide_heading_animation_delay) . '">
						' . esc_html($slide['slide_heading']) . '
					</h3>';
					echo '<p class="slider-description slide-content-wrapper animate__animated animate__'.$slide_content_animation.'"
						style="
						position:absolute;
						z-index: '.$content_index.';"
						data-animation="' . esc_attr($slide_content_animation) . '"
						data-delay="' . esc_attr($slide_content_animation_delay) . '">
					'.esc_html($content).'</p>';
							if ($foreground_image_url) {
								echo '<img src="' . esc_url($foreground_image_url) . '" 
									alt="Foreground Image"
									class="slider-foreground-image_1 slider-foreground-image_1_'.esc_attr($slide['_id']).' animate__animated animate__' . esc_attr($slide_foreground_image1_animation) . ' ' . $foreground_image_1_visibility . ' ' . $slide_float_image1_animation . ' "
									style="position: absolute;"
									data-animation="' . esc_attr($slide_foreground_image1_animation) . '"
									data-delay="' . esc_attr($slide_foreground_image1_animation_delay) . '">';
							}
							if ($foreground_image2_url) {
								echo '<img src="'.esc_url($foreground_image2_url).'" alt="Foreground Image" class="slider-foreground-image_2 animate__animated animate__'.$slide_foreground_image2_animation.' ' . $foreground_image_2_visibility . ' ' . $slide_float_image2_animation . ' "
									style="position:absolute;"
									data-animation="' . esc_attr($slide_foreground_image2_animation) . '"
									data-delay="' . esc_attr($slide_foreground_image2_animation_delay) . '">';
							}
							if ($foreground_image3_url) {
								echo '<img src="'.esc_url($foreground_image3_url).'" alt="Foreground Image" class="slider-foreground-image_3 animate__animated animate__'.$slide_foreground_image3_animation.' ' . $foreground_image_3_visibility . ' ' . $slide_float_image3_animation . ' "
									style="position:absolute;"
									data-animation="' . esc_attr($slide_foreground_image3_animation) . '"
									data-delay="' . esc_attr($slide_foreground_image3_animation_delay) . '">';
							}
							if ($foreground_image4_url) {
								echo '<img src="'.esc_url($foreground_image4_url).'" alt="Foreground Image" class="slider-foreground-image_4 animate__animated animate__'.$slide_foreground_image4_animation.' ' . $foreground_image_4_visibility . ' ' . $slide_float_image4_animation . ' "
									style="position:absolute;"
									data-animation="' . esc_attr($slide_foreground_image4_animation) . '"
									data-delay="' . esc_attr($slide_foreground_image4_animation_delay) . '">';
							}
							if ($foreground_image5_url) {
								echo '<img src="'.esc_url($foreground_image5_url).'" alt="Foreground Image" class="slider-foreground-image_5 animate__animated animate__' .$slide_foreground_image5_animation. ' ' . $foreground_image_5_visibility . ' ' . $slide_float_image5_animation . ' "
									style="position:absolute;"
									data-animation="' . esc_attr($slide_foreground_image5_animation) . '"
									data-delay="' . esc_attr($slide_foreground_image5_animation_delay) . '">';
							}
							if ($button_text) {
								echo '<div class="cea-button slider-button animate__animated animate__'.$slide_button_animation.'"
								style="
								position: absolute;
								z-index:'.$button_index.';"
								data-animation="' . esc_attr($slide_button_animation) . '"
								data-delay="' . esc_attr($slide_button_animation_delay) . '">';
								echo '<a href="'.$button_link.'" class="cea-button">';
								echo '<div class="cea-button slide-button-text-wrapper">';
									if ($icon_position === 'left' && $button_icon) {
										echo '<i class="'.esc_attr($button_icon).'"></i>';
									}
									echo esc_html($button_text);
									if ($icon_position === 'right' && $button_icon) {
										echo '<i class="'.esc_attr($button_icon).'"></i>';
									}
									echo '</div>';
									echo '</a>';
								echo '</div>';
							}
							if ($button_text_2) {
								echo '<div class="slider-button-2 animate__animated animate__'.$slide_button_2_animation.'"
								style="
								position: absolute;
								z-index:'.$button_2_index.';"
								data-animation="' . esc_attr($slide_button_2_animation) . '"
								data-delay="' . esc_attr($slide_button_2_animation_delay) . '">';
								echo '<a href="'.$button_link_2.'" class="cea-button-2">';
								echo '<div class="cea-button-2 slide-button-2-text-wrapper">';
								if ($icon_position_2 === 'left' && $button_icon_2) {
									echo '<i class="'.esc_attr($button_icon_2).'"></i>';
								}
								echo esc_html($button_text_2);
								if ($icon_position_2 === 'right' && $button_icon_2) {
									echo '<i class="'.esc_attr($button_icon_2).'"></i>';
								}
								echo '</div>';
								echo '</a>';
								echo '</div>';
							}
					echo '</div>';
					echo '</div>';
			}
			if( $slide_opt ) echo '</div><!-- .owl-carousel -->';
			echo '</div><!-- .slider-widget-wrapper -->';
	}
}