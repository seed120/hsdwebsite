<?php
/**
 * Hirxpert functions and definitions
 */
 
define('HIRXPERT_DIR', get_template_directory() );
define('HIRXPERT_URI', get_template_directory_uri() );

class Hirxpert_Theme_function{

    public static function init() {
        add_action('after_setup_theme', [__CLASS__, 'hirxpert_theme_support']);
		add_action('after_setup_theme', [__CLASS__, 'hirxpert_after_support']);
		add_action( 'wp_enqueue_scripts', [__CLASS__, 'hirxpert_register_scripts'] );
		add_action( 'enqueue_block_editor_assets', [__CLASS__, 'hirxpert_editor_customizer_styles'] );
        add_action( 'init', [__CLASS__, 'hirxpert_menus'] );
        add_filter( 'upload_size_limit', [__CLASS__, 'increase_upload_size_limit']);
       	add_action( 'widgets_init', [__CLASS__,'hirxpert_sidebar_registration']);
        add_filter( 'the_content_more_link', [__CLASS__,'hirxpert_read_more_tag'] );
        add_action( 'manage_posts_custom_column' , [__CLASS__,'hirxpert_custom_post_column'], 10, 2 );
	    add_action( 'manage_pages_custom_column' , [__CLASS__,'hirxpert_custom_post_column'], 10, 2 );
	    // Hirxpert Mobile Header
    	add_action( 'hirxpert_header_before', [__CLASS__,'hirxpert_mobile_header'], 10 );
    	add_action( 'hirxpert_header', [__CLASS__,'hirxpert_desktop_header'], 10 );
	    add_action( 'hirxpert_header_after', [__CLASS__,'hirxpert_header_slider'], 10 );
    	add_action( 'hirxpert_footer', [__CLASS__,'hirxpert_site_footer'], 10 );
        add_action('admin_notices', [__CLASS__,'check_plugin_folder_permissions']);
        add_action('admin_notices', [__CLASS__,'check_plugin_content_permissions']);
        add_action('admin_notices', [__CLASS__,'check_plugin_uploads_permissions']);
        // Add the custom columns to the book post type:
        add_filter( 'manage_posts_columns', [__CLASS__,'hirxpert_set_custom_edit_columns'] );
        add_filter( 'manage_pages_columns', [__CLASS__,'hirxpert_set_custom_edit_columns'] );
    
        //Default exceprt length
        if( !class_exists( 'Hirxpert_Addon' ) ){
            add_filter( 'excerpt_length', 'hirxpert_default_excerpt_length', 10 );
           	function hirxpert_default_excerpt_length( $length ){
                $hirxpert_options = get_option( 'hirxpert_options' );
                if( isset( $hirxpert_options['blog-post-excerpt-length'] ) && !empty( $hirxpert_options['blog-post-excerpt-length'] ) ) {
                    return absint( $hirxpert_options['blog-post-excerpt-length'] );
                }
                return $length;
            }
        }
        //Excerpt more
        add_filter( 'excerpt_more', function($length) {
            return '..';
        } );
    }

	public static function hirxpert_theme_support() {
		
		/* Text domain */
		load_theme_textdomain( 'hirxpert', HIRXPERT_DIR . '/languages' );
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

	// Custom background color.
	add_theme_support(
		'custom-background',
		array(
			'default-color' => 'f5efe0',
		)
	);

	// Set content-width.
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 1140;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 1200, 9999 );
	update_option( 'large_size_w', 1170 );
	update_option( 'large_size_h', 694 );
	update_option( 'large_crop', 1 );
	update_option( 'medium_size_w', 768 );
	update_option( 'medium_size_h', 456 );
	update_option( 'medium_crop', 1 );
	update_option( 'thumbnail_size_w', 80 );
	update_option( 'thumbnail_size_h', 80 );
	update_option( 'thumbnail_crop', 1 );

	// Custom logo.
	$logo_width  = 120;
	$logo_height = 90;

	// If the retina setting is active, double the recommended width and height.
	if ( get_theme_mod( 'retina_logo', false ) ) {
		$logo_width  = floor( $logo_width * 2 );
		$logo_height = floor( $logo_height * 2 );
	}

	add_theme_support(
		'custom-logo',
		array(
			'height'      => $logo_height,
			'width'       => $logo_width,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		)
	);

