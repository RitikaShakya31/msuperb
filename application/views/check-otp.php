<?php $this->load->view('includes/header'); ?>
<section class="user-form-part">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-6 col-md-12 col-lg-12 col-xl-6">
                <div class="user-form-card">
                    <div class="user-form-title">
                        <h2>Verify Account!</h2>
                        <!-- <p>Setup A New Account In A Minute</p> -->
                        <?php if ($this->session->userdata('reg_msg') != '') { ?>
                            <?= $this->session->userdata('reg_msg'); ?>
                        <?php  }
                        $this->session->unset_userdata('reg_msg'); ?>
                    </div>
                    <div class="user-form-group">


                        <form class="user-form" method="post">
                         
                            <!-- <input type="hidden" id="contactno" value="<?= sessionId('user_contact') ?>"> -->
                            <div class="form-group" id="otpbox">
                                <input type="text" class="form-control myinput" name="otp" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Enter OTP" id="otp" autocomplete="off">
                            </div>

                            <div class="form-button">
                                <div class="d-flex justify-content-center">
                                    <a href="javascript: void(0);" id="registerotpverify" class="btn btn-success w-50"> <span>Verify</span> </a>
                                    <!-- <button type="button" class="w-50" id="otpbtn">Request OTP</button> -->
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