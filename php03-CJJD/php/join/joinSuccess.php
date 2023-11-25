<?php
include "../connect/connect.php";

$youId = mysqli_real_escape_string($connect, $_POST['youId']);
$youPass = mysqli_real_escape_string($connect, $_POST['youPass']);
$youName = mysqli_real_escape_string($connect, $_POST['youName']);
$youNick = mysqli_real_escape_string($connect, $_POST['youNick']);
$youEmail = mysqli_real_escape_string($connect, $_POST['youEmail']);
$youBirth = mysqli_real_escape_string($connect, $_POST['youBirth']);
$youAddress = mysqli_real_escape_string($connect, $_POST['youAddress1'] . "*" . $_POST['youAddress2'] . "*" . $_POST['youAddress3']);
$youImgFile = "profile.png";

$regTime = time();

$sql = "INSERT INTO drinkMember(youId, youPass, youName, youNick, youEmail, youBirth, youAddress, youImgFile, regTime) VALUES ('$youId', '$youPass', '$youName', '$youNick', '$youEmail', '$youBirth', '$youAddress', '$youImgFile', $regTime)";
$connect->query($sql);

// 데이터 베이스 연결 닫기
mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include "../include/head.php"; ?>
    <link href="../assets/css/join_collect.css" rel="stylesheet" />

</head>

<body>
    <div id="wrap">
        <main id="collect">
            <div class="collect_box">
                <div class="collect_text">
                    <h2>회원가입이 완료되었습니다!</h2>
                    <img src="../assets/img/circlecheck.svg" alt="" class="fade-in">
                    <p>
                        <?php echo $youName ?>님의 회원가입을 축하합니다.<br>
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