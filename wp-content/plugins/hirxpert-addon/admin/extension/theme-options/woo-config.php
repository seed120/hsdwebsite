<?php

// Woocommerce
Hirxpert_Options::hirxpert_set_section( array(
	'title'      => esc_html__( 'Woocommerce', 'hirxpert-addon' ),
	'id'         => 'woocommerce-tab',
	'config_id'  => '',
) );

Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Shop', 'hirxpert-addon' ),
	'id'         => 'shop-tab',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'shop-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Shop Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for shop page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'shop-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Shop Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the Shop Page title section.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'shop-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Shop Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Shop Page Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
			'id'			=> 'shop-title-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Shop Page Title Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the color for the title of the shop page.', 'hirxpert-addon' ),
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-title-desc-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Shop Page Title Description Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the color for the description of the shop page.', 'hirxpert-addon' ),
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-title-link-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Shop Page Title Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the color for the hyperlinks of the shop page title. Like breadcrumbs color.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-title-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Shop Page Title Padding', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the shop page Title section.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Shop Page Title Background Options', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose background settings for the Shop Page Title section, including color, image, size, etc.', 'hirxpert-addon' ),
			'required'		=> array( 'shop-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'shop-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Shop Page Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for shop page layout.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'shop-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Shop Single Post Sidebar Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose the position of the shop page sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
			'id'			=> 'shop-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Shop Page Right Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the shop page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'shop-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'shop-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Shop Page Left Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the shop page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'shop-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		)
	)
) );

Hirxpert_Options::hirxpert_set_sub_section( array(
	'title'      => esc_html__( 'Product', 'hirxpert-addon' ),
	'id'         => 'product-tab',
	'config_id'  => '',
	'fields'	 => array(
		array(
			'id'			=> 'product-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Product Page Title Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for product page title.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'product-title',
			'type'			=> 'toggle',
			'title'			=> esc_html__( 'Enable/Disable Product Page Title', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Toggle to display the page title in the Product Page title section.', 'hirxpert-addon' ),
			'default'		=> true
		),
		array(
			'id'			=> 'product-title-items',
			'type'			=> 'dragdrop',
			'title'			=> esc_html__( 'Product Page Title Elements', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Arrange and customize the elements in the Product Page Title section using a drag-and-drop interface.', 'hirxpert-addon' ),
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
			'id'			=> 'product-title-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Product Page Title Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the color for the title of the Product page.', 'hirxpert-addon' ),
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-title-desc-color',
			'type'			=> 'color',
			'title'			=> esc_html__( 'Product Page Title Description Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the color for the description of the Product page.', 'hirxpert-addon' ),
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-title-link-color',
			'type'			=> 'link',
			'title'			=> esc_html__( 'Product Page Title Link Color', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Set the color for the hyperlinks of the Product page title. Like breadcrumbs color.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-title-padding',
			'type'			=> 'dimension',
			'title'			=> esc_html__( 'Product Page Title Padding', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Adjust the padding (inner spacing) around the product page Title section.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-title-bg',
			'type'			=> 'background',
			'title'			=> esc_html__( 'Product Page Title Background', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose background settings for the Product Page Title section, including color, image, size, etc.', 'hirxpert-addon' ),
			'required'		=> array( 'product-title', '=', array( 'true' ) )
		),
		array(
			'id'			=> 'product-pl-settings',
			'type'			=> 'label',
			'title'			=> esc_html__( 'Product Page Layout Settings', 'hirxpert-addon' ),
			'desc'	=> esc_html__( 'This is settings for product page layout.', 'hirxpert-addon' ),
			'seperator'		=> 'after'
		),
		array(
			'id'			=> 'product-sidebar-layout',
			'type'			=> 'radioimage',
			'title'			=> esc_html__( 'Product Single Post Sidebar Layout', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Choose the position of the product page sidebar, such as left, right, both or no-sidebar (full-width).', 'hirxpert-addon' ),
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
			'id'			=> 'product-right-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Product Page Right Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the right sidebar area of the product page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'product-sidebar-layout', '=', array( 'right-sidebar', 'both-sidebar' ) )
		),
		array(
			'id'			=> 'product-left-sidebar',
			'type'			=> 'sidebars',
			'title'			=> esc_html__( 'Product Page Left Widgets Area', 'hirxpert-addon' ),
			'description'	=> esc_html__( 'Select and add widget to the left sidebar area of the product page.', 'hirxpert-addon' ),
			'default'		=> '',
			'required'		=> array( 'product-sidebar-layout', '=', array( 'left-sidebar', 'both-sidebar' ) )
		)
	)
) );

Hirxpert_Options::hirxpert_set_end_section( array(
	'id'		=> 'woocommerce-end'	
));