<?php
include "../connect/connect.php";
include "../connect/session.php";

$myMemberId = $_POST['myMemberId'];
$acId = $_POST['acId'];
$acLike = $_POST['acLike'];

// 카테고리 받음
$commentCategory = $_POST['commentCategory'];


// acLike의 최신 값을 데이터베이스에서 가져옵니다. 
$likeCountSql = "SELECT acLike FROM drinkList WHERE acId = '{$acId}'"; // 해당 보드 아이디의 보드 라이크 값을 가져옴 
$likeCountResult = $connect->query($likeCountSql);
$row = $likeCountResult->fetch_assoc();
$acLike = $row['acLike'];

$likeSql = "SELECT * FROM drinkLikes WHERE myMemberId = '{$myMemberId}' AND acId = '{$acId}'";
$likeResult = $connect->query($likeSql);

if ($likeResult->num_rows > 0) {
    // 이미 추천을 한 경우, 추천 제거
    $sql = "DELETE FROM drinkLikes WHERE myMemberId = '{$myMemberId}' AND acId = '{$acId}'";
    $acLike -= 1;
    $Msql = "UPDATE drinkList SET acLike = '{$acLike}' WHERE acId = '{$acId}'";
    $Mresult = $connect->query($Msql);
    $result = $connect->query($sql);
    echo json_encode(array('remove_success' => 'Like removed successfully.', 'acLike' => $acLike));
} else {
    // 추천을 하지 않은 경우, 추천 추가
    $sql = "INSERT INTO drinkLikes (myMemberId, acId, likeCategory) VALUES ('{$myMemberId}', '{$acId}', '{$commentCategory}')";
    $acLike += 1;
    $Msql = "UPDATE drinkList SET acLike = '{$acLike}' WHERE acId = '{$acId}'";
    $Mresult = $connect->query($Msql);
    $result = $connect->query($sql);
    echo json_encode(array('added_success' => 'Like added successfully.', 'acLike' => $acLike));
}
