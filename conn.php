<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donation";
// $conn=mysqli_connect("localhost","root","","blood_donation") or die("Connection error");
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
