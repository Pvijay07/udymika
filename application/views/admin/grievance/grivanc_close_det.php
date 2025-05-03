<?php $this->load->view('admin/head'); ?>

<body>
    <div class="dashboard-page admin_grie_vance2">
      <div class="container">
        <div class="dashboard-main">
        <?php $this->load->view('admin/menus'); ?>

          <div class="dashboard-main-ryt">
            <?php $this->load->view('admin/header'); ?>
                <div class="mob-menu-bar">
                    <img src="https://xhtmlreviews.com/udyam/assets/images/main-logo.png" alt="logo">
                    <a id='menu-button' href="#">
                      <span></span>
                      <span></span>
                      <span></span>
                    </a>
                 </div>
              <div class="dash-seections enterprise-sec">
                <div class="ad-kyc-nav">
                  <div class="ad-kyc-nav-top">
                    <ul>
                      <li><a href="javascript:void(0);"><img src="<?php echo base_url('assets/images/home-icon.png');?>" /></a></li>
                      <li><a href="javascript:void(0);">Certification</a></li>
                      <li class="active"><a href="#"><?= $user_info->name; ?></a></li>
                    </ul>
                  </div>
                  <div class="ad-kyc-sub-info">
                    <div>
                      <h2><?= $user_info->name; ?></h2>
                      <p><?= $user_info->email; ?></p>
                    </div>
                    <div class="kyc-business-details">
                     
                       <div>
                        <h6>Ticket Number</h6>
                        <p><?= $user_info->adhaar_no; ?></p>
                      </div>
                       <div>
                        <h6>Phone Number</h6>
                        <p>+91 <?= $user_info->phone; ?></p>
                      </div>
                       <div>
                        <h6>Query Status</h6>
                        <p class="sub-btn-kyc stsBgStg" id="kycStatusPopup"><?=$griev->status; ?> <img src="<?php echo base_url('assets/images/re-write.png'); ?>" /></p>
                      </div>
                    </div>
                  </div>
                </div>
                <section class="kyc-form-section">
                                <div class="kyc-heading identifyCustStg" id="kyc-heading">
                                    <ul id="nav-tab custTabStg">
                                        <li class="custTabMenuListStg" id="KYC">
                                            <a href="#tab1">KYC</a>
                                        </li>
                                        <li class="custTabMenuListStg" id="Certification">
                                            <a href="#tab2">Certification</a>
                                        </li>
                                        <li class="custTabMenuListStg" id="Additional">
                                            <a href="#tab3" style="font-size: 14px;">Additional Document</a>
                                        </li>
                                        <li class="custTabMenuListStg" id="Remarks">
                                            <a href="#tab4">Remarks</a>
                                        </li>
                                        <li class="custTabMenuListStg active" id="Grievance">
                                            <label href="#tab5">Grievance</label>
                                        </li>
                                        <li class="custTabMenuListStg" id="Checklist">
                                            <label href="#tab6">Checklist</label>
                                        </li>
                                    </ul>
                                    <div>
                                        <div class="down-btns">
                                            <a class="schedule-btn" id="scheduleMeeting"><img src="<?php echo base_url('assets/images/calender.png'); ?>" />Schedule Meeting</a>
                                        </div>
                                    </div>
                                </div>

                                <div id="kyc_sec" style="display:none;">
                                    <form class="kyc-form" method="post" action="<?=base_url("user/kyc")?>">
                                        <div class="kyc-form-cntrl">
                                            <label>Full Name</label>
                                            <input type="text" placeholder="Full name" name="name" data-validation="required"
                                                value="<?=$user_info->name?>" />
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>Email</label>
                                            <input type="Email" name="email" placeholder="you@company.com"
                                                data-validation="email" value="<?=$user_info->email?>" />
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>Phone number</label>
                                            <input type="text" id="mobile_code" name="phone" class="form-control"
                                                placeholder="Phone Number" maxlength="10" data-validation="number,length"
                                                data-validation-length="min10" data-validation-length="max10"
                                                value="<?=$user_info->phone?>">
                                        </div>
                                        <div class="kyc-drop-form">
                                            <div class="kyc-form-cntrl">
                                                <label>Date of Birth</label>
                                                <input type="date" name="dob" placeholder="you@company.com"
                                                    data-validation="required" value="<?=$user_info->dob?>" />
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>Category</label>
                                                <select name="category">
                                                    <option value="">Select Category</option>
                                                    <option value="OC"
                                                        <?php if($user_info->category == "OC") echo "selected"; ?>>OC</option>
                                                    <option value="OBC"
                                                        <?php if($user_info->category == "OBC") echo "selected"; ?>>OBC</option>
                                                    <option value="BC-A/B/C/D"
                                                        <?php if($user_info->category == "BC-A/B/C/D") echo "selected"; ?>>
                                                        BC-A/B/C/D</option>
                                                    <option value="SC"
                                                        <?php if($user_info->category == "SC") echo "selected"; ?>>SC</option>
                                                    <option value="ST"
                                                        <?php if($user_info->category == "ST") echo "selected"; ?>>ST</option>
                                                    <option value="Prefer not to Say"
                                                        <?php if($user_info->category == "Prefer not to Say") echo "selected"; ?>>
                                                        Prefer not to Say</option>
                                                </select>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>District</label>
                                                <select name="district" class="district">
                                                    <option>Select District</option>
                                                    <?php foreach($disticts as $district){ ?>
                                                    <option value="<?=$district->id?>"
                                                        <?php if($district->id == $user_info->district) echo "selected"; ?>>
                                                        <?=$district->name?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>Mandal</label>
                                                <select name="mandal" class="mandal">
                                                    <option value="">Select Mandal</option>
                                                </select>
                                            </div>
                                           
                                 
                                                <div class="kyc-form-cntrl">
                                                    <label>Aadhar</label>
                                                    <div class="file-path">
                                                        <input name="aadhar_no" type="text" placeholder="Enter Aadhar No."
                                                            maxlength="12" data-validation="number,length"
                                                            data-validation-length="min12" data-validation-length="max12"
                                                            value="<?=$user_info->adhaar_no?>" />
                                                        <input type="file" name="aadhar_card" class="custom-file-input">
                                                        <input type="hidden" name="old_aadhar" value="<?=$user_info->adhaar_file?>">
                                                    </div>
                                                </div>
                                                <div class="kyc-form-cntrl">
                                                    <label>PAN card</label>
                                                    <div class="file-path">
                                                        <input type="text" name="pan_no" placeholder="Enter PAN No." maxlength="10"
                                                            data-validation="length" data-validation-length="min10"
                                                            data-validation-length="max10" value="<?=$user_info->pan_no?>" />
                                                        <input type="file" name="pan_card" class="custom-file-input">
                                                        <input type="hidden" name="old_pan" value="<?=$user_info->pan_file?>">
                                                    </div>
                                                </div>
                                            <div class="kyc-form-cntrl">
                                                <label>Education background</label>
                                                <select name="education">
                                                    <option value="">Select Education Background</option>
                                                    <option value="Post-Graduation & Above"
                                                        <?php if($user_info->education == "Post-Graduation & Above") echo "selected"; ?>>
                                                        Post-Graduation & Above</option>
                                                    <option value="Graduation"
                                                        <?php if($user_info->education == "Graduation") echo "selected"; ?>>
                                                        Graduation</option>
                                                    <option value="Intermediate / 12th pass"
                                                        <?php if($user_info->education == "Intermediate / 12th pass") echo "selected"; ?>>
                                                        Intermediate / 12th pass</option>
                                                    <option value="Matriculation/10th pass"
                                                        <?php if($user_info->education == "Matriculation/10th pass") echo "selected"; ?>>
                                                        Matriculation/10th pass</option>
                                                    <option value="10th & Below"
                                                        <?php if($user_info->education == "10th & Below") echo "selected"; ?>>10th &
                                                        Below</option>
                                                    <option value="No Schooling"
                                                        <?php if($user_info->education == "No Schooling") echo "selected"; ?>>No
                                                        Schooling</option>
                                                </select>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>Employment Status</label>
                                                <select name="employment">
                                                    <option value="">Select Employment Status</option>
                                                    <option value="Part-time Employee"
                                                        <?php if($user_info->employment == "Part-time Employee") echo "selected"; ?>>
                                                        Part-time Employee</option>
                                                    <option value="Seasonal Employee"
                                                        <?php if($user_info->employment == "Seasonal Employee") echo "selected"; ?>>
                                                        Seasonal Employee</option>
                                                    <option value="Full time Employee"
                                                        <?php if($user_info->employment == "Full time Employee") echo "selected"; ?>>
                                                        Full time Employee</option>
                                                    <option value="I am an Entrepreneur/ Business Woman"
                                                        <?php if($user_info->employment == "I am an Entrepreneur/ Business Woman") echo "selected"; ?>>
                                                        I am an Entrepreneur/ Business Woman</option>
                                                    <option value="Unemployed"
                                                        <?php if($user_info->employment == "Unemployed") echo "selected"; ?>>
                                                        Unemployed</option>
                                                    <option value="Others"
                                                        <?php if($user_info->employment == "Others") echo "selected"; ?>>Others
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>Did you take support from any of the following institutions?</label>
                                                <select name="institution">
                                                    <option value="">Select institutions</option>
                                                    <option value="SHG, SERP"
                                                        <?php if($user_info->institution == "SHG, SERP") echo "selected"; ?>>SHG,
                                                        SERP</option>
                                                    <option value="SHG, MEPMA"
                                                        <?php if($user_info->institution == "SHG, MEPMA") echo "selected"; ?>> SHG,
                                                        MEPMA</option>
                                                    <option value="Incubation Centres"
                                                        <?php if($user_info->institution == "Incubation Centres") echo "selected"; ?>>
                                                        Incubation Centres</option>
                                                    <option value="Others"
                                                        <?php if($user_info->institution == "Others") echo "selected"; ?>> Others
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>Are you a Pwd?</label>
                                                <div class="kyc-radio">
                                                    <div>
                                                        <input type="radio" name="pwd" value="Yes"
                                                            <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                        <label>Yes</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="pwd" value="No"
                                                            <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                        <label>No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <div class="kyc-form-buttons">
                                                <button>Save draft</button>
                                                <input type="submit" name="submit" class="active" value="Submit" />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div id="certification_sec" style="display:none;">
                                    <form action="<?=base_url("user/enterprise")?>" method="post" enctype="multipart/form-data">                          
                                        <div class="kyc-form-cntrl">
                                            <label>Aadhar</label>
                                            <div class="file-path">
                                                <input name="aadhar_no" type="text" placeholder="Enter Aadhar No."
                                                    maxlength="12" data-validation="number,length"
                                                    data-validation-length="min12" data-validation-length="max12"
                                                    value="<?=$user_info->adhaar_no?>" />
                                                <input type="file" name="aadhar_card" class="custom-file-input">
                                                <input type="hidden" name="old_aadhar" value="<?=$user_info->adhaar_file?>">
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>PAN card</label>
                                            <div class="file-path">
                                                <input type="text" name="pan_no" placeholder="Enter PAN No." maxlength="10"
                                                    data-validation="length" data-validation-length="min10"
                                                    data-validation-length="max10" value="<?=$user_info->pan_no?>" />
                                                <input type="file" name="pan_card" class="custom-file-input">
                                                <input type="hidden" name="old_pan" value="<?=$user_info->pan_file?>">
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <div class="kyc-form-buttons">
                                                <button>Save draft</button>
                                                <input type="submit" name="submit" class="active" value="Submit" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="add_doc_sec" style="display:none;">
                                    <form action="<?=base_url("user/enterprise")?>" method="post" enctype="multipart/form-data">                          
                                        <div class="kyc-form-cntrl">
                                            <label>add doc</label>
                                            <div class="file-path">
                                                <input name="aadhar_no" type="text" placeholder="Enter Aadhar No."
                                                    maxlength="12" data-validation="number,length"
                                                    data-validation-length="min12" data-validation-length="max12"
                                                    value="<?=$user_info->adhaar_no?>" />
                                                <input type="file" name="aadhar_card" class="custom-file-input">
                                                <input type="hidden" name="old_aadhar" value="<?=$user_info->adhaar_file?>">
                                            </div>
                                        </div>
                                        
                                        <div class="kyc-form-cntrl">
                                            <div class="kyc-form-buttons">
                                                <button>Save draft</button>
                                                <input type="submit" name="submit" class="active" value="Submit" />
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div id="remarks_sec" style="display:none;">
                                    <form action="<?=base_url("user/enterprise")?>" method="post" enctype="multipart/form-data">                          
                                        <div class="kyc-form-cntrl">
                                            <label>remark</label>
                                            <div class="file-path">
                                                <input name="aadhar_no" type="text" placeholder="Enter Aadhar No."
                                                    maxlength="12" data-validation="number,length"
                                                    data-validation-length="min12" data-validation-length="max12"
                                                    value="<?=$user_info->adhaar_no?>" />
                                                <input type="file" name="aadhar_card" class="custom-file-input">
                                                <input type="hidden" name="old_aadhar" value="<?=$user_info->adhaar_file?>">
                                            </div>
                                        </div>
                                        
                                        <div class="kyc-form-cntrl">
                                            <div class="kyc-form-buttons">
                                                <button>Save draft</button>
                                                <input type="submit" name="submit" class="active" value="Submit" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="grievance_sec">
                                    <div class="row tmt">
                                        <div class="col-lg-6">
                                            <form action="<?=base_url("master_grivance_submit"); ?>" method="post" enctype="multipart/form-data">                          
                                                <div class="doc-sub-form">
                                                    <label>Subject</label>
                                                    <input name="griv_subject" type="text" placeholder="Subject" />
                                                    <input name="griv_type" type="hidden" value="Raised" />
                                                    <input name="user_id" type="hidden" value="<?= $user_info->id; ?>" />
                                                    <input name="user_type" type="hidden" value="User" />
                                                    <input name="ticket_id" type="hidden" value="<?php echo $griev->id; ?>" />
                                                    <input name="page_detail" type="hidden" value="<?php echo 'master_grievance_close_details'; ?>" />
                                                </div>
                                                <div class="doc-sub-form">
                                                    <label>File</label>
                                                    <input type="file" name="griv_file" class="custom-file-input">
                                                </div>
                                                <div class="doc-sub-form">
                                                    <label>Remarks</label>
                                                    <textarea name="griv_details" type="text" class="custom-input"></textarea>
                                                </div>
                                                
                                                <div class="doc-sub-form">
                                                    <div class="kyc-form-buttons col-lg-4">
                                                        <input type="submit" name="submit" class="active" value="Chat" />
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-5">
                                            <div class="grievncsDiv">
                                                <h4>Earlier Grievances</h4>
                                                <?php
                                                foreach ($grievance as $grvnc) { ?>
                                                     <p class="grievncsDivPStg"><span><?php echo $grvnc['grievance_id']; ?></span><span class="grvnceSpanStg"><a href="<?php echo $grvnc['id']; ?>">view</a></span></p>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div id="checklist_sec" style="display:none;">
                                    <form action="<?=base_url("user/enterprise")?>" method="post" enctype="multipart/form-data">                          
                                        <div class="kyc-form-cntrl">
                                            <label>Is there physical unit</label>
                                            <div class="kyc-radio">
                                                <div>
                                                    <input type="radio" name="pwd" value="Yes" id="physicalUnit"
                                                        <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                    <label for="physicalUnit">Yes</label> 
                                                </div>
                                                <div style="margin-left:20px;">
                                                    <div>
                                                        <input type="radio" name="pwd" value="Yes" id="physicalUnit"
                                                            <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                        <label for="physicalUnit">Own</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="pwd" value="Yes" id="physicalUnit"
                                                            <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                        <label for="physicalUnit">Rented</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="pwd" value="Yes" id="physicalUnit"
                                                            <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                        <label for="physicalUnit">Leased</label>
                                                    </div>
                                                </div>
                                                <div>
                                                    <input type="radio" name="pwd" value="No" id="physicalUnitNo"
                                                        <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                    <label for="physicalUnitNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="kyc-form-cntrl">
                                            <label>Does the enterprenuer maintain employee register</label>
                                            <div class="kyc-radio">
                                                <div>
                                                    <input type="radio" name="pwd" value="Yes" id="enterprenuer"
                                                        <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                    <label for="enterprenuer">Yes</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="pwd" value="No" id="enterprenuerNo"
                                                        <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                    <label for="enterprenuerNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>Does the enterprenuers employee any work</label>
                                            <div class="kyc-radio">
                                                <div>
                                                    <input type="radio" name="pwd" value="Yes" id="enterprenuer"
                                                        <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                    <label for="enterprenuer">Yes</label>
                                                </div>
                                                <div style="margin-left:20px;">
                                                    <div>
                                                        <input type="radio" name="pwd" value="Yes" id="physicalUnit"
                                                            <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                        <label for="physicalUnit">How many employee : __________(Add box to fill number)</label>
                                                    </div>
                                                    </div>
                                                <div>
                                                    <input type="radio" name="pwd" value="No" id="enterprenuerNo"
                                                        <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                    <label for="enterprenuerNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>Is there any machinery present at the unit</label>
                                            <div class="kyc-radio">
                                                <div>
                                                    <input type="radio" name="pwd" value="Yes" id="enterprenuer"
                                                        <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                    <label for="enterprenuer">Yes</label>
                                                </div>
                                                <div style="margin-left:20px;">
                                                    <div>
                                                        <input type="radio" name="pwd" value="Yes" id="physicalUnit"
                                                            <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                        <label for="physicalUnit">What is the approxmiate valution of the machinery at the plant : __________(Add box to fill number)</label>
                                                    </div>
                                                    </div>
                                                <div>
                                                    <input type="radio" name="pwd" value="No" id="enterprenuerNo"
                                                        <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                    <label for="enterprenuerNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>Does the enterprenuers maintain bank accounts</label>
                                            <div class="kyc-radio">
                                                <div>
                                                    <input type="radio" name="pwd" value="Yes" id="enterprenuer"
                                                        <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                    <label for="enterprenuer">Yes</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="pwd" value="No" id="enterprenuerNo"
                                                        <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                    <label for="enterprenuerNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>Does the enterprenuers file GST & other compliance of th ebusiness </label>
                                            <div class="kyc-radio">
                                                <div>
                                                    <input type="radio" name="pwd" value="Yes" id="enterprenuer"
                                                        <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                    <label for="enterprenuer">Yes</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="pwd" value="No" id="enterprenuerNo"
                                                        <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                    <label for="enterprenuerNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>Is the row material stocked up at the plant during  the plant visit  </label>
                                            <div class="kyc-radio">
                                                <div>
                                                    <input type="radio" name="pwd" value="Yes" id="enterprenuer"
                                                        <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                    <label for="enterprenuer">Yes</label>
                                                </div>
                                                <div style="margin-left:20px;">
                                                    <div>
                                                        <input type="radio" name="pwd" value="Yes" id="physicalUnit"
                                                            <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                        <label for="physicalUnit">How long does the stock the last : __________(Add box to fill number)</label>
                                                    </div>
                                                    </div>
                                                <div>
                                                    <input type="radio" name="pwd" value="No" id="enterprenuerNo"
                                                        <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                    <label for="enterprenuerNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>Does the firm have the bank account </label>
                                            <div class="kyc-radio">
                                                <div>
                                                    <input type="radio" name="pwd" value="Yes" id="enterprenuer"
                                                        <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                    <label for="enterprenuer">Yes</label>
                                                </div>
                                                <div style="margin-left:20px;">
                                                    <div>
                                                        <input type="radio" name="pwd" value="Yes" id="physicalUnit"
                                                            <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                        <label for="physicalUnit">saving</label>
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="pwd" value="Yes" id="physicalUnit"
                                                            <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                        <label for="physicalUnit">Current</label>
                                                    </div>
                                                    </div>
                                                <div>
                                                    <input type="radio" name="pwd" value="No" id="enterprenuerNo"
                                                        <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                    <label for="enterprenuerNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>What is the approximate  valuation of the unit </label>
                                            <div class="kyc-radio">
                                                <div>
                                                    <input type="radio" name="pwd" value="Yes" id="enterprenuer"
                                                        <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                    <label for="enterprenuer">Yes</label>
                                                </div>
                                                <div style="margin-left:20px;">
                                                    <div>
                                                        <input type="radio" name="pwd" value="Yes" id="physicalUnit"
                                                            <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                        <label for="physicalUnit">What is the approximate  valuation of the machinery  at the plant : __________(Add box to fill number)</label>
                                                    </div>
                                                    </div>
                                                <div>
                                                    <input type="radio" name="pwd" value="No" id="enterprenuerNo"
                                                        <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                    <label for="enterprenuerNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>Do the neighboaring units validate the everyday operations  of the firm? </label>
                                            <div class="kyc-radio">
                                                <div>
                                                    <input type="radio" name="pwd" value="Yes" id="enterprenuer"
                                                        <?php if($user_info->pwd == "Yes") echo "checked"; ?> />
                                                    <label for="enterprenuer">Yes</label>
                                                </div>
                                                <div>
                                                    <input type="radio" name="pwd" value="No" id="enterprenuerNo"
                                                        <?php if($user_info->pwd == "No") echo "checked"; ?> />
                                                    <label for="enterprenuerNo">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="kyc-form-cntrl">
                                            <div class="kyc-form-buttons">
                                                <button>Save draft</button>
                                                <input type="submit" name="submit" class="active" value="Submit" />
                                            </div>
                                        </div> -->
                                    </form>
                                </div>
                                
                                
                                </div>
                            </section>
                        </form>
                    </div>
          </div>
        </div>
        
    </div>


     
    <?php $this->load->view('admin/footer'); ?>
      
   
</body>

</html>
<script>
    $(document).ready(function() {
        $(document).on('click','#KYC',function(){
            $("#kyc_sec").show();
            $("#certification_sec").hide();
            $("#add_doc_sec").hide();
            $("#remarks_sec").hide();
            $("#grievance_sec").hide();
            $("#KYC").addClass("active")
            $("#Certification").removeClass("active");
            $("#Additional").removeClass("active");
            $("#Remarks").removeClass("active");
            $("#Grievance").removeClass("active");
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(document).on('click','#Certification',function(){
            $("#Certification").addClass("custTabMenuListStg active");
            $("#kyc_sec").hide();
            $("#add_doc_sec").hide();
            $("#remarks_sec").hide();
            $("#grievance_sec").hide();
            $("#certification_sec").show();
            $("#KYC").removeClass("active");
            $("#Additional").removeClass("active");
            $("#Remarks").removeClass("active");
            $("#Grievance").removeClass("active");
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(document).on('click','#Additional',function(){
            $("#Additional").addClass("custTabMenuListStg active");
            $("#add_doc_sec").show();
            $("#kyc_sec").hide();
            $("#certification_sec").hide();
            $("#remarks_sec").hide();
            $("#grievance_sec").hide();
            $("#KYC").removeClass("active");
            $("#Certification").removeClass("active");
            $("#Remarks").removeClass("active");
            $("#Grievance").removeClass("active");
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(document).on('click','#Remarks',function(){
            $("#Remarks").addClass("custTabMenuListStg active");
            $("#remarks_sec").show();
            $("#add_doc_sec").hide();
            $("#kyc_sec").hide();
            $("#certification_sec").hide();
            $("#grievance_sec").hide();
            $("#KYC").removeClass("active");
            $("#Certification").removeClass("active");
            $("#Additional").removeClass("active");
            $("#Grievance").removeClass("active");
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(document).on('click','#Grievance',function(){
            $("#Grievance").addClass("custTabMenuListStg active");
            $("#grievance_sec").show();
            $("#remarks_sec").hide();
            $("#add_doc_sec").hide();
            $("#kyc_sec").hide();
            $("#certification_sec").hide();
            $("#KYC").removeClass("active");
            $("#Certification").removeClass("active");
            $("#Additional").removeClass("active");
            $("#Remarks").removeClass("active");
            $("#Checklist").removeClass("active");
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(document).on('click','#Checklist',function(){
            $("#Checklist").addClass("custTabMenuListStg active");
            $("#checklist_sec").show();
            $("#grievance_sec").hide();
            $("#remarks_sec").hide();
            $("#add_doc_sec").hide();
            $("#kyc_sec").hide();
            $("#certification_sec").hide();
            $("#KYC").removeClass("active");
            $("#Certification").removeClass("active");
            $("#Additional").removeClass("active");
            $("#Remarks").removeClass("active");
            $("#Grievance").removeClass("active");
        })
    })
</script>
 
<script type="text/javascript">
    $('#scheduleMeeting').click(function() {
        $('.get-metting').show();
    });

    $('#closePopup').click(function() {
        $('.get-metting').hide();
    });
    </script>

<script>
    $(function() {
      $('.dashboardCls').removeClass('active');
      $('.kycCls').removeClass('active');
      $('.certificateCls').removeClass('active');
      $('.grievanceCls').addClass('active');
      $('.subAdminCls').removeClass('active');
      $('.checklistCls').removeClass('active');
    });
</script>
  