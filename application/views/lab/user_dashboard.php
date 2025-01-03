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
                <h4>Hello! <?= $lab_name ?></h4>
                <!-- <div class="col-md-8">
                    <div class="card mini-stats-wid" style="border: 1px solid #000000bf; border-radius: 12px;">
                        <div class="card-body" style="padding: 10px 22px !important;">
                            <div class="media">
                                <div class="media-body">
                                    <h4 class="mb-3 mt-3" style="font-size: 35px;color: #516ae4;"><?= $number ?></h4>
                                    <p class="text-muted fw-medium mb-0">Today's ! Appointments</p>
                                </div>
                                <div class="mini-stat-icon  align-self-center">
                                    <span class="avatar-title">
                                        <img src="<?= base_url() ?>assets/user/images/image.png" alt="" width="120">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
<div class="main-content">
    <div class="">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <h4>Today's All Appointments</h4>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th style="width: 8%">S.n.</th>
                                                <th style="width: 15%">Appointment Date</th>
                                                <th style="width: 15%">Appointment Time</th>
                                                <th style="width: 20%">Patient Name</th>
                                                <th style="width: 12%">Test </th>
                                                <th style="width: 12%">Booked Slot</th>
                                                <th style="width: 12%">Status </th>
                                                <th style="width: 10%">More</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($appointment) {
                                                $i = 0;
                                                foreach ($appointment as $all) {
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
                                                            <?= $all['appointment_time'] ?>
                                                        </td>
                                                        <td>
                                                            <?= $all['name'] ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if (!empty($productName) && isset($productName[$i - 1]) && is_array($productName[$i - 1])) {
                                                                echo htmlspecialchars($productName[$i - 1]['service_name'], ENT_QUOTES, 'UTF-8');
                                                            } else {
                                                                echo "Service not found";
                                                            }
                                                            ?>
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
                                                                    <a data-bs-toggle="modal"
                                                                        data-bs-target="#appointmodal<?= $i ?>">
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
    </div>

</div>
<?php $this->load->view('lab/template/footer'); ?>

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