<?php 
    include "../connect/connect.php";
    include "../connect/session.php";

    if(isset($_SESSION['myMemberId'])){
        $myMemberId = $_SESSION['myMemberId'];
    } 

    $memberSql = "SELECT * FROM drinkMember WHERE myMemberId = '$myMemberId'";
    $memberResult = $connect -> query($memberSql);
    $memberInfo = $memberResult -> fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <title>취중진담</title>

    <!-- meta -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="취중진담" />
    <meta name="description" content="프론트엔드 개발자 포트폴리오 조별과제 사이트입니다." />
    <meta name="keywords" content="웹퍼블리셔,프론트엔드, php, 포트폴리오, 커뮤니티, 술, publisher, css3, html, markup, design" />

    <!-- favicon -->
    <link rel="icon" href="../assets/favicon/favicon.ico" type="image/x-icon" />

    <!-- fontasome -->
    <script src="https://kit.fontawesome.com/2cf6c5f82a.js" crossorigin="anonymous"></script>

    <!-- 모바일 헤더 스크롤 이벤트 js -->
    <script src="../assets/js/scrollEvent.js"></script>

    <!-- 공통 css -->
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link href="../assets/css/fonts.css" rel="stylesheet" />
    <link href="../assets/css/common.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />

    <!-- 개별 css -->
    <link href="../assets/css/mypage.css" rel="stylesheet" />
</head>


<body>
    <div id="wrapper">
        <?php include "../include/header.php" ?>
        <!-- header -->

        <main id="contents_area">
            <section id="main_contents">

                <div class="best_list boxStyle roundCorner shaDow">
                    <div class="tab-menu">
                        <button class="tab-button activity one" onclick="openTab('mypage_main')">프로필 수정하기</button>
                    </div>

                    <div id="mypage_main" class="tab-content">
                        <div class="main_box">
                            <div class="header_img"><img src="../assets/img/mypage_header.jpg" alt=""></div>
                            <div class="modify_box">
                                <div class="profile_img"><img src="../assets/profile/<?=$memberInfo['youImgFile']?>" alt=""></div>
                                <form action="profile_modifySave.php" name="board_writeSave" method="post" enctype="multipart/form-data" class="modify_img">
                                    <div>    
                                        <div class="profilemodify_img">
                                            <label for="youImgFile"></label>
                                            <input type="file" id="youImgFile" name="youImgFile">
                                        </div> 
                                        <div class="modifytext_box">
                                            <div class="modify_text modify">
                                                <h3>닉네임 수정하기</h3>
                                                <input type="text" id="modifyProfile" name="modifyProfile" class="input_newnick" placeholder="<?=$memberInfo['youNick']?>">
                                            </div>
                                            <div class="modify_text">
                                                <h3>비밀번호 입력</h3>
                                                <input type="password" id="modifyPass" name="modifyPass" class="input_newnick" placeholder="계정 비밀번호 입력">
                                            </div>
                                        </div>
                                        <div class="profile_modify01">
                                            <div>
                                                <div id="ModifyCancle">취소</div>
                                            </div>
                                            <div>
                                                <button type="submit" id="ModifyButton">수정</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                </div>

            </section>
            <!-- main_contents end -->

            <?php include "../include/aside.php"; ?>
            <!-- side_box end -->

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>

        // 탭 메뉴
        function openTab(tabId) {
            var tabContents = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].style.display = "none";
            }

            document.getElementById(tabId).style.display = "block";
        }
        openTab('mypage_main');

        // 수정 취소 버튼 --> 취소
        $("#ModifyCancle").click(function(){
            if (confirm("정말 수정을 취소하시겠습니까?")) {
                window.location.href = "mypage.php";
            } else {
            }
        })

        // 수정 버튼 --> 수정 버튼
        $(document).ready(function () {
        $("#ModifyButton").click(function (e) {
            if ($("#modifyPass").val() === "") {
                alert("프로필 이미지 혹은 닉네임을 변경하고 싶다면 비밀번호를 입력하세요.");
                $("#modifyPass").focus();
                e.preventDefault(); // 폼 제출을 중지합니다.
            }
            });
        });

    </script>
</body>

</html>