<?php 

class Hirxpert_Mega_Menu {
	
	private static $_instance = null;
	
	public static $megamenu_stat = 0;

	public function __construct() {

		add_filter( 'nav_menu_item_title', array( $this, 'nav_menu_item_custom_title' ), 10, 4 );

        add_filter( 'nav_menu_css_class', array( $this, 'nav_menu_css_custom_class' ), 10, 4 );

        add_filter( 'nav_menu_submenu_css_class', array( $this, 'nav_menu_submenu_css_custom_class' ), 10, 3 );

        add_filter( 'walker_nav_menu_start_el', array( $this, 'walker_nav_menu_custom_start_el' ), 10, 4 );
		
	}
	
	public function nav_menu_item_custom_title( $title, $item, $args, $depth ){
        $t = get_post_meta( $item->ID, '_menu_item_hirxpertmenu', true ); $t = json_decode( $t, true );
        $menu_icon = isset( $t['icon'] ) ? $t['icon'] : '';
        if( $menu_icon ) return '<span class="menu-item-icon '. esc_attr( $menu_icon ) .'"></span>'. $title;
        return $title;
    }
    
    public function nav_menu_css_custom_class( $classes, $item, $args, $depth ){
        if ( 'mobile' !== $args->theme_location ) {
            $t = get_post_meta( $item->ID, '_menu_item_hirxpertmenu', true ); $t = json_decode( $t, true );
            if( $depth === 0 ){
                $megamenu = isset( $t['megamenu'] ) ? $t['megamenu'] : false;
                if( $megamenu ){
                    self::$megamenu_stat = 1;
                    $classes[] = 'menu-item-has-mega-children';
                }else{
                    self::$megamenu_stat = 0;
                }
            }if( $depth === 1 && self::$megamenu_stat == true ){
                $classes[] = isset( $t['megamenucol'] ) ? 'mega-menu-col col-' . $t['megamenucol'] : 'mega-menu-col col-12';
            }
        }
        return $classes;
    }
    
    public function nav_menu_submenu_css_custom_class( $classes, $args, $depth ){
        if ( 'mobile' !== $args->theme_location ) {
            if( $depth === 0 && self::$megamenu_stat == true ){
                $classes[] = 'mega-menu';
            }
        }	
        return $classes;
    }

    public function walker_nav_menu_custom_start_el( $item_output, $item, $depth, $args ){
        if ( 'mobile' !== $args->theme_location ) {
            if( $depth === 2 && self::$megamenu_stat == true ){
                $t = get_post_meta( $item->ID, '_menu_item_hirxpertmenu', true ); $t = json_decode( $t, true );
                $mega_widget = isset( $t['megamenuwidget'] ) ? $t['megamenuwidget'] : '';
                if( $mega_widget ){
                    ob_start();
                    dynamic_sidebar( $mega_widget );
                    $sidebar = ob_get_clean();
                    $item_output  = $args->before;
                    $item_output .= $sidebar;
                    $item_output .= $args->after;
                }
            }
        }
        return $item_output;
    }
	
	/**
	 * Creates and returns an instance of the class
	 * @since 1.0.0
	 * @access public
	 * return object
	 */
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

} Hirxpert_Mega_Menu::get_instance();


