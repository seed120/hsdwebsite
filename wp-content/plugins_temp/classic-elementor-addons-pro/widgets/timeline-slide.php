<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Classic Elementor Addon Timeline Slide
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Timeline_Slide_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Timeline Slide widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceatimelineslide";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Timeline Slide widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Timeline Slide", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Timeline Slide widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return "cea-default-icon ti-layout-slider";
	}

	/**
     * Get Keywords
     *
     * Retrieve the list of keywords that used to search for Timeline Slide widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'timeline', 'slide', 'classic' ];
    }


	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Timeline Slide widget belongs to.
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
		return [ 'cea-timeline', 'cea-custom-front' ];
	}


	/**
	 * Register Timeline Slide widget controls.
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
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Default icon list options.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"line_distance",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Event Line Distance", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for timeline event line distance. If you use timeline for years make distance volume low.", 'classic-elementor-addons-pro' ),
				"default" 		=> "60",
			]
		);	
		$this->end_controls_section();
		
		//Timeline Section
		$this->start_controls_section(
			"timeline_section",
			[
				"label"			=> esc_html__( "Timeline", 'classic-elementor-addons-pro' ),
				"tab"			=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Timeline options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		
		$repeater = new Repeater();		
		$repeater->add_control(
			"timeline_date",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Timeline Date", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the timeline date. Must follow the date format dd/mm/yyyy. Example 16/01/2014", 'classic-elementor-addons-pro' ),
				"default"		=> ""
			]
		);
		$repeater->add_control(
			"timeline_separator",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Timeline Separator Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the timeline separator title.", 'classic-elementor-addons-pro' ),
				"default"		=> ""
			]
		);
		$repeater->add_control(
			"timeline_title",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Timeline Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the timeline title.", 'classic-elementor-addons-pro' ),
				"default"		=> ""
			]
		);
		$repeater->add_control(
			"timeline_subtitle",
			[
				"type"			=> Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Timeline Sub Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here you can put the timeline sub title.", 'classic-elementor-addons-pro' ),
				"default"		=> ""
			]
		);
		$repeater->add_control(
			"tl_content",
			[
				"type"			=> Controls_Manager::TEXTAREA,
				"label"			=> esc_html__( "Content", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "You can give the feature box content here. HTML allowed here.", 'classic-elementor-addons-pro' ),
				"default" 		=> ""
			]
		);
		$this->add_control(
			"timeline_settings",
			[
				"label"			=> esc_html__( "Timeline Setting", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is options for timeline.", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::REPEATER,
				"fields"		=> $repeater->get_controls(),
				"default"		=> [
					[
						"timeline_title" 	=> esc_html__( "History", 'classic-elementor-addons-pro' ),
						"timeline_date"		=> "01/01/2012",
						"timeline_separator"=> esc_html__( "01 Jan", 'classic-elementor-addons-pro' ),
						"timeline_subtitle"	=> esc_html__( "1st January, 2012", 'classic-elementor-addons-pro' ),
						"tl_content"		=> esc_html__( "Lorem ipsum dolor sit amet, consectetur adipiscing elit.", 'classic-elementor-addons-pro' ),
					]
				],
				"title_field"	=> "{{{ timeline_title }}}",
			]
		);
		
		$this->end_controls_section();
		
		// Style Timeline Section
		$this->start_controls_section(
			'section_style_timeline',
			[
				'label' => __( 'Timeline', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'timeline_color',
			[
				'label' => esc_html__( 'Timeline Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper' => 'color: {{VALUE}};'
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
					'{{WRAPPER}} .timeline-wrapper' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'timeline_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'timeline_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .timeline-wrapper'
			]
		);
		$this->add_control(
			'timeline_options',
			[
				'label' => __( 'Timeline Date', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'timeline_line_color',
			[
				'label' => esc_html__( 'Line Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .cd-horizontal-timeline .filling-line' => 'background-color: {{VALUE}};',
					
				]
			]
		);
		$this->add_control(
			'timeline_line_dot_color',
			[
				'label' => esc_html__( 'Line Dot Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .cd-horizontal-timeline .events a.selected:after' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
					
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'times_typography',
				'selector' 		=> '{{WRAPPER}} .timeline-wrapper .timeline',
			]
		);
		$this->add_control(
			'timeline_title',
			[
				'label' => __( 'Timeline Title', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'timeline_title_color',
			[
				'label' => esc_html__( 'Timeline Title Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .events-content > ul > li > h2' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_title_typography',
				'selector' 		=> '{{WRAPPER}} .timeline-wrapper .events-content > ul > li > h2',
			]
		);
		$this->add_control(
			'timeline_subtitle',
			[
				'label' => __( 'Timeline Sub Title', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'timeline_subtitle_color',
			[
				'label' => esc_html__( 'Timeline Sub Title Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .events-content > ul > li > em' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'timeline_separator',
			[
				'label' => __( 'Timeline Separator', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'timeline_separator_color',
			[
				'label' => esc_html__( 'Timeline Separator Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .events-wrapper .events a' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_separator_typography',
				'selector' 		=> '{{WRAPPER}} .timeline-wrapper .events-wrapper .events a',
			]
		);
		$this->end_controls_section();
			
	}
	
	/**
	 * Render Timeline Slide widget output on the frontend.
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
		$class = isset( $extra_class ) && $extra_class != '' ? $extra_class : ''; 
		$distance = isset( $line_distance ) && $line_distance != '' ? absint( $line_distance ) : '60'; 
		
		echo '<div class="timeline-wrapper'. esc_attr( $class ) .'">';
		
		// All Timeline Items
		$tl_items =  isset( $timeline_settings ) ? $timeline_settings : array();// $tl_items is timeline items
		if( !empty( $tl_items ) ):
		
			$tl_header = $tl_slide = '';
			$sel_stat = 0;
			foreach( $tl_items as $tlitem ) {
				
				//timeline_separator, timeline_title, timeline_subtitle, tl_content
				$tl_date = isset( $tlitem['timeline_date'] ) ? $tlitem['timeline_date'] : '';
				$tl_separator = isset( $tlitem['timeline_separator'] ) ? $tlitem['timeline_separator'] : '';
				$tl_title = isset( $tlitem['timeline_title'] ) ? $tlitem['timeline_title'] : '';
				$tl_subtitle = isset( $tlitem['timeline_subtitle'] ) ? $tlitem['timeline_subtitle'] : '';
				$tl_content = isset( $tlitem['tl_content'] ) ? $tlitem['tl_content'] : '';
				$sel_class = '';
				if( !$sel_stat ){
					$sel_class = 'selected';
					$sel_stat = 1;
				}
				
				$tl_header .= '<li><a href="#" data-date="'. esc_attr( $tl_date ) .'" class="'. esc_attr( $sel_class ) .'">'. esc_html( $tl_separator ) .'</a></li>';
				$tl_slide .= '<li class="'. esc_attr( $sel_class ) .'" data-date="'. esc_attr( $tl_date ) .'">
					<h2>'. esc_html( $tl_title ) .'</h2>
					<em>'. esc_html( $tl_subtitle ) .'</em>
					<div class="testimoanial-content">'. wp_kses_post( $tl_content ) .'</div>
				</li>';
				
			}
		
			echo '<div class="cd-horizontal-timeline" data-distance="'. esc_attr( $distance ) .'">';
				echo '<div class="timeline">
					<div class="events-wrapper">
						<div class="events">
							<ul>'. $tl_header .'</ul>

							<span class="filling-line" aria-hidden="true"></span>
						</div> <!-- .events -->
					</div> <!-- .events-wrapper -->
						
					<ul class="cd-timeline-navigation">
						<li><a href="#" class="prev inactive"></a></li>
						<li><a href="#" class="next"></a></li>
					</ul> <!-- .cd-timeline-navigation -->
				</div> <!-- .timeline -->

				<div class="events-content">
					<ul>'. $tl_slide .'</ul>
				</div><!-- .events-content -->';				
			echo '</div><!-- .cd-horizontal-timeline -->';
			
		endif;
							
		echo '</div><!-- .timeline-wrapper -->';
		

	}
		
}