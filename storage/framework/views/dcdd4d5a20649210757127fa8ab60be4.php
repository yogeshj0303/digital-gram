<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <!--<img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">-->
                            <h1 style="color:white">E Gram</h1>
                        </span>
                        <span class="logo-lg">
                            <!--<img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="17">-->
                            <h1 style="color:white">E Gram</h1>
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <!--<img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">-->
                            <h1 style="color:white">E Gram</h1>
                        </span>
                        <span class="logo-lg">
                            <!--<img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="17">-->
                            <h1 style="color:white">E Gram</h1>
                        </span>
                    </a>
                </div>

               

               
            </div>

            <div class="d-flex align-items-center">

               

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

               
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="<?php if(Auth::user()->profile_pic != ''): ?><?php echo e(URL::asset('storage/' . Auth::user()->profile_pic)); ?><?php else: ?><?php echo e(URL::asset('build/icons/user.png')); ?><?php endif; ?>" alt="Profile Picture">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo e(Auth::user()->name); ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text"><?php if(Auth::user()->is_admin == "admin"): ?> Admin <?php else: ?> User <?php endif; ?></span>
                            </span>
                        </span>
                    </button>
                   
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome <?php echo e(Auth::user()->name); ?>!</h6>
                        <a class="dropdown-item" href="<?php echo e(url('profile')); ?>"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                       <a class="dropdown-item" href="javascript:void(0);" onclick="confirmLogout()">
    <i class="bx bx-power-off font-size-16 align-middle me-1"></i>
    <span key="t-logout"><?php echo app('translator')->get('translation.logout'); ?></span>
</a>

<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
    <?php echo csrf_field(); ?>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Are you sure want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // If user clicks "Submit," submit the logout form
                document.getElementById('logout-form').submit();
            }
            // If canceled, Swal will automatically close without action
        });
    }
</script>
<?php /**PATH /home2/acttconnect/e-gram.acttconnect.com/resources/views/layouts/topbar.blade.php ENDPATH**/ ?>