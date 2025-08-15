/*
 * Hirxpert Theme Js 
 */ 

(function( $ ) {

	"use strict";

	/* Document ready event */
	$( document ).ready(function() {
		
		var win_width = $(window).width();
		
		/* Escape events */
		document.onkeydown = function(evt) {
		    evt = evt || window.event;
		    if (evt.keyCode == 27) {
				if( $(".full-search-toggle").length ){
		        	$('.full-search-wrapper').removeClass("search-wrapper-opened");
		        }
		    }
		};	
		
		/* Search forms */
		if( $( ".full-search-toggle" ).length ){
			$( document ).on( "click", ".full-search-toggle", function() {
				$('.full-search-wrapper').toggleClass("search-wrapper-opened");
				setTimeout(function(){
					var search_in = $('.full-search-wrapper').find("input.form-control");
					search_in.focus();	
				}, 300 );
				return false;
			});
		}
		if( $( ".textbox-search-toggle" ).length ){
			$( document ).on('click', '.textbox-search-toggle', function(){
				$(this).prev('.textbox-search-wrap').toggleClass('active');
				setTimeout(function(){
					var search_in = $('.textbox-search-wrap').find("input.form-control");
					search_in.focus();
				}, 500 );	
				return false;
			});
		}else if( $( ".full-bar-search-toggle" ).length ){
			$( document ).on('click', '.full-bar-search-toggle', function(){
				$('.full-bar-search-wrap').toggleClass('active');
				setTimeout(function(){
					var search_in = $('.full-bar-search-wrap').find("input.form-control");
					search_in.focus();
				}, 300 );
				return false;
			});
		}else if( $( ".bottom-search-toggle" ).length ){
			$( document ).on('click', '.bottom-search-toggle', function(){
				$(this).next('.bottom-search-wrap').toggleClass('active');
				setTimeout(function(){
					var search_in = $('.bottom-search-wrap').find("input.form-control");
					search_in.focus();
				}, 300 );
				return false;
			});
		}
		
		if( $( ".mobile-menu-toggle" ).length ){
			$( ".mobile-menu-toggle" ).on( "click", function() {
				$("body").toggleClass("mobile-menu-active");
				return false;
			});
		}
		
		if( $( ".secondary-toggle-wrapper" ).length ){
			$( ".secondary-menu-toggle" ).on( "click", function() {
				$("body").toggleClass("secondary-bar-active");
				$(".secondary-menu-toggle").toggleClass("active");
				return false;
			});
		}
		
		if( $( "ul.mobile-menu" ).length ){
			//$( "ul.mobile-menu li.menu-item-has-children" ).append('<span class="down-arrow"></span>');
			
			$( "ul.mobile-menu").find('li.menu-item > ul.sub-menu').each(function() {
				$(this).parent("li").append( '<span class="down-arrow"></span>' );				
			});
			
			$( document ).on( "click", "ul.mobile-menu span.down-arrow", function() {
				$(this).removeClass("down-arrow").addClass("up-arrow");
				$(this).prev("ul.sub-menu").slideDown(350);
				return false;
			});	
			$( document ).on( "click", "ul.mobile-menu span.up-arrow", function() {
				var parent_li = $(this).parent("li.menu-item");
				$(parent_li).find("span.up-arrow").removeClass("up-arrow").addClass("down-arrow");
				$(parent_li).find("ul.sub-menu").slideUp(350);
				return false;
			});				
		}
		
		if( $( "ul.nav.social-share" ).length ){
			$( "ul.nav.social-share a" ).each(function() {
				$( this ).attr( "href", $( this ).data("href") );
			});
		}
		
		/* Menu Scroll */
		var cur_offset = 0;		
		var o_stat = 0; // One Page Menu Status
		$( '.primary-menu li.menu-item, .mobile-menu li.menu-item' ).each(function( index ) {
			var cur_item = this;
			var target = $(cur_item).children("a").attr("href");
			if( target && target.indexOf("#section-") != -1 ){
				o_stat = 1;
				var res = target.split("#");
				if( res.length == 2 ){
					$(cur_item).children("a").attr("data-target", res[0]);
					$(cur_item).children("a").attr("href", "#"+res[1]);
				}	
			}
		});
		
		if( o_stat ){
		
			if( $('.primary-menu .menu-item').find('a[href="#section-top"]').length ){
				$("body").attr("id","section-top");
			}
			
			$( '.primary-menu li.menu-item, .mobile-menu li.menu-item' ).removeClass("current-menu-item");
			
			var header_offset = hirxpert_ajax_var.header_offset;
			var mheader_offset = hirxpert_ajax_var.mheader_offset;
			var res_width = hirxpert_ajax_var.res_width;
			
			$(window).on('scroll', function () {
				
				var minus_height = $("#wpadminbar").length ? $("#wpadminbar").outerHeight() : 0;
				minus_height += win_width >= res_width ? parseInt( header_offset ) + 1 : parseInt( mheader_offset );
				$('div[id*="section-"], body').each(function () {
					var anchored = $(this).attr("id"),
						targetOffset = $(this).offset().top - minus_height;
						
					if ($(window).scrollTop() > targetOffset) {
						$('.primary-menu .menu-item').find("a").removeClass("active");
						$('.primary-menu .menu-item').find('a[href="#'+ anchored +'"]').addClass("active");
						
						//Mobile menu scroll spy active
						$('.mobile-menu .menu-item').find("a").removeClass("active");
						$('.mobile-menu .menu-item').find('a[href="#'+ anchored +'"]').addClass("active");
					}
				});
			});
			
			$( '.primary-menu .menu-item > a[href^="#section-"], .mobile-menu .menu-item > a[href^="#section-"]' ).on('click',function (e) {
				
				var cur_item = this;
				var target = $(cur_item).attr("href");
				
				if( $("body.mobile-menu-active").length ) {
					$("body").removeClass("mobile-menu-active");
				}
				
				var target_id = target.slice( target.indexOf("#"), ( target.length ) );
				var cur_url = location.protocol + '//' + location.host + location.pathname; //window.location.href;
				var data_targ = $(cur_item).attr("data-target");
				var another_page = false;
				if( target_id == '#section-top' && data_targ != '' ){
					if( cur_url != data_targ ){
						another_page = true;
					}
				}

				if( $( target_id ).length && !another_page ){
					var minus_height = $("#wpadminbar").length ? $("#wpadminbar").outerHeight() : 0;
					minus_height += win_width >= res_width ? parseInt( header_offset ) : parseInt( mheader_offset );
					var offs = $(target_id).offset().top - minus_height;						
					var sec_ani_call = 1;
					if( target_id == '#section-top' ){
						sec_ani_call = 1;
						offs = 0;
					}
					$('html,body').animate({ 'scrollTop': offs }, 0 );
					
					return false;
				}else{
					
					if( target_id == '#section-top' && cur_url == data_targ ){
						$('html,body').animate({ 'scrollTop': 0 }, 0 );
						return false;
					}else{
						if( cur_url != data_targ && target_id != '#' ){
							window.location.href = data_targ + target;
						}else{
							window.location.href = target;
						}
					}

				}
			
			});	
			
		}
		
		/*Back to top*/
		if( $( "a.back-to-top" ).length ){
			$( document ).on('click', 'a.back-to-top', function(){
				$('html,body').animate({ 'scrollTop': 0 }, 0 );
				return false;
			});
			$( document ).scroll(function() {
				var y = $( this ).scrollTop();
				if ( y > 300 )
					$( 'a.back-to-top' ).fadeIn();
				else
					$( 'a.back-to-top' ).fadeOut();
			});
		}
		
		/*Mailchimp Code*/
		if( $('.zozo-mc').length ){
			$('.zozo-mc').on( "click", function () {
				
				var c_btn = $(this);
				var mc_wrap = $( this ).parents('.mailchimp-wrapper');
				var mc_form = $( this ).parents('.zozo-mc-form');
				mc_wrap.find('.mc-notice-msg').removeClass("mc-success mc-failure");
				if( mc_form.find('input[name="zozo_mc_email"]').val() == '' ){
					mc_wrap.find('.mc-notice-msg').text( hirxpert_ajax_var.must_fill );
				}else{
					c_btn.attr( "disabled", "disabled" );
					$.ajax({
						type: "POST",
						url: hirxpert_ajax_var.ajax_url,
						data: 'action=zozo-mc&nonce='+hirxpert_ajax_var.mc_nounce+'&'+mc_form.serialize(),
						success: function (data) {
							//Success
							c_btn.removeAttr( "disabled" );
							if( data == 'success' ){
								mc_wrap.find('.mc-notice-msg').addClass("mc-success");
								mc_wrap.find('.mc-notice-msg').text( mc_wrap.find('.mc-notice-group').attr('data-success') );
							}else{
								mc_wrap.find('.mc-notice-msg').addClass("mc-failure");
								mc_wrap.find('.mc-notice-msg').text( mc_wrap.find('.mc-notice-group').attr('data-fail') );
							}
						},error: function(xhr, status, error) {
							c_btn.removeAttr( "disabled" );
							mc_wrap.find('.mc-notice-msg').text( mc_wrap.find('.mc-notice-group').attr('data-fail') );
						}
					});
				}
			});
		} // if mailchimp exists

	}); // doc ready end	

	/* Window load event */
	$( window ).load(function() {
		
		if( $('.related-product-slider').length ){

			var c_owlCarousel = $('.related-product-slider');
                                    
			// Data Properties
			var loop = c_owlCarousel.data( "loop" );
			var margin = c_owlCarousel.data( "margin" );
			var center = c_owlCarousel.data( "center" );
			var nav = c_owlCarousel.data( "nav" );
			var dots_ = c_owlCarousel.data( "dots" );
			var items = c_owlCarousel.data( "items" );
			var items_tab = c_owlCarousel.data( "items-tab" );
			var items_mob = c_owlCarousel.data( "items-mob" );
			var duration = c_owlCarousel.data( "duration" );
			var smartspeed = c_owlCarousel.data( "smartspeed" );
			var scrollby = c_owlCarousel.data( "scrollby" );
			var autoheight = c_owlCarousel.data( "autoheight" );
			var autoplay = c_owlCarousel.data( "autoplay" );
			var rtl = $( "body.rtl" ).length ? true : false;

			$( c_owlCarousel ).owlCarousel({
				rtl : rtl,
				loop	: loop,
				autoplayTimeout	: duration,
				smartSpeed	: smartspeed,
				center: center,
				margin	: margin,
				nav		: nav,
				dots	: dots_,
				autoplay	: autoplay,
				autoheight	: autoheight,
				slideBy		: scrollby,
				responsive:{
					0:{
						items: items_mob
					},
					544:{
						items: items_tab
					},
					992:{
						items: items
					}
				}
			});	
		}

		//Hirxpert masonry
		if( $(".hirxpert-masonry").length ){
			var masonry_on_time;			
			var masonry_cols = $(".hirxpert-masonry").data('columns');			
			var masonry_gutter = $(".hirxpert-masonry").data('gutter');
			
			$(".hirxpert-masonry").rcmasonry({
				columns	: masonry_cols,
				gutter	: masonry_gutter
			});
			
			$(window).resize(function(event){
				clearTimeout(masonry_on_time);
				masonry_on_time = setTimeout(function(){
					$(".hirxpert-masonry").rcmasonry({
						columns	: masonry_cols,
						gutter	: masonry_gutter
					});
				}, 300);
			});
		}
    
    
    //Elementor RTL issue
    function hirxpert_for_elementor_row(){
  		$("body.rtl section.elementor-section-stretched").each(function() {
  			var left_pos = $(this).css( "left" );
			  left_pos = Math.abs( parseFloat(left_pos) );
		  	if( left_pos ) $(this).css( "left", left_pos );
	  	});
  	}
  
		if( $("body.rtl").length && $("section.elementor-section-stretched").length ){
			hirxpert_for_elementor_row();
		}
    
    $(window).resize(function(event){
					//Elementor RTL issue
      		if( $("body.rtl").length && $("section.elementor-section-stretched").length ){
      			hirxpert_for_elementor_row();
      		}
		});

		//Sticky header
		if( $(".sticky-outer").length ){
			$(".sticky-outer").each(function(){
				var _sticky_ele = $(this);
				_sticky_ele.hirxpert_stickypart();
				var sticky_on_time;
				$(window).resize(function(event){
					clearTimeout(sticky_on_time);
					sticky_on_time = setTimeout(function(){ _sticky_ele.hirxpert_stickypart(); }, 300);
				});
			});
		}
				
		//Page loader
		if( $("body.page-load-initiate").length ){
			$("body").removeClass("page-load-initiate");
			$("body").addClass("page-load-end");
		}else{
			$(".page-loader").addClass("loaded");
		}
				
		//Dark or Light
		if( $(".dar-light-sticky").length ){
			$(".dar-light-sticky .round-ball-switch").on( "click", function(e){
				e.preventDefault();
				$("body").toggleClass("dark-mode-activated");
			});
		}
		
	}); // window load end	

})( jQuery );


