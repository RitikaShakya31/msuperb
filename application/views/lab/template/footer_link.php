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
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/40.0.0/ckeditor.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
<script>
    document.querySelectorAll('.editor').forEach((node, index) => {
        ClassicEditor
            .create(node, {})
            .then(newEditor => {
                window.editors[index] = newEditor
            });
    });
</script>
<script>
    $('#datatable').DataTable({
        "scrollX": true,
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'copy', 'csv', 'pdf', 'print'
        ]
    });


</script>

<script>
      <?php 
    if (sessionId('success_status')) {
    ?>
        Swal.fire({
            title: '<?= sessionId('success_status') ?>!',
            text: '<?= sessionId('msg') ?>',
            icon: '<?= sessionId('success_status') ?>',
            confirmButtonText: 'Done'
        })
    <?php
    }
    ?>
</script>

