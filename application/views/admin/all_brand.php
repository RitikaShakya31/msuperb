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
                                        <div class="col-lg-12 mb-3">
                                            <div class="row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Brand
                                                    Name</label>
                                                <div class="col-md-10">
                                                    <input class="form-control" type="text" name="brand_name" required
                                                        value="<?= $brand_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="row">
                                                <label for="example-text-input" class="col-md-2 col-form-label">Brand
                                                    Description</label>
                                                <div class="col-md-10">
                                                    <textarea name="brand_description" style="width: 100%;" id="editor"
                                                        rows="10"><?= $brand_description ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="row">
                                                <label for="example-text-input" class="col-md-4 col-form-label">Brand
                                                    Logo</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="file" name="brand_logo" required
                                                        <?= $brand_logo == "" ? 'required' : '' ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <img class="temp_image"
                                                src="<?= base_url('upload/category') . '/' . $brand_logo ?>"
                                                style=" height: 50px;">
                                            <input type="hidden" value="<?= $brand_logo ?>" name="temp_image">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="row">
                                                <label for="example-text-input" class="col-md-4 col-form-label">Brand
                                                    Banner</label>
                                                <div class="col-md-8">
                                                    <input class="form-control" type="file" name="brand_banner" required
                                                        value="<?= $brand_name ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <img class="temp_image"
                                                src="<?= base_url('upload/category') . '/' . $brand_banner ?>"
                                                style=" height: 50px;">
                                            <input type="hidden" value="<?= $brand_banner ?>" name="temp_image">
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mb-2">
                                    <button type="submit" id="save" class="btn btn-primary w-md">Save</button>
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
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Action</th>
                                        <th>Create date</th>
                                        <th>Brand Name</th>
                                        <th>Brand Logo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($all_brand) {
                                        $i = 0;
                                        foreach ($all_brand as $item) {
                                            $i = $i + 1;
                                            $id = encryptId($item['brand_id']);
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>brandAll?id=<?= $id; ?>"
                                                        class="mt-1 btn btn-success"><i class="fa fa-edit"></i></a><br>
                                                    <a href="<?= base_url("brandAll?dID=$id"); ?>"
                                                        onclick="return confirm('Are you sure ?')"
                                                        class="mt-1 btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td>
                                                <td><?= $item['create_date'] ?> </td>
                                                <td>
                                                    <p style="line-height:25px;">
                                                        <?= ucwords($item['brand_name']) ?>
                                                    </p>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url("upload/category/") . $item['brand_logo']; ?>" target="_blank">
                                                        <img src="<?= base_url("upload/category/") . $item['brand_logo']; ?>"
                                                            style="width: 80px; height: 60px">
                                                    </a>
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