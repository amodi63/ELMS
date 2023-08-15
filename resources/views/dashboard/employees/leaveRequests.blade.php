@extends('layouts.dashboard.master')
@section('title')
    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Requests</h5>
@endsection
@push('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('employees.index') }}" class="text-muted mr-2">Requests</a>
    </li>
@endsection
@section('content')
    <div class="col-12">
        {{-- begin::Card --}}
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    {{-- <span class="card-icon">
                        <i class="flaticon2-supermarket text-primary"></i>
                    </span> --}}
                    <a href="javascript:void(0);" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">@if (isset($employee->full_name))All Requests: {{  $employee->full_name  }} @else All Employees Leave Requests @endif </a>
                    {{-- <h3 class="card-label">[]</h3> --}}
                </div>
                <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    {{-- <div class="dropdown dropdown-inline mr-2">
                        <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="svg-icon svg-icon-md">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path
                                            d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z"
                                            fill="#000000" opacity="0.3"></path>
                                        <path
                                            d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z"
                                            fill="#000000"></path>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>Export</button>
                       
                    </div> --}}
                    <!--end::Dropdown-->
                    <!--begin::Button-->
                    @if(Auth::user()->type === 'employee')
                    <button href="javascript:void(0);" class="btn btn-primary font-weight-bolder" data-toggle="modal"
                        data-target=".addRequestModal" id="add_employee" data-url="{{ route('employee.leaveRequests.store') }}" data-employee="{{ Auth::user()->id }}">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <circle fill="#000000" cx="9" cy="15" r="6"></circle>
                                    <path
                                        d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                        fill="#000000" opacity="0.3"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Add Leave Request</button>
                        @endif
                    <!--end::Button-->

                  

                </div>
            </div>
            <div class="card-body">

                <!--begin Modal-->
                @include('dashboard.employees.modals._leave_request')
                <!--end Modal -->
                <!--begin: Datatable-->
                <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-hover table-checkable dataTable no-footer dtr-inline"
                                id="kt_datatable" style="margin-top: 13px !important; width: 979px;" role="grid"
                                aria-describedby="kt_datatable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="kt_datatable"
                                            rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID">#</th>
                                        <th class="sorting sorting_asc" tabindex="0" aria-controls="kt_datatable"
                                            rowspan="1" colspan="1" aria-sort="ascending" aria-label="Emp. Name">Employee</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" aria-label="Leave Type">Leave</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" aria-label="Start Date">Start</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" aria-label="End Date">End</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" aria-label="Count Days">Days</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" aria-label="Status">Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" aria-label="Comments">Comments</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" aria-label="Created At">Created</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" aria-label="Actions">Actions</th>
                                    </tr>
                                    
                                    
                                    
                                </thead>
                                <tbody>



                                </tbody>
                            </table>
                            <div id="kt_datatable_processing" class="dataTables_processing card" style="display: none;">
                                Processing...</div>
                        </div>
                    </div>
                    <div class="row">


                    </div>
                </div>
                <!--end: Datatable-->
            </div>
        </div>
        {{-- end::Card --}}
    </div>

@endsection
@push('scripts')
<script>
      
    let emp_id = "{{ request()->route('employee') }}";
    let _listURL = "{{ route('employee.leaveRequests.list', ':emp_id') }}";

    _listURL = _listURL.replace(':emp_id', emp_id);
    
   
</script>
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('pages/leaveRequests/index.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/js/pages/features/miscellaneous/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/pages/features/miscellaneous/toastr.js?v=7.2.9') }}"></script>
    
        <script src="{{ asset('assets/js/pages/crud/file-upload/image-input.js?v=7.2.9') }}"></script>
		<script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}"></script>

    <!--end::Page Scripts-->
    
    

@endpush
