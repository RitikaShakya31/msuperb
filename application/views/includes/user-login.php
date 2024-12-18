<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Login/Create Your Account</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center align-items-center">
                    <div class="col-12">
                        <div class="user-form-card">
                            <div class="user-form-title">
                                <h2>Welcome, Please Continue!</h2>
                            </div>
                            <form class="cs-form cs-style1" id="otpRequestForm">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="contact_no" id="phoneField" placeholder="Enter Your Phone Number" required title="Please enter a valid phone number" />
                                    <span id="otpMessage" class="text-danger"></span>
                                </div>
                                <div class="otp-field" style="display: none;">
                                    <div class="form-group">
                                        <label>Enter OTP</label>
                                        <input type="text" name="otp" class="form-control" placeholder="Enter OTP" id="otpField" />
                                        <span id="otperror" class="text-danger"></span>
                                    </div>
                                    <p id="resend-timer" style="display: none;">Please wait 30 seconds to resend the code.</p>
                                    
                                </div>
                                <div class="form-button">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="w-50 m-1" id="resend-btn" style="display: none;">Resend OTP</button>
                                        <button type="button" class="w-50 m-1" id="otpverify">Request OTP</button>
                                        <button style="display:none;" type="button" class="w-50 m-1" id="submitOtp">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const otpMessage = document.getElementById('otpMessage');
    const phoneField = document.getElementById('phoneField');
    const otpFieldContainer = document.querySelector('.otp-field');
    const otpVerifyButton = document.getElementById('otpverify');
    const submitOtpButton = document.getElementById('submitOtp');
    const resendTimer = document.getElementById('resend-timer');
    const resendButton = document.getElementById('resend-btn');
    let countdown;

    otpVerifyButton.addEventListener('click', requestOtp);
    submitOtpButton.addEventListener('click', submitOtp);
    resendButton.addEventListener('click', function () {
        resetCountdown();
        requestOtp();
    });

    function requestOtp() {
        const contact_no = phoneField.value;

        // Reset message and check if phone field is filled
        otpMessage.textContent = "";
        if (!contact_no) {
            otpMessage.textContent = "Please enter a valid phone number.";
            otpMessage.classList.add("text-danger");
            return;
        }

        fetch('<?= base_url("UserHome/requestOtp") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ contact_no })
        })
            .then(response => response.text())
            .then(data => {
                if (data === "success") {
                    otpMessage.textContent = "OTP sent successfully to your Phone Number.";
                    otpMessage.classList.replace("text-danger", "text-success");
                    phoneField.setAttribute('readonly', true);
                    otpFieldContainer.style.display = 'block';
                    otpVerifyButton.style.display = 'none';
                    submitOtpButton.style.display = 'inline-block';
                    startCountdown(30);
                } else {
                    otpMessage.textContent = "Something went wrong. Please try again.";
                    otpMessage.classList.replace("text-success", "text-danger");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                otpMessage.textContent = "Something went wrong. Please try again.";
                otpMessage.classList.replace("text-success", "text-danger");
            });
    }

    function submitOtp() {
        const contact_no = phoneField.value;
        const otp = document.getElementById('otpField').value;
        fetch('<?= base_url("UserHome/verifyOtp") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ contact_no, otp })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("OTP verified successfully!");
                    window.location.href = '<?= base_url("checkout") ?>';
                } else {
                    document.getElementById('otperror').textContent = "Invalid OTP. Please try again.";
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function startCountdown(seconds) {
        resendButton.style.display = 'none';
        resendTimer.style.display = 'block';
        countdown = seconds;

        const timer = setInterval(() => {
            countdown--;
            resendTimer.textContent = `Please wait ${countdown} seconds to resend the code.`;

            if (countdown <= 0) {
                clearInterval(timer);
                resendTimer.style.display = 'none';
                resendButton.style.display = 'inline';
            }
        }, 1000);
    }

    function resetCountdown() {
        countdown = 30;
        resendTimer.textContent = `Please wait ${countdown} seconds to resend the code.`;
    }
</script>
