
"use strict"; 
$(document).ready(function() {
    //Begin Ajax Add Employee
    $('body').on('click', '.changeLeaveRequestStatus', function() {

        let _url = $(this).data('url');
        let leaveRequest = $(this).data('leave-request-id');
        let action = $(this).data('action');
    
        if (action === 'Deny') {
            Swal.fire({
                title: 'Are you sure to Deny?',
                icon: 'question',
                showCancelButton: true,
                focusConfirm: false,
                html: '<form method="post" class="mb-3" id="taxcode-update" name="taxcodeUpdate">' +
                    '<input id="reason" autofocus minlength="3"  class="form-control" type="text" name="reason" placeholder="Enter Reason">' +
                    '</form>',
                
                preConfirm: () => {
                    const reason = Swal.getPopup().querySelector('#reason').value;
                    if (!reason) {
                        Swal.showValidationMessage('Please enter a reason');
                        return false; 
                    }
                    return reason;
                },
                confirmButtonText: 'Yes',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),
            }).then((result) => {
                if (result.isConfirmed) {
                    const reason = result.value;
                    if (reason) {
                        // Form is submitted only if a reason is provided
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: _url,
                            method: 'POST',
                            data: {
                                'leaveRequest': leaveRequest,
                                'action': action,
                                'comments': reason
                            },
                            dataType: 'json',
                            success: function(response) {
                                toastr.success(response.message);
                                $('#kt_datatable').DataTable().draw();
                            },
                            error: function(error) {
                                toastr.error('Something Error Try Again Later!');
                            }
                        });
                    }
                }
            });
            
            
        } else {
            Swal.fire({
                title: 'Are you sure to ' + action + '?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then(function(result) {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: _url,
                        method: 'POST',
                        data: {
                            'leaveRequest': leaveRequest,
                            'action': action
                        },
                        success: function(response) {
                            toastr.success(response.message);
                            $('#kt_datatable').DataTable().draw();
                        },
                        error: function(error) {
                            toastr.error('Something Error Try Again Later!');
                        }
                    });
                }
            });
        }
    });
    
    
    
    
    //End Ajax Add Employee
    
    



    //Begin Ajax add Request
    $('#save-leave-request-btn').on('click', function() {
        var leave_request_form = $('#leave-request-form')[0];   

        $(this).html('Sending...');
        $(this).attr('disabled', true);

        var _leave_request_url = $('#add_employee').data('url') ;
        var employeeID =  $('#add_employee').data('employee');

        var _data_leave_request = new FormData(leave_request_form);
        _data_leave_request.append('user_id', employeeID);


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: _leave_request_url,
            data: _data_leave_request,
            method: 'POST',
            processData: false,
            contentType: false,
            success: function(response) {
                $('#save-leave-request-btn').attr('disabled', false);
                $('#save-leave-request-btn').html('Send Request');
                $('.addRequestModal').modal('hide');
                $('#kt_datatable').DataTable().draw();
                if (response.status == true) {
                    toastr.success(response.message);
                    $("#leave-request-form")[0].reset();
                } else {
                    toastr.error(response.message);
                    $("#leave-request-form")[0].reset();
                }
            },
            error: function(error) {
                $('#save-leave-request-btn').attr('disabled', false);
                $('#save-leave-request-btn').html('Send Request');
                $.each(error.responseJSON.errors, function(index, value) {
                    $('#' + index + '_error').html(value);
                });

            }
        })
    });
    //End Ajax Add Employee

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
    $('body').on('click', '.delRequestBtn', function() {
        let leaveRequest = $(this).data('leave-request-id');

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
                        'leaveRequest': leaveRequest
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
    $('.addRequestModal').on('hidden.bs.modal', function() {
        $('.text-danger').html('');
        $('#leave_type_id').val("").selectpicker('refresh');
        $('#leave-request-form')[0].reset();
     

    })
    KTDatatablesDataSourceAjaxServer.init();
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
				url: _listURL,
				type: 'get',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
						'leave_type_id', 'start_date','end_date',
						'status', 'created_at', 'action'
						
					],
				},
			},
			columns: [
				{ data: "DT_RowIndex", name: "DT_RowIndex"},
				{ data: "employee_name", name: "employee_name"},

				
				{data: 'leave_type_id', render:function(data, type, row){
                    
                    return row.leave_type.title;
                }},
				{data: 'start_date'},
				{data: 'end_date'},
				{data: 'status',render:function(data, type, row){
                    var badgeClass = '';
                    var statusText = '';
            
                    if (data === 'Approved') {
                        badgeClass = 'badge-success';
                        statusText = 'Approved';
                    } else if (data === 'Deny') {
                        badgeClass = 'badge-danger';
                        statusText = 'Deny';
                    } else {
                        badgeClass = 'badge-primary';
                        statusText = 'Pending';
                    }
            
                    var badge = '<span class="badge ' + badgeClass + '">' + statusText + '</span>';
                    return badge;
                }},
				{data: 'comments'},
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