	load_theme_textdomain( 'hirxpert' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( 'style-editor.css' );

	// Editor color palette.
	add_theme_support(
		'editor-color-palette',
		array(
			array(
				'name'  => esc_html__( 'Dark Gray', 'hirxpert' ),
				'slug'  => 'dark-gray',
				'color' => '#111',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'hirxpert' ),
				'slug'  => 'light-gray',
				'color' => '#767676',
			),
			array(
				'name'  => esc_html__( 'White', 'hirxpert' ),
				'slug'  => 'white',
				'color' => '#FFF',
			),
		)
	);

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );

		//Woocommerce Support
		add_theme_support( 'woocommerce');
		add_theme_support( 'woocommerce_product_gallery_zoom' );
		add_theme_support( 'woocommerce_product_gallery_lightbox' );
		add_theme_support( 'woocommerce_product_gallery_slider' );
		
	}

	public static function hirxpert_after_support() {
	/**
	 * REQUIRED FILES
	 * Include required files.
	 */
		require get_template_directory() . '/inc/template-tags.php'; 
		// require get_template_directory() . '/inc/multilingual-functions.php';

//Elements
require get_template_directory() . '/classes/class.hirxpert-wp-elements.php';
//Framework
require get_template_directory() . '/classes/class.hirxpert-wp-framework.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-hirxpert-walker-comment.php';

if ( is_admin() ) {
	require_once ( HIRXPERT_DIR . '/admin/class.admin-settings.php');
}

if( !class_exists('Hirxpert_Theme_Option') ){
	require_once ( HIRXPERT_DIR . '/inc/theme-default.php');
}
	}

/**
 * Register and Enqueue Scripts.
 */
	public static function hirxpert_register_scripts() {

	$minify_css = Hirxpert_Wp_Elements::hirxpert_options("minify-css");

	if($minify_css){
		wp_enqueue_style(
			'style-min-css',
			get_template_directory_uri() . '/assets/css/theme.min.css',
			array(),
			'1.1'
		);
		
	} else {
		wp_enqueue_style( 'bootstrap-5', HIRXPERT_URI . '/assets/css/bootstrap.min.css', array(), '5.0.2' );
		wp_enqueue_style( 'bootstrap-icons', HIRXPERT_URI . '/assets/css/bootstrap-icons.css', false, '1.9.1' );
		wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/assets/css/themify-icons.css', array(), '1.0.1', 'all' );

	}
	// Woo
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		wp_enqueue_style( 'hirxpert-woo-style', get_theme_file_uri( '/assets/css/woo-styles.css' ), array(), '1.0' );
	}

	wp_register_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl-carousel.min.css', array(), '1.8.0', 'all' );
	$theme_version = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'hirxpert-style', get_template_directory_uri() . '/style.css', array(), $theme_version );
	wp_style_add_data( 'hirxpert-style', 'rtl', 'replace' );	
	wp_enqueue_style( 'theme-styles', HIRXPERT_URI . '/assets/css/theme-styles.css' );

	if( !class_exists('Hirxpert_Theme_Option') ){
			wp_enqueue_style( 'hirxpert-google-fonts', HirxpertTheme_default::hirxpert_theme_default_fonts_url(), array(), null, 'all' );
		wp_enqueue_style( 'hirxpert-custom', HIRXPERT_URI . '/assets/css/theme-custom-default.css', array(), '1.0' );
	}else{
		$custom_css = '';
		$custom_style = get_option( 'hirxpert_custom_styles' );
		if( class_exists( 'Hirxpert_Theme_Option' ) ){
			if( $custom_style ){
				$custom_css .= Hirxpert_Theme_Option::hirxpert_minify_css( $custom_style );
			}else{
				$custom_css = apply_filters( 'hirxpert_trigger_to_save_custom_styles', $custom_css );
			}
			if( is_singular() ){
				$post_id = get_the_ID();
				$post_styles = get_post_meta( $post_id, 'hirxpert_post_custom_styles', true );
				if( $post_styles ){
					$custom_css .= $post_styles; //Hirxpert_Theme_Option::hirxpert_minify_css( $post_styles );
				}
			}
		}
			if( $custom_css ) wp_add_inline_style( 'theme-styles', stripslashes_deep( $custom_css ) );
	}

	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$minify_js = Hirxpert_Wp_Elements::hirxpert_options("minify-js");

	if( $minify_js ){
		wp_register_script(
			'theme-min',
			get_template_directory_uri() . '/assets/js/theme.min.js',
			array(),
			'1.1'
		);
	} else {
		wp_register_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.8.0', false );
	}
	wp_enqueue_script( 'hirxpert-js', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), $theme_version, false );
	wp_script_add_data( 'hirxpert-js', 'async', true );

	$header_offset = Hirxpert_Wp_Elements::hirxpert_options("header-offset");
	$header_offset_y = is_array( $header_offset ) && isset( $header_offset['height'] ) ? $header_offset['height'] : 0;
	$mheader_offset = Hirxpert_Wp_Elements::hirxpert_options("mobile-header-offset");
	$mheader_offset_y = is_array( $mheader_offset ) && isset( $mheader_offset['height'] ) ? $mheader_offset['height'] : 0;
	$res_width = Hirxpert_Wp_Elements::hirxpert_options("mobilebar-responsive");

	$hirxpert_js_args = array(
		'ajax_url' => esc_url( admin_url('admin-ajax.php') ),
		'add_to_cart' => wp_create_nonce('hirxpert-add-to-cart(*$#'),
		'remove_from_cart' => wp_create_nonce('hirxpert-remove-from-cart(*$#'),
		'cart_update_pbm' => esc_html__('Cart Update Problem.', 'hirxpert'),
		'wishlist_remove' => wp_create_nonce('hirxpert-wishlist-{}@@%^@'),
		'product_view' => wp_create_nonce('hirxpert-product-view-@%^&#'),
		'mc_nounce' => wp_create_nonce( 'hirxpert-mailchimp' ), 
		'must_fill' => esc_html__( 'Must Fill Required Details.', 'hirxpert' ),
		'valid_email' => esc_html__( 'Enter Valid Email ID.', 'hirxpert' ),
		'header_offset' => $header_offset_y,
		'mheader_offset' => $mheader_offset_y,
		'res_width' => $res_width
	);
	$hirxpert_js_args = apply_filters( 'hirxpert_wp_localize_args', $hirxpert_js_args );
	wp_localize_script('hirxpert-js', 'hirxpert_ajax_var', $hirxpert_js_args );
}

