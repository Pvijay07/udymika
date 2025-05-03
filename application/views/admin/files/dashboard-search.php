<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title><?=$title?> | Petsfolio Leads</title>

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


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="<?=base_url("admin/dashboard")?>">
                                        <div class="row mb-3">
                                            <div class="col-sm-2">
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control" placeholder="From Date"
                                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2'
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="<?=$search_from?>" name="from_date">

                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="input-group" id="datepicker2">
                                                    <input type="text" class="form-control" placeholder="To Date"
                                                        data-date-format="yyyy-mm-dd" data-date-container='#datepicker2'
                                                        data-provide="datepicker" data-date-autoclose="true"
                                                        value="<?=$search_to?>" name="to_date">

                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span>
                                                </div><!-- input-group -->
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-select" name="service">
                                                    <option value=" "
                                                        <?php if($search_service == "") echo 'selected'; ?>>
                                                        All Courses</option>
                                                    <?php foreach($courses as $course){ ?>
                                                    <option value="<?=$course->name?>"
                                                        <?php if($search_service == $course->name) echo 'selected'; ?>>
                                                        <?=$course->name?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-select" name="city">
                                                    <option value=" " <?php if($search_city == "") echo 'selected'; ?>>
                                                        All Cities</option>
                                                    <?php foreach($cities as $city){ ?>
                                                    <option value="<?=$city->city?>"
                                                        <?php if($search_city == $city->city) echo 'selected'; ?>>
                                                        <?=$city->city?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <select class="form-select" name="user">
                                                    <?php if($this->session->userdata("user_type") == "Admin" || $this->session->userdata("user_type") == "Manager"){ ?>
                                                    <option value=" " <?php if($search_user == "") echo 'selected'; ?>>
                                                        All Employees</option>
                                                    <?php } ?>

                                                    <?php foreach($users as $user){ ?>
                                                    <option value="<?=$user->id?>"
                                                        <?php if($user->id == $search_user) echo 'selected'; ?>>
                                                        <?=$user->name?></option>
                                                    <?php } ?>
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

                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-pink order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Leads</h6>
                                    <h2 class="text-right"><i class=" fas fa-check-circle f-left"></i>
                                        <span><?=$total_leads?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-red order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Unattended</h6>
                                    <h2 class="text-right"><i class=" fas fa-check-circle f-left"></i>
                                        <span><?=$total_unattended?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-blue order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Follow Ups</h6>
                                    <h2 class="text-right"><i class=" fas fa-check-circle f-left"></i>
                                        <span><?=$total_followups?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Total Appointments</h6>
                                    <h2 class="text-right"><i class=" fas fa-check-circle f-left"></i>
                                        <span><?=$total_demos?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-black order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Not Interested</h6>
                                    <h2 class="text-right"><i class=" fas fa-check-circle f-left"></i>
                                        <span><?=$total_notinterested?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-yellow order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Not Responding</h6>
                                    <h2 class="text-right"><i class=" fas fa-check-circle f-left"></i>
                                        <span><?=$total_notresponding?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-merun order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Price Issue</h6>
                                    <h2 class="text-right"><i class=" fas fa-check-circle f-left"></i>
                                        <span><?=$total_price?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <div class="card bg-c-dark-green order-card">
                                <div class="card-block">
                                    <h6 class="m-b-20">Joined</h6>
                                    <h2 class="text-right"><i class=" fas fa-check-circle f-left"></i> <span>
                                            <?=$total_joined?></span>
                                    </h2>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Statistics by Leads</h4>

                                    <div id="pie_chart" class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Statistics by Sources</h4>

                                    <div id="bar_chart" class="apex-charts" dir="ltr"></div>
                                </div>
                            </div>
                            <!--end card-->
                        </div>
                    </div>
                    <!-- end row -->

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
    <!-- apexcharts -->
    <script src="<?=base_url()?>assets/libs/apexcharts/apexcharts.min.js"></script>
    <!-- apexcharts init -->
    <script src="<?=base_url()?>assets/js/pages/apexcharts.init.js"></script>

    <!-- Responsive examples -->
    <script src="<?=base_url()?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?=base_url()?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script src="<?=base_url()?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="<?=base_url()?>assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="<?=base_url()?>assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>

    <script src="<?=base_url()?>assets/js/pages/dashboard.init.js"></script>

    <script src="<?=base_url()?>assets/js/app.js"></script>

    <script>
    options = {
        chart: {
            height: 320,
            type: "pie"
        },
        series: [<?=$total_unattended?>, <?=$total_followups?>, <?=$total_demos?>, <?=$total_notinterested?>,
            <?=$total_notresponding?>, <?=$total_price?>, <?=$total_joined?>
        ],
        labels: ["Unattended", "Follow Ups", "Appointments", "Not Interested", "Not Responding", "Price Issue",
            "Joined"
        ],
        colors: ["#FF0000", "#0975C8", "#00FF00", "#000", "#D4CE1D", "#800000", "#023020"],
        legend: {
            show: !0,
            position: "bottom",
            horizontalAlign: "center",
            verticalAlign: "middle",
            floating: !1,
            fontSize: "14px",
            offsetX: 0,
            offsetY: 5
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    height: 240
                },
                legend: {
                    show: !1
                }
            }
        }]
    };
    (chart = new ApexCharts(document.querySelector("#pie_chart"), options)).render();


    options = {
        chart: {
            height: 350,
            type: "bar",
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            bar: {
                horizontal: !0
            }
        },
        dataLabels: {
            enabled: !1
        },
        series: [{
            data: [<?=$source_val?>]
        }],
        colors: ["#1cbb8c"],
        grid: {
            borderColor: "#f1f1f1",
            padding: {
                bottom: 5
            }
        },
        xaxis: {
            categories: [<?=$sources?>]
        },
        legend: {
            offsetY: 5
        }
    };
    (chart = new ApexCharts(document.querySelector("#bar_chart"), options)).render();
    </script>

</body>

</html>