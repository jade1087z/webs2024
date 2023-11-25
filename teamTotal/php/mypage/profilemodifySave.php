<?php 
    include "../connect/connect.php";
    include "../connect/session.php";

    $youNick = $_POST['youNick'];
    $youPass = $_POST['youPass'];
    $myMemberID = $_POST['myMemberID'];

    $sql = "SELECT youPass FROM drinkMember WHERE youPass = '$youPass' AND myMemberID = '$myMemberID'";
    $result = $connect->query($sql);

    if($result->num_rows == 0){
        $jsonResult = "bad";
    } else {
        $updateSql = "UPDATE drinkMember SET youNick = '$youNick' WHERE myMemberID = '$myMemberID'";
        $connect->query($updateSql);
        $jsonResult = "good";
    }

    echo json_encode(array("result" => $jsonResult));
?>