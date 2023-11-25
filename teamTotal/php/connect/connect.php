<?php
$host = "localhost";
$user = "imdoob";
$pw = "zz!!3125";
$db = "imdoob";

$connect = new mysqli($host, $user, $pw, $db);
$connect->set_charset("utf-8");

    // if ($connect->connect_errno) {
    //     echo "DATABASE Connect False";
    // } else {
    //     echo "DATABASE Connect True";
    // }
