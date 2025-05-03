<?php $this->load->view('admin/head'); ?>

<body>
    <div class="dashboard-page admin__kyc2">
        <div class="container">
            <div class="dashboard-main">
                <?php $this->load->view('admin/menus'); ?>

                <div class="dashboard-main-ryt">
                    <?php $this->load->view('admin/header'); ?>
                    <div class="dash-seections enterprise-sec">

                        <div class="ad-kyc-nav">
                            <div class="ad-kyc-nav-top">
                                <ul>
                                    <li><a href="<?php echo base_url() ?>master_dashboard"><img src="<?php echo base_url('assets/images/home-icon.png'); ?>" /></a></li>
                                    <li><a href="<?php echo base_url() ?>master_kyc">KYC</a></li>
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
                                        <p>----</p>
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
                                        <h6>KYC status</h6>
                                        <?php if ($user_info->status == "2") {
                                            $stst = 'Submitted';
                                        } elseif ($user_info->status == "3") {
                                            $stst = 'KYC Verified';
                                        } elseif ($user_info->status == "4") {
                                            $stst = 'KYC Rejected';
                                        } elseif ($user_info->status == "5") {
                                            $stst = 'KYC Hold';
                                        } else {
                                            $stst = 'Pending';
                                        } ?>
                                        <p class="sub-btn-kyc stsBgStg" id="kycStatusPopup"><?= $stst; ?> <img src="<?php echo base_url('assets/images/re-write.png'); ?>" /></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section class="kyc-form-section">
                            <div class="kyc-heading identifyCustStg" id="kyc-heading">
                                <ul id="nav-tab custTabStg">
                                    <li class="custTabMenuListStg active" id="KYC">
                                        <a href="#tab1">KYC</a>
                                    </li>
                                    <li class="custTabMenuListStg" id="Certification">
                                        <a href="#tab2">Certification</a>
                                    </li>
                                    <li class="custTabMenuListStg" id="Additional">
                                        <a href="#tab3">Additional Document</a>
                                    </li>
                                    <li class="custTabMenuListStg" id="Remarks">
                                        <a href="#tab4">Remarks</a>
                                    </li>
                                </ul>
                                <div>
                                    <div class="down-btns">
                                        <!-- <button type="submit" class="custom-file-input" ></button>    -->
                                        <a class="schedule-btn" id="scheduleMeeting">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            Schedule Meeting
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" id="user_id" value="<?= $user_info->id ?>" />
                            <div id="kyc_sec">
                                <form class="kyc-form" method="post" action="<?= base_url("#") ?>">
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
                                        <span class="certificateClsStg"><?= $user_info->category ?></span>

                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>6. District</label>
                                        <?php
                                        $disticts = $this->db->query("SELECT id,name FROM districts where id = '$user_info->district'")->row(); ?>
                                        <span class="certificateClsStg"><?= $disticts->name ?></span>
                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>7. Mandal</label>
                                        <?php
                                        $manadal = $this->db->query("SELECT id,name FROM mandals WHERE id = '$user_info->mandal'")->row();
                                        ?>
                                        <span class="certificateClsStg"><?= $manadal->name ?></span>
                                    </div>



                                    <div class="kyc-drop-for">
                                        <div class="kyc-form-cntrl" style="margin: 0 0px 0px;">
                                            <label>8. Aadhar No.</label>
                                            <span class="certificateClsStg"><?= $user_info->adhaar_no ?></span>
                                            <?php if ($user_info->adhaar_file) { ?>
                                                <a href="<?= base_url($user_info->adhaar_file); ?>" target="_blank">
                                                    <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                </a>
                                                <div class="down-btns" style="justify-content: flex-start;margin-bottom: 15px;margin-top: 10px;">
                                                    <a href="<?= base_url($user_info->adhaar_file); ?>" type="file" class="custom-file-input" download="aadhar">Download</a>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                    <div class="kyc-drop-form">
                                        <div class="kyc-form-cntrl" style="margin: 0 15px 0px;">
                                            <label>9. PAN card</label>
                                            <div class="file-path">
                                                <span class="certificateClsStg" download><?= $user_info->pan_no ?></span>
                                                <?php if ($user_info->pan_file) { ?>
                                                    <a href="<?= base_url($user_info->pan_file); ?>" target="_blank">
                                                        <img src="<?= base_url("assets/") ?>images/eye--icon.png" class="viewBtnStgKyc" />
                                                    </a>
                                                    <div class="down-btns">
                                                        <a href="<?= base_url($user_info->pan_file); ?>" type="file" class="custom-file-input" download="pancard">Download</a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="kyc-form-cntrl">
                                        <label>10. Education background</label>
                                        <span class="certificateClsStg"><?= $user_info->education ?></span>

                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>11. Employment Status</label>
                                        <span class="certificateClsStg"><?= $user_info->employment ?></span>

                                    </div>
                                    <div class="kyc-form-cntrl" class="form-control">
                                        <label>12. Did you take support from any of the following institutions?</label>
                                        <span class="certificateClsStg"><?= $user_info->institution ?></span>

                                    </div>
                                    <div class="kyc-form-cntrl">
                                        <label>13. Are you a Pwd (Person With Disabilities)?</label>
                                        <span class="certificateClsStg"><?php if ($user_info->pwd == "Yes") echo "Yes";
                                                                        else echo "No"; ?></span>

                                    </div>
                                    <!-- <div class="kyc-form-cntrl">
                                                <div class="kyc-form-buttons">
                                                    <button>Save draft</button>
                                                    <input type="submit" name="submit" class="active" value="Submit" />
                                                </div>
                                            </div> -->
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
                                        echo 'Apply for certification';
                                    } ?>


                                </form>
                            </div>
                            <div id="add_doc_sec" style="display:none;">

                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th> <input type="checkbox" id="tblHeading"></th>
                                                <th>Doc Name</th>
                                                <th>Download</th>
                                                <th>Doc File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $docs = $this->db->query("SELECT * FROM `documents` WHERE user_id = '$user_info->id'")->result_array();
                                            foreach ($docs as $doc) {
                                            ?>
                                                <tr>
                                                    <td><input type="checkbox" class="tableRowSelect uncheckTop" name="kyc_list[]" value="<?php echo $doc['id']; ?>"></td>
                                                    <td><?php echo $doc['name']; ?></td>
                                                    <td><a href="<?= base_url($doc['file_name']); ?>" download>Download</a></td>
                                                    <td><a href="<?php echo base_url($doc['file_name']); ?>" target="_blank"><img src="<?php echo base_url('assets/images/eye--icon.png'); ?>" /></a></td>
                                                </tr>
                                            <?php }  ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="remarks_sec" style="display:none;">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr style="height: 44px;">
                                                <th>Remark</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //print_r($remarks);
                                            //$remarks = $this->db->query("SELECT statusRemark FROM status_manage_tbl WHERE user_id = '$user_info->id' and statusType = 'KYC Verify'")->result_array();
                                            if ($remarks) {
                                                foreach ($remarks as $rmk) { ?>
                                                    <tr>
                                                        <td class="ey-icon"><?= $rmk['statusRemark']; ?></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                    </div>
                    </section>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="status-popup dash-board-popup" id="statusPopup">
        <div class="container" style="width:auto;"><br>
            <div class="new-doc">
                <br>
                <h2>Status <span id="closeStatusPopup" class="closePopCls">x</span></h2>
            </div>
            <div class="doc-sub">
                <div class="doc-sub-form">
                    <label>Status</label>
                    <select name="kyc_status" id="kyc_sts">
                        <?php
                        $sts = array("3" => "Verified", "4" => "Rejected");
                        foreach ($sts as $key => $val) {
                            echo "<option value='" . $key . "'>" . $val . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="doc-sub-form">
                    <label>Remarks</label>
                    <textarea name="kyc_remarks" id="kyc_remarks" type="text" class="custom-input"></textarea>
                </div>
                <div class="row">

                    <div class="col-lg-4">
                        <input name="submit" type="button" value="Submit" id="kycStatusBtn" />
                    </div>
                </div>
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
            $("#KYC").addClass("active")
            $("#Certification").removeClass("active");
            $("#Additional").removeClass("active");
            $("#Remarks").removeClass("active");
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
            $("#certification_sec").show();
            $("#KYC").removeClass("active");
            $("#Additional").removeClass("active");
            $("#Remarks").removeClass("active");
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
            $("#KYC").removeClass("active");
            $("#Certification").removeClass("active");
            $("#Remarks").removeClass("active");
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
            $("#KYC").removeClass("active");
            $("#Certification").removeClass("active");
            $("#Additional").removeClass("active");
        })
    })
