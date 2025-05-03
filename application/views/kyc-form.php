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
    <style>
        .error-msg {
            color: red;
        }
    </style>
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

                            <div class="kyc-heading">

                                <?php if ($user_info->status == "2") {
                                    $stst = 'KYC under verification';
                                } elseif ($user_info->status == "3") {
                                    $stst = 'KYC Verified';
                                } elseif ($user_info->status == "4") {
                                    $stst = 'KYC Rejected';
                                } elseif ($user_info->status == "5") {
                                    $stst = 'KYC Hold';
                                } else {
                                    $stst = 'KYC';
                                } ?>

                                <h2><?= $stst; ?></h2>

                                <?php $msg = $this->db->query("SELECT statusRemark FROM status_manage_tbl WHERE user_id = '$user_info->id' and statusType = 'KYC Verify' ORDER BY sm_id DESC LIMIT 1")->row();



                                ?>

                                <p><?php //echo $msg->statusRemark; 
                                    ?></p>

                            </div>

                            <div class="msg"></div>

                            <div class="error-msg">

                            </div>
                            <form class="kyc-form" method="post" action="" id="kyc_form_validate" enctype="multipart/form-data">

                                <div class="kyc-form-cntrl">

                                    <label>1. Full Name <span class="text-red">*</span></label>

                                    <input type="text" placeholder="Full name" name="name" id="name" data-validation="required" value="<?= $user_info->name ?>" />
                                    <div class="error-msg">

                                    </div>
                                </div>

                                <div class="kyc-form-cntrl">

                                    <label>2. Email <span class="text-red">*</span></label>

                                    <input type="Email" name="email" placeholder="you@company.com" data-validation="email" value="<?= $user_info->email ?>" />
                                    <div class="error-msg">

                                    </div>
                                </div>

                                <div class="kyc-form-cntrl">

                                    <label>3. Phone number <span class="text-red">*</span></label>

                                    <input type="text" id="mobile_code" name="phone" class="form-control" placeholder="Phone Number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="10" maxlength="10" value="<?= $user_info->phone ?>">
                                    <div class="error-msg">

                                    </div>
                                </div>



                                <div class="kyc-drop-form">

                                    <div class="kyc-form-cntrl">



                                        <label>4. Date of Birth <span class="text-red">*</span><span id="dob_err"></span></label>

                                        <input type="date" name="dob" id="dob" data-validation="required" value="<?php echo $user_info->dob; ?>" />
                                        <div class="error-msg">

                                        </div>
                                    </div>

                                    <div class="kyc-form-cntrl">

                                        <label>5. Category <span class="text-red">*</span></label>

                                        <select name="category" id="category">

                                            <option value="">Select Category</option>

                                            <option value="OC" <?php if ($user_info->category == "OC") echo "selected"; ?>>OC</option>

                                            <option value="OBC" <?php if ($user_info->category == "OBC") echo "selected"; ?>>OBC</option>

                                            <option value="BC-A/B/C/D" <?php if ($user_info->category == "BC-A/B/C/D") echo "selected"; ?>>

                                                BC-A/B/C/D</option>

                                            <option value="SC" <?php if ($user_info->category == "SC") echo "selected"; ?>>SC</option>

                                            <option value="ST" <?php if ($user_info->category == "ST") echo "selected"; ?>>ST</option>

                                            <option value="Prefer not to Say" <?php if ($user_info->category == "Prefer not to Say") echo "selected"; ?>>

                                                Prefer not to Say</option>

                                        </select>
                                        <div class="error-msg">

                                        </div>
                                    </div>

                                    <div class="kyc-form-cntrl">

                                        <label>6. District <span class="text-red">*</span></label>

                                        <select name="district" class="district" id="district">

                                            <option value="">Select District</option>

                                            <?php foreach ($disticts as $district) { ?>

                                                <option value="<?= $district->id ?>" <?php if ($district->id == $user_info->district) echo "selected"; ?>>

                                                    <?= $district->name ?></option>

                                            <?php } ?>

                                        </select>
                                        <div class="error-msg">

                                        </div>
                                    </div>

                                    <div class="kyc-form-cntrl">

                                        <label>7. Mandal <span class="text-red">*</span></label>

                                        <select name="mandal" class="mandal" id="mandal">

                                            <?php

                                            $manadal = $this->db->query("SELECT * FROM mandals WHERE district_id = '$user_info->district'")->result();

                                            foreach ($manadal as $mand) { ?>

                                                <option value="<?= $mand->id ?>" <?php if ($mand->id == $user_info->mandal) echo "selected"; ?>>

                                                    <?= $mand->name ?></option>

                                            <?php } ?>

                                        </select>
                                        <div class="error-msg">

                                        </div>
                                    </div>

                                    <div class="kyc-form-cntrl">

                                        <label>8. Gram Panchayath</label>

                                        <select name="gram_panchayath" class="village" id="gram_panchayath">

                                            <?php

                                            $village = $this->db->query("SELECT * FROM villages WHERE id = '$user_info->village'")->result();

                                            foreach ($village as $vlg) { ?>

                                                <option value="<?= $vlg->id ?>" <?php if ($vlg->id == $user_info->village) echo "selected"; ?>>

                                                    <?= $vlg->name ?></option>

                                            <?php } ?>

                                        </select>
                                        <div class="error-msg">

                                        </div>
                                    </div>



                                </div>



                                <div class="kyc-form-cntrl">

                                    <label>9. Aadhar <span class="text-red">*</span> (File format accepted png,jpeg,pdf only)</label>

                                    <div class="file-path">

                                        <input name="aadhar_no" id="aadhar_no" type="text" placeholder="Enter Aadhar No." onkeypress='return event.charCode >= 48 && event.charCode <= 57' minlength="12" maxlength="12" value="<?= $user_info->adhaar_no ?>" />

                                        <input type="file" name="aadhar_card" id="aadhar_card" class="custom-file-input" value="<?php echo $user_info->adhaar_file; ?>" accept="image/jpeg,image/png,application/pdf" style="width: 30%;">

                                        <?php $adharExt = pathinfo(base_url($user_info->adhaar_file), PATHINFO_EXTENSION); ?>

                                        <input type="hidden" name="adharFlExt" id="adharFlExt" value="<?php echo ($adharExt) ? $adharExt : 'No file chosen'; ?>">

                                        <input type="hidden" name="old_aadhar" value="<?= $user_info->adhaar_file ?>">

                                    </div>
                                    <div class="error-msg">

                                    </div>
                                </div>

                                <!-- <div class="error-msg">

                                </div> -->

                                <div class="kyc-form-cntrl">

                                    <label>10. PAN Card <span class="text-red">*</span> (File format accepted png,jpeg,pdf only)</label>

                                    <div class="file-path">

                                        <input type="text" name="pan_no" id="pan_no" placeholder="Enter PAN No." minlength="10" maxlength="10" value="<?= $user_info->pan_no ?>" />

                                        <input type="file" name="pan_card" class="custom-file-input" value="<?= $user_info->pan_file ?>" accept="image/jpeg,image/png,application/pdf" style="width: 30%;">

                                        <?php $panExt = pathinfo(base_url($user_info->pan_file), PATHINFO_EXTENSION); ?>

                                        <input type="hidden" name="panFlExt" id="panFlExt" value="<?php echo ($panExt) ? $panExt : 'No file chosen'; ?>">

                                        <input type="hidden" name="old_pan" value="<?= $user_info->pan_file ?>">

                                    </div>
                                    <div class="error-msg">

                                    </div>
                                </div>

                                <div class="pan_no_err">

                                </div>



                                <div class="kyc-form-cntrl">

                                    <label>11. Education Background <span class="text-red">*</span></label>

                                    <select name="education" id="education">

                                        <option value="">Select Education Background</option>

                                        <option value="Post-Graduation & Above" <?php if ($user_info->education == "Post-Graduation & Above") echo "selected"; ?>>

                                            Post-Graduation & Above</option>

                                        <option value="Graduation" <?php if ($user_info->education == "Graduation") echo "selected"; ?>>

                                            Graduation</option>

                                        <option value="Intermediate / 12th pass" <?php if ($user_info->education == "Intermediate / 12th pass") echo "selected"; ?>>

                                            Intermediate / 12th pass</option>

                                        <option value="Matriculation/10th pass" <?php if ($user_info->education == "Matriculation/10th pass") echo "selected"; ?>>

                                            Matriculation/10th pass</option>

                                        <option value="10th & Below" <?php if ($user_info->education == "10th & Below") echo "selected"; ?>>10th &

                                            Below</option>

                                        <option value="No Schooling" <?php if ($user_info->education == "No Schooling") echo "selected"; ?>>No

                                            Schooling</option>

                                    </select>
                                    <div class="error-msg">

                                    </div>
                                </div>


                                <div class="kyc-form-cntrl">

                                    <label>12. Employment Status <span class="text-red">*</span></label>

                                    <select name="employment" id="employment">

                                        <option value="">Select Employment Status</option>

                                        <option value="Part-time Employee" <?php if ($user_info->employment == "Part-Time Employee") echo "selected"; ?>>

                                            Part-Time Employee</option>

                                        <option value="Seasonal Employee" <?php if ($user_info->employment == "Seasonal Employee") echo "selected"; ?>>

                                            Seasonal Employee</option>

                                        <option value="Full time Employee" <?php if ($user_info->employment == "Full-Time Employee") echo "selected"; ?>>

                                            Full-Time Employee</option>

                                        <option value="I am an Entrepreneur/ Business Woman" <?php if ($user_info->employment == "I am an Entrepreneur/ Business Woman") echo "selected"; ?>>

                                            I am an Entrepreneur/ Business Woman</option>

                                        <option value="Unemployed" <?php if ($user_info->employment == "Unemployed") echo "selected"; ?>>

                                            Unemployed</option>

                                        <option value="Others" <?php if ($user_info->employment == "Others") echo "selected"; ?>>Others

                                        </option>

                                    </select>
                                    <div class="error-msg">

                                    </div>
                                </div>

                                <div class="kyc-form-cntrl">

                                    <label>13. Did you take support from any of the following institutions? <span class="text-red">*</span></label>

                                    <select name="institution" id="otherInstitute">

                                        <option value="">Select institutions</option>

                                        <option value="SHG, SERP" <?php if ($user_info->institution == "SHG, SERP") echo "selected"; ?>>SHG,

                                            SERP</option>

                                        <option value="SHG, MEPMA" <?php if ($user_info->institution == "SHG, MEPMA") echo "selected"; ?>> SHG,

                                            MEPMA</option>

                                        <option value="Incubation Centres" <?php if ($user_info->institution == "Incubation Centres") echo "selected"; ?>>

                                            Incubation Centres</option>

                                        <option value="Others" <?php if ($user_info->institution == "Others") echo "selected"; ?>> Others

                                        </option>

                                        <option value="No" <?php if ($user_info->institution == "No") echo "selected"; ?>> No

                                        </option>

                                    </select>
                                    <div class="error-msg">

                                    </div>
                                </div>

                                <div class="kyc-form-cntrl" style="display:none;" id="otherInsName">

                                    <label>Other institution name? <span class="text-red">*</span></label>

                                    <input type="text" name="otherInstitutes" id="otherInstitute" value="<?= $user_info->otherInstitute ?>" />
                                    <div class="error-msg">

                                    </div>
                                </div>



                                <div class="kyc-form-cntrl">

                                    <p>14. Are you a PWD (Person With Disability) ? <span class="text-red">*</span></p>

                                    <div class="kyc-radio">

                                        <div>

                                            <input type="radio" name="pwd" id="pwd_yes" value="Yes" <?php if ($user_info->pwd == "Yes") echo "checked"; ?> />

                                            <label for="pwd_yes">Yes</label>

                                        </div>

                                        <div>

                                            <input type="radio" name="pwd" id="pwd_no" value="No" <?php if ($user_info->pwd == "No") echo "checked"; ?> />

                                            <label for="pwd_no">No</label>

                                        </div>

                                    </div>
                                    <div class="error-msg">

                                    </div>
                                </div>

                                <?php if ($user_info->status == "1" or $user_info->status == "4" or $user_info->status == "5") {  ?>

                                    <div class="kyc-form-cntrl">

                                        <div class="kyc-form-buttons">

                                            <input type="submit" name="draft" value="Save Draft">

                                            <input type="submit" name="submit" value="Submit KYC" class="active">

                                        </div>

                                    </div>

                                <?php } ?>

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

                if (x == 'Others')

                {

                    $("#otherInsName").show();

                } else

                {

                    $("#otherInsName").hide();

                }

            })

        })
    </script>



    <script src="<?php echo base_url('assets/js/notify.min.js'); ?>"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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

                if (diffYear < 18)

                {

                    $.notify('Age should be atleast 18 years', 'danger');

                    $("#dob").val('');

                    return false;

                }

            });

        });
