<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Classic Elementor Addon Day Counter
 *
 * @since 1.0.0
 */
 
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
 
class CEA_Elementor_Day_Counter_Widget extends Widget_Base {
	
	private $excerpt_len;
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Blog widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceadaycounter";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Blog widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Day Counter", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Blog widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-timer";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Day Counter widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'day', 'counter', 'classic' ];
    }

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Day Counter widget belongs to.
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
		return [ 'countdown', 'cea-custom-front'  ];
	}

	/**
	 * Register Day Counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//General Section
		$this->start_controls_section(
			"day_counter_section",
			[
				"label"	=> esc_html__( "Day Counter", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default day counter options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"date",
			[
				"type"			=> Controls_Manager::DATE_TIME,
				"label"			=> esc_html__( "Date", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you put the day counter date. Date format should be YYYY-mm-dd HH:ii", 'classic-elementor-addons-pro' ),
				"default" 		=> date( "Y-m-d", strtotime( "+ 1 day" ) )
			]
		);
		$this->add_control(
			"counter_items",
			[
				"label"				=> "Day Counter Items",
				"description"		=> esc_html__( "This is settings for day counter custom layout. here you can set your own layout. Drag and drop needed services items to Enabled part.", 'classic-elementor-addons-pro' ),
				"type"				=> "dragdrop",
				"ddvalues" 			=> [ 
					esc_html__( "Enabled", 'classic-elementor-addons-pro' ) => [
						"day"	=> esc_html__( "Days", 'classic-elementor-addons-pro' ),
						"hour"	=> esc_html__( "Hours", 'classic-elementor-addons-pro' ),
						"min"	=> esc_html__( "Minutes", 'classic-elementor-addons-pro' ),
						"sec"	=> esc_html__( "Seconds", 'classic-elementor-addons-pro' )
					],
					esc_html__( "disabled", 'classic-elementor-addons-pro' ) => [
						"week"	=> esc_html__( "Weeks", 'classic-elementor-addons-pro' )
					]
				]
			]
		);
		$this->end_controls_section();
		
		//Layouts Section
		$this->start_controls_section(
			"layouts_section",
			[
				"label"			=> esc_html__( "Layouts", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Day day counter options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
				'label' => esc_html__( 'Alignment', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::CHOOSE,
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
					'{{WRAPPER}} .day-counter-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			"variation",
			[
				"label"			=> esc_html__( "Day Counter Layout", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"default"		=> "default",
				"options"		=> [
					"default"		=> esc_html__( "Default", 'classic-elementor-addons-pro' ),
					"classic"		=> esc_html__( "Classic", 'classic-elementor-addons-pro' ),
					"modern"		=> esc_html__( "Modern", 'classic-elementor-addons-pro' ),
					"classic-pro"	=> esc_html__( "Classic Pro", 'classic-elementor-addons-pro' ),
				]
			]
		);
		
		$this->add_control(
			"counter_shape",
			[
				"label"			=> esc_html__( "Day Counter Shape", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"description"		=> esc_html__( "This is option for counter shape.", 'classic-elementor-addons-pro' ),
				"default"		=> "rounded-circle",
				"options"		=> [
					"rounded-0"			=> esc_html__( "Square", 'classic-elementor-addons-pro' ),
					"rounded"			=> esc_html__( "Round", 'classic-elementor-addons-pro' ),
					"rounded-circle"	=> esc_html__( "Circle", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->end_controls_section();
		
		//Labels Section
		$this->start_controls_section(
			"labels_section",
			[
				"label"			=> esc_html__( "Labels", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Labels section.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"day_label",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Days Label", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you set the days label for counter date.", 'classic-elementor-addons-pro' ),
				"default" 		=> esc_html__( "Days", 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			"hour_label",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Hours Label", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you set the hours label for counter date.", 'classic-elementor-addons-pro' ),
				"default" 		=> esc_html__( "Hours", 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			"min_label",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Minutes Label", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you set the minutes label for counter date.", 'classic-elementor-addons-pro' ),
				"default" 		=> esc_html__( "Minutes", 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			"sec_label",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Seconds Label", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you set the seconds label for counter date.", 'classic-elementor-addons-pro' ),
				"default" 		=> esc_html__( "Seconds", 'classic-elementor-addons-pro' )
			]
		);
		$this->add_control(
			"week_label",
			[
				"type"			=> Controls_Manager::TEXT,
				"label"			=> esc_html__( "Weeks Label", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you set the weeks label for counter date.", 'classic-elementor-addons-pro' ),
				"default" 		=> esc_html__( "Weeks", 'classic-elementor-addons-pro' )
			]
		);
		$this->end_controls_section();
		
		// Style General Section
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'General', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'counter_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .day-counter-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'counter_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .day-counter-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->start_controls_tabs( 'general_styles' );
			$this->start_controls_tab(
				'general_normal',
				[
					'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'font_color',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'bg_color',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'general_hover',
				[
					'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'font_hcolor',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_SECONDARY,
					],
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper:hover' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'bg_hcolor',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper:hover' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->end_controls_tab();	
		$this->end_controls_tabs();
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' =>  esc_html__( "Typography", 'classic-elementor-addons-pro' ),
				'name' 			=> 'dc_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' 		=> '{{WRAPPER}} .day-counter-wrapper'
			]
		);
		$this->end_controls_section();
		
		// Style Day Counter Section
		$this->start_controls_section(
			'section_style_dc',
			[
				'label' => __( 'Day Counter', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'dc_size',
			[
				'label' => esc_html__( 'Box Size', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 150,
				],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .day-counter-wrapper .day-counter > div' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .day-counter-wrapper .day-counter > div' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'dc_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .day-counter-wrapper .day-counter > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'dc_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .day-counter-wrapper .day-counter > div' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->start_controls_tabs( 'dc_styles' );
			$this->start_controls_tab(
				'dc_normal',
				[
					'label' => esc_html__( 'Normal', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'dc_timer_color',
				[
					'label' => esc_html__( 'Timer Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper .counter-item h3' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'dc_font_color',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper .day-counter > div' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'dc_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_SECONDARY,
					],
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper .day-counter > div' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"dc_shadow_opt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", 'classic-elementor-addons-pro' ),
					"description"	=> esc_html__( "This is option for show box shadow on counter box hover.", 'classic-elementor-addons-pro' ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"dc_box_shadow",
				[
					"label" 		=> esc_html__( "Box Shadow", 'classic-elementor-addons-pro' ),
					"description"	=> esc_html__( "This is option for show box shadow on day counter box hover.", 'classic-elementor-addons-pro' ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'dc_shadow_opt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper .day-counter > div' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{dc_box_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"dc_box_shadow_pos",
				[
					'label' =>  esc_html__( "Box Shadow Position", 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						' ' => esc_html__( "Outline", 'classic-elementor-addons-pro' ),
						'inset' => esc_html__( "Inset", 'classic-elementor-addons-pro' ),
					],
					'condition' => [
						'dc_shadow_opt' => 'yes',
					],
					'default' => ' ',
					'render_type' => 'ui',
				]
			);
			$this->end_controls_tab();
			$this->start_controls_tab(
				'dc_hover',
				[
					'label' => esc_html__( 'Hover', 'classic-elementor-addons-pro' ),
				]
			);
			$this->add_control(
				'dc_timer_hcolor',
				[
					'label' => esc_html__( 'Timer Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'default' => '',
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper .day-counter > div:hover h3' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'dc_font_hcolor',
				[
					'label' => esc_html__( 'Font Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_SECONDARY,
					],
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper .day-counter > div:hover' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'dc_bg_hcolor',
				[
					'label' => esc_html__( 'Background Color', 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::COLOR,
					'global' => [
						'default' => Global_Colors::COLOR_PRIMARY,
					],
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper .day-counter > div:hover' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				"dc_shadow_hopt",
				[
					"label" 		=> esc_html__( "Box Shadow Enable", 'classic-elementor-addons-pro' ),
					"description"	=> esc_html__( "This is option for show box shadow on day counter box hover.", 'classic-elementor-addons-pro' ),
					"type" 			=> Controls_Manager::SWITCHER,
					"default" 		=> "no"
				]
			);
			$this->add_control(
				"dc_hbox_shadow",
				[
					"label" 		=> esc_html__( "Hover Box Shadow", 'classic-elementor-addons-pro' ),
					"description"	=> esc_html__( "This is option for show box shadow on dat counter box hover.", 'classic-elementor-addons-pro' ),
					"type" 			=> Controls_Manager::BOX_SHADOW,
					'condition' => [
						'dc_shadow_hopt' => 'yes',
					],
					'selectors' => [
						'{{WRAPPER}} .day-counter-wrapper .day-counter > div:hover' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{dc_hbox_shadow_pos.VALUE}};',
					]
				]
			);
			$this->add_control(
				"dc_hbox_shadow_pos",
				[
					'label' =>  esc_html__( "Box Shadow Position", 'classic-elementor-addons-pro' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						' ' => esc_html__( "Outline", 'classic-elementor-addons-pro' ),
						'inset' => esc_html__( "Inset", 'classic-elementor-addons-pro' ),
					],
					'condition' => [
						'dc_shadow_hopt' => 'yes',
					],
					'default' => ' ',
					'render_type' => 'ui',
				]
			);
			$this->end_controls_tab();	
		$this->end_controls_tabs();
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' =>  esc_html__( "Timer Typography", 'classic-elementor-addons-pro' ),
				'name' 			=> 'dc_timer_typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector' 		=> '{{WRAPPER}} .day-counter-wrapper .counter-item h3'
			]
		);				
		$this->end_controls_section();

	}
	
	/**
	 * Render Day Counter widget output on the frontend.
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

		$class = isset( $variation ) ? ' day-counter-' . $variation : '';
		$default_items = array( 
			"day"	=> esc_html__( "Days", 'classic-elementor-addons-pro' ),
			"hour"	=> esc_html__( "Hours", 'classic-elementor-addons-pro' ),
			"min"	=> esc_html__( "Minutes", 'classic-elementor-addons-pro' ),
			"sec"	=> esc_html__( "Seconds", 'classic-elementor-addons-pro' )
		);
		$elements = isset( $counter_items ) && !empty( $counter_items ) ? json_decode( $counter_items, true ) : array( 'Enabled' => $default_items );
		$class .= count( $elements['Enabled'] ) ? ' counter-field-' . count( $elements['Enabled'] ) : '';
		
		?>
		
		<div class="elementor-widget-container day-counter-wrapper<?php echo esc_attr( $class ); ?>" >
		
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
	 * Render Day Counter widget output on the frontend.
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
		$date = isset( $date ) ? $date : '';		
		$default_items = array( 
			"day"	=> esc_html__( "Days", 'classic-elementor-addons-pro' ),
			"hour"	=> esc_html__( "Hours", 'classic-elementor-addons-pro' ),
			"min"	=> esc_html__( "Minutes", 'classic-elementor-addons-pro' ),
			"sec"	=> esc_html__( "Seconds", 'classic-elementor-addons-pro' )
		);		
		$elements = isset( $counter_items ) && !empty( $counter_items ) ? json_decode( $counter_items, true ) : array( 'Enabled' => $default_items );		
		$shape_class = isset( $counter_shape ) ? ' ' . $counter_shape : '';	

		echo '<div class="day-counter" data-date="'. esc_attr( $date ) .'">';		
			if( isset( $elements['Enabled'] ) && !empty( $elements['Enabled'] ) ) :
				foreach( $elements['Enabled'] as $element => $value ){					
					switch( $element ){
						
						case "day":
							$day_label = isset( $day_label ) ? $day_label : '';
							echo '<div class="counter-day'. esc_attr( $shape_class ) .'">';
								echo '<div class="counter-item">';
									echo '<h3></h3>';
									echo '<span>'. esc_html( $day_label ) .'</span>';
								echo '</div>';
							echo '</div><!-- .counter-day -->';		
						break;
					
						case "hour":
							$hour_label = isset( $hour_label ) ? $hour_label : '';
							echo '<div class="counter-hour'. esc_attr( $shape_class ) .'">';
								echo '<div class="counter-item">';
									echo '<h3></h3>';
									echo '<span>'. esc_html( $hour_label ) .'</span>';
								echo '</div>';
							echo '</div><!-- .counter-hour -->';
						break;
						
						case "min":
							$min_label = isset( $min_label ) ? $min_label : '';
							echo '<div class="counter-min'. esc_attr( $shape_class ) .'">';
								echo '<div class="counter-item">';
									echo '<h3></h3>';
									echo '<span>'. esc_html( $min_label ) .'</span>';
								echo '</div>';
							echo '</div><!-- .counter-min -->';	
						break;
						
						case "sec":
							$sec_label = isset( $sec_label ) ? $sec_label : '';
							echo '<div class="counter-sec'. esc_attr( $shape_class ) .'">';
								echo '<div class="counter-item">';
									echo '<h3></h3>';
									echo '<span>'. esc_html( $sec_label ) .'</span>';
								echo '</div>';
							echo '</div><!-- .counter-sec -->';		
						break;
						
						case "week":
							$week_label = isset( $week_label ) ? $week_label : '';
							echo '<div class="counter-week'. esc_attr( $shape_class ) .'">';
								echo '<div class="counter-item">';
									echo '<h3></h3>';
									echo '<span>'. esc_html( $week_label ) .'</span>';
								echo '</div>';
							echo '</div><!-- .counter-week -->';		
						break;
						
					}					
				}
			endif;		
		echo '</div><!-- .day-counter -->';

	}
	
}