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
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
    <link href="<?=base_url("assets/")?>css/theme-default.css" rel="stylesheet" />
    <title><?=$title?></title>
  </head>
  <body>
    <div class="forgot_password-page fpd-page">
      <div class="forgot-up-left">
        <div class="forgot-logo">
          <img src="<?=base_url("assets/")?>images/logo.png" alt="logo">
        </div>
        <h2>Forgot password? <span>No worries, we'll send you reset instructions.</span></h2>
        <form>
          <div id="forgotPassword">
            <div  class="forgot-form">
              <label>Enter Mobile No.*</label>
              <input type="text" id="mobile_code" name="mobile_code" class="form-control" placeholder="Phone Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="10" maxlength="10">
            </div>
            <div class="forgot-form">
              <button type="button" id="sendOtpBtn">Submit</button>
            </div>
          </div>
          <div id="forgotPasswordOtp" style="display:none;">
            <div  class="forgot-form">
              <label>Enter new password*</label>
              <input type="text" id="password" name="password" class="form-control" placeholder="New password">
            </div>
            <div  class="forgot-form">
              <label>Enter OTP* <span id="otpDisp"></span></label>
              <input type="text" id="otp_code" name="otp_code" class="form-control" placeholder="OTP" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="4" maxlength="4">
            </div>
            <div class="forgot-form">
              <button type="button" id="otpVerifyBtn">Submit</button>
            </div>
          </div>
          
          <a class="back-page" href="<?=base_url()?>"> <img src="<?=base_url("assets/")?>images/left-arrow.png" alt="img"> Back to log in</a>
        </form>
        <div class="sign_copyright">
          <p style="bottom: auto;">Copyright @ 2022 Udyamika All Rights Reserved.</p>
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
<!--          <div class="uni-right-top-ryt">-->
<!--            <img style="margin-right: 25px;" src="--><?php //=base_url("assets/")?><!--images/kcr.png" alt="logo" />-->
<!--            <img src="--><?php //=base_url("assets/")?><!--images/ktr.png" alt="logo" />-->
<!--          </div>-->
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
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>

<script id="rendered-js" >
// -----Country Code Selection
$("#mobile_code").intlTelInput({
  initialCountry: "in",
  separateDialCode: true
});
//# sourceURL=pen.js
    </script>

<script src="<?=base_url("assets/")?>js/jquery.form-validator.js"></script>

<script>
$(function() {
    // setup validate
    $.validate();
});
</script>

<script src="<?php echo base_url('assets/js/notify.min.js');?>"></script>
  </body>
</html>


<!-- <script>
    $(document).ready(function(){
        $(document).on('click','#sendOtpBtn', function(){
        var mobile = $("#mobile_code").val();
        
        if(mobile.length != '10' || mobile == null || mobile == '')
        {
          $.notify('Enter 10 digit mobile number',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else
        {
            $ .ajax({
                url  : '<?php echo base_url('user_forgot_otp');?>',
                type : 'POST',
                data : {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>','mobile': mobile},
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
</script> -->

<script>

$(document).ready(function(){
    function sendOtp(mobile) {
        $.ajax({
            url: '<?php echo base_url('user_forgot_otp');?>',
            type: 'POST',
            data: {
                '<?php echo $this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash();?>',
                'mobile': mobile
            },
            success: function(data) {
                let res = $.parseJSON(data);
                if (res.response === '1') {
                    $("#forgotPassword").hide();
                    $("#forgotPasswordOtp").show();
                    $.notify(res.message, {'className': 'success', 'position': 'top left', 'autoHideDelay': 1500});
                } else {
                    $.notify(res.message, {'className': 'danger', 'position': 'top left', 'autoHideDelay': 1500});
                }
            } 
        });
    }

    $("#sendOtpBtn").click(function() {
        var mobile = $("#mobile_code").val();
        
        if (mobile.length !== 10 || mobile === null || mobile === '') {
            $.notify('Enter a 10-digit mobile number', {'className': 'danger', 'position': 'top left', 'autoHideDelay': 1500});
            return false;
        } else {
            sendOtp(mobile);
        }
    });

    $("#mobile_code").keypress(function(event) {
        if (event.which === 13) { 
            event.preventDefault(); 

            var mobile = $("#mobile_code").val();
            
            if (mobile.length !== 10 || mobile === null || mobile === '') {
                $.notify('Enter a 10-digit mobile number', {'className': 'danger', 'position': 'top left', 'autoHideDelay': 1500});
                return false;
            } else {
                sendOtp(mobile);
            }
        }
    });

});
</script>









<script>
    $(document).ready(function(){
        $(document).on('click','#otpVerifyBtn', function(){
        var mobile = $("#mobile_code").val();
        var otp_code = $("#otp_code").val();
        var password = $("#password").val();
        if(mobile.length != '10' || mobile == null || mobile == '')
        {
          $.notify('Try to invalid',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else if(otp_code.length != '4' || otp_code == null || otp_code == '')
        {
          $.notify('Enter 4 digit OTP',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else if(password.length < '8' || password == null || password == '')
        {
          $.notify('Enter password atleast 8 character',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else
        {
          $ .ajax({
            url  : '<?php echo base_url('user_forgot_otp_verify');?>',
            type : 'POST',
            data : {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>','mobile': mobile,'otp_code':otp_code,'password':password},
            success : function(data)
            {
              let res = $.parseJSON(data);
              if(res.response=='1')
              {
                  $.notify(res.message,{'className':'success','position':'top left','autoHideDelay': 1500});
                  window.location.href = "<?php echo base_url('forgot_pass_success');?>";
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