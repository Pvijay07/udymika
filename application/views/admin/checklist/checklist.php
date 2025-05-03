<?php $this->load->view('admin/head'); ?>

<body>
    <div class="dashboard-page admin_nine">
      <div class="container">
        <div class="dashboard-main">
        <?php $this->load->view('admin/menus'); ?>

          <div class="dashboard-main-ryt">
            <?php $this->load->view('admin/header'); ?>
             <div class="mob-menu-bar">
                    <img src="https://xhtmlreviews.com/udyam/assets/images/main-logo.png" alt="logo">
                    <a id='menu-button' href="#">
                      <span></span>
                      <span></span>
                      <span></span>
                    </a> 
                 </div>
              <div class="dash-seections admin-dash_board">
                
                 
                 
              <!-- <section>
                <div class="row">
                   
                  <div class="col-lg-9"></div>
                  <div class="col-lg-3">
                    <div class="btn_setting">
                      <button class="subAdminStg addChecklist">Create new checklist</button>
                    </div>
                  </div>
                </div>
                </section> -->
                        <div class="doc-upload-table tmt">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr style="height: 44px;">
                                             <th>Name</th>
                                            <th style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($kyc as $kyc_res){ ?>
                                        <tr>
                                            <td><?=$kyc_res['checklist_name']; ?></td>
                                            <td class="icon">
                                            <img src="<?php echo base_url('assets/images/eye--icon.png'); ?>" id="viewCheckList" checklist="<?=$kyc_res['cl_id']; ?>" typeName="<?=$kyc_res['checklist_name']; ?>" class="viewCheckList"></img>
                                            <button class="btn_normal user_del"  id="deleteCheckList" checklist="<?=$kyc_res['cl_id']; ?>">
                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.5 4.99984H4.16667M4.16667 4.99984H17.5M4.16667 4.99984V16.6665C4.16667 17.1085 4.34226 17.5325 4.65482 17.845C4.96738 18.1576 5.39131 18.3332 5.83333 18.3332H14.1667C14.6087 18.3332 15.0326 18.1576 15.3452 17.845C15.6577 17.5325 15.8333 17.1085 15.8333 16.6665V4.99984H4.16667ZM6.66667 4.99984V3.33317C6.66667 2.89114 6.84226 2.46722 7.15482 2.15466C7.46738 1.8421 7.89131 1.6665 8.33333 1.6665H11.6667C12.1087 1.6665 12.5326 1.8421 12.8452 2.15466C13.1577 2.46722 13.3333 2.89114 13.3333 3.33317V4.99984M8.33333 9.1665V14.1665M11.6667 9.1665V14.1665" stroke="#667085" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </button>
                                        </td> 

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

    

    <div class="get-details dash-board-popup" id="checklistPopup">
        <div class="container" style="width:auto;">
            <form action="<?=base_url("user/upload")?>" method="post" enctype="multipart/form-data">
                <div class="new-doc">
                    <h2><span  id="chkListHdg"></span> <span class="closePopCls" id="closePopup">X</span></h2>
                    <a href=""><i class="fa-solid fa-x"></i></a>
                </div>
                <div class="doc-sub">
                    <div id="checklistDivDisp">
                         
                    </div>        
                                         
                </div>
            </form>
        </div>
    </div>
   

    <div class="get-details dash-board-popup" id="checklistAddPopup">
        <div class="container" style="width:auto;">
            <form action="<?=base_url("master_add_subadmin")?>" id="adminCreateValidate"  method="post" enctype="multipart/form-data">
                <div class="new-doc">
                    <h2>Create Checklist <span class="closePopCls" id="closeStatusPopup">X</span></h2>
                     
                </div><br><br>
                <div class="doc-sub">
                    <div class="doc-sub-form">
                        <label>Checklist Name</label>
                        <input name="full_name" id="full_name" type="text" placeholder="Enter checklist name" data-validation="required">   
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <input name="submit" type="submit" value="Submit" />
                        </div>
                    </div>
                       
                </div>
            </form>
        </div>
    </div>


    <?php $this->load->view('admin/footer'); ?>
      
   
</body>

</html>

<script>
    $(document).ready(function(){
      $(document).on('click','#deleteCheckList', function(){
        var employee_id = $(this).attr('employee_id');
        if (!confirm("Do you want to confirm delete that records?")){
            return false;
        }
      });
    });
 
    $(document).ready(function(){
        $(document).on('click','.deleteEmployee', function(){
            var employee_id = $(this).attr('employee_id');
            if (!confirm("Do you want to confirm delete that records?")){
                return false;
            }
            else
            {
                if(employee_id == '' || employee_id == null || employee_id == '0')
                {
                    $.notify('Session exppire login again for delete',{'className':'danger','position':'top left','autoHideDelay': 1500});
                }
                else
                {
                    $ .ajax({
                        url  : '<?php echo base_url('master_login');?>',
                        type : 'POST',
                        data : {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>','employee_id': employee_id},
                        success : function(data)
                        {
                            let res = $.parseJSON(data);
                            if(res.response=='1')
                            {
                                $("#row_id_"+employee_id).hide();
                                $.notify(res.message,{'className':'success','position':'top left','autoHideDelay': 1500});
                            }
                            else
                            {
                                $.notify(res.message,{'className':'danger','position':'top left','autoHideDelay': 1500});
                            }
                        } 
                    })
                }
            }
        });
    });
</script>

<script type="text/javascript">
    
    $('.viewCheckList').click(function() {
        var checklist = $(this).attr('checklist');
        var typeName = $(this).attr('typeName');
        if(checklist =='' || checklist == null)
        {
            $.notify('Question not found',{'className':'danger','position':'top left','autoHideDelay': 1500});
        }
        else
        {
            $ .ajax({
                url  : '<?php echo base_url('master_get_checklist');?>',
                type : 'POST',
                data : {'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash();?>','checklist': checklist},
                success : function(data)
                {
                    let res = $.parseJSON(data);
                    if(res.response=='1')
                    {
                        $('#checklistPopup').show(500);
                        $('#checklistDivDisp').html(res.datas);
                        $('#chkListHdg').html(typeName+' List');
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

    $('#closePopup').click(function() {
        $('#checklistPopup').hide();
    });
    </script>

<script type="text/javascript">
    $('.addChecklist').click(function() {
        $('#checklistAddPopup').show();
    });

    $('#closeStatusPopup').click(function() {
        $('#checklistAddPopup').hide();
    });
    </script>
    
    <script>
        function getYesFunction(type,q_id)
        {
            if(type == '1')
            {
                $("#hiden_div_"+q_id).show();
            }
            else
            {
                $("#hiden_div_"+q_id).hide();
            }
            //type => 1 = yes, 2=no
        }
    </script>

<script>
    $(function() {
      $('.dashboardCls').removeClass('active');
      $('.kycCls').removeClass('active');
      $('.certificateCls').removeClass('active');
      $('.grievanceCls').removeClass('active');
      $('.subAdminCls').removeClass('active');
      $('.checklistCls').addClass('active');
      $('.userExportCls').removeClass('active');
    });
</script>