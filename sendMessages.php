<?php
session_start();

function sendMessage($rid, $content)
{
    require 'conn.php';
    $uid = $_SESSION['user']['uid'];
    $sql = "INSERT INTO messages(senderuid,receiveruid,message) VALUES ($uid,$rid,'$content');";
    return mysqli_query($conn, $sql);
}
if (isset($_POST['message'])) {
    $recieverid = $_POST['message']['recieverid'];
    $content = $_POST['message']['content'];

    // $result = mysqli_query($conn, $sql) or die("Query unsucessfull");
    if (sendMessage($recieverid, $content)) $result = 1;
    else $result = 0;

    print_r(json_encode(['success' => $result]));
}
