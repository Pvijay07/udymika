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
    <div class="users-dash">
        <ul>
            <li>
                <div style="width: 145px; overflow: hidden;">
                    <h6><?=$user_details->name?></h6>
                    <p><?=$user_details->email?></p>
                </div>
                <div>
                    <a href="<?=base_url("logout")?>"><img src="<?=base_url("assets/")?>"
                            alt="">Logout</a>
                   <!--  <a href="<?//=base_url("user/logout")?>"><img src="<?//=base_url("assets/")?>images/share-icon.png"
                    alt="img"></a> -->
                </div>
            </li>
        </ul>
    </div>
</header>

<script>
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
</script>

