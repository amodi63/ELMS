@extends('layouts.dashboard.master')
@section('title', "product - $category->name")
@push('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard.categories.index') }}" class="text-muted mr-2">Categories</a>
    </li>
    <li class=" text-muted">
        <a href="{{ route('dashboard.categories.show', $category->id) }}" class="text-muted mr-2">{{ $category->name }}</a>
    </li>
@endsection
@section('content')
    <div class="col-12">
        {{-- begin::Card --}}
        <div class="card card-custom">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-label">{{ $category->name }} </h3> 
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-primary font-weight-bolder" 
                        data-target="#exampleModal" id="add_category">
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
                        </span>All Categories</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
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
                                            rowspan="1" colspan="1" style=" aria-sort="ascending"
                                            aria-label="Order ID: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="
                                            aria-label="Country: activate to sort column ascending">Product Name</th>
                                        {{-- <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="
                                            aria-label="Country: activate to sort column ascending">Slug</th> --}}
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="
                                            aria-label="Country: activate to sort column ascending">Product Image</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="
                                            aria-label="Country: activate to sort column ascending">Store Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="
                                            aria-label="Country: activate to sort column ascending">Price</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="
                                            aria-label="Country: activate to sort column ascending">Special Price</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="
                                            aria-label="Ship Address: activate to sort column ascending">Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style=""
                                            aria-label="Company Name: activate to sort column ascending">Created At</th>
                                        <th class="sorting " tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style=""
                                            aria-label="Company Name: activate to sort column ascending">Actions</th>





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
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/crud/datatables/data-sources/ajax-server-side-product.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/js/pages/features/miscellaneous/sweetalert2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--end::Page Scripts-->
    <script>
        var config = {
            routes: {
                urlList: "{{ route('dashboard.categories.products-list') }}",
                assetURL: "{{asset('storage') }}"
            }
        };
    </script>
    <script>
        $(document).ready(function() {
           
            //Begin Ajax Edit Product
            $('body').on('click', '.productEditBtn', function() {
                let productID = $(this).data('id');
                let _editURL = "{{ route('dashboard.products.edit', ':productID') }}";
                _editURL = _editURL.replace(':productID', productID);
                $.ajax({
                    url: _editURL,
                    method: 'GET',
                    data: {
                        id: productID
                    },
                    success: function(response) {
                        window.location.replace(_editURL);
                    }
                })
            });
            //End Ajax Edit Product

            //Begin Ajax Delete Product
            $('body').on('click', '.productDelBtn', function() {
                let productID = $(this).data('id');
                let _deleteURL = "{{ route('dashboard.products.destroy', ':productID') }}";
                _deleteURL = _deleteURL.replace(':productID', productID);
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
                            url: _deleteURL,
                            method: "DELETE",
                            data: {
                                'id': productID
                            },
                            success: function(response) {
                                toastr.success(response.message);
                                $('#kt_datatable').DataTable().draw();
                            },
                            error: function(error) {
                                toster.error('Somthing Error Try Again Later!')
                            }
                        })
                    }
                });


            })
            //End Ajax Delete Product

        })
    </script>
@endpush
