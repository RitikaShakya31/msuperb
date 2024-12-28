<?php $this->load->view('admin/template/header', $title); ?>
<?php $id = $this->input->get('id'); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 "><?= $gtitle ?></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="row">
                                            <label for="old-password" class="col-md-3 col-form-label">Old
                                                Password</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="password" name="password"
                                                    id="old-password" required placeholder="Enter your old password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <div class="row">
                                            <label for="new-password" class="col-md-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="password" name="new_password"
                                                    id="new-password" required placeholder="Enter your new password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <div class="row">
                                            <label for="confirm-password" class="col-md-3 col-form-label">Confirm
                                                Password</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="password" name="confirm_password"
                                                    id="confirm-password" required
                                                    placeholder="Confirm your new password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" id="save" class="btn btn-primary w-md">Update</button>
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

<script>
    $(document).ready(function () {
        $('#old-password').on('blur', function () {
            let oldPassword = $(this).val();

            if (oldPassword.trim() !== '') {
                $.ajax({
                    url: '<?= base_url("admin/adminHome/validateOldPassword") ?>',
                    type: 'POST',
                    data: { password: oldPassword },
                    success: function (response) {
                        let res = JSON.parse(response);
                        if (res.status === 'error') {
                            alert(res.message); // Show error message
                            $('#old-password').addClass('is-invalid'); // Add error style
                            $('#save').prop('disabled', true); // Disable the submit button
                        } else {
                            $('#old-password').removeClass('is-invalid'); // Remove error style
                            $('#save').prop('disabled', false); // Enable the submit button
                        }
                    },
                });
            }
        });
    });
</script>