<?php $this->load->view('admin/head'); ?>
<style>
    div#ticketDivSec {
        padding-bottom: 30px;
        text-align: center;
    }
</style>

<body>
    <div class="dashboard-page admin_griev_ance1">
        <div class="container">
            <div class="dashboard-main">
                <?php $this->load->view('admin/menus'); ?>

                <div class="dashboard-main-ryt">
                    <?php $this->load->view('admin/header'); ?>
                    <div class="dash-seections enterprise-sec">

                        <div class="ad-kyc-nav">
                            <div class="ad-kyc-nav-top">
                                <ul>
                                    <li><a href="javascript:void(0);"><img src="<?php echo base_url('assets/images/home-icon.png'); ?>" /></a></li>
                                    <li><a href="javascript:void(0);">Grievance</a></li>
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
                                        <p><?= $griev->grievance_id; ?></p>
                                        <input type="hidden" value="<?= $griev->grievance_id; ?>" id="hid_ticket" />
                                    </div>
                                    <div>
                                        <h6>Query Type</h6>
                                        <p><?= $griev->query_type; ?></p>
                                    </div>
                                    <div>
                                        <h6>Query Status</h6>
                                        <p class="sub-btn-kyc stsBgStg" id="kycStatusPopup"><?= $griev->status; ?> <img src="<?php echo base_url('assets/images/re-write.png'); ?>" /></p>
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
                                        <a href="#tab5">Raise a Query</a>
                                    </li>
                                    <li class="custTabMenuListStg" id="Checklist">
                                        <a href="#tab6">Checklist</a>
                                    </li>
                                </ul>
                                <div>
                                    <div class="down-btns">
                                        <a class="schedule-btn" id="scheduleMeeting">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            Schedule Meeting
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div id="kyc_sec" style="display:none;">
                                <form class="kyc-form" method="post" action="<?= base_url("user/kyc") ?>">
                                    <div class="kyc-form-cntrl">
                                        <label>1. Full Name</label>
                                        <span class="certificateClsStg"><?= $user_info->name ?></span>
                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>2. Email</label>
                                        <span class="certificateClsStg"><?= $user_info->email ?></span>
                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>3. Phone number</label>
                                        <span class="certificateClsStg"><?= $user_info->phone ?></span>
                                    </div>

                                    <div class="kyc-form-cntrl">
                                        <label>4. Date of Birth</label>
                                        <span class="certificateClsStg"><?= $user_info->dob ?></span>
                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>5. Category</label>
                                        <span class="certificateClsStg"><?= $user_info->category; ?></span>

                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>6. District</label>
                                        <?php $dist = $this->db->query("SELECT name FROM districts WHERE id= '$user_info->district'")->row(); ?>
                                        <span class="certificateClsStg"><?= $dist->name; ?></span>

                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>7. Mandal</label>
                                        <?php $mandal = $this->db->query("SELECT name FROM mandals WHERE id= '$user_info->mandal'")->row(); ?>
                                        <span class="certificateClsStg"><?= $mandal->name; ?></span>

                                    </div>
                                    <div class="kyc-drop-form">

                                        <div class="kyc-form-cntrl">
                                            <label>8. Aadhar No.</label>
                                            <span class="certificateClsStg"><?= $user_info->adhaar_no; ?></span>
                                            <?php if (!empty($user_info->adhaar_file)) { ?>
                                                <a href="<?= base_url($user_info->adhaar_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns">
                                                    <a href="<?= base_url($user_info->adhaar_file); ?>" type="file" class="custom-file-input" download="aadhar">Download</a>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                    <div class="kyc-drop-form">
                                        <div class="kyc-form-cntrl" style="margin: 0 15px 0px;">
                                            <label>9. PAN card</label>
                                            <span class="certificateClsStg"><?= $user_info->pan_no; ?></span>
                                            <?php if (!empty($user_info->pan_file)) { ?>
                                                <a href="<?= base_url($user_info->pan_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns">
                                                    <a href="<?= base_url($user_info->pan_file); ?>" type="file" class="custom-file-input" download="pancard">Download</a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>10. Education background</label>
                                        <span class="certificateClsStg"><?= $user_info->education; ?></span>


                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>11. Employment Status</label>
                                        <span class="certificateClsStg"><?= $user_info->employment; ?></span>

                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>12. Did you take support from any of the following institutions?</label>
                                        <span class="certificateClsStg"><?= $user_info->institution; ?></span>


                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>13. Are you a Pwd?</label>
                                        <span class="certificateClsStg"><?= $user_info->pwd; ?></span>


                                    </div>

                                </form>
                            </div>

                            <div id="certification_sec" style="display:none;">
                                <form action="<?= base_url("user/enterprise") ?>" class="kyc-form" method="post" enctype="multipart/form-data">
                                    <?php
                                    if (!empty($certficate)) {
                                    ?>
                                        <div class="kyc-form-cntrl">
                                            <label>1. Explain your business idea</label>
                                            <span class="certificateClsStg"><?php echo $certficate->business; ?>
                                            </span>
                                        </div>

                                        <div class="kyc-form-cntrl">
                                            <label>2. Which Sector do you belong?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->sector; ?></span>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>3. How long has your business been in operation?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->business_operation; ?></span>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>4. Which categroy do you fit under?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->category; ?></span>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>5. What is capital investment till date (fixed/working capatil)?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->working_capital; ?></span>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>6. What type of investment?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg">
                                                    <?php
                                                    $invTypes = $this->db->query("SELECT investName FROM investment_types WHERE cert_id = '$certficate->id'")->result_array();
                                                    if (!empty($invTypes)) {
                                                        foreach ($invTypes as $invTyp) {
                                                            $myInvest[] = ucfirst($invTyp['investName']);
                                                        }
                                                        echo implode(', ', $myInvest);
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>7. What is your monthly revenue?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->monthly_revenue; ?></span>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>8. What is your annual ternover?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->annual_turnover; ?></span>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>9. Do you have any employees?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->employee; ?> (<?php echo $certficate->no_emp; ?>)</span>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>10. Is your business registered?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->business_register; ?></span>
                                                <?php
                                                $sptTypes = $this->db->query("SELECT supportName FROM support_types WHERE cert_id = '$certficate->id'")->result_array();
                                                if (!empty($sptTypes)) {
                                                    foreach ($sptTypes as $sptTyp) {
                                                        $mySuport[] = ucfirst($sptTyp['supportName']);
                                                    }

                                                ?>
                                                    <span class="certificateClsStg"><?php echo implode(', ', $mySuport); ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>11. Legal Status of the Company?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->legal_status; ?></span>
                                            </div>
                                            <?php if (!empty($certficate->solo_file)) { ?>
                                                <a href="<?= base_url($certficate->solo_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?= base_url($certficate->solo_file); ?>" type="file" class="custom-file-input" download="aadhar">Download</a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <?php if (!empty($certficate->partnership_file)) { ?>
                                                <a href="<?= base_url($certficate->partnership_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?= base_url($certficate->partnership_file); ?>" class="custom-file-input" download="aadhar">
                                                        Download
                                                    </a>
                                                </div>



                                            <?php } ?>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <?php if (!empty($certficate->company_file)) { ?>
                                                <a href="<?= base_url($certficate->company_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?= base_url($certficate->company_file); ?>" class="custom-file-input" download="aadhar">
                                                        Download
                                                    </a>
                                                </div>

                                            <?php } ?>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <?php if (!empty($certficate->pvt_file)) { ?>
                                                <a href="<?= base_url($certficate->pvt_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?= base_url($certficate->pvt_file); ?>" class="custom-file-input" download="aadhar">
                                                        Download
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <?php if (!empty($certficate->llp_file)) { ?>
                                                <a href="<?= base_url($certficate->llp_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?= base_url($certficate->llp_file); ?>" class="custom-file-input" download="aadhar">
                                                        Download
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <div class="kyc-form-cntrl">
                                            <label>12. Does the Company have DPIIT Registration</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->dpiit; ?></span>
                                            </div>

                                            <?php if (!empty($certficate->dpiit_file)) { ?>
                                                <a href="<?= base_url($certficate->dpiit_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?= base_url($certficate->dpiit_file); ?>" class="custom-file-input" download="aadhar">
                                                        Download
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>13. Does the Company have Udyam Registration?</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->udyam; ?></span>
                                            </div>

                                            <?php if (!empty($certficate->udyam_file)) { ?>
                                                <a href="<?= base_url($certficate->udyam_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?= base_url($certficate->udyam_file); ?>" class="custom-file-input" download="aadhar">
                                                        Download
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>14. Has the Company raised any external investment</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->ext_investment; ?></span>
                                            </div>
                                        </div>

                                        <div class="kyc-form-cntrl">
                                            <label>15. GST of company, PAN of company</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg"><?php echo $certficate->udyam; ?></span>
                                            </div>
                                            <?php if (!empty($certficate->gst_file)) { ?>
                                                <a href="<?= base_url($certficate->gst_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?= base_url($certficate->gst_file); ?>" class="custom-file-input" download="aadhar">
                                                        Download
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>16. Audited Financials</label>

                                            <?php if (!empty($certficate->audited_file)) { ?>
                                                <a href="<?= base_url($certficate->audited_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?= base_url($certficate->audited_file); ?>" class="custom-file-input" download="aadhar">
                                                        Download
                                                    </a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    <?php } else {
                                        echo 'Application under process';
                                    } ?>


                                </form>
                            </div>
                            <div id="add_doc_sec" style="display:none;">
                                <form action="<?= base_url("user/enterprise") ?>" method="post" enctype="multipart/form-data">
                                    <div class="doc-upload-table">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr style="height: 44px;">
                                                        <th> </th>
                                                        <th>File Name</th>
                                                        <th>Date Upload</th>
                                                        <th>Download </th>
                                                        <th>View </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($docs_info as $doc_res) { ?>
                                                        <tr>
                                                            <td><input type="checkbox"></td>
                                                            <td class="ey-icon"><?= $doc_res['doc_name']; ?></td>
                                                            <td class="te-center"><?= date('M d Y', strtotime($doc_res['upload_date'])); ?></td>
                                                            <td><a href="<?php echo base_url($doc_res['file_name']); ?>" download="download">Download</a></td>
                                                            <td><a href="<?php echo base_url($doc_res['file_name']); ?>" target="_blank"><img src="<?php echo base_url('assets/images/eye--icon.png'); ?>"></a></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>

                                        <?php echo $this->pagination->create_links(); ?>


                                    </div>
                                </form>
                            </div>

                            <div id="remarks_sec" style="display:none;">
                                <form action=" " method="post" enctype="multipart/form-data">
                                    <div class="kyc-form-cntrl">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr style="height: 44px;">
                                                        <th>remark</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($remarks as $remark) { ?>
                                                        <tr>
                                                            <td class="ey-icon"><?= $remark['statusRemark']; ?></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </form>
                            </div>
                            <div id="grievance_sec">
                                <div class="row tmt">
                                    <p class="adminGri">Latest Grievances</p>
                                    <!--  <div class="col-lg-6" style="width: 50%;float: left;">
                                            <form action="<?= base_url("master_grivance_submit"); ?>" method="post" enctype="multipart/form-data">                          
                                                <div class="doc-sub-form">
                                                    <label>Subject</label>
                                                    <input name="griv_subject" type="text" placeholder="Subject" />
                                                    <input name="griv_type" type="hidden" value="Raised" />
                                                    <input name="user_id" type="hidden" value="<?= $user_info->id; ?>" />
                                                    <input name="user_type" type="hidden" value="User" />
                                                    <input name="ticket_id" type="hidden" value="<?php echo $griev->id; ?>" />
                                                    <input name="page_detail" type="hidden" value="<?php echo 'master_grievance_details'; ?>" />
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
                                        </div> -->
                                    <div class="col-lg-5 admin-grie-view" style="width: 50%;/*float: left*/;margin-left: 0;">
                                        <div class="grievncsDiv">
                                            <h4>Earlier Grievances</h4>
                                            <?php //print_r($grievance);
                                            foreach ($grievance as $grvnc) { ?>
                                                <p class="grievncsDivPStg"><span><?php echo $grvnc['grievance_id']; ?></span><span class="sbjStg" title="<?php echo $grvnc['subject']; ?>"><?php echo character_limiter($grvnc['subject'], 1); ?></span><span class="grvnceSpanStg"><span tickect_num="<?= $grvnc['grievance_id'] ?>" user_id="<?= $user_info->id; ?>" content="<?= $grvnc['content'] ?>" ticket_status="<?= $grvnc['status'] ?>" id="forum-pop">view</span></span></p>
                                                <!--<p class="grievncsDivPStg"><span><?php echo $grvnc['content']; ?></span></p>-->
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="checklist_sec" style="display:none;">
                                <form class="kyc-form" action="<?= base_url("user/enterprise") ?>" method="post" enctype="multipart/form-data">
                                    <?php $k = 1;
                                    foreach ($checklist as $chk) {
                                        $ques = $chk['q_id'];
                                        $chkQue = $chk['checklist_que'];
                                        $check_list_id = $chk['check_list_id'];

                                        $alraedSel = $this->db->query("SELECT ques_ans FROM admin_verify_tbl WHERE user_id = '$user_info->id' AND app_id = '$buss_info->id' AND ques_id ='$ques'")->row_array()['ques_ans'];
                                        //print_r($this->db->last_query());
                                    ?>
                                        <div class="kyc-form-cntrl" id="row_id_<?= $ques; ?>">
                                            <label><?= ++$k; ?>. <?= $chkQue; ?> </label>
                                            <?php if ($alraedSel != '') { ?>
                                                <?php if ($chk['queType'] == '1') { ?>
                                                    <span class="certificateClsStg"><?php echo ($alraedSel == '1') ? 'Yes' : 'No'; ?></span>
                                                <?php } elseif ($chk['queType'] == '2') { ?>
                                                    <span class="certificateClsStg"><?= $alraedSel; ?></span>
                                                <?php  } elseif ($chk['queType'] == '3') { ?>
                                                    <a href="<?= base_url($alraedSel); ?>" target="_blank">
                                                        <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                    </a>
                                                    <div class="down-btns" style="justify-content: flex-start;margin-top: 10px;">
                                                        <a href="<?= base_url($alraedSel); ?>" type="file" class="custom-file-input" download="aadhar">Download</a>
                                                    </div>
                                                <?php } elseif ($chk['queType'] == '4') { ?>
                                                    <a href="<?= base_url($alraedSel); ?>" target="_blank">
                                                        <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                    </a>
                                                    <div class="down-btns" style="justify-content: flex-start;margin-top: 10px;">
                                                        <a href="<?= base_url($alraedSel); ?>" type="file" class="custom-file-input" download="aadhar">Download</a>
                                                    </div>
                                                <?php } elseif ($chk['queType'] == '5') { ?>
                                                    <span class="certificateClsStg"><?= $alraedSel; ?></span>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                    </div>
                    </section>
                    </form>
                </div>
            </div>
        </div>

    </div>




    <div class="query-forum">
        <div class="container">
            <div class="new-doc">
                <h2>Query Forum <span class="closePopCls" id="grivCLosePop">X</span></h2>
            </div>
            <div class="query-form admin_griev_ance_cht">
                <div class="chatSbjctDisp">Subject: <?php $sbjct = $this->db->query("SELECT subject FROM grievance WHERE id = '$griev->id'")->row_array();
                                                    echo $sbjct['subject']; ?></div>
                <div id="ticketDivSec">
                </div>
                <div id="chatDivSec">
                </div>
                <form action="<?= base_url("master_chat_replay") ?>" id="ticket_query" class="ticket_query" method="post" enctype="multipart/form-data">
                    <div class="cht-submit">
                        <input type="hidden" name="ticketId" id="ticketId" />
                        <input type="hidden" name="ticketUserId" id="ticketUserId" value="<?= $user_info->id; ?>" />
                        <input type="hidden" name="ticketAppId" id="ticketAppId" value="<?= $griev->id; ?>" />
                        <input type="hidden" name="pageId" id="pageId" value="<?= 'master_grievance_details'; ?>" />
                        <div class="image-upload-chat" style="margin-right: 10px;cursor: pointer;">
                            <label for="file-input" style="cursor: pointer;"><img src="<?= base_url("assets/") ?>images/attachment-icon.png" /></label>
                            <input type="file" name="fileInsert" id="file-input">
                        </div>

                        <textarea class="input-control" name="queryDetails" id="queryDetails" style="height: 50px;"></textarea>
                        <!-- <a class="cht-experience document-download-btn" href="#"><img src="<?= base_url("assets/") ?>images/new-download-icon.png" /></a> -->
                        <input type="submit" value="Submit" name="submit" />
                        <div></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="experience-con">
        <div class="new-doc">
            <a href=""><i class="fa-solid fa-x"></i></a>
        </div>
        <h5>How was your conversation experience with us?</h5>
        <p>Your feedback will help us serve you better</p>
        <div class="like-btns">
            <div>
                <img src="<?= base_url("assets/") ?>images/like-icon.jpg" />
            </div>
            <div>
                <img src="<?= base_url("assets/") ?>images/dis-like.jpg" />
            </div>
        </div>
        <a href="#">SKIP THIS STEP</a>
    </div>

    <div class="status-popup dash-board-popup" id="statusPopup">
        <div class="container" style="width:auto;"><br>
            <div class="new-doc">
                <br>
                <h2>Update Grievance Status <span id="closeStatusPopup" class="closePopCls">x</span></h2>
            </div>
            <div class="doc-sub">
                <div class="doc-sub-form">
                    <input type="hidden" class="tckt_num" value="<?= $griev->grievance_id; ?>">
                    <select name="status_type" id="status_type">
                        <option value="Closed">Closed</option>
                        <option value="Review">Review</option>
                    </select>
                </div>

                <input type="button" id="grievance_update_status" value="Submit" />
            </div>
        </div>
    </div>

    <?php $this->load->view('admin/footer'); ?>


</body>

</html>
<script>
    $(document).ready(function() {
        $(document).on('click', '#KYC', function() {
            $("#kyc_sec").show();
            $("#certification_sec").hide();
            $("#add_doc_sec").hide();
            $("#remarks_sec").hide();
            $("#grievance_sec").hide();
            $("#checklist_sec").hide();
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
        $(document).on('click', '#Certification', function() {
            $("#Certification").addClass("custTabMenuListStg active");
            $("#kyc_sec").hide();
            $("#add_doc_sec").hide();
            $("#remarks_sec").hide();
            $("#grievance_sec").hide();
            $("#certification_sec").show();
            $("#checklist_sec").hide();
            $("#KYC").removeClass("active");
            $("#Additional").removeClass("active");
            $("#Remarks").removeClass("active");
            $("#Grievance").removeClass("active");
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#Additional', function() {
            $("#Additional").addClass("custTabMenuListStg active");
            $("#add_doc_sec").show();
            $("#kyc_sec").hide();
            $("#certification_sec").hide();
            $("#remarks_sec").hide();
            $("#grievance_sec").hide();
            $("#checklist_sec").hide();
            $("#KYC").removeClass("active");
            $("#Certification").removeClass("active");
            $("#Remarks").removeClass("active");
            $("#Grievance").removeClass("active");
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#Remarks', function() {
            $("#Remarks").addClass("custTabMenuListStg active");
            $("#remarks_sec").show();
            $("#add_doc_sec").hide();
            $("#kyc_sec").hide();
            $("#certification_sec").hide();
            $("#grievance_sec").hide();
            $("#checklist_sec").hide();
            $("#KYC").removeClass("active");
            $("#Certification").removeClass("active");
            $("#Additional").removeClass("active");
            $("#Grievance").removeClass("active");
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#Grievance', function() {
            $("#Grievance").addClass("custTabMenuListStg active");
            $("#grievance_sec").show();
            $("#remarks_sec").hide();
            $("#add_doc_sec").hide();
            $("#kyc_sec").hide();
            $("#certification_sec").hide();
            $("#checklist_sec").hide();
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
        $(document).on('click', '#Checklist', function() {
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
        $('#meeting_multi_user').val('');
        $('#meeting_page').val('griv');
        $('#meeting_page_type').val('2'); //1=multiple user;2=single user;
        var user_id = '<?php echo $user_info->id; ?>';
        $("#meeting_user_id").val(<?php echo $user_info->id; ?>);
        $('.get-metting').show();
    });

    $('#closePopup').click(function() {
        $('.get-metting').hide();
    });
</script>


<script>
    $(document).ready(function() {
        $(document).on('click', '#forum-pop', function() {
            var ticket = $(this).attr("tickect_num");
            var user_id = $(this).attr("user_id");
            var griDet = $(this).attr("content");
            var sts = $(this).attr("ticket_status");
            $("#ticketId").val(ticket);
            if (ticket == null || ticket == '') {
                $.notify('Invalid request', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            } else {
                $.ajax({
                    url: '<?php echo base_url('master_get_grivance'); ?>',
                    type: 'POST',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        'ticket': ticket,
                        'user_id': user_id
                    },
                    success: function(data) {
                        let res = $.parseJSON(data);
                        if (res.response == '1') {
                            $('.query-forum').show();
                            //$("#ticketDivSec").html(griDet);
                            $("#chatDivSec").html(res.chat);
                            if (sts == 'Closed') {
                                $(".ticket_query").hide();
                            }
                            $.notify(res.message, {
                                'className': 'success',
                                'position': 'top left',
                                'autoHideDelay': 1500
                            });
                        } else {
                            $('.query-forum').show();
                            $("#chatDivSec").html('');
                            //$("#ticketDivSec").html(griDet);
                            if (sts == 'Closed') {
                                $(".ticket_query").hide();
                            }
                            $.notify(res.message, {
                                'className': 'danger',
                                'position': 'top left',
                                'autoHideDelay': 1500
                            });
                        }
                    }
                })
            }

        });
    });
</script>



<script type="text/javascript">
    $('#grivCLosePop').click(function() {
        $('.query-forum').hide();
    });
</script>


<script type="text/javascript">
    $('#kycStatusPopup').click(function() {
        $('.status-popup').show();
    });

    $('#closeStatusPopup').click(function() {
        $('.status-popup').hide();
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('click', '#grievance_update_status', function() {
            var ticket = $(".tckt_num").val();
            var status_type = $("#status_type").val();
            if (ticket == null || ticket == '') {
                $.notify('Invalid request', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            }
            if (status_type == null || status_type == '') {
                $.notify('Select status', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            } else {
                $.ajax({
                    url: '<?php echo base_url('master_grievance_update'); ?>',
                    type: 'POST',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        'ticket': ticket,
                        'status_type': status_type,
                        'user_id': <?= $user_info->id; ?>
                    },
                    success: function(data) {
                        let res = $.parseJSON(data);
                        if (res.response == '1') {
                            $(".status-popup").hide();
                            $.notify(res.message, {
                                'className': 'success',
                                'position': 'top left',
                                'autoHideDelay': 1500
                            });
                            window.location.reload();
                        } else {
                            $.notify(res.message, {
                                'className': 'danger',
                                'position': 'top left',
                                'autoHideDelay': 1500
                            });
                            window.location.reload();
                        }
                    }
                })
            }
        });
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