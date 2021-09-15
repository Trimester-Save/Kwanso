<?php include('header/nav.php') ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">

            <div class="col-md-12">
                <h4>Users list</h4>
                <div class="table-responsive">
                    <table id="mytable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1 + (10 * ($currentPage - 1));
                        if (!empty($getAllUsers)):
                            foreach ($getAllUsers as $user):
                                echo '<tr>';
                                echo '<td>' . $i++ . '</td>';
                                echo '<td>' . $user['full_name'] . '</td>';
                                echo '<td>' . $user['email'] . '</td>';
                                echo '<td>' . $user['phone'] . '</td>';
                                echo '</tr>';
                            endforeach;

                        else:
                            echo '<tr>';
                            echo '<td colspan="4" align="center"><h2>No record Found</h2></td>';
                            echo '</tr>';
                        endif;
                        ?>
                        <!--<tr>

                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                                            <a href="<?php /*echo base_url('Admin/delete_data/' . $d->id); */ ?>"
                                               onClick="return confirm('Are you sure you want to delete?')"
                                               class="btn btn-danger btn-xs" id="<?php /*echo $d->id; */ ?>">Delete</a>
                                        </p>
                                    </td>
                                </tr>-->
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <?php if ($pager) : ?>
                                <?php $page_path = 'kwanso-web/users'; ?>
                                <?php $pager->setPath($page_path); ?>
                                <?= $pager->links('custom', 'custom_pagination') ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer/footer.php') ?>

