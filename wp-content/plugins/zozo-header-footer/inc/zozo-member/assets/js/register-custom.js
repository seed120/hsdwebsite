//News Log/Register Script
(function( $ ) {
	"use strict";
	
	$( document ).ready(function() {
	
		/* Zoacres Login/Register Code */
		$( ".login-form-trigger, .zoacres-login-close" ).click(function() {
			$('.zoacres-login-parent').toggleClass('login-open');
			return false;
		});
				
		$( ".move-to-prev-form" ).click(function() {
			$('.zoacres-login-parent .lost-password-form, .zoacres-login-parent .registration-form').removeClass('form-state-show').addClass('form-state-hide');
			$('.zoacres-login-parent .login-form').removeClass('form-state-hide').addClass('form-state-show');	
			return false;
		});
		
		$( ".register-trigger" ).click(function() {
			$('.zoacres-login-parent .lost-password-form, .zoacres-login-parent .login-form').removeClass('form-state-show').addClass('form-state-hide');
			$('.zoacres-login-parent .registration-form').removeClass('form-state-hide').addClass('form-state-show');	
			return false;
		});
		
		$( ".lost-password-trigger" ).click(function() {
			$('.zoacres-login-parent .registration-form, .zoacres-login-parent .login-form').removeClass('form-state-show').addClass('form-state-hide');
			$('.zoacres-login-parent .lost-password-form').removeClass('form-state-hide').addClass('form-state-show');
			return false;
		});
		
		//move-to-prev-form
		
		// Perform AJAX login on form submit
		$( document ).on( 'submit', 'form#login', function(e) {
			
			if( $('form#login #lusername').val() != '' && $('form#login #lpassword').val() != '' ){
				$('form#login p.status').show().text(zoacres_ajax_var.loadingmessage);
				($).ajax({
					type: 'post',
					dataType: 'json',
					url: zoacres_ajax_var.admin_ajax_url,
					data: { 
						'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
						'username': $('form#login #lusername').val(),
						'password': $('form#login #lpassword').val(),
						'security': $('form#login #lsecurity').val() },
					success: function(data){
						$('form#login p.status').text(data.message);
						if( data.loggedin == true ){
							if( data.redirect_url ){
								window.location.href = data.redirect_url;
							}else{
								window.location.reload();
							}
						}
					}
				});
				e.preventDefault();
			}else{
				$('form#login p.status').text(zoacres_ajax_var.valid_login);
				return false;
			}
		});
		
		// Perform AJAX register on form submit
		$( document ).on( 'submit', 'form#registration', function(e) {
			if( $('form#registration #uemail').val() != '' && $('form#registration #username').val() != '' && $('form#registration #password').val() != '' ){
				$('form#registration p.status').show().text(zoacres_ajax_var.loadingmessage);
	
				($).ajax({
					type: 'post',
					dataType: 'json',
					url: zoacres_ajax_var.admin_ajax_url,
					data: { 
						'action': 'ajaxregister', //calls wp_ajax_nopriv_ajaxlogin
						'name': $('form#registration #name').val(),
						'email': $('form#registration #uemail').val(),
						'nick_name': $('form#registration #nick_name').val(),
						'username': $('form#registration #username').val(),
						'password': $('form#registration #password').val(), 
						'usertype': $('form#registration #usertype').val(), 
						'security': $('form#registration #security').val() },
					success: function(data){
						$('form#registration p.status').text(data.message);
						if (data.register == true){
							
							$('form#registration p.status').text(data.message);
							setTimeout(function() {
								$('.zoacres-login-parent .lost-password-form, .zoacres-login-parent .registration-form').removeClass('form-state-show').addClass('form-state-hide');
								$('.zoacres-login-parent .login-form').removeClass('form-state-hide').addClass('form-state-show');	
							}, 1000);
							
						}else{
							$('form#registration p.status').text(data.message);	
						}
					}
				});
				e.preventDefault();
			}else{
				$('form#registration p.status').text(zoacres_ajax_var.req_reg);
				return false;
			}
		});
		
		// Lost Password Ajax
		$( document ).on( 'submit', 'form#forgot_password', function(e) {
			if( $('#user_login').val() != '' ){
				
				$('p.status', this).show().text(zoacres_ajax_var.loadingmessage);

				($).ajax({
					type: 'post',
					dataType: 'json',
					url: zoacres_ajax_var.admin_ajax_url,
					data: { 
						'action': 'lost_pass', 
						'user_login': $('#user_login').val(), 
						'security': $('#forgotsecurity').val(), 
					},
					success: function(data){					
						$('form#forgot_password p.status').text(data.message);
					}
				});
				e.preventDefault();
				return false;
			}else{
				$('form#forgot_password p.status').text(zoacres_ajax_var.valid_email);	
				return false;
			}
		});
		
		$( document ).on( 'click', '.google-login-trigger', function(e) {
			
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: zoacres_ajax_var.admin_ajax_url,
				data: { 
					action: "zoacres_google_login",
					"nonce": zoacres_ajax_var.social_login
				},success: function(data){
					var gurl = data["result"];
					window.location.href = gurl;
					console.log(data["result"]);
				},error: function(xhr, status, error) {
					console.log( xhr );
				}
			});
			
			return false;
		});
		
		$( document ).on( 'click', '.fb-login-trigger', function(e) {
			
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: zoacres_ajax_var.admin_ajax_url,
				data: { 
					action: "zoacres_fb_login",
					"nonce": zoacres_ajax_var.fb_login
				},success: function(data){
					var fburl = data["result"];
					window.location.href = fburl;
					console.log(data["result"]);
				},error: function(xhr, status, error) {
					console.log( xhr );
				}
			});
			
			return false;
		});

	}); // doc ready

})( jQuery );