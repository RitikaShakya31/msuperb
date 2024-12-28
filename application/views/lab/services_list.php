<?php $this->load->view('user/template/header', $title); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12 mb-3 field_wrapper">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <div class="row"><label for="example-text-input"
                                                        class="col-md-4 col-form-label">Test/Service Name</label>
                                                    <div class="col-md-8"><input class="form-control" type="text"
                                                            name="service" required value="<?= $data['service_name'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 mb-3">
                                                <div class="row"><label for="example-text-input"
                                                        class="col-md-4 col-form-label">Charge</label>
                                                    <div class="col-md-8"><input class="form-control" type="number"
                                                            name="charge" required value="<?= $getservice['charge'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="save" class="btn btn-primary w-md">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form> -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Action</th>
                                        <th>Service Name</th>
                                        <th>Service Charge</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($service) {
                                        $i = 0;
                                        foreach ($service as $item) {
                                            $registerData = $this->CommonModal->getSingleRowById('all_service', "service_id =" . $item['service']);
                                            $i = $i + 1;
                                            $id = encryptId($item['register_id']);
                                            $sid =$item['id'];
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>services-list?sid=<?= $sid; ?>"
                                                        class="mt-1 btn btn-success"><i class="fa fa-edit"></i></a><br>
                                                    <a href="<?= base_url("services-list?dID=$id"); ?>"
                                                        onclick="return confirm('Are you sure ?')"
                                                        class="mt-1 btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                                <td>
                                                    <p style="line-height:25px;">
                                                        <?= ucwords($registerData['service_name']) ?>
                                                    </p>
                                                </td>
                                                <td><?= $item['charge'] ?> </td>
                                                
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