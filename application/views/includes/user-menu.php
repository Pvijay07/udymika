<?php $page = ($this->uri->segment(2) != "") ? $this->uri->segment(2) : "profile";  ?>
<div class="mobile-nav-menu">
    <div class="dashboard-main-lft">
        <div>
            <div class="dashboard-main-lft-logo">
                <a href="#">
                    <img src="<?=base_url("assets/")?>images/logo.png" alt="logo" />
                </a>
                </div>
            <!-- <div class="search-icon">
                <input type="search" placeholder="Search" />
            </div> -->
            <div class="dash-categories">

                <ul>
                    <?php
                    $id = $this->session->userdata("user_id");
                    $kycStsMenu = $this->db->query("SELECT status,userPic FROM users WHERE id ='$id'")->row_array();
                    if($kycStsMenu['status'] <= '2')
                    {
                      $menuDsbl = 'disabled';
                    }
                    else
                    {
                        $menuDsbl = '';
                    }
                    ?>
                    <a href="<?=base_url("user/")?>">
                        <li <?php if($page == "profile") echo 'class="active"' ?> >
                            
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="20" viewBox="0 0 18 20" fill="none">
                                    <path
                                        d="M17 19V17C17 15.9391 16.5786 14.9217 15.8284 14.1716C15.0783 13.4214 14.0609 13 13 13H5C3.93913 13 2.92172 13.4214 2.17157 14.1716C1.42143 14.9217 1 15.9391 1 17V19M13 5C13 7.20914 11.2091 9 9 9C6.79086 9 5 7.20914 5 5C5 2.79086 6.79086 1 9 1C11.2091 1 13 2.79086 13 5Z"
                                        stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p>Profile</p>
                            
                        </li>
                    </a>
                    <a href="<?=base_url("user/dashboard")?>">
                        <li <?php if($page == "dashboard") echo 'class="active"' ?>>
                            
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18" fill="none">
                                    <path d="M13 17V7M7 17V1M1 17V11" stroke="#667085" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                <p>Dashboard</p>
                            
                        </li>
                    </a>
                    <a href="<?=base_url("user/enterprise")?>" class='<?=$menuDsbl;?>'>
                        <li <?php if($page == "enterprise") echo "class='active'" ?>>
                            
                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="23" viewBox="0 0 19 23" fill="none">
                                    <path d="M3.4126 6.15527H9.33857V7.58837H3.4126V6.15527Z" fill="#667085" />
                                    <path d="M3.3667 16.9856H6.45651V18.3952H3.3667V16.9856Z" fill="#667085" />
                                    <path d="M3.3667 13.3911H7.24049V14.8007H3.3667V13.3911Z" fill="#667085" />
                                    <path d="M3.38965 9.93774H7.86295V11.2534H3.38965V9.93774Z" fill="#667085" />
                                    <path
                                        d="M7.00971 20.9561H1.2682V1.29213H12.0825V5.3095H16.0255V8.76302H17.2937V3.85291L13.5352 0H0V22.2482H7.00971V20.9561ZM13.1201 1.15117L16.1638 4.2523H13.1201V1.15117Z"
                                        fill="#667085" />
                                    <path
                                        d="M11.3907 19.3821C10.8604 19.3821 10.3761 19.1002 10.1225 18.6303L9.8458 18.1604C9.79969 18.09 9.77663 18.043 9.77663 18.043L7.86279 22.0838L9.47687 21.7079L10.307 23.0001L12.0594 19.3586H11.3907V19.3821Z"
                                        fill="#667085" />
                                    <path
                                        d="M16.948 18.6302C16.6944 19.1 16.2102 19.3819 15.6798 19.3819L14.8267 19.4289L16.556 22.9999L17.3861 21.7078L19.0002 22.0837L17.1786 18.2073L16.948 18.6302Z"
                                        fill="#667085" />
                                    <path
                                        d="M18.3315 13.7906L17.8243 12.9213V11.9346C17.8243 11.7232 17.709 11.5117 17.5245 11.3943L16.6944 10.9009L16.1871 10.0316C16.0718 9.8437 15.8874 9.72624 15.6568 9.72624H14.6653L13.8121 9.23288C13.6277 9.11541 13.3971 9.11541 13.2126 9.23288L12.3595 9.72624H11.3906C11.1831 9.72624 10.9756 9.8437 10.8603 10.0316L10.3765 10.9009L9.50024 11.4178C9.31577 11.5352 9.20048 11.7232 9.20048 11.9581V12.9683L8.71626 13.8141C8.67014 13.9081 8.62402 14.0255 8.62402 14.1195C8.62402 14.237 8.64708 14.3309 8.71626 14.4249L9.20048 15.2707V16.2809C9.20048 16.4923 9.31577 16.7038 9.50024 16.8212L10.3765 17.3377L10.8607 18.2069C10.976 18.3949 11.1604 18.5123 11.391 18.5123H12.3595L13.2126 19.0057C13.3048 19.0527 13.4201 19.0997 13.5124 19.0997C13.6277 19.0997 13.7199 19.0762 13.8121 19.0057L14.6653 18.5123H15.6568C15.8643 18.5123 16.0718 18.3949 16.1871 18.2069L16.6944 17.3377L17.5245 16.8443C17.709 16.7268 17.8243 16.5389 17.8243 16.304V15.3172L18.3315 14.4245C18.4468 14.237 18.4468 14.0016 18.3315 13.7906ZM15.4723 13.8141L14.6192 14.6598L14.8267 15.858C14.8267 15.9285 14.8036 15.9755 14.7575 16.0225C14.7345 16.046 14.6883 16.046 14.6653 16.046C14.6422 16.046 14.6192 16.046 14.5961 16.0225L13.5354 15.4586L12.4748 16.0225C12.4286 16.046 12.3595 16.0459 12.3133 15.999C12.2672 15.952 12.2442 15.905 12.2442 15.8345L12.4517 14.6363L11.5985 13.7906C11.5524 13.7436 11.5294 13.6731 11.5524 13.6261C11.5755 13.5791 11.6216 13.5322 11.6908 13.5087L12.8667 13.3442L13.3971 12.2635C13.4432 12.1461 13.6277 12.1461 13.6738 12.2635L14.2041 13.3442L15.3801 13.5087C15.4493 13.5087 15.4954 13.5557 15.5184 13.6261C15.5184 13.6966 15.4954 13.7671 15.4723 13.8141Z"
                                        fill="#667085" />
                                </svg>
                                <p>My Enterprise /<br>Certification</p>
                            
                        </li>
                    </a>
                    <a href="<?=base_url("user/grievance")?>">
                            <li <?php if($page == "grievance") echo 'class="active"' ?>  > 
                                
                                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="27" viewBox="0 0 23 27" fill="none">
                                        <path
                                            d="M20.0552 14.2551C21.1273 14.2551 22 13.3681 22 12.2784V10.5716C22 9.48191 21.1273 8.59488 20.0552 8.59488H19.2622C19.0585 4.37221 15.6142 1 11.4105 1C7.20587 1 3.76211 4.37221 3.55839 8.59488H2.9448C1.87273 8.59488 1 9.48191 1 10.5716V12.2784C1 13.3681 1.87273 14.2551 2.9448 14.2551H3.60409C3.59291 14.3603 3.58076 14.4508 3.5686 14.5234L3.56228 22.4899C1.13857 23.7288 1.16871 25.5226 1.17212 25.6195C1.18038 25.832 1.35201 25.997 1.5601 25.997H1.5708C1.78376 25.9906 1.95247 25.8097 1.94906 25.5933C1.94761 25.4955 1.96365 23.1966 6.46976 22.3881C7.00993 22.3091 7.53649 22.2418 8.04992 22.1821C8.65864 23.5237 9.99472 24.431 11.499 24.431C13.0558 24.431 14.4342 23.4595 15.0104 22.0387C20.8788 22.699 21.2172 25.5839 21.2221 25.6338C21.2372 25.8409 21.4078 25.9995 21.6096 25.9995C21.6183 25.9995 21.6266 25.999 21.6353 25.9985C21.8498 25.9842 22.0122 25.7954 21.9981 25.5785C21.9912 25.4712 21.8308 23.669 19.303 22.3876V14.2551H20.0552ZM21.2221 10.5716V12.2784C21.2221 12.9322 20.6984 13.4644 20.0552 13.4644H19.2656L19.271 9.38555H20.0557C20.6984 9.38555 21.2221 9.91777 21.2221 10.5716ZM2.94529 13.4644C2.30205 13.4644 1.77841 12.9322 1.77841 12.2784V10.5716C1.77841 9.91777 2.30205 9.38555 2.94529 9.38555H3.77767C3.76016 10.7287 3.72662 12.359 3.6639 13.4644H2.94529ZM15.2321 21.2664L15.2331 21.2575C15.2632 18.5242 15.2428 18.4101 15.2355 18.3671C15.1971 18.1521 14.9934 17.995 14.7814 18.0355C14.5704 18.0745 14.4279 18.2668 14.4658 18.4817C14.478 18.6433 14.4658 20.2246 14.4556 21.21C14.4532 21.2229 14.4488 21.2347 14.4464 21.2471C14.3268 21.3054 14.2373 21.42 14.2252 21.5634C14.2184 21.6429 14.2412 21.7151 14.2752 21.7803C13.8065 22.8857 12.7233 23.6389 11.5005 23.6389C10.3122 23.6389 9.25569 22.9268 8.76755 21.8712C8.78651 21.8169 8.79672 21.7595 8.7904 21.6983C8.77679 21.5673 8.69948 21.4645 8.59543 21.4037C8.57793 21.3395 8.55994 21.2757 8.54584 21.21C8.53514 19.9613 8.52299 17.9579 8.53126 17.8092L8.57064 17.5892L8.40582 17.442C7.63276 16.7511 7.09696 15.8132 6.89276 14.7809C6.82177 14.4997 6.79892 12.4459 6.81545 10.5093C10.1192 9.80806 12.416 7.67276 13.6009 6.29354C15.0804 7.04665 16.0591 8.52372 16.1787 10.2128L16.1928 10.3314L16.0961 14.8698C16.0912 15.0878 16.2619 15.2686 16.4768 15.2736C16.6887 15.2775 16.8696 15.1051 16.874 14.8866L16.9741 10.1925L16.9639 9.78879H16.9168C16.6552 7.86351 15.4295 6.2204 13.6505 5.44505L13.3845 5.32941L13.1988 5.55525C12.117 6.87171 9.79052 9.17207 6.36669 9.79225L6.04579 9.85056L6.04093 10.1802C6.03315 10.8854 6.00106 14.429 6.13428 14.9563C6.35502 16.0766 6.92825 17.1183 7.75528 17.9095C7.74993 18.2495 7.74896 19.0945 7.76792 21.2555L7.7757 21.3296C7.78153 21.3578 7.79028 21.3859 7.79661 21.4141C7.32645 21.4704 6.84657 21.5322 6.34821 21.6054C5.5664 21.7452 4.90468 21.9315 4.34117 22.1455V14.6252C4.54878 13.3335 4.57309 7.91145 4.57552 7.13263C5.38456 4.06138 8.13841 1.79067 11.411 1.79067C15.3172 1.79067 18.4945 5.02006 18.4945 8.99022V14.6554C18.2917 15.5933 17.4657 16.2708 16.5156 16.2708H13.3699C13.2231 15.4673 12.5317 14.856 11.6993 14.856C10.761 14.856 9.99764 15.6318 9.99764 16.5856C9.99764 17.5393 10.761 18.3152 11.6993 18.3152C12.4739 18.3152 13.1225 17.7825 13.3276 17.0615H16.5156C17.2945 17.0615 18.0127 16.7304 18.5271 16.1922V22.0412C17.6611 21.7042 16.5823 21.4284 15.2321 21.2664ZM12.6226 16.5851C12.6226 17.103 12.2084 17.524 11.6989 17.524C11.1893 17.524 10.7751 17.103 10.7751 16.5851C10.7751 16.0672 11.1893 15.6462 11.6989 15.6462C12.2084 15.6462 12.6226 16.0672 12.6226 16.5851Z"
                                            fill="#667085" stroke="#667085" stroke-width="0.5" />
                                    </svg>
                                    <p>Raise a Query</p>
                                
                                <div class="q-cnut">
                                <?php
                                $totGri = $this->db->query("SELECT COUNT(g_id) as totalchat FROM greivances_chat_tbl WHERE user_id = '$id' AND user_type != 'user' AND chatRead = '0'")->row_array()['totalchat'];
                                ?>
                                <p><?=$totGri;?></p>
                                </div>
                            </li>
                    </a>
                    <a href="<?=base_url("user/meeting")?> " class='<?=$menuDsbl;?>'>
                        <li <?php if($page == "meeting") echo 'class="active"' ?>  >
                            
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="21" viewBox="0 0 22 21" fill="none">
                                    <g clip-path="url(#clip0_424_102718)">
                                        <path d="M2.75 0V8.74969H4.58366V1.74984H17.4168V8.74969H19.25V0H2.75Z" fill="#667085" />
                                        <path d="M10.0835 5.25H11.9172V9.62531H10.0835V5.25Z" fill="#667085" />
                                        <path d="M6.4165 3.49976H8.25016V9.62444H6.4165V3.49976Z" fill="#667085" />
                                        <path d="M13.75 7.00024H15.5837V9.62524H13.75V7.00024Z" fill="#667085" />
                                        <path
                                            d="M11 13.125C9.48112 13.125 8.25 14.3002 8.25 15.75C8.25 17.1998 9.48112 18.375 11 18.375C12.5189 18.375 13.75 17.1998 13.75 15.75C13.75 14.3002 12.5189 13.125 11 13.125ZM11 16.6247C10.4942 16.6247 10.0837 16.2337 10.0837 15.75C10.0837 15.2663 10.4947 14.8753 11 14.8753C11.5068 14.8753 11.9163 15.2663 11.9163 15.75C11.9163 16.2337 11.5068 16.6247 11 16.6247Z"
                                            fill="#667085" />
                                        <path
                                            d="M7.3335 21.0001C7.3335 20.0335 8.15408 19.2498 9.16716 19.2498H12.8335C13.8461 19.2498 14.6667 20.033 14.6667 21.0001H7.3335Z"
                                            fill="#667085" />
                                        <path
                                            d="M18.3335 10.5C16.8146 10.5 15.5835 11.6752 15.5835 13.125C15.5835 14.5748 16.8146 15.75 18.3335 15.75C19.8524 15.75 21.0835 14.5748 21.0835 13.125C21.0835 11.6752 19.8524 10.5 18.3335 10.5ZM18.3335 13.9997C17.8267 13.9997 17.4167 13.6087 17.4167 13.125C17.4167 12.6413 17.8267 12.2503 18.3335 12.2503C18.8403 12.2503 19.2498 12.6413 19.2498 13.125C19.2498 13.6087 18.8403 13.9997 18.3335 13.9997Z"
                                            fill="#667085" />
                                        <path
                                            d="M3.6665 10.5C2.14762 10.5 0.916504 11.6752 0.916504 13.125C0.916504 14.5748 2.14762 15.75 3.6665 15.75C5.18539 15.75 6.4165 14.5748 6.4165 13.125C6.4165 11.6752 5.18539 10.5 3.6665 10.5ZM3.6665 13.9997C3.15972 13.9997 2.75016 13.6087 2.75016 13.125C2.75016 12.6413 3.16021 12.2503 3.6665 12.2503C4.17329 12.2503 4.58284 12.6413 4.58284 13.125C4.58284 13.6087 4.17329 13.9997 3.6665 13.9997Z"
                                            fill="#667085" />
                                        <path
                                            d="M5.5 16.6248H1.83366C0.82058 16.6248 0 17.4085 0 18.3751V21.0001H1.83366V18.3751H7.33366C7.33366 17.4085 6.51259 16.6248 5.5 16.6248Z"
                                            fill="#667085" />
                                        <path
                                            d="M20.1665 16.6248H16.5002C15.4876 16.6248 14.6665 17.408 14.6665 18.3751H20.1665V21.0001H22.0002V18.3751C22.0002 17.4085 21.1791 16.6248 20.1665 16.6248Z"
                                            fill="#667085" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_424_102718">
                                            <rect width="22" height="21" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                <p>Meetings</p>
                            
                        </li>
                    </a>
                    <a href="<?=base_url("user/documents")?>" class=''>
                        <li <?php if($page == "documents") echo 'class="active"' ?>>
                            
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" viewBox="0 0 18 22" fill="none">
                                    <path
                                        d="M10 1H3C2.46957 1 1.96086 1.21071 1.58579 1.58579C1.21071 1.96086 1 2.46957 1 3V19C1 19.5304 1.21071 20.0391 1.58579 20.4142C1.96086 20.7893 2.46957 21 3 21H15C15.5304 21 16.0391 20.7893 16.4142 20.4142C16.7893 20.0391 17 19.5304 17 19V8M10 1L17 8M10 1V8H17"
                                        stroke="#667085" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p>Documents</p>
                            
                        </li>
                    </a>
                </ul>
            </div>
            <?php 
            $stsUsrId = $this->session->userdata('user_id');
            $userStatus = $this->db->query("SELECT status FROM users WHERE id = '$stsUsrId'")->row_array(); 
            $status = $this->db->query("SELECT certficationStatus FROM option3 LEFT JOIN enterprise ON option3.enterprise_id = enterprise.id WHERE user_id = '$stsUsrId'")->row_array()['certficationStatus']; 
            //$perSts = $status['certficationStatus'];
            if($userStatus['status'] == '1')
            {
                $per = 25;
            }
            elseif($userStatus['status'] == '3' &&  $status < '3')
            {
                $per = 50;
            }
            elseif($userStatus['status'] == '3' && $status == '3')
            {
                $per = 75;
            }
            elseif($userStatus['status'] == '3' && $status == '5')
            {
                $per = 100;
            }
            else
            {
                $per = 25;
            }
            ?>
            <div class="appli-status">
                <!-- <div class="range-child-sec">
                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="<?= $per; ?>" style="--value:<?= $per; ?>; background:
                              radial-gradient(closest-side, #FFF3F7 80%, transparent 0 99.9%, white 0),
                                  conic-gradient(#C73866 calc(var(--pgPercentage) * 1%), var(--bg) 0)
                                ;;color: #000;">
                    </div>
                </div> -->
                <div class="progress-container" data-percentage='40'>
                    <div class="progress"></div>
                    <div class="percentage">0%</div>
                </div>
                <h5>Application Status</h5>
                <p>You have finished <?= $per; ?>% of your application. Need any Help?</p>
            </div>

            <!-- <div class="users-dash">
                <ul>
                    <li style="cursor:pointer;">
                        <div class="userProfilePic">
                        <?php
                        if(file_exists($kycStsMenu['userPic'])){
                            $profPic = $kycStsMenu['userPic'];
                            $chk = '1';
                        }
                        else{
                            $profPic = 'assets/images/user-image.png';
                            $chk = '11';
                        }
                        ?>
                          <img src="<?=base_url($profPic); ?>" alt="img <?=$chk;?>" style="border-radius:50%;">
                        </div>
                        <div  class="userProfilePic usermail">
                            <h6><?php echo $this->session->userdata('user_name'); ?></h6>
                            <p><?php echo $this->session->userdata('user_email'); ?></p>
                        </div>
                        <div class="lg-icn">
                            <a href="<?= base_url('user/logout'); ?>"><img src="<?=base_url("assets/")?>images/share-icon.png" alt="img" class="logOutIconImg log-out-btn"></a>
                        </div>
                    </li>
                    <li>
                        <div class="chngPassIcon">
                            <a href="<?php echo base_url('password_update'); ?>" class="chngPassIconSYg">Change Password</a>
                        </div>
                    </li>
                </ul>
            </div> -->
        </div>
        <div class="closed-menu-icon">
            <a class='close-menu-btn' href="#">
              <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M13 1L1 13M1 1L13 13" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </a>
        </div>
    </div>
</div>



<script type="text/javascript">

    const progressContainer = document.querySelector('.progress-container');

    // initial call
    setPercentage();

    function setPercentage() {
    const percentage = progressContainer.getAttribute('data-percentage') + '%';
    
    const progressEl = progressContainer.querySelector('.progress');
    const percentageEl = progressContainer.querySelector('.percentage');
    
    progressEl.style.width = percentage;
    percentageEl.innerText = percentage;
    percentageEl.style.left = percentage;
    }

</script>