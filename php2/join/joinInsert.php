<?php
?>



<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 페이지</title>
    <?php include "../include/head.php" ?>
</head>

<body class="gray">
    <?php include "../include/skip.php" ?>
    <?php include "../include/header.php" ?>



    <!-- //header -->

    <main id="main" role="main">
        <div class="intro__inner bmStyle container">
            <div class="intro__img">
                <img srcset="../assets/img/main.jpg, ../assets/img/main@2.jpg, ../assets/img/main@3.jpg" alt="">
            </div>
            <div class="intro__text">
                어떤 일이라도 노력하고 즐기면 그 결과는 빛을 바란다고 생각합니다.
                십입의 열정과 도전정신을 깊숙히 새기며 배움에 있어 겸손함을
                유지하며 세부적인 곳까지 파고드는 개발자가 되겠습니다.
            </div>
        </div>
        <section class="join__inner container">
            <h2>이용약관</h2>
            <div class="join__index">
                <ul>
                    <li>1</li>
                    <li>2</li>
                    <li class="active">3</li>
                </ul>
            </div>
            <div class="join__insert">
                <?php


                ?>
                <form action="joinResult.php" name="joinResult" method="post" onsubmit="return joinChecks();">
                    <fieldset>
                        <legend class="blind">회원가입 영역</legend>
                        <div class="join">

                            <label for="youId" class="required">아이디</label>
                            <div class="check">
                                <input type="text" id="youId" name="youId" placeholder="아이디을 적어주세요!" class="input__style">
                                <div class="btn" onclick="idChecking()">아이디 중복 검사</div>
                            </div>
                            <p class="msg" id="youIdComment"></p>
                        </div>

                        <div class="join">
                            <label for="memberName" class="required">이름</label>
                            <input type="text" id="memberName" name="memberName" placeholder="이름을 적어주세요!" class="input__style">
                            <p class="msg" id="memberNameMsg"></p>
                        </div>

                        <div class="join">
                            <label for="memberEmail" class="required">이메일</label>
                            <div class="check">
                                <input type="email" id="memberEmail" name="memberEmail" placeholder="이메일을 적어주세요!" class="input__style">
                                <div class="btn" onclick="emailChecking()">이메일 중복 검사</div>
                            </div>
                            <p class="msg" id="memberEmailMsg"></p>
                        </div>

                        <div class="join">
                            <label for="memberPass" class="required">비밀번호</label>
                            <input type="text" id="memberPass" name="memberPass" placeholder="비밀번호를 적어주세요!" autocomplete="off" class="input__style">
                            <p class="msg" id="memberPassMsg"></p>
                        </div>

                        <div class="join">
                            <label for="memberPassC" class="required">비밀번호 확인</label>
                            <input type="password" id="memberPassC" name="memberPassC" placeholder="다시 한번 비밀번호를 적어주세요!" autocomplete="off" class="input__style">
                            <p class="msg" id="memberPassCMsg"></p>
                        </div>

                        <div class="join">
                            <label for="memberAddress1" class="required">주소</label>
                            <div class="check">
                                <input type="text" id="memberAddress1" name="memberAddress1" placeholder="우편번호" class="input__style">
                                <button class="btn">주소 찾기</button>
                            </div>
                            <label for="memberAddress2" class="required blind">주소</label>
                            <input type="text" id="memberAddress2" name="memberAddress2" placeholder="주소" class="input__style">
                            <label for="memberAddress3" class="required blind">상세 주소</label>
                            <input type="text" id="memberAddress3" name="memberAddress3" placeholder="상세 주소" class="input__style">
                            <p class="msg" id="memberAddressMsg"></p>
                        </div>

                        <div class="join">
                            <label for="memberPhone">연락처</label>
                            <input type="text" id="memberPhone" name="memberPhone" placeholder="연락처는 공백없이 적어주세요!" class="input__style">
                            <p class="msg" id="memberPhoneMsg"></p>
                        </div>

                        <button type="submit" id="submitBtn" class="btn__style mt100">회원가입 완료</button>
                    </fieldset>
                </form>
            </div>
        </section>
        <!-- <div class="join__form">
                <form action="joinResult" name="joinResult" method="post" onsubmit="return joinCheck">
                    <fieldset>
                        <legend class="blind">회원가입 영역</legend>
                        <div class="check">
                            <label for="youId" class="required">아이디</label>
                            <input type="email" id="youId" name="youId" placeholder="아이디를 적어주세요!" class="input_style check__style" required>
                            <div class="check__btn btn__style3">아이디 중복 검사</div>
                            <p class="check__msg" id="youIDComment">메시지 출력</p>
                        </div>
                        <div class="check">
                            <label for="youEmail" class="required">이메일</label>
                            <input type="text" id="youEmail" name="youEmail" placeholder="이메일을 적어주세요!" class="input_style" required>
                            <div class="check__btn btn__style3">이메일 중복 검사</div>
                            <p class="check__msg" id="youIDComment">메시지 출력</p>
                        </div>
                        <div>
                            <label for="youPass" class="required">비밀번호</label>
                            <input type="text" id="youPass" name="youPass" placeholder="비밀번호를 적어주세요!" class="input_style" required>
                            <p class="check__msg" id="youIDComment">메시지 출력</p>
                        </div>
                        <div>
                            <label for="youPassC" class="required">비밀번호 확인</label>
                            <input type="paddword" id="youPassC" name="youPassC" placeholder="다시 한번 비밀번호를 적어주세요!" class="input_style" required>
                            <p class="check__msg" id="youIDComment">메시지 출력</p>
                        </div>
                        <div class="check2">
                            <label for="youAdress" class="required">주소</label>
                            <input type="text" id="youAdress1" name="youAdress" placeholder="우편번호" class="input_style mb10" required>
                            <div class="check__btn btn__style3">주소 찾기</div>
                            <input type="text" id="youAdress" name="youAdress" placeholder="주소" class="input_style mb10" required>
                            <input type="text" id="youAdress" name="youAdress" placeholder="상세주소" class="input_style" required>
                        </div>
                        <div>
                            <label for="youPhone">연락처</label>
                            <input type="text" id="youPhone" name="youPhone" placeholder="연락처를 적어주세요!" class="input_style" required>
                            <p>연락처는(000-0000-0000) 형식으로 작성해주세요!</p>
                        </div>
                        <button type="submit" class="btn_style mt100">회원가입 완료</button>
                    </fieldset>
                </form>
            </div> -->

    </main>
    <!-- //main -->


    <?php include "../include/footer.php" ?>
    <!-- //footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        let isIdCheck = false;

        function idChecking() {
            let youId = $("#youId").val();

            if(youId == null || youId == '') {
                $("#youIdComment").text("** 아이디를 입력해주세요");
            } else {
            // 아이디 유효성 검사
                let getYouId = RegExp(/^[a-zA-Z0-9_-]{4,20}$/);

                if(!getYouId.test($("#youId").val())){
                    $("#youIdComment").text("아이디는 영어와 숫자를 포함하여 4~20글자 이내로 작성이 가능합니다.");
                    $("#youId").val('');
                    $("#youId").focus();
                    return false;
                } else {
                    $("#youIdComment").text("!good!");
                    $("#youIdComment").addClass("green");
                };

                $.ajax({
                    type: "POST", 
                    url: "joinCheck.php",
                    data: {"youId": youId, "type": "isIdCheck"},
                    dataType: "json",
                    success: function(data){
                        if(data.result == "good") {
                            $("#youIdComment").text("사용 가능한 아이디입니다.");
                            isIdCheck = true;
                        } else {
                            $("#youIdComment").text("이미 존재하는 아이디입니다.");
                            isIdCheck = false;
                        }
                    }
                })
            }
        }

        function joinChecks() {
            if($("#youId").val() == '') {
                $("#youIdComment").text("-> 이름을 작성해주세요!");
                $("#youId").focus();
                return false;
            }
        }


    </script>
</body>

</html>