<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon -->
    <link rel="shortcut icon" href="<?=base_url("assets/")?>images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- css includes -->
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick-theme.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/styles.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/responsive.css">

    <title>Document</title>
</head>

<body>
    <div class="login-page">
        <div class="login-up-left">
            <div class="login-logo">
                <img src="images/main-logo.png" alt="logo">
            </div>
            <h2>Welcome Back <span>Please enter your details.</span></h2>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> This alert box could indicate .
            </div>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Danger!</strong> This alert box could indicate .
            </div>
            <form>
                <div class="login-form">
                    <label>Email*</label>
                    <input type="email" placeholder="Enter your email" />
                </div>
                <div class="login-form">
                    <label>Password*</label>
                    <input type="Password" placeholder="Enter your Password" />
                </div>
                <div class="login-form-check">
                    <div>
                        <label>Remember me</label>
                        <input type="checkbox" />
                    </div>
                    <div>
                        <p>Forgot password</p>
                    </div>
                </div>
                <div class="login-form">
                    <button type="submit">Create account</button>
                </div>
            </form>
            <div class="login-buttons">
                <a class="login-google" href=""><img src="images/google-icon.png" alt="" /> Sign in with Google</a>
                <a class="login-phone" href=""><img src="images/mob-icon.png" alt="" /> Sign in with Phone</a>
                <p>Don't have an account? <a href="#">Sign up</a></p>
            </div>
            <div class="sign_copyright">
                <p>Copyright @ 2022 Udyamita All Rights Reserved.</p>
            </div>
        </div>
        <div class="uni-right">

            <div class="uni-right-top">
                <div class="uni-right-top-lft">
                    <div class="uni-ryt-logo">
                        <img src="images/Telangana-LOGO 1-min.png" alt="logo" />
                    </div>
                    <div>
                        <ul>
                            <li><img src="images/alpha-w.png" alt="alpha" /></li>
                            <li><img src="images/alpha-E.png" alt="alpha" /></li>
                            <li><img src="images/alpha-w.png" alt="alpha" /></li>
                            <li><img src="images/alpha-H.png" alt="alpha" /></li>
                            <li><img src="images/alpha-U.png" alt="alpha" /></li>
                            <li><img src="images/alpha-B.png" alt="alpha" /></li>
                        </ul>
                        <p>Ideate, Implement, Inspire</p>
                    </div>
                </div>
                <div class="uni-right-top-ryt">
                    <img style="margin-right: 25px;" src="images/kcr.png" alt="logo" />
                    <img src="images/ktr.png" alt="logo" />
                </div>
            </div>
            <div class="ryt-heading">
                <h1>Welcome to Telangana
                    <span>The Startup State Of India</span>
                </h1>
            </div>
            <div class="uni-ryt-bottom">
                <img src="images/sign-ryt-btm.png" alt="img">
            </div>
        </div>
    </div>

    <script src="<?=base_url("assets/")?>js/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url("assets/")?>slick/slick.min.js"></script>
    <script src="<?=base_url("assets/")?>js/main.js"></script>

</body>

</html>