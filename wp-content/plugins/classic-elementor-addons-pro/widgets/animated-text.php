<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Elementor Animated Text Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_AnimateText_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Animated Text widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ceaanimatedtext';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Animated Text widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Animated Text', 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Animated Text widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'cea-default-icon ti-smallcap';
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Cea Animated Text widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'animated', 'text', 'classic' ];
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
		return [ 'typed', 'cea-custom-front'  ];
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Animated Text widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'classic-elements' ];
	}

	/**
	 * Register Animated Text widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);		
		$this->add_control(
			'pre_title',
			[
				'label' => __( 'Prefix Text', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Prefix Text', 'classic-elementor-addons-pro' ),
				"default" 		=> __( 'Prefix Text', 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			'post_title',
			[
				'label' => __( 'Suffix Text', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Suffix Text', 'classic-elementor-addons-pro' ),
				"default" 		=> ''
			]
		);
		$repeater = new Repeater();		
		$repeater->add_control(
			'ani_text',
			[
				'label'			=> esc_html__( 'Animated Text', 'classic-elementor-addons-pro' ),
				'type'			=> Controls_Manager::TEXT,
				'label_block'	=> true,
				'dynamic'		=> [
					'active'	=> true,
				],
			]
		);
		$this->add_control(
			"ani_text_list",
			[
				"type"			=> Controls_Manager::REPEATER,
				"label"			=> esc_html__( "Animated Text", 'classic-elementor-addons-pro' ),
				"fields"		=> $repeater->get_controls(),
				"default" 		=> [
					[
						'ani_text'	=> esc_html__( 'Web', 'classic-elementor-addons-pro' ),
					],
					[
						'ani_text'	=> esc_html__( 'App', 'classic-elementor-addons-pro' ),
					],
					[
						'ani_text'	=> esc_html__( 'Design', 'classic-elementor-addons-pro' ),
					]
				],
				"title_field"	=> "{{{ ani_text }}}"
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'layout_section',
			[
				'label' => __( 'Layout', 'classic-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);	
		$this->add_control(
			'heading_tag',
			[
				'label' => __( 'Choose heading tag', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
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
			'typespeed',
			[
				'label' => __( 'Enter type speed', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => '100',
				"default" 		=> '100'
			]
		);		
		$this->add_control(
			'backspeed',
			[
				'label' => __( 'Enter back speed', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => '100',
				"default" 		=> '100'
			]
		);
		$this->add_control(
			'backdelay',
			[
				'label' => __( 'Enter back delay', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => '1000',
				"default" 		=> '1000'
			]
		);		
		$this->add_control(
			'startdelay',
			[
				'label' => __( 'Enter start delay', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => '1000',
				"default" 		=> '1000'
			]
		);		
		$this->add_control(
			'cursor_char',
			[
				'label' => __( 'Enter cursor character', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => '|',
				"default" 		=> '|'
			]
		);		
		$this->add_control(
			'ani_loop',
			[
				'label' => __( 'Enter animate loop', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'true',
				'options' => [
					'true' => __( 'True', 'classic-elementor-addons-pro' ),
					'false' => __( 'False', 'classic-elementor-addons-pro' )
				]
			]
		);				
		$this->end_controls_section();
		
		//Style Section
		$this->start_controls_section(
			"style_section",
			[
				"label"			=> esc_html__( "Style", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_STYLE,
				"description"	=> esc_html__( "Normal style options here available.", 'classic-elementor-addons-pro' ),
			]
		);
		
		$this->start_controls_tabs( 'text_colors' );
		$this->start_controls_tab(
			'text_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		
		$this->add_control(
			"title_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the title color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-animate-title' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->end_controls_tab();
		$this->start_controls_tab(
			'text_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		
		$this->add_control(
			"title_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the title hover color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-animate-title:hover' => 'color: {{VALUE}};',
				]
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();	
		
		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__( 'Title Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-animate-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'spacing',
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
					'{{WRAPPER}} .cea-animate-title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);
		$this->add_responsive_control(
			'animated_align',
			[
				'label' => __( 'Alignment', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => __( 'Left', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'classic-elementor-addons-pro' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cea-animated-text-inner' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'animated_typography',
				'selector' 		=> '{{WRAPPER}} .cea-animate-title'
			]
		);	
		
		$this->end_controls_section();
		
		//Animated Style Section
		$this->start_controls_section(
			"animated_style_section",
			[
				"label"			=> esc_html__( "Animated Text Style", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_STYLE,
				"description"	=> esc_html__( "Animated text style options here available.", 'classic-elementor-addons-pro' ),
			]
		);
		
		$this->start_controls_tabs( 'animated_colors' );
		$this->start_controls_tab(
			'animated_colors_normal',
			[
				'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
			]
		);
		
		$this->add_control(
			"animate_color",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Animated Text", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put animated text color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-animate-title > span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			"animate_bg",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Animated Background", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put animated background color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-animate-title > span' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->start_controls_tab(
			'animated_colors_hover',
			[
				'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
			]
		);
		
		$this->add_control(
			"animate_hcolor",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Animated Text Hover", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put animated text color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-animate-title:hover > span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			"animate_hbg",
			[
				"type"			=> Controls_Manager::COLOR,
				"label"			=> esc_html__( "Animated Background Hover", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put animated background hover color.", 'classic-elementor-addons-pro' ),
				"default" 		=> "",
				'selectors' => [
					'{{WRAPPER}} .cea-animate-title:hover > span' => 'background-color: {{VALUE}};',
				],
			]
		);
		
		$this->end_controls_tab();
		$this->end_controls_tabs();
		
		$this->add_control(
			'animated_padding',
			[
				'label' => esc_html__( 'Animated Text Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .cea-animate-title .cea-typing-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'animated_text_typography',
				'selector' 		=> '{{WRAPPER}} .cea-animate-title .cea-typing-text'
			]
		);					
		$this->end_controls_section();

	}

	/**
	 * Render Animated Text widget output on the frontend.
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
		
		$class = isset( $settings['animate_style'] ) && $settings['animate_style'] != '' ? ' cea-fancytext-' . $settings['animate_style'] : '';
		
		?>
		
		<div class="elementor-widget-container cea-animated-text-elementor-widget<?php echo esc_attr( $class ); ?>">
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
	 
	protected function render() {

		$settings = $this->get_settings_for_display();

		$heading_tag = isset( $settings['heading_tag'] ) ? $settings['heading_tag'] : 'h3';
		$pre_title = isset( $settings['pre_title'] ) ? $settings['pre_title'] : '';	
		$post_title = isset( $settings['post_title'] ) ? $settings['post_title'] : '';	
		
		$typespeed = isset( $settings['typespeed'] ) ? $settings['typespeed'] : '100';
		$backspeed = isset( $settings['backspeed'] ) ? $settings['backspeed'] : '100';
		$backdelay = isset( $settings['backdelay'] ) ? $settings['backdelay'] : '1000';
		$startdelay = isset( $settings['startdelay'] ) ? $settings['startdelay'] : '1000';
		$cursor_char = isset( $settings['cursor_char'] ) ? $settings['cursor_char'] : '|';
		$ani_loop = isset( $settings['ani_loop'] ) ? $settings['ani_loop'] : 'true';
		
		$animated_text = []; $first_text = '';
		foreach( $settings['ani_text_list'] as $index => $item ){
			if( !empty( $item['ani_text'] ) ){
				$first_text = empty( $first_text ) ? $item['ani_text'] : '';
				$animated_text[] = $item['ani_text'];
			};
		}
		$ani_text = !empty( $animated_text ) ? implode( ",", $animated_text ) : '';
		$first_text = explode( ",", $ani_text );
		$first_text = isset( $first_text[0] ) ? $first_text[0] : '';
		
		$this->add_render_attribute( 'typing_text', 'class', 'cea-typing-text' );
		$this->add_render_attribute( 'typing_text', 'data-typing', $ani_text );
		$this->add_render_attribute( 'typing_text', 'data-typespeed', $typespeed );
		$this->add_render_attribute( 'typing_text', 'data-backspeed', $backspeed );
		$this->add_render_attribute( 'typing_text', 'data-backdelay', $backdelay );
		$this->add_render_attribute( 'typing_text', 'data-startdelay', $startdelay );
		$this->add_render_attribute( 'typing_text', 'data-loop', $ani_loop );
		$this->add_render_attribute( 'typing_text', 'data-char', $cursor_char );

		echo '<div class="cea-animated-text-inner">';

			echo '<'. esc_attr( $heading_tag ) .' class="cea-animate-title">';
				echo !empty( $pre_title ) ? esc_html( $pre_title ) : '';
				echo ' <span '. $this->get_render_attribute_string( 'typing_text' ) .'>'. esc_html( $first_text ) .'</span>';
				echo !empty( $post_title ) ? esc_html( $post_title ) : '';
			echo '</'. esc_attr( $heading_tag ) .'>';

		echo '</div>';

	}

}