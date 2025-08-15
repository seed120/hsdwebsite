<?php
/**
 * Displays the menus and widgets at the end of the main element.
 */

$template = Hirxpert_Wp_Elements::$template;

$keys = array(
	'chk' => 'sidebar-chk',
	'fields' => array(
		'sidebar_layout' => array( 'sidebar-layout', $template.'-sidebar-layout' ),
		'right_sidebar' => array( 'right-sidebar', $template.'-right-sidebar' ),
		'left_sidebar' => array( 'left-sidebar', $template.'-left-sidebar' )
	)
);
$page_title_values = Hirxpert_Wp_Elements::hirxpert_get_meta_and_option_values( $keys );

$sidebar_layout = $page_title_values['sidebar_layout'];
if( $sidebar_layout != 'no-sidebar' ):
	$col = 0; $sides = array();
	if( $sidebar_layout == 'left-sidebar' ){
		Hirxpert_Wp_Elements::hirxpert_get_template_sidebars( $page_title_values, 'left', 'col-md-4 order-md-1' );
	}elseif( $sidebar_layout == 'right-sidebar' ){
		Hirxpert_Wp_Elements::hirxpert_get_template_sidebars( $page_title_values, 'right', 'col-md-4 order-md-3' );
	}elseif( $sidebar_layout == 'both-sidebar' ){
		$left_sidebar = $page_title_values['left_sidebar'];
		$right_sidebar = $page_title_values['right_sidebar'];
		
		if( $left_sidebar != 'none' && is_active_sidebar($left_sidebar) && $right_sidebar != 'none' && is_active_sidebar($right_sidebar) )$col = 3;
		else $col = 4;
		
		Hirxpert_Wp_Elements::hirxpert_get_template_sidebars( $page_title_values, 'left', 'col-md-'. esc_attr( $col ) .' order-md-1' );
		Hirxpert_Wp_Elements::hirxpert_get_template_sidebars( $page_title_values, 'right', 'col-md-'. esc_attr( $col ) .' order-md-3' );
	}
endif;