<?php $this->load->view('includes/header'); ?>
<section class="single-banner">
    <div class="container">
        <h2>Our Labs</h2>
    </div>
</section>
<!-- Search Form -->
<form action="<?= base_url('nearest-lab'); ?>" method="get" class="product-form">
    <input placeholder="Search nearest lab..." type="text" name="searchbox" id="browser"
        value="<?= isset($search) ? htmlspecialchars($search, ENT_QUOTES, 'UTF-8') : ''; ?>" required>
    <button type="submit"><i class="fas fa-search"></i></button>
</form>
<!-- Labs Data -->
<div class="row lab-slider justify-content-center">
    <?php if (!empty($labsData)) { ?>
        <?php foreach ($labsData as $row) { ?>
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
                        <!-- <a
                            href="<?= base_url('test-details/' . encryptId($row['product_id']) . '/' . url_title($row['product_name'], 'dash', true)); ?>"> -->
                            
                            <?= htmlspecialchars($row['sub_category_name'], ENT_QUOTES, 'UTF-8'); ?>
                        <!-- </a> -->
                    </h6>
                    <ul class="review-rating">
                        <li class="icofont-ui-rating">
                        </li>
                        <li class="icofont-ui-rating">
                        </li>
                        <li class="icofont-ui-rating">
                        </li>
                        <li class="icofont-ui-rating">
                        </li>
                        <li class="icofont-ui-rating">
                        </li>
                    </ul>
                    <h6 class="lab-location mb-1">
                        <span><?= htmlspecialchars($row['lab_location'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </h6>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No lab available</p>
    <?php } ?>
</div>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>