<?php 
/*
	Plugin Name: Classic Addons for Elementor
	Plugin URI: https://zozothemes.com/
	Description: Classic addons plugin have 20+ massive widgets for Elementor page builder.
	Version: 2.0
	Author: zozothemes
	Author URI: https://zozothemes.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\{
	Controls_Manager,
	Control_Media,
	Utils,
	Icons_Manager,
	Group_Control_Image_Size
};

define( 'CEA_CORE_DIR', plugin_dir_path( __FILE__ ) );
define( 'CEA_CORE_URL', plugin_dir_url( __FILE__ ) );

if( ! class_exists('Classic_Elementor_Addon') ) {
	
	/*
	* Intialize and Sets up the plugin
	*/
	class Classic_Elementor_Addon {
	
		/**
		 * Minimum Elementor Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

		/**
		 * Minimum PHP Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const MINIMUM_PHP_VERSION = '5.0';
        
		/**
		 * Instance
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @static
		 *
		 * @var Classic_Elementor_Addon The single instance of the class.
		 */
		private static $_instance = null;
		
        /**
        * Sets up needed actions/filters for the plug-in to initialize.
        * @since 1.0.0
        * @access public
        * @return void
        */
        public function __construct() {
			
			// Check elementor status
			add_action( 'plugins_loaded', array( $this, 'cea_plugins_loaded' ) );
			
			register_activation_hook( CEA_CORE_DIR . 'index.php',  [ $this, 'save_default_settings' ] );
		
        }
		
		public function cea_plugins_loaded(){
			
			if( ! $this->is_compatible() ) return false;
			
			//Classic elementor addon shortcodes
            add_action( 'init', array( $this, 'init_addons' ), 20 );
						
			// Elementor init
			add_action('elementor/init', [ $this, 'add_hooks' ]);			
			
			$this->cea_ajax_calls();
			
			//Load text domain
            $this->load_domain();
			
		}
				
		public function is_compatible(){			
			
			// Check if Elementor installed and activated
			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
				return false;
			}
			
			// Check for required Elementor version
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
				return false;
			}

			// Check for required PHP version
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
				return false;
			}
			
			return true;
			
		}
		
		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin() {

			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor */
				esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'classic-elementor-addons-pro' ),
				'<strong>' . esc_html__( 'Classic Elementor Addons', 'classic-elementor-addons-pro' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'classic-elementor-addons-pro' ) . '</strong>'
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {

			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'classic-elementor-addons-pro' ),
				'<strong>' . esc_html__( 'Classic Elementor Addons', 'classic-elementor-addons-pro' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'classic-elementor-addons-pro' ) . '</strong>',
				 self::MINIMUM_ELEMENTOR_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version() {

			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
			$message = sprintf(
				/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'classic-elementor-addons-pro' ),
				'<strong>' . esc_html__( 'Classic Elementor Addons', 'classic-elementor-addons-pro' ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', 'classic-elementor-addons-pro' ) . '</strong>',
				 self::MINIMUM_PHP_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}
		
		public function add_hooks(){			
			// Custom css settings
			require_once ( CEA_CORE_DIR . 'inc/class.cea-pro-module.php' );			
		}
		
		public function cea_ajax_calls(){
			// CEA ajax calls
			require_once ( CEA_CORE_DIR . 'inc/class.cea-ajax-calls.php' );
		}
		
		public static function cea_shortcodes(){
			$shortcode_stat = array(
				'animated-text' 	=> esc_html__( 'Animated Text', 'classic-elementor-addons-pro' ),
				'button' 			=> esc_html__( 'Button', 'classic-elementor-addons-pro' ),
				'circle-progress'	=> esc_html__( 'Circle Progress', 'classic-elementor-addons-pro' ),
				'contact-form' 		=> esc_html__( 'Contact Form', 'classic-elementor-addons-pro' ),
				'contact-info' 		=> esc_html__( 'Contact Info', 'classic-elementor-addons-pro' ),
				'content-carousel' 	=> esc_html__( 'Content Carousel', 'classic-elementor-addons-pro' ),
				'counter' 			=> esc_html__( 'Counter', 'classic-elementor-addons-pro' ),
				'day-counter' 		=> esc_html__( 'Day Counter', 'classic-elementor-addons-pro' ),
				'feature-box' 		=> esc_html__( 'Feature Box', 'classic-elementor-addons-pro' ),
				'flip-box' 			=> esc_html__( 'Flip Box', 'classic-elementor-addons-pro' ),
				'google-map' 		=> esc_html__( 'Google Map', 'classic-elementor-addons-pro' ),
				'icon' 				=> esc_html__( 'Icon', 'classic-elementor-addons-pro' ),
				'icon-list' 		=> esc_html__( 'Icon List', 'classic-elementor-addons-pro' ),
				'image-grid' 		=> esc_html__( 'Image Grid', 'classic-elementor-addons-pro' ),
				'slider-widget' 	=> esc_html__( 'Slider Widget', 'classic-elementor-addons-pro' ),
				'modal-popup' 		=> esc_html__( 'Modal Popup', 'classic-elementor-addons-pro' ),
				'pricing-table' 	=> esc_html__( 'Pricing Table', 'classic-elementor-addons-pro' ),
				'section-title' 	=> esc_html__( 'Section Title', 'classic-elementor-addons-pro' ),
				'social-links' 		=> esc_html__( 'Social Links', 'classic-elementor-addons-pro' ),
				'timeline' 			=> esc_html__( 'Timeline', 'classic-elementor-addons-pro' ),
				'timeline-slide' 	=> esc_html__( 'Timeline Slide', 'classic-elementor-addons-pro' ),
				'chart' 			=> esc_html__( 'Chart', 'classic-elementor-addons-pro' ),
				'popup-anything'	=> esc_html__( 'Popup Anything', 'classic-elementor-addons-pro' ),
				'popover'			=> esc_html__( 'Popover', 'classic-elementor-addons-pro' ),
				'recent-popular' 	=> esc_html__( 'Recent/Popular Post', 'classic-elementor-addons-pro' ),
				'tab' 				=> esc_html__( 'Tab', 'classic-elementor-addons-pro' ),
				'accordion'			=> esc_html__( 'Accordion', 'classic-elementor-addons-pro' ),
				'offcanvas' 		=> esc_html__( 'Offcanvas', 'classic-elementor-addons-pro' ),
				'switcher-content' 	=> esc_html__( 'Switcher Content', 'classic-elementor-addons-pro' ),
				'data-table' 		=> esc_html__( 'Data Table', 'classic-elementor-addons-pro' ),
				'posts'				=> esc_html__( 'Posts', 'classic-elementor-addons-pro' ),
				'toggle-content' 	=> esc_html__( 'Toggle Content', 'classic-elementor-addons-pro' ),
				'mailchimp' 		=> esc_html__( 'Mailchimp', 'classic-elementor-addons-pro' ),
				'image-before-after'=> esc_html__( 'Image Before After', 'classic-elementor-addons-pro' ),
				'video-playlist'	=> esc_html__( 'Video/Audio Playlist', 'classic-elementor-addons-pro' ),
				'draw-svg'			=> esc_html__( 'Draw SVG', 'classic-elementor-addons-pro' ),
				'text-image'		=> esc_html__( 'Text Image', 'classic-elementor-addons-pro' ),
				'image-zoom' 		=> esc_html__( 'Image Zoom', 'classic-elementor-addons-pro' ),
				'list-step' 		=> esc_html__( 'List Step', 'classic-elementor-addons-pro' ),
				'location-map'		=> esc_html__( 'Location Map', 'classic-elementor-addons-pro' ),
				'bubble-float'		=> esc_html__( 'Bubble Float', 'classic-elementor-addons-pro' ),
				'marquee'			=> esc_html__( 'Marquee', 'classic-elementor-addons-pro' ),
			);
			return $shortcode_stat;
		}
		
		public function save_default_settings(){
			$cea_options = get_option( 'cea_options' );
			if( !$cea_options ){
				$cea_default_options = '{"cpt-gmap-api":"","mailchimp-api":"","social-shares":"{\"Enabled\":{\"fb\":\"Facebook\",\"twitter\":\"Twitter\",\"linkedin\":\"Linkedin\",\"pinterest\":\"Pinterest\"},\"disabled\":[]}","cpt-portfolio-slug":"portfolio", "portfolio-layout-options":"default-layout","portfolio-meta-items":"{\"Enabled\":{\"date\":\"Date\",\"client\":\"Client\",\"category\":\"Category\",\"share\":\"Share\"},\"disabled\":{\"tag\":\"Tags\",\"duration\":\"Duration\",\"url\":\"URL\",\"place\":\"Place\",\"estimation\":\"Estimation\"}}","portfolio-client-label":"Client","portfolio-type-label":"Portfolio Type","portfolio-date-label":"Date","portfolio-duration-label":"Duration","portfolio-estimation-label":"Estimation","portfolio-place-label":"Place","portfolio-url-label":"URL","portfolio-category-label":"Category","portfolio-tags-label":"Tags","portfolio-share-label":"Share","portfolio-grid-cols":"2","portfolio-grid-gutter":"20","portfolio-grid-type":"isotope","cpt-portfolio-sidebars":"","portfolio-related-opt":"dis","portfolio-related-slide-items":"6","portfolio-related-slide-tab-items":"6","portfolio-related-slide-mobile-items":"4","portfolio-related-slide-margin":"10","cpt-service-slug":"service","service-layout-options":"default-layout","cpt-service-sidebars":"","cpt-event-slug":"event","event-layout-options":"default-layout","cpt-event-sidebars":"","cpt-team-slug":"team","team-layout-options":"default-layout","cpt-team-sidebars":"","cpt-testimonial-slug":"testimonial","cpt-testimonial-sidebars":""}';
				update_option( 'cea_options', json_decode( $cea_default_options, true ) );
				
				$cea_shortcodes = get_option('cea_shortcodes');
				if( empty( $cea_shortcodes ) ){
					$shortcode_stat = self::cea_shortcodes();
					$cea_shortcodes = array();
					foreach( $shortcode_stat as $key => $value ){
						$shortcode_name = str_replace( "-", "_", $key );
						$cea_shortcodes[$shortcode_name] = 'on';
					}
					update_option( 'cea_shortcodes', $cea_shortcodes );
				}
			}
		}
		
        /**
         * Load plugin translated strings using text domain
         * @since 2.6.8
         * @access public
         * @return void
         */
        public function load_domain() {
			load_plugin_textdomain('classic-elementor-addons-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
        }
		
        
        /**
        * Load required file for addons integration
        * @return void
        */
        public function init_addons() {			
			require_once ( CEA_CORE_DIR . 'inc/cea-addon.php' );
        }
        
        /**
         * Creates and returns an instance of the class
         * @since 2.6.8
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
Classic_Elementor_Addon::get_instance();

//Save Action Hook
register_activation_hook( __FILE__, 'classic_elementor_addon_plugin_activate' );
function classic_elementor_addon_plugin_activate(){
	require_once ( CEA_CORE_DIR . 'inc/cea-addon-styles.php' );
}
require_once ( CEA_CORE_DIR . 'inc/cea-ajax-load.php' );