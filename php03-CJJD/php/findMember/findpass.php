<?php
include "../connect/connect.php";
include "../connect/session.php";

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon -->
    <link rel="icon" href="assets/favicon/favicon.ico" type="image/x-icon">

    <!-- fontasome -->
    <script src="https://kit.fontawesome.com/2cf6c5f82a.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link href="../assets/css/fonts.css" rel="stylesheet" />
    <link href="../assets/css/find.css" rel="stylesheet" />
    <link href="../assets/css/common.css" rel="stylesheet" />

    <!-- js -->
    <script src="assets/js/scrollEvent.js"></script>

    <title>비밀번호 찾기</title>
    <style>
    </style>
</head>

<body>
    <div id="find_wrap">
        <main id="main">
            <div class="find__form">
                <form action="findPassCheck.php" class="findPassCheck" name="findPassCheck" method="post">
                    <div>
                        <legend class="blind">비밀번호 찾기</legend>
                        <div class="header__box">
                            <h1><a href="index.html">취중진담</a></h1>
                            <h2>비밀번호 찾기</h2>
                            <p>아래에 정보를 입력하고 아이디를 찾아보세요!</p>
                        </div>
                        <!-- 비밀번호는 아이디 / 이름 / 이메일이 있어야 찾을 수 있습니다. -->
                        <div class="">
                            <div>
                                <label for="youId" class="required">아이디</label>
                                <input type="text" id="youId" name="youId" placeholder="아이디를 입력하세요.">
                                <p class="check__id__msg msg"></p>
                            </div>
                            <div>
                                <label for="youName" class="required">이름</label>
                                <input type="text" id="youName" name="youName" placeholder="이름을 입력하세요.">
                                <p class="check__name__msg msg"></p>
                            </div>
                            <div>
                                <label for="youEmail" class="required">이메일</label>
                                <input type="text" id="youEmail" name="youEmail" placeholder="이메일을 입력하세요.">
                                <p class="check__email__msg msg"></p>
                            </div>
                        </div>
                    </div>
                    <div class="join__btn">
                        <button type="submit" class="findBtn">비밀번호 찾기</button>
                    </div>
                    <div class="my_Id">
                        <?php
                        if (isset($_GET['success']) && $_GET['success'] == 1) {
                            if (isset($_SESSION['realYouPass'])) {
                                $realYouPass = $_SESSION['realYouPass'];
                                echo "$realYouPass";
                                session_destroy();
                            }
                        } else {
                            $plsMsg = $_SESSION['plsMsg'];
                            echo "$plsMsg";
                            session_destroy();
                        }
                        ?>
                    </div>
                </form>
            </div>
    </div>
    </main>
    </div>

    <script>
        // findBtn.addEventListener("click", {

        // })

        document.addEventListener("DOMContentLoaded", () => {
            const id = document.getElementById("youId");
            const name = document.getElementById("youName");
            const email = document.getElementById("youEmail");
            const findBtn = document.querySelector(".findBtn");
            const checkMsgId = document.querySelector(".check__id__msg");
            const checkMsgName = document.querySelector(".check__name__msg");
            const checkMsgEmail = document.querySelector(".check__email__msg");



            class FormValidator {
                constructor(id, name, email, findBtn, checkMsgId, checkMsgName, checkMsgEmail) {
                    this.id = id;
                    this.name = name;
                    this.email = email;
                    this.findBtn = findBtn;
                    this.checkMsgId = checkMsgId;
                    this.checkMsgName = checkMsgName;
                    this.checkMsgEmail = checkMsgEmail;
                    this.idCheck = false;
                    this.nameCheck = false;
                    this.emailCheck = false;

                    this.findBtn.addEventListener("click", (event) => {
                        event.preventDefault();
                        console.log("first")
                        this.validateForm();
                    });
                    this.id.addEventListener("keyup", () => {
                        this.validateField(this.id, this.checkMsgId, "가입하실 때 사용한 아이디를 입력해주세요.");
                    });
                    this.name.addEventListener("keyup", () => {
                        this.validateField(this.name, this.checkMsgName, "가입하실 때 사용한 이름을 입력해주세요.");
                    });
                    this.email.addEventListener("keyup", () => {
                        this.validateField(this.email, this.checkMsgEmail, "가입하실 때 사용한 이메일을 입력해주세요.");
                    });
                }

                validateField(input, checkMsg, checkText) {
                    const value = input.value.trim();
                    if (value === "") {
                        checkMsg.innerText = checkText;
                        return false;
                    } else {
                        checkMsg.innerText = "";
                        return true;
                    }
                }

                validateForm() {
                    this.idCheck = this.validateField(this.id, this.checkMsgId, "가입하실 때 사용한 아이디를 입력해주세요.");
                    this.nameCheck = this.validateField(this.name, this.checkMsgName, "가입하실 때 사용한 이름을 입력해주세요.");
                    this.emailCheck = this.validateField(this.email, this.checkMsgEmail, "가입하실 때 사용한 이메일을 입력해주세요.");

                    if (this.idCheck && this.nameCheck && this.emailCheck) {
                        const form = document.querySelector(".find__form form");
                        console.log("모든 정보 입력 완료");

                        form.submit();
                    };
                };
            }
            const formValidator = new FormValidator(id, name, email, findBtn, checkMsgId, checkMsgName, checkMsgEmail);
        });
    </script>
