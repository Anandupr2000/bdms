<?php
session_start();
// $name=$_POST['fullname'];
$number = $_POST['mobileno'];
// $email=$_POST['emailid'];
$uid = $_SESSION['user']['uid'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$fee = $_POST['fee'];
$blood_group = $_POST['blood'];

$gudHealth = $_POST['gudHealth'];
$bloodDonated = $_POST['bloodDonated'];
$sickness = $_POST['sickness'];
$pregnancy = $_POST['pregnancy'];
$diabetic = $_POST['diabetic'];
$std = $_POST['std'];


$conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");
$sql = "INSERT INTO donor_details(uid,donor_number,donor_age,donor_gender,donor_blood,donor_address,fees) values('{$uid}','{$number}','{$age}','{$gender}','{$blood_group}','{$address}','{$fee}')";
mysqli_query($conn, $sql) or die("query unsuccessful.");

$sql = "INSERT INTO medical_history(uid,gudHealth,bloodDonated,sickness,pregnancy,diabetic,std) 
values('{$uid}','{$gudHealth}','{$bloodDonated}','{$sickness}','{$pregnancy}','{$diabetic}','{$std}')";
mysqli_query($conn, $sql) or die("query unsuccessful.");


header("Location: http://localhost/BDMS/home.php");

mysqli_close($conn);
