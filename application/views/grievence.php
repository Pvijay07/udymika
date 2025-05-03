<!doctype html>
 
<html lang="en"> 
 
  <head> 

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">

    <!-- favicon -->

    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- css includes -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="slick/slick.css">

    <link rel="stylesheet" href="slick/slick-theme.css">

    <link rel="stylesheet" href="css/styles.css">

    <link rel="stylesheet" href="css/responsive.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap.min.css">

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>

    <title></title>

  </head>

  <body>

    <div class="dashboard-page grievance-page">

      <div class="container">

        <div class="dashboard-main">

          <div class="dashboard-main-lft">

            <div class="dashboard-main-lft-logo">

              <img src="images/main-logo.png" alt="logo" />

            </div>

            <div class="search-icon">

              <input type="search" placeholder="Search" />

            </div>

             <div class="dash-categories">

              <ul>

                <li>

                  <a href="#">

                    <img src="images/profile-icon.png" alt="icons" /> Profile

                  </a>

                </li>

                <li>

                  <a href="#">

                    <img src="images/dashboard-icon.png" alt="icons" /> Dashboard 

                  </a>

                  <div>

                     <p>09</p>

                  </div>

                 </li>

                <li>

                  <a href="#">

                    <img src="images/certif-icon.png" alt="icons" /> Certification

                  </a>

                </li>

                <li class="active">

                  <a href="#">

                    <img src="images/grev-icon.png" alt="icons" /> Raise a Query</a>

                  </li>

                <li>

                  <a href="#">

                    <img src="images/meeting-icon.png" alt="icons" /> Meetings

                  </a>

                </li>

                <li>

                  <a href="#">

                    <img src="images/document-icon.png" alt="icons" /> Documents

                  </a>

                </li>

              </ul>

            </div>

            <div class="appli-status">

              <div class="range-child-sec">

                <div role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="--value:80; background: 

                      radial-gradient(closest-side, #FFF3F7 80%, transparent 0 99.9%, white 0),

                          conic-gradient(#C73866 calc(var(--pgPercentage) * 1%), var(--bg) 0)

                        ;;color: #000;">

                </div>

              </div>

              <h5>Application Status</h5>

              <p>You have finished 80% of your application. Need any Help?</p>

            </div>

            <div class="users-dash">

              <ul>

                <li>

                  <div style="width:40px;height: 40px;">

                    <img src="images/user-image.png" alt="img" style="border-radius:50%;" />

                  </div>

                  <div style="width: 145px; overflow: hidden;">

                    <h6>Disha Gupta</h6>

                    <p>Disha@gmail.com</p>

                  </div>

                  <div style="width: 15px;height: 15px;">

                    <img src="images/share-icon.png" alt="img" />

                  </div>

                </li>

              </ul>

            </div>

          </div>



          <div class="dashboard-main-ryt">

            <header>

              <div class="users-dash">

                <ul>

                  <li>

                    <div style="width: 145px; overflow: hidden;">

                      <h6>Disha Gupta</h6>

                      <p>Disha@gmail.com</p>

                    </div>

                    <div style="width: 15px;height: 15px;">

                      <img src="images/share-icon.png" alt="img">

                    </div>

                  </li>

                </ul>

              </div>

              <!-- <a href=""><i class="fa-solid fa-arrow-up-right-from-square"></i> Navigate Application</a> -->

            </header>

            <div class="dash-seections doc-download">

              <div class="sort-filter">

                <a id="raise-grev" href="#"><img src="images/plus-icon.png" />Raise New Query</a>

                <strong>Sort by <img src="images/sort-icon.png" /></strong>

              </div>

              <div class="sort-sec-cord">

                

                <div class="sort-cords">

                  <h6>#GUDY0822001 <span class="forum-pop"><img src="images/message-icon.png"></span></h6>

                  <p>Query Type: <span>Certification</span></p>

                  <p>Date of Submission: <span> 08/08/2022</span></p>

                  <div>

                    <p>Query Raised</p>

                    <strong>View Report</strong>

                  </div>

                </div>

                <div class="sort-cords">

                  <h6>#GUDY0822001 <span class="forum-pop"><img src="images/message-icon.png"></span></h6>

                  <p>Query Type: <span>Certification</span></p>

                  <p>Date of Submission: <span> 08/08/2022</span></p>

                  <div>

                    <p>In Progress</p>

                    <strong>View Report</strong>

                  </div>

                </div>

                <div class="sort-cords">

                  <h6>#GUDY0822001 <span class="forum-pop"><img src="images/message-icon.png"></span></h6>

                  <p>Query Type: <span>Certification</span></p>

                  <p>Date of Submission: <span> 08/08/2022</span></p>

                  <div>

                    <p>Query Closed</p>

                    <strong>View Report</strong>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>





      <div class="grev-raise_pop">

        <div class="container">

          <div class="new-doc">

            <h2>Submit a ticket</h2>

            <a href=""><i class="fa-solid fa-x"></i></a>

          </div>

          <div class="doc-sub">

            <div class="doc-sub-form">

              <label>Query Type</label>

              <input type="text" placeholder="Query Type" />

            </div>

            <div class="doc-sub-form">

              <label>Subject</label>

              <input type="text" placeholder="Subject" />

            </div>

            <div class="doc-sub-form">

              <label>File</label>

              <input type="file" class="custom-file-input">

            </div>

            <div class="doc-sub-form">

              <label>Description</label>

              <textarea></textarea>

            </div>

            <input type="submit" value="Submit"></input>

          </div>

        </div>

      </div>   



    <div class="query-forum">

      <div class="container">

        <div class="new-doc">

          <h2>Query Forum</h2>

          <a href=""><i class="fa-solid fa-x"></i></a>

        </div>

        <div class="query-form">

          <div class="query-cht">

            <div class="cht-img">

              <img src="images/logo-cht-icon.png" alt="" />

            </div>

            <div>

              <p>How was your conversation experience with us? Your feedback will help us serve you better</p>

              <strong>Updated on 01-09-2022</strong>

           </div>

          </div> 

          <div class="query-cht query-chts">

            <div class="cht-img">

              <img src="images/logo-cht-icon.png" alt="" />

            </div>

            <div>

              <p>How was your conversation experience with us? Your feedback will help us serve you better</p>

              <strong>Updated on 01-09-2022</strong>

           </div>

          </div> 

          

          <div class="cht-submit">

            <a class="cht-experience" href="#"><img src="images/right-arrow.png" /></a>

           <textarea></textarea>

           <input type="submit" value="Submit" />

           <div></div>

          </div>

        </div>

      </div>

    </div> 



    <div class="experience-con">

       <div class="new-doc">

          <a href=""><i class="fa-solid fa-x"></i></a>

        </div>

      <h5>How was your conversation experience with us?</h5>

      <p>Your feedback will help us serve you better</p>

      <div class="like-btns">

        <div >

          <img src="images/like-icon.jpg" />

        </div>

        <div>

          <img src="images/dis-like.jpg" />

        </div>

      </div>

      <a href="#">SKIP THIS STEP</a>

    </div>   





    </div>

    <script src="https://kit.fontawesome.com/28d7e4550d.js" crossorigin="anonymous"></script>

    <script src="js/jquery-3.6.0.min.js"></script>

    <script src="js/main.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js'></script>



       <script id="rendered-js" >

 

//# sourceURL=pen.js

    </script>

   



  </body>

</html>