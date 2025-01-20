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
        style="background: url(<?= $setting[0]['particular_value'] ?>) no-repeat center; height: 515px; position: relative; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-12">
                    <!-- Button inside the banner -->
                    <div class="upload-prescription-btn d-flex justify-content-center">
                        <a href="#" class="btn prescription" data-bs-toggle="modal" data-bs-target="#prescriptionModal">
                            <i class="fa fa-upload"></i>
                            Upload Prescription
                        </a>
                        <a href="#" class="btn btn-warning home-visit" data-bs-toggle="modal"
                            data-bs-target="#bookHomeVisitModal">
                            <i class="fa fa-home"></i>
                            Book a Home Visit
                        </a>
                        
                        <?php
                        if ($this->session->has_userdata('login_user_id')):
                            ?>
                        <a href="<?= base_url('track-health') ?>" id="trackButton" class="btn track-health-btn">
                            <i class="fa fa-medkit"></i>
                            Track Health
                        </a>
                            <?php
                        else:
                            ?>
                          <a href="javascript:void(0);" id="trackButton" class="btn track-health-btn">
                            <i class="fa fa-medkit"></i>
                            Track Health
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
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
<section class="about-choose pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="why-us-points min-h245 mybox-2">
                    <h2>Our Mission</h2>
                    <div class="middle-white-line"></div>
                    <p class="text-center fs-14">To deliver the best healthcare experience by providing reliable and
                        affordable healthcare products and services, ensuring that everyone has access to quality care
                        at their convenience. </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="why-us-points min-h245 mybox-2">
                    <h2>Our Vision</h2>
                    <div class="middle-white-line"></div>
                    <p class="text-center fs-14">To become a trusted leader in the healthcare sector, empowering
                        individuals to take control of their health with ease and confidence by offering a seamless
                        digital platform.

                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="about-choose pb-65 ">
    <div class="container">
        <div class="row">
            <div class="col-11 col-md-9 col-lg-7 col-xl-6 mx-auto">
                <div class="section-heading">
                    <h2>Why Us ?</h2>
                    <div class="middle-line"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="choose-text">
                        <h4>Quick Process</h4>
                        <p>Fast Sample Collection, Get tested at our lab or from the comfort of your home with our
                            expert phlebotomists</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-vials"></i>
                    </div>
                    <div class="choose-text">
                        <h4>Accurate Report</h4>
                        <p>We ensure precise and reliable test results with advanced technology and expert analysis.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-laptop-medical"></i>
                    </div>
                    <div class="choose-text">
                        <h4>Quality Services</h4>
                        <p> We provide top-notch pathology services with expert care and advanced technology.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="choose-text">
                        <h4>Patient Support</h4>
                        <p>Our dedicated team is always available to assist you with queries, guidance, and seamless
                            healthcare experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="choose-text">
                        <h4>Secure Payments</h4>
                        <p> We offer safe, encrypted, and hassle-free payment options for a smooth and worry-free
                            transaction experience.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-book-medical"></i>
                    </div>
                    <div class="choose-text">
                        <h4>Health Tips</h4>
                        <p>Get expert advice and personalized health tips to help you maintain a healthy lifestyle and
                            prevent illnesses.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section countdown-part"
    style="background-image: url('assets/images/bg-2.png');background-size: cover; background-position: top;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-8">
                <div class="countdown-content">
                    <h3 style="color:#ffff;">Feeling confused? Let us help you find the perfect solution.</h3>
                    <!-- <p>Reprehenderit sed quod autem molestiae aut modi minus veritatis iste dolorum suscipit quis
                        voluptatum fugiat mollitia quia minima</p> -->
                    <br>
                    <a href="tel:9999999999999" class="btn btn-white ">
                        <i class="fas fa-headphones"></i><span>Consult Now</span>
                    </a>
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
                    <div class="middle-line"></div>
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