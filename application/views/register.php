<?php $this->load->view('includes/header'); ?>
<section class="user-form-part">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
                <div class="user-form-card">
                    <div class="user-form-title">
                        <h2>Join Now!</h2>
                        <p>Setup Your New Account In A Minute</p>
                        <?php if ($this->session->userdata('msg') != '') { ?>
                            <?= $this->session->userdata('msg'); ?>
                        <?php }
                        $this->session->unset_userdata('msg'); ?>
                    </div>
                    <div class="user-form-group">
                        <div class="user-form-social text-center dm-none">
                            <img src="<?= base_url() ?>assets/img/register-img.png" alt="Image" width="500px">
                        </div>
                        <div class="user-form-divider">
                            <!-- <p>or</p> -->
                        </div>
                        <form class="user-form" method="post" id="formdata">
                            <span id="otploginmsg"></span>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Enter name" required />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email_id" placeholder="Enter email"
                                    required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="contact_no" id="loginnumber"
                                    placeholder="Enter Whatsapp Number" maxlength="10"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" placeholder="Address*" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="area" placeholder="Area*" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="postal_code" placeholder="Pincode*"
                                    value="" maxlength="6" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="state" required id="state">
                                    <option value="">Select state </option>
                                    <?php
                                    if ($state_list) {
                                        foreach ($state_list as $state) {
                                            ?>
                                            <option value="<?= $state['state_name'] ?>"
                                                <?= (($state['state_name'] == @$login[0]['state']) ? 'Selected' : '') ?>>
                                                <?= $state['state_name'] ?>
                                            </option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="city" class="form-control" id="city" required>
                                    <option value="">Select city</option>
                                </select>
                            </div>
                            <!-- <div class="form-group col-sm-12">
                                <div id="recaptcha-container" class="hideit"></div>
                                <span id="g-recaptcha-error" class="badge bg-danger"></span>
                            </div> -->
                            <div class="form-group col-sm-12 otp" style="display: none;">
                                <label>Enter OTP</label>
                                <input type="text" name="otp" class="form-control" id="verificationCode"
                                    placeholder="Enter verification code">

                            </div>
                            <div class="form-button">
                                <button type="button" onclick="codeverify();" class=" bg-warning mb-2   otp"
                                    style="display: none;">Verify code</button>
                                <button type="button" id="savebtn" onclick="phoneAuth();">register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="user-form-remind">
                    <p>Already Have An Account?<a href="<?= base_url('login') ?>">login here</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-auth.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyBksJ1JYXXiDt9wMoCQNaFnkSxsUo6GlIc",
        authDomain: "svgh-40c54.firebaseapp.com",
        projectId: "svgh-40c54",
        storageBucket: "svgh-40c54.appspot.com",
        messagingSenderId: "317605174535",
        appId: "1:317605174535:web:cd483f032f3fb5076ab9a2",
        measurementId: "G-558ESZPZ94"
    };
    firebase.initializeApp(firebaseConfig);
    firebase.analytics();
</script>

<script>
    window.onload = function () {
        render();
    };

    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }
    function phoneAuth() {
        var number = '+91' + document.getElementById('loginnumber').value;
        var ch_number = document.getElementById('loginnumber').value;
        $(this).prop('disabled', true);

        $('#savebtn').html('Loading...');

        if (ch_number === '') {
            $('#otploginmsg').text('Contact no required');
            $('#savebtn').html('Save');
            $(this).prop('disabled', false);
            return false;
        } else {
            if (ch_number.length != 10) {
                $('#otploginmsg').text('Contact no. should be of 10 digit');
                $('#savebtn').html('Save');
                $(this).prop('disabled', false);
                return false;
            } else {
                $('#otploginmsg').text('');
            }
            var response = grecaptcha.getResponse();
            if (response.length == 0 || response == '') {
                document.getElementById('g-recaptcha-error').innerHTML = 'This field is required. ';
            } else {
                $.ajax({
                    method: "POST",
                    url: "<?= base_url('UserHome/check_login') ?>",
                    data: {
                        contact: ch_number
                    },
                    success: function (response) {
                        console.log(number);
                        console.log(response);
                        if (response == 1) {
                            $('#otploginmsg').html('<div class="alert alert-danger p-3 m-2">You have already register with us.</div>');
                            window.scrollTo(0, 0);
                        } else {
                            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                                window.confirmationResult = confirmationResult;
                                coderesult = confirmationResult;
                                console.log(coderesult);
                                alert("Enter OTP sent to your mobile");
                                $('.otp').show();
                                $('#number').attr('readonly', true);
                                $('.hideit').hide();
                                $('#otploginmsg').text('');
                                $('#g-recaptcha-error').text('');
                                $('#savebtn').html('Resend');
                            }).catch(function (error) {
                                alert(error.message);
                            });
                        }
                    }
                });
            }
        }
    }
    function codeverify() {
        $(this).prop('disabled', true);
        var base_url = $('#base').val();
        $(this).val('loading ...');
        var code = document.getElementById('verificationCode').value;
        var ch_number = document.getElementById('loginnumber').value;
        coderesult.confirm(code).then(function (result) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('UserHome/registerFirebaseOtpVerify') ?>",
                data: $('#formdata').serialize(),
                success: function (response) {
                    console.log(response)
                    var json = $.parseJSON(response);
                    $('#otpmessage').html('<span class="text-danger">' + json.reg_msg + '</span><br/>');
                    if (json.status == 1) {
                        window.location.href = base_url;
                    }
                    else if (json.status == 3) {
                        window.location.href = base_url + 'checkout';
                    }
                    else {
                        window.location.href = base_url;
                    }
                }
            });
            $(this).val('Verify OTP');
            $(this).prop('disabled', false);
            alert("Verified successfully");
            var user = result.user;


        }).catch(function (error) {
            alert(error.message);
        });
    }
</script>
</body>

</html>