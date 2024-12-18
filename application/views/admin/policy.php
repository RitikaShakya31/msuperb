<?php $this->load->view('admin/template/header', $title); ?>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Particulars</th>
                                        <th>Action</th>
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($all_data) {
                                        $i = 0;
                                        foreach ($all_data as $all) {
                                            $id = encryptId($all['ppid']);
                                    ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                
                                                <td><?= $all['title_policy'] ?></td>
                                                <td> <a href="<?= base_url("policyedit/$id"); ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                   </td>
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