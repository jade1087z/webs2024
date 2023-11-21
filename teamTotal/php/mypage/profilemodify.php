<!DOCTYPE html>
<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    if(isset($_SESSION['myMemberID'])){
        $myMemberID = $_SESSION['myMemberID'];
    } else {
        $myMemberID = 0;
    }

    // 내 정보 가져오기
    $memberSql = "SELECT * FROM drinkMember WHERE myMemberID = '$myMemberID'";
    $memberResult = $connect -> query($memberSql);
    $memberInfo = $memberResult -> fetch_array(MYSQLI_ASSOC);
?>

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
    <link rel="icon" href="../assets/favicon/favicon.ico" type="image/x-icon">

    <!-- fontasome -->
    <script src="https://kit.fontawesome.com/2cf6c5f82a.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link href="../assets/css/fonts.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/mypage.css" rel="stylesheet" />
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
                    <div class="tab-menu">
                        <button class="tab-button activity" onclick="openTab('mypage_main')">마이페이지</button>
                        <button class="tab-button" onclick="openTab('mypage_diary')">일기</button>
                        <button class="tab-button" onclick="openTab('mypage_activity')">내 활동</button>
                        <button class="tab-button right" onclick="openTab('mypage_review')">리뷰</button>
                    </div>

                    <div id="mypage_main" class="tab-content">
                        <div class="main_box">
                            <div class="header_img"><img src="../assets/img/mypage_header.jpg" alt=""></div>
                            <div class="profile_box">
                                <div class="profile_img"><img src="../assets/img/profile.png" alt=""></div>
                                <div class="text_box">
                                    <div class="profile_text modify">
                                        <h3>닉네임 수정하기</h3>
                                        <input type="text" id="modifyProfile" class="input_newnick" placeholder="새 닉네임을 입력하세요.">
                                    </div>
                                    <div class="profile_text">
                                        <h3>비밀번호 입력</h3>
                                        <input type="text" id="modifyPass" class="input_newnick" placeholder="비밀번호 입력">
                                        <p>닉네임을 수정하려면 비밀번호를 입력하세요!</p>
                                    </div>
                                </div>
                                <div class="profile_modify">
                                    <button id="ModifyCancle">취소</button>
                                    <button id="ModifyButton">수정</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="mypage_diary" class="tab-content">
                        <div class="today_diary">
                            <h2>12월 32일</h2>
                            <div class="today_photo"><img src="../assets/img/diary.jpg" alt=""></div>
                            <div class="today_write">
                                <span>
                                    대충 내용이 들어가는 자리대충 내용이 들어가는 자리대충 내용이 들어가는
                                    대충 내용이 들어가는 자리대충 내용이 들어가는 자리대충 내용이 들어가는
                                    대충 내용이 들어가는 자리대충 내용이 들어가는 자리대충 내용이 들어가는
                                    대충 내용이 들어가는 자리대충 내용이 들어가는 자리대충 내용이 들어가는
                                    대충 내용이 들어가는 자리대충 내용이 들어가는 자리대충 내용이 들어가는
                                </span>
                            </div>
                            <div class="today_drink">
                                <h3>오늘 마신 양</h3>
                                <div>
                                    <div class="drink_soju">
                                        <h4>소주</h4>
                                        <p>1병</p>
                                    </div>
                                    <div class="drink_beer">
                                        <h4>맥주</h4>
                                        <p>1병</p>
                                    </div>
                                    <div class="drink_etc">
                                        <h4>기타</h4>
                                        <p>1병</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="diary_write.html" class="wirte_button"><span>글쓰기</span></a>
                        <div class="pagenation">페이지 넘김 부분</div>
                    </div>

                    <div id="mypage_activity" class="tab-content mypage_activity">
                        <div>
                            <div class="my_board">
                                <h2>내 게시글</h2>
                                <div class="my_board_table">
                                    <table>
                                        <colgroup>
                                            <col style="width: 20%;">
                                            <col>
                                        </colgroup>
                                        <tr>
                                            <th>제목</th>
                                            <th>내용</th>
                                        </tr>
                                        <tr>
                                            <td>제목 1</td>
                                            <td>이것은 첫 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 2</td>
                                            <td>이것은 두 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 1</td>
                                            <td>이것은 첫 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 2</td>
                                            <td>이것은 두 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 1</td>
                                            <td>이것은 첫 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 2</td>
                                            <td>이것은 두 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 1</td>
                                            <td>이것은 첫 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 2</td>
                                            <td>이것은 두 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 1</td>
                                            <td>이것은 첫 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 2</td>
                                            <td>이것은 두 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 1</td>
                                            <td>이것은 첫 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 2</td>
                                            <td>이것은 두 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 1</td>
                                            <td>이것은 첫 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 2</td>
                                            <td>이것은 두 번째 내용입니다.</td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="pagenation">페이지 넘김 부분</div>
                            </div>
                            <div class="my_comment">
                                <h2>
                                    내 댓글
                                </h2>
                                <div class="my_comment_table">
                                    <table>
                                        <colgroup>
                                            <col style="width: 20%;">
                                            <col>
                                        </colgroup>
                                        <tr>
                                            <th>제목</th>
                                            <th>내용</th>
                                        </tr>
                                        <tr>
                                            <td>제목 1</td>
                                            <td>이것은 첫 번째 내용입니다.</td>
                                        </tr>
                                        <tr>
                                            <td>제목 2</td>
                                            <td>이것은 두 번째 내용입니다.</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="pagenation">페이지 넘김 부분</div>
                            </div>
                        </div>
                    </div>

                    <div id="mypage_review" class="tab-content">
                        <div class="my_review">
                            <div class="my_review_table">
                                <table>
                                    <colgroup>
                                        <col style="width: 20%;">
                                        <col style="width: 20%;">
                                        <col style="width: 50%;">
                                        <col style="width: 10%;">
                                    </colgroup>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>review</th>
                                        <th>Date</th>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/img/Rectangle.jpg" alt=""></td>
                                        <td>정말로 맛있는 술</td>
                                        <td class="text">
                                            적당한 리뷰 내용 적당한 리뷰 내용
                                            적당한 리뷰 내용적당한 리뷰 내용
                                            적당한 리뷰 내용적당한 리뷰 내용
                                        </td>
                                        <td>10월 21일</td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/img/Rectangle.jpg" alt=""></td>
                                        <td>술 1</td>
                                        <td class="text">이것은 첫 번째 내용입니다.</td>
                                        <td>10월 21일</td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/img/Rectangle.jpg" alt=""></td>
                                        <td>술 1</td>
                                        <td class="text">이것은 첫 번째 내용입니다.</td>
                                        <td>10월 21일</td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/img/Rectangle.jpg" alt=""></td>
                                        <td>술 1</td>
                                        <td class="text">이것은 첫 번째 내용입니다.</td>
                                        <td>10월 21일</td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/img/Rectangle.jpg" alt=""></td>
                                        <td>술 1</td>
                                        <td class="text">이것은 첫 번째 내용입니다.</td>
                                        <td>10월 21일</td>
                                    </tr>
                                    <tr>
                                        <td><img src="../assets/img/Rectangle.jpg" alt=""></td>
                                        <td>술 1</td>
                                        <td class="text">이것은 첫 번째 내용입니다.</td>
                                        <td>10월 21일</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
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
        

        // 탭 메뉴
        function openTab(tabId) {
            var tabContents = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].style.display = "none";
            }

            document.getElementById(tabId).style.display = "block";
        }
        openTab('mypage_main');


        // 닉네임 수정

        // 수정 취소 버튼 --> 취소
        $("#ModifyCancle").click(function(){
            if (confirm("정말 수정을 취소하시겠습니까?")) {
                window.location.href = "mypage.php";
            } else {

            }
        })

        // 댓글 수정 버튼 --> 수정 버튼
        $("#ModifyButton").click(function(){
            if($("#modifyPass").val() == ""){
                alert("닉네임 변경 시 비밀번호를 입력해주세요.");
                $("#modifyPass").focus();
            } else {
                $.ajax({
                    url: "profilemodifySave.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "youNick": $("#modifyProfile").val(),
                        "youPass": $("#modifyPass").val(),
                        "myMemberID": <?=$myMemberID?>
                    },
                    
                    success: function(data){
                        console.log(data);
                        if(data.result == "bad"){
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("닉네임이 수정되었습니다.");
                        }
                    },
                    error: function(request, status, error){
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    },
                    
                })
            }
        });
        
    </script>
</body>

</html>