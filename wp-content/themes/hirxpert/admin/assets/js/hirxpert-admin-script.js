/*
 * Zozo woo base addon sctipts
 */ 

(function( $ ) {

	"use strict";
	
	$( document ).ready(function() {		
		
		$("a.custom-sidebar-create").on( "click", function(){
			$(this).prev("form").submit();
		});
		
		$(".custom-sidebar-export").on("click", function() {
			$.ajax({
				type: "post",
				url: ajaxurl,
				data: "action=hirxpert-custom-sidebar-export&nonce="+ $("#hirxpert_custom_sidebar_nonce").val() ,
				success: function( data ){
					$("<a />", {
						"download": "custom-sidebars.json",
						"href" : "data:application/json," + encodeURIComponent( data )
					}).appendTo("body").on( "click", function() {
						$(this).remove();
					})[0].click ();
				}
			});
			return false;
		});
		
		$(".hirxpert-custom-sidebar-table a.hirxpert-sidebar-remove").on( "click", function(){
			$("#hirxpert-sidebar-remove-name").val( $(this).data("sidebar") );
			$(this).parents("form").submit();
		});
		
		$(".hirxpert-custom-font-table a.hirxpert-font-remove").on( "click", function(){
			$("#hirxpert-font-remove-name").val( $(this).data("font") );
			$(this).parents("form").submit();
		});
		
		//Modified
		$(".hirxpert-custom-fonts-upload").on( "click", function() {
			if( $('#hirxpert-custom-fonts').get(0).files.length ) {
				$(this).prev("form").submit();
			}
			return false;
		});
		
        $(".bulk-activator").on( "click", function() {
			$("#multi-plugins-active-form").find("input.hirxpert-bulk-plugins").remove();
			$( document ).find(".bulk-activator").each(function(){
				if( $(this).is(":checked") ){
					$("#multi-plugins-active-form").append('<input type="hidden" class="hirxpert-bulk-plugins" name="hirxpert_bulk_plugins['+ $(this).val() +']" value="'+ $(this).val() +'" />');
				}
			});
		});
		
		$(".hirxpert-bulk-action").on("click", function(e) {
			e.preventDefault();
			if( $( document ).find(".hirxpert-bulk-plugins").length ){
				$("#multi-plugins-active-form").submit();
			}else{
                alert("!You have to choose at least 1 plugin to make bulk action.");
			}
		});
		
		$("#multi-plugins-active-form").on( "submit", function(e) {
			e.preventDefault();
			var form_data = $("#multi-plugins-active-form").serializeArray();
			var form_data_n = {};
			$.each( form_data, function( key, value ) {
				form_data_n[value.name] = value.value;
			});
			form_data_n.plugins = hirxpert_admin_ajax_var.tgm_plugins;
			$(document).find(".hirxpert-plugins-box").addClass("overlay");
			$(document).find("p.hirxpert-settings-msg > img.bulk-process-loader").fadeIn(200);
			$.ajax({
				type: 'POST',
				url: ajaxurl,
				data: form_data_n,
				success: function(data){
					window.location = location.href;
					$(document).find(".hirxpert-plugins-box").removeClass("overlay");
					$(document).find("p.hirxpert-settings-msg > img.bulk-process-loader").fadeOut(200);
				},
				error: function(response, errorThrown){
					window.location = location.href;
					$(document).find(".hirxpert-plugins-box").removeClass("overlay");
					$(document).find("p.hirxpert-settings-msg > img.bulk-process-loader").fadeOut(200);
				}
			});
		});
		
		if( $("#zozo-envato-deactivation-form").length ){
			$("#zozo-envato-deactivation-form").on( "submit", function(e) {
				e.preventDefault();
				var _form = $("#zozo-envato-deactivation-form");
				//enable loader
                _form.find('input[type="submit"]').attr("disabled", "disabled");
                _form.find(".process-loader").addClass("active");

                var form_data = _form.serialize();
                $.ajax({
                    type: 'POST',
                    url: ajaxurl,
                    data: "action=hirxpert_theme_deactivate&" + form_data,
                    success: function(data) {
                        _form.find('input[type="submit"]').removeAttr("disabled");
                        _form.find(".process-loader").removeClass("active");
                        window.location = location.href;
                    },
                    error: function(response, errorThrown) {
                        window.location = location.href;
                    }
                });
            });
        }

		// Envato registration form submission
		if ($("#zozo-envato-registration-form").length) {
			$("#zozo-envato-registration-form").on("submit", function(e) {
				e.preventDefault();
				var _form = $("#zozo-envato-registration-form");
				_form.find('input[type="submit"]').attr("disabled", "disabled");
				_form.find(".process-loader").addClass("active");
				_form.find(".verfication-txt").removeClass("active");

				var form_data = _form.serialize();
				$.ajax({
					type: 'POST',
					url: ajaxurl,
					data: "action=hirxpert_theme_verify&" + form_data,
					success: function(data) {
						_form.find('input[type="submit"]').removeAttr("disabled");
						_form.find(".process-loader").removeClass("active");
						if (data.error_message) {
							var errorMessage = data.error_message === 'already' ? hirxpert_admin_ajax_var.already_used : data.error_message;
							_form.find(".verfication-txt").html(errorMessage).addClass("active");
						} else if (data.status && data.status === 'success') {
							window.location = location.href;
						}
					},
					error: function(response, errorThrown) {
						var errorMessage = "<ul><li><h2><b>It's look like there is an issue from Server side:</b></h2></li><li>Please Check is your Server is HTTPS, if it is HTTP it will be less secure.</li><li>Check if the Server permission is 755 or 777.</li><li>Please check is our server IP is blocked by your server if blocked Please whitelist our IP.</li><li>If the theme is still not activated, please contact us at<a href='https://zozothemes.ticksy.com/' target='_blank'>Zozo Support</a></li></ul>";
						showErrorPopup( errorMessage );
					}
				});
			});
		}

		function showErrorPopup(message) {
			$("body").append(`
				<div class="error-popup">
					<div class="error-content">
						<p>${message}</p>
						<button class="close-popup">OKAY</button>
						<button class="retry-popup">RETRY</button>
					</div>
				</div>
			`);
			$(".close-popup").on("click", function() {
				$(".error-popup").remove();
				window.location = location.href;
			});
			$(".retry-popup").on("click", function() {
				window.location = location.href;
			});
		}


        // Bulk select all
        $(".bulk-select-all").on("change",  function() {
            var isChecked = $(this).is(":checked");
            $(".bulk-activator").prop("checked", isChecked);
            updateBulkPluginsInput();
        });

        // Update hidden inputs for selected plugins
        function updateBulkPluginsInput() {
            $("#multi-plugins-active-form").find("input.hirxpert-bulk-plugins").remove();
            $(".bulk-activator:checked").each(function() {
                var pluginSlug = $(this).val();
                $("#multi-plugins-active-form").append('<input type="hidden" class="hirxpert-bulk-plugins" name="hirxpert_bulk_plugins[' + pluginSlug + ']" value="' + pluginSlug + '" />');
            });
        }

    });

	// Consolidated window load function
	$(window).on("load", function() {
		if ($(".admin-box-slide-wrap .owl-carousel").length) {
			$(".admin-box-slide-wrap .owl-carousel").owlCarousel({
				loop: true,
				margin: 0,
				autoplay: true,
				autoplayTimeout: 4000,
				items: 1
			});
		}
	});
  
  	document.addEventListener("DOMContentLoaded", function() {
		function setCookie(name, value, days) {
			let date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000)); // Convert days to milliseconds
			document.cookie = name + "=" + value + "; path=/; expires=" + date.toUTCString();
		}
	
		function getCookie(name) {
			let cookieArr = document.cookie.split("; ");
			for (let i = 0; i < cookieArr.length; i++) {
				let cookiePair = cookieArr[i].split("=");
				if (cookiePair[0] === name) {
					return cookiePair[1];
				}
			}
			return null;
		}
	
		// Check if the cookie exists
		if (!getCookie("hirxpert_welcome_notice")) {
			// Show popup
			var popupMsg = `<div class="error-popup">
								<div class="error-content">
									<p><strong>Important Notice for Existing Users:</strong> We’ve made a significant update to the theme by removing the email and address fields while introducing flexible HTML fields for greater customization. If needed, you can now add these details manually using the new HTML fields. <a href="https://zozothemes.com/update-notice" target="_blank">Learn more about this update</a>.</p>
									<button class="okay-popup">Okay</button>
									<button class="cancel-popup">Cancel</button>
								</div>
							</div>`;
			$("body").append(popupMsg);
			// Add click event listener for the "OKAY" button
        	$(".okay-popup").on("click", function() {
				// Set a cookie to prevent future popups (e.g., reappear after 7 days)
            	setCookie("hirxpert_welcome_notice", "seen", 7);
            	$(".error-popup").remove(); // Remove the popup
        	});
			
			// Add click event listener for the "Cancel" button
        	$(".cancel-popup").on("click", function() {
            	$(".error-popup").remove(); // Remove the popup, but do not set the cookie
        	});
		}
	});
	
})( jQuery );