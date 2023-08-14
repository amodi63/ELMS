
(function($) {
    $('#confirm-btn').on('click', function(e) {
        e.preventDefault();
        let _url = $('#confirm-password-form').attr('action');
        let _data = $("#confirm-password-form input[name=password]").val();
        $('#confirm-btn').html('Saving...');
        $('#confirm-btn').attr('disabled', true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: _url,
            method: 'post',
            data: {
                'password': _data
            },
            success: response => {
                $('#confirm-btn').attr('disabled', false);
                        $('#confirm-btn').html('confirm');
                        if(response.status == false){
                            toastr.error(response.message);
                            $('#two-factor-content').removeClass('d-none');
                        }
                        if(response.status == true){
                            
                            $('#two-factor-enable').removeClass('d-none');
                            $('#confirm-content').addClass('d-none');
                        }
                        
            },
            error:error=>{

                $('#confirm-btn').attr('disabled', false);
                    $('#confirm-btn').html('confirm');
                    $.each(error.responseJSON.errors, function(index, value) {
                        toastr.error(value);
                        // $('#' + index + '_error').html(value);
                    });
            }

                
        });
        
    });
    $('#enable-btn').on('click', function(e) {
        e.preventDefault();
        $('#enable-btn').html('Saving...');
        $('#enable-btn').attr('disabled', true);
        $('#enBtn').attr('disabled', true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: enableURL,
            method: 'post',
            success: response => {
                $('#enable-btn').attr('disabled', false);
                        $('#enable-btn').html('Enable');
                        toastr.success("Enable To 2FA Successfully!");    
                        // $('.2faModal').modal('hide');       
            },
            error:error=>{

                $('#enable-btn').attr('disabled', false);
                    $('#enable-btn').html('confirm');
                    $.each(error.responseJSON.errors, function(index, value) {
                        toastr.error(value);
                        // $('#' + index + '_error').html(value);
                    });
            }

                
        });
        
    });
    $('#disable_2fa').on('click', function(e) {
        e.preventDefault();
        $('#disable_2fa').html('Saving...');
        $('#disable_2fa').attr('disabled', true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $('#disable_2fa_form').attr('action'),
            method: 'delete',
            success: response => {
                $('#disable_2fa').attr('disabled', false);
               
                toastr.success('Disaled 2FA Successfully!');
                           
            },
            error:error=>{
                $('#disable_2fa').attr('disabled', false);
                    $('#disable_2fa').html('Disable');
                    $('#two-factor-content').addClass('d-none');
                    $('#two-factor-content').removeClass('d-grid');
                        // toastr.error("Sorry! There IS Error Try Another Time Please..");
                        toastr.success("Making Disabled 2FA Succssfully");
                   
            }

                
        });
        
    });

    $('.2faModal').on('hidden.bs.modal', function() {
        $('#confirm-password-form')[0].reset();
        location.reload();
        

    })
})(jQuery);