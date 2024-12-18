<?php $this->load->view('admin/template/header', $title); ?>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h2 class="mb-sm-0 ">
                            <?= $title ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 8%">S.n.</th>
                                        <th style="width: 10%">Particulars</th>
                                        <th style="width: 15%">Value</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($setting_data) {
                                        $i = 0;
                                        foreach ($setting_data as $all) {
                                            $id = encryptId($all['id']);
                                    ?>
                                            <tr>
                                                <td>
                                                    <?= ++$i; ?>
                                                </td>
                                                <td>
                                                    <?= $all['particulars'] ?>
                                                </td>
                                                <td>
                                                    <form action="" method="post" class="row" enctype="multipart/form-data">
                                                        <div class="form-group col-10">
                                                            <input type="hidden" value="<?= $all['id'] ?>" name="record" />
                                                            <input type="hidden" value="<?= $all['value_type'] ?>" name="value_type" />
                                                            <?php if ($all['value_type'] == 'text') {
                                                            ?>
                                                                <input type="text" class="form-control" placeholder="Enter value" value="<?= $all['particular_value'] ?>" name="record_value">
                                                            <?php
                                                            } elseif ($all['value_type'] == 'option') {
                                                            ?>
                                                                <select name="record_value" class="form-control">
                                                                    <option value="0" <?= ($all['particular_value'] == '0') ? 'selected' : '' ?>>Yes</option>
                                                                    <option value="1" <?= ($all['particular_value'] == '1') ? 'selected' : '' ?>>No</option>
                                                                </select>
                                                            <?php
                                                            } elseif ($all['value_type'] == 'date') {
                                                            ?>
                                                                <input type="date" class="form-control" placeholder="Enter value" value="<?= $all['particular_value'] ?>" name="record_value">

                                                            <?php
                                                            } elseif ($all['value_type'] == 'large_text') {
                                                            ?>
                                                                <textarea name="record_value"  class="editor" ><?= $all['particular_value'] ?></textarea>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <input type="file" class="form-control" placeholder="Enter value" value="<?= $all['particular_value'] ?>" name="record_value">
                                                                <?php

                                                                if ($all['particular_value'] != '') {
                                                                ?>
                                                                    <img src="<?= base_url($all['particular_value']) ?>" style="width:100px;" />
                                                                <?php
                                                                }
                                                                ?>
                                                            <?php
                                                            } ?>

                                                        </div>
                                                        <div class="form-group col-2">
                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                        </div>
                                                    </form>
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


<div class="modal fade acceptModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title acceptHead"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url("acceptOrder") ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label">Estimated Time</label>
                                    <div class="col-sm-12">
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" class="form-control" data-date-format="dd-mm-yyyy" readonly data-date-container='#datepicker1' data-provide="datepicker" name="estimated_date" value="<?= date('d-m-Y') ?>">
                                            <input type="time" class="form-control" name="estimated_time" required>
                                            <input name="id" type="hidden" class="booking_id">
                                            <div class="input-group-addon">
                                                <i class="fa fa-clock-o"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; margin-top: 30px">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade cancelModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" onclick="hideCancelModal();" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title acceptHead"></h4>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url("cancelOrder") ?>">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Cancel
                                        Message</label>
                                    <div class="col-sm-12">
                                        <textarea class="form-control" name="cancel_msg" rows="5" required></textarea>
                                        <input name="id" type="hidden" class="booking_id">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: center; margin-top: 30px">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('admin/template/footer'); ?>
<script>
    $('.accept').click(function() {
        let id = $(this).attr('id');
        let order_id = $(this).attr('datafld');
        $('.booking_id').val(id);
        $('.acceptHead').text(order_id);
        $('.acceptModal').modal('show');
    });

    function checkCancel(button) {
        let cancelBtn = button;
        let id = cancelBtn.getAttribute('id');
        let order_id = cancelBtn.getAttribute('datafld');
        $('.booking_id').val(id);
        $('.acceptHead').text(order_id);
        $('.cancelModal').modal('show');
    }

    function hideCancelModal() {
        $('.cancelModal').modal('hide');
    }

    // $('.cancel').click(function () {
    //     let id = $(this).attr('id');
    //     let order_id = $(this).attr('datafld');

    // });
</script>