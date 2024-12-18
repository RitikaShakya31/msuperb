<?php $this->load->view('includes/header'); ?>



<section class="coming-part">
    <div class="container">
        <div class="row align-items-center justify-content-center" style="margin-top: 8%; margin-bottom: 3%;">
            <div class="col-lg-8">
                <div class="coming-content text-center">
                    <?php echo $message; ?>
                </div>
            </div>
            <!--<div class="col-lg-8">-->
            <!--    <div class="card">-->
            <!--        <div class="title">Your Purchase Info </div>-->
            <!--        <div class="info">-->
            <!--            <div class="row">-->
            <!--                <div class="col-7">-->
            <!--                    <span id="heading">Date</span><br>-->
            <!--                    <span id="details"><?= date('d, M Y') ?></span>-->
            <!--                </div>-->
            <!--                <div class="col-5 pull-right">-->
            <!--                    <span id="heading">Order No.</span><br>-->
            <!--                    <span id="details"><?= $orders['order_id'] ?></span>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="pricing">-->
            <!--            <?php-->
            <!--            if ($itemDetails) {-->
            <!--                $i = 0;-->
            <!--                foreach ($itemDetails as $all) {-->

            <!--            ?>-->
            <!--                    <div class="row">-->
            <!--                        <div class="col-9">-->
            <!--                            <span id="name"><?= $all['product_name'] ?> (Qty: <?= $all['no_of_items'] ?>)</span>-->
            <!--                        </div>-->
            <!--                        <div class="col-3">-->
            <!--                            <span id="price">Rs. <?= $all['booking_price']+$all['gst_amt'] ?></span>-->
            <!--                        </div>-->
            <!--                    </div>-->

            <!--                <?php-->
            <!--                }-->
            <!--            } else {-->
            <!--                ?>-->

            <!--            <?php-->
            <!--            }-->
            <!--            ?>-->


            <!--        </div>-->
            <!--        <div class="total">-->
            <!--            <div class="row">-->
            <!--                <div class="col-9"></div>-->
            <!--                <div class="col-3"><big><?= 'Rs. '. $orders['final_amount'] ?></big></div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="tracking">-->
            <!--            <div class="title">Tracking Order</div>-->
            <!--        </div>-->
            <!--        <div class="progress-track">-->
            <!--            <ul id="progressbar">-->
            <!--                <li class="step0 active " id="step1">Ordered</li>-->
            <!--                <li class="step0 text-center" id="step2">Shipped</li>-->
            <!--                <li class="step0 text-right" id="step3">On the way</li>-->
            <!--                <li class="step0 text-right" id="step4">Delivered</li>-->
            <!--            </ul>-->
            <!--        </div>-->


            <!--        <div class="footer">-->
            <!--            <div class="row d-flex justify-content-center">-->
            <!--                <div class="col-10 text-center">Estimated Delivery : Within 7 to 14 working days</div>-->
            <!--            </div>-->


            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            <div class="col-lg-12">
                <div class="coming-content text-center mt-3">
                    

                    <div class="coming-social">
                        <a href="<?= base_url('product') ?>" class="btn btn-priamry" style="margin-bottom:12px">Continue Shopping</a>
                        <a href="<?= base_url('orders') ?>" class="btn btn-success" style="margin-bottom:12px">View Orders </a>
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