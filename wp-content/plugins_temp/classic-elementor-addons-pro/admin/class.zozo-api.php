<?php
/**
 * Zozothemes API class.
 *
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Creates the Zozothemes API connection.
 *
 * @class Zozothemes_API
 * @version 1.0.0
 * @since 1.0.0
 */
 
class Zozothemes_API {
	
	private $api_url;
	
	public function __construct(){
		$this->api_url = 'http://demo.zozothemes.com/pro-plugins/cea/cea-response.php';
	}
	
	public function request( $url ) {
		
		$args = array(
			'timeout' => 300
		);
		
		// Make an API request.
		$response = wp_remote_get( esc_url_raw( $url ), $args );

		// Check the response code.
		$response_code    = wp_remote_retrieve_response_code( $response );
		if ( 200 !== $response_code && ! empty( $response_message ) ) {
			return new WP_Error( $response_code, $response_message );
		}
		if ( 200 !== $response_code ) {
			return new WP_Error( $response_code, esc_html__( 'An unknown API error occurred.', 'classic-elementor-addons-pro' ) );
		}
		$body_data = json_decode( wp_remote_retrieve_body( $response ), true );
		if ( null === $body_data ) {
			return new WP_Error( 'api_error', esc_html__( 'An unknown API error occurred.', 'classic-elementor-addons-pro' ) );
		}
		
		return $body_data;
		
	}
	
	public function get_response(){
		$data = '';
		if ( false === ( $data = get_transient( 'cea_api_results' ) ) ) {
			$data = $this->request( $this->api_url );
			if( !is_wp_error( $data ) ){
				set_transient( 'cea_api_results', $data, 6 * HOUR_IN_SECONDS );
			}
		}		
		return $data;
	}
	
}