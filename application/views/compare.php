<?php $this->load->view('includes/header'); ?>
<section class="inner-section single-banner" style="background: url(images/single-banner.jpg) no-repeat center;">
    <div class="container">
        <h2>Compare With Other Lab</h2>
    </div>
</section>
<table style="margin: 0 auto; margin-bottom: 3rem; border: 1px solid #ddd; border-collapse: collapse; width: 50%;">
    <thead>
        <!-- Optional header if needed -->
    </thead>
    <tbody>
        <?php
        // Fetch all services related to the product_name
        $allServices = $this->CommonModel->getRowByMoreId('product', ['product_name' => $product['product_name']]);

        // Initialize arrays to store product details for side-by-side comparison
        $labNames = [];
        $testNames = [];
        $prices = [];

        foreach ($allServices as $service) {
            // Fetch sub-category name and test name dynamically for each service
            $testname = $this->CommonModel->getSingleRowById('sub_category', ['sub_category_id' => $service['sub_category_id']]);
            $test = $this->CommonModel->getSingleRowById('all_service', ['service_id' => $service['product_name']]);

            // Store product details
            $labNames[] = $testname['sub_category_name'] ?? 'N/A';
            $testNames[] = $test['service_name'] ?? 'N/A';
            $prices[] = $service['sale_price'] ?? 'N/A';
        }
        ?>

        <!-- Lab Name Row -->
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; color: #0b5286; font-weight: 600;">Lab Name</td>
            <?php foreach ($labNames as $labName): ?>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $labName ?></td>
            <?php endforeach; ?>
        </tr>

        <!-- Test Name Row -->
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; color: #0b5286; font-weight: 600;">Test Name</td>
            <?php foreach ($testNames as $testName): ?>
                <td style="padding: 8px; border: 1px solid #ddd;"><?= $testName ?></td>
            <?php endforeach; ?>
        </tr>

        <!-- Reporting Time Row -->
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; color: #0b5286; font-weight: 600;">Reporting Time</td>
            <?php foreach ($allServices as $service): ?>
                <td style="padding: 8px; border: 1px solid #ddd;">On Time</td>
            <?php endforeach; ?>
        </tr>

        <!-- Report Accuracy Row -->
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; color: #0b5286; font-weight: 600;">Report Accuracy</td>
            <?php foreach ($allServices as $service): ?>
                <td style="padding: 8px; border: 1px solid #ddd;">90%</td>
            <?php endforeach; ?>
        </tr>

        <!-- Service Rating Row -->
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; color: #0b5286; font-weight: 600;">Service Rating</td>
            <?php foreach ($allServices as $service): ?>
                <td style="padding: 8px; border: 1px solid #ddd;">4 star</td>
            <?php endforeach; ?>
        </tr>

        <!-- Total Row -->
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; color: #0b5286; font-weight: 600;">Total</td>
            <?php foreach ($prices as $price): ?>
                <td style="padding: 8px; border: 1px solid #ddd;">₹<?= $price ?></td>
            <?php endforeach; ?>
        </tr>
        <!-- Action Row -->
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd; color: #0b5286; font-weight: 600;">Action</td>
            <?php foreach ($allServices as $service): ?>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    <?php
                    if ($this->session->has_userdata('login_user_id')):
                        ?>
                        <button class="book-now addCart crtbtn-<?= $service['product_id'] ?>"
                            data-id="<?= $service['product_id'] ?>" title="Add to Cart">
                            <span>Book Now</span>
                        </button>
                        <?php
                    else:
                        ?>
                        <button class="book-now bookButton"  title="Add to Cart">
                            <span>Book Now</span>
                        </button>
                    <?php endif; ?>

                </td>
            <?php endforeach; ?>
        </tr>
    </tbody>
</table>

<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('.bookButton').click(function () {
            $('#exampleModal').modal('show'); // Open modal
        });
    });
</script>
</body>

</html>