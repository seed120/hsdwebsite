/*
 * Zozo Megamenu Framework
 * 
 */
(function( $ ) {
    "use strict";
    
    var _cur_menu = '';
    var _cur_json = '';
    var _cur_depth = '';
    var _parent_0 = '';
    var _t_cur_json = '';

    $(document).ready(function() {
        
        $(document).find('.hirxpert-general-settings-form').magnificPopup({
            type: 'inline',
            preloader: false,
            callbacks: {
                close: function() {
                    $("#hirxpert-general-settings-form").removeClass("megamenu-actived menu-depth-"+_cur_depth);
                },
                beforeOpen: function() {

                    _cur_menu = _cur_json = _cur_depth = _t_cur_json = '';

                    _cur_menu = "#edit-menu-item-hirxpert-" + $(this.st.el).data("menu");
                    _cur_depth = $(this.st.el).data("depth");
                    _cur_json = JSON.parse($(_cur_menu).val());
                    if( _cur_json.icon ) $("select.hirxpert-menu-icons").val(_cur_json.icon);
                    else $("select.hirxpert-menu-icons").val(null);

                    if( _cur_json.megamenu ) $("input.hirxpert-megamenu-option").prop( "checked", true );
                    else $("input.hirxpert-megamenu-option").prop( "checked", false );

                    if( _cur_json.megamenucol ) $("select.hirxpert-megamenu-col").val(_cur_json.megamenucol);
                    else $("select.hirxpert-megamenu-col").val('12');

                    if( _cur_json.megamenuwidget ) $("select.hirxpert-megamenu-widget").val(_cur_json.megamenuwidget);
                    else $("select.hirxpert-megamenu-widget").val(null);

                    $("#hirxpert-general-settings-form").addClass("menu-depth-"+_cur_depth);
                    if( _cur_depth !== 0 ) {
                        _cur_json.megamenu = 0;
                        _parent_0 = $(this.st.el).parents("li.menu-item");
                        do{
                            _parent_0 = $(_parent_0).prev("li.menu-item");
                        }while( !$(_parent_0).hasClass("menu-item-depth-0") );
                        _t_cur_json = JSON.parse($("#edit-menu-item-hirxpert-" + $(_parent_0).find(".hirxpert-general-settings-form").data("menu")).val());
                        if( _t_cur_json.megamenu === 1 ) $("#hirxpert-general-settings-form").addClass("megamenu-actived");
                    }

                    // Event listeners
                    $("select.hirxpert-menu-icons").on("change", function(){
                        _cur_json.icon = $(this).val();
                        $(_cur_menu).val(JSON.stringify(_cur_json));
                    });

                    $("input.hirxpert-megamenu-option").on("click", function(){
                        _cur_json.megamenu = $(this).prop("checked") ? 1 : 0;
                        $(_cur_menu).val(JSON.stringify(_cur_json));
                    });

                    $("select.hirxpert-megamenu-col").on("change", function(){
                        _cur_json.megamenucol = $(this).val();
                        $(_cur_menu).val(JSON.stringify(_cur_json));
                    });

                    $("select.hirxpert-megamenu-widget").on("change", function(){
                        _cur_json.megamenuwidget = $(this).val();
                        $(_cur_menu).val(JSON.stringify(_cur_json));
                    });
                }
            }
        });

        var _menu_icons = hirxpert_object.icons;
        $.each(_menu_icons, function( index, value ) {
            let _icon_code = value[2].replace( "\\", "&#x" );
            $(".hirxpert-menu-icons").append( '<option value="'+ $.text(value[1]) +'">'+ $.text(value[1].replace('ti-','')) + ' - '+ $.text(_icon_code) +';</option>' );
        });
    });

	
})( jQuery );
