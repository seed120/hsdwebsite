/*
 * Zozo woo base addon sctipts
 */ 

(function( $ ) {

	"use strict";
	
	var custom_uploader;
	var _chk_all = 1;
	
	$( document ).ready(function() {		
		
		if( $( ".cea-main-box a.cea-trigger-all-shortcodes" ).length ){
			$( ".cea-main-box a.cea-trigger-all-shortcodes" ).on( "click", function(){
				_chk_all = _chk_all ? 0 : 1;
				if( _chk_all ){
					$( "#cea-widgets .switch-checkbox" ).each(function( index ) {
						$(this).prop("checked", false).trigger("click");
					});
				}else{
					$( "#cea-widgets .switch-checkbox" ).each(function( index ) {
						$(this).prop("checked", true).trigger("click");
					});
				}
				return false;
			});
		}
		
		/* Custom Reqiured Field */
		if( $( ".cea-tab .field-set[data-required]" ).length ){
			$( ".cea-tab .field-set[data-required]" ).hide();
			$( ".cea-tab .field-set[data-required]" ).each(function( index ) {
				var hidden_ele = this;
				var req_field = '#'+ $(this).attr('data-required');
				req_field = $(req_field).find("select");
				var req_val = $(this).attr('data-required-value');
				var req_condition = $(this).attr('data-required-condition');
				var req_selected = $( req_field ).find(":selected").val();
				
				if( req_condition == '!=' ){
					if( req_selected != req_val ){
						$(hidden_ele).show();
					}else{
						if( $( hidden_ele ).find('select').length ){
							var t_val = $(hidden_ele).find('select').attr('id');
							$(hidden_ele).find('select').prop('selectedIndex',0);
							$(hidden_ele).parents('.cea-tab').find('.field-set').filter('[data-req="'+ t_val +'"]').hide();
						}
						$(hidden_ele).hide();
					}
				}else{
					if( req_selected == req_val ){
						$(hidden_ele).show();
					}else{
						if( $( hidden_ele ).find('select').length ){
							var t_val = $(hidden_ele).find('select').attr('id');
							$(hidden_ele).find('select').prop('selectedIndex',0);
							$(hidden_ele).parents('.cea-tab').find('.field-set').filter('[data-req="'+ t_val +'"]').hide();
						}
						$(hidden_ele).hide();
					}
				}
				
				if( req_condition == '!=' ){
					$( req_field ).change(function() {
						req_selected = $( this ).find(":selected").val();
						if( req_selected != req_val ){
							$(hidden_ele).show();
						}else{
							if( $( hidden_ele ).find('select').length ){
								var t_val = $(hidden_ele).find('select').attr('id');
								$(hidden_ele).find('select').prop('selectedIndex',0);
								$(hidden_ele).parents('.cea-tab').find('.field-set').filter('[data-req="'+ t_val +'"]').hide();
							}
							$(hidden_ele).hide();
						}
					});
				}else{
					$( req_field ).change(function() {
						req_selected = $( this ).find(":selected").val();
						if( req_selected == req_val ){
							$(hidden_ele).show();
						}else{
							if( $( hidden_ele ).find('select').length ){
								var t_val = $(hidden_ele).find('select').attr('id');
								$(hidden_ele).find('select').prop('selectedIndex',0);
								$(hidden_ele).parents('.cea-tab').find('.field-set').filter('[data-req="'+ t_val +'"]').hide();
							}
							$(hidden_ele).hide();
						}
					});
				}
				
			});
		}
		
		// Admin page tab
		if( $( ".cea-settings-tabs" ).length ){
			$( ".cea-settings-tabs .cea-tabs > li a" ).on( "click", function(){
				var _ele = $(this);
				var _target = _ele.attr("href");
				var _tab_parent = _ele.parents(".cea-settings-tabs");
				$(_tab_parent).find("ul.cea-tabs > li a, .cea-settings-tab").removeClass("active");
				_ele.addClass("active");
				$(_tab_parent).find(_target).addClass("active");
				return false;
			});
		}		
		
	});	
	
	$( window ).load(function() {
		if( $( ".admin-box-slide-wrap .owl-carousel" ).length ){
			$( ".admin-box-slide-wrap .owl-carousel" ).owlCarousel({
				loop: true,
				margin: 0,
				autoplay: true,
				autoplayTimeout: 4000,
				items: 1
			});
		}
	});
	
})( jQuery );