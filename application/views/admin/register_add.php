<?php $this->load->view('admin/template/header', $title); ?>
<?php $id = $this->input->get('id'); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 "><?= $title ?></h2>
                    </div>
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Brand
                                                Name</label>
                                            <div class="col-md-10">
                                                <select class="form-control" name="brand_name">
                                                    <option value="" disabled>Select Brand</option>
                                                    <?php if ($brand) {
                                                        foreach ($brand as $data) {
                                                            ?>
                                                            <option value="<?= $data['brand_name'] ?>">
                                                                <?= $data['brand_name'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Lab
                                                Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="lab_name" required
                                                    value="<?= $lab_name ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Lab
                                                Email</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="email" name="lab_email" required
                                                    value="<?= $lab_email ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Lab
                                                Location</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="lab_location" required
                                                    value="<?= $lab_location ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">
                                                Contact Number</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="number" name="lab_contact"
                                                    maxlength="10" required value="<?= $lab_contact ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Bank
                                                Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="bank_name" required
                                                    value="<?= $bank_name ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">IFSC
                                                code</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="ifsc_code" required
                                                    value="<?= $ifsc_code ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">
                                                UPI Id </label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="upi_id" required
                                                    value="<?= $upi_id ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if ($variant) {
                                        foreach ($variant as $provar) {
                                            ?>
                                            <div class="row field_wrapper_item">
                                                <div class="col-lg-6 mb-3">
                                                    <div class="row">
                                                        <label for="service-dropdown" class="col-md-3 col-form-label">Test
                                                            Name</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="service[]">
                                                                <option value="">Select Test</option>
                                                                <?php if ($services) {
                                                                    foreach ($services as $service) {
                                                                        $selected = ($service['service_id'] == $provar['service']) ? 'selected' : '';
                                                                        ?>
                                                                        <option value="<?= $service['service_id'] ?>" <?= $selected ?>>
                                                                            <?= $service['service_name'] ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 mb-3">
                                                    <div class="row">
                                                        <label for="charge-input" class="col-md-4 col-form-label">Charge</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="charge[]"
                                                                value="<?= $provar['charge'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 mb-3">
                                                    <div class="row">
                                                        <input class="form-control" type="hidden" name="varid[]"
                                                            value="<?= $provar['id'] ?>">
                                                        <a href="<?= base_url('deletevariant/') . $provar['id'] ?>"
                                                            class="delete_button" data-id="<?= $provar['id'] ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <div class="row field_wrapper">
                                        <div class="row field_wrapper_item">
                                            <div class="col-lg-6 mb-3">
                                                <div class="row">
                                                    <label for="service-dropdown" class="col-md-3 col-form-label">Test
                                                        Name</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="service[]">
                                                            <option value="">Select Test</option>
                                                            <?php if ($services) {
                                                                foreach ($services as $service) { ?>
                                                                    <option value="<?= $service['service_id'] ?>">
                                                                        <?= $service['service_name'] ?>
                                                                    </option>
                                                                <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 mb-3">
                                                <div class="row">
                                                    <label for="charge-input"
                                                        class="col-md-4 col-form-label">Charge</label>
                                                    <div class="col-md-8">
                                                        <input class="form-control" type="text" name="charge[]"
                                                            value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mb-3">
                                                <div class="row">
                                                    <input class="form-control" type="hidden" name="varid[]" value="">
                                                    <a href="javascript:void(0);" class="add_button"
                                                        title="Add field">Add More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="save" class="btn btn-primary w-md">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('admin/template/footer'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var maxField = 10;
        var addButton = $('.add_button');
        var wrapper = $('.field_wrapper');
        var fieldHTML = `
        <div class="row field_wrapper_item">
            <div class="col-lg-6 mb-3">
                <div class="row">
                    <label for="service-dropdown" class="col-md-3 col-form-label">Test Name</label>
                    <div class="col-md-9">
                        <select class="form-control" name="service[]">
                            <option value="">Select Test</option>
                            <?php if ($services) {
                                foreach ($services as $service) { ?>
                                                            <option value="<?= $service['service_id'] ?>">
                                                                <?= $service['service_name'] ?>
                                                            </option>
                                        <?php }
                            } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 mb-3">
                <div class="row">
                    <label for="charge-input" class="col-md-4 col-form-label">Charge</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="charge[]" value="">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 mb-3">
                <div class="row">
                    <input class="form-control" type="hidden" name="varid[]" value="">
                    <a href="javascript:void(0);" class="remove_button" title="Remove field">Remove</a>
                </div>
            </div>
        </div>`;
        var x = 1;

        $(addButton).click(function () {
            if (x < maxField) {
                x++;
                $(wrapper).append(fieldHTML);
            } else {
                alert('A maximum of ' + maxField + ' fields are allowed to be added.');
            }
        });

        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).closest('.field_wrapper_item').remove();
            x--;
        });
    });
</script>