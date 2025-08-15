(function ( $ ) {
 
    $.fn.ceaparallax = function( options ) {
		
        // This is the easiest way to have default options.
        var settings = $.extend({
            left: this.offset().left,
			t_top: 100,
			t_left: 100,
			y_level: 20,
			x_level: 40,
			mouse_animation: 0,
			ele_width: '20px'
        }, options );
		
		this.css({ 'width': settings.ele_width, 'top': settings.t_top + '%', 'left': settings.t_left + '%' });
		
		
		var ele = this;
		var parent_section = ele.parents("section");
		var initialTop = settings.t_top;
		var initialLeft = settings.t_left;
		var floatDistanceX = settings.x_level;
		var floatDistanceY = settings.y_level;

		if( settings.mouse_animation != '1' ){
			if( !parent_section.hasClass('float-parallax-started') ) parent_section.addClass("float-parallax-started");
		} else {
			$(window).mousemove(function(e) {
				if( !parent_section.hasClass('float-parallax-started') ) parent_section.addClass("float-parallax-started");
			
				var xOffset = ((e.clientX - $(window).width() / 2) / floatDistanceX);
				var yOffset = ((e.clientY - $(window).height() / 2) / floatDistanceY);
			
				var last_x = Math.max(-floatDistanceX, Math.min(xOffset, floatDistanceX));
				var last_y = Math.max(-floatDistanceY, Math.min(yOffset, floatDistanceY));
				
				ele.css('top', `calc(${initialTop}% + ${last_y}%)` );
				ele.css('left', `calc(${initialLeft}% + ${last_x}%)` );

			});
		}
 
    };
 
}( jQuery ));
