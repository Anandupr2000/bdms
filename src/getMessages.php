<?php
require 'conn.php';
session_start();
$uid = $_SESSION['user']['uid'];
// $uname = $_SESSION['user']['uname'];
// print_r($_POST);
if (isset($_POST['recieverid'])) {
    $recieverid = $_POST['recieverid'];
    // echo $uid;
    // echo $recieverid;
    $sql = "SELECT * FROM messages WHERE senderuid=$uid AND receiveruid=$recieverid UNION SELECT * FROM messages WHERE senderuid=$recieverid AND receiveruid=$uid ORDER BY timestamp;";
    // echo $sql;
    $messages = mysqli_query($conn, $sql) or die("Query unsucessfull");
    $msgArr = [];
    while ($msg = mysqli_fetch_assoc($messages)) {
        array_push($msgArr, $msg);
    }
    print_r(json_encode($msgArr));
    mysqli_query($conn, "UPDATE messages SET readed = 1 WHERE senderuid=$uid AND receiveruid=$recieverid");
    mysqli_query($conn, "UPDATE messages SET readed = 1 WHERE senderuid=$recieverid AND receiveruid=$uid");
}
