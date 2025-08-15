<?php

Hirxpert_Options::$hirxpert_options = get_post_meta( get_the_ID(), 'hirxpert_post_meta', true );

// General
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'General', 'hirxpert-addon' ),
	'id'         => 'general-tab',
	'config_id'  => '',
) );

Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Site General', 'hirxpert-addon' ),
	'id'         => 'site-general',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'general-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Site General Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit site general settings options.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'site-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Site Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose site layout either wide or boxed.', 'hirxpert-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-boxed.png'
				),
				'wider' => array(
					'title' => esc_html__( 'Wider', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-wider.png'
				)
			),
			'default' => 'wide',
			'required'		=> array( 'general-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'content-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Content Padding', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Assign content padding. If need no padding means just leave this empty. Example 10 10 10 10', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'general-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-slider',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Header Slider', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Enter shortcode for header slider.', 'hirxpert-addon' ),
			'default'		=> '',
		)		
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Logo Settings', 'hirxpert-addon' ),
	'id'         => 'site-logo',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'logo-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Site General Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit site logo settings options.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'logo-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Logo Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is settings for site logo.', 'hirxpert-addon' ),
			'seperator'		=> 'after',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'site-logo',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Default Logo', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose site logo image.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'site-logo-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Site Logo Maximum Width', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is maximum width of logo. if you want original width leave this field empty.', 'hirxpert-addon' ),
			'only_dimension' => 'width',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'site-logo-desc',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable Site Logo Description', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is logo description options for this site. You can enable or disable.', 'hirxpert-addon' ),
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'sticky-logo',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Sticky Logo', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose site sticky logo image.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'sticky-logo-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Sticky Logo Maximum Width', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is maximum width of sticky logo. if you want original width leave this field empty.', 'hirxpert-addon' ),
			'only_dimension' => 'width',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'mobile-logo',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Mobile Logo', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose site mobile logo image.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'mobile-logo-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Mobile Logo Maximum Width', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is maximum width of mobile logo. if you want original width leave this field empty.', 'hirxpert-addon' ),
			'only_dimension' => 'width',
			'required'		=> array( 'logo-chk', '=', array( 'custom' ) )
		),
	)
) );

Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'general-tab-end'	
));

$hirxpert_menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
$hirxpert_nav_menus = array( "none" => esc_html__( "None", "hirxpert-addon" ) );
foreach( $hirxpert_menus as $menu ){
	$hirxpert_nav_menus[$menu->slug] = $menu->name;
}

