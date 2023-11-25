<?php
include "../connect/connect.php";
include "../connect/session.php";

// 댓글 많은 순
$commentSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판' ORDER BY boardComment, boardView DESC LIMIT 5";
$commentBoard = $connect->query($commentSql);

// 게시글 최신 순
$newBoardSql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판' ORDER BY boardRegTime ASC LIMIT 5";
$newResult = $connect->query($newBoardSql);

// HOT
$hotBoardsql = "SELECT * FROM drinkBoard WHERE boardDelete = 1 AND boardCategory = '자유게시판' ORDER BY boardComment, boardView, boardLike DESC LIMIT 5";
$hotBoard = $connect->query($hotBoardsql);


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
    <link rel="icon" href="../assets/favicon/favicon.ico" type="image/x-icon">

    <!-- swiper / 술 랭킹-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <!-- fontasome -->
    <script src="https://kit.fontawesome.com/2cf6c5f82a.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link href="../assets/css/reset.css" rel="stylesheet" />
    <link href="../assets/css/fonts.css" rel="stylesheet" />
    <link href="../assets/css/style.css" rel="stylesheet" />
    <link href="../assets/css/common.css" rel="stylesheet" />
    <link href="../assets/css/index.css" rel="stylesheet" />

    <!-- js -->
    <script src="../assets/js/scrollEvent.js"></script>
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
                <div class="ranking_list boxStyle roundCorner shaDow">
                    <h4>이번주 인기 주류 <span>TOP10</span></h4>
                    <div class="alcohol_list">
                        <div class="swiper">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <span class="rankedIn">1</span>
                                    <a href="#">
                                        <img src="../assets/img/card (1).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span class="rankedIn">2</span>
                                    <a href="#">
                                        <img src="../assets/img/card (2).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span class="rankedIn">3</span>
                                    <a href="#">
                                        <img src="../assets/img/card (3).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>4</span>
                                    <a href="#">
                                        <img src="../assets/img/card (4).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>5</span>
                                    <a href="#">
                                        <img src="../assets/img/card (5).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>6</span>
                                    <a href="#">
                                        <img src="../assets/img/card (1).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>7</span>
                                    <a href="#">
                                        <img src="../assets/img/card (2).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>8</span>
                                    <a href="#">
                                        <img src="../assets/img/card (3).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>9</span>
                                    <a href="#">
                                        <img src="../assets/img/card (4).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <span>10</span>
                                    <a href="#">
                                        <img src="../assets/img/card (5).gif" alt="alcohol">
                                        <div class="title_hover">
                                            <p>진로 이즈백</p>
                                            <span>하이트</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- alcohol_list -->
                </div>
                <!-- ranking_list -->

                <div class="best_list boxStyle roundCorner shaDow">
                    <h4>인기 게시글 <span>HOT</span></h4>
                    <ul class="board_w100">
                        <?php foreach ($hotBoard as $board) { ?>
                            <li>
                                <a href="../board/board_view.php?boardId=<?= $board['boardId'] ?>">
                                    <div class="board_info">
                                        <div class="board_title textCut"><?= $board['boardTitle'] ?></div>
                                        <div class="board_author textCut"><?= $board['boardAuthor'] ?></div>
                                        <div class="board_date"><?= date('m-d', $board['boardRegTime']) ?></div>
                                        <div class="board_view"><span><?= $board['boardView'] ?></span></div>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="new_list boxStyle roundCorner shaDow">
                    <h4>최근 게시글 <span>NEW</span></h4>
                    <ul class="board_w100">
                        <?php foreach ($newResult as $board) { ?>
                            <li>
                                <a href="../board/board_view.php?boardId=<?= $board['boardId'] ?>">
                                    <div class="board_info">
                                        <div class="board_title textCut"><?= $board['boardTitle'] ?></div>
                                        <div class="board_author textCut"><?= $board['boardAuthor'] ?></div>
                                        <div class="board_date"><?= date('m-d', $board['boardRegTime']) ?></div>
                                        <div class="board_view"><span><?= $board['boardView'] ?></span></div>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class="pick_list boxStyle roundCorner shaDow">
                    <h4>추천 게시글 <span>Pick!</span></h4>
                    <ul class="board_w100">
                        <?php foreach ($commentBoard as $board) { ?>
                            <li>
                                <a href="../board/board_view.php?boardId=<?= $board['boardId'] ?>">
                                    <div class="board_info">
                                        <div class="board_title textCut"><?= $board['boardTitle'] ?></div>
                                        <div class="board_author textCut"><?= $board['boardAuthor'] ?></div>
                                        <div class="board_date"><?= date('m-d', $board['boardRegTime']) ?></div>
                                        <div class="board_view"><span><?= $board['boardView'] ?></span></div>
                                    </div>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </section>
            <!-- main_contents end -->

            <?php include "../include/sidewrap.php"; ?>
            <!-- header end -->

        </main>
        <!-- contents_area end -->
    </div>
    <!-- wrapper end -->

    <!-- Swiper JS CDN 불러옴 -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="../assets/js/swiper.js"></script>
</body>

</html>