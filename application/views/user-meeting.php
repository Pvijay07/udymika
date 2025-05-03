<!doctype html>
<html lang="en"> 

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <!-- favicon -->
    <link rel="shortcut icon" href="<?=base_url("assets/")?>images/favicon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- css includes -->
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>slick/slick-theme.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/styles.css">
    <link rel="stylesheet" href="<?=base_url("assets/")?>css/responsive.css">
    <link href="<?=base_url("assets/")?>css/theme-default.css" rel="stylesheet" />
    <title><?=$title?></title>
</head>

<body>
    <div class="dashboard-page user__meeting">
        <div class="container">
            <div class="dashboard-main">
                <?php $this->load->view("includes/user-menu.php"); ?>


                <div class="dashboard-main-ryt">
                    <?php $this->load->view("includes/header.php"); ?>
                    <div class="mob-menu-bar">
                        <img src="https://xhtmlreviews.com/udyam/assets/images/main-logo.png" alt="logo">
                        <a id="menu-button" href="#">
                          <span></span>
                          <span></span>
                          <span></span>
                        </a>
                    </div>
                    <div class="dash-seections doc-download">

                        <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong><?php echo $this->session->flashdata('error'); ?></strong>
                        </div>
                        <?php endif; ?>

                        <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <strong><?php echo $this->session->flashdata('success'); ?></strong>
                        </div>
                        <?php endif; ?>

                        <div class="doc-search">
                            <div class="search-icon">
                                <input type="search" placeholder="Search" id="serach_item">
                            </div>
                            <div class="down-btns">
                                <!--<p>Download all</p>-->
                                <!-- <button id="ad-document" type="submit" class="custom-file-input down-pop_up"></button> -->
                            </div>
                        </div>
                        <div class="doc-upload-table">
                            <div class="table-responsive">
                                <table id="search_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr style="height: 44px;">
                                            <th style="width:32px"><input type="checkbox" id="tblHeading"></th>
                                            <th style="width:743px">Meeting Type</th>
                                            <th style="width:456px">Date</th>
                                            <th style="width:156px;">From</th>
                                            <th style="width:156px;">To</th>
                                            <th style="width:506px;">Link</th>
                                            <!--<th style="width:256px;">Details</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($meeting as $docs){ ?>
                                        <tr>
                                            <td><input type="checkbox" class="tableRowSelect uncheckTop" name="certificate[]" value="<?php echo $docs->sm_id; ?>"></td>
                                            <td><?=$docs->meetingType?></td>
                                            <td class="te-center"><?=$docs->meetingDate?></td>
                                            <td style="width:185px;"><?=date('h:i:s a', strtotime($docs->timeFrom)); ?></td>
                                            <td style="width:185px;"><?=date('h:i:s a', strtotime($docs->timeTo));?></td>
                                            <td><a href="<?=$docs->linkDetail?>"><?=$docs->linkDetail?></a></td>
                                            <!--<td><?=$docs->meetingDetails?></td>-->
                                        </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>
                            <?php echo $this->pagination->create_links(); ?>

                            <!-- <div class="table-paginations">
                                <a href="#"><img src="<?=base_url("assets/")?>images/left-arrow.png">Previous</a>
                                <ul>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                </ul>
                                <a href="#">Next <img src="<?=base_url("assets/")?>images/right-arrow.png"></a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dash-board-popup">
        <div class="container" style="width: auto;">
            <form action="<?=base_url("user/upload")?>" method="post" enctype="multipart/form-data">
                <div class="new-doc">
                    <h2>Add New Document</h2>
                    <a href=""><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="doc-sub">
                    <div class="doc-sub-form">
                        <label>Document Name</label>
                        <input name="document_name" type="text" placeholder="Document Name"
                            data-validation="required" />
                    </div>
                    <div class="doc-sub-form">
                        <label>File</label>
                        <input name="document" type="file" class="custom-file-input" data-validation="required" />
                    </div>
                    <input name="submit" type="submit" value="Submit" />
                </div>
            </form>
        </div>
    </div>


    <script src="https://kit.fontawesome.com/28d7e4550d.js" crossorigin="anonymous"></script>
    <script src="<?=base_url("assets/")?>js/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url("assets/")?>slick/slick.min.js"></script>

    <script type="text/javascript">
    $('#ad-document').click(function() {
        $('.dash-board-popup').show(500);
    });

    $('.experience-con a').click(function() {
        $('.experience-con').hide(500);
    });
    </script>

    <script src="<?=base_url("assets/")?>js/jquery.form-validator.js"></script>

    <script>
    $(function() {
        $.validate();
    });
    </script>

<script>
    $('#tblHeading').click(function(event) {
          if (this.checked) {
              $('.tableRowSelect').each(function() {
                  this.checked=true;
              });
          } else {
              $('.tableRowSelect').each(function(){
                  this.checked=false;
              });
          }
      });
</script>

<script>
    $('.uncheckTop').click(function(event) {
        $('#tblHeading').each(function(){
                  this.checked=false;
              });
      });
</script>
<script>
    $("#download_list").attr('autocomplete', 'off');
	    $("#download_list").on('submit',function(){
            var checkboxes =  document.getElementsByName('certificate[]');
            var result = "";
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    result += checkboxes[i].value 
                        + " " + " Laptop, ";
                }
            }
            if(result.length == '0' || result.length == '' || result.length == null || result.length == undefined)
            {
                $.notify("Select row in from table",{'className': 'danger', 'position': 'top left','autoHideDelay': 1500});
                return false;
            }
           
    });
    </script>
    <script>
        $("#serach_item").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#search_table > tbody > tr").filter(function() 
            {  
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
     <?php $this->load->view('user-footer'); ?>
</body>

</html>