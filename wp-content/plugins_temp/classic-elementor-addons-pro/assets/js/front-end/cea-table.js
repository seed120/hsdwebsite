(function($){

	var cea_data_table_active_cell = null;
	var cea_data_table_update_status = 0;
	
	/* Offcanvas Handler */
	var WidgetCeaDataTableHandler = function( $scope, $ ){
		if( $scope.find(".cea-data-table-elementor-widget").length && isEditMode ){
			var table = $scope.find(".cea-data-table");
			cea_table_event_create( table );
		}
		if( $scope.find(".cea-data-table-elementor-widget").length && !isEditMode ){			
			var table_ele = $scope.find(".cea-data-table-elementor-widget .cea-data-table");
			var table_id = $scope.find(".cea-data-table-elementor-widget").find(".cea-data-table-inner").data("shortcode-id");
			var sort_stat = $(table_ele).data("sort");
			var search_stat = $(table_ele).data("search");
			var page_stat = $(table_ele).data("page");
			var page_max = $(table_ele).data("page-max");
			page_max = page_max ? parseInt( page_max ) : 10;
			
			$scope.find(".cea-data-table-elementor-widget .cea-data-table").makeCeaTable({
				sort_opt: sort_stat,
				search_opt: search_stat,
				search_ele: $('#cea-data-table-input-'+table_id),
				pagination_opt: page_stat,
				pagination_ele: $('#cea-table-pagination-'+table_id),
				pagination_max_row: page_max
			});
		}
	};
	
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/ceadatatable.default', WidgetCeaDataTableHandler );
	});
	
	var cea_table_event_create = function( table ){		

		$(table).find( "td" ).on( "contextmenu", function(el){
			cea_data_table_active_cell = el.target;
		});
	
		$(table).find( "th, td" ).on( "dblclick", function(el){
			cea_data_table_update_status = 1;
			var value = $(this).html() ? $(this).html() : '';				
			if( !$(this).children('textarea').length ){
				$(this).addClass("cea-table-edit-column");
				$(this).html( '<textarea rows="1" class="cea-table-edit-box">' + value + '</textarea>' );
				$(this).children('textarea').focus();
			}
		});
		
		$(table).find( "th > textarea, td > textarea" ).on( "click", function(el){
			$(this).focus();
		});
		
	};
	
	var cea_data_table_update_model = function( model, container, refresh, value ) {
		model.remoteRender = refresh;
		var settings = container.settings.attributes;
		
		settings.cea_data_table_static_html = value.cea_data_table_static_html;

		parent.window.$e.run("document/elements/settings", {
			container: container,
			settings: settings,
			options: {
				external: refresh
			}
		});		
	};
	
	var cea_data_table_update = function( view, refresh, value ){
		var model = view.model;
		model.remoteRender = refresh;

		var container = view.getContainer();
		var settings = view.getContainer().settings.attributes;
		
		var table = view.el.querySelector(".cea-data-table");
		settings.cea_data_table_static_html = $(table).html();

		parent.window.$e.run("document/elements/settings", {
			container: container,
			settings: settings,
			options: {
				external: refresh
			}
		});
	};
	
	// Inline edit
	var cea_data_table_events = function( panel, model, view ){
		var localRender = function() {
			var interval = setInterval(function() {
				if (view.el.querySelector(".cea-data-table")) {
					var table = view.el.querySelector(".cea-data-table");
					
					$(table).find( "th, td" ).on( "click", function(el){
						cea_data_table_active_cell = null;
						if( !$(this).children("textarea").length && cea_data_table_update_status ) {
							cea_table_textarea_remove(table);
							cea_data_table_update( view, false, {} );
							cea_data_table_update_status = 0;
						}
					});

					clearInterval(interval);
				}
			}, 10);
		};

		// init
		localRender();

		// after render
		model.on("remote:render", function() {
			localRender();
		});		

	};
	
	var cea_data_table_context_menu = function( groups, element ) {
		if( element.options.model.attributes.widgetType == "ceadatatable" ) {
			groups.push({
				name: "ceadatatable",
				actions: [
					{
						name: "add_row_above",
						title: "Add Row Above",
						callback: function() {
							var table = document.querySelector(".cea-data-table");
							if( cea_data_table_active_cell !== null ) {
								var index = cea_data_table_active_cell.parentNode.rowIndex;
								var row = table.insertRow(index);
								for (var i = 0; i < table.rows[0].cells.length; i++) {
									var cell = row.insertCell(i);
								}
								cea_data_table_active_cell = null;							
								var origTable = table.cloneNode(true);							
								cea_data_table_update_model(element.options.model, element.container, false, {
									cea_data_table_static_html: origTable.innerHTML
								});							
								cea_table_event_create(table);	
								
							}
						}
					},
					{
						name: "add_row_below",
						title: "Add Row Below",
						callback: function() {
							var table = document.querySelector(".cea-data-table");
							if( cea_data_table_active_cell !== null ) {
								var index = cea_data_table_active_cell.parentNode.rowIndex + 1;
								var row = table.insertRow(index);
								for (var i = 0; i < table.rows[0].cells.length; i++) {
									var cell = row.insertCell(i);
								}
								cea_data_table_active_cell = null;
								var origTable = table.cloneNode(true);							
								cea_data_table_update_model(element.options.model, element.container, false, {
									cea_data_table_static_html: origTable.innerHTML
								});							
								cea_table_event_create(table);
							}
						}
					},
					{
						name: "add_column_left",
						title: "Add Column Left",
						callback: function() {
							var table = document.querySelector(".cea-data-table");
							if (cea_data_table_active_cell !== null) {
								var index = cea_data_table_active_cell.cellIndex;
								for (var i = 0; i < table.rows.length; i++) {
									var cell = table.rows[i].insertCell(index);
								}
								cea_data_table_active_cell = null;
								var origTable = table.cloneNode(true);							
								cea_data_table_update_model(element.options.model, element.container, false, {
									cea_data_table_static_html: origTable.innerHTML
								});							
								cea_table_event_create(table);
							}
						}
					},
					{
						name: "add_column_right",
						title: "Add Column Right",
						callback: function() {
							var table = document.querySelector(".cea-data-table");
							if (cea_data_table_active_cell !== null) {
								var index = cea_data_table_active_cell.cellIndex + 1;
								for (var i = 0; i < table.rows.length; i++) {
									var cell = table.rows[i].insertCell(index);
								}
								cea_data_table_active_cell = null;
								var origTable = table.cloneNode(true);							
								cea_data_table_update_model(element.options.model, element.container, false, {
									cea_data_table_static_html: origTable.innerHTML
								});							
								cea_table_event_create(table);
							}
						}
					},
					{
						name: "delete_row",
						title: "Delete Row",
						callback: function() {
							var table = document.querySelector(".cea-data-table");
							if (cea_data_table_active_cell !== null) {
								var index = cea_data_table_active_cell.parentNode.rowIndex;
								table.deleteRow(index);
								cea_data_table_active_cell = null;
								var origTable = table.cloneNode(true);							
								cea_data_table_update_model(element.options.model, element.container, false, {
									cea_data_table_static_html: origTable.innerHTML
								});	
							}
						}
					},
					{
						name: "delete_column",
						title: "Delete Column",
						callback: function() {
							var table = document.querySelector(".cea-data-table");
							if (cea_data_table_active_cell !== null) {
								var index = cea_data_table_active_cell.cellIndex;
								for (var i = 0; i < table.rows.length; i++) {
									table.rows[i].deleteCell(index);
								}
								cea_data_table_active_cell = null;
								var origTable = table.cloneNode(true);							
								cea_data_table_update_model(element.options.model, element.container, false, {
									cea_data_table_static_html: origTable.innerHTML
								});	
							}
						}
					}
				]
			});
		}
		return groups;
	};	
	
	window.isEditMode = false;
	$(window).on("elementor/frontend/init", function() {		
		window.isEditMode = elementorFrontend.isEditMode();
		if (isEditMode) {
			elementor.hooks.addFilter("elements/widget/contextMenuGroups", cea_data_table_context_menu );
			elementor.hooks.addAction( "panel/open_editor/widget/ceadatatable", cea_data_table_events );
			
			/*elementor.hooks.addAction( 'panel/open_editor/section', function( panel, model, view ) {
				console.log("test");
			});*/
		}
	});
	
	function cea_table_textarea_remove(table){
		$(table).find('th > textarea, td > textarea').each(function( index ) {
			var column_out = $(this).val();
			var column = $(this).parent();
			$(column).removeClass("cea-table-edit-column");
			$(column).html(column_out);
		});		
	}
	
})(jQuery);