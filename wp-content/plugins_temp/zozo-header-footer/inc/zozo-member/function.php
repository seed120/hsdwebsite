<?php

class ZoacresRegisterShortcodes {

	public static function zoacresSigninTrigger( $atts ) {
		$atts = shortcode_atts( array(
			'avatar' => false,
			'logged_text' => esc_html__( 'Hello!', 'zoacres-core' ),
			'signin_text' => esc_html__( 'Sign in', 'zoacres-core' ),
			'signout_text' => esc_html__( 'Sign out', 'zoacres-core' )
		), $atts );
		
		$output = "";
		
		global $user_login;
		global $current_user;
		
		if( $current_user->ID == '1' ){
			echo isset( $atts['logged_text'] ) ? esc_html( $atts['logged_text'] ) . esc_html__( ' Admin', 'zoacres-core' ) : '';
			return;
		}
		
		ob_start();
		
		if ( !is_user_logged_in() ) :
		?>
			<a href="#" class="login-form-trigger btn btn-default"><?php echo esc_html( $atts['signin_text'] ); ?></a>
			<?php
			add_action( 'zoacres_footer_action', array( 'ZoacresRegisterShortcodes', 'zoacresLogRegisterForm' ), 10 );
		else : 
		
			$author_link = get_author_posts_url( $current_user->ID );
			
			$is_agent = zoacres_check_is_agent();
			
			if( $is_agent ){
				$pages = get_pages(array(
					'meta_key' => '_wp_page_template',
					'meta_value' => 'zoacres-user-profile.php'
				));
			}else{
				$pages = get_pages(array(
					'meta_key' => '_wp_page_template',
					'meta_value' => 'zoacres-subscriber-profile.php'
				));
			}

			if( $pages ){
				$dash_link = get_permalink( $pages[0]->ID );
			}else{
				$dash_link = home_url( '/' );
			}  

			?>
			<div class="logged-in log-form-trigger-wrap">
			<?php
				$current_user = wp_get_current_user();
				
				$user_inbox_msg = get_user_meta( $current_user->ID, 'zoacres_user_messages', true );
				$ntf = 0;
				if( !empty( $user_inbox_msg ) && is_array( $user_inbox_msg ) ){
					foreach( $user_inbox_msg as $msg_time => $msg ){
						if( is_array( $msg ) ) {
							$ntf += $msg['vstat'] == false ? 1 : 0;
						}
					}
				}

				$is_agent = zoacres_check_is_agent();
				if( $is_agent ){
					$auth_pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'zoacres-user-profile.php'
					));
					if( $auth_pages ){
						$auth_dash_link = get_permalink( $auth_pages[0]->ID );
					}else{
						$auth_dash_link = home_url( '/' );
					} 
					$prop_pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'zoacres-property-new.php'
					));
					if( $prop_pages ){
						$prop_dash_link = get_permalink( $prop_pages[0]->ID );
					}else{
						$prop_dash_link = home_url( '/' );
					} 
					$prop_list_pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'zoacres-user-properties.php'
					));
					if( $prop_list_pages ){
						$prop_list_link = get_permalink( $prop_list_pages[0]->ID );
					}else{
						$prop_list_link = home_url( '/' );
					} 
					$agent_fav_pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'zoacres-user-fav.php'
					));
					if( $agent_fav_pages ){
						$prop_fav_link = get_permalink( $agent_fav_pages[0]->ID );
					}else{
						$prop_fav_link = home_url( '/' );
					} 
					$agent_saved_pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'zoacres-property-saved-search.php'
					));
					if( $agent_saved_pages ){
						$prop_saved_link = get_permalink( $agent_saved_pages[0]->ID );
					}else{
						$prop_saved_link = home_url( '/' );
					} 
					$agent_invoice_pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'zoacres-invoice-list.php'
					));
					if( $agent_invoice_pages ){
						$prop_invoice_link = get_permalink( $agent_invoice_pages[0]->ID );
					}else{
						$prop_invoice_link = home_url( '/' );
					} 
					//User Inbox Template
					$agent_inbox_pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'zoacres-user-inbox.php'
					));
					if( $agent_inbox_pages ){
						$prop_inbox_link = get_permalink( $agent_inbox_pages[0]->ID );
					}else{
						$prop_inbox_link = home_url( '/' );
					}
					
					$agent_email = $current_user->user_email;
					$agent_id = zoacres_get_post_id_by_meta_key_and_value( 'zoacres_agent_email', $agent_email );
					
					?>
					<div class="dropdown">
						<div class="log-form-trigger-wrap-inner">
							<?php echo '<span class="log-text">' . esc_html( $atts['logged_text'] ) . '</span>'; ?>
							<?php
								
								$author_img_url = get_the_post_thumbnail_url( $agent_id, 'thumbnail' );
								if( $author_img_url ){
									echo '<img class="img-fluid" src="'. esc_url( $author_img_url ) .'" alt="'. esc_html( $current_user->display_name ) .'"/>';
								}
							?>
							<a class="author-link dropdown-toggle" href="<?php echo esc_url( $auth_dash_link ); ?>" data-toggle="dropdown">
							<?php
								if( !$author_img_url ){
									echo '<i class="icon icon-user"></i>';
								}
								echo '<span class="log-form-author-name-wrap">';
									echo esc_html( $current_user->display_name ); 
									echo $ntf ? '<i class="message-notification">'. esc_html( $ntf ) .'</i>' : '';
								echo '</span>';
							?>
							</a>
						</div>
						<div class="dropdown-menu">
							<ul class="user-menu">
								<li><a href="<?php echo esc_url( $auth_dash_link ); ?>" class="d-block "><i class="fa fa-cog"></i><?php esc_html_e('My Profile', 'zoacres-core'); ?></a></li>
								<li><a href="<?php echo esc_url( $prop_list_link ); ?>" class="d-block"> <i class="fa fa-map-marker"></i><?php esc_html_e('My Properties List', 'zoacres-core'); ?></a></li>
								<li><a href="<?php echo esc_url( $prop_dash_link ); ?>" class="d-block user_tab_active"> <i class="fa fa-plus"></i><?php esc_html_e('Add New Property', 'zoacres-core'); ?></a></li>
								<li><a href="<?php echo esc_url( $prop_fav_link ); ?>" class="d-block"><i class="fa fa-heart"></i><?php esc_html_e('Favorites', 'zoacres-core'); ?></a></li><!-- .agent-fav-property-list removed this class. This class used for ajax -->
								<li><a href="<?php echo esc_url( $prop_saved_link ); ?>" class="d-block"><i class="fa fa-search"></i><?php esc_html_e('Saved Searches', 'zoacres-core'); ?></a></li><!-- .user-saved-searches removed this class. This class used for ajax -->
								<li><a href="<?php echo esc_url( $prop_invoice_link ); ?>" class="d-block"><i class="fa fa-file-text-o"></i><?php esc_html_e('My Invoices', 'zoacres-core'); ?></a></li>
								<li><a href="<?php echo esc_url( $prop_inbox_link ); ?>" class="d-block"><i class="fa fa-envelope-o"></i><?php esc_html_e('Inbox', 'zoacres-core'); if( $ntf ) echo '<span class="message-notification">'. esc_html( $ntf ) .'</span>'; ?></a></li>
								<li><a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>" class="d-block"><i class="fa fa-power-off"></i><?php esc_html_e('Log Out', 'zoacres-core'); ?></a></li>
							</ul>
						</div>
					</div>
					<?php
				}else{
					$auth_pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'zoacres-subscriber-profile.php'
					));
					if( $auth_pages ){
						$auth_dash_link = get_permalink( $auth_pages[0]->ID );
					}else{
						$auth_dash_link = home_url( '/' );
					} 
					$agent_fav_pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'zoacres-subscriber-fav.php'
					));
					if( $agent_fav_pages ){
						$prop_fav_link = get_permalink( $agent_fav_pages[0]->ID );
					}else{
						$prop_fav_link = home_url( '/' );
					} 
					$agent_saved_pages = get_pages(array(
						'meta_key' => '_wp_page_template',
						'meta_value' => 'zoacres-subscriber-saved-search.php'
					));
					if( $agent_saved_pages ){
						$prop_saved_link = get_permalink( $agent_saved_pages[0]->ID );
					}else{
						$prop_saved_link = home_url( '/' );
					} 
					
					$agent_email = $current_user->user_email;
					$agent_id = zoacres_get_post_id_by_meta_key_and_value( 'zoacres_agent_email', $agent_email );
					
					if( empty( $agent_id ) ){
					?>
					<div class="dropdown">
						<div class="log-form-trigger-wrap-inner">
							<?php echo '<span class="log-text">' . esc_html( $atts['logged_text'] ) . '</span>'; ?>
							<?php
								$author_img_url = get_the_post_thumbnail_url( $agent_id, 'thumbnail' );
								if( $author_img_url ){
									echo '<img class="img-fluid" src="'. esc_url( $author_img_url ) .'" alt="'. esc_html( $current_user->display_name ) .'"/>';
								}
							?>
							<a class="author-link dropdown-toggle" href="<?php echo esc_url( $auth_dash_link ); ?>" data-toggle="dropdown">
							<?php
								if( !$author_img_url ){
									echo '<i class="icon icon-user"></i>';
								}
								echo '<span class="log-form-author-name-wrap">';
									echo esc_html( $current_user->display_name ); 
								echo '</span>';
							?>
							</a>
						</div>
						<div class="dropdown-menu">
							<ul class="user-menu">
								<li><a href="<?php echo esc_url( $auth_dash_link ); ?>" class="d-block user_tab_active"><i class="fa fa-cog"></i><?php esc_html_e('My Profile', 'zoacres-core'); ?></a></li>
								<li><a href="<?php echo esc_url( $prop_fav_link ); ?>" class="d-block"><i class="fa fa-heart"></i><?php esc_html_e('Favorites', 'zoacres-core'); ?></a></li>
								<li><a href="<?php echo esc_url( $prop_saved_link ); ?>" class="d-block"><i class="fa fa-search"></i><?php esc_html_e('Saved Searches', 'zoacres-core'); ?></a></li>
								<li><a href="<?php echo esc_url( wp_logout_url( home_url( '/' ) ) ); ?>" class="d-block"><i class="fa fa-power-off"></i><?php esc_html_e('Log Out', 'zoacres-core'); ?></a></li>
							  </ul>
						</div>
					</div>
					<?php
					}
				}
			?>
			</div>
		<?php
		endif;
		
		$output .= ob_get_clean();
		return $output;
	}
	
	public static function zoacresLogRegisterForm(){

		$zoacres_options = get_option( 'zoacres_options' );
		$login_text = isset( $zoacres_options['login-text'] ) && $zoacres_options['login-text'] != '' ? $zoacres_options['login-text'] : '';
		$col_class = $login_text != '' ? '7' : '12';
	
	?>
		<div class="zoacres-login-parent">
			<div class="zoacres-login-inner">
				<div class="row d-flex align-items-center">
					<?php if( $login_text ): ?>
					<div class="col-md-5 col-sm-12">
						<div class="login-form-text">
							<?php 
								$login_image = isset( $zoacres_options['login-image']['url'] ) && $zoacres_options['login-image']['url'] != '' ? $zoacres_options['login-image']['url'] : ''; 
							if($login_image){
							?>
							<img src="<?php echo esc_url( $login_image ); ?>" alt="<?php esc_html_e( 'Login Image', 'zoacres-core' ); ?>">
							<?php } ?>
							<p><?php echo do_shortcode( $login_text ); ?></p>
						</div>
					</div>
					<?php endif; ?>
					<div class="col-md-<?php echo esc_attr($col_class); ?> col-sm-12">	
						<?php echo do_shortcode( '[zoacres_login_form demo="0"][zoacres_forgot_form][zoacres_registration_form]' ); ?>
					</div>	
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function zoacresLoginForm( $atts ){
	
		$atts = shortcode_atts( array(
			'demo' => 0
		), $atts );
		
		extract($atts);
	
		ob_start();
	?>

		<div class="login-form">
			<span class="close zoacres-login-close"></span>
			<form id="login" action="login" method="post">
				<h3><?php esc_html_e( 'Login', 'zoacres-core' ); ?></h3>
				<?php wp_nonce_field( 'ajax-login-nonce', 'lsecurity' ); ?>
				<p class="status"></p>
				<p>
					<label for="username"><?php esc_html_e( 'Username', 'zoacres-core' ); ?></label>
					<input id="lusername" type="text" name="username" class="form-control">
				</p>
				<p>
					<label for="password"><?php esc_html_e( 'Password', 'zoacres-core' ); ?></label>
					<input id="lpassword" type="password" name="password" class="form-control">
				</p>
				<p>
					<?php if ( get_option( 'users_can_register' ) ) : ?>
						<a class="register-trigger" href="#"><?php esc_html_e( 'Register', 'zoacres-core' ); ?></a>
						<?php echo ' / '; ?>
					<?php endif; ?>
					<a class="lost-password-trigger" href="#"><?php esc_html_e( 'Lost your password?', 'zoacres-core' ); ?></a>
				</p>
				<input class="submit_button btn btn-default" type="submit" value="<?php esc_html_e( 'Login', 'zoacres-core' ); ?>" name="submit">				
			</form>
		</div>
				
	<?php
	
		$output = ob_get_clean();
		return $output;
	
	}
	
	public static function zoacresRegisterForm( $atts ){
		ob_start();
		
		if ( get_option( 'users_can_register' ) ) : ?>
			<div class="registration-form form-state-hide">
				<span class="fa fa-angle-left move-to-prev-form"></span>
				<form id="registration" class="ajax-auth" action="registration" method="post">    
					<h3 class="text-center"><?php esc_html_e( 'Register', 'zoacres-core' ); ?></h3>
					<p class="status"></p>
					<p>
						<label for="name"><?php esc_html_e( 'Your Name', 'zoacres-core' ); ?></label>
						<input id="name" type="text" name="name" class="form-control">
					</p>
					<p>
						<label for="email"><?php esc_html_e( 'Your Email*', 'zoacres-core' ); ?></label>
						<input id="uemail" type="text" name="email" class="form-control">
					</p>
					<p>
						<label for="nick_name"><?php esc_html_e( 'Nick Name', 'zoacres-core' ); ?></label>
						<input id="nick_name" type="text" name="nick_name" class="form-control">
					</p>
					<p>
						<label for="username"><?php esc_html_e( 'Choose Username*', 'zoacres-core' ); ?></label>
						<input id="username" type="text" name="username" class="form-control">
					</p>
					<p>
						<label for="password"><?php esc_html_e( 'Choose Password*', 'zoacres-core' ); ?></label>
						<input id="password" type="password" name="password" class="form-control">
					</p>
					<input class="submit_button btn btn-default" type="submit" value="<?php esc_html_e( 'Register', 'zoacres-core' ); ?>" name="submit">
					<?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
				</form>
			</div>
		<?php endif; // user can register 
		
		$output = ob_get_clean();
		return $output;
		
	}
	
	public static function zoacresForgotForm( $atts ){
		ob_start();
		?>
		
			<div class="lost-password-form form-state-hide">
				<span class="fa fa-angle-left move-to-prev-form"></span>
				<form id="forgot_password" class="ajax-auth" action="forgot_password" method="post">    
					<h3 class="text-center"><?php esc_html_e( 'Forgot Password', 'zoacres-core' ); ?></h3>
					<p class="status"></p>  
					<?php wp_nonce_field('ajax-forgot-nonce', 'forgotsecurity'); ?>  
					<p>
						<label for="user_login"><?php esc_html_e( 'Username or E-mail', 'zoacres-core' ); ?></label>
						<input id="user_login" type="text" class="required form-control" name="user_login">
					</p>
					<input class="submit_button btn btn-default" type="submit" value="<?php esc_html_e( 'Submit', 'zoacres-core' ); ?>">
				</form>
			</div>
					
		<?php
		
		$output = ob_get_clean();
		return $output;
		
	}
	
 }
