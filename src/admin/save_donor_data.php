<?php
include 'conn.php';

$name = $_POST['fullname'];
$number = $_POST['mobileno'];
$email = $_POST['emailid'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$fee = $_POST['fee'];
$blood_group = $_POST['blood'];
$address = $_POST['address'];
// $conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");

$sql = "SELECT MAX(uid) as maxUid FROM users";
$user = mysqli_query($conn, $sql) or die("query unsuccessful.");
$uid = mysqli_fetch_assoc($user);

$uid = (int)$uid['maxUid'] + 1;


$result = mysqli_query($conn, "INSERT INTO users VALUES ($uid,'$name','user','$email','123')");

$sql = "INSERT INTO donor_details(uid,donor_number,donor_age,donor_gender,donor_blood,donor_address,fees) 
values({$uid},'{$number}','{$age}','{$gender}','{$blood_group}','{$address}','{$fee}')";

$result = mysqli_query($conn, $sql) or die("query unsuccessful....");

header("Location: donor_list.php");

mysqli_close($conn);
