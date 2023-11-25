<?php
include "../connect/connect.php";
include "../connect/session.php";



$myMemberId = $_POST['myMemberId'];
$boardId = $_POST['boardId'];
$boardLike = $_POST['boardLike'];


// boardLike의 최신 값을 데이터베이스에서 가져옵니다. 
// 다음의 쿼리문을 통해 최신 값이 아닌 브라우저상의 데이터를 통해 값을 가져오면 리로드 시, 혹은 여러 사용자가 클릭을 누르는 동시에 예상치 못한 버그가 생김 
$likeCountSql = "SELECT boardLike FROM drinkBoard WHERE boardId = '{$boardId}'"; // 해당 보드 아이디의 보드 라이크 값을 가져옴 
$likeCountResult = $connect->query($likeCountSql);
$row = $likeCountResult->fetch_assoc();
$boardLike = $row['boardLike'];

$likeSql = "SELECT * FROM drinkLikes WHERE myMemberId = '{$myMemberId}' AND boardId = '{$boardId}'";
$likeResult = $connect->query($likeSql);

if ($likeResult->num_rows > 0) {
    // 이미 추천을 한 경우, 추천 제거
    $sql = "DELETE FROM drinkLikes WHERE myMemberId = '{$myMemberId}' AND boardId = '{$boardId}'";
    $boardLike -= 1;
    $Msql = "UPDATE drinkBoard SET boardLike = '{$boardLike}' WHERE boardId = '{$boardId}'";
    $Mresult = $connect->query($Msql);
    $result = $connect->query($sql);
    echo json_encode(array('remove_success' => 'Like removed successfully.', 'boardLike' => $boardLike));
} else {
    // 추천을 하지 않은 경우, 추천 추가
    $sql = "INSERT INTO drinkLikes (myMemberId, boardId, likeCategory) VALUES ('{$myMemberId}', '{$boardId}', '자유게시판')";
    $boardLike += 1;
    $Msql = "UPDATE drinkBoard SET boardLike = '{$boardLike}' WHERE boardId = '{$boardId}'";
    $Mresult = $connect->query($Msql);
    $result = $connect->query($sql);
    echo json_encode(array('added_success' => 'Like added successfully.', 'boardLike' => $boardLike));
}
// 해당 부분 고치기
// 색 적용 완료, css 위치 수정해서 값 적용 시키고 연산 부분 마무리 하기 좋아요 완료
