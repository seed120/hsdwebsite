<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;

/**
 * Classic Elementor Addon Image grid
 *
 * @since 1.0.0
 */
 
class CEA_Elementor_Image_Grid_Widget extends Widget_Base {
	
	/**
	 * Get widget name.
	 *
	 * Retrieve Image grid widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return "ceaimagegrid";
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Image grid widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( "Image Grid", 'classic-elementor-addons-pro' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Image grid widget icon.
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
     * Retrieve the list of keywords that used to search for Image Grid widget
     * 
     * @access public
     * 
     * @return array Widget Keywords
     */
    public function get_keywords(): array {
        return [ 'zozo', 'cea', 'image', 'grid', 'classic' ];
    }

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Image grid widget belongs to.
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
		return [ 'magnific-popup', 'owl-carousel' ];
	}
	
	/**
	 * Register Image grid widget controls.
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
			"grid_cols",
			[
				"label"			=> esc_html__( "Image Grid Columns", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "This grid option using to divide columns as per given numbers. This option active only when slide inactive otherwise slide columns only focus to divide.", 'classic-elementor-addons-pro' ),
				"default"		=> "3",
				"options"		=> [
					"12"	=> esc_html__( "1 Column", 'classic-elementor-addons-pro' ),
					"6"		=> esc_html__( "2 Columns", 'classic-elementor-addons-pro' ),
					"4"		=> esc_html__( "3 Columns", 'classic-elementor-addons-pro' ),
					"3"		=> esc_html__( "4 Columns", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->add_control(
			"image_grid_style",
			[
				"label"			=> esc_html__( "Image Grid Style", 'classic-elementor-addons-pro' ),
				"type"			=> Controls_Manager::SELECT,
				"description"	=> esc_html__( "Choose image grid style.", 'classic-elementor-addons-pro' ),
				"default"		=> "1",
				"options"		=> [
					"1"	=> esc_html__( "Style 1", 'classic-elementor-addons-pro' ),
					"2"	=> esc_html__( "Style 2", 'classic-elementor-addons-pro' ),
					"3"	=> esc_html__( "Style 3", 'classic-elementor-addons-pro' )
				]
			]
		);
		$this->end_controls_section();
		
		//Image Section
		$this->start_controls_section(
			"image_section",
			[
				"label"	=> esc_html__( "Image", 'classic-elementor-addons-pro' ),
				"tab"	=> Controls_Manager::TAB_CONTENT,
				"description"	=> esc_html__( "Image options available here.", 'classic-elementor-addons-pro' ),
			]
		);
		$this->add_control(
			"gallery",
			[
				"label"		=> esc_html__( "Add Images", 'classic-elementor-addons-pro' ),
				"type"		=> Controls_Manager::GALLERY,
				"default"	=> [],
			]
		);	
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);
		$this->add_control(
			"light_box",
			[
				"label" 		=> esc_html__( "Image Light Box", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for active/inactive image light box.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
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
				"description"	=> esc_html__( "This is option for blog slider pagination.", 'classic-elementor-addons-pro' ),
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
		$this->end_controls_section();
		
		// Style General Section
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'General', 'classic-elementor-addons-pro' ),
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
					'{{WRAPPER}} .image-grid-wrapper' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'outer_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .image-grid-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'outer_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .image-grid-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
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
		$this->add_responsive_control(
			'img_padding',
			[
				'label' => esc_html__( 'Outer Spacing', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .image-grid-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'img_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .image-grid-inner img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
				[
					'name' => 'img_border',
					'label' => esc_html__( 'Border', 'classic-elementor-addons-pro' ),
					'selector' => '{{WRAPPER}} .image-grid-inner img'
				]
		);
		$this->add_responsive_control(
			'img_radius',
			[
				'label' => esc_html__( 'Radius', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .image-grid-inner img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->end_controls_section();
		
		// Style Caption Section
		$this->start_controls_section(
			'section_style_caption',
			[
				'label' => __( 'Caption', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"caption_opt",
			[
				"label" 		=> esc_html__( "Image Caption Option", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for show image caption if exists.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_responsive_control(
			'text_align',
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
					'{{WRAPPER}} .img-caption-txt' => 'text-align: {{VALUE}};',
				],
				"condition" 	=> [
					"caption_opt" 		=> "yes"
				]
			]
		);
		$this->add_control(
			'caption_color',
			[
				'label' => esc_html__( 'Color', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .img-caption-txt' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'caption_margin',
			[
				'label' => esc_html__( 'Margin', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .img-caption-txt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_responsive_control(
			'caption_padding',
			[
				'label' => esc_html__( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .img-caption-txt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'caption_typography',
				'selector' 		=> '{{WRAPPER}} .img-caption-txt'
			]
		);	
		$this->end_controls_section();
		
		// Style Tilt Section
		$this->start_controls_section(
			'section_style_tilt',
			[
				'label' => __( 'Tilt', 'classic-elementor-addons-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			"tilt_opt",
			[
				"label" 		=> esc_html__( "Tilt Option", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for enable tilt animation option.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->add_control(
			'max_tilt',
			[
				'label' => esc_html__( 'maxTilt', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 20
			]
		);
		$this->add_control(
			'perspective',
			[
				'label' => esc_html__( 'Perspective', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 500
			]
		);
		$this->add_control(
			'tilt_scale',
			[
				'label' => esc_html__( 'Scale', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 1.1
			]
		);
		$this->add_control(
			'tilt_speed',
			[
				'label' => esc_html__( 'Speed', 'classic-elementor-addons-pro' ),
				'type' => Controls_Manager::TEXT,
				'default' => 400
			]
		);
		$this->add_control(
			"tilt_transition",
			[
				"label" 		=> esc_html__( "Tilt Transition", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "This is option for tilt transition.", 'classic-elementor-addons-pro' ),
				"type" 			=> Controls_Manager::SWITCHER,
				"default" 		=> "no"
			]
		);
		$this->end_controls_section();	
	
	}
	
	/**
	 * Render Image Grid widget output on the frontend.
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
		$class = isset( $image_grid_style ) && $image_grid_style != '' ? ' image-grid-'. $image_grid_style : '';
		$cols = isset( $grid_cols ) ? $grid_cols : 12;
		$caption_opt = isset( $caption_opt ) && $caption_opt == 'yes' ? true : false;
		$light_box = isset( $light_box ) && $light_box == 'yes' ? true : false;	
		$class .= $light_box ? ' image-gallery' : '';	
		$thumb_size = $settings[ 'thumbnail_size' ];
		$image_sizes = get_intermediate_image_sizes();

		$slide_opt = isset( $slide_opt ) && $slide_opt == 'yes' ? true : false;
		if( $slide_opt ){
			$gal_atts = array(
				'data-loop="'. ( isset( $slide_item_loop ) && $slide_item_loop == 'yes' ? 1 : 0 ) .'"',
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
		
		$this->add_render_attribute( 'cea-igrid-tilt', 'class', 'image-grid-inner' );
		if( $tilt_opt ){
			$this->add_render_attribute( 'cea-igrid-tilt', 'class', 'cea-tilt' );
			$this->add_render_attribute( 'cea-igrid-tilt', 'data-tilt_trans', $tilt_transition );
			$this->add_render_attribute( 'cea-igrid-tilt', 'data-max_tilt', $max_tilt );
			$this->add_render_attribute( 'cea-igrid-tilt', 'data-tilt_perspective', $perspective );
			$this->add_render_attribute( 'cea-igrid-tilt', 'data-tilt_scale', $tilt_scale );
			$this->add_render_attribute( 'cea-igrid-tilt', 'data-tilt_speed', $tilt_speed );
		}
		
		if( isset( $gallery ) ){
						
			echo'<div class="image-grid-wrapper'. esc_attr( $class ) .'">';
				$row_stat = 0;
				
				//Image Grid Slide
				if( $slide_opt ) echo'<div class="cea-carousel owl-carousel" '. ( $data_atts ) .'>';

					foreach( $gallery as $image ){
						
						$image_id = $image['id'];
						
						if( $row_stat == 0 && $slide_opt != '1' ) :
							echo'<div class="row">';
						endif;
					
						//Image Grid Slide
						if( $slide_opt ) echo'<div class="item">';
						
							if( !$slide_opt ){
								$col_class = "col-lg-". absint( $cols );
								$col_class .= " " . ( $cols == 3 ? "col-md-6" : "col-md-". absint( $cols ) );
								echo '<div class="'. esc_attr( $col_class ) .'">';
							}
								echo'<div '. $this->get_render_attribute_string( 'cea-igrid-tilt' ) .'>';
																	
									$img_out = '';
									$image_alt = get_post_meta( absint( $image_id ), '_wp_attachment_image_alt', true);
									$image_alt = $image_alt == '' ? esc_html__( 'Image', 'classic-elementor-addons-pro' ) : $image_alt;
									if( in_array( $thumb_size, $image_sizes ) ){
										$images = wp_get_attachment_image_src( $image_id, $thumb_size, true );
										$img_out = '<img class="img-fluid" src="'. esc_url( $images[0] ) .'" width="'. esc_attr( $images[1] ) .'" height="'. esc_attr( $images[1] ) .'" alt="'. esc_attr( $image_alt ) .'" />';
									}else{
										$image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'thumbnail', $settings );
										$img_out = '<img class="img-fluid test" src="'. esc_url( $image_src ) .'" alt="'. esc_attr( $image_alt ) .'" />';
									}
									
									
									
									if( $light_box ){
										$img_src = wp_get_attachment_image_src( $image_id, 'large', true );
										echo '<a href="#" data-mfp-src="'. esc_url( $img_src[0] ) .'" class="image-gallery-link">';
									}
									echo ''. $img_out;
									if( $light_box ) echo '</a>'; // light box if active
								if( $caption_opt ){
									$image_caption = wp_get_attachment_caption( absint( $image_id ) );
									if( $image_caption ){
										echo '<div class="img-caption-txt">'. esc_html( $image_caption ) .'</div>';						
									}
								}
									
								echo'</div><!-- .image-grid-inner -->';
							if( !$slide_opt ) echo'</div><!-- .cols -->';
						
						//Team Slide Item End
						if( $slide_opt ) echo'</div><!-- .item -->';		
						
						$row_stat++;
						if( $row_stat == ( 12/ $cols ) && $slide_opt != '1' ) :
							echo'</div><!-- .row -->';
							$row_stat = 0;
						endif;
					}
					
				//Image Grid Slide End
				if( $slide_opt ) echo'</div><!-- .owl-carousel -->';
				
			echo'</div><!-- .image-grid-wrapper -->';
			
		}
		

	}
		
}