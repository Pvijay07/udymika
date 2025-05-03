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

    <link href="<?=base_url()?>assets/plugins/datetimepicker/css/classic.css" rel="stylesheet" />
    <link href="<?=base_url()?>assets/plugins/datetimepicker/css/classic.date.css" rel="stylesheet" />
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
                                <h2 class="mb-sm-0">Add New User</h2>
                                <div class="page-title-right">
                                    <a href="<?=base_url("admin/users/")?>"
                                        class="btn btn-success waves-effect waves-light">
                                        <i class=" fas fa-eye align-middle me-2"></i> View Users
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
                                        action="<?=base_url('admin/users/add')?>">
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
                                                    <input type="email" class="form-control" name="email"
                                                        data-validation="email">
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
                                                    <label for="validationCustom02" class="form-label">Usertype</label>
                                                    <select name="usertype" class="form-select"
                                                        data-validation="required">
                                                        <option value="">Select Usertype</option>
                                                        <option value="Admin">Admin</option>
                                                        <option value="Manager">Manager</option>
                                                        <option value="Telecaller">Telecaller</option>
                                                        <option value="Faculty">Faculty</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Password.</label>
                                                    <input type="password" class="form-control" name="password"
                                                        data-validation="length" data-validation-length="min6">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="validationCustom02" class="form-label">Status</label>
                                                    <select name="status" id="lead_status" class="form-select"
                                                        data-validation="required">
                                                        <option value="">Select Status</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
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
    <script src="<?=base_url()?>assets/plugins/datetimepicker/js/picker.js"></script>
    <script src="<?=base_url()?>assets/plugins/datetimepicker/js/picker.date.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.form-validator.js"></script>

    <script>
    $.validate({
        modules: 'date, security'
    });
    </script>

    <script type="text/javascript">
    $(function() {

        "use strict";

        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: true,
            format: 'yyyy-mm-dd'
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



    });
    </script>
</body>

</html>