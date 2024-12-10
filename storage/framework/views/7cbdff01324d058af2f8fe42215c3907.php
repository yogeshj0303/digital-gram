<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-dark.png')); ?>" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="<?php echo e(URL::asset('build/images/logo-sm.png')); ?>" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="<?php echo e(URL::asset('build/images/logo-light.png')); ?>" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span><?php echo app('translator')->get('translation.menu'); ?></span></li>
                <li class="">
                    <a class="nav-link" href="<?php echo e(url('/')); ?>" >
                        <i class="bx bxs-dashboard"></i> <span><?php echo app('translator')->get('translation.dashboards'); ?></span>
                    </a>
                    
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                        <i class="bx bx-layer"></i> <span>Master</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                           
                            <li class="nav-item">
                                <a href="<?php echo e(route('categories.index')); ?>" class="nav-link">Manage Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('talukas.index')); ?>" class="nav-link">Manage Taluka</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('grams.index')); ?>" class="nav-link">Manage Gram</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('register-to-gram.index')); ?>" class="nav-link">Add Register To Gram</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo e(route('users.index')); ?>" class="nav-link">Manage Users</a>
                            </li>
                        </ul>
                    </div>
                </li>


               
                <li class="">
                    <a class="nav-link " href="<?php echo e(route('gharpatti-panipatti.index')); ?>" >
                        <i class="bx bx-doughnut-chart"></i> <span>Gharpatti Panipatti</span>
                    </a>
                    
                </li>

                <li class="">
                    <a class="nav-link menu-link" href="<?php echo e(route('about-gram.index')); ?>" >
                        <i class="bx bx-tone"></i> <span>About Gram</span>
                    </a>
                    
                </li>

                <li class="">
                    <a class="nav-link menu-link" href="<?php echo e(route('population.index')); ?>">
                        <i class="bx bx-map-alt"></i> <span>Population</span>
                    </a>
                   
                </li>

                <li class="">
                    <a class="nav-link menu-link" href="<?php echo e(route('gram-bills.index')); ?>" >
                        <i class="bx bx-sitemap"></i> <span>Gram Bills</span>
                    </a>
                    
                </li>
                <li class="">
                    <a class="nav-link menu-link" href="<?php echo e(route('annual-maintenance.index')); ?>">
                        <i class="bx bx-sitemap"></i> <span>Gram Annual Maintenance</span>
                    </a>
                    
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
<?php /**PATH /home2/acttconnect/e-gram.acttconnect.com/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>