</script>

    <script>
        $(document).ready(function() {
            $('#kyc_form_validate').submit(function(event) {
                event.preventDefault();
                var data = $('#kyc_form_validate').serialize();
                console.log(data);
                var gramPanchayath = $('#gram_panchayath').val();
                var district = $('#district').val();

                console.log(district);
                $('.error-msg').empty();

                var isValid = true;

                var fullName = $('#name').val().trim();
                if (fullName === '')  {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(0) .error-msg').text('Full Name is required.');
                }
                if(!isValidName(fullName)){
                    isValid = false;
                    $('.kyc-form-cntrl:eq(0) .error-msg').text('Enter valid full name.');
                }

                var email = $('#email').val();
                if (email === '') {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(1) .error-msg').text('Please enter a valid Email.');
                }

                var phoneNumber = $('#mobile_code').val().trim();
                if (phoneNumber === '' || !isValidPhoneNumber(phoneNumber)) {
                    isValid = false;
                    $.notify('Enter valid email', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
                    // $('.kyc-form-cntrl:eq(2) .error-msg').text('Please enter a valid Phone number.');
                }

                var dob = $('#dob').val().trim();
                if (dob === '') {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(3) .error-msg').text('Date of Birth is required.');
                }

                var category = $('#category').val();
                if (category === '') {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(4) .error-msg').text('Category is required.');
                }

                var district = $('#district').val();
                if (district === '' || district === null) {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(5) .error-msg').text('District is required.');
                }

                if (district) {
                    var mandal = $('#mandal').val();
                    if (mandal === '' || mandal === null) {
                        isValid = false;
                        $('.kyc-form-cntrl:eq(6) .error-msg').text('Mandal is required.');
                    }
                    var gramPanchayath = $('#gram_panchayath').val();
                    if (gramPanchayath === '' || gramPanchayath === null) {
                        isValid = false;
                        $('.kyc-form-cntrl:eq(7) .error-msg').text('Gram Panchayath is required.');
                    }
                }


                var aadharNumber = $('#aadhar_no').val().trim();
                if (aadharNumber === '' || !isValidAadharNumber(aadharNumber)) {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(8) .error-msg').text('Please enter a valid Aadhar Number.');
                }

                var panNumber = $('#pan_no').val().trim();
                if (panNumber === '' || !isValidPANNumber(panNumber)) {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(9) .error-msg').text('Please enter a valid PAN Number.');
                }

                var education = $('#education').val();
                if (education === '') {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(10) .error-msg').text('Education Background is required.');
                }

                var employment = $('#employment').val();
                if (employment === '') {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(11) .error-msg').text('Employment Status is required.');
                }

                var institution = $('#otherInstitute').val();
                if (institution === '') {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(12) .error-msg').text('Institution is required.');
                }

                var pwdSelected = false;
                $('.kyc-radio input[name="pwd"]').each(function() {
                    if ($(this).prop('checked')) {
                        pwdSelected = true;
                    }
                });

                if (!pwdSelected) {
                    isValid = false;
                    $('.kyc-form-cntrl:eq(13) .error-msg').text('Please select if you are a PWD.');
                }

                if (isValid) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '<?php echo base_url() ?>user/kyc',
                        data: $('#kyc_form_validate').serialize(),
                        success: function(response) {
                            console.log(response.success);
                            if (response.success === true) {
                                $('#msg').html(response.message);
                                location.reload();
                                window.location.href = "<?php echo base_url() ?>user";
                            } else {
                                $('#msg').html(response.message);

                            }

                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
            function isValidName(fullName) {
                var namePattern = /^[A-Za-z]+(?: [A-Za-z]+)?$/;
                return namePattern.test(fullName);
            }
            function isValidPhoneNumber(phoneNumber) {
                var phoneNumberPattern = /^[0-9]{10}$/;
                return phoneNumberPattern.test(phoneNumber);
            }

            function isValidAadharNumber(aadharNumber) {
                var aadharPattern = /^[0-9]{12}$/;
                return aadharPattern.test(aadharNumber);
            }

            function isValidPANNumber(panNumber) {
                var panPattern = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
                return panPattern.test(panNumber);
            }
        });
    </script>


























    <script>
        // Get a reference to our adhaar file input;

        const fileInput = document.querySelector('input[name="aadhar_card"]');

        const fileExt = document.getElementById("adharFlExt").value;

        if (fileExt != 'No file chosen') {

            var fileName = "....." + fileExt;

        } else {

            var fileName = 'No file chosen';

        }

        const myFile = new File(['No file chosen'], fileName, {

            type: 'text/plain',

            lastModified: new Date(),

        });

        const dataTransfer = new DataTransfer();

        dataTransfer.items.add(myFile);

        fileInput.files = dataTransfer.files;
    </script>





    <script>
        // Get a reference to our adhaar file input;

        const filePanCard = document.querySelector('input[name="pan_card"]');

        const fileExtPan = document.getElementById("panFlExt").value;

        if (fileExtPan != 'No file chosen') {

            var fileNames = "....." + fileExtPan;

        } else {

            var fileNames = 'No file chosen';

        }

        const pnFile = new File(['No file chosen'], fileNames, {

            type: 'text/plain',

            lastModified: new Date(),

        });

        const dataPanTransfer = new DataTransfer();

        dataPanTransfer.items.add(pnFile);

        filePanCard.files = dataPanTransfer.files;
    </script>



    <?php $this->load->view('user-footer'); ?>

</body>



</html>