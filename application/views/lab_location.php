<?php $this->load->view('includes/header'); ?>
<section class="single-banner">
    <div class="container">
        <h2>Nearest Labs</h2>
    </div>
</section>
<!-- Search Form -->
<form action="" method="get" class="product-form ">
    <input placeholder="Search nearest lab..." type="text" name="searchbox" id="browser"
        value="<?= (isset($_GET['searchbox']) ? $_GET['searchbox'] : '') ?>" required>
    <button type="submit"><i class="fas fa-search"></i></button>
</form>
<!-- Labs Data -->
<div class="row justify-content-center" style="margin: 20px 0;">
    <?php if (!empty($lab)) { ?>
        <?php foreach ($lab as $row) { ?>
            <div class="col-md-3 col-sm-6 mb-4" style="padding: 15px; box-sizing: border-box;">
                <div class="lab-card"
                    style="border-radius: 8px; padding: 15px; background: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                    <div style="margin-top: 20px;">
                        <h1 style="font-size: 25px;border-bottom: 1px solid #808080b8; margin-bottom: 10px; color: #333;">
                            <a href="<?= base_url('nearest-lab-location/' . encryptId($row['category_id']) . '/' . url_title($row['product_name'], 'dash', true)); ?>"
                                style="text-decoration: none; color: inherit;">
                                <?= htmlspecialchars($row['sub_category_name'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </h1>
                        <h6 class="lab-location mb-1" style="font-size: 14px; color: #555;">
                            <span><?= htmlspecialchars($row['lab_location'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </h6>
                        <a href="tel:<?= $contact['contact_f'] ?>" class="btn btn-success mt-2"><i class="fa fa-phone-alt"
                                aria-hidden="true"></i> Call</a>
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