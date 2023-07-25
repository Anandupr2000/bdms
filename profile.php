<?php

// setting $active as home to show user at header, that he/she is currently viewing home 
$active = "home";
// print_r($_POST);
if (isset($_POST['updateRequest'])) {
    print_r(json_encode(['updateFlag' => 1]));
    die();
}
include('head.php');
include 'conn.php';
$userid = $_SESSION['user']['uid'];
?>
<!DOCTYPE html>
<html lang="en">

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

        .fluid-container form {
            display: flex;
            flex-direction: column;
            row-gap: 1rem;
        }

        .fluid-container form button {
            width: fit-content;
        }

        .form-group {
            display: flex;
        }

        .form-group label {
            width: 40%;
        }

        .form_selectbox {
            width: 25rem;
        }

        .form-group select {
            width: fit-content;
        }

        .btn[type="submit"] {
            box-shadow: solid black 3px 3px;
            scale: 1;
            transition: 0.5s;
            content: "History";
        }

        .rewardsDiv {
            position: relative;
            display: flex;
            border: 2px lightblue;
            border-radius: 10px;
            width: max-content;
            height: max-content;
        }
    </style>
</head>

<body>
    <div class="header">
        <?php

        if (isset($_POST['update'])) {

            $uid = $_SESSION['user']['uid'];
            $username = mysqli_real_escape_string($conn, $_POST["username"]);
            $email = mysqli_real_escape_string($conn, $_POST["email"]);
            $phnno = mysqli_real_escape_string($conn, $_POST["phnno"]);
            $pwd = mysqli_real_escape_string($conn, $_POST["userpwd"]);
            $age = mysqli_real_escape_string($conn, $_POST["age"]);
            $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
            $fees = mysqli_real_escape_string($conn, $_POST["fees"]);
            $bloodid = mysqli_real_escape_string($conn, $_POST["blood_group"]);
            $address = mysqli_real_escape_string($conn, $_POST["address"]);
            // updating users table
            $sql = "UPDATE users SET uname='$username', email='$email', upass='$pwd' WHERE uid=$uid";

            // echo $sql;
            $stmt = $conn->prepare($sql);
            // $stmt->bind_param("sssi", $username, $email, $pwd, $uid);
            if (!$stmt) {
                die("Error in preparing the statement.");
            }

            // $sql = "UPDATE donor_details SET donor_number=$phnno,donor_age=$age,donor_gender=$gender,donor_blood=$bloodid,donor_address=$address,fees=$fees)";
            // $stmt1 = $conn->prepare($sql);
            $sql = "UPDATE donor_details SET donor_number=?, donor_age=?, donor_gender=?, donor_blood=?, donor_address=?, fees=? WHERE uid=?";
            $stmt1 = $conn->prepare($sql);
            $stmt1->bind_param("iisissi", $phnno, $age, $gender, $bloodid, $address, $fees, $uid);
            // print_r($stmt1);

            if (!$stmt1) {
                die("Error in preparing the statement...");
            }


            if ($stmt->execute() && $stmt1->execute()) {
                echo "<script>alert('Profile updated')</script>";
            }
            $stmt->close();
            $stmt1->close();
        }


        $stmt = $conn->prepare("SELECT * from donor_details join blood where uid=$userid and donor_blood=blood.blood_id");

        if (!$stmt->execute()) {
            die("Error executing the statement: " . $stmt->error);
        }
        $result = $stmt->get_result();
        $stmt->close();
        $donor = mysqli_fetch_assoc($result);

        $user = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from users where uid=$userid"));
        // $stmt->execute();
        // $user = $stmt->get_result();
        // $stmt->close()
        // code for updating user profile
        // print_r($_POST);

        ?>
    </div>
    <button class="btn btn-secondary ml-5 mt-4" onclick="handleUpdateRequest()">Edit</button>
    <div class="container p-5 row justify-content-evenly">
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="m-auto" style="width:35rem">
            <div class="form-group">
                <label for="uname">User Name</label>
                <input type="text" name="username" value="<?php echo $user['uname'] ?>" class="form-control" id="uname" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" value="<?php echo $user['email'] ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="phnno">Phone number</label>
                <input type="number" name="phnno" value="<?php echo $donor['donor_number'] ?>" class="form-control" id="phnno" placeholder="Phone number">
            </div>
            <div class="form-group">
                <label for="ageInp">Age</label>
                <input type="number" name="age" value="<?php echo $donor['donor_age'] ?>" class="form-control" id="ageInp" placeholder="Age">
            </div>
            <div class="form-group">
                <label for="genderInp">Gender</label>
                <input type="text" name="gender" value="<?php echo $donor['donor_gender'] ?>" class="form-control" id="genderInp" placeholder="Gender">
            </div>
            <div class="form-group form_selectbox">
                <label for="bloodInp">Blood Group</label>
                <select name="blood_group" class="form-control" id="bloodInp">
                    <?php
                    include 'conn.php';
                    $sql = "select * from blood";
                    $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <option value=<?php echo $row['blood_id'];
                                        if ($row['blood_id'] == $donor['donor_blood']) echo " selected" ?>> <?php echo $row['blood_group'] ?> </option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="addressInp">Location</label>
                <input type="text" name="address" value="<?php echo $donor['donor_address'] ?>" class="form-control" id="addressInp" placeholder="Gender">
            </div>
            <div class="form-group form_selectbox">
                <label for="feesInp">Demanded Fees</label>
                <select name="fees" class="form-control" id="feesInp">
                    <option value="100" <?php if ($donor['fees'] == "100") echo "selected" ?>>100</option>
                    <option value="200" <?php if ($donor['fees'] == "200") echo "selected" ?>>200</option>
                    <option value="300" <?php if ($donor['fees'] == "300") echo "selected" ?>>300</option>
                    <option value="400" <?php if ($donor['fees'] == "400") echo "selected" ?>>400</option>
                    <option value="500" <?php if ($donor['fees'] == "500") echo "selected" ?>>500</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="userpwd" value="<?php echo $_SESSION['user']['upass'] ?>" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>

            <button id="profileUpdateBtn" name="update" type="submit" class="btn btn-primary">Update</button>

        </form>
        <div class="rewardsDiv justify-content-start">
            <?php
            $sql = "SELECT COUNT(responded) as donatedCount FROM request join messages ON messageid=mid AND responded=1 AND receiveruid=3;";
            $donateCount =  mysqli_fetch_assoc(mysqli_query($conn, $sql))['donatedCount'];
            $levelSize = 4;
            $level = round($donateCount / $levelSize);
            $levelMark = $level * $levelSize + $donateCount % $levelSize;
            if ($levelMark == 0) $levelMark = 4;
            $basePoints = 50;
            // $points = $level * $basePoints;
            $points = 50;
            $rewardPoints = $levelMark * $basePoints;
            require('rewards.php');
            ?>
        </div>
    </div>
    <div>
        <?php
        include('footer.php');
        ?>
    </div>
    <script>
        $("#profileUpdateBtn").hide()
        const handleUpdateRequest = () => {
            $.ajax({
                url: './profile.php',
                method: 'POST',
                data: {
                    updateRequest: 1
                },
                success: res => {
                    console.log(res)
                    res = JSON.parse(res)
                    if (res.updateFlag)
                        $("#profileUpdateBtn").show()
                }
            })
        }
    </script>
</body>

</html>