<?php
include "../connect/connect.php";

$jsonData = file_get_contents('../json/acList.json');

// JSON 데이터 파싱
$data = json_decode($jsonData, true);

// 데이터 삽입
foreach ($data as $item) {
    $type = $item["acType"];
    $img = $item["img"];
    $name = $item["name"];
    $company = $item["company"];
    $desc = $item["desc"];
    $view = $item["view"];
    $like = $item["like"];
    $comment = $item["comment"];
    $abv = $item["abv"];

    $sql = "INSERT INTO drinkList (acCategory, acImgPath, acName, acCompany, acDesc, acView, acLike, acComment, acAbv, acDelete) 
        VALUES ('$type', '$img', '$name', '$company', '$desc', $view, $like, $comment, $abv, 1)";

    $connect->query($sql);
}
?>