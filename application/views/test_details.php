<?php $this->load->view('includes/header'); ?>
<?php $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<style>
    .form-control {
        border: 1px solid #110c0c5e !important;
        padding: 18px !important;
    }

    .labl {
        display: block;
    }

    .labl>input {
        visibility: hidden;
        position: absolute;
    }

    .labl>input+div {
        cursor: pointer;
        border: 2px solid transparent;
        border: 1px dashed #2e531f61;
    }

    .labl>input:checked+div {
        background-color: #39ab4a;
        border: 1px solid#39ab4a;
    }

    .del-text {
        color: #333;
    }

    .labl>input:checked+div .sale-text {
        color: #fff;
    }

    .labl>input:checked+div .del-text {
        color: #b7b7b7;
    }

    .labl>input:checked+div .product-btn-des {
        color: #e9e9e9;
    }

    .radio-header {
        background: #fff;
    }

    .radio-header h6 {
        font-size: 13px;
        line-height: 19px;
        font-weight: 500;
        color: #2e531f !important;
    }

    .sale-text {
        color: #0a5385;
        font-size: 21px;
        font-weight: 700;
        padding-left: 10px;
    }

    .radio-footer {
        background: #ffffff;
    }

    .radio-footer h6 {
        font-size: 17px;
        font-weight: 500;
        color: #2e531f !important;
    }

    .mybox-sahdow {
        box-shadow: rgba(0, 0, 0, 0.12) 0px 1px 3px, rgba(0, 0, 0, 0.24) 0px 1px 2px;
    }

    .product-btn-des {
        font-size: 13px;
        line-height: 20px;
    }

    .labl>input:checked+div .sale-text {
        color: #fff;
    }
</style>
<section class="inner-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="details-gallery">
                    <ul class="details-preview">
                        <?php
                        $i = 0;
                        if ($products_image) {
                            foreach ($products_image as $img) {
                                $i = $i + 1;
                                ?>
                                <li style="z-index:0 !important">
                                    <img src="<?= setImage($img['image_path'], 'upload/product/') ?>"
                                        alt="<?= $details['product_name']; ?>" class="zoomable__img" />
                                </li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <img style="width: 100%;" src="<?= setImage(@$category['banner'], 'upload/category/') ?>"
                    alt="Category">
                <div class="details-content">
                    <p class="details-desc"><?= $product['description']; ?></p>
                    <h5 class="text-primary ">
                        <span class="sale-text">Rs. <?= $product['sale_price'] ?> /-</span>
                        <del class="del-text">Rs. <?= $product['market_price'] ?></del>
                    </h5>
                    <!-- <button class="product-add  addCart  crtbtn-<?= $product['product_id'] ?>"
                        data-id="<?= $product['product_id'] ?>" title="Add to Cart"><span>add to cart</span></button> -->
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <!-- Left Column (Reviews) -->
        <div class="col-lg-6">
            <div class="product-details-frame-left">
                <ul class="review-list">
                    <?php
                    if ($review) {
                        foreach ($review as $row) {
                            ?>
                            <li class="review-item">
                                <div class="review-media">
                                    <a class="review-avatar" href="#">
                                        <img src="<?= base_url('assets/images/user.png') ?>" alt="review" />
                                    </a>
                                    <h5 class="review-meta">
                                        <a href="#"><?= $row['name'] ?></a>
                                        <span><?= dateConvertToView($row['create_date']) ?></span>
                                    </h5>
                                </div>
                                <ul class="review-rating" style="padding-left:14%;">
                                    <?php
                                    // Assuming $row['rating'] contains the rating value (1 to 5)
                                    $rating = $row['rating'];
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<li class="icofont-ui-rating"></li>'; // Filled star
                                        } else {
                                            echo '<li class="icofont-ui-rate-blank"></li>'; // Blank star
                                        }
                                    }
                                    ?>
                                </ul>
                                <p style="padding-left:14%;"><?= $row['review'] ?></p>
                            </li>
                            <?php
                        }
                    } else {
                        echo 'no reviews available';
                    }
                    ?>

                </ul>
            </div>
        </div>
        <!-- Right Column (Review Form) -->
        <div class="col-lg-6">
            <div class="product-details-frame">
                <?php if ($this->session->userdata('msg') != '') { ?>
                    <?= $this->session->userdata('msg'); ?>
                <?php }
                $this->session->unset_userdata('msg'); ?>
                <h3 class="frame-title">add your review</h3>
                <form class="review-form" method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="star-rating">
                                <input type="radio" name="rating" value="5" id="star-1" /><label for="star-1"></label>
                                <input type="radio" name="rating" value="4" id="star-2" /><label for="star-2"></label>
                                <input type="radio" name="rating" value="3" id="star-3" /><label for="star-3"></label>
                                <input type="radio" name="rating" value="2" id="star-4" /><label for="star-4"></label>
                                <input type="radio" name="rating" value="1" id="star-5" /><label for="star-5"></label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" required />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea class="form-control" name="review" placeholder="Message"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-inline">
                                <i class="icofont-water-drop"></i><span>drop your review</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<form action="<?= base_url('product') ?>" action="" class="product-form">
    <input placeholder="Search test..." type="text" name="searchbox" list="browsers" id="browser"
        value="<?= isset($search) ? $search : '' ?>" required>
    <datalist id="browsers">
        <?php
        $search = getRowByMoreId('product', array('status' => '1', 'is_delete' => '1'));
        if (!empty($search)) {
            foreach ($search as $search_row) {
                ?>
                <!--<option value="<?= strtoupper($search_row['product_name']); ?>">-->
                <!--	<?= strtoupper($search_row['product_name']); ?>-->
                <!--</option>-->
                <?php
            }
        }
        ?>
    </datalist><button type="submit"><i class="fas fa-search"></i></button>
</form>
<div class="container">
    <div class="row">
        <?php
        if (!empty($dailypro)) {
            foreach ($dailypro as $row) { ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <?php product($row, "product", "double"); ?>
                </div>
                <?php
            }
        } else {
            echo '<div class="col-12 text-center">No test available</div>';
        }
        ?>
    </div>
</div>
<!-- <div class="row suggest-slider justify-content-center mb-5">
    <?php
    if ($dailypro != '') {
        foreach ($dailypro as $row) {
            product($row, "product", "double");
        }
    } else {
        echo 'No tests available';
    }
    ?>
</div> -->
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
</body>

</html>