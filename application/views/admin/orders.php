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
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 8%">S.n.</th>
                                        <th style="width: 10%">Date</th>
                                        <th style="width: 15%">Order ID</th>
                                        <th style="width: 12%">User Name</th>                                      
                                        <!--<th style="width: 15%">Prescription Image</th>-->

                                        <th style="width: 12%">Order Details</th>
                                        <!--<th style="width: 12%">Booking Items</th>-->

                                        <th style="width: 15%">Action</th>

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
                                                <td>
                                                    <?= ++$i; ?>
                                                </td>
                                                <td>
                                                    <?= wordwrap(date('d-M-Y h:i A', strtotime($all['create_date'])), 10, "<br />\n"); ?>
                                                </td>
                                                <td>
                                                    <?= $all['order_id'] ?><br>
                                                    <?php if ($all['booking_status'] == '1') {
                                                    ?>
                                                        <?php // echo ($all['shipment_id'] == '0' || $all['shipment_id'] == '') ? '<a href="' . base_url('shiprocket/' . $all['product_book_id']) . '"><span class="badge badge-pill badge-soft-primary font-size-14">Initiate Shiprocket</span></a>' : '<a href="#" class="badge badge-pill badge-soft-primary font-size-14">Shipment ID: ' . $all['shipment_id'] . '</a>' 
                                                        ?>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?= $all['name'] ?>
                                                </td>
                                                <!--  <td>-->
                                                <!--<a href="<?= base_url('upload/prescription/')  . $all['prescription_image'] ?>" target="_blank">-->
                                                <!--    <img src="<?= base_url('upload/prescription/')  . $all['prescription_image'] ?>" style=" height: 50px;">-->
                                                <!--</a>-->
                                                <!--</td> -->
                                                <td>
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#itemDetails<?= $i ?>">
                                                        <i class="fa fa-eye"></i>
                                                        View
                                                    </button>


                                                    <div class="modal fade bs-example-modal-lg" id="itemDetails<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background: #eff2f7;">
                                                                    <h5 class="modal-title" id="myLargeModalLabel">
                                                                        <?= $all['order_id'] ?>
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['name'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Phone</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['contact_no'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Email</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['email'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                        <div class="col-lg-4">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <h4><strong>Billing Address</strong></h4>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Address</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= str_replace("/", "'", $all['address']) ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row d-none">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Area</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['area'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>City</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['city'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>State</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= $all['state'] ?>
                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-4">
                                                                                    <h5><strong>Pin Code</strong></h5>
                                                                                </div>
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
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
                                                                                    <div class="col-lg-6" style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <?= str_replace("/", "'", $all['shipping_address']) ?>
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <h5><strong>City</strong></h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6" style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <?= $all['shipping_city'] ?>
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <h5><strong>State</strong></h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6" style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <?= $all['shipping_state'] ?>
                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-4">
                                                                                        <h5><strong>Pin Code</strong></h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6" style="text-wrap: balance;">
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
                                                                <div class="modal-header" style="background: #eff2f7;border-top: 1px solid #eff2f7;">
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
                                                                                    <th class="d-none">Market Price</th>
                                                                                    <th>Sale Price</th>
                                                                                    <th>Total Price</th>
                                                                                </tr>
                                                                                <?php
                                                                                $wp_items = [];
                                                                                $final_amount = 0;
                                                                                $itemDetails = getRowById('book_item', 'order_id', $all['order_id']);
                                                                                if ($itemDetails) {
                                                                                    $j = 0;
                                                                                    foreach ($itemDetails as $item) {
                                                                                        $final_amount += $item['booking_price'];
                                                                                        $product = getSingleRowById('product', "product_id = '{$item['product_id']}'");
                                                                                        $wp_items[] = ['name' => $product['product_name'], 'price' => number_format($item['base_price'])];

                                                                                ?>
                                                                                        <tr>
                                                                                            <td>
                                                                                                <?= ++$j; ?>
                                                                                            </td>
                                                                                            <td style="text-wrap: balance;">
                                                                                                <?= $product ? $product['product_name'] : '-----' ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?= $item['variant_name'] ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <?= $item['no_of_items'] ?>
                                                                                            </td>
                                                                                            <td class="d-none">
                                                                                                &#8377; <?= number_format($item['base_price']) ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                <!-- <?= $item['user_price'] ?> -->
                                                                                                &#8377; <?= $item['booking_price'] + $item['gst_amt'] ?>
                                                                                            </td>
                                                                                            <td>
                                                                                                &#8377; <?= number_format(($item['booking_price'] + $item['gst_amt']) * $item['no_of_items']) ?>
                                                                                            </td>
                                                                                        </tr>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                                    <!-- <tr>
                                                                                        <td colspan="5"></td>
                                                                                        <td><strong>Total Amount
                                                                                                : </strong>
                                                                                            <?= number_format($all['final_amount']) ?>
                                                                                            &#8377;
                                                                                        </td>
                                                                                    </tr> -->
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-header" style="background: #eff2f7;border-top: 1px solid #eff2f7;">
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
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
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
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
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
                                                                                    <div class="col-lg-6" style="text-wrap: balance;">
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
                                                                                    <div class="col-lg-6" style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            &#8377; <?= $all['final_amount'] ?>

                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <h5><strong>Payment ID</strong>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6" style="text-wrap: balance;">
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
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        &#8377; <?= ($all['total_item_amount']) ?>

                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-lg-6">
                                                                                    <h5><strong>Delivery
                                                                                            Charges</strong>
                                                                                    </h5>
                                                                                </div>
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        <?= ($all['delivery_charges'] > '0' ? '+ ₹' . $all['delivery_charges'] : 'Free') ?>
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
                                                                                    <div class="col-lg-6" style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <b>-</b>
                                                                                            &#8377; <?= $all['promocode_amount'] ?>

                                                                                        </h5>
                                                                                    </div>
                                                                                </div>
                                                                            <?php } ?>
                                                                            <?php
                                                                            if ($all['online_payment_discount'] > 0 && $all['payment_mode'] != '1') { ?>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6">
                                                                                        <h5><strong>Online payment discount (5%)</strong>
                                                                                        </h5>
                                                                                    </div>
                                                                                    <div class="col-lg-6" style="text-wrap: balance;">
                                                                                        <h5>
                                                                                            <b>-</b>
                                                                                            &#8377; <?= $all['online_payment_discount'] ?>

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
                                                                                <div class="col-lg-6" style="text-wrap: balance;">
                                                                                    <h5>
                                                                                        &#8377; <?= ($all['final_amount']) ?>

                                                                                    </h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                                if ($all['status'] == '10') {
                                                ?>
                                                    <td>
                                                        <a href="javascript: void(0);" class="text-warning mt-2" type="button" data-bs-toggle="modal" data-bs-target="#notification<?= $i ?>">
                                                            <i class="fa fa-eye"></i>
                                                            Send Whatsapp notification
                                                        </a>
                                                        <div class="modal fade" id="notification<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myLargeModalLabel">
                                                                            Enter Whatsapp Message
                                                                        </h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <form id="reorderForm">
                                                                                <div class="mb-3">
                                                                                    <label for="contactno" class="form-label">Contact no.</label>
                                                                                    <input type="text" class="form-control" id="contactno" name="contactno" value="<?= $all['contact_no'] ?>" required>
                                                                                </div>

                                                                                <div class="mb-3">
                                                                                    <label for="message" class="form-label">Message for Reordering</label>
                                                                                    <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message">Hi <?= $all['name'] ?>, 👋🏻
It looks like you’ve added some product/s to your cart but haven’t completed your order. Our supplements are designed to help you regain energy, improve vitality, and support overall well-being.

Here are the product list:
                                                                                    <?php
                                                                                    foreach ($wp_items as $wp_pro) {
                                                                                    ?>
                                                                                        <?= $wp_pro['name'] ?> at ₹<?= $wp_pro['price'] ?> mein! 💪
                                                                                        <?php
                                                                                    }
                                                                                        ?>
<?= base_url('reorder/' . $all['order_id']) ?> - Click here to Order Now 
                                                                                        </textarea>
                                                                                </div>

                                                                                <div class="d-grid gap-2">
                                                                                    <button type="button" id="sendnotification" class="btn btn-primary">Submit Reorder Request</button>
                                                                                </div>
                                                                            </form>
                                                                            <div id="responseMessage" class="mt-3"></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($all['payment_mode'] == '1') {
                                                            echo '<span class="badge badge-pill badge-soft-primary font-size-14">COD</span>';
                                                        } else {
                                                            echo '<span class="badge badge-pill badge-soft-primary font-size-14 mb-2">ONLINE</span><br>';
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
                                                <?php
                                                } else {
                                                ?>
                                                    <td>
                                                        <?php
                                                        if ($all['booking_status'] == '0') {
                                                        ?>
                                                            <button type="button" id="<?= $id ?>" datafld="<?= $order_id ?>" class="btn btn-success accept">
                                                                Accept
                                                            </button>
                                                            <button class="btn btn-danger cancel" onclick="checkCancel(this);" id="<?= $id ?>" datafld="<?= $order_id ?>">
                                                                Cancel
                                                            </button>
                                                        <?php
                                                        } else if ($all['booking_status'] == '1') {
                                                        ?>
                                                            <a class="btn btn-success" href="<?= base_url("dispatchOrder/$id/3") ?>">
                                                                Dispatch
                                                            </a>
                                                        <?php
                                                        } else if ($all['booking_status'] == '2') {
                                                        ?>
                                                            <span class="badge badge-pill badge-soft-danger font-size-14">Cancel by
                                                                <?= $all['cancel_by'] ?>
                                                            </span> <br />
                                                            <a href="javascript: void(0);" class="text-warning mt-2" type="button" data-bs-toggle="modal" data-bs-target="#cancelDetails<?= $i ?>">
                                                                <i class="fa fa-eye"></i>
                                                                Cancel Message
                                                            </a>
                                                            <?php if ($all['is_refunded'] == '0') { ?>
                                                                <a href="<?= base_url('statusrefunded/' . $id . '/1') ?>" class="badge btn-success">
                                                                    Refunded
                                                                </a>
                                                                <a class="badge btn-danger" href="<?= base_url('statusrefunded/' . $id . '/2') ?>">
                                                                    Cancel Refund
                                                                </a>

                                                            <?php
                                                            } elseif ($all['is_refunded'] == '1') {
                                                            ?>
                                                                <span class="badge btn-success"> Refunded </span>
                                                            <?php } elseif ($all['is_refunded'] == '2') {
                                                            ?>
                                                                <span class="badge btn-danger"> Cancelled Refund </span>
                                                            <?php } ?>

                                                            <div class="modal fade" id="cancelDetails<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myLargeModalLabel">
                                                                                <?= $all['order_id'] ?>
                                                                            </h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <?php if ($all['cancel_by'] == '1') { ?>
                                                                                    <div class="col-md-6">
                                                                                        Canceled by: Care1
                                                                                    </div>
                                                                                <?php
                                                                                } else {
                                                                                ?>
                                                                                    <div class="col-md-6">
                                                                                        Cancel By: <?= $all['cancel_by'] ?> <br />
                                                                                        Cancel date: <?= $all['cancel_date'] ?> <br />

                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                            <h5 class="mt-2">Cancel Reason:</h5>
                                                                            <p><?= $all['cancel_message'] ?></p>
                                                                            <h5 class="mt-2">Remarks:</h5>
                                                                            <p><?= $all['additionalComments'] ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } else if ($all['booking_status'] == '3') {
                                                        ?>
                                                            <a class="btn btn-success" href="<?= base_url("dispatchOrder/$id/4") ?>">
                                                                Complete
                                                            </a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="badge badge-pill badge-soft-success font-size-14">Complete</span>
                                                        <?php
                                                        } ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($all['payment_mode'] == '1') {
                                                            echo '<span class="badge badge-pill badge-soft-primary font-size-14">COD</span>';
                                                        } else {
                                                            echo '<span class="badge badge-pill badge-soft-primary font-size-14 mb-2">ONLINE</span><br>';
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
                                                <?php
                                                }
                                                ?>


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


<div class="modal fade acceptModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title acceptHead"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url("acceptOrder") ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Estimated Time</label>
                                    <div class="col-sm-12">
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" class="form-control" data-date-format="dd-mm-yyyy" readonly data-date-container='#datepicker1' data-provide="datepicker" name="estimated_date" value="<?= date('d-m-Y') ?>">
                                            <input type="time" class="form-control" name="estimated_time" required>
                                            <input name="id" type="hidden" class="booking_id">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; margin-top: 30px">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cancelModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="hideCancelModal();" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title acceptHead"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url("cancelOrder") ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Cancel
                                        Message</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="cancel_msg" rows="5" required></textarea>
                                        <input name="id" type="hidden" class="booking_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; margin-top: 30px">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('admin/template/footer'); ?>
<script>
    $('.accept').click(function() {
        let id = $(this).attr('id');
        let order_id = $(this).attr('datafld');
        $('.booking_id').val(id);
        $('.acceptHead').text(order_id);
        $('.acceptModal').modal('show');
    });



    function checkCancel(button) {
        let cancelBtn = button;
        let id = cancelBtn.getAttribute('id');
        let order_id = cancelBtn.getAttribute('datafld');
        $('.booking_id').val(id);
        $('.acceptHead').text(order_id);
        $('.cancelModal').modal('show');
    }

    function hideCancelModal() {
        $('.cancelModal').modal('hide');
    }

    // $('.cancel').click(function () {
    //     let id = $(this).attr('id');
    //     let order_id = $(this).attr('datafld');

    // });
</script>
<script>
    $(document).ready(function() {
        $('#sendnotification').click(function(e) {
            e.preventDefault();

            let contactno = $('#contactno').val();
            let message = $('#message').val();

            // Validate contact number
            if (contactno === '') {
                alert("Please enter the contact number.");
                return;
            }

            // Ajax request to send WhatsApp message
            $.ajax({
                url: '<?= base_url('sendnotification') ?>', // Update to your server-side script or API endpoint
                type: 'POST',
                data: {
                    contactno: contactno,
                    message: message
                },
                success: function(response) {
                    // Handle success response
                    $('#responseMessage').html('<div class="alert alert-success">Notification sent successfully!</div>');
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    $('#responseMessage').html('<div class="alert alert-danger">Failed to send notification. Please try again.</div>');
                }
            });
        });
    });
</script>