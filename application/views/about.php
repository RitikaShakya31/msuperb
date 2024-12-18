<?php $this->load->view('includes/header'); ?>

<section class=" single-banner">
    <div class="container">
        <h2>About Us</h2>
        <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About Us</li>
        </ol> -->
    </div>
</section>

<section class="inner-section about-company pt-50">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content">
                    <h2>Who we are</h2>
                    <p class="text-justify">At Care1, we are dedicated to simplifying healthcare for you. Our mission is
                        to provide easy access to quality healthcare products and services, all in one place. Whether
                        it's medicines, health products, or lab tests, we aim to bring comprehensive health solutions
                        directly to your doorstep. With a user-friendly platform and a wide range of healthcare
                        offerings, we’re making it convenient for you to stay healthy and well-informed.
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-img d-flex justify-content-center">
                    <img src="<?= base_url() ?>assets/img/about-1.png" alt="about" style="width:100%">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-choose pb-65">
    <div class="container">
        <div class="row">
            <div class="col-11 col-md-9 col-lg-7 col-xl-6 mx-auto">
                <div class="section-heading">
                    <h2>Advantages Of Care1 Products</h2>
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
                        <h4>Wide Range of Products</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-vials"></i> <!-- Font Awesome icon for "Trusted Diagnostic Services" -->
                    </div>
                    <div class="choose-text">
                        <h4>Trusted Diagnostic Services</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-laptop-medical"></i> <!-- Font Awesome icon for "Online Consultations" -->
                    </div>
                    <div class="choose-text">
                        <h4>Online Consultations</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-card choose-card-102">
                    <div class="choose-icon">
                        <i class="fas fa-shipping-fast"></i> <!-- Font Awesome icon for "Order Tracking" -->
                    </div>
                    <div class="choose-text">
                        <h4>Order Tracking</h4>
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
                        <h4>Health Blogs and Tips</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-choose pb-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="why-us-points min-h245 mybox-2">
                    <h2>Our Mission</h2>
                    <p class="text-center fs-14">To deliver the best healthcare experience by providing reliable and
                        affordable healthcare products and services, ensuring that everyone has access to quality care
                        at their convenience. </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="why-us-points min-h245 mybox-2">
                    <h2>Our Vision</h2>
                    <p class="text-center fs-14">To become a trusted leader in the healthcare sector, empowering
                        individuals to take control of their health with ease and confidence by offering a seamless
                        digital platform.

                    </p>
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
                    <a href="tel:9999999999999"
                         class="btn btn-white ">
                        <i class="fas fa-headphones"></i><span>Consult Now</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>




<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>

</body>

</html>