<?php
include "../connect/connect.php";
include "../connect/session.php";

$boardId = $_GET['boardId'];
$sql = "UPDATE drinkBoard SET boardDelete=0 WHERE boardId = '{$boardId}'";
$result = $connect->query($sql);

$comment = "UPDATE drinkComment SET commentDelete=0 WHERE boardId = '{$boardId}'";
$commentResult = $connect->query($comment);

$like = "UPDATE drinkLikes SET likeDelete=0 WHERE boardId = '{$boardId}'";
$likeResult = $connect->query($like);
// drinkLikes
if ($result) {
    echo "<script>alert('삭제가 완료되었습니다.')</script>";
    echo "<script>window.location.href = 'board.php'</script>";
}
