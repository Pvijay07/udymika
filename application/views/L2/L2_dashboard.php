<?php $this->load->view('admin/head'); ?>
<link rel="stylesheet" href="<?= base_url("assets/") ?>css/morris.css" />

<style>
  .morris-hover {
    position: absolute;
    z-index: 1000;
  }

  .morris-hover.morris-default-style {
    border-radius: 10px;
    padding: 6px;
    color: #666;
    background: rgba(255, 255, 255, 0.8);
    border: solid 2px rgba(230, 230, 230, 0.8);
    font-family: sans-serif;
    font-size: 12px;
    text-align: center;
  }

  .morris-hover.morris-default-style .morris-hover-row-label {
    font-weight: bold;
    margin: 0.25em 0;
  }

  .morris-hover.morris-default-style .morris-hover-point {
    white-space: nowrap;
    margin: 0.1em 0;
  }

  /*svg { width: 100%; }*/
  .ad-dash-charts {
    border-top: 1px solid #C73866;
    padding-top: 72px;
  }

  .stats-bar {
    padding: 14px 30px 48px;
    background: #FFFFFF;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.25);
    border-radius: 8px;
    margin-bottom: 15px;
  }

  .stats-bar h6 {
    margin-bottom: 26px;
  }

  .stats-bar p {
    font-weight: 400;
    font-size: 60px;
    line-height: 73px;
    color: #C73866;
  }

  .stats-bar p span {
    font-weight: 400;
    font-size: 13px;
    line-height: 16px;
    color: #617087;
    display: block;
  }

  .statistics-info {
    display: flex;
    justify-content: flex-start;
  }

  .statistics-info>div {
    margin-right: 45px;
    margin-left: 25px;
  }

  .ad-dash-charts {
    display: flex;
  }

  .ad-dash-charts-left {
    flex: 0 0 55%;
    max-width: 59%;
    border-radius: 8px;
    margin-right: 20px;
  }

  .ad-dash-charts-right {
    flex: 0 0 43%;
    max-width: 40%;
    float: right;
  }

  .ad-dash-charts {
    height: 300px;
    padding: 15px 2px 37px;
    background: #FFFFFF;
    box-shadow: 0px 5px 10px rgb(0 0 0 / 25%);
    border-radius: 8px;
    margin-bottom: 15px;
    width: fit-content;
    margin-top: 20px;
  }

  .holder {
    height: 6.61px;
    margin: 10px auto;
    display: flex;
    align-items: center;
  }

  .bar {
    background: #F0A144;
    height: 6.61px;
    width: 0;
    transition: width 2s, background .2s;
  }

  .bar2 {
    background: #DC658A;
    ;
  }

  .sector-analysis {
    padding: 22px;
    background: #FFFFFF;
    box-shadow: 0px 5px 10px rgb(0 0 0 / 25%);
    border-radius: 8px;
    position: relative;
  }

  .sector-analysis h6 {
    margin-bottom: 22px;
    font-weight: 400;
    font-size: 15px;
    line-height: 18px;
    color: #848484;
  }

  .fillmult span {
    max-width: 120px;
    flex: 0 0 120px;
    font-weight: 400;
    font-size: 11px;
    line-height: 10px;
    color: #848484;
  }

  .fillmult {
    height: 6.62px;
    width: 0;
    background-color: #F0A144;
    border-radius: 4px;
    text-align: left;
  }

  .fillmult span {
    padding-left: 10px;
  }

  .progressbar-ad {
    display: flex;
    max-width: 70%;
    align-items: center;
    margin-left: auto;
    margin-bottom: 22px;
  }

  .fillmult span {
    position: absolute;
    left: 10px;
  }

  span.perc {
    position: absolute;
    right: 20px;
    font-weight: 700;
    font-size: 8px;
    line-height: 10px;
    color: #848484;
  }

  .morris-hover.morris-default-style {
    display: none !important;
  }
</style>

