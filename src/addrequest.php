<?php
require('conn.php');
require('sendMessages.php');

if (isset($_POST['request'])) {
    $recieverid = $_POST['request']['donorid'];
    $content = $_POST['request']['message'];
    // $result = mysqli_query($conn, $sql) or die("Query unsucessfull");
    sendMessage($recieverid, $content);
    // $status = false;
    $sql = "INSERT INTO request(messageid) SELECT MAX(mid) FROM messages;";
    $result = mysqli_query($conn, $sql) or die("query unsuccessful.");
}
