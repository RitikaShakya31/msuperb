<?php $this->load->view('includes/header'); ?>
<style>
  .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
  }

  .rate:not(:checked)>input {
    position: absolute;
    top: -9999px;
  }

  .rate:not(:checked)>label {
    float: right;
    width: 1em;
    overflow: hidden;
    white-space: nowrap;
    cursor: pointer;
    font-size: 30px;
    color: #ccc;
  }

  .rate:not(:checked)>label:before {
    content: '★ ';
  }

  .rate>input:checked~label {
    color: #ffc700;
  }

  .rate:not(:checked)>label:hover,
  .rate:not(:checked)>label:hover~label {
    color: #deb217;
  }

  .rate>input:checked+label:hover,
  .rate>input:checked+label:hover~label,
  .rate>input:checked~label:hover,
  .rate>input:checked~label:hover~label,
  .rate>label:hover~input:checked~label {
    color: #c59b08;
  }

  /* Modified from: https://github.com/mukulkant/Star-rating-using-pure-css */
</style>
<section class="inner-section single-banner">
  <div class="container">
    <h2>Your Appointment History</h2>
  </div>
</section>
<section class="inner-section orderlist-part">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="orderlist-filter">
          <h5>Welcome<span>
              <?= sessionId('login_user_name') ?>
            </span></h5>
          <div class="filter-short"><label class="form-label"></label>
            <a href="<?= base_url('profile') ?>" style="color:green">My Profile<i class="icofont-arrow-right"></i></a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <?php
          $i = 0;
          if (!empty($cancelOrderDetails)) {
            echo "<h4 class='heading'>Cancelled Appointment</h4>";
            foreach ($cancelOrderDetails as $row) {
              $i = $i + 1;
              $getnum = getNumRows('book_item', array('order_id' => $row['order_id']));
              ?>
              <div class="orderlist">
                <div class="orderlist-head">
                  <h5>Appointment#
                    <?= $i ?>
                  </h5>
                  <?php
                  if ($row['cancel_date']) {
                    ?>
                    <h5 class="text-secondary">Cancelled on:
                      <?= $row['cancel_date'] ?>
                    </h5>
                  <?php }
                  ?>
                  <!-- <h5>
                    <span>Refund Status :
                      <?php
                      if ($row['is_refunded'] == '0') {
                        echo '<span class="font-size-14">Initiated</span>';
                      } elseif ($row['is_refunded'] == '1') {
                        echo '<span class="font-size-14">Refunded</span>';
                      } else {
                        echo '<span class="font-size-14">Refund Cancelled</span>';
                      }
                      ?>
                    </span>
                  </h5> -->
                  <!-- <h5>
                    <span class="text-danger"> Order Cancel Reason :
                      <?= $row['cancel_message'] ?>
                    </span>
                  </h5> -->
                </div>
                <div class="orderlist-body">
                  <div class="row">
                    <div class="col-lg-12">
                    <div class="order-track">
    <ul class="order-track-list">
        <!-- Appointment Initiated -->
        <li class="order-track-item placed active">
            <i class="icofont-check"></i>
            <span>Appointment Initiated</span>
        </li>

        <!-- Show 'Appointment Done' if status is 2 -->
        <?php if ($row['visit_status'] == '2') { ?>
            <li class="order-track-item accept active">
                <i class="icofont-check"></i>
                <span>Appointment Done</span>
            </li>
        <?php } ?>

        <!-- Show 'Appointment Cancelled' only if status is 0 -->
        <?php if ($row['visit_status'] == '0') { ?>
            <li class="order-track-item cancelled active">
                <i class="icofont-close"></i>
                <span>Appointment Cancelled</span>
            </li>
        <?php } ?>
    </ul>
</div>

                    </div>
                    <div class="col-lg-6">
                      <ul class="orderlist-details">
                        <li>
                          <h6>order id</h6>
                          <p>
                            <?= $row['order_id'] ?>
                          </p>
                        </li>
                        <li>
                          <h6>Total Quantity</h6>
                          <p>
                            <?= $getnum ?> Items
                          </p>
                        </li>
                        <li>
                          <h6>Appointment Date</h6>
                          <p>
                            <?= $row['appointment_date'] ?>
                          </p>
                        </li>
                        <li>
                          <h6>Appointment Time</h6>
                          <p>
                            <?= $row['appointment_time'] ?>
                          </p>
                        </li>
                        <li>
                          <h6>Service Type</h6>
                          <p>
                            <?= $row['service_type'] ?>
                          </p>
                        </li>
                        <!-- <li>
                          <h6>Delivery Time</h6>
                          <p>
                            <?= ($row['estimated_time'] != '' ? $row['estimated_time'] : 'Updated Soon...') ?>
                          </p>
                        </li> -->
                      </ul>
                    </div>
                    <div class="col-lg-6">
                      <ul class="orderlist-details">
                        <li>
                          <h6>Sub Total</h6>
                          <p>₹
                            <?= $row['total_item_amount'] ?>
                          </p>
                        </li>
                        <li>
                          <h6>discount</h6>
                          <p>
                            <?= ($row['promocode_amount'] > '0' ? '₹     ' . $row['promocode_amount'] : '...') ?>
                          </p>
                        </li>
                        <li>
                          <h6>delivery fee</h6>
                          <p>
                            <?= ($row['delivery_charges'] > '0' ? '₹' . $row['delivery_charges'] : 'Free') ?>
                          </p>
                        </li>
                        <li>
                          <h6>Total</h6>
                          <p>₹
                            <?= $row['final_amount'] ?>
                          </p>
                        </li>
                      </ul>
                    </div>
                    <!-- <div class="col-lg-3">
                      <div class="orderlist-deliver">
                        <h6>Delivery location</h6>
                        <p>
                          <?= $row['address'] ?>
                        </p>
                        <hr>
                        <h6>Pin Code
                          :
                          <?= $row['postal_code'] ?>
                        </h6>
                      </div>
                    </div> -->
                    <div class="col-lg-12">
                      <div class="table-scroll">
                        <table class="table-list">
                          <thead>
                            <tr>
                              <th scope="col">Serial</th>
                              <!-- <th scope="col">Product</th> -->
                              <th scope="col">Test Name</th>
                              <th scope="col">Price</th>
                              <th scope="col">quantity</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $j = 0;
                            $checkoutProduct = getRowById('book_item', 'order_id', $row['order_id']);
                            if (!empty($checkoutProduct)) {
                              foreach ($checkoutProduct as $productRow) {
                                $products = getRowById('product', 'product_id', $productRow['product_id'])[0];
                                $data = getSingleRowById('product_image', array('product_id' => $products['product_id']));
                                $j = $j + 1;
                                ?>
                                <tr>
                                  <td class="table-serial">
                                    <h6 class="text-center">
                                      <?= $j ?>
                                    </h6>
                                  </td>
                                  <td class="table-name">
                                    <h6 class="text-center">
                                      <?= $productRow['product_name'] ?>
                                    </h6>
                                  </td>
                                  <td class="table-price">
                                    <h6 class="text-center">₹
                                      <?= $products['sale_price'] ?>
                                    </h6>
                                  </td>
                                  <td class="table-quantity">
                                    <h6 class="text-center">
                                      <?= $productRow['no_of_items'] ?>
                                    </h6>
                                  </td>
                                </tr>
                                <?php
                              }
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php }
          }
          ?>
        </div>
      </div>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $('.reviewsave').click(function (e) {
      e.preventDefault();
      var order = $(this).data('order');
      var product = $(this).data('product');
      var formData = new FormData($('#myForm' + order + product)[0]);
      console.log(formData);
      $.ajax({
        url: $('#myForm' + order + product).attr('action'),
        type: 'post',
        data: formData,
        processData: false, // Prevent jQuery from automatically processing data
        contentType: false, // Prevent jQuery from setting contentType
        success: function (response) {
          // Handle success response
          if (response == 1) {
            alert('Your review is added successfully');
            $('.close' + order + product).click();
          } else {
            alert('We are facing server issue.Please try again later');
          }
        },
        error: function (xhr, status, error) {
          // Handle error response
          console.error(xhr.responseText);
        }
      });
    });
  });
</script>
</body>

</html>