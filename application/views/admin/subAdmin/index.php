		
<?php $this->load->view('admin/head'); ?>
<style>
    /* Style for error messages */
    label.error {
        color: red;
        font-size: 14px;
    }
</style>

<body>
    <div class="dashboard-page admin__subadmin">
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

                    <div class="dash-seections  doc-download">
                    <?php if ($this->session->flashdata('msg')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong><?php echo $this->session->flashdata('msg'); ?></strong>
                        </div>
                        <?php endif; ?>
                        
                        <div class="sort-filter sub-admin-sort">
                            <a class="create-new-sub subAdminStg"><img src="<?php echo base_url('assets/images/plus-icon.png'); ?>" />Create New Sub Admin</a>
                        </div>
                        <form action="<?php echo base_url('master_admin_download'); ?>" method="post" id="download_list">
                            <div class="doc-search">
                                <div class="search-icon">
                                    <input type="search" placeholder="Search" id="serach_item">
                                </div>

                                <div>
                                    <div class="down-btns">
                                        <a class="schedule-btn" id="scheduleMeeting">
                                            <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14 1V5M6 1V5M1 9H19M3 3H17C18.1046 3 19 3.89543 19 5V19C19 20.1046 18.1046 21 17 21H3C1.89543 21 1 20.1046 1 19V5C1 3.89543 1.89543 3 3 3Z" stroke="#344054" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            Schedule Meeting
                                        </a>
                                        <button type="submit" class="custom-file-input"> </button>
                                    </div>
                                </div>

                            </div>
                            <div class="doc-upload-table">
                                <div class="table-responsive">
                                    <table id="search_table" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr style="height: 44px;">
                                                <th><input type="checkbox" id="tblHeading"></th>
                                                <th>Name</th>
                                                <th>Phone Number</th>
                                                <th>District</th>
                                                <th>Email Address</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($subadmin as $sub) { ?>
                                                <tr id="row_id_<?= $sub['admin_id']; ?>">
                                                    <td><input type="checkbox" class="tableRowSelect uncheckTop" name="admin[]" value="<?php echo $sub['admin_id']; ?>" /></td>
                                                    <td><span class="openAdminDetails" id="openAdminDetails" sub_admin="<?= $sub['admin_id']; ?>"><?= $sub['admin_name']; ?></span></td>
                                                    <td><?= $sub['admin_contact']; ?></td>
                                                    <td><?= $sub['name']; ?></td>
                                                    <td><?= $sub['admin_email']; ?></td>
                                                    <td class="icon">
                                                        <img src="<?php echo base_url('assets/images/re-write.png'); ?>" user_id="<?= $sub['admin_id']; ?>" class="editAdmin"></img>
                                                        <button class="btn_normal user_del" id="deleteCheckList" user_id="<?= $sub['admin_id']; ?>">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M2.5 4.99984H4.16667M4.16667 4.99984H17.5M4.16667 4.99984V16.6665C4.16667 17.1085 4.34226 17.5325 4.65482 17.845C4.96738 18.1576 5.39131 18.3332 5.83333 18.3332H14.1667C14.6087 18.3332 15.0326 18.1576 15.3452 17.845C15.6577 17.5325 15.8333 17.1085 15.8333 16.6665V4.99984H4.16667ZM6.66667 4.99984V3.33317C6.66667 2.89114 6.84226 2.46722 7.15482 2.15466C7.46738 1.8421 7.89131 1.6665 8.33333 1.6665H11.6667C12.1087 1.6665 12.5326 1.8421 12.8452 2.15466C13.1577 2.46722 13.3333 2.89114 13.3333 3.33317V4.99984M8.33333 9.1665V14.1665M11.6667 9.1665V14.1665" stroke="#667085" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </button>
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
                </div>
            </div>
        </div>


        <div class="get-details dash-board-popup" id="checklistPopup">
            <div class="container" style="width:auto;">
                <form action="<?= base_url("master_add_subadmin") ?>" id="adminCreateValidate" method="post" enctype="multipart/form-data">
                    <div class="new-doc">
                        <h2>Create Sub Admin <span class="closePopCls" id="closeStatusPopup">X</span></h2>

                    </div>
                    <div class="doc-sub">
                        <div class="doc-sub-form">
                            <label>Full Name<b>*</b></label>
                            <input name="full_name" id="full_name" type="text" placeholder="Enter full name" data-validation="required">
                        </div>
                        <div class="doc-sub-form">
                            <label>Phone Number*</label>
                            <input name="phone_number" id="phone_number" type="text" placeholder="Phone Number" maxlength="10" data-validation="required" data-validation-length="min10" data-validation-length="max10">
                        </div>
                        <div class="doc-sub-form">
                            <label>District*</label>
                            <select name="district" id="district" type="text" data-validation="required">
                                <option value="">District</option>
                                <?php
                                $district = $this->db->query("select id, name from districts")->result_array();
                                if (!empty($district)) {
                                    foreach ($district as $dist) {
                                        echo "<option value='" . $dist['id'] . "'>" . $dist['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="kyc-form-cntrl">
                            <label>Aadhar Number*</label>
                            <div class="file-path">
                                <input type="text" name="aadhar_no" id="aadhar_no" placeholder="Enter Aadhar No." maxlength="12" data-validation="required" data-validation-length="min12" data-validation-length="max12" />
                                <input type="file" name="aadhar_card" class="custom-file-input" data-validation="required" accept="application/pdf">
                            </div>
                        </div>

                        <div class="doc-sub-form">
                            <label>Email*</label>
                            <input name="email" id="email" type="email" placeholder="Email" data-validation="required">
                        </div>
                        <div class="doc-sub-form">
                            <label>Password*</label>
                            <input name="password" id="password" type="password" placeholder="Password" data-validation="required" data-validation-length="min8" />
                        </div>
                        <div class="doc-sub-form">
                            <label>Confirm Password*</label>
                            <input name="confirm_password" id="confirm_password" type="password" placeholder="Confirm Password" data-validation="required" data-validation-length="min8">
                        </div>

                        <div class="row">

                            <div class="col-lg-4">
                                <input name="submit" type="submit" value="Submit" />
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
        <div class="get-details dash-board-popup" id="updateAdminPopup">
            <div class="container" style="width:auto;">
                <form action="<?= base_url("update_sub_admin") ?>" method="post" id="editadminCreateValidate" enctype="multipart/form-data">
                    <div class="new-doc">
                        <h2>Update Sub Admin <span class="closePopCls" id="editPopupClose">X</span></h2>

                    </div>
                    <div class="doc-sub">
                        <div class="doc-sub-form">
                            <label>Full Name <b>*</b></label>
                            <input name="full_name" id="edit_admin_name" type="text" value="">
                            <input name="admin_id" id="admin_id" type="hidden" value="">
                            <input name="admin_profile" id="admin_profile" type="hidden" value="">
                        </div>
                        <div class="doc-sub-form">
                            <label>Phone Number</label>
                            <input name="phone_number" id="edit_admin_phone" type="text" placeholder="Phone Number">
                        </div>
                        <div class="doc-sub-form">
                            <label>District</label>
                            <select name="district" id="edit_admin_district" type="text">
                                <?php
                                $district = $this->db->query("select id, name from districts")->result_array();
                                if (!empty($district)) {
                                    foreach ($district as $dist) {
                                        echo "<option value='" . $dist['id'] . "'>" . $dist['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="doc-sub-form">
                            <label>Aadhar Number</label>
                            <input type="text" name="aadhar_no" id="edit_admin_pan" maxlength="12" value="" data-validation="length" data-validation-length="min12" data-validation-length="max12" />
                        </div>
                        <div class="doc-sub-form">
                            <label>Email</label>
                            <input name="email" id="edit_admin_email" type="text" placeholder="Email">
                        </div>
                        <div class="doc-sub-form">
                            <label>Password</label>
                            <input name="password" id="edit_admin_password" type="password" placeholder="Password">
                        </div>
                        <div class="doc-sub-form">
                            <label>Confirm Password</label>
                            <input name="confirm_password" id="edit_admin_pass_con" type="password" placeholder="Confirm Password">
                        </div>
                        <div class="row">

                            <div class="col-lg-4">
                                <input name="submit" type="submit" value="Submit" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="get-details dash-board-popup" id="adminViewPopup">
            <div class="container" style="width:auto;">
                <form action="<?php //base_url("master_subadmin"); 
                                ?>" method="post" enctype="multipart/form-data">
                    <div class="new-doc">
                        <h2>Profile View <span class="closePopCls" id="viewPopupClose">X</span></h2>

                    </div>
                    <div class="doc-sub" style="background: #f6dfe6;">
                        <div class="doc-sub-form">
                            <label>Full Name</label>
                            <input name="view_full_name" id="view_full_name" type="text" placeholder="Enter full name">
                        </div>
                        <div class="doc-sub-form">
                            <label>Phone Number</label>
                            <input name="view_phone_number" id="view_phone_number" type="text" placeholder="Phone Number">
                        </div>
                        <div class="doc-sub-form">
                            <label>District</label>
                            <select name="view_district_id" id="view_district_id" type="text">
                                <option value="">District</option>
                                <?php
                                $district = $this->db->query("select id, name from districts")->result_array();
                                if (!empty($district)) {
                                    foreach ($district as $dist) {
                                        echo "<option value='" . $dist['id'] . "'>" . $dist['name'] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="kyc-form-cntrl">
                            <label>Aadhar Number</label>
                            <div class="file-path">
                                <input type="text" name="view_aadhar_num" id="view_aadhar_num" placeholder="Enter Aadhar No." maxlength="12" data-validation="length" data-validation-length="min12" data-validation-length="max12" value="" />
                                <input type="file" name="pan_card" class="custom-file-input">
                                <input type="hidden" name="old_pan" value="">
                            </div>
                        </div>
                        <div class="doc-sub-form">
                            <label>Email</label>
                            <input name="view_user_email" id="view_user_email" type="text" placeholder="Email">
                        </div>


                    </div>
                </form>
            </div>
        </div>
        <?php $this->load->view('admin/footer'); ?>
</body>

</html>

<script>
    $(document).ready(function() {
        $(document).on('click', '#deleteCheckList', function() {
            var user_id = $(this).attr('user_id');
            if (!confirm("Do you want to delete the record?")) {
                return false;
            } else {
                if (user_id == '' || user_id == null || user_id == '0') {
                    $.notify('Session exppire login again for delete', {
                        'className': 'danger',
                        'position': 'top left',
                        'autoHideDelay': 1500
                    });
                } else {
                    $.ajax({
                        url: '<?php echo base_url('master_sub_deleted'); ?>',
                        type: 'POST',
                        data: {
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                            'user_id': user_id
                        },
                        success: function(data) {
                            let res = $.parseJSON(data);
                            if (res.response == '1') {
                                $("#row_id_" + user_id).hide();
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
            }
        });
    });
</script>

<script type="text/javascript">
    $('.subAdminStg').click(function() {
        $('#checklistPopup').show();
    });

    $('#closeStatusPopup').click(function() {
        $('#checklistPopup').hide();
    });
</script>

<script type="text/javascript">
    $('.editAdmin').click(function() {
        var id = $(this).attr("user_id");
        if (id == '' || id == null) {
            $.notify("Invalid admin Id", {
                'className': 'success',
                'position': 'top left',
                'autoHideDelay': 1500
            });
            return false;
        } else {
            $.ajax({
                url: '<?php echo base_url('master_sub_admin'); ?>',
                type: 'POST',
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                    'id': id
                },
                success: function(data) {
                    let res = $.parseJSON(data);
                    if (res.response == '1') {
                        $("#admin_id").val(res.datas.admin_id);
                        $("#edit_admin_name").val(res.datas.admin_name);
                        $("#edit_admin_phone").val(res.datas.admin_contact);
                        $("#edit_admin_district").val(res.datas.admin_district);
                        $("#edit_admin_pan").val(res.datas.aadhar_number);
                        $("#edit_admin_email").val(res.datas.admin_email);
                        $('#updateAdminPopup').show(500);
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

    $('#editPopupClose').click(function() {
        $('#updateAdminPopup').hide();
    });
</script>

<script type="text/javascript">
    $('.openAdminDetails').click(function() {
        var id = $(this).attr("sub_admin");
        if (id == '' || id == null) {
            $.notify("Admin details", {
                'className': 'success',
                'position': 'top left',
                'autoHideDelay': 1500
            });
            return false;
        } else {
            $.ajax({
                url: '<?php echo base_url('master_sub_admin'); ?>',
                type: 'POST',
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                    'id': id
                },
                success: function(data) {
                    let res = $.parseJSON(data);
                    if (res.response == '1') {
                        $("#view_full_name").val(res.datas.admin_name);
                        $("#view_phone_number").val(res.datas.admin_contact);
                        $("#view_district_id").val(res.datas.admin_district);
                        $("#view_aadhar_num").val(res.datas.aadhar_number);
                        $("#view_user_email").val(res.datas.admin_email);
                        $('#adminViewPopup').show(500);
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

    $('#viewPopupClose').click(function() {
        $('#adminViewPopup').hide();
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {

        $("#adminCreateValidate").validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent()); 
                        },
            rules: {
                full_name: {
                    required: true,
                    letterswithspaces: true
                },
                phone_number: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                district: "required",
                aadhar_no: {
                    required: true,
                    digits: true,
                    minlength: 12,
                    maxlength: 12
                },
                aadhar_card: {
                    required: true,

                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 15
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                full_name: {
                    required:"Enter name",
                    letterswithspaces:"Enter a valid name with only letters and spaces"
                },

                phone_number: {
                    required: "Enter phone number",
                    digits: "Enter a valid phone number",
                    minlength: "Phone number must be 10 digits",
                    maxlength: "Phone number must be 10 digits"
                },
                district: "Select district",
                aadhar_no: {
                    required: "Enter aadhar number",
                    digits: "Enter a valid Aadhar number with only digits",
                    minlength: "Aadhar number must be 12 digits",
                    maxlength: "Aadhar number must be 12 digits"
                },
                aadhar_card: {
                    required: "Please attach aadhar",

                },
                email: {
                    required: "Enter email id",
                    email: "Enter a valid email"
                },
                password: {
                    required: "Create login password",
                    minlength: "Password must be at least 8 characters",
                    maxlength: "Password can't exceed 15 characters"
                },
                confirm_password: {
                    required: "Enter confirm password",
                    equalTo: "Both passwords must match"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
       
            $.validator.addMethod("letterswithspaces", function(value, element) {
                return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
            }, "Enter a valid name with only letters and spaces");
        
        $("#adminCreateValidate").on("invalid-form.validate", function() {
            var invalidFields = $(this).find("[aria-invalid=true]");
            invalidFields.each(function() {
                $(this).next("label.error").css("color", "red");
            });
        });
    });
</script>

<!-- edit -->
<script>
    $(document).ready(function() {

        $("#editadminCreateValidate").validate({
            errorPlacement: function(error, element) {
                error.appendTo(element.parent()); 
                        },
            rules: {
                full_name: {
                    required: true,
                    letterswithspaces: true
                },
                phone_number: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10
                },
                district: "required",
                aadhar_no: {
                    required: true,
                    digits: true,
                    minlength: 12,
                    maxlength: 12
                },
                aadhar_card: {
                    required: true,

                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8,
                    maxlength: 15
                },
                confirm_password: {
                    required: true,
                    equalTo: "#edit_admin_password"
                }
            },
            messages: {
                full_name: {
                    required:"Enter name",
                    letterswithspaces:"Enter a valid name with only letters and spaces"
                },

                phone_number: {
                    required: "Enter phone number",
                    digits: "Enter a valid phone number",
                    minlength: "Phone number must be 10 digits",
                    maxlength: "Phone number must be 10 digits"
                },
                district: "Select district",
                aadhar_no: {
                    required: "Enter aadhar number",
                    digits: "Enter a valid Aadhar number with only digits",
                    minlength: "Aadhar number must be 12 digits",
                    maxlength: "Aadhar number must be 12 digits"
                },
                aadhar_card: {
                    required: "Please attach aadhar",

                },
                email: {
                    required: "Enter email id",
                    email: "Enter a valid email"
                },
                password: {
                    required: "Create login password",
                    minlength: "Password must be at least 8 characters",
                    maxlength: "Password can't exceed 15 characters"
                },
                confirm_password: {
                    required: "Enter confirm password",
                    equalTo: "Both passwords must match"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
       
            $.validator.addMethod("letterswithspaces", function(value, element) {
                return this.optional(element) || /^[A-Za-z\s]+$/i.test(value);
            }, "Enter a valid name with only letters and spaces");
        
        $("#adminCreateValidate").on("invalid-form.validate", function() {
            var invalidFields = $(this).find("[aria-invalid=true]");
            invalidFields.each(function() {
                $(this).next("label.error").css("color", "red");
            });
        });
    });
</script>



<?php if (!empty($this->session->flashdata('msg'))) { ?>
    <script>
        $.notify("<?php echo $this->session->flashdata('msg'); ?>", {
            'className': 'success',
            'position': 'top left',
            'autoHideDelay': 1500
        });
    </script>
<?php } ?>

<script type="text/javascript">
    $('#scheduleMeeting').click(function() {
        var selected = [];
        $('[name="admin[]"]:checked').each(function(checkbox) {
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
            $('#meeting_page').val('admin');
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
        var checkboxes = document.getElementsByName('admin[]');
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
      $('.grievanceCls').removeClass('active');
      $('.subAdminCls').addClass('active');
      $('.checklistCls').removeClass('active');
    });
</script>
<script>

$(document).ready(function() {
      $('.alert .close').on('click', function() {
        $(this).parent().fadeOut();
      });
    });
</script>
