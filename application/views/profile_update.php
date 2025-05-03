<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">

    <!-- favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png'); ?>" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- css includes -->
    <link rel="stylesheet" href="<?= base_url("assets/") ?>slick/slick.css">
    <link rel="stylesheet" href="<?= base_url("assets/") ?>slick/slick-theme.css">
    <link rel="stylesheet" href="<?= base_url("assets/") ?>css/styles.css">
    <link rel="stylesheet" href="<?= base_url("assets/") ?>css/responsive.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <link href="<?= base_url("assets/") ?>css/theme-default.css" rel="stylesheet" />
    <title><?= $title ?></title>
</head>

<body>
    <div class="dashboard-page kyc-page kyc_user_dashboard">
        <div class="container">
            <div class="dashboard-main">

                <?php $this->load->view("includes/user-menu.php"); ?>

                <div class="mob-menu-bar">
                    <img src="https://xhtmlreviews.com/udyam/assets/images/main-logo.png" alt="logo">
                    <a id='menu-button' href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                    </a>
                </div>

                <div class="dashboard-main-ryt">
                    <?php $this->load->view("includes/header.php"); ?>
                    <div class="dash-seections">
                        <section class="kyc-form-section">
                            <?php if ($this->session->flashdata('fail')) : ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong><?php echo $this->session->flashdata('fail'); ?></strong>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->session->flashdata('success')) : ?>
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <strong><?php echo $this->session->flashdata('success'); ?></strong>
                                </div>
                            <?php endif; ?>
                            <form class="kyc-form" method="post" action="<?= base_url("user/profile_picture_updates") ?>" id="kyc_form_validate" enctype="multipart/form-data">
                                <div class="kyc-form-cntrl">
                                    <label>Profile Picture <span class="text-red">*</span> (File format accepted png,jpeg only)</label>
                                    <div class="file-path">

                                        <input type="file" name="profilePic" class="custom-file-input" accept="image/jpeg,image/png" style="width: 30%;">
                                        <input type="hidden" name="hidden_id" value="<?= $this->session->userdata("user_id") ?>" name="user_id">
                                    </div>
                                </div>
                                <div class="kyc-form-cntrl">
                                    <div class="kyc-form-buttons">
                                        <input type="submit" name="submit" value="Submit" class="active">
                                    </div>
                                </div>

                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://kit.fontawesome.com/28d7e4550d.js" crossorigin="anonymous"></script>
    <script src="<?= base_url("assets/") ?>js/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url("assets/") ?>slick/slick.min.js"></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>



    <!-- <script src="<?= base_url("assets/") ?>js/jquery.form-validator.js"></script> -->

    <script>
        // $(function() {
        //     // setup validate
        //     $.validate();
        // });
        ('.alert-dismissible').hide(500);
        // Select Mandals
        $(".district").on('change', function() {
            var district = $(this).val()
            var url = "<?= base_url("mandals") ?>";

            $.ajax({
                type: "POST",
                url: url,
                data: "district=" + district,
                success: function(data) {
                    $(".mandal").html(data);
                }
            });
        });

        // Select Villages
        $(".mandal").on('change', function() {
            var mandal = $(this).val()
            var url = "<?= base_url("villages") ?>";

            $.ajax({
                type: "POST",
                url: url,
                data: "mandal=" + mandal,
                success: function(data) {
                    $(".village").html(data);
                }
            });
        });

        <?php if ($user_info->status == 2 or $user_info->status == 3) { ?>
            $(".kyc-form input").attr('disabled', 'disabled');
            $(".kyc-form select").attr('disabled', 'disabled');
        <?php } ?>
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#otherInstitute', function() {
                var x = $(this).val();
                if (x == 'Others') {
                    $("#otherInsName").show();
                } else {
                    $("#otherInsName").hide();
                }
            })
        })
    </script>

    <script src="<?php echo base_url('assets/js/notify.min.js'); ?>"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#dob', function() {
                var dob = $("#dob").val();
                const date1 = new Date();
                const date2 = new Date(dob);
                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                var diffYear = ((diffDays / 365).toFixed(0));
                if (diffYear < 18) {
                    $.notify('Age should be atleast 18 years', 'danger');
                    return false;
                }
            });
        });
        $(document).ready(function() {
            $("#kyc_form_validate").attr('autocomplete', 'off');
            $("#kyc_form_validate").on('submit', function() {
                var aadhar_no = $("#aadhar_no").val();
                var pan_no = $("#pan_no").val();
                var mobile_code = $("#mobile_code").val();
                var name = $("#name").val();
                var dob = $("#dob").val();

                const date1 = new Date();
                const date2 = new Date(dob);
                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                var diffYear = ((diffDays / 365).toFixed(0));

                if (diffYear < 18) {
                    $.notify('Age should be atleast 18 years', 'danger');
                    return false;
                }

                if (name.length < '3') {
                    $.notify('Full name cannot be empty', 'danger');
                    return false;
                }
                if (aadhar_no.length != '12') {
                    $.notify('Aadhar field cannot be empty', 'danger');
                    return false;
                }
                if (pan_no.length != '10') {
                    $.notify('PAN card field cannot be empty', 'danger');
                    return false;
                }
                if (mobile_code.length != '10') {
                    $.notify('Phone number cannot be empty', 'danger');
                    return false;
                }
            });
        });
    </script>

</body>

</html>