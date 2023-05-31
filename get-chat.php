<?php
session_start();
error_reporting(0);
include_once("../autoloading/init.php");
if (isset($_SESSION['session_userId'])) {
    $DB = new Database();
    $outgoing_id = $_SESSION['session_userId'];
    $groupId = mysqli_real_escape_string($DB->koneksi, $_POST['groupId']);
    $output = "";
    $sql = "SELECT chat.massage pesan, DATE_FORMAT(createdAt,'%H:%i') waktu, DATE_FORMAT(createdAt,'%Y-%m-%d') hari, chat.userId, user.name as nama FROM chat LEFT JOIN user ON user.id = chat.userId WHERE groupId='$groupId' ORDER BY chat.createdAt DESC";
    $query = mysqli_query($DB->koneksi, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['userId'] === $outgoing_id) {
                $output .= '<div class="messages outgoing">
                                <div class="chat-box">
                                    <div class="content-chat">
                                        <div class="name">
                                            <h2>' . $row['nama'] . '</h2>
                                        </div>
                                        <div class="message">
                                            <p>' . $row['pesan'] . '</p>
                                        </div>
                                    </div>
                                    <div class="time">' . $row['waktu'] . '</div>
                                </div>
                            </div>';
            } else {
                $output .= '<div class="messages incoming">
                                <img src="" alt="" class="profile" />
                                <div class="chat-box">
                                    <div class="content-chat">
                                        <div class="name">
                                            <h2>' . $row['nama'] . '</h2>
                                        </div>
                                        <div class="message">
                                            <p>' . $row['pesan'] . '</p>
                                        </div>
                                    </div>
                                    <div class="time">' . $row['waktu'] . '</div>
                                </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text"><p>No messages are available.</p></div>';
    }
    echo $output;
} else {
    header("location: ../index.php");
}
