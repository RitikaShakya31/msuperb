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
                                        <th>Review date</th>
                                        <th>Product</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Rate</th>
                                        <th>Feedback</th>
                                        <th>Video</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($all_data) {
                                        $i = 0;
                                        foreach ($all_data as $all) {
                                            $product = getSingleRowById('product', ['product_id' => $all['product_id']]);
                                            $id = encryptId($all['rid']);
                                    ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= $all['create_date'] ?></td>
                                                <td><?= ucwords($product['product_name']) ?></td>
                                                <td><?= ucwords($all['name']) ?></td>
                                                <td><?= $all['email_id'] ?></td>
                                                <td><?= $all['rate'] ?></td>
                                                <td><?= $all['review_text'] ?></td>
                                                <td>
                                                    <?php 
                                                    if($all['video_review'] != 'error'){
                                                    ?>
                                                    <a href="<?= base_url('upload/video_review/' . $all['video_review']) ?>">View video</a></td>
                                                    <?php } ?>
                                                <td>
                                                    <?php
                                                    if ($all['status'] == 'new') { ?>
                                                        <a class="btn btn-danger" onclick="return confirm('Are You sure ?')" href="<?= base_url("reviewStatus/$id/1") ?>">
                                                            Active
                                                        </a>
                                                        <a class="btn btn-success" onclick="return confirm('Are You sure ?')" href="<?= base_url("reviewStatus/$id/2") ?>">
                                                            Inactive
                                                        </a>
                                                    <?php } elseif ($all['status'] == 'accepted') { ?>
                                                        <a class="btn btn-success" onclick="return confirm('Are You sure ?')" href="<?= base_url("reviewStatus/$id/2") ?>">
                                                            Active
                                                        </a>
                                                    <?php } elseif ($all['status'] == 'rejected') { ?>
                                                        <a class="btn btn-danger" onclick="return confirm('Are You sure ?')" href="<?= base_url("reviewStatus/$id/1") ?>">
                                                            Inactive
                                                        </a>
                                                    <?php } else {
                                                    }
                                                    ?>

                                                </td>

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