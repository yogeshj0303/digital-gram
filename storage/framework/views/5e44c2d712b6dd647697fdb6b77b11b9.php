<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.basic-elements2'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit Gharpatti Panipatti</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="<?php echo e(route('gharpatti-panipatti.update', $record->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?> <!-- For edit/update -->
                            <div class="row gy-4">
                                <!-- State -->
<div class="col-md-4">
    <label for="state" class="form-label">State</label>
    <input type="text" name="state" id="state" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('state', $record->state)); ?>" /readonly>
    <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="col-md-4">
    <label for="district" class="form-label">District</label>
    <input type="text" name="district" id="district" class="form-control <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('district', $record->district)); ?>" /readonly>
    <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="col-md-4">
    <label for="taluka" class="form-label">Taluka</label>
    <input type="text" name="taluka" id="taluka-field" class="form-control <?php $__errorArgs = ['taluka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('taluka', $record->taluka)); ?>" /readonly>
    <?php $__errorArgs = ['taluka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="col-md-4">
    <label for="gram" class="form-label">Gram</label>
    <input type="text" name="gram" id="gram-field" class="form-control <?php $__errorArgs = ['gram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('gram', $record->gram)); ?>" /readonly>
    <?php $__errorArgs = ['gram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="invalid-feedback">
            <?php echo e($message); ?>

        </div>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<?php
    $user = DB::table('users')->where('id', $record->username)->first();
?>

<div class="col-md-4">
    <label for="username" class="form-label">User Name</label>
    <input type="text"  id="username" class="form-control" value="<?php echo e(old('username', $user ? $user->name : '')); ?>" readonly />
</div>

                                <!-- Type -->
                                <div class="col-md-4">
                                    <label for="type" class="form-label">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">--Select Type--</option>
                                        <option value="gharpatti" <?php echo e(old('type', $record->type) == 'gharpatti' ? 'selected' : ''); ?>>Gharpatti</option>
                                        <option value="panipatti" <?php echo e(old('type', $record->type) == 'panipatti' ? 'selected' : ''); ?>>Panipatti</option>
                                    </select>
                                </div>
    
                                <!-- Amount Type -->
                                <div class="col-md-4">
                                    <label for="amount_type" class="form-label">Amount Type</label>
                                    <input type="text" name="amount_type" class="form-control"
                                        value="<?php echo e(old('amount_type', $record->amount_type)); ?>" placeholder="Amount Type">
                                </div>
    
                                <!-- Paid Type -->
                                <div class="col-md-4">
                                    <label for="paid_type" class="form-label">Paid Type</label>
                                    <select name="paid_type" id="paid_type" class="form-control">
                                        <option value="cash" <?php echo e(old('paid_type', $record->paid_type) == 'cash' ? 'selected' : ''); ?>>Cash</option>
                                        <option value="online" <?php echo e(old('paid_type', $record->paid_type) == 'online' ? 'selected' : ''); ?>>Online</option>
                                        <option value="rtgs" <?php echo e(old('paid_type', $record->paid_type) == 'rtgs' ? 'selected' : ''); ?>>RTGS</option>
                                        <option value="check" <?php echo e(old('paid_type', $record->paid_type) == 'check' ? 'selected' : ''); ?>>Check</option>
                                    </select>
                                </div>
    
                                <!-- Paid Amount -->
                                <div class="col-md-4">
                                    <label for="paid_amount" class="form-label">Paid Amount</label>
                                    <input type="number" name="paid_amount" class="form-control"
                                        value="<?php echo e(old('paid_amount', $record->paid_amount)); ?>" placeholder="Paid Amount">
                                </div>
    
                                <!-- Paid Date -->
                                <div class="col-md-4">
                                    <label for="paid_date" class="form-label">Paid Date</label>
                                    <input type="datetime-local" name="paid_date" class="form-control"
                                        value="<?php echo e(old('paid_date', $record->paid_date)); ?>">
                                </div>
    
                                <!-- Remaining Amount -->
                                <div class="col-md-4">
                                    <label for="remaining_amount" class="form-label">Remaining Amount</label>
                                    <input type="number" name="remaining_amount" class="form-control"
                                        value="<?php echo e(old('remaining_amount', $record->remaining_amount)); ?>" placeholder="Remaining Amount">
                                </div>
    
                                <!-- Send Bill -->
                                <div class="col-md-4">
                                    <label for="send_bill" class="form-label">Send Bill on WhatsApp</label>
                                    <div class="form-check">
                                        <input type="checkbox" name="send_bill" class="form-check-input" value="1"
                                            <?php echo e(old('send_bill', $record->send_bill) == 1 ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="send_bill">Yes</label>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <a href="<?php echo e(route('gharpatti-panipatti.index')); ?>" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="<?php echo e(URL::asset('build/js/pages/select2.init.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/e-gram.actthost.com/resources/views/gharpatti-panipatti/edit.blade.php ENDPATH**/ ?>