/**
 * Enqueue supplemental block editor styles.
 */
	public static function hirxpert_editor_customizer_styles() {
	if( !class_exists('Hirxpert_Options') ){
		require_once ( HIRXPERT_DIR . '/inc/theme-default.php');
			wp_enqueue_style( 'hirxpert-customizer-google-fonts', HirxpertTheme_default::hirxpert_theme_default_fonts_url(), array(), null, 'all' );
	}
	
	$minify_css = Hirxpert_Wp_Elements::hirxpert_options("minify-css");
	if( $minify_css ){
		wp_enqueue_style(
			'style-min',
			get_template_directory_uri() . '/assets/css/style.min.css',
			array(),
			'1.1'
		);
		wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/assets/css/themify-icons.css', array(), '1.0.1', 'all' );
		wp_enqueue_style( 'hirxpert-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.0', 'all' );	
	} else {
		wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/assets/css/themify-icons.css', array(), '1.0.1', 'all' );
		wp_enqueue_style( 'hirxpert-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.0', 'all' );	
	}
	wp_enqueue_style( 'bootstrap-icons', HIRXPERT_URI . '/assets/css/bootstrap-icons.css', false, '1.9.1' );

	if( class_exists('Hirxpert_Options') ){
		ob_start();
		require_once ( HIRXPERT_ADDON_DIR . '/admin/extension/theme-options/theme-editor-css.php');
		$custom_styles = ob_get_clean();
		wp_add_inline_style( 'hirxpert-editor-customizer-styles', $custom_styles );
		add_action( 'admin_head', function(){ Hirxpert_Wp_Actions::hirxpert_google_fonts_con(); }, 10 );
	}
}


