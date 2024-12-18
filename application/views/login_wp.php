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
                        <form class="user-form" method="post" action="" id="formdata">
                            <div class="form-group">
                                <input type="text" name="uname" id="loginnumber" placeholder="Enter WhatsApp No. *" maxlength="10" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required="">
                                <span id="otploginmsg"></span>
                            </div>
                            <div class="form-group col-sm-12 otp" style="display: none;">
                                <label>Enter OTP</label>
                                <input type="text" name="otp" class="form-control" id="verificationCode" placeholder="Enter verification code">

                            </div>

                            <div class="form-group col-sm-12">
                                <div id="recaptcha-container" class="hideit"></div>
                                <span id="g-recaptcha-error" class="badge bg-danger"></span>
                            </div>
                            <div class="form-grp col-sm-12 text-center m-0">
                                <button type="button" onclick="codeverify();" class="btn btn-primary   otp" style="display: none;">Verify code</button>

                                <button type="button" class="btn btn-primary  hideit" id="savebtn" style="background:#ff0167" onclick="phoneAuth();">Send OTP</button>

                                <br>
                                <p class="mt-3">
                                    <!-- Don't have any account?<a href="<?= base_url('register') ?>">&nbsp;Register here</a> -->
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
    window.onload = function() {
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
                    success: function(response) {
                        console.log(number);
                        console.log(response);
                        if (response == 1) {
                            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult) {
                                window.confirmationResult = confirmationResult;
                                coderesult = confirmationResult;
                                alert("Enter OTP sent to your mobile");
                                $('.otp').show();
                                $('#number').attr('readonly', true);
                                $('.hideit').hide();
                                $('#otploginmsg').text('');
                                $('#g-recaptcha-error').text('');
                                $('#savebtn').html('Resend OTP');
                            }).catch(function(error) {
                                alert(error.message);
                            });
                        } else {
                            $('#otploginmsg').text('Please register with us to continue');
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
        coderesult.confirm(code).then(function(result) {
            $.ajax({
                method: "POST",
                url: "<?= base_url('UserHome/check_otp') ?>",
                data: $('#formdata').serialize(),
                success: function(response) {
                    console.log(response);
                    if (response == '1') {
                        window.location.href = base_url;
                    } else if (response == '3') {
                        window.location.href = base_url + 'checkout';
                    } else {
                        window.location.href = base_url;
                    }
                }
            });
            $(this).val('Verify OTP');
            $(this).prop('disabled', false);
            alert("Verified successfully");
            var user = result.user;


        }).catch(function(error) {
            alert(error.message);
        });
    }
</script>
</body>

</html>