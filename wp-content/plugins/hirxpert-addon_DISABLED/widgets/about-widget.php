<?php
class Hirxpert_About_Widget extends WP_Widget {
	/**
	 * Widget setup.
	 */
	public function __construct() {
		$widget_ops = array( 'classname' => 'zozo_about_widget', 'description' => esc_html__('A widget that displays an About widget', 'hirxpert-addon') );
		$control_ops = array('id_base' => 'zozo_about_widget' );
		parent::__construct( 'zozo_about_widget', esc_html__('Hirxpert About Me', 'hirxpert-addon'), $widget_ops, $control_ops );
	}
	/**
	 * How to display the widget on the screen.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$image = $instance['image'];
		$round = isset( $instance['round'] ) ? $instance['round'] : false;
		$description = $instance['description'];
		$sign_image = $instance['sign_image'];
		$image = $instance['image'];
		$author_url = $instance['author_url'];
		$readmore_text = $instance['readmore_text'];
		
		/* Before widget (defined by themes). */
		echo wp_kses_post( $before_widget );
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo ( $title != '' ? wp_kses_post( $before_title . $title . $after_title ) : '' );
		?>
			
			<div class="about-widget widget-content">
			
			<?php if($image) : ?>
			<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_html($title); ?>" class="img-fluid mx-auto d-block<?php if( $round ) echo esc_attr( ' rounded-circle' ); ?>" />
			<?php endif; ?>
			
			<?php if($description) : ?>
			<div class="about-description"><?php echo wp_kses_post($description); ?></div>
			<?php endif; ?>	  
			
			<?php if($sign_image) : ?>
			<img src="<?php echo esc_url($sign_image); ?>" alt="<?php echo esc_html($title); ?>" class="img-fluid mx-auto d-block sign-image" />
			<?php endif; ?> 
			
			<?php if($author_url) : ?>
			<div class="author-url"><a href="<?php echo esc_url( $author_url ); ?>"> <?php echo esc_html($readmore_text); ?></a></div>
			<?php endif; ?>	
			
			</div>
			
		<?php
		/* After widget (defined by themes). */
		echo wp_kses_post( $after_widget );
	}
	/**
	 * Update the widget settings.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['image'] = esc_url( $new_instance['image'] );
		$instance['round'] = isset( $new_instance['round'] ) ? (bool) $new_instance['round'] : false;
		$instance['description'] = wp_kses_post( $new_instance['description'] );
		$instance['sign_image'] = esc_url( $new_instance['sign_image'] );
		$instance['author_url'] = wp_kses_post( $new_instance['author_url'] ); 
		$instance['readmore_text'] = wp_kses_post( $new_instance['readmore_text'] ); 
		return $instance;
	}
	public function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'image' => '', 'round' => false, 'description' => '','sign_image' => '', 'author_url' => '', 'readmore_text' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'hirxpert-addon'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:96%;" type="text" />
		</p>
		
		<!-- image url -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"><?php esc_html_e('Image URL:', 'hirxpert-addon'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>" value="<?php echo esc_url( $instance['image'] ); ?>" style="width:96%;" type="text" /><br />
		</p>
		
		<!-- round image -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'round' ) ); ?>"><?php esc_html_e('Make image a circle:', 'hirxpert-addon'); ?></label>
			<input type="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'round' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'round' ) ); ?>" <?php checked( (bool) $instance['round'], true ); ?> />
			<br><small><?php esc_html_e('For a perfect circle your image need to have the same height and width. For example: 260x260', 'hirxpert-addon'); ?></small>
		</p>
		
		<!-- description -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e('About me text:', 'hirxpert-addon'); ?></label>
			<textarea id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" style="width:95%;" rows="6"><?php echo esc_textarea( $instance['description'] ); ?></textarea>
		</p>
		
		
		<!-- Signature Image-->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'sign_image' ) ); ?>"><?php esc_html_e('Signature Image URL:', 'hirxpert-addon'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'sign_image' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sign_image' ) ); ?>" value="<?php echo esc_url( $instance['sign_image'] ); ?>" style="width:96%;" type="text" /><br />
		</p>
		
		<!-- Authorurl -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'author_url' ) ); ?>"><?php esc_html_e('Author Url:', 'hirxpert-addon'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'author_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'author_url' ) ); ?>" value="<?php echo esc_attr( $instance['author_url'] ); ?>" style="width:96%;" type="text" />
		</p>
		
		<!-- link Text -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'readmore_text' ) ); ?>"><?php esc_html_e('Read More Text:', 'hirxpert-addon'); ?></label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'readmore_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'readmore_text' ) ); ?>" value="<?php echo esc_attr( $instance['readmore_text'] ); ?>" style="width:96%;" type="text" />
		</p>
		
	<?php
	}
}
?>