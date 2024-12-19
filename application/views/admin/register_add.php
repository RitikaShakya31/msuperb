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
                                                        <label for="service-dropdown" class="col-md-4 col-form-label">Test
                                                            Name</label>
                                                        <div class="col-md-8">
                                                            <select class="form-control" name="service[]">
                                                                <option value="">Select Service</option>
                                                                <?php if ($services) {
                                                                    foreach ($services as $service) {
                                                                        // Check if the current service is the one selected in $provar
                                                                        $selected = ($service['service_id'] == $provar['service']) ? 'selected' : '';
                                                                        ?>
                                                                        <option value="<?= $service['service_id'] ?>" <?= $selected ?>>
                                                                            <?= $service['service_name'] ?> :
                                                                            <?= $service['service_charge'] ?>
                                                                        </option>
                                                                        <?php
                                                                    }
                                                                } ?>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <input class="form-control" type="hidden"
                                                        value="<?= $service['service_charge'] ?>" id="charge-input"
                                                        name="charge[]">
                                                    <input class="form-control" type="hidden"
                                                        value="<?= $service['service_id'] ?>" id="charge-input"
                                                        name="service_id[]">
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
                                    <div class="col-lg-12 mb-3 field_wrapper">
                                        <div class="row">
                                            <div class="col-lg-6 mb-3">
                                                <div class="row">
                                                    <label for="service-dropdown" class="col-md-4 col-form-label">Test
                                                        Name</label>
                                                    <div class="col-md-8">
                                                        <select class="form-control" id="service-dropdown"
                                                            name="service[]" required>
                                                            <option value="">Select Test</option>
                                                            <?php if ($services) {
                                                                foreach ($services as $service) { ?>
                                                                    <option value="<?= $service['service_id'] ?>">
                                                                        <?= $service['service_name'] ?> :
                                                                        <?= $service['service_charge'] ?>
                                                                    </option>

                                                                <?php }
                                                            } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input class="form-control" type="hidden"
                                                value="<?= $service['service_charge'] ?>" id="charge-input"
                                                name="charge[]">
                                            <div class="col-lg-2 mb-3">
                                                <div class="row">
                                                    <input class="form-control" type="hidden" name="varid[]" value="">
                                                    <a href="javascript:void(0);" class="add_button"
                                                        title="Add field">Add</a>
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
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
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
                                                          <?= $service['service_name'] ?> : <?= $service['service_charge'] ?>
                                                            </option>
                                           <?php }
                        } ?>
                    </select>
                </div>
            </div>
        </div>
          
            <div class="col-lg-2 mb-3">
                <div class="row">
                    <input class="form-control" type="hidden" name="varid[]"  value="">
                    <a href="javascript:void(0);" class="remove_button" title="Remove field">Remove</a>
                </div>
            </div>
        </div>`;
        var x = 1;

        // Once add button is clicked
        $(addButton).click(function () {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increase field counter
                $(wrapper).append(fieldHTML); //Add field html
            } else {
                alert('A maximum of ' + maxField + ' fields are allowed to be added. ');
            }
        });

        // Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).closest('.field_wrapper_item').remove(); // Remove the entire field wrapper item
            x--; // Decrease field counter
        });
    });


</script>