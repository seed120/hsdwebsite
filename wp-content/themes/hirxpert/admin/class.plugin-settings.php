<?php 

class Hirxpert_Plugin_Info {
	
	private static $_parent_instance = null;
	
	public function __construct() {
		require_once HIRXPERT_DIR . '/admin/theme-plugins/tgm-init.php';
	}
		
	public static function hirxpert_get_plugins(){
		return get_plugins();
	}
		
	public static function hirxpert_does_plugin_require_update( $file_path ) {
		$repo_updates = get_site_transient( 'update_plugins' );
		$available_version = '';
		if ( isset( $repo_updates->response[ $file_path ]->new_version ) ) {
			$available_version = $repo_updates->response[ $file_path ]->new_version;			
		}
		return $available_version;
	}
		
		
	
	/**
    	 * Recursively sanitize TGMPA plugin array.
     	*
     	* @param array $plugins
     	* @return array
    	 */
    	public static function sanitize_plugins( $plugins ) {
        $sanitized_plugins = [];

        foreach ( $plugins as $slug => $plugin ) {
            $sanitized_plugin = [];

            foreach ( $plugin as $key => $value ) {
                switch ( $key ) {
                    case 'name':
                    case 'slug':
                    case 'source_type':
                    case 'file_path':
                    case 'is_callable':
                        $sanitized_plugin[ $key ] = sanitize_text_field( $value );
                        break;

                    case 'source':
                    case 'external_url':
                    case 'image_url':
                        $sanitized_plugin[ $key ] = esc_url_raw( $value );
                        break;

                    case 'required':
                    case 'force_activation':
                    case 'force_deactivation':
                        $sanitized_plugin[ $key ] = (bool) $value;
                        break;

                    case 'version':
                        $sanitized_plugin[ $key ] = sanitize_text_field( $value );
                        break;

                    default:
                        // Catch any unexpected keys safely
                        $sanitized_plugin[ $key ] = is_scalar( $value ) ? sanitize_text_field( $value ) : $value;
                        break;
                }
            }

            $sanitized_plugins[ sanitize_key( $slug ) ] = $sanitized_plugin;
        }

        return $sanitized_plugins;
    }
    	public static function hirxpert_tgm_install(){
	
		if ( ! isset( $_POST['hirxpert_bulk_nonce'] ) || ! wp_verify_nonce( $_POST['hirxpert_bulk_nonce'], 'hirxpert-bulk-plugin-install' ) ) {
			wp_die( "failed" );
		}
		require_once HIRXPERT_DIR . '/admin/theme-plugins/tgm-init.php';
					
		$plugins = isset( $_POST['plugins'] ) ? self::sanitize_plugins($_POST['plugins']) : TGM_Plugin_Activation::$instance->plugins;

		if ( isset( $_POST['hirxpert_bulk_plugins'] ) ) {
			$bulk_plugins = ($_POST['hirxpert_bulk_plugins']);
			$bulk_action = isset( $_POST['hirxpert_bulk_action'] ) && ! empty( $_POST['hirxpert_bulk_action'] ) ? sanitize_text_field( $_POST['hirxpert_bulk_action']) : 'install';
			$tgm = new TGM_Plugin_Activation;			
			$tgm->plugins = $plugins;
			if( $bulk_action == 'install' ){
				foreach( $bulk_plugins as $plugin_name ){
					$tgm->hirxpert_do_plugin_install( $plugin_name );
				}
			}elseif( $bulk_action == 'active' ){
				foreach( $bulk_plugins as $plugin_name ){
					$tgm->hirxpert_do_plugin_activate( $plugin_name );
				}
			}elseif( $bulk_action == 'install-active' ){
				foreach( $bulk_plugins as $plugin_name ){
					$tgm->hirxpert_do_plugin_install( $plugin_name, true );
				}
			}elseif( $bulk_action == 'deactive' ){
				foreach( $bulk_plugins as $plugin_name ){
					$tgm->hirxpert_force_deactivation( $plugin_name );
				}
			}
		}
		wp_die("success");
	}
	
