<?php
include "../connect/connect.php";

$type = $_POST['type'];
$jsonReslut = "bad";

if ($type == "isIdCheck") {
    $youId = $connect->real_escape_string(trim($_POST['youId']));
    $sql = "SELECT youId FROM drinkMember WHERE youId = '{$youId}'";
}
if ($type == "isNickCheck") {
    $youNick = $connect->real_escape_string(trim($_POST['youNick']));
    $sql = "SELECT youNick FROM drinkMember WHERE youNick = '{$youNick}'";
}
if ($type == "isEmailCheck") {
    $youEmail = $connect->real_escape_string(trim($_POST['youEmail']));
    $sql = "SELECT youEmail FROM drinkMember WHERE youEmail = '{$youEmail}'";
}
$result = $connect->query($sql);
if ($result->num_rows == 0) {
    $jsonReslut = "good";
}

echo json_encode(array("result" => $jsonReslut));
?>