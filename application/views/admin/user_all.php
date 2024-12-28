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
                        <h2 class="mb-sm-0 "><?= $title ?></h2>
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
                                        <th>Patient Contact</th>
                                        <th>Patient Age</th>
                                        <!-- <th>Appointment</th> -->
                                        <!-- <th>Transaction</th> -->
                                        <th>Lab Visit Status</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($all_appointments) {
                                        $i = 0;
                                        foreach ($all_appointments as $item) {
                                            $i = $i + 1;
                                            $id = encryptId($item['id']);
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <!-- <td>
                                                    <a href="<?php echo base_url(); ?>testAdd?id=<?= $id; ?>"
                                                        class="mt-1 btn btn-success"><i class="fa fa-edit"></i></a><br>
                                                    <a href="<?= base_url("testAll?dID=$id"); ?>"
                                                        onclick="return confirm('Are you sure ?')"
                                                        class="mt-1 btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td> -->
                                                <!-- <td>
                                                    <table class="table table-borderless mb-0">
                                                        <tr>
                                                            <td>
                                                                <?= $item['patient_name'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Email: </strong><?= $item['patient_email'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Contact Number: </strong><?= $item['patient_phone'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Address: </strong><?= $item['patient_address'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Gender: </strong><?= $item['patient_gender'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Age: </strong><?= $item['patient_age'] ?>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </td> -->
                                                <td>
                                                    <?= $item['patient_name'] ?>
                                                </td>
                                                <td>
                                                    <?= $item['patient_phone'] ?>
                                                </td>
                                                <td>
                                                    <?= $item['patient_age'] ?>
                                                </td>
                                                <!-- <td> -->
                                                <!-- <a href="" class="btn btn-success">
                                                        <i class="fa fa-eye" aria-hidden="true"></i> Details</a>
                                                    <table class="table table-borderless mb-0">
                                                        <tr>
                                                            <td>
                                                                <strong>Booked Lab :</strong><?= $item['booked_lab'] ?>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Lab Location :</strong> <?= $item['lab_address'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Test :</strong><?= $item['test_type'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Appointment Date
                                                                    :</strong><?= $item['appointment_date'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Time Slot :</strong><?= $item['appointment_time'] ?>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </td> -->
                                                <!-- <td>
                                                <a href="" class="btn btn-success">
                                                <i class="fa fa-eye" aria-hidden="true"></i> Details</a>
                                                    <table class="table table-borderless mb-0">
                                                        <tr>
                                                            <td>
                                                                <strong>Test Amount :</strong><?= $item['test_amount'] ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Total Payment :</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Transaction ID :</strong>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <strong>Transaction Date :</strong>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td> -->
                                                <td>
                                                    <strong>
                                                        <?php
                                                        if ($item['visit_status'] == '1') {
                                                            echo '<span class="badge badge-pill badge-soft-primary font-size-14 mb-2">Visited</span><br>';
                                                        } elseif ($item['visit_status'] == '0') {
                                                            echo '<span class="badge badge-pill badge-soft-danger font-size-14">Cancelled</span>';
                                                        } elseif ($item['visit_status'] == '2') {
                                                            echo '<span class="badge badge-pill badge-soft-warning font-size-14">Pending</span>';
                                                        } else {
                                                            echo '<span class="badge badge-pill badge-soft-secondary font-size-14">Unknown</span>';
                                                        }
                                                        ?>
                                                    </strong>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <span class="dots-menu" title="More Options">⋮</span>
                                                        <div class="dropdown-content">
                                                            <a data-bs-toggle="modal" data-bs-target="#appointmodal<?= $i ?>">
                                                                <i class="fa fa-eye" aria-hidden="true"></i> Appointment
                                                            </a>
                                                            <!-- <a href="<?php echo base_url(); ?>registerAdd?id=<?= $id; ?>"><i
                                                                    class="fa fa-edit"></i> Edit </a> -->
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
                    All Appointments of <?= $item['patient_name'] ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <button type="button" class="btn btn-primary btn-sm ms-3" id="copyBtn<?= $i ?>">Copy All Info</button>
            </div>
            <div class="modal-body" id="modalBody<?= $i ?>">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>Booked Lab</th>
                            <th>Lab Location</th>
                            <th>Test</th>
                            <th>Appointment Date</th>
                            <th>Time Slot</th>
                            <th>Payment Amount</th>
                            <th>Transaction ID</th>
                            <th>Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $item['booked_lab'] ?></td>
                            <td><?= $item['lab_location'] ?></td>
                            <td><?= $item['test_type'] ?></td>
                            <td><?= $item['appointment_date'] ?></td>
                            <td><?= $item['appointment_time'] ?></td>
                            <td><?= $item[''] ?></td>
                            <td><?= $item[''] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>