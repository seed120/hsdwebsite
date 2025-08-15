<?php 
/*
	Plugin Name: CEA Post Types
	Requires Plugins: classic-elementor-addons-pro
	Plugin URI: http://zozothemes.com/
	Description: Post types addon for Classic elementor addon. It contains Portfolio, Team, Testimonial, Service and Event post types.
	Version: 2.0
	Author: zozothemes
	Textdomain: cea-post-types
	Author URI: http://zozothemes.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'CEA_PT_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'CEA_PT_CORE_URL', plugin_dir_url( __FILE__ ) );

if( ! class_exists('CEA_Post_Types') ) {
    /*
    * Intialize and Sets up the plugin
    */
    class CEA_Post_Types {
        
		private static $_instance = null;
		
        /**
        * Sets up needed actions/filters for the plug-in to initialize.
        * @since 1.0.0
        * @access public
        * @return void
        */
        public function __construct() {
			
			$active_stat = $this->check_cea_is_active();
			
			// Check if Elementor installed and activated
			if ( !$active_stat ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			}else{
				//Classic elementor addon setup page
				add_action('plugins_loaded', array( $this, 'classic_elementor_addon_setup') );
				
				//Classic elementor addon shortcodes
				add_action( 'init', array( $this, 'init_addons' ), 20 );
				
				//cpt single template
				add_filter( 'single_template', array( $this, 'cea_cpt_custom_template' ), 10 );
				
				//cpt archive template
				add_filter( 'archive_template', array( $this, 'cea_cpt_custom_archive_template' ), 10 );

				add_action( 'wp_enqueue_scripts', array( $this, 'load_ajax_script' ) );
			}
			register_activation_hook( CEA_PT_CORE_DIR . 'index.php',  [ $this, 'save_default_options' ] );
        }	
		
		public function admin_notice_missing_main_plugin() {
			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s" and "%3$s" to be installed and activated.', 'cea-post-types' ),
				'<strong>' . esc_html__( 'CEA Post Types', 'cea-post-types' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'cea-post-types' ) . '</strong>',
				'<strong>' . esc_html__( 'Classic Elementor Addons', 'cea-post-types' ) . '</strong>'				
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}
		
		public function check_cea_is_active(){
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
			if( ( is_plugin_active( 'classic-elementor-addons-pro/index.php' ) || is_plugin_active_for_network( 'classic-elementor-addons-pro/index.php' ) ) && ( is_plugin_active( 'elementor/elementor.php' ) || is_plugin_active_for_network( 'elementor/elementor.php' ) ) ){
				return 1;
			}
			return 0;
		}
		
        /**
        * Installs translation text domain and checks if Elementor is installed
        * @since 1.0.0
        * @access public
        * @return void
        */
        public function classic_elementor_addon_setup() {
			//Load text domain
            $this->load_domain();
        }
        
        /**
         * Load plugin translated strings using text domain
         * @since 2.6.8
         * @access public
         * @return void
         */
        public function load_domain() {
			load_plugin_textdomain( 'cea-post-types', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }
		
        
        /**
        * Load required file for addons integration
        * @return void
        */
        public function init_addons() {
			
			//addon settings
        	require_once ( CEA_PT_CORE_DIR . 'inc/cea-addon.php' );
			
			//register post types
        	require_once ( CEA_PT_CORE_DIR . 'inc/cpt.class.php' );
        }

		public function load_ajax_script() {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'cpt-ajax', CEA_PT_CORE_URL . '/assets/js/ajax-script.js', array('jquery'), '1.0.0', true );
		}
		
		public function cea_cpt_custom_template( $single ) {

			global $post; $stat = 0;
			
			if( $post->post_type == 'cea-portfolio' || $post->post_type == 'cea-team' || $post->post_type == 'cea-event' || $post->post_type == 'cea-service' || $post->post_type == 'cea-testimonial' ) {
				require_once ( CEA_PT_CORE_DIR . 'inc/cpt.elements.php' );
			}
			
			/* Checks for single template by post type */
			if( $post->post_type == 'cea-portfolio' ) {
				if( file_exists( CEA_PT_CORE_DIR . 'templates/cea-portfolio.php' ) ) {
					return apply_filters( 'cea_portfolio_template_path', CEA_PT_CORE_DIR . 'templates/cea-portfolio.php' );
				}		
			}elseif( $post->post_type == 'cea-team' ) {
				if( file_exists( CEA_PT_CORE_DIR . 'templates/cea-team.php' ) ) {
					return apply_filters( 'cea_team_template_path', CEA_PT_CORE_DIR . 'templates/cea-team.php' );
				}
			}elseif( $post->post_type == 'cea-event' ) {
				if( file_exists( CEA_PT_CORE_DIR . 'templates/cea-event.php' ) ) {
					return apply_filters( 'cea_event_template_path', CEA_PT_CORE_DIR . 'templates/cea-event.php' );
				}
			}elseif( $post->post_type == 'cea-service' ) {
				if( file_exists( CEA_PT_CORE_DIR . 'templates/cea-service.php' ) ) {
					return apply_filters( 'cea_service_template_path', CEA_PT_CORE_DIR . 'templates/cea-service.php' );
				}
			}elseif( $post->post_type == 'cea-testimonial' ) {
				if( file_exists( CEA_PT_CORE_DIR . 'templates/cea-testimonial.php' ) ) {
					return apply_filters( 'cea_testimonial_template_path', CEA_PT_CORE_DIR . 'templates/cea-testimonial.php' );
				}
			}

			return $single;
		}
		
		public function cea_cpt_custom_archive_template( $archive ){
			if( is_tax('portfolio-categories') || is_tax('portfolio-tags') || is_post_type_archive( 'cea-portfolio' ) ){
				require_once ( CEA_PT_CORE_DIR . 'inc/cpt.elements.php' );
				if( file_exists( CEA_PT_CORE_DIR . 'templates/cea-portfolio-archive.php' ) ) {
					return apply_filters( 'cea_portfolio_archive_template_path', CEA_PT_CORE_DIR . 'templates/cea-portfolio-archive.php' ) ;
				}
			}
			if( is_tax('service-categories') || is_tax('service-tags') || is_post_type_archive( 'cea-service' ) ){
            require_once ( CEA_PT_CORE_DIR . 'inc/cpt.elements.php' );
				if( file_exists( CEA_PT_CORE_DIR . 'templates/cea-service-archive.php' ) ) {
					return apply_filters( 'cea_service_archive_template_path', CEA_PT_CORE_DIR . 'templates/cea-service-archive.php' ) ;
				}			
			}
			return $archive;
		}
		
		public function save_default_options() {
			$cea_shortcodes = get_option('cea_shortcodes');
			if (!is_array($cea_shortcodes)) {
				$cea_shortcodes = [];
			}
			$shortcode_list = ['portfolio', 'service', 'event', 'team', 'testimonial'];
			foreach ($shortcode_list as $key) {
				$cea_shortcodes[$key] = 'on';
			}
			update_option('cea_shortcodes', $cea_shortcodes);
		}

        /**
         * Creates and returns an instance of the class
         * @since 1.0
         * @access public
         * return object
         */
        public static function get_instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}
    
    }
}

//Create/Call Classic Elementor Addon
CEA_Post_Types::get_instance();

add_action('wp_enqueue_scripts', 'load_elementor_ajax_assets', 20);

function load_elementor_ajax_assets() {
    if (class_exists('\Elementor\Plugin')) {
        \Elementor\Plugin::$instance->frontend->enqueue_styles();
        \Elementor\Plugin::$instance->frontend->enqueue_scripts();
    }
}

require_once ( CEA_PT_CORE_DIR . 'inc/cea-ajax-nav.php' );