/* Hirxpert Masonry */
(function ( $ ) {

	"use strict";
	//Make sticky
	$.fn.hirxpert_stickypart = function( options ){

		//Sticky help functions
		var rcstickyhelp = {
			sticky_stat: function( st, header_top, sticky_outer, t_header_h ){
				if( st > lastScrollTop ){
					if( st > header_top ) $(sticky_outer).children('.sticky-head').addClass('header-sticky');
				}else{
					if( st > ( header_top - t_header_h ) ) $(sticky_outer).children('.sticky-head').addClass('header-sticky');
					else $(sticky_outer).children('.sticky-head').removeClass('header-sticky');
				}
			},
			sticky_scroll_stat: function( st, lastScrollTop, header_top, sticky_outer, t_header_h ){
				if( st > lastScrollTop ){
					$(sticky_outer).children('.sticky-head').addClass("hide-up");
				}else{
					if( st > ( header_top - t_header_h ) ){
						if( st > header_top ) $(sticky_outer).children('.sticky-head').addClass('header-sticky').removeClass("hide-up");
					}else{
						$(sticky_outer).children('.sticky-head').removeClass('header-sticky').removeClass("hide-up");					
					}
				}
			}
		}

		var sticky_outer = this;	
		var lastScrollTop = 0;
		var header_top, st = 0;
		var sticky_up = $(sticky_outer).data("stickyup");
		$(sticky_outer).css( 'height', 'auto' );
		$(sticky_outer).children('.sticky-head').removeClass('header-sticky');
		var t_header_h = $(sticky_outer).outerHeight();
		$(sticky_outer).css( 'height', t_header_h );
		header_top = $(sticky_outer).offset().top;
		header_top += t_header_h;	
		var win_width = $(window).width();	
		if( $("#wpadminbar").length && win_width > 600 ){
			t_header_h += $("#wpadminbar").outerHeight();
			$(sticky_outer).children('.sticky-head').css({ "top": $("#wpadminbar").outerHeight() });
		}else{
			$(sticky_outer).children('.sticky-head').css({ "top": 0 });
		}
		if( sticky_up ){ // Sticky on scroll up
			$(window).scroll(function(event){				
				st = $(this).scrollTop();
				rcstickyhelp.sticky_scroll_stat( st, lastScrollTop, header_top, sticky_outer, t_header_h );
				if( st == 0 ){
					$(sticky_outer).children('.sticky-head').removeClass('header-sticky');
				}
				lastScrollTop = st;
			});	
		}else{ // Sticky on scroll
			$(window).scroll(function(event){				
				st = $(this).scrollTop();
				rcstickyhelp.sticky_stat( st, header_top, sticky_outer, t_header_h );
				if( st == 0 ){
					$(sticky_outer).children('.sticky-head').removeClass('header-sticky');
				}
				lastScrollTop = st;
			});	
		}
	};
    

    //Hirxpert masonry
    $.fn.rcmasonry = function( options ) {
 		
 		//Masonry help functions
    	var rcmasonryhelp = {
			getbottom: function( json_arr, masonry_parent, cur_ele, $condition ) {
		        var ele_index = 0;
		        var ele_left = 0;
		        var ele_top = 0;
		        var tmp_val = 0;
		        $.each( json_arr, function( key, value ) {
		            if( tmp_val ){
		                if( $condition == 'lower' ){
		                    if( tmp_val > value ){
		                        tmp_val = ele_top = value;
		                        ele_index = parseInt(key);
		                    }
		                }else{
		                   if( tmp_val < value ){
		                        tmp_val = ele_top = value;
		                        ele_index = parseInt(key);
		                    } 
		                }
		            }else{
		                tmp_val = ele_top = value;
		                ele_index = parseInt(key);
		            }
		        });
		        var bottom_ele = $(masonry_parent).children("article").eq(ele_index);
		        ele_left = $(bottom_ele).data("left");
		        $(cur_ele).attr("data-left",ele_left);
		        return [ele_index, ele_top, ele_left, $(cur_ele).attr("id")];
		    },
		    reset: function (masonry_item){
		    	masonry_item.css({ 'position': 'relative', 'width': '100%', 'left': 'auto', 'right': 'auto', 'top': 'auto', 'margin-bottom': 'auto' });
		    }
		}

        // This is default options.
        var settings = $.extend({
            columns : 3,
            gutter  : 20
        }, options );

        var masonry_parent = this;
        var masonry_item = masonry_parent.children("article");
        var parent_width = masonry_parent.width();
        if( $(window).width() < 768 ) settings.columns = 1;

        //Reset masonry items
        //rcmasonryhelp.reset(masonry_item);

        if( settings.columns === 1 ){
        	masonry_item.css({ 'position': 'relative', 'width': '100%', 'left': 'auto', 'right': 'auto', 'top': 'auto', 'margin-bottom': settings.gutter });
        	return;
        }

        var net_width = Math.floor( ( parent_width - ( settings.gutter * ( settings.columns - 1 ) ) ) / settings.columns );
        masonry_item.css({ 'width': net_width +'px', 'position': 'absolute' });

        var masonry_left = 0;
        var masonry_parent_top = masonry_parent.offset().top;
        var masonry_ele_bottoms = {};
        var cur_item_bottom = 0;

        $(masonry_parent).children().each(function(index) {
            //Set left position
            var col_stat = ( index + 1 ) % settings.columns;
            if( index < settings.columns ){
                $(this).css({'left': masonry_left +'px'});
                $(this).attr("data-left", masonry_left);
                masonry_left += net_width + settings.gutter;                
                cur_item_bottom = $(this).outerHeight() + settings.gutter;
                masonry_ele_bottoms[index] = cur_item_bottom;
            }else{
                var lowest_arr = rcmasonryhelp.getbottom( masonry_ele_bottoms, masonry_parent, this, 'lower' );
                delete masonry_ele_bottoms[lowest_arr[0]];
                var lowest_top = lowest_arr[1];
                var lowest_left = lowest_arr[2];
                cur_item_bottom = lowest_top + $(this).outerHeight() + settings.gutter;
                masonry_ele_bottoms[index] = cur_item_bottom;
                $(this).css({'top': lowest_top +'px', 'left': lowest_left+'px'});
            }            
        });        

        var highest_bottom = rcmasonryhelp.getbottom( masonry_ele_bottoms, masonry_parent, this, 'higher' );
        $(this).css({'height': highest_bottom[1] +'px'});

        return this;
 
    };


	document.addEventListener('DOMContentLoaded', function () {
		const loginButton = $('.login-button');
		const popup = $('#login-popup');
		const closePopup = $('.close-popup');
		if( loginButton.length < 0 ) {
			loginButton.addEventListener('click', function () {
				popup.style.display = 'flex';
			});
		}
		if( closePopup.length < 0 ) {
			closePopup.addEventListener('click', function () {
				popup.style.display = 'none';
			});
		}
		if( popup.length < 0 ) {
			popup.addEventListener('click', function (e) {
				if (e.target === popup) {
					popup.style.display = 'none';
				}
			});
		}
	});
 
}( jQuery ));