	public static function hirxpert_plugin_link( $item ) {
		
		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		$installed_plugins = Hirxpert_Plugin_Info::hirxpert_get_plugins();
		$item['sanitized_plugin'] = $item['name'];


		$plugin_checks = array(
			'elementor' => function() { return class_exists('Elementor\Plugin'); },
			'hirxpert-addon' => function() { return class_exists('Hirxpert_Addon'); },
			'classic-elementor-addons-pro' => function() { return class_exists('Classic_Elementor_Addon'); },
			'cea-post-types' => function() { return class_exists('CEA_Post_Types'); },
			'cea-magazine' => function() { return class_exists('CEA_Magazine'); },
			'zozo-header-footer' => function() { return class_exists('ZOZO_Header_Footer'); },
			'revslider' => function() { return class_exists('RevSlider'); },
			'contact-form-7' => function() { return function_exists('wpcf7'); },
			
			'woocommerce' => function() { return class_exists('WooCommerce'); },
			'envato-market' => function() { return class_exists('Envato_Market'); },
		);
		$is_active = false;
		if ( isset( $plugin_checks[ $item['slug'] ] ) ) {
       	 	$is_active = $plugin_checks[ $item['slug'] ]();
    	}
		 
		if ( $is_active ) {
			$available_version = $item['source'] == 'repo' ? Hirxpert_Plugin_Info::hirxpert_does_plugin_require_update( $item['file_path'] ) : $item['version'];
			
			if ( version_compare( $available_version, $installed_plugins[$item['file_path']]['Version'], '>' ) ) {
				$actions = array(
					'update' => sprintf(
						'<a href="%1$s" class="hirxpert-btn btn-default" title="%3$s %2$s">%3$s</a>',
						wp_nonce_url(
							add_query_arg(
								array(
									'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'		=> urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-update' 	=> 'update-plugin',
									'version' 		=> urlencode( $item['version'] ),
									'return_url' 	=> 'hirxpert-plugins'
								),
								admin_url( TGM_Plugin_Activation::$instance->parent_slug )
							),
							'tgmpa-update',
							'tgmpa-nonce'
						),
						$item['sanitized_plugin'],
						esc_html__( 'Update', 'hirxpert' )
					),
				);
			}else{
				$actions = array(
					'deactivate' => sprintf(
						'<a href="%1$s" class="hirxpert-btn btn-default" title="%3$s %2$s">%3$s</a>',
						esc_url( add_query_arg(
							array(
								'plugin'					=> urlencode( $item['slug'] ),
								'plugin_name'		  		=> urlencode( $item['sanitized_plugin'] ),
								'plugin_source'				=> urlencode( $item['source'] ),
								'hirxpert-deactivate'	   		=> 'deactivate-plugin',
								'hirxpert-deactivate-nonce' 	=> wp_create_nonce( 'hirxpert-deactivate' ),
							),
							admin_url( 'admin.php?page=hirxpert-plugins' )
						) ),
						$item['sanitized_plugin'],
						esc_html__( 'Deactivate', 'hirxpert' )
					),
				);
			}
		}elseif ( ! isset( $installed_plugins[$item['file_path']] ) ) {
			$actions = array(
				'install' => sprintf(
					'<a href="%1$s" class="hirxpert-btn btn-default" title="%3$s %2$s">%3$s</a>',
					esc_url( wp_nonce_url(
						add_query_arg(
							array(
								'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'		=> urlencode( $item['slug'] ),
								'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
								'plugin_source' => urlencode( $item['source'] ),
								'tgmpa-install' => 'install-plugin',
								'return_url' 	=> 'hirxpert-plugins'
							),
							admin_url( TGM_Plugin_Activation::$instance->parent_slug )
						),
						'tgmpa-install',
						'tgmpa-nonce'
					) ),
					$item['sanitized_plugin'],
					esc_html__( 'Install', 'hirxpert' )
				),
			);
		}elseif ( is_plugin_inactive( $item['file_path'] ) ) {

			if ( version_compare( $item['version'], $installed_plugins[$item['file_path']]['Version'], '>' ) ) {
				$actions = array(
					'update' => sprintf(
						'<a href="%1$s" class="hirxpert-btn btn-default" title="%3$s %2$s">%3$s</a>',
						wp_nonce_url(
							add_query_arg(
								array(
									'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
									'plugin'		=> urlencode( $item['slug'] ),
									'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
									'plugin_source' => urlencode( $item['source'] ),
									'tgmpa-update' 	=> 'update-plugin',
									'version' 		=> urlencode( $item['version'] ),
									'return_url' 	=> 'hirxpert-plugins'
								),
								admin_url( TGM_Plugin_Activation::$instance->parent_slug )
							),
							'tgmpa-update',
							'tgmpa-nonce'
						),
						$item['sanitized_plugin'],
						esc_html__( 'Update', 'hirxpert' )
					),
				);
			} else {
				$actions = array(
					'activate' => sprintf(
						'<a href="%1$s" class="hirxpert-btn btn-default" title="%3$s %2$s">%3$s</a>',
						esc_url( add_query_arg(
							array(
								'plugin'			   	=> urlencode( $item['slug'] ),
								'plugin_name'		  	=> urlencode( $item['sanitized_plugin'] ),
								'plugin_source'			=> urlencode( $item['source'] ),
								'hirxpert-activate'	   		=> 'activate-plugin',
								'hirxpert-activate-nonce' 	=> wp_create_nonce( 'hirxpert-activate' ),
							),
							admin_url( 'admin.php?page=hirxpert-plugins' )
						) ),
						$item['sanitized_plugin'],
						esc_html__( 'Activate', 'hirxpert' )
					),
				);
			}
		}elseif ( version_compare( $item['version'], $installed_plugins[$item['file_path']]['Version'], '>' ) ) {
			$actions = array(
				'update' => sprintf(
					'<a href="%1$s" class="hirxpert-btn btn-default" title="%3$s %2$s">%3$s</a>',
					wp_nonce_url(
						add_query_arg(
							array(
								'page'		  	=> urlencode( TGM_Plugin_Activation::$instance->menu ),
								'plugin'		=> urlencode( $item['slug'] ),
								'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
								'plugin_source' => urlencode( $item['source'] ),
								'tgmpa-update' 	=> 'update-plugin',
								'version' 		=> urlencode( $item['version'] ),
								'return_url' 	=> 'hirxpert-plugins'
							),
							admin_url( TGM_Plugin_Activation::$instance->parent_slug )
						),
						'tgmpa-update',
						'tgmpa-nonce'
					),
					$item['sanitized_plugin'],
					esc_html__( 'Update', 'hirxpert' )
				),
			);
		}
		
		return $actions;
	}
	
