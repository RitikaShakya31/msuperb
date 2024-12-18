<?php $this->load->view('includes/header'); ?>
<section class="inner-section single-banner" style="background: url(images/single-banner.jpg) no-repeat center;">
    <div class="container">
        <h2><?= $blog['title']; ?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Blog view</li>
        </ol>
    </div>
</section>
<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <img src="<?= setImage($blog['cover_image'], 'upload/blog/') ?>" alt="<?= $blog['title']; ?>" style="width:100%">
                <p class="details-desc p-2">
                    <?= $blog['description']  ?>
                </p>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>

</body>

</html>