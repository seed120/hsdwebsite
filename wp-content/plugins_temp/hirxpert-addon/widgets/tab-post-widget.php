<?php
class Hirxpert_Advance_Tab_Post_Widget extends WP_Widget {
	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'zozo_advance_tab_post_widget', 'description' => esc_html__('A widget that displays your post by category on tab', 'hirxpert-addon') );
		/* Widget control settings. */
		$control_ops = array('id_base' => 'zozo_advance_tab_post_widget' );
		/* Create the widget. */
		parent::__construct( 'zozo_advance_tab_post_widget', esc_html__('Hirxpert Tab Post Widget', 'hirxpert-addon'), $widget_ops, $control_ops );
	}
	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$tabtitle1 = $instance['tabtitle1'];
		$categories1 = $instance['categories1'];
		$selpost1 = $instance['selpost1'];
		$number1 = $instance['number1'];
		
		$tabtitle2 = $instance['tabtitle2'];
		$categories2 = $instance['categories2'];
		$selpost2 = $instance['selpost2'];
		$number2 = $instance['number2'];
		
		$tabtitle3 = $instance['tabtitle3'];
		$categories3 = $instance['categories3'];
		$selpost3 = $instance['selpost3'];
		$number3 = $instance['number3'];
		/* Before widget (defined by themes). */
		echo wp_kses_post( $before_widget );
		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo ( $title != '' ? wp_kses_post( $before_title . $title . $after_title ) : '' );
			
			$widg_id = $args['widget_id'] . '-' . $this->advanceTabWidgetUniqueKey(); 
		?>
		<!--Tab for Recent Post and Popular Post-->
		
		<div class="widget-content">
			<ul class="nav nav-fill nav-tabs" role="tablist">
				<li role="presentation" class="nav-item"><a class="nav-link active" href="#tab1_<?php echo esc_attr( $widg_id ); ?>" aria-controls="tab1_<?php echo esc_attr( $widg_id ); ?>" role="tab" data-toggle="tab"><?php echo esc_attr( $tabtitle1 );?></a></li>
				<li class="nav-item" role="presentation"><a class="nav-link" href="#tab2_<?php echo esc_attr( $widg_id ); ?>" aria-controls="tab2_<?php echo esc_attr( $widg_id ); ?>" role="tab" data-toggle="tab"><?php echo esc_attr( $tabtitle2 );?></a></li>
				<li class="nav-item" role="presentation"><a class="nav-link" href="#tab3_<?php echo esc_attr( $widg_id ); ?>" aria-controls="tab3_<?php echo esc_attr( $widg_id ); ?>" role="tab" data-toggle="tab"><?php echo esc_attr( $tabtitle3 );?></a></li>
			</ul>
			<!-- Recent Post -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade show active" id="tab1_<?php echo esc_attr( $widg_id ); ?>">
					<?php 
						if($selpost1 == 'recent'){
							$query = array('showposts' => $number1 ? $number1 : 3, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $categories1);	
							$output = $this->advanceTabWidgetPostOutput($query);
						}elseif($selpost1 == 'mostview'){
							$query = array( 'posts_per_page' => $number1 ? $number1 : 3, 'meta_key' => 'hirxpert_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'cat' => $categories1  );	
							$output = $this->advanceTabWidgetPostOutput($query);
						}elseif($selpost1 == 'mostlike'){
							$query = array( 'posts_per_page' => $number1 ? $number1 : 3, 'meta_key' => 'votes_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'cat' => $categories1  );	
							$output = $this->advanceTabWidgetPostOutput($query);
						}
						echo ''.$output;
					?>
				</div>
				
				<!-- Popular Post -->
				
				<div role="tabpanel" class="tab-pane fade" id="tab2_<?php echo esc_attr( $widg_id ); ?>">
					<?php
						if($selpost2 == 'recent'){
							$query = array('showposts' => $number2 ? $number2 : 3, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $categories2);	
							$output = $this->advanceTabWidgetPostOutput($query);
						}elseif($selpost2 == 'mostview'){
							$query = array( 'posts_per_page' => $number2 ? $number2 : 3, 'meta_key' => 'hirxpert_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'cat' => $categories2  );	
							$output = $this->advanceTabWidgetPostOutput($query);
						}elseif($selpost2 == 'mostlike'){
							$query = array( 'posts_per_page' => $number2 ? $number2 : 3, 'meta_key' => 'votes_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'cat' => $categories2  );	
							$output = $this->advanceTabWidgetPostOutput($query);
						}
						echo ''.$output;
					?>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="tab3_<?php echo esc_attr( $widg_id ); ?>">
					<?php 
						if($selpost3 == 'recent'){
							$query = array('showposts' => $number3 ? $number3 : 3, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1, 'cat' => $categories3);	
							$output = $this->advanceTabWidgetPostOutput($query);
						}elseif($selpost3 == 'mostview'){
							$query = array( 'posts_per_page' => $number3 ? $number3 : 3, 'meta_key' => 'hirxpert_post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'cat' => $categories3  );	
							$output = $this->advanceTabWidgetPostOutput($query);
						}elseif($selpost3 == 'mostlike'){
							$query = array( 'posts_per_page' => $number3 ? $number3 : 3, 'meta_key' => 'votes_count', 'orderby' => 'meta_value_num', 'order' => 'DESC', 'cat' => $categories3  );	
							$output = $this->advanceTabWidgetPostOutput($query);
						}else{
							$args = array( 'number' => $number3 ? $number3 : 3 , 'status' => 'approve', 'post_status' => 'publish' );
							$output = $this->advanceTabWidgetCommentsOutput($args);
						}
						echo ''.$output;
					?>
				</div>
			</div>
		
			
		</div>
			
		<?php
		/* After widget (defined by themes). */
		echo wp_kses_post( $after_widget );
	}
	
	function advanceTabWidgetUniqueKey(){
		static $tw_key = 1;
		return $tw_key++;
	}
	
	function advanceTabWidgetPostOutput($query){
		$tab1 = '<ul class="post-newsfeed">';										
			$loop = new WP_Query($query);
			if ($loop->have_posts()) {							
				while ($loop->have_posts()) { 
					$loop->the_post(); 
					$tab1 .= '<li>';
					$tab1 .= '<div class="post-item media">';
					$tab1 .= '<div class="post-image d-flex me-3">';
					$format = get_post_format( get_the_ID() );
						
					if( $format == "quote" || $format == "link" ){
						$tab1 .= '<a href="'.get_permalink().'" rel="bookmark"><div class="side-noimg themebg-color"><span class="'.( $format == "quote" ? 'bi bi-quote' : 'bi bi-link-45deg').'"></span></div></a>';
					}
					elseif (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
						$tab1 .= '<a href="'.get_permalink().'" rel="bookmark">'.get_the_post_thumbnail(get_the_ID(), array(70, 70), array('class' => 'img-responsive')).'</a>';
					} 
					$comments_count = wp_count_comments(get_the_ID());
					$ccount = $comments_count->total_comments;
					
					$archive_year  = get_the_time('Y'); 
					$archive_month = get_the_time('m'); 
					$archive_day   = get_the_time('d');
					
					$tab1 .= '</div>';
					$tab1 .= '<div class="post-item-desc media-body">';
					$tab1 .= '<h6 class="post-title"><a class="themeh-color" href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a></h6>';
					$tab1 .= '<p class="post-item-comment"><a href="'.get_comments_link(get_the_ID()).'" ><span>'. $comments_count->total_comments .' '. esc_html__( 'Comments', 'hirxpert-addon' ) .' </span></a></p><p class="post-item-date"><a href="'.get_day_link( $archive_year, $archive_month, $archive_day).'" ><span>'. get_the_time( get_option('date_format') ) .'</span></a></p>';
					$tab1 .= '</div>';
					$tab1 .= '</div>';
					$tab1 .= '</li>';
				} //while 
			wp_reset_postdata();
		} //if
		$tab1 .= '</ul>';
		
		return $tab1;
	}
	function advanceTabWidgetCommentsOutput($args){
		if( !function_exists( 'comment_custom_excerpt_length' ) ){
			function comment_custom_excerpt_length( $length ) {
				return 3;
			}
		}
		add_filter( 'comment_excerpt_length', 'comment_custom_excerpt_length', 999 );
		
		$comments = get_comments( apply_filters( 'widget_comments_args', $args ) );
		$output = '<ul class="recent-comments">';
		if ( is_array( $comments ) && $comments ) {
			foreach ( (array) $comments as $comment ) {
				$output .= '<li class="recentcomments">';
				/* translators: comments widget: 1: comment author, 2: post link */
				$output .= '<a href="' . esc_url( get_comment_link( $comment ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a> #'.  get_comment_excerpt($comment).' '. esc_html__('by', 'hirxpert-addon') .' <span class="comment-author-link"><i>' . get_comment_author_link( $comment ) . '</i></span>' ;
				$output .= '</li>';
			}
		}
		$output .= '</ul>';
		
		return $output;
	}
	
	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		
		$instance['tabtitle1'] = $new_instance['tabtitle1'];
		$instance['categories1'] = strip_tags( $new_instance['categories1'] );
		$instance['selpost1'] = strip_tags( $new_instance['selpost1'] );
		$instance['number1'] = strip_tags( $new_instance['number1'] );
		
		$instance['tabtitle2'] = $new_instance['tabtitle2'];
		$instance['categories2'] = strip_tags( $new_instance['categories2'] );
		$instance['selpost2'] = strip_tags( $new_instance['selpost2'] );
		$instance['number2'] = strip_tags( $new_instance['number2'] );
		
		$instance['tabtitle3'] = $new_instance['tabtitle3'];
		$instance['categories3'] = strip_tags( $new_instance['categories3'] );
		$instance['selpost3'] = strip_tags( $new_instance['selpost3'] );
		$instance['number3'] = strip_tags( $new_instance['number3'] );
		
		return $instance;
	}
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'tabtitle1' => '', 'categories1' => 'all', 'selpost1' => 'recent', 'number1' => '', 'tabtitle2' => '', 'categories2' => 'all', 'selpost2' => 'recent', 'number2' => '', 'tabtitle3' => '', 'categories3' => 'all', 'selpost3' => 'recent', 'number3' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e('Title:', 'hirxpert-addon'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>"  />
		</p>
		
		<!-- First TAB title -->
		<p><h4><u><?php esc_html_e('First Tab Settings:', 'hirxpert-addon'); ?></u></h4></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tabtitle1' ) ); ?>"><?php esc_html_e('First Tab Title:', 'hirxpert-addon'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tabtitle1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tabtitle1' ) ); ?>" value="<?php echo esc_attr( $instance['tabtitle1'] ); ?>"  />
		</p>
		
		<!-- Category -->
		<?php $display = ''; if( $instance['selpost1'] != 'comments' ){ $display = 'block'; } else{ $display = 'none'; } ?>
		<p id="hs<?php echo esc_attr( $this->get_field_id('categories1') ); ?>" style="display:<?php echo esc_attr( $display ); ?>;">
		<label for="<?php echo esc_attr( $this->get_field_id('categories1') ); ?>"><?php esc_html_e('Filter by Category:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('categories1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('categories1') ); ?>" class="widefat categories" style="width:100%;">
			<option value='all' <?php if ('all' == $instance['categories1']) echo 'selected="selected"'; ?>><?php esc_html_e('All categories', 'hirxpert-addon'); ?></option>
			<?php $categories = get_categories('hide_empty=1&depth=1&type=post'); ?>
			<?php foreach($categories as $category) { ?>
			<option value='<?php echo esc_attr( $category->term_id ); ?>' <?php if ($category->term_id == $instance['categories1']) echo 'selected="selected"'; ?>><?php echo esc_attr( $category->cat_name ); ?></option>
			<?php } ?>
		</select>
		</p>
		
		<!-- Select Post (Recent, Popular ...) -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id('selpost1') ); ?>"><?php esc_html_e('Select Post Type:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('selpost1') ); ?>" name="<?php echo esc_attr( $this->get_field_name('selpost1') ); ?>" class="widefat advance_widget_posttab_selpost" style="width:100%;">
			<?php 
				$postviews = array(
					"recent"=> esc_html__( 'Recent Posts', 'hirxpert-addon' ),
					"mostlike"=> esc_html__( 'Most Like Posts', 'hirxpert-addon' ),
					"mostview"=> esc_html__( 'Most Viewed Posts', 'hirxpert-addon' ),
					"comments"=> esc_html__( 'Post Comments', 'hirxpert-addon' )
				); 
			?>
			<?php foreach($postviews as $pkey => $pval) { ?>
				<option value='<?php echo esc_attr( $pkey ); ?>' <?php if ($pkey == $instance['selpost1']) echo 'selected="selected"'; ?>><?php echo esc_attr( $pval ); ?></option>
			<?php } ?>
		</select>
		</p>
		
		<!-- Number of posts/comments -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number1' ) ); ?>"><?php esc_html_e('Number of Recent posts/comments to show:', 'hirxpert-addon'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number1' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number1' ) ); ?>" value="<?php echo esc_attr( $instance['number1'] ); ?>" size="3" />
		</p>
		
		<!-- Second TAB title -->
		<p><h4><u><?php esc_html_e('Second Tab Settings:', 'hirxpert-addon'); ?></u></h4></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tabtitle2' ) ); ?>"><?php esc_html_e('Second Tab Title:', 'hirxpert-addon'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tabtitle2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tabtitle2' ) ); ?>" value="<?php echo esc_attr( $instance['tabtitle2'] ); ?>"  />
		</p>
		
		<!-- Category -->
		<?php $display = ''; if( $instance['selpost2'] != 'comments' ){ $display = 'block'; } else{ $display = 'none'; } ?>
		<p id="hs<?php echo esc_attr( $this->get_field_id('categories2') ); ?>" style="display:<?php echo esc_attr( $display ); ?>;">
		<label for="<?php echo esc_attr( $this->get_field_id('categories2') ); ?>"><?php esc_html_e('Filter by Category:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('categories2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('categories2') ); ?>" class="widefat categories" style="width:100%;">
			<option value='all' <?php if ('all' == $instance['categories2']) echo 'selected="selected"'; ?>><?php esc_html_e('All categories', 'hirxpert-addon'); ?></option>
			<?php $categories = get_categories('hide_empty=1&depth=1&type=post'); ?>
			<?php foreach($categories as $category) { ?>
			<option value='<?php echo esc_attr( $category->term_id ); ?>' <?php if ($category->term_id == $instance['categories2']) echo 'selected="selected"'; ?>><?php echo esc_attr( $category->cat_name ); ?></option>
			<?php } ?>
		</select>
		</p>
		
		<!-- Select Post (Recent, Popular ...) -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id('selpost2') ); ?>"><?php esc_html_e('Select Post Type:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('selpost2') ); ?>" name="<?php echo esc_attr( $this->get_field_name('selpost2') ); ?>" class="widefat advance_widget_posttab_selpost" style="width:100%;">
			<?php 
				$postviews = array(
					"recent"=> esc_html__( 'Recent Posts', 'hirxpert-addon' ),
					"mostlike"=> esc_html__( 'Most Like Posts', 'hirxpert-addon' ),
					"mostview"=> esc_html__( 'Most Viewed Posts', 'hirxpert-addon' ),
					"comments"=> esc_html__( 'Post Comments', 'hirxpert-addon' )
				); 
			?>
			<?php foreach($postviews as $pkey => $pval) { ?>
				<option value='<?php echo esc_attr( $pkey ); ?>' <?php if ($pkey == $instance['selpost2']) echo 'selected="selected"'; ?>><?php echo esc_attr( $pval ); ?></option>
			<?php } ?>
		</select>
		</p>
		
		<!-- Number of posts/comments -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number2' ) ); ?>"><?php esc_html_e('Number of Recent posts/comments to show:', 'hirxpert-addon'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number2' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number2' ) ); ?>" value="<?php echo esc_attr( $instance['number2'] ); ?>" size="3" />
		</p>
		
		<!-- Thrid TAB title -->
		<p><h4><u><?php esc_html_e('Thrid Tab Settings:', 'hirxpert-addon'); ?></u></h4></p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'tabtitle3' ) ); ?>"><?php esc_html_e('Thrid Tab Title:', 'hirxpert-addon'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'tabtitle3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'tabtitle3' ) ); ?>" value="<?php echo esc_attr( $instance['tabtitle3'] ); ?>"  />
		</p>
		
		<!-- Category -->
		<?php $display = ''; if( $instance['selpost3'] != 'comments' ){ $display = 'block'; } else{ $display = 'none'; } ?>
		<p id="hs<?php echo esc_attr( $this->get_field_id('categories3') ); ?>" style="display:<?php echo esc_attr( $display ); ?>;">
		<label for="<?php echo esc_attr( $this->get_field_id('categories3') ); ?>"><?php esc_html_e('Filter by Category:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('categories3') ); ?>" name="<?php echo esc_attr( $this->get_field_name('categories3') ); ?>" class="widefat categories" style="width:100%;">
			<option value='all' <?php if ('all' == $instance['categories3']) echo 'selected="selected"'; ?>><?php esc_html_e('All categories', 'hirxpert-addon'); ?></option>
			<?php $categories = get_categories('hide_empty=1&depth=1&type=post'); ?>
			<?php foreach($categories as $category) { ?>
			<option value='<?php echo esc_attr( $category->term_id ); ?>' <?php if ($category->term_id == $instance['categories3']) echo 'selected="selected"'; ?>><?php echo esc_attr( $category->cat_name ); ?></option>
			<?php } ?>
		</select>
		</p>
		
		<!-- Select Post (Recent, Popular ...) -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id('selpost3') ); ?>"><?php esc_html_e('Select Post Type:', 'hirxpert-addon'); ?></label> 
		<select id="<?php echo esc_attr( $this->get_field_id('selpost3') ); ?>" name="<?php echo esc_attr( $this->get_field_name('selpost3') ); ?>" class="widefat advance_widget_posttab_selpost" style="width:100%;">
			<?php 
				$postviews = array(
					"recent"=> esc_html__( 'Recent Posts', 'hirxpert-addon' ),
					"mostlike"=> esc_html__( 'Most Like Posts', 'hirxpert-addon' ),
					"mostview"=> esc_html__( 'Most Viewed Posts', 'hirxpert-addon' ),
					"comments"=> esc_html__( 'Post Comments', 'hirxpert-addon' )
				); 
			?>
			<?php foreach($postviews as $pkey => $pval) { ?>
				<option value='<?php echo esc_attr( $pkey ); ?>' <?php if ($pkey == $instance['selpost3']) echo 'selected="selected"'; ?>><?php echo esc_attr( $pval ); ?></option>
			<?php } ?>
		</select>
		</p>
		
		<!-- Number of posts/comments -->
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number3' ) ); ?>"><?php esc_html_e('Number of Recent posts/comments to show:', 'hirxpert-addon'); ?></label>
			<input  type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number3' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number3' ) ); ?>" value="<?php echo esc_attr( $instance['number3'] ); ?>" size="3" />
		</p>
		<!--This Script for display some fields enable disable-->
		<script type="text/javascript">
			jQuery(function() {
				jQuery( ".advance_widget_posttab_selpost" ).change(function() {
					var thisid = jQuery(this).attr('id');
					thisid = thisid.replace('selpost','categories');
					var option = jQuery(this).find('option:selected').val();
					if(option == 'comments'){
						jQuery('#hs'+thisid).hide();
					}else{
						jQuery('#hs'+thisid).show();
					}
				});
			});
		</script>
	<?php
	}
}
?>