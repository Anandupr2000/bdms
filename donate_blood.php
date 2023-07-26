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
        <!-- <form name="donor" action="" method="post"> -->
          <div class="row">
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Full Name</div>
              <div><input type="text" name="fullname" value="<?php echo $_SESSION['username'] ?>" class="form-control" disabled></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
              <div><input type="number" name="mobileno" class="form-control" required></div>
            </div>
            <div class="col-lg-4 mb-4">
              <div class="font-italic">Email Id</div>
              <div><input type="email" name="emailid" value="<?php echo $_SESSION['user']['email'] ?>" class="form-control"></div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-2 mb-4">
              <div class="font-italic">Age<span style="color:red">*</span></div>
              <div>
                <input type="number" min=18 name="age" aria-errormessage="age_error" aria-invalid="true" class="form-control" aria-describedby="age_error" required>
              </div>
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
          <hr>
          <div class="col-12 p-0">
            <h3 class="py-2">Medical History</h3>
            <div class="form-check py-4 row">
              <span>Are you feeling well and in good health today ? <span style="color:red">*</span></span>
              <span class="px-5">
                <input class="form-check-input" name="gudHealth" type="radio" value="Yes" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">YES</label>
                <input class="form-check-input ml-4" name="gudHealth" type="radio" value="No" id="flexCheckDefault" required>
                <label class="form-check-label ml-5" for="flexCheckDefault">No</label>
              </span>
            </div>
            <div class="form-check py-4 row">
              <span>Have you already given blood in the last 16 weeks ? <span style="color:red">*</span></span>
              <span class="px-5">
                <input class="form-check-input" name="bloodDonated" type="radio" value="Yes" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">YES</label>
                <input class="form-check-input ml-4" name="bloodDonated" type="radio" value="No" id="flexCheckDefault" required>
                <label class="form-check-label ml-5" for="flexCheckDefault">No</label>
              </span>
            </div>
            <div class="form-check py-4 row">
              <span>Have you got a chesty cough, sore throat or active cold sore ? <span style="color:red">*</span></span>
              <span class="px-5">
                <input class="form-check-input" name="sickness" type="radio" value="Yes" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">YES</label>
                <input class="form-check-input ml-4" name="sickness" type="radio" value="No" id="flexCheckDefault" required>
                <label class="form-check-label ml-5" for="flexCheckDefault">No</label>
              </span>
            </div>
            <div class="form-check py-4 row">
              <span>Are you pregnant or breastfeeding ? <span style="color:red">*</span></span>
              <span class="px-5">
                <input class="form-check-input" name="pregnancy" type="radio" value="Yes" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">YES</label>
                <input class="form-check-input ml-4" name="pregnancy" type="radio" value="No" id="flexCheckDefault" required>
                <label class="form-check-label ml-5" for="flexCheckDefault">No</label>
              </span>
            </div>
            <div class="form-check py-4 row">
              <span>Are you diabetic ? <span style="color:red">*</span></span>
              <span class="px-5">
                <input class="form-check-input" name="diabetic" type="radio" value="Yes" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">YES</label>
                <input class="form-check-input ml-4" name="diabetic" type="radio" value="No" id="flexCheckDefault" required>
                <label class="form-check-label ml-5" for="flexCheckDefault">No</label>
              </span>
            </div>
            <div class="form-check py-4 row">
              <span>Have you suffered from a sexually transmitted disease (STD): e.g. syphilis, gonorrhoea, <br>
                genital herpes, genital ulcer, VD, or 'drop' ? <span style="color:red">*</span></span>
              <span class="px-5">
                <input class="form-check-input" name="std" type="radio" value="Yes" id="flexCheckDefault" required>
                <label class="form-check-label" for="flexCheckDefault">YES</label>
                <input class="form-check-input ml-4" name="std" type="radio" value="No" id="flexCheckDefault" required>
                <label class="form-check-label ml-5" for="flexCheckDefault">No</label>
              </span>
            </div>
          </div>
          <div class="row pt-3">
            <div class="col-lg-4 mb-4">
              <div><input type="submit" id="formSubmitBtn" name="submit" class="btn btn-primary" value="Submit" style="cursor:pointer"></div>
            </div>
          </div>
      </div>
    </div>
    <?php include('footer.php') ?>
  </div>

  <script>
    const submitBtn = document.getElementById('formSubmitBtn')
    // Get the age input element and the associated error message element
    submitBtn.addEventListener('click',(e)=>{validateForm(e)})
    const validateForm = (e)=>{

      // const ageInput = document.querySelector('input[name="age"]');
      const gudHealth = document.querySelector('input[name="gudHealth"]');
      const bloodDonated = document.querySelector('input[name="bloodDonated"]');
      const sickness = document.querySelector('input[name="sickness"]');
      const pregnancy = document.querySelector('input[name="pregnancy"]');
      const diabetic = document.querySelector('input[name="diabetic"]');
      const std = document.querySelector('input[name="std"]');
      
      // console.log(ageInput.value)
      // if (ageInput.nodeValue < 19) {
      //   ageInput.style.border = '2px solid red'
      //   alert("Donor age must be greater than 18");
      // }
      if (gudHealth.value == "No") {
        gudHealth.style.border = '2px solid red'
        alert("Donor must have good health");
        e.preventDefault()
        return
      }
      if (bloodDonated.value == "Yes") {
        bloodDonated.style.border = '2px solid red'
        alert("Donor must not donated blood within last 6 weeks");
        e.preventDefault()        
        return
      }
      if (sickness.value == "Yes") {
        bloodDonated.style.border = '2px solid red'
        alert("Donor must not be sick");
        e.preventDefault()        
        return
      }
      if (pregnancy.value == "Yes") {
        pregnancy.style.border = '2px solid red'
        alert("Donor must not be pregnant");
        e.preventDefault()        
        return
      }
      if (diabetic.value == "Yes") {
        diabetic.style.border = '2px solid red'
        alert("Donor must not be diabetic");
        e.preventDefault()        
        return
      }
      if (std.value == "Yes") {
        diabetic.style.border = '2px solid red'
        alert("Donor must not have STDs");
        e.preventDefault()        
        return
      }
    }
    </script>
</body>

</html>