<script src="<?= base_url() ?>assets/vendor/bootstrap/jquery-1.12.4.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/popper.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/countdown/countdown.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/niceselect/nice-select.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/slickslider/slick.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/venobox/venobox.min.js"></script>
<script src="<?= base_url() ?>assets/js/nice-select.js"></script>
<script src="<?= base_url() ?>assets/js/countdown.js"></script>
<script src="<?= base_url() ?>assets/js/accordion.js"></script>
<script src="<?= base_url() ?>assets/js/venobox.js"></script>
<script src="<?= base_url() ?>assets/js/slick.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script src="<?= base_url() ?>assets/js/myplugin.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div id="snackbar">Item Added Successfully</div>


<script>
  <?php
  if (sessionId('success_status')) {
    ?>
    Swal.fire({
      title: '<?= sessionId('success_status') ?>!',
      text: '<?= sessionId('msg') ?>',
      icon: '<?= sessionId('success_status') ?>',
      confirmButtonText: 'Done'
    })
    <?php
  }
  ?>
</script>
<!-- Modal -->
<div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Prescription</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Left side image -->
          <div class="col-md-6">
            <img src="<?= base_url('assets/img/prescription.png') ?>" alt="Prescription" class="img-fluid">
          </div>
          <!-- Right side form -->
          <div class="col-md-6">
            <form action="<?= base_url('UserHome/prescriptionData') ?>" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <!-- <label for="name" class="form-label">Name</label> -->
                <input type="text" class="form-control" placeholder="Name *" name="name" id="name" required>
              </div>
              <div class="mb-3">
                <!-- <label for="contact" class="form-label">Contact</label> -->
                <input type="tel" class="form-control" id="contact" name="contact_no" placeholder="Mobile no *"
                  required>
              </div>
              <div class="mb-3">
                <!-- <label for="email" class="form-label">Email</label> -->
                <input type="email" class="form-control" id="email" name="email" placeholder="Email id *" required>
              </div>
              <div class="mb-3">
                <input type="file" class="form-control" accept=".png, .jpg, .webp, .jpeg"
                  placeholder="Upload Prescription" name="prescription_image" required>
                <label for="image" class="form-label">Please Attach the Prescription</label>
              </div>
              <div class="mb-3">
                <select class="form-select" name="gender" id="gender" required>
                  <option value="" disabled selected>Select Gender *</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
              <div class="mb-3">
                <!-- <label for="dob" class="form-label">Date of Birth</label> -->
                <input type="date" class="form-control" id="dob" placeholder="Date of Birth" name="DOB" required>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agree" required>
                <label class="form-check-label" for="agree">I agree to the <a href="<?= base_url('term-condition')?>">terms and conditions</a></label>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- bookHomeVisitModal -->
