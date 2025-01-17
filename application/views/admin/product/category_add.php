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
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Brand
                                                Name</label>
                                            <div class="col-md-9">
                                                <input class="form-control" type="text" name="category_name" required
                                                    value="<?= $category_name ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Brand
                                                Description</label>
                                            <div class="col-md-9">
                                                <textarea name="category_description" style="width: 100%;" id="editor"
                                                    rows="10"><?= $category_description ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Brand
                                                Logo</label>
                                            <div class="col-md-9">
                                                <input class="form-control category_image" type="file" name="image"
                                                    <?= $image == "" ? 'required' : '' ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Brand
                                                Banner</label>
                                            <div class="col-md-9">
                                                <input class="form-control " type="file" name="banner" <?= $image == "" ? 'required' : '' ?>>
                                                <h6>Image Size: 1296*300</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <div class="row">
                                            <label for="example-text-input" class="col-md-3 col-form-label">Offer
                                                Image</label>
                                            <div class="col-md-9">
                                                <input class="form-control " type="file" name="offer">
                                                <h6>Image Size: 1519*300</h6>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <img class="temp_image" src="<?= base_url('upload/category') . '/' . $image ?>"
                                            style=" height: 300px;">
                                        <input type="hidden" value="<?= $image ?>" name="temp_image">
                                    </div>
                                    <div class="col-lg-12 mt-2">
                                        <span id="uploadImageError"></span>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" id="save" class="btn btn-primary w-md">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('admin/template/footer'); ?>
<script>

</script>