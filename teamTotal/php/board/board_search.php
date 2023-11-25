<?php
include "../connect/connect.php";
include "../connect/session.php";

// 검색 결과 세션 저장

// 


if (isset($_POST['optionList'])) {
    $selectedOption = $_POST['optionList'];
}
$side_search = $_POST['side_search'];
$board_search = $_POST['board_search'];

if ($selectedOption == "" || $selectedOption == "제목만") {
    $titleSql = "SELECT * FROM drinkBoard WHERE boardTitle LIKE '%$side_search%' AND boardCategory='자유게시판'";
    $titleInfo = $connect->query($titleSql);
} else {
    $AuthorSql = "SELECT * FROM drinkBoard WHERE boardAuthor LIKE '%$board_search%' AND boardCategory='자유게시판'";
    $AuthorInfo = $connect->query($AuthorSql);
}

//  고친 페이지 정리 
$titleArray = array();
while ($row = $titleInfo->fetch_assoc()) {
    $titleArray[] = $row;
}
$_SESSION['search_results_title'] = $titleArray;

print_r($_SESSION['search_results_title']);
// $AuthorArray = array();
// while ($row = $AuthorInfo->fetch_assoc()) {
//     $AuthorArray[] = $row;
// }
// $_SESSION['search_results_auth'] = $AuthorArray;

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <script>
        window.onpopstate = function(event) {
            location.reload();
        };
    </script>
    <?php
    include "../include/head.php";
    ?>

    <!-- meta -->
    <meta name="author" content="취중진담">
    <meta name="description" content="프론트엔드 개발자 포트폴리오 조별과제 사이트입니다.">
    <meta name="keywords" content="웹퍼블리셔,프론트엔드, php, 포트폴리오, 커뮤니티, 술, publisher, css3, html, markup, design">

    <!-- swiper / 술 랭킹-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- css -->
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/index.css" rel="stylesheet" />
    <link href="../assets/css/selectOption.css" rel="stylesheet" />
    <link href="../assets/css/title.css" rel="stylesheet">
    <link href="../assets/css/board.css" rel="stylesheet">

    <!-- js -->
    <script src="../assets/js/selectOption.js"></script>
</head>

<body>
    <script>
        window.onpopstate = function(event) {
            location.reload();
        };
    </script>
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
                    <h4>검색 결과</h4>
                    <ul class="board_w100">
                        <?php foreach ($titleInfo as $title) { ?>
                            <li>
                                <a href="board_view.php?boardId=<?= $title['boardId'] ?>">
                                    <div class="board_info">
                                        <div class="board_title textCut"><?= $title['boardTitle'] ?></div>
                                        <div class="board_author textCut"><?= $title['boardAuthor'] ?></div>
                                        <div class="board_date"><?= date('m-d', $title['boardRegTime']) ?></div>
                                        <div class="board_view"><span><?= $title['boardView'] ?></span></div>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
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

                    <!-- <form action="board_search.php" method="POST" class="search_form">
                        <div class="selectBox2"><i class="fa-solid fa-angle-down"></i>
                        <div class="label">게시글</div>
                            <select class="optionList" name="optionList">
                                <option class="optionItem" value="제목만">제목만</option>
                                <option class="optionItem" value="작성자">작성자</option>
                            </select>
                        </div>
                        <div class="board_search_form">
                            <div class="board_search_option">
                                <div id="search_input" class="board_search_box ">
                                    <label for="search" class="hidden" style="display: none;">검색창</label>
                                    <input type="text" id="board_search" name="board_search" placeholder="검색어를 입력해주세요"
                                        autocomplete="off" class="im">
                                    <button type="sumbit" id="search_Btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                        </div>
                    </form> -->

            </section>
            <!-- main_contents end -->

            <?php include "../include/sidewrap.php"; ?>
            <!-- side_box end -->

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

    <!-- Swiper JS CDN 불러옴 -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="../assets/js/swiper.js"></script>

</body>

</html>