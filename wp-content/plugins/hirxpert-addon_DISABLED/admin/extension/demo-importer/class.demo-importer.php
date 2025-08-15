<?php 
class Hirxpert_Demo_Importer {
	
	private static $_instance = null;
	
	public static $ins_demo_stat;
	
	public static $ins_demo_id;
	public function __construct() {
		
		$this->set_installed_demo_details();
		
		add_action( 'admin_menu', array( $this, 'hirxpert_addon_admin_menu' ) );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'hirxpert_enqueue_admin_script' ) );
		
	}
	
	public static function hirxpert_addon_admin_menu(){
		add_submenu_page( 
			'hirxpert-welcome', 
			esc_html__( 'Demo Importer', 'hirxpert-addon' ),
			esc_html__( 'Demo Importer', 'hirxpert-addon' ), 
			'manage_options', 
			'hirxpert-importer', 
			array( 'Hirxpert_Demo_Importer', 'hirxpert_demo_import_admin_page' )
		);
	}
	
	private function set_installed_demo_details(){
		self::$ins_demo_stat = get_theme_mod( 'hirxpert_demo_installed' );
		self::$ins_demo_id = get_theme_mod( 'hirxpert_installed_demo_id' );
	}
	
	public function hirxpert_enqueue_admin_script(){
		
		if( isset( $_GET['page'] ) && $_GET['page'] == 'hirxpert-importer' ){
		
			wp_enqueue_style( 'hirxpert-confirm', HIRXPERT_ADDON_URL . 'admin/extension/demo-importer/assets/css/jquery-confirm.min.css' );
			wp_enqueue_script( 'hirxpert-confirm', HIRXPERT_ADDON_URL . 'admin/extension/demo-importer/assets/js/jquery-confirm.min.js', array( 'jquery' ), '1.0', true ); 
			
			wp_enqueue_script( 'hirxpert-import-scripts', HIRXPERT_ADDON_URL . 'admin/extension/demo-importer/assets/js/demo-import.js', array( 'jquery' ), '1.7.5', true ); 
			wp_enqueue_style( 'bootstrap-icons', HIRXPERT_URI . '/assets/css/bootstrap-icons.css', array(), '1.9.1', 'all' );
			
			//Import Localize Script
			$demo_import_args = array(
				'admin_ajax_url' => esc_url( admin_url('admin-ajax.php') ),
				'nonce' => wp_create_nonce('hirxpert-options-import'),		
				'proceed' => esc_html__('Proceed', 'hirxpert'),
				'cancel' => esc_html__('Cancel', 'hirxpert'),
				'process' => esc_html__( 'Processing', 'hirxpert-addon' ),
				'uninstalling' => esc_html__('Uninstalling...', 'hirxpert'),
				'uninstalled' => esc_html__('Uninstalled.', 'hirxpert'),
				'unins_pbm' => esc_html__('Uninstall Problem!.', 'hirxpert'),
				'downloading' => esc_html__('Demo import process running...', 'hirxpert'), 
				'hirxpert_import_url' => admin_url( 'admin.php?page=hirxpert-importer' ),
				'regenerate_thumbnails_url' => admin_url( 'plugin-install.php?tab=plugin-information&plugin=regenerate-thumbnails' )				
			);
			$demo_import_args = apply_filters( 'hirxpert_demo_import_args', $demo_import_args );
			wp_localize_script( 'hirxpert-import-scripts', 'hirxpert_admin_ajax_var', $demo_import_args );
		}
		
	}
	
	public static function hirxpert_demo_div_generater( $demo_array ){
		
		$ins_demo_stat = self::$ins_demo_stat;
		$ins_demo_id = self::$ins_demo_id;
		
		$demo_class = '';
		if( $ins_demo_stat == 1 ){
			if( $ins_demo_id == $demo_array['demo_id'] ){
				$demo_class .= ' demo-actived';
			}else{
				$demo_class .= ' demo-inactive';
			}
		}else{
			$demo_class .= ' demo-active';
		}
	
		$revslider = isset( $demo_array['revslider'] ) && $demo_array['revslider'] != '' ? $demo_array['revslider'] : '';
		$media_parts = isset( $demo_array['media_parts'] ) && $demo_array['media_parts'] != '' ? $demo_array['media_parts'] : '';
		
		?>
		
		
		<div class="admin-box demo-wrap">
			<div class="install-plugin-wrap theme zozothemes-demo-item<?php echo esc_attr( $demo_class ); ?>">
				<div class="install-plugin-inner">
				
					<div class="zozo-demo-import-loader zozo-preview-<?php echo esc_attr( $demo_array['demo_id'] ); ?>"><i class="dashicons dashicons-admin-generic"></i></div>
					
					<div class="installation-progress">
						<span class="progress-text"></span>
						<div class="progress">
							<div class="progress-bar" style="width:0%"></div>
						</div>
					</div>
				
					<div class="theme-screenshot zozotheme-screenshot">
						<a href="<?php echo esc_url( $demo_array['demo_url'] ); ?>" target="_blank"><img src="<?php echo esc_url( HIRXPERT_ADDON_URL . 'admin/extension/demo-importer/assets/images/demo/' . $demo_array['demo_img'] ); ?>" class="demo-img" /></a>
					</div>
					<div class="install-plugin-right">
						<div class="install-plugin-right-inner">
							<h3 class="theme-name" id="<?php echo esc_attr( $demo_array['demo_id'] ); ?>"><?php echo esc_attr( $demo_array['demo_name'] ); ?></h3>
							
							<a href="#" class="theme-demo-install-custom"><?php esc_html_e( "Custom Choice", "hirxpert" ); ?></a>
							
							<div class="theme-demo-install-parts" id="<?php echo esc_attr( 'demo-install-parts-'. $demo_array['demo_id'] ); ?>">
							
								<div class="demo-install-instructions">
									<ul class="install-instructions">
										<li><strong><?php esc_html_e( "General", "hirxpert" ); ?></strong></li>
										<li><?php esc_html_e( 'Choose "Media" -> All the media\'s are ready to be import.', "hirxpert" ); ?></li>
										<li><?php esc_html_e( 'Choose "Theme Options" -> Theme options are ready to be import.', "hirxpert" ); ?></li>
										<li><?php esc_html_e( 'Choose "Widgets" -> Custom sidebars and widgets are ready to be import.', "hirxpert" ); ?></li>
										<?php if( $revslider ) : ?>
										<li><?php esc_html_e( 'Choose "Revolution Sliders" -> Revolution slides are ready to be import.', "hirxpert" ); ?></li>
										<?php endif; ?>
										<li><?php esc_html_e( 'Choose "All Posts" -> Posts, menus, custom post types are ready to be import.', "hirxpert" ); ?></li>
										<li><p class="lead"><strong>*</strong><?php esc_html_e( 'If you check "All Posts" and Uncheck any of page, then menu will not imported.', "hirxpert" ); ?></p></li>
										
										<li><strong><?php esc_html_e( "Pages", "hirxpert" ); ?></strong></li>
										<li><?php esc_html_e( 'Choose pages which you want to show on your site. If you choose all the pages and check "All Post" menu will be import. If any one will not check even page or All posts, then menu will not import.', "hirxpert" ); ?></li>
									</ul>
								</div>
							
								<div class="zozo-col-3">
									<h5><?php esc_html_e( "General", "hirxpert" ); ?></h5>
									<?php
									if( isset( $demo_array['general'] )	 ){
										echo '<ul class="general-install-parts-list">';
										foreach( $demo_array['general'] as $key => $value ){
											echo '<li><input type="checkbox" value="'. esc_attr( $key ) .'" data-text="'. esc_attr( $value ) .'" /> '. esc_html( $value ) .'</li>';
										}
										echo '</ul>';
									}						
									?>
								</div><!-- .zozo-col-3 -->
								<div class="zozo-col-3">
									<h5><?php esc_html_e( "Pages", "hirxpert" ); ?></h5>
									<?php
									if( isset( $demo_array['pages'] )	 ){
										echo '<ul class="page-install-parts-list">';
										foreach( $demo_array['pages'] as $key => $value ){
											echo '<li><input type="checkbox" value="'. esc_attr( $key ) .'" data-text="'. esc_attr( $value ) .'" /> '. esc_html( $value ) .'</li>';
										}
										echo '</ul>';
									}						
									?>
								</div><!-- .zozo-col-3 -->
								<a href="#" class="theme-demo-install-checkall"><?php esc_html_e( "Check/Uncheck All", "hirxpert" ); ?></a>
								<p><?php esc_html_e( "Leave empty/uncheck all to full install.", "hirxpert" ); ?></p>
							</div><!-- .theme-demo-install-parts -->
							<div class="theme-actions theme-buttons">
								<a class="button button-primary button-install-demo" data-demo-id="<?php echo esc_attr( $demo_array['demo_id'] ); ?>" data-revslider="<?php echo esc_attr( $revslider ); ?>" data-media="<?php echo esc_attr( $media_parts ); ?>" href="#">
								<?php esc_html_e( "Import", "hirxpert" ); ?>
								</a>
								<a class="button button-primary button-uninstall-demo" data-demo-id="<?php echo esc_attr( $demo_array['demo_id'] ); ?>" href="#">
								<?php esc_html_e( "Uninstall", "hirxpert" ); ?>
								</a>
								<a class="button button-primary button-preview-demo" target="_blank" href="<?php echo esc_url( $demo_array['demo_url'] ); ?>">
								<?php esc_html_e( "Preview", "hirxpert" ); ?>
								</a>
							</div>
							
						</div><!-- .install-plugin-right-inner -->
					</div><!-- .install-plugin-right -->
				</div>
			</div><!-- .admin-box -->
		<?php
	}
	
	public static function hirxpert_demo_import_admin_page(){
		$hirxpert_theme = wp_get_theme();
	?>
		<div class="hirxpert-settings-wrap">
		
			<?php wp_nonce_field( 'hirxpert_demo_import_*&^^$#(*', 'hirxpert_demo_import_nonce' ); ?>
		
			<div class="hirxpert-header-bar">
				<div class="hirxpert-header-left">
					<div class="hirxpert-admin-logo-inline">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand-logo.png' ); ?>" alt="hirxpert-logo">
					</div><!-- .hirxpert-admin-logo-inline -->
					<h2 class="title"><?php esc_html_e( 'Hirxpert Demo Importer', 'hirxpert-addon' ); ?></h2>
					<div class="nav-theme-options">
						<a href="<?php echo admin_url('admin.php?page=hirxpert-options'); ?>"><span class="dashicons dashicons-admin-tools"></span>Theme Options</a>
						<a href="<?php echo admin_url('admin.php?page=hirxpert-plugins')?>"><span class="dashicons dashicons-admin-plugins"></span>Plugins</a>
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
					<a href="<?php echo esc_url( 'https://wordpress.zozothemes.com/hirxpert/' ); ?>" target="_blank" class="button hirxpert-btn"><?php esc_html_e( 'Live Demo', 'hirxpert-addon' ); ?></a>
				</div><!-- .hirxpert-header-right -->
			</div><!-- .hirxpert-header-bar -->
			
			<div class="hirxpert-settings-tabs hirxpert-demo-import-wrap">
				<div id="hirxpert-general" class="hirxpert-settings-tab active">
					<div class="container">
						<div class="row">
							<div class="col-6">							
							<?php
								
								//Demo Classic
								$demo_array = array(
									'demo_id' 	=> 'demo',
									'demo_name' => esc_html__( 'Hirxpert Main Demo', 'hirxpert-addon' ),
									'demo_img'	=> 'demo-1.jpg',
									'demo_url'	=> 'https://wordpress.zozothemes.com/hirxpert/',
									'revslider'	=> '1',
									'media_parts'	=> '18',
									'general'	=> array(
										'media' 		=> esc_html__( "Media", "hirxpert" ),
										'theme-options' => esc_html__( "Theme Options", "hirxpert" ),
										'widgets' 		=> esc_html__( "Widgets", "hirxpert" ),
										'revslider' 	=> esc_html__( "Revolution Sliders", "hirxpert" ),
										'post' 			=> esc_html__( "All Posts", "hirxpert" )
									),
									'pages'=> array(
										'1'		=> esc_html__( "Shop", "hirxpert" ),
										'2'	=> esc_html__( "Cart", "hirxpert" ),						
										'3'	=> esc_html__( "Checkout", "hirxpert" ),
										'4'	=> esc_html__( "My account", "hirxpert" ),
										'5'	=> esc_html__( "Refund and Returns Policy", "hirxpert" ),
										'6'	=> esc_html__( "Home-3", "hirxpert" ),
										'7'	=> esc_html__( "Blog", "hirxpert" ),
										'8'	=> esc_html__( "About Us", "hirxpert" ),
										'9'	=> esc_html__( "Our Services", "hirxpert" ),
										'10'	=> esc_html__( "Portfolio", "hirxpert" ),
										'11' 	=> esc_html__( "Testimonial", "hirxpert" ),
										'12'		=> esc_html__( "Team", "hirxpert" ),
										'13' 	=> esc_html__( "Contact Us", "hirxpert" ),
										'14' 	=> esc_html__( "FAQ", "hirxpert" ),
										'15'		=> esc_html__( "Home 2", "hirxpert" ),
										'16' 	=> esc_html__( "Home 5", "hirxpert" ),
										'17'		=> esc_html__( "Home 4", "hirxpert" ),
										'18' 	=> esc_html__( "Home", "hirxpert" ),
										'19' 	=> esc_html__( "Blog 2 Columns", "hirxpert" ),
										'20'	=> esc_html__( "Blog 3 Columns", "hirxpert" ),						
										'21'	=> esc_html__( "Blog 4 Columns", "hirxpert" ),
										'22'	=> esc_html__( "Blog Grid + Overlay", "hirxpert" ),
										'23'	=> esc_html__( "2 Columns With Sidebar", "hirxpert" ),
										'24'	=> esc_html__( "Blog List", "hirxpert" ),
										'25'	=> esc_html__( "Service Styles 1", "hirxpert" ),
										'26'	=> esc_html__( "Service Styles 2", "hirxpert" ),
										'27'	=> esc_html__( "Home", "hirxpert" ),
										'28'	=> esc_html__( "Service Styles 3", "hirxpert" ),
										'29'	=> esc_html__( "Portfolio Grid 4", "hirxpert" ),
										'30'	=> esc_html__( "Portfolio Grid 2", "hirxpert" ),
										'31'	=> esc_html__( "Portfolio Grid 3", "hirxpert" ),
										'32'	=> esc_html__( "Home Landing Page", "hirxpert" )	

									)
									
								);
								self::hirxpert_demo_div_generater( $demo_array );								
							?>
							
								<div class="theme-requirements" data-requirements="<?php 
									printf( '<h2>%1$s</h2> <p>%2$s</p> <h3>%3$s</h3> <ol><li>%4$s</li></ol>', 
										esc_html__( 'WARNING:', 'hirxpert-addon' ), 
										esc_html__( 'Importing demo content will give you pages, posts, theme options, sidebars and other settings. This will replicate the live demo. Clicking this option will replace your current theme options and widgets. It can also take a minutes to complete.', 'hirxpert-addon' ),
										esc_html__( 'DEMO REQUIREMENTS:', 'hirxpert-addon' ),
										esc_html__( 'Memory Limit of 128 MB and max execution time (php time limit) of 300 seconds.', 'hirxpert-addon' )
									);
								?>">
								</div>							
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	<?php
	}
	
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
} Hirxpert_Demo_Importer::get_instance();

