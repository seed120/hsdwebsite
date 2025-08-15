/*
 * Classic Addons for Elementor Scripts
 * Description: Classic addons plugin have 20+ massive widgets for Elementor page builder.
 * Version: 1.0
 * Author: zozothemes
 */
 
(function( $ ) {
	
	"use strict";
	
	$(document).ready(function() {
		// Initialize isotope layout on document ready
		initCEAIsotopeLayout();
	
		// Other document ready initializations
		/* Shortcode CSS Append */
		var css_out = '';
		$(".cea-inline-css").each(function() {
			var shortcode = $(this);
			var shortcode_css = shortcode.attr("data-css");
			css_out += ($).parseJSON(shortcode_css);
			shortcode.removeAttr("data-css");
		});
		if (css_out != '') {
			$('head').append('<style id="cea-shortcode-styles">' + css_out + '</style>');
		}
	
		if ($('#cea-panorama').length) {
			var img_src = $('#cea-panorama').attr("data-src");
			pannellum.viewer('cea-panorama', {
				"type": "equirectangular",
				"panorama": img_src
			});
			$(".pnlm-load-button").trigger("click");
		}
	});
	
	$(window).on('load', function() {
		// Theme Owl Carousel Code
		$('.cea-related-slider').each(function(index, value) {
			if ($(value).length) {
				cea_owl_carousel($(value));
			}
		});
	});
	
	function initCEAIsotopeLayout() {
		$(".cea-archive-template > .isotope").each(function(index, value) {
			ceaArchiveIsotopeLayout(value);
		});
	}
	
	function ceaArchiveIsotopeLayout(c_elem) {
		var $c_elem = $(c_elem);
		var parent_width = $c_elem.width();
		var gutter_size = $c_elem.data("gutter") || 10;
		var grid_cols = $c_elem.data("cols") || 4;
		var filter = '';
		var layoutmode = $c_elem.data("layout") || 'masonry';
		var lazyload = $c_elem.data("lazyload") ? '0s' : '0.4s';
	
		if ($(window).width() < 768) grid_cols = 1;
	
		var net_width = Math.floor((parent_width - (gutter_size * (grid_cols - 1))) / grid_cols);
		$c_elem.find(".isotope-item").css({'width': net_width + 'px', 'margin-bottom': gutter_size + 'px !important'});
	
		var cur_isotope;
	
		// Call isotope after images loaded
		$c_elem.imagesLoaded(function() {
			cur_isotope = $c_elem.isotope({
				itemSelector: '.isotope-item',
				layoutMode: layoutmode,
				filter: filter,
				transitionDuration: lazyload,
				masonry: {
					gutter: gutter_size
				},
				fitRows: {
					gutter: gutter_size
				}
			});
		});
	
		// Isotope filter item
		$c_elem.prev(".isotope-filter").find(".isotope-filter-item").on('click', function() {
			$(this).parents("ul.nav").find("li").removeClass("active");
			$(this).parent("li").addClass("active");
			filter = $(this).attr("data-filter");
			if ($c_elem.find(".isotope-item" + filter).hasClass("cea-animate")) {
				if (filter) {
					$c_elem.find(".isotope-item" + filter).removeClass("run-animate");
				} else {
					$c_elem.find(".isotope-item").removeClass("run-animate");
				}
				cea_scroll_animation($c_elem);
			}
			cur_isotope.isotope({
				filter: filter
			});
	
			return false;
		});
	
		// Animate isotope items
		if ($c_elem.find(".isotope-item").hasClass("cea-animate")) {
			cea_scroll_animation($c_elem);
			$(window).on('scroll', function() {
				cea_scroll_animation($c_elem);
			});
		} else {
			$c_elem.children(".isotope-item").addClass("item-visible");
		}
	
		// Isotope infinite scroll
		if ($c_elem.data("infinite") == 1 && $("ul.post-pagination").length) {
			var loadmsg = $c_elem.data("loadmsg");
			var loadend = $c_elem.data("loadend");
			var loadimg = $c_elem.data("loadimg");
	
			$c_elem.infinitescroll({
				navSelector: '.post-pagination',
				nextSelector: 'a.next-page',
				itemSelector: '.isotope-item',
				loading: {
					msgText: loadmsg,
					finishedMsg: loadend,
					img: loadimg
				}
			},
			function(newElements) {
				var elems = $(newElements);
				var net_width = Math.floor((parent_width - (gutter_size * (grid_cols - 1))) / grid_cols);
				$c_elem.find(".isotope-item").css({'width': net_width + 'px', 'margin-bottom': gutter_size + 'px'});
				elems.imagesLoaded(function() {
					$c_elem.isotope('appended', elems);
				});
	
				if ($c_elem.find(".isotope-item").hasClass("cea-animate")) {
					cea_scroll_animation($c_elem);
				} else {
					$c_elem.children(".isotope-item").addClass("item-visible");
				}
			});
		}
	
		// Isotope resize
		$(window).resize(function() {
			setTimeout(function() {
				grid_cols = $c_elem.data("cols") || 4;
				if ($(window).width() < 768) grid_cols = 1;
	
				parent_width = $c_elem.width();
				net_width = Math.floor((parent_width - (gutter_size * (grid_cols - 1))) / grid_cols);
				$c_elem.find(".isotope-item").css({'width': net_width + 'px'});
				$c_elem.imagesLoaded(function() {
					$c_elem.isotope('layout');
				});
			}, 200);
		});
	}
	
	function cea_owl_carousel( c_owlCarousel ){
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
})( jQuery );

