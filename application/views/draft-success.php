<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?=base_url("assets/")?>images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- css includes -->
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick-theme.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/styles.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/responsive.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <title></title>
</head>

<body>
    <div class="dashboard-page kyc-page unique">
        <div class="container">
            <div class="dashboard-main">

                <?php $this->load->view("includes/user-menu.php"); ?>

                <div class="dashboard-main-ryt">
                    <?php $this->load->view("includes/header.php"); ?>
                    <div class="mob-menu-bar">
                        <img src="https://xhtmlreviews.com/udyam/assets/images/main-logo.png" alt="logo">
                        <a id='menu-button' href="#">
                          <span></span>
                          <span></span>
                          <span></span>
                        </a>
                    </div>
                      
                    <div class="dash-seections enterprise-successful">
                        <section class="kyc-form-section">
                            <div class="kyc-successful">
                                <img src="<?=base_url("assets/")?>images/success-icon.png" />
                                <h2>Details Saved in draft Successfully!</h2>
                                <p>For process application please submit application</p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/28d7e4550d.js" crossorigin="anonymous"></script>
    <script src="<?=base_url("assets/")?>js/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url("assets/")?>slick/slick.min.js"></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>



</body>

</html>