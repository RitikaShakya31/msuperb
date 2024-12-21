<?php $this->load->view('includes/header'); ?>
<section class="inner-section single-banner" style="background: url(images/single-banner.jpg) no-repeat center;">
    <div class="container">
        <h2>Test List</h2>
        <!-- <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product List</li>
        </ol> -->
    </div>
</section>
<section class="inner-section shop-part">
    <div class="container">
        <div class="row content-reverse">
            <div class="col-lg-3 d-none">
                <div class="shop-widget-promo">
                    <!-- <a href="#"><img src="assets/images/promo/shop/01.jpg" alt="promo"></a> -->
                </div>
                <div class="shop-widget">
                    <h6 class="shop-widget-title">Filter by Category</h6>
                    <input type="hidden" value="<?= $search ?>" id="search" />
                    <ul class="shop-widget-list shop-widget-scroll">
                        <?php if (!empty($subcategory)) {
                            foreach ($subcategory as $row) {
                                $count = getNumRows('product', array('sub_category_id' => $row['sub_category_id']));
                        ?>
                                <li>
                                    <div class="shop-widget-content">
                                        <input type="checkbox" class="common_selector subcategory" id="subcate<?= $row['sub_category_id'] ?>"
                                            value="<?php echo $row['sub_category_id']; ?>" <?= (($row['sub_category_id'] == $subcateid) ? 'Checked' : '')  ?>>
                                        <label for="subcate<?= $row['sub_category_id'] ?>">
                                            <?= $row['sub_category_name'] ?></label>
                                    </div>
                                    <span class="shop-widget-number">(<?= $count ?? '0' ?>)</span>
                                </li>
                        <?php
                            }
                        }
                        ?>
                </div>
                <div class="shop-widget">
                    <h6 class="shop-widget-title">Filter by Category</h6>
                    <ul class="shop-widget-list shop-widget-scroll">
                        <?php
                        if ($sidecategory != '') {
                            foreach ($sidecategory as $row) {
                                $count = getNumRows('product', array('category_id' => $row['category_id']));
                        ?>
                                <li>
                                    <div class="shop-widget-content">
                                        <input type="checkbox" id="cate<?= $row['category_id'] ?>" class="common_selector category" value="<?php echo $row['category_id']; ?>" <?= (($row['category_id'] == $cateid) ? 'Checked' : '')  ?>>
                                        <label for="cate<?= $row['category_id'] ?>"><?= $row['category_name'] ?></label>
                                    </div>
                                    <span class="shop-widget-number">(<?= $count ?? '0' ?>)</span>
                                </li>
                        <?php
                            }
                        }
                        ?>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="top-filter">

                            <div class="filter-short"><label class="filter-label">Short by :</label>
                                <select class="form-select filter-select" id="ec-price_hm">
                                    <option value="">Select Range</option>
                                    <option value="0">Price, low to high</option>
                                    <option value="1">Price, high to low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-3" id="filter_data">
                <div class="loader-wrapper"><div class="loader"></div></div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        filter_data();

        function filter_data() {
            // Show the loading animation in #filter_data div
            $('#filter_data').html('<div class="loader-wrapper"><div class="loader"></div></div>');

            var action = 'fetch_data';
            var price = $('#ec-price_hm').val();
            var search = $('#search').val();
            var category = get_filter('category');
            var subcategory = get_filter('subcategory');

            $.ajax({
                url: "<?= base_url('UserHome/filterData') ?>",
                method: "POST",
                data: {
                    category: category,
                    subcategory: subcategory,
                    search: search,
                    price: price
                },
                beforeSend: function() {
                    // Optional: You can also set the loading state here again if needed
                    $('#filter_data').html('<div class="loader-wrapper"><div class="loader"></div></div>');
                },
                success: function(data) {
                    // Once data is successfully loaded, replace the loading animation with actual data
                    $('#filter_data').html(data);
                }
            });
        }


        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function() {
                filter.push($(this).val());
            });
            return filter;
        }
        $('.common_selector').click(function() {
            filter_data();
        });
        $('#ec-price_hm').change(function() {
            var price = $('#ec-price_hm').val();

            filter_data();
        });
    });
</script>

</body>

</html>