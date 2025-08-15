<?php
class hirxpert_latest_post_widget extends WP_Widget {
	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'hirxpert_latest_post_widget', 'description' => esc_html__( 'A widget that displays your latest posts from all categories or a certain', 'hirxpert-addon' ) );
		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'hirxpert_latest_post_widget' );
		/* Create the widget. */
		parent::__construct( 'hirxpert_latest_post_widget', esc_html__( 'Hirxpert Latest Posts', 'hirxpert-addon' ), $widget_ops, $control_ops );
	}
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$categories = $instance['categories'];
		$number = $instance['number'];
		
		$query = array('showposts' => $number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $categories);
		
		$loop = new WP_Query($query);
		if ($loop->have_posts()) :
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
			<div class="widg-content">
				<ul class="side-newsfeed">
				
				<?php  while ($loop->have_posts()) : $loop->the_post(); ?>
					<?php 
						$format = get_post_format( get_the_ID() );
					?>
					<li>					
						<div class="side-item">
							<div class="side-image">
							<?php if( $format == "quote" || $format == "link" ) : ?>
								<a href="<?php echo get_permalink(); ?>" rel="bookmark"><div class="side-noimg themebg-color"><span class="<?php echo $format == "quote" ? 'bi bi-quote' : 'bi bi-link-45deg' ;?>"></span></div></a>
							<?php elseif (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : ?>
								<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?></a>
							<?php endif; ?>
							</div>
							<div class="side-item-text">
								<a class="themeh-color" href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
								<div class="comments-wrap">
									<div class="meta-left">
										<span class=""><?php the_time( get_option('date_format') ); ?></span>										
									</div>									
								</div>
							</div>
						</div>					
					</li>
				
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
				<?php endif; ?>
				
				</ul>
			</div>
			
		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['number'] = strip_tags( $new_instance['number'] );
		return $instance;
	}
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => esc_html__('Latest Posts', 'hirxpert'), 'number' => 5, 'categories' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e('Title:', 'hirxpert'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
		</p>
		
		<!-- Category -->
		<p>
		<label for="<?php echo $this->get_field_id('categories'); ?>"><?php esc_html_e('Filter by Category:', 'hirxpert'); ?></label> 
		<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
			<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php esc_html_e('All categories', 'hirxpert'); ?></option>
			<?php $categories = get_categories('hide_empty=1&depth=1&type=post'); ?>
			<?php foreach($categories as $category) { ?>
			<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
			<?php } ?>
		</select>
		</p>
		
		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e('Number of posts to show:', 'hirxpert'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" size="3" />
		</p>
	<?php
	}
}
?>