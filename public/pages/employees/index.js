
"use strict"; 
$(document).ready(function() {
    KTDatatablesDataSourceAjaxServer.init();
    
    $('#modal-title').html("Create Employee");
    $('#save-btn').html("Save Employee");
    var form = $('#Employee-form')[0];
    //Begin Ajax Add Employee
    $('#save-btn').on('click', function() {
        $('#save-btn').html('Saving...');
        $('#save-btn').attr('disabled', true);

        // $('.text-danger').html('');
        var _data = new FormData(form);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: routes.store,
            data: _data,
            method: 'POST',
            processData: false,
            contentType: false,
            success: function(response) {
                $('#save-btn').attr('disabled', false);
                $('#save-btn').html('Save Employee');
                $('#kt_datatable').DataTable().draw();
                $('.employeeModal').modal('hide');
                if (response) {
                    toastr.success(response.message);
                    $("#Employee-form")[0].reset();
                }
            },
            error: function(error) {
                $('#save-btn').attr('disabled', false);
                $('#save-btn').html('Save Employee');
                $.each(error.responseJSON.errors, function(index, value) {
                    $('#' + index + '_error').html(value);
                });

            }
        })
    });
    //End Ajax Add Employee

    //Begin Ajax Show Employee
    $('body').on('click', '.showLeaveTypesBtn', function() {
        $('#leave-request-form #user_id').val($(this).data('employee'));
       
        $('.addRequestModal').modal('show');

    });
    //End Ajax Show Employee

 

    //Begin Ajax Edit Employee
    $('body').on('click', '.editBtn', function() {
       
        let employeeID = $(this).data('employee');
        let _url = $(this).data('url'); 
        $.ajax({
            url: _url,
            method: 'GET',
            data: {
                employee: employeeID
            },
            success: function(response) {
                $('#modal-title').html("Edit Employee");
                $('#save-btn').html("Update Employee");
                $('#first_name').val(response.data.first_name);
                $('#last_name').val(response.data.last_name);
                $('#email').val(response.data.email);
                $('#phone').val(response.data.phone);
                $('#address').val(response.data.address);
                $('#date_of_birth').val(response.data.date_of_birth);
                $('#gender').val(response.data.gender).selectpicker('refresh');
                $('#emp_id').val(response.data.id);
                $('#kt_image_5').css('background-image', 'url(storage/' + response.data.avatar + ')');
               
                $('.employeeModal').modal('show');

            }

        })


    });

    $('#add_employee').click(function() {

        $('#modal-title').html("Create Employee");
        $('#save-btn').html("Save Changes");
    });
    //End Ajax Edit Employee

    //Begin Ajax Delete Employee
    $('body').on('click', '.delBtn', function() {
        let employeeID = $(this).data('employee');
        let _url = $(this).data('url'); 
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!"
        }).then(function(result) {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: _url,
                    method: "DELETE",
                    data: {
                        'employee': employeeID
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        $('#kt_datatable').DataTable().draw();
                    },
                    error: function(error) {
                        toastr.error('Somthing Error Try Again Later!')
                    }
                })
            }
        });


    })
    //End Ajax Delete Employee
    $('.employeeModal').on('hidden.bs.modal', function() {
        $('.text-danger').html('');
        $('.gender').val("").selectpicker('refresh');
        $('#Employee-form')[0].reset();
        $('#kt_image_5').css('background-image', 'url(' + baseUrl + '/assets/media/users/blank.png)');
       


    })

})

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
				url: routes.list,
				type: 'get',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
						'id', 'name','slug',
						'parent_name','status', 'created_at', 'action'
						
					],
				},
			},
			columns: [
				{ data: "DT_RowIndex", name: "DT_RowIndex"},
				{data: 'avatar.display',render: function(row) {
                
                    return "<img height='60' width='60' src='" + row + "'>";
                }},
				{data: 'full_name', render:function(data, type, row){
                    return data;
                }},
				{data: 'email'},
				{data: 'phone'},
				{data: 'gender'},
				{data: 'date_of_birth'},
			
				{data: 'created_at.display'},
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

