<?php $this->load->view('admin/head'); ?>

<style>

    .kyc-form-cntrl {

        margin-bottom: 10px;

        margin-top: 10px;

    }

</style>

    <body>

        <div class="dashboard-page admin_one">

            <div class="container">

                <div class="dashboard-main">

                    <?php $this->load->view('admin/menus'); ?>

                    <div class="dashboard-main-ryt">

                        <?php $this->load->view('admin/header'); ?>

                        <section>

                            <div class="dash-seections enterprise-sec">

                                <div class="enter-heading">

                                    <h4>Update password</h4>

                                </div>

                                <div id="checklist_sec">

                                    <form action="<?php echo base_url('master_password_submit'); ?>" method="post" enctype="multipart/form-data">                          

                                        <div class="row">

                                            <div class="col-lg-6">

                                                <div class="kyc-form-cntrl">

                                                    <label>Old Password</label>

                                                    <div class="kyc-text">

                                                        <input name="old_password" type="text" placeholder="Old Password"

                                                            minlength="8" data-validation="length" data-validation-length="min8" />

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-lg-6">

                                                <div class="kyc-form-cntrl">

                                                    <label>New Password</label>

                                                    <div class="kyc-text">

                                                        <input name="new_password" type="text" placeholder="New Password"

                                                            minlength="8" data-validation="length" data-validation-length="min8" />

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-lg-6">

                                                <div class="kyc-form-cntrl">

                                                    <label>Confirm new password</label>

                                                    <div class="kyc-text">

                                                        <input name="confirm_password" type="text" placeholder="Confirm Password"

                                                            minlength="8" data-validation="length" data-validation-length="min8" />

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">

                                            <div class="col-lg-4">

                                                <div class="kyc-form-buttons">

                                                    <input type="submit" name="submit" class="active" value="Submit" />

                                                </div>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </section>

                    </div>

                </div>

            </div>

        </div>

        <?php $this->load->view('admin/footer'); ?>

    </body>

</html> 



<?php if(!empty($this->session->flashdata('pass_msg'))) { ?>

    <script>

       $.notify("<?php echo $this->session->flashdata('pass_msg'); ?>",{'className': 'success', 'position': 'top left','autoHideDelay': 1500});

    </script> 

  <?php } ?>