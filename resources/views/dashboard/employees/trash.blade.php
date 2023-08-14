@extends('layouts.dashboard.master')
@section('title')
<h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">All Trashed Categories</h5>
@endsection
@push('style')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endpush
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item text-muted">
        <a href="{{ route('dashboard.categories.index') }}" class="text-muted mr-2">Categories</a>
    </li>
    <li class=" text-muted">
        <a href="{{ route('dashboard.categories.trash') }}" class="text-muted mr-2">Trashed Category</a>
    </li>
@endsection
@section('content')
    <div class="col-12">
        {{-- begin::Card --}}
        <div class="card card-custom">
           
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
                                            rowspan="1" colspan="1" style="width: 10%;" aria-sort="ascending"
                                            aria-label="Order ID: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="width: 20%;"
                                            aria-label="Country: activate to sort column ascending">Category Name</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="width: 20%;"
                                            aria-label="Country: activate to sort column ascending">Slug</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="width: 15%;"
                                            aria-label="Ship Address: activate to sort column ascending">Parent Category</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="width: 15%;"
                                            aria-label="Ship Address: activate to sort column ascending">Status</th>
                                        <th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1"
                                            colspan="1" style="width: 16%; "
                                            aria-label="Company Name: activate to sort column ascending">Deleted At</th>
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
    <script src="{{ asset('assets/js/pages/crud/datatables/data-sources/ajax-server-side-trashed-category.js') }}"></script>
    <script src="{{ asset('assets/js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/js/pages/features/miscellaneous/sweetalert2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--end::Page Scripts-->
    <script>
        var config = {
            routes: {
                zone: "{{ route('dashboard.categories.trashed-list') }}"
            }
        };
    </script>
    <script>
        $(document).ready(function() {
           
            //Begin Ajax Restore Category
            $('body').on('click', '.restoreBtn', function() {
                let categoryID = $(this).data('id');
                let _restoreURL = "{{ route('dashboard.categories.restore', ':categoryID') }}";
                _restoreURL = _restoreURL.replace(':categoryID', categoryID);
                Swal.fire({
                    title: "Are you sure restore this?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, Restored it!"
                }).then(function(result) {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: _restoreURL,
                            method: "PUT",
                            data: {
                                'id': categoryID
                            },
                            success: function(response) {
                                Swal.fire(
                                    "Restored!",
                                    response.message,
                                    "success"
                                );
                                $('#kt_datatable').DataTable().draw();
                                setTimeout("window.location.href='{{ route('dashboard.categories.index') }}';",3000);

                            },
                            error: function(error) {
                                toster.error('Somthing Error Try Again Later!')
                            }
                        })
                    }
                });


            })
            //End Ajax Restore  Category
            
            //Begin Ajax Force Delete Category
            $('body').on('click', '.forceDelBtn', function() {
                let categoryID = $(this).data('id');
                let _forecDeleteURL = "{{ route('dashboard.categories.force-delete', ':categoryID') }}";
                _forecDeleteURL = _forecDeleteURL.replace(':categoryID', categoryID);
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
                            url: _forecDeleteURL,
                            method: "DELETE",
                            data: {
                                'id': categoryID
                            },
                            success: function(response) {
                                Swal.fire(
                                    "Deleted Forever!",
                                    response.message,
                                    "success"
                                );
                                $('#kt_datatable').DataTable().draw();
                                setTimeout("window.location.href='{{ route('dashboard.categories.index') }}';",3000);

                            },
                            error: function(error) {
                                toster.error('Somthing Error Try Again Later!')
                            }
                        })
                    }
                });


            })
            //End Ajax Force Delete Category
            

        })
    </script>
@endpush
