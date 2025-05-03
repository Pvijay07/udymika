<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <!-- favicon -->
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- css includes -->
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick-theme.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/styles.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/responsive.css">
    <title><?=$title?></title>
  </head>
  <body>
    <div class="changed-fpd-page">
      <div class="forgot-up-left">
        <div class="forgot-logo">
          <img src="<?=base_url("assets/")?>images/celebration-logo.jpg" alt="logo">
        </div>
        <div class="cfp-success">
           <img src="<?=base_url("assets/")?>images/success-icon.png" alt="img">
           <h2>Your password reset Successfully! <span>Click below to log in!</span></h2>
        </div>
       
        <form>
          <div class="forgot-form">
            <button type="button" onclick="window.open('<?=base_url("login")?>')">Continue</button>
          </div>
        </form>
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
            <span>The Startup State Of India</span></h1>
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