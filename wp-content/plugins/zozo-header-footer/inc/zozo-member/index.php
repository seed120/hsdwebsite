<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function zoacres_register_load_scripts() {

    wp_enqueue_script( 'zoacres-register-custom', plugins_url( 'assets/js/register-custom.js', __FILE__ ), array('jquery'), '1.0', true );
	
	wp_localize_script('zoacres-register-custom', 'ajax_var', array(
        'loadingmessage' => esc_html__( 'Sending user info, please wait...', 'newser' ),
		'valid_email' => esc_html__( 'Please enter valid email!', 'newser' ),
		'valid_login' => esc_html__( 'Please enter valid username/password!', 'newser' ),
		'req_reg' => esc_html__( 'Please enter required fields values for registration!', 'newser' )
	));
 
}
add_action('wp_enqueue_scripts', 'zoacres_register_load_scripts');

require_once( ZOACRES_CORE_DIR . 'inc/zacres-member/function.php' );