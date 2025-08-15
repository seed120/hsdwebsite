<?php

class Hirxpert_Custom_Menu {
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	 
	private $mega_fields;
	 
	function __construct() {
		// load the plugin translation files
		
		add_action( 'admin_enqueue_scripts', array( $this, 'hirxpert_menu_enqueue_scripts' ) );
		
		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'hirxpert_add_custom_nav_fields' ) );
		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'hirxpert_update_custom_nav_fields'), 10, 3 );
		
		// edit menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'hirxpert_edit_walker'), 10, 2 );
		
	} // end constructor
	
	
	/**
	 * Register Megamenu stylesheets and scripts		
	 */
	function hirxpert_menu_enqueue_scripts( $hook ) {
		// style/scripts
		if ( 'nav-menus.php' == $hook ) {
			wp_enqueue_style( 'magnific-popup', HIRXPERT_ADDON_URL . 'admin/extension/mega-menu/css/magnific-popup.css', '1.1.0');
			wp_enqueue_style( 'hirxpert-megamenu', HIRXPERT_ADDON_URL . 'admin/extension/mega-menu/css/megamenu.css', '1.0');
			wp_enqueue_style( 'themify-icons', HIRXPERT_ADDON_URL . 'assets/css/themify-icons.css', '1.0');
			wp_enqueue_script( 'magnific-popup', HIRXPERT_ADDON_URL . 'admin/extension/mega-menu/js/jquery.magnific-popup.min.js' , array( 'jquery' ), '1.1.0', true );
			wp_enqueue_script( 'hirxpert-megamenu', HIRXPERT_ADDON_URL . 'admin/extension/mega-menu/js/megamenu.js' , array( 'jquery' ), '1.0', true );

			$menu_icons = $this->hirxpert_menu_ti_icons();
			
			wp_localize_script( 'hirxpert-megamenu', 'hirxpert_object', array( 'icons' => $menu_icons ) );

			do_action( 'hirxpert_connect_fonts_css_menu_page' );

			add_action( 'admin_footer', array( $this, 'admin_footer_custom' ), 10 );
		}
	}

	public function admin_footer_custom(){
	?>
	<form id="hirxpert-general-settings-form" class="mfp-hide white-popup-block">
		<h1><?php esc_html_e( 'Hirxpert General Menu Item Settings', 'hirxpert-addon' ); ?></h1>
		<fieldset>			
			<p class="hirxpert-menu-icon-wrap">
				<label><?php esc_html_e( 'Choose Menu Item Icon', 'hirxpert-addon' ); ?></label>
				<select class="hirxpert-menu-icons">
					<option value=""><?php esc_html_e( 'None', 'hirxpert-addon' ); ?></option>
				</select>
			</p>
			<p class="hirxpert-megamenu-wrap">
				<label><?php esc_html_e( 'Enable Megamenu', 'hirxpert-addon' ); ?> <input type="checkbox" class="hirxpert-megamenu-option"></label>
			</p>
			<p class="hirxpert-megamenu-col-wrap">
				<label><?php esc_html_e( 'Megamenu Column', 'hirxpert-addon' ); ?></label>
				<select class="hirxpert-megamenu-col">
					<option value="12"><?php esc_html_e( '1/1', 'hirxpert-addon' ); ?></option>
					<option value="6"><?php esc_html_e( '1/2', 'hirxpert-addon' ); ?></option>
					<option value="4"><?php esc_html_e( '1/3', 'hirxpert-addon' ); ?></option>
					<option value="3"><?php esc_html_e( '1/4', 'hirxpert-addon' ); ?></option>
					<option value="2"><?php esc_html_e( '1/6', 'hirxpert-addon' ); ?></option>
				</select>
			</p>
			<p class="hirxpert-megamenu-widget-wrap">
				<label><?php esc_html_e( 'Megamenu Item Widget', 'hirxpert-addon' ); ?></label>
				<select class="hirxpert-megamenu-widget">
					<option value=""><?php esc_html_e( 'Choose Widget', 'hirxpert-addon' ); ?></option>
					<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { ?>
							<option value="<?php echo ucwords( $sidebar['id'] ); ?>">
							<?php echo ucwords( $sidebar['name'] ); ?>
							</option>
					<?php } ?>
				</select>
			</p>
		</fieldset>
	</form>
	<?php
	}

	public function hirxpert_menu_ti_icons(){
		$pattern = '/\.(ti-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
		$icon_css_path = HIRXPERT_ADDON_URL . 'assets/css/themify-icons.css';  
		$file = '';
		$response = wp_remote_get( $icon_css_path );
		if( is_array($response) ) {
			$file = $response['body']; // use the content
		}
		preg_match_all($pattern, $file, $str, PREG_SET_ORDER);
		return $str;
	}
	
	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function hirxpert_add_custom_nav_fields( $menu_item ) {
	
		$menu_item->hirxpertmenu = get_post_meta( $menu_item->ID, '_menu_item_hirxpertmenu', true );	
	    return $menu_item;
	    
	}
	
	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function hirxpert_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	
	    // Check if element is properly sent
		$opt_value = isset( $_REQUEST['menu-item-hirxpertmenu'][$menu_item_db_id] ) ? $_REQUEST['menu-item-hirxpertmenu'][$menu_item_db_id] : '' ;
		update_post_meta( $menu_item_db_id, '_menu_item_hirxpertmenu', $opt_value );
    
	}
	
	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0 
	 * @return      void
	*/
	function hirxpert_edit_walker($walker,$menu_id) {
	
	    require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/mega-menu/class-walker-nav-menu-edit.php' );
		return 'Hirxpert_Walker_Nav_Menu_Edit';
	    
	}
	
}
$hirxpert_cm = new Hirxpert_Custom_Menu();