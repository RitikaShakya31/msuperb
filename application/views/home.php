<?php $this->load->view('includes/header'); ?>
<style>
    .banner-imgs {
        /* height: 490px !important; */
        background-size: contain !important;
    }


    @media (max-width: 991px) {
        .banner-imgs {
            height: 140px !important;
            background-size: cover !important;
        }
    }
</style>
<!-- Button trigger modal -->


<?php if ($this->session->userdata('msg') != '') { ?>
    <?= $this->session->userdata('msg'); ?>
<?php }
$this->session->unset_userdata('msg'); ?>

<section class="home-classic-slider slider-arrow">
    <?php
    if ($banner) {
        $i = 0;
        foreach ($banner as $all) {

            ?>
            <div class="banner-part sliderheight banner-imgs"
                style="background: url(<?= base_url('upload/banner/' . $all['image_path']) ?>) no-repeat center;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-lg-6">
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    } else {
        ?>

        <?php
    }
    ?>
</section>
<section class="section feature-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Our Brand Labs</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center row-cols-xs-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4">
            <?php
            if ($cate != '') {
                foreach ($cate as $row) {
                    // $data = getSingleRowById('product_image', array('product_id' => $row['product_id']));
                    // feature_product($row, "product", "single");
                    ?>
                    <div class="col">
                        <div class="card text-center">
                            <div class="media">
                                <?php if ($row['product_status'] == 2) {
                                    ?>
                                    <div class="label"><label class="label-text feat">Out of stock</label></div>
                                    <?php
                                } else {
                                }
                                ?>
                                <?= (($row['is_bestselling'] == '1') ? '<div class="bestselling-label"><label class="label-text bg-success">Bestselling</label></div>' : '') ?>
                                <a class="image"
                                    href="<?= base_url('product-details/' . encryptId($row['category_id']) . '/' . url_title($row['category_name'])) ?>">
                                    <img src="<?= setImage(@$row['image'], 'upload/category/') ?>" alt="Category" width="100" height="50">
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="name">
                                    <a href="<?= base_url('product-details/' . encryptId($row['category_id']) . '/' . url_title($row['category_name'])) ?>"
                                        class="sagar-ellipse">
                                        <?= $row['category_name']; ?>
                                    </a></h6>
                            </div>
                        </div>
                    </div>

                <?php }
            } else {
                echo 'no category availabe';
            }
            ?>
        </div>
        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="section-btn-25"><a href="<?= base_url('product') ?>" class="btn btn-outline"><i
                            class="fas fa-eye"></i><span>show more</span></a></div>
            </div>
        </div> -->
    </div>
</section>

<section class="about-choose pb-65 ">
    <div class="container">
        <div class="row">
            <div class="col-11 col-md-9 col-lg-7 col-xl-6 mx-auto">
                <div class="section-heading">
                    <h2>Why Us ?</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-boxes"></i> <!-- Font Awesome icon for "Wide Range of Products" -->
                    </div>
                    <div class="choose-text">
                        <h4>Quick Process</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-vials"></i> <!-- Font Awesome icon for "Trusted Diagnostic Services" -->
                    </div>
                    <div class="choose-text">
                        <h4>Accurate Report</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-laptop-medical"></i> <!-- Font Awesome icon for "Online Consultations" -->
                    </div>
                    <div class="choose-text">
                        <h4>Quality Services</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-shipping-fast"></i> <!-- Font Awesome icon for "Order Tracking" -->
                    </div>
                    <div class="choose-text">
                        <h4>Patient Support</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-lock"></i> <!-- Font Awesome icon for "Secure Payments" -->
                    </div>
                    <div class="choose-text">
                        <h4>Secure Payments</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-book-medical"></i> <!-- Font Awesome icon for "Health Blogs and Tips" -->
                    </div>
                    <div class="choose-text">
                        <h4>Health Tips</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="inner-section faq-part">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading">
                    <h2>Frequently Asked Questions</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="faq-parent">

                    <div class="faq-child">
                        <div class="faq-que">
                            <button>What should I do if I have a problem with my order?</button>
                        </div>
                        <div class="faq-ans">
                            <p>If you encounter any issues with your order, please contact our customer support team,
                                and we will resolve it promptly.</p>
                        </div>
                    </div>
                    <div class="faq-child">
                        <div class="faq-que">
                            <button>How can I stay updated on health-related information?</button>
                        </div>
                        <div class="faq-ans">
                            <p>Stay informed by following our blog and subscribing to our newsletter for the latest
                                health tips and product updates.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- <section class="ptb-50">

    <div loading="lazy" data-mc-src="1c1070c3-e56b-4939-b99c-f3aaa731fb53#null"></div>

    <script src="https://cdn2.woxo.tech/a.js#6698ed9e4ff48fbd0a8b57c1" async data-usrc>
    </script>
</section> -->




<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>