
<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Register-to-gram'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('build/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <style>
        .file-item {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .file-item span {
            font-size: 14px;
        }
        .file-item button {
            margin-left: 10px;
        }
    </style>
    <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">

    <div class="row">
        <!-- List Categories -->
        <div class="col-xxl-6">
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

            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Register To Gram</h4>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="gramTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Taluka</th>
                                    <th>Gram Name</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $registerToGrams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gram): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($gram->id); ?></td>
                                    <td><?php echo e($gram->state); ?></td>
                                    <td><?php echo e($gram->district); ?></td>
                                    <td><?php echo e($gram->taluka); ?></td>
                                    <td><?php echo e($gram->gram); ?></td>
                                    <td><?php echo e($gram->category); ?></td>
                                    <td>
                                        <!-- Edit Button -->
                                         <!-- Edit Button (Trigger Modal) -->
        <button class="btn btn-sm btn-primary editGram" data-id="<?php echo e($gram->id); ?>">
            <i class="fa fa-edit"></i> Edit
        </button>
        
                                        <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                            data-bs-target="#deleteRecordModal" data-id="<?php echo e($gram->id); ?>">
                                            Delete
                                        </button>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                            </tbody>
                        </table>
                        <?php if($registerToGrams->isNotEmpty()): ?>
                            <div class="d-flex justify-content-center">
                                <?php echo $registerToGrams->links(); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category -->
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Register To Gram</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('register-to-gram.store')); ?>" method="POST" class="row g-3" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="col-md-12">
                            <label for="state" class="form-label">State</label>
                            <select name="state" id="state" class="form-control js-example-basic-single <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Select State</option>
                                <?php $__currentLoopData = $statesData['states']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($state['state']); ?>" <?php echo e(old('state') == $state['state'] ? 'selected' : ''); ?>><?php echo e($state['state']); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
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
                        <div class="col-md-12">
                            <label for="district" class="form-label">District</label>
                            <select name="district" id="district" class="form-control js-example-basic-single <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Select District</option>
                                <!-- District options will be populated based on state selection -->
                            </select>
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
                        <div class="col-md-12">
                            <label for="taluka" class="form-label">Taluka</label>
                            <select name="taluka" id="taluka-field" class="form-select js-example-basic-single <?php $__errorArgs = ['taluka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <option value="">Select Taluka</option>
                                <!-- Populate dynamically -->
                            </select>
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
                       
                       

                        <div class="col-md-12">
                            <label for="category_name" class="form-label">Gram Name</label>
                            <select class="form-control js-example-basic-single <?php $__errorArgs = ['gram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="gram-field" name="gram">
                                <option value="">Select Gram</option>
                                <!-- Add options dynamically -->
                            </select>
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
                        <div class="col-md-12">
                            <label for="address" class="form-label">Select Category</label>
                            <select class="form-control js-example-basic-single <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="category" name="category">
                                <option value="">Select Category</option>
                                <!-- Add options dynamically -->
                                <?php $__currentLoopData = $getCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($temp->category_name); ?>"><?php echo e($temp->category_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['category'];
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
                        <div class="col-md-12">
                            <label for="pdf" class="form-label">Select PDF (Multiple)</label>
                            <input type="file" class="form-control <?php $__errorArgs = ['pdf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pdf" name="pdf[]" multiple onchange="handleFileSelect(event)" >
                        </div>
                        
                        <div id="fileList" class="mt-3"></div>
                        
                      
                        
                        
                        <div class="col-12">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Delete Modal -->
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
        <div class="modal fade" id="editGramModal" tabindex="-1" aria-labelledby="editGramModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editGramForm" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="modal-header">
                            <h5 class="modal-title" id="editGramModalLabel">Edit Gram</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- State Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="state" class="form-label">State</label>
                        <select id="editState" name="state" class="form-select mb-3" required>
                            <option value="">Select state</option>
                            <?php $__currentLoopData = $statesData['states']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($state['state']); ?>"><?php echo e($state['state']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
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
        
                            <!-- District Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="district" class="form-label">District</label>
                        <select name="district" id="editDistrict" class="form-control <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <option value="">Select District</option>
                            <!-- District options will be populated based on state selection -->
                        </select>
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
        
                            <!-- Taluka Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="taluka" class="form-label">Taluka</label>
                                <select name="taluka" id="editTaluka" class="form-select">
                                    <option value="">Select Taluka</option>
                                    <!-- Populate dynamically -->
                                </select>
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
        
                            <!-- Gram Name Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="gram" class="form-label">Gram Name</label>
                                <select class="form-control <?php $__errorArgs = ['gram'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="editGramName" name="gram">
                                    <option value="">Select Gram</option>
                                    <!-- Gram options will be added dynamically -->
                                </select>
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
        
                            <!-- Category Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="category" class="form-label">Select Category</label>
                                <select class="form-control <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="editcategory" name="category">
                                    <option value="">Select Category</option>
                                    <?php $__currentLoopData = $getCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option 
            value="<?php echo e($temp->category_name); ?>" >
            <?php echo e($temp->category_name); ?>

        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['category'];
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
        <div class="col-md-12 mb-3">
    <label for="pdf" class="form-label">Select PDF (Multiple)</label>
    <input type="file" class="form-control <?php $__errorArgs = ['pdf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="pdfedit" name="pdf[]" multiple onchange="handleFileSelectEdit(event)">
