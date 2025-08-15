<?php

//Service Tab
ceaPluginOptions::ceaSetSection( array(
	'title'      => esc_html__( 'Service', 'cea-post-types' ),
	'id'         => 'cea-service-tab',
	'fields'	 => array(
		array(
			'id'       => 'service-title-opt',
			'type'     => 'switch',
			'title'    => esc_html__( 'Service Singe Page Title', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enable service title for Single page. you can add your ', 'cea-post-types') .'<a href="post-new.php?post_type=cea-service" target="_blank">'. esc_html('Service here.') .'</a>',
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
		),
		array(
			'id'       => 'cpt-service-slug',
			'type'     => 'text',
			'title'    => esc_html__( 'Service Slug', 'cea-post-types' ),
			'desc'     => esc_html__( 'Changing Slug for the Single Service, Save permalinks settings here,', 'cea-post-types' ) .'<a href="options-permalink.php" target="_blank"> '. esc_html__( 'click here', 'cea-post-types' ) .'</a>',
			'default'  => 'service'
		),
		array(
			'id'	   => 'service-layout-options',
			'type'	   => 'select',
			'title'	   => esc_html__( 'Service Layout',  'cea-post-types' ),
			'desc'     => esc_html__( 'Choose default service single layout structure or choose Custom to remove the feature image.', 'cea-post-types' ),
			'options'  => array(
				'default-layout'		=> esc_html__( 'Default Layout', 'cea-post-types' ),
				'custom-layout'		=> esc_html__( 'Custom', 'cea-post-types' )
			),
			'default'  => 'default-layout'
		),
		// array(
		// 	'id' 	   => 'cpt-service-labelname',
		// 	'type'     => 'text',
		// 	'title'    => esc_html__( 'Service Label Name', 'cea-post-types'),
		// 	'desc' 	   => esc_html__( 'Name to be displayed as Service Labelname. Page must be refreshed to see changes. ', 'cea-post-types') .'<a href="admin.php?page=classic-addons-widgets">'. esc_html__( 'Refresh?', 'cea-post-types' ) .'</a>',
		// 	'default'  => 'Service'
		// ),
		array(
			'id'       => 'service-grid-cols',
			'type'     => 'select',
			'title'    => esc_html__( 'Grid Columns', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select grid columns.', 'cea-post-types' ),
			'options'  => array(
				'4'		=> esc_html__( '4 Columns', 'cea-post-types' ),
				'3'		=> esc_html__( '3 Columns', 'cea-post-types' ),
				'2'		=> esc_html__( '2 Columns', 'cea-post-types' ),
			),
			'default'  => '2'
		),
		array(
			'id'       => 'service-grid-gutter',
			'type'     => 'text',
			'title'    => esc_html__( 'Services Archive Grid Gutter', 'cea-post-types' ),
			'desc' => esc_html__( 'Enter grid gutter size. Example 20.', 'cea-post-types' ),
			'default'  => '20'
		),
		array(
			'id'       => 'service-grid-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Grid Type', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select grid type normal or isotope.', 'cea-post-types' ),
			'options'  => array(
				'normal'		=> esc_html__( 'Normal Grid', 'cea-post-types' ),
				'isotope'		=> esc_html__( 'Isotope Grid', 'cea-post-types' ),
			),
			'default'  => 'isotope'
		),
		array(
			'id'       => 'cpt-service-sidebars',
			'type'     => 'select',
			'title'    => esc_html__( 'Service Sidebar', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select single service sidebar.', 'cea-post-types' ),
			'sidebars'  => true
		)
	)
) );