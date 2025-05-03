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
                    <div class="dash-seections admin-dash_board">
                        <div class="ad-kyc-nav">
                            <div class="ad-kyc-nav-top">
                                <ul>
                                    <li><a href="<?php echo base_url('lvl_grievance'); ?>"><img src="<?php echo base_url('assets/images/home-icon.png'); ?>" /></a></li>
                                    <li><a href="javascript:void(0);">Level-3</a></li>
                                    <li class="active"><a href="#">
                                            <?= $user_info->name; ?>
                                        </a></li>
                                </ul>
                            </div>
                            <div class="kyc-submt-sec">
                                <ul>
                                    <li class="active">
                                        <a href="<?php echo base_url('grievance_l3'); ?>">

                                            <div>
                                                <h6><?php echo $raised; ?></h6>
                                                <p>Received</p>
                                            </div>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="94" height="94" viewBox="0 0 94 94" fill="none">
                                                    <path d="M17 42L17 12C17 9.34783 18.0536 6.80429 19.9289 4.92893C21.8043 3.05356 24.3478 1.99999 27 1.99999L82 2C84.6522 2 87.1957 3.05357 89.0711 4.92893C90.9464 6.8043 92 9.34784 92 12L92 67C92 69.6522 90.9464 72.1957 89.0711 74.0711C87.1957 75.9464 84.6522 77 82 77L52 77M32 92L2 92M2 92L2 62M2 92L57 37" stroke="#FF8DB2" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('progress_list_l3'); ?>">
                                            <div>
                                                <h6><?php echo $process; ?></h6>
                                                <p>In Process</p>
                                            </div>
                                            <div>
                                                <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('closed_list_l3'); ?>">
                                            <div>
                                                <h6><?php echo $close; ?></h6>
                                                <p>Closed</p>
                                            </div>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="94" height="94" viewBox="0 0 94 94" fill="none">
                                                    <path d="M17 42L17 12C17 9.34783 18.0536 6.80429 19.9289 4.92893C21.8043 3.05356 24.3478 1.99999 27 1.99999L82 2C84.6522 2 87.1957 3.05357 89.0711 4.92893C90.9464 6.8043 92 9.34784 92 12L92 67C92 69.6522 90.9464 72.1957 89.0711 74.0711C87.1957 75.9464 84.6522 77 82 77L52 77M32 92L2 92M2 92L2 62M2 92L57 37" stroke="#FF8DB2" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <form action="" method="post" id="download_list">
                                <div class="doc-search">
                                    <div class="search-icon">
                                        <input type="search" placeholder="Search" id="serach_item">
                                    </div>
                                    <div>
                                    </div>
                                </div>
                                <div class="doc-upload-table">
                                    <div class="table-responsive">
                                        <table id="search_table" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr style="height: 44px;">
                                                    <th><input type="checkbox" id="tblHeading"> </th>
                                                    <th>Name</th>
                                                    <th>Aadhar No</th>
                                                    <th>Date Of Submission</th>
                                                    <th>Email Address</th>
                                                    <th>Phone </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($user_details as $user) {
                                                    $grvId = $user->id;
                                                    $grievance_id_query = $this->db->select('l3_grievance.id')
                                                        ->where('id', $grvId)
                                                        ->get('l3_grievance')
                                                        ->result();
                                                    // $this->db->save_queries = TRUE;
                                                    $tgrievance_id = $grievance_id_query[0]->id;
                                                    $totalCount_query = $this->db->select('COUNT(g_id) as totalCount')
                                                        ->where('chatRead', '0')
                                                        ->where('greivances_id', $tgrievance_id)
                                                        ->get('greivances_chat_tbl')
                                                        ->row_array();

                                                    $totGri = $totalCount_query['totalCount'];
                                                ?>
                                                    <tr>
                                                        <td><input type="checkbox" class="tableRowSelect uncheckTop" name="grievance[]" value="<?php echo $user->id; ?>"></td>
                                                        <td>
                                                            <a href="<?php echo base_url('l3_lvl_grievance_details/'  . $tgrievance_id . '/' . $user->user_id); ?>">
                                                                <?= $user->name; ?>
                                                                <?php echo $totGri; ?>
                                                            </a>
                                                        </td>
                                                        <td><?php echo $user->adhaar_no ?>
                                                        </td>
                                                        <td><?php echo $user->created_at; ?></td>
                                                        <td><?php echo $user->email; ?></td>
                                                        <td>+91 <?php echo $user->phone; ?></td>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                        <?php echo $this->pagination->create_links(); ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <?php $this->load->view('admin/footer'); ?>
</body>

</html>
<script type="text/javascript">
    $('#scheduleMeeting').click(function() {
        var selected = [];
        $('[name="grievance[]"]:checked').each(function(checkbox) {
            selected.push($(this).val());
        });

        if (selected.length == '0' || selected.length == '' || selected.length == null || selected.length == undefined) {
            $('#meeting_multi_user').val('');
            $.notify("Select a row from table", {
                'className': 'danger',
                'position': 'top left',
                'autoHideDelay': 1500
            });
            return false;
        } else {
            $('.get-metting').show();
            $('#meeting_multi_user').val(selected);
            $('#meeting_page').val('griv');
            $('#meeting_page_type').val('1'); //1=multiple user;2=single user;
            $('#meeting_user_id').val('0');
        }
    });

    $('#closePopup').click(function() {
        $('.get-metting').hide();
    });
</script>


<script>
    $("#serach_item").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#search_table > tbody > tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
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
        var checkboxes = document.getElementsByName('grievance[]');
        var result = "";
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                result += checkboxes[i].value +
                    " " + " Laptop, ";
            }
        }
        if (result.length == '0' || result.length == '' || result.length == null || result.length == undefined) {
            $.notify("Select a row from table", {
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
        $('.kycCls').removeClass('active');
        $('.certificateCls').removeClass('active');
        $('.grievanceCls').addClass('active');
        $('.subAdminCls').removeClass('active');
        $('.checklistCls').removeClass('active');
    });
</script>