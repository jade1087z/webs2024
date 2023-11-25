<?php
$host = "localhost";
$user = "zeroin01";
$pw = "duddls1119!";
$db = "zeroin01";

$connect = new mysqli($host, $user, $pw, $db);
$connect->set_charset("utf-8");

// if ($connect->connect_errno) {
//     echo "DATABASE Connect False";
// } else {
//     echo "DATABASE Connect True";
// }
?>