<?php $this->load->view('admin/template/header', $title); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 mb-3">
                                            <div class="row">
                                                <label for="example-text-input" class="col-md-3 col-form-label">Test
                                                    Name</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" name="service_name" required
                                                        value="<?= $service_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="row">
                                                <label for="example-text-input"
                                                    class="col-md-3 col-form-label">Reference Range</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" type="text" name="ref_range" required
                                                        value="<?= $ref_range ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3 text-center">
                                            <button type="submit" id="save" class="btn btn-primary w-md">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Action</th>
                                        <th>Published date</th>
                                        <th>Test Name</th>
                                        <th>Reference Range</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($all_service) {
                                        $i = 0;
                                        foreach ($all_service as $item) {
                                            $i = $i + 1;
                                            $id = encryptId($item['service_id']);
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>testAll?id=<?= $id; ?>"
                                                        class="mt-1 btn btn-success"><i class="fa fa-edit"></i></a><br>
                                                    <a href="<?= base_url("testAll?dID=$id"); ?>"
                                                        onclick="return confirm('Are you sure ?')"
                                                        class="mt-1 btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                                <td><?= $item['create_date'] ?> </td>
                                                <td>
                                                    <p style="line-height:25px;">
                                                        <?= ucwords($item['service_name']) ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <?= $item['ref_range'] ?>
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