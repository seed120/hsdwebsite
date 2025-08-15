<?php 

class CEA_AJAX {
	
	private static $_instance = null;
	
	public function __construct() {

		add_action('wp_ajax_nopriv_cea_mailchimp', array( $this, 'cea_mailchimp' ) );
		add_action('wp_ajax_cea_mailchimp', array( $this, 'cea_mailchimp' ) );
		
	}
	
	public function cea_mailchimp(){
				
		$nonce = $_POST['nonce'];
	  
		if ( ! wp_verify_nonce( $nonce, 'cea-mailchimp-security^&%^' ) )
			die ( esc_html__( 'Busted', 'classic-elementor-addons-pro' ) );
		
		$list_id = isset( $_POST['cea_mc_listid'] ) ? $_POST['cea_mc_listid'] : '';
		$first_name = isset( $_POST['cea_mc_first_name'] ) ? $_POST['cea_mc_first_name'] : '';
		$last_name = isset( $_POST['cea_mc_last_name'] ) ? $_POST['cea_mc_last_name'] : '';
		$email = isset( $_POST['cea_mc_email'] ) ? $_POST['cea_mc_email'] : '';
		$success = isset( $_POST['cea_mc_success'] ) ? $_POST['cea_mc_success'] : '';
		
		//echo $email .' '. $list_id;
		
		if( $email == '' || $list_id == '' ){
			wp_die ( 'failed' );
		}
		
		$memberID = md5( strtolower( $email ) );
		
		$cea_options = get_option( 'cea_options' );
		$api_key = isset( $cea_options['mailchimp-api'] ) ? $cea_options['mailchimp-api'] : '';
		
		$dc = substr( $api_key, strpos( $api_key, '-' ) + 1 );
		
		$extra_args = array(
			'email_address' => esc_attr( $email ),
			'status' => 'subscribed',
			'merge_fields'  => [
				'FNAME'     => esc_attr( $first_name ),
				'LNAME'     => esc_attr( $last_name )
			]		
		);
		
		$args = array(
			'method' => 'PUT',
			'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( 'user:'. $api_key )
			),
			'body' => json_encode( $extra_args )
		);
		 
		$response = wp_remote_get( 'https://'.$dc.'.api.mailchimp.com/3.0/lists/'. esc_attr( $list_id ) .'/members/'. esc_attr( $memberID ), $args );
		 
		$body = json_decode( $response['body'] );
		 
		if ( $response['response']['code'] == 200 ) {
			echo "success";
		}elseif( $response['response']['code'] == 214 ){
			echo "already";
		}else {
			echo "failure";
		}

		wp_die();
	}
	
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

} CEA_AJAX::instance();