// Header
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Site Header', 'hirxpert-addon' ),
	'id'         => 'header-tab',
	'config_id'  => '',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'General', 'hirxpert-addon' ),
	'id'         => 'header-general',
	'fields'	 => array(
		array(
			'id'			=> 'header-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header settings options.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'header-one-page-menu',
			'type'			=> 'select',
			'title'			=> esc_html__( 'One Page Menu', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header settings options.', 'hirxpert-addon' ),
			'choices'		=> $hirxpert_nav_menus,
			'default'		=> 'none'
		),
		array(
			'id'			=> 'header-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Header Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose header layout either wide or boxed.', 'hirxpert-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-wide.png'
				),
				'wider' => array(
					'title' => esc_html__( 'Wider', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-wider.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/header/header-boxed.png'
				)
			),
			'default' => 'wide',
			'required'		=> array( 'header-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Header Bars', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These are header items. Drag which items you want to display normal and sticky.', 'hirxpert-addon' ),
			'default'		=> array(
				'normal' => array(
					'topbar' => esc_html__( 'Header Top', 'hirxpert-addon' ),
					'logobar' => esc_html__( 'Header Middle', 'hirxpert-addon' )
				),
				'sticky' => array(
					'navbar' => esc_html__( 'Header Bottom', 'hirxpert-addon' )
				),
				'disabled' => array(
				)
			),
			'required'		=> array( 'header-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-absolute',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Header Absolute', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Enable/Disable header absolute. Like floating on slider', 'hirxpert-addon' ),
			'default'		=> false,
			'required'		=> array( 'header-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'search-type',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Search Toggle Modal', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Slect search box type', 'hirxpert-addon' ),
			'choices'		=> array(
				'1'	=> esc_html__( 'Full Screen Search', 'hirxpert-addon' ),
				'2' => esc_html__( 'Text Box Toggle Search', 'hirxpert-addon' ),
				'3' => esc_html__( 'Full Bar Toggle Search', 'hirxpert-addon' ),
				'4' => esc_html__( 'Bottom Seach Box Toggle', 'hirxpert-addon' )
			),
			'default'		=> '1',
			'required'		=> array( 'header-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Styles', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-style-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Style Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header style settings options.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'header-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Header Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Background Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is background setting for header', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-border',
			'type'			=> 'border',
			'title'			=> esc_html__( 'Header Border', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is border setting for header', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Header padding', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is padding setting for header', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-margin',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Header margin', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is margin setting for header', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-style-chk', '=', array( 'custom' ) )
		)
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Header Top', 'hirxpert-addon' ),
	'id'         => 'header-topbar',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'header-topbar-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Top Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header top settings.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'            => 'topbar-items',
			'type'          => 'dragdrop-editor',
			'items'         => array(
				'custom-text-1' => array(
					'title'       => esc_html__( 'Custom Text 1', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    		=> 'topbar-custom-text-1',
							'type'  		=> 'textarea',
							'title' 		=> esc_html__( 'Custom Text 1', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Add the first custom text field displayed in the top bar of the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'custom-text-2' => array(
					'title'       => esc_html__( 'Custom Text 2 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'			=> 'topbar-custom-text-2',
							'type'			=> 'textarea',
							'title'			=> esc_html__( 'Custom Text 2', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Add the second custom text field displayed in the top bar of the site.', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable' => true,
				),
				'topbar-html-1' => array(
					'title'       => esc_html__( 'Html 1 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'topbar_html_1',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'topbar-html-2' => array(
					'title'       => esc_html__( 'Html 2 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'topbar_html_2',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'topbar-html-3' => array(
					'title'       => esc_html__( 'Html 3 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'topbar_html_3',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'topbar-html-4' => array(
					'title'       => esc_html__( 'Html 4 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'topbar_html_4',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'topbar-html-5' => array(
					'title'       => esc_html__( 'Html 5 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'topbar_html_5',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'topbar-spacer-1' => array(
					'title'		 => esc_html__( 'Spacer 1 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'topbar_spacer_1_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Spacer width', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),	
					'editable' => true,
				),
				'topbar-spacer-2' => array(
					'title'		 => esc_html__( 'Spacer 2 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'topbar_spacer_2_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Spacer width', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),
					'editable' => true,
				),
				'topbar-spacer-3' => array(
					'title'		 => esc_html__( 'Spacer 3 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'topbar_spacer_3_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Spacer width', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),	
					'editable' => true,
				),
				'topbar_delimiter1' => array(
					'title'		 => esc_html__( 'Delimiter 1 Editor', 'hirxpert-addon'),
					'description' => esc_html__( 'Adds a vertical bar (|) between elements to visually separate them.', 'hirxpert-addon' ),
					'fields'	 => array( 
						array(
							'id'		=> 'topbar_delimiter1_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'topbar_delimiter1_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'topbar_delimiter1_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description'   => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'topbar_delimiter1_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description'   => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable' => true,
				),
				'topbar_delimiter2' => array(
					'title'		 => esc_html__( 'Delimiter 2 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'topbar_delimiter2_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'topbar_delimiter2_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'topbar_delimiter2_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description'   => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'topbar_delimiter2_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description'   => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable' => true,
				),
				'topbar_delimiter3' => array(
					'title'		 => esc_html__( 'Delimiter 3 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'topbar_delimiter3_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'topbar_delimiter3_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'topbar_delimiter3_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description'   => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'topbar_delimiter3_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description'   => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable' => true,
				),
				'signin'	=> array(
					'title'		=> esc_html__( 'Sign in/register', 'hirxpert-addon' ),
					'fields'	=> array(
						array(
							'id'	=> 'signin-register',
							'type'	=> 'text',
							'title'	=> esc_html__( 'Enter Your shortcode','hirxpert-addon' ),
							'description'	=> esc_html__( 'Enter your login/ register shortcode here. Example: [contact-form-7 id="5ecf846" title="Event"].', 'hirxpert-addon' ),
						),
						array(
							'id'	=> 'signin-register-text',
							'type'	=> 'text',
							'title'	=> esc_html__( 'Sign in/Register Text', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Enter the text displayed for the login/register option on the site. Example: Login or Register.', 'hirxpert-addon' ),
						)
					),
					'editable' => true,
				),
			),
			'default'       => array(
				'left' => array(
					'custom-text-1' => esc_html__( 'Custom Text 1', 'hirxpert-addon' ),
				),
				'center' => array(
				),
				'right' => array(
				),
				'disabled' => array(
					'search' 		        => esc_html__( 'Search', 'hirxpert-addon' ),
					'social'	 			=> esc_html__( 'Social', 'hirxpert-addon' ),
					'address' 				=> esc_html__( 'Address', 'hirxpert-addon' ),
					'email' 				=> esc_html__( 'Email', 'hirxpert-addon' ),
					'signin' 	    		=> esc_html__( 'Signin/Register', 'hirxpert-addon' ),
					'custom-text-2'  		=> esc_html__( 'Custom Text 2', 'hirxpert-addon' ),
					'top-menu' 				=> esc_html__( 'Top Menu', 'hirxpert-addon' ),
					'topbar-spacer-1' 		=> esc_html__( 'Spacer 1', 'hirxpert-addon' ),
					'topbar-spacer-2'		=> esc_html__( 'Spacer 2', 'hirxpert-addon' ),
					'topbar-spacer-3'		=> esc_html__( 'Spacer 3', 'hirxpert-addon' ),
					'topbar-html-1' 		=> esc_html__( 'HTML 1', 'hirxpert-addon' ),
					'topbar-html-2'			=> esc_html__( 'HTML 2', 'hirxpert-addon' ),
					'topbar-html-3' 		=> esc_html__( 'HTML 3', 'hirxpert-addon' ),
					'topbar-html-4' 		=> esc_html__( 'HTML 4', 'hirxpert-addon' ),
					'topbar-html-5' 		=> esc_html__( 'HTML 5', 'hirxpert-addon' ),
					'topbar_delimiter1' 	=> esc_html__('|', 'hirxpert-addon'),
					'topbar_delimiter2' 	=> esc_html__('|', 'hirxpert-addon'),
					'topbar_delimiter3' 	=> esc_html__('|', 'hirxpert-addon'),
					'wpml_polylang'			=> esc_html__( 'WPML/Polylang', 'hirxpert-addon'),
				), 
			),
			'required'		=> array( 'header-topbar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Top Styles', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header top styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-topbar-style-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Top Style Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header top style settings.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'header-topbar-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Top Height', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is height property of header top.', 'hirxpert-addon' ),
			'only_dimension' => 'height',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-sticky-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Top Sticky Height', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is height property of header sticky topbar.', 'hirxpert-addon' ),
			'only_dimension' => 'height'
		),
		array(
			'id'			=> 'header-topbar-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Header Top Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header top', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Top Background Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is background setting for header top', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-border',
			'type'			=> 'border',
			'title'			=> esc_html__( 'Header Top Border', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is border setting for header top', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Header Top padding', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is padding setting for header top', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-margin',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Header Top margin', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is margin setting for header top', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),	
		array(
			'id'			=> 'header-topbar-sticky-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Top Sticky Styles', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header top sticky styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-sticky-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Header Top Sticky Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header top on sticky', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-topbar-sticky-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Top Sticky Background Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is background setting for header top on sticky', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-topbar-style-chk', '=', array( 'custom' ) )
		),	
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Header Middle', 'hirxpert-addon' ),
	'id'         => 'header-logobar',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'header-logobar-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Middle Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header middle settings.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'            => 'logobar-items',
			'type'          => 'dragdrop-editor',
			'items'         => array(
				'custom-text-1' => array(
					'title'       => esc_html__( 'Custom Text 1 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'logobar-custom-text-1',
							'type'  => 'textarea',
							'title' => esc_html__( 'Custom Text 1', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Add the first custom text field displayed in the Header Middle of the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'custom-text-2' => array(
					'title'       => esc_html__( 'Custom Text 2 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'			=> 'logobar-custom-text-2',
							'type'			=> 'textarea',
							'title'			=> esc_html__( 'Custom Text 2', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Add the second custom text field displayed in the Header Middle of the site.', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable' => true,
				),
				'logobar-html-1' => array(
					'title'       => esc_html__( 'Html 1 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    		=> 'logobar_html_1',
							'type'  		=> 'textarea',
							'title' 		=> esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'logobar-html-2' => array(
					'title'       => esc_html__( 'Html 2 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'logobar_html_2',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' => esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'logobar-html-3' => array(
					'title'       => esc_html__( 'Html 3 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'logobar_html_3',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' => esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'logobar-html-4' => array(
					'title'       => esc_html__( 'Html 4 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'logobar_html_4',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' => esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'logobar-html-5' => array(
					'title'       => esc_html__( 'Html 5 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'logobar_html_5',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' => esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'logobar-spacer-1' => array(
					'title'		 => esc_html__( 'Spacer 1 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'logobar_spacer_1_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Spacer Width', 'hirxpert-addon'),
							'description' => esc_html( 'Set the spacer width to control layout spacing.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),	
					'editable' => true,
				),
				'logobar-spacer-2' => array(
					'title'		 => esc_html__( 'Spacer 2 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'logobar_spacer_2_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Spacer Width', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),	
					'editable' => true,
				),
				'logobar-spacer-3' => array(
					'title'		 => esc_html__( 'Spacer 3 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'logobar_spacer_3_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Spacer Width', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),	
					'editable' => true,
				),
				'logobar_delimiter1' => array(
					'title'		 => esc_html__( 'Delimiter 1 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'logobar_delimiter1_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'logobar_delimiter1_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'logobar_delimiter1_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'logobar_delimiter1_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable' => true,
				),
				'logobar_delimiter2' => array(
					'title'		 => esc_html__( 'Delimiter 2 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'logobar_delimiter2_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'logobar_delimiter2_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'logobar_delimiter2_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'logobar_delimiter2_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable' => true,
				),
				'logobar_delimiter3' => array(
					'title'		 => esc_html__( 'Delimiter 3 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'logobar_delimiter3_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'logobar_delimiter3_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'logobar_delimiter3_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'logobar_delimiter3_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable' => true,
				),
				'signin'	=> array(
					'title'		=> esc_html__( 'Sign in/register', 'hirxpert-addon' ),
					'fields'	=> array(
						array(
							'id'	=> 'signin-register',
							'type'	=> 'text',
							'title'	=> esc_html__( 'Enter Your shortcode','hirxpert-addon' ),
							'description'	=> esc_html__( 'Enter your login/ register shortcode here. Example: [contact-form-7 id="5ecf846" title="Event"].', 'hirxpert-addon' ),
						),
						array(
							'id'	=> 'signin-register-text',
							'type'	=> 'text',
							'title'	=> esc_html__( 'Sign in/Register Text', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Enter the text displayed for the login/register option on the site. Example: Login or Register.', 'hirxpert-addon' ),
						)
					),
					'editable' => true,
				),
			),
			'default'       => array(
				'right' => array(
					'custom-text-1' => esc_html__( 'Custom Text 1', 'hirxpert-addon' ),
				),
				'center' => array(
				),
				'left' => array(
				),
				'disabled' => array(
					'logo' 					=> esc_html__( 'Logo', 'hirxpert-addon' ),
					'search'				=> esc_html__( 'Search', 'hirxpert-addon' ),
					'social'	 			=> esc_html__( 'Social', 'hirxpert-addon' ),
					'address' 				=> esc_html__( 'Address', 'hirxpert-addon' ),
					'email' 				=> esc_html__( 'Email', 'hirxpert-addon' ),
					'secondary-bar' 		=> esc_html__( 'Secondary Bar', 'hirxpert-addon' ),
					'signin' 				=> esc_html__( 'Signin/Register', 'hirxpert-addon' ),
					'custom-text-2'			=> esc_html__( 'Custom Text 2', 'hirxpert-addon' ),
					'primary-menu' 			=> esc_html__( 'Primary Menu', 'hirxpert-addon' ),
					'logobar-spacer-1' 		=> esc_html__( 'Spacer 1', 'hirxpert-addon' ),
					'logobar-spacer-2'		=> esc_html__( 'Spacer 2', 'hirxpert-addon' ),
					'logobar-spacer-3'		=> esc_html__( 'Spacer 3', 'hirxpert-addon' ),
					'logobar-html-1' 		=> esc_html__( 'HTML 1', 'hirxpert-addon' ),
					'logobar-html-2'		=> esc_html__( 'HTML 2', 'hirxpert-addon' ),
					'logobar-html-3' 		=> esc_html__( 'HTML 3', 'hirxpert-addon' ),
					'logobar-html-4' 		=> esc_html__( 'HTML 4', 'hirxpert-addon' ),
					'logobar-html-5' 		=> esc_html__( 'HTML 5', 'hirxpert-addon' ),
					'logobar_delimiter1' 	=> esc_html__( '|', 'hirxpert-addon'),
					'logobar_delimiter2' 	=> esc_html__( '|', 'hirxpert-addon'),
					'logobar_delimiter3' 	=> esc_html__( '|', 'hirxpert-addon'),
					'wpml_polylang'			=> esc_html__( 'WPML/Polylang', 'hirxpert-addon'),
				),
			),
			'required'		=> array( 'header-logobar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Middle Styles', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header middle styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-logobar-style-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Middle Style Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header middle bar style settings.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'header-logobar-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Middle Height', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is height property of header middle.', 'hirxpert-addon' ),
			'only_dimension' => 'height',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-sticky-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Middle Sticky Height', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is height property of header sticky logobar.', 'hirxpert-addon' ),
			'only_dimension' => 'height'
		),
		array(
			'id'			=> 'header-logobar-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Header Middle Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header middle', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Background Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is background setting for header middle', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-border',
			'type'			=> 'border',
			'title'			=> esc_html__( 'Header Middle Border', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is border setting for header middle', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Header Middle padding', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is padding setting for header middle', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-margin',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Header Middle margin', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is margin setting for header middle', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),	
		array(
			'id'			=> 'header-logobar-sticky-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Middle Sticky Styles', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header middle sticky styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-sticky-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Header Middle Sticky Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header middle on sticky', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-logobar-sticky-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Middle Sticky Background Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is background setting for header middle on sticky', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-logobar-style-chk', '=', array( 'custom' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Header Bottom', 'hirxpert-addon' ),
	'id'         => 'header-navbar',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'header-navbar-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Bottom Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit header navbar settings.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'            => 'navbar-items',
			'type'          => 'dragdrop-editor',
			'items'         => array(
				'custom-text-1' => array(
					'title'       => esc_html__('Custom Text 1 Editor', 'hirxpert-addon'),
					'fields'      => array(
						array(
							'id'    => 'navbar-custom-text-1',
							'type'  => 'textarea',
							'title' => esc_html__('Custom Text 1', 'hirxpert-addon'),
							'description'	=> esc_html__( 'Add the first custom text field displayed in the nav bar of the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'custom-text-2' => array(
					'title'       => esc_html__( 'Custom Text 2 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'			=> 'navbar-custom-text-2',
							'type'			=> 'textarea',
							'title'			=> esc_html__( 'Custom Text 2', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Add the second custom text field displayed in the nav bar of the site.', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable' => true,
				),
				'navbar-html-1' => array(
					'title'       => esc_html__( 'Html 1 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'navbar_html_1',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'navbar-html-2' => array(
					'title'       => esc_html__( 'Html 2 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'navbar_html_2',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'navbar-html-3' => array(
					'title'       => esc_html__( 'Html 3 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'navbar_html_3',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'navbar-html-4' => array(
					'title'       => esc_html__( 'Html 4 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'navbar_html_4',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'navbar-html-5' => array(
					'title'       => esc_html__( 'Html 5 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'navbar_html_5',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true,
				),
				'navbar-spacer-1' => array(
					'title'		 => esc_html__( 'Spacer 1 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'navbar_spacer_1_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Spacer Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),	
					'editable' => true,
				),
				'navbar-spacer-2' => array(
					'title'		 => esc_html__( 'Spacer 2 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'navbar_spacer_2_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Spacer Width', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),	
					'editable' => true,
				),
				'navbar-spacer-3' => array(
					'title'		 => esc_html__( 'Spacer 3 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'navbar_spacer_3_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Spacer Width', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),	
					'editable' => true,
				),
				'navbar_delimiter1' => array(
					'title'		 => esc_html__( 'Delimiter 1 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'navbar_delimiter1_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'navbar_delimiter1_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'navbar_delimiter1_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'navbar_delimiter1_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable' => true,
				),
				'navbar_delimiter2' => array(
					'title'		 => esc_html__( 'Delimiter 2 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'navbar_delimiter2_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'navbar_delimiter2_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'navbar_delimiter2_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'navbar_delimiter2_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable' => true,
				),
				'navbar_delimiter3' => array(
					'title'		 => esc_html__( 'Delimiter 3 Editor', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'navbar_delimiter3_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'navbar_delimiter3_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'navbar_delimiter3_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'navbar_delimiter3_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable' => true,
				),
				'signin'	=> array(
					'title'		=> esc_html__( 'Sign in/register', 'hirxpert-addon' ),
					'fields'	=> array(
						array(
							'id'	=> 'signin-register',
							'type'	=> 'text',
							'title'	=> esc_html__( 'Enter Your shortcode','hirxpert-addon' ),
							'description'	=> esc_html__( 'Enter your login/ register shortcode here. Example: [contact-form-7 id="5ecf846" title="Event"].', 'hirxpert-addon' ),
						),
						array(
							'id'	=> 'signin-register-text',
							'type'	=> 'text',
							'title'	=> esc_html__( 'Sign in/Register Text', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Enter the text displayed for the login/register option on the site. Example: Login or Register.', 'hirxpert-addon' ),
						)
					),
					'editable' => true,
				),
			),
			'default'       => array(
				'left' => array(
					'custom-text-1' => esc_html__( 'Custom Text 1', 'hirxpert-addon' ),
				),
				'center' => array(
				),
				'right' => array(
				),
				'disabled' => array(
					'logo' => esc_html__( 'Logo', 'hirxpert-addon' ),
					'search' => esc_html__( 'Search', 'hirxpert-addon' ),
					'social'	 	=> esc_html__( 'Social', 'hirxpert-addon' ),
					'address' 		=> esc_html__( 'Address', 'hirxpert-addon' ),
					'email' 		=> esc_html__( 'Email', 'hirxpert-addon' ),
					'secondary-bar' => esc_html__( 'Secondary Bar', 'hirxpert-addon' ),
					'signin' 		=> esc_html__( 'Signin/Register', 'hirxpert-addon' ),
					'custom-text-2' => esc_html__( 'Custom Text 2', 'hirxpert-addon' ),
					'primary-menu' 			=> esc_html__( 'Primary Menu', 'hirxpert-addon' ),
					'navbar-spacer-1' 		=> esc_html__( 'Spacer 1', 'hirxpert-addon' ),
					'navbar-spacer-2'		=> esc_html__( 'Spacer 2', 'hirxpert-addon' ),
					'navbar-spacer-3'		=> esc_html__( 'Spacer 3', 'hirxpert-addon' ),
					'navbar-html-1' 		=> esc_html__( 'HTML 1', 'hirxpert-addon' ),
					'navbar-html-2'			=> esc_html__( 'HTML 2', 'hirxpert-addon' ),
					'navbar-html-3' 		=> esc_html__( 'HTML 3', 'hirxpert-addon' ),
					'navbar-html-4' 		=> esc_html__( 'HTML 4', 'hirxpert-addon' ),
					'navbar-html-5' 		=> esc_html__( 'HTML 5', 'hirxpert-addon' ),
					'navbar_delimiter1' 	=> esc_html__('|', 'hirxpert-addon'),
					'navbar_delimiter2' 	=> esc_html__('|', 'hirxpert-addon'),
					'navbar_delimiter3' 	=> esc_html__('|', 'hirxpert-addon'),
					'wpml_polylang'			=> esc_html__( 'WPML/Polylang', 'hirxpert-addon'),
				),
			),
			'required'		=> array( 'header-navbar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Bottom Styles', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header navbar styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-navbar-style-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Header Bottom Style Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit Header Middle style settings.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'header-navbar-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Bottom Height', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is height property of header navbar.', 'hirxpert-addon' ),
			'only_dimension' => 'height',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-sticky-height',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Bottom Sticky Height', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is height property of header sticky navbar.', 'hirxpert-addon' ),
			'only_dimension' => 'height'
		),
		array(
			'id'			=> 'header-navbar-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Header Bottom Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header navbar', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Background Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is background setting for header navbar', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-border',
			'type'			=> 'border',
			'title'			=> esc_html__( 'Header Bottom Border', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is border setting for header navbar', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Header Bottom padding', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is padding setting for header navbar', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-margin',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Header Bottom margin', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is margin setting for header navbar', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),	
		array(
			'id'			=> 'header-navbar-sticky-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Bottom Sticky Styles', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Here you can set all the type of header navbar sticky styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-sticky-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Header Bottom Sticky Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is link color setting for header navbar on sticky', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'header-navbar-sticky-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Bottom Sticky Background Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is background setting for header navbar on sticky', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'header-navbar-style-chk', '=', array( 'custom' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'header-tab-end'	
));

//Layout Settings
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Layout', 'hirxpert-addon' ),
	'id'         => 'post-layout',
	'config_id'  => '',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Page Title', 'hirxpert-addon' ),
	'id'         => 'page-title-options',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'page-title-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit page title options.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'page-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Enable or disable blog page title section', 'hirxpert-addon' ),
			'default'		=> true,
			'required'		=> array( 'page-title-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'page-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Blog Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These are blog page title elements. Drag which items you want to display left, center and right part.', 'hirxpert-addon' ),
			'default'		=> array(
				'left' => array(
				),
				'center' => array(
					'title' => esc_html__( 'Title', 'hirxpert-addon' ),
					'breadcrumb' => esc_html__( 'Breadcrumb', 'hirxpert-addon' )
				),
				'right' => array(
				),
				'disabled' => array(
					'description' => esc_html__( 'Description', 'hirxpert-addon' )
				)
			),
			'required'		=> array( 'page-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'page-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Page Title Background', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is background settings of page title.', 'hirxpert-addon' ),
			'required'		=> array( 'page-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'page-title-overlaycolor',
			'type'			=> 'color',
			'alpha'			=> true,
			'title'			=> esc_html__( 'Page Title Overlay Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This color will be displayed as in Page title overlaycolor. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
			'required'		=> array( 'page-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'page-title-custom-class',
			'type'			=> 'text',
			'title'			=> esc_html__( 'Page Title Custom Class', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is setting for add custom class name to page title wrapper.', 'hirxpert-addon' ),
			'required'		=> array( 'page-title', '=', array( 'true' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Sidebar Layout', 'hirxpert-addon' ),
	'id'         => 'sidebar-layout-options',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'sidebar-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Sidebar', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit sidebar layout options.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Sidebar Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose sidebar layout.', 'hirxpert-addon' ),
			'items'		=> array(
				'right-sidebar' => array(
					'title' => esc_html__( 'Right Sidebar', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-right.png'
				),
				'left-sidebar' => array(
					'title' => esc_html__( 'Left Sidebar', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-left.png'
				),
				'both-sidebar' => array(
					'title' => esc_html__( 'Both Sidebar', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-both.png'
				),
				'no-sidebar' => array(
					'title' => esc_html__( 'No Sidebar', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/no-sidebar.png'
				)
			),
			'default' => 'right-sidebar',
			'required'		=> array( 'sidebar-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Right Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose widget for right widget area', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Left Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose widget for left widget area', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		)
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'post-layout-end'	
));

// Footer
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Site Footer', 'hirxpert-addon' ),
	'id'         => 'footer-tab',
	'config_id'  => '',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'General', 'hirxpert-addon' ),
	'id'         => 'footer-general',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'footer-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Footer Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit footer settings options.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'footer-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Footer Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose footer layout either wide or boxed.', 'hirxpert-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-boxed.png'
				)
			),
			'default' => 'wide',
			'required'		=> array( 'footer-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'footer-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Footer Items', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These are footer items. Drag which items you want to display Enabled and Disabled.', 'hirxpert-addon' ),
			'default'		=> array(
				'enabled' => array(
					'footer-middle' => esc_html__( 'Footer Widgets', 'hirxpert-addon' ),
					'footer-bottom' => esc_html__( 'Copyright Section', 'hirxpert-addon' )
				),
				'disabled' => array(
					'footer-top' => esc_html__( 'Footer Top', 'hirxpert-addon' ),
				)
			),
			'required'		=> array( 'footer-chk', '=', array( 'custom' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Footer Top', 'hirxpert-addon' ),
	'id'         => 'footer-insta',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'insta-footer-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Footer Top Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit insta footer settings options.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'insta-footer-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Footer Top Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose insta footer layout either wide or boxed.', 'hirxpert-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-boxed.png'
				)
			),
			'default' => 'wide',
			'required'		=> array( 'insta-footer-chk', '=', array( 'custom' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Footer Widgets', 'hirxpert-addon' ),
	'id'         => 'footer-widgets',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'footer-middle-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Footer Widgets Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit footer middle settings options.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'widgets-footer-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Widgets Footer Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose widgets footer layout either wide or boxed.', 'hirxpert-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-boxed.png'
				)
			),
			'default' => 'boxed',
			'required'		=> array( 'footer-middle-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'footer-widgets-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Footer Widgets Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose footer widgets layout.', 'hirxpert-addon' ),
			'items'		=> array(
				'3-3-3-3' => array(
					'title' => esc_html__( 'Column 3/3/3/3', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-3-3-3-3.png'
				),
				'3-3-6' => array(
					'title' => esc_html__( 'Column 3/3/6', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-3-3-6.png'
				),
				'12' => array(
					'title' => esc_html__( 'Column 12', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-12.png'
				),
				'4-4-4' => array(
					'title' => esc_html__( 'Column 4/4/4', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-4-4-4.png'
				),
				'4-8' => array(
					'title' => esc_html__( 'Column4/8', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-4-8.png'
				),
				'6-3-3' => array(
					'title' => esc_html__( 'Column 6/3/3', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-6-3-3.png'
				),
				'8-4' => array(
					'title' => esc_html__( 'Column 8/4', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/widget-8-4.png'
				)
			),
			'default' => '12',
			'required'		=> array( 'footer-middle-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'footer-widget-1',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Footer Widgets Area 1', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose widget for footer widget area 1', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'footer-middle-chk', '=', array( 'custom' ) )
		),
		array(
			'id'			=> 'footer-widget-2',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Footer Widgets Area 2', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose widget for footer widget area 2', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'footer-widgets-layout', '!=', array( '12' ) )
		),
		array(
			'id'			=> 'footer-widget-3',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Footer Widgets Area 3', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose widget for footer widget area 3', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'footer-widgets-layout', '=', array( '3-3-3-3', '3-3-6', '4-4-4', '6-3-3' ) )
		),
		array(
			'id'			=> 'footer-widget-4',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Footer Widgets Area 4', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose widget for footer widget area 4', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'footer-widgets-layout', '=', array( '3-3-3-3' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Copyright Section', 'hirxpert-addon' ),
	'id'         => 'copyright-section',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'footer-bottom-chk',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Footer Widgets Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose custom to edit footer middle settings options.', 'hirxpert-addon' ),
			'choices'		=> array(
				'default'	=> esc_html__( 'Default', 'hirxpert-addon' ),
				'custom'	=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'		=> 'default'
		),
		array(
			'id'			=> 'footer-bottom-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Footer Bottom Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose footer bottom layout either wide or boxed.', 'hirxpert-addon' ),
			'items'		=> array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/footer/footer-boxed.png'
				)
			),
			'default' => 'boxed',
			'required'		=> array( 'footer-bottom-chk', '=', array( 'custom' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'footer-end'	
));


/*
//All Fields
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'All Fields', 'hirxpert-addon' ),
	'id'         => 'all-fields'
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Fields', 'hirxpert-addon' ),
	'id'         => 'un-fields-tab',
	'fields'	 => array(
		array(
			'id'			=> 'test_text_field',
			'type'			=> 'text',
			'title'			=> esc_html__( 'Text Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is text field', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'test_textarea_field',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Textarea Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is textarea field', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'test_select_field',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Select Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is select field', 'hirxpert-addon' ),
			'choices'		=> array(
				'1'	=> 'One',
				'2'	=> 'Two',
				'3'	=> 'Three'
			),
			'default'		=> '2'
		),
		array(
			'id'			=> 'test_color_field',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Color Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is color field', 'hirxpert-addon' ),
			'alpha'			=> false,
			'default'		=> '#111111'
		),
		array(
			'id'			=> 'test_link_field',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Link Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is link field', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'ajax-trigger-fonts-test',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Google Fonts Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is fonts field', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'background_test',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Background Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is background field', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'image_test',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Image Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is image field', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'border_test',
			'type'			=> 'border',
			'title'			=> esc_html__( 'Border Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is border field', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'dimension_test',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Dimension Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is dimension field', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'hw_test',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Width/Height Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is width height field', 'hirxpert-addon' ),
			'only_dimension' => 'both'
		),
		array(
			'id'			=> 'toggle_test',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Toggle Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is toggle field', 'hirxpert-addon' )
		),
		array(
			'id'			=> 'sidebars_test',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Sidebars Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is sidebars field', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'pages_test',
			'type'			=> 'pages',
			'title'			=> esc_html__( 'Pages Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is pages field', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'multicheck_test',
			'type'			=> 'multicheck',
			'title'			=> esc_html__( 'Multi Check Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is multi check box field', 'hirxpert-addon' ),
			'items'		=> array(
				'one' => esc_html__( 'One', 'hirxpert-addon' ),
				'two' => esc_html__( 'Two', 'hirxpert-addon' ),
				'three' => esc_html__( 'Three', 'hirxpert-addon' ),
				'four' => esc_html__( 'Four', 'hirxpert-addon' ),
				'five' => esc_html__( 'Five', 'hirxpert-addon' )
			)
		),
		array(
			'id'			=> 'radioimage_test',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Radio Image Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is radio image field', 'hirxpert-addon' ),
			'items'		=> array(
				'right-sidebar' => array(
					'title' => esc_html__( 'Right Sidebar', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-right.png'
				),
				'left-sidebar' => array(
					'title' => esc_html__( 'Left Sidebar', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-left.png'
				),
				'both-sidebar' => array(
					'title' => esc_html__( 'Both Sidebar', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/sidebar-both.png'
				),
				'no-sidebar' => array(
					'title' => esc_html__( 'No Sidebar', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/sidebars/no-sidebar.png'
				)
			),
			'default' => 'left-sidebar'
		),
		array(
			'id'			=> 'dragdrop_test',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Drag Drop Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is drag and drop field', 'hirxpert-addon' ),
			'default'		=> array(
				'enabled' => array(
					'one' => esc_html__( 'One', 'hirxpert-addon' ),
					'two' => esc_html__( 'Two', 'hirxpert-addon' )
				),
				'disabled' => array(
					'three' => esc_html__( 'Three', 'hirxpert-addon' ),
					'four' => esc_html__( 'Four', 'hirxpert-addon' ),
					'five' => esc_html__( 'Five', 'hirxpert-addon' )
				)
			)
		),
		array(
			'id'			=> 'test_label_field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Label Field', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is label field', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'all-fields-end'	
));*/