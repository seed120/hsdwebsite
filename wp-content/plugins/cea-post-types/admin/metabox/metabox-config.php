<?php

$cea_shortcodes = get_option( 'cea_shortcodes' );
// Portfolio Options
if( isset( $cea_shortcodes['portfolio'] ) ){
	$prefix = 'cea_portfolio_';
	$portfolio_fields = array(
		array( 
			'label'	=> esc_html__( 'Portfolio General Settings', 'cea-post-types' ),
			'desc'	=> esc_html__( 'These all are single portfolio general settings.', 'cea-post-types' ), 
			'tab'	=> esc_html__( 'Portfolio', 'cea-post-types' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Sticky Column', 'cea-post-types' ),
			'id'	=> $prefix.'sticky',
			'tab'	=> esc_html__( 'Portfolio', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'none' => esc_html__( 'None', 'cea-post-types' ),
				'right' => esc_html__( 'Right Column', 'cea-post-types' ),
				'left' => esc_html__( 'Left Column', 'cea-post-types' )
			),
			'default'	=> 'none'		
		),
		array( 
			'label'	=> esc_html__( 'Portfolio Format', 'cea-post-types' ),
			'id'	=> $prefix.'format',
			'tab'	=> esc_html__( 'Portfolio', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'standard' => esc_html__( 'Standard', 'cea-post-types' ),
				'video' => esc_html__( 'Video', 'cea-post-types' ),
				'audio' => esc_html__( 'Audio', 'cea-post-types' ),
				'gallery' => esc_html__( 'Gallery', 'cea-post-types' ),
				'gmap' => esc_html__( 'Google Map', 'cea-post-types' ),
				'360' => esc_html__( '360 Degree', 'cea-post-types' )
			),
			'default'	=> 'standard'		
		),
		array( 
			'label'	=> esc_html__( 'Portfolio Meta Items Options', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Choose portfolio meta items option.', 'cea-post-types' ), 
			'id'	=> $prefix.'items_opt',
			'tab'	=> esc_html__( 'Portfolio', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'theme-default' => esc_html__( 'Theme Default', 'cea-post-types' ),
				'custom' => esc_html__( 'Custom', 'cea-post-types' )
			),
			'default'	=> 'theme-default'
		),
		array( 
			'label'	=> esc_html__( 'Portfolio Meta Items', 'cea-post-types' ),
			'desc'	=> esc_html__( 'These all are meta items for portfolio. drag and drop needed items from disabled part to enabled.', 'cea-post-types' ), 
			'tab'	=> esc_html__( 'Portfolio', 'cea-post-types' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'items',
			'dd_fields' => array ( 
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
			'required'	=> array( $prefix.'items_opt', 'custom' )
		),
		array( 
			'label'	=> esc_html__( 'Custom Redirect URL', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter url for custom webpage redirection. This link only for portfolio archive layout not for single portfolio.', 'cea-post-types' ), 
			'id'	=> $prefix.'custom_url',
			'tab'	=> esc_html__( 'Portfolio', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Custom Redirect URL Target', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Choose custom url page navigate to blank or same page.', 'cea-post-types' ), 
			'id'	=> $prefix.'custom_url_target',
			'tab'	=> esc_html__( 'Portfolio', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'_blank' => esc_html__( 'Blank', 'cea-post-types' ),
				'_self' => esc_html__( 'Self', 'cea-post-types' )
			),
			'default'	=> '_blank'
		),
		array( 
			'label'	=> esc_html__( 'Portfolio Date', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Choose/Enter portfolio date.', 'cea-post-types' ), 
			'id'	=> $prefix.'date',
			'tab'	=> esc_html__( 'Info', 'cea-post-types' ),
			'type'	=> 'date',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Date Format', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter date format to show selcted portfolio date. Example: F j, Y', 'cea-post-types' ), 
			'id'	=> $prefix.'date_format',
			'tab'	=> esc_html__( 'Info', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> 'F j, Y'
		),
		array( 
			'label'	=> esc_html__( 'Client Name', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter client name.', 'cea-post-types' ), 
			'id'	=> $prefix.'client_name',
			'tab'	=> esc_html__( 'Info', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Duration', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter duration years or months.', 'cea-post-types' ), 
			'id'	=> $prefix.'duration',
			'tab'	=> esc_html__( 'Info', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Estimation', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter project estimation.', 'cea-post-types' ), 
			'id'	=> $prefix.'estimation',
			'tab'	=> esc_html__( 'Info', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Place', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter project place.', 'cea-post-types' ), 
			'id'	=> $prefix.'place',
			'tab'	=> esc_html__( 'Info', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'URL', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter project URL.', 'cea-post-types' ), 
			'id'	=> $prefix.'url',
			'tab'	=> esc_html__( 'Info', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		//Portfolio Format
		array( 
			'label'	=> esc_html__( 'Video', 'cea-post-types' ),
			'desc'	=> esc_html__( 'This part for if you choosed video format, then you must choose video type and give video id.', 'cea-post-types' ), 
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Video Modal', 'cea-post-types' ),
			'id'	=> $prefix.'video_modal',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'onclick' => esc_html__( 'On Click Run Video', 'cea-post-types' ),
				'overlay' => esc_html__( 'Modal Box Video', 'cea-post-types' ),
				'direct' => esc_html__( 'Direct Video', 'cea-post-types' )
			),
			'default'	=> 'direct'
		),
		array( 
			'label'	=> esc_html__( 'Video Type', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Choose video type.', 'cea-post-types' ), 
			'id'	=> $prefix.'video_type',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'' => esc_html__( 'None', 'cea-post-types' ),
				'youtube' => esc_html__( 'Youtube', 'cea-post-types' ),
				'vimeo' => esc_html__( 'Vimeo', 'cea-post-types' ),
				'custom' => esc_html__( 'Custom Video', 'cea-post-types' )
			),
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Video ID', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter Video ID Example: ZSt9tm3RoUU. If you choose custom video type then you enter custom video url and video must be mp4 format.', 'cea-post-types' ), 
			'id'	=> $prefix.'video_id',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'type'	=> 'line',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' )
		),
		array( 
			'label'	=> esc_html__( 'Audio', 'cea-post-types' ),
			'desc'	=> esc_html__( 'This part for if you choosed audio format, then you must give audio id.', 'cea-post-types' ), 
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Audio Type', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Choose audio type.', 'cea-post-types' ), 
			'id'	=> $prefix.'audio_type',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'' => esc_html__( 'None', 'cea-post-types' ),
				'soundcloud' => esc_html__( 'Soundcloud', 'cea-post-types' ),
				'custom' => esc_html__( 'Custom Audio', 'cea-post-types' )
			),
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Audio ID', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter soundcloud audio ID. Example: 315307209.', 'cea-post-types' ), 
			'id'	=> $prefix.'audio_id',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'type'	=> 'line',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' )
		),
		array( 
			'label'	=> esc_html__( 'Gallery', 'cea-post-types' ),
			'desc'	=> esc_html__( 'This part for if you choosed gallery format, then you must choose gallery images here.', 'cea-post-types' ), 
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Gallery Modal', 'cea-post-types' ),
			'id'	=> $prefix.'gallery_modal',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'default' => esc_html__( 'Default Gallery', 'cea-post-types' ),
				'normal' => esc_html__( 'Normal Gallery', 'cea-post-types' ),
				'grid' => esc_html__( 'Grid/Masonry Gallery', 'cea-post-types' )
			),
			'default'	=> 'default'
		),
		array( 
			'label'	=> esc_html__( 'Grid Gutter Size', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter gallery grid gutter size. Example 20', 'cea-post-types' ), 
			'id'	=> $prefix.'grid_gutter',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> '',
			'required'	=> array( $prefix.'gallery_modal', 'grid' )
		),
		array( 
			'label'	=> esc_html__( 'Grid Columns', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter gallery grid columns count. Example 2', 'cea-post-types' ), 
			'id'	=> $prefix.'grid_cols',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> '',
			'required'	=> array( $prefix.'gallery_modal', 'grid' )
		),
		array( 
			'label'	=> esc_html__( 'Choose Gallery Images', 'cea-post-types' ),
			'id'	=> $prefix.'gallery',
			'type'	=> 'gallery',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' )
		),
		array( 
			'type'	=> 'line',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' )
		),
		array( 
			'label'	=> esc_html__( 'Google Map', 'cea-post-types' ),
			'desc'	=> esc_html__( 'This part for if you choosed google map format, then you must give google map lat, lang and map style.', 'cea-post-types' ), 
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( 'Google Map Latitude', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter google latitude.', 'cea-post-types' ), 
			'id'	=> $prefix.'gmap_latitude',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Map Longitude', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter google longitude.', 'cea-post-types' ), 
			'id'	=> $prefix.'gmap_longitude',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Map Marker URL', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter google map custom marker url.', 'cea-post-types' ), 
			'id'	=> $prefix.'gmap_marker',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Map Style', 'cea-post-types' ),
			'id'	=> $prefix.'gmap_style',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'standard' => esc_html__( 'Standard', 'cea-post-types' ),
				'silver' => esc_html__( 'Silver', 'cea-post-types' ),
				'retro' => esc_html__( 'Retro', 'cea-post-types' ),
				'dark' => esc_html__( 'Dark', 'cea-post-types' ),
				'night' => esc_html__( 'Night', 'cea-post-types' ),
				'aubergine' => esc_html__( 'Aubergine', 'cea-post-types' )
			),
			'default'	=> 'standard'
		),
		array( 
			'type'	=> 'line',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' )
		),
		array( 
			'label'	=> esc_html__( '360 Degree', 'cea-post-types' ),
			'desc'	=> esc_html__( 'This part for if you choosed 360 degree format.', 'cea-post-types' ), 
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'label'
		),
		array( 
			'label'	=> esc_html__( '360 Degree Image', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Choose 360 degree image.', 'cea-post-types' ), 
			'id'	=> $prefix.'360_degree',
			'tab'	=> esc_html__( 'Format', 'cea-post-types' ),
			'type'	=> 'image',
			'default'	=> ''
		),
	);
	// CPT Portfolio Options
	$portfolio_box = new CEA_Custom_Add_Meta_Box( 'cea_portfolio_metabox', esc_html__( 'CEA Portfolio Options', 'cea-post-types' ), $portfolio_fields, 'cea-portfolio', true );
}

if( isset( $cea_shortcodes['team'] ) ){
	$prefix = 'cea_team_';
	$team_fields = array(	
		array( 
			'label'	=> esc_html__( 'Member Designation', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter member designation.', 'cea-post-types' ), 
			'id'	=> $prefix.'designation',
			'tab'	=> esc_html__( 'Team', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Member Email', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter member email.', 'cea-post-types' ), 
			'id'	=> $prefix.'email',
			'tab'	=> esc_html__( 'Team', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Member Phone', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter member phone number.', 'cea-post-types' ), 
			'id'	=> $prefix.'phone',
			'tab'	=> esc_html__( 'Team', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Member Website', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter member website.', 'cea-post-types' ), 
			'id'	=> $prefix.'website',
			'tab'	=> esc_html__( 'Team', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Member Experience', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter member experience.', 'cea-post-types' ), 
			'id'	=> $prefix.'experience',
			'tab'	=> esc_html__( 'Team', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Link Target', 'cea-post-types' ),
			'id'	=> $prefix.'link_target',
			'tab'	=> esc_html__( 'Social', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'_blank' => esc_html__( 'New Window', 'cea-post-types' ),
				'_self' => esc_html__( 'Self Window', 'cea-post-types' )
			),
			'default'	=> '_blank'
		),
		array( 
			'label'	=> esc_html__( 'Facebook', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Facebook profile link.', 'cea-post-types' ), 
			'id'	=> $prefix.'facebook',
			'tab'	=> esc_html__( 'Social', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Twitter', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Twitter profile link.', 'cea-post-types' ), 
			'id'	=> $prefix.'twitter',
			'tab'	=> esc_html__( 'Social', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Instagram', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Instagram profile link.', 'cea-post-types' ), 
			'id'	=> $prefix.'instagram',
			'tab'	=> esc_html__( 'Social', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Linkedin', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Linkedin profile link.', 'cea-post-types' ), 
			'id'	=> $prefix.'linkedin',
			'tab'	=> esc_html__( 'Social', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Pinterest', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Pinterest profile link.', 'cea-post-types' ), 
			'id'	=> $prefix.'pinterest',
			'tab'	=> esc_html__( 'Social', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Dribbble', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Dribbble profile link.', 'cea-post-types' ), 
			'id'	=> $prefix.'dribbble',
			'tab'	=> esc_html__( 'Social', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Flickr', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Flickr profile link.', 'cea-post-types' ), 
			'id'	=> $prefix.'flickr',
			'tab'	=> esc_html__( 'Social', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Youtube', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Youtube profile link.', 'cea-post-types' ), 
			'id'	=> $prefix.'youtube',
			'tab'	=> esc_html__( 'Social', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Vimeo', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Vimeo profile link.', 'cea-post-types' ), 
			'id'	=> $prefix.'vimeo',
			'tab'	=> esc_html__( 'Social', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		)
	);
	
	// CPT Team Options
	$team_box = new CEA_Custom_Add_Meta_Box( 'cea_team_metabox', esc_html__( 'CEA Team Options', 'cea-post-types' ), $team_fields, 'cea-team', true );
}

if( isset( $cea_shortcodes['team'] ) ){
	$prefix = 'cea_event_';
	$event_fields = array(	
		array( 
			'label'	=> esc_html__( 'Event Organiser Name', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter event organiser name.', 'cea-post-types' ), 
			'id'	=> $prefix.'organiser_name',
			'tab'	=> esc_html__( 'Events', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Event Organiser Designation', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter event organiser designation.', 'cea-post-types' ), 
			'id'	=> $prefix.'organiser_designation',
			'tab'	=> esc_html__( 'Events', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Event Start Date', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter event start date.', 'cea-post-types' ), 
			'id'	=> $prefix.'start_date',
			'tab'	=> esc_html__( 'Events', 'cea-post-types' ),
			'type'	=> 'date',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Event End Date', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter event end date.', 'cea-post-types' ), 
			'id'	=> $prefix.'end_date',
			'tab'	=> esc_html__( 'Events', 'cea-post-types' ),
			'type'	=> 'date',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Date Format', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter date format to show selcted event date. Example: F j, Y', 'cea-post-types' ), 
			'id'	=> $prefix.'date_format',
			'tab'	=> esc_html__( 'Events', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> 'F j, Y'
		),
		array( 
			'label'	=> esc_html__( 'Event Start Time', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter event start time.', 'cea-post-types' ), 
			'id'	=> $prefix.'time',
			'tab'	=> esc_html__( 'Events', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Event Cost', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter event cost.', 'cea-post-types' ), 
			'id'	=> $prefix.'cost',
			'tab'	=> esc_html__( 'Events', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Custom Link for Event Item', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter custom link to redirect custom event page.', 'cea-post-types' ), 
			'id'	=> $prefix.'link',
			'tab'	=> esc_html__( 'Events', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Custom Link Target', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Choose custom link target to new window or self window.', 'cea-post-types' ), 
			'id'	=> $prefix.'link_target',
			'tab'	=> esc_html__( 'Events', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'_blank' => esc_html__( 'New Window', 'cea-post-types' ),
				'_self' => esc_html__( 'Self Window', 'cea-post-types' )
			),
			'default'	=> '_blank'
		),
		array( 
			'label'	=> esc_html__( 'Custom Link Button Text', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter custom link buttom text: Example More About Event.', 'cea-post-types' ), 
			'id'	=> $prefix.'link_text',
			'tab'	=> esc_html__( 'Events', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Venue Name', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter event venue name.', 'cea-post-types' ), 
			'id'	=> $prefix.'venue_name',
			'tab'	=> esc_html__( 'Address', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Venue Address', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter event venue address.', 'cea-post-types' ), 
			'id'	=> $prefix.'venue_address',
			'tab'	=> esc_html__( 'Address', 'cea-post-types' ),
			'type'	=> 'textarea',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'E-mail', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter email id for clarification about event.', 'cea-post-types' ), 
			'id'	=> $prefix.'email',
			'tab'	=> esc_html__( 'Address', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Phone', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter phone number for contact about event.', 'cea-post-types' ), 
			'id'	=> $prefix.'phone',
			'tab'	=> esc_html__( 'Address', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Website', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter event website.', 'cea-post-types' ), 
			'id'	=> $prefix.'website',
			'tab'	=> esc_html__( 'Address', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Latitude', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter map latitude.', 'cea-post-types' ), 
			'id'	=> $prefix.'gmap_latitude',
			'tab'	=> esc_html__( 'GMap', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Longitude', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter map longitude.', 'cea-post-types' ), 
			'id'	=> $prefix.'gmap_longitude',
			'tab'	=> esc_html__( 'GMap', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Map Marker URL', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter google map custom marker url.', 'cea-post-types' ), 
			'id'	=> $prefix.'gmap_marker',
			'tab'	=> esc_html__( 'GMap', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Google Map Style', 'cea-post-types' ),
			'id'	=> $prefix.'gmap_style',
			'tab'	=> esc_html__( 'GMap', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'standard' => esc_html__( 'Standard', 'cea-post-types' ),
				'silver' => esc_html__( 'Silver', 'cea-post-types' ),
				'retro' => esc_html__( 'Retro', 'cea-post-types' ),
				'dark' => esc_html__( 'Dark', 'cea-post-types' ),
				'night' => esc_html__( 'Night', 'cea-post-types' ),
				'aubergine' => esc_html__( 'Aubergine', 'cea-post-types' )
			),
			'default'	=> 'standard'
		),
		array( 
			'label'	=> esc_html__( 'Google Map Height', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter map height in values. Example 400', 'cea-post-types' ), 
			'id'	=> $prefix.'gmap_height',
			'tab'	=> esc_html__( 'GMap', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> '400'
		),
		array( 
			'label'	=> esc_html__( 'Contact Form', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Contact form shortcode here.', 'cea-post-types' ), 
			'id'	=> $prefix.'contact_form',
			'tab'	=> esc_html__( 'Contact', 'cea-post-types' ),
			'type'	=> 'textarea',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Event Info Columns', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter column division values like given format. Example 3-3-6', 'cea-post-types' ), 
			'id'	=> $prefix.'col_layout',
			'tab'	=> esc_html__( 'Layout', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> '3-3-6'
		),
		array( 
			'label'	=> esc_html__( 'Event Detail Items', 'cea-post-types' ),
			'desc'	=> esc_html__( 'This is layout settings for event.', 'cea-post-types' ), 
			'tab'	=> esc_html__( 'Layout', 'cea-post-types' ),
			'type'	=> 'dragdrop_multi',
			'id'	=> $prefix.'event_info_items',
			'dd_fields' => array ( 
				'Enable'  => array(
					'event-details' => esc_html__( 'Event Details', 'cea-post-types' ),
					'event-venue' => esc_html__( 'Event Venue', 'cea-post-types' ),
					'event-map' => esc_html__( 'Event Map', 'cea-post-types' )
				),
				'disabled' => array(
					'event-form'	=> esc_html__( 'Event Form', 'cea-post-types' ),
				)
			),
		),
		array( 
			'label'	=> esc_html__( 'Navigation', 'cea-post-types' ),
			'id'	=> $prefix.'nav_position',
			'tab'	=> esc_html__( 'Layout', 'cea-post-types' ),
			'type'	=> 'select',
			'options' => array ( 
				'top' => esc_html__( 'Top', 'cea-post-types' ),
				'bottom' => esc_html__( 'Bottom', 'cea-post-types' )
			),
			'default'	=> 'top'
		),
	);
	
	// CPT Events Options
	$event_box = new CEA_Custom_Add_Meta_Box( 'cea_event_metabox', esc_html__( 'CEA Event Options', 'cea-post-types' ), $event_fields, 'cea-event', true );
}
	
if( isset( $cea_shortcodes['testimonial'] ) ){
	$prefix = 'cea_testimonial_';
	$testimonial_fields = array(	
		array( 
			'label'	=> esc_html__( 'Review Title', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter review title.', 'cea-post-types' ), 
			'id'	=> $prefix.'review_title',
			'tab'	=> esc_html__( 'Testimonial', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Author Designation', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter author designation.', 'cea-post-types' ), 
			'id'	=> $prefix.'designation',
			'tab'	=> esc_html__( 'Testimonial', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Company Name', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter company name.', 'cea-post-types' ), 
			'id'	=> $prefix.'company_name',
			'tab'	=> esc_html__( 'Testimonial', 'cea-post-types' ),
			'type'	=> 'text',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Company URL', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Enter company URL.', 'cea-post-types' ), 
			'id'	=> $prefix.'company_url',
			'tab'	=> esc_html__( 'Testimonial', 'cea-post-types' ),
			'type'	=> 'url',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Rating', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Set user rating.', 'cea-post-types' ), 
			'id'	=> $prefix.'rating',
			'tab'	=> esc_html__( 'Testimonial', 'cea-post-types' ),
			'type'	=> 'rating',
			'default'	=> ''
		),
		array( 
			'label'	=> esc_html__( 'Company Logo Image', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Choose service image for show front.', 'cea-post-types' ), 
			'id'	=> $prefix.'logo',
			'tab'	=> esc_html__( 'Testimonial', 'cea-post-types' ),
			'type'	=> 'image',
			'default'	=> ''
		)
	);
	
	// CPT Testimonial Options
	$testimonial_box = new CEA_Custom_Add_Meta_Box( 'cea_testimonial_metabox', esc_html__( 'CEA Testimonial Options', 'cea-post-types' ), $testimonial_fields, 'cea-testimonial', true );
}

if( isset( $cea_shortcodes['service'] ) ){
	$prefix = 'cea_service_';
	$service_fields = array(	
		array( 
			'label'	=> esc_html__( 'Service Image', 'cea-post-types' ),
			'desc'	=> esc_html__( 'Choose service image for show front.', 'cea-post-types' ), 
			'id'	=> $prefix.'title_img',
			'tab'	=> esc_html__( 'Service', 'cea-post-types' ),
			'type'	=> 'image',
			'default'	=> ''
		)
	);
	
	// CPT Service Options
	$service_box = new CEA_Custom_Add_Meta_Box( 'cea_service_metabox', esc_html__( 'CEA Service Options', 'cea-post-types' ), $service_fields, 'cea-service', true );
}