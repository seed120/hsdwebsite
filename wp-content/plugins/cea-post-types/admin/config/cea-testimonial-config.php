<?php

//Testimonial Tab
ceaPluginOptions::ceaSetSection( array(
	'title'      => esc_html__( 'Testimonial', 'cea-post-types' ),
	'id'         => 'cea-testimonial-tab',
	'fields'	 => array(
		array(
			'id'       => 'testimonial-title-opt',
			'type'     => 'switch',
			'title'    => esc_html__( 'Testimonial Singe Page Title', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enable testimonial title for Single page. you can create your', 'cea-post-types') .'<a href="post-new.php?post_type=cea-testimonial" target="_blank">'. esc_html('Testimonial here.') .'</a>',
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
		),
		array(
			'id'       => 'cpt-testimonial-slug',
			'type'     => 'text',
			'title'    => esc_html__( 'Testimonial Slug', 'cea-post-types' ),
			'desc'     => esc_html__( 'Changing Slug for the Single Testimonial, Save permalinks settings here..', 'cea-post-types' ) .'<a href="options-permalink.php" target="_blank"> '. esc_html__( 'click here', 'cea-post-types' ) .'</a>',
			'default'  => 'testimonial'
		),
		// array(
		// 	'id' 	   => 'cpt-testimonial-labelname',
		// 	'type'     => 'text',
		// 	'title'    => esc_html__( 'Testimonial Label Name', 'cea-post-types'),
		// 	'desc' 	   => esc_html__( 'Name to be displayed as Testimonial Labelname. Page must be refreshed to see changes. ', 'cea-post-types') .'<a href="admin.php?page=classic-addons-widgets">'. esc_html__( 'Refresh?', 'cea-post-types' ) .'</a>',
		// 	'default'  => 'Testimonial'
		// ),
		array(
			'id'       => 'cpt-testimonial-sidebars',
			'type'     => 'select',
			'title'    => esc_html__( 'Testimonial Sidebar', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select single testimonial sidebar.', 'cea-post-types' ),
			'sidebars'  => true
		)
	)
) );