<?php
    $host = "localhost";
    $user = "imdoob1";
    $pw = "zz!!3125";
    $db = "imdoob1";

    $connect = new mysqli($host, $user, $pw, $db);
    $connect -> set_charset("utf-8");
    
    // if(mysqli_connect_errno()) { // false -> null "빈 문자열", 
    //     echo "DATABASE Connect False";
    // } else {
    //     echo "DATABASE Connect True";
    // }
?>