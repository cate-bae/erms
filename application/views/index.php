<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?=system_title()?></title>
    <!-- Favicon-->
    <link rel="icon" href="<?=base_url('assets/logo.png')?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css"> -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <!-- Bootstrap Core Css -->
    <link href="<?=base_url() ?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <link href="<?=base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?=base_url() ?>assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?=base_url() ?>assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?=base_url() ?>assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?=base_url() ?>assets/css/themes/theme-green.css" rel="stylesheet" />

    <!-- material icons css -->
    <link href="<?=base_url() ?>assets/plugins/material-design-icons-master/iconfont/material-icons.css" rel="stylesheet">

    <link href="<?=base_url() ?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet">

    <?php if(!empty($page_css)): ?>
    <?php foreach($page_css as $css): ?>
    
    <link href="<?=$css ?>" rel="stylesheet">
    <?php endforeach;?>
    <?php endif;?>
</head>

<style>
.sidebar .menu .list .ml-menu li.active a.toggled:not(.menu-toggle) {
    margin-left: 0;
}
.sidebar .menu .list .ml-menu li.active a.toggled:not(.menu-toggle):before {
    content: '';
}
.sidebar .menu .list .ml-menu li a {
    padding-left: 45px;
}
</style>
<body class="theme-green">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                
                <a class="navbar-brand font-bold padding-0" href="javascript:void(0);">
                    <img src="<?=base_url()?>assets/logo.png" width="48" height="48" alt="User" style="display:inline-block; margin-left: 20px">
                    <span class="m-l-10"><?=system_title()?></span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right m-r-0">
                    <li>
                        <a href="<?=base_url().'Login/sign_out'?>" class="text-uppercase">
                            <span style="vertical-align: super"> Sign Out </span>
                            <i class="material-icons">input</i>
                        </a>
                    </li>

                    <!-- Settings -->
                    <!-- <li class="dropdown pull-right">
                        <a href="javascript:void(0);" class="dropdown-toggle js-right-sidebar" data-toggle="dropdown" role="button">
                            <i class="material-icons">account_circle</i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=base_url()?>Login/sign_out"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </li> -->
                    <!-- #END# Settings -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <?php $user = get_user_data(); ?>
            <div class="user-info p-t-0 p-b-0">
                <div class="info-container">
                    <div class="image">
                        <img class="profile-picture" src="<?=get_user_data_avatar()?>" alt="User" />
                
                    </div>
                    <div style="display:inline-block">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$user['username']?></div>
                        <div class="email"><?=get_user_type_text()?></div>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    
                    <li class="<?php if (isset($nav_active) && $nav_active == 'log') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Log/">
                            <i class="material-icons">history</i>
                            <span>Log</span>
                        </a>
                    </li>

                    <?php if ($user['type'] == -1 || $user['type'] == 0) { // super/admin?>

                    <li class="<?php if (isset($nav_active) && $nav_active == 'my_profile') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Employees/view/">
                            <i class="material-icons">account_box</i>
                            <span>My Profile</span>
                        </a>
                    </li>

                    <li class="<?php if (isset($nav_active) && $nav_active == 'departments') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Departments">
                            <i class="material-icons">assignment</i>
                            <span>Departments</span>
                        </a>
                    </li>
                    <li class="<?php if (isset($nav_active) && $nav_active == 'positions') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Positions">
                            <i class="material-icons">person_pin</i>
                            <span>Positions</span>
                        </a>
                    </li>
                    
                    <li class="<?php if (isset($nav_active) && $nav_active == 'employees') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Employees">
                            <i class="material-icons">people</i>
                            <span>Employees</span>
                        </a>
                    </li>

                    <li class="<?php if (isset($nav_active) && $nav_active == 'attendance') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Attendance">
                            <i class="material-icons">today</i>
                            <span>Attendance</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?=base_url()?>leaves/Leave_requests" class="<?php if (isset($nav_active) && $nav_active == 'leaves') { echo 'active'; } ?>">
                            <i class="material-icons">event_note</i>
                            <span>Leave Requests</span>
                        </a>
                    </li>

                    <li class="<?php if (isset($nav_active) && $nav_active == 'benefits') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Benefits">
                            <i class="material-icons">redeem</i>
                            <span>Benefits</span>
                        </a>
                    </li>
                    <?php } ?>

                    
                    <?php if ($user['type'] == 1) { // regular?>
                    <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'general') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Employees/view/">
                            <i class="material-icons">account_box</i>
                            <span>Profile</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                            <i class="material-icons">description</i>
                            <span>Personal Data</span>
                        </a>
                        <ul class="ml-menu">
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'personal') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/personal" class=" waves-effect waves-block">Personal Information</a>
                            </li>
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'family') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/family" class=" waves-effect waves-block">Family Background</a>
                            </li>
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'education') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/education" class=" waves-effect waves-block">Educational Background</a>
                            </li>
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'civil_service') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/civil_service" class=" waves-effect waves-block">Civil Service Eligibility</a>
                            </li>
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'work_experience') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/work_experience" class=" waves-effect waves-block">Work Experience</a>
                            </li>
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'voluntary_work') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/voluntary_work" class=" waves-effect waves-block">Voluntary Work</a>
                            </li>
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'trainings') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/trainings" class=" waves-effect waves-block">Trainings</a>
                            </li>
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'other_info') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/other_info" class=" waves-effect waves-block">Other Information</a>
                            </li>
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'questions') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/questions" class=" waves-effect waves-block"># 34-40</a>
                            </li>
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'references') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/references" class=" waves-effect waves-block">References</a>
                            </li>
                            <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'agreement') { echo 'active'; } ?>">
                                <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/agreement" class=" waves-effect waves-block">Agreement</a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'attendance') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/attendance">
                            <i class="material-icons">today</i>
                            <span>Attendance</span>
                        </a>
                    </li>
                    <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'leaves') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/leaves">
                            <i class="material-icons">event_note</i>
                            <span>Leave</span>
                        </a>
                    </li>
                    <li class="<?php if (isset($sub_nav_active) && $sub_nav_active == 'benefits') { echo 'active'; } ?>">
                        <a href="<?=base_url()?>Employees/view/<?=$user['id']?>/benefits">
                            <i class="material-icons">redeem</i>
                            <span>Benefits</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- #Menu -->
            
            <!-- Footer -->
            <div class="legal text-center">
                <div class="copyright">
                    <a href="javascript:void(0);"><?=system_title(FALSE)?></a>
                </div>
                <!-- <div class="version">
                    <b>&copy; <?=date('Y')?></b>
                </div> -->
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2 class="text-uppercase"><?php
                    echo (isset($page_title)) ? $page_title : '';
                ?></h2>
            </div>

            <!-- Body -->
            <?php
            echo (isset($body)) ? $body : '';
            ?>
            <!-- #END# Body -->

        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="<?=base_url() ?>assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?=base_url() ?>assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?=base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?=base_url() ?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?=base_url() ?>assets/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="<?=base_url() ?>assets/js/admin.js"></script>

    
    <script src="<?=base_url() ?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?=base_url() ?>assets/plugins/axios.min.js"></script>
    <script src="<?=base_url() ?>assets/js/helpers.js"></script>
    
    <script>
        var base_url = "<?=base_url() ?>";

    </script>

    <?php if(!empty($page_js)): ?>
    <?php foreach($page_js as $js): ?>
    
    <script src="<?=$js ?>"></script>
    <?php endforeach;?>
    <?php endif;?>

    <!-- Demo Js -->
    <script src="<?=base_url() ?>assets/js/demo.js"></script>
    <script src="<?=base_url() ?>assets/js/afterall.js"></script>
</body>

</html>