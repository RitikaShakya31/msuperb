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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 mb-3">
                                        <div class="row">
                                            <label class="col-sm-2 control-label">Brand Name</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="category_id">
                                                    <option>Select Brand</option>
                                                    <?php
                                                    $c = getRowsByMoreIdWithOrder('category', "is_delete = '1'", "category_name", 'ASC');
                                                    foreach ($c as $cate) {
                                                        ?>
                                                        <option value="<?= $cate['category_id'] ?>" <?php if ($category_id == $cate['category_id']) {
                                                              echo 'selected';
                                                          } ?>><?= ucwords($cate['category_name']) ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-2 col-form-label">Laboratory
                                                Name</label>
                                            <div class="col-md-10">
                                                <input class="form-control" type="text" name="sub_category_name"
                                                    required value="<?= $sub_category_name ?>">
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
                                                <input class="form-control" type="hidden" name="service_type[]"
                                                    value="<?= $services['service_type'] ?>">
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
                                            <input class="form-control" type="hidden" name="service_type[]"
                                                value="<?= $services['service_type'] ?>">
                                            <div class="col-lg-2 mb-3">
                                                <div class="row">
                                                    <input class="form-control" type="hidden" name="varid[]" value="">
                                                    <a href="javascript:void(0);" class="add_button"
                                                        title="Add field">Add More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="col-lg-12 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Sub Category Image</label>
                                            <div class="col-md-9">
                                                <input class="form-control category_image" type="file" name="sub_category_image" <?= $sub_category_image == "" ? 'required' : '' ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <img class="temp_image" src="<?= base_url('upload/category') . '/' . $sub_category_image ?>" style=" height: 300px;">
                                        <input type="hidden" value="<?= $sub_category_image ?>" name="temp_image">
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <span id="uploadImageError"></span>
                                    </div> -->
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-md">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
              <input class="form-control" type="hidden" name="service_type[]"
                                                value="">
            
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
<script>
    $(document).ready(function () {
        <?php
        if ($id == '') {
            ?>
            $('.temp_image').hide();
            $('#save').attr('disabled', true);
            <?php
        } else {
            ?>
            $('.temp_image').show();
            $('#save').attr('disabled', false);
            <?php
        }

        ?>
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.temp_image').attr('src', e.target.result);
                // $('.user_image').show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function sendFile(file) {
        var ext = file.name.split('.').pop().toLowerCase();
        if ($.inArray(ext, ['jpg', 'jpeg', 'png']) == -1) {
            $('#uploadImageError').show().html('<div class="alert alert-danger" role="alert"> <strong>Error!</strong> Only JPG, JPEG and PNG extension allowed.</div>');
            $('.temp_image').hide();
            $('#save').attr('disabled', true);
        } else {
            $('.temp_image').show();
            $('#save').removeAttr('disabled');
        }
    }

    $(".category_image").change(function () {
        $('#uploadImageError').hide();
        readURL(this);
        sendFile(this.files[0]);
    });
</script>