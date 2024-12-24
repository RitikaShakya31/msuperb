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
        $brand = $product['category_id'];
        $brandname = $this->CommonModel->getSingleRowById('category', ['category_id' => $brand]);
        ?>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;color: #0b5286;font-weight: 600;">Lab Name</td>
            <!-- <td style="padding: 8px; border: 1px solid #ddd;"><?= $brandname['category_name'] ?></td> -->
            <td style="padding: 8px; border: 1px solid #ddd;">Apolo</td>
            <td style="padding: 8px; border: 1px solid #ddd;">Suburban </td>
            <td style="padding: 8px; border: 1px solid #ddd;">Thyrocare </td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;color: #0b5286;font-weight: 600;">Test Name</td>
            <!-- <td style="padding: 8px; border: 1px solid #ddd;"><?= $product['product_name'] ?></td> -->
            <td style="padding: 8px; border: 1px solid #ddd;">Blood Test</td>
            <td style="padding: 8px; border: 1px solid #ddd;">Blood Test</td>
            <td style="padding: 8px; border: 1px solid #ddd;">Blood Test</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;color: #0b5286;font-weight: 600;">Reporting Time</td>
            <td style="padding: 8px; border: 1px solid #ddd;">On Time</td>
            <td style="padding: 8px; border: 1px solid #ddd;">On Time</td>
            <td style="padding: 8px; border: 1px solid #ddd;">On Time</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;color: #0b5286;font-weight: 600;">Report Accuracy</td>
            <td style="padding: 8px; border: 1px solid #ddd;">90% </td>
            <td style="padding: 8px; border: 1px solid #ddd;">100%</td>
            <td style="padding: 8px; border: 1px solid #ddd;">94%</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;color: #0b5286;font-weight: 600;">Service Rating</td>
            <td style="padding: 8px; border: 1px solid #ddd;">4.5 star</td>
            <td style="padding: 8px; border: 1px solid #ddd;">5 star</td>
            <td style="padding: 8px; border: 1px solid #ddd;">4 star</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;color: #0b5286;font-weight: 600;">Total</td>
            <td style="padding: 8px; border: 1px solid #ddd;">₹200</td>
            <td style="padding: 8px; border: 1px solid #ddd;">₹250</td>
            <td style="padding: 8px; border: 1px solid #ddd;">₹190</td>
        </tr>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;color: #0b5286;font-weight: 600;"></td>
            <td style="padding: 8px;"><button  class="book-now" title="Add to Cart"><span>Book Now</span></button></td>
            <td style="padding: 8px;"><button  class="book-now" title="Add to Cart"><span>Book Now</span></button></td>
            <td style="padding: 8px;"><button  class="book-now" title="Add to Cart"><span>Book Now</span></button></td>
        </tr>
    </tbody>
</table>

<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</body>

</html>