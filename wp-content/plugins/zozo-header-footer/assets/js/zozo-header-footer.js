( function( $ ) {
	
	//Make sticky
	$.fn.zhf_stickypart = function( options ){
	
		//Sticky help functions
		var rcstickyhelp = {
			sticky_stat: function( st, header_top, sticky_outer, t_header_h, top_offset ){
				if( st > lastScrollTop ){
					if( st > header_top ){
						$(sticky_outer).children('.zhf-sticky-head').addClass('zhf-header-sticky');
						$(sticky_outer).children('.zhf-sticky-head').css({ 'top': top_offset + 'px' });
					}
				}else{
					if( st > ( header_top - t_header_h ) ){
						$(sticky_outer).children('.zhf-sticky-head').addClass('zhf-header-sticky');
						$(sticky_outer).children('.zhf-sticky-head').css({ 'top': top_offset + 'px' });
					}else{
						$(sticky_outer).children('.zhf-sticky-head').removeClass('zhf-header-sticky');
					}
				}
			},
			sticky_scroll_stat: function( st, lastScrollTop, header_top, sticky_outer, t_header_h ){
				if( st > lastScrollTop ){
					$(sticky_outer).children('.zhf-sticky-head').addClass("hide-up");
				}else{
					if( st > ( header_top - t_header_h ) ){
						if( st > header_top ) $(sticky_outer).children('.zhf-sticky-head').addClass('zhf-header-sticky').removeClass("hide-up");
					}else{
						$(sticky_outer).children('.zhf-sticky-head').removeClass('zhf-header-sticky').removeClass("hide-up");					
					}
				}
			}
		}

		var sticky_outer = this;	
		var lastScrollTop = 0;
		var header_top = st = 0;
		var sticky_up = $(sticky_outer).data("stickyup");
		$(sticky_outer).css( 'height', 'auto' );
		$(sticky_outer).children('.zhf-sticky-head').removeClass('zhf-header-sticky');
		var t_header_h = $(sticky_outer).outerHeight();
		$(sticky_outer).css( 'height', t_header_h );
		header_top = $(sticky_outer).offset().top;
		header_top += t_header_h;	
		var win_width = $(window).width();	
		var top_offset = 0;
		if( $("#wpadminbar").length && win_width > 600 ){
			top_offset = $("#wpadminbar").outerHeight();
			t_header_h += top_offset;
			//$(sticky_outer).children('.zhf-sticky-head').css({ "top": $("#wpadminbar").outerHeight() });
		}else{
			//$(sticky_outer).children('.zhf-sticky-head').css({ "top": 0 });
		}
		if( sticky_up ){ // Sticky on scroll up
			$(window).scroll(function(event){				
				st = $(this).scrollTop();
				rcstickyhelp.sticky_scroll_stat( st, lastScrollTop, header_top, sticky_outer, t_header_h, top_offset );
				if( st == 0 ){
					$(sticky_outer).children('.zhf-sticky-head').removeClass('zhf-header-sticky');
					$(sticky_outer).children('.zhf-sticky-head').css({ "top": 0 });
				}
				lastScrollTop = st;
			});	
		}else{ // Sticky on scroll
			$(window).scroll(function(event){				
				st = $(this).scrollTop();
				rcstickyhelp.sticky_stat( st, header_top, sticky_outer, t_header_h, top_offset );
				if( st == 0 ){
					$(sticky_outer).children('.zhf-sticky-head').removeClass('zhf-header-sticky');
					$(sticky_outer).children('.zhf-sticky-head').css({ "top": 0 });
				}
				lastScrollTop = st;
			});	
		}
	};	
	
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	 
	/* Search Widget Handler */
	var WidgetZozoHFSearch = function( $scope, $ ) {
		//$scope.find('.bottom-search-wrap').each(function( index ) {
			WidgetZozoHFSearchFun(  $scope );
		//});
	};
	
	/* Secondary Toggle Handler */
	var WidgetZozoHFSecondaryBar = function( $scope, $ ) {
		//$scope.find('.bottom-search-wrap').each(function( index ) {
			WidgetZozoHFSecondaryBarFun(  $scope );
		//});
	};
	
	/* Secondary Toggle Handler */
	var WidgetZozoHFMenu = function( $scope, $ ) {
		//$scope.find('.bottom-search-wrap').each(function( index ) {
			WidgetZozoHFMenuFun(  $scope );
		//});
	};
	
	/* User Regitrsation Handler */
	var WidgetZozoHFUserRegistration = function( $scope, $ ) {
		if( $scope.find('.login-form-trigger').length ) {
			WidgetZozoHFUserRegistrationFun(  $scope );
		};
	};
	
	/* Minicart Handler */
	var WidgetZozoHFMinicart = function( $scope, $ ) {
		if( $scope.find('.zozo-sticky-cart-wrap').length ) {
			WidgetZozoHFUserRegistrationFun(  $scope );
		};
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		
		elementorFrontend.hooks.addAction( 'frontend/element_ready/zozo_hf_search.default', WidgetZozoHFSearch );	
		elementorFrontend.hooks.addAction( 'frontend/element_ready/zozo_hf_secondary_bar.default', WidgetZozoHFSecondaryBar );elementorFrontend.hooks.addAction( 'frontend/element_ready/zozo_hf_menu.default', WidgetZozoHFMenu );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/zozo_hf_registration.default', WidgetZozoHFUserRegistration );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/zozo_hf_minicart.default', WidgetZozoHFMinicart );
		
	} );
	
	$(window).load( function() {
		if( $( ".zhf-sticky-obj" ).length ){
			$(".zhf-sticky-obj").each(function(){
				var _sticky_ele = $(this);
				_sticky_ele.children("div").addClass("zhf-sticky-head");
				_sticky_ele.zhf_stickypart();
				var sticky_on_time;
				$(window).resize(function(event){
					clearTimeout(sticky_on_time);
					sticky_on_time = setTimeout(function(){ _sticky_ele.zhf_stickypart(); }, 300);
				});
			});
		}
	});
	
	function WidgetZozoHFMinicartFun(){
		
		// Clear and store values in local storage
		if (typeof(Storage) !== "undefined"){
			localStorage.removeItem('mini_wishlist_count');
			localStorage.removeItem('mini_wishlist');
			$( window ).on( 'storage onstorage', function ( e ) {
				var mini_wishlist = localStorage.getItem( 'mini_wishlist' );
				var mini_wishlist_count = localStorage.getItem( 'mini_wishlist_count' );
				if( mini_wishlist_count ) $(document).find("span.zhf-wishlist-items-count").text(mini_wishlist_count);
				if( mini_wishlist )  $(document).find("ul.wishlist-dropdown-menu, ul.zhf-sticky-wishlist").html(mini_wishlist);
				localStorage.removeItem( 'mini_wishlist' );
				localStorage.removeItem( 'mini_wishlist_count' );
			});
		}
		
		/* Mini cart addon scripts */

		// Sticky cart close click
		$(document).find("body .zhf-sticky-cart-wrap .zhf-sticky-cart-close").on( "click", function(e) {
			$(document).find(".zhf-sticky-cart-wrap").toggleClass("active");
			$(window).trigger("resize");
			return false;
		});
		
		// Mini cart/Sticky cart remove item
		if( $( document ).find('.mini-cart-item').length || $( document ).find(".zhf-sticky-cart").length ){
			
			$( document ).on( 'click', '.remove-cart-item', function(){
				
				var cur_ele = $(this);
				cur_ele.addClass("loading");
				var product_id = cur_ele.attr("data-product_id");
				
				$.ajax({
					type: 'post',
					dataType: 'json',
					url: zhfwoobase_ajax_var.admin_ajax_url,
					data: { 
						action: "zhf_product_remove", 
						nonce: zhfwoobase_ajax_var.remove_from_cart,
						product_id: product_id
					},
					success: function(data){
						
						if( data['status'] == 1 ){
							if( data['mini_cart'] ){
								$(document).find('.mini-cart-dropdown li.cart-item[data-product-id="'+ product_id +'"]').fadeOut( 350, function(){
									$(document).find(".mini-cart-dropdown ul.cart-dropdown-menu").html( data['mini_cart'] );
									$(document).find(".mini-cart-dropdown .woo-icon-count").text( data['cart_count'] );
								});
								
							}
							if( data['sticky_cart'] ){
								$(document).find('.zhf-sticky-cart li.cart-item[data-product-id="'+ product_id +'"]').fadeOut( 350, function(){
									$(document).find(".zhf-sticky-cart-wrap ul.zhf-sticky-cart").html( data['sticky_cart'] );
									$(document).find(".zhf-sticky-cart-wrap .woo-icon-count").text( data['cart_count'] );
								});
							}
							if( $(document).find(".mobile-footer-sticky-bar .cart-items-count").length ){
								$(document).find(".mobile-footer-sticky-bar .cart-items-count").text( data['cart_count'] );
							}
														
							$( document.body ).trigger( 'wc_fragment_refresh' );
							//console.log("wc fragment refreshed");
						}
						
						cur_ele.removeClass("loading");
						
					},
					error: function(xhr, status, error) {
						cur_ele.removeClass("loading");
					}
				});
				return false;
			});	
			
		}		
		
		// Ajax add to cart
		$( document ).on( 'click', "a.zhf-ajax-add-to-cart", function( event) {
			
			if( $(this).parents(".zhf-wishlist-table").length ){
				$(this).parents("tr").find("a.zhf-wishlist-remove").trigger("click");
			}
			
			var cur_ele = $(this);
			cur_ele.addClass("loading");
			var product_id = $(this).attr("data-product_id");
			var variations = cur_ele.data("variations") ? cur_ele.data("variations") : '';
			
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: zhfwoobase_ajax_var.admin_ajax_url,
				data: { 
					action: "zhf_add_to_cart",
					product_id: product_id,
					variation: variations,
					nonce: zhfwoobase_ajax_var.add_to_cart
				},success: function(data){					
					cur_ele.removeClass("loading");					
					if( data['error'] == true ){
						var not_avail_msg = zhfwoobase_ajax_var.product_not_available;
						if( cur_ele.parents("li.product").hasClass("product-type-variable") ){
							not_avail_msg = zhfwoobase_ajax_var.variation_not_available;
						}
						var err_html = '<div class="variation-not-available-wrap"><span class="ti-close"></span><div class="variation-not-inner">'+ not_avail_msg +'</div></div>';
						cur_ele.parents("li.product").append(err_html);
					}else{					
						if( data['status'] == 1 ){							
							if( data['mini_cart'] ){
								$(document).find(".mini-cart-dropdown ul.cart-dropdown-menu").html( data['mini_cart'] );
								$(document).find(".mini-cart-item .woo-icon-count").text( data['cart_count'] );
							}
							if( data['sticky_cart'] ){
								$(document).find(".zhf-sticky-cart-wrap ul.zhf-sticky-cart").html( data['sticky_cart'] );
								$(document).find(".zhf-sticky-cart-wrap .woo-icon-count").text( data['cart_count'] );
								if( !$(document).find(".zhf-sticky-cart-wrap").hasClass("active") ) $(document).find(".zhf-sticky-cart-wrap").addClass("active");
							}	
							if( $(document).find(".mobile-footer-sticky-bar .cart-items-count").length ){
								$(document).find(".mobile-footer-sticky-bar .cart-items-count").text( data['cart_count'] );
							}							
							$( document.body ).trigger( 'wc_fragment_refresh' );
							//console.log("wc fragment refreshed");
						}						
					}					
				},error: function(xhr, status, error) {
					cur_ele.removeClass("loading");
				}
			});
			
			return false;
			
		});
		
		/* Wishlist addon scripts */
		
		// Sticky wishlist close click
		$(document).find("body .zhf-sticky-wishlist-close").on( "click", function(e) {
			$(document).find(".zhf-sticky-wishlist-wrap").toggleClass("active");
			$(window).trigger("resize");
			return false;
		});	

		// Product wishlist trigger
		$( document ).on( 'click', ".zhf-woo-favourite-trigger", function( event) {
			
			var cur_a = $(this);
			var product_id = cur_a.attr("data-product-id");
			
			if( zhfwoobase_ajax_var.user_logged == 0 ){
				if( $('.zhf-login-parent').length ){
					$('.zhf-login-parent').toggleClass('login-open');
				}else{
					window.location.href = zhfwoobase_ajax_var.woo_user_page;
				}
				return false;
			}
			
			if( product_id ){
				
				cur_a.addClass("loading");
				$.ajax({
					type: "post",
					dataType: "json",
					url: zhfwoobase_ajax_var.admin_ajax_url,
					data: "action=woo_fav_act&nonce="+ zhfwoobase_ajax_var.wishlist_nonce +"&post_id="+product_id,
					success: function(res){
						
						if( res == 0 ){
							if( $('.zhf-login-parent').length ) $('.zhf-login-parent').toggleClass('login-open');
						}else{
						
							if( res['stat'] == 'fav' ){
								cur_a.addClass("theme-color");
								if( !cur_a.parents("li.product").find(".zhf-product-favoured").length ){
									cur_a.parents("li.product").prepend('<span class="zhf-product-favoured"><i class="ti-heart"></i></span>');
								}
							}else{
								cur_a.removeClass("theme-color");
								if( cur_a.parents("li.product").find(".zhf-product-favoured").length ){
									cur_a.parents("li.product").find(".zhf-product-favoured").remove();
								}
							}
						
							if( $.isNumeric( res['count'] ) ){
								if( $(document).find("a.mini-wishlist-item").length ){
									if( $(document).find("span.zhf-wishlist-items-count").length ){
										$(document).find("span.zhf-wishlist-items-count").text(res['count']);
									}else{
										$(document).find("a.mini-wishlist-item").append('<span class="span.zhf-wishlist-items-count">'+ res['count'] +'</span>');
									}
								}
								localStorage.setItem( 'mini_wishlist_count', res['mini_wishlist_count'] );
							}
							
							if( res['mini_wishlist'] ){								
								if( !$(document).find(".zhf-sticky-wishlist-wrap").hasClass("active") ) $(document).find(".zhf-sticky-wishlist-wrap").addClass("active");
								$(document).find("ul.wishlist-dropdown-menu, ul.zhf-sticky-wishlist").html(res['mini_wishlist']);							
								if (typeof(Storage) !== "undefined"){
									localStorage.setItem( 'mini_wishlist', res['mini_wishlist'] );
								}
							}
							
							
						}
						
						cur_a.removeClass("loading");
						
					},
					error: function (jqXHR, exception) {
						cur_a.removeClass("loading");
						console.log(jqXHR);
					}
				});
			}
			
			return false;
		});
		
		// Remove wishlist row
		$( document ).on( 'click', "a.zhf-wishlist-remove, a.remove-wishlist-item", function( event) {
			
			var cur_a = $(this);
			var product_id = cur_a.attr("data-product-id");
			
			if( product_id ){
				
				cur_a.addClass("loading");
				$.ajax({
					type: "post",
					dataType: 'json',
					url: zhfwoobase_ajax_var.admin_ajax_url,
					data: "action=zhf_wishlist_remove&nonce="+zhfwoobase_ajax_var.wishlist_remove+"&product_id="+product_id,
					success: function(res){
						
						if( $(document).find("li.post-" + product_id ).length ) $(document).find("li.post-" + product_id + " span.zhf-product-favoured" ).remove();
						
						if( cur_a.hasClass("remove-wishlist-item") ){
							cur_a.parents("li.wishlist-item").fadeOut( 350, function() {
								cur_a.parents("li.wishlist-item").remove();
							});
						}else{
							cur_a.parents("tr").fadeOut( 350, function() {
								cur_a.parents("tr").remove();
							});
						}
												
						if( $.isNumeric( res['mini_wishlist_count'] ) ){
							if( $(document).find("span.zhf-wishlist-items-count").length ){
								$(document).find("span.zhf-wishlist-items-count").text(res['mini_wishlist_count']);
							}else{
								$(document).find("a.mini-wishlist-item").append('<span class="span.zhf-wishlist-items-count">'+ res['mini_wishlist_count'] +'</span>');
							}
							localStorage.setItem( 'mini_wishlist_count', res['mini_wishlist_count'] );
						}
						
						if( res['mini_wishlist'] ){		
							setTimeout(function(){ 					
								$(document).find("ul.wishlist-dropdown-menu, ul.zhf-sticky-wishlist").html(res['mini_wishlist']);							
								if (typeof(Storage) !== "undefined"){
									localStorage.setItem( 'mini_wishlist', res['mini_wishlist'] );								
								}
							}, 350 );
						}
						
					},
					error: function (jqXHR, exception) {
						console.log(jqXHR);
					}
				});
			}
			
			return false;
		});
		
	}
	
	function WidgetZozoHFUserRegistrationFun( $scope ){
		$(document).find( ".login-form-trigger, .zhf-login-close" ).click(function() {
			$('.zhf-login-parent').toggleClass('login-open');
			return false;
		});
				
		$(document).find( ".move-to-prev-form" ).click(function() {
			$('.zhf-login-parent .lost-password-form, .zhf-login-parent .registration-form').removeClass('form-state-show').addClass('form-state-hide');
			$('.zhf-login-parent .login-form').removeClass('form-state-hide').addClass('form-state-show');	
			return false;
		});
		
		$(document).find( ".register-trigger" ).click(function() {
			$('.zhf-login-parent .lost-password-form, .zhf-login-parent .login-form').removeClass('form-state-show').addClass('form-state-hide');
			$('.zhf-login-parent .registration-form').removeClass('form-state-hide').addClass('form-state-show');	
			return false;
		});
		
		$(document).find( ".lost-password-trigger" ).click(function() {
			$('.zhf-login-parent .registration-form, .zhf-login-parent .login-form').removeClass('form-state-show').addClass('form-state-hide');
			$('.zhf-login-parent .lost-password-form').removeClass('form-state-hide').addClass('form-state-show');
			return false;
		});
		
		// Perform AJAX login on form submit
		$( document ).on( 'submit', 'form#login', function(e) {
			
			//console.log("test"); return false;
			
			if( $('form#login #lusername').val() != '' && $('form#login #lpassword').val() != '' ){
				$('form#login p.status').show().text(zhf_ajax_var.loadingmessage);
				($).ajax({
					type: 'post',
					dataType: 'json',
					url: zhf_ajax_var.ajax_url,
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
				$('form#login p.status').text(zhf_ajax_var.valid_login);
				return false;
			}
		});
		
		// Perform AJAX register on form submit
		$( document ).on( 'submit', 'form#registration', function(e) {
			if( $('form#registration #uemail').val() != '' && $('form#registration #username').val() != '' && $('form#registration #password').val() != '' ){
				$('form#registration p.status').show().text(zhf_ajax_var.loadingmessage);
	
				($).ajax({
					type: 'post',
					dataType: 'json',
					url: zhf_ajax_var.ajax_url,
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
								$('.zhf-login-parent .lost-password-form, .zhf-login-parent .registration-form').removeClass('form-state-show').addClass('form-state-hide');
								$('.zhf-login-parent .login-form').removeClass('form-state-hide').addClass('form-state-show');	
							}, 1000);
							
						}else{
							$('form#registration p.status').text(data.message);	
						}
					}
				});
				e.preventDefault();
			}else{
				$('form#registration p.status').text(zhf_ajax_var.req_reg);
				return false;
			}
		});
		
		// Lost Password Ajax
		$( document ).on( 'submit', 'form#forgot_password', function(e) {
			if( $('#user_login').val() != '' ){
				
				$('p.status', this).show().text(zhf_ajax_var.loadingmessage);

				($).ajax({
					type: 'post',
					dataType: 'json',
					url: zhf_ajax_var.ajax_url,
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
				$('form#forgot_password p.status').text(zhf_ajax_var.valid_email);	
				return false;
			}
		});
	}
	
	function WidgetZozoHFMenuFun( $scope ){
		var _hmenu_stat = 1;
		if( $scope.hasClass( "zhf-vertical-enabled" ) ){
			_hmenu_stat = 0;
			ZHFVerticalMenu($scope);
		}
				
		ZHFWindowResize($scope, _hmenu_stat);
		
		$(window).on( "resize", function() {
			ZHFWindowResize($scope, _hmenu_stat);
		});

		ZHFMobileMenu($scope);
		
	}
	
	function ZHFVerticalMenu($scope){
		$( document ).on( "click", ".zhf-vertical-enabled .dropdown-icon", function() {
			let _ele = $(this);
			_ele.toggleClass("opened");
			_ele.parent("a").next("ul.sub-menu").toggleClass("opened");
			return false;
		});
		
	}
	
	function ZHFMobileMenu($scope){	
		$( document ).on( "click", ".zhf-menu-toggle", function() {
			let _ele = $(this);
			$scope.find(".zhf-menu-toggle-wrap .zhf-menu-toggle").toggleClass("opened");
			$scope.find(".zhf-menu-wrap").toggleClass("mobile-menu-active");
			if( $scope.hasClass("zhf-fly-layout-push") && $scope.find(".zhf-menu-wrap").hasClass("mobile-menu-active") ){
				$("body").addClass("zhf-transition-350");
				if( $scope.hasClass("zhf-fly-left") ) {
					$("body").css({"margin-left":'350px', "margin-right": '-350px', "overflow-x": 'hidden'});
				}else{
					$("body").css({"margin-right":'350px', "margin-left": '-350px', "overflow-x": 'hidden'});
				}
			}else if( $scope.hasClass("zhf-fly-layout-push") && $scope.find(".zhf-menu-wrap").hasClass("mobile-menu-deactive") ){
				$("body").css({"margin-left":'', "margin-right":''});
			}
			return false;
		});
	}
	
	function ZHFWindowResize($scope, _hmenu_stat){
		let _mobile_from = $scope.find( ".elementor-widget-container" ).data("responsive");
		let _win_width = $(window).width();
		$scope.find(".zhf-menu-wrap").addClass("mobile-menu-deactive");
		if( _win_width < parseInt( _mobile_from ) ) {
			$scope.find( ".zhf-menu-toggle-wrap" ).addClass("active");
			if( _hmenu_stat ){
				//$scope.find( ".zhf-menu-horizontal" ).removeClass("zhf-menu-horizontal").addClass("zhf-menu-vertical");
				$scope.addClass("zhf-vertical-enabled");
				ZHFVerticalMenu($scope);
			}
			$scope.find(".zhf-menu-wrap").removeClass("mobile-menu-active").addClass("mobile-menu-deactive");
			$scope.find(".zhf-menu-toggle-wrap .zhf-menu-toggle").removeClass("opened");
		}else{
			$scope.find( ".zhf-menu-toggle-wrap" ).removeClass("active");
			if( _hmenu_stat ){
				//$scope.find( ".zhf-menu-vertical" ).removeClass("zhf-menu-vertical").addClass("zhf-menu-horizontal");
				$scope.removeClass("zhf-vertical-enabled");
			}
			$scope.find(".zhf-menu-wrap").removeClass("mobile-menu-deactive mobile-menu-active");
		}
	}
	
	function WidgetZozoHFSecondaryBarFun( $scope ){
		if( $scope.find( ".zhf-secondary-area-wrap" ).length ){
			var _ele_class = $scope.find(".zhf-secondary-area-wrap").attr("class");
			var _area_width = $scope.find(".zhf-secondary-area-wrap").data("width");
			var _push_type = $scope.find(".zhf-secondary-area-wrap").data("type");
			var _push_stat = _ele_class.search( "push" );
			$( document ).on( "click", ".zhf-secondar-bar-toggle", function() {				
				if( _push_stat != -1 ) {
					if( _push_type == 'left' ) $("body").css({"margin-left":_area_width+'px', "margin-right": '-'+_area_width+'px', "overflow": "hidden"});
					else if( _push_type == 'right' ) $("body").css({"margin-right":_area_width+'px', "margin-left": '-'+_area_width+'px', "overflow": "hidden"});
				}
				$(".zhf-secondary-area-wrap").addClass("active");
				$("body").addClass("zhf-transition-area");
			});
			$( document ).on( "click", ".zhf-close", function() {
				if( _push_stat != -1 ) {
					if( _push_type == 'left' ) $("body").css({"margin-left":'', "margin-right":''});
					else if( _push_type == 'right' ) $("body").css({"margin-right":'', "margin-right":''});
					setTimeout( function(){ $("body").css({"overflow": ""}); }, 350 );
				}
				$(".zhf-secondary-area-wrap").removeClass("active");
				$("body").removeClass("zhf-transition-area");
			});
		}
	}
	
	function WidgetZozoHFSearchFun( $scope ){
		
		if( $scope.find( ".zhf-full-search-toggle" ).length ){
			$( document ).on( "click", ".zhf-full-search-toggle", function() {
				$('.zhf-full-search-wrapper').addClass("search-wrapper-opened");
				$('.zhf-full-search-wrapper').fadeToggle(500);
				var search_in = $('.search-wrapper-opened').find("input.form-control");
				search_in.focus();			
				return false;
			});
		}else if( $scope.find( ".zhf-textbox-search-toggle" ).length ){
			$( document ).on('click', '.zhf-textbox-search-toggle', function(){
				var _cur_parent = $(this).parents('.zhf-search-toggle-wrap');
				_cur_parent.toggleClass('active');
				var search_in = _cur_parent.find("input.zhf-form-control");
				setTimeout(function(){
					if( _cur_parent.hasClass("active") ) {
						search_in.focus();
					}				
				}, 350);
				return false;
			});
		}else if( $scope.find( ".zhf-full-bar-search-toggle" ).length ){
			$( document ).on('click', '.zhf-full-bar-search-toggle', function(){
				let _full_bar_html = $('.zhf-full-bar-search-wrap');
				$('.zhf-full-bar-search-wrap').remove;
				$scope.parents(".elementor-container").append(_full_bar_html);
				$( document ).find('.zhf-full-bar-search-wrap').toggleClass('active');
				var search_in = $( document ).find('.zhf-full-bar-search-wrap').find("input.zhf-form-control");				
				setTimeout(function(){
					if( $(document).find(".zhf-full-bar-search-wrap").hasClass("active") ) {
						search_in.focus();
					}
				}, 350);				
				return false;
			});
		}else if( $scope.find( ".zhf-bottom-search-toggle" ).length ){
			$( document ).on('click', '.zhf-bottom-search-toggle', function(){
				var _cur_parent = $(this).parents('.zhf-search-toggle-wrap');
				_cur_parent.toggleClass('active');
				var search_in = _cur_parent.find("input.form-control");
				setTimeout(function(){
					if( _cur_parent.hasClass("active") ) {
						search_in.focus();
					}				
				}, 350);
				return false;
			});
		}
		
		/*var cur_ele = $(cur_ele);
		var typing_text = cur_ele.attr("data-typing") ? cur_ele.attr("data-typing") : [];
		if( typing_text ){
			typing_text = typing_text.split(",");
			
			var type_speed = cur_ele.data("typespeed") ? cur_ele.data("typespeed") : 100;
			var back_speed = cur_ele.data("backspeed") ? cur_ele.data("backspeed") : 100;
			var back_delay = cur_ele.data("backdelay") ? cur_ele.data("backdelay") : 1000;
			var start_delay = cur_ele.data("startdelay") ? cur_ele.data("startdelay") : 1000;
			var cur_char = cur_ele.data("char") ? cur_ele.data("char") : '|';
			var loop = cur_ele.data("loop") ? cur_ele.data("loop") : false;

			var typed = new Typed(cur_ele[index], {
				typeSpeed: type_speed,
				backSpeed: back_speed,
				backDelay: back_delay,
				startDelay: start_delay,
				strings: typing_text,
				loop: loop,
				cursorChar: cur_char
			});

		}*/
	}
	
} )( jQuery );

