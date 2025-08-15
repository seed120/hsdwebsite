<?php 

namespace Elementor;

/**
 * Zozo Header Footer Member Class
 *
 * @since 1.0.0
 */
final class ZOZO_Header_Footer_Member {

	private static $_instance = null;
	
	public static $_settings = array();
	
	public function __construct() {}
	
	public static function zhf_set_settings( $settings ){
		self::$_settings = $settings;
	}
		
	public static function zhf_all_form(){		
		$settings = self::$_settings;
		
		$rf_enabled = isset( $settings['rf_enabled'] ) ? $settings['rf_enabled'] : 'no';
		$fp_enabled = isset( $settings['fp_enabled'] ) ? $settings['fp_enabled'] : 'no';
		
	?>
		<div class="zhf-login-parent">
			<div class="zhf-login-inner">
				<div class="row d-flex align-items-center">
					<div class="col-md-12">	
					<?php 
						self::zhf_login_form($settings); 
						if( $rf_enabled == 'yes' ) { self::zhf_register_form($settings); }
						if( $fp_enabled == 'yes' ) { self::zhf_forgot_form($settings); }
					?>
					</div>	
				</div>
			</div>
		</div>
	<?php
	}
	
	public static function zhf_login_form($settings){
		
		$lf_title = isset( $settings['lf_title'] ) ? $settings['lf_title'] : '';
		$title_head = isset( $settings['title_head'] ) ? $settings['title_head'] : 'h3';
		$rf_enabled = isset( $settings['rf_enabled'] ) ? $settings['rf_enabled'] : 'no';
		$fp_enabled = isset( $settings['fp_enabled'] ) ? $settings['fp_enabled'] : 'no';
		
		$uname_label = isset( $settings['uname_label'] ) ? $settings['uname_label'] : '';
		$pswd_label = isset( $settings['pswd_label'] ) ? $settings['pswd_label'] : '';
		$lf_btn_label = isset( $settings['lf_btn_label'] ) ? $settings['lf_btn_label'] : '';
		
		$register_link_text = isset( $settings['register_link_text'] ) ? $settings['register_link_text'] : '';
		$fp_link_text = isset( $settings['fp_link_text'] ) ? $settings['fp_link_text'] : '';
		
	?>
		<div class="login-form">
			<span class="close zhf-login-close"></span>
			<form id="login" action="login" method="post">
				<?php if( $lf_title ) : ?>
				<<?php echo esc_attr( $title_head ); ?> class="zhf-form-title"><?php echo esc_html( $lf_title ); ?></<?php echo esc_attr( $title_head ); ?>>
				<?php endif; ?>
				<?php wp_nonce_field( 'ajax-login-nonce', 'lsecurity' ); ?>
				<p class="status"></p>
				<p>
					<label for="username"><?php echo esc_html( $uname_label ); ?></label>
					<input id="lusername" type="text" name="username" class="form-control">
				</p>
				<p>
					<label for="password"><?php echo esc_html( $pswd_label ); ?></label>
					<input id="lpassword" type="password" name="password" class="form-control">
				</p>
				<p>
					<?php if ( get_option( 'users_can_register' ) && $rf_enabled == 'yes' ) : ?>
						<a class="register-trigger" href="#"><?php echo esc_html( $register_link_text ); ?></a>
						<?php echo ' / '; ?>
					<?php endif; ?>
					<?php if( $fp_enabled ): ?>
					<a class="lost-password-trigger" href="#"><?php echo esc_html( $fp_link_text ); ?></a>
					<?php endif; ?>
				</p>
				<div class="btn-wrap">
					<input class="submit_button btn btn-default" type="submit" value="<?php echo esc_html( $lf_btn_label ); ?>" name="submit">	
				</div>
			</form>
		</div>				
	<?php	
	}
	
