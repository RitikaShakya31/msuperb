<?php $this->load->view('includes/header'); ?>


<section class="user-form-part">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                <div class="user-form-card">
                    <div class="user-form-title">
                        <h2>worried?</h2>
                        <p>No Problem! Just Follow The Simple Way</p>

                        <?php if ($this->session->userdata('forget') != '') { ?>
                        <?= $this->session->userdata('forget'); ?>
                        <?php  }
                        $this->session->unset_userdata('forget');?>
                    </div>
                    <form class="user-form" method="post">
                        <div class="form-group"><input type="email" name="email" class="form-control" placeholder="Enter your email"></div>
                        <div class="form-button"><button type="submit">get Password</button></div>
                    </form>
                </div>
                <div class="user-form-remind">
                    <p>Go Back To<a href="<?= base_url('login') ?>">login here</a></p>
                </div>
               
            </div>
        </div>
    </div>
</section>


<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>


</body>

</html>