<body>
  <div class="dashboard-page admin_twelve">
    <div class="container">
      <div class="dashboard-main">
        <?php $this->load->view('L2/Lvl2_menus'); ?>

        <div class="dashboard-main-ryt">
          <?php $this->load->view('L2/header'); ?>


          <div class="dash-seections">
            <section class="dash-grev">

              <div class="dash_cate">
                <p>Received</p>
                <div class="qyr">
                  <span><?= $grievence; ?></span>
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
              <div class="dash_cate">
                <p>Assign To L1</p>
                <div class="qyr">
                  <span><?= $l1; ?></span>
                  <div class="icn-dv">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                      <g>
                        <path d="M43.51,245.81c1.11-7.81,2.05-15.65,3.37-23.43c6.09-35.85,20.54-68.07,43.18-96.45c33.66-42.19,76.97-69,130.01-79.46
                          c35.8-7.06,71.19-4.53,106,6.38c0.37,0.11,0.71,0.31,1.42,0.62c-1.06,1.17-1.94,2.23-2.9,3.2c-6.3,6.32-12.96,12.32-18.8,19.04
                          c-3.97,4.57-7.89,5.2-13.64,4.26c-50.22-8.22-96.44,1.86-137.89,31.7c-33.46,24.08-57.11,55.73-68.54,95.39
                          c-18.32,63.62-5.68,121.27,36.12,172.55c0.25,0.31,0.63,0.52,1.18,0.95c11.68-45.15,38.56-77.63,80.83-97.83
                          c-20.65-19.97-29.86-44.22-26.63-72.54c2.52-22.14,12.91-40.48,30.06-54.79c33.21-27.73,82.88-25.22,113.52,5.45
                          c31.21,31.23,35.11,85.93-2.62,122.05c20.33,9.25,37.68,22.28,51.81,39.4c14.08,17.05,23.61,36.45,28.96,58.81
                          c3.75-4.69,7.22-8.68,10.3-12.95c15.97-22.08,26.89-46.49,31.83-73.26c6.82-36.94,3.16-72.94-12.02-107.49
                          c-1.49-3.39-1.27-5.39,1.46-7.98c7.47-7.1,14.61-14.55,22.09-22.07c10.56,19.56,18.13,39.62,21.76,60.91
                          c14.08,82.49-9.77,152.12-72.46,207.67c-32.08,28.43-70.18,44.92-112.68,49.91C183.86,488.21,96.99,430.78,60.19,344.36
                          c-8.92-20.94-14.26-42.83-15.89-65.59c-0.08-1.08-0.52-2.14-0.79-3.21C43.51,265.65,43.51,255.73,43.51,245.81z M260.62,444.18
                          c7.47-0.64,14.96-1.11,22.41-1.93c30.43-3.34,57.97-14.34,83.01-31.76c1.08-0.75,1.92-2.75,1.84-4.11
                          c-0.88-15.88-4.79-31.01-12.61-44.89c-18.78-33.31-47.38-52.46-85.38-55.95c-31.1-2.85-58.67,6.94-81.69,28.24
                          c-20.98,19.41-32.12,43.7-34.06,72.17c-0.11,1.56,0.97,3.87,2.25,4.77C187.65,432.61,222.52,443.33,260.62,444.18z M260.96,270.69
                          c27.75,0.03,50.29-22.38,50.33-50.03c0.04-27.64-22.49-50.38-50.04-50.5c-27.84-0.13-50.47,22.48-50.44,50.4
                          C210.84,248.42,233.08,270.66,260.96,270.69z"/>
                        <path d="M453.91,59.46c8.49,8.49,16.36,16.36,24.73,24.73c-31.15,31.14-62.55,62.51-93.73,93.67
                          c-22.44-22.46-44.42-44.46-66.01-66.08c7.54-7.51,15.49-15.42,23.6-23.51c13.36,13.37,27.33,27.36,41.26,41.29
                          C407.38,105.96,430.69,82.67,453.91,59.46z"/>
                      </g>
                      </svg>

                  </div>
                </div>
              </div>
              <div class="dash_cate">
                <p>Assign To L3</p>
                <div class="qyr">
                  <span><?= $l3; ?></span>
                  <div class="icn-dv">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                      <g>
                        <path d="M43.51,245.81c1.11-7.81,2.05-15.65,3.37-23.43c6.09-35.85,20.54-68.07,43.18-96.45c33.66-42.19,76.97-69,130.01-79.46
                          c35.8-7.06,71.19-4.53,106,6.38c0.37,0.11,0.71,0.31,1.42,0.62c-1.06,1.17-1.94,2.23-2.9,3.2c-6.3,6.32-12.96,12.32-18.8,19.04
                          c-3.97,4.57-7.89,5.2-13.64,4.26c-50.22-8.22-96.44,1.86-137.89,31.7c-33.46,24.08-57.11,55.73-68.54,95.39
                          c-18.32,63.62-5.68,121.27,36.12,172.55c0.25,0.31,0.63,0.52,1.18,0.95c11.68-45.15,38.56-77.63,80.83-97.83
                          c-20.65-19.97-29.86-44.22-26.63-72.54c2.52-22.14,12.91-40.48,30.06-54.79c33.21-27.73,82.88-25.22,113.52,5.45
                          c31.21,31.23,35.11,85.93-2.62,122.05c20.33,9.25,37.68,22.28,51.81,39.4c14.08,17.05,23.61,36.45,28.96,58.81
                          c3.75-4.69,7.22-8.68,10.3-12.95c15.97-22.08,26.89-46.49,31.83-73.26c6.82-36.94,3.16-72.94-12.02-107.49
                          c-1.49-3.39-1.27-5.39,1.46-7.98c7.47-7.1,14.61-14.55,22.09-22.07c10.56,19.56,18.13,39.62,21.76,60.91
                          c14.08,82.49-9.77,152.12-72.46,207.67c-32.08,28.43-70.18,44.92-112.68,49.91C183.86,488.21,96.99,430.78,60.19,344.36
                          c-8.92-20.94-14.26-42.83-15.89-65.59c-0.08-1.08-0.52-2.14-0.79-3.21C43.51,265.65,43.51,255.73,43.51,245.81z M260.62,444.18
                          c7.47-0.64,14.96-1.11,22.41-1.93c30.43-3.34,57.97-14.34,83.01-31.76c1.08-0.75,1.92-2.75,1.84-4.11
                          c-0.88-15.88-4.79-31.01-12.61-44.89c-18.78-33.31-47.38-52.46-85.38-55.95c-31.1-2.85-58.67,6.94-81.69,28.24
                          c-20.98,19.41-32.12,43.7-34.06,72.17c-0.11,1.56,0.97,3.87,2.25,4.77C187.65,432.61,222.52,443.33,260.62,444.18z M260.96,270.69
                          c27.75,0.03,50.29-22.38,50.33-50.03c0.04-27.64-22.49-50.38-50.04-50.5c-27.84-0.13-50.47,22.48-50.44,50.4
                          C210.84,248.42,233.08,270.66,260.96,270.69z"/>
                        <path d="M453.91,59.46c8.49,8.49,16.36,16.36,24.73,24.73c-31.15,31.14-62.55,62.51-93.73,93.67
                          c-22.44-22.46-44.42-44.46-66.01-66.08c7.54-7.51,15.49-15.42,23.6-23.51c13.36,13.37,27.33,27.36,41.26,41.29
                          C407.38,105.96,430.69,82.67,453.91,59.46z"/>
                      </g>
                      </svg>

                  </div>
                </div>
              </div>
              <div class="dash_cate">
                <p>Resolved</p>
                <div class="qyr">
                  <span><?= $close; ?></span>
                  <div class="icn-dv">
                  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                      viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
                      <path d="M258.19,34.26c3.17,2.33,4.28,5.44,4.24,9.38c-0.16,12.94-0.05,25.89-0.07,38.84c0,1.3,0.01,2.65-0.3,3.89
                        c-0.82,3.34-3.05,5.4-6.49,5.4c-3.44,0-5.67-2.05-6.48-5.4c-0.3-1.25-0.3-2.59-0.3-3.89c-0.02-12.95,0.09-25.89-0.07-38.84
                        c-0.05-3.94,1.04-7.05,4.23-9.38C254.69,34.26,256.44,34.26,258.19,34.26z"/>
                      <path d="M199.43,363.39c1.42,0,2.99,0,4.57,0c34.96,0,69.93-0.04,104.89,0.07c3.4,0.01,5.02-0.64,5.82-4.37
                        c2.56-11.87,9.39-21.52,17.48-30.24c10.72-11.56,20.97-23.37,27.95-37.73c32.77-67.42-3.83-148.17-75.89-167.22
                        c-52.17-13.79-108.16,12.02-132.66,61.14c-0.32,0.65-0.61,1.32-0.95,1.96c-2.33,4.43-5.96,5.94-9.6,4.02
                        c-3.53-1.87-4.82-5.7-2.34-9.78c5.8-9.55,11.17-19.55,18.26-28.09c21.33-25.69,48.98-40.87,82.09-45.23
                        c61.39-8.07,120.58,29.17,139.48,88.79c15.74,49.66,5.41,94.4-29.38,133.37c-5.04,5.64-10.09,11.31-14.6,17.36
                        c-5.71,7.67-8.35,16.47-8.18,26.15c0.21,12.23,0,24.48,0.21,36.71c0.22,12.58-4.46,22.72-14.63,30.06c-2.5,1.81-2.1,3.92-2.03,6.12
                        c0.42,12.07-3.88,21.91-13.66,29.13c-5.53,4.08-11.78,6.2-18.72,6.19c-13.69-0.02-27.39,0.04-41.08-0.02
                        c-17.68-0.07-31.91-13.93-32.51-31.57c-0.04-1.31-0.22-2.64-0.04-3.93c0.42-3.06-0.78-4.92-3.28-6.84
                        c-8.52-6.58-13.15-15.37-13.36-26.27c-0.24-12.53-0.73-25.06-0.53-37.58c0.19-11.37-3.48-21.17-10.62-29.7
                        c-7.76-9.26-16.42-17.8-23.7-27.4c-19.85-26.17-28.53-55.9-26.31-88.72c0.36-5.36,1.11-10.7,1.92-16.01
                        c0.61-3.98,3.8-6.48,7.23-6.1c3.83,0.43,6.1,3.37,5.82,7.8c-0.58,9.13-1.96,18.27-1.75,27.38c0.66,29.06,11.18,54.37,30.57,75.99
                        c4.18,4.66,8.63,9.08,12.77,13.78C191.55,342.73,194.98,349.12,199.43,363.39z M200.61,398.58c1.99,0,3.56,0,5.14,0
                        c19.08,0,38.15,0,57.23,0c1.46,0,2.92-0.05,4.36,0.08c3.71,0.34,6.36,3.1,6.34,6.51c-0.02,3.34-2.77,6.25-6.36,6.62
                        c-1.15,0.12-2.33,0.04-3.49,0.04c-19.51,0-39.02,0-58.54,0c-1.55,0-3.1,0-4.64,0c-0.05,11.97,8.51,21.39,20.59,21.61
                        c23.73,0.43,47.47,0.43,71.2,0.01c12.27-0.22,21.61-10.6,20.36-21.62c-4.59,0-9.23,0.04-13.87-0.01c-4.9-0.05-7.99-2.71-7.95-6.75
                        c0.04-3.94,2.87-6.4,7.67-6.48c4.76-0.08,9.52-0.02,14.34-0.02c0-7.49,0-14.4,0-21.43c-37.61,0-74.93,0-112.39,0
                        C200.61,384.27,200.61,391.08,200.61,398.58z M296.44,447.07c-26.6,0-52.88,0-79.14,0c-0.76,11.89,7.51,21.27,19.26,21.51
                        c13.54,0.27,27.08,0.27,40.62,0C288.93,468.35,297.21,458.94,296.44,447.07z"/>
                      <path d="M253.53,271.6c-1.31,1.68-2.85,3.55-4.71,4.36c-3.3,1.45-6.05-0.07-8.43-2.74c-9.11-10.21-18.23-20.43-27.64-30.36
                        c-1.79-1.89-4.97-3.54-7.41-3.41c-2.21,0.12-5.02,2.39-6.23,4.49c-1.68,2.91-0.63,6.17,1.76,8.8c8.13,8.94,16.22,17.92,24.33,26.88
                        c5.08,5.62,10.13,11.26,15.24,16.85c4.74,5.18,9.57,5.01,13.89-0.51c8.15-10.44,16.23-20.94,24.38-31.37
                        c3.08-3.94,7.5-4.58,10.52-1.54c2.8,2.81,2.88,5.98,0.51,9.05c-8.9,11.52-17.64,23.17-26.89,34.4c-7.51,9.1-22.24,9.57-30.33,0.89
                        c-14.4-15.44-28.55-31.11-42.47-46.99c-7.88-8.99-6.69-21.52,2.05-29.35c8.53-7.64,21.27-7.08,29.47,1.46
                        c4.13,4.3,8.02,8.85,12.02,13.27c3.99,4.41,8,8.82,12.46,13.72c11.07-14.26,21.77-28.04,32.46-41.82
                        c3.21-4.14,6.38-8.32,9.64-12.42c7.51-9.43,20.27-11.25,29.55-4.27c9.51,7.17,11.31,19.95,4.04,29.84
                        c-3.97,5.39-8.13,10.64-12.31,15.87c-2.99,3.75-6.7,4.49-9.85,2.19c-3.39-2.47-3.68-6.26-0.63-10.32
                        c3.5-4.65,7.11-9.22,10.67-13.83c4.06-5.25,4.08-9.99,0.08-12.99c-4.07-3.05-8.26-1.84-12.49,3.61"/>
                      <path d="M66.62,258.73c-6.68,0-13.37,0.03-20.05-0.01c-5.76-0.04-8.71-2.42-8.66-6.88c0.05-4.28,2.93-6.64,8.42-6.66
                        c13.51-0.04,27.02-0.04,40.54,0c5.27,0.02,8.51,2.59,8.6,6.63c0.08,4.16-3.3,6.87-8.79,6.9C79.99,258.77,73.3,258.73,66.62,258.73z
                        "/>
                      <path d="M444.36,245.17c6.83,0,13.66-0.05,20.49,0.01c5.46,0.05,8.35,2.43,8.37,6.71c0.02,4.31-2.89,6.8-8.28,6.82
                        c-13.66,0.05-27.31,0.06-40.97,0c-5.11-0.02-8.42-2.91-8.3-6.95c0.12-3.91,3.28-6.52,8.22-6.57
                        C430.7,245.12,437.53,245.17,444.36,245.17z"/>
                      <path d="M145.21,134.35c-1.77,2.01-3.08,4.75-5.1,5.45c-2.01,0.7-5.39,0.13-7.02-1.24c-4.78-4.01-8.99-8.71-13.42-13.14
                        c-5.77-5.77-11.56-11.51-17.29-17.32c-3.24-3.29-3.51-7.31-0.84-10.05c2.68-2.75,6.85-2.62,10.07,0.57
                        c10.04,9.94,20.04,19.93,29.96,29.99C142.92,129.98,143.7,131.93,145.21,134.35z"/>
                      <path d="M405.14,95.16c2.05,1.62,4.48,2.65,5.29,4.42c0.83,1.81,0.23,4.38-0.1,6.56c-0.13,0.85-1.19,1.61-1.9,2.32
                        c-9.67,9.69-19.34,19.39-29.05,29.05c-3.95,3.92-7.57,4.23-10.63,1.04c-2.95-3.08-2.63-6.52,1.13-10.31
                        c9.76-9.81,19.53-19.62,29.4-29.32C400.73,97.49,402.77,96.66,405.14,95.16z"/>
                      <path d="M106.05,408.64c-2.03-1.59-4.97-2.76-5.4-4.53c-0.58-2.4-0.1-6.02,1.45-7.8c5.14-5.93,10.96-11.26,16.53-16.83
                        c4.53-4.53,9.02-9.11,13.61-13.58c3.51-3.42,7.05-3.61,10-0.72c2.95,2.89,2.87,6.56-0.54,10c-9.94,10.05-19.93,20.04-30,29.95
                        C110.32,406.46,108.38,407.21,106.05,408.64z"/>
                      <path d="M372.88,362.31c2.36,1.33,4.26,1.94,5.52,3.18c10.28,10.11,20.49,20.3,30.63,30.56c3.04,3.07,3.14,7.09,0.58,9.76
                        c-2.67,2.79-6.81,2.68-10.06-0.53c-10.14-10.04-20.33-20.05-30.18-30.39c-1.55-1.62-2.3-5.11-1.74-7.31
                        C368.16,365.57,370.95,364.14,372.88,362.31z"/>
                    </g>
                    </svg>


                  </div>
                </div>
              </div>
            </section>

            <div class="ad-dash-charts-right">
              <div class="stats-bar">
                <h6>Statistics</h6>
                <div class="statistics-info">
                  <div>
                    <p><?= $close; ?><span>Query Raised Resolved</span></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="sector-analysis">
              <h6>Query-wise Analysis</h6>
              <?php
              $sector_list = ["Certification", "FMCG Launch Pad", "Student Entrepreneurship", "Social Impact& Entrepreneurship", "Credit Linkage", "Market Linkage", "Application"];
              foreach ($sector_list as $key => $sector) {
                $total =  $this->db->query("SELECT COUNT(l2_grievance.id) as totalSector FROM l2_grievance")->row_array()['totalSector'];
              }

              ?>
              <div class="progressbar-ad">
                <div class="fillmult" data-width="<?php echo $total ? $total : '0'; ?>%" style="width: <?php echo $total ? $total : '0'; ?>%;">
                  <span><b><?php echo $sector; ?></b></span>
                </div><span class="perc"><?php echo $total ? $total : '0'; ?>%</span>
              </div>
            </div>
            <div class="sector-analysis">
              <h6>Subquery-wise Analysis</h6>
              <?php
              $sector_list2 = ["Field Verification", "Interview", "Product Development& Diversification", "Food Testing", "Catalogue", "Barcoding", "Branding", "Packaging", "Student", "School", "College", "Other"];
              foreach ($sector_list as $key => $sector2) {
                $query =  $this->db->query("SELECT COUNT(l2_grievance.id) as totalSector FROM l2_grievance WHERE l2_grievance.subject = '$sector2' GROUP BY l2_grievance.subject");
                $result = $query->row_array();

                if ($result !== null) {
                  $total2 = $result['totalSector'];
                } else {
                  $total2 = 0; // or any default value you want to use when no result is found
                }
              }
              ?>
              <div class="progressbar-ad">
                <div class="fillmult" data-width="<?php echo $total2 ? $total2 : '0'; ?>%" style="width: <?php echo $total2 ? $total2 : '0'; ?>%;">
                  <span><b><?php echo $sector2; ?></b></span>
                </div><span class="perc"><?php echo $total2 ? $total2 : '0'; ?>%</span>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <?php $this->load->view('admin/footer'); ?>

  <script src="<?= base_url("assets/") ?>js/raphael-min.js"></script>
  <script src="<?= base_url("assets/") ?>js/morris.min.js"></script>
