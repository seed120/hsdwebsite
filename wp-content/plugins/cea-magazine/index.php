<?php 
/*
	Plugin Name: CEA Magazine
	Requires Plugins: classic-elementor-addons-pro
	Plugin URI: http://zozothemes.com/
	Description: Post types addon for Classic elementor addon. It contains more than 10 magazine layout for build posts.
	Version: 2.0
	Author: zozothemes
	Textdomain: cea-magazine
	Author URI: http://zozothemes.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'CEA_MGZN_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'CEA_MGZN_CORE_URL', plugin_dir_url( __FILE__ ) );

if( ! class_exists('CEA_Magazine') ) {
    /*
    * Intialize and Sets up the plugin
    */
    class CEA_Magazine {
        
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
			}
			
        }	
		
		public function admin_notice_missing_main_plugin() {
			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s" and "%3$s" to be installed and activated.', 'cea-magazine' ),
				'<strong>' . esc_html__( 'CEA Magazine', 'cea-magazine' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'cea-magazine' ) . '</strong>',
				'<strong>' . esc_html__( 'Classic Elementor Addons', 'cea-magazine' ) . '</strong>'				
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
			load_plugin_textdomain( 'cea-magazine', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }
		
        
        /**
        * Load required file for addons integration
        * @return void
        */
        public function init_addons() {
			
			//addon settings
        	require_once ( CEA_MGZN_CORE_DIR . 'inc/cea-addon.php' );
			
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
CEA_Magazine::get_instance();