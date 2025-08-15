<?php 
/*
	Plugin Name: Hirxpert Addon
	Plugin URI: https://zozothemes.com/
	Description: This is addon for Hirxpert theme.
	Version: 2.0.1
	Author: zozothemes
	Author URI: https://zozothemes.com/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// check theme 
$cur_theme = wp_get_theme();	
$token = get_option( 'verified_token' );
if( $cur_theme->get( 'Name' ) != 'Hirxpert' && $cur_theme->get( 'Name' ) != 'Hirxpert Child' ){
	return;
}
// check token
if( empty( $token ) ) return;

define( 'HIRXPERT_ADDON_DIR', plugin_dir_path( __FILE__ ) );
define( 'HIRXPERT_ADDON_URL', plugin_dir_url( __FILE__ ) );

/*
* Intialize and Sets up the plugin
*/
class Hirxpert_Addon {
	
	private static $_instance = null;
		
	/**
	* Sets up needed actions/filters for the plug-in to initialize.
	* @since 1.0.0
	* @access public
	* @return void
	*/
	public function __construct() {

		//$this->hirxpert_template_direct();
		 do_action('zozo_importer_elementor_default_kit');

		 add_action('zozo_importer_elementor_default_kit', 'zozo_default_kits_init', 10);

		// Get option
		$this->hirxpert_get_option_class();

		//Hirxpert addon setup page
		add_action('plugins_loaded', array( $this, 'hirxpert_elementor_addon_setup') );
		
		//Hirxpert addon shortcodes
		if( is_admin() ) add_action( 'init', array( $this, 'init_addons' ), 20 );
		
		add_action( 'init', array( $this, 'init_front_addons' ), 10 );

		//Create cuatom sidebars
		add_action( 'widgets_init', array( $this, 'hirxpert_sidebar_registration' ), 1 );
		
		//Connect all widgets
		$this->hirxpert_register_widgets();
		
		//Call all widgets
		add_action( 'widgets_init', array( $this, 'hirxpert_init_widgets' ), 1 );
		
		//WP actions
		$this->hirxpert_wp_action_setup();		

		//Custom functions
		$this->Hirxpert_Custom_Functions_setup();
		
		//WP admin tool bar menu
		add_action( 'admin_bar_menu', array( $this, 'hirxpert_add_toolbar_items' ), 100 );

		// Wp favicon icon 
		add_action('wp_head', [$this, 'insert_favicons'], 2);
		add_action('admin_head', [$this, 'insert_favicons'], 2);
		add_action('login_head', [$this, 'insert_favicons'], 2);
		
	}
	
