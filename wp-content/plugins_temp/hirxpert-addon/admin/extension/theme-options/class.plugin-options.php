<?php

/**
 * Hirxpert Theme Options
 * @since 1.0.0
 */
final class Hirxpert_Plugin_Options { //hirxpert_admin_menu_out
	
	private static $_instance = null;
	
	public function __construct() {	
		add_action( 'admin_menu', array( $this, 'hirxpert_addon_options_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'hirxpert_framework_admin_scripts' ) );
		$this->init();

		//import
		add_action( 'wp_ajax_bridddge-theme-option-import', array( $this, 'hirxpert_redux_themeopt_import' ) );

		//export
		add_action('wp_ajax_hirxpert-theme-options-export', array( $this, 'hirxpert_theme_options_export' ) );
		
	}
	
	public static function hirxpert_addon_options_menu(){
		add_submenu_page( 
			'hirxpert-welcome', 
			esc_html__( 'Theme Options', 'hirxpert-addon' ),
			esc_html__( 'Theme Options', 'hirxpert-addon' ), 
			'manage_options', 
			'hirxpert-options', 
			array( 'Hirxpert_Plugin_Options', 'hirxpert_options_admin_page' )
		);
	}
	
	public static function hirxpert_framework_admin_scripts(){
		if( isset( $_GET['page'] ) && $_GET['page'] == 'hirxpert-options' ){
			wp_enqueue_style( 'font-awesome', HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/css/font-awesome.min.css', array(), '4.7.0', 'all' );			
			wp_enqueue_style( 'bootstrap-icons', HIRXPERT_URI . '/assets/css/bootstrap-icons.css', array(), '1.9.1', 'all' );
			
			wp_enqueue_media();
			wp_enqueue_style( 'hirxpert_theme_options_css', HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/css/theme-options.css', array(), '1.0', 'all' );
			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_script( 'wp-color-picker-alpha', HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/js/wp-color-picker-alpha.min.js', array( 'jquery', 'wp-color-picker' ), '3.0.0' );
			wp_enqueue_script( 'hirxpert_theme_options_js', HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/js/theme-options.js', array( 'jquery' ), '1.0', true );

			wp_localize_script( 'hirxpert_theme_options_js', 'hirxpert_ajax_object',
				array(
					'import_nonce' => wp_create_nonce( 'hirxpert-import-*&^F&' ),
					'export_nonce' => wp_create_nonce( 'hirxpert-export-&^%$)' ),
				)
			);

			require_once HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/googlefonts.php';
			$google_fonts = Hirxpert_Google_Fonts_Function::$_google_fonts;
			$google_fonts_arr = json_decode( $google_fonts, true );
			
			$extra_gf = array(
				"Spartan" => array(
					"variants" => array(
						array( "id" => "400", "name" => "Thin 100" ),
						array( "id" => "400", "name" => "Extra-light 200" ),
						array( "id" => "400", "name" => "Light 300" ),
						array( "id" => "400", "name" => "Regular 400" ),
						array( "id" => "400", "name" => "Medium 500" ),
						array( "id" => "400", "name" => "Semi-bold 600" ),
						array( "id" => "400", "name" => "Bold 700" ),
						array( "id" => "400", "name" => "Extra-bold 800" ),
						array( "id" => "400", "name" => "Black 900" )
					)
				)
			);
			if( is_array( $extra_gf ) && !empty( $extra_gf ) ){
				foreach( $extra_gf as $font => $details ) $google_fonts_arr[$font] = $details;
			}
			
			$google_fonts = json_encode( $google_fonts_arr );
			$google_fonts_vars = array(
				'google_fonts' => $google_fonts,
				'standard_font_variants' => Hirxpert_Google_Fonts_Function::$_standard_font_variants,
				'font_variants_default' => esc_html__( 'Font Weight &amp; Style', 'hirxpert-addon' ),
				'font_sub_default' => esc_html__( 'Font Subsets', 'hirxpert-addon' )
			);
			wp_localize_script( 'hirxpert_theme_options_js', 'google_fonts_vars', $google_fonts_vars );
			
		}
	}
	
	public function init() {
		require_once( HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/framework.php' );
		Hirxpert_Options::$opt_name = 'hirxpert_options';
	}
		
	public static function hirxpert_options_admin_page(){	
		$hirxpert_theme = wp_get_theme();
		echo '<div class="notice notice-error is-dismissible">';
		echo '<p><strong>Important Notice for Existing Users:</strong> We’ve made a significant update to the theme by removing the email and address fields while introducing flexible HTML fields for greater customization. If needed, you can now add these details manually using the new HTML fields. <a href="https://zozothemes.com/update-notice" target="_blank">Learn more about this update</a>.</p>';
		echo '</div>';
		?>	
		<form method="post" action="#" enctype="multipart/form-data" id="hirxpert-plugin-form-wrapper">
			<div class="hirxpert-settings-wrap">
			<div class="hirxpert-header-bar">
				<div class="hirxpert-header-left">
					<div class="hirxpert-admin-logo-inline">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand-logo.png' ); ?>" alt="hirxpert-logo">
					</div><!-- .hirxpert-admin-logo-inline -->
					<h2 class="title"><?php esc_html_e( 'Hirxpert Options', 'hirxpert-addon' ); ?><span class="hirxpert-version"><?php echo esc_attr( $hirxpert_theme->get( 'Version' ) ); ?></span></h2>
					<div class="nav-theme-options">
						<?php
						include_once(ABSPATH . 'wp-admin/includes/plugin.php');
						$is_hirxpert_addon_active = is_plugin_active('hirxpert-addon/hirxpert-addon.php');
						$current_theme = wp_get_theme();
						$is_theme_active = ($current_theme->get('Name') === 'Hirxpert');
						$verfied_stat = get_option('verified_purchase_status');

						if ($is_hirxpert_addon_active) {
							echo '<a href="' . admin_url('admin.php?page=hirxpert-options') . '" class="active-page"><span class="dashicons dashicons-admin-tools"></span>Theme Options</a>';
						} else {
							echo '<a href="#" class="theme-options not-clickable" data-popup-message="Please install and activate the Hirxpert Addon plugin."><span class="dashicons dashicons-admin-tools"></span>Theme Options</a>';
						}
						if ($verfied_stat) {
							echo '<a href="' . admin_url('admin.php?page=hirxpert-plugins') . '"><span class="dashicons dashicons-admin-plugins"></span>Plugins</a>';
						} else {
							echo '<a href="#" class="not-clickable" data-popup-message="Please activate the Hirxpert theme."><span class="dashicons dashicons-admin-plugins"></span>Plugins</a>';
						}
						?>
						<div class="support-dropdown">
							<a href="#" class="dropdown-toggle"><span class="dashicons dashicons-buddicons-buddypress-logo"></span>Support</a>
							<div class="dropdown-content">
								<a href="https://zozothemes.com/knowledge-base/" target="_blank"><span class="dashicons dashicons-tickets-alt"></span>Ticket</a>
								<a href="https://zozothemes.com/knowledge-base/" target="_blank"><span class="dashicons dashicons-video-alt3"></span>Video</a>
								<a href="https://docs.zozothemes.com/hirxpert/" target="_blank"><span class="dashicons dashicons-text-page"></span>Documentation</a>
								<a href="https://zozothemes.com/knowledge-base/" target="_blank"><span class="dashicons dashicons-book-alt"></span>Knowledge Base</a>
							</div>
						</div>
						<a href="https://zozothemes.com/forum/" target="_blank"><span class="dashicons dashicons-format-chat"></span>Forum</a>
					</div>
				</div><!-- .hirxpert-header-left -->
				<div class="hirxpert-header-right">
					<button type="submit" class="button hirxpert-btn"><?php esc_html_e( 'Save Settings', 'hirxpert-addon' ); ?></button>
				</div><!-- .hirxpert-header-right -->
			</div><!-- .hirxpert-header-bar -->	
				
				<div class="hirxpert-inner-wrap">
						
					<?php
						if ( isset( $_POST['save_hirxpert_theme_options'] ) && wp_verify_nonce( $_POST['save_hirxpert_theme_options'], 'hirxpert_theme_options*&^&*$' ) ) {
							update_option( 'hirxpert_options', $_POST['hirxpert_options'] );
							require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/theme-options-css.php' );
						}
						//Get updated theme option
						Hirxpert_Options::$hirxpert_options = get_option('hirxpert_options');
						
						if( class_exists( 'Classic_Elementor_Addon' ) ){
							add_action( 'hirxpert_custom_template_options', function(){
								require_once HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/cea-config.php';
							});
						}
						//Theme config
						require_once HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/config.php';
					?>
					<div class="hirxpert-admin-content-wrap">
						<?php wp_nonce_field( 'hirxpert_theme_options*&^&*$', 'save_hirxpert_theme_options' ); ?>
						<div class="hirxpert-tab">
							<div class="hirxpert-tab-list">
								<ul class="tablinks-list">
									<?php Hirxpert_Options::hirxpert_put_section(); 
										if (is_plugin_active('classic-elementor-addons-pro/index.php')): ?>
											<div class="hirxpert-navigation-buttons">
												<a href="<?php echo admin_url('admin.php?page=classic-addons'); ?>" target="_blank" class="button hirxpert-btn"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i><?php esc_html_e('CEA Plugin Options', 'hirxpert'); ?></a>
											</div>
										<?php endif; 
									?>
								</ul>
							</div><!-- .hirxpert-tab-list -->
							<div class="hirxpert-tab-contents">
								
							<!-- <a href="https://docs.zozothemes.com/hirxpert/" target="_blank" class="docs-tooltip" title="Documentation"><span class="dashicons dashicons-editor-help theme-info"></span></a> -->
								<?php Hirxpert_Options::hirxpert_put_field(); ?>
							</div><!-- .hirxpert-tab-contents -->
						</div><!-- .hirxpert-tab -->					
					</div><!-- .hirxpert-admin-content-wrap -->					
				</div><!-- .hirxpert-inner-wrap -->
			</div><!-- .hirxpert-settings-wrap -->
			<div class="hirxpert-db-footer">
					<div class="hirxpert-db-footer-top">
						<nav class="hirxpert-db-footer-menu">
						<div class="copyright-text-wrap">Copyrights  © <script>document.write(new Date().getFullYear())</script> Designed by 
						<a href="https://zozothemes.com/" class="theme-color" target="_blank">Zozothemes <span class="heart-color">♥</span></a></div>
							<ul>
								<li>
									<a href="https://docs.zozothemes.com/hirxpert/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Documentation', 'hirxpert-addon' ); ?></a>
								</li>
								<li>
									<a href="https://zozothemes.com/knowledge-base/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Video Tutorials', 'hirxpert--addon' ); ?></a>
								</li>
								<li>
									<a href="https://zozothemes.com/knowledge-base/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Submit A Ticket', 'hirxpert--addon' ); ?></a>
								</li>
							</ul>
						</nav>
					</div>
			</div>
		</form>	
	<?php
	}

	public static function hirxpert_theme_options_export(){
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : '';
		if ( ! wp_verify_nonce( $nonce, 'hirxpert-export-&^%$)' ) )
			die ( esc_html__( 'Busted!', 'hirxpert-addon' ) );
		
		$hirxpert_options = get_option( 'hirxpert_options');
		$hirxpert_options = is_array( $hirxpert_options ) ? array_map( 'stripslashes_deep', $hirxpert_options ) : stripslashes( $hirxpert_options );
		echo json_encode( $hirxpert_options );
		
		exit;
	}

	public static function hirxpert_redux_themeopt_import(){
		$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( $_POST['nonce'] ) : ''; //Sanitize
		if ( ! wp_verify_nonce( $nonce, 'hirxpert-import-*&^F&' ) )
			die ( esc_html__( 'Busted', 'hirxpert-addon' ) );
		
		$json_data = isset( $_POST['json_data'] ) ? stripslashes( urldecode( $_POST['json_data'] ) ) : '';
		$theme_opt_arr = json_decode( $json_data, true );
		if( !empty( $theme_opt_arr ) ){
			update_option( 'hirxpert_options', $theme_opt_arr );
		}
		
		wp_die('success');
	}
	
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

}

Hirxpert_Plugin_Options::instance();