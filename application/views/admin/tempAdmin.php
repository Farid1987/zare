<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
        <title><?= $title;?></title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesdesign" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App Icons -->
        <!-- <link rel="shortcut icon" href="./assets/images/favicon.ico" /> -->

        <?php 
        if (isset($css_to_load)) {
          foreach ($css_to_load as $link) { 
        ?>
            <link rel="stylesheet" href="<?= $link?>">
        <?php 
          } 
        }
        ?>

        <!-- App css -->
        <link href="<?php echo base_url('assets/admin')?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/admin')?>/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/admin')?>/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url('assets/admin')?>/css/custom-admin.min.css" rel="stylesheet" type="text/css" />

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="<?php echo base_url('assets/admin')?>/js/jquery.min.js"></script>
    </head>
    <body>

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <!--<a href="index.html" class="logo">-->
                        <!--Upcube-->
                        <!--</a>-->
                        <!-- Image Logo -->
                        <a href="./index.html" class="logo">
                            <img src="<?php echo base_url('assets')?>/img/logo-zare.png" alt="" height="22" class="logo-small" />
                            <img src="<?php echo base_url('assets')?>/img/zare.png" alt="" height="30" class="logo-large" />
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                        <ul class="list-inline float-right mb-0">
                            <!-- notification-->
                            <!-- <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <i class="mdi mdi-bell-outline noti-icon"></i>
                                    <span class="badge badge-danger noti-icon-badge">3</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg">
                                    <div class="dropdown-item noti-title">
                                        <h5>Notification (3)</h5>
                                    </div>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                        <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                        <p class="notify-details"><b>Your order is placed</b><small class="text-muted">Dummy text of the printing and typesetting industry.</small></p>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                        <p class="notify-details"><b>New Message received</b><small class="text-muted">You have 87 unread messages</small></p>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-info"><i class="mdi mdi-martini"></i></div>
                                        <p class="notify-details"><b>Your item is shipped</b><small class="text-muted">It is a long established fact that a reader will</small></p>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        View All
                                    </a>
                                </div>
                            </li> -->
                            <!-- User-->
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                    <img src="<?php echo base_url('assets')?>/img/default-user.jpg" alt="user" class="rounded-circle" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <a class="dropdown-item" href="#"><i class="dripicons-user text-muted"></i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo site_url('loginAdmin/logout')?>"><i class="dripicons-exit text-muted"></i> Logout</a>
                                </div>
                            </li>
                            <li class="menu-item list-inline-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>

                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <!-- MENU Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li>
                                <a class="<?= (isset($active) && $active=='dashboard') ? 'active':''?>" href="<?= site_url('admin')?>"><i class="ti-home"></i>Dashboard</a>
                            </li>

                            <li>
                                <a class="<?= (isset($active) && $active=='users') ? 'active':''?>" href="<?= site_url('admin/users')?>"><i class="ti-user"></i>Users</a>
                            </li>

                            <li class="has-submenu <?= (isset($active) && $active=='masterdata') ? 'active':''?>">
                                <a href="#"><i class="ti-server"></i>Master Data</a>
                                <ul class="submenu">
                                    <li><a href="<?= site_url('admin/kategoriProduct')?>">Kategori Product</a></li>
                                </ul>
                            </li>

                            <li>
                                <a class="<?= (isset($active) && $active=='product') ? 'active':''?>" href="<?= site_url('admin/product')?>"><i class="ti-user"></i>Product</a>
                            </li>
                            
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container-fluid">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                  <?php
                                    $length = count($breadcrumb);
                                    for ($i=0; $i < $length; $i++) { ?>
                                      <li class="breadcrumb-item <?= ($i == $length-1) ? 'active':''?>"><a href="<?= ($i == $length-1) ? '#':$breadcrumb[$i][1]?>"><?= $breadcrumb[$i][0]?></a></li>

                                  <?php } ?>
                                </ol>
                            </div>
                            <h4 class="page-title"><?= $breadcrumb[count($breadcrumb)-1][0]?></h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->
                
                <?php echo $contents; ?>
                <!-- end main content -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                      zare.id © 2020 - Crafted with <i class="mdi mdi-heart text-success"></i>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer -->

                                      
        <script src="<?php echo base_url('assets/admin')?>/js/popper.min.js"></script>
        <script src="<?php echo base_url('assets/admin')?>/js/bootstrap.min.js"></script>
        <!-- <script src="<?php echo base_url('assets/admin')?>/js/modernizr.min.js"></script> -->
        <script src="<?php echo base_url('assets/admin')?>/js/waves.js"></script>
        <script src="<?php echo base_url('assets/admin')?>/js/jquery.slimscroll.js"></script>
        <!-- <script src="<?php echo base_url('assets/admin')?>/js/jquery.nicescroll.js"></script> -->
        <!-- <script src="<?php echo base_url('assets/admin')?>/js/jquery.scrollTo.min.js"></script> -->

        <!-- App js -->
        <script src="<?php echo base_url('assets/admin')?>/js/app.js"></script>

        <?php 
        if (isset($js_to_load)) {
          foreach ($js_to_load as $link) { 
        ?>
            <script src="<?= $link?>"></script>
        <?php 
          } 
        }
        ?>

    </body>
</html>