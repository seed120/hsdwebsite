jQuery(function($) {
	// the upload image button, saves the id and outputs a preview of the image
	var imageFrame;
	$('.meta_box_upload_image_button').click(function(event) {
		event.preventDefault();
		
		var options, attachment;
		
		$self = $(event.target);
		$div = $self.closest('div.meta_box_image');
		
		// if the frame already exists, open it
		if ( imageFrame ) {
			imageFrame.open();
			return;
		}
		
		// set our settings
		imageFrame = wp.media({
			title: 'Choose Image',
			multiple: false,
			library: {
		 		type: 'image'
			},
			button: {
		  		text: 'Use This Image'
			}
		});
		
		// set up our select handler
		imageFrame.on( 'select', function() {
			selection = imageFrame.state().get('selection');
			
			if ( ! selection )
			return;
			
			// loop through the selected files
			selection.each( function( attachment ) {
				var src = attachment.attributes.sizes.full.url;
				var id = attachment.id;
				
				$div.find('.meta_box_preview_image').attr('src', src);
				$div.find('.meta_box_upload_image').val(id);
			} );
		});
		
		// open the frame
		imageFrame.open();
	});
	
	// the remove image link, removes the image id from the hidden field and replaces the image preview
	$('.meta_box_clear_image_button').click(function() {
		var defaultImage = $(this).parent().siblings('.meta_box_default_image').text();
		$(this).parent().siblings('.meta_box_upload_image').val('');
		$(this).parent().siblings('.meta_box_preview_image').attr('src', defaultImage);
		return false;
	});
	
	// the file image button, saves the id and outputs the file name
	var fileFrame;
	$('.meta_box_upload_file_button').click(function(e) {
		e.preventDefault();
		
		var options, attachment;
		
		$self = $(event.target);
		$div = $self.closest('div.meta_box_file_stuff');
		
		// if the frame already exists, open it
		if ( fileFrame ) {
			fileFrame.open();
			return;
		}
		
		// set our settings
		fileFrame = wp.media({
			title: 'Choose File',
			multiple: false,
			library: {
		 		type: 'file'
			},
			button: {
		  		text: 'Use This File'
			}
		});
		
		// set up our select handler
		fileFrame.on( 'select', function() {
			selection = fileFrame.state().get('selection');
			
			if ( ! selection )
			return;
			
			// loop through the selected files
			selection.each( function( attachment ) {
				var src = attachment.attributes.url;
				var id = attachment.id;
				
				$div.find('.meta_box_filename').text(src);
				$div.find('.meta_box_upload_file').val(src);
				$div.find('.meta_box_file').addClass('checked');
			} );
		});
		
		// open the frame
		fileFrame.open();
	});
	
	// the remove image link, removes the image id from the hidden field and replaces the image preview
	$('.meta_box_clear_file_button').click(function() {
		$(this).parent().siblings('.meta_box_upload_file').val('');
		$(this).parent().siblings('.meta_box_filename').text('');
		$(this).parent().siblings('.meta_box_file').removeClass('checked');
		return false;
	});
	
	// function to create an array of input values
	function ids(inputs) {
		var a = [];
		for (var i = 0; i < inputs.length; i++) {
			a.push(inputs[i].val);
		}
		//$("span").text(a.join(" "));
    }
	// repeatable fields
	$('.meta_box_repeatable_add').on('click', function() {
		// clone
		var row = $(this).closest('.meta_box_repeatable').find('tbody tr:last-child');
		var clone = row.clone();
		clone.find('select.chosen').removeAttr('style', '').removeAttr('id', '').removeClass('chzn-done').data('chosen', null).next().remove();
		clone.find('input.regular-text, textarea, select').val('');
		clone.find('input[type=checkbox], input[type=radio]').attr('checked', false);
		row.after(clone);
		// increment name and id
		clone.find('input, textarea, select')
			.attr('name', function(index, name) {
				return name.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			});
		var arr = [];
		$('input.repeatable_id:text').each(function(){ arr.push($(this).val()); }); 
		clone.find('input.repeatable_id')
			.val(Number(Math.max.apply( Math, arr )) + 1);
		if (!!$.prototype.chosen) {
			clone.find('select.chosen')
				.chosen({allow_single_deselect: true});
		}
		//
		return false;
	});
	
	$('.meta_box_repeatable_remove').on('click', function(){
		$(this).closest('tr').remove();
		return false;
	});
		
	$('.meta_box_repeatable tbody').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.hndle'
	});
	
	// post_drop_sort	
	$('.sort_list').sortable({
		connectWith: '.sort_list',
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		cancel: '.post_drop_sort_area_name',
		items: 'li:not(.post_drop_sort_area_name)',
        update: function(event, ui) {
			var result = $(this).sortable('toArray');
			var thisID = $(this).attr('id');
			$('.store-' + thisID).val(result) 
		}
    });

	$('.sort_list').disableSelection();

	// turn select boxes into something magical
	if (!!$.prototype.chosen)
		$('.chosen').chosen({ allow_single_deselect: true });
		
	/*Metabox Tab*/
	$(".cea-admin-tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(this).parents(".cea-admin-tabs-menu").next(".cea-admin-tab").find(".cea-admin-tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
	
	/*CEA Switcher*/
	$('.cea-switcher').change(function() {
        if($(this).is(":checked")) {
			$(this).parents('.cea-switch').find('.cea-switcher-stat').val('1');
        }else{
			$(this).parents('.cea-switch').find('.cea-switcher-stat').val('0');
		}
    });
	
	/*CEA Color Picker*/
	if( $(".cea-color-picker").length ){
		
		var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
		var color, rgb, matches; 
		$(".cea-color-picker").wpColorPicker({
			clear: function() { $(this).parents('td').find('.cea-alpha-color').val(''); },
			change: function (event, ui) {
				var element = event.target;
				color = ui.color.toString();
				
				opacity = $(this).parents('td').find('.alpha-range').val();
				
				matches = patt.exec(color);
				rgb = "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+","+ parseFloat(opacity/10) +")";
				
				
				$(this).parents('td').find('.cea-alpha-color').val(rgb);
				//alert(color);
				// Add your code here
			}
		});
	
		$( ".alpha-range" ).change(function() {
			var opacity = $(this).val(); //cea-alpha-color-picker
			color = $(this).parents('td').find('.cea-alpha-color-picker').val();
			if( rgb != '' ){
				matches = patt.exec(color);
				rgb = "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+","+ parseFloat(opacity/10) +")";
				$(this).parents('td').find('.cea-alpha-color').val(rgb);
			}
		});
		
	}
	
	/* Metabox Multi Image Select */
	var file_frame, upload_btn;

	jQuery(document).on( 'click', '.meta_upload_button', function( event ){

		event.preventDefault();
		
		upload_btn = jQuery(this);

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select Image',
			button: {
				text: 'Upload Image',
			},						
			multiple: true
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			attachment = file_frame.state().get('selection').toJSON();
			var gal_files = [];
			var gal_out = '';
			jQuery.each(attachment , function(key, value){
					gal_files.push(value.id);	
					gal_out += '<div class="zozo_gal_container" id="zozogal-'+(value.id)+'"><img src="'+(value.url)+'" alt="'+(value.id)+'" style="height:100px; width:100px;" /><span class="fa fa-times delgal-img" data-imgid="'+(value.id)+'"></span></div>'; //<span class="fa fa-times" id="delgal-img" data-imgid="'+(value.id)+'"></span></div>';
			});
			gal_out += '<div class="meta_upload_button" type="button"><span class="dashicons dashicons-plus"></span></div>';
			var c_parent = upload_btn.parents('.field-upload');
			c_parent.find('.zozo_gallery_images').empty();
			c_parent.find('.zozo_gallery_images').prepend( gal_out );
			c_parent.find('.zozo_gallery').val( gal_files );
			//upload_btn.parents('.field-upload').find('.meta_remove_button').show();
					
		});
		
		// Finally, open the modal.
		if( file_frame ) {
			file_frame.open();
		}
		
	});
	
	jQuery(document).on( 'click', '.delgal-img', function( event ){
		var current = this;
		var delimg = jQuery(current).attr("data-imgid");	
		var imgids = jQuery(current).parents('.field-upload').children('.zozo_gallery').val();
	
		imgids = imgids.replace(delimg+',', ''); 
		imgids = imgids.replace(delimg, ''); 
		imgids = imgids.replace(/,\s*$/, '');

		jQuery(current).parents('.field-upload').children('.zozo_gallery').val(imgids);
		jQuery(current).parents('.field-upload').find('#zozogal-'+delimg).remove();
	});
	
	/*Meta Drag and Drop Field*/
	jQuery( ".meta-items-enabled" ).each(function( index ) {
		var auth_dis = $( this ).parent('div').find('.meta-items-disabled');
		var cur_items = this;
		jQuery( cur_items ).sortable({
		  connectWith: auth_dis,
		  update: function () {
			var out = '';
			jQuery( cur_items ).children( 'li' ).each(function( index ) {
				out += jQuery(this).attr('data-id') + ',';
			});
			
			out = out.replace(/,\s*$/, "");
			
			/*if( jQuery( cur_items ).next().data('pos') ){
				var cls = '.meta-drag-drop-value-' + jQuery( cur_items ).next().data('pos');
				jQuery(cur_items).parents('.meta-drag-drop-field').children(cls).val(out);
			}else{
				jQuery(cur_items).parents('.meta-drag-drop-field').children('.meta-drag-drop-value').val(out);
			}*/
			jQuery(cur_items).parents('.meta-drag-drop-field').children('.meta-drag-drop-value').val(out);
		  }
		});
	});
	
	jQuery( ".meta-items-disabled" ).each(function( index ) {
		var auth_en = $( this ).parent('div').find('.meta-items-enabled');
		jQuery( this ).sortable({
		  connectWith: auth_en,
		});
	});
	
	jQuery( ".meta-items-enabled" ).on( "sortstart", function( event, ui ) { 
		var parent = $( this ).parent('div').find('.meta-items-disabled');
		$( parent ).addClass('droppable-active');
	});
	jQuery( ".meta-items-disabled" ).on( "sortstart", function( event, ui ) { 
		var parent = $( this ).parent('div').find('.meta-items-enabled');
		$( parent ).addClass('droppable-active');
	});

	jQuery( ".meta-items-disabled, .meta-items-enabled" ).on( "sortstop", function( event, ui ) { 
		var parent = $( this ).parent('div');
		$( parent ).find('.droppable-active').removeClass('droppable-active');
	});
	
	/*Meta Drag and Drop Multi Field*/
	$( ".meta-drag-drop-multi-field .meta-items" ).each(function( index ) {
		var cur_items = this;
		var auth = $( cur_items ).parent( ".meta-drag-drop-multi-field" ).children( ".meta-items" );
		var part = $( cur_items ).data( "part" );
		var final_val = '';
		var t_json = '';
		final_val = $( cur_items ).parent('.meta-drag-drop-multi-field').children( ".meta-drag-drop-multi-value" );
		final_val.val( JSON.stringify( final_val.data( "params" ) ) );
		$( cur_items ).sortable({
		  connectWith: auth,
		  update: function () {

			t_json = ($).parseJSON( final_val.val() );
			t_json[part] = '';
			var t = {};
			$( this ).children( "li" ).each(function( index ) {
				var data_id = $(this).attr('data-id');
				var data_val = $(this).attr('data-val');
				t[data_id] = data_val;
			});
			t_json[part] = t;
			final_val.val( JSON.stringify( t_json ) );

		  }
		});
	});

	
	/* Custom Reqiured Field */
	jQuery('tr.meta-req').hide();
	jQuery( "tr.meta-req" ).each(function( index ) {
		var hidden_ele = this;
		var req_field = '#'+ jQuery(this).attr('data-req');
		var req_val = jQuery(this).attr('data-equal');
		var req_selected = jQuery( req_field ).find(":selected").val();
		if( req_selected == req_val ){
			jQuery(this).show();
		}
		
		jQuery( req_field ).change(function() {
			req_selected = jQuery( this ).find(":selected").val();
			if( req_selected == req_val ){
				jQuery(hidden_ele).show();
			}else{
				if( jQuery( hidden_ele ).find('select').length ){
					var t_val = jQuery(hidden_ele).find('select').attr('id');
					jQuery(hidden_ele).find('select').prop('selectedIndex',0);
					jQuery(hidden_ele).parents('tbody').find('tr').filter('[data-req="'+ t_val +'"]').hide();
				}
				jQuery(hidden_ele).hide();
			}
		});
		
	});
	
	/* Image select metabox */
	jQuery(document).on( 'click', '.page-option-image-select img', function( event ){
		jQuery(this).parents('.page-option-image-select').find('.page-option-image-value').attr('value', jQuery(this).attr('data-value'));
		jQuery(this).parents('.page-option-image-select').find('span img').removeClass('selected');
		jQuery(this).addClass('selected');
	});
	
});