<?php
$base_url = base_url();
$theme_url = $base_url . 'assets/';
$admin_roles = explode(',', $_SESSION['admin_roles']);
//p($admin_roles);
?>

<!DOCTYPE html>

<html dir="ltr" lang="en">



<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">



    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">

    <meta name="author" content="">



    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $theme_url; ?>images/favicon-01.png">

    <title>Poket Eat</title>



    <link href="<?php echo $theme_url; ?>libs/flot/css/float-chart.css" rel="stylesheet">



    <link href="<?php echo $theme_url; ?>dist/css/style.min.css" rel="stylesheet">

    <script src="<?php echo $theme_url; ?>libs/jquery/dist/jquery.min.js"></script>


</head>



<body>



    <div class="preloader">

        <div class="lds-ripple">

            <div class="lds-pos"></div>

            <div class="lds-pos"></div>

        </div>

    </div>



    <div id="main-wrapper">

        <header class="topbar" data-navbarbg="skin5">

            <nav class="navbar top-navbar navbar-expand-md navbar-dark">

                <div class="navbar-header" data-logobg="skin5">



                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>



                    <a class="navbar-brand" href="dashboard">



                        <b class="logo-icon">



                            <img src="<?php echo $theme_url; ?>images/rest_logo.svg" alt="homepage" class="light-logo" style="width:30px;padding-right:5px;" />



                        </b>



                        <span class="logo-text">


                            <h2 class="p-0 m-0">PoketEat</h2>
                            <!-- <img src="<?php echo $theme_url; ?>images/logo-text.png" alt="homepage" class="light-logo" /> -->



                        </span>



                    </a>



                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>

                </div>



                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">



                    <ul class="navbar-nav float-left mr-auto">

                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>





                    </ul>

                    <span style="color: #fff;"><?php echo $_SESSION['admin_username']; ?></span>

                    <ul class="navbar-nav float-right">





                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $theme_url; ?>images/users/1.jpg" alt="user" class="rounded-circle" width="31"></a>

                            <div class="dropdown-menu dropdown-menu-right user-dd animated">



                                <div class="dropdown-divider"></div>

                                <a href="<?php echo base_url(); ?>admin/logout" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                
                                <div class="dropdown-divider"></div>

                                <a href="<?php echo base_url(); ?>admin/change_password" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-key m-r-5 m-l-5"></i> Change Password</a>

                            </div>

                        </li>



                    </ul>

                </div>

            </nav>

        </header>



        <aside class="left-sidebar" data-sidebarbg="skin5">

            <!-- Sidebar scroll-->

            <div class="scroll-sidebar" style="overflow: auto;">

                <!-- Sidebar navigation-->

                <nav class="sidebar-nav">

                    <ul id="sidebarnav" class="p-t-30">

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>


                        <?php
                        if (in_array("food_type_list", $admin_roles)) {
                            ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/food_type_list" aria-expanded="false"><i class="mdi mdi-food-variant"></i><span class="hide-menu">Cuisine type</span></a></li>
                        <?php

                    }
                    ?>



                        <?php
                        if (in_array("label_list", $admin_roles)) {
                            ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/label_list" aria-expanded="false"><i class="mdi mdi-label"></i><span class="hide-menu">Labels</span></a></li>
                        <?php 
                    } ?>

                        <?php
                        if (in_array("resturant_list", $admin_roles)) {
                            ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/resturant_list" aria-expanded="false"><i class="mdi mdi-beach"></i><span class="hide-menu">Restaurants</span></a></li>

                        <?php 
                    } ?>

                        <?php
                        if (in_array("food_dish_list", $admin_roles)) {
                            ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/food_dish_list" aria-expanded="false"><i class="mdi mdi-food"></i><span class="hide-menu">Food dishes</span></a></li>
                        <?php 
                    } ?>

                        <?php
                        if (in_array("users_list", $admin_roles)) {
                            ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/users_list" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Users</span></a></li>
                        <?php 
                    } ?>

                        <?php if (in_array("staff_list", $admin_roles)) { ?>
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-account-settings-variant"></i><span class="hide-menu">Staff </span></a>
                            <?php 
                        } ?>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <?php if (in_array("staff_list", $admin_roles)) { ?>

                                <li class="sidebar-item"><a href="<?php echo base_url(); ?>admin/staff_list" class="sidebar-link"><i class="mdi mdi-account-switch"></i><span class="hide-menu">Staff list</span></a></li>
                                <?php 
                            } ?>

                                <?php if (in_array("staff_category_list", $admin_roles)) { ?>
                                <li class="sidebar-item"><a href="<?php echo base_url(); ?>admin/staff_category_list" class="sidebar-link"><i class="mdi mdi-account-network "></i><span class="hide-menu">Staff category</span></a></li>
                                <?php 
                            } ?>

                            </ul>
                        </li>


                        <?php if (in_array("notification_list", $admin_roles)) { ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url(); ?>admin/notification_list" aria-expanded="false"><i class="mdi mdi-information"></i><span class="hide-menu">Notification</span></a></li>
                        <?php 
                    } ?>


                    </ul>

                </nav>

                <!-- End Sidebar navigation -->

            </div>

            <!-- End Sidebar scroll-->

        </aside> 