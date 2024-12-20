@extends('layouts.master')
@section('title')
    @lang('translation.list-js7')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="row">
         <div class="col-xxxl-6">
            @if (session('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                    <i class="ri-notification-off-line me-3 align-middle fs-16"></i><strong>Success</strong>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0" role="alert">
                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Danger</strong>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Gram Annual Maintenance</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                
                                    <a href="{{ route('annual-maintenance.create') }}">
                                    <button type="button" class="btn btn-success add-btn" ><i
                                            class="ri-add-line align-bottom me-1"></i> Add</button>
                                        </a>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive  mt-3 mb-1">
                            <table class="table table-bordered align-middle table-nowrap" id="">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">State</th>
                                        <th class="sort" data-sort="email">District</th>
                                        <th class="sort" data-sort="phone">Taluka</th>
                                        <th class="sort" data-sort="date">Gram Name</th>
                                        <th class="sort" data-sort="status">Population</th>
                                        <th class="sort" data-sort="status">Maintenance Amount</th>
                                        <th class="sort" data-sort="status">Description</th>
                                        <th class="sort" data-sort="status">Payment Mode</th>
                                        <th class="sort" data-sort="status">Status</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach($annualMaintenance as $record)
                                        <tr>
                                            <td>{{ $record->state }}</td>
                                            <td>{{ $record->district }}</td>
                                            <td>{{ $record->taluka }}</td>
                                            <td>{{ $record->gram_name }}</td>
                                            <td>{{ $record->current_population }}</td>
                                            <td>{{ $record->maintenance_amount }}</td>
                                            <td>{{ $record->description }}</td>
                                            <td>{{ $record->payment_mode }}</td>
                                            <td>{{ $record->bill_status }}</td>
                                            <td>
                                                 <!-- Edit Button -->
            <a href="{{ route('annual-maintenance.edit', $record->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                                data-bs-target="#deleteRecordModal" data-id="{{ $record->id }}">
                                                Delete
                                            </button>
                                            
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="javascript:void(0);">
                                    Next
                                </a>
                            </div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>

      <!-- Delete Modal -->
      <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                        colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you Sure?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record?</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-light">Yes, delete it</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!-- end row -->

    <!--end modal -->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

<!-- listjs init -->
<script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>

<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            // Handle Edit Gram Modal
        

            // Handle Delete Gram
            $('.remove-item-btn').click(function() {
                var id = $(this).data('id');
                $('#deleteForm').attr('action', '/annual-maintenance/' + id);
            });

            // Handle Delete Gram Form Submission
            $('#deleteForm').submit(function(event) {
                event.preventDefault();

                var form = $(this);
                var actionUrl = form.attr('action');
                var id = actionUrl.split('/').pop(); // Extract ID from URL

                $.ajax({
                    url: actionUrl,
                    type: 'DELETE',
                    data: form.serialize(),
                    success: function(response) {
                        $('#gramRow' + id).remove();
                        $('#deleteRecordModal').modal('hide');
                        Swal.fire({ // Use SweetAlert2 for better notifications
                        title: 'Deleted!',
                        text: 'Annual Maintenance deleted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload(); // Reload page after user acknowledges the notification
                    });
                    },
                    error: function(response) {
                        alert('An error occurred while trying to delete the gram.');
                    }
                });
            });
        });
    </script>

@endsection
