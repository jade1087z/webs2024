<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";


$myMemberId = $_POST['commentMemberId'];
$boardId = $_POST['boardId'];
$acId = $_POST['acId'];
$commentId = $_POST['commentId'];
$commentMsg = $_POST['commentMsg'];

// $commentCategory = $_POST['commentCategory'];
// $commentName = $_POST['youNick'];

$sql = "UPDATE drinkComment SET commentMsg = '$commentMsg' WHERE commentId = $commentId";
$result = $connect->query($sql);

if ($result) {
    echo json_encode(array("info" => '업데이트 성공'));
} else {
    echo json_encode(array("error" => $commentMsg, "commentid" => $commentId, "boardid" => $boardId, "myMemberid" => $myMemberId));
}