</body>

</html>
<!-- const idv = id.value;
    const namev = name.value;
    const emailv = email.value;

    findBtn.addEventListener("click", () => {
    event.preventDefault();
    if (idCheck == false) {
    checkMsgId.innerText = "가입하실 때 사용한 아이디를 작성해주세요.";
    }
    if (nameCheck == false) {
    checkMsgName.innerText = "가입하실 때 사용한 이름을 작성해주세요.";
    }
    if (emailCheck == false) {
    checkMsgEmail.innerText = "가입하실 때 사용한 이메일을 작성해주세요.";
    }
    if (idCheck == true && nameCheck == true && emailCheck == true) {
    const form = document.querySelector(".find__form form"); // form의 선택자를 실제 폼의 선택자로 수정해야 합니다.
    alert("모든 정보 입력 완료");
    form.submit();
    }
    })
    id.addEventListener("keyup", () => {

    event.preventDefault();
    const idv = id.value;
    if (idv === "") {
    checkMsgId.innerText = "가입하실 때 사용한 아이디를 작성해주세요.";
    } else {
    checkMsgId.innerText = ""; // 내용이 있으면 메시지 삭제
    idCheck = true;
    }
    console.log(1);
    });
    name.addEventListener("keyup", () => {

    event.preventDefault();
    const namev = name.value;
    if (namev === "") {
    checkMsgName.innerText = "가입하실 때 사용한 이름을 작성해주세요.";
    } else {
    checkMsgName.innerText = ""; // 내용이 있으면 메시지 삭제
    nameCheck = true;
    }
    });
    email.addEventListener("keyup", () => {

    event.preventDefault();
    const emailv = email.value;
    if (emailv === "") {
    checkMsgEmail.innerText = "가입하실 때 사용한 이메일을 작성해주세요.";
    } else {
    checkMsgEmail.innerText = ""; // 내용이 있으면 메시지 삭제
    emailCheck = true;
    }
    });
    });

    현재까지 해결과정
    비어 있는 공간이 있는 곳에는 메시지를 작성해줌
    해당 공간에 텍스트가 입력된 채로 버튼을 클릭하고, 다른 공간이 비어있지 않다면, 메시지를 삭제해줌


    아이디와 이메일 이름이 비어있으면 각각 비어있는 값을 적어달라고 하고 싶음
    다음의 아이디 또는 이메일 이름이 데이터베이스에 없다면, 없다고 알려주고 싶음 -->