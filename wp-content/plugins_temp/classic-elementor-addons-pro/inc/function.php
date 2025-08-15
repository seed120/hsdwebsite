<?php 

if( ! function_exists('cea_star_rating') ) {
	function cea_star_rating( $rate ){
		$out = '';
		for( $i=1; $i<=5; $i++ ){
			
			if( $i == round($rate) ){
				if ( $i-0.5 == $rate ) {
					$out .= '<i class="fa fa-star-half-o"></i>';
				}else{
					$out .= '<i class="fa fa-star"></i>';
				}
			}else{
				if( $i < $rate ){
					$out .= '<i class="fa fa-star"></i>';
				}else{
					$out .= '<i class="fa fa-star-o"></i>';
				}
			}
		}// for end
		return $out;
	}
}

function cea_enqueue_custom_admin_style() {
	wp_register_style( 'cea_wp_admin_css', CEA_CORE_URL . 'assets/css/admin-style.css', false, '1.0.0' );
	wp_enqueue_style( 'cea_wp_admin_css' );
	
	//wp_register_script( 'jquery-ui', CEA_CORE_URL . 'assets/js/jqueryui.js', array( 'jquery' ), '1.12.1', true ); // old jqueryui.js
	wp_register_script( 'jquery-ui', CEA_CORE_URL . 'assets/js/jquery-ui.min.js',  array( 'jquery' ), '1.11.4', true );
	wp_register_script( 'cea_wp_admin_script', CEA_CORE_URL . 'assets/js/admin-script.js', array( 'jquery', 'jquery-ui' ), '1.0', true );
	
	$translation_array = array(
		'confirm_str' => esc_html__( 'Are you sure want to save?', 'classic-elementor-addons-pro' )
	);
	wp_localize_script( 'cea_wp_admin_script', 'cea_ajax_var', $translation_array );
	
	wp_enqueue_script( 'cea_wp_admin_script' );
		
	
}
add_action( 'admin_enqueue_scripts', 'cea_enqueue_custom_admin_style' );

function cea_excerpt_more( $more ) {
    return '..';
}

function cea_shortcode_rand_id() {
	static $shortcode_rand = 1;
	return $shortcode_rand++;
}

/*Custom Shortcodes*/
require_once( CEA_CORE_DIR . 'inc/shortcodes.php' );

/*Image Size Check*/
require_once( CEA_CORE_DIR . 'inc/aq_resizer.php' );
function cea_get_custom_size_image( $custom_size = array(), $hard_crop = false, $img_id = '' ){
	$img_sizes = $img_width = $img_height = $src = '';
	$img_stat = 0;
	$custom_img_size = '';
	
	$img_id = $img_id != '' ? $img_id : get_post_thumbnail_id( get_the_ID() );

	if( class_exists('Aq_Resize') ) {
		$src = wp_get_attachment_image_src( $img_id, "full", false, '' );
		$img_width = $img_height = '';
		if( !empty( $custom_size ) ){
			$img_width = isset( $custom_size[0] ) ? $custom_size[0] : '';
			$img_height = isset( $custom_size[1] ) ? $custom_size[1] : '';
			
			$cropped_img = aq_resize( $src[0], $img_width, $img_height, $hard_crop, false );
			if( $cropped_img ){
				$img_src = isset( $cropped_img[0] ) ? $cropped_img[0] : '';
				$img_width = isset( $cropped_img[1] ) ? $cropped_img[1] : '';
				$img_height = isset( $cropped_img[2] ) ? $cropped_img[2] : '';
			}else{
				$img_stat = 1;
			}
		}else{
			$img_stat = 1;
		}
		
	}
	if( $img_stat ){
		
		$src = wp_get_attachment_image_src( $img_id, 'large', false, '' );
		$img_src = $src[0];
		$img_width = isset( $src[1] ) ? $src[1] : '';
		$img_height = isset( $src[2] ) ? $src[2] : '';
	}
	
	return array( $img_src, $img_width, $img_height );
}

function cea_menuFaIcons(){
	$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
	$fontawesome_path = CEA_CORE_URL . 'assets/css/font-awesome.css';  
		
	$response = wp_remote_get( $fontawesome_path );
	if( is_array($response) ) {
		$file = $response['body']; // use the content
		preg_match_all($pattern, $file, $str, PREG_SET_ORDER);
		return $str;
	}
	return '';
}

function cea_menuTiIcons(){
	$pattern = '/\.(ti-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
	$ti_path = CEA_CORE_URL . 'assets/css/themify-icons.css';
		
	$response = wp_remote_get( $ti_path );
	if( is_array( $response ) ) {
		$file = $response['body']; // use the content
		preg_match_all($pattern, $file, $str, PREG_SET_ORDER);
		return $str;
	}	
	return '';
}

function cea_menu_bi_icons(){
	$pattern = '/\.(bi-(?:\w+(?:-)?)+)::before\s+{\s*content:\s*"(.+)";\s+}/';
	$bi_path = CEA_CORE_URL . 'assets/css/bootstrap-icons.css';  
		
	$response = wp_remote_get( $bi_path );
	if( is_array($response) ) {
		$file = $response['body']; // use the content
		preg_match_all($pattern, $file, $str, PREG_SET_ORDER);
		return $str;
	}
	return '';
}

