/*
 * Hirxpert Theme Options Script
 */ 

(function( $ ) {

	"use strict";
	var font_key = '';
			  
	$( document ).ready(function() {
		
		if( $("#hirxpert-plugin-form-wrapper").length ){
			var sticky_ele = $("#hirxpert-plugin-form-wrapper .hirxpert-header-right .button");
			var btn_x_offset = $(sticky_ele).offset().left;
			var pos_top = $(sticky_ele).offset().top;
			$(window).scroll(function() {
				var win_top = $(window).scrollTop();
				if( pos_top < win_top ) {
					$(sticky_ele).addClass( "option-btn-fixed" );
					$(sticky_ele).css({ 'left' : btn_x_offset + 'px' });
				} else {
					$(sticky_ele).removeClass( "option-btn-fixed" );
					$(sticky_ele).css({ 'left' : 'auto' });
				}
			});
		}		
				
		//Fonts
		if( $(document).find('.wp-font-family-field').length ){
			wp_customize_custom_js_function_trigger();
			var google_fonts = google_fonts_vars.google_fonts;
			var g_font_family = jQuery.parseJSON(google_fonts);
			$.each(g_font_family, function (key, data) {
				font_key += '<option data-google="1" value="'+ key +'">'+ key +'</option>';
			});
			//Set Google fonts and subsets
			$(document).find('.wp-font-family-field').each(function(){
				$(this).append(font_key);
				var data_val = $(this).attr("data-val");
				$(this).children('option[value="'+ data_val +'"]').attr("selected","selected");
				$(this).trigger("change");
			});
		}
		
		//WP Color Picker
		$( ".wp-font-color-field" ).wpColorPicker();
		
		//Background Field
		$('body').on( 'click', '.hirxpert-image-upload-field .bg-upload-image-button', function(e){ 
			var custom_uploader;
			e.preventDefault();	 
			
			if ( custom_uploader ) {
				custom_uploader.open();
				return;
			}
			
			var _button = $(this);
			custom_uploader = wp.media({
				title: 'Insert Image',
				library : {
					type : 'image'
				},
				_button: {
					text: 'Use this image' // button label text
				},
				multiple: false
			});
			
			custom_uploader.on('select', function() { // it also has "open" and "close" events
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				var _parent = $(_button).parents(".hirxpert-image-upload-field");
				$(_parent).find(".hirxpert-img-id").val(attachment.id);
				$(_parent).find(".hirxpert-img-url").val(attachment.url);
				$(_parent).find(".img-place").html('<img src="'+ attachment.url +'" class="hirxpert-bg-img"/>');
			});
			
			custom_uploader.on('open', function() {
				var _parent = $(_button).parents(".hirxpert-image-upload-field");
				var _sel_media = $(_parent).find(".hirxpert-img-id").val();				
				var selection = custom_uploader.state().get('selection');
				var imgIDs = _sel_media.split(',');
				if( imgIDs && imgIDs.length ){
					$.each( imgIDs, function( idx, val ){
						var attachment = wp.media.attachment(val);
						attachment.fetch();
						selection.add( attachment ? [ attachment ] : [] );
					});
				}
			});
			custom_uploader.open();
		});
			
		
		$('body').on( 'click', '.hirxpert-image-upload-field .bg-remove-image-button', function(e){ 
			e.preventDefault();	 
			var _button = $(this);
			var _parent = $(_button).parents(".hirxpert-image-upload-field");
			$(_parent).find(".hirxpert-img-id").val('');
			$(_parent).find(".hirxpert-img-url").val('');
			$(_parent).find(".img-place").html('');
		});

		//New code
		if( $(document).find(".meta-drag-drop-multi-field").length ){
			customizer_drag_drop_settings();
		}

		if( $(document).find(".meta-drag-drop-multi-field-header-items").length ){
			customizer_drag_drop_editor_settings();
		}
				
		if( $(".wp-radio-image-list").length ){
			$('body').on( 'click', '.wp-radio-image-list input[type="radio"]', function(e){ 
				$(this).parents(".radio-image-wrap").find(".hirxpert-control-hidden-val").val($(this).val());
				customizer_required_settings();
			});
		}	
		
		if( $(".hirxpert-switch").length ){
			$('body').on( 'change', '.hirxpert-switch input[type="checkbox"]', function(e){ 
				var sel_val = $(this).is(":checked") ? 1 : 0;
				$(this).parents(".checkbox_switch").find(".hirxpert-control-hidden-val").val(sel_val);
				customizer_required_settings();
			});
		}

		if( $(".hirxpert-customizer-select-field").length ){
			$('body').on( 'change', '.hirxpert-customizer-select-field', function(e){ 
				customizer_required_settings();
			});
		}

		if( $("#customize-import-custom-btn").length ){
			$( document ).on( "click", "#customize-import-custom-btn", function( e ) {
				e.preventDefault();
				if ( $( '#customize-import-value-box' ).val() === "" ) {					
					return false;
				}else{
					$( '#customize-import-custom-btn' ).attr( "disabled", "disabled" );
					var json_data = '';
					var stat = '';
					if( $( '#customize-import-value-box' ).val() != "" ){
						json_data = $( '#customize-import-value-box' ).val();
						stat = 'data';
					}
					var post_data = { action: "bridddge-theme-option-import", nonce: hirxpert_ajax_object.import_nonce, json_data : json_data };
					jQuery.post(ajaxurl, post_data, function( response ) {
						location.reload(true);
						$( '#customize-import-custom-btn' ).removeAttr( "disabled" );
					});					
					return false;
				}
			});
		}

		if( $("#customize-export-custom-btn").length ){
			$( document ).on( "click", "#customize-export-custom-btn", function( e ) {
				$( '#customize-export-custom-btn' ).attr( "disabled", "disabled" );				
				$.ajax({
					type: "post",
					url: ajaxurl,
					data: "action=hirxpert-theme-options-export&nonce="+hirxpert_ajax_object.export_nonce,
					success: function( data ){
						
						$("<a />", {
							"download": "theme-options.json",
							"href" : "data:application/json," + encodeURIComponent( data )
						}).appendTo("body").on( "click", function() {
							$(this).remove();
						})[0]. click();
						
						$( '#customize-export-custom-btn' ).removeAttr( "disabled" );
						
					}
				});
				return false;
			});
		}
		
	});
	
	$( window ).load(function() {
	
		if( $(".hirxpert-tab").length ){
			
			var hirxpert_tab = $( ".hirxpert-tab" );

			hirxpert_tab.find(".tablinks-sub-list > .tablinks").on("click", function() {
				
				let cur_ele = $(this);
								
				var last_tab = ''; 
				if( $(".hirxpert_page_hirxpert-options").length  ){
					last_tab = hirxpert_get_cookie("hirxpert_admin_tab");					
				}else{
					last_tab = hirxpert_get_cookie("hirxpert_singular_admin_tab");
				}
				if( !last_tab ) last_tab = 'site-general-settings';
				
				$('li.tablinks[data-id="'+ last_tab +'"]').removeClass("active");
				$('li.tablinks[data-id="'+ last_tab +'"]').parents(".tablinks").removeClass("active");
				$('li.tablinks[data-id="'+ cur_ele.attr("data-id") +'"]').addClass("active");
				$('li.tablinks[data-id="'+ cur_ele.attr("data-id") +'"]').parents(".tablinks").addClass("active");
				
				$('li.tablinks[data-id="'+ last_tab +'"]').removeClass("active");
				$('li.tablinks[data-id="'+ cur_ele.attr("data-id") +'"]').addClass("active");

				$( '#' + last_tab ).fadeOut(0);
				$( '#' + cur_ele.attr("data-id") ).fadeIn(200);
				customizer_required_settings_specific( '#' + cur_ele.attr("data-id") );
				
				if( $(".hirxpert_page_hirxpert-options").length ){
					hirxpert_set_cookie( "hirxpert_admin_tab", cur_ele.attr("data-id"), 1 );					
				}else{
					hirxpert_set_cookie( "hirxpert_singular_admin_tab", cur_ele.attr("data-id"), 1 );
				}
			});
			hirxpert_tab.find(".tablinks-list > .tablinks > .tab-title").on( "click", function() {
				$(this).next("ul").find("li:first-child").trigger("click");
			});	
				
			// Auto trigger at first
			var last_tab = ''; 
			if( $(".hirxpert_page_hirxpert-options").length ){
				last_tab = hirxpert_get_cookie("hirxpert_admin_tab");
			}else{				
				last_tab = hirxpert_get_cookie("hirxpert_singular_admin_tab");
			}
			if( last_tab ){
				$('.hirxpert-tab-list li.tablinks[data-id="'+ last_tab +'"]').trigger("click");
			}else{
				$('ul.tablinks-list > li.tablinks:first-child > .tablinks-sub-list > li:first-child').trigger("click");
			}
			
		}
		
	});
	
	//Customizer custom fields functions
	function wp_customize_custom_js_function_trigger(){
		//Fonts Settings
		customizer_fonts_settings();		
	}
	
	function customizer_fonts_settings(){
		//Select fonts settings
		$(document).find( "select.wp-font-field" ).change( function() {
			var cur_val = $(this).val();
			
			if( $(this).hasClass("wp-font-family-field") ){
				if( $('option:selected', this).attr("data-google") ){
					var gl_font_variants = jQuery.parseJSON( google_fonts_vars.google_fonts );
					var gl_font_var_out = '<option value="">'+ google_fonts_vars.font_variants_default +'</option>';
					$.each(gl_font_variants[cur_val].variants, function (key, data) {
						gl_font_var_out += '<option value="'+ data.id +'">'+ data.name +'</option>';
					});
					var cur_child_ele = $(this).parents(".wp-fonts-fields-list").find(".wp-font-weight-field");
					$(cur_child_ele).html(gl_font_var_out);
					var g_font_weight = $(cur_child_ele).attr("data-val");
					$(cur_child_ele).children('option[value="'+ g_font_weight +'"]').attr("selected","selected");
					
					var gl_font_sub_out = '<option value="">'+ google_fonts_vars.font_sub_default +'</option>';
					$.each(gl_font_variants[cur_val].subsets, function (key, data) {
						gl_font_sub_out += '<option value="'+ data.id +'">'+ data.name +'</option>';
					});
					var cur_child_ele = $(this).parents(".wp-fonts-fields-list").find(".wp-font-sub-field");
					cur_child_ele.html(gl_font_sub_out);
					var g_font_sub = cur_child_ele.attr("data-val");
					cur_child_ele.children('option[value="'+ g_font_sub +'"]').attr("selected","selected");
				}else{
					var std_font_variants = jQuery.parseJSON( google_fonts_vars.standard_font_variants );
					var std_font_var_out = '<option value="">'+ google_fonts_vars.font_variants_default +'</option>';
					$.each(std_font_variants.variants, function (key, data) {
						std_font_var_out += '<option value="'+ data.id +'">'+ data.name +'</option>';
					});
					var cur_child_ele = $(this).parents(".wp-fonts-fields-list").find(".wp-font-weight-field");
					cur_child_ele.html(std_font_var_out);
					var std_font_weight = cur_child_ele.attr("data-val");
					cur_child_ele.children('option[value="'+ std_font_weight +'"]').attr("selected","selected");
					var std_font_sub_out = '<option value="">'+ google_fonts_vars.font_sub_default +'</option>';
					$.each(std_font_variants.subsets, function (key, data) {
						std_font_sub_out += '<option value="'+ data.id +'">'+ data.name +'</option>';
					});
					cur_child_ele = $(this).parents(".wp-fonts-fields-list").find(".wp-font-sub-field");
					cur_child_ele.html(std_font_sub_out);
					var std_font_sub = cur_child_ele.attr("data-val");
					cur_child_ele.children('option[value="'+ std_font_sub +'"]').attr("selected","selected");
				}
			}
		});
	}
	
	function customizer_fonts_set_values(cur_parent, cur_ele){
		var item = {};
		$( cur_parent ).find(".wp-font-field").each(function( index ) {
			var data_selct = $(this).attr("data-selector");
			var data_val = $(this).attr("data-val") ? $(this).attr("data-val") : '';
			item[data_selct] = data_val;
		});
		jsonString = JSON.stringify(item);
		$(cur_parent).prev(".fonts-hid-text").val(jsonString);	
	}


	function customizer_drag_drop_editor_settings() {
		jQuery( document ).ready(function($) {
			$(".hirxpert-dd-items").sortable("refresh");
		});
	
		$(".meta-drag-drop-multi-field-header-items .field-values").each(function () {
			var key = $(this).data("key"); 
			$(this).find(".hirxpert-dd-items").sortable({
				connectWith: ".hirxpert-dd-items",
				receive: function (event, ui) {
					var _ele = ui.item;
					var _sender = ui.sender;
					var _name = $(_ele).find("input.dd-input").attr("name");
					var _part_to = $(this).attr("data-part");
					var _part_from = $(_sender).attr("data-part");
					if (_name) {
						var _ele_name = _name.replace(_part_from, _part_to);
						$(_ele).find("input.dd-input").attr("name", _ele_name);
						console.log( _ele_name );
					} else {
						console.log("Error: Name attribute missing on dragged element.");
					}
				}
				
			});
		});
		if ($(".meta-drag-drop-multi-field-header-items .field-values .hirxpert-dd-items .drag-drop-custom-value").length) {
			$(".meta-drag-drop-multi-field-header-items .field-values .hirxpert-dd-items > li > i").on("click", function() {
				if ($(this).next(".drag-drop-custom-value").hasClass("active")) {
					$(this).next(".drag-drop-custom-value").toggleClass("active");
				}else{
					$(this).parents(".hirxpert-dd-items").find(".drag-drop-custom-value").removeClass("active");
					$(this).next(".drag-drop-custom-value").addClass("active");
					$(this).next(".drag-drop-custom-value").children("input").focus();
				}
			});
		}
		$(document).on('click', '.ui-sortable-handle', function () {
			var itemId = $(this).data('id');
			var $hirxpertControl = $(this).closest('.hirxpert-control');
			var modal = $hirxpertControl.find('#modal-' + itemId);
		
			$hirxpertControl.find('.dragdrop-editor-modal').hide();
		
			if (modal.length) {
				modal.show();
				$('#wpwrap').removeClass('overlay-active');
				$hirxpertControl.closest('#wpwrap').addClass('overlay-active');
			}
		});
		
		$(document).on('click', '.ui-sortable-handler', function () {
			console.log( "clicked");
			var itemId = $(this).data('id');
			var $hirxpertControl = $(this).closest('.hirxpert-control');
			var modal = $hirxpertControl.find('#modal-' + itemId);
		
			console.log("Item ID: " + itemId);
			console.log("Show popup");
			$hirxpertControl.find('.dragdrop-editor-modal').hide();
		
			if (modal.length) {
				console.log( "Show popup" );
				modal.show();
			}
		});
		$('.meta-drag-drop-multi-field-header-items .editable-icon').on('click', function (e) {
			e.stopPropagation();
			var $parentItem = $(this).closest('.dd-item');
			var modalId = $parentItem.data('id');
			var $hirxpertControl = $parentItem.closest('.hirxpert-control');
			var modal = $hirxpertControl.find('#modal-' + modalId);
		
			if (modal.length) {
				$parentItem.addClass('editing');
				modal.show();
				$('#wpwrap').removeClass('overlay-active');
				$hirxpertControl.closest('#wpwrap').addClass('overlay-active');
			}
		});
		

		$(document).on('click', '.close-modal-button', function () {
			$(this).closest('.dragdrop-editor-modal').hide();
			$('.dd-item.editing').removeClass('editing');
		});

		$('.save-dragdrop-item').on('click', function () {
			$(this).closest('.dragdrop-editor-modal').hide();
			$('.dd-item.editing').removeClass('editing');
			$('#wpwrap').removeClass('overlay-active');
		});
	}

	function customizer_drag_drop_settings(){
		
		$(document).find( ".meta-drag-drop-multi-field" ).each(function() { 
			
			var cur_items = $(this).children( ".hirxpert-dd-items" );
			var dd_parent = $( this );
			var auth = $(this).children( ".hirxpert-dd-items" );
			var final_val = $( this ).parent('.wp-drag-drop-fields').prev( ".hirxpert-customizer-ajax-hid-wrap" );
			
			$( cur_items ).each(function() {
				$( this ).sortable({
				  connectWith: auth,
				  receive: function (event, ui) {
					  var _ele = ui.item;
					  var _sender = ui.sender;
					  var _name = $(_ele).find("input.dd-input").attr("name");
					  var _part_to = $(this).attr("data-part");
					  var _part_from = $(_sender).attr("data-part");
					  var _ele_name = _name.replace( _part_from, _part_to );
					  $(_ele).find("input.dd-input").attr("name", _ele_name);
				  }
				});
			});
			
		}); //ul.meta-items each end

		if( $(document).find( ".meta-drag-drop-multi-field .hirxpert-dd-items .drag-drop-custom-value" ).length ){
			$(document).find( ".meta-drag-drop-multi-field .hirxpert-dd-items > li > i" ).on("click", function(){
				if( $(this).next(".drag-drop-custom-value").hasClass("active")){
					$(this).next(".drag-drop-custom-value").toggleClass("active");
				}else{
					$(this).parents(".hirxpert-dd-items").find(".drag-drop-custom-value").removeClass("active");
					$(this).next(".drag-drop-custom-value").addClass("active");
					$(this).next(".drag-drop-custom-value").children("input").focus();
				}				
			});
		}
		$(document).on('click', '.ui-sortable-handle', function(){
			var itemId = $(this).data('id');
			var modal = $(this).closest('.hirxpert-control').find('#modal-' + itemId);
			$(this).closest('.hirxpert-control').find('.dragdrop-editor-modal').hide();
			modal.show();
		});
		
		$(document).on('click', '.close-modal-button', function(){
			$(this).closest('.dragdrop-editor-modal').hide();
		});

		$('.save-dragdrop-item').on('click', function(){
			var modal = $(this).closest('.dragdrop-editor-modal');
			modal.hide();
		});
	}
	
	// New required code start
	function customizer_required_settings(){	
		var find_ele = '.hirxpert-control.hirxpert-customize-required';
		var req_parent = $(document).find('.tabcontent');
		
		if( $(req_parent).find(find_ele).length ){
			$(req_parent).find(find_ele).each(function( index ) {
				hirxpert_check_required( $(this) );
			});
		}
	}

	function customizer_required_settings_specific( req_parent ){	
		var find_ele = '.hirxpert-control.hirxpert-customize-required';
		$(req_parent).find(find_ele).each(function( index ) {
			hirxpert_check_required( $(this) );
		});
	}
	
	function hirxpert_check_required( ele ){
		var req_parent_id = $(ele).attr("data-required");
		//var data_id = $(ele).attr("data-id");
		if( $('.hirxpert-control[data-id="'+ req_parent_id +'"]').attr("data-stat") == "0" ){
			$(ele).attr("data-stat", "0");
			$(ele).fadeOut(0);
		}else{
			var req_parent = $('.hirxpert-control[data-id="'+ req_parent_id +'"]');
			var sel_val = hirxpert_get_parent_sel_val( req_parent );
			hirxpert_show_hide_customizer_fields( sel_val, ele );
		}		
	}
	function hirxpert_get_parent_sel_val( req_parent ){
		var field_type = $(req_parent).attr('data-field-type');
		var sel_val = '';
		if( field_type == 'checkbox' ){
			sel_val = $(req_parent).find(".hirxpert-control-hidden-val").val() == '1' ? 'true' : 'false';
		}else if( field_type == 'select' ){
			sel_val = $(req_parent).find('select.hirxpert-customizer-select-field').val();
		}else if( field_type == 'radio-image' ){
			sel_val = $(req_parent).find('.hirxpert-control-hidden-val').val();
		}
		return sel_val;
	}
	function hirxpert_show_hide_customizer_fields( sel_val, field ){
		var req_val = $(field).attr("data-required-val");
		var req_cond = $(field).attr("data-required-cond");
		
		if( req_cond == '=' ){
			if( sel_val ){
				var req_val_arr = req_val.split(",");
				if( req_val_arr.indexOf( sel_val ) != -1 ){
					$(field).fadeIn(0); $(field).attr("data-stat", "1");
				}else{
					$(field).fadeOut(0); $(field).attr("data-stat", "0");
				}				
			}			
		}else if( req_cond == '!=' ){
			if( sel_val != req_val ){
				$(field).fadeIn(0); $(field).attr("data-stat", "1");
			}else{
				$(field).fadeOut(0); $(field).attr("data-stat", "0");
			}
		}
	}
	function hirxpert_get_cookie(cname) {
		let name = cname + "=";
		let decodedCookie = decodeURIComponent(document.cookie);
		let ca = decodedCookie.split(';');
		for(let i = 0; i <ca.length; i++) {
			let c = ca[i];
			while (c.charAt(0) == ' ') {
				c = c.substring(1);
			}
			if (c.indexOf(name) == 0) {
				return c.substring(name.length, c.length);
			}
		}
		return "";
	}	
	function hirxpert_set_cookie(cname, cvalue, exdays) {
		const d = new Date();
		d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
		let expires = "expires="+d.toUTCString();
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	
	jQuery(document).ready(function($) {
		$('a.nav-link.scrollto').on('click', function(event) {
			event.preventDefault();
	
			var target = $(this.getAttribute('href'));
			if (target.length) {
				$('html, body').stop().animate({
					scrollTop: target.offset().top
				}, 1000);
			}
		});
	});	

	jQuery(document).ready(function($) {
        $('.edit-dragdrop-item').on('click', function() {
            var itemId = $(this).data('id');
            $('#dragdrop-popup').show();
        });
        $('.close-popup').on('click', function() {
            $('#dragdrop-popup').hide();
        });
        $('#save-dragdrop-item').on('click', function() {
            var customText = $('#custom-text').val();
            var customToggle = $('#custom-toggle').is(':checked') ? 1 : 0;
            $('#dragdrop-popup').hide();
        });
    });
	
	jQuery(document).ready(function($) {
		$('#header-items .dragdrop-enabled').on('sortstop', function(event, ui) {
			let isTopbarEnabled = $('#header-items-enabled').find('[data-id="topbar"]').length > 0;
			
			if (isTopbarEnabled) {
				$('#header-field-items .topbar-fields').show();
			} else {
				$('#header-field-items .topbar-fields').hide();
			}
		});
	});

	document.addEventListener("DOMContentLoaded", function() {
		document.querySelectorAll('.popup-trigger').forEach(function(button) {
			button.addEventListener('click', function() {
				const popupId = this.getAttribute('data-popup-id');
				document.getElementById(popupId).style.display = 'block';
			});
		});
	
		document.querySelectorAll('.hirxpert-popup-close').forEach(function(closeBtn) {
			closeBtn.addEventListener('click', function() {
				this.closest('.hirxpert-popup-modal').style.display = 'none';
			});
		});
	});

	document.addEventListener('DOMContentLoaded', function () {
		document.querySelectorAll('.edit-icon').forEach(function (editIcon) {
			editIcon.addEventListener('click', function () {
				const modalId = this.getAttribute('data-toggle-id');
				const modal = document.getElementById(modalId);
				if (modal) {
					modal.style.display = 'block';
					this.closest('#wpwrap').classList.add('overlay-active');
				}
			});
		});
 
		document.querySelectorAll('.close-modal-button').forEach(function (button) {
			button.addEventListener('click', function () {
				this.closest('.dragdrop-editor-modal').style.display = 'none';
				this.closest('#wpwrap').classList.remove('overlay-active');
			});
		});

		document.querySelectorAll('.save-modal-item').forEach(function (saveButton) {
			saveButton.addEventListener('click', function () {
				const modal = this.closest('.dragdrop-editor-modal');
				const fieldData = {};
				modal.querySelectorAll('.field-wrapper input').forEach(function (input) {
					fieldData[input.getAttribute('data-field-id')] = input.value;
				});
				modal.style.display = 'none';
				this.closest('#wpwrap').classList.remove('overlay-active');
			});
		});
	});

	jQuery(document).ready(function ($) {
		$('.open-icon-picker').on('click', function () {
			const iconModal = $('<div class="icon-modal"><div class="icon-list"></div><button class="close-modal">X</button></div>');
			$('body').append(iconModal);
	
			const iconList = iconModal.find('.icon-list');
			let selectedIconClass = ''; 
	
			function addIcons(classes) {
				classes.forEach(iconClass => {
					iconList.append(`<i class="${iconClass}"></i>`);
				});
	
				iconList.find('i').on('click', function () {
					selectedIconClass = $(this).attr('class');
					const $picker = $('.hirxpert-icon-picker');
					$picker.find('.icon-preview').html(`<i class="${selectedIconClass}"></i>`);
					$picker.find('.icon-input').val(selectedIconClass);
					$picker.find('.save-icon, .remove-icon').show();
				});
			}
	
			function getBootstrapIconClasses() {
				const iconClasses = [];
				for (const sheet of document.styleSheets) {
					try {
						for (const rule of sheet.cssRules) {
							if (rule.selectorText) {
								const match = rule.selectorText.match(/\.bi-[\w-]+/);
								if (match) {
									iconClasses.push(match[0].substring(1));
								}
							}
						}
					} catch (e) {
						console.warn("Could not read some CSS rules due to cross-origin restrictions");
					}
				}
				return iconClasses;
			}
	
			const icons = getBootstrapIconClasses();
			addIcons(icons);
	
			$('.close-modal').on('click', function () {
				iconModal.remove();
			});
	
			$('.save-icon').on('click', function () {
				const iconClass = $('.icon-input').val();
	
				$.ajax({
					url: ajaxurl,
					type: 'POST',
					data: {
						action: 'save_hirxpert_icon',
						icon_class: iconClass,
						field_id: '<?php echo $config['+id+']; ?>'
					},
					success: function (response) {
						iconModal.remove();
					},
					error: function () {
						console.error('Failed to save icon');
					}
				});
			});
	
			$('.remove-icon').on('click', function () {
				const $picker = $(this).closest('.hirxpert-icon-picker');
				$picker.find('.icon-preview').html('<span class="no-icon">No icon selected</span>');
				$picker.find('.icon-input').val('');
				$(this).hide(); 
				$picker.find('.save-icon').hide(); 
			});
		});
	});

	document.querySelectorAll('.drag-drop-item').forEach(item => {
		if (item.dataset.editable === 'true') {
			item.classList.add('highlight-editable');
		} else {
			item.classList.add('');
		}
	});

})( jQuery );
