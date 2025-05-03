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
    <link href="<?=base_url("assets/")?>css/theme-default.css" rel="stylesheet" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <title><?=$title?></title>
</head>

<body>
    <div class="sign-up_page">
        <div class="sign-up-left">
            <div class="signin-logo">
                <img src="<?=base_url("assets/")?>images/celebration-logo.jpg" alt="logo">
            </div>
            <h2>Sign Up</h2>

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

            <form method="post" action="<?=base_url("verify_register_otp")?>">
                <div id="forgotPassword">
                    <div class="sign-form">
                        <label>Name*</label>
                        <input type="text" name="name" id="name" placeholder="Enter your name" data-validation="required" />
                    </div>
                    <div class="sign-form">
                        <label>Phone*</label>
                        <input type="text" name="phone" id="mobile_code" placeholder="Mobile No." maxlength="10"
                            data-validation="number,length" data-validation-length="min10" data-validation-length="max10" />
                    </div>
                    <div class="sign-form">
                        <label>Email*</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email" data-validation="email" />
                    </div>
                    <div class="sign-form">
                        <label>Password*</label>
                        <input type="Password" name="password" id="password" placeholder="Enter your Password"
                            data-validation="number,length" data-validation-length="min8" />
                        <p>Must be at least 8 characters.</p>
                    </div>
                    <div class="sign-form">
                        <input type="button" id="sendOtpBtn" name="submit" value="Create account" />
                    </div>
                </div>
                <div id="forgotPasswordOtp" style="display:none;">
                    <div class="forgot-form">
                        <label>Enter OTP* <span id="otpDisp"></span></label>
                        <input type="text" id="otp_code" name="otp_code" class="form-control" placeholder="OTP" maxlength="4" data-validation="number,length" data-validation-length="min4" data-validation-length="max4">
                    </div>
                    <div class="sign-form">
                        <input type="submit" name="submit" value="Create account" />
                    </div>
                </div>
            </form>
            <div class="sign-buttons">
                <!-- <a class="sign-google" href=""><img src="<?=base_url("assets/")?>images/google-icon.png" alt="" /> Sign
                    up with Google</a> -->
                <a class="sign-phone" href="<?php echo base_url('login_by_otp'); ?>"><img src="<?=base_url("assets/")?>images/mob-icon.png" alt="" /> Sign up
                    with Phone</a>
                <p>Already have an account? <a href="<?=base_url("/")?>">Log in</a></p>
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
        <!-- <div class="sign_copyright">
                <p>Copyright @ 2022 Udyamita All Rights Reserved.</p>
            </div> -->
    </div>
    <script src="<?=base_url("assets/")?>js/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url("assets/")?>slick/slick.min.js"></script>
    <script src="<?=base_url("assets/")?>js/main.js"></script>

    <script src="<?=base_url("assets/")?>js/jquery.form-validator.js"></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>

     
    <script src="<?php echo base_url('assets/js/notify.min.js');?>"></script>
</body>

</html>


<script>
    $(document).ready(function(){
        $(document).on('click','#sendOtpBtn', function(){
        var phone = $("#mobile_code").val();
        var name = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        if(name == null || name == '')
        {
          $.notify('Enter Name',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else if(phone.length != '10' || phone == null || phone == '')
        {
          $.notify('Enter 10 digit mobile number',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else if(email == null || email == '')
        {
          $.notify('Enter valid email',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else if(email == null || email == '')
        {
          $.notify('Enter valid email',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else if(password.length < 8 || password == null || password == '')
        {
          $.notify('Enter password atleast 8 character',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else
        {
            $ .ajax({
                url  : '<?php echo base_url('user_register');?>',
                type : 'POST',
                data : {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>','phone': phone,'name': name, 'email': email},
                success : function(data)
                {
                    let res = $.parseJSON(data);
                    if(res.response=='1')
                    {
                        //$("#otpDisp").html(res.otp);
                        $("#forgotPassword").hide();
                        $("#forgotPasswordOtp").show();
                        $.notify(res.message,{'className':'success','position':'top left','autoHideDelay': 1500});
                    }
                    else
                    {
                        $.notify(res.message,{'className':'danger','position':'top left','autoHideDelay': 1500});
                    }
                } 
            })
        }
        
    });
});     
</script>
 