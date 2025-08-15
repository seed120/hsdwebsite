<?php 

class Hirxpert_Custom_Fonts {
	
	private static $_instance = null;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'hirxpert_addon_admin_menu' ) );		
	}
	
	public static function hirxpert_addon_admin_menu(){
		add_submenu_page( 
			'hirxpert-welcome', 
			esc_html__( 'Custom Fonts', 'hirxpert-addon' ),
			esc_html__( 'Custom Fonts', 'hirxpert-addon' ), 
			'manage_options', 
			'hirxpert-fonts', 
			array( 'Hirxpert_Custom_Fonts', 'hirxpert_fonts_admin_page' )
		);
	}
	
	public static function hirxpert_fonts_admin_page(){
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
					<h2 class="title"><?php esc_html_e( 'Hirxpert Custom Fonts', 'hirxpert-addon' ); ?><span class="hirxpert-version"><?php echo esc_attr( $hirxpert_theme->get( 'Version' ) ); ?></span></h2>
					<div class="nav-theme-options">
						<a href="<?php echo admin_url('admin.php?page=hirxpert-options'); ?>"><span class="dashicons dashicons-admin-tools"></span>Theme Options</a>
						<a href="<?php echo admin_url('admin.php?page=hirxpert-plugins')?>"><span class="dashicons dashicons-admin-plugins"></span>Plugins</a>
						<div class="support-dropdown">
							<a href="#" class="dropdown-toggle"><span class="dashicons dashicons-testimonial"></span>Support</a>
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
										<h3 class="admin-box-title"><?php esc_html_e( 'Add Custom Fonts', 'hirxpert-addon' ); ?></h3>
										<div class="admin-box-content">
											<?php esc_html_e( 'You can add custom fonts here. Also we give you option to remove or delete custom fonts.', 'hirxpert-addon' ); ?>
										</div>	
										<form action="" method="post" enctype="multipart/form-data">
											<?php wp_nonce_field( 'hirxpert-)(&(*@#*%@*', 'hirxpert_custom_font_nonce' ); ?>
											<input type="file" name="hirxpert_custom_fonts" id="hirxpert-custom-fonts" class="hirxpert-custom-fonts" />
										</form>
										<a href="#" class="hirxpert-btn btn-default hirxpert-custom-fonts-upload"><?php esc_html_e( 'Upload Font', 'hirxpert-addon' ); ?></a>
										<ol class="admin-instruction-list">
											<li><?php esc_html_e( 'Notes: Custom fonts should be in this following format. .eot, .otf, .svg, .ttf, .wof', 'hirxpert-addon' ) ?></li>
											<li><?php esc_html_e( 'Font folder name only show as font name in theme option. So make folder name and font name are should be the same but font name like slug type.', 'hirxpert-addon' ) ?></li>
											<li><?php printf( '%1$s <strong>%2$s</strong> %3$s <strong>%4$s</strong>', esc_html__( 'Eg: Font folder name is -', 'hirxpert-addon' ), esc_html__( 'Wonder Land', 'hirxpert-addon' ), esc_html__( ' font name like', 'hirxpert-addon' ), esc_html__( ' wonder-land.eot, wonder-land.otf ...', 'hirxpert-addon' ) ); ?></li>
										</ol>
									</div>
								</div>
							</div>
							<div class="col-8">
								<div class="admin-box">
									<h3 class="admin-box-title font-title"><?php esc_html_e( 'Custom Fonts', 'hirxpert-addon' ); ?></h3>
									<?php
									//delete_option( 'hirxpert_custom_fonts' );
									if (isset($_POST['hirxpert_custom_font_nonce']) && wp_verify_nonce($_POST['hirxpert_custom_font_nonce'], 'hirxpert-)(&(*@#*%@*')) {
										Hirxpert_Custom_Fonts::hirxpert_upload_font();
									}

									if (isset($_POST['hirxpert_custom_font_remove_nonce']) && wp_verify_nonce($_POST['hirxpert_custom_font_remove_nonce'], 'hirxpert-(*&^&%^%@!')) {
										Hirxpert_Custom_Fonts::hirxpert_font_delete();
									}

									$custom_fonts = get_option('hirxpert_custom_fonts');
									?>
									<?php if (!empty($custom_fonts)) : ?>
										<form action="" method="post" enctype="multipart/form-data">
											<?php wp_nonce_field('hirxpert-(*&^&%^%@!', 'hirxpert_custom_font_remove_nonce'); ?>
											<input type="hidden" name="hirxpert_font_remove_name" id="hirxpert-font-remove-name" value="" />
											<table class="hirxpert-admin-table hirxpert-custom-font-table">
												<thead>
													<tr>
														<td><?php echo esc_html__('Font Name', 'hirxpert-addon'); ?></td>
														<td><?php echo esc_html__('CSS', 'hirxpert-addon'); ?></td>
														<td><?php echo esc_html__('Delete', 'hirxpert-addon'); ?></td>
													</tr>
												</thead>
												<tbody>
													<?php
													foreach ($custom_fonts as $font_slug => $font_name) {
													?>
														<tr>
															<td><?php echo esc_html($font_name); ?></td>
															<td>font-family: '<?php echo esc_html($font_name); ?>';</td>
															<td class="text-center"><a href="#" data-font="<?php echo esc_attr($font_slug); ?>" class="hirxpert-font-remove"><span class="dashicons dashicons-trash"></span></a></td>
														</tr>
													<?php
													}
													?>
												</tbody>
									</table>
									</form>
									<?php else: ?>
									<p><?php esc_html_e( 'Sorry! No custom fonts available.', 'hirxpert-addon' ); ?></p>
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
	
	public static function hirxpert_upload_font(){
		if ( isset( $_FILES['hirxpert_custom_fonts'] ) ) {
			// The nonce was valid and the user has the capabilities, it is safe to continue.
			
			$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/octet-stream', 'application/x-rar-compressed');
			$file_type = $_FILES['hirxpert_custom_fonts']['type'];
			
			if( in_array( $file_type, $accepted_types ) ){
				// These files need to be included as dependencies when on the front end.
				
				require_once( ABSPATH . 'wp-admin/includes/image.php' ); 
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				require_once( ABSPATH . 'wp-admin/includes/media.php' );
				
				// Let WordPress handle the upload.
				//delete_option( 'hirxpert_custom_fonts' );
				// Remember, 'pharmy_image_upload' is the name of our file input in our form above.
				$font_name = pathinfo($_FILES['hirxpert_custom_fonts']['name'], PATHINFO_FILENAME);
				$font_slug = sanitize_title( $font_name );
				if ( get_option( 'hirxpert_custom_fonts' ) ) {
					$custom_fonts_names = get_option( 'hirxpert_custom_fonts' ); 
					$custom_fonts_names = array_merge( $custom_fonts_names, array( $font_slug => $font_name ) );
				}else{
					$custom_fonts_names = array( $font_slug => $font_name );
				}
				WP_Filesystem();
				$destination = wp_upload_dir();
				$destination_path = $destination['basedir'] . '/custom-fonts/';
				$unzipfile = unzip_file( $_FILES['hirxpert_custom_fonts']['tmp_name'], $destination_path);
				
				update_option( 'hirxpert_custom_fonts', $custom_fonts_names );				
			}else{
				echo esc_html__( 'Invalid File Type', 'hirxpert-addon' );
			}
		}
	}
	
	public static function hirxpert_font_delete(){			
		$font_id = esc_attr( $_POST['hirxpert_font_remove_name'] );		
		$destination = wp_upload_dir();
		$custom_fonts = get_option( 'hirxpert_custom_fonts' );		
		if ( array_key_exists( $font_id, $custom_fonts ) ){
			$font_name = $custom_fonts[$font_id];
			$destination_path = $destination['basedir'] . '/custom-fonts/' . $font_name;	
			unset($custom_fonts[$font_id]);
			update_option( 'hirxpert_custom_fonts', $custom_fonts );
			//self::rmdir_recurse( $destination_path );
		}
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
	
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

} Hirxpert_Custom_Fonts::get_instance();