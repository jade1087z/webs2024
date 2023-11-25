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

                    <?php
                    include "../connect/connect.php";
                    include "../connect/session.php";

                    $youId = $_POST['youId'];
                    $youPass = $_POST['youPass'];

                    echo $youId, $youPass;

                    //메세지 출력
                    function msg($alert)
                    {
                        echo "<script>alert('$alert');</script>";
                    }

                    //데이터 조회
                    $sql = "SELECT myMemberId, youId, youEmail, youName, youPass FROM drinkMember WHERE youId = '$youId' AND youPass = '$youPass' AND memberDelete = 1";
                    $result = $connect->query($sql);

                    if ($result) {
                        $count = $result->num_rows;

                        if ($count == 0) {
                            $alert = "이메일 또는 비밀번호가 틀렸습니다. 다시 확인하세요";
                            msg($alert);
                            echo "<script>window.location.href='../login/login.php';</script>";


                        } else {
                            $memberInfo = $result->fetch_array(MYSQLI_ASSOC);

                            // echo "<pre>";
                            // var_dump($memberInfo);
                            // echo "</pre>";
                    
                            //로그인 성공 ---> 세션 생성
                            $_SESSION['youId'] = $memberInfo['youId'];
                            $_SESSION['youEmail'] = $memberInfo['youEmail'];
                            $_SESSION['youName'] = $memberInfo['youName'];
                            $_SESSION['myMemberId'] = $memberInfo['myMemberId'];

                            $alert = "환영합니다.";
                            msg($alert);
                            echo "<script>window.location.href='../main/main.php';</script>";

                        }
                    } else {

                        return false;
                    }

                    ?>
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