( function( $ ) {
	/**
 	 * @param $scope The Widget wrapper element as a jQuery element
	 * @param $ The jQuery alias
	 */ 
	 
	/* Typing Text Handler */
	var WidgetAnimateTextHandler = function( $scope, $ ) {
		$scope.find('.cea-typing-text').each(function( index ) {
			ceaAnimatedTextSettings( this, index );
		});
	};
	
	/* Button Handler */
	var WidgetButtonHandler = function( $scope, $ ) {
		$scope.find('.cea-button').each(function( index ) {
			ceaButtonSettings( this );
		});
	};
	
	/* Isotope Handler */
	var WidgetIsotopeHandler = function( $scope, $ ) {
		$scope.find('.isotope').each(function() {
			ceaIsotopeLayout( this );
		});		
	};
	
	/* Owl Carousel Handler */
	var WidgetOwlCarouselHandler = function( $scope, $ ) {
		$scope.find('.owl-carousel').each(function() {
			ceaOwlSettings( this );
		});
	};
	
	var WidgetMouseCursorHandler = function( $scope, $ ) {
		$scope.find(".blog-wrapper").each(function() {
			cursorCPTContent(this);
		});
	}

	var WidgetCPTHandler = function( $scope, $ ) {
		const cptNormal = [".portfolio-normal-model",".service-normal-model",".team-normal-model",".event-normal-model"];
        cptNormal.forEach((cpt) => {
            $scope.find(cpt).each(function () {
                ceaCPTAjaxLoad(this);
            });
        });
		const cptWrapper = [".portfolio-wrapper",".service-wrapper",".team-wrapper",".event-wrapper", ".testimonial-wrapper"];
		cptWrapper.forEach((cpt) => {
			$scope.find(cpt).each(function () {
                cursorCPTContent(this);
            });
		})
	}
	
	/* Image Accordion */
	var WidgetImageAccordionHandler = function ( $scope, $ ) {
		const ceaAccordion = [ ".cea-image-accordion-vertical", ".cea-image-accordion-horizontal" ];
        ceaAccordion.forEach((cpt) => {
            $scope.find(cpt).each(function () {
                ceaImageAccordion(this);
            });
        });
	};
	
	/* Popup Handler */
	var WidgetPoupHandler = function( $scope, $ ) {
		if( $scope.find('.image-gallery').length ){
			$scope.find('.image-gallery').each(function() {
				ceaPopupGallerySettings( this );
			});
		}
	};
	
	/* Circle Progress Handler */
	var WidgetCircleProgressHandler = function( $scope, $ ) {
		if( $scope.find('.circle-progress-circle').length ){
			var circle_ele = $scope.find('.circle-progress-circle');
			ceaCircleProgresSettings(circle_ele);
		}		
	};
	
	/* Counter Handler */
	var WidgetCounterUpHandler = function( $scope, $ ) {
		if( $scope.find('.counter-up').length ){
			var counter_ele = $scope.find('.counter-up');
			ceaCounterUpSettings(counter_ele);
		}		
	};
	
	/* Image Before After Handler */
	var WidgetImageBeforeAfterHandler = function( $scope, $ ) {
		if( $scope.find('.cea-imgc-wrap').length ){
			var img_ba_ele = $scope.find('.cea-imgc-wrap');
			ceaImageBeforeAfterSettings(img_ba_ele);
		}		
	};
	
	/* Mailchimp Handler */
	var WidgetMailchimpHandler = function( $scope, $ ) {
		if( $scope.find(".cea-mailchimp-wrapper").length ){
			$scope.find('.cea-mailchimp-wrapper').each(function( index ) {
				ceaMailchimp( this );
			});
		}
	};
	
	/* Day Counter Handler */
	var WidgetDayCounterHandler = function( $scope, $ ) {
		$scope.find('.day-counter').each(function() {
			ceaDayCounterSettings( this );
		});		
	};
	
	/* Chart Handler */
	var WidgetChartHandler = function( $scope, $ ) {
		function isInViewport(el) {
			var rect = el.getBoundingClientRect();
			return (
				rect.top < window.innerHeight && rect.bottom > 0
			);
		}

		function initOnVisible($elements, initFunction) {
			$elements.each(function () {
				var el = this;
				var $el = $(el);
				if (!$el.data('chart-init-handler')) {
					var observer = new IntersectionObserver(function (entries) {
						entries.forEach(function (entry) {
							if (entry.isIntersecting) {
								if ($el.data('chart-instance')) {
									$el.data('chart-instance').destroy();
								}
								var chartInstance = initFunction(el);
								$el.data('chart-instance', chartInstance);
							}
						});
					}, {
						threshold: 0.3
					});
					observer.observe(el);
					$el.data('chart-init-handler', observer);
				}
			});
		}

		initOnVisible($scope.find('.pie-chart'), ceaPieChartSettings);
		initOnVisible($scope.find('.line-chart'), ceaLineChartSettings);
	};
	
	/* Modal Popup Handler */
	var WidgetModalPopupHandler = function( $scope, $ ) {
		if( $scope.find('.modal-popup-wrapper.page-load-modal').length ){
			var modal_id = $scope.find('.modal-popup-wrapper.page-load-modal .modal').attr("id");
			$('#'+modal_id).modal('show');
		}
	};

	/* Agon Handler */
	var WidgetAgonHandler = function( $scope, $ ) {
		if( $scope.find(".canvas_agon").length ){
			$scope.find( '.canvas_agon' ).each(function() {
				ceaAgon( this );
			});
		}
	};
	
	/* Cloud9 Carousel Handler */
	var WidgetCloud9CarouselHandler = function( $scope, $ ) {
		if( $scope.find(".cloud9-carousel").length ){
			$scope.find( '.cloud9-carousel' ).each(function() {
				ceaCloud9Carousel( this );
			});
		}
	};
	
	/* CEAMap Handler */
	var WidgetCEAMapHandler = function( $scope, $ ) {
		if( $scope.find(".ceagmap").length ){
			initCEAGmap();
		}
	};
	
	/* Timeline Slider Handler */
	var WidgetTimelineSliderHandler = function( $scope, $ ) {
		if( $scope.find('.cd-horizontal-timeline').length ){
			//var cur_ele = $scope.find('.cd-horizontal-timeline');
			var line_dist = $scope.find('.cd-horizontal-timeline').data("distance") ? $scope.find('.cd-horizontal-timeline').data("distance") : 60;
			$scope.find('.cd-horizontal-timeline').zozotimeline({
				distance: line_dist
			});
		}
	};
	
	/* Modal Popup Handler */
	var WidgetModalPopupHandler = function( $scope, $ ) {
		if( $scope.find(".cea-modal-box-trigger").length ){
			$scope.find( '.cea-modal-box-trigger' ).each(function() {
				ceaModalPopup( this );
			});
		}
		if( $scope.find('.cea-page-load-modal').length ){
			var modal_id = $scope.find('.cea-page-load-modal .white-popup-block').attr("id");
			$.magnificPopup.open({
			items: {
					src: '#'+modal_id
				},
				type: 'inline'
			});
		}
		$(document).on( 'click', '.cea-popup-modal-dismiss', function (e) {
			e.preventDefault();
			$.magnificPopup.close();
		});
	};
	
	/* Popup Anything Handler */
	var WidgetPopupAnythingHandler = function( $scope, $ ) {
		if( $scope.find(".cea-popup-anything").length ){
			$scope.find( '.cea-popup-anything' ).each(function() {
				ceaPopupAnything( this );
			});
		}
	};
	
	/* Popover Handler */
	var WidgetPopoverHandler = function( $scope, $ ) {
		if( $scope.find(".cea-popover-trigger").length ){
			$scope.find( '.cea-popover-trigger' ).each(function() {
				ceaPopover( this );
			});
		}
	};
	
	/* Recent/Popular Toggle Handler */
	var WidgetRecentPopularToggleHandler = function( $scope, $ ) {
		if( $scope.find(".cea-toggle-post-trigger").length ){
			$scope.find(".cea-toggle-post-trigger .switch-checkbox").change(function(){
				ceaSwitchTabToggle( this );
			});
		}
	};
	
	/* Rain Drops Handler */
	var WidgetRainDropsHandler = function( $scope, $ ) {
		if( $scope.find(".cea-rain-drops").length ){
			$scope.find('.cea-rain-drops').each(function( index ) {
				ceaRainDrops( this );
			});
		}
	};
	
	/* Rain Drops and Parallax Handler */
	var SectionCustomOptionsHandler = function( $scope, $ ) {
	if ( $scope.is('section')){
			if ( $scope.is('section[data-cea-float]' ) ){
				ceaSectionFloatParallax( $scope );
			}
			if ( $scope.is('section[data-cea-raindrops]' ) ){
				ceaSectionRainDrops( $scope );
			}
			if ( $scope.is('section[data-cea-parallax-data]' ) ){
				ceaSectionParallax( $scope );
			}
		}
	};

	var WidgetMousePointerHandler = function ($scope, $) {
		var settings = $scope.data('cursor-settings');
		if (!settings || settings.enable_animation !== 'yes') return;
	
		// Create a unique cursor container for each widget
		var cursorContainer = $('<div class="custom-cursor"></div>');
		$('body').append(cursorContainer);
		cursorContainer.addClass(settings.widget_cls);
		// Apply styles based on the animation type
		if (settings.animation_type === 'circle_text') {
			cursorContainer.html('<span class="cursor-text">' + settings.cursor_text + '</span>');
		} else if (settings.animation_type === 'icon') {
			cursorContainer.html('<i class="' + settings.cursor_icon + '"></i>');
		} else if (settings.animation_type === 'image') {
			cursorContainer.html('<img src="' + settings.cursor_image + '" alt="Cursor Image">');
		}
	
		// Attach event listeners to the container
		$scope.on('mousemove', function (event) {
			const containerRect = $scope[0].getBoundingClientRect();
            const cursorX = event.clientX;
            const cursorY = event.clientY;

            const containerLeft = containerRect.left;
            const containerRight = containerRect.right;
            const containerTop = containerRect.top;
            const containerBottom = containerRect.bottom;

            const width = containerRect.width;
            const height = containerRect.height;

            const marginX = width * 0.1;
            const marginY = height * 0.1;

            // Check if inside container
            const insideX =
                cursorX >= containerLeft && cursorX <= containerRight;
            const insideY =
                cursorY >= containerTop && cursorY <= containerBottom;

            if (!insideX || !insideY) {
                cursorContainer.css({
                    display: "none",
					opacity: 0,
                    transform: "translate(-50%, -50%) scale(0)",
                });
                return;
            }

            // Calculate distance to edges
            const distLeft = cursorX - containerLeft;
            const distRight = containerRight - cursorX;
            const distTop = cursorY - containerTop;
            const distBottom = containerBottom - cursorY;

            // Determine scaling factor based on proximity to edges
            const scaleX = distLeft < marginX ? distLeft / marginX : distRight < marginX ? distRight / marginX : 1;

            const scaleY = distTop < marginY ? distTop / marginY : distBottom < marginY ? distBottom / marginY : 1;

            const scale = Math.max(0.3, Math.min(scaleX, scaleY)); // Set min scale

            cursorContainer.css({
                top: cursorY + "px",
                left: cursorX + "px",
                transform: `translate(-50%, -50%) scale(${scale})`,
                display: "block",
				opacity: scale,
            });
		});
	
		$scope.on('mouseleave', function () {
			cursorContainer.css({
                display: "none",
				opacity: 0,
                transform: "translate(-50%, -50%) scale(0)",
            });
		});
	
		// Clean up the cursor container on destroy
		$scope.on('elementor:destroy', function () {
			cursorContainer.remove();
		});
	};
	
	function ceaVideoZoom( video_ele ) {
		const $container = $(video_ele);
        const $wrapper = $container.find(".cea-zoom_wrapper");
        const $videoItem = $container.find(".zoom-video-item");

		const data_attr = $container.data("zoom");
        const disableOnMobile = data_attr.disable_mobile === "yes";
        
        const scale_from = parseFloat($container.css("--zoom-scale-from")) || 0.5;
		const scale_to = parseFloat($container.css("--zoom-scale-to")) || 1.5;
		const opacity_from = parseFloat($container.css("--zoom-opacity-from")) || 0;
		const opacity_to = parseFloat($container.css("--zoom-opacity-to")) || 1;
		
        const config = {
            speed: 1,
            scaleFrom: scale_from,
            scaleTo: scale_to,
            opacityFrom: opacity_from,
            opacityTo: opacity_to,
            timeFrom: 0,
            timeTo: 1,
        };
		
		const lerp = (x, y, a) => x * (1 - a) + y * a;
		const invlerp = (x, y, a) => clamp((a - x) / (y - x));
		const clamp = (a, min = 0, max = 1) => Math.min(max, Math.max(min, a));
    	const range = (x1, y1, x2, y2, a) => lerp(x2, y2, invlerp(x1, y1, a));
        let scrollHandlerAttached = false;
    	function getScrollProgress() {
    	    const rect = $container[0].getBoundingClientRect();
    	    const viewportHeight = window.innerHeight;
    	    let progress = (viewportHeight - rect.top) / (rect.height * config.speed);
    	    progress = progress - (config.timeFrom / config.speed);
    	    return clamp(invlerp(config.timeFrom, config.timeTo, progress));
    	}

    	function applyTransformations(progress) {
        	const scale = range(0, 1, config.scaleFrom, config.scaleTo, progress);
        	const opacity = range(0, 1, config.opacityFrom, config.opacityTo, progress);
        	$videoItem.css({
            	transform: `scale(${scale})`,
            	opacity: opacity,
            	'transform-origin': 'center center'
        	});
        	$wrapper.toggleClass('zoom-active', progress > 0 && progress < 1);
        	$wrapper.toggleClass('zoom-completed', progress >= 1);
    	}

		function handleScroll() {
			const rect = $container[0].getBoundingClientRect();
			const viewportHeight = window.innerHeight;

			if (rect.bottom < 0 || rect.top > viewportHeight) {
				if (rect.bottom < 0) {
					applyTransformations(1);
				}
				return;
			}
			const progress = getScrollProgress();
			applyTransformations(progress);
		}
		function attachScroll() {
            if (!scrollHandlerAttached) {
                window.addEventListener("scroll", handleScroll, {
                    passive: true,
                });
                handleScroll();
                scrollHandlerAttached = true;
            }
        }
        function detachScroll() {
            if (scrollHandlerAttached) {
                window.removeEventListener("scroll", handleScroll);
                scrollHandlerAttached = false;
            }
        }
        function updateAnimationState() {
            const isMobile = window.innerWidth < 500;
            if (isMobile && disableOnMobile) {
                detachScroll();
				$container.css({
				    "height": "auto", 
				});
				if ( window.innerWidth <= 499 && window.innerWidth >= 425 ) {
				    $container.css({
				        "margin-bottom": "8%", 
				    });
				} else {
				    $container.css({
				        "margin-bottom": "auto", 
				    });
				}
				$wrapper.css("position", "static");
				$wrapper.find(".zoom-video-wrapper").css({
					"position": "static",
					"height": "auto"
				});
                $videoItem.css({ transform: "", opacity: "" });
                $wrapper.removeClass("zoom-active zoom-completed");
            } else {
                const videoNaturalHeight = $videoItem[0].videoHeight || 360; // fallback
                const videoNaturalWidth = $videoItem[0].videoWidth || 640;
                const aspectRatio = videoNaturalHeight / videoNaturalWidth;
                
                const containerWidth = $container.width();
                const baseVideoHeight = containerWidth * aspectRatio;
                
                const scaledHeight = baseVideoHeight * scale_to;
                const buffer = 100;
                
				$container.css("height", `${scaledHeight + buffer}px`);
				$wrapper.css("position", "absolute");
				$wrapper.find(".zoom-video-wrapper").css({
                    position: "absolute",
                    height: `${baseVideoHeight}px`,
                });
                attachScroll();
            }
        }
        updateAnimationState(); 
		window.addEventListener("resize", updateAnimationState);
        return function cleanup() {
            detachScroll();
            window.removeEventListener("resize", updateAnimationState);
        };
	}

	function ceaImageZoom(imgzoom_ele) {
        const $ele = $(imgzoom_ele);
        const $img = $ele.find("img");
        const $text = $ele.find(".image-zoom-text");
        const $sub = $ele.find(".image-zoom-sub-title");
		const data_attr = $ele.data("zoom");
		const disableOnMobile = data_attr.disable_mobile === "yes";
		
		const scale_from = parseFloat($ele.css("--zoom-scale-from")) || 0.5;
		const scale_to = parseFloat($ele.css("--zoom-scale-to")) || 1.5;
		const opacity_from = parseFloat($ele.css("--zoom-opacity-from")) || 0;
		const opacity_to = parseFloat($ele.css("--zoom-opacity-to")) || 1;
		
        const config = {
            speed: 1,
            scaleFrom: scale_from,
            scaleTo: scale_to,
            opacityFrom: opacity_from,
            opacityTo: opacity_to,
            timeFrom: 0,
            timeTo: 1,
        };

        const lerp = (x, y, a) => x * (1 - a) + y * a;
        const clamp = (a, min = 0, max = 1) => Math.min(max, Math.max(min, a));
        const invlerp = (x, y, a) => clamp((a - x) / (y - x));
        const range = (x1, y1, x2, y2, a) => lerp(x2, y2, invlerp(x1, y1, a));

        let scrollHandlerAttached = false;

        function getScrollProgress() {
            const rect = $ele[0].getBoundingClientRect();
            const viewportHeight = window.innerHeight;
            let progress = (viewportHeight - rect.top) / (rect.height * config.speed);
            progress = progress - config.timeFrom / config.speed;
            return clamp(invlerp(config.timeFrom, config.timeTo, progress));
        }

        function applyTransformations(progress) {
            const scale = range(
                0,
                1,
                config.scaleFrom,
                config.scaleTo,
                progress
            );
            const opacity = range(
                0,
                1,
                config.opacityFrom,
                config.opacityTo,
                progress
            );
            const yOffset = (1 - opacity) * 40;
            $img.css({
                transform: `scale(${scale})`,
                opacity: opacity,
            });
            $text.css({
                transform: `scale(${scale}) translateY(-${yOffset}px)`,
                opacity: opacity,
            });
            $sub.css({
                transform: `scale(${scale}) translateY(-${yOffset / 1.5}px)`,
                opacity: opacity,
            });
            if ( $text.length || $sub.length || $img.length ) {
                // $ele.css({ height: "100vh" });
            }
        }

        function handleScroll() {
            const viewportHeight = window.innerHeight;
            const rect = $ele[0].getBoundingClientRect();
            if (rect.bottom < 0 || rect.top > viewportHeight) {
                if (rect.bottom < 0) {
                    applyTransformations(1);
                }
                return;
            }
            const progress = getScrollProgress();
            applyTransformations(progress);
        }
        function attachScroll() {
            if (!scrollHandlerAttached) {
                window.addEventListener("scroll", handleScroll, {
                    passive: true,
                });
                handleScroll();
                scrollHandlerAttached = true;
            }
        }
        function detachScroll() {
            if (scrollHandlerAttached) {
                window.removeEventListener("scroll", handleScroll);
                scrollHandlerAttached = false;
            }
        }
        function updateAnimationState() {
            const isMobile = window.innerWidth < 768;
			if (isMobile && disableOnMobile) {
                detachScroll();
                // Reset styles if needed
                $img.css({ transform: "", opacity: "" });
                $text.css({ transform: "", opacity: "" });
                $sub.css({ transform: "", opacity: "" });
				$ele.css({ height: "fit-content" });
            } else {
				const naturalHeight = $img[0].naturalHeight || 400; 
                const naturalWidth = $img[0].naturalWidth || 600;
                const aspectRatio = naturalHeight / naturalWidth;

                const containerWidth = $ele.width();
                const baseHeight = containerWidth * aspectRatio;

                const scaledHeight = baseHeight * scale_to;
                const buffer = 100; 
                $ele.css({
                    height: `${scaledHeight + buffer}px`,
                    position: "relative",
                });
                attachScroll();
			}
		}
		updateAnimationState();
		window.addEventListener("resize", updateAnimationState);
    }

	// Image Grid Zoom
	function ceaZoomImageGrid( grid_ele ) {

		const grid = $(grid_ele);
		const $text = grid.find(".image-zoom-text");
        const $sub = grid.find(".image-zoom-sub-title");
        const items = grid.find("[zoom_grid_item]");
        const blurScale = grid.data("blur") || 0;
        
        if ($text.length || $sub.length || items.length) {
            grid.css({
                perspective: "1000px",
                overflow: "visible",
                height: "100vh",
            });
        }
        
        const gridOffset = grid.offset();
        const gridWidth = grid.outerWidth();
        const gridHeight = grid.outerHeight();

        const entryStates = [];

        // Initial styles
        items.each(function () {
            const $item = $(this);
            const itemOffset = $item.offset();
            const itemWidth = $item.outerWidth();
            const itemHeight = $item.outerHeight();

            const itemCenterX =
                itemOffset.left - gridOffset.left + itemWidth / 2;
            const itemCenterY =
                itemOffset.top - gridOffset.top + itemHeight / 2;

            const normX = itemCenterX / gridWidth;
            const normY = itemCenterY / gridHeight;

            const offsetX = (normX - 0.5) * 2;
            const offsetY = (normY - 0.5) * 2;
            const offsetZ = 100 + 50 * Math.sqrt(offsetX ** 2 + offsetY ** 2);
            entryStates.push({
                offsetX,
                offsetY,
                offsetZ,
                $item,
            });
        });
        
        items.each(function (i) {
            const entry = entryStates[i];

            const x = entry.offsetX * 50;
            const y = entry.offsetY * 50;
            const z = entry.offsetZ;

            entry.$item.css({
                filter: `blur(${blurScale}px)`,
                transform: `translate3d(${x}px, ${y}px, ${z}px) scale(1.2)`,
                transition: "transform 0.3s ease, filter 0.3s ease",
                transformStyle: "preserve-3d",
                willChange: "transform, filter",
            });
        });

        function updateOnScroll() {
            const windowHeight = window.innerHeight;
			const targetTop = windowHeight * 0.7; 
			
            entryStates.forEach((entry, i) => {
                const itemRect = entry.$item[0].getBoundingClientRect();

                const visibleTop = itemRect.top < windowHeight;
                const visibleBottom = itemRect.bottom > 0;

                if (visibleTop && visibleBottom) {	
                    const itemHeight = entry.$item.outerHeight();
                    const itemCenter = itemRect.top + itemHeight / 2;

					const distance = itemCenter - targetTop;
                    const maxDistance = windowHeight - targetTop;

                    const progress = Math.max(0, Math.min(1, 1 - distance / maxDistance));

                    const x = entry.offsetX * 50 * (1 - progress);
                    const y = entry.offsetY * 50 * (1 - progress);
                    const z = entry.offsetZ * (1 - progress);
                    const scale = 1.2 - progress * 0.2;
                    const blur = blurScale - progress * blurScale;

                    const transform = `translate3d(${x}px, ${y}px, ${z}px) scale(${scale})`;

                    const delay = i * 30;
                    setTimeout(() => {
                        entry.$item.css({
                            filter: `blur(${blur}px)`,
                            transform,
                        });
                    }, delay);
                }
            });
        }

        let ticking = false;
        window.addEventListener(
            "scroll",
            () => {
                if (!ticking) {
                    requestAnimationFrame(() => {
                        updateOnScroll();
                        ticking = false;
                    });
                    ticking = true;
                }
            },
            { passive: true }
        );
        updateOnScroll();
    }

	var SectionListScroll = function( $scope, $ ) {
		var listParent = $(".list-step-section");
		var listItems = listParent.find(".e-child");
		
		listItems.addClass("list-section-	items");
		listParent.css("min-height", listParent.outerHeight() + "px" );

		function updateSticky() {
            const $parentTop = parseFloat(
                listParent.css("--section-stack-top")
            );
            const stickyStart = $parentTop;

            if (!isElementInViewport(listParent[0])) return;

			const containerWidth = listParent.width();
            if (listParent.hasClass("e-con-boxed")) {
                // containerWidth = listParent.child(".e-con-inner").width();
                // console.log(listParent.child(".e-con-inner").width());
            } else {
                console.log("It is not boxed");
            }
			console.log(containerWidth);

            const scrollTop = $(window).scrollTop();
            const containerTop = listParent.offset().top;
            const containerHeight = listParent.outerHeight();
            const containerBottom = containerTop + containerHeight;

            // Reset all items to their default state
            listItems
                .css({
                    position: "",
                    top: "",
                    width: "",
                    zIndex: "",
                })
                .each(function () {
                    const $item = $(this);
                    if ($item.data("placeholder")) {
                        $item.data("placeholder").remove();
                        $item.removeData("placeholder");
                    }
                });

            let stickyIndex = -1;
            const lastItemIndex = listItems.length - 1;
            const lastItem = listItems.eq(lastItemIndex);
            const lastItemBottom =
                lastItem.offset().top + lastItem.outerHeight();

            listItems.each(function (i) {
                const $item = $(this);
                const itemTop = $item.offset().top;
                const itemHeight = $item.outerHeight();
                if (itemTop - scrollTop <= stickyStart) {
                    stickyIndex = i;
                }
            });

            const itemHeight = listItems.eq(0).outerHeight(); // assuming uniform height
            const totalStackHeight = (stickyIndex + 1) * itemHeight;
            const shouldReleaseAll =
                scrollTop + stickyStart + itemHeight >= containerBottom;
            const stickyOffset = scrollTop + stickyStart - containerTop;

            listItems.each(function (i) {
                const $item = $(this);
                const itemHeight = $item.outerHeight();
                const itemMargin = parseInt($item.css("margin-bottom")) || 0;
                if ($item.data("placeholder")) {
                    $item.data("placeholder").remove();
                    $item.removeData("placeholder");
                }
                const isLast = i === listItems.length - 1;
                if (shouldReleaseAll && isLast) {
                    $item.css({
                        position: "relative",
                        top: "",
                        width: "",
                        opacity: 1,
                    });
                } else if (shouldReleaseAll && !isLast) {
                    $item.css({
                        position: "relative",
                        top: "-" + stickyStart * 2 + "px",
                    });
                } else if (i === stickyIndex) {
                    $item.css({
                        position: "fixed",
                        top: stickyStart + "px",
                        width: containerWidth + "px",
                    });
                    const placeholder = $("<div>").css({
                        height: itemHeight + itemMargin + "px",
                        visibility: "hidden",
                    });
                    $item.data("placeholder", placeholder);
                    $item.after(placeholder);
                } else if (i <= stickyIndex) {
                    const distance = stickyIndex - i;
                    $item.css({
                        position: "fixed",
                        top: stickyStart + "px",
                        width: containerWidth + "px",
                        opacity: 1,
                        transition: "top 0.2s ease, opacity 0.2s ease",
                    });
                    const placeholder = $("<div>").css({
                        height: itemHeight + itemMargin + "px",
                        visibility: "hidden",
                    });
                    $item.data("placeholder", placeholder);
                    $item.after(placeholder);
                } else {
                    $item.css({
                        position: "relative",
                    });
                }
            });

            listParent.css("min-height", listParent.outerHeight() + "px");
		}

		if ( listParent.length > 0 ) {
           function isElementInViewport(el) {
            	const rect = el.getBoundingClientRect();
            	return (
                	rect.top <=
                    	(window.innerHeight ||
                    	    document.documentElement.clientHeight) &&
                	rect.bottom >= 0
            	);
        	}

        	let ticking = false;
        	function onScroll() {
        	    if (!ticking) {
        	        window.requestAnimationFrame(function () {
        	            updateSticky();
        	            ticking = false;
        	        });
        	        ticking = true;
        	    }
        	}

        	// Set up event listeners
        	$(window).on("scroll", onScroll);
        	$(window).on("resize", function () {
        	    listParent.css("min-height", "auto");
        	    updateSticky();
        	    listParent.css("min-height", listParent.outerHeight() + "px");
        	});

        	// Initial setup
        	updateSticky();
		}

	}

	// Horizontal Scroll
	var SectionHorizontalScroll = function( $scope, $ ) {
		var horizontalParent = $('.cea-horizontal-scroll-yes');
		var disable_mobile = horizontalParent.data("hs-disable");
		var horizontalChild = horizontalParent.children().addClass('cea-horizontal-scroll-main');
		var horizontalSections = horizontalChild.children().addClass('cea-horizontal-scroll-section');
		function horizontalScroll(scroll, windowWidth, windowHeight, disableMobile) {
			horizontalParent.each( function() {
				var $this = $(this),
            	container = $this.find('.e-con, .e-container').eq(0),
            	containerTop = $this.offset().top,
            	totalWidth = 0,
            	extraWidth = 0,
            	passed = scroll - containerTop,
            	translate = passed,
            	minHeight = $this.css('--min-height') ? $this.css('--min-height') : '100vh';

            	container.children('.elementor-element').each(function() {
            	    totalWidth += $(this).outerWidth() + parseFloat($(this).css('margin-left')) + parseFloat($(this).css('margin-right'));
            	});

            	if (windowWidth <= 1440 && disableMobile) {
            	    totalWidth = windowWidth;
            	    $this.addClass('hs-disabled');
            	} else {
            	    $this.removeClass('hs-disabled');
            	}

				$this.addClass('e-con-full');

				if( $this.hasClass('e-con-boxed') ) {
					$this.removeClass('e-con-boxed');
				}

            	$this.attr('total-width', totalWidth);

            	if (totalWidth > windowWidth) {
            	    extraWidth = totalWidth - windowWidth;
            	}

            	$this.height('calc(' + minHeight + ' + ' + extraWidth + 'px)');

            	if (passed < 0) {
            	    translate = 0;
            	}
            	if (passed > extraWidth) {
            	    translate = extraWidth;
            	}

            	var progress = translate / extraWidth;

            	if (progress <= 0) {
            	    $this.removeClass('fixed bottom');
            	}
            	if (progress > 0 && progress < 1) {
            	    $this.addClass('fixed');
            	    $this.removeClass('bottom');
            	}
            	if (progress >= 1) {
            	    $this.removeClass('fixed');
            	    $this.addClass('bottom');
            	}

            	container.css('transform', 'translateX(-' + translate + 'px)');
            	$this.css('--progress', progress);

            	if ($this.css('--progress-bar') && $this.css('--progress-bar') === 'true') {
            	    $this.removeClass('progress-bar-disabled');
            	} else {
            	    $this.addClass('progress-bar-disabled');
            	}
			});
		}
		function scrollActivity(delayCall = true) {
        	var scroll = $(window).scrollTop(),
        	    windowWidth = $(window).width(),
        	    windowHeight = $('.cea-100vh').height();
        	let disableMobile = false;

			if ( disable_mobile == 'yes' ) {
				disableMobile = true;
			} else {
				disableMobile = false;
			}

        	lastTime = new Date();
        	setTimeout(function() {
        	    currentTime = new Date();
        	    if (currentTime - lastTime > 200 && delayCall) {
        	        scrollActivity(false);
        	    }
        	}, 500);

        	horizontalScroll(scroll, windowWidth, windowHeight, disableMobile);
    	}
		if ( horizontalParent.length ) {
			$(window).on('load resize scroll', scrollActivity);
		}
	}

	// Text Reveal Animation
	var SectionTextRevealAnimation = function( $scope, $ ) {
		if( $('.text-reveal-yes').length ) {
			$('.text-reveal-yes').each(function() {
				var text_ele = $(this);
				var settings = text_ele.data('tag');
				var disableRepeat = text_ele.data("animate-repeat");
				var disableMobile = text_ele.data("disable-mobile");

				var textTag = settings.textTag;
				var styleType = (settings.styleType) ? settings.styleType : 'none';
				var animationDelay = (settings.aniDelay) ? settings.aniDelay : 0.005;
				var textContent = text_ele.find(textTag);
				
				var observer;
				
				function textRevealAnimation() {
					if (observer) {
                        observer.disconnect();
                    }
					const deviceWidth = $(window).width();
                    const isMobile = deviceWidth < 768;
					if (isMobile && disableMobile === 'yes') {
						textContent.removeClass(styleType).removeClass('animated-section-title');
						return;
					}

					observer = new IntersectionObserver(function (entries) {
						entries.forEach(function (entry) {
							if (disableRepeat === 'yes') {
								if (entry.isIntersecting) {
									$(entry.target).addClass(styleType);
									$(entry.target).css("opacity", 1);
									setInterval( function() {
										$(entry.target).addClass("animated-section-title");
									}, 500 );
								}
							} else {
								if (entry.isIntersecting) {
									$(entry.target).removeClass('animated-section-title');
									$(entry.target).addClass(styleType);
									$(entry.target).css("opacity", 1);
									setInterval( function() {
										$(entry.target).addClass("animated-section-title");
									}, 500 );
								} else {
									textContent.css("opacity", 0);
									$(entry.target).removeClass(styleType);
									$(entry.target).removeClass('animated-section-title');
								}
							}
						});
					}, {
						threshold: 0.5
					});

					observer.observe(textContent[0]);

					if (styleType !== "none") {
						const isRTL = $('html').attr('dir') === 'rtl';
						textContent.css({
							direction: 'ltr',
							'unicode-bidi': 'isolate'  // Prevents visual flipping in RTL
						});

						// Run SplitType
						const textSplitter = new SplitType(textContent[0], {
							types: "words, chars"
						});

						const animate_text = textContent.find(".char");
						animate_text.each(function (index) {
							$(this).css({
								animationDelay: (index + 1) * animationDelay + "s",
							});
						});

						textContent.css("opacity", 0);
					}
                    $(window).trigger('resize');
				}
				if ( textContent.length > 0 ) {
				    textRevealAnimation();
				    $(window).on('load', function() {
				    	textRevealAnimation();
				    });
				}
			});
		}
	}

	// List Step
	function ceaListStep( liststep_ele ) {

		const $container = $(liststep_ele);
        const $items = $container.find(".list-step-item");

        const $content = $container.find(".list-step-content");

        // Set initial container height
        $container.css("min-height", $container.outerHeight() + "px");

        function updateSticky() {
			const $parentTop = parseFloat($container.css("--stack-top"));
			const stickyStart = $parentTop;
			const wrapContainer = $container.data("wrap");
			const $width = $(window).width();
            // Mobile adjustments
            if (wrapContainer == "mobile") {
                if ($width < 767) {
                    $content.addClass("flex-column");
                } else {
					$content.removeClass("flex-column");
				}
            }
            else if (wrapContainer == "tablet") {
                if ($width < 1024) {
                    $content.addClass("flex-column");
                } else {
                    $content.removeClass("flex-column");
                }
            } else {
				// This is for None
			}
            if ($container.data("hide-sm") == "yes") {
                $items.find(".list-step-left").addClass("hide-on-mobile");
            }

            if (!isElementInViewport($container[0])) return;

            const scrollTop = $(window).scrollTop();
            const containerTop = $container.offset().top;
            const containerHeight = $container.outerHeight();
            const containerBottom = containerTop + containerHeight;

            // Reset all items first
            $items
                .css({
                    position: "",
                    top: "",
                    width: "",
                    zIndex: "",
                })
                .each(function () {
                    // Remove any existing placeholders
                    const $item = $(this);
                    if ($item.data("placeholder")) {
                        $item.data("placeholder").remove();
                        $item.removeData("placeholder");
                    }
                });

            // Find which item should be sticky
            let stickyIndex = -1;
            const lastItemIndex = $items.length - 1;
            const lastItem = $items.eq(lastItemIndex);
            const lastItemBottom = lastItem.offset().top + lastItem.outerHeight();

            $items.each(function (i) {
                const $item = $(this);
                const itemTop = $item.offset().top;
                const itemHeight = $item.outerHeight();
                if (itemTop - scrollTop <= stickyStart) {
                    stickyIndex = i;
                }
            });

            const itemHeight = $items.eq(0).outerHeight(); // assuming uniform height
            const totalStackHeight = (stickyIndex + 1) * itemHeight;
            const shouldReleaseAll = scrollTop + stickyStart + itemHeight >= containerBottom;
            const stickyOffset = scrollTop + stickyStart - containerTop;

            // Apply sticky behavior
            $items.each(function (i) {
                const $item = $(this);
                const itemHeight = $item.outerHeight();
                const itemMargin = parseInt($item.css("margin-bottom")) || 0;
                if ($item.data("placeholder")) {
                    $item.data("placeholder").remove();
                    $item.removeData("placeholder");
                }
                const isLast = i === $items.length - 1;
                if (shouldReleaseAll && isLast) {
                    $item.css({
                        position: "relative",
                        top: "",
                        width: "",
                        opacity: 1,
                    });
                } else if (shouldReleaseAll && !isLast) {
                    $item.css({
                        position: "relative",
                        top: "-" + stickyStart + "px",
                    });
                } else if (i === stickyIndex) {
                    $item.css({
                        position: "fixed",
                        top: stickyStart + "px",
                        width: $container.width() + "px",
                    });
                    const placeholder = $("<div>").css({
                        height: itemHeight + itemMargin + "px",
                        visibility: "hidden",
                    });
                    $item.data("placeholder", placeholder);
                    $item.after(placeholder);
                } else if (i <= stickyIndex) {
                    const distance = stickyIndex - i;
                    $item.css({
                        position: "fixed",
                        top: stickyStart + "px",
                        width: $container.width() + "px",
                        opacity: 1,
                        transition: "top 0.3s ease, opacity 0.3s ease",
                    });
                    const placeholder = $("<div>").css({
                        height: itemHeight + itemMargin + "px",
                        visibility: "hidden",
                    });
                    $item.data("placeholder", placeholder);
                    $item.after(placeholder);
                } else {
                    $item.css({
                        position: "relative",
                    });
                }
            });

            // Update container height in case it changed
            $container.css("min-height", $container.outerHeight() + "px");
        }

        // Helper function to check if element is in viewport
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            return (
                rect.top <=
                    (window.innerHeight ||
                        document.documentElement.clientHeight) &&
                rect.bottom >= 0
            );
        }

        // Throttled update with RAF for smoothness
        let ticking = false;
        function onScroll() {
            if (!ticking) {
                window.requestAnimationFrame(function () {
                    updateSticky();
                    ticking = false;
                });
                ticking = true;
            }
        }

        // Set up event listeners
        $(window).on("scroll", onScroll);
        $(window).on("resize", function () {
            $container.css("min-height", "auto");
            updateSticky();
            $container.css("min-height", $container.outerHeight() + "px");
        });

        // Initial setup
        updateSticky();
	
    }
    
    // Bubble Float
	function ceaBubbleFloat( bubblefloat_ele ) {
		var bubblefloat_ele = $(bubblefloat_ele);
		const canvas = bubblefloat_ele.find("#matter-bubbles-canvas")[0];

		var bubblesData = bubblefloat_ele.data('bubbles');
		if (typeof bubblesData === "string") {
			bubblesData = JSON.parse(bubblesData);
		}

		const { Engine, Render, Runner, Bodies, Composite, Mouse, MouseConstraint } = Matter;
		const engine = Engine.create();
    	const world = engine.world;
    	world.gravity.y = 1;

		const width = bubblefloat_ele.width();
    	const height = bubblefloat_ele.height();

		canvas.width = width;
    	canvas.height = height;

		const render = Render.create({
			canvas,
			engine,
			options: {
				width: width,
				height: height,
				wireframes: false,
				background: 'none'
			}
		});

		Render.run(render);
    	Runner.run(Runner.create(), engine);

		const bubbles = [];

		for (let i = 0; i < bubblesData.length; i++) {	
			const data = bubblesData[i];
			const radius = data.size ? parseInt(data.size) : 90;
    		const spacing = 80; 
    		const x = Math.random() * (width - 2 * radius) + radius;
    		const y = 100 + i * spacing; 

			let bubble;
			if (data.shape === 'rectangle') {
				bubble = Bodies.rectangle(x, y, radius * 2, radius * 2, {
					restitution: 0.9,
					friction: 0.001,
					inertia: Infinity,
					density: 0.001,
					render: {
						visible: false,
					}
				});
				bubble.circleRadius = radius; 
			} else if (data.shape === 'polygon') {
				const sides = data.sides ? parseInt(data.sides) : 5;
				bubble = Bodies.polygon(x, y, sides, radius, {
					restitution: 0.9,
					friction: 0.001,
					inertia: Infinity,
					density: 0.001,
					render: {
						visible: false,
					}
				});
				bubble.circleRadius = radius;
			} else {
				// Default to circle
				bubble = Bodies.circle(x, y, radius, {
					restitution: 0.9,
					friction: 0.001,
					inertia: Infinity,
					density: 0.001,
					render: {
						visible: false,
					}
				});
				bubble.circleRadius = radius;
			}

			// bubble.className = 'featured-bubble';
			bubble.label = data.text;
			bubble.bubbleStyle = data;
        	Composite.add(world, bubble);
        	bubbles.push(bubble);
    	}

		// Add floor and walls
		const wallOptions = {
			isStatic: true,
			render: {
				visible: false
			}
		};

		const ground = Bodies.rectangle(width / 2, height + 20, width, 40, wallOptions);
		const leftWall = Bodies.rectangle(-20, height / 2, 40, height, wallOptions);
		const rightWall = Bodies.rectangle(width + 20, height / 2, 40, height, wallOptions);
		const ceiling = Bodies.rectangle(width / 2, -20, width, 40, wallOptions);


		Composite.add(world, [ground, leftWall, rightWall, ceiling]);

		// Mouse drag support
		const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
		const mouse = Mouse.create(render.canvas);
		const mouseConstraint = MouseConstraint.create(engine, {
			mouse,
			constraint: {
				stiffness: 0.2,
				render: { visible: false }
			}
		});
		if (!isTouchDevice) {
			Composite.add(world, mouseConstraint);
		}
	
		render.mouse = mouse;

		let hoveredBubble = null;

		// Listen for mousemove on the canvas
		canvas.addEventListener('mousemove', function(event) {
		    const rect = canvas.getBoundingClientRect();
		    const mouseX = event.clientX - rect.left;
		    const mouseY = event.clientY - rect.top;
		
		    hoveredBubble = null;
		    for (let bubble of bubbles) {
		        const dx = mouseX - bubble.position.x;
		        const dy = mouseY - bubble.position.y;
		        if (Math.sqrt(dx * dx + dy * dy) < bubble.circleRadius) {
		            hoveredBubble = bubble;
		            break;
		        }
		    }
		});

		canvas.addEventListener('wheel', (e) => {
			// Only prevent default if you're implementing zoom/pan
			// e.preventDefault(); ← avoid unless necessary
		  }, { passive: true }); // passive improves performance
		  
	
		// Add names inside bubbles (via canvas overlay)
		Matter.Events.on(render, 'afterRender', () => {
			const ctx = render.context;
			for (let bubble of bubbles) {
				const pos = bubble.position;
				const style = (bubble === hoveredBubble && bubble.bubbleStyle.color_hover) ? {
					fill: bubble.bubbleStyle.background_hover,
					stroke: bubble.bubbleStyle.border_hover,
					text: bubble.bubbleStyle.color_hover
				} : {
					fill: bubble.bubbleStyle.background,
					stroke: bubble.bubbleStyle.border,
					text: bubble.bubbleStyle.color
				};
				const fontFamily = bubble.bubbleStyle.font_family || 'Arial';
				const fontWeight = bubble.bubbleStyle.font_weight || 'normal';
				const fontSize = bubble.bubbleStyle.font_size || 32;
				const fontSizeUnit = bubble.bubbleStyle.font_size_unit || 'px';

				ctx.save();
				ctx.beginPath();
				if (bubble.bubbleStyle.shape === 'rectangle') {
					ctx.rect(
						pos.x - bubble.circleRadius,
						pos.y - bubble.circleRadius,
						bubble.circleRadius * 2,
						bubble.circleRadius * 2
					);
				} else if (bubble.bubbleStyle.shape === 'polygon') {
					const sides = bubble.bubbleStyle.sides || 5;
					const radius = bubble.circleRadius;
					const pos = bubble.position;
					const rotation = bubble.angle || 0;

					for (let j = 0; j < sides; j++) {
						const angle = (j / sides) * 2 * Math.PI - Math.PI / 2;
						const px = pos.x + bubble.circleRadius * Math.cos(angle);
						const py = pos.y + bubble.circleRadius * Math.sin(angle);
						if (j === 0) ctx.moveTo(px, py);
						else ctx.lineTo(px, py);
					}
					ctx.closePath();
				} else {
					// Only draw the circle if the shape is not polygon or rectangle
					ctx.arc(pos.x, pos.y, bubble.circleRadius, 0, 2 * Math.PI);
				}
				ctx.fillStyle = style.fill || '#fff';
				ctx.fill();
				ctx.strokeStyle = style.stroke || '#000';
				ctx.lineWidth = 1;
				ctx.stroke();

        		// --- IMAGE OR TEXT ---
				const bubbleImageCache = {};
        		if (bubble.bubbleStyle.image) {
					if (!bubbleImageCache[bubble.bubbleStyle.image]) {
						const img = new window.Image();
						img.src = bubble.bubbleStyle.image;
						bubbleImageCache[bubble.bubbleStyle.image] = img;
					}
        		    const img = bubbleImageCache[bubble.bubbleStyle.image];
   	 				if (img.complete && img.naturalWidth !== 0) {
        		        ctx.save();
						ctx.clip();
						
						const shapeSize = bubble.circleRadius * 2;
        				const imgRatio = img.width / img.height;
        				const shapeRatio = 1; // shape is a square box

        				let drawWidth, drawHeight, dx, dy;
        				if (imgRatio > shapeRatio) {
        				    // Image is wider: fit height, crop sides
        				    drawHeight = shapeSize;
        				    drawWidth = img.width * (shapeSize / img.height);
        				    dx = pos.x - drawWidth / 2;
        				    dy = pos.y - drawHeight / 2;
        				} else {
        				    // Image is taller: fit width, crop top/bottom
        				    drawWidth = shapeSize;
        				    drawHeight = img.height * (shapeSize / img.width);
        				    dx = pos.x - drawWidth / 2;
        				    dy = pos.y - drawHeight / 2;
        				}
        		        ctx.drawImage(
							img,
							dx,
							dy,
							drawWidth, 
							drawHeight
						);
        		        ctx.restore();
        		    }
        		} else {
        		    // Draw label/text
        		    ctx.font = `${fontWeight} ${fontSize}${fontSizeUnit} ${fontFamily}`;
        		    ctx.fillStyle = style.text || '#000';
        		    ctx.textAlign = 'center';
        		    ctx.textBaseline = 'middle';
        		    ctx.fillText(bubble.label, pos.x, pos.y);
        		}
        		ctx.restore();
			}
		});
			
	}

	// Column Sticky 
	var SectionColumnSticky = function ($scope, $) {
		if (jQuery('.sticky-sidebar').length) {
			jQuery('body').addClass('sticky-sidebar_init');
			jQuery('.sticky-sidebar').each(function () {
				var stickyElement = jQuery(this);
				stickyElement.theiaStickySidebar({
					additionalMarginTop: 150,
					additionalMarginBottom: 30,
					containerSelector: stickyElement.closest('.elementor-section, .elementor-column, .elementor-container'), 
					sidebarBehavior: 'modern',
					resizeSensor: true,
					minWidth: 1024
				});
			});
		}
		// Handle other sticky layout elements
		if (jQuery('.sticky_layout .info-wrapper').length) {
			jQuery('.sticky_layout .info-wrapper').each(function () {
				jQuery(this).theiaStickySidebar({
					additionalMarginTop: 150,
					additionalMarginBottom: 150
				});	
			});
		}
	};

	/* Rain Drops and Parallax Handler */
	var SectionContainerOptionsHandler = function( $scope, $ ) {
	if ( $scope.is('div')){
			if ( $scope.is('div[data-cea-float]' ) ){
				ceaSectionFloatParallax( $scope );
			}
			if ( $scope.is('div[data-cea-raindrops]' ) ){
				ceaSectionRainDrops( $scope );
			}
			if ( $scope.is('div[data-cea-parallax-data]' ) ){
				ceaSectionParallax( $scope );
			}
		}
	};
	
	/* Content Slider Handler */
	var ColumnCustomOptionsHandler = function( $scope, $ ) {
		if ( $scope.is('.elementor-element.elementor-column' ) ){
			if ( $scope.is('.elementor-element.elementor-column[data-cea-slide]' ) ){
				ceaContentSlider( $scope );
			}
		}
	};
	
	/* Toggle Content Handler */
	var WidgetToggleContentHandler = function( $scope, $ ) {
		if( $scope.find(".toggle-content-wrapper").length ){
			$scope.find('.toggle-content-wrapper').each(function( index ) {
				ceaToggleContent( this );
			});
			$( window ).resize(function() {
				setTimeout( function() {
					$scope.find('.toggle-content-wrapper').each(function( index ) {
						ceaToggleContent( this );
					});
				}, 100 );
			});
		}
	};
	
	/* Tabs Handler */
	var WidgetCeaTabHandler = function( $scope, $ ) {
		if( $scope.find(".cea-tab-elementor-widget").length ){
			$scope.find('.cea-tab-elementor-widget').each(function( index ) {
				ceaTabContent( this );
			});
			
			//Call Every Element
			CeaCallEveryElement($scope)
		}
	};
	
	/* Accordion Handler */
	var WidgetCeaAccordionHandler = function( $scope, $ ) {
		if (!window._ceaAccordionsLogged) {
			window._ceaAccordionsLogged = true;
			var $allAccordions = $('.cea-accordion-elementor-widget');
			$allAccordions.each(function(index) {
				ceaAccordionContent(this, index);
			});
		}
	};

	/* Draw SVG Handler */
	var WidgetCeaDrawSVGHandler = function( $scope, $ ) {
		if ($scope.find(".cea-svg-draw-container").length) {
            $scope.find(".cea-svg-draw-container").each(function (index) {
                ceaDrawSVGContent(this);
            });
        }
	};

	/* Text Image Handler */
	var WidgetTextImageHandler = function ($scope, $) {
		if ($scope.find(".cea-text-image").length) {
			$scope.find('.cea-text-image').each(function (index) {
				ceaTextImageContent(this);
			});
		}
	};

	/* Image Zoom */
	var WidgetImageZoomHandler = function ( $scope, $ ) {
		if( $scope.find('.image-zoom-scroll').length ) {
			$scope.find('.image-zoom-scroll').each(function ( $index ) {
				ceaImageZoom(this);
			});
		}
		if( $scope.find(".cea-zoom-video").length ) {
			$scope.find(".cea-zoom-video").each(function () {
				ceaVideoZoom(this);
			});
		}
		if ($scope.find("[zoom_grid_container]").length) {
            $scope.find("[zoom_grid_container]").each(function ($index) {
                ceaZoomImageGrid(this);
            });
        }
	}

	/* List Step */
	var WidgetListStepHandler = function( $scope, $ ) {
		if( $scope.find('.list-step').length ) {
			$scope.find('.list-step').each(function ( $index ) {
				ceaListStep(this);
			});
		}
	}
	
	/* Bubble Float */
	var WidgetBubbleFloatHandler = function( $scope, $ ) {
		if( $scope.find('.cea-bubbles-widget').length ) {
			$scope.find('.cea-bubbles-widget').each( function ( $index ) {
				ceaBubbleFloat( this );
			} );
		}
	}
	
	/* Switcher Content Handler */
	var WidgetSwitcherContentHandler = function( $scope, $ ) {
		if( $scope.find(".switcher-content-wrapper").length ){
			$scope.find('.switcher-content-wrapper').each(function( index ) {
				ceaSwitcherContent( this );
			});
			
			//Call Every Element
			CeaCallEveryElement($scope)
		}
	};
	
	/* Offcanvas Handler */
	var WidgetCeaOffcanvasHandler = function( $scope, $ ) {
		if( $scope.find(".cea-offcanvas-elementor-widget").length ){
			$scope.find('.cea-offcanvas-elementor-widget').each(function( index ) {
				ceaOffcanvasContent( this );
			});
						
			$(document).find(".cea-offcanvas-close").on( "click", function(){
				$("body").removeClass("cea-offcanvas-active");	
				$(this).parent(".cea-offcanvas-wrap").removeClass("active");
				var ani_type = $(this).parent(".cea-offcanvas-wrap").data("canvas-animation");
				if( ani_type == 'left-push' ){
					$("body").css({"margin-left":"", "margin-right":""});
				}else if( ani_type == 'right-push' ){
					$("body").css({"margin-left":"", "margin-right":""});
				}	
				return false;
			});
		}
	};

	var WidgetSectionTitleHandler = function( $scope, $ ) {
		if( $scope.find('.section-title').length ) {
			$scope.find(".section-title").each(function( index ) {
				ceaSectionTitle( this );
			});
		}
	}
	
	/* Video playlist Handler */
	var WidgetVideoPlaylistHandler = function( $scope, $ ) {
		if( $scope.find('.cea-video-audio-widget').length ){
			$scope.find('.cea-video-audio-widget').each(function( index ) {
				ceaVideoPlaylist( this );
			});
		}	
	}
	/* Tilt Handler */
	var WidgetTiltHandler = function( $scope, $ ) {
		if( $scope.find(".cea-tilt").length ){
			$scope.find( '.cea-tilt' ).each(function() {
				ceaTilt( this );
			});
		}
	};
	
	/* All in One Handler */
	var WidgetAllInOneHandler = function( $scope, $ ) {		
		CeaCallEveryElement($scope);			
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		
		// Common Shortcodes
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaanimatedtext.default', WidgetAnimateTextHandler );	
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceabutton.default', WidgetButtonHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceacircleprogress.default', WidgetCircleProgressHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceacounter.default', WidgetCounterUpHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceadaycounter.default',WidgetDayCounterHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/imagebeforeafter.default', WidgetImageBeforeAfterHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceamailchimp.default', WidgetMailchimpHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaimagegrid.default', WidgetOwlCarouselHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaimagegrid.default', WidgetPoupHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceasliderwidget.default', WidgetOwlCarouselHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceasliderwidget.default', WidgetPoupHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceamodalpopup.default', WidgetModalPopupHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceatimeline.default', WidgetAgonHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceagooglemap.default', WidgetCEAMapHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceatimelineslide.default', WidgetTimelineSliderHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceachart.default', WidgetChartHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/carousel3d.default', WidgetCloud9CarouselHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/raindrops.default', WidgetRainDropsHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceapopover.default', WidgetPopoverHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceapopupanything.default', WidgetPopupAnythingHandler );	
		//elementorFrontend.hooks.addAction( 'frontend/element_ready/ceamodalpopup.default', WidgetModalPopupHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/togglecontent.default', WidgetToggleContentHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceatab.default', WidgetCeaTabHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaaccordion.default', WidgetCeaAccordionHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceadrawsvg.default', WidgetCeaDrawSVGHandler );
		elementorFrontend.hooks.addAction('frontend/element_ready/ceatextimage.default', WidgetTextImageHandler);
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaimagezoom.default', WidgetImageZoomHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/cealiststep.default', WidgetListStepHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceabubblefloat.default', WidgetBubbleFloatHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaswitchercontent.default', WidgetSwitcherContentHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaoffcanvas.default', WidgetCeaOffcanvasHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceasectiontitle.default', WidgetSectionTitleHandler );
		
		// Post Type Shortcodes
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaposts.default', WidgetIsotopeHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaposts.default', WidgetOwlCarouselHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaposts.default', WidgetMouseCursorHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaposts.default', WidgetImageAccordionHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/cearecentpopular.default', WidgetRecentPopularToggleHandler );
		
		//Isotopes for custom post types
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaservice.default', WidgetIsotopeHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceateam.default', WidgetIsotopeHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceatestimonial.default', WidgetIsotopeHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaevent.default', WidgetIsotopeHandler );
		
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceafeaturebox.default', WidgetTiltHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceacounter.default', WidgetTiltHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaimagegrid.default', WidgetTiltHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceasliderwidget.default', WidgetTiltHandler );
		
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaevent.default', WidgetTiltHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceateam.default', WidgetTiltHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaservice.default', WidgetTiltHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceatestimonial.default', WidgetTiltHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaportfolio.default', WidgetTiltHandler );
		
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceateam.default', WidgetOwlCarouselHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaevent.default', WidgetOwlCarouselHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceatestimonial.default', WidgetOwlCarouselHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaportfolio.default', WidgetIsotopeHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaportfolio.default', WidgetOwlCarouselHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaportfolio.default', WidgetPoupHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaservice.default', WidgetOwlCarouselHandler );
		
		// Container Related Shortcodes
		elementorFrontend.hooks.addAction( 'frontend/element_ready/section', SectionCustomOptionsHandler ); 
		elementorFrontend.hooks.addAction( 'frontend/element_ready/container', SectionContainerOptionsHandler ); 
		elementorFrontend.hooks.addAction( 'frontend/element_ready/column', ColumnCustomOptionsHandler );

		// Custom Post Type Handler
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaevent.default', WidgetCPTHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceateam.default', WidgetCPTHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceatestimonial.default', WidgetCPTHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaportfolio.default', WidgetCPTHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaservice.default', WidgetCPTHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaevent.default', WidgetImageAccordionHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceateam.default', WidgetImageAccordionHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceatestimonial.default', WidgetImageAccordionHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaportfolio.default', WidgetImageAccordionHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceaservice.default', WidgetImageAccordionHandler );
	
		//All in one handler		
		elementorFrontend.hooks.addAction( 'frontend/element_ready/contentcarousel.default', WidgetAllInOneHandler );

		// Content Parallax
		elementorFrontend.hooks.addAction( 'frontend/element_ready/section', SectionContentParallax );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/column', SectionContentParallax );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/container', SectionContentParallax );
		
		elementorFrontend.hooks.addAction( 'frontend/element_ready/section', WidgetMousePointerHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/column', WidgetMousePointerHandler );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/container', WidgetMousePointerHandler );
		
		//Columns Sticky 
		elementorFrontend.hooks.addAction( 'frontend/element_ready/section', SectionColumnSticky );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/column', SectionColumnSticky );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/container', SectionColumnSticky );

		// Auto Activate 
		elementorFrontend.hooks.addAction( 'frontend/element_ready/section', SectionAutoActivate );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/column', SectionAutoActivate );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/container', SectionAutoActivate );
		
		//Row Sticky 
		elementorFrontend.hooks.addAction( 'frontend/element_ready/section', SectionRowSticky );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/column', SectionRowSticky );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/container', SectionRowSticky );
		
		// Text Reveal Scroll
		elementorFrontend.hooks.addAction("frontend/element_ready/section", SectionTextRevealAnimation);
		elementorFrontend.hooks.addAction("frontend/element_ready/container", SectionTextRevealAnimation);
		elementorFrontend.hooks.addAction("frontend/element_ready/column", SectionTextRevealAnimation);		

		// Horizontal Scroll
		elementorFrontend.hooks.addAction("frontend/element_ready/section", SectionHorizontalScroll);
		elementorFrontend.hooks.addAction("frontend/element_ready/container", SectionHorizontalScroll);
		elementorFrontend.hooks.addAction("frontend/element_ready/column", SectionHorizontalScroll);
		
		// List Step Scroll
		elementorFrontend.hooks.addAction("frontend/element_ready/section", SectionListScroll);
		elementorFrontend.hooks.addAction("frontend/element_ready/container", SectionListScroll);
		elementorFrontend.hooks.addAction("frontend/element_ready/column", SectionListScroll);
    
		// Video Playlist 
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceavideoplaylist.default', WidgetVideoPlaylistHandler );

	} );
	
	$( window ).on( 'load', function() {
		if( !$("body.elementor-editor-active").length ){	
		}
	} );
	
	function CeaCallEveryElement($scope){
		$(document).find('.cea-typing-text').each(function( index ) {
			ceaAnimatedTextSettings( this, index );
		});
		
		$(document).find('.isotope').each(function() {
			ceaIsotopeLayout( this );
		});
		
		if( $(document).find('.circle-progress-circle').length ){
			var circle_ele = $(document).find('.circle-progress-circle');
			ceaCircleProgresSettings(circle_ele);
		}
		
		$(document).find('.owl-carousel').each(function() {
			ceaOwlSettings( this );
		});
		
		if( $(document).find('.counter-up').length ){
			var counter_ele = $(document).find('.counter-up');
			ceaCounterUpSettings(counter_ele);
		}
		
		$(document).find('.day-counter').each(function() {
			ceaDayCounterSettings( this );
		});	
		
		/* Chart Handler */
		$(document).find('.pie-chart').each(function() {
			ceaPieChartSettings( this );
		});		
		$(document).find('.line-chart').each(function() {
			ceaLineChartSettings( this );
		});		

		if( $(document).find('.modal-popup-wrapper.page-load-modal').length ){
			var modal_id = $(document).find('.modal-popup-wrapper.page-load-modal .modal').attr("id");
			$('#'+modal_id).modal('show');
		}
		
		if( $(document).find(".cloud9-carousel").length ){
			$(document).find( '.cloud9-carousel' ).each(function() {
				ceaCloud9Carousel( this );
			});
		}
		
		if( $(document).find(".canvas_agon").length ){
			$(document).find( '.canvas_agon' ).each(function() {
				ceaAgon( this );
			});
		}
		
		if( $(document).find('.cd-horizontal-timeline').length ){
			var cur_ele = $(document).find('.cd-horizontal-timeline');
			var line_dist = cur_ele.data("distance") ? cur_ele.data("distance") : 60;
			cur_ele.zozotimeline({
				distance: line_dist
			});
		}
		
		if( $(document).find(".ceagmap").length ){
			initCEAGmap();
		}
	}
	
	function cea_scroll_animation(c_elem){
		setTimeout( function() {
			var anim_time = 300;
			$(c_elem).find('.cea-animate:not(.run-animate)').each( function() {
				
				var elem = $(this);
				var bottom_of_object = elem.offset().top;
				var bottom_of_window = $(window).scrollTop() + $(window).height();
				
				if( bottom_of_window > bottom_of_object ){
					setTimeout( function() {
						elem.addClass("run-animate");
					}, anim_time );
				}
				anim_time += 300;
				
			});
		}, 300 );
	}
	

	function ceaOffcanvasContent( offcanvas_ele ){
		var offcanvas_ele = $(offcanvas_ele);	

		if( $(document).find(".cea-offcanvas-id-to-element").length && ! $("body.elementor-editor-active").length ){
			$(document).find(".cea-offcanvas-id-to-element").each(function( index ) {
				var offcanvas_id_ele = $(this).data("id");
				var clone_offcanvas = $("#"+offcanvas_id_ele).clone();
				$(document).find("#"+offcanvas_id_ele).remove();
				$(this).replaceWith(clone_offcanvas);
			});
		}
		
		$(offcanvas_ele).find(".cea-offcanvas-trigger").on( "click", function(){
			$("body").toggleClass("cea-offcanvas-active");
			var offcanvas_id = $(this).data("offcanvas-id");
			if( $('#'+offcanvas_id).length ){
				$('#'+offcanvas_id).addClass("active");
				var ani_type = $('#'+offcanvas_id).data("canvas-animation");
				if( ani_type == 'left-push' ){
					$("body").css({"margin-left": $('#'+offcanvas_id).outerWidth() +"px", "margin-right": "-"+ $('#'+offcanvas_id).outerWidth() +"px"});
				}else if( ani_type == 'right-push' ){
					$("body").css({"margin-left": "-"+ $('#'+offcanvas_id).outerWidth() +"px", "margin-right": $('#'+offcanvas_id).outerWidth() +"px"});
				}
			}
			setTimeout( function() {
				CeaCallEveryElement(document);
			}, 350 );
			return false;
		});
	}

	function ceaSectionTitle(title_ele) {
		var title_ele = $(title_ele);
		var animationTitle = title_ele.attr('data-animation');
		var disableRepeat = title_ele.data('animate-repeat');
		var disableMobile = title_ele.data('disable-mobile');
		var observer;

		function setupAnimation() {
			if (observer) {
				observer.disconnect();
			}
	
			const deviceWidth = $(window).width();
			const isMobile = deviceWidth < 768;
	
			if (isMobile && disableMobile === 'yes') {
				title_ele.removeClass(animationTitle).removeClass('animated-section-title');
				return;
			}
	
			observer = new IntersectionObserver(function (entries) {
				entries.forEach(function (entry) {
					if (disableRepeat === 'yes') {
						if (entry.isIntersecting) {
							$(entry.target).addClass(animationTitle);
							setTimeout(function () {
								$(entry.target).addClass("animated-section-title");
							}, 500);
						}
					} else {
						if (entry.isIntersecting) {
							$(entry.target).removeClass('animated-section-title');
							$(entry.target).addClass(animationTitle);
							setTimeout(function () {
								$(entry.target).addClass("animated-section-title");
							}, 500);
						} else {
							$(entry.target).removeClass(animationTitle).removeClass('animated-section-title');
						}
					}
				});
			}, {
				threshold: 0.5
			});
	
			observer.observe(title_ele[0]);
	
			if (animationTitle !== 'none') {
				var textSplitter = new SplitType(title_ele, {
					types: "words, chars"
				});
	
				if (title_ele.hasClass("cea-nrml")) {
					var letter_animate = title_ele.find(".char");
					letter_animate.each(function (index) {
						$(this).css({
							animationDelay: (index + 1) * 0.05 + "s",
						});
					});
				}
			}
		}

		setupAnimation();
	
		$(window).on('resize', function () {
			setupAnimation();
		});
	}
	

	function ceaSwitcherContent( switcher_ele ){
		var switcher_ele = $(switcher_ele);
		
		if( switcher_ele.find(".cea-switcher-id-to-element").length && ! $("body.elementor-editor-active").length ){
			switcher_ele.find(".cea-switcher-id-to-element").each(function( index ) {
				var switcher_id_ele = $(this).data("id");
				var clone_tab = $("#"+switcher_id_ele).clone();
				$(document).find("#"+switcher_id_ele).remove();
				$(this).replaceWith(clone_tab);
			});
		}
		
		$(switcher_ele).find(".switch-checkbox").on( "change", function(){
			$(switcher_ele).find(".cea-switcher-content > div").fadeOut(0);
			if( this.checked ){
				$(this).parents("ul").find("li").removeClass("switcher-active");
				$(this).parents("ul").find(".cea-secondary-switch").addClass("switcher-active");
				$(switcher_ele).find(".cea-switcher-content > div.cea-switcher-secondary").fadeIn(350);
			}else{
				$(this).parents("ul").find("li").removeClass("switcher-active");
				$(this).parents("ul").find(".cea-primary-switch").addClass("switcher-active");
				$(switcher_ele).find(".cea-switcher-content > div.cea-switcher-primary").fadeIn(350);
			}
		});	
	}
	
	function ceaAccordionContent(accordion_ele, index) {
		var accordion_ele = $(accordion_ele);
		
		if (accordion_ele.find(".cea-accordion-id-to-element").length && !$("body.elementor-editor-active").length) {
			accordion_ele.find(".cea-accordion-id-to-element").each(function(index) {
				var accordion_id_ele = $(this).data("id");
				var clone_tab = $("#" + accordion_id_ele).clone();
				$(document).find("#" + accordion_id_ele).remove();
				$(this).replaceWith(clone_tab);			
			});
		}
		
		$(accordion_ele).find(".cea-accordion-header a").on("click", function() {
			var cur_tab = $(this);
			var accordion_id = $(cur_tab).attr("href");
			var accordion_wrap = $(cur_tab).parents(".cea-accordion-elementor-widget");
	
			if ($(accordion_wrap).data("toggle") == 1) {
				$(accordion_wrap).find(".cea-accordion-header a").toggleClass("active");
				$(accordion_wrap).find(accordion_id).slideToggle(350);
			} else {
				if (!cur_tab.hasClass("active")) {				
					$(accordion_wrap).find(".cea-accordion-header a").removeClass("active");
					$(cur_tab).addClass("active");
					$(accordion_wrap).find(".cea-accordion-content").slideUp(350);
					$(accordion_wrap).find(accordion_id).slideDown(350);
				} else {
					$(cur_tab).removeClass("active");
					$(accordion_wrap).find(".cea-accordion-content").slideUp(350);
				}
			}
			return false;
		});
	
		var randId = index + 1;

		$("#search-input-" + randId).on("keyup", function() {
			var searchTerm = $(this).val().toLowerCase();
			$("#cea-accordion-" + randId + " .cea-accordion").each(function() {
				var questionText = $(this).find(".cea-accordion-header a").text().toLowerCase();
				var answerText = $(this).find(".cea-accordion-content .cea-accordion-pane").text().toLowerCase();
				if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		});
	}

	function ceaDrawSVGContent( drawsvg_ele ) {
        const draw_svg = $(drawsvg_ele);

        if (!draw_svg.hasClass("cea-svg-animated")) {
            return;
        }

        const duration = draw_svg.data("svg");
        const shouldPauseOnHover = draw_svg.data("hover-pause");

        let animate_type = "";
        if (draw_svg.hasClass("cea-draw-svg-on-load")) {
            animate_type = "onLoad";
        } else if (draw_svg.hasClass("cea-draw-svg-on-scroll")) {
            animate_type = "onScroll";
        } else if (draw_svg.hasClass("cea-draw-svg-on-hover")) {
            animate_type = "onHover";
        }
        const svg_ele = draw_svg.find("svg");
        const path = svg_ele.find("path");
        if (!path.length) return;

        const totalLength = path[0].getTotalLength();
        path.css({
            "stroke-dasharray": totalLength,
            "stroke-dashoffset": totalLength,
            transition: "stroke-dashoffset 0.02s ease-out",
        });

        let isPaused = false;
        let animationFrameId = null;

        function animateOnLoad(path, totalLength, shouldPauseOnHover) {
            let timeoutId = null;
            let startTime = null;
            let remainingTime = duration * 1000;
            let isDrawing = false;
            let rafId = null;

            function animate(offsetFrom, offsetTo, time, callback) {
                path.css({
                    "stroke-dasharray": totalLength,
                    "stroke-dashoffset": offsetFrom,
                    transition: `stroke-dashoffset ${time / 1000}s linear`,
                });

                // Trigger layout recalculation before setting the final offset
                path[0].getBoundingClientRect();
                path.css("stroke-dashoffset", offsetTo);

                startTime = Date.now();
                remainingTime = time;

                timeoutId = setTimeout(() => {
                    callback();
                }, time + 50); // Slight buffer
            }

            function draw() {
                isDrawing = true;
                animate(totalLength, 0, duration * 1000, () => {
                    erase();
                });
            }

            function erase() {
                isDrawing = false;
                animate(0, totalLength, duration * 1000, () => {
                    draw();
                });
            }

            function pauseAnimation() {
                const elapsed = Date.now() - startTime;
                remainingTime -= elapsed;

                // Stop current transition
                const computedOffset = parseFloat(
                    getComputedStyle(path[0]).strokeDashoffset
                );
                path.css({
                    transition: "none",
                    "stroke-dashoffset": computedOffset,
                });

                clearTimeout(timeoutId);
                cancelAnimationFrame(rafId);
            }

            function resumeAnimation() {
                const currentOffset = parseFloat(
                    getComputedStyle(path[0]).strokeDashoffset
                );
                const targetOffset = isDrawing ? 0 : totalLength;

                animate(currentOffset, targetOffset, remainingTime, () => {
                    if (isDrawing) {
                        erase();
                    } else {
                        draw();
                    }
                });
            }

            if (shouldPauseOnHover == "yes") {
                path.parent().on("mouseenter", pauseAnimation);
                path.parent().on("mouseleave", resumeAnimation);
            }

            erase(); // Start with erase
        }

        function animateOnScroll(svgEle, path, totalLength) {
            function updateDraw() {
                const svgTop = svgEle.offset().top;
                const scrollTop = $(window).scrollTop();
                const windowHeight = $(window).height();

                const scrollY = scrollTop;
                const elementTopInView = svgTop - scrollY;

                const startTrigger = windowHeight * 0.7;
                const endTrigger = windowHeight * 0.3;

                let progress =
                    (startTrigger - elementTopInView) /
                    (startTrigger - endTrigger);
                progress = Math.min(Math.max(progress, 0), 1); // Clamp between 0 and 1

                progress = Math.pow(progress, 0.9);

                path.css("transition", "none");
                path.css("stroke-dashoffset", totalLength * (1 - progress));
            }
            $(window).on("scroll resize", updateDraw);
            updateDraw();
        }
        function animateOnHover(path, totalLength, duration) {
        	let direction = 1; // 1 = draw, -1 = erase
        	let animationFrameId = null;
        	let lastTimestamp = null;
        	let progress = 0; // range [0, 1]
        	let isHovering = false;

        	function animate(timestamp) {
        		if (!isHovering) return;

        		if (!lastTimestamp) lastTimestamp = timestamp;
        		const deltaTime = (timestamp - lastTimestamp) / 1000;
        		lastTimestamp = timestamp;
        		// Update progress
        		progress += (deltaTime / duration) * direction;
        		progress = Math.max(0, Math.min(1, progress));

        		// Update stroke-dashoffset
        		path.css("stroke-dashoffset", totalLength * (1 - progress));

        		// If at either end, reverse direction
        		if (progress === 1 || progress === 0) {
        			direction *= -1;
        		}
        		animationFrameId = requestAnimationFrame(animate);
        	}

        	// Hover handlers
        	path.parent().hover(
        		function () {
        			if (!isHovering) {
        				isHovering = true;
        				lastTimestamp = null;
        				animationFrameId = requestAnimationFrame(animate);
        			}
        		},
        		function () {
        			isHovering = false;
        			if (animationFrameId) {
        				cancelAnimationFrame(animationFrameId);
        				animationFrameId = null;
        				lastTimestamp = null; // Keep progress, just pause
        			}
        		}
        	);

        	// Initial stroke setup
        	path.css({
        		"stroke-dasharray": totalLength,
        		"stroke-dashoffset": totalLength,
        	});
        }
        if (animate_type == "onLoad") {
            animateOnLoad(path, totalLength, shouldPauseOnHover);
        } else if (animate_type == "onScroll") {
            animateOnScroll(svg_ele, path, totalLength);
        } else if (animate_type == "onHover") {
            animateOnHover(path, totalLength, duration);
        }
    }

	function ceaTextImageContent(textimage_ele) {

		var textimage_ele = $(textimage_ele);
		var settings = textimage_ele.data("settings");
		var ele_cls = settings.element_cls;
		var wid_cls = settings.widget_cls;
		var img_animation = settings.img_animation;
		var animation_delay = settings.ani_delay;

		function ceaTextresize() {
			var mobileDisable = textimage_ele.data("mobile-hide");
			var $width = $(window).width();
			if (mobileDisable == "yes" && $width <= 768) {
				$(".cursor-image").remove();
            } else {
                var cursorContainer = $(
                    '<div class="cursor-image animate__animated animate__' +
                        img_animation +
                        " " +
                        ele_cls +
                        '" data-delay="' +
                        animation_delay +
                        '"></div></div>'
                );
                $("body").append(cursorContainer);
                var widgetContainer = $('<div class="' + wid_cls + '">');
                cursorContainer.html(widgetContainer);

                const key = [];

                for (const i in settings.link_image) {
                    key.push(i);
                }

                key.forEach((value) => {
                    value = value.replace(/[.,]/g, '_');
                    textimage_ele
                        .find("." + value)
                        .on("mousemove", function (event) {
                            widgetContainer.html(
                                '<img class="cursor-photo" src="' +
                                    settings.link_image[value] +
                                    '" alt="img-' +
                                    value +
                                    '">'
                            );
                            cursorContainer.css({
                                top: event.clientY + "px",
                                left: event.clientX + "px",
                                display: "block",
                            });
                        });

                    textimage_ele
                        .find("." + value)
                        .on("mouseleave", function () {
                            cursorContainer.css({
                                display: "none",
                            });
                        });
                });
            }
		}

		$(window).on("resize", ceaTextresize);
	
		ceaTextresize();

	}
	
	function ceaTabContent( tabs_ele ){
		var tabs_ele = $(tabs_ele);
		
		if( tabs_ele.find(".cea-tab-id-to-element").length && ! $("body.elementor-editor-active").length ){
			tabs_ele.find(".cea-tab-id-to-element").each(function( index ) {
				var tab_id_ele = $(this).data("id");
				var clone_tab = $("#"+tab_id_ele).clone();
				$(document).find("#"+tab_id_ele).remove();
				$(this).replaceWith(clone_tab);			
			});
		}
		
		function checkMobileAccordion() {
			const deviceWidth = $(window).width();
			const isMobile = deviceWidth <= 500;

			if ( isMobile ) {
				tabs_ele.addClass("cea-mobile-accordion");
				tabs_ele.find('.tab-content.cea-tab-content').hide();
				tabs_ele.find(".cea-tabs a").each( function() {
					const $tab = $(this);
					const $tabID = $tab.attr("href");
					const $content = tabs_ele.find($tabID);

					$content.insertAfter($tab);
					$content.addClass('tab-content');
					$content.addClass('cea-accordion-content');

					if (!$tab.hasClass('active')) {
                    	$content.hide();
                	} 
				} );
			} else {
            	tabs_ele.removeClass('cea-mobile-accordion');
				tabs_ele.find('.tab-content.cea-tab-content').show();
            	const $tabContent = tabs_ele.find('.cea-tab-content');
            	tabs_ele.find('.cea-accordion-content').appendTo($tabContent);
            	tabs_ele.find('.cea-accordion-content').removeClass('cea-accordion-content');
				tabs_ele.find('.cea-tabs a').removeClass('active');
				tabs_ele.find('.cea-tabs a:first').addClass('active');
				tabs_ele.find('.cea-tab-pane').removeClass('active').hide();
				tabs_ele.find('.cea-tab-pane:first').addClass('active').show();
        	}

		}

		checkMobileAccordion();
    	$(window).on('resize', checkMobileAccordion);

		function observeChartAnimation($scope) {
			$scope.find('canvas.pie-chart, canvas.line-chart').each(function() {
				const canvas = this;
				if (canvas._ceaObserved) return;
				canvas._ceaObserved = true;
	
				const observer = new IntersectionObserver((entries) => {
					entries.forEach(entry => {
						if (entry.isIntersecting) {
							if (canvas.chartInstance) {
								canvas.chartInstance.destroy();
							}
							if (canvas.chartConfig) {
								canvas.chartInstance = new Chart(canvas.getContext('2d'), canvas.chartConfig);
							}
						}
					});
				}, { threshold: 0.5 });
	
				observer.observe(canvas);
			});
		}
		observeChartAnimation(tabs_ele);
		
		$(tabs_ele).find(".cea-tabs a").on( "click", function(){
			var cur_tab = $(this);
			var tab_id = $(cur_tab).attr("href");
			const isMobile = $(window).width() <= 500;
			$(cur_tab).parents(".cea-tabs").find("a").removeClass("active");
			$(cur_tab).addClass("active");
			if (isMobile) {
            // Accordion behavior on mobile
            	const $content = tabs_ele.find(tab_id);
            	tabs_ele.find('.cea-tab-pane').not($content).slideUp(350).removeClass("active");
            	$content.slideToggle(350, function(){
            	    $content.addClass("active");
            	    observeChartAnimation($(this));
            	});
        	} else {
            	// Normal tab behavior on desktop
			    var tab_content_wrap = $(cur_tab).parents(".cea-tabs").next(".cea-tab-content");
			    $(tab_content_wrap).find(".cea-tab-pane").fadeOut(0);
			    $(tab_content_wrap).find(".cea-tab-pane").removeClass("active");
			    $(tab_content_wrap).find(tab_id).fadeIn( 350, function(){
                    $(tab_content_wrap).find(tab_id).addClass("active");
    
			    	observeChartAnimation($(this));
                   
                });
        	}
			
			return false;
		});
	}
	
	function ceaToggleContent( toggle_ele ){
		var toggle_ele = $(toggle_ele).find(".toggle-content");	
		$(toggle_ele).css('max-height', '');
		$(toggle_ele).removeClass("toggle-content-shown");
		
		var c = parseFloat($(toggle_ele).css("line-height"));
		var line_height = c.toFixed(2);
		var data_hght = $(toggle_ele).data("height");
		data_hght = data_hght ? data_hght : 5;
		var toggle_hgt = data_hght * line_height;
		toggle_hgt = toggle_hgt.toFixed(2);
		toggle_hgt = toggle_hgt + 'px';
		
		var org_hgt = $(toggle_ele).height();
		$(toggle_ele).css('max-height', toggle_hgt);
		$(toggle_ele).addClass("toggle-content-shown");
		var btn_txt_wrap = $(toggle_ele).parents(".toggle-content-inner").find( ".toggle-btn-txt" );
		var btn_org_txt = $(btn_txt_wrap).text();
		var btn_atl_txt = $(toggle_ele).parents(".toggle-content-inner").find( ".toggle-content-trigger" ).data("less");
		$(toggle_ele).parents(".toggle-content-inner").find( ".toggle-content-trigger" ).unbind( "click" );
		$(toggle_ele).parents(".toggle-content-inner").find( ".toggle-content-trigger" ).bind( "click", function(e){			
			event.preventDefault();
			$(toggle_ele).toggleClass("height-expandable");

			$(toggle_ele).parent(".toggle-content-inner").find('.toggle-content-trigger .button-inner-down').fadeToggle(0);
			$(toggle_ele).parent(".toggle-content-inner").find('.toggle-content-trigger .button-inner-up').fadeToggle(0);
			if( $(toggle_ele).hasClass("height-expandable") ){
				$(toggle_ele).css('max-height', org_hgt);
				$(btn_txt_wrap).text(btn_atl_txt);				
			}else{
				$(toggle_ele).css('max-height', toggle_hgt);
				$(btn_txt_wrap).text(btn_org_txt);
			}			
		});
	}

	function ceazozotimeline(cur_ele){
		var cur_ele = $(cur_ele);
		var line_dist = cur_ele.data("distance") ? cur_ele.data("distance") : 60;
		cur_ele.zozotimeline({
			distance: line_dist
		});
	}
		
	function ceaContentSlider( slide_ele ){
		var slide_ele = $(slide_ele);
		var slide_json = JSON.parse(decodeURIComponent(slide_ele.attr("data-cea-slide")));
		var children_ele = slide_ele.children(".elementor-column-wrap").children(".elementor-widget-wrap");
		$(children_ele).addClass("owl-carousel");
		ceaOwlJsonSettings(children_ele, slide_json);
	}
	
	function ceaSectionRainDrops( rd_ele ){
		rd_ele.addClass("section-raindrops-actived");
		var rd_json = JSON.parse(decodeURIComponent(rd_ele.attr("data-cea-raindrops")));
		rd_ele.append('<div class="cea-raindrops-wrap"></div>');
		
		var rd_color = rd_json.rd_color;
		var rd_height = rd_json.rd_height;
		var rd_speed = rd_json.rd_speed;
		var rd_freq = rd_json.rd_freq;
		var rd_density = rd_json.rd_density;
		var rd_id = rd_json.id;
		var rd_pos = rd_json.rd_pos;
		
		if( rd_pos == "top" ){
			rd_ele.find(".cea-raindrops-wrap").css({"top" : "-"+ rd_height +"px"});
		}else{
			rd_ele.find(".cea-raindrops-wrap").css({"bottom" : "0"});
		}
		
		rd_ele.find(".cea-raindrops-wrap").css("height", rd_height + "px");
		
		var rain_ele = rd_ele.find(".cea-raindrops-wrap").raindrops({
			color: rd_color,
			canvasHeight: rd_height,
			rippleSpeed: rd_speed,
			frequency: rd_freq,
			density: rd_density,
			positionBottom: '0'
		});
	}

    var SectionRowSticky = function ($scope, $) {
        if ($(".sticky-row").length > 0) {
			var headerHeight = $('.site-header').height();
			if( $(window).width() < 1024 && headerHeight == 0 ) {
			    headerHeight = 60;
			}
			if ($("#wpadminbar").length) {
        	    var adminHead = $("#wpadminbar").height();
			    headerHeight = headerHeight + adminHead;
            }
            $(".sticky-row").each(function () {
                var stickyRow = $(this);
                stickyRow.ceaRowSticky({
                    additionalMarginTop: headerHeight,
                    additionalMarginBottom: 30,
                });
            });
        }
    };
    
    var SectionAutoActivate = function ($scope, $) {
        if ($(".auto-activate").length) {
            $(".auto-activate").each(function () {
                const autoActivate = $(this);
                let autoItems = autoActivate.find(
                    ".elementor-widget-container"
                );
                if (autoItems.length === 0) autoItems = autoActivate.find(".elementor-widget");
                autoItems.addClass("auto-items");
                autoItems.each(function (index) {
                    $(this).attr(
                        "data-target",
                        "active-content-" + (index + 1)
                    );
                });
                autoItems.eq(0).addClass("active-auto");
                const contentContainer = autoActivate.siblings();
                const contentItems = contentContainer.find(".e-child");
                contentItems.each(function (index) {
                    $(this).attr("id", "active-content-" + (index + 1));
                });
                const $content = contentContainer.find( "[id^='active-content']" );
                let lastDeviceWidth = $(window).width();
                function updateLayout() {
                    const deviceWidth = $(window).width();
                    if (deviceWidth <= 1024 && lastDeviceWidth > 1024) {
                        autoItems.removeClass("auto-items");
                        autoActivate.addClass("auto-activate-column");
                        contentContainer.hide();
                        $content.each(function (index) {
                            $(this).insertAfter(autoItems.eq(index));
                        });
                    } else if (deviceWidth > 1024 && lastDeviceWidth <= 1024) {
                        autoItems.addClass("auto-items");
                        autoActivate.removeClass("auto-activate-column");
                        contentContainer.show();
                        $content.appendTo(contentContainer);
                    }
                    lastDeviceWidth = deviceWidth;
                }
                function updateScrollState() {
                    const deviceWidth = $(window).width();
                    if (deviceWidth <= 1024) return;
                    const activeHeight = $(".active-auto").outerHeight() || 0;
                    const scrollPosition = $(window).scrollTop() + activeHeight;
                    let activeNow = null;
                    contentItems.each(function () {
                        const $el = $(this);
                        const top = $el.offset().top;
                        const bottom = top + $el.outerHeight();
                        if (scrollPosition >= top && scrollPosition < bottom) {
                            activeNow = $el.attr("id");
                            return false;
                        }
                    });
                    if (activeNow) {
                        autoItems.removeClass("active-auto");
                        autoItems.each(function () {
                            if ($(this).data("target") === activeNow) {
                                $(this).addClass("active-auto");
                                return false;
                            }
                        });
                    }
                }
                let ticking = false;
                function onScrollOrResize() {
                    if (!ticking) {
                        window.requestAnimationFrame(function () {
                            updateLayout();
                            updateScrollState();
                            ticking = false;
                        });
                        ticking = true;
                    }
                }
                updateLayout();
                updateScrollState();
                $(window).on("scroll", onScrollOrResize);
                $(window).on("resize", onScrollOrResize);
            });
        }
    };

// 	var SectionAutoActivate = function ( $scope, $ ) {
// 		if( $(".auto-activate").length) {
// 			$(".auto-activate").each( function() {
// 				var autoActivate = $(this);
				
// 				var autoItems = autoActivate.find(".elementor-widget-container");
// 				autoItems.addClass('auto-items');
// 				autoItems.each( function( index ) {
// 					var autoItem = $(this);
// 					autoItem.attr('data-target', 'active-content-' + (index+1));
// 				});

// 				autoItems[0].classList.add('active-auto');

// 				var contentContainer = autoActivate.siblings();
// 				var contentItems = contentContainer.find('.e-child');
// 				contentItems.each( function( index ) {
// 					var contentItem = $(this);
// 					contentItem.attr('id', 'active-content-' + (index+1));
// 				});
				
// 				function checkContentVisible() {
// 					const deviceWidth = $(window).width();

// 				// 	if ( deviceWidth <= 1024 && deviceWidth >= 768 ) {
// 				// 		autoItems.removeClass('auto-items');		
// 				// 		return;
// 				// 	} else 
// 				if ( deviceWidth <= 1024 ) {
// 						autoItems.removeClass("auto-items");	
// 						var element_container = autoItems.parents('.elementor-widget');
// 						var content_container = $("[id^='active-content']");
// 						element_container.unwrap(".auto-activate");
// 						element_container.unwrap(".theiaStickySidebar");
// 						content_container.unwrap("[data-element_type='container']");
// 						extra_content = content_container.siblings("[data-element_type='container']").not("[id^='active-content']");
// 						var index1 = 0;
// 						var index2 = 0;
// 						element_container.each(function() {
// 							$(this).css({
//                                 "order": 2 * (element_container.length - index1) - 1,
//                             });
// 							index1++;
// 						});
// 						content_container.each(function() {
// 							$(this).css({
//                                 "order": 2 + ( index2 * 2 ),
//                             });
// 							index2++;
// 						});
// 					} else {
// 						let activeHeight = $(".active-auto").outerHeight();
//                     	const scrollPosition = $(window).scrollTop() + activeHeight;

// 						contentItems.each(function (index) {
// 							const element = $(this);
// 							const element_top = element.offset().top;
// 							const element_bottom = element_top + element.outerHeight();
// 							const deviceWidth = $(window).width();
// 							let activeNow = '';

// 							if ( deviceWidth < 768 ) {
// 								autoItems.removeClass("auto-items");
// 								return;
// 							} else {
// 								if (!autoItems.hasClass("auto-items")) {
//                     	            autoItems.addClass("auto-items");
//                     	        }
// 							}

// 						if (scrollPosition >= element_top && scrollPosition < element_bottom) {
//                 			activeNow = element.attr('id');
//             			}

// 						if( activeNow ) {
// 							autoItems.removeClass('active-auto');
// 							autoItems.each( function() {
// 								var autoItem = $(this);
// 								if( autoItem.data('target') == activeNow ) {
// 									autoItem.addClass('active-auto');
// 								}
// 							});
// 						}

// 						});
// 					}	
// 				}
// 				checkContentVisible();
//                 $(window).on("scroll", checkContentVisible);
//                 $(window).on("resize", checkContentVisible);
// 			});
// 		} 
// 	}

	var SectionContentParallax = function ($scope, $) {
    	if ($('.content-parallax-yes').length) {
    	    $('.content-parallax-yes').each(function () {
    	        var contentParallax = $(this);
				var parallaxData = contentParallax.data("parallax-ctrl");

				var dataDepth = parallaxData['data_depth'];
				var parallaxIndex = parallaxData['parallax_index'];
				var parallaxHoverOnly = parallaxData['parallax_hover_only'];
				var parallaxScaleX = parallaxData['scale_x'];
				var parallaxScaleY = parallaxData['scale_y'];
				var parallaxFrictionX = parallaxData['friction_x'];
				var parallaxFrictionY = parallaxData['friction_y'];
				
				if( contentParallax.find('.e-con-inner') ) {
					contentParallax.find('.e-con-inner').css({
						width: parallax_full_width + 'vw',
					});
					contentParallax.find('.e-con-inner').removeClass('e-con-inner');
				}

				contentParallax.css({ 'z-index': parallaxIndex });
				var parallexContainer = contentParallax.find(".elementor-widget");
            	// Ensure the container has the required class for Parallax.js
				parallexContainer.addClass('parallax-container');

            	// Find the inner content to apply the parallax effect
            	var parallaxItem = contentParallax.find('.elementor-widget-container');
				if( contentParallax.hasClass('parallax-img-full-width') ) {
					var parallax_full_width = parallaxData['img_full_width'];
					var parallax_full_left = parallaxData['img_full_left'];
					contentParallax.css({
						left: '-' + parallax_full_left + '%',
					});
					contentParallax.css({
						width: parallax_full_width + 'vw',
					});
					parallexContainer.css({
						width: parallax_full_width + 'vw',
					});
					parallaxItem.css({
						width: parallax_full_width + 'vw',
					});
					parallaxItem.find('img').css({
						width: parallax_full_width + 'vw',
					});
				}
            	// Set the data-depth attribute for parallax effect
            	parallaxItem.attr('data-depth', dataDepth);
				parallexContainer.each( function() {
            	    var parallaxInstance = new Parallax(this, {
            	        relativeInput: true,
				    	hoverOnly: parallaxHoverOnly,
				    	scalarX: parallaxScaleX,
  				    	scalarY: parallaxScaleY,
  				    	frictionX: parallaxFrictionX,
  				    	frictionY: parallaxFrictionY,
            	    });
				});
                parallexContainer.css({
					'pointer-events': 'auto',
				});
        	});
    	}
	};

	function ceaSectionParallax( pr_ele ){
		
		var pr_ele = $(pr_ele);
		var pr_json = JSON.parse(decodeURIComponent(pr_ele.attr("data-cea-parallax-data")));
		
		var parallax_ratio = pr_json.parallax_ratio;
		var parallax_img = pr_json.parallax_image;

		pr_ele.prepend('<div class="cea-parallax" data-cea-parallax data-speed="'+ parallax_ratio +'" style="background-image:url('+ parallax_img +')"></div>');
		
		// create variables
		var $fwindow = $(window);
		var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

		// on window scroll event
		$fwindow.on('scroll resize', function() {
			scrollTop = window.pageYOffset || document.documentElement.scrollTop;
		});

		// for each of background parallax element
		$(pr_ele).find('.cea-parallax').each(function(){
			var $backgroundObj = $(this);
			var bgOffset = parseInt($backgroundObj.offset().top);
			var yPos;
			var coords;
			var speed = ($backgroundObj.data('speed') || 0 );

			$fwindow.on('scroll resize', function() {
				yPos = - ((scrollTop - bgOffset) / speed);
				coords = '10% '+ yPos + 'px';

				$backgroundObj.css({ backgroundPosition: coords });
			}); 
		}); 

		// triggers winodw scroll for refresh
		$fwindow.trigger('scroll');
		
	}
	
	function ceaSectionFloatParallax( pr_ele ){
		
		var pr_ele = $(pr_ele);
		var pr_json = JSON.parse(decodeURIComponent(pr_ele.attr("data-cea-float")));
		var data_id = pr_ele.attr("data-id");
		var fload_id = parseInt(data_id, 16);

		$.each( pr_json, function(idx, obj) {
			var float_title = obj.float_title;
			var float_img = obj.float_img;
			var float_left = obj.float_left;
			var float_top = obj.float_top;
			var float_distance = obj.float_distance;
			var float_animation = obj.float_animation;
			var float_mouse = obj.float_mouse;
			var float_width = obj.float_width;
			
			var classname = float_animation != '0' ? ' floating-animate-model-' + float_animation : '';
			
			pr_ele.prepend('<div id="float-parallax-'+ fload_id +'" class="float-parallax'+  classname  +'" data-mouse="'+  float_mouse  +'" data-left="'+  float_left  +'" data-top="'+  float_top  +'" data-distance="'+  float_distance  +'"><img alt="'+  float_title  +'" src="'+ float_img  +'" /></div>');

			$("#float-parallax-"+fload_id).ceaparallax({
				t_top: float_top,
				t_left: float_left,
				x_level: float_distance,
				y_level: float_distance,
				mouse_animation: float_mouse,
				ele_width: float_width
			});

			fload_id++;
		}); // each end
		
	}
	
	function ceaModalPopup( popup_ele ){
		var popup_ele = $(popup_ele);
		popup_ele.magnificPopup({
			type: 'inline',
			preloader: false,
			modal: true,
			mainClass: 'mfp-fade',
			removalDelay: 300
		});
	}

	// Video Playlist
	function ceaVideoPlaylist( cur_video ){
		var cur_video = $(cur_video);
		(function($){
			$(document).ready(function(){
			    $autoplay = cur_video.data('autoplay');
				muted = cur_video.data('muted');
				control = cur_video.data('controls');
				background = cur_video.data('background');
				cur_video.find('.cea-video-item').on('click', function(){
					var videoId = $(this).data('video-id');
					cur_video.find('#cea-video-frame').attr('src', 'https://www.youtube.com/embed/' + videoId + '?autoplay='+ $autoplay +'&mute=' + muted + '&controls=' + control);
					cur_video.find(".cea-video-item").removeClass("active");
					$(this).addClass('active');
				});
				cur_video.find('.cea-upload-playlist-item').on('click', function(e){
					e.preventDefault();
					const mediaUrl = $(this).data('media-url');
					const mediaTitle = $(this).data('title');
					const mediaImage = $(this).data('image');

					cur_video.find('#cea-audio-player').attr('src', mediaUrl).trigger('play');
					cur_video.find("#cea-audio-title").text(mediaTitle);
					cur_video.find('#cea-audio-thumbnail').attr('src', mediaImage);

					cur_video.find('.cea-upload-playlist-item').removeClass('active');
					$(this).addClass('active');
				});
				cur_video.find('.cea-video-playlist-item').on('click', function(e){
					e.preventDefault();
					const mediaUrl = $(this).data('media-url');
					const mediaTitle = $(this).data('title');

					cur_video.find('#cea-video-player').attr('src', mediaUrl).trigger('play');
					cur_video.find("#cea-video-title").text(mediaTitle);

					cur_video.find('.cea-video-playlist-item').removeClass('active');
					$(this).addClass('active');
				});
				cur_video.find(".cea-vimeo-item").on('click', function(e) {
					e.preventDefault();
					const newUrl = $(this).data("vimeo-url") + "?autoplay=" + $autoplay + "&muted=" + muted + "&background=" + background;

					cur_video.find("#cea-vimeo-frame").attr('src', newUrl).trigger('play');
					
					cur_video.find(".cea-vimeo-item").removeClass("active");
					$(this).addClass('active');
				});
			});
		})(jQuery);

	}
	
	function ceaTilt( tilt_ele ){
		var tilt_ele = $(tilt_ele);
		var _max_tilt = tilt_ele.data("max_tilt") ? tilt_ele.data("max_tilt") : 20;
		var _tilt_perspective = tilt_ele.data("tilt_perspective") ? tilt_ele.data("tilt_perspective") : 500;
		var _tilt_scale = tilt_ele.data("tilt_scale") ? tilt_ele.data("tilt_scale") : 1.1;
		var _tilt_speed = tilt_ele.data("tilt_speed") ? tilt_ele.data("tilt_speed") : 400;
		var _tilt_transition = tilt_ele.data("tilt_trans") ? tilt_ele.data("tilt_trans") : false;
		
		const cea_tilt = $(tilt_ele).tilt({
			maxTilt: _max_tilt,
			perspective: _tilt_perspective,
			scale: _tilt_scale,
			speed: _tilt_speed,
			transition: _tilt_transition
		});
	}
	
	function ceaPopupAnything( popup_ele ){
		var popup_ele = $(popup_ele);
		popup_ele.magnificPopup({
			disableOn: 700,
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false,
			/*callbacks: {
				open: function() {
					$($(this.items).find('video')[0]).each(function(){this.player.load()});
				},
				close: function() {
					$($(this.items).find('video')[0]).each(function(){this.player.pause()});
				}
			}*/
			iframe: {
			  markup: '<div class="mfp-iframe-scaler">'+
						'<div class="mfp-close"></div>'+
						'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
					  '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

			  patterns: {
				youtube: {
				  index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

				  id: 'v=', // String that splits URL in a two parts, second part should be %id%
				  // Or null - full URL will be returned
				  // Or a function that should return %id%, for example:
				  // id: function(url) { return 'parsed id'; }

				  src: '//www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
				},
				vimeo: {
				  index: 'vimeo.com/',
				  id: '/',
				  src: '//player.vimeo.com/video/%id%?autoplay=1'
				},
				gmaps: {
				  index: '//maps.google.',
				  src: '%id%&output=embed'
				}
				// you may add here more sources
			  },

			  srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
			}
		});
	}
	
	function ceaPopover( popover_ele ){
		var popover_ele = $(popover_ele);
		var evnt_name = popover_ele.attr("data-event") ? popover_ele.attr("data-event") : 'hover';
		if( evnt_name == 'hover' ){ 
			popover_ele.on( 'mouseover', function ( e ) {
				e.preventDefault();
				$(this).parents(".popover-wrapper").addClass("popover-active");
			}).on( 'mouseout', function ( e ) {
				e.preventDefault();
				$(this).parents(".popover-wrapper").removeClass("popover-active");
			});
		}else{
			popover_ele.on( 'click', function ( e ) {
				e.preventDefault();
				$(this).parents(".popover-wrapper").toggleClass("popover-active");
			})
		}
	}
	
	function ceaSwitchTabToggle( toggle_ele ){
		if( toggle_ele.checked ) {
			var toggle_ele = $(toggle_ele);
            toggle_ele.parents(".cea-toggle-post-wrap").addClass("cea-active-post");
        }else{
			var toggle_ele = $(toggle_ele);
			toggle_ele.parents(".cea-toggle-post-wrap").removeClass("cea-active-post");
		}
	}
		
	function ceaAgon( canvas_ele ){
		var canvas_ele = $(canvas_ele);
		var canvas = canvas_ele[0];
		var cxt = canvas.getContext("2d");
		var agon_size = canvas_ele.attr( "data-size" );
		var agon_side = canvas_ele.attr( "data-side" );
		var agon_color = canvas_ele.attr( "data-color" );
		var div_val = 1;

		switch( parseInt( agon_side ) ){
			case 3:
				div_val = 6;
			break;
			case 4:
				div_val = 4;
			break;
			case 5:
				div_val = 3.3;
			break;
			case 6:
				div_val = 3;
			break;
			case 7:
				div_val = 2.8;
			break;
			case 8:
				div_val = 2.7;
			break;
			case 9:
				div_val = 2.6;
			break;
			case 10:
				div_val = 2.5;
			break;
		}

		// hexagon
		var numberOfSides = parseInt( agon_side ),
			size = parseInt( agon_size ),
			Xcenter = parseInt( agon_size ),
			Ycenter = parseInt( agon_size ),
			step  = 2 * Math.PI / numberOfSides,//Precalculate step value
			shift = (Math.PI / div_val);//(Math.PI / 180.0);// * 44;//Quick fix ;)

		cxt.beginPath();

		for (var i = 0; i <= numberOfSides;i++) {
			var curStep = i * step + shift;
		   cxt.lineTo (Xcenter + size * Math.cos(curStep), Ycenter + size * Math.sin(curStep));
		}

		/* Direct Output */
		cxt.fillStyle = agon_color;
		cxt.fill();
	}
	
	function initCEAGmap() {
		
		var map_styles = '{ "Aubergine" : [	{"elementType":"geometry","stylers":[{"color":"#1d2c4d"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#8ec3b9"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#1a3646"}]},{"featureType":"administrative.country","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#64779e"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"color":"#4b6878"}]},{"featureType":"landscape.man_made","elementType":"geometry.stroke","stylers":[{"color":"#334e87"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#023e58"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#283d6a"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#6f9ba5"}]},{"featureType":"poi","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#023e58"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#3C7680"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#304a7d"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#2c6675"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#255763"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#b0d5ce"}]},{"featureType":"road.highway","elementType":"labels.text.stroke","stylers":[{"color":"#023e58"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#98a5be"}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"color":"#1d2c4d"}]},{"featureType":"transit.line","elementType":"geometry.fill","stylers":[{"color":"#283d6a"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#3a4762"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#0e1626"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#4e6d70"}]}], "Silver" : [{"elementType":"geometry","stylers":[{"color":"#f5f5f5"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f5f5"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#dadada"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#e5e5e5"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#eeeeee"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#c9c9c9"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]}], "Retro" : [{"elementType":"geometry","stylers":[{"color":"#ebe3cd"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#523735"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#f5f1e6"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#c9b2a6"}]},{"featureType":"administrative.land_parcel","elementType":"geometry.stroke","stylers":[{"color":"#dcd2be"}]},{"featureType":"administrative.land_parcel","elementType":"labels.text.fill","stylers":[{"color":"#ae9e90"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#93817c"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#a5b076"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#447530"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#f5f1e6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#fdfcf8"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#f8c967"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#e9bc62"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"color":"#e98d58"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry.stroke","stylers":[{"color":"#db8555"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#806b63"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"transit.line","elementType":"labels.text.fill","stylers":[{"color":"#8f7d77"}]},{"featureType":"transit.line","elementType":"labels.text.stroke","stylers":[{"color":"#ebe3cd"}]},{"featureType":"transit.station","elementType":"geometry","stylers":[{"color":"#dfd2ae"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#b9d3c2"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#92998d"}]}], "Dark" : [{"elementType":"geometry","stylers":[{"color":"#212121"}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#212121"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#757575"}]},{"featureType":"administrative.country","elementType":"labels.text.fill","stylers":[{"color":"#9e9e9e"}]},{"featureType":"administrative.land_parcel","stylers":[{"visibility":"off"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#bdbdbd"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#181818"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"poi.park","elementType":"labels.text.stroke","stylers":[{"color":"#1b1b1b"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#2c2c2c"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#8a8a8a"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#373737"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#3c3c3c"}]},{"featureType":"road.highway.controlled_access","elementType":"geometry","stylers":[{"color":"#4e4e4e"}]},{"featureType":"road.local","elementType":"labels.text.fill","stylers":[{"color":"#616161"}]},{"featureType":"transit","elementType":"labels.text.fill","stylers":[{"color":"#757575"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#3d3d3d"}]}], "Night" : [{"elementType":"geometry","stylers":[{"color":"#242f3e"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#746855"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#242f3e"}]},{"featureType":"administrative.locality","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"poi","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#263c3f"}]},{"featureType":"poi.park","elementType":"labels.text.fill","stylers":[{"color":"#6b9a76"}]},{"featureType":"road","elementType":"geometry","stylers":[{"color":"#38414e"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#212a37"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#9ca5b3"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#746855"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#1f2835"}]},{"featureType":"road.highway","elementType":"labels.text.fill","stylers":[{"color":"#f3d19c"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#2f3948"}]},{"featureType":"transit.station","elementType":"labels.text.fill","stylers":[{"color":"#d59563"}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#17263c"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"color":"#515c6d"}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"color":"#17263c"}]}] }';
		
	    var map_style_obj = JSON.parse(map_styles);

    	$(".ceagmap").each(function (index) {
        var gmap = this;
        var map_mode = $(gmap).data("map-style");
        var map_style_mode = [];

        if (map_mode === 'aubergine')
            map_style_mode = map_style_obj.Aubergine;
        else if (map_mode === 'silver')
            map_style_mode = map_style_obj.Silver;
        else if (map_mode === 'retro')
            map_style_mode = map_style_obj.Retro;
        else if (map_mode === 'dark')
            map_style_mode = map_style_obj.Dark;
        else if (map_mode === 'night')
            map_style_mode = map_style_obj.Night;
        else if (map_mode === 'custom') {
            var c_style = $(gmap).data("custom-style") ? JSON.parse($(gmap).data("custom-style")) : [];
            map_style_mode = c_style;
        }

        if ($(gmap).data("multi-map")) {
            var map_values = JSON.parse($(gmap).data("maps"));
            var map_wheel = $(gmap).data("wheel") === true;
            var map_zoom = $(gmap).data("zoom") || 14;
            var map;
            var map_stat = 1;

            map_values.forEach(function (map_value) {
                var LatLng = new google.maps.LatLng(map_value.map_latitude, map_value.map_longitude);
                var mapProp = {
                    center: LatLng,
                    scrollwheel: map_wheel,
                    zoom: map_zoom,
                    styles: map_style_mode
                };

                if (map_stat) {
                    map = new google.maps.Map(gmap, mapProp);
                    google.maps.event.addDomListener(window, 'resize', function () {
                        var center = map.getCenter();
                        google.maps.event.trigger(map, "resize");
                        map.setCenter(LatLng);
                    });
                    map_stat = 0;
                }

                var marker = new google.maps.Marker({
                    position: LatLng,
                    icon: map_value.map_marker,
                    map: map
                });

                if (map_value.map_info_opt === 'on') {
                    var contentString = '<div class="gmap-info-wrap"><h3>' + map_value.map_info_title + '</h3><p>' + map_value.map_info_address + '</p></div>';
                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener('click', function () {
                        infowindow.open(map, marker);
                    });
                }
            });
        } else {
            var LatLng = { lat: parseFloat($(gmap).data("map-lat")), lng: parseFloat($(gmap).data("map-lang")) };
            var map_wheel = $(gmap).data("wheel") === true;
            var map_zoom = $(gmap).data("zoom") || 14;

            var mapProp = {
                center: LatLng,
                scrollwheel: map_wheel,
                zoom: map_zoom,
                styles: map_style_mode
            };
            var map = new google.maps.Map(gmap, mapProp);

            var marker = new google.maps.Marker({
                position: LatLng,
                icon: $(gmap).data("map-marker"),
                map: map
            });

            if ($(gmap).data("info") == 1) {
                var contentString = '<div class="gmap-info-wrap"><h3>' + $(gmap).data("info-title") + '</h3><p>' + $(gmap).data("info-addr") + '</p></div>';
                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });
                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });
            }

            google.maps.event.addDomListener(window, 'resize', function () {
                var center = map.getCenter();
                google.maps.event.trigger(map, "resize");
                map.setCenter(LatLng);
            });
        }
    });
}

	function ceaCounterUpSettings( counterup ){
		counterup.appear(function() {
			var $this = $(this),
			countTo = $this.attr( "data-count" ),
			duration = $this.attr( "data-duration" );
			$({ countNum: $this.text()}).animate({
					countNum: countTo
				},
				{
				duration: parseInt( duration ),
				easing: 'swing',
				step: function() {
					$this.text( Math.floor( this.countNum ) );
				},
				complete: function() {
					$this.text( this.countNum );
				}
			});  
		});
	}
	
	function ceaDayCounterSettings( day_counter ){
		var day_counter = $( day_counter );
		var c_date = day_counter.attr('data-date');
		day_counter.countdown( c_date, function(event) {
			if( day_counter.find('.counter-day').length ){
				day_counter.find('.counter-day h3').text( event.strftime('%D') );
			}
			if( day_counter.find('.counter-hour').length ){
				day_counter.find('.counter-hour h3').text( event.strftime('%H') );
			}
			if( day_counter.find('.counter-min').length ){
				day_counter.find('.counter-min h3').text( event.strftime('%M') );
			}
			if( day_counter.find('.counter-sec').length ){
				day_counter.find('.counter-sec h3').text( event.strftime('%S') );
			}
			if( day_counter.find('.counter-week').length ){
				day_counter.find('.counter-week h3').text( event.strftime('%w') );
			}
		});
	}
	
	function ceaPieChartSettings(chart_ele) {
		var chart_ele = $(chart_ele);
		var c_chart = $('#' + chart_ele.attr("id"));
		var chart_labels = c_chart.attr("data-labels")?.split(",") || [];
		var chart_values = c_chart.attr("data-values")?.split(",") || [];
		var chart_bgs = c_chart.attr("data-backgrounds")?.split(",") || [];
		var chart_responsive = parseInt(c_chart.attr("data-responsive") || 1);
		var chart_legend = c_chart.attr("data-legend-position") || 'none';
		var chart_type = c_chart.attr("data-type") || 'doughnut';
		var chart_zorobegining = c_chart.attr("data-yaxes-zorobegining");

		let scales = undefined;
		if (chart_zorobegining) {
			scales = {
				yAxes: [{
					ticks: {
						beginAtZero: parseInt(chart_zorobegining)
					}
				}]
			};
		}

		var ctx = c_chart[0].getContext('2d');
		c_chart[0].chartConfig = {
            type: chart_type,
            data: {
                labels: chart_labels,
                datasets: [
                    {
                        label: "# of Votes",
                        data: chart_values,
                        backgroundColor: chart_bgs,
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                aspectRatio: 1.5,
                scales: scales,
                legend: {
                    position: chart_legend,
                },
            },
        };
		var myChart = new Chart(ctx, c_chart[0].chartConfig);
		c_chart[0].chartInstance = myChart;
		return myChart;
	}
	
	function ceaLineChartSettings( chart_ele ){
		var chart_ele = $( chart_ele );
		var c_chart = $('#' + chart_ele.attr("id") );
		var chart_labels = c_chart.attr("data-labels");
		var chart_values = c_chart.attr("data-values");
		var chart_bg = c_chart.attr("data-background");
		var chart_border = c_chart.attr("data-border");
		var chart_fill = c_chart.attr("data-fill");
		var chart_zorobegining = c_chart.attr("data-yaxes-zorobegining");
		var chart_title = c_chart.attr("data-title-display");
		var chart_responsive = c_chart.attr("data-responsive");
		var chart_legend = c_chart.attr("data-legend-position");
		
		chart_labels = chart_labels ? chart_labels.split(",") : [];
		chart_values = chart_values ? chart_values.split(",") : [];
		chart_bg = chart_bg ? chart_bg : '';
		chart_border = chart_border ? chart_border : '';
		chart_fill = chart_fill ? chart_fill : 0;
		
		chart_zorobegining = chart_zorobegining ? chart_zorobegining : 1;
		chart_title = chart_title ? chart_title : 1;
		chart_responsive = chart_responsive ? chart_responsive : 1;
		chart_legend = chart_legend ? chart_legend : 'none';
		
		var ctx = c_chart[0].getContext('2d');
		c_chart[0].chartConfig = {
            type: "line",
            data: {
                labels: chart_labels,
                datasets: [
                    {
                        label: "# of Votes",
                        data: chart_values,
                        fill: parseInt(chart_fill),
                        backgroundColor: chart_bg,
                        borderColor: chart_border,
                        borderWidth: 1,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                aspectRatio: 2, // Optional: Controls height ratio
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: parseInt(chart_zorobegining),
                            },
                        },
                    ],
                },
                legend: {
                    position: chart_legend,
                },
                title: {
                    display: parseInt(chart_title),
                },
            },
        };
		var myChart = new Chart(ctx, c_chart[0].chartConfig );
		c_chart[0].chartInstance = myChart;
		return myChart;
	}
	
	function ceaAnimatedTextSettings( cur_ele, index ){
		var cur_ele = $(cur_ele);
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
				fadeOut: true,
				cursorChar: cur_char,
			});
		}
	}
	
	function ceaButtonSettings( button_ele ) {
		var cur_ele = $(button_ele);
		if ( !cur_ele.hasClass("cea-btn-scroll") ) {
			return;
		}
		var headerHeight = $(".site-header").height();
        if ($(window).width() < 1024 && headerHeight == 0) {
            headerHeight = 60;
        }
        if ($("#wpadminbar").length) {
            var adminHead = $("#wpadminbar").height();
            headerHeight = headerHeight + adminHead;
        }
		cur_ele.on("click", function(e) {
			e.preventDefault();
			var target = $(this).attr("href");
			$("html, body").animate({
                scrollTop: $(target).offset().top - headerHeight - 10,
            },500);
		});
	}
	
	function ceaCircleProgresSettings( circle_ele ){
		circle_ele.appear(function() {						  
			var c_circle = $( this );
			var c_value = c_circle.attr( "data-value" );
			var c_size = c_circle.attr( "data-size" );
			var c_thickness = c_circle.attr( "data-thickness" );
			var c_duration = c_circle.attr( "data-duration" );
			var c_empty = c_circle.attr( "data-empty" ) != '' ? c_circle.attr( "data-empty" ) : 'transparent';
			var c_scolor = c_circle.attr( "data-scolor" );
			var c_ecolor = c_circle.attr( "data-ecolor" ) != '' ? c_circle.attr( "data-ecolor" ) : c_scolor;
								
			c_circle.circleProgress({
				value: Math.floor( c_value ) / 100,
				size: Math.floor( c_size ),
				thickness: Math.floor( c_thickness ),
				emptyFill: c_empty,
				animation: {
					duration: Math.floor( c_duration )
				},
				lineCap: 'round',
				fill: {
					gradient: [c_scolor, c_ecolor]
				}
			}).on( 'circle-animation-progress', function( event, progress ) {
				$( this ).find( '.progress-value' ).html( Math.round( c_value * progress ) + '%' );
			});
		});
	}
	
	function ceaImageBeforeAfterSettings( c_imgc ){
		
		var c_imgc = $( c_imgc );	
		var _offset = c_imgc.attr("data-offset") ? c_imgc.attr("data-offset") : 0.5;
		var _orientation = c_imgc.attr("data-orientation") ? c_imgc.attr("data-orientation") : 'horizontal';
		var _before = c_imgc.attr("data-before") ? c_imgc.attr("data-before") : '';
		var _after = c_imgc.attr("data-after") ? c_imgc.attr("data-after") : '';
		var _noverlay = c_imgc.attr("data-noverlay") ? c_imgc.attr("data-noverlay") : false;
		var _hover = c_imgc.attr("data-hover") ? c_imgc.attr("data-hover") : false;
		var _swipe = c_imgc.attr("data-swipe") ? c_imgc.attr("data-swipe") : false;
		var _move = c_imgc.attr("data-move") ? c_imgc.attr("data-move") : false;
		
		c_imgc.zozoimgc({
			default_offset_pct: _offset,
			orientation: _orientation,
			before_label: _before,
			after_label: _after,
			no_overlay: _noverlay,
			move_slider_on_hover: _hover,
			move_with_handle_only: _swipe,
			click_to_move: _move
		});
		
	}
	
	function ceaMailchimp( mc_wrap ){
		var mc_wrap = $( mc_wrap );
		mc_wrap.on( "keyup", ".cea-mc", function ( e ) {
			mc_wrap.find('input').removeClass("must-fill");
		});
		
		mc_wrap.on( "click", ".cea-mc", function ( e ) {
			e.preventDefault();
			var c_btn = $(this);
			var mc_form = $( this ).parents('.zozo-mc-form');
			mc_wrap.find('.mc-notice-msg').removeClass("mc-success mc-failure");
			mc_wrap.find('input').removeClass("must-fill");
			if( mc_form.find('input[name="cea_mc_email"]').val() == '' ){
				mc_form.find('input[name="cea_mc_email"]').addClass("must-fill");
			}else{
				
				var mc_nounce = mc_wrap.find('input[name="cea_mc_nonce"]').val();
				
				c_btn.attr( "disabled", "disabled" );
				$.ajax({
					type: "POST",
					url: cea_ajax_var.ajax_url,
					data: 'action=cea_mailchimp&nonce='+ mc_nounce +'&'+ mc_form.serialize(),
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
	}
	
	function ceaIsotopeLayout( c_elem ){
		var c_elem = $(c_elem);
		var parent_width = c_elem.width();
		var gutter_size = c_elem.data( "gutter" );
		var grid_cols = c_elem.data( "cols" );
		var filter = '';

		var layoutmode = c_elem.is('[data-layout]') ? c_elem.data( "layout" ) : '';
		var lazyload = c_elem.is('[data-lazyload]') ? c_elem.data( "lazyload" ) : '';
		layoutmode = layoutmode ? layoutmode : 'masonry';
		lazyload = lazyload ? '0s' : '0.4s';

		if( $(window).width() < 768 ) grid_cols = 1;

		var net_width = Math.floor( ( parent_width - ( gutter_size * ( grid_cols - 1 ) ) ) / grid_cols );
		c_elem.find( ".isotope-item" ).css({'width':net_width+'px', 'margin-bottom':gutter_size+'px'});

		var cur_isotope;        
		cur_isotope = c_elem.isotope({
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
		
		/* Isotope filter item */
		var filter_wrap = '';
		if( $(c_elem).parent(".woocommerce").length ){
			filter_wrap = $(c_elem).parent(".woocommerce").prev(".isotope-filter");    
		}else{
			filter_wrap = $(c_elem).prev(".isotope-filter");
		}
		$(filter_wrap).find( ".isotope-filter-item" ).on( 'click', function() {
			$( this ).parents("ul.nav").find("li").removeClass("active");
			$( this ).parent("li").addClass("active");
			filter = $( this ).attr( "data-filter" );
			if( c_elem.find( ".isotope-item" + filter ).hasClass( "cea-animate" ) ){
				if( filter ){
					c_elem.find( ".isotope-item" + filter ).removeClass("run-animate");
				}else{
					c_elem.find( ".isotope-item" ).removeClass("run-animate");
				}
				cea_scroll_animation(c_elem);
			}
			cur_isotope.isotope({ 
				filter: filter
			});
			
			return false;
		});
		
		//Animate isotope items
		if( c_elem.find( ".isotope-item" ).hasClass( "cea-animate" ) ){
			cea_scroll_animation(c_elem);
			$(window).on('scroll', function(){
				cea_scroll_animation(c_elem);
			});
		}else{
			c_elem.children(".isotope-item").addClass("item-visible");
		}
		
		/* Isotope infinite */
		if( c_elem.data( "infinite" ) == 1 && $("ul.post-pagination").length ){
			
			var loadmsg = c_elem.data( "loadmsg" );
			var loadend = c_elem.data( "loadend" );
			var loadimg = c_elem.data( "loadimg" );
			
			let msnry = cur_isotope.data('isotope');
			
			cur_isotope.infiniteScroll({
				path: 'a.next-page',
				status: '.page-load-status',
				history: false
			});
			
			cur_isotope.on( 'load.infiniteScroll', function( event, response, path ) {                
				var $items = $( response ).find('.isotope-item');
				$items.css({'width':net_width+'px', 'margin-bottom':gutter_size+'px'});
				$items.imagesLoaded( function() {
					cur_isotope.append( $items );
					cur_isotope.isotope( 'insert', $items );
					cea_scroll_animation(c_elem);
					if( $items.hasClass( "cea-animate" ) ){
						cea_scroll_animation(c_elem);
					}else{
						$items.addClass("item-visible");
					}
				});
			});
			
		}

		/* Isotope resize */
		$( window ).resize(function() {
			grid_cols = c_elem.data( "cols" );
			if( $(window).width() < 768 ) grid_cols = 1;
			
			var parent_width = c_elem.width();
			net_width = Math.floor( ( parent_width - ( gutter_size * ( grid_cols - 1 ) ) ) / grid_cols );
			c_elem.find( ".isotope-item" ).css({'width':net_width+'px', 'margin-bottom':gutter_size+'px'});
			var $isot = c_elem.isotope({
				itemSelector: '.isotope-item',
				isotope: {
					gutter: gutter_size
				}
			});
			
		});
		
		$( window ).load(function() {
			$( window ).trigger("resize");
		});

	}
		
	function ceaPopupGallerySettings( c_popup ){
		$(c_popup).magnificPopup({
			delegate: '.image-gallery-link',
			type: 'image',
			closeOnContentClick: false,
			closeBtnInside: false,
			mainClass: 'mfp-with-zoom mfp-img-mobile',
			gallery: {
				enabled: true
			},
		});
	}
	
	function ceaImageAccordion( acc_ele ) {
		var acc_ele = $(acc_ele);
		var isHorizontal = false;
        if (acc_ele.hasClass("cea-image-accordion-horizontal")) {
            isHorizontal = true;
        }
		function updateResponsive() {
			var breakPts = acc_ele.data("wrap");
			const $width = $(window).width();
			

			if ( breakPts == "mobile" ) {
                if ($width < 767) {
                    if ( isHorizontal ) {
						acc_ele.removeClass("cea-image-accordion-horizontal");
					}
                    acc_ele.addClass("cea-image-accordion-vertical");
                } else {
					if ( isHorizontal ) {
						acc_ele.addClass("cea-image-accordion-horizontal");
						acc_ele.removeClass("cea-image-accordion-vertical");
					}
                }
			} else if ( breakPts == "tablet" ) {
				if ( $width <= 1024 ) {
                    if (isHorizontal) {
                        acc_ele.removeClass("cea-image-accordion-horizontal");
                    }
                    acc_ele.addClass("cea-image-accordion-vertical");
                } else {
					if (isHorizontal) {
                        acc_ele.addClass("cea-image-accordion-horizontal");
                        acc_ele.removeClass("cea-image-accordion-vertical");
                    }
				}
			} else {
				// This is for None
			}
		}

		$(window).on("resize", updateResponsive);
		updateResponsive();
	}

	function cursorCPTContent( cpt_ele ) {

		var cpt_ele = $(cpt_ele);

		var slides = cpt_ele.find(".cursor-hover-content");
		if ( slides.length ) {
			const $cursor = $('<div class="mouse-hover-text"></div>');
            $("body").append($cursor);

			slides.each( function() {
				const $slide = $(this);
				
				var $thumb_img = $slide.find("img");
				var $img_title = $thumb_img.attr('title')

        		$slide.on('mousemove', function(e) {
            		const cursorText = $slide.attr('data-cursor') || '';
            		$cursor.text(cursorText);
            		$cursor.css({
                        left: e.clientX + "px",
                        top: e.clientY + "px",
                    });
                    $thumb_img.removeAttr("title");
       			});

        		$slide.on('mouseenter', function() {
        		    $cursor.show();
        		});

       	 		$slide.on('mouseleave', function() {
            		$cursor.hide();
            		$thumb_img.attr('title', $img_title);
        		});

			});
		}
	}

	function ceaCPTAjaxLoad(cpt_ele) {
		var ctp_ele = $(cpt_ele);

		const loadMoreBtn = ctp_ele.find(".cpt-load-more");

		const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    loadMoreBtn.click();
                }
            });
        });
		
		if( loadMoreBtn.length ) {
			var loadMoreContainer;
			const cptType = loadMoreBtn.data('cpt');
			if ( cptType === 'cea-portfolio' ) {
				loadMoreContainer = ctp_ele.find('#portfolio-load-more-container');
			} else if ( cptType === 'cea-service' )  {
				loadMoreContainer = ctp_ele.find('#service-load-more-container');
			} else if ( cptType === 'cea-event' )  {
				loadMoreContainer = ctp_ele.find('#event-load-more-container');
			} else if ( cptType === 'cea-team' )  {
				loadMoreContainer = ctp_ele.find('#teams-load-more-container');
			}
			
			loadMoreContainer.addClass('row');
			const elementSet = loadMoreBtn.data('elementor');
			Object.entries(elementSet);

			if ( loadMoreBtn.hasClass('load-btn-scroll') ) {
				observer.observe(loadMoreBtn[0]);
			}

			let currentPage = 1;
			loadMoreBtn.on('click', function() {
				currentPage++;

				$.ajax({
					url: cea_ajax_var.ajax_url,
					type: 'POST',
					data: {
						action: 'cea_cpt_load_more',
						page: currentPage,
						cpt_type: cptType,
						element_set: elementSet,
					},
					beforeSend: function () {
						loadMoreBtn.text('Loading...'); 
					},
					success: function (response) {
						if (response.success && response.data.items) {
							const newItems = $(response.data.items);
							loadMoreContainer.append(newItems);
							if ( response.data.items == '<p class="alert alert-danger load-more-text w-100">No more post to load.</p>' ) {
								loadMoreBtn.hide();
								setTimeout(function () {
                                    loadMoreContainer.find(".load-more-text").fadeOut(500, function () {
                                            $(this).remove();
                                        });
                                }, 2000);
							} else {
								loadMoreBtn.text("Load More");
							}
						} else {
							loadMoreBtn.hide(); 
						}
					},
					error: function (error) {
						loadMoreBtn.text('Button Error');
						console.log(error);
					},
				});
			});
		}

	}

	function ceaOwlSettings(c_owlCarousel){
		var c_owlCarousel = $(c_owlCarousel);

		var loop = c_owlCarousel.data( "loop" );
		var navRotate = c_owlCarousel.data("nav-rotate") || 0;
		var navZIndex = c_owlCarousel.data("nav-z-index") || 'auto'; 
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
		var autoplayDir = c_owlCarousel.data("autoplaydir") || "default";
		var autoplayHoverPause = c_owlCarousel.data("pauseonhover");
		var rewind = c_owlCarousel.data( "lazyload");
		var rewind = c_owlCarousel.data( "rewind");
		var mouseDrag = c_owlCarousel.data( "mousedrag");
		var navprev = c_owlCarousel.data( "preview-icon" );
		var navnext = c_owlCarousel.data( "next-icon" );
		var naviconcolor = c_owlCarousel.data( "icon-color" );
		var naviconsize = c_owlCarousel.data( "icon-size" );
		var naviconbgcolor = c_owlCarousel.data( "icon-bg-color" );
		var naviconborderradius = c_owlCarousel.data( "icon-border-radius" );
		var pagination_color = c_owlCarousel.data( "pagination-color" );
		var navRotate = c_owlCarousel.data( "nav-rotate" );
		var dotsTransform = c_owlCarousel.data( "dots-rotate" );
		var nav_enable_icon_text = c_owlCarousel.data("nav-type"); 
		var nav_prev_text = c_owlCarousel.data( "prev-text" );
		var nav_next_text = c_owlCarousel.data( "next-text" );
		var nav_padding = c_owlCarousel.data( "nav-padding");
		var navTextPrev = '';
		var navTextNext = '';
		if (nav_enable_icon_text === 'nav-icon') {
			navTextPrev = '<i class="' + navprev + '" style="color:' + naviconcolor + '; font-size:' + naviconsize + 'px; background-color:' + naviconbgcolor + '; border-radius:' + naviconborderradius + '%; padding:' + nav_padding + 'px;"></i>';
			navTextNext = '<i class="' + navnext + '" style="color:' + naviconcolor + '; font-size:' + naviconsize + 'px; background-color:' + naviconbgcolor + '; border-radius:' + naviconborderradius + '%; padding:' + nav_padding + 'px;"></i>';
		} else if (nav_enable_icon_text === 'nav-text') {
			navTextPrev = '<span style="color:' + naviconcolor + '; font-size:' + naviconsize + 'px; background-color:' + naviconbgcolor + '; border-radius:' + naviconborderradius + '%; padding:' + nav_padding + 'px;">' + nav_prev_text + '</span>';
			navTextNext = '<span style="color:' + naviconcolor + '; font-size:' + naviconsize + 'px; background-color:' + naviconbgcolor + '; border-radius:' + naviconborderradius + '%; padding:' + nav_padding + 'px;">' + nav_next_text + '</span>';
		}
		
		var rtl = $( "body.rtl" ).length || autoplayDir == "reverse" ? true : false;

		if (c_owlCarousel.hasClass("vertical-carousel")) {
			let prevoisIndex = 0;
			$(c_owlCarousel).owlCarousel({
                items: 1,
                rewind: rewind,
                rtl: rtl,
                loop: true,
                autoplayTimeout: duration,
                smartSpeed: smartspeed,
                center: center,
                margin: margin,
                nav: navigation,
                dots: dots_,
                autoplay: autoplay,
                autoheight: autoheight,
                autoplayHoverPause: autoplayHoverPause,
                mouseDrag: false,
                touchDrag: false,
                pullDrag: false,
                animateOut: "animate__slideOutUp",
                navElement:
                    'button type="button" name="prev-slide" role="presentation"',
                navText: [navTextPrev, navTextNext],
                onTranslate: function (event) {

					$(event.target).find(".owl-item").removeClass('animate__animated animate__slideInUp animate__slideInDown animate__slideOutUp animate__slideOutDown');

                    const newIndex = event.relatedTarget.relative(
                        event.item.index
                    );
                    const totalItems = event.item['count'];
                    let direction = "down";

                    if ( (newIndex > prevoisIndex && prevoisIndex !== 0 ) || ( newIndex == 0 && prevoisIndex == totalItems - 1 ) || ( newIndex == 1 && prevoisIndex < newIndex ) ) {
                        direction = "down";
                    } else if ( prevoisIndex == 0 && newIndex == totalItems - 1 ) {
						direction = "up";
					} else {
						direction = "up";
					}

                    const inClass =  direction === "down" ? "animate__slideInUp" : "animate__slideInDown";
					const outClass = direction === "down" ? "animate__slideOutUp" : "animate__slideOutDown";

					const $curr_ele = $(event.target).find(".owl-item").eq(event.item.index);
					$curr_ele.addClass("animate__animated " + inClass);
					
					$(event.target).find(".owl-item").eq(event.item.index - 1).addClass("animate__animated " + outClass);
					$(event.target).find(".owl-item").eq(event.item.index + 1).addClass("animate__animated " + outClass);

                    prevoisIndex = newIndex;
                },
            });
        } else {
		$(c_owlCarousel).owlCarousel({
			rewind: rewind,
			mouseDrag: mouseDrag,
			autoplayHoverPause: autoplayHoverPause,
			rtl: rtl,
			loop: loop,
			autoplayTimeout: duration,
			smartSpeed: smartspeed,
			center: center,
			margin: margin,
			nav: nav,
			dots: dots_,
			autoplay: autoplay,
			autoheight: autoheight,
			slideBy: scrollby,
			navElement: 'button type="button" name="prev-slide" role="presentation"',
			navText: [navTextPrev, navTextNext],
			responsive: {
				0: {
					items: items_mob,
				},
				544: {
					items: items_tab,
				},
				992: {
					items: items,
				}
			},
			onInitialized: function(event) {
				var $carousel = $(event.target);
				
				// Add custom class to navigation buttons
				$carousel.find('.owl-prev').addClass('custom-prev-button');
				$carousel.find('.owl-next').addClass('custom-next-button');
		
				// Additional CSS modifications if needed
				$carousel.find('.owl-nav').css({
					'z-index': navZIndex
				});
		
				$carousel.find('.owl-dots button.owl-dot').css({
					'transform': `rotate(${dotsTransform}deg)`,
				});

			},
			onTranslate: function(event) {
				$(event.target)
					.find(".slide-title-wrapper, .slide-content-wrapper, .slider-foreground-image_1, .slider-foreground-image_2, .slider-foreground-image_3, .slider-foreground-image_4, .slider-foreground-image_5, .slider-button, .slider-button-2")
					.each(function() {
						var $element = $(this);
						var animation = $element.data("animation");
						$element.removeClass("animate__" + animation);
					});
			},
			onTranslated: function(event) {
				$(event.target)
					.find(".slide-title-wrapper, .slide-content-wrapper, .slider-foreground-image_1, .slider-foreground-image_2, .slider-foreground-image_3, .slider-foreground-image_4, .slider-foreground-image_5, .slider-button, .slider-button-2")
					.each(function() {
						var $element = $(this);
						var animation = $element.data("animation");
						var delay = $element.data("delay") || 0;
						setTimeout(function() {
							$element.addClass("animate__" + animation);
						}, delay);
					});
			}
		});	
		$(window).on('load', function() {
			$('.owl-carousel').trigger('refresh.owl.carousel');
		});
	}
	
	jQuery.fn.redraw = function() {
		return this.hide(0, function() {
			$(this).show();
		});
	};
	
} })( jQuery );
