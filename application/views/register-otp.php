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
    <title>Udyamika</title>
</head>

<body>
    <div class="forgot_password-page sign-with-otp">
        <div class="forgot-up-left">  
            <div class="forgot-logo">
                <img src="<?=base_url("assets/")?>images/celebration-logo.jpg" alt="logo">
            </div>
            <h2>Check your OTP <span>A verification code has been sent to your phone
                    <?=$this->session->userdata("otp")?></span></h2>

            <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong><?php echo $this->session->flashdata('error'); ?></strong>
            </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <strong><?php echo $this->session->flashdata('success'); ?></strong>
            </div>
            <?php endif; ?>

            <form action="<?=base_url("verifyOtp")?>" method="post">
                <div class="forgot-form opt-form" />
                <input name="otp1" type="number" />
                <input name="otp2" type="number" />
                <input name="otp3" type="number" />
                <input name="otp4" type="number" />
        </div>
        <div class="forgot-form">
            <input name="submit" type="submit" value="Verify OTP" />
        </div>
        </form>
        <div class="otp-already">
            <p>Didn't receive the OTP? <a href="#">Click to resend</a></p>
            <a class="back-page" href="#"> <img src="<?=base_url("assets/")?>images/left-arrow.png" alt="img"> Back to
                log in</a>
        </div>
        <div class="sign_copyright">
            <p>Copyright @ 2022 Udyamita All Rights Reserved.</p>
        </div>
    </div>
    <div class="uni-right">

        <div class="uni-right-top"> 
            <div class="uni-right-top-lft">
                <div class="uni-ryt-logo">
                    <img src="<?=base_url("assets/")?>images/Telangana-LOGO 1-min.png" alt="logo" />
                </div>
                <div>
                    <ul>
                        <li><img src="<?=base_url("assets/")?>images/alpha-w.png" alt="alpha" /></li>
                        <li><img src="<?=base_url("assets/")?>images/alpha-E.png" alt="alpha" /></li>
                        <li><img src="<?=base_url("assets/")?>images/alpha-logo.png" alt="alpha" /></li>
                        <li><img src="<?=base_url("assets/")?>images/alpha-H.png" alt="alpha" /></li>
                        <li><img src="<?=base_url("assets/")?>images/alpha-U.png" alt="alpha" /></li>
                        <li><img src="<?=base_url("assets/")?>images/alpha-B.png" alt="alpha" /></li>
                    </ul>
                    <p>Ideate, Implement, Inspire</p>
                </div>
            </div>
            <div class="uni-right-top-ryt">
                <img style="margin-right: 25px;" src="<?=base_url("assets/")?>images/kcr.png" alt="logo" />
                <img src="<?=base_url("assets/")?>images/ktr.png" alt="logo" />
            </div>
        </div>
        <div class="ryt-heading">
            <h1>Welcome to Telangana
                <span>The Startup State Of India</span>
            </h1>
        </div>
        <div class="uni-ryt-bottom">
            <img src="<?=base_url("assets/")?>images/sign-ryt-btm.png" alt="img">
        </div>
    </div>
    </div>
    <script src="<?=base_url("assets/")?>js/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url("assets/")?>slick/slick.min.js"></script>
    <script src="<?=base_url("assets/")?>js/main.js"></script>
</body>

</html>