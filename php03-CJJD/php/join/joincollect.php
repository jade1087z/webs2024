<?php
    include "../connect/connect.php";

    $youId = mysqli_real_escape_string($connect, $_POST['youId']);
    $youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
    $youName = mysqli_real_escape_string($connect, $_POST['youName']);
    $youNick = mysqli_real_escape_string($connect, $_POST['youNick']);
    $youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
    $youAddress = mysqli_real_escape_string($connect, $_POST['youAddress1']."*".$_POST['youAddress2']."*".$_POST['youAddress3']);

    $youBirth = mysqli_real_escape_string($connect, $_POST['youBirth']);
    $regTime = time();

    $sql = "INSERT INTO drinkMember(youId, youPass, youName, youNick, youEmail, youBirth, youAddress, regTime) VALUES ('$youId', '$youPass', '$youName', '$youNick', '$youEmail', '$youBirth', '$youAddress', $regTime)";
    $connect -> query($sql);

    // 데이터 베이스 연결 닫기
    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- meta -->
    <meta name="author" content="취중진담">
    <meta name="description" content="프론트엔드 개발자 포트폴리오 조별과제 사이트입니다.">
    <meta name="keywords" content="웹퍼블리셔,프론트엔드, php, 포트폴리오, 커뮤니티, 술, publisher, css3, html, markup, design">
    
    <!-- favicon -->
    <link rel="icon" href="assets/favicon/favicon.ico" type="image/x-icon">
 
    <!-- fontasome -->
    <script src="https://kit.fontawesome.com/2cf6c5f82a.js" crossorigin="anonymous"></script>
    
    <!-- css -->
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link href="../assets/css/fonts.css" rel="stylesheet" />
    <link href="../assets/css/join_collect.css" rel="stylesheet" />
    <link href="../assets/css/common.css" rel="stylesheet" />

    <!-- js -->
    <script src="assets/js/scrollEvent.js"></script>

    <!-- 회원가입 성공 페이지는 로그인 css와 연동했습니다.-->

    <title>로그인 페이지</title>
    <style>
    </style>
</head>

<body>
    <div id="wrap">
        <main id="collect">
            <div class="collect_box">
                <div class="collect_text">
                    <h2>회원가입이 완료되었습니다!</h2>
                    <img src="../assets/img/circlecheck.svg" alt="" class="fade-in">
                    <p>
                        <?php $youName ?>님의 회원가입을 축하합니다.<br>
                        다양한 콘텐츠를 즐겨보세요!
                    </p>
                </div>
                <ul class="button__style">
                    <li><a href="../login/login.php">로그인</a></li>
                </ul>
            </div>
        </main>
        <footer id="footer">
            <p> 알코올은 발암물질로 지나친 음주는 간암, 위암 등을 일으킵니다.<br>
                임신 중 음주는 기형아 출생 위험을 높입니다.</p>
        </footer>
    </div>
</body>

</html>