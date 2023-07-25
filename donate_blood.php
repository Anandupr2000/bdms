<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <?php

  // setting $active as donate to show user at header, that he/she is currently viewing donate page 
  $active = 'donate';
  include('head.php') ?>

  <div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:50px;">
        <div class="row">
          <div class="col-lg-6">
            <h1 class="mt-4 mb-3">Donate Blood </h1>
          </div>
        </div>
        <form name="donor" action="savedata.php" method="post">
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Full Name</div>
              <div><input type="text" name="fullname" value="<?php echo $_SESSION['username']?>" class="form-control" disabled></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
              <div><input type="number" name="mobileno" class="form-control" required></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Email Id</div>
              <div><input type="email" name="emailid" value="<?php echo $_SESSION['user']['email']?>" class="form-control"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2 mb-4">
              <div class="font-italic">Age<span style="color:red">*</span></div>
              <div><input type="text" name="age" class="form-control" required></div>
            </div>
            <div class="col-sm-2 mb-4">
              <div class="font-italic">Fees<span style="color:red">*</span></div>
              <div>
                <select name="fee" class="form-control" required>
                  <option value=0 selected>0</option>
                  <option value=100>100</option>
                  <option value=200>200</option>
                  <option value=300>300</option>
                  <option value=400>400</option>
                  <option value=500>500</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2 mb-4">
              <div class="font-italic">Gender<span style="color:red">*</span></div>
              <div><select name="gender" class="form-control" required>
                  <option value="">Select</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2 mb-4">
              <div class="font-italic">Blood Group<span style="color:red">*</span></div>
              <div><select name="blood" class="form-control" required>
                  <option value="" selected disabled>Select</option>
                  <?php
                  include 'conn.php';
                  $sql = "select * from blood";
                  $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <option value=" <?php echo $row['blood_id'] ?>"> <?php echo $row['blood_group'] ?> </option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Address<span style="color:red">*</span></div>
              <div><textarea class="form-control" name="address" required></textarea></div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div><input type="submit" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer"></div>
            </div>
          </div>
      </div>
    </div>
    <?php include('footer.php') ?>
  </div>
</body>

</html>