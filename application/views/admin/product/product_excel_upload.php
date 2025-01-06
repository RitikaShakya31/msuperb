<?php $this->load->view('admin/template/header', $title); ?>

<style>
    .card-body .row .col-lg-6 .row,
    .card-body .row .col-lg-4 .row,
    .card-body .row .col-lg-3 .row {
        flex-direction: column;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: .47rem .75rem;
        line-height: 1.5;
    }

    .select2-container .select2-selection--single {
        height: 36px;
    }

    .col-form-label {
        text-transform: capitalize;
    }

    .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
    .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
        height: 200px;
    }
</style>
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
            <!-- #uploadForm -->
            <form action="" enctype="multipart/form-data"
                method="POST" id="uploadForm">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="excelMsg"></div>
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <label for="example-text-input"
                                                class="col-md-3 col-form-label w-100">Test
                                                Sheet</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="file" name="product_sheet" id="fileInput" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-3">
                                        <p>Download sample CSV file <a href="<?= base_url('assets/products-excel.csv') ?>"
                                                download="Msuperb.csv">Download</a></p>
                                    </div>
                                </div>
                            </div>
                            <!-- <div id="progress">
                                <div id="progressBar" style="height: 10px; background: red; width: 0;"></div>
                            </div> -->
                            <div class="text-center">
                                <button type="submit" id="save" class="btn btn-primary w-md">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php $this->load->view('admin/template/footer'); ?>
<script>
    $(document).ready(function() {
        $('#uploadForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var msg = $('.excelMsg');
            msg.html('');
            $('#save').text('Loading...').attr('disabled', true);
            // var progressBar = $('#progressBar');
            $.ajax({
                url: '<?= base_url('admin/AdminProduct/update_bulk_product') ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                // xhr: function () {
                //     var xhr = new XMLHttpRequest();
                //     xhr.upload.addEventListener('progress', function (event) {
                //         if (event.lengthComputable) {
                //             var percent = (event.loaded / event.total) * 100;
                //             progressBar.width(percent + '%');
                //         }
                //     });
                //     return xhr;
                // },
                success: function(response) {
                    console.log("Product Excel Res.", response);
                    // $('#fileInput').val("");
                    if (response == 'success') {
                        msg.html(`<div class="alert alert-success">Test uploaded successfully.</div>`);
                        $('#fileInput').val('');
                    }
                    $('#save').text('Save').attr('disabled', false);
                }
            });
        });
    });

    function getCategory(val) {
        $.ajax({
            type: "POST",
            url: "<?= base_url("getSubCategory") ?>",
            data: 'category_id=' + val,
            beforeSend: function() {
                $(".loader").show();
            },
            success: function(data) {
                $("#sub_category").html(data);
                $(".loader").hide();
                const sub_category = document.querySelector('#sub_category').value;
                getSubCategoryType(sub_category);
            }
        });
    }

    function getSubCategoryType(val) {
        $.ajax({
            type: "POST",
            url: "<?= base_url("getSubCategoryType") ?>",
            data: 'subcategory_id=' + val,
            beforeSend: function() {
                $(".loader").show();
            },
            success: function(data) {
                $("#sub_category_type").html(data);
                $(".loader").hide();
            }
        });
    }

    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            // if (filesAmount <= 5) {
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img style="width:200px; height:150px; margin-left:15px">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('.image').on('change', function() {
        $('.gallery').html('');
        imagesPreview(this, 'div.gallery');
    });
</script>