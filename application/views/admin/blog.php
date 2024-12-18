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
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-form-label">Title</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="text" name="title" value="<?= $blogtitle ?>">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="example-text-input" class="col-form-label">Cover Image</label>
                                        <div class="col-md-9">
                                            <input class="form-control" type="file" name="cover_image" value="">
                                            <img src="<?= base_url('upload/blog/' . $cover) ?>" style="width:100px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="example-text-input" class="col-form-label">Description</label>
                                        <div class="col-md-12">
                                            <textarea name="description" style="width: 100%;" id="editor" rows="10"><?= $description ?></textarea>
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
                            <h4 class="card-title">All Blog</h4>
                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Blog</th>
                                        <th>Image</th>
                                        <th>Create date</th>

                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $allblog = getAllRowInOrder('blog', 'id', 'desc');
                                    if ($allblog) {
                                        $i = 0;
                                        foreach ($allblog as $all) {
                                            $id = encryptId($all['id']);
                                    ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= ucwords($all['title']) ?></td>
                                                <td><img src="<?= base_url() ?>upload/blog/<?= $all['cover_image'] ?>" style="width:100px;" /></td>
                                                <td><?= date('d-M-Y', strtotime($all['create_date'])) ?></td>

                                                <td>
                                                    <a href="<?= base_url("blog?blog_pin=$id"); ?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                    <a onclick="return confirm('Are you want to sure?')" href="<?= base_url("blog?dID=$id"); ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6" style="text-align: center">No Blogs Available</td>
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