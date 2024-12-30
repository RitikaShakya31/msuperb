<?php $this->load->view('admin/template/header', $title); ?>
<?php $id = $this->input->get('id'); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 "><?= $title ?></h2>
                    </div>
                </div>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <div class="row">
                                            <label class="col-sm-3 control-label">Brand</label>
                                            <div class="col-sm-12">
                                                <select class="form-control select" name="category_id"
                                                    onchange="getCategory(this.value)" disabled> 
                                                    <option value="" disabled> Select Brand</option>
                                                    <?php
                                                    $c = getRowsByMoreIdWithOrder('category', "is_delete = '1'", "category_name", 'ASC');
                                                    foreach ($c as $cate) {
                                                        ?>
                                                        <option value="<?= $cate['category_id'] ?>" <?php if ($category_id == $cate['category_id']) {
                                                              echo 'selected';
                                                          } ?> >
                                                            <?= ucwords($cate['category_name']) ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="row">
                                            <label class="col-sm-12 control-label">Laboratory</label>
                                            <div class="col-sm-12">
                                                <select class="form-control select" name="sub_category_id"
                                                    data-placeholder="Select sub category" id="sub_category" disabled>
                                                    <?php
                                                    $subCate = getRowsByMoreIdWithOrder('sub_category', "category_id = '$category_id' AND is_delete = '1'", 'sub_category_name', 'ASC');
                                                    foreach ($subCate as $c) {
                                                        ?>
                                                        <option value="<?= $c['sub_category_id'] ?>"
                                                            <?= $c['sub_category_id'] == $sub_category_id ? 'selected' : '' ?>>
                                                            <?= $c['sub_category_name'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-12 col-form-label">Test
                                                Name</label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="product_name" disabled>
                                                    <option value="">Select Test</option>
                                                    <?php if ($services) {
                                                        foreach ($services as $service) { ?>
                                                            <option value="<?= $service['service_id'] ?>">
                                                                <?= $service['service_name'] ?>
                                                            </option>
                                                        <?php }
                                                    } ?>
                                                </select>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4 mb-3 d-none">
                                        <div class="row">
                                            <label for="example-text-input"
                                                class="col-md-12 col-form-label"><br></label>
                                            <div class="col-md-12">
                                                <input type="checkbox" name="is_bestselling" value="1"
                                                    <?= ($is_bestselling == 1) ? 'checked' : '' ?> readonly/> Is Best selling ?

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3 ">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-12 col-form-label">Market
                                                Price</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="number" name="market_price" required
                                                    value="<?= $market_price ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-12 col-form-label">Sale
                                                Price</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="number" name="sale_price" required
                                                    value="<?= $sale_price ?>" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 mb-3 d-none">
                                        <div class="row">
                                            <label for="example-text-input"
                                                class="col-md-12 col-form-label">Quantity</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="number" name="quantity"
                                                    value="<?= $quantity ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3 d-none">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-12 col-form-label">Quantity
                                                Type</label>
                                            <div class="col-md-12">
                                                <select name="quantity_type" class="form-select" readonly>
                                                    <option value="">Select Type</option>
                                                    <option value="gm" <?= $quantity_type == 'gm' ? 'selected' : '' ?>>gm
                                                    </option>
                                                    <option value="kg" <?= $quantity_type == 'kg' ? 'selected' : '' ?>>kg
                                                    </option>
                                                    <option value="leter" <?= $quantity_type == 'leter' ? 'selected' : '' ?>>leter</option>
                                                    <option value="ml" <?= $quantity_type == 'ml' ? 'selected' : '' ?>>ml
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12  mb-3">
                                        <div class="row">
                                            <label for="example-text-input"
                                                class="col-md-12 col-form-label">Description</label>
                                            <div class="col-md-12">
                                                <textarea name="description" style="width: 100%;" id="editor"
                                                    rows="10" readonly><?= $description ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-3 ">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-12 col-form-label">SEO
                                                title</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="seo_title" required
                                                    value="<?= $seo_title ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12  mb-3 ">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-12 col-form-label">SEO
                                                description</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="seo_description" required
                                                    value="<?= $seo_description ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12  mb-3 ">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-12 col-form-label">SEO
                                                Keywords</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" name="seo_keyword" required
                                                    value="<?= $seo_keyword ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="col-lg-4 mb-3">-->
                                    <!--    <label style="color: gray">Note:- Image Size 600X400</label>-->
                                    <!--    <div class="row">-->
                                    <!--        <label for="example-text-input" class="col-md-12 col-form-label">Product Image</label>-->
                                    <!--        <div class="col-md-12">-->
                                    <!--            <input type="file" class="form-control image" multiple <?= isset($id) ? '' : 'required' ?> name="image[]">-->
                                    <!--        </div>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="col-lg-4 mb-3 d-none">
                                        <label style="color: gray">Note:- Image Size 600X400</label>
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-12 col-form-label">Test
                                                Image</label>
                                            <div class="col-md-12">
                                                <input type="file" class="form-control image" multiple <?= isset($id) ? '' : 'required' ?> name="image[]">

                                                <?php if (!empty($file_error)): ?>
                                                    <div class="alert alert-danger"><?php echo $file_error; ?></div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4  mb-3">
                                        <div class="gallery"></div>
                                    </div>
                                    <!-- <div class="col-lg-12  mb-3">

                                        <button id="rowAdder" type="button" class="btn btn-dark">
                                            <span class="fa fa-plus">
                                            </span> Add variant here
                                        </button>
                                        <div id="row" class="row p-1 mb-3">
                                            <div class="col-md-12 p-1 text-primary">Variant #</div>
                                            <div class="col-md-3 p-1">
                                                <input type="text" name="variant_product_title[]" placeholder="Variant title" class="form-control m-input">
                                                <input type="hidden" name="variant_product_id[]" value="">
                                            </div>
                                            <div class="col-md-3 p-1">
                                                <input type="text" name="variant_market_price[]" placeholder="Market Price" class="form-control m-input">
                                            </div>
                                            <div class="col-md-3 p-1">
                                                <input type="text" name="variant_sale_price[]" placeholder="Sale price" class="form-control m-input">
                                            </div>

                                            <div class="col-md-3 p-1">
                                                <input type="text" name="variant_tag[]" placeholder="tag" class="form-control m-input">
                                            </div>
                                            <div class="col-md-10 p-1">
                                                <input type="text" name="variant_product_description[]" placeholder="Product Description" class="form-control m-input">
                                            </div>
                                            <div class="col-md-1 p-1">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-danger" id="DeleteRow" type="button">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="newinput">
                                            <?php
                                            if (isset($id)) {
                                                if ($variant) {
                                                    foreach ($variant as $variant_details) {
                                                        $id = encryptId($variant_details['id']);
                                                        ?>
                                                        <div class="row p-1 mb-3" id="variant<?= $variant_details['id'] ?>">
                                                            <div class="col-md-12 p-1 text-primary">Variant #<?php echo $variant_details['id'] ?></div>
                                                            <div class="col-md-3 p-1">
                                                                <input type="text" name="variant_product_title[]" placeholder="Variant title" class="form-control m-input" value="<?php echo $variant_details['product_title'] ?>">
                                                                <input type="hidden" name="variant_product_id[]" value="<?php echo $variant_details['id'] ?>">
                                                            </div>
                                                            <div class="col-md-3 p-1">
                                                                <input type="text" name="variant_market_price[]" placeholder="Market Price" class="form-control m-input" value="<?php echo $variant_details['market_price'] ?>">
                                                            </div>
                                                            <div class="col-md-3 p-1">
                                                                <input type="text" name="variant_sale_price[]" placeholder="Sale price" class="form-control m-input" value="<?php echo $variant_details['sale_price'] ?>">
                                                            </div>

                                                            <div class="col-md-3 p-1">
                                                                <input type="text" name="variant_tag[]" placeholder="tag" class="form-control m-input" value="<?php echo $variant_details['tag'] ?>">
                                                            </div>
                                                            <div class="col-md-10 p-1">
                                                                <input type="text" name="variant_product_description[]" placeholder="Product Description" class="form-control m-input" value="<?php echo $variant_details['product_description'] ?>">
                                                            </div>
                                                            <div class="col-md-1 p-1">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-danger delete_variant" data-id="<?php echo $variant_details['id'] ?>" type="button">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div> -->
                                 
                                </div>
                            </div>
                            <!-- <div class="text-center">
                                <button type="submit" id="save" class="btn btn-primary w-md">Save</button>
                            </div> -->
                            <br />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php $this->load->view('admin/template/footer'); ?>
<script>
    $(document).ready(function () {
        initSample();
    });
</script>