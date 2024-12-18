<?php $this->load->view('includes/header'); ?>


<section class="inner-section single-banner" style="background: url(assets/images/single-banner.jpg) no-repeat center">
    <div class="container">
        <h2>my profile</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </div>
</section>
<section class="inner-section profile-part">
    <div class="container">
        <?php if ($msg = $this->session->flashdata('msg')) :
            $msg_class = $this->session->flashdata('msg_class') ?>
            <div class='row'>
                <div class='col-lg-12' style="margin-bottom: 5px;">
                    <div class='alert  <?= $msg_class; ?>' style="padding:12px"><?= $msg; ?></div>
                </div>
            </div>
        <?php $this->session->unset_userdata('msg');
        endif; ?>
        <div class="row">

            <div class="col-lg-12">
                <div class="orderlist-filter">
                    <h5>Welcome <span><?= $this->profile[0]['name'] ?></span></h5>
                    <div class="filter-short"><label class="form-label"></label>
                        <a href="<?= base_url('orders') ?>" style="color:green">My Orders<i class="icofont-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="account-card">
                        <div class="account-title">
                            <h4>Update Profile</h4>
                            <a href="<?= base_url('logout') ?>" class="logout">
                                Logout
                            </a>

                        </div>
                        <div class="account-content">
                            <form method="post">
                                <div class="row">

                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">name</label><input class="form-control" type="text" name="name" value="<?= $profiledata['name'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Email</label><input class="form-control" name="email_id" type="email" value="<?= $profiledata['email_id'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                        <label class="form-label">Mobile</label><input class="form-control" name="contact_no" type="number" value="<?= $profiledata['contact_no'] ?>" maxlength="10"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);"/>

                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-8">
                                        <div class="form-group">
                                            <label class="form-label">Address</label><input class="form-control" type="text" name="address" value="<?= $profiledata['address'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label">Postal Code</label><input class="form-control" type="text" name="postal_code" value="<?= $profiledata['postal_code'] ?>" />
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="profile-btn">
                                            <button type="submit" class="my-button" style="width: 100%;">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>


<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>


</body>

</html>