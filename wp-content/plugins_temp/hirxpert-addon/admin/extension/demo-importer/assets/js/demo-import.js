/*
 * Admin Screen
 * 
 */

( function( $ ) {
	"use strict";
	
	var general_arr = [];
	var post_arr = []; // removed default value ['wp-things']
	var page_arr = [];
	var progres_range = 0;
	var progress_percent = 0;
	var menu_stat = 0;
	var total_pages = 0;
	var page_txt_arr = [];
	var general_txt_arr = [];
	var media_parts = 0;
		
	$(document).on( 'click', '.theme-demo-install-checkall', function(e) {
		e.preventDefault();
		var uncheck_stat = false;
		uncheck_stat = $(this).hasClass("theme-demo-install-uncheckall") ? true : false;
		$(this).toggleClass("theme-demo-install-uncheckall");
		
		var chk_parent = $(this).parents(".theme-demo-install-parts");
		$( chk_parent ).find('input[type="checkbox"]').each(function( index ) {
			if( uncheck_stat ){
				$(this).removeAttr( "checked" );
			}else{
				$(this).attr( "checked", "checked" );
			}
		});

	});

	$(document).on( 'click', '.theme-demo-install-custom', function(e) {
		e.preventDefault();
		$(this).next(".theme-demo-install-parts").slideToggle(500);
	});
	
	$(document).on( 'click', '.button-uninstall-demo', function(e) {
		
		var current	= this;
		
		$.confirm({
			theme: 'supervan',
			title: false,
			content: hirxpert_admin_ajax_var.unins_confirm,
			confirmButtonClass: 'btn-success',
			cancelButtonClass: 'btn-danger',
			confirmButton: 'Uninstall',//hirxpert_admin_ajax_var.yes,
   			cancelButton: hirxpert_admin_ajax_var.no,
			confirm: function(){
				
				var choosed_demo = $(current).data('demo-id');
				var loading_wrap = $('.zozo-preview-' + choosed_demo);
				var progress = $(current).parents('.zozothemes-demo-item').find('.installation-progress .progress');
				progress.find(".progress-bar").css('width', '1%');
				$(progress).prev(".progress-text").text(hirxpert_admin_ajax_var.uninstalling + '..');
				loading_wrap.show();
				
				//Delete Attachments
				$.ajax({
					xhr: function() {
						var xhr = new window.XMLHttpRequest();
						xhr.upload.addEventListener("progress", function(evt) {
							if (evt.lengthComputable) {
								var percentComplete = evt.loaded / evt.total;
								percentComplete = parseInt(percentComplete * 100);
								progress.find(".progress-bar").css('width', Number( percentComplete ) +'%');
							}
						}, false);
						return xhr;
					},
					type: 'POST',
					url: ajaxurl,
					data: {
						action: 'hirxpert_demo_import',
						process: 'uninstall',
						nonce:  $("#hirxpert_demo_import_nonce").val()
					},
					success: function(response){
						if( response && response.indexOf('success') == -1 ) {
							loading_wrap.hide();
							progress.parent(".installation-progress").hide();
							alert(response);
						}else{
							$('.zozothemes-demo-item').removeClass('demo-actived demo-inactive'); //.addClass('demo-active');
							loading_wrap.hide();
							progress.parent(".installation-progress").hide();
							progress_text.text(hirxpert_admin_ajax_var.uninstalled);
							window.location = location.href;
						}
					},
					error: function(response, errorThrown){
						loading_wrap.hide();
						progress.parent(".installation-progress").hide();
						alert(hirxpert_admin_ajax_var.unins_pbm);
					}
				});
			}
		});

		return false;
	});

	var zozo_admin_screen = {

		install_demos: function() {
			$(document).on( 'click', '.button-install-demo', function(e) {
				
				e.preventDefault();
				var current			= this;
				
				var progress = $(current).parents('.zozothemes-demo-item').find('.installation-progress .progress');
				var progress_text = $(current).parents('.zozothemes-demo-item').find('.installation-progress p');
				var choosed_demo 	= $(this).data('demo-id');
				var loading_wrap 	= $('.zozo-preview-' + choosed_demo);
				var requirement 	= $('.theme-requirements').data('requirements');
				var revslider = $(this).data('revslider');
				media_parts = $(this).data('media');
				
				var inner_wrap = $(loading_wrap).parent(".install-plugin-inner");
				$(inner_wrap).find(".theme-demo-install-parts").slideUp();
				var inner_wrap_offset = $(inner_wrap).offset();
				$( 'html,body' ).animate({ scrollTop: inner_wrap_offset.top - 50 }, 300);	
				
				var empty_stat = 0;
				$( "#demo-install-parts-" + choosed_demo ).find('input[type="checkbox"]').each(function( index ) {
					if( $(this). prop("checked") == true ){
						empty_stat = 1;
					}
				});
				
				if( !empty_stat ){
					$( "#demo-install-parts-" + choosed_demo ).find('input[type="checkbox"]').each(function( index ) {
						$(this).attr( "checked", "checked" );
					});
				}
				
				$( "#demo-install-parts-" + choosed_demo + " .general-install-parts-list"  ).find('input[type="checkbox"]').each(function( index ) {
					if( $(this).prop("checked") == true ){
						general_arr.push(this.value);
						general_txt_arr.push( $(this).data("text") );
					}
				});

				$( "#demo-install-parts-" + choosed_demo + " .page-install-parts-list"  ).find('input[type="checkbox"]').each(function( index ) {
					if( $(this). prop("checked") == true ){
						page_arr.push(this.value);
						page_txt_arr.push( $(this).data("text") );
					}
					total_pages++;
				});
				
				if( page_arr.length == total_pages && page_arr.length != 0 ) menu_stat = 1;
				
				var general_arr_stat = general_arr.length ? general_arr.join() : '';
				var post_arr_stat = post_arr.length ? post_arr.join() : '';
				var page_arr_stat = page_arr.length ? page_arr.join() : '';
				
				if( choosed_demo !== null ) {
					
					$.confirm({
						theme: 'supervan',
						title: false,
						content: requirement,
						columnClass: 'col-6',
						confirmButtonClass: 'btn-success',
    					cancelButtonClass: 'btn-danger',
						confirmButton: hirxpert_admin_ajax_var.proceed,
   						cancelButton: hirxpert_admin_ajax_var.cancel,
						confirm: function(){
		
							$(current).parents('.zozothemes-demo-item').find('.installation-progress').fadeIn(300);
							progress.css('opacity', '1');
							
							progress_percent = general_arr.length + post_arr.length + page_arr.length;
							progress_percent = progress_percent ? 100/ ( progress_percent * 2 ) : 1;
							
							loading_wrap.show();
							$(current).parents('.zozothemes-demo-item').find('.installation-progress p').text(hirxpert_admin_ajax_var.downloading);
							$('.zozo-importer-notice').hide();
						
							// Demo Files Download
							hirxpert_check_file_access_permission( choosed_demo, revslider, progress );
															
						},
						cancel: function(){}
					});
					
				}
				
			});
		},
		
	};
	
	function hirxpert_progress_update( progress ){
		progres_range = Number( progres_range ) + Number( progress_percent );
		progres_range = progres_range >= 100 ? 100 : progres_range;
		progress.children(".progress-bar").css("width", progres_range + "%").attr("aria-valuenow", progres_range);
	}
	
	function hirxpert_progress_end( choosed_demo, progress ){
		$('.zozo-preview-' + choosed_demo).hide();
		progress.parent(".installation-progress").hide();
		$.confirm({
			theme: 'supervan',
			title: false,
			content: 'File access permission issue. Please check your ftp permission and try to install again.',
			confirmButtonClass: 'btn-success',
			cancelButtonClass: 'btn-danger',
			confirmButton: 'Ok',
			cancelButton: 'Close',
			confirm: function(){ window.location = hirxpert_admin_ajax_var.hirxpert_import_url; }
		});
	}
	
	function hirxpert_progress_details( progress, msg, stat ){
		var stat_class = stat == 'failed' ? ' class="failed-import"' : '';
		var parent_prog = progress.parents( ".install-plugin-inner" ).find(".zozotheme-screenshot");
		$(progress).prev(".progress-text").text(msg + '..');
	}
	
	function hirxpert_check_file_access_permission( choosed_demo, revslider, progress ){
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: ajaxurl,
			data: {
				action: 'hirxpert_demo_import',
				process: 'permission',
				nonce:  $("#hirxpert_demo_import_nonce").val()
			},
			success: function(response){
				if( response['msg'] == 'failed' ) {
					 
					hirxpert_progress_details( progress, response['msg'], '' );
					hirxpert_progress_end( choosed_demo, progress );					
				}else{
					hirxpert_general_file_download_function( 0, choosed_demo, revslider, progress );
				}
			},
			error: function(response, errorThrown){
				 
				hirxpert_progress_details( progress, response['msg'], 'failed' );
				hirxpert_progress_end( choosed_demo, progress );
			}
		});//ajax end		
	}
	
	function hirxpert_general_file_download_function( index, choosed_demo, revslider, progress ){
		var max_len = general_arr.length;

		if( max_len > index ){
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: ajaxurl,
				data: {
					action: 'hirxpert_demo_import',
					process: 'general_download',
					nonce:  $("#hirxpert_demo_import_nonce").val(),
					demo_type: choosed_demo,
					revslider: revslider,
					key: general_arr[index],
					menu_stat: menu_stat,
					label: general_txt_arr[index],
					media_parts: media_parts
				},
				success: function(response){
					if( response['msg'] == 'failed' ) {
						 
						hirxpert_progress_details( progress, response['msg'], 'failed' );
					}else{
						 
						hirxpert_progress_details( progress, response['msg'], '' );
						index += 1;
					}
					if( max_len > index ){
						hirxpert_general_file_download_function( index, choosed_demo, revslider, progress );
					}else{
						hirxpert_page_file_download_function( 0, choosed_demo, revslider, progress );
					}
					hirxpert_progress_update( progress );
				},
				error: function(response, errorThrown){
					hirxpert_progress_details( progress, response['msg'], 'failed' );
					index += 1;
					if( max_len > index ){
						hirxpert_general_file_download_function( index, choosed_demo, revslider, progress );
					}else{
						hirxpert_page_file_download_function( 0, choosed_demo, revslider, progress );
					}
					hirxpert_progress_update( progress );
				}
			});//ajax end
		}
		
		if( max_len == 0 ){
			hirxpert_page_file_download_function( 0, choosed_demo, revslider, progress );
		}
		
	}
	
	function hirxpert_page_file_download_function( index, choosed_demo, revslider, progress ){
		var max_len = page_arr.length;
		if( max_len > index ){
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: ajaxurl,
				data: {
					action: 'hirxpert_demo_import',
					process: 'xml_download',
					nonce:  $("#hirxpert_demo_import_nonce").val(),
					demo_type: choosed_demo,
					revslider: revslider,
					key: page_arr[index],
					part: 'pages',
					label: page_txt_arr[index]
				},
				success: function(response){
					if(  response['msg'] == 'failed' ) {
						 
						hirxpert_progress_details( progress, response['msg'], 'failed' );
					}else{
						 
						hirxpert_progress_details( progress, response['msg'], '' );
						index += 1;
					}
					if( max_len > index ){
						hirxpert_page_file_download_function( index, choosed_demo, revslider, progress );
					}else{
						hirxpert_general_file_install_function( 0, choosed_demo, revslider, progress );
					}
					hirxpert_progress_update( progress );
				},
				error: function(response, errorThrown){
					hirxpert_progress_details( progress, response['msg'], 'failed' );
					index += 1;
					if( max_len > index ){
						hirxpert_page_file_download_function( index, choosed_demo, revslider, progress );
					}else{
						hirxpert_general_file_install_function( 0, choosed_demo, revslider, progress );
					}
					hirxpert_progress_update( progress );
				}
			});//ajax end
		}
		
		if( max_len == 0 ){
			hirxpert_general_file_install_function( index, choosed_demo, revslider, progress );
		}
		
	}
	
	function hirxpert_general_media_install_function( index, choosed_demo, revslider, progress, parent_index ){
		var max_len = media_parts;
		if( max_len > index ){
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: ajaxurl,
				data: {
					action: 'hirxpert_demo_import',
					process: 'general_install',
					nonce:  $("#hirxpert_demo_import_nonce").val(),
					demo_type: choosed_demo,
					key: 'media',
					inner_key: 'media-' + parseInt( index + 1 ),
					inner_index: parseInt( index + 1 ),
					label: general_txt_arr[parent_index]
				},
				success: function(response){
					if(  response['msg'] == 'failed' ) {
						 
						hirxpert_progress_details( progress, response['msg'], 'failed' );
					}else{
						 
						hirxpert_progress_details( progress, response['msg'], '' );
					}
					index += 1;
					if( max_len > index ){
						hirxpert_general_media_install_function( index, choosed_demo, revslider, progress, parent_index );
					}else{
						hirxpert_progress_update( progress );
						parent_index += 1;
						hirxpert_page_file_install_function( 0, choosed_demo, revslider, progress );
					}
				},
				error: function(response, errorThrown){
					var msg = general_arr[index] + ' not imported';
					hirxpert_progress_details( progress, msg, 'failed' );
					index += 1;
					if( max_len > index ){
						hirxpert_general_media_install_function( index, choosed_demo, revslider, progress, parent_index );
					}else{
						hirxpert_progress_update( progress );
						parent_index += 1;
						hirxpert_page_file_install_function( 0, choosed_demo, revslider, progress );
					}
				}
			});//ajax end
		}
	}

	function hirxpert_page_file_install_function( index, choosed_demo, revslider, progress ){
		var parent_index = 0;
		var max_len = page_arr.length;
		if( max_len > index ){
			$.ajax({
				type: 'post',
				dataType: 'json',
				url: ajaxurl,
				data: {
					action: 'hirxpert_demo_import',
					process: 'xml_install',
					nonce:  $("#hirxpert_demo_import_nonce").val(),
					key: page_arr[index],
					part: 'pages',
					label: page_txt_arr[index]
				},
				success: function(response){
					if(  response.status == 'failed' ) {
						 
						hirxpert_progress_details( progress, response['msg'], 'failed' );
					}else{
						 
						hirxpert_progress_details( progress, response['msg'], '' );
					}
					index += 1;
					if( max_len > index ){
						hirxpert_page_file_install_function( index, choosed_demo, revslider, progress );
					}else{
						parent_index = media_parts ? 1 : 0;
						hirxpert_general_file_install_function( parent_index, choosed_demo, revslider, progress );
					}
					hirxpert_progress_update( progress );
				},
				error: function(response, errorThrown){
					var msg = page_arr[index] + ' not imported';
					hirxpert_progress_details( progress, msg, 'failed' );
					index += 1;
					if( max_len > index ){
						hirxpert_page_file_install_function( index, choosed_demo, revslider, progress );
					}else{
						parent_index = media_parts ? 1 : 0;
						hirxpert_general_file_install_function( parent_index, choosed_demo, revslider, progress );
					}
					hirxpert_progress_update( progress );
				}
			});//ajax end
		}
		
		if( max_len == 0 ){
			parent_index = media_parts ? 1 : 0;
			hirxpert_general_file_install_function( parent_index, choosed_demo, revslider, progress );
		}
		
	}
	
	function hirxpert_general_file_install_function( index, choosed_demo, revslider, progress ){
		var max_len = general_arr.length;
		if( max_len > index ){
		
			if( general_arr[index] == 'media' ){
				hirxpert_general_media_install_function( 0, choosed_demo, revslider, progress, index );
			}else{
		
				$.ajax({
					type: 'post',
					dataType: 'json',
					url: ajaxurl,
					data: {
						action: 'hirxpert_demo_import',
						process: 'general_install',
						nonce:  $("#hirxpert_demo_import_nonce").val(), 
						demo_type: choosed_demo,
						revslider: revslider,
						key: general_arr[index],
						menu_stat: menu_stat,
						label: general_txt_arr[index]
					},
					success: function(response){
						if(  response['msg'] == 'failed' ) {
							 
							hirxpert_progress_details( progress, response['msg'], 'failed' );
						}else{
							 
							hirxpert_progress_details( progress, response['msg'], '' );
						}
						index += 1;
						if( max_len > index ){
							hirxpert_general_file_install_function( index, choosed_demo, revslider, progress );
						}else{
							hirxpert_import_final( choosed_demo, progress );
						}
						hirxpert_progress_update( progress );
					},
					error: function(response, errorThrown){
						var msg = general_arr[index] + ' not imported';
						hirxpert_progress_details( progress, msg, 'failed' );
						index += 1;
						if( max_len > index ){
							hirxpert_general_file_install_function( index, choosed_demo, revslider, progress );
						}else{
							hirxpert_import_final( choosed_demo, progress );
						}
						hirxpert_progress_update( progress );
					}
				});//ajax end
				
			}//not media
		}
		
		if( max_len == 0 ){
			hirxpert_import_final( choosed_demo, progress );
		}
		
	}
	
	function hirxpert_import_final( choosed_demo, progress ){
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: ajaxurl,
			data: {
				action: 'hirxpert_demo_import',
				process: 'final',
				nonce:  $("#hirxpert_demo_import_nonce").val(),
				demo_type: choosed_demo
			},
			success: function(response){
				 
				hirxpert_progress_details( progress, response['msg'], '' );
				$('.zozo-preview-' + choosed_demo).hide();
				progress.parent(".installation-progress").hide();
	
				var none_imported_things = '';
				var sucs_content = '';
				
				$("ul.installation-progress-details").children("li.failed-import").each(function( index ) {
					none_imported_things += '<li>'+ $(this).text() +'</li>';
				});
	
				if( none_imported_things != '' ){
					sucs_content += '<h3>Non imported things</h3><ul>'+ none_imported_things +'</ul>';
				}
	
				sucs_content += '<h2>Regenerate Thumbnails</h2><p>This demo was imported well. So for exact image cropping use Regenerate Thumbnails plugin once. Are you sure want to regenerate thumbnails now?</p>';
	
				$.confirm({
					theme: 'supervan',
					title: false,
					content: sucs_content,
					confirmButtonClass: 'btn-success',
					cancelButtonClass: 'btn-danger',
					confirmButton: hirxpert_admin_ajax_var.yes,
					cancelButton: hirxpert_admin_ajax_var.no,
					confirm: function(){
						var win = window.open( hirxpert_admin_ajax_var.regenerate_thumbnails_url , '_blank');
						if (win) {
							win.focus();
						}
						window.location = hirxpert_admin_ajax_var.hirxpert_import_url;
					},
					cancel: function(){
						progress.parents(".install-plugin-wrap.theme").addClass("demo-actived");
					}
				});
	
			},
			error: function(response, errorThrown){
				$('.zozo-preview-' + choosed_demo).hide();
				progress.parent(".installation-progress").hide();
				window.location = hirxpert_admin_ajax_var.hirxpert_import_url;
			}
		});
	}
	
	$(document).ready(function(){
		zozo_admin_screen.install_demos();
	});
	
})( jQuery );