add_shortcode( 'zoacres_signin_trigger', array( 'ZoacresRegisterShortcodes', 'zoacresSigninTrigger' ) ); 
add_shortcode( 'zoacres_login_form', array( 'ZoacresRegisterShortcodes', 'zoacresLoginForm' ) );
add_shortcode( 'zoacres_forgot_form', array( 'ZoacresRegisterShortcodes', 'zoacresForgotForm' ) );
add_shortcode( 'zoacres_registration_form', array( 'ZoacresRegisterShortcodes', 'zoacresRegisterForm' ) );

/*User Register and Login with Ajax*/
add_action( 'wp_ajax_ajaxlogin', 'zoacres_ajax_login' );
add_action( 'wp_ajax_nopriv_ajaxlogin', 'zoacres_ajax_login' );
if( ! function_exists('zoacres_ajax_login') ) {
	function zoacres_ajax_login(){
			
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ajax-login-nonce', 'security' );
	
		// Nonce is checked, get the POST data and sign user on
		$pswd = addslashes( $_POST['password'] );
		$info = array();
		$info['user_login'] = esc_attr( $_POST['username'] );
		$info['user_password'] = stripslashes( $pswd );
		$info['remember'] = true;
	
		$user_signon = wp_signon( $info, false );
		if ( is_wp_error($user_signon) ){
			echo json_encode( array( 'loggedin' => false, 'message' => esc_html__( 'Wrong username or password.', 'zoacres-core' ) ) );
		} else {
		
			$pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'zoacres-user-profile.php'
            ));

			$dash_link = '';
			if( $pages ){
				$dash_link = get_permalink( $pages[0]->ID );
			}else{
				$dash_link = home_url( '/' );
			}  
			
			echo json_encode( array( 'loggedin' => true, 'message' => esc_html__( 'Login successful, redirecting...', 'zoacres-core' ), 'redirect_url' => $dash_link ) );
		}
	
		exit;
	}
}

