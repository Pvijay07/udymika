<!doctype html>
<html>

<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no"> 
    <!-- favicon -->
 
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
    <div class="dashboard-page user__dashboard">
        <div class="container">
            <div class="dashboard-main">

                <?php $this->load->view("includes/user-menu.php"); ?>

                <div class="dashboard-main-ryt">
                    <?php $this->load->view("includes/header.php"); ?>

                    <div class="mob-menu-bar">
                        <img src="<?php echo base_url()?>assets/images/main-logo.png" alt="logo">
                        <a id='menu-button' href="#">
                          <span></span>
                          <span></span>
                          <span></span>
                        </a> 
                    </div>

                    <div class="dash-seections">

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

                        <section class="dash-grev">
                            <div class="dash_cate">
                                <p>Query <br>Raised</p>
                                <div class="qyr">
                                    <span><?php echo $grievance_raised; ?></span>
                                    <div class="icn-dv">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <path d="M479.04,203c0,64.06,0,128.12,0,192.17c-0.31,0.61-0.72,1.18-0.92,1.83c-4.14,12.85-12.78,20.44-26.29,21.86
                                            c-4.97,0.52-10.03,0.08-15.48,0.08c0,12.62-0.08,24.47,0.03,36.32c0.06,6.44-1.87,11.72-7.85,14.81
                                            c-6.27,3.24-11.67,1.17-16.84-2.84c-19.35-14.99-38.8-29.86-58.12-44.89c-2.9-2.26-5.79-3.22-9.48-3.22
                                            c-43.91,0.11-87.83,0.09-131.74,0.06c-19.77-0.01-32.36-12.59-32.39-32.24c-0.01-6.81,0.01-13.62-0.02-20.43
                                            c0-1.05-0.2-2.1-0.35-3.53c-1.59,1.17-2.76,2-3.89,2.87c-21.47,16.51-42.95,33.01-64.4,49.55c-4.88,3.76-10.15,5.03-15.79,2.23
                                            c-5.61-2.78-7.88-7.58-7.82-13.86c0.15-15.22,0.05-30.43,0.05-45.65c0-1.54,0-3.08,0-4.92c-6.93,0-13.29,0.12-19.65-0.02
                                            c-19.93-0.45-34.25-15.12-34.26-35.04c-0.01-75.07-0.01-150.14,0.01-225.22c0-2.31-0.03-4.67,0.41-6.92
                                            c3.34-17.07,16.95-28.16,34.58-28.16c99.13-0.02,198.26,0.18,297.39-0.16c21-0.07,37.05,16.05,36.51,36.53
                                            c-0.7,26.5-0.17,53.04-0.17,79.56c0,1.54,0,3.07,0,4.9c16.07,0,31.55-0.04,47.04,0.01c12.37,0.05,23.36,7.85,27.66,19.5
                                            C477.86,199.79,478.45,201.39,479.04,203z M115.56,376.53c1.85-1.34,3-2.13,4.11-2.98c18.72-14.38,37.5-28.68,56.09-43.23
                                            c4.82-3.78,9.86-5.48,15.97-5.46c57.96,0.11,115.92,0.07,173.88,0.06c7.55,0,9.1-1.56,9.1-9.14c0-73.32,0-146.64,0-219.96
                                            c0-8.57-1.46-10.01-10.14-10.01c-81.58,0-163.16,0-244.74,0c-16.66,0-33.33-0.03-49.99,0.02c-5.88,0.01-8.17,2.12-8.17,7.65
                                            c-0.03,74.62-0.03,149.25,0,223.87c0,5.5,2.12,7.54,7.65,7.56c10.14,0.04,20.29-0.04,30.43,0.03c10.25,0.07,15.81,5.7,15.82,15.88
                                            C115.57,352.4,115.56,363.99,115.56,376.53z M402.57,206.54c0,2.27,0,3.98,0,5.69c0,34.63,0.01,69.26-0.02,103.89
                                            c0,3.17,0.05,6.43-0.6,9.5c-3.58,16.96-17.08,27.55-35.09,27.56c-51,0.04-102,0.01-153,0.01c-1.82,0-3.65,0-5.89,0
                                            c0,11.17,0.2,21.72-0.09,32.26c-0.12,4.4,1.18,5.62,5.63,5.6c45.5-0.17,90.99-0.05,136.49-0.17c5.96-0.02,10.94,1.6,15.58,5.31
                                            c9.27,7.42,18.76,14.56,28.17,21.8c4.53,3.49,9.1,6.92,14.52,11.04c0-8.25-0.08-15.44,0.02-22.63c0.14-9.73,5.76-15.33,15.44-15.44
                                            c7.24-0.08,14.49-0.01,21.73-0.02c5.77,0,5.77-0.01,5.77-5.69c0-57.67,0-115.33,0-173c0-0.87,0.33-1.98-0.08-2.56
                                            c-0.85-1.2-2.09-3.02-3.19-3.03C433.05,206.47,418.14,206.54,402.57,206.54z"/>
                                        <path d="M263.25,166.75c-0.44,12.66-6.59,22.36-15.3,30.78c-4.17,4.03-8.52,7.86-12.7,11.88c-6.51,6.27-10.49,13.59-10.38,23.01
                                            c0.07,6.75-4.19,12.19-9.87,13.89c-5.62,1.68-11.83,0.08-15.04-4.91c-1.84-2.86-3.07-6.68-3.06-10.06
                                            c0.04-15.29,5.59-28.54,16.33-39.46c4.97-5.06,10.17-9.91,15.48-14.63c7.83-6.96,7.31-15.23,3.96-21.1
                                            c-3.76-6.61-13.55-10.09-21.36-7.88c-5.66,1.61-9.24,6.84-9.7,14.01c-0.14,2.15-0.23,4.36-0.79,6.42
                                            c-1.86,6.75-7.73,10.66-14.78,10.07c-6.59-0.55-12.06-5.6-12.37-12.39c-1.41-31.09,22.49-50.72,49.72-46.16
                                            c20.1,3.36,33.66,14.61,38.58,34.93C262.86,158.9,262.84,162.88,263.25,166.75z"/>
                                        <path d="M196.16,282.56c-0.03-7.93,6.25-14.09,14.47-14.19c8.29-0.1,14.99,6.32,14.9,14.28c-0.09,7.88-6.53,13.96-14.76,13.94
                                            C202.52,296.56,196.19,290.48,196.16,282.56z"/>
                                        </svg>

                                    </div>  
                                </div>
                            </div>
                            <div class="dash_cate">
                                <p>Query Under Review</p>
                                <div class="qyr">
                                    <span><?php echo $grievance_review; ?></span>
                                    <div class="icn-dv">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <path d="M83.57,272.14c0,26-0.08,52,0.03,78c0.07,16.42,9.22,28.44,24.41,32.15c3.28,0.8,6.8,0.86,10.21,0.87
                                                c20.48,0.08,40.95,0.13,61.43-0.02c6.22-0.05,11.15,1.83,15.52,6.42c10.09,10.61,20.52,20.9,30.82,31.31
                                                c4.29,4.33,4.32,4.34,8.74-0.14c10.4-10.52,20.9-20.95,31.13-31.64c4.03-4.21,8.63-5.97,14.35-5.94c20.77,0.1,41.56-0.4,62.32,0.17
                                                c19.86,0.54,35.07-14.13,34.71-34.8c-0.35-20.02-0.11-40.05-0.02-60.07c0.03-6.08,3.68-10.72,9.22-12.3
                                                c5.56-1.59,11.54,0.4,14.38,5.4c1.34,2.36,2.22,5.32,2.24,8.02c0.17,21.22,0.37,42.44,0.01,63.66
                                                c-0.53,31.3-26.71,56.06-59.14,56.27c-19.13,0.12-38.26,0.08-57.39-0.04c-2.94-0.02-4.99,0.88-7.02,2.98
                                                c-9.15,9.44-18.41,18.78-27.72,28.07c-12.81,12.78-30.2,12.81-43.01,0.05c-9.32-9.28-18.39-18.81-27.81-27.98
                                                c-1.69-1.64-4.54-2.9-6.87-2.93c-19.13-0.23-38.26-0.03-57.39-0.16c-29.43-0.19-52.42-18.99-58.28-47.69
                                                c-0.83-4.06-1.04-8.31-1.04-12.47c-0.07-51.55-0.1-103.11-0.02-154.66c0.04-29.58,18.32-52.67,46.53-58.79
                                                c4.34-0.94,8.88-1.27,13.34-1.28c37.96-0.1,75.93-0.06,113.89-0.05c0.9,0,1.8-0.03,2.69,0.03c7.51,0.49,13.26,6.24,13.22,13.18
                                                c-0.05,7.28-5.86,12.79-13.83,12.8c-38.41,0.05-76.82-0.01-115.23,0.04c-17.25,0.02-29.64,9.11-33.45,24.69
                                                c-0.84,3.42-0.89,7.1-0.9,10.66C83.54,221.34,83.57,246.74,83.57,272.14z"/>
                                            <path d="M369.06,68.79c11.22-0.05,22.45,4.44,31.69,13.61c13.9,13.79,27.82,27.55,41.52,41.54c19.28,19.68,19.3,47.68,0.04,67.37
                                                c-13.58,13.89-27.3,27.65-41.19,41.23c-20.26,19.8-48.26,19.53-68.33-0.45c-13.34-13.29-26.66-26.6-39.95-39.94
                                                c-20.3-20.38-20.29-48.55,0-68.9c13.5-13.55,27.02-27.09,40.59-40.57C342.95,73.22,354,68.76,369.06,68.79z M367.15,220.69
                                                c5.6,0.23,10.64-1.73,14.75-5.82c14.19-14.12,28.42-28.2,42.43-42.49c8.32-8.48,8.62-20.52,0.42-28.98
                                                c-14.24-14.69-28.71-29.18-43.42-43.4c-8.49-8.2-20.56-7.75-28.97,0.57c-14.13,13.96-28.17,28.02-42.15,42.13
                                                c-8.64,8.72-8.83,20.9-0.26,29.64c14.01,14.29,28.25,28.37,42.44,42.48C356.38,218.79,361.25,220.8,367.15,220.69z"/>
                                            <path d="M180.54,272.01c0.09,10.25-8.86,19.23-19.15,19.21c-10.11-0.02-18.86-8.65-19.06-18.81c-0.21-10.27,8.53-19.26,18.89-19.43
                                                C171.47,252.82,180.46,261.67,180.54,272.01z"/>
                                            <path d="M249.08,272.1c0,10.56-8.59,19.2-19,19.12c-10.5-0.09-18.84-8.67-18.79-19.33c0.05-10.36,8.44-18.8,18.78-18.89
                                                C240.49,252.9,249.08,261.52,249.08,272.1z"/>
                                            <path d="M317.97,271.91c0.09,10.42-8.54,19.22-18.94,19.3c-10.31,0.08-19.15-8.77-19.12-19.15c0.03-10.24,8.49-18.85,18.74-19.07
                                                C308.94,252.77,317.88,261.52,317.97,271.91z"/>
                                            <path d="M380.12,139.25c0,5.07,0.12,10.15-0.03,15.22c-0.23,7.5-5.5,12.93-12.5,13.13c-7.02,0.19-13.05-4.89-13.35-12.3
                                                c-0.43-10.58-0.42-21.2-0.02-31.77c0.29-7.69,6.23-12.64,13.66-12.38c6.98,0.25,12.03,5.67,12.23,13.33
                                                C380.23,129.4,380.12,134.32,380.12,139.25z"/>
                                            <path d="M380.13,190.18c-0.05,8.21-5.45,14.13-12.89,14.16c-7.56,0.02-13.25-6.23-13.18-14.49c0.06-8.1,5.59-14.07,13.06-14.11
                                                C374.8,175.7,380.18,181.67,380.13,190.18z"/>
                                        </svg>
                                    </div>  
                                </div>
                                
                            </div>
                            <div class="dash_cate">
                                <p>Query <br>Closed</p>
                                <div class="qyr">
                                    <span><?php echo $grievance_close; ?></span>
                                    <div class="icn-dv">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <g>
                                                <path d="M29.35,281.73c0-10.05,0-20.09,0-30.14c0.28-1.27,0.66-2.53,0.83-3.82c1.02-7.74,1.53-15.57,3.04-23.21
                                                    c11.03-55.75,38.68-101.65,83.47-136.59c50.27-39.21,107.61-54.34,170.71-46.1c44.24,5.78,83.71,23.46,117.03,53.17
                                                    c60.78,54.2,86.85,122.38,76.47,203.07c-7.74,60.13-37.09,109.1-84.53,146.89c-29.6,23.58-63.21,38.64-100.58,45.02
                                                    c-8.11,1.38-16.29,2.36-24.44,3.53c-10.05,0-20.09,0-30.14,0c-1.43-0.29-2.85-0.65-4.29-0.86c-9.18-1.31-18.49-2.01-27.52-3.97
                                                    c-47.53-10.29-87.91-33.34-120.71-69.25c-29.54-32.34-48.34-70.14-55.82-113.39C31.47,298.01,30.51,289.85,29.35,281.73z
                                                    M126.92,412.39c76.67,69.12,201.83,68.07,276.63-17.9c72.39-83.2,55.43-196.95-1.74-256.94
                                                    C310.26,229.09,218.7,320.63,126.92,412.39z M103.75,388.11c91.4-91.38,182.72-182.69,274.01-273.96
                                                    c-77.81-61.89-188.52-55.91-259.29,14.34C47.95,198.49,41.79,309.63,103.75,388.11z"/>
                                            </g>
                                        </svg>
                                    </div>  
                                </div>
                            </div>
                            <div class="dash_cate">
                                <p>Services &nbsp; Applied</p>
                                <div class="qyr">
                                    <span>0</span>
                                    <div class="icn-dv">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                            <path d="M184.24,242.12c31.3-18.07,61.45-35.48,91.79-52.99c-7.41-17.05-10.72-34.54-9.29-52.68c3.29-41.93,23.5-73.53,60.57-93.05
                                            c66.5-35.01,147.54,3.88,162.74,77.36c12.96,62.67-30.06,124.54-93.14,134.1c-28.9,4.38-55.49-1.51-80.04-17.26
                                            c-1.36-0.87-3.96-1.33-5.21-0.62c-20.54,11.65-40.95,23.52-61.39,35.35c-0.24,0.14-0.44,0.35-0.66,0.54
                                            c14.52,12.81,17.07,22.6,10.23,40.29c8.06,3.99,14.35,9.91,16.95,18.87c2.54,8.75,1.4,17.11-3.64,25.17
                                            c1.3,0.83,2.54,1.62,3.76,2.41c17.42,11.29,18.59,37.64,1.13,48.6c-31.51,19.78-63.69,38.65-100.52,47.04
                                            c-12.11,2.76-24.67,3.56-37.01,5.35c-1.92,0.28-3.97,0.67-5.63,1.6c-8.75,4.9-17.37,10.03-26.09,15c-5.83,3.33-9.36,2.42-12.7-3.37
                                            c-25.18-43.57-50.33-87.16-75.45-130.76c-3.18-5.52-2.18-9.06,3.25-12.37c11.33-6.91,22.93-13.42,33.94-20.81
                                            c13.72-9.21,22.52-22.6,29.72-37.23c13.42-27.25,26.75-54.55,40.74-81.51c7.81-15.06,19.77-25.94,36.68-30.48
                                            c7.07-1.9,14.07-1.8,20.96,0.64c13.58,4.81,20.77,19.16,15.96,34.54c-4.31,13.79-10.25,27.07-15.47,40.58
                                            C185.87,237.86,185.33,239.28,184.24,242.12z M68.66,320.6c0.35,1.07,0.4,1.39,0.55,1.65c23.14,40.11,46.25,80.23,69.52,120.26
                                            c0.77,1.33,3.19,2.68,4.63,2.48c12.19-1.68,24.58-2.75,36.43-5.83c32.51-8.43,60.86-25.94,89.34-42.95
                                            c5.51-3.29,7.48-10.39,5.48-16.38c-1.92-5.75-7.68-10.11-13.74-9.89c-2.38,0.09-4.79,1.04-7.08,1.89
                                            c-4.63,1.73-8.43,0.74-10.44-2.96c-2.1-3.87-0.77-7.79,3.68-10.52c3.03-1.85,6.2-3.47,9.17-5.41c5.32-3.46,7.66-8.58,6.61-14.72
                                            c-1.06-6.17-4.96-10.55-11.22-11.42c-3.42-0.47-7.2,0.61-10.65,1.59c-4.28,1.22-8.17,0.14-9.94-3.44c-1.67-3.36-0.56-7.48,2.81-9.77
                                            c2.04-1.39,4.27-2.49,6.38-3.76c7.86-4.72,10.42-12.87,6.36-20.14c-4.11-7.35-12.82-9.4-20.9-4.89c-3.77,2.11-7.44,4.43-11.3,6.33
                                            c-3.61,1.78-7.62,0.36-9.59-2.98c-2.01-3.41-1.17-7.32,2.2-9.85c0.98-0.74,2.11-1.29,3.18-1.9c26.87-15.51,53.74-31.02,80.6-46.53
                                            c5.75-3.32,11.56-6.54,17.18-10.06c5.05-3.17,7.05-8.04,6.42-13.91c-0.63-5.78-3.89-9.71-9.25-11.67
                                            c-4.97-1.81-9.57-0.61-14.12,2.04c-27.75,16.14-55.57,32.15-83.38,48.19c-11.09,6.4-22.23,12.73-33.29,19.19
                                            c-3.52,2.06-6.98,2.8-10.26-0.05c-3.32-2.88-2.98-6.5-1.33-10.17c0.25-0.56,0.47-1.14,0.7-1.71c7.14-17.73,14.41-35.41,21.32-53.22
                                            c1.7-4.38,2.85-9.16,3.14-13.83c0.42-6.79-3.72-10.76-10.61-11.48c-6.05-0.63-11.61,0.83-16.89,3.73
                                            c-8.41,4.62-14.54,11.51-18.94,19.84c-9.43,17.87-18.95,35.7-27.75,53.88C101.65,277.06,92.43,303.58,68.66,320.6z M325.41,224.75
                                            c35.94,24.89,91.19,22.75,125.97-15.26c34.14-37.31,34.46-93.33,0.94-131.26c-32.81-37.13-89.44-43.43-129.79-14.49
                                            c-41.79,29.98-49.59,82.52-32.89,117.77c13.22-3.97,24.85-1.3,33.6,9.68C331.53,201.58,331.51,212.98,325.41,224.75z M36.65,340.71
                                            c23.22,40.21,46.32,80.23,69.6,120.54c6.66-3.86,12.88-7.46,19.33-11.19c-23.29-40.33-46.41-80.36-69.62-120.56
                                            C49.32,333.36,43.2,336.91,36.65,340.71z"/>
                                            <path d="M357.36,146.31c1.47-1.38,2.71-2.5,3.89-3.68c17.38-17.37,34.66-34.84,52.17-52.09c11.94-11.77,30.32-8.72,37.2,5.89
                                            c3.98,8.45,2.83,18.25-3.79,24.94c-25.23,25.48-50.53,50.89-76.08,76.05c-9.43,9.28-24.47,7.94-32.86-2.4
                                            c-10.71-13.2-21.28-26.5-31.74-39.89c-8.3-10.62-6.76-24.59,3.32-32.61c10.09-8.03,23.9-6.14,32.44,4.46
                                            C347.03,133.32,352.09,139.7,357.36,146.31z M437.55,107.65c0.11-6.17-3.59-9.87-8.28-8.93c-2.35,0.47-4.77,2.12-6.53,3.86
                                            c-19.66,19.48-39.2,39.1-58.79,58.65c-5.61,5.6-9.68,5.41-14.59-0.71c-6.38-7.96-12.66-16-19.05-23.95
                                            c-3.25-4.05-7.87-4.91-11.36-2.29c-3.84,2.88-4.24,7.4-0.74,11.83c10.15,12.87,20.34,25.69,30.61,38.46
                                            c3.79,4.71,8.52,5.09,12.72,0.91c24.43-24.34,48.81-48.73,73.13-73.18C436.19,110.76,437.01,108.53,437.55,107.65z"/>
                                        </svg>

                                    </div>  
                                </div>
                            </div>
                            <div class="dash_cate">
                                <p>Services Received</p>
                                <div class="qyr">
                                    <span>0</span>
                                    <div class="icn-dv">
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <g>
                                            <path d="M152.96,348.43c1.68,0,3.36,0,5.04,0c53.07,0,106.15-0.08,159.22,0.16c4.07,0.02,8.7,1.43,12.05,3.7
                                                c4.93,3.33,6.81,8.78,5.11,14.84c-1.76,6.24-5.83,10.16-12.34,11.16c-2.29,0.35-4.65,0.35-6.98,0.35
                                                c-64.12,0.02-128.25,0.02-192.37,0c-3.25,0-6.56,0.26-9.73-0.29c-8.11-1.4-13.03-7.48-13.03-15.65
                                                c0.06-67.07,0.09-134.13,0.33-201.2c0.01-3.7,0.99-7.83,2.84-11c3.28-5.63,9.95-7.72,15.81-6.06c6.46,1.84,10.85,7.11,11.41,13.8
                                                c0.13,1.55,0.06,3.11,0.06,4.67c0,52.6,0,105.19,0,157.79c0,1.69,0,3.39,0,6.23c1.96-1.86,3.27-3.04,4.51-4.28
                                                c82.1-82.08,164.21-164.16,246.28-246.29c3.63-3.64,7.38-6.65,12.85-6.58c6.16,0.08,10.95,2.64,13.54,8.23
                                                c2.59,5.61,2.11,11.21-1.86,16.2c-1.16,1.45-2.57,2.71-3.89,4.03c-81.88,81.87-163.76,163.74-245.66,245.58
                                                c-1.19,1.19-2.72,2.04-4.1,3.05C152.35,347.41,152.65,347.92,152.96,348.43z"/>
                                            <path d="M254.73,468.31c-55.25,0-110.49,0.02-165.74-0.05c-3.06,0-6.31-0.21-9.13-1.26c-6.96-2.58-10.4-9.15-9.21-16.43
                                                c1.08-6.64,6.8-11.79,13.85-12.44c1.08-0.1,2.18-0.06,3.27-0.06c111.27,0,222.54,0,333.82,0c9.74,0,16.34,5.12,17.3,13.36
                                                c0.96,8.23-4.57,15.42-12.83,16.54c-2.15,0.29-4.34,0.31-6.51,0.32C364.6,468.31,309.66,468.31,254.73,468.31z"/>
                                        </g>
                                        </svg>

                                    </div>  
                                </div>
                            </div>

                        </section>
                        <section class="dash-accounts">
                            <h2> <img src="https://xhtmlreviews.com/udyam/assets/images/my-acnt-user.png" alt="logo"> My Account</h2>
                            <div class="dash-appl">
                                <p>Application Number: <span><?=$user_info->kyc_id?><span></p>
                                <div class="bar-hft">
                                    <ul class="list-unstyled form-wizard-steps clearfix">

                                        <li class="date_actv active">
                                            <span>
                                                <strong>Registration Completed Successfully</strong>
                                                <div class='icon'></div>
                                            </span>
                                            <p>Registration Completed</p>
                                        </li>

                                        <li
                                            class="date_actv <?php if($user_info->status == 1) {echo 'enter'; $sts = 'Fill KYC Form'; }elseif($user_info->status == 2) {echo 'enter'; $sts = 'KYC verification pending'; }elseif($user_info->status >= 3){ echo "active"; $sts = 'KYC Verified successfully';} else { echo "enter";$sts = 'KYC Verification pending';} ?>">
                                            <span>
                                                <strong><?=$sts;?></strong>
                                                <div class='icon'></div>
                                            </span>
                                            <p>KYC Verification</p>
                                        </li>

                                        <li
                                            class="date_actv <?php if($app_info['certficationStatus'] == ''){ $sts = 'Fill Enterprise after verified KYC'; }elseif($app_info['certficationStatus'] <= '2') {echo 'enter'; $sts = 'My Enterprise verification pending'; }elseif($app_info['certficationStatus'] >= 3) {echo "active"; $sts = 'My Enterprise Completed Successfully';}else{echo 'date_actv'; $sts = 'My Enterprise Pending';} ?>">
                                            <span>
                                                <strong><?=$sts;?></strong>
                                                <div class='icon'></div>
                                            </span>
                                            <p>My Enterprise</p>
                                        </li>

                                        <li
                                            class="date_actv <?php if($app_info['certficationStatus'] == 2) {echo 'enter'; $sts = 'Certification pending';} elseif($app_info['certficationStatus'] == 3) {echo "active"; $sts = 'Eligibile for Certification Completed Registration';}elseif($app_info['certficationStatus'] == 5) {echo "active"; $sts = 'Certificate approved';}else{ $sts = 'Certification pending';} ?>">
                                            <span>
                                                <strong><?=$sts;?></strong>
                                                <div class='icon'></div>
                                            </span>
                                            <p>Eligibile for Certification</p>
                                        </li>
                                    </ul>
                                <div>
                            </div>
                        </section>

                        <?php if($user_info->status >= 2){ ?>

                        <section class="dash-status">
                            <h2><img src="https://xhtmlreviews.com/udyam/assets/images/cert-icon.svg" alt="logo"> Certification Status</h2>
                            <div class="dash-doc">
                                <div>
                                    <p>Application Number: <span><?php echo $app_info['certificate_num']; ?><span></p>
                                    <div class="sub-doc">
                                        <p id="<?php if(!empty($app_info['certficationStatus']) && $app_info['certficationStatus'] > 0){ echo 'ad-document'; } ?>"><img src="<?=base_url("assets/")?>images/plus-icon.png" />Add Document</p>
                                       <a href="<?= base_url('user/documents');?>"> 
                                        <div class="view-btn">
                                            <img src="<?=base_url("assets/")?>images/view-icon.png" />View</div>
                                        </a>
                                    </div>
                                </div>
                                <div class="bar-hft v2">
                                    <ul class="list-unstyled form-wizard-steps clearfix">
                                        <li class="date_actv <?php if($app_info['certficationStatus'] >= '1') echo 'active'; ?>" >
                                            <span>
                                                <strong><?php if($app_info['certficationStatus'] >= '1') { echo 'Application Submitted Successfully';} else { echo 'Submit Your Application'; } ?> </strong>
                                                <div class='icon'></div>
                                            </span>
                                            <p>Application Submitted</p>
                                        </li>
                                        <li class="date_actv <?php if($app_info['certficationStatus'] == '1' || $app_info['certficationStatus'] == '2') { echo 'enter';} elseif($app_info['certficationStatus'] >= '3') { echo 'active';} ?> ">
                                            <span>
                                                <strong><?php if($app_info['certficationStatus'] == '1' or $app_info['certficationStatus'] <= '2') { echo 'Documents verification in pending';} elseif($app_info['certficationStatus'] <= '3') { echo 'Documents verified';} else { echo 'Submit Your Application'; }  ?></strong>
                                                <div class='icon'></div>
                                            </span>
                                            <p>Documents Verification</p>
                                        </li>
                                        <li class="date_actv <?php if($app_info['certficationStatus'] == '2') { echo 'enter';} elseif($app_info['certficationStatus'] >= '3') { echo 'active';} ?>">
                                            <span>
                                                <strong><?php if($app_info['certficationStatus'] == '1' or $app_info['certficationStatus'] <= '2') { echo 'Documents verification in pending';} elseif($app_info['certficationStatus'] >= '3') { echo 'Field Verification completed';} else { echo 'Submit Your Application'; }  ?></strong>
                                                <div class='icon'></div>
                                                <p>Field Verification</p>
                                        </li>
                                        <li class="date_actv <?php if($app_info['certficationStatus'] == '3') { echo 'enter';} elseif($app_info['certficationStatus'] >= '4') { echo 'active';} ?>">
                                            <span>
                                                <strong><?php if($app_info['certficationStatus'] == '1' or $app_info['certficationStatus'] <= '2') { echo 'Documents verification in process';} elseif($app_info['certficationStatus'] == '3') { echo 'Interview in process';} elseif($app_info['certficationStatus'] >= '4') { echo 'Interview Completed';} else { echo 'Submit Your Application'; }  ?> </strong>
                                                <div class='icon'></div>
                                                <p>Interview</p>
                                        </li>
                                        <li class='date_actv <?php if($app_info['certficationStatus'] == '4') { echo 'enter';} elseif($app_info['certficationStatus'] == '5') { echo 'active';} ?>'>
                                            <span>
                                                <strong><?php if($app_info['certficationStatus'] == '1' or $app_info['certficationStatus'] <= '2') { echo 'Documents verification in pending';} elseif($app_info['certficationStatus'] == '3') { echo 'Interview in process';} elseif($app_info['certficationStatus'] == '4') { echo 'Final approval pending';} elseif($app_info['certficationStatus'] >= '5') { echo 'Certificate Approved';} else { echo 'Submit Your Application'; }  ?></strong>
                                                <div class='icon'></div>
                                                <p>Certificate</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dash-board-popup">
        <div class="container">
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
                        <label>File (File format pdf only)</label>
                        <input name="document" type="file" class="custom-file-input" accept="application/pdf" data-validation="required" style="width: auto;"/>
                    </div>
                    <input name="submit" type="submit" value="Submit" />
                </div>
            </form>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/28d7e4550d.js" crossorigin="anonymous"></script>
    <script src="<?=base_url("assets/")?>js/jquery-3.6.0.min.js"></script>
    <script src="<?=base_url("assets/")?>slick/slick.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>

    <script id="rendered-js">
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
        // setup validate
        $.validate();
    });
    </script>
 <?php $this->load->view('user-footer'); ?>
</body>

</html>