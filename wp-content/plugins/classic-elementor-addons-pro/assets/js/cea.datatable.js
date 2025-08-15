(function($){
	
	$.fn.extend({
		
		makeCeaTable: function ( options ){
			
			var settings = $.extend({
				sort_opt: false,
				search_opt: false,
				search_ele: '',
				pagination_opt: false,
				pagination_ele: '',
				pagination_max_row: 10
			}, options );
			
			var cea_table = this;
			
			var sort_opt = settings.sort_opt;
			var pagination_opt = settings.pagination_opt;
			var search_opt = settings.search_opt;
			
			if( sort_opt ){
				$(cea_table).makeCeaSortable({
					search_opt: settings.search_opt,
					search_ele: settings.search_ele,
					pagination_opt: settings.pagination_opt,
					pagination_ele: settings.pagination_ele,
					pagination_max_row: settings.pagination_max_row
				});
			}
			
			if( !sort_opt && search_opt ){
				//Search Element
				var search_opt = settings.search_opt;
				var pagination_opt = settings.pagination_opt;
				if( search_opt ){
					var search_ele = settings.search_ele;
					$(search_ele).on( "keyup", function() {
						var value = $(this).val().toLowerCase();
						$(cea_table).makeCeaSearchable({
							value: value,
							pagination: pagination_opt,
							pagination_ele: settings.pagination_ele,
							max_row: settings.pagination_max_row
						});
					});
				}
				
				//Pagination Element			
				if( pagination_opt ){
					$(cea_table).makeCeaPagination({
						parent: settings.pagination_ele,
						max_row: settings.pagination_max_row					
					});				
				}
			}
			
			if( !sort_opt && pagination_opt ){
				//Pagination Element			
				if( pagination_opt ){
					$(cea_table).makeCeaPagination({
						parent: settings.pagination_ele,
						max_row: settings.pagination_max_row					
					});				
				}
			}
			
		},
        makeCeaSortable: function( options ){
			
			var settings = $.extend({
				search_opt: false,
				search_ele: '',
				pagination_opt: false,
				pagination_ele: '',
				pagination_max_row: 10
			}, options );
			
            var cea_table = this;			
            var getCellValue = function (row, index){ 
                return $(row).children('td').eq(index).text();
            };      
			
            $(cea_table).find('th').click(function(){
                var table = $(this).parents('table').eq(0);            
                // Sort by the given filter
                var rows = table.find('tr:gt(0)').toArray().sort(function(a, b) {
                    var index = $(this).index();
                    var valA = getCellValue(a, index), valB = getCellValue(b, index);
            
                    return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
                });            
                this.asc = !this.asc;            
                if (!this.asc){
                    rows = rows.reverse();
                }            
                for (var i = 0; i < rows.length; i++){
                    table.append(rows[i]);
                }
            });
			
			//Search Element
			var search_opt = settings.search_opt;
			var pagination_opt = settings.pagination_opt;
			if( search_opt ){
				var search_ele = settings.search_ele;
				$(search_ele).on( "keyup", function() {
					var value = $(this).val().toLowerCase();
					$(cea_table).makeCeaSearchable({
						value: value,
						pagination: pagination_opt,
						pagination_ele: settings.pagination_ele,
						max_row: settings.pagination_max_row
					});
				});
			}
			
			//Pagination Element			
			if( pagination_opt ){
				$(cea_table).makeCeaPagination({
					parent: settings.pagination_ele,
					max_row: settings.pagination_max_row					
				});				
			}
        },
		makeCeaSearchable: function( options  ){		
			var settings = $.extend({
				value: '',
				pagination: '',
				pagination_ele: '',
				max_row: 10
			}, options );
			
			var value = settings.value;
			var pagination = settings.pagination;
			var cea_table = this;

			if( pagination ){
				if( value == '' ){
					var pagination_ele = settings.pagination_ele;
					var max_row = settings.max_row;
					$(pagination_ele).show();
					setTimeout( function(){ $(cea_table).makeCeaPagination({ max_row: max_row }); }, 10 );
				}else{
					var pagination_ele = settings.pagination_ele;
					$(pagination_ele).hide();
				}
			}
			
			cea_table.find('tr').filter( function() {
				$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});			
		},
		makeCeaPagination: function( options  ){	
			var settings = $.extend({
				max_row: 10,
				parent: ''
			}, options );	
			
			var cea_table = this;			
			var pagi_parent = settings.parent;
			var req_num_row = options.max_row;
			
			var tr = $(cea_table).find("tbody tr");
			var total_num_row = $(tr).length;
			var num_pages=0;
			if( total_num_row % req_num_row ==0 ){
				num_pages=total_num_row / req_num_row;
			}
			if( total_num_row % req_num_row >=1 ){
				num_pages=total_num_row / req_num_row;
				num_pages++;
				num_pages=Math.floor( num_pages++ );
			}
			$(pagi_parent).html('');
			var active_class = 'active';
			for(var i=1; i<=num_pages; i++){
				$(pagi_parent).append( '<a href="#" class="'+ active_class +'">'+ i +'</a>' );
				active_class = '';
			}
			$(tr).each(function(i){
				$(this).hide();
				if( i+1 <= req_num_row){
					$(tr).eq(i).show();
				}			
			}).promise().done( function(){
				$(document).find(pagi_parent).find('a').click(function(e){
					
					$(this).parent(".cea-data-table-pagination-wrap").find("a").removeClass("active");
					$(this).addClass("active");
					
					e.preventDefault();
					$tr = $(cea_table).find("tbody tr");
					$tr.hide();
					var page = $(this).text();
					var temp = page - 1;
					var start = temp * req_num_row;
					for(var i=0; i < req_num_row; i++){
						$tr.eq( start + i ).show();
					}
					return false;
				});			
			});
			
		}		
    });
	
})(jQuery);