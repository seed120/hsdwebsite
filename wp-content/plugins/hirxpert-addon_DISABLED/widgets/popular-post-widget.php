<?php
class Hirxpert_Popular_Post_Widget extends WP_Widget {
	/**
	 * Widget setup.
	 */
	function __construct() {
		
		$widget_ops = array(
			'classname'                   => 'widget_block hirxpert_popular_post_widget',
			'description'                 => esc_html__( 'A widget that displays your popular posts from all categories or a certain', 'hirxpert-addon' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'hirxpert-popular-post', esc_html__( 'Hirxpert Popular Posts', 'hirxpert-addon' ), $widget_ops );
		$this->alt_option_name = 'widget_popular_entries';
	}
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		/* Our variables from the widget settings. */
		$default_title = esc_html__( 'Popular Posts', 'hirxpert-addon' );
		$title         = ! empty( $instance['title'] ) ? $instance['title'] : $default_title;
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$categories = $instance['categories'];
		$pnumber = $instance['pnumber'];
		
		$query = array( 'posts_per_page' => $pnumber ? $pnumber : 6, 'ignore_sticky_posts' => 1, 'orderby' => 'comment_count', 'order' => 'DESC', 'cat' => $categories );		
		
		$loop = new WP_Query($query);
		if ($loop->have_posts()) :
		
		/* Before widget (defined by themes). */
		echo $before_widget;
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
		?>
			<div class="widget-content">
				<ul class="post-ul">
				
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
								<a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail('thumbnail', array('class' => 'img-fluid')); ?></a>
							<?php endif; ?>
							</div>
							<div class="side-item-text">
								<a class="themeh-color" href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
								<p class="side-item-meta"><span><?php the_time( get_option('date_format') ); ?></span></p>
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
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['categories'] = $new_instance['categories'];
		$instance['pnumber'] = strip_tags( $new_instance['pnumber'] );
		return $instance;
	}

	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => esc_html__( 'Popular Posts', 'hirxpert-addon' ), 'pnumber' => 5, 'categories' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo esc_html__('Title:', 'hirxpert'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  />
		</p>
		
		<!-- Category -->
		<p>
		<label for="<?php echo $this->get_field_id('categories'); ?>"><?php echo esc_html__( 'Filter by Category:', 'hirxpert-addon' ); ?></label> 
		<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
			<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>><?php echo esc_html__( 'All categories', 'hirxpert-addon' ); ?></option>
			<?php $categories = get_categories('hide_empty=1&depth=1&type=post'); ?>
			<?php foreach($categories as $category) { ?>
			<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
			<?php } ?>
		</select>
		</p>
		
		<!-- Number of posts -->
		<p>
			<label for="<?php echo $this->get_field_id( 'pnumber' ); ?>"><?php echo esc_html__('Number of posts to show:', 'hirxpert'); ?></label>
			<input  type="text" class="widefat" id="<?php echo $this->get_field_id( 'pnumber' ); ?>" name="<?php echo $this->get_field_name( 'pnumber' ); ?>" value="<?php echo $instance['pnumber']; ?>" size="3" />
		</p>
	<?php
	}
}
?>