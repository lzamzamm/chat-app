<?php
session_start();
error_reporting(0);
include_once("../autoloading/init.php");
if (isset($_SESSION['session_userId'])) {
    $outgoingId = $_SESSION['session_userId'];
    $DB = new Database();
    print_r($DB->koneksi);
    $groupId = $_POST['groupId'];
    $message = $_POST['message'];
    if (!empty($message)) {
        $sql = mysqli_query($DB->koneksi, "INSERT INTO chat (massage, createdAt, userId, groupId) VALUES ('$message', TIMESTAMPADD(HOUR, 7, CURRENT_TIMESTAMP), '$outgoingId','$groupId')") or die();
    }
}
