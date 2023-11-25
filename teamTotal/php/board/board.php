<?php
include "../connect/connect.php";
include "../connect/session.php";

// 해당 페이지는 드링크보드 테이블에 있는 

$sql = "SELECT count(boardId) FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판'";
$result = $connect->query($sql);

$boardTotalCount = $result->fetch_array(MYSQLI_ASSOC);
$boardTotalCount = $boardTotalCount['count(boardId)'];
//  echo $boardTotalCount;  전체 개수 13개 





if (isset($_GET['page'])) {
    $page = (int) $_GET['page']; // 'page'는 url에서의 page를 의미한다
} else {
    $page = 1;
}
$viewNum = 10;
$viewLimit = ($viewNum * $page) - $viewNum;
$boardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판' ORDER BY boardId DESC LIMIT {$viewLimit}, ${viewNum}";
$boardInfo = $connect->query($boardSql);
$infoResult = $boardInfo->fetch_array(MYSQLI_ASSOC);
// 1 ~ 10 LIMIT 0, 10 
// 11 ~ 20 LIMIT 10, 10  => 10개씩 커짐 => viewNum에 1을 곱해줌 그리고 10을 빼줌 
// 21 ~ 30 LIMIT 20, 10 
// for($page; $page<$count; $page++){

// }

?>

<!DOCTYPE html>
<html lang="ko">

<head>
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
    <link href="../assets/css/board.css" rel="stylesheet">
    <!-- js -->
    <script src="../assets/js/selectOption.js"></script>

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
                    <h4>자유 <span>게시판</span></h4>
                    <ul class="board_w100">
                        <?php foreach ($boardInfo as $board) { ?>
                            <li>
                                <a href="board_view.php?boardId=<?= $board['boardId'] ?>">
                                    <div class="board_title">
                                        <p><?= $board['boardTitle'] ?></p>
                                    </div>
                                    <div class="board_reaction">
                                        <p>조회수 <span><?= $board['boardView'] ?></span></p>
                                        <p>댓글 <span><?= $board['boardComment'] ?></span></p>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>

                    <div class="board_page_option">
                        <div class="board_pages">
                            <ul class="pages_list">
                                <?php
                                // 총 페이지 갯수 체크
                                $boardTotalCount = ceil($boardTotalCount / $viewNum);

                                // 
                                $pageView = 5;
                                $startPage = $page - $pageView;
                                $endPage = $page + $pageView;

                                $prevPage = ($page > 1) ? $page - 1 : 1;
                                $nextPage = ($page >= $boardTotalCount) ? $boardTotalCount : $page + 1;

                                // 처음 페이지 초기화 / 마지막 페이지 초기화
                                if ($startPage < 1) $startPage = 1;
                                if ($endPage >= $boardTotalCount) $endPage = $boardTotalCount;

                                echo "<li class='first'><a href='board.php?page=1'>&lt;&lt;</a></li>";
                                echo "<li class='prev'><a href='board.php?page={$prevPage}'>&lt;</a></li>";
                                // page 뿌리기
                                for ($i = $startPage; $i <= $endPage; $i++) {
                                    $active = "";
                                    if ($i == $page) {
                                        $active = "active";
                                    }
                                    echo "<li class='$active'><a href='board.php?page={$i}'>$i</a></li>";
                                }
                                echo "<li class='next'><a href='board.php?page={$nextPage}'>&gt;</a></li>";
                                echo "<li class='last'><a href='board.php?page={$boardTotalCount}'>&gt;&gt;</a></li>";
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="search_form">
                        <div class="selectBox2 "><i class="fa-solid fa-angle-down"></i>
                            <button class="label">게시글</button>
                            <ul class="optionList">
                                <li class="optionItem">제목만</li>
                                <li class="optionItem">작성자</li>
                            </ul>
                        </div>
                        <form action="/" method="post" name="" class="board_search_form ">
                            <div class="board_search_option">
                                <div id="search_input" class="board_search_box ">

                                    <label for="search" class="hidden" style="display: none;">검색창</label>
                                    <input type="text" id="search" name="search" placeholder="검색어를 입력해주세요" autocomplete="off" class="im">
                                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                        </form>
                        </di>
                    </div>

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