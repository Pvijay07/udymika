<?php $this->load->view('subAdmin/head'); ?>

<body>
    <div class="dashboard-page unique">
      <div class="container">
        <div class="dashboard-main">
        <?php $this->load->view('subAdmin/menus'); ?>

          <div class="dashboard-main-ryt">
            <?php $this->load->view('subAdmin/header'); ?>
              <div class="dash-seections enterprise-sec">
                
              <div class="ad-kyc-nav">
                  <div class="ad-kyc-nav-top">
                    <ul>
                      <li><a href="<?php echo base_url()?>admin_dashboard"><img src="<?php echo base_url('assets/images/home-icon.png');?>" /></a></li>
                      <li><a href="<?php echo base_url()?>admin_certificate_progess">Certification</a></li>
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
                        <h6>Business Name</h6>
                        <p><?php echo $certficate->business; ?></p>
                      </div>
                       <div>
                        <h6>Aadhaar Number</h6>
                        <p><?= $user_info->adhaar_no; ?></p>
                      </div>
                       <div>
                        <h6>Phone Number</h6>
                        <p>+91 <?= $user_info->phone; ?></p>
                      </div>
                       <div>
                        <h6>Certificate status</h6>
                        <?php
                                            if($certficate->certficationStatus == '1')
                                            {
                                                $sts = 'Submited';
                                            }
                                            elseif($certficate->certficationStatus == '2')
                                            {
                                                $sts = 'In Process';
                                            }
                                            elseif($certficate->certficationStatus == '3')
                                            {
                                                $sts = 'Verified';
                                            }
                                            elseif($certficate->certficationStatus == '4')
                                            {
                                                $sts = 'Interview';
                                            }
                                            elseif($certficate->certficationStatus == '5')
                                            {
                                                $sts = 'Approve';
                                            }
                                            elseif($certficate->certficationStatus == '6')
                                            {
                                                $sts = 'Reject';
                                            }
                                            else 
                                            {
                                                $sts = 'Hold';
                                            }
                                             
                                              
                                            ?>
                        <p class="sub-btn-kyc stsBgStg" id="kycStatusPopup"><?= $sts; ?> <img src="<?php echo base_url('assets/images/re-write.png'); ?>" /></p>
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
                                        <li class="custTabMenuListStg" id="Grievance">
                                            <a href="#tab5">Raise a Query</a>
                                        </li>
                                        <li class="custTabMenuListStg active" id="Checklists">
                                            <a href="#tab6">Checklist</a>
                                        </li>
                                    </ul>
                                     
                                </div>

                        <div id="kyc_sec" style="display:none">
                        <form class="kyc-form" method="post" action="<?=base_url("user/kyc")?>">
                                        <div class="kyc-form-cntrl">
                                            <label>1. Full Name</label>
                                            <span class="certificateClsStg"><?=$user_info->name?></span> 
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>2. Email</label>
                                            <span class="certificateClsStg"><?=$user_info->email?></span>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>3. Phone number</label>
                                            <span class="certificateClsStg"><?=$user_info->phone?></span>
                                        </div>
                                        
                                        <div class="kyc-form-cntrl">
                                            <label>4. Date of Birth</label>
                                            <span class="certificateClsStg"><?=$user_info->dob?></span>
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>5. Category</label>
                                            <span class="certificateClsStg"><?=$user_info->category; ?></span>
                                            
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>6. District</label>
                                                <?php $dist = $this->db->query("SELECT name FROM districts WHERE id= '$user_info->district'")->row(); ?>
                                                    <span class="certificateClsStg"><?=$dist->name; ?></span>
                                                
                                        </div>
                                        <div class="kyc-form-cntrl">
                                            <label>7. Mandal</label>
                                            <?php $mandal = $this->db->query("SELECT name FROM mandals WHERE id= '$user_info->mandal'")->row(); ?>
                                                    <span class="certificateClsStg"><?=$mandal->name; ?></span>
                                                
                                        </div>
                                        <div class="kyc-drop-form">
                                 
                                                <div class="kyc-form-cntrl">
                                                    <label>8. Aadhar No.</label>
                                                    <span class="certificateClsStg"><?=$user_info->adhaar_no; ?></span>
                                                    <?php if(!empty($user_info->adhaar_file)){ ?>
                                                    
                                                    <a href="<?=base_url($user_info->adhaar_file);?>" target="_blank" >
                                                        <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                    </a>
                                                    <div class="down-btns">
                                                      
                                                    <a href="<?=base_url($user_info->adhaar_file);?>" type="file" class="custom-file-input" download="aadhar">Download</a>  
                                                    </div>
                                                    <?php } ?>
                                                    
                                                </div>
                                            </div>
                                            <div class="kyc-drop-form">
                                                <div class="kyc-form-cntrl" style="margin: 0 15px 0px;">
                                                    <label>9. PAN card</label>
                                                    <span class="certificateClsStg"><?=$user_info->pan_no; ?></span>
                                                    <?php if(!empty($user_info->pan_file)){ ?>
                                                    <a href="<?=base_url($user_info->pan_file);?>" target="_blank" >
                                                        <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                    </a>
                                                    <div class="down-btns">
                                                      
                                                    <a href="<?=base_url($user_info->pan_file);?>" type="file" class="custom-file-input" download="aadhar">Download</a>  
                                                    </div>
                                                    <?php } ?>
                                                    
                                                </div>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>10. Education background</label>
                                                <span class="certificateClsStg"><?=$user_info->education; ?></span>
                                                
                                               
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>11. Employment Status</label>
                                                <span class="certificateClsStg"><?=$user_info->employment; ?></span>
                                                 
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>12. Did you take support from any of the following institutions?</label>
                                                 <span class="certificateClsStg"><?=$user_info->institution; ?></span>
                                                 
                                                
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>13. Are you a Pwd?</label>
                                                <span class="certificateClsStg"><?=$user_info->pwd; ?></span>
                                                
                                                 
                                            </div>
                                            
                                        </form>
                        </div>

                        <div id="certification_sec" style="display:none;">
                        <form action="<?=base_url("user/enterprise")?>" class="kyc-form" method="post" enctype="multipart/form-data">                          
                                        <?php 
                                        if(!empty($certficate)){
                                             
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
                                                    if(!empty($invTypes)){
                                                        foreach($invTypes as $invTyp)
                                                        {
                                                            $myInvest[] = ucfirst($invTyp['investName']);
                                                        }
                                                        echo implode( ', ', $myInvest );
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
                                                    if(!empty($sptTypes)){
                                                        foreach($sptTypes as $sptTyp)
                                                        {
                                                            $mySuport[] = ucfirst($sptTyp['supportName']);
                                                        }                                                   
                                                        ?>
                                                        <span class="certificateClsStg"><?php echo implode( ', ', $mySuport ); ?></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>11. Legal Status of the Company?</label>
                                                <div class="file-path">
                                                    <span class="certificateClsStg"><?php echo $certficate->legal_status; ?></span>
                                                </div>
                                                <?php if(!empty($certficate->solo_file)){ ?>
                                                    <a href="<?=base_url($certficate->solo_file);?>" target="_blank" >
                                                        <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                    </a>
                                                        <div class="down-btns newBtnDwnload">
                                                            <a href="<?=base_url($certficate->solo_file);?>" type="file" class="custom-file-input" download="aadhar">Download</a>  
                                                        </div>
                                                <?php } ?>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <?php if(!empty($certficate->partnership_file)){ ?>
                                                 <a href="<?=base_url($certficate->partnership_file);?>" target="_blank" >
                                                    <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?=base_url($certficate->partnership_file);?>"  class="custom-file-input" download="aadhar">
                                                    Download
                                                    </a>  
                                               </div>

                                              
                                                
                                                <?php } ?>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <?php if(!empty($certficate->company_file)){ ?>
                                                 <a href="<?=base_url($certficate->company_file);?>" target="_blank" >
                                                    <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?=base_url($certficate->company_file);?>" class="custom-file-input" download="aadhar">
                                                    Download
                                                    </a> 
                                                </div> 
                                                 
                                                <?php } ?>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <?php if(!empty($certficate->pvt_file)){ ?>
                                                 <a href="<?=base_url($certficate->pvt_file);?>" target="_blank" >
                                                    <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?=base_url($certficate->pvt_file);?>" class="custom-file-input" download="aadhar">
                                                    Download
                                                    </a>  
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <?php if(!empty($certficate->llp_file)){ ?>
                                                 <a href="<?=base_url($certficate->llp_file);?>" target="_blank" >
                                                    <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                    <a href="<?=base_url($certficate->llp_file);?>" class="custom-file-input" download="aadhar">
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
                                                
                                                <?php if(!empty($certficate->dpiit_file)){ ?>
                                                 <a href="<?=base_url($certficate->dpiit_file);?>" target="_blank" >
                                                    <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                <a href="<?=base_url($certficate->dpiit_file);?>" class="custom-file-input" download="aadhar">
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
                                                
                                                <?php if(!empty($certficate->udyam_file)){ ?>
                                                 <a href="<?=base_url($certficate->udyam_file);?>" target="_blank" >
                                                    <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                <a href="<?=base_url($certficate->udyam_file);?>" class="custom-file-input" download="aadhar">
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
                                                <?php if(!empty($certficate->gst_file)){ ?>
                                                 <a href="<?=base_url($certficate->gst_file);?>" target="_blank" >
                                                    <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                <a href="<?=base_url($certficate->gst_file);?>" class="custom-file-input" download="aadhar">
                                                Download
                                                </a>  
                                                </div>
                                                <?php } ?>
                                            </div>
                                            <div class="kyc-form-cntrl">
                                                <label>16. Audited Financials</label>
                                                
                                                <?php if(!empty($certficate->audited_file)){ ?>
                                                 <a href="<?=base_url($certficate->audited_file);?>" target="_blank" >
                                                    <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                </a>
                                                <div class="down-btns newBtnDwnload">
                                                <a href="<?=base_url($certficate->audited_file);?>" class="custom-file-input" download="aadhar">
                                                Download
                                                </a> 
                                                </div> 
                                                <?php } ?>
                                            </div>
                                            <?php } else { echo 'Application under process';} ?>
                                          
                                    </form>
                        </div>
                        <div id="add_doc_sec" style="display:none;">
                            <form action="<?=base_url("user/enterprise")?>" method="post" enctype="multipart/form-data">                          
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
                                            <?php foreach($docs_info as $doc_res){ ?>
                                            <tr>
                                                <td><input type="checkbox"></td>
                                                <td class="ey-icon"><?=$doc_res['doc_name']; ?></td>
                                                <td class="te-center"><?= date('M d Y', strtotime($doc_res['upload_date'])); ?></td>
                                                <td><a href="<?php echo base_url($doc_res['file_name']); ?>" download="pancard">Download</a></td>
                                                <td><a href="<?php echo base_url($doc_res['file_name']); ?>" target="_blank" ><img src="<?php echo base_url('assets/images/eye--icon.png'); ?>"/></a></td>
                                            </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>

                                <?php echo $this->pagination->create_links(); ?>

                                
                            </div>
                                
                                <!-- <div class="kyc-form-cntrl">
                                    <div class="kyc-form-buttons">
                                        <button>Save draft</button>
                                        <input type="submit" name="submit" class="active" value="Submit" />
                                    </div>
                                </div> -->
                            </form>
                        </div>

                        <div id="remarks_sec" style="display:none;">
                            <form action="<?=base_url("user/enterprise")?>" method="post" enctype="multipart/form-data">                          
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach($remarks as $rem){
                                            ?>
                                            <tr>
                                                <td><?php echo $rem['statusRemark']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                                <!-- <div class="kyc-form-cntrl">
                                    <div class="kyc-form-buttons">
                                        <button>Save draft</button>
                                        <input type="submit" name="submit" class="active" value="Submit" />
                                    </div>
                                </div> -->
                            </form>
                        </div>
                        <div id="grievance_sec" style="display:none;">
                            <form action="" method="post" enctype="multipart/form-data">  
                                                        
                                <div class="sort-sec-cord tmt">
                                    <?php foreach($grivance as $grievanace){ ?>
                                    <div class="sort-cords">
                                        
                                        <h6>#<?=$grievanace['grievance_id']; ?> 
                                            <span class="forum-pop" id="forum-pop" tickect_num="<?=$grievanace['grievance_id']?>"  style="<?php if($grievanace['status'] == 'Closed') { echo 'display:none'; }?>"> <img  src="<?=base_url("assets/")?>images/message-icon.png"></span>
                                        </h6>
                                        <p>Query Type: <span><?=$grievanace['query_type']?></span></p>
                                        <p>Date of Submission: <span> <?=date_time($grievanace['created_at'])?></span></p>
                                        <div>
                                            <p id="<?php if($grievanace['status'] != 'Closed'){ echo 'kycStatusPopupUpd'; } ?>" tickect_num="<?=$grievanace['grievance_id']?>"><?=$grievanace['status']?></p>
                                            <strong tickect_num="<?=$grievanace['grievance_id']; ?>" tickect_status="<?php echo $grievanace['status']; ?>" class="view_reports">View report</strong>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                                 
                            </form>
                        </div>

                        <div id="checklist_sec">
                            <form class="kyc-form" action="<?php echo base_url('admin_verify_application'); ?>" method="post" enctype="multipart/form-data">   
                              
                                <?php foreach($checklist as $chk) {
                                    //1 = radio, 2= text, 3 = image, 4 = video, 5 = remarks;
                                    $queType = $chk['queType'];
                                    $ques = $chk['q_id'];
                                    //$ans = $chk['question_ans'];
                                    $chkQue = $chk['checklist_que']; 
                                    $check_list_id = $chk['check_list_id']; 
                                    
                                    $alraedSel = $this->db->query("SELECT ques_ans FROM admin_verify_tbl WHERE user_id = '$user_info->id' AND app_id = '$buss_info->id' AND ques_id ='$ques'")->row_array()['ques_ans'];
                                    //print_r($this->db->last_query());
                                     
                                ?>
                               
                                 <input type="hidden" id="question_id" name="question_id[]" value="<?php echo $ques; ?>"/>       
                                <input type="hidden" id="application_id" name="application_id" value="<?=$buss_info->id;?>"/>       
                                <input type="hidden" id="user_id" name="user_id" value="<?=$user_info->id;?>"/>       
                                <input type="hidden" id="checklist_id" name="checklist_id" value="<?= $check_list_id; ?>"/>       
                                <input type="hidden" id="cert_status" name="cert_status" value="<?= $certficate->certficationStatus; ?>"/>       
                                <input type="hidden" id="queType" name="queType" value="<?= $queType; ?>"/>       
                                <div class="kyc-form-cntrl" id="row_id_<?=$ques;?>">
                                    <label><?= ++$k;?>. <?= $chkQue; ?> </label>
                                        <?php if($alraedSel == '0' or $alraedSel == '1') { ?>
                                            <span class="certificateClsStg"><?= ($alraedSel == '1')?'Yes':'No'; ?></span>
                                            <?php } else {  ?>
                                            <?php if($queType == '1'){ ?>
                                                <div class="kyc-radio">
                                                    <div>
                                                        <input type="radio" name="process_checklist_<?=$ques;?>" value="1" id="processChecklistYes_<?=$ques;?>"  <?=($alraedSel=='1')?'checked':''; ?>>
                                                        <label for="processChecklistYes_<?=$ques;?>">Yes</label> 
                                                    </div>
                                                    <div>
                                                        <input type="radio" name="process_checklist_<?=$ques;?>" value="0" id="processChecklistNo_<?=$ques;?>" <?=($alraedSel=='0')?'checked':''; ?>>
                                                        <label for="processChecklistNo_<?=$ques;?>">No</label>
                                                    </div>
                                                </div>
                                        <?php } elseif($queType == '2'){  ?>
                                            <input type="text" name="text_answer_<?=$ques;?>" value="<?= $alraedSel; ?>">
                                        <?php } elseif($queType == '3'){  ?>
                                            <?php if(!empty($alraedSel)){ ?>
                                                <a href="<?=base_url($alraedSel);?>" target="_blank" >
                                                    <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                </a>
                                                <div class="down-btns" style="justify-content: flex-start;margin-top: 10px;">
                                                    <a href="<?=base_url($alraedSel);?>" type="file" class="custom-file-input" download="aadhar">Download</a>  
                                                </div>
                                            <?php } else { ?>
                                                <div class="file-path">
                                                    <input type="file" name="upload_image" class="custom-file-input"> 
                                                </div>
                                            <?php } ?>
                                        <?php } elseif($queType == '4'){  ?>

                                            <?php if(!empty($alraedSel)){ ?>
                                                <a href="<?=base_url($alraedSel);?>" target="_blank" >
                                                    <img src="<?=base_url("assets/")?>images/eye--icon.png" class="viewBtnStgKyc"/>
                                                </a>
                                                <div class="down-btns" style="justify-content: flex-start;margin-top: 10px;">
                                                    <a href="<?=base_url($alraedSel);?>" type="file" class="custom-file-input" download="aadhar">Download</a>  
                                                </div>
                                            <?php } else { ?>
                                                <div class="file-path">
                                                    <input type="file" name="video_file" class="custom-file-input"> 
                                                </div>
                                            <?php } ?>
                                        <?php } elseif($queType == '5'){  ?>
                                            <div class="kyc-text">
                                                <textarea name="verify_remarks" type="text" class="info-text"><?= $alraedSel; ?></textarea>
                                            </div>
                                        <?php } ?> 
                                    <?php }  ?>
                                </div>
                                <?php } ?>

                                <?php if(!empty($alraedSel)) { ?>
                                         
                                <?php } else {  ?>
                                 
 
                                <div class="kyc-form-cntrl col-lg-3">
                                    <div class="kyc-form-buttons">
                                        <input type="submit" name="submit" class="active" value="Submit" />
                                    </div>
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

     

    <div class="status-popup dash-board-popup" id="statusPopup">
        <div class="container" style="width:auto;">
            <form action="<?=base_url("admin_certificate_verify_upd")?>" method="post" enctype="multipart/form-data">
                <div class="new-doc">
                    <h2>Status <span id="closeStatusPopup" class="closePopCls">x</span></h2>
                     
                </div>
                <div class="doc-sub">
                    <div class="doc-sub-form">
                        <label>Certification Status</label>
                        <select name="certificate_status" id="certificate_status">
                            <option value="3">Field Verified</option>
                            <option value="6">Rejected</option>
                            <option value="7">On Hold</option>
                        </select>
                    </div>
                    
                    <input type="hidden" name="user" class="custom-input" value="<?=$user_info->id;?>">
                    <input type="hidden" name="cert_id" class="custom-input" value="<?=$buss_info->id;?>">
                    <div class="doc-sub-form">
                        <div class="file-path">
                            <input type="file" name="file_upload" class="custom-file-input">
                        </div>
                    </div>
                     
                    <div class="doc-sub-form">
                        <label>Remark, If any </label>
                        <textarea name="remarks" id="remarks" class="custom-input"></textarea>
                    </div>
                     
                    <div class="row">
                        
                        <div class="col-lg-4">
                            <input name="submit" type="submit" id="adminAsignBtn" value="Submit" />
                        </div>
                    </div>   
                </div>
            </form>
        </div>
    </div>

    <div class="query-forum">
        <div class="container">
            <div class="new-doc">
                <h2>Query Forum <span class="closePopCls" id="closeChatPop">X</span></h2>
             </div>
            <div class="query-form">
                <div id="chatDivSec">
                </div>
                <form action="<?=base_url("admin_grivance_chat_replay")?>" id="ticket_query" class="ticket_query" method="post" enctype="multipart/form-data">
                    <div class="cht-submit">
                        <input type="hidden" name="ticketId" id="ticketId"/>
                        <input type="hidden" name="ticketUserId" id="ticketUserId" value="<?= $user_info->id; ?>"/>
                        <input type="hidden" name="ticketAppId" id="ticketAppId" value="<?= $buss_info->id; ?>"/>
                        <input type="hidden" name="pageId" id="pageId" value="<?= 'admin_certificate_details'; ?>"/>
                        <div class="image-upload-chat" style="margin-right: 10px;cursor: pointer;">
                            <label for="file-input" style="cursor: pointer;"><img src="<?=base_url("assets/")?>images/attachment-icon.png" /></label>
                            <input type="file" name="fileInsert" id="file-input" >
                        </div>
                        <textarea class="input-control" name="queryDetails" id="queryDetails" style="height: 50px;"></textarea>
                        <input type="submit" value="Submit" name="submit"/>
                        <div></div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="experience-con chat_status_modal" id="">
        <div class="new-doc">
            <a href="">X</a>
        </div>
        <h5>Update Grievance Status</h5>
        <form id="openticket_close" method="post" enctype="multipart/form-data">
        <input type="hidden" class="tckt_num">
        <input type="hidden" class="admin_id" value="<?php echo $this->session->userdata('sub_admin_id'); ?>">
            <div class="doc-sub">
                <div class="doc-sub-form">
                    <select name="status_type" id="status_type" data-validation="required">
                        <option value="Closed">Closed</option>
                        <option value="Review">Review</option>
                    </select> 
                </div>
                <input type="button" id="grievance_update_status" value="Submit" /> 
            </div>
        </form>
    </div>


    <div class="experience-con">
        <div class="new-doc">
            <a href=""><i class="fa-solid fa-x"></i></a>
        </div>
        <h5>How was your conversation experience with us?</h5>
        <p>Your feedback will help us serve you better</p>
        <div class="like-btns">
            <div>
                <img src="<?=base_url("assets/")?>images/like-icon.jpg" />
            </div>
            <div>
                <img src="<?=base_url("assets/")?>images/dis-like.jpg" />
            </div>
        </div>
        <a href="#">SKIP THIS STEP</a>
    </div>

    <?php $this->load->view('subAdmin/footer'); ?>
      
   
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
            $("#Checklists").removeClass("active");
            $("#checklist_sec").hide();
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
            $("#Checklists").removeClass("active");
            $("#checklist_sec").hide();
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
            $("#Checklists").removeClass("active");
            $("#checklist_sec").hide();
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
            $("#Checklists").removeClass("active");
            $("#checklist_sec").hide();
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
            $("#Remarks").removeClass("active");
            $("#KYC").removeClass("active");
            $("#Certification").removeClass("active");
            $("#Additional").removeClass("active");
            $("#Checklists").removeClass("active");
            $("#checklist_sec").hide();
        })
    })
</script>
<script>
    $(document).ready(function() {
        $(document).on('click','#Checklists',function(){
            $("#Checklists").addClass("custTabMenuListStg active");
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
        $('.get-metting').show(500);
    });

    $('#closePopup').click(function() {
        $('.get-metting').hide(500);
    });
    </script>
 
<script type="text/javascript">
    $('#kycStatusPopup').click(function() {
        $('.status-popup').show(500);
    });

    $('#closeStatusPopup').click(function() {
        $('.status-popup').hide(500);
    });
    </script>

    
<script>
    $(document).ready(function(){
        $(document).on('click','#forum-pop', function(){
        var ticket = $(this).attr("tickect_num");
        $("#ticketId").val(ticket);
         
        if(ticket == null || ticket == '')
        {
          $.notify('Invalid request',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else
        {
            $ .ajax({
                url  : '<?php echo base_url('admin_get_chat_replay');?>',
                type : 'POST',
                data : {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>','ticket': ticket,'user_id':<?= $user_info->id; ?>,'app_id':<?= $buss_info->id; ?>},
                success : function(data)
                {
                    let res = $.parseJSON(data);
                    if(res.response=='1')
                    {
                        $('.query-forum').show(500);
                        $("#chatDivSec").html(res.chat);
                        $.notify(res.message,{'className':'success','position':'top left','autoHideDelay': 1500});
                    }
                    else
                    {
                        $('.query-forum').show(500);
                        $("#chatDivSec").html('');
                        $.notify(res.message,{'className':'danger','position':'top left','autoHideDelay': 1500});
                    }
                } 
            })
        }
        
    });
});     
</script>

<script type="text/javascript">
    $('#closeChatPop').click(function() {
        $('.query-forum').hide();
    });
</script>


<script>
    $(document).ready(function(){
        $(document).on('click','.view_reports', function(){
        var ticket = $(this).attr("tickect_num");
        var sts = $(this).attr("tickect_status");
        console.log(sts);
        if(ticket == null || ticket == '')
        {
          $.notify('Invalid request',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else
        {
            $ .ajax({
                url  : '<?php echo base_url('admin_get_chat_replay');?>',
                type : 'POST',
                data : {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>','ticket': ticket,'user_id':<?= $user_info->id; ?>,'app_id':<?= $buss_info->id; ?>},
                success : function(data)
                {
                    let res = $.parseJSON(data);
                    if(res.response=='1')
                    {
                        $('.query-forum').show(500);
                        $("#chatDivSec").html(res.chat);
                        if(sts == 'Closed')
                        {
                            $(".ticket_query").hide();
                        }
                        else
                        {
                            $(".ticket_query").show();  
                        }
                        $.notify(res.message,{'className':'success','position':'top left','autoHideDelay': 1500});
                    }
                    else
                    {
                        $('.query-forum').show(500);
                        $("#chatDivSec").html(res.chat);
                        if(sts == 'Closed')
                        {
                            $(".ticket_query").hide();
                        }
                        else
                        {
                            $(".ticket_query").show();  
                        }
                        $.notify(res.message,{'className':'danger','position':'top left','autoHideDelay': 1500});
                    }
                } 
            })
        }
    });
});     
</script>


<script>
    $(document).ready(function(){
        $(document).on('click','#kycStatusPopupUpd', function(){
            var tickect_num = $(this).attr("tickect_num");
            $(".tckt_num").val(tickect_num);
            $(".chat_status_modal").show();
        });
    });


    $(document).ready(function(){
        $(document).on('click','#grievance_update_status', function(){
            var ticket = $(".tckt_num").val();
            var admin_id = $(".admin_id").val();
            var status_type = $("#status_type").val();
            if(ticket == null || ticket == '')
            {
                $.notify('Invalid request',{'className':'danger','position':'top left','autoHideDelay': 1500});
                return false;
            }
            if(status_type == null || status_type == '')
            {
                $.notify('Select status',{'className':'danger','position':'top left','autoHideDelay': 1500});
                return false;
            }
            else
            {
                $ .ajax({
                    url  : '<?php echo base_url('admin_grievance_update');?>',
                    type : 'POST',
                    data : {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>','ticket': ticket,'admin_id':admin_id,'status_type':status_type,'user_id':<?= $user_info->id; ?>},
                    success : function(data)
                    {
                        let res = $.parseJSON(data);
                        if(res.response=='1')
                        {
                            $(".chat_status_modal").hide();
                            $.notify(res.message,{'className':'success','position':'top left','autoHideDelay': 1500});
                            window.location.reload();
                        }
                        else
                        {
                            $.notify(res.message,{'className':'danger','position':'top left','autoHideDelay': 1500});
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
      $('.certificateCls').addClass('active');
    });
</script>