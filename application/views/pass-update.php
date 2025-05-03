<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <!-- favicon -->

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- css includes -->
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick-theme.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/styles.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/responsive.css">
    <link href="<?=base_url("assets/")?>css/theme-default.css" rel="stylesheet" />

    <title><?=$title?></title>
</head>

<body>
    <div class="dashboard-page unique">
        <div class="container">
            <div class="dashboard-main">

                <?php $this->load->view("includes/user-menu.php"); ?>

                <div class="dashboard-main-ryt">
                    <?php $this->load->view("includes/header.php"); ?>
                    <div class="dash-seections">
                        <form action="<?php echo base_url('password_submit'); ?>" method="post" enctype="multipart/form-data">                          
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
                                        <input type="submit" name="submit" class="active" value="Update" />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 

    <script src="https://kit.fontawesome.com/28d7e4550d.js" crossorigin="anonymous"></script>
    <script src="<?=base_url("assets/")?>js/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url("assets/")?>slick/slick.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>

    <script id="rendered-js">
    $('#ad-document').click(function() {
        $('.dash-board-popup').show(500);
    });

    $('.experience-con a').click(function() {
        $('.experience-con').hide(500);
    });
    </script>

    <script src="<?=base_url("assets/")?>js/jquery.form-validator.js"></script>

    <script>
    $(function() {
        // setup validate
        $.validate();
    });
    </script>

</body>

</html>