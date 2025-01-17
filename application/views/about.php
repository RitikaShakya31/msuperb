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
                    <img src="<?= $setting[2]['particular_value'] ?>" alt="about"
                        style="width:100%;border-radius: 28px;">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about-choose pb-65">
    <div class="container">
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




<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>

</body>

</html>