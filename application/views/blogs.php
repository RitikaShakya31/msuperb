<?php $this->load->view('includes/header'); ?>
<section class="inner-section single-banner" style="background: url(images/single-banner.jpg) no-repeat center;">
    <div class="container">
        <h2>Blogs</h2>
    </div>
</section>
<section class="inner-section blog-grid">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row">
                    <?php if (!empty($blog)) {
                        foreach ($blog as $row) {
                    ?>
                            <div class="col-md-3 col-lg-3">
                                <div class="blog-card">
                                    <div class="blog-media"><a class="blog-img" href="<?= base_url('blog_details/' . encryptId($row['id'])) ?>"><img src="<?= base_url() ?>upload/blog/<?= $row['cover_image'] ?>" alt="blog" ></a></div>
                                    <div class="blog-content">
                                        <ul class="blog-meta">
                                            <li><i class="fas fa-user"></i><span>Care1</span></li>
                                            <li><i class="fas fa-calendar-alt"></i><span><?= dateConvertToView($row['create_date'], '1') ?></span></li>
                                        </ul>
                                        <h4 class="blog-title"><a href="<?= base_url('blog_details/' . encryptId($row['id'])) ?>"><?= $row['title'] ?></a></h4>
                                        <p class="blog-desc"><?= character(strip_tags($row['description'])) ?> </p><a class="blog-btn" href="<?= base_url('blog_details/' . encryptId($row['id'])) ?>"><span>Read more</span><i class="icofont-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
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