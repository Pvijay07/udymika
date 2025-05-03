<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Signin</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="<?=base_url("assets/")?>images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- css includes -->
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick-theme.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/styles.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/responsive.css">
    <link href="<?=base_url("assets/")?>css/theme-default.css" rel="stylesheet" />


</head>

<body>
    <div class="login-page">
        <div class="login-up-left">
            <div class="login-logo">
                <img src="<?=base_url("assets/")?>images/celebration-logo.jpg" alt="logo">
            </div>
            <h2>Welcome <span>Please enter your details.</span></h2>

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

            <form method="post" action="<?=base_url("lvl3_signin")?>">
                <div class="login-form">
                    <label>Email*</label>
                    <input type="email" name="email" placeholder="Enter your email" data-validation="email" />
                </div>
                <div class="login-form">
                    <label>Password*</label>
                    <input type="Password" name="password" placeholder="Enter your Password"
                        data-validation="required" />
                </div>
                
                <div class="login-form">
                    <input type="submit" name="submit" value="Login" />
                </div>
            </form>
           
          
            <div class="sign_copyright">
                <p style="bottom: auto;">Copyright @ 2022 Udyamita All Rights Reserved.</p>
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
    <script src="<?=base_url("assets/")?>js/jquery.form-validator.js"></script>

    <script>
    $(function() {
        // setup validate
        $.validate();
    });
    </script>
    <script>

 $(document).ready(function() {
      $('.alert .close').on('click', function() {
        $(this).parent().fadeOut();
      });
    });
    </script>

</body>

</html>