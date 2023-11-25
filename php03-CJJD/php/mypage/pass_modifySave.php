<?php 
    include "../connect/connect.php";
    include "../connect/session.php";

    $youId = $_POST['youId'];
    $youPass = $_POST['youPass'];
    $youNewPass = $_POST['youNewPass'];
    $myMemberId = $_SESSION['myMemberId'];

    $sql = "SELECT youPass FROM drinkMember WHERE youPass = '$youPass' AND youId = '$youId' AND myMemberId = '$myMemberId'";
    $result = $connect->query($sql);

    if($result->num_rows == 0){
        $jsonResult = "bad";
    } else {
        $updateSql = "UPDATE drinkMember SET youPass = '$youNewPass' WHERE myMemberId = '$myMemberId'";
        $connect->query($updateSql);
        $jsonResult = "good";
    }

    echo json_encode(array("result" => $jsonResult));
?>