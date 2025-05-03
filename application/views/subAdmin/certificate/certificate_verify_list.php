<?php $this->load->view('subAdmin/head'); ?>
 
<body>
    <div class="dashboard-page main_admin_cert">
      <div class="container">
        <div class="dashboard-main">
        <?php $this->load->view('subAdmin/menus'); ?>

          <div class="dashboard-main-ryt">
            <?php $this->load->view('subAdmin/header'); ?>
              <div class="dash-seections admin-dash_board">
                
                 
              <section class="dash-grev">
                  <div class="dash_cate_stg col-lg-4">
                  <a href="<?php echo base_url('admin_certificate_progess?type=In-Progress'); ?>"><p><span><?= $assign; ?></span>In Progress</p></a>
                  </div>
                  <div class="dash_cate_stg active col-lg-4">
                  <a href="<?php echo base_url('admin_certificate_verify?type=Fied-Verify'); ?>"><p><span><?= $verify; ?></span>Field Verified</p></a>
                  </div>
                   
                </section>

              
                <form action="<?php echo base_url('get_certificate_download'); ?>" method="post" id="download_list">
                        <div class="doc-search">
                            <div class="search-icon">
                                <input type="search" placeholder="Search" id="serach_item">
                            </div>
                            <div class="down-btns">
                                <button type="submit" class="custom-file-input"></button>    
                            </div>
                        </div>
                        <div class="doc-upload-table">
                            <div class="table-responsive">
                                <table id="search_table" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr style="height: 44px;">
                                            <th><input type="checkbox" id="tblHeading"> </th>
                                            <th>Name</th>
                                            <th>Aadhar No</th>
                                            <th>Date Of Submission</th>
                                            <th>Email </th>
                                            <th>Phone </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($kyc as $kyc_res){ ?>
                                        <tr>
                                            <td><input type="checkbox" class="tableRowSelect uncheckTop" name="certificate[]" value="<?php echo $kyc_res['cert_id']; ?>"></td>
                                            <td><a href="<?php echo base_url('admin_certificate_verify_details/'.$kyc_res['id'].'/'.$kyc_res['cert_id'].'?type='.$this->input->get('type')); ?>"><?=$kyc_res['name']; ?></a></td>
                                            <td><?=$kyc_res['adhaar_no']; ?></td>
                                            <td class="te-center"><?= date('M d Y', strtotime($kyc_res['created_at'])); ?></td>
                                            <td class="ey-icon"><?=$kyc_res['email']; ?></td>
                                            <td class="ey-icon">+91 <?=$kyc_res['phone']; ?></td>
                                        </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                             <?php echo $this->pagination->create_links(); ?>
                        </div>
                    </form>
                    </div>
          </div>
        </div>
        
    </div>

    <?php $this->load->view('subAdmin/footer'); ?>
      
   
</body>

</html>

<script>
    $(function() {
      $('.dashboardCls').removeClass('active');
      $('.certificateCls').addClass('active');
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