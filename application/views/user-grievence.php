<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- favicon -->
  <link rel="shortcut icon" href="<?= base_url("assets/") ?>images/favicon.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />

  <!-- css includes -->
  <link rel="stylesheet" href="<?= base_url("assets/") ?>slick/slick.css">
  <link rel="stylesheet" href="<?= base_url("assets/") ?>slick/slick-theme.css">
  <link rel="stylesheet" href="<?= base_url("assets/") ?>css/styles.css">
  <link rel="stylesheet" href="<?= base_url("assets/") ?>css/responsive.css">
  <link href="<?= base_url("assets/") ?>css/theme-default.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Include the jQuery Validation Plugin -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
  <style>
    .error {
      color: red !important;
    }
  </style>
  <title><?= $title ?></title>
</head>

<body>
  <div class="dashboard-page grievance-page user_griev_ance">
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
          <span id="error"></span>
          <span id="success"></span>
          <div class="dash-seections doc-download">


            <div class="sort-filter">
              <a id="raise-grev" href="#"><img src="<?= base_url("assets/") ?>images/plus-icon.png" />Raise
                New
                Query</a>
              <strong>
                Sort By<img src="<?= base_url("assets/") ?>images/sort-icon.png" />
                <select name="sort_by" id="sort_by" class="sorting_by_cls">
                  <?php
                  $filter = array("All", "FMCG Launch Pad", "Application", "Certification", "Student Entrepreneurship", "Social Impact and Entrepreneurship", "Credit Linkage","Start-Up", "Market Linkage");
                  foreach ($filter as $key => $value) {
                    $selected = ($value == $this->input->get('filterBy')) ? 'selected' : '';
                    echo "<option value='" . $value . "' $selected>" . $value . "</option>";
                  }
                  ?>
                </select>
              </strong>
            </div>
            <div class="sort-sec-cord">
              <?php
               foreach ($grievanaces as $grievanace) {
                $file = $grievanace->file;
                if (!empty($file)) {
                  $imgFile = base_url($file);
                  $files = "<img src=" . base_url("assets/images/message-icon.png") . ">";
                  //  $files = "<img src='".$imgFile."' >"; 
                } else {
                  $files = '';
                }
              ?>
                <div class="sort-cords">

                  <h6>#<?= $grievanace->grievance_id ?> <span class="forum-pop" style="<?php if ($grievanace->status == 'Closed') {
                                                                                          echo 'display:none';
                                                                                        } ?>" id="forum-pop" tickect_num="<?= $grievanace->grievance_id ?>">
                      <img src="<?= base_url("assets/") ?>images/message-icon.png"></span></h6>
                  <p>Query Type: <span><?= $grievanace->query_type ?></span></p>
                  <p>Subject: <span><?= $grievanace->subject; ?></span></p>
                  <p>Date of Submission: <span> <?= date_time($grievanace->created_at) ?></span></p>
                  <p> <span><a href="<?php echo base_url($file); ?>" target="_blank"> <?= $files; ?></a></span></p>
                  <div class="onp">
                    <p style="cursor: pointer;" class="<?php if ($grievanace->status != 'Closed') {
                                                          echo 'get_status_model';
                                                        } ?>" tickect_num="<?= $grievanace->grievance_id; ?>"><?= $grievanace->status ?></p>
                    <strong tickect_num="<?= $grievanace->grievance_id; ?>" class="view_reports">View Report</strong>
                  </div>
                </div>
              <?php } ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---------New Grievance addedd ----------->
  <div class="grev-raise_pop">
    <div class="container">
      <div class="new-doc">
        <h2>Submit a ticket</h2>
        <a href=""><i class="fa-solid fa-x"></i></a>
      </div>
      <form action="<?php echo base_url() ?>user/create_query" id="openticket" method="POST" class="needs-validation" enctype="multipart/form-data">
        <div class="doc-sub">
          <div class="doc-sub-form">
            <label>Query Type</label>
            <select name="query_type" id="query_type">
              <option value="">Select Query Type</option>
              <option value="Certification">Certification</option>
              <option value="FMCG Launch Pad">FMCG Launch Pad</option>
              <option value="Student Entrepreneurship">Student Entrepreneurship</option>
              <option value="Social Impact and Entrepreneurship">Social Impact and Entrepreneurship</option>
              <option value="Credit Linkage">Credit Linkage</option>
              <option value="Market Linkage">Market Linkage</option>
              <option value="Start-Up">Start-Up</option>
              <option value="Application">Application</option>
            </select>
          </div>
          <div class="doc-sub-form" id="sub">
            <label>Sub Query Type</label>
            <select id="Sub_query_type" name="Sub_query_type">
              <option value="">Select Sub Query Type</option>
            </select>
          </div>
          <span id="err"></span>
          <div class="doc-sub-form">
            <label>File</label>
            <input name="file" id="file" type="file" class="custom-file-input" style="width:auto;" accept="application/pdf,image/jpeg">
          </div>
          <div class="doc-sub-form">
            <label>Description</label>
            <textarea name="content" id="content" data-validation="required" rows="3"></textarea>
          </div>
          <input type="submit" id="submitbtn1" value="Submit"></input>
        </div>
      </form>
    </div>
  </div>
  <!--------- Grievance chatting popup ----------->
  <div class="query-forum gre-cht-form">
    <div class="container">
      <div class="new-doc">
        <h2>Query Forum</h2>
        <a href=""><i class="fa-solid fa-x"></i></a>
      </div>
      <div class="query-form">
        <div id="chatDivSec">
        </div>
        <!-- <?= base_url("user/ticket_query") ?> -->
        <form action="" id="ticket_query" method="post" enctype="multipart/form-data">
          <div class="cht-submit">
            <input type="hidden" name="ticketId" id="ticketId" />
            <div class="image-upload-chat" style="margin-right: 10px;">
              <label for="file-input"><img src="<?= base_url("assets/") ?>images/attachment-icon.png" /></label>
              <input type="file" name="fileInsert" id="file-input">
            </div>
            <textarea class="input-control" name="queryDetails" id="queryDetails" style="height: 50px;"></textarea>
            <a class="cht-experience document-download-btn" href="#"><img src="<?= base_url("assets/") ?>images/new-download-icon.png" /></a>
            <input type="submit" value="Submit" name="submit" />
            <div></div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--------- Grievance ratting popup ----------->
  <div class="experience-con chat_status_div" id="">
    <div class="new-doc">
      <a href=""><i class="fa-solid fa-x"></i></a>
    </div>
    <h5>How was your conversation experience with us?</h5>
    <p>Your feedback will help us serve you better</p>
    <div class="like-btns">
      <input type="hidden" id="tckt_num">
      <div>
        <img src="<?= base_url("assets/") ?>images/like-icon.jpg" id="grievance_update_status" />
      </div>
      <div>
        <a href="#"><img src="<?= base_url("assets/") ?>images/dis-like.jpg" /></a>
      </div>
    </div>
    <a href="#">SKIP THIS STEP</a>
  </div>


  <!--------- Grievance status updates ----------->
  <div class="experience-con chat_status_modal" id="">
    <div class="new-doc">
      <a href="">X</a>
    </div>
    <h5>Update Query Status</h5>
    <form id="openticket_close" method="post" enctype="multipart/form-data">
      <input type="hidden" class="tckt_num">
      <div class="doc-sub">
        <div class="doc-sub-form">
          <select name="status_type" id="status_type" data-validation="required">
            <option value="Closed">Closed</option>
            <option value="Review">Review</option>
          </select>
        </div>
        <input type="button" id="grievance_update_status" value="Submit" />
      </div>
    </form>
  </div>

  <!--------- Grievance reports ----------->
  <div class="dash-board-popup get_report_modal">
    <div class="container" style="width: auto;">
      <div class="new-doc">
        <h2>Query Report</h2>
        <a href="">X</a>
      </div>
      <div class="query-form">
        <div id="chatDivSecReports">
        </div>
      </div>
    </div>
  </div>


  <script src="https://kit.fontawesome.com/28d7e4550d.js" crossorigin="anonymous"></script>
  <script src="<?= base_url("assets/") ?>js/jquery-3.6.0.min.js"></script>
  <script src="<?= base_url("assets/") ?>slick/slick.min.js"></script>
  <script src="<?= base_url("assets/") ?>js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


  <script>
    $('#raise-grev').click(function() {
      $('.grev-raise_pop').show(500);
    });
    $(document).ready(function() {
      $('.alert .close').on('click', function() {
        $(this).parent().fadeOut();
      });
    });
    //  $('.alert-dismissible').hide(500);
    // $('.forum-pop').click(function() {
    //     $('.query-forum').show(500);
    // });
    setTimeout(function() {
      $('.alert-dismissible').hide('fast');
    }, 300);
    $('.cht-experience').click(function() {
      $('.chat_status_div').show(500);
      $('.query-forum').hide(500);
    });

    $('#ad-document').click(function() {
      $('.dash-board-popup').show(500);
    });

    $('.experience-con a').click(function() {
      $('.chat_status_div').hide(500);
    });
  </script>


  <script src="<?= base_url("assets/") ?>js/jquery.form-validator.js"></script>

  <script>
    // $(function() {
    //   // setup validate
    //   $.validate();
    // });
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  <script src="<?php echo base_url('assets/js/notify.min.js'); ?>"></script>

  <?php $this->load->view('user-footer'); ?>
