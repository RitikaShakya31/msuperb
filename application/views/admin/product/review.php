<?php $this->load->view('admin/template/header', $title); ?>
<style>
    .dots-menu {
        cursor: pointer;
        font-size: 20px;
        font-weight: bold;
        display: inline-block;
        user-select: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: -111px;
        /* Adjust for alignment */
        top: 10px;
        /* Adjust for vertical spacing */
        background-color: #f9f9f9;
        min-width: 140px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 10px 15px;
        text-decoration: none;
        display: block;
        font-size: 12px;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Review Message</th>
                                        <th>Rating </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($review) {
                                        $i = 0;
                                        foreach ($review as $item) {
                                            $i = $i + 1;
                                            $id = encryptId($item['id']);
                                            ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= dateConvertToView($item['create_date']) ?></td>
                                                <td><?= $item['name'] ?></td>
                                                <td><?= $item['review'] ?></td>
                                                <td><?= $item['rating'] ?><i style="color:#dcaa29;" class="fa fa-star" aria-label="false"></i></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/template/footer'); ?>