	public static function zhf_register_form($settings){
	
		$rf_title = isset( $settings['rf_title'] ) ? $settings['rf_title'] : '';
		$title_head = isset( $settings['title_head'] ) ? $settings['title_head'] : 'h3';
		
		$yn_label = isset( $settings['yn_label'] ) ? $settings['yn_label'] : '';
		$ye_label = isset( $settings['ye_label'] ) ? $settings['ye_label'] : '';
		$nn_label = isset( $settings['nn_label'] ) ? $settings['nn_label'] : '';
		$r_un_label = isset( $settings['r_un_label'] ) ? $settings['r_un_label'] : '';
		$r_pswd_label = isset( $settings['r_pswd_label'] ) ? $settings['r_pswd_label'] : '';
		$rf_btn_label = isset( $settings['rf_btn_label'] ) ? $settings['rf_btn_label'] : '';
				
		if ( get_option( 'users_can_register' ) ) : ?>
			<div class="registration-form form-state-hide">
				<span class="fa fa-angle-left move-to-prev-form"></span>
				<form id="registration" class="ajax-auth" action="registration" method="post">   
					<?php if( $rf_title ) : ?>
					<<?php echo esc_attr( $title_head ); ?> class="zhf-form-title"><?php echo esc_html( $rf_title ); ?></<?php echo esc_attr( $title_head ); ?>>
					<?php endif; ?>
					<p class="status"></p>
					<p>
						<label for="name"><?php echo esc_html( $yn_label ); ?></label>
						<input id="name" type="text" name="name" class="form-control">
					</p>
					<p>
						<label for="email"><?php echo esc_html( $ye_label ); ?></label>
						<input id="uemail" type="text" name="email" class="form-control">
					</p>
					<p>
						<label for="nick_name"><?php echo esc_html( $nn_label ); ?></label>
						<input id="nick_name" type="text" name="nick_name" class="form-control">
					</p>
					<p>
						<label for="username"><?php echo esc_html( $r_un_label ); ?></label>
						<input id="username" type="text" name="username" class="form-control">
					</p>
					<p>
						<label for="password"><?php echo esc_html( $r_pswd_label ); ?></label>
						<input id="password" type="password" name="password" class="form-control">
					</p>
					<div class="btn-wrap">
						<input class="submit_button btn btn-default" type="submit" value="<?php echo esc_html( $rf_btn_label ); ?>" name="submit">
					</div>
					<?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
				</form>
			</div>
		<?php 	
		endif;
	}
	
	public static function zhf_forgot_form($settings){ 
		
		$fp_title = isset( $settings['fp_title'] ) ? $settings['fp_title'] : '';
		$title_head = isset( $settings['title_head'] ) ? $settings['title_head'] : 'h3';
		
		$fp_uname_label = isset( $settings['fp_uname_label'] ) ? $settings['fp_uname_label'] : '';
		$fp_btn_label = isset( $settings['fp_btn_label'] ) ? $settings['fp_btn_label'] : '';
	?>
		<div class="lost-password-form form-state-hide">
			<span class="fa fa-angle-left move-to-prev-form"></span>
			<form id="forgot_password" class="ajax-auth" action="forgot_password" method="post">    
				<?php if( $fp_title ) : ?>
				<<?php echo esc_attr( $title_head ); ?> class="zhf-form-title"><?php echo esc_html( $fp_title ); ?></<?php echo esc_attr( $title_head ); ?>>
				<?php endif; ?>
				<p class="status"></p>  
				<?php wp_nonce_field('ajax-forgot-nonce', 'forgotsecurity'); ?>  
				<p>
					<label for="user_login"><?php echo esc_html( $fp_uname_label ); ?></label>
					<input id="user_login" type="text" class="required form-control" name="user_login">
				</p>
				<div class="btn-wrap">
					<input class="submit_button btn btn-default" type="submit" value="<?php echo esc_html( $fp_btn_label ); ?>">
				</div>
			</form>
		</div>					
	<?php
	}
	
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}
	
} ZOZO_Header_Footer_Member::instance();