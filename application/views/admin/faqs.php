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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label for="example-text-input" class="col-form-label">Question</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" name="question" value="<?= @$question ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="example-text-input" class="col-form-label">Answer</label>
                                        <div class="col-md-12">
                                            <textarea class="form-control" name="answer" id="editor" rows="5"><?= @$answer ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" id="save" class="btn btn-primary w-md">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All FAQ's</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $allPromo = getAllRowInOrder('faqs', 'fid', 'DESC');
                                    if ($allPromo) {
                                        $i = 0;
                                        foreach ($allPromo as $all) {
                                            $id = encryptId($all['fid']);
                                    ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= ucwords($all['question']) ?></td>
                                                <td><?= $all['answer'] ?></td>
                                                <td>
                                                    <a href="<?= base_url("addFaqs?faq=$id"); ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                    <a onclick="return confirm('Are you want to sure?')" href="<?= base_url("addFaqs?dID=$id"); ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center">No FAQ's Available </td>
                                        </tr>
                                    <?php
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