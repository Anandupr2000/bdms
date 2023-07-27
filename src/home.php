<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" style="width: 100%;">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .btn:focus {
      box-shadow: none;
    }

    .btn:hover {
      box-shadow: solid black 3px 3px;
      scale: 1.3;
      transition: 0.5s;
      content: "History";
    }

    .certification {
      display: flex;
      gap: 15px;
      justify-content: center;
      align-items: baseline;
      position: absolute;
      font-size: larger;
      rotate: -25deg;
      background: #fff;
      width: 150px;
      margin-left: -20px;
      margin-bottom: -20px;
      height: 30px;
      /* padding: 5px 20px; */
    }
  </style>
</head>

<body style="width: 100%;">
  <div class="header">
    <?php
    // setting $active as home to show user at header, that he/she is currently viewing home 
    $active = "home";
    include('head.php');
    if (isset($_SESSION['registrationStatus']) && isset($_SESSION['mailSendStatus'])) {
      echo '<script>alert("User credentials has been mailed.")</script>';
      unset($_SESSION['registrationStatus']);
      unset($_SESSION['mailSendStatus']);
    }
    ?>

  </div>
  <?php 
  include 'ticker.php'; 
  ?>

  <div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;   ">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:75px;">
        <div id="demo" class="carousel slide" data-ride="carousel">

          <!-- Indicators -->
          <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
          </ul>

          <!-- The slideshow -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="image\_107317099_blooddonor976.jpg" alt="image\_107317099_blooddonor976.jpg" width="100%">
            </div>
            <div class="carousel-item">
              <img src="image\Blood-facts_10-illustration-graphics__canteen.png" alt="image\Blood-facts_10-illustration-graphics__canteen.png" width="100%">
            </div>

          </div>

          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div>
        <br>
        <h1 style="text-align:center;font-size:45px;">Welcome to BloodBank & Donor Management System</h1>
        <br>
        <div class="row">
          <div class="col-lg-4 mb-4">
            <div class="card">
              <h4 class="card-header card bg-info text-white">The need for blood</h4>

              <p class="card-body overflow-auto" style="padding-left:2%;height:120px;text-align:left;">
                <?php
                include 'conn.php';
                $sql = $sql = "select * from pages where page_type='needforblood'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo $row['page_data'];
                  }
                }

                ?>
              </p>
            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="card">
              <h4 class="card-header card bg-info text-white">Blood Tips</h4>

              <p class="card-body overflow-auto" style="padding-left:2%;height:120px;text-align:left;">
                <?php
                include 'conn.php';
                $sql = $sql = "select * from pages where page_type='bloodtips'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo $row['page_data'];
                  }
                }

                ?>
              </p>

            </div>
          </div>
          <div class="col-lg-4 mb-4">
            <div class="card">
              <h4 class="card-header card bg-info text-white">Who you could Help</h4>

              <p class="card-body overflow-auto" style="padding-left:2%;height:120px;text-align:left;">
                <?php
                include 'conn.php';
                $sql = $sql = "select * from pages where page_type='whoyouhelp'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo $row['page_data'];
                  }
                }

                ?>
              </p>


            </div>
          </div>
        </div>

        <h2>Blood Donor Names</h2>

        <div class="row">
          <?php
          include 'conn.php';
          $sql = "select * from donor_details join blood join users where donor_details.uid=users.uid AND donor_details.donor_blood=blood.blood_id order by rand() limit 6";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
          ?>
              <div class="col-lg-4 col-sm-6 portfolio-item"><br>
                <div class="card p-2" style="width:300px">
                  <?php
                  if ($row['hascertificate']) {
                  ?>
                    <span class="certification"><i class="fa-solid fa-award"></i> <span>Certified</span></span>
                  <?php
                  }
                  ?>
                  <img class="card-img-top" src="image\blood_drop_logo.jpg" alt="Card image" style="width:100%;height:300px">
                  <div class="card-body">
                    <!-- <button title="donor history" class="float-right my-auto btn border-0 outline-0">
                      <i class="fas fa-clock"></i>
                    </button> -->
                    <h3 class="card-title"><?php echo $row['uname']; ?></h3>
                    <p class="card-text">
                      <b>Blood Group : </b> <b><?php echo $row['blood_group']; ?></b><br>
                      <b>Mobile No. : </b> <?php echo $row['donor_number']; ?><br>
                      <b>Gender : </b><?php echo $row['donor_gender']; ?><br>
                      <b>Age : </b> <?php echo $row['donor_age']; ?><br>
                      <b>Address : </b> <?php echo $row['donor_address']; ?><br>
                      <b>Fee : </b> <?php echo $row['fees']; ?><br>
                    </p>

                  </div>
                </div>
              </div>
          <?php }
          } ?>
        </div>
        <br>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
          <div class="col-lg-6">
            <h2>BLOOD GROUPS</h2>
            <p>
              <?php
              include 'conn.php';
              $sql = $sql = "select * from pages where page_type='bloodgroups'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo $row['page_data'];
                }
              }

              ?></p>

          </div>
          <div class="col-lg-6">
            <img class="img-fluid rounded" src="image\blood_donationcover.jpeg" alt="">
          </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="row mb-4">
          <div class="col-md-8">
            <h4>UNIVERSAL DONORS AND RECIPIENTS</h4>
            <p>
              <?php
              include 'conn.php';
              $sql = $sql = "select * from pages where page_type='universal'";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo $row['page_data'];
                }
              }

              ?></p>
          </div>
          <?php
          if (isset($_SESSION['loggedin'])) {
          ?>
            <div class="col-md-4">
              <a class="btn btn-lg btn-secondary btn-block" href="donate_blood.php" style="align:center; background-color:#7FB3D5;color:#273746 ">Become a Donor </a>
            </div>
          <?php
          }
          ?>
        </div>

      </div>
    </div>
    <?php include('footer.php'); ?>
  </div>

</body>

</html>