	/**
	* Installs translation text domain and checks if Elementor is installed
	* @since 1.0.0
	* @access public
	* @return void
	*/
	public function hirxpert_elementor_addon_setup() {
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
		load_plugin_textdomain( 'hirxpert-addon', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	public function hirxpert_template_direct(){
		/**
		* Maintenance or coming soon mode
		*/
		require_once ( HIRXPERT_ADDON_DIR . 'maintenance/maintenance.php' );
	}

	public function hirxpert_get_option_class(){
		/**
		* Get Theme options class
		*/
		require_once ( HIRXPERT_ADDON_DIR . 'inc/class.theme-options.php' );

		/**
		* Maintenance or coming soon mode
		*/
		require_once ( HIRXPERT_ADDON_DIR . 'maintenance/maintenance.php' );
	}
	
	
	/**
	* Load required file for addons integration
	* @return void
	*/
	public function init_addons() {
		
		/**
		* Plugin options class
		*/
		require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/class.plugin-options.php' );

		/**
		* Post/Page options class
		*/
		require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/metabox/class.meta-box.php' );
		
		/**
		* Custom sidebar class
		*/
		require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/class.custom-sidebars.php' );
		
		/**
		* Custom fonts class
		*/
		require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/class.custom-fonts.php' );
		
		/**
		* Demo importer class
		*/
		require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/demo-importer/class.demo-importer.php' );

		$menu_type = Hirxpert_Theme_Option::hirxpert_options('menu-type');
		if( $menu_type == 'mega' ){
			require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/mega-menu/custom_menu.php' );
		}
				
	}

	public function init_front_addons(){
		$menu_type = Hirxpert_Theme_Option::hirxpert_options('menu-type');
		if( $menu_type == 'mega' ){
			require_once ( HIRXPERT_ADDON_DIR . 'inc/class.mega-menu.php' );
		}
	}
	
	public function hirxpert_wp_action_setup(){
		
		/**
		* Wp actions
		*/
		require_once ( HIRXPERT_ADDON_DIR . 'inc/wp-actions.php' );
		
	}

	public function hirxpert_sidebar_registration(){
		/**
		* Wp actions
		*/
		require_once ( HIRXPERT_ADDON_DIR . 'inc/class.widgets-register.php' );		
	}

	public function hirxpert_register_widgets(){
		foreach ( glob( HIRXPERT_ADDON_DIR . "widgets/*.php" ) as $filename) {
			include $filename;
		}
	}
	
	public function hirxpert_init_widgets(){
		//Call all widgets
		register_widget( 'Hirxpert_About_Widget' );
		register_widget( 'Hirxpert_Author_Widget' );
		register_widget( 'Hirxpert_Contact_Infos_Widget' );
		register_widget( 'Hirxpert_Latest_Post_Widget' );
		register_widget( 'Hirxpert_Mailchimp_Widget' );
		register_widget( 'Hirxpert_Popular_Post_Widget' );
		register_widget( 'Hirxpert_Social_Widget' );
		register_widget( 'Hirxpert_Advance_Tab_Post_Widget' );
	}

	public function Hirxpert_Custom_Functions_setup(){

		require_once ( HIRXPERT_ADDON_DIR . 'inc/class.custom-functions.php' );	
		
		/**
		 * Detect plugin. For frontend only.
		 */
		include_once ABSPATH . 'wp-admin/includes/plugin.php';
		//Woo function
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			require_once ( HIRXPERT_ADDON_DIR . 'inc/woo-functions.php' );	
		}
		
	}
	
	public function hirxpert_add_toolbar_items($admin_bar){
		$admin_bar->add_menu( array(
			'id'    => 'hirxpert-options',
			'title' => 'Hirxpert Theme Options',
			'href'  => admin_url( 'admin.php?page=hirxpert-options' ),
			'meta'  => array(
				'title' => esc_html__( 'Hirxpert Theme Options', 'hirxpert-addon' ),
			),
		));
	}

	/**
	 * Favicon icon for the site
	 */
	public function insert_favicons() {
		$favicon_option = get_option('hirxpert_options');
		$favicon_image = $favicon_option['favicon-icon']['image']['url'] ?? '';
	
		if ($favicon_image) {
			echo '<link rel="icon" href="' . esc_url($favicon_image) . '" sizes="32x32" />';
			echo '<link rel="icon" href="' . esc_url($favicon_image) . '" sizes="64x64" />';
			echo '<link rel="shortcut icon" href="' . esc_url($favicon_image) . '" />';
		}
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

} Hirxpert_Addon::get_instance();

// Get the option to disable emojis
$disable_emoji = Hirxpert_Theme_Option::hirxpert_options('emoji-script');

// If emojis are to be disabled, set up the disable function
if ($disable_emoji == '1') {
    add_action('init', 'smartwp_disable_emojis');
	error_log('Disable Emoji Option: ' . $disable_emoji);
    function smartwp_disable_emojis() {
        // Remove emoji detection and styles from front and admin
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'wp_enqueue_emoji_styles');
        remove_action('admin_print_styles', 'wp_enqueue_emoji_styles'); 
        
        // Remove emoji filters
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
        
        // Remove emoji plugin from TinyMCE
        add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
        // Remove emoji-related DNS prefetching
        add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
    }

    function disable_emojis_tinymce($plugins) {
        if (is_array($plugins)) {
            return array_diff($plugins, array('wpemoji'));
        } else {
            return array();
        }
    }

    function disable_emojis_remove_dns_prefetch($urls, $relation_type) {
        if ('dns-prefetch' === $relation_type) {
            $emoji_svg_url_bit = 'https://s.w.org/images/core/emoji/';
            foreach ($urls as $key => $url) {
                if (strpos($url, $emoji_svg_url_bit) !== false) {
                    unset($urls[$key]);
                }
            }
        }
        return $urls;
    }
}

