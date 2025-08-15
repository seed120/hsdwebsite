<?php 
add_action('admin_menu', 'cea_admin_menu');
function cea_admin_menu() {
        add_menu_page(
            esc_html__('Classic Addons', 'classic-elementor-addons-pro'),
            esc_html__('Classic Addons', 'classic-elementor-addons-pro'),
            'manage_options',
            'classic-addons',
            'classic_elementor_addon_admin_page',
            CEA_CORE_URL . '/assets/images/logo.png',
            6
        );
        add_submenu_page(
            'classic-addons',
            esc_html__('Plugin Options', 'classic-elementor-addons-pro'),
            esc_html__('Plugin Options', 'classic-elementor-addons-pro'),
            'manage_options',
            'classic-addons-widgets',
            'classic_elementor_options_admin_page'
        );
    }

function cea_change_admin_menu_name(){
    global $submenu;
    if(isset($submenu['classic-addons'])){
        $submenu['classic-addons'][0][0] = esc_html__( 'Addon Settings', 'classic-elementor-addons-pro' );
    }
}
add_action('admin_menu', 'cea_change_admin_menu_name');

function classic_elementor_addon_admin_page(){
	
	require_once ( CEA_CORE_DIR . 'admin/class.zozo-api.php' );
	$cea_api = new Zozothemes_API;
	$response = $cea_api->get_response();
	if( is_wp_error( $response ) ) $response = '';
	
	$plugin_data = get_plugin_data( CEA_CORE_DIR . 'index.php' );
	$version = isset( $plugin_data['Version'] ) ? $plugin_data['Version'] : '0';
	
	?>
	<form method="post" action="#" enctype="multipart/form-data" id="cea-plugin-form-wrapper">
	<div class="cea-settings-wrap">
		<div class="cea-header-bar">
			<div class="cea-header-left">
				<div class="cea-admin-logo-inline">
					<img src="<?php echo esc_url( CEA_CORE_URL . 'assets/images/logo.png' ); ?>" alt="cea-logo">
				</div><!-- .cea-admin-logo-inline -->
				<h2 class="title"><?php esc_html_e( 'Classic Elementor Addon', 'classic-elementor-addons-pro' ); ?><span class="cea-version"><?php echo esc_attr( $version ); ?></span></h2>
			</div><!-- .cea-header-left -->
			<div class="cea-header-right">
				<button type="submit" class="button cea-plugin-submit cea-btn"><?php esc_html_e( 'Save settings', 'classic-elementor-addons-pro' ); ?></button>
			</div><!-- .cea-header-right -->
		</div><!-- .cea-header-bar -->
		
		<div class="cea-settings-tabs">
			<ul class="cea-tabs">
				<li><a href="#cea-general" class="active"><span><?php esc_html_e( 'General', 'classic-elementor-addons-pro' ); ?></span></a></li>
				<li><a href="#cea-widgets"><span><?php esc_html_e( 'Widgets', 'classic-elementor-addons-pro' ); ?></span></a></li>
				<!-- <li><a href="#cea-premium"><span><?php esc_html_e( 'Go Premium', 'classic-elementor-addons-pro' ); ?></span></a></li> -->
			</ul>
			<div id="cea-general" class="cea-settings-tab cea-elements-list active">
				<div class="container">
					<div class="row">
						<div class="col-8">
							<div class="row">
								<div class="col-6 mb-4">
									<div class="banner-img-wrap">
										<img class="cea-preview-img img-fluid" src="<?php echo esc_url( CEA_CORE_URL . 'assets/images/banner.png' ); ?>" alt="essential-addons-for-elementor-featured">
									</div>
								</div><!-- .col -->
									<?php
										$php_version = phpversion();
										$php_version_class = version_compare($php_version, '8.2.0', '>=') ? ' success' : ' warning';
										$php_message = '';
										if (version_compare($php_version, '8.2.0', '<')) {
											$php_message = 'Your PHP version is below the minimum requirement (8.2.0). Please upgrade.';
										}

										$wp_version = get_bloginfo('version');
										$wp_version_class = version_compare($wp_version, '6.7.2', '>=') ? ' success' : ' warning';
										$wp_message = '';
										if (version_compare($wp_version, '6.7.2', '<')) {
											$wp_message = 'Your WordPress version is below the minimum requirement (6.7.2). Please upgrade.';
										}
										?>

										<div class="col-6 mb-4">
											<div class="media admin-box">
												<div class="admin-box-icon mr-3">
													<span class="dashicons dashicons-admin-generic"></span>
												</div>
												<div class="media-body admin-box-info">
													<h3 class="admin-box-title"><?php esc_html_e('Requirements', 'classic-elementor-addons-pro'); ?></h3>
													<div class="admin-box-content">
														<table class="cea-admin-table">
															<thead>
																<tr>
																	<td><?php esc_html_e('Core', 'classic-elementor-addons-pro'); ?></td>
																	<td><?php esc_html_e('Required', 'classic-elementor-addons-pro'); ?></td>
																	<td><?php esc_html_e('Status', 'classic-elementor-addons-pro'); ?></td>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><?php esc_html_e('PHP', 'classic-elementor-addons-pro'); ?></td>
																	<td>8.2.0</td>
																	<td class="text-center">
																		<?php if ($php_message === '') : ?>
																			<span class="requirement-icon <?php echo esc_attr($php_version_class); ?>"></span>
																		<?php else : ?>
																			<?php echo esc_html($php_message); ?>
																		<?php endif; ?>
																	</td>
																</tr>
																<tr>
																	<td><?php esc_html_e('WordPress', 'classic-elementor-addons-pro'); ?></td>
																	<td>6.7.2</td>
																	<td class="text-center">
																		<!-- checks if the wp_messgae is Empty -->
																		<?php if ($wp_message === '') : ?>
																			<span class="requirement-icon <?php echo esc_attr($wp_version_class); ?>"></span>
																		<?php else : ?>
																			<?php echo esc_html($wp_message); ?>
																		<?php endif; ?>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
													<a href="https://1.envato.market/x67a5" class="cea-btn btn-default"><?php esc_html_e('Go Here', 'classic-elementor-addons-pro'); ?></a>
												</div>
											</div>
										</div><!-- .col -->
								<div class="col-6 mb-4">
									<div class="media admin-box">
										<div class="admin-box-icon mr-3">
											<span class="dashicons dashicons-media-document"></span>								
										</div>
										<div class="media-body admin-box-info">
											<h3 class="admin-box-title"><?php esc_html_e( 'Documention', 'classic-elementor-addons-pro' ); ?></h3>
											<div class="admin-box-content">
												<?php esc_html_e( 'Get started by spending some time with the documentation to get familiar with Classic Elementor Addons. Build awesome websites for you or your clients with ease.', 'classic-elementor-addons-pro' ); ?>
											</div>
											<a href="https://docs.zozothemes.com/cea/" class="cea-btn btn-default"><?php esc_html_e( 'Go Here', 'classic-elementor-addons-pro' ); ?></a>
										</div>
									</div>
								</div><!-- .col -->
								<div class="col-6">
									<div class="media admin-box">
										<div class="admin-box-icon mr-3">
											<span class="dashicons dashicons-admin-users"></span>								
										</div>
										<div class="media-body admin-box-info">
											<h3 class="admin-box-title"><?php esc_html_e( 'Need Help?', 'classic-elementor-addons-pro' ); ?></h3>
											<div class="admin-box-content">
												<?php esc_html_e( 'Stuck with something? Get help from the community on WordPress.org Forum initiate a live chat at Classic Elementor Addons website and get support.', 'classic-elementor-addons-pro' ); ?>
											</div>
											<a href="https://zozothemes.ticksy.com/" class="cea-btn btn-default"><?php esc_html_e( 'Get Support', 'classic-elementor-addons-pro' ); ?></a>
										</div>
									</div>
								</div><!-- .col -->
								<div class="col-12">
									<div class="admin-box-slide-wrap text-center">
										<?php
											if( !empty( $response ) && isset( $response['banner'] ) ) {
												foreach( $response['banner'] as $key => $banner ){
													echo '<a href="'. esc_url( $banner['link'] ) .'" target="_blank"><img src="'. esc_url( $banner['img'] ) .'" alt="'. esc_url( $banner['alt'] ) .'"></a>';
												}
											}
										?>
									</div>
								</div><!-- .col -->
							</div><!-- .row -->
						</div><!-- .col -->
						<div class="col-4">
							<div class="admin-box">
								<div class="admin-box-info">
									<h3 class="admin-box-title"><?php esc_html_e( 'Live Updates', 'classic-elementor-addons-pro' ); ?></h3>
									<div class="admin-box-pro text-center">
										<a class="cea-btn btn-default abs-right" href="#"><?php esc_html_e( 'Go Pro', 'classic-elementor-addons-pro' ); ?></a>
									</div>									
									<div class="admin-box-list">
										<div class="full-logo-wrap"><img src="<?php echo esc_url( CEA_CORE_URL . 'assets/images/logo.png' ); ?>" alt="cea-logo"></div>
										<ul class="cea-news-events">
										<?php										
										if( !empty( $response ) && isset( $response['list'] ) ) {
											foreach( $response['list'] as $feature ){
												echo '<li>'. esc_html( $feature ) .'</li>';
											}
										}
										?>
										</ul>
									</div>
									<h3 class="admin-box-title my-4"><?php esc_html_e( 'Supported Themes', 'classic-elementor-addons-pro' ); ?></h3>
									<div class="admin-box-slide-wrap">
									<?php										
										if( !empty( $response ) && isset( $response['products'] ) ) {
											echo '<div class="owl-carousel">';
											foreach( $response['products'] as $key => $product ){
												echo '<a href="'. esc_url( $product['link'] ) .'" target="_blank"><img src="'. esc_url( $product['img'] ) .'" alt="'. esc_url( $product['alt'] ) .'"></a>';
											}
											echo '</div>';
										}
									?>
									</div>
								</div>
							</div>
						</div>
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .cea-settings-tab -->
			<div id="cea-widgets" class="cea-settings-tab cea-elements-list elements-list-wrap">
				<?php 
					wp_nonce_field( 'cea_plugin_shortcodes_options', 'save_cea_shortcodes_options' ); 
					$shortcode_stat = Classic_Elementor_Addon::cea_shortcodes();						
					if ( isset( $_POST['save_cea_shortcodes_options'] ) && wp_verify_nonce( $_POST['save_cea_shortcodes_options'], 'cea_plugin_shortcodes_options' ) ) {
						if ( isset( $_POST['cea_shortcodes'] ) ) {
							update_option( 'cea_shortcodes', $_POST['cea_shortcodes'] );
						} else {
							update_option( 'cea_shortcodes', array() );
						}
					}
					$cea_shortcodes = get_option('cea_shortcodes');
				?>
				<div class="container">
				
					<div class="row">
						<div class="col-12">
							<div class="admin-box cea-main-box text-center">	
								<h3><?php esc_html_e( 'Enable/Disable all the widget here.', 'classic-elementor-addons-pro' ); ?></h3>
								<a href="#" class="cea-trigger-all-shortcodes"><?php esc_html_e( 'Check/Uncheck All', 'classic-elementor-addons-pro' ); ?></a>
							</div><!-- .admin-box -->
						</div><!-- .col -->
					</div><!-- .row -->
					
					<?php			
							$row = 1;
							foreach( $shortcode_stat as $key => $value ){
								$saved_val = 'on';
								$shortcode_name = str_replace( "-", "_", $key );
									if( isset( $cea_shortcodes[$shortcode_name] ) ){ // working without the condition $cea_shortcodes[$shortcode_name] == 'on' 
										$saved_val = 'on';
									}else{
										$saved_val = 'off';
									}
								$checked_stat = $saved_val == 'on' ? 'checked="checked"' : 'off';  // modified here

								if( $row % 4 == 1 ) echo '<div class="row">';
									echo '
									<div class="col-3">
										<div class="element-group admin-box">
											<div class="element-group-inner">
												<h3>'. esc_html( $value ) .'</h3>
												<label class="switch">
													<input class="switch-checkbox" type="checkbox" name="cea_shortcodes['. esc_attr( $shortcode_name ) .']" '. $checked_stat .'>
													<span class="slider round"></span>
												</label>
												<div class=docs-links>
													<a class="docs-links-url" href="https://docs.zozothemes.com/cea/' . esc_attr( $shortcode_name = str_replace( "_", "-", $shortcode_name) ) . '/" target="_blank"><span class="dashicons dashicons-media-document"></span><span class="how-it-works">Read More</span></a>
												</div><!-- .docs-links -->
											</div><!-- .element-group-inner -->
										</div><!-- .element-group -->
									</div><!-- .col -->';
												
								if( $row % 4 == 0 ) echo '</div><!-- .row -->';
								$row++;
							}
							
						if( $row % 4 != 1 ) echo '</div><!-- .cea-row unexpceted close -->';
					?>

					<?php
					/*
					 * Action Hooks - hook_name - priority
					 */
					do_action( 'cea_pt_shortcodes_enable' );
					?>
					
				</div> <!-- .cea-shortcodes-container -->
			</div> <!-- .cea-settings-tab -->
			<div id="cea-premium" class="cea-settings-tab cea-elements-list">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="admin-box text-center">
								<div class="admin-box-info">
									<h3 class="admin-box-title"><?php esc_html_e( 'Classic Addons Pro', 'classic-elementor-addons-pro' ); ?></h3>
									<div class="admin-box-content">
										<p><?php esc_html_e( 'Get started by spending some time with the documentation to get familiar with Classic Elementor Addons.', 'classic-elementor-addons-pro' ); ?></p>
										<p><?php esc_html_e( 'Build awesome websites for you or your clients with ease.', 'classic-elementor-addons-pro' ); ?></p>
									</div>
									<a href="#" class="cea-btn btn-default"><?php esc_html_e( 'Go Pro', 'classic-elementor-addons-pro' ); ?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> <!-- .cea-settings-tab -->
		</div><!-- .cea-settings-tabs -->
		
	</div><!-- .cea-settings-wrap -->
	<?php
}
function classic_elementor_options_admin_page() {
    
    $plugin_data = get_plugin_data( CEA_CORE_DIR . 'index.php' );
    $version = isset( $plugin_data['Version'] ) ? $plugin_data['Version'] : '0';
    
    ?>
    
    <form method="post" action="#" enctype="multipart/form-data" id="cea-form-wrapper">
    <div class="cea-settings-wrap">    
        <div class="cea-header-bar">
            <div class="cea-header-left">
                <div class="cea-admin-logo-inline">
                    <img src="<?php echo esc_url( CEA_CORE_URL . 'assets/images/logo.png' ); ?>" alt="cea-logo">
                </div><!-- .cea-admin-logo-inline -->
                <h2 class="title"><?php esc_html_e( 'Classic Elementor Addon', 'classic-elementor-addons-pro' ); ?><span class="cea-version"><?php echo esc_attr( $version ); ?></span></h2>
            </div><!-- .cea-header-left -->
            <div class="cea-header-right">
                <button type="submit" class="button cea-plugin-submit cea-btn"><?php esc_html_e( 'Save settings', 'classic-elementor-addons-pro' ); ?></button>
            </div><!-- .cea-header-right -->
        </div><!-- .cea-header-bar -->        
        <?php            
            if ( isset( $_POST['save_cea_plugin_options'] ) && wp_verify_nonce( $_POST['save_cea_plugin_options'], 'cea_plugin_options' ) ) {
                update_option( 'cea_options', $_POST['cea_options'] );
                require_once ( CEA_CORE_DIR . 'inc/cea-addon-styles.php' );
            }
            require_once ( CEA_CORE_DIR . 'admin/cea-options.php' );
            ceaPluginOptions::$opt_name = 'cea_options';
            ceaPluginOptions::$cea_options = $cea_options = get_option('cea_options');            
            require_once ( CEA_CORE_DIR . 'admin/cea-config.php' );            
        ?>        
        <div class="cea-admin-content-wrap">            
            <?php wp_nonce_field( 'cea_plugin_options', 'save_cea_plugin_options' ); ?>
            <div class="cea-tab">
                <div class="cea-tab-list">
                    <ul class="tablinks-list">
                        <?php ceaPluginOptions::ceaPutSection(); ?>
                    </ul>
                </div><!-- .cea-tab-list -->
                
                <?php ceaPluginOptions::ceaPutFields(); ?>
                
            </div><!-- .cea-tab -->
        </div><!-- .cea-admin-content-wrap -->

         <script>
            jQuery(document).ready(function($){
                $('.wp-color').each(function(){
                    $(this).wpColorPicker();
                });
            });
        </script>        
    </div><!-- .cea-admin-wrap -->
    </form>
    <?php
}

add_action( 'admin_enqueue_scripts', 'cea_framework_admin_scripts' );
function cea_framework_admin_scripts(){
if( isset( $_GET['page'] ) && ( $_GET['page'] == 'classic-addons' || $_GET['page'] == 'classic-addons-widgets' ) ){
		wp_enqueue_style( 'cea-admin', CEA_CORE_URL . '/admin/assets/css/cea-admin-page.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'cea-owl-admin', CEA_CORE_URL . '/assets/css/owl.carousel.min.css', array(), '2.3.4', 'all' );
		wp_enqueue_script( 'cea-owl-admin', CEA_CORE_URL . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
	}
	wp_enqueue_script( 'cea-framework-admin', CEA_CORE_URL . 'admin/assets/js/cea-admin-script.js', array( 'jquery' ), '1.0', true );
}