<?php $this->load->view('admin/template/header', $title); ?>
<style>
    .dots-menu {
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
        display: inline-block;
        user-select: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: -111px;
        /* Adjust for alignment */
        top: 10px;
        /* Adjust for vertical spacing */
        background-color: #f9f9f9;
        min-width: 140px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 10px 15px;
        text-decoration: none;
        display: block;
        font-size: 12px;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 "><?= $title ?></h2>
                        <p>
                            <span class="badge badge-pill badge-soft-danger font-size-15 filter-status" data-status="0" style="cursor: pointer;">Pending</span>
                            <span class="badge badge-pill badge-soft-success font-size-15 filter-status" data-status="1" style="cursor: pointer;">Paid</span>
                        </p>
                        <a href="<?= base_url("testAdd"); ?>" class="btn btn-success"><i class="fa fa-plus"></i>
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
                                        <!-- <th>Action</th> -->
                                        <th>Patient Name</th>
                                        <th>Payment Received</th>
                                        <th>Commission amount</th>
                                        <th>Lab Payment Amount</th>
                                        <th>Payment Status</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($payment_details) {
                                        $i = 0;
                                        foreach ($payment_details as $item) {
                                            $i = $i + 1;
                                            $id = encryptId($item['id']);
                                            $test_amount = $item['test_amount']; // Received payment amount
                                            $commission_percentage = $commission; // Commission in percentage
                                    
                                            // Calculate commission amount
                                            $commission_amount = ($test_amount * $commission_percentage) / 100;

                                            // Calculate lab payment (remaining amount after deducting commission)
                                            $lab_payment = $test_amount - $commission_amount;
                                            ?>
                                            <tr data-status="<?= $item['lab_payment_status'] ?>">
                                                <td><?= $i ?></td>
                                                <td>
                                                    <?= $item['patient_name'] ?>
                                                </td>
                                                <td>
                                                    <?= $item['test_amount'] ?>
                                                </td>
                                                <td>
                                                    <?= number_format($commission_amount, 2) ?>
                                                </td>
                                                <td>
                                                    <?= number_format($lab_payment, 2) ?>
                                                </td>
                                                <td>
                                                    <form action="<?= base_url("paymentStatus/$id") ?>" method="POST"
                                                        onsubmit="return confirm('Are you sure to update?')">
                                                        <select class="form-control" name="lab_payment_status"
                                                            onchange="this.form.submit()">
                                                            <option value="0" <?= $item['lab_payment_status'] == '0' ? 'selected' : '' ?>>Pending</option>
                                                            <option value="1" <?= $item['lab_payment_status'] == '1' ? 'selected' : '' ?>>Paid</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <span class="dots-menu" title="More Options">⋮</span>
                                                        <div class="dropdown-content">
                                                            <a data-bs-toggle="modal" data-bs-target="#appointmodal<?= $i ?>">
                                                                <i class="fa fa-eye" aria-hidden="true"></i> Patient Details
                                                            </a>
                                                            <a data-bs-toggle="modal" data-bs-target="#labmodal<?= $i ?>">
                                                                <i class="fa fa-eye" aria-hidden="true"></i> Lab Details
                                                            </a>
                                                            <a href="<?= base_url("userAll?dID=$id"); ?>"
                                                                onclick="return confirm('Are you sure ?')"><i
                                                                    class="fa fa-trash dlt"></i> Delete </a>
                                                        </div>
                                                    </div>
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
<!-- Modal -->
<div class="modal fade" id="appointmodal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $i ?>"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel<?= $i ?>">
                    All Details of <?= $item['patient_name'] ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <button type="button" class="btn btn-primary btn-sm ms-3" id="copyBtn<?= $i ?>">Copy All Info</button>
            </div>
            <div class="modal-body" id="modalBody<?= $i ?>">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Test</th>
                            <th>Appointment Date</th>
                            <th>Time Slot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $item['patient_phone'] ?></td>
                            <td><?= $item['patient_email'] ?></td>
                            <td><?= $item['patient_address'] ?></td>
                            <td><?= $item['test_type'] ?></td>
                            <td><?= $item['appointment_date'] ?></td>
                            <td><?= $item['appointment_time'] ?></td>

                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- ----lab modal---; -->
<div class="modal fade" id="labmodal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $i ?>"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel<?= $i ?>">
                    Lab Details of <?= $item['booked_lab'] ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <button type="button" class="btn btn-primary btn-sm ms-3" id="copyBtn<?= $i ?>">Copy All Info</button>
            </div>
            <div class="modal-body" id="modalBody<?= $i ?>">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Address</th>
                            <th>Bank Name 1</th>
                            <th>IFSC Code 1</th>
                            <th>UPI ID 1</th>
                            <th>Bank Name 2</th>
                            <th>IFSC Code 2</th>
                            <th>UPI ID 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getReg = $this->CommonModal->getSingleRowById('register', "register_id = '{$item['lab_id']}'");
                        ?>
                        <tr>
                            <td><?= $getReg['lab_email'] ?></td>
                            <td><?= $getReg['lab_contact'] ?></td>
                            <td><?= $getReg['lab_location'] ?></td>
                            <td><?= $getReg['bank_name'] ?></td>
                            <td><?= $getReg['ifsc_code'] ?></td>
                            <td><?= $getReg['upi_id'] ?></td>
                            <td><?= $getReg['bank_name2'] ?></td>
                            <td><?= $getReg['ifsc_code2'] ?></td>
                            <td><?= $getReg['upi_id2'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>



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