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
            height: 280px !important;
            /* Adjust height for mobile view */
        }
    }
</style>
<!-- Button trigger modal -->
<?php if ($this->session->userdata('msg') != '') { ?>
    <?= $this->session->userdata('msg'); ?>
<?php }
$this->session->unset_userdata('msg'); ?>
<section class="home-banner">
    <div class="banner-part"
        style="background: url(<?= $setting[0]['particular_value'] ?>) no-repeat center; height: 480px; position: relative; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6">
                    <!-- Button inside the banner -->
                    <div class="upload-prescription-btn d-flex justify-content-between" style="">
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#prescriptionModal"
                            style="padding: 10px 20px; font-size: 16px;">
                            <i class="fa fa-file"></i>
                            Upload Prescription
                        </a>
                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#prescriptionModal"
                            style="padding: 10px 15px; font-size: 16px;margin-left: 10px;">
                            <i class="fa fa-file"></i>
                            Book a Home Visit
                        </a>
                    </div>
                </div>  
            </div>
        </div>
    </div>
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
<!-- <section class="section feature-part">
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
</section> -->
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
                    <?php
                    if ($getFaqs):
                        foreach ($getFaqs as $row):
                            ?>
                            <div class="faq-child">
                                <div class="faq-que">
                                    <button class="d-flex align-items-center justify-content-between"><?= $row['question'] ?>
                                        <div><i class="fa fa-plus"></i></div>
                                    </button>
                                </div>
                                <div class="faq-ans">
                                    <p><?= $row['answer'] ?></p>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    endif;
                    ?>
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