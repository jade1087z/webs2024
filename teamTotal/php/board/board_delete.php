<?php
include "../connect/connect.php";
include "../connect/session.php";
include "../connect/sessionCheck.php";


$boardId = $_GET['boardId'];



$delSql = "UPDATE drinkBoard SET boardDelete = 0 WHERE boardId = '{$boardId}'";
$result = $connect->query($delSql);

if ($result) {
    echo "<script>alert('삭제가 완료되었습니다.')</script>";
    echo "<script>window.location.href='board.php';</script>";
}