	public static function get_parent_instance() {
		if ( is_null( self::$_parent_instance ) ) {
			self::$_parent_instance = new self();
		}
		return self::$_parent_instance;
	}
	
}

class Hirxpert_Plugins {
	
	private static $_instance = null;

	public function __construct() {
		Hirxpert_Plugin_Info::get_parent_instance();
		add_action( 'admin_menu', array( $this, 'hirxpert_admin_menu' ) );
	}
	
	public static function hirxpert_admin_menu(){
		add_submenu_page( 
			'hirxpert-welcome', 
			esc_html__( 'Theme Plugins', 'hirxpert' ),
			esc_html__( 'Theme Plugins', 'hirxpert' ), 
			'manage_options', 
			'hirxpert-plugins', 
			array( 'Hirxpert_Plugins', 'hirxpert_plugins_admin_page' )
		);		
	}
	
	public static function hirxpert_plugins_admin_page(){
		$hirxpert_theme = wp_get_theme(); ?>
		<div class="hirxpert-settings-wrap">	
			<div class="hirxpert-header-bar">
				<div class="hirxpert-header-left">
					<div class="hirxpert-admin-logo-inline">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand-logo.png' ); ?>" alt="hirxpert-logo">
					</div><!-- .hirxpert-admin-logo-inline -->
					<h2 class="title"><?php esc_html_e( 'Hirxpert Plugins', 'hirxpert' ); ?><span class="hirxpert-version"><?php echo esc_html( $hirxpert_theme->get( 'Version' ) ); ?></span></h2>
					<div class="nav-theme-options">
						<?php
						include_once ABSPATH . 'wp-admin/includes/plugin.php';
						$is_hirxpert_addon_active = class_exists( 'Hirxpert_Addon' );
						$current_theme = wp_get_theme();
						$is_theme_active = ($current_theme->get('Name') === 'Hirxpert');
						$verfied_stat = get_option('verified_purchase_status');

						if ($is_hirxpert_addon_active) {
							echo '<a href="' . admin_url('admin.php?page=hirxpert-options') . '"><span class="dashicons dashicons-admin-tools"></span>Theme Options</a>';
						} else {
							echo '<a href="#" class="theme-options not-clickable" data-popup-message="Please install and activate the Hirxpert Addon plugin."><span class="dashicons dashicons-admin-tools"></span>Theme Options</a>';
						}
						if ($verfied_stat) {
							echo '<a href="' . admin_url('admin.php?page=hirxpert-plugins') . '" class="active-page"><span class="dashicons dashicons-admin-plugins"></span>Plugins</a>';
						} else {
							echo '<a href="#" class="not-clickable" data-popup-message="Please activate the Hirxpert theme."><span class="dashicons dashicons-admin-plugins"></span>Plugins</a>';
						}
						?>
						<div class="support-dropdown">
							<a href="#" class="dropdown-toggle"><span class="dashicons dashicons-buddicons-buddypress-logo"></span>Support</a>
							<div class="dropdown-content">
								<a href="<?php echo esc_url('https://zozothemes.com/knowledge-base/');?>" target="_blank"><span class="dashicons dashicons-tickets-alt"></span>Ticket</a>
								<a href="<?php echo esc_url('https://zozothemes.com/knowledge-base/');?>" target="_blank"><span class="dashicons dashicons-video-alt3"></span>Video</a>
								<a href="<?php echo esc_url('https://docs.zozothemes.com/hirxpert/');?>" target="_blank"><span class="dashicons dashicons-text-page"></span>Documentation</a>
								<a href="<?php echo esc_url('https://zozothemes.com/knowledge-base/');?>" target="_blank"><span class="dashicons dashicons-book-alt"></span>Knowledge Base</a>
							</div>
						</div>
						<a href="<?php echo esc_url('https://zozothemes.com/forum/')?>" target="_blank"><span class="dashicons dashicons-format-chat"></span>Forum</a>
					</div>
				</div><!-- .hirxpert-header-left -->
				<div class="hirxpert-header-right">
					<a href="<?php echo class_exists( 'Hirxpert_Addon' ) ? esc_url( admin_url( 'admin.php?page=hirxpert-importer' ) ) : '#'; ?>" class="button hirxpert-btn"><?php esc_html_e( 'Import Demo', 'hirxpert' ); ?></a>
				</div><!-- .hirxpert-header-right -->
			</div><!-- .hirxpert-header-bar -->
			
			<div class="hirxpert-inner-wrap">
			<?php 
				require_once HIRXPERT_DIR . '/admin/theme-plugins/tgm-init.php';			
				$plugins = TGM_Plugin_Activation::$instance->plugins;
				$plugin_custom_order = array(
					'elementor' 		=> $plugins['elementor'],
					'hirxpert-addon' 	=> $plugins['hirxpert-addon'],
					'classic-elementor-addons-pro' => $plugins['classic-elementor-addons-pro'],
					'cea-post-types' => $plugins['cea-post-types'],
					'cea-magazine' => $plugins['cea-magazine'],
					'zozo-header-footer' => $plugins['zozo-header-footer'],					
					'revslider'			=> $plugins['revslider'],
					'contact-form-7' 	=> $plugins['contact-form-7'],
					'woocommerce' 	=> $plugins['woocommerce'],
					'envato-market' 	=> $plugins['envato-market']
				);
			
				$installed_plugins = Hirxpert_Plugin_Info::hirxpert_get_plugins();
				
				if( isset( $_GET['hirxpert-deactivate'] ) && $_GET['hirxpert-deactivate'] == 'deactivate-plugin' ) {
					check_admin_referer( 'hirxpert-deactivate', 'hirxpert-deactivate-nonce' );
					$plugins = TGM_Plugin_Activation::$instance->plugins;
					foreach( $plugins as $plugin ) {
						if( $plugin['slug'] == $_GET['plugin'] ) {
							deactivate_plugins( $plugin['file_path'] );
						}
					}
				}
				if( isset( $_GET['hirxpert-activate'] ) && $_GET['hirxpert-activate'] == 'activate-plugin' ) {
					check_admin_referer( 'hirxpert-activate', 'hirxpert-activate-nonce' );
					$plugins = TGM_Plugin_Activation::$instance->plugins;
					foreach( $plugins as $plugin ) {
						if( $plugin['slug'] == $_GET['plugin'] ) {
							activate_plugin( $plugin['file_path'] );
						}
					}
				}
				$plugins = $plugin_custom_order;
			?>
			
				<div class="hirxpert-settings-tabs">
					<div id="hirxpert-general" class="hirxpert-settings-tab hirxpert-elements-list active">
						<div class="container">
							<form id="multi-plugins-active-form" method="post" action="<?php echo esc_url( admin_url( 'admin.php?page=hirxpert-plugins' ) ); ?>" enctype="multipart/form-data">
								<input type="hidden" name="action" value="hirxpert_tgm_install" />
								<?php wp_nonce_field( 'hirxpert-bulk-plugin-install', 'hirxpert_bulk_nonce' ); ?>
								<p class="hirxpert-settings-msg">
									<span class="multi-select-wrap">
										<input type="checkbox" class="bulk-select-all" /> <?php echo esc_html__('Bulk Select', 'hirxpert'); ?>
									</span>
									<select class="bulk-plugins-action-trigger btn btn-default" name="hirxpert_bulk_action">
										<option value="install"><?php echo esc_html__('Install', 'hirxpert'); ?></option>
										<option value="active"><?php echo esc_html__('Activate', 'hirxpert'); ?></option>
										<option value="deactive"><?php echo esc_html__('Deactivate', 'hirxpert'); ?></option>
									</select>
									<a href="#" class="button hirxpert-bulk-action"><?php echo esc_html__('Apply', 'hirxpert'); ?></a>
									<img src="<?php echo esc_url( HIRXPERT_URI . '/admin/assets/images/loader.gif' ); ?>" alt="<?php echo esc_attr_e('Loader', 'hirxpert'); ?>" class="bulk-process-loader" />
								</p>
								<?php echo wp_nonce_field( 'hirxpert_activate_nonce', 'hirxpert-multi-plugin*^*' ); ?>
							</form>
							<div class="row multi-cols">
							<?php
								$active_action = '';
								if( isset( $_GET['plugin_status'] ) ) {
									$active_action = $_GET['plugin_status'];
								}
								$req_plugs = array();
					
								foreach( $plugins as $plugin ):
									$class = '';
									$plugin_status = '';
									$active_action_class = '';
									$file_path = $plugin['file_path'];
									$plugin_action = Hirxpert_Plugin_Info::hirxpert_plugin_link( $plugin );
									foreach( $plugin_action as $action => $value ) {
										if( $active_action == $action ) {
											$active_action_class = ' plugin-' .$active_action. '';
										}
									}

									$plugin_checks = array(
										'elementor' => function() { return class_exists('Elementor\Plugin'); },
										'hirxpert-addon' => function() { return class_exists('Hirxpert_Addon'); },
										'classic-elementor-addons-pro' => function() { return class_exists('Classic_Elementor_Addon'); },
										'cea-post-types' => function() { return class_exists('CEA_Post_Types'); },
										'cea-magazine' => function() { return class_exists('CEA_Magazine'); },
										'zozo-header-footer' => function() { return class_exists('ZOZO_Header_Footer'); },
										'revslider' => function() { return class_exists('RevSlider'); },
										'contact-form-7' => function() { return function_exists('wpcf7'); },
										
										'woocommerce' => function() { return class_exists('WooCommerce'); },
										'envato-market' => function() { return class_exists('Envato_Market'); },
									);
									$is_active = false;
									if ( isset( $plugin_checks[ $plugin['slug'] ] ) ) {
											$is_active = $plugin_checks[ $plugin['slug'] ]();
									}
									if( $is_active ) {
										$plugin_status = 'active';
										$class = ' active';
										$req_plugs[] = esc_html( $plugin['slug'] );
									}
									
									$class .= $active_action_class;
							?>
								<div class="col-4<?php echo esc_attr( $class ); ?>">
									<div class="media admin-box hirxpert-plugins-box">
										<div class="admin-box-icon p-0 mr-3">
											<span class="plugin-image-wrap"><img src="<?php echo esc_url( $plugin['image_url'] ); ?>" alt="<?php echo esc_attr( $plugin['name'] ); ?>" /></span>
										</div>
										<div class="media-body admin-box-info">
											<h3 class="admin-box-title"><?php echo esc_html( $plugin['name'] ); ?></h3>
											<div class="admin-box-content">
												<?php if( $plugin['required'] ): ?>
												<div class="plugin-required"><span class="dashicons dashicons-star-filled" title="<?php echo esc_attr__('Required', 'hirxpert'); ?>"></span></div>
												<?php endif; ?>
												<?php if( isset( $installed_plugins[$plugin['file_path']] ) ): ?> 
												<div class="plugin-info"><?php 
													$current_version = $installed_plugins[$plugin['file_path']]['Version'];
													$available_version = $current_version;
													if( $plugin['source'] == 'repo' ){
														$available_version = Hirxpert_Plugin_Info::hirxpert_does_plugin_require_update( $plugin['file_path'] );
													}
												?>
													<?php echo sprintf( 'v%s | %s', $installed_plugins[$plugin['file_path']]['Version'], $installed_plugins[$plugin['file_path']]['Author'] ); ?>
												</div>
												<?php endif; ?>
												<div class="theme-actions--">
													<?php foreach( $plugin_action as $action ) { echo ( ''. $action ); } ?>
												</div>
												<?php $available_version = '';
												      $current_version = '';
													if( $plugin['source'] == 'repo' && version_compare( $available_version, $current_version, '>' ) ): ?>
													<div class="theme-update"><?php echo esc_html__('Update Available: Version', 'hirxpert'); ?> <?php echo esc_attr( $available_version ); ?></div>
												<?php
												elseif( isset( $plugin_action['update'] ) && $plugin_action['update'] ): ?>
													<div class="theme-update"><?php echo esc_html__('Update Available: Version', 'hirxpert'); ?> <?php echo esc_attr( $plugin['version'] ); ?></div>
												<?php endif; ?>
												<span class="multi-active-wrap"><input type="checkbox" class="bulk-activator" value="<?php echo esc_attr( $plugin['slug'] ); ?>" /></span>
											</div>
										</div>
									</div>
								</div><!-- .col -->
							<?php endforeach; ?>
							</div><!-- .row -->
						</div><!-- .container -->
					</div><!-- .hirxpert-settings-tab -->
				</div><!-- .hirxpert-settings-tabs -->
			
			</div><!-- .hirxpert-inner-wrap -->
		</div><!-- .hirxpert-settings-wrap -->
	<?php
	}
	
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

} Hirxpert_Plugins::get_instance();

//Plugin ajax functions
add_action( 'wp_ajax_hirxpert_tgm_install', array( 'Hirxpert_Plugin_Info', 'hirxpert_tgm_install' ) );
add_action( 'wp_ajax_nopriv_hirxpert_tgm_install', array( 'Hirxpert_Plugin_Info', 'hirxpert_tgm_install' )  );