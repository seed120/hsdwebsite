<?php
defined( 'ABSPATH' ) or die( 'You cannot access this script directly' );
/* ================================================
 * Importer
 * ================================================ */
 
// Don't resize images
function hirxpert_zozo_import_filter_image_sizes( $sizes ) {
	return array();
}
 
/* ================================================
 * Ajax Hook for Importer
 * ================================================ */
 
/*Custom Code Start*/

function hirxpert_get_server_files($url){
	$args = array( 'timeout' => 3000 );
	$response = wp_remote_get($url, $args);
	$data = wp_remote_retrieve_body($response);
	return $data;
}
 
class hirxpertZozoImporterModule {

	public static $messages = array();
	public static $parts = array();
	public static $import_stat = 0;

	function __construct() {}
	
	public static function check_credentials() {
		// Get user credentials for WP filesystem API
		$demo_import_page_url = wp_nonce_url( 'admin.php?page=hirxpert-importer', 'hirxpert-importer' );
		if ( false === ( $creds = request_filesystem_credentials( $demo_import_page_url, '', false, false, null ) ) ) {
			return new WP_Error( 'XML_parse_error', __( 'There was an error when reading this WXR file', 'klenster' ) );
		}
		// Now we have credentials, try to get the wp_filesystem running
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again
			request_filesystem_credentials( $demo_import_page_url, '', true, false, null );
			return true;
		}
	}
	
	public static function hirxpert_credentials(){
		/* you can safely run request_filesystem_credentials() without any issues and don't need to worry about passing in a URL */
		$creds = request_filesystem_credentials(site_url() . '/wp-admin/', '', false, false, array());
	
		/* initialize the API */
		if ( ! WP_Filesystem($creds) ) {
			return false;
		}
		global $wp_filesystem;
		return $wp_filesystem;
	}
	
	
	public static function hirxpert_get_available_widgets() {
		global $wp_registered_widget_controls;
		$widget_controls = $wp_registered_widget_controls;
		$available_widgets = array();
		foreach ( $widget_controls as $widget ) {
			if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes
				$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
				$available_widgets[$widget['id_base']]['name'] = $widget['name'];
			}
		}
		return $available_widgets;
	}
	
	public static function hirxpert_widgets_import_process( $data ) {
	
		global $wp_registered_sidebars;
		// Get all available widgets site supports
		$available_widgets = self::hirxpert_get_available_widgets();
		// Get all existing widget instances
		$widget_instances = array();
		foreach ( $available_widgets as $widget_data ) {
			$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
		}
		// Begin results
		$results = array();
		// Loop import data's sidebars
		foreach ( $data as $sidebar_id => $widgets ) {
			// Skip inactive widgets
			// (should not be in export file)
			if ( 'wp_inactive_widgets' == $sidebar_id ) {
				continue;
			}
			// Check if sidebar is available on this site
			// Otherwise add widgets to inactive, and say so
			if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
				$sidebar_available = true;
				$use_sidebar_id = $sidebar_id;
				$sidebar_message_type = 'success';
				$sidebar_message = '';
			} else {
				$sidebar_available = false;
				$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
				$sidebar_message_type = 'error';
				$sidebar_message = esc_html__( 'Sidebar does not exist in theme (using Inactive)', 'hirxpert-addon' );
			}
			// Result for sidebar
			$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
			$results[$sidebar_id]['message_type'] = $sidebar_message_type;
			$results[$sidebar_id]['message'] = $sidebar_message;
			$results[$sidebar_id]['widgets'] = array();
			// Loop widgets
			foreach ( $widgets as $widget_instance_id => $widget ) {
				$fail = false;
				// Get id_base (remove -# from end) and instance ID number
				$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
				$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );
				// Does site support this widget?
				if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
					$fail = true;
					$widget_message_type = 'error';
					$widget_message = esc_html__( 'Site does not support widget', 'hirxpert-addon' ); // explain why widget not imported
				}
				// Does widget with identical settings already exist in same sidebar?
				if ( ! $fail && isset( $widget_instances[$id_base] ) ) {
					// Get existing widgets in this sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' );
					$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go
					// Loop widgets with ID base
					$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
					foreach ( $single_widget_instances as $check_id => $check_widget ) {
						// Is widget in same sidebar and has identical settings?
						if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {
							$fail = true;
							$widget_message_type = 'warning';
							$widget_message = esc_html__( 'Widget already exists', 'hirxpert-addon' ); // explain why widget not imported
							break;
						}
					}
				}
				// No failure
				if ( ! $fail ) {
					// Add widget instance
					$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
					$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
					$single_widget_instances[] = (array) $widget; // add it
						// Get the key it was given
						end( $single_widget_instances );
						$new_instance_id_number = key( $single_widget_instances );
						// If key is 0, make it 1
						// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
						if ( '0' === strval( $new_instance_id_number ) ) {
							$new_instance_id_number = 1;
							$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
							unset( $single_widget_instances[0] );
						}
						// Move _multiwidget to end of array for uniformity
						if ( isset( $single_widget_instances['_multiwidget'] ) ) {
							$multiwidget = $single_widget_instances['_multiwidget'];
							unset( $single_widget_instances['_multiwidget'] );
							$single_widget_instances['_multiwidget'] = $multiwidget;
						}
						// Update option with new widget
						update_option( 'widget_' . $id_base, $single_widget_instances );
					// Assign widget instance to sidebar
					$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
					$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
					$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
					update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data
					// Success message
					if ( $sidebar_available ) {
						$widget_message_type = 'success';
						$widget_message = esc_html__( 'success', 'hirxpert-addon' );
					} else {
						$widget_message_type = 'warning';
						$widget_message = esc_html__( 'Imported to Inactive', 'hirxpert-addon' );
					}
				}
				// Result for widget instance
				$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
				$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = ! empty( $widget->title ) ? $widget->title : esc_html__( 'No Title', 'hirxpert-addon' ); // show "No Title" if widget instance is untitled
				$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
				$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;
			}
		}
		// Return results
		return $results;
	}
	
	public static function hirxpert_import_slider_file_downloads( $demo_type ){
		$wp_filesystem = self::hirxpert_credentials();
		$rev_count = '';
		if( isset( $_POST['revslider'] ) || $_POST['revslider'] != '' ){
			if( class_exists( 'RevSlider' ) ) {
				$rev_count = $_POST['revslider'];
			}//class_exists( 'RevSlider' )
		}

		if( $rev_count ){
			$sliders_from = $sliders = array();
			for( $i = 1; $i <= absint( $rev_count ); $i++ ){
				$sliders_from[$i] = hirxpert_get_server_files( "https://demo.zozothemes.com/import/sites/hirxpert/". $demo_type ."/rev_slider_". $i .".zip" );
				$sliders[$i] = HIRXPERT_ADDON_DIR . 'admin/extension/demo-importer/data/slider-'. $demo_type .'-'. $i .'.zip';
				$wp_filesystem->put_contents( $sliders[$i], $sliders_from[$i], FS_CHMOD_FILE );				
			}
		}
	}
	public static function hirxpert_import_specific_file_downloads( $demo_type, $part, $file_type ){
		$wp_filesystem = self::hirxpert_credentials();
		$file_path = HIRXPERT_ADDON_DIR . 'admin/extension/demo-importer/data/'. esc_attr( $part ) .'.'. esc_attr( $file_type );
		$url = 'https://demo.zozothemes.com/import/sites/hirxpert/'. $demo_type .'/'. esc_attr( $part ) .'.'. esc_attr( $file_type );
		$file_content = hirxpert_get_server_files($url);
		$wp_filesystem->put_contents( $file_path, $file_content, FS_CHMOD_FILE );
	}
	public static function hirxpert_general_file_ajax(){
				
		//global $zozo_import;
		$demo_type = isset( $_POST['demo_type'] ) && trim( $_POST['demo_type'] ) != '' ? $_POST['demo_type'] : 'demo';
		$key = isset( $_POST['key'] ) ? sanitize_text_field( $_POST['key'] ) : ''; // Sanitize
		$label = isset( $_POST['label'] ) ? sanitize_text_field( $_POST['label'] ) : ''; // Sanitize
		$media_parts = '';
		
		$file_type = 'json';
		if( $key == 'revslider' ){
			self::hirxpert_import_slider_file_downloads( $demo_type );
		}elseif( $key == 'media' ){
			$file_type = 'xml';
			$media_parts = isset( $_POST['media_parts'] ) ? sanitize_text_field( $_POST['media_parts'] ) : ''; // Sanitize
			if( $media_parts ){
				for( $i = 1; $i <= absint( $media_parts ); $i++ ){
					self::hirxpert_import_specific_file_downloads( $demo_type, 'parts/media-parts/'. $key. '-' .$i, $file_type );
				}
			}
		}elseif( $key == 'post' ){
			$file_type = 'xml';
			$menu_stat = isset( $_POST['menu_stat'] ) && $_POST['menu_stat'] == '1' ? true : false;
			if( $menu_stat ){
				self::hirxpert_import_specific_file_downloads( $demo_type, 'parts/post/all-post', $file_type );
			}else{
				self::hirxpert_import_specific_file_downloads( $demo_type, 'parts/post/all-post-without-menu', $file_type );
			}
		}else{
			if( $key == 'widgets' ){
				self::hirxpert_import_specific_file_downloads( $demo_type, 'custom-sidebars', $file_type );
			}		
			self::hirxpert_import_specific_file_downloads( $demo_type, $key, $file_type );
		}

		echo json_encode( array( 'status' => 'success', 'msg' => $label . ' downloaded' ) );
		wp_die();
	}
	public static function hirxpert_xml_file_ajax(){
		$demo_type = isset( $_POST['demo_type'] ) && trim( $_POST['demo_type'] ) != '' ? $_POST['demo_type'] : 'demo';
		$key = isset( $_POST['key'] ) ? sanitize_text_field( $_POST['key'] ) : '';// Sanitize
		$part = isset( $_POST['part'] ) ? sanitize_text_field( $_POST['part'] ) : '';// Sanitize
		$label = isset( $_POST['label'] ) ? sanitize_text_field( $_POST['label'] ) : '';// Sanitize

		$file_type = 'xml';
		$key = !empty( $part ) ? 'parts/'. $part .'/'. $key : $key;

		self::hirxpert_import_specific_file_downloads( $demo_type, $key, $file_type );

		echo json_encode( array( 'status' => 'success', 'msg' => $label . ' downloaded' ) );
		wp_die();
	}
	
	public static function hirxpert_theme_option_import( $key ){
		$filename = HIRXPERT_ADDON_DIR . 'admin/extension/demo-importer/data/theme-options.json';   
		$label = isset( $_POST['label'] ) ? sanitize_text_field( $_POST['label'] ) : ''; // Sanitize
		
		self::check_credentials();
				
		global $wp_filesystem;
		if($wp_filesystem->exists($filename)){
			$theme_option = $wp_filesystem->get_contents( $filename );
			if( !empty( $theme_option ) ){
				$hirxpert_options = json_decode( $theme_option, true );
				//update_option( 'hirxpert_theme_options', '' );
				update_option( 'hirxpert_options', $hirxpert_options );				
				require_once HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/googlefonts.php';
				require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/theme-options-css.php' );
			}
			echo json_encode( array( 'status' => 'success', 'msg' => $label . ' imported' ) );
		}else{
			echo json_encode( array( 'status' => 'success', 'msg' => $label . ' failure to import' ) );
		}		
	}
	
	public static function hirxpert_custom_sidebars( $key ){
		$filename = HIRXPERT_ADDON_DIR . 'admin/extension/demo-importer/data/custom-sidebars.json';
		
		self::check_credentials();
				
		global $wp_filesystem;
		if($wp_filesystem->exists($filename)){
			$sidebar_content = $wp_filesystem->get_contents( $filename );
			$sidebar_content = json_decode( $sidebar_content, true );
			update_option( 'hirxpert_custom_sidebars', $sidebar_content );
		}	
	}
	
	public static function hirxpert_widgets_import( $key ){
		$filename = HIRXPERT_ADDON_DIR . 'admin/extension/demo-importer/data/widgets.json';     
		$label = isset( $_POST['label'] ) ? sanitize_text_field( $_POST['label'] ) : '';  // Sanitize
		
		self::check_credentials();
				
		global $wp_filesystem;
		if($wp_filesystem->exists($filename)){
			$widgets_content = $wp_filesystem->get_contents( $filename );
			$widgets_json = json_decode($widgets_content, true);
			$res = self::hirxpert_widgets_import_process($widgets_json);
			echo json_encode( array( 'status' => 'success', 'msg' => $label . ' imported' ) );
		}else{
			echo json_encode( array( 'status' => 'success', 'msg' => $label . ' failure to import' ) );
		}
	}
	
	public static function hirxpert_rev_slider_import( $key ){
		if( isset( $_POST['revslider'] ) || $_POST['revslider'] != '' ){
			
			$label = isset( $_POST['label'] ) ? sanitize_text_field( $_POST['label'] ) : '';
		
			// Import Revolution Slider
			if( class_exists( 'RevSlider' ) ) {
			
				//deleted wp-load.php file
				require_once ABSPATH . 'wp-includes/functions.php';
				$demo_type = isset( $_POST['demo_type'] ) ? esc_attr( $_POST['demo_type'] ) : '';
	
				$rev_count = intval( $_POST['revslider'] );
				$slider = new RevSlider();
				for( $i = 1; $i <= $rev_count; $i++ ){                    
					$filepath = HIRXPERT_ADDON_DIR . 'admin/extension/demo-importer/data/slider-' . $demo_type . '-' . $i . '.zip';
					if ( file_exists( $filepath ) ){
						$slider->importSliderFromPost(true,true,$filepath);
					}
				}
				echo json_encode( array( 'status' => 'success', 'msg' => $label . ' imported' ) );
			}else{
				echo json_encode( array( 'status' => 'success', 'msg' => $label . ' failure to import' ) );
			}
			
		} // isset post->revslider		
	}
	
	public static function hirxpert_general_file_install_ajax(){
    
		$key = isset( $_POST['key'] ) ? sanitize_text_field( $_POST['key'] ) : '';// Sanitize
		$label = isset( $_POST['label'] ) ? sanitize_text_field( $_POST['label'] ) : '';// Sanitize
		if( $key == 'theme-options' ){
			self::hirxpert_theme_option_import( $key );
		}elseif( $key == 'widgets' ){
			self::hirxpert_custom_sidebars( $key );
			self::hirxpert_widgets_import( $key );
		}elseif( $key == 'revslider' ){
			self::hirxpert_rev_slider_import( $key );
		} elseif( $key == 'media' ){
			$inner_key = isset( $_POST['inner_key'] ) && !empty( $_POST['inner_key'] ) ? sanitize_text_field( $_POST['inner_key'] ) : 'media-1';// Sanitize
			$inner_index = isset( $_POST['inner_index'] ) && !empty( $_POST['inner_index'] ) ? sanitize_text_field( $_POST['inner_index'] ) : '1';// Sanitize
			self::hirxpert_xml_file_import( 'parts/media-parts/' . $inner_key );
			echo json_encode( array( 'status' => 'success', 'msg' => $label .' '. $inner_index .' imported' ) );	
		}elseif( $key == 'post' ){
			$menu_stat = isset( $_POST['menu_stat'] ) && $_POST['menu_stat'] == '1' ? true : false;
			if( $menu_stat ){
				self::hirxpert_xml_file_import( 'parts/post/all-post' );
			}else{
				self::hirxpert_xml_file_import( 'parts/post/all-post-without-menu' );
			}
			echo json_encode( array( 'status' => 'success', 'msg' => $label . ' imported' ) );		
		}
		wp_die();
	}
	
	public static function hirxpert_xml_file_install_ajax(){
    // Sanitize
		$key = isset( $_POST['key'] ) ? sanitize_text_field( $_POST['key'] ) : '';
		$part = isset( $_POST['part'] ) ? sanitize_text_field( $_POST['part'] ) : '';
		$label = isset( $_POST['label'] ) ? sanitize_text_field( $_POST['label'] ) : '';
		
		$key = !empty( $part ) ? 'parts/'. $part .'/'. $key : $key;

		self::hirxpert_xml_file_import( $key );
		
		echo json_encode( array( 'status' => 'success', 'msg' => $label . ' imported', 'key' => $key ) );		
		wp_die();
	}
	
	public static function hirxpert_xml_file_import( $part ){
	
		$file_path = HIRXPERT_ADDON_DIR . 'admin/extension/demo-importer/data/'. esc_attr( $part ) .'.xml';
		//importer code start here
		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
		require_once ABSPATH . 'wp-admin/includes/import.php';
		$importer_error = false;
		if ( !class_exists( 'WP_Importer' ) ) {
			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			if ( file_exists( $class_wp_importer ) ){
				require_once ABSPATH . 'wp-admin/includes/class-wp-importer.php';
			} else {
				$importer_error = true;
			}
		}
		
		if ( !class_exists( 'WP_Import' ) ) {
			$class_wp_import = HIRXPERT_ADDON_DIR . 'admin/extension/demo-importer/wordpress-importer.php';
			if ( file_exists( $class_wp_import ) ){
				require_once( $class_wp_import );
			}else {
				$importer_error = true;
			}
		}
		
		if( !$importer_error ){
			if ( class_exists( 'WP_Import' ) ) {
				add_filter('intermediate_image_sizes_advanced', 'hirxpert_zozo_import_filter_image_sizes', 10, 1);
				$wp_import = new WP_Import();
				$wp_import->fetch_attachments = true;
				
				ob_start();
				$wp_import->import( $file_path );
				$out = ob_get_clean();
			}
		}

	}
	
	public static function hirxpert_import_set_default_settings(){

		$demo_type = isset( $_POST['demo_type'] ) && trim( $_POST['demo_type'] ) != '' ? $_POST['demo_type'] : 'demo';
	
		// Reading settings
		$home_page_title = 'Home';
		$post_page_title = 'Blog';
		
		// Set reading options
		$home_page = get_page_by_title( $home_page_title );
		$post_page = get_page_by_title( $post_page_title );
		if( isset( $home_page ) && $home_page->ID ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_page->ID ); // Front Page
		}
		if( isset( $post_page ) && $post_page->ID ) {
			update_option( 'page_for_posts', $post_page->ID ); // Posts Page
		}
		
		self::hirxpert_set_demo_menus();
		
		set_theme_mod('hirxpert_installed_demo_id', esc_attr( $demo_type ));
		set_theme_mod('hirxpert_demo_installed', 1);
		
		echo json_encode( array( 'status' => 'success', 'msg' => 'import process done.' ) );		
		wp_die();
	}
	
	public static function hirxpert_set_demo_menus(){
		/* Set imported menus to Registered Menu locations in Theme */
				
		// Registered Menu Locations in Theme
		$locations = get_theme_mod( 'nav_menu_locations' );
		// Get Registered menus
		$menus = wp_get_nav_menus();
		
		// Assign menus to theme locations 
		if( is_array($menus) ) {
			foreach( $menus as $menu ) {
				if( $menu->name == 'Primary Menu' ) {
					$locations['primary'] = $menu->term_id;
				} else if( $menu->name == 'Top Menu' ) {
					$locations['top-menu'] = $menu->term_id;
				} else if( $menu->name == 'Footer Menu' ) {
					$locations['footer-menu'] = $menu->term_id;
				}
			}
		}
		set_theme_mod( 'nav_menu_locations', $locations );
	}
	
	public static function hirxpert_uninstall_demo(){

		$args = array(
			'post_type' => array('attachment'),
			'post_status' => 'inherit',
			'posts_per_page' => '-1',
			'meta_query' => array(
				array(
					'key'     => 'hirxpert_demo_attachment_key',
					'value'   => 1,
				),
			)
		);
		$query = new WP_Query( $args );
		if (!empty($query->posts)) {
			foreach ($query->posts as $post) {
				wp_delete_attachment($post->ID, true);
				
			}
		}
		
		$args = array(
			'post_type' => array('page', 'post'),
			'posts_per_page' => '-1',
			'meta_query' => array(
				array(
					'key'     => 'hirxpert_demo_content_key',
					'value'   => 1,
				),
			)
		);
		$query = new WP_Query( $args );
		if (!empty($query->posts)) {
			foreach ($query->posts as $post) {
				wp_delete_post($post->ID, true);
				
			}
		}
		
		$args = array(
			'taxonomy'		=> 'category',
			'orderby'		=> 'name',
			'hide_empty'	=> 0,
			'meta_query'	=> array(
				array(
					'key'     => 'hirxpert_demo_term_key',
					'value'   => 1,
				),
			)
		);
		$terms = get_terms( $args );
		
		if( !empty( $terms ) ){
			foreach( $terms as $terms ) {
				wp_delete_term( $terms->term_id, 'category' );
			}
		}
		
		$args = array(
			'taxonomy'		=> 'post_tag',
			'orderby'		=> 'name',
			'hide_empty'	=> 0,
			'meta_query'	=> array(
				array(
					'key'     => 'hirxpert_demo_term_key',
					'value'   => 1,
				),
			)
		);
		$terms = get_terms( $args );
		
		if( !empty( $terms ) ){
			foreach( $terms as $terms ) {
				wp_delete_term( $terms->term_id, 'post_tag' );
			}
		}
		
		$menu_names = array('primary-menu', 'footer-menu', 'top-menu');
		foreach( $menu_names as $menu )
			wp_delete_nav_menu($menu);
		
		//Empty theme option values
		delete_option( 'hirxpert_theme_options' ); 
		//hirxpert_default_theme_options();
		
		update_option('sidebars_widgets', array());	
		
		set_theme_mod('hirxpert_installed_demo_id', '');
		set_theme_mod('hirxpert_demo_installed', 0);
		
		wp_die( "success" );
	}
	
	public static function hirxpert_check_file_access_permission(){
		
		$access_type = get_filesystem_method();
		if( $access_type != 'direct' ){
			echo json_encode( array( 'status' => 'failed', 'msg' => esc_html__( 'File access permission problem.', 'hirxpert-addon' ) ) );
		}else{
			echo json_encode( array( 'status' => 'success', 'msg' => esc_html__( 'File access permission success.', 'hirxpert-addon' ) ) );
		}
		
	}	

}