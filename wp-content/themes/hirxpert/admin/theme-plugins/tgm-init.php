<?php
require_once HIRXPERT_DIR . '/admin/theme-plugins/class-tgm-plugin-activation.php';
class Hirxpert_Tgm_Init{

/**
 * Register the required plugins for this theme.
 */
	public static function hirxpert_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		array(
			'name'					=> esc_html__( 'Hirxpert Addon', 'hirxpert' ), // The plugin name.
			'slug'					=> 'hirxpert-addon', // The plugin slug (typically the folder name).
			'source'				=> esc_url( 'https://demo.zozothemes.com/demo-plugins/hirxpert-addon.zip' ), // The plugin source.
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required.
			'version'				=> '2.0.1',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'			=> '', // If set, overrides default API URL and points to an external URL.
			'image_url' 		 	=> esc_url( get_template_directory_uri() . '/admin/assets/images/plugins/hirxpert-addon.png' ),
		),
		array(
			'name'					=> esc_html__( 'Classic Elementor Addon', 'hirxpert' ), // The plugin name.
			'slug'					=> 'classic-elementor-addons-pro', // The plugin slug (typically the folder name).
			'source'				=> esc_url( 'https://wordpress.zozothemes.com/cea-addons/classic-elementor-addons-pro.zip' ),
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required.
			'version'				=> '2.0',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'			=> '', // If set, overrides default API URL and points to an external URL.
			'image_url' 		 	=> esc_url( get_template_directory_uri() . '/admin/assets/images/plugins/classic-elementor-addons-pro.png' ),
		),
		array(
			'name'					=> esc_html__( 'CEA Post Types', 'hirxpert' ), // The plugin name.
			'slug'					=> 'cea-post-types', // The plugin slug (typically the folder name).
			'source'				=> esc_url( 'https://wordpress.zozothemes.com/cea-addons/cea-post-types.zip' ),
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required.
			'version'				=> '2.0',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'			=> '', // If set, overrides default API URL and points to an external URL.
			'image_url' 		 	=> esc_url( get_template_directory_uri() . '/admin/assets/images/plugins/cea-post-types.png' ),
		),
		array(
			'name'					=> esc_html__( 'CEA Magazine', 'seoinux' ), // The plugin name.
			'slug'					=> 'cea-magazine', // The plugin slug (typically the folder name).
			'source'				=> esc_url( 'https://wordpress.zozothemes.com/cea-addons/cea-magazine.zip' ),
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required.
			'version'				=> '2.0',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'			=> '', // If set, overrides default API URL and points to an external URL.
			'image_url' 		 	=> esc_url( get_template_directory_uri() . '/admin/assets/images/plugins/cea-magazine.png' ),
		),
		array(
			'name'					=> esc_html__( 'Zozo Header Footer', 'hirxpert' ), // The plugin name.
			'slug'					=> 'zozo-header-footer', // The plugin slug (typically the folder name).
			'source'				=> esc_url( 'https://wordpress.zozothemes.com/cea-addons/zozo-header-footer.zip' ),
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required.
			'version'				=> '2.0',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'			=> '', // If set, overrides default API URL and points to an external URL.
			'image_url' 		 	=> esc_url( get_template_directory_uri() . '/admin/assets/images/plugins/zozo-header-footer.png' ),
		),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'image_url' 		 	=> esc_url( get_template_directory_uri() . '/admin/assets/images/plugins/contact-form-7.png' )
		),
		
		array(
			'name'     => 'Woocommerce',
			'slug'     => 'woocommerce',
			'required' => false,
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'image_url' 		 	=> esc_url( get_template_directory_uri() . '/admin/assets/images/plugins/woocommerce.png' )
		),
		array(
			'name'					=> esc_html__( 'Envato Market', 'hirxpert' ), // The plugin name.
			'slug'					=> 'envato-market', // The plugin slug (typically the folder name).
			'source'				=> esc_url( 'https://demo.zozothemes.com/import/plugins/envato-market.zip' ), // The plugin source.
			'required'				=> false, // If false, the plugin is only 'recommended' instead of required.
			'version'				=> '2.0.12',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'			=> '', // If set, overrides default API URL and points to an external URL.
			'image_url' 		 	=> esc_url( get_template_directory_uri() . '/admin/assets/images/plugins/envato-market.png' ),
		),
		array(
			'name'     => 'Elementor Page Builder',
			'slug'     => 'elementor',
			'required' => true,
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'image_url' 		 	=> esc_url( get_template_directory_uri() . '/admin/assets/images/plugins/elementor.png' )
		),
		array(
			'name'					=> esc_html__( 'Slider Revolution', 'hirxpert' ), // The plugin name.
			'slug'					=> 'revslider', // The plugin slug (typically the folder name).
			'source'				=> esc_url( 'https://demo.zozothemes.com/import/plugins/revslider.zip' ),
			'required'				=> true, // If false, the plugin is only 'recommended' instead of required.
				'version'				=> '6.7.34',
			'force_activation'		=> false,
			'force_deactivation'	=> false,
			'external_url'			=> '', // If set, overrides default API URL and points to an external URL.
			'image_url' 		 	=> esc_url( get_template_directory_uri() . '/admin/assets/images/plugins/revslider.png' ),
		),
	);
	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
        'id'           => 'hirxpert_tgmpa',           // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // hirxpert-welcome Parent menu slug.
        'capability'   => 'edit_theme_options',   // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );
	tgmpa( $plugins, $config );
}
}
// Hook the class static method to tgmpa_register
add_action( 'tgmpa_register', array( 'Hirxpert_Tgm_Init', 'hirxpert_register_required_plugins' ) );
class Hirxpert_TGM_Helper {
	public static function allowed_html_tags() {
	$class_only = array(
		'class' => array(),
		'title' => array()
	);
	$allowed_tags = array(
		'a' => array(
			'href' => array(),
			'title' => array(),
				'class' => array()
			),
			'img' => array(
				'src' => array(),
				'alt' => array(),
				'height' => array(),
				'width' => array(),
				'title' => array()
			),
			'br' => array(),
			'i' => $class_only,
			'span' => $class_only,
			'em' => array(),
			'strong' => array(),
			'p' => $class_only,
			'ul' => $class_only,
			'li' => $class_only,
			'div' => $class_only,
			'h2' => $class_only,
			'h3' => $class_only,
			'h4' => $class_only,
			'h5' => $class_only,
			'h6' => $class_only
		);
		return apply_filters( 'hirxpert_tgm_allowed_html_tags', $allowed_tags, $class_only );
	}
}
