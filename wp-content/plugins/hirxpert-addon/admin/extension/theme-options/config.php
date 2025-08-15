<?php

// General
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'General', 'hirxpert-addon' ),
	'id'         => 'general-tab',
	'config_id'  => 'customizer_settings_general',
) );
// -> Site Settings
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Site Settings', 'hirxpert-addon' ),
	'id'         => 'site-general-settings',
	'config_id'  => 'customizer_settings_general',
	'fields'	 => array(
		array(
			'id'			=> 'loader-settings',
			'config_id'     => '',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Loader Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for site page loader. If you have did not uploaded means default page loader will work.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id' 			=> 'page-loader-option',
			'config_id'     => '',
			'type' 			=> 'toggle',
			'title' 		=> esc_html__( 'Enable/Disable Page Loader', 'hirxpert-addon' ),
			'description'   => esc_html__( 'Toggle to enable or disable the page loading animation before the content appears.', 'hirxpert-addon'),
		),
		array(
			'id'			=> 'page_loader',
			'config_id'     => '',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Page Loader', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Upload an image or GIF to be displayed before the page content appears, enhancing the user experience with a custom loading animation.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'page-loader-option', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'site-layout-settings',
			'config_id'     => '',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is site layout settings.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'            => 'site-layout',
			'config_id'     => '',
			'type'          => 'radioimage',
			'title'         => esc_html__('Site Layout', 'hirxpert-addon'),
			'description'   => esc_html__('Choose between boxed, full-width, or other layout styles for the overall site design.', 'hirxpert-addon'),
			'items'         => array(
				'wide' => array(
					'title' => esc_html__( 'Wide', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/site-layout/site-wide.png'
				),
				'boxed' => array(
					'title' => esc_html__( 'Boxed', 'hirxpert-addon' ),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/site-layout/site-boxed.png'
				),
				'wider' => array(
					'title' => esc_html__('Wider', 'hirxpert-addon'),
					'url' => HIRXPERT_ADDON_URL . 'admin/extension/theme-options/assets/images/site-layout/site-wider.png'
				)
			),
			'default'       => 'wide',
			'required'      => array('general-chk', '=', array('custom'))
		),		
		array(
			'id'			=> 'site-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Site Maximum Width', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Controls the overall site width. Enter value including any valid CSS unit, ex: 1200.', 'hirxpert-addon' ),
			'only_dimension' => 'width',
			'default'		=> array( 'width' => '1200' )
		),
		array(
			'id'			=> 'site-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Site Content Padding', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Adjust the top/bottom padding for page content. Enter values like, ex: 60, 60.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'site-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Body Background', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'In boxed layout site setting, background color of the site background can be choosen here!.', 'hirxpert-addon' ),
			'required'		=> array( 'site-layout', '=', array( 'boxed' ) )
		),
		array(
			'id'			=> 'site-api-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'API Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is site API settings.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'mailchimp-api',
			'type'			=> 'text',
			'title'			=> esc_html__( 'Mailchimp API', 'hirxpert-addon' ),
			'description'   => wp_kses_post('Enter your Mailchimp API key to enable email marketing integrations. Then add the mailchimp to your widget area and Select the Mailing List, <a href="https://mailchimp.com/" style="text-decoration:none;" target="_blank">Get API.</a>.', 'hirxpert-addon'),
			'default'		=> ''
		),
		array(
			'id'			=> 'site-rtl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'RTL Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Toggle this control to enable or disable RTL mode.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'rtl',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable RTL', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to switch your entire site to Right-to-Left text direction, suitable for languages like Arabic and Hebrew.', 'hirxpert-addon' )
		),
		array(
			'id'  			=> 'dark-light-setting',
			'type'          => 'label',
			'title'  		=> esc_html( 'Dark/Light Mode'),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'dark-light',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable Dark/Light', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle this to enable a switch between dark and light themes for the entire site.', 'hirxpert-addon' )
		),
		array(
			'id'  			=> 'favicon-setting',
			'type'          => 'label',
			'title'  		=> esc_html( 'Favicon Settings'),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'favicon-icon',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Favicon Icon', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Upload a small icon which is displayed as your site icon.', 'hirxpert-addon' )
		)
	)
) );
// -> Logo Settings
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Logo Settings', 'hirxpert-addon' ),
	'id'         => 'site-logo-settings',
	'config_id'  => 'customizer_settings_general',
	'fields'	 => array(
		array(
			'id'			=> 'logo-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Logo Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for site logo.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'site-logo',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Default Logo', 'hirxpert-addon' ),
			'description'	=> wp_kses_post('Choose an image as a primary logo for your site. Some pages have a unique logo that cannot be changed here, how to change that <p class="tooltip">?<span class="tooltiptext">If a page has unique logo, navigate to Edit Page. In the Options area, go to General -> Site General Setting -> Custom -> Default Logo, updated your logo here.</span></p>', 'hirxpert-addon'),
			'default'		=> ''
		),
		array(
			'id'			=> 'site-logo-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Site Logo Maximum Width', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the maximum width of the site logo. If you want original width leave this field empty.', 'hirxpert-addon' ),
			'only_dimension' => 'width'
		),
		array(
			'id'			=> 'site-logo-desc',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable Site Logo Description', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display a short description or tagline next to the site logo.', 'hirxpert-addon' )
		),
		array(
			'id'			=> 'sticky-logo',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Sticky/Fixed Logo', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Upload an image as a logo for your sticky header. While scrolling it will be fixed.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'sticky-logo-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Sticky/Fixed Logo Maximum Width', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the maximum width of sticky logo. If you want original width leave this field empty.', 'hirxpert-addon' ),
			'only_dimension' => 'width'
		),
		array(
			'id'			=> 'mobile-logo',
			'type'			=> 'image',
			'title'			=> esc_html__( 'Mobile Logo', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Upload or set a separate logo specifically for mobile devices.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'mobile-logo-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Mobile Logo Maximum Width', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the maximum width of mobile logo. If you want original width leave this field empty.', 'hirxpert-addon' ),
			'only_dimension' => 'width'
		),
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'general-end'
));

