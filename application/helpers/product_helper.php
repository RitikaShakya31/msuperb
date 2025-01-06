<?php
function product($row, $ss = 1)
{
    $data = getSingleRowById('product_image', array('product_id' => $row['product_id']));
    // $getPro = getSingleRowById('all_service', ['service_id' => $row['product_name']]);
    ?>
    <div class="product-card d-flex flex-column justify-content-between">
        <div class="product-media">
            <?= (($row['is_bestselling'] == '1') ? '<div class="bestselling-label"><label class="label-text bg-success">Bestselling</label></div>' : '') ?>
        </div>
        <div class="product-content" style="border:none;">
            <h6 class="product-name"><a
                    href="<?= base_url('test-details/' . encryptId($row['product_id']) . '/' . url_title($row['product_name'], 'dash', true)) ?>">
                    <?= $row['product_name']; ?>
                </a></h6>
            <h6 class="product-price mb-1"><span>₹
                    <?= $row['sale_price']; ?><small></small>
                </span></h6>
            <div class="product-action d-none">
                <button class="action-minus" title="Quantity Minus" data-rowid="<?= $row['product_id'] ?>"
                    data-type="sidecart"><i class="icofont-minus"></i></button>
                <input class="action-input" title="Quantity Number" id="qtysidecart<?= $row['product_id'] ?>" type="text"
                    name="quantity" value="1">
                <button class="action-plus" title="Quantity Plus" data-rowid="<?= $row['product_id'] ?>"
                    data-type="sidecart"><i class="icofont-plus"></i></button>
            </div>
            <div class="row" style="justify-content: center;">
                <a href="<?= base_url('test-details/' . encryptId($row['product_id']) . '/' . url_title($row['product_name'], 'dash', true)) ?>"" class="
                    col-md-6 mt-2 product-add" title="Know More"><span>know more</span></a>
                <button class="col-md-6 mt-2 product-add  addCart  crtbtn-<?= $row['product_id'] ?>"
                    data-id="<?= $row['product_id'] ?>" title="Add to Cart"><span>add
                        to cart</span></button>
            </div>
        </div>
    </div>
    <?php
}
function product_portrait($row)
{
    ?>
    <div class="col">
        <div class="product-card">
            <div class="product-media">
                <div class="product-label"><label class="label-text sale">sale</label></div><button
                    class="product-wish wish"><i class="fas fa-heart"></i></button><a class="product-image" href="#"><img
                        src="images/product/01.jpg" alt="product"></a>
                <div class="product-widget"><a title="Product Compare" href="compare.html" class="fas fa-random"></a><a
                        title="Product Video" href="https://youtu.be/9xzcVxSBbG8" class="venobox fas fa-play"
                        data-autoplay="true" data-vbtype="video"></a><a title="Product View" href="#" class="fas fa-eye"
                        data-bs-toggle="modal" data-bs-target="#product-view"></a></div>
            </div>
            <div class="product-content">
                <div class="product-rating"><i class="active icofont-star"></i><i class="active icofont-star"></i><i
                        class="active icofont-star"></i><i class="active icofont-star"></i><i class="icofont-star"></i><a
                        href="#">(3)</a></div>
                <h6 class="product-name"><a href="#">fresh green chilis</a></h6>
                <h6 class="product-price"><del>$34</del><span>$28<small>/piece</small></span></h6><button
                    class="product-add" title="Add to Cart"><i class="fas fa-shopping-basket"></i><span>add</span></button>
            </div>
        </div>
    </div>
    <?php
}
function feature_product($row, $type = "product", $button = 'single')
{
    $data = getSingleRowById('product_image', array('product_id' => $row['product_id']));
    ?>
    <div class="col">
        <div class="<?= $type ?>-card">
            <div class="<?= $type ?>-media">
                <?php if ($row['product_status'] == 2) {
                    ?>
                    <div class="<?= $type ?>-label"><label class="label-text feat">Out of stock</label></div>
                    <?php
                } else {
                }
                ?>
                <?= (($row['is_bestselling'] == '1') ? '<div class="bestselling-label"><label class="label-text bg-success">Bestselling</label></div>' : '') ?>
                <a class="<?= $type ?>-image"
                    href="<?= base_url('product-details/' . encryptId($row['product_id']) . '/' . url_title($row['product_name'])) ?>">
                    <img src="<?= setImage(@$data['image_path'], 'upload/product/') ?>" alt="product">
                </a>
            </div>
            <div class="<?= $type ?>-content">
                <h6 class="<?= $type ?>-name"><a
                        href="<?= base_url('product-details/' . encryptId($row['product_id']) . '/' . url_title($row['product_name'])) ?>"
                        class="sagar-ellipse">
                        <?= $row['product_name']; ?>
                    </a></h6>
            </div>
        </div>
    </div>
    <?php
}

?>