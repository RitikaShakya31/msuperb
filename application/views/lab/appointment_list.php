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
                                        <th style="width: 15%">Appointment Date</th>
                                        <th style="width: 20%">Patient Name</th>
                                        <th style="width: 12%">Test </th>
                                        <th style="width: 12%">Booked Slot</th>
                                        <th style="width: 12%">Status </th>
                                        <th style="width: 10%">More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($all_appointments) {
                                        $i = 0;
                                        foreach ($all_appointments as $all) {
                                            $id = encryptId($all['id']);
                                            ?>
                                            <tr>
                                                <td>
                                                    <?= ++$i; ?>
                                                </td>
                                                <td>
                                                    <?= $all['appointment_date'] ?>
                                                </td>
                                                <td>
                                                    <?= $all['patient_name'] ?>
                                                </td>
                                                <!-- <td>
                                                    <table class="table table-borderless">
                                                        <tr>
                                                            <td><strong>Name :</strong> <?= $all['patient_name'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <strong>Contact Number : </strong> <?= $all['patient_phone'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> <strong>Email : </strong> <?= $all['patient_email'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <strong>Gender : </strong> <?= $all['patient_gender'] ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td> <strong>Age : </strong> <?= $all['patient_age'] ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                -->
                                                <td>
                                                    <?= $all['test_type'] ?>
                                                </td>
                                                <td>
                                                    <?= $all['appointment_time'] ?>
                                                </td>
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
                                                    <div class="dropdown">
                                                        <span class="dots-menu" title="More Options">⋮</span>
                                                        <div class="dropdown-content">
                                                            <a data-bs-toggle="modal" data-bs-target="#appointmodal<?= $i ?>">
                                                                <i class="fa fa-eye" aria-hidden="true"></i> Details
                                                            </a>
                                                            <a href="<?= base_url("appointment-list?dID=$id"); ?>"
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
                            <td><?= $all['patient_phone'] ?></td>
                            <td><?= $all['patient_email'] ?></td>
                            <td><?= $all['patient_address'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>