<div class="modal fade" id="bookHomeVisitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Book Home Visit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Left side image -->
          <div class="col-md-6">
            <img src="<?= base_url('assets/img/prescription.png') ?>" alt="Prescription" class="img-fluid">
          </div>
          <!-- Right side form -->
          <div class="col-md-6">
            <form action="<?= base_url('UserHome/visitData') ?>" method="post" enctype="multipart/form-data">
              <div class="mb-3">
                <!-- <label for="name" class="form-label">Name</label> -->
                <input type="text" class="form-control" placeholder="Name *" name="name" id="name" required>
              </div>
              <div class="mb-3">
                <!-- <label for="contact" class="form-label">Contact</label> -->
                <input type="tel" class="form-control" id="contact" name="contact_no" placeholder="Mobile no *"
                  required>
              </div>
              <div class="mb-3">
                <!-- <label for="email" class="form-label">Email</label> -->
                <input type="email" class="form-control" id="email" name="email" placeholder="Email id *" required>
              </div>
              <div class="mb-3">
                <input type="file" class="form-control" accept=".png, .jpg, .webp, .jpeg"
                  placeholder="Upload Prescription" name="prescription_image" required>
                <label for="image" class="form-label">Please Attach the Prescription</label>
              </div>
              <div class="mb-3">
                <select class="form-select" name="gender" id="gender" required>
                  <option value="" disabled selected>Select Gender *</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
              <div class="mb-3">
                <!-- <label for="dob" class="form-label">Date of Birth</label> -->
                <input type="date" class="form-control" id="dob" placeholder="Date of Birth" name="DOB" required>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agree" required>
                <label class="form-check-label" for="agree">I agree to the <a href="<?= base_url('term-condition')?>">terms and conditions</a></label>
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // Function to check if all required form fields are filled
  function isFormFilled() {
    let isValid = true;

    // Select all required fields
    const requiredFields = document.querySelectorAll('.checkoutfield[required]');

    // Loop through each field and check if it is empty
    requiredFields.forEach(function (field) {
      if (field.value.trim() === '') {
        isValid = false;
        field.classList.add('is-invalid'); // Add invalid class if the field is empty
      } else {
        field.classList.remove('is-invalid'); // Remove invalid class if the field is filled
      }
    });

    return isValid;
  }

  // Add event listener to the checkout button
  document.getElementById('checkoutButton').addEventListener('click', function () {

    // Check if all the required form fields are filled
    if (isFormFilled()) {
      console.log($('#contact').val());
      var contactno = $('#contact').val();
      var base_url = $('#base').val();
      $.ajax({
        type: "POST",
        url: base_url + "UserHome/get_otp",
        data: {
          contactno: contactno
        },
        beforeSend: function () {
          $('#checkoutButton').html('<i class="fa fa-spinner fa-spin"></i> Loading...');
        },
        success: function (response) {
          var json = $.parseJSON(response);
          if (json.status == 1) {
            // Handle success
            // alert(json.login_msg);
            var otpModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            otpModal.show();
            $('#checkoutButton').html('Proceed to checkout');
          } else {
            // Handle error
            alert(json.login_msg);
            // $('.forcheckotp').text('Try Again');
          }

        },
        error: function () {
          // Handle AJAX error
          alert('An error occurred while sending OTP.');
          // $('.forcheckotp').text('Try Again');
        }
      });
      // Show the OTP modal if the form is valid

      // $('#checkoutformend').submit();
    } else {
      // Alert the user to fill the required fields if the form is incomplete
      alert("Please fill out all required fields before proceeding.");
    }
  });
</script>


