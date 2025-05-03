<?php $this->load->view('admin/head'); ?>

<body>
    <div class="dashboard-page unique">
      <div class="container">
        <div class="dashboard-main">
        <?php $this->load->view('admin/menus'); ?>

          <div class="dashboard-main-ryt">
            <?php $this->load->view('admin/header'); ?>
              <div class="dash-seections admin-dash_board">
                 
              
              <div class="doc-search">
                            <div class="search-icon">
                                <input type="search" placeholder="Search">
                            </div>
                            <div class="down-btns">
                                <button class="btn btn-danger" id="addDistrict">Add New District</button>
                            </div>
                        </div>
                        <div class="doc-upload-table">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr style="height: 44px;">
                                            <th> </th>
                                            <th>District Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($distric as $dist){ ?>
                                        <tr>
                                            <td></td>
                                            <td><?=$dist['name']; ?></td>
                                        </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>
                            </div>

                             <?php echo $this->pagination->create_links(); ?>

                            
                        </div>
                        </div>
          </div>
        </div>
        
    </div>

    <div class="status-popup dash-board-popup get-dist" id="districtPopup">
        <div class="container" style="width:auto;">
            <!-- <form method="post" enctype="multipart/form-data"> -->
                <div class="new-doc">
                    <h2>District Add</h2>
                    <a href=""><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="doc-sub">
                    <div class="doc-sub-form">
                        <label>District Name</label>
                        <input type="text" name="dist_name" id="dist_name">                           
                    </div>
                   
                     <br><br>
                    <div class="row">
                        <div class="col-lg-4">
                            <button type="button" class="btn btn-success" id="closePopup">Close</button>
                        </div>
                        <div class="col-lg-4">
                            <input name="button" id="addDistrictBtn" type="submit" value="Submit" />
                        </div>
                    </div>
                </div>
            <!-- </form> -->
        </div>
    </div>

    <?php $this->load->view('admin/footer'); ?>
      
   
</body>

</html>

<script type="text/javascript">
    $('#addDistrict').click(function() {
        $('.get-dist').show();
    });

    $('#closePopup').click(function() {
        $('.get-dist').hide();
    });
    </script>

      
<script>
    $(document).ready(function(){
        $(document).on('click','#addDistrictBtn', function(){
        var dist = $("#dist_name").val();
        
        if(dist == null || dist == '')
        {
          $.notify('Enter name',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        
        else
        {
            $ .ajax({
                url  : '<?php echo base_url('master_add_district');?>',
                type : 'POST',
                data : {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>','dist':dist},
                success : function(data)
                {
                    let res = $.parseJSON(data);
                    if(res.response=='1')
                    {
                        $('.status-popup').hide(500);
                        $.notify(res.message,{'className':'success','position':'top left','autoHideDelay': 1500});
                    }
                    else
                    {
                        $.notify(res.message,{'className':'danger','position':'top left','autoHideDelay': 1500});
                    }
                } 
            })
        }
        
    });
});     
</script>
 