	//Gzip Compression 
	function get_gzip_rules() {
		return '
	# BEGIN_HIRXPERT_GZIP_OUTPUT
	<IfModule mod_rewrite.c>
		<Files *.js.gz>
		AddType "text/javascript" .gz
		AddEncoding gzip .gz
		</Files>
		<Files *.css.gz>
		AddType "text/css" .gz
		AddEncoding gzip .gz
		</Files>
		<Files *.svg.gz>
		AddType "image/svg+xml" .gz
		AddEncoding gzip .gz
		</Files>
		<Files *.json.gz>
		AddType "application/json" .gz
		AddEncoding gzip .gz
		</Files>
		# Serve pre-compressed gzip assets
		RewriteCond %{HTTPS:Accept-Encoding} gzip
		RewriteCond %{REQUEST_FILENAME}.gz -f
		RewriteRule ^(.*)$ $1.gz [QSA,L]
	</IfModule>
	# END_HIRXPERT_GZIP_OUTPUT
	
	# BEGIN_HIRXPERT_GZIP_COMPRESSION
	<IfModule mod_deflate.c>
		#add content typing
		AddType application/x-gzip .gz .tgz
		AddEncoding x-gzip .gz .tgz
		# Insert filters
		AddOutputFilterByType DEFLATE text/plain
		AddOutputFilterByType DEFLATE text/html
		AddOutputFilterByType DEFLATE text/xml
		AddOutputFilterByType DEFLATE text/css
		AddOutputFilterByType DEFLATE application/xml
		AddOutputFilterByType DEFLATE application/xhtml+xml
		AddOutputFilterByType DEFLATE application/rss+xml
		AddOutputFilterByType DEFLATE application/javascript
		AddOutputFilterByType DEFLATE application/x-javascript
		AddOutputFilterByType DEFLATE application/x-httpd-php
		AddOutputFilterByType DEFLATE application/x-httpd-fastphp
		AddOutputFilterByType DEFLATE image/svg+xml
		# Drop problematic browsers
		BrowserMatch ^Mozilla/4 gzip-only-text/html
		BrowserMatch ^Mozilla/4\.0[678] no-gzip
		BrowserMatch \bMSI[E] !no-gzip !gzip-only-text/html
		<IfModule mod_headers.c>
			# Make sure proxies don\'t deliver the wrong content
			Header append Vary User-Agent env=!dont-vary
		</IfModule>
	</IfModule>
		# END GZIP COMPRESSION
		## EXPIRES CACHING ##
		
		<IfModule mod_expires.c>
		ExpiresActive On
		ExpiresDefault "access plus 1 week"
		ExpiresByType image/jpg "access plus 1 year"
		ExpiresByType image/jpeg "access plus 1 year"
		ExpiresByType image/gif "access plus 1 year"
		ExpiresByType image/png "access plus 1 year"
		ExpiresByType image/svg+xml "access plus 1 month"
		ExpiresByType text/css "access plus 1 month"
		ExpiresByType text/html "access plus 1 minute"
		ExpiresByType text/plain "access plus 1 month"
		ExpiresByType text/x-component "access plus 1 month"
		ExpiresByType text/javascript "access plus 1 month"
		ExpiresByType text/x-javascript "access plus 1 month"
		ExpiresByType application/pdf "access plus 1 month"
		ExpiresByType application/javascript "access plus 1 months"
		ExpiresByType application/x-javascript "access plus 1 months"
		ExpiresByType application/x-shockwave-flash "access plus 1 month"
		ExpiresByType image/x-icon "access plus 1 year"
		ExpiresByType application/xml "access plus 0 seconds"
		ExpiresByType application/json "access plus 0 seconds"
		ExpiresByType application/ld+json "access plus 0 seconds"
		ExpiresByType application/xml "access plus 0 seconds"
		ExpiresByType text/xml "access plus 0 seconds"
		ExpiresByType application/x-web-app-manifest+json "access plus 0 seconds"
		ExpiresByType text/cache-manifest "access plus 0 seconds"
		ExpiresByType audio/ogg "access plus 1 month"
		ExpiresByType video/mp4 "access plus 1 month"
		ExpiresByType video/ogg "access plus 1 month"
		ExpiresByType video/webm "access plus 1 month"
		ExpiresByType application/atom+xml "access plus 1 hour"
		ExpiresByType application/rss+xml "access plus 1 hour"
		ExpiresByType application/font-woff "access plus 1 month"
		ExpiresByType application/vnd.ms-fontobject "access plus 1 month"
		ExpiresByType application/x-font-ttf "access plus 1 month"
		ExpiresByType font/opentype "access plus 1 month"
		</IfModule>
		#Alternative caching using Apache`s "mod_headers", if it`s installed.
		#Caching of common files - ENABLED
		<IfModule mod_headers.c>
		<FilesMatch "\.(ico|pdf|flv|swf|js|css|gif|png|jpg|jpeg|ico|txt|html|htm)$">
		Header set Cache-Control "max-age=2592000, public"
		</FilesMatch>
		</IfModule>
		
		<IfModule mod_headers.c>
			<FilesMatch "\.(js|css|xml|gz)$">
			Header append Vary Accept-Encoding
			</FilesMatch>
		# Set Keep Alive Header
		Header set Connection keep-alive
		</IfModule>
		
		<IfModule mod_gzip.c>
			mod_gzip_on Yes
			mod_gzip_dechunk Yes
			mod_gzip_item_include file \.(html?|txt|css|js|php|pl)$
			mod_gzip_item_include handler ^cgi-script$
			mod_gzip_item_include mime ^text/.*
			mod_gzip_item_include mime ^application/x-javascript.*
			mod_gzip_item_exclude mime ^image/.*
			mod_gzip_item_exclude rspheader ^Content-Encoding:.*gzip.*
		</IfModule>
		
		# If your server don`t support ETags deactivate with "None" (and remove header)
		<IfModule mod_expires.c>
			<IfModule mod_headers.c>
			Header unset ETag
			</IfModule>
			FileETag None
		</IfModule>
		## EXPIRES CACHING ##
		# END_HIRXPERT_GZIP_COMPRESSION';
	}
	
