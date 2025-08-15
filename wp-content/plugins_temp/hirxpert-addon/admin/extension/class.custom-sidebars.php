<?php 

class Hirxpert_Custom_Sidebars {
	
	private static $_instance = null;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'hirxpert_addon_admin_menu' ) );	
		add_action( 'wp_ajax_hirxpert-custom-sidebar-export', array( $this, 'hirxpert_custom_sidebar_export' ) );
	}
	
	public static function hirxpert_addon_admin_menu(){
		add_submenu_page( 
			'hirxpert-welcome', 
			esc_html__( 'Custom Sidebars', 'hirxpert-addon' ),
			esc_html__( 'Custom Sidebars', 'hirxpert-addon' ), 
			'manage_options', 
			'hirxpert-sidebars', 
			array( 'Hirxpert_Custom_Sidebars', 'hirxpert_sidebar_admin_page' )
		);
	}
	
	public static function hirxpert_sidebar_admin_page(){
			
		$hirxpert_theme = wp_get_theme();
		echo '<div class="notice notice-error is-dismissible">';
		echo '<p><strong>Important Notice for Existing Users:</strong> We’ve made a significant update to the theme by removing the email and address fields while introducing flexible HTML fields for greater customization. If needed, you can now add these details manually using the new HTML fields. <a href="https://zozothemes.com/update-notice" target="_blank">Learn more about this update</a>.</p>';
		echo '</div>';
		?>
		<div class="hirxpert-settings-wrap">
			<div class="hirxpert-header-bar">
				<div class="hirxpert-header-left">
					<div class="hirxpert-admin-logo-inline">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/brand-logo.png' ); ?>" alt="hirxpert-logo">
					</div><!-- .hirxpert-admin-logo-inline -->
					<h2 class="title"><?php esc_html_e( 'Hirxpert Custom Sidebars', 'hirxpert-addon' ); ?><span class="hirxpert-version"><?php echo esc_attr( $hirxpert_theme->get( 'Version' ) ); ?></span></h2>
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
			
			<div class="hirxpert-settings-tabs hirxpert-custom-sidebar-wrap">
				<div id="hirxpert-general" class="hirxpert-settings-tab active">
					<div class="container">
						<div class="row">
							<div class="col-4">
								<div class="media admin-box">
									<div class="admin-box-icon mr-3">
										<span class="dashicons dashicons-welcome-widgets-menus"></span>								
									</div>
									<div class="media-body admin-box-info">
										<h3 class="admin-box-title"><?php esc_html_e( 'Add New Sidebar', 'hirxpert-addon' ); ?></h3>
										<div class="admin-box-content">
											<?php esc_html_e( 'You can add new custom sidebar here. Also we give you option to remove or delete custom sidebars.', 'hirxpert-addon' ); ?>
										</div>
										<?php
											$sidebars = '';
											$sidebar_opt_name = 'hirxpert_custom_sidebars';
											$sidebars = get_option( $sidebar_opt_name );
											
											if ( isset( $_POST['hirxpert_custom_sidebar_nonce'] ) && wp_verify_nonce( $_POST['hirxpert_custom_sidebar_nonce'], 'hirxpert-()@)(*^#@!' ) 
											) {
												if (isset($_POST['hirxpert_sidebar_name']) && !empty($_POST['hirxpert_sidebar_name'])) {
													$sidebar_name = sanitize_text_field($_POST['hirxpert_sidebar_name']); // Sanitize
													$sidebar_slug = sanitize_title($sidebar_name);

													if (!empty($sidebars)) {
														$sidebars[$sidebar_slug] = $sidebar_name;
													}else{
														$sidebars = array( $sidebar_slug => $sidebar_name );
													}	
													update_option( 'hirxpert_custom_sidebars', $sidebars );
												}
											}
											
											if ( isset( $_POST['hirxpert_custom_sidebar_remove_nonce'] ) && wp_verify_nonce( $_POST['hirxpert_custom_sidebar_remove_nonce'], 'hirxpert-()I*^*^%@!' ) 
											) {
												$remove_sidebar = isset($_POST['hirxpert_sidebar_remove_name']) && !empty($_POST['hirxpert_sidebar_remove_name']) ? sanitize_text_field($_POST['hirxpert_sidebar_remove_name']) : ''; // Sanitize
												unset($sidebars[$remove_sidebar]);
												update_option('hirxpert_custom_sidebars', $sidebars);
												$sidebars = get_option($sidebar_opt_name);
											}
											
										?>
										<form action="" method="post" enctype="multipart/form-data">
											<?php wp_nonce_field( 'hirxpert-()@)(*^#@!', 'hirxpert_custom_sidebar_nonce' ); ?>
											<input type="input" name="hirxpert_sidebar_name" class="custom-sidebar-name" value="" />
										</form>
										<a href="#" class="hirxpert-btn btn-default custom-sidebar-create"><?php esc_html_e( 'Add Sidebar', 'hirxpert-addon' ); ?></a>
 										<a href="widgets.php" class="hirxpert-btn btn-default custom-view-sidebar"><?php esc_html_e( 'View Sidebar', 'hirxpert-addon' ); ?></a>
									</div>
								</div>
							</div>
							<div class="col-8">
								<div class="admin-box">
									<h3 class="admin-box-title sidebar-title"><?php esc_html_e( 'Custom Sidebars', 'hirxpert-addon' ); ?></h3>
									<?php if( !empty( $sidebars ) ): ?>
									<form action="" method="post" enctype="multipart/form-data">
									<?php wp_nonce_field( 'hirxpert-()I*^*^%@!', 'hirxpert_custom_sidebar_remove_nonce' ); ?>
									<input type="hidden" name="hirxpert_sidebar_remove_name" id="hirxpert-sidebar-remove-name" value="" />									
									<table class="hirxpert-admin-table hirxpert-custom-sidebar-table">
										<thead>
											<tr>
												<td><?php esc_html_e( 'Name', 'hirxpert-addon' ); ?></td>
												<td><?php esc_html_e( 'Slug', 'hirxpert-addon' ); ?></td>
												<td><?php esc_html_e( 'Delete', 'hirxpert-addon' ); ?></td>
											</tr>
										</thead>
										<tbody>
										<?php
											foreach( $sidebars as $sidebar_slug => $sidebar_name ){
											?>
												<tr>
													<td><?php echo esc_html( $sidebar_name ); ?></td>
													<td><?php echo esc_html( $sidebar_slug ); ?></td>
													<td class="text-center"><a href="#" data-sidebar="<?php echo esc_attr( $sidebar_slug ); ?>" class="hirxpert-sidebar-remove"><span class="dashicons dashicons-trash"></span></a></td>
												</tr>
											<?php
											}
										?>
										</tbody>
									</table>
									</form>
									<a href="#" class="hirxpert-btn btn-default custom-sidebar-export"><?php esc_html_e( 'Export as JSON', 'hirxpert-addon' ); ?></a>
									<?php else: ?>
										<p><?php esc_html_e( 'Sorry! No custom sidebars available.', 'hirxpert-addon' ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	<?php
	}
		
	public static function rmdir_recurse($path) {
		$path = rtrim($path, '/').'/';
		$handle = opendir($path);
		while(false !== ($file = readdir($handle))) {
			if($file != '.' and $file != '..' ) {
				$fullpath = $path.$file;
				if(is_dir($fullpath)) self::rmdir_recurse($fullpath); else unlink($fullpath);
			}
		}
		closedir($handle);
		rmdir($path);
	}	
	
	public static function hirxpert_custom_sidebar_export(){
		$nonce = $_POST['nonce'];  
		if ( ! wp_verify_nonce( $nonce, 'hirxpert-()@)(*^#@!' ) )
			wp_die ( esc_html__( 'Not Ok', 'hirxpert-addon' ) );
		
		$sidebars = get_option( 'hirxpert_custom_sidebars' );
		if( !empty( $sidebars ) ){
			//wp_send_json( $sidebars );
			echo json_encode( $sidebars );
		}else{
			echo '';
		}	
		wp_die();
	}
	
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

} Hirxpert_Custom_Sidebars::get_instance();