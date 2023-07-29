<?php
$servername = "mysql_bdms";
$username = "root";
$password = "root@Anandu#2000";
$dbname = "blood_donation";
$port = 3306;
// $conn=mysqli_connect("localhost","root","","blood_donation") or die("Connection error");
$conn = new mysqli($servername, $username, $password, $dbname,$port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
