<?php 

class ZOZO_Header_Footer_Base {
	
	private static $header_id = null;
	
	private static $footer_id = null;
	
	public static function get_header_id(){
		return self::$header_id;
	}
	
	public static function get_footer_id(){
		return self::$footer_id;
	}
	
	public static function zhf_header_enabled() {
			
		$header_id = self::get_settings( 'type_header', '' );
		self::$header_id = $header_id;
		
		$status    = false;

		if ( '' !== $header_id ) {
			$status = true;
		}

		return apply_filters( 'zhf_header_enabled', $status );
	}
	
	public static function zhf_footer_enabled() {
			
		$footer_id = self::get_settings( 'type_footer', '' );
		self::$footer_id = $footer_id;
		
		$status    = false;

		if ( '' !== $footer_id ) {
			$status = true;
		}

		return apply_filters( 'zhf_footer_enabled', $status );
	}
	
	public function override_header() {
		require ZOZO_HF_CORE_DIR . 'themes/default/zhf-header.php';
		$templates   = [];
		$templates[] = 'header.php';
		// Avoid running wp_head hooks again.
		remove_all_actions( 'wp_head' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}
	
	public function override_footer() {
		require ZOZO_HF_CORE_DIR . 'themes/default/zhf-footer.php';
		$templates   = [];
		$templates[] = 'footer.php';
		// Avoid running wp_footer hooks again.
		remove_all_actions( 'wp_footer' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}
	
	public static function get_settings( $setting = '' ) {
		if ( 'type_header' == $setting || 'type_footer' == $setting ) {
			$templates = self::get_template_id( $setting );

			$template = ! is_array( $templates ) ? $templates : $templates[0];
			
			$template = apply_filters( "zhf_get_settings_{$setting}", $template );
			return $template;
		}
	}
	
	public static function get_template_id( $type ) {
		$option = [
			'location'  => 'zhf_target_include_locations',
			'exclusion' => 'zhf_target_exclude_locations',
			'users'     => 'zhf_target_user_roles',
		];
		
		require_once( ZOZO_HF_CORE_DIR . 'admin/target-rule/class-zozo-target-rules-fields.php' );
		$zhf_templates = Zozo_Target_Rules_Fields::get_instance()->get_posts_by_conditions( 'zozo-hf', $option );
		foreach ( $zhf_templates as $template ) {
			if ( get_post_meta( absint( $template['id'] ), 'zhf_template_type', true ) === $type ) {
				return $template['id'];
			}
		}

		return '';
	}
	
	public static function zhf_get_current_theme(){
		$current_theme = wp_get_theme();
		if( $current_theme->exists() && $current_theme->parent() ){
			$current_theme = $current_theme->parent();
		}
		return $current_theme->get( 'TextDomain' );
	}
	
}

/**
 * Zozo Header Footer Render Class
 *
 * @since 1.0.0
 */
class ZOZO_Header_Footer_Render extends ZOZO_Header_Footer_Base {

	private static $_instance = null;	
	
	private static $elementor_instance = null;	

	public function __construct() {

		// initiate plugin things
		$this->init();

	}

	public function init() {
		
		$is_elementor_callable = ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) ? true : false;

		if ( $is_elementor_callable ) {
			self::$elementor_instance = Elementor\Plugin::instance();
			add_action( 'wp', [ $this, 'hooks' ] );
		}
		
	}	
	
	public function hooks(){
		
		$theme_slug = self::zhf_get_current_theme();
		$supported_themes = ZOZO_Header_Footer::$supported_themes;
		
		if ( self::zhf_header_enabled() ) {	
			if ( 'elementor_canvas' == get_page_template_slug() ) {
				add_action( 'elementor/page_templates/canvas/before_content', [ $this, 'zhf_render_header' ] );
			}else{
				if( in_array( $theme_slug, $supported_themes ) ){
					remove_action( $theme_slug.'_header', $theme_slug.'_desktop_header', 10 );
					add_action( $theme_slug.'_header', [ $this, 'zhf_render_header' ], 10 );
				}else{				
					// remove exisiting header actions
					add_action( 'get_header', [ $this, 'override_header' ] );
					// render custom header
					add_action( 'zhf_header', [ $this, 'zhf_render_header' ] );
				}
			}
		}
		
		if ( self::zhf_footer_enabled() ) {
			if ( 'elementor_canvas' == get_page_template_slug() ) {
				add_action( 'elementor/page_templates/canvas/after_content', [ $this, 'zhf_render_footer' ] );
			}else{
				if( in_array( $theme_slug, $supported_themes ) ){
					remove_action( $theme_slug.'_footer', $theme_slug.'_site_footer', 10 );
					add_action( $theme_slug.'_footer', [ $this, 'zhf_render_footer' ], 10 );
				}else{	
					// remove exisiting footer actions
					add_action( 'get_footer', [ $this, 'override_footer' ] );
					// render custom footer
					add_action( 'zhf_footer', [ $this, 'zhf_render_footer' ] );
				}
			}
		}
		
	}	
	
	function zhf_render_header() {
		if ( false == apply_filters( 'enable_zhf_render_header', true ) ) {
			return;
		}
		$header_id = self::get_header_id();
		?>
			<header>
				<?php echo self::$elementor_instance->frontend->get_builder_content_for_display( $header_id ); ?>
			</header>

		<?php

	}
	
	function zhf_render_footer() {
		if ( false == apply_filters( 'enable_zhf_render_footer', true ) ) {
			return;
		}
		$footer_id = self::get_footer_id();
		?>
			<footer>
				<?php echo self::$elementor_instance->frontend->get_builder_content_for_display( $footer_id ); ?>
			</footer>

		<?php

	}
	
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

}
ZOZO_Header_Footer_Render::instance();