	function manage_gzip_rules() {
		$gzip_enabled = Hirxpert_Theme_Option::hirxpert_options("gzip-comp");
		$rules = get_gzip_rules();
		$htaccess_file = ABSPATH . '.htaccess';
		
		if (is_writable($htaccess_file)) {
			$htaccess_content = file_get_contents($htaccess_file);
			if ($gzip_enabled) {
				if (strpos($htaccess_content, $rules) === false) {
					$htaccess_content .= $rules;
					file_put_contents($htaccess_file, $htaccess_content);
				}
			} else {
				if (strpos($htaccess_content, $rules) !== false) {
					$htaccess_content = str_replace($rules, '', $htaccess_content);
					file_put_contents($htaccess_file, $htaccess_content);
				}
			}
		}
	}
	
	add_action('admin_init', 'manage_gzip_rules');
	
	add_action('wp_ajax_update_gzip_setting', 'update_gzip_setting_callback');
	function update_gzip_setting_callback() {
		$gzip_enabled = isset($_POST['gzip_enabled']) ? sanitize_text_field($_POST['gzip_enabled']) : 0;
		update_option('gzip-comp', $gzip_enabled);
		wp_die();
	}
	$woo_commerce = Hirxpert_Theme_Option::hirxpert_options("woo-scripts-styles");
	if ($woo_commerce) {
	
		function is_wc_page() {
			return class_exists('WooCommerce') && (is_woocommerce() || is_cart() || is_checkout() || is_account_page());
		}
	
		add_action('template_redirect', 'conditionally_remove_wc_assets');

		/**
		 * Remove WC stuff on non WC pages.
		 */
		function conditionally_remove_wc_assets() {
			if (is_wc_page()) {
				return;
			}
	
			// remove WC generator tag
			remove_filter('get_the_generator_html', 'wc_generator_tag', 10, 2);
			remove_filter('get_the_generator_xhtml', 'wc_generator_tag', 10, 2);
	
			// unload WC scripts
			remove_action('wp_enqueue_scripts', [WC_Frontend_Scripts::class, 'load_scripts']);
			remove_action('wp_print_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
			remove_action('wp_print_footer_scripts', [WC_Frontend_Scripts::class, 'localize_printed_scripts'], 5);
	
			// remove "Show the gallery if JS is disabled"
			remove_action('wp_head', 'wc_gallery_noscript');
	
			// remove WC body class
			remove_filter('body_class', 'wc_body_class');
		}
	
		add_filter('woocommerce_enqueue_styles', 'conditionally_woocommerce_enqueue_styles');
		/**
		 * Unload WC stylesheets on non WC pages
		 *
		 * @param array $enqueue_styles
		 * @return array
		 */
		function conditionally_woocommerce_enqueue_styles($enqueue_styles) {
			return is_wc_page() ? $enqueue_styles : [];
		}
	
		add_action('wp_enqueue_scripts', 'conditionally_wp_enqueue_scripts');
		/**
		 * Remove inline style on non WC pages
		 */
		function conditionally_wp_enqueue_scripts() {
			if (!is_wc_page()) {
				wp_dequeue_style('woocommerce-inline');
			}
		}
	}

function zozo_default_kits_init() {
    if (is_plugin_active('elementor/elementor.php')) {
	
			$kit_id = (new \Elementor\Core\Kits\Manager())->get_active_id();
	
			if (!$kit_id) {
				return;
			}
	
			$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers('page');
			$meta_key = \Elementor\Core\Settings\Page\Manager::META_KEY;
			$kit_settings = get_post_meta($kit_id, $meta_key, true);
	
			// Check if the custom settings are already applied
			if (isset($kit_settings['zozo_applied']) && $kit_settings['zozo_applied']) {
				return;
			}
	
			$zozo_settings = [];
			$settings = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
	
			// Update system colors
			$system_items = $settings->get_settings_for_display('system_colors') ?: [];
			$system_items[0]['color'] = '#014E4E';
			$system_items[1]['color'] = '#F9D67B';
			$system_items[2]['color'] = '#666666';
			$system_items[3]['color'] = '#EAEEF1';
	
			$zozo_settings['system_colors'] = $system_items;
	
			// Update layout settings to set content width to 1400px
			$layout_settings = $settings->get_settings_for_display('container_width') ?: [];
			$layout_settings['elementor-slider-input'] = '1300';
			$layout_settings['container_width'] = '1300';
	
			$zozo_settings['page_layout'] = $layout_settings;
	
			// Flag to prevent reapplying settings
			$zozo_settings['zozo_applied'] = true;
	
			// Merge and save the settings
			if (!$kit_settings) {
				update_metadata('post', $kit_id, $meta_key, $zozo_settings);
			} else {
				$kit_settings = array_merge($kit_settings, $zozo_settings);
				$page_settings_manager->save_settings($kit_settings, $kit_id);
			}
	
			update_option('elementor_active_full_import', 'yes');
			\Elementor\Plugin::$instance->files_manager->clear_cache();
		}
	}
	
add_action('elementor/init', 'zozo_default_kits_init', 10);
	
function hirxpert_addon_marquee_shortcode($atts, $content = null) {
    $atts = shortcode_atts(
        array(
            'direction'       => 'left',      // direction can be left, right, up, down
            'speed'           => 'normal',    // speed can be 'slow', 'normal', 'fast'
            'loop'            => 'infinite',  // number of loops or 'infinite'
            'color'           => '#000000',   // default text color
            'background_color'=> '#ffffff',   // default background color
            'font_size'       => '16px'       // default font size
        ),
        $atts,
        'hirxpert_marquee'
    );
    
    $speed_map = array(
        'slow'   => '10s',
        'normal' => '5s', // default speed
        'fast'   => '3s'
    );
    
	// animation speed and duration can be handled
    $animation_duration = isset($speed_map[$atts['speed']]) ? $speed_map[$atts['speed']] : '5s';
    
    $output = '<div class="hirxpert-marquee" style="animation-duration:' . esc_attr($animation_duration) . ';';
    $output .= 'color:' . esc_attr($atts['color']) . ';';
    $output .= 'background-color:' . esc_attr($atts['background_color']) . ';';
    $output .= 'font-size:' . esc_attr($atts['font_size']) . ';">';
    $output .= '<marquee behavior="scroll" direction="' . esc_attr($atts['direction']) . '" loop="' . esc_attr($atts['loop']) . '">';
    $output .= do_shortcode($content);
    $output .= '</marquee>';
    $output .= '</div>';

    return $output; // return output
}
add_shortcode('hirxpert_marquee', 'hirxpert_addon_marquee_shortcode');