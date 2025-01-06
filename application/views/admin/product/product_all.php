<?php $this->load->view('admin/template/header', $title); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-sm-0 "><?= $title ?></h2>
                    <div class="page-title-box d-sm-flex align-items-center justify-content-end">
                        <a href="<?= base_url("productExcelUpload"); ?>" class="btn btn-success"
                            style="margin-right: 10px;"><i class="fa fa-file-excel"></i>
                            Upload Excel</a>
                        <a href="<?= base_url("productAdd"); ?>" class="btn btn-success"><i class="fa fa-plus"></i>
                            Add</a>
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
                                        <th>Brand</th>
                                        <th>Test Name</th>
                                        <th>Test Type</th>
                                        <th>Test Amount</th>
                                        <!-- <th>Sale Price</th> -->
                                        <!-- <th>Quantity</th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($all_product) {
                                        $i = 0;
                                        foreach ($all_product as $item) {
                                            $i = $i + 1;
                                            $getPro = $this->CommonModel->getSingleRowById('all_service', ['service_id' => $item['product_name']]);
                                            $getBrand = $this->CommonModel->getSingleRowById('tbl_category', ['category_id' => $item['category_id']]);
                                            $id = encryptId($item['product_id']);
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $getBrand['category_name'] ?> </td>
                                                <td>
                                                    <p class="wrap_text"><?= ucwords($getPro['service_name']) ?></p>
                                                    <?= (($item['is_bestselling'] == '1') ? '<span class="bg-info badge badge-info">Bestselling</span>' : '') ?>
                                                </td>
                                                <!-- <td><?= (($item['product_status'] == '1') ? '<span class="bg-info badge badge-info">Instock</span>' : (($item['product_status'] == '2') ? '<span class="bg-danger badge badge-danger">Out of stock</span>' : '')) ?></td> -->
                                                <td><?= (($item['product_type'] == '3') ? 'Package' : (($item['product_type'] == '2') ? 'Offer' : 'Normal')) ?>
                                                </td>
                                                <!-- <td><?= $item['market_price'] ?></td> -->
                                                <td><?= $item['sale_price'] ?></td>
                                                <!-- <td><?= $item['quantity'] ?> <?= $item['quantity_type'] ?></td> -->
                                                <td>
                                                    <a href="<?php echo base_url(); ?>productDetails?id=<?= $id; ?>"
                                                        class="btn btn-primary"><i class="fa fa-eye"></i> View</a>
                                                    <a href="<?php echo base_url(); ?>productAdd?id=<?= $id; ?>"
                                                        class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                    <a href="<?= base_url("productAll?dID=$id"); ?>"
                                                        onclick="return confirm('Are you sure ?')" class="btn btn-danger"><i
                                                            class="fa fa-trash"></i> Delete</a>
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