add_action( 'wp_ajax_ajaxregister', 'zoacres_ajax_register' );
add_action( 'wp_ajax_nopriv_ajaxregister', 'zoacres_ajax_register' );
if( ! function_exists('zoacres_ajax_register') ) {
	function zoacres_ajax_register(){
			
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
						'post_type'    => 'zoacres-agent',
						'post_title'   => esc_attr( $user_display_name ),
						'post_content' => '',
						'post_status'  => 'publish',
						'meta_input'   => array(
							'zoacres_agent_email' => esc_attr( $email ),
							'zoacres_agent_type' => esc_attr( $user_type ),
						),
					);
					wp_insert_post( $post_arr );
				}
				
				$status = true;
				$msg = esc_html__( 'Registered successful, redirecting....', 'zoacres-core' );
			} else {
				$status = false;
				$msg = $user_id->get_error_message();
			}

		}else{
			$status = false;
			$msg = esc_html__( 'Enter valid email/user name!.', 'zoacres-core' );
		}
	
		echo json_encode( array( 'register' => $status, 'message' => $msg ) );
	
		exit;
	}
}

add_action( 'wp_ajax_lost_pass', 'zoacres_lost_pass_callback' );
add_action( 'wp_ajax_nopriv_lost_pass', 'zoacres_lost_pass_callback' );
if( ! function_exists('zoacres_lost_pass_callback') ) {
	function zoacres_lost_pass_callback(){
	 
		// First check the nonce, if it fails the function will break
		check_ajax_referer( 'ajax-forgot-nonce', 'security' );
		
		global $wpdb;
		
		$account = esc_attr( $_POST['user_login'] );
		
		if( empty( $account ) ) {
			$error = esc_html__( 'Enter an username or e-mail address.', 'zoacres-core' );
		} else {
			if(is_email( $account )) {
				if( email_exists($account) ) 
					$get_by = 'email';
				else	
					$error = esc_html__( 'There is no user registered with that email address.', 'zoacres-core' );			
			}
			else if (validate_username( $account )) {
				if( username_exists($account) ) 
					$get_by = 'login';
				else	
					$error = esc_html__( 'There is no user registered with that username.', 'zoacres-core' );				
			}
			else
				$error = esc_html__( 'Invalid username or e-mail address.', 'zoacres-core' );		
		}	
		
		if(empty ($error)) {
			// lets generate our new password
			$random_password = wp_generate_password();
	
				
			// Get user data by field and data, fields are id, slug, email and login
			$user = get_user_by( $get_by, $account );
				
			$update_user = wp_update_user( array ( 'ID' => $user->ID, 'user_pass' => $random_password ) );
				
			// if  update user return true then lets send user an email containing the new password
			if( $update_user ) {
				
				$zoacres_options = get_option( 'zoacres_options' );
				
				$site_admin_email = isset( $zoacres_options['admin-email-id'] ) ? $zoacres_options['admin-email-id'] : ''; // Set whatever you want like mail@yourdomain.com
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
				$from = apply_filters( 'zoacres_lost_pass_mail_id', 'admin@'.$sitename );
				
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
					$success = esc_html__( 'Check your email address for you new password.', 'zoacres-core' );
				else
					$error = esc_html__( 'System is unable to send you mail containg your new password.', 'zoacres-core' );						
			} else {
				$error = esc_html__( 'Oops! Something went wrong while updaing your account.', 'zoacres-core' );
			}
		}
		
		if( ! empty( $error ) )
			echo json_encode(array('loggedin'=>false, 'message'=> $error ));
				
		if( ! empty( $success ) )
			echo json_encode(array('loggedin'=>false, 'message'=> $success ));
					
		exit;
	}
}

