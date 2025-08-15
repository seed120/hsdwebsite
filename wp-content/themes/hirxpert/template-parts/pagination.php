<?php
/**
 * Displays the posts pagination
 */

$defaults = array(
	'range'           => 4,
	'custom_query'    => false,
	'first_string' => '<i class="bi bi-arrow-bar-left"></i>',
	'previous_string' => '<i class="bi bi-arrow-left-short"></i>',
	'next_string'     => '<i class="bi bi-arrow-right-short"></i>',
	'last_string'     => '<i class="bi bi-arrow-bar-right"></i>',
	'before_output'   => '<div class="post-pagination-wrap"><ul class="nav pagination post-pagination justify-content-center">',
	'after_output'    => '</ul></div>'
);

$args = apply_filters( 'hirxpert_wp_bootstrap_pagination_defaults', $defaults );

$args['range'] = (int) $args['range'] - 1;
if ( !$args['custom_query'] ){
	$args['custom_query'] = $GLOBALS['wp_query'];
}
$count = (int) $args['custom_query']->max_num_pages;
$max = $count;
//$count = absint( $count ) ? absint( $count ) : (int) $max;
$page = 1;
if( get_query_var('paged') ){
	$page = intval( get_query_var('paged') );
}elseif( get_query_var('page') ){
	$page = intval( get_query_var('page') );
}
$ceil  = ceil( $args['range'] / 2 );

if ( $count <= 1 )
	return FALSE;

if ( !$page )
	$page = 1;

if ( $count > $args['range'] ) {
	if ( $page <= $args['range'] ) {
		$min = 1;
		$max = $args['range'] + 1;
	} elseif ( $page >= ($count - $ceil) ) {
		$min = $count - $args['range'];
		$max = $count;
	} elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
		$min = $page - $ceil;
		$max = $page + $ceil;
	}
} else {
	$min = 1;
	$max = $count;
}

$previous = intval($page) - 1;
$previous = get_pagenum_link($previous);

// For theme check
$t_next_post_link = get_next_posts_link();
$t_prev_post_link = get_previous_posts_link();

echo '<div class="post-pagination-wrap"><ul class="nav pagination post-pagination justify-content-center test-pagination">';

$firstpage = get_pagenum_link(1);
if ( $firstpage && (1 != $page) && isset( $args['first_string'] ) && $args['first_string'] != '' ){
	echo sprintf( 
			'<li class="nav-item previous"><a href="%s" title="%s">%s</a></li>',
			esc_url( $firstpage ),
			esc_attr__( 'First', 'hirxpert'),
			$args['first_string']
		);
}
if ( $previous && (1 != $page) ){
	echo sprintf(
			'<li class="nav-item"><a href="%s" class="prev-page" title="%s">%s</a></li>',
			esc_url( $previous ),
			esc_attr__( 'previous', 'hirxpert'),
			$args['previous_string']
		);
}

if ( !empty($min) && !empty($max) ) {
	for( $i = $min; $i <= $max; $i++ ) {
		if ($page == $i) {
			echo sprintf( 
					'<li class="nav-item active"><span class="active">%s</span></li>',
					esc_attr( $i )
				);
		} else {
			echo sprintf( 
					'<li class="nav-item"><a href="%s">%s</a></li>', 
					esc_url( get_pagenum_link($i) ), 
					esc_attr( $i )
				);
		}
	}
}

$next = intval($page) + 1;
$next = get_pagenum_link($next);
if ($next && ($count != $page) )
	echo sprintf(
			'<li class="nav-item"><a href="%s" class="next-page" title="%s">%s</a></li>',
			esc_url( $next ),
			esc_attr__( 'next', 'hirxpert'),
			$args['next_string']
		);

$lastpage = esc_attr( get_pagenum_link($count) );
if ( $lastpage && isset( $args['last_string'] ) && $args['last_string'] != '' ) {
	echo sprintf(
			'<li class="nav-item next"><a href="%s" title="%s">%s</a></li>',
			esc_url( $lastpage ),
			esc_attr__( 'Last', 'hirxpert'),
			$args['last_string']
		);
}
echo '</ul></div>';