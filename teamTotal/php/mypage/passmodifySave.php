<?php 
    include "../connect/connect.php";
    include "../connect/session.php";

    $youID = $_POST['youID'];
    $youPass = $_POST['youPass'];
    $youNewPass = $_POST['youNewPass'];
    $myMemberID = $_POST['myMemberID'];

    $sql = "SELECT youPass FROM drinkMember WHERE youPass = '$youPass' AND youID = '$youID' AND myMemberID = '$myMemberID'";
    $result = $connect->query($sql);

    if($result->num_rows == 0){
        $jsonResult = "bad";
    } else {
        // 여기서 youNick가 아닌 youPass를 업데이트해야합니다.
        $updateSql = "UPDATE drinkMember SET youPass = '$youNewPass' WHERE myMemberID = '$myMemberID'";
        $connect->query($updateSql);
        $jsonResult = "good";
    }

    echo json_encode(array("result" => $jsonResult));
?>