<?php

//Event Tab
ceaPluginOptions::ceaSetSection( array(
	'title'      => esc_html__( 'Event', 'cea-post-types' ),
	'id'         => 'cea-event-tab',
	'fields'	 => array(
		array(
			'id'       => 'event-title-opt',
			'type'     => 'switch',
			'title'    => esc_html__( 'Event Single Page Title', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enable Event title for Single page. you can add your', 'cea-post-types') .'<a href="post-new.php?post_type=cea-event" target="_blank">'. esc_html('Event here.') .'</a>',
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
		),
		array(
			'id'       => 'cpt-event-slug',
			'type'     => 'text',
			'title'    => esc_html__( 'Event Slug', 'cea-post-types' ),
			'desc'     => esc_html__( 'Changing Slug for the Single Event, Save permalinks settings here..', 'cea-post-types' ) .'<a href="options-permalink.php" target="_blank"> '. esc_html__( 'click here', 'cea-post-types' ) .'</a>',
			'default'  => 'event'
		),
		array(
			'id'	   => 'event-layout-options',
			'type'	   => 'select',
			'title'	   => esc_html__( 'Event Layout',  'cea-post-types' ),
			'desc'     => esc_html__( 'Choose default portfolio single layout structure or choose Custom', 'cea-post-types' ),
			'options'  => array(
				'default-layout'		=> esc_html__( 'Default Layout', 'cea-post-types' ),
				'custom-layout'		=> esc_html__( 'Custom', 'cea-post-types' )
			),
			'default'  => 'event-date-time'
		),
		array(
			'id'       => 'event-datetime-options',
			'type'     => 'select',
			'title'    => esc_html__( 'Date and Time display', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select data or time or both to be displayed', 'cea-post-types' ),
			'options'  => array(
				'event-start-time'		=> esc_html__( 'Display Time', 'cea-post-types' ),
				'event-start-date'		=> esc_html__( 'Display Date', 'cea-post-types' ),
				'event-date-time'		=> esc_html__( 'Both', 'cea-post-types' ),
				'none'					=> esc_html__( 'None', 'cea-post-types' )
			),
			'default'  => 'event-date-time',
			'required'	=> array( 'event-layout-options', '=', 'custom-layout' )
		), 
		array(
			'id'       => 'event-default-format',
			'type'     => 'switch',
			'title'    => esc_html__( 'Feature Image', 'cea-post-types' ),
			'desc'     => esc_html__( 'Display default feature Image or add as your choice', 'cea-post-types'),
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
			'required'	=> array( 'event-layout-options', '=', 'custom-layout' )
		),
		array(
			'id'       => 'event-default-event-details',
			'type'     => 'switch',
			'title'    => esc_html__( 'Event details', 'cea-post-types' ),
			'desc'     => esc_html__( 'Display event details like organizer name, start date and end date etc.', 'cea-post-types'),
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
			'required'	=> array( 'event-layout-options', '=', 'custom-layout' )
		),
		array(
			'id'       => 'event-default-event-venue',
			'type'     => 'switch',
			'title'    => esc_html__( 'Event Venue Details', 'cea-post-types' ),
			'desc'     => esc_html__( 'Display event Venue related details like venue address, email and phone number.', 'cea-post-types') .'<a href="post-new.php?post_type=cea-event" target="_blank">'. esc_html('Event here.') .'</a>',
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
			'required'	=> array( 'event-layout-options', '=', 'custom-layout' )
		),
		array(
			'id'       => 'event-default-event-map',
			'type'     => 'switch',
			'title'    => esc_html__( 'Event Venue Map', 'cea-post-types' ),
			'desc'     => esc_html__( 'Display event Venue Map.', 'cea-post-types') .'<a href="post-new.php?post_type=cea-event" target="_blank">'. esc_html('Event here.') .'</a>',
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
			'required'	=> array( 'event-layout-options', '=', 'custom-layout' )
		),
		array(
			'id'       => 'event-default-event-form',
			'type'     => 'switch',
			'title'    => esc_html__( 'Event Venue Contact Form', 'cea-post-types' ),
			'desc'     => esc_html__( 'Display event Venue Contact Form .', 'cea-post-types') .'<a href="post-new.php?post_type=cea-event" target="_blank">'. esc_html('Event here.') .'</a>',
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
			'required'	=> array( 'event-layout-options', '=', 'custom-layout' )
		),
		// array(
		// 	'id' 	   => 'cpt-event-labelname',
		// 	'type'     => 'text',
		// 	'title'    => esc_html__( 'Event Label Name', 'cea-post-types'),
		// 	'desc' 	   => esc_html__( 'Name to be displayed as Event Labelname. Page must be refreshed to see changes. ', 'cea-post-types') .'<a href="admin.php?page=classic-addons-widgets">'. esc_html__( 'Refresh?', 'cea-post-types' ) .'</a>',
		// 	'default'  => 'Event'
		// ),
		array(
			'id'       => 'cpt-event-sidebars',
			'type'     => 'select',
			'title'    => esc_html__( 'Event Sidebar', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select single event sidebar.', 'cea-post-types' ),
			'sidebars'  => true
		)
	)
) );