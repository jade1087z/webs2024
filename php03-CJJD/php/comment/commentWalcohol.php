<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";

$myMemberId = $_POST['myMemberId'];
$acId = $_POST['acId'];
$commentMsg = $_POST['commentMsg'];
$commentCategory = $_POST['commentCategory'];
$commentName = $_POST['youNick'];
$regTime = time();

$sql = "INSERT INTO drinkComment(myMemberId, acId, commentCategory, commentName, commentMsg, regTime) VALUES ('$myMemberId','$acId', '$commentCategory', '$commentName', '$commentMsg', '$regTime')";
$result = $connect->query($sql);

if ($result) {
    // 업데이트 
    $updateComment = "UPDATE drinkList SET acComment = acComment + 1 WHERE acId = '$acId'";
    $connect->query($updateComment);

    // 업데이트 된 값
    $commentCountQuery = "SELECT acComment FROM drinkList WHERE acId = '$acId'";
    $commentCountResult = $connect->query($commentCountQuery);
    $row = $commentCountResult->fetch_assoc();
    $commentCount = $row['acComment'];

    echo json_encode(array("info" => $acId, "commentCount" => $commentCount));
} else {
    echo json_encode(array("error" => "댓글 저장에 실패하였습니다."));
}