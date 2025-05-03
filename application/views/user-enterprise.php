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
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/styles.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/responsive.css">
    <link href="<?=base_url("assets/")?>css/theme-default.css" rel="stylesheet" />
    <title><?=$title?></title>
    <style type="text/css">
    .frst-tab-unorder>li {
        margin-bottom: 0 !important;
    }
    </style>
</head>

<body>
    <div class="dashboard-page kyc-page user_enter_prise">
        <div class="container">
            <div class="dashboard-main">
                <?php $this->load->view("includes/user-menu.php"); ?>

                <div class="dashboard-main-ryt">

                    <?php $this->load->view("includes/header.php"); ?>

                    <div class="dash-seections enterprise-sec">
                        <form action="<?=base_url("user/enterprise")?>" method="post" enctype="multipart/form-data" id="user_reg_id">
                            
                        <?php if($userSts == 3) { ?>
                        <section>
                                <div class="enter-heading">
                                    <h2>My Enterprise/Certification </h2>
                                    <p>Hi, please fill this form and help us better understand your idea/ business!</p>
                                </div>
                                <div class="identify-sec">
                                    <h6>How do you identify yourself?</h6>
                                    <ul id="tabs-nav">
                                        <?php
                                        
                                        if($userSts == '3' && $option1 == 0 && $option2 == '0' && $option3 == '0')
                                        {
                                            $firstChk = '';
                                            $fstCls = '';
                                            $secChk = '';
                                            $secCls = '';
                                            $thirdChk = '';
                                            $thirdCls = '';
                                        }
                                        elseif($userSts == '3' &&  $option1 != 0 && $option2 == '0' && $option3 == '0')
                                        {
                                            $firstChk = '';
                                            $fstCls = 'disabled';
                                            $secChk = 'checked';
                                            $secCls = '';
                                            $thirdChk = '';
                                            $thirdCls = '';
                                        }
                                        elseif($userSts == '3' &&  $option1 == 0 && $option2 != '0' && $option3 == '0')
                                        {
                                            $firstChk = '';
                                            $fstCls = 'disabled';
                                            $secChk = '';
                                            $secCls = 'disabled';
                                            $thirdChk = 'checked';
                                            $thirdCls = '';
                                        }
                                        elseif($userSts == '3' &&  ($option1 != 0 && $option2 != '0') && ($option3 == '0' || $option3 != '0'))
                                        {
                                            $firstChk = '';
                                            $fstCls = 'disabled';
                                            $secChk = '';
                                            $secCls = 'disabled';
                                            $thirdChk = 'checked';
                                            $thirdCls = '';
                                        }
                                        else
                                        {
                                            $firstChk = '';
                                            $fstCls = 'disabled';
                                            $secChk = '';
                                            $secCls = 'disabled';
                                            $thirdChk = '';
                                            $thirdCls = 'disabled';
                                        }
                                        ?>
                                        <li>
                                            <input type="radio" id="tab1" name="tab" class="checkCls"
                                                value="I want to develop an idea/start a business"
                                                <?php echo $firstChk.' '.$fstCls; ?>>
                                            <label for="tab1">I want to develop an idea/start a business</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="tab2" name="tab" class="checkCls"
                                                value="I have an idea and I have to start"
                                                <?php echo $secChk.' '.$secCls; ?>>
                                            <label for="tab2">I have an idea and I have to start</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="tab3" name="tab" value="I have an existing business" class="checkCls"
                                                <?php echo $thirdChk.' '.$thirdCls;  ?>> <label for="tab3">I have an
                                                existing business</label>
                                        </li>
                                    </ul>
                                </div>
                                <section id="tabs-content">
                                    <article class="frst-tab identify-sec ent-select">
                                        <h6>Select any option </h6>
                                        <ul class="frst-tab-unorder">
                                            <li>
                                                <input type="radio" id="one" name="any_option"
                                                    value="I want to develop an idea/start a business"
                                                    data-validation="required" />
                                                <label for="one">I want to develop an idea/start a business</label>
                                                <ul class="frst-tab-li startup" style="display:none;">
                                                    <h6>Do you want to be part of WE Hub Programs</h6>
                                                    <li>
                                                        <input type="radio" name="we_hub" value="Yes" <?php echo ($option1_data->we_hub=='Yes')?'checked':''; ?>/>
                                                        <label>Yes <a href="#">-> WE Hub program</a></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="we_hub" value="No" <?php echo ($option1_data->we_hub=='No')?'checked':''; ?>/>
                                                        <label>No <a href="#">-> redirect to forum</a></label>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <input type="radio" id="two" name="any_option" value="I want a job"
                                                    data-validation="required" />
                                                <label for="two">I want a job</label>
                                                <ul class="frst-tab-li job" style="display:none;">
                                                    <h6>Do you have a resume</h6>
                                                    <li>
                                                        <input type="radio" name="is_resume" value="Yes" <?php echo ($option1_data->is_resume=='Yes')?'checked':''; ?>/>
                                                        <label>Yes </label>
                                                        <label><input type="file" name="resume" id="resume" value="<?php echo $option1_data->resume; ?>" style="display:none;"/></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="is_resume" value="No" <?php echo ($option1_data->is_resume=='No')?'checked':''; ?>/>
                                                        <label>No <a href="#">-> resume builder</a></label>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <input type="radio" id="three" name="any_option"
                                                    value="I want training support" data-validation="required" />
                                                <label for="three">I want training support</label>
                                                <ul class="frst-tab-li support" style="display:none;">
                                                    <li>
                                                        <input type="radio" name="training" value="EDO" <?php echo ($option1_data->training=='EDO')?'checked':''; ?>/>
                                                        <label>EDP (Enterprise Development Program)  <a href=" #">-> WE Hub program</a></label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" name="training" value="Skilling" <?php echo ($option1_data->training=='Skilling')?'checked':''; ?>/>
                                                        <label>Skilling</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="eight" name="training" value="Other" <?php echo ($option1_data->training=='Other')?'checked':''; ?>/>
                                                        <label for="eight">Other</label>
                                                    </li>
                                                    <li class="enty-other-input" >
                                                        <input type="text" name="training_other"  id="training_other" value="<?php echo $option1_data->training_other;; ?>" style="display:none;"/>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </article>

                                    <article class="start-business enty-fit-under">
                                        <div class="start-que">
                                            <div>
                                                <h6>Explain your business idea? <span class="text-red">*</span></h6>
                                                <textarea name="business" id="business" placeholder="Explain your business idea"
                                                    data-validation="required"><?php echo $option2_data->business; ?></textarea>
                                            </div>
                                            <div>
                                                <h6>Which sector does your idea belong to? <span class="text-red">*</span></h6>
                                                <select name="sector" id="sector" data-validation="required">
                                                    <option value=""> Select Sector</option>
                                                    <?php foreach($sectors as $sector) { ?>
                                                        <option value="<?=$sector?>" <?php if($option2_data->sector == $sector){ echo "selected"; } ?> ><?=$sector?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <section>
                                            <div class="enty-cate">
                                                <ul>
                                                    <h6>Which category do you fit under?</h6>
                                                    <li>
                                                        <input type="radio" id="four" name="category" value="Product" <?php echo ($option2_data->category == 'Product')?'checked':''; ?> />
                                                        <label for="four">Product</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="five" name="category" value="Service" <?php echo ($option2_data->category == 'Service')?'checked':''; ?>/>
                                                        <label for="five">Service</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="six" name="category" value="Software" <?php echo ($option2_data->category == 'Software')?'checked':''; ?>/>
                                                        <label for="six">Software</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="seven" name="category" value="Trade" <?php echo ($option2_data->category == 'Trade')?'checked':''; ?>/>
                                                        <label for="seven">Trade</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="eight" name="category" value="Other" <?php echo ($option2_data->category == 'Other')?'checked':''; ?>/>
                                                        <label for="eight">Other</label>
                                                    </li>
                                                    <li class="enty-other-input">
                                                        <input type="text" name="category_other" id="category_other" value="<?php echo $option2_data->category_other; ?>" style="display:none;"/>
                                                    </li>
                                                </ul>

                                                <ul>
                                                    <h6>I am looking for support? </h6>
                                                    <li>
                                                        <?php $optTwoIdea = $this->db->query("select count(*) as total from support_option_two where cert_id = '$option2_data->enterprise_id' and supportName = 'Idea & Market Validation'")->row(); ?>
                                                        <input type="checkbox" id="nine" name="supportOptTwo[]"
                                                            value="Idea & Market Validation" <?php echo ($optTwoIdea->total)?'checked':''; ?>/>
                                                        <label for="nine">Idea & Market Validation</label>
                                                    </li>
                                                    <li>
                                                         <?php $optTwoDev = $this->db->query("select count(*) as total from support_option_two where cert_id = '$option2_data->enterprise_id' and supportName = 'Development of prototype'")->row(); ?>
                                                        <input type="checkbox" id="ten" name="supportOptTwo[]"
                                                            value="Development of prototype" <?php echo ($optTwoDev->total)?'checked':''; ?>/>
                                                        <label for="ten">Development of prototype</label>
                                                    </li>
                                                    <li>
                                                        <?php $optTwoReg = $this->db->query("select count(*) as total from support_option_two where cert_id = '$option2_data->enterprise_id' and supportName = 'Registration of Business Support'")->row(); ?>
                                                        <input type="checkbox" id="eleven" name="supportOptTwo[]"
                                                            value="Registration of Business Support" <?php echo ($optTwoReg->total)?'checked':''; ?>/>
                                                        <label for="eleven">Registration of Business Support</label>
                                                    </li>
                                                    <li>
                                                        <?php $optTwoOth = $this->db->query("select count(*) as total from support_option_two where cert_id = '$option2_data->enterprise_id' and supportName = 'Other'")->row(); ?>
                                                        <input type="checkbox" id="twelve" name="supportOptTwo[]" value="Other" <?php echo ($optTwoOth->total)?'checked':''; ?>/>
                                                        <label for="twelve">Other</label>
                                                    </li>
                                                    <li class="enty-other-input">
                                                        <input type="text" name="support_other" id="support_other" value="<?php echo $option2_data->support_other; ?>" style="<?php echo $option2_data->support_other?'display:block;':'display:none;'; ?>"/>
                                                    </li>
                                                </ul>

                                                <div class="kyc-form-cntrl">
                                                    <p>Upload DPR/B-Plan </p>
                                                    <div class="kyc-radio">
                                                        <div>
                                                            <input type="radio" id="kyc-radio" name="dpr" value="Yes" <?php echo ($option2_data->dpr == 'Yes')?'checked':''; ?>/>
                                                            <label for="kyc-radio">Yes    </label>
                                                            <label><input name="dpr_file" id="dpr_file" type="file" style="display:none;" value="<?php echo $option2_data->drp_file; ?>"/>  </label>
                                                        </div>
                                                        <div>
                                                            <input type="radio" id="kyc-radios" name="dpr" value="No" <?php echo ($option2_data->dpr == 'No')?'checked':''; ?>/>
                                                            <label for="kyc-radios">No</label>
                                                        </div>
                                                         
                                                    </div>
                                                </div><br>
                                                
                                            </div>
                                        </section>
                                    </article>

                                    <article class="start-business">
                                        <div class=" start-que">
                                            <div>
                                                <h6>Explain your business idea? <span class="text-red">*</span></h6>
                                                <textarea name="idea" data-validation="required"
                                                    placeholder="Explain your business idea" id="buss_idea"><?php echo $option3_data->business; ?></textarea>
                                            </div>
                                            <div>
                                                <h6>Which sector does your idea belong to? <span class="text-red">*</span></h6>
                                                <select name="sector2" data-validation="required" id="sector_id">
                                                    <option value=""> Select Sector</option>
                                                    <?php foreach($sectors as $sector) { ?>
                                                    <option value="<?=$sector?>"
                                                        <?php if($option3_data->sector == $sector){ echo "selected"; }?>>
                                                        <?=$sector?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <section>
                                            <div class="enty-cate">
                                                <ul>
                                                    <h6>How long has your business been in operation? <span class="text-red">*</span></h6>
                                                    <li>
                                                        <input type="radio" id="1yr" name="operation" value="< 1 year"
                                                            <?php echo ($option3_data->business_operation == "< 1 year")?"checked":""; ?> />
                                                        <label for="1yr">
                                                            < 1 year</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="2yrs" name="operation" value="< 2 years"
                                                            <?php echo ($option3_data->business_operation == "< 2 years")?"checked":""; ?> />
                                                        <label for="2yrs">
                                                            < 2 years</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="3yrs" name="operation" value="< 3 years"
                                                            <?php echo ($option3_data->business_operation == "< 3 years")?"checked":""; ?> />
                                                        <label for="3yrs">
                                                            < 3 years</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="4yrs" name="operation" value="< 4 years"
                                                            <?php echo ($option3_data->business_operation == "< 4 years")?"checked":""; ?> />
                                                        <label for="4yrs">
                                                            < 4 years</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="5yrs" name="operation" value="< 5 years"
                                                            <?php echo ($option3_data->business_operation == "< 5 years")?"checked":""; ?> />
                                                        <label for="5yrs">
                                                            < 5 years</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="6yrs" name="operation" value="< 6 years"
                                                            <?php echo ($option3_data->business_operation == "< 6 years")?"checked":""; ?> />

                                                        <label for="6yrs">
                                                            < 6 years</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="7yrs" name="operation" value="> 7 years"
                                                            <?php echo ($option3_data->business_operation == "> 7 years")?"checked":""; ?> />
                                                        <label for="7yrs">> 7 years</label>
                                                    </li>
                                                </ul>

                                                <ul>
                                                    <h6>Which category do you fit under? <span class="text-red">*</span></h6>
                                                    <li>
                                                        <input type="radio" id="product" name="fit" value="Product" <?php  echo ($option3_data->category == "Product")?"checked":""; ?> />
                                                        <label for="product">Product</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="service" name="fit" value="Service" <?php
                                                            echo ($option3_data->category == "Service")?"checked":"";  ?> />
                                                        <label for="service">Service</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="software" name="fit" value="Software" <?php
                                                            echo ($option3_data->category == "Software")?"checked":""; ?> />
                                                        <label for="software">Software</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="trade" name="fit" value="Trade" <?php
                                                            echo ($option3_data->category == "Trade")?"checked":"";  ?> />
                                                        <label for="trade">Trade</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="other" name="fit" value="Other" <?php
                                                            echo ($option3_data->category == "Other")?"checked":"";  ?> />
                                                        <label for="other">Other</label>
                                                    </li>
                                                    <li class="enty-other-input">
                                                        <input type="text" name="fit_other" id="fit_other" value="
                                                            <?php echo $option3_data->category_text;?>" style="display:none;" />
                                                    </li>
                                                </ul>

                                                <ul>
                                                    <h6>What is capital investment till date (Fixed/working capital)? <span class="text-red">*</span>
                                                    </h6>
                                                    <li>
                                                        <input type="radio" id="onel" name="investment" value="0-1 lakh" <?php
                                                            echo ($option3_data->working_capital == "0-1 lakh")?"checked":"";  ?> />
                                                        <label for="onel">0-1 lakh</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="twol" name="investment"
                                                            value="1-2 lakhs" <?php
                                                            echo ($option3_data->working_capital == "1-2 lakhs")?"checked":"";  ?> />
                                                        <label for="twol">1-2 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="threel" name="investment"
                                                            value="2-5 lakhs" <?php
                                                            echo ($option3_data->working_capital == "2-5 lakhs")?"checked":""; ?> />
                                                        <label for="threel">2-5 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="fourl" name="investment"
                                                            value="5-7 lakhs" <?php
                                                            echo ($option3_data->working_capital == "5-7 lakhs")?"checked":""; ?> />
                                                        <label for="fourl">5-7 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="fivel" name="investment"
                                                            value="7-10 lakhs" <?php
                                                            echo ($option3_data->working_capital == "7-10 lakhs")?"checked":"";  ?> />
                                                        <label for="fivel">7-10 lakhs</label>
                                                    </li>
                                                    <!--<li>
                                                        <input type="radio" id="sixl" name="investment" value="10 lakhs" <?php
                                                            echo ($option3_data->working_capital == "10 lakhs")?"checked":"";  ?> />
                                                        <label for="sixl">10 lakhs</label>
                                                    </li>-->
                                                    <li>
                                                        <input type="radio" id="sevenl" name="investment"
                                                            value="10 lac - 25 lacs" <?php
                                                            echo ($option3_data->working_capital == "10 lac - 25 lacs")?"checked":""; ?> />
                                                        <label for="sevenl">10 lac - 25 lacs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="eightl" name="investment"
                                                            value="20 - 50 lacs" <?php
                                                            echo ($option3_data->working_capital == "20 - 50 lacs")?"checked":""; ?> />
                                                        <label for="eightl">25 - 50 lacs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="ninel" name="investment"
                                                            value="50 lac - 1 cr" <?php
                                                            echo ($option3_data->working_capital == "50 lac - 1 cr")?"checked":""; ?> />
                                                        <label for="ninel">50 lac - 1 cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="tenl" name="investment"
                                                            value="1 cr - 2cr" <?php
                                                            echo ($option3_data->working_capital == "1 cr - 2cr")?"checked":""; ?> />
                                                        <label for="tenl">1 cr - 2cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="elevenl" name="investment"
                                                            value="2 cr - 5cr" <?php
                                                            echo ($option3_data->working_capital == "2 cr - 5cr")?"checked":""; ?> />
                                                        <label for="elevenl">2 cr - 5cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="twelvel" name="investment"
                                                            value="5cr - 10cr" <?php
                                                            echo ($option3_data->working_capital == "5cr - 10cr")?"checked":""; ?> />
                                                        <label for="twelvel">5cr - 10cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="thirteenl" name="investment"
                                                            value=">10cr" <?php
                                                            echo ($option3_data->working_capital == ">10cr")?"checked":""; ?> />
                                                        <label for="thirteenl">>10cr</label>
                                                    </li>
                                                </ul>

                                                <ul>
                                                    <h6>What type of investment? <span class="text-red">*</span></h6>
                                                    <li>
                                                        <input type="checkbox" id="boot" name="investment_type[]"
                                                            value="Bootstrapped/Family and Friends" <?php
                                                            echo ($option3_data->investment_type == "Bootstrapped/Family and Friends")?"checked":""; ?> />
                                                        <label for="boot">Bootstrapped/Family and Friends</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="equity" name="investment_type[]"
                                                            value="Equity" <?php
                                                            echo ($option3_data->investment_type == "Equity")?"checked":""; ?> />
                                                        <label for="equity">Equity</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="debenture" name="investment_type[]"
                                                            value="Debentures/Convertible Debentures" <?php
                                                            echo ($option3_data->investment_type == "Debentures/Convertible Debentures")?"checked":'';  ?> />
                                                        <label for="debenture">Debentures/Convertible Debentures</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="loan" name="investment_type[]"
                                                            value="Debt/Loan/Credit Linkage" <?php
                                                            echo($option3_data->investment_type == "Debt/Loan/Credit Linkage")?"checked":'';  ?> />
                                                        <label for="loan">Debt/Loan/Credit Linkage</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="support" name="investment_type[]" value="Grant/Support fund/Government
                                                            Schemes" <?php
                                                            echo ($option3_data->investment_type == "Grant/Support fund/Government
                                                                Schemes")?"checked":'';  ?> />
                                                        <label for="support">Grant/Support fund/Government
                                                            Schemes</label>
                                                    </li>
                                                    <li>
                                                        <input type="checkbox" id="fund" name="investment_type[]" class="invTypeOther"
                                                            value="Other" <?php
                                                            echo ($option3_data->investment_type == "Other")?"checked":''; ?> />
                                                        <label for="fund">Other</label>
                                                        
                                                    </li>
                                                    <li class="enty-other-input">
                                                        <input type="text" name="invTypeOther" id="invTypeOther" value="
                                                            <?php echo $option3_data->investment_typeOther;?>" style="display:none;" />
                                                    </li>
                                                </ul>


                                                <ul>
                                                    <h6>What is your monthly revenue? <span class="text-red">*</span></h6>
                                                    <li>
                                                        <input type="radio" id="rev1" name="revenue" value="0-1 lakh" <?php
                                                            echo($option3_data->monthly_revenue == "0-1 lakh")?"checked":''; ?> />
                                                        <label for="rev1">0-1 lakh</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev2" name="revenue" value="1-2 lakhs" <?php
                                                            echo ($option3_data->monthly_revenue == "1-2 lakhs")?"checked":''; ?> />
                                                        <label for="rev2">1-2 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev3" name="revenue" value="2-5 lakhs" <?php
                                                            echo ($option3_data->monthly_revenue == "2-5 lakhs")?"checked":''; ?> />
                                                        <label for="rev3">2-5 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev4" name="revenue" value="5-7 lakhs" <?php
                                                            echo ($option3_data->monthly_revenue == "5-7 lakhs")?"checked":''; ?> />
                                                        <label for="rev4">5-7 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev5" name="revenue" value="7-10 lakhs" <?php
                                                            echo ($option3_data->monthly_revenue == "7-10 lakhs")?"checked":''; ?> />
                                                        <label for="rev5">7-10 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev6" name="revenue" value="10 lakhs" <?php
                                                            echo ($option3_data->monthly_revenue == "10 lakhs")?"checked":''; ?> />
                                                        <label for="rev6">10 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev7" name="revenue"
                                                            value="10 lac - 25 lacs" <?php
                                                           echo ($option3_data->monthly_revenue == "10 lac - 25 lacs")?"checked":''; ?> />
                                                        <label for="rev7">10 lac - 25 lacs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev8" name="revenue" value="20 - 50 lacs" <?php
                                                            echo ($option3_data->monthly_revenue == "20 - 50 lacs")?"checked":''; ?> />
                                                        <label for="rev8">20 - 50 lacs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev9" name="revenue" value="50 lac - 1 cr" <?php
                                                            echo ($option3_data->monthly_revenue == "50 lac - 1 cr")?"checked":''; ?> />
                                                        <label for="rev9">50 lac - 1 cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev10" name="revenue" value="1 cr - 2cr" <?php
                                                            echo ($option3_data->monthly_revenue == "1 cr - 2cr")?"checked":''; ?> />
                                                        <label for="rev10">1 cr - 2cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev11" name="revenue" value="2 cr - 5cr" <?php
                                                            echo ($option3_data->monthly_revenue == "2 cr - 5cr")?"checked":''; ?> />
                                                        <label for="rev11">2 cr - 5cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev12" name="revenue" value="5cr - 10cr" <?php
                                                           echo ($option3_data->monthly_revenue == "5cr - 10cr")?"checked":''; ?> />
                                                        <label for="rev12">5cr - 10cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="rev13" name="revenue" value=">10cr" <?php
                                                            echo ($option3_data->monthly_revenue == ">10cr")?"checked":''; ?> />
                                                        <label for="rev13">>10cr</label>
                                                    </li>
                                                </ul>

                                                <ul>
                                                    <h6>What is your annual turnover? <span class="text-red">*</span></h6>
                                                    <li>
                                                        <input type="radio" id="anul1" name="turnover" value="0-1 lakh" <?php
                                                            echo ($option3_data->annual_turnover == "0-1 lakh")?"checked":''; ?> />
                                                        <label for="anul1">0-1 lakh</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="anul2" name="turnover" value="1-2 lakhs" <?php
                                                            echo ($option3_data->annual_turnover == "1-2 lakhs")?"checked":''; ?> />
                                                        <label for="anul2">1-2 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="anul3" name="turnover" value="2-5 lakhs" <?php
                                                            echo ($option3_data->annual_turnover == "2-5 lakhs")?"checked":''; ?> />
                                                        <label for="anul3">2-5 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="anul4" name="turnover" value="5-7 lakhs" <?php
                                                            echo ($option3_data->annual_turnover == "5-7 lakhs")?"checked":''; ?> />
                                                        <label for="anul4">5-7 lakhs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="anul5" name="turnover" value="7-10 lakhs" <?php
                                                            echo ($option3_data->annual_turnover == "7-10 lakhs")?"checked":'';  ?> />
                                                        <label for="anul5">7-10 lakhs</label>
                                                    </li>
                                                    <!-- <li>
                                                        <input type="radio" id="anul6" name="turnover" value="10 lakhs" <?php
                                                            echo ($option3_data->annual_turnover == "10 lakhs")?"checked":'';  ?> />
                                                        <label for="anul6">10 lakhs</label>
                                                    </li> -->
                                                    <li>
                                                        <input type="radio" id="anul7" name="turnover"
                                                            value="10 lac - 25 lacs" <?php
                                                            echo ($option3_data->annual_turnover == "10 lac - 25 lacs")?"checked":''; ?> />
                                                        <label for="anul7">10 lac - 25 lacs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="anul8" name="turnover" value="20 - 50 lacs" <?php
                                                            echo ($option3_data->annual_turnover == "20 - 50 lacs")?"checked":''; ?> />
                                                        <label for="anul8">20 - 50 lacs</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="anul9" name="turnover" value="50 lac - 1 cr" <?php
                                                            echo ($option3_data->annual_turnover == "50 lac - 1 cr")?"checked":''; ?> />
                                                        <label for="anul9">50 lac - 1 cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="anul10" name="turnover" value="1 cr - 2cr" <?php
                                                            echo ($option3_data->annual_turnover == "1 cr - 2cr")?"checked":'';  ?> />
                                                        <label for="anul10">1 cr - 2cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="anul11" name="turnover" value="2 cr - 5cr" <?php
                                                            echo ($option3_data->annual_turnover == "2 cr - 5cr")?"checked":''; ?> />
                                                        <label for="anul11">2 cr - 5cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="anul12" name="turnover" value="5cr - 10cr" <?php
                                                            echo ($option3_data->annual_turnover == "5cr - 10cr")?"checked":''; ?> />
                                                        <label for="anul12">5cr - 10cr</label>
                                                    </li>
                                                    <li>
                                                        <input type="radio" id="anul13" name="turnover" value=">10cr" <?php
                                                            echo ($option3_data->annual_turnover == ">10cr")?"checked":''; ?> />
                                                        <label for="anul13">>10cr</label>
                                                    </li>
                                                </ul>


                                                <div class="kyc-form-cntrl">
                                                    <p>Do you have any employees? <span class="text-red">*</span></p>
                                                    <div class="kyc-radio">
                                                        <div>
                                                            <div class="kyc-employee-btns">
                                                                <input type="radio" id="emp1" name="empcount" value="Yes" <?php
                                                            echo ($option3_data->employee == "Yes")?"checked":''; ?> />
                                                                <label for="emp1">Yes</label>
                                                            </div>

                                                            <ul class="empcountdiv" <?php
                                                            echo ($option3_data->employee == "Yes")?'style="display:block;"':'style="display:none;"';  ?>
                                                                >
                                                                <h6>Number of Current Employees ?</h6>
                                                                <li>
                                                                    <input name="no_emp" type="number"
                                                                        value="<?php echo $option3_data->no_emp; ?>" />
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div>
                                                            <div class=" kyc-employee-btns">
                                                                <input type="radio" id="emp2" name="empcount" value="No" <?php
                                                            echo ($option3_data->employee == "No")?"checked":'';  ?> />
                                                                <label for="emp2">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kyc-form-cntrl kyc-form-cntrl2">
                                                    <p>Is your business registered? <span class="text-red">*</span></p>
                                                    <div class="kyc-radio">
                                                        
                                                        <div>
                                                            <div class="kyc-employee-btns">
                                                                <input type="radio" id="reg1" name="regvrfy" value="Yes" <?php
                                                            echo ($option3_data->business_register == "Yes")?"checked":''; ?> />
                                                                <label for="reg1">Yes</label>
                                                            </div>

                                                            <ul class="support-hub ifreg" <?php
                                                            echo ($option3_data->business_register == "Yes")?'style="display:block;"':'style="display:none;"'; ?>>
                                                                <h6>Legal Status of the Company?</h6>
                                                                <li>
                                                                    <input type="radio" id="solo1" name="legal_status"
                                                                        value="Sole Proprietorship" <?php
                                                            echo ($option3_data->legal_status == "Sole Proprietorship")?"checked":''; ?> />
                                                                    <label for="solo1">Sole Proprietorship &nbsp;
                                                                        <input name="solo_file" id="solo_file" type="file"
                                                                            data-validation="required"
                                                                            data-validation-depends-on="legal_status"
                                                                            data-validation-error-msg="Please Upload Document"
                                                                            data-validation-depends-on-value="Sole Proprietorship" style="<?php
                                                            echo ($option3_data->legal_status == "Sole Proprietorship")?"":'display:none'; ?>" /></label>
                                                            <?php if(!empty($option3_data->solo_file)) { ?>
                                                                <label><a href="<?php echo base_url($option3_data->solo_file); ?>" target="_blank">
                                                                <img src="<?=base_url("assets/")?>images/eye--icon.png" /></a></label>
                                                            <?php } ?>

                                                                            <input name="solo_hdn_file" id="solo_hdn_file" type="hidden" value="<?php echo $option3_data->solo_file;?>">
                                                                </li>
                                                                <li>
                                                                    <input type="radio" id="part1" name="legal_status"
                                                                        value="Partnership" <?php
                                                            echo ($option3_data->legal_status == "Partnership")?"checked":''; ?> />
                                                                    <label for="part1">Partnership &nbsp; <input
                                                                            name="partnership_file" id="partnership_file" type="file"
                                                                            data-validation="required"
                                                                            data-validation-depends-on="legal_status"
                                                                            data-validation-error-msg="Please Upload Document"
                                                                            data-validation-depends-on-value="Partnership" style="<?php
                                                            echo ($option3_data->legal_status == "Partnership")?"":'display:none'; ?>"/></label>
                                                            <?php if(!empty($option3_data->partnership_file)) { ?>
                                                                <label><a href="<?php echo base_url($option3_data->partnership_file); ?>" target="_blank">
                                                                <img src="<?=base_url("assets/")?>images/eye--icon.png" /></a></label>
                                                            <?php } ?>
                                                                            <input name="partnership_hdn_file" id="partnership_hdn_file" type="hidden" value="<?php echo $option3_data->partnership_file;?>">
                                                                </li>
                                                                <li>
                                                                    <input type="radio" id="comp1" name="legal_status"
                                                                        value="One person Company" <?php
                                                            echo ($option3_data->legal_status == "One person Company")?"checked":''; ?> />
                                                                    <label for="comp1">One person Company &nbsp; <input
                                                                            name="company_file" id="company_file" type="file"
                                                                            data-validation="required"
                                                                            data-validation-depends-on="legal_status"
                                                                            data-validation-error-msg="Please Upload Document"
                                                                            data-validation-depends-on-value="One person Company" style="<?php
                                                            echo ($option3_data->legal_status == "One person Company")?"":'display:none'; ?>"/></label>
                                                            <?php if(!empty($option3_data->company_file)) { ?>
                                                                <label><a href="<?php echo base_url($option3_data->company_file); ?>" target="_blank">
                                                                <img src="<?=base_url("assets/")?>images/eye--icon.png" /></a></label>
                                                            <?php } ?>
                                                                            <input name="company_hdn_file" id="company_hdn_file" type="hidden" value="<?php echo $option3_data->company_file;?>">
                                                                </li>
                                                                <li>
                                                                    <input type="radio" id="ltd1" name="legal_status"
                                                                        value="Private Limited Company(Pvt. Ltd.)" <?php
                                                            echo ($option3_data->legal_status == "Private Limited Company(Pvt. Ltd.)")?"checked":''; ?> />
                                                                    <label for="ltd1">Private Limited Company(Pvt. Ltd.)
                                                                        &nbsp;
                                                                        <input name="pvt_file" id="pvt_file" type="file"
                                                                            data-validation="required"
                                                                            data-validation-depends-on="legal_status"
                                                                            data-validation-error-msg="Please Upload Document"
                                                                            data-validation-depends-on-value="Private Limited Company(Pvt. Ltd.)" style="<?php
                                                            echo ($option3_data->legal_status == "Private Limited Company(Pvt. Ltd.)")?"":'display:none'; ?>"/></label>
                                                             <?php if(!empty($option3_data->pvt_file)) { ?>
                                                                <label><a href="<?php echo base_url($option3_data->pvt_file); ?>" target="_blank">
                                                                <img src="<?=base_url("assets/")?>images/eye--icon.png" /></a></label>
                                                            <?php } ?>
                                                            
                                                                            <input name="pvt_hdn_file" id="pvt_hdn_file" type="hidden" value="<?php echo $option3_data->pvt_file;?>">
                                                                </li>
                                                                <li>
                                                                    <input type="radio" id="llf1" name="legal_status"
                                                                        value="Limited Liability Firm (LLP Firm)" <?php
                                                            echo ($option3_data->legal_status == "Limited Liability Firm (LLP Firm)")?"checked":''; ?> />
                                                                    <label for="llf1">Limited Liability Firm (LLP Firm)
                                                                        &nbsp;
                                                                        <input name="llp_file" id="llp_file" type="file"
                                                                            data-validation="required"
                                                                            data-validation-depends-on="legal_status"
                                                                            data-validation-error-msg="Please Upload Document"
                                                                            data-validation-depends-on-value="Limited Liability Firm (LLP Firm)" style="<?php
                                                            echo ($option3_data->legal_status == "Limited Liability Firm (LLP Firm)")?"":'display:none'; ?>"/></label>
                                                            <?php if(!empty($option3_data->llp_file)) { ?>
                                                                <label><a href="<?php echo base_url($option3_data->llp_file); ?>" target="_blank">
                                                                <img src="<?=base_url("assets/")?>images/eye--icon.png" /></a></label>
                                                            <?php } ?>
                                                                            <input name="llp_hdn_file" id="llp_hdn_file" type="hidden" value="<?php echo $option3_data->llp_file;?>">
                                                                </li>
                                                            </ul>

                                                            <ul class="support-hub ifreg" <?php
                                                            echo ($option3_data->business_register == "Yes")?'style="display:block;"':'style="display:none;"'; ?> >
                                                                <h6>Does the Company have DPIIT Registration?</h6>
                                                               
                                                                <li>
                                                                    <input type="radio" id="reg2" name="dpit" value="Yes" <?php
                                                            echo ($option3_data->dpiit == "Yes")?"checked":''; ?> />
                                                                    <label for="reg2">Yes</label>
                                                                     <label for=""> <input style="<?php
                                                            echo ($option3_data->dpiit == "Yes")?"":'display:none'; ?>"
                                                                            name="dpit_file" id="dpit_file" type="file"
                                                                            data-validation="required"
                                                                            data-validation-depends-on="dpit"
                                                                            data-validation-error-msg="Please Upload Document"
                                                                            data-validation-depends-on-value="Yes"  /></label>

                                                                            <?php if(!empty($option3_data->dpiit_file)) { ?>
                                                                <label><a href="<?php echo base_url($option3_data->dpiit_file); ?>" target="_blank">
                                                                <img src="<?=base_url("assets/")?>images/eye--icon.png" /></a></label>
                                                            <?php } ?>
                                                                            <input name="dpit_hdn_file" id="dpit_hdn_file" type="hidden" value="<?php echo $option3_data->dpiit_file;?>">
                                                                </li>
                                                                <li>
                                                                    <input type="radio" id="dpt3" name="dpit" value="No" <?php
                                                            echo ($option3_data->dpiit == "No")?"checked":''; ?> />
                                                                    <label for="dpt3">No</label>
                                                                </li>
                                                                 
                                                                   
                                                                </li>
                                                            </ul>

                                                            <ul class=" support-hub ifreg" <?php
                                                            echo ($option3_data->business_register == "Yes")?'style="display:block;"':'style="display:none;"'; ?>>
                                                                <h6>Does the Company have Udyam Registration?
                                                                </h6>
                                                               
                                                                <li>
                                                                    <input type="radio" id="ud1" name="udyam" value="Yes" <?php
                                                            echo ($option3_data->udyam == "Yes")?"checked":''; ?> />
                                                                    <label for="ud1">Yes</label>
                                                                     <label for=""> <input
                                                                            name="udyam_file" id="udyam_file" type="file" style="<?php
                                                            echo ($option3_data->udyam == "Yes")?"":'display:none'; ?>"
                                                                            data-validation="required"
                                                                            data-validation-depends-on="udyam"
                                                                            data-validation-error-msg="Please Upload Document"
                                                                            data-validation-depends-on-value="Yes" /></label>
                                                                            <?php if(!empty($option3_data->udyam_file)) { ?>
                                                                <label><a href="<?php echo base_url($option3_data->udyam_file); ?>" target="_blank">
                                                                <img src="<?=base_url("assets/")?>images/eye--icon.png" /></a></label>
                                                            <?php } ?>
                                                                            <input name="udyam_hdn_file" id="udyam_hdn_file" type="hidden" value="<?php echo $option3_data->udyam_file;?>">
                                                                </li>
                                                                <li>
                                                                    <input type="radio" id="ud2" name="udyam" value="No" <?php
                                                            echo ($option3_data->udyam == "No")?"checked":''; ?> />
                                                                    <label for="ud2">No</label>
                                                                </li>
                                                                
                                                            </ul>

                                                            <ul class="support-hub ifreg" <?php
                                                            echo ($option3_data->business_register == "Yes")?'style="display:block;"':'style="display:none;"'; ?>>
                                                                <h6>Has the Company raised any external investment?</h6>
                                                                <li>
                                                                    <input type="radio" id="inv1" name="ext_investment"
                                                                        value="Yes" <?php
                                                            echo ($option3_data->ext_investment == "Yes")? "checked":'';  ?> />
                                                                    <label for="inv1">Yes</label>
                                                                </li>
                                                                <li>
                                                                    <input type="radio" id="inv2" name="ext_investment"
                                                                        value="No" <?php
                                                            echo ($option3_data->ext_investment == "No")?"checked":''; ?> />
                                                                    <label for="inv2">No</label>
                                                                </li>
                                                            </ul>

                                                            <ul class="support-hub ifreg" <?php
                                                            echo ($option3_data->business_register == "Yes")?'style="display:block;"':'style="display:none;"'; ?>>
                                                                <h6>Upload other documents:</h6>
                                                                <li>
                                                                    <label for=""><br> GST of company, PAN of company &nbsp; <input
                                                                            name="gst_file" id="gst_file" type="file" /></label>
                                                                            <?php if(!empty($option3_data->gst_file)) { ?>
                                                                <label><a href="<?php echo base_url($option3_data->gst_file); ?>" target="_blank">
                                                                <img src="<?=base_url("assets/")?>images/eye--icon.png" /></a></label>
                                                            <?php } ?>
                                                                            <input name="gst_hdn_file" id="gst_hdn_file" type="hidden" value="<?php echo $option3_data->gst_file;?>">
                                                                </li>
                                                                <input type="hidden" name="pan_file" id="pan_file" type="file" />
                                                                <!-- <li>
                                                                    <label for="">- PAN of company &nbsp; <input
                                                                            name="pan_file" id="pan_file" type="file" /></label>
                                                                </li> -->
                                                                <li>
                                                                    <label for="">- Audited Financials
                                                                        <br>
                                                                        licenses,IPR,Trademarks,Lease,Agreements
                                                                        &nbsp; <input name="audited_file" id="audited_file" type="file" />
                                                                    </label>
                                                                    <?php if(!empty($option3_data->audited_file)) { ?>
                                                                <label><a href="<?php echo base_url($option3_data->audited_file); ?>" target="_blank">
                                                                <img src="<?=base_url("assets/")?>images/eye--icon.png" /></a></label>
                                                            <?php } ?>
                                                                    <input name="audited_hdn_file" id="audited_hdn_file" type="hidden" value="<?php echo $option3_data->audited_file;?>">
                                                                </li>

                                                            </ul>
                                                            
                                                        </div>
                                                        <div>
                                                            <div class="kyc-employee-btns">
                                                                <input type="radio" id="reg3" name="regvrfy" value="No" <?php
                                                            echo ($option3_data->business_register == "No")?"checked":''; ?> />
                                                                <label for="reg3">No</label>
                                                            </div>
                                                            <ul class="support-hub notreg" style="display:none;"
                                                                <?php
                                                            echo ($option3_data->business_register == "No")?'style="display:block;"':'style="display:none;"'; ?>>
                                                                <h6>What kind of support do you need from WEHub ?</h6>
                                                                <li>
                                                                    <input type="checkbox" id="" name="support_kind[]"
                                                                        value="I want to register my business" <?php
                                                            echo ($option3_data->kind_support == "I want to register my business")?'checked':''; ?> />
                                                                    <label for="">I want to register my business</label>
                                                                </li>
                                                                <li>
                                                                    <input type="checkbox" id="" name="support_kind[]"
                                                                        value="I need mentorship support" <?php
                                                            echo ($option3_data->kind_support == "I need mentorship support")?'checked':''; ?> />
                                                                    <label for="">I need mentorship support</label>
                                                                </li>
                                                                <li>
                                                                    <input type="checkbox" id="" name="support_kind[]" value="I want access to service
                                                                        providers" <?php
                                                            echo ($option3_data->kind_support == "I want access to service
                                                                providers")?'checked':''; ?> />
                                                                    <label for="">I want access to service
                                                                        providers</label>
                                                                </li>
                                                                <li>
                                                                    <input type="checkbox" id="" name="support_kind[]"
                                                                        value="All the above" <?php
                                                            echo ($option3_data->kind_support == "All the above")?'checked':''; ?> />
                                                                    <label for="">All the above</label>
                                                                </li>
                                                                <li>
                                                                    <input type="checkbox" id="support_kind" name="support_kind[]"  value="Others" 
                                                                        <?php  echo ($option3_data->kind_support == "Others")?'checked':''; ?> />
                                                                    <label for="">Others</label>
                                                                </li>
                                                                <li class="enty-other-input" id="enterprise"  style="display:none;">
                                                                    <input name="enterprise" type="text" value="<?php echo $option3_data->enterprise; ?>">
                                                                </li>
                                                            </ul>
                                                        </div>
                                                         
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </article>

                                </section>
                                <?php
                                if($option1 == 0 || $option2 == '0' || $option3 == '0')  { ?>
                                 <div class="kyc-form-cntrl">
                                    <div class="kyc-form-buttons">
                                        <input type="submit" name="draft" value="Save draft" /> 
                                        <input type="submit" name="submit" class="active" value="Submit" />
                                    </div>
                                </div>
                               <?php  } ?>
                               
                            </section>
                        </form>
                        <?php } else { ?>
                        <section>
                            <div class="enter-heading">
                                <h2>My Enterprise </h2>
                                <p>kyc under verification</p>
                            </div>
                        </section>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/28d7e4550d.js" crossorigin="anonymous"></script>
    <script src="<?=base_url("assets/")?>js/jquery-3.6.0.min.js"></script>
<script src="<?=base_url("assets/")?>js/jquery.form-validator.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'>

    </script>

    <script>
    $('[name=tab]').each(function(i, d) {
        var p = $(this).prop('checked');
        //   console.log(p);
        if (p) {
            $('article').eq(i)
                .addClass('on');
        }
    });

    $('[name=tab]').on('change', function() {
        var p = $(this).prop('checked');

        // $(type).index(this) == nth-of-type
        var i = $('[name=tab]').index(this);

        $('article').removeClass('on');
        $('article').eq(i).addClass('on');
    });


    // Show the first tab and hide the rest
    $('#kyc-heading li:first-child').addClass('active');
    $('.tab-content').hide();
    $('.tab-content:first').show();

    // Click function
    $('#kyc-heading li').click(function() {
        $('#kyc-heading li').removeClass('active');
        $(this).addClass('active');
        $('.tab-content').hide();

        var activeTab = $(this).find('a').attr('href');
        $(activeTab).fadeIn();
        return false;
    });

    $('.down-pop_up').click(function() {
        $('#doc-down-load').show(500);
    });

    $('#raise-grev').click(function() {
        $('.grev-raise_pop').show(500);
    });
    $('.forum-pop').click(function() {
        $('.query-forum').show(500);
    });

    $('#ad-document').click(function() {
        $('.dash-board-popup').show(500);
    });

    $('.cht-experience').click(function() {
        $('.experience-con').show(500);
        $('.query-forum').hide(500);
    });

    $('.experience-con a').click(function() {
        $('.experience-con').hide(500);
    });


    $('.frst-tab-unorder > li').click(function() {
        $('.frst-tab-li').hide();
        $(this).find('ul').show();
    });

    $('input[type=radio][name=age]').change(function() {
        if (this.value == 'startup') {
            $('.frst-tab-li').hide();
            $('.startup').show();
        } else if (this.value == 'job') {
            $('.frst-tab-li').hide();
            $('.job').show();
        } else if (this.value == 'support') {
            $('.frst-tab-li').hide();
            $('.support').show();
        }
    });
    $('input[type=radio][name=empcount]').change(function() {
        if (this.value == 'Yes') {
            $('ul.empcountdiv').show();
        } else if (this.value == 'No') {
            $('ul.empcountdiv').hide();
        }
    });
    $('input[type=radio][name=regvrfy]').change(function() {
        if (this.value == 'Yes') {
            $('ul.ifreg').show();
            $('ul.notreg').hide();
        } else if (this.value == 'No') {
            $('ul.ifreg').hide();
            $('ul.notreg').show();

        }
    });
    $('input[type=radio][name=dpit]').change(function() {
        if (this.value == 'Yes') {
            $('#dpit_file').show();
        } else if (this.value == 'No') {
            $('#dpit_file').hide();
        }
    });
    $('input[type=radio][name=udyam]').change(function() {
        if (this.value == 'Yes') {
            $('#udyam_file').show();
        } else if (this.value == 'No') {
            $('#udyam_file').hide();
        }
    });
    </script>

    <script>
    $(function() {
        $.validate({
            modules: 'logic'
        });
    });
    </script>
     <?php $this->load->view('user-footer'); ?>
</body>

</html>
<script src="<?php echo base_url('assets/js/notify.min.js');?>"></script>

<script>
$(document).ready(function(){
	$("#user_reg_id").attr('autocomplete', 'off');
	$("#user_reg_id").on('submit',function(){
	    var tab3 =  $("input[name='tab']:checked").length;
        if(tab3 == '0')
        {
            $.notify('Select any tab option','danger');
            return false;
        }
        else
        {
            var tabVal =  $("input[type='radio'][name='tab']:checked").val(); 
            if(tabVal == 'I have an existing business')
            {
                let buss_idea = $("#buss_idea").val();
                let sector_id = $("#sector_id").val();
                var isReg = $("input[name=regvrfy]");
                var regSel = isReg.filter(":checked").val();
                if(buss_idea =='' || buss_idea == null)
                {
                    $.notify('Enter business ideas','danger');
                    return false;
                }
                if(sector_id =='' || sector_id == null)
                {
                    $.notify('Select business sector','danger');
                    return false;
                }
                if(regSel == 'Yes')
                {
                    if (($("#solo_file").val() == '') && ($("#partnership_file").val() == '') && ($("#company_file").val() == '') && ($("#pvt_file").val() == '') && ($("#llp_file").val() == '') && ($("#gst_file").val() == '') && ($("#pan_file").val() == '') && ($("#audited_file").val() == '') && ($("#solo_hdn_file").val() == '') && ($("#partnership_hdn_file").val() == '') && ($("#company_hdn_file").val() == '') && ($("#pvt_hdn_file").val() == '') && ($("#llp_hdn_file").val() == '') && ($("#dpit_hdn_file").val() == '')) {
                        $.notify('Upload atleast one documents','danger');
                        return false;
                    }  
                }
            }
            else if(tabVal == 'I have an idea and I have to start')
            {
                let buss_idea = $("#sector").val();
                let sector_id = $("#business").val();
                if(buss_idea =='' || buss_idea == null)
                {
                    $.notify('Enter business ideas','danger');
                    return false;
                }
                if(sector_id =='' || sector_id == null)
                {
                    $.notify('Select business sector','danger');
                    return false;
                }
            }
            else if(tabVal == 'I want to develop an idea/start a business')
            {
                let we_hub = $("input[name='any_option']:checked").length;
                if(!we_hub || we_hub == '')
                {
                    $.notify('Select any option','danger');
                    return false;
                }
            }  
        }
	});
});
</script>
<script>
     $('input[type=radio][name=is_resume]').change(function() {
        if (this.value == 'Yes') {
            $('#resume').show();
        } else  {
            $('#resume').hide();
        }
    });
     
     $('input[type=radio][name=training]').change(function() {
        if (this.value == 'Other') {
            $('#training_other').show();
        } else  {
            $('#training_other').hide();
        }
    });
/** second form validate **/
     $('input[type=radio][name=category]').change(function() {
        if (this.value == 'Other') {
            $('#category_other').show();
        } else  {
            $('#category_other').hide();
        }
    });
    $('input[type=radio][name=support]').change(function() {
        if (this.value == 'Other') {
            $('#support_other').show();
        } else  {
            $('#support_other').hide();
        }
    });

    $('input[type=radio][name=dpr]').change(function() {
        if (this.value == 'Yes') {
            $('#dpr_file').show();
        } else  {
            $('#dpr_file').hide();
        }
    });
    /** third form validation**/
    $('input[type=radio][name=fit]').change(function() {
        if (this.value == 'Other') {
            $('#fit_other').show();
        } else  {
            $('#fit_other').hide();
        }
    });

    $('input[type=radio][name=support_kind]').change(function() {
        if (this.value == 'Others') {
            $('#enterprise').show();
        } else  {
            $('#enterprise').hide();
        }
    });

    $('input[type=radio][name=legal_status]').change(function() {
        if (this.value == 'Sole Proprietorship') {
            $('#solo_file').show();
            $('#partnership_file').hide();
            $('#company_file').hide();
            $('#pvt_file').hide();
            $('#llp_file').hide();
        } else if (this.value == 'Partnership')  {
            $('#partnership_file').show();
            $('#solo_file').hide();
            $('#company_file').hide();
            $('#pvt_file').hide();
            $('#llp_file').hide();
        } else if (this.value == 'One person Company')  {
            $('#company_file').show();
            $('#solo_file').hide();
            $('#partnership_file').hide();
            $('#pvt_file').hide();
            $('#llp_file').hide();
        } else if (this.value == 'Private Limited Company(Pvt. Ltd.)')  {
            $('#pvt_file').show();
            $('#company_file').hide();
            $('#solo_file').hide();
            $('#partnership_file').hide();
            $('#llp_file').hide();
        } else if (this.value == 'Limited Liability Firm (LLP Firm)')  {
            $('#llp_file').show();
            $('#pvt_file').hide();
            $('#company_file').hide();
            $('#solo_file').hide();
            $('#partnership_file').hide();
        }
    });

    $('#fund').change(function(ev) {
        if ( $(this).is(':checked') ) 
        {
            $('#invTypeOther').show();
        }
        else  {
            $('#invTypeOther').hide();
        } 
    });

    $('#support_kind').change(function(ev) {
        if ( $(this).is(':checked') ) 
        {
            $('#enterprise').show();
        }
        else  {
            $('#enterprise').hide();
        } 
    });
    
    $('#twelve').change(function(ev) {
        if ( $(this).is(':checked') ) 
        {
            $('#support_other').show();
        }
        else  {
            $('#support_other').hide();
        } 
    });

     

 
</script>

