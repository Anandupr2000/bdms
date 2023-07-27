<?php

use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';

function sendMail($msg, $email)
{
    date_default_timezone_set('Asia/Kolkata');
    $time_string = date("h:i A");

    $subject = 'BDMS registeration';
    $message_body = $msg;


    // loop through the result set and send email to each email address
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'keralabloodmanagement@gmail.com';
    $mail->Password = 'dircilferexikffn';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('bloodmangementsystem@gmail.com', "BDMS");
    $mail->Subject = $subject;
    // Assuming $current is a DateTime object
    $current = new DateTime();
    $currentFormatted = $current->format('d-m-Y');



    // Define the message body
    $message = '<html><body>';

    // Add the subject in a highlighted box
    $message .= '<div style="background-color: #3498db; padding: 10px;">';
    $message .= '<h2 style="color: #fff;">' . $subject . '</h2>';
    $message .= '</div>';
    $message .= '<h4 style="color: red;"> Date:' . $currentFormatted . '  Time:' . $time_string . '</h4>';
    // $message .= '<h4 style="color: red;">Date:' . $currentFormatted . '</h4>';
    // Add the message in a box
    $message .= '<div style="border: 1px solid #ddd; padding: 10px;">';
    $message .= '<p>' . $message_body . '</p>';
    $message .= '</div>';

    $message .= '</body></html>';

    // Set the message body
    $mail->Body = $message;

    // Set the email content type to HTML
    $mail->isHTML(true);
    $mail->addAddress($email);
    // $mail->addCustomHeader('X-MyHeader', 'My custom header value');
    // Send email
    $mail->send();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Document</title>
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
                    <br>User Registration Portal
                </h1>
            </div>
        </div>
        <br>
        <?php


        include 'conn.php';

        if (isset($_POST["register"])) {
            if ($_POST["pass1"] == $_POST["pass2"]) {
                $username = mysqli_real_escape_string($conn, $_POST["username"]);
                $email = mysqli_real_escape_string($conn, $_POST["email"]);
                $password = mysqli_real_escape_string($conn, $_POST["pass1"]);
                $type = "user";
                // $sql = "SELECT * from users where uname='$username' and upass='$password'";
                $sql = "INSERT INTO users (uname, `type`,email,upass) VALUES (?,?, ?, ?)";
                // prepare and bind
                $stmt = $conn->prepare($sql);
                if (!$stmt) {
                    die("Error in preparing the statement: " . $conn->error);
                }

                $stmt->bind_param("ssss", $username, $type, $email, $password);

                if ($stmt->execute()) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION["username"] = $username;
                    $msg = "Username : $username, Password : $password";
                    sendMail($msg, $email);
                    $_SESSION['registrationStatus'] = true;
                    $_SESSION['mailSendStatus'] = true;
                    header("Location: home.php");
                } else {
                    // print_r($stmt);
                    // executed if email value is not unique
                    echo '<div class="alert alert-danger col-md-6" style="font-weight:bold"><i class="fa-sharp fa-solid fa-circle-exclamation fa-beat fa-lg" style="color: #e81741;"></i>Please use different email address</div>';
                }
                $stmt->close();
            } else {
                echo '<div class="alert alert-danger col-md-6" style="font-weight:bold"><i class="fa-sharp fa-solid fa-circle-exclamation fa-beat fa-lg" style="color: #e81741;"></i> Passwords donot match</div>';
            }
        }
        ?>
        <form class="" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="card rounded-start col-md-12" style="background-size: cover;background-image:url('admin/admin_image/glossy1.jpg');">
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
                    <br>
                    <div class="row justify-content-lg-center justify-content-mb-center">
                        <div class="col-lg-6 mb-6 ">
                            <div class="font-italic" style="font-weight:bold">Email<span style="color:red">*</span></div>
                            <div>
                                <input type="email" name="email" placeholder="Enter your email" class="form-control" value="" required>
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-lg-center justify-content-mb-center">
                        <div class="col-lg-6 mb-6 "><br>
                            <div class="font-italic" style="font-weight:bold">Password<span style="color:red">*</span></div>
                            <div>
                                <input type="password" name="pass1" placeholder="Enter your Password" class="form-control" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-lg-center justify-content-mb-center">
                        <div class="col-lg-6 mb-6 "><br>
                            <div class="font-italic" style="font-weight:bold">Password<span style="color:red">*</span></div>
                            <div>
                                <input type="password" name="pass2" placeholder="Enter your Password" class="form-control" value="" required>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-lg-center justify-content-mb-center">
                        <div class="row mb-4 gx-2 align-items-md-baseline" style="text-align:center"><br>
                            <input type="submit" name="register" class="col btn btn-primary" value="Register" style="cursor:pointer">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>