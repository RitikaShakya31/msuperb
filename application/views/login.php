<?php $this->load->view('includes/header'); ?>
<section class="user-form-part">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
                <div class="user-form-card">
                    <div class="user-form-title">
                        <h2>Welcome Please Continue!</h2>
                        <!-- <p>Use your credentials to access</p> -->
                        <?php if ($this->session->userdata('loginmsg') != '') { ?>
                            <?= $this->session->userdata('loginmsg'); ?>
                        <?php  }
                        $this->session->unset_userdata('loginmsg'); ?>
                    </div>
                    <div class="user-form-group">
                        <div class="user-form-social text-center dm-none">
                            <img src="<?= base_url() ?>assets/img/login-img.png" alt="Image" width="320px">
                        </div>
                        <div class="user-form-divider">
                            <!-- <p>or</p> -->
                        </div>
                        <form class="user-form" method="post" action="">
                            <div class="form-group">
                                <!--<input type="text" name="uname" id="contactno" placeholder="Enter Email Address *" class="form-control"  required="">-->
                                <input type="text" name="uname" id="contactno" placeholder="Enter WhatsApp No. *" maxlength="10" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required="">
                            </div>
                           
                            <div class="form-group" style="display:none" id="otpbox">
                                <input type="text" class="form-control myinput" name="otp" maxlength="4" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Enter OTP" id="otp" autocomplete="off">
                            </div>
                            <div class="form-button">
                                <div class="d-flex justify-content-center">
                                    <a href="javascript: void(0);" id="otpverify" class="btn btn-success w-50" style="display:none;"> <span>Submit</span> </a>
                                    <button type="button" class="w-50" id="otpbtnq">Request OTP</button>
                                </div>
                                <!-- <p>
                                    Forgot password?<a href="<?= base_url('forgot-password') ?>">reset Now</a>
                                </p> -->

                                <div class="resendOtpWrapper">
                                    <p id="resendmsg"></p>
                                    <p id="otpmessage"></p>
                                </div>
                                <hr>
                                <p>
                                    Don't have any account?<a href="<?= base_url('register') ?>">register here</a>
                                </p>

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