<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>User Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url() ?>assets/admin/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <link href="<?= base_url() ?>assets/admin/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/admin/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden"  style="border-radius: 8px; border: 1px solid #00000036;">
                        <div style="background-color: #fff; border-bottom: 1px solid #00000036;">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <div class="p-4">
                                        <h5 class="text-center" style=" color: #556ee6;font-size: 20px;">Please Login To Continue !</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0 mt-3">
                            <?php
                            if ($this->session->has_userdata('msg')) {
                                echo $this->session->userdata('msg');
                                $this->session->unset_userdata('msg');
                            }
                            ?>
                            <div class="p-2">
                                <form class="form-horizontal" action="" method="post">
                                    <div class="mb-3">
                                        <label class="form-label">Email Id</label>
                                        <input type="text" class="form-control input-mask" id="input-repeat"
                                            placeholder="Enter Email ID" required name="lab_email"
                                            value="<?= set_value('lab_email') ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" class="form-control" placeholder="Enter password"
                                                required aria-label="Password" name="password"
                                                value="<?= set_value('password') ?>" aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i
                                                    class="mdi mdi-eye-outline"></i></button>
                                        </div>
                                    </div>
                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Log
                                            In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url() ?>assets/admin/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/app.js"></script>
    <script src="<?= base_url() ?>assets/admin/libs/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/pages/form-mask.init.js"></script>
</body>

</html>