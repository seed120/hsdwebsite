<?php
//Portfolio Tab
ceaPluginOptions::ceaSetSection( array(
	'title'      => esc_html__( 'Portfolio', 'cea-post-types' ),
	'id'         => 'cea-portfolio-tab',
	'fields'	 => array( 
		array(
			'id'       => 'portfolio-title-opt',
			'type'     => 'switch',
			'title'    => esc_html__( 'Portfolio Single Title' ),
			'desc'     => esc_html__( 'Enable portfolio title for Single portfolio pages. you can add your ', 'cea-post-types') .'<a href="post-new.php?post_type=cea-portfolio" target="_blank">'. esc_html('portfolio here.') .'</a>',
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
		),
		array(
			'id'       => 'cpt-portfolio-slug',
			'type'     => 'text',
			'title'    => esc_html__( 'Portfolio Slug', 'cea-post-types' ),
			'desc'     => esc_html__( 'Changing Slug for the Single Portfolio, Save permalinks settings here..', 'cea-post-types' ) .'<a href="options-permalink.php" target="_blank"> '. esc_html__( 'click here', 'cea-post-types' ) .'</a>',
			'default'  => 'portfolio'
		),
		array(
			'id'	   => 'portfolio-layout-options',
			'type'	   => 'select',
			'title'	   => esc_html__( 'portfolio Layout',  'cea-post-types' ),
			'desc'     => esc_html__( 'Choose default portfolio single layout structure or choose Custom', 'cea-post-types' ),
			'options'  => array(
				'default-layout'		=> esc_html__( 'Default Layout', 'cea-post-types' ),
				'custom-layout'		=> esc_html__( 'Custom', 'cea-post-types' )
			),
			'default'  => 'default-layout'
		),
		array(
			'id'       => 'portfolio-default-format',
			'type'     => 'switch',
			'title'    => esc_html__( 'Feature image', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enable or Disable Feature Image ', 'cea-post-types') .'<a href="post-new.php?post_type=cea-portfolio" target="_blank">'. esc_html('portfolio here.') .'</a>',
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
			'required'	=> array( 'portfolio-layout-options', '=', 'custom-layout' )
		),
		array(
			'id'       => 'portfolio-default-metaitems',
			'type'     => 'switch',
			'title'    => esc_html__( 'Portfolio default metaitems', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enable meta items like date, client, category and socail share.', 'cea-post-types') .'<a href="post-new.php?post_type=cea-portfolio" target="_blank">'. esc_html('portfolio here.') .'</a>',
			'default'  => 1,
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
			'required'	=> array( 'portfolio-layout-options', '=', 'custom-layout' )
		),
		// array(
		// 	'id' 	   => 'cpt-portfolio-labelname',
		// 	'type'     => 'text',
		// 	'title'    => esc_html__( 'Portfolio Label Name', 'cea-post-types'),
		// 	'desc' 	   => esc_html__( 'Name to be displayed as Portfolio Label name. Page must be refreshed to see changes. ', 'cea-post-types') .'<a href="admin.php?page=classic-addons-widgets">'. esc_html__( 'Refresh?', 'cea-post-types' ) .'</a>',
		// 	'default'  => 'Portfolio'
		// ),
		array(
			'id'      => 'portfolio-meta-items',
			'type'    => 'dragdrop',
			'title'   => esc_html__( 'Portfolio Meta Items', 'cea-post-types' ),
			'desc'    => esc_html__( 'Needed portfolio meta items drag from disabled and put enabled part.', 'cea-post-types' ),
			'options' => array(
				'Enabled'  => array(
					'date'		=> esc_html__( 'Date', 'cea-post-types' ),
					'client'	=> esc_html__( 'Client', 'cea-post-types' ),
					'category'	=> esc_html__( 'Category', 'cea-post-types' ),
					'share'		=> esc_html__( 'Share', 'cea-post-types' ),
				),
				'disabled' => array(
					'duration'	=> esc_html__( 'Duration', 'cea-post-types' ),
					'url'		=> esc_html__( 'URL', 'cea-post-types' ),
					'place'		=> esc_html__( 'Place', 'cea-post-types' ),
					'estimation'=> esc_html__( 'Estimation', 'cea-post-types' ),
				)
			), 
		),
		array(
			'id'       => 'portfolio-client-label',
			'type'     => 'text',
			'title'    => esc_html__( 'Client', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enter portfolio client label.', 'cea-post-types' ),
			'default'  => esc_html__( 'Client', 'cea-post-types' )
		),
		array(
			'id'       => 'portfolio-type-label',
			'type'     => 'text',
			'title'    => esc_html__( 'Type', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enter portfolio type label.', 'cea-post-types' ),
			'default'  => esc_html__( 'Portfolio Type', 'cea-post-types' )
		),
		array(
			'id'       => 'portfolio-date-label',
			'type'     => 'text',
			'title'    => esc_html__( 'Date', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enter portfolio date label.', 'cea-post-types' ),
			'default'  => esc_html__( 'Date', 'cea-post-types' )
		),
		array(
			'id'       => 'portfolio-duration-label',
			'type'     => 'text',
			'title'    => esc_html__( 'Duration', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enter portfolio duration label.', 'cea-post-types' ),
			'default'  => esc_html__( 'Duration', 'cea-post-types' )
		),
		array(
			'id'       => 'portfolio-estimation-label',
			'type'     => 'text',
			'title'    => esc_html__( 'Estimation', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enter portfolio estimation label.', 'cea-post-types' ),
			'default'  => esc_html__( 'Estimation', 'cea-post-types' )
		),
		array(
			'id'       => 'portfolio-place-label',
			'type'     => 'text',
			'title'    => esc_html__( 'Place', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enter portfolio place label.', 'cea-post-types' ),
			'default'  => esc_html__( 'Place', 'cea-post-types' )
		),
		array(
			'id'       => 'portfolio-url-label',
			'type'     => 'text',
			'title'    => esc_html__( 'URL', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enter portfolio URL label.', 'cea-post-types' ),
			'default'  => esc_html__( 'URL', 'cea-post-types' )
		),
		array(
			'id'       => 'portfolio-category-label',
			'type'     => 'text',
			'title'    => esc_html__( 'Category', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enter portfolio category label.', 'cea-post-types' ),
			'default'  => esc_html__( 'Category', 'cea-post-types' )
		),
		array(
			'id'       => 'portfolio-share-label',
			'type'     => 'text',
			'title'    => esc_html__( 'Share', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enter portfolio share label.', 'cea-post-types' ),
			'default'  => esc_html__( 'Share', 'cea-post-types' )
		),
		array(
			'id'       => 'portfolio-grid-cols',
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
			'id'       => 'portfolio-grid-gutter',
			'type'     => 'text',
			'title'    => esc_html__( 'Portfolio Grid Gutter', 'cea-post-types' ),
			'desc' => esc_html__( 'Enter grid gutter size. Example 20.', 'cea-post-types' ),
			'default'  => '20'
		),
		array(
			'id'       => 'portfolio-grid-type',
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
			'id'       => 'cpt-portfolio-sidebars',
			'type'     => 'select',
			'title'    => esc_html__( 'Portfolio Sidebar', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select single portfolio sidebar.', 'cea-post-types' ),
			'sidebars'  => true
		),
		array(
			'id'       => 'portfolio-related-opt',
			'type'     => 'select',
			'title'    => esc_html__( 'Related Slider', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enable/Disable portfolio related slider.', 'cea-post-types' ),
			'options'  => array(
				'en'		=> esc_html__( 'Enable', 'cea-post-types' ),
				'dis'		=> esc_html__( 'Disable', 'cea-post-types' ),
			),
			'default'  => 'dis'
		),
		array(
			'id'       => 'portfolio-related-slide-items',
			'type'     => 'select',
			'title'    => esc_html__( 'Related Slide Items', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select related slide columns.', 'cea-post-types' ),
			'options'  => array(
				'6'		=> esc_html__( '6 Columns', 'cea-post-types' ),
				'5'		=> esc_html__( '5 Columns', 'cea-post-types' ),
				'4'		=> esc_html__( '4 Columns', 'cea-post-types' ),
				'3'		=> esc_html__( '3 Columns', 'cea-post-types' ),
				'2'		=> esc_html__( '2 Columns', 'cea-post-types' )
			),
			'default'  => '4',
			'required'	=> array( 'portfolio-related-opt', '=', 'en' )
		),
		array(
			'id'       => 'portfolio-related-slide-tab-items',
			'type'     => 'select',
			'title'    => esc_html__( 'Related Slide Items on Tab', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select related slide columns on tab.', 'cea-post-types' ),
			'options'  => array(
				'6'		=> esc_html__( '6 Columns', 'cea-post-types' ),
				'5'		=> esc_html__( '5 Columns', 'cea-post-types' ),
				'4'		=> esc_html__( '4 Columns', 'cea-post-types' ),
				'3'		=> esc_html__( '3 Columns', 'cea-post-types' ),
				'2'		=> esc_html__( '2 Columns', 'cea-post-types' ),
				'1'		=> esc_html__( '1 Column', 'cea-post-types' )
			),
			'default'  => '2',
			'required'	=> array( 'portfolio-related-opt', '=', 'en' )
		),
		array(
			'id'       => 'portfolio-related-slide-mobile-items',
			'type'     => 'select',
			'title'    => esc_html__( 'Related Slide Items on Mobile', 'cea-post-types' ),
			'desc'     => esc_html__( 'Select related slide columns on mobile.', 'cea-post-types' ),
			'options'  => array(
				'4'		=> esc_html__( '4 Columns', 'cea-post-types' ),
				'3'		=> esc_html__( '3 Columns', 'cea-post-types' ),
				'2'		=> esc_html__( '2 Columns', 'cea-post-types' ),
				'1'		=> esc_html__( '1 Column', 'cea-post-types' )
			),
			'default'  => '1',
			'required'	=> array( 'portfolio-related-opt', '=', 'en' )
		),
		array(
			'id'       => 'portfolio-related-slide-loop',
			'type'     => 'switch',
			'title'    => esc_html__( 'Related Slider Loop', 'cea-post-types' ),
			'desc'     => esc_html__( 'Enable/Disable portfolio related slider loop.', 'cea-post-types' ),
			'default'  => 'off',
			'on'       => esc_html__( 'Enable', 'cea-post-types' ),
			'off'      => esc_html__( 'Disable', 'cea-post-types' ),
		),
		array(
			'id'       => 'portfolio-related-slide-margin',
			'type'     => 'text',
			'title'    => esc_html__( 'Related Slider Margin', 'cea-post-types' ),
			'desc' => esc_html__( 'Enable/Disable portfolio related slider margin space. Example 10', 'cea-post-types' ),
			'default'  => '10'
		)
	)
) );