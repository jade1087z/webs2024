<<<<<<< HEAD
<?php 
    include "../connect/connect.php";
    include "../connect/session.php";
    include "../connect/sessionCheck.php";

    // session으로 myMemberId 받아옴
    if(isset($_SESSION['myMemberId'])){
        $myMemberId = $_SESSION['myMemberId'];
    } 
    
    // 내 정보 가져오기
    $memberSql = "SELECT * FROM drinkMember WHERE myMemberId = '$myMemberId'";
    $memberResult = $connect -> query($memberSql);
    $memberInfo = $memberResult -> fetch_array(MYSQLI_ASSOC);

    // 오늘 날짜 
    $today = date("Y-m-d"); // 오늘 날짜 (날짜만 포함)
    
    $reviewsql = "SELECT drinkComment.*, drinkList.* FROM drinkComment INNER JOIN drinkList ON drinkComment.acId = drinkList.acId WHERE myMemberId = '$myMemberId' ORDER BY drinkComment.regTime";
    $reviewresult = $connect->query($reviewsql);

    // 일기장 

    // 일기 개수
    $diaryTotalCountQuery = "SELECT COUNT(boardId) AS count FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '일기장' AND myMemberId = '$myMemberId'";
    $diaryTotalresult = $connect->query($diaryTotalCountQuery);
    $diaryTotalCount = $diaryTotalresult->fetch_assoc()['count'];

    // 페이지 설정
    if (isset($_GET['diarypage'])) {
        $diarypage = (int)$_GET['diarypage'];
    } else {
        $diarypage = 1;
    }

    $viewNum = 8;
    $viewLimit = ($viewNum * $diarypage) - $viewNum;

    $diarySql = "SELECT * FROM drinkBoard WHERE boardCategory='일기장' AND boardDelete='1' AND myMemberId = '$myMemberId' ORDER BY regTime DESC";
    $diaryresult = $connect->query($diarySql);
    $diaryInfo = $diaryresult->fetch_all(MYSQLI_ASSOC);
 
    $todaydiarySql = "SELECT * FROM drinkBoard WHERE boardCategory='일기장' AND boardDelete='1' AND myMemberId = '$myMemberId' ORDER BY regTime DESC LIMIT 1";
    $todaydiaryresult = $connect->query($todaydiarySql);
    $todaydiaryInfo = $todaydiaryresult->fetch_array(MYSQLI_ASSOC);
    
    $todaydiarydate = date('Y-m-d', $todaydiaryInfo['regTime']);

    // 게시글
    $boardTotalCountQuery = "SELECT COUNT(boardId) AS count FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판' AND myMemberId = '$myMemberId'";
    $result = $connect->query($boardTotalCountQuery);
    $boardTotalCount = $result->fetch_assoc()['count'];

    // 페이지 설정
    if (isset($_GET['boardpage'])) {
        $boardpage = (int)$_GET['boardpage'];
    } else {
        $boardpage = 1;
    }

    $viewNum = 8;
    $viewLimit = ($viewNum * $boardpage) - $viewNum;
    $boardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판' AND myMemberId = '$myMemberId' ORDER BY boardId DESC LIMIT {$viewLimit}, $viewNum";
    $boardInfo = $connect->query($boardSql);

    // 댓글
    $CommentTotalCountQuery = "SELECT COUNT(commentId) AS count FROM drinkComment WHERE commentDelete = 1 AND commentCategory = '자유게시판' AND myMemberId = '$myMemberId'";
    $Commentresult = $connect->query($CommentTotalCountQuery);
    $commentTotalCount = $Commentresult->fetch_assoc()['count'];

    // 페이지 설정
    if (isset($_GET['commentpage'])) {
        $commentpage = (int)$_GET['commentpage'];
    } else {
        $commentpage = 1;
    }

    $viewLimit = ($viewNum *  $commentpage) - $viewNum;
    
    // 내가 쓴 자유게시판 댓글 정보
    $BcommentSql = "SELECT * FROM drinkComment WHERE commentCategory='자유게시판' AND commentDelete='1' AND myMemberId = '$myMemberId' ORDER BY regTime DESC LIMIT {$viewLimit}, $viewNum";
    $BcommentInfo = $connect->query($BcommentSql);
