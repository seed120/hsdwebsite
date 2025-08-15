<?php

$cea_response = array(
	'status' => 200,
	'list'	=> array(
		'Get started by spending some time with the documentation to get familiar with Classic Elementor Addons.',
		'Build awesome websites for you or your clients with ease.',
		'You can contribute to make Classic Elementor Addons better reporting bugs',
		'Stuck with something? Get help from the community',
		'We love to have you in Classic Elementor Addons family. We are making it more awesome everyday.'
	),
	'products' => array(
		'vework' => array(
			'alt'	=> 'Vework',
			'link'	=> 'https://themeforest.net/item/vework-virtual-assistant-wordpress-theme/28092652',
			'img'	=> 'https://demo.zozothemes.com/pro-plugins/cea/previews/vework.jpg',
		),
		'digion' => array(
			'alt'	=> 'Digion',
			'link' => 'https://themeforest.net/item/digion-online-digital-marketing-wordpress-theme/27916241',
			'img' => 'https://demo.zozothemes.com/pro-plugins/cea/previews/digion.jpg',
		),
		'wiguard' => array(
			'alt'	=> 'Wiguard',
			'link' => 'https://themeforest.net/item/wiguard-cctv-security-wordpress-theme/27686559',
			'img' => 'https://demo.zozothemes.com/pro-plugins/cea/previews/wiguard.jpg',
		)
	),
	'banner' => array(
		'offer' => array(
			'alt'	=> 'Offer',
			'link'	=> 'https://themeforest.net/user/zozothemes/portfolio',
			'img'	=> 'https://s3.envato.com/files/224287570/tf-banner.jpg'
		)
	)
);

header('Content-Type: application/json');
echo json_encode($cea_response);
