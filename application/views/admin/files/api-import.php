<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>API Import | Petsfolio Leads</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="<?=base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?=base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

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
                                    <h2 class="mb-sm-0">Import Api</h2>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        <?php
                        $services = array('703'=>'Contact', 
                                            '1160'=>'Protection Dog', 
                                            '1159'=>'Dog Behavior', 
                                            '23'=>'Dog Training',
                                            '24'=>'Dog Walking',
                                            '25' => 'Grooming',
                                            '26' => 'Pets Hostel',
                                            '27' => 'Vet on Wheels',
                                            '1122' => 'Dog Obedience',
                                            '126' => 'Services',
                                            '1124' => 'Pre Puppy Consultation',
                                            '1179' => 'Group Training');
                        ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <?php $this->load->view('admin/includes/_messages.php') ?>
                                    <form method="post" action="<?php echo base_url('admin/leads/import'); ?>">
                                        <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Select Date Range</label>
                                            <div class="col-sm-10">
                                                <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                                    <input type="text" class="form-control" name="start" value="<?php echo date("Y-m-d"); ?>" placeholder="Start Date" autocomplete="off" />
                                                    <input type="text" class="form-control" name="end" value="<?php echo date("Y-m-d"); ?>" placeholder="End Date" autocomplete="off" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end row -->

                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Select Service</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" name="service" require>
                                                    <option value="">-- Select Service --</option>
                                                    <?php foreach($services as $key => $value){ ?>
                                                    <option value="<?=$key?>"><?=$value?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                                                              
                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label"></label>
                                            <div class="col-sm-2">
                                            <input type="submit" name="submit" id="submit" class="btn btn-info w-100 waves-effect waves-light" value="Submit">
                                            </div>
                                        </div>
                                        <!-- end row -->
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
        <script src="<?=base_url()?>assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

        <!-- bs custom file input plugin -->
        <script src="<?=base_url()?>assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>

        <script src="<?=base_url()?>assets/js/pages/form-element.init.js"></script>
        <script src="<?=base_url()?>assets/js/pages/form-advanced.init.js"></script>
        <script src="<?=base_url()?>assets/js/app.js"></script>

    </body>
</html>
