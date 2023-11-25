<?php
include "../connect/connect.php";

if (isset($_GET['acId'])) {
    $acId = $_GET['acId'];

    // 추천수를 업데이트하는 SQL 쿼리 실행
    $updateLikeSql = "UPDATE drinkList SET acLike = acLike + 1 WHERE acId = '$acId'";
    $connect->query($updateLikeSql);
}
?>