// Hook the custom controls function for both sections and containers
add_action('elementor/element/section/section_typo/after_section_end', 'cea_custom_elementor_controls_section', 10, 2);
add_action('elementor/element/container/section_layout/after_section_end', 'cea_custom_elementor_controls_section', 10, 2);

// Callback function to add custom controls for sections
function cea_custom_elementor_controls_section($element, $args) {

	if (('section' === $element->get_name()) || ('container' === $element->get_name())){
		
		//Rain Drops Settings
		$element->start_controls_section(
			'section_rain_drops',
			[
				'label' => __( 'Rain Drops Settings', 'classic-elementor-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$element->add_control(
			"rd_opt",
			[
				"label" 		=> esc_html__( "Enable/Disable Rain Drops", 'classic-elementor-addons-pro' ),
				"type" 			=> \Elementor\Controls_Manager::SWITCHER,
				"label_off" 	=> esc_html__( 'Off', 'classic-elementor-addons-pro' ),
				"label_on" 		=> esc_html__( 'On', 'classic-elementor-addons-pro' ),
				"default" 		=> "no"
			]
		);
		$element->add_control(
			'rd_color',
			[
				'label' => __( 'Canvas Color', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description"	=> esc_html__( "Here you can define rain drop canvas color. Example #333333", 'classic-elementor-addons-pro' ),
				'placeholder' => "#333333",
				"default" 		=> "#333333"
			]
		);		
		$element->add_control(
			'rd_height',
			[
				'label' => __( 'Canvas Height', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description"	=> esc_html__( "Here you can define rain drop canvas height. Example 100", 'classic-elementor-addons-pro' ),
				'placeholder' => '100',
				"default" => "100"
			]
		);
		$element->add_control(
			'rd_speed',
			[
				'label' => __( 'Rain Drop Speed', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description"	=> esc_html__( "Here you can define rain drop speed. Example 0.01", 'classic-elementor-addons-pro' ),
				'placeholder' => "0.01",
				"default" 		=> "0.01"
			]
		);
		$element->add_control(
			'rd_frequency',
			[
				'label' => __( 'Rain Drop Frequency', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description"	=> esc_html__( "Here you can define rain drop frequency. Example 1", 'classic-elementor-addons-pro' ),
				'placeholder' => "1",
				"default" 		=> "1"
			]
		);
		$element->add_control(
			'rd_density',
			[
				'label' => __( 'Rain Drop Density', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description"	=> esc_html__( "Here you can define rain drop density. Example 0", 'classic-elementor-addons-pro' ),
				'placeholder' => "0",
				"default" 		=> "0"
			]
		);
		$element->add_control(
			'rd_pos',
			[
				'label' => __( 'Rain Drop Canvas Position', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					'top' 		=> __( 'Top', 'classic-elementor-addons-pro' ),
					'bottom' 	=> __( 'Bottom', 'classic-elementor-addons-pro' )
				]
			]
		);	
		$element->end_controls_section();
		
		//Floating Image Settings
		$element->start_controls_section(
			'section_float_img',
			[
				'label' => __( 'Float Image Settings', 'classic-elementor-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$element->add_control(
			"float_img_opt",
			[
				"label" 		=> esc_html__( "Float Image Option", 'classic-elementor-addons-pro' ),
				"type" 			=> \Elementor\Controls_Manager::SWITCHER,
				"label_off" 	=> esc_html__( 'Off', 'classic-elementor-addons-pro' ),
				"label_on" 		=> esc_html__( 'On', 'classic-elementor-addons-pro' ),
				"default" 		=> "no",
			]
		);
		$repeater = new \Elementor\Repeater();	
		$repeater->add_control(
			"float_title",
			[
				"type"			=> \Elementor\Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Float Image Title", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Float image title.", 'classic-elementor-addons-pro' ),
				"default"		=> "50"
			]
		);
		$repeater->add_control(
			"float_img",
			[
				"type" => \Elementor\Controls_Manager::MEDIA,
				"label" => __( "Floating Image", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose float image.", 'classic-elementor-addons-pro' ),
				"dynamic" => [
					"active" => true,
				]
			]
		);
		$repeater->add_responsive_control(
			"float_width",
			[
				"type"			=> \Elementor\Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Float Width", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Mention here float image width. Example 30", 'classic-elementor-addons-pro' ),
				"default"		=> "30"
			]
		);
		$repeater->add_responsive_control(
			"float_left",
			[
				"type"			=> \Elementor\Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Left Position", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Float image left position. Example 80", 'classic-elementor-addons-pro' ),
				"default"		=> "50"
			]
		);
		$repeater->add_responsive_control(
			"float_top",
			[
				"type"			=> \Elementor\Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Top Position", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Float image top position. Example 300", 'classic-elementor-addons-pro' ),
				"default"		=> "300"
			]
		);
		$repeater->add_control(
			"float_distance",
			[
				"type"			=> \Elementor\Controls_Manager::TEXT,
				"label" 		=> esc_html__( "Float Distance", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Float image float distance. This option only use for when you active mousemove animation Example 100", 'classic-elementor-addons-pro' ),
				"default"		=> "100"
			]
		);
		$repeater->add_control(
			'float_animation',
			[
				'label' => __( 'Float Animation', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => [
					'0'		=> __( 'None', 'classic-elementor-addons-pro' ),
					'1' 	=> __( 'Bounce', 'classic-elementor-addons-pro' ),
					'2' 	=> __( 'Slow Rotate', 'classic-elementor-addons-pro' ),
					'3' 	=> __( 'Speed Rotate', 'classic-elementor-addons-pro' )
				]
			]
		);	
		$repeater->add_control(
			"float_mouse",
			[
				"label" 		=> esc_html__( "Mouse Animation", 'classic-elementor-addons-pro' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				"default" 		=> "0",
				'options' => [
					'0'		=> __( 'Disable', 'classic-elementor-addons-pro' ),
					'1' 	=> __( 'Enable', 'classic-elementor-addons-pro' )
				]
			]
		);	
		$element->add_control(
			"float_details",
			[
				"type"			=> \Elementor\Controls_Manager::REPEATER,
				"label"			=> esc_html__( "Floating Details", 'classic-elementor-addons-pro' ),
				"fields"		=> $repeater->get_controls(),
				"default" 		=> [
					[
						"float_title" 		=> esc_html__( "Floating Image", 'classic-elementor-addons-pro' ),
						"float_img" 		=> "",
						"float_width"		=> "30",
						"float_left" 		=> "50",
						"float_top" 		=> "30",
						"float_animation" 	=> "0",
						"float_distance" 	=> "100"
					]
				],
				"title_field"	=> "{{{ float_title }}}"
			]
		);
		$element->end_controls_section();
	
		//Parallax Settings
		$element->start_controls_section(
			'section_parallax',
			[
				'label' => __( 'Parallax Settings', 'classic-elementor-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$element->add_control(
			'parallax_opt',
			[
				"label" 		=> esc_html__( "Enable/Disable Parallax", 'classic-elementor-addons-pro' ),
				"type" 			=> \Elementor\Controls_Manager::SWITCHER,
				"label_off" 	=> esc_html__( 'Off', 'classic-elementor-addons-pro'  	),
				"label_on" 		=> esc_html__( 'On', 'classic-elementor-addons-pro' ),
				"default" 		=> "no",
				"condition"		=> [
					"apply_con_parallax!" => "yes"
				]
			]
		);
		$element->add_control(
			'parallax_ratio',
			[
				'label' => __( 'Parallax Speed', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				"description"	=> esc_html__( "Here you can define parallax factor ratio. Example 2", 'classic-elementor-addons-pro' ),
				'placeholder' => "2",
				"default" 		=> "2",
				"condition" 	=> [
					"parallax_opt" 		=> "yes"
				]
			]
		);	
		$element->add_control(
			'apply_con_parallax',
			[
				'label' => esc_html__( 'Enable Content Parallax ?', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('On', 'classic-elementor-addons-pro'),
				'label_off' => esc_html__('Off', 'classic-elementor-addons-pro'),
				'default' => 'no',
				'prefix_class' => 'content-parallax-',
				'separator' => 'before',
				'condition' 	=> [
					'parallax_opt!' 		=> 'yes'
				]
			]
		);
		$element->add_control(
			'parallax_depth_no',
			[
				'label' => esc_html__( 'Enter Parallax Depth', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::NUMBER,
				'default' => 0.4,
				'description' => esc_html__( 'Here enter the Parallax Depth. It is a Floating Number between 0 to 1. Eg: 0.4', 'classic-elementor-addons-pro' ),
				'condition' => [
					'apply_con_parallax'  => 'yes',
				]
			]
		);
		$element->add_control(
			'parallax_scalar_x',
			[
				'label' => esc_html__( 'Enter ScalarX', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
				'description' => esc_html__( 'Multiplies the input motion by this value, increasing or decreasing the movement speed and range on X-axis. Eg: 10', 'classic-elementor-addons-pro' ),
				'condition' => [
					'apply_con_parallax'  => 'yes',
				]
			]
		);
		$element->add_control(
			'parallax_scalar_y',
			[
				'label' => esc_html__( 'Enter ScalarY', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
				'description' => esc_html__( 'Multiplies the input motion by this value, increasing or decreasing the movement speed and range on Y-axis. Eg: 10', 'classic-elementor-addons-pro' ),
				'condition' => [
					'apply_con_parallax'  => 'yes',
				]
			]
		);
		$element->add_control(
			'parallax_friction_x',
			[
				'label' => esc_html__( 'Enter Friction X', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::NUMBER,
				'default' => 0.4,
				'description' => esc_html__( 'Amount of friction applied to the layers in X-axis. At 1 the layers will instantly go to their new positions, everything below 1 adds some easing. Eg: 0.4', 'classic-elementor-addons-pro' ),
				'condition' => [
					'apply_con_parallax'  => 'yes',
				]
			]
		);
		$element->add_control(
			'parallax_friction_y',
			[
				'label' => esc_html__( 'Enter Friction Y', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::NUMBER,
				'default' => 0.4,
				'description' => esc_html__( 'Amount of friction applied to the layers in Y-axis. At 1 the layers will instantly go to their new positions, everything below 1 adds some easing. Eg: 0.4', 'classic-elementor-addons-pro' ),
				'condition' => [
					'apply_con_parallax'  => 'yes',
				]
			]
		);
		$element->add_control(
			'parallax_item_index',
			[
				'label' => esc_html__( 'Z-Index', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'condition' => [
					'apply_con_parallax'  => 'yes',
				]
			]
		);
		$element->add_control(
			'parallax_hover_only',
			[
				'label' => esc_html__( 'Hover Only', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => esc_html__( 'Parallax will only be in effect while the cursor is over the container, otherwise all layers move back to their initial position. Works best in combination with Relative Input.', 'classic-elementor-addons-pro' ),
				'label_on' => esc_html__('On', 'classic-elementor-addons-pro'),
				'label_off' => esc_html__('Off', 'classic-elementor-addons-pro'),
				'condition' => [
					'apply_con_parallax'  => 'yes',
				]
			]
		);
		$element->add_control(
			'parallax_img_full', 
			[
				'label' => __( 'Image Full Width Parallax', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('On', 'classic-elementor-addons-pro'),
				'label_off' => esc_html__('Off', 'classic-elementor-addons-pro'),
				'condition' => [
					'apply_con_parallax'  => 'yes',
				],
				'return_value' => 'full-width',
				'prefix_class' => 'parallax-img-',
			]
		);
		$element->add_control(
			'parallax_full_img_width', 
			[
				'label' => __( 'Image Full Width Parallax', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::NUMBER,
				'default' => 120,
				'description' => esc_html__( 'Enter the width of the Image. Enter above 120vw to avoid running into white space. Unit: vw.', 'classic-elementor-addons-pro' ),
				'condition' => [
					'parallax_img_full'  => 'full-width',
				]
			]
		);
		$element->add_control(
			'parallax_full_img_left', 
			[
				'label' => __( 'Image Left Position', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::NUMBER,
				'default' => 10,
				'description' => esc_html__( 'Enter the image position to aviod the space in the left during the Parallax. Example: 10 which means -10%. Donot add minus in front. Unit: %.', 'classic-elementor-addons-pro' ),
				'condition' => [
					'parallax_img_full'  => 'full-width',
				]
			]
		);

		$element->end_controls_section();

		// Enable Sticky
		$element->start_controls_section(
			'extended_sticky',
			[
				'label' => esc_html__('Sticky Container', 'classic-elementor-addons-pro'),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT
			]
		);

		$element->add_control(
			'apply_sticky_column',
			[
				'label' => esc_html__('Enable Sticky Column?', 'classic-elementor-addons-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('On', 'classic-elementor-addons-pro'),
				'label_off' => esc_html__('Off', 'classic-elementor-addons-pro'),
				'return_value' => 'sidebar',
				'prefix_class' => 'sticky-',
				'selectors' => [
					'{{WRAPPER}}.sticky-sidebar' => 'display: block;',
				],
				'condition' => [
					'apply_row_sticky!' => 'row'
				]
			]
		);
		
		$element->add_control(
			'apply_row_sticky',
			[
				'label' => esc_html__('Enable Sticky Row?', 'classic-elementor-addons-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('On', 'classic-elementor-addons-pro'),
				'label_off' => esc_html__('Off', 'classic-elementor-addons-pro'),
				'return_value' => 'row',
				'prefix_class' => 'sticky-',
				'selectors' => [
					'{{WRAPPER}}.sticky-row' => 'display: block;',
				],
				'condition' => [
					'apply_sticky_column!' => 'sidebar'
				]
			]
		);

		$element->add_control(
			'sticky_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'info',
				'heading' => esc_html__( 'Sticky Notice', 'classic-elementor-addons-pro' ),
				'content' => esc_html__( 'Either Column or Row can be enabled.', 'classic-elementor-addons-pro' ),
			]
		);
		$element->end_controls_section();

		$element->start_controls_section(
			'active_scroll_sticky',
			[
				'label' => esc_html__('Active Scroll Sticky', 'classic-elementor-addons-pro'),
				'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);

		$element->add_control(
			'apply_active_option',
			[
				'label' => esc_html__( 'Enable Active Scroll Sticky ?', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('On', 'classic-elementor-addons-pro'),
				'label_off' => esc_html__('Off', 'classic-elementor-addons-pro'),
				'return_value' => 'activate',
				'prefix_class' => 'auto-',
			]
		);

		$element->add_control(
			'active_notice',
			[
				'type' => \Elementor\Controls_Manager::NOTICE,
				'notice_type' => 'info',
				'heading' => esc_html__( 'Note', 'classic-elementor-addons-pro' ),
				'content' => esc_html__( 'It will work only when the Sticky Column is enabled.', 'classic-elementor-addons-pro' ),
			]
		);
		
		$element->end_controls_section();
			
		// Cursor Animations
		$element->start_controls_section(
			'container_cursor_animation',
			[
				'label' => __( 'Cursor Animation', 'classic-elementor-addons-pro' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$element->add_control(
			'enable_animation',
			[
				'label' => __('Enable Custom Cursor?', 'classic-elementor-addons-pro'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'classic-elementor-addons-pro' ),
				'label_off' => esc_html__( 'No', 'classic-elementor-addons-pro' ),
				'return_value' => 'yes',
				'prefix_class' => 'cursor-',
				'selectors' => [
					'{{WRAPPER}}.cursor-animation' => 'display: block;',
				],
			]
		);
		$element->add_control(
			'animation_type',
			[
				'label' => __( 'Cursor Animation Type', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'circle_text' => __( 'Text', 'classic-elementor-addons-pro' ),
					'icon' => __( 'Icon', 'classic-elementor-addons-pro' ),
					'image'		=> __( 'Image', 'classic-elementor-addons-pro' )
				],
				'default' => 'circle_text',
				'condition' => [
					'enable_animation' => 'yes',
				],
			]
		);
		$element->add_control(
			'cursor_text',
			[
				'label' => __( 'Cursor Text', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Hover', 'classic-elementor-addons-pro' ),
				'condition' => [
					'animation_type' => 'circle_text',
					'enable_animation' => 'yes',
				],
			]
		);
		$element->add_control(
			'cursor_text_color',
			[
				'label'	=> __( 'Color', 'classic-elementor-addons-pro' ),
				'type'	=> \Elementor\Controls_Manager::COLOR,
				'condition'	=> [
					'animation_type' 	=> 'circle_text',
					'enable_animation'	=> 'yes',
				],
				'selectors' => [
					'.elementor-element-{{ID}}.custom-cursor .cursor-text' => 'color: {{VALUE}};'
				]
			]
		);
		$element->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cursor_text_typo',
				'selector' => '.elementor-element-{{ID}}.custom-cursor .cursor-text',
				'condition'	=> [
					'animation_type' 	=> 'circle_text',
					'enable_animation'	=> 'yes',
				],
			]
		);
		// Cursor Icon 
		$element->add_control(
			'cursor_icon',
			[
				'label' => __( 'Cursor Icon', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'animation_type' => 'icon',
					'enable_animation' => 'yes',
				],
				'default' => [
            		'value' => 'fas fa-hand-point-up',
            		'library' => 'fa-solid',
        		],
			]
		);
		$element->add_control(
			'cursor_icon_size',
			[
				'label' => __( 'Icon Size', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'rem', 'em', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'rem' => [
						'min' => 0,
						'max' => 20,
					],
					'em' => [
						'min' => 0,
						'max' => 20,
					]
				],
				'condition' => [
					'animation_type' => 'icon',
					'enable_animation' => 'yes',
				],
				'selectors' => [
					'.elementor-element-{{ID}}.custom-cursor i' => 'font-size: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$element->add_control(
			'cursor_icon_color',
			[
				'label' => __( 'Icon Color', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'animation_type' => 'icon',
					'enable_animation' => 'yes',
				],
				'selectors' => [
					'.elementor-element-{{ID}}.custom-cursor i' => 'color: {{VALUE}};'
				]
			]
		);
		// Cursor Image 
		$element->add_control(
			"cursor_image",
			[
				"type" => \Elementor\Controls_Manager::MEDIA,
				"label" => __( "Cursor Image", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Choose Cursor Image.", 'classic-elementor-addons-pro' ),
				"dynamic" => [
					"active" => true,
				],
				'condition'	=> [
					'animation_type' => 'image',
					'enable_animation' => 'yes',
				],
			]
		);
		$element->add_control(
			'cursor_image_width',
			[
				'label' => __('Cursor Image Width (px)', 'classic-elementor-addons-pro'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 50,
				'condition' => [
					'enable_animation' => 'yes',
					'animation_type' => 'image',
				],
				'selectors' => [
					'.elementor-element-{{ID}}.custom-cursor img' => 'width: {{VALUE}}px; height: auto'
				]
			]
		);
		$element->add_control(
			'cursor_icon_bgcolor',
			[
				'label' => __( 'Background Color', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'enable_animation' => 'yes',
				],
				'selectors' => [
					'.elementor-element-{{ID}}.custom-cursor' => 'background-color: {{VALUE}};'
				]
			]
		);
		$element->add_responsive_control(
			'cursor_icon_padd',
			[
				'label' => __( 'Padding', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'rem', 'em'],
				'condition' => [
					'enable_animation' => 'yes',
				],
				'selectors' => [
					'.elementor-element-{{ID}}.custom-cursor' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);
		$element->add_control(
			'cursor_icon_bradius',
			[
				'label' => __( 'Border Radius', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'rem', 'em'],
				'condition' => [
					'enable_animation' => 'yes',
				],
				'selectors' => [
					'.elementor-element-{{ID}}.custom-cursor' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'.elementor-element-{{ID}}.custom-cursor img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);		
		$element->end_controls_section();

		// Horizontal Scroll
		$element->start_controls_section(
			'scroll_horizontal',
			[
				'label'  =>  esc_html__( 'Horizontal Scroll', 'classic-elementor-addons-pro' ),
				'tab'	 =>  \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);
		$element->add_control(
			'apply_scroll',
			[
				'label' =>  esc_html__( 'Apply Horizontal Scroll?', 'classic-elementor-addons-pro' ),
				'type'	=>  \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'classic-elementor-addons-pro' ),
				'label_off' => esc_html__( 'Off', 'classic-elementor-addons-pro' ),
				'return-value' => 'yes',
				'prefix_class' => 'cea-horizontal-scroll-',
			]
		);
		$element->add_control(
			'disable_hscr_mbl', 
			[
				'label' =>  esc_html__( 'Disable Horizontal Scroll on Mobile?', 'classic-elementor-addons-pro' ),
				'type'	=>  \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'classic-elementor-addons-pro' ),
				'label_off' => esc_html__( 'Off', 'classic-elementor-addons-pro' ),
				'condition'	=> [
					'apply_scroll'	=> 'yes',
				],
				'separator'	=> 'before'
			]
		);
		$element->end_controls_section();

		// Horizontal Scroll
		$element->start_controls_section(
			'list_step',
			[
				'label'  =>  esc_html__( 'List Step', 'classic-elementor-addons-pro' ),
				'tab'	 =>  \Elementor\Controls_Manager::TAB_LAYOUT,
			]
		);
		$element->add_control(
			'apply_list_step',
			[
				'label' =>  esc_html__( 'Apply List Step?', 'classic-elementor-addons-pro' ),
				'type'	=>  \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'classic-elementor-addons-pro' ),
				'label_off' => esc_html__( 'Off', 'classic-elementor-addons-pro' ),
				'return-value' => 'yes',
			]
		);
		$element->add_responsive_control(
			'section_stack_from',
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
				'condition'	=> [
					'apply_list_step'	=> 'yes',
				],
                'selectors' => [
                    '{{WRAPPER}}.list-step-section' => '--section-stack-top: {{SIZE}};'
                ]
            ]
		);
		$element->end_controls_section();

		// Scroll Text Reveal
		$element->start_controls_section(
			'container_text_reveal',
			[
				'label' => esc_html__( 'Scroll Text Reveal', 'classic-elementor-addons-pro' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$element->add_control(
			'apply_text_reveal',
			[
				'label' => esc_html__( 'Enable Text Reveal Animation?', 'classic-elementor-addons-pro' ),
				'type'  => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('On', 'classic-elementor-addons-pro'),
				'label_off' => esc_html__('Off', 'classic-elementor-addons-pro'),
				'return_value' => 'yes',
				'prefix_class' => 'text-reveal-',
			]
		);
		$element->add_control(
			"text_tag",
			[
				"label"			=> esc_html__( "Text Element Tag", 'classic-elementor-addons-pro' ),
				"description"	=> esc_html__( "Here choose which tag should be animate while scroll.", 'classic-elementor-addons-pro' ),
				"type"			=> \Elementor\Controls_Manager::SELECT,
				"default"		=> "p",
				"options"		=> [
					"h1"		=> esc_html__( "h1", 'classic-elementor-addons-pro' ),
					"h2"		=> esc_html__( "h2", 'classic-elementor-addons-pro' ),
					"h3"		=> esc_html__( "h3", 'classic-elementor-addons-pro' ),
					"h4"		=> esc_html__( "h4", 'classic-elementor-addons-pro' ),
					"h5"		=> esc_html__( "h5", 'classic-elementor-addons-pro' ),
					"h6"		=> esc_html__( "h6", 'classic-elementor-addons-pro' ),
					"p"			=> esc_html__( "p", 'classic-elementor-addons-pro' ),
				],
				"condition" => [
					'apply_text_reveal'  =>  'yes',
				]
			]
		);		
		$element->add_control(
			'text_style',
			[
				'label' => esc_html( 'Text Animation Type', 'classic-elementor-addons-pro' ),
				'description' => esc_html__( 'Here choose the animation type', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => [
					'none' => esc_html__( 'None', 'classic-elementor-addons-pro' ),
					'nml-letter-blur-out' => esc_html__( 'Letter Blur Out', 'classic-elementor-addons-pro' ),
					'nml-letter-fade-in' => esc_html__( 'Letter Fade In', 'classic-elementor-addons-pro' ),
					'nml-letter-fly-in' => esc_html__( 'Letter Fly In', 'classic-elementor-addons-pro' ),
					'nml-letter-rotate-from' => esc_html__( 'Letter Rotate From', 'classic-elementor-addons-pro' ),
					'nml-letter-beat' => esc_html__( 'Letter Beat', 'classic-elementor-addons-pro' ),
					'nml-letter-kick-out' => esc_html__( 'Letter Kick Out', 'classic-elementor-addons-pro' ),
					'nml-letter-push-release' => esc_html__( 'Letter Push Release', 'classic-elementor-addons-pro' ),
					'nml-letter-scale-in' => esc_html__( 'Letter Scale In', 'classic-elementor-addons-pro' ),
					'nml-letter-zoom-in' => esc_html__( 'Letter Zoom In', 'classic-elementor-addons-pro' ),
				],
				'default' => 'none',
				'condition' => [
					'apply_text_reveal' => 'yes',
				]
			]
		);
		$element->add_control(
			'text_animation_repeat',
			[
				'label'	=> esc_html__( 'Disable Reverse Onload Animation? ', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition'	=> [
					'text_style!'	=> 'none',
				],
				'separator'	=> 'before'
			]
		);
		$element->add_control(
			'text_disable_mobile',
			[
				'label'	=> esc_html__( 'Disable Animation on Mobile? ', 'classic-elementor-addons-pro' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'condition'	=> [
					'text_style!'	=> 'none',
				],
				'separator'	=> 'before'
			]
		);
		$element->add_control(
			'text_ani_delay',
			[
				'label'	=> esc_html__( 'Char Animation Interval', 'classic-elementor-addons-pro' ),
				'description' => esc_html__( 'Here Enter the Time Interval between the character animation', 'classic-elementor-addons-pro' ),
				'type'=> \Elementor\Controls_Manager::TEXT,
				'min' => 0.0005,
				'max' => 0.5,
				'step' => 0.00025,
				'default' => 0.005,
				'condition' => [
					'apply_text_reveal' => 'yes',
				]
			]
		);
		$element->end_controls_section();
	}	
	};
add_action('elementor/frontend/section/before_render', 'cea_section_custom_options', 10, 2);
add_action('elementor/frontend/container/before_render', 'cea_section_custom_options', 10, 2);
function cea_section_custom_options( $element ) {

    if ( $element->get_name() !== 'section' && $element->get_name() !== 'container' ) {
        return;
	}

    if ( ( 'section' === $element->get_name() ) || 'container' === $element->get_name() ){
		$rd_opt = $element->get_settings( 'rd_opt' );
        $paroller_opt = $element->get_settings( 'parallax_opt' );
        $float_img_opt = $element->get_settings( 'float_img_opt' );
		$sticky_columns = $element->get_settings('apply_sticky_column');
		$sticky_rows = $element->get_settings('apply_row_sticky');
		$enable_animation = $element->get_settings('enable_animation');
		$text_scroll = $element->get_settings( 'apply_text_reveal' );
		$scroll_horizontal = $element->get_settings( 'apply_scroll' );
		$list_step = $element->get_settings( 'apply_list_step' );
		$active_scroll = $element->get_settings( 'apply_active_option' );
		$content_parallax = $element->get_settings( 'apply_con_parallax' );

			if ($enable_animation === 'yes') {
				$_widget = $element->get_id();
				$widget_cls = 'elementor-element-'. $_widget;
				$animation_type = $element->get_settings('animation_type');
				$cursor_text = $element->get_settings('cursor_text');
				$cursor_icon = isset($element->get_settings('cursor_icon')['value']) ? $element->get_settings('cursor_icon')['value'] : '';
				$cursor_image = $element->get_settings('cursor_image') && $element->get_settings('cursor_image')['url'] != '' ? $element->get_settings('cursor_image')['url'] : '';
				$element->add_render_attribute('_wrapper', 'data-cursor-settings', json_encode([
					'widget_cls' => $widget_cls,
					'enable_animation' => $enable_animation,
					'animation_type' => $animation_type,
					'cursor_text' => $cursor_text,
					'cursor_icon' => $cursor_icon,
					'cursor_image' => $cursor_image,
				]));
			}

			if ( $scroll_horizontal === 'yes' ) {
				$disable_mobile = $element->get_settings('disable_hscr_mbl');
				$element->add_render_attribute('_wrapper', 'data-hs-disable', $disable_mobile);
			}
			
			if ( $list_step === 'yes' ) {
				$element->add_render_attribute('_wrapper', 'class', 'list-step-section');
			}

			// Floating Image 
			if( $float_img_opt == 'yes' ){
				wp_enqueue_script( array( 'cea-float-parallax', 'cea-custom-front' ) );
				$float_details = $element->get_settings( 'float_details' );
				$float_details = isset( $float_details ) ? $float_details : '';
				if( $float_details ){
					$floats_array = array();
					$i = 0;
					foreach( $float_details as $float_detail ){
						$float_title = isset( $float_detail['float_title'] ) && $float_detail['float_title'] != '' ? $float_detail['float_title'] : '';
						$float_img = isset( $float_detail['float_img'] ) && $float_detail['float_img']['url'] != '' ? $float_detail['float_img']['url'] : '';
						$float_left = isset( $float_detail['float_left'] ) && $float_detail['float_left'] != '' ? $float_detail['float_left'] : '';
						$float_top = isset( $float_detail['float_top'] ) && $float_detail['float_top'] != '' ? $float_detail['float_top'] : '';
						$float_distance = isset( $float_detail['float_distance'] ) && $float_detail['float_distance'] != '' ? $float_detail['float_distance'] : '';
						$float_animation = isset( $float_detail['float_animation'] ) && $float_detail['float_animation'] != '' ? $float_detail['float_animation'] : '';
						$float_mouse = isset( $float_detail['float_mouse'] ) && $float_detail['float_mouse'] != '0' ? '1' : '0';
						$float_width = isset( $float_detail['float_width'] ) && $float_detail['float_width'] != '' ? $float_detail['float_width'] . 'px' : '20px';
						$float_array = array(
							'float_title' => $float_title,
							'float_img' => $float_img,
							'float_left' => $float_left,
							'float_top' => $float_top,
							'float_distance' => $float_distance,
							'float_animation' => $float_animation,
							'float_mouse' => $float_mouse,
							'float_width' => $float_width
						);
						if( $float_img ){
							$floats_array[$i++] = $float_array;
						}
					}
					$element->add_render_attribute( '_wrapper', 'data-cea-float', htmlspecialchars( json_encode( $floats_array ), ENT_QUOTES, 'UTF-8' ) );
				}
			}
			
			// Raindrop
			if( $rd_opt == 'yes' ){
				wp_enqueue_script('jquery-ui');
				wp_enqueue_script('jquery-ease');
				wp_enqueue_script('raindrops');
				wp_enqueue_script('cea-custom-front');
				$id = 'shortcode-rand-' . cea_shortcode_rand_id();
				$rd_color = $element->get_settings( 'rd_color' );
				$rd_height = $element->get_settings( 'rd_height' );
				$rd_speed = $element->get_settings( 'rd_speed' );
				$rd_freq = $element->get_settings( 'rd_frequency' );
				$rd_density = $element->get_settings( 'rd_density' );
				$rd_pos = $element->get_settings( 'rd_pos' );
				$rd_array = array(
					'id' => $id,
					'rd_color' => $rd_color,
					'rd_height' => $rd_height,
					'rd_speed' => $rd_speed,
					'rd_freq' => $rd_freq,
					'rd_density' => $rd_density,
					'rd_pos' => $rd_pos	
				);
				$element->add_render_attribute( '_wrapper', 'data-cea-raindrops', htmlspecialchars( json_encode( $rd_array ), ENT_QUOTES, 'UTF-8' ) );
			}

			// Parallax
			if( $paroller_opt == 'yes' ){
				wp_enqueue_script('cea-custom-front');
				$parallax_ratio = $element->get_settings( 'parallax_ratio' );
				$parallax_image = $element->get_settings( 'background_image' );
				$img_url = is_array( $parallax_image ) && isset( $parallax_image['url'] ) ? $parallax_image['url'] : '';
				$parallax_array = array(
					'parallax_ratio' => $parallax_ratio,
					'parallax_image' => $img_url
				);
				$element->add_render_attribute( '_wrapper', 'data-cea-parallax-data', htmlspecialchars( json_encode( $parallax_array ), ENT_QUOTES, 'UTF-8' ) );
			}

			// Container Sticky
			if ($sticky_columns === 'on') {
				wp_enqueue_script('theai-sticky-sidebar');
				$element->add_render_attribute('_wrapper', 'class', 'sticky-sidebar');
			}
			if( $sticky_rows === 'yes' ) {
				wp_enqueue_script( 'cea-row-sticky' );
				$element->add_render_attribute('_wrapper', 'class', 'sticky-row');
			}

			// Text Scroll Reveal
			if( $text_scroll == 'yes' ) {
				$text_tag = $element->get_settings( 'text_tag' );
				$text_tag = isset( $text_tag ) && $text_tag != '' ? $text_tag : '';
				$text_style = $element->get_settings( 'text_style' );
				$text_style = isset( $text_style ) && $text_style != '' ? $text_style : '';
				$text_ani_delay = $element->get_settings( 'text_ani_delay' );
				$text_ani_delay = isset( $text_ani_delay ) && $text_ani_delay != '' ? $text_ani_delay : '';
				$text_type = ( null !== $element->get_settings( 'text_type' ) ) ? $element->get_settings( 'text_type' ) : '';
				$text_reveal = array(
					'textTag' => $text_tag,
					'textType' => $text_type,
					'styleType' => $text_style,
					'aniDelay' => $text_ani_delay,
				);
				$text_animation_repeat = $element->get_settings('text_animation_repeat');
				$text_disable_mobile = $element->get_settings('text_disable_mobile');
				$element->add_render_attribute( '_wrapper', 'data-tag', htmlspecialchars( json_encode( $text_reveal ), ENT_QUOTES, 'UTF-8' ) );
				if ( isset( $text_animation_repeat ) && $text_animation_repeat == 'yes' ) {
					$element->add_render_attribute( '_wrapper', 'data-animate-repeat', $text_animation_repeat );
				}
				if ( isset( $text_disable_mobile ) && $text_disable_mobile == 'yes' ) {
					$element->add_render_attribute( '_wrapper', 'data-disable-mobile', $text_disable_mobile );
				}
			}

		// Horizontal Scroll 		
		if( $scroll_horizontal == 'yes' ){
			$element->add_render_attribute( '_wrapper', 'class', 'cea-horizontal-scroll' );
		}
		
		// Parallax Content
		if( $content_parallax == 'yes' ) {
			$parallax_depth = $element->get_settings('parallax_depth_no') ?? 0.4;
			$parallax_index = $element->get_settings('parallax_item_index') ?? 1;
			$parallax_scaleX = $element->get_settings('parallax_scalar_x') ?? 0;
			$parallax_scaleY = $element->get_settings('parallax_scalar_y') ?? 0;
			$parallax_frictionX = $element->get_settings('parallax_friction_x') ?? 0.4;
			$parallax_frictionY = $element->get_settings('parallax_friction_y') ?? 0.4;
			$parallax_hover_only = ( $element->get_settings('parallax_hover_only') ) ? true : false ;
			$parallax_img_full = $element->get_settings('parallax_img_full');
			
			if( $parallax_img_full == 'full-width' ) {
				$parallax_image_width = $element->get_settings('parallax_full_img_width') ?? 0;
				$parallax_image_left = $element->get_settings('parallax_full_img_left') ?? 0;
			} else {
				$parallax_image_width = 0;
				$parallax_image_left = 0;
			}
			$parallax_args = array(
				'data_depth' => $parallax_depth,
				'parallax_index' => $parallax_index['size'],
				'parallax_hover_only' => $parallax_hover_only,
				'scale_x' => $parallax_scaleX,
				'scale_y' => $parallax_scaleY,
				'friction_x' => $parallax_frictionX,
				'friction_y' => $parallax_frictionY,
				'img_full_width' => $parallax_image_width,
				'img_full_left' => $parallax_image_left,
			);
			$parallax_args = json_encode( $parallax_args );
        		
			$element->add_render_attribute( '_wrapper', 'data-parallax', 'true' );
			$element->add_render_attribute( '_wrapper', 'data-parallax-ctrl', htmlspecialchars( $parallax_args, ENT_QUOTES, 'UTF-8' ) );
	
		}
	}
};