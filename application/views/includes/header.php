<?php
$user = $this->session->userdata("user_id");
$user_details = $this->crud_model->select_row("users", ["id" => $user]);
?>

<div id="loader" class="center"></div>
<style>
    #loader {
        border: 12px solid #f3f3f3;
        border-radius: 50%;
        border-top: 12px solid #444444;
        width: 70px;
        height: 70px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        100% {
            transform: rotate(360deg);
        }
    }

    .center {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }
</style>

<header>
    <div class="users-dash hdr">
        <ul>
            <li>
                <div class="user-prflo">
                    <?php if ($user_details->userPic) { ?>

                        <img src="<?= base_url($user_details->userPic) ?>" />
                    <?php     } else {
                    ?>
                        <img src="<?php echo base_url()?>assets/images/main-logo.png" />
                    <?php } ?>
                </div>
            </li>
            <li>
                <div class="user-infto">
                    <div class="prfl-n">
                        <h6><?php
                            $name = character_limiter($user_details->name, 20);
                            echo $name
                            ?></h6>
                        <img class="drpedit" src="<?= base_url("assets/") ?>images/dwn-arw.png" />
                    </div>
                    <div class="clk-drp">
                        <a href="<?php echo base_url() ?>user/profile_picture">Update Profile</a>
                        <a href="<?php echo base_url('password_update'); ?>">Change Password</a>
                        <a href="<?php echo base_url() ?>user/logout">Logout</a>
                    </div>
                    <p><?= $user_details->email ?></p>
                </div>
                <!-- <div>
                    <a href="<?= base_url("user/logout") ?>"><img src="<?= base_url("assets/") ?>"
                            alt="">Logout</a>
                   
                </div> -->
            </li>
        </ul>



    </div>
</header>
<script src="<?= base_url() ?>assets/js/jquery-3.6.0.min.js"></script>
<script src="<?= base_url() ?>assets/slick/slick.min.js"></script>
<script src="<?= base_url() ?>assets/js/main.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.form-validator.js"></script>
<!-- <script src="<?= base_url("assets/") ?>js/bootstrap.min.js"></script> -->
<script src="<?php echo base_url('assets/js/notify.min.js'); ?>"></script>
<script type="text/javascript">
    document.onreadystatechange = function() {
        if (document.readyState !== "complete") {
            document.querySelector(
                "body").style.visibility = "hidden";
            document.querySelector(
                "#loader").style.visibility = "visible";
        } else {
            document.querySelector(
                "#loader").style.display = "none";
            document.querySelector(
                "body").style.visibility = "visible";
        }
    };


    $(".drpedit").click(function() {
        $(".clk-drp").toggle();
    });
</script>