/* Demo Import AJAX */
if( ! function_exists('hirxpert_demo_import_fun') ) {
    function hirxpert_demo_import_fun() {
		
		if( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'hirxpert_demo_import_*&^^$#(*' ) ) {
			echo "!security issue";
			wp_die(); 
		}
		
		$process = isset( $_POST['process'] ) ? sanitize_text_field($_POST['process']) : '';
		
		if( $process ){
			
			include HIRXPERT_ADDON_DIR . 'admin/extension/demo-importer/zozo-importer.php';
			
			if( $process == 'permission' ){
				hirxpertZozoImporterModule::hirxpert_check_file_access_permission();
			}elseif( $process == 'general_download' ){
				hirxpertZozoImporterModule::hirxpert_general_file_ajax();
			}elseif( $process == 'xml_download' ){
				hirxpertZozoImporterModule::hirxpert_xml_file_ajax();
			}elseif( $process == 'general_install' ){
				hirxpertZozoImporterModule::hirxpert_general_file_install_ajax();
			}elseif( $process == 'xml_install' ){
				hirxpertZozoImporterModule::hirxpert_xml_file_install_ajax();
			}elseif( $process == 'final' ){
				hirxpertZozoImporterModule::hirxpert_import_set_default_settings();
			}elseif( $process == 'uninstall' ){
				hirxpertZozoImporterModule::hirxpert_uninstall_demo();
			}
			
		}
		
		wp_die();
		
    }
    add_action('wp_ajax_hirxpert_demo_import', 'hirxpert_demo_import_fun');
}