<?php $this->load->view('includes/header'); ?>
<section class="inner-section single-banner" style="background: url(images/single-banner.jpg) no-repeat center;">
    <div class="container">
        <h2>Compare With Other Lab</h2>
    </div>
</section>
<table style="margin: 0 auto;margin-bottom:3rem;">
    <thead>
        <tr>
            <th>Lab Name</th>
            <th>Test Name</th>
            <th>Reporting Time</th>
            <th>Report Accuracy</th>
            <th>Service Rating</th>
            <th>Total </th>
            <th>Book</th>
        </tr>
    </thead> 
    <tbody>
        <?php 
        $brand = $product['category_id'];
        $brandname = $this->CommonModel->getSingleRowById('category', ['category_id' => $brand]);
        ?>
        <tr>
            <td><?= $brandname['category_name'] ?></td>
            <td><?= $product['product_name']?></td>
            <td> Ritika</td>
            <td> Ritika</td>
            <td> Ritika</td>
            <td> Ritika</td>
            <td> Ritika</td>
        </tr>
    </tbody>
</table>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</body>

</html>