=======
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

    
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
?>

<!DOCTYPE html>
<html lang="ko">

<head>
<<<<<<< HEAD
    <title>취중진담</title>

    <!-- meta -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="취중진담" />
    <meta name="description" content="프론트엔드 개발자 포트폴리오 조별과제 사이트입니다." />
    <meta name="keywords" content="웹퍼블리셔,프론트엔드, php, 포트폴리오, 커뮤니티, 술, publisher, css3, html, markup, design" />

    <!-- favicon -->
    <link rel="icon" href="../assets/favicon/favicon.ico" type="image/x-icon" />
=======
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>취중진담</title>

    <!-- meta -->
    <meta name="author" content="취중진담">
    <meta name="description" content="프론트엔드 개발자 포트폴리오 조별과제 사이트입니다.">
    <meta name="keywords" content="웹퍼블리셔,프론트엔드, php, 포트폴리오, 커뮤니티, 술, publisher, css3, html, markup, design">

    <!-- favicon -->
    <link rel="icon" href="assets/favicon/favicon.ico" type="image/x-icon">
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158

    <!-- fontasome -->
    <script src="https://kit.fontawesome.com/2cf6c5f82a.js" crossorigin="anonymous"></script>

<<<<<<< HEAD
    <!-- 모바일 헤더 스크롤 이벤트 js -->
    <script src="../assets/js/scrollEvent.js"></script>

    <!-- 공통 css -->
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link href="../assets/css/fonts.css" rel="stylesheet" />
    <link href="../assets/css/common.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />

    <!-- 개별 css -->
    <link href="../assets/css/mypage.css" rel="stylesheet" />
    <link href="../assets/css/popup.css" rel="stylesheet" />
=======
    <!-- css -->
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link href="../assets/css/fonts.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/mypage.css" rel="stylesheet" />
    <link href="../assets/css/common.css" rel="stylesheet" />

    <!-- js -->
    <script src="assets/js/scrollEvent.js"></script>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
</head>

<body>
    <div id="wrapper">
<<<<<<< HEAD
        <?php include "../include/header.php" ?>
            <!-- header end -->
=======
        <!-- PC HEADER 840 < window -->
        <?php include "../include/header.php"; ?>

        <!-- M HEADER 840 > window -->
        <?php include "../include/logo.php"; ?>

        <?php include "../include/headerbottom.php"; ?>
        <!-- header end -->
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158

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
<<<<<<< HEAD
                                <div class="profile_img"><img src="../assets/profile/<?=$memberInfo['youImgFile']?>" alt=""></div>
                                <div class="profile_text">
                                    <div class="youNick">
                                        <h2><?=$memberInfo['youNick']?></h2>
                                    </div>
                                    <div class="youId"><span>@<?=$memberInfo['youId']?></span></div>
=======
                                <div class="profile_img"><img src="../assets/img/profile.png" alt=""></div>
                                <div class="profile_text">
                                    <div class="youNick"><h2><?=$memberInfo['youNick']?></h2></div>
                                    <div class="youId"><span><?=$memberInfo['youId']?></span></div>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                                    <div class="youemail"><span><?=$memberInfo['youEmail']?></span></div>
                                </div>
                                <div class="profile_modify">
                                    <ul>
<<<<<<< HEAD
                                        <li><a href="profile_modify.php">프로필 수정하기</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="pass_modify.php">비밀번호 수정</a></li>
                                    </ul>
                                    <ul>
                                        <li><button id="not_join">회원탈퇴</button></li>
=======
                                        <li><a href="profilemodify.php">프로필 수정하기</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="#">회원탈퇴</a></li>
                                    </ul>
                                    <ul>
                                        <li><a href="passmodify.php">비밀번호 수정</a></li>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="mypage_diary" class="tab-content">
                        <div class="today_diary">
