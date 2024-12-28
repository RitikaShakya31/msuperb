<?php $this->load->view('user/template/header', $title); ?>
<?php $id = $this->input->get('id'); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <!-- <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 "><?= $title ?></h2>
                    </div>
                </div>
            </div> -->
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <h5>Personal Details</h5>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Lab
                                                Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="lab_name" required
                                                    value="<?= $profileData['lab_name'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Email</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="email" name="lab_email" required
                                                    value="<?= $profileData['lab_email'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Contact Number</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="number" name="lab_contact" required
                                                    value="<?= $profileData['lab_contact'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Location</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="lab_location" required
                                                    value="<?= $profileData['lab_location'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <h5>Bank Details</h5>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Bank Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="bank_name" required
                                                    value="<?= $profileData['bank_name'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Bank IFSC Code</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="ifsc_code" required
                                                    value="<?= $profileData['ifsc_code']  ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">UPI ID</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="upi_id" required
                                                    value="<?= $profileData['upi_id'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h5>Another Bank Details (optional)</h5>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Bank Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="bank_name2" 
                                                    value="<?= $profileData['bank_name2'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Bank IFSC Code</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="ifsc_code2" 
                                                    value="<?= $profileData['ifsc_code2']  ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">UPI ID</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="upi_id2" 
                                                    value="<?= $profileData['upi_id2'] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-2">
                        <button type="submit" id="save" class="btn btn-primary w-md">Update </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $this->load->view('admin/template/footer'); ?>