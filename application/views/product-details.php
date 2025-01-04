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
        color: #fe5f00;
        font-size: 21px;
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
                <img style="width: 100%;border-radius: 45px;" src="<?= setImage(@$category['banner'], 'upload/category/') ?>"
                    alt="Category">
                <div class="details-content">
                    <p class="details-desc"><?= $category['category_description']; ?></p>
                    <div class="details-list-group"><label class="details-list-title">Share:</label>
                        <ul class="details-share-list">
                            <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $server_link ?>&t=<?= $details['product_name']; ?>"
                                    onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                    target="_blank" class="icofont-facebook" title="Facebook"></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/share?url=<?= $server_link ?>&text=<?= $details['product_name']; ?>"
                                    onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                    target="_blank" class="icofont-twitter" title="Twitter"></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $server_link ?>&t=<?= $details['product_name']; ?>"
                                    onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                    target="_blank" class="icofont-linkedin" title="Linkedin"></a>
                            </li>
                            <li>
                                <a href="whatsapp://send?text=<?= $server_link ?>" data-action="share/whatsapp/share"
                                    onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                    target="_blank" title="Share on whatsapp" class="icofont-whatsapp"
                                    title="Whatsapp"><i class="fab fa-whatsapp"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if ($offers != ''): ?>
    <div class="container">
        <h2 class="mb-4 ">Special Offers</h2>
    <div class="row">
        <?php
        if (!empty($offers)) {
            foreach ($offers as $row) { ?>
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
<?php endif; ?>
<div class="container">
    <h2 class="mb-4 ">Health Packages</h2>
    <div class="row">
        <?php
        if (!empty($packagepro)) {
            foreach ($packagepro as $row) { ?>
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
<?php
if ($category['offer'] != '') {
    ?>
    <img style="width: 100%;" src="<?= setImage(@$category['offer'], 'upload/category/') ?>"
        alt="<?= $category['category_name'] ?>">
<?php } else {
} ?>
<form action="<?= base_url('product-details') ?>" method="get" class="product-form">
    <input placeholder="Search test..." type="text" name="searchbox" list="browsers" id="browser"
        value="<?= isset($search) ? $search : '' ?>" required>
    <datalist id="browsers">
        <?php
        $search = getRowByMoreId('product', array('status' => '1', 'is_delete' => '1'));
        if (!empty($search)) {
            foreach ($search as $search_row) {
                ?>
                <?php
            }
        }
        ?>
    </datalist><button type="submit"><i class="fas fa-search"></i></button>
</form>
<div class="container">
    <div class="row">
        <?php
        if (!empty($routinepro)) {
            foreach ($routinepro as $row) { ?>
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
<div class="container mt-5">
<h2 class="mb-4 ">Radiology</h2>
    <div class="row">
        <?php
        if (!empty($radiology)) {
            foreach ($radiology as $row) { ?>
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
</div>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
</body>
</html>