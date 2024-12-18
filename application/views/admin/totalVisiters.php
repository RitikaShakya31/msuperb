<?php $this->load->view('admin/template/header', $title); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 "><?= $title ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Visited At</th>
                                        <th>Visited Page</th>
                                        <th>User</th>
                                        <th>IP Address</th>
                                        <th>User Agent</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($all_data) {
                                        $i = 0;
                                        foreach ($all_data as $all) {
                                    ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= $all['created_at'] ?></td>
                                                <td><a href="<?= $all['page'] ?>" target="_blank"><?= $all['page'] ?></a></td>
                                                <td><?php
                                                    if ($all['post_user_id'] == '0') {
                                                        echo 'Anonymous';
                                                    } else {
                                                        $getUser = getRowById('user_registration', 'user_id', $all['post_user_id']);
                                                    ?>
                                                        <b>Name:</b> <?= $getUser[0]['name'] ?> <br />
                                                        <b>Contact No.:</b> <?= $getUser[0]['contact_no'] ?><br />
                                                        <b>Email Id:</b> <?= $getUser[0]['email_id'] ?><br />
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td><?= $all['ip_address'] ?></td>
                                                <td><?= $all['user_agent'] ?></td>

                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/template/footer'); ?>