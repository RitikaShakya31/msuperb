<?php $this->load->view('includes/header'); ?>
<?php $server_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
<style>
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
                    <button class="product-add  addCart  crtbtn-<?= $product['product_id'] ?>"
                        data-id="<?= $product['product_id'] ?>" title="Add to Cart"><span>add to cart</span></button>
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
                    <li class="review-item">
                        <div class="review-media">
                            <a class="review-avatar" href="#"><img src="<?= base_url('assets/images/user.png')?>" alt="review" /></a>
                            <h5 class="review-meta">
                                <a href="#">miron mahmud</a><span>June 02, 2020</span>
                            </h5>
                        </div>
                        <ul class="review-rating">
                            <li class="icofont-ui-rating"></li>
                            <li class="icofont-ui-rating"></li>
                            <li class="icofont-ui-rating"></li>
                            <li class="icofont-ui-rating"></li>
                            <li class="icofont-ui-rate-blank"></li>
                        </ul>
                        <p>
                            Lorem ipsum dolor sit 
                        </p>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Right Column (Review Form) -->
        <div class="col-lg-6">
            <div class="product-details-frame">
                <h3 class="frame-title">add your review</h3>
                <form class="review-form">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="star-rating">
                                <input type="radio" name="rating" id="star-1" /><label for="star-1"></label>
                                <input type="radio" name="rating" id="star-2" /><label for="star-2"></label>
                                <input type="radio" name="rating" id="star-3" /><label for="star-3"></label>
                                <input type="radio" name="rating" id="star-4" /><label for="star-4"></label>
                                <input type="radio" name="rating" id="star-5" /><label for="star-5"></label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name" required/>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Message"></textarea>
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
<div class="row suggest-slider justify-content-center mb-5">
    <?php
    if ($dailypro != '') {
        foreach ($dailypro as $row) {
            product($row, "product", "double");
        }
    } else {
        echo 'No tests available';
    }
    ?>
</div>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
</body>

</html>