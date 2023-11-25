<?php
    include "../connect/connect.php";

    $youId = $_POST['youId'];
    $youPass = $_POST['youPass'];
    $youPassre = $_POST['youPassre'];
    $youName = $_POST['youName'];
    $youNick = $_POST['youNick'];
    $youEmail = $_POST['youEmail'];
    $youBirth = $_POST['youBirth'];
    $regTime = time();

    echo $youId, $youPass, $youName, $youNick, $youEmail, $youBirth, $regTime;

    $sql = "INSERT INTO drinkMembers(youId, youPass, youName, youNick, youEmail, youBirth, regTime) VALUES('$youId', '$youPass', '$youName', '$youNick', '$youEmail', '$youBirth',  '$regTime')";
    $result = $connect -> query($sql);

?>