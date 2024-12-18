<?php $this->load->view('admin/template/header', $title); ?>
<?php $id = $this->input->get('id'); ?>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="example-text-input" class="col-form-label">Promo Code</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="promocode" value="<?= $promocode ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="example-text-input" class="col-form-label">Amount</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="amount" value="<?= $amount ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="example-text-input" class="col-form-label">Minimum Order</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="minimum_order" value="<?= $minimum_order ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="example-text-input" class="col-form-label">Expiry Date</label>
                                        <div class="col-md-9" id="datepicker2">
                                            <input type="text" class="form-control" placeholder="dd-mm-yyyy" readonly data-date-format="dd-mm-yyyy" data-date-container='#datepicker2' data-provide="datepicker" data-date-autoclose="true" value="<?= $expiry_date != "" ? date('d-m-Y', strtotime($expiry_date)) : '' ?>" name="expiry_date">
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="example-text-input" class="col-form-label">Payment Type</label>
                                        <div class="col-md-9" id="datepicker2">
                                            <select name="payment_method" id="" class="form-control">
                                                <option value="0" <?= $payment_method == '0' ? 'selected' : '' ?>>COD</option>
                                                <option value="1" <?= $payment_method == '1' ? 'selected' : '' ?>>Online Payment</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="example-text-input" class="col-form-label">Festive</label>
                                        <div class="col-md-9" id="datepicker2">
                                            <select name="festive" id="" class="form-control">
                                                <option value="0" <?= $festive == '0' ? 'selected' : '' ?>>No</option>
                                                <option value="1" <?= $festive == '1' ? 'selected' : '' ?>>Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" id="save" class="btn btn-primary w-md">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Promo Code</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Promo Code</th>
                                        <th>Amount</th>
                                        <th>Expiry</th>
                                        <th>Min Order</th>
                                        <th>Payment Type</th>
                                        <th>Festive</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $allPromo = getAllRowInOrder('promocode', 'promocode', 'ASC');
                                    if ($allPromo) {
                                        $i = 0;
                                        foreach ($allPromo as $all) {
                                            $id = encryptId($all['promocode_id']);
                                    ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= ucwords($all['promocode']) ?></td>
                                                <td><?= $all['amount'] ?></td>
                                                <td><?= date('d-M-Y', strtotime($all['expiry_date'])) ?></td>
                                                <td><?= $all['minimum_order'] ?></td>
                                                <td><?= $all['payment_method'] == '0' ? 'COD' : 'Online Payment'; ?></td>
                                                <td><?= $all['festive'] == '0' ? 'No' : 'Yes'; ?></td>
                                                <td>
                                                    <a href="<?= base_url("promoCode?promo=$id"); ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                    <a onclick="return confirm('Are you want to sure?')" href="<?= base_url("promoCode?dID=$id"); ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center">No Promo Code Available</td>
                                        </tr>
                                    <?php
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