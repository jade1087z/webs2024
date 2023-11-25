<?php 
    include "../connect/connect.php";
    include "../connect/session.php";

    $youPass = $_POST['deletePass'];
    $myMemberId = $_SESSION['myMemberId'];

    $sql = "SELECT youPass FROM drinkMember WHERE youPass = '$youPass' AND myMemberId = '$myMemberId'";
    $result = $connect -> query($sql);

    if($result -> num_rows == 0){
        $jsonResult = "bad";
    } else {
        // 0으로만 변경하는 것
        $updateSql = "UPDATE drinkMember SET memberDelete = '0' WHERE myMemberId = '$myMemberId'";
        // $updateSql = "DELETE FROM drinkMember WHERE myMemberId='$myMemberId'";
        $connect -> query($updateSql);
        $jsonResult = "good";
    }
    echo json_encode(array("result" => $jsonResult));
?>