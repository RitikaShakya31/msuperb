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
    @media (max-width: 576px) {
    .banner-part {
        height: 280px !important; /* Adjust height for mobile view */
    }
}

</style>
<!-- Button trigger modal -->
<?php if ($this->session->userdata('msg') != '') { ?>
    <?= $this->session->userdata('msg'); ?>
<?php }
$this->session->unset_userdata('msg'); ?>
<section class="home-banner">
    <?php
    if ($banner) {
        foreach ($banner as $all) {
            ?>
            <div class="banner-part"
                style="background: url(<?= base_url('upload/banner/' . $all['image_path']) ?>) no-repeat center; height: 480px; position: relative; background-size: cover;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-lg-6">
                            <!-- Button inside the banner -->
                            <div class="upload-prescription-btn"
                                style="position: absolute; bottom: 30px; left: 30%; transform: translateX(-50%); z-index: 10;">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#prescriptionModal"
                                    style="padding: 10px 20px; font-size: 16px;">
                                    <i class="fa fa-file"></i>
                                    Upload Prescription
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        ?>
        <div class="no-banner">
            <p>No banners available.</p>
        </div>
        <?php
    }
    ?>
</section>
<!-- <section class="home-classic-slider slider-arrow">
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
</section> -->
<section class="section feature-part">
    <div class="container">
        <div class="row justify-content-center custom-row-cols">
            <?php
            if ($brand != '') {
                foreach ($brand as $row) {
                    ?>
                    <div class="col custom-col">
                        <div class="card text-center" style="padding: 0px!important;">
                            <div class="media">
                                <?= (($row['is_bestselling'] == '1') ? '<div class="bestselling-label"><label class="label-text bg-success">Bestselling</label></div>' : '') ?>
                                <a class="image"
                                    href="<?= base_url('lab-details/' . encryptId($row['brand_id']) . '/' . url_title($row['brand_name'])) ?>">
                                    <img src="<?= setImage(@$row['brand_logo'], 'upload/category/') ?>" alt="Category" width="80"
                                        height="80" style="object-fit: contain;">
                                </a>
                            </div>
                        </div>
                        <p class="brand-name"><?= $row['brand_name']; ?></p>
                    </div>
                <?php }
            } else {
                echo 'no category available';
            }
            ?>
        </div>
    </div>
</section>
<section class="section feature-part">
    <div class="container">
        <div class="row justify-content-center custom-row-cols">
            <?php
            if ($cate != '') {
                foreach ($cate as $row) {
                    ?>
                    <div class="col custom-col">
                        <div class="card text-center" style="padding: 0px!important;">
                            <div class="media">
                                <?= (($row['is_bestselling'] == '1') ? '<div class="bestselling-label"><label class="label-text bg-success">Bestselling</label></div>' : '') ?>
                                <a class="image"
                                    href="<?= base_url('product-details/' . encryptId($row['category_id']) . '/' . url_title($row['category_name'])) ?>">
                                    <img src="<?= setImage(@$row['image'], 'upload/category/') ?>" alt="Category" width="70"
                                        height="70" style="object-fit: contain;">
                                </a>
                            </div>
                        </div>
                        <p class="brand-name"><?= $row['category_name']; ?></p>
                    </div>
                <?php }
            } else {
                echo 'no category available';
            }
            ?>
        </div>
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
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="choose-text">
                        <h4>Quick Process</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-vials"></i>
                    </div>
                    <div class="choose-text">
                        <h4>Accurate Report</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-laptop-medical"></i> 
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
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>