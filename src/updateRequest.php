<?php

require 'conn.php';
session_start();
$uid = $_SESSION['user']['uid'];
// print_r($_POST);
if (isset($_POST['request'])) {
    $mid = $_POST['request']['id'];
    $status = $_POST['request']['status'];
    // echo type($status);
    
    $sql = "UPDATE request SET status=$status, responded=1 WHERE messageid=$mid;";
    echo $sql;
    mysqli_query($conn, $sql) or die("Query unsucessfull");
}
