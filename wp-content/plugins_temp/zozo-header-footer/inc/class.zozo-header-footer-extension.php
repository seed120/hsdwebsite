<?php 

namespace Elementor;

/**
 * Zozo Header Footer Extension Class
 *
 * @since 1.0.0
 */
final class ZOZO_Header_Footer_Extension {

	private static $_instance = null;
		 
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {
		
		// initiate plugin things
		$this->init();

	}

	public function init() {
		
		// AJAX functions
		$this->ajax_functions();
		
		// remove admin bar for logged users
		add_action('after_setup_theme', array( $this, 'remove_admin_bar' ) ); 
		
		// Create shortcode category
		$this->create_zozo_hf_category();
		
		// Register Widget Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		
		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ], 99 );
		
		// Elementor editor style
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'editor_enqueue_scripts' ] );
		
		// ZHF Sticky
		add_action( 'elementor/element/section/section_typo/after_section_end', [ $this, 'zhf_sticky_options' ], 10, 2 );
		
		// ZHF Sticky Render
		add_action( 'elementor/frontend/section/before_render', [ $this, 'zhf_sticky_render' ], 10, 1 );

	}
	
	public function zhf_sticky_render( Element_Base $element ){
		// Make sure we are in a section element
		if( 'section' !== $element->get_name() ) {
			return;
		}		
		$zhf_sticky = $element->get_settings( 'zhf_sticky' );
		if( $zhf_sticky == 'yes' ){
			$element->add_render_attribute( '_wrapper', 'class', 'zhf-sticky-obj' );			
			$zhf_sticky_up = $element->get_settings( 'zhf_sticky_up' );
			if( $zhf_sticky_up == 'yes' ){
				$element->add_render_attribute( '_wrapper', 'data-stickyup', '1' );
			}
		}
		
	}
	
	public function zhf_sticky_options( $section, $args ) {
		//Sticky Settings
		$section->start_controls_section(
			'section_zhf',
			[
				'label' => __( 'ZHF Sticky Settings', 'cea' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$section->add_control(
			"zhf_sticky",
			[
				"label" 		=> esc_html__( "Enable/Disable Sticky", "cea" ),
				"type" 			=> \Elementor\Controls_Manager::SWITCHER,
				"label_off" 	=> esc_html__( 'Off', 'cea' ),
				"label_on" 		=> esc_html__( 'On', 'cea' ),
				"default" 		=> "no"
			]
		);
		$section->add_control(
			"zhf_sticky_up",
			[
				"label" 		=> esc_html__( "Sticky While Scroll Up", "cea" ),
				"type" 			=> \Elementor\Controls_Manager::SWITCHER,
				"label_off" 	=> esc_html__( 'Off', 'cea' ),
				"label_on" 		=> esc_html__( 'On', 'cea' ),
				"default" 		=> "no",
				'condition' 	=> [
					'zhf_sticky' 		=> 'yes'
				],
			]
		);
		$section->end_controls_section();
	}
	
	/**
	 * Register plugin shortcode category
	 * @since 1.0
	 * @access public
	 * @return void
	 */
	public function create_zozo_hf_category() {
	   Plugin::instance()->elements_manager->add_category(
			'zozo-hf-elements',
			array(
				'title' => esc_html__( 'ZOZO Header & Footer', 'zozo-header-footer' )
			),
		1);
	}
	
	public function remove_admin_bar() {
		$user = wp_get_current_user();
		if ( in_array( 'subscriber', (array) $user->roles ) ) {
			show_admin_bar(false);
		}
	}

	
	public function ajax_functions(){
		require_once( ZOZO_HF_CORE_DIR . 'inc/class.zozo-header-footer-ajax.php' );
	}
	
	public function widget_scripts() {
		wp_register_style( 'themify-icons', ZOZO_HF_CORE_URL . 'assets/css/themify-icons.css', false, '1.0' );
		wp_register_style( 'zozo-header-footer', ZOZO_HF_CORE_URL . 'assets/css/zozo-header-footer.css', false, '1.0' );
		//wp_register_script( 'jquery-sticky-kit', ZOZO_HF_CORE_URL . 'assets/js/jquery.sticky-kit.min.js',  array( 'jquery' ), '1.1.2', true );
		wp_register_script( 'zozo-header-footer', ZOZO_HF_CORE_URL . 'assets/js/zozo-header-footer.js',  array( 'jquery' ), '1.0', true );
		
		wp_localize_script( 'zozo-header-footer', 'zhf_ajax_var', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'loadingmessage' => esc_html__( 'Sending user info, please wait...', 'zozo-header-footer' ),
			'valid_email' => esc_html__( 'Please enter valid email!', 'zozo-header-footer' ),
			'valid_login' => esc_html__( 'Please enter valid username/password!', 'zozo-header-footer' ),
			'req_reg' => esc_html__( 'Please enter required fields values for registration!', 'zozo-header-footer' )
		));
	}
	
	/**
	 * Register elementor editor style
	 * @since 1.0
	 * @access public
	 * @return void
	 */
	public function editor_enqueue_scripts(){
		wp_enqueue_style( 'zozo-hf-editor', ZOZO_HF_CORE_URL .'assets/css/elementor-editor-style.css', array(), '1.0', 'all');
	}
	
	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets( $widgets_manager ) {

		$hf_widgets = array( 'logo', 'search', 'secondary-bar', 'menu', 'copyright', 'page-title', 'registration' );
		
		if( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			$hf_widgets[] = 'mini-cart';
		}
		
		foreach( $hf_widgets as $key ){
				
			require_once( ZOZO_HF_CORE_DIR . 'widgets/'. esc_attr( $key ) .'.php' );
			
			switch( $key ){
				case "logo": $widgets_manager->register( new ZOZO_HF_Logo_Widget() );  break;
				case "search": $widgets_manager->register( new ZOZO_HF_Search_Widget() );  break;
				case "secondary-bar": $widgets_manager->register( new ZOZO_HF_Secondary_Bar() ); break;
				case "menu": $widgets_manager->register( new ZOZO_HF_Menu_Widget() ); break;
				case "copyright": 
					require_once( ZOZO_HF_CORE_DIR . 'widgets/class-copyright-shortcode.php' );
					$widgets_manager->register( new ZOZO_HF_Copyright_Widget() );
				break;
				case "page-title": $widgets_manager->register( new ZOZO_HF_PageTitle_Widget() ); break;
				case "registration": $widgets_manager->register( new ZOZO_HF_Registration_Widget() ); break;
				case "mini-cart": 
					$widgets_manager->register( new ZOZO_HF_Minicart_Widget() ); 
				break;
				case "mini-wishlist": 
					$widgets_manager->register( new ZOZO_HF_Mini_Wishlist_Widget() ); 
				break;
			}
				
		}
		
	}

}
ZOZO_Header_Footer_Extension::instance();