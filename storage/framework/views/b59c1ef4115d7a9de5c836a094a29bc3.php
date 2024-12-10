<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.list-js'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<div class="row">
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
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Users</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="listjs-table" id="customerList">
                    <div class="row g-4 mb-3">
                        <div class="col-sm-auto">
                            <div>
                                <a href="<?php echo e(route('users.create')); ?>">
                                    <button type="button" class="btn btn-success">
                                        <i class="ri-add-line align-bottom me-1"></i> Add
                                    </button>
                                </a>
                            </div>
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

                    <div class="table-responsive table-card mt-3 mb-1">
                        <table class="table align-middle table-nowrap">
                            <thead class="table-light">
                                <tr>
                                    <th class="sort" data-sort="customer_name">State</th>
                                    <th class="sort" data-sort="email">District</th>
                                    <th class="sort" data-sort="phone">Taluka</th>
                                    <th class="sort" data-sort="date">Gram Name</th>
                                    <th class="sort" data-sort="status">User Name</th>
                                    <th class="sort" data-sort="customer_name">Contact</th>
                                    <th class="sort" data-sort="email">User Type</th>
                                    <th class="sort" data-sort="phone">Gharpatti Annual</th>
                                    <th class="sort" data-sort="date">Panipatti Annual</th>
                                    <th class="sort" data-sort="status">Home Type</th>
                                    <th class="sort" data-sort="status">Date Of Birth</th>
                                    <th class="sort" data-sort="action">Action</th>
                                </tr>
                            </thead>
                            <tbody class="list form-check-all">
                                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr id="talukaRow<?php echo e($user->id); ?>" data-id="<?php echo e($user->id); ?>">
                                    <td class="customer_name"><?php echo e($user->state); ?></td>
                                    <td class="email"><?php echo e($user->district); ?></td>
                                    <td class="phone"><?php echo e($user->taluka); ?></td>
                                    <td class="date"><?php echo e($user->gram); ?></td>
                                    <td class="customer_name"><?php echo e($user->name); ?></td>
                                    <td class="email"><?php echo e($user->contact_no); ?></td>
                                    <td class="phone"><?php echo e($user->user_type); ?></td>
                                    <td class="date"><?php echo e($user->gharpatti_annual); ?></td>
                                    <td class="customer_name"><?php echo e($user->panipatti_annual); ?></td>
                                    <td class="email"><?php echo e($user->home_type); ?></td>
                                    <td class="status"><?php echo e($user->dob); ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <div class="edit">
                                                <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-sm btn-success">Edit</a>
                                            </div>
                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-id="<?php echo e($user->id); ?>">Remove</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="12" class="text-center">No users found.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="noresult" style="display: none">
                            <div class="text-center">
                                <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                    colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px">
                                </lord-icon>
                                <h5 class="mt-2">Sorry! No Result Found</h5>
                                <p class="text-muted mb-0">We've searched more than 150+ Orders but couldn't find any matching records.</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <div class="pagination-wrap hstack gap-2">
                            <?php echo e($users->links()); ?>

                        </div>
                    </div>
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<!-- Delete Confirmation Modal -->
<div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body text-center">
                <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.js/list.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/list.pagination.js/list.pagination.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/listjs.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>

<script>
$(document).ready(function () {
    $('.remove-item-btn').click(function() {
        var id = $(this).data('id');
        $('#deleteForm').attr('action', '/users/' + id);  // Set the URL to the user ID for deletion
    });

    $('#deleteForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        var form = $(this);
        var actionUrl = form.attr('action');  // Get the action URL

        $.ajax({
            url: actionUrl,
            type: 'DELETE',  // Ensure this is a DELETE request
            data: form.serialize(),  // Pass the form data with the CSRF token
            success: function(response) {
                // On success, remove the corresponding row from the table
                $('#talukaRow' + actionUrl.split('/').pop()).remove();
                $('#deleteRecordModal').modal('hide');
                alert('User deleted successfully.');
                window.location.reload();  // Reload the page to reflect changes
            },
            error: function(response) {
                alert('An error occurred while deleting the user.');
            }
        });
    });
});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/acttconnect/e-gram.acttconnect.com/resources/views/users/index.blade.php ENDPATH**/ ?>