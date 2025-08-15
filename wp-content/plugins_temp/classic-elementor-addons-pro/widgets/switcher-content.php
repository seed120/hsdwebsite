<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Classic Elementor Addon Switcher Content
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Switcher_Content_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Switcher Content widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceaswitchercontent";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Switcher Content widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( "Switcher Content", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Switcher Content widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-split-h";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Switcher Content widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'switcher', 'content', 'classic' ];
    }

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Switcher Content widget belongs to.
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
		return [ 'cea-custom-front'  ];
	}

	/**
	 * Register Switcher Content widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//General Section
		$this->start_controls_section(
			"general_section",
			[
				"label"	=> esc_html__( "General", 'classic-elementor-addons-pro' ),
				"accordion"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default accordion options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"switcher_content_type",
			[
				"type"			=> Controls_Manager::SELECT,
				"label"			=> esc_html__( "Switcher Content Type", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for switcher content type either text content or html element. If choose HTML element, then have to put element ID into the each switcher content element box", 'classic-elementor-addons-pro' ),
				"default"		=> "content",
				"options"		=> [
					"content"	=> esc_html__( "Text Content", 'classic-elementor-addons-pro' ),
					"element"	=> esc_html__( "HTML Element", 'classic-elementor-addons-pro' )
				]
			]
		);		
		$this->end_controls_section();		
		
		//Switcher Content
		$this->start_controls_section(
			"switcher_content_section",
			[
				"label"	=> esc_html__( "Switcher Content", 'classic-elementor-addons-pro' ),
				"accordion"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Switcher content options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"primary_switcher_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Primary Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Switcher title.", 'classic-elementor-addons-pro' )
			]
		);	
		$this->add_control(
			"primary_switcher_element",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Primary Element ID", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter element id", 'classic-elementor-addons-pro' ),
				"condition" 	=> [
					"switcher_content_type"	=> "element"
				]
			]
		);		
		$this->add_control(
			"primary_switcher_content",
			[
				"label"			=> esc_html__( "Primary Content", "plugin-domain" ),
				"type" 			=> Controls_Manager::WYSIWYG,
				"description" 	=> esc_html__( "You can place here accordion content.", "plugin-domain" ),
				"condition" 	=> [
					"switcher_content_type"	=> "content"
				]
			]
		);
		$this->add_control(
			"secondary_switcher_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Secondary Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "accordion title.", 'classic-elementor-addons-pro' )
			]
		);	
		$this->add_control(
			"secondary_switcher_element",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Secondary Element ID", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Enter element id", 'classic-elementor-addons-pro' ),
				"condition" 	=> [
					"switcher_content_type"	=> "element"
				]
			]
		);		
		$this->add_control(
			"secondary_switcher_content",
			[
				"label"			=> esc_html__( "Secondary Content", "plugin-domain" ),
				"type" 			=> Controls_Manager::WYSIWYG,
				"description" 	=> esc_html__( "You can place here accordion content.", "plugin-domain" ),
				"condition" 	=> [
					"switcher_content_type"	=> "content"
				]
			]
		);
		$this->end_controls_section();
		
		// Style Switch General Section
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'General', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'switch_wrap_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .switcher-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'switch_wrap_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .switcher-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_control(
			'switch_wrap_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .switcher-content-wrapper' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			"switch_wrap_shadow_opt",
			[
				"label" 		=> esc_html__( "Box Shadow Enable", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show box shadow on counter box hover.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			"switch_wrap_shadow",
			[
				"label" 		=> esc_html__( "Box Shadow", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show box shadow on counter box hover.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::BOX_SHADOW,
				'condition' => [
					'switch_wrap_shadow_opt' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .switcher-content-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{switch_wrap_shadow_pos.VALUE}};',
				]
			]
		);
		$this->add_control(
			"switch_wrap_shadow_pos",
			[
				'label' =>  esc_html__( "Box Shadow Position", 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					' ' => esc_html__( "Outline", 'classic-elementor-addons-pro' ),
					'inset' => esc_html__( "Inset", 'classic-elementor-addons-pro' ),
				],
				'condition' => [
					'switch_wrap_shadow_opt' => 'yes',
				],
				'default' => ' ',
				'render_type' => 'ui',
			]
		);
		$this->end_controls_section();
		
		// Style Switcher Head Section
		$this->start_controls_section(
			'section_style_header',
			[
				'label' => __( 'Switcher Head', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'head_bg_color',
			[
				'label' => esc_html__( 'Header Background Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .switcher-content-wrapper .cea-switcher-header' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'switcher_head_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .switcher-content-wrapper .cea-switcher-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'switcher_head_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .switcher-content-wrapper .cea-switcher-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->start_controls_tabs( 'header_styles' );
			$this->start_controls_tab(
				'primary_header',
				[
					'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'primary_head_font_color',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .switcher-content-wrapper .cea-swticher-list li:not(.cea-switch-toggle-wrap)' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'primary_head_bg_color',
				[
					'label' => esc_html__( 'Text Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .switcher-content-wrapper .cea-swticher-list li:not(.cea-switch-toggle-wrap)' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'primary_head_active',
				[
					'label' => esc_html__( 'Active', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'secondary_head_font_color',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .switcher-content-wrapper .cea-swticher-list li.switcher-active' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'secondary_head_bg_color',
				[
					'label' => esc_html__( 'Text Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .switcher-content-wrapper .cea-swticher-list li.switcher-active' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->end_controls_tab();	
		$this->end_controls_tabs();	
		$this->add_responsive_control(
			'switcher_head_item_padding',
			[
				'label' => esc_html__( 'Switch Title Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .switcher-content-wrapper .cea-switcher-header li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' 		=> esc_html__( 'Switcher Title Typo', 'classic-elementor-addons-pro' ),
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .switcher-content-wrapper li span',
			]
		);
		
		$this->end_controls_section();
		
		// Style Switcher Content Section
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Switcher Content', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'switcher_content_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .switcher-content-wrapper .cea-switcher-content > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'switcher_content_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .switcher-content-wrapper .cea-switcher-content > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->start_controls_tabs( 'content_styles' );
			$this->start_controls_tab(
				'primary_content',
				[
					'label' => esc_html__( 'Primary', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'primary_content_font_color',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .switcher-content-wrapper .cea-switcher-content .cea-switcher-primary' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'primary_content_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .switcher-content-wrapper .cea-switcher-content .cea-switcher-primary' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'secondary_content',
				[
					'label' => esc_html__( 'Secondary', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'secondary_content_font_color',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .switcher-content-wrapper .cea-switcher-content .cea-switcher-secondary' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'secondary_content_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .switcher-content-wrapper .cea-switcher-content .cea-switcher-secondary' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->end_controls_tab();	
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' 		=> esc_html__( 'Switcher Content Typo', 'classic-elementor-addons-pro' ),
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .switcher-content-wrapper .cea-switcher-content'
			]
		);
		$this->end_controls_section();	
	
	}
	
	/**
	 * Render Switcher Content widget output on the frontend.
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
		extract( $settings );
		
		$multi_open = isset( $multi_open ) && $multi_open != '1' ? true : false;
		$this->add_render_attribute( 'switcher-attrs', 'data-toggle', $multi_open );
		?>
		
		<div class="elementor-widget-container switcher-content-wrapper" <?php $this->get_render_attribute_string( 'switcher-attrs' ) ?>>
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
	 * Render Switcher Content widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		extract( $settings );
		
		$output = '';

		$switcher_type = isset( $switcher_content_type ) && !empty( $switcher_content_type ) ? $switcher_content_type : 'content';
		
		$primary_switcher_title = isset( $primary_switcher_title ) && !empty( $primary_switcher_title ) ? $primary_switcher_title : '';
		$primary_switcher_element = isset( $primary_switcher_element ) && !empty( $primary_switcher_element ) ? $primary_switcher_element : '';
		$primary_switcher_content = isset( $primary_switcher_content ) && !empty( $primary_switcher_content ) ? $primary_switcher_content : '';
		
		$secondary_switcher_title = isset( $secondary_switcher_title ) && !empty( $secondary_switcher_title ) ? $secondary_switcher_title : '';
		$secondary_switcher_element = isset( $secondary_switcher_element ) && !empty( $secondary_switcher_element ) ? $secondary_switcher_element : '';
		$secondary_switcher_content = isset( $secondary_switcher_content ) && !empty( $secondary_switcher_content ) ? $secondary_switcher_content : '';
		
		$output .= '<div class="cea-switcher-header">';
			$output .= '<ul class="nav cea-swticher-list">';
				$output .= $primary_switcher_title ? '<li class="cea-primary-switch switcher-active"><span>'. esc_html( $primary_switcher_title ) .'</span></li>' : '';
				$output .= '<li class="cea-switch-toggle-wrap"><label class="cea-switch"><input class="switch-checkbox" type="checkbox"><span class="slider round"></span></label></li>';
				$output .= $secondary_switcher_title ? '<li class="cea-secondary-switch"><span>'. esc_html( $secondary_switcher_title ) .'</span></li>' : '';
			$output .= '</ul>';
		$output .= '</div><!-- .cea-switcher-header -->';
		
		$output .= '<div class="cea-switcher-content">';
			
			//Primary Part
			$primary_content = '';
			if( !$primary_switcher_element ) {
				$primary_content = $primary_switcher_content;
			}else{
				$primary_content = '<span class="cea-switcher-id-to-element" data-id="'. esc_attr( $primary_switcher_element ) .'"></span>';
			}			
			$output .= $primary_content ? '<div class="cea-switcher-primary">'. $primary_content .'</div><!-- .cea-switcher-primary -->' : '';
			
			//Secondary Part
			$secondary_content = '';
			if( !$secondary_switcher_element ) {
				$secondary_content = $secondary_switcher_content;
			}else{
				$secondary_content = '<span class="cea-switcher-id-to-element" data-id="'. esc_attr( $secondary_switcher_element ) .'"></span>';
			}			
			$output .= $secondary_content ? '<div class="cea-switcher-secondary">'. $secondary_content .'</div><!-- .cea-switcher-secondary -->' : '';
			
		$output .= '</div><!-- .cea-switcher-content -->';
		
		echo $output;

	}
		
}