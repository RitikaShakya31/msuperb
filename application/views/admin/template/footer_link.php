<script src="<?= base_url() ?>assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/metismenu/metisMenu.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/simplebar/simplebar.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/node-waves/waves.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/apexcharts/apexcharts.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/pages/dashboard.init.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/select2/js/select2.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/spectrum-colorpicker2/spectrum.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/admin/libs/%40chenfengyuan/datepicker/datepicker.min.js"></script>
<script src="<?= base_url() ?>assets/admin/js/pages/form-advanced.init.js"></script>
<script src="<?= base_url() ?>assets/admin/js/app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/40.0.0/ckeditor.min.js"
    integrity="sha512-Zyl/SvrviD3rEMVNCPN+m5zV0PofJYlGHnLDzol2kM224QpmWj9p5z7hQYppmnLFhZwqif5Fugjjouuk5l1lgA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('#datatable').DataTable({
        "scrollX": true,
        // dom: 'Bfrtip',
        // buttons: [
        //     'excelHtml5',
        // ]
    });
</script>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error('There was a problem initializing the editor.', error);
        });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if ($this->session->flashdata('errors')) {
    ?>
    <script>
        Swal.fire({
            title: "<i>Info</i>",
            html: "<?= $this->session->flashdata('errors') ?>",
            confirmButtonText: "Okay",
        });
    </script>
    <?php
}
?>