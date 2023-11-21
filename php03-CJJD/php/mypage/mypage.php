<?php
    include "../connect/connect.php";
    include "../connect/session.php";



    if(isset($_SESSION['myMemberID'])){
        $myMemberID = $_SESSION['myMemberID'];
    } else {
        Header("Location: ../main/main.php");
    }

    // 내 정보 가져오기
    $memberSql = "SELECT * FROM drinkMember WHERE myMemberID = '$myMemberID'";
    $memberResult = $connect -> query($memberSql);
    $memberInfo = $memberResult -> fetch_array(MYSQLI_ASSOC);

    // 내가 쓴 글 정보 가져오기
    $boardSql = "SELECT * FROM drinkboard WHERE boardId = '$boardId'";
    $boardResult = $connect -> query($boardSql);
    $boardInfo = $boardResult -> fetch_array(MYSQLI_ASSOC);

   
    
    // 일기장 정보 가져오기 

    $today = date("Y-m-d"); // 오늘 날짜 (날짜만 포함)

    // 오늘 날짜 가져오기

    $dateSql = "SELECT drinkboard.*, drinkMember.youName
                FROM drinkboard
                INNER JOIN drinkMember ON drinkboard.boardAuthor = drinkMember.youName
                WHERE drinkboard.boardCategory = '일기장'
                ORDER BY drinkboard.boardRegTime DESC LIMIT 1";

    $dateResult = $connect -> query($dateSql);
    $dateInfo = $dateResult -> fetch_array(MYSQLI_ASSOC);

    $dateboard =date('Y-m-d', $dateInfo['boardRegTime']);


    $diarySql = "SELECT drinkboard.*, drinkMember.youName
                FROM drinkboard
                INNER JOIN drinkMember ON drinkboard.boardAuthor = drinkMember.youName
                WHERE drinkboard.boardCategory = '일기장'
                AND '$dateboard'='$today'
                ORDER BY drinkboard.boardRegTime DESC LIMIT 1";

    $diaryResult = $connect -> query($diarySql);
    $diaryInfo = $diaryResult -> fetch_array(MYSQLI_ASSOC);

    
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
                                <div class="profile_text">
                                    <div class="youNick"><h2><?=$memberInfo['youNick']?></h2></div>
                                    <div class="youId"><span><?=$memberInfo['youId']?></span></div>
                                    <div class="youemail"><span><?=$memberInfo['youEmail']?></span></div>
                                </div>
                                <div class="profile_modify">
                                    <ul>
                                        <li><a href="profilemodify.php">프로필 수정하기</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="#">회원탈퇴</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="passmodify.php">비밀번호 수정</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="mypage_diary" class="tab-content">
                        <div class="today_diary">
                            <h2><?= $today ?></h2>
<?php if ($diaryResult->num_rows == 0) { ?>
    <div class="diary_text">
        <p>오늘 일기를 작성하지 않았습니다.</p>
    </div>
<?php } else if ($diaryInfo['boardImgFile']) { ?>   
    <div class="today_photo">
        <img src="../assets/board/<?=$diaryInfo['boardImgFile']?>" alt="">
    </div>
    <div class="today_write">
        <span>
            <?=$diaryInfo['boardContents']?>
        </span>
    </div>
<?php } else { ?>
    <div class="today_write center">
        <span>
            <?=$diaryInfo['boardContents']?>
        </span>
    </div>
<?php } ?>                         
                        </div>
                        <a href="../board/board_write.php" class="wirte_button"><span>글쓰기</span></a>
                        <div class="board_page_option">
                        <div class="board_pages">
                            <ul class="pages_list">
                                <li class="first"><a href="#">&lt;&lt;</a></li>
                                <li class="prev"><a href="#">&lt;</a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li class="next"><a href="#">></a></li>
                                <li class="last"><a href="#">>></a></li>
                            </ul>
                        </div>
                    </div>
                    </div>

                    <div id="mypage_activity" class="tab-content mypage_activity">
                        <div>
                            <div class="my_board">
                                <h2>내 게시글</h2>
                                <div class="my_board_table">
                                    <table>
                                        <colgroup>
                                            <col style="width: 100%;">
                                        </colgroup>
<?php
    $boardId = $_GET['boardId'];

    $sql = "SELECT drinkboard.*, drinkMember.youName
            FROM drinkboard
            INNER JOIN drinkMember ON drinkboard.boardAuthor = drinkMember.youName
            WHERE boardCategory='커뮤니티'
            ORDER BY drinkboard.boardRegTime";
    $connect->query($sql);
    $result = $connect->query($sql);

    if ($result) {
        while ($info = $result->fetch_array(MYSQLI_ASSOC)) {
            echo "<tr><td><a href='../board/board_view.php?boardId=".$info['boardId']. "'>" . $info['boardTitle'] . "</a></td></tr>";
        }
    } else {
        echo "아무것도 없습니다";
    }
?>
                                    </table>
                                </div>
                                <div class="board_page_option">
                                    <div class="board_pages">
                                        <ul class="pages_list">
                                            <li class="first"><a href="#">&lt;&lt;</a></li>
                                            <li class="prev"><a href="#">&lt;</a></li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li class="next"><a href="#">></a></li>
                                            <li class="last"><a href="#">>></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="my_board">
                                <h2>내 댓글</h2>
                                <div class="my_comment_table">
                                    <table>
                                        <colgroup>
                                            <col style="width: 100%;">
                                        </colgroup>
<?php
    $boardId = $_GET['boardId'];

    $sql = "SELECT drinkreview.*, drinkMember.youName
            FROM drinkreview
            INNER JOIN drinkMember ON drinkreview.reviewName = drinkMember.youName
            ORDER BY drinkreview.regTime";

    $connect->query($sql);
    $result = $connect->query($sql);

    if ($result) {
        while ($info = $result->fetch_array(MYSQLI_ASSOC)) {
            echo "<tr><td><a href='../board/board_view.php?boardId=".$info['boardId']. "'>" . $info['reviewMsg'] . "</a></td></tr>";
        }
    } else {
        echo "아무것도 없습니다";
    }
?>
                                    </table>
                                </div>
                                <div class="board_page_option">
                                    <div class="board_pages">
                                        <ul class="pages_list">
                                            <li class="first"><a href="#">&lt;&lt;</a></li>
                                            <li class="prev"><a href="#">&lt;</a></li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li class="next"><a href="#">></a></li>
                                            <li class="last"><a href="#">>></a></li>
                                        </ul>
                                    </div>
                                </div>
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

    <script>
        function openTab(tabId) {
            var tabContents = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].style.display = "none";
            }

            document.getElementById(tabId).style.display = "block";
        }
        openTab('mypage_diary');
    </script>
</body>

</html>