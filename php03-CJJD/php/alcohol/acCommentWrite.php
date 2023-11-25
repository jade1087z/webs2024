<?php
include "../connect/connect.php";

$acId = $_POST['acId'];
$youNick = $_POST['youNick'];
$commentMsg = $_POST['commentMsg'];
$regTime = time();

$sql = "INSERT INTO acListComment(acId, youNick, commentMsg, commentDelete, regTime) VALUES ('$acId', '$youNick', '$commentMsg', '1', '$regTime')";
$result = $connect->query($sql);

if ($result) {
    echo json_encode(array("info" => $acId));
} else {
    echo json_encode(array("error" => "댓글 저장에 실패하였습니다."));
}
?>