<?php $this->load->view('includes/header'); ?>
<style>
    .hidden {
        display: none;
    }
</style>
<section class="inner-section single-banner" style="background: url(assets/images/single-banner.jpg) no-repeat center">
    <div class="container">
        <h2>Checkout</h2>
        <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
        </ol> -->
    </div>
</section>
<section class="inner-section checkout-part">
    <div class="container">
        <form id="checkoutformend" method="post"  enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="account-card paymentMethodWrapper">
                        <div class="account-title">
                            <h4>User Info</h4>
                        </div>
                        <input class="form-control checkoutfield" type="hidden" name="total_item_amount"
                            id="totalamount" value="<?php echo $this->cart->total(); ?>">
                        <input class="form-control " type="hidden" name="final_amount" id="grand_total"
                            value="<?php echo $this->cart->total(); ?>">
                        <input class="form-control checkoutfield" type="hidden" name="user_id"
                            value="<?= $this->session->userdata('login_user_id') ?>">
                        <div class="ec-check-bill-form">
                            <div class="check-flex">
                                <div class="form-outline">
                                    <label class="mt-2">Full name</label>
                                    <input type="text" class="form-control checkoutfield" name="name"
                                        placeholder="Name:" value="<?= set_value('name', @$login[0]['name']) ?>"
                                        required>
                                    <?= form_error('name', '<div class="error" style="color:red;">', '</div>'); ?>
                                </div>
                                <div class="form-outline">
                                    <label class="mt-2">Contact No.</label>
                                    <input type="number" class="form-control checkoutfield" id="contact"
                                        name="contact_no" placeholder="Phone No:"
                                        value="<?= set_value('contact_no', @$login[0]['contact_no']) ?>" maxlength="10"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                    <?= form_error('contact_no', '<div class="error" style="color:red;">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="check-flex">
                                <div class="form-outline">
                                    <label class="mt-2">Email</label>
                                    <input type="email" class="form-control checkoutfield" name="email"
                                        placeholder="Email Id:"
                                        value="<?= set_value('email', @$login[0]['email_id']) ?>" required>
                                    <?= form_error('email', '<div class="error" style="color:red;">', '</div>'); ?>
                                </div>

                                <div class="form-outline">
                                    <label class="mt-2">Age</label>
                                    <input type="text" class="form-control checkoutfield" name="patient_age"
                                        placeholder="Enter Your Age:"
                                        value="<?= set_value('patient_age', @$login[0]['patient_age']) ?>" required>
                                    <?= form_error('name', '<div class="error" style="color:red;">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="check-flex">
                                <div class="form-outline">
                                    <label class="mt-2">Appointment Date</label>
                                    <input type="date" class="form-control checkoutfield" name="appointment_date"
                                        id="datepicker">
                                    <?= form_error('appointment_date', '<div class="error" style="color:red;">', '</div>'); ?>
                                </div>
                                <div class="form-outline">
                                    <label>Appointment Time</label>
                                    <input type="text" class="form-control checkoutfield" name="appointment_time">
                                    <?= form_error('appointment_time', '<div class="error" style="color:red;">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="check-flex">
                                <div class="form-outline">
                                    <label class="mt-2">Gender</label>
                                    <select class="form-control checkoutfield" name="patient_gender">
                                        <option value="" selected="selected">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <?= form_error('name', '<div class="error" style="color:red;">', '</div>'); ?>
                                </div>
                                <div class="form-outline">
                                    <label class="mt-2">Upload Prescription</label>
                                    <input type="file" class="form-control checkoutfield" name="prescription_image"
                                        required>
                                    <div class="error" style="color:red;"><?php echo $file_error; ?></div>
                                </div>
                            </div>
                            <div class="check-flex">
                                <div class="form-outline">
                                    <label class="mt-2">State</label>
                                    <select class="form-control checkoutfield" name="state" required id="state">
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
                                <div class="form-outline ">
                                    <label class="mt-2">City</label>
                                    <select name="city" class="form-control checkoutfield" id="city">
                                        <?php
                                        if ($login[0] != '') {
                                            ?>
                                            <option value="<?= @$login[0]['city'] ?>" selected> <?= @$login[0]['city'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                        <option value="">Select city</option>
                                    </select>
                                </div>
                            </div>
                            <div class="check-flex">
                                <div class="form-outline ">
                                    <label class="mt-2">Pincode</label>
                                    <input type="text" class="form-control checkoutfield" name="postal_code"
                                        placeholder="Pincode*" value="<?= @$login[0]['postal_code'] ?>" maxlength="6"
                                        required>
                                </div>
                                <div class="form-outline">
                                    <label class="mt-2">Address</label>
                                    <input type="text" class="form-control checkoutfield" name="address"
                                        placeholder="Address*" value="<?= @$login[0]['address'] ?>" required>
                                </div>
                            </div>
                            <div class="form-outline">
                                <label class="mt-2">Home/Lab Service</label>
                                <select class="form-control checkoutfield" name="service_type">
                                    <option value="Home Service">Home Service</option>
                                    <option selected="selected">Select Type</option>
                                    <option value="Lab Service">Laboratory Service</option>
                                </select>
                                <?= form_error('service_type', '<div class="error" style="color:red;">', '</div>'); ?>
                            </div>
                            <div class="account-title">
                                <h4>Shipping address</h4>
                            </div>
                            <div>
                                <label for="same_as_billing">Same as Billing Address:</label>
                                <input type="checkbox" id="same_as_billing" name="same_as_billing" checked>
                            </div>

                            <div id="shipping_address_fields" class="hidden">
                                <div class="form-outline">
                                    <label for="shipping_address">Shipping Address:</label><br>
                                    <input type="text" id="shipping_address" name="shipping_address"
                                        id="shipping_address" class="form-control checkoutfield"><br>
                                </div>
                                <div class="form-outline">
                                    <label for="shipping_city">City:</label><br>
                                    <input type="text" id="shipping_city" name="shipping_city" id="shipping_city"
                                        class="form-control checkoutfield"><br>
                                </div>
                                <div class="form-outline">
                                    <label for="shipping_state">State:</label><br>
                                    <input type="text" id="shipping_state" name="shipping_state" id="shipping_state"
                                        class="form-control checkoutfield"><br>
                                </div>
                                <div class="form-outline">
                                    <label for="shipping_zip">ZIP Code:</label><br>
                                    <input type="text" id="shipping_zip" name="shipping_zip" id="shipping_zip"
                                        class="form-control checkoutfield"><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="account-card" id="">
                        <!--<div class="d-flex align-items-center justify-content-center pt-4">                            -->


                        <?php if (count($this->cart->contents()) > 0) { ?>
                            <div class="account-title">
                                <h4>Order summary</h4>
                            </div>
                            <div id="cartlist" class="bottom-border">

                            </div>
                            <div class="account-content">
                                <div class="faq-parent">
                                    <div class="faq-child">
                                        <div class="faq-que"><button type="button">Check coupon</button></div>
                                        <div class="faq-ans">
                                            <div class="wallet-card-group">
                                                <?php
                                                if ($promocode) {
                                                    $couponAvailable = false; // Flag to check if a coupon is available
                                                    foreach ($promocode as $promo) {
                                                        if ($promo['minimum_order'] < $this->cart->total()) {
                                                            $couponAvailable = true; // Set the flag to true if a coupon is displayed
                                                            ?>
                                                            <div class="wallet-card cborder">
                                                                <input class="coupon-code" id="coupon<?= $promo['promocode_id'] ?>"
                                                                    value="<?= $promo['promocode'] ?>" readonly>
                                                                <span class="copy-button" data-id="<?= $promo['promocode_id'] ?>"
                                                                    onclick="myFunction('coupon<?= $promo['promocode_id'] ?>')">Copy</span>
                                                                <h6 class="pl-2">You Get Flat - <?= $promo['amount'] ?> Off on
                                                                    <?= $promo['payment_method'] == '0' ? 'COD' : 'Online Payment' ?>
                                                                </h6>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                    if (!$couponAvailable) {
                                                        echo 'None of the coupon can applicable to this order';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php
                                $getFestivePromo = $this->CommonModel->runQuery("SELECT * FROM `tbl_promocode` where festive = '1' order by promocode_id desc limit 1");
                                if (!empty($getFestivePromo)) {
                                    $cusomStyles = "style='display: none;'";
                                    $cusomStyles2 = "style='display: flex;'";
                                } else {
                                    $cusomStyles = "style=''";
                                    $cusomStyles2 = "style='display: none;'";
                                }
                                ?>
                                <div class="chekout-coupon">
                                    <h6 id="promomsg" class=""></h6>
                                    <button type="button" class="coupon-btn" <?= $cusomStyles ?>>Do you have a coupon
                                        code?</button>
                                    <div class="coupon-form" <?= $cusomStyles2 ?>>
                                        <input type="text" id="promocode" name="promocode"
                                            placeholder="Enter your coupon code"
                                            value="<?= @$getFestivePromo[0]['promocode'] ?>" class="checkoutfield">
                                        <input class="form-control form-control-md mr-1 mb-2" type="hidden"
                                            placeholder="Enter Your Coupon Code" name="promocode_amount" id="promocode_amt"
                                            value="<?= @$getFestivePromo[0]['amount'] ?>">
                                        <button type="button" id="promo"><span>apply</span></button>
                                    </div>
                                </div>
                                <ul class="invoice-details">

                                    <li>
                                        <h6>Sub Total</h6>
                                        <p><span class="totalamount"></span></p>
                                    </li>
                                    <!--<li>-->
                                    <!--    <h6> Discount on MRP</h6>-->
                                    <!--    <p class="free" id="prodisount"></p>-->
                                    <!--</li>-->
                                    <li>
                                        <h6>Delivery Charges</h6>
                                        <p> <?php
                                        if ($delivery['min_amount'] >= $this->cart->total()) {
                                            if ($delivery['amount'] == 0) {
                                                echo "Free";
                                                ?>
                                                    <input type="hidden" value="0" id="shipping_charges" name="shipping_charges">
                                                    <?php
                                            } else {
                                                ?>
                                                    ₹ <?= $delivery['amount']; ?>
                                                    <input type="hidden" value="<?= $delivery['amount']; ?>" id="shipping_charges"
                                                        name="shipping_charges">
                                                    <?php
                                            }
                                        } else {
                                            echo "Free";
                                            ?>
                                                <input type="hidden" value="0" id="shipping_charges" name="shipping_charges">
                                                <?php
                                        }
                                        ?>
                                        </p>
                                    </li>

                                    <li id="deducamt"></li>
                                    <!-- <li id="onlineDiscount">
                                        <h6>Extra 5% Discount</h6>
                                        <p>
                                            2000
                                        </p>
                                    </li> -->
                                    <li id="onlinepay">
                                        <h6>On online payment</h6>
                                        <p><span id="cartgrandprice_op_dis"> </span>
                                        </p>
                                    </li>
                                    <hr>

                                    <li>
                                        <h6>Total</h6>
                                        <p><span id="cartgrandprice"> ₹
                                                <?php echo $this->cart->format_number($this->cart->total()); ?> /- </span>
                                        </p>
                                    </li>


                                    <li style="display:none">
                                        <h6>New Total</h6>
                                        <p><span id="cartgrandprice_op"> </span>
                                        </p>
                                    </li>
                                    <!-- <li>
                                        <h6>Payment Method</h6>
                                        <p><input type="radio" name="payment_mode" id="paymentModeCod" value="1"> &nbsp;<label for="paymentModeCod" style="cursor: pointer;">Cash On Delivery</label></p>
                                        <p><input type="radio" name="payment_mode" id="paymentModeOnline" value="2"> &nbsp;<label for="paymentModeOnline" style="cursor: pointer;">Online Payment</label></p>
                                    </li> -->
                                    <li class="d-flex flex-column paymentMethodWrapper">
                                        <h6>Payment Method</h6>
                                        <div class="my-2 paymentMethodRadioGroup">
                                            <label class="paymentMethodLabel"><input type="radio" class="checkoutfield"
                                                    name="payment_mode" id="paymentModeCod" value="1">&nbsp;Cash On
                                                Delivery</label>
                                            <label class="paymentMethodLabel"><input type="radio" class="checkoutfield"
                                                    name="payment_mode" id="paymentModeOnline" checked
                                                    value="2">&nbsp;Online Payment</label>
                                            <div class="paymentInfo"><i class="fa fa-info"></i> Get an extra 5% discount
                                                when you choose online payment.</div>
                                        </div>
                                    </li>

                                </ul>

                                <div class="checkout-check"><input type="checkbox" id="checkout-check" checked
                                        required><label for="checkout-check">By making this purchase you agree to our <a
                                            href="#">Terms and Conditions</a>.</label></div>
                                <div class="checkout-proced">
                                    <?php
                                    if ($this->session->has_userdata('login_user_id')):
                                        ?>
                                        <button type="submit" class="forcheckotp btn btn-inline">Proceed to Checkout</button>
                                        <?php
                                    else:
                                        ?>
                                        <button type="button" class=" btn btn-inline" id="checkoutButton">Proceed to
                                            Checkout</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div class="py-3 text-center">
                                <h3 class="mb-2">Your cart is empty!</h2>
                                    <a href="<?= base_url('product') ?>" class="btn btn-inline">
                                        <i class="fas fa-cart"></i><span>Shop Now</span>
                                    </a>
                            </div>
                            <?php
                        } ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>

<script>
    function myFunction(wrapper) {
        // Get the text field
        var copyText = document.getElementById(wrapper);

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);
    }
</script>
<script>
    document.getElementById('same_as_billing').addEventListener('change', function () {
        var shippingFields = document.getElementById('shipping_address_fields');
        if (this.checked) {
            shippingFields.classList.add('hidden');
        } else {
            shippingFields.classList.remove('hidden');
        }
    });
</script>
</body>

</html>