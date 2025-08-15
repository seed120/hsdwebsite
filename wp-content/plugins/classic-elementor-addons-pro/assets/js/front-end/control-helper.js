( function( $ ) {
	"use strict";

	jQuery( window ).on( 'elementor:init', function() {
		
		//Drag drop event
		var ControlDragDropItemView = elementor.modules.controls.BaseData.extend( {
			onReady: function() {
				var self = this;

				var inp = this.ui.textarea;
				var parnt = $(inp).next('.meta-drag-drop-multi-field');
				
				var exist_items = {};
				$(parnt).find( "ul.meta-items" ).each(function( index ) {
					$(this).find( "li" ).each(function( index ) {
						var _key = $(this).data("id");
						var _val = $(this).data("val");
						exist_items[_key] = _val;
					});
				});
				
				var inp_val = $(inp).val(); var _last_parent_key = '';
				if( inp_val ){					
					var obj = ($).parseJSON( inp_val );					
					$.each( obj, function( parent_key, inner_json ) {
						var li_ele = ''; _last_parent_key = parent_key;
						$.each( inner_json, function( key, value ) {
							delete exist_items[key];
							li_ele += '<li data-val="'+ value +'" data-id="'+ key +'" class="ui-sortable-handle">'+ value +'</li>';
						});
						$(parnt).children( 'ul.meta-items[data-part='+ parent_key +']' ).html("");
						$(parnt).children( 'ul.meta-items[data-part='+ parent_key +']' ).append( li_ele );						
					});
				}
				
				//If new items exists append them.
				if( inp_val && exist_items ){	
					var li_ele = '';
					$.each( exist_items, function( key, value ) {
						li_ele += '<li data-val="'+ value +'" data-id="'+ key +'" class="ui-sortable-handle">'+ value +'</li>';
					});
					$(parnt).children( 'ul.meta-items[data-part='+ _last_parent_key +']' ).append( li_ele );
				}

				var dd_json = {};
					
				$(parnt).find( ".meta-items" ).each(function( index ) {
					
					var cur_items = this;

					var auth = $( cur_items ).parent( ".meta-drag-drop-multi-field" ).children( ".meta-items" );
					var part = $(cur_items).data("part");
					dd_json[part] = {};
					$(cur_items).find( "li" ).each(function( index ) {
						dd_json[part][ $(this).data("id") ] = $(this).data("val");
					});
					$(inp).val( JSON.stringify( dd_json ) ).trigger("input");

					$( cur_items ).sortable({
					  connectWith: auth,
					  update: function () {
						
						var t_dd_json = {};
						$(parnt).find( ".meta-items" ).each(function( index ) {
							var t_cur_items = this;
							var t_part = $(t_cur_items).data("part");
							t_dd_json[t_part] = {};
							$(t_cur_items).find( "li" ).each(function( index ) {
								t_dd_json[t_part][ $(this).data("id") ] = $(this).data("val");
							});
							$(inp).val( JSON.stringify( t_dd_json ) ).trigger("input");
						});

					  }
					});
					
				});

				if( inp.val() == '' ){
					$(inp).val( JSON.stringify( dd_json ) );
				}
				
			},

			saveValue: function() {
				//self.setValue( this.ui.textarea.getText() );
			},

			onBeforeDestroy: function() {
				//self.saveValue();
			}
		} );
		elementor.addControlView( 'dragdrop', ControlDragDropItemView );
		
		//Toggle Switch
		/*var ControlToggleSwitchItemView = elementor.modules.controls.BaseData.extend( {
			onReady: function() {
				var self = this;
				
				var inp = this.ui.input;
				
				var chk_box = $(inp).prev(".switch");
				if( $(inp).val() == '' ){
					if( $(chk_box).find(".switch-checkbox").prop("checked") == true ){
						$(inp).val("1").trigger("input");
					}else{
						$(inp).val("0").trigger("input");
					}
				}else{
					if( $(inp).val() == "1" ){
						$(chk_box).find(".switch-checkbox").attr("checked", "checked");
					}else{
						$(chk_box).find(".switch-checkbox").removeAttr("checked", "checked");
					}
				}
				
				$(chk_box).find(".switch-checkbox").click(function(){
					if( $(this).prop("checked") == true ){
						$(inp).val("1").trigger("input");
					}else{
						$(inp).val("0").trigger("input");
					}
				});

			},

			saveValue: function() {
				//self.setValue( this.ui.textarea.getText() );
			},

			onBeforeDestroy: function() {
				//self.saveValue();
			}
		} );
		elementor.addControlView( 'toggleswitch', ControlToggleSwitchItemView );*/
		
		//Items Spacing
		var ControlItemSpacingItemView = elementor.modules.controls.BaseData.extend( {
			onReady: function() {
				var self = this;
				
				var inp = this.ui.textarea;
				if( $("#elementor-preview-iframe").contents().find( ".cea-inline-css" ).length ){
					/* Shortcode CSS Append */
					var css_out = '';
					$("#elementor-preview-iframe").contents().find( ".cea-inline-css" ).each(function() {
						var shortcode = $( this );
						var shortcode_css = shortcode.attr("data-css");		
						css_out += ($).parseJSON( shortcode_css );
					});
					if( css_out != '' ){
						$("#elementor-preview-iframe").contents().find( "head #cea-customizer-css" ).remove();
						$("#elementor-preview-iframe").contents().find( "head" ).append( '<style id="cea-customizer-css">'+ css_out +'</style>' );
					}
				}
				
				$(inp).change(function() {
					var css_out = '';
					$("#elementor-preview-iframe").contents().find( ".cea-inline-css" ).each(function() {
						var shortcode = $( this );
						var shortcode_css = shortcode.attr("data-css");		
						css_out += ($).parseJSON( shortcode_css );
					});
					if( css_out != '' ){
						$("#elementor-preview-iframe").contents().find( "head #cea-customizer-css" ).remove();
						$("#elementor-preview-iframe").contents().find( "head" ).append( '<style id="cea-customizer-css">'+ css_out +'</style>' );
					}
				});

			},

			saveValue: function() {
				//self.setValue( this.ui.textarea.getText() );
			},

			onBeforeDestroy: function() {
				//self.saveValue();
			}
		} );
		elementor.addControlView( 'itemspacing', ControlItemSpacingItemView );
				
	} );
	
	var WidgetBlogHandler = function( $scope, $ ) {
		console.log( $scope );
	};
	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		//elementorFrontend.hooks.addAction( 'frontend/element_ready/blog.default', WidgetBlogHandler );
		console.log( 'ele init' );
	} );
	
}( jQuery ) );