<script>
  function fetchdata() {
    $.ajax({
      url: '<?= base_url("Shop/fetch_cart") ?>',
      success: function (response) {
        $('#cartlist').html(response);
        load_product();
        load_cart_list();
        load_checkout_list();
      }
    });
  }
  fetchdata();

  function load_product() {
    $.ajax({
      url: '<?= base_url("Shop/fetch_data_cart") ?>',
      success: function (response) {
        $('#cart').html(response);

      }
    });


    $.ajax({
      url: '<?= base_url("Shop/fetch_totalitems") ?>',
      method: 'POST',
      success: function (response) {
        $('.totalitem').text(response);
      }
    });

    $.ajax({
      url: '<?= base_url("Shop/fetch_totalamount") ?>',
      method: 'POST',
      success: function (response) {
        $('.totalamount').text(response);

      }
    });

    $.ajax({
      url: '<?= base_url("Shop/product_discount") ?>',
      method: 'POST',
      success: function (response) {
        $('#prodisount').text(response);
      }
    });
    load_checkoutbar();
    promo();
  }
  load_product();
  // load_cart_list();

  function mySanckbar() {
    x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function () {
      x.className = x.className.replace("show", "");
    }, 3000);
  }

  $(document).on('click', '.addCart', function () {
    var pid = $(this).data('id');
    console.log(pid);
    var pro = $("input[name='variant" + pid + "']:checked").val();
    var product = ((pro == '') ? '0' : pro);
    var qty = $('#qtysidecart' + pid).val();
    $(".addCart").attr('disabled', true);

    $.ajax({
      method: "POST",
      url: "<?= base_url('Shop/addToCart') ?>",
      data: {
        pid: pid,
        product: product,
        qty: qty
      },
      beforeSend: function () {
        $('.crtbtn-' + pid).html('<i class="fa fa-spinner fa-spin"></i> Adding...');
      },
      success: function (response) {
        console.log("cart response =" + response);
        load_product();
        mySanckbar();
        $(".addCart").attr('disabled', false);
        $('.crtbtn-' + pid).html('<i class="fas fa-shopping-basket"></i><span>add</span>');
        // $("#cart").click();
      }
    });
  });

  // $(document).on('click', '.buynow, .cart-checkout-btn', function () {
  //   var pid = $(this).data('id');
  //   var product = $("input[name='variant" + pid + "']:checked").val();
  //   var qty = $('#qtysidecart' + pid).val();

  //   $.ajax({
  //     method: "POST",
  //     url: "<?= base_url('Shop/addToCart') ?>",
  //     data: {
  //       pid: pid,
  //       product: product,
  //       qty: qty
  //     },
  //     dataType:'JSON',
  //     success: function (response) {
  //       if (response.login_user_id) {
  //         window.location = "<?= base_url('checkout') ?>";
  //       } else {
  //         var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
  //           backdrop: 'static',
  //           keyboard: false
  //         });
  //         myModal.show();
  //       }
  //     }
  //   });
  // });

  $(document).on('click', '.cart-checkout-btn', function () {
    var pid = $(this).data('id');
    var product = $("input[name='variant" + pid + "']:checked").val();
    var qty = $('#qtysidecart' + pid).val();

    $.ajax({
      method: "POST",
      url: "<?= base_url('Shop/addToCart') ?>",
      data: {
        pid: pid,
        product: product,
        qty: qty
      },
      dataType: 'JSON',
      success: function (response) {
        if (response.login_user_id) {
          window.location = "<?= base_url('checkout') ?>";
        } else {
          var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
            backdrop: 'static',
            keyboard: false
          });
          myModal.show();
        }
      }
    });
  });



  $(document).on('click', '.buynow', function () {
    var pid = $(this).data('id');
    var product = $("input[name='variant" + pid + "']:checked").val();
    var qty = $('#qtysidecart' + pid).val();
    $.ajax({
      method: "POST",
      url: "<?= base_url('Shop/addToCart') ?>",
      data: {
        pid: pid,
        product: product,
        qty: qty
      },
      success: function (response) {

        window.location = "<?= base_url('checkout') ?>";
      }
    });
  });
  // $(document).on('click', '.removeCarthm', function() {
  //   var pid = $(this).data('id'); 
  //   // console.log(pid);
  //   $.ajax({
  //     method: "POST",
  //     url: "<?= base_url('Shop/delete_item') ?>",
  //     data: {
  //       pid: pid
  //     },
  //     success: function(response) {
  //       load_product();
  //       alert('Item has been removed into your cart')
  //       <?php
  //       if (strtolower($title) == 'my cart') {
  //       
  ?>
  //         load_cart_list();
  //       <?php
  //       } else {
  //       
  ?>
  //         // $("#cart").click();
  //       <?php
  //       }
  //       
  ?>
  //     }
  //   });
  // });
  $(document).on('click', '.qty', function () {
    var numberField = $(this).parent().find('[type="number"]');
    var currentVal = parseFloat(numberField.val());
    var type = $(this).data('type'); // Button ka type (minus ya sidecart) le rahe hain
    var rowid = $(this).data('rowid');
    var price = $(this).data('price');

    // Quantity update logic
    if (type === 'minus') {
      if (currentVal > 1) { // Ensure qty 1 se kam na ho
        numberField.val(currentVal - 1);
      }
    } else if (type === 'sidecart') {
      numberField.val(currentVal + 1);
    }

    var qty = numberField.val(); // Updated quantity

    // AJAX call to update quantity
    $.ajax({
      method: "POST",
      url: "<?= base_url("Shop/update_qty") ?>",
      data: {
        rowid: rowid,
        qty: qty
      },
      success: function (response) {
        // Reload the product section
        load_product();

        // Update the total price for the current item
        $('#item_total' + rowid).text((qty * price).toFixed(2)); // Ensure 2 decimal places
      }
    });
  });


  $(document).on('change', '#state', function () {

    var state = $(this).val();

    $.ajax({
      method: "POST",
      url: "<?= base_url('UserHome/getcity') ?>",
      data: {
        state: state
      },
      success: function (response) {
        // console.log(response);
        $('#city').html(response);
      }
    });
  });
  $(document).on('click', '#promo', function () {
    promo();
  });

  function load_checkoutbar() {
    var referalpoint = $('#referalpointcheck').data('point');
    var shipping = $('#shipping_charges').val();
    var tamt = $('#totalamount').val();
    var promocode_amt = $('#promocode_amt').val();
    if (promocode_amt == '') {
      console.log(parseInt(tamt));
      var tamount = parseInt(tamt) + parseInt(shipping);
      $('#cartgrandprice').text('₹ ' + tamount);
      $('#cartgrandprice_op_dis').text('- ₹' + ((tamount) * 5 / 100));
      $('#cartgrandprice_op').text('₹ ' + ((tamount) - ((tamount) * 5 / 100)));

      $('#grand_total').val(parseInt(tamt) + parseInt(shipping));
      $('#cartprice').text('₹ ' + (parseInt(tamt) + parseInt(shipping)) + '/-');
    } else {
      var tamount = (parseInt(tamt) - parseInt(promocode_amt)) + parseInt(shipping);
      $('#cartgrandprice').text('₹ ' + tamount);
      $('#cartgrandprice_op_dis').text('- ₹' + ((tamount) * 5 / 100));
      $('#cartgrandprice_op').text('₹ ' + ((tamount) - ((tamount) * 5 / 100)));
      $('#grand_total').val(tamount);
      $('#cartprice').text('₹ ' + (tamount) + '/-');
    }
  }

  function promo() {
    var promocode = $('#promocode').val();

    $.ajax({
      method: "POST",
      url: "<?= base_url('UserHome/checkPromo') ?>",
      data: {
        promocode: promocode
      },
      success: function (response) {

        var selectedPaymentMethod = $('input[name="payment_mode"]:checked').val()
        if (response == 'false') {
          $('#deducamt').text('');
          $('#promomsg').text('');
          $('#promocode_amt').val('0');
          var tamt = $('#totalamount').val();
          var referalpoint = $('#referalpoint').val();
          $('#cartprice').text('₹ ' + parseInt(tamt) + '/-');
          var sc = $('#shipping_charges').val();
          var tamount = ((parseInt(tamt)) + parseFloat(sc)).toFixed(2);
          $('#cartgrandprice_op_dis').text('- ₹' + ((tamount) * 5 / 100));
          if (selectedPaymentMethod == 2) {
            $('#onlinepay').show();
            $('#cartgrandprice').text('₹ ' + ((tamount) - ((tamount) * 5 / 100)));
          } else {

            $('#onlinepay').hide();
            $('#cartgrandprice').text('₹ ' + tamount);
          }
          $('#cartgrandprice_op').text();
          $('#grand_total').val(parseInt(tamt) + parseInt(sc));

        } else {
          var obj = JSON.parse(response);

          // 0-cod, 1-online
          if (obj[0].payment_method == '1') {
            if (selectedPaymentMethod == '2') {
              $('#checkoutButton').removeAttr('disabled');
              $('#promocode_amt').val(obj[0]['amount']);
              var tamt = $('#totalamount').val();
              var lastamt = $('#grand_total').val();
              if (parseInt(lastamt) >= obj[0]['minimum_order']) {

                $('#promomsg').html('<span style="color:#28a745 "><b>Applied !Promo code Offer amount - ₹ ' + obj[0]['amount'] + '</b></span>');
                $('#cartprice').text('₹ ' + (parseInt(tamt) - parseInt(obj[0]['amount'])) + '/-');
                $('#deducamt').html('<h6>Coupon Discount</h6> <p for="free-shipping" class="color-dark free">- ₹ ' + obj[0]['amount'] + '</p>');

                var sc = $('#shipping_charges').val();
                var tamount = ((parseInt(tamt) - (parseInt(obj[0]['amount'])) + parseFloat(sc)).toFixed(2));
                if (selectedPaymentMethod == 2) {
                  $('#onlinepay').show();
                  $('#cartgrandprice').text('₹ ' + ((tamount) - ((tamount) * 5 / 100)));
                } else {
                  $('#onlinepay').hide();
                  $('#cartgrandprice').text('₹ ' + tamount);
                }

                $('#cartgrandprice_op_dis').text('- ₹' + ((tamount) * 5 / 100));
                // $('#cartgrandprice_op').text('₹ ' + ((tamount) - ((tamount) * 5 / 100)));
                $('#grand_total').val(tamount);
              } else {
                alert('This Promocode is not applicable for your order');
                location.reload();
              }
            } else {
              $('#checkoutButton').attr('disabled', 'true');
              $('#deducamt').text('');
              $('#promomsg').text('');
              $('#promocode_amt').val('0');
              var tamt = $('#totalamount').val();
              var referalpoint = $('#referalpoint').val();

              $('#cartprice').text('₹ ' + parseInt(tamt) + '/-');
              var sc = $('#shipping_charges').val();

              var tamount = (((parseInt(tamt)) + parseFloat(sc)).toFixed(2));
              if (selectedPaymentMethod == 2) {
                $('#onlinepay').show();
                $('#cartgrandprice').text('₹ ' + ((tamount) - ((tamount) * 5 / 100)));
              } else {
                $('#onlinepay').hide();
                $('#cartgrandprice').text('₹ ' + tamount);
              }
              // $('#cartgrandprice').text('₹ ' + tamount);
              $('#cartgrandprice_op_dis').text('- ₹' + ((tamount) * 5 / 100));
              // $('#cartgrandprice_op').text('₹ ' + ((tamount) - ((tamount) * 5 / 100)));
              $('#grand_total').val(parseInt(tamt) + parseInt(sc));
              $('#promomsg').html(`<span class="text-danger">Coupon not available for Cash on Delivery</span>`);
            }

          } else {
            if (selectedPaymentMethod == '1') {
              $('#checkoutButton').removeAttr('disabled');
              $('#promocode_amt').val(obj[0]['amount']);
              var tamt = $('#totalamount').val();
              var lastamt = $('#grand_total').val();
              if (parseInt(lastamt) >= obj[0]['minimum_order']) {

                $('#promomsg').html('<span style="color:#28a745 "><b>Applied !Promo code Offer amount - ₹ ' + obj[0]['amount'] + '</b></span>');
                $('#cartprice').text('₹ ' + (parseInt(tamt) - parseInt(obj[0]['amount'])) + '/-');
                $('#deducamt').html('<h6>Coupon Discount</h6> <p for="free-shipping" class="color-dark free">- ₹ ' + obj[0]['amount'] + '</p>');

                var sc = $('#shipping_charges').val();
                var tamount = ((parseInt(tamt) - (parseInt(obj[0]['amount'])) + parseFloat(sc)).toFixed(2));

                if (selectedPaymentMethod == 2) {
                  $('#onlinepay').show();
                  $('#cartgrandprice').text('₹ ' + ((tamount) - ((tamount) * 5 / 100)));
                } else {
                  $('#onlinepay').hide();
                  $('#cartgrandprice').text('₹ ' + tamount);
                }
                $('#cartgrandprice_op_dis').text('- ₹' + ((tamount) * 5 / 100));


                $('#grand_total').val(((parseInt(tamt) - (parseInt(obj[0]['amount'])) + parseFloat(sc)).toFixed(2)));
              } else {
                alert('This Promocode is not applicable for your order');
                location.reload();
              }
            } else {
              $('#deducamt').text('');
              $('#promomsg').text('');
              $('#promocode_amt').val('0');
              var tamt = $('#totalamount').val();
              var referalpoint = $('#referalpoint').val();

              $('#cartprice').text('₹ ' + parseInt(tamt) + '/-');
              var sc = $('#shipping_charges').val();

              var tamount = (((parseInt(tamt)) + parseFloat(sc)).toFixed(2));
              $('#cartgrandprice').text('₹ ' + tamount);
              $('#cartgrandprice_op_dis').text('- ₹' + ((tamount) * 5 / 100));
              $('#cartgrandprice_op').text('₹ ' + ((tamount) - ((tamount) * 5 / 100)));

              $('#grand_total').val(parseInt(tamt) + parseInt(sc));
              $('#checkoutButton').attr('disabled', 'true');
              $('#promomsg').html(`<span class="text-danger">Coupon not available for Online Payment</span>`);
            }
          }
        }
      }
    });
  }

  $('input[name="payment_mode"]').on('change', function () {
    // Your function code here
    promo();
  });

  function load_cart_list() {
    $.ajax({
      url: '<?= base_url("Shop/fetch_data_cart") ?>',
      method: 'POST',
      success: function (response) {
        $('#cart_items_preview').html(response);
      }
    });

  }

  function load_checkout_list() {
    $.ajax({
      url: '<?= base_url("Shop/fetch_checkout_cart") ?>',
      method: 'POST',
      success: function (response) {
        $('#checkout_items_preview').html(response);
      }
    });

  }

  $(document).on('click', '.removeCarthm', function () {
    var pid = $(this).data('id');
    $.ajax({
      method: "POST",
      url: "<?= base_url('Shop/delete_item') ?>",
      data: {
        pid: pid
      },
      success: function (response) {
        load_product();
        load_cart_list();
        fetchdata();
        load_checkout_list();
        var base_url = "<?php echo base_url(); ?>";
        var current_url = window.location.href;
        if (current_url === base_url + 'checkout') {
          location.reload();
        }
      }
    });
  });

  function load_cart_list() {
    $.ajax({
      url: '<?= base_url("Shop/cart") ?>',
      method: 'POST',
      success: function (response) {
        $('#cart_items_preview').html(response);
      }
    });

  }

  load_checkoutbar();

  $(document).ready(function () {
    setTimeout(function () {
      $('.alert').fadeTo(200, 0).slideUp(200, function () {
        $(this).remove();
      });
    }, 4000);
  });

  $(document).on('click', '#checkotpverify', function (e) {
    var base_url = $('#base').val();
    var contactno = $('#contact').val();
    var otp = $('#otpInput').val();

    // Check if OTP is not empty
    if (otp.trim() === "") {
      $('#otpmessage').html('<span class="text-danger">Please enter the OTP.</span><br/>');
      return;
    }


    $.ajax({
      type: "POST",
      url: base_url + "UserHome/verify_otp",
      data: {
        contactno: contactno,
        otp: otp
      },
      success: function (response) {
        console.log('Response received:', response);
        var json = $.parseJSON(response);
        $('#otpmessage').html('<span class="text-danger">' + json.login_msg + '</span><br/>');

        if (json.status == 1) {
          alert("no product selected");
        } else if (json.status == 3) {
          $('#checkoutformend').submit();
        } else {
          alert("Incorrect OTP entered. Please try again.");
          $('#otpmessage').html('<span class="text-danger">' + json.login_msg + '</span><br/>');
        }
      },
      error: function (xhr, status, error) {
        console.log('AJAX error:', status, error);
        $('#otpmessage').html('<span class="text-danger">An error occurred. Please try again.</span><br/>');
      }
    });
  });

  setTimeout(function () {
    $('#popupModal').modal('show');
  }, 10000);
  $(document).ready(function () {
    function saveData() {
      var formdata = $('#checkoutformend').serialize();
      $.ajax({
        url: '<?= base_url('UserHome/checkout_save') ?>',
        type: 'POST',
        data: formdata,
        success: function (response) {
          console.log(response);
        },
        error: function (xhr, status, error) {

          console.error('AJAX Error Details:');
          console.error('Status: ', status); // e.g., "error", "timeout"
          console.error('Error: ', error);   // e.g., "Internal Server Error"
          console.error('Response Text: ', xhr.responseText); // Server's response

          // Optionally show the full error in an alert
          alert('Error: ' + error + '\nStatus: ' + status + '\nResponse: ' + xhr.responseText);
        }
      });
    }

    // Trigger AJAX save when a field loses focus (blur event)
    $('.checkoutfield').on('blur', function () {
      saveData();
    });
  });
  // $(document).ready(function() {
  //   $('img').on('error', function() {
  //     $(this).attr('src', '<?= base_url() ?>default.jpg');
  //   });
  // });
  $(document).ready(function () {
    // When second modal is triggered, hide the first modal
    $('#exampleModal').on('show.bs.modal', function () {
      $('#popupModal').modal('hide');
    });

    // If you have more modals, you can repeat this pattern
    // When first modal is triggered, hide the second modal
    $('#popupModal').on('show.bs.modal', function () {
      $('#exampleModal').modal('hide');
    });
  });
</script>