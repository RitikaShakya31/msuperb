<?php $this->load->view('lab/template/header', $title); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 "><?= $title ?></h2>
                        <p>
                            <span class="badge badge-pill badge-soft-warning font-size-15 filter-status" data-status="0"
                                style="cursor: pointer;">Pending</span>
                            <span class="badge badge-pill badge-soft-success font-size-15 filter-status" data-status="1"
                                style="cursor: pointer;">Paid</span>
                        </p>
                        <!-- <a href="<?= base_url("testAdd"); ?>" class="btn btn-success"><i class="fa fa-plus"></i>
                            Add</a> -->
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
                                        <th>Appointment Date</th>
                                        <th>Patient Name</th>
                                        <th>Test</th>
                                        <th>Payment Amount</th>
                                        <th>Payment Status</th>
                                        <!-- <th>More Details</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($paymentData) {
                                        $i = 0;
                                        foreach ($paymentData as $item) {
                                            $order_id = $item['order_id'];
                                            $pro_id = $this->CommonModel->getSingleRowById('book_item', "order_id = '$order_id'");
                                            $pro_name = $pro_id['product_name'];
                                            $test_name = $this->CommonModel->getSingleRowById('all_service', "service_id = '$pro_name'");
                                            $i = $i + 1;

                                            $id = encryptId($item['id']);

                                            $test_amount = $item['final_amount']; // Received payment amount
                                            $commission_percentage = $commission; // Commission in percentage
                                            // Calculate commission amount
                                            $commission_amount = ($test_amount * $commission_percentage) / 100;
                                            // Calculate lab payment (remaining amount after deducting commission)
                                            $lab_payment = $test_amount - $commission_amount;
                                            ?>
                                            <tr data-status="<?= $item['payment_status'] ?>">
                                                <td><?= $i ?></td>
                                                <td><?= $item['appointment_date'] ?></td>
                                                <td>
                                                    <p style="line-height:25px;"><?= ucwords($item['name']) ?></p>
                                                </td>
                                                <td><?= $test_name['service_name'] ?> </td>
                                                <td><?= number_format($lab_payment, 2) ?></td>
                                                <td>
                                                    <?php
                                                    if ($item['payment_status'] == '1') {
                                                        echo '<span class="badge badge-pill badge-soft-success font-size-14 mb-2">Success</span><br>';
                                                    } else {
                                                        echo '<span class="badge badge-pill badge-soft-warning font-size-14">Paid</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <!-- <td>
                                                    <button class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#appointmodal<?= $i ?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                                    </button>
                                                </td> -->
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
<script>
    $(document).ready(function () {
        $('.filter-status').on('click', function () {
            var status = $(this).data('status');

            // Show all rows if no status is selected
            if (status === undefined) {
                $('#datatable tbody tr').show();
            } else {
                // Hide rows that don't match the selected status
                $('#datatable tbody tr').hide();
                $('#datatable tbody tr[data-status="' + status + '"]').show();
            }
        });
    });

</script>
<!-- Modal -->
<div class="modal fade" id="appointmodal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $i ?>"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel<?= $i ?>">
                    Transaction Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <button type="button" class="btn btn-primary btn-sm ms-3" id="copyBtn<?= $i ?>">Copy All Info</button>
            </div>
            <div class="modal-body" id="modalBody<?= $i ?>">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Transaction Date</th>
                            <th>Transaction ID</th>
                            <th>Transaction Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>