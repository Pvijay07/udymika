<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?=$title?> | Petsfolio Leads</title>
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
                                    <h2 class="mb-sm-0"><?=$title?> (<?=count($leads)?>)</h2>

                                    <div class="page-title-right">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">

                                        <table id="datatable"
                                            class="table table-striped table-bordered dt-responsive nowrap"
                                            style="border: 2px solid #dee2e6; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Service Name</th>
                                                    <th>Name</th>
                                                    <th>City</th>
                                                    <th>Mobile No.</th>
                                                    <th>Submit Time</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            $i = 1;
                                            foreach($leads as $lead){
                                                $appointment = $this->crud_model->select("leads", array("id"=>$lead->lead_id))
                                            ?>
                                                <tr>
                                                    <td><?=$i?></td>
                                                    <td><?=$appointment->service; ?></td>
                                                    <td><?=$appointment->name?></td>
                                                    <td><?=$appointment->city?></td>
                                                    <td><?=$appointment->mobile?></td>
                                                    <td><?=$lead->created_at?></td>
                                                    <td><?=$lead->status?></td>
                                                    <td>
                                                        <a href="<?=base_url('admin/leads/history/'.$lead->lead_id)?>"
                                                            class="btn btn-outline-info btn-sm" title="History"
                                                            data-id="<?=$lead->lead_id?>">
                                                            <i class=" fas fa-comments"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-outline-success btn-sm viewbtn"
                                                            title="View" data-id="<?=$lead->lead_id?>">
                                                            <i class=" fas fa-eye"></i>
                                                        </a>
                                                        <?php if($this->session->userdata("user_type")=='Admin' || $this->session->userdata("user_type")=='Manager'){ ?>
                                                        <a href="<?=base_url('admin/leads/edit/'.$lead->lead_id)?>"
                                                            class="btn btn-outline-warning btn-sm" title="Edit">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <?php } ?>
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
                            '&demo_date=' + demo_date + '&lead=' + lead +
                            '&comments=' + comments + '&id=' + id + '&submit=1',
                        success: function(data) {
                            $('#updatemsg').html(
                                "<strong>Lead Status Successfully Updated.</strong>"
                            );
                            $('.commentsbox').html(data);
                        }
                    });


                });
            });


            $(".viewbtn").click(function() {
                var id = $(this).data('id');
                $('#viewmodal').modal('show');

                $.ajax({
                    type: "POST",
                    url: "<?=base_url('admin/leads/view');?>",
                    data: "id=" + id,
                    success: function(data) {
                        $('#leadview').html(data);
                    }
                });
            });

        });
        </script>

</body>

</html>