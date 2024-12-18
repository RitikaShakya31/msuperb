<?php $this->load->view('admin/template/header', $title);
$date = $this->input->get('date');
?>
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
            <div class="row mb-4">
                <div class="col-12">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-2 col-sm-8">
                                <div class="input-group" id="datepicker1">
                                    <input type="text" class="form-control" data-date-format="dd-mm-yyyy" readonly
                                        data-date-container='#datepicker1' data-provide="datepicker" name="date"
                                        value="<?= $date ?>">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 8%">Sr no.</th>
                                        <th style="width: 10%">Date</th>
                                        <th style="width: 15%">Order ID</th>
                                        <th style="width: 12%">User Name</th>
                                        <th style="width: 12%">Order Details</th>
                                        <th style="width: 12%">Action</th>
                                        <!--<th style="width: 12%">Booking Items</th>-->
                                        <th style="width: 12%">Transaction Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($allOrders) {
                                        $i = 0;
                                        foreach ($allOrders as $all) {
                                            $id = encryptId($all['product_book_id']);
                                            $order_id = $all['order_id'];
                                            ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= date('d-M-Y h:i A', strtotime($all['create_date'])) ?></td>
                                                <td><?= $all['order_id'] ?></td>
                                                <td><?= $all['name'] ?></td>

                                                <td>
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#itemDetails<?= $i ?>">
                                                        <i class="fa fa-eye"></i>
                                                        View
                                                    </button>

                                                    <div class="modal fade bs-example-modal-lg" id="itemDetails<?= $i ?>"
                                                        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background: #eff2f7;">
                                                                    <h5 class="modal-title" id="myLargeModalLabel">
                                                                        <?= $all['order_id'] ?>
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-4">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <h4><strong>Basic details</strong></h4>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Name</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['name'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Phone</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['contact_no'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Email</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['email'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h4><strong>Billing Address</strong></h4>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Address</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= str_replace("/", "'", $all['address']) ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row  d-none">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Area</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['area'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>City</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['city'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>State</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['state'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Pin Code</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['postal_code'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                        if ($all['same_as_billing'] == '0') {
                                                                            ?>

                                                                            <div class="col-lg-4">
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <h4><strong>Shipping Address</strong></h4>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <h5><strong>Address</strong></h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6"
                                                                                        style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <?= str_replace("/", "'", $all['shipping_address']) ?>
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <h5><strong>City</strong></h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6"
                                                                                        style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <?= $all['shipping_city'] ?>
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <h5><strong>State</strong></h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6"
                                                                                        style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <?= $all['shipping_state'] ?>
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <h5><strong>Pin Code</strong></h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6"
                                                                                        style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <?= $all['shipping_zip'] ?>
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-header"
                                                                    style="background: #eff2f7;border-top: 1px solid #eff2f7;">
                                                                    <h5 class="modal-title">
                                                                        Transaction Details
                                                                    </h5>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <h5><strong>Payment Mode</strong>
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['payment_mode'] == '1' ? 'COD' : 'ONLINE' ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <h5><strong>Promo Code</strong>
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <b>
                                                                                            <?= $all['promocode_status'] == '0' ? ' ---- ' : $all['promocode'] ?>
                                                                                        </b>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            if ($all['payment_mode'] == '2') {
                                                                                ?>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <h5><strong>Transaction status</strong></h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6"
                                                                                        style="text-wrap: balance;">
                                                                                        <?php
                                                                                        if ($all['transaction_status'] == '0') {
                                                                                            echo '<h5><span class="badge badge-pill badge-soft-warning font-size-14">Pending</span></h5>';
                                                                                        } else if ($all['transaction_status'] == '1') {
                                                                                            echo '<h5><span class="badge badge-pill badge-soft-success font-size-14">Success</span></h5>';
                                                                                        } else {
                                                                                            echo '<h5><span class="badge badge-pill badge-soft-danger font-size-14">Cancel</span></h5>';
                                                                                        }
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <h5><strong>Transaction
                                                                                                amount</strong></h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6"
                                                                                        style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <?= $all['final_amount'] ?>
                                                                                            &#8377;
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <h5><strong>Payment ID</strong>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6"
                                                                                        style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <?= $all['payment_id'] ?>
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <h5><strong>Total Amount</strong>
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                    <?= number_format($all['total_item_amount']) ?>
                                                                                        &#8377;
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <h5><strong>Delivery
                                                                                            Charges</strong>
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <b>+</b>
                                                                                        <?= $all['delivery_charges'] ?>
                                                                                        &#8377;
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            if ($all['promocode_status'] == '1') { ?>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <h5><strong>Promo Code
                                                                                                Amount</strong>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6"
                                                                                        style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <b>-</b>
                                                                                            <?= $all['promocode_amount'] ?>
                                                                                            &#8377;
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                            <?php } ?>
                                                                            <div class="row">
                                                                                <hr>
                                                                                <div class="col-lg-6">
                                                                                    <h5><strong>Final Amount</strong>
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="col-lg-6"
                                                                                    style="text-wrap: balance;">
                                                                                    <h5>
                                                                                    <?= number_format($all['final_amount']) ?>
                                                                                        &#8377;
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-header"
                                                                    style="background: #eff2f7;border-top: 1px solid #eff2f7;">
                                                                    <h5 class="modal-title">
                                                                        Order Details
                                                                    </h5>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-lg-12" style="overflow-x: auto;">
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
                                                                                $final_amount = 0;
                                                                                $itemDetails = getRowById('book_item', 'order_id', $all['order_id']);
                                                                                if ($itemDetails) {
                                                                                    $j = 0;
                                                                                    foreach ($itemDetails as $item) {
                                                                                        $final_amount += $item['booking_price'];
                                                                                        $product = getSingleRowById('product', "product_id = '{$item['product_id']}'");
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <?= ++$j; ?>
                                                                                            </td>
                                                                                            <td style="text-wrap: balance;">
                                                                                                <?= $product ? $product['product_name'] : '-----' ?>
                                                                                            </td>
                                                                                            <td style="text-wrap: balance;">
                                                                                                <?= $item['variant_name'] ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?= $item['no_of_items'] ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?= number_format($item['base_price']) ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <!-- <?= $item['user_price'] ?> -->
                                                                                                <?= number_format($product['sale_price']) ?>
                                                                                            </td>
                                                                                            <td>
                                                                                            <?= number_format($product['sale_price'] * $item['no_of_items']) ?> &#8377;
                                                                                            </td>
                                                                                        </tr>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td colspan="5"></td>
                                                                                        <td><strong>Total Amount
                                                                                                : </strong>
                                                                                            <?= number_format($all['final_amount']) ?>
                                                                                            &#8377;
                                                                                        </td>
                                                                                    </tr>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td>
                                                    <?php
                                                    if ($all['booking_status'] == '4') { ?>
                                                        <span
                                                            class="badge badge-pill badge-soft-success font-size-14">Completed</span>
                                                    <?php } else if ($all['booking_status'] == '2') { ?>
                                                            <span class="badge badge-pill badge-soft-danger font-size-14">Cancel</span>
                                                    <?php } else if ($all['booking_status'] == '0') { ?>
                                                                <span class="badge badge-pill badge-soft-primary font-size-14">New</span>
                                                    <?php } else if ($all['booking_status'] == '1') { ?>
                                                                    <span
                                                                        class="badge badge-pill badge-soft-primary font-size-14">Accepted</span>
                                                    <?php } else if ($all['booking_status'] == '3') { ?>
                                                                        <span
                                                                            class="badge badge-pill badge-soft-success font-size-14">Dispatch</span>
                                                    <?php } ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    if ($all['payment_mode'] == '1') {
                                                        echo '<span class="badge badge-pill badge-soft-primary font-size-14">COD</span>';
                                                    } else {
                                                        echo '<span class="badge badge-pill badge-soft-primary font-size-14 mb-2">ONLINE - </span>';
                                                        if ($all['transaction_status'] == '0') {
                                                            echo '<span class="badge badge-pill badge-soft-warning font-size-14">Pending</span>';
                                                        } else if ($all['transaction_status'] == '1') {
                                                            echo '<span class="badge badge-pill badge-soft-success font-size-14">Success</span>';
                                                        } else {
                                                            echo '<span class="badge badge-pill badge-soft-danger font-size-14">Cancel</span>';
                                                        }
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