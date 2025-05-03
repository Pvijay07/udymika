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
        <?php $this->load->view('admin/menus'); ?>

        <div class="dashboard-main-ryt">
          <?php $this->load->view('admin/header'); ?>
          <div class="dash-seections">
        
              <section class="dash-grev ">
                <div class="dash_cate" id="l1assign">
                  <p>Level-1</p>
                  <div class="qyr">
                    <span>
                      <?= $L1; ?>
                    </span>
                    <div class="icn-dv">
                      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
                              C210.84,248.42,233.08,270.66,260.96,270.69z" />
                          <path d="M453.91,59.46c8.49,8.49,16.36,16.36,24.73,24.73c-31.15,31.14-62.55,62.51-93.73,93.67
                              c-22.44-22.46-44.42-44.46-66.01-66.08c7.54-7.51,15.49-15.42,23.6-23.51c13.36,13.37,27.33,27.36,41.26,41.29
                              C407.38,105.96,430.69,82.67,453.91,59.46z" />
                        </g>
                      </svg>
                    </div>
                  </div>
                </div>
                <div class="dash_cate" id="l2assign">
                  <p>Level-2</p>
                  <div class="qyr">
                    <span>
                      <?= $L2; ?>
                    </span>
                    <div class="icn-dv">
                      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
                                  C210.84,248.42,233.08,270.66,260.96,270.69z" />
                          <path d="M453.91,59.46c8.49,8.49,16.36,16.36,24.73,24.73c-31.15,31.14-62.55,62.51-93.73,93.67
                                  c-22.44-22.46-44.42-44.46-66.01-66.08c7.54-7.51,15.49-15.42,23.6-23.51c13.36,13.37,27.33,27.36,41.26,41.29
                                  C407.38,105.96,430.69,82.67,453.91,59.46z" />
                        </g>
                      </svg>
                    </div>
                  </div>
                </div>
                <div class="dash_cate" id="l3assign">
                  <p>Level-3</p>
                  <div class="qyr">
                    <span>
                      <?= $L3; ?>
                    </span>
                    <div class="icn-dv">

                      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
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
                                  C210.84,248.42,233.08,270.66,260.96,270.69z" />
                          <path d="M453.91,59.46c8.49,8.49,16.36,16.36,24.73,24.73c-31.15,31.14-62.55,62.51-93.73,93.67
                                  c-22.44-22.46-44.42-44.46-66.01-66.08c7.54-7.51,15.49-15.42,23.6-23.51c13.36,13.37,27.33,27.36,41.26,41.29
                                  C407.38,105.96,430.69,82.67,453.91,59.46z" />
                        </g>
                      </svg>

                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
      </div>
    </div>



    <?php $this->load->view('admin/footer'); ?>

    <script src="<?= base_url("assets/") ?>js/raphael-min.js"></script>
    <script src="<?= base_url("assets/") ?>js/morris.min.js"></script>
</body>

</html>
<script>
  $(function() {
    $('.dashboardCls').removeClass('active');
    $('.kycCls').removeClass('active');
    $('.certificateCls').removeClass('active');
    $('.grievanceCls').addClass('active');
    $('.subAdminCls').removeClass('active');
    $('.checklistCls').removeClass('active');
  });


  document.getElementById('l1assign').onclick = function() {
    window.location.href = '<?php echo base_url() ?>grievance_l1';
  }

  document.getElementById('l2assign').onclick = function() {
    window.location.href = '<?php echo base_url() ?>grievance_l2';
  }

  document.getElementById('l3assign').onclick = function() {
    window.location.href = '<?php echo base_url() ?>grievance_l3';
  }
</script>