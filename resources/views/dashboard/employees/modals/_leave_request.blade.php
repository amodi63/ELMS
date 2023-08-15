<div class="modal fade  addRequestModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <form id="leave-request-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Leaves Types</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">

                    <x-form.input id="leaveRequest" name="leave_request_id" type="hidden" />

                    <div class="row">
                            <div class=" col-md-12">
                                <div class="form-group">
                                    
                                    @isset($leave_types)
                                        <x-form.label label='Select Leave Type' />
                                        <x-form.select name="leave_type_id" id="leave_type_id" :options="$leave_types" data-live-search="true" />
                                        <x-form.span id="leave_type_id_error" />
                                    @endisset
                                    
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <x-form.label label='Start Date' class="text-right " />
                            <x-form.input id="start_date" type="text" name="start_date" />
                            <x-form.span id="start_date_error" />
                        </div>
                        <div class="col-md-5">
                            <x-form.label label='End Date' class="text-right " />
                            <x-form.input id="end_date" type="text" name="end_date" />
                            <x-form.span id="end_date_error" />
                        </div>
                        <div class="col-md-2">
                            <x-form.label label='N.O.D' class="text-right " />
                            <x-form.input id="num_days" type="text" name="num_days" readonly />
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" id="save-leave-request-btn"class="btn btn-primary font-weight-bold">Send
                    Request</button>
            </div>
            </form>
        </div>
    </div>
    </div>
