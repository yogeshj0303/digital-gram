<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.profile'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="<?php echo e(URL::asset('build/images/profile-bg.jpg')); ?>" alt="" class="profile-wid-img" />
        </div>
    </div>

    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="<?php if(Auth::user()->profile_pic != ''): ?> <?php echo e(URL::asset('storage/' . Auth::user()->profile_pic)); ?><?php else: ?><?php echo e(URL::asset('build/icons/user.png')); ?> <?php endif; ?>" alt="user-img" class="img-thumbnail rounded-circle" />
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1"><?php echo e(Auth::user()->name); ?></h3>
                    <p class="text-white text-opacity-75">Owner & Founder</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i
                                class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i><?php echo e(Auth::user()->state); ?>,
                            <?php echo e(Auth::user()->district); ?>,<?php echo e(Auth::user()->taluka); ?></div>
                        
                    </div>
                </div>
            </div>
          
        </div>
        <!--end row-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex profile-wrapper">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Overview</span>
                            </a>
                        </li>
                        </ul>
                    
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                          
                            <div class="col-xxxl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Profile Details</h5>
                                       
                                        <div class="row">
    <!-- State -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-map-pin-2-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">State:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->state); ?></h6>
            </div>
        </div>
    </div>
    <!-- District -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-community-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">District:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->district); ?></h6>
            </div>
        </div>
    </div>
    <!-- Taluka -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-map-pin-range-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Taluka:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->taluka); ?></h6>
            </div>
        </div>
    </div>
    <!-- Name -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-user-2-fill"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Name:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->name); ?></h6>
            </div>
        </div>
    </div>
    <!-- Contact Number -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-phone-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Contact No:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->contact_no); ?></h6>
            </div>
        </div>
    </div>
    <!-- Gender -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-gender-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Gender:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->gender); ?></h6>
            </div>
        </div>
    </div>
    <!-- DOB -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-calendar-2-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Date of Birth:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->dob); ?></h6>
            </div>
        </div>
    </div>
    <!-- Age -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-user-star-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Age:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->age); ?></h6>
            </div>
        </div>
    </div>
    <!-- Land Area -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-landscape-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Land Area:</p>
                <h6 class="text-truncate mb-0"><?php echo e(Auth::user()->land_area); ?></h6>
            </div>
        </div>
    </div>
</div>

                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!-- end card -->

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                   
                    <!--end tab-pane-->
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    
    <!--end row-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.js')); ?>"></script>

    <script src="<?php echo e(URL::asset('build/js/pages/profile.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/acttconnect/e-gram.acttconnect.com/resources/views/profile.blade.php ENDPATH**/ ?>