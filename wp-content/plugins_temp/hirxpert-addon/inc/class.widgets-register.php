<?php 

class Hirxpert_Widget_Register {
	
	private static $_instance = null;

    public static $widget_args = null;
	
	public function __construct() {

		// Arguments used in all register_sidebar() calls.
        self::$widget_args = array(
            'before_title'  => '<h3 class="widget-title subheading heading-size-3">',
            'after_title'   => '</h3>',
            'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
            'after_widget'  => '</div></div>',
        );

        $this->hirxpert_register_sidebars();
		
        $this->hirxpert_custom_sidebar_register();

        add_action( 'hirxpert_footer_top', array( $this, 'hirxpert_insta_footer' ), 10 );

	}

    public function hirxpert_register_sidebars(){
        // Footer Top
        register_sidebar(
            array_merge(
                self::$widget_args,
                array(
                    'name'        => esc_html__( 'Footer Top', 'hirxpert-addon' ),
                    'id'          => 'insta-footer',
                    'description' => esc_html__( 'Widgets in this area will be displayed in the top of footer.', 'hirxpert-addon' ),
                )
            )
        );
    }

    public function hirxpert_custom_sidebar_register(){
        // Custom Sidebars / Core Functions
        $sidebars = get_option( 'hirxpert_custom_sidebars' );
        if( !empty( $sidebars ) && is_array( $sidebars ) ){
            foreach( $sidebars as $sidebar_slug => $sidebar_name ){
                register_sidebar(
                    array_merge(
                        self::$widget_args,
                        array(
                            'name'        => esc_html( $sidebar_name ),
                            'id'          => esc_attr( $sidebar_slug )
                        )
                    )
                );
            }
        }
    }

    public function hirxpert_insta_footer(){
        if( is_active_sidebar( 'insta-footer' ) ):
            $keys = array(
                'chk' => 'insta-footer-chk',
                'fields' => array(
                    'insta_footer_layout' => 'insta-footer-layout'
                )			
            );
            $footer_top_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $keys );
            $footer_top_class = isset( $footer_top_values['insta_footer_layout'] ) && $footer_top_values['insta_footer_layout'] == 'boxed' ? 'container' : 'container-fluid p-0';
    ?>
        <div class="insta-footer-wrap">
	        <div class="<?php echo esc_attr( $footer_top_class ); ?>">
                <div class="row">
                    <aside class="footer-insta-widget col-12">
                        <?php dynamic_sidebar( 'insta-footer' ); ?>
                    </aside>
                </div>
            </div>
        </div>
    <?php
        endif;
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

} Hirxpert_Widget_Register::get_instance();


