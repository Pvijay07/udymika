<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Leads History | Petsfolio Leads</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?=base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <link href="<?=base_url()?>assets/css/bootstrap-datetimepicker.min.css" type="text/css" media="all"
        rel="stylesheet" />
    <link href="<?=base_url()?>assets/css/theme-default.css" rel="stylesheet" />

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

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h3><?=$title?></h3>

                                <div class="page-title-right">
                                    <a href="javascript:history.back();"
                                        class="btn btn-success waves-effect waves-light">
                                        <i class=" fas fa-bars align-middle me-2"></i> Leads
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">


                            <!-- Right Sidebar -->

                            <div class="card">
                                <div class="card-body">
                                    <?php 
                                            foreach($leads_status as $lead_status){ 
                                            $user_info = $this->crud_model->select("sales", array("id" => $lead_status->sales_id));
                                            $lead_info = $this->crud_model->select("leads", array("id" => $lead_status->lead_id));
                                            ?>
                                    <div class="d-flex mb-4">
                                        <img class="me-3 rounded-circle avatar-sm"
                                            src="<?=base_url()?>assets/images/users/avatar-1.jpg"
                                            alt="Generic placeholder image">
                                        <div class="flex-1">
                                            <h5 class="font-size-14 my-1">
                                                <?=$user_info->first_name. " ".$user_info->last_name?> <i> Updated on
                                                    <?=$lead_status->created_at?></i></h5>
                                            <small class="text-muted">Sales Excutives</small>
                                        </div>
                                    </div>

                                    <p><strong>visited
                                            :
                                        </strong><?php if($lead_status->visit_status==1) echo "YES"; else echo "NO"; ?>.
                                        <strong>Status
                                            : </strong><?=$lead_status->status?>. <strong>Appointment Date :
                                        </strong><?=$lead_status->demo_date." ".$lead_status->demo_time?>.
                                    <p><strong>Comment : </strong> <?=$lead_status->message?></p>
                                    <?php if(!empty($lead_info->image)){ ?>
                                    <p><strong>Uploaded Image : </strong> <a target="_blank"
                                            href="<?=base_url($lead_info->image)?>">Download</a></p>
                                    <?php } ?>
                                    <hr />
                                    <?php } ?>

                                </div>

                            </div>
                        </div>
                        <!-- card -->

                        <div class="card">
                            <div class="card-body">
                                <h3>Update Lead Details</h3>
                                <?php $this->load->view('admin/includes/_messages.php') ?>
                                <form class="needs-validation" action="<?=base_url('admin/leads/update/'.$lead->id)?>"
                                    method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Lead Status</label>
                                                <select name="lead_status" id="lead_status" class="form-select"
                                                    data-validation="required">
                                                    <option value="">Select Lead Status</option>
                                                    <option value="New"
                                                        <?php if($lead->status == "New") echo 'selected'; ?>>New
                                                    </option>
                                                    <option value="Follow Up"
                                                        <?php if($lead->status == "Follow Up") echo 'selected'; ?>>
                                                        Follow Up</option>
                                                    <option value="Not Interested"
                                                        <?php if($lead->status == "Not Interested") echo 'selected'; ?>>
                                                        Not Interested</option>
                                                    <option value="Not Responding"
                                                        <?php if($lead->status == "Not Responding") echo 'selected'; ?>>
                                                        Not Responding</option>
                                                    <option value="Price Issue"
                                                        <?php if($lead->status == "Price Issue") echo 'selected'; ?>>
                                                        Price Issue</option>
                                                    <option value="Joined"
                                                        <?php if($lead->status == "Joined") echo 'selected'; ?>>Joined
                                                    </option>
                                                    <option value="Future"
                                                        <?php if($lead->status == "Future") echo 'selected'; ?>>Future
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="leaddate"
                                            <?php if($lead->status == "Follow Up") echo 'style="display:block;"'; else echo 'style="display:none;"' ?>>
                                            <div class="mb-3">
                                                <label for="validationCustom02" class="form-label">Follow Up
                                                    Date</label>
                                                <div class="input-group date" id="id_3">
                                                    <input type="text" id="followup_date" name="followup_date"
                                                        value="<?=$lead->followup_date?>" class="form-control" />
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Appointment
                                                    Status</label>
                                                <select name="demo_status" id="demo_status" class="form-select"
                                                    data-validation="required">
                                                    <option value="">Select Appointment Status</option>
                                                    <option value="Pending"
                                                        <?php if($lead->demo_status == "Pending") echo 'Selected'; ?>>
                                                        Pending</option>
                                                    <option value="Scheduled"
                                                        <?php if($lead->demo_status == "Scheduled") echo 'Selected'; ?>>
                                                        Scheduled</option>
                                                    <option value="Done"
                                                        <?php if($lead->demo_status == "Done") echo 'Selected'; ?>>Done
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="demodate"
                                            <?php if($lead->demo_status == "Scheduled") echo 'style="display:block;"'; else echo 'style="display:none;"' ?>>
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Appointment
                                                    Date</label>
                                                <div class="input-group date" id="id_1">
                                                    <input type="text" id="demo_date" name="demo_date"
                                                        class="form-control" value="<?=$lead->demo_date?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="demotime"
                                            <?php if($lead->demo_status == "Scheduled") echo 'style="display:block;"'; else echo 'style="display:none;"' ?>>
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Appointment
                                                    Time</label>
                                                <div class="input-group date" id="id_2">
                                                    <input type="text" id="demo_time" name="demo_time"
                                                        class="form-control" value="<?=$lead->demo_time?>" />
                                                    <span class="input-group-addon">
                                                        <i class="glyphicon glyphicon-time fa fa-clock-o"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3" id="sales"
                                            <?php if($lead->demo_status == "Scheduled") echo 'style="display:block;"'; else echo 'style="display:none;"' ?>>
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Assgin to</label>
                                                <select name="sales" id="sales_select" class="form-select">
                                                    <option value="">Select Sales Excutives</option>
                                                    <?php foreach($excutives as $excutive){ ?>
                                                    <option value="<?=$excutive->id?>"
                                                        <?php if($lead->sales == $excutive->id) echo 'Selected'; ?>>
                                                        <?=$excutive->first_name." ".$excutive->last_name?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="form-check mb-3">
                                            <input name="is_imp" class="form-check-input" type="checkbox" value="1"
                                                <?php if($lead->is_imp == 1) echo 'checked'; ?>>
                                            <label class="form-check-label" for="invalidCheck">
                                                Important Lead
                                            </label>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <textarea class="form-control" rows="4" name="comments"></textarea>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="submit" name="submit" id="submit"
                                                class="btn btn-info w-100 waves-effect waves-light" value="Submit">
                                        </div>
                                </form>
                            </div>
                        </div>


                        <!-- end Col-9 -->

                    </div>
                    <!-- end row -->


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

    <!--tinymce js-->
    <script src="<?=base_url()?>assets/libs/tinymce/tinymce.min.js"></script>

    <!-- init js -->
    <script src="<?=base_url()?>assets/js/pages/form-editor.init.js"></script>

    <script src="<?=base_url()?>assets/js/app.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.form-validator.js"></script>
    <script>
    $(function() {
        // setup validate
        $.validate();
    });
    </script>

    <script type="text/javascript">
    $(function() {

        "use strict";

        $('#id_1').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "YYYY-MM-DD",
        });

        $('#id_2').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "hh:mm:ss A",
        });

        $('#id_3').datetimepicker({
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "YYYY-MM-DD",
        });


        $('#lead_status').on('change', function() {

            if (this.value == 'Follow Up') {
                $("#leaddate").show();
                $("#demodate").show();
                $("#demotime").show();
                $("#sales").show();
            } else {
                $("#leaddate").hide();

                $("#followup_date").val("");
                $("#demo_status").val("Pending");
                $("#demo_date").val("");
                $("#demo_time").val("");
                $("#sales_select").val("");

                $("#demodate").hide();
                $("#demotime").hide();
                $("#sales").hide();
            }
        });

        $('#demo_status').on('change', function() {

            if (this.value == 'Scheduled') {
                $("#demodate").show();
                $("#demotime").show();
                $("#sales").show();
            } else {
                $("#demo_date").val("");
                $("#demo_time").val("");
                $("#sales_select").val("");
                $("#demodate").hide();
                $("#demotime").hide();
                $("#sales").hide();
            }
        });



    });
    </script>

</body>

</html>