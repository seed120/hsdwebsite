<?php 

namespace Elementor;

/**
 * CEA Post Types Extension Class
 *
 * @since 1.0.0
 */
final class CEA_Post_Types_Extension {

	private static $_instance = null;
	
	private static $shortcodes_list = array();
	 
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	public function __construct() {
		
		//Call Classic Elementor Addons Shortcode and Scripts
		$this->init();
		
		//Shortcode enable/disable option hook
		add_action( 'cea_pt_shortcodes_enable', array( $this, 'cea_pt_shortcodes_widgets' ), 10 );
		
		//Post type config hook
		add_action( 'cea_post_type_config', array( $this, 'cea_post_type_plugin_options' ) );

	}

	public function init() {
		
		//Call elementor custom addons
		$this->cea_set_shortcodes();
		
		//Metabox
		if( !defined( 'CEA_METABOXES_DIR' ) ) {
			require_once( CEA_CORE_DIR . 'admin/metabox-settings/meta_box.php' );
		}
		require_once( CEA_PT_CORE_DIR . 'admin/metabox/metabox-config.php' );
		
		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );

	}
	
	public static function cea_post_type_plugin_options(){
		$cea_shortcodes = get_option('cea_shortcodes');
		if( isset( $cea_shortcodes['portfolio'] ) && $cea_shortcodes['portfolio'] == 'on' ){
			require_once( CEA_PT_CORE_DIR . 'admin/config/cea-portfolio-config.php' );
		}
		if( isset( $cea_shortcodes['service'] ) && $cea_shortcodes['service'] == 'on' ){
			require_once( CEA_PT_CORE_DIR . 'admin/config/cea-service-config.php' );
		}
		if( isset( $cea_shortcodes['event'] ) && $cea_shortcodes['event'] == 'on' ){
			require_once( CEA_PT_CORE_DIR . 'admin/config/cea-event-config.php' );
		}
		if( isset( $cea_shortcodes['team'] ) && $cea_shortcodes['team'] == 'on' ){
			require_once( CEA_PT_CORE_DIR . 'admin/config/cea-team-config.php' );
		}
		if( isset( $cea_shortcodes['testimonial'] ) && $cea_shortcodes['testimonial'] == 'on' ){
			require_once( CEA_PT_CORE_DIR . 'admin/config/cea-testimonial-config.php' );
		}
	}
	
	public static function cea_pt_shortcodes_widgets(){
	?>
		<div class="row">
			<div class="col-12">
				<div class="admin-box cea-main-box text-center">
					<h3><?php esc_html_e( 'Enable/Disable CEA post types widget here.', 'cea-post-types' ); ?></h3>
				</div><!-- .admin-box -->
			</div><!-- .col -->
		</div><!-- .row -->
	<?php		
		
		$shortcode_stat = self::$shortcodes_list;
		$cea_shortcodes = get_option('cea_shortcodes');
		$row = 1;
		foreach( $shortcode_stat as $key => $value ){
			$saved_val = 'on';
			$shortcode_name = str_replace( "-", "_", $key );
			if( isset( $cea_shortcodes[$shortcode_name] ) ){ 
			// if( !empty( $cea_shortcodes ) ){
					$saved_val = 'on';
				}else{
					$saved_val = 'off';
				}
			// }
			$checked_stat = $saved_val == 'on' ? 'checked="checked"' : 'off';
		
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
									<a class="docs-links-url" href="https://docs.zozothemes.com/cea/' . esc_attr( $shortcode_name = str_replace( "_", "-", $shortcode_name) ) . '/" target="_blank"><span class="dashicons dashicons-media-document"><span class="how-it-works">Read More</span></a>
								</div><!-- .docs-links -->
						</div><!-- .element-group-inner -->
					</div><!-- .element-group --> 
				</div><!-- .col -->';
							
			if( $row % 4 == 0 ) echo '</div><!-- .row -->';
			$row++;
		}
		
		if( $row % 4 != 1 ) echo '</div><!-- .cea-row unexpceted close -->';
	}
	
	public function cea_set_shortcodes(){
	
		$shortcode_stat = array(		
			'portfolio' 		=> esc_html__( 'Elementor Portfolio Widget', 'cea-post-types' ),
			'service' 			=> esc_html__( 'Elementor Service Widget', 'cea-post-types' ),
			'event' 			=> esc_html__( 'Elementor Event Widget', 'cea-post-types' ),		
			'team' 				=> esc_html__( 'Elementor Team Widget', 'cea-post-types' ),				
			'testimonial' 		=> esc_html__( 'Elementor Testimonial Widget', 'cea-post-types' )				
		);
				
		self::$shortcodes_list = $shortcode_stat;
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets( $widgets_manager ) {

		$shortcode_stat = self::$shortcodes_list;
		$cea_shortcodes = get_option('cea_shortcodes');
		
		$shortcode_emty_stat = false;
		if( empty( $cea_shortcodes ) ){
			$cea_shortcodes = $shortcode_stat;
			$shortcode_emty_stat = true;
		}
		
		foreach( $shortcode_stat as $key => $value ){
			
			$shortcode_name = !$shortcode_emty_stat ? str_replace( "-", "_", $key ) : $key;
			
			if( !empty( $cea_shortcodes ) ){
				if( isset( $cea_shortcodes[$shortcode_name] ) && $cea_shortcodes[$shortcode_name] == 'on' ){
					$saved_val = true;
				}else{
					$saved_val = false;
				}
			}else{
				$saved_val = true;
			}
			
			if( $saved_val ){
				
				require_once( CEA_PT_CORE_DIR . 'widgets/'. esc_attr( $key ) .'.php' );
				
				switch( $key ){
					case 'portfolio': $widgets_manager->register( new CEA_Elementor_Portfolio_Widget() );  break;
					case 'service': $widgets_manager->register( new CEA_Elementor_Service_Widget() );  break;
					case 'event': $widgets_manager->register( new CEA_Elementor_Event_Widget() );  break;
					case 'team': $widgets_manager->register( new CEA_Elementor_Team_Widget() );  break;
					case 'testimonial': $widgets_manager->register( new CEA_Elementor_Testimonial_Widget() );  break;					
				}
			}
		}
	}
}
CEA_Post_Types_Extension::instance();