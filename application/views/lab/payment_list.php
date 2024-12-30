<?php $this->load->view('lab/template/header', $title); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
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
                                        <th>Payment Status</th>
                                        <th>More Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($paymentData) {
                                        $i = 0;
                                        foreach ($paymentData as $item) {
                                            $i = $i + 1;
                                            $id = encryptId($item['id']);
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td>
                                                    <?= $item['appointment_date'] ?>
                                                </td>
                                                <td>
                                                    <p style="line-height:25px;">
                                                        <?= ucwords($item['patient_name']) ?>
                                                    </p>
                                                </td>
                                                <td><?= $item['test_type'] ?> </td>
                                                <td>
                                                    <?php
                                                    if ($item['lab_payment_status'] == '1') {
                                                        echo '<span class="badge badge-pill badge-soft-success font-size-14 mb-2">Success</span><br>';
                                                    } else {
                                                        echo '<span class="badge badge-pill badge-soft-warning font-size-14">Pending</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-success" data-bs-toggle="modal"
                                                        data-bs-target="#appointmodal<?= $i ?>">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> View
                                                    </button>
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