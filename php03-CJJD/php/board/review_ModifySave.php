<?php 
    include "../connect/connect.php";

    $reviewMsg = $_POST['reviewMsg'];
    $reviewPass = $_POST['reviewPass'];
    $reviewId = $_POST['reviewId'];

    $sql = "SELECT reviewPass FROM drinkreview WHERE reviewPass = '$reviewPass' AND reviewId = '$reviewId'";
    $result = $connect -> query($sql);

    if($result -> num_rows == 0){
        $jsonResult = "bad";
    } else {
        $updateSql = "UPDATE drinkreview SET reviewMsg = '$reviewMsg' WHERE reviewId = '$reviewId'";
        $connect -> query($updateSql);
        $jsonResult = "good";
    }

    echo json_encode(array("result" => $jsonResult));
?>