<<<<<<< HEAD
                        <?php if ($diarypage == 1) {
                            if ($today == $todaydiarydate) { // 오늘 작성한 일기가 있을 경우
                                ?>
                                <h2><?= $today ?></h2>
                                <?php if ($todaydiaryInfo['boardImgFile']) : ?>
                                    <div class="today_photo">
                                        <img src="../assets/DBIMG/<?= $todaydiaryInfo['boardImgFile'] ?>" alt="">
                                    </div>
                                <?php endif; ?>
                                <div class="<?= $todaydiaryInfo['boardImgFile'] ? 'today_write' : 'diary_text' ?>">
                                    <span><?= $todaydiaryInfo['boardContents'] ?></span>
                                </div>
                            <?php } else { ?>
                                <div class="diary_text">
                                    <p>오늘 작성한 일기가 없습니다.</p>
                                </div>
                            <?php }
                        } elseif ($diaryInfo && $diarypage > 1) {
                            $index = $diarypage - 1;
                            ?>
                            <h2><?= date('Y-m-d', $diaryInfo[$index]['regTime']) ?></h2>
                            <?php if ($diaryInfo[$index]['boardImgFile']) : ?>
                                <div class="today_photo">
                                    <img src="../assets/DBIMG/<?= $diaryInfo[$index]['boardImgFile'] ?>" alt="">
                                </div>
                            <?php endif; ?>
                            <div class="<?= $diaryInfo[$index]['boardImgFile'] ? 'today_write' : 'diary_text' ?>">
                                <span><?= $diaryInfo[$index]['boardContents'] ?></span>
                            </div>
                        <?php } ?>
                        
                        </div>
                        <a href="../board/board_write.php" class="wirte_button"><span>글쓰기</span></a>
                        <div class="board_page_option">
                            <div class="board_pages">
                            <ul class="pages_list">
                                <?php
                                // 페이지 뷰 설정
                                $pageView = 1;
                                $startPage = $diarypage - $pageView;
                                $endPage = $diarypage + $pageView;

                                $diaryTotalCount = ($diaryTotalCount == 0) ? 1 : $diaryTotalCount;

                                $prevPage = ($diarypage > 1) ? $diarypage - 1 : 1;
                                $nextPage = ($diarypage >= $diaryTotalCount) ? $diaryTotalCount : $diarypage + 1;

                                // 처음 페이지 초기화 / 마지막 페이지 초기화
                                if ($startPage < 1) $startPage = 1;
                                if ($endPage >= $diaryTotalCount) $endPage = $diaryTotalCount;

                                echo "<li class='prev'><a href='mypage.php?boardpage={$boardpage}&commentpage={$commentpage}&diarypage={$prevPage}'>&lt;</a></li>";
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = ($i == $diarypage) ? "active" : "";
                                    echo "<li class='$active'><a href='mypage.php?boardpage={$boardpage}&commentpage={$commentpage}&diarypage={$i}'>$i</a></li>";
                                }
                                // 다음 페이지 버튼 추가
                                if ($diaryTotalCount >= 1) {
                                    echo "<li class='next'><a href='mypage.php?boardpage={$boardpage}&commentpage={$commentpage}&diarypage={$nextPage}'>&gt;</a></li>";
                                }
                                ?>
                            </ul>
                            </div>
                        </div>
                    </div>

                    
=======
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

>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                    <div id="mypage_activity" class="tab-content mypage_activity">
                        <div>
                            <div class="my_board">
                                <h2>내 게시글</h2>
                                <div class="my_board_table">
                                    <table>
                                        <colgroup>
                                            <col style="width: 100%;">
                                        </colgroup>
