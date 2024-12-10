<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.list-js'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <div class="row">
            <div class="col-xxxl-6">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                    <i class="ri-notification-off-line me-3 align-middle fs-16"></i><strong>Success</strong>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0" role="alert">
                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Danger</strong>
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Gharpatti Panipatti </h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                
                                    <a href="<?php echo e(route('gharpatti-panipatti.create')); ?>">
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
                            <table id="fixed-header" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
               
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="customer_name">State</th>
                                        <th class="sort" data-sort="email">District</th>
                                        <th class="sort" data-sort="phone">Taluka</th>
                                        <th class="sort" data-sort="date">Gram Name</th>
                                        <th class="sort" data-sort="status">User Name</th>
                                        <th class="sort" data-sort="type">Type</th>
                                        <th class="sort" data-sort="amount_type">Amount Type</th>
                                        <th class="sort" data-sort="paid_type">Amount Paid Type</th>
                                        <th class="sort" data-sort="paid_amount">Paid Amount</th>
                                        <th class="sort" data-sort="paid_date">Paid DateTime</th>
                                        <th class="sort" data-sort="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            
                                    <tr>
                                        <td class="customer_name"><?php echo e($record->state); ?></td>
                                        <td class="email"><?php echo e($record->district); ?></td>
                                        <td class="phone"><?php echo e($record->taluka); ?></td>
                                        <td class="date"><?php echo e($record->gram); ?></td>
                                        <td class="customer_name"><?php echo e($record->user_name); ?></td>
                                        <td class="type"><span class="badge bg-success-subtle text-success text-uppercase"><?php echo e($record->type); ?></span></td>
                                        <td class="amount_type"><span class="badge bg-success-subtle text-success text-uppercase"><?php echo e($record->amount_type); ?></span></td>
                                        <td class="paid_type"><span class="badge bg-success-subtle text-success text-uppercase"><?php echo e($record->paid_type); ?></span></td>
                                        <td class="paid_amount"><?php echo e($record->paid_amount); ?></td>
                                        <td class="paid_date"><?php echo e($record->paid_date); ?></td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="edit">
                                                    <a href="<?php echo e(route('gharpatti-panipatti.edit', $record->id)); ?>" class="btn btn-sm btn-primary">Edit</a>  </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                                    data-bs-target="#deleteRecordModal" data-id="<?php echo e($record->id); ?>">
                                                    Delete
                                                </button>
                                             </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                         
                            </table>
                               <?php if($records->isNotEmpty()): ?>
                            <div class="d-flex justify-content-center">
                                <?php echo $records->links(); ?>

                            </div>
                        <?php endif; ?>
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
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-light">Yes, delete it</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!-- end row -->

    <!--end modal -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>

<!-- listjs init -->
<script src="<?php echo e(URL::asset('build/js/pages/listjs.init.js')); ?>"></script>

<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>



<script>
    $(document).ready(function() {
        // Handle Delete Gram Button Click
        $('.remove-item-btn').click(function() {
            var id = $(this).data('id');
            $('#deleteForm').attr('action', '/gharpatti-panipatti/' + id);
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
                data: form.serialize(), // Include CSRF token here
                success: function(response) {
                    $('#gramRow' + id).remove();
                    $('#deleteRecordModal').modal('hide');
                    Swal.fire({ // Use SweetAlert2 for better notifications
                        title: 'Deleted!',
                        text: 'Record deleted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload(); // Reload page after user acknowledges the notification
                    });
                },
                error: function(xhr, status, error) {
                    $('#gramRow' + id).remove();
                    $('#deleteRecordModal').modal('hide');
                    Swal.fire({ // Use SweetAlert2 for better notifications
                        title: 'Deleted!',
                        text: 'Record deleted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload(); // Reload page after user acknowledges the notification
                    });
                }
            });
        });
    });
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/e-gram.actthost.com/resources/views/gharpatti-panipatti/gharpatti_panipatti.blade.php ENDPATH**/ ?>