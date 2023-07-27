<?php
session_start();
include 'conn.php';
if (isset($_POST["login"])) {

  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);

  // $sql = "SELECT * from users where uname='$username' and upass='$password'";
  $stmt = $conn->prepare("SELECT * from users  where uname=? and upass=?");
  $stmt->bind_param("ss", $username, $password); // Assuming uname and upass are both strings ('s').

  if (!$stmt->execute()) {
    die("Error executing the statement: " . $stmt->error);
  }
  $result = $stmt->get_result();
  $stmt->close();


  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      // session_start();
      // print_r($row);
      $_SESSION['loggedin'] = true;
      $_SESSION["username"] = $username;
      $_SESSION["user"] = $row;
      header("Location: home.php");
    }
  } else {
    echo '<div class="alert alert-danger col-md-6" style="font-weight:bold"><i class="fa-sharp fa-solid fa-circle-exclamation fa-beat fa-lg" style="color: #e81741;"></i> Incorrect credentials!</div>';
  }
}
?>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body background="admin\admin_image\blood-cells.jpg">
  <div class="container mt-5">
    <div class="row justify-content-left">
      <div class="col-lg-6">
        <h1 class="mt-4 mb-3" style="color:#D2F015 ;">
          <span style="color:red;">Blood Bank & Management</span>
          <br>User Login Portal
        </h1>
      </div>
    </div>
    <br>
    <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="card rounded-start col-md-8" style="background-image:url('admin/admin_image/glossy1.jpg');">
        <div class="card-body">
          <br>
          <br>
          <div class="row justify-content-lg-center justify-content-mb-center">
            <div class="col-lg-6 mb-6 ">
              <div class="font-italic" style="font-weight:bold">Username<span style="color:red">*</span></div>
              <div>
                <input type="text" name="username" placeholder="Enter your username" class="form-control" value="" required>
              </div>
            </div>
          </div>
          <div class="row justify-content-lg-center justify-content-mb-center">
            <div class="col-lg-6 mb-6 "><br>
              <div class="font-italic" style="font-weight:bold">Password<span style="color:red">*</span></div>
              <div>
                <input type="password" name="password" placeholder="Enter your Password" class="form-control" value="" required>
              </div>
            </div>
          </div>
          <br>
          <div class="row justify-content-lg-center justify-content-mb-center">
            <div class="row mb-4 gx-2 align-items-md-baseline" style="text-align:center"><br>
              <input type="submit" name="login" class="col btn btn-primary" value="Login" style="cursor:pointer">
              <span class="col">or</span>
              <a href="register.php" class="col text-black-50 text-decoration-none" style="font-size:18px;font-weight:800;cursor:pointer">Register</a>
              <!-- <input type="submit" name="login"  value="Register" > -->
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</body>

</html>