<<<<<<< HEAD
                                        <?php
                                            if ($boardInfo->num_rows > 0) {
                                                while ($info = $boardInfo->fetch_array(MYSQLI_ASSOC)) {
                                                    echo "<tr><td><a href='../board/board_view.php?boardId=" . $info['boardId'] . "'>" . $info['boardTitle'] . "</a></td></tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='1'>작성한 게시글이 없습니다.</td></tr>";
                                            }
                                        ?>
=======
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
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                                    </table>
                                </div>
                                <div class="board_page_option">
                                    <div class="board_pages">
                                        <ul class="pages_list">
<<<<<<< HEAD
                                            <?php
                                            // 총 페이지 갯수 체크
                                            $boardTotalCount = ceil($boardTotalCount / $viewNum);

                                            // 페이지 뷰 설정
                                            $pageView = 5;
                                            $startPage = $boardpage - $pageView;
                                            $endPage = $boardpage + $pageView;

                                            $prevPage = ($boardpage > 1) ? $boardpage - 1 : 1;
                                            $nextPage = ($boardpage >= $boardTotalCount) ? $boardTotalCount : $boardpage + 1;

                                            // 처음 페이지 초기화 / 마지막 페이지 초기화
                                            if ($startPage < 1) $startPage = 1;
                                            if ($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

                                            echo "<li class='prev'><a href='mypage.php?boardpage={$prevPage}&commentpage={$commentpage}&diarypage={$diarypage}'>&lt;</a></li>";
                                            // page 뿌리기
                                            for ($i = $startPage; $i <= $endPage; $i++) {
                                                $active = ($i == $boardpage) ? "active" : "";
                                                echo "<li class='$active'><a href='mypage.php?boardpage={$i}&commentpage={$commentpage}&diarypage={$diarypage}'>$i</a></li>";
                                            }
                                            echo "<li class='next'><a href='mypage.php?boardpage={$nextPage}&commentpage={$commentpage}&diarypage={$diarypage}'>&gt;</a></li>";
                                            ?>
=======
                                            <li class="first"><a href="#">&lt;&lt;</a></li>
                                            <li class="prev"><a href="#">&lt;</a></li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li class="next"><a href="#">></a></li>
                                            <li class="last"><a href="#">>></a></li>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                                        </ul>
                                    </div>
                                </div>
                            </div>
<<<<<<< HEAD
                            <div class="my_comment">
                                <h2>
                                    내 댓글
                                </h2>
=======
                            <div class="my_board">
                                <h2>내 댓글</h2>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                                <div class="my_comment_table">
                                    <table>
                                        <colgroup>
                                            <col style="width: 100%;">
                                        </colgroup>
<<<<<<< HEAD
                                        <?php
                                            if ($BcommentInfo->num_rows > 0) {
                                                while ($info = $BcommentInfo->fetch_array(MYSQLI_ASSOC)) {
                                                    echo "<tr><td><a href='../board/board_view.php?boardId=" . $info['commentId'] . "'>" . $info['commentMsg'] . "</a></td></tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='1'>작성한 댓글이 없습니다.</td></tr>";
                                            }
                                        ?>
=======
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
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                                    </table>
                                </div>
                                <div class="board_page_option">
                                    <div class="board_pages">
                                        <ul class="pages_list">
<<<<<<< HEAD
                                            <?php
                                            // 총 페이지 갯수 체크
                                            $commentTotalCount = ceil($commentTotalCount / $viewNum);

                                            // 페이지 뷰 설정
                                            $pageView = 5;
                                            $startPage = $commentpage - $pageView;
                                            $endPage = $commentpage + $pageView;

                                            $prevPage = ($commentpage > 1) ? $commentpage - 1 : 1;
                                            $nextPage = ($commentpage >= $commentTotalCount) ? $commentTotalCount : $commentpage + 1;

                                            // 처음 페이지 초기화 / 마지막 페이지 초기화
                                            if ($startPage < 1) $startPage = 1;
                                            if ($endPage >= $commentTotalCount) $endPage = $commentTotalCount;

                                            echo "<li class='prev'><a href='mypage.php?boardpage={$boardpage}&commentpage={$prevPage}&diarypage={$diarypage}'>&lt;</a></li>";
                                            // page 뿌리기
                                            for ($i = $startPage; $i <= $endPage; $i++) {
                                                $active = ($i == $commentpage) ? "active" : "";
                                                echo "<li class='$active'><a href='mypage.php?boardpage={$boardpage}&commentpage={$i}&diarypage={$diarypage}'>$i</a></li>";
                                            }
                                            echo "<li class='next'><a href='mypage.php?boardpage={$boardpage}&commentpage={$nextPage}&diarypage={$diarypage}'>&gt;</a></li>";
                                            ?>
=======
                                            <li class="first"><a href="#">&lt;&lt;</a></li>
                                            <li class="prev"><a href="#">&lt;</a></li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li class="next"><a href="#">></a></li>
                                            <li class="last"><a href="#">>></a></li>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
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
<<<<<<< HEAD
                                    <?php
                                        if ($reviewresult) {
                                            while ($info = $reviewresult->fetch_array(MYSQLI_ASSOC)) {
                                                echo "<tr>
                                                        <td><a href='../alcohol/alcohol_page.php?acId=" . $info['acId'] . "'><img src='" . $info['acImgPath'] . "' alt=''></a></td>
                                                        <td><a href='../alcohol/alcohol_page.php?acId=" . $info['acId'] . "'>" . $info['acName'] . "</a></td>
                                                        <td class='text'>" . $info['commentMsg'] . "</td>
                                                        <td>" . date('m-d', $info['regTime']) . "</td>
                                                    </tr>";
                                            }
                                        } 
                                    ?>
=======
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
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
                                </table>
                            </div>
                        </div>
                    </div>
<<<<<<< HEAD
=======
                </div>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158


            </section>
            <!-- main_contents end -->

<<<<<<< HEAD
            <?php include "../include/aside.php" ?>
            <!-- side_box end -->

            <div id="popupDelete" class="none">
                <div class="comment__delete">
                    <h4>회원탈퇴</h4>
                    <label for="commentPass" class="blind">비밀번호</label>
                    <input type="password" id="deletePass" name="deletePass" placeholder="비밀번호">
                    <p>* 가입했던 비밀번호를 입력해주세요!</p>
                    <div class="btn">
                        <button id="commentDeleteCancel">취소</button>
                        <button id="commentDeleteButton">삭제</button>
                    </div>
                </div>
            </div>
            <!-- popUp-->

=======
            <?php include "../include/sidewrap.php"; ?>
            <!-- side_box end -->

>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

<<<<<<< HEAD
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        // 탭을 열 때 호출되는 함수
=======
    <script>
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
        function openTab(tabId) {
            var tabContents = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].style.display = "none";
            }
<<<<<<< HEAD
            document.getElementById(tabId).style.display = "block";
            localStorage.setItem('selectedTab', tabId);
        }

        document.addEventListener('DOMContentLoaded', function() {
            var selectedTab = localStorage.getItem('selectedTab');
            openTab(selectedTab || 'mypage_main');
        });

        // 회원 탈퇴 버튼
        $("#not_join").click(function () {
            $("#popupDelete").removeClass("none");
        });

        // 회원탈퇴 취소 버튼
        $("#commentDeleteCancel").click(function () {
            $("#popupDelete").addClass("none");
        });

        $("#commentDeleteButton").click(function () {
            if ($("#deletePass").val() == "") {
                alert("비밀번호를 작성해주세요.");
                $("#deletePass").focus();
            } else if (confirm("정말 삭제하시겠습니까?")){
                $.ajax({
                    url: "not_joinSave.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        "deletePass": $("#deletePass").val(),
                    },
                    success: function (data) {
                        console.log(data);
                        if (data.result == "bad") {
                            alert("비밀번호가 일치하지 않습니다.");
                        } else {
                            alert("계정이 삭제되었습니다.");
                        }
                        window.location.href = '../login/logout.php';
                    },
                    error: function (request, status, error) {
                        console.log("request" + request);
                        console.log("status" + status);
                        console.log("error" + error);
                    }
                })
            }
        });
    </script>

    <script>
        // 게시물 페이지네이션 클릭 이벤트
        $('#boardPagination').on('click', 'a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadBoardContent(page);
        });

        // 댓글 페이지네이션 클릭 이벤트
        $('#commentPagination').on('click', 'a', function (e) {
            e.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            loadCommentContent(page);
        });

        // 초기 로딩
        loadBoardContent(1);
        loadCommentContent(1);

        function loadBoardContent(page) {
            $.ajax({
                url: 'load_board_content.php?page=' + page,
                type: 'GET',
                success: function (data) {
                    $('#boardContent').html(data);
                }
            });
        }

        function loadCommentContent(page) {
            $.ajax({
                url: 'load_comment_content.php?page=' + page,
                type: 'GET',
                success: function (data) {
                    $('#commentContent').html(data);
                }
            });
        }
=======

            document.getElementById(tabId).style.display = "block";
        }
        openTab('mypage_diary');
>>>>>>> 9358853574a1fb2827ff7b922f7241d93f738158
    </script>
</body>

</html>