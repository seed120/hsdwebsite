<?php 
/*
	Plugin Name: Zozo Header Footer
	Plugin URI: http://zozothemes.com/
	Description: Post types addon for Classic elementor addon. It contains Interior, Team, Testimonial, Service and Event post types.
	Version: 2.0
	Author: zozothemes
	Textdomain: zozo-header-footer
	Author URI: http://zozothemes.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'ZOZO_HF_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'ZOZO_HF_CORE_URL', plugin_dir_url( __FILE__ ) );

if( ! class_exists('ZOZO_Header_Footer') ) {
    /*
    * Intialize and Sets up the plugin
    */
    class ZOZO_Header_Footer {
        
		private static $_instance = null;
		
		public static $supported_themes = null;
		
        /**
        * Sets up needed actions/filters for the plug-in to initialize.
        * @since 1.0.0
        * @access public
        * @return void
        */
        public function __construct() {
			
			$active_stat = $this->check_elementor_is_active();
			
			// Check if Elementor installed and activated
			if ( !$active_stat ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			}else{			
				
				// Settings page link
				add_filter( 'plugin_action_links', array( $this, 'zhf_settings_page_link' ), 90, 2 );
				
				//Classic elementor addon setup page
				add_action('plugins_loaded', array( $this, 'classic_elementor_addon_setup') );
				
				//Admin settings
				$this->admin_settings();
				
				//Classic elementor addon shortcodes
				add_action( 'init', array( $this, 'init_addons' ), 20 );				
				
				//render content for front-end
				$this->render_process();
				
				$this->for_admin_ajax();
			}
			
			$this->set_supported_themes();
						
        }
		
		public function zhf_settings_page_link( $plugin_actions, $plugin_file ){
			$new_actions = array(); 
			if( 'zozo-header-footer/zozo-header-footer.php' === $plugin_file ) {
				$new_actions = array( sprintf( __( '<a href="%s">Settings</a>', 'zozo-header-footer' ), esc_url( admin_url( 'edit.php?post_type=zozo-hf' ) ) ) );
			}
			return array_merge( $new_actions, $plugin_actions );
		}
		
		public function for_admin_ajax(){
			// admin metabox ajax
			require_once ( ZOZO_HF_CORE_DIR . 'inc/class.zozo-header-footer-admin-ajax.php' );
		}
		
		public function set_supported_themes(){

			self::$supported_themes = array( 'briddge', 'gigas' , 'igual' , 'tranzkart' , 'psycons' , 'wedknot' , 'explug' , 'verks' , 'grankare' , 'beruco' , 'garland' , 'colf', 'apinae', 'ecohorbor', 'happysmile', 'devicemaster', 'craftedge', 'automender', 'cheval', 'yatie', 'bizzor', 'hegira', 'firefront', 'optiplus', 'petzorg', 'finxpert', 'glovera', 'seoinux', 'povoyage', 'vayuai', 'wastbin', 'hirxpert', 'fitvibe', 'playvibe', 'cofybrew', 'consultixpro',  );

		}
		
		public function admin_notice_missing_main_plugin() {
			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
			$message = sprintf(
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'zozo-header-footer' ),
				'<strong>' . esc_html__( 'Zozo Header Footer', 'zozo-header-footer' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'zozo-header-footer' ) . '</strong>'			
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}
		
		public function check_elementor_is_active(){
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
			if( is_plugin_active( 'elementor/elementor.php' ) || is_plugin_active_for_network( 'elementor/elementor.php' ) ){
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
			load_plugin_textdomain( 'zozo-header-footer', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
        }
		
        
        /**
        * Load required file for addons integration
        * @return void
        */
        public function init_addons() {
			
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				require_once( ZOZO_HF_CORE_DIR . 'inc/class.zozo-minicart.php' );
			}
			
			//addon settings
        	require_once ( ZOZO_HF_CORE_DIR . 'inc/class.zozo-header-footer-extension.php' );
			
        }
		
		/**
		* Load required file for admin settings
        * @return void
        */
        public function admin_settings() {
			
			//admin settings
			require_once ( ZOZO_HF_CORE_DIR . 'admin/zhf-admin.php' );
			
        }
		
		/**
		* Render the header and footer
        * @return void
        */
        public function render_process() {
			
			//render content
			require_once ( ZOZO_HF_CORE_DIR . 'inc/class.zozo-header-footer-render.php' );
			
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

//Create/Call Zozo Header Footer Elementor Plugin
ZOZO_Header_Footer::get_instance();