<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?=$title?> | AWA Leads</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="<?=base_url()?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?=base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link href="<?=base_url()?>assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />


</head>

<body data-topbar="colored" data-layout="horizontal">

    <!-- Begin page -->
    <div id="layout-wrapper">


        <?php $this->load->view("admin/includes/_header.php"); ?>



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">


                        <!-- start page title -->
                        <div class="row" style="border-bottom:solid 1px #dee2e6;">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h2 class="mb-sm-0"><?=$title?> </h2>

                                    <div class="page-title-right">
                                        <a href="<?=base_url("admin/users/add")?>"
                                            class="btn btn-success waves-effect waves-light">
                                            <i class=" fas fa-plus align-middle me-2"></i> Create New User
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <?php $this->load->view('admin/includes/_messages.php') ?>
                                        <table id="datatable"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="border: 2px solid #dee2e6; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Email</th>
                                                    <th>Mobile No.</th>
                                                    <th>City</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            $i = 1;
                                            foreach($users as $user){
                                            ?>
                                                <tr>
                                                    <td><?=$i?></td>
                                                    <td><?=$user->name; ?></td>
                                                    <td><?=$user->usertype?></td>
                                                    <td><?=$user->email?></td>
                                                    <td><?=$user->phone?></td>
                                                    <td><?=$user->city?></td>
                                                    <td><?php if($user->is_active==1) echo 'Active'; else echo 'Inactive';?>
                                                    </td>
                                                    <td>
                                                        <a href="<?=base_url('admin/users/edit/'.$user->id)?>"
                                                            class="btn btn-outline-warning btn-sm viewbtn" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>

                                                        <a href="<?php echo site_url("admin/users/delete/".$user->id); ?>"
                                                            onclick="return confirm('are you sure to delete?')"
                                                            class="btn btn-outline-danger btn-sm viewbtn" title="View"
                                                            data-id="<?=$user->id?>">
                                                            <i class=" fas fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            $i++;
                                            }
                                            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                <?php $this->load->view("admin/includes/_footer.php"); ?>

            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->



        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="<?=base_url()?>assets/libs/jquery/jquery.min.js"></script>
        <script src="<?=base_url()?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url()?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?=base_url()?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?=base_url()?>assets/libs/node-waves/waves.min.js"></script>


        <!-- Required datatable js -->
        <script src="<?=base_url()?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?=base_url()?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Datatable init js -->
        <script src="<?=base_url()?>assets/js/pages/datatables.init.js"></script>

        <script src="<?=base_url()?>assets/js/app.js"></script>

        <script src="<?=base_url()?>assets/plugins/datetimepicker/js/picker.js"></script>
        <script src="<?=base_url()?>assets/plugins/datetimepicker/js/picker.date.js"></script>

        <script type="text/javascript">
        $(function() {

            "use strict";

            $('.datepicker').pickadate({
                selectMonths: true,
                selectYears: true
            })

            $('#lead_status').on('change', function() {

                if (this.value == 'Follow Up') {
                    $("#leaddate").show();
                } else {
                    $("#leaddate").hide();
                }
            });

            $('#demo_status').on('change', function() {

                if (this.value == 'Done') {
                    $("#demodate").show();
                } else {
                    $("#demodate").hide();
                }
            });

            $(".historybtn").click(function() {
                var id = $(this).data('id');
                $('#historymodal').modal('show');

                $.ajax({
                    type: "POST",
                    url: "<?=base_url('admin/leads/update');?>",
                    data: "id=" + id,
                    success: function(data) {
                        $('.commentsbox').html(data);
                    }
                });

                $("#submitbtn").click(function() {

                    var lead_status = $("#lead_status").val();
                    var followup_date = $("#followup_date").val();
                    var demo_status = $("#demo_status").val();
                    var demo_date = $("#demo_date").val();
                    var lead = $("#lead").val();
                    var comments = $("#comments").val();

                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('admin/leads/update');?>",
                        data: "lead_status=" + lead_status + '&followup_date=' +
                            followup_date + '&demo_status=' + demo_status +
                            '&demo_date=' + demo_date + '&lead=' + lead + '&comments=' +
                            comments + '&id=' + id + '&submit=1',
                        success: function(data) {
                            $('#updatemsg').html(
                                "<strong>Lead Status Successfully Updated.</strong>"
                            );
                            $('.commentsbox').html(data);
                        }
                    });


                });
            });



        });
        </script>

</body>

</html>