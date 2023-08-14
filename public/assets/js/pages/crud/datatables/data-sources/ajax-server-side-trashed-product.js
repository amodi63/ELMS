"use strict"; 
var KTDatatablesDataSourceAjaxServer = function() {

	var initTable1 = function()  {
		var table = $('#kt_datatable');

		// begin first table	
		table.DataTable({
			responsive: true,
			searchDelay: 500,
			processing: true,
			serverSide: true,
			order:[[0,"desc"]],
			ajax: {
				url: config.routes.zone,
				type: 'get',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
						'id', 'name','slug','image','store_name',
						'price','compare_price', 'created_at', 'action'
						
					],
				},
			},
			columns: [
				{data: 'id'},
				{data: 'name'},
			
				{data: 'image', render:function(data, type, row) {
					
					return "<img src= '"+ data +"' height='50'>";
				} },
				{data: 'store_name'},
				{data: 'price'},
				{data: 'compare_price'},
				{data: 'status', render:function(data,type,row){
					if (data == 'active'){
						return "<span class='badge bg-success text-light'>" + data + "</span>";
					}
					if (data == 'archived'){
						return "<span class='badge bg-danger text-light'>" + data + "</span>";
					}
					if (data == 'draft'){
						return "<span class='badge bg-warning text-light'>" + data + "</span>";
					}
				}},
				{data: 'deleted_at.display'},
				{data:'action'}
				
			]
			,
			columnDefs: [
				{
					targets: [-1],
					className:"d-flex justify-content-center"
				},
			]
			
		});
	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceAjaxServer.init();
});
