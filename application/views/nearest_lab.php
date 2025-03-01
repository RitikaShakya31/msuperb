<?php $this->load->view('includes/header'); ?>
<section class="single-banner">
    <div class="container">
        <h2>Our Labs</h2>
    </div>
</section>
<!-- Labs Data -->
<div class="row justify-content-center">
    <?php if (!empty($labsData)) { ?>
        <?php foreach ($labsData as $row) { ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="lab-card d-flex flex-column justify-content-between">
                    <div class="product-media">
                        <?php if ($row['is_bestselling'] == '1') { ?>
                            <div class="bestselling-label">
                                <label class="label-text bg-success">Bestselling</label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="product-content" style="border:none;">
                        <h6 class="lab-name">
                            <a href="<?= base_url('nearest-lab-location/' . encryptId($row['category_id']) . '/' . url_title($row['product_name'], 'dash', true)); ?>">
                                <?= htmlspecialchars($row['category_name'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h6>
                        <ul class="review-rating">
                            <li class="icofont-ui-rating"></li>
                            <li class="icofont-ui-rating"></li>
                            <li class="icofont-ui-rating"></li>
                            <li class="icofont-ui-rating"></li>
                            <li class="icofont-ui-rating"></li>
                        </ul>
                        <h6 class="lab-location mb-1">
                            <span><?= htmlspecialchars($row['lab_location'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </h6>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No lab available</p>
    <?php } ?>
</div>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>