<?php $this->load->view('admin/template/header', $title); ?>

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8">
                    <!-- <h4>Users</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?= base_url('activeUser') ?>">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted fw-medium">Active User</p>
                                                <h4 class="mb-0"><?= $active_user ?></h4>
                                            </div>

                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                <span class="avatar-title">
                                                    <i class="bx bx-copy-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('inactiveUser') ?>">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted fw-medium">Inactive User</p>
                                                <h4 class="mb-0"><?= $inactive_user ?></h4>
                                            </div>

                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                                <span class="avatar-title">
                                                    <i class="bx bx-copy-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> -->

                    <div class="row">
                        <!-- <h4>Products</h4> -->
                        <div class="col-md-4">
                            <a href="<?= base_url('categoryAll') ?>">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted fw-medium">Total Brands</p>
                                                <h4 class="mb-0"><?= $product_category ?></h4>
                                            </div>

                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-archive-in font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="<?= base_url('subCategoryAll') ?>">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted fw-medium">Total Loboratory</p>
                                                <h4 class="mb-0"><?= $product_sub_category ?></h4>
                                            </div>

                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- <div class="col-md-4">
                            <a href="<?= base_url('productAll') ?>">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="text-muted fw-medium">Total Sub Product</p>
                                                <h4 class="mb-0"><?= $total_product ?></h4>
                                            </div>
                                            <div class="avatar-sm rounded-circle bg-primary align-self-center mini-stat-icon">
                                                <span class="avatar-title rounded-circle bg-primary">
                                                    <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
           

        </div>
    </div>



</div>
<?php $this->load->view('admin/template/footer'); ?>

<!-- <span class="badge badge-pill badge-soft-success font-size-11">Paid</span> -->
<script>
$('.accept').click(function() {
let id = $(this).attr('id');
let order_id = $(this).attr('datafld');
$('.booking_id').val(id);
$('.acceptHead').text(order_id);
$('.acceptModal').modal('show');
});

$('.cancel').click(function() {
let id = $(this).attr('id');
let order_id = $(this).attr('datafld');
$('.booking_id').val(id);
$('.acceptHead').text(order_id);
$('.cancelModal').modal('show');
});
</script>