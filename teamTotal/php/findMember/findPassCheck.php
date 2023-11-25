<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youId = $_POST['youId'];
    $youName = $_POST['youName'];
    $youEmail = $_POST['youEmail'];
    
    $youId = $connect -> real_escape_string(trim($youId));
    $youName = $connect -> real_escape_string(trim($youName));
    $youEmail = $connect -> real_escape_string(trim($youEmail));
    
    $sql = "SELECT youPass FROM drinkMember WHERE youId='$youId' AND youName='$youName' AND youEmail='$youEmail'";
    
    $result = $connect -> query($sql);

    $count = $result -> num_rows;
    
    $findPass = $result -> fetch_array(MYSQLI_ASSOC);

    $realYouPass = $findPass['youPass'];

    if($count == 1) {
        echo "($realYouPass)";
        echo "<script>alert('" . json_encode($findPass) . "')</script>";
        $_SESSION['realYouPass'] = $realYouPass;
        header('Location: findpass.php?success=1');

    } else {
        $pleaseMsg = "이메일과 아이디를 다시 확인해주세요";
        $_SESSION['plsMsg'] = $pleaseMsg;
        header('Location: findpass.php?success=0');
    }

    // 해당 쿼리문으로 찾음
    //SELECT youPass FROM drinkMemberTest WHERE youId='$youId' AND youName='임종한' AND youEmail='danziro@naver.com';
    // 인젝션 공격 방어 보안
    // 비밀번호 변경 옵션 
    // 
?>
