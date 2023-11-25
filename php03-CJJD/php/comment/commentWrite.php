<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";

$myMemberId = $_POST['myMemberId'];
$boardId = $_POST['boardId'];
$commentMsg = $_POST['commentMsg'];
$commentCategory = $_POST['commentCategory'];
$commentName = $_POST['youNick'];
$regTime = time();

$sql = "INSERT INTO drinkComment(myMemberId, boardId, commentCategory, commentName, commentMsg, regTime) VALUES ('$myMemberId', '$boardId', '$commentCategory', '$commentName', '$commentMsg', '$regTime')";
$result = $connect->query($sql);

if ($result) {
    // 업데이트 
    $updateComment = "UPDATE drinkBoard SET boardComment = boardComment + 1 WHERE boardId = '$boardId'";
    $connect->query($updateComment);

    // 업데이트 된 값
    $commentCountQuery = "SELECT boardComment FROM drinkBoard WHERE boardId = '$boardId'";
    $commentCountResult = $connect->query($commentCountQuery);
    $row = $commentCountResult->fetch_assoc();
    $commentCount = $row['boardComment'];

    echo json_encode(array("info" => $boardId, "commentCount" => $commentCount));
} else {
    echo json_encode(array("error" => "댓글 저장에 실패하였습니다."));
}
