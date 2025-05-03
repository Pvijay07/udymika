<?php $this->load->view('admin/head'); ?>

<body>
    <div class="dashboard-page unique">
        <div class="container">
            <div class="dashboard-main">
                <?php $this->load->view('admin/menus'); ?>

                <div class="dashboard-main-ryt">
                    <?php $this->load->view('admin/header'); ?>
                    <div class="dash-seections admin-dash_board">
                        <?php if ($this->session->flashdata('msg_info')) : ?>
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <strong><?php echo $this->session->flashdata('msg_info'); ?></strong>
                            </div>
                        <?php endif; ?>
                        <label>File Format <span>(Status=> 1= Register, 2=Submited,3=Verify,4=Rejected,5=Hold)</span></label><br>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <!-- <th>Password</th> -->
                                        <th>Phone</th>
                                        <th>DOB</th>
                                        <th>KYC ID</th>
                                        <th>Category</th>
                                        <th>District</th>
                                        <th>Mandal</th>
                                        <th>Village</th>
                                        <th>Adhaar No</th>
                                        <th></th>
                                        <th>Pan No</th>
                                        <th></th>
                                        <th>Education</th>
                                        <th>Employeement</th>
                                        <th>Institution</th>
                                        <th>PWD</th>
                                        <th></th>
                                        <th>Status</th>
                                        <th>Other Institute</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $userData = $this->db->query("SELECT * FROM users ORDER BY id desc")->result_array();

                                    foreach ($userData as $user) : ?>
                                        <tr>
                                            <td><?php echo $user['name']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <!-- <td><?php echo $user['password']; ?></td> -->
                                            <td><?php echo $user['phone']; ?></td>
                                            <td><?php echo $user['dob']; ?></td>
                                            <td><?php echo $user['kyc_id']; ?></td>
                                            <td><?php echo $user['category']; ?></td>
                                            <td><?php echo $user['district']; ?></td>
                                            <td><?php echo $user['mandal']; ?></td>
                                            <td><?php echo $user['village']; ?></td>
                                            <td><?php echo $user['adhaar_no']; ?></td>
                                            <td></td>
                                            <td><?php echo $user['pan_no']; ?></td>
                                            <td></td>
                                            <td><?php echo $user['education']; ?></td>
                                            <td><?php echo $user['employment']; ?></td>
                                            <td><?php echo $user['institution']; ?></td>
                                            <td><?php echo $user['pwd']; ?></td>
                                            <td></td>
                                            <td><?php echo $user['status']; ?></td>
                                            <td><?php echo $user['otherInstitute']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>

                            </table>
                        </div>
                        <br>
                        <br>

                        <div class="doc-search">
                            <div class="doc-sub">
                                <form action="<?= base_url("master_data_import") ?>" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="doc-sub-form">

                                                <label>Excel file</label>
                                                <input type="file" name="excelfile" id="excelfile" style="width:100%" onclick="validateFile()" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                            </div>
                                        </div>
                                    </div>

                                    <br><br>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input name="submit" type="submit" value="Submit" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><br><br>


                        <br>
                        <br>
                        <label>Export File List</label><br>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>File Name</th>
                                        <th>Export Date</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $list = $this->db->query("SELECT * FROM fileexportlist")->result_array();
                                    if (!empty($list)) {
                                        foreach ($list  as $value) { ?>
                                            <tr>
                                                <td><?php echo $value['fileName']; ?></td>
                                                <td><?php echo $value['expDate']; ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>



        <?php $this->load->view('admin/footer'); ?>


</body>

</html>
<?php if (!empty($this->session->flashdata("msg_info"))) { ?>
    <script>
        $.notify(<?php echo $this->session->flashdata("msg_info"); ?>, {
            'className': 'danger',
            'position': 'top left',
            'autoHideDelay': 1500
        });
    </script>
<?php } ?>

<script>
    $(function() {
        $('.dashboardCls').removeClass('active');
        $('.kycCls').removeClass('active');
        $('.certificateCls').removeClass('active');
        $('.grievanceCls').removeClass('active');
        $('.subAdminCls').removeClass('active');
        $('.checklistCls').removeClass('active');
        $('.userExportCls').addClass('active');
    });
</script>
<script>
        function validateFile() {
            const allowedFormats = [".csv", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.ms-excel"];
            const fileInput = document.getElementById("excelfile");
            const fileName = fileInput.value;
            const fileExtension = fileName.slice((fileName.lastIndexOf(".") - 1 >>> 0) + 2);
            const fileType = fileInput.files[0].type;

            if (allowedFormats.includes(fileExtension) || allowedFormats.includes(fileType)) {
                // Valid file format, proceed with upload or processing
                console.log("File format is valid");
            } else {
                alert("Invalid file format. Allowed formats: CSV, Excel files");
            }
        }
    </script>
    <script>

$(document).ready(function() {
      $('.alert .close').on('click', function() {
        $(this).parent().fadeOut();
      });
    });
</script>
