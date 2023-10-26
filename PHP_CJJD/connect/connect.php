<?php
    $host = "localhost";
    $user = "imdoob";
    $pw = "zz!!3125";
    $db = "imdoob";

    $connect = new mysqli($host, $user, $pw, $db);
    $connect->set_charset('utf-8');

    // if(mysqli_connect_error()){
    //     echo "DATABASE Connect FALSE";
    // } else {
    //     echo "DATABASE Connect TRUE";
    // }
    
?>