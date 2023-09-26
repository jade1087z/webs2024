<?php
    include "../connect/connect.php";

    $youEmail = $_POST['youEmail'];
    $youName = $_POST['youName'];
    $youPass = $_POST['youPass'];
    $youPassC = $_POST['youPassC'];
    $youPhone = $_POST['youPhone'];
    $regTime = time();
    echo $youEmail, $youName, $youPass, $youPassC, $youPhone, $regTime;
?>