// Typography
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Typography', 'hirxpert-addon' ),
	'id'         => 'typography-tab',
	'config_id'  => 'customizer_settings_typography',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Site Typography', 'hirxpert-addon' ),
	'id'         => 'site-typo-settings',
	'config_id'  => 'customizer_settings_typography',
	'fields'	 => array(
		array(
			'id'			=> 'content-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Site Common Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the primary typography used across the site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'lead-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Lead Text Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose the typography settings for lead text, typically used for important or introductory content.', 'hirxpert-addon' ),
			'default'		=> ''
		)
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Heading Typography', 'hirxpert-addon' ),
	'id'         => 'heading-typo-settings',
	'config_id'  => 'customizer_settings_typography',
	'fields'	 => array(
		array(
			'id'			=> 'h1-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H1 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H1 headings on the site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'h2-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H2 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H2 headings on the site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'h3-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H3 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H3 headings on the site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'h4-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H4 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H4 headings on the site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'h5-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H5 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H5 headings on the site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'h6-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H6 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H6 headings on the site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Heading MobileView Typography', 'hirxpert-addon' ),
	'id'         => 'heading-mobile-typo-settings',
	'config_id'  => 'customizer_settings_typography',
	'fields'	 => array(
		array(
			'id'			=> 'h1-mobile-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H1 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H1 headings on mobile devices.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'h2-mobile-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H2 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H2 headings on mobile devices.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'h3-mobile-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H3 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H3 headings on mobile devices.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'h4-mobile-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H4 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H4 headings on mobile devices.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'h5-mobile-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H5 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H5 headings on mobile devices.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'h6-mobile-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'H6 Fonts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'These settings control the typography specifically for all H6 headings on mobile devices.', 'hirxpert-addon' ),
			'default'		=> ''
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Site Header Typography', 'hirxpert-addon' ),
	'id'         => 'header-typo-settings',
	'config_id'  => 'customizer_settings_typography',
	'fields'	 => array(
		array(
			'id'			=> 'header-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Site Header Typography', 'hirxpert-addon' ),
			'description' 	=> esc_html__( 'Customize the font, size, and style for text elements within the Site Header of the Site.', 'hirxpert-addon' ),
			'default'		=> ''
		),		
		array(
			'id'			=> 'header-topbar-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Header Top Typography', 'hirxpert-addon' ),
			'description'  	=> esc_html__( 'Customize the font, size, and style for text elements within the Header Top of the Site.', 'hirxpert-addon' ),
			'default'		=> ''
		),		
		array(
			'id'			=> 'header-logobar-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Header Middle Typography', 'hirxpert-addon' ),
			'description'  	=> esc_html__( 'Customize the font, size, and style for text elements within the Header Middle of the Site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'header-navbar-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Header Bottom Typography', 'hirxpert-addon' ),
			'description'  	=> esc_html__( 'Customize the font, size, and style for text elements within the Header Bottom of the Site.', 'hirxpert-addon' ),
			'default'		=> ''
		)
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Site Footer Typography', 'hirxpert-addon' ),
	'id'         => 'footer-typo-settings',
	'config_id'  => 'customizer_settings_typography',
	'fields'	 => array(
		array(
			'id'			=> 'footer-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Site Footer Typography', 'hirxpert-addon' ),
			'description'  	=> esc_html__( 'Customize the font, size, and style for text elements within the Site Footer of the Site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'insta-footer-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Footer Top Typography', 'hirxpert-addon' ),
			'description'  	=> esc_html__( 'Customize the font, size, and style for text elements within the Footer Top of the Site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'footer-widgets-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Footer Widgets Typography', 'hirxpert-addon' ),
			'description'  	=> esc_html__( 'Customize the font, size, and style for text elements within the Footer Widgets of the Site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'copyright-section-typography',
			'type'			=> 'fonts',
			'title'			=> esc_html__( 'Copyright Section Typography', 'hirxpert-addon' ),
			'description'  	=> esc_html__( 'Customize the font, size, and style for text elements within the Copyright Section of the Site.', 'hirxpert-addon' ),
			'default'		=> ''
		)
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'typography-end'
));

// Colors
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Colors', 'hirxpert-addon' ),
	'id'         => 'colors-tab',
	'config_id'  => 'customizer_settings_skin',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Theme Colors', 'hirxpert-addon' ),
	'id'         => 'theme-colors',
	'config_id'  => 'customizer_settings_skin',
	'fields'	 => array(
		array(
			'id'			=> 'color-layout-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Theme Color Settings', 'hirxpert-addon' ),
			'seperator'		=> 'before',
		),
		array(
			'id'			=> 'primary-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Theme Primary Color', 'hirxpert-addon' ),
			'description'   => wp_kses_post( 'Set the main color used for your website, to applying it across all elements. Ensure to update this color in both the <a href="admin.php?page=revslider">Slider</a> and Elementor settings under <b>Site Settings > Global Colors</b>.', 'hirxpert-addon'),
			'alpha'			=> false,
			'default'		=> '#3845ab'
		),
		array(
			'id'			=> 'secondary-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Theme Secondary Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the secondary color of the theme. Selected color will work in few places of the website. If you want theme default secondary color leave this field as empty.', 'hirxpert-addon' ),
			'alpha'			=> false,
			'default'		=> '#b043ba'
		),
		array(
			'id'			=> 'link-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Theme Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the default color for hyperlinks across the site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'button-color',
			'type'			=> 'btn_color',
			'title'			=> esc_html__( 'Button Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the default color for buttons across the site.', 'hirxpert-addon' ),
			'default'		=> ''
		),
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'theme-colors-end'	
));

// Header
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Site Header', 'hirxpert-addon' ),
	'id'         => 'header-tab',
	'config_id'  => 'customizer_settings_site_header',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'General', 'hirxpert-addon' ),
	'id'         => 'header-general',
	'config_id'  => 'customizer_settings_site_header',
	'fields'	 => array(
		array(
			'id'			=> 'header-layout-label',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all header settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'header-links-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Header Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the text color for hyperlinks in the header section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-background',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Header Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the header section, including color, image, size, etc.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-border',
					'type'			=> 'border',
					'title'			=> esc_html__( 'Header Border', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Configure and Customize the border style for the header section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Header padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the header section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-margin',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Header margin', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the margin (outer spacing) around the header section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
			),
		),
		array(
			'id'			=> 'header-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Header Layout', 'hirxpert-addon' ),
			'description'	=> wp_kses_post('Choose the structure of the site header, such as wide or boxed or wider.To create Custom Header and Footer use <a href="edit.php?post_type=zozo-hf" target="__blank">Zozo Header Footer</a> Plugin  <p class="tooltip">?<span class="tooltiptext">Zozo Header Footer is used for creating Custom Header and Footer using Elementor Builder <a href="https://docs.zozothemes.com/zozo-header-footer/" target="__blank">Read More..</a></span></p>', 'hirxpert-addon'),
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
		),
		array(
			'id'			=> 'header-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Header Bars', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select the header items. Drag and drop items you want to display header normal and header sticky area.', 'hirxpert-addon' ),
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
		),
		array(
			'id'			=> 'header-absolute',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Header Transparent', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to enable header over Content. Like floating on Slider / Page title bar and you have to select RGBA background color for your header or header items to display header like that.', 'hirxpert-addon' ),
			'default'		=> false,
		),
		array(
			'id'			=> 'menu-type',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Main Menu Type', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select the style of the main menu, such as mega menu, otherwise normal menu will display in default.', 'hirxpert-addon' ),
			'choices'		=> array(
				'normal'	=> esc_html__( 'Default Menu', 'hirxpert-addon' ),
				'mega'		=> esc_html__( 'Mega menu', 'hirxpert-addon' )
			),
			'default'		=> 'normal',
		),
		array(
			'id'			=> 'dropdown-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Dropdown Menu Styles', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all type of dropdown menu styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
		),
		array(
			'id'			=> 'dropdown-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Dropdown Menu Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the text color for links within dropdown menus.', 'hirxpert-addon' ),
			'default'		=> '',
		),
		array(
			'id'			=> 'dropdown-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Dropdown Menu Background Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the background color for dropdown menus in the navigation.', 'hirxpert-addon' ),
			'default'		=> '',	
		),
		array(
			'id'			=> 'dropdown-sticky-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Dropdown Menu Styles on Sticky/Fixed', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can set all the type of menu dropdown styles on sticky.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
		),
		array(
			'id'			=> 'dropdown-sticky-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Dropdown Menu Link Color on Sticky/Fixed', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the text color for dropdown menu links when the header is in sticky mode.', 'hirxpert-addon' ),
			'default'		=> '',
		),
		array(
			'id'			=> 'dropdown-sticky-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Dropdown Menu Background Color on Sticky/Fixed', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the background color for dropdown menus when the header is in sticky mode.', 'hirxpert-addon' ),
			'default'		=> '',
		),	
		array(
			'id'			=> 'secondary-area',
			'title'		=> esc_html__( 'Secondary Sidebar', 'hirxpert-addon'),
			'type'			=> 'label',
			'desc'	=> esc_html__( 'These are extra header options.', 'hirxpert-addon' ),
			'seperator'		=> 'after',
		),
		array(
			'id'			=> 'secondary-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Secondary Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select widget for secondary widget area. This part only works when you active secondary bar item on nav/logo bars.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'secondary-sidebar-from',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Animation From', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the starting direction for animation effects on secondary bar.', 'hirxpert-addon' ),
			'choices'		=> array(
				'right'	=> esc_html__( 'Right', 'hirxpert-addon' ),
				'left'	=> esc_html__( 'Left', 'hirxpert-addon' )
			),
			'default'		=> 'right'
		),
		array(
			'id'			=> 'secondary-sidebar-width',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Secondary Sidebar Width', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the maximum width of secondary sidebar. Example 300', 'hirxpert-addon' ),
			'only_dimension' => 'width',
			'default'		=> array( 'width' => '300' )
		),
		array(
			'id'			=> 'header-other-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Other Settings', 'hirxpert-addon' ),
			'desc'			=> esc_html__( 'These are extra header options.', 'hirxpert-addon' ),
			'seperator'		=> 'after',
		),
		array(
			'id'			=> 'search-type',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Search Toggle Modal', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select search box layout type for the search function in the header', 'hirxpert-addon' ),
			'choices'		=> array(
				'1'	=> esc_html__( 'Full Screen Search', 'hirxpert-addon' ),
				'2' => esc_html__( 'Text Box Toggle Search', 'hirxpert-addon' ),
				'3' => esc_html__( 'Full Bar Toggle Search', 'hirxpert-addon' ),
				'4' => esc_html__( 'Bottom Seach Box Toggle', 'hirxpert-addon' )
			),
			'default'		=> '1',
		),
		array(
			'id'			=> 'header-offset',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Header Scroll Offset', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the header bottom offset while one page scroll.', 'hirxpert-addon' ),
			'only_dimension' => 'height',
			'default'		=> array( 'height' => '0' ),
		),
		array(
			'id'			=> 'mobile-header-offset',
			'type'			=> 'hw',
			'title'			=> esc_html__( 'Mobile Header Scroll Offset', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the mobile header bottom offset while one page scroll.', 'hirxpert-addon' ),
			'only_dimension' => 'height',
			'default'		=> array( 'height' => '0' ),
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Header Builder', 'hirxpert-addon' ),
	'id'         => 'header-topbar',
	'config_id'  => 'customizer_settings_site_header',
	'fields'	 => array(		
		array(
			'id'			=> 'header-topbar-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Top Settings', 'hirxpert-addon' ),
			'description'   => esc_html__( 'Arrange and customize the elements in the top header section using a drag-and-drop interface. ', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'custom_class'	=> 'header-topbar-settings',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'header-topbar-height',
					'type'			=> 'hw',
					'title'			=> esc_html__( 'Header Top Height', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the height of the top header section (in pixels)', 'hirxpert-addon' ),
					'only_dimension' => 'height'
				),
				array(
					'id'			=> 'header-topbar-sticky-height',
					'type'			=> 'hw',
					'title'			=> esc_html__( 'Header Top Sticky/Fixed Height', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the height of the top header when it is in sticky or fixed mode.', 'hirxpert-addon' ),
					'only_dimension' => 'height'
				),		
				array(
					'id'			=> 'header-topbar-links-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Header Top Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the text color for hyperlinks in the header top section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-topbar-background',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Header Top Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the header top section, including color, image, size, etc.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-topbar-border',
					'type'			=> 'border',
					'title'			=> esc_html__( 'Header Top Border', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Configure and Customize the border style for the header top section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-topbar-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Header Top padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the header top section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-topbar-margin',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Header Top margin', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the margin (outer spacing) around the header top section.', 'hirxpert-addon' ),
					'default'		=> ''
				),	
			),
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
							'title' 		=> esc_html__( 'Topbar Custom Text 1', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Add the first custom text field displayed in the top bar of the site.', 'hirxpert-addon' ),
						),
					),
					'editable' => true
				),
				'custom-text-2' => array(
					'title'       => esc_html__( 'Custom Text 2 Editor', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'			=> 'topbar-custom-text-2',
							'type'			=> 'textarea',
							'title'			=> esc_html__( 'Navbar Custom Text 2', 'hirxpert-addon' ),
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
		),
		array(
			'id'			=> 'header-logobar-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Middle Settings', 'hirxpert-addon' ),
			'description'   => esc_html__( 'Arrange and customize the elements in the header middle section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'custom_class'	=> 'header-logobar-settings',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'header-logobar-height',
					'type'			=> 'hw',
					'title'			=> esc_html__( 'Header Middle Height', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the height of the middle header section (in pixels).', 'hirxpert-addon' ),
					'only_dimension' => 'height'
				),
				array(
					'id'			=> 'header-logobar-sticky-height',
					'type'			=> 'hw',
					'title'			=> esc_html__( 'Header Middle Sticky Height', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the height of the middle header when it is in sticky or fixed mode.', 'hirxpert-addon' ),
					'only_dimension' => 'height'
				),		
				array(
					'id'			=> 'header-logobar-links-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Header Middle Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the text color for hyperlinks in the header middle section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-logobar-background',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Header Middle Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the header middle section, including color, image, size, etc.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-logobar-border',
					'type'			=> 'border',
					'title'			=> esc_html__( 'Header Middle Border', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Configure and Customize the border style for the header middle section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-logobar-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Header Middle padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the header middle section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-logobar-margin',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Header Middle margin', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the margin (outer spacing) around the header middle section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
			),
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
							'title' => esc_html__( 'Logobar Custom Text 1', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Add the first custom text field displayed in the logo bar of the site.', 'hirxpert-addon' ),
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
							'title'			=> esc_html__( 'Logobar Custom Text 2', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Add the second custom text field displayed in the logo bar of the site.', 'hirxpert-addon' ),
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
		),
		array(
			'id'			=> 'header-navbar-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Bottom Settings', 'hirxpert-addon' ),
			'description'   => esc_html__( 'Arrange and customize the elements in the header bottom section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'custom_class'	=> 'header-navbar-settings',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'header-navbar-height',
					'type'			=> 'hw',
					'title'			=> esc_html__( 'Header Bottom Height', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the height of the bottom header section (in pixels).', 'hirxpert-addon' ),
					'only_dimension' => 'height'
				),
				array(
					'id'			=> 'header-navbar-sticky-height',
					'type'			=> 'hw',
					'title'			=> esc_html__( 'Header Bottom Sticky Height', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the height of the bottom header when it is in sticky or fixed mode.', 'hirxpert-addon' ),
					'only_dimension' => 'height'
				),		
				array(
					'id'			=> 'header-navbar-links-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Header Bottom Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the text color for hyperlinks in the header bottom section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-navbar-background',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Header Bottom Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the header bottom section, including color, image, size, etc.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-navbar-border',
					'type'			=> 'border',
					'title'			=> esc_html__( 'Header Bottom Border', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Configure and Customize the border style for the header bottom section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-navbar-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Header Bottom padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the header bottom section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'header-navbar-margin',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Header Bottom margin', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the margin (outer spacing) around the header bottom section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
			),
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
							'title' => esc_html__('Navbar Custom Text 1', 'hirxpert-addon'),
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
							'title'			=> esc_html__( 'Navbar Custom Text 2', 'hirxpert-addon' ),
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
		),
	),
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Header Sticky Styles', 'hirxpert-addon' ),
	'id'         => 'header-sticky',
	'config_id'  => 'customizer_settings_site_header',
	'fields'	 => array(
		array(
			'id'			=> 'header-sticky-general',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Sticky', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Cuztomize all type of control for header top sticky styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-sticky',
			'type'			=> 'select',
			'title'			=> esc_html__( 'Choose Header Sticky/Fixed', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select whether the header remains sticky (appears after scrolling) or fixed (always visible at the top).', 'hirxpert-addon' ),
			'choices'		=> array(
				'normal'		=> esc_html__( 'While Scroll', 'hirxpert-addon' ),
				'on_scrollup'	=> esc_html__( 'On Scroll Up', 'hirxpert-addon' )
			),
			'default'		=> 'normal'
		),
		array(
			'id'			=> 'header-topbar-sticky-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Top Sticky Styles', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all the type of header top sticky styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-topbar-sticky-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Topbar Sticky Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the text color for hyperlinks in the header topbar on sticky.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'header-topbar-sticky-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Topbar Sticky Background Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Configure the background color or image for the header top bar when it is in sticky mode.', 'hirxpert-addon' ),
			'default'		=> ''
		),	
		array(
			'id'			=> 'header-logobar-sticky-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Middle Sticky/Fixed Styles', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can set all the type of Header Middle sticky styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-logobar-sticky-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Header Middle Sticky/Fixed Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the text color for hyperlinks in the header middle on sticky.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'header-logobar-sticky-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Middle Sticky/Fixed Background Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Configure the background color or image for the header middle when it is in sticky mode.', 'hirxpert-addon' ),
			'default'		=> ''
		),		
		array(
			'id'			=> 'header-navbar-sticky-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Header Bottom Sticky/Fixed Styles', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all the type of Header Bottom sticky styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'header-navbar-sticky-links-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Header Bottom Sticky/Fixed Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the text color for hyperlinks in the header bottom on sticky.', 'hirxpert-addon' ),
			'default'		=> ''
		),
		array(
			'id'			=> 'header-navbar-sticky-background',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Header Bottom Sticky/Fixed Background', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Configure the background color or image for the header bottom when it is in sticky mode.', 'hirxpert-addon' ),
			'default'		=> ''
		),	
		
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
    'title'      => esc_html__( 'Mobile Header', 'hirxpert-addon' ),
    'id'         => 'header-mobileheader',
	'config_id'  => 'customizer_settings_site_header',
    'fields'     => array(
		array(
			'id'			 => 'mobilebar-header',
            'type'			 => 'label',
            'title'			 => esc_html__( 'Mobile Header', 'hirxpert-addon' ),
            'desc'	 => esc_html__( 'This is settings for site page loader. If you have did not uploaded means default page loader will work.', 'hirxpert-addon' ),
            'seperator'		 => 'after',
			'show_edit_icon' => true,
			'fields'		 => array(
				array(
					'id'            => 'mobilebar-responsive',
					'type'          => 'number',
					'title'         => esc_html__( 'Mobile Bar From', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Set the width from which the Mobile Bar should be appear. Example 767', 'hirxpert-addon' ),
					'default'       => '767'
				),
				array(
					'id'            => 'mobilebar-sticky',
					'type'          => 'select',
					'title'         => esc_html__( 'Choose Mobile Bar Sticky', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Select the sticky on or off to fixed at the top while scrolling.', 'hirxpert-addon' ),
					'choices'       => array(
						'off'       => 'Off',
						'on'        => 'On',
						'on_scrollup' => 'On Scroll Up'
					),
					'default'       => 'off'
				),
				array(
					'id'            => 'mobilebar-height',
					'type'          => 'number',
					'title'         => esc_html__( 'Mobilebar Height ', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Set the height of the mobile bar for optimal visibility and usability. Example 767', 'hirxpert-addon' ),
					'default'       => '100'
				),
				array(
					'id'            => 'header-mobilebar-color',
					'type'          => 'color',
					'title'         => esc_html__( 'Header Mobilebar Background Color', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Set the background color of the mobile bar in the header. Selected color will work in few places of the website. you can update to leave it as empty.', 'hirxpert-addon' ),
					'alpha'         => false,
					'default'       => '#000'
				),
				array(
					'id'            => 'header-mobilebar-item-color',
					'type'          => 'color',
					'title'         => esc_html__( 'Header Mobilebar Items Color', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Set the color of the mobile bar items in the header. Selected color will work in few places of the website. you can update to leave it as empty.', 'hirxpert-addon' ),
					'alpha'         => false,
					'default'       => '#939393'
				),
			),
		),
        array(
            'id'            => 'mobilebar-items',
            'type'          => 'dragdrop-editor',
            'title'         => esc_html__( 'Mobile Header Items', 'hirxpert-addon' ),
            'description'   => esc_html__( 'Arrange and customize the elements in the mobile header section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'items'			=> array(

				'mobile-menu-custom-text-1'  => array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'			=> 'mobile-menu-custom-text-1',
							'type'			=> 'textarea',
							'title'			=> esc_html__( 'Mobile menu Custom Text 1', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Add the first custom text field displayed in the mobile menu.', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable'	=> true
				),
				'mobile-menu-custom-text-2'  => array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'			=> 'mobile-menu-custom-text-2',
							'type'			=> 'textarea',
							'title'			=> esc_html__( 'Mobile menu Custom Text 2', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Add the second custom text field displayed in the mobile menu.', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable'	=> true
				),
				'mobilebar-spacer-1' 	=> array(
					'title'			=> esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'		=>  array(
						array(
							'id'		=> 'mobilebar_spacer_1',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Spacer 1', 'hirxpert-addon'),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),
					'editable'	=> true
				),
				'mobilebar-spacer-2' 	=> array(
					'title'			=> esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'		=>  array(
						array(
							'id'		=> 'mobilebar_spacer_2',
							'type'          => 'hw',
							'title'         => esc_html__( 'Spacer 2', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),
					'editable'	=> true
				),
				'mobilebar-spacer-3' 	=> array(
					'title'			=> esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'		=>  array(
						array(
							'id'		=> 'mobilebar_spacer_3',
							'type'          => 'hw',
							'title'         => esc_html__( 'Spacer 3', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),
					'editable'	=> true
				),
				'mobilebar-html-1' => array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'mobilebar-html-1',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable'	=> true
				),
				'mobilebar-html-2' => array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'mobilebar-html-2',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable'	=> true
				),
				'mobilebar-html-3' => array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'mobilebar-html-3',
							'type'  => 'textarea',
							'title' => esc_html__( 'Html Code', 'hirxpert-addon' ),
							'description' 	=> esc_html__( 'Add custom HTML code to insert content, scripts, or custom elements into the site.', 'hirxpert-addon' ),
						),
					),
					'editable'	=> true
				),
				'mobilebar_delimiter1' => array(
					'title'		 => esc_html__( 'Delimiter 1', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'mobilebar_delimiter1_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the horizontal bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'mobilebar_delimiter1_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'mobilebar_delimiter1_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'mobilebar_delimiter1_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable'	=> true
				),
				'mobilebar_delimiter2' => array(
					'title'		 => esc_html__( 'Delimiter 2', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'mobilebar_delimiter2_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the horizontal bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'mobilebar_delimiter2_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'mobilebar_delimiter2_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'mobilebar_delimiter2_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable'	=> true
				),
				'mobilebar_delimiter3' => array(
					'title'		 => esc_html__( 'Delimiter 3', 'hirxpert-addon'),
					'fields'	 => array( 
						array(
							'id'		=> 'mobilebar_delimiter3_width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the horizontal bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '1' )
						),
						array(
							'id'		=> 'mobilebar_delimiter3_height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '100' )
						),
						array( 
							'id'			=> 'mobilebar_delimiter3_color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'mobilebar_delimiter3_margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),	
					'editable'	=> true
				),
			),
            'default'       => array(
                'left' => array(
                    'menu-toggle' => esc_html__( 'Mobile Menu Trigger', 'hirxpert-addon' ),                    
                ),
                'center' => array(        
                    'logo' => esc_html__( 'Logo', 'hirxpert-addon' ),
                ),
                'right' => array(    
                    'search' => esc_html__( 'Search Trigger', 'hirxpert-addon' ),
                ),
                'disabled' => array(
                	'mobile-menu-custom-text-1' => esc_html__( 'Mobile menu Custom Text 1', 'hirxpert-addon' ),
					'mobile-menu-custom-text-2' => esc_html__( 'Mobile menu Custom Text 2', 'hirxpert-addon' ),
					'mobile-icons-fields'				=> esc_html__( 'Mobile Phone Number', 'hirxpert-addon' ),
					'mobilebar-spacer-1'		=> esc_html__( 'Spacer 1', 'hirxpert-addon' ),
					'mobilebar-spacer-2'		=> esc_html__( 'Spacer 2', 'hirxpert-addon' ),
					'mobilebar-spacer-3'		=> esc_html__( 'Spacer 3', 'hirxpert-addon' ),
					'mobilebar-html-1' 			=> esc_html__( 'HTML 1', 'hirxpert-addon' ),
					'mobilebar-html-2'			=> esc_html__( 'HTML 2', 'hirxpert-addon' ),
					'mobilebar-html-3' 			=> esc_html__( 'HTML 3', 'hirxpert-addon' ),
					'mobilebar_delimiter1' 		=> esc_html__('|', 'hirxpert-addon'),
					'mobilebar_delimiter2' 		=> esc_html__('|', 'hirxpert-addon'),
					'mobilebar_delimiter3' 		=> esc_html__('|', 'hirxpert-addon'),
					'mobile-icon-email'			=> esc_html__( 'Mobile Email','hirxpert-addon' ),
					'wpml_polylang'			=> esc_html__( 'WPML/Polylang', 'hirxpert-addon'),
                )
			),
        ),
		array(
			'id'			 => 'mobilebar-menu-header',
            'type'			 => 'label',
            'title'			 => esc_html__( 'Mobile Menu Items Settings', 'hirxpert-addon' ),
            'desc'	 => esc_html__( 'This is settings for site page loader. If you have did not uploaded means default page loader will work.', 'hirxpert-addon' ),
            'seperator'		 => 'after',
			'show_edit_icon' => true,
			'fields'		 => array(
				array(
					'id'            => 'mobile-menu-color',
					'type'          => 'color',
					'title'         => esc_html__( 'Mobile Menu Background Color', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Set the background color for the Mobile Menu. Selected color will work in few places of the website. you can update to leave it as empty.', 'hirxpert-addon' ),
					'alpha'         => false,
					'default'       => '#fff'
				),
				array(
					'id'            => 'mobile-menu-item-color',
					'type'          => 'color',
					'title'         => esc_html__( 'Mobile Menu Items Color', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Set the color for the Mobile Menu Items. Selected color will work in few places of the website. you can update to leave it as empty.', 'hirxpert-addon' ),
					'alpha'         => false,
					'default'       => '#000'
				),
				array(
					'id'            => 'mobile-sidebar-width',
					'type'          => 'hw',
					'title'         => esc_html__( 'Mobile Menu Maximum Width', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Set the maximum width of the logo. If you want the original width, leave this field empty.', 'hirxpert-addon' ),
					'only_dimension' => 'width',
					'default'		=> array( 'width' => '300' )
				),
			),
		),
        array(
            'id'            => 'mobilebar-menu-items',
            'type'          => 'dragdrop-editor',
            'title'         => esc_html__( 'Mobile Menu Part Items', 'hirxpert-addon' ),
            'description'   => esc_html__( 'Arrange and customize the elements in the mobile menu part section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'items'			=> array(
				'mobilebar-menu-custom-text-1'  => array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'			=> 'mobilebar-menu-custom-text-1',
							'type'			=> 'textarea',
							'title'			=> esc_html__( 'Mobile menu Custom Text 1', 'hirxpert-addon' ),
							'description'   => esc_html__( 'Add the second custom text field displayed in the mobile menu.', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable'	=> true
				),
				'mobilebar-menu-custom-text-2'  => array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'			=> 'mobilebar-menu-custom-text-2',
							'type'			=> 'textarea',
							'title'			=> esc_html__( 'Mobile menu Custom Text 2', 'hirxpert-addon' ),
							'description'   => esc_html__( 'Add the second custom text field displayed in the mobile menu.', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable'	=> true
				),
				'spacer-mobile-1'    		=> array(
					'title'			=> esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'		=>  array(
						array(
							'id'		=> 'mobile-spacer-1',
							'type'          => 'hw',
							'title'		=> esc_html__( 'Spacer 1', 'hirxpert-addon'),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),
					'editable'	=> true
				),
				'spacer-mobile-2'    		=> array(
					'title'			=> esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'		=>  array(
						array(
							'id'		=> 'mobile-spacer-2',
							'type'          => 'hw',
							'title'         => esc_html__( 'Spacer 2', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),
					'editable'	=> true
				),
				'spacer-mobile-3'    		=> array(
					'title'			=> esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'		=>  array(
						array(
							'id'		=> 'mobile-spacer-3',
							'type'          => 'hw',
							'title'         => esc_html__( 'Spacer 3', 'hirxpert-addon' ),
							'description' => esc_html__( 'Adjust this value to control the amount of empty space between elements.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '40' )
						),
					),
					'editable'	=> true
				),
				'delimiter-mobile-1'         => array(
					'title'			=> esc_html__( 'Delimiter 1', 'hirxpert-addon'),
					'fields'		=> array( 
						array(
							'id'		=> 'mobile-delimiter-1-width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '100' )
						),
						array(
							'id'		=> 'mobile-delimiter-1-height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '1' )
						),
						array( 
							'id'			=> 'mobile-delimiter-1-color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'mobile-delimiter-1-margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable'	=> true
				),
				'delimiter-mobile-2'         => array(
					'title'			=> esc_html__( 'Delimiter 2', 'hirxpert-addon'),
					'fields'		=> array( 
						array(
							'id'		=> 'mobile-delimiter-2-width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '100' )
						),
						array(
							'id'		=> 'mobile-delimiter-2-height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '1' )
						),
						array( 
							'id'			=> 'mobile-delimiter-2-color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'mobile-delimiter-2-margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable'	=> true
				),
				'delimiter-mobile-3'         => array(
					'title'			=> esc_html__( 'Delimiter 3', 'hirxpert-addon'),
					'fields'		=> array( 
						array(
							'id'		=> 'mobile-delimiter-3-width',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Width', 'hirxpert-addon'),
							'description' => esc_html__( 'Defines the thickness of the vertical bar (|) separator.', 'hirxpert-addon' ),
							'only_dimension' => 'width',
							'default' 	=> array( 'width' => '100' )
						),
						array(
							'id'		=> 'mobile-delimiter-3-height',
							'type'		=> 'hw',
							'title'		=> esc_html__( 'Height', 'hirxpert-addon'),
							'description' => esc_html__( 'Sets the vertical size of the delimiter (|) to control its length.', 'hirxpert-addon' ),
							'only_dimension' => 'height',
							'default' 	=> array( 'height' => '1' )
						),
						array( 
							'id'			=> 'mobile-delimiter-3-color',
							'type'			=> 'color',
							'title'			=> esc_html__( 'Color', 'hirxpert-addon' ),
							'description' => esc_html__( 'Set the color of the Delimiter.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'mobile-delimiter-3-margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Margin', 'hirxpert-addon' ),
							'description' => esc_html__( 'Controls the spacing around the delimiter (|).', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable'	=> true
				),
			),
            'default'       => array(
                'enabled' => array(                    
                    'logo' => esc_html__( 'Logo', 'hirxpert-addon' ),
                    'menu' => esc_html__( 'Mobile Menu', 'hirxpert-addon' )
                ),
                'disabled' => array(
                    'search' => esc_html__( 'Search', 'hirxpert-addon' ),
                    'social' => esc_html__( 'Social Links', 'hirxpert-addon' ),
                    'mobilebar-menu-custom-text-1' => esc_html__( 'Mobile Bar Menu Custom Text 1', 'hirxpert-addon' ),
                    'mobilebar-menu-custom-text-2' => esc_html__( 'Mobile Bar Menu Custom Text 2', 'hirxpert-addon' ),
					'wpml_polylang'			=> esc_html__( 'WPML/Polylang', 'hirxpert-addon'),
					'spacer-mobile-1'		=> esc_html__( 'Spacer 1', 'hirxpert-addon' ),
					'spacer-mobile-2'		=> esc_html__( 'Spacer 2', 'hirxpert-addon' ),
					'spacer-mobile-3'		=> esc_html__( 'Spacer 3', 'hirxpert-addon' ),
					'delimiter-mobile-1'	=> esc_html__('_', 'hirxpert-addon'),
					'delimiter-mobile-2'	=> esc_html__('_', 'hirxpert-addon'),
					'delimiter-mobile-3'	=> esc_html__('_', 'hirxpert-addon'),
                )
            )
        ),
    )
) );

Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'header-tab-end'	
));

// Footer
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Site Footer', 'hirxpert-addon' ),
	'id'         => 'footer-tab',
	'config_id'  => 'customizer_settings_site_footer',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'General', 'hirxpert-addon' ),
	'id'         => 'footer-general',
	'config_id'  => 'customizer_settings_site_footer',
	'fields'	 => array(
		array(
			'id'			=> 'footer-settings-label',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Footer Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can add Footer setting in below.', 'hirxpert-addon' ),
			'seperator'		=> 'before'
		),
		array(
			'id'			=> 'footer-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Footer Layout', 'hirxpert-addon' ),
			'description'   => wp_kses_post('Choose the structure and design of footer layout such as wide or boxed <a href="widgets.php" style="text-decoration:none;">view footer widgets.</a>', 'hirxpert-addon'),
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
			'default' => 'wide'
		),
		array(
			'id'			=> 'footer-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Footer Settings', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'footer-links-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Footer Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the text color for hyperlinks in the footer section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'footer-background',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Footer Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the footer section, including color, image, size, etc.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'footer-border',
					'type'			=> 'border',
					'title'			=> esc_html__( 'Footer Border', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Configure and Customize the border style for the footer section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'footer-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Footer padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the footer section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'footer-margin',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Footer margin', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the margin (outer spacing) around the footer section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
			),
		),
		array(
			'id'			=> 'footer-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Footer Items', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the footer section using a drag-and-drop interface.', 'hirxpert-addon' ),			
			'items'			=> array(
				'footer-top'  => array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => 		array(
						array(
						'id'			=> 'insta-footer-layout',
						'type'			=> 'radioimage',
						'title'			=> esc_html__( 'Footer Top Layout', 'hirxpert-addon' ),
						'description'	=> wp_kses_post('Select the structure and design of the Footer Top section such as wide or boxed.<a href="widgets.php"> View Footer widgets.</a>', 'hirxpert-addon'),
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
						'default' => 'wide'
						),
						array(
							'id'			=> 'insta-footer-links-color',
							'type'			=> 'link',
							'title'			=> esc_html__( 'Footer Top Link Color', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Set the text color for hyperlinks in the footer top section.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'insta-footer-background',
							'type'			=> 'background',
							'title'			=> esc_html__( 'Footer Top Background Options', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Choose background settings for the footer top section, including color, image, size, etc..', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'insta-footer-border',
							'type'			=> 'border',
							'title'			=> esc_html__( 'Footer Top Border', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Configure and Customize the border style for the footer top section.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'insta-footer-padding',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Footer Top Padding', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the footer top section.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'insta-footer-margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Footer Top Margin', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Adjust the margin (outer spacing) around the footer top section.', 'hirxpert-addon' ),
							'default'		=> ''
						),		
					),
					'editable'	=> true
				),
				'footer-middle'		=> array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'			=> 'widgets-footer-layout',
							'type'			=> 'radioimage',
							'title'			=> esc_html__( 'Widgets Footer Layout', 'hirxpert-addon' ),
							'description'   => wp_kses_post('Select the widgets footer layout such as wide or boxed for widget areas in the footer <a href="widgets.php" style="text-decoration:none;"> view footer widgets.</a>', 'hirxpert-addon'),
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
							'default' => 'boxed'
						),
						array(
							'id'			=> 'footer-widgets-layout',
							'type'			=> 'radioimage',
							'title'			=> esc_html__( 'Footer Widgets Layout', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Select the column layout for widget areas in the footer.', 'hirxpert-addon' ),
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
							'default' => '12'
						),
						array(
							'id'			=> 'footer-widget-1',
							'type'			=> 'sidebars',
							'title'			=> esc_html__( 'Footer Widgets Area 1', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Choose widget for the first section of the footer widget area.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'footer-widget-2',
							'type'			=> 'sidebars',
							'title'			=> esc_html__( 'Footer Widgets Area 2', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Choose widget for the second section of the footer widget area.', 'hirxpert-addon' ),
							'default'		=> '',
							'required'		=> array( 'footer-widgets-layout', '!=', array( '12' ) )
						),
						array(
							'id'			=> 'footer-widget-3',
							'type'			=> 'sidebars',
							'title'			=> esc_html__( 'Footer Widgets Area 3', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Choose widget for the third section of the footer widget area.', 'hirxpert-addon' ),
							'default'		=> '',
							'required'		=> array( 'footer-widgets-layout', '=', array( '3-3-3-3', '3-3-6', '4-4-4', '6-3-3' ) )
						),
						array(
							'id'			=> 'footer-widget-4',
							'type'			=> 'sidebars',
							'title'			=> esc_html__( 'Footer Widgets Area 4', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Choose widget for the fourth section of the footer widget area.', 'hirxpert-addon' ),
							'default'		=> '',
							'required'		=> array( 'footer-widgets-layout', '=', array( '3-3-3-3' ) )
						),
						array(
							'id'			=> 'footer-widgets-links-color',
							'type'			=> 'link',
							'title'			=> esc_html__( ' Footer Widgets Link Color', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Set the text color for hyperlinks in the footer widgets.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'footer-widgets-background',
							'type'			=> 'background',
							'title'			=> esc_html__( ' Footer Widgets Background Options', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Choose background settings for the footer widget area, including color, image, size, etc.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'footer-widgets-border',
							'type'			=> 'border',
							'title'			=> esc_html__( 'Footer Widgets Border', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Configure and Customize the border style for the footer widget area.', 'hirxpert-addon' ),
							'default'		=> ''
						), 
						array(
							'id'			=> 'footer-widgets-padding',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Footer Widgets padding', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the footer widget area.', 'hirxpert-addon' ),
							'default'		=> ''
						),
						array(
							'id'			=> 'footer-widgets-margin',
							'type'			=> 'dimension',
							'title'			=> esc_html__( 'Footer Widgets margin', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Adjust the margin (outer spacing) around the footer widget area.', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable'	=> true
				),
				'footer-bottom'=> array(
					'title'		=> esc_html__( 'Copyrights section', 'hirxpert-addon'),
					'fields'		=> array(
						array(
							'id'			=> 'footer-bottom-layout',
							'type'			=> 'radioimage',
							'title'			=> esc_html__( 'Copyrights Layout', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Choose the structure and design of the copyright section in the footer such as wide or boxed.', 'hirxpert-addon' ),
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
							'default' => 'boxed'
						),
						array(
							'id'			=> 'copyright-widget',
							'type'			=> 'sidebars',
							'title'			=> esc_html__( 'Copyright Custom Widgets', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Select and add a custom widget for the copyright section.', 'hirxpert-addon' ),
							'default'		=> ''
						),
					),
					'editable'	=> true
				),
			),
			'default'		=> array(
				'enabled' => array(
					'footer-middle' => esc_html__( 'Footer Widgets', 'hirxpert-addon' ),
					'footer-bottom' => esc_html__( 'Copyright Section', 'hirxpert-addon' )
				),
				'disabled' => array(
					'footer-top' => esc_html__( 'Footer Top', 'hirxpert-addon' ),
				)
			)
		),
	)	
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Copyright Section', 'hirxpert-addon' ),
	'id'         => 'copyright-section',
	'config_id'  => 'customizer_settings_site_footer',
	'fields'	 => array(
		array(
			'id'			=> 'copyright-section-style-label-field',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Copyrights Section', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can set all the type of copyright section styles.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'copyright-section-links-color',
					'type'			=> 'link',
					'title'			=> esc_html__( ' Copyright Section Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the text color for hyperlinks in the copyright section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'copyright-section-background',
					'type'			=> 'background',
					'title'			=> esc_html__( ' Copyright Section Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the copyright section, including color, image, size, etc.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'copyright-sections-border',
					'type'			=> 'border',
					'title'			=> esc_html__( 'Copyright Section Border', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Configure and Customize the border style for the copyright section.', 'hirxpert-addon' ),
					'default'		=> ''
				), 
				array(
					'id'			=> 'copyright-section-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Copyright Section padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the copyright section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
				array(
					'id'			=> 'copyright-section-margin',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Copyright Section', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the margin (outer spacing) around the copyright section.', 'hirxpert-addon' ),
					'default'		=> ''
				),
			),
		),
		array(
			'id'			=> 'copyright-bar-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Copyright Bar Items', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the copyright section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'items'			=> array(
				'copyright-text' => array(
					'title'       => esc_html__( 'Copyright Text', 'hirxpert-addon' ),
					'fields'      => array(
						array(
							'id'    => 'copyright-text',
							'type'  => 'textarea',
							'title' => esc_html__( 'Copyrights Text', 'hirxpert-addon' ),
							'description' => esc_html__( 'Add the text to be displayed in the Copyright Section.', 'hirxpert-addon' ),
						),
					),
					'editable'		=> true
				)
			),
			'default'		=> array(
				'left' => array(
					
				),
				'center' => array(	
					'copyright-text' => esc_html__( 'Copyright Text', 'hirxpert-addon' )
				),
				'right' => array(					
				),
				'disabled' => array(
					'copyright-widgets' => esc_html__( 'Custom Widgets', 'hirxpert-addon' )
				)
			)
		),

	)	
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'footer-tab-end'	
));

//Templates Fields
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Templates', 'hirxpert-addon' ),
	'id'         => 'templates',
	'config_id'  => 'customizer_settings_template',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Blog Posts', 'hirxpert-addon' ),
	'id'         => 'blog-tab',
	'config_id'  => 'customizer_settings_template',
	'fields'	 => array(
		array(
			'id'			=> 'blog-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Blog Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for blog page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'blog-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the Blog Page.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id' 			=> 'blog-layout',
			'type'  		=> 'select',
			'title' 		=> esc_html__('Blog Layout', 'hirxpert-addon'),
			'description'   => esc_html__( 'Choose the structure and design of the blog page, such as grid, list, or masonry layout.', 'hirxpert-addon'),
			'choices' 		=> array(
					'standard' 	=> esc_html__( 'Standard', 'hirxpert-addon'),
					'grid' 		=> esc_html__( 'Grid', 'hirxpert-addon'),
					'list' 		=> esc_html__( 'List', 'hirxpert-addon'),
			),
			'default' 		=> 'Standard'
		),
		array(
			'id' 			=> 'blog-grid-columns',
			'type' 			=> 'select',
			'title' 		=> esc_html__( 'Blog Data Columns', 'hirxpert-addon' ),
			'description'   => esc_html__( 'Select the number of columns to display blog posts in a grid layout.', 'hirxpert-addon' ),
			'choices' 		=> array(
						'2'   => esc_html__( '2 Columns', 'hirxpert-addon' ),
						'3'   => esc_html__( '3 Columns', 'hirxpert-addon' ),
						'4'   => esc_html__( '4 Columns', 'hirxpert-addons' ),
			),
			'required' => array( 'blog-layout', '=', array('grid'))
		),
		array(
			'id' 			=> 'blog-grid-gutter',
			'type' 			=> 'number',
			'title'	 		=> esc_html__( 'Blog Data Gutter', 'hirxpert-addon' ),
			'description'   => esc_html__( 'Adjust the gutter (spacing) between blog post columns.', 'hirxpert-addon' ),
			'default'		=> '30',
			'required' 		=> array( 'blog-layout', '=', array('grid'))
		),
		array(
			'id'			=> 'blog-layout-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Blog Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all header settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'blog-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Blog Page Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'This is color settings of blog page title.', 'hirxpert-addon' ),
					'required'		=> array( 'blog-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'blog-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Blog Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'This is color settings of blog page description.', 'hirxpert-addon' ),
					'required'		=> array( 'blog-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'blog-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Blog Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'This is link color setting for blog page title links. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'blog-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'blog-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Blog Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'This is padding for common blog title. Example 10 for all side', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'blog-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'blog-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Blog Page Title Background', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'This is background settings of blog page title.', 'hirxpert-addon' ),
					'required'		=> array( 'blog-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'blog-title-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Blog Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the blog page title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'single-title', '=', array( 'true' ) )
				),
			)
		),
		array(
			'id'			=> 'blog-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Blog Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Blog Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'items'			=> array(
				'title'		=> array(
					'title'	=> esc_html__( 'Blog Title Editor Space', 'hirxpert-addon' ),
					'fields' => array(
						array(
							'id'			=> 'blog-page-title',
							'type'			=> 'text',
							'title'			=> esc_html__( 'Blog page Title', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Enter the Title to display in top of the Page.', 'hirxpert-addon' ),
							'default'		=> esc_html__( 'Latest Posts', 'hirxpert-addon' )
						),
					),
					'editable'	=> true
				),
				'description'	=> array(
					'title'	=> esc_html__( 'Blog Description Editor Space', 'hirxpert-addon' ),
					'fields'	=> array(
						array(
							'id'			=> 'blog-page-description',
							'type'			=> 'textarea',
							'title'			=> esc_html__( 'Blog page Description', 'hirxpert-addon' ),
							'description'	=> esc_html__( 'Enter a short description or tagline for the Blog Page.', 'hirxpert-addon' ),
							'default'		=> esc_html__( 'You become sound knowledge by our latest posts.', 'hirxpert-addon' )
						),
					),
					'editable'	=> true
				),
			),
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
		),
		array(
			'id'			=> 'blog-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Blog Page Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for blog page layout.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'blog-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Blog Sidebar Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose the position of the blog sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'blog-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Blog Right Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the blog page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'blog-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'blog-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Blog Left Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the blog page', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'blog-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'blog-top-meta-enable',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Top Meta', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to enable post top meta in the blog posts.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'blog-top-meta-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Blog Post Top Meta Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Blog post Top Meta section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'items'			=> array(
				'more'  => array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => 		array(
						array(
							'id'      		=> 'blog-read-more',
							'type'  		=> 'text',
							'title'			=> esc_html__( 'Blog Read More', 'hirxpert-addon'),
							'description'	=> esc_html__( 'Enter a "read more" text to display in the Blog post excerpt (description).', 'hirxpert-addon' ),
							'default' 		=> 'Read more',
						),
					),
					'editable'	=> true
				),
			),
			'default'		=> array(
				'left' => array(
					'author' => esc_html__( 'Author', 'hirxpert-addon' )
				),
				'right' => array(
					'category' => esc_html__( 'Category', 'hirxpert-addon' )
				),
				'disabled' => array(
					'date' => esc_html__( 'Date', 'hirxpert-addon' ),
					'tag' => esc_html__( 'Tag', 'hirxpert-addon' ),
					'share' => esc_html__( 'Social Share', 'hirxpert-addon' ),
					'more' => esc_html__( 'Read More', 'hirxpert-addon' )
				)
			),
			'required'		=> array( 'blog-top-meta-enable', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'blog-bottom-meta-enable',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Bottom Meta', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to enable post bottom meta in the blog posts.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'blog-bottom-meta-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Blog Post Bottom Meta Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Blog post Bottom Meta section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'items'			=> array(
				'more'  => array(
					'title'       => esc_html__( 'Editor Space', 'hirxpert-addon' ),
					'fields'      => 		array(
						array(
							'id'      		=> 'blog-read-more',
							'type'  		=> 'textarea',
							'title'			=> esc_html__( 'Blog Read More', 'hirxpert-addon'),
							'description'	=> esc_html__( 'Add an icon class in front or back of the "read more" text is display in excerpt. Example:Read more', 'hirxpert-addon' ),
							'default' 		=> 'Read more',
							'required'		=> array( 'blog-read-more-settings', '=', array( 'custom' ) )
						),
					),
					'editable'	=> true
				),
			),
			'default'		=> array(
				'left' => array(
				),
				'right' => array(
					'more' => esc_html__( 'Read More', 'hirxpert-addon' )
				),
				'disabled' => array(
					'tag' => esc_html__( 'Tag', 'hirxpert-addon' ),
					'author' => esc_html__( 'Author', 'hirxpert-addon' ),
					'category' => esc_html__( 'Category', 'hirxpert-addon' ),
					'date' => esc_html__( 'Date', 'hirxpert-addon' ),
					'share' => esc_html__( 'Social Share', 'hirxpert-addon' )
				)
			),
			'required'		=> array( 'blog-bottom-meta-enable', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'blog-post-excerpt-length',
			'type'			=> 'text',
			'title'			=> esc_html__( 'Excerpt Length', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Enter the excerpt length (no. of words) of blog post. Leave this empty to set wp default excerpt length of posts.', 'hirxpert-addon' ),
			'default'		=> 20
		),
	)
) );

Hirxpert_Options::hirxpert_set_sub_section(array(
    'title' => esc_html__('Page 404', 'hirxpert-addon'),
    'id' => '404-option',
	'config_id'  => 'customizer_settings_template',
    'fields' => array(
		array(
			'id'    	=> '',
			'type'  	=> 'label',
			'title' 	=> esc_html__('404 Page Layout', 'hirxpert-addon'),
		),
        array(
            'id' => '404_building_tool',
            'type' => 'select',
            'title' => esc_html__('404 page', 'hirxpert-addon'),
			'description'	=> esc_html__('Select a page to display when a page is not found ( 404 error ).', 'hirxpert-addon'),
            'choices' => array(
                'default' => esc_html__('Theme Default', 'hirxpert-addon'),
                'elementor' => esc_html__('Elementor', 'hirxpert-addon'),
            ),
            'default' => 'default',
        ),
		array(
			'id'       => '404-page-selector',
			'type'     => 'pages',
			'title'    => esc_html__( 'Select 404 Template page', 'hirxpert-addon' ),
			'description'     => esc_html__( 'Select a Elementor page to display in place of 404 template page.', 'hirxpert-addon' ),
			'default'  => '',
			'required'		=> array( '404_building_tool', '=', array( 'elementor' ) )
		),
    ),
));

Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Posts Archive', 'hirxpert-addon' ),
	'id'         => 'archive-tab',
	'config_id'  => 'customizer_settings_template',
	'fields'	 => array(
		array(
			'id'			=> 'archive-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Archive Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for archive page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'archive-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the Archive Page.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'archive-layout-setting',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Archive Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all Archive styles settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'archive-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Archive Page Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the title of the archive page.', 'hirxpert-addon' ),
					'required'		=> array( 'archive-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'archive-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Archive Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the description of the archive page.', 'hirxpert-addon' ),
					'required'		=> array( 'archive-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'archive-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Archive Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the hyperlinks of the archive page title. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'archive-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'archive-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Archive Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the Archive Title section.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'archive-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'archive-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Archive Page Title Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the Archive Page Title section, including color, image, size, etc.', 'hirxpert-addon' ),
					'required'		=> array( 'archive-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'archive-title-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Archive Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the Archive page title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'single-title', '=', array( 'true' ) )
				),
			),
		),
		array(
			'id'			=> 'archive-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Archive Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Archive Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
		),

		array(
			'id'			=> 'archive-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Archive Page Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for archive page layout.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'archive-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Archive Sidebar Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose the position of the archive page sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'archive-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Archive Right Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the Archive page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'archive-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'archive-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Archive Left Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the Archive page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'archive-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'archive-top-meta-enable',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Top Meta', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to enable post top meta in the Archive Page Items.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'archive-top-meta-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Archive Post Top Meta Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Archive post Top Meta section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'default'		=> array(
				'left' => array(
					'author' => esc_html__( 'Author', 'hirxpert-addon' )
				),
				'right' => array(
					'category' => esc_html__( 'Category', 'hirxpert-addon' )
				),
				'disabled' => array(
					'date' => esc_html__( 'Date', 'hirxpert-addon' ),
					'tag' => esc_html__( 'Tag', 'hirxpert-addon' ),
					'share' => esc_html__( 'Social Share', 'hirxpert-addon' )
				)
			),
			'required'		=> array( 'archive-top-meta-enable', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'archive-bottom-meta-enable',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Bottom Meta', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to enable post bottom meta in the blog posts.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'archive-bottom-meta-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Archive Post Bottom Meta Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Blog post Bottom Meta section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'default'		=> array(
				'left' => array(
				),
				'right' => array(		
					'more' => esc_html__( 'Read More', 'hirxpert-addon' )
				),
				'disabled' => array(
					'tag' => esc_html__( 'Tag', 'hirxpert-addon' ),
					'author' => esc_html__( 'Author', 'hirxpert-addon' ),
					'category' => esc_html__( 'Category', 'hirxpert-addon' ),
					'date' => esc_html__( 'Date', 'hirxpert-addon' ),
					'share' => esc_html__( 'Social Share', 'hirxpert-addon' )
				)
			),
			'required'		=> array( 'archive-bottom-meta-enable', '=', array( 'true' ) )
		),
		array(
			'id'            => 'search-templates',
			'type'          => 'multicheck',
			'title'         => esc_html__( 'Search Content', 'hirxpert-addon' ),
			'description'   => esc_html__( 'Select templates to be displayed in search results posts, pages, or custom post types.', 'hirxpert-addon' ),
			'items'       => array(
				'post'        	  => esc_html__( 'Post', 'hirxpert-addon' ),
				'page'        	  => esc_html__( 'Page', 'hirxpert-addon' ),
				'cea-team'        => esc_html__( 'Team', 'hirxpert-addon' ),
				'cea-event'       => esc_html__( 'Event', 'hirxpert-addon' ),
				'cea-service' 	  => esc_html__( 'Service', 'hirxpert-addon' ),
				'cea-testimonial' => esc_html__( 'Testimonial', 'hirxpert-addon' ),
				'cea-portfolio'   => esc_html__( 'Portfolio', 'hirxpert-addon' )
			),
			'default'       => array( 'post', 'page' ), 
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Post Single', 'hirxpert-addon' ),
	'id'         => 'post-single-tab',
	'config_id'  => 'customizer_settings_template',
	'fields'	 => array(
		array(
			'id'			=> 'single-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Single Post Page Title Settings', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'This is settings for single post page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'single-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the Single Page.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'single-post-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Post Single Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all Post Single settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'single-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Single Post Page Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the title of the Single Post page.', 'hirxpert-addon' ),
					'required'		=> array( 'single-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'single-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Single Post Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the description of the Single Post page.', 'hirxpert-addon' ),
					'required'		=> array( 'single-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'single-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Single Post Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the hyperlinks of the Single Post page title. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'single-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'single-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Single Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the Single Post Title section.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'single-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'single-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Single Post Page Title Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the Single Post Page Title section, including color, image, size, etc.', 'hirxpert-addon' ),
					'required'		=> array( 'single-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'single-title-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Single Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the Single Post page title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'single-title', '=', array( 'true' ) )
				),
			),
		),
		array(
			'id'			=> 'single-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Single Post Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Single Post Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
		),
		array(
			'id'			=> 'single-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Single Post Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for single blog post page layout.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'single-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Single Post Sidebar Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose the position of the single page sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'single-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Single Post Right Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the Single page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'single-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'single-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Single Post Left Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the Single page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'single-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'single-top-meta-enable',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Top Meta', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to enable post top meta in the Single Page.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'single-top-meta-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Single Post Top Meta Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Single post Top Meta section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'default'		=> array(
				'left' => array(
					'author' => esc_html__( 'Author', 'hirxpert-addon' )
				),
				'right' => array(
					'category' => esc_html__( 'Category', 'hirxpert-addon' )
				),
				'disabled' => array(
					'date' => esc_html__( 'Date', 'hirxpert-addon' ),
					'tag' => esc_html__( 'Tag', 'hirxpert-addon' ),
					'share' => esc_html__( 'Social Share', 'hirxpert-addon' )
				)
			),
			'required'		=> array( 'single-top-meta-enable', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'single-bottom-meta-enable',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Bottom Meta', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to enable post bottom meta in the Single Page.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'single-bottom-meta-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Single Post Bottom Meta Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Single post Bottom Meta section using a drag-and-drop interface.', 'hirxpert-addon' ),
			'default'		=> array(
				'left' => array(
					'tag' => esc_html__( 'Tag', 'hirxpert-addon' ),
				),
				'right' => array(		
					'share' => esc_html__( 'Social Share', 'hirxpert-addon' )			
				),
				'disabled' => array(
					'author' => esc_html__( 'Author', 'hirxpert-addon' ),
					'category' => esc_html__( 'Category', 'hirxpert-addon' ),
					'date' => esc_html__( 'Date', 'hirxpert-addon' )
				)
			),
			'required'		=> array( 'single-bottom-meta-enable', '=', array( 'true' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Page', 'hirxpert-addon' ),
	'id'         => 'post-page-tab',
	'config_id'  => 'customizer_settings_template',
	'fields'	 => array(
		array(
			'id'			=> 'page-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for single post page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'page-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the Single Page.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'page-layout-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Page Layout', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all Page Layout settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'page-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Page Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the title of the page.', 'hirxpert-addon' ),
					'required'		=> array( 'page-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'page-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Page Title Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the description of the page.', 'hirxpert-addon' ),
					'required'		=> array( 'page-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'page-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Page Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the hyperlinks of the page title. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'page-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'page-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Page Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the page Title section.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'page-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'page-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Page Title Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the Page Title section, including color, image, size, etc.', 'hirxpert-addon' ),
					'required'		=> array( 'page-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'page-title-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the page title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'page-title', '=', array( 'true' ) )
				),
			),
		),
		array(
			'id'			=> 'page-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Single Page Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
		),
		
		array(
			'id'			=> 'page-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Page Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for page layout.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'page-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Single Page Sidebar Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose the position of the page sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'page-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Page Right Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the Single page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'page-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'page-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Page Left Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the Single page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'page-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		)
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Custom Posts Archive', 'hirxpert-addon' ),
	'id'         => 'custom-posts-tab',
	'config_id'  => 'customizer_settings_template',
	'fields'	 => array(
		array(
			'id'			=> 'custom-archive-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Custom Archive Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for custom archive page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'custom-archive-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the Custom Post Archive.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'custom-archive-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Custom Archive Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all Custom Post Archive settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'custom-archive-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Custom Archive Page Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the title of the custom archive page.', 'hirxpert-addon' ),
					'required'		=> array( 'custom-archive-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'custom-archive-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Custom Archive Page Title Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the description of the custom archive page.', 'hirxpert-addon' ),
					'required'		=> array( 'page-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'custom-archive-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Custom Archive Page Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the hyperlinks of the custom archive page title. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'custom-archive-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'custom-archive-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Custom Archive Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the custom archive page Title section.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'custom-archive-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'custom-archive-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Custom Archive Page Title Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the custom archive Page Title section, including color, image, size, etc.', 'hirxpert-addon' ),
					'required'		=> array( 'custom-archive-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'custom-archive-title-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Custom Archive Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the custom archive page title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'custom-archive-title', '=', array( 'true' ) )
				),
			),
		),
		array(
			'id'			=> 'custom-archive-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Custom Archive Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Custom Post Archive Page Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
		),

		array(
			'id'			=> 'custom-archive-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Custom Archive Page Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for custom archive page layout.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'custom-archive-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Archive Sidebar Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose the position of the Custom Post Archive Page sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'custom-archive-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Right Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the Custom Post Archive page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'custom-archive-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'custom-archive-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Left Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the Custom Post Archive page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'custom-archive-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Custom Post Single', 'hirxpert-addon' ),
	'id'         => 'custom-post-single-tab',
	'config_id'  => 'customizer_settings_template',
	'fields'	 => array(
		array(
			'id'			=> 'custom-single-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Custom Single Post Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for custom single post page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'custom-single-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the Custom Post Single.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'custom-single-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Custom Single Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all Custom Single settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'custom-single-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Custom Single Post Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the title of the custom single post page.', 'hirxpert-addon' ),
					'required'		=> array( 'custom-single-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'custom-single-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'Custom Single Post Title Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the description of the custom single post page.', 'hirxpert-addon' ),
					'required'		=> array( 'custom-single-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'custom-single-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'Custom Single Post Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the hyperlinks of the custom single post page title. Like breadcrumbs color. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'custom-single-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'custom-single-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Custom Single Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the custom single post page Title section.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'custom-single-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'custom-single-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'Custom Single Post Page Title Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the custom single post Page Title section, including color, image, size, etc.', 'hirxpert-addon' ),
					'required'		=> array( 'custom-single-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'custom-single-title-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Custom Single Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the custom single post page title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'custom-single-title', '=', array( 'true' ) )
				),
			),
		),
		array(
			'id'			=> 'custom-single-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'Custom Single Post Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Custom Post Single Page Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
		),
		array(
			'id'			=> 'custom-single-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Custom Single Post Page Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for archive page layout.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'custom-single-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Custom Single Post Sidebar Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose the position of the Custom Post Single Page sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
			'default' => 'right-sidebar'
		),
		array(
			'id'			=> 'custom-single-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Right Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the Custom Post Single page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'custom-single-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'custom-single-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Left Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the Custom Post Single page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'custom-single-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'templates-tab-end'	
));

do_action( 'hirxpert_custom_template_options' );

// Social
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Social', 'hirxpert-addon' ),
	'id'         => 'social-tab',
	'config_id'  => 'customizer_settings_social',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Social Links', 'hirxpert-addon' ),
	'id'         => 'social-links-tab',
	'config_id'  => 'customizer_settings_social',
	'fields'	 => array(
		array(
			'id'			=> 'social-links-styling',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Social Link Style Editor', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can modify the styles of the Social Links.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'social-icon-window',
					'type'			=> 'select',
					'title'			=> esc_html__( 'Target Window', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose whether links open in the same window or a new tab when clicked.', 'hirxpert-addon' ),
					'choices'		=> array(
						''			=> esc_html__( 'Default', 'hirxpert-addon' ),
						'_self'		=> esc_html__( 'Self', 'hirxpert-addon' ),
						'_blank'	=> esc_html__( 'Blank', 'hirxpert-addon' ),
						'_parent'	=> esc_html__( 'Parent', 'hirxpert-addon' )
					),
					'default'		=> ''
				),
				array(
					'id'       => 'social-icons-fore',
					'type'     => 'select',
					'title'    => esc_html__( 'Social Icons Fore', 'hirxpert-addon' ),
					'description'     => esc_html__( 'Choose whether to use the theme color or custom color for Icon.', 'hirxpert-addon' ),
					'choices'  => array(
						'own'		=> esc_html__( 'Own Color', 'hirxpert-addon' ),
						'custom'	=> esc_html__( 'Custom Color', 'hirxpert-addon' )
					),
					'default'  => 'black'
				),
				array(
					'id'	  		=> 'social-icons-fore-custom',
					'type'	  		=> 'color',
					'title'    => esc_html__( 'Social Icons Fore Custom Color', 'hirxpert-addon' ),
					'description'     => esc_html__( 'Set the custom color for the foreground (icon color) of social media icons.', 'hirxpert-addon' ),
					'required'		=> array( 'social-icons-fore', '=', array( 'custom' ) )
				),
				array(
					'id'       => 'social-icons-hfore',
					'type'     => 'select',
					'title'    => esc_html__( 'Social Icons Fore Hover', 'hirxpert-addon' ),
					'description'     => esc_html__( 'Choose whether to use the theme color or custom hover color for Icon.', 'hirxpert-addon' ),
					'choices'  => array(
						'h-own'		=> esc_html__( 'Own Color', 'hirxpert-addon' ),
						'h-custom'  => esc_html__( 'Custom Color', 'hirxpert-addon' ),
					),
					'default'  => 'h-own'
				),
				array(
					'id'	  		=> 'social-icons-hfore-custom',
					'type'	  		=> 'color',
					'title'    		=> esc_html__( 'Social Icons Fore  Hover Custom Color', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Set the custom hover color for the foreground (icon color) of social media icons.', 'hirxpert-addon' ),
					'required'		=> array( 'social-icons-hfore', '=', array( 'h-custom' ) )
				),
				array(
					'id'       => 'social-icons-bg',
					'type'     => 'select',
					'title'    => esc_html__( 'Social Icons Background', 'hirxpert-addon' ),
					'description'     => esc_html__( 'Choose whether to use the theme background color or custom background color for Icon.', 'hirxpert-addon' ),
					'choices'  => array(
						'bg-own'		=> esc_html__( 'Own Color', 'hirxpert-addon' ),
						'bg-custom'		=> esc_html__( 'Custom Color', 'hirxpert-addon' )
					),
					'default'  => '',
				),
				array(
					'id'	  		=> 'social-icons-bg-custom',
					'type'	  		=> 'color',
					'title'    		=> esc_html__( 'Social Icons Background', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Set the custom color for the background (icon color) of social media icons.', 'hirxpert-addon' ),
					'required'		=> array( 'social-icons-bg', '=', array( 'bg-custom' ) )
				),
				array(
					'id'       => 'social-icons-hbg',
					'type'     => 'select',
					'title'    => esc_html__( 'Social Icons Background Hover', 'hirxpert-addon' ),
					'description'     => esc_html__( 'Choose whether to use the theme background color or custom hover background color for Icon.', 'hirxpert-addon' ),
					'choices'  => array(
						'hbg-own'		=> esc_html__( 'Own Color', 'hirxpert-addon' ),
						'hbg-custom'	=> esc_html__( 'Custom Color', 'hirxpert-addon')
					),
					'default'  => ''
				),
				array(
					'id'	  		=> 'social-icons-hbg-custom',
					'type'	  		=> 'color',
					'title'         => esc_html__( 'Social Icons Background Hover', 'hirxpert-addon' ),
					'description'   => esc_html__( 'Set the custom hover color for the background (icon color) of social media icons.', 'hirxpert-addon' ),
					'required'		=> array( 'social-icons-hbg', '=', array( 'hbg-custom' ) )
				),
				array(
					'id'          => 'social-icons-border-color',
					'type'        => 'color',
					'title'       => esc_html__( 'Social Icons Border Color', 'hirxpert-addon' ),
					'description' => esc_html__( 'Set a custom color for border of the social icons.', 'hirxpert-addon' ),
				),
				array(
					'id'          => 'social-icons-border-width',
					'type'        => 'number',
					'title'       => esc_html__( 'Social Icons Border Width', 'hirxpert-addon' ),
					'description' => esc_html__( 'Set the thickness of the border around social media icons (in pixels).', 'hirxpert-addon' ),
					'default'     => 0,
				),
				array(
					'id'          => 'social-icons-border-radius',
					'type'        => 'number',
					'title'       => esc_html__( 'Social Icons Border Radius', 'hirxpert-addon' ),
					'description' => esc_html__( 'Adjust the roundness of the social media icons borders for a square or circular look (in pixels).', 'hirxpert-addon' ),
					'default'     => 50,
				),
				array(
					'id'		  => 'social-icons-border-style',
					'type'	      => 'select',
					'title'       => esc_html__( 'Social Icons border Style', 'hirxpert-addon' ),
					'description' => esc_html__( 'Choose the style of the border around social media icons.', 'hirxpert-addon' ),
					'default'	  => '',
					'choices'	  => array(
						'none'		=> esc_html__( 'None', 'hirxpert-addon' ),
						'solid'		=> esc_html__( 'Solid', 'hirxpert-addon' ),
						'dashed'	=> esc_html__( 'Dashed', 'hirxpert-addon' ),
						'dotted'	=> esc_html__( 'Dotted', 'hirxpert-addon' ),
						'double'	=> esc_html__( 'Double', 'hirxpert-addon' ),
						'groove'	=> esc_html__( 'Groove', 'hirxpert-addon' ),
						'ridge'		=> esc_html__( 'Ridge', 'hirxpert-addon' ),
						'inset'		=> esc_html__( 'Inset', 'hirxpert-addon' ),
						'outset'	=> esc_html__( 'Outset', 'hirxpert-addon' )
					)
				),
			),
		),
		array(
			'id'			=> 'social-links',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Social Links', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the social icons you need in your site using a drag-and-drop interface. Click on the Social icon to add your Social link URL\'s.', 'hirxpert-addon' ),
			'html'			=> true,
			'default'		=> array(
				'enabled' => array(
					'facebook' => 'fa fa-facebook',
					'twitter' => 'bi bi-twitter-x',
					'linkedin' => 'fa fa-linkedin',
					'instagram' => 'fa fa-instagram'
				),
				'disabled' => array(
					'vimeo' => 'fa fa-vimeo',
					'yahoo' => 'fa fa-yahoo',
					'youtube' => 'fa fa-youtube-play',
					'tumblr ' => 'fa fa-tumblr',
					'stack-overflow' => 'fa fa-stack-overflow',
					'pinterest' => 'fa fa-pinterest-p',
					'jsfiddle' => 'fa fa-jsfiddle',
					'reddit' => 'fa fa-reddit-alien',
					'soundcloud' => 'fa fa-soundcloud',
					'xing' => 'fa fa-xing',
					'wikipedia' => 'fa fa-wikipedia-w',
					'whatsapp' => 'fa fa-whatsapp',
					'tiktok' => 'bi bi-tiktok',
				)
			)
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Social Share', 'hirxpert-addon' ),
	'id'         => 'social-share-tab',
	'config_id'  => 'customizer_settings_social',
	'fields'	 => array(
		array(
			'id'			=> 'social-share',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Social Share', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the social share links you need in the Single Post using a drag-and-drop interface.', 'hirxpert-addon' ),
			'html'			=> true,
			'icons_only'	=> true,
			'default'		=> array(
				'enabled' => array(
					'facebook' => 'fa fa-facebook',
					'twitter' => 'bi bi-twitter-x',
					'linkedin' => 'fa fa-linkedin',
					'instagram' => 'fa fa-instagram'
				),
				'disabled' => array(
					'pinterest' => 'fa fa-pinterest-p',
					'whatsapp' => 'fa fa-whatsapp',
					'tumblr ' => 'fa fa-tumblr',
					'vimeo' => 'fa fa-vimeo',
					'yahoo' => 'fa fa-yahoo',
					'youtube' => 'fa fa-youtube-play',
					'stack-overflow' => 'fa fa-stack-overflow',
					'jsfiddle' => 'fa fa-jsfiddle',
					'reddit' => 'fa fa-reddit-alien',
					'soundcloud' => 'fa fa-soundcloud',
					'xing' => 'fa fa-xing',
					'wikipedia' => 'fa fa-wikipedia-w',
					'tiktok' => 'bi bi-tiktok',
				)
			)
		),
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'social-tab-end'
));


/**
 *  Increase Performance. For Frontend.
 */
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Performance', 'hirxpert-addon' ),
	'id'         => 'performance-tab',
	'config_id'  => 'customizer_settings_performance',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Improve Performance', 'hirxpert-addon' ),
	'id'         => 'performance-general-tab',
	'config_id'  => 'customizer_settings_performance',
	'fields'	 => array(
		array(
			'id' 			=> 'performance',
			'type'			=> 'toggle',
			'title' 		=> esc_html__( 'Improve performance', 'hirxpert-addon'),
			'description'   => esc_html__( 'Toggle to enable the performance tab to increase the speed of the site.', 'hirxpert-addon' ),
			'default' 		=> false
		),
		array(
			'id'			=> 'minify-css',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Minify CSS', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle this to minify all the stylesheets used in this theme to reduce file size and improve site performance.', 'hirxpert-addon' ),
			'default'		=> false,
			'required'		=> array( 'performance', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'minify-js',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Minify JS', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle this to minify all the js scripts used in this theme to reduce file size and improve site performance.', 'hirxpert-addon' ),
			'default'		=> false,
			'required'		=> array( 'performance', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'emoji-script',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Disable Emoji Scripts', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Enable this option to prevent WordPress from loading emoji scripts, improving page speed.', 'hirxpert-addon' ),
			'default'		=> false,
			'required'		=> array( 'performance', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'gzip-comp',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Gzip Compression', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Enable Gzip compression to reduce file sizes and improve website loading speed.', 'hirxpert-addon' ),
			'default'		=> false,
			'required'		=> array( 'performance', '=', array( 'true' ) )
		),
		array(
			'id' 			=> 'woo-scripts-styles',
			'type'			=> 'toggle',
			'title' 		=> esc_html__( 'Disable WooCommerce Scripts & Style', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Disable unnecessary WooCommerce scripts and styles on non-WooCommerce pages to improve performance.', 'hirxpert-addon'),
			'default' 		=> false,
			'required'		=> array( 'performance', '=', array( 'true' ) )
		)
	)
));
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'performance-tab-end'
));


/**
 * Detect plugin. For frontend only.
 */
include_once ABSPATH . 'wp-admin/includes/plugin.php';
 
// check for plugin using plugin name
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
    require_once ( HIRXPERT_ADDON_DIR . 'admin/extension/theme-options/woo-config.php' );
} 

// Maintenance or Coming Soon Mode
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Maintenance', 'hirxpert-addon' ),
	'id'         => 'maintenance-tab',
	'config_id'  => 'customizer_settings_maintenance'
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Maintenance', 'hirxpert-addon' ),
	'id'         => 'maintenance-general-tab',
	'config_id'  => 'customizer_settings_maintenance',
	'fields'	 => array(
		array(
			'id'			=> 'maintenance-opt',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Maintenance Mode Option', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Enable or disable maintenance mode to display a temporary "coming soon" or "under maintenance" page.', 'hirxpert-addon' ),
			'default'		=> false
		),
		array(
			'id'       => 'maintenance-type',
			'type'     => 'select',
			'title'    => esc_html__( 'Maintenance Type', 'hirxpert-addon' ),
			'description'     => esc_html__( 'Choose the type of maintenance mode, such as "Coming Soon" or "Maintenance".', 'hirxpert-addon' ),
			'choices'  => array(
				'cs'		=> esc_html__( 'Coming Soon', 'hirxpert-addon' ),
				'mn'		=> esc_html__( 'Maintenance', 'hirxpert-addon' ),
				'cus'		=> esc_html__( 'Custom', 'hirxpert-addon' )
			),
			'default'  => 'cs',
			'required'		=> array( 'maintenance-opt', '=', array( 'true' ) )
		),
		array(
			'id'       => 'maintenance-custom',
			'type'     => 'pages',
			'title'    => esc_html__( 'Maintenance Custom Page', 'hirxpert-addon' ),
			'description'     => esc_html__( 'Select a custom page to display when maintenance mode is enabled.', 'hirxpert-addon' ),
			'default'  => '',
			'required'		=> array( 'maintenance-type', '=', array( 'cus' ) )
		),
		array(
			'id'			=> 'maintenance-phone',
			'type'			=> 'text',
			'title'			=> esc_html__( 'Phone', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Enter the phone number to display on the site for contact purposes when maintenance mode is enabled.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'maintenance-opt', '=', array( 'true' ) )
		),		
		array(
			'id'			=> 'maintenance-email',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Email', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Enter the email address to display on the site for contact purposes when maintenance mode is enabled', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'maintenance-opt', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'maintenance-address',
			'type'			=> 'textarea',
			'title'			=> esc_html__( 'Address', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Enter the contact address to display on the maintenance mode page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'maintenance-opt', '=', array( 'true' ) )
		),
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'maintenance-tab-end'
) );

// Import/Export
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Import/Export', 'hirxpert-addon' ),
	'id'         => 'ie-tab',
	'config_id'  => 'customizer_settings_import',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Import', 'hirxpert-addon' ),
	'id'         => 'import-tab',
	'config_id'  => 'customizer_settings_import',
	'fields'	 => array(
		array(
			'id'			=> 'hirxpert-import',
			'type'			=> 'import',
			'title'			=> esc_html__( 'Import Theme Option Json', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Paste theme options json value here and press import button and wait untill process complete. Once saved theme options please hard refresh your frontend, so only dynamically generated CSS will update.', 'hirxpert-addon' ),
			'default'		=> ''
		),
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Export', 'hirxpert-addon' ),
	'id'         => 'export-tab',
	'config_id'  => 'customizer_settings_import',
	'fields'	 => array(
		array(
			'id'			=> 'hirxpert-export',
			'type'			=> 'export',
			'title'			=> esc_html__( 'Export Theme Option Json', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Generate and download a JSON file containing the current theme settings for backup or transfer. Once click export button wait few seconds.', 'hirxpert-addon' ),
			'default'		=> ''
		),
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'ie-tab-end'	
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