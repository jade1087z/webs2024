<?php
include "../connect/connect.php";
include "../connect/session.php";

$myMemberId = $_POST['commentMemberId'];
$boardId = $_POST['boardId'];
$commentId = $_POST['commentId'];

$delSql = "UPDATE drinkComment SET commentDelete = 0 WHERE commentId = '$commentId'";
$result = $connect->query($delSql);

if ($result) {
    echo json_encode(array("info" => '업데이트 성공'));
} else {
    echo json_encode(array("errorC" => $commentId, "errorB" => $boardId, "errorM" => $myMemberId));
}
