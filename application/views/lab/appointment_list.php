<?php $this->load->view('lab/template/header', $title); ?>
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
        min-width: 130px;
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
                            <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 8%">S.n.</th>
                                        <th style="width: 10%">Service Type</th>
                                        <th style="width: 10%">Appointment Date</th>
                                        <th style="width: 10%">Appointment Time</th>
                                        <th style="width: 10%">Patient Name</th>
                                        <th style="width: 12%">Test </th>
                                        <th style="width: 10%">Booked Slot</th>
                                        <th style="width: 12%">Status </th>
                                        <th style="width: 10%">More</th>
                                        <th style="width: 10%">Report</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($appointment) {
                                        $i = 0;
                                        foreach ($appointment as $all) {
                                            $id = encryptId($all['product_book_id']);
                                            $orderId = $all['order_id'];
                                            $getPro = $this->CommonModel->getSingleRowById('book_item', ['order_id' => $orderId]);
                                            ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= $all['service_type'] ?></td>
                                                <td><?= $all['appointment_date'] ?></td>
                                                <td><?= $all['appointment_time'] ?></td>
                                                <td><?= $all['name'] ?></td>
                                                <td>
                                                    <?= $getPro['product_name'] ?>
                                                    <!-- <?php
                                                    if (!empty($productName) && isset($productName[$i - 1]) && is_array($productName[$i - 1])) {
                                                        echo htmlspecialchars($productName[$i - 1]['service_name'], ENT_QUOTES, 'UTF-8');
                                                    } else {
                                                        echo "Service not found";
                                                    }
                                                    ?> -->
                                                </td>
                                                <td><?= $all['appointment_time'] ?></td>
                                                <td>
                                                    <form action="<?= base_url("visitStatus/$id") ?>" method="POST"
                                                        onsubmit="return confirm('Are you sure to update?')">
                                                        <select class="form-control" name="visit_status"
                                                            onchange="this.form.submit()">
                                                            <option value="2" <?= $all['visit_status'] == '2' ? 'selected' : '' ?>>
                                                                Visit Pending</option>
                                                            <option value="1" <?= $all['visit_status'] == '1' ? 'selected' : '' ?>>
                                                                Visit Done</option>
                                                            <option value="0" <?= $all['visit_status'] == '0' ? 'selected' : '' ?>>
                                                                Visit Cancel</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td>
                                                    <button class="btn btn-info" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#patientDetailsModal<?= $i ?>">
                                                        View
                                                    </button>
                                                    <div class="modal fade" id="patientDetailsModal<?= $i ?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="patientDetailsModalLabel<?= $i ?>"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="patientDetailsModalLabel<?= $i ?>">Patient Details
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Patient Gender</th>
                                                                                <th>Patient Age</th>
                                                                                <th>Contact Number</th>
                                                                                <th>Email</th>
                                                                                <th>Address</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><?= $all['patient_gender']; ?></td>
                                                                                <td><?= $all['patient_age']; ?></td>
                                                                                <td><?= $all['contact_no']; ?></td>
                                                                                <td><?= $all['email']; ?></td>
                                                                                <td><?= $all['address']; ?></td>

                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="dropdown">
                                                        <span class="dots-menu" title="More Options">⋮</span>
                                                        <div class="dropdown-content">
                                                            <a data-bs-toggle="modal" data-bs-target="#appointmodal<?= $i ?>">
                                                                <i class="fa fa-eye" aria-hidden="true"></i> Details
                                                            </a>
                                                            <a href="<?= base_url("appointment-list?dID=$id"); ?>"
                                                                onclick="return confirm('Are you sure ?')"><i
                                                                    class="fa fa-trash dlt"></i> Delete </a>
                                                        </div>
                                                    </div> -->
                                                </td>
                                                <td>
                                                    <?php if (!empty($all['report_file'])) { ?>
                                                        <a href="<?= base_url("upload/report/" . $all['report_file']) ?>"
                                                            target="_blank" class="btn btn-info mt-2">View</a>
                                                    <?php } else { ?>
                                                        <form action="<?= base_url("uploadReport/$id") ?>" method="POST"
                                                            enctype="multipart/form-data">
                                                            <input type="file" name="report_file" accept=".pdf, .png, .webp, .jpg, .jpeg" required>
                                                            <button type="submit" class="btn btn-primary">Upload</button>
                                                        </form>
                                                    <?php } ?>
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
                    Details of <?= $all['patient_name'] ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <button type="button" class="btn btn-primary btn-sm ms-3" id="copyBtn<?= $i ?>">Copy All Info</button>
            </div>
            <div class="modal-body" id="modalBody<?= $i ?>">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Patient Age</th>
                            <th>Patient Gender</th>
                            <th>Contact Number</th>
                            <th>Email</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $all['patient_age'] ?></td>
                            <td><?= $all['patient_gender'] ?></td>
                            <td><?= $all['contact_no'] ?></td>
                            <td><?= $all['email'] ?></td>
                            <td><?= $all['address'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>