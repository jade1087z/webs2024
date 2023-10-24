<!DOCTYPE html>
<html lang="ko">

<head>
    <?php include "../include/head.php" ?>
    
    <!-- css -->
    <link href="../assets/css/join.css" rel="stylesheet" />
   

    <title>회원가입 페이지</title>
   
</head>

<body class="join__body">
    <div id="join__wrap">
        <main id="main">
            <div class="join__form">
                <form action="#" name="#" method="post">
                    <div>
                        <legend class="blind">회원가입 영역</legend>
                        <div class="header__box">
                            <h1><a href="index.html">취중진담</a></h1>
                            <p>회원이 되어 다양한 혜택을 경험해보세요.</p>
                        </div>
                        <!-- 아이디, 비밀번호, 비밀번호 확인, 이름, 닉네임, 이메일, 생년월일 // 아이디, 닉네임, 이메일 중복검사 -->
                        <div class="">
                            <div class="check">
                                <label for="youID" class="required">아이디</label>
                                <input type="text" minlength="6" maxlength="20"  name="youID" placeholder="아이디 입력(6~20)" id="youID">
                                <button class="check__btn button__style">중복 검사</button>
                                <p class="check__msg">아이디는 추후 수정이 불가합니다.</p>
                            </div>
                            <div>
                                <label for="youPass" class="required">비밀번호</label>
                                <input type="text" minlength="8" maxlength="20" name="youPass" placeholder="비밀번호 입력(문자, 숫자, 특수문자 포함 8~20)"
                                    id="youPass">
                                <p class="check__msg">아이디는 추후 수정이 불가합니다.</p>
                            </div>
                            <div>
                                <label for="youPassre" class="required">비밀번호 확인</label>
                                <input type="text" minlength="8" maxlength="20" name="youPassre" placeholder="비밀번호 재입력" id="youPassre">
                                <p class="check__msg">아이디는 추후 수정이 불가합니다.</p>
                            </div>
                            <div>
                                <label for="youName" class="required">이름</label>
                                <input type="text" minlength="2" maxlength="5"  name="youName" placeholder="이름 입력(문자 2~5)" id="youName">
                                <p class="check__msg">아이디는 추후 수정이 불가합니다.</p>
                            </div>
                            <div class="check">
                                <label for="youNick" class="required">닉네임</label>
                                <input type="text" minlength="2" maxlength="5" name="youNick" placeholder="닉네임 입력(문자 2~5)" id="youNick">
                                <button class="check__btn button__style">중복 검사</button>
                                <p class="check__msg">아이디는 추후 수정이 불가합니다.</p>
                            </div>
                            <div class="check">
                                <label for="youEmail" class="required">이메일</label>
                                <input type="text"  name="youEmail" placeholder="이메일 입력" id="youEmail">
                                <button class="check__btn button__style">중복 검사</button>
                                <p class="check__msg">아이디는 추후 수정이 불가합니다.</p>
                            </div>
                            <div class="birthday__box">
                                <label for="youBirth" class="required">생년월일</label>
                                <input type="text" maxlength="8" name="youBirth" placeholder="생년월일 8자 입력" id="youBirth">
                                <p class="check__msg">해당 사이트는 만 19세 미만 사용이 불가합니다.</p>
                            </div>
                        </div>
                    </div>
                    <div class="join__btn">
                        <button class="check__btn button__style">
                            <ul>
                                <li><a href="join.html">가입하기</a></li>
                            </ul>
                        </button>
                        <button class="check__btn button__style">
                            <ul>
                                <li><a href="index.html">가입취소</a></li>
                            </ul>
                        </button>
                    </div>
                </form>
            </div>
    </div>
    </main>
    </div>
</body>

</html>