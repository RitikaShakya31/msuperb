<?php $this->load->view('includes/header'); ?>

<section class="inner-section single-banner">
    <div class="container">
        <h2>Cancel order</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order cancellation form</li>
        </ol>
    </div>
</section>
<section class="inner-section orderlist-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post" >
                            <!-- Order ID -->
                            <div class="mb-3">
                                <label for="orderId" class="form-label">Order ID</label>
                                <input type="text" class="form-control" id="orderId" placeholder="Enter your order ID" value="<?= $orderId ?>" required readonly>
                            </div>

                            <!-- Reason for Cancellation -->
                            <div class="mb-3">
                                <label for="cancelReason" class="form-label">Reason for Cancellation</label>
                                <select class="form-select" name="cancelReason" required>
                                    <option value="">Select a reason</option>
                                    <option value="delayed">Delayed Delivery</option>
                                    <option value="wrong_product">Received Wrong Product</option>
                                    <option value="changed_mind">Changed My Mind</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Additional Comments -->
                            <div class="mb-3">
                                <label for="additionalComments" class="form-label">Additional Comments</label>
                                <textarea class="form-control" name="additionalComments" rows="5" placeholder="Optional"></textarea>
                            </div>

                            <!-- Submit and Cancel Buttons -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-danger">Cancel Order</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
</body>

</html>