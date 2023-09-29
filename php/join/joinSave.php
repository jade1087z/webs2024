<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "../include/head.php"?>
</head>
<body class="gray">
<?php include "../include/skip.php"?>
<!-- skip end -->
<?php include "../include/header.php"?>
<!-- header end -->

    <main id="main" role="main">
            <div class="intro__inner bmStyle container">
                <div class="intro__img">
                    <img srcset="../assets/img/Rectangle@1.jpg, ../assets/img/Rectangle@2.jpg, ../assets/img/Rectangle@3.jpg" alt="">
                </div>
                <div class="intro__text">
                    <div class="intro__text">
<?php
    include "../connect/connect.php";

    $youEmail = $_POST['youEmail'];
    $youName = $_POST['youName'];
    $youPass = $_POST['youPass'];
    $youPassC = $_POST['youPassC'];
    $youPhone = $_POST['youPhone'];
    $regTime = time();
    // echo $youEmail, $youName, $youPass, $youPassC, $youPhone, $regTime;

    
    // 메시지 출력
    function msg($alert){
        echo "<p>$alert</p>";
    }
    

    // 유효성 검사 정규식
    
     // 1. 메일
    $check_mail = preg_match("/^[a-z0-9_+.-]+@([a-z0-9-]+\.)+[a-z0-9]{2,4}$/", $youEmail);
    if($check_mail == false) {
        mgs("이메일 형식이 잘못되었습니다. 다시 한번 확인해주세요");
        exit;
    }

    // 2. 이름
    $check_name = preg_match("/^[가-힣]{9,15}$/", $youName);
    if($check_name == false){
        msg("이름은 한글만 가능합니다. 또는 3~5글자만 가능합니다.");
        exit;   
    }

    // 3. 비밀번호 유효성 검사
    if($youPass !== $youPassC) {
        msg("비밀번호가 일치하지 않습니다. 다시 한 번 확인해주세요!");
        exit;
    }

    // 4. 휴대폰 번호 유효성 검사
    $check_number = preg_match("/^(010|011|016|017|018|019)-[0-9]{3,4}-[0-9]{4}$/", $youPhone);
    if($check_number == false){
        msg("번호가 정확하지 않습니다. 올바른 번호(000-0000-0000) 형식으로 작성해주세요!");
        exit;
    }

    // 이메일 중복 검사
    $isEmailCheck = false;
    $sql = "SELECT youEmail FROM members WHERE youEmail = '$youEmail'";
    $result = $connect -> query($sql);

    if($result){ // 있으면 1 없으면 0
        $count = $result -> num_rows;

        if($count == 0) {
            $isEmailCheck = true; // 데이터가 없다는 의미 --> 중복되는 이메일이 없음 -> 회원가입 가능
        } else {
            msg("이미 회원가입이 되어 있습니다. 로그인을 해주세요! mail");
        }
    } else { 
        msg("에러 발생1: 관리자에게 문의하세요");
    }

    // 핸드폰 중복검사
    $isPhoneCheck = false;
    $sql = "SELECT youPhone FROM members WHERE youPhone = '$youPhone'";
    $result = $connect -> query($sql);
    if($result) {
        $count = $result -> num_rows;

        if($count == 0) {
            $isPhoneCheck = true;
        } else {
            msg("이미 회원가입이 되어 있습니다. phone");
            
        }
    } else {
        msg("에러 발생1: 관리자에게 문의하세요");
    }
 

    // if($result) {
    //     msg ("회원가입이 완료되었습니다.");
    // } else {
    //     msg ("회원가입이 잘못되었습니다. 다시 입력바랍니다.");
    // }


    if($isEmailCheck == true && $isPhoneCheck == true) {
        $sql = "INSERT INTO members(youEmail, youName, youPass, youPhone, regTime) VALUES('$youEmail', '$youName', '$youPass', '$youPhone', '$regTime')";
        $result = $connect -> query($sql);

        if($result) {
            msg("회원가입을 축하합니다.! 로그인을 해주세요");
        } else {
            msg("에러 발생3");
            exit;
        }

    } else {
        msg("이미 회원가입이 되어있습니다. 다시 한번 확인해주세요: 회원가입 마지막");
    }

?>
                </div>
                <div class="intro__btn">
                    <a href="../main/main.php">메인으로</a>
                    <a href="../login/login.php">로그인</a>
                </div>
            </div>
        </div>
    </main>
<!-- main end  -->

    <?php include "../include/footer.php" ?>
<!-- footer end  -->
</body>
</html>