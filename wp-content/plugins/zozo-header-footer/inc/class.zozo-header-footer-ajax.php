<?php 
/**
 * Zozo Header Footer AJAX Class
 *
 * @since 1.0.0
 */
final class ZOZO_Header_Footer_AJAX {

	private static $_instance = null;
	
	public function __construct() {
		
		// login ajax
		add_action( 'wp_ajax_ajaxlogin', array( $this, 'zhf_ajax_login' ) );
		add_action( 'wp_ajax_nopriv_ajaxlogin', array( $this, 'zhf_ajax_login' ) );
		
		// registration ajax
		add_action( 'wp_ajax_ajaxregister', array( $this, 'zhf_ajax_register' ) );
		add_action( 'wp_ajax_nopriv_ajaxregister', array( $this, 'zhf_ajax_register' ) );
		
		// lost password
		add_action( 'wp_ajax_lost_pass', array( $this, 'zhf_lost_pass_callback' ) );
		add_action( 'wp_ajax_nopriv_lost_pass', array( $this, 'zhf_lost_pass_callback' ) );
		
	}
	
	public function zhf_ajax_login(){
			
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ajax-login-nonce', 'security' );
	
		// Nonce is checked, get the POST data and sign user on
		$pswd = addslashes( $_POST['password'] );
		$info = array();
		$info['user_login'] = esc_attr( $_POST['username'] );
		$info['user_password'] = stripslashes( $pswd );
		$info['remember'] = true;
	
		$user_signon = wp_signon( $info, false );
		$result = array();
		if ( is_wp_error($user_signon) ){
			$result = array( 'loggedin' => false, 'message' => esc_html__( 'Wrong username or password.', 'zhf-core' ) );
		} else {		
			$result = array( 'loggedin' => true, 'message' => esc_html__( 'Login successful, redirecting...', 'zhf-core' ), 'redirect_url' => home_url( '/' ) );
		}
	
		wp_send_json( $result );
	}
	
	public function zhf_ajax_register(){
			
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ajax-register-nonce', 'security' );
	
		// Nonce is checked, get the POST data and sign user on
		$email = esc_attr( $_POST['email'] );
		$username = esc_attr( $_POST['username'] );
		$user_display_name = $_POST['name'];
		$user_type = $_POST['usertype'];
		
		$userdata = array();
		$userdata['first_name'] = esc_attr( $user_display_name );
		$userdata['user_email'] = esc_attr( $email );
		$userdata['nickname'] = esc_attr( $_POST['nick_name'] );
		$userdata['user_login'] = esc_attr( $username );
		$userdata['user_pass'] = esc_attr( $_POST['password'] );
		
		$status = false;
		$msg = '';
		
		if( is_email( $email ) && validate_username( $username ) ) {

			$user_id = wp_insert_user( $userdata ) ;
			if( !is_wp_error($user_id) ) {
			
				if( $user_type != 'subs' ){
					$post_arr = array(
						'post_author' => 1,
						'post_type'    => 'zhf-agent',
						'post_title'   => esc_attr( $user_display_name ),
						'post_content' => '',
						'post_status'  => 'publish',
						'meta_input'   => array(
							'zhf_agent_email' => esc_attr( $email ),
							'zhf_agent_type' => esc_attr( $user_type ),
						),
					);
					wp_insert_post( $post_arr );
				}
				
				$status = true;
				$msg = esc_html__( 'Registered successful, redirecting....', 'zhf-core' );
			} else {
				$status = false;
				$msg = $user_id->get_error_message();
			}

		}else{
			$status = false;
			$msg = esc_html__( 'Enter valid email/user name!.', 'zhf-core' );
		}
	
		echo json_encode( array( 'register' => $status, 'message' => $msg ) );
	
		exit;
	}
	
	public function zhf_lost_pass_callback(){
	 
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ajax-forgot-nonce', 'security' );
		
		global $wpdb;
		
		$account = esc_attr( $_POST['user_login'] );
		
		if( empty( $account ) ) {
			$error = esc_html__( 'Enter an username or e-mail address.', 'zhf-core' );
		} else {
			if(is_email( $account )) {
				if( email_exists($account) ) 
					$get_by = 'email';
				else	
					$error = esc_html__( 'There is no user registered with that email address.', 'zhf-core' );			
			}
			else if (validate_username( $account )) {
				if( username_exists($account) ) 
					$get_by = 'login';
				else	
					$error = esc_html__( 'There is no user registered with that username.', 'zhf-core' );				
			}
			else
				$error = esc_html__( 'Invalid username or e-mail address.', 'zhf-core' );		
		}	
		
		if(empty ($error)) {
			// lets generate our new password
			$random_password = wp_generate_password();
	
				
			// Get user data by field and data, fields are id, slug, email and login
			$user = get_user_by( $get_by, $account );
				
			$update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );
				
			// if  update user return true then lets send user an email containing the new password
			if( $update_user ) {
				
				$zhf_options = get_option( 'zhf_options' );
				
				$site_admin_email = isset( $zhf_options['admin-email-id'] ) ? $zhf_options['admin-email-id'] : ''; // Set whatever you want like mail@yourdomain.com
				$to_emails = $user->user_email;
				if(!(isset($site_admin_email) && is_email($site_admin_email))) {		
					$to_emails = array(
						$site_admin_email,
						$user->user_email
					 );
				}
				
				$sitename = strtolower( $_SERVER['SERVER_NAME'] );
				if ( substr( $sitename, 0, 4 ) == 'www.' ) {
					$sitename = substr( $sitename, 4 );					
				}
				$from = apply_filters( 'zhf_lost_pass_mail_id', 'admin@'.$sitename );
				
				$to = $to_emails;
				$subject = 'Your new password';
				$sender = 'From: '.get_option('name').' <'.$from.'>' . "\r\n";
				
				$message = 'Your new password is: '.$random_password;
					
				$headers[] = 'MIME-Version: 1.0' . "\r\n";
				$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers[] = "X-Mailer: PHP \r\n";
				$headers[] = $sender;
					
				$mail = wp_mail( $to, $subject, $message, $headers );
				if( $mail ) 
					$success = esc_html__( 'Check your email address for you new password.', 'zhf-core' );
				else
					$error = esc_html__( 'System is unable to send you mail containg your new password.', 'zhf-core' );						
			} else {
				$error = esc_html__( 'Oops! Something went wrong while updaing your account.', 'zhf-core' );
			}
		}
		
		if( ! empty( $error ) )
			echo json_encode(array('loggedin'=>false, 'message'=> $error ));
				
		if( ! empty( $success ) )
			echo json_encode(array('loggedin'=>false, 'message'=> $success ));
					
		exit;
	}
	
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}
	
} ZOZO_Header_Footer_AJAX::instance();