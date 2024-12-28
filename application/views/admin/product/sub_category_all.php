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
                        <a href="<?= base_url("subCategoryAdd"); ?>" class="btn btn-success"><i class="fa fa-plus"></i>
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
                                        <th>Laboratory Name</th>
                                        <th>Brand Name</th>
                                        <th>Location</th>
                                        <th style="width: 15%">View Test</th>
                                        <th>Accept/Reject</th>
                                        <th>More</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($sub_category) {
                                        $i = 0;
                                        foreach ($sub_category as $item) {
                                            $i = $i + 1;
                                            $id = encryptId($item['sub_category_id']);
                                            $category = getSingleRowById('category', "category_id = '" . $item['category_id'] . "'");
                                            $getRows = getNumRows('product', "sub_category_id = '" . $item['sub_category_id'] . "' AND is_delete = '1'");
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= ucwords($item['sub_category_name']) ?> </td>
                                                <td><?= ucwords($category['category_name']) ?></td>
                                                <td><?= ucwords($item['lab_location']) ?></td>
                                                <td>
                                                    <a href="<?php echo base_url("productAll?sCateId=$id"); ?>"
                                                        class="btn btn-success"><i class="fa fa-eye"></i> View</a>
                                                    <span class="badge bg-yellow"
                                                        style="margin-left: 10px"><?= $getRows; ?></span>
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
                                                        </a> <br> <span
                                                            class="badge badge-pill badge-soft-success font-size-14 mt-2"
                                                            style="cursor: pointer;" data-bs-toggle="modal"
                                                            data-bs-target="#modal<?= $i ?>">
                                                            <i class="fa fa-eye" aria-hidden="true"></i> Credential </span>
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
                                                                                href="<?= base_url('lab-login') ?>"
                                                                                target="_blank"> <?= base_url('lab-login') ?></a>
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
                                                            <!-- <a
                                                                href="<?php echo base_url(); ?>registerView?id=<?= $item['register_id'] ?>"><i
                                                                    class="fa fa-eye" aria-hidden="true"></i> Details</a> -->
                                                            <a
                                                                href="<?php echo base_url(); ?>subCategoryAdd?id=<?php echo $id; ?>"><i
                                                                    class="fa fa-edit"></i> Edit </a>
                                                            <a href="<?= base_url("subCategoryAdd?dID=$id"); ?>"
                                                                onclick="return confirm('Are you sure ?')"><i
                                                                    class="fa fa-trash dlt"></i> Delete </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- <td>
                                                    <a href="<?php echo base_url(); ?>subCategoryAdd?id=<?php echo $id; ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                    <a onclick="return confirm('Are you want to sure ?')" href="<?= base_url("subCategoryAdd?dID=$id"); ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                </td> -->
                                            </tr>
                                            <?php
                                        }
                                    } ?>
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