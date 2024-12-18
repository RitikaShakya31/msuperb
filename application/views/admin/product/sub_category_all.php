<?php $this->load->view('admin/template/header', $title); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 "><?= $title ?></h2>
                        <a href="<?= base_url("subCategoryAdd"); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add</a>
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
                                        <th>Sr No.</th>
                                        <th>Sub Category Name</th>
                                        <th>Category Name</th>
                                        <th>Image</th>
                                        <th style="width: 15%">View Product</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($sub_category) {
                                        $i = 0;
                                        foreach ($sub_category as $item) {
                                            $i = $i + 1;
                                            $id = encryptId($item['sub_category_id']);
                                            $category = getSingleRowById('category', "category_id = '" . $item['category_id'] . "'");
                                            $getRows = getNumRows('product', "sub_category_id = '" . $item['sub_category_id'] . "' AND is_delete = '1'");
                                    ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= ucwords($item['sub_category_name']) ?> </td>
                                                <td><?= ucwords($category['category_name']) ?></td>
                                                <td>
                                                    <a href="upload/category/<?= $item['sub_category_image'] ?>">
                                                        <img src="upload/category/<?= $item['sub_category_image'] ?>" width="60" height="40">
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url("productAll?sCateId=$id"); ?>" class="btn btn-success"><i class="fa fa-eye"></i> View</a>

                                                    <span class="badge bg-yellow" style="margin-left: 10px"><?= $getRows; ?></span>
                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>subCategoryAdd?id=<?php echo $id; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                    <a onclick="return confirm('Are you want to sure ?')" href="<?= base_url("subCategoryAdd?dID=$id"); ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } ?>
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