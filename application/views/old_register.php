<?php $this->load->view('includes/header'); ?>
<section class="user-form-part">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-12 col-lg-12 col-xl-10">
                <div class="user-form-card">
                    <div class="user-form-title">
                        <h2>Join Now!</h2>
                        <p>Setup Your New Account In A Minute</p>
                        <?php if ($this->session->userdata('msg') != '') { ?>
                            <?= $this->session->userdata('msg'); ?>
                        <?php }
                        $this->session->unset_userdata('msg'); ?>
                    </div>
                    <div class="user-form-group">
                        <div class="user-form-social text-center dm-none">
                            <img src="<?= base_url() ?>assets/img/register-img.png" alt="Image" width="500px">
                        </div>
                        <div class="user-form-divider">
                            <!-- <p>or</p> -->
                        </div>
                        <form class="user-form" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Enter name" required />
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email_id" placeholder="Enter email"
                                    required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="contact_no"
                                    placeholder="Enter Whatsapp Number" maxlength="10"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" required />
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="address" placeholder="Address*" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" name="area" placeholder="Area*" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="postal_code" placeholder="Pincode*"
                                    value="" maxlength="6" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="state" required id="state">
                                    <option value="">Select state </option>
                                    <?php
                                    if ($state_list) {
                                        foreach ($state_list as $state) {
                                            ?>
                                            <option value="<?= $state['state_name'] ?>"
                                                <?= (($state['state_name'] == @$login[0]['state']) ? 'Selected' : '') ?>>
                                                <?= $state['state_name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="city" class="form-control" id="city" required>
                                    <option value="">Select city</option>
                                </select>
                            </div>
                            <div class="form-button">
                                <button type="submit">register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="user-form-remind">
                    <p>Already Have An Account?<a href="<?= base_url('login') ?>">login here</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
</body>

</html>