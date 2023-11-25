<!DOCTYPE html>
<html lang="ko">

<head>
    <?php
    include "../include/head.php";
    ?>
    <!-- 개별 css -->
    <link href="../assets/css/join.css" rel="stylesheet" />
</head>

<body class="join__body">
    <div id="join__wrap">
        <main id="main">
            <div class="join__form">
                <form action="joinSuccess.php" name="joinSuccess" method="post" onsubmit="return joinChecks();">
                    <legend class="blind">회원가입 영역</legend>
                    <div class="header__box">
                        <a href="../main/main.php"><img src="../assets/img/logo.svg" alt=""></a>
                        <p>회원이 되어 다양한 혜택을 경험해보세요.</p>
                    </div>
                    <!-- 아이디, 비밀번호, 비밀번호 확인, 이름, 닉네임, 이메일, 생년월일 // 아이디, 닉네임, 이메일 중복검사 -->
                    <div>
                        <div class="check box">
                            <label for="youId" class="required">아이디</label>
                            <input type="text" minlength="6" maxlength="20" name="youId" placeholder="아이디 입력(6~20)"
                                id="youId">
                            <div class="check__btn button__style" onclick="idChecking()">중복 검사</div>
                            <p class="check__msg btn_01" id="youIdComment"></p>
                        </div>
                        <div class="box">
                            <label for="youPass" class="required">비밀번호</label>
                            <input type="password" minlength="8" maxlength="20" name="youPass"
                                placeholder="비밀번호 입력(문자, 숫자, 특수문자 포함 8~20)" id="youPass" autocomplete="on">
                            <p class="check__msg" id="youPassComment"></p>
                        </div>
                        <div class="box">
                            <label for="youPassre" class="required">비밀번호 확인</label>
                            <input type="password" minlength="8" maxlength="20" name="youPassre" placeholder="비밀번호 재입력"
                                id="youPassre" autocomplete="on">
                            <p class="check__msg" id="youPassreComment"></p>
                        </div>
                        <div class="box">
                            <label for="youName" class="required">이름</label>
                            <input type="text" minlength="2" maxlength="5" name="youName" placeholder="이름 입력(문자 2~5)"
                                id="youName">
                            <p class="check__msg" id="youNameComment"></p>
                        </div>
                        <div class="check box">
                            <label for="youNick" class="required">닉네임</label>
                            <input type="text" minlength="2" maxlength="5" name="youNick" placeholder="닉네임 입력(문자 2~5)"
                                id="youNick">
                            <div class="check__btn button__style " onclick="NickChecking()">중복 검사</div>
                            <p class="check__msg btn_01" id="youNickComment"></p>
                        </div>
                        <div class="check box">
                            <label for="youEmail" class="required">이메일</label>
                            <input type="email" name="youEmail" placeholder="이메일 입력" id="youEmail">
                            <div class="check__btn button__style" onclick="emailChecking()">중복 검사</div>
                            <p class="check__msg btn_01" id="youEmailComment"></p>
                        </div>
                        <div>
                            <label for="youAddress1" class="required">주소</label>
                            <div class="check youAddress1">
                                <input type="text" id="youAddress1" name="youAddress1" placeholder="우편번호"
                                    class="input__style">
                                <div class="check__btn" id="addressCheck">주소 찾기</div>
                            </div>
                            <label for="youAddress2" class="blind"></label>
                            <input type="text" id="youAddress2" name="youAddress2" placeholder="주소"
                                class="input__style">
                            <label for="youAddress3" class=" blind youAddress3"></label>
                            <input type="text" id="youAddress3" name="youAddress3" placeholder="상세 주소"
                                class="input__style">
                            <p class="msg box" id="youAddressComment"></p>
                        </div>
                        <div class="birthday__box box">
                            <label for="youBirth" class="required">생년월일</label>
                            <input type="text" maxlength="8" name="youBirth" placeholder="생년월일 8자 입력" id="youBirth">
                            <p class="check__msg" id="youBirthComment">해당 사이트는 만 19세 미만 사용이 불가합니다.</p>
                        </div>
                    </div>
                    <div class="join__btn">
                        <button class="check__btn button__style">가입하기</button>
                    </div>
                </form>
            </div>
    </div>
    </main>
    </div>

    <div id="layer">
        <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" alt="닫기 버튼">
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>

    <script>
        let isIdCheck = false;
        let isNickCheck = false;
        let isEmailCheck = false;

        let isPassCheck = false;
        let isPassReCheck = false;

        $("#youId").change(function () {
            isIdCheck = false;
        });
        $("#youNick").change(function () {
            isNickCheck = false;
        });
        $("#youEmail").change(function () {
            isEmailCheck = false;
        });
        $("#youPass").change(function () {
            isPassCheck = false;
        });
        $("#youPassre").change(function () {
            isPassReCheck = false;
        });


        // 아이디 체크
        function idChecking() {
            let youId = $("#youId").val();

            if (youId == null || youId == '') {
                $("#youIdComment").text("-> 아이디를 작성해주세요!");
            } else {
                // 아이디 유효성 검사 
                let getYouId = RegExp(/^[a-zA-Z0-9_-]{4,20}$/);

                if (!getYouId.test($("#youId").val())) {
                    $("#youIdComment").text("아이디는 영어와 숫자를 포함하여 4~20글자 이내로 작성이 가능합니다.");
                    $("#youIdComment").removeClass("green");
                    $("#youId").val('')
                    $("#youId").focus('');
                    return false;
                } else {
                    $("#youIdComment").text("아이디가 입력되었습니다.");
                    $("#youIdComment").addClass("green");
                }

                $.ajax({
                    type: "POST",
                    url: "joinCheck.php",
                    data: { "youId": youId, "type": "isIdCheck" },
                    dataType: "json",
                    success: function (data) {
                        if (data.result == "good") {
                            $("#youIdComment").text("사용 가능한 아이디입니다.");
                            $("#youIdComment").addClass("green");
                            isIdCheck = true;
                        } else {
                            $("#youIdComment").text("이미 존재하는 아이디입니다.");
                            $("#youIdComment").removeClass("green");

                            isIdCheck = false;
                        }
                    }
                })
            }
        }

        // 닉네임 체크
        function NickChecking() {
            let youNick = $("#youNick").val();

            if (youNick == null || youNick == '') {
                $("#youNickComment").text("-> 닉네임을 입력해주세요.");
                $("#youNickComment").removeClass("green");
            } else {
                // 닉네임 유효성 검사 
                let getYouNick = RegExp(/^[a-zA-Z0-9가-힣_-]{2,5}$/);

                if (!getYouNick.test($("#youNick").val())) {
                    $("#youNickComment").text("닉네임은 2~5글자만 가능합니다.");
                    $("#youNickComment").removeClass("green");
                    $("#youNick").val('')
                    $("#youNick").focus('');
                    return false;
                } else {
                    $("#youNickComment").text("사용 가능한 닉네임입니다.");
                    $("#youNickComment").addClass("green");
                }

                $.ajax({
                    type: "POST",
                    url: "joinCheck.php",
                    data: { "youNick": youNick, "type": "isNickCheck" },
                    dataType: "json",
                    success: function (data) {
                        if (data.result == "good") {
                            $("#youNickComment").text("사용 가능한 닉네임입니다.");
                            $("#youNickComment").addClass("green");
                            isNickCheck = true;
                        } else {
                            $("#youNickComment").text("이미 존재하는 닉네임입니다.");
                            $("#youNickComment").removeClass("green");
                            isNickCheck = false;
                        }
                    }
                })
            }
        }

        // 이메일 체크
        function emailChecking() {
            let youEmail = $("#youEmail").val();

            if (youEmail == null || youEmail == '') {
                $("#youEmailComment").text("-> 이메일을 작성해주세요!");
            } else {
                // 이메일 유효성 검사
                let getYouEmail = RegExp(/^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([\-.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i);

                if (!getYouEmail.test($("#youEmail").val())) {
                    $("#youEmailComment").text("올바른 이메일 주소를 사용해주세요");
                    $("#youEmailComment").removeClass("green");
                    $("#youEmail").val('');
                    $("#youEmail").focus();

                    return false;
                } else {
                    $("#youEmailComment").text("이메일이 입력되었습니다.");
                    $("#youEmailComment").addClass("green");
                }

                $.ajax({
                    type: "POST",
                    url: "joinCheck.php",
                    data: { "youEmail": youEmail, "type": "isEmailCheck" },
                    dataType: "json",
                    success: function (data) {
                        if (data.result == "good") {
                            $("#youEmailComment").text("사용 가능한 이메일입니다.");
                            $("#youEmailComment").addClass("green");

                            isEmailCheck = true;
                        } else {
                            $("#youEmailComment").text("이미 존재하는 이메일입니다.");
                            $("#youEmailComment").removeClass("green");
                            isEmailCheck = false;
                        }
                    }
                })

            }
        }

        // 비밀번호 유효성 체크
        const pwCheck = () => {
            let getYouPass = $("#youPass").val();
            let getYouPassNum = getYouPass.search(/[0-9]/g);
            let getYouPassEng = getYouPass.search(/[a-z]/ig);
            let getYouPassSpe = getYouPass.search(/[`~!@@#$%^&*|₩₩₩'₩";:₩/?]/gi);

            if (getYouPass.length < 8 || getYouPass.length > 20) {
                $("#youPassComment").text("➟ 8자리 ~ 20자리 이내로 입력해주세요");
                $("#youPass").focus();

                isPassCheck = false;
                return false;
            } else if (getYouPass.search(/\s/) != -1) {
                $("#youPassComment").text("➟ 비밀번호는 공백없이 입력해주세요!");
                $("#youPass").focus();

                isPassCheck = false;
                return false;
            } else if (getYouPassNum < 0 || getYouPassEng < 0 || getYouPassSpe < 0) {
                $("#youPassComment").text("➟ 영문, 숫자, 특수문자를 혼합하여 입력해주세요!");
                $("#youPass").focus();

                isPassCheck = false;
                return false;
            } else {
                $("#youPassComment").text("");
                isPassCheck = true;
                return true;
            }
        };

        // 비밀번호 동일한지 체크
        const pwReCheck = () => {
            if ($("#youPass").val() !== $("#youPassre").val()) {
                $("#youPassreComment").text("➟ 비밀번호가 일치하지 않습니다.");
                $("#youPassre").focus();

                isPassReCheck = false;
                return false;
            } else {
                $("#youPassreComment").text("");
                isPassReCheck = true;
                return true;
            }
        }

        // key up 시 함수 실행
        $("#youPass").keyup(function () {
            pwCheck();
        });

        $("#youPassre").keyup(function () {
            pwReCheck();
        });



        // 조인 체크
        function joinChecks() {

            // 중복 확인이 이루어 졌는지 검사
            if (!isIdCheck || !isNickCheck || !isEmailCheck) {
                alert("중복 검사를 먼저 진행해주세요!");
                return false;
            }


            // 이름 유효성 검사 
            if ($("#youName").val() == '') {
                $("#youNameComment").text("이름을 입력해주세요!");
                $("#youName").focus();
                return false;
            } else {
                let getYouName = RegExp(/^[가-힣]{3,5}$/);

                if (!getYouName.test($("#youName").val())) {
                    $("#youNameComment").text("이름은 한글(3~5글자)만 사용할 수 있습니다.");
                    $("#youName").val('');
                    $("#youName").focus();
                    return false;
                }
            }


            if (!isPassCheck || !isPassReCheck) {
                pwCheck();
                pwReCheck();
                return false;
            }

            // 가입시 비밀번호 유효성 재검사
            if ($("#youPass").val() == '') {
                $("#youPassComment").text("➟ 비밀번호를 입력해주세요!");
                $("#youPass").focus();
                return false;
            } else {
                if (!pwCheck()) {

                    isPassCheck = false;
                    return false;
                } else {

                    isPassCheck = true;
                }
            }

            // 가입시 비밀번호 유효성 재검사
            if ($("#youPassre").val() == '') {
                $("#youPassreComment").text("➟ 확인 비밀번호를 입력해주세요!");
                $("#youPassre").focus();
                return false;
            } else {
                if (!pwReCheck()) {

                    isPassReCheck = false;
                    return false;
                } else {

                    isPassReCheck = true;
                }
            }

            //생년월일 유효성
            if ($("#youBirth").val() == '') {
                $("#youBirthComment").text("-> 생년월일을 작성해주세요!");
                $("#youBirth").focus();

                return false;
            } else {
                let getYouBirth = RegExp(/^(200[0-3]|19\d{2})\d{4}$/);

                if (!getYouBirth.test($("#youBirth").val())) {
                    $("#youBirthComment").text("2003년생 이후 출생은 서비스 이용이 불가합니다.");
                    $("#youBirth").val('');
                    $("#youBirth").focus();

                    return false;
                }
            }
        }
    </script>

    <script>
        // 우편번호 찾기 화면을 넣을 element
        const layer = document.querySelector("#layer");
        const searchIcon = document.querySelector("#addressCheck");
        const layerCloseBtn = document.querySelector("#btnCloseLayer");

        searchIcon.addEventListener('click', searchBtnClick);
        layerCloseBtn.addEventListener('click', closeDaumPostcode);

        function closeDaumPostcode() {
            // iframe을 넣은 element를 안보이게 한다.
            layer.style.display = 'none';
        }

        const themeObj = {
            //bgColor: "", //바탕 배경색
            searchBgColor: "#0B65C8", //검색창 배경색
            //contentBgColor: "", //본문 배경색(검색결과,결과없음,첫화면,검색서제스트)
            //pageBgColor: "", //페이지 배경색
            //textColor: "", //기본 글자색
            queryTextColor: "#FFFFFF" //검색창 글자색
            //postcodeTextColor: "", //우편번호 글자색
            //emphTextColor: "", //강조 글자색
            //outlineColor: "", //테두리
        };

        function searchBtnClick() {
            new daum.Postcode({
                theme: themeObj,
                oncomplete: function (data) {
                    // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    let addr = ''; // 주소 변수
                    let extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    /*
                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if (data.userSelectedType === 'R') {
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if (data.buildingName !== '' && data.apartment === 'Y') {
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if (extraAddr !== '') {
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        document.getElementById("sample2_extraAddress").value = extraAddr;

                    } else {
                        document.getElementById("sample2_extraAddress").value = '';
                    }
                    */


                    document.querySelector('#youAddress1').value = data.zonecode; // 우편번호
                    document.querySelector("#youAddress2").value = addr; // 주소
                    document.querySelector("#youAddress3").focus();

                    // iframe을 넣은 element를 안보이게 한다.
                    // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
                    layer.style.display = 'none';
                },
                width: '100%',
                height: '100%',
                maxSuggestItems: 5
            }).embed(layer);

            // iframe을 넣은 element를 보이게 한다.
            layer.style.display = 'block';

            // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
            initLayerPosition();
        }

        // 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
        // resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
        // 직접 layer의 top,left값을 수정해 주시면 됩니다.
        function initLayerPosition() {
            const width = 500; //우편번호서비스가 들어갈 element의 width
            const height = 500; //우편번호서비스가 들어갈 element의 height
            const borderWidth = 5; //샘플에서 사용하는 border의 두께

            // 위에서 선언한 값들을 실제 element에 넣는다.
            layer.style.width = width + 'px';
            layer.style.height = height + 'px';
            layer.style.border = borderWidth + 'px solid';
            // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
            layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width) / 2 - borderWidth) + 'px';
            layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height) / 2 - borderWidth) + 'px';
        }
    </script>
</body>

</html>