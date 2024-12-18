<?php $this->load->view('includes/header'); ?>

<section class="inner-section single-banner">
    <div class="container">
        <h2>Terms And Condition</h2>
    </div>
</section>


<section class="inner-section privacy-part">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div data-bs-spy="scroll" data-bs-target="#scrollspy" data-bs-offset="0" tabindex="0">

                    <?php

                    if (!empty($pp)) {
                        foreach ($pp as $row) {
                    ?>
                            <?= $row['particulars']; ?>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer-link'); ?>

</body>

</html>