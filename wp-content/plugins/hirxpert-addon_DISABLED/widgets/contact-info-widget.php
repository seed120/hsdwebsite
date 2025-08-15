<?php
class Hirxpert_Contact_Infos_Widget extends WP_Widget {
	/**
	 * Widget setup.
	 */
	function __construct() {
		
		//add_action( 'admin_enqueue_scripts', array( $this, 'Hirxpert_Contact_Infos_Widget_script' ) );
		add_action( 'load-widgets.php', array( &$this, 'Hirxpert_Contact_Infos_Widget_script' ) );
		
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'hirxpert_contact_info_widget', 'description' => esc_html__('A widget that displays an About widget', 'hirxpert-addon') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'hirxpert_contact_info_widget' );
		parent::__construct( 'hirxpert_contact_info_widget', esc_html__('Hirxpert Contact Info', 'hirxpert-addon'), $widget_ops, $control_ops );
		
	}
	
	function Hirxpert_Contact_Infos_Widget_script(){
		wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
	}
	
	public function hirxpert_shortcode_rand_id(){
		static $widget_rand_id = 1;
		return $widget_rand_id++;
	}
	
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$ctext = $instance['ctext'];
		$caddress = $instance['caddress'];
		$cphone = $instance['cphone'];
		$cmail = $instance['cmail'];
		$font_color = $instance['font_color'];
		$cfshortcode = $instance['cfshortcode'];	
		$background_color = $instance['background_color'];
		$background_img = $instance['background_img'];
		
		// This is custom css options for main shortcode warpper
		$shortcode_css = '';
		$shortcode_rand_id = $rand_class = 'shortcode-rand-' . $this->hirxpert_shortcode_rand_id();
		
		$class = '';
		if( $font_color ){
			$shortcode_css = '.' . esc_attr( $rand_class ) . '.contact-widget-wrap, .' . esc_attr( $rand_class ) . '.contact-widget-wrap a, .' . esc_attr( $rand_class ) . '.contact-widget-wrap .widget-title { color: '. esc_attr( $font_color ) .'; }';
		}
		if( $background_color ){
			$class = ' contact-widget-bg-activated';
			$shortcode_css .= '.' . esc_attr( $rand_class ) . '.contact-widget-wrap { background-color: '. esc_attr( $background_color ) .'; }';
		}
		if( $background_img ){
			$class = ' contact-widget-bg-activated';
			$shortcode_css .= '.' . esc_attr( $rand_class ) . '.contact-widget-wrap { background-image: url('. esc_attr( $background_img ) .'); }';
		}
		
		
		if( $shortcode_css ) $class .= ' ' . $shortcode_rand_id . ' hirxpert-inline-css';
		
		/* Before widget (defined by themes). */
		echo wp_kses_post( $before_widget );
		
		echo '<div class="contact-widget-wrap'. esc_attr( $class ) .'" data-css="'. htmlspecialchars( json_encode( $shortcode_css ), ENT_QUOTES, 'UTF-8' ) .'">';
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo ( $title != '' ? wp_kses_post( $before_title . $title . $after_title ) : '' );
		
			
		?>
			
			<div class="contact-widget widget-content">
			
				<?php if($ctext) : ?>
				<p class="contact-text"><?php echo wp_kses_post($ctext); ?></p>
				<?php endif; ?>	
				
				<?php if( $caddress || $cphone || $cmail ) : ?>
				<div class="contact-widget-info">
					<?php if($caddress) : ?>
					<p class="contact-address"><span class="bi bi-geo-alt"></span><span><?php echo wp_kses_post($caddress); ?></span></p>
					<?php endif; ?>	
					
					<?php if($cphone) : ?>
					<p class="contact-phone"><span class="bi bi-headset"></span><span><a href="tel:<?php echo preg_replace('/\s+/', '', $cphone); ?>"><?php echo esc_html($cphone); ?></a></span></p>
					<?php endif; ?>	
					
					<?php if($cmail) : ?>
					<p class="contact-email"><span class="bi bi-envelope"></span><span><a href="mailto:<?php echo esc_attr($cmail); ?>"><?php echo esc_html($cmail); ?></a></span></p>
					<?php endif; ?>	
				</div><!-- .contact-widget-info -->
				<?php endif; ?>	
				
				<?php if( $cfshortcode ) : ?>
				<div class="contact-info-shortcode">
					<?php echo do_shortcode( $cfshortcode ) ?>
				</div>
				<?php endif; ?>
			
			</div>
			
		<?php
		echo '</div><!-- .contact-widget-wrap -->';
		/* After widget (defined by themes). */
		echo wp_kses_post( $after_widget );
	}
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['ctext'] = wp_kses_post( $new_instance['ctext'] );
		$instance['caddress'] = wp_kses_post( $new_instance['caddress'] );
		$instance['cphone'] = sanitize_text_field( $new_instance['cphone'] );
		$instance['cmail'] = is_email( $new_instance['cmail'] );
		$instance['font_color'] = sanitize_text_field( $new_instance['font_color'] );
		$instance['cfshortcode'] = wp_kses_post( $new_instance['cfshortcode'] );
		$instance['background_color'] = sanitize_text_field( $new_instance['background_color'] );
		$instance['background_img'] = sanitize_text_field( $new_instance['background_img'] );
		return $instance;
	}
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => esc_html__( 'Contact Info', 'hirxpert-addon' ), 'ctext' => '', 'caddress' => '', 'cphone' => '', 'cmail' => '', 'font_color' => '', 'cfshortcode' => '', 'background_color' => '', 'background_img' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		
		<script type='text/javascript'>
		(function($){
			
			var parent = $('body');
			if ($('body').hasClass('widgets-php')){
				parent = $('.widget-liquid-right');
			}
			jQuery(document).ready(function($) {
				parent.find('.widget-bg-color-picker, .widget-cf-color-picker').wpColorPicker();
			});
			
			jQuery(document).on('widget-added', function(e, widget){
				widget.find('.widget-bg-color-picker, .widget-cf-color-picker').wpColorPicker();
			});
			
			jQuery(document).on('widget-updated', function(e, widget){
				widget.find('.widget-bg-color-picker, .widget-cf-color-picker').wpColorPicker();
			});
			
		})(jQuery);
        </script>
		
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:96%;" type="text" />
		</p>
		
		<!-- Contact Text Message -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ctext' ) ); ?>"><?php esc_html_e( 'Text Message', 'hirxpert-addon' ); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'ctext' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ctext' ) ); ?>" style="width:96%;" type="text" rows="6"><?php echo esc_textarea( $instance['ctext'] ); ?></textarea>
		</p>
		
		<!-- Address -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'caddress' ) ); ?>"><?php esc_html_e( 'Address', 'hirxpert-addon' ); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'caddress' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'caddress' ) ); ?>" style="width:96%;" type="text" rows="6"><?php echo esc_textarea( $instance['caddress'] ); ?></textarea>
		</p>
		
		<!-- Phone Numbers -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cphone' ) ); ?>"><?php esc_html_e( 'Phone Numbers', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'cphone' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cphone' ) ); ?>" value="<?php echo esc_attr( $instance['cphone'] ); ?>" style="width:96%;" type="text" />
		</p>
		
		<!-- Email -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cmail' ) ); ?>"><?php esc_html_e( 'Email', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'cmail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cmail' ) ); ?>" value="<?php echo esc_attr( $instance['cmail'] ); ?>" style="width:96%;" type="text" />
		</p>
		
		<!-- Shortcode -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'cfshortcode' ) ); ?>"><?php esc_html_e( 'Contact Form Shortcode', 'hirxpert-addon' ); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'cfshortcode' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'cfshortcode' ) ); ?>"style="width:96%;"><?php echo wp_kses_post( $instance['cfshortcode'] ); ?></textarea>
		</p>
		
		<!-- Font Color -->		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'font_color' ) ); ?>"><?php esc_html_e( 'Font Color', 'hirxpert-addon' ); ?></label>
			<input class="widget-cf-color-picker" type="text" id="<?php echo $this->get_field_id( 'font_color' ); ?>" name="<?php echo $this->get_field_name( 'font_color' ); ?>" value="<?php echo esc_attr( $instance['font_color'] ); ?>" />  
		</p>
		
		<!-- Background Color -->
		<p>
            <label for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php _e( 'Background Color', 'hirxpert-addon' ); ?></label>
            <span><?php _e( 'Choose widget background color', 'hirxpert-addon' ); ?></span>
            <input class="widget-bg-color-picker" type="text" id="<?php echo $this->get_field_id( 'background_color' ); ?>" name="<?php echo $this->get_field_name( 'background_color' ); ?>" value="<?php echo esc_attr( $instance['background_color'] ); ?>" />                            
        </p>
		
		<!-- Background Image -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'background_img' ) ); ?>"><?php esc_html_e( 'Background Image', 'hirxpert-addon' ); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'background_img' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'background_img' ) ); ?>" value="<?php echo esc_attr( $instance['background_img'] ); ?>" style="width:96%;" type="text" />
		</p>
	<?php
	}
}
?>