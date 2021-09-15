<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="theme-color" content="#aa5391">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kwanso Login</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style1.css'); ?>">
    <script src="<?php echo base_url('assets/js/jquery-1.11.1.min.js'); ?>"></script>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" id="bootstrap-css">
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>

    <!------ Include the above in your HEAD tag ---------->
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

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url('assets/js/bootstrapValidator.min.js'); ?>"></script>
    <style>
        .help-block {
            color: red;
        }
    </style>
</head>

<body>
<?php $session = \Config\Services::session(); ?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6 col-md-offset-3">
            <div id="iosBlurBg">
                <div id="whiteBg"></div>
            </div>
            <div id="bottomEnter"></div>
            <div id="bottomBlurBg"></div>
            <!-- Login Form -->
            <div class="confirm-div" style="color:green"></div>
            <div class="error-div" style="color:red"></div>
            <div class="loginForm">
                <div class="title">
                    <a class="brand-logo" href="<?php echo base_url() ?>">
                        <img class="loginlogo" src="<?php echo base_url('assets/images/ic_launcher-playstore.png'); ?>" alt="orthodontists"/>
                    </a>
                    <p>LOGIN FOR<br><span>KWANSO </span></p>
                    <hr>
                    <hr class="short">
                </div>
                <form method="post" action="<?php echo base_url('login/checkLogin'); ?>" name="do_login" id="do_login">
                    <div class="col-3">
                        <input style="background-color:white; " class="effect-2" type="text" placeholder="Enter your Email address" name="email"
                               id="email">
                        <span class="focus-border"></span>

                        <input class="effect-2" type="password" placeholder="Enter your Password" name="password" id="password">
                        <span class="focus-border"></span>
                    </div>
                    <div class="col-3">
                        <a href="<?php echo base_url('login/forgot_password')?>" >Forgot password ?</a>
                    </div>
                    <div class="forget">
                        <button type="submit" class="btn btn-primary btn-lg">LOGIN</button>
                    </div>
                </form>
            </div>

            <a href="<?php echo base_url(); ?>Admin/new_here">
                <div class="enterButton">
                    <span class="enterText text-white"></span>
                </div>
            </a>
        </div>
    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function () {
        $('#do_login').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter your email address'
                        },
                        emailAddress: {
                            message: 'Please enter a valid email address'
                        }
                    }
                },

                pass: {
                    validators: {
                        stringLength: {
                            min: 6,
                        },
                        notEmpty: {
                            message: 'Please enter your password'
                        },
                    }
                },

            }
        });
    });


    // assumes you're using jQuery

    $('.confirm-div').hide();
    $('.error-div').hide();
    <?php if($session->getFlashdata('success')){ ?>
    $('.confirm-div').html('<?php echo $session->getFlashdata('success'); ?>').show();
    <?php } ?>

    <?php if($session->getFlashdata('error')){ ?>
    $('.error-div').html('<?php echo $session->getFlashdata('error'); ?>').show();
    <?php } ?>

    <?php if (isset($validation)) { ?>
    $('.error-div').html('Email or Password is wrong').show();
    <?php } ?>
</script>
