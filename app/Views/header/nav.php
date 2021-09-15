<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#b05f97">
    <title>Kwanso</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/node/mdi/css/materialdesignicons.min.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/node/simple-line-icons/css/simple-line-icons.css'); ?>">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
    <!-- endinject -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('assets/favicon/apple-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('assets/favicon/apple-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('assets/favicon/apple-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('assets/favicon/apple-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('assets/favicon/apple-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('assets/favicon/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('assets/favicon/apple-icon-144x144.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('assets/favicon/apple-icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets/favicon/apple-icon-180x180.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo base_url('assets/favicon/android-icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets/favicon/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('assets/favicon/favicon-96x96.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/favicon/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo base_url('assets/favicon/manifest.json'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url('assets/favicon/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css') ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-1.7.2.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js') ?>"></script>
    <script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyAvYKH87GTglaETSRTUEG-oJXvWxpwlT4I'></script>

</head>

<body style="background:white; ">
<div class="container-scroller">

    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
            <!--<h3 style="margin-top: 30px;">Orthodontist</h3>-->
            <a class="navbar-brand brand-logo" href="<?php echo base_url('home'); ?>">
                <img src="<?php echo base_url('assets/images/ic_launcher-playstore.png'); ?>" alt="orthodontist"/>
            </a>
            <a class="navbar-brand brand-logo-mini" href="<?php echo base_url('home'); ?>">
                <img src="<?php echo base_url('assets/images/ic_launcher-playstore.png'); ?>" alt="orthodontist"/>
            </a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <ul class="navbar-nav navbar-nav-right">

                <a style="float:right;" class="btn btn-primary btn-xs Right" href="<?php echo base_url('logout'); ?>">Log Out</a>

            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item nav-profile">
                    <div class="nav-link">
                        <div class="profile-name">
                            <h4 class="name">Kwanso</h4>
                        </div>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('home'); ?>">
                        <i class="mdi mdi-view-dashboard font1"></i>
                        <span class="menu-title">&nbsp;Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('users'); ?>">
                        <i class="mdi mdi-account font1"></i>
                        <span class="menu-title">&nbsp;Users</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('maps'); ?>">
                        <i class="mdi mdi-google-maps font1"></i>
                        <span class="menu-title">&nbsp;Map</span>
                    </a>
                </li>
            </ul>
        </nav>