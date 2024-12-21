<?php $this->load->view('includes/header'); ?>
<section class="inner-section single-banner" style="background: url(images/single-banner.jpg) no-repeat center;">
    <div class="container">
        <h2>Compare With Other Lab</h2>
    </div>
</section>
<table style="margin: 0 auto;margin-bottom:3rem;">
<thead>
    <tr>
        <th>Details</th>
        <th>Values</th>
    </tr>
</thead>
<tbody>
    <?php 
    $brand = $product['category_id'];
    $brandname = $this->CommonModel->getSingleRowById('category', ['category_id' => $brand]);
    ?>
    <tr>
        <td>Lab Name</td>
        <td><?= $brandname['category_name'] ?></td>
    </tr>
    <tr>
        <td>Test Name</td>
        <td><?= $product['product_name'] ?></td>
    </tr>
    <tr>
        <td>Reporting Time</td>
        <td>Ritika</td>
    </tr>
    <tr>
        <td>Report Accuracy</td>
        <td>Ritika</td>
    </tr>
    <tr>
        <td>Service Rating</td>
        <td>Ritika</td>
    </tr>
    <tr>
        <td>Total</td>
        <td>Ritika</td>
    </tr>
    <tr>
        <td>Book</td>
        <td>Ritika</td>
    </tr>
</tbody>
</table>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</body>

</html>