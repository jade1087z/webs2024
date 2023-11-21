<?php
    include "../connect/connect.php";

    $myMemberID = $_POST['myMemberID'];
    $boardId = $_POST['boardId'];
    $reviewPass = $_POST['memberPass'];
    $reviewName = $_POST['name'];
    $reviewMsg = $_POST['msg'];
    $regTime = time();

    $drinkSql = "INSERT INTO drinkreview(myMemberID, boardId, reviewPass, reviewName, reviewMsg, reviewDelete, regTime)
            VALUES ('$myMemberID', '$boardId', '$reviewPass', '$reviewName', '$reviewMsg', 1, '$regTime')";


    $result = $connect->query($drinkSql);
    echo json_encode(array("info" => $boardId));
?>