/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
	public static function hirxpert_menus() {

	$locations = array(
		'primary'  => __( 'Primary Menu', 'hirxpert' ),
		'mobile'   => __( 'Mobile Menu', 'hirxpert' ),
		'top-menu'  => __( 'Top Menu', 'hirxpert' ),
		'footer'   => __( 'Footer Menu', 'hirxpert' )
	);

	register_nav_menus( $locations );
}
	

	public static function increase_upload_size_limit( $upload_size_limit ) {
		// Set the maximum upload file size to 10MB (in bytes)
		return 10 * 1024 * 1024; 
	}


	/**
	 * Register widget areas.
	 */
	public static function hirxpert_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h3 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h3>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Right Sidebar
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Right Sidebar', 'hirxpert' ),
				'id'          => 'right-sidebar',
				'description' => esc_html__( 'Widgets in this area will be displayed in the right side column in the content area.', 'hirxpert' ),
			)
		)
	);
	
	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer #1', 'hirxpert' ),
				'id'          => 'footer-1',
				'description' => esc_html__( 'Widgets in this area will be displayed in the first column in the footer.', 'hirxpert' ),
			)
		)
	);

	// Footer #2
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer #2', 'hirxpert' ),
				'id'          => 'footer-2',
				'description' => esc_html__( 'Widgets in this area will be displayed in the second column in the footer.', 'hirxpert' ),
			)
		)
	);

	// Footer #3
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer #3', 'hirxpert' ),
				'id'          => 'footer-3',
				'description' => esc_html__( 'Widgets in this area will be displayed in the third column in the footer.', 'hirxpert' ),
			)
		)
	);
	
	// Footer #4
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => esc_html__( 'Footer #4', 'hirxpert' ),
				'id'          => 'footer-4',
				'description' => esc_html__( 'Widgets in this area will be displayed in the third column in the footer.', 'hirxpert' ),
			)
		)
	);

}

	/**
	 * Overwrite default more tag with styling and screen reader markup.
	 *
	 * @param string $html The default output HTML for the more tag.
	 *
	 * @return string $html
	 */
	public static function hirxpert_read_more_tag( $html ) {
	return preg_replace( '/<a(.*)>(.*)<\/a>/iU', sprintf( '<div class="read-more-button-wrap"><a$1><span class="faux-button">$2</span> <span class="screen-reader-text">"%1$s"</span></a></div>', get_the_title( get_the_ID() ) ), $html );
}




	public static function hirxpert_set_custom_edit_columns( $columns ) {
		unset( $columns['author'] );
		$columns['views'] = __( 'Views', 'hirxpert' );
		return $columns;
	}

	// Add the data to the custom columns for the book post type:

	public static function hirxpert_custom_post_column( $column, $post_id ) {
		switch ( $column ) {
			case 'views' :
				echo get_post_meta( $post_id , 'hirxpert_post_views_count' , true ); 
			break;
		}
	}


	public static function hirxpert_mobile_header(){
		get_template_part( 'template-parts/mobile', 'header' );
	}

	// Hirxpert Header
	public static function hirxpert_desktop_header(){
		get_template_part( 'template-parts/site', 'header' );
	}

	// Header slider action 
	public static function hirxpert_header_slider(){	
		$page_options = Hirxpert_Wp_Elements::$hirxpert_page_options;	
		if( !empty( $page_options ) && is_array( $page_options ) ):
			if( isset( $page_options['header-slider'] ) && !empty( $page_options['header-slider'] ) ? sanitize_text_field( $page_options['header-slider'] ) : '' ){
				echo '<div class="hirxpert-slider-wrapper">';
					echo do_shortcode($page_options['header-slider'] );
				echo '</div> <!-- .hirxpert-slider-wrapper -->';
			}
		endif;
	}


	public static function hirxpert_site_footer(){
		get_template_part( 'template-parts/site', 'footer' );
	}

	

	public static function check_plugin_folder_permissions() {
		$plugin_dir = WP_CONTENT_DIR . '/plugins/';

    if (!is_dir($plugin_dir)) {
        echo '<div class="error"><p>' . esc_html__('Error: The plugins directory does not exist!', 'hirxpert') . '</p></div>';
        return;
    }
    $perms = substr(sprintf('%o', fileperms($plugin_dir)), -3);

    if ($perms !== '755' && $perms !== '775') {
        echo '<div class="error"><p>' . esc_html__('Warning: The plugins directory does not have the correct permissions (755 or 775). Please update the folder permissions to install plugins.', 'hirxpert') . '</p></div>';
    }

    if (!is_writable($plugin_dir)) {
        echo '<div class="error"><p>' . esc_html__('Warning: The server does not have write permissions for the plugins directory. Plugin installation may fail.', 'hirxpert') . '</p></div>';
    }
}


	
	public static function check_plugin_content_permissions() {
		$content_dir = WP_CONTENT_DIR;

    if (!is_dir($content_dir)) {
        echo '<div class="error"><p>' . esc_html__('Error: The plugins directory does not exist!', 'hirxpert') . '</p></div>';
        return;
    }
    $perms = substr(sprintf('%o', fileperms($content_dir)), -3);

    if ($perms !== '755' && $perms !== '775') {
        echo '<div class="error"><p>' . esc_html__('Warning: The content directory does not have correct permissions (755 or 765 ). Please Update the folder permissions all content will work fine.', 'hirxpert') . '</p></div>';
    }

    if (!is_writable($content_dir)) {
        echo '<div class="error"><p>' . esc_html__('Warning: The server does not have write permissions for the Content directory. Content import or plugin files installation may fail.', 'hirxpert') . '</p></div>';
    }
}

	

	public static function check_plugin_uploads_permissions() {
		$uploads_dir = WP_CONTENT_DIR . '/uploads/';
		if (!is_dir($uploads_dir)) {
			echo '<div class="error"><p>' . esc_html__('Error: The plugins directory does not exist!', 'hirxpert') . '</p></div>';
			return;
		}
		$perms = substr(sprintf('%o', fileperms($uploads_dir)), -3);

    if ($perms !== '755' && $perms !== '775') {
        echo '<div class="error"><p>' . esc_html__('Warning: The Uploads directory does not have correct permissions (755 or 765 ). Please Update the folder permissions to import all media files.', 'hirxpert') . '</p></div>';
    }

		if (!is_writable($uploads_dir)) {
			echo '<div class="error"><p>' . esc_html__('Warning: The server does not have write permissions for the Uploads directory. Media files installation may fail.', 'hirxpert') . '</p></div>';
		}
	}
}Hirxpert_Theme_function::init();
