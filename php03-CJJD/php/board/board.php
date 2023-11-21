<?php
    include "../connect/connect.php";
    include "../connect/session.php";

    // echo "<pre>";
    // var_dump($_SESSION);
    // echo "</pre>";

    $boardsql = "SELECT * FROM drinkboard WHERE boardDelete = 1 AND boardCategory = '커뮤니티' ORDER BY boardId DESC";
    $boardInfo = $connect -> query($boardsql);
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
                    <h4>인기 게시글 <span>HOT</span></h4>
                    <ul class="board_w100">
<?php foreach($boardInfo as $board){ ?>
    <li>
        <a href="board_view.php?boardId=<?=$board['boardId']?>">
            <div class="board_title">
                <p><?=$board['boardTitle']?></p>
            </div>
            <div class="board_reaction">
                <p>조회수 <span><?=$board['boardView']?></span></p>
                <p>댓글 <span><?=$board['boardComment']?></span></p>
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
                    
                    <div class="search_form">
                        <div class="selectBox2 "><i class="fa-solid fa-angle-down"></i>
                            <button class="label">게시글</button>
                            <ul class="optionList">
                                <li class="optionItem">제목만</li>
                                <li class="optionItem">작성자</li>
                                <li class="optionItem">grape</li>
                                <li class="optionItem">melon</li>
                            </ul>
                        </div>
                        <form action="/" method="post" name="" class="board_search_form ">
                            <div class="board_search_option">
                                <div id="search_input" class="board_search_box ">

                                    <label for="search" class="hidden" style="display: none;">검색창</label>
                                    <input type="text" id="search" name="search" placeholder="검색어를 입력해주세요"
                                        autocomplete="off" class="im">
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