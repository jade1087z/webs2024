<?php 
    include "../connect/connect.php";
    include "../connect/session.php";

    $youNick = $_POST['modifyProfile'];
    $youPass = $_POST['modifyPass'];
    $myMemberId = $_SESSION['myMemberId'];

    $youImgFile = $_FILES['youImgFile'];
    $youImgSize = $_FILES['youImgFile']['size'];
    $youImgType = $_FILES['youImgFile']['type'];
    $youImgName = $_FILES['youImgFile']['name'];
    $youImgTmp = $_FILES['youImgFile']['tmp_name'];

    $sql = "SELECT youPass FROM drinkMember WHERE youPass = '$youPass' AND myMemberId = '$myMemberId'";
    $result = $connect->query($sql);

    if ($result->num_rows == 0) {
        echo "<script>alert('비밀번호가 다릅니다.')</script>";
        echo "<script>window.location.href='profile_modify.php';</script>";
    } else {
    
        if($youNick != "" || $youImgFile != ""){
    
            if ($youNick != "") {
                $updateSql = "UPDATE drinkMember SET youNick = '$youNick' WHERE myMemberId = '$myMemberId'";
                $connect->query($updateSql);
            }
    
            if ($youImgFile != "") {
                $fileTypeExtension = explode("/", $youImgType);
                $fileType = $fileTypeExtension[0];
                $fileExtension = $fileTypeExtension[1];
    
                if ($fileExtension === "jpg" || $fileExtension === "jpeg" || $fileExtension === "png" || $fileExtension === "gif" || $fileExtension === "webp") {
                    $youImgDir = "../assets/profile/";
                    $youImgName = "Img_" . time() . rand(1, 99999) . "." . $fileExtension;
    
                    if (!file_exists($youImgDir)) {
                        mkdir($youImgDir, 0755, true);
                    }
    
                    if (move_uploaded_file($youImgTmp, $youImgDir . $youImgName)) {
                        $updateSql = "UPDATE drinkMember SET youImgFile = '$youImgName' WHERE myMemberId = '$myMemberId'";
                        $connect->query($updateSql);
                        echo "<script>alert('저장이 완료되었습니다.')</script>";
                    } else {
                        echo "<script>alert('이미지 업로드 중 오류가 발생했습니다.')</script>";
                    }
                } else {
                    echo "<script>alert('저장이 완료되었습니다.')</script>";
                }
            }
        } else {
        }
    }  echo "<script>window.location.href='mypage.php';</script>";
?>