</body>

</html>
<script>
  $(document).ready(function() {
    $('#file').on('change', function() {
      var allowedFormats = ['jpg', 'pdf'];

      var selectedFile = this.files[0];
      if (selectedFile) {
        var fileName = selectedFile.name;
        var fileExtension = fileName.split('.').pop().toLowerCase();

        if (allowedFormats.indexOf(fileExtension) === -1) {
          $('#errorText').text('Invalid file format. Allowed formats: ' + allowedFormats.join(', '));
          $('#fileInput').val('');
          return false;
        } else {
          $('#errorText').text('');
        }
      }
    });
  });
</script>


<script>
  $(document).ready(function() {
    $("#openticket").validate({
      rules: {
        query_type: "required",
        content: {
          required: true,
          maxlength: 1000,
        },
      },
      messages: {
        query_type: "Please select a query type",
        content: "Please provide a description"
      },
      submitHandler: function(form) {
        event.preventDefault();

        var formData = new FormData(form);

        $.ajax({
          url: form.action,
          type: form.method,
          data: formData,
          contentType: false,
          processData: false,
          success: function(response) {
            var res = JSON.parse(response);

            console.log(res.message);
            if (res.status === 'success') {
              alert(res.message);
              // $('#success').html(res.message);
              // $('#success').css('color','red');
              // $("#success").css({
              //   color: 'red',
              //   top: 200,
              //   left: 200,
              //   position: 'absolute'
              // });

              window.location.href = '<?php echo base_url() ?>user/grievance';
            } else {
              // $('#success').html();
              alert(res.message);
              // $('#error').html(res.message);
              // $("#error").css({
              //   fontSize: 20,
              //   color: 'red',
              //   top: 220,
              //   left: 200,
              //   position: 'absolute'
              // });

              return false;
            }
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }
    });
  });


  $(document).ready(function() {
    var subQuerySection = $('#sub');
    $('#openticket').submit(function(e) {
      e.preventDefault();
    });

    $('select[name="Sub_query_type"]').prop('disabled', true);
    var subQueryDropdown = $('select[name="Sub_query_type"]');
    subQueryDropdown.empty();

    $('select[name="query_type"]').on('change', function() {
      var query_type = $(this).val();
      if (query_type === "") {
        subQuerySection.hide();
        subQueryDropdown.empty();
      } else {
        $('select[name="Sub_query_type"]').prop('disabled', false);
        subQueryDropdown.empty();
        $.ajax({
          url: '<?php echo base_url() ?>user/get_sub_query_types',
          type: "POST",
          dataType: "json",
          data: {
            Id: query_type
          },
          success: function(response) {
            console.log(response);
            if (response && response.length > 0) {
              $.each(response, function(key, value) {
                subQueryDropdown.append('<option value="' + value.name + '">' + value.name + '</option>');
              });
              subQuerySection.show();
            } else {
              subQuerySection.hide();
            }
          },
          error: function(xhr, status, error) {
            console.log("Error:", error);
          }
        });
      }
    });
  });


  $(document).ready(function() {
    setTimeout(function() {
      $(".alert-dismissible").fadeOut("slow", function() {
        $(this).remove();
      });
    }, 30000);
  });

  $(document).ready(function() {
    $(document).on('click', '.get_status_model', function() {
      var ticket = $(this).attr("tickect_num");
      $(".tckt_num").val(ticket);
      if (ticket == null || ticket == '') {
        $.notify('Invalid request', {
          'className': 'danger',
          'position': 'top left',
          'autoHideDelay': 1500
        });
        return false;
      } else {
        $(".chat_status_modal").show();
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $(document).on('click', '#grievance_update_status', function() {
      var ticket = $(".tckt_num").val();
      // $.notify();
      var status_type = $("#status_type").val();
      if (ticket == null || ticket == '') {
        $.notify('Invalid request', {
          'className': 'danger',
          'position': 'top left',
          'autoHideDelay': 1500
        });
        return false;
      }
      if (status_type == null || status_type == '') {
        $.notify('Select status', {
          'className': 'danger',
          'position': 'top left',
          'autoHideDelay': 1500
        });
        return false;
      } else {
        $.ajax({
          url: '<?php echo base_url('user_grievance_sts_update'); ?>',
          type: 'POST',
          data: {
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
            'ticket': ticket,
            'status_type': status_type
          },
          success: function(data) {
            let res = $.parseJSON(data);
            if (res.response == '1') {
              $(".chat_status_modal").hide();
              $.notify(res.message, {
                'className': 'success',
                'position': 'top left',
                'autoHideDelay': 1500
              });
              window.location.reload();
            } else {
              $.notify(res.message, {
                'className': 'danger',
                'position': 'top left',
                'autoHideDelay': 1500
              });
              window.location.reload();
            }
          }
        })
      }
    });
  });
</script>


<script>
  $(document).ready(function() {
    $(document).on('click', '.view_reports', function() {
      var ticket = $(this).attr("tickect_num");
      if (ticket == null || ticket == '') {
        $.notify('Invalid request', {
          'className': 'danger',
          'position': 'top left',
          'autoHideDelay': 1500
        });
        return false;
      } else {
        $.ajax({
          url: '<?php echo base_url('get_chat_list'); ?>',
          type: 'POST',
          data: {
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
            'ticket': ticket
          },
          success: function(data) {
            let res = $.parseJSON(data);
            if (res.response == '1') {
              $('.get_report_modal').show(500);
              $("#chatDivSecReports").html(res.chat);
              $.notify(res.message, {
                'className': 'success',
                'position': 'top left',
                'autoHideDelay': 1500
              });
            } else {
              $('.get_report_modal').hide(500);
              $("#chatDivSecReports").html('');
              $.notify(res.message, {
                'className': 'danger',
                'position': 'top left',
                'autoHideDelay': 1500
              });
            }
          }
        })
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $(document).on('change', '#sort_by', function() {
      var filterVal = $(this).val();
      if (filterVal == 'All') {
        window.location.href = '<?php echo base_url('user/grievance'); ?>';
      } else {
        window.location.href = '<?php echo base_url('user/grievance?filterBy='); ?>' + filterVal;
      }
    });
  });
</script>