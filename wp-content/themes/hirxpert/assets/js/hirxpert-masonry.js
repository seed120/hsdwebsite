(function ( $ ) {

    "use strict";

    $.fn.rcmasonrygetbottom = function( json_arr, masonry_parent, cur_ele, $condition ) {
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
    };
 
    $.fn.rcmasonry = function( options ) {
 
        // This is default options.
        var settings = $.extend({
            columns : 3,
            gutter  : 20
        }, options );

        var masonry_parent = this;
        var masonry_item = masonry_parent.children("article");
        var parent_width = masonry_parent.width();
        if( $(window).width() < 768 ) settings.columns = 1;
        var net_width = Math.floor( ( parent_width - ( settings.gutter * ( settings.columns - 1 ) ) ) / settings.columns );
        masonry_item.css({'width': net_width +'px'});

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
                var lowest_arr = $(this).rcmasonrygetbottom(masonry_ele_bottoms, masonry_parent, this, 'lower');
                delete masonry_ele_bottoms[lowest_arr[0]];
                var lowest_top = lowest_arr[1];
                var lowest_left = lowest_arr[2];
                cur_item_bottom = lowest_top + $(this).outerHeight() + settings.gutter;
                masonry_ele_bottoms[index] = cur_item_bottom;
                $(this).css({'top': lowest_top +'px', 'left': lowest_left+'px'});
            }            
        });

        var highest_bottom = $(this).rcmasonrygetbottom(masonry_ele_bottoms, masonry_parent, this, 'higher');
        $(this).css({'height': highest_bottom[1] +'px'});

        return this;
 
    };

 
}( jQuery ));