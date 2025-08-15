<?php 

class Hirxpert_Admin_Class {
	
	private static $_instance = null;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'hirxpert_admin_menu' ) );		
		add_action( 'admin_menu', array( $this, 'change_admin_menu_name' ), 99 );
		add_action( 'admin_enqueue_scripts', array( $this, 'hirxpert_framework_admin_scripts' ), 10 );
		
		//Call plugin page
		$this->hirxpert_plugin_menu_connect();
	}
	
	public static function hirxpert_framework_admin_scripts(){
		if( isset( $_GET['page'] ) && ( $_GET['page'] == 'hirxpert-welcome' || $_GET['page'] == 'hirxpert-options' || $_GET['page'] == 'hirxpert-sidebars' || $_GET['page'] == 'hirxpert-fonts' || $_GET['page'] == 'hirxpert-plugins' || $_GET['page'] == 'hirxpert-importer' || $_GET['page'] == 'hirxpert-verification' ) ){
			wp_enqueue_style( 'hirxpert-admin', get_template_directory_uri() . '/admin/assets/css/hirxpert-admin-page.css', array(), '1.0', 'all' );
		}
		if( isset( $_GET['page'] ) && $_GET['page'] == 'hirxpert-welcome' ) {
			wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl-carousel.min.css', array(), '2.3.4', 'all' );
			wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
		}
		wp_enqueue_style( 'hirxpert-admin-common', get_template_directory_uri() . '/admin/assets/css/hirxpert-admin-common.css', array(), '1.0', 'all' );	
		wp_enqueue_script( 'hirxpert-admin-js', esc_url( get_template_directory_uri() . '/admin/assets/js/hirxpert-admin-script.js' ), array( 'jquery' ), '1.0' );
		wp_enqueue_style( 'bootstrap-icons', HIRXPERT_URI . '/assets/css/bootstrap-icons.css', array(), '1.9.1', 'all' );
		if( isset( $_GET['page'] ) && $_GET['page'] == 'hirxpert-plugins' ){
			require_once HIRXPERT_DIR . '/admin/theme-plugins/tgm-init.php';			
			$plugins = TGM_Plugin_Activation::$instance->plugins;
			$args = array( 'tgm_plugins' => $plugins );
			$admin_local_args = apply_filters( 'hirxpert_admin_local_js_args', $args );
			wp_localize_script('hirxpert-admin-js', 'hirxpert_admin_ajax_var', $admin_local_args );
		}
		
		if( isset( $_GET['page'] ) && $_GET['page'] == 'hirxpert-verification' ){
			$html = '<p><strong>This purchase code already registered with another domain</strong></p><p>Please go to your previous working environment and deactivate the purchase code to use it again ( WP dashboard -> Hirxpert -> Token Verification -> click on the button "Deactivate" ).</p>';
			$args = array( 'already_used' => $html );
			$admin_local_args = apply_filters( 'hirxpert_admin_local_js_args', $args );
			wp_localize_script('hirxpert-admin-js', 'hirxpert_admin_ajax_var', $admin_local_args );
		}
	}
	
	public static function hirxpert_admin_menu(){
		add_menu_page( 
			esc_html__( 'Hirxpert', 'hirxpert' ),
			esc_html__( 'Hirxpert', 'hirxpert' ),
			'manage_options',
			'hirxpert-welcome', 
			array( 'Hirxpert_Admin_Class', 'hirxpert_admin_page' ),
			get_template_directory_uri() . '/assets/images/brand-icon.png',
			6
		);
		add_submenu_page( 
			'hirxpert-welcome', 
			esc_html__( 'Token Verification', 'hirxpert' ),
			esc_html__( 'Token Verification', 'hirxpert' ), 
			'manage_options', 
			'hirxpert-verification', 
			array( 'Hirxpert_Admin_Class', 'hirxpert_verification_admin_page' )
		);
	}
	
	public static function change_admin_menu_name(){
		global $submenu;
		if(isset($submenu['hirxpert-welcome'])){
			$submenu['hirxpert-welcome'][0][0] = esc_html__( 'Welcome', 'hirxpert' );
		}
	}
	
	public static function hirxpert_admin_page(){
	
		$hirxpert_theme = wp_get_theme();
		
		?>
		<div class="hirxpert-settings-wrap">
			<div class="hirxpert-header-bar">
				<div class="hirxpert-header-left">
					<div class="hirxpert-admin-logo-inline">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand-logo.png' ); ?>" alt="hirxpert-logo">
					</div><!-- .hirxpert-admin-logo-inline -->
					<h2 class="title"><?php esc_html_e( 'Hirxpert', 'hirxpert' ); ?><span class="hirxpert-version"><?php echo esc_html( $hirxpert_theme->get( 'Version' ) ); ?></span></h2>
					<div class="nav-theme-options">
						<?php
						include_once ABSPATH . 'wp-admin/includes/plugin.php';
						$is_hirxpert_addon_active = class_exists('Hirxpert_Addon');
						$current_theme = wp_get_theme();
						$is_theme_active = ($current_theme->get('Name') === 'Hirxpert');
						$verfied_stat = get_option('verified_purchase_status');

						if ($is_hirxpert_addon_active) {
							echo '<a href="' . admin_url('admin.php?page=hirxpert-options') . '"><span class="dashicons dashicons-admin-tools"></span>Theme Options</a>';
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
								<a href="<?php echo esc_url('https://zozothemes.com/knowledge-base/');?>" target="_blank"><span class="dashicons dashicons-tickets-alt"></span>Ticket</a>
								<a href="<?php echo esc_url('https://zozothemes.com/knowledge-base/');?>" target="_blank"><span class="dashicons dashicons-video-alt3"></span>Video</a>
								<a href="<?php echo esc_url('https://docs.zozothemes.com/hirxpert/');?>" target="_blank"><span class="dashicons dashicons-text-page"></span>Documentation</a>
								<a href="<?php echo esc_url('https://zozothemes.com/knowledge-base/');?>" target="_blank"><span class="dashicons dashicons-book-alt"></span>Knowledge Base</a>
							</div>
						</div>
						<a href="<?php echo esc_url('https://zozothemes.com/forum/');?>" target="_blank"><span class="dashicons dashicons-format-chat"></span>Forum</a>
					</div>
				</div><!-- .hirxpert-header-left -->
				<div class="hirxpert-header-right">
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=hirxpert-verification' ) ) ?>" class="button hirxpert-btn"><?php esc_html_e( 'Verify Token', 'hirxpert' ); ?></a>
				</div><!-- .hirxpert-header-right -->
			</div><!-- .hirxpert-header-bar -->
			
			<div class="hirxpert-settings-tabs">
				<div id="hirxpert-general" class="hirxpert-settings-tab hirxpert-elements-list active">
					<div class="container">
						<div class="row">
							<div class="col-8">
								<div class="row">
									<div class="col-6 mb-4">
										<div class="banner-img-wrap">
											<img class="hirxpert-preview-img img-fluid" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/banner.png' ); ?>" alt="essential-addons-for-elementor-featured">
										</div>
									</div><!-- .col -->
									<div class="col-6 mb-4">
										<div class="media admin-box">
											<div class="admin-box-icon mr-3">
												<span class="dashicons dashicons-admin-generic"></span>								
											</div>
											<div class="media-body admin-box-info">
												<h3 class="admin-box-title"><?php esc_html_e( 'Requirements', 'hirxpert' ); ?></h3>
												<div class="admin-box-content">
												<?php
													$php_version = phpversion();
													$php_version_class = version_compare( $php_version, '8.2.0', '>=') ? ' success' : ' warning';
													$wp_version = get_bloginfo('version');
													$wp_version_class = version_compare( $wp_version, '6.7.2', '>=') ? ' success' : ' warning';
													
													ob_start();
													phpinfo(INFO_MODULES);
													$info = ob_get_contents();
													ob_end_clean();
													$info = stristr($info, 'Client API version');
													preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match);
													$mysql_version = $match[0]; 
													$mysql_version_class = version_compare( $mysql_version, '8.0', '>=') ? ' success' : ' warning';
													
													$post_max_size = ini_get('post_max_size');
													$post_max = str_replace("M","",$post_max_size);
													$post_max_class = $post_max >= 10 ? ' success' : ' warning';
													
													$max_execution_time = ini_get('max_execution_time');
													$max_exe_class = $max_execution_time >= 300 ? ' success' : ' warning';
													
													$max_input_vars = ini_get('max_input_vars');
													$max_input_class = $max_input_vars >= 2000 ? ' success' : ' warning';
													
												?>
													<table class="hirxpert-admin-table no-spacing-table">
														<thead>
															<tr>
																<td><?php esc_html_e( 'Core', 'hirxpert' ); ?></td>
																<td><?php esc_html_e( 'Required', 'hirxpert' ); ?></td>
																<td><?php esc_html_e( 'Current', 'hirxpert' ); ?></td>
																<td><?php esc_html_e( 'Status', 'hirxpert' ); ?></td>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><?php esc_html_e( 'PHP', 'hirxpert' ); ?></td>
																<td>8.2.0</td>
																<td><?php echo esc_html( $php_version ); ?></td>
																<td class="text-center"><span class="requirement-icon <?php echo esc_attr( $php_version_class ); ?>"></span></td>
															</tr>
															<tr>
																<td><?php esc_html_e( 'MySQL', 'hirxpert' ); ?></td>
																<td>8.0</td>
																<td><?php echo esc_html( $mysql_version ); ?></td>
																<td class="text-center"><span class="requirement-icon <?php echo esc_attr( $mysql_version_class ); ?>"></span></td>
															</tr>
															<tr>
																<td><?php esc_html_e( 'WordPress', 'hirxpert' ); ?></td>
																<td>6.7.2</td>
																<td><?php echo esc_html( $wp_version ); ?></td>
																<td class="text-center"><span class="requirement-icon <?php echo esc_attr( $wp_version_class ); ?>"></span></td>
															</tr>															
															<tr>
																<td><?php esc_html_e( 'post_max_size', 'hirxpert' ); ?></td>
																<td>10M</td>
																<td><?php echo esc_html( $post_max_size ); ?></td>
																<td class="text-center"><span class="requirement-icon <?php echo esc_attr( $post_max_class ); ?>"></span></td>
															</tr>
															<tr>
																<td><?php esc_html_e( 'max_input_vars', 'hirxpert' ); ?></td>
																<td>2000</td>
																<td><?php echo esc_html( $max_input_vars ); ?></td>
																<td class="text-center"><span class="requirement-icon <?php echo esc_attr( $max_input_class ); ?>"></span></td>
															</tr>
															<tr>
																<td><?php esc_html_e( 'max_execution_time', 'hirxpert' ); ?></td>
																<td>300</td>
																<td><?php echo esc_html( $max_execution_time ); ?></td>
																<td class="text-center"><span class="requirement-icon <?php echo esc_attr( $max_exe_class ); ?>"></span></td>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div><!-- .col -->
									<div class="col-6 mb-4">
										<div class="media admin-box">
											<div class="admin-box-icon mr-3">
												<span class="dashicons dashicons-media-document"></span>								
											</div>
											<div class="media-body admin-box-info">
												<h3 class="admin-box-title"><?php esc_html_e( 'Documention', 'hirxpert' ); ?></h3>
												<div class="admin-box-content">
													<?php esc_html_e( 'Get started by spending some time with the documentation to get familiar with Hirxpert. Build awesome websites for you or your clients with ease.', 'hirxpert' ); ?>
												</div>
												<a href="<?php echo esc_url( __( 'https://docs.zozothemes.com/hirxpert/', 'hirxpert' ) );?> " class="hirxpert-btn btn-default" target="__blank"><?php esc_html_e( 'Go Here', 'hirxpert' ); ?></a>
											</div>
										</div>
									</div><!-- .col -->
									<div class="col-6">
										<div class="media admin-box">
											<div class="admin-box-icon mr-3">
												<span class="dashicons dashicons-admin-users"></span>								
											</div>
											<div class="media-body admin-box-info">
												<h3 class="admin-box-title"><?php esc_html_e( 'Need Help?', 'hirxpert' ); ?></h3>
												<div class="admin-box-content">
													<?php esc_html_e( 'Stuck with something? Get help from the community on WordPress.org Forum initiate a live chat at Hirxperts website and get support.', 'hirxpert' ); ?>
												</div>
												<a href="<?php echo esc_url( __( 'https://zozothemes.com/knowledge-base/', 'hirxpert' ) );?>" class="hirxpert-btn btn-default" target="__blank"><?php esc_html_e( 'Get Support', 'hirxpert' ); ?></a>
											</div>
										</div>
									</div><!-- .col -->
									<div class="col-6 mb-4">
									    <div class="media admin-box">
									        <div class="admin-box-icon mr-3">
									            <span class="dashicons dashicons-video-alt3"></span>
									        </div>
									        <div class="media-body admin-box-info">
									            <h3 class="admin-box-title"><?php esc_html_e('Video Tutorials?', 'hirxpert'); ?></h3>
									            <div class="admin-box-content">
									                <?php esc_html_e('Get started by spending some time with the Video tutorials to get familiar with Hirxpert. Here is a full video tutorial to how to setup a theme.', 'hirxpert'); ?>
									            </div>
									            <a href="<?php echo esc_url( __('https://zozothemes.com/knowledge-base/', 'hirxpert' ));?>" class="hirxpert-btn btn-default" target="__blank"><?php esc_html_e('Click Here', 'hirxpert'); ?></a>
									        </div>
									    </div>
									</div>

									<div class="col-12">								
										<div class="admin-box-slide-wrap text-center">	
											<?php										
												//Banner
											?>
										</div>
									</div><!-- .col -->
								</div><!-- .row -->
							</div><!-- .col -->
							<div class="col-4">
							<?php
								if( !class_exists( 'Zozothemes_API' ) ){
									require_once HIRXPERT_DIR . '/admin/class.zozo-api.php';
								}
								$zozo_api = new Zozothemes_API;
								$response = $zozo_api->get_response();
							?>
								<div class="admin-box">
									<div class="admin-box-info">
										<h3 class="admin-box-title"><?php esc_html_e( 'Live Updates', 'hirxpert' ); ?></h3>
										<div class="admin-box-pro text-center">
											
										</div>									
											<div class="full-logo-wrap"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand.png' ); ?>" alt="hirxpert-logo"></div>
										
										<h3 class="admin-box-title my-4"><?php esc_html_e( 'Featured Themes', 'hirxpert' ); ?></h3>
										<div class="admin-box-slide-wrap">
										<?php	
										if( !is_wp_error( $response ) ){										
											if( !empty( $response ) && isset( $response['products'] ) ) {
												echo '<div class="owl-carousel">';
												foreach( $response['products'] as $key => $product ){
													echo '<a href="'. esc_url( $product['link'] ) .'" target="_blank"><img src="'. esc_url( $product['img'] ) .'" alt="'. esc_url( $product['alt'] ) .'"></a>';
												}
												echo '</div>';
											}
										}else{ ?>
											<p><?php esc_html_e( 'Featured products will show here..', 'hirxpert' ); ?></p>
										<?php
										}
										?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- .row -->
					</div><!-- .container -->
				</div><!-- .hirxpert-settings-tab -->
			</div><!-- .hirxpert-settings-tabs -->
			
		</div><!-- .hirxpert-settings-wrap -->
		<?php
	}

	public static function hirxpert_verification_admin_page(){		
	
		$hirxpert_theme = wp_get_theme();		
	?>
		<div class="hirxpert-settings-wrap">
		
			<div class="hirxpert-header-bar">
				<div class="hirxpert-header-left">
					<div class="hirxpert-admin-logo-inline">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand-logo.png' ); ?>" alt="hirxpert-logo">
					</div><!-- .hirxpert-admin-logo-inline -->
					<h2 class="title"><?php esc_html_e( 'Purchase Code Verification', 'hirxpert' ); ?><span class="hirxpert-version"><?php echo esc_html( $hirxpert_theme->get( 'Version' ) ); ?></span></h2>
					<div class="nav-theme-options">
						<?php
						include_once ABSPATH . 'wp-admin/includes/plugin.php';
						$is_hirxpert_addon_active = class_exists('Hirxpert_Addon');
						$current_theme = wp_get_theme();
						$is_theme_active = ($current_theme->get('Name') === 'Hirxpert');
						$verfied_stat = get_option('verified_purchase_status');
						
						if ($is_hirxpert_addon_active) {
							echo '<a href="' . admin_url('admin.php?page=hirxpert-options') . '"><span class="dashicons dashicons-admin-tools"></span>Theme Options</a>';
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
								<a href="<?php echo esc_url( 'https://zozothemes.com/knowledge-base/' ); ?>" target="_blank"><span class="dashicons dashicons-tickets-alt"></span>Ticket</a>
								<a href="<?php echo esc_url( 'https://zozothemes.com/knowledge-base/'); ?>" target="_blank"><span class="dashicons dashicons-video-alt3"></span>Video</a>
								<a href="<?php echo esc_url( 'https://docs.zozothemes.com/hirxpert/'); ?>" target="_blank"><span class="dashicons dashicons-text-page"></span>Documentation</a>
								<a href="<?php echo esc_url( 'https://zozothemes.com/knowledge-base/'); ?>" target="_blank"><span class="dashicons dashicons-book-alt"></span>Knowledge Base</a>
							</div>
						</div>
						<a href="<?php echo esc_url( 'https://zozothemes.com/forum/'); ?>" target="_blank"><span class="dashicons dashicons-format-chat"></span>Forum</a>
					</div>
				</div><!-- .hirxpert-header-left -->
				<div class="hirxpert-header-right">
					<a href="<?php echo esc_url( 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-' ); ?>" target="_blank" class="button hirxpert-btn"><?php esc_html_e( 'Get Purchase Code', 'hirxpert' ); ?></a>
				</div><!-- .hirxpert-header-right -->
			</div><!-- .hirxpert-header-bar -->
			
			<div class="hirxpert-inner-wrap">
				<div class="hirxpert-settings-tabs">
					<div id="hirxpert-general" class="hirxpert-settings-tab hirxpert-elements-list active">
						<div class="container">
							<?php 
								$verfied_stat = get_option('verified_purchase_status');
							?>
							<div class="zozo-envato-registration-form-wrap">
								<?php if( !$verfied_stat ): ?>
								<h2 class="text-center"><?php esc_html_e( "Activate your Licence", "hirxpert" ); ?></h2>
								<p class="text-center"><?php esc_html_e( "Welcome and thank you for Choosing Hirxpert Theme!
								The Hirxpert theme needs to be activated to enable demo import installation and customer support service.", "hirxpert" ); ?></p>	
								<a href="<?php echo esc_url( 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-' ); ?>" target="_blank"><?php esc_html_e( "How to find purchase code?", "hirxpert" ); ?></a>
								<form id="zozo-envato-registration-form" class="zozo-envato-registration-form" method="post">
									<?php wp_nonce_field( 'hirxpert_theme_verify^%&^%', 'zozo_verify_nonce' ); ?>
									<div class="form-fields">
										<div class="zozo-input-group">
											<input type="text" name="zozo_registration_email" value="" placeholder="<?php esc_attr_e( 'Enter E-mail address', 'hirxpert' ); ?>">
											<input type="text" name="zozo_purchase_code" value="" placeholder="<?php esc_attr_e( 'Enter your theme purchase code', 'hirxpert' ); ?>">
										</div>
										<div class="submit-group">
											<input type="submit" name="submit" id="submit" class="button hirxpert-btn" value="<?php esc_attr_e( 'Activate', 'hirxpert' ); ?>" />
											<span class="process-loader"><img src="<?php echo esc_url( HIRXPERT_URI . '/admin/assets/images/loader.gif' ); ?>" alt="<?php esc_attr_e( 'Loader', 'hirxpert' ) ?>" /></span>
										</div>
									</div>
									<div class="verfication-alert text-center"><span class="verfication-txt"></span></div>
								</form>
								<?php else: ?>
								<div class="theme-activated-wrap text-center">
									<h2><?php esc_html_e( 'Thank you!', 'hirxpert' ) ?></h2>
									<p><strong><?php esc_html_e( 'Your theme\'s license is activated successfully.', 'hirxpert' ) ?></strong></p>
								</div>
								<form id="zozo-envato-deactivation-form" class="zozo-envato-deactivation-form text-center" method="post">
									<?php wp_nonce_field( 'hirxpert_theme_deactivate^%&^%', 'zozo_deactivate_nonce' ); ?>
									<div class="submit-group">
										<input type="submit" name="submit" class="button hirxpert-btn" value="<?php esc_attr_e( 'Deactivate', 'hirxpert' ); ?>" />
										<span class="process-loader"><img src="<?php echo esc_url( HIRXPERT_URI . '/admin/assets/images/loader.gif' ); ?>" alt="<?php esc_attr_e( 'Loader', 'hirxpert' ) ?>" /></span>
									</div>
								</form>
								<?php endif; ?>
								
								<div class="registration-token-instruction">
									<p class="text-center"><strong><?php esc_html_e( '1 license = 1 domain = 1 website', 'hirxpert' ); ?></strong></p>
									<p class="text-center"><?php printf( '%1$s <a href="%2$s" target="_blank">%3$s</a>',
										esc_html__( 'You can always buy more licences for this product:', 'hirxpert' ),
										esc_url( 'https://themeforest.net/user/zozothemes/portfolio' ),
										esc_html__( 'ThemeForest ZOZOTHEMES', 'hirxpert' )
										); ?>
									</p>
									<h5> Please <a href="<?php echo admin_url('admin.php?page=hirxpert-plugins'); ?>" style="font-size:14px;">Activate Required Plugins</a>, before demo import.</h5>
									<p class="text-left notice-wrap"><span class="info-notice"><?php esc_html_e( 'Notice', 'hirxpert' ); ?></span><?php esc_html_e( 'If you are developing a website in the staging site means, While moving to the production site, please deactivate the license in staging and activate it in the Production site.', 'hirxpert' ); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function hirxpert_plugin_menu_connect(){
		require_once HIRXPERT_DIR . '/admin/class.token-verification.php';
		$verfied_stat = Zozo_Purchase_Code_Verification::check_theme_activated();
		if( !empty( $verfied_stat ) && !is_array( $verfied_stat ) ) {
			require_once HIRXPERT_DIR . '/admin/class.plugin-settings.php';	
		}
	}
	
	public static function hirxpert_theme_verification(){
		
		$nonce = isset( $_POST['zozo_verify_nonce'] ) ? sanitize_text_field( $_POST['zozo_verify_nonce'] ) : '';	  
		if ( ! wp_verify_nonce( $nonce, 'hirxpert_theme_verify^%&^%' ) )
			wp_die ( esc_html__( 'Busted', 'hirxpert' ) );
		
		if( isset( $_POST['zozo_registration_email'] ) && !empty( $_POST['zozo_purchase_code'] ) ){
			require_once HIRXPERT_DIR . '/admin/class.token-verification.php';
			$verfy_obj = new Zozo_Purchase_Code_Verification;
			$status = $verfy_obj->verify_token();
			wp_send_json($status);
		}
		
		wp_die('finished');
	}
	
	public static function hirxpert_theme_deactivate(){
			
		$nonce = isset( $_POST['zozo_deactivate_nonce'] ) ? sanitize_text_field( $_POST['zozo_deactivate_nonce'] ) : '';	  
		if ( ! wp_verify_nonce( $nonce, 'hirxpert_theme_deactivate^%&^%' ) )
			wp_die ( esc_html__( 'Busted', 'hirxpert' ) );
				
		require_once HIRXPERT_DIR . '/admin/class.token-verification.php';
		$verfy_obj = new Zozo_Purchase_Code_Verification;
		$status = $verfy_obj->deactivate_api_call();
		wp_send_json($status);
		
		wp_die('finished');
	}
	
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

} Hirxpert_Admin_Class::get_instance();

//Theme verification ajax functions
add_action( 'wp_ajax_hirxpert_theme_verify', array( 'Hirxpert_Admin_Class', 'hirxpert_theme_verification' ) );
add_action( 'wp_ajax_nopriv_hirxpert_theme_verify', array( 'Hirxpert_Admin_Class', 'hirxpert_theme_verification' )  );

//Theme deactivate
add_action( 'wp_ajax_hirxpert_theme_deactivate', array( 'Hirxpert_Admin_Class', 'hirxpert_theme_deactivate' ) );
add_action( 'wp_ajax_nopriv_hirxpert_theme_deactivate', array( 'Hirxpert_Admin_Class', 'hirxpert_theme_deactivate' )  );