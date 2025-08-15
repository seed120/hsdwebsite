<?php
//Team Tab
ceaPluginOptions::ceaSetSection( array(
	'title'      => esc_html__( 'Team', 'cea-post-types' ),
	'id'         => 'cea-team-tab',
	'fields'	 => array(
		array(
			'id'       => 'team-title-opt',
			'type'     => 'switch',
			'title'    => esc_html__( 'Team Singe Page Title', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enable team title for Single page. you can add your ', 'cea-post-types') .'<a href="post-new.php?post_type=cea-team" target="_blank">'. esc_html('Team here.') .'</a>',
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
		),
		array(
			'id'       => 'cpt-team-slug',
			'type'     => 'text',
			'title'    => esc_html__( 'Team Slug', 'cea-post-types' ),
			'desc'     => esc_html__( 'Changing Slug for the Single Team, Save permalinks settings here..', 'cea-post-types' ) .'<a href="options-permalink.php" target="_blank"> '. esc_html__( 'click here', 'cea-post-types' ) .'</a>',
			'default'  => 'team'
		),
		array(
			'id'	   => 'team-layout-options',
			'type'	   => 'select',
			'title'	   => esc_html__( 'Team Layout',  'cea-post-types' ),
			'desc'     => esc_html__( 'Choose default team single layout structure or choose Custom to remove the feature image.', 'cea-post-types' ),
			'options'  => array(
				'default-layout'		=> esc_html__( 'Default Layout', 'cea-post-types' ),
				'custom-layout'		=> esc_html__( 'Custom', 'cea-post-types' )
			),
			'default'  => 'default-layout'
		),
		array(
			'id'       => 'teams-default-format',
			'type'     => 'switch',
			'title'    => esc_html__( 'Feature Image', 'cea-post-types' ),
			'desc'     => esc_html__( 'Display default feature Image or add as your choice', 'cea-post-types'),
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
			'required'	=> array( 'team-layout-options', '=', 'custom-layout' )
		),
		array(
			'id'       => 'team-default-metaitems',
			'type'     => 'switch',
			'title'    => esc_html__( 'Display Team details', 'cea-post-types' ),
			'desc'     => esc_html__( 'Display team details like organizer name, start date and end date etc.', 'cea-post-types'),
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
			'required'	=> array( 'team-layout-options', '=', 'custom-layout' )
		),
		// array(
		// 	'id' 	   => 'cpt-team-labelname',
		// 	'type'     => 'text',
		// 	'title'    => esc_html__( 'Team Label Name', 'cea-post-types'),
		// 	'desc' 	   => esc_html__( 'Name to be displayed as Team Labelname. Page must be refreshed to see changes. ', 'cea-post-types') .'<a href="admin.php?page=classic-addons-widgets">'. esc_html__( 'Refresh?', 'cea-post-types' ) .'</a>',
		// 	'default'  => 'Team'
		// ),
		array(
			'id'       => 'cpt-team-sidebars',
			'type'     => 'select',
			'title'    => esc_html__( 'Team Sidebar', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select single team sidebar.', 'cea-post-types' ),
			'sidebars'  => true
		)
	)
) );