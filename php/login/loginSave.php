<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>
    <?php include "../include/head.php"?>
</head>
<body class="gray">
    <?php include "../include/skip.php"?>
    <?php include "../include/header.php"?>
<!-- //header -->
<main id="main" role="main">
<div class="intro__inner bmStyle container">
                <div class="intro__img">
                    <img srcset="../assets/img/Rectangle@1.jpg, ../assets/img/Rectangle@2.jpg, ../assets/img/Rectangle@3.jpg" alt="">
                </div>
                <div class="intro__text">
                    <div class="intro__text">
<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    $youEmail = $_POST['youEmail'];
    $youPass = $_POST['youPass'];

    // echo $youEmail, $youPass;
    function msg($alert){
        echo "<p>$alert</p>";
    }
    // 데이터 조회
    // members 데이터 중에 아이디가 3번인 회원 
    // SELECT memberID FROM members WHERE memberID = 3;
    
    // MEMBERS 데이터 중에 이메일 비번
    $sql = "SELECT * FROM members WHERE youEmail = '$youEmail' AND youPass = '$youPass'";
    $result = $connect -> query($sql);

    if($result) {
        $count = $result -> num_rows;

        if($count == 0){
            msg("이메일 또는 비밀번호가 틀렸습니다. 다시 한번 확인해주세요!: 1");
        } else {
            $memberInfo = $result -> fetch_array(MYSQLI_ASSOC); // 데이터를 배열로 가져옴 
            
            // 로그인 성공 -> 세션 생성
            $_SESSION['memberID'] = $memberInfo['memberID'];
            $_SESSION['youEmail'] = $memberInfo['youEmail'];
            $_SESSION['youName'] = $memberInfo['youName'];

            Header("Location: ../main/main.php");



            // echo "<pre>";
            // var_dump($memberInfo);
            // echo "</pre>";


        }
    }

    
?>
    </main>
<!-- //main -->

    
    <?php include "../include/footer.php" ?>
<!-- //footer -->
</body>
</html>