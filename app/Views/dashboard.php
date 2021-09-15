<?php include('header/nav.php') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .text-color {
            color: #b05f97;
        }

        .margin-top {
            margin-top: -14px;
        }
    </style>
    <!-- partial -->
    <div class="main-panel">
    <div class="content-wrapper">
        <div class="row purchace-popup">
            <div class="col-12">

            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <img src="<?php echo base_url('assets/images/man.png'); ?>" alt="image"/>
                            </div>
                            <div class="float-right">
                                <p class="card-text text-right"> Total Unregistered Users</p>
                                <div class="fluid-container">
                                    <h3 class="card-title font-weight-bold text-right mb-0"><?php echo $totalPhones; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left margin-top">
                                <i class="mdi mdi-account-check text-color icon-lg"></i>
                            </div>
                            <div class="float-right">
                                <p class="card-text text-right">Checked in Users</p>
                                <div class="fluid-container">
                                    <h3 class="card-title font-weight-bold text-right mb-0"><?php echo $totalUsers; ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Recently Checked in Users</h5>
                        <table class="table-responsive table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($recentUsersAdded)) :
                                $i = 1;
                                foreach ($recentUsersAdded as $user):
                                    echo '<tr>';
                                    echo '<td>' . $i++ . '</td>';
                                    echo '<td>' . $user['full_name'] . '</td>';
                                    echo '<td>' . $user['email'] . '</td>';
                                endforeach;
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Recently Unregistered Users</h5>
                        <table class="table-responsive table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($recentPhonesAdded)) :
                                $i = 1;
                                foreach ($recentPhonesAdded as $user):
                                    echo '<tr>';
                                    echo '<td>' . $i++ . '</td>';
                                    echo '<td>' . $user['phone_no'] . '</td>';
                                endforeach;
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php include('footer/footer.php') ?>