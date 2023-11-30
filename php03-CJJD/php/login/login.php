<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include "../include/head.php" ?>
    <!-- 개별 css -->
    <link href="../assets/css/login.css" rel="stylesheet" />
</head>

<body class="login__body">
    <div id="wrap">
        <main id="login">
            <div class="login__box">
                <div class="left">
                    <img class="cocktail" src="../assets/img/cocktail.png" alt="cocktail" aria-hidden="true">
                    <img class="coconut" src="../assets/img/coconut.png" alt="coconut" aria-hidden="true">
                </div>
                <div class="right">
                    <div class="logo"><a href="../main/main.php">취중진담</a></div>
                    <div class="login_box">
                        <form action="loginSave.php" name="loginSave" method="post">
                            <input type="text" name="youId" placeholder="아이디를 입력하세요." class="login_ID" id="youId">
                            <input type="password" name="youPass" placeholder="비밀번호를 입력하세요." class="login_Pass"
                                id="youPass">
                            <div class="check">
                                <label for="agreeCheck1">
                                    아이디 저장
                                    <input type="checkbox" name="agreeCheck1" id="agreeCheck1">
                                    <span class="indicator"></span>
                                </label>
                            </div>
                            <ul class="button__style">
                                <li><button type="submit">로그인</button></li>
                            </ul>
                            <ul class="login_go">
                                <li><a href="findpass.html">비밀번호 찾기</a></li>
                                <li><a href="../join/join.php">회원가입</a></li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <footer id="footer">
            <p> 알코올은 발암물질로 지나친 음주는 간암, 위암 등을 일으킵니다.<br>
                임신 중 음주는 기형아 출생 위험을 높입니다.</p>
        </footer>
    </div>
</body>

</html>