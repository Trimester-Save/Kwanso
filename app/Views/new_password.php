<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#b05f97">
    <title>Kwanso</title>
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

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <style>
        .row {
            padding: 7% 0;
        }
    </style>
</head>
<?php $session = \Config\Services::session(); ?>
<div class="form-gap"></div>
<div class="container">
    <div class="row text-center">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x"></i></h3>
                        <h2 class="text-center">New Password?</h2>
                        <div class="panel-body">

                            <form id="register-form" role="form" autocomplete="off" class="form" method="post"
                                  action="<?php echo base_url('login/change_password') ?>">
                                <?php if (isset($validation)) { ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <?php echo $validation->listErrors() ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                                        <input id="password" name="password" placeholder="New Password" class="form-control" type="password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-log-in color-blue"></i></span>
                                        <input id="confirm_pwd" name="confirm_pwd" placeholder="Confirm Password" class="form-control" type="password"
                                               required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                </div>

                                <input type="hidden" class="hide" name="token" id="token" value="">
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
