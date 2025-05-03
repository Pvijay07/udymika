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
                                    <li><a href="<?php echo base_url('lvl_grievance'); ?>"><img src="<?php echo base_url('assets/images/home-icon.png'); ?>" /></a></li>
                                    <li><a href="<?php echo base_url() ?>grievance_l1">Level-1</a></li>
                                    <li><a href="javascript:void(0);">Grievance</a></li>
                                    <li class="active"><a href="#">
                                            <?= $user_info->name; ?>
                                        </a></li>
                                </ul>
                            </div>
                            <div class="ad-kyc-sub-info">
                                <div>
                                    <h2>
                                        <?= $user_info->name; ?>
                                    </h2>
                                    <p>
                                        <?= $user_info->email; ?>
                                    </p>
                                </div>
                                <div class="kyc-business-details">

                                    <div>
                                        <h6>Ticket Number</h6>
                                        <p>
                                            <?= $griev->grievance_id; ?>
                                        </p>
                                        <input type="hidden" value="<?= $griev->grievance_id; ?>" id="hid_ticket" />
                                    </div>
                                    <div>
                                        <h6>Query Type</h6>
                                        <p>
                                            <?= $griev->query_type; ?>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <section class="kyc-form-section">
                            <div class="kyc-heading identifyCustStg" id="kyc-heading">
                                <ul id="nav-tab custTabStg">
                                    <li class="custTabMenuListStg" id="Additional">
                                        <a href="#tab3" style="font-size: 14px;">Additional Document</a>
                                    </li>
                                    <li class="custTabMenuListStg active" id="Grievance">
                                        <a href="#tab5">Raise a Query</a>
                                    </li>
                                </ul>
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
                                                    <?php
                                                    foreach ($grievance as $grievanc) { ?>
                                                        <tr>
                                                            <td><input type="checkbox"></td>
                                                            <td class="ey-icon">
                                                                <?php
                                                                $url = $grievanc['file'];
                                                                $file_name = basename($url);
                                                                echo $file_name;

                                                                ?>
                                                            </td>
                                                            <td class="te-center">
                                                                <?= date('M d Y', strtotime($grievanc['created_at'])); ?>
                                                            </td>
                                                            <td><a href="<?php echo base_url($grievanc['file']); ?>" download="download">Download</a></td>
                                                            <td><a href="<?php echo base_url($grievanc['file']); ?>" target="_blank"><img src="<?php echo base_url('assets/images/eye--icon.png'); ?>"></a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <?php echo $this->pagination->create_links(); ?>
                                    </div>
                                </form>
                            </div>
                            <div id="grievance_sec">
                                <div class="row tmt">
                                    <p class="adminGri">Latest Grievances</p>
                                    <div class="col-lg-5 admin-grie-view" style="width: 50%;/*float: left*/;margin-left: 0;">
                                        <div class="grievncsDiv">
                                            <h4>Earlier Grievances</h4>
                                            <?php

                                            foreach ($grievance as $grvnc) { ?>
                                                <p class="grievncsDivPStg"><span><?php echo $grvnc['grievance_id']; ?></span><span class="sbjStg" title="<?php echo $grvnc['subject']; ?>"><?php echo character_limiter($grvnc['subject'], 20); ?></span><span class="grvnceSpanStg"><span tickect_num="<?= $grvnc['grievance_id'] ?>" user_id="<?= $user_info->id; ?>" content="<?= $grvnc['content'] ?>" ticket_status="<?= $grvnc['status'] ?>" id="forum-pop">view</span></span></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
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
                <div class="container" style="width:auto;"><br>
                </div>
                <h2>Query Forum <span class="closePopCls" id="grivCLosePop">X</span></h2>

            </div>
            <div class="query-form admin_griev_ance_cht">
                <form action="<?php echo base_url() ?>master_grievance_update_l1" id="ticket_query" class="ticket_query" method="post" enctype="multipart/form-data">
                    <div class="doc-mains">
                        <div class="doc-sub-form">
                            <input type="hidden" class="tckt_num" name="ticket" value="<?= $griev->grievance_id; ?>">
                            <label for="">Query Status</label>
                            <select name="status_type" id="status_type">
                                <option value="">Select Status</option>
                                <option value="Open">Open</option>
                                <option value="Reassign to L2">Reassign to L2</option>
                                <option value="Reassign to L3">Reassign to L3</option>
                                <option value="Closed">Close</option>
                            </select>
                        </div>
                        <div class="doc-sub-form">
                            <input type="hidden" class="tckt_num" name="ticket" value="<?= $griev->grievance_id; ?>">
                            <label for="">Query Priority</label>
                            <select name="priority_type" id="priority_type">
                                <option value="">Select Priority</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Urgent">Urgent</option>
                            </select>

                        </div>
                    </div>
                    <div class="cht-submit">
                        <input type="hidden" name="ticketId" id="ticketId" value="<?= $griev->grievance_id; ?>" />
                        <input type="hidden" name="ticketUserId" id="ticketUserId" value="<?= $user_info->id; ?>" />
                        <input type="hidden" name="ticketAppId" id="ticketAppId" value="<?= $griev->id; ?>" />
                        <input type="hidden" name="pageId" id="pageId" value="<?= 'grievance_l1'; ?>" />
                        <div class="image-upload-chat" style="margin-right: 10px;cursor: pointer;">
                            <label for="file-input" style="cursor: pointer;"><img src="<?= base_url("assets/") ?>images/attachment-icon.png" /></label>
                            <input type="file" name="fileInsert" id="file-input">
                        </div>
                        <div class="uploaded-file-info"></div>
                        <div class="image-preview"></div>

                        <textarea class="input-control" name="queryDetails" id="queryDetails" style="height: 50px;"></textarea>
                        <input type="submit" value="Submit" id="grievance_update" name="submit" />
                        <div></div>
                    </div>
                </form>
                <div class="chatSbjctDisp">Subject:
                    <?php $sbjct = $this->db->query("SELECT query_type FROM l1_grievance WHERE id = '$griev->id'")->row_array();
                    echo $sbjct['query_type']; ?>
                </div>
                <div id="ticketDivSec">
                </div>
                <div id="chatDivSec">
                </div>
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
    <?php $this->load->view('admin/footer'); ?>


</body>

</html>
<script>
    $(document).ready(function() {
        $(document).on('click', '#lKYC', function() {
            $("#kyc_sec").show();
            $("#certification_sec").hide();
            $("#add_doc_sec").hide();
            $("#remarks_sec").hide();
            $("#grievance_sec").hide();
            $("#checklist_sec").hide();
            $("#lKYC").addClass("active")
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
            $('#grievncsDiv').hide();
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
                    url: '<?php echo base_url('get_grivance'); ?>',
                    type: 'POST',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        'ticket': ticket,
                        'user_id': user_id
                    },
                    success: function(data) {
                        let res = $.parseJSON(data);
                        console.log(res.chat);
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
<script type="text/javascript">
    $('#PriorityPopup1').click(function() {
        $('.priority-popup').show();
    });

    $('#closePriorityPopup').click(function() {
        $('.priority-popup').hide();
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#grievance_update', function() {
            var ticket = $(".tckt_num").val();
            var status_type = $("#status_type").val();
            var priority_type = $("#priority_type").val();
            if (ticket == null || ticket == '') {
                $.notify('Invalid request', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            }
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
            } else if (priority_type == null || priority_type == '') {
                $.notify('Select priority', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#grievance_update_priority', function() {
            var ticket = $(".tckt_num").val();
            var priority_type = $("#priority_type").val();
            if (ticket == null || ticket == '') {
                $.notify('Invalid request', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            }
            if (priority_type == null || priority_type == '') {
                $.notify('Select status', {
                    'className': 'danger',
                    'position': 'top left',
                    'autoHideDelay': 1500
                });
                return false;
            } else {
                $.ajax({
                    url: '<?php echo base_url('grievance_priorityupdate'); ?>',
                    type: 'POST',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        'ticket': ticket,
                        'priority_type': priority_type,
                        'user_id': <?= $user_info->id; ?>
                    },
                    success: function(data) {
                        let res = data;
                        console.log(res);
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
<script>
    const fileInput = document.getElementById('file-input');
    const uploadedFileInfo = document.querySelector('.uploaded-file-info');
    const imagePreview = document.querySelector('.image-preview');

    fileInput.addEventListener('change', (event) => {
        const selectedFile = event.target.files[0];
        const fileName = selectedFile.name;
        uploadedFileInfo.innerHTML = `<p>Uploaded File: ${fileName}</p>`;

        if (selectedFile.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.innerHTML = `<img src="${e.target.result}" alt="Uploaded Image" style="max-width: 100px; max-height: 100px;" />`;
            };
            reader.readAsDataURL(selectedFile);
        } else {
            imagePreview.innerHTML = '';
        }
    });
</script>