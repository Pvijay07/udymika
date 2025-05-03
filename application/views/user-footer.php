<div class="user-profile-popup">
        <div class="container">
            <form action="<?=base_url("user/profile_picture_updates")?>" method="post" enctype="multipart/form-data">
                <div class="new-doc">
                    <h2>Update profile picture</h2>
                    <span id="profilePicCls">X</span>
                </div>
                <div class="doc-sub">
                    <div class="doc-sub-form">
                        <label>Image (Jpeg,png)<span class="text-danger">*</span></label>
                        <input name="profilePic" type="file" class="custom-file-input" data-validation="required" style="width: auto;" accept="image/jpeg,image/png"/>
                        <input name="user_id" value="<?=$this->session->userdata("user_id");?>" type="hidden" />
                    </div>
                    <input name="submit" type="submit" value="Submit" />
                </div>
            </form>
        </div>
    </div>

<script>
    $(document).ready(function(){
        $(document).on('click','.userProfilePic',function(){
            $('.user-profile-popup').show();
        });
    });
</script>
<script id="rendered-js">
    $('#profilePicCls').click(function() {
        $('.user-profile-popup').hide();
    });
</script>