<?php
class Hirxpert_Author_Widget extends WP_Widget {
	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'zozo_author_widget', 'description' => esc_html__('A widget that displays authors details.', 'hirxpert-addon') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'zozo_author_widget' );
		/* Create the widget. */
		parent::__construct( 'zozo_author_widget', esc_html__('Hirxpert Author', 'hirxpert-addon'), $widget_ops, $control_ops );
	}
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$listby = esc_sql($instance['listby']);
		$filter_by = esc_sql($instance['filter_by']);
		$number = esc_attr($instance['number']);
		
		/* Before widget (defined by themes). */
		echo wp_kses_post( $before_widget );
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo ( $title != '' ? wp_kses_post( $before_title . $title . $after_title ) : '' );
		?>
			<div class="widget-content">
				<ul class="side-newsfeed">
				
				<?php 
					$orderby = $order = '';
					if( $listby == 'post' ){
						$orderby = 'post_count';
						$order = 'DESC';
					}
					$filter = $filter_by != '' ? explode( ',', $filter_by ) : 'administrator';
					$user_query = array(
						'role__in'		=> $filter,
						'orderby'		=> $orderby,
						'order'			=> $order,
						'number'		=> $number,
						'show_fullname'	=> '1',
						'optioncount'	=> '1'
					);
					$out = '';
					global $wpdb;
					$blogusers = get_users( $user_query );
					// Array of WP_User objects.
					foreach ( $blogusers as $user ) {
						$author_link = get_author_posts_url( $user->ID );
						$author_url = get_the_author_meta('url', $user->ID );
						$where = 'WHERE comment_approved = 1 AND user_id = ' . $user->ID;
						$comment_count = $wpdb->get_var("SELECT COUNT( * ) AS total	FROM {$wpdb->comments} {$where}");
					
						$out .= '<li class="clearfix media">
							<div class="author-img d-flex me-3">
								'. get_avatar( $user->ID, 70 ) .'
							</div>
							<div class="author-meta media-body">
								<h6 class="author-name"><a href="'. esc_url( $author_link ) .'" rel="bookmark">'. esc_html( $user->display_name ) .'</a></h6>
								<p class="author-counts"><span><a href="'. esc_url( $author_link ) .'" rel="bookmark">' . count_user_posts( $user->ID ) .' '. esc_html__('Posts', 'hirxpert-addon') .'</a></span><span>'. $comment_count .' '. esc_html__('Comments', 'hirxpert-addon') .'</span></p>
								<p class="author-url"><em><a href="'. esc_url( $author_url ) .'" rel="bookmark">'. esc_url( $author_url ) .'</a></em></p>
							</div>
						</li>';
					}
					echo ( $out );
				?>		
				</ul>
			</div>
			
		<?php
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
		$instance['listby'] = sanitize_text_field( $new_instance['listby'] ); 
		$instance['filter_by'] = sanitize_text_field( $new_instance['filter_by'] );
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
	}
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'listby' => '', 'filter_by' => '', 'number' => 5);
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'hirxpert-addon'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>
		
		<!-- Category -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id('listby') ); ?>"><?php esc_html_e('List by:', 'hirxpert-addon') ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('listby') ); ?>" name="<?php echo esc_attr( $this->get_field_name('listby') ); ?>" class="widefat categories" style="width:100%;">
			<option value='default' <?php if ('default' == $instance['listby']) echo 'selected="selected"'; ?>><?php esc_html_e('Default', 'hirxpert-addon') ?></option>
			<option value='post' <?php if ('post' == $instance['listby']) echo 'selected="selected"'; ?>><?php esc_html_e('No.of Post', 'hirxpert-addon') ?></option>
		</select>
		</p>
		
		<!-- Filter by -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'filter_by' ) ); ?>"><?php esc_html_e('Filter by:', 'hirxpert-addon'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'filter_by' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'filter_by' ) ); ?>" value="<?php echo esc_attr( $instance['filter_by'] ); ?>"  />
			<br><small><?php esc_html_e('Filter by - separate by comma(,) eg: administrator,author,editor,subscriber', 'hirxpert-addon'); ?></small>
		</p>
		
		<!-- Number of posts -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e('Number of author to show:', 'hirxpert-addon'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $number ); ?>" size="3" />
		</p>
	<?php
	}
}
?>