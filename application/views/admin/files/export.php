<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?=$title?> | AWA Leads</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico">

    <!-- DataTables -->
    <link href="<?=base_url()?>assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="<?=base_url()?>assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css"
        rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?=base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="<?=base_url()?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <style>
    .order-card h6,
    .order-card h2 {
        color: #fff;
    }

    .bg-c-red {
        background: #FF0000;
    }

    .bg-c-blue {
        background: #0975C8;
    }

    .bg-c-yellow {
        background: #D4CE1D;
    }

    .bg-c-green {
        background: #00FF00;
    }

    .bg-c-black {
        background: #000;
    }

    .bg-c-dark-green {
        background: #023020;
    }

    .bg-c-merun {
        background: #800000;
    }

    .bg-c-pink {
        background: #C502A3;
    }


    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .card .card-block {
        padding: 25px;
    }

    .order-card i {
        font-size: 26px;
    }

    .f-left {
        float: left;
    }

    .f-right {
        float: right;
    }
    </style>
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


                    <div class="row" style="margin-top: 40px; margin-bottom:160px;">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="<?=base_url("admin/export/download")?>">
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control" placeholder="From Date"
                                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2'
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="<?=date("Y-m-d")?>" name="from_date" autocomplete="off">

                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control" placeholder="To Date"
                                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2'
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="<?=date("Y-m-d")?>" name="to_date" autocomplete="off">

                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>

                                            <div class="col-sm-2">
                                                <select class="form-select" name="service">
                                                    <option value="">-- All Courses --</option>
                                                    <?php foreach($courses as $course){ ?>
                                                    <option value="<?=$course->name?>"><?=$course->name?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <select class="form-select" name="city">
                                                    <option value="">All Cities</option>
                                                    <?php foreach($cities as $city){ ?>
                                                    <option value="<?=$city->city?>"><?=$city->city?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <select name="status" class="form-select">
                                                    <option value="">-- All Status --</option>
                                                    <option value="New">New</option>
                                                    <option value="Follow Up">Follow Up</option>
                                                    <option value="Not Interested">Not Interested</option>
                                                    <option value="Not Responding">Not Responding</option>
                                                    <option value="Price Issue">Price Issue</option>
                                                    <option value="Joined">Joined</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <input type="submit" name="submit" id="submit"
                                                    class="btn btn-info w-100 waves-effect waves-light" value="Search">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                    </form>
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>

                </div>

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

    <!-- Responsive examples -->
    <script src="<?=base_url()?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url()?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="<?=base_url()?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?=base_url()?>assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="<?=base_url()?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <!-- apexcharts -->
    <script src="<?=base_url()?>assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- apexcharts init -->
    <script src="<?=base_url()?>assets/js/pages/apexcharts.init.js"></script>

    <script src="<?=base_url()?>assets/js/pages/dashboard.init.js"></script>

    <script src="<?=base_url()?>assets/js/app.js"></script>


</body>

</html>