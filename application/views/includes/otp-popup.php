<style>


.custom-input {
    border: 2px solid #5b86e5;
    border-radius: 5px;
    padding: 10px;
    font-size: 16px;
}

.custom-btn {
    background: linear-gradient(45deg, #f093fb, #f5576c);
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    transition: background 0.3s ease;
}

.custom-btn:hover {
    background: linear-gradient(45deg, #f5576c, #f093fb);
}
.btn-close-1{
    background: white;
    border: 2px solid #5b86e5;
    border-radius: 50%;
    padding: 2px 8px;
}


</style>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Enter WhatsApp OTP</h1>
        <button type="button" class="btn-close-1" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div>
      <div class="modal-body">
        <form id="otpForm">
          <div class="mb-3">
            <label for="otpInput" class="form-label">Enter the OTP sent to your WhatsApp</label>
            <input type="text" class="form-control custom-input" id="otpInput" placeholder="Enter OTP" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="checkotpverify" form="otpForm" class="cart-checkout-btn-1 btn custom-btn">Submit OTP</button>
      </div>
    </div>
  </div>
</div>