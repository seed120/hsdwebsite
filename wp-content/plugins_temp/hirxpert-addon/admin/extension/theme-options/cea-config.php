<?php 

//CEA Templates Fields
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'CEA Templates', 'hirxpert-addon' ),
	'id'         => 'cea-templates',
	'config_id'  => 'customizer_settings_cea_templates',
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'CEA Service', 'hirxpert-addon' ),
	'id'         => 'cea-service-single-tab',
	'config_id'  => 'customizer_settings_cea_templates',
	'fields'	 => array(
		array(
			'id'			=> 'cea-service-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Service Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for CEA service title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-service-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the CEA service title section.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'cea-service-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Cea Service Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all Services Layout settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'cea-service-sidebar-layout',
					'type'			=> 'radioimage',
					'title'			=> esc_html__( 'CEA Service Sidebar Layout', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose the position of the CEA service sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
					'id'			=> 'cea-service-right-sidebar',
					'type'			=> 'sidebars',
					'title'			=> esc_html__( 'Right Widgets Area', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the CEA Service.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-service-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
				),
				array(
					'id'			=> 'cea-service-left-sidebar',
					'type'			=> 'sidebars',
					'title'			=> esc_html__( 'Left Widgets Area', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Select and add widget to the laft sidebar area of the CEA Service.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-service-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
				),
				array(
					'id'			=> 'cea-service-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'CEA Service Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the title of the CEA service.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-service-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'CEA Service Title Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the description of the CEA Service Title.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-service-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'CEA Service Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the hyperlinks of the CEA Service title. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-service-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'CEA Service Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the CEA Service Title section.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-service-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'CEA Service Page Title Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the CEA Service Title section, including color, image, size, etc.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-service-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Service Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the CEA Service title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-service-title', '=', array( 'true' ) )
				),
			),
		),
		array(
			'id'			=> 'cea-service-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'CEA Service Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the CEA Service Page Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'CEA Team', 'hirxpert-addon' ),
	'id'         => 'cea-team-single-tab',
	'config_id'  => 'customizer_settings_cea_templates',
	'fields'	 => array(
		array(
			'id'			=> 'cea-team-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Team Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for CEA team page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-team-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the CEA Team title section.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'cea-team-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Cea Team Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all Team Layout settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'cea-team-sidebar-layout',
					'type'			=> 'radioimage',
					'title'			=> esc_html__( 'CEA Team Sidebar Layout', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose the position of the CEA Team sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
					'id'			=> 'cea-team-right-sidebar',
					'type'			=> 'sidebars',
					'title'			=> esc_html__( 'Right Widgets Area', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the CEA Team.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-team-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
				),
				array(
					'id'			=> 'cea-team-left-sidebar',
					'type'			=> 'sidebars',
					'title'			=> esc_html__( 'Left Widgets Area', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the CEA Team.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-team-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
				),
				array(
					'id'			=> 'cea-team-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'CEA Team Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the title of the CEA Team.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-team-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'CEA Team Title Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the description of the CEA Team Title.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-team-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'CEA Team Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the hyperlinks of the CEA Team title. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-team-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'CEA Team Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the CEA Team Title section.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-team-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'CEA Team Page Title Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the CEA Team Title section, including color, image, size, etc.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-team-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Team Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the CEA Team title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-team-title', '=', array( 'true' ) )
				),
			),
		),
		array(
			'id'			=> 'cea-team-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'CEA Team Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the CEA Team Page Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'CEA Testimonial', 'hirxpert-addon' ),
	'id'         => 'cea-testimonial-single-tab',
	'config_id'  => 'customizer_settings_cea_templates',
	'fields'	 => array(
		array(
			'id'			=> 'cea-testimonial-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Testimonial Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for CEA testimonial page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-testimonial-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the CEA Testimonial title section.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'cea-testimonial-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Cea Testimonial Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all Testimonial Layout settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'cea-testimonial-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'CEA Testimonial Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the title of the CEA Testimonial.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-testimonial-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'CEA Testimonial Title Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the description of the CEA Testimonial Title.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-testimonial-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'CEA Testimonial Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the hyperlinks of the CEA Testimonial title. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-testimonial-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'CEA Testimonial Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the CEA Testimonial Title section.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-testimonial-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'CEA Testimonial Page Title Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the CEA Testimonial Title section, including color, image, size, etc.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-testimonial-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Testimonial Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the CEA Testimonial title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-testimonial-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-testimonial-sidebar-layout',
					'type'			=> 'radioimage',
					'title'			=> esc_html__( 'CEA Testimonial Sidebar Layout', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose the position of the CEA Testimonial sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
					'id'			=> 'cea-testimonial-right-sidebar',
					'type'			=> 'sidebars',
					'title'			=> esc_html__( 'Right Widgets Area', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the CEA Testimonial.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-testimonial-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
				),
				array(
					'id'			=> 'cea-testimonial-left-sidebar',
					'type'			=> 'sidebars',
					'title'			=> esc_html__( 'Left Widgets Area', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the CEA Testimonial.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-testimonial-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
				),
			),
		),
		array(
			'id'			=> 'cea-testimonial-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'CEA Testimonial Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the CEA Testimonial Page Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'CEA Portfolio', 'hirxpert-addon' ),
	'id'         => 'cea-portfolio-single-tab',
	'config_id'  => 'customizer_settings_cea_templates',
	'fields'	 => array(
		array(
			'id'			=> 'cea-portfolio-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Portfolio Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for CEA portfolio page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-portfolio-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the CEA Portfolio title section.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'cea-portfolio-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Cea Portfolio Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all Portfolio Layout settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'cea-portfolio-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'CEA Portfolio Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the title of the CEA Portfolio.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-portfolio-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'CEA Portfolio Title Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the description of the CEA Portfolio Title.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-portfolio-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'CEA Portfolio Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the hyperlinks of the CEA Portfolio title. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-portfolio-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'CEA Portfolio Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the CEA Portfolio Title section.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-portfolio-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'CEA Portfolio Page Title Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the CEA Portfolio Title section, including color, image, size, etc.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-portfolio-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Portfolio Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the CEA Portfolio title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-portfolio-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-portfolio-sidebar-layout',
					'type'			=> 'radioimage',
					'title'			=> esc_html__( 'CEA Portfolio Sidebar Layout', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose the position of the CEA Portfolio sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
					'id'			=> 'cea-portfolio-right-sidebar',
					'type'			=> 'sidebars',
					'title'			=> esc_html__( 'Right Widgets Area', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the CEA Portfolio.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-portfolio-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
				),
				array(
					'id'			=> 'cea-portfolio-left-sidebar',
					'type'			=> 'sidebars',
					'title'			=> esc_html__( 'Left Widgets Area', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the CEA Portfolio.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-portfolio-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
				),
			),
		),
		array(
			'id'			=> 'cea-portfolio-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'CEA Portfolio Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the CEA Portfolio Page Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
	)
) );
Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'CEA Event', 'hirxpert-addon' ),
	'id'         => 'cea-event-single-tab',
	'config_id'  => 'customizer_settings_cea_templates',
	'fields'	 => array(
		array(
			'id'			=> 'cea-event-pt-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'CEA Event Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for CEA event page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'cea-event-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the CEA Event title section.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'cea-event-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Cea Event Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'Here you can control all Event Layout settings.', 'hirxpert-addon' ),
			'seperator'		=> 'before',
			'show_edit_icon' => true,
			'fields'		=> array(
				array(
					'id'			=> 'cea-event-title-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'CEA Event Title Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the title of the CEA Event.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-event-title-desc-color',
					'type'			=> 'color',
					'title'			=> esc_html__( 'CEA Event Title Description Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the description of the CEA Event Title.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-event-title-link-color',
					'type'			=> 'link',
					'title'			=> esc_html__( 'CEA Event Title Link Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the color for the hyperlinks of the CEA Event title. Like breadcrumbs color.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-event-title-padding',
					'type'			=> 'dimension',
					'title'			=> esc_html__( 'Custom Single Title Padding', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the CEA Event Title section.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-event-title-bg',
					'type'			=> 'background',
					'title'			=> esc_html__( 'CEA Event Page Title Background Options', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose background settings for the CEA Event Title section, including color, image, size, etc.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-event-overlaycolor',
					'type'			=> 'color',
					'alpha'			=> true,
					'title'			=> esc_html__( 'Event Page Title Overlay Color', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Set the overlay color for the CEA Event title background. Choose light colors to make it displayed over the image.', 'hirxpert-addon' ),
					'required'		=> array( 'cea-event-title', '=', array( 'true' ) )
				),
				array(
					'id'			=> 'cea-event-sidebar-layout',
					'type'			=> 'radioimage',
					'title'			=> esc_html__( 'CEA Event Sidebar Layout', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Choose the position of the CEA Event sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
					'id'			=> 'cea-event-right-sidebar',
					'type'			=> 'sidebars',
					'title'			=> esc_html__( 'Right Widgets Area', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the CEA Event.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-event-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
				),
				array(
					'id'			=> 'cea-event-left-sidebar',
					'type'			=> 'sidebars',
					'title'			=> esc_html__( 'Left Widgets Area', 'hirxpert-addon' ),
					'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the CEA Event.', 'hirxpert-addon' ),
					'default'		=> '',
					'required'		=> array( 'cea-event-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
				),
			),
		),
		array(
			'id'			=> 'cea-event-title-items',
			'type'			=> 'dragdrop-editor',
			'title'			=> esc_html__( 'CEA Event Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the CEA Event Page Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
	)
) );
Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'cea-templates-tab-end'	
));