</div>

<div id="filePreview" class="mt-3">
    
    <a href="<?php echo e(asset('uploads/' . $temp)); ?>" target="_blank" class="">
        Open PDF in new tab
    </a>

</div>


<div id="fileListedit" class="mt-3"></div>


                        </div>
                        <div class="modal-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
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


<script>
    $(document).ready(function() {
        $('#district').select2({
            placeholder: 'Select District',
            allowClear: true
        });
    });



    $(document).ready(function() {
        $('#state').select2({
            placeholder: 'Select state',
            allowClear: true
        });
    });
</script>
<script>
  $(document).ready(function () {
    // Handle state selection change
    $('#state').change(function () {
        var state = $(this).val();
        var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript

        var districtDropdown = $('#district');
        districtDropdown.empty().append('<option value="">Select District</option>'); // Clear existing options

        var selectedState = statesData.find(function (item) {
            return item.state === state;
        });

        if (selectedState) {
            selectedState.districts.forEach(function (district) {
                districtDropdown.append($('<option>', {
                    value: district,
                    text: district
                }));
            });
        }

        $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
        $('#name').empty().append('<option value="">Select Profile Name</option>'); // Clear existing options
        $('#gram-field').empty().append('<option value="">Select Gram</option>'); // Clear grams dropdown
    });

    // Handle district selection change
    $('#district').change(function () {
        var state = $('#state').val();
        var district = $(this).val();

        if (state && district) {
            $.ajax({
                url: '<?php echo e(route('tehsils.get')); ?>', // Ensure this matches your route
                type: 'GET',
                data: { state: state, district: district },
                success: function (response) {
                    var talukaDropdown = $('#taluka-field');
                    talukaDropdown.empty().append('<option value="">Select Taluka</option>');

                    response.forEach(function (taluka) {
                        talukaDropdown.append($('<option>', {
                            value: taluka,
                            text: taluka
                        }));
                    });
                },
                error: function (xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
        }
        $('#gram-field').empty().append('<option value="">Select Gram</option>'); // Clear grams dropdown
    });

    $('#taluka-field').change(function () {
        var state = $('#state').val();
        var district = $('#district').val();
        var taluka = $(this).val();

        if (state && district && taluka) {
            $.ajax({
                url: '<?php echo e(route('grams.get')); ?>', // Route for fetching grams
                type: 'GET',
                data: { state: state, district: district, taluka: taluka },
                success: function (response) {
                    var gramDropdown = $('#gram-field');
                    gramDropdown.empty().append('<option value="">Select Gram</option>');

                    response.forEach(function (gram) {
                        gramDropdown.append($('<option>', {
                            value: gram,
                            text: gram
                        }));
                    });
                },
                error: function (xhr) {
                    console.error('Error fetching grams:', xhr.responseText);
                }
            });
        }
    });
});
</script>

<script>
    $(document).ready(function() {
        // Handle Edit Gram Modal
        $('.editGram').click(function() {
    var id = $(this).data('id');
    
    $.get('/register-to-gram/' + id + '/edit', function(data) {
        console.log(data);

        $('#editGramModal').modal('show');
                $('#editState').val(data.gram.state).change(); 
            $('#editDistrict').val(data.gram.district).change();
             
$('#editTaluka').data('selected-taluka', data.gram.taluka).trigger('change'); // Set selected taluka in memory
$('#editTaluka').val(data.gram.taluka); // Set dropdown value and trigger change

        var talukaa = $('#editTaluka').val();
        console.log('taluka after set' + talukaa);


        $('#editGramName').data('selected-gram', data.gram.gram); 

$('#editcategory').val(data.gram.category).trigger('change');
        
        $('#editGramForm').attr('action', '/register-to-gram/' + id); // Set the form action URL
    });
});


   $('#editState').change(function() {
        var state = $(this).val();
        var statesData = <?php echo json_encode($statesData['states'], 15, 512) ?>; // Pass states data to JavaScript

        var districtDropdown = $('#editDistrict');
        districtDropdown.empty().append('<option value="">Select District</option>'); // Clear existing options

        var selectedState = statesData.find(function(item) {
            return item.state === state;
        });
        
        console.log('selectedState' + selectedState);

        if (selectedState) {
            selectedState.districts.forEach(function(district) {
                districtDropdown.append($('<option>', {
                    value: district,
                    text: district
                }));
            });
        }

        // Clear taluka and organization dropdowns
        $('#editTaluka').empty().append('<option value="">Select Taluka</option>');
    });
    
    
    
 $('#editDistrict').change(function() {
        var state = $('#editState').val();
        var district = $(this).val();

        if (state && district) {
            // Fetch Talukas
            $.ajax({
                url: '<?php echo e(route('tehsils.get')); ?>',
                type: 'GET',
                data: { state: state, district: district },
                success: function(response) {
                    var talukaDropdown = $('#editTaluka');
                    talukaDropdown.empty().append('<option value="">Select Taluka</option>');

                    response.forEach(function(taluka) {
                        talukaDropdown.append($('<option>', {
                            value: taluka,
                            text: taluka
                        }));
                    });

                    // Now set the selected taluka
                    var selectedTaluka = $('#editTaluka').data('selected-taluka');
                    console.log('selectedTaluka' + selectedTaluka);
                    if (selectedTaluka) {
                    $('#editTaluka').val(selectedTaluka).trigger('change');
        console.log('Taluka after setting in dropdown:', $('#editTaluka').val());
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
        }

        });

    
    
    
    
$('#editTaluka').change(function () {
    console.log('enterrrrr');
    var state = $('#editState').val(); // Get selected state
    var district = $('#editDistrict').val(); // Get selected district
    var taluka = $('#editTaluka').val(); // Get selected district

    
    console.log('taluka' + taluka);

    if (state && district && taluka) {
        $.ajax({
            url: '<?php echo e(route('grams.get')); ?>', // Route for fetching grams
            type: 'GET',
            data: { state: state, district: district, taluka: taluka },
            success: function (response) {
                console.log(response);
                var gramDropdown = $('#editGramName'); // Target gram dropdown
                gramDropdown.empty().append('<option value="">Select Gram</option>');

                // Populate the gram dropdown
                response.forEach(function (gram) {
                    gramDropdown.append($('<option>', {
                        value: gram.id, // Assuming each gram has an `id` in the response
                        text: gram // Assuming each gram has a `name` in the response
                    }));
                });

                // Set the selected gram if available
var selectedGram = $('#editGramName').data('selected-gram');
if (selectedGram) {
    console.log('Setting selected gram:', selectedGram);
    $('#editGramName').val(selectedGram).trigger('change');
                        console.log('Gram after setting:', gramDropdown.val());

    
    
}            },
            error: function (xhr) {
                console.error('Error fetching grams:', xhr.responseText);
            }
        });
    } else {
        // Clear Gram dropdown if dependencies are not selected
        $('#editGramName').empty().append('<option value="">Select Gram</option>');
    }
});


    
    
    
    
    

      $('#editState').select2({
        placeholder: 'Select state',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });

    $('#editDistrict').select2({
        placeholder: 'Select district',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });

  $('#editTaluka').select2({
        placeholder: 'Select Taluka',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });


$('#editGramName').select2({
        placeholder: 'Select gram',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });

$('#editcategory').select2({
        placeholder: 'Select category',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });






// Handle Edit Gram Form Submission
$('#editGramForm').submit(function(event) {
    event.preventDefault(); // Prevent default form submission

      var form = $(this);
    var actionUrl = form.attr('action');
    
    // Prepare form data
    var formData = new FormData(this);
    console.log(formData);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        processData: false, // For FormData
        contentType: false, // For FormData
        success: function(response) {
            var id = response.id;
            $('#gramRow' + id + ' td:nth-child(2)').text(response.gram_name);
            $('#gramRow' + id + ' td:nth-child(3)').text(response.state);
            $('#gramRow' + id + ' td:nth-child(4)').text(response.district);
            $('#gramRow' + id + ' td:nth-child(5)').text(response.taluka);
            $('#gramRow' + id + ' td:nth-child(6)').text(response.address);
            $('#gramRow' + id + ' td:nth-child(7)').text(response.pin_code);
            $('#editGramModal').modal('hide');

            Swal.fire({
                title: 'Success!',
                text: 'Gram updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload(); // Reload after closing the success alert
                }
            });
        },
        error: function(response) {
            alert('An error occurred while trying to update the gram.');
        }
    });
});


       
    });
</script>



<script>
     // Handle Delete Gram
        $('.remove-item-btn').click(function() {
            var id = $(this).data('id');
            $('#deleteForm').attr('action', '/register-to-gram/' + id);
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
                    alert('Register To Gram deleted successfully.');
                    window.location.reload();
                },
                error: function(response) {
                    alert('An error occurred while trying to delete the gram.');
                }
            });
        });
</script>

<script>
    let fileUploads = []; // To store the progress for each file

    function handleFileSelect(event) {
        const fileList = event.target.files;
        const fileListContainer = document.getElementById('fileList');
        
        // Append selected files to the existing files in the fileUploads array
        for (let i = 0; i < fileList.length; i++) {
            const file = fileList[i];

            // Check if the file is already in the uploads (by name)
            if (fileUploads.some(upload => upload.file.name === file.name)) {
                continue; // Skip this file if it's already added
            }

            fileUploads.push({
                file: file,
                progressBar: null,
                percentageText: null,
                remainingSizeText: null,
                uploaded: 0,
                isUploading: false // Track whether the file is currently being uploaded
            });
        }

        // Re-render the file list UI
        renderFileList();

        // Start uploading simulation for all the new files (or replace this with actual upload logic)
        Array.from(fileList).forEach((file) => {
            const uploadData = fileUploads.find(f => f.file === file);
            simulateFileUpload(file, uploadData);
        });
    }

    function renderFileList() {
const fileListContainer = document.getElementById('fileList');
fileListContainer.innerHTML = ''; // Clear the file listings before re-rendering

fileUploads.forEach((uploadData, index) => {
const fileItem = document.createElement('div');
fileItem.classList.add('file-item', 'mb-3');

// File name
const fileName = document.createElement('span');
fileName.textContent = `${uploadData.file.name} (${(uploadData.file.size / 1024).toFixed(2)} KB)`;
fileItem.appendChild(fileName);

// Progress Bar
const progress = document.createElement('progress');
progress.value = uploadData.uploaded;
progress.max = 100;
progress.style.width = '100%';
fileItem.appendChild(progress);

// Percentage text
const percentage = document.createElement('span');
percentage.textContent = `${uploadData.uploaded}%`;
percentage.classList.add('ms-2', 'font-weight-bold');
fileItem.appendChild(percentage);

// Total size info (optional)
const sizeInfo = document.createElement('div');
sizeInfo.classList.add('mt-1');
const totalSize = document.createElement('span');
totalSize.textContent = `Total size: ${(uploadData.file.size / 1024).toFixed(2)} KB`;
sizeInfo.appendChild(totalSize);

fileItem.appendChild(sizeInfo);

// Delete button
const deleteButton = document.createElement('button');
deleteButton.textContent = 'Delete';
deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
deleteButton.onclick = () => removeFile(index);
fileItem.appendChild(deleteButton);

// Store references to progress, percentage, and remaining size text for later updates
uploadData.progressBar = progress;
uploadData.percentageText = percentage;

// Append file item to the container
fileListContainer.appendChild(fileItem);
});
}

function simulateFileUpload(file, uploadData) {
if (uploadData.isUploading) return; // Prevent multiple uploads for the same file
uploadData.isUploading = true; // Mark file as uploading

const totalSize = file.size;
let uploaded = uploadData.uploaded; // Start from the previously uploaded progress

// Set progress to initial uploaded value
uploadData.progressBar.value = uploaded;
uploadData.percentageText.textContent = `${uploaded}%`;

const interval = setInterval(() => {
// Simulate upload progress (replace this with actual upload logic)
uploaded += totalSize / 10; // Simulate 10% increment per interval
if (uploaded > totalSize) uploaded = totalSize;

const progress = Math.min((uploaded / totalSize) * 100, 100);
uploadData.progressBar.value = progress;
uploadData.percentageText.textContent = `${Math.round(progress)}%`;

if (progress >= 100) {
clearInterval(interval);
uploadData.percentageText.textContent = `Upload complete!`; // Only show "Upload complete!"
uploadData.percentageText.classList.add('text-success');
uploadData.uploaded = 100; // Mark as fully uploaded
uploadData.isUploading = false; // Mark file as not uploading
}
}, 500); // Increase progress every 500ms (you can adjust for actual file upload)
}


    function removeFile(index) {
        // Mark the file as removed but don't change the progress of other files
        const removedFile = fileUploads[index];
        fileUploads.splice(index, 1); // Remove file from fileUploads array

        // Re-render the file list UI
        renderFileList();
    }
</script>



<script>
    let fileUploadsEdit = []; // To store the progress for each file in the modal

    function handleFileSelectEdit(event) {
        const fileList = event.target.files;
        const fileListContainer = document.getElementById('fileListedit');
        
        // Append selected files to the existing files in the fileUploads array
        for (let i = 0; i < fileList.length; i++) {
            const file = fileList[i];

            // Check if the file is already in the uploads (by name)
            if (fileUploadsEdit.some(upload => upload.file.name === file.name)) {
                continue; // Skip this file if it's already added
            }

            fileUploadsEdit.push({
                file: file,
                progressBar: null,
                percentageText: null,
                remainingSizeText: null,
                uploaded: 0,
                isUploading: false // Track whether the file is currently being uploaded
            });
        }

        // Re-render the file list UI
        renderFileListEdit();

        // Start uploading simulation for all the new files (or replace this with actual upload logic)
        Array.from(fileList).forEach((file) => {
            const uploadData = fileUploadsEdit.find(f => f.file === file);
            simulateFileUploadEdit(file, uploadData);
        });
    }

    function renderFileListEdit() {
        const fileListContainer = document.getElementById('fileListedit');
        fileListContainer.innerHTML = ''; // Clear the file listings before re-rendering

        fileUploadsEdit.forEach((uploadData, index) => {
            const fileItem = document.createElement('div');
            fileItem.classList.add('file-item', 'mb-3');

            // File name
            const fileName = document.createElement('span');
            fileName.textContent = `${uploadData.file.name} (${(uploadData.file.size / 1024).toFixed(2)} KB)`;
            fileItem.appendChild(fileName);

            // Progress Bar
            const progress = document.createElement('progress');
            progress.value = uploadData.uploaded;
            progress.max = 100;
            progress.style.width = '100%';
            fileItem.appendChild(progress);

            // Percentage text
            const percentage = document.createElement('span');
            percentage.textContent = `${uploadData.uploaded}%`;
            percentage.classList.add('ms-2', 'font-weight-bold');
            fileItem.appendChild(percentage);

            // Total size info (optional)
            const sizeInfo = document.createElement('div');
            sizeInfo.classList.add('mt-1');
            const totalSize = document.createElement('span');
            totalSize.textContent = `Total size: ${(uploadData.file.size / 1024).toFixed(2)} KB`;
            sizeInfo.appendChild(totalSize);

            fileItem.appendChild(sizeInfo);

            // Delete button
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
            deleteButton.onclick = () => removeFileEdit(index);
            fileItem.appendChild(deleteButton);

            // Store references to progress, percentage, and remaining size text for later updates
            uploadData.progressBar = progress;
            uploadData.percentageText = percentage;

            // Append file item to the container
            fileListContainer.appendChild(fileItem);
        });
    }

    function simulateFileUploadEdit(file, uploadData) {
        if (uploadData.isUploading) return; // Prevent multiple uploads for the same file
        uploadData.isUploading = true; // Mark file as uploading

        const totalSize = file.size;
        let uploaded = uploadData.uploaded; // Start from the previously uploaded progress

        // Set progress to initial uploaded value
        uploadData.progressBar.value = uploaded;
        uploadData.percentageText.textContent = `${uploaded}%`;

        const interval = setInterval(() => {
            // Simulate upload progress (replace this with actual upload logic)
            uploaded += totalSize / 10; // Simulate 10% increment per interval
            if (uploaded > totalSize) uploaded = totalSize;

            const progress = Math.min((uploaded / totalSize) * 100, 100);
            uploadData.progressBar.value = progress;
            uploadData.percentageText.textContent = `${Math.round(progress)}%`;

            if (progress >= 100) {
                clearInterval(interval);
                uploadData.percentageText.textContent = `Upload complete!`; // Only show "Upload complete!"
                uploadData.percentageText.classList.add('text-success');
                uploadData.uploaded = 100; // Mark as fully uploaded
                uploadData.isUploading = false; // Mark file as not uploading
            }
        }, 500); // Increase progress every 500ms (you can adjust for actual file upload)
    }

    function removeFileEdit(index) {
        // Mark the file as removed but don't change the progress of other files
        const removedFile = fileUploadsEdit[index];
        fileUploadsEdit.splice(index, 1); // Remove file from fileUploads array

        // Re-render the file list UI
        renderFileListEdit();
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home1/actthgku/e-gram.actthost.com/resources/views/register-to-gram/index.blade.php ENDPATH**/ ?>