add_action('after_setup_theme', 'zoacres_remove_admin_bar'); 
function zoacres_remove_admin_bar() {
	$user = wp_get_current_user();
	if ( in_array( 'subscriber', (array) $user->roles ) ) {
		show_admin_bar(false);
	}
}

function zoacres_insert_attachment( $file_handler, $post_id, $setthumb = false ) {
    // check to make sure its a successful upload
    // changes start
    if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) {
        return __return_false();
    }
    // changes end

    require_once(ABSPATH . "wp-admin" . '/includes/image.php');
    require_once(ABSPATH . "wp-admin" . '/includes/file.php');
    require_once(ABSPATH . "wp-admin" . '/includes/media.php');

    $attach_id = media_handle_upload( $file_handler, $post_id );

    if ($setthumb)
        update_post_meta($post_id, '_thumbnail_id', $attach_id);
		
    return $attach_id;
}

if (!function_exists('zoacres_get_post_id_by_meta_key_and_value')) {
	/**
	 * Get post id from meta key and value
	 * @param string $key
	 * @param mixed $value
	 * @return int|bool
	 * @author David M&aring
	 */
	function zoacres_get_post_id_by_meta_key_and_value( $key, $value ) {
		global $wpdb;
		$meta = $wpdb->get_results("SELECT * FROM `". esc_attr( $wpdb->postmeta ) ."` WHERE meta_key='". esc_sql( $key ) ."' AND meta_value='". esc_sql( $value ) ."'");
		if (is_array($meta) && !empty($meta) && isset($meta[0])) {
			$meta = $meta[0];
		}		
		if (is_object($meta)) {
			return $meta->post_id;
		}
		else {
			return false;
		}
	}
}

if (!function_exists('zoacres_check_is_agent')) {
	function zoacres_check_is_agent(){
		$current_user = wp_get_current_user();
		$agent_email = $current_user->user_email;
		$agent_id = zoacres_get_post_id_by_meta_key_and_value( 'zoacres_agent_email', $agent_email );
		
		return $agent_id;
	}
}
