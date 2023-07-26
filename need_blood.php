<html>

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
    #page-container .container {
      min-height: 100%;
      /* background: #210; */
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

    #requestSentBtn {
      transition: 0.3s ease-in-out;
    }

    #requestSentBtn:hover {
      scale: 1.2;
      /* margin-top: 1rem; */
    }

    .btn:focus,
    .btn:active {
      outline: none;
      box-shadow: none;
    }
  </style>
</head>

<body>
  <?php

  use function PHPSTORM_META\type;
  // setting $active as need to show user at header, that he/she is currently viewing need 
  $active = 'need';
  include('head.php') ?>

  <div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
    <div class="container">
      <div id="content-wrap" style="padding-bottom:50px;">

        <div class="row">
          <div class="col-lg-6">
            <h1 class="mt-4 mb-3">Need Blood</h1>

          </div>
        </div>
        <form name="needblood" action="" method="post">
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Blood Group<span style="color:red">*</span></div>
              <div>
                <select name="blood" class="form-control" required>
                  <option value="" selected disabled>Select</option>
                  <?php
                  include 'conn.php';
                  $sql = "select * from blood";
                  $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <option value="<?php echo $row['blood_id'] ?>"> <?php echo $row['blood_group'] ?> </option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="col-lg-4 mb-4">
              <div class="font-italic">Location<span style="color:red">*</span></div>
              <div>
                <select name="location" class="form-control" required>
                  <option value="" selected disabled>Select</option>
                  <option value="any">Any</option>
                  <?php
                  include 'conn.php';
                  $sql = "select donor_address from donor_details";
                  $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                    <option value="<?php echo $row['donor_address'] ?>"> <?php echo $row['donor_address'] ?> </option>
                  <?php } ?>
                </select>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Reason, why do you need blood?<span style="color:red">*</span></div>
              <div><textarea class="form-control" name="reason" required></textarea></div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div><input type="submit" name="search" class="btn btn-primary" value="Search" style="cursor:pointer"></div>
            </div>

          </div>
        </form>

        <div class="row">
          <?php
          if (isset($_POST['search'])) {

            $bg = $_POST['blood'];
            $location = $_POST['location'];
            if ($location == 'any')
              $sql = "select * from donor_details join blood join users where donor_details.uid=users.uid AND donor_details.donor_blood=blood.blood_id AND donor_blood='{$bg}' order by rand() limit 5";
            else
              $sql = "SELECT * FROM donor_details JOIN blood ON donor_details.donor_blood = blood.blood_id WHERE donor_blood='{$bg}' AND donor_address = '{$location}' ORDER BY RAND() LIMIT 5";
            $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
          ?>

                <div class="col-lg-4 col-sm-6 portfolio-item"><br>
                  <div class="card" style="width:300px">
                    <?php
                    $donorName = $row['uname'];
                    if ($row['hascertificate']) {
                    ?>
                      <span class="certification"><i class="fa-solid fa-award"></i> <span>Certified</span></span>
                    <?php
                    }
                    $donorid = $row['uid'];

                    $sql = "SELECT u.uname, m.timestamp
                    FROM messages m
                    JOIN users u ON m.senderuid = u.uid
                    JOIN request r ON m.mid = r.messageid
                    WHERE r.responded = 1 AND m.receiveruid = $donorid;";

                    $donorHistory = mysqli_query($conn, $sql);
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $donorH = $stmt->get_result();

                    $stmt->close();

                    $sql = "SELECT gudHealth, bloodDonated,sickness,pregnancy,diabetic,std
                    FROM medical_history
                    WHERE uid = $donorid;";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $medicalHistory = $stmt->get_result();
                    $stmt->close();
                    ?>

                    <img class="card-img-top" src="image\blood_drop_logo.jpg" alt="Card image" style="width:100%;height:300px">
                    <div class="card-body">
                      <button title="donor history" onclick="showHistory(<?php echo $row['uid'] ?>)" class="float-right my-auto btn border-0 outline-0" data-toggle="modal" data-target="#exampleModal_<?php echo $row['uid']; ?>">
                        <i class="fas fa-clock"></i>
                      </button>


                      <div class="modal fade" id="exampleModal_<?php echo $row['uid']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header" style="flex-direction: column;">
                              <h2 class="modal-title">Donor History</h2>
                              <h6>Donor name : <?php echo $donorName ?></h6>
                              <h6>Blood group : <?php echo $row['blood_group'] ?></h6>
                            </div>
                            <div class="modal-body">
                              <?php
                              if ($medicalHistory->num_rows) {
                                $medicalHistory = mysqli_fetch_assoc($medicalHistory);
                              ?>
                                <div class="row ml-1 pt-2 pb-3">
                                  <span class="col">Healthy : </span>
                                  <span class="col"><?php echo $medicalHistory['gudHealth'] ?></span>
                                </div>
                                <div class="row ml-2 pt-2 pb-3">
                                  <span class="col">Blood donated in last 16 weeks : </span>
                                  <span class="col"><?php echo $medicalHistory['bloodDonated'] ?></span>
                                </div>
                                <div class="row ml-2 pt-2 pb-3">
                                  <span class="col">Chesty cough, sore throat or active cold sore : </span>
                                  <span class="col"><?php echo $medicalHistory['sickness'] ?></span>
                                </div>
                                <div class="row ml-1 pt-2 pb-3">
                                  <span class="col">Pregnant or Breastfeeding : </span>
                                  <span class="col"><?php echo $medicalHistory['pregnancy'] ?></span>
                                </div>
                                <div class="row ml-2 pt-2 pb-3">
                                  <span class="col">Diabetic : </span>
                                  <span class="col"><?php echo $medicalHistory['diabetic'] ?></span>
                                </div>
                                <div class="row ml-2 pt-2 pb-3">
                                  <span class="col">Sexually Transmitted Disease (STD) : </span>
                                  <span class="col"><?php echo $medicalHistory['std'] ?></span>
                                </div>
                              <?php
                              } else {
                              ?>
                                <div class="row ml-2 pt-2 pb-3">
                                  <span class="col">No Medical History </span>
                                </div>
                              <?php
                              }
                              if ($donorH->num_rows) {
                              ?>
                                <table class="table" style="width:100%;">
                                  <h3>Donor transaction</h3>
                                  <thead>
                                    <th class="p-2">Time</th>
                                    <th class="p-2">Reciever</th>
                                  </thead>
                                  <tbody>
                                    <?php
                                    // print_r($donorH);
                                    // if ($donorHistory)
                                    while ($history = mysqli_fetch_assoc($donorH)) {
                                    ?>
                                      <tr>
                                        <td><?php echo $history['timestamp']; ?></td>
                                        <td><?php echo $history['uname']; ?></td>
                                      </tr>
                                    <?php
                                    }
                                    ?>
                                  </tbody>
                                </table>
                              <?php
                              } else {
                              ?>
                                <h3>No Donation History</h3>
                              <?php
                              }
                              ?>
                            </div>
                          </div>
                        </div>
                      </div>

                      <button id="requestSentBtn" title="sent request" onclick="handleRequestSentBtn('<?php echo $row['uid']; ?>', '<?php echo $row['blood_group']; ?>')" class="float-right btn border-0 outline-0">
                        <i class="fa-regular fa-message fa-flip-horizontal fa-xl"></i>
                      </button>

                      <h3 class="card-title"><?php echo $row['uname']; ?></h3>
                      <p class="card-text">
                        <b>Blood Group : </b> <b><?php echo $row['blood_group']; ?></b><br>
                        <b>Mobile No. : </b> <?php echo $row['donor_number']; ?><br>
                        <b>Gender : </b><?php echo $row['donor_gender']; ?><br>
                        <b>Age : </b> <?php echo $row['donor_age']; ?><br>
                        <b>Address : </b> <?php echo $row['donor_address']; ?><br>
                      </p>
                    </div>
                  </div>
                </div>

          <?php
              }
            } else {
              echo '<div class="alert alert-danger">No Donor Found For your search Blood group </div>';
            }
          } ?>
        </div>
      </div>
    </div>
    <?php include 'footer.php' ?>
  </div>
</body>
<script>
  const showHistory = (uid) => {
    console.log(uid);
  }
  const handleRequestSentBtn = (uid, bgroup) => {
    console.log("user uid : ", uid)
    // $("#requestSentBtn").hide()
    $.ajax({
      url: 'addrequest.php',
      method: 'POST',
      data: {
        request: {
          donorid: uid,
          message: `Can you donate ${bgroup} ?`
        }
      },
      success: (res) => {
        console.log(res)
        alert("Request send")
      }
    })
  }
</script>

</html>