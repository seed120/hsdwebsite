<?php
/**
 * Zozo Purchase_Code Verification class.
 *
 * @package Zozo_Purchase_Code_Verification
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Creates the Zozo Purchase Code Verification class.
 *
 * @class Zozo_Purchase_Code_Verification
 * @version 1.0.0
 * @since 1.0.0
 */
 
class Zozo_Purchase_Code_Verification {
		
	public $product_id = '57222985'; // Envato Product ID
	
	public $api_url = 'https://zozothemes.com/wp-json/token-verification/v1/verify/';
	
	/**
	 * Check token 
	 */
	public function token_api_call( $email, $purchase_code ) {
		
		global $wp_version;

		$current_theme = wp_get_theme();
		$theme_name = $current_theme->parent() == false ? $current_theme->get( 'Name' ) : $current_theme->parent()->get( 'Name' );

		$args = array(
			'user-agent' => 'WordPress/' . $wp_version . '; ' . esc_url( home_url() ),
			'body'       => array(
				'purchase_code'		=> $purchase_code,
				'email'		=> $email,
				'domain'	=> esc_url( home_url( '/' ) ),
				'theme'		=> esc_attr( $theme_name ),
				'product'	=> $this->product_id
			)
		);

		$response = wp_remote_post( esc_url_raw( $this->api_url ), $args );		

		// Check the response code.
		$response_code    = wp_remote_retrieve_response_code( $response );
		$response_message = wp_remote_retrieve_response_message( $response );

		if ( empty( $response_code ) && is_wp_error( $response ) ) {
			return $response;
		}

		if ( 200 !== $response_code && ! empty( $response_message ) ) {
			return new WP_Error( $response_code, $response_message );
		}
		if ( 200 !== $response_code ) {
			return new WP_Error( $response_code, esc_html__( 'An unknown API error occurred.', 'hirxpert' ) );
		}
		$data = wp_remote_retrieve_body( $response ); //json_decode( wp_remote_retrieve_body( $response ), true );
		
		if ( null === $data ) {
			return new WP_Error( 'api_error', esc_html__( 'An unknown API error occurred.', 'hirxpert' ) );
		}
		
		return $data;
		
	}
	
	public function verify_token(){
		
		$email = isset( $_POST['zozo_registration_email'] ) ? sanitize_email( $_POST['zozo_registration_email'] ) : '';
		if ( empty( $email ) ) {
			return array( 'error_message' => esc_html__( '!Oops.. Email id is required.', 'hirxpert' ) );
		}elseif( !is_email( $email ) ){
			return array( 'error_message' => esc_html__( '!Oops.. Email id is invalid.', 'hirxpert' ) );
		}
	
		$purchase_code = isset( $_POST['zozo_purchase_code'] ) ? sanitize_text_field( $_POST['zozo_purchase_code'] ) : '';
		if ( empty( $purchase_code ) ) {
			return array( 'error_message' => esc_html__( '!Oops.. Purchase code is required.', 'hirxpert' ) );
		}
	
		$data = $this->token_api_call( $email, $purchase_code );
		$data = json_decode( $data, true );
		
		if( isset( $data['error_message'] ) && empty( $data['error_message'] ) ) {
			update_option( 'verified_purchase_status', $data['verified_purchase_status'] );
			update_option( 'verified_purchase_data', $data['verified_purchase_data'] );
			update_option( 'verified_code', $data['verified_code'] );
			update_option( 'verified_email', $email );
			update_option( 'verified_token', $purchase_code );
			return array( 'status' => 'success' );
		}else{
			return $data;
		}
		
		return 0;
	}
	
	/**
	 * deactivate token 
	 */
	public function deactivate_api_call() {
		
		global $wp_version;

		$current_theme = wp_get_theme();
		$theme_name = $current_theme->parent() == false ? $current_theme->get( 'Name' ) : $current_theme->parent()->get( 'Name' );
		
		$purchase_code = get_option( 'verified_code' );
		$email = get_option( 'verified_email' );

		$args = array(
			'user-agent' => 'WordPress/' . $wp_version . '; ' . esc_url( home_url() ),
			'body'       => array(
				'purchase_code'		=> $purchase_code,
				'email'		=> $email,
				'domain'	=> esc_url( home_url( '/' ) ),
				'theme'		=> esc_attr( $theme_name ),
				'product'	=> $this->product_id,
				'deactivate' => true
			)
		);

		$response = wp_remote_post( esc_url_raw( $this->api_url ), $args );		

		// Check the response code.
		$response_code    = wp_remote_retrieve_response_code( $response );
		$response_message = wp_remote_retrieve_response_message( $response );

		if ( empty( $response_code ) && is_wp_error( $response ) ) {
			return $response;
		}

		if ( 200 !== $response_code && ! empty( $response_message ) ) {
			return new WP_Error( $response_code, $response_message );
		}
		if ( 200 !== $response_code ) {
			return new WP_Error( $response_code, esc_html__( 'An unknown API error occurred.', 'hirxpert' ) );
		}
		$data = wp_remote_retrieve_body( $response ); //json_decode( wp_remote_retrieve_body( $response ), true );
		
		if ( null === $data ) {
			return new WP_Error( 'api_error', esc_html__( 'An unknown API error occurred.', 'hirxpert' ) );
		}
		$data = json_decode( $data, true );
		
		if( isset( $data['status'] ) && $data['status'] == 'deleted' ) {
			update_option( 'verified_purchase_status', '' );
			update_option( 'verified_purchase_data', '' );
			update_option( 'verified_code', '' );
			update_option( 'verified_email', '' );
			update_option( 'verified_token', '' );
		}
		return array( 'status' => 'success' );
	}
	
	public static function check_theme_activated(){		
		$verified_stat = get_option( 'verified_purchase_status' );
		$verified_data = get_option( 'verified_purchase_data' );		
		if( $verified_stat == 1 && !empty( $verified_data ) ){
			$token = get_option( 'verified_token' );
			return $token;
		}
		return false;
	}
	
}