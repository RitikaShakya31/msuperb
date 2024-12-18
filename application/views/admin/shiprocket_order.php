<?php $this->load->view('admin/template/header', $title); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 ">
                            <?= $title ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="content-wrapper">
                            <div class="page-header mt-3 text-center">
                                <?php
                                if ($this->session->has_userdata('msg')) {
                                    echo $this->session->userdata('msg');
                                    $this->session->unset_userdata('msg');
                                }
                                ?>
                                <?php
                                // && $checkout['awb_code'] == ''
                                if ($checkout['shipment_id'] != '0' && $checkout['shipment_id'] != '') {
                                ?>
                                    <span class="btn btn-info">Note : Order is Saved in Shiprocket.You have to manually select courier from your Shiprocket panel. Your shipment ID is <b><?= $checkout['shipment_id'] ?></b></span>
                                    <!--<a href="<?= base_url('admin_dashboard/courier/' . $checkout['id']) ?>" class="bn btn-danger p-1 m-1">Select courier</a>-->
                                <?php

                                }
                                ?>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="page-title">Initiate Shiprocket</h3>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label class="">Package Length (in cm)</label>
                                            <input class="form-control" required="" type="text" name="length" value="<?= $checkout['length'] ?>" />
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="">Package Height (in cm)</label>
                                            <input class="form-control" required="" type="text" name="height" value="<?= $checkout['height'] ?>" />
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class="">Package Breadth (in cm)</label>
                                            <input class="form-control" required="" type="text" name="breadth" value="<?= $checkout['breadth'] ?>" />
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="">Package Weight (in kg)</label>
                                            <input class="form-control" required="" type="text" name="weight" value="<?= $checkout['weight'] ?>" />
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="">Any remark</label>
                                            <textarea class="form-control" name="any_notes"><?= $checkout['any_notes'] ?></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                        
                                            <button type="submit" class="btn btn-primary mt-2" <?= ($checkout['shipment_id'] != '')? 'disabled':'' ?>>Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">

                                <div class="card-header">
                                    <h3 class="page-title">Product list </h3>
                                </div>
                                <div class="card-body row">
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>Sr. no.</th>
                                                <th>Product Name</th>
                                                <th>Variant Name</th>
                                                <th>Quantity</th>
                                                <th>Base Price</th>
                                                <th>User Price</th>
                                                <th>Price</th>
                                            </tr>
                                            <?php
                                            $i = 1;
                                            $ship_product = array();
                                            if ($checkoutProduct) {
                                                $j = 0;
                                                foreach ($checkoutProduct as $item) {
                                                    $product = getSingleRowById('product', "product_id = '{$item['product_id']}'");
                                            ?>
                                                    <tr>
                                                        <td><?= ++$j; ?></td>
                                                        <td><?= $product ? $product['product_name'] : '-----' ?></td>
                                                        <td><?= $item['variant_name'] ?></td>
                                                        <td><?= $item['no_of_items'] ?></td>
                                                        <td><?= $item['base_price'] ?></td>
                                                        <td><?= $item['user_price'] ?></td>
                                                        <td><?= $item['booking_price'] ?> &#8377;</td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                    $prod = array(
                                                        "name" => $pro['product_name'],
                                                        "sku" => $pro['product_id'],
                                                        "units" => (int)$pro['product_quantity'],
                                                        "selling_price" => (int)$pro['total_pro_amt'],
                                                        "discount" => "",
                                                        "tax" => "",
                                                        "hsn" => ""
                                                    );
                                                    array_push($ship_product, $prod);
                                                }
                                                ?>
                                                <tr>
                                                    <td colspan="5"><strong>Total Amount
                                                            : </strong> </td>
                                                    <td><?= $checkout['total_item_amount'] ?>
                                                        &#8377;
                                                    </td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                        <input type="hidden" name="ship_product" value="<?php print_r($ship_product); ?>" />
                                        <!-- <input type="hidden" name="weight" value="1" /> -->
                                    </div>
                                </div>
                            </div>

                            <div class="card">

                                <div class="card-header  ">
                                    <h3 class="page-title">Order overview</h3>
                                </div>
                                <div class="card-body row">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-lg-5 border p-2">
                                                <h5><strong>Name</strong></h5>
                                            </div>
                                            <div class="col-lg-7 border p-2">
                                                <h5><?= $checkout['name'] ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-lg-5 border p-2">
                                                <h5><strong>Phone</strong></h5>
                                            </div>
                                            <div class="col-lg-7 border p-2">
                                                <h5><?= $checkout['contact_no'] ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-lg-5 border p-2">
                                                <h5><strong>Area</strong></h5>
                                            </div>
                                            <div class="col-lg-7 border p-2">
                                                <h5><?= $checkout['area'] ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-lg-5 border p-2">
                                                <h5><strong>Pin Code</strong></h5>
                                            </div>
                                            <div class="col-lg-7 border p-2">
                                                <h5><?= $checkout['postal_code'] ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-lg-5 border p-2">
                                                <h5><strong>State</strong></h5>
                                            </div>
                                            <div class="col-lg-7 border p-2">
                                                <h5><?= $checkout['state'] ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-lg-5 border p-2">
                                                <h5><strong>City</strong></h5>
                                            </div>
                                            <div class="col-lg-7 border p-2">
                                                <h5><?= $checkout['city'] ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-lg-2 border p-2">
                                                <h5><strong>Address</strong></h5>
                                            </div>
                                            <div class="col-lg-10 border p-2">
                                                <h5><?= str_replace("/", "'", $checkout['address']) ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">

                                <div class="card-header ">
                                    <h3 class="page-title">Transaction Details</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-lg-6  ">
                                                    <div class="row">
                                                        <div class="col-lg-6 border p-2">
                                                            <h5><strong>Payment Mode</strong>
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-6 border p-2">
                                                            <h5><?= $checkout['payment_mode'] == '1' ? 'COD' : 'ONLINE' ?></h5>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 border p-2">
                                                            <h5><strong>Promo Code</strong>
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-6 border p-2">
                                                            <h5>
                                                                <b><?= $checkout['promocode'] ?>
                                                                </b>
                                                            </h5>
                                                        </div>
                                                    </div>

                                                    <?php
                                                    if ($checkout['payment_mode'] == '2') {
                                                    ?>
                                                        <div class="row">
                                                            <div class="col-lg-6 border p-2">
                                                                <h5><strong>Transaction status</strong></h5>
                                                            </div>
                                                            <div class="col-lg-6 border p-2">
                                                                <?php
                                                                if ($checkout['transaction_status'] == '0') {
                                                                    echo '<h5><span class="badge badge-pill badge-soft-warning font-size-14">Pending</span></h5>';
                                                                } else if ($checkout['transaction_status'] == '1') {
                                                                    echo '<h5><span class="badge badge-pill badge-soft-success font-size-14">Success</span></h5>';
                                                                } else {
                                                                    echo '<h5><span class="badge badge-pill badge-soft-danger font-size-14">Cancel</span></h5>';
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 border p-2">
                                                                <h5><strong>Transaction
                                                                        amount</strong></h5>
                                                            </div>
                                                            <div class="col-lg-6 border p-2">
                                                                <h5><?= $checkout['final_amount'] ?>
                                                                    &#8377;</h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6 border p-2">
                                                                <h5><strong>Payment ID</strong>
                                                                </h5>
                                                            </div>
                                                            <div class="col-lg-6 border p-2">
                                                                <h5><?= $checkout['payment_id'] ?></h5>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-lg-6  ">
                                                    <div class="row">
                                                        <div class="col-lg-6 border p-2">
                                                            <h5><strong>Total Amount</strong>
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-6 border p-2">
                                                            <h5><?= $checkout['total_item_amount'] ?>
                                                                &#8377;</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 border p-2">
                                                            <h5><strong>Delivery
                                                                    Charges</strong>
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-6 border p-2">
                                                            <h5>
                                                                <b>+</b> 50 
                                                                <!-- <?= $checkout['delivery_charges'] ?> -->
                                                                &#8377;
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 border p-2">
                                                            <h5><strong>Promo Code
                                                                    Amount</strong>
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-6 border p-2">
                                                            <h5>
                                                                <b>-</b> <?= $checkout['promocode_amount'] ?>
                                                                &#8377;
                                                            </h5>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <hr>
                                                        <div class="col-lg-6 border p-2">
                                                            <h5><strong>Final Amount</strong>
                                                            </h5>
                                                        </div>
                                                        <div class="col-lg-6 border p-2">
                                                            <h5><?= $checkout['final_amount'] ?>
                                                                &#8377;</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card">

                                <div class="card-header">
                                    <h3 class="page-title">Any notes</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-responsive">
                                                <tbody>

                                                    <tr>
                                                        <td><?php echo $checkout['any_notes']; ?></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('admin/template/footer'); ?>