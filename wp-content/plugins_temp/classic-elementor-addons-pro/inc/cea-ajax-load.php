<?php

add_action('wp_ajax_cea_cpt_load_more', 'cea_cpt_load_more');
add_action('wp_ajax_nopriv_cea_cpt_load_more', 'cea_cpt_load_more');

function cea_cpt_load_more() {
    $page = isset($_POST['page']) ? absint($_POST['page']) : 1;
	$post_type = isset($_POST['cpt_type']) ? sanitize_text_field($_POST['cpt_type']) : 'cea-portfolio';
    $element_set = isset($_POST['element_set'])? ($_POST['element_set']) : '';
	$cpt_type = '';
	$cols = '';
	
	if ( $post_type == 'cea-portfolio' ) {
		$cpt_type = 'portfolio';
		$cols = isset( $element_set['portfolio_cols'] ) && $element_set['portfolio_cols'] !== '' ? $element_set['portfolio_cols'] : 6;
		$cols_tab = isset( $element_set['portfolio_cols_tab'] ) && $element_set['portfolio_cols_tab'] !== '' ? $element_set['portfolio_cols_tab'] : 6;
		$cols_mbl = isset( $element_set['portfolio_cols_mbl'] ) && $element_set['portfolio_cols_mbl'] !== '' ? $element_set['portfolio_cols_mbl'] : 12;
		
		$portfolio_layout = isset( $element_set['portfolio_layout'] ) && $element_set['portfolio_layout'] !== '' ? $element_set['portfolio_layout'] : 'default';

		if( $portfolio_layout == 'list' ) {
			$list_layout = 1;
		}

	} else if ( $post_type == 'cea-service' ) {
		$cpt_type ='service';
		$cols = isset( $element_set['service_cols'] ) && $element_set['service_cols'] !== '' ? $element_set['service_cols'] : 6;
		$cols_tab = isset( $element_set['service_cols_tab'] ) && $element_set['service_cols_tab'] !== '' ? $element_set['service_cols_tab'] : 6;
		$cols_mbl = isset( $element_set['service_cols_mbl'] ) && $element_set['service_cols_mbl'] !== '' ? $element_set['service_cols_mbl'] : 12;
		
		$service_layout = isset( $element_set['service_layout'] ) && $element_set['service_layout'] !== '' ? $element_set['service_layout'] : 'default';

		if( $service_layout == 'list' ) {
			$list_layout = 1;
		}
	} else if ( $post_type == 'cea-event' ) {
		$cpt_type = 'event';
		$cols = isset( $element_set['event_cols'] ) && $element_set['event_cols'] !== '' ? $element_set['event_cols'] : 6;
		$cols_tab = isset( $element_set['event_cols_tab'] ) && $element_set['event_cols_tab'] !== '' ? $element_set['event_cols_tab'] : 6;
		$cols_mbl = isset( $element_set['event_cols_mbl'] ) && $element_set['event_cols_mbl'] !== '' ? $element_set['event_cols_mbl'] : 12;
		
		$event_layout = isset( $element_set['event_layout'] ) && $element_set['event_layout'] !== '' ? $element_set['event_layout'] : 'default';

		if( $event_layout == 'list' ) {
			$list_layout = 1;
		}
	} else if ( $post_type == 'cea-team' ) {
		$cpt_type = 'team';
		$cols = isset( $element_set['team_cols'] ) && $element_set['team_cols'] !== '' ? $element_set['team_cols'] : 6;
		$cols_tab = isset( $element_set['team_cols_tab'] ) && $element_set['team_cols_tab'] !== '' ? $element_set['team_cols_tab'] : 6;
		$cols_mbl = isset( $element_set['team_cols_mbl'] ) && $element_set['team_cols_mbl'] !== '' ? $element_set['team_cols_mbl'] : 12;
		
		$team_layout = isset( $element_set['team_layout'] ) && $element_set['team_layout'] !== '' ? $element_set['team_layout'] : 'default';

		if( $team_layout == 'list' ) {
			$list_layout = 1;
		}
	} else if ( $post_type == 'cea-testimonial' ) {
		$cols = isset( $element_set['testimonial_cols'] ) && $element_set['testimonial_cols'] !== '' ? $element_set['testimonial_cols'] : 6;
		$cols_tab = isset( $element_set['testimonial_cols_tab'] ) && $element_set['testimonial_cols_tab'] !== '' ? $element_set['testimonial_cols_tab'] : 6;
		$cols_mbl = isset( $element_set['testimonial_cols_mbl'] ) && $element_set['testimonial_cols_mbl'] !== '' ? $element_set['testimonial_cols_mbl'] : 12;
		
		$testimonial_layout = isset( $element_set['testimonial_layout'] ) && $element_set['testimonial_layout'] !== '' ? $element_set['testimonial_layout'] : 'default';

		if( $testimonial_layout == 'list' ) {
			$list_layout = 1;
		}
	}

	$posts_per_page = isset($element_set['post_per_page']) && $element_set['post_per_page']!== ''? $element_set['post_per_page'] : '4';
	$excerpt_length = isset($element_set['excerpt_length']) && $element_set['excerpt_length']!== ''? $element_set['excerpt_length'] : '20';
	$order = isset($element_set['order']) && $element_set['order']!== ''? $element_set['order'] : 'DESC';
	$order_by = isset($element_set['orderby']) && $element_set['orderby']!== ''? $element_set['orderby'] : 'date';
	$head_tag = isset($element_set['post_heading']) && $element_set['post_heading'] !== ''? $element_set['post_heading'] : 'h3';
	$read_more = isset($element_set['more_text']) && $element_set['more_text']!== ''? $element_set['more_text'] : 'Read More';

	$post_thumb_size = isset($element_set['thumbnail_size']) && $element_set['thumbnail_size']!== ''? $element_set['thumbnail_size'] : 'full';

	$layout_items = isset($element_set['post_items']) && $element_set['post_items']!== ''? $element_set['post_items'] : '';
	if ( ! empty($layout_items) ) {
		$layout_items = json_decode(stripslashes($layout_items), true);
		$layout_items = $layout_items["Enabled"];
		$layout_items = array_keys($layout_items);
	} else {
		$layout_items = array( 'thumb', 'title', 'excerpt' );
	}

	$top_meta = isset($element_set['top_meta']) && $element_set['top_meta']!== ''? $element_set['top_meta'] : '';
	$top_meta = json_decode(stripslashes($top_meta), true);
	$top_meta_left = isset($top_meta['Left']) && $top_meta['Left']!== ''? $top_meta['Left'] : '';
	$top_meta_left = is_array($top_meta_left) ? array_keys( $top_meta_left ) : '';
	$top_meta_right = isset($top_meta['Right']) && $top_meta['Right']!== ''? $top_meta['Right'] : '';
	$top_meta_right = is_array($top_meta_right) ? array_keys( $top_meta_right ) : '';

	$bottom_meta = isset($element_set['bottom_meta']) && $element_set['bottom_meta']!== ''? $element_set['bottom_meta'] : '';
	$bottom_meta = json_decode(stripslashes($bottom_meta), true);
	$bottom_meta_left = isset($bottom_meta['Left']) && $bottom_meta['Left']!== ''? $bottom_meta['Left'] : '';
	$bottom_meta_left =  is_array($bottom_meta_left) ? array_keys( $bottom_meta_left ) : '';
	$bottom_meta_right = isset($bottom_meta['Right']) && $bottom_meta['Right']!== ''? $bottom_meta['Right'] : '';
	$bottom_meta_right = is_array($bottom_meta_right) ? array_keys( $bottom_meta_right ) : '';

	$overlay_opt = isset($element_set['post_overlay_items_opt']) && $element_set['post_overlay_items_opt'] === 'yes' ? true : false;
	$overlay_items = isset($element_set['post_overlay_items']) && $element_set['post_overlay_items'] !== ''? $element_set['post_overlay_items'] : '';
	$overlay_items = json_decode(stripslashes($overlay_items), true);
	$overlay_items = $overlay_opt && $overlay_items["Enabled"] !== '' ? $overlay_items['Enabled'] : '';
	$overlay_items = is_array($overlay_items) ? array_keys($overlay_items) : '';

	$col_class = 'col-lg-'. $cols .' col-md-'. $cols_tab.' col-sm-'. $cols_mbl;

    $query = new WP_Query([
        'post_type' => $post_type,
        'posts_per_page' => $posts_per_page,
        'paged' => $page,
		'order' => $order,
		'orderby' => $order_by,
        'post_status' => 'publish',
    ]);

	function ajax_get_title( $head_tag ) {
		?>
			<div class="entry-title">
				<<?php echo $head_tag; ?> class="post-title-head">
					<a href="<?php the_permalink(); ?>" class="post-title">
						<?php esc_html( the_title() ); ?>
					</a>
				</<?php echo $head_tag; ?>>
			</div>
		<?php
	}

	function ajax_get_category( $categories ) {
		if ( $categories && !is_wp_error( $categories ) ) {
			foreach ( $categories as $category ) {
				$category_links[] = '<a href="' . esc_url( get_term_link( $category->slug, 'portfolio-categories' ) ) . '">' . esc_html( $category->name ) . '</a>';
			}
			echo '<div class="post-category">' . implode(', ', $category_links) . '</div>';
		}
	}

	function ajax_get_author() {
		?>
		<div class="post-author">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ); ?>">
            <span class="author-img"><?php echo get_avatar( get_the_author_meta('email'), '30', null, null, array( 'class' => 'rounded-circle' ) ); ?></span>
				<span class="author-name"><?php esc_html( the_author() ); ?></span>
			</a>
		</div>
		<?php
	}

	function ajax_get_read_more( $read_more ) {
		?>
			<div class="post-more">
				<a href="<?php echo the_permalink(); ?>" class="read-more elementor-button">
					<span class="readmore-text">
						<?php echo esc_html( $read_more ); ?>
					</span>
				</a>
			</div>
		<?php
	}

	function ajax_get_comments() {
		$comments_count = wp_count_comments(get_the_ID());
		?>
			<div class="post-comment">
				<a href="<?php echo esc_url( get_comments_link( get_the_ID() ) ); ?>" rel="bookmark" class="comments-count">
					<i class="fa fa-comment-o"></i>
					<?php echo esc_html( $comments_count->total_comments ); ?>
				</a>
			</div>
		<?php
	}

	function ajax_get_the_date() {
		$archive_year  = get_the_time('Y');
		$archive_month = get_the_time('m'); 
		$archive_day   = get_the_time('d');
		?>
			<div class="post-date">
				<a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ); ?>">
					<i class="icon icon-calendar"></i> 
					<?php echo get_the_time( get_option( 'date_format' ) ); ?>
				</a>
			</div>
		<?php
	}

	function ajax_get_top_meta( $top_meta_left, $categories, $top_meta_right, $read_more ) {
		?>
			<div class="top-meta clearfix">
				<ul class="nav top-meta-list meta-left">
					<?php
						foreach( $top_meta_left as $left ) {
							switch ( $left ) {
								case 'category':
									echo '<li>';
										ajax_get_category( $categories );
									echo '</li>';
									break;	
								case 'author':
									echo '<li>';
									ajax_get_author();
									echo '</li>';
									break;
								case 'more': 
									echo '<li>';
									ajax_get_read_more( $read_more );
									echo '</li>';
									break; 
								case 'comment':
									echo '<li>';
									ajax_get_comments();
									echo '</li>';
									break; 
								case 'date':
									echo '<li>';
									ajax_get_the_date();
									echo '</li>';
									break; 
							}
						}	
					?>				
				</ul>
				<ul class="nav top-meta-list meta-right">
					<?php
						foreach( $top_meta_right as $right ) {
							switch ( $right ) {
								case 'category':
									echo '<li>';
										ajax_get_category( $categories );
									echo '</li>';
									break;	
								case 'author':
									echo '<li>';
									ajax_get_author();
									echo '</li>';
									break;
								case 'more': 
									echo '<li>';
									ajax_get_read_more( $read_more );
									echo '</li>';
									break; 
								case 'comment':
									echo '<li>';
									ajax_get_comments();
									echo '</li>';
									break; 
								case 'date':
									echo '<li>';
									ajax_get_the_date();
									echo '</li>';
									break; 
							}
						}	
					?>				
				</ul>
			</div>
		<?php
	}
	
	function ajax_get_bottom_meta( $bottom_meta_left, $categories, $bottom_meta_right, $read_more ) {
		?>
			<div class="bottom-meta clearfix">
				<ul class="nav bottom-meta-list meta-left">
					<?php
						foreach( $bottom_meta_left as $left ) {
							switch ( $left ) {
								case 'category':
									echo '<li>';
										ajax_get_category( $categories );
									echo '</li>';
									break;	
								case 'author':
									echo '<li>';
									ajax_get_author();
									echo '</li>';
									break;
								case 'more': 
									echo '<li>';
									ajax_get_read_more( $read_more );
									echo '</li>';
									break; 
								case 'comment':
									echo '<li>';
									ajax_get_comments();
									echo '</li>';
									break; 
								case 'date':
									echo '<li>';
									ajax_get_the_date();
									echo '</li>';
									break; 
							}
						}	
					?>				
				</ul>
				<ul class="nav bottom-meta-list meta-right">
					<?php
						foreach( $bottom_meta_right as $right ) {
							switch ( $right ) {
								case 'category':
									echo '<li>';
										ajax_get_category( $categories );
									echo '</li>';
									break;	
								case 'author':
									echo '<li>';
									ajax_get_author();
									echo '</li>';
									break;
								case 'more': 
									echo '<li>';
									ajax_get_read_more( $read_more );
									echo '</li>';
									break; 
								case 'comment':
									echo '<li>';
									ajax_get_comments();
									echo '</li>';
									break; 
								case 'date':
									echo '<li>';
									ajax_get_the_date();
									echo '</li>';
									break; 
							}
						}	
					?>				
				</ul>
			</div>
		<?php
	}

    ob_start();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

			$categories = get_the_terms(get_the_ID(), $cpt_type.'-categories');
			$category_links = array();

			$terms = get_the_terms( get_the_ID(), $cpt_type.'-tags' );
			$term_links = array();

			echo '<div class="'. $col_class .'"><div class="'.$cpt_type.'-inner">';
			if( is_array( $layout_items ) ) {
				foreach($layout_items as $item ) {
					switch( $item ) {
						case 'thumb':
							?>
								<?php if ( isset($list_layout) ) { ?>
									<div class="media">
								<?php } ?>
								<div class="post-thumb <?php echo $overlay_opt == true ? "post-overlay-active" : "";?>">
									<a href="<?php the_permalink(); ?>" class="post-image-link">
									<?php
										if ( $post_thumb_size !== 'custom' ) {
											the_post_thumbnail( $post_thumb_size, [ 'class' => 'img-fluid '.$element_set['img_style'] ] );
										} else {
											$img_url = get_the_post_thumbnail_url(get_the_ID());
											$img_width = $element_set['thumbnail_custom_dimension']['width'];
											$img_height = $element_set['thumbnail_custom_dimension']['height'];
											echo '<img src="'. $img_url .'" width="' .$img_width. '" height="' .$img_height. '" class="img-fluid '.$element_set['img_style'].'">';
										}
										?>
									</a>
									<?php
										if (  $overlay_opt ) {
											echo '<div class="post-overlay-items">';
											foreach ( $overlay_items as $lay ) {
												switch ( $lay ) {
													case 'more': 
														ajax_get_read_more( $read_more );
														break;
													case 'author':
														ajax_get_author();
														break;
													case 'category':
														ajax_get_category( $categories );
														break;
													case 'date':
														ajax_get_the_date();
														break;
													case 'comment': 
														ajax_get_comments();
														break;
													case 'title': 
														ajax_get_title( $head_tag );
														break;
													case 'icons': 
														?>
															<div class="post-icons">
																<ul class="nav">
																	<?php if ( has_post_thumbnail() ):
																		$featured_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>
																		<li class="post-magnific-wrap">
																			<a href="#" class="post-magnific image-gallery-link" data-mfp-src="<?php echo $featured_img_url; ?>">
																				<span class="ti-zoom-in"></span>
																			</a>
																		</li>
																	<?php endif; ?>
																		<li class="post-link-wrap">
																			<a href="<?php echo the_permalink(); ?>" class="post-link">
																				<span class="ti-link"></span>
																			</a>
																		</li>
																</ul>
															</div>
														<?php
														break;
													case 'top-meta':
														ajax_get_top_meta( $top_meta_left, $categories, $top_meta_right, $read_more );
														break;
													case 'bottom-meta': 
														ajax_get_bottom_meta( $bottom_meta_left, $categories, $bottom_meta_right, $read_more );
													    break;
												}			
											}
												echo '</div>';
										}
									?>
								</div>
								<?php if ( isset($list_layout) ) { ?>
								<div class="media-body">
								<?php } ?>
							<?php
						break;
						case 'title':
							ajax_get_title( $head_tag );
						break;
						case 'excerpt': 
							?>
								<div class="post-excerpt">
									<?php echo esc_html( wp_trim_words( get_the_excerpt(), $excerpt_length ) ); ?>
								</div>
							<?php
						break;
						case 'category':
							ajax_get_category( $categories );
						break;
						case 'author': 
							ajax_get_author();
						break;
						case 'top-meta':
							ajax_get_top_meta( $top_meta_left, $categories, $top_meta_right, $read_more );
						break;
						case 'bottom-meta': 
							ajax_get_bottom_meta( $bottom_meta_left, $categories, $bottom_meta_right, $read_more );
						break;
					}
				}
			}
			if( isset($list_layout) ) {
				echo '</div><!-- .meida -->';
				echo '</div><!-- .media -->';
			}
			echo '</div><!-- .portfolio-inner --></div>';
        }
    } else {
		echo '<p class="alert alert-danger load-more-text w-100">' . esc_html__('No more post to load.', 'zozo-portfolio') . '</p>';
	}

    wp_reset_postdata();

    $items = ob_get_clean();

    // Check if there are more pages
    $has_more = $query->max_num_pages > $page;

    wp_send_json_success([
        'items' => $items,
        'hasMore' => $has_more, // Return whether there are more posts to load
    ]);
}


