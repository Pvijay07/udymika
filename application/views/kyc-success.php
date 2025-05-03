<!doctype html>
<html lang="en">
  <head> 
    <meta charset="utf-8">   
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?=base_url("assets/")?>images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- css includes -->
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick-theme.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/styles.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/responsive.css">
     <title><?=$title?></title>
    <style>
      .btnCOntinue {
    width: 100%;
    height: 48px;
    background: #F0A144; 
    color: #fff !important;
    border: none;
    outline: none;
    border-radius: 8px;
    font-size: 17px;
    line-height: 26px;
    font-weight: 500;
    padding: 10px 20px;
}
    </style>
  </head>
  <body>
    <div class="dashboard-page kyc-page unique">
      <div class="container">
        <div class="dashboard-main">
          <?php $this->load->view("includes/user-menu.php"); ?>

          <div class="dashboard-main-ryt">

              <?php $this->load->view("includes/header.php"); ?>
            
              <div class="dash-seections">
                <section class="kyc-form-section">
                   <div class="kyc-successful">
                     <img src="<?=base_url("assets/")?>images/success-icon.png" />
                     <h2>KYC under verification!</h2>
                     <p>Thank you, please find the status in Dashboard<span>Help us in further understanding your business  </span></p>             
                     <span  style="background: #F0A144;color: #fff !important;border-radius: 10px;padding: 10px 20px;cursor: pointer;" id="getCOntinu">Continue</span>
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
 
 

  </body>
</html>
<script>
        $(document).ready(function(){
            $(document).on('click','#getCOntinu',function(){
              window.location.href="<?=base_url("user/dashboard")?>";
            })
        })
    </script>