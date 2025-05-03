<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?=$title?> | AWA Leads</title>
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
                    <div class="row" style="border-bottom:solid 1px #dee2e6;">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h2 class="mb-sm-0">Add New Lead</h2>
                                <div class="page-title-right">
                                    <a href="<?=base_url("admin/leads/all")?>"
                                        class="btn btn-success waves-effect waves-light">
                                        <i class=" fas fa-eye align-middle me-2"></i> View Leads
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
                                    <form class="needs-validation" method="post"
                                        action="<?=base_url('admin/leads/create')?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom01" class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name"
                                                        data-validation="required">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Mobile
                                                        No.</label>
                                                    <input type="number" class="form-control" name="mobile"
                                                        data-validation="required">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Service
                                                        Name</label>
                                                    <select class="form-select" name="course"
                                                        data-validation="required">
                                                        <option value="">Select Course</option>
                                                        <?php foreach($courses as $course){ ?>
                                                        <option value="<?=$course->name?>"><?=$course->name?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">City</label>
                                                    <input type="text" class="form-control" name="city"
                                                        data-validation="required">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Lead
                                                        Status</label>
                                                    <select name="lead_status" id="lead_status" class="form-select"
                                                        data-validation="required">
                                                        <option value="">Select Lead Status</option>
                                                        <option value="New">New</option>
                                                        <option value="Follow Up">Follow Up</option>
                                                        <option value="Not Interested">Not Interested</option>
                                                        <option value="Not Responding">Not Responding</option>
                                                        <option value="Price Issue">Price Issue</option>
                                                        <option value="Joined">Joined</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="leaddate" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Follow Up
                                                        Date</label>
                                                    <input type="text" name="followup_date"
                                                        class="form-control form-control-sm datepicker"
                                                        style="border:1px solid #ced4da;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Demo
                                                        Status</label>
                                                    <select name="demo_status" id="demo_status" class="form-select"
                                                        data-validation="required">
                                                        <option value="">Select Demo Status</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Scheduled">Scheduled</option>
                                                        <option value="Done">Done</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="demodate" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Demo
                                                        Date</label>
                                                    <div class="input-group date" id="id_1">
                                                        <input type="text" id="demo_date" name="demo_date"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="demotime" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Demo
                                                        Time</label>
                                                    <div class="input-group date" id="id_2">
                                                        <input type="text" id="demo_time" name="demo_time"
                                                            class="form-control" />
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-time fa fa-clock-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" id="sales" style="display:none;">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Assign to
                                                        Faculty</label>
                                                    <select name="sales" id="sales_select" class="form-select">
                                                        <option value="">Select Faculty</option>
                                                        <?php foreach($faculties as $faculty){ ?>
                                                        <option value="<?=$faculty->id?>">
                                                            <?=$faculty->name?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Source</label>
                                                    <select class="form-select" name="lead_source"
                                                        data-validation="required">
                                                        <option value="">Select Source</option>
                                                        <option value="Web Enquiry">Web Enquiry</option>
                                                        <option value="Just Dail">Just Dail </option>
                                                        <option value="Facebook">Facebook</option>
                                                        <option value="Call API">web incoming call</option>
                                                        <option value="Urban Pro">Urban Pro</option>
                                                        <option value="Live Chat">Live Chat</option>
                                                        <option value="Walkin">Walkin</option>
                                                        <option value="Reference">Reference</option>
                                                        <option value="PPC">PPC</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Assign to
                                                        TeleCaller</label>
                                                    <select class="form-select" name="assign_to"
                                                        data-validation="required">
                                                        <option value="">Select TeleCaller</option>
                                                        <?php foreach($telecallers as $telecaller){ ?>
                                                        <option value="<?=$telecaller->id?>"><?=$telecaller->name?>
                                                        </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom01" class="form-label">Comment</label>
                                                    <input type="text" class="form-control" name="comment"
                                                        data-validation="required">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-2">
                                            <input type="submit" name="submit" id="submit"
                                                class="btn btn-info w-100 waves-effect waves-light" value="Submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
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

    <!-- bs custom file input plugin -->
    <script src="<?=base_url()?>assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <script src="<?=base_url()?>assets/js/pages/form-element.init.js"></script>

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
            } else {
                $("#leaddate").hide();
            }
        });

        $('#demo_status').on('change', function() {

            if (this.value == 'Scheduled') {
                $("#demodate").show();
                $("#demotime").show();
                $("#sales").show();
            } else {
                $("#demodate").hide();
                $("#demotime").hide();
                $("#sales").hide();
            }
        });



    });
    </script>
</body>

</html>