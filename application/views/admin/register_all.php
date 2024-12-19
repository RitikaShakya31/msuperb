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
        right: -68px;
        /* Adjust for alignment */
        top: 20px;
        /* Adjust for vertical spacing */
        background-color: #f9f9f9;
        min-width: 90px;
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
                        <a href="<?= base_url("registerAdd"); ?>" class="btn btn-success"><i class="fa fa-plus"></i>
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
                                        <th>Create date</th>
                                        <th>Lab Name</th>
                                        <th>Lab Email</th>
                                        <th>Lab Location</th>
                                        <th>Accept/Reject</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($all_register) {
                                        $i = 0;
                                        foreach ($all_register as $item) {
                                            $i = $i + 1;
                                            $id = encryptId($item['register_id']);
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <!-- <td>
                                                    <a href="<?php echo base_url(); ?>registerAdd?id=<?= $id; ?>"
                                                        class="mt-1 btn btn-success"><i class="fa fa-edit"></i></a><br>
                                                    <a href="<?= base_url("registerAll?dID=$id"); ?>"
                                                        onclick="return confirm('Are you sure ?')"
                                                        class="mt-1 btn btn-danger"><i class="fa fa-trash"></i></a>
                                                </td> -->
                                                <td><?= $item['create_date'] ?> </td>
                                                <td>
                                                    <p style="line-height:25px;"> <?= ucwords($item['lab_name']) ?></p>
                                                </td>
                                                <td><?= $item['lab_email'] ?> </td>
                                                <td><?= $item['lab_location'] ?></td>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($item['status'] == 'new') { ?>
                                                        <a class="btn btn-success"
                                                            onclick="return confirm('Are You sure to Accept?')"
                                                            href="<?= base_url("statusUpdate/$id/1") ?>">
                                                            Accepted
                                                        </a>
                                                        <a class="btn btn-danger"
                                                            onclick="return confirm('Are You sure to Reject?')"
                                                            href="<?= base_url("statusUpdate/$id/2") ?>">
                                                            Rejected
                                                        </a>
                                                    <?php } elseif ($item['status'] == 'accepted') { ?>
                                                        <a class="btn btn-success"
                                                            onclick="return confirm('Are You sure to Reject ?')"
                                                            href="<?= base_url("statusUpdate/$id/2") ?>">
                                                            Accepted
                                                        </a> <br> <span class="badge badge-pill badge-soft-success font-size-14 mt-2"
                                                            style="cursor: pointer;" data-bs-toggle="modal"
                                                            data-bs-target="#modal<?= $i ?>">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>  Credential </span>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modal<?= $i ?>" tabindex="-1" role="dialog"
                                                            aria-labelledby="modalLabel<?= $i ?>" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalLabel<?= $i ?>">Credentials
                                                                            of <?= $item['lab_name'] ?></h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        <button type="button" class="btn btn-primary btn-sm ms-3"
                                                                            id="copyBtn<?= $i ?>">Copy All Info</button>
                                                                    </div>
                                                                    <div class="modal-body" id="modalBody<?= $i ?>">
                                                                        <p><strong>Pathology Lab Panel URL:</strong> <a
                                                                                href="<?= base_url('user-login') ?>"
                                                                                target="_blank"> <?= base_url('user-login') ?></a>
                                                                        </p>
                                                                        <p><strong>Email:</strong> <?= $item['lab_email'] ?>
                                                                        </p>
                                                                        <p><strong>Password:</strong> <?= $item['password'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } elseif ($item['status'] == 'rejected') { ?>
                                                        <a class="btn btn-danger"
                                                            onclick="return confirm('Are You sure to Accept?')"
                                                            href="<?= base_url("statusUpdate/$id/1") ?>">
                                                            Rejected
                                                        </a>
                                                    <?php } else {
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <span class="dots-menu" title="More Options">⋮</span>
                                                        <div class="dropdown-content">
                                                            <a href="<?php echo base_url(); ?>registerView?id=<?= $item['register_id'] ?>"><i class="fa fa-eye" aria-hidden="true"></i> Details</a>
                                                            <a href="<?php echo base_url(); ?>registerAdd?id=<?= $id; ?>"><i class="fa fa-edit"></i> Edit </a>
                                                            <a href="<?= base_url("registerAll?dID=$id"); ?>"
                                                                onclick="return confirm('Are you sure ?')"><i class="fa fa-trash dlt"></i> Delete </a>
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