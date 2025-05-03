<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Profile | Petsfolio Leads</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=base_url()?>assets/images/favicon.ico">

        <!-- Bootstrap Css -->
        <link href="<?=base_url()?>assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?=base_url()?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?=base_url()?>assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

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
                                    <h2 class="mb-sm-0">Change Password</h2>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <?php $this->load->view('admin/includes/_messages.php') ?>
                                    <form method="post" action="<?php echo base_url('admin/profile/change_pwd'); ?>">
                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">New Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="password" name="password">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <div class="row mb-3">
                                            <label for="example-search-input" class="col-sm-2 col-form-label">Confirm Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="password" name="confirm_pwd">
                                            </div>
                                        </div>
                                        <!-- end row -->
                                       
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

        <!-- bs custom file input plugin -->
        <script src="<?=base_url()?>assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>

        <script src="<?=base_url()?>assets/js/pages/form-element.init.js"></script>

        <script src="<?=base_url()?>assets/js/app.js"></script>

    </body>
</html>
