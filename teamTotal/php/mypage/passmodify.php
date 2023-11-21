<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    if(isset($_SESSION['myMemberID'])){
        $myMemberID = $_SESSION['myMemberID'];
    } else {
        $myMemberID = 0;
    }
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>취중진담</title>

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
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/mdify.css" rel="stylesheet" />
    <link href="../assets/css/common.css" rel="stylesheet" />

    <!-- js -->
    <script src="assets/js/scrollEvent.js"></script>
</head>

<body>
    <div id="wrapper">
         <!-- PC HEADER 840 < window -->
         <?php include "../include/header.php"; ?>

        <!-- M HEADER 840 > window -->
        <?php include "../include/logo.php"; ?>

        <?php include "../include/headerbottom.php"; ?>
        <!-- header end -->

        <main id="contents_area">
            <section id="main_contents">

                <div class="best_list boxStyle roundCorner shaDow">
                    <div class="find__form">
                        <form action="#" name="#" method="post">
                            <div>
                                <legend class="blind">비밀번호 재설정</legend>
                                <div class="header__box">
                                    <h1><a href="index.html">비밀번호 재설정</a></h1>
                                    <h2>비밀번호 재설정</h2>
                                    <p>아래에 정보를 입력하고 비밀번호를 재설정해보세요.</p>
                                </div>
                                <!-- 비밀번호는 아이디 / 이름 / 이메일이 있어야 재설정 할 수 있습니다. -->
                                <div class="">
                                    <div>
                                        <label for="youID" class="required">아이디</label>
                                        <input type="text" minlength="6" maxlength="20" name="youID"
                                            placeholder="아이디를 입력하세요." id="youID">
                                        <p class="check__msg">아이디를 입력하세요.</p>
                                    </div>
                                    <div>
                                        <label for="youPass" class="required">기존 비밀번호</label>
                                        <input type="password" minlength="8" maxlength="20" name="youPass"
                                            placeholder="비밀번호를 입력하세요." id="youPass">
                                        <p class="check__msg">기존 비밀번호를 입력하세요.</p>
                                    </div>
                                    <div>
                                        <label for="youNewPass" class="required">수정할 비밀번호</label>
                                        <input type="password" minlength="8" maxlength="20" name="youNewPass"
                                            placeholder="비밀번호를 입력하세요." id="youNewPass">
                                        <p class="check__msg" id="youNewPassComment"></p>
                                    </div>
                                    <div>
                                        <label for="youNewPassC" class="required">비밀번호 재확인</label>
                                        <input type="password" minlength="8" maxlength="20" name="youNewPassC"
                                            placeholder="비밀번호를 입력하세요." id="youNewPassC">
                                        <p class="check__msg" id="youNewPassCComment"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="modify__btn">
                                <div class="check__btn button__style" id="ModifyPass">수정 완료</div>
                                <div class="check__btn button__style" id="ModifyCancle">수정 취소</div>
                            </div>
                        </form>
                    </div>
                </div>


            </section>
            <!-- main_contents end -->

            <?php include "../include/sidewrap.php"; ?>
            <!-- side_box end -->

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        

        // 비밀번호

        // 수정 취소 버튼 --> 취소

        $("#ModifyCancle").click(function(){
            if (confirm("정말 수정을 취소하시겠습니까?")) {
                window.location.href = "mypage.php";
            } else {
            }
        });

        // 댓글 수정 버튼 --> 수정 버튼
        $("#ModifyPass").click(function(){

            // 새 비밀번호 유효성 검사
            if( $("#youNewPass").val() == '' ){
                    $("#youNewPassComment").text("➟ 8자리 ~ 20자리 이내로 입력해주세요");
            } else {
                let getYouPass = $("#youNewPass").val();
                let getYouPassNum = getYouPass.search(/[0-9]/g);
                let getYouPassEng = getYouPass.search(/[a-z]/ig);
                let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

                if(getYouPass.length < 8 || getYouPass.length > 20){
                    $("#youNewPassComment").text("➟ 8자리 ~ 20자리 이내로 입력해주세요");
                    return false;
                } else if (getYouPass.search(/\s/) != -1){
                    $("#youNewPassComment").text("➟ 비밀번호는 공백없이 입력해주세요!");
                    return false;
                } else if (getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0 ){
                    $("#youNewPassComment").text("➟ 영문, 숫자, 특수문자를 혼합하여 입력해주세요!");
                    return false;
                } 
            }

            // 새 비밀번호 확인 유효성 검사
            if($("#youNewPassC").val() == ''){
                $("#youNewPassCComment").text("➟ 확인 비밀번호를 입력해주세요!");
                $("#youPassre").focus();
                return false;
            }

            // 새 비밀번호 동일한지 체크
            if($("#youNewPass").val() !== $("#youNewPassC").val()){
                $("#youNewPassCComment").text("➟ 비밀번호가 일치하지 않습니다.");
                $("#youPass").focus();
                return false;
            } 

            if($("#youID").val() == "" || $("#youPass").val() == "" || $("#youNewPass").val() == "" || $("#youNewPassC").val() == ""){
                alert("비밀번호 변경 시 위의 사항을 모두 기입해주세요.");
                $("#youID").focus();
            } else {
                $.ajax({
                    url: "passmodifySave.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "youID": $("#youID").val(),
                        "youPass": $("#youPass").val(),
                        "youNewPass": $("#youNewPass").val(),
                        "myMemberID": <?=$myMemberID?>,
                    },
                    
                    success: function(data){
                        console.log(data);
                        if(data.result == "bad"){
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("비밀번호가 수정되었습니다.");
                        }
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    },
                    
                })
            }
            }
        );
    </script>

    
</body>

</html>