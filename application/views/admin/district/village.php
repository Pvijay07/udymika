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
                                <button class="btn btn-danger adar-download" id="addDistrict"><span><img src="<?php echo base_url('assets/images/download-btn.png');?>" class="downloadBtnCls"></span><span class="downloadText">Add Grampanchayat</span></button>
                            </div>
                        </div>
                        <div class="doc-upload-table">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr style="height: 44px;">
                                            <th> </th>
                                            <th>District Name</th>
                                            <th>Manadal Name</th>
                                            <th>Grampanchayat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($panchayat as $panc){ ?>
                                        <tr>
                                            <td></td>
                                            <td><?=$panc['dist_name']; ?></td>
                                            <td><?=$panc['mandal_name']; ?></td>
                                            <td><?=$panc['name']; ?></td>
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
                    <h2>Manadal Add</h2>
                    <a href=""><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="doc-sub">
                    <div class="doc-sub-form">
                        <label>Select District</label>
                        <select name="dist_name" id="dist_name">
                            <?php
                            if($district){
                                foreach ($district as $dist) {
                                    echo "<option value='".$dist['id']."'>".$dist['name']."</option>";
                                }
                            }
                            ?>
                            
                        </select>
                    </div>
                    <div class="doc-sub-form">
                        <label>Select Mandal</label>
                        <select name="mandal_name" id="mandal_name">
                            <?php
                            if($district){
                                foreach ($district as $dist) {
                                    echo "<option value='".$dist['id']."'>".$dist['name']."</option>";
                                }
                            }
                            ?>
                            
                        </select>
                    </div>
                    <div class="doc-sub-form">
                        <label>Panchayat Name</label>
                        <input type="text" name="panchayat_name" id="panchayat_name">                           
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
        var mandal = $("#mandal_name").val();
        var vilage = $("#panchayat_name").val();
        
        if(dist == null || dist == '')
        {
          $.notify('Select dist',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else if(mandal == null || mandal == '')
        {
          $.notify('Select mandal name',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else if(vilage == null || vilage == '')
        {
          $.notify('Enter gram panchayat',{'className':'danger','position':'top left','autoHideDelay': 1500});
          return false;
        }
        else
        {
            $ .ajax({
                url  : '<?php echo base_url('master_add_panchayat');?>',
                type : 'POST',
                data : {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>','dist':dist,'mandal':mandal,'vilage':vilage},
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
 