</script>

<script type="text/javascript">
    $('#scheduleMeeting').click(function() {
        $('#meeting_multi_user').val('');
        $('#meeting_page').val('kyc');
        $('#meeting_page_type').val('2'); //1=multiple user;2=single user;
        var user_id = '<?php echo $user_info->id; ?>';
        $("#meeting_user_id").val(<?php echo $user_info->id; ?>);
        $('.get-metting').show();
    });

    $('#closePopup').click(function() {
        $('.get-metting').hide();
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
        $(document).on('click', '#kycStatusBtn', function() {
            var kyc_status = $("#kyc_sts").val();
            var kyc_remarks = $("#kyc_remarks").val();
            var user_id = $("#user_id").val();
            //console.log('kyc_status=='+kyc_status+'user_id = '+user_id+'---kyc_remarks=='+kyc_remarks);
            //alert(kyc_status);
            if (kyc_status = '' || kyc_status == null) {
                $.notify('Select status', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
            } else {
                var sts = $("#kyc_sts").val();
                $.ajax({
                    url: '<?php echo base_url('master_kyc_sts_update'); ?>',
                    type: 'POST',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        'kyc_status': sts,
                        'kyc_remarks': kyc_remarks,
                        'user_id': <?php echo $user_info->id; ?>
                    },
                    success: function(data) {
                        let res = $.parseJSON(data);
                        if (res.response == '1') {
                            $('.status-popup').hide(500);
                            $('.stsBgStg').html(res.newSts);
                            $.notify(res.message, {
                                'className': 'success',
                                'position': 'top left',
                                'autoHideDelay': 1500
                            });
                        } else {
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

<script>
    $('#tblHeading').click(function(event) {
        if (this.checked) {
            $('.tableRowSelect').each(function() {
                this.checked = true;
            });
        } else {
            $('.tableRowSelect').each(function() {
                this.checked = false;
            });
        }
    });
</script>

<script>
    $('.uncheckTop').click(function(event) {
        $('#tblHeading').each(function() {
            this.checked = false;
        });
    });
</script>
<script>
    $("#download_list").attr('autocomplete', 'off');
    $("#download_list").on('submit', function() {
        var checkboxes = document.getElementsByName('kyc_list[]');
        var result = "";
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                result += checkboxes[i].value +
                    " " + " Laptop, ";
            }
        }
        if (result.length == '0' || result.length == '' || result.length == null || result.length == undefined) {
            $.notify("Select row in from table", {
                'className': 'danger',
                'position': 'top left',
                'autoHideDelay': 1500
            });
            return false;
        }

    });
</script>

<script>
    $(function() {
        $('.dashboardCls').removeClass('active');
        $('.kycCls').addClass('active');
        $('.certificateCls').removeClass('active');
        $('.grievanceCls').removeClass('active');
        $('.subAdminCls').removeClass('active');
        $('.checklistCls').removeClass('active');
    });
</script>