</body>

</html>

<script id="rendered-js">
  $(document).ready(function() {
    barChart();


    $(window).resize(function() {
      window.barChart.redraw();

    });
  });

  function barChart() {
    window.barChart = Morris.Bar({
        element: 'bar-chart',
        data: [
          <?php
          $admin_id = $this->session->userdata('admin_id');
          $months = array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec');
          foreach ($months as $key => $value) {
            $mnt = date('2022') . '-' . $key;
            $dt = date('Y-m', strtotime($mnt));
            $totApp = $this->db->query("SELECT COUNT(id) as totalApprov FROM option3 WHERE certficationStatus = '5' AND applyMonth = '$dt'")->row_array()['totalApprov'];
            $totRej = $this->db->query("SELECT COUNT(id) as totalApprov FROM option3 WHERE certficationStatus = '6' AND applyMonth = '$dt'")->row_array()['totalApprov'];
          ?> {
            <?php
          }
            ?> {
              y: 'Jan',
              a: 100,
              b: 90
            }, {
              y: 'Feb',
              a: 75,
              b: 65
            }, {
              y: 'Mar',
              a: 50,
              b: 40
            }, {
              y: 'Apr',
              a: 75,
              b: 65
            }, {
              y: 'May',
              a: 50,
              b: 40
            }, {
              y: 'Jun',
              a: 75,
              b: 65
            }, {
              y: 'Jul',
              a: 72,
              b: 65
            }, {
              y: 'Aug',
              a: 70,
              b: 65
            }, {
              y: 'Sept',
              a: 71,
              b: 65
            }, {
              y: 'Oct',
              a: 74,
              b: 65
            }, {
              y: 'Nov',
              a: 75,
              b: 65
            }, {
              y: 'Dec',
              a: 100,
              b: 90
            }
            ],

            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Series A', 'Series B'],
            lineWidth: '3px',
            resize: true,
            hideHover: 'auto',
            redraw: true
        });

    }


    $('.progressbar-ad > div').each(function() {
      var width = $(this).data('width');
      $(this).animate({
        width: width
      }, 2500);
      $(this).after('<span class="perc">' + width + '</span>');
      $('.perc').delay(3000).fadeIn(1000);
    });
</script>
<?php if (!empty($this->session->flashdata('met_msg'))) { ?>
  <script>
    $.notify("<?php echo $this->session->flashdata('met_msg'); ?>", {
      'className': 'success',
      'position': 'top left',
      'autoHideDelay': 1500
    });
  </script>
<?php } ?>

<script>
  $(function() {
    $('.dashboardCls').addClass('active');
    $('.kycCls').removeClass('active');
    $('.certificateCls').removeClass('active');
    $('.grievanceCls').removeClass('active');
    $('.subAdminCls').removeClass('active');